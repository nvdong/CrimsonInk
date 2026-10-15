<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Post;
use App\Models\TattooStyle;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;

/**
 * /sitemap.xml — sinh trực tiếp từ DB, không cần file tĩnh.
 *
 * Mỗi lần thêm style / bài viết / artist trong admin là sitemap tự cập nhật,
 * nên không bao giờ phải nhớ sửa tay. lastmod lấy từ updated_at của record,
 * còn các trang tĩnh thì lấy ngày mới nhất của dữ liệu mà trang đó hiển thị.
 *
 * Lưu ý: bảng posts có thể chưa migrate trên môi trường cũ, nên mọi truy vấn
 * đều bọc Schema::hasTable() — sitemap lỗi 500 còn tệ hơn sitemap thiếu bài.
 */
class SitemapController extends Controller
{
    /** Thứ tự ưu tiên để Google hiểu trang nào quan trọng hơn. */
    const PRIORITY_HOME   = '1.0';
    const PRIORITY_LISTED = '0.8';
    const PRIORITY_DETAIL = '0.7';
    const PRIORITY_STATIC = '0.6';

    public function index(): Response
    {
        $urls = array_merge(
            $this->trangTinh(),
            $this->trangStyle(),
            $this->trangBaiViet(),
            $this->trangArtist()
        );

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    /** Các trang cố định. changefreq là gợi ý, Google không bắt buộc tuân theo. */
    private function trangTinh(): array
    {
        return [
            $this->url(route('page.home'), self::PRIORITY_HOME, 'weekly', $this->moiNhat(TattooStyle::class)),
            $this->url(route('page.tattoo-styles'), self::PRIORITY_LISTED, 'weekly', $this->moiNhat(TattooStyle::class)),
            $this->url(route('page.gallery'), self::PRIORITY_LISTED, 'weekly', $this->moiNhat(TattooStyle::class)),
            $this->url(route('page.artists'), self::PRIORITY_LISTED, 'monthly', $this->moiNhat(Artist::class)),
            $this->url(route('page.blog'), self::PRIORITY_LISTED, 'weekly', $this->moiNhat(Post::class)),
            $this->url(route('page.about-us'), self::PRIORITY_STATIC, 'monthly'),
            $this->url(route('page.faqs'), self::PRIORITY_STATIC, 'monthly'),
            $this->url(route('page.contact-us'), self::PRIORITY_STATIC, 'monthly'),
        ];
    }

    private function trangStyle(): array
    {
        if (! Schema::hasTable('tattoo_styles')) {
            return [];
        }

        return TattooStyle::active()
            ->whereNotNull('slug')
            ->ordered()
            ->get(['slug', 'updated_at'])
            ->map(function (TattooStyle $style) {
                return $this->url(
                    route('page.tattoo-styles.show', $style->slug),
                    self::PRIORITY_DETAIL,
                    'monthly',
                    $style->updated_at
                );
            })
            ->all();
    }

    private function trangBaiViet(): array
    {
        if (! Schema::hasTable('posts')) {
            return [];
        }

        return Post::active()
            ->whereNotNull('slug')
            ->newestFirst()
            ->get(['slug', 'updated_at'])
            ->map(function (Post $post) {
                return $this->url(
                    route('page.blog.show', $post->slug),
                    self::PRIORITY_DETAIL,
                    'monthly',
                    $post->updated_at
                );
            })
            ->all();
    }

    private function trangArtist(): array
    {
        if (! Schema::hasTable('artists')) {
            return [];
        }

        return Artist::active()
            ->whereNotNull('slug')
            ->ordered()
            ->get(['slug', 'updated_at'])
            ->map(function (Artist $artist) {
                return $this->url(
                    route('page.artists.show', $artist->slug),
                    self::PRIORITY_DETAIL,
                    'monthly',
                    $artist->updated_at
                );
            })
            ->all();
    }

    /** Ngày updated_at mới nhất của một model — dùng làm lastmod cho trang danh sách. */
    private function moiNhat(string $model)
    {
        $table = (new $model)->getTable();

        if (! Schema::hasTable($table)) {
            return null;
        }

        return $model::max('updated_at');
    }

    private function url(string $loc, string $priority, string $changefreq, $lastmod = null): array
    {
        return [
            'loc'        => $loc,
            'priority'   => $priority,
            'changefreq' => $changefreq,
            // W3C Datetime — Google chấp nhận cả YYYY-MM-DD và ISO8601 đầy đủ.
            'lastmod'    => $lastmod ? \Illuminate\Support\Carbon::parse($lastmod)->toAtomString() : null,
        ];
    }
}
