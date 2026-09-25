<?php

namespace App\Http\Controllers;

use App\Models\Artist;
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
        return view('pages.home');
    }

    public function aboutUs(): View
    {
        return view('pages.about-us');
    }

    public function bestTattooStudioBali(): View
    {
        return view('pages.best-tattoo-studio-bali');
    }

    public function piercing(): View
    {
        return view('pages.piercing');
    }

    public function eyebrowsTattoo(): View
    {
        return view('pages.eyebrows-tattoo');
    }

    public function exhibition(): View
    {
        return view('pages.exhibition');
    }

    public function gallery(): View
    {
        return view('pages.gallery');
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

        return view('pages.artists.show', ['artist' => $artist]);
    }

}
