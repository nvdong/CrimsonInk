<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesUploads;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

/**
 * Nhận ảnh người dùng chèn trong trình soạn thảo (summernote) của admin.
 *
 * Mặc định summernote nhúng ảnh thẳng vào HTML dưới dạng base64. Một tấm JPG
 * 2MB thành ~2,7MB chuỗi text nằm trong cột content — bảng posts phình rất
 * nhanh, mỗi lần đọc bài là MySQL phải kéo cả khối đó ra, và HTML trả về cho
 * khách cũng nặng y như vậy (ảnh không cache được, không CDN được).
 *
 * Endpoint này lưu file vào public/upload/<thư mục>/<năm>/<tháng> rồi trả về
 * URL để JS chỉ chèn <img src="...">. Trong DB chỉ còn vài chục ký tự.
 *
 * Trả JSON cho mọi trường hợp (kể cả lỗi) để phía JS xử lý thống nhất.
 */
class EditorUploadController extends Controller
{
    use HandlesUploads;

    /** Dung lượng tối đa mỗi ảnh (KB) — khớp với giới hạn ảnh ở các màn khác. */
    const MAX_KB = 5120;

    /** Chỉ cho các thư mục đã biết, tránh người dùng tự bịa đường dẫn. */
    const FOLDERS = [
        'post'   => 'post/content',
        'page'   => 'page/content',
        'style'  => 'style/content',
        'artist' => 'artist/content',
        'faq'    => 'faq/content',
    ];

    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'file'   => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:'.self::MAX_KB],
                'folder' => ['nullable', 'string'],
            ], [
                'file.required' => 'Chưa chọn ảnh.',
                'file.image'    => 'File gửi lên không phải ảnh.',
                'file.mimes'    => 'Chỉ nhận ảnh jpg, png, gif hoặc webp.',
                'file.max'      => 'Ảnh không được quá '.(self::MAX_KB / 1024).'MB.',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'ok'      => false,
                'message' => $e->validator->errors()->first(),
            ], 422);
        }

        // Khóa lạ thì về thư mục mặc định, không ghép thẳng input vào đường dẫn.
        $folder = self::FOLDERS[$request->input('folder')] ?? self::FOLDERS['post'];

        $paths = $this->storeUploads($request, 'file', $folder);
        $path  = $paths[0] ?? null;

        if (! $path) {
            Log::error('Không lưu được ảnh trong trình soạn thảo, thư mục '.$folder);

            return response()->json([
                'ok'      => false,
                'message' => 'Máy chủ không ghi được file. Thử lại hoặc báo kỹ thuật.',
            ], 500);
        }

        return response()->json([
            'ok'   => true,
            'path' => $path,          // lưu DB nếu cần, vd upload/post/content/2026/11/abc.jpg
            'url'  => asset($path),   // chèn vào thẻ <img src="...">
        ]);
    }
}
