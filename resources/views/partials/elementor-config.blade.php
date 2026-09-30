{{--
|--------------------------------------------------------------------------
| elementorFrontendConfig — config toan cuc cua Elementor frontend
|--------------------------------------------------------------------------
| frontend.min.js gan nguyen object nay vao elementorFrontend.config roi doc:
|   - urls.assets  : base URL de resolve ~23 chunk JS lazy-load cua Elementor
|   - experimentalFeatures : quyet dinh nap handler container / nested-elements
|   - is_rtl, version, environmentMode
|   - breakpoints + responsive  : he breakpoint responsive
|   - swiperClass               : class cua swiper carousel
|   - kit.global_image_lightbox + lightbox_enable_* : lightbox khi click anh
|   - i18n                      : chu tren nut lightbox / carousel
|
| => BAT BUOC in ra TRUOC <script src=".../frontend.min.js">, neu khong se
|    bao "elementorFrontendConfig is not defined" va toan bo JS Elementor
|    tren trang chet theo.
|
| Truoc day moi view trong pages/ tu @push mot ban copy giong nhau (chi khac
| khoi "post" la du lieu WordPress cu); gio dung chung duy nhat o day.
--}}
@php
    $pageTitle = trim(strip_tags($__env->yieldContent('title')));

    $elementorConfig = [
        'environmentMode' => [
            'edit'          => false,
            'wpPreview'     => false,
            'isScriptDebug' => false,
        ],

        // Chu hien thi tren lightbox va carousel.
        'i18n' => [
            'shareOnFacebook'                     => 'Share on Facebook',
            'shareOnX'                            => 'Share on X',
            'pinIt'                               => 'Pin it',
            'download'                            => 'Download',
            'downloadImage'                       => 'Download image',
            'fullscreen'                          => 'Fullscreen',
            'zoom'                                => 'Zoom',
            'share'                               => 'Share',
            'playVideo'                           => 'Play Video',
            'previous'                            => 'Previous',
            'next'                                => 'Next',
            'close'                               => 'Close',
            'a11yCarouselPrevSlideMessage'        => 'Previous slide',
            'a11yCarouselNextSlideMessage'        => 'Next slide',
            'a11yCarouselFirstSlideMessage'       => 'This is the first slide',
            'a11yCarouselLastSlideMessage'        => 'This is the last slide',
            'a11yCarouselPaginationBulletMessage' => 'Go to slide',
        ],

        'is_rtl' => false,

        'breakpoints' => [
            'xs'  => 0,
            'sm'  => 480,
            'md'  => 768,
            'lg'  => 1025,
            'xl'  => 1440,
            'xxl' => 1600,
        ],

        'responsive' => [
            'breakpoints' => [
                'mobile'       => ['label' => 'Mobile Portrait',  'value' => 767,  'default_value' => 767,  'direction' => 'max', 'is_enabled' => true],
                'mobile_extra' => ['label' => 'Mobile Landscape', 'value' => 880,  'default_value' => 880,  'direction' => 'max', 'is_enabled' => false],
                'tablet'       => ['label' => 'Tablet Portrait',  'value' => 1024, 'default_value' => 1024, 'direction' => 'max', 'is_enabled' => true],
                'tablet_extra' => ['label' => 'Tablet Landscape', 'value' => 1200, 'default_value' => 1200, 'direction' => 'max', 'is_enabled' => false],
                'laptop'       => ['label' => 'Laptop',           'value' => 1366, 'default_value' => 1366, 'direction' => 'max', 'is_enabled' => false],
                'widescreen'   => ['label' => 'Widescreen',       'value' => 2400, 'default_value' => 2400, 'direction' => 'min', 'is_enabled' => false],
            ],
            'hasCustomBreakpoints' => false,
        ],

        'version'   => '4.2.4',
        'is_static' => false,

        'experimentalFeatures' => [
            'e_font_icon_svg'                            => true,
            'additional_custom_breakpoints'              => true,
            'container'                                  => true,
            'e_panel_promotions'                         => true,
            'hello-theme-header-footer'                  => true,
            'nested-elements'                            => true,
            'global_classes_should_enforce_capabilities' => true,
            'e_variables'                                => true,
            'e_opt_in_v4_page'                           => true,
            'e_components'                               => true,
            'e_interactions'                             => true,
            'e_widget_creation'                          => true,
            'import-export-customization'                => true,
        ],

        'urls' => [
            'assets'    => asset('assets') . '/',
            'ajaxurl'   => url('/wp-admin/admin-ajax.php'),
            'uploadUrl' => asset('assets/images'),
        ],

        'nonces' => [
            'floatingButtonsClickTracking' => '',
            'atomicFormsSendForm'          => '',
        ],

        'swiperClass' => 'swiper',

        'settings' => [
            'page'              => [],
            'editorPreferences' => [],
        ],

        'kit' => [
            'active_breakpoints'        => ['viewport_mobile', 'viewport_tablet'],
            'global_image_lightbox'     => 'yes',
            'lightbox_enable_counter'   => 'yes',
            'lightbox_enable_fullscreen'=> 'yes',
            'lightbox_enable_zoom'      => 'yes',
            'lightbox_enable_share'     => 'yes',
            'hello_header_logo_type'    => 'logo',
            'hello_header_menu_layout'  => 'horizontal',
            'hello_footer_logo_type'    => 'logo',
        ],

        // Khong co doan JS nao doc khoi nay (di san cua WordPress), giu lai cho
        // dung shape va lay du lieu theo trang hien tai thay vi hardcode.
        'post' => [
            'id'            => 0,
            'title'         => rawurlencode($pageTitle),
            'excerpt'       => '',
            'featuredImage' => \App\Support\Settings::get('studio.logo_path')
                ? asset(\App\Support\Settings::get('studio.logo_path'))
                : '',
        ],
    ];
@endphp
<script id="elementor-frontend-js-before">
var elementorFrontendConfig = {!! json_encode($elementorConfig, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!};
//# sourceURL=elementor-frontend-js-before
</script>
