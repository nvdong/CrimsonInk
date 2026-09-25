<?php

namespace App\Http\Controllers;

use App\Support\Settings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Đổi ngôn ngữ hiển thị rồi quay lại đúng trang người dùng đang xem.
 */
class LocaleController extends Controller
{
    public function switch(Request $request, string $locale): RedirectResponse
    {
        if (! array_key_exists($locale, Settings::locales())) {
            throw new NotFoundHttpException();
        }

        $request->session()->put('locale', $locale);

        return redirect()->back();
    }
}
