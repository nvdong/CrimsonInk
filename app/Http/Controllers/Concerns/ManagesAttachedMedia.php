<?php

namespace App\Http\Controllers\Concerns;

use App\Models\Media;
use App\Support\VideoPoster;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Panel "file đính kèm" dùng chung cho màn Artist, Trang và Phong cách.
 *
 * Cặp đôi với view resources/views/admin/_media_panel.blade.php — các ô trong
 * form tên là media_files[] / media_sort[id] / media_delete[].
 *
 * Lớp dùng trait này phải dùng kèm HandlesUploads (cần storeUploads).
 */
trait ManagesAttachedMedia
{
    /**
     * Trần dung lượng, tính bằng KB.
     *
     * Trần THẬT nằm ở nginx (client_max_body_size) và PHP (upload_max_filesize
     * / post_max_size), cả hai đều ngoài project này. Vượt ngưỡng nginx thì
     * request bị chặn TRƯỚC khi tới Laravel: người dùng thấy trang trắng "413
     * Request Entity Too Large", không phải lỗi validate, và mất hết những gì
     * vừa nhập. Vì vậy panel còn chặn thêm ở trình duyệt.
     *
     * $mediaTotalMaxKb phải NHỎ HƠN client_max_body_size của nginx, chừa chỗ
     * cho các field còn lại của form. Đổi nginx thì sửa ba số này cho khớp.
     */
    public static $mediaMaxKb = 5120;        // mỗi ảnh — 5MB

    public static $mediaVideoMaxKb = 51200;  // mỗi video — 50MB

    public static $mediaTotalMaxKb = 92160;  // tổng một lần gửi — 90MB

    /** Định dạng nhận vào. Khóa dùng luôn làm giá trị cột media.type. */
    public static $mediaMimes = [
        'image' => ['image/jpeg', 'image/png', 'image/webp', 'image/gif', 'image/avif'],
        'video' => ['video/mp4', 'video/quicktime', 'video/webm', 'video/x-m4v'],
    ];

    /** File đang gắn vào một bản ghi, theo quan hệ đa hình. */
    protected function attachedMedia($owner, $collection)
    {
        return Media::where('collection', $collection)
            ->where('mediable_type', get_class($owner))
            ->where('mediable_id', $owner->id)
            ->orderBy('sort_order')->orderBy('id')
            ->get();
    }

    /**
     * Gỡ file đã tick, cập nhật thứ tự, rồi thêm file mới.
     *
     * $owned      : các file hiện có (để lớp gọi tự quyết cách tìm)
     * $defaults   : cột dùng chung cho bản ghi mới — mediable_type,
     *               mediable_id, collection, và tuỳ nơi thêm artist_id / alt_*
     * $allowVideo : cho phép upload cả video. Bật ở đâu thì giao diện ngoài
     *               site của chỗ đó phải biết render video — hiện mới có lưới
     *               /tattoo-styles/{slug} (lightbox đọc data-ci-type).
     *
     * Gỡ file chỉ xóa dòng trong bảng media, KHÔNG xóa file trong public/upload —
     * cố ý, để lỡ tay tick nhầm vẫn gắn lại được bằng màn Thư viện ảnh.
     *
     * @return string|null  thông báo lỗi phụ (vd cắt ảnh bìa hỏng), bản ghi vẫn lưu
     */
    protected function syncAttachedMedia(Request $request, Collection $owned, array $defaults, $folder, $allowVideo = false)
    {
        $request->validate([
            'media_files'   => ['nullable', 'array'],
            'media_files.*' => ['file', $this->mediaFileRule($allowVideo)],
        ]);

        $owned = $owned->keyBy('id');

        foreach ((array) $request->input('media_delete', []) as $id) {
            if ($row = $owned->get((int) $id)) {
                $row->delete();
                $owned->forget((int) $id);
            }
        }

        foreach ((array) $request->input('media_sort', []) as $id => $sort) {
            if ($row = $owned->get((int) $id)) {
                $row->update(['sort_order' => (int) $sort]);
            }
        }

        $paths = $this->storeUploads($request, 'media_files', $folder);

        if (! $paths) {
            return null;
        }

        $sort = (int) $owned->max('sort_order');
        $posterErrors = [];

        foreach ($paths as $path) {
            $sort += 10;

            $row = [
                'type'       => static::mediaTypeFor($path),
                'path'       => $path,
                'is_active'  => true,
                'sort_order' => $sort,
            ];

            // Video: cắt ảnh bìa ngay như bên /admin/media. Hỏng thì vẫn tạo
            // bản ghi, chỉ là thiếu poster — panel sẽ hiện ô "VIDEO" thay ảnh.
            if ($row['type'] === 'video') {
                $poster = VideoPoster::generate($path);

                if ($poster['poster_path']) {
                    $row['poster_path'] = $poster['poster_path'];
                }

                if ($poster['duration_seconds']) {
                    $row['duration_seconds'] = $poster['duration_seconds'];
                }

                if ($poster['error']) {
                    $posterErrors[] = basename($path).': '.$poster['error'];
                }
            }

            Media::create($defaults + $row);
        }

        return $posterErrors ? implode('<br>', $posterErrors) : null;
    }

    /**
     * Rule cho từng file: vừa chặn định dạng vừa chặn dung lượng, vì trần của
     * ảnh và của video khác nhau nên không gói gọn trong 'max:' được.
     */
    protected function mediaFileRule($allowVideo)
    {
        return function ($attribute, $value, $fail) use ($allowVideo) {
            if (! $value || ! $value->isValid()) {
                return;
            }

            $mime = (string) $value->getMimeType();
            $name = $value->getClientOriginalName();

            $isImage = in_array($mime, static::$mediaMimes['image'], true);
            $isVideo = $allowVideo && in_array($mime, static::$mediaMimes['video'], true);

            if (! $isImage && ! $isVideo) {
                $fail($allowVideo
                    ? $name.': chỉ nhận ảnh (JPG, PNG, WebP, GIF) hoặc video (MP4, MOV, WebM).'
                    : $name.': chỉ nhận file ảnh.');

                return;
            }

            $maxKb = $isVideo ? static::$mediaVideoMaxKb : static::$mediaMaxKb;

            // getSize() trả byte; so bằng KB cho khớp con số hiện trên giao diện.
            if ($value->getSize() / 1024 > $maxKb) {
                $fail($name.': nặng '.round($value->getSize() / 1048576, 1).'MB, vượt mức '
                    .round($maxKb / 1024).'MB cho một '.($isVideo ? 'video' : 'ảnh').'.');
            }
        };
    }

    /**
     * Suy ra cột media.type từ phần mở rộng của file đã lưu.
     *
     * storeUploads() giữ nguyên phần mở rộng gốc nên cách này đủ tin cậy, và
     * rẻ hơn đọc lại mime của file vừa ghi xuống đĩa.
     */
    public static function mediaTypeFor($path)
    {
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return in_array($ext, ['mp4', 'mov', 'webm', 'm4v'], true) ? 'video' : 'image';
    }
}
