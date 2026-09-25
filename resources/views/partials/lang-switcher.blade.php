{{-- Bộ chọn ngôn ngữ (lá cờ) cạnh Contact Us trên menu.
     Danh sách ngôn ngữ lấy từ bảng settings — group i18n, key locales. --}}
<li class="ci-lang nav-item elementskit-mobile-builder-content">
    @foreach (\App\Support\Settings::locales() as $code => $lang)
        <a class="ci-lang__item{{ app()->getLocale() === $code ? ' is-active' : '' }}"
           href="{{ route('locale.switch', $code) }}"
           hreflang="{{ $code }}"
           title="{{ $lang['label'] }}"
           aria-label="{{ $lang['label'] }}"
           @if (app()->getLocale() === $code) aria-current="true" @endif>
            <img src="{{ asset($lang['flag_path']) }}" alt="{{ $lang['label'] }}" height="18" decoding="async">
        </a>
    @endforeach
</li>
