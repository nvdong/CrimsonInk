{{-- Danh sách bài viết /blog.

     Bố cục lấy theo mẫu khách gửi (hero có tiêu đề + breadcrumb, cột trái là
     danh sách bài, cột phải là "Bài viết mới nhất"), nhưng đổi sang tông đen
     của site: nền #000, chữ trắng, nhấn đỏ --e-global-color-accent.

     BẢN DỰNG GIAO DIỆN: $posts / $latestPosts còn là mảng cắm cứng trong
     PageController::blog(). Xem ghi chú ở đó trước khi nối database. --}}
@extends('layouts.app')

@section('title', 'Blog | Crimson Ink Tattoo Studio Hanoi')
@section('body_class', 'wp-singular page-template page-template-elementor_header_footer page wp-custom-logo wp-embed-responsive wp-theme-hello-elementor ehf-header ehf-footer ehf-template-hello-elementor ehf-stylesheet-hello-elementor hello-elementor-default elementor-default elementor-template-full-width elementor-kit-6 elementor-page')

@section('head')
<meta name="description" content="Kiến thức về xăm hình, chăm sóc sau xăm và văn hóa xăm từ đội ngũ Crimson Ink Tattoo Studio Hà Nội." />
<link rel="canonical" href="{{ route('page.blog') }}" />
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ route('page.blog') }}" />
<meta property="og:image" content="{{ asset('assets/images/header-eyebrows.jpg') }}" />
@endsection

@section('content')
<div class="elementor">

	{{-- ===== Hero ===== --}}
	<section class="ci-page-hero">
		<div class="ci-page-hero__media" role="img" aria-label="Crimson Ink Tattoo Studio"></div>
		<div class="ci-page-hero__inner">
			<h1 class="ci-page-hero__title">Blog</h1>
			<nav class="ci-page-hero__crumbs" aria-label="Breadcrumb">
				<a href="{{ route('page.home') }}">Trang chủ</a>
				<span aria-hidden="true">/</span>
				<span aria-current="page">Blog</span>
			</nav>
		</div>
	</section>

	{{-- ===== Nội dung ===== --}}
	<section class="ci-blog">
		<div class="ci-blog__inner">

			<div class="ci-blog__main">
				@forelse ($posts as $post)
					@php
						$date = \Carbon\Carbon::parse($post['date']);
					@endphp

					<article class="ci-post">
						<a class="ci-post__thumb" href="{{ $post['url'] }}" tabindex="-1" aria-hidden="true">
							<img class="ci-post__img" src="{{ asset($post['image']) }}" alt="" loading="lazy" decoding="async" />

							<span class="ci-post__date">
								<span class="ci-post__day">{{ $date->format('d') }}</span>
								<span class="ci-post__month">{{ mb_strtoupper($date->format('M')) }}</span>
							</span>

							@if (! empty($post['categories']))
								<span class="ci-post__cats">{{ implode(', ', $post['categories']) }}</span>
							@endif
						</a>

						<div class="ci-post__body">
							<p class="ci-post__meta">
								Đăng bởi <span class="ci-post__author">{{ $post['author'] }}</span>
								<button class="ci-post__share" type="button" aria-label="Chia sẻ bài viết">
									<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92s2.92-1.31 2.92-2.92a2.92 2.92 0 0 0-2.92-2.92z"/></svg>
								</button>
							</p>

							<h2 class="ci-post__title">
								<a href="{{ $post['url'] }}">{{ $post['title'] }}</a>
							</h2>

							<p class="ci-post__excerpt">{{ $post['excerpt'] }}</p>
						</div>

						<div class="ci-post__cta">
							<a class="ci-post__btn" href="{{ $post['url'] }}">Đọc tiếp</a>
						</div>
					</article>
				@empty
					<p class="ci-blog__empty">Chưa có bài viết nào.</p>
				@endforelse

				{{-- Phân trang: đang là markup tĩnh để duyệt giao diện. Nối DB thì
				     thay cả khối này bằng {{ $posts->links() }} và chỉnh lại
				     .ci-pager cho khớp class của Laravel. --}}
				<nav class="ci-pager" aria-label="Phân trang">
					<span class="ci-pager__item ci-pager__item--current" aria-current="page">1</span>
					<a class="ci-pager__item" href="#">2</a>
					<a class="ci-pager__item" href="#">3</a>
					<a class="ci-pager__item ci-pager__item--next" href="#" aria-label="Trang sau">
						<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M10 6 8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
					</a>
				</nav>
			</div>

			<aside class="ci-blog__side">
				<h2 class="ci-side__title">Bài viết mới nhất</h2>

				<ul class="ci-side__list">
					@foreach ($latestPosts as $post)
						<li class="ci-side__item">
							<a class="ci-side__link" href="{{ $post['url'] }}">{{ $post['title'] }}</a>
							<time class="ci-side__date" datetime="{{ $post['date'] }}">{{ \Carbon\Carbon::parse($post['date'])->format('d/m/Y') }}</time>
						</li>
					@endforeach
				</ul>
			</aside>

		</div>
	</section>

</div>
@endsection
