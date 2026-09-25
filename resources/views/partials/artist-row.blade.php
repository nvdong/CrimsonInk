{{-- Một hàng artist: ảnh một bên, giới thiệu một bên. Hàng chẵn đảo chiều.
     $artist là model App\Models\Artist. --}}
@php
    $reverse = $reverse ?? false;
@endphp

<article class="ci-artist{{ $reverse ? ' ci-artist--reverse' : '' }}">
    <div class="ci-artist__media">
        <a href="{{ route('page.artists.show', $artist['slug']) }}">
            <img src="{{ asset($artist['avatar_path']) }}" alt="{{ $artist['name'] }}" loading="lazy" decoding="async" width="800" height="533">
        </a>
    </div>

    <div class="ci-artist__body">
        <h3 class="ci-artist__name">{{ $artist['name'] }}</h3>

        @if (!empty($artist['role']))
            <p class="ci-artist__role">{{ $artist['role'] }}</p>
        @endif

        <p class="ci-artist__bio">{{ $artist['bio'] }}</p>

        <div class="ci-btn ci-artist__cta">
                <div class="elementor-button-wrapper">
                    <a class="elementor-button elementor-button-link elementor-size-sm" href="{{ route('page.artists.show', $artist['slug']) }}">
                        <span class="elementor-button-content-wrapper">
                            <span class="elementor-button-icon">@include('partials.icon-arrow')</span>
                            <span class="elementor-button-text">More details</span>
                        </span>
                    </a>
                </div>
        </div>
    </div>
</article>
