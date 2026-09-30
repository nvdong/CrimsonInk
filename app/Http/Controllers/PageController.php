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

/**
 * Các trang nội dung tĩnh.
 *
 * Mỗi method trả về đúng một view trong resources/views/pages.
 * Cần thêm dữ liệu động cho một trang nào đó thì sửa ngay method của trang đó,
 * không ảnh hưởng các trang còn lại.
 */
class PageController extends Controller
{
    public function home(): View
    {
        $page = Page::where('slug','home')->first();
        $tattooStyles = TattooStyle::active()->featured()->ordered()->get();

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
            'sectionReview'=>$sectionReview
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

    public function gallery(): View
    {
        $page = Page::where('slug', 'gallery')->first();

        // Ảnh của trang gallery nằm trong bảng media, gắn vào chính dòng page này
        // (quan hệ đa hình mediable_type/mediable_id, không có FK constraint).
        $media = collect();

        if ($page) {
            $media = Media::active()
                ->collection('gallery')
                ->where('mediable_type', Page::class)
                ->where('mediable_id', $page->id)
                ->ordered()
                ->get();
        }

        return view('pages.gallery', compact('page', 'media'));
    }

    public function contactUs(): View
    {
        return view('pages.contact-us', [
            'artists' => Artist::active()->ordered()->get(),
        ]);
    }

    public function tattooStyles(): View
    {
        return view('pages.tattoo-styles.index');
    }

    public function japaneseTattoos(): View
    {
        return view('pages.tattoo-styles.japanese-tattoos');
    }

    public function realismTattoos(): View
    {
        return view('pages.tattoo-styles.realism-tattoos');
    }

    public function tribalTattoos(): View
    {
        return view('pages.tattoo-styles.tribal-tattoos');
    }

    public function cartoonTattoos(): View
    {
        return view('pages.tattoo-styles.cartoon-tattoos');
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

        // Tác phẩm của artist: bảng media, collection 'portfolio'.
        // Nhận cả 2 cách gắn — artist_id, hoặc mediable_type/mediable_id trỏ vào
        // Artist (cách mà màn Thư viện ảnh dùng). Một dòng chỉ khớp một lần nên
        // orWhere không sinh bản ghi trùng.
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
