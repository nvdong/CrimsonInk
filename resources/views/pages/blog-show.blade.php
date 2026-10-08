{{-- Chi tiết bài viết /blog/{slug}.

     Bố cục theo mẫu khách gửi: breadcrumb, tiêu đề, ngày cập nhật, ảnh bìa,
     nội dung, hộp Mục lục, hộp Điểm chính; cột phải là "Những điều cần biết"
     + "Bài viết liên quan". Giữ tông đen của site.

     Dữ liệu từ bảng posts — quản lý ở admin > Bài viết blog.
     Mục lục dựng bằng JS từ chính các thẻ <h2> trong nội dung, nên nội dung
     admin gõ bằng summernote tự có mục lục mà không phải khai gì thêm. --}}
@extends('layouts.app')

@section('title', ($post->meta_title ?: $post->title).' | Crimson Ink Tattoo Studio')
@section('body_class', 'wp-singular post-template-default single single-post wp-custom-logo wp-embed-responsive wp-theme-hello-elementor ehf-header ehf-footer ehf-template-hello-elementor ehf-stylesheet-hello-elementor hello-elementor-default elementor-default elementor-kit-6 ci-dark-page')

@section('head')
<meta name="description" content="{{ \Illuminate\Support\Str::limit(strip_tags($post->meta_description ?: $post->excerpt), 155) }}" />
<link rel="canonical" href="{{ $post->url }}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{ $post->url }}" />
@if ($post->cover_path)
<meta property="og:image" content="{{ asset($post->cover_path) }}" />
@endif
<meta property="article:published_time" content="{{ $post->created_at->toIso8601String() }}" />
@endsection

@section('content')
<div class="elementor">
	<section class="ci-article">
		<div class="ci-article__inner">

			<article class="ci-article__main">

				<nav class="ci-crumbs" aria-label="Breadcrumb">
					<a href="{{ route('page.home') }}">Trang chủ</a>
					<span aria-hidden="true">/</span>
					<a href="{{ route('page.blog') }}">{{ optional($post->category)->name ?: 'Blog' }}</a>
				</nav>

				<h1 class="ci-article__title">{{ $post->title }}</h1>

				<p class="ci-article__updated">
					Cập nhật lần cuối:
					<time datetime="{{ $post->created_at->toDateString() }}">{{ $post->created_at->format('d/m/Y') }}</time>
					@if ($post->author_name)
						· {{ $post->author_name }}
					@endif
				</p>

				@if ($post->cover_path)
					<figure class="ci-article__cover">
						<img src="{{ asset($post->cover_path) }}" alt="{{ $post->title }}" />
					</figure>
				@endif

				{{-- Mục lục. Khối <ol> để trống, JS ở cuối trang điền vào từ các
				     thẻ h2 trong .ci-article__body. Không có JS thì cả khối tự
				     ẩn (class ci-toc--empty) chứ không để lại hộp rỗng. --}}
				<div class="ci-toc ci-toc--empty" id="ci-toc">
					<button class="ci-toc__head" type="button" aria-expanded="true" aria-controls="ci-toc-list">
						<span>Mục lục</span>
						<svg class="ci-toc__caret" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M7.41 8.59 12 13.17l4.59-4.58L18 10l-6 6-6-6z"/></svg>
					</button>
					<ol class="ci-toc__list" id="ci-toc-list"></ol>
				</div>

				@if (! empty($post->takeaways))
					<section class="ci-takeaways" aria-labelledby="ci-takeaways-title">
						<h2 class="ci-takeaways__title" id="ci-takeaways-title">Điểm chính</h2>
						<ul class="ci-takeaways__list">
							@foreach ($post->takeaways as $line)
								<li class="ci-takeaways__item">
									<svg class="ci-takeaways__icon" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M20.71 5.63 18.37 3.29a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83a1 1 0 0 0 0-1.41zM3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25z"/></svg>
									<span>{!! $line !!}</span>
								</li>
							@endforeach
						</ul>
					</section>
				@endif

				<div class="ci-article__body">
					{!! $post->content !!}
				</div>

				<p class="ci-article__back">
					<a href="{{ route('page.blog') }}">&larr; Về danh sách bài viết</a>
				</p>

			</article>

			<aside class="ci-article__side">

				@if ($guideLinks)
					<section class="ci-side__block">
						<h2 class="ci-side__title">Những điều cần biết trước khi xăm</h2>
						<ul class="ci-guide__list">
							@foreach ($guideLinks as $link)
								<li class="ci-guide__item">
									<a class="ci-guide__link" href="{{ $link['url'] }}">{{ $link['label'] }}</a>
								</li>
							@endforeach
						</ul>
					</section>
				@endif

				@if ($relatedPosts->isNotEmpty())
					<section class="ci-side__block">
						<h2 class="ci-side__title">Bài viết liên quan</h2>
						<ul class="ci-related__list">
							@foreach ($relatedPosts as $item)
								@php $d = $item->created_at; @endphp
								<li class="ci-related__item">
									<a class="ci-related__thumb" href="{{ $item->url }}" tabindex="-1" aria-hidden="true">
										@if ($item->cover_path)
											<img class="ci-related__img" src="{{ asset($item->cover_path) }}" alt="" loading="lazy" decoding="async" />
										@else
											<span class="ci-related__img ci-post__img--empty" aria-hidden="true"></span>
										@endif
										<span class="ci-post__date">
											<span class="ci-post__day">{{ $d->format('d') }}</span>
											<span class="ci-post__month">{{ mb_strtoupper($d->format('M')) }}</span>
										</span>
									</a>
									<h3 class="ci-related__title">
										<a href="{{ $item->url }}">{{ $item->title }}</a>
									</h3>
								</li>
							@endforeach
						</ul>
					</section>
				@endif

			</aside>

		</div>
	</section>
</div>
@endsection

@push('scripts')
{{-- Dung muc luc tu cac the h2 co san trong bai. Lam o client de khi doi sang
     noi dung tu database khong phai parse HTML o phia PHP. --}}
<script id="ci-toc-js">
(function () {
	function initCiToc() {
		var box  = document.getElementById('ci-toc');
		var list = document.getElementById('ci-toc-list');
		var body = document.querySelector('.ci-article__body');
		if (!box || !list || !body) { return; }

		var heads = body.querySelectorAll('h2');
		if (heads.length < 2) { return; }

		var used = {};
		Array.prototype.forEach.call(heads, function (h, i) {
			if (!h.id) {
				/* Tieu de tieng Viet co dau -> slug tu dong de ra chuoi rong,
				   nen fallback ve muc-N thay vi de trung id. */
				var slug = (h.textContent || '').toLowerCase()
					.normalize('NFD').replace(/[̀-ͯ]/g, '')
					.replace(/đ/g, 'd')
					.replace(/[^a-z0-9]+/g, '-')
					.replace(/^-+|-+$/g, '');
				if (!slug || used[slug]) { slug = 'muc-' + (i + 1); }
				used[slug] = true;
				h.id = slug;
			}

			var li = document.createElement('li');
			var a  = document.createElement('a');
			a.href = '#' + h.id;
			a.textContent = h.textContent;
			li.appendChild(a);
			list.appendChild(li);
		});

		box.classList.remove('ci-toc--empty');

		box.querySelector('.ci-toc__head').addEventListener('click', function () {
			var open = this.getAttribute('aria-expanded') === 'true';
			this.setAttribute('aria-expanded', open ? 'false' : 'true');
			box.classList.toggle('ci-toc--closed', open);
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initCiToc);
	} else {
		initCiToc();
	}
})();
</script>
@endpush
