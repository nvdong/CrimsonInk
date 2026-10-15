@extends('layouts.app')

@section('title', 'Something went wrong | Crimson Ink Tattoo Studio Hanoi')
@section('robots', 'noindex, follow')
@section('meta_description', 'A temporary error on the Crimson Ink website. Please try again shortly or message the studio directly.')
@section('body_class', 'wp-singular page-template page-template-elementor_header_footer page wp-custom-logo wp-embed-responsive wp-theme-hello-elementor ehf-header ehf-footer ehf-template-hello-elementor ehf-stylesheet-hello-elementor hello-elementor-default elementor-default elementor-template-full-width elementor-kit-6 elementor-page ci-dark-page')

@section('content')
    @include('errors._shell', [
        'code'      => '500',
        'heading'   => 'Something went wrong',
        'lead'      => 'Our side broke, not yours. Try again in a minute, or message us on WhatsApp and we will sort your booking out by hand.',
        'showLinks' => false,
    ])
@endsection
