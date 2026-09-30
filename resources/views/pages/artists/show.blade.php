@extends('layouts.app')

@section('title', $artist['name'].' | Crimson Ink Tattoo Studio Hanoi')
@section('body_class', 'wp-singular page-template page-template-elementor_header_footer page wp-custom-logo wp-embed-responsive wp-theme-hello-elementor ehf-header ehf-footer ehf-template-hello-elementor ehf-stylesheet-hello-elementor hello-elementor-default elementor-default elementor-template-full-width elementor-kit-6 elementor-page ci-dark-page')

@section('head')
<meta name="description" content="{{ \Illuminate\Support\Str::limit($artist['bio'], 155) }}" />
<link rel="canonical" href="{{ route('page.artists.show', $artist['slug']) }}" />
@endsection

@section('content')
<div class="ci-page">
	<div class="ci-page__inner">
		<div class="ci-artists">
			<article class="ci-artist">
				<div class="ci-artist__media">
					<img src="{{ asset($artist['avatar_path']) }}" alt="{{ $artist['name'] }}" decoding="async" width="800" height="533">
				</div>
				<div class="ci-artist__body">
					<h1 class="ci-artist__name">{{ $artist['name'] }}</h1>
					@if (!empty($artist['role']))
						<p class="ci-artist__role">{{ $artist['role'] }}</p>
					@endif
					<p class="ci-artist__bio">{{ $artist['bio'] }}</p>

					<div class="ci-btn ci-artist__cta">
						<div class="elementor-button-wrapper">
							<a class="elementor-button elementor-button-link elementor-size-sm" href="{{ route('page.contact-us') }}">
								<span class="elementor-button-content-wrapper">
									<span class="elementor-button-icon">@include('partials.icon-arrow')</span>
									<span class="elementor-button-text">Book with {{ $artist['name'] }}</span>
								</span>
							</a>
						</div>
					</div>
				</div>
			</article>
		</div>

@if ($works->isNotEmpty())
		<section class="ci-works">
			{{-- Slogan riêng của artist; trống thì lùi về câu mặc định. --}}
			<h2 class="ci-page__title ci-works__title">
				@if (!empty($artist->slogan))
					{{ $artist->slogan }}
				@else
					Your Vision, Forged at <span>CrimsonInk</span>
				@endif
			</h2>

			@if (!empty($artist->content))
				<div class="ci-works__intro">{!! $artist->content !!}</div>
			@endif

			<ul class="ci-works__grid">
				@foreach ($works as $work)
					@php
						$isEmbed = $work->type === 'embed';
						$isVideo = $work->type === 'video';

						$fullUrl = $isEmbed ? $work->embed_url : ($work->path ? asset($work->path) : null);
						$thumb   = $work->poster_path ?: ($isEmbed ? null : $work->path);
					@endphp

					@continue (! $fullUrl || ! $thumb)

					<li class="ci-works__item">
						<a class="ci-works__link"
							href="{{ $fullUrl }}"
							data-ci-lightbox
							data-ci-type="{{ $work->type }}"
							data-elementor-open-lightbox="no"
							aria-label="{{ $work->alt ?: $artist->name }}">
							<img class="ci-works__img"
								src="{{ asset($thumb) }}"
								alt="{{ $work->alt ?: $artist->name }}"
								loading="lazy" decoding="async" />
							@if ($isEmbed || $isVideo)
								<span class="ci-works__play" aria-hidden="true">
									<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"></path></svg>
								</span>
							@endif
						</a>
					</li>
				@endforeach
			</ul>
		</section>
@endif

		<div class="ci-btn ci-artists__cta elementor-align-center">
			<div class="elementor-button-wrapper">
				<a class="elementor-button elementor-button-link elementor-size-sm" href="{{ route('page.artists') }}">
					<span class="elementor-button-content-wrapper">
						<span class="elementor-button-icon">@include('partials.icon-arrow')</span>
						<span class="elementor-button-text">All artists</span>
					</span>
				</a>
			</div>
		</div>
	</div>
</div>

@include('partials.lightbox')
@endsection
