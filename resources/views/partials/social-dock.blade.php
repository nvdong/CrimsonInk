{{-- Thanh social neo cố định ở góc dưới bên phải, hiện trên mọi trang.
     Link lấy từ bảng settings — group social, key links, cờ "dock" = true. --}}
@php
    $socialDock = \App\Support\Settings::social('dock');
@endphp

@if ($socialDock)
<nav class="ci-dock" aria-label="Kênh liên hệ">
    @foreach ($socialDock as $item)
        {{-- onclick không có "return": link vẫn mở bình thường kể cả khi gtag bị chặn.
             Tên platform (whatsapp/phone/instagram/facebook) chính là key trong
             CI_LABELS ở layout — nhãn nào để trống thì không đếm. --}}
        <a class="ci-dock__item ci-dock__item--{{ $item['platform'] }}" href="{{ $item['url'] }}" target="_blank" rel="noopener" aria-label="{{ $item['label'] }}" onclick="if (window.ciConversion) ciConversion('{{ $item['platform'] }}')">
            <span class="ci-dock__icon" aria-hidden="true">@include('partials.social-icon', ['platform' => $item['platform']])</span>
            <span class="ci-dock__label">{{ $item['label'] }}</span>
        </a>
    @endforeach
</nav>
@endif
