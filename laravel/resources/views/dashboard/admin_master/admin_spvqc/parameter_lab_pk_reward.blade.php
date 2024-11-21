@extends('dashboard.admin_master.layout.main')
@section('title')
SURYA PANGAN SEMESTA
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    E-PROCUREMENT
                </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        SURYA PANGAN SEMESTA
                    </a>
                    <span class="btn-outline btn-sm btn-info">Site Ngawi</span>
                </div>
            </div>
        </div>
    </div>

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet ">
                <div class="">
                    <!--begin::Accordion-->
                    <div class="accordion  accordion-toggle-arrow" id="accordionExample4">
                        <div class="card">
                            <div class="card-header" id="headingOne4">
                                <div class="card-title" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseOne4">
                                    <i class="flaticon2-add kt-font-info"></i> Tambah Parameter Tabel Reward PK
                                </div>
                            </div>
                            <div id="collapseOne4" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample4">
                                <div class="card-body">
                                    <form class="kt-form" id="formaddreward" action="{{ route('master.parameter_lab_pk_reward_hampa_store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-wizard-v4__form">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="kt-section__body">
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label">Tanggal PO&nbsp;:</label>
                                                                    <div class="col-lg-6 col-xl-6">
                                                                        <input type="date" class="form-control" id="tanggal_po_pk" required name="tanggal_po_pk">
                                                                    </div>
                                                                </div>
                                                                <!--Header-->
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-lg-2 col-form-label"><b>PARAMETER</b></label>
                                                                    <label class="col-sm-3 col-lg-3 col-form-label"><b>VALUE REWARD</b></label>
                                                                    <label class="col-sm-3 col-lg-3 col-form-label"><b>NILAI REWARD</b></label>
                                                                    <label class="col-sn-3 col-lg-3 col-form-label"><b>FORMULA REWARD</b></label>
                                                                </div>
                                                                <!--Kadar Air-->
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label">Kadar Air (KA)&nbsp;:</label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="0%" id="value_ka_pk" required name="value_ka_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="0%" id="nilai_ka_pk" required name="nilai_ka_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="-" required id="formula_ka_pk" name="formula_ka_pk">
                                                                    </div>
                                                                </div>
                                                                <hr style="height: 1px; background-color: #E0E0E0; border: none;">
                                                                <!--Hampa-->
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label">Hampa&nbsp;:</label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="0.75%" id="value_hampa_pk" required name="value_hampa_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="50%" id="nilai_hampa_pk" required name="nilai_hampa_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="-" required id="formula_hampa_pk" name="formula_hampa_pk">
                                                                    </div>
                                                                </div>
                                                                <hr style="height: 1px; background-color: #E0E0E0; border: none;">
                                                                <!--TR-->
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label">TR&nbsp;:</label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="3.60%" id="value_tr_pk" required name="value_tr_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="50%" id="nilai_tr_pk" required name="nilai_tr_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="-" required id="formula_tr_pk" name="formula_tr_pk">
                                                                    </div>
                                                                </div>
                                                                <hr style="height: 1px; background-color: #E0E0E0; border: none;">
                                                                <!--Katul-->
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label">Katul&nbsp;:</label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="13.0%" id="value_katul_pk" required name="value_katul_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="25%" id="nilai_katul_pk" required name="nilai_katul_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="-" required id="formula_katul_pk" name="formula_katul_pk">
                                                                    </div>
                                                                </div>
                                                                <hr style="height: 1px; background-color: #E0E0E0; border: none;">
                                                                <!--Butir Patah-->
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label">Butir Patah&nbsp;:</label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="20.0%" id="value_butirpatah_pk" required name="value_butirpatah_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="10%" id="nilai_butirpatah_pk" required name="nilai_butirpatah_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="-" required id="formula_butirpatah_pk" name="formula_butirpatah_pk">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-form__actions">
                                                    <button id="btn_save" class="btn btn-success m-btn pull-right" style="">Simpan</button>
                                                </div><br>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Accordion-->
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-menu__link-icon flaticon2-graph kt-font-warning"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data Parameter Tabel Reward PK
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item mt-3">
                            <a class="nav-link active" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-database"></i>Kadar Air</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_2"><i class="la la-database"></i>Hampa</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_3"><i class="la la-database"></i>TR</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_4"><i class="la la-database"></i>Katul</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_5"><i class="la la-database"></i>Butir Patah</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
                            <table class="table table-bordered" id="table-parameter-lab-ka">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">value Kadar Air</th>
                                        <th style="text-align: center;width:auto">value Reward</th>
                                        <th style="text-align: center;width:auto">Formula Reward</th>
                                        <th style="text-align: center;width:auto">Tanggal</th>
                                        <th style="text-align: center;width:auto">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane " id="m_tabs_3_2" role="tabpanel">
                            <table class="table table-bordered" id="table-parameter-lab-hampa">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">value Hampa</th>
                                        <th style="text-align: center;width:auto">value Reward</th>
                                        <th style="text-align: center;width:auto">Formula Reward</th>
                                        <th style="text-align: center;width:auto">Tanggal</th>
                                        <th style="text-align: center;width:auto">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane " id="m_tabs_3_3" role="tabpanel">
                            <table class="table table-bordered" id="table-parameter-lab-tr">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">value TR</th>
                                        <th style="text-align: center;width:auto">value Reward</th>
                                        <th style="text-align: center;width:auto">Formula Reward</th>
                                        <th style="text-align: center;width:auto">Tanggal</th>
                                        <th style="text-align: center;width:auto">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane " id="m_tabs_3_4" role="tabpanel">
                            <table class="table table-bordered" id="table-parameter-lab-katul">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">value Katul</th>
                                        <th style="text-align: center;width:auto">value Reward</th>
                                        <th style="text-align: center;width:auto">Formula Reward</th>
                                        <th style="text-align: center;width:auto">Tanggal</th>
                                        <th style="text-align: center;width:auto">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane " id="m_tabs_3_5" role="tabpanel">
                            <table class="table table-bordered" id="table-parameter-lab-butirpatah">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">value Butir Patah</th>
                                        <th style="text-align: center;width:auto">value Reward</th>
                                        <th style="text-align: center;width:auto">Formula Reward</th>
                                        <th style="text-align: center;width:auto">Tanggal</th>
                                        <th style="text-align: center;width:auto">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

            <div class="modal fade" id="modal_edit_ka" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('master.parameter_lab_pk_reward_kadar_air_update') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Parameter PK Reward (Kadar Air)</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id_parameter_lab_pk_reward_kadar_air" id="id_parameter_lab_pk_reward_kadar_air" value="">
                                <div class="form-group">
                                    <div class="">
                                        <label>Value Kadar Air</label>
                                        <input id="value_parameter_lab_pk_reward_kadar_air" required name="value_parameter_lab_pk_reward_kadar_air" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Reward Kadar Air</label>
                                        <input id="reward_parameter_lab_pk_reward_kadar_air" required name="reward_parameter_lab_pk_reward_kadar_air" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Formula Reward</label>
                                        <input id="formula_parameter_lab_pk_reward_kadar_air" required name="formula_parameter_lab_pk_reward_kadar_air" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Tanggal</label>
                                        <input id="tanggal_parameter_lab_pk_reward_kadar_air" required name="tanggal_parameter_lab_pk_reward_kadar_air" placeholder="" type="date" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success m-btn pull-right">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal_edit_hampa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('master.parameter_lab_pk_reward_hampa_update') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Parameter PK Reward (Hampa)</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id_parameter_lab_pk_reward_hampa" id="id_parameter_lab_pk_reward_hampa" value="">
                                <div class="form-group">
                                    <div class="">
                                        <label>Value Hampa</label>
                                        <input id="value_parameter_lab_pk_reward_hampa" required name="value_parameter_lab_pk_reward_hampa" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Reward Hampa</label>
                                        <input id="reward_parameter_lab_pk_reward_hampa" required name="reward_parameter_lab_pk_reward_hampa" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Formula Reward</label>
                                        <input id="formula_parameter_lab_pk_reward_hampa" required name="formula_parameter_lab_pk_reward_hampa" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Tanggal</label>
                                        <input id="tanggal_parameter_lab_pk_reward_hampa" required name="tanggal_parameter_lab_pk_reward_hampa" placeholder="" type="date" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success m-btn pull-right">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal_edit_tr" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('master.parameter_lab_pk_reward_tr_update') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Parameter PK Reward (TR)</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id_parameter_lab_pk_reward_tr" id="id_parameter_lab_pk_reward_tr" value="">
                                <div class="form-group">
                                    <div class="">
                                        <label>Value TR</label>
                                        <input id="value_parameter_lab_pk_reward_tr" required name="value_parameter_lab_pk_reward_tr" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Reward TR</label>
                                        <input id="reward_parameter_lab_pk_reward_tr" required name="reward_parameter_lab_pk_reward_tr" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Formula Reward</label>
                                        <input id="formula_parameter_lab_pk_reward_tr" required name="formula_parameter_lab_pk_reward_tr" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Tanggal</label>
                                        <input id="tanggal_parameter_lab_pk_reward_tr" required name="tanggal_parameter_lab_pk_reward_tr" placeholder="" type="date" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success m-btn pull-right">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal_edit_katul" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('master.parameter_lab_pk_reward_katul_update') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Parameter PK Reward (Katul)</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id_parameter_lab_pk_reward_katul" id="id_parameter_lab_pk_reward_katul" value="">
                                <div class="form-group">
                                    <div class="">
                                        <label>Value Katul</label>
                                        <input id="value_parameter_lab_pk_reward_katul" required name="value_parameter_lab_pk_reward_katul" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Reward Katul</label>
                                        <input id="reward_parameter_lab_pk_reward_katul" required name="reward_parameter_lab_pk_reward_katul" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Formula Reward</label>
                                        <input id="formula_parameter_lab_pk_reward_katul" required name="formula_parameter_lab_pk_reward_katul" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Tanggal</label>
                                        <input id="tanggal_parameter_lab_pk_reward_katul" required name="tanggal_parameter_lab_pk_reward_katul" placeholder="" type="date" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success m-btn pull-right">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal_edit_butirpatah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('master.parameter_lab_pk_reward_butir_patah_update') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Parameter PK Reward (Butir Patah)</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id_parameter_lab_pk_reward_butir_patah" id="id_parameter_lab_pk_reward_butir_patah" value="">
                                <div class="form-group">
                                    <div class="">
                                        <label>Value Hampa</label>
                                        <input id="value_parameter_lab_pk_reward_butir_patah" required name="value_parameter_lab_pk_reward_butir_patah" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Reward Hampa</label>
                                        <input id="reward_parameter_lab_pk_reward_butir_patah" required name="reward_parameter_lab_pk_reward_butir_patah" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Formula Reward</label>
                                        <input id="formula_parameter_lab_pk_reward_butir_patah" required name="formula_parameter_lab_pk_reward_butir_patah" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Tanggal</label>
                                        <input id="tanggal_parameter_lab_pk_reward_butir_patah" required name="tanggal_parameter_lab_pk_reward_butir_patah" placeholder="" type="date" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success m-btn pull-right">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Content -->
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(function() {
        var table = $('#table-parameter-lab-ka').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('master.parameter_lab_pk_reward_kadar_air_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'value_parameter_lab_pk_reward_kadar_air'
                },
                {
                    data: 'reward_parameter_lab_pk_reward_kadar_air'
                },
                {
                    data: 'formula_parameter_lab_pk_reward_kadar_air'
                },
                {
                    data: 'tanggal_parameter_lab_pk_reward_kadar_air'
                },
                {
                    data: 'ckelola'
                }

            ],
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table.columns.adjust().draw().responsive.recalc();
        })
        var table1 = $('#table-parameter-lab-hampa').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('master.parameter_lab_pk_reward_hampa_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'value_parameter_lab_pk_reward_hampa'
                },
                {
                    data: 'reward_parameter_lab_pk_reward_hampa'
                },
                {
                    data: 'formula_parameter_lab_pk_reward_hampa'
                },
                {
                    data: 'tanggal_parameter_lab_pk_reward_hampa'
                },
                {
                    data: 'ckelola'
                }

            ],
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table1.columns.adjust().draw().responsive.recalc();
        })
        var table2 = $('#table-parameter-lab-tr').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('master.parameter_lab_pk_reward_tr_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'value_parameter_lab_pk_reward_tr'
                },
                {
                    data: 'reward_parameter_lab_pk_reward_tr'
                },
                {
                    data: 'formula_parameter_lab_pk_reward_tr'
                },
                {
                    data: 'tanggal_parameter_lab_pk_reward_tr'
                },
                {
                    data: 'ckelola'
                }

            ],
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table2.columns.adjust().draw().responsive.recalc();
        })
        var table3 = $('#table-parameter-lab-katul').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('master.parameter_lab_pk_reward_katul_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'value_parameter_lab_pk_reward_katul'
                },
                {
                    data: 'reward_parameter_lab_pk_reward_katul'
                },
                {
                    data: 'formula_parameter_lab_pk_reward_katul'
                },
                {
                    data: 'tanggal_parameter_lab_pk_reward_katul'
                },
                {
                    data: 'ckelola'
                }

            ],
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table3.columns.adjust().draw().responsive.recalc();
        })
        var table4 = $('#table-parameter-lab-butirpatah').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('master.parameter_lab_pk_reward_butir_patah_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'value_parameter_lab_pk_reward_butir_patah'
                },
                {
                    data: 'reward_parameter_lab_pk_reward_butir_patah'
                },
                {
                    data: 'formula_parameter_lab_pk_reward_butir_patah'
                },
                {
                    data: 'tanggal_parameter_lab_pk_reward_butir_patah'
                },
                {
                    data: 'ckelola'
                }

            ],
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table4.columns.adjust().draw().responsive.recalc();
        })
    });
</script>

<script type="text/javascript">
    $(function() {
        // KA 
        $(document).on('keypress', '#value_ka_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#nilai_ka_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        // Hampa
        $(document).on('keypress', '#value_hampa_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#nilai_hampa_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        // TR
        $(document).on('keypress', '#value_tr_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#nilai_tr_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });

        // KATUL 1
        $(document).on('keypress', '#value_katul_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#nilai_katul_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        // KATUL 2
        $(document).on('keypress', '#value_butirpatah_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#nilai_butirpatah_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });

    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '.to_parameter_ka', function() {
            var id = $(this).attr("name");
            var url = "{{ route('master.parameter_lab_pk_reward_kadar_air_show') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_parameter_lab_pk_reward_kadar_air').val(parsed.id_parameter_lab_pk_reward_kadar_air);
                    $('#value_parameter_lab_pk_reward_kadar_air').val(parsed.value_parameter_lab_pk_reward_kadar_air);
                    $('#reward_parameter_lab_pk_reward_kadar_air').val(parsed.reward_parameter_lab_pk_reward_kadar_air);
                    $('#formula_parameter_lab_pk_reward_kadar_air').val(parsed.formula_parameter_lab_pk_reward_kadar_air);
                    $('#tanggal_parameter_lab_pk_reward_kadar_air').val(parsed.tanggal_parameter_lab_pk_reward_kadar_air);
                }
            });
        });
        $(document).on('click', '.to_parameter_hampa', function() {
            var id = $(this).attr("name");
            var url = "{{ route('master.parameter_lab_pk_reward_hampa_show') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_parameter_lab_pk_reward_hampa').val(parsed.id_parameter_lab_pk_reward_hampa);
                    $('#value_parameter_lab_pk_reward_hampa').val(parsed.value_parameter_lab_pk_reward_hampa);
                    $('#reward_parameter_lab_pk_reward_hampa').val(parsed.reward_parameter_lab_pk_reward_hampa);
                    $('#formula_parameter_lab_pk_reward_hampa').val(parsed.formula_parameter_lab_pk_reward_hampa);
                    $('#tanggal_parameter_lab_pk_reward_hampa').val(parsed.tanggal_parameter_lab_pk_reward_hampa);
                }
            });
        });
        $(document).on('click', '.to_parameter_tr', function() {
            var id = $(this).attr("name");
            var url = "{{ route('master.parameter_lab_pk_reward_tr_show') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_parameter_lab_pk_reward_tr').val(parsed.id_parameter_lab_pk_reward_tr);
                    $('#value_parameter_lab_pk_reward_tr').val(parsed.value_parameter_lab_pk_reward_tr);
                    $('#reward_parameter_lab_pk_reward_tr').val(parsed.reward_parameter_lab_pk_reward_tr);
                    $('#formula_parameter_lab_pk_reward_tr').val(parsed.formula_parameter_lab_pk_reward_tr);
                    $('#tanggal_parameter_lab_pk_reward_tr').val(parsed.tanggal_parameter_lab_pk_reward_tr);
                }
            });
        });
        $(document).on('click', '.to_parameter_katul', function() {
            var id = $(this).attr("name");
            var url = "{{ route('master.parameter_lab_pk_reward_katul_show') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_parameter_lab_pk_reward_katul').val(parsed.id_parameter_lab_pk_reward_katul);
                    $('#value_parameter_lab_pk_reward_katul').val(parsed.value_parameter_lab_pk_reward_katul);
                    $('#reward_parameter_lab_pk_reward_katul').val(parsed.reward_parameter_lab_pk_reward_katul);
                    $('#formula_parameter_lab_pk_reward_katul').val(parsed.formula_parameter_lab_pk_reward_katul);
                    $('#tanggal_parameter_lab_pk_reward_katul').val(parsed.tanggal_parameter_lab_pk_reward_katul);
                }
            });
        });
        $(document).on('click', '.to_parameter_butirpatah', function() {
            var id = $(this).attr("name");
            var url = "{{ route('master.parameter_lab_pk_reward_butir_patah_show') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_parameter_lab_pk_reward_butir_patah').val(parsed.id_parameter_lab_pk_reward_butir_patah);
                    $('#value_parameter_lab_pk_reward_butir_patah').val(parsed.value_parameter_lab_pk_reward_butir_patah);
                    $('#reward_parameter_lab_pk_reward_butir_patah').val(parsed.reward_parameter_lab_pk_reward_butir_patah);
                    $('#formula_parameter_lab_pk_reward_butir_patah').val(parsed.formula_parameter_lab_pk_reward_butir_patah);
                    $('#tanggal_parameter_lab_pk_reward_butir_patah').val(parsed.tanggal_parameter_lab_pk_reward_butir_patah);
                }
            });
        });
    });
</script>

<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });



    $(document).ready(function() {
        $(document).on('click', '#btn_save', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi',
                icon: 'warning',
                text: "Apakah data yang kamu input sudah benar ?",
                showCancelButton: true,
                inputValue: 0,
                confirmButtonText: 'Yes',
            }).then(function(result) {
                if (result.value) {
                    if (
                        $('#tanggal_po_pk').val() == '' ||
                        $('#value_ka_pk').val() == '' ||
                        $('#nilai_ka_pk').val() == '' ||
                        $('#value_tr_pk').val() == '' ||
                        $('#nilai_tr_pk').val() == '' ||
                        $('#value_katul_pk').val() == '' ||
                        $('#nilai_katul_pk').val() == '' ||
                        $('#value_butirpatah_pk').val() == '' ||
                        $('#nilai_butirpatah_pk').val() == ''
                    ) {
                        Swal.fire('Maaf!', 'Data Harus Diisi.', 'warning')
                    } else {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Proses Input Data...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            },
                        });
                        $('#formaddreward').submit();
                    }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $('body').on('click', '#btn_delete_ka', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Kamu tidak dapat mengembalikan data ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{route('master.parameter_lab_pk_reward_kadar_air_destroy')}}/" + id,
                        type: "GET",
                        error: function() {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Gagal Hapus Data.',
                                icon: 'error',
                                timer: 1500
                            })
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: 'Data anda berhasil di hapus.',
                                icon: 'success',
                                timer: 1500
                            })
                            $('#table-parameter-lab-ka').DataTable().ajax.reload();
                        }
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });

        });
        $('body').on('click', '#btn_delete_hampa', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Kamu tidak dapat mengembalikan data ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{route('master.parameter_lab_pk_reward_hampa_destroy')}}/" + id,
                        type: "GET",
                        error: function() {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Gagal Hapus Data.',
                                icon: 'error',
                                timer: 1500
                            })
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: 'Data anda berhasil di hapus.',
                                icon: 'success',
                                timer: 1500
                            })
                            $('#table-parameter-lab-hampa').DataTable().ajax.reload();
                        }
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });

        });
        $('body').on('click', '#btn_delete_tr', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Kamu tidak dapat mengembalikan data ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{route('master.parameter_lab_pk_reward_tr_destroy')}}/" + id,
                        type: "GET",
                        error: function() {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Gagal Hapus Data.',
                                icon: 'error',
                                timer: 1500
                            })
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: 'Data anda berhasil di hapus.',
                                icon: 'success',
                                timer: 1500
                            })
                            $('#table-parameter-lab-tr').DataTable().ajax.reload();
                        }
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });

        });
        $('body').on('click', '#btn_delete_katul', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Kamu tidak dapat mengembalikan data ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{route('master.parameter_lab_pk_reward_katul_destroy')}}/" + id,
                        type: "GET",
                        error: function() {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Gagal Hapus Data.',
                                icon: 'error',
                                timer: 1500
                            })
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: 'Data anda berhasil di hapus.',
                                icon: 'success',
                                timer: 1500
                            })
                            $('#table-parameter-lab-katul').DataTable().ajax.reload();
                        }
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });

        });
        $('body').on('click', '#btn_delete_butirpatah', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Kamu tidak dapat mengembalikan data ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{route('master.parameter_lab_pk_reward_butir_patah_destroy')}}/" + id,
                        type: "GET",
                        error: function() {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Gagal Hapus Data.',
                                icon: 'error',
                                timer: 1500
                            })
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: 'Data anda berhasil di hapus.',
                                icon: 'success',
                                timer: 1500
                            })
                            $('#table-parameter-lab-butirpatah').DataTable().ajax.reload();
                        }
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });

        });
    });


    function custom_toas(type, massage) {
        if (type == 'success') {
            toastr.success(massage, "Sukses", {
                timeOut: 5e3,
                closeButton: !0,
                debug: !1,
                newestOnTop: !0,
                progressBar: !0,
                positionClass: "toast-top-right",
                preventDuplicates: !0,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: !1
            })
        } else if (type == 'erorr') {
            toastr.error(massage, "Erorr", {
                positionClass: "toast-top-right",
                timeOut: 5e3,
                closeButton: !0,
                debug: !1,
                newestOnTop: !0,
                progressBar: !0,
                preventDuplicates: !0,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: !1
            })
        }
    }
</script>
@endsection