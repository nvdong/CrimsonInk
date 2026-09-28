<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{env('APP_NAME')}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('ui')}}/css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('ui')}}/css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('ui')}}/css/owl.carousel.css">
    <link rel="stylesheet" href="{{asset('ui')}}/css/owl.theme.css">
    <link rel="stylesheet" href="{{asset('ui')}}/css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('ui')}}/css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('ui')}}/css/normalize.css">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('ui')}}/css/meanmenu.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('ui')}}/css/main.css">
    <!-- educate icon CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('ui')}}/css/educate-custon-icon.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('ui')}}/css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('ui')}}/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('ui')}}/css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="{{asset('ui')}}/css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('ui')}}/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="{{asset('ui')}}/css/calendar/fullcalendar.print.min.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('ui')}}/css/style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('ui')}}/css/responsive.css">
    <!-- jquery
    ============================================ -->
    <!-- Datepicker 3 -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{asset('ui')}}/js/summernote/summernote.css">
    <script src="{{asset('ui')}}/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- modernizr JS
		============================================ -->
    <script src="{{asset('ui')}}/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
<?php $user = !empty(\Illuminate\Support\Facades\Auth::user()->id)?\Illuminate\Support\Facades\Auth::user():''; ?>
    <!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
@if(!empty($user))
    @include('layouts.admin._menu')
@endif
<!-- Start Welcome area -->
<div class="all-content-wrapper">
    <div class="header-advance-area" style="padding-bottom: 58px;position: sticky">
        <div class="header-top-area"  style="background: transparent !important;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="header-top-wraper">
                            <div class="row">
                                <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                    <div class="menu-switcher-pro">
                                        <button type="button" id="sidebarCollapse" style="background: #5bc0de" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                            <i class="educate-icon educate-nav"></i>
                                        </button>

                                    </div>
                                </div>

                                <span style="float: right;padding: 20px;
    font-weight: bold;
    margin-right: 20px;"><?php  if(!empty($user)) echo $user->full_name.'<br>('.$user->email.')'; ?></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>


    </div>

    <div class="clearfix"></div>
    <div style="min-height: 87vh;">
        @yield('content')
    </div>
    <div class="footer-copyright-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-copy-right">
                        <p>© 2026 By CrimsonInk. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- bootstrap JS
    ============================================ -->
<script src="{{asset('ui')}}/js/bootstrap.min.js"></script>
<!-- wow JS
    ============================================ -->
<script src="{{asset('ui')}}/js/wow.min.js"></script>
<!-- price-slider JS
    ============================================ -->
<script src="{{asset('ui')}}/js/jquery-price-slider.js"></script>
<!-- meanmenu JS
    ============================================ -->
<script src="{{asset('ui')}}/js/jquery.meanmenu.js"></script>
<!-- owl.carousel JS
    ============================================ -->
<script src="{{asset('ui')}}/js/owl.carousel.min.js"></script>
<!-- sticky JS
    ============================================ -->
<script src="{{asset('ui')}}/js/jquery.sticky.js"></script>
<!-- scrollUp JS
    ============================================ -->
<script src="{{asset('ui')}}/js/jquery.scrollUp.min.js"></script>
<!-- counterup JS
    ============================================ -->
<script src="{{asset('ui')}}/js/counterup/jquery.counterup.min.js"></script>
<script src="{{asset('ui')}}/js/counterup/waypoints.min.js"></script>
<script src="{{asset('ui')}}/js/counterup/counterup-active.js"></script>
<!-- mCustomScrollbar JS
    ============================================ -->
<script src="{{asset('ui')}}/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="{{asset('ui')}}/js/scrollbar/mCustomScrollbar-active.js"></script>
<!-- metisMenu JS
    ============================================ -->
<script src="{{asset('ui')}}/js/metisMenu/metisMenu.min.js"></script>
<script src="{{asset('ui')}}/js/metisMenu/metisMenu-active.js"></script>
<!-- morrisjs JS
    ============================================ -->
<!-- morrisjs JS
    ============================================ -->
<script src="{{asset('ui')}}/js/sparkline/jquery.sparkline.min.js"></script>
<script src="{{asset('ui')}}/js/sparkline/jquery.charts-sparkline.js"></script>
<script src="{{asset('ui')}}/js/sparkline/sparkline-active.js"></script>
<!-- calendar JS
    ============================================ -->
<script src="{{asset('ui')}}/js/calendar/moment.min.js"></script>
<script src="{{asset('ui')}}/js/calendar/fullcalendar.min.js"></script>
<script src="{{asset('ui')}}/js/calendar/fullcalendar-active.js"></script>
<!-- plugins JS
    ============================================ -->
<script src="{{asset('ui')}}/js/plugins.js"></script>
<!-- main JS
    ============================================ -->
<script src="{{asset('ui')}}/js/main.js"></script>

<script src="{{asset('ui')}}/js/summernote/summernote.js"></script>

@yield('scripts')
</body>

</html>
