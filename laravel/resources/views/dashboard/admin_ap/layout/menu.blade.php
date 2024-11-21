<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
  <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1">
    <ul class="kt-menu__nav ">
      <li class="kt-menu__section kt-menu__section--first">
        <h4 class="kt-menu__section-text">Administrator</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
      </li>
      <li class="kt-menu__item  kt-menu__item--{{ set_active('ap/home') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="{{route('ap.home')}}" class="kt-menu__link kt-menu__toggle">
          <i class="kt-menu__link-icon fa fa-home"></i>
          <span class="kt-menu__link-text">Beranda</span>
        </a>
      </li>
      @if(Auth::guard('ap')->user()->level=='MANAGER')
      <li class="kt-menu__item  kt-menu__item--{{set_active('ap/potong_pajak')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="{{route('ap.potong_pajak')}}" class="kt-menu__link kt-menu__toggle">
          <i class="kt-menu__link-icon flaticon2-sheet kt-font-success"></i>
          <span class="kt-menu__link-text">Bukti Potong Pajak</span>
        </a>
      </li>
      @else
      <li class="kt-menu__item kt-menu__item--submenu {{ Request::is('ap/data_pembelian_gb*') ? 'kt-menu__item--open' : '' }}{{ Request::is('ap/data_pembelian_pk*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
          <span class="kt-menu__link-icon">
            <i class="flaticon2-document kt-font-info"></i>
          </span>
          <span class="kt-menu__link-text">Data Pembelian</span></span>
          <i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu " kt-hidden-height="200" style="">
          <span class="kt-menu__arrow"></span>
          <ul class="kt-menu__subnav">
            <li class="kt-menu__item  kt-menu__item--{{ set_active('ap/data_pembelian_gb') }}" aria-haspopup="true">
              <a href="{{ route('ap.data_pembelian_gb') }}" class="kt-menu__link">
                <i class="kt-menu__link-icon flaticon2-document kt-font-success"></i>
                <span class="kt-menu__link-text">Gabah Basah</span>
              </a>
            </li>
            <li class="kt-menu__item kt-menu__item--{{set_active('ap/data_pembelian_pk')}} " aria-haspopup="true">
              <a href="{{route('ap.data_pembelian_pk')}}" class="kt-menu__link ">
                <i class="kt-menu__link-icon  flaticon2-document kt-font-warning"></i>
                <span class="kt-menu__link-text">Beras PK</span>
              </a>
            </li>

          </ul>
        </div>
      </li>

      <li class="kt-menu__item kt-menu__item--submenu {{ Request::is('ap/revisi_data_gb*') ? 'kt-menu__item--open' : '' }}{{ Request::is('ap/revisi_data_pk*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
          <span class="kt-menu__link-icon">
            <i class="kt-menu__link-icon  flaticon2-writing kt-font-danger"></i>
          </span>
          <span class="kt-menu__link-text">Data Revisi</span></span>
          <i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu " kt-hidden-height="200" style="">
          <span class="kt-menu__arrow"></span>
          <ul class="kt-menu__subnav">
            <li class="kt-menu__item  kt-menu__item--{{ set_active('ap/revisi_data_gb') }}" aria-haspopup="true">
              <a href="{{ route('ap.revisi_data_gb') }}" class="kt-menu__link">
                <i class="kt-menu__link-icon  flaticon2-writing kt-font-success"></i>
                <span class="kt-menu__link-text">Gabah Basah</span>
              </a>
            </li>
            <li class="kt-menu__item kt-menu__item--{{set_active('ap/revisi_data_pk')}} " aria-haspopup="true">
              <a href="{{route('ap.revisi_data_pk')}}" class="kt-menu__link ">
                <i class="kt-menu__link-icon  flaticon2-writing kt-font-warning"></i>
                <span class="kt-menu__link-text">Beras PK</span>
              </a>
            </li>

          </ul>
        </div>
      </li>
      @endif
      <li class="kt-menu__section kt-menu__section--first">
        <h4 class="kt-menu__section-text">Akun</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
      </li>
      <li class="kt-menu__item kt-menu__item--{{ set_active('ap/account_ap') }} " aria-haspopup="true">
        <a href="{{route('ap.account_ap')}}" class="kt-menu__link ">
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