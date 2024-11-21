@extends('dashboard.admin_qc.layout.main')
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
                            <i class="kt-menu__link-icon   flaticon2-laptop kt-font-success"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Lab 1 Gabah Basah
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item mt-3">
                            <a class="nav-link active" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-database"></i>GB LONG GRAIN </a>
                        </li>
                        <!-- <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_2"><i class="la la-database"></i>GB CIHERANG</a>
                        </li> -->
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_3"><i class="la la-database"></i>GB PANDAN WANGI</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_4"><i class="la la-database"></i>GB KETAN PUTIH</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
                            <table class="table table-bordered" id="data_longgrain">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:2%">No.&nbsp;Antrian</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Waktu&nbsp;Sampai</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;Asal&nbsp;</th>
                                        <th style="text-align: center;width:auto">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="tab-pane" id="m_tabs_3_2" role="tabpanel">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Waktu&nbsp;Sampai</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;Asal&nbsp;</th>
                                        <th style="text-align: center;width:auto">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div> -->
                        <div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
                            <table class="table table-bordered" id="data_pw">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:2%">No.&nbsp;Antrian</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Waktu&nbsp;Sampai</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;Asal&nbsp;</th>
                                        <th style="text-align: center;width:auto">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_4" role="tabpanel">
                            <table class="table table-bordered" id="data_kp">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:2%">No.&nbsp;Antrian</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Waktu&nbsp;Sampai</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;Asal&nbsp;</th>
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


        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form class="m-form m-form--fit m-form--label-align-right">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Data Lab</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="">
                                    <h1>The data has been entered</h1>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form class="m-form m-form--fit m-form--label-align-right">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Lab Results</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="">
                                    <h1 id="lokasi_bongkar"></h1>
                                </div>
                                <div class="">
                                    <h1 id="antrian_bongkar"></h1>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_proseslab1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="formproseslab1" class="m-form m-form--fit m-form--label-align-right" method="post" action="javascript:void(0);" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Data Lab 1</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" id="lab1_id_data_po_gb" name="lab1_id_data_po_gb">
                            <input type="hidden" id="id_penerimaan_po_gb" name="id_penerimaan_po_gb">
                            <input type="hidden" id="lab1_id_bid_user_gb" name="lab1_id_bid_user_gb">
                            <input type="hidden" id="tanggal_po_gb" name="tanggal_po_gb">
                            <input type="hidden" id="waktu_penerimaan_gb" name="waktu_penerimaan_gb">
                            <input type="hidden" id="date_bid_gb" name="date_bid_gb">
                            <input type="hidden" id="nama_supplier" name="nama_supplier">
                            <input type="hidden" id="no_supplier" name="no_supplier">

                            {{-- tambahan input --}}
                            <input type="hidden" id="hampa_gb" name="hampa_gb">
                            <input type="hidden" id="kg_after_adjust_hampa_gb" name="kg_after_adjust_hampa_gb">
                            <input type="hidden" id="prosentasi_kg_gb" name="prosentasi_kg_gb">
                            <input type="hidden" id="susut_gb" name="susut_gb">
                            <input type="hidden" id="adjust_susut_gb" name="adjust_susut_gb">
                            <input type="hidden" id="prsentase_ks_kg_after_adjust_susut_gb" name="prsentase_ks_kg_after_adjust_susut_gb">
                            <input type="hidden" id="prsentase_kg_pk_gb" name="prsentase_kg_pk_gb">
                            <input type="hidden" id="adjust_prosentase_kg_pk_gb" name="adjust_prosentase_kg_pk_gb">
                            <input type="hidden" id="presentase_ks_pk_gb" name="presentase_ks_pk_gb">
                            <input type="hidden" id="presentase_putih_gb" name="presentase_putih_gb">
                            <input type="hidden" id="adjust_prosentase_kg_ke_putih_gb" name="adjust_prosentase_kg_ke_putih_gb">
                            <input type="hidden" id="plan_rend_dari_ks_beras_gb" name="plan_rend_dari_ks_beras_gb">
                            <input type="hidden" id="katul_gb" name="katul_gb">
                            <input type="hidden" id="refraksi_broken_gb" name="refraksi_broken_gb">
                            <input type="hidden" id="plan_harga_gabah_gb" name="plan_harga_gabah_gb">
                            <input type="hidden" id="PONum" name="PONum">
                            <input type="hidden" id="item" name="item">
                            <input type="hidden" id="antrian" name="antrian">
                            <input type="hidden" id="status_pending" name="status_pending">
                            <input type="hidden" id="status_plan_hpp" name="status_plan_hpp">
                            <input type="hidden" id="status_harga_atas" name="status_harga_atas">
                            <input type="hidden" id="status_harga_bawah" name="status_harga_bawah">
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
                                    <label class="col-sm-12"><i class="fa fa-minus-circle"></i> Parameter PLAN HPP Belum Diisi SPV</label>
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
                                    <label class="col-sm-12"><i class="fa fa-minus-circle"></i> Parameter HARGA ATAS Belum Diisi SPV</label>
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
                                    <label class="col-sm-12"><i class="fa fa-minus-circle"></i> Parameter HARGA BAWAH Belum Diisi SPV</label>
                                </div>
                            </a>
                            <div class="form-group">
                                <div class="">
                                    <label>Kode PO</label>
                                    <input type="text" id="lab1_kode_po_gb" name="lab1_kode_po_gb" class="form-control m-input" readonly>
                                    <input type="hidden" id="lab1_plat_gb" readonly name="lab1_plat_gb" class="form-control m-input">
                                </div>
                            </div>
                            <div id="planhpp" class="form-group"></div>

                            {{-- edit form --}}
                            <div class="m-form__group form-group">
                                <label for="">KA KS</label>
                                <input type="text" step="any" required name="kadar_air_gb" id="kadar_air_gb" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">KA KG</label>
                                <input type="text" step="any" required name="ka_kg_gb" id="ka_kg_gb" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Berat Sample Awal KS</label>
                                <input type="text" step="any" required name="berat_sample_awal_ks_gb" id="berat_sample_awal_ks_gb" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Berat Sample Awal KG</label>
                                <input type="text" step="any" required name="berat_sample_awal_kg_gb" id="berat_sample_awal_kg_gb" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Berat Sample Akhir KG</label>
                                <input type="text" step="any" required name="berat_sample_akhir_kg_gb" id="berat_sample_akhir_kg_gb" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Berat Sample PK</label>
                                <input type="text" step="any" required name="berat_sample_pk_gb" id="berat_sample_pk_gb" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Berat Sample Beras</label>
                                <input type="text" step="any" required name="randoman_gb" id="randoman_gb" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">WH</label>
                                <input type="text" step="any" required name="wh_gb" id="wh_gb" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">TP</label>
                                <input type="text" step="any" required name="tp_gb" id="tp_gb" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">MD</label>
                                <input type="text" step="any" required name="md_gb" id="md_gb" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Broken Setelah Bongkar</label>
                                <input type="text" step="any" required name="broken_gb" id="broken_gb" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Status Lab</label>
                                <select class="form-select form-control m-input" id="keterangan_lab_1_gb" required name="keterangan_lab_1_gb" aria-label="Default select example">
                                    <option value="">--Hasil Lab 1--</option>
                                    <option name="keterangan_lab_1_gb" value="Unload">Bongkar</option>
                                    <option name="keterangan_lab_1_gb" value="Pending">Pending</option>
                                    <option name="keterangan_lab_1_gb" value="Reject">Tolak</option>
                                </select>
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Keterangan</label>
                                <input type="text" step="any" required name="keterangan_lab_gb" id="keterangan_lab_gb" class="form-control m-input">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Plan Harga (Kg)</label>
                                <input readonly type="text" step="any" required name="plan_harga_gb" id="plan_harga_gb" class="form-control m-input">
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Tutup</button>
                            <button id="btn_save" class="btn btn-success m-btn pull-right">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Content -->
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(function() {
        $(document).on('keypress', '#kadar_air_gb', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#ka_kg_gb', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#berat_sample_awal_ks_gb', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#berat_sample_awal_kg_gb', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#berat_sample_akhir_kg_gb', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#berat_sample_pk_gb', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#randoman_gb', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#wh_gb', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#tp_gb', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#md_gb', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#broken_gb', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
    });
    $(document).on('keyup', '#plan_harga_gb', function(e) {
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
    $(function() {
        var table = $('#data_longgrain').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('qc.lab.proses_lab1_gabah_basah_longgrain_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'antrian'
                },
                {
                    data: 'name_bid'
                },
                {
                    data: 'waktu_penerimaan'
                },
                {
                    data: 'kode_po'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'nama_vendor'
                },
                {
                    data: 'plat_kendaraan'
                },
                {
                    data: 'keterangan_penerimaan_po'
                },
                {
                    data: 'ckelola'
                }

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
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('qc.lab.proses_lab1_gabah_basah_pandan_wangi_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'antrian'
                },
                {
                    data: 'name_bid'
                },
                {
                    data: 'waktu_penerimaan'
                },
                {
                    data: 'kode_po'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'nama_vendor'
                },
                {
                    data: 'plat_kendaraan'
                },
                {
                    data: 'keterangan_penerimaan_po'
                },
                {
                    data: 'ckelola'
                }

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
        var table3 = $('#data_kp').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('qc.lab.proses_lab1_gabah_basah_ketan_putih_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'antrian'
                },
                {
                    data: 'name_bid'
                },
                {
                    data: 'waktu_penerimaan'
                },
                {
                    data: 'kode_po'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'nama_vendor'
                },
                {
                    data: 'plat_kendaraan'
                },
                {
                    data: 'keterangan_penerimaan_po'
                },
                {
                    data: 'ckelola'
                }

            ],
            createdRow: function(row, data, index) {

                // Updated Schedule Week 1 - 07 Mar 22

                if (data.name_bid == 'GABAH BASAH CIHERANG') {
                    $('td:eq(2)', row).css('color', '#000099'); //Original Date
                } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                    $('td:eq(2)', row).css('color', '#009900'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                    $('td:eq(2)', row).css('color', '#330019'); // Behind of Original Date
                }
            },
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table3.columns.adjust().draw().responsive.recalc();
        })
    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '#btn_save', function(e) {
            e.preventDefault();
            var status_plan_hpp = $('#status_plan_hpp').val();
            var status_harga_atas = $('#status_harga_atas').val();
            var status_harga_bawah = $('#status_harga_bawah').val();
            var tanggal_po_gb = $('#tanggal_po_gb').val();
            var date_bid_gb = $('#date_bid_gb').val();
            var lokasi_gt_gb = $('#lokasi_gt_gb').val();
            var waktu_penerimaan_gb = $('#waktu_penerimaan_gb').val();
            var keterangan_lab_1_gb = $('#keterangan_lab_1_gb').val();
            var id_penerimaan_po_gb = $('#id_penerimaan_po_gb').val();
            var lab1_kode_po_gb = $('#lab1_kode_po_gb').val();
            var id_penerimaan_po_gb = $('#id_penerimaan_po_gb').val();
            var lab1_id_data_po_gb = $('#lab1_id_data_po_gb').val();
            var lab1_id_bid_user_gb = $('#lab1_id_bid_user_gb').val();
            var lab1_plat_gb = $('#lab1_plat_gb').val();
            var hampa_gb = $('#hampa_gb').val();
            var broken_gb = $('#broken_gb').val();
            var randoman_gb = $('#randoman_gb').val();
            var kadar_air_gb = $('#kadar_air_gb').val();
            var keterangan_lab_gb = $('#keterangan_lab_gb').val();
            var plan_harga_gb = $('#plan_harga_gb').val();
            var kg_after_adjust_hampa_gb = $('#kg_after_adjust_hampa_gb').val();
            var prosentasi_kg_gb = $('#prosentasi_kg_gb').val();
            var susut_gb = $('#susut_gb').val();
            var adjust_susut_gb = $('#adjust_susut_gb').val();
            var prsentase_ks_kg_after_adjust_susut_gb = $('#prsentase_ks_kg_after_adjust_susut_gb').val();
            var prsentase_kg_pk_gb = $('#prsentase_kg_pk_gb').val();
            var adjust_prosentase_kg_pk_gb = $('#adjust_prosentase_kg_pk_gb').val();
            var presentase_ks_pk_gb = $('#presentase_ks_pk_gb').val();
            var presentase_putih_gb = $('#presentase_putih_gb').val();
            var adjust_prosentase_kg_ke_putih_gb = $('#adjust_prosentase_kg_ke_putih_gb').val();
            var plan_rend_dari_ks_beras_gb = $('#plan_rend_dari_ks_beras_gb').val();
            var katul_gb = $('#katul_gb').val();
            var refraksi_broken_gb = $('#refraksi_broken_gb').val();
            var plan_harga_gabah_gb = $('#plan_harga_gabah_gb').val();
            var ka_kg_gb = $('#ka_kg_gb').val();
            var berat_sample_awal_ks_gb = $('#berat_sample_awal_ks_gb').val();
            var berat_sample_awal_kg_gb = $('#berat_sample_awal_kg_gb').val();
            var berat_sample_akhir_kg_gb = $('#berat_sample_akhir_kg_gb').val();
            var berat_sample_pk_gb = $('#berat_sample_pk_gb').val();
            var wh_gb = $('#wh_gb').val();
            var tp_gb = $('#tp_gb').val();
            var md_gb = $('#md_gb').val();
            var nama_supplier = $('#nama_supplier').val();
            var no_supplier = $('#no_supplier').val();
            var md_gb = $('#md_gb').val();
            var status_pending = $('#status_pending').val();
            $('#btn_save').html('Menyimpan...');
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
                        if ($('#keterangan_lab_1_gb').val() == 'Unload') {
                            if ($('#kadar_air_gb').val() == '' || $('#ka_kg_gb').val() == '' || $('#berat_sample_awal_ks_gb').val() == '' || $('#berat_sample_awal_kg_gb').val() == '' || $('#berat_sample_akhir_kg_gb').val() == '' || $('#berat_sample_pk_gb').val() == '' || $('#randoman_gb').val() == '' || $('#wh_gb').val() == '' || $('#tp_gb').val() == '' || $('#md_gb').val() == '' || $('#keterangan_lab_1_gb').find(":selected").val() == '' || $('#broken_gb').val() == '' || $('#keterangan_lab_gb').val() == '') {
                                Swal.fire({
                                    title: 'Gagal !',
                                    text: 'Data Harus Diisi.',
                                    icon: 'warning',
                                    timer: 1500
                                })
                                $('#btn_save').html('Simpan');
                            } else if ($('#plan_harga_gb').val() == '' | $('#plan_harga_gb').val() == '0') {
                                Swal.fire({
                                    title: 'Mohon Dicek!',
                                    text: 'Harga Rp. 0 ',
                                    icon: 'warning',
                                    timer: 1500
                                })
                                $('#btn_save').html('Simpan');
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
                                                status_harga_bawah: status_harga_bawah,
                                                status_harga_atas: status_harga_atas,
                                                status_plan_hpp: status_plan_hpp,
                                                tanggal_po_gb: tanggal_po_gb,
                                                date_bid_gb: date_bid_gb,
                                                lokasi_gt_gb: lokasi_gt_gb,
                                                waktu_penerimaan_gb: waktu_penerimaan_gb,
                                                keterangan_lab_1_gb: keterangan_lab_1_gb,
                                                id_penerimaan_po_gb: id_penerimaan_po_gb,
                                                lab1_kode_po_gb: lab1_kode_po_gb,
                                                id_penerimaan_po_gb: id_penerimaan_po_gb,
                                                lab1_id_data_po_gb: lab1_id_data_po_gb,
                                                lab1_id_bid_user_gb: lab1_id_bid_user_gb,
                                                lab1_plat_gb: lab1_plat_gb,
                                                hampa_gb: hampa_gb,
                                                nama_supplier: nama_supplier,
                                                no_supplier: no_supplier,
                                                broken_gb: broken_gb,
                                                randoman_gb: randoman_gb,
                                                kadar_air_gb: kadar_air_gb,
                                                keterangan_lab_gb: keterangan_lab_gb,
                                                plan_harga_gb: plan_harga_gb,
                                                kg_after_adjust_hampa_gb: kg_after_adjust_hampa_gb,
                                                prosentasi_kg_gb: prosentasi_kg_gb,
                                                susut_gb: susut_gb,
                                                adjust_susut_gb: adjust_susut_gb,
                                                prsentase_ks_kg_after_adjust_susut_gb: prsentase_ks_kg_after_adjust_susut_gb,
                                                prsentase_kg_pk_gb: prsentase_kg_pk_gb,
                                                adjust_prosentase_kg_pk_gb: adjust_prosentase_kg_pk_gb,
                                                presentase_ks_pk_gb: presentase_ks_pk_gb,
                                                presentase_putih_gb: presentase_putih_gb,
                                                adjust_prosentase_kg_ke_putih_gb: adjust_prosentase_kg_ke_putih_gb,
                                                plan_rend_dari_ks_beras_gb: plan_rend_dari_ks_beras_gb,
                                                katul_gb: katul_gb,
                                                refraksi_broken_gb: refraksi_broken_gb,
                                                plan_harga_gabah_gb: plan_harga_gabah_gb,
                                                ka_kg_gb: ka_kg_gb,
                                                berat_sample_awal_ks_gb: berat_sample_awal_ks_gb,
                                                berat_sample_awal_kg_gb: berat_sample_awal_kg_gb,
                                                berat_sample_akhir_kg_gb: berat_sample_akhir_kg_gb,
                                                berat_sample_pk_gb: berat_sample_pk_gb,
                                                wh_gb: wh_gb,
                                                tp_gb: tp_gb,
                                                md_gb: md_gb,
                                                status_pending: status_pending,
                                            },
                                            url: "{{ route('qc.lab.save_proseslab1_gabah_basah') }}",
                                            type: "POST",
                                            dataType: 'json',
                                            success: function(data) {

                                                // table.draw();
                                                $('#data_longgrain').DataTable().ajax.reload();
                                                $('#data_pw').DataTable().ajax.reload();
                                                $('#data_kp').DataTable().ajax.reload();
                                                $('#btn_save').html('Simpan');
                                                $('#modal_proseslab1').modal('hide');
                                                Swal.fire({
                                                    title: 'success',
                                                    Text: 'Data Berhasil DiSimpan',
                                                    icon: 'success',
                                                    timer: 1500
                                                })

                                            },
                                            error: function(data) {
                                                $('#btn_save').html('Simpan');
                                                $('#modal_proseslab1').modal('hide');
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
                        } else if ($('#keterangan_lab_1_gb').val() == 'Pending') {
                            if ($('#kadar_air_gb').val() == '' || $('#ka_kg_gb').val() == '' || $('#berat_sample_awal_ks_gb').val() == '' || $('#berat_sample_awal_kg_gb').val() == '' || $('#berat_sample_akhir_kg_gb').val() == '' || $('#berat_sample_pk_gb').val() == '' || $('#randoman_gb').val() == '' || $('#wh_gb').val() == '' || $('#tp_gb').val() == '' || $('#md_gb').val() == '' || $('#keterangan_lab_1_gb').find(":selected").val() == '' || $('#broken_gb').val() == '' || $('#keterangan_lab_gb').val() == '') {
                                Swal.fire({
                                    title: 'Gagal !',
                                    text: 'Data Harus Diisi.',
                                    icon: 'warning',
                                    timer: 1500
                                })
                                $('#btn_save').html('Simpan');
                            } else if ($('#plan_harga_gb').val() == '' | $('#plan_harga_gb').val() == '0') {
                                Swal.fire({
                                    title: 'Mohon Dicek!',
                                    text: 'Harga Rp. 0 ',
                                    icon: 'warning',
                                    timer: 1500
                                })
                                $('#btn_save').html('Simpan');
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
                                                tanggal_po_gb: tanggal_po_gb,
                                                date_bid_gb: date_bid_gb,
                                                lokasi_gt_gb: lokasi_gt_gb,
                                                waktu_penerimaan_gb: waktu_penerimaan_gb,
                                                keterangan_lab_1_gb: keterangan_lab_1_gb,
                                                id_penerimaan_po_gb: id_penerimaan_po_gb,
                                                lab1_kode_po_gb: lab1_kode_po_gb,
                                                id_penerimaan_po_gb: id_penerimaan_po_gb,
                                                lab1_id_data_po_gb: lab1_id_data_po_gb,
                                                lab1_id_bid_user_gb: lab1_id_bid_user_gb,
                                                lab1_plat_gb: lab1_plat_gb,
                                                hampa_gb: hampa_gb,
                                                broken_gb: broken_gb,
                                                nama_supplier: nama_supplier,
                                                no_supplier: no_supplier,
                                                randoman_gb: randoman_gb,
                                                kadar_air_gb: kadar_air_gb,
                                                keterangan_lab_gb: keterangan_lab_gb,
                                                plan_harga_gb: plan_harga_gb,
                                                kg_after_adjust_hampa_gb: kg_after_adjust_hampa_gb,
                                                prosentasi_kg_gb: prosentasi_kg_gb,
                                                susut_gb: susut_gb,
                                                adjust_susut_gb: adjust_susut_gb,
                                                prsentase_ks_kg_after_adjust_susut_gb: prsentase_ks_kg_after_adjust_susut_gb,
                                                prsentase_kg_pk_gb: prsentase_kg_pk_gb,
                                                adjust_prosentase_kg_pk_gb: adjust_prosentase_kg_pk_gb,
                                                presentase_ks_pk_gb: presentase_ks_pk_gb,
                                                presentase_putih_gb: presentase_putih_gb,
                                                adjust_prosentase_kg_ke_putih_gb: adjust_prosentase_kg_ke_putih_gb,
                                                plan_rend_dari_ks_beras_gb: plan_rend_dari_ks_beras_gb,
                                                katul_gb: katul_gb,
                                                refraksi_broken_gb: refraksi_broken_gb,
                                                plan_harga_gabah_gb: plan_harga_gabah_gb,
                                                ka_kg_gb: ka_kg_gb,
                                                berat_sample_awal_ks_gb: berat_sample_awal_ks_gb,
                                                berat_sample_awal_kg_gb: berat_sample_awal_kg_gb,
                                                berat_sample_akhir_kg_gb: berat_sample_akhir_kg_gb,
                                                berat_sample_pk_gb: berat_sample_pk_gb,
                                                wh_gb: wh_gb,
                                                tp_gb: tp_gb,
                                                md_gb: md_gb,
                                                status_pending: status_pending,
                                            },
                                            url: "{{ route('qc.lab.save_proseslab1_gabah_basah') }}",
                                            type: "POST",
                                            dataType: 'json',
                                            success: function(data) {

                                                // table.draw();
                                                $('#data_longgrain').DataTable().ajax.reload();
                                                $('#data_pw').DataTable().ajax.reload();
                                                $('#data_kp').DataTable().ajax.reload();
                                                $('#btn_save').html('Simpan');
                                                $('#modal_proseslab1').modal('hide');
                                                Swal.fire({
                                                    title: 'success',
                                                    Text: 'Data Berhasil DiSimpan',
                                                    icon: 'success',
                                                    timer: 1500
                                                })

                                            },
                                            error: function(data) {
                                                $('#btn_save').html('Simpan');
                                                $('#modal_proseslab1').modal('hide');
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
                        } else if ($('#keterangan_lab_1_gb').val() == 'Reject') {
                            if ($('#kadar_air_gb').val() == '' || $('#ka_kg_gb').val() == '' || $('#berat_sample_awal_ks_gb').val() == '' || $('#berat_sample_awal_kg_gb').val() == '' || $('#berat_sample_akhir_kg_gb').val() == '' || $('#berat_sample_pk_gb').val() == '' || $('#randoman_gb').val() == '' || $('#wh_gb').val() == '' || $('#tp_gb').val() == '' || $('#md_gb').val() == '' || $('#keterangan_lab_1_gb').find(":selected").val() == '' || $('#broken_gb').val() == '' || $('#keterangan_lab_gb').val() == '') {
                                Swal.fire({
                                    title: 'Gagal !',
                                    text: 'Data Harus Diisi.',
                                    icon: 'warning',
                                    timer: 1500
                                })
                                $('#btn_save').html('Simpan');
                            } else if ($('#plan_harga_gb').val() == '' | $('#plan_harga_gb').val() == '0') {
                                $('#btn_save').html('Simpan');
                                Swal.fire({
                                    title: 'Mohon Dicek!',
                                    text: 'Harga Rp. 0 ',
                                    icon: 'warning',
                                    timer: 1500
                                })
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
                                                tanggal_po_gb: tanggal_po_gb,
                                                date_bid_gb: date_bid_gb,
                                                lokasi_gt_gb: lokasi_gt_gb,
                                                waktu_penerimaan_gb: waktu_penerimaan_gb,
                                                keterangan_lab_1_gb: keterangan_lab_1_gb,
                                                id_penerimaan_po_gb: id_penerimaan_po_gb,
                                                lab1_kode_po_gb: lab1_kode_po_gb,
                                                id_penerimaan_po_gb: id_penerimaan_po_gb,
                                                lab1_id_data_po_gb: lab1_id_data_po_gb,
                                                lab1_id_bid_user_gb: lab1_id_bid_user_gb,
                                                lab1_plat_gb: lab1_plat_gb,
                                                hampa_gb: hampa_gb,
                                                broken_gb: broken_gb,
                                                nama_supplier: nama_supplier,
                                                no_supplier: no_supplier,
                                                randoman_gb: randoman_gb,
                                                kadar_air_gb: kadar_air_gb,
                                                keterangan_lab_gb: keterangan_lab_gb,
                                                plan_harga_gb: plan_harga_gb,
                                                kg_after_adjust_hampa_gb: kg_after_adjust_hampa_gb,
                                                prosentasi_kg_gb: prosentasi_kg_gb,
                                                susut_gb: susut_gb,
                                                adjust_susut_gb: adjust_susut_gb,
                                                prsentase_ks_kg_after_adjust_susut_gb: prsentase_ks_kg_after_adjust_susut_gb,
                                                prsentase_kg_pk_gb: prsentase_kg_pk_gb,
                                                adjust_prosentase_kg_pk_gb: adjust_prosentase_kg_pk_gb,
                                                presentase_ks_pk_gb: presentase_ks_pk_gb,
                                                presentase_putih_gb: presentase_putih_gb,
                                                adjust_prosentase_kg_ke_putih_gb: adjust_prosentase_kg_ke_putih_gb,
                                                plan_rend_dari_ks_beras_gb: plan_rend_dari_ks_beras_gb,
                                                katul_gb: katul_gb,
                                                refraksi_broken_gb: refraksi_broken_gb,
                                                plan_harga_gabah_gb: plan_harga_gabah_gb,
                                                ka_kg_gb: ka_kg_gb,
                                                berat_sample_awal_ks_gb: berat_sample_awal_ks_gb,
                                                berat_sample_awal_kg_gb: berat_sample_awal_kg_gb,
                                                berat_sample_akhir_kg_gb: berat_sample_akhir_kg_gb,
                                                berat_sample_pk_gb: berat_sample_pk_gb,
                                                wh_gb: wh_gb,
                                                tp_gb: tp_gb,
                                                md_gb: md_gb,
                                                status_pending: status_pending,
                                            },
                                            url: "{{ route('qc.lab.save_proseslab1_gabah_basah') }}",
                                            type: "POST",
                                            dataType: 'json',
                                            success: function(data) {

                                                // table.draw();
                                                $('#data_longgrain').DataTable().ajax.reload();
                                                $('#data_pw').DataTable().ajax.reload();
                                                $('#data_kp').DataTable().ajax.reload();
                                                $('#btn_save').html('Simpan');
                                                $('#modal_proseslab1').modal('hide');
                                                Swal.fire({
                                                    title: 'success',
                                                    Text: 'Data Berhasil DiSimpan',
                                                    icon: 'success',
                                                    timer: 1500
                                                })

                                            },
                                            error: function(data) {
                                                $('#btn_save').html('Simpan');
                                                $('#modal_proseslab1').modal('hide');
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
                        } else {
                            $('#btn_save').html('Simpan');
                            Swal.fire({
                                title: 'Gagal',
                                text: 'Data Tidak Tersimpan ',
                                icon: 'error',
                                timer: 1500

                            })
                        }
                    } else {
                        $('#btn_save').html('Simpan');
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Data Tidak Tersimpan ',
                            icon: 'error',
                            timer: 1500

                        })

                    }
                });
            } else {
                Swal.fire({
                    title: 'Maaf, Anda Tidak Bisa Input',
                    text: 'SPV belum input Parameter Lab',
                    icon: 'warning',
                    allowOutsideClick: false
                })
                $('#btn_save').html('Simpan');
            }
        });
        $(document).on('click', '#btn_notif', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Informasi',
                icon: 'warning',
                text: "Selesaikan Dahulu Di Output Lab 1",
                position: top
            })
        });
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
        $(document).on('click', '.proses_lab_1', function() {
            var id = $(this).attr("name");
            var vendor = $(this).data("vendor");
            var item = $(this).data("item");
            var tanggal_po = $(this).data('tanggalpo');
            // console.log(item);
            var url = "{{ route('qc.lab.gabah_incoming_qc') }}" + "/" + id;
            var url2 = "{{route('qc.lab.get_plan_hpp_gabah_basah') }}" + "/" + tanggal_po + "/" + item;
            var url3 = "{{route('get_price_top_gabah_basah') }}" + "/" + id;
            var url4 = "{{route('get_buttom_price_gabah_basah') }}" + "/" + id;
            // console.log(id);
            Swal.fire({
                title: 'Pengecekan Kode PO & Supplier ',
                icon: 'warning',
                text: "Apakah data yang di input security sudah benar ?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Benar',
                denyButtonText: 'Salah'
            }).then(function(result) {
                if (result.isConfirmed) {
                    $('#formproseslab1').trigger('reset');
                    //   $('#modal_proseslab1').removeData();
                    $('#modal_proseslab1').on('hidden.bs.modal', function(e) {
                        $('#input_hpp').remove();
                        // $('#min_tp').remove();
                        // $('#operation').remove();
                        // $('#max_tp').remove();
                        // $('#harga_hpp').remove();
                        $('#input_plan').empty();
                        $('#input_hargaatas').empty();
                        $('#input_hargabawah').empty();
                    })
                    $("#modal-data-body")
                        .empty()
                        .append(
                            '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>'
                        );
                    $('#modal_proseslab1').modal('show');
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(response) {
                            // console.log(response);
                            var parsed = $.parseJSON(response);
                            $('#id_penerimaan_po_gb').val(parsed.id_penerimaan_po);
                            $('#lab1_kode_po_gb').val(parsed.penerimaan_kode_po);
                            $('#lab1_id_data_po_gb').val(parsed.penerimaan_id_data_po);
                            $('#lab1_id_bid_user_gb').val(parsed.penerimaan_id_bid_user);
                            $('#lab1_plat_gb').val(parsed.plat_kendaraan);
                            $('#tanggal_po_gb').val(parsed.tanggal_po);
                            $('#date_bid_gb').val(parsed.date_bid);
                            $('#waktu_penerimaan_gb').val(parsed.waktu_penerimaan);
                            $('#min_tp_gb').val(parsed.min_tp);
                            $('#max_tp_gb').val(parsed.max_tp);
                            $('#harga_hpp_gb').val(parsed.harga);
                            $('#PONum').val(parsed.PONum);
                            $('#nama_supplier').val(parsed.name);
                            $('#no_supplier').val(parsed.nomer_hp);
                            $('#antrian').val(parsed.no_antrian);
                            $('#supplier').val(vendor);
                            $('#item').val(item);
                            $('#btn_save').prop('disabled', true);

                            // console.log(parsed.bid_user_id);
                        }
                    });

                    $.ajax({
                        type: "GET",
                        url: url2,
                        success: function(response) {
                            // console.log(response);
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
                                    my_plan.append("<dd id=" + 'min_tp' + " class=" + 'col-sm-3 col-xs-12' + ">" + parsed[item].min_tp_gb + "</dd><dd id=" + 'operation' + " class=" + 'col-sm-3 col-xs-12' + ">-</dd><dd id=" + 'max_tp' + "  class=" + 'col-sm-3 col-xs-12' + ">" + parsed[item].max_tp_gb + "</dd><dd id=" + 'harga_hpp' + "  class=" + 'col-sm-3 col-xs-12' + ">Rp. " + formatRupiah(parsed[item].harga_gb) + "</dd>");
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
                                    text: 'SPV belum input Harga Atas Sesuai Tanggal PO',
                                    icon: 'warning',
                                    allowOutsideClick: false,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                })
                            } else {
                                document.getElementById('hargaatas_success').style.display = 'block';
                                document.getElementById('hargaatas_error').style.display = 'none';
                                document.getElementById('status_harga_atas').value = '1';
                                my_topprice.append("<dd class=" + 'col-sm-3 col-xs-12' + ">" + 'Harga Atas' + "</dd><dd class=" + 'col-sm-1 col-xs-12' + ">:</dd><dd id=" + 'maxtp' + "  class=" + 'col-sm-3 col-xs-12' + ">Rp. " + formatRupiah(parsed.harga_atas_gb) + "</dd>");

                            }
                            // console.log(parsed);

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
                                    text: 'SPV belum input Harga Bawah Sesuai Tanggal PO',
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
                } else if (result.isDenied) {
                    $.ajax({
                        type: "GET",
                        url: "{{route('qc.lab.revisi_security')}}/" + id,
                        success: function(response) {
                            Swal.fire({
                                title: 'Sukses !',
                                text: 'Data Anda Dikembalikan ke Security',
                                icon: 'success',
                                timer: 1500
                            })
                            $('#data_longgrain').DataTable().ajax.reload();
                            $('#data_pw').DataTable().ajax.reload();
                            $('#data_kp').DataTable().ajax.reload();

                        },
                        error: function(response) {
                            Swal.fire({
                                title: 'Error !',
                                text: 'Cancel Proses Data',
                                icon: 'error',
                                timer: 1500
                            })
                        }
                    });

                } else {
                    Swal.fire({
                        title: 'Error !',
                        text: 'Cancel Proses Data',
                        icon: 'error',
                        timer: 1500
                    })
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(function() {

        $(document).on('click', '.lokasi_bongkar', function() {
            var id = $(this).attr("name");
            var url = "{{ route('qc.lab.lokasi_bongkar') }}" + " / " + id;
            // console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    // console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#lokasi_bongkar_gb').text("Gudang = " + parsed.lokasi_bongkar);
                    $('#antrian_bongkar_gb').text("Antrian = " + parsed.antrian);
                }
            });
        });
    });
</script>
<script>
    var get_id_penerimaan = document.getElementById('id_penerimaan_po_gb');

    var kadar_air_gb = document.getElementById('kadar_air_gb');
    var ka_kg_gb = document.getElementById('ka_kg_gb');
    var berat_sample_awal_ks_gb = document.getElementById('berat_sample_awal_ks_gb');
    var berat_sample_awal_kg_gb = document.getElementById('berat_sample_awal_kg_gb');
    var berat_sample_akhir_kg_gb = document.getElementById('berat_sample_akhir_kg_gb');
    var berat_sample_pk_gb = document.getElementById('berat_sample_pk_gb');
    var randoman_gb = document.getElementById('randoman_gb');
    var wh_gb = document.getElementById('wh_gb');
    var tp_gb = document.getElementById('tp_gb');
    var md_gb = document.getElementById('md_gb');
    var broken_gb = document.getElementById('broken_gb');
    // hidden
    var kg_after_adjust_hampa_gb = document.getElementById('kg_after_adjust_hampa_gb');
    var prosentasi_kg_gb = document.getElementById('prosentasi_kg_gb');
    var susut_gb = document.getElementById('susut_gb');
    var adjust_susut_gb = document.getElementById('adjust_susut_gb');
    var prsentase_ks_kg_after_adjust_susut_gb = document.getElementById('prsentase_ks_kg_after_adjust_susut_gb');
    var prsentase_kg_pk_gb = document.getElementById('prsentase_kg_pk_gb');
    var adjust_prosentase_kg_pk_gb = document.getElementById('adjust_prosentase_kg_pk_gb');
    var presentase_ks_pk_gb = document.getElementById('presentase_ks_pk_gb');
    var presentase_putih_gb = document.getElementById('presentase_putih_gb');
    var adjust_prosentase_kg_ke_putih_gb = document.getElementById('adjust_prosentase_kg_ke_putih_gb');
    var plan_rend_dari_ks_beras_gb = document.getElementById('plan_rend_dari_ks_beras_gb');
    var katul_gb = document.getElementById('katul_gb');
    var refraksi_broken_gb = document.getElementById('refraksi_broken_gb');
    var plan_harga_gabah_gb = document.getElementById('plan_harga_gabah_gb');
    var hampa_gb = document.getElementById('hampa_gb');
    var tanggal_po_gb = document.getElementById('tanggal_po_gb');
    var status_pending = document.getElementById('status_pending');
    var plan_harga = document.getElementById('plan_harga_gb');
    var item = document.getElementById('item');

    // function validasi() {
    //     var id_penerimaan = id_penerimaan_po_gb.value;
    //     $.ajax({
    //         type: "GET",
    //         url: "{{route('get_count_plan_hpp_gabah_basah')}}" + "/" + id_penerimaan + "/" + item.value,
    //         async: false,
    //         success: function(data) {
    //             var record = JSON.parse(data);
    //             // console.log(record)
    //             if (record == '0') {
    //                 Swal.fire({
    //                     title: 'Maaf, Anda Tidak Bisa Input',
    //                     text: 'SPV belum input PLAN HPP Sesuai Tanggal PO: ' + tanggal_po_gb.value + ' dan Item :' + item.value,
    //                     icon: 'warning',
    //                     allowOutsideClick: false
    //                 })
    //             } else {
    //                 console.log('Plan HPP Sudah Terisi');
    //             }
    //         }
    //     });
    //     $.ajax({
    //         type: "GET",
    //         url: "{{route('get_price_top_gabah_basah')}}" + "/" + id_penerimaan,
    //         async: false,
    //         success: function(data) {
    //             var record = JSON.parse(data);
    //             // console.log(record)
    //             if (record == null || record == '') {
    //                 Swal.fire({
    //                     title: 'Maaf, Anda Tidak Bisa Input',
    //                     text: 'SPV Belum input HARGA ATAS Sesuai Tanggal PO',
    //                     icon: 'warning',
    //                     allowOutsideClick: false
    //                 })
    //             } else {
    //                 console.log('harga atas sudah terisi')
    //             }
    //         }
    //     });
    //     $.ajax({
    //         type: "GET",
    //         url: "{{route('get_buttom_price_gabah_basah')}}" + "/" + id_penerimaan,
    //         async: false,
    //         success: function(data) {
    //             var record = JSON.parse(data);
    //             // console.log(record)
    //             if (record == null || record == '') {
    //                 Swal.fire({
    //                     title: 'Maaf, Anda Tidak Bisa Input',
    //                     text: 'Harap input HARGA BAWAH Sesuai Tanggal PO',
    //                     icon: 'warning',
    //                     allowOutsideClick: false
    //                 })
    //             } else {
    //                 console.log('Harga Bawah Sudah Terisi')
    //             }
    //         }
    //     });
    // }

    function rumus() {
        if (kadar_air_gb.value == 0 || kadar_air_gb.value == '' ||
            ka_kg_gb.value == 0 || ka_kg_gb.value == '' ||
            berat_sample_awal_ks_gb.value == 0 || berat_sample_awal_ks_gb.value == '' ||
            berat_sample_awal_kg_gb.value == 0 || berat_sample_awal_kg_gb.value == '' ||
            berat_sample_akhir_kg_gb.value == 0 || berat_sample_akhir_kg_gb.value == '' ||
            berat_sample_pk_gb.value == 0 || berat_sample_pk_gb.value == '' ||
            randoman_gb.value == 0 || randoman_gb.value == '' ||
            wh_gb.value == 0 || wh_gb.value == '' ||
            tp_gb.value == 0 || tp_gb.value == '' ||
            md_gb.value == 0 || md_gb.value == '' ||
            broken_gb.value == 0 || broken_gb.value == '') {
            $('#keterangan_lab_1_gb > option[value="Unload"]').prop('selected', false);
            $('#keterangan_lab_1_gb > option[value="Pending"]').attr('selected', false);
            $('#keterangan_lab_1_gb > option[value="reject"]').attr('selected', false);
            $('#btn_save').prop('disabled', true);
            plan_harga.value = "0";

        } else {
            var id_penerimaan = id_penerimaan_po_gb.value;
            kg_after_adjust_hampa_gb.value = berat_sample_akhir_kg_gb.value;
            var perhitungan_prosentasi_kg = parseFloat(kg_after_adjust_hampa_gb.value) / 1.5
            prosentasi_kg_gb.value = round(perhitungan_prosentasi_kg, 1);
            var perhitungan_susut = 100 - round(perhitungan_prosentasi_kg, 2)
            susut_gb.value = round(perhitungan_susut, 1);
            var perhitungan_adjust_susut = round(perhitungan_susut, 2) * 1.2;
            adjust_susut_gb.value = round(perhitungan_adjust_susut, 1);
            var perhitungan_prsentase_ks_kg_after_adjust_susut = 100 - round(perhitungan_adjust_susut, 2);
            prsentase_ks_kg_after_adjust_susut_gb.value = round(perhitungan_prsentase_ks_kg_after_adjust_susut, 1);

            var perhitungan_prsentase_kg_pk = (berat_sample_pk_gb.value / (kg_after_adjust_hampa_gb.value / 100));
            prsentase_kg_pk_gb.value = round(perhitungan_prsentase_kg_pk, 1);
            var perhitungan_adjust_prosentase_kg_pk = round(perhitungan_prsentase_kg_pk, 2) * 0.952;
            adjust_prosentase_kg_pk_gb.value = round(perhitungan_adjust_prosentase_kg_pk, 1);
            var perhitungan_presentase_ks_pk = round(perhitungan_prsentase_ks_kg_after_adjust_susut, 2) * (round(perhitungan_adjust_prosentase_kg_pk, 2) / 100);
            presentase_ks_pk_gb.value = round(perhitungan_presentase_ks_pk, 1);
            var perhitungan_presentase_putih = randoman_gb.value / (kg_after_adjust_hampa_gb.value / 100);
            presentase_putih_gb.value = round(perhitungan_presentase_putih, 1);
            var perhitungan_adjust_prosentase_kg_ke_putih = round(perhitungan_presentase_putih, 2) * 0.952;
            adjust_prosentase_kg_ke_putih_gb.value = round(perhitungan_adjust_prosentase_kg_ke_putih, 1);
            var perhitungan_plan_rend_dari_ks_beras = (100 - round(perhitungan_adjust_susut, 2)) * (round(perhitungan_adjust_prosentase_kg_ke_putih, 2) / 100);
            plan_rend_dari_ks_beras_gb.value = round(perhitungan_plan_rend_dari_ks_beras, 1);
            var perhitungan_katul = ((round(perhitungan_adjust_prosentase_kg_pk, 2) - round(perhitungan_adjust_prosentase_kg_ke_putih, 2)) / round(perhitungan_adjust_prosentase_kg_pk, 2)) * 100;
            katul_gb.value = round(perhitungan_katul, 1);
            var perhitungan_refraksi_broken = "0";
            var h_broken = broken_gb.value;
            if (parseFloat(h_broken) < 28 && parseFloat(h_broken) > 0) {
                perhitungan_refraksi_broken = "0";
            } else if (parseFloat(h_broken) >= 28 && parseFloat(h_broken) < 30) {
                perhitungan_refraksi_broken = "0";
            } else if (parseFloat(h_broken) >= 30 && parseFloat(h_broken) <= 80) {
                perhitungan_refraksi_broken = "0";
            } else {
                perhitungan_refraksi_broken = "";
            }
            refraksi_broken_gb.value = perhitungan_refraksi_broken;

            // get plan hpp

            var elems = document.querySelectorAll(".hpp");
            // console.log(elems);

            var std_hpp_incoming = 0;
            [].forEach.call(elems, function(el) {
                var plan_hpp = el.value;
                // console.log(plan_hpp);
                arr_hpp = plan_hpp.split("#");
                // console.log(arr_hpp[2]);
                if (tp_gb.value >= arr_hpp[0] && tp_gb.value <= arr_hpp[1]) {
                    std_hpp_incoming = arr_hpp[2];
                } else if (tp_gb.value >= arr_hpp[1]) {
                    std_hpp_incoming = arr_hpp[2];

                }
                // console.log(std_hpp_incoming);

                //                     }

            });
            // console.log(min_tp,max_tp, harga_hpp);
            var perhitungan_plan_harga_gabah = ((round(perhitungan_plan_rend_dari_ks_beras, 2) / 100) * std_hpp_incoming) - 75;
            plan_harga_gabah_gb.value = round(perhitungan_plan_harga_gabah, 0);
            hasil = plan_harga_gabah_gb.value;
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
                url: "{{route('get_count_plan_hpp_gabah_basah')}}" + "/" + id_penerimaan + "/" + item.value,
                async: false,
                success: function(data) {
                    var record = JSON.parse(data);
                    // console.log(record)
                    if (record == '0') {
                        Swal.fire({
                            title: 'Maaf, Anda Tidak Bisa Input',
                            text: 'SPV belum input PLAN HPP Sesuai Tanggal PO: ' + tanggal_po_gb.value + ' dari Item :' + item.value,
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
                        harga_bawah = record.harga_bawah_gb
                        min_harga_bawah = record.min_toleransi_harga_bawah_gb
                        max_harga_bawah = record.max_toleransi_harga_bawah_gb
                    }
                }
            });

            var harga_bawah_gb = harga_bawah - min_harga_bawah;
            var harga_bawah_gb1 = harga_bawah - max_harga_bawah;
            // console.log(harga_bawah_gb);
            // console.log(harga_bawah_gb1);
            if (hasil == 0 || hasil == '') {
                plan_harga.value = "0";
            } else if (hasil >= harga_bawah_gb1 && hasil <= harga_bawah_gb) {
                console.log("konfirmasi");
                $('#keterangan_lab_1_gb > option[value="Pending"]').prop('selected', true);
                $('#keterangan_lab_1_gb > option[value="Reject"]').attr('selected', false);
                $('#keterangan_lab_1_gb > option[value="Unload"]').attr('selected', false);
                $('#keterangan_lab_1_gb > option[value="Unload"]').attr('disabled', true);
                $('#keterangan_lab_1_gb > option[value="Pending"]').attr('disabled', false);
                $('#keterangan_lab_1_gb > option[value="Reject"]').attr('disabled', false);
                status_pending.value = 'Pending Harga';
                $('#btn_save').prop('disabled', false);
            } else if (hasil <= harga_bawah_gb1) {
                $('#keterangan_lab_1_gb > option[value="Reject"]').prop('selected', true);
                $('#keterangan_lab_1_gb > option[value="Pending"]').attr('selected', false);
                $('#keterangan_lab_1_gb > option[value="Unload"]').attr('selected', false);
                $('#keterangan_lab_1_gb > option[value="Pending"]').attr('disabled', true);
                $('#keterangan_lab_1_gb > option[value="Unload"]').attr('disabled', true);
                $('#keterangan_lab_1_gb > option[value="Reject"]').attr('disabled', false);
                $('#btn_save').prop('disabled', false);
                console.log("tolak");
            } else {
                console.log("bongkar");
                $('#keterangan_lab_1_gb > option[value="Unload"]').prop('selected', true);
                $('#keterangan_lab_1_gb > option[value="Pending"]').attr('selected', false);
                $('#keterangan_lab_1_gb > option[value="reject"]').attr('selected', false);
                $('#keterangan_lab_1_gb > option[value="Unload"]').attr('disabled', false);
                $('#keterangan_lab_1_gb > option[value="Pending"]').attr('disabled', false);
                $('#keterangan_lab_1_gb > option[value="reject"]').attr('disabled', false);
                $('#btn_save').prop('disabled', false);
            }
            var perhitungan_hampa = (berat_sample_awal_kg_gb.value - berat_sample_akhir_kg_gb.value) / (berat_sample_awal_kg_gb.value / 100);
            hampa_gb.value = round(perhitungan_hampa, 1);
            // console.log("id_penerimaan = " + id_penerimaan);
            console.log("Hampa = " + hampa_gb.value)
            console.log("kg after djust hampa = " + kg_after_adjust_hampa_gb.value);
            console.log("prosentasi kg = " + round(perhitungan_prosentasi_kg, 7));

            console.log("susut = " + round(perhitungan_susut, 7));
            console.log("adjust susut = " + round(perhitungan_adjust_susut, 2));
            console.log("presentase ks kg after adjust = " + round(perhitungan_prsentase_ks_kg_after_adjust_susut, 2));
            console.log("prsentase kg pk = " + round(perhitungan_prsentase_kg_pk, 7));
            console.log("adjust prosentase kg pk = " + round(perhitungan_adjust_prosentase_kg_pk, 7));
            console.log("presentase ks pk = " + round(perhitungan_presentase_ks_pk, 7));
            console.log("presentase putih = " + round(perhitungan_presentase_putih, 7));
            console.log("adjust prosentase kg ke putih = " + round(perhitungan_adjust_prosentase_kg_ke_putih, 7));
            console.log("Katul = " + round(perhitungan_katul, 7));
            console.log("plan rend dari ks beras = " + round(perhitungan_plan_rend_dari_ks_beras, 3));
            console.log("PLAN = " + std_hpp_incoming);
            console.log("refraksi broken = " + refraksi_broken_gb.value);
            console.log("plan harga gabah = " + plan_harga_gabah_gb.value);
            console.log("hasil akhir = " + hasil)

            plan_harga.value = hasil;
        }
    }
    var typingTimer; //timer identifier
    var doneTypingInterval = 2000;

    id_penerimaan_po_gb.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });

    kadar_air_gb.addEventListener('keyup', function(e) {
        // validasi();
        clearTimeout(typingTimer);
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    ka_kg_gb.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    berat_sample_awal_ks_gb.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    berat_sample_awal_kg_gb.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    berat_sample_akhir_kg_gb.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    berat_sample_pk_gb.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    randoman_gb.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    wh_gb.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    tp_gb.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    md_gb.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    broken_gb.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(rumus, doneTypingInterval);
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
</script>
@endsection