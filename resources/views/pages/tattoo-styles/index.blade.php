@extends('layouts.app')

@section('title', 'Tattoo Styles in Hanoi – Explore Every Art Style | Crimson Tattoo')
@section('body_class', 'wp-singular page-template-default page page-id-806 page-parent wp-custom-logo wp-embed-responsive wp-theme-hello-elementor ehf-header ehf-footer ehf-template-hello-elementor ehf-stylesheet-hello-elementor hello-elementor-default elementor-default elementor-kit-6 elementor-page elementor-page-806')

@push('styles')
<link rel='stylesheet' id='widget-divider-css' href='{{ asset('assets/css/widget-divider.min.css') }}' media='all' />
<link rel='stylesheet' id='widget-image-css' href='{{ asset('assets/css/widget-image.min.css') }}' media='all' />
<link rel='stylesheet' id='widget-heading-css' href='{{ asset('assets/css/widget-heading.min.css') }}' media='all' />
<link rel='stylesheet' id='elementor-post-806-css' href='{{ asset('assets/css/post-806.css') }}' media='all' />
@endpush

@section('head')
<meta name="description" content="Explore tattoo styles at Crimson Ink Tattoo in Hanoi — fineline, blackwork, realism, Japanese, tribal and more, drawn by our resident artists." />
<link rel="canonical" href="{{ route('page.tattoo-styles') }}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{ route('page.tattoo-styles') }}" />
<meta property="article:modified_time" content="2026-01-13T03:47:50+00:00" />
<meta property="og:image" content="/imgs/tattoo-categories.jpg" />
<meta property="og:image:width" content="1353" />
<meta property="og:image:height" content="764" />
<meta property="og:image:type" content="image/png" />
<meta name="twitter:label1" content="Est. reading time" />
<meta name="twitter:data1" content="2 minutes" />
@endsection

@section('content')
<main id="content" class="site-main post-806 page type-page status-publish has-post-thumbnail hentry">
	<div class="page-content">
		<div data-elementor-type="wp-page" data-elementor-id="806" class="elementor elementor-806">
			<div class="elementor-element elementor-element-bf4c6eb e-flex e-con-boxed e-con e-parent" data-id="bf4c6eb" data-element_type="container" data-e-type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
				<div class="e-con-inner">
					<div class="elementor-element elementor-element-de23025 e-con-full e-flex e-con e-child" data-id="de23025" data-element_type="container" data-e-type="container">
						<div class="elementor-element elementor-element-63872be elementor-widget-divider--view-line_text elementor-widget-divider--element-align-center elementor-widget elementor-widget-divider" data-id="63872be" data-element_type="widget" data-e-type="widget" data-widget_type="divider.default">
							<div class="elementor-widget-container">
								<div class="elementor-divider">
									<span class="elementor-divider-separator">
										<span class="elementor-divider__text elementor-divider__element">Tattoo Styles in Hanoi – Find Your Perfect Design</span>
									</span>
								</div>
							</div>
						</div>
						<div class="elementor-element elementor-element-b78661e elementor-widget elementor-widget-elementskit-heading" data-id="b78661e" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
							<div class="elementor-widget-container">
								<div class="ekit-wid-con" >
									<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
										<h2 class="ekit-heading--title elementskit-section-title ">{!! $page->heading !!}</h2>
									</div>
								</div>
							</div>
						</div>
						<div class="elementor-element elementor-element-866158d elementor-widget elementor-widget-text-editor" data-id="866158d" data-element_type="widget" data-e-type="widget" data-widget_type="text-editor.default">
							<div class="elementor-widget-container">
								{!! $page->body !!}
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="elementor-element elementor-element-973e1cd e-flex e-con-boxed e-con e-parent" data-id="973e1cd" data-element_type="container" data-e-type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
				<div class="e-con-inner">
					@foreach($tattooStyles as $tattooStyle)
					<div class="elementor-element elementor-element-93a0a64 e-con-full e-flex e-con e-child" data-id="93a0a64" data-element_type="container" data-e-type="container">
						<div class="elementor-element elementor-element-1cb9dcf e-con-full e-flex e-con e-child" data-id="1cb9dcf" data-element_type="container" data-e-type="container">
							<div class="elementor-element elementor-element-caf642d elementor-widget elementor-widget-image" data-id="caf642d" data-element_type="widget" data-e-type="widget" data-widget_type="image.default">
								<div class="elementor-widget-container">
									<img decoding="async" width="1550" height="1353" src="{{ '/'.$tattooStyle->cover_path }}" class="attachment-full size-full wp-image-809" alt="Japanese tattoo in Hanoi" srcset="{{ '/'.$tattooStyle->cover_path }} 1550w, {{ '/'.$tattooStyle->cover_path }} 300w, {{ '/'.$tattooStyle->cover_path }} 1024w, {{ '/'.$tattooStyle->cover_path }} 768w, {{ '/'.$tattooStyle->cover_path }} 1536w" sizes="(max-width: 1550px) 100vw, 1550px" />															
								</div>
							</div>
						</div>
						<div class="elementor-element elementor-element-0600d14 e-con-full e-flex e-con e-child" data-id="0600d14" data-element_type="container" data-e-type="container">
							<div class="elementor-element elementor-element-5f901dd elementor-widget elementor-widget-heading" data-id="5f901dd" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
								<div class="elementor-widget-container">
									<h2 class="elementor-heading-title elementor-size-default">{{ $tattooStyle->name }}</h2>
								</div>
							</div>
							<div class="elementor-element elementor-element-8a15854 elementor-widget elementor-widget-text-editor" data-id="8a15854" data-element_type="widget" data-e-type="widget" data-widget_type="text-editor.default">
								<div class="elementor-widget-container">
									{!! $tattooStyle->excerpt !!}
								</div>
								</div>
								<div class="elementor-element elementor-element-52e30a7 elementor-widget elementor-widget-button" data-id="52e30a7" data-element_type="widget" data-e-type="widget" data-widget_type="button.default">
									<div class="elementor-widget-container">
										<div class="elementor-button-wrapper">
											<a class="elementor-button elementor-button-link elementor-size-sm" href="{{ route($tattooStyle->route_name) }}">
												<span class="elementor-button-content-wrapper">
													<span class="elementor-button-text">Discover more</span>
												</span>
											</a>
										</div>
									</div>
								</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>

	</div>
</main>
@endsection

