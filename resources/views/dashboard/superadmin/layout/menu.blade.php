<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
	<div class="text-center">
		<a href="{{route('sourching.home')}}">
			<img class="img-responsive" alt="iamgurdeeposahan" src="{{asset('logo_sps_ngawi.png')}}" style="width: 150px;">
		</a>
	</div>
	<div class="btn btn-label-primary col-lg-12">
		<span><b>MENU</b></span>
	</div>
	<div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1">
		<ul class="kt-menu__nav ">
			<li class="kt-menu__item  kt-menu__item--{{set_active('sourching/home')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
				<a href="{{route('sourching.home')}}" class="kt-menu__link kt-menu__toggle">
					<i class="kt-menu__link-icon fa fa-home"></i>
					<span class="kt-menu__link-text">Beranda</span>
				</a>
			</li>
			@if(Auth::guard('sourching')->user()->level=='ADMIN')
			<li class="kt-menu__item  kt-menu__item--{{set_active('sourching/bid')}} kt-menu__item--{{set_active('sourching/list_approve_po/*')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
				<a href="{{ url('sourching/bid') }}" class="kt-menu__link kt-menu__toggle">
					<i class="kt-menu__link-icon   flaticon2-list kt-font-primary"></i>
					<span class="kt-menu__link-text">E-Procurement</span>
				</a>
			</li>
			<li class="kt-menu__item kt-menu__item--submenu {{ Request::is('sourching/data_sourching_deal*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
				<a href="javascript:;" class="kt-menu__link kt-menu__toggle">
					<span class="kt-menu__link-icon">
						<i class="flaticon2-box-1 "></i>
					</span>
					<span class="kt-menu__link-text">Data Sourching</span></span>
					<i class="kt-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="kt-menu__submenu " kt-hidden-height="200" style="">
					<span class="kt-menu__arrow"></span>
					<ul class="kt-menu__subnav">
						<li class="kt-menu__item kt-menu__item--{{set_active('sourching/data_sourching_deal')}} " aria-haspopup="true">
							<a href="{{route('sourching.data_sourching_deal')}}" class="kt-menu__link ">
								<i class="kt-menu__link-icon   flaticon2-box kt-font-success"></i>
								<span class="kt-menu__link-text">Deal</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="kt-menu__item  kt-menu__item--{{set_active('sourching/news')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
				<a href="{{route('sourching.news')}}" class="kt-menu__link kt-menu__toggle">
					<i class="kt-menu__link-icon flaticon2-paper kt-font-info"></i>
					<span class="kt-menu__link-text">Berita</span>
				</a>
			</li>
			<li class="kt-menu__item  kt-menu__item--{{set_active('sourching/populer')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
				<a href="{{route('sourching.populer')}}" class="kt-menu__link kt-menu__toggle">
					<i class="kt-menu__link-icon flaticon2-analytics-2 kt-font-success"></i>
					<span class="kt-menu__link-text">Populer</span>
				</a>
			</li>
			<li class="kt-menu__item  kt-menu__item--{{set_active('sourching/broadcast')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
				<a href="{{route('sourching.broadcast')}}" class="kt-menu__link kt-menu__toggle">
					<i class="kt-menu__link-icon flaticon2-email kt-font-warning"></i>
					<span class="kt-menu__link-text">Pesan Broadcast</span>
				</a>
			</li>
			<!--<li class="kt-menu__item  kt-menu__item--{{set_active('sourching/transaction')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">-->
			<!--             <a href="{{route('sourching.transaction')}}" class="kt-menu__link kt-menu__toggle">-->
			<!--                 <i class="kt-menu__link-icon fas fa-money-bill-alt"></i>-->
			<!--                     <span class="kt-menu__link-text">Transaksi</span>-->
			<!--             </a>-->
			<!--         </li>-->
			@elseif(Auth::guard('sourching')->user()->level=='MANAGER')
			<li class="kt-menu__item  kt-menu__item--{{set_active('sourching/bid')}} kt-menu__item--{{set_active('sourching/bid_response*')}} kt-menu__item--{{set_active('sourching/list_approve_po*')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
				<a href="{{ url('sourching/bid') }}" class="kt-menu__link kt-menu__toggle">
					<i class="kt-menu__link-icon  flaticon2-list kt-font-success"></i>
					<span class="kt-menu__link-text">E-Procurement</span>
				</a>
			</li>
			<li class="kt-menu__item kt-menu__item--submenu {{ Request::is('sourching/data_sourching_onprocess*') ? 'kt-menu__item--open' : '' }} {{ Request::is('sourching/data_sourching_deal*') ? 'kt-menu__item--open' : '' }}{{ Request::is('sourching/data_sourching_nego*') ? 'kt-menu__item--open' : '' }}{{ Request::is('sourching/data_sourching_output_nego*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
				<a href="javascript:void(0);" class="kt-menu__link kt-menu__toggle">
					<span class="kt-menu__link-icon">
						<i class="flaticon2-box-1"></i>
					</span>
					<span class="kt-menu__link-text">Data Sourching</span></span>
					<i class="kt-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="kt-menu__submenu " kt-hidden-height="200" style="">
					<span class="kt-menu__arrow"></span>
					<ul class="kt-menu__subnav">

						<li class="kt-menu__item kt-menu__item--{{set_active('sourching/data_sourching_onprocess')}} " aria-haspopup="true">
							<a href="{{route('sourching.data_sourching_onprocess')}}" class="kt-menu__link ">
								<i class="kt-menu__link-icon  flaticon2-box kt-font-info"></i>
								<span class="kt-menu__link-text">On Process</span>
							</a>
						</li>
						<li class="kt-menu__item kt-menu__item--{{set_active('sourching/data_sourching_deal')}} " aria-haspopup="true">
							<a href="{{route('sourching.data_sourching_deal')}}" class="kt-menu__link ">
								<i class="kt-menu__link-icon  flaticon2-box kt-font-success"></i>
								<span class="kt-menu__link-text">Deal</span>
							</a>
						</li>
						<li class="kt-menu__item kt-menu__item--{{set_active('sourching/data_sourching_nego')}} " aria-haspopup="true">
							<a href="{{route('sourching.data_sourching_nego')}}" class="kt-menu__link ">
								<i class="kt-menu__link-icon   flaticon2-box kt-font-danger"></i>
								<span class="kt-menu__link-text">Nego</span>
							</a>
						</li>
						<li class="kt-menu__item kt-menu__item--{{set_active('sourching/data_sourching_output_nego')}} " aria-haspopup="true">
							<a href="{{route('sourching.data_sourching_output_nego')}}" class="kt-menu__link ">
								<i class="kt-menu__link-icon  flaticon2-box kt-font-warning"></i>
								<span class="kt-menu__link-text">Result Nego</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<!-- <li class="kt-menu__item  kt-menu__item--{{set_active('sourching/tagihan')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
				<a href="{{route('sourching.tagihan')}}" class="kt-menu__link kt-menu__toggle">
					<i class="kt-menu__link-icon flaticon2-sheet kt-font-success"></i>
					<span class="kt-menu__link-text">Tagihan</span>
				</a>
			</li> -->
			<!-- <li class="kt-menu__item  kt-menu__item--{{set_active('sourching/transaction')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
				<a href="{{route('sourching.transaction')}}" class="kt-menu__link kt-menu__toggle">
					<i class="kt-menu__link-icon flaticon2-email kt-font-success"></i>
					<span class="kt-menu__link-text">Transaksi</span>
				</a>
			</li> -->
			@endif


			<li class="kt-menu__item  kt-menu__item--{{set_active('sourching/vendor')}} kt-menu__item--{{set_active('sourching/vendor/detail*')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
				<a href="{{ route('sourching.vendor') }}" class="kt-menu__link kt-menu__toggle">
					<i class="kt-menu__link-icon flaticon2-group kt-font-info"></i>
					<span class="kt-menu__link-text">Data Vendor</span>
				</a>
			</li>
			<li class="kt-menu__item  kt-menu__item--{{set_active('sourching/account')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
				<a href="{{route('sourching.account')}}" class="kt-menu__link kt-menu__toggle">
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
			<li class="kt-menu__item text-center" aria-haspopup="true" data-ktmenu-submenu-toggle="hover" style="bottom: 2%; position: fixed; margin-left: -5px; text-align: center;">
				<div class="kt-menu__link kt-menu__toggle">
					<span class="kt-menu__link-text">
						2023&nbsp;&copy;&nbsp;<a href="https://ngawi.suryapangansemesta.store/sourching/home" target="_blank" class="kt-link">VENDOR PORTAL-NGAWI</a>
					</span>
				</div>
			</li>
		</ul>

	</div>
</div>