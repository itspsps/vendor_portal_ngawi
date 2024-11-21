<div class="kt-aside-menu-wrmasterper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrmasterper">
  <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1">
    <ul class="kt-menu__nav ">
      <li class="kt-menu__item  kt-menu__item--{{ set_active('master/home') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="{{route('master.home')}}" class="kt-menu__link kt-menu__toggle">
          <i class="kt-menu__link-icon fa fa-home"></i>
          <span class="kt-menu__link-text">Beranda</span>
        </a>
      </li>
      <li class="kt-menu__section kt-menu__section--first">
        <h4 class="kt-menu__section-text">MENU USER</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
      </li>
      <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
          <span class="kt-menu__link-icon">
            <i class="flaticon2-user kt-font-dark"></i>
          </span>
          <span class="kt-menu__link-text">USER SOURCHING</span></span>
          <i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu " kt-hidden-height="200" style="">
          <span class="kt-menu__arrow"></span>
          <ul class="kt-menu__subnav">
            <li class="kt-menu__item  kt-menu__item--{{set_active('master/bid')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="{{ url('master/bid') }}" class="kt-menu__link kt-menu__toggle">
                <i class="kt-menu__link-icon  flaticon2-list kt-font-dark"></i>
                <span class="kt-menu__link-text">E-Procurement</span>
              </a>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <span class="kt-menu__link-icon">
                  <i class="flaticon2-box-1"></i>
                </span>
                <span class="kt-menu__link-text">Data Sourching</span></span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
              </a>
              <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">

                  <li class="kt-menu__item kt-menu__item--{{set_active('master/data_sourching_onprocess')}} " aria-haspopup="true">
                    <a href="{{route('master.data_sourching_onprocess')}}" class="kt-menu__link ">
                      <i class="kt-menu__link-icon  flaticon2-box kt-font-dark"></i>
                      <span class="kt-menu__link-text">On Process</span>
                    </a>
                  </li>
                  <li class="kt-menu__item kt-menu__item--{{set_active('master/data_sourching_deal')}} " aria-haspopup="true">
                    <a href="{{route('master.data_sourching_deal')}}" class="kt-menu__link ">
                      <i class="kt-menu__link-icon  flaticon2-box kt-font-dark"></i>
                      <span class="kt-menu__link-text">Deal</span>
                    </a>
                  </li>
                  <li class="kt-menu__item kt-menu__item--{{set_active('master/data_sourching_nego')}} " aria-haspopup="true">
                    <a href="{{route('master.data_sourching_nego')}}" class="kt-menu__link ">
                      <i class="kt-menu__link-icon   flaticon2-box kt-font-dark"></i>
                      <span class="kt-menu__link-text">Nego</span>
                    </a>
                  </li>
                  <li class="kt-menu__item kt-menu__item--{{set_active('master/data_sourching_output_nego')}} " aria-haspopup="true">
                    <a href="{{route('master.data_sourching_output_nego')}}" class="kt-menu__link ">
                      <i class="kt-menu__link-icon  flaticon2-box kt-font-dark"></i>
                      <span class="kt-menu__link-text">Result Nego</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('master/broadcast')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="{{route('master.broadcast')}}" class="kt-menu__link kt-menu__toggle">
                <i class="kt-menu__link-icon flaticon2-email kt-font-dark"></i>
                <span class="kt-menu__link-text">Pesan Broadcast</span>
              </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('master/vendor')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="{{ route('master.vendor') }}" class="kt-menu__link kt-menu__toggle">
                <i class="kt-menu__link-icon flaticon2-group kt-font-dark"></i>
                <span class="kt-menu__link-text">Data Vendor</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
          <span class="kt-menu__link-icon">
            <i class="flaticon2-user kt-font-dark"></i>
          </span>
          <span class="kt-menu__link-text">USER SECURITY</span></span>
          <i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu " kt-hidden-height="200" style="">
          <span class="kt-menu__arrow"></span>
          <ul class="kt-menu__subnav">
            <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
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
                  <li class="kt-menu__item kt-menu__item--{{set_active('master/gabah_basah')}} " aria-haspopup="true">
                    <a href="{{route('master.gabah_basah')}}" class="kt-menu__link ">
                      <i class="kt-menu__link-icon    fa fa-tasks"></i>
                      <span class="kt-menu__link-text">Gabah Basah</span>
                    </a>
                  </li>
                  <li class="kt-menu__item  kt-menu__item--{{set_active('master/gabah_kering')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.gabah_kering') }}" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon    fa fa-tasks"></i>
                      <span class="kt-menu__link-text">Gabah Kering</span>
                    </a>
                  </li>
                  <li class="kt-menu__item kt-menu__item--{{set_active('master/beras_pk')}} " aria-haspopup="true">
                    <a href="{{route('master.beras_pk')}}" class="kt-menu__link ">
                      <i class="kt-menu__link-icon    fa fa-tasks"></i>
                      <span class="kt-menu__link-text">Beras PK</span>
                    </a>
                  </li>
                  <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
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
                        <li class="kt-menu__item kt-menu__item--{{set_active('master/beras_ds_urgent')}} " aria-haspopup="true">
                          <a href="{{route('master.beras_ds_urgent')}}" class="kt-menu__link ">
                            <i class="kt-menu__link-icon    fa fa-tasks"></i>
                            <span class="kt-menu__link-text">Urgent</span>
                          </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item--{{set_active('master/beras_ds_noturgent')}} " aria-haspopup="true">
                          <a href="{{route('master.beras_ds_noturgent')}}" class="kt-menu__link ">
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
            <li class="kt-menu__item  kt-menu__item--{{set_active('master/data_revisi')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="{{ url('master/data_revisi') }}" class="kt-menu__link kt-menu__toggle" style="position:relative;">
                <i class="kt-menu__link-icon    fa fa-tasks"></i>
                <span class="kt-menu__link-text ">Data&nbsp;Revisi
                </span>
                <span id="count_notif" class="badge badge badge-info" style="position:absolute; margin-left:80%; background-color: #9f187c;">
                  <?php $data = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->where('penerimaan_po.status_penerimaan', '=', 13)
                    ->where('penerimaan_po.analisa', 'revisi')
                    ->where('penerimaan_po.id_adminanalisa', 1)
                    ->where('penerimaan_po.status_analisa', 2)
                    ->where('penerimaan_po.status_revisi', 0)
                    ->orderBy('penerimaan_po.id_penerimaan_po', 'DESC')
                    ->count();
                  echo $data; ?>
                </span>
              </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('master/po_parkir')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="{{url('master/po_parkir')}}" class="kt-menu__link ">
                <i class="kt-menu__link-icon fa fa-calendar-check"></i>
                <span class="kt-menu__link-text">PO Datang
                </span>
                <span id="count_notif" class="badge badge badge-info text-right" style="position:absolute; margin-left:80%; background-color: #9f187c;">
                  <?php $data = DB::table('penerimaan_po')->where('status_penerimaan', '=', 3)->count();
                  echo $data; ?>
                </span>
              </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('master/po_diterima')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="{{ url('master/po_diterima') }}" class="kt-menu__link kt-menu__toggle">
                <i class="kt-menu__link-icon    fa fa-layer-group"></i>
                <span class="kt-menu__link-text">PO Parkir
                </span>
                <span id="count_notif" class="badge badge badge-info" style="position:absolute; margin-left:80%; background-color: #9f187c; ">
                  <?php $data = DB::table('penerimaan_po')
                    ->where('status_penerimaan', '!=', '5')
                    ->where('status_penerimaan', '!=', '16')
                    ->where('status_penerimaan', '!=', '13')
                    ->count();
                  echo $data; ?>
                </span>
              </a>
            </li>

            <li class="kt-menu__item  kt-menu__item--{{set_active('master/po_on_call')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="{{url('master/po_on_call')}}" class="kt-menu__link ">
                <i class="kt-menu__link-icon    fa fa-microphone-alt"></i>
                <span class="kt-menu__link-text">PO On Call
                </span>
                <span id="count_notif" class="badge badge badge-info" style="position:absolute; margin-left:80%; background-color: #9f187c;">
                  <?php $data = DB::table('penerimaan_po')->where('status_penerimaan', 8)->count();
                  echo $data; ?>
                </span>
              </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('master/po_pending')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="{{ url('master/po_pending') }}" class="kt-menu__link kt-menu__toggle">
                <i class="kt-menu__link-icon    fa fa-user-clock"></i>
                <span class="kt-menu__link-text">PO Pending
                </span>
                <span id="count_notif" class="badge badge badge-info" style="position:absolute; margin-left:80%; background-color: #9f187c;">
                  <?php $data = DB::table('lab1_gb')->where('output_lab_gb', '=', 'Pending')->where('status_lab1_gb', 16)->count();
                  echo $data; ?>
                </span>
              </a>
            </li>
            <!--<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">-->
            <!--    <a href="{{ url('master/unloading_location') }}" class="kt-menu__link kt-menu__toggle">-->
            <!--        <i class="kt-menu__link-icon    fa fa-server"></i>-->
            <!--        <span class="kt-menu__link-text">Lokasi Bongkar</span>-->
            <!--    </a>-->
            <!--</li>-->
            <li class="kt-menu__item  kt-menu__item--{{set_active('master/po_bongkar')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="{{url('master/po_bongkar')}}" class="kt-menu__link ">
                <i class="kt-menu__link-icon    fa fa-flag-checkered"></i>
                <span class="kt-menu__link-text">PO Bongkar
                </span>
                <span id="count_notif" class="badge badge badge-info" style="position:absolute; margin-left:80%; background-color: #9f187c;">
                  <?php $data = DB::table('lab1_gb')->where('output_lab_gb', '=', 'Unload')->where('status_lab1_gb', 8)->count();
                  echo $data; ?>
                </span>
              </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('master/po_ditolak')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="{{ url('master/po_ditolak') }}" class="kt-menu__link kt-menu__toggle">
                <i class="kt-menu__link-icon    fa fa-ban"></i>
                <span class="kt-menu__link-text">PO Ditolak
                </span>
                <span id="count_notif" class="badge badge badge-info" style="position:absolute; margin-left:80%; background-color: #9f187c;">
                  <?php $data = DB::table('penerimaan_po')->where('status_penerimaan', 5)->count();
                  echo $data; ?>
                </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
          <span class="kt-menu__link-icon">
            <i class="flaticon2-user kt-font-dark"></i>
          </span>
          <span class="kt-menu__link-text">USER QC LAB</span></span>
          <i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu " kt-hidden-height="200" style="">
          <span class="kt-menu__arrow"></span>
          <ul class="kt-menu__subnav">
            <li class="kt-menu__section kt-menu__section--first">
              <h4 class="kt-menu__section-text">Data Lab</h4>
              <i class="kt-menu__section-icon flaticon-more-v2"></i>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <span class="kt-menu__link-icon">
                  <i class="flaticon2-hourglass kt-font-dark"></i>
                </span>
                <span class="kt-menu__link-text">Proses Lab Incoming</span></span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
              </a>
              <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/proses_lab1_gabah_basah') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.proses_lab1_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon   flaticon2-laptop kt-font-dark"></i>
                      <span class="kt-menu__link-text">Gabah Basah</span>
                    </a>
                  </li>
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/proses_lab1_gabah_kering') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.proses_lab1_gabah_kering') }}" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon    flaticon2-laptop kt-font-dark"></i>
                      <span class="kt-menu__link-text">Gabah Kering</span>
                    </a>
                  </li>
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/proses_lab1_pecah_kulit') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.proses_lab1_pecah_kulit') }}" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon    flaticon2-laptop kt-font-dark"></i>
                      <span class="kt-menu__link-text">Pecah Kulit</span>
                    </a>
                  </li>
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/proses_lab1_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.proses_lab1_beras_ds') }}" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon    flaticon2-laptop kt-font-dark"></i>
                      <span class="kt-menu__link-text">Beras DS</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="kt-menu__item kt-menu__item kt-menu__item " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <span class="kt-menu__link-icon">
                  <i class="flaticon2-checking kt-font-dark"></i>
                </span>
                <span class="kt-menu__link-text">Hasil Lab (Incoming)</span></span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
              </a>
              <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                  <li class="kt-menu__item kt-menu__item kt-menu__item " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                      <span class="kt-menu__link-icon">
                        <i class="flaticon2-checking kt-font-dark"></i>
                      </span>
                      <span class="kt-menu__link-text">Hasil Data</span></span>
                      <i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                      <span class="kt-menu__arrow"></span>
                      <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('master/output_proses_lab1_gb') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                          <a href="{{ route('master.output_proses_lab1_gb') }}" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                            <span class="kt-menu__link-text">gabah Basah</span>
                          </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item--{{ set_active('master/output_proses_lab1_pk') }} " aria-haspopup="true">
                          <a href="{{route('master.output_proses_lab1_pk')}}" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                            <span class="kt-menu__link-text">Beras Pecah Kulit(PK)</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="kt-menu__item kt-menu__item kt-menu__item " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                      <span class="kt-menu__link-icon">
                        <i class="flaticon2-checking kt-font-dark"></i>
                      </span>
                      <span class="kt-menu__link-text">Bongkar</span></span>
                      <i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                      <span class="kt-menu__arrow"></span>
                      <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('master/unload_lab1_gabah_basah') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                          <a href="{{ route('master.unload_lab1_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                            <span class="kt-menu__link-text">gabah Basah</span>
                          </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item--{{ set_active('master/unload_lab1_pecah_kulit') }} " aria-haspopup="true">
                          <a href="{{route('master.unload_lab1_pecah_kulit')}}" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                            <span class="kt-menu__link-text">Beras Pecah Kulit(PK)</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="kt-menu__item kt-menu__item kt-menu__item " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                      <span class="kt-menu__link-icon">
                        <i class="flaticon2-checking kt-font-dark"></i>
                      </span>
                      <span class="kt-menu__link-text">Pending</span></span>
                      <i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                      <span class="kt-menu__arrow"></span>
                      <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('master/pending_lab1_gabah_basah') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                          <a href="{{ route('master.pending_lab1_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                            <span class="kt-menu__link-text">gabah Basah</span>
                          </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item--{{ set_active('master/pending_lab1_pecah_kulit') }} " aria-haspopup="true">
                          <a href="{{route('master.pending_lab1_pecah_kulit')}}" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                            <span class="kt-menu__link-text">Beras Pecah Kulit(PK)</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="kt-menu__item kt-menu__item kt-menu__item " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                      <span class="kt-menu__link-icon">
                        <i class="flaticon2-checking kt-font-dark"></i>
                      </span>
                      <span class="kt-menu__link-text">Reject</span></span>
                      <i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                      <span class="kt-menu__arrow"></span>
                      <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('master/reject_lab1_gabah_basah') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                          <a href="{{ route('master.reject_lab1_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                            <span class="kt-menu__link-text">gabah Basah</span>
                          </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item--{{ set_active('master/reject_lab1_pecah_kulit') }} " aria-haspopup="true">
                          <a href="{{route('master.reject_lab1_pecah_kulit')}}" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                            <span class="kt-menu__link-text">Beras Pecah Kulit(PK)</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </div>
            </li>

            <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <span class="kt-menu__link-icon">
                  <i class="flaticon2-hourglass kt-font-dark"></i>
                </span>
                <span class="kt-menu__link-text">Proses&nbsp;Lab&nbsp;Bongkaran</span></span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
              </a>
              <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/proses_lab2_gabah_basah') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.proses_lab2_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon flaticon2-analytics-2 kt-font-dark"></i>
                      <span class="kt-menu__link-text">Gabah Basah</span>
                    </a>
                  </li>
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/proses_lab2_gabah_kering') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:void(0)" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon flaticon2-analytics-2 kt-font-dark"></i>
                      <span class="kt-menu__link-text">Gabah Kering</span>
                    </a>
                  </li>
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/proses_lab2_pecah_kulit') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.proses_lab2_pecah_kulit') }}" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon flaticon2-analytics-2 kt-font-dark"></i>
                      <span class="kt-menu__link-text">Pecah Kulit</span>
                    </a>
                  </li>
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/proses_lab2_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:void(0)" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon flaticon2-analytics-2 kt-font-dark"></i>
                      <span class="kt-menu__link-text">Beras DS</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="kt-menu__item kt-menu__item kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <span class="kt-menu__link-icon">
                  <i class="flaticon2-checking kt-font-dark"></i>
                </span>
                <span class="kt-menu__link-text">Hasil&nbsp;Lab&nbsp;(Bongkaran)</span></span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
              </a>
              <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                  <li class="kt-menu__item kt-menu__item kt-menu__item " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                      <span class="kt-menu__link-icon">
                        <i class="flaticon2-checking kt-font-dark"></i>
                      </span>
                      <span class="kt-menu__link-text">Hasil Data</span></span>
                      <i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                      <span class="kt-menu__arrow"></span>
                      <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('master/output_proses_lab2_gb') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                          <a href="{{ route('master.output_proses_lab2_gb') }}" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                            <span class="kt-menu__link-text">Gabah Basah</span>
                          </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item--{{ set_active('master/output_proses_lab2_pk') }} " aria-haspopup="true">
                          <a href="{{route('master.output_proses_lab2_pk')}}" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                            <span class="kt-menu__link-text">Pecah Kulit</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>

                  <li class="kt-menu__item kt-menu__item kt-menu__item " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                      <span class="kt-menu__link-icon">
                        <i class="flaticon2-checking kt-font-dark"></i>
                      </span>
                      <span class="kt-menu__link-text">Deal</span></span>
                      <i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                      <span class="kt-menu__arrow"></span>
                      <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('master/output_deal_lab2_gb') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                          <a href="{{ route('master.output_deal_lab2_gb') }}" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                            <span class="kt-menu__link-text">Gabah Basah</span>
                          </a>
                        </li>
                        <li class="kt-menu__item kt-menu__item--{{ set_active('master/output_deal_lab2_pk') }} " aria-haspopup="true">
                          <a href="{{route('master.output_deal_lab2_pk')}}" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                            <span class="kt-menu__link-text">Pecah Kulit</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="kt-menu__item kt-menu__item kt-menu__item " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                      <span class="kt-menu__link-icon">
                        <i class="flaticon2-checking kt-font-dark"></i>
                      </span>
                      <span class="kt-menu__link-text">Nego</span></span>
                      <i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                      <span class="kt-menu__arrow"></span>
                      <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('master/output_nego_lab2_gb') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                          <a href="{{ route('master.output_nego_lab2_gb') }}" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                            <span class="kt-menu__link-text">Gabah Basah</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>

                </ul>
              </div>
            </li>
          </ul>
        </div>
      </li>
      <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
          <span class="kt-menu__link-icon">
            <i class="flaticon2-user kt-font-dark"></i>
          </span>
          <span class="kt-menu__link-text">USER SPV QC LAB</span></span>
          <i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu " kt-hidden-height="200" style="">
          <span class="kt-menu__arrow"></span>
          <ul class="kt-menu__subnav">
            <li class="kt-menu__section kt-menu__section--first">
              <h4 class="kt-menu__section-text">PARAMETER LAB</h4>
              <i class="kt-menu__section-icon flaticon-more-v2"></i>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <span class="kt-menu__link-icon">
                  <i class="flaticon2-analytics-1 kt-font-dark"></i>
                </span>
                <span class="kt-menu__link-text">Parameter Lab</span></span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
              </a>
              <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                  <li class="kt-menu__item kt-menu__item kt-menu__item " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                      <span class="kt-menu__link-icon">
                        <i class="flaticon2-box-1 kt-font-dark"></i>
                      </span>
                      <span class="kt-menu__link-text">Gabah basah</span></span>
                      <i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                      <span class="kt-menu__arrow"></span>
                      <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('master/parameter_gb') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                          <a href="{{ route('master.parameter_gb') }}" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon2-list-3 kt-font-dark"></i>
                            <span class="kt-menu__link-text">Parameter Lab</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                  <li class="kt-menu__item kt-menu__item kt-menu__item " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                      <span class="kt-menu__link-icon">
                        <i class="flaticon2-box-1 kt-font-dark"></i>
                      </span>
                      <span class="kt-menu__link-text">Gabah Kering</span></span>
                      <i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                      <span class="kt-menu__arrow"></span>
                      <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('master/parameter_gk') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                          <a href="{{ route('master.parameter_gk') }}" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon2-list-3 kt-font-dark"></i>
                            <span class="kt-menu__link-text">Parameter Lab</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                  <li class="kt-menu__item kt-menu__item kt-menu__item " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                      <span class="kt-menu__link-icon">
                        <i class="flaticon2-box-1 kt-font-dark"></i>
                      </span>
                      <span class="kt-menu__link-text">Pecah Kulit</span></span>
                      <i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                      <span class="kt-menu__arrow"></span>
                      <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('master/parameter_pk_refraksi') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                          <a href="{{route('master.parameter_pk_refraksi')}}" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon2-cardiogram kt-font-dark"></i>
                            <span class="kt-menu__link-text">Tabel Refraksi</span>
                          </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('master/parameter_lab_pk_reward') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                          <a href="{{route('master.parameter_lab_pk_reward')}}" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon2-graph kt-font-dark"></i>
                            <span class="kt-menu__link-text">Tabel Reward</span>
                          </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('master/parameter_lab_pk_kualitas') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                          <a href="{{route('master.parameter_lab_pk_kualitas')}}" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon2-analytics-2 kt-font-dark"></i>
                            <span class="kt-menu__link-text">Tabel Kualitas</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                  <li class="kt-menu__item kt-menu__item kt-menu__item " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                      <span class="kt-menu__link-icon">
                        <i class="flaticon2-box-1 kt-font-dark"></i>
                      </span>
                      <span class="kt-menu__link-text">Beras DS</span></span>
                      <i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                      <span class="kt-menu__arrow"></span>
                      <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('master/parameter_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                          <a href="{{route('master.parameter_beras_ds')}}" class="kt-menu__link kt-menu__toggle">
                            <i class="kt-menu__link-icon flaticon2-list-3 kt-font-dark"></i>
                            <span class="kt-menu__link-text">Parameter Lab</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </div>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <span class="kt-menu__link-icon">
                  <i class="flaticon2-list-1 kt-font-dark"></i>
                </span>
                <span class="kt-menu__link-text">PLAN HPP</span></span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
              </a>
              <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/plan_hpp_gabah_basah') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.plan_hpp_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                      <span class="kt-menu__link-text">Gabah Basah</span>
                    </a>
                  </li>
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/plan_hpp_gabah_kering') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.plan_hpp_gabah_kering') }}" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                      <span class="kt-menu__link-text">Gabah Kering</span>
                    </a>
                  </li>
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/plan_hpp_pecah_kulit') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.plan_hpp_pecah_kulit') }}" class="kt-menu__link kt-menu__toggle">
                      <i class=" kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                      <span class="kt-menu__link-text">Pecah Kulit</span>
                    </a>
                  </li>
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/plan_hpp_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.plan_hpp_beras_ds') }}" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                      <span class="kt-menu__link-text">Beras DS</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <span class="kt-menu__link-icon">
                  <i class="flaticon-notepad kt-font-dark"></i>
                </span>
                <span class="kt-menu__link-text">Harga Atas</span></span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
              </a>
              <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/harga_atas_gabah_basah') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.harga_atas_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                      <span class="kt-menu__link-text">Gabah Basah</span>
                    </a>
                  </li>
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/harga_atas_gabah_kering') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.harga_atas_gabah_kering') }}" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                      <span class="kt-menu__link-text">Gabah Kering</span>
                    </a>
                  </li>
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/harga_atas_pecah_kulit') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.harga_atas_pecah_kulit') }}" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                      <span class="kt-menu__link-text">Pecah Kulit</span>
                    </a>
                  </li>
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/harga_atas_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.harga_atas_beras_ds') }}" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                      <span class="kt-menu__link-text">Beras DS</span>
                    </a>
                  </li>
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/harga_atas_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.harga_atas_beras_ds') }}" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon fa fa-money-bill-wave"></i>
                      <span class="kt-menu__link-text">Beras DS</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <span class="kt-menu__link-icon">
                  <i class="flaticon-notepad kt-font-dark"></i>
                </span>
                <span class="kt-menu__link-text">Harga Bawah</span></span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
              </a>
              <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/harga_bawah_gabah_basah') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.harga_bawah_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                      <span class="kt-menu__link-text">Gabah Basah</span>
                    </a>
                  </li>
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/harga_bawah_gabah_kering') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="" onclick="return false" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                      <span class="kt-menu__link-text">Gabah Kering</span>
                    </a>
                  </li>
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/harga_bawah_pecah_kulit') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="}" onclick="return false" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                      <span class="kt-menu__link-text">Pecah Kulit</span>
                    </a>
                  </li>
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/harga_bawah_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="" onclick="return false" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon flaticon2-box-1 kt-font-dark"></i>
                      <span class="kt-menu__link-text">Beras DS</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="kt-menu__section kt-menu__section--first">
              <h4 class="kt-menu__section-text">DATA LAB</h4>
              <i class="kt-menu__section-icon flaticon-more-v2"></i>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <span class="kt-menu__link-icon">
                  <i class="kt-menu__link-icon flaticon2-hourglass-1 kt-font-dark"></i>
                </span>
                <span class="kt-menu__link-text">Output&nbsp;Lab&nbsp;Incoming</span></span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
              </a>
              <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/output_lab1_gb') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.output_lab1_gb') }}" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon flaticon2-writing kt-font-dark"></i>
                      <span class="kt-menu__link-text">Gabah Basah</span>
                    </a>
                  </li>
                  <!-- <li class="kt-menu__item  kt-menu__item--{{ set_active('master/plan_hpp_gabah_kering') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('master.plan_hpp_gabah_kering') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon fa fa-money-check-alt"></i>
                                <span class="kt-menu__link-text">Gabah Kering</span>
                            </a>
                        </li> -->
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/output_lab1_pk') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.output_lab1_pk') }}" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon flaticon2-writing kt-font-dark"></i>
                      <span class="kt-menu__link-text">Pecah Kulit</span>
                    </a>
                  </li>
                  <!-- <li class="kt-menu__item  kt-menu__item--{{ set_active('master/plan_hpp_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('master.plan_hpp_beras_ds') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon fa fa-money-check-alt"></i>
                                <span class="kt-menu__link-text">Beras DS</span>
                            </a>
                        </li> -->
                </ul>
              </div>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <span class="kt-menu__link-icon">
                  <i class="kt-menu__link-icon flaticon2-hourglass-1 kt-font-dark"></i>
                </span>
                <span class="kt-menu__link-text">Output&nbsp;Lab&nbsp;Bongkaran</span></span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
              </a>
              <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/output_lab2_gb') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.output_lab2_gb') }}" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon flaticon2-writing kt-font-dark"></i>
                      <span class="kt-menu__link-text">Gabah Basah</span>
                    </a>
                  </li>
                  <!-- <li class="kt-menu__item  kt-menu__item--{{ set_active('master/plan_hpp_gabah_kering') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('master.plan_hpp_gabah_kering') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon fa fa-money-check-alt"></i>
                                <span class="kt-menu__link-text">Gabah Kering</span>
                            </a>
                        </li> -->
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/output_lab2_pk') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="{{ route('master.output_lab2_pk') }}" class="kt-menu__link kt-menu__toggle">
                      <i class="kt-menu__link-icon flaticon2-writing kt-font-dark"></i>
                      <span class="kt-menu__link-text">Pecah Kulit</span>
                    </a>
                  </li>
                  <!-- <li class="kt-menu__item  kt-menu__item--{{ set_active('master/plan_hpp_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('master.plan_hpp_beras_ds') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon fa fa-money-check-alt"></i>
                                <span class="kt-menu__link-text">Beras DS</span>
                            </a>
                        </li> -->
                </ul>
              </div>
            </li>
            <li class="kt-menu__section kt-menu__section--first">
              <h4 class="kt-menu__section-text">Menu Nego</h4>
              <i class="kt-menu__section-icon flaticon-more-v2"></i>
            </li>
            <li class="kt-menu__item kt-menu__item--{{ set_active('master/nego') }} " aria-haspopup="true">
              <a href="{{route('master.nego')}}" class="kt-menu__link ">
                <i class="kt-menu__link-icon flaticon2-writing kt-font-dark"></i>
                <span class="kt-menu__link-text">Nego</span>
              </a>
            </li>
            <li class="kt-menu__section kt-menu__section--first">
              <h4 class="kt-menu__section-text">Menu Revisi</h4>
              <i class="kt-menu__section-icon flaticon-more-v2"></i>
            </li>
            <li class="kt-menu__item kt-menu__item--{{ set_active('master/revisi_harga') }} " aria-haspopup="true">
              <a href="{{route('master.revisi_harga')}}" class="kt-menu__link ">
                <i class="kt-menu__link-icon flaticon2-writing kt-font-dark"></i>
                <span class="kt-menu__link-text">Revisi Harga</span>
              </a>
            </li>
            <li class="kt-menu__section kt-menu__section--first">
              <h4 class="kt-menu__section-text">Menu Surveyor</h4>
              <i class="kt-menu__section-icon flaticon-more-v2"></i>
            </li>
            <li class="kt-menu__item kt-menu__item--{{ set_active('master/data_surveyor') }} " aria-haspopup="true">
              <a href="{{route('master.data_surveyor')}}" class="kt-menu__link ">
                <i class="kt-menu__link-icon flaticon2-group kt-font-dark"></i>
                <span class="kt-menu__link-text">Data Surveyor</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
          <span class="kt-menu__link-icon">
            <i class="flaticon2-user kt-font-dark"></i>
          </span>
          <span class="kt-menu__link-text">USER QC BONGKAR</span></span>
          <i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu " kt-hidden-height="200" style="">
          <span class="kt-menu__arrow"></span>
          <ul class="kt-menu__subnav">
            <li class="kt-menu__item  kt-menu__item--{{ set_active('master/data_antrian_bongkar') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="{{ route('master.data_antrian_bongkar') }}" class="kt-menu__link kt-menu__toggle">
                <i class="kt-menu__link-icon flaticon2-delivery-truck kt-font-dark"></i>

                <span class="kt-menu__link-text">Data Antrian
                </span>
                <span id="count_antrian" class="badge badge badge-info" style="position:absolute; margin-left:70%; margin-top:5px; width: 100%; text-align: left; background-color: #9f187c;">

                </span>
              </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{ set_active('master/antrian_bongkar') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="{{ route('master.antrian_bongkar') }}" class="kt-menu__link kt-menu__toggle">
                <i class="kt-menu__link-icon flaticon2-open-box kt-font-dark"></i>
                <span class="kt-menu__link-text">Proses Bongkar</span>
                <span id="proses_bongkar" class="badge badge badge-info" style="position:absolute; margin-left:70%; margin-top:5px; width: 100%; text-align: left; background-color: #9f187c;">

                </span>
              </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{ set_active('master/data_bongkar') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="{{ route('master.data_bongkar') }}" class="kt-menu__link kt-menu__toggle">
                <i class="kt-menu__link-icon flaticon2-open-box kt-font-dark"></i>
                <span class="kt-menu__link-text">Data Bongkar</span>
                <span id="data_bongkar" class="badge badge badge-info" style="position:absolute; margin-left:70%; margin-top:5px; width: 100%; text-align: left; background-color: #9f187c;">
                </span>
              </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{ set_active('master/data_revisi_gb') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="{{ route('master.data_revisi_gb') }}" class="kt-menu__link kt-menu__toggle">
                <i class="kt-menu__link-icon flaticon2-sheet kt-font-dark"></i>
                <span class="kt-menu__link-text">Data Revisi</span>
                <span id="revisi_bongkar" class="badge badge badge-info" style="position:absolute; margin-left:70%; margin-top:5px; width: 50%; text-align: left; background-color: #9f187c;">
                </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
          <span class="kt-menu__link-icon">
            <i class="flaticon2-user kt-font-dark"></i>
          </span>
          <span class="kt-menu__link-text">USER TIMBANGAN</span></span>
          <i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu " kt-hidden-height="200" style="">
          <span class="kt-menu__arrow"></span>
          <ul class="kt-menu__subnav">
            <li class="kt-menu__section kt-menu__section--first">
              <h4 class="kt-menu__section-text">Timbangan Masuk</h4>
              <i class="kt-menu__section-icon flaticon-more-v2"></i>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('master/timbangan_awal')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="{{ url('master/timbangan_awal') }}" class="kt-menu__link kt-menu__toggle">
                <i class="kt-menu__link-icon  flaticon2-checking kt-font-dark"></i>
                <span class="kt-menu__link-text">Timbangan Masuk</span>
                <span id="count_tonaseawal" class="badge badge badge-info" style="position:absolute; margin-left:75%; margin-top:5px; width: 100%; text-align: left;  background-color: #9f187c;">
                </span>
              </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('master/data_timbangan_awal')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="{{ url('master/data_timbangan_awal') }}" class="kt-menu__link kt-menu__toggle">
                <i class="kt-menu__link-icon    flaticon2-checking kt-font-dark"></i>
                <span class="kt-menu__link-text">Data Timbangan Masuk</span>
                <span id="count_datatonaseawal" class="badge badge badge-info" style="position:absolute; margin-left:75%; margin-top:5px; width: 100%; text-align: left;  background-color: #9f187c;">
                </span>
              </a>
            </li>
            <li class="kt-menu__section kt-menu__section--first">
              <h4 class="kt-menu__section-text">Timbangan Keluar</h4>
              <i class="kt-menu__section-icon flaticon-more-v2"></i>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('master/timbangan_akhir')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="{{ url('master/timbangan_akhir') }}" class="kt-menu__link kt-menu__toggle">
                <i class="kt-menu__link-icon     flaticon2-checking kt-font-dark"></i>
                <span class="kt-menu__link-text">Timbangan Keluar</span>
                <span id="count_tonaseakhir" class="badge badge badge-info" style="position:absolute; margin-left:75%; margin-top:5px;  width: 100%; text-align: left; background-color: #9f187c;">
                </span>
              </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('master/data_timbangan_akhir')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="{{ url('master/data_timbangan_akhir') }}" class="kt-menu__link kt-menu__toggle">
                <i class="kt-menu__link-icon    flaticon2-checking kt-font-dark"></i>
                <span class="kt-menu__link-text">Data Timbangan Keluar</span>
                <span id="count_datatonaseakhir" class="badge badge badge-info" style="position:absolute; margin-left:75%; margin-top:5px; width: 100%; text-align: left; background-color: #9f187c;">
                </span>
              </a>
            </li>
            <li class="kt-menu__section kt-menu__section--first">
              <h4 class="kt-menu__section-text">Data Revisi</h4>
              <i class="kt-menu__section-icon flaticon-more-v2"></i>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{set_active('master/data_revisi_timbangan')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="{{ url('master/data_revisi_timbangan') }}" class="kt-menu__link kt-menu__toggle">
                <i class="kt-menu__link-icon   flaticon2-checking kt-font-dark"></i>
                <span class="kt-menu__link-text">Data Revisi</span>
                <span id="count_revisitonase" class="badge badge badge-info" style="position:absolute; margin-left:75%; margin-top:5px; width: 100%; text-align: left; background-color: #9f187c;">
                </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
          <span class="kt-menu__link-icon">
            <i class="flaticon2-user kt-font-dark"></i>
          </span>
          <span class="kt-menu__link-text">USER AP</span></span>
          <i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu " kt-hidden-height="200" style="">
          <span class="kt-menu__arrow"></span>
          <ul class="kt-menu__subnav">
            <li class="kt-menu__item  kt-menu__item--{{set_active('master/potong_pajak')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="{{route('master.potong_pajak')}}" class="kt-menu__link kt-menu__toggle">
                <i class="kt-menu__link-icon flaticon2-sheet kt-font-dark"></i>
                <span class="kt-menu__link-text">Bukti Potong Pajak</span>
              </a>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <span class="kt-menu__link-icon">
                  <i class="flaticon2-document kt-font-dark"></i>
                </span>
                <span class="kt-menu__link-text">Data Pembelian</span></span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                <span id="data_pembelian" class="badge badge badge-info" style="position:absolute; margin-left:65%; margin-top: 3%; width: 100%; text-align: left; background-color: #9f187c;">
              </a>
              <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/data_pembelian_gb') }}" aria-haspopup="true">
                    <a href="{{ route('master.data_pembelian_gb') }}" class="kt-menu__link">
                      <i class="kt-menu__link-icon flaticon2-document kt-font-dark"></i>
                      <span class="kt-menu__link-text">Gabah Basah</span>
                    </a>
                  </li>
                  <li class="kt-menu__item kt-menu__item--{{set_active('master/data_pembelian_pk')}} " aria-haspopup="true">
                    <a href="{{route('master.data_pembelian_pk')}}" class="kt-menu__link ">
                      <i class="kt-menu__link-icon  flaticon2-document kt-font-dark"></i>
                      <span class="kt-menu__link-text">Beras PK</span>
                    </a>
                  </li>

                </ul>
              </div>
            </li>

            <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <span class="kt-menu__link-icon">
                  <i class="kt-menu__link-icon  flaticon2-writing kt-font-dark"></i>
                </span>
                <span class="kt-menu__link-text">Data Revisi</span></span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                <span id="data_revisiap" class="badge badge badge-info" style="position:absolute; margin-left:65%; margin-top: 3%; width: 100%; text-align: left; background-color: #9f187c;">
              </a>
              <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/revisi_data_gb') }}" aria-haspopup="true">
                    <a href="{{ route('master.revisi_data_gb') }}" class="kt-menu__link">
                      <i class="kt-menu__link-icon  flaticon2-writing kt-font-dark"></i>
                      <span class="kt-menu__link-text">Gabah Basah</span>
                    </a>
                  </li>
                  <li class="kt-menu__item kt-menu__item--{{set_active('master/revisi_data_pk')}} " aria-haspopup="true">
                    <a href="{{route('master.revisi_data_pk')}}" class="kt-menu__link ">
                      <i class="kt-menu__link-icon  flaticon2-writing kt-font-dark"></i>
                      <span class="kt-menu__link-text">Beras PK</span>
                    </a>
                  </li>

                </ul>
              </div>
            </li>
          </ul>
        </div>
      </li>
      <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
          <span class="kt-menu__link-icon">
            <i class="flaticon2-user kt-font-dark"></i>
          </span>
          <span class="kt-menu__link-text">USER SPV AP</span></span>
          <i class="kt-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu " kt-hidden-height="200" style="">
          <span class="kt-menu__arrow"></span>
          <ul class="kt-menu__subnav">
            <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <span class="kt-menu__link-icon">
                  <i class="flaticon2-notepad kt-font-dark"></i>
                </span>
                <span class="kt-menu__link-text">Approve Data Revisi</span></span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                <span id="data_approverevisi" class="badge badge badge-info" style="position:absolute; margin-left:70%; margin-top: 3%; width: 100%; text-align: left; background-color: #9f187c;">
              </a>
              <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">

                  <li class="kt-menu__item kt-menu__item--{{set_active('master/revisi_data_gb')}} " aria-haspopup="true">
                    <a href="{{route('master.revisi_data_gb')}}" class="kt-menu__link ">
                      <i class="kt-menu__link-icon    flaticon2-checkmark kt-font-dark"></i>
                      <span class="kt-menu__link-text">Data Revisi Gabah Basah</span>
                    </a>
                  </li>
                  <li class="kt-menu__item kt-menu__item--{{set_active('master/revisi_data_pk')}} " aria-haspopup="true">
                    <a href="{{route('master.revisi_data_pk')}}" class="kt-menu__link ">
                      <i class="kt-menu__link-icon    flaticon2-checkmark kt-font-dark"></i>
                      <span class="kt-menu__link-text">Data Revisi PK</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu kt-menu__item" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
              <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                <span class="kt-menu__link-icon">
                  <i class="flaticon2-paper kt-font-dark"></i>
                </span>
                <span class="kt-menu__link-text">Approve Data Pembelian</span></span>
                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                <span id="data_approvespvap" class="badge badge badge-info" style="position:absolute; margin-left:70%; margin-top: 3%; width: 100%; text-align: left; background-color: #9f187c;">

              </a>
              <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                <span class="kt-menu__arrow"></span>
                <ul class="kt-menu__subnav">
                  <li class="kt-menu__item  kt-menu__item--{{ set_active('master/integrasi_epicor_gb') }}" aria-haspopup="true">
                    <a href="{{ route('master.integrasi_epicor_gb') }}" class="kt-menu__link">
                      <i class="kt-menu__link-icon   flaticon2-checking kt-font-dark"></i>
                      <span class="kt-menu__link-text">Gabah Basah</span>
                    </a>
                  </li>
                  <li class="kt-menu__item kt-menu__item--{{set_active('master/integrasi_epicor_pk')}} " aria-haspopup="true">
                    <a href="{{route('master.integrasi_epicor_pk')}}" class="kt-menu__link ">
                      <i class="kt-menu__link-icon    flaticon2-checking kt-font-dark"></i>
                      <span class="kt-menu__link-text">Beras PK</span>
                    </a>
                  </li>

                </ul>
              </div>
            </li>
          </ul>
        </div>
      </li>
      <li class="kt-menu__section kt-menu__section--first">
        <h4 class="kt-menu__section-text">LOG ACTIVITY</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
      </li>
      <li class="kt-menu__item  kt-menu__item--{{set_active('master/log_activity_sourching')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="{{route('master.log_activity_sourching')}}" class="kt-menu__link kt-menu__toggle">
          <i class="kt-menu__link-icon flaticon2-notepad kt-font-dark"></i>
          <span class="kt-menu__link-text">LOG ACTIVITY ADMIN SOURCHING</span>
        </a>
      </li>
      <li class="kt-menu__item  kt-menu__item--{{set_active('master/log_activity_security')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="{{route('master.log_activity_security')}}" class="kt-menu__link kt-menu__toggle">
          <i class="kt-menu__link-icon flaticon2-notepad kt-font-dark"></i>
          <span class="kt-menu__link-text">LOG ACTIVITY ADMIN SECURITY</span>
        </a>
      </li>
      <li class="kt-menu__item  kt-menu__item--{{set_active('master/log_activity_qc')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="{{route('master.log_activity_qc')}}" class="kt-menu__link kt-menu__toggle">
          <i class="kt-menu__link-icon flaticon2-notepad kt-font-dark"></i>
          <span class="kt-menu__link-text">LOG ACTIVITY ADMIN LAB</span>
        </a>
      </li>
      <li class="kt-menu__item  kt-menu__item--{{set_active('master/log_activity_spvqc')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="{{route('master.log_activity_spvqc')}}" class="kt-menu__link kt-menu__toggle">
          <i class="kt-menu__link-icon flaticon2-notepad kt-font-dark"></i>
          <span class="kt-menu__link-text">LOG ACTIVITY ADMIN SPV QC</span>
        </a>
      </li>
      <li class="kt-menu__item  kt-menu__item--{{set_active('master/log_activity_qc_bongkar')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="{{route('master.log_activity_qc_bongkar')}}" class="kt-menu__link kt-menu__toggle">
          <i class="kt-menu__link-icon flaticon2-notepad kt-font-dark"></i>
          <span class="kt-menu__link-text">LOG ACTIVITY ADMIN BONGKAR</span>
        </a>
      </li>
      <li class="kt-menu__item  kt-menu__item--{{set_active('master/log_activity_timbangan')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="{{route('master.log_activity_timbangan')}}" class="kt-menu__link kt-menu__toggle">
          <i class="kt-menu__link-icon flaticon2-notepad kt-font-dark"></i>
          <span class="kt-menu__link-text">LOG ACTIVITY ADMIN TIMBANGAN</span>
        </a>
      </li>
      <li class="kt-menu__item  kt-menu__item--{{set_active('master/log_activity_ap')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="{{route('master.log_activity_ap')}}" class="kt-menu__link kt-menu__toggle">
          <i class="kt-menu__link-icon flaticon2-notepad kt-font-dark"></i>
          <span class="kt-menu__link-text">LOG ACTIVITY ADMIN AP</span>
        </a>
      </li>
      <li class="kt-menu__item  kt-menu__item--{{set_active('master/log_activity_spvap')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="{{route('master.log_activity_spvap')}}" class="kt-menu__link kt-menu__toggle">
          <i class="kt-menu__link-icon flaticon2-notepad kt-font-dark"></i>
          <span class="kt-menu__link-text">LOG ACTIVITY ADMIN SPV AP</span>
        </a>
      </li>
      <li class="kt-menu__item  kt-menu__item--{{set_active('master/log_activity_user')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="{{route('master.log_activity_user')}}" class="kt-menu__link kt-menu__toggle">
          <i class="kt-menu__link-icon flaticon2-notepad kt-font-dark"></i>
          <span class="kt-menu__link-text">LOG ACTIVITY SUPPLIER</span>
        </a>
      </li>
      <li class="kt-menu__section kt-menu__section--first">
        <h4 class="kt-menu__section-text">TRACKER PO</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
      </li>
      <li class="kt-menu__item  kt-menu__item--{{set_active('master/tracker_po')}}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
        <a href="{{route('master.tracker_po')}}" class="kt-menu__link kt-menu__toggle">
          <i class="kt-menu__link-icon flaticon2-sheet kt-font-dark"></i>
          <span class="kt-menu__link-text">TRACKER PO</span>
        </a>
      </li>
      <li class="kt-menu__section kt-menu__section--first">
        <h4 class="kt-menu__section-text">Akun</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
      </li>
      <li class="kt-menu__item " aria-haspopup="true">
        <a href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="kt-menu__link ">
          <i class="kt-menu__link-icon fa flaticon-logout kt-font-dark"></i>
          <span class="kt-menu__link-text">Sign Out</span>
        </a>
      </li>
      <form id="logout-form" action="" method="POST" style="display: none;">
        {{ csrf_field() }}
      </form>
    </ul>
  </div>
</div>