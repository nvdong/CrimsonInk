@extends('layouts.app')

@section('title', 'Back shortly | Crimson Ink Tattoo Studio Hanoi')
@section('robots', 'noindex, follow')
@section('meta_description', 'The Crimson Ink website is being updated and will be back shortly. The studio in Hanoi is open as usual.')
@section('body_class', 'wp-singular page-template page-template-elementor_header_footer page wp-custom-logo wp-embed-responsive wp-theme-hello-elementor ehf-header ehf-footer ehf-template-hello-elementor ehf-stylesheet-hello-elementor hello-elementor-default elementor-default elementor-template-full-width elementor-kit-6 elementor-page ci-dark-page')

@section('content')
    @include('errors._shell', [
        'code'      => '503',
        'heading'   => 'Back in a moment',
        'lead'      => 'We are updating the site. The studio is open as usual — message us on WhatsApp if you need a slot today.',
        'showLinks' => false,
    ])
@endsection
