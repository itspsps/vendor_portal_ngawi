<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
    <div class="text-center">
        <a href="{{route('timbangan.home')}}">
            <img class="img-responsive" alt="iamgurdeeposahan" src="{{asset('logo_sps_ngawi.png')}}" style="width: 150px;">
        </a>
    </div>
    <div class="btn btn-label-primary col-lg-12">
        <span><b>MENU</b></span>
    </div>
    <div id="kt_aside_menu" class="kt-aside-menu" data-ktmenu-vertical="1" data-ktmenu-scroll="1">
        <ul class="kt-menu__nav ">
            <li class="kt-menu__item  kt-menu__item--{{set_active('timbangan/home')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{route('timbangan.home')}}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon fa fa-home"></i>
                    <span class="kt-menu__link-text">Beranda</span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('timbangan/timbangan_awal')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ url('timbangan/timbangan_awal') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon  flaticon2-checking kt-font-info"></i>
                    <span class="kt-menu__link-text">Timbangan Masuk</span>
                    <span id="count_tonaseawal" class="badge badge badge-info" style="position:absolute; margin-left:81%; width: 100%; text-align: left;  background-color: #9f187c;">
                    </span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('timbangan/data_timbangan_awal')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ url('timbangan/data_timbangan_awal') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon    flaticon2-checking kt-font-info"></i>
                    <span class="kt-menu__link-text">Data Timbangan Masuk</span>
                    <span id="count_datatonaseawal" class="badge badge badge-info" style="position:absolute; margin-left:81%; width: 100%; text-align: left;  background-color: #9f187c;">
                    </span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('timbangan/timbangan_akhir')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ url('timbangan/timbangan_akhir') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon     flaticon2-checking kt-font-success"></i>
                    <span class="kt-menu__link-text">Timbangan Keluar</span>
                    <span id="count_tonaseakhir" class="badge badge badge-info" style="position:absolute; margin-left:81%;  width: 100%; text-align: left; background-color: #9f187c;">
                    </span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('timbangan/data_timbangan_akhir')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ url('timbangan/data_timbangan_akhir') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon    flaticon2-checking kt-font-success"></i>
                    <span class="kt-menu__link-text">Data Timbangan Keluar</span>
                    <span id="count_datatonaseakhir" class="badge badge badge-info" style="position:absolute; margin-left:81%; width: 100%; text-align: left; background-color: #9f187c;">
                    </span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('timbangan/data_revisi_timbangan')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ url('timbangan/data_revisi_timbangan') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon   flaticon2-checking kt-font-warning"></i>
                    <span class="kt-menu__link-text">Data Revisi</span>
                    <span id="count_revisitonase" class="badge badge badge-info" style="position:absolute; margin-left:81%; width: 100%; text-align: left; background-color: #9f187c;">
                    </span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('timbangan/account_timbangan')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ url('timbangan/account_timbangan') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon   flaticon2-user-1 kt-font-info"></i>
                    <span class="kt-menu__link-text">Akun</span>
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
                        2023&nbsp;&copy;&nbsp;<a href="https://ngawi.suryapangansemesta.store/timbangan/home" target="_blank" class="kt-link">VENDOR PORTAL-NGAWI</a>
                    </span>
                </div>
            </li>
        </ul>
    </div>
</div>