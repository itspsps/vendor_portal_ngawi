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
     <link href="{{ asset('logo-login-sps.png') }}" rel="icon">

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

    @include('dashboard.admin.layout.css')
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

<body
    class="kt-page-content-white kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- begin:: Page -->

    <!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed " style="background: #9F187C;">
        <div class="kt-header-mobile__logo">
            <a href="{{route('security.home')}}">
            <img class="img-responsive" alt="iamgurdeeposahan" src="{{asset('logo_vp.png')}}" style="width: 13%;">
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left"
                id="kt_aside_mobile_toggler">
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
                <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " data-ktheader-minimize="on"
                    style="background: #9F187C;">
                    <div class="kt-container  kt-container--fluid ">

                        <!-- begin:: Brand -->
                        <div class="kt-header__brand " id="kt_header_brand">
                            <div class="kt-header__brand-logo">
                                <a href="{{route('security.home')}}">
                                <img class="img-responsive" alt="iamgurdeeposahan" src="{{asset('logo_vp.png')}}" style="width: 10%;">
                                </a>
                            </div>
                        </div>

                        <!-- end:: Brand -->

                        <!-- begin:: Header Topbar -->
                        <div class="kt-header__topbar">

                        <div class="kt-header__topbar-item dropdown">
                                <div id="count_notif" class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="true">
                                    <span class="kt-header__topbar-icon"><i class="flaticon2-bell-alarm-symbol"></i></span>
                                </div>
                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-333px, 70px, 0px);">
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
                                                <div class="text-center">
                                                    <a href="{{route('security.get_notif_security_all')}}"><b>Baca Selengkapnya</b> <i class="flaticon2-right-arrow"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--begin: User bar -->
                            <div class="kt-header__topbar-item kt-header__topbar-item--user">
                                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                    <span class="kt-header__topbar-welcome kt-visible-desktop"
                                        style="color: white;">{{Auth::guard('security')->user()->name}} <i class="fa fa-user-circle"></i></span>
                                </div>
                                <div
                                    class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                                    <!--begin: Navigation -->
                                    <div class="kt-notification">
                                        <div class="kt-notification__custom kt-space-between">
                                            <a href=""
                                                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                                class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
                                            <form id="logout-form" action="{{ route('security.security_logout') }}" method="POST"
                                                style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </div>
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
                <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch"
                    id="kt_body">
                    <div class="kt-container  kt-container--fluid  kt-grid kt-grid--ver">

                        <!-- begin:: Aside -->
                        <button class="kt-aside-close " id="kt_aside_close_btn"><i
                                class="la la-close"></i></button>
                        <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop"
                            id="kt_aside">

                            @include('dashboard.admin.layout.menu')

                        </div>

                        <!-- end:: Aside -->
                        @yield('content')
                    </div>
                </div>

          
            </div>
        </div>
    </div>

    <!-- end:: Page -->

    <!-- begin::Quick Panel -->

    <!-- end::Quick Panel -->

    <!-- begin::Scrolltop -->
    <div id="kt_scrolltop" class="kt-scrolltop">
        <i class="fa fa-arrow-up"></i>
    </div>


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
@include('dashboard.admin.layout.js') @yield('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
     function getnotif(){
        $.ajax({
            type: "GET",
            url: "{{route('security.get_notifikasisecurity')}}",
            success: function(data) {
                var notif = JSON.parse(data);
                notif.sort();
                notif.reverse();
                // console.log(notif);
                var panjang = notif.length;
                $("#daftarnotif").empty();
                if(panjang==10){
                    $.each(notif, function(item) {
                        //desain notif
                        var idnotif = notif[item].id_notif;
                        var not = '<a href="{{route('security.set_notifikasisecurity')}}?id=' + idnotif + '" class="kt-notification__item"><div class="kt-notification__item-details"><div class="kt-notification__item-title">' + notif[item].judul + ' <span class="btn btn-label-success btn-sm ">' + notif[item].created_at + '</span></div><div class="kt-notification__item-time">' + notif[item].keterangan + '<br><br></div></div></div></a>';
                        $("#daftarnotif").prepend(not);
                        var length ='<span class="badge rounded-pill bg-danger" style="position: absolute; top: 10px; right: -10px; padding: 5px 3px; border-radius: 50%; color: white;">10++</span>';
                        $("#count_notif").prepend(length);
                    });
                }else if(panjang<10){
                    $.each(notif, function(item) {
                        //desain notif
                        var idnotif = notif[item].id_notif;
                        var not = '<a href="{{route('security.set_notifikasisecurity')}}?id=' + idnotif + '" class="kt-notification__item"><div class="kt-notification__item-details"><div class="kt-notification__item-title">' + notif[item].judul + ' <span class="btn btn-label-success btn-sm ">' + notif[item].created_at + '</span></div><div class="kt-notification__item-time">' + notif[item].keterangan + '<br><br></div></div></div></a>';
                        $("#daftarnotif").prepend(not);
                        var length ='<span class="badge rounded-pill bg-danger" style="position: absolute; top: 10px; right: -10px; padding: 5px 3px; border-radius: 50%; color: white;">'+panjang+'</span>';
                        $("#count_notif").prepend(length);
                    });
                }else{
                    var not = '<div class="kt-notification__item-details" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);padding: 10px;"><p>Tidak Ada Notifikasi</p></div>';
                    $("#daftarnotif").prepend(not);
                    $("#count_notif").text(panjang);

                }
            }
          });
    }
    function get_count_notifikasi_security(){
        $.ajax({
            type: "GET",
            url: "{{route('security.get_count_notifikasi_security')}}",
            success: function(data){
                // console.log(data.count_notif_po_datang);
                $( "#count_notif_data_revisi" ).empty();
                $( "#count_notif_po_datang" ).empty();
                $( "#count_notif_po_parkir" ).empty();
                $( "#count_notif_po_on_call" ).empty();
                $( "#count_notif_po_pending" ).empty();
                $( "#count_notif_po_bongkar" ).empty();
                $( "#count_notif_po_ditolak" ).empty();
                    $( "#count_notif_data_revisi" ).html(data.count_notif_data_revisi);
                    $( "#count_notif_po_datang" ).html(data.count_notif_po_datang);
                    $( "#count_notif_po_parkir" ).html(data.count_notif_po_parkir);
                    $( "#count_notif_po_on_call" ).html(data.count_notif_po_on_call);
                    $( "#count_notif_po_pending" ).html(data.count_notif_po_pending);
                    $( "#count_notif_po_bongkar" ).html(data.count_notif_po_bongkar);
                    $( "#count_notif_po_ditolak" ).html(data.count_notif_po_ditolak);
            }
          });

    }
   
    function newnotif(){
        $.ajax({
            type: "GET",
            url: "{{route('security.new_notifikasisecurity')}}",
            success: function(data){
                var notif = JSON.parse(data);
                // console.log(data);
                var panjang = notif.length;
                // console.log(panjang);
                if(panjang>0){
                    Swal.fire({
                title: 'Ada Data PO',
                icon: 'success',
                text: 'Ada Data PO Baru',
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                    });
                    var audio = new Audio('{{asset('notif.mp3')}}');
                    audio.play();
                }
            }
          });
    }
  
  //Set interval waktu menampilkan (1 detik = 1000)
  setInterval(getnotif, 5000);
  setInterval(newnotif, 6000);
  setInterval(get_count_notifikasi_security, 5000);
</script>
</html>
