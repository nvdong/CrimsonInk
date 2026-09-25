<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * Đọc bảng settings. Thay cho config/social.php và config/locales.php.
 *
 *   Settings::get('studio.phone')
 *   Settings::json('i18n.locales')
 *   Settings::locales()            -> ['vi' => [...], 'en' => [...]]
 *   Settings::social('dock')       -> chỉ các link bật cho thanh neo
 *
 * Cả bảng chỉ vài chục dòng nên nạp một lần rồi giữ trong bộ nhớ suốt request.
 * Khi chưa chạy migrate (bảng chưa tồn tại) thì trả mặc định thay vì ném lỗi,
 * để trang vẫn render được.
 */
class Settings
{
    /** @var array|null */
    protected static $cache;

    protected static function all()
    {
        if (static::$cache !== null) {
            return static::$cache;
        }

        static::$cache = [];

        try {
            foreach (DB::table('settings')->get() as $row) {
                static::$cache[$row->group.'.'.$row->key] = $row;
            }
        } catch (Throwable $e) {
            // bảng chưa có -> coi như rỗng
        }

        return static::$cache;
    }

    /** Xóa cache — dùng sau khi admin lưu settings. */
    public static function flush()
    {
        static::$cache = null;
    }

    /**
     * Giá trị đã chọn theo ngôn ngữ hiện tại.
     * Ưu tiên cột value, rồi value_<locale>, rồi value_en.
     */
    public static function get($key, $default = null)
    {
        $row = static::all()[$key] ?? null;

        if (! $row) {
            return $default;
        }

        if ($row->value !== null && $row->value !== '') {
            return $row->value;
        }

        $locale = app()->getLocale();
        $localeColumn = 'value_'.$locale;
        $value = $row->{$localeColumn} ?? null;

        if ($value === null || $value === '') {
            $value = $row->value_en;
        }

        return ($value === null || $value === '') ? $default : $value;
    }

    public static function json($key, array $default = [])
    {
        $raw = static::get($key);

        if (! $raw) {
            return $default;
        }

        $decoded = json_decode($raw, true);

        return is_array($decoded) ? $decoded : $default;
    }

    /**
     * Ngôn ngữ hiển thị, đánh khóa theo mã để tra nhanh.
     * Luôn trả ít nhất một ngôn ngữ để bộ chọn cờ không bao giờ rỗng.
     */
    public static function locales()
    {
        $rows = static::json('i18n.locales');

        $out = [];
        foreach ($rows as $row) {
            if (empty($row['code'])) {
                continue;
            }
            $out[$row['code']] = $row + ['label' => $row['code'], 'flag_path' => null];
        }

        if (! $out) {
            $out = ['vi' => ['code' => 'vi', 'label' => 'Tiếng Việt', 'flag_path' => 'assets/imgs/vnflat.png', 'is_default' => true]];
        }

        return $out;
    }

    public static function defaultLocale()
    {
        foreach (static::locales() as $code => $locale) {
            if (! empty($locale['is_default'])) {
                return $code;
            }
        }

        $codes = array_keys(static::locales());

        return reset($codes);
    }

    /**
     * Link mạng xã hội.
     *
     * @param  string|null  $slot  'footer' | 'dock' | 'header' — null thì lấy hết
     */
    public static function social($slot = null)
    {
        $rows = static::json('social.links');

        $rows = array_filter($rows, function ($row) use ($slot) {
            if (empty($row['url'])) {
                return false;
            }

            return $slot === null ? true : ! empty($row[$slot]);
        });

        usort($rows, function ($a, $b) {
            return ($a['sort'] ?? 0) <=> ($b['sort'] ?? 0);
        });

        return $rows;
    }
}
