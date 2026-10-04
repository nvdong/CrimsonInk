@extends('layouts.app')
@section('title', $page->meta_title)
@section('body_class', 'home wp-singular page-template page-template-elementor_header_footer page page-id-593 wp-custom-logo wp-embed-responsive wp-theme-hello-elementor ehf-header ehf-footer ehf-template-hello-elementor ehf-stylesheet-hello-elementor hello-elementor-default elementor-default elementor-template-full-width elementor-kit-6 elementor-page elementor-page-593')

@push('styles')
<link rel='stylesheet' id='widget-heading-css' href='{{ asset('assets/css/widget-heading.min.css') }}' media='all' />
<link rel='stylesheet' id='swiper-css' href='{{ asset('assets/css/swiper.min.css') }}' media='all' />
<link rel='stylesheet' id='e-swiper-css' href='{{ asset('assets/css/e-swiper.min.css') }}' media='all' />
<link rel='stylesheet' id='widget-image-css' href='{{ asset('assets/css/widget-image.min.css') }}' media='all' />
<link rel='stylesheet' id='widget-video-css' href='{{ asset('assets/css/widget-video.min.css') }}' media='all' />
<link rel='stylesheet' id='widget-icon-list-css' href='{{ asset('assets/css/widget-icon-list.min.css') }}' media='all' />
<link rel='stylesheet' id='widget-accordion-css' href='{{ asset('assets/css/widget-accordion.min.css') }}' media='all' />
<link rel='stylesheet' id='widget-image-gallery-css' href='{{ asset('assets/css/widget-image-gallery.min.css') }}' media='all' />
<link rel='stylesheet' id='widget-nested-tabs-css' href='{{ asset('assets/css/widget-nested-tabs.min.css') }}' media='all' />
<link rel='stylesheet' id='elementor-post-593-css' href='{{ asset('assets/css/post-593.css') }}' media='all' />
@endpush

@section('head')
<meta name="description" content="{{ $page->meta_description }}" />
<link rel="canonical" href="{{ route('page.home') }}" />
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ route('page.home') }}" />
<meta property="article:modified_time" content="2026-04-23T14:19:17+00:00" />
<meta property="og:image" content="{{ asset('assets/imgs/logo.png') }}" />
<meta property="og:image:width" content="1920" />
<meta property="og:image:height" content="1280" />
<meta property="og:image:type" content="image/jpeg" />
@endsection

@section('content')

<div data-elementor-type="wp-page" data-elementor-id="593" class="elementor elementor-593">
	<section class="elementor-section elementor-top-section elementor-element elementor-element-34fa637 elementor-section-height-full elementor-section-boxed elementor-section-height-default elementor-section-items-middle" data-id="34fa637" data-element_type="section" data-e-type="section" data-settings="">
		<div class="elementor-background-overlay"></div>
		<div class="elementor-container elementor-column-gap-default">
			<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-5544a5c" data-id="5544a5c" data-element_type="column" data-e-type="column">
				<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-element elementor-element-1c1e799 elementor-widget elementor-widget-heading" data-id="1c1e799" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
						<div class="elementor-widget-container">
							<h2 class="elementor-heading-title elementor-size-default">{{ $sectionHero->eyebrow }}</h2>
						</div>
					</div>
					<div class="elementor-element elementor-element-2381997 elementor-widget elementor-widget-elementskit-heading" data-id="2381997" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
						<div class="elementor-widget-container">
							<div class="ekit-wid-con" >
								<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
									<h1 class="ekit-heading--title elementskit-section-title ">{{ $sectionHero->heading }}</h1>
								</div>
							</div>
						</div>
					</div>
					<div class="elementor-element elementor-element-78fce0f elementor-widget elementor-widget-elementskit-heading" data-id="78fce0f" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
						<div class="elementor-widget-container">
							<div class="ekit-wid-con" >
								<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
									<h1 class="ekit-heading--title elementskit-section-title "><span>Crimson Ink</span></h1>
								</div>
							</div>
						</div>
					</div>
					<div class="elementor-element elementor-element-cac82c8 elementor-widget elementor-widget-text-editor" data-id="cac82c8" data-element_type="widget" data-e-type="widget" data-widget_type="text-editor.default">
						<div class="elementor-widget-container"><p>{{ $sectionHero->subheading }}</p></div>
					</div>
					<div class="elementor-element ci-btn elementor-align-center elementor-widget elementor-widget-button" data-id="ci-btn-book" data-element_type="widget" data-e-type="widget" data-widget_type="button.default">
						<div class="elementor-widget-container">
							<div class="elementor-button-wrapper">
								<a class="elementor-button elementor-button-link elementor-size-sm" href="{{ route('page.contact-us') }}">
									<span class="elementor-button-content-wrapper">
										<span class="elementor-button-icon"><svg aria-hidden="true" class="e-font-icon-svg e-far-arrow-alt-circle-right" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M504 256C504 119 393 8 256 8S8 119 8 256s111 248 248 248 248-111 248-248zm-448 0c0-110.5 89.5-200 200-200s200 89.5 200 200-89.5 200-200 200S56 366.5 56 256zm72 20v-40c0-6.6 5.4-12 12-12h116v-67c0-10.7 12.9-16 20.5-8.5l99 99c4.7 4.7 4.7 12.3 0 17l-99 99c-7.6 7.6-20.5 2.2-20.5-8.5v-67H140c-6.6 0-12-5.4-12-12z"></path></svg></span>
										<span class="elementor-button-text">{{ $sectionWhychoose->cta_label }}</span>
									</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="elementor-section elementor-top-section elementor-element elementor-element-cfe1e00 elementor-section-content-top elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="b39e206" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
		<div class="elementor-background-overlay"></div>
		<div class="elementor-container elementor-column-gap-no">
			<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-8a31342" data-id="8a31342" data-element_type="column" data-e-type="column">
				<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-element elementor-element-276aac3 elementor-widget elementor-widget-heading" data-id="276aac3" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
						<div class="elementor-widget-container">
							<h5 class="elementor-heading-title elementor-size-default">{{ $sectionWhychoose->eyebrow }}</h5>
						</div>
					</div>
					<div class="elementor-element elementor-element-0d0a534 elementor-widget elementor-widget-elementskit-heading" data-id="0d0a534" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
						<div class="elementor-widget-container">
							<div class="ekit-wid-con" >
								<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
									<h2 class="ekit-heading--title elementskit-section-title ">{!! $sectionWhychoose->heading !!} </h2>
								</div>
							</div>
						</div>
					</div>
					<div class="elementor-element elementor-element-acf6a72 elementor-align-center elementor-widget elementor-widget-text-editor" data-id="acf6a72" data-element_type="widget" data-e-type="widget" data-widget_type="text-editor.default">
						<div class="elementor-widget-container">
							<p>{{ $sectionWhychoose->body }}</p>
						</div>
					</div>
					<div class="elementor-element ci-btn elementor-align-center elementor-widget elementor-widget-button" data-id="ci-btn-book" data-element_type="widget" data-e-type="widget" data-widget_type="button.default">
						<div class="elementor-widget-container">
							<div class="elementor-button-wrapper">
								<a class="elementor-button elementor-button-link elementor-size-sm" href="{{ route('page.contact-us') }}">
									<span class="elementor-button-content-wrapper">
										<span class="elementor-button-icon"><svg aria-hidden="true" class="e-font-icon-svg e-far-arrow-alt-circle-right" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M504 256C504 119 393 8 256 8S8 119 8 256s111 248 248 248 248-111 248-248zm-448 0c0-110.5 89.5-200 200-200s200 89.5 200 200-89.5 200-200 200S56 366.5 56 256zm72 20v-40c0-6.6 5.4-12 12-12h116v-67c0-10.7 12.9-16 20.5-8.5l99 99c4.7 4.7 4.7 12.3 0 17l-99 99c-7.6 7.6-20.5 2.2-20.5-8.5v-67H140c-6.6 0-12-5.4-12-12z"></path></svg></span>
										<span class="elementor-button-text">{{ $sectionWhychoose->cta_label }}</span>
									</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@php
    $reviewsUrl = 'https://www.google.com/maps/search/?api=1&query=Hanoiink+Tattoo';
@endphp

	<section class="elementor-section elementor-top-section elementor-element elementor-element-b39e206 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="b39e206" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
		<div class="elementor-container elementor-column-gap-no">
			<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-bf85ba7" data-id="bf85ba7" data-element_type="column" data-e-type="column">
				<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-element elementor-element-ad1531b elementor-widget elementor-widget-heading" data-id="ad1531b" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
						<div class="elementor-widget-container">
							<h5 class="elementor-heading-title elementor-size-default">{{ $sectionStyles->eyebrow }}</h5>
						</div>
					</div>
					<div class="elementor-element elementor-element-78982ed elementor-widget elementor-widget-elementskit-heading" data-id="78982ed" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
						<div class="elementor-widget-container">
							<div class="ekit-wid-con" >
								<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
									<h2 class="ekit-heading--title elementskit-section-title ">{!! $sectionStyles->heading !!}</h2>
								</div>
							</div>
						</div>
					</div>

					<div class="elementor-element ci-styles">
						<div class="swiper ci-styles__swiper">
							<div class="swiper-wrapper">
								@foreach ($tattooStyles as $i => $style)
									<a class="swiper-slide ci-style-card" href="{{ $style['url'] }}">
										<img src="{{ asset($style['cover_path']) }}" alt="{{ $style['name'] }} tattoo" loading="lazy" decoding="async" width="600" height="750">
										<span class="ci-style-card__label">{{ $i + 1 }}. {{ $style['name'] }}</span>
									</a>
								@endforeach
							</div>
						</div>
						<div class="ci-styles__pagination swiper-pagination"></div>
					</div>

					<div class="elementor-element ci-btn ci-styles-cta elementor-align-center elementor-widget elementor-widget-button" data-id="ci-btn-viewall" data-element_type="widget" data-e-type="widget" data-widget_type="button.default">
						<div class="elementor-widget-container">
							<div class="elementor-button-wrapper">
								<a class="elementor-button elementor-button-link elementor-size-sm" href="{{ route('page.tattoo-styles') }}">
									<span class="elementor-button-content-wrapper">
										<span class="elementor-button-icon"><svg aria-hidden="true" class="e-font-icon-svg e-far-arrow-alt-circle-right" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M504 256C504 119 393 8 256 8S8 119 8 256s111 248 248 248 248-111 248-248zm-448 0c0-110.5 89.5-200 200-200s200 89.5 200 200-89.5 200-200 200S56 366.5 56 256zm72 20v-40c0-6.6 5.4-12 12-12h116v-67c0-10.7 12.9-16 20.5-8.5l99 99c4.7 4.7 4.7 12.3 0 17l-99 99c-7.6 7.6-20.5 2.2-20.5-8.5v-67H140c-6.6 0-12-5.4-12-12z"></path></svg></span>
										<span class="elementor-button-text">{{ $sectionStyles->cta_label }}</span>
									</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="elementor-section elementor-top-section elementor-element elementor-element-48483e0 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="48483e0" data-element_type="section" data-e-type="section">
		<div class="elementor-container elementor-column-gap-default">
			<div class="elementor-column elementor-col-100 elementor-top-column elementor-element" data-element_type="column" data-e-type="column">
				<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-element elementor-element-d14bf44 elementor-widget elementor-widget-heading" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
						<div class="elementor-widget-container">
							<h5 class="elementor-heading-title elementor-size-default">{{ $sectionArtists->eyebrow }}</h5>
						</div>
					</div>
					<div class="elementor-element elementor-element-930f9d1 elementor-widget elementor-widget-elementskit-heading" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
						<div class="elementor-widget-container">
							<div class="ekit-wid-con" >
								<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
									<h2 class="ekit-heading--title elementskit-section-title ">{!! $sectionArtists->heading !!}</h2>
								</div>
							</div>
						</div>
					</div>

					<div class="elementor-element ci-artists">
						@foreach ($homeArtists as $i => $artist)
							@include('partials.artist-row', ['artist' => $artist, 'reverse' => $i % 2 === 1])
						@endforeach
					</div>

					@if ($hasMoreArtists)
						<div class="elementor-element ci-btn ci-artists__cta elementor-align-center elementor-widget elementor-widget-button" data-element_type="widget" data-e-type="widget" data-widget_type="button.default">
							<div class="elementor-widget-container">
								<div class="elementor-button-wrapper">
									<a class="elementor-button elementor-button-link elementor-size-sm" href="{{ route('page.artists') }}">
										<span class="elementor-button-content-wrapper">
											<span class="elementor-button-icon">@include('partials.icon-arrow')</span>
											<span class="elementor-button-text">{{ $sectionArtists->cta_label }}</span>
										</span>
									</a>
								</div>
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</section>

	<section class="elementor-section elementor-top-section elementor-element elementor-element-2a2e487 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="2a2e487" data-element_type="section" data-e-type="section" data-settings="">
	<div class="elementor-container elementor-column-gap-default">
		<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-569da24" data-id="569da24" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
				<div class="elementor-element elementor-element-d14bf44 elementor-widget elementor-widget-heading" data-id="d14bf44" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
					<div class="elementor-widget-container">
						<h5 class="elementor-heading-title elementor-size-default">{{ $sectionReview->eyebrow }}</h5>				
					</div>
				</div>
				<div class="elementor-element elementor-element-930f9d1 elementor-widget elementor-widget-elementskit-heading" data-id="930f9d1" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
					<div class="elementor-widget-container">
						<div class="ekit-wid-con" >
							<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
								<h2 class="ekit-heading--title elementskit-section-title ">{!! $sectionReview->heading !!}</h2>
							</div>
						</div>
					</div>
				</div>

				<div class="elementor-element ci-reviews">
					<div class="ci-reviews__grid">
						@foreach ($clientReviews as $review)
							<article class="ci-review">
								<div class="ci-review__head">
									@if (!empty($review['author_avatar_path']))
										<img class="ci-review__avatar" src="{{ asset($review['author_avatar_path']) }}" alt="{{ $review['author_name'] }}" loading="lazy" width="56" height="56">
									@else
										<span class="ci-review__avatar ci-review__avatar--initial" aria-hidden="true">{{ mb_substr($review['author_name'], 0, 1) }}</span>
									@endif
									<div class="ci-review__who">
										<p class="ci-review__name">{{ $review['author_name'] }}</p>
										<p class="ci-review__date">{{ $review['display_date'] }}</p>
									</div>
									@if (($review['source'] ?? null) === 'google')
										<img class="ci-review__source" src="{{ asset('assets/images/ext-cdn-icon.svg') }}" alt="Google" width="22" height="22" loading="lazy">
									@endif
								</div>

								<div class="ci-review__stars" role="img" aria-label="{{ $review['rating'] }} / 5">
									@for ($i = 1; $i <= 5; $i++)
										@if ($i <= $review['rating'])
											<svg class="ci-review__star" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.6l2.9 5.9 6.5.9-4.7 4.6 1.1 6.4L12 17.4 6.2 20.4l1.1-6.4L2.6 9.4l6.5-.9L12 2.6z"/></svg>
										@else
											<svg class="ci-review__star ci-review__star--empty" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.6l2.9 5.9 6.5.9-4.7 4.6 1.1 6.4L12 17.4 6.2 20.4l1.1-6.4L2.6 9.4l6.5-.9L12 2.6z"/></svg>
										@endif
									@endfor
								</div>

								<p class="ci-review__text">{{ $review['content'] }}</p>
							</article>
						@endforeach
					</div>
				</div>

				<div class="elementor-element ci-btn ci-reviews__cta elementor-align-center elementor-widget elementor-widget-button" data-element_type="widget" data-e-type="widget" data-widget_type="button.default">
					<div class="elementor-widget-container">
						<div class="elementor-button-wrapper">
							<a class="elementor-button elementor-button-link elementor-size-sm" href="{{ $reviewsUrl }}" target="_blank" rel="noopener nofollow">
								<span class="elementor-button-content-wrapper">
									<span class="elementor-button-icon"><svg aria-hidden="true" class="e-font-icon-svg e-far-arrow-alt-circle-right" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M504 256C504 119 393 8 256 8S8 119 8 256s111 248 248 248 248-111 248-248zm-448 0c0-110.5 89.5-200 200-200s200 89.5 200 200-89.5 200-200 200S56 366.5 56 256zm72 20v-40c0-6.6 5.4-12 12-12h116v-67c0-10.7 12.9-16 20.5-8.5l99 99c4.7 4.7 4.7 12.3 0 17l-99 99c-7.6 7.6-20.5 2.2-20.5-8.5v-67H140c-6.6 0-12-5.4-12-12z"></path></svg></span>
									<span class="elementor-button-text">{{ $sectionReview->cta_label }}</span>
								</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</section>
</div>
@endsection

@push('scripts')
<script id="swiper-js" src="{{ asset('assets/js/swiper.min.js') }}"></script>

{{-- Khoi tao carousel "Tattoo Styles". Swiper 8.4.5 da duoc nap san o tren (swiper-js). --}}
<script id="ci-styles-swiper-js">
(function () {
	function initCiStylesSwiper() {
		var el = document.querySelector('.ci-styles__swiper');
		if (!el || typeof Swiper === 'undefined' || el.dataset.ciInit) { return; }
		el.dataset.ciInit = '1';

		/* Anh cua slide nam ngoai khung nhin theo chieu ngang se khong tu load khi de loading="lazy".
		   Khi section lot vao khung nhin thi bat tat ca ve eager de luot khong bi o trong. */
		var box = el.closest('.ci-styles') || el;
		var eager = function () {
			box.querySelectorAll('img[loading="lazy"]').forEach(function (img) { img.loading = 'eager'; });
		};
		if ('IntersectionObserver' in window) {
			var io = new IntersectionObserver(function (entries) {
				if (entries.some(function (e) { return e.isIntersecting; })) { eager(); io.disconnect(); }
			}, { rootMargin: '300px 0px' });
			io.observe(box);
		} else {
			eager();
		}
		window.ciStylesSwiper = new Swiper(el, {
			slidesPerView: 1.2,
			spaceBetween: 16,
			centeredSlides: true,
			loop: true,
			watchOverflow: true,
			grabCursor: true,
			keyboard: { enabled: true },
			pagination: {
				el: '.ci-styles__pagination',
				clickable: true,
				dynamicBullets: true,
				dynamicMainBullets: 3
			},
			breakpoints: {
				768:  { slidesPerView: 2.2, spaceBetween: 20 },
				1025: { slidesPerView: 3.2, spaceBetween: 24 }
			}
		});
	}
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initCiStylesSwiper);
	} else {
		initCiStylesSwiper();
	}
})();
</script>
@endpush
