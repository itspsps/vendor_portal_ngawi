<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="SPS" name="keywords">
    <meta content="" name="description">
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

    @include('dashboard.admin_master.layout.css')
    @yield('css')
    <style>
        @media only screen and (max-height: 1100px) {
            #kt_aside_menu {
                max-height: 700px !important;
            }
        }

        @media only screen and (max-height: 1000px) {
            #kt_aside_menu {
                max-height: 600px !important;
            }
        }

        @media only screen and (max-height: 950px) {
            #kt_aside_menu {
                max-height: 500px !important;
            }
        }

        @media only screen and (max-height: 900px) {
            #kt_aside_menu {
                max-height: 450px !important;
            }
        }

        @media only screen and (max-height: 800px) {
            #kt_aside_menu {
                max-height: 400px !important;
            }
        }

        @media only screen and (max-height: 700px) {
            #kt_aside_menu {
                max-height: 230px !important;
            }
        }

        @media only screen and (max-height: 600px) {
            #kt_aside_menu {
                max-height: 230px !important;
            }
        }

        @media only screen and (max-height: 550px) {
            #kt_aside_menu {
                max-height: 150px !important;
            }
        }

        @media only screen and (max-height: 500px) {
            #kt_aside_menu {
                max-height: 3px !important;
            }
        }

        @media only screen and (max-height: 400px) {
            #kt_aside_menu {
                max-height: 3px !important;
            }
        }
    </style>
</head>

<body class="kt-page-content-white kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- begin:: Page -->

    <!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed " style="background: #9F187C;">
        <div class="kt-header-mobile__logo">
            <a href="{{route('master.home')}}">
                <img class="img-responsive" alt="iamgurdeeposahan" src="{{asset('logo_vp.png')}}" style="width: 13%;">
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
                                <div class="row">
                                    <a href="{{route('master.home')}}">
                                        <img class="img-responsive" alt="iamgurdeeposahan" src="{{asset('logo_vp.png')}}" style="width: 10%;">
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- end:: Brand -->

                        <!-- begin:: Header Topbar -->
                        <div class="kt-header__topbar">

                            <!--begin: Notifications -->
                            <div class="kt-header__topbar-item dropdown">
                                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="true">
                                    <span class="kt-header__topbar-icon"><i class="flaticon2-bell-alarm-symbol"></i></span>
                                    <span id="count_notif" class="badge" style="position: absolute; top: 10px; right: -10px; padding: 5px 10px; border-radius: 50%; background: red; color: white;"></span>
                                </div>
                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                                    <form>
                                        <!--end: Head -->
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

                            <!--end: Notifications -->

                            <!--begin: User bar -->
                            <div class="kt-header__topbar-item kt-header__topbar-item--user">
                                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                    <span class="kt-header__topbar-welcome kt-visible-desktop" style="color: white;">{{Auth::guard('master')->user()->name_master}} <i class="fa fa-user-circle"></i></span>
                                </div>
                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                                    <!--begin: Navigation -->
                                    <div class="kt-notification">
                                        <a href="{{route('master.account_master')}}" class="kt-notification__item">
                                            <div class="kt-notification__item-icon">
                                                <i class="flaticon2-user kt-font-success"></i>
                                            </div>
                                            <div class="kt-notification__item-details">
                                                <div class="kt-notification__item-title">
                                                    Profile
                                                </div>
                                            </div>
                                        </a>
                                        <form id="form_logout" action="{{route('master.master_logout')}}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                        <a href="javascript:void(0);" id="btn_logout" class="kt-notification__item">
                                            <div class="kt-notification__item-icon">
                                                <i class="flaticon-logout kt-font-danger"></i>
                                            </div>
                                            <div class="kt-notification__item-details">
                                                <div class="kt-notification__item-title">
                                                    Sign Out
                                                </div>
                                            </div>
                                        </a>
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

                            @include('dashboard.admin_master.layout.menu')

                        </div>

                        <!-- end:: Aside -->
                        @yield('content')
                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- end:: Page -->


    <!-- end::Quick Panel -->

    <!-- begin::Scrolltop -->
    <div id="kt_scrolltop" class="kt-scrolltop">
        <i class="fa fa-arrow-up"></i>
    </div>


    <!-- end::Demo Panel -->


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
@include('dashboard.admin_master.layout.js') @yield('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function get_notifdatapembelian() {
        $.ajax({
            type: "GET",
            url: "{{route('master.get_notifdatapembelian')}}",
            success: function(data) {
                $("#data_pembelian").empty();
                var notif = JSON.parse(data);
                $("#data_pembelian").html(notif);
            }
        });
    }

    function get_notifdataAll() {}

    function get_notifdatarevisiap() {
        $.ajax({
            type: "GET",
            url: "{{route('master.get_notifdatarevisiap')}}",
            success: function(data) {
                $("#data_revisiap").empty();
                var notif = JSON.parse(data);
                $("#data_revisiap").html(notif);
            }
        });
    }

    function get_notifrevisispvap() {
        $.ajax({
            type: "GET",
            url: "{{route('master.get_notifrevisispvap')}}",
            success: function(data) {
                $("#data_approverevisi").empty();
                var notif = JSON.parse(data);
                $("#data_approverevisi").html(notif);
            }
        });
    }

    function get_notifapprovespvap() {
        $.ajax({
            type: "GET",
            url: "{{route('master.get_notifapprovespvap')}}",
            success: function(data) {
                $("#data_approvespvap").empty();
                var notif = JSON.parse(data);
                $("#data_approvespvap").html(notif);
            }
        });
    }

    function getcountnotif_tonaseawal() {
        $.ajax({
            type: "GET",
            url: "{{route('master.getcountnotif_tonaseawal')}}",
            success: function(data) {
                $("#count_tonaseawal").empty();
                var notif = JSON.parse(data);
                $("#count_tonaseawal").html(notif);
            }
        });
    }

    function getcountnotif_datatonaseawal() {
        $.ajax({
            type: "GET",
            url: "{{route('master.getcountnotif_datatonaseawal')}}",
            success: function(data) {
                $("#count_datatonaseawal").empty();
                var notif = JSON.parse(data);
                $("#count_datatonaseawal").html(notif);
            }
        });
    }

    function getcountnotif_tonaseakhir() {
        $.ajax({
            type: "GET",
            url: "{{route('master.getcountnotif_tonaseakhir')}}",
            success: function(data) {
                $("#count_tonaseakhir").empty();
                var notif = JSON.parse(data);
                $("#count_tonaseakhir").html(notif);
            }
        });
    }

    function getcountnotif_datatonaseakhir() {
        $.ajax({
            type: "GET",
            url: "{{route('master.getcountnotif_datatonaseakhir')}}",
            success: function(data) {
                $("#count_datatonaseakhir").empty();
                var notif = JSON.parse(data);
                $("#count_datatonaseakhir").html(notif);
            }
        });
    }

    function getcountnotif_revisitonase() {
        $.ajax({
            type: "GET",
            url: "{{route('master.getcountnotif_revisitonase')}}",
            success: function(data) {
                $("#count_revisitonase").empty();
                var notif = JSON.parse(data);
                $("#count_revisitonase").html(notif);
            }
        });
    }

    function getcountnotif_antrianbongkar() {
        $.ajax({
            type: "GET",
            url: "{{route('master.getcountnotif_antrianbongkar')}}",
            success: function(data) {
                console.log(data);
                $("#count_antrian").empty();
                var notif = JSON.parse(data);
                $("#count_antrian").html(notif + ' Truk');
            }
        });
    }

    function getcountnotif_prosesbongkar() {
        $.ajax({
            type: "GET",
            url: "{{route('master.getcountnotif_prosesbongkar')}}",
            success: function(data) {
                $("#proses_bongkar").empty();
                var notif = JSON.parse(data);
                $("#proses_bongkar").html(notif + ' PO');
            }
        });
    }

    function getcountnotif_databongkar() {
        $.ajax({
            type: "GET",
            url: "{{route('master.getcountnotif_databongkar')}}",
            success: function(data) {
                $("#data_bongkar").empty();
                var notif = JSON.parse(data);
                $("#data_bongkar").html(notif);
            }
        });
    }

    function getcountnotif_revisibongkar() {
        $.ajax({
            type: "GET",
            url: "{{route('master.getcountnotif_revisibongkar')}}",
            success: function(data) {
                $("#revisi_bongkar").empty();
                var notif = JSON.parse(data);
                $("#revisi_bongkar").html(notif);
            }
        });
    }
    setInterval(get_notifdatarevisiap, 2000);
    setInterval(get_notifdatapembelian, 2000);
    setInterval(get_notifrevisispvap, 2000);
    setInterval(get_notifapprovespvap, 2000);
    setInterval(getcountnotif_tonaseawal, 2000);
    setInterval(getcountnotif_datatonaseawal, 2000);
    setInterval(getcountnotif_tonaseakhir, 2000);
    setInterval(getcountnotif_datatonaseakhir, 2000);
    setInterval(getcountnotif_revisitonase, 2000);
    setInterval(getcountnotif_antrianbongkar, 2000);
    setInterval(getcountnotif_prosesbongkar, 2000);
    setInterval(getcountnotif_databongkar, 2000);
    setInterval(getcountnotif_revisibongkar, 2000);
    $('body').on('click', '#btn_logout', function() {
        Swal.fire({
            title: 'Konfirmasi',
            icon: 'warning',
            text: "Apakah Anda kamu Keluar ?",
            showCancelButton: true,
            inputValue: 0,
            confirmButtonText: 'Yes',
        }).then((result) => {

            if (result.value) {
                Swal.fire({
                    title: 'Harap Tuggu Sebentar!',
                    html: 'Proses Logout...', // add html attribute if you want or remove
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                        $('#form_logout').submit()
                    },
                });
            } else {
                Swal.fire({
                    title: 'Gagal !',
                    text: 'Anda Gagal Logout',
                    icon: 'error',
                    timer: 1500
                })
            }
        });
    });
</script>

</html>