<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Concerns\ManagesAttachedMedia;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Quản lý các trang nội dung (bảng pages) và các block của trang (page_sections).
 *
 * Tên là PageContentController chứ không phải PageController vì tên đó đã dùng
 * cho controller hiển thị trang ngoài site.
 *
 * MỘT LẦN LƯU = LƯU CẢ TRANG VÀ CÁC BLOCK. Block gửi lên dạng mảng
 * sections[<i>][...]; dòng nào tick "Xóa block" thì bị xóa, dòng mới (không có
 * id) thì tạo mới. Dòng không gửi lên KHÔNG bị đụng tới.
 */
class PageContentController extends Controller
{
    use HandlesUploads;
    use ManagesAttachedMedia;

    public static $types = [
        'page'    => 'Trang nội dung',
        'service' => 'Dịch vụ',
        'landing' => 'Trang đích',
    ];

    public static $templates = [
        'default' => 'Mặc định',
        'home'    => 'Trang chủ',
        'gallery' => 'Thư viện ảnh',
        'booking' => 'Đặt lịch',
    ];

    /** Loại block — phải khớp với loại mà blade biết render. */
    public static $sectionTypes = [
        'hero'            => 'Hero (đầu trang)',
        'rich_text'       => 'Đoạn nội dung',
        'styles_carousel' => 'Carousel phong cách',
        'artists_list'    => 'Danh sách artist',
        'reviews'         => 'Đánh giá khách hàng',
        'gallery'         => 'Thư viện ảnh',
        'faq'             => 'Câu hỏi thường gặp',
        'cta'             => 'Nút kêu gọi hành động',
    ];

    private $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function index(Request $request)
    {
        $uri = 'page';
        $requestData = $request->all();

        $query = $this->page->withCount('sections')->orderBy('sort_order')->orderBy('id');

        if ($slug = $request->input('slug')) {
            $query->where('slug', 'like', '%'.$slug.'%');
        }

        if ($title = $request->input('title')) {
            $query->where(function ($q) use ($title) {
                $q->where('title_vi', 'like', '%'.$title.'%')
                  ->orWhere('title_en', 'like', '%'.$title.'%');
            });
        }

        if (($type = $request->input('type')) !== null && $type !== '') {
            $query->where('type', $type);
        }

        if (($active = $request->input('is_active')) !== null && $active !== '') {
            $query->where('is_active', (int) $active);
        }

        $pages = $query->paginate(20);
        $types = static::$types;

        return view('admin.page.index', compact('uri', 'pages', 'requestData', 'types'));
    }

    public function create(Request $request)
    {
        $page = $this->page->newInstance([
            'type'      => 'page',
            'template'  => 'default',
            'is_active' => true,
        ]);

        return view('admin.page.create', $this->formData($page));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['hero_image_path'] = $this->storeUpload($request, 'hero_image_file', 'page', $data['hero_image_path'] ?? null);
        $data['og_image_path']   = $this->storeUpload($request, 'og_image_file', 'page', $data['og_image_path'] ?? null);

        $page = $this->page->create($data);

        $errors = $this->syncSections($request, $page);

        return redirect()->route('admin.page.edit', $page->id)
            ->with($errors ? 'error' : 'success', $errors
                ? 'Đã tạo trang, nhưng có block chưa lưu được:<br>'.implode('<br>', $errors)
                : 'Đã thêm trang mới');
    }

    public function edit(Request $request)
    {
        $page = $this->page->with('sections')->findOrFail($request->id);

        return view('admin.page.edit', $this->formData($page));
    }

    public function update(Request $request)
    {
        $page = $this->page->findOrFail($request->id);

        $data = $this->validated($request, $page->id);

        $data['hero_image_path'] = $this->storeUpload($request, 'hero_image_file', 'page', $data['hero_image_path'] ?? null);
        $data['og_image_path']   = $this->storeUpload($request, 'og_image_file', 'page', $data['og_image_path'] ?? null);

        $page->update($data);

        $errors = $this->syncSections($request, $page);

        $this->syncAttachedMedia($request, $this->galleryOf($page), [
            'mediable_type' => Page::class,
            'mediable_id'   => $page->id,
            'collection'    => 'gallery',
            'alt_en'        => 'CrimsonInk Tattoo Studio',
            'alt_vi'        => 'CrimsonInk Tattoo Studio',
        ], 'page/gallery');

        if ($errors) {
            return redirect()->route('admin.page.edit', $page->id)
                ->with('error', 'Đã lưu trang, nhưng có block chưa lưu được:<br>'.implode('<br>', $errors));
        }

        return redirect()->route('admin.page.edit', $page->id)->with('success', 'Cập nhật thành công');
    }

    public function delete(Request $request)
    {
        $page = $this->page->findOrFail($request->id);

        $mediaCount = $page->media()->count();

        if ($mediaCount > 0) {
            return redirect()->route('admin.page')
                ->with('error', 'Không xóa được: trang "'.$page->slug.'" đang có '.$mediaCount.' ảnh gắn kèm. Xóa ảnh trước, hoặc tắt trang thay vì xóa.');
        }

        $slug = $page->slug;
        $page->sections()->delete();
        $page->delete();

        return redirect()->route('admin.page')->with('success', 'Đã xóa trang '.$slug);
    }

    /**
     * Tạo sẵn bộ block chuẩn cho template của trang, điền đúng chữ đang
     * hardcode trong blade. Chỉ thêm block còn thiếu, không đụng block đã có.
     */
    public function scaffoldSections(Request $request)
    {
        $page = $this->page->findOrFail($request->id);

        $presets = $this->sectionPresets($page->template);

        if (! $presets) {
            return redirect()->route('admin.page.edit', $page->id)
                ->with('error', 'Template "'.$page->template.'" chưa có bộ block mẫu.');
        }

        $existing = $page->sections()->pluck('key')->all();
        $added = 0;

        foreach ($presets as $i => $preset) {
            if (in_array($preset['key'], $existing, true)) {
                continue;
            }

            $page->sections()->create($preset + [
                'is_active'  => true,
                'sort_order' => ($i + 1) * 10,
            ]);

            $added++;
        }

        return redirect()->route('admin.page.edit', $page->id)
            ->with('success', $added ? 'Đã tạo '.$added.' block mẫu.' : 'Trang đã có đủ block mẫu, không thêm gì.');
    }

    // ---------------------------------------------------------------- blocks

    /**
     * Đồng bộ block gửi lên với DB. Trả về mảng lỗi của những dòng không lưu
     * được; các dòng còn lại vẫn lưu bình thường.
     */
    private function syncSections(Request $request, Page $page)
    {
        $rows = $request->input('sections', []);

        if (! is_array($rows)) {
            return [];
        }

        $existing = $page->sections()->get()->keyBy('id');
        $seenKeys = [];
        $errors = [];

        foreach ($rows as $i => $row) {
            $id = isset($row['id']) && $row['id'] !== '' ? (int) $row['id'] : null;
            $current = $id ? $existing->get($id) : null;

            if (! empty($row['_destroy'])) {
                if ($current) {
                    $current->delete();
                }
                continue;
            }

            $key = Str::slug(trim($row['key'] ?? ''), '_');

            if ($key === '') {
                continue; // dòng để trống -> bỏ qua, không tính là lỗi
            }

            if (isset($seenKeys[$key])) {
                $errors[] = 'Block "'.$key.'": khóa bị trùng trong cùng một trang.';
                continue;
            }

            $seenKeys[$key] = true;

            $settings = null;

            if (isset($row['settings']) && trim($row['settings']) !== '') {
                $settings = json_decode($row['settings'], true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    $errors[] = 'Block "'.$key.'": JSON không hợp lệ ('.json_last_error_msg().').';
                    continue;
                }
            }

            $type = isset(static::$sectionTypes[$row['type'] ?? '']) ? $row['type'] : 'rich_text';

            $data = [
                'key'           => $key,
                'type'          => $type,
                'eyebrow_en'    => $this->nullable($row, 'eyebrow_en'),
                'eyebrow_vi'    => $this->nullable($row, 'eyebrow_vi'),
                'heading_en'    => $this->nullable($row, 'heading_en'),
                'heading_vi'    => $this->nullable($row, 'heading_vi'),
                'subheading_en' => $this->nullable($row, 'subheading_en'),
                'subheading_vi' => $this->nullable($row, 'subheading_vi'),
                'body_en'       => $this->nullable($row, 'body_en'),
                'body_vi'       => $this->nullable($row, 'body_vi'),
                'cta_label_en'  => $this->nullable($row, 'cta_label_en'),
                'cta_label_vi'  => $this->nullable($row, 'cta_label_vi'),
                'cta_route'     => $this->nullable($row, 'cta_route'),
                'cta_url'       => $this->nullable($row, 'cta_url'),
                'settings'      => $settings,
                'is_active'     => ! empty($row['is_active']),
                'sort_order'    => (int) ($row['sort_order'] ?? 0),
            ];

            $data['image_path'] = $this->storeUpload(
                $request, 'sections.'.$i.'.image_file', 'page', $this->nullable($row, 'image_path')
            );

            $data['background_path'] = $this->storeUpload(
                $request, 'sections.'.$i.'.background_file', 'page', $this->nullable($row, 'background_path')
            );

            if ($current) {
                $current->update($data);
            } else {
                $page->sections()->create($data);
            }
        }

        return $errors;
    }

    private function nullable(array $row, $field)
    {
        $value = $row[$field] ?? null;

        return ($value === null || $value === '') ? null : $value;
    }

    /** Bộ block mẫu theo template, chữ lấy đúng từ blade đang chạy. */
    private function sectionPresets($template)
    {
        $presets = [
            'home' => [
                ['key' => 'hero', 'type' => 'hero',
                 'eyebrow_en' => 'Welcome to', 'eyebrow_vi' => 'Chào mừng đến với',
                 'heading_en' => 'Tattoo Studio in Hanoi', 'heading_vi' => 'Tiệm xăm tại Hà Nội'],

                ['key' => 'why_choose', 'type' => 'rich_text',
                 'eyebrow_en' => 'MORE THAN TATTOOS', 'eyebrow_vi' => 'HƠN CẢ MỘT HÌNH XĂM',
                 'heading_en' => 'Why Choose Crimson Ink', 'heading_vi' => 'Vì sao chọn Crimson Ink',
                 'cta_label_en' => 'Book an appointment', 'cta_label_vi' => 'Đặt lịch xăm',
                 'cta_route' => 'page.contact-us'],

                ['key' => 'styles', 'type' => 'styles_carousel',
                 'eyebrow_en' => 'Explore Our', 'eyebrow_vi' => 'Khám phá',
                 'heading_en' => 'Tattoo Styles', 'heading_vi' => 'Phong cách xăm',
                 'cta_label_en' => 'View all', 'cta_label_vi' => 'Xem tất cả',
                 'cta_route' => 'page.tattoo-styles'],

                ['key' => 'artists', 'type' => 'artists_list',
                 'eyebrow_en' => 'Meet Our', 'eyebrow_vi' => 'Gặp gỡ',
                 'heading_en' => 'Professional Tattoo Artists', 'heading_vi' => 'Đội ngũ artist chuyên nghiệp',
                 'cta_label_en' => 'View all artists', 'cta_label_vi' => 'Xem tất cả artist',
                 'cta_route' => 'page.artists'],

                ['key' => 'reviews', 'type' => 'reviews',
                 'eyebrow_en' => 'Real experiences', 'eyebrow_vi' => 'Trải nghiệm thật',
                 'heading_en' => 'My Happy Clients!', 'heading_vi' => 'Khách hàng của chúng tôi',
                 'cta_label_en' => 'Read more reviews', 'cta_label_vi' => 'Xem thêm đánh giá'],
            ],

            'gallery' => [
                ['key' => 'gallery', 'type' => 'gallery',
                 'heading_en' => 'Gallery', 'heading_vi' => 'Thư viện ảnh'],
            ],

            'booking' => [
                ['key' => 'hero', 'type' => 'hero',
                 'heading_en' => 'Book Your Appointment', 'heading_vi' => 'Đặt lịch xăm'],
                ['key' => 'faq', 'type' => 'faq',
                 'heading_en' => 'Frequently Asked Questions', 'heading_vi' => 'Câu hỏi thường gặp'],
            ],

            'default' => [
                ['key' => 'hero', 'type' => 'hero'],
                ['key' => 'content', 'type' => 'rich_text'],
            ],
        ];

        return isset($presets[$template]) ? $presets[$template] : [];
    }

    // ------------------------------------------------------------------ khác

    /** Ảnh của trang (bảng media, collection 'gallery'). */
    private function galleryOf(Page $page)
    {
        return $this->attachedMedia($page, 'gallery');
    }

    private function formData(Page $page)
    {
        return [
            'uri'          => 'page',
            'page'         => $page,
            'gallery'      => $page->exists ? $this->galleryOf($page) : collect(),
            'mediaMaxKb'   => static::$mediaMaxKb,
            'types'        => static::$types,
            'templates'    => static::$templates,
            'sectionTypes' => static::$sectionTypes,
            'routes'       => $this->routeNames(),
        ];
    }

    /** Route đặt tên bắt đầu bằng page. — dùng cho ô chọn nút CTA của block. */
    private function routeNames()
    {
        $names = [];

        foreach (app('router')->getRoutes() as $route) {
            $name = $route->getName();

            if ($name && strpos($name, 'page.') === 0 && strpos($name, '{') === false) {
                $names[$name] = $name;
            }
        }

        ksort($names);

        return $names;
    }

    private function validated(Request $request, $ignoreId = null)
    {
        $data = $request->validate([
            'slug'                => ['required', 'string', 'max:120', 'regex:/^[a-z0-9\-\/]+$/', Rule::unique('pages')->ignore($ignoreId)],
            'type'                => ['required', Rule::in(array_keys(static::$types))],
            'template'            => ['required', 'string', 'max:60'],
            'route_name'          => ['nullable', 'string', 'max:120'],
            'title_en'            => ['required', 'string', 'max:190'],
            'title_vi'            => ['required', 'string', 'max:190'],
            'heading_en'          => ['nullable', 'string', 'max:190'],
            'heading_vi'          => ['nullable', 'string', 'max:190'],
            'body_en'             => ['nullable', 'string'],
            'body_vi'             => ['nullable', 'string'],
            'hero_image_path'     => ['nullable', 'string', 'max:255'],
            'og_image_path'       => ['nullable', 'string', 'max:255'],
            'meta_title_en'       => ['nullable', 'string', 'max:190'],
            'meta_title_vi'       => ['nullable', 'string', 'max:190'],
            'meta_description_en' => ['nullable', 'string', 'max:300'],
            'meta_description_vi' => ['nullable', 'string', 'max:300'],
            'canonical_url'       => ['nullable', 'url', 'max:255'],
            'sort_order'          => ['nullable', 'integer'],
        ], [
            'slug.regex' => 'Slug chỉ được dùng chữ thường không dấu, số, dấu gạch ngang và dấu /.',
        ], [
            'slug'     => 'slug',
            'type'     => 'loại trang',
            'template' => 'giao diện',
            'title_en' => 'tiêu đề (EN)',
            'title_vi' => 'tiêu đề (VI)',
        ]);

        $data['slug']       = Str::lower(trim($data['slug'], '/'));
        $data['noindex']    = $request->boolean('noindex');
        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }
}
