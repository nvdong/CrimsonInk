<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Concerns\ManagesAttachedMedia;
use App\Models\Artist;
use App\Models\Media;
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
 *
 * TÁC PHẨM (panel ở màn sửa): lưu vào bảng media, collection 'portfolio',
 * mediable_type/mediable_id trỏ vào Artist và artist_id điền luôn cho dễ query.
 * Panel chỉ có ở màn sửa vì lúc thêm mới chưa có id để gắn ảnh vào.
 */
class ArtistController extends Controller
{
    use HandlesUploads;
    use ManagesAttachedMedia;

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
            $this->syncWorks($request, $artist);

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
            'works'  => $artist->exists ? $this->worksOf($artist) : collect(),
            'mediaMaxKb' => static::$mediaMaxKb,
        ];
    }

    /** Ảnh tác phẩm đang gắn với artist này. */
    private function worksOf(Artist $artist)
    {
        return Media::where('collection', 'portfolio')
            ->where(function ($q) use ($artist) {
                $q->where('artist_id', $artist->id)
                  ->orWhere(function ($q2) use ($artist) {
                      $q2->where('mediable_type', Artist::class)
                         ->where('mediable_id', $artist->id);
                  });
            })
            ->orderBy('sort_order')->orderBy('id')
            ->get();
    }

    /** Panel "Tác phẩm" — phần việc chung nằm ở trait ManagesAttachedMedia. */
    private function syncWorks(Request $request, Artist $artist)
    {
        $this->syncAttachedMedia($request, $this->worksOf($artist), [
            'mediable_type' => Artist::class,
            'mediable_id'   => $artist->id,
            'artist_id'     => $artist->id,
            'collection'    => 'portfolio',
            'alt_en'        => $artist->name_en,
            'alt_vi'        => $artist->name_vi,
        ], 'artist/works');
    }
}
