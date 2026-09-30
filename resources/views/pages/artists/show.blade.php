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
@endsection
