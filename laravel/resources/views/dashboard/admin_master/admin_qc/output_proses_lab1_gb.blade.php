@extends('dashboard.admin_master.layout.main')
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
        <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            HasiL Lab 1 Gabah Basah
                        </h3>
                    </div>
                </div>
                <form class="kt-form" action="javascript:void(0)" method="POST" enctype="multipart/form-data">
                    <div style="margin-left: 10px; margin-top:10px;" class="row input-daterange">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="col-md-4">
                            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                        </div>
                        <div class="col-md-4">
                            <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                            <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                            <button type="button" name="btn_export" id="btn_export" class="btn btn-success"><i class="fa fa-file-excel"></i>Excel</button>
                        </div>
                    </div>
                </form>
                <div class="m-portlet__body">
                    <div class="kt-portlet__body">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item mt-3">
                                <a class="nav-link active" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-database"></i>GB LONG GRAIN</a>
                            </li>
                            <li class="nav-item mt-3">
                                <a class="nav-link" data-toggle="tab" href="#m_tabs_3_2"><i class="la la-database"></i>GB PANDAN WANGI</a>
                            </li>
                            <li class="nav-item mt-3">
                                <a class="nav-link" data-toggle="tab" href="#m_tabs_3_3"><i class="la la-database"></i>GB KETAN PUTIH</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
                                <table class="table table-bordered" id="data_longgrain">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;width:2%">No</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Sampai&nbsp;Disatpam</th>
                                            <th style="text-align: center;width:auto">Tanggal&nbsp;PO </th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Asal</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:20px">KA&nbsp;KS</th>
                                            <th style="text-align: center;width:20px">KA&nbsp;KG</th>
                                            <th style="text-align: center;width:20px">Berat&nbsp;Sample&nbsp;Awal&nbsp;KS</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Awal&nbsp;KG</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Akhir&nbsp;KG </th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;PK </th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Beras </th>
                                            <th style="text-align: center;width:auto">WH </th>
                                            <th style="text-align: center;width:auto">TP </th>
                                            <th style="text-align: center;width:auto">MD </th>
                                            <th style="text-align: center;width:auto">BROKEN </th>

                                            <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Gabah</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center">

                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="m_tabs_3_2" role="tabpanel">
                                <table class="table table-bordered" id="data_pw">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;width:2%">No</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Sampai&nbsp;Disatpam</th>
                                            <th style="text-align: center;width:auto">Tanggal&nbsp;PO </th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Asal</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:20px">KA&nbsp;KS</th>
                                            <th style="text-align: center;width:20px">KA&nbsp;KG</th>
                                            <th style="text-align: center;width:20px">Berat&nbsp;Sample&nbsp;Awal&nbsp;KS</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Awal&nbsp;KG</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Akhir&nbsp;KG </th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;PK </th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Beras </th>
                                            <th style="text-align: center;width:auto">WH </th>
                                            <th style="text-align: center;width:auto">TP </th>
                                            <th style="text-align: center;width:auto">MD </th>
                                            <th style="text-align: center;width:auto">BROKEN </th>

                                            <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Gabah</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center">

                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
                                <table class="table table-bordered" id="data_kp">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;width:2%">No</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Sampai&nbsp;Disatpam</th>
                                            <th style="text-align: center;width:auto">Tanggal&nbsp;PO </th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Asal</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:20px">KA&nbsp;KS</th>
                                            <th style="text-align: center;width:20px">KA&nbsp;KG</th>
                                            <th style="text-align: center;width:20px">Berat&nbsp;Sample&nbsp;Awal&nbsp;KS</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Awal&nbsp;KG</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Akhir&nbsp;KG </th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;PK </th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Beras </th>
                                            <th style="text-align: center;width:auto">WH </th>
                                            <th style="text-align: center;width:auto">TP </th>
                                            <th style="text-align: center;width:auto">MD </th>
                                            <th style="text-align: center;width:auto">BROKEN </th>

                                            <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Gabah</th>
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
        </div>
    </div>


    <div class="modal fade" id="modal_outputlab1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="form_updateproseslab1" class="m-form m-form--fit m-form--label-align-right" method="post" action="javascript:void(0)" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Lab 1</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="gabahincoming_id_data_po" id="gabahincoming_id_data_po" value="">
                        <input type="hidden" name="gabahincoming_id_penerimaan_po" id="gabahincoming_id_penerimaan_po">
                        <input type="hidden" id="id_gabahincoming_qc" name="id_gabahincoming_qc">
                        <input type="hidden" id="nama_supplier" name="nama_supplier">
                        <input type="hidden" id="no_supplier" name="no_supplier">
                        {{-- tambahan input --}}
                        <input type="hidden" id="hampa" name="hampa">
                        <input type="hidden" id="kg_after_adjust_hampa" name="kg_after_adjust_hampa">
                        <input type="hidden" id="prosentasi_kg" name="prosentasi_kg">
                        <input type="hidden" id="susut" name="susut">
                        <input type="hidden" id="item" name="item">
                        <input type="hidden" id="adjust_susut" name="adjust_susut">
                        <input type="hidden" id="prsentase_ks_kg_after_adjust_susut" name="prsentase_ks_kg_after_adjust_susut">
                        <input type="hidden" id="prsentase_kg_pk" name="prsentase_kg_pk">
                        <input type="hidden" id="adjust_prosentase_kg_pk" name="adjust_prosentase_kg_pk">
                        <input type="hidden" id="presentase_ks_pk" name="presentase_ks_pk">
                        <input type="hidden" id="presentase_putih" name="presentase_putih">
                        <input type="hidden" id="adjust_prosentase_kg_ke_putih" name="adjust_prosentase_kg_ke_putih">
                        <input type="hidden" id="plan_rend_dari_ks_beras" name="plan_rend_dari_ks_beras">
                        <input type="hidden" id="katul" name="katul">
                        <input type="hidden" id="refraksi_broken" name="refraksi_broken">
                        <input type="hidden" id="plan_harga_gabah" name="plan_harga_gabah">
                        <input type="hidden" id="lokasibongkar" name="lokasibongkar">
                        <input type="hidden" id="keteranganlab1" name="keteranganlab1">
                        <input type="hidden" id="tanggal_po" name="tanggal_po">
                        <input type="hidden" id="date_bid" name="date_bid">
                        <input type="hidden" id="PONum" name="PONum">
                        <input type="hidden" id="no_hp" name="no_hp">
                        <input type="hidden" id="status_plan_hpp" name="status_plan_hpp">
                        <input type="hidden" id="status_harga_atas" name="status_harga_atas">
                        <input type="hidden" id="status_harga_bawah" name="status_harga_bawah">
                        <input type="hidden" id="status_pending" name="status_pending">
                        <div id="planhpp_success" class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <dl id="getplan" class="dl-horizontal row">
                                <label class="col-sm-12">Parameter PLAN HPP</label>
                                <dd class="col-sm-3" style="font-weight: bold;">Min&nbsp;TP</dd>
                                <dd class="col-sm-3" style="font-weight: bold;"></dd>
                                <dd class="col-sm-3" style="font-weight: bold;">Max&nbsp;TP</dd>
                                <dd class="col-sm-3" style="font-weight: bold;">Harga</dd>
                            </dl>
                            <dl id="input_plan" class="dl-horizontal row">
                            </dl>
                        </div>
                        <a href="javascript:void(0);" id="notif_hpp_error">
                            <div id="planhpp_error" class="alert alert-danger">
                                <button type="button" class="close" style="margin-right:10px;" data-dismiss="alert" aria-hidden="true">×</button>
                                <label class="col-sm-12"><i class="fa fa-minus-circle"></i> Parameter PLAN HPP Belum Terisi</label>
                            </div>
                        </a>
                        <div id="hargaatas_success" class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <dl id="get_hargaatas" class="dl-horizontal row">
                                <label class="col-sm-12">Parameter Harga Atas</label>
                            </dl>
                            <dl id="input_hargaatas" class="dl-horizontal row">
                            </dl>
                        </div>
                        <a href="javascript:void(0);" id="notif_harga_atas_error">
                            <div id="hargaatas_error" class="alert alert-danger">
                                <button type="button" class="close" style="margin-right:10px;" data-dismiss="alert" aria-hidden="true">×</button>
                                <label class="col-sm-12"><i class="fa fa-minus-circle"></i> Parameter HARGA ATAS Belum Terisi</label>
                            </div>
                        </a>
                        <div id="hargabawah_success" class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <dl id="get_hargabawah" class="dl-horizontal row">
                                <label class="col-sm-12">Parameter Harga Bawah</label>
                            </dl>
                            <dl id="input_hargabawah" class="dl-horizontal row">
                            </dl>
                        </div>
                        <a href="javascript:void(0);" id="notif_harga_bawah_error">
                            <div id="hargabawah_error" class="alert alert-danger">
                                <button type="button" class="close" style="margin-right:10px;" data-dismiss="alert" aria-hidden="true">×</button>
                                <label class="col-sm-12"><i class="fa fa-minus-circle"></i> Parameter HARGA BAWAH Belum Terisi</label>
                            </div>
                        </a>
                        <div class="form-group">
                            <div class="">
                                <label>Code PO</label>
                                <input type="text" id="gabahincoming_kode_po" name="gabahincoming_kode_po" class="form-control m-input" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <label>Nopol</label>
                                <input type="text" id="gabahincoming_plat" readonly name="gabahincoming_plat" class="form-control m-input">
                            </div>
                        </div>
                        <div id="planhpp" class="form-group">
                        </div>
                        {{-- edit form --}}
                        <div class="m-form__group form-group">
                            <label for="">KA KS</label>
                            <input type="text" step="any" required name="kadar_air" id="kadar_air" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">KA KG</label>
                            <input type="text" step="any" required name="ka_kg" id="ka_kg" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">Berat Sample Awal KS</label>
                            <input type="text" step="any" required name="berat_sample_awal_ks" id="berat_sample_awal_ks" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">Berat Sample Awal KG</label>
                            <input type="text" step="any" required name="berat_sample_awal_kg" id="berat_sample_awal_kg" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">Berat Sample Akhir KG</label>
                            <input type="text" step="any" required name="berat_sample_akhir_kg" id="berat_sample_akhir_kg" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">Berat Sample PK</label>
                            <input type="text" step="any" required name="berat_sample_pk" id="berat_sample_pk" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">Berat Sample Beras</label>
                            <input type="text" step="any" required name="randoman" id="randoman" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">WH</label>
                            <input type="text" step="any" required name="wh" id="wh" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">TP</label>
                            <input type="text" step="any" required name="tp" id="tp" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">MD</label>
                            <input type="text" step="any" required name="md" id="md" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">Broken Setelah Bongkar</label>
                            <input type="text" step="any" required name="broken" id="broken" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">Status Lab </label>
                            <select class="form-select form-control m-input" id="keterangan_lab_1" required name="keterangan_lab_1" aria-label="Default select example">
                                <option value="">--Output Lab 1--</option>
                                <option name="keterangan_lab_1" value="Unload">Bongkar</option>
                                <option name="keterangan_lab_1" value="Pending">Pending</option>
                                <option name="keterangan_lab_1" value="Reject">Tolak</option>
                            </select>
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">Keterangan</label>
                            <input type="text" step="any" required name="keterangan_lab1" id="keterangan_lab1" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">Plan Harga (Kg)</label>
                            <input readonly type="text" step="any" required name="plan_harga" id="plan_harga" class="form-control m-input">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                        <button id="btn_update" class="btn btn-success m-btn pull-right">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(function() {
            $(document).on('keypress', '#kadar_air', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#ka_kg', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#berat_sample_awal_ks', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#berat_sample_awal_kg', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#berat_sample_akhir_kg', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#berat_sample_pk', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#randoman', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#wh', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#tp', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#md', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#broken', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
        });
        $(document).on('keyup', '#plan_harga', function(e) {
            var data = $(this).val();
            var hasil = formatRupiah(data, "Rp. ");
            $(this).val(hasil);
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
        }

        function replace_titik(x) {
            return ((x.replace('.', '')).replace('.', '')).replace('.', '');
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.input-daterange').datepicker({
                todayBtn: 'linked',
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            load_data();

            function load_data(from_date = '', to_date = '') {
                var table = $('#data_longgrain').DataTable({
                    "scrollY": true,
                    "scrollX": true,
                    processing: true,
                    language: {
                        "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>'
                    },
                    serverSide: true,
                    "aLengthMenu": [
                        [25, 100, 300, -1],
                        [25, 100, 300, "All"]
                    ],
                    "iDisplayLength": 10,
                    ajax: {
                        url: "{{ route('master.output_lab1_gb_qc_longgrain_index') }}",
                        data: {
                            from_date: from_date,
                            to_date: to_date
                        }
                    },
                    columns: [{
                            data: "id_bid",

                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'name_bid'
                        },
                        {
                            data: 'kode_po'
                        },
                        {
                            data: 'nama_vendor'
                        },
                        {
                            data: 'waktu_penerimaan'
                        },
                        {
                            data: 'tanggal_po'
                        },
                        {
                            data: 'plat_kendaraan'
                        },
                        {
                            data: 'asal_gabah'
                        },
                        {
                            data: 'ckelola'
                        },

                        {
                            data: 'kadar_air'
                        },
                        {
                            data: 'ka_kg'
                        },
                        {
                            data: 'berat_sample_awal_ks'
                        },
                        {
                            data: 'berat_sample_awal_kg'
                        },
                        {
                            data: 'berat_sample_akhir_kg'
                        },
                        {
                            data: 'berat_sample_pk'
                        },
                        {
                            data: 'berat_sample_beras'
                        },
                        {
                            data: 'wh'
                        },
                        {
                            data: 'tp'
                        },
                        {
                            data: 'md'
                        },
                        {
                            data: 'broken'
                        },
                        {
                            data: 'plan_harga_beli_gabah'
                        },


                    ],
                    createdRow: function(row, data, index) {

                        // Updated Schedule Week 1 - 07 Mar 22

                        if (data.name_bid == 'GABAH BASAH CIHERANG') {
                            $('td:eq(2)', row).css('color', '#000099'); //Original Date
                        } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                            $('td:eq(2)', row).css('color', '#009900'); // Behind of Original Date
                        } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                            $('td:eq(2)', row).css('color', '#330019'); // Behind of Original Date
                        } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                            $('td:eq(2)', row).css('color', '#6666FF'); // Behind of Original Date
                        }
                    },
                    "order": []
                });
                $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                    table.columns.adjust().draw().responsive.recalc();
                })
                var table2 = $('#data_pw').DataTable({
                    "scrollY": true,
                    "scrollX": true,
                    processing: true,
                    language: {
                        "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>'
                    },
                    serverSide: true,
                    "aLengthMenu": [
                        [25, 100, 300, -1],
                        [25, 100, 300, "All"]
                    ],
                    "iDisplayLength": 10,
                    ajax: {
                        url: "{{ route('master.output_lab1_gb_qc_pandan_wangi_index') }}",
                        data: {
                            from_date: from_date,
                            to_date: to_date
                        }
                    },
                    columns: [{
                            data: "id_bid",

                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'name_bid'
                        },
                        {
                            data: 'kode_po'
                        },
                        {
                            data: 'nama_vendor'
                        },
                        {
                            data: 'waktu_penerimaan'
                        },
                        {
                            data: 'tanggal_po'
                        },
                        {
                            data: 'plat_kendaraan'
                        },
                        {
                            data: 'asal_gabah'
                        },
                        {
                            data: 'ckelola'
                        },
                        {
                            data: 'kadar_air'
                        },
                        {
                            data: 'ka_kg'
                        },
                        {
                            data: 'berat_sample_awal_ks'
                        },
                        {
                            data: 'berat_sample_awal_kg'
                        },
                        {
                            data: 'berat_sample_akhir_kg'
                        },
                        {
                            data: 'berat_sample_pk'
                        },
                        {
                            data: 'berat_sample_beras'
                        },
                        {
                            data: 'wh'
                        },
                        {
                            data: 'tp'
                        },
                        {
                            data: 'md'
                        },
                        {
                            data: 'broken'
                        },
                        {
                            data: 'plan_harga_beli_gabah'
                        },


                    ],
                    createdRow: function(row, data, index) {

                        // Updated Schedule Week 1 - 07 Mar 22

                        if (data.name_bid == 'GABAH BASAH CIHERANG') {
                            $('td:eq(2)', row).css('color', '#000099'); //Original Date
                        } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                            $('td:eq(2)', row).css('color', '#009900'); // Behind of Original Date
                        } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                            $('td:eq(2)', row).css('color', '#330019'); // Behind of Original Date
                        } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                            $('td:eq(2)', row).css('color', '#6666FF'); // Behind of Original Date
                        }
                    },
                    "order": []
                });
                $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                    table2.columns.adjust().draw().responsive.recalc();
                })
                var table4 = $('#data_kp').DataTable({
                    "scrollY": true,
                    "scrollX": true,
                    processing: true,
                    language: {
                        "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>'
                    },
                    serverSide: true,
                    "aLengthMenu": [
                        [25, 100, 300, -1],
                        [25, 100, 300, "All"]
                    ],
                    "iDisplayLength": 10,
                    ajax: {
                        url: "{{ route('master.output_lab1_gb_qc_ketan_putih_index') }}",
                        data: {
                            from_date: from_date,
                            to_date: to_date
                        }
                    },
                    columns: [{
                            data: "id_bid",

                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'name_bid'
                        },
                        {
                            data: 'kode_po'
                        },
                        {
                            data: 'nama_vendor'
                        },
                        {
                            data: 'waktu_penerimaan'
                        },
                        {
                            data: 'tanggal_po'
                        },
                        {
                            data: 'plat_kendaraan'
                        },
                        {
                            data: 'asal_gabah'
                        },
                        {
                            data: 'ckelola'
                        },

                        {
                            data: 'kadar_air'
                        },
                        {
                            data: 'ka_kg'
                        },
                        {
                            data: 'berat_sample_awal_ks'
                        },
                        {
                            data: 'berat_sample_awal_kg'
                        },
                        {
                            data: 'berat_sample_akhir_kg'
                        },
                        {
                            data: 'berat_sample_pk'
                        },
                        {
                            data: 'berat_sample_beras'
                        },
                        {
                            data: 'wh'
                        },
                        {
                            data: 'tp'
                        },
                        {
                            data: 'md'
                        },
                        {
                            data: 'broken'
                        },
                        {
                            data: 'plan_harga_beli_gabah'
                        },


                    ],
                    createdRow: function(row, data, index) {

                        // Updated Schedule Week 1 - 07 Mar 22

                        if (data.name_bid == 'GABAH BASAH CIHERANG') {
                            $('td:eq(2)', row).css('color', '#000099'); //Original Date
                        } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                            $('td:eq(2)', row).css('color', '#009900'); // Behind of Original Date
                        } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                            $('td:eq(2)', row).css('color', '#330019'); // Behind of Original Date
                        } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                            $('td:eq(2)', row).css('color', '#6666FF'); // Behind of Original Date
                        }
                    },
                    "order": []
                });
                $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                    table4.columns.adjust().draw().responsive.recalc();
                })
            }
            $('#filter').click(function() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();

                if (from_date != '' && to_date != '') {
                    // table.ajax.reload(from_date, to_date);
                    $('#data_longgrain').DataTable().destroy();
                    $('#data_pw').DataTable().destroy();
                    $('#data_kp').DataTable().destroy();
                    $('#data_longgrain1').DataTable().destroy();
                    $('#data_pw1').DataTable().destroy();
                    $('#data_kp1').DataTable().destroy();
                    load_data(from_date, to_date);
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Sukses filter data',
                        icon: 'success',
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        title: 'Infoo!!',
                        text: 'Mohon Isikan data',
                        icon: 'warning',
                        timer: 1500
                    })
                }

            });

            $('#refresh').click(function() {
                $('#from_date').val('');
                $('#to_date').val('');
                $('#data_longgrain').DataTable().destroy();
                $('#data_pw').DataTable().destroy();
                $('#data_kp').DataTable().destroy();
                $('#data_longgrain1').DataTable().destroy();
                $('#data_pw1').DataTable().destroy();
                $('#data_kp1').DataTable().destroy();
                load_data();
            });
            $('#btn_export').click(function() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                $.ajax({
                    data: {
                        "_token": "{{ csrf_token() }}",
                        from_date: from_date,
                        to_date: to_date,
                    },
                    url: "{{route('master.download_output_lab1_excel')}}",
                    type: "POST",
                    cache: false,
                    xhrFields: {
                        responseType: 'blob'
                    },
                    error: function() {
                        alert('Something is wrong');
                    },
                    success: function(data, status, xhr) {
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(data);
                        link.download = `DATA OUTPUT LAB 1 PT. SURYA PANGAN SEMESTA NGAWI.xlsx`;
                        link.click();

                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $(document).on('click', '#notif_hpp_error', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Maaf!',
                    icon: 'error',
                    text: "Plan HPP Belum Di isi SPV",
                    position: top
                })
            });
            $(document).on('click', '#notif_harga_atas_error', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Maaf!',
                    icon: 'error',
                    text: "Plan Harga Atas Belum Di isi SPV",
                    position: top
                })
            });
            $(document).on('click', '#notif_harga_bawah_error', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Maaf!',
                    icon: 'error',
                    text: "Plan Harga Bawah Belum Di isi SPV",
                    position: top
                })
            });
            $(document).on('click', '#to_edit', function() {
                var id = $(this).attr("name");
                var item = $(this).data('item');
                var tanggal_po = $(this).data('tanggal_po');
                var id_penerimaan = $(this).data('id');
                var no_hp = $(this).data('hp');
                var url = "{{ route('master.edit_lab1_gb') }}" + "/" + id;
                var url2 = "{{route('master.get_plan_hpp_gabah_basah') }}" + "/" + tanggal_po + "/" + item;
                var url3 = "{{route('get_price_top_gabah_basah') }}" + "/" + id_penerimaan;
                var url4 = "{{route('get_buttom_price_gabah_basah') }}" + "/" + id_penerimaan;
                // console.log(no_hp);
                $('#form_updateproseslab1').trigger('reset');
                //   $('#modal2').removeData();
                //   location.reload();
                $('#modal_outputlab1').on('hidden.bs.modal', function(e) {
                    $('#input_hpp').remove();
                    // $('#min_tp').remove();
                    // $('#operation').remove();
                    // $('#max_tp').remove();
                    // $('#harga_hpp').remove();
                    $('#input_plan').empty();
                    $('#input_hargaatas').empty();
                    $('#input_hargabawah').empty();

                    // $('#planhpp_success').remove();

                    // $('#modal_outputlab1').show();
                })
                $('#modal_outputlab1').modal('show');
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        // console.log(response);
                        var parsed = $.parseJSON(response);

                        $('#gabahincoming_id_penerimaan_po').val(parsed.lab1_id_penerimaan_po_gb);
                        $('#gabahincoming_id_data_po').val(parsed.lab1_id_data_po_gb);
                        $('#nama_supplier').val(parsed.name);
                        $('#no_supplier').val(parsed.nomer_hp);
                        $('#id_gabahincoming_qc').val(parsed.id_lab1_gb);
                        $('#gabahincoming_kode_po').val(parsed.lab1_kode_po_gb);
                        $('#gabahincoming_plat').val(parsed.lab1_plat_gb);
                        $('#kadar_air').val(parsed.kadar_air_gb);
                        $('#ka_kg').val(parsed.ka_kg_gb);
                        $('#berat_sample_awal_ks').val(parsed.berat_sample_awal_ks_gb);
                        $('#berat_sample_awal_kg').val(parsed.berat_sample_awal_kg_gb);
                        $('#berat_sample_akhir_kg').val(parsed.berat_sample_akhir_kg_gb);
                        $('#berat_sample_pk').val(parsed.berat_sample_pk_gb);
                        $('#randoman').val(parsed.randoman_gb);
                        $('#wh').val(parsed.wh_gb);
                        $('#tp').val(parsed.tp_gb);
                        $('#md').val(parsed.md_gb);
                        $('#broken').val(parsed.broken_gb);
                        $('#keterangan_lab1').val(parsed.keterangan_lab_gb);
                        $('#keterangan_lab_1').val(parsed.output_lab_gb);
                        // console.log(parsed.output_lab_gb);
                        $('#lokasibongkar').val(parsed.lokasi_bongkar_gb);
                        $('#date_bid').val(parsed.date_bid);
                        $('#plan_harga').val(parsed.plan_harga_gb);
                        $('#tanggal_po').val(parsed.tanggal_po);
                        $('.lokasi_gt').val(parsed.lokasi_bongkar_gb);
                        // hidden
                        $('#PONum').val(parsed.PONum);
                        $('#hampa').val(parsed.hampa_gb);
                        $('#kg_after_adjust_hampa').val(parsed.kg_after_adjust_hampa_gb);
                        $('#prosentasi_kg').val(parsed.prosentasi_kg_gb);
                        $('#susut').val(parsed.susut_gb);
                        $('#adjust_susut').val(parsed.adjust_susut_gb);
                        $('#prsentase_ks_kg_after_adjust_susut').val(parsed.prsentase_ks_kg_after_adjust_susut_gb);
                        $('#prsentase_kg_pk').val(parsed.prsentase_kg_pk_gb);
                        $('#adjust_prosentase_kg_pk').val(parsed.adjust_prosentase_kg_pk_gb);
                        $('#presentase_ks_pk').val(parsed.presentase_ks_pk_gb);
                        $('#presentase_putih').val(parsed.presentase_putih_gb);
                        $('#adjust_prosentase_kg_ke_putih').val(parsed.adjust_prosentase_kg_ke_putih_gb);
                        $('#plan_rend_dari_ks_beras').val(parsed.plan_rend_dari_ks_beras_gb);
                        $('#plan_rend_dari_ks_beras').val(parsed.plan_rend_dari_ks_beras_gb);
                        $('#katul').val(parsed.katul_gb);
                        $('#item').val(item);
                        $('#refraksi_broken').val(parsed.refraksi_broken_gb);
                        $('#plan_harga_gabah').val(parsed.plan_harga_gabah_gb);
                        $('#lokasibongkar').val(parsed.lokasi_bongkar_gb);
                        $('#keteranganlab1').val(parsed.output_lab_gb);
                        $('#no_hp').val(no_hp);
                        // if(parsed.output_lab_gb=='Pending'){
                        //     $('#keterangan_lab_1 > option[value="Unload"]').attr('disabled',true);
                        //     $('#keterangan_lab_1 > option[value="Reject"]').attr('disabled',true);
                        // } else{
                        //     $('#keterangan_lab_1 > option[value="Unload"]').attr('disabled',false);
                        //     $('#keterangan_lab_1 > option[value="Reject"]').attr('disabled',false);

                        // }
                    }
                });
                $.ajax({
                    type: "GET",
                    url: url2,
                    success: function(response) {
                        var my_orders = $('#planhpp')
                        var my_plan = $('#input_plan')
                        var parsed = JSON.parse(response);
                        if (parsed == null || parsed == '') {
                            document.getElementById('planhpp_success').style.display = 'none';
                            document.getElementById('planhpp_error').style.display = 'block';
                            document.getElementById('status_plan_hpp').value = '0';
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'SPV belum input PLAN HPP Sesuai Tanggal PO',
                                icon: 'warning',
                                allowOutsideClick: false,
                                showCancelButton: false,
                                showConfirmButton: false
                            })
                        } else {
                            document.getElementById('planhpp_success').style.display = 'block';
                            document.getElementById('planhpp_error').style.display = 'none';
                            document.getElementById('status_plan_hpp').value = '1';
                            $.each(parsed, function(item) {
                                my_orders.append("<input id=" + 'input_hpp' + " type=" + 'hidden' + " class=" + 'hpp' + " value=" + parsed[item].min_tp_gb + '#' + parsed[item].max_tp_gb + '#' + parsed[item].harga_gb + ">");
                                my_plan.append("<dd id=" + 'min_tp' + " class=" + 'col-sm-3 col-xs-12' + ">" + parsed[item].min_tp_gb + "</dd><dd id=" + 'operation' + " class=" + 'col-sm-3 col-xs-12' + "><=<</dd><dd id=" + 'max_tp' + "  class=" + 'col-sm-3 col-xs-12' + ">" + parsed[item].max_tp_gb + "</dd><dd id=" + 'harga_hpp' + "  class=" + 'col-sm-3 col-xs-12' + ">Rp. " + formatRupiah(parsed[item].harga_gb) + "</dd>");
                            });
                        }
                    }
                });
                $.ajax({
                    type: "GET",
                    url: url3,
                    success: function(response) {
                        var my_topprice = $('#input_hargaatas')
                        var parsed = JSON.parse(response);
                        if (parsed == null || parsed == '') {
                            document.getElementById('hargaatas_success').style.display = 'none';
                            document.getElementById('hargaatas_error').style.display = 'block';
                            document.getElementById('status_harga_atas').value = '0';
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'SPV belum input HARGA ATAS Sesuai Tanggal PO',
                                icon: 'warning',
                                allowOutsideClick: false,
                                showCancelButton: false,
                                showConfirmButton: false
                            })
                        } else {
                            document.getElementById('hargaatas_success').style.display = 'block';
                            document.getElementById('hargaatas_error').style.display = 'none';
                            document.getElementById('status_harga_atas').value = '1';
                            // console.log(parsed);
                            my_topprice.append("<dd class=" + 'col-sm-3 col-xs-12' + ">" + 'Harga Atas' + "</dd><dd class=" + 'col-sm-1 col-xs-12' + ">:</dd><dd id=" + 'maxtp' + "  class=" + 'col-sm-3 col-xs-12' + ">Rp. " + formatRupiah(parsed.harga_atas_gb) + "</dd>");

                        }
                    }
                });
                $.ajax({
                    type: "GET",
                    url: url4,
                    success: function(response) {
                        var my_buttomprice = $('#input_hargabawah')
                        var parsed = JSON.parse(response);
                        // console.log(parsed);
                        if (parsed == null || parsed == '') {
                            document.getElementById('hargabawah_success').style.display = 'none';
                            document.getElementById('hargabawah_error').style.display = 'block';
                            document.getElementById('status_harga_bawah').value = '0';
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'SPV belum input HARGA BAWAH Sesuai Tanggal PO',
                                icon: 'warning',
                                allowOutsideClick: false,
                                showCancelButton: false,
                                showConfirmButton: false
                            })
                        } else {
                            document.getElementById('hargabawah_success').style.display = 'block';
                            document.getElementById('hargabawah_error').style.display = 'none';
                            document.getElementById('status_harga_bawah').value = '1';
                            my_buttomprice.append("<dd class=" + 'col-sm-3 col-xs-12' + ">" + 'Harga&nbsp;Bawah' + "</dd><dd class=" + 'col-sm-1 col-xs-12' + ">:</dd><dd id=" + 'maxtp' + "  class=" + 'col-sm-3 col-xs-12' + ">Rp. " + formatRupiah(parsed.harga_bawah_gb) + "</dd>");

                        }
                        // console.log(parsed);

                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $(document).on('click', '#btn_approve_bongkar', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Konfirmasi',
                    icon: 'warning',
                    text: "Apakah Kamu Yakin Data Sudah Benar ?",
                    showCancelButton: true,
                    inputValue: 0,
                    confirmButtonText: 'Yes',
                }).then(function(result) {
                    if (result.value) {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Proses Menyimpan Data...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                                $.ajax({
                                    type: "GET",
                                    url: "{{route('master.approve_lab1_qc_gb') }}/" + id,
                                    error: function() {
                                        alert('Something is wrong');
                                    },
                                    success: function(data) {
                                        $('#data_longgrain').DataTable().ajax.reload();
                                        $('#data_pw').DataTable().ajax.reload();
                                        $('#data_kp').DataTable().ajax.reload();
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: 'Data anda berhasil di Simpan.',
                                            icon: 'success',
                                            timer: 1500
                                        })
                                    }
                                });
                            }
                        });
                    } else {
                        Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                    }
                });
            });
            $(document).on('click', '#btn_update', function(e) {
                e.preventDefault();
                var status_plan_hpp = $('#status_plan_hpp').val();
                var status_harga_atas = $('#status_harga_atas').val();
                var status_harga_bawah = $('#status_harga_bawah').val();
                var id_gabahincoming_qc = $('#id_gabahincoming_qc').val();
                var tanggal_po = $('#tanggal_po').val();
                var date_bid = $('#date_bid').val();
                var lokasi_gt = $('#lokasi_gt').val();
                var waktu_penerimaan = $('#waktu_penerimaan').val();
                var keterangan_lab_1 = $('#keterangan_lab_1').val();
                var gabahincoming_id_penerimaan_po = $('#gabahincoming_id_penerimaan_po').val();
                var lab1_kode_po = $('#lab1_kode_po').val();
                var gabahincoming_id_data_po = $('#gabahincoming_id_data_po').val();
                var gabahincoming_plat = $('#gabahincoming_plat').val();
                var gabahincoming_kode_po = $('#gabahincoming_kode_po').val();
                var hampa = $('#hampa').val();
                var broken = $('#broken').val();
                var randoman = $('#randoman').val();
                var kadar_air = $('#kadar_air').val();
                var keterangan_lab = $('#keterangan_lab').val();
                var plan_harga = $('#plan_harga').val();
                var kg_after_adjust_hampa = $('#kg_after_adjust_hampa').val();
                var prosentasi_kg = $('#prosentasi_kg').val();
                var susut = $('#susut').val();
                var adjust_susut = $('#adjust_susut').val();
                var prsentase_ks_kg_after_adjust_susut = $('#prsentase_ks_kg_after_adjust_susut').val();
                var prsentase_kg_pk = $('#prsentase_kg_pk').val();
                var adjust_prosentase_kg_pk = $('#adjust_prosentase_kg_pk').val();
                var presentase_ks_pk = $('#presentase_ks_pk').val();
                var presentase_putih = $('#presentase_putih').val();
                var adjust_prosentase_kg_ke_putih = $('#adjust_prosentase_kg_ke_putih').val();
                var plan_rend_dari_ks_beras = $('#plan_rend_dari_ks_beras').val();
                var katul = $('#katul').val();
                var refraksi_broken = $('#refraksi_broken').val();
                var plan_harga_gabah = $('#plan_harga_gabah').val();
                var ka_kg = $('#ka_kg').val();
                var nama_supplier = $('#nama_supplier').val();
                var no_supplier = $('#no_supplier').val();
                var berat_sample_awal_ks = $('#berat_sample_awal_ks').val();
                var berat_sample_awal_kg = $('#berat_sample_awal_kg').val();
                var berat_sample_akhir_kg = $('#berat_sample_akhir_kg').val();
                var berat_sample_pk = $('#berat_sample_pk').val();
                var wh = $('#wh').val();
                var tp = $('#tp').val();
                var md = $('#md').val();
                var keterangan_lab1 = $('#keterangan_lab1').val();
                var status_pending = $('#status_pending').val();
                $('#btn_update').html('Menyimpan...');
                if (status_plan_hpp == '1' && status_harga_atas == '1' && status_harga_bawah == '1') {
                    Swal.fire({
                        title: 'Konfirmasi',
                        icon: 'warning',
                        text: "Apakah data yang kamu input sudah benar ?",
                        showCancelButton: true,
                        inputValue: 0,
                        confirmButtonText: 'Yes',
                    }).then(function(result) {
                        if (result.value) {
                            if ($('#keterangan_lab_1').val() == 'Unload') {
                                if ($('#kadar_air').val() == '' || $('#ka_kg').val() == '' || $('#berat_sample_awal_ks').val() == '' || $('#berat_sample_awal_kg').val() == '' || $('#berat_sample_akhir_kg').val() == '' || $('#berat_sample_pk').val() == '' || $('#randoman').val() == '' || $('#wh').val() == '' || $('#tp').val() == '' || $('#md').val() == '' || $('#keterangan_lab_1').find(":selected").val() == '' || $('#broken').val() == '' || $('#keterangan_lab1').val() == '') {
                                    Swal.fire({
                                        title: 'Gagal !',
                                        text: 'Data Harus Diisi.',
                                        icon: 'warning',
                                        timer: 1500
                                    })
                                    $('#btn_update').html('Simpan');
                                } else if ($('#plan_harga').val() == '' | $('#plan_harga').val() == '0') {
                                    Swal.fire({
                                        title: 'Mohon Dicek!',
                                        text: 'Harga Rp. 0 ',
                                        icon: 'warning',
                                        timer: 1500
                                    })
                                    $('#btn_update').html('Simpan');
                                } else {
                                    Swal.fire({
                                        title: 'Harap Tuggu Sebentar!',
                                        html: 'Proses Menyimpan Data...', // add html attribute if you want or remove
                                        allowOutsideClick: false,
                                        onBeforeOpen: () => {
                                            Swal.showLoading()
                                            $.ajax({
                                                data: {
                                                    "_token": "{{ csrf_token() }}",
                                                    id_gabahincoming_qc: id_gabahincoming_qc,
                                                    tanggal_po: tanggal_po,
                                                    date_bid: date_bid,
                                                    lokasi_gt: lokasi_gt,
                                                    waktu_penerimaan: waktu_penerimaan,
                                                    keterangan_lab_1: keterangan_lab_1,
                                                    gabahincoming_id_penerimaan_po: gabahincoming_id_penerimaan_po,
                                                    gabahincoming_id_data_po: gabahincoming_id_data_po,
                                                    gabahincoming_kode_po: gabahincoming_kode_po,
                                                    gabahincoming_plat: gabahincoming_plat,
                                                    hampa: hampa,
                                                    broken: broken,
                                                    randoman: randoman,
                                                    kadar_air: kadar_air,
                                                    keterangan_lab: keterangan_lab,
                                                    plan_harga: plan_harga,
                                                    kg_after_adjust_hampa: kg_after_adjust_hampa,
                                                    prosentasi_kg: prosentasi_kg,
                                                    susut: susut,
                                                    adjust_susut: adjust_susut,
                                                    prsentase_ks_kg_after_adjust_susut: prsentase_ks_kg_after_adjust_susut,
                                                    prsentase_kg_pk: prsentase_kg_pk,
                                                    adjust_prosentase_kg_pk: adjust_prosentase_kg_pk,
                                                    presentase_ks_pk: presentase_ks_pk,
                                                    presentase_putih: presentase_putih,
                                                    adjust_prosentase_kg_ke_putih: adjust_prosentase_kg_ke_putih,
                                                    plan_rend_dari_ks_beras: plan_rend_dari_ks_beras,
                                                    katul: katul,
                                                    refraksi_broken: refraksi_broken,
                                                    plan_harga_gabah: plan_harga_gabah,
                                                    ka_kg: ka_kg,
                                                    berat_sample_awal_ks: berat_sample_awal_ks,
                                                    berat_sample_awal_kg: berat_sample_awal_kg,
                                                    berat_sample_akhir_kg: berat_sample_akhir_kg,
                                                    berat_sample_pk: berat_sample_pk,
                                                    wh: wh,
                                                    tp: tp,
                                                    md: md,
                                                    status_pending: status_pending,
                                                    keterangan_lab1: keterangan_lab1,
                                                },
                                                url: "{{ route('master.update_proses1_gabah_basah') }}",
                                                type: "POST",
                                                dataType: 'json',
                                                success: function(data) {

                                                    // table.draw();
                                                    $('#data_longgrain').DataTable().ajax.reload();
                                                    $('#data_pw').DataTable().ajax.reload();
                                                    $('#data_kp').DataTable().ajax.reload();
                                                    $('#btn_update').html('Simpan');
                                                    $('#modal_outputlab1').modal('hide');
                                                    Swal.fire({
                                                        title: 'success',
                                                        Text: 'Data Berhasil DiSimpan',
                                                        icon: 'success',
                                                        timer: 1500
                                                    })

                                                },
                                                error: function(data) {
                                                    $('#btn_update').html('Simpan');
                                                    $('#modal_outputlab1').modal('hide');
                                                    Swal.fire({
                                                        title: 'Gagal',
                                                        text: 'Data Tidak Tersimpan ',
                                                        icon: 'error',
                                                        timer: 1500

                                                    })

                                                }
                                            });
                                        },
                                    });
                                    // Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
                                }
                            } else if ($('#keterangan_lab_1').val() == 'Pending') {
                                if ($('#kadar_air').val() == '' || $('#ka_kg').val() == '' || $('#berat_sample_awal_ks').val() == '' || $('#berat_sample_awal_kg').val() == '' || $('#berat_sample_akhir_kg').val() == '' || $('#berat_sample_pk').val() == '' || $('#randoman').val() == '' || $('#wh').val() == '' || $('#tp').val() == '' || $('#md').val() == '' || $('#keterangan_lab_1').find(":selected").val() == '' || $('#broken').val() == '' || $('#keterangan_lab1').val() == '') {
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: 'Data Tidak Diisi ',
                                        icon: 'warning',
                                        timer: 1500

                                    })
                                    $('#btn_update').html('Simpan');
                                } else if ($('#plan_harga').val() == '' | $('#plan_harga').val() == '0') {
                                    Swal.fire({
                                        title: 'Mohon Dicek!',
                                        text: 'Plan Harga Rp. 0',
                                        icon: 'warning',
                                        timer: 1500

                                    })
                                    $('#btn_update').html('Simpan');
                                } else {
                                    Swal.fire({
                                        title: 'Harap Tuggu Sebentar!',
                                        html: 'Proses Menyimpan Data...', // add html attribute if you want or remove
                                        allowOutsideClick: false,
                                        onBeforeOpen: () => {
                                            Swal.showLoading()
                                            $.ajax({
                                                data: {
                                                    "_token": "{{ csrf_token() }}",
                                                    id_gabahincoming_qc: id_gabahincoming_qc,
                                                    tanggal_po: tanggal_po,
                                                    date_bid: date_bid,
                                                    lokasi_gt: lokasi_gt,
                                                    waktu_penerimaan: waktu_penerimaan,
                                                    keterangan_lab_1: keterangan_lab_1,
                                                    gabahincoming_id_penerimaan_po: gabahincoming_id_penerimaan_po,
                                                    gabahincoming_id_data_po: gabahincoming_id_data_po,
                                                    gabahincoming_kode_po: gabahincoming_kode_po,
                                                    gabahincoming_plat: gabahincoming_plat,
                                                    hampa: hampa,
                                                    broken: broken,
                                                    randoman: randoman,
                                                    kadar_air: kadar_air,
                                                    nama_supplier: nama_supplier,
                                                    no_supplier: no_supplier,
                                                    keterangan_lab: keterangan_lab,
                                                    plan_harga: plan_harga,
                                                    kg_after_adjust_hampa: kg_after_adjust_hampa,
                                                    prosentasi_kg: prosentasi_kg,
                                                    susut: susut,
                                                    adjust_susut: adjust_susut,
                                                    prsentase_ks_kg_after_adjust_susut: prsentase_ks_kg_after_adjust_susut,
                                                    prsentase_kg_pk: prsentase_kg_pk,
                                                    adjust_prosentase_kg_pk: adjust_prosentase_kg_pk,
                                                    presentase_ks_pk: presentase_ks_pk,
                                                    presentase_putih: presentase_putih,
                                                    adjust_prosentase_kg_ke_putih: adjust_prosentase_kg_ke_putih,
                                                    plan_rend_dari_ks_beras: plan_rend_dari_ks_beras,
                                                    katul: katul,
                                                    refraksi_broken: refraksi_broken,
                                                    plan_harga_gabah: plan_harga_gabah,
                                                    ka_kg: ka_kg,
                                                    berat_sample_awal_ks: berat_sample_awal_ks,
                                                    berat_sample_awal_kg: berat_sample_awal_kg,
                                                    berat_sample_akhir_kg: berat_sample_akhir_kg,
                                                    berat_sample_pk: berat_sample_pk,
                                                    wh: wh,
                                                    tp: tp,
                                                    md: md,
                                                    status_pending: status_pending,
                                                    keterangan_lab1: keterangan_lab1,
                                                },
                                                url: "{{ route('master.update_proses1_gabah_basah') }}",
                                                type: "POST",
                                                dataType: 'json',
                                                success: function(response) {

                                                    // table.draw();
                                                    $('#data_longgrain').DataTable().ajax.reload();
                                                    $('#data_pw').DataTable().ajax.reload();
                                                    $('#data_kp').DataTable().ajax.reload();
                                                    $('#btn_update').html('Simpan');
                                                    $('#modal_outputlab1').modal('hide');
                                                    Swal.fire({
                                                        title: 'success',
                                                        Text: 'Data Berhasil DiSimpan',
                                                        icon: 'success',
                                                        timer: 1500
                                                    })

                                                },
                                                error: function(response) {
                                                    $('#btn_update').html('Simpan');
                                                    $('#modal_outputlab1').modal('hide');
                                                    Swal.fire({
                                                        title: 'Gagal',
                                                        text: 'Data Tidak Tersimpan ',
                                                        icon: 'error',
                                                        timer: 1500
                                                    })

                                                }
                                            });
                                        },
                                    });
                                }
                            } else if ($('#keterangan_lab_1').val() == 'Reject') {
                                if ($('#kadar_air').val() == '' || $('#ka_kg').val() == '' || $('#berat_sample_awal_ks').val() == '' || $('#berat_sample_awal_kg').val() == '' || $('#berat_sample_akhir_kg').val() == '' || $('#berat_sample_pk').val() == '' || $('#randoman').val() == '' || $('#wh').val() == '' || $('#tp').val() == '' || $('#md').val() == '' || $('#keterangan_lab_1').find(":selected").val() == '' || $('#broken').val() == '' || $('#keterangan_lab1').val() == '') {
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: 'Data Tidak Diisi ',
                                        icon: 'warning',
                                        timer: 1500

                                    })
                                    $('#btn_update').html('Simpan');
                                } else if ($('#plan_harga').val() == '' | $('#plan_harga').val() == '0') {
                                    Swal.fire({
                                        title: 'Mohon Dicek!',
                                        text: 'Plan Harga Rp. 0',
                                        icon: 'warning',
                                        timer: 1500

                                    })
                                    $('#btn_update').html('Simpan');
                                } else {
                                    Swal.fire({
                                        title: 'Harap Tuggu Sebentar!',
                                        html: 'Proses Menyimpan Data...', // add html attribute if you want or remove
                                        allowOutsideClick: false,
                                        onBeforeOpen: () => {
                                            Swal.showLoading()
                                            $.ajax({
                                                data: {
                                                    "_token": "{{ csrf_token() }}",
                                                    id_gabahincoming_qc: id_gabahincoming_qc,
                                                    tanggal_po: tanggal_po,
                                                    date_bid: date_bid,
                                                    lokasi_gt: lokasi_gt,
                                                    waktu_penerimaan: waktu_penerimaan,
                                                    keterangan_lab_1: keterangan_lab_1,
                                                    gabahincoming_id_penerimaan_po: gabahincoming_id_penerimaan_po,
                                                    gabahincoming_id_data_po: gabahincoming_id_data_po,
                                                    gabahincoming_plat: gabahincoming_plat,
                                                    gabahincoming_kode_po: gabahincoming_kode_po,
                                                    hampa: hampa,
                                                    broken: broken,
                                                    randoman: randoman,
                                                    kadar_air: kadar_air,
                                                    keterangan_lab: keterangan_lab,
                                                    plan_harga: plan_harga,
                                                    kg_after_adjust_hampa: kg_after_adjust_hampa,
                                                    prosentasi_kg: prosentasi_kg,
                                                    susut: susut,
                                                    nama_supplier: nama_supplier,
                                                    no_supplier: no_supplier,
                                                    adjust_susut: adjust_susut,
                                                    prsentase_ks_kg_after_adjust_susut: prsentase_ks_kg_after_adjust_susut,
                                                    prsentase_kg_pk: prsentase_kg_pk,
                                                    adjust_prosentase_kg_pk: adjust_prosentase_kg_pk,
                                                    presentase_ks_pk: presentase_ks_pk,
                                                    presentase_putih: presentase_putih,
                                                    adjust_prosentase_kg_ke_putih: adjust_prosentase_kg_ke_putih,
                                                    plan_rend_dari_ks_beras: plan_rend_dari_ks_beras,
                                                    katul: katul,
                                                    refraksi_broken: refraksi_broken,
                                                    plan_harga_gabah: plan_harga_gabah,
                                                    ka_kg: ka_kg,
                                                    berat_sample_awal_ks: berat_sample_awal_ks,
                                                    berat_sample_awal_kg: berat_sample_awal_kg,
                                                    berat_sample_akhir_kg: berat_sample_akhir_kg,
                                                    berat_sample_pk: berat_sample_pk,
                                                    wh: wh,
                                                    tp: tp,
                                                    md: md,
                                                    status_pending: status_pending,
                                                    keterangan_lab1: keterangan_lab1,
                                                },
                                                url: "{{ route('master.update_proses1_gabah_basah') }}",
                                                type: "POST",
                                                dataType: 'json',
                                                success: function(data) {

                                                    // table.draw();
                                                    $('#data_longgrain').DataTable().ajax.reload();
                                                    $('#data_pw').DataTable().ajax.reload();
                                                    $('#data_kp').DataTable().ajax.reload();
                                                    $('#btn_update').html('Simpan');
                                                    $('#modal_outputlab1').modal('hide');
                                                    Swal.fire({
                                                        title: 'success',
                                                        Text: 'Data Berhasil DiSimpan',
                                                        icon: 'success',
                                                        timer: 1500
                                                    })

                                                },
                                                error: function(data) {
                                                    $('#btn_update').html('Simpan');
                                                    $('#modal_outputlab1').modal('hide');
                                                    Swal.fire({
                                                        title: 'Gagal',
                                                        text: 'Data Tidak Tersimpan ',
                                                        icon: 'error',
                                                        timer: 1500

                                                    })

                                                }
                                            });
                                        },
                                    });
                                }
                            } else {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: 'Data Tidak Tersimpan ',
                                    icon: 'error',
                                    timer: 1500

                                })
                                $('#btn_update').html('Simpan');
                            }
                        } else {
                            Swal.fire({
                                title: 'Gagal',
                                text: 'Data Tidak Tersimpan ',
                                icon: 'error',
                                timer: 1500

                            })
                            $('#btn_update').html('Simpan');

                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Maaf, Anda Tidak Bisa Input',
                        text: 'SPV belum input Parameter Lab',
                        icon: 'warning',
                        allowOutsideClick: false
                    })
                    $('#btn_update').html('Simpan');
                }
            });
            $(document).on('click', '#btn_bongkar', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Konfirmasi',
                    icon: 'warning',
                    text: "Apakah Kamu Yakin Data Sudah Benar ?",
                    showCancelButton: true,
                    inputValue: 0,
                    confirmButtonText: 'Yes',
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            type: "GET",
                            url: "{{route('master.approve_lab1_gb') }}/" + id,
                            error: function() {
                                alert('Something is wrong');
                            },
                            success: function(data) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Data anda berhasil di Simpan.',
                                    icon: 'success',
                                    timer: 1500
                                })
                                $('#datatable_gabah_basah').DataTable().ajax.reload();
                                $('#datatable_gabah_basah1').DataTable().ajax.reload();
                                $('#datatable_gabah_basah2').DataTable().ajax.reload();
                                $('#datatable_gabah_basah3').DataTable().ajax.reload();
                            }
                        });

                    } else {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Data Tidak Tersimpan ',
                            icon: 'error',
                            timer: 1500

                        })

                    }
                });
            });
            $(document).on('click', '.lokasi_bongkar', function() {
                var id = $(this).attr("name");
                var url = "{{ route('master.lokasi_bongkar') }}" + "/" + id;
                // console.log(url);
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        // console.log(response);
                        var parsed = $.parseJSON(response);
                        $('#lokasi_bongkar').text(parsed.lokasi_bongkar);
                        $('#nomer_antrian').text(parsed.antrian);
                    }
                });
            });
        });
    </script>

    <script>
        var gabahincoming_id_penerimaan_po = document.getElementById('gabahincoming_id_penerimaan_po');

        var kadar_air = document.getElementById('kadar_air');
        var ka_kg = document.getElementById('ka_kg');
        var berat_sample_awal_ks = document.getElementById('berat_sample_awal_ks');
        var berat_sample_awal_kg = document.getElementById('berat_sample_awal_kg');
        var berat_sample_akhir_kg = document.getElementById('berat_sample_akhir_kg');
        var berat_sample_pk = document.getElementById('berat_sample_pk');
        var randoman = document.getElementById('randoman');
        var wh = document.getElementById('wh');
        var tp = document.getElementById('tp');
        var md = document.getElementById('md');
        var broken = document.getElementById('broken');
        // hidden
        var kg_after_adjust_hampa = document.getElementById('kg_after_adjust_hampa');
        var prosentasi_kg = document.getElementById('prosentasi_kg');
        var susut = document.getElementById('susut');
        var adjust_susut = document.getElementById('adjust_susut');
        var prsentase_ks_kg_after_adjust_susut = document.getElementById('prsentase_ks_kg_after_adjust_susut');
        var prsentase_kg_pk = document.getElementById('prsentase_kg_pk');
        var adjust_prosentase_kg_pk = document.getElementById('adjust_prosentase_kg_pk');
        var presentase_ks_pk = document.getElementById('presentase_ks_pk');
        var presentase_putih = document.getElementById('presentase_putih');
        var adjust_prosentase_kg_ke_putih = document.getElementById('adjust_prosentase_kg_ke_putih');
        var plan_rend_dari_ks_beras = document.getElementById('plan_rend_dari_ks_beras');
        var katul = document.getElementById('katul');
        var refraksi_broken = document.getElementById('refraksi_broken');
        var plan_harga_gabah = document.getElementById('plan_harga_gabah');
        var hampa = document.getElementById('hampa');
        var status_pending = document.getElementById('status_pending');
        var item = document.getElementById('item');
        var plan_harga = document.getElementById('plan_harga');

        function validasi() {
            var id_penerimaan = id_penerimaan_po_gb.value;
            $.ajax({
                type: "GET",
                url: "{{route('get_count_plan_hpp_gabah_basah')}}" + "/" + id_penerimaan + "/" + item.value,
                async: false,
                success: function(data) {
                    var record = JSON.parse(data);
                    // console.log(record)
                    if (record == '0') {
                        Swal.fire({
                            title: 'Maaf, Anda Tidak Bisa Input',
                            text: 'SPV belum input PLAN HPP Sesuai Tanggal PO: ' + tanggal_po_gb.value + ' dan Item :' + item.value,
                            icon: 'warning',
                            allowOutsideClick: false
                        })
                    } else {
                        console.log('Plan HPP Sudah Terisi');
                    }
                }
            });
            $.ajax({
                type: "GET",
                url: "{{route('get_price_top_gabah_basah')}}" + "/" + id_penerimaan,
                async: false,
                success: function(data) {
                    var record = JSON.parse(data);
                    // console.log(record)
                    if (record == null || record == '') {
                        Swal.fire({
                            title: 'Maaf, Anda Tidak Bisa Input',
                            text: 'SPV Belum input HARGA ATAS Sesuai Tanggal PO',
                            icon: 'warning',
                            allowOutsideClick: false
                        })
                    } else {
                        console.log('harga atas sudah terisi')
                    }
                }
            });
            $.ajax({
                type: "GET",
                url: "{{route('get_buttom_price_gabah_basah')}}" + "/" + id_penerimaan,
                async: false,
                success: function(data) {
                    var record = JSON.parse(data);
                    // console.log(record)
                    if (record == null || record == '') {
                        Swal.fire({
                            title: 'Maaf, Anda Tidak Bisa Input',
                            text: 'Harap input HARGA BAWAH Sesuai Tanggal PO',
                            icon: 'warning',
                            allowOutsideClick: false
                        })
                    } else {
                        console.log('Harga Bawah Sudah Terisi')
                    }
                }
            });
        }

        function rumus() {
            if (kadar_air.value == 0 || kadar_air.value == '' ||
                ka_kg.value == 0 || ka_kg.value == '' ||
                berat_sample_awal_ks.value == 0 || berat_sample_awal_ks.value == '' ||
                berat_sample_awal_kg.value == 0 || berat_sample_awal_kg.value == '' ||
                berat_sample_akhir_kg.value == 0 || berat_sample_akhir_kg.value == '' ||
                berat_sample_pk.value == 0 || berat_sample_pk.value == '' ||
                randoman.value == 0 || randoman.value == '' ||
                wh.value == 0 || wh.value == '' ||
                tp.value == 0 || tp.value == '' ||
                md.value == 0 || md.value == '' ||
                broken.value == 0 || broken.value == '') {
                plan_harga.value = "0";

            } else {
                var id_penerimaan = gabahincoming_id_penerimaan_po.value;
                kg_after_adjust_hampa.value = berat_sample_akhir_kg.value;
                var perhitungan_prosentasi_kg = parseFloat(kg_after_adjust_hampa.value) / 1.5
                prosentasi_kg.value = round(perhitungan_prosentasi_kg, 1);
                var perhitungan_susut = 100 - round(perhitungan_prosentasi_kg, 2)
                susut.value = round(perhitungan_susut, 1);
                var perhitungan_adjust_susut = round(perhitungan_susut, 2) * 1.2;
                adjust_susut.value = round(perhitungan_adjust_susut, 1);
                var perhitungan_prsentase_ks_kg_after_adjust_susut = 100 - round(perhitungan_adjust_susut, 2);
                prsentase_ks_kg_after_adjust_susut.value = round(perhitungan_prsentase_ks_kg_after_adjust_susut, 1);

                var perhitungan_prsentase_kg_pk = (berat_sample_pk.value / (kg_after_adjust_hampa.value / 100));
                prsentase_kg_pk.value = round(perhitungan_prsentase_kg_pk, 1);
                var perhitungan_adjust_prosentase_kg_pk = round(perhitungan_prsentase_kg_pk, 2) * 0.952;
                adjust_prosentase_kg_pk.value = round(perhitungan_adjust_prosentase_kg_pk, 1);
                var perhitungan_presentase_ks_pk = round(perhitungan_prsentase_ks_kg_after_adjust_susut, 2) * (round(perhitungan_adjust_prosentase_kg_pk, 2) / 100);
                presentase_ks_pk.value = round(perhitungan_presentase_ks_pk, 1);
                var perhitungan_presentase_putih = randoman.value / (kg_after_adjust_hampa.value / 100);
                presentase_putih.value = round(perhitungan_presentase_putih, 1);
                var perhitungan_adjust_prosentase_kg_ke_putih = round(perhitungan_presentase_putih, 2) * 0.952;
                adjust_prosentase_kg_ke_putih.value = round(perhitungan_adjust_prosentase_kg_ke_putih, 1);
                var perhitungan_plan_rend_dari_ks_beras = (100 - round(perhitungan_adjust_susut, 2)) * (round(perhitungan_adjust_prosentase_kg_ke_putih, 2) / 100);
                plan_rend_dari_ks_beras.value = round(perhitungan_plan_rend_dari_ks_beras, 1);
                var perhitungan_katul = ((round(perhitungan_adjust_prosentase_kg_pk, 2) - round(perhitungan_adjust_prosentase_kg_ke_putih, 2)) / round(perhitungan_adjust_prosentase_kg_pk, 2)) * 100;
                katul.value = round(perhitungan_katul, 1);
                var perhitungan_refraksi_broken = "0";
                var h_broken = broken.value;

                // get plan hpp

                var elems = document.querySelectorAll(".hpp");
                // console.log(elems);

                var std_hpp_incoming = 0;
                [].forEach.call(elems, function(el) {
                    var plan_hpp = el.value;
                    // console.log(plan_hpp);
                    arr_hpp = plan_hpp.split("#");
                    // console.log(arr_hpp[2]);
                    if (tp.value >= arr_hpp[0] && tp.value <= arr_hpp[1]) {
                        std_hpp_incoming = arr_hpp[2];
                    } else if (tp.value >= arr_hpp[1]) {
                        std_hpp_incoming = arr_hpp[2];

                    }
                    // console.log(std_hpp_incoming);

                    //                     }

                });
                // console.log(min_tp,max_tp, harga_hpp);
                var perhitungan_plan_harga_gabah = ((round(perhitungan_plan_rend_dari_ks_beras, 2) / 100) * std_hpp_incoming) - 75;
                plan_harga_gabah.value = round(perhitungan_plan_harga_gabah, 0);
                hasil = plan_harga_gabah.value;
                // console.log(hasil);

                // if (plan_harga_gabah.value == 0 || plan_harga_gabah.value == '') {
                //     hasil = "0";
                // } else {
                //     if (status_gabah == "UTARA" || status_gabah == "SELATAN") {
                //         var perhitungan_hasil = plan_harga_gabah.value - refraksi_broken.value;
                //         hasil = round(perhitungan_hasil, 2);
                //     } else {
                //         var perhitungan_hasil = plan_harga_gabah.value - refraksi_broken.value;
                //         hasil = round(perhitungan_hasil);

                //     }
                // }
                $.ajax({
                    type: "GET",
                    url: "{{route('get_price_top_gabah_basah')}}" + "/" + id_penerimaan,
                    async: false,
                    success: function(data) {
                        var record = JSON.parse(data);
                        // console.log(record)
                        if (record == null || record == '') {
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'SPV Belum input HARGA ATAS Sesuai Tanggal PO',
                                icon: 'warning',
                                allowOutsideClick: false
                            })
                        }
                    }
                });
                $.ajax({
                    type: "GET",
                    url: "{{route('get_buttom_price_gabah_basah')}}" + "/" + id_penerimaan,
                    async: false,
                    success: function(data) {
                        var record = JSON.parse(data);
                        // console.log(record)
                        if (record == null || record == '') {
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'SPV Belum input HARGA BAWAH Sesuai Tanggal PO',
                                icon: 'warning',
                                allowOutsideClick: false
                            })
                        } else {
                            harga_bawah = record.harga_bawah_gb
                            min_harga_bawah = record.min_toleransi_harga_bawah_gb
                            max_harga_bawah = record.max_toleransi_harga_bawah_gb
                        }
                    }
                });
                $.ajax({
                    type: "GET",
                    url: "{{route('get_count_plan_hpp_gabah_basah')}}" + "/" + id_penerimaan + "/" + item.value,
                    async: false,
                    success: function(data) {
                        var record = JSON.parse(data);
                        // console.log(record)
                        if (record == '0') {
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'SPV Belum input PLAN HPP Sesuai Tanggal PO: ' + tanggal_po.value + ' dan Item :' + item.value,
                                icon: 'warning',
                                allowOutsideClick: false
                            })
                        }
                    }
                });
                var harga_bawah_gb = harga_bawah - min_harga_bawah;
                var harga_bawah_gb1 = harga_bawah - max_harga_bawah;
                console.log(harga_bawah_gb);
                console.log(harga_bawah_gb1);
                if (hasil == 0 || hasil == '') {
                    plan_harga.value = "0";
                } else if (hasil >= harga_bawah_gb1 && hasil <= harga_bawah_gb) {
                    console.log("konfirmasi");
                    $('#keterangan_lab_1 > option[value="Pending"]').prop('selected', true);
                    $('#keterangan_lab_1 > option[value="Reject"]').attr('selected', false);
                    $('#keterangan_lab_1 > option[value="Unload"]').attr('selected', false);
                    $('#keterangan_lab_1 > option[value="Unload"]').attr('disabled', true);
                    $('#keterangan_lab_1 > option[value="Pending"]').attr('disabled', false);
                    $('#keterangan_lab_1 > option[value="Reject"]').attr('disabled', false);
                    status_pending.value = 'Pending Harga';
                } else if (hasil <= harga_bawah_gb1) {
                    $('#keterangan_lab_1 > option[value="Reject"]').prop('selected', true);
                    $('#keterangan_lab_1 > option[value="Pending"]').attr('selected', false);
                    $('#keterangan_lab_1 > option[value="Unload"]').attr('selected', false);
                    $('#keterangan_lab_1 > option[value="Pending"]').attr('disabled', true);
                    $('#keterangan_lab_1 > option[value="Unload"]').attr('disabled', true);
                    $('#keterangan_lab_1 > option[value="Reject"]').attr('disabled', false);
                    console.log("tolak");
                } else {
                    console.log("bongkar");
                    $('#keterangan_lab_1 > option[value="Unload"]').prop('selected', true);
                    $('#keterangan_lab_1 > option[value="Pending"]').attr('selected', false);
                    $('#keterangan_lab_1 > option[value="reject"]').attr('selected', false);
                    $('#keterangan_lab_1 > option[value="Unload"]').attr('disabled', false);
                    $('#keterangan_lab_1 > option[value="Pending"]').attr('disabled', false);
                    $('#keterangan_lab_1 > option[value="reject"]').attr('disabled', false);
                }
                var perhitungan_hampa = (berat_sample_awal_kg.value - berat_sample_akhir_kg.value) / (berat_sample_awal_kg.value / 100);
                hampa.value = round(perhitungan_hampa, 1);
                console.log("id_penerimaan = " + id_penerimaan);
                console.log("Hampa = " + round(perhitungan_hampa, 8));
                console.log("kg after djust hampa = " + kg_after_adjust_hampa.value);
                console.log("prosentasi kg = " + round(perhitungan_prosentasi_kg, 2));

                console.log("susut = " + round(perhitungan_susut, 2));
                console.log("adjust susut = " + round(perhitungan_adjust_susut, 2));
                console.log("presentase ks kg after adjust = " + round(perhitungan_prsentase_ks_kg_after_adjust_susut, 2));
                console.log("prsentase kg pk = " + round(perhitungan_prsentase_kg_pk, 2));
                console.log("adjust prosentase kg pk = " + round(perhitungan_adjust_prosentase_kg_pk, 2));
                console.log("presentase ks pk = " + round(perhitungan_presentase_ks_pk, 2));
                console.log("presentase putih = " + round(perhitungan_presentase_putih, 2));
                console.log("adjust prosentase kg ke putih = " + round(perhitungan_adjust_prosentase_kg_ke_putih, 2));
                console.log("Katul = " + round(perhitungan_katul, 2));
                console.log("plan rend dari ks beras = " + round(perhitungan_plan_rend_dari_ks_beras, 3));
                console.log("PLAN = " + std_hpp_incoming);
                console.log("refraksi broken = " + refraksi_broken.value);
                console.log("plan harga gabah = " + plan_harga_gabah.value);
                console.log("hasil akhir = " + round(perhitungan_plan_harga_gabah, 1));

                plan_harga.value = hasil;
            }
        }
        var typingTimer; //timer identifier
        var doneTypingInterval = 2000;

        gabahincoming_id_penerimaan_po.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });

        kadar_air.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        ka_kg.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        berat_sample_awal_ks.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        berat_sample_awal_kg.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        berat_sample_akhir_kg.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        berat_sample_pk.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        randoman.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        wh.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        tp.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        md.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        broken.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });

        function round(value, exp) {
            if (typeof exp === 'undefined' || +exp === 0)
                return Math.round(value);

            value = +value;
            exp = +exp;

            if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
                return NaN;

            // Shift
            value = value.toString().split('e');
            value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));

            // Shift back
            value = value.toString().split('e');
            return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
        }

        var changeprice = false;

        // function newprice() {
        //     var id_penerimaan = gabahincoming_id_penerimaan_po.value;
        //     var radio = document.getElementsByName('lokasi_gt');
        //     var harga = document.getElementById('plan_harga').value;
        //     var potongan = 0;
        //     var hargabaru = 0;
        //     $.ajax({
        //         type: "GET",
        //         url: "{{route('get_price_gt4')}}" + "/" + id_penerimaan,
        //         async: false,
        //         success: function(data) {
        //             var record = JSON.parse(data);
        //             potongan = record.potongan_bongkar_gt_04;
        //         }
        //     });

        //     for (i = 0; i < radio.length; i++) {
        //         if (radio[i].checked) {
        //             if(radio[i].value=='SELATAN'){
        //                     if(changeprice==false){
        //                         // hargabaru=harga;
        //                         hargabaru=harga-potongan;
        //                         changeprice=true;
        //                     } else {
        //                         hargabaru1=parseInt(harga)+parseInt(potongan);
        //                         hargabaru=hargabaru1-potongan;
        //                         changeprice=true;
        //                     }
        //                 } else {
        //                     if(changeprice==false){
        //                         // hargabaru=harga;
        //                         hargabaru=harga-potongan;
        //                         changeprice=true;
        //                     } else {
        //                         hargabaru1=parseInt(harga)+parseInt(potongan);
        //                         hargabaru=hargabaru1-potongan;
        //                         changeprice=true;
        //                     }
        //                 }
        //             // // console.log(hargabaru,potongan);
        //             document.getElementById('plan_harga').value = hargabaru;
        //         }
        //     }
        // }
    </script>
    @endsection