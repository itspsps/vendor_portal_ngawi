<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
    <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1">
        <ul class="kt-menu__nav ">
            <li class="kt-menu__section kt-menu__section--first">
                <h4 class="kt-menu__section-text">Dashboard</h4>
                <i class="kt-menu__section-icon flaticon-more-v2"></i>
            </li>
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{route('user.home')}}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon fa fa-home"></i>
                    <span class="kt-menu__link-text">Home</span>
                </a>
            </li>
            {{-- <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon    fa fa-server"></i>
                    <span class="kt-menu__link-text">Product</span>
                </a>
            </li> --}}
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{route('user.transaksi')}}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon fa fa-american-sign-language-interpreting"></i>
                    <span class="kt-menu__link-text">Transaction</span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{route('user.news')}}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon fa fa-book"></i>
                    <span class="kt-menu__link-text">News</span>
                </a>
            </li>
            <li class="kt-menu__section kt-menu__section--first">
                <h4 class="kt-menu__section-text">Config</h4>
                <i class="kt-menu__section-icon flaticon-more-v2"></i>
            </li>
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{route('user.notification')}}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon fa fa-bell"></i>
                    <span class="kt-menu__link-text">Nitification</span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{route('user.account')}}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon fa fa-lock"></i>
                    <span class="kt-menu__link-text">Account</span>
                </a>
            </li>
            <li class="kt-menu__item " aria-haspopup="true">
                <a onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                    class="kt-menu__link ">
                    <i class="kt-menu__link-icon fa flaticon-logout"></i>
                    <span class="kt-menu__link-text">Sign Out</span>
                </a>
                <!--<form  id="logout-form" method="POST" action="{{ route('logout') }}">-->
                <!--    @csrf-->
                <!-- <button type="submit" class="kt-menu__link "> <i class="kt-menu__link-icon fa flaticon-logout"></i><span class="kt-menu__link-text">Sign Out</span></button>-->
                <!--</form>-->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: one;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
</div>
