{{-- Trang chi tiết một phong cách xăm — dùng chung cho mọi style.
     Thay cho 4 view riêng (realism / japanese / tribal / cartoon) trước đây.

     Nội dung: bảng tattoo_styles (name, content, meta_*).
     Ảnh:      bảng media, lọc theo tattoo_style_id.
     Chỉ style có has_detail_page = 1 mới vào được — chặn ở PageController.

     Khung và class lấy nguyên từ trang realism cũ (post-681) để dùng lại
     style có sẵn; đổi nghĩa là mọi trang style đổi theo. --}}
@extends('layouts.app')

@section('title', $style->meta_title ?: $style->name.' Tattoos | Crimson Ink Tattoo Studio')
@section('body_class', 'wp-singular page-template-default page page-id-681 page-child parent-pageid-806 wp-custom-logo wp-embed-responsive wp-theme-hello-elementor ehf-header ehf-footer ehf-template-hello-elementor ehf-stylesheet-hello-elementor hello-elementor-default elementor-default elementor-kit-6 elementor-page elementor-page-681')

@push('styles')
<link rel='stylesheet' id='widget-divider-css' href='{{ asset('assets/css/widget-divider.min.css') }}' media='all' />
<link rel='stylesheet' id='swiper-css' href='{{ asset('assets/css/swiper.min.css') }}' media='all' />
<link rel='stylesheet' id='e-swiper-css' href='{{ asset('assets/css/e-swiper.min.css') }}' media='all' />
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
							<div class="elementor-widget-container">
								@if ($style->content)
									{!! $style->content !!}
								@elseif ($style->excerpt)
									<p>{{ $style->excerpt }}</p>
								@endif
							</div>
						</div>

					</div>
				</div>
			</div>

			@if ($medias->isNotEmpty())
			<div class="elementor-element elementor-element-973e1cd e-flex e-con-boxed e-con e-parent" data-id="973e1cd" data-element_type="container" data-e-type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
				<div class="e-con-inner">
					{{-- Carousel trượt ngang, dựng lại theo widget image-carousel của trang
					     Japanese cũ. Không dùng widget Elementor vì nó nạp động
					     assets/lib/swiper/v8/swiper.min.js — thư mục lib không có trong
					     bản clone. Thay vào đó dùng swiper.min.js có sẵn trong assets/js
					     và tự khởi tạo ở cuối file, y như carousel ngoài trang chủ. --}}
					<div class="ci-style-carousel">
						<div class="swiper ci-style-carousel__swiper">
							<div class="swiper-wrapper">
								@foreach ($medias as $media)
									@php
										$src = $media->poster_path ?: $media->path;
										$alt = $media->alt ?: $style->name.' tattoo at CrimsonInk Tattoo Studio';
									@endphp

									@continue (! $src)

									<div class="swiper-slide ci-style-carousel__slide">
										<img src="{{ asset($src) }}" alt="{{ $alt }}" loading="lazy" decoding="async" />
									</div>
								@endforeach
							</div>
						</div>

						<button class="ci-style-carousel__nav ci-style-carousel__nav--prev" type="button" aria-label="Ảnh trước">
							<svg viewBox="0 0 1000 1000" aria-hidden="true"><path fill="currentColor" d="M646 125C629 125 613 133 604 142L308 442C296 454 292 471 292 487 292 504 296 521 308 533L604 854C617 867 629 875 646 875 663 875 679 871 692 858 704 846 713 829 713 812 713 796 708 779 692 767L438 487 692 225C700 217 708 204 708 187 708 171 704 154 692 142 675 129 663 125 646 125Z"></path></svg>
						</button>
						<button class="ci-style-carousel__nav ci-style-carousel__nav--next" type="button" aria-label="Ảnh sau">
							<svg viewBox="0 0 1000 1000" aria-hidden="true"><path fill="currentColor" d="M696 533C708 521 713 504 713 487 713 471 708 454 696 446L400 146C388 133 375 125 354 125 338 125 325 129 313 142 300 154 292 171 292 187 292 204 296 221 308 233L563 492 304 771C292 783 288 800 288 817 288 833 296 850 308 863 321 871 338 875 354 875 371 875 388 867 400 854L696 533Z"></path></svg>
						</button>

						<div class="ci-style-carousel__pagination swiper-pagination"></div>
					</div>
				</div>
			</div>
			@endif

		</div>
	</div>

</main>
@endsection

@push('scripts')
<script id="swiper-js" src="{{ asset('assets/js/swiper.min.js') }}"></script>

{{-- Khởi tạo carousel ảnh của trang phong cách. Swiper 8.4.5 nạp ở trên. --}}
<script id="ci-style-carousel-js">
(function () {
	function init() {
		var el = document.querySelector('.ci-style-carousel__swiper');

		if (!el || typeof Swiper === 'undefined' || el.dataset.ciInit) {
			return;
		}

		el.dataset.ciInit = '1';

		/* Ảnh của slide nằm ngoài khung nhìn theo chiều ngang sẽ không tự tải khi
		   để loading="lazy". Khi carousel lọt vào khung nhìn thì bật tất cả về
		   eager để lướt không gặp ô trống. */
		var eager = function () {
			el.querySelectorAll('img[loading="lazy"]').forEach(function (img) { img.loading = 'eager'; });
		};

		if ('IntersectionObserver' in window) {
			var io = new IntersectionObserver(function (entries) {
				if (entries.some(function (e) { return e.isIntersecting; })) { eager(); io.disconnect(); }
			}, { rootMargin: '300px 0px' });
			io.observe(el);
		} else {
			eager();
		}

		var slides = el.querySelectorAll('.swiper-slide').length;

		window.ciStyleCarousel = new Swiper(el, {
			slidesPerView: 1.2,
			spaceBetween: 10,
			speed: 500,
			grabCursor: true,
			watchOverflow: true,
			/* loop cần đủ slide để nhân bản, ít quá thì Swiper nhảy lung tung */
			loop: slides > 4,
			autoplay: slides > 4 ? { delay: 5000, pauseOnMouseEnter: true, disableOnInteraction: true } : false,
			keyboard: { enabled: true },
			navigation: {
				prevEl: '.ci-style-carousel__nav--prev',
				nextEl: '.ci-style-carousel__nav--next'
			},
			pagination: {
				el: '.ci-style-carousel__pagination',
				clickable: true,
				dynamicBullets: true,
				dynamicMainBullets: 3
			},
			breakpoints: {
				768:  { slidesPerView: 2, spaceBetween: 10 },
				1025: { slidesPerView: 4, spaceBetween: 10 }
			}
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
</script>
@endpush
