<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="SP" name="keywords">
    <meta content="" name="description">
    <title>@yield('title')</title>

    <!-- Favicons -->
    <link href="{{asset('logo-login-sps.png')}}" rel="icon">

    <!--begin::Fonts -->
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Asap+Condensed:500"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Fonts -->

    @include('dashboard.user.layout.css1')
    @yield('css')
    <style>
        .icon {
            width: 50px;
            height: 50px;
            background-color: #eee;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 39px
        }
    </style>
</head>

<body>
    <!--Offcanvas menu area start-->
    <div class="off_canvars_overlay"></div>
    <div class="Offcanvas_menu">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @guest
                    @if (Route::has('login'))
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6 mx-auto">
                                <div class="logo" style="text-align: left; ">
                                    <a id="btn_home" href="{{route('user.home')}}" id="btn_home"><img src="{{asset('home.png')}}" alt="" style="color: #4D006E;" width="90px"></a>
                                </div>
                            </div>
                            <div class="col-6 mx-auto">
                                <div style="text-align: right; margin-right: -10px;">
                                    <a id="btn_login" href="{{ route('user.login') }}" class="btn btn-sm" style="background-color: #4d006e;"><i class="fa fa-user" style="color: white;"></i><span style="color: white;">&nbsp;Login</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @else
                    <div class="row">
                        <div class="col-6">
                            <div class="logo" style="text-align: left;">
                                <a id="btn_home" href="{{route('user.home')}}" id="btn_home"><img src="{{asset('home.png')}}" alt="" style="color: #4D006E;" width="90px"></a>
                            </div>
                        </div>
                        <div class="col-6 mx-auto">
                            <div style="text-align: right; " class="kt-header_topbar-item kt-header_topbar-item--user">
                                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                    <h4><span class="kt-header__topbar-welcome kt-visible-desktop">{{Auth::guard('web')->user()->nama_vendor}} <i class="fa fa-user-circle"></i></span></h4>
                                </div>
                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                                    <!--begin: Navigation -->
                                    <div class="kt-notification">
                                        <div class="kt-notification__custom kt-space-between">
                                            <a id="btn_akun" href="{{route('user.akun')}}" class="btn btn-label btn-label-brand btn-sm btn-bold">Profile&nbsp;<i class="fa fa-id-badge"></i></a><br>
                                            <a href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-label btn-label-brand btn-sm btn-bold">Keluar&nbsp;</a><i class="fa fa-sign-out"></i>
                                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </div>
                                    </div>

                                    <!--end: Navigation -->
                                </div>
                            </div>
                        </div>
                    </div>
                    @endguest
                    <div class="Offcanvas_menu_wrapper">
                        <div class="canvas_close">
                            <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                        </div>
                        <div class="header_top_settings text-right">
                            <ul>
                                @guest
                                @if (Route::has('login'))
                                <li><a id="btn_login" href="{{ route('user.login') }}" class="btn btn-sm" style="background-color: #4d006e;"><i class="fa fa-user" style="color: white;"></i><span style="color: white;">&nbsp;Login</span></a></li>
                                @endif

                                <!-- @if (Route::has('register'))
                                            <li><a href="{{ route('user.formregister') }}">Register</a></li>
                                        @endif -->
                                @else

                                @endguest
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Offcanvas menu area end-->


    <header>
        <div class="main_header1">
            <div class="container">
                <!--header top start-->
                <div class="header_top">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6">
                            <div class="logo">
                                <a id="btn_home" href="{{route('user.home')}}" id="btn_home"><img src="{{asset('home.png')}}" alt="" style="color: #4D006E;" width="90px"></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="header_top_settings text-right">
                                <ul>
                                    @guest
                                    @if (Route::has('login'))
                                    <li><a id="btn_login" href="{{ route('user.login') }}" class="btn btn-sm" style="background-color: #4d006e;"><i class="fa fa-user" style="color: white;"></i><span style="color: white;">&nbsp;Login</span></a></li>
                                    @endif

                                    <!-- @if (Route::has('register'))
                                                <li><a href="{{ route('user.formregister') }}">Register</a></li>
                                            @endif -->
                                    @else
                                    <li>
                                        <div class="kt-header_topbar-item kt-header_topbar-item--user">
                                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                                <span class="kt-header__topbar-welcome kt-visible-desktop">{{Auth::guard('web')->user()->nama_vendor}} <i class="fa fa-user-circle"></i></span>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                                                <!--begin: Navigation -->
                                                <div class="kt-notification">
                                                    <div class="kt-notification__custom kt-space-between">
                                                        <a id="btn_akun" href="{{route('user.akun')}}" class="btn btn-label btn-label-brand btn-sm btn-bold">Profile&nbsp;<i class="fa fa-id-badge"></i></a><br>
                                                        <a href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-label btn-label-brand btn-sm btn-bold">Keluar&nbsp;</a><i class="fa fa-sign-out"></i>
                                                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                                            {{ csrf_field() }}
                                                        </form>
                                                    </div>
                                                </div>

                                                <!--end: Navigation -->
                                            </div>
                                        </div>
                                    </li>
                                    @endguest
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--header middel end-->

                <!--header bottom satrt-->
            </div>
        </div>
    </header>
    <!--header area end-->

    <!--slider area start-->
    @yield('content')

</body>
<!--footer area start-->
<footer class="footer_widgets mx-auto">
    <div class="footer_bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12">
                    <div class="copyright_area">
                        <p style="text-align: center">Copyright &copy; 2022 <a href="#">E-PROCUREMENT</a> All Right Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--footer area end-->

<!-- modal area start-->

@include('dashboard.user.layout.js1') @yield('js')

</html>