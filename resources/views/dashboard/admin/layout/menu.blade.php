<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
    <div class="text-center">
        <a href="{{route('security.home')}}">
            <img class="img-responsive" alt="iamgurdeeposahan" src="{{asset('logo_sps_ngawi.png')}}" style="width: 150px;">
        </a>
    </div>
    <div class="btn btn-label-primary col-lg-12">
        <span><b>MENU</b></span>
    </div>
    <div id="kt_aside_menu" class="kt-aside-menu" data-ktmenu-vertical="1" data-ktmenu-scroll="1">
        <ul class="kt-menu__nav ">
            <li class="kt-menu__item  kt-menu__item--{{set_active('security/home')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{route('security.home')}}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon fa fa-home"></i>
                    <span class="kt-menu__link-text">Beranda</span>
                </a>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu {{ Request::is('security/gabah_basah*') ? 'kt-menu__item--open' : '' }}{{ Request::is('security/gabah_kering*') ? 'kt-menu__item--open' : '' }}{{ Request::is('security/beras_pk*') ? 'kt-menu__item--open' : '' }}{{ Request::is('security/beras_ds_urgent*') ? 'kt-menu__item--open' : '' }}{{ Request::is('security/beras_ds_noturgent*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" id="Combined-Shape" fill="#000000"></path>
                            </g>
                        </svg>
                    </span>
                    <span class="kt-menu__link-text">PLAN PO</span></span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item kt-menu__item--{{set_active('security/gabah_basah')}} " aria-haspopup="true">
                            <a href="{{route('security.gabah_basah')}}" class="kt-menu__link ">
                                <i class="kt-menu__link-icon    fa fa-tasks"></i>
                                <span class="kt-menu__link-text">Gabah Basah</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{set_active('security/gabah_kering')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('security.gabah_kering') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon    fa fa-tasks"></i>
                                <span class="kt-menu__link-text">Gabah Kering</span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item--{{set_active('security/beras_pk')}} " aria-haspopup="true">
                            <a href="{{route('security.beras_pk')}}" class="kt-menu__link ">
                                <i class="kt-menu__link-icon    fa fa-tasks"></i>
                                <span class="kt-menu__link-text">Beras PK</span>
                            </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item--submenu {{ Request::is('security/beras_ds_urgent*') ? 'kt-menu__item--open' : '' }}{{ Request::is('security/beras_ds_noturgent*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <span class="kt-menu__link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                            <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                            <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" id="Combined-Shape" fill="#000000"></path>
                                        </g>
                                    </svg>
                                </span>
                                <span class="kt-menu__link-text">Beras DS</span></span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item kt-menu__item--{{set_active('security/beras_ds_urgent')}} " aria-haspopup="true">
                                        <a href="{{route('security.beras_ds_urgent')}}" class="kt-menu__link ">
                                            <i class="kt-menu__link-icon    fa fa-tasks"></i>
                                            <span class="kt-menu__link-text">Urgent</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item--{{set_active('security/beras_ds_noturgent')}} " aria-haspopup="true">
                                        <a href="{{route('security.beras_ds_noturgent')}}" class="kt-menu__link ">
                                            <i class="kt-menu__link-icon    fa fa-tasks"></i>
                                            <span class="kt-menu__link-text">Not Urgent</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('security/data_revisi')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ url('security/data_revisi') }}" class="kt-menu__link kt-menu__toggle" style="position:relative;">
                    <i class="kt-menu__link-icon    fa fa-tasks"></i>
                    <span class="kt-menu__link-text ">Data&nbsp;Revisi
                    </span>
                    <span id="count_notif_data_revisi" class="badge badge badge-info" style="position:absolute; margin-left:75%; width: 100%; text-align: left; background-color: #9f187c;">

                    </span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('security/po_parkir')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{url('security/po_parkir')}}" class="kt-menu__link ">
                    <i class="kt-menu__link-icon fa fa-calendar-check"></i>
                    <span class="kt-menu__link-text">PO Datang
                    </span>
                    <span id="count_notif_po_datang" class="badge badge badge-info" style="position:absolute; margin-left:75%; width: 100%; text-align: left; background-color: #9f187c;">
                    </span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('security/po_diterima')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ url('security/po_diterima') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon    fa fa-layer-group"></i>
                    <span class="kt-menu__link-text">PO Parkir
                    </span>
                    <span id="count_notif_po_parkir" class="badge badge badge-info" style="position:absolute; margin-left:75%; width: 100%; text-align: left; background-color: #9f187c;">
                    </span>
                </a>
            </li>

            <li class="kt-menu__item  kt-menu__item--{{set_active('security/po_on_call')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{url('security/po_on_call')}}" class="kt-menu__link ">
                    <i class="kt-menu__link-icon    fa fa-microphone-alt"></i>
                    <span class="kt-menu__link-text">PO On Call
                    </span>
                    <span id="count_notif_po_on_call" class="badge badge badge-info" style="position:absolute; margin-left:75%; width: 100%; text-align: left; background-color: #9f187c;">
                    </span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('security/po_pending')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ url('security/po_pending') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon    fa fa-user-clock"></i>
                    <span class="kt-menu__link-text">PO Pending
                    </span>
                    <span id="count_notif_po_pending" class="badge badge badge-info" style="position:absolute; margin-left:75%; width: 100%; text-align: left; background-color: #9f187c;">
                    </span>
                </a>
            </li>
            <!--<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">-->
            <!--    <a href="{{ url('security/unloading_location') }}" class="kt-menu__link kt-menu__toggle">-->
            <!--        <i class="kt-menu__link-icon    fa fa-server"></i>-->
            <!--        <span class="kt-menu__link-text">Lokasi Bongkar</span>-->
            <!--    </a>-->
            <!--</li>-->
            <li class="kt-menu__item  kt-menu__item--{{set_active('security/po_bongkar')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{url('security/po_bongkar')}}" class="kt-menu__link ">
                    <i class="kt-menu__link-icon    fa fa-flag-checkered"></i>
                    <span class="kt-menu__link-text">PO Bongkar
                    </span>
                    <span id="count_notif_po_bongkar" class="badge badge badge-info" style="position:absolute; margin-left:75%; width: 100%; text-align: left; background-color: #9f187c;">
                    </span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('security/po_ditolak')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ url('security/po_ditolak') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon    fa fa-ban"></i>
                    <span class="kt-menu__link-text">PO Ditolak
                    </span>
                    <span id="count_notif_po_ditolak" class="badge badge badge-info" style="position:absolute; margin-left:75%; width: 100%; text-align: left; background-color: #9f187c;">
                    </span>
                </a>
            </li>

            <li class="kt-menu__item " aria-haspopup="true">
                <a href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="kt-menu__link ">
                    <i class="kt-menu__link-icon fa flaticon-logout"></i>
                    <span class="kt-menu__link-text">Sign Out</span>
                </a>
            </li>
            <form id="logout-form" action="" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            <li class="kt-menu__item text-center" aria-haspopup="true" data-ktmenu-submenu-toggle="hover" style="bottom: 2%; position: fixed; margin-left: -5px; text-align: center;">
                <div class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-text">
                        2023&nbsp;&copy;&nbsp;<a href="https://ngawi.suryapangansemesta.store/security/home" target="_blank" class="kt-link">VENDOR PORTAL-NGAWI</a>
                    </span>
                </div>
            </li>
        </ul>
    </div>
</div>