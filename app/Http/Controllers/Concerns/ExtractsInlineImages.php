<?php

namespace App\Http\Controllers\Concerns;

/**
 * Lưới an toàn: moi mọi ảnh base64 còn sót trong HTML ra thành file thật.
 *
 * JS của trình soạn thảo đã chặn đường chèn base64 (xem EditorUploadController),
 * nhưng vẫn còn lối lọt: người dùng copy nguyên khối HTML từ trang khác, hoặc
 * dán từ Word/Google Docs — những chỗ đó mang theo <img src="data:image/...">
 * mà không đi qua callback upload. Nếu để nguyên thì vẫn phình DB như cũ.
 *
 * Hàm này chạy phía server trước khi lưu, nên dù ảnh vào bằng đường nào thì
 * trong DB cũng chỉ còn URL.
 */
trait ExtractsInlineImages
{
    /** Giới hạn mỗi ảnh base64 được phép tách ra (byte). */
    protected static $inlineImageMaxBytes = 8388608; // 8MB

    protected function extractInlineImages($html, $folder)
    {
        // stripos rẻ hơn preg nhiều — đa số bài không có base64, thoát luôn.
        if (! is_string($html) || $html === '' || stripos($html, 'data:image') === false) {
            return $html;
        }

        $dir     = 'upload/'.trim($folder, '/').'/'.date('Y/m');
        $allowed = ['jpeg' => 'jpg', 'jpg' => 'jpg', 'png' => 'png', 'gif' => 'gif', 'webp' => 'webp'];

        $ketQua = preg_replace_callback(
            '#data:image/([a-zA-Z0-9.+-]+);base64,([A-Za-z0-9+/=\s]+)#',
            function ($m) use ($dir, $allowed) {
                $ext = strtolower($m[1]);

                if (! isset($allowed[$ext])) {
                    return $m[0];
                }

                $raw = base64_decode(preg_replace('/\s+/', '', $m[2]), true);

                // Giải mã hỏng, bé bất thường, hoặc quá to -> giữ nguyên, không
                // ghi file rác. Giữ nguyên nghĩa là vẫn còn base64, nhưng thà
                // vậy còn hơn làm hỏng nội dung bài.
                if ($raw === false || strlen($raw) < 32 || strlen($raw) > static::$inlineImageMaxBytes) {
                    return $m[0];
                }

                // Xác minh đúng là ảnh thật chứ không phải file khác đội lốt.
                if (@getimagesizefromstring($raw) === false) {
                    return $m[0];
                }

                if (! is_dir(public_path($dir)) && ! @mkdir(public_path($dir), 0755, true) && ! is_dir(public_path($dir))) {
                    return $m[0];
                }

                $name = 'inline-'.uniqid().'.'.$allowed[$ext];

                if (@file_put_contents(public_path($dir.'/'.$name), $raw) === false) {
                    return $m[0];
                }

                return asset($dir.'/'.$name);
            },
            $html
        );

        // preg trả null khi vượt backtrack_limit (chuỗi base64 cực dài).
        // Trả lại bản gốc để không mất trắng nội dung bài.
        return $ketQua === null ? $html : $ketQua;
    }
}
