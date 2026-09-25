@extends('layouts.app')
@section('title', 'Tattoo Studio in Hanoi - Crimson Ink')
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
<meta name="description" content="Looking for the best tattoo studio in Hanoi? Crimson Ink Tattoo offers custom designs, hygienic studios, and expert artists since 2000." />
<link rel="canonical" href="{{ route('page.home') }}" />
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ route('page.home') }}" />
<meta property="article:modified_time" content="2026-04-23T14:19:17+00:00" />
<meta property="og:image" content="{{ asset('assets/imgs/logo.png') }}" />
<meta property="og:image:width" content="1920" />
<meta property="og:image:height" content="1280" />
<meta property="og:image:type" content="image/jpeg" />
<script type="application/ld+json" class="yoast-schema-graph">{"@context":"https:\/\/schema.org","@graph":[{"@type":"WebPage","@id":"{{ route('page.home') }}","url":"{{ route('page.home') }}","name":"Best Tattoo Studio in Bali – Mr. Dolphin Tattoo (Since 1975)","isPartOf":{"@id":"{{ route('page.home') }}#website"},"about":{"@id":"{{ route('page.home') }}#organization"},"primaryImageOfPage":{"@id":"{{ route('page.home') }}#primaryimage"},"image":{"@id":"{{ route('page.home') }}#primaryimage"},"thumbnailUrl":"{{ asset('assets/images/tattoo-artist-1.jpg') }}","datePublished":"2025-10-02T06:56:16+00:00","dateModified":"2026-04-23T14:19:17+00:00","description":"Looking for the best tattoo studio in Bali? Mr. Dolphin Tattoo offers custom designs, hygienic studios, and expert artists since 1975.","breadcrumb":{"@id":"{{ route('page.home') }}#breadcrumb"},"inLanguage":"en-US","potentialAction":[{"@type":"ReadAction","target":["{{ route('page.home') }}"]}]},{"@type":"ImageObject","inLanguage":"en-US","@id":"{{ route('page.home') }}#primaryimage","url":"{{ asset('assets/images/tattoo-artist-1.jpg') }}","contentUrl":"{{ asset('assets/images/tattoo-artist-1.jpg') }}","width":1920,"height":1280,"caption":"best tattoo studio in bali"},{"@type":"BreadcrumbList","@id":"{{ route('page.home') }}#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"name":"Home"}]},{"@type":"WebSite","@id":"{{ route('page.home') }}#website","url":"{{ route('page.home') }}","name":"Mr. Dolphin Tattoo Studio","description":"The Best Tattoo Studio and Piercing in Bali","publisher":{"@id":"{{ route('page.home') }}#organization"},"alternateName":"Mr. Dolphin Tattoo Studio","potentialAction":[{"@type":"SearchAction","target":{"@type":"EntryPoint","urlTemplate":"{{ route('page.home') }}?s={search_term_string}"},"query-input":{"@type":"PropertyValueSpecification","valueRequired":true,"valueName":"search_term_string"}}],"inLanguage":"en-US"},{"@type":["Organization","Place","LocalBusiness"],"@id":"{{ route('page.home') }}#organization","name":"Mr. Dolphin Tattoo Studio","alternateName":"Mr. Dolphin Tattoo Studio","url":"{{ route('page.home') }}","logo":{"@id":"{{ route('page.home') }}#local-main-organization-logo"},"image":{"@id":"{{ route('page.home') }}#local-main-organization-logo"},"sameAs":["https:\/\/www.facebook.com\/dolphin.tattookuta\/","https:\/\/www.instagram.com\/dolphintattoostudio\/"],"description":"MR. DOLPHIN Tattoo Studio, the best tattoo studio in Bali and the first tattooist in Kuta since 1975, led by highly skilled and professional Balinese tattoo artists Mr. Dolphin and Junk Juz. We specialize in creating unique and custom tattoos in Bali while prioritizing your safety and satisfaction. Our studio follows the highest hygiene standards, every client receives brand-new, sterile needles that you can open yourself for peace of mind, and all equipment is thoroughly cleaned and sterilized using hospital-grade autoclave technology. Trusted by locals and travelers alike, MR. DOLPHIN Tattoo Studio is known for its exceptional artistry, safe environment, and commitment to delivering a hygienic tattoo experience in Bali.","address":{"@id":"{{ route('page.home') }}#local-main-place-address"},"geo":{"@type":"GeoCoordinates","latitude":"-8.708831198090184","longitude":"115.16908530037763"},"telephone":["+62 878-6156-6823"],"openingHoursSpecification":[{"@type":"OpeningHoursSpecification","dayOfWeek":["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],"opens":"09:00","closes":"22:00"}],"email":"mrdolphin@mrdolphintattoo.com","areaServed":"Bali","priceRange":"$","currenciesAccepted":"IDR","paymentAccepted":"Credit Card, Debit Card & Cash"},{"@type":"PostalAddress","@id":"{{ route('page.home') }}#local-main-place-address","streetAddress":"Jl. Melasti No.14, Legian, Kuta, Bali 80361 – Indonesia","addressLocality":"Denpasar","postalCode":"80361","addressRegion":"Bali","addressCountry":"ID"},{"@type":"ImageObject","inLanguage":"en-US","@id":"{{ route('page.home') }}#local-main-organization-logo","url":"{{ asset('assets/images/logo-mr-dolphin-tattoo-studio.png') }}","contentUrl":"{{ asset('assets/images/logo-mr-dolphin-tattoo-studio.png') }}","width":512,"height":512,"caption":"Mr. Dolphin Tattoo Studio"}]}</script>
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
							<h2 class="elementor-heading-title elementor-size-default">Welcome to</h2>
						</div>
					</div>
					<div class="elementor-element elementor-element-2381997 elementor-widget elementor-widget-elementskit-heading" data-id="2381997" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
						<div class="elementor-widget-container">
							<div class="ekit-wid-con" >
								<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
									<h1 class="ekit-heading--title elementskit-section-title ">Tattoo Studio in Hanoi</h1>
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
						<div class="elementor-widget-container"><p>WHERE ART MEET SKIN</p></div>
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
							<h5 class="elementor-heading-title elementor-size-default">MORE THAN TATTOOS</h5>
						</div>
					</div>
					<div class="elementor-element elementor-element-0d0a534 elementor-widget elementor-widget-elementskit-heading" data-id="0d0a534" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
						<div class="elementor-widget-container">
							<div class="ekit-wid-con" >
								<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
									<h2 class="ekit-heading--title elementskit-section-title ">Why Choose <span>Crimson Ink</span></h2>
								</div>
							</div>
						</div>
					</div>
					<div class="elementor-element elementor-element-acf6a72 elementor-align-center elementor-widget elementor-widget-text-editor" data-id="acf6a72" data-element_type="widget" data-e-type="widget" data-widget_type="text-editor.default">
						<div class="elementor-widget-container">
							<p>Every tattoo here starts with a fresh needle and hospital-grade sterilised equipment. Every design is drawn for you alone — never pulled from a template. And from the first free consultation through to aftercare, we stay with you at every step. That is why thousands of clients keep coming back.</p>
						</div>
					</div>
					<div class="elementor-element ci-btn elementor-align-center elementor-widget elementor-widget-button" data-id="ci-btn-book" data-element_type="widget" data-e-type="widget" data-widget_type="button.default">
						<div class="elementor-widget-container">
							<div class="elementor-button-wrapper">
								<a class="elementor-button elementor-button-link elementor-size-sm" href="{{ route('page.contact-us') }}">
									<span class="elementor-button-content-wrapper">
										<span class="elementor-button-icon"><svg aria-hidden="true" class="e-font-icon-svg e-far-arrow-alt-circle-right" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M504 256C504 119 393 8 256 8S8 119 8 256s111 248 248 248 248-111 248-248zm-448 0c0-110.5 89.5-200 200-200s200 89.5 200 200-89.5 200-200 200S56 366.5 56 256zm72 20v-40c0-6.6 5.4-12 12-12h116v-67c0-10.7 12.9-16 20.5-8.5l99 99c4.7 4.7 4.7 12.3 0 17l-99 99c-7.6 7.6-20.5 2.2-20.5-8.5v-67H140c-6.6 0-12-5.4-12-12z"></path></svg></span>
										<span class="elementor-button-text">Book an appointment</span>
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
    /* Dữ liệu của trang chủ lấy từ DB — sửa nội dung trong admin, không sửa file này.
       - Tattoo Styles : bảng tattoo_styles, cờ is_featured
       - My Happy Clients : bảng reviews, cờ is_featured
       - Professional Tattoo Artists : bảng artists, cờ is_featured
       Hết artist featured thì nút "View all artists" tự ẩn. */

    $tattooStyles = \App\Models\TattooStyle::active()->featured()->ordered()->get();

    $clientReviews = \App\Models\Review::active()->featured()->ordered()->get();

    $homeArtists    = \App\Models\Artist::active()->featured()->ordered()->get();
    $totalArtists   = \App\Models\Artist::active()->count();
    $hasMoreArtists = $totalArtists > $homeArtists->count();

    $reviewsUrl = 'https://www.google.com/maps/search/?api=1&query=Hanoiink+Tattoo';
@endphp

	<section class="elementor-section elementor-top-section elementor-element elementor-element-b39e206 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="b39e206" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
		<div class="elementor-container elementor-column-gap-no">
			<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-bf85ba7" data-id="bf85ba7" data-element_type="column" data-e-type="column">
				<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-element elementor-element-ad1531b elementor-widget elementor-widget-heading" data-id="ad1531b" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
						<div class="elementor-widget-container">
							<h5 class="elementor-heading-title elementor-size-default">Explore Our</h5>
						</div>
					</div>
					<div class="elementor-element elementor-element-78982ed elementor-widget elementor-widget-elementskit-heading" data-id="78982ed" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
						<div class="elementor-widget-container">
							<div class="ekit-wid-con" >
								<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
									<h2 class="ekit-heading--title elementskit-section-title ">Tattoo <span>Styles</span></h2>
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
										<span class="elementor-button-text">View all</span>
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
								<h5 class="elementor-heading-title elementor-size-default">Meet Our</h5>
							</div>
						</div>
						<div class="elementor-element elementor-element-930f9d1 elementor-widget elementor-widget-elementskit-heading" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
							<div class="elementor-widget-container">
								<div class="ekit-wid-con" >
									<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
										<h2 class="ekit-heading--title elementskit-section-title ">Professional Tattoo <span>Artists</span></h2>
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
												<span class="elementor-button-text">View all artists</span>
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
						<h5 class="elementor-heading-title elementor-size-default">Real experiences</h5>				
					</div>
				</div>
				<div class="elementor-element elementor-element-930f9d1 elementor-widget elementor-widget-elementskit-heading" data-id="930f9d1" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
					<div class="elementor-widget-container">
						<div class="ekit-wid-con" >
							<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
								<h2 class="ekit-heading--title elementskit-section-title ">My Happy <span>Clients!</span></h2>
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
									<span class="elementor-button-text">Read more reviews</span>
								</span>
							</a>
						</div>
					</div>
				</div>
			</div>
</section>



		
				</div>
@endsection

@push('elementor-config')
<script id="elementor-frontend-js-before">
var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":false},"i18n":{"shareOnFacebook":"Share on Facebook","shareOnX":"Share on X","pinIt":"Pin it","download":"Download","downloadImage":"Download image","fullscreen":"Fullscreen","zoom":"Zoom","share":"Share","playVideo":"Play Video","previous":"Previous","next":"Next","close":"Close","a11yCarouselPrevSlideMessage":"Previous slide","a11yCarouselNextSlideMessage":"Next slide","a11yCarouselFirstSlideMessage":"This is the first slide","a11yCarouselLastSlideMessage":"This is the last slide","a11yCarouselPaginationBulletMessage":"Go to slide"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"responsive":{"breakpoints":{"mobile":{"label":"Mobile Portrait","value":767,"default_value":767,"direction":"max","is_enabled":true},"mobile_extra":{"label":"Mobile Landscape","value":880,"default_value":880,"direction":"max","is_enabled":false},"tablet":{"label":"Tablet Portrait","value":1024,"default_value":1024,"direction":"max","is_enabled":true},"tablet_extra":{"label":"Tablet Landscape","value":1200,"default_value":1200,"direction":"max","is_enabled":false},"laptop":{"label":"Laptop","value":1366,"default_value":1366,"direction":"max","is_enabled":false},"widescreen":{"label":"Widescreen","value":2400,"default_value":2400,"direction":"min","is_enabled":false}},"hasCustomBreakpoints":false},"version":"4.2.4","is_static":false,"experimentalFeatures":{"e_font_icon_svg":true,"additional_custom_breakpoints":true,"container":true,"e_panel_promotions":true,"hello-theme-header-footer":true,"nested-elements":true,"global_classes_should_enforce_capabilities":true,"e_variables":true,"e_opt_in_v4_page":true,"e_components":true,"e_interactions":true,"e_widget_creation":true,"import-export-customization":true},"urls":{"assets":"{{ asset('assets') }}\/","ajaxurl":"{{ url('/wp-admin/admin-ajax.php') }}","uploadUrl":"{{ asset('assets/images') }}"},"nonces":{"floatingButtonsClickTracking":"fc7428cf9c","atomicFormsSendForm":"ce5b663e66"},"swiperClass":"swiper","settings":{"page":[],"editorPreferences":[]},"kit":{"active_breakpoints":["viewport_mobile","viewport_tablet"],"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","hello_header_logo_type":"logo","hello_header_menu_layout":"horizontal","hello_footer_logo_type":"logo"},"post":{"id":593,"title":"Best%20Tattoo%20Studio%20in%20Bali%20%E2%80%93%20Mr.%20Dolphin%20Tattoo%20%28Since%201975%29","excerpt":"","featuredImage":"{{ asset('assets/images/tattoo-artist-1.jpg') }}"}};
//# sourceURL=elementor-frontend-js-before
</script>
@endpush

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
