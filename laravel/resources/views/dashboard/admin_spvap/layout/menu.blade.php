<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
  <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1">
    <ul class="kt-menu__nav ">
      <li class="kt-menu__section kt-menu__section--first">
        <h4 class="kt-menu__section-text">Master</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
      </li>
      <li class="kt-menu__item  kt-menu__item--{{set_active('ap/spv/home')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="{{route('ap.spv.home')}}" class="kt-menu__link kt-menu__toggle">
          <i class="kt-menu__link-icon fa fa-home"></i>
          <span class="kt-menu__link-text">Beranda</span>
        </a>
      </li>

      <li class="kt-menu__item kt-menu__item--submenu {{ Request::is('ap/spv/revisi_data_gb*') ? 'kt-menu__item--open' : '' }}{{ Request::is('ap/spv/revisi_data_pk*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
          <span class="kt-menu__link-icon">
            <i class="flaticon2-notepad kt-font-info"></i>
          </span>
          <span class="kt-menu__link-text">Approve Data Revisi</span></span>
          <i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu " kt-hidden-height="200" style="">
          <span class="kt-menu__arrow"></span>
          <ul class="kt-menu__subnav">

            <li class="kt-menu__item kt-menu__item--{{set_active('ap/spv/revisi_data_gb')}} " aria-haspopup="true">
              <a href="{{route('ap.spv.revisi_data_gb')}}" class="kt-menu__link ">
                <i class="kt-menu__link-icon    flaticon2-checkmark kt-font-success"></i>
                <span class="kt-menu__link-text">Data Revisi Gabah Basah</span>
              </a>
            </li>
            <li class="kt-menu__item kt-menu__item--{{set_active('ap/spv/revisi_data_pk')}} " aria-haspopup="true">
              <a href="{{route('ap.spv.revisi_data_pk')}}" class="kt-menu__link ">
                <i class="kt-menu__link-icon    flaticon2-checkmark kt-font-warning"></i>
                <span class="kt-menu__link-text">Data Revisi PK</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="kt-menu__item kt-menu__item--submenu {{ Request::is('ap/spv/integrasi_epicor_gb*') ? 'kt-menu__item--open' : '' }}{{ Request::is('ap/spv/integrasi_epicor_pk*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
          <span class="kt-menu__link-icon">
            <i class="flaticon2-paper kt-font-info"></i>
          </span>
          <span class="kt-menu__link-text">Approve Data Pembelian</span></span>
          <i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu " kt-hidden-height="200" style="">
          <span class="kt-menu__arrow"></span>
          <ul class="kt-menu__subnav">
            <li class="kt-menu__item  kt-menu__item--{{ set_active('ap/spv/integrasi_epicor_gb') }}" aria-haspopup="true">
              <a href="{{ route('ap.spv.integrasi_epicor_gb') }}" class="kt-menu__link">
                <i class="kt-menu__link-icon   flaticon2-checking kt-font-success"></i>
                <span class="kt-menu__link-text">Gabah Basah</span>
              </a>
            </li>
            <li class="kt-menu__item kt-menu__item--{{set_active('ap/spv/integrasi_epicor_pk')}} " aria-haspopup="true">
              <a href="{{route('ap.spv.integrasi_epicor_pk')}}" class="kt-menu__link ">
                <i class="kt-menu__link-icon    flaticon2-checking kt-font-warning"></i>
                <span class="kt-menu__link-text">Beras PK</span>
              </a>
            </li>

          </ul>
        </div>
      </li>
      <li class="kt-menu__section kt-menu__section--first">
        <h4 class="kt-menu__section-text">Akun</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
      </li>
      <li class="kt-menu__item kt-menu__item--{{ set_active('ap/spv/account_spvap') }} " aria-haspopup="true">
        <a href="{{route('ap.spv.account_spvap')}}" class="kt-menu__link ">
          <i class="kt-menu__link-icon flaticon2-user-1 kt-font-info"></i>
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
    </ul>
  </div>
</div>