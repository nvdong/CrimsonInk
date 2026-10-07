<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Faq;
use App\Models\Media;
use App\Models\Page;
use App\Models\Review;
use App\Models\TattooStyle;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class PageController extends Controller
{
    public function home(): View
    {
        $page = Page::where('slug','home')->first();
        $tattooStyles = TattooStyle::active()->featured()->ordered()->get();

        // Nhập trong admin > Đánh giá khách hàng. Chỉ review đang bật và có
        // tick "Hiện trang chủ" (is_featured) mới lên carousel.
        $clientReviews = Review::active()->featured()->ordered()->get();

        $homeArtists    = Artist::active()->featured()->ordered()->get();
        $totalArtists   = Artist::active()->count();
        $hasMoreArtists = $totalArtists > $homeArtists->count();

        $sectionHero = \App\Models\PageSection::where('key','hero')->first();
        $sectionWhychoose = \App\Models\PageSection::where('key','why_choose')->first();
        $sectionArtists = \App\Models\PageSection::where('key','artists')->first();
        $sectionStyles = \App\Models\PageSection::where('key','styles')->first();
        $sectionReview = \App\Models\PageSection::where('key','reviews')->first();

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
        $faqs = Faq::active()->orderBy('group')->ordered()->get()->groupBy('group');

        return view('pages.faqs', compact('faqs','page'));
    }

    /**
     * ---------------------------------------------------------------------
     * BẢN DỰNG GIAO DIỆN — dữ liệu bài viết còn cắm cứng ở đây để duyệt bố
     * cục trước khi làm database.
     *
     * Khi nối DB: tạo bảng posts (+ post_categories), bỏ hàm này đi và đổi
     *   blog()     -> Post::active()->latest()->paginate(5)
     *   blogPost() -> Post::active()->where('slug', $slug)->firstOrFail()
     * View đọc theo đúng các khóa dưới đây (title, slug, excerpt, image,
     * categories, author, date, updated, body) nên model chỉ cần trả về đủ
     * từng ấy thuộc tính là chạy, không phải sửa Blade.
     * ---------------------------------------------------------------------
     */
    private function demoPosts()
    {
        $lorem = '<p>Crimson Ink làm việc theo quy trình cố định: tư vấn ý tưởng, phác thảo riêng, chốt bản vẽ rồi mới lên kim. Mọi kim và ống mực đều dùng một lần, mở trước mặt khách.</p>'
            .'<h2>Trước khi đặt lịch</h2>'
            .'<p>Mang theo ảnh tham khảo, kể cả ảnh bạn thấy chưa ưng — nói rõ chỗ nào không thích cũng giúp artist nhiều như nói chỗ bạn thích. Đo sẵn vị trí và kích thước mong muốn để buổi tư vấn đi nhanh hơn.</p>'
            .'<ul><li>Ăn no, ngủ đủ trước buổi xăm</li><li>Không uống rượu bia trong 24 giờ trước đó</li><li>Mặc đồ rộng, dễ để lộ vùng cần xăm</li></ul>'
            .'<h2>Sau khi xăm</h2>'
            .'<p>Giữ màng bọc theo đúng số giờ artist dặn, rửa bằng nước sạch và xà phòng không mùi, thấm khô bằng khăn giấy. Không bóc vảy, không ngâm nước, tránh nắng trực tiếp cho tới khi da liền hẳn.</p>';

        return collect([
            [
                'slug'       => 'huong-dan-xam-hinh-o-viet-nam-2026',
                'title'      => 'Hướng dẫn toàn tập: xăm hình ở Việt Nam năm 2026',
                'excerpt'    => 'Xăm ở Việt Nam cho giá trị thật: giá dễ chịu mà tay nghề cao. Một hình nhỏ có thể bắt đầu từ khoảng 500.000đ, trong khi một mảng kín tay…',
                'image'      => 'assets/images/custom-tattoo-sketch-process-bali-1-768x511.jpg',
                'categories' => ['Cẩm nang xăm & chăm sóc'],
                'author'     => 'Crimson Ink Studio',
                'date'       => '2026-06-02',
                'updated'    => '2026-09-26',
                'takeaways'  => [
                    'Việt Nam có <b>nền văn hóa xăm giàu biểu tượng</b>, từ rồng, sen tới hoa văn Đông Sơn, mỗi mô-típ đều mang lớp nghĩa lịch sử.',
                    '<b>An toàn</b> hoàn toàn trong tầm kiểm soát nếu bạn chọn studio tuân thủ quy trình vô trùng và dùng thiết bị tốt.',
                    'Chất lượng tay nghề ngang tầm quốc tế <b>với mức giá chỉ bằng một phần</b> so với Mỹ và châu Âu.',
                    'Giá phụ thuộc kích thước, độ phức tạp, kinh nghiệm artist và thời gian ngồi máy.',
                    '<b>Hà Nội và Hội An</b> là hai điểm đến hàng đầu, kết hợp được du lịch với một hình xăm kỷ niệm.',
                    'Chọn đúng <b>artist</b> nghĩa là xem portfolio <i>và</i> ảnh hình đã lành, không chỉ ảnh vừa xăm xong.',
                ],
                'body'       => '<p><b>Xăm hình ở Việt Nam</b> mang lại giá trị thật cho khách du lịch: giá dễ chịu đi cùng tay nghề cao. Một hình nhỏ có thể bắt đầu từ khoảng 500.000đ, trong khi những mảng lớn làm riêng vẫn rẻ hơn nhiều so với Mỹ hay châu Âu. Các studio có tiếng như <a href="'.route('page.home').'">Crimson Ink</a> tuân thủ nghiêm ngặt quy trình vô trùng, dùng thiết bị cao cấp và cho ra hình xăm lành đẹp.</p>'
                    .'<p>Bài này đi qua mọi thứ bạn cần biết trước khi xăm ở Việt Nam: <b>tiêu chuẩn vệ sinh và an toàn, giá cả, địa điểm, phong cách phổ biến và cách chọn artist đáng tin</b>. Đọc hết là bạn đủ dữ kiện để quyết định.</p>'
                    .'<figure><img src="'.asset('assets/images/junk-juz-tattoo-artist-bali.jpg').'" alt="Artist Crimson Ink đang làm việc" loading="lazy" /><figcaption>Xăm ở Việt Nam: giá hợp lý, tay nghề cao và quy trình vệ sinh nghiêm ngặt</figcaption></figure>'
                    .'<h2>5 lý do nên xăm ở Việt Nam</h2>'
                    .'<p>Giá hợp lý, artist tay nghề cao, nguồn cảm hứng văn hóa dày và tiêu chuẩn vệ sinh hiện đại — cộng thêm những thành phố dễ đi lại như Hà Nội và Hội An, Việt Nam là nơi lý tưởng để mang về một kỷ niệm đi theo bạn cả đời:</p>'
                    .'<ul>'
                    .'<li><b>Giá dễ chịu</b> so với Mỹ/Anh mà chất lượng không giảm</li>'
                    .'<li><b>Artist tay nghề cao</b>, mạnh về bố cục và nét mảnh</li>'
                    .'<li><b>Cảm hứng văn hóa dày</b> cho những hình xăm mang ý nghĩa Việt</li>'
                    .'<li><b>Tiêu chuẩn vệ sinh hiện đại</b> ở các studio uy tín</li>'
                    .'<li><b>Vị trí thuận tiện</b> ngay trong các trung tâm du lịch</li>'
                    .'</ul>'
                    .'<h2>Giá xăm ở Hà Nội</h2>'
                    .'<p>Không có bảng giá cố định cho mọi hình. Phần lớn studio tính theo buổi hoặc theo bản vẽ, dựa trên bốn yếu tố: kích thước, độ chi tiết, vị trí trên cơ thể và kinh nghiệm của artist. Hình nhỏ đơn sắc thường gọn trong một buổi; một mảng kín tay có thể cần nhiều buổi cách nhau vài tuần để da kịp lành.</p>'
                    .'<p>Hãy hỏi báo giá sau khi đã chốt bản vẽ, đừng hỏi trước — báo giá trước khi có bản vẽ gần như luôn sai.</p>'
                    .'<h2>Cách chọn artist</h2>'
                    .'<p>Xem portfolio là bước đầu, nhưng điều phân biệt artist giỏi với artist chụp ảnh giỏi là <b>ảnh hình đã lành sau vài tháng</b>. Mực nào cũng đẹp lúc vừa xăm xong; chỉ sau khi lành mới lộ ra nét có bị nhòe không, mảng đổ bóng có đều không.</p>'
                    .'<ul>'
                    .'<li>Hỏi xin ảnh hình đã lành của đúng phong cách bạn muốn</li>'
                    .'<li>Xem artist có mạnh ở phong cách đó không, thay vì làm tất cả mọi thứ</li>'
                    .'<li>Đến tận nơi xem studio trước khi đặt cọc</li>'
                    .'</ul>'
                    .'<h2>Chăm sóc sau khi xăm</h2>'
                    .'<p>Hình xăm đẹp hay không, một nửa nằm ở hai tuần đầu sau khi rời ghế. Giữ màng bọc đúng số giờ artist dặn, rửa nhẹ bằng xà phòng không mùi, thấm khô và bôi một lớp mỏng dưỡng ẩm. Không bóc vảy, không ngâm nước, tránh nắng trực tiếp cho tới khi da liền hẳn.</p>',
                'url'        => null,
            ],
            [
                'slug'       => '9-y-tuong-xam-truyen-thong-viet-nam',
                'title'      => '9 ý tưởng xăm truyền thống Việt Nam và nguồn gốc của chúng',
                'excerpt'    => 'Hình xăm truyền thống Việt Nam bắt rễ sâu trong thần thoại, bản sắc văn hóa và thiên nhiên. Những mẫu này thường mang các biểu tượng mạnh như rồng…',
                'image'      => 'assets/images/Japanese-tattoo-3.png',
                'categories' => ['Cẩm nang xăm & chăm sóc', 'Văn hóa'],
                'author'     => 'Crimson Ink Studio',
                'date'       => '2026-03-28',
                'updated'    => '2026-03-28',
                'takeaways'  => [
                    'Rồng, sen và hoa văn Đông Sơn là ba nhóm mô-típ được chọn nhiều nhất.',
                    'Ý nghĩa đi kèm mô-típ thay đổi theo vùng miền, nên hỏi kỹ trước khi chốt bản vẽ.',
                ],
                'body'       => $lorem,
                'url'        => null,
            ],
            [
                'slug'       => 'hinh-xam-bi-chay-mau',
                'title'      => 'Hình xăm bị chảy máu: nguyên nhân, cách xử lý và khi nào cần lo',
                'excerpt'    => 'Hình xăm mới rỉ máu một chút là chuyện bình thường, nhưng thế nào là bình thường và thế nào là đáng lo? Cùng xem các nguyên nhân chính…',
                'image'      => 'assets/images/Realism-tattoo-2.png',
                'categories' => ['Cẩm nang xăm & chăm sóc'],
                'author'     => 'Crimson Ink Studio',
                'date'       => '2025-10-04',
                'updated'    => '2025-10-04',
                'takeaways'  => [
                    'Rỉ dịch hồng nhạt trong 24 giờ đầu là bình thường.',
                    'Máu chảy thành dòng, sưng nóng hoặc sốt là lúc cần gặp bác sĩ, không phải artist.',
                ],
                'body'       => $lorem,
                'url'        => null,
            ],
            [
                'slug'       => 'dam-lai-hinh-xam',
                'title'      => 'Dặm lại hình xăm: khi nào cần và chi phí bao nhiêu',
                'excerpt'    => 'Sau một thời gian, mực có thể nhạt hoặc nét bị nhòe. Dặm lại giúp hình xăm sắc nét như ngày đầu — nhưng không phải lúc nào cũng cần…',
                'image'      => 'assets/images/Tribal-tattoo-2.png',
                'categories' => ['Cẩm nang xăm & chăm sóc'],
                'author'     => 'Crimson Ink Studio',
                'date'       => '2025-10-04',
                'updated'    => '2025-10-04',
                'takeaways'  => [
                    'Phần lớn studio dặm miễn phí lần đầu trong vài tháng đầu sau khi xăm.',
                    'Hình ở bàn tay, bàn chân và khuỷu tay phai nhanh nhất, cần dặm thường xuyên hơn.',
                ],
                'body'       => $lorem,
                'url'        => null,
            ],
            [
                'slug'       => 'xoa-xam-co-dau-khong',
                'title'      => 'Xóa xăm có đau không? Mức độ đau và cách giảm đau',
                'excerpt'    => 'Xóa xăm bằng laser gây cảm giác khác hẳn lúc xăm. Bài này mô tả mức độ đau theo từng vị trí và những cách giảm đau thực sự có tác dụng…',
                'image'      => 'assets/images/Cartoon-tattoo-2.png',
                'categories' => ['Cẩm nang xăm & chăm sóc'],
                'author'     => 'Crimson Ink Studio',
                'date'       => '2025-10-04',
                'updated'    => '2025-10-04',
                'takeaways'  => [
                    'Cảm giác laser gần với búng dây thun hơn là với kim xăm.',
                    'Mỗi liệu trình cần nhiều buổi, cách nhau 6–8 tuần để da hồi phục.',
                ],
                'body'       => $lorem,
                'url'        => null,
            ],
        ])->map(function ($post) {
            // Để dữ liệu mẫu chỉ khai slug, url suy ra một chỗ duy nhất.
            $post['url'] = route('page.blog.show', $post['slug']);

            return $post;
        });
    }

    /** Các link "Những điều cần biết" ở cột phải trang bài viết. */
    private function demoGuideLinks()
    {
        return [
            ['label' => 'Giá xăm ở Hà Nội',        'url' => '#'],
            ['label' => 'Gặp gỡ đội ngũ artist',   'url' => route('page.artists')],
            ['label' => 'Các giai đoạn lành da',   'url' => '#'],
            ['label' => 'Hướng dẫn chăm sóc sau xăm', 'url' => '#'],
            ['label' => 'Vì sao hình xăm bị ngứa?', 'url' => '#'],
        ];
    }

    /** Danh sách bài viết /blog. */
    public function blog(): View
    {
        $page  = Page::where('slug', 'blog')->first();
        $posts = $this->demoPosts();

        // Cột phải "Bài viết mới nhất" — khi có DB thì đây là query riêng,
        // không phải lát cắt của $posts (trang 2 vẫn phải hiện bài mới nhất).
        $latestPosts = $posts->take(5);

        return view('pages.blog', compact('page', 'posts', 'latestPosts'));
    }

    /** Chi tiết một bài viết /blog/{slug}. */
    public function blogPost(string $slug): View
    {
        $posts = $this->demoPosts();
        $post  = $posts->firstWhere('slug', $slug);

        if (! $post) {
            throw new NotFoundHttpException();
        }

        // Cột phải: bài liên quan = các bài khác, mới nhất trước.
        $relatedPosts = $posts->where('slug', '!=', $slug)->take(4)->values();

        return view('pages.blog-show', [
            'post'         => $post,
            'relatedPosts' => $relatedPosts,
            'guideLinks'   => $this->demoGuideLinks(),
        ]);
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
        $tattooStyles = TattooStyle::where('has_detail_page', 1)->where('is_active', 1)->get();
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
