{{-- Sinh tu ban clone tinh cua mrdolphintattoo.com. View rieng cho trang: /exhibition --}}
@extends('layouts.app')

@section('title', 'Tattoo Exhibition in Bali – Art &amp; Ink Showcase')
@section('body_class', 'wp-singular page-template page-template-elementor_header_footer page page-id-70 wp-custom-logo wp-embed-responsive wp-theme-hello-elementor ehf-header ehf-footer ehf-template-hello-elementor ehf-stylesheet-hello-elementor hello-elementor-default elementor-default elementor-template-full-width elementor-kit-6 elementor-page elementor-page-70')

@push('styles')
<link rel='stylesheet' id='widget-divider-css' href='{{ asset('assets/css/widget-divider.min.css') }}' media='all' />
<link rel='stylesheet' id='widget-image-css' href='{{ asset('assets/css/widget-image.min.css') }}' media='all' />
<link rel='stylesheet' id='elementor-post-70-css' href='{{ asset('assets/css/post-70.css') }}' media='all' />
@endpush

@section('head')
<meta name="description" content="Discover a tattoo exhibition in Bali at Mr. Dolphin Tattoo, showcasing creative body art, unique designs, and professional artists in Kuta." />
<link rel="canonical" href="{{ route('page.exhibition') }}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{ route('page.exhibition') }}" />
<meta property="article:modified_time" content="2026-01-13T05:37:02+00:00" />
<meta property="og:image" content="{{ asset('assets/images/exhibition-1.jpg') }}" />
<meta property="og:image:width" content="400" />
<meta property="og:image:height" content="300" />
<meta property="og:image:type" content="image/jpeg" />
<meta name="twitter:label1" content="Est. reading time" />
<meta name="twitter:data1" content="1 minute" />
<script type="application/ld+json" class="yoast-schema-graph">{"@context":"https:\/\/schema.org","@graph":[{"@type":"WebPage","@id":"{{ route('page.exhibition') }}","url":"{{ route('page.exhibition') }}","name":"Tattoo Exhibition in Bali – Art & Ink Showcase","isPartOf":{"@id":"{{ route('page.home') }}#website"},"primaryImageOfPage":{"@id":"{{ route('page.exhibition') }}#primaryimage"},"image":{"@id":"{{ route('page.exhibition') }}#primaryimage"},"thumbnailUrl":"{{ asset('assets/images/exhibition-1.jpg') }}","datePublished":"2023-12-14T04:49:31+00:00","dateModified":"2026-01-13T05:37:02+00:00","description":"Discover a tattoo exhibition in Bali at Mr. Dolphin Tattoo, showcasing creative body art, unique designs, and professional artists in Kuta.","breadcrumb":{"@id":"{{ route('page.exhibition') }}#breadcrumb"},"inLanguage":"en-US","potentialAction":[{"@type":"ReadAction","target":["{{ route('page.exhibition') }}"]}]},{"@type":"ImageObject","inLanguage":"en-US","@id":"{{ route('page.exhibition') }}#primaryimage","url":"{{ asset('assets/images/exhibition-1.jpg') }}","contentUrl":"{{ asset('assets/images/exhibition-1.jpg') }}","width":400,"height":300,"caption":"Exhibition in bali"},{"@type":"BreadcrumbList","@id":"{{ route('page.exhibition') }}#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"name":"Home","item":"{{ route('page.home') }}"},{"@type":"ListItem","position":2,"name":"Exhibition"}]},{"@type":"WebSite","@id":"{{ route('page.home') }}#website","url":"{{ route('page.home') }}","name":"Mr. Dolphin Tattoo Studio","description":"The Best Tattoo Studio and Piercing in Bali","publisher":{"@id":"{{ route('page.home') }}#organization"},"alternateName":"Mr. Dolphin Tattoo Studio","potentialAction":[{"@type":"SearchAction","target":{"@type":"EntryPoint","urlTemplate":"{{ route('page.home') }}?s={search_term_string}"},"query-input":{"@type":"PropertyValueSpecification","valueRequired":true,"valueName":"search_term_string"}}],"inLanguage":"en-US"},{"@type":["Organization","Place","LocalBusiness"],"@id":"{{ route('page.home') }}#organization","name":"Mr. Dolphin Tattoo Studio","alternateName":"Mr. Dolphin Tattoo Studio","url":"{{ route('page.home') }}","logo":{"@id":"{{ route('page.exhibition') }}#local-main-organization-logo"},"image":{"@id":"{{ route('page.exhibition') }}#local-main-organization-logo"},"sameAs":["https:\/\/www.facebook.com\/dolphin.tattookuta\/","https:\/\/www.instagram.com\/dolphintattoostudio\/"],"description":"MR. DOLPHIN Tattoo Studio, the best tattoo studio in Bali and the first tattooist in Kuta since 1975, led by highly skilled and professional Balinese tattoo artists Mr. Dolphin and Junk Juz. We specialize in creating unique and custom tattoos in Bali while prioritizing your safety and satisfaction. Our studio follows the highest hygiene standards, every client receives brand-new, sterile needles that you can open yourself for peace of mind, and all equipment is thoroughly cleaned and sterilized using hospital-grade autoclave technology. Trusted by locals and travelers alike, MR. DOLPHIN Tattoo Studio is known for its exceptional artistry, safe environment, and commitment to delivering a hygienic tattoo experience in Bali.","address":{"@id":"{{ route('page.exhibition') }}#local-main-place-address"},"geo":{"@type":"GeoCoordinates","latitude":"-8.708831198090184","longitude":"115.16908530037763"},"telephone":["+62 878-6156-6823"],"openingHoursSpecification":[{"@type":"OpeningHoursSpecification","dayOfWeek":["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],"opens":"09:00","closes":"22:00"}],"email":"mrdolphin@mrdolphintattoo.com","areaServed":"Bali","priceRange":"$","currenciesAccepted":"IDR","paymentAccepted":"Credit Card, Debit Card & Cash"},{"@type":"PostalAddress","@id":"{{ route('page.exhibition') }}#local-main-place-address","streetAddress":"Jl. Melasti No.14, Legian, Kuta, Bali 80361 – Indonesia","addressLocality":"Denpasar","postalCode":"80361","addressRegion":"Bali","addressCountry":"ID"},{"@type":"ImageObject","inLanguage":"en-US","@id":"{{ route('page.exhibition') }}#local-main-organization-logo","url":"{{ asset('assets/images/logo-mr-dolphin-tattoo-studio.png') }}","contentUrl":"{{ asset('assets/images/logo-mr-dolphin-tattoo-studio.png') }}","width":512,"height":512,"caption":"Mr. Dolphin Tattoo Studio"}]}</script>
<meta name="ti-site-data" content="eyJyIjoiMTowITc6MCEzMDowIiwibyI6Imh0dHBzOlwvXC93d3cubXJkb2xwaGludGF0dG9vLmNvbT90aS1vbmxpbmUtdXNlcnMtZ29vZ2xlPTEmYW1wO3A9JTJGZXhoaWJpdGlvbiUyRiZhbXA7X3dwbm9uY2U9ODdiZmNlYzFjZCJ9" />
@endsection

@section('content')
<div data-elementor-type="wp-page" data-elementor-id="70" class="elementor elementor-70">
						<section class="elementor-section elementor-top-section elementor-element elementor-element-e02e9ca elementor-section-height-min-height elementor-section-boxed elementor-section-height-default elementor-section-items-middle" data-id="e02e9ca" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-405b782" data-id="405b782" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap">
							</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-ce92eeb elementor-section-content-middle elementor-reverse-mobile elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="ce92eeb" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-662ec8f" data-id="662ec8f" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-93511e7 elementor-widget-divider--view-line_text elementor-widget-divider--element-align-center elementor-widget elementor-widget-divider" data-id="93511e7" data-element_type="widget" data-e-type="widget" data-widget_type="divider.default">
				<div class="elementor-widget-container">
							<div class="elementor-divider">
			<span class="elementor-divider-separator">
							<span class="elementor-divider__text elementor-divider__element">
				Tattoo Exhibition in Hanoi – Art & Ink Showcase				</span>
						</span>
		</div>
						</div>
				</div>
				<div class="elementor-element elementor-element-7de1a71 elementor-widget elementor-widget-elementskit-heading" data-id="7de1a71" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
				<div class="elementor-widget-container">
					<div class="ekit-wid-con" >
						<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
							<h2 class="ekit-heading--title elementskit-section-title "><span>CrimsonInk</span> Tattoo Studio</h2>
						</div>
					</div>
				</div>
				</div>
				<div class="elementor-element elementor-element-360e67f elementor-widget elementor-widget-text-editor" data-id="360e67f" data-element_type="widget" data-e-type="widget" data-widget_type="text-editor.default">
				<div class="elementor-widget-container">
									<p>At our Tattoo Exhibition in Hanoi, you will find a wide selection of designs that illustrate the range and depth of tattoo art. From finely detailed pieces to large-scale artistic works, every piece in this Tattoo Exhibition in Hanoi represents the skill and creative vision of the artists. Visitors can learn about design meanings, artistic inspiration, and techniques used in each artwork.</p>
								</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-99ff3f0 elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="99ff3f0" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-4adc645" data-id="4adc645" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<div class="elementor-element elementor-element-d24426c elementor-widget elementor-widget-image" data-id="d24426c" data-element_type="widget" data-e-type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img decoding="async" width="400" height="300" src="{{ asset('assets/images/exhibition-1.jpg') }}" class="attachment-full size-full wp-image-375" alt="Exhibition in bali" srcset="{{ asset('assets/images/exhibition-1.jpg') }} 400w, {{ asset('assets/images/exhibition-1-300x225.jpg') }} 300w" sizes="(max-width: 400px) 100vw, 400px" />															</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-8df45ba" data-id="8df45ba" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<div class="elementor-element elementor-element-f206806 elementor-widget elementor-widget-image" data-id="f206806" data-element_type="widget" data-e-type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img decoding="async" width="400" height="300" src="{{ asset('assets/images/exhibition-2.jpg') }}" class="attachment-full size-full wp-image-376" alt="Exhibition in bali" srcset="{{ asset('assets/images/exhibition-2.jpg') }} 400w, {{ asset('assets/images/exhibition-2-300x225.jpg') }} 300w" sizes="(max-width: 400px) 100vw, 400px" />															</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				</div>
@endsection

@push('elementor-config')
<script id="elementor-frontend-js-before">
var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":false},"i18n":{"shareOnFacebook":"Share on Facebook","shareOnX":"Share on X","pinIt":"Pin it","download":"Download","downloadImage":"Download image","fullscreen":"Fullscreen","zoom":"Zoom","share":"Share","playVideo":"Play Video","previous":"Previous","next":"Next","close":"Close","a11yCarouselPrevSlideMessage":"Previous slide","a11yCarouselNextSlideMessage":"Next slide","a11yCarouselFirstSlideMessage":"This is the first slide","a11yCarouselLastSlideMessage":"This is the last slide","a11yCarouselPaginationBulletMessage":"Go to slide"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"responsive":{"breakpoints":{"mobile":{"label":"Mobile Portrait","value":767,"default_value":767,"direction":"max","is_enabled":true},"mobile_extra":{"label":"Mobile Landscape","value":880,"default_value":880,"direction":"max","is_enabled":false},"tablet":{"label":"Tablet Portrait","value":1024,"default_value":1024,"direction":"max","is_enabled":true},"tablet_extra":{"label":"Tablet Landscape","value":1200,"default_value":1200,"direction":"max","is_enabled":false},"laptop":{"label":"Laptop","value":1366,"default_value":1366,"direction":"max","is_enabled":false},"widescreen":{"label":"Widescreen","value":2400,"default_value":2400,"direction":"min","is_enabled":false}},"hasCustomBreakpoints":false},"version":"4.2.4","is_static":false,"experimentalFeatures":{"e_font_icon_svg":true,"additional_custom_breakpoints":true,"container":true,"e_panel_promotions":true,"hello-theme-header-footer":true,"nested-elements":true,"global_classes_should_enforce_capabilities":true,"e_variables":true,"e_opt_in_v4_page":true,"e_components":true,"e_interactions":true,"e_widget_creation":true,"import-export-customization":true},"urls":{"assets":"{{ asset('assets') }}\/","ajaxurl":"{{ url('/wp-admin/admin-ajax.php') }}","uploadUrl":"{{ asset('assets/images') }}"},"nonces":{"floatingButtonsClickTracking":"fc7428cf9c","atomicFormsSendForm":"ce5b663e66"},"swiperClass":"swiper","settings":{"page":[],"editorPreferences":[]},"kit":{"active_breakpoints":["viewport_mobile","viewport_tablet"],"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","hello_header_logo_type":"logo","hello_header_menu_layout":"horizontal","hello_footer_logo_type":"logo"},"post":{"id":70,"title":"Tattoo%20Exhibition%20in%20Bali%20%E2%80%93%20Art%20%26%20Ink%20Showcase","excerpt":"","featuredImage":"{{ asset('assets/images/exhibition-1.jpg') }}"}};
//# sourceURL=elementor-frontend-js-before
</script>
@endpush
