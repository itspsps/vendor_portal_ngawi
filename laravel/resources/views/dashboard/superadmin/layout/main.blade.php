<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="SPS" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Favicons -->
    <link href="{{asset('logo-login-sps.png')}}" rel="icon">

    <!--begin::Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
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

    @include('dashboard.superadmin.layout.css')
    @yield('css')
</head>

<body class="kt-page-content-white kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- begin:: Page -->

    <!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed " style="background: #9F187C;">
        <div class="kt-header-mobile__logo">
            <a href="{{route('sourching.home')}}">
                <h5 class="kt-font" style="color:white">PT. SURYA PANGAN SEMESTA</h5>
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler">
                <span></span>
            </button>
            <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler">
                <i class="flaticon-more-1"></i>
            </button>
        </div>
    </div>

    <!-- end:: Header Mobile -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                <!-- begin:: Header -->
                <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " data-ktheader-minimize="on" style="background: #9F187C;">
                    <div class="kt-container  kt-container--fluid ">

                        <!-- begin:: Brand -->
                        <div class="kt-header__brand " id="kt_header_brand">
                            <div class="kt-header__brand-logo">
                                <a href="{{route('sourching.home')}}">
                                    <h5 class="kt-font" style="color:white">PT. SURYA PANGAN SEMESTA</h5>
                                </a>
                            </div>
                        </div>

                        <!-- end:: Brand -->

                        <!-- begin:: Header Topbar -->
                        <div class="kt-header__topbar">
@if(Auth::guard('sourching')->user()->level=='ADMIN')
@elseif(Auth::guard('sourching')->user()->level=='MANAGER')
<div class="kt-header__topbar-item dropdown">
    <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="true">
        <span class="kt-header__topbar-icon"><i class="flaticon2-bell-alarm-symbol"></i></span>
        <span id="count_notif" class="badge" style="position: absolute; top: 10px; right: -10px; padding: 5px 10px; border-radius: 50%; background: red; color: white;"></span>
    </div>
    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
        <form>
            
            <div class="tab-content">
                <div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
                    <div id="daftarnotif" class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll ps ps--active-y" data-scroll="true" data-height="300" data-mobile-height="200" style="height: 300px; overflow: hidden;">

                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 0px; height: 300px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 106px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endif
<!--begin: User bar -->
<div class="kt-header__topbar-item kt-header__topbar-item--user">
    <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
        <span class="kt-header__topbar-welcome kt-visible-desktop" style="color: white;">{{Auth::guard('sourching')->user()->name}} <i class="fa fa-user-circle"></i></span>
        <span class="kt-header__topbar-username kt-visible-desktop">!</span>
        <span class="kt-header__topbar-icon kt-bg-brand kt-hidden"><b>S</b></span>
    </div>
    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

        <!--begin: Navigation -->
        <div class="kt-notification">
            <a href="{{route('sourching.account')}}" class="kt-notification__item">
                <div class="kt-notification__item-icon">
                    <i class="flaticon2-user kt-font-success"></i>
                </div>
                <div class="kt-notification__item-details">
                    <div class="kt-notification__item-title">
                        Profile
                    </div>
                </div>
            </a>
                <a href="" class="kt-notification__item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <div class="kt-notification__item-icon">
                        <i class="flaticon-logout kt-font-danger"></i>
                    </div>
                    <div class="kt-notification__item-details">
                        <div class="kt-notification__item-title">
                            Sign Out
                        </div>
                    </div>
                </a>

                <form id="logout-form" action="{{ route('sourching.logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
        </div>

        <!--end: Navigation -->
    </div>
</div>

<!--end: User bar -->
</div>

                        <!-- end:: Header Topbar -->
                    </div>
                </div>

                <!-- end:: Header -->
                <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
                    <div class="kt-container  kt-container--fluid  kt-grid kt-grid--ver">

                        <!-- begin:: Aside -->
                        <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
                        <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

                            @include('dashboard.superadmin.layout.menu')

                        </div>

                        <!-- end:: Aside -->
                        @yield('content')
                    </div>
                </div>

                <!-- begin:: Footer -->
                <div class="kt-footer kt-grid__item" id="kt_footer">
                    <div class="kt-container  kt-container--fluid ">
                        <div class="kt-footer__wrapper">
                            <div class="kt-footer__copyright">
                                2023&nbsp;&copy;&nbsp;<a href="https://ngawi.suryapangansemesta.store" target="_blank" class="kt-link">PT. SURYA PANGAN SEMESTA</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end:: Footer -->
            </div>
        </div>
    </div>

    <!-- end:: Page -->
    <!-- end::Quick Panel -->

    <!-- begin::Scrolltop -->
    <div id="kt_scrolltop" class="kt-scrolltop">
        <i class="fa fa-arrow-up"></i>
    </div>

    <!-- end::Scrolltop -->

    <!-- begin::Demo Panel -->

    <!-- end::Demo Panel -->

    <!--Begin:: Chat-->

    <!--ENd:: Chat-->

    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#5d78ff",
                    "light": "#ffffff",
                    "dark": "#282a3c",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                    "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                }
            }
        };
    </script>
    <!-- end::Global Config -->
</body>
@include('dashboard.superadmin.layout.js') @yield('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    function getnotif() {
        $.ajax({
            type: "GET",
            url: "{{route('sourching.get_notifikasisourching')}}",
            success: function(data) {
                var notif = JSON.parse(data);
                // console.log(notif);
                var panjang = notif.length;
                $("#daftarnotif").empty();
                if (panjang > 0) {
                    for (var a = 0; a < panjang; a++) {
                        //desain notif
                        var idnotif = notif[a].id_notif;
                        var not = '<a href="{{route('sourching.set_notifikasisourching')}}?id=' + idnotif + '" class="kt-notification__item"><div class="kt-notification__item-details"><div class="kt-notification__item-title">' + notif[a].judul + ' <span class="btn btn-label-success btn-sm ">' + notif[a].created_at + '</span></div><div class="kt-notification__item-time">' + notif[a].keterangan + '<br><br></div></div></div></a>';
                        $("#daftarnotif").prepend(not);
                        $("#count_notif").text(panjang);
                    }
                }else{
                    var not = '<div class="kt-notification__item-details" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);padding: 10px;"><p>Tidak Ada Notifikasi</p></div>';
                    $("#daftarnotif").prepend(not);
                    $("#count_notif").text(panjang);

                }
            }
        });
    }


    function newnotif() {
        $.ajax({
            type: "GET",
            url: "{{route('sourching.new_notifikasisourching')}}",
            success: function(data) {
                // console.log(data);
                if (data!='kosong') {
                    Swal.fire({
                        title: data.title,
                        icon: 'success',
                        text: data.keterangan,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    var audio = new Audio("{{asset('notif.mp3')}}");
                    audio.play();
                }else if (data=='kosong') {
                    // console.log('ok');
                }
            }
        });
    }
    setInterval(getnotif, 5000);
    setInterval(newnotif, 6000);
</script>
</html>