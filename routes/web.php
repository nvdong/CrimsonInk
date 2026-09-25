<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
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

    Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('admin.index');
});