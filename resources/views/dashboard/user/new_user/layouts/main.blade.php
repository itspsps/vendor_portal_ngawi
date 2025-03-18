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



    <!--end::Fonts -->

    @include('dashboard.user.new_user.layouts.css')
    @yield('css')
</head>

<body>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" style="border-radius: 20px; width: 40%; height: 50%;">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Profile</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

            <ul class="list-group list-group-flush text-right">
                <li class="list-group-item">
                    <a href="{{route('user.akun')}}">Profil&nbsp;<i class="bi bi-person"></i>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout&nbsp;<i class="bi bi-box-arrow-right"></i></a>
                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div class="off_canvars_overlay"></div>
    <div class="Offcanvas_menu">
        <div class="container" style=" background: rgb(108, 56, 253); background: linear-gradient(180deg, rgb(118, 104, 222) 7%, rgb(119, 111, 171) 100%); height: 300px; border-bottom-left-radius: 70px;border-bottom-right-radius: 70px;">
            <div class="row">
                <div class="col-12 col-lg-12 col-sm-12 col-xl-12">
                    @guest
                    @if (Route::has('login'))
                    <div class="col-12 col-lg-12 col-sm-12 col-xl-12">
                        <div class="row">
                            <div class="col-4 align-middle mx-auto">
                            </div>
                            <div class="col-4 align-middle mx-auto">
                                <div class="logo">
                                    <a id="btn_home" href="{{route('user.home')}}"><img src="{{asset('assets_user/assets/img/logo/icon_sps_white.png')}}" alt="" class="icon_logo_vp"></a>
                                </div>
                            </div>
                            <div class="col-4 mx-auto">


                            </div>
                        </div>
                    </div>
                    @else
                    @endif

                    @else
                    <div class="row">
                        <div class="col-4">
                        </div>
                        <div class="col-8 ">
                            <div class="row">
                                <a id="btn_home" href="{{route('user.home')}}"><img src="{{asset('assets_user/assets/img/logo/icon_sps_white.png')}}" alt="" class="icon_logo_vp" width="50%"></a>
                                <div style="text-align: right; margin-top: 2px;" class="kt-header_topbar-item kt-header_topbar-item--user">
                                    <div class="kt-header__topbar-wrapper">
                                        <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">

                                            <img src="{{asset('avatar7.png')}}" alt="user_supplier" class="rounded-circle" width="40px">
                                            <h6><span style="color: white;" class="kt-header__topbar-welcome kt-visible-desktop">{{Auth::guard('web')->user()->nama_vendor}}</span></h6>
                                        </a>
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
                    </div>
                    @endguest


                </div>
            </div>
        </div>
    </div>
    <!--Offcanvas menu area end-->

    <!--header area end-->

    <!--slider area start-->
    @yield('content')

    <!--footer area start-->
    <!-- <footer class="footer_widgets"> -->
    <!-- <div class="footer_bottom"> -->
    <!-- <div class="container"> -->
    <!-- <div class="row align-items-center"> -->
    <!-- <p style="text-align: center"><a href="#">E-PROCUREMENT - 2023</a></p> -->

    <!-- </div> -->
    <!-- </div> -->
    <!-- </div> -->
    <!-- </footer> -->
    <!--footer area end-->

    <!-- modal area start-->

</body>
@include('dashboard.user.new_user.layouts.js') @yield('js')

</html>