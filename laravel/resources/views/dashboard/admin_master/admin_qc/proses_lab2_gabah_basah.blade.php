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
        <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-menu__link-icon flaticon2-analytics-2 kt-font-success"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Proses Lab 2 Gabah Basah
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item mt-3">
                            <a class="nav-link active" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-database"></i>GB LONG GRAIN</a>
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
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp; </th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;Harga&nbsp;Gabah&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="tab-pane" id="m_tabs_3_2" role="tabpanel">
                            <table class="table table-bordered" id="data_ciherang">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp; </th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;Harga&nbsp;Gabah&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;</th>
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
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp; </th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;Harga&nbsp;Gabah&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;</th>
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
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp; </th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;Harga&nbsp;Gabah&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;</th>
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
                            <h5 class="modal-title" id="exampleModalLongTitle">Output Data Gabah Incoming</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" id="plan_harga">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="modal fade" id="modal_proseslab2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="formfinishing_qc" class="m-form m-form--fit m-form--label-align-right" method="post" action="javascript:void(0);" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Data LAB 2</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="lab1_id_data_po_gb" id="lab1_id_data_po_gb">
                            <input type="hidden" name="lab1_id_penerimaan_po_gb" id="lab1_id_penerimaan_po_gb">
                            <input type="hidden" id="lab1_id_bid_user" name="lab1_id_bid_user">
                            <input type="hidden" id="hasil_akhir_tonase" name="hasil_akhir_tonase">
                            <input type="hidden" id="plan_berat_kg_pertruk" name="plan_berat_kg_pertruk">
                            <input type="hidden" id="plan_berat_pk_pertruk" name="plan_berat_pk_pertruk">
                            <input type="hidden" id="plan_berat_beras_pertruk" name="plan_berat_beras_pertruk">
                            <input type="hidden" id="hpp_aktual" name="hpp_aktual">
                            <input type="hidden" id="plan_harga_gabah_ongkos_dryer" name="plan_harga_gabah_ongkos_dryer">
                            <input type="hidden" id="plan_harga_pk_perkilo" name="plan_harga_pk_perkilo">
                            <input type="hidden" id="plan_harga_beras_perkilo" name="plan_harga_beras_perkilo">
                            <input type="hidden" id="plan_total_harga_gabah_pertruk" name="plan_total_harga_gabah_pertruk">
                            <input type="hidden" id="plan_total_harga_pk_pertruk" name="plan_total_harga_pk_pertruk">
                            <input type="hidden" id="plan_total_harga_beras_pertruk" name="plan_total_harga_beras_pertruk">

                            <input type="hidden" id="aktual_price_ongkos_driyer" name="aktual_price_ongkos_driyer">
                            <input type="hidden" id="plan_harga_aktual_pertruk" name="plan_harga_aktual_pertruk">
                            <input type="hidden" id="plan_hpp_aktual1" name="plan_hpp_aktual1">


                            {{-- tambahan input --}}
                            <input type="hidden" id="hampa" name="hampa">
                            <input type="hidden" id="kg_after_adjust_hampa" name="kg_after_adjust_hampa">
                            <input type="hidden" id="prosentasi_kg" name="prosentasi_kg">
                            <input type="hidden" id="susut" name="susut">
                            <input type="hidden" id="adjust_susut" name="adjust_susut">
                            <input type="hidden" id="prsentase_ks_kg_after_adjust_susut" name="prsentase_ks_kg_after_adjust_susut">
                            <input type="hidden" id="prsentase_kg_pk" name="prsentase_kg_pk">
                            <input type="hidden" id="adjust_prosentase_kg_pk" name="adjust_prosentase_kg_pk">
                            <input type="hidden" id="presentase_ks_pk" name="presentase_ks_pk">
                            <input type="hidden" id="presentase_putih" name="presentase_putih">
                            <input type="hidden" id="adjust_prosentase_kg_ke_putih" name="adjust_prosentase_kg_ke_putih">
                            <input type="hidden" id="plan_rend_dari_ks_beras" name="plan_rend_dari_ks_beras">
                            <input type="hidden" id="item" name="item">
                            <input type="hidden" id="katul" name="katul">
                            <input type="hidden" id="refraksi_broken" name="refraksi_broken">
                            <input type="hidden" id="plan_harga_gabah" name="plan_harga_gabah">
                            <input type="hidden" id="plan_harga_beli_gabah" name="plan_harga_beli_gabah">
                            <input type="hidden" id="harga_berdasarkan_tempat" name="harga_berdasarkan_tempat">
                            <input type="hidden" id="harga_berdasarkan_harga_atas" name="harga_berdasarkan_harga_atas">
                            <input type="hidden" id="harga_awal" name="harga_awal">
                            <input type="hidden" id="antrian" name="antrian">
                            <input type="hidden" id="dtm" name="dtm">
                            <input type="hidden" id="hasil_tonase" name="hasil_tonase">
                            <input type="hidden" id="status_plan_hpp" name="status_plan_hpp">
                            <input type="hidden" id="status_harga_atas" name="status_harga_atas">
                            <input type="hidden" id="status_harga_bawah" name="status_harga_bawah">
                            <div id="planhpp" class="form-group">
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
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Code PO</label>
                                    <input type="text" id="lab1_kode_po_gb" name="lab1_kode_po_gb" class="form-control m-input" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Plat</label>
                                    <input type="text" id="lab1_plat_gb" readonly name="lab1_plat_gb" class="form-control m-input">
                                </div>
                            </div>

                            {{-- edit form --}}
                            <div class="m-form__group form-group">
                                <label for="">KA KS</label>
                                <input type="text" step="any" required name="ka_ks" id="ka_ks" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">KA KG</label>
                                <input type="text" step="any" required name="ka_kg" id="ka_kg" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Berat Sample Awal KS</label>
                                <input type="text" step="any" required name="berat_sample_awal_ks" id="berat_sample_awal_ks" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Berat Sample Awal KG </label>
                                <input type="text" step="any" required name="berat_sample_awal_kg" id="berat_sample_awal_kg" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Berat Sample Akhir KG </label>
                                <input type="text" step="any" required name="berat_sample_akhir_kg" id="berat_sample_akhir_kg" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Berat Sample PK</label>
                                <input type="text" step="any" required name="berat_sample_pk" id="berat_sample_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Berat Sample Beras</label>
                                <input type="text" step="any" required name="berat_sample_beras" id="berat_sample_beras" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">WH</label>
                                <input type="text" step="any" required name="wh" id="wh" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">TP</label>
                                <input type="text" step="any" required name="tp" id="tp" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">MD</label>
                                <input type="text" step="any" required name="md" id="md" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Broken Setelah Bongkar</label>
                                <input type="text" step="any" required name="broken_setelah_bongkar" id="broken_setelah_bongkar" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Plan Harga (Kg)</label>
                                <input readonly type="text" step="any" value="" required name="plan_harga_gb" id="plan_harga_gb" class="form-control m-input">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Plan Harga Akhir - Rp.14 (Rp/Kg)</label>
                                <input readonly type="text" step="any" value="" required name="plan_harga_potongan_gb" id="plan_harga_potongan_gb" class="form-control m-input">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Aksi Harga</label>
                                <input type="text" readonly name="aksi_harga" id="aksi_harga" value="ON PROCESS" class="form-control m-input">

                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Lokasi Bongkar</label>
                                <input type="text" readonly required name="lokasi_gt" id="lokasi_gt" required class="form-control m-input">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">DTM</label>
                                <input type="text" required name="no_dtm" id="no_dtm" required class="form-control m-input">
                                <p style="color: blue;font-size: 10px;">(Edit No.DTM Jika Ada Yang Salah)</p>
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Suveyor</label>
                                <input type="text" required name="surveyor_bongkar" readonly id="surveyor_bongkar" class="form-control m-input">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Keterangan</label>
                                <input type="text" required name="keterangan_bongkar" readonly id="keterangan_bongkar" class="form-control m-input">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Waktu</label>
                                <input type="text" required name="waktu_bongkar" readonly id="waktu_bongkar" class="form-control m-input">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Tempat</label>
                                <input type="text" required name="tempat_bongkar" readonly id="tempat_bongkar" class="form-control m-input">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Z yang dibawa</label>
                                <input type="text" required name="z_yang_dibawa" readonly id="z_yang_dibawa" class="form-control m-input">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Z yang ditolak</label>
                                <input type="text" required name="z_yang_ditolak" readonly id="z_yang_ditolak" class="form-control m-input">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                            <button id="btn_save" class="btn btn-success m-btn pull-right">Save</button>
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
        $(document).on('keypress', '#ka_ks', function(e) {
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
        $(document).on('keypress', '#berat_sample_beras', function(e) {
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
        $(document).on('keypress', '#broken_setelah_bongkar', function(e) {
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
            language: {
                "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>'
            },
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('master.proses_lab2_gabah_basah_longgrain_index') }}",
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
                    data: 'plat_kendaraan'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'plan_harga'
                },
                {
                    data: 'ckelola'
                },
                {
                    data: 'detail_hasil_qc'
                }

            ],
            createdRow: function(row, data, index) {

                // Updated Schedule Week 1 - 07 Mar 22

                if (data.name_bid == 'GABAH BASAH CIHERANG') {
                    $('td:eq(1)', row).css('color', '#000099'); //Original Date
                } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                    $('td:eq(1)', row).css('color', '#009900'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                    $('td:eq(1)', row).css('color', '#330019'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                    $('td:eq(1)', row).css('color', '#6666FF'); // Behind of Original Date
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
            ajax: "{{ route('master.proses_lab2_gabah_basah_pandan_wangi_index') }}",
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
                    data: 'plat_kendaraan'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'plan_harga'
                },
                {
                    data: 'ckelola'
                },
                {
                    data: 'detail_hasil_qc'
                }

            ],
            createdRow: function(row, data, index) {

                // Updated Schedule Week 1 - 07 Mar 22

                if (data.name_bid == 'GABAH BASAH CIHERANG') {
                    $('td:eq(1)', row).css('color', '#000099'); //Original Date
                } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                    $('td:eq(1)', row).css('color', '#009900'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                    $('td:eq(1)', row).css('color', '#330019'); // Behind of Original Date
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
            language: {
                "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>'
            },
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('master.proses_lab2_gabah_basah_ketan_putih_index') }}",
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
                    data: 'plat_kendaraan'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'plan_harga'
                },
                {
                    data: 'ckelola'
                },
                {
                    data: 'detail_hasil_qc'
                }

            ],
            createdRow: function(row, data, index) {

                // Updated Schedule Week 1 - 07 Mar 22

                if (data.name_bid == 'GABAH BASAH CIHERANG') {
                    $('td:eq(1)', row).css('color', '#000099'); //Original Date
                } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                    $('td:eq(1)', row).css('color', '#009900'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                    $('td:eq(1)', row).css('color', '#330019'); // Behind of Original Date
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
        $(document).on('click', '#btn_save', function(a) {
            a.preventDefault();
            var status_plan_hpp = $('#status_plan_hpp').val();
            var status_harga_atas = $('#status_harga_atas').val();
            var status_harga_bawah = $('#status_harga_bawah').val();
            var lab1_id_data_po_gb = $('#lab1_id_data_po_gb').val();
            var lab1_kode_po_gb = $('#lab1_kode_po_gb').val();
            var lab1_plat_gb = $('#lab1_plat_gb').val();
            var hampa = $('#hampa').val();
            var broken_setelah_bongkar = $('#broken_setelah_bongkar').val();
            var berat_sample_beras = $('#berat_sample_beras').val();
            var ka_ks = $('#ka_ks').val();
            var plan_harga_gb = $('#plan_harga_gb').val();
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
            var berat_sample_awal_ks = $('#berat_sample_awal_ks').val();
            var berat_sample_awal_kg = $('#berat_sample_awal_kg').val();
            var berat_sample_akhir_kg = $('#berat_sample_akhir_kg').val();
            var berat_sample_pk = $('#berat_sample_pk').val();
            var wh = $('#wh').val();
            var tp = $('#tp').val();
            var md = $('#md').val();
            var dtm = $('#dtm').val();
            var plan_berat_kg_pertruk = $('#plan_berat_kg_pertruk').val();

            var plan_berat_pk_pertruk = $('#plan_berat_pk_pertruk').val();
            var plan_berat_beras_pertruk = $('#plan_berat_beras_pertruk').val();
            var plan_harga_gabah_ongkos_dryer = $('#plan_harga_gabah_ongkos_dryer').val();
            var plan_harga_pk_perkilo = $('#plan_harga_pk_perkilo').val();
            var plan_harga_beras_perkilo = $('#plan_harga_beras_perkilo').val();
            var plan_total_harga_gabah_pertruk = $('#plan_total_harga_gabah_pertruk').val();
            var plan_total_harga_pk_pertruk = $('#plan_total_harga_pk_pertruk').val();
            var plan_total_harga_beras_pertruk = $('#plan_total_harga_beras_pertruk').val();
            var aktual_price_ongkos_driyer = $('#aktual_price_ongkos_driyer').val();
            var plan_harga_aktual_pertruk = $('#plan_harga_aktual_pertruk').val();
            var plan_hpp_aktual1 = $('#plan_hpp_aktual1').val();
            var hpp_aktual = $('#hpp_aktual').val();
            var plan_harga_beli_gabah = $('#plan_harga_beli_gabah').val();

            var harga_berdasarkan_tempat = $('#harga_berdasarkan_tempat').val();
            var harga_berdasarkan_harga_atas = $('#harga_berdasarkan_harga_atas').val();
            var harga_awal = $('#harga_awal').val();
            var surveyor_bongkar = $('#surveyor_bongkar').val();
            var keterangan_bongkar = $('#keterangan_bongkar').val();
            var waktu_bongkar = $('#waktu_bongkar').val();
            var tempat_bongkar = $('#tempat_bongkar').val();
            var lokasi_gt = $('#lokasi_gt').val();
            var z_yang_dibawa = $('#z_yang_dibawa').val();
            var z_yang_ditolak = $('#z_yang_ditolak').val();

            var antrian = $('#antrian').val();
            var plan_harga_potongan_gb = $('#plan_harga_potongan_gb').val();
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
                    // console.log(result);
                    if (result.value) {
                        if ($('#z_yang_dibawa').val() == '' | $('#broken_setelah_bongkar').val() == '' | $('#tp').val() == '' | $('#berat_sample_pk').val() == '' | $('#ka_ks').val() == '' | $('#ka_kg').val() == '' | $('#berat_sample_akhir_kg').val() == '' | $('#berat_sample_awal_ks').val() == '' | $('#berat_sample_awal_kg').val() == '' | $('#md').val() == '' | $('#tp').val() == '' | $('#wh').val() == '' | $('#berat_sample_beras').val() == '') {
                            Swal.fire({
                                title: 'Gagal !',
                                text: 'Data Harus Diisi.',
                                icon: 'warning',
                                timer: 1500
                            })
                            $('#btn_save').html('Simpan');
                        } else if ($('#plan_harga_potongan_gb').val() == '' | $('#plan_harga_potongan_gb').val() == '0') {

                            Swal.fire({
                                title: 'Mohon Dicek!',
                                text: 'Harga Rp. 0',
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
                                            lab1_id_data_po_gb: lab1_id_data_po_gb,
                                            lab1_kode_po_gb: lab1_kode_po_gb,
                                            lab1_plat_gb: lab1_plat_gb,
                                            hampa: hampa,
                                            broken_setelah_bongkar: broken_setelah_bongkar,
                                            berat_sample_beras: berat_sample_beras,
                                            ka_ks: ka_ks,
                                            plan_harga_gb: plan_harga_gb,
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
                                            dtm: dtm,
                                            plan_berat_kg_pertruk: plan_berat_kg_pertruk,

                                            plan_berat_pk_pertruk: plan_berat_pk_pertruk,
                                            plan_berat_beras_pertruk: plan_berat_beras_pertruk,
                                            plan_harga_gabah_ongkos_dryer: plan_harga_gabah_ongkos_dryer,
                                            plan_harga_pk_perkilo: plan_harga_pk_perkilo,
                                            plan_harga_beras_perkilo: plan_harga_beras_perkilo,
                                            plan_total_harga_gabah_pertruk: plan_total_harga_gabah_pertruk,
                                            plan_total_harga_pk_pertruk: plan_total_harga_pk_pertruk,
                                            plan_total_harga_beras_pertruk: plan_total_harga_beras_pertruk,
                                            hpp_aktual: hpp_aktual,
                                            plan_harga_beli_gabah: plan_harga_beli_gabah,
                                            aktual_price_ongkos_driyer: aktual_price_ongkos_driyer,
                                            plan_harga_aktual_pertruk: plan_harga_aktual_pertruk,
                                            plan_hpp_aktual1: plan_hpp_aktual1,
                                            harga_berdasarkan_tempat: harga_berdasarkan_tempat,
                                            harga_berdasarkan_harga_atas: harga_berdasarkan_harga_atas,
                                            harga_awal: harga_awal,
                                            surveyor_bongkar: surveyor_bongkar,
                                            keterangan_bongkar: keterangan_bongkar,
                                            waktu_bongkar: waktu_bongkar,
                                            tempat_bongkar: tempat_bongkar,
                                            lokasi_gt: lokasi_gt,
                                            z_yang_dibawa: z_yang_dibawa,
                                            z_yang_ditolak: z_yang_ditolak,

                                            antrian: antrian,
                                            plan_harga_potongan_gb: plan_harga_potongan_gb,
                                        },
                                        url: "{{ route('master.save_proses_lab2_gb') }}",
                                        type: "POST",
                                        dataType: 'json',
                                        success: function(data) {
                                            // console.log(data);
                                            // table.draw();
                                            $('#data_longgrain').DataTable().ajax.reload();
                                            $('#data_pw').DataTable().ajax.reload();
                                            $('#data_kp').DataTable().ajax.reload();
                                            $('#btn_save').html('Simpan');
                                            $('#modal_proseslab2').modal('hide');
                                            Swal.fire({
                                                title: 'success',
                                                Text: 'Data Berhasil DiSimpan',
                                                icon: 'success',
                                                timer: 1500
                                            })

                                        },
                                        error: function(data) {
                                            $('#btn_save').html('Simpan');
                                            $('#modal_proseslab2').modal('hide');
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
                        Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')
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
        $(document).on('click', '#btn_finishing_qc', function() {
            var id = $(this).attr("name");
            var item = $(this).data('item');
            var tanggal_po = $(this).data('tanggalpo');
            var id_penerimaan = $(this).data('id');
            var url = "{{ route('master.show_lab2_gb') }}" + "/" + id;
            var url2 = "{{route('master.get_plan_hpp_gabah_basah') }}" + "/" + tanggal_po + "/" + item;
            var url3 = "{{route('get_price_top_gabah_basah') }}" + "/" + id_penerimaan;
            var url4 = "{{route('get_buttom_price_gabah_basah') }}" + "/" + id_penerimaan;
            // console.log(url);
            $('#formfinishing_qc').trigger('reset');
            //   $('#modal_proseslab2').removeData();
            //   location.reload();
            $('#modal_proseslab2').on('hidden.bs.modal', function(e) {
                $('#input_hpp').remove();
                // $('#min_tp').remove();
                // $('#operation').remove();
                // $('#max_tp').remove();
                // $('#harga_hpp').remove();
                $('#input_plan').empty();
                $('#input_hargaatas').empty();
                $('#input_hargabawah').empty();
            })
            $('#modal_proseslab2').modal('show');
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    // console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#lab1_kode_po_gb').val(parsed.lab1_kode_po_gb);
                    $('#hasil_akhir_tonase').val(parsed.hasil_akhir_tonase);
                    $('#lab1_plat_gb').val(parsed.lab1_plat_gb);
                    $('#lab1_id_data_po_gb').val(parsed.lab1_id_data_po_gb);
                    $('#lab1_id_penerimaan_po_gb').val(parsed.lab1_id_penerimaan_po_gb);
                    $('#gabahincoming_id_bid_user').val(parsed.gabahincoming_id_bid_user);
                    if ((parsed.lokasi_bongkar_gb) == 'UTARA') {
                        $('#lokasi_gt').val('UTARA');
                    } else {
                        $('#lokasi_gt').val('SELATAN');
                    }
                    if (parsed.netto2 == '' || parsed.netto2 == 'NULL') {
                        $('#hasil_tonase').val('0');
                    } else {
                        $('#hasil_tonase').val(parsed.netto2);
                    }
                    $('#no_dtm').val(parsed.no_dtm);
                    $('#surveyor_bongkar').val(parsed.surveyor_bongkar);
                    $('#keterangan_bongkar').val(parsed.keterangan_bongkar);
                    $('#waktu_bongkar').val(parsed.waktu_bongkar);
                    $('#tempat_bongkar').val(parsed.tempat_bongkar);
                    $('#z_yang_dibawa').val(parsed.z_yang_dibawa);
                    $('#item').val(item);
                    $('#dtm').val(parsed.no_dtm);
                    $('#antrian').val(parsed.no_antrian);
                    $('#plan_harga_gb').val('0');
                    $('#plan_harga_potongan_gb').val('0');

                    $('#z_yang_ditolak').val(parsed.z_yang_ditolak);
                    //console.log(parsed.lokasi_bongkar);
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
                            text: 'SPV belum input Harga Atas Sesuai Tanggal PO',
                            icon: 'warning',
                            allowOutsideClick: false,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                    } else {
                        document.getElementById('hargaatas_success').style.display = 'block';
                        document.getElementById('status_harga_atas').value = '1';
                        document.getElementById('hargaatas_error').style.display = 'none';

                    }
                    // console.log(parsed);
                    my_topprice.append("<dd class=" + 'col-sm-3 col-xs-12' + ">" + 'Harga Atas' + "</dd><dd class=" + 'col-sm-1 col-xs-12' + ">:</dd><dd id=" + 'maxtp' + "  class=" + 'col-sm-3 col-xs-12' + ">Rp. " + formatRupiah(parsed.harga_atas_gb) + "</dd>");

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
                            text: 'SPV belum input PLAN HPP Sesuai Tanggal PO',
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

<script>
    var lokasi_gt = document.getElementById('lokasi_gt');
    var ka_ks = document.getElementById('ka_ks');
    var ka_kg = document.getElementById('ka_kg');
    var berat_sample_awal_ks = document.getElementById('berat_sample_awal_ks');
    var berat_sample_awal_kg = document.getElementById('berat_sample_awal_kg');
    var berat_sample_akhir_kg = document.getElementById('berat_sample_akhir_kg');
    var berat_sample_pk = document.getElementById('berat_sample_pk');
    var berat_sample_beras = document.getElementById('berat_sample_beras');
    var wh = document.getElementById('wh');
    var tp = document.getElementById('tp');
    var md = document.getElementById('md');
    var broken_setelah_bongkar = document.getElementById('broken_setelah_bongkar');
    var aksi_harga = document.getElementById('aksi_harga');
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
    var plan_harga_potongan_gb = document.getElementById('plan_harga_potongan_gb');
    var hampa = document.getElementById('hampa');

    var plan_harga_beli_gabah = document.getElementById('plan_harga_beli_gabah');
    var harga_berdasarkan_tempat = document.getElementById('harga_berdasarkan_tempat');
    var harga_berdasarkan_harga_atas = document.getElementById('harga_berdasarkan_harga_atas');
    var harga_awal = document.getElementById('harga_awal');

    var get_id_penerimaan = document.getElementById('lab1_id_penerimaan_po_gb');
    var hasil_tonase = document.getElementById('hasil_tonase');
    var lab1_kode_po_gb = document.getElementById('lab1_kode_po_gb');
    var plan_harga_gb = document.getElementById('plan_harga_gb');
    // tambahan hidden
    var plan_berat_kg_pertruk = document.getElementById('plan_berat_kg_pertruk');
    var plan_berat_pk_pertruk = document.getElementById('plan_berat_pk_pertruk');
    var plan_berat_beras_pertruk = document.getElementById('plan_berat_beras_pertruk');

    var plan_harga_gabah_ongkos_dryer = document.getElementById('plan_harga_gabah_ongkos_dryer');
    var plan_harga_pk_perkilo = document.getElementById('plan_harga_pk_perkilo');
    var plan_harga_beras_perkilo = document.getElementById('plan_harga_beras_perkilo');
    var plan_total_harga_pk_pertruk = document.getElementById('plan_total_harga_pk_pertruk');
    var plan_total_harga_beras_pertruk = document.getElementById('plan_total_harga_beras_pertruk');

    var aktual_price_ongkos_driyer = document.getElementById('aktual_price_ongkos_driyer');
    var plan_harga_aktual_pertruk = document.getElementById('plan_harga_aktual_pertruk');
    var plan_hpp_aktual1 = document.getElementById('plan_hpp_aktual1');

    var hpp_aktual = document.getElementById('hpp_aktual');
    var item = document.getElementById('item');
    var btn_save = document.getElementById('btn_save');

    // function validasi() {
    //     var id_penerimaan = get_id_penerimaan.value;
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
    //                     text: 'SPV belum input PLAN HPP Sesuai Tanggal PO: ' + get_lab1_kode_po_gb.value + ' dan Item :' + item.value,
    //                     icon: 'warning',
    //                     allowOutsideClick: false
    //                 })
    //             } else {
    //                 // console.log('Plan HPP Sudah Terisi');
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
    //                 // console.log('harga atas sudah terisi')
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
    //                 // console.log('Harga Bawah Sudah Terisi')
    //             }
    //         }
    //     });
    // }

    function rumus() {
        if (
            ka_ks.value == '' || ka_ks.value == 'NULL' ||
            ka_kg.value == '' || ka_kg.value == 'NULL' ||
            berat_sample_awal_ks.value == '' || berat_sample_awal_ks.value == 'NULL' ||
            berat_sample_awal_kg.value == '' || berat_sample_awal_kg.value == 'NULL' ||
            berat_sample_akhir_kg.value == '' || berat_sample_akhir_kg.value == 'NULL' ||
            berat_sample_pk.value == '' || berat_sample_pk.value == 'NULL' ||
            berat_sample_beras.value == '' || berat_sample_beras.value == 'NULL' ||
            wh.value == '' || wh.value == 'NULL' ||
            tp.value == '' || tp.value == 'NULL' ||
            md.value == '' || md.value == 'NULL' ||
            broken_setelah_bongkar.value == '' || broken_setelah_bongkar.value == 'NULL') {
            plan_harga_gabah.value == '0';
            plan_harga_potongan_gb.value == '0';
        } else {
            var hasil = "0";

            var berat_tonase = hasil_tonase.value;
            var id_penerimaan = get_id_penerimaan.value;
            kg_after_adjust_hampa.value = berat_sample_akhir_kg.value;
            var perhitungan_prosentasi_kg = parseFloat(kg_after_adjust_hampa.value) / 1.5;
            prosentasi_kg.value = round(perhitungan_prosentasi_kg, 1);
            var perhitungan_susut = 100 - round(perhitungan_prosentasi_kg, 2);
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
            var perhitungan_presentase_putih = berat_sample_beras.value / (kg_after_adjust_hampa.value / 100);
            presentase_putih.value = round(perhitungan_presentase_putih, 1);
            var perhitungan_adjust_prosentase_kg_ke_putih = round(perhitungan_presentase_putih, 2) * 0.952;
            adjust_prosentase_kg_ke_putih.value = round(perhitungan_adjust_prosentase_kg_ke_putih, 1);
            var perhitungan_plan_rend_dari_ks_beras = (100 - round(perhitungan_adjust_susut, 2)) * (round(perhitungan_adjust_prosentase_kg_ke_putih, 2) / 100);
            plan_rend_dari_ks_beras.value = round(perhitungan_plan_rend_dari_ks_beras, 1);
            var perhitungan_katul = ((round(perhitungan_adjust_prosentase_kg_pk, 2) - round(perhitungan_adjust_prosentase_kg_ke_putih, 2)) / round(perhitungan_adjust_prosentase_kg_pk, 2)) * 100;
            katul.value = round(perhitungan_katul, 1);
            // var perhitungan_plan_harga_gabah_dan_ongkos_drayer = round

            // tambahan rumus
            var perhitungan_plan_berat_kg_pertruk = berat_tonase * (round(perhitungan_prsentase_ks_kg_after_adjust_susut, 2) / 100);
            plan_berat_kg_pertruk.value = round(perhitungan_plan_berat_kg_pertruk, 0);
            var perhitungan_plan_berat_pk_pertruk = berat_tonase * (round(perhitungan_presentase_ks_pk, 2) / 100);
            plan_berat_pk_pertruk.value = round(perhitungan_plan_berat_pk_pertruk, 0);
            var perhitungan_plan_berat_beras_pertruk = berat_tonase * (round(perhitungan_plan_rend_dari_ks_beras, 2) / 100);
            plan_berat_beras_pertruk.value = round(perhitungan_plan_berat_beras_pertruk, 0);




            // adsfa
            var perhitungan_refraksi_broken = "0";
            var h_broken = broken_setelah_bongkar.value;
            if (parseFloat(h_broken) < 28 && parseFloat(h_broken) > 0) {
                perhitungan_refraksi_broken = "0";
            } else if (parseFloat(h_broken) >= 28 && parseFloat(h_broken) < 30) {
                perhitungan_refraksi_broken = "0";
            } else if (parseFloat(h_broken) >= 30 && parseFloat(h_broken) <= 80) {
                perhitungan_refraksi_broken = "0";
            } else {
                perhitungan_refraksi_broken = "";
            }
            refraksi_broken.value = perhitungan_refraksi_broken;

            // get plan hpp
            var elems = document.querySelectorAll(".hpp");

            var std_hpp_aktual = 0;
            [].forEach.call(elems, function(el) {
                var plan_hpp = el.value;
                arr_hpp = plan_hpp.split("#");

                if (tp.value >= arr_hpp[0] && tp.value < arr_hpp[1]) {
                    std_hpp_aktual = arr_hpp[2];
                    // console.log(std_hpp_aktual);
                } else if (tp.value >= arr_hpp[1]) {
                    std_hpp_aktual = arr_hpp[2];

                }

            });




            var perhitungan_plan_hpp = std_hpp_aktual;
            hpp_aktual.value = perhitungan_plan_hpp;

            var perhitungan_plan_harga_gabah = ((round(perhitungan_plan_rend_dari_ks_beras, 2) / 100) * perhitungan_plan_hpp) - 75;
            plan_harga = round(perhitungan_plan_harga_gabah, 2);

            var perhitungan_plan_harga_beli_gabah = round(plan_harga) - refraksi_broken.value;
            plan_harga_beli_gabah.value = perhitungan_plan_harga_beli_gabah;
            var perhitungan_hasil = plan_harga;
            plan_harga_gabah.value = plan_harga_beli_gabah.value;
            harga_berdasarkan_tempat.value = round(perhitungan_hasil);

            var perhitungan_plan_harga_gabah_ongkos_dryer = (round(perhitungan_plan_harga_gabah, 2)) + 75;
            plan_harga_gabah_ongkos_dryer.value = round(perhitungan_plan_harga_gabah_ongkos_dryer, 0);
            var perhitungan_plan_harga_pk_perkilo = round(perhitungan_plan_harga_gabah_ongkos_dryer, 2) / ((round(perhitungan_presentase_ks_pk, 2) / 100));
            plan_harga_pk_perkilo.value = round(perhitungan_plan_harga_pk_perkilo);
            var perhitungan_plan_harga_beras_perkilo = round(perhitungan_plan_harga_gabah_ongkos_dryer, 2) / ((round(perhitungan_plan_rend_dari_ks_beras, 2) / 100));
            plan_harga_beras_perkilo.value = round(perhitungan_plan_harga_beras_perkilo);
            var perhitungan_plan_total_harga_gabah_pertruk = berat_tonase * round(perhitungan_plan_harga_gabah_ongkos_dryer, 2);
            plan_total_harga_gabah_pertruk.value = round(perhitungan_plan_total_harga_gabah_pertruk);
            var perhitungan_plan_total_harga_pk_pertruk = berat_tonase * round(perhitungan_plan_harga_pk_perkilo, 4);
            plan_total_harga_pk_pertruk.value = round(perhitungan_plan_total_harga_pk_pertruk);
            var perhitungan_plan_total_harga_beras_pertruk = berat_tonase * plan_harga_beras_perkilo.value;
            plan_total_harga_beras_pertruk.value = round(perhitungan_plan_total_harga_beras_pertruk);



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
                            text: 'Harap input HARGA ATAS Sesuai Tanggal PO',
                            icon: 'warning',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "{{ route('master.harga_atas_gabah_basah') }}";

                            }
                        })
                    } else {
                        harga_atas = record.harga_atas_gb;
                        // console.log("harga atas sekarang " + harga_atas);
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
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "{{ route('master.harga_bawah_gabah_basah') }}";

                            }
                        })
                    } else {
                        harga_bawah = record.harga_bawah_gb
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
                            text: 'Harap input PLAN HPP Sesuai Tanggal PO: ' + tanggal_po_gb.value,
                            icon: 'warning',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "{{ route('master.plan_hpp_gabah_basah') }}";

                            }
                        })
                    }
                }
            });

            if (harga_berdasarkan_tempat.value >= harga_atas) {
                // console.log("harga diatas yang ditentukan");
                harga_berdasarkan_harga_atas.value = harga_atas;
            } else {
                // console.log("harga dibwah sesuai rumus");
                harga_berdasarkan_harga_atas.value = round(harga_berdasarkan_tempat.value);
            }

            harga_awal.value = harga_berdasarkan_harga_atas.value;

            var reaksi_harga = 0;
            var potongan_bongkar_ngawi = 14;

            hasil = harga_awal.value - potongan_bongkar_ngawi;

            var perhitungan_aktual_price_ongkos_driyer = hasil + 75;
            aktual_price_ongkos_driyer.value = round(perhitungan_aktual_price_ongkos_driyer, 0);

            var perhitungan_plan_harga_aktual_pertruk = aktual_price_ongkos_driyer.value * berat_tonase;
            plan_harga_aktual_pertruk.value = round(perhitungan_plan_harga_aktual_pertruk, 0);

            var perhitungan_plan_hpp_aktual1 = hasil / (round(perhitungan_plan_rend_dari_ks_beras, 2) / 100);
            plan_hpp_aktual1.value = round(perhitungan_plan_hpp_aktual1, 0);
            var perhitungan_hampa = (berat_sample_awal_kg.value - berat_sample_akhir_kg.value) / (berat_sample_awal_kg
                .value / 100);
            hampa.value = round(perhitungan_hampa, 1);
            // console.log("id_penerimaan = " + id_penerimaan);
            // console.log("Hampa = " + hampa.value)
            // console.log("kg after djust hampa = " + kg_after_adjust_hampa.value);
            // console.log("prosentasi kg = " + round(perhitungan_prosentasi_kg, 2));
            // console.log("susut = " + round(perhitungan_susut, 2));
            // console.log("adjust susut = " + round(perhitungan_adjust_susut, 2));
            // console.log("presentase ks kg after adjust = " + round(perhitungan_prsentase_ks_kg_after_adjust_susut, 2));
            // console.log("prsentase kg pk = " + round(perhitungan_prsentase_kg_pk, 2));
            // console.log("adjust prosentase kg pk = " + round(perhitungan_adjust_prosentase_kg_pk, 2));
            // console.log("presentase ks pk = " + round(perhitungan_presentase_ks_pk, 2));
            // console.log("presentase putih = " + round(perhitungan_presentase_putih, 2));
            // console.log("adjust prosentase kg ke putih = " + round(perhitungan_adjust_prosentase_kg_ke_putih, 2));
            // console.log("plan rend dari ks beras = " + round(perhitungan_plan_rend_dari_ks_beras, 2));
            // console.log("katul = " + round(perhitungan_katul, 2));
            // console.log("refraksi broken = " + refraksi_broken.value);
            // console.log("plan harga gabah = " + round(perhitungan_plan_harga_gabah, 1));
            // console.log("hasil akhir = " + hasil);
            // console.log("-----------------------------------------------------------------")
            // console.log("perhitungan plan berat kg pertruk = " + plan_berat_kg_pertruk.value);
            // console.log("perhitungan plan berat pk pertruk = " + plan_berat_pk_pertruk.value);
            // console.log("perhitungan plan berat beras per truk = " + round(perhitungan_plan_berat_beras_pertruk, 0));
            // console.log("plan harga gabah ongkos dryer = " + round(perhitungan_plan_harga_gabah_ongkos_dryer, 2));
            // console.log("plan harga pk perkilo = " + round(perhitungan_plan_harga_pk_perkilo, 2));
            // console.log("plan harga beras perkilo = " + plan_harga_beras_perkilo.value);
            // console.log("plan total harga gabah pertruk = " + plan_total_harga_gabah_pertruk.value);
            // console.log("plan total harga pk pertruk = " + round(perhitungan_plan_total_harga_pk_pertruk, 2));
            // console.log("plan total harga beras pertruk = " + plan_total_harga_beras_pertruk.value);
            // console.log("-----------------------------------------------------------------")
            // console.log("Aktual Price + Ongkos Driyer Perkg = " + aktual_price_ongkos_driyer.value);
            // console.log("Plan Harga Aktual per truk = " + round(perhitungan_plan_harga_aktual_pertruk, 0));
            // console.log("Plan HPP Aktual = " + round(plan_hpp_aktual1, 2));

            plan_harga_gb.value = harga_awal.value;
            plan_harga_potongan_gb.value = hasil;
        }
    }
    var typingTimer; //timer identifier
    var doneTypingInterval = 2000;
    lab1_id_penerimaan_po_gb.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    ka_ks.addEventListener('keyup', function(e) {
        // validasi();
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
    berat_sample_beras.addEventListener('keyup', function(e) {
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
    broken_setelah_bongkar.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });

    function funcaksiharga() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(rumus, doneTypingInterval);
    }


    function round(value, exp) {
        if (typeof exp === 'undefined' || +exp === 0)
            return Math.round(value);

        value = +value;
        exp = +exp;

        if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
            return '0';

        // Shift
        value = value.toString().split('e');
        value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));

        // Shift back
        value = value.toString().split('e');
        return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
    }
</script>
@endsection