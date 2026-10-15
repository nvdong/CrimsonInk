{{-- Khung dùng chung cho các trang lỗi (404, 500...).

     Biến truyền vào khi @include:
       $code    — mã lỗi hiện to ở hero
       $heading — H1
       $lead    — một câu giải thích
       $showLinks — true thì hiện khối "Try one of these instead"

     Dùng lại đúng hero + nút của site (.ci-page-hero, .elementor-button) để
     trang lỗi vẫn là trang của Crimson Ink chứ không phải trang trắng của
     nginx. Chỉ có .ci-error* là CSS mới, nằm cuối site.css. --}}
<main>
    <section class="ci-page-hero ci-error-hero">
        <div class="ci-page-hero__media" role="presentation"></div>
        <div class="ci-page-hero__inner">
            <p class="ci-error__code">{{ $code }}</p>
            <h1 class="ci-page-hero__title">{{ $heading }}</h1>
            <p class="ci-error__lead">{{ $lead }}</p>
        </div>
    </section>

    <section class="ci-error">
        <div class="ci-error__inner">
            @if ($showLinks ?? true)
                <h2 class="ci-error__subtitle">Try one of these instead</h2>

                <ul class="ci-error__links">
                    <li><a href="{{ route('page.tattoo-styles') }}"><span>Tattoo Styles</span>Fineline, blackwork, realism, Japanese and more</a></li>
                    <li><a href="{{ route('page.gallery') }}"><span>Gallery</span>Real work from our studio in Hanoi</a></li>
                    <li><a href="{{ route('page.artists') }}"><span>Artists</span>Who you will be sitting with</a></li>
                    <li><a href="{{ route('page.blog') }}"><span>Tattoo Blog</span>Aftercare, healing and what to expect</a></li>
                    <li><a href="{{ route('page.faqs') }}"><span>FAQs</span>Pricing, hygiene, walk-ins, deposits</a></li>
                    <li><a href="{{ route('page.about-us') }}"><span>About Us</span>How the studio works</a></li>
                </ul>
            @endif

            <div class="ci-error__cta">
                <a class="elementor-button elementor-button-link elementor-size-sm" href="{{ route('page.contact-us') }}">
                    <span class="elementor-button-content-wrapper">
                        <span class="elementor-button-text">Book an appointment</span>
                    </span>
                </a>
                <a class="ci-error__home" href="{{ route('page.home') }}">or go back to the homepage</a>
            </div>
        </div>
    </section>
</main>
