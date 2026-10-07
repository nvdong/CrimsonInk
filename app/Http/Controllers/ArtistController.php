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


class ArtistController extends Controller
{
    use HandlesUploads;
    use ManagesAttachedMedia;

    private $artist;

    public function __construct(Artist $artist)
    {
        $this->artist = $artist;
    }

    private function validated(Request $request)
    {
        $data = $request->validate([
            'name_en' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'role_en'   => ['nullable', 'string'],
            'slogan_en'   => ['nullable', 'string'],
            'sort_order'  => ['nullable', 'integer'],
            'bio_en'  => ['nullable', 'string'],
            'content_en'  => ['nullable', 'string'],
            'meta_title_en'  => ['nullable', 'string'],
            'meta_description_en'  => ['nullable', 'string'],
            'tattoo_style_ids'=>['nullable'],
            'experience_years'  => ['nullable'],
        ], [], [
            'name_en' => 'Name (EN)',
            'slug' => 'Slug (VI)',
        ]);

        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
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

        $artist = $this->artist->create($data);

        $this->syncWorks($request, $artist);

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

        $data = $this->validated($request);

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
