<!-- Start Left menu area -->
<div class="left-sidebar-pro">
    <nav id="sidebar" class="">
        <?php
        if(empty($uri))
            $uri = 'Dashboard';
        ?>
        <div class="sidebar-header">
            <a href="{{route('admin.index')}}"><h2 style="color:redbrick">Admin <p style="font-size:12px">CrimsonInk</p></h2></a>

        </div>
        <style>
            .mini-click-non:hover{
                color: #8d9498 !important;
            }
            .left-custom-menu-adp-wrap{
                height: 100% !important;
                padding-bottom: 100px !important;
            }
        </style>
        <div class="left-custom-menu-adp-wrap comment-scrollbar">
            <nav class="sidebar-nav left-sidebar-menu-pro">
                <ul class="metismenu active " id="menu1">
                    <li class="{{$uri == 'Dashboard'?'active':''}}">
                        <a title="Dashboard" href="#" aria-expanded="false">
                            <i class="fa fa-tachometer" aria-hidden="true"></i>
                            <span class="mini-click-non">Dashboard</span>
                        </a>
                    </li>

                    <li class="{{$uri == 'campaigns'?'active':''}}">
                        <a title="Campaign" href="#" aria-expanded="false">
                            <i class="fa fa-list" aria-hidden="true"></i>
                            <span class="mini-click-non">DS Đặt Lịch</span>
                        </a>
                    </li>

                    <li class="{{$uri == 'campaigns'?'active':''}}">
                        <a title="Campaign" href="#" aria-expanded="false">
                            <i class="fa fa-list" aria-hidden="true"></i>
                            <span class="mini-click-non">DS Artists</span>
                        </a>
                    </li>
                    <li class="{{$uri == 'campaigns'?'active':''}}">
                        <a title="Campaign" href="#" aria-expanded="false">
                            <i class="fa fa-list" aria-hidden="true"></i>
                            <span class="mini-click-non">DS Style</span>
                        </a>
                    </li>

                    <li>
                        <a class="has-arrow" href="javascript:void(0);" aria-expanded="true">
                            <i class="fa fa-bullseye" aria-hidden="true"></i>
                            <span class="mini-click-non">Profile</span>
                        </a>
                        <ul class="submenu-angle" aria-expanded="true">
                            <li><a title="Dashboard v.1" href="{{route('admin.logout')}}"><span class="mini-sub-pro">Logout</span></a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </nav>
</div>
<!-- End Left menu area -->
<!-- Mobile Menu start -->
<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul class="metismenu" id="menu1">

                            <li class="{{$uri == 'Dashboard'?'active':''}}">
                                <a title="Landing Page" href="{{route('admin.index')}}" aria-expanded="true">
                                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                                    <span class="mini-click-non">Dashboard</span>
                                </a>
                            </li>

                            <li class="{{$uri == ''?'active':''}}">
                                <a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                                    <i class="fa fa-bullseye" aria-hidden="true"></i>
                                    <span class="mini-click-non">Profile</span>
                                </a>
                                <ul class="submenu-angle" aria-expanded="false">
                                    <li><a title="Dashboard v.1" href="{{route('admin.logout')}}"><span class="mini-sub-pro">Logout</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mobile Menu end -->
