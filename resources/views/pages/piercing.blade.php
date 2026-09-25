{{-- Sinh tu ban clone tinh cua mrdolphintattoo.com. View rieng cho trang: /piercing --}}
@extends('layouts.app')

@section('title', 'Professional Piercing in Bali – Ear &amp; Body Piercing')
@section('body_class', 'wp-singular page-template page-template-elementor_header_footer page page-id-218 wp-custom-logo wp-embed-responsive wp-theme-hello-elementor ehf-header ehf-footer ehf-template-hello-elementor ehf-stylesheet-hello-elementor hello-elementor-default elementor-default elementor-template-full-width elementor-kit-6 elementor-page elementor-page-218')

@push('styles')
<link rel='stylesheet' id='widget-divider-css' href='{{ asset('assets/css/widget-divider.min.css') }}' media='all' />
<link rel='stylesheet' id='swiper-css' href='{{ asset('assets/css/swiper.min.css') }}' media='all' />
<link rel='stylesheet' id='e-swiper-css' href='{{ asset('assets/css/e-swiper.min.css') }}' media='all' />
<link rel='stylesheet' id='widget-image-gallery-css' href='{{ asset('assets/css/widget-image-gallery.min.css') }}' media='all' />
<link rel='stylesheet' id='elementor-post-218-css' href='{{ asset('assets/css/post-218.css') }}' media='all' />
@endpush

@section('head')
<meta name="description" content="Get safe piercing services in Bali at Mr. Dolphin Tattoo. Professional ear, body &amp; facial piercing with hygienic tools and expert aftercare." />
<link rel="canonical" href="{{ route('page.piercing') }}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{ route('page.piercing') }}" />
<meta property="article:modified_time" content="2026-01-13T05:22:49+00:00" />
<meta property="og:image" content="{{ asset('assets/images/header-piercings.jpg') }}" />
<meta property="og:image:width" content="1920" />
<meta property="og:image:height" content="1280" />
<meta property="og:image:type" content="image/jpeg" />
<meta name="twitter:label1" content="Est. reading time" />
<meta name="twitter:data1" content="4 minutes" />
<script type="application/ld+json" class="yoast-schema-graph">{"@context":"https:\/\/schema.org","@graph":[{"@type":"WebPage","@id":"{{ route('page.piercing') }}","url":"{{ route('page.piercing') }}","name":"Professional Piercing in Bali – Ear & Body Piercing","isPartOf":{"@id":"{{ route('page.home') }}#website"},"primaryImageOfPage":{"@id":"{{ route('page.piercing') }}#primaryimage"},"image":{"@id":"{{ route('page.piercing') }}#primaryimage"},"thumbnailUrl":"{{ asset('assets/images/header-piercings.jpg') }}","datePublished":"2023-12-19T12:09:03+00:00","dateModified":"2026-01-13T05:22:49+00:00","description":"Get safe piercing services in Bali at Mr. Dolphin Tattoo. Professional ear, body & facial piercing with hygienic tools and expert aftercare.","breadcrumb":{"@id":"{{ route('page.piercing') }}#breadcrumb"},"inLanguage":"en-US","potentialAction":[{"@type":"ReadAction","target":["{{ route('page.piercing') }}"]}]},{"@type":"ImageObject","inLanguage":"en-US","@id":"{{ route('page.piercing') }}#primaryimage","url":"{{ asset('assets/images/header-piercings.jpg') }}","contentUrl":"{{ asset('assets/images/header-piercings.jpg') }}","width":1920,"height":1280,"caption":"Piercing"},{"@type":"BreadcrumbList","@id":"{{ route('page.piercing') }}#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"name":"Home","item":"{{ route('page.home') }}"},{"@type":"ListItem","position":2,"name":"Piercing"}]},{"@type":"WebSite","@id":"{{ route('page.home') }}#website","url":"{{ route('page.home') }}","name":"Mr. Dolphin Tattoo Studio","description":"The Best Tattoo Studio and Piercing in Bali","publisher":{"@id":"{{ route('page.home') }}#organization"},"alternateName":"Mr. Dolphin Tattoo Studio","potentialAction":[{"@type":"SearchAction","target":{"@type":"EntryPoint","urlTemplate":"{{ route('page.home') }}?s={search_term_string}"},"query-input":{"@type":"PropertyValueSpecification","valueRequired":true,"valueName":"search_term_string"}}],"inLanguage":"en-US"},{"@type":["Organization","Place","LocalBusiness"],"@id":"{{ route('page.home') }}#organization","name":"Mr. Dolphin Tattoo Studio","alternateName":"Mr. Dolphin Tattoo Studio","url":"{{ route('page.home') }}","logo":{"@id":"{{ route('page.piercing') }}#local-main-organization-logo"},"image":{"@id":"{{ route('page.piercing') }}#local-main-organization-logo"},"sameAs":["https:\/\/www.facebook.com\/dolphin.tattookuta\/","https:\/\/www.instagram.com\/dolphintattoostudio\/"],"description":"MR. DOLPHIN Tattoo Studio, the best tattoo studio in Bali and the first tattooist in Kuta since 1975, led by highly skilled and professional Balinese tattoo artists Mr. Dolphin and Junk Juz. We specialize in creating unique and custom tattoos in Bali while prioritizing your safety and satisfaction. Our studio follows the highest hygiene standards, every client receives brand-new, sterile needles that you can open yourself for peace of mind, and all equipment is thoroughly cleaned and sterilized using hospital-grade autoclave technology. Trusted by locals and travelers alike, MR. DOLPHIN Tattoo Studio is known for its exceptional artistry, safe environment, and commitment to delivering a hygienic tattoo experience in Bali.","address":{"@id":"{{ route('page.piercing') }}#local-main-place-address"},"geo":{"@type":"GeoCoordinates","latitude":"-8.708831198090184","longitude":"115.16908530037763"},"telephone":["+62 878-6156-6823"],"openingHoursSpecification":[{"@type":"OpeningHoursSpecification","dayOfWeek":["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],"opens":"09:00","closes":"22:00"}],"email":"mrdolphin@mrdolphintattoo.com","areaServed":"Bali","priceRange":"$","currenciesAccepted":"IDR","paymentAccepted":"Credit Card, Debit Card & Cash"},{"@type":"PostalAddress","@id":"{{ route('page.piercing') }}#local-main-place-address","streetAddress":"Jl. Melasti No.14, Legian, Kuta, Bali 80361 – Indonesia","addressLocality":"Denpasar","postalCode":"80361","addressRegion":"Bali","addressCountry":"ID"},{"@type":"ImageObject","inLanguage":"en-US","@id":"{{ route('page.piercing') }}#local-main-organization-logo","url":"{{ asset('assets/images/logo-mr-dolphin-tattoo-studio.png') }}","contentUrl":"{{ asset('assets/images/logo-mr-dolphin-tattoo-studio.png') }}","width":512,"height":512,"caption":"Mr. Dolphin Tattoo Studio"}]}</script>
<meta name="ti-site-data" content="eyJyIjoiMTowITc6MCEzMDowIiwibyI6Imh0dHBzOlwvXC93d3cubXJkb2xwaGludGF0dG9vLmNvbT90aS1vbmxpbmUtdXNlcnMtZ29vZ2xlPTEmYW1wO3A9JTJGcGllcmNpbmclMkYmYW1wO193cG5vbmNlPTg3YmZjZWMxY2QifQ==" />
@endsection

@section('content')
<div data-elementor-type="wp-page" data-elementor-id="218" class="elementor elementor-218">
						<section class="elementor-section elementor-top-section elementor-element elementor-element-0f834cb elementor-section-height-min-height elementor-section-boxed elementor-section-height-default elementor-section-items-middle" data-id="0f834cb" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-52459ef" data-id="52459ef" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap">
							</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-d7b8649 elementor-section-content-middle elementor-reverse-mobile elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="d7b8649" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-b0be53b" data-id="b0be53b" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-29482e9 elementor-widget-divider--view-line_text elementor-widget-divider--element-align-center elementor-widget elementor-widget-divider" data-id="29482e9" data-element_type="widget" data-e-type="widget" data-widget_type="divider.default">
				<div class="elementor-widget-container">
							<div class="elementor-divider">
			<span class="elementor-divider-separator">
							<span class="elementor-divider__text elementor-divider__element">
				Piercing Services in Bali – Safe & Professional Piercing				</span>
						</span>
		</div>
						</div>
				</div>
				<div class="elementor-element elementor-element-e147f71 elementor-widget elementor-widget-elementskit-heading" data-id="e147f71" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
				<div class="elementor-widget-container">
					<div class="ekit-wid-con" ><div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-"><h2 class="ekit-heading--title elementskit-section-title ">Mr. Dolphin <span>Tattoo Studio</span></h2></div></div>				</div>
				</div>
				<div class="elementor-element elementor-element-2968143 elementor-widget elementor-widget-text-editor" data-id="2968143" data-element_type="widget" data-e-type="widget" data-widget_type="text-editor.default">
				<div class="elementor-widget-container">
									<p>For those seeking a professional and expert touch in the realm of piercing, look no further than Mr. Dolphin Tattoo Studio. Renowned for their skilled artisans and commitment to quality, this studio provides a diverse range of piercing options. From classic earlobe piercings to avant-garde facial piercings, their experienced team ensures precision and attention to detail in every procedure. What sets Mr. Dolphin Tattoo Studio apart is not only their expertise in piercing but also their dedication to aftercare. They understand that the journey doesn&#8217;t end with the piercing itself; proper aftercare is essential for a seamless healing process. Clients can expect personalized guidance and thorough consultations on aftercare routines, ensuring a comfortable and hygienic experience. With a reputation for excellence and a focus on client well-being, Mr. Dolphin Tattoo Studio stands as a reliable destination for those looking to embark on their piercing journey with confidence and style.</p>								</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-f3e6361 elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="f3e6361" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-dce7873" data-id="dce7873" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-f1210b7 gallery-spacing-custom elementor-widget elementor-widget-image-gallery" data-id="f1210b7" data-element_type="widget" data-e-type="widget" data-widget_type="image-gallery.default">
				<div class="elementor-widget-container">
							<div class="elementor-image-gallery">
			<div id='gallery-1' class='gallery galleryid-218 gallery-columns-4 gallery-size-full'><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="f1210b7" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDEyLCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC9waWVyY2luZy0xLmpwZyIsInNsaWRlc2hvdyI6ImYxMjEwYjcifQ%3D%3D" href='{{ asset('assets/images/piercing-1.jpg') }}'><img decoding="async" width="600" height="850" src="{{ asset('assets/images/piercing-1.jpg') }}" class="attachment-full size-full" alt="piercing in bali" srcset="{{ asset('assets/images/piercing-1.jpg') }} 600w, {{ asset('assets/images/piercing-1-212x300.jpg') }} 212w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="f1210b7" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDEzLCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC9waWVyY2luZy0yLmpwZyIsInNsaWRlc2hvdyI6ImYxMjEwYjcifQ%3D%3D" href='{{ asset('assets/images/piercing-2.jpg') }}'><img decoding="async" width="600" height="850" src="{{ asset('assets/images/piercing-2.jpg') }}" class="attachment-full size-full" alt="piercing in bali" srcset="{{ asset('assets/images/piercing-2.jpg') }} 600w, {{ asset('assets/images/piercing-2-212x300.jpg') }} 212w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="f1210b7" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDE0LCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC9waWVyY2luZy0zLmpwZyIsInNsaWRlc2hvdyI6ImYxMjEwYjcifQ%3D%3D" href='{{ asset('assets/images/piercing-3.jpg') }}'><img loading="lazy" decoding="async" width="600" height="850" src="{{ asset('assets/images/piercing-3.jpg') }}" class="attachment-full size-full" alt="piercing in bali" srcset="{{ asset('assets/images/piercing-3.jpg') }} 600w, {{ asset('assets/images/piercing-3-212x300.jpg') }} 212w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="f1210b7" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDE1LCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC9waWVyY2luZy00LmpwZyIsInNsaWRlc2hvdyI6ImYxMjEwYjcifQ%3D%3D" href='{{ asset('assets/images/piercing-4.jpg') }}'><img loading="lazy" decoding="async" width="600" height="850" src="{{ asset('assets/images/piercing-4.jpg') }}" class="attachment-full size-full" alt="piercing in bali" srcset="{{ asset('assets/images/piercing-4.jpg') }} 600w, {{ asset('assets/images/piercing-4-212x300.jpg') }} 212w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="f1210b7" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDE2LCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC9waWVyY2luZy01LmpwZyIsInNsaWRlc2hvdyI6ImYxMjEwYjcifQ%3D%3D" href='{{ asset('assets/images/piercing-5.jpg') }}'><img loading="lazy" decoding="async" width="600" height="850" src="{{ asset('assets/images/piercing-5.jpg') }}" class="attachment-full size-full" alt="piercing in bali" srcset="{{ asset('assets/images/piercing-5.jpg') }} 600w, {{ asset('assets/images/piercing-5-212x300.jpg') }} 212w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="f1210b7" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDE3LCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC9waWVyY2luZy02LmpwZyIsInNsaWRlc2hvdyI6ImYxMjEwYjcifQ%3D%3D" href='{{ asset('assets/images/piercing-6.jpg') }}'><img loading="lazy" decoding="async" width="600" height="850" src="{{ asset('assets/images/piercing-6.jpg') }}" class="attachment-full size-full" alt="piercing in bali" srcset="{{ asset('assets/images/piercing-6.jpg') }} 600w, {{ asset('assets/images/piercing-6-212x300.jpg') }} 212w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="f1210b7" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDE4LCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC9waWVyY2luZy03LmpwZyIsInNsaWRlc2hvdyI6ImYxMjEwYjcifQ%3D%3D" href='{{ asset('assets/images/piercing-7.jpg') }}'><img loading="lazy" decoding="async" width="600" height="850" src="{{ asset('assets/images/piercing-7.jpg') }}" class="attachment-full size-full" alt="piercing in bali" srcset="{{ asset('assets/images/piercing-7.jpg') }} 600w, {{ asset('assets/images/piercing-7-212x300.jpg') }} 212w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="f1210b7" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDI0LCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC9waWVyY2luZy0xMy5qcGciLCJzbGlkZXNob3ciOiJmMTIxMGI3In0%3D" href='{{ asset('assets/images/piercing-13.jpg') }}'><img loading="lazy" decoding="async" width="600" height="850" src="{{ asset('assets/images/piercing-13.jpg') }}" class="attachment-full size-full" alt="piercing in bali" srcset="{{ asset('assets/images/piercing-13.jpg') }} 600w, {{ asset('assets/images/piercing-13-212x300.jpg') }} 212w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="f1210b7" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDIwLCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC9waWVyY2luZy05LmpwZyIsInNsaWRlc2hvdyI6ImYxMjEwYjcifQ%3D%3D" href='{{ asset('assets/images/piercing-9.jpg') }}'><img loading="lazy" decoding="async" width="600" height="850" src="{{ asset('assets/images/piercing-9.jpg') }}" class="attachment-full size-full" alt="piercing in bali" srcset="{{ asset('assets/images/piercing-9.jpg') }} 600w, {{ asset('assets/images/piercing-9-212x300.jpg') }} 212w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="f1210b7" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDIxLCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC9waWVyY2luZy0xMC5qcGciLCJzbGlkZXNob3ciOiJmMTIxMGI3In0%3D" href='{{ asset('assets/images/piercing-10.jpg') }}'><img loading="lazy" decoding="async" width="600" height="850" src="{{ asset('assets/images/piercing-10.jpg') }}" class="attachment-full size-full" alt="piercing in bali" srcset="{{ asset('assets/images/piercing-10.jpg') }} 600w, {{ asset('assets/images/piercing-10-212x300.jpg') }} 212w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="f1210b7" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDIyLCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC9waWVyY2luZy0xMS5qcGciLCJzbGlkZXNob3ciOiJmMTIxMGI3In0%3D" href='{{ asset('assets/images/piercing-11.jpg') }}'><img loading="lazy" decoding="async" width="600" height="850" src="{{ asset('assets/images/piercing-11.jpg') }}" class="attachment-full size-full" alt="piercing in bali" srcset="{{ asset('assets/images/piercing-11.jpg') }} 600w, {{ asset('assets/images/piercing-11-212x300.jpg') }} 212w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="f1210b7" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NDIzLCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC9waWVyY2luZy0xMi5qcGciLCJzbGlkZXNob3ciOiJmMTIxMGI3In0%3D" href='{{ asset('assets/images/piercing-12.jpg') }}'><img loading="lazy" decoding="async" width="600" height="850" src="{{ asset('assets/images/piercing-12.jpg') }}" class="attachment-full size-full" alt="piercing in bali" srcset="{{ asset('assets/images/piercing-12.jpg') }} 600w, {{ asset('assets/images/piercing-12-212x300.jpg') }} 212w" sizes="(max-width: 600px) 100vw, 600px" /></a>
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
var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":false},"i18n":{"shareOnFacebook":"Share on Facebook","shareOnX":"Share on X","pinIt":"Pin it","download":"Download","downloadImage":"Download image","fullscreen":"Fullscreen","zoom":"Zoom","share":"Share","playVideo":"Play Video","previous":"Previous","next":"Next","close":"Close","a11yCarouselPrevSlideMessage":"Previous slide","a11yCarouselNextSlideMessage":"Next slide","a11yCarouselFirstSlideMessage":"This is the first slide","a11yCarouselLastSlideMessage":"This is the last slide","a11yCarouselPaginationBulletMessage":"Go to slide"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"responsive":{"breakpoints":{"mobile":{"label":"Mobile Portrait","value":767,"default_value":767,"direction":"max","is_enabled":true},"mobile_extra":{"label":"Mobile Landscape","value":880,"default_value":880,"direction":"max","is_enabled":false},"tablet":{"label":"Tablet Portrait","value":1024,"default_value":1024,"direction":"max","is_enabled":true},"tablet_extra":{"label":"Tablet Landscape","value":1200,"default_value":1200,"direction":"max","is_enabled":false},"laptop":{"label":"Laptop","value":1366,"default_value":1366,"direction":"max","is_enabled":false},"widescreen":{"label":"Widescreen","value":2400,"default_value":2400,"direction":"min","is_enabled":false}},"hasCustomBreakpoints":false},"version":"4.2.4","is_static":false,"experimentalFeatures":{"e_font_icon_svg":true,"additional_custom_breakpoints":true,"container":true,"e_panel_promotions":true,"hello-theme-header-footer":true,"nested-elements":true,"global_classes_should_enforce_capabilities":true,"e_variables":true,"e_opt_in_v4_page":true,"e_components":true,"e_interactions":true,"e_widget_creation":true,"import-export-customization":true},"urls":{"assets":"{{ asset('assets') }}\/","ajaxurl":"{{ url('/wp-admin/admin-ajax.php') }}","uploadUrl":"{{ asset('assets/images') }}"},"nonces":{"floatingButtonsClickTracking":"fc7428cf9c","atomicFormsSendForm":"ce5b663e66"},"swiperClass":"swiper","settings":{"page":[],"editorPreferences":[]},"kit":{"active_breakpoints":["viewport_mobile","viewport_tablet"],"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","hello_header_logo_type":"logo","hello_header_menu_layout":"horizontal","hello_footer_logo_type":"logo"},"post":{"id":218,"title":"Professional%20Piercing%20in%20Bali%20%E2%80%93%20Ear%20%26%20Body%20Piercing","excerpt":"","featuredImage":"{{ asset('assets/images/header-piercings.jpg') }}"}};
//# sourceURL=elementor-frontend-js-before
</script>
@endpush

@push('scripts')
<script id="swiper-js" src="{{ asset('assets/js/swiper.min.js') }}"></script>
@endpush
