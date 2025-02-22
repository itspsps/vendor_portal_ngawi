<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="SP" name="keywords">
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

    @include('dashboard.admin_qc_bongkar.layout.css')
    @yield('css')
    <style>
        .swal-wide{
        width:850px !important;
        }
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
            <a href="{{route('qc.bongkar.home')}}">
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
    @include('sweetalert::alert')
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                <!-- begin:: Header -->
                <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " data-ktheader-minimize="on" style="background: #9F187C;">
                    <div class="kt-container  kt-container--fluid ">

                        <!-- begin:: Brand -->
                        <div class="kt-header__brand " id="kt_header_brand">
                            <div class="kt-header__brand-logo">
                                <a href="{{route('qc.bongkar.home')}}">
                                <img class="img-responsive" alt="iamgurdeeposahan" src="{{asset('logo_vp.png')}}" style="width: 10%;">
                                </a>
                            </div>
                        </div>

                        <!-- end:: Brand -->

                        <!-- begin:: Header Topbar -->
                        <div class="kt-header__topbar">

                            <!--begin: Notifications -->
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
                                                    <a href="{{route('qc.bongkar.get_notif_qc_bongkar_all')}}"><b>Baca Selengkapnya</b> <i class="flaticon2-right-arrow"></i></a>
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
                                    <span class="kt-header__topbar-welcome kt-visible-desktop" style="color: white;">{{Auth::guard('bongkar')->user()->name_qc_bongkar}} <i class="fa fa-user-circle"></i></span>
                                </div>
                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                                    <!--begin: Navigation -->
                                    <div class="kt-notification">
                                        <div class="kt-notification__custom kt-space-between">
                                            <a href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
                                            <form id="logout-form" action="{{ route('qc.bongkar.bongkar_logout') }}" method="POST" style="display: none;">
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
                <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
                    <div class="kt-container  kt-container--fluid  kt-grid kt-grid--ver">

                        <!-- begin:: Aside -->
                        <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
                        <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

                            @include('dashboard.admin_qc_bongkar.layout.menu')

                        </div>

                        <!-- end:: Aside -->
                        @yield('content')
                    </div>
                </div>

    

                <!-- end:: Footer -->
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
@include('dashboard.admin_qc_bongkar.layout.js') @yield('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function getnotif() {
        $.ajax({
            type: "GET",
            url: "{{route('qc.bongkar.get_notifikasibongkar')}}",
            success: function(data) {
                // console.log(data.get_notifikasibongkar);
                data.get_notifikasibongkar.sort();
                data.get_notifikasibongkar.reverse();
                var panjang = data.get_notifikasibongkar.length;
                $("#daftarnotif").empty();
                $("#count_antrian").empty();
                $("#proses_bongkar").empty();
                $("#data_bongkar").empty();
                $("#revisi_bongkar").empty();
                if(panjang==10){
                    $.each(data.get_notifikasibongkar, function(item) {
                        //desain notif
                        var idnotif = data.get_notifikasibongkar[item].id_notif;
                        var not = '<a href="{{route('qc.bongkar.set_notifikasibongkar')}}?id=' + idnotif + '" class="kt-notification__item"><span class="mt--10 mr-2 btn btn-label-primary btn-sm btn-bold btn-font-md">No.</br> ' + data.get_notifikasibongkar[item].no_antrian + '</span><div class="kt-notification__item-details"><div class="kt-notification__item-title">' + data.get_notifikasibongkar[item].judul + ' <span class="btn btn-label-success btn-sm ">' + data.get_notifikasibongkar[item].created_at + '</span></div><div class="kt-notification__item-time">' + data.get_notifikasibongkar[item].keterangan + '<br><br></div></div></div></a>';
                        $("#daftarnotif").prepend(not);
                        var length ='<span class="badge rounded-pill bg-danger" style="position: absolute; top: 10px; right: -10px; padding: 5px 3px; border-radius: 50%; color: white;">10++</span>';
                        $("#count_notif").prepend(length);
                    });
                 }else if(panjang<10){
                    $.each(data.get_notifikasibongkar, function(item) {
                        //desain notif
                        var idnotif = data.get_notifikasibongkar[item].id_notif;
                        var not = '<a href="{{route('qc.bongkar.set_notifikasibongkar')}}?id=' + idnotif + '" class="kt-notification__item"><span class="mt--10 mr-2 btn btn-label-primary btn-sm btn-bold btn-font-md">No.</br> ' + data.get_notifikasibongkar[item].no_antrian + '</span><div class="kt-notification__item-details"><div class="kt-notification__item-title">' + data.get_notifikasibongkar[item].judul + ' <span class="btn btn-label-success btn-sm ">' + data.get_notifikasibongkar[item].created_at + '</span></div><div class="kt-notification__item-time">' + data.get_notifikasibongkar[item].keterangan + '<br><br></div></div></div></a>';
                        $("#daftarnotif").prepend(not);
                        var length ='<span class="badge rounded-pill bg-danger" style="position: absolute; top: 10px; right: -10px; padding: 5px 3px; border-radius: 50%; color: white;">'+panjang+'</span>';
                        $("#count_notif").prepend(length);
                    })
                }else{
                    var not = '<div class="kt-notification__item-details" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);padding: 10px;"><p>Tidak Ada Notifikasi</p></div>';
                    $("#daftarnotif").prepend(not);
                    var length ='<span class="badge rounded-pill bg-danger" style="position: absolute; top: 10px; right: -10px; padding: 5px 3px; border-radius: 50%; color: white;">'+panjang+'</span>';
                    $("#count_notif").prepend(length);
                }
                $("#count_antrian").html(data.total_antrianbongkar + ' Truk');
                $("#proses_bongkar").html(data.total_prosesbongkar + ' PO');
                $("#data_bongkar").html(data.getcountnotif_databongkar);
                $("#revisi_bongkar").html(data.getcountnotif_revisibongkar);
            }
        });
    }



    function newnotif() {
        $.ajax({
            type: "GET",
            url: "{{route('qc.bongkar.new_notifikasibongkar')}}",
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

  
    //Set interval waktu menampilkan (1 detik = 1000)
    setInterval(getnotif, 3000);
    setInterval(newnotif, 3000);
</script>

</html>