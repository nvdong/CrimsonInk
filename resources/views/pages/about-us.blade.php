@extends('layouts.app')

@section('title', 'About CrimsonInk – Best Tattoo Studio in Hanoi Since 1975')
@section('body_class', 'wp-singular page-template page-template-elementor_header_footer page page-id-606 wp-custom-logo wp-embed-responsive wp-theme-hello-elementor ehf-header ehf-footer ehf-template-hello-elementor ehf-stylesheet-hello-elementor hello-elementor-default elementor-default elementor-template-full-width elementor-kit-6 elementor-page elementor-page-606')

@push('styles')
<link rel='stylesheet' id='widget-divider-css' href='{{ asset('assets/css/widget-divider.min.css') }}' media='all' />
<link rel='stylesheet' id='swiper-css' href='{{ asset('assets/css/swiper.min.css') }}' media='all' />
<link rel='stylesheet' id='e-swiper-css' href='{{ asset('assets/css/e-swiper.min.css') }}' media='all' />
<link rel='stylesheet' id='widget-image-gallery-css' href='{{ asset('assets/css/widget-image-gallery.min.css') }}' media='all' />
<link rel='stylesheet' id='elementor-post-606-css' href='{{ asset('assets/css/post-606.css') }}' media='all' />
@endpush

@section('head')
<meta name="description" content="Discover CrimsonInk Tattoo Studio Kuta, the first tattooist in Bali offering safe, clean, and artistic tattoos by expert artists." />
<link rel="canonical" href="{{ route('page.about-us') }}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{ route('page.about-us') }}" />
<meta property="article:modified_time" content="2025-11-03T08:30:52+00:00" />
<meta property="og:image" content="{{ asset('assets/images/tattoo-artist-2.jpg') }}" />
<meta property="og:image:width" content="1920" />
<meta property="og:image:height" content="1280" />
<meta property="og:image:type" content="image/jpeg" />
<meta name="twitter:label1" content="Est. reading time" />
<meta name="twitter:data1" content="5 minutes" />
<script type="application/ld+json" class="yoast-schema-graph">{"@context":"https:\/\/schema.org","@graph":[{"@type":"WebPage","@id":"{{ route('page.about-us') }}","url":"{{ route('page.about-us') }}","name":"About CrimsonInk – Best Tattoo Studio in Hanoi Since 2025","isPartOf":{"@id":"{{ route('page.home') }}#website"},"primaryImageOfPage":{"@id":"{{ route('page.about-us') }}#primaryimage"},"image":{"@id":"{{ route('page.about-us') }}#primaryimage"},"thumbnailUrl":"{{ asset('assets/images/tattoo-artist-2.jpg') }}","datePublished":"2025-10-02T07:40:57+00:00","dateModified":"2025-11-03T08:30:52+00:00","description":"Discover CrimsonInk Tattoo Studio Kuta, the first tattooist in Bali offering safe, clean, and artistic tattoos by expert artists.","breadcrumb":{"@id":"{{ route('page.about-us') }}#breadcrumb"},"inLanguage":"en-US","potentialAction":[{"@type":"ReadAction","target":["{{ route('page.about-us') }}"]}]},{"@type":"ImageObject","inLanguage":"en-US","@id":"{{ route('page.about-us') }}#primaryimage","url":"{{ asset('assets/images/tattoo-artist-2.jpg') }}","contentUrl":"{{ asset('assets/images/tattoo-artist-2.jpg') }}","width":1920,"height":1280,"caption":"best tattoo studio in bali"},{"@type":"BreadcrumbList","@id":"{{ route('page.about-us') }}#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"name":"Home","item":"{{ route('page.home') }}"},{"@type":"ListItem","position":2,"name":"About Us"}]},{"@type":"WebSite","@id":"{{ route('page.home') }}#website","url":"{{ route('page.home') }}","name":"CrimsonInk Tattoo Studio","description":"The Best Tattoo Studio and Piercing in Bali","publisher":{"@id":"{{ route('page.home') }}#organization"},"alternateName":"CrimsonInk Tattoo Studio","potentialAction":[{"@type":"SearchAction","target":{"@type":"EntryPoint","urlTemplate":"{{ route('page.home') }}?s={search_term_string}"},"query-input":{"@type":"PropertyValueSpecification","valueRequired":true,"valueName":"search_term_string"}}],"inLanguage":"en-US"},{"@type":["Organization","Place","LocalBusiness"],"@id":"{{ route('page.home') }}#organization","name":"CrimsonInk Tattoo Studio","alternateName":"CrimsonInk Tattoo Studio","url":"{{ route('page.home') }}","logo":{"@id":"{{ route('page.about-us') }}#local-main-organization-logo"},"image":{"@id":"{{ route('page.about-us') }}#local-main-organization-logo"},"sameAs":["https:\/\/www.facebook.com\/","https:\/\/www.instagram.com\/"],"description":"CrimsonInk Tattoo Studio, the best tattoo studio in Bali and the first tattooist in Hanoi since 2025, led by highly skilled and professional Balinese tattoo artists CrimsonInk and PhongNha. We specialize in creating unique and custom tattoos in Bali while prioritizing your safety and satisfaction. Our studio follows the highest hygiene standards, every client receives brand-new, sterile needles that you can open yourself for peace of mind, and all equipment is thoroughly cleaned and sterilized using hospital-grade autoclave technology. Trusted by locals and travelers alike, CrimsonInk Tattoo Studio is known for its exceptional artistry, safe environment, and commitment to delivering a hygienic tattoo experience in Bali.","address":{"@id":"{{ route('page.about-us') }}#local-main-place-address"},"geo":{"@type":"GeoCoordinates","latitude":"-8.708831198090184","longitude":"115.16908530037763"},"telephone":["+62 878-6156-6823"],"openingHoursSpecification":[{"@type":"OpeningHoursSpecification","dayOfWeek":["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],"opens":"09:00","closes":"22:00"}],"email":"luuphongnha1990@gmail.com","areaServed":"Bali","priceRange":"$","currenciesAccepted":"IDR","paymentAccepted":"Credit Card, Debit Card & Cash"},{"@type":"PostalAddress","@id":"{{ route('page.about-us') }}#local-main-place-address","streetAddress":"Jl. Melasti No.14, Legian, Kuta, Bali 80361 – Indonesia","addressLocality":"Denpasar","postalCode":"80361","addressRegion":"Bali","addressCountry":"ID"},{"@type":"ImageObject","inLanguage":"en-US","@id":"{{ route('page.about-us') }}#local-main-organization-logo","url":"{{ asset('assets/imgs/logo.png') }}","contentUrl":"{{ asset('assets/imgs/logo.png') }}","width":512,"height":512,"caption":"CrimsonInk Tattoo Studio"}]}</script>
<meta name="ti-site-data" content="eyJyIjoiMTowITc6MCEzMDowIiwibyI6Imh0dHBzOlwvXC93d3cubXJkb2xwaGludGF0dG9vLmNvbT90aS1vbmxpbmUtdXNlcnMtZ29vZ2xlPTEmYW1wO3A9JTJGYWJvdXQtdXMlMkYmYW1wO193cG5vbmNlPTg3YmZjZWMxY2QifQ==" />
@endsection

@section('content')
<div data-elementor-type="wp-page" data-elementor-id="606" class="elementor elementor-606">
						<section class="elementor-section elementor-top-section elementor-element elementor-element-e7c603d elementor-section-height-min-height elementor-section-boxed elementor-section-height-default elementor-section-items-middle" data-id="e7c603d" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-54ef6a8" data-id="54ef6a8" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap">
							</div>
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
							<span class="elementor-divider__text elementor-divider__element">
				About				</span>
						</span>
		</div>
						</div>
				</div>
				<div class="elementor-element elementor-element-4e69ee4 elementor-widget elementor-widget-elementskit-heading" data-id="4e69ee4" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
				<div class="elementor-widget-container">
					<div class="ekit-wid-con" >
						<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
							<h2 class="ekit-heading--title elementskit-section-title "><span>CrimsonInk</span> Tattoo Studio</h2>
						</div>
					</div>
				</div>
				</div>
				<div class="elementor-element elementor-element-24a56a8 elementor-widget elementor-widget-text-editor" data-id="24a56a8" data-element_type="widget" data-e-type="widget" data-widget_type="text-editor.default">
				<div class="elementor-widget-container">
									<p data-start="540" data-end="758">Welcome to CrimsonInk Tattoo Studio, the best place for tattoos in Hanoi! We are proud to be the first tattooist in Kuta, established in 2015 by professional Balinese artists CrimsonInk and Phong Nha.</p>
									<p data-start="760" data-end="1081">At our studio, your safety and satisfaction always come first. We use new needles for every client, and you can open the packet yourself for full confidence. Every piece of equipment is clean, safe, and sterilized to hospital-grade standards using an autoclave machine approved by the health department.</p>
									<p data-start="1083" data-end="1463">Our tattoo artists also wear new surgical gloves for every customer. We use only original tattoo inks such as Eternal Inks and Intenze Inks to ensure vibrant, long-lasting colors. Whether you love freehand designs, custom artwork, or bright color tattoos, we’ve got you covered. Plus, your privacy is always respected whenever you request it.</p>
									<p data-start="1465" data-end="1794">We offer a clean, comfortable, and private environment where creativity flows freely. You can explore our wide design collection or bring your own tattoo ideas. Our artists also specialize in cover-ups and tattoo renewals, helping you refresh or transform your previous designs into something you’ll love again.</p>
									<p data-start="1796" data-end="2113">At CrimsonInk Tattoo Studio, we’re known for our friendly service and lowest price guarantee in town. You’ll enjoy a fully air-conditioned studio, great music, cinema access, and a free pick-up service. Every visit also includes complimentary stickers and a free tattoo t-shirt.</p>
									<p data-start="2115" data-end="2270">Experience the best in tattoo artistry and service at CrimsonInk Tattoo Studio — where your safety, comfort, and satisfaction always come first.</p>
								</div>
				</div>
					</div>
		</div>
					</div>
		</section>
		<div class="elementor-element elementor-element-ada4f72 e-flex e-con-boxed e-con e-parent" data-id="ada4f72" data-element_type="container" data-e-type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
					<div class="e-con-inner">
				<div class="elementor-element elementor-element-fa41fb4 gallery-spacing-custom elementor-widget elementor-widget-image-gallery" data-id="fa41fb4" data-element_type="widget" data-e-type="widget" data-widget_type="image-gallery.default">
				<div class="elementor-widget-container">
							<div class="elementor-image-gallery">
			<div id='gallery-1' class='gallery galleryid-606 gallery-columns-4 gallery-size-full'><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="fa41fb4" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NTksInVybCI6Imh0dHBzOlwvXC93d3cubXJkb2xwaGludGF0dG9vLmNvbVwvd3AtY29udGVudFwvdXBsb2Fkc1wvMjAyM1wvMTJcL3RhdHRvby1nYWxsZXJ5LTEuanBnIiwic2xpZGVzaG93IjoiZmE0MWZiNCJ9" href='{{ asset('assets/images/tattoo-gallery-1.jpg') }}'><img decoding="async" width="600" height="900" src="{{ asset('assets/images/tattoo-gallery-1.jpg') }}" class="attachment-full size-full" alt="best gallery tattoo in bali" srcset="{{ asset('assets/images/tattoo-gallery-1.jpg') }} 600w, {{ asset('assets/images/tattoo-gallery-1-200x300.jpg') }} 200w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="fa41fb4" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NjAsInVybCI6Imh0dHBzOlwvXC93d3cubXJkb2xwaGludGF0dG9vLmNvbVwvd3AtY29udGVudFwvdXBsb2Fkc1wvMjAyM1wvMTJcL3RhdHRvby1nYWxsZXJ5LTIuanBnIiwic2xpZGVzaG93IjoiZmE0MWZiNCJ9" href='{{ asset('assets/images/tattoo-gallery-2.jpg') }}'><img decoding="async" width="600" height="900" src="{{ asset('assets/images/tattoo-gallery-2.jpg') }}" class="attachment-full size-full" alt="best gallery tattoo in bali" srcset="{{ asset('assets/images/tattoo-gallery-2.jpg') }} 600w, {{ asset('assets/images/tattoo-gallery-2-200x300.jpg') }} 200w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="fa41fb4" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NjEsInVybCI6Imh0dHBzOlwvXC93d3cubXJkb2xwaGludGF0dG9vLmNvbVwvd3AtY29udGVudFwvdXBsb2Fkc1wvMjAyM1wvMTJcL3RhdHRvby1nYWxsZXJ5LTMuanBnIiwic2xpZGVzaG93IjoiZmE0MWZiNCJ9" href='{{ asset('assets/images/tattoo-gallery-3.jpg') }}'><img loading="lazy" decoding="async" width="600" height="900" src="{{ asset('assets/images/tattoo-gallery-3.jpg') }}" class="attachment-full size-full" alt="best gallery tattoo in bali" srcset="{{ asset('assets/images/tattoo-gallery-3.jpg') }} 600w, {{ asset('assets/images/tattoo-gallery-3-200x300.jpg') }} 200w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="fa41fb4" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NjIsInVybCI6Imh0dHBzOlwvXC93d3cubXJkb2xwaGludGF0dG9vLmNvbVwvd3AtY29udGVudFwvdXBsb2Fkc1wvMjAyM1wvMTJcL3RhdHRvby1nYWxsZXJ5LTQuanBnIiwic2xpZGVzaG93IjoiZmE0MWZiNCJ9" href='{{ asset('assets/images/tattoo-gallery-4.jpg') }}'><img loading="lazy" decoding="async" width="600" height="900" src="{{ asset('assets/images/tattoo-gallery-4.jpg') }}" class="attachment-full size-full" alt="best gallery tattoo in bali" srcset="{{ asset('assets/images/tattoo-gallery-4.jpg') }} 600w, {{ asset('assets/images/tattoo-gallery-4-200x300.jpg') }} 200w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="fa41fb4" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NjMsInVybCI6Imh0dHBzOlwvXC93d3cubXJkb2xwaGludGF0dG9vLmNvbVwvd3AtY29udGVudFwvdXBsb2Fkc1wvMjAyM1wvMTJcL3RhdHRvby1nYWxsZXJ5LTUuanBnIiwic2xpZGVzaG93IjoiZmE0MWZiNCJ9" href='{{ asset('assets/images/tattoo-gallery-5.jpg') }}'><img loading="lazy" decoding="async" width="600" height="900" src="{{ asset('assets/images/tattoo-gallery-5.jpg') }}" class="attachment-full size-full" alt="best gallery tattoo in bali" srcset="{{ asset('assets/images/tattoo-gallery-5.jpg') }} 600w, {{ asset('assets/images/tattoo-gallery-5-200x300.jpg') }} 200w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="fa41fb4" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NjQsInVybCI6Imh0dHBzOlwvXC93d3cubXJkb2xwaGludGF0dG9vLmNvbVwvd3AtY29udGVudFwvdXBsb2Fkc1wvMjAyM1wvMTJcL3RhdHRvby1nYWxsZXJ5LTYuanBnIiwic2xpZGVzaG93IjoiZmE0MWZiNCJ9" href='{{ asset('assets/images/tattoo-gallery-6.jpg') }}'><img loading="lazy" decoding="async" width="600" height="900" src="{{ asset('assets/images/tattoo-gallery-6.jpg') }}" class="attachment-full size-full" alt="best gallery tattoo in bali" srcset="{{ asset('assets/images/tattoo-gallery-6.jpg') }} 600w, {{ asset('assets/images/tattoo-gallery-6-200x300.jpg') }} 200w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="fa41fb4" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NjYsInVybCI6Imh0dHBzOlwvXC93d3cubXJkb2xwaGludGF0dG9vLmNvbVwvd3AtY29udGVudFwvdXBsb2Fkc1wvMjAyM1wvMTJcL3RhdHRvby1nYWxsZXJ5LTguanBnIiwic2xpZGVzaG93IjoiZmE0MWZiNCJ9" href='{{ asset('assets/images/tattoo-gallery-8.jpg') }}'><img loading="lazy" decoding="async" width="600" height="900" src="{{ asset('assets/images/tattoo-gallery-8.jpg') }}" class="attachment-full size-full" alt="best gallery tattoo in bali" srcset="{{ asset('assets/images/tattoo-gallery-8.jpg') }} 600w, {{ asset('assets/images/tattoo-gallery-8-200x300.jpg') }} 200w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="fa41fb4" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6NjUsInVybCI6Imh0dHBzOlwvXC93d3cubXJkb2xwaGludGF0dG9vLmNvbVwvd3AtY29udGVudFwvdXBsb2Fkc1wvMjAyM1wvMTJcL3RhdHRvby1nYWxsZXJ5LTcuanBnIiwic2xpZGVzaG93IjoiZmE0MWZiNCJ9" href='{{ asset('assets/images/tattoo-gallery-7.jpg') }}'><img loading="lazy" decoding="async" width="600" height="900" src="{{ asset('assets/images/tattoo-gallery-7.jpg') }}" class="attachment-full size-full" alt="best gallery tattoo in bali" srcset="{{ asset('assets/images/tattoo-gallery-7.jpg') }} 600w, {{ asset('assets/images/tattoo-gallery-7-200x300.jpg') }} 200w" sizes="(max-width: 600px) 100vw, 600px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="fa41fb4" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6MzgwLCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC90YXR0b28tZ2FsbGVyeTEuanBnIiwic2xpZGVzaG93IjoiZmE0MWZiNCJ9" href='{{ asset('assets/images/tattoo-gallery1.jpg') }}'><img loading="lazy" decoding="async" width="310" height="900" src="{{ asset('assets/images/tattoo-gallery1.jpg') }}" class="attachment-full size-full" alt="best tattoo gallery in bali" srcset="{{ asset('assets/images/tattoo-gallery1.jpg') }} 310w, {{ asset('assets/images/tattoo-gallery1-103x300.jpg') }} 103w" sizes="(max-width: 310px) 100vw, 310px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="fa41fb4" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6MzgxLCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC90YXR0b28tZ2FsbGVyeTIuanBnIiwic2xpZGVzaG93IjoiZmE0MWZiNCJ9" href='{{ asset('assets/images/tattoo-gallery2.jpg') }}'><img loading="lazy" decoding="async" width="310" height="900" src="{{ asset('assets/images/tattoo-gallery2.jpg') }}" class="attachment-full size-full" alt="best tattoo gallery in bali" srcset="{{ asset('assets/images/tattoo-gallery2.jpg') }} 310w, {{ asset('assets/images/tattoo-gallery2-103x300.jpg') }} 103w" sizes="(max-width: 310px) 100vw, 310px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="fa41fb4" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6MzgyLCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC90YXR0b28tZ2FsbGVyeTMuanBnIiwic2xpZGVzaG93IjoiZmE0MWZiNCJ9" href='{{ asset('assets/images/tattoo-gallery3.jpg') }}'><img loading="lazy" decoding="async" width="310" height="900" src="{{ asset('assets/images/tattoo-gallery3.jpg') }}" class="attachment-full size-full" alt="best tattoo gallery in bali" srcset="{{ asset('assets/images/tattoo-gallery3.jpg') }} 310w, {{ asset('assets/images/tattoo-gallery3-103x300.jpg') }} 103w" sizes="(max-width: 310px) 100vw, 310px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="fa41fb4" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6MzgzLCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC90YXR0b28tZ2FsbGVyeTQuanBnIiwic2xpZGVzaG93IjoiZmE0MWZiNCJ9" href='{{ asset('assets/images/tattoo-gallery4.jpg') }}'><img loading="lazy" decoding="async" width="310" height="900" src="{{ asset('assets/images/tattoo-gallery4.jpg') }}" class="attachment-full size-full" alt="best tattoo gallery in bali" srcset="{{ asset('assets/images/tattoo-gallery4.jpg') }} 310w, {{ asset('assets/images/tattoo-gallery4-103x300.jpg') }} 103w" sizes="(max-width: 310px) 100vw, 310px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="fa41fb4" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6Mzg0LCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC90YXR0b28tZ2FsbGVyeTUuanBnIiwic2xpZGVzaG93IjoiZmE0MWZiNCJ9" href='{{ asset('assets/images/tattoo-gallery5.jpg') }}'><img loading="lazy" decoding="async" width="310" height="900" src="{{ asset('assets/images/tattoo-gallery5.jpg') }}" class="attachment-full size-full" alt="best tattoo gallery in bali" srcset="{{ asset('assets/images/tattoo-gallery5.jpg') }} 310w, {{ asset('assets/images/tattoo-gallery5-103x300.jpg') }} 103w" sizes="(max-width: 310px) 100vw, 310px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="fa41fb4" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6Mzg1LCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC90YXR0b28tZ2FsbGVyeTYuanBnIiwic2xpZGVzaG93IjoiZmE0MWZiNCJ9" href='{{ asset('assets/images/tattoo-gallery6.jpg') }}'><img loading="lazy" decoding="async" width="310" height="900" src="{{ asset('assets/images/tattoo-gallery6.jpg') }}" class="attachment-full size-full" alt="best tattoo gallery in bali" srcset="{{ asset('assets/images/tattoo-gallery6.jpg') }} 310w, {{ asset('assets/images/tattoo-gallery6-103x300.jpg') }} 103w" sizes="(max-width: 310px) 100vw, 310px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="fa41fb4" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6Mzg2LCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC90YXR0b28tZ2FsbGVyeTcuanBnIiwic2xpZGVzaG93IjoiZmE0MWZiNCJ9" href='{{ asset('assets/images/tattoo-gallery7.jpg') }}'><img loading="lazy" decoding="async" width="310" height="900" src="{{ asset('assets/images/tattoo-gallery7.jpg') }}" class="attachment-full size-full" alt="best tattoo gallery in bali" srcset="{{ asset('assets/images/tattoo-gallery7.jpg') }} 310w, {{ asset('assets/images/tattoo-gallery7-103x300.jpg') }} 103w" sizes="(max-width: 310px) 100vw, 310px" /></a>
			</div></figure><figure class='gallery-item'>
			<div class='gallery-icon portrait'>
				<a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="fa41fb4" data-e-action-hash="#elementor-action%3Aaction%3Dlightbox%26settings%3DeyJpZCI6Mzg3LCJ1cmwiOiJodHRwczpcL1wvd3d3Lm1yZG9scGhpbnRhdHRvby5jb21cL3dwLWNvbnRlbnRcL3VwbG9hZHNcLzIwMjRcLzAxXC90YXR0b28tZ2FsbGVyeTguanBnIiwic2xpZGVzaG93IjoiZmE0MWZiNCJ9" href='{{ asset('assets/images/tattoo-gallery8.jpg') }}'><img loading="lazy" decoding="async" width="310" height="900" src="{{ asset('assets/images/tattoo-gallery8.jpg') }}" class="attachment-full size-full" alt="best tattoo gallery in bali" srcset="{{ asset('assets/images/tattoo-gallery8.jpg') }} 310w, {{ asset('assets/images/tattoo-gallery8-103x300.jpg') }} 103w" sizes="(max-width: 310px) 100vw, 310px" /></a>
			</div></figure>
		</div>
		</div>
						</div>
				</div>
					</div>
				</div>
				</div>
@endsection

@push('elementor-config')
<script id="elementor-frontend-js-before">
var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":false},"i18n":{"shareOnFacebook":"Share on Facebook","shareOnX":"Share on X","pinIt":"Pin it","download":"Download","downloadImage":"Download image","fullscreen":"Fullscreen","zoom":"Zoom","share":"Share","playVideo":"Play Video","previous":"Previous","next":"Next","close":"Close","a11yCarouselPrevSlideMessage":"Previous slide","a11yCarouselNextSlideMessage":"Next slide","a11yCarouselFirstSlideMessage":"This is the first slide","a11yCarouselLastSlideMessage":"This is the last slide","a11yCarouselPaginationBulletMessage":"Go to slide"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"responsive":{"breakpoints":{"mobile":{"label":"Mobile Portrait","value":767,"default_value":767,"direction":"max","is_enabled":true},"mobile_extra":{"label":"Mobile Landscape","value":880,"default_value":880,"direction":"max","is_enabled":false},"tablet":{"label":"Tablet Portrait","value":1024,"default_value":1024,"direction":"max","is_enabled":true},"tablet_extra":{"label":"Tablet Landscape","value":1200,"default_value":1200,"direction":"max","is_enabled":false},"laptop":{"label":"Laptop","value":1366,"default_value":1366,"direction":"max","is_enabled":false},"widescreen":{"label":"Widescreen","value":2400,"default_value":2400,"direction":"min","is_enabled":false}},"hasCustomBreakpoints":false},"version":"4.2.4","is_static":false,"experimentalFeatures":{"e_font_icon_svg":true,"additional_custom_breakpoints":true,"container":true,"e_panel_promotions":true,"hello-theme-header-footer":true,"nested-elements":true,"global_classes_should_enforce_capabilities":true,"e_variables":true,"e_opt_in_v4_page":true,"e_components":true,"e_interactions":true,"e_widget_creation":true,"import-export-customization":true},"urls":{"assets":"{{ asset('assets') }}\/","ajaxurl":"{{ url('/wp-admin/admin-ajax.php') }}","uploadUrl":"{{ asset('assets/images') }}"},"nonces":{"floatingButtonsClickTracking":"fc7428cf9c","atomicFormsSendForm":"ce5b663e66"},"swiperClass":"swiper","settings":{"page":[],"editorPreferences":[]},"kit":{"active_breakpoints":["viewport_mobile","viewport_tablet"],"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","hello_header_logo_type":"logo","hello_header_menu_layout":"horizontal","hello_footer_logo_type":"logo"},"post":{"id":606,"title":"About%20CrimsonInk%20%E2%80%93%20Best%20Tattoo%20Studio%20in%20Bali%20Since%201975","excerpt":"","featuredImage":"{{ asset('assets/images/tattoo-artist-2.jpg') }}"}};
//# sourceURL=elementor-frontend-js-before
</script>
@endpush

@push('scripts')
<script id="swiper-js" src="{{ asset('assets/js/swiper.min.js') }}"></script>
@endpush
