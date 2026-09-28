<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Models\Setting;
use App\Support\Settings;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Cấu hình website (bảng settings).
 *
 * Màn hình chính KHÔNG phải danh sách - sửa - lưu từng dòng, mà là một form
 * sửa hàng loạt chia theo nhóm: cấu hình chỉ vài chục dòng, sửa từng dòng một
 * sẽ rất mất công. Vẫn có thêm/xóa dòng cho trường hợp phát sinh khóa mới.
 *
 * Kiểu dữ liệu quyết định ô nhập:
 *   text/number -> input     textarea -> textarea     html -> summernote
 *   bool -> select           json -> textarea (có kiểm tra cú pháp)
 *   image -> ô chọn file, lưu vào public/upload/setting
 */
class SettingController extends Controller
{
    use HandlesUploads;

    /** Nhãn tiếng Việt cho từng nhóm, cũng quyết định thứ tự hiển thị. */
    public static $groups = [
        'studio'  => 'Thông tin studio',
        'i18n'    => 'Ngôn ngữ',
        'social'  => 'Mạng xã hội',
        'seo'     => 'SEO',
        'booking' => 'Đặt lịch',
        'auth'    => 'Đăng nhập',
    ];

    /**
     * Kênh mạng xã hội hỗ trợ. Chỉ liệt kê những kênh mà
     * resources/views/partials/social-icon.blade.php có icon — thêm kênh mới
     * ở đây thì phải thêm một @case tương ứng bên đó, không thì icon bị trống.
     */
    public static $socialPlatforms = [
        'whatsapp'  => 'WhatsApp',
        'instagram' => 'Instagram',
        'facebook'  => 'Facebook',
        'phone'     => 'Điện thoại',
        'email'     => 'Email',
    ];

    public static $socialIcons = [
        'whatsapp'  => 'fab fa-whatsapp',
        'instagram' => 'fab fa-instagram',
        'facebook'  => 'fab fa-facebook-f',
        'phone'     => 'fas fa-phone-alt',
        'email'     => 'fas fa-envelope',
    ];

    public static $types = [
        'text'     => 'Chữ ngắn',
        'textarea' => 'Chữ dài',
        'html'     => 'Nội dung HTML',
        'image'    => 'Ảnh',
        'number'   => 'Số',
        'bool'     => 'Bật / tắt',
        'json'     => 'JSON',
    ];

    private $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function index(Request $request)
    {
        $uri = 'setting';

        $all = $this->setting->orderBy('group')->orderBy('sort_order')->orderBy('key')->get();

        // sắp nhóm theo đúng thứ tự trong $groups, nhóm lạ đẩy xuống cuối
        $grouped = $all->groupBy('group')->sortBy(function ($rows, $group) {
            $order = array_keys(static::$groups);
            $i = array_search($group, $order, true);

            return $i === false ? 999 : $i;
        });

        $groups    = static::$groups;
        $types     = static::$types;
        $platforms = static::$socialPlatforms;

        return view('admin.setting.index', compact('uri', 'grouped', 'groups', 'types', 'platforms'));
    }

    /**
     * Lưu hàng loạt. Dữ liệu gửi lên dạng values[<id>][value|value_en|value_vi].
     * Dòng nào không có trong form thì không đụng tới.
     */
    public function update(Request $request)
    {
        $values = $request->input('values', []);
        $errors = [];

        foreach ($values as $id => $fields) {
            $setting = $this->setting->find($id);

            if (! $setting) {
                continue;
            }

            // JSON sai cú pháp thì bỏ qua dòng đó và báo lại, không lưu rác vào DB
            if ($setting->type === 'json' && isset($fields['value']) && trim($fields['value']) !== '') {
                json_decode($fields['value']);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    $errors[] = $setting->group.'.'.$setting->key.': JSON không hợp lệ ('.json_last_error_msg().')';
                    continue;
                }
            }

            if ($setting->type === 'image') {
                $uploaded = $this->storeUpload($request, 'file_'.$id, 'setting', null);

                if ($uploaded) {
                    $fields['value'] = $uploaded;
                }
            }

            foreach (['value', 'value_en', 'value_vi'] as $column) {
                if (array_key_exists($column, $fields)) {
                    $setting->{$column} = $fields[$column] === '' ? null : $fields[$column];
                }
            }

            $setting->save();
        }

        // social.links dùng trình soạn riêng nên KHÔNG nằm trong values[...] —
        // phải xử lý ngoài vòng lặp, không thì không bao giờ được lưu.
        $this->saveSocialLinks($request);

        Settings::flush();

        if ($errors) {
            return redirect()->route('admin.setting')
                ->with('error', 'Đã lưu, trừ các dòng sau:<br>'.implode('<br>', $errors));
        }

        return redirect()->route('admin.setting')->with('success', 'Cập nhật cấu hình thành công');
    }


    /** Lưu dòng settings social.links từ các ô nhập riêng. */
    private function saveSocialLinks(Request $request)
    {
        if (! $request->has('social_links_present')) {
            return;
        }

        $setting = $this->setting->where('group', 'social')->where('key', 'links')->first();

        if (! $setting) {
            return;
        }

        $setting->value = $this->buildSocialLinks($request);
        $setting->save();
    }

    /**
     * Ghép các ô nhập social_links[] thành chuỗi JSON để lưu vào cột value.
     *
     * Dòng nào bỏ trống Link hoặc chọn kênh không hỗ trợ thì bị loại — như vậy
     * "xóa một kênh" chỉ cần xóa link của nó. Icon suy ra từ kênh, không cho
     * nhập tay để tránh gõ sai class Font Awesome.
     */
    private function buildSocialLinks(Request $request)
    {
        $rows = $request->input('social_links', []);
        $out = [];

        if (is_array($rows)) {
            foreach ($rows as $row) {
                $platform = $row['platform'] ?? '';
                $url = trim($row['url'] ?? '');

                if ($url === '' || ! isset(static::$socialPlatforms[$platform])) {
                    continue;
                }

                $label = trim($row['label'] ?? '');

                $out[] = [
                    'platform' => $platform,
                    'label'    => $label !== '' ? $label : static::$socialPlatforms[$platform],
                    'url'      => $url,
                    'icon'     => static::$socialIcons[$platform] ?? '',
                    'footer'   => ! empty($row['footer']),
                    'dock'     => ! empty($row['dock']),
                    'header'   => ! empty($row['header']),
                    'sort'     => (int) ($row['sort'] ?? 0),
                ];
            }
        }

        usort($out, function ($a, $b) {
            return $a['sort'] <=> $b['sort'];
        });

        return json_encode($out, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
    public function create(Request $request)
    {
        $uri    = 'setting';
        $groups = static::$groups;
        $types  = static::$types;

        return view('admin.setting.create', compact('uri', 'groups', 'types'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'group'      => ['required', 'string', 'max:40'],
            'key'        => ['required', 'string', 'max:80', Rule::unique('settings')->where(function ($q) use ($request) {
                return $q->where('group', $request->input('group'));
            })],
            'type'       => ['required', Rule::in(array_keys(static::$types))],
            'value'      => ['nullable', 'string'],
            'value_en'   => ['nullable', 'string'],
            'value_vi'   => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
        ], [], [
            'group' => 'nhóm',
            'key'   => 'khóa',
            'type'  => 'kiểu dữ liệu',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($data['type'] === 'image') {
            $data['value'] = $this->storeUpload($request, 'file', 'setting', $data['value'] ?? null);
        }

        $this->setting->create($data);

        Settings::flush();

        return redirect()->route('admin.setting')->with('success', 'Đã thêm cấu hình mới');
    }

    public function delete(Request $request)
    {
        $setting = $this->setting->findOrFail($request->id);
        $name = $setting->group.'.'.$setting->key;

        $setting->delete();

        Settings::flush();

        return redirect()->route('admin.setting')->with('success', 'Đã xóa cấu hình '.$name);
    }
}
