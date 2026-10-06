@extends('layouts.app')

@section('title', 'Creative Tattoo Gallery Hanoi | Custom Art &amp; Inspiration')
@section('body_class', 'wp-singular page-template page-template-elementor_header_footer page page-id-76 wp-custom-logo wp-embed-responsive wp-theme-hello-elementor ehf-header ehf-footer ehf-template-hello-elementor ehf-stylesheet-hello-elementor hello-elementor-default elementor-default elementor-template-full-width elementor-kit-6 elementor-page elementor-page-76')

@push('styles')
<link rel='stylesheet' id='widget-divider-css' href='{{ asset('assets/css/widget-divider.min.css') }}' media='all' />
<link rel='stylesheet' id='elementor-post-76-css' href='{{ asset('assets/css/post-76.css') }}' media='all' />
@endpush

@section('head')
<meta name="description" content="Get inspired by our Hanoi tattoo gallery. Explore unique tattoo styles, custom artwork, and creative designs crafted by professional artists." />
<link rel="canonical" href="{{ route('page.gallery') }}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{ route('page.gallery') }}" />
<meta property="og:image" content="{{ asset('assets/images/tattoo-gallery-2.jpg') }}" />
<meta property="og:image:width" content="600" />
<meta property="og:image:height" content="900" />
<meta property="og:image:type" content="image/jpeg" />
@endsection

@section('content')
<div data-elementor-type="wp-page" data-elementor-id="76" class="elementor elementor-76">
						<section class="elementor-section elementor-top-section elementor-element elementor-element-f432690 elementor-section-height-min-height elementor-section-boxed elementor-section-height-default elementor-section-items-middle" data-id="f432690" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-fb6f0b3" data-id="fb6f0b3" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap">
							</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-c06b2bf elementor-section-content-middle elementor-reverse-mobile elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="c06b2bf" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-4fbb789" data-id="4fbb789" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-14ab313 elementor-widget-divider--view-line_text elementor-widget-divider--element-align-center elementor-widget elementor-widget-divider" data-id="14ab313" data-element_type="widget" data-e-type="widget" data-widget_type="divider.default">
				<div class="elementor-widget-container">
							<div class="elementor-divider">
			<span class="elementor-divider-separator">
							<span class="elementor-divider__text elementor-divider__element">
				Photo &amp; Video Gallery				</span>
						</span>
		</div>
						</div>
				</div>
				<div class="elementor-element elementor-element-17cf1d0 elementor-widget elementor-widget-elementskit-heading" data-id="17cf1d0" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
				<div class="elementor-widget-container">
					<div class="ekit-wid-con" >
						<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
							<h2 class="ekit-heading--title elementskit-section-title "><span>CrimsonInk</span> Tattoo Studio</h2>
						</div>
					</div>
				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-535e636 elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-aboutUs" data-id="535e636" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-e9c659b" data-id="e9c659b" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-1d9abf4 elementor-widget elementor-widget-image-gallery" data-id="1d9abf4" data-element_type="widget" data-e-type="widget">
				<div class="elementor-widget-container">

{{-- Lưới phong cách: mỗi ô một style, ảnh đại diện là ảnh đầu tiên đã gắn
     tattoo_style_id cho style đó (xem PageController::gallery).
     Cả ô là một thẻ <a>, nên nút MORE chỉ là <span> — lồng <a> trong <a> là HTML sai. --}}
<ul class="ci-styles-grid">
@forelse ($styles as $style)
	@php $cover = $covers->get($style->id); @endphp
	@continue (! $cover || ! $cover->path)

	<li class="ci-styles-grid__item">
		<a class="ci-styles-grid__link" href="{{ route('page.tattoo-styles.show',['slug'=>$style->slug]) }}">
			<img class="ci-styles-grid__img"
				src="{{ asset($cover->path) }}"
				alt="{{ $style->name }}"
				loading="lazy" decoding="async" />

			<span class="ci-styles-grid__body">
				<span class="ci-styles-grid__name">{{ $style->name }}</span>
				<span class="ci-styles-grid__more">More</span>
			</span>
		</a>
	</li>
@empty
	<li class="ci-styles-grid__empty">Chưa có phong cách nào được gắn ảnh.</li>
@endforelse
</ul>

				</div>
				</div>
@php $instagram = collect(\App\Support\Settings::social())->firstWhere('platform', 'instagram'); @endphp
@if ($instagram)
				<div class="elementor-element ci-btn ci-gallery__cta elementor-align-center elementor-widget elementor-widget-button" data-id="ci-btn-instagram" data-element_type="widget" data-e-type="widget" data-widget_type="button.default">
				<div class="elementor-widget-container">
					<div class="elementor-button-wrapper">
						<a class="elementor-button elementor-button-link elementor-size-sm" href="{{ $instagram['url'] }}" target="_blank" rel="nofollow noopener">
							<span class="elementor-button-content-wrapper">
								<span class="elementor-button-icon elementor-align-icon-left" aria-hidden="true">@include('partials.social-icon', ['platform' => 'instagram'])</span>
								<span class="elementor-button-text">Follow on Instagram</span>
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
				</div>

@endsection
