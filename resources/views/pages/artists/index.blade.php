{{-- Trang /artists — danh sách đầy đủ artist, dùng chung partial với trang chủ --}}
@extends('layouts.app')

@section('title', 'Our Tattoo Artists | Crimson Ink Tattoo Studio Hanoi')
@section('body_class', 'wp-singular page-template page-template-elementor_header_footer page wp-custom-logo wp-embed-responsive wp-theme-hello-elementor ehf-header ehf-footer ehf-template-hello-elementor ehf-stylesheet-hello-elementor hello-elementor-default elementor-default elementor-template-full-width elementor-kit-6 elementor-page ci-dark-page')

@section('head')
<meta name="description" content="Meet the tattoo artists at Crimson Ink Hanoi — their styles, experience and portfolio." />
<link rel="canonical" href="{{ route('page.artists') }}" />
@endsection

@section('content')
<div class="ci-page">
	<div class="ci-page__inner">
		<p class="ci-page__eyebrow">Meet Our</p>
		<h1 class="ci-page__title">Professional Tattoo <span>Artists</span></h1>

		<div class="ci-artists">
			@foreach ($artists as $i => $artist)
				@include('partials.artist-row', ['artist' => $artist, 'reverse' => $i % 2 === 1])
			@endforeach
		</div>
	</div>
</div>
@endsection
