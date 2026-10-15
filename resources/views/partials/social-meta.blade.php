{{-- Thẻ meta mô tả + Open Graph + Twitter Card, dùng chung cho mọi trang.

     Trước đây mỗi view trang tự khai một nhúm thẻ khác nhau: trang thì thiếu
     og:title, trang thì thiếu og:description, không trang nào có twitter:card
     nên link dán lên X/Facebook ra thẻ trắng; vài trang còn khai
     article:modified_time bằng ngày hardcode từ hồi clone site.

     Giờ mỗi view chỉ cần khai 3 section (đều không bắt buộc):

         @section('meta_description', 'Mô tả 150-160 ký tự')
         @section('og_image', asset('assets/images/abc.jpg'))
         @section('og_type', 'article')        // mặc định 'website'

     Kích thước ảnh được đọc trực tiếp từ file nên không bao giờ lệch với ảnh
     thật (các view cũ khai 1920x1280 cho cả ảnh 600x900).

     Site chỉ phục vụ tiếng Anh nên og:locale khai cứng en_US.
--}}
@php
    use App\Support\Settings;

    $siteName = Settings::get('studio.name', 'Crimson Ink');

    /* yieldContent đọc đúng các @section con đã khai, kể cả dạng một dòng. */
    $gon = function ($chuoi) {
        return trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags((string) $chuoi), ENT_QUOTES, 'UTF-8')));
    };

    $ogTitle = $gon($__env->yieldContent('title', $siteName));
    $ogDesc  = $gon($__env->yieldContent('meta_description'));
    $ogType  = trim($__env->yieldContent('og_type')) ?: 'website';
    $ogUrl   = url()->current();

    /* Ảnh: section của trang -> ảnh mặc định trong settings -> logo. */
    $ogImage = trim($__env->yieldContent('og_image'));

    if ($ogImage === '') {
        $ogImage = Settings::get('studio.og_image') ?: Settings::get('studio.logo_path');
    }

    if ($ogImage && ! preg_match('#^https?://#i', $ogImage)) {
        $ogImage = asset(ltrim($ogImage, '/'));
    }

    /* Đọc kích thước thật của ảnh nếu nó là file trong public/. */
    $ogW = $ogH = $ogMime = null;

    if ($ogImage) {
        $goc    = rtrim(asset(''), '/');
        $tuongDoi = strpos($ogImage, $goc) === 0 ? substr($ogImage, strlen($goc)) : null;

        if ($tuongDoi !== null) {
            $duongDan = public_path(ltrim(rawurldecode(parse_url($tuongDoi, PHP_URL_PATH) ?: ''), '/'));

            if (is_file($duongDan) && ($info = @getimagesize($duongDan))) {
                $ogW    = $info[0];
                $ogH    = $info[1];
                $ogMime = $info['mime'] ?? null;
            }
        }
    }
@endphp
@if ($ogDesc !== '')
<meta name="description" content="{{ $ogDesc }}" />
@endif
<meta property="og:site_name" content="{{ $siteName }}" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="{{ $ogType }}" />
<meta property="og:title" content="{{ $ogTitle }}" />
@if ($ogDesc !== '')
<meta property="og:description" content="{{ $ogDesc }}" />
@endif
<meta property="og:url" content="{{ $ogUrl }}" />
@if ($ogImage)
<meta property="og:image" content="{{ $ogImage }}" />
@if (\Illuminate\Support\Str::startsWith($ogImage, 'https://'))
<meta property="og:image:secure_url" content="{{ $ogImage }}" />
@endif
@if ($ogW && $ogH)
<meta property="og:image:width" content="{{ $ogW }}" />
<meta property="og:image:height" content="{{ $ogH }}" />
@endif
@if ($ogMime)
<meta property="og:image:type" content="{{ $ogMime }}" />
@endif
<meta property="og:image:alt" content="{{ $ogTitle }}" />
@endif
<meta name="twitter:card" content="{{ $ogImage ? 'summary_large_image' : 'summary' }}" />
<meta name="twitter:title" content="{{ $ogTitle }}" />
@if ($ogDesc !== '')
<meta name="twitter:description" content="{{ $ogDesc }}" />
@endif
@if ($ogImage)
<meta name="twitter:image" content="{{ $ogImage }}" />
<meta name="twitter:image:alt" content="{{ $ogTitle }}" />
@endif
