<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
    <div class="text-center">
        <a href="{{route('master.home')}}">
            <img class="img-responsive" alt="iamgurdeeposahan" src="{{asset('logo_sps_ngawi.png')}}" style="width: 150px;">
        </a>
    </div>
    <div class="btn btn-label-primary col-lg-12">
        <span><b>MENU</b></span>
    </div>
    <div id="kt_aside_menu" class="kt-aside-menu" data-ktmenu-vertical="1" data-ktmenu-scroll="1">
        <ul class="kt-menu__nav ">
            <li class="kt-menu__item  kt-menu__item--{{set_active('qc/lab/home') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ route('qc.lab.home') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon fa fa-home"></i>
                    <span class="kt-menu__link-text">Beranda</span>
                </a>
            </li>

            @if(Auth::guard('lab')->user()->level=='QC')

            <li class="kt-menu__item kt-menu__item--submenu {{ Request::is('qc/lab/proses_lab1_gabah_basah*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/lab/proses_add_lab1_gabah_basah*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/proses_lab1_gabah_kering*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/proses_lab1_pecah_kulit*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/lab/proses_lab1_beras_ds*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-icon">
                        <i class="flaticon2-hourglass kt-font-primary"></i>
                    </span>
                    <span class="kt-menu__link-text">Proses Lab Incoming</span></span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/proses_lab1_gabah_basah') }} kt-menu__item--{{ set_active('qc/lab/proses_add_lab1_gabah_basah*') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.lab.proses_lab1_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon   flaticon2-laptop kt-font-success"></i>
                                <span class="kt-menu__link-text">Gabah Basah</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/proses_lab1_gabah_kering') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.lab.proses_lab1_gabah_kering') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon    flaticon2-laptop kt-font-info"></i>
                                <span class="kt-menu__link-text">Gabah Kering</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/proses_lab1_pecah_kulit') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.lab.proses_lab1_pecah_kulit') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon    flaticon2-laptop kt-font-warning"></i>
                                <span class="kt-menu__link-text">Pecah Kulit</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/proses_lab1_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.lab.proses_lab1_beras_ds') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon    flaticon2-laptop kt-font-danger"></i>
                                <span class="kt-menu__link-text">Beras DS</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/reject_lab1_gabah_basah*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_edit_proses_lab1_gb*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/reject_lab1_pecah_kulit*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/pending_lab1_gabah_basah*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/pending_lab1_pecah_kulit*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/lab/unload_lab1_gabah_basah*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/unload_lab1_pecah_kulit*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_proses_lab1_gb*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/lab/output_proses_lab1_pk*') ? 'kt-menu__item--open' : '' }} " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-icon">
                        <i class="flaticon2-checking kt-font-success"></i>
                    </span>
                    <span class="kt-menu__link-text">Hasil Lab (Incoming)</span></span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/output_proses_lab1_gb*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_edit_proses_lab1_gb*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/lab/output_proses_lab1_pk*') ? 'kt-menu__item--open' : '' }} " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <span class="kt-menu__link-icon">
                                    <i class="flaticon2-checking kt-font-success"></i>
                                </span>
                                <span class="kt-menu__link-text">Hasil Data</span></span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/output_proses_lab1_gb') }} kt-menu__item--{{ set_active('qc/lab/output_edit_proses_lab1_gb*') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('qc.lab.output_proses_lab1_gb') }}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                                            <span class="kt-menu__link-text">gabah Basah</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item--{{ set_active('qc/lab/output_proses_lab1_pk') }} " aria-haspopup="true">
                                        <a href="{{route('qc.lab.output_proses_lab1_pk')}}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>
                                            <span class="kt-menu__link-text">Beras Pecah Kulit(PK)</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/unload_lab1_gabah_basah*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/unload_lab1_pecah_kulit*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <span class="kt-menu__link-icon">
                                    <i class="flaticon2-checking kt-font-info"></i>
                                </span>
                                <span class="kt-menu__link-text">Bongkar</span></span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/unload_lab1_gabah_basah') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('qc.lab.unload_lab1_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                                            <span class="kt-menu__link-text">gabah Basah</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item--{{ set_active('qc/lab/unload_lab1_pecah_kulit') }} " aria-haspopup="true">
                                        <a href="{{route('qc.lab.unload_lab1_pecah_kulit')}}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>
                                            <span class="kt-menu__link-text">Beras Pecah Kulit(PK)</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/pending_lab1_gabah_basah*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/pending_lab1_pecah_kulit*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <span class="kt-menu__link-icon">
                                    <i class="flaticon2-checking kt-font-warning"></i>
                                </span>
                                <span class="kt-menu__link-text">Pending</span></span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/pending_lab1_gabah_basah') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('qc.lab.pending_lab1_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                                            <span class="kt-menu__link-text">gabah Basah</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item--{{ set_active('qc/lab/pending_lab1_pecah_kulit') }} " aria-haspopup="true">
                                        <a href="{{route('qc.lab.pending_lab1_pecah_kulit')}}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>
                                            <span class="kt-menu__link-text">Beras Pecah Kulit(PK)</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/reject_lab1_gabah_basah*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/reject_lab1_pecah_kulit*') ? 'kt-menu__item--open' : '' }} " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <span class="kt-menu__link-icon">
                                    <i class="flaticon2-checking kt-font-danger"></i>
                                </span>
                                <span class="kt-menu__link-text">Reject</span></span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/reject_lab1_gabah_basah') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('qc.lab.reject_lab1_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                                            <span class="kt-menu__link-text">gabah Basah</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item--{{ set_active('qc/lab/reject_lab1_pecah_kulit') }} " aria-haspopup="true">
                                        <a href="{{route('qc.lab.reject_lab1_pecah_kulit')}}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>
                                            <span class="kt-menu__link-text">Beras Pecah Kulit(PK)</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="kt-menu__item kt-menu__item--submenu {{ Request::is('qc/lab/proses_add_lab2_gabah_basah*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/proses_lab2_beras_ds*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/proses_lab2_pecah_kulit*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/proses_lab2_gabah_basah*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/proses_lab2_gabah_kering*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-icon">
                        <i class="flaticon2-hourglass kt-font-primary"></i>
                    </span>
                    <span class="kt-menu__link-text">Proses&nbsp;Lab&nbsp;Bongkaran</span></span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/proses_lab2_gabah_basah') }} kt-menu__item--{{ set_active('qc/lab/proses_add_lab2_gabah_basah*') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.lab.proses_lab2_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-analytics-2 kt-font-success"></i>
                                <span class="kt-menu__link-text">Gabah Basah</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/proses_lab2_gabah_kering') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:void(0)" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-analytics-2 kt-font-info"></i>
                                <span class="kt-menu__link-text">Gabah Kering</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/proses_lab2_pecah_kulit') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.lab.proses_lab2_pecah_kulit') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-analytics-2 kt-font-warning"></i>
                                <span class="kt-menu__link-text">Pecah Kulit</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/proses_lab2_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:void(0)" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-analytics-2 kt-font-danger"></i>
                                <span class="kt-menu__link-text">Beras DS</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/output_nego_lab2_gb*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_edit_proses_lab2_gb*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_deal_lab2_gb*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_deal_lab2_pk*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_proses_lab2_gb*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_proses_lab2_pk*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-icon">
                        <i class="flaticon2-checking kt-font-success"></i>
                    </span>
                    <span class="kt-menu__link-text">Hasil&nbsp;Lab&nbsp;(Bongkaran)</span></span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/output_proses_lab2_gb*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_edit_proses_lab2_gb*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_proses_lab2_pk*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <span class="kt-menu__link-icon">
                                    <i class="flaticon2-checking kt-font-success"></i>
                                </span>
                                <span class="kt-menu__link-text">Hasil Data</span></span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/output_proses_lab2_gb') }} kt-menu__item--{{ set_active('qc/lab/output_edit_proses_lab2_gb') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('qc.lab.output_proses_lab2_gb') }}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                                            <span class="kt-menu__link-text">Gabah Basah</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item--{{ set_active('qc/lab/output_proses_lab2_pk') }} " aria-haspopup="true">
                                        <a href="{{route('qc.lab.output_proses_lab2_pk')}}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>
                                            <span class="kt-menu__link-text">Pecah Kulit</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/output_deal_lab2_gb*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_deal_lab2_pk*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <span class="kt-menu__link-icon">
                                    <i class="flaticon2-checking kt-font-success"></i>
                                </span>
                                <span class="kt-menu__link-text">Deal</span></span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/output_deal_lab2_gb') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('qc.lab.output_deal_lab2_gb') }}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                                            <span class="kt-menu__link-text">Gabah Basah</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item--{{ set_active('qc/lab/output_deal_lab2_pk') }} " aria-haspopup="true">
                                        <a href="{{route('qc.lab.output_deal_lab2_pk')}}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>
                                            <span class="kt-menu__link-text">Pecah Kulit</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/output_nego_lab2_gb*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <span class="kt-menu__link-icon">
                                    <i class="flaticon2-checking kt-font-warning"></i>
                                </span>
                                <span class="kt-menu__link-text">Nego</span></span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/output_nego_lab2_gb') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('qc.lab.output_nego_lab2_gb') }}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                                            <span class="kt-menu__link-text">Gabah Basah</span>
                                        </a>
                                    </li>
                                    <!--<li class="kt-menu__item kt-menu__item--{{ set_active('qc/lab/output_nego_lab2_pk') }} " aria-haspopup="true">-->
                                    <!--    <a href="{{route('qc.lab.output_nego_lab2_pk')}}" class="kt-menu__link kt-menu__toggle">-->
                                    <!--        <i class="kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>-->
                                    <!--        <span class="kt-menu__link-text">Pecah Kulit</span>-->
                                    <!--    </a>-->
                                    <!--</li>-->
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </li>

            @elseif(Auth::guard('lab')->user()->level=='MANAGER')
            <li class="kt-menu__item kt-menu__item--submenu {{ Request::is('qc/lab/parameter_beras_ds*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/parameter_pk_refraksi*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/parameter_lab_pk_reward*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/lab/parameter_lab_pk_kualitas*') ? 'kt-menu__item--open' : '' }}  {{ Request::is('qc/lab/parameter_gb*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/parameter_gk*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-icon">
                        <i class="flaticon2-analytics-1 kt-font-primary"></i>
                    </span>
                    <span class="kt-menu__link-text">Parameter Lab</span></span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/parameter_gb*') ? 'kt-menu__item--open' : '' }} " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <span class="kt-menu__link-icon">
                                    <i class="flaticon2-box-1 kt-font-success"></i>
                                </span>
                                <span class="kt-menu__link-text">Gabah basah</span></span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/parameter_gb') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('qc.lab.parameter_gb') }}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-list-3 kt-font-success"></i>
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
                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/parameter_gk*') ? 'kt-menu__item--open' : '' }}  " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <span class="kt-menu__link-icon">
                                    <i class="flaticon2-box-1 kt-font-info"></i>
                                </span>
                                <span class="kt-menu__link-text">Gabah Kering</span></span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/parameter_gk') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('qc.lab.parameter_gk') }}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-list-3 kt-font-info"></i>
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
                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/parameter_pk_refraksi*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/parameter_lab_pk_reward*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/lab/parameter_lab_pk_kualitas*') ? 'kt-menu__item--open' : '' }} " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <span class="kt-menu__link-icon">
                                    <i class="flaticon2-box-1 kt-font-warning"></i>
                                </span>
                                <span class="kt-menu__link-text">Pecah Kulit</span></span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/parameter_pk_refraksi') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{route('qc.lab.parameter_pk_refraksi')}}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-cardiogram kt-font-warning"></i>
                                            <span class="kt-menu__link-text">Tabel Refraksi</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/parameter_lab_pk_reward') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{route('qc.lab.parameter_lab_pk_reward')}}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-graph kt-font-warning"></i>
                                            <span class="kt-menu__link-text">Tabel Reward</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/parameter_lab_pk_kualitas') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{route('qc.lab.parameter_lab_pk_kualitas')}}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-analytics-2 kt-font-warning"></i>
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
                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/parameter_beras_ds*') ? 'kt-menu__item--open' : '' }} " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <span class="kt-menu__link-icon">
                                    <i class="flaticon2-box-1 kt-font-danger"></i>
                                </span>
                                <span class="kt-menu__link-text">Beras DS</span></span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/parameter_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{route('qc.lab.parameter_beras_ds')}}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-list-3 kt-font-danger"></i>
                                            <span class="kt-menu__link-text">Parameter Lab</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu {{ Request::is('qc/lab/plan_hpp_gabah_basah*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/lab/plan_hpp_gabah_kering*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/lab/plan_hpp_pecah_kulit*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/plan_hpp_beras_ds*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-icon">
                        <i class="flaticon2-list-1 kt-font-primary"></i>
                    </span>
                    <span class="kt-menu__link-text">PLAN HPP</span></span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/plan_hpp_gabah_basah') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.lab.plan_hpp_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                                <span class="kt-menu__link-text">Gabah Basah</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/plan_hpp_gabah_kering') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.lab.plan_hpp_gabah_kering') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-info"></i>
                                <span class="kt-menu__link-text">Gabah Kering</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/plan_hpp_pecah_kulit') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.lab.plan_hpp_pecah_kulit') }}" class="kt-menu__link kt-menu__toggle">
                                <i class=" kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>
                                <span class="kt-menu__link-text">Pecah Kulit</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/plan_hpp_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.lab.plan_hpp_beras_ds') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-danger"></i>
                                <span class="kt-menu__link-text">Beras DS</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu {{ Request::is('qc/lab/harga_atas_gabah_basah*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/lab/harga_atas_gabah_kering*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/lab/harga_atas_pecah_kulit*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/lab/plan_hpp_gabah_basah*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-icon">
                        <i class="flaticon-notepad kt-font-primary"></i>
                    </span>
                    <span class="kt-menu__link-text">Harga Atas</span></span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/harga_atas_gabah_basah') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.lab.harga_atas_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                                <span class="kt-menu__link-text">Gabah Basah</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/harga_atas_gabah_kering') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.lab.harga_atas_gabah_kering') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-info"></i>
                                <span class="kt-menu__link-text">Gabah Kering</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/harga_atas_pecah_kulit') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.lab.harga_atas_pecah_kulit') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>
                                <span class="kt-menu__link-text">Pecah Kulit</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/harga_atas_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.lab.harga_atas_beras_ds') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-danger"></i>
                                <span class="kt-menu__link-text">Beras DS</span>
                            </a>
                        </li>
                        <!--<li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/harga_atas_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">-->
                        <!--             <a href="{{ route('qc.lab.harga_atas_beras_ds') }}" class="kt-menu__link kt-menu__toggle">-->
                        <!--                 <i class="kt-menu__link-icon fa fa-money-bill-wave"></i>-->
                        <!--                 <span class="kt-menu__link-text">Beras DS</span>-->
                        <!--             </a>-->
                        <!--         </li>-->
                    </ul>
                </div>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu {{ Request::is('qc/lab/harga_bawah_gabah_basah*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-icon">
                        <i class="flaticon-notepad kt-font-primary"></i>
                    </span>
                    <span class="kt-menu__link-text">Harga Bawah</span></span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/harga_bawah_gabah_basah') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.lab.harga_bawah_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                                <span class="kt-menu__link-text">Gabah Basah</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/harga_bawah_gabah_kering') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="" onclick="return false" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-info"></i>
                                <span class="kt-menu__link-text">Gabah Kering</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/harga_bawah_pecah_kulit') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="}" onclick="return false" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>
                                <span class="kt-menu__link-text">Pecah Kulit</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/harga_bawah_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="" onclick="return false" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-danger"></i>
                                <span class="kt-menu__link-text">Beras DS</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/pending_lab1_gabah_basah*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/pending_lab1_pecah_kulit*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/unload_lab1_gabah_basah*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/unload_lab1_pecah_kulit*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_proses_lab1_gb*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_proses_lab1_pk*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/reject_lab1_gabah_basah*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/reject_lab1_pecah_kulit*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-icon">
                        <i class="flaticon2-checking kt-font-success"></i>
                    </span>
                    <span class="kt-menu__link-text">Hasil Lab (Incoming)</span></span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/output_edit_proses_lab1_gb*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_proses_lab1_gb*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_proses_lab1_pk*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <span class="kt-menu__link-icon">
                                    <i class="flaticon2-checking kt-font-success"></i>
                                </span>
                                <span class="kt-menu__link-text">Hasil Data</span></span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/output_proses_lab1_gb') }} kt-menu__item--{{ set_active('qc/lab/output_edit_proses_lab1_gb*') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('qc.lab.output_proses_lab1_gb') }}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                                            <span class="kt-menu__link-text">gabah Basah</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item--{{ set_active('qc/lab/output_proses_lab1_pk') }} " aria-haspopup="true">
                                        <a href="{{route('qc.lab.output_proses_lab1_pk')}}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>
                                            <span class="kt-menu__link-text">Beras Pecah Kulit(PK)</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/unload_lab1_gabah_basah*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/unload_lab1_pecah_kulit*') ? 'kt-menu__item--open' : '' }} " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <span class="kt-menu__link-icon">
                                    <i class="flaticon2-checking kt-font-info"></i>
                                </span>
                                <span class="kt-menu__link-text">Bongkar</span></span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/unload_lab1_gabah_basah') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('qc.lab.unload_lab1_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                                            <span class="kt-menu__link-text">gabah Basah</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item--{{ set_active('qc/lab/unload_lab1_pecah_kulit') }} " aria-haspopup="true">
                                        <a href="{{route('qc.lab.unload_lab1_pecah_kulit')}}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>
                                            <span class="kt-menu__link-text">Beras Pecah Kulit(PK)</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/pending_lab1_gabah_basah*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/pending_lab1_pecah_kulit*') ? 'kt-menu__item--open' : '' }} " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <span class="kt-menu__link-icon">
                                    <i class="flaticon2-checking kt-font-warning"></i>
                                </span>
                                <span class="kt-menu__link-text">Pending</span></span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/pending_lab1_gabah_basah') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('qc.lab.pending_lab1_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                                            <span class="kt-menu__link-text">gabah Basah</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item--{{ set_active('qc/lab/pending_lab1_pecah_kulit') }} " aria-haspopup="true">
                                        <a href="{{route('qc.lab.pending_lab1_pecah_kulit')}}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>
                                            <span class="kt-menu__link-text">Beras Pecah Kulit(PK)</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/reject_lab1_gabah_basah*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/reject_lab1_pecah_kulit*') ? 'kt-menu__item--open' : '' }} " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <span class="kt-menu__link-icon">
                                    <i class="flaticon2-checking kt-font-danger"></i>
                                </span>
                                <span class="kt-menu__link-text">Reject</span></span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/reject_lab1_gabah_basah') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('qc.lab.reject_lab1_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                                            <span class="kt-menu__link-text">gabah Basah</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item--{{ set_active('qc/lab/reject_lab1_pecah_kulit') }} " aria-haspopup="true">
                                        <a href="{{route('qc.lab.reject_lab1_pecah_kulit')}}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>
                                            <span class="kt-menu__link-text">Beras Pecah Kulit(PK)</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/output_deal_lab2_gb*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_deal_lab2_pk*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_nego_lab2_gb*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_nego_lab2_pk*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_proses_lab2_gb*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_proses_lab2_pk*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-icon">
                        <i class="flaticon2-checking kt-font-success"></i>
                    </span>
                    <span class="kt-menu__link-text">Hasil&nbsp;Lab&nbsp;(Bongkaran)</span></span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/output_proses_lab2_gb*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_proses_lab2_pk*') ? 'kt-menu__item--open' : '' }} " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <span class="kt-menu__link-icon">
                                    <i class="flaticon2-checking kt-font-success"></i>
                                </span>
                                <span class="kt-menu__link-text">Hasil Data</span></span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/output_proses_lab2_gb') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('qc.lab.output_proses_lab2_gb') }}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                                            <span class="kt-menu__link-text">Gabah Basah</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item--{{ set_active('qc/lab/output_proses_lab2_pk') }} " aria-haspopup="true">
                                        <a href="{{route('qc.lab.output_proses_lab2_pk')}}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>
                                            <span class="kt-menu__link-text">Pecah Kulit</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/output_deal_lab2_gb*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_deal_lab2_pk*') ? 'kt-menu__item--open' : '' }} " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <span class="kt-menu__link-icon">
                                    <i class="flaticon2-checking kt-font-success"></i>
                                </span>
                                <span class="kt-menu__link-text">Deal</span></span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/output_deal_lab2_gb') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('qc.lab.output_deal_lab2_gb') }}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                                            <span class="kt-menu__link-text">Gabah Basah</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item kt-menu__item--{{ set_active('qc/lab/output_deal_lab2_pk') }} " aria-haspopup="true">
                                        <a href="{{route('qc.lab.output_deal_lab2_pk')}}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>
                                            <span class="kt-menu__link-text">Pecah Kulit</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/lab/output_nego_lab2_gb*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/lab/output_nego_lab2_pk*') ? 'kt-menu__item--open' : '' }} " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                <span class="kt-menu__link-icon">
                                    <i class="flaticon2-checking kt-font-warning"></i>
                                </span>
                                <span class="kt-menu__link-text">Nego</span></span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/output_nego_lab2_gb') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('qc.lab.output_nego_lab2_gb') }}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                                            <span class="kt-menu__link-text">Gabah Basah</span>
                                        </a>
                                    </li>
                                    <!--<li class="kt-menu__item kt-menu__item--{{ set_active('qc/lab/output_nego_lab2_pk') }} " aria-haspopup="true">-->
                                    <!--    <a href="{{route('qc.lab.output_nego_lab2_pk')}}" class="kt-menu__link kt-menu__toggle">-->
                                    <!--        <i class="kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>-->
                                    <!--        <span class="kt-menu__link-text">Pecah Kulit</span>-->
                                    <!--    </a>-->
                                    <!--</li>-->
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/data_bongkar') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ route('qc.lab.data_bongkar') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon flaticon2-open-box kt-font-success"></i>
                    <span class="kt-menu__link-text">Data Bongkar</span>
                    <span id="data_bongkar" class="badge badge badge-info" style="position:absolute; margin-left:75%; width: 100%; text-align: left; background-color: #9f187c;">
                    </span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/data_po') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ route('qc.lab.data_po') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon flaticon2-open-box kt-font-info"></i>
                    <span class="kt-menu__link-text">Data PO</span>
                    </span>
                </a>
            </li>
            <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/data_po_deal') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ route('qc.lab.data_po_deal') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon flaticon2-notepad kt-font-dark"></i>
                    <span class="kt-menu__link-text">Data Surching (DEAL)</span>
                    <span id="data_sourching_deal" class="badge badge badge-info" style="position:absolute; margin-left:75%; width: 100%; text-align: left; background-color: #9f187c;">
                    </span>
                </a>
            </li>
            @endif
            <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/account_lab') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ route('qc.lab.account_lab') }}" class="kt-menu__link kt-menu__toggle">
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
                        2023&nbsp;&copy;&nbsp;<a href="https://ngawi.suryapangansemesta.store/qc/lab/home" target="_blank" class="kt-link">VENDOR PORTAL-NGAWI</a>
                    </span>
                </div>
            </li>
        </ul>
    </div>
</div>