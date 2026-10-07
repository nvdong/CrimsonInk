<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Models\Artist;
use App\Models\Media;
use App\Models\Page;
use App\Models\TattooStyle;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Thư viện ảnh / video (bảng media).
 *
 * Bảng này dùng quan hệ đa hình: mỗi file gắn vào một Trang, một Artist hoặc
 * một Phong cách. Trong form, hai cột mediable_type + mediable_id được gộp
 * thành MỘT ô chọn "Gắn vào" có giá trị dạng "App\Models\Page|7", controller
 * tách ra khi lưu — đỡ phải làm select phụ thuộc bằng JS.
 *
 * type quyết định trường bắt buộc:
 *   image / video -> phải có path (đường dẫn sẵn có hoặc file upload)
 *   embed         -> phải có embed_url (link YouTube/Vimeo)
 */
class MediaController extends Controller
{
    use HandlesUploads;

    public static $types = [
        'image' => 'Ảnh',
        'video' => 'Video (file)',
        'embed' => 'Video nhúng (YouTube/Vimeo)',
    ];

    public static $collections = [
        'gallery'      => 'Thư viện ảnh',
        'portfolio'    => 'Portfolio artist',
        'before_after' => 'Trước / sau',
    ];

    public static $owners = [
        'App\Models\Page'        => 'Trang',
        'App\Models\Artist'      => 'Artist',
        'App\Models\TattooStyle' => 'Phong cách',
    ];

    private $media;

    public function __construct(Media $media)
    {
        $this->media = $media;
    }

    public function index(Request $request)
    {
        $uri = 'media';
        $requestData = $request->all();

        $query = $this->media->orderBy('mediable_type')->orderBy('mediable_id')
            ->orderBy('sort_order')->orderBy('id');

        if (($type = $request->input('type')) !== null && $type !== '') {
            $query->where('type', $type);
        }

        if (($collection = $request->input('collection')) !== null && $collection !== '') {
            $query->where('collection', $collection);
        }

        if (($owner = $request->input('mediable_type')) !== null && $owner !== '') {
            $query->where('mediable_type', $owner);
        }

        if ($keyword = $request->input('alt')) {
            $query->where(function ($q) use ($keyword) {
                $q->where('alt_vi', 'like', '%'.$keyword.'%')
                  ->orWhere('alt_en', 'like', '%'.$keyword.'%')
                  ->orWhere('path', 'like', '%'.$keyword.'%');
            });
        }

        if (($active = $request->input('is_active')) !== null && $active !== '') {
            $query->where('is_active', (int) $active);
        }

        $media = $query->paginate(24);

        // nhãn chủ sở hữu, nạp sẵn để không query trong vòng lặp view
        $ownerLabels = $this->ownerLabels();

        $types       = static::$types;
        $collections = static::$collections;
        $owners      = static::$owners;

        return view('admin.media.index', compact(
            'uri', 'media', 'requestData', 'types', 'collections', 'owners', 'ownerLabels'
        ));
    }

    public function create(Request $request)
    {
        $item = $this->media->newInstance([
            'type'       => 'image',
            'collection' => 'gallery',
            'is_active'  => true,
        ]);

        return view('admin.media.create', $this->formData($item));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['path']        = $this->storeUpload($request, 'file', 'media', $data['path'] ?? null);
        $data['poster_path'] = $this->storeUpload($request, 'poster_file', 'media', $data['poster_path'] ?? null);

        if ($error = $this->checkSource($data)) {
            return redirect()->back()->withInput()->with('error', $error);
        }
        unset($data['file']);

        $this->media->create($data);

        return redirect()->route('admin.media')->with('success', 'Đã thêm file mới');
    }

    public function edit(Request $request)
    {
        $item = $this->media->findOrFail($request->id);

        return view('admin.media.edit', $this->formData($item));
    }

    public function update(Request $request)
    {
        $item = $this->media->findOrFail($request->id);

        $data = $this->validated($request);

        $data['path']        = $this->storeUpload($request, 'file', 'media', $data['path'] ?? null);
        $data['poster_path'] = $this->storeUpload($request, 'poster_file', 'media', $data['poster_path'] ?? null);

        if ($error = $this->checkSource($data)) {
            return redirect()->back()->withInput()->with('error', $error);
        }

        if ($item->update($data)) {
            return redirect()->route('admin.media')->with('success', 'Cập nhật thành công');
        }

        return redirect()->back()->with('error', 'Cập nhật không thành công');
    }

    public function delete(Request $request)
    {
        $item = $this->media->findOrFail($request->id);
        $item->delete();

        return redirect()->route('admin.media')
            ->with('success', 'Đã xóa bản ghi. File trong public/upload vẫn còn, xóa tay nếu cần.');
    }

    private function formData(Media $item)
    {
        return [
            'uri'         => 'media',
            'item'        => $item,
            'types'       => static::$types,
            'collections' => static::$collections,
            'ownerList'   => $this->ownerOptions(),
            'artists'     => Artist::orderBy('sort_order')->get(),
            'styles'      => TattooStyle::orderBy('sort_order')->get(),
        ];
    }

    /** Danh sách chọn "Gắn vào", gom theo loại, value dạng "Class|id". */
    private function ownerOptions()
    {
        $out = [];

        foreach (Page::orderBy('sort_order')->get() as $row) {
            $out['Trang']['App\Models\Page|'.$row->id] = $row->title_vi.' ('.$row->slug.')';
        }

        foreach (Artist::withTrashed()->orderBy('sort_order')->get() as $row) {
            $out['Artist']['App\Models\Artist|'.$row->id] = $row->name_vi;
        }

        foreach (TattooStyle::withTrashed()->orderBy('sort_order')->get() as $row) {
            $out['Phong cách']['App\Models\TattooStyle|'.$row->id] = $row->name_vi;
        }

        return $out;
    }

    /** ['App\Models\Page|7' => 'Trang: Thư viện ảnh'] để in ra cột "Gắn vào". */
    private function ownerLabels()
    {
        $labels = [];

        foreach ($this->ownerOptions() as $group => $rows) {
            foreach ($rows as $key => $label) {
                $labels[$key] = $group.': '.$label;
            }
        }

        return $labels;
    }

    /** image/video cần path, embed cần embed_url. */
    private function checkSource(array $data)
    {
        if ($data['type'] === 'embed' && empty($data['embed_url'])) {
            return 'Loại "Video nhúng" phải có link nhúng.';
        }

        if ($data['type'] !== 'embed' && empty($data['path'])) {
            return 'Loại "'.static::$types[$data['type']].'" phải có đường dẫn file hoặc chọn file để tải lên.';
        }

        return null;
    }

    private function validated(Request $request)
    {
        $data = $request->validate([
            'owner'            => ['required', 'string'],
            'collection'       => ['required', Rule::in(array_keys(static::$collections))],
            'type'             => ['required', Rule::in(array_keys(static::$types))],
            'file'             => ['nullable'],
            'path'             => ['nullable', 'string', 'max:255'],
            'poster_path'      => ['nullable', 'string', 'max:255'],
            'embed_url'        => ['nullable', 'url', 'max:255'],
            'alt_en'           => ['nullable', 'string', 'max:190'],
            'alt_vi'           => ['nullable', 'string', 'max:190'],
            'caption_en'       => ['nullable', 'string', 'max:255'],
            'caption_vi'       => ['nullable', 'string', 'max:255'],
            'width'            => ['nullable', 'integer', 'min:0', 'max:65535'],
            'height'           => ['nullable', 'integer', 'min:0', 'max:65535'],
            'duration_seconds' => ['nullable', 'integer', 'min:0'],
            'artist_id'        => ['nullable', 'integer'],
            'tattoo_style_id'  => ['nullable', 'integer'],
            'sort_order'       => ['nullable', 'integer'],
        ], [], [
            'owner'      => 'mục gắn vào',
            'collection' => 'bộ sưu tập',
            'type'       => 'loại',
        ]);

        // tách "App\Models\Page|7" thành 2 cột
        list($type, $id) = array_pad(explode('|', $data['owner'], 2), 2, null);
        unset($data['owner']);

        $data['mediable_type']   = $type;
        $data['mediable_id']     = (int) $id;
        // ?? chứ không phải ?: — hai ô này là nullable, không gửi lên thì validate
        // không đưa key vào $data và $data['artist_id'] bắn "Undefined index".
        $data['artist_id']       = ($data['artist_id'] ?? null) ?: null;
        $data['tattoo_style_id'] = ($data['tattoo_style_id'] ?? null) ?: null;
        $data['is_active']       = $request->boolean('is_active');
        $data['sort_order']      = $data['sort_order'] ?? 0;

        return $data;
    }
}
