{{-- Structured data (JSON-LD) dùng chung cho mọi trang.

     Thay cho 10 khối do Yoast sinh ra hồi clone site — các khối đó khai báo
     studio ở Bali (tên Mr. Dolphin, địa chỉ Kuta, số +62, tọa độ Indonesia).

     Toàn bộ dữ liệu ở đây đọc từ bảng settings, nên sửa địa chỉ / SĐT / email
     trong admin là schema tự đúng theo, không phải sờ vào file này.

     Khai báo gồm 4 nút:
       Organization/LocalBusiness — nuôi khung thông tin doanh nghiệp và kết quả bản đồ
       WebSite                    — tên site
       WebPage                    — trang hiện tại
       BreadcrumbList             — đường dẫn phân cấp hiện dưới tiêu đề trên Google
--}}
@php
    use App\Support\Settings;

    $locale  = app()->getLocale();
    $homeUrl = route('page.home');
    $pageUrl = url()->current();

    $ten     = Settings::get('studio.name', 'Crimson Ink');
    $diaChi  = Settings::get('studio.address');
    $sdt     = Settings::get('studio.phone');
    $email   = Settings::get('studio.email');
    $logo    = Settings::get('studio.logo_path');

    /* Tên trang hiện tại: tra theo route_name trong bảng pages, không có thì
       thử bảng tattoo_styles (4 trang phong cách có trang riêng). */
    $routeName = optional(request()->route())->getName();
    $tenTrang  = null;

    if ($routeName) {
        $p = \App\Models\Page::where('route_name', $routeName)->first();
        $tenTrang = $p ? $p->title : null;

        /* Trang phong cách giờ dùng chung một route có tham số slug */
        if (! $tenTrang && $routeName === 'page.tattoo-styles.show') {
            $s = \App\Models\TattooStyle::where('slug', request()->route('slug'))->first();
            $tenTrang = $s ? $s->name : null;
        }

        /* Trang chi tiết artist không nằm trong pages lẫn tattoo_styles */
        if (! $tenTrang && $routeName === 'page.artists.show') {
            $a = \App\Models\Artist::where('slug', request()->route('slug'))->first();
            $tenTrang = $a ? $a->name : null;
        }
    }

    $laTrangChu = $routeName === 'page.home';

    /* ---- Organization / LocalBusiness ---- */
    $doanhNghiep = [
        '@type' => ['Organization', 'LocalBusiness'],
        '@id'   => $homeUrl.'#organization',
        'name'  => $ten,
        'url'   => $homeUrl,
    ];

    if ($logo) {
        $doanhNghiep['logo'] = $doanhNghiep['image'] = asset($logo);
    }

    if ($sdt) {
        $doanhNghiep['telephone'] = $sdt;
    }

    if ($email) {
        $doanhNghiep['email'] = $email;
    }

    if ($diaChi) {
        $doanhNghiep['address'] = [
            '@type'          => 'PostalAddress',
            'streetAddress'  => $diaChi,
            'addressCountry' => 'VN',
        ];
    }

    /* Giờ mở cửa: rút 2 con số giờ từ chuỗi tự do ("10 am – 18 pm" -> 10:00/18:00).
       Hiện studio mở tất cả các ngày nên khai đủ 7 ngày. Nếu sau này mỗi ngày một
       giờ khác nhau thì phải tách thành nhiều dòng settings và sửa lại đoạn này. */
    if (preg_match_all('/(\d{1,2})(?::(\d{2}))?/', (string) Settings::get('studio.open_hours'), $m) && count($m[1]) >= 2) {
        $gio = function ($i) use ($m) {
            return str_pad($m[1][$i], 2, '0', STR_PAD_LEFT).':'.($m[2][$i] !== '' ? $m[2][$i] : '00');
        };

        $doanhNghiep['openingHoursSpecification'] = [[
            '@type'     => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            'opens'     => $gio(0),
            'closes'    => $gio(1),
        ]];
    }

    /* sameAs: chỉ nhận link http(s) có đường dẫn thật. Bỏ tel:/mailto: và bỏ
       cả link mới chỉ là tên miền gốc (vd https://www.instagram.com/) — khai
       những link đó là nói với Google rằng đó là trang của studio, mà không phải. */
    $sameAs = [];

    foreach (Settings::social() as $link) {
        $url = $link['url'] ?? '';

        if (! preg_match('#^https?://#i', $url)) {
            continue;
        }

        if (trim(parse_url($url, PHP_URL_PATH) ?: '', '/') === '') {
            continue;
        }

        $sameAs[] = $url;
    }

    if ($sameAs) {
        $doanhNghiep['sameAs'] = array_values(array_unique($sameAs));
    }

    /* ---- WebSite ---- */
    $website = [
        '@type'      => 'WebSite',
        '@id'        => $homeUrl.'#website',
        'url'        => $homeUrl,
        'name'       => $ten,
        'publisher'  => ['@id' => $homeUrl.'#organization'],
        'inLanguage' => $locale,
    ];

    /* ---- WebPage ---- */
    $webpage = [
        '@type'      => 'WebPage',
        '@id'        => $pageUrl,
        'url'        => $pageUrl,
        'name'       => $tenTrang ?: $ten,
        'isPartOf'   => ['@id' => $homeUrl.'#website'],
        'about'      => ['@id' => $homeUrl.'#organization'],
        'inLanguage' => $locale,
    ];

    /* ---- BreadcrumbList ---- */
    $breadcrumb = [[
        '@type'    => 'ListItem',
        'position' => 1,
        'name'     => $locale === 'vi' ? 'Trang chủ' : 'Home',
        'item'     => $homeUrl,
    ]];

    if (! $laTrangChu && $tenTrang) {
        $breadcrumb[] = [
            '@type'    => 'ListItem',
            'position' => 2,
            'name'     => $tenTrang,
        ];
    }

    $graph = [$doanhNghiep, $website, $webpage, [
        '@type'           => 'BreadcrumbList',
        '@id'             => $pageUrl.'#breadcrumb',
        'itemListElement' => $breadcrumb,
    ]];
@endphp
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph'   => $graph,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
