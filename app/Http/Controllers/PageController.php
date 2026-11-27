<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Faq;
use App\Models\Media;
use App\Models\Page;
use App\Models\Post;
use App\Models\Review;
use App\Models\TattooStyle;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class PageController extends Controller
{
    /** Số câu FAQ hiện ở khối rút gọn trên trang chủ. */
    const HOME_FAQ_COUNT = 6;

    public function home(): View
    {
        $page = Page::where('slug','home')->first();
        $tattooStyles = TattooStyle::active()->featured()->ordered()->get();

        // Nhập trong admin > Đánh giá khách hàng. Chỉ review đang bật và có
        // tick "Hiện trang chủ" (is_featured) mới lên carousel.
        // newest(): review thêm sau nằm trước, khỏi phải sửa sort_order mỗi lần.
        $clientReviews = Review::active()->featured()->newest()->get();

        $homeArtists    = Artist::active()->featured()->ordered()->get();
        $totalArtists   = Artist::active()->count();
        $hasMoreArtists = $totalArtists > $homeArtists->count();

        $sectionHero = \App\Models\PageSection::where('key','hero')->first();
        $sectionWhychoose = \App\Models\PageSection::where('key','why_choose')->first();
        $sectionArtists = \App\Models\PageSection::where('key','artists')->first();
        $sectionStyles = \App\Models\PageSection::where('key','styles')->first();
        $sectionReview = \App\Models\PageSection::where('key','reviews')->first();
        $sectionFaq    = \App\Models\PageSection::where('key','faq')->first();

        /* FAQ rút gọn cho trang chủ.
         |
         | Khách du lịch Âu-Mỹ sàng studio bằng đúng mấy câu: hết bao nhiêu
         | tiền, đặt cọc thế nào, trả bằng gì, có an toàn không. Trước đây 21
         | câu nằm hết ở /faqs nên trang chủ không trả lời được câu nào.
         |
         | Ưu tiên theo nhóm chứ không theo id, để nhóm giá và đặt lịch luôn
         | lên trước. Bản nháp đã bị loại từ tầng model. */
        $uuTienNhom = ['pricing', 'booking', 'general', 'aftercare'];

        $homeFaqs = Faq::locBanNhap(Faq::active()->ordered()->get())
            ->sortBy(function ($item) use ($uuTienNhom) {
                $thuTu = array_search($item->group, $uuTienNhom, true);

                return ($thuTu === false ? count($uuTienNhom) : $thuTu) * 1000
                    + (int) $item->sort_order;
            })
            ->take(self::HOME_FAQ_COUNT)
            ->values();

        return view('pages.home', [
            'page'=> $page, 
            'tattooStyles'=>$tattooStyles,
            'clientReviews'=>$clientReviews,
            'homeArtists'=>$homeArtists,
            'hasMoreArtists'=>$hasMoreArtists,
            'sectionHero'=>$sectionHero,
            'sectionWhychoose'=>$sectionWhychoose,
            'sectionArtists'=>$sectionArtists,
            'sectionStyles'=>$sectionStyles,
            'sectionReview'=>$sectionReview,
            'sectionFaq'=>$sectionFaq,
            'homeFaqs'=>$homeFaqs,
            'studioRating'=>\App\Support\Settings::get('studio.rating'),
            'studioRatingCount'=>\App\Support\Settings::get('studio.rating_count'),
            'reviewsUrl'=>\App\Support\Settings::get('studio.reviews_url', 'https://maps.app.goo.gl/zjJVxSN8SqzV4162A'),
        ]);
    }

    public function aboutUs(): View
    {
        $page = Page::where('slug', 'about-us')->first();

        // Lưới ảnh cuối trang: bảng media, collection 'gallery', gắn vào chính
        // dòng page này. Sửa ảnh ở admin: Quản lý Trang > about-us > "Ảnh của trang".
        $gallery = collect();

        if ($page) {
            $gallery = Media::active()
                ->collection('gallery')
                ->where('mediable_type', Page::class)
                ->where('mediable_id', $page->id)
                ->ordered()
                ->get();
        }

        return view('pages.about-us', compact('page', 'gallery'));
    }

    public function faqs(): View
    {
        $page = Page::where('slug','faqs')->first();
        /* Bỏ các câu còn chỗ trống chưa điền trước khi groupBy — xem
           Faq::getIsDraftAttribute(). View /faqs dựng luôn schema FAQPage từ
           biến này nên lọc ở đây là lọc được cả hai. */
        $faqs = Faq::locBanNhap(Faq::active()->orderBy('id')->ordered()->get())
            ->groupBy('group');

        return view('pages.faqs', compact('faqs','page'));
    }

    /** Số bài mỗi trang ở /blog. */
    const BLOG_PER_PAGE = 5;

    /** Số bài trong khối "Bài viết mới nhất" / "Bài viết liên quan". */
    const BLOG_SIDEBAR_COUNT = 5;

    /** Danh sách bài viết /blog. */
    public function blog(): View
    {
        $page = Page::where('slug', 'blog')->first();

        $posts = Post::active()
            ->with('category')
            ->newestFirst()
            ->paginate(static::BLOG_PER_PAGE);

        // Query riêng chứ không phải lát cắt của $posts: sang trang 2 thì cột
        // phải vẫn phải là các bài mới nhất.
        $latestPosts = Post::active()
            ->newestFirst()
            ->take(static::BLOG_SIDEBAR_COUNT)
            ->get();

        return view('pages.blog', compact('page', 'posts', 'latestPosts'));
    }

    /** Chi tiết một bài viết /blog/{slug}. */
    public function blogPost(string $slug): View
    {
        $post = Post::active()->with('category')->where('slug', $slug)->first();

        if (! $post) {
            throw new NotFoundHttpException();
        }

        return view('pages.blog-show', [
            'post'         => $post,
            'relatedPosts' => $this->relatedPosts($post),
            'guideLinks'   => $this->blogGuideLinks(),
        ]);
    }

    /**
     * Bài liên quan: ưu tiên cùng danh mục, thiếu thì bù bằng bài mới nhất.
     *
     * Bù như vậy để khối bên phải không bị trống khi một danh mục mới chỉ có
     * một bài — trang chi tiết sẽ hụt hẳn một cột.
     */
    private function relatedPosts(Post $post)
    {
        $limit = static::BLOG_SIDEBAR_COUNT;

        $related = collect();

        if ($post->category_id) {
            $related = Post::active()
                ->where('category_id', $post->category_id)
                ->where('id', '!=', $post->id)
                ->newestFirst()
                ->take($limit)
                ->get();
        }

        if ($related->count() < $limit) {
            $fill = Post::active()
                ->where('id', '!=', $post->id)
                ->whereNotIn('id', $related->pluck('id'))
                ->newestFirst()
                ->take($limit - $related->count())
                ->get();

            $related = $related->concat($fill);
        }

        return $related;
    }

    /**
     * Khối "Những điều cần biết trước khi xăm" ở cột phải.
     *
     * Danh sách cố định, không thuộc bài nào — lưu ở settings (blog.guide_links),
     * sửa trong admin > Cấu hình website > nhóm Blog.
     */
    private function blogGuideLinks()
    {
        $rows = \App\Support\Settings::json('blog.guide_links');

        $out = [];

        foreach ($rows as $row) {
            if (! empty($row['label'])) {
                $out[] = [
                    'label' => $row['label'],
                    'url'   => $row['url'] ?? '#',
                ];
            }
        }

        return $out;
    }

    public function gallery(): View
    {
        $page = Page::where('slug', 'gallery')->first();

        $covers = Media::active()
            ->whereNotNull('tattoo_style_id')
            ->where('type', 'image')
            ->whereNotNull('path')
            ->orderBy('sort_order')->orderBy('id')
            ->get()
            ->unique('tattoo_style_id')
            ->keyBy('tattoo_style_id');

        $styles = $covers->isEmpty()
            ? collect()
            : TattooStyle::active()->ordered()->whereIn('id', $covers->keys())->get();

        return view('pages.gallery', compact('page', 'styles', 'covers'));
    }

    public function contactUs(): View
    {
        return view('pages.contact-us', [
            'artists' => Artist::active()->ordered()->get(),
        ]);
    }

    public function tattooStyles(): View
    {
        $page = Page::where('slug','tattoo-styles')->first();
        // Liệt kê mọi style đang bật (có sort_order) chứ không chỉ has_detail_page = 1:
        // trang chi tiết của style nào cũng truy cập được nên bỏ sót dòng nào là
        // bỏ trang đó thành mồ côi. Xem thêm TattooStyle::getUrlAttribute().
        $tattooStyles = TattooStyle::active()->ordered()->get();
        return view('pages.tattoo-styles.index', compact('page','tattooStyles'));
    }

    public function tattooStyle(string $slug): View
    {
        $style = TattooStyle::active()->where('slug', $slug)->first();

        if (! $style) {
            throw new NotFoundHttpException();
        }
        $medias = Media::active()->where('tattoo_style_id', $style->id)->ordered()->get();
        return view('pages.tattoo-styles.show', compact('style', 'medias'));
    }

    public function artists(): View
    {
        return view('pages.artists.index', [
            'artists' => Artist::active()->ordered()->get(),
        ]);
    }

    public function artist(string $slug): View
    {
        $artist = Artist::active()->where('slug', $slug)->first();

        if (! $artist) {
            throw new NotFoundHttpException();
        }

        $works = Media::active()
            ->collection('portfolio')
            ->where(function ($q) use ($artist) {
                $q->where('artist_id', $artist->id)
                  ->orWhere(function ($q2) use ($artist) {
                      $q2->where('mediable_type', Artist::class)
                         ->where('mediable_id', $artist->id);
                  });
            })
            ->ordered()
            ->get();

        return view('pages.artists.show', compact('artist', 'works'));
    }

}
