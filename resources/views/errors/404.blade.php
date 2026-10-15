@extends('layouts.app')

@section('title', 'Page not found | Crimson Ink Tattoo Studio Hanoi')
@section('robots', 'noindex, follow')
@section('meta_description', 'The page you asked for is not on the Crimson Ink site. Browse our tattoo styles, gallery and artists in Hanoi instead.')
@section('body_class', 'wp-singular page-template page-template-elementor_header_footer page wp-custom-logo wp-embed-responsive wp-theme-hello-elementor ehf-header ehf-footer ehf-template-hello-elementor ehf-stylesheet-hello-elementor hello-elementor-default elementor-default elementor-template-full-width elementor-kit-6 elementor-page ci-dark-page')

@section('content')
    @include('errors._shell', [
        'code'      => '404',
        'heading'   => 'Page not found',
        'lead'      => 'This page moved or never existed. The studio is still right here in Ba Dinh, Hanoi.',
        'showLinks' => true,
    ])
@endsection
