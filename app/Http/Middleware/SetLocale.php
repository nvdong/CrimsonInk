<?php

namespace App\Http\Middleware;

use App\Support\Settings;
use Closure;
use Illuminate\Http\Request;

/**
 * Đặt ngôn ngữ cho request theo lựa chọn đã lưu trong session.
 *
 * LocaleController lưu lựa chọn vào session -> middleware này áp dụng cho các
 * request sau đó. Mã ngôn ngữ lạ thì bỏ qua, giữ mặc định (config/app.php = en).
 *
 * Danh sách ngôn ngữ lấy từ settings (group i18n, key locales).
 *
 * CHỐT 2026-10: phần công khai của site chỉ phục vụ TIẾNG ANH (đối tượng là
 * khách du lịch Âu/Mỹ/Úc tới Hà Nội xăm). Header đã bỏ hai lá cờ, nhưng nếu
 * trình duyệt còn session locale = 'vi' từ trước thì trang vẫn trả nội dung
 * tiếng Việt trong khi <html lang="en"> — vừa sai với Google vừa sai với khách.
 * Nên chỉ cho đổi ngôn ngữ trong /admin. Muốn mở lại song ngữ: bỏ điều kiện
 * $trongAdmin ở dưới, trả lại hai lá cờ vào header và thêm thẻ hreflang.
 */
class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale     = $request->session()->get('locale');
        $trongAdmin = $request->is('admin', 'admin/*');

        if ($trongAdmin && $locale && array_key_exists($locale, Settings::locales())) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
