<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Concerns\ManagesAttachedMedia;
use App\Models\Media;
use App\Models\TattooStyle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Quản lý phong cách xăm (bảng tattoo_styles).
 *
 * has_detail_page = 1 thì style có trang riêng tại /tattoo-styles/{slug},
 * dùng chung view pages.tattoo-styles.show. Không cần khai route riêng nữa —
 * cột route_name chỉ còn là ghi chú, không tham gia dựng URL.
 */
class TattooStyleController extends Controller
{
    use HandlesUploads;
    use ManagesAttachedMedia;

    private $style;

    public function __construct(TattooStyle $style)
    {
        $this->style = $style;
    }

    public function index(Request $request)
    {
        $uri = 'style';
        $requestData = $request->all();

        $query = $this->style->orderBy('sort_order')->orderBy('id');

        if ($request->input('trashed') === '1') {
            $query->onlyTrashed();
        }

        if ($name = $request->input('name')) {
            $query->where(function ($q) use ($name) {
                $q->where('name_vi', 'like', '%'.$name.'%')
                  ->orWhere('name_en', 'like', '%'.$name.'%')
                  ->orWhere('slug', 'like', '%'.$name.'%');
            });
        }

        if (($featured = $request->input('is_featured')) !== null && $featured !== '') {
            $query->where('is_featured', (int) $featured);
        }

        if (($active = $request->input('is_active')) !== null && $active !== '') {
            $query->where('is_active', (int) $active);
        }

        $styles = $query->paginate(20);

        return view('admin.style.index', compact('uri', 'styles', 'requestData'));
    }

    public function create(Request $request)
    {
        $style = $this->style->newInstance([
            'is_active'       => true,
            'is_featured'     => true,
            'has_detail_page' => false,
        ]);

        return view('admin.style.create', [
            'uri'             => 'style',
            'style'           => $style,
            'images'          => collect(),
            'mediaMaxKb'      => static::$mediaMaxKb,
            'mediaVideoMaxKb' => static::$mediaVideoMaxKb,
            'mediaTotalMaxKb' => static::$mediaTotalMaxKb,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['cover_path'] = $this->storeUpload($request, 'cover_file', 'style', $data['cover_path'] ?? null);

        // create() rồi mới sync được: media gắn theo id nên lúc này mới có id.
        $style = $this->style->create($data);

        $mediaError = $this->syncImages($request, $style);

        return $this->backToList('Đã thêm phong cách mới', $mediaError);
    }

    public function edit(Request $request)
    {
        $style = $this->style->withTrashed()->findOrFail($request->id);

        return view('admin.style.edit', [
            'uri'        => 'style',
            'style'      => $style,
            'images'          => $this->imagesOf($style),
            'mediaMaxKb'      => static::$mediaMaxKb,
            'mediaVideoMaxKb' => static::$mediaVideoMaxKb,
            'mediaTotalMaxKb' => static::$mediaTotalMaxKb,
        ]);
    }

    public function update(Request $request)
    {
        $style = $this->style->withTrashed()->findOrFail($request->id);

        $data = $this->validated($request, $style->id);
        $data['cover_path'] = $this->storeUpload($request, 'cover_file', 'style', $data['cover_path'] ?? null);

        if ($style->update($data)) {
            $mediaError = $this->syncImages($request, $style);

            return $this->backToList('Cập nhật thành công', $mediaError);
        }

        return redirect()->back()->with('error', 'Cập nhật không thành công');
    }

    public function delete(Request $request)
    {
        $style = $this->style->findOrFail($request->id);
        $name = $style->name_vi;

        $style->delete();

        return redirect()->route('admin.style')
            ->with('success', 'Đã xóa '.$name.'. Vào bộ lọc "Đã xóa" để khôi phục.');
    }

    public function restore(Request $request)
    {
        $style = $this->style->onlyTrashed()->findOrFail($request->id);
        $style->restore();

        return redirect()->route('admin.style')->with('success', 'Đã khôi phục '.$style->name_vi);
    }

    private function validated(Request $request, $ignoreId = null)
    {
        $data = $request->validate([
            'slug'                => ['required', 'string', 'max:120', 'regex:/^[a-z0-9\-]+$/', Rule::unique('tattoo_styles')->ignore($ignoreId)],
            'name_en'             => ['required', 'string', 'max:120'],
            'name_vi'             => ['nullable', 'string', 'max:120'],
            'excerpt_en'          => ['nullable', 'string', 'max:255'],
            'excerpt_vi'          => ['nullable', 'string', 'max:255'],
            'content_en'          => ['nullable', 'string'],
            'content_vi'          => ['nullable', 'string'],
            'cover_path'          => ['nullable', 'string', 'max:255'],
            'route_name'          => ['nullable', 'string', 'max:120'],
            'meta_title_en'       => ['nullable', 'string', 'max:190'],
            'meta_title_vi'       => ['nullable', 'string', 'max:190'],
            'meta_description_en' => ['nullable', 'string', 'max:300'],
            'meta_description_vi' => ['nullable', 'string', 'max:300'],
            'sort_order'          => ['nullable', 'integer'],
        ], [
            'slug.regex' => 'Slug chỉ được dùng chữ thường không dấu, số và dấu gạch ngang.',
        ], [
            'slug'    => 'slug',
            'name_en' => 'tên (EN)',
            'name_vi' => 'tên (VI)',
        ]);

        $data['slug']            = Str::lower($data['slug']);
        $data['has_detail_page'] = $request->boolean('has_detail_page');
        $data['is_featured']     = $request->boolean('is_featured');
        $data['is_active']       = $request->boolean('is_active');
        $data['sort_order']      = $data['sort_order'] ?? 0;

        return $data;
    }

    /** Ảnh minh họa của style — hiện ở /tattoo-styles/{slug}. */
    private function imagesOf(TattooStyle $style)
    {
        return Media::where('tattoo_style_id', $style->id)
            ->orderBy('sort_order')->orderBy('id')
            ->get();
    }

    /**
     * Về danh sách kèm thông báo. Lỗi cắt ảnh bìa hiện CẠNH thông báo lưu
     * thành công — file đã lưu rồi, báo đỏ một mình sẽ làm tưởng là mất dữ liệu.
     */
    private function backToList(string $success, string $mediaError = null)
    {
        $redirect = redirect()->route('admin.style')->with('success', $success);

        if ($mediaError) {
            $redirect->with('error', $mediaError);
        }

        return $redirect;
    }

    /**
     * Panel "Ảnh minh họa" — phần việc chung nằm ở trait ManagesAttachedMedia.
     *
     * Tham số cuối bật nhận video: lưới ở /tattoo-styles/{slug} đã biết render
     * video (nút play + lightbox đọc data-ci-type) nên bật được. Panel của
     * Artist và của Trang vẫn chỉ nhận ảnh.
     */
    private function syncImages(Request $request, TattooStyle $style)
    {
        return $this->syncAttachedMedia($request, $this->imagesOf($style), [
            'mediable_type'   => TattooStyle::class,
            'mediable_id'     => $style->id,
            'tattoo_style_id' => $style->id,
            'collection'      => 'gallery',
            'alt_en'          => $style->name_en.' tattoo at CrimsonInk Tattoo Studio',
            'alt_vi'          => 'Xăm '.$style->name_vi.' tại CrimsonInk Tattoo Studio',
        ], 'style/gallery', true);
    }
}
