<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
    <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1">
        <ul class="kt-menu__nav ">
            <li class="kt-menu__section kt-menu__section--first">
                <h4 class="kt-menu__section-text">Administrator</h4>
                <i class="kt-menu__section-icon flaticon-more-v2"></i>
            </li>
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon fa fa-home"></i>
                    <span class="kt-menu__link-text">Home</span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ route('adm.product') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon    fa fa-server"></i>
                    <span class="kt-menu__link-text">Product</span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ route('adm.transaction') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon fa fa-american-sign-language-interpreting"></i>
                    <span class="kt-menu__link-text">Transaction</span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ route('adm.news') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon fa fa-book"></i>
                    <span class="kt-menu__link-text">News</span>
                </a>
            </li>
            <li class="kt-menu__section kt-menu__section--first">
                <h4 class="kt-menu__section-text">Config</h4>
                <i class="kt-menu__section-icon flaticon-more-v2"></i>
            </li>
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{route('adm.member')}}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon fa fa-user"></i>
                    <span class="kt-menu__link-text">Member</span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{route('adm.notification')}}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon fa fa-bell"></i>
                    <span class="kt-menu__link-text">Nitification</span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{route('adm.account')}}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon fa fa-lock"></i>
                    <span class="kt-menu__link-text">Account</span>
                </a>
            </li>
            <li class="kt-menu__item " aria-haspopup="true">
                <a href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                    class="kt-menu__link ">
                    <i class="kt-menu__link-icon fa flaticon-logout"></i>
                    <span class="kt-menu__link-text">Sign Out</span>
                </a>
            </li>
            <form id="logout-form" action="" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </ul>
    </div>
</div>
