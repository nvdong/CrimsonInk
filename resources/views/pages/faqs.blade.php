{{-- Sinh tu ban clone tinh cua mrdolphintattoo.com. View rieng cho trang: /faqs --}}
@extends('layouts.app')

@section('title', 'Câu hỏi thường gặp | Crimson Ink Tattoo Studio Hanoi')
@section('body_class', 'wp-singular page-template page-template-elementor_header_footer page page-id-226 wp-custom-logo wp-embed-responsive wp-theme-hello-elementor ehf-header ehf-footer ehf-template-hello-elementor ehf-stylesheet-hello-elementor hello-elementor-default elementor-default elementor-template-full-width elementor-kit-6 elementor-page elementor-page-226')

@push('styles')
<link rel='stylesheet' id='widget-divider-css' href='{{ asset('assets/css/widget-divider.min.css') }}' media='all' />
<link rel='stylesheet' id='swiper-css' href='{{ asset('assets/css/swiper.min.css') }}' media='all' />
<link rel='stylesheet' id='e-swiper-css' href='{{ asset('assets/css/e-swiper.min.css') }}' media='all' />
<link rel='stylesheet' id='widget-image-gallery-css' href='{{ asset('assets/css/widget-image-gallery.min.css') }}' media='all' />
<link rel='stylesheet' id='elementor-post-226-css' href='{{ asset('assets/css/post-226.css') }}' media='all' />
@endpush

@section('head')
<meta name="description" content="Câu hỏi thường gặp về đặt lịch, quy trình xăm và chăm sóc sau khi xăm tại Crimson Ink Tattoo Studio Hà Nội." />
<link rel="canonical" href="{{ route('page.faqs') }}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{ route('page.faqs') }}" />
<meta property="article:modified_time" content="2026-01-13T05:29:05+00:00" />
<meta property="og:image" content="{{ asset('assets/images/header-eyebrows.jpg') }}" />
<meta property="og:image:width" content="1920" />
<meta property="og:image:height" content="1280" />
<meta property="og:image:type" content="image/jpeg" />
<meta name="twitter:label1" content="Est. reading time" />
<meta name="twitter:data1" content="2 minutes" />
{{-- Schema FAQPage sinh từ chính dữ liệu trong bảng faqs — giúp Google hiện
     câu hỏi ngay trên kết quả tìm kiếm. --}}
@php
    $faqEntities = [];
    foreach ($faqs as $group) {
        foreach ($group as $item) {
            $faqEntities[] = [
                '@type' => 'Question',
                'name'  => $item->question,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => trim(strip_tags($item->answer)),
                ],
            ];
        }
    }
@endphp
@if ($faqEntities)
<script type="application/ld+json">{!! json_encode([
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => $faqEntities,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endif
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
							<span class="elementor-divider__text elementor-divider__element">{{ $page->title }}</span>
						</span>
		</div>
						</div>
				</div>
				<div class="elementor-element elementor-element-735ff0c elementor-widget elementor-widget-elementskit-heading" data-id="735ff0c" data-element_type="widget" data-e-type="widget" data-widget_type="elementskit-heading.default">
				<div class="elementor-widget-container">
					<div class="ekit-wid-con" >
						<div class="ekit-heading elementskit-section-title-wraper text_center   ekit_heading_tablet-   ekit_heading_mobile-">
							<h2 class="ekit-heading--title elementskit-section-title ">{!! $page->heading !!}</h2>
						</div>
					</div>
				</div>
				</div>
				<div class="elementor-element elementor-element-f29cb33 ci-faq-intro elementor-widget elementor-widget-text-editor" data-id="f29cb33" data-element_type="widget" data-e-type="widget" data-widget_type="text-editor.default">
				<div class="elementor-widget-container">
					{!! $page->body !!}
				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
			<section class="elementor-section elementor-top-section elementor-element ci-faq-section elementor-section-content-middle elementor-section-boxed elementor-section-height-default" data-element_type="section" data-e-type="section">
				<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column" data-element_type="column" data-e-type="column">
						<div class="elementor-widget-wrap elementor-element-populated">

							{{-- Danh sách câu hỏi lấy từ bảng faqs. Sửa nội dung trong admin,
							     mục "Câu hỏi thường gặp" — không sửa file này. --}}
							<div class="elementor-element ci-faq">
								@forelse ($faqs as $group => $items)

									@if ($faqs->count() > 1)
										<h3 class="ci-faq__group">{{ $items->first()->group_label }}</h3>
									@endif

									@foreach ($items as $item)
										@php $open = $loop->parent->first && $loop->first; @endphp

										<article class="ci-faq__item{{ $open ? ' is-open' : '' }}">
											<button class="ci-faq__q" type="button"
													aria-expanded="{{ $open ? 'true' : 'false' }}"
													aria-controls="faq-answer-{{ $item->id }}">
												<span class="ci-faq__q-text">{{ $item->question }}</span>
												<span class="ci-faq__chevron" aria-hidden="true">
													<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
														<polyline points="6 9 12 15 18 9"></polyline>
													</svg>
												</span>
											</button>

											<div class="ci-faq__a" id="faq-answer-{{ $item->id }}" role="region">
												<div class="ci-faq__a-inner">{!! $item->answer !!}</div>
											</div>
										</article>
									@endforeach

								@empty
									<p class="ci-faq__empty">Chưa có câu hỏi nào được đăng.</p>
								@endforelse
							</div>

						</div>
					</div>
				</div>
			</section>
@endsection

@push('elementor-config')
<script id="elementor-frontend-js-before">
var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":false},"i18n":{"shareOnFacebook":"Share on Facebook","shareOnX":"Share on X","pinIt":"Pin it","download":"Download","downloadImage":"Download image","fullscreen":"Fullscreen","zoom":"Zoom","share":"Share","playVideo":"Play Video","previous":"Previous","next":"Next","close":"Close","a11yCarouselPrevSlideMessage":"Previous slide","a11yCarouselNextSlideMessage":"Next slide","a11yCarouselFirstSlideMessage":"This is the first slide","a11yCarouselLastSlideMessage":"This is the last slide","a11yCarouselPaginationBulletMessage":"Go to slide"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"responsive":{"breakpoints":{"mobile":{"label":"Mobile Portrait","value":767,"default_value":767,"direction":"max","is_enabled":true},"mobile_extra":{"label":"Mobile Landscape","value":880,"default_value":880,"direction":"max","is_enabled":false},"tablet":{"label":"Tablet Portrait","value":1024,"default_value":1024,"direction":"max","is_enabled":true},"tablet_extra":{"label":"Tablet Landscape","value":1200,"default_value":1200,"direction":"max","is_enabled":false},"laptop":{"label":"Laptop","value":1366,"default_value":1366,"direction":"max","is_enabled":false},"widescreen":{"label":"Widescreen","value":2400,"default_value":2400,"direction":"min","is_enabled":false}},"hasCustomBreakpoints":false},"version":"4.2.4","is_static":false,"experimentalFeatures":{"e_font_icon_svg":true,"additional_custom_breakpoints":true,"container":true,"e_panel_promotions":true,"hello-theme-header-footer":true,"nested-elements":true,"global_classes_should_enforce_capabilities":true,"e_variables":true,"e_opt_in_v4_page":true,"e_components":true,"e_interactions":true,"e_widget_creation":true,"import-export-customization":true},"urls":{"assets":"{{ asset('assets') }}\/","ajaxurl":"{{ url('/wp-admin/admin-ajax.php') }}","uploadUrl":"{{ asset('assets/images') }}"},"nonces":{"floatingButtonsClickTracking":"fc7428cf9c","atomicFormsSendForm":"ce5b663e66"},"swiperClass":"swiper","settings":{"page":[],"editorPreferences":[]},"kit":{"active_breakpoints":["viewport_mobile","viewport_tablet"],"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","hello_header_logo_type":"logo","hello_header_menu_layout":"horizontal","hello_footer_logo_type":"logo"},"post":{"id":226,"title":"Eyebrow%20Tattoo%20Bali%20%E2%80%93%20Natural%20Brow%20Art%20%7C%20Mr.%20Dolphin%20Tattoo","excerpt":"","featuredImage":"{{ asset('assets/images/header-eyebrows.jpg') }}"}};
//# sourceURL=elementor-frontend-js-before
</script>
@endpush

@push('scripts')
<script id="ci-faq-accordion">
/* Accordion FAQ.
   Mở/đóng bằng max-height thật của nội dung, nên không cần đặt chiều cao cố định.
   Mỗi lần chỉ mở một câu hỏi — bỏ dòng đóng câu khác đi nếu muốn mở nhiều cùng lúc. */
(function () {
	var root = document.querySelector('.ci-faq');
	if (!root) return;

	var items = [].slice.call(root.querySelectorAll('.ci-faq__item'));

	function dong(item) {
		var a = item.querySelector('.ci-faq__a');
		var q = item.querySelector('.ci-faq__q');
		a.style.maxHeight = '0px';
		item.classList.remove('is-open');
		q.setAttribute('aria-expanded', 'false');
	}

	function mo(item) {
		var a = item.querySelector('.ci-faq__a');
		var q = item.querySelector('.ci-faq__q');
		item.classList.add('is-open');
		q.setAttribute('aria-expanded', 'true');
		a.style.maxHeight = a.scrollHeight + 'px';
	}

	items.forEach(function (item) {
		var q = item.querySelector('.ci-faq__q');
		if (!q) return;

		// câu đang mở sẵn từ server: đặt maxHeight khớp nội dung
		if (item.classList.contains('is-open')) mo(item);

		q.addEventListener('click', function () {
			var dangMo = item.classList.contains('is-open');
			items.forEach(dong);
			if (!dangMo) mo(item);
		});
	});

	// đổi kích thước cửa sổ làm chữ xuống dòng khác đi -> tính lại chiều cao
	var timer;
	window.addEventListener('resize', function () {
		clearTimeout(timer);
		timer = setTimeout(function () {
			items.forEach(function (item) {
				if (item.classList.contains('is-open')) {
					item.querySelector('.ci-faq__a').style.maxHeight =
						item.querySelector('.ci-faq__a').scrollHeight + 'px';
				}
			});
		}, 150);
	});
})();
</script>
@endpush
