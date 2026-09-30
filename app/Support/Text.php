<?php

namespace App\Support;

/**
 * Đọc chuỗi song ngữ khai trong config/constants.php.
 *
 * Chuỗi viết dạng ['vi' => '...', 'en' => '...']; hàm ở đây chọn bản dịch theo
 * app()->getLocale() (do middleware SetLocale đặt từ session khi người dùng
 * bấm lá cờ trên menu).
 *
 * Thứ tự lùi khi thiếu bản dịch: ngôn ngữ đang xem -> app.fallback_locale ->
 * bản dịch đầu tiên có sẵn. Không bao giờ trả chuỗi rỗng ra giao diện.
 */
class Text
{
    /** Một chuỗi: Text::get('booking.form.submit') */
    public static function get($key, $default = null)
    {
        return static::resolve(config('constants.'.$key), $default ?? $key);
    }

    /**
     * Cả một cụm, đã chọn sẵn ngôn ngữ:
     *     $labels = Text::group('booking.form.labels');
     *     $labels['full_name'];
     *
     * Tiện cho view: khỏi gọi Text::get() cho từng ô.
     */
    public static function group($key)
    {
        $rows = config('constants.'.$key);

        if (! is_array($rows)) {
            return [];
        }

        $out = [];
        foreach ($rows as $name => $entry) {
            $out[$name] = static::resolve($entry, $name);
        }

        return $out;
    }

    private static function resolve($entry, $default)
    {
        // Chuỗi thường (không khai song ngữ) thì trả nguyên
        if (! is_array($entry)) {
            return $entry === null || $entry === '' ? $default : $entry;
        }

        foreach ([app()->getLocale(), config('app.fallback_locale')] as $locale) {
            if ($locale && isset($entry[$locale]) && $entry[$locale] !== '') {
                return $entry[$locale];
            }
        }

        foreach ($entry as $value) {
            if (is_string($value) && $value !== '') {
                return $value;
            }
        }

        return $default;
    }
}
