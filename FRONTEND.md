# Giao diện (ghép từ bản clone mrdolphintattoo.com)

## Nguyên tắc

Một trang = **một route đặt tên** + **một method trong `PageController`** + **một view riêng**.
Phần dùng chung (head, header, footer, script) nằm trong layout — sửa một lần, mọi trang đổi theo.

## Cây file

```
resources/views/
├── layouts/app.blade.php        Layout chung: <head>, header, footer, JS/CSS dùng chung
├── partials/
│   ├── header.blade.php         Header + menu (active state tự tính theo route)
│   └── footer.blade.php         Footer
└── pages/
    ├── home.blade.php                    /
    ├── about-us.blade.php                /about-us
    ├── best-tattoo-studio-bali.blade.php /best-tattoo-studio-bali
    ├── piercing.blade.php                /piercing
    ├── eyebrows-tattoo.blade.php         /eyebrows-tattoo
    ├── exhibition.blade.php              /exhibition
    ├── gallery.blade.php                 /gallery
    ├── contact-us.blade.php              /contact-us
    └── tattoo-styles/
        ├── index.blade.php               /tattoo-styles
        ├── japanese-tattoos.blade.php    /tattoo-styles/japanese-tattoos
        ├── realism-tattoos.blade.php     /tattoo-styles/realism-tattoos
        ├── tribal-tattoos.blade.php      /tattoo-styles/tribal-tattoos
        └── cartoon-tattoos.blade.php     /tattoo-styles/cartoon-tattoos

public/assets/{css,js,images,fonts,media}   Toàn bộ asset tĩnh
```

## Mỗi view page có gì

```blade
@extends('layouts.app')

@section('title', '...')            {{-- thẻ <title> --}}
@section('body_class', '...')       {{-- class trên thẻ <body> --}}

@push('styles')  ... @endpush       {{-- CSS riêng của trang (widget Elementor, post-XX.css) --}}
@section('head') ... @endsection    {{-- meta description, canonical, og:, JSON-LD --}}

@section('content') ... @endsection {{-- nội dung trang --}}

@push('scripts') ... @endpush       {{-- JS riêng của trang --}}
```

## Thêm một trang mới

1. `resources/views/pages/<ten>.blade.php` — copy khung ở trên.
2. Thêm method vào `app/Http/Controllers/PageController.php`.
3. Thêm dòng route trong `routes/web.php`, đặt tên `page.<ten>`.
4. Muốn hiện trên menu: thêm `<li>` vào `resources/views/partials/header.blade.php`,
   dùng đúng mẫu active state của các mục sẵn có.

## Menu active

Header không hard-code trạng thái active. Mỗi mục dùng:

```blade
{{ request()->routeIs('page.gallery') ? ' current-menu-item current_page_item active' : '' }}
```

Mục "Tattoo Styles" dùng `routeIs('page.tattoo-styles*')` nên tự sáng khi ở trang con.

## Asset

Mọi đường dẫn trong view đi qua `asset('assets/...')`. File CSS giữ nguyên đường dẫn
tương đối (`url(../images/x.jpg)`) nên copy/thay ảnh trong `public/assets/images/` là đủ.

## Thứ tự script (quan trọng)

WordPress in ra các đoạn `<script id="X-js-before">` / `X-js-extra` ngay **trước**
file JS tương ứng — chúng khai báo biến cấu hình mà file JS đó cần. Khi tách view,
phần dùng chung nằm ở layout còn phần riêng của trang được đẩy qua `@push`, nên nếu
đẩy nhầm stack thì config sẽ chạy **sau** thư viện và vỡ.

Vì vậy layout có một stack riêng, đặt ngay trước `frontend.min.js`:

```blade
@stack('elementor-config')    {{-- trong layouts/app.blade.php --}}
```

Mỗi trang khai báo `elementorFrontendConfig` của mình vào đó:

```blade
@push('elementor-config')
<script id="elementor-frontend-js-before"> ... </script>
@endpush
```

`@push('scripts')` (cuối `<body>`) chỉ dành cho JS **không** có thư viện phụ thuộc
nằm sẵn trong layout. Thêm script mới thì kiểm tra lại quy tắc này.

## Elementor tải chunk động

`elementorFrontendConfig.urls.assets` là base URL webpack dùng để tải chunk:
nó ghép thành `<assets>js/<ten-chunk>.bundle.min.js` và `<assets>css/<ten>.min.css`.
Giá trị đang đặt là `{{ asset('assets') }}/`, khớp với `public/assets/js` và
`public/assets/css`. 23 file `*.bundle.min.js` của Elementor (lightbox, video,
nested-tabs, image-carousel, section/shared handlers...) nằm trong `public/assets/js`.

Nếu đổi vị trí thư mục asset, phải sửa cả `urls.assets` trong `@push('elementor-config')`
của 13 view, nếu không Elementor sẽ báo `ChunkLoadError`.

## Form liên hệ

- View: `pages/contact-us.blade.php` (giữ nguyên markup + CSS của WPForms, đã gỡ JS của nó)
- Route: `POST /contact-us` → `ContactController@store`
- Field: `first_name`, `last_name`, `email`, `message` — có validate, `@csrf`, giữ `old()`
- Mặc định ghi log. Đặt `CONTACT_MAIL_TO=` trong `.env` để gửi mail.

## CSS tự viết

`public/assets/css/site.css` là nơi duy nhất đặt CSS do mình viết (không phải Elementor sinh ra).
Layout nạp nó **sau cùng** nên luôn ghi đè được. Chỉ dùng biến màu/font có sẵn của
Elementor Kit (`--e-global-color-*`, `--e-global-typography-*`) để giữ đúng bộ style.

Class `.ci-btn` là style nút dùng chung: nó được thêm song song vào chính các rule nút
sẵn có trong `post-593.css`, nên nút mới trông y hệt nút cũ mà không nhân đôi khai báo.

## Carousel "Tattoo Styles" (trang chủ)

- Thư viện: **Swiper 8.4.5** đã có sẵn trong `public/assets/js/swiper.min.js` (Elementor nạp),
  không cài thêm gì.
- Danh sách style nằm ở mảng `$tattooStyles` đầu `pages/home.blade.php` — đổi tên, đổi ảnh,
  thêm/bớt mục ngay tại đó, markup tự sinh theo vòng lặp. `route` để `null` nếu style
  chưa có trang riêng (khi đó card trỏ về `/tattoo-styles`).
- Ảnh đặt trong `public/assets/images`. Ảnh đang dùng là ảnh tạm lấy từ thư viện gallery —
  thay bằng ảnh đúng của từng style khi có.
- Style card + dot phân trang nằm trong `site.css` (`.ci-style-card`, `.ci-styles__pagination`).
- Script khởi tạo nằm trong `@push('scripts')` của `home.blade.php`, có kèm IntersectionObserver
  bật ảnh sang `eager` khi section vào khung nhìn (slide nằm ngoài khung theo chiều ngang
  không tự load nếu để `loading="lazy"`).

## Review khách hàng (section "My Happy Clients!")

Trước đây section này dùng widget Trustindex kéo review từ Google — script của nó đã bị gỡ
từ lúc clone nên section trống. Giờ nó chạy hoàn toàn tĩnh, **không gọi dịch vụ ngoài nào**.

Nội dung nằm ở mảng `$clientReviews` đầu `pages/home.blade.php`:

```php
[
    'name'   => '...',        // tên khách
    'date'   => '2 tuần trước',
    'rating' => 5,            // 1-5, vẽ đúng số sao
    'avatar' => null,         // tên file trong public/assets/images, null = hiện chữ cái đầu
    'source' => 'google',     // hiện logo G; bỏ đi nếu không phải review Google
    'text'   => '...',
]
```

Thêm/bớt phần tử là số card tự đổi theo (grid 3 cột → 2 → 1 theo bề rộng màn hình).
Link nút "Read more reviews" đặt ở biến `$reviewsUrl` ngay dưới mảng.
CSS card nằm trong `site.css` (`.ci-review*`).

## Artist

Nguồn dữ liệu: **`config/artists.php`** — một chỗ duy nhất, dùng cho cả 3 nơi:

- trang chủ: lấy `home_limit` người đầu (mặc định 4), dư ra thì hiện nút "View all artists"
- `/artists`: danh sách đầy đủ
- `/artists/{slug}`: trang chi tiết từng người (slug không khớp → 404)

Mỗi hàng artist render qua `partials/artist-row.blade.php` (ảnh một bên, tên + vai trò +
mô tả + nút Detail bên kia, hàng chẵn tự đảo bên). Trang chủ và `/artists` dùng chung partial này.

Thêm artist = thêm một phần tử vào `config/artists.php`, không phải sửa view nào.

### Trang phụ dùng khung `.ci-page`

`/artists` và `/artists/{slug}` không có file `post-XXX.css` riêng như các trang clone từ
Elementor, nên chúng dùng `.ci-page` / `.ci-page__inner` / `.ci-page__eyebrow` / `.ci-page__title`
trong `site.css` — cùng nền, cùng font, cùng màu với trang chủ. Trang phụ mới nên theo khung này.

Class nút `.ci-btn` trước nằm trong `post-593.css` (chỉ chạy ở trang chủ) nay đã chuyển hẳn
sang `site.css` nên mọi trang dùng được.

## Icon

Site có sẵn **3 bộ icon**, cả 3 đều nạp trong `layouts/app.blade.php` nên dùng được ở mọi trang,
không cần thêm thư viện.

| Bộ | Class | Số icon | Ghi chú |
|---|---|---|---|
| Font Awesome Free 5.15.3 | `fas fa-*` (Solid), `fab fa-*` (Brands) | ~1.460 | Dùng mặc định |
| ElementsKit | `icon icon-*` | ~950 | **Phải nằm trong** `.ekit-wid-con` hoặc `.elementor-widget` |
| Elementor Icons | `eicon-*` | ~515 | Icon của Elementor, dùng ở đâu cũng được |

Hai lưu ý:

- `far fa-*` (Font Awesome Regular) **không chạy** — CSS có nhưng thiếu file font
  `fa-regular-400`. Dùng `fas` thay thế.
- Icon ElementsKit chỉ ăn font khi có tổ tiên mang class `.ekit-wid-con` / `.elementor-widget`.
  Đặt trần ra ngoài là ra ô vuông trống.

Danh sách tên icon tra ở chính file CSS:

```bash
# Font Awesome
grep -o '\.fa-[a-z0-9-]*:before' public/assets/css/fontawesome.css | sort -u
# ElementsKit
grep -o '\.icon-[a-z0-9-]*::before' public/assets/css/ekiticons.css | sort -u
# Elementor
grep -o '\.eicon-[a-z0-9-]*:before' public/assets/css/elementor-icons.min.css | sort -u
```

Icon mạng xã hội ở footer đang là **SVG inline** của Elementor (`e-font-icon-svg e-fab-*`),
không phải icon font — muốn thêm thì copy nguyên một `<li>` trong `ul.ekit_social_media`
rồi đổi `<svg>`, hoặc thay bằng `<i class="fab fa-tiktok"></i>` cho gọn.

## Thanh social neo góc dưới bên phải

- Markup: `partials/social-dock.blade.php`, được `@include` trong `layouts/app.blade.php`
  ngay trước `@stack('scripts')` nên hiện trên **mọi trang**.
- Link: `config/social.php` — sửa link ở đó, không sửa view. Bỏ một key hoặc để `null`
  thì mục đó tự biến mất khỏi thanh.
- CSS: `.ci-dock*` trong `site.css`. `position: fixed; right: 0; bottom: 28px;` nên neo cố
  định khi cuộn. Trên màn hình ≤ 767px thanh thu còn 62px.
- Icon là SVG inline của Font Awesome, `fill: currentColor` nên đổi màu chữ là icon đổi theo.

## Đa ngôn ngữ (2 lá cờ trên menu)

Cơ chế đã chạy thật, chỉ còn thiếu bản dịch nội dung.

| Thành phần | File |
|---|---|
| Danh sách ngôn ngữ | `config/locales.php` |
| Markup 2 lá cờ | `partials/lang-switcher.blade.php` (include sau mục Contact Us trong header) |
| Route đổi ngôn ngữ | `GET /lang/{locale}` → `LocaleController@switch` |
| Áp dụng locale | `App\Http\Middleware\SetLocale` (đăng ký trong nhóm `web`) |
| CSS | `.ci-lang*` trong `site.css` |

Luồng: bấm cờ → lưu mã ngôn ngữ vào session → `redirect()->back()` về đúng trang đang xem
→ middleware đọc session và `app()->setLocale()` cho mọi request sau. Mã lạ (vd `/lang/de`)
trả 404. Thẻ `<html lang>` cũng đổi theo.

**Thêm ngôn ngữ mới:** thêm một dòng vào `config/locales.php` + để file cờ vào
`public/assets/imgs` + tạo `resources/lang/<mã>`. Không phải sửa view.

**Để nội dung đổi theo ngôn ngữ**, thay chữ cứng trong view bằng `{{ __('key') }}` rồi tạo
`resources/lang/vi/*.php`. Hiện chưa làm nên đổi cờ thì chữ vẫn tiếng Anh.

> `.ci-lang__item img` phải dùng `!important` cho `width/height/max-width` — theme
> hello-elementor đặt `img{max-width:100%;height:auto}` thắng cascade, không có `!important`
> thì lá cờ giãn to bằng cả khung.

## Version cho CSS

`site.css` được nạp kèm `?v=filemtime(...)` trong layout, nên sửa CSS là trình duyệt lấy bản
mới ngay, không phải hard-refresh. Các file CSS clone từ Elementor thì chưa có, vẫn phải
Cmd+Shift+R khi sửa.

## Font

Toàn site dùng **Work Sans**. Khai báo `@font-face` nằm ở đầu `site.css`, trỏ tới
`public/assets/fonts/WorkSans-Regular.woff2` (400) và `WorkSans-Bold.woff2` (700).

Font cũ (Sancreek, Barlow, Barlow Semi Condensed, Oswald) đã được thay tên trong toàn bộ
CSS và view, và 4 thẻ `<link>` nạp chúng đã gỡ khỏi layout. File `sancreek.css`, `barlow.css`,
`barlowsemicondensed.css`, `oswald.css` cùng ~130 file font trong `assets/fonts` vẫn còn
trên đĩa nhưng không còn được tham chiếu — xoá được nếu muốn gọn.

Đổi font lần sau chỉ cần sửa 2 khối `@font-face` và 4 biến trong `site.css`:

```css
--e-global-typography-primary-font-family
--e-global-typography-secondary-font-family
--e-global-typography-text-font-family
--e-global-typography-accent-font-family
```

**Chỉ có 2 weight (400 và 700).** Chỗ nào CSS ghi `font-weight:500/600` trình duyệt sẽ tự
giả lập (synthetic bold), nhìn hơi khác font thật. Cần chuẩn thì bổ sung file .woff2 cho
các weight đó rồi thêm `@font-face` tương ứng.

> Font icon (Font Awesome, ElementsKit, eicons, swiper-icons) **không** bị đổi — chúng là
> font biểu tượng, đổi là mất icon.

## Trang đặt lịch (/contact-us)

Trang Contact cũ đã đổi thành trang **Book Your Appointment**. URL và route name giữ nguyên
(`page.contact-us`) nên menu không phải sửa.

Form nằm trong `pages/contact-us.blade.php`, khối `.ci-booking` (có `id="booking"` để anchor).
Toàn bộ markup WPForms cũ đã gỡ, kèm cả file CSS/JS của nó mà trang này còn nạp.

Các trường gửi lên `POST /contact-us` → `ContactController@store`:

| Field | Bắt buộc | Ghi chú |
|---|---|---|
| `full_name` | có | max 120 |
| `phone` | có | max 40 |
| `email` | có | phải là email hợp lệ |
| `preferred_date` | không | `date`, không được là ngày quá khứ |
| `artist` | không | phải khớp một `slug` trong `config/artists.php` |
| `message` | có | max 5000 |

Dropdown artist đọc thẳng từ `config/artists.php` — thêm artist là option tự có.
Controller đổi slug sang tên người trước khi ghi log / gửi mail.

Mặc định chỉ ghi log; đặt `CONTACT_MAIL_TO` trong `.env` để gửi mail kèm đầy đủ thông tin.
CSS của form nằm ở `.ci-booking*` / `.ci-field*` trong `site.css`.

## URL cũ

4 URL WordPress cũ (`/japanese-tattoos-2`, `/realism-tattoos`, `/tribal-tattoos`,
`/cartoon-tattoos`) redirect 301 sang `/tattoo-styles/...`.

## Còn trỏ ra ngoài

Link `/blog/`, mạng xã hội, WhatsApp, Google Maps vẫn trỏ về site gốc / dịch vụ ngoài.
Toàn bộ script tracking (GTM, GA, Facebook Pixel, Trustindex) đã bị gỡ.
