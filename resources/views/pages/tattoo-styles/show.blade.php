@extends('layouts.app')

@section('title', $style->meta_title ?: $style->name.' Tattoos | Crimson Ink Tattoo Studio')
@section('body_class', 'wp-singular page-template-default page page-id-681 page-child parent-pageid-806 wp-custom-logo wp-embed-responsive wp-theme-hello-elementor ehf-header ehf-footer ehf-template-hello-elementor ehf-stylesheet-hello-elementor hello-elementor-default elementor-default elementor-kit-6 elementor-page elementor-page-681')

@push('styles')
<link rel='stylesheet' id='widget-divider-css' href='{{ asset('assets/css/widget-divider.min.css') }}' media='all' />
<link rel='stylesheet' id='elementor-post-681-css' href='{{ asset('assets/css/post-681.css') }}' media='all' />
@endpush

@section('head')
@if ($style->meta_description)
<meta name="description" content="{{ $style->meta_description }}" />
@endif
<link rel="canonical" href="{{ route('page.tattoo-styles.show', $style->slug) }}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{ route('page.tattoo-styles.show', $style->slug) }}" />
@if ($style->cover_path)
<meta property="og:image" content="{{ asset($style->cover_path) }}" />
@endif
@endsection

@section('content')
<main id="content" class="site-main post-681 page type-page status-publish hentry">
	<div class="page-content">
		<div data-elementor-type="wp-page" data-elementor-id="681" class="elementor elementor-681">

			{{-- Dải ảnh đầu trang: rỗng là đúng, ảnh nền + min-height nằm trong post-681.css.
			     margin-top âm kéo nó lên nằm dưới header trong suốt. --}}
			<div class="elementor-element elementor-element-0ee3e20 e-con-full e-flex e-con e-parent" data-id="0ee3e20" data-element_type="container" data-e-type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}"></div>

			<div class="elementor-element elementor-element-bf4c6eb e-flex e-con-boxed e-con e-parent" data-id="bf4c6eb" data-element_type="container" data-e-type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
				<div class="e-con-inner">
					<div class="elementor-element elementor-element-de23025 e-con-full e-flex e-con e-child" data-id="de23025" data-element_type="container" data-e-type="container">

						<div class="elementor-element elementor-element-63872be elementor-widget-divider--view-line_text elementor-widget-divider--element-align-center elementor-widget elementor-widget-divider" data-id="63872be" data-element_type="widget" data-e-type="widget" data-widget_type="divider.default">
							<div class="elementor-widget-container">
								<div class="elementor-divider">
									<span class="elementor-divider-separator">
										<span class="elementor-divider__text elementor-divider__element">{{ $style->name }} Tattoo in Hanoi</span>
									</span>
								</div>
							</div>
						</div>

						<div class="elementor-element elementor-element-b78661e elementor-widget elementor-widget-elementskit-heading" data-id="b78661e" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
							<div class="elementor-widget-container">
								<div class="ekit-wid-con">
									<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
										<h2 class="ekit-heading--title elementskit-section-title "><span>CrimsonInk</span> Tattoo Studio</h2>
									</div>
								</div>
							</div>
						</div>

						<div class="elementor-element elementor-element-ff26e30 elementor-widget elementor-widget-text-editor" data-id="ff26e30" data-element_type="widget" data-e-type="widget" data-widget_type="text-editor.default">
							@if ($style->content)
								{!! $style->content !!}
							@elseif ($style->excerpt)
								<p>{{ $style->excerpt }}</p>
							@endif
						</div>

					</div>
				</div>
			</div>

			@if ($medias->isNotEmpty())
			<div class="elementor-element elementor-element-973e1cd e-flex e-con-boxed e-con e-parent" data-id="973e1cd" data-element_type="container" data-e-type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
				<div class="e-con-inner">
					<ul class="ci-gallery ci-gallery--style">
						@foreach ($medias as $media)
							@php
								$thumb = $media->poster_path ?: $media->path;
								$full  = $media->path ?: $media->poster_path;
								$alt   = $media->alt ?: $style->name.' tattoo at CrimsonInk Tattoo Studio';
							@endphp

							@continue (! $thumb || ! $full)

							<li class="ci-gallery__item">
								<a class="ci-gallery__link @if ($media->type !== 'image') ci-gallery__link--video @endif"
								   href="{{ asset($full) }}"
								   data-ci-lightbox
								   data-ci-type="{{ $media->type }}"
								   data-elementor-open-lightbox="no"
								   aria-label="{{ $alt }}">
									<img class="ci-gallery__img" src="{{ asset($thumb) }}" alt="{{ $alt }}"
									     loading="lazy" decoding="async" />
									@if ($media->type !== 'image')
										<span class="ci-gallery__play" aria-hidden="true">
											<svg viewBox="0 0 24 24"><path fill="currentColor" d="M8 5v14l11-7z"/></svg>
										</span>
									@endif
								</a>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
			@endif

		<div class="elementor-element elementor-element-973e1cd ci-btn ci-tattoo-style__cta elementor-align-center elementor-widget elementor-widget-button" data-id="ci-btn-instagram" data-element_type="widget" data-e-type="widget" data-widget_type="button.default">
			<div class="elementor-widget-container">
				<div class="elementor-button-wrapper">
					<a class="elementor-button elementor-button-link elementor-size-sm" href="{{ route('page.contact-us',['style_id'=>$style->id]) }}" target="_blank" rel="nofollow noopener">
						<span class="elementor-button-content-wrapper">
							<span class="elementor-button-text">Make a Booking</span>
						</span>
					</a>
				</div>
			</div>
		</div>
				

		</div>
	</div>

</main>

@include('partials.lightbox')
@endsection
