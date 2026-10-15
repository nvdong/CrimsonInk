{{-- Structured data (JSON-LD) dùng chung cho mọi trang.

     Thay cho 10 khối do Yoast sinh ra hồi clone site — các khối đó khai báo
     studio ở Bali (tên Mr. Dolphin, địa chỉ Kuta, số +62, tọa độ Indonesia).

     Toàn bộ dữ liệu ở đây đọc từ bảng settings, nên sửa địa chỉ / SĐT / email /
     toạ độ / khoảng giá trong admin là schema tự đúng theo, không phải sờ vào
     file này. Khóa nào để trống thì bỏ hẳn trường đó — khai trống hoặc khai bừa
     còn tệ hơn không khai.

     Site chỉ phục vụ tiếng Anh (khách du lịch Âu/Mỹ/Úc tới Hà Nội), nên
     inLanguage khai cứng 'en', không theo app()->getLocale().

     Các nút khai báo:
       TattooParlor/LocalBusiness — khung thông tin doanh nghiệp + kết quả bản đồ
       WebSite                    — tên site
       WebPage                    — trang hiện tại
       BreadcrumbList             — đường dẫn phân cấp hiện dưới tiêu đề trên Google
       Service / Person / BlogPosting — thêm theo từng loại trang chi tiết
--}}
@php
    use App\Support\Settings;

    $lang    = 'en';
    $homeUrl = route('page.home');
    $pageUrl = url()->current();
    $bizId   = $homeUrl.'#organization';   // giữ nguyên @id cũ để link ngoài không chết

    $ten    = Settings::get('studio.name', 'Crimson Ink');
    $diaChi = Settings::get('studio.address');
    $sdt    = Settings::get('studio.phone');
    $email  = Settings::get('studio.email');
    $logo   = Settings::get('studio.logo_path');

    /* Đường dẫn ảnh -> URL tuyệt đối. Bỏ qua nếu rỗng. */
    $anhUrl = function ($path) {
        if (! $path) {
            return null;
        }

        return preg_match('#^https?://#i', $path) ? $path : asset(ltrim($path, '/'));
    };

    /* Cắt chuỗi "a, b, c" thành mảng, bỏ phần tử rỗng. */
    $tachDanhSach = function ($chuoi) {
        return array_values(array_filter(array_map('trim', explode(',', (string) $chuoi)), function ($v) {
            return $v !== '';
        }));
    };

    /* Dùng cho array_filter: giữ lại giá trị thật, bỏ null/''/[].
       Không dùng 'strlen' vì PHP 8.1+ cảnh báo deprecated khi gặp null. */
    $coGiaTri = function ($v) {
        return $v !== null && $v !== '' && $v !== [];
    };

    /* ---------------------------------------------------------------
       Trang hiện tại là trang gì: tra theo route_name trong bảng pages,
       rồi tới các trang chi tiết (style / artist / bài viết).
       --------------------------------------------------------------- */
    $routeName  = optional(request()->route())->getName();
    $slug       = optional(request()->route())->parameter('slug');
    $tenTrang   = null;
    $ngaySua    = null;
    $anhTrang   = null;
    $style      = null;
    $artist     = null;
    $baiViet    = null;

    if ($routeName) {
        if ($p = \App\Models\Page::where('route_name', $routeName)->first()) {
            $tenTrang = $p->title;
            $ngaySua  = $p->updated_at;
        }

        if ($slug && $routeName === 'page.tattoo-styles.show') {
            $style = \App\Models\TattooStyle::where('slug', $slug)->first();

            if ($style) {
                $tenTrang = $style->name.' Tattoo in Hanoi';
                $ngaySua  = $style->updated_at;
                $anhTrang = $anhUrl($style->cover_path);
            }
        }

        if ($slug && $routeName === 'page.artists.show') {
            $artist = \App\Models\Artist::where('slug', $slug)->first();

            if ($artist) {
                $tenTrang = $artist->name;
                $ngaySua  = $artist->updated_at;
                $anhTrang = $anhUrl($artist->avatar_path);
            }
        }

        if ($slug && $routeName === 'page.blog.show') {
            $baiViet = \App\Models\Post::where('slug', $slug)->first();

            if ($baiViet) {
                $tenTrang = $baiViet->title;
                $ngaySua  = $baiViet->updated_at;
                $anhTrang = $anhUrl($baiViet->cover_path);
            }
        }
    }

    $laTrangChu = $routeName === 'page.home';

    /* ---------------------------------------------------------------
       TattooParlor / LocalBusiness
       --------------------------------------------------------------- */
    $doanhNghiep = [
        // TattooParlor là loại cụ thể nhất; khai kèm 2 lớp cha để công cụ nào
        // chỉ tìm chuỗi "LocalBusiness"/"Organization" vẫn nhận ra.
        '@type' => ['TattooParlor', 'LocalBusiness', 'Organization'],
        '@id'   => $bizId,
        'name'  => $ten,
        'url'   => $homeUrl,
    ];

    /* image: ảnh đại diện doanh nghiệp. Google thích nhiều ảnh, ưu tiên ảnh
       ngang. Ghép logo + ảnh social + ảnh của trang đang xem, bỏ trùng. */
    $anhDN = array_values(array_unique(array_filter([
        $anhUrl(Settings::get('studio.og_image')),
        $anhTrang,
        $anhUrl($logo),
    ])));

    if ($anhDN) {
        $doanhNghiep['image'] = count($anhDN) === 1 ? $anhDN[0] : $anhDN;
    }

    if ($logo) {
        $doanhNghiep['logo'] = $anhUrl($logo);
    }

    if ($sdt) {
        $doanhNghiep['telephone'] = $sdt;
    }

    if ($email) {
        $doanhNghiep['email'] = $email;
    }

    /* Địa chỉ: tách phố / quận-thành phố để Google đọc được, không nhồi cả
       dòng vào streetAddress như trước. */
    $pho       = Settings::get('studio.street_address') ?: $diaChi;
    $thanhPho  = Settings::get('studio.city');
    $tinh      = Settings::get('studio.region');
    $maBuuChinh = Settings::get('studio.postal_code');

    if ($pho || $thanhPho) {
        $doanhNghiep['address'] = array_filter([
            '@type'           => 'PostalAddress',
            'streetAddress'   => $pho,
            'addressLocality' => $thanhPho,
            'addressRegion'   => $tinh,
            'postalCode'      => $maBuuChinh,
            'addressCountry'  => 'VN',
        ], $coGiaTri);
    }

    $lat = Settings::get('studio.latitude');
    $lng = Settings::get('studio.longitude');

    if (is_numeric($lat) && is_numeric($lng)) {
        $doanhNghiep['geo'] = [
            '@type'     => 'GeoCoordinates',
            'latitude'  => (float) $lat,
            'longitude' => (float) $lng,
        ];
    }

    if ($banDo = Settings::get('studio.reviews_url')) {
        $doanhNghiep['hasMap'] = $banDo;
    }

    /* Khoảng giá: khách du lịch lọc Google Maps theo mục này rất nhiều. */
    if ($gia = Settings::get('studio.price_range')) {
        $doanhNghiep['priceRange'] = $gia;
    }

    if ($thanhToan = $tachDanhSach(Settings::get('studio.payment_accepted'))) {
        $doanhNghiep['paymentAccepted'] = implode(', ', $thanhToan);
        $doanhNghiep['currenciesAccepted'] = 'VND';
    }

    if ($namThanhLap = Settings::get('studio.founding_year')) {
        if (preg_match('/^\d{4}$/', trim($namThanhLap))) {
            $doanhNghiep['foundingDate'] = trim($namThanhLap);
        }
    }

    /* Ngôn ngữ phục vụ: tín hiệu trực tiếp cho khách nước ngoài. */
    if ($ngonNgu = $tachDanhSach(Settings::get('studio.languages'))) {
        $doanhNghiep['availableLanguage'] = array_map(function ($n) {
            return ['@type' => 'Language', 'name' => $n];
        }, $ngonNgu);
        $doanhNghiep['knowsLanguage'] = $ngonNgu;
    }

    /* Phục vụ khách tại Hà Nội và khách quốc tế tới Hà Nội. */
    $doanhNghiep['areaServed'] = array_values(array_filter([
        $thanhPho ? ['@type' => 'City', 'name' => $thanhPho] : null,
        ['@type' => 'Country', 'name' => 'Vietnam'],
    ]));

    /* Giờ mở cửa: rút 2 mốc giờ từ chuỗi tự do. Phải hiểu được cả 2 cách viết mà
       admin hay nhập: 24h ("10:00 - 18:00", "10 am – 18 pm") và 12h ("10:00 AM -
       06:00 PM"). Trước đây regex bỏ qua am/pm nên "06:00 PM" ra closes = 06:00,
       tức schema khai studio đóng cửa lúc 6 giờ sáng.
       Hiện studio mở tất cả các ngày nên khai đủ 7 ngày. Nếu sau này mỗi ngày một
       giờ khác nhau thì phải tách thành nhiều dòng settings và sửa lại đoạn này. */
    if (preg_match_all('/(\d{1,2})(?:[:h.](\d{2}))?\s*(am|pm|sa|ch)?/i', (string) Settings::get('studio.open_hours'), $mGio, PREG_SET_ORDER) && count($mGio) >= 2) {
        /* Trả về [giờ 0-23, phút, có ghi rõ buổi hay không]. */
        $docMoc = function (array $moc) {
            $gio  = (int) $moc[1];
            $phut = isset($moc[2]) && $moc[2] !== '' ? $moc[2] : '00';
            $buoi = isset($moc[3]) ? strtolower($moc[3]) : '';
            $buoi = $buoi === 'sa' ? 'am' : ($buoi === 'ch' ? 'pm' : $buoi);

            if ($buoi === 'pm' && $gio < 12) {
                $gio += 12;      // 6 pm -> 18. "18 pm" giữ nguyên 18.
            } elseif ($buoi === 'am' && $gio === 12) {
                $gio = 0;        // 12 am -> 00.
            }

            return [$gio, $phut, $buoi !== ''];
        };

        [$gioMo, $phutMo, $roMo]       = $docMoc($mGio[0]);
        [$gioDong, $phutDong, $roDong] = $docMoc($mGio[1]);

        /* "10:00 - 6:00" không ghi buổi: giờ đóng nhỏ hơn giờ mở thì chắc chắn là chiều. */
        if (! $roDong && $gioDong < $gioMo) {
            $gioDong += 12;
        }

        if ($gioMo <= 23 && $gioDong <= 23 && $gioDong > $gioMo) {
            $doanhNghiep['openingHoursSpecification'] = [[
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                'opens'     => str_pad((string) $gioMo, 2, '0', STR_PAD_LEFT).':'.$phutMo,
                'closes'    => str_pad((string) $gioDong, 2, '0', STR_PAD_LEFT).':'.$phutDong,
            ]];
        }
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

    /* Danh mục dịch vụ: chỉ khai ở trang chủ. Đây là thứ trợ lý AI đọc để trả
       lời "studio này xăm được những style gì" nên đáng khai đầy đủ, nhưng
       nhắc lại trên cả 27 trang thì chỉ làm nặng HTML. */
    if ($laTrangChu) {
        $dsStyle = \App\Models\TattooStyle::active()->ordered()->get();

        if ($dsStyle->isNotEmpty()) {
            $doanhNghiep['hasOfferCatalog'] = [
                '@type'           => 'OfferCatalog',
                'name'            => 'Tattoo styles',
                'itemListElement' => $dsStyle->map(function ($s) use ($coGiaTri) {
                    return [
                        '@type'       => 'Offer',
                        'itemOffered' => array_filter([
                            '@type'       => 'Service',
                            'name'        => $s->name.' Tattoo',
                            'serviceType' => $s->name.' tattoo',
                            'url'         => $s->url,
                        ], $coGiaTri),
                    ];
                })->values()->all(),
            ];
        }
    }

    /* ---------------------------------------------------------------
       WebSite / WebPage
       --------------------------------------------------------------- */
    $website = [
        '@type'      => 'WebSite',
        '@id'        => $homeUrl.'#website',
        'url'        => $homeUrl,
        'name'       => $ten,
        'publisher'  => ['@id' => $bizId],
        'inLanguage' => $lang,
    ];

    $webpage = [
        '@type'      => 'WebPage',
        '@id'        => $pageUrl,
        'url'        => $pageUrl,
        'name'       => $tenTrang ?: $ten,
        'isPartOf'   => ['@id' => $homeUrl.'#website'],
        'about'      => ['@id' => $bizId],
        'breadcrumb' => ['@id' => $pageUrl.'#breadcrumb'],
        'inLanguage' => $lang,
    ];

    if ($anhTrang) {
        $webpage['primaryImageOfPage'] = ['@type' => 'ImageObject', 'url' => $anhTrang];
    }

    if ($ngaySua) {
        $webpage['dateModified'] = \Illuminate\Support\Carbon::parse($ngaySua)->toAtomString();
    }

    /* ---------------------------------------------------------------
       BreadcrumbList — mỗi bậc phải có 'item' là URL thật, trừ bậc cuối.
       --------------------------------------------------------------- */
    $cacBac = [['name' => 'Home', 'item' => $homeUrl]];

    if ($style) {
        $cacBac[] = ['name' => 'Tattoo Styles', 'item' => route('page.tattoo-styles')];
        $cacBac[] = ['name' => $style->name];
    } elseif ($artist) {
        $cacBac[] = ['name' => 'Artists', 'item' => route('page.artists')];
        $cacBac[] = ['name' => $artist->name];
    } elseif ($baiViet) {
        $cacBac[] = ['name' => 'Blog', 'item' => route('page.blog')];
        $cacBac[] = ['name' => $baiViet->title];
    } elseif (! $laTrangChu && $tenTrang) {
        $cacBac[] = ['name' => $tenTrang];
    }

    $breadcrumb = [];

    foreach ($cacBac as $i => $bac) {
        $breadcrumb[] = array_filter([
            '@type'    => 'ListItem',
            'position' => $i + 1,
            'name'     => $bac['name'],
            'item'     => $bac['item'] ?? null,
        ], $coGiaTri);
    }

    $graph = [$doanhNghiep, $website, $webpage, [
        '@type'           => 'BreadcrumbList',
        '@id'             => $pageUrl.'#breadcrumb',
        'itemListElement' => $breadcrumb,
    ]];

    /* ---------------------------------------------------------------
       Nút thêm theo loại trang chi tiết
       --------------------------------------------------------------- */
    if ($style) {
        $graph[] = array_filter([
            '@type'       => 'Service',
            '@id'         => $pageUrl.'#service',
            'name'        => $style->name.' Tattoo in Hanoi',
            'serviceType' => $style->name.' tattoo',
            'description' => $style->meta_description ?: ($style->excerpt ? trim(strip_tags($style->excerpt)) : null),
            'url'         => $pageUrl,
            'image'       => $anhTrang,
            'provider'    => ['@id' => $bizId],
            'areaServed'  => $doanhNghiep['areaServed'],
            'mainEntityOfPage' => ['@id' => $pageUrl],
        ], $coGiaTri);
    }

    if ($artist) {
        $mangXhArtist = [];

        foreach ((array) ($artist->socials ?: []) as $link) {
            if (is_string($link) && preg_match('#^https?://#i', $link)) {
                $mangXhArtist[] = $link;
            }
        }

        $graph[] = array_filter([
            '@type'       => 'Person',
            '@id'         => $pageUrl.'#person',
            'name'        => $artist->name,
            'jobTitle'    => $artist->role ?: 'Tattoo Artist',
            'description' => $artist->bio ? \Illuminate\Support\Str::limit(trim(strip_tags($artist->bio)), 300) : null,
            'image'       => $anhTrang,
            'url'         => $pageUrl,
            'worksFor'    => ['@id' => $bizId],
            'sameAs'      => $mangXhArtist ? array_values(array_unique($mangXhArtist)) : null,
        ], $coGiaTri);
    }

    if ($baiViet) {
        $graph[] = array_filter([
            '@type'            => 'BlogPosting',
            '@id'              => $pageUrl.'#article',
            'headline'         => \Illuminate\Support\Str::limit($baiViet->title, 110, ''),
            'description'      => $baiViet->meta_description ?: ($baiViet->excerpt ? trim(strip_tags($baiViet->excerpt)) : null),
            'image'            => $anhTrang,
            'datePublished'    => $baiViet->created_at ? $baiViet->created_at->toAtomString() : null,
            'dateModified'     => $baiViet->updated_at ? $baiViet->updated_at->toAtomString() : null,
            'author'           => $baiViet->author_name
                ? ['@type' => 'Person', 'name' => $baiViet->author_name]
                : ['@id' => $bizId],
            'publisher'        => ['@id' => $bizId],
            'mainEntityOfPage' => ['@id' => $pageUrl],
            'inLanguage'       => $lang,
        ], $coGiaTri);
    }
@endphp
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph'   => $graph,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
