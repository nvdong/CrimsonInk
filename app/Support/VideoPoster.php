<?php

namespace App\Support;

use Illuminate\Support\Facades\Log;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Throwable;

/**
 * Tự cắt một khung hình từ file video làm ảnh bìa (poster).
 *
 * Thay cho việc bắt admin tự upload ảnh bìa trong /admin/media. Dùng
 * pbmedia/laravel-ffmpeg, làm việc qua disk 'public_root' (xem
 * config/filesystems.php) nên nhận thẳng giá trị cột media.path, dạng
 * 'upload/media/2026/10/clip.mp4'.
 *
 * Nguyên tắc: KHÔNG bao giờ ném exception ra ngoài. ffmpeg thiếu binary, file
 * hỏng, codec lạ... đều có thể xảy ra; lúc đó bản ghi media vẫn phải lưu được,
 * chỉ là không có ảnh bìa. Lỗi ghi vào log và trả về trong khóa 'error' để
 * controller báo lại cho admin.
 */
class VideoPoster
{
    /** Disk trỏ vào public/ — khai trong config/filesystems.php. */
    const DISK = 'public_root';

    /** Giây lấy khung hình với video đủ dài. Giây 0 thường là frame đen. */
    const FRAME_AT = 1.0;

    /**
     * @return array{poster_path: string|null, duration_seconds: int|null, error: string|null}
     */
    public static function generate(string $videoPath): array
    {
        $out = ['poster_path' => null, 'duration_seconds' => null, 'error' => null];

        $videoPath = ltrim($videoPath, '/');

        if (! is_file(public_path($videoPath))) {
            $out['error'] = 'Không tìm thấy file video trong public/ để cắt ảnh bìa: '.$videoPath;

            return $out;
        }

        try {
            $media = FFMpeg::fromDisk(static::DISK)->open($videoPath);

            // getDurationInSeconds() đọc qua ffprobe; video hỏng metadata có
            // thể trả 0 nên phải chặn trước khi dùng làm mốc thời gian.
            $duration = (int) $media->getDurationInSeconds();

            // Video ngắn hơn 2 giây thì lấy khung ở giữa, không thì giây thứ 1.
            $second = $duration >= 2 ? static::FRAME_AT : max(0, $duration / 2);

            $posterPath = static::posterPathFor($videoPath);

            $media->getFrameFromSeconds($second)
                  ->export()
                  ->toDisk(static::DISK)
                  ->save($posterPath);

            // ffmpeg có thể kết thúc mà không ghi được file (hết dung lượng,
            // không có quyền ghi). Kiểm tra lại thay vì tin vào việc không có
            // exception, kẻo lưu vào DB một đường dẫn trỏ tới hư không.
            if (! is_file(public_path($posterPath))) {
                $out['error'] = 'ffmpeg chạy xong nhưng không tạo ra file ảnh bìa.';

                return $out;
            }

            $out['poster_path']      = $posterPath;
            $out['duration_seconds'] = $duration ?: null;
        } catch (Throwable $e) {
            Log::error('VideoPoster: không cắt được ảnh bìa cho '.$videoPath.' — '.$e->getMessage());

            $out['error'] = 'Không tạo được ảnh bìa tự động: '.$e->getMessage();
        }

        return $out;
    }

    /**
     * Ảnh bìa nằm cạnh file video, cùng tên, thêm hậu tố -poster.
     *   upload/media/2026/10/clip.mp4 -> upload/media/2026/10/clip-poster.jpg
     */
    public static function posterPathFor(string $videoPath): string
    {
        $dir  = trim(pathinfo($videoPath, PATHINFO_DIRNAME), '.');
        $name = pathinfo($videoPath, PATHINFO_FILENAME);

        return ltrim(trim($dir, '/').'/'.$name.'-poster.jpg', '/');
    }
}
