{{-- Thanh social neo cố định ở góc dưới bên phải, hiện trên mọi trang.
     Link lấy từ bảng settings — group social, key links, cờ "dock" = true. --}}
@php
    $socialDock = \App\Support\Settings::social('dock');
@endphp

@if ($socialDock)
<nav class="ci-dock" aria-label="Kênh liên hệ">
    @foreach ($socialDock as $item)
        <a class="ci-dock__item ci-dock__item--{{ $item['platform'] }}" href="{{ $item['url'] }}" target="_blank" rel="noopener" aria-label="{{ $item['label'] }}">
            <span class="ci-dock__icon" aria-hidden="true">@include('partials.social-icon', ['platform' => $item['platform']])</span>
            <span class="ci-dock__label">{{ $item['label'] }}</span>
        </a>
    @endforeach
</nav>
@endif
