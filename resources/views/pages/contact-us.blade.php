@extends('layouts.app')

@section('title', 'Book Your Appointment | Crimson Ink Tattoo Studio Hanoi')
@section('body_class', 'wp-singular page-template page-template-elementor_header_footer page page-id-85 wp-custom-logo wp-embed-responsive wp-theme-hello-elementor ehf-header ehf-footer ehf-template-hello-elementor ehf-stylesheet-hello-elementor hello-elementor-default elementor-default elementor-template-full-width elementor-kit-6 elementor-page elementor-page-85')

@push('styles')
<link rel="stylesheet" id="flatpickr-css" href="{{ asset('assets/css/flatpickr-dark.css') }}" media="all" />
<link rel='stylesheet' id='widget-divider-css' href='{{ asset('assets/css/widget-divider.min.css') }}' media='all' />
<link rel='stylesheet' id='widget-video-css' href='{{ asset('assets/css/widget-video.min.css') }}' media='all' />
<link rel='stylesheet' id='elementor-post-85-css' href='{{ asset('assets/css/post-85.css') }}' media='all' />
@endpush

@section('head')
<meta name="description" content="Book a tattoo appointment at Crimson Ink Hanoi. Send us your idea, pick an artist and a date, and we will confirm pricing before you arrive." />
<link rel="canonical" href="{{ route('page.contact-us') }}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{ route('page.contact-us') }}" />
<meta property="article:modified_time" content="2026-01-13T03:18:57+00:00" />
<meta property="og:image" content="{{ asset('assets/images/piercing.jpg') }}" />
<meta property="og:image:width" content="960" />
<meta property="og:image:height" content="640" />
<meta property="og:image:type" content="image/jpeg" />
<meta name="twitter:label1" content="Est. reading time" />
<meta name="twitter:data1" content="1 minute" />
<script type="application/ld+json" class="yoast-schema-graph">{"@context":"https:\/\/schema.org","@graph":[{"@type":"WebPage","@id":"{{ route('page.contact-us') }}","url":"{{ route('page.contact-us') }}","name":"Contact Tattoo Studio in Hanoi – CrimsonInk Tattoo","isPartOf":{"@id":"{{ route('page.home') }}#website"},"primaryImageOfPage":{"@id":"{{ route('page.contact-us') }}#primaryimage"},"image":{"@id":"{{ route('page.contact-us') }}#primaryimage"},"thumbnailUrl":"{{ asset('assets/images/piercing.jpg') }}","datePublished":"2023-12-14T05:45:56+00:00","dateModified":"2026-01-13T03:18:57+00:00","description":"Get in touch with Mr. CrimsonInk Tattoo Studio in Bali for bookings, questions, or custom tattoos. Call, email, or visit us in Legian, Kuta.","breadcrumb":{"@id":"{{ route('page.contact-us') }}#breadcrumb"},"inLanguage":"en-US","potentialAction":[{"@type":"ReadAction","target":["{{ route('page.contact-us') }}"]}]},{"@type":"ImageObject","inLanguage":"en-US","@id":"{{ route('page.contact-us') }}#primaryimage","url":"{{ asset('assets/images/piercing.jpg') }}","contentUrl":"{{ asset('assets/images/piercing.jpg') }}","width":960,"height":640,"caption":"piercing in bali"},{"@type":"BreadcrumbList","@id":"{{ route('page.contact-us') }}#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"name":"Home","item":"{{ route('page.home') }}"},{"@type":"ListItem","position":2,"name":"Contact Us"}]},{"@type":"WebSite","@id":"{{ route('page.home') }}#website","url":"{{ route('page.home') }}","name":"Mr. Dolphin Tattoo Studio","description":"The Best Tattoo Studio and Piercing in Bali","publisher":{"@id":"{{ route('page.home') }}#organization"},"alternateName":"Mr. Dolphin Tattoo Studio","potentialAction":[{"@type":"SearchAction","target":{"@type":"EntryPoint","urlTemplate":"{{ route('page.home') }}?s={search_term_string}"},"query-input":{"@type":"PropertyValueSpecification","valueRequired":true,"valueName":"search_term_string"}}],"inLanguage":"en-US"},{"@type":["Organization","Place","LocalBusiness"],"@id":"{{ route('page.home') }}#organization","name":"Mr. Dolphin Tattoo Studio","alternateName":"Mr. Dolphin Tattoo Studio","url":"{{ route('page.home') }}","logo":{"@id":"{{ route('page.contact-us') }}#local-main-organization-logo"},"image":{"@id":"{{ route('page.contact-us') }}#local-main-organization-logo"},"sameAs":["https:\/\/www.facebook.com\/dolphin.tattookuta\/","https:\/\/www.instagram.com\/dolphintattoostudio\/"],"description":"MR. DOLPHIN Tattoo Studio, the best tattoo studio in Bali and the first tattooist in Kuta since 1975, led by highly skilled and professional Balinese tattoo artists Mr. Dolphin and Junk Juz. We specialize in creating unique and custom tattoos in Bali while prioritizing your safety and satisfaction. Our studio follows the highest hygiene standards, every client receives brand-new, sterile needles that you can open yourself for peace of mind, and all equipment is thoroughly cleaned and sterilized using hospital-grade autoclave technology. Trusted by locals and travelers alike, MR. DOLPHIN Tattoo Studio is known for its exceptional artistry, safe environment, and commitment to delivering a hygienic tattoo experience in Bali.","address":{"@id":"{{ route('page.contact-us') }}#local-main-place-address"},"geo":{"@type":"GeoCoordinates","latitude":"-8.708831198090184","longitude":"115.16908530037763"},"telephone":["+62 878-6156-6823"],"openingHoursSpecification":[{"@type":"OpeningHoursSpecification","dayOfWeek":["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],"opens":"09:00","closes":"22:00"}],"email":"mrdolphin@mrdolphintattoo.com","areaServed":"Bali","priceRange":"$","currenciesAccepted":"IDR","paymentAccepted":"Credit Card, Debit Card & Cash"},{"@type":"PostalAddress","@id":"{{ route('page.contact-us') }}#local-main-place-address","streetAddress":"Jl. Melasti No.14, Legian, Kuta, Bali 80361 – Indonesia","addressLocality":"Denpasar","postalCode":"80361","addressRegion":"Bali","addressCountry":"ID"},{"@type":"ImageObject","inLanguage":"en-US","@id":"{{ route('page.contact-us') }}#local-main-organization-logo","url":"{{ asset('assets/images/logo-mr-dolphin-tattoo-studio.png') }}","contentUrl":"{{ asset('assets/images/logo-mr-dolphin-tattoo-studio.png') }}","width":512,"height":512,"caption":"Mr. Dolphin Tattoo Studio"}]}</script>
<meta name="ti-site-data" content="" />
@endsection

@section('content')
<div data-elementor-type="wp-page" data-elementor-id="85" class="elementor elementor-85">
	<section class="elementor-section elementor-top-section elementor-element elementor-element-6be3ef8 elementor-section-height-min-height elementor-section-boxed elementor-section-height-default elementor-section-items-middle" data-id="6be3ef8" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
		<div class="elementor-background-overlay"></div>
		<div class="elementor-container elementor-column-gap-default">
			<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-2a8b586" data-id="2a8b586" data-element_type="column" data-e-type="column">
				<div class="elementor-widget-wrap"></div>
			</div>
		</div>
	</section>
	<section class="elementor-section elementor-top-section elementor-element elementor-element-030d971 elementor-section-content-middle elementor-reverse-mobile elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="030d971" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
		<div class="elementor-background-overlay"></div>
			<div class="elementor-container elementor-column-gap-default">
				<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-626a4d8" data-id="626a4d8" data-element_type="column" data-e-type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-71432c2 elementor-widget-divider--view-line_text elementor-widget-divider--element-align-center elementor-widget elementor-widget-divider" data-id="71432c2" data-element_type="widget" data-e-type="widget" data-widget_type="divider.default">
				<div class="elementor-widget-container">
							<div class="elementor-divider">
			<span class="elementor-divider-separator">
							<span class="elementor-divider__text elementor-divider__element">
				Booking				</span>
						</span>
		</div>
						</div>
				</div>
				<div class="elementor-element elementor-element-240de9b elementor-widget elementor-widget-elementskit-heading" data-id="240de9b" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
				<div class="elementor-widget-container">
					<div class="ekit-wid-con" >
						<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
							<h2 class="ekit-heading--title elementskit-section-title ">Book Your <span>Appointment</span></h2>
							<p class="ci-booking__lead">Planning a trip to Hanoi? Send us your idea before you land and we will match you with the right artist and confirm pricing ahead of time.</p>
						</div>
					</div>
				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-7567eda elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="7567eda" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-e35622f" data-id="e35622f" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<div class="elementor-element ci-booking" id="booking">
							@if (session('contact_success'))
								<div class="ci-booking__alert ci-booking__alert--ok" role="alert">{{ session('contact_success') }}</div>
							@endif

							@if ($errors->any())
								<div class="ci-booking__alert ci-booking__alert--error" role="alert">
									<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
								</div>
							@endif

							<form class="ci-booking__form" method="post" action="{{ route('contact.store') }}">
								@csrf

								<div class="ci-booking__grid">
									<div class="ci-field">
										<label class="ci-field__label" for="bk-name">Full name</label>
										<input class="ci-field__control" type="text" id="bk-name" name="full_name" value="{{ old('full_name') }}" placeholder="Enter your full name" maxlength="120" required>
									</div>

									<div class="ci-field">
										<label class="ci-field__label" for="bk-phone">Phone number</label>
										<input class="ci-field__control" type="tel" id="bk-phone" name="phone"
											   value="{{ old('phone') }}" placeholder="Enter your phone number" maxlength="40" required>
									</div>

									<div class="ci-field">
										<label class="ci-field__label" for="bk-email">Email address</label>
										<input class="ci-field__control" type="email" id="bk-email" name="email"
											   value="{{ old('email') }}" placeholder="Enter your email address" maxlength="190" required>
									</div>

									<div class="ci-field">
										<label class="ci-field__label" for="bk-date">Preferred date</label>
										<input class="ci-field__control" type="date" id="bk-date" name="preferred_date" placeholder="dd/mm/yyy"
											   value="{{ old('preferred_date') }}" min="{{ now()->toDateString() }}">
									</div>
								</div>

								<div class="ci-field">
									<label class="ci-field__label" for="bk-artist">Tattoo artists</label>
									<select class="ci-field__control ci-field__control--select" id="bk-artist" name="artist">
										<option value="">Select artists</option>
										@foreach ($artists as $artist)
											<option value="{{ $artist['id'] }}" @if (old('artist') === $artist['id']) selected @endif>
												{{ $artist['name'] }}@if (!empty($artist['role'])) — {{ $artist['role'] }}@endif
											</option>
										@endforeach
									</select>
								</div>

								<div class="ci-field">
									<label class="ci-field__label" for="bk-message">Describe your tattoo idea</label>
									<textarea class="ci-field__control ci-field__control--area" id="bk-message" name="message" rows="5"
											  placeholder="Describe your tattoo idea in detail. Include themes, elements, colors, mood, etc." required>{{ old('message') }}</textarea>
								</div>

								<button class="ci-booking__submit" type="submit">Send message</button>
							</form>
						</div>
					</div>
		</div>
				
					</div>
		</section>
				</div>
@endsection

@push('elementor-config')
<script id="elementor-frontend-js-before">
var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":false},"i18n":{"shareOnFacebook":"Share on Facebook","shareOnX":"Share on X","pinIt":"Pin it","download":"Download","downloadImage":"Download image","fullscreen":"Fullscreen","zoom":"Zoom","share":"Share","playVideo":"Play Video","previous":"Previous","next":"Next","close":"Close","a11yCarouselPrevSlideMessage":"Previous slide","a11yCarouselNextSlideMessage":"Next slide","a11yCarouselFirstSlideMessage":"This is the first slide","a11yCarouselLastSlideMessage":"This is the last slide","a11yCarouselPaginationBulletMessage":"Go to slide"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"responsive":{"breakpoints":{"mobile":{"label":"Mobile Portrait","value":767,"default_value":767,"direction":"max","is_enabled":true},"mobile_extra":{"label":"Mobile Landscape","value":880,"default_value":880,"direction":"max","is_enabled":false},"tablet":{"label":"Tablet Portrait","value":1024,"default_value":1024,"direction":"max","is_enabled":true},"tablet_extra":{"label":"Tablet Landscape","value":1200,"default_value":1200,"direction":"max","is_enabled":false},"laptop":{"label":"Laptop","value":1366,"default_value":1366,"direction":"max","is_enabled":false},"widescreen":{"label":"Widescreen","value":2400,"default_value":2400,"direction":"min","is_enabled":false}},"hasCustomBreakpoints":false},"version":"4.2.4","is_static":false,"experimentalFeatures":{"e_font_icon_svg":true,"additional_custom_breakpoints":true,"container":true,"e_panel_promotions":true,"hello-theme-header-footer":true,"nested-elements":true,"global_classes_should_enforce_capabilities":true,"e_variables":true,"e_opt_in_v4_page":true,"e_components":true,"e_interactions":true,"e_widget_creation":true,"import-export-customization":true},"urls":{"assets":"{{ asset('assets') }}\/","ajaxurl":"{{ url('/wp-admin/admin-ajax.php') }}","uploadUrl":"{{ asset('assets/images') }}"},"nonces":{"floatingButtonsClickTracking":"fc7428cf9c","atomicFormsSendForm":"ce5b663e66"},"swiperClass":"swiper","settings":{"page":[],"editorPreferences":[]},"kit":{"active_breakpoints":["viewport_mobile","viewport_tablet"],"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","hello_header_logo_type":"logo","hello_header_menu_layout":"horizontal","hello_footer_logo_type":"logo"},"post":{"id":85,"title":"Contact%20Tattoo%20Studio%20in%20Bali%20%E2%80%93%20Mr.%20Dolphin%20Tattoo","excerpt":"","featuredImage":"{{ asset('assets/images/piercing.jpg') }}"}};
//# sourceURL=elementor-frontend-js-before
</script>
@endpush

@push('scripts')
<script id="flatpickr-js" src="{{ asset('assets/js/flatpickr.min.js') }}"></script>
<script id="ci-booking-datepicker">
(function () {
	function initDatePicker() {
		var el = document.getElementById('bk-date');
		if (!el || typeof flatpickr === 'undefined') { return; }

		flatpickr(el, {
			// giá trị gửi lên server giữ định dạng ISO để khớp rule 'date' của Laravel
			dateFormat: 'Y-m-d',
			// ô người dùng nhìn thấy hiển thị kiểu Việt Nam
			altInput: true,
			altFormat: 'd/m/Y',
			altInputClass: 'ci-field__control ci-field__control--date',
			minDate: 'today',
			disableMobile: true
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initDatePicker);
	} else {
		initDatePicker();
	}
})();
</script>
@endpush
