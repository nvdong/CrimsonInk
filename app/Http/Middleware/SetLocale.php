<?php

namespace App\Http\Middleware;

use App\Support\Settings;
use Closure;
use Illuminate\Http\Request;

/**
 * Đặt ngôn ngữ cho request theo lựa chọn đã lưu trong session.
 *
 * Người dùng bấm lá cờ trên menu -> LocaleController lưu vào session -> middleware
 * này áp dụng cho mọi request sau đó. Mã ngôn ngữ lạ thì bỏ qua, giữ mặc định.
 *
 * Danh sách ngôn ngữ lấy từ settings (group i18n, key locales).
 */
class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->session()->get('locale');

        if ($locale && array_key_exists($locale, Settings::locales())) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
