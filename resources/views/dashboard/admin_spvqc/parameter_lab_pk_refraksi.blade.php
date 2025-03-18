@extends('dashboard.admin_spvqc.layout.main')
@section('title')
SURYA PANGAN SEMESTA
@endsection
@section('content')
@include('sweetalert::alert')
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

                    <!-- <div class="accordion  accordion-toggle-arrow" id="accordionExample4">
                        <div class="card">
                            <div class="card-header" id="headingOne4">
                                <div class="card-title" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseOne4">
                                    <i class="flaticon2-add kt-font-info"></i> Tambah Parameter Tabel Refraksi PK
                                </div>
                            </div>
                            <div id="collapseOne4" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample4">
                                <div class="card-body">
                                    <form class="kt-form" id="formaddrefraksi" action="{{ route('qc.spv.parameter_lab_pk_kadar_air_store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-wizard-v4__form">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="kt-section__body">
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Tanggal PO&nbsp;:</label>
                                                                    <div class="col-lg-6 col-xl-6">
                                                                        <input type="date" class="form-control" id="tanggal_po_pk" required name="tanggal_po_pk">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-lg-2 col-form-label"><b>PARAMETER</b></label>
                                                                    <label class="col-sm-3 col-lg-3 col-form-label"><b>MIN (>) </b></label>
                                                                    <label class="col-sm-3 col-lg-3 col-form-label"><b>MAX (<=) </b></label>
                                                                    <label class="col-sm-3 col-lg-2 col-form-label"><b>NILAI RREFRAKSI</b></label>
                                                                    <label class="col-sn-3 col-lg-2 col-form-label"></label>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label">Kadar Air (KA)&nbsp;:</label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="0%" id="min1_ka_pk" required name="min1_ka_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="15.0%" id="max1_ka_pk" required name="max1_ka_pk">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" placeholder="0" required id="nilai1_ka_pk" name="nilai1_ka_pk">
                                                                    </div>
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="15.0%" id="min2_ka_pk" required name="min2_ka_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="15.5%" id="max2_ka_pk" required name="max2_ka_pk">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" placeholder="30" required id="nilai2_ka_pk" name="nilai2_ka_pk">
                                                                    </div>
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="15.5%" required id="min3_ka_pk" name="min3_ka_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="20%" required id="max3_ka_pk" name="max3_ka_pk">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" placeholder="TOLAK" required id="nilai3_ka_pk" name="nilai3_ka_pk">
                                                                    </div>
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                </div>
                                                                <hr style="height: 1px; background-color: #E0E0E0; border: none;">
                                                              
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label">Hampa&nbsp;:</label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="0%" id="min1_hampa_pk" required name="min1_hampa_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="1.0%" id="max1_hampa_pk" required name="max1_hampa_pk">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" placeholder="0" required id="nilai1_hampa_pk" name="nilai1_hampa_pk">
                                                                    </div>
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="1.0%" id="min2_hampa_pk" required name="min2_hampa_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="2.5%" id="max2_hampa_pk" required name="max2_hampa_pk">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" placeholder="40" required id="nilai2_hampa_pk" name="nilai2_hampa_pk">
                                                                    </div>
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="2.5%" required id="min3_hampa_pk" name="min3_hampa_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="3.0%" required id="max3_hampa_pk" name="max3_hampa_pk">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" placeholder="TOLAK" required id="nilai3_hampa_pk" name="nilai3_hampa_pk">
                                                                    </div>
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                </div>
                                                                <hr style="height: 1px; background-color: #E0E0E0; border: none;">
                                                            
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label">TR&nbsp;:</label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="0%" id="min1_tr_pk" required name="min1_tr_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="3.00%" id="max1_tr_pk" required name="max1_tr_pk">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" placeholder="TOLAK" required id="nilai1_tr_pk" name="nilai1_tr_pk">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" placeholder="TOLAK" required id="kualitas1_tr_pk" name="kualitas1_tr_pk">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="3.00%" required id="min2_tr_pk" name="min2_tr_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="3.20%" required id="max2_tr_pk" name="max2_tr_pk">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" placeholder="50" required id="nilai2_tr_pk" name="nilai2_tr_pk">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" placeholder="KW 3" required id="kualitas2_tr_pk" name="kualitas2_tr_pk">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="3.20%" required id="min3_tr_pk" name="min3_tr_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="3.40%" required id="max3_tr_pk" name="max3_tr_pk">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" placeholder="25" required id="nilai3_tr_pk" name="nilai3_tr_pk">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" placeholder="KW 2" required id="kualitas3_tr_pk" name="kualitas3_tr_pk">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="3.40%" required id="min4_tr_pk" name="min4_tr_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="4.00%" required id="max4_tr_pk" name="max4_tr_pk">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" placeholder="0" required id="nilai4_tr_pk" name="nilai4_tr_pk">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" placeholder="KW 1" required id="kualitas4_tr_pk" name="kualitas4_tr_pk">
                                                                    </div>
                                                                </div>
                                                                <hr style="height: 1px; background-color: #E0E0E0; border: none;">
                                                             
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label">Katul&nbsp;:</label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="0%" id="min1_katul_pk" required name="min1_katul_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="14.0%" id="max1_katul_pk" required name="max1_katul_pk">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" placeholder="0" required id="nilai1_katul_pk" name="nilai1_katul_pk">
                                                                    </div>
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="14.0%" id="min2_katul_pk" required name="min2_katul_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="15.0%" id="max2_katul_pk" required name="max2_katul_pk">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" placeholder="25" required id="nilai2_katul_pk" name="nilai2_katul_pk">
                                                                    </div>
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="15.0%" required id="min3_katul_pk" name="min3_katul_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="20.0%" required id="max3_katul_pk" name="max3_katul_pk">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" placeholder="TOLAK" required id="nilai3_katul_pk" name="nilai3_katul_pk">
                                                                    </div>
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                </div>
                                                                <hr style="height: 1px; background-color: #E0E0E0; border: none;">
                                                              
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label">Butir Patah&nbsp;:</label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="0%" id="min1_butirpatah_pk" required name="min1_butirpatah_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="25.0%" id="max1_butirpatah_pk" required name="max1_butirpatah_pk">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" placeholder="0" required id="nilai1_butirpatah_pk" name="nilai1_butirpatah_pk">
                                                                    </div>
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="25.0%" id="min2_butirpatah_pk" required name="min2_butirpatah_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="35.0%" id="max2_butirpatah_pk" required name="max2_butirpatah_pk">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" placeholder="12.5" required id="nilai2_butirpatah_pk" name="nilai2_butirpatah_pk">
                                                                    </div>
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="35.0%" required id="min3_butirpatah_pk" name="min3_butirpatah_pk">
                                                                    </div>
                                                                    <div class="col-lg-3 col-xl-3">
                                                                        <input type="text" class="form-control" placeholder="40.0%" required id="max3_butirpatah_pk" name="max3_butirpatah_pk">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" placeholder="TOLAK" required id="nilai3_butirpatah_pk" name="nilai3_butirpatah_pk">
                                                                    </div>
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-form__actions">
                                                    <button id="btn_save" class="btn btn-success m-btn pull-right" style="">Save</button>
                                                </div><br>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!--end::Accordion-->
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-menu__link-icon flaticon2-cardiogram kt-font-warning"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data Parameter Tabel Refraksi PK
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
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal_update_po" title="Information" id="btn_update_po">Update Semua Tanggal PO</button>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">

                            <table class="table table-bordered" id="table-parameter-lab-ka">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Min&nbsp;KA</th>
                                        <th style="text-align: center;width:auto">Max&nbsp;KA</th>
                                        <th style="text-align: center;width:auto">Nilai&nbsp;Refraksi</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_2" role="tabpanel">

                            <table class="table table-bordered" id="table-parameter-lab-hampa">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Min&nbsp;Hampa</th>
                                        <th style="text-align: center;width:auto">Max&nbsp;Hampa</th>
                                        <th style="text-align: center;width:auto">Nilai&nbsp;Refraksi</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_3" role="tabpanel">

                            <table class="table table-bordered" id="table-parameter-lab-tr">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Min&nbsp;TR</th>
                                        <th style="text-align: center;width:auto">Max&nbsp;TR</th>
                                        <th style="text-align: center;width:auto">Nilai&nbsp;Refraksi</th>
                                        <th style="text-align: center;width:auto">Kualitas&nbsp;Refraksi</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_4" role="tabpanel">

                            <table class="table table-bordered" id="table-parameter-lab-katul">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Min Katul</th>
                                        <th style="text-align: center;width:auto">Max Katul</th>
                                        <th style="text-align: center;width:auto">Refraksi Katul</th>
                                        <th style="text-align: center;width:auto">Tanggal</th>
                                        <th style="text-align: center;width:auto">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_5" role="tabpanel">

                            <table class="table table-bordered" id="table-parameter-lab-butirpatah">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Min Butiran Patah</th>
                                        <th style="text-align: center;width:auto">Max Butiran Patah</th>
                                        <th style="text-align: center;width:auto">Refraksi Butir Patah</th>
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

            <div class="modal fade" id="modal_update_po" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('qc.spv.parameter_lab_pk_refraksi_update') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">UPDATE TANGGAL PO</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="">
                                        <label>Tanggal PO</label>
                                        <input id="tanggal_po_parameter_lab_pk_refraksi" required name="tanggal_po_parameter_lab_pk_refraksi" placeholder="" type="date" class="form-control m-input">
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
            <div class="modal fade" id="modal_edit_ka" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('qc.spv.parameter_lab_pk_kadar_air_update') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Data Parameter PK Kadar Air</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id_parameter_lab_pk_ka" id="id_parameter_lab_pk_ka" value="">
                                <div class="form-group">
                                    <div class="">
                                        <label>Min KA</label>
                                        <input id="min_ka_parameter_lab_pk_ka" required name="min_ka_parameter_lab_pk_ka" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Max KA</label>
                                        <input id="max_ka_parameter_lab_pk_ka" required name="max_ka_parameter_lab_pk_ka" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Harga</label>
                                        <input id="harga_parameter_lab_pk_ka" required name="harga_parameter_lab_pk_ka" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Tanggal PO</label>
                                        <input id="tanggal_po_parameter_lab_pk_ka" required name="tanggal_po_parameter_lab_pk_ka" placeholder="" type="date" class="form-control m-input">
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
                        <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('qc.spv.parameter_lab_pk_hampa_update') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Data Parameter PK Hampa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id_parameter_lab_pk_hampa" id="id_parameter_lab_pk_hampa" value="">
                                <div class="form-group">
                                    <div class="">
                                        <label>Min Hampa</label>
                                        <input id="min_parameter_lab_pk_hampa" required name="min_parameter_lab_pk_hampa" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Max Hampa</label>
                                        <input id="max_parameter_lab_pk_hampa" required name="max_parameter_lab_pk_hampa" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Nilai Refraksi</label>
                                        <input id="harga_parameter_lab_pk_hampa" required name="harga_parameter_lab_pk_hampa" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Tanggal</label>
                                        <input id="tanggal_parameter_lab_pk_hampa" required name="tanggal_parameter_lab_pk_hampa" placeholder="" type="date" class="form-control m-input">
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
                        <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('qc.spv.parameter_lab_pk_tr_update') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Data Parameter PK TR</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id_parameter_lab_pk_tr" id="id_parameter_lab_pk_tr" value="">
                                <div class="form-group">
                                    <div class="">
                                        <label>Min KA</label>
                                        <input id="min_parameter_lab_pk_tr" required name="min_parameter_lab_pk_tr" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Max KA</label>
                                        <input id="max_parameter_lab_pk_tr" required name="max_parameter_lab_pk_tr" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Nilai Refraksi</label>
                                        <input id="harga_parameter_lab_pk_tr" required name="harga_parameter_lab_pk_tr" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Kualitas Refraksi</label>
                                        <input id="kualitas_parameter_lab_pk_tr" required name="kualitas_parameter_lab_pk_tr" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Tanggal</label>
                                        <input id="tanggal_parameter_lab_pk_tr" required name="tanggal_parameter_lab_pk_tr" placeholder="" type="date" class="form-control m-input">
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
                        <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('qc.spv.parameter_lab_pk_katul_update') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Data Parameter PK Katul</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id_parameter_lab_pk_katul" id="id_parameter_lab_pk_katul" value="">
                                <div class="form-group">
                                    <div class="">
                                        <label>Min KA</label>
                                        <input id="min_parameter_lab_pk_katul" required name="min_parameter_lab_pk_katul" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Max KA</label>
                                        <input id="max_parameter_lab_pk_katul" required name="max_parameter_lab_pk_katul" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Refraksi Katul</label>
                                        <input id="harga_parameter_lab_pk_katul" required name="harga_parameter_lab_pk_katul" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Tanggal</label>
                                        <input id="tanggal_parameter_lab_pk_katul" required name="tanggal_parameter_lab_pk_katul" placeholder="" type="date" class="form-control m-input">
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
                        <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('qc.spv.parameter_lab_pk_butiran_patah_update') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Data Parameter PK Butir Patah</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id_parameter_lab_pk_butiran_patah" id="id_parameter_lab_pk_butiran_patah" value="">
                                <div class="form-group">
                                    <div class="">
                                        <label>Min Butir Patah</label>
                                        <input id="min_parameter_lab_pk_butiran_patah" required name="min_parameter_lab_pk_butiran_patah" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Max Butir Patah</label>
                                        <input id="max_parameter_lab_pk_butiran_patah" required name="max_parameter_lab_pk_butiran_patah" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Refraksi Butir Patah</label>
                                        <input id="harga_parameter_lab_pk_butiran_patah" required name="harga_parameter_lab_pk_butiran_patah" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Tanggal</label>
                                        <input id="tanggal_parameter_lab_pk_butiran_patah" required name="tanggal_parameter_lab_pk_butiran_patah" placeholder="" type="date" class="form-control m-input">
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
            ajax: "{{ route('qc.spv.parameter_lab_pk_kadar_air_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'min_ka_parameter_lab_pk_ka'
                },
                {
                    data: 'max_ka_parameter_lab_pk_ka'
                },
                {
                    data: 'harga_parameter_lab_pk_ka'
                },
                {
                    data: 'tanggal_po_parameter_lab_pk_ka'
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
            ajax: "{{ route('qc.spv.parameter_lab_pk_hampa_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'min_parameter_lab_pk_hampa'
                },
                {
                    data: 'max_parameter_lab_pk_hampa'
                },
                {
                    data: 'harga_parameter_lab_pk_hampa'
                },
                {
                    data: 'tanggal_parameter_lab_pk_hampa'
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
            ajax: "{{ route('qc.spv.parameter_lab_pk_tr_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'min_parameter_lab_pk_tr'
                },
                {
                    data: 'max_parameter_lab_pk_tr'
                },
                {
                    data: 'harga_parameter_lab_pk_tr'
                },
                {
                    data: 'kualitas_parameter_lab_pk_tr'
                },
                {
                    data: 'tanggal_parameter_lab_pk_tr'
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
            ajax: "{{ route('qc.spv.parameter_lab_pk_katul_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'min_parameter_lab_pk_katul'
                },
                {
                    data: 'max_parameter_lab_pk_katul'
                },
                {
                    data: 'harga_parameter_lab_pk_katul'
                },
                {
                    data: 'tanggal_parameter_lab_pk_katul'
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
            ajax: "{{ route('qc.spv.parameter_lab_pk_butiran_patah_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'min_parameter_lab_pk_butiran_patah'
                },
                {
                    data: 'max_parameter_lab_pk_butiran_patah'
                },
                {
                    data: 'harga_parameter_lab_pk_butiran_patah'
                },
                {
                    data: 'tanggal_parameter_lab_pk_butiran_patah'
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
        // KA 1
        $(document).on('keypress', '#min1_ka_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max1_ka_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#nilai1_ka_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        // KA 2
        $(document).on('keypress', '#min2_ka_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max2_ka_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#nilai2_ka_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        // KA 3
        $(document).on('keypress', '#min3_ka_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max3_ka_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });

        // HAMPA 1 
        $(document).on('keypress', '#min1_hampa_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max1_hampa_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#nilai1_hampa_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        // HAMPA 2
        $(document).on('keypress', '#min2_hampa_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max2_hampa_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#nilai2_hampa_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        // HAMPA 3
        $(document).on('keypress', '#min3_hampa_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max3_hampa_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });

        // TR 1
        $(document).on('keypress', '#min1_tr_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max1_tr_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        // TR 2
        $(document).on('keypress', '#min2_tr_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max2_tr_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#nilai2_tr_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        // TR 3
        $(document).on('keypress', '#min3_tr_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max3_tr_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#nilai3_tr_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        // TR 4
        $(document).on('keypress', '#min4_tr_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max4_tr_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#nilai4_tr_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });

        // KATUL 1
        $(document).on('keypress', '#min1_katul_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max1_katul_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#nilai1_katul_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        // KATUL 2
        $(document).on('keypress', '#min2_katul_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max2_katul_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#nilai2_katul_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        // KATUL 3
        $(document).on('keypress', '#min3_katul_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max3_katul_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });

        // BUTIR PATAH 1
        $(document).on('keypress', '#min1_butirpatah_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max1_butirpatah_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#nilai1_butirpatah_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        // BUTIR PATAH 2
        $(document).on('keypress', '#min2_butirpatah_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max2_butirpatah_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#nilai2_butirpatah_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        // BUTIR PATAH 3
        $(document).on('keypress', '#min3_butirpatah_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max3_butirpatah_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });

        $(document).on('click', '.to_parameter_ka', function() {
            var id = $(this).attr("name");
            var url = "{{ route('qc.spv.parameter_lab_pk_kadar_air_show')}}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_parameter_lab_pk_ka').val(parsed.id_parameter_lab_pk_ka);
                    $('#min_ka_parameter_lab_pk_ka').val(parsed.min_ka_parameter_lab_pk_ka);
                    $('#max_ka_parameter_lab_pk_ka').val(parsed.max_ka_parameter_lab_pk_ka);
                    $('#harga_parameter_lab_pk_ka').val(parsed.harga_parameter_lab_pk_ka);
                    $('#tanggal_po_parameter_lab_pk_ka').val(parsed.tanggal_po_parameter_lab_pk_ka);
                }
            });
        });
        $(document).on('click', '.to_parameter_hampa', function() {
            var id = $(this).attr("name");
            var url = "{{ route('qc.spv.parameter_lab_pk_hampa_show')}}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_parameter_lab_pk_hampa').val(parsed.id_parameter_lab_pk_hampa);
                    $('#min_parameter_lab_pk_hampa').val(parsed.min_parameter_lab_pk_hampa);
                    $('#max_parameter_lab_pk_hampa').val(parsed.max_parameter_lab_pk_hampa);
                    $('#harga_parameter_lab_pk_hampa').val(parsed.harga_parameter_lab_pk_hampa);
                    $('#tanggal_parameter_lab_pk_hampa').val(parsed.tanggal_parameter_lab_pk_hampa);
                }
            });
        });
        $(document).on('click', '.to_parameter_tr', function() {
            var id = $(this).attr("name");
            var url = "{{ route('qc.spv.parameter_lab_pk_tr_show')}}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_parameter_lab_pk_tr').val(parsed.id_parameter_lab_pk_tr);
                    $('#min_parameter_lab_pk_tr').val(parsed.min_parameter_lab_pk_tr);
                    $('#max_parameter_lab_pk_tr').val(parsed.max_parameter_lab_pk_tr);
                    $('#harga_parameter_lab_pk_tr').val(parsed.harga_parameter_lab_pk_tr);
                    $('#kualitas_parameter_lab_pk_tr').val(parsed.kualitas_parameter_lab_pk_tr);
                    $('#tanggal_parameter_lab_pk_tr').val(parsed.tanggal_parameter_lab_pk_tr);
                }
            });
        });
        $(document).on('click', '.to_parameter_katul', function() {
            var id = $(this).attr("name");
            var url = "{{ route('qc.spv.parameter_lab_pk_katul_show')}}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_parameter_lab_pk_katul').val(parsed.id_parameter_lab_pk_katul);
                    $('#min_parameter_lab_pk_katul').val(parsed.min_parameter_lab_pk_katul);
                    $('#max_parameter_lab_pk_katul').val(parsed.max_parameter_lab_pk_katul);
                    $('#harga_parameter_lab_pk_katul').val(parsed.harga_parameter_lab_pk_katul);
                    $('#tanggal_parameter_lab_pk_katul').val(parsed.tanggal_parameter_lab_pk_katul);
                }
            });
        });
        $(document).on('click', '.to_parameter_butirpatah', function() {
            var id = $(this).attr("name");
            var url = "{{ route('qc.spv.parameter_lab_pk_butiran_patah_show')}}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_parameter_lab_pk_butiran_patah').val(parsed.id_parameter_lab_pk_butiran_patah);
                    $('#min_parameter_lab_pk_butiran_patah').val(parsed.min_parameter_lab_pk_butiran_patah);
                    $('#max_parameter_lab_pk_butiran_patah').val(parsed.max_parameter_lab_pk_butiran_patah);
                    $('#harga_parameter_lab_pk_butiran_patah').val(parsed.harga_parameter_lab_pk_butiran_patah);
                    $('#tanggal_parameter_lab_pk_butiran_patah').val(parsed.tanggal_parameter_lab_pk_butiran_patah);
                }
            });
        });
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
                    if ($('#min1_ka_pk').val() == '' ||
                        $('#max1_ka_pk').val() == '' ||
                        $('#nilai1_ka_pk').val() == '' ||
                        $('#min2_ka_pk').val() == '' ||
                        $('#max2_ka_pk').val() == '' ||
                        $('#nilai2_ka_pk').val() == '' ||
                        $('#min3_ka_pk').val() == '' ||
                        $('#max3_ka_pk').val() == '' ||
                        $('#nilai3_ka_pk').val() == '' ||
                        $('#min1_hampa_pk').val() == '' ||
                        $('#max1_hampa_pk').val() == '' ||
                        $('#nilai_hampa_pk').val() == '' ||
                        $('#min2_hampa_pk').val() == '' ||
                        $('#max2_hampa_pk').val() == '' ||
                        $('#nilai2_hampa_pk').val() == '' ||
                        $('#min3_hampa_pk').val() == '' ||
                        $('#max3_hampa_pk').val() == '' ||
                        $('#nilai3_hampa_pk').val() == '' ||
                        $('#min1_tr_pk').val() == '' ||
                        $('#max1_tr_pk').val() == '' ||
                        $('#nilai1_tr_pk').val() == '' ||
                        $('#kualitas1_tr_pk').val() == '' ||
                        $('#min2_tr_pk').val() == '' ||
                        $('#max2_tr_pk').val() == '' ||
                        $('#nilai2_tr_pk').val() == '' ||
                        $('#kualitas2_tr_pk').val() == '' ||
                        $('#min3_tr_pk').val() == '' ||
                        $('#max3_tr_pk').val() == '' ||
                        $('#nilai3_tr_pk').val() == '' ||
                        $('#kualitas3_tr_pk').val() == '' ||
                        $('#min4_tr_pk').val() == '' ||
                        $('#max4_tr_pk').val() == '' ||
                        $('#nilai4_tr_pk').val() == '' ||
                        $('#kualitas4_tr_pk').val() == '' ||
                        $('#min1_katul_pk').val() == '' ||
                        $('#max1_katul_pk').val() == '' ||
                        $('#nilai1_katul_pk').val() == '' ||
                        $('#min2_katul_pk').val() == '' ||
                        $('#max2_katul_pk').val() == '' ||
                        $('#nilai2_katul_pk').val() == '' ||
                        $('#min3_katul_pk').val() == '' ||
                        $('#max3_katul_pk').val() == '' ||
                        $('#nilai3_katul_pk').val() == '' ||
                        $('#min1_butirpatah_pk').val() == '' ||
                        $('#max1_butirpatah_pk').val() == '' ||
                        $('#nilai1_butirpatah_pk').val() == '' ||
                        $('#min2_butirpatah_pk').val() == '' ||
                        $('#max2_butirpatah_pk').val() == '' ||
                        $('#nilai2_butirpatah_pk').val() == '' ||
                        $('#min3_butirpatah_pk').val() == '' ||
                        $('#max3_butirpatah_pk').val() == '' ||
                        $('#tanggal_po_pk').val() == '' ||
                        $('#nilai3_butirpatah_pk').val() == '') {
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
                        $('#formaddrefraksi').submit();
                        // Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
                    }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
    });
    $(function() {
        // KA
        $(document).on('keypress', '#min_ka_parameter_lab_pk_ka', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max_ka_parameter_lab_pk_ka', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });

        // HAMPA
        $(document).on('keypress', '#min_parameter_lab_pk_hampa', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max_parameter_lab_pk_hampa', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });

        // TR
        $(document).on('keypress', '#min_parameter_lab_pk_tr', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max_parameter_lab_pk_tr', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });

        // KATUL 1
        $(document).on('keypress', '#min_parameter_lab_pk_katul', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max_parameter_lab_pk_katul', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });

        // BUTIR PATAH
        $(document).on('keypress', '#min_parameter_lab_pk_butiran_patah', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max_parameter_lab_pk_butiran_patah', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
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
                        url: "{{route('qc.spv.parameter_lab_pk_kadar_air_destroy')}}/" + id,
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
                        url: "{{route('qc.spv.parameter_lab_pk_hampa_destroy')}}/" + id,
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
                        url: "{{route('qc.spv.parameter_lab_pk_tr_destroy')}}/" + id,
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
                        url: "{{route('qc.spv.parameter_lab_pk_katul_destroy')}}/" + id,
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
                        url: "{{route('qc.spv.parameter_lab_pk_butiran_patah_destroy')}}/" + id,
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