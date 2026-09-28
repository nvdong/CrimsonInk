<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PageContentController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\TattooStyleController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\MediaController;
use App\Models\Booking;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Mỗi trang tĩnh = 1 route đặt tên + 1 method trong PageController
| + 1 view riêng trong resources/views/pages.
*/

Route::get('/',                        [PageController::class, 'home'])->name('page.home');
Route::get('/about-us',                [PageController::class, 'aboutUs'])->name('page.about-us');
Route::get('/best-tattoo-studio-bali', [PageController::class, 'bestTattooStudioBali'])->name('page.best-tattoo-studio-bali');
Route::get('/piercing',                [PageController::class, 'piercing'])->name('page.piercing');
Route::get('/eyebrows-tattoo',         [PageController::class, 'eyebrowsTattoo'])->name('page.eyebrows-tattoo');
Route::get('/exhibition',              [PageController::class, 'exhibition'])->name('page.exhibition');
Route::get('/gallery',                 [PageController::class, 'gallery'])->name('page.gallery');
Route::get('/contact-us',              [PageController::class, 'contactUs'])->name('page.contact-us');

Route::get('/artists',         [PageController::class, 'artists'])->name('page.artists');
Route::get('/artists/{slug}',  [PageController::class, 'artist'])->name('page.artists.show');

Route::get('/tattoo-styles',                   [PageController::class, 'tattooStyles'])->name('page.tattoo-styles');
Route::get('/tattoo-styles/japanese-tattoos',  [PageController::class, 'japaneseTattoos'])->name('page.tattoo-styles.japanese-tattoos');
Route::get('/tattoo-styles/realism-tattoos',   [PageController::class, 'realismTattoos'])->name('page.tattoo-styles.realism-tattoos');
Route::get('/tattoo-styles/tribal-tattoos',    [PageController::class, 'tribalTattoos'])->name('page.tattoo-styles.tribal-tattoos');
Route::get('/tattoo-styles/cartoon-tattoos',   [PageController::class, 'cartoonTattoos'])->name('page.tattoo-styles.cartoon-tattoos');

Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');

/* URL cũ bên WordPress -> URL chuẩn (301) */
Route::redirect('/japanese-tattoos-2', '/tattoo-styles/japanese-tattoos', 301);
Route::redirect('/realism-tattoos',    '/tattoo-styles/realism-tattoos', 301);
Route::redirect('/tribal-tattoos',     '/tattoo-styles/tribal-tattoos', 301);
Route::redirect('/cartoon-tattoos',    '/tattoo-styles/cartoon-tattoos', 301);

/* Đổi ngôn ngữ (2 lá cờ trên menu) */
Route::get('/lang/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');


Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'loginStore'])->name('admin.loginStore');
    Route::get('/callback', [LoginController::class, 'callback'])->name('admin.callback');
    Route::get('/logout', [DashboardController::class, 'logout'])->name('admin.logout');

    Route::prefix('booking')->middleware('auth')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('admin.booking');
        Route::post('/store', [BookingController::class, 'store'])->name('admin.booking.store');
        Route::get('/{id}/edit', [BookingController::class, 'edit'])->name('admin.booking.edit');
        Route::post('/update', [BookingController::class, 'update'])->name('admin.booking.update');
    });


    Route::prefix('setting')->middleware('auth')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('admin.setting');
        Route::post('/update', [SettingController::class, 'update'])->name('admin.setting.update');
        Route::get('/create', [SettingController::class, 'create'])->name('admin.setting.create');
        Route::post('/store', [SettingController::class, 'store'])->name('admin.setting.store');
        Route::get('/{id}/delete', [SettingController::class, 'delete'])->name('admin.setting.delete');
    });

    Route::prefix('page')->middleware('auth')->group(function () {
        Route::get('/', [PageContentController::class, 'index'])->name('admin.page');
        Route::get('/create', [PageContentController::class, 'create'])->name('admin.page.create');
        Route::post('/store', [PageContentController::class, 'store'])->name('admin.page.store');
        Route::get('/{id}/edit', [PageContentController::class, 'edit'])->name('admin.page.edit');
        Route::post('/update', [PageContentController::class, 'update'])->name('admin.page.update');
        Route::get('/{id}/delete', [PageContentController::class, 'delete'])->name('admin.page.delete');
        Route::get('/{id}/sections/scaffold', [PageContentController::class, 'scaffoldSections'])->name('admin.page.sections.scaffold');
    });

    Route::prefix('faq')->middleware('auth')->group(function () {
        Route::get('/', [FaqController::class, 'index'])->name('admin.faq');
        Route::get('/create', [FaqController::class, 'create'])->name('admin.faq.create');
        Route::post('/store', [FaqController::class, 'store'])->name('admin.faq.store');
        Route::get('/{id}/edit', [FaqController::class, 'edit'])->name('admin.faq.edit');
        Route::post('/update', [FaqController::class, 'update'])->name('admin.faq.update');
        Route::get('/{id}/delete', [FaqController::class, 'delete'])->name('admin.faq.delete');
    });

    Route::prefix('artist')->middleware('auth')->group(function () {
        Route::get('/', [ArtistController::class, 'index'])->name('admin.artist');
        Route::get('/create', [ArtistController::class, 'create'])->name('admin.artist.create');
        Route::post('/store', [ArtistController::class, 'store'])->name('admin.artist.store');
        Route::get('/{id}/edit', [ArtistController::class, 'edit'])->name('admin.artist.edit');
        Route::post('/update', [ArtistController::class, 'update'])->name('admin.artist.update');
        Route::get('/{id}/delete', [ArtistController::class, 'delete'])->name('admin.artist.delete');
        Route::get('/{id}/restore', [ArtistController::class, 'restore'])->name('admin.artist.restore');
    });

    Route::prefix('style')->middleware('auth')->group(function () {
        Route::get('/', [TattooStyleController::class, 'index'])->name('admin.style');
        Route::get('/create', [TattooStyleController::class, 'create'])->name('admin.style.create');
        Route::post('/store', [TattooStyleController::class, 'store'])->name('admin.style.store');
        Route::get('/{id}/edit', [TattooStyleController::class, 'edit'])->name('admin.style.edit');
        Route::post('/update', [TattooStyleController::class, 'update'])->name('admin.style.update');
        Route::get('/{id}/delete', [TattooStyleController::class, 'delete'])->name('admin.style.delete');
        Route::get('/{id}/restore', [TattooStyleController::class, 'restore'])->name('admin.style.restore');
    });

    Route::prefix('menu')->middleware('auth')->group(function () {
        Route::get('/', [MenuItemController::class, 'index'])->name('admin.menu');
        Route::get('/create', [MenuItemController::class, 'create'])->name('admin.menu.create');
        Route::post('/store', [MenuItemController::class, 'store'])->name('admin.menu.store');
        Route::get('/{id}/edit', [MenuItemController::class, 'edit'])->name('admin.menu.edit');
        Route::post('/update', [MenuItemController::class, 'update'])->name('admin.menu.update');
        Route::get('/{id}/delete', [MenuItemController::class, 'delete'])->name('admin.menu.delete');
    });

    Route::prefix('media')->middleware('auth')->group(function () {
        Route::get('/', [MediaController::class, 'index'])->name('admin.media');
        Route::get('/create', [MediaController::class, 'create'])->name('admin.media.create');
        Route::post('/store', [MediaController::class, 'store'])->name('admin.media.store');
        Route::get('/{id}/edit', [MediaController::class, 'edit'])->name('admin.media.edit');
        Route::post('/update', [MediaController::class, 'update'])->name('admin.media.update');
        Route::get('/{id}/delete', [MediaController::class, 'delete'])->name('admin.media.delete');
    });
    Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('admin.index');
});