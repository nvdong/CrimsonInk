{{-- Sinh tu ban clone tinh cua mrdolphintattoo.com. View rieng cho trang: /eyebrows-tattoo --}}
@extends('layouts.app')

@section('title', 'Eyebrow Tattoo Bali – Natural Brow Art | Mr. Dolphin Tattoo')
@section('body_class', 'wp-singular page-template page-template-elementor_header_footer page page-id-226 wp-custom-logo wp-embed-responsive wp-theme-hello-elementor ehf-header ehf-footer ehf-template-hello-elementor ehf-stylesheet-hello-elementor hello-elementor-default elementor-default elementor-template-full-width elementor-kit-6 elementor-page elementor-page-226')

@push('styles')
<link rel='stylesheet' id='widget-divider-css' href='{{ asset('assets/css/widget-divider.min.css') }}' media='all' />
<link rel='stylesheet' id='swiper-css' href='{{ asset('assets/css/swiper.min.css') }}' media='all' />
<link rel='stylesheet' id='e-swiper-css' href='{{ asset('assets/css/e-swiper.min.css') }}' media='all' />
<link rel='stylesheet' id='widget-image-gallery-css' href='{{ asset('assets/css/widget-image-gallery.min.css') }}' media='all' />
<link rel='stylesheet' id='elementor-post-226-css' href='{{ asset('assets/css/post-226.css') }}' media='all' />
@endpush

@section('head')
<meta name="description" content="Get professional eyebrow tattoo in Bali at Mr. Dolphin Tattoo. Enjoy natural brows with microblading and shading by experienced artists." />
<link rel="canonical" href="{{ route('page.eyebrows-tattoo') }}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{ route('page.eyebrows-tattoo') }}" />
<meta property="article:modified_time" content="2026-01-13T05:29:05+00:00" />
<meta property="og:image" content="{{ asset('assets/images/header-eyebrows.jpg') }}" />
<meta property="og:image:width" content="1920" />
<meta property="og:image:height" content="1280" />
<meta property="og:image:type" content="image/jpeg" />
<meta name="twitter:label1" content="Est. reading time" />
<meta name="twitter:data1" content="2 minutes" />
<script type="application/ld+json" class="yoast-schema-graph">{"@context":"https:\/\/schema.org","@graph":[{"@type":"WebPage","@id":"{{ route('page.eyebrows-tattoo') }}","url":"{{ route('page.eyebrows-tattoo') }}","name":"Eyebrow Tattoo Bali – Natural Brow Art | Mr. Dolphin Tattoo","isPartOf":{"@id":"{{ route('page.home') }}#website"},"primaryImageOfPage":{"@id":"{{ route('page.eyebrows-tattoo') }}#primaryimage"},"image":{"@id":"{{ route('page.eyebrows-tattoo') }}#primaryimage"},"thumbnailUrl":"{{ asset('assets/images/header-eyebrows.jpg') }}","datePublished":"2023-12-19T12:30:01+00:00","dateModified":"2026-01-13T05:29:05+00:00","description":"Get professional eyebrow tattoo in Bali at Mr. Dolphin Tattoo. Enjoy natural brows with microblading and shading by experienced artists.","breadcrumb":{"@id":"{{ route('page.eyebrows-tattoo') }}#breadcrumb"},"inLanguage":"en-US","potentialAction":[{"@type":"ReadAction","target":["{{ route('page.eyebrows-tattoo') }}"]}]},{"@type":"ImageObject","inLanguage":"en-US","@id":"{{ route('page.eyebrows-tattoo') }}#primaryimage","url":"{{ asset('assets/images/header-eyebrows.jpg') }}","contentUrl":"{{ asset('assets/images/header-eyebrows.jpg') }}","width":1920,"height":1280,"caption":"Eyebrows Tattoo in bali"},{"@type":"BreadcrumbList","@id":"{{ route('page.eyebrows-tattoo') }}#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"name":"Home","item":"{{ route('page.home') }}"},{"@type":"ListItem","position":2,"name":"Eyebrows Tattoo"}]},{"@type":"WebSite","@id":"{{ route('page.home') }}#website","url":"{{ route('page.home') }}","name":"Mr. Dolphin Tattoo Studio","description":"The Best Tattoo Studio and Piercing in Bali","publisher":{"@id":"{{ route('page.home') }}#organization"},"alternateName":"Mr. Dolphin Tattoo Studio","potentialAction":[{"@type":"SearchAction","target":{"@type":"EntryPoint","urlTemplate":"{{ route('page.home') }}?s={search_term_string}"},"query-input":{"@type":"PropertyValueSpecification","valueRequired":true,"valueName":"search_term_string"}}],"inLanguage":"en-US"},{"@type":["Organization","Place","LocalBusiness"],"@id":"{{ route('page.home') }}#organization","name":"Mr. Dolphin Tattoo Studio","alternateName":"Mr. Dolphin Tattoo Studio","url":"{{ route('page.home') }}","logo":{"@id":"{{ route('page.eyebrows-tattoo') }}#local-main-organization-logo"},"image":{"@id":"{{ route('page.eyebrows-tattoo') }}#local-main-organization-logo"},"sameAs":["https:\/\/www.facebook.com\/dolphin.tattookuta\/","https:\/\/www.instagram.com\/dolphintattoostudio\/"],"description":"MR. DOLPHIN Tattoo Studio, the best tattoo studio in Bali and the first tattooist in Kuta since 1975, led by highly skilled and professional Balinese tattoo artists Mr. Dolphin and Junk Juz. We specialize in creating unique and custom tattoos in Bali while prioritizing your safety and satisfaction. Our studio follows the highest hygiene standards, every client receives brand-new, sterile needles that you can open yourself for peace of mind, and all equipment is thoroughly cleaned and sterilized using hospital-grade autoclave technology. Trusted by locals and travelers alike, MR. DOLPHIN Tattoo Studio is known for its exceptional artistry, safe environment, and commitment to delivering a hygienic tattoo experience in Bali.","address":{"@id":"{{ route('page.eyebrows-tattoo') }}#local-main-place-address"},"geo":{"@type":"GeoCoordinates","latitude":"-8.708831198090184","longitude":"115.16908530037763"},"telephone":["+62 878-6156-6823"],"openingHoursSpecification":[{"@type":"OpeningHoursSpecification","dayOfWeek":["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],"opens":"09:00","closes":"22:00"}],"email":"mrdolphin@mrdolphintattoo.com","areaServed":"Bali","priceRange":"$","currenciesAccepted":"IDR","paymentAccepted":"Credit Card, Debit Card & Cash"},{"@type":"PostalAddress","@id":"{{ route('page.eyebrows-tattoo') }}#local-main-place-address","streetAddress":"Jl. Melasti No.14, Legian, Kuta, Bali 80361 – Indonesia","addressLocality":"Denpasar","postalCode":"80361","addressRegion":"Bali","addressCountry":"ID"},{"@type":"ImageObject","inLanguage":"en-US","@id":"{{ route('page.eyebrows-tattoo') }}#local-main-organization-logo","url":"{{ asset('assets/images/logo-mr-dolphin-tattoo-studio.png') }}","contentUrl":"{{ asset('assets/images/logo-mr-dolphin-tattoo-studio.png') }}","width":512,"height":512,"caption":"Mr. Dolphin Tattoo Studio"}]}</script>
<meta name="ti-site-data" content="eyJyIjoiMTowITc6MCEzMDowIiwibyI6Imh0dHBzOlwvXC93d3cubXJkb2xwaGludGF0dG9vLmNvbT90aS1vbmxpbmUtdXNlcnMtZ29vZ2xlPTEmYW1wO3A9JTJGZXllYnJvd3MtdGF0dG9vJTJGJmFtcDtfd3Bub25jZT04N2JmY2VjMWNkIn0=" />
@endsection

@section('content')
<div data-elementor-type="wp-page" data-elementor-id="226" class="elementor elementor-226">
						<section class="elementor-section elementor-top-section elementor-element elementor-element-fe33637 elementor-section-height-min-height elementor-section-boxed elementor-section-height-default elementor-section-items-middle" data-id="fe33637" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-108d7f0" data-id="108d7f0" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap">
							</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-c1aa82a elementor-section-content-middle elementor-reverse-mobile elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="c1aa82a" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-e0fde62" data-id="e0fde62" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-658a5a8 elementor-widget-divider--view-line_text elementor-widget-divider--element-align-center elementor-widget elementor-widget-divider" data-id="658a5a8" data-element_type="widget" data-e-type="widget" data-widget_type="divider.default">
				<div class="elementor-widget-container">
							<div class="elementor-divider">
			<span class="elementor-divider-separator">
							<span class="elementor-divider__text elementor-divider__element">
				Eyebrow Tattoo in Bali – Natural Brow Art				</span>
						</span>
		</div>
						</div>
				</div>
				<div class="elementor-element elementor-element-735ff0c elementor-widget elementor-widget-elementskit-heading" data-id="735ff0c" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
				<div class="elementor-widget-container">
					<div class="ekit-wid-con" >
						<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
							<h2 class="ekit-heading--title elementskit-section-title "><span>CrimsonInk</span> Tattoo Studio</h2>
						</div>
					</div>
				</div>
				</div>
				<div class="elementor-element elementor-element-f29cb33 elementor-widget elementor-widget-text-editor" data-id="f29cb33" data-element_type="widget" data-e-type="widget" data-widget_type="text-editor.default">
				<div class="elementor-widget-container">
									<p>Looking for eyebrow tattoo in Bali? Mr. Dolphin Tattoo offers professional eyebrow tattoo in Bali using precise microblading and shading techniques to create natural, balanced, and long-lasting brows. Our experienced artists carefully study your face shape, skin tone, and personal style to design eyebrows that enhance your natural features. Whether you prefer a soft, subtle look or a more defined and structured arch, every eyebrow tattoo is fully customized to meet your expectations. Using high-quality pigments and advanced techniques, we ensure results that look realistic and age beautifully over time. In a clean, safe, and comfortable studio environment, you can relax knowing you are in expert hands. Let Mr. Dolphin Tattoo transform your beauty routine with eyebrow tattooing that delivers confidence, symmetry, and effortless elegance every day.</p>
								</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-4d727da elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="4d727da" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-ff12a39" data-id="ff12a39" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-51a4e3c gallery-spacing-custom elementor-widget elementor-widget-image-gallery" data-id="51a4e3c" data-element_type="widget" data-e-type="widget" data-widget_type="image-gallery.default">
				<div class="elementor-widget-container">
							<div class="elementor-image-gallery">
			<div id='gallery-1' class='gallery galleryid-226 gallery-columns-4 gallery-size-full'><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="51a4e3c" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDM5LCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC9leWVicm93LXRhdHRvby0xLmpwZyIsInNsaWRlc2hvdyI6IjUxYTRlM2MifQ%3D%3D" href='{{ asset('assets/images/eyebrow-tattoo-1.jpg') }}'><img decoding="async" width="600" height="800" src="{{ asset('assets/images/eyebrow-tattoo-1.jpg') }}" class="attachment-full size-full" alt="Eyebrows Tattoo" srcset="{{ asset('assets/images/eyebrow-tattoo-1.jpg') }} 600w, {{ asset('assets/images/eyebrow-tattoo-1-225x300.jpg') }} 225w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="51a4e3c" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDQwLCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC9leWVicm93LXRhdHRvby0yLmpwZyIsInNsaWRlc2hvdyI6IjUxYTRlM2MifQ%3D%3D" href='{{ asset('assets/images/eyebrow-tattoo-2.jpg') }}'><img decoding="async" width="600" height="800" src="{{ asset('assets/images/eyebrow-tattoo-2.jpg') }}" class="attachment-full size-full" alt="Eyebrows Tattoo" srcset="{{ asset('assets/images/eyebrow-tattoo-2.jpg') }} 600w, {{ asset('assets/images/eyebrow-tattoo-2-225x300.jpg') }} 225w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="51a4e3c" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDQxLCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC9leWVicm93LXRhdHRvby0zLmpwZyIsInNsaWRlc2hvdyI6IjUxYTRlM2MifQ%3D%3D" href='{{ asset('assets/images/eyebrow-tattoo-3.jpg') }}'><img loading="lazy" decoding="async" width="600" height="800" src="{{ asset('assets/images/eyebrow-tattoo-3.jpg') }}" class="attachment-full size-full" alt="Eyebrows Tattoo" srcset="{{ asset('assets/images/eyebrow-tattoo-3.jpg') }} 600w, {{ asset('assets/images/eyebrow-tattoo-3-225x300.jpg') }} 225w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="51a4e3c" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDQyLCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC9leWVicm93LXRhdHRvby00LmpwZyIsInNsaWRlc2hvdyI6IjUxYTRlM2MifQ%3D%3D" href='{{ asset('assets/images/eyebrow-tattoo-4.jpg') }}'><img loading="lazy" decoding="async" width="600" height="800" src="{{ asset('assets/images/eyebrow-tattoo-4.jpg') }}" class="attachment-full size-full" alt="Eyebrows Tattoo" srcset="{{ asset('assets/images/eyebrow-tattoo-4.jpg') }} 600w, {{ asset('assets/images/eyebrow-tattoo-4-225x300.jpg') }} 225w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure>
		</div>
		</div>
						</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				</div>
@endsection

@push('elementor-config')
<script id="elementor-frontend-js-before">
var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":false},"i18n":{"shareOnFacebook":"Share on Facebook","shareOnX":"Share on X","pinIt":"Pin it","download":"Download","downloadImage":"Download image","fullscreen":"Fullscreen","zoom":"Zoom","share":"Share","playVideo":"Play Video","previous":"Previous","next":"Next","close":"Close","a11yCarouselPrevSlideMessage":"Previous slide","a11yCarouselNextSlideMessage":"Next slide","a11yCarouselFirstSlideMessage":"This is the first slide","a11yCarouselLastSlideMessage":"This is the last slide","a11yCarouselPaginationBulletMessage":"Go to slide"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"responsive":{"breakpoints":{"mobile":{"label":"Mobile Portrait","value":767,"default_value":767,"direction":"max","is_enabled":true},"mobile_extra":{"label":"Mobile Landscape","value":880,"default_value":880,"direction":"max","is_enabled":false},"tablet":{"label":"Tablet Portrait","value":1024,"default_value":1024,"direction":"max","is_enabled":true},"tablet_extra":{"label":"Tablet Landscape","value":1200,"default_value":1200,"direction":"max","is_enabled":false},"laptop":{"label":"Laptop","value":1366,"default_value":1366,"direction":"max","is_enabled":false},"widescreen":{"label":"Widescreen","value":2400,"default_value":2400,"direction":"min","is_enabled":false}},"hasCustomBreakpoints":false},"version":"4.2.4","is_static":false,"experimentalFeatures":{"e_font_icon_svg":true,"additional_custom_breakpoints":true,"container":true,"e_panel_promotions":true,"hello-theme-header-footer":true,"nested-elements":true,"global_classes_should_enforce_capabilities":true,"e_variables":true,"e_opt_in_v4_page":true,"e_components":true,"e_interactions":true,"e_widget_creation":true,"import-export-customization":true},"urls":{"assets":"{{ asset('assets') }}\/","ajaxurl":"{{ url('/wp-admin/admin-ajax.php') }}","uploadUrl":"{{ asset('assets/images') }}"},"nonces":{"floatingButtonsClickTracking":"fc7428cf9c","atomicFormsSendForm":"ce5b663e66"},"swiperClass":"swiper","settings":{"page":[],"editorPreferences":[]},"kit":{"active_breakpoints":["viewport_mobile","viewport_tablet"],"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","hello_header_logo_type":"logo","hello_header_menu_layout":"horizontal","hello_footer_logo_type":"logo"},"post":{"id":226,"title":"Eyebrow%20Tattoo%20Bali%20%E2%80%93%20Natural%20Brow%20Art%20%7C%20Mr.%20Dolphin%20Tattoo","excerpt":"","featuredImage":"{{ asset('assets/images/header-eyebrows.jpg') }}"}};
//# sourceURL=elementor-frontend-js-before
</script>
@endpush

@push('scripts')
<script id="swiper-js" src="{{ asset('assets/js/swiper.min.js') }}"></script>
@endpush
