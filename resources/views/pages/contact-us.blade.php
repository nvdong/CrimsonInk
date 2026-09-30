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
@endsection

@section('content')

{{-- Chữ trên form lấy từ config/constants.php (mảng booking.form), chọn bản dịch
     theo ngôn ngữ đang xem. Sửa chữ thì sửa trong config, không sửa ở đây. --}}
@php
    $t            = \App\Support\Text::class;
    $labels       = $t::group('booking.form.labels');
    $placeholders = $t::group('booking.form.placeholders');
@endphp
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
				{{ $t::get('booking.form.eyebrow') }}				</span>
						</span>
		</div>
						</div>
				</div>
				<div class="elementor-element elementor-element-240de9b elementor-widget elementor-widget-elementskit-heading" data-id="240de9b" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
				<div class="elementor-widget-container">
					<div class="ekit-wid-con" >
						<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
							<h2 class="ekit-heading--title elementskit-section-title ">{{ $t::get('booking.form.heading') }} <span>{{ $t::get('booking.form.heading_accent') }}</span></h2>
							<p class="ci-booking__lead">{{ $t::get('booking.form.lead') }}</p>
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
										<label class="ci-field__label" for="bk-name">{{ $labels['full_name'] }}</label>
										<input class="ci-field__control" type="text" id="bk-name" name="full_name" value="{{ old('full_name') }}" placeholder="{{ $placeholders['full_name'] }}" maxlength="120" required>
									</div>

									<div class="ci-field">
										<label class="ci-field__label" for="bk-phone">{{ $labels['phone'] }}</label>
										<input class="ci-field__control" type="tel" id="bk-phone" name="phone"
											   value="{{ old('phone') }}" placeholder="{{ $placeholders['phone'] }}" maxlength="40" required>
									</div>

									<div class="ci-field">
										<label class="ci-field__label" for="bk-email">{{ $labels['email'] }}</label>
										<input class="ci-field__control" type="email" id="bk-email" name="email"
											   value="{{ old('email') }}" placeholder="{{ $placeholders['email'] }}" maxlength="190" required>
									</div>

									<div class="ci-field">
										<label class="ci-field__label" for="bk-date">{{ $labels['preferred_date'] }}</label>
										<input class="ci-field__control" type="date" id="bk-date" name="preferred_date"
											   value="{{ old('preferred_date') }}" min="{{ now()->toDateString() }}">
									</div>
								</div>

								<div class="ci-field">
									<label class="ci-field__label" for="bk-artist">{{ $labels['artist'] }}</label>
									<select class="ci-field__control ci-field__control--select" id="bk-artist" name="artist">
										<option value="">{{ $placeholders['artist'] }}</option>
										@foreach ($artists as $artist)
											<option value="{{ $artist['id'] }}" @if (old('artist') === $artist['id']) selected @endif>
												{{ $artist['name'] }}@if (!empty($artist['role'])) — {{ $artist['role'] }}@endif
											</option>
										@endforeach
									</select>
								</div>

								<div class="ci-field">
									<label class="ci-field__label" for="bk-message">{{ $labels['message'] }}</label>
									<textarea class="ci-field__control ci-field__control--area" id="bk-message" name="message" rows="5"
											  placeholder="{{ $placeholders['message'] }}" required>{{ old('message') }}</textarea>
								</div>

								<button class="ci-booking__submit" type="submit">{{ $t::get('booking.form.submit') }}</button>
							</form>
						</div>
					</div>
		</div>
				
					</div>
		</section>
				</div>
@endsection

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
