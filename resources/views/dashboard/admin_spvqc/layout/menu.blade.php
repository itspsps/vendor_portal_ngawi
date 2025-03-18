<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
    <div class="text-center">
        <a href="{{route('qc.spv.home')}}">
            <img class="img-responsive" alt="iamgurdeeposahan" src="{{asset('logo_sps_ngawi.png')}}" style="width: 150px;">
        </a>
    </div>
    <div class="btn btn-label-primary col-lg-12">
        <span><b>MENU</b></span>
    </div>
    <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1">
        <ul class="kt-menu__nav ">
            <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/home') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="{{ route('qc.spv.home') }}" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-icon fa fa-home"></i>
                    <span class="kt-menu__link-text">Beranda</span>
                </a>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu {{ Request::is('qc/spv/parameter_gb*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/spv/parameter_pk_refraksi*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/spv/parameter_gb*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/spv/parameter_gb*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/spv/parameter_pk_refraksi*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/spv/parameter_lab_pk_reward*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/spv/parameter_lab_pk_kualitas*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
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
                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/spv/parameter_gb*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
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
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/parameter_gb') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('qc.spv.parameter_gb') }}" class="kt-menu__link kt-menu__toggle">
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
                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/spv/parameter_pk*') ? 'kt-menu__item--open' : '' }} " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
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
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/parameter_gk') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{ route('qc.spv.parameter_gk') }}" class="kt-menu__link kt-menu__toggle">
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
                        <li class="kt-menu__item kt-menu__item {{ Request::is('qc/spv/parameter_pk_refraksi*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/spv/parameter_lab_pk_reward*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/spv/parameter_lab_pk_kualitas*') ? 'kt-menu__item--open' : '' }} " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
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
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/parameter_pk_refraksi') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{route('qc.spv.parameter_pk_refraksi')}}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-cardiogram kt-font-warning"></i>
                                            <span class="kt-menu__link-text">Tabel Refraksi</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/parameter_lab_pk_reward') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{route('qc.spv.parameter_lab_pk_reward')}}" class="kt-menu__link kt-menu__toggle">
                                            <i class="kt-menu__link-icon flaticon2-graph kt-font-warning"></i>
                                            <span class="kt-menu__link-text">Tabel Reward</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/parameter_lab_pk_kualitas') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{route('qc.spv.parameter_lab_pk_kualitas')}}" class="kt-menu__link kt-menu__toggle">
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
                        <li class="kt-menu__item kt-menu__item kt-menu__item " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
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
                                    <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/parameter_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                        <a href="{{route('qc.spv.parameter_beras_ds')}}" class="kt-menu__link kt-menu__toggle">
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
            <li class="kt-menu__item kt-menu__item--submenu {{ Request::is('qc/spv/plan_hpp_gabah_kering*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/spv/plan_hpp_pecah_kulit*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/spv/plan_hpp_beras_ds*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/spv/plan_hpp_gabah_basah*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
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
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/plan_hpp_gabah_basah') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.spv.plan_hpp_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                                <span class="kt-menu__link-text">Gabah Basah</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/plan_hpp_gabah_kering') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.spv.plan_hpp_gabah_kering') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-info"></i>
                                <span class="kt-menu__link-text">Gabah Kering</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/plan_hpp_pecah_kulit') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.spv.plan_hpp_pecah_kulit') }}" class="kt-menu__link kt-menu__toggle">
                                <i class=" kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>
                                <span class="kt-menu__link-text">Pecah Kulit</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/plan_hpp_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.spv.plan_hpp_beras_ds') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-danger"></i>
                                <span class="kt-menu__link-text">Beras DS</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu {{ Request::is('qc/spv/harga_atas_gabah_basah*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/spv/harga_atas_gabah_kering*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/spv/harga_atas_pecah_kulit*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/spv/harga_atas_beras_ds*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
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
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/harga_atas_gabah_basah') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.spv.harga_atas_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                                <span class="kt-menu__link-text">Gabah Basah</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/harga_atas_gabah_kering') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.spv.harga_atas_gabah_kering') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-info"></i>
                                <span class="kt-menu__link-text">Gabah Kering</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/harga_atas_pecah_kulit') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.spv.harga_atas_pecah_kulit') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>
                                <span class="kt-menu__link-text">Pecah Kulit</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/harga_atas_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.spv.harga_atas_beras_ds') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-danger"></i>
                                <span class="kt-menu__link-text">Beras DS</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/harga_atas_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.spv.harga_atas_beras_ds') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon fa fa-money-bill-wave"></i>
                                <span class="kt-menu__link-text">Beras DS</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu {{ Request::is('qc/spv/harga_bawah_gabah_basah*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/spv/harga_bawah_gabah_kering*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/spv/harga_bawah_pecah_kulit*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/spv/harga_bawah_beras_ds*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
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
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/harga_bawah_gabah_basah') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.spv.harga_bawah_gabah_basah') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                                <span class="kt-menu__link-text">Gabah Basah</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/harga_bawah_gabah_kering') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="" onclick="return false" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-info"></i>
                                <span class="kt-menu__link-text">Gabah Kering</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/harga_bawah_pecah_kulit') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="}" onclick="return false" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>
                                <span class="kt-menu__link-text">Pecah Kulit</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/harga_bawah_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="" onclick="return false" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-box-1 kt-font-danger"></i>
                                <span class="kt-menu__link-text">Beras DS</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu {{ Request::is('qc/spv/output_lab1_pk*') ? 'kt-menu__item--open' : '' }} {{ Request::is('qc/spv/output_lab1_gb*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-icon">
                        <i class="kt-menu__link-icon flaticon2-hourglass-1 kt-font-info"></i>
                    </span>
                    <span class="kt-menu__link-text">Output&nbsp;Lab&nbsp;Incoming</span></span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/output_lab1_gb') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.spv.output_lab1_gb') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-writing kt-font-success"></i>
                                <span class="kt-menu__link-text">Gabah Basah</span>
                            </a>
                        </li>
                        <!-- <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/plan_hpp_gabah_kering') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.spv.plan_hpp_gabah_kering') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon fa fa-money-check-alt"></i>
                                <span class="kt-menu__link-text">Gabah Kering</span>
                            </a>
                        </li> -->
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/output_lab1_pk') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.spv.output_lab1_pk') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-writing kt-font-warning"></i>
                                <span class="kt-menu__link-text">Pecah Kulit</span>
                            </a>
                        </li>
                        <!-- <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/plan_hpp_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.spv.plan_hpp_beras_ds') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon fa fa-money-check-alt"></i>
                                <span class="kt-menu__link-text">Beras DS</span>
                            </a>
                        </li> -->
                    </ul>
                </div>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu {{ Request::is('qc/spv/output_lab2_gb*') ? 'kt-menu__item--open' : '' }}{{ Request::is('qc/spv/output_lab2_pk*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-icon">
                        <i class="kt-menu__link-icon flaticon2-hourglass-1 kt-font-info"></i>
                    </span>
                    <span class="kt-menu__link-text">Output&nbsp;Lab&nbsp;Bongkaran</span></span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu " kt-hidden-height="200" style="">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/output_lab2_gb') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.spv.output_lab2_gb') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-writing kt-font-success"></i>
                                <span class="kt-menu__link-text">Gabah Basah</span>
                            </a>
                        </li>
                        <!-- <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/plan_hpp_gabah_kering') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.spv.plan_hpp_gabah_kering') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon fa fa-money-check-alt"></i>
                                <span class="kt-menu__link-text">Gabah Kering</span>
                            </a>
                        </li> -->
                        <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/spv/output_lab2_pk') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.spv.output_lab2_pk') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon flaticon2-writing kt-font-warning"></i>
                                <span class="kt-menu__link-text">Pecah Kulit</span>
                            </a>
                        </li>
                        <!-- <li class="kt-menu__item  kt-menu__item--{{ set_active('qc/lab/plan_hpp_beras_ds') }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                            <a href="{{ route('qc.spv.plan_hpp_beras_ds') }}" class="kt-menu__link kt-menu__toggle">
                                <i class="kt-menu__link-icon fa fa-money-check-alt"></i>
                                <span class="kt-menu__link-text">Beras DS</span>
                            </a>
                        </li> -->
                    </ul>
                </div>
            </li>
            <li class="kt-menu__item kt-menu__item--{{ set_active('qc/spv/nego') }} " aria-haspopup="true">
                <a href="{{route('qc.spv.nego')}}" class="kt-menu__link ">
                    <i class="kt-menu__link-icon flaticon2-writing kt-font-warning"></i>
                    <span class="kt-menu__link-text">Nego</span>
                    <span id="count_nego" class="badge badge badge-info" style="position:absolute; margin-left:81%; width: 100%; text-align: left; background-color: #9f187c;">
                       
                    </span>
                </a>
            </li>
            <li class="kt-menu__item kt-menu__item--{{ set_active('qc/spv/revisi_harga') }} " aria-haspopup="true">
                <a href="{{route('qc.spv.revisi_harga')}}" class="kt-menu__link ">
                    <i class="kt-menu__link-icon flaticon2-writing kt-font-danger"></i>
                    <span class="kt-menu__link-text">Revisi Harga</span>
                    <span id="count_revisiharga" class="badge badge badge-info" style="position:absolute; margin-left:81%; width: 100%; text-align: left; background-color: #9f187c;">
                       
                    </span>
                </a>
            </li>
            <li class="kt-menu__item kt-menu__item--{{ set_active('qc/spv/data_surveyor') }} " aria-haspopup="true">
                <a href="{{route('qc.spv.data_surveyor')}}" class="kt-menu__link ">
                    <i class="kt-menu__link-icon flaticon2-group kt-font-info"></i>
                    <span class="kt-menu__link-text">Data Surveyor</span>
                </a>
            </li>

            <li class="kt-menu__item kt-menu__item--{{ set_active('qc/spv/account_spv') }} " aria-haspopup="true">
                <a href="{{route('qc.spv.account_spv')}}" class="kt-menu__link ">
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
                        2023&nbsp;&copy;&nbsp;<a href="https://ngawi.suryapangansemesta.store/qc/spv/home" target="_blank" class="kt-link">VENDOR PORTAL-NGAWI</a>
                    </span>
                </div>
            </li>
        </ul>
    </div>
</div>