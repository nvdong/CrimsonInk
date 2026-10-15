@extends('layouts.app')

@section('title', 'About CrimsonInk – Best Tattoo Studio in Hanoi Since 2015')
@section('body_class', 'wp-singular page-template page-template-elementor_header_footer page page-id-606 wp-custom-logo wp-embed-responsive wp-theme-hello-elementor ehf-header ehf-footer ehf-template-hello-elementor ehf-stylesheet-hello-elementor hello-elementor-default elementor-default elementor-template-full-width elementor-kit-6 elementor-page elementor-page-606')

@push('styles')
<link rel='stylesheet' id='widget-divider-css' href='{{ asset('assets/css/widget-divider.min.css') }}' media='all' />
<link rel='stylesheet' id='swiper-css' href='{{ asset('assets/css/swiper.min.css') }}' media='all' />
<link rel='stylesheet' id='e-swiper-css' href='{{ asset('assets/css/e-swiper.min.css') }}' media='all' />
<link rel='stylesheet' id='widget-image-gallery-css' href='{{ asset('assets/css/widget-image-gallery.min.css') }}' media='all' />
<link rel='stylesheet' id='elementor-post-606-css' href='{{ asset('assets/css/post-606.css?v=1.1') }}' media='all' />
<style type="text/css">
	.elementor-606 .elementor-element.elementor-element-fa41fb4 .gallery{
		text-align: center;
	}
	@media (min-width: 768px) {
		.elementor-widget-container .elementor-image-gallery .gallery-columns-4 .gallery-item{
			max-width: 24%;
		}
	}
</style>
@endpush

@section('meta_description', 'Crimson Ink is a tattoo studio in Ba Dinh, Hanoi. English-speaking artists, sterile single-use needles and custom designs for travellers and locals alike.')
@section('og_image', asset('assets/images/tattoo-artist-2.jpg'))
@section('og_type', 'article')

@section('head')
<link rel="canonical" href="{{ route('page.about-us') }}" />
@endsection

@section('content')

<div data-elementor-type="wp-page" data-elementor-id="606" class="elementor elementor-606">
	<section class="elementor-section elementor-top-section elementor-element elementor-element-e7c603d elementor-section-height-min-height elementor-section-boxed elementor-section-height-default elementor-section-items-middle" data-id="e7c603d" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
		<div class="elementor-background-overlay"></div>
		<div class="elementor-container elementor-column-gap-default">
			<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-54ef6a8" data-id="54ef6a8" data-element_type="column" data-e-type="column">
				<div class="elementor-widget-wrap"></div>
			</div>
		</div>
	</section>
	<section class="elementor-section elementor-top-section elementor-element elementor-element-438580c elementor-section-content-middle elementor-reverse-mobile elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="438580c" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
		<div class="elementor-background-overlay"></div>
		<div class="elementor-container elementor-column-gap-default">
			<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-466264e" data-id="466264e" data-element_type="column" data-e-type="column">
				<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-element elementor-element-2a001e5 elementor-widget-divider--view-line_text elementor-widget-divider--element-align-center elementor-widget elementor-widget-divider" data-id="2a001e5" data-element_type="widget" data-e-type="widget" data-widget_type="divider.default">
						<div class="elementor-widget-container">
							<div class="elementor-divider">
								<span class="elementor-divider-separator">
									<span class="elementor-divider__text elementor-divider__element">About</span>
								</span>
							</div>
						</div>
					</div>
					<div class="elementor-element elementor-element-4e69ee4 elementor-widget elementor-widget-elementskit-heading" data-id="4e69ee4" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
						<div class="elementor-widget-container">
							<div class="ekit-wid-con" >
								<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
									<h1 class="ekit-heading--title elementskit-section-title "><span>CrimsonInk</span> Tattoo Studio in Hanoi</h1>
								</div>
							</div>
						</div>
					</div>
					<div class="elementor-element elementor-element-24a56a8 elementor-widget elementor-widget-text-editor" data-id="24a56a8" data-element_type="widget" data-e-type="widget" data-widget_type="text-editor.default">
						<div class="elementor-widget-container">
							{!! $page->body !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	{{-- <div class="elementor-element elementor-element-ada4f72 e-flex e-con-boxed e-con e-parent elementor-aboutUs" data-id="ada4f72" data-element_type="container" data-e-type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
		<div class="e-con-inner">
			<div class="elementor-element elementor-element-fa41fb4 gallery-spacing-custom elementor-widget elementor-widget-image-gallery" data-id="fa41fb4" data-element_type="widget" data-e-type="widget" data-widget_type="image-gallery.default">
				<div class="elementor-widget-container">
					<div class="elementor-image-gallery">
						<div id='gallery-1' class='gallery galleryid-606 gallery-columns-4 gallery-size-full'>
							@foreach ($gallery as $item)
								@php $src = $item->path ? asset($item->path) : null; @endphp
								@continue (! $src)

								<figure class='gallery-item'>
									<div class='gallery-icon portrait'>
										<a href='{{ $src }}'
											data-ci-lightbox
											data-ci-type="{{ $item->type }}"
											data-elementor-open-lightbox="no"
											aria-label="{{ $item->alt ?: 'CrimsonInk Tattoo Studio' }}">
											<img decoding="async" width="600" height="900" src="{{ $src }}"
												class="attachment-full size-full"
												alt="{{ $item->alt ?: 'CrimsonInk Tattoo Studio' }}"
												loading="lazy" />
										</a>
									</div>
								</figure>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> --}}
</div>

@include('partials.lightbox')
@endsection

@push('scripts')
<script id="swiper-js" src="{{ asset('assets/js/swiper.min.js') }}"></script>
@endpush
