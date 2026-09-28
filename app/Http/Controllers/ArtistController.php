<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Models\Artist;
use App\Models\TattooStyle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Quản lý thợ xăm (bảng artists).
 *
 * XÓA LÀ XÓA MỀM. DB không có ràng buộc khóa ngoại, nên xóa cứng một artist sẽ
 * để lại booking và review trỏ vào id không còn tồn tại. Xóa mềm giữ nguyên
 * dữ liệu cũ, ngoài site không hiện nữa, và khôi phục được.
 *
 * is_featured = hiện ở block artist trang chủ. Hết featured thì nút
 * "View all artists" ngoài trang chủ tự ẩn.
 */
class ArtistController extends Controller
{
    use HandlesUploads;

    private $artist;

    public function __construct(Artist $artist)
    {
        $this->artist = $artist;
    }

    public function index(Request $request)
    {
        $uri = 'artist';
        $requestData = $request->all();

        $query = $this->artist->orderBy('sort_order')->orderBy('id');

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

        $artists = $query->paginate(20);

        return view('admin.artist.index', compact('uri', 'artists', 'requestData'));
    }

    public function create(Request $request)
    {
        $artist = $this->artist->newInstance([
            'is_active'   => true,
            'is_featured' => true,
        ]);

        return view('admin.artist.create', $this->formData($artist));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['avatar_path'] = $this->storeUpload($request, 'avatar_file', 'artist', $data['avatar_path'] ?? null);
        $data['cover_path']  = $this->storeUpload($request, 'cover_file', 'artist', $data['cover_path'] ?? null);

        $this->artist->create($data);

        return redirect()->route('admin.artist')->with('success', 'Đã thêm artist mới');
    }

    public function edit(Request $request)
    {
        $artist = $this->artist->withTrashed()->findOrFail($request->id);

        return view('admin.artist.edit', $this->formData($artist));
    }

    public function update(Request $request)
    {
        $artist = $this->artist->withTrashed()->findOrFail($request->id);

        $data = $this->validated($request, $artist->id);

        $data['avatar_path'] = $this->storeUpload($request, 'avatar_file', 'artist', $data['avatar_path'] ?? null);
        $data['cover_path']  = $this->storeUpload($request, 'cover_file', 'artist', $data['cover_path'] ?? null);

        if ($artist->update($data)) {
            return redirect()->route('admin.artist')->with('success', 'Cập nhật thành công');
        }

        return redirect()->back()->with('error', 'Cập nhật không thành công');
    }

    public function delete(Request $request)
    {
        $artist = $this->artist->findOrFail($request->id);
        $name = $artist->name_vi;

        $artist->delete();

        return redirect()->route('admin.artist')
            ->with('success', 'Đã xóa '.$name.'. Dữ liệu vẫn còn, vào bộ lọc "Đã xóa" để khôi phục.');
    }

    public function restore(Request $request)
    {
        $artist = $this->artist->onlyTrashed()->findOrFail($request->id);
        $artist->restore();

        return redirect()->route('admin.artist')->with('success', 'Đã khôi phục '.$artist->name_vi);
    }

    private function formData(Artist $artist)
    {
        return [
            'uri'    => 'artist',
            'artist' => $artist,
            'styles' => TattooStyle::orderBy('sort_order')->orderBy('id')->get(),
        ];
    }

    private function validated(Request $request, $ignoreId = null)
    {
        $data = $request->validate([
            'slug'                => ['required', 'string', 'max:120', 'regex:/^[a-z0-9\-]+$/', Rule::unique('artists')->ignore($ignoreId)],
            'name_en'             => ['required', 'string', 'max:120'],
            'name_vi'             => ['required', 'string', 'max:120'],
            'role_en'             => ['nullable', 'string', 'max:160'],
            'role_vi'             => ['nullable', 'string', 'max:160'],
            'bio_en'              => ['nullable', 'string'],
            'bio_vi'              => ['nullable', 'string'],
            'content_en'          => ['nullable', 'string'],
            'content_vi'          => ['nullable', 'string'],
            'avatar_path'         => ['nullable', 'string', 'max:255'],
            'cover_path'          => ['nullable', 'string', 'max:255'],
            'experience_years'    => ['nullable', 'integer', 'min:0', 'max:80'],
            'tattoo_style_ids'    => ['nullable', 'array'],
            'tattoo_style_ids.*'  => ['integer'],
            'instagram'           => ['nullable', 'url', 'max:255'],
            'facebook'            => ['nullable', 'url', 'max:255'],
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

        // socials gộp 2 ô nhập thành 1 cột json
        $socials = array_filter([
            'instagram' => $data['instagram'] ?? null,
            'facebook'  => $data['facebook'] ?? null,
        ]);
        unset($data['instagram'], $data['facebook']);

        $data['socials']          = $socials ?: null;
        $data['tattoo_style_ids'] = array_map('intval', $data['tattoo_style_ids'] ?? []);
        $data['slug']             = Str::lower($data['slug']);
        $data['is_featured']      = $request->boolean('is_featured');
        $data['is_active']        = $request->boolean('is_active');
        $data['sort_order']       = $data['sort_order'] ?? 0;

        return $data;
    }
}
