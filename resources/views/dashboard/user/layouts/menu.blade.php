<nav id="nav_bottom" class="navbar navbar-dark bg-primary-gradient navbar-expand d-md-none d-lg-none d-xl-none fixed-bottom" style="border-radius: 15px 15px 0px 0px !important; box-shadow: 16px 16px 16px 13px #000 !important;">
    <ul class="navbar-nav nav-justified w-100">
        <li class="nav-item">
            <a href="{{route('user.home')}}" id="btn_klik" class="nav-link text-center {{ request()->routeIs('user.new_home') ? 'active':'' }}">
                <i class="bi bi-house-door" style="font-size: 17px;"></i>
                <span class="small d-block">Home</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('user.daftar_lelang')}}" id="btn_klik" class="nav-link text-center {{ request()->routeIs('user.daftar_lelang') ? 'active':'' }} {{ request()->routeIs('user.lelang_detail*') ? 'active':'' }}">
                <i class="bi bi-card-checklist" style="font-size: 17px;"></i>
                <span class="small d-block">Lelang</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('user.transaksi')}}" id="btn_klik" class="nav-link text-center {{ request()->routeIs('user.transaksi') ? 'active':'' }}">
                <i class="bi bi-credit-card" style="font-size: 17px;"></i>
                <span class="small d-block">Transaksi</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('user.history')}}" id="btn_klik" class="nav-link text-center {{ request()->routeIs('user.history') ? 'active':'' }} {{ request()->routeIs('user.data_list_po*') ? 'active':'' }}">
                <i class="bi bi-clock-history" style="font-size: 17px;"></i>

                <span class="small d-block">History</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('user.account')}}" id="btn_klik" class="nav-link text-center {{ request()->routeIs('user.account') ? 'active':'' }} {{ request()->routeIs('user.edit_password*') ? 'active':'' }} {{ request()->routeIs('user.input_otp*') ? 'active':'' }}">
                <i class="bi bi-person" style="font-size: 17px;"></i>
                <span class="small d-block">Akun</span>
            </a>
        </li>

    </ul>
</nav>