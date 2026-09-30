<?php

namespace App\Http\Controllers\Concerns;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Panel "ảnh đính kèm" dùng chung cho màn sửa Artist và màn sửa Trang.
 *
 * Cặp đôi với view resources/views/admin/_media_panel.blade.php — các ô trong
 * form tên là media_files[] / media_sort[id] / media_delete[].
 *
 * Lớp dùng trait này phải dùng kèm HandlesUploads (cần storeUploads).
 */
trait ManagesAttachedMedia
{
    /**
     * Dung lượng tối đa cho MỘT ảnh, tính bằng KB.
     *
     * Trần thật nằm ở nginx (client_max_body_size, hiện là 1M) và ở PHP
     * (upload_max_filesize / post_max_size) — cả hai đều ngoài project này.
     * Vượt ngưỡng nginx thì request bị chặn TRƯỚC khi tới Laravel: người dùng
     * thấy trang trắng "413 Request Entity Too Large", không phải lỗi validate,
     * và mất hết những gì vừa nhập. Vì vậy panel còn chặn thêm ở trình duyệt.
     *
     * Nới nginx lên (vd 20M) thì sửa đúng số này là xong.
     */
    public static $mediaMaxKb = 900;

    /** Ảnh đang gắn vào một bản ghi, theo quan hệ đa hình. */
    protected function attachedMedia($owner, $collection)
    {
        return Media::where('collection', $collection)
            ->where('mediable_type', get_class($owner))
            ->where('mediable_id', $owner->id)
            ->orderBy('sort_order')->orderBy('id')
            ->get();
    }

    /**
     * Gỡ ảnh đã tick, cập nhật thứ tự, rồi thêm ảnh mới.
     *
     * $owned    : các ảnh hiện có (để lớp gọi tự quyết cách tìm)
     * $defaults : cột dùng chung cho ảnh mới — mediable_type, mediable_id,
     *             collection, và tuỳ nơi thêm artist_id / alt_*
     *
     * Gỡ ảnh chỉ xóa dòng trong bảng media, KHÔNG xóa file trong public/upload —
     * cố ý, để lỡ tay tick nhầm vẫn gắn lại được bằng màn Thư viện ảnh.
     */
    protected function syncAttachedMedia(Request $request, Collection $owned, array $defaults, $folder)
    {
        $request->validate([
            'media_files'   => ['nullable', 'array'],
            'media_files.*' => ['image', 'max:'.static::$mediaMaxKb],
        ], [
            'media_files.*.image' => 'File đính kèm phải là ảnh.',
            'media_files.*.max'   => 'Mỗi ảnh tối đa '.static::$mediaMaxKb.'KB.',
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
            return;
        }

        $sort = (int) $owned->max('sort_order');

        foreach ($paths as $path) {
            $sort += 10;

            Media::create($defaults + [
                'type'       => 'image',
                'path'       => $path,
                'is_active'  => true,
                'sort_order' => $sort,
            ]);
        }
    }
}
