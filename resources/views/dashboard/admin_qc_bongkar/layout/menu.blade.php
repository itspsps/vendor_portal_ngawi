<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
    <div class="text-center">
        <a href="{{route('qc.bongkar.home')}}">
            <img class="img-responsive" alt="iamgurdeeposahan" src="{{asset('logo_sps_ngawi.png')}}" style="width: 150px;">
        </a>
    </div>
    <div class="btn btn-label-primary col-lg-12">
        <span><b>MENU</b></span>
    </div>
    <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1">
        <ul class="kt-menu__nav ">
            <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/bongkar/home') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ route('qc.bongkar.home') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon fa fa-home"></i>
                    <span class="kt-menu__link-text">Beranda</span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/bongkar/data_antrian_bongkar') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ route('qc.bongkar.data_antrian_bongkar') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon flaticon2-delivery-truck kt-font-dark"></i>

                    <span class="kt-menu__link-text">Data Antrian
                    </span>
                    <span id="count_antrian" class="badge badge badge-info" style="position:absolute; margin-left:75%; width: 100%; text-align: left; background-color: #9f187c;">

                    </span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/bongkar/antrian_bongkar') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ route('qc.bongkar.antrian_bongkar') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon flaticon2-open-box kt-font-info"></i>
                    <span class="kt-menu__link-text">Proses Bongkar</span>
                    <span id="proses_bongkar" class="badge badge badge-info" style="position:absolute; margin-left:75%; width: 100%; text-align: left; background-color: #9f187c;">

                    </span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/bongkar/data_bongkar') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ route('qc.bongkar.data_bongkar') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon flaticon2-open-box kt-font-success"></i>
                    <span class="kt-menu__link-text">Data Bongkar</span>
                    <span id="data_bongkar" class="badge badge badge-info" style="position:absolute; margin-left:75%; width: 100%; text-align: left; background-color: #9f187c;">
                    </span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/bongkar/data_revisi_gb') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ route('qc.bongkar.data_revisi_gb') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon flaticon2-sheet kt-font-warning"></i>
                    <span class="kt-menu__link-text">Data Revisi</span>
                    <span id="revisi_bongkar" class="badge badge badge-info" style="position:absolute; margin-left:75%; width: 50%; text-align: left; background-color: #9f187c;">
                    </span>
                </a>
            </li>
            <li class="kt-menu__item " aria-haspopup="true">
                <a href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="kt-menu__link ">
                    <i class="kt-menu__link-icon fa flaticon-logout kt-font-danger"></i>
                    <span class="kt-menu__link-text">Sign Out</span>
                </a>
            </li>
            <form id="logout-form" action="" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            <li class="kt-menu__item text-center" aria-haspopup="true" data-ktmenu-submenu-toggle="hover" style="bottom: 2%; position: fixed; margin-left: -5px; text-align: center;">
                <div class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-text">
                        2023&nbsp;&copy;&nbsp;<a href="https://ngawi.suryapangansemesta.store/qc/bongkar/home" target="_blank" class="kt-link">VENDOR PORTAL-NGAWI</a>
                    </span>
                </div>
            </li>
        </ul>
    </div>
</div>