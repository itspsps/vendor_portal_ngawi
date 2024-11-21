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
                        PT. SURYA PANGAN SEMESTA
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
                            Output Data (Lab 2) Gabah Basah
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
                            <table class="table table-bordered" id="data_longgrain" style="table-layout: auto;">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Status </th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Asal&nbsp;Gabah</th>
                                        <th style="text-align: center;width:auto">DTM&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">Tonase&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">KA&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">KA&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Awal&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Awal&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Akhir&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;PK</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Beras</th>
                                        <th style="text-align: center;width:auto">WH</th>
                                        <th style="text-align: center;width:auto">TP</th>
                                        <th style="text-align: center;width:auto">MD</th>
                                        <th style="text-align: center;width:auto">Broken&nbsp;Setelah&nbsp;Bongkar</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Atas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Aksi&nbsp;Harga</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;-&nbsp;Rp.14&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_2" role="tabpanel">
                            <table class="table table-bordered" id="data_pw" style="table-layout: auto;">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Status </th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Asal&nbsp;Gabah</th>
                                        <th style="text-align: center;width:auto">DTM&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">Tonase&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">KA&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">KA&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Awal&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Awal&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Akhir&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;PK</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Beras</th>
                                        <th style="text-align: center;width:auto">WH</th>
                                        <th style="text-align: center;width:auto">TP</th>
                                        <th style="text-align: center;width:auto">MD</th>
                                        <th style="text-align: center;width:auto">Broken&nbsp;Setelah&nbsp;Bongkar</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Atas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Aksi&nbsp;Harga</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;-&nbsp;Rp.14&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
                            <table class="table table-bordered" id="data_kp" style="table-layout: auto;">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Status </th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Asal&nbsp;Gabah</th>
                                        <th style="text-align: center;width:auto">DTM&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">Tonase&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">KA&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">KA&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Awal&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Awal&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Akhir&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;PK</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Beras</th>
                                        <th style="text-align: center;width:auto">WH</th>
                                        <th style="text-align: center;width:auto">TP</th>
                                        <th style="text-align: center;width:auto">MD</th>
                                        <th style="text-align: center;width:auto">Broken&nbsp;Setelah&nbsp;Bongkar</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Atas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Aksi&nbsp;Harga</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;-&nbsp;Rp.14&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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

<div class="modal fade" id="modal_outputlab2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form_outputlab2" class="m-form m-form--fit m-form--label-align-right" method="post" action="javascript:void(0);" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Lab 2</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id_data_po" id="id_data_po">
                    <input type="hidden" name="id_penerimaan_po" id="id_penerimaan_po">
                    <input type="hidden" id="id_gabahfinishing_qc" name="id_gabahfinishing_qc">
                    <input type="hidden" id="tanggal_po_gb" name="tanggal_po_gb">
                    <input type="hidden" id="item" name="item">
                    <!--<label>Hasil Tonase</label>-->
                    <input type="hidden" id="hasil_tonase" name="hasil_tonase">
                    <!--<label>Plan Berat KG/Truk</label>-->
                    <input type="hidden" id="plan_berat_kg_pertruk" name="plan_berat_kg_pertruk">
                    <!--<label>Plan Berat PK/Truk</label>-->
                    <input type="hidden" id="plan_berat_pk_pertruk" name="plan_berat_pk_pertruk">
                    <!--<label>Plan Berat Beras/Truk</label>-->
                    <input type="hidden" id="plan_berat_beras_pertruk" name="plan_berat_beras_pertruk">
                    <!--<label>HPP Aktual</label>-->
                    <input type="hidden" id="hpp_aktual" name="hpp_aktual">
                    <!--<label>Plan Harga Gabah Ongkos Dryer</label>-->
                    <input type="hidden" id="plan_harga_gabah_ongkos_dryer" name="plan_harga_gabah_ongkos_dryer">
                    <!--<label>Plan Harga PK/Kilo</label>-->
                    <input type="hidden" id="plan_harga_pk_perkilo" name="plan_harga_pk_perkilo">
                    <!--<label>Plan Harga Beras/Kilo</label>-->
                    <input type="hidden" id="plan_harga_beras_perkilo" name="plan_harga_beras_perkilo">
                    <!--<label>Plan Total Harga Gabah/Truk</label>-->
                    <input type="hidden" id="plan_total_harga_gabah_pertruk" name="plan_total_harga_gabah_pertruk">
                    <!--<label>Plan Total Harga PK/Truk</label>-->
                    <input type="hidden" id="plan_total_harga_pk_pertruk" name="plan_total_harga_pk_pertruk">
                    <!--<label>Plan Total Harga Beras/Truk</label>-->
                    <input type="hidden" id="plan_total_harga_beras_pertruk" name="plan_total_harga_beras_pertruk">

                    <input type="hidden" id="aktual_price_ongkos_driyer" name="aktual_price_ongkos_driyer">
                    <input type="hidden" id="plan_harga_aktual_pertruk" name="plan_harga_aktual_pertruk">
                    <input type="hidden" id="plan_hpp_aktual1" name="plan_hpp_aktual1">

                    {{-- tambahan input --}}

                    <!-- <label>HAMPA</label> -->
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
                    <input type="hidden" id="katul" name="katul">
                    <input type="hidden" id="refraksi_broken" name="refraksi_broken">
                    <input type="hidden" id="status_plan_hpp" name="status_plan_hpp">
                    <input type="hidden" id="status_harga_atas" name="status_harga_atas">
                    <input type="hidden" id="status_harga_bawah" name="status_harga_bawah">
                    <!-- <label for=""> harga tempat></label> -->
                    <input type="hidden" id="harga_berdasarkan_tempat" name="harga_berdasarkan_tempat">
                    <!-- <label for=""> harga atas></label> -->
                    <input type="hidden" id="harga_berdasarkan_harga_atas" name="harga_berdasarkan_harga_atas">
                    <!-- <label for=""> harga awal></label> -->
                    <input type="hidden" id="harga_awal" name="harga_awal">
                    <!-- <label for=""> plan harga gabah></label> -->
                    <input type="hidden" id="plan_harga_gabah" name="plan_harga_gabah">
                    <!-- <label for=""> plan harga beli gabah></label> -->
                    <input type="hidden" id="plan_harga_beli_gabah" name="plan_harga_beli_gabah">
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
                            <input type="text" id="gabahincoming_kode_po" name="gabahincoming_kode_po" class="form-control m-input" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Nopol</label>
                            <input type="text" id="gabahincoming_plat" readonly name="gabahincoming_plat" class="form-control m-input">
                        </div>
                    </div>
                    <input type="hidden" name="beras_hitam" value="1">
                    <input type="hidden" name="beras_kusam" value="1">
                    <input type="hidden" name="biji_mati" value="1">
                    <input type="hidden" name="semu" value="1">
                    <input type="hidden" name="kuning" value="1">
                    <input type="hidden" name="mletik_semu" value="1">
                    <input type="hidden" name="gabah_hitam" value="1">
                    <input type="hidden" name="gabah_sungutan" value="1">
                    <input type="hidden" name="gabah_kopong" value="1">
                    <input type="hidden" name="aroma_gabah" value="1">
                    <input type="hidden" name="kotoran_gabah" value="1">

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
                        <label for="">Berat Sample Awal KG</label>
                        <input type="text" step="any" required name="berat_sample_awal_kg" id="berat_sample_awal_kg" class="form-control m-input" value="">
                    </div>
                    <div class="m-form__group form-group">
                        <label for="">Berat Sample Akhir KG</label>
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
                        <label for="">Lokasi Bongkar</label>
                        <input type="text" step="any" readonly required name="lokasi_bongkar" id="lokasi_bongkar" class="form-control m-input">
                    </div>
                    <div class="m-form__group form-group">
                        <label for="">Keterangan</label>
                        <input type="text" step="any" readonly required name="keterangan_lab1" id="keterangan_lab1" class="form-control m-input">
                    </div>
                    <div class="m-form__group form-group">
                        <label for="">Plan Harga (Kg)</label>
                        <input readonly type="text" step="any" required name="plan_harga_gb" id="plan_harga_gb" class="form-control m-input">
                    </div>
                    <div class="m-form__group form-group">
                        <label for="">Plan Harga Akhir - Rp.14 (Rp/Kg)</label>
                        <input readonly type="text" step="any" value="" required name="plan_harga_potongan_gb" id="plan_harga_potongan_gb" class="form-control m-input">
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
        $(document).on('keypress', '#ka_ks', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)?(\d*\,?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#ka_kg', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)?(\d*\,?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#berat_sample_awal_ks', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)?(\d*\,?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#berat_sample_awal_kg', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)?(\d*\,?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#berat_sample_akhir_kg', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)?(\d*\,?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#berat_sample_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)?(\d*\,?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#berat_sample_beras', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)?(\d*\,?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#wh', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)?(\d*\,?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#tp', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)?(\d*\,?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#md', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)?(\d*\,?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#broken_setelah_bongkar', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)?(\d*\,?\d*)$/;
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
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
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
                    url: "{{ route('master.output_lab2_gb_longgrain_qc_index') }}",
                    data: {
                        from_date: from_date,
                        to_date: to_date
                    }
                },
                columns: [{
                        data: "id_lab2_gb",

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
                        data: 'status_lab2_gb'
                    },
                    {
                        data: 'tanggal_po'
                    },
                    {
                        data: 'keterangan_penerimaan_po'
                    },
                    {
                        data: 'no_dtm'
                    },
                    {
                        data: 'hasil_akhir_tonase'
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
                        data: 'harga_berdasarkan_harga_atas'
                    },
                    {
                        data: 'aksi_harga'
                    },
                    {
                        data: 'harga_akhir'
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
                ajax: {
                    url: "{{ route('master.output_lab2_gb_pandan_wangi_qc_index') }}",
                    data: {
                        from_date: from_date,
                        to_date: to_date
                    }
                },
                columns: [{
                        data: "id_lab2_gb",

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
                        data: 'status_lab2_gb'
                    },
                    {
                        data: 'tanggal_po'
                    },
                    {
                        data: 'keterangan_penerimaan_po'
                    },
                    {
                        data: 'no_dtm'
                    },
                    {
                        data: 'hasil_akhir_tonase'
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
                        data: 'harga_berdasarkan_harga_atas'
                    },
                    {
                        data: 'aksi_harga'
                    },
                    {
                        data: 'harga_akhir'
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
                    url: "{{ route('master.output_lab2_gb_ketan_putih_qc_index') }}",
                    data: {
                        from_date: from_date,
                        to_date: to_date
                    }
                },
                columns: [{
                        data: "id_lab2_gb",

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
                        data: 'status_lab2_gb'
                    },
                    {
                        data: 'tanggal_po'
                    },
                    {
                        data: 'keterangan_penerimaan_po'
                    },
                    {
                        data: 'no_dtm'
                    },
                    {
                        data: 'hasil_akhir_tonase'
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
                        data: 'harga_berdasarkan_harga_atas'
                    },
                    {
                        data: 'aksi_harga'
                    },
                    {
                        data: 'harga_akhir'
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
                url: "{{route('master.download_output_lab2_excel')}}",
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
                    link.download = `DATA OUTPUT LAB 2 PT. SURYA PANGAN SEMESTA NGAWI.xlsx`;
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
        $(document).on('click', '#approved_lab2_notif', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Maaf!',
                icon: 'error',
                text: "Tonase Akhir Belum Di Input Oleh Admin Timbangan",
                position: top
            })
        });
        $('body').on('click', '#approved_lab2', function() {
            var cek = $(this).data('id');
            // console.log(cek);
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Ajukan Approve Ke SPV",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        title: 'Harap Tuggu Sebentar!',
                        html: 'Proses Menyimpan Data...', // add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                            $.ajax({
                                url: "{{route('master.approve_lab2_qc_gb')}}/" + cek,
                                type: "GET",
                                error: function() {
                                    alert('Something is wrong');
                                },
                                success: function(data) {
                                    Swal.fire({
                                        title: 'Berhasil',
                                        text: 'Data anda berhasil di Ajukan Apporove.',
                                        icon: 'success',
                                        timer: 1500
                                    })
                                    $('#data_longgrain').DataTable().ajax.reload();
                                    $('#data_ciherang').DataTable().ajax.reload();
                                    $('#data_pw').DataTable().ajax.reload();
                                    $('#data_kp').DataTable().ajax.reload();
                                }
                            });
                        }
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });

        });
        $(document).on('click', '#btn_update', function(a) {
            a.preventDefault();
            var status_plan_hpp = $('#status_plan_hpp').val();
            var status_harga_atas = $('#status_harga_atas').val();
            var status_harga_bawah = $('#status_harga_bawah').val();
            var id_gabahfinishing_qc = $('#id_gabahfinishing_qc').val();
            var gabahincoming_kode_po = $('#gabahincoming_kode_po').val();
            var gabahincoming_plat = $('#gabahincoming_plat').val();
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
            var hpp_aktual = $('#hpp_aktual').val();
            var plan_harga_beli_gabah = $('#plan_harga_beli_gabah').val();
            var aktual_price_ongkos_driyer = $('#aktual_price_ongkos_driyer').val();
            var plan_harga_aktual_pertruk = $('#plan_harga_aktual_pertruk').val();
            var plan_hpp_aktual1 = $('#plan_hpp_aktual1').val();

            var harga_berdasarkan_tempat = $('#harga_berdasarkan_tempat').val();
            var harga_berdasarkan_harga_atas = $('#harga_berdasarkan_harga_atas').val();
            var harga_awal = $('#harga_awal').val();
            var plan_harga_potongan_gb = $('#plan_harga_potongan_gb').val();
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
                    // console.log(result);
                    if (result.value) {
                        if ($('#ka_ks').val() == '' | $('#ka_kg').val() == '' | $('#berat_sample_awal_ks').val() == '' | $('#berat_sample_awal_kg').val() == '' | $('#berat_sample_akhir_kg').val() == '' | $('#berat_sample_pk').val() == '' | $('#berat_sample_beras').val() == '' | $('#wh').val() == '' | $('#tp').val() == '' | $('#md').val() == '' | $('#keterangan_lab_1').val() == '' | $('#broken_setelah_bongkar').val() == '') {
                            Swal.fire({
                                title: 'Maaf !',
                                text: 'Data Harus Diisi.',
                                icon: 'warning',
                                timer: 1500
                            })
                        } else if ($('#plan_harga_gb').val() == '' | $('#plan_harga_gb').val() == '0') {
                            Swal.fire({
                                title: 'Mohon Dicek!',
                                text: 'Harga Rp. 0',
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
                                            id_gabahfinishing_qc: id_gabahfinishing_qc,
                                            gabahincoming_kode_po: gabahincoming_kode_po,
                                            gabahincoming_plat: gabahincoming_plat,
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
                                            aktual_price_ongkos_driyer: aktual_price_ongkos_driyer,
                                            plan_harga_aktual_pertruk: plan_harga_aktual_pertruk,
                                            plan_hpp_aktual1: plan_hpp_aktual1,
                                            hpp_aktual: hpp_aktual,
                                            plan_harga_beli_gabah: plan_harga_beli_gabah,
                                            harga_berdasarkan_tempat: harga_berdasarkan_tempat,
                                            harga_berdasarkan_harga_atas: harga_berdasarkan_harga_atas,
                                            harga_awal: harga_awal,
                                            plan_harga_potongan_gb: plan_harga_potongan_gb,
                                        },
                                        url: "{{ route('master.update_lab2_gb') }}",
                                        type: "POST",
                                        dataType: 'json',
                                        success: function(data) {
                                            // console.log(data);
                                            // table.draw();
                                            $('#data_longgrain').DataTable().ajax.reload();
                                            $('#data_pw').DataTable().ajax.reload();
                                            $('#data_kp').DataTable().ajax.reload();
                                            $('#btn_update').html('Simpan');
                                            $('#modal_outputlab2').modal('hide');
                                            Swal.fire({
                                                title: 'success',
                                                Text: 'Data Berhasil DiSimpan',
                                                icon: 'success',
                                                timer: 1500
                                            })

                                        },
                                        error: function(data) {
                                            $('#btn_update').html('Simpan');
                                            $('#modal_outputlab2').modal('hide');
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
        $(document).on('click', '#btn_edit', function() {
            var id = $(this).attr("name");
            var tanggal_po = $(this).data('tanggalpo');
            var item = $(this).data('item');
            var id_penerimaan = $(this).data('id');
            var url = "{{ route('master.edit_lab2_gb') }}" + "/" + id;
            var url2 = "{{route('master.get_plan_hpp_gabah_basah') }}" + "/" + tanggal_po + "/" + item;
            var url3 = "{{route('get_price_top_gabah_basah') }}" + "/" + id_penerimaan;
            var url4 = "{{route('get_buttom_price_gabah_basah') }}" + "/" + id_penerimaan;
            // console.log(item);
            $('#form_outputlab2').trigger('reset');
            $('#modal_outputlab2').on('hidden.bs.modal', function(e) {
                $('#input_hpp').remove();
                // $('#min_tp').remove();
                // $('#operation').remove();
                // $('#max_tp').remove();
                // $('#harga_hpp').remove();
                $('#input_plan').empty();
                $('#input_hargaatas').empty();
                $('#input_hargabawah').empty();
            })
            $('#modal_outputlab2').modal('show');
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    // console.log(response);
                    var parsed = $.parseJSON(response);

                    $('#tanggal_po_gb').val(parsed.tanggal_po);
                    $('#item').val(item);
                    $('#id_gabahfinishing_qc').val(parsed.id_lab2_gb);
                    $('#harga_berdasarkan_tempat').val(parsed.harga_berdasarkan_tempat_gb);
                    $('#harga_berdasarkan_harga_atas').val(parsed.harga_berdasarkan_harga_atas_gb);
                    $('#aksi_harga').val(parsed.aksi_harga_gb);
                    $('#lokasi_bongkar').val(parsed.lokasi_bongkar_gb);
                    $('#id_penerimaan_po').val(parsed.id_penerimaan_po);
                    $('#id_data_po').val(parsed.id_data_po_gb);
                    $('#gabahincoming_kode_po').val(parsed.lab2_kode_po_gb);
                    $('#gabahincoming_plat').val(parsed.lab2_plat_gb);
                    $('#ka_ks').val(parsed.kadar_air_gb);
                    $('#ka_kg').val(parsed.ka_kg_gb);
                    $('#berat_sample_awal_ks').val(parsed.berat_sample_awal_ks_gb);
                    $('#berat_sample_awal_kg').val(parsed.berat_sample_awal_kg_gb);
                    $('#berat_sample_akhir_kg').val(parsed.berat_sample_akhir_kg_gb);
                    $('#berat_sample_pk').val(parsed.berat_sample_pk_gb);
                    $('#berat_sample_beras').val(parsed.randoman_gb);
                    $('#wh').val(parsed.wh_gb);
                    $('#tp').val(parsed.tp_gb);
                    $('#md').val(parsed.md_gb);
                    $('#hpp_aktual').val(parsed.plan_hpp_aktual_gb);
                    $('#plan_harga_potongan_gb').val(parsed.harga_akhir_gb);
                    $('#plan_harga_gb').val(parsed.harga_awal_gb);
                    $('#broken_setelah_bongkar').val(parsed.broken_gb);
                    $('#keterangan_lab1').val(parsed.keterangan_lab_gb);
                    $('#hasil_tonase').val(parsed.hasil_tonase);
                    if (parsed.netto2 == '' || parsed.netto2 == 'NULL') {
                        $('#hasil_tonase').val('0');
                    } else {
                        $('#hasil_tonase').val(parsed.netto2);
                    }
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
                    $('#katul').val(parsed.katul_gb);
                    $('#refraksi_broken').val(parsed.refraksi_broken_gb);
                    $('#plan_harga_gabah').val(parsed.plan_harga_gabah_gb);
                    $('#hampa').val(parsed.hampa_gb);
                    $('#lokasi_gt').val(parsed.lokasi_bongkar_gb);
                    $('#harga_awal').val(parsed.harga_awal_gb);
                    $('#plan_berat_kg_pertruk').val(parsed.plan_berat_kg_pertruk_gb);
                    $('#plan_berat_pk_pertruk').val(parsed.plan_berat_pk_pertruk_gb);
                    $('#plan_berat_beras_pertruk').val(parsed.plan_berat_beras_pertruk_gb);
                    $('#plan_harga_beli_gabah').val(parsed.plan_harga_beli_gabah_gb);
                    $('#plan_total_harga_gabah_pertruk').val(parsed.plan_total_harga_gabah_pertruk_gb);

                    $('#plan_harga_gabah_ongkos_dryer').val(parsed.plan_harga_gabah_ongkos_dryer_gb);
                    $('#plan_harga_pk_perkilo').val(parsed.plan_harga_pk_perkilo_gb);
                    $('#plan_harga_beras_perkilo').val(parsed.plan_harga_beras_perkilo_gb);
                    $('#plan_total_harga_pk_pertruk').val(parsed.plan_total_harga_pk_pertruk_gb);
                    $('#plan_total_harga_beras_pertruk').val(parsed.plan_total_harga_beras_pertruk_gb);
                    $('#aktual_price_ongkos_driyer').val(parsed.aktual_price_ongkos_driyer_gb);
                    $('#plan_harga_aktual_pertruk').val(parsed.plan_harga_aktual_pertruk_gb);
                    $('#plan_hpp_aktual1').val(parsed.plan_hpp_aktual1_gb);
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
                            text: 'SPV belum input PLAN HPP Sesuai Tanggal PO',
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
                            text: 'SPV belum input PLAN HPP Sesuai Tanggal PO',
                            icon: 'warning',
                            allowOutsideClick: false,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                    } else {
                        document.getElementById('hargabawah_success').style.display = 'block';
                        document.getElementById('status_harga_bawah').value = '1';
                        document.getElementById('hargabawah_error').style.display = 'none';

                        my_buttomprice.append("<dd class=" + 'col-sm-3 col-xs-12' + ">" + 'Harga&nbsp;Bawah' + "</dd><dd class=" + 'col-sm-1 col-xs-12' + ">:</dd><dd id=" + 'maxtp' + "  class=" + 'col-sm-3 col-xs-12' + ">Rp. " + formatRupiah(parsed.harga_bawah_gb) + "</dd>");

                    }
                    // console.log(parsed);

                }
            });
        });
    });
</script>

<script>
    var id_penerimaan_po = document.getElementById('id_penerimaan_po');
    var tanggal_po = document.getElementById('tanggal_po_gb');
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
    var hampa = document.getElementById('hampa');
    var lokasi_gt = document.getElementById('lokasi_bongkar');
    var harga_awal = document.getElementById('harga_awal');
    var plan_harga_gabah = document.getElementById('plan_harga_gabah');
    var plan_harga_beli_gabah = document.getElementById('plan_harga_beli_gabah');
    var plan_harga_gb = document.getElementById('plan_harga_gb');
    var plan_harga_potongan_gb = document.getElementById('plan_harga_potongan_gb');
    var item = document.getElementById('item');

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

    // function validasi() {
    //     var id_penerimaan = id_penerimaan_po.value;
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
    //                 // harga_atas = record.harga_atas_gb;
    //                 // console.log("harga atas Sudah Terisi");
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
    //                     text: 'SPV Belum input HARGA BAWAH Sesuai Tanggal PO',
    //                     icon: 'warning',
    //                     allowOutsideClick: false
    //                 })
    //             } else {
    //                 // console.log("harga Bawah Sudah Terisi");
    //             }
    //         }
    //     });
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
    //                     text: 'Harap input PLAN HPP Sesuai Tanggal PO: ' + tanggal_po_gb.value,
    //                     icon: 'warning',
    //                     allowOutsideClick: false
    //                 })
    //             } else {
    //                 // console.log("Plan HPP Sudah Terisi");
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
            plan_harga_gb.value == '0';
            plan_harga_potongan_gb.value == '0';
        } else {
            var hasil = "0";

            var berat_tonase = hasil_tonase.value;
            var id_penerimaan = id_penerimaan_po.value;
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

            var perhitungan_lan_hpp_aktual1 = hasil / (round(perhitungan_plan_rend_dari_ks_beras, 2) / 100);
            plan_hpp_aktual1.value = round(perhitungan_lan_hpp_aktual1, 0);

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
            // console.log("prsentase kg pk = " + round(perhitungan_prsentase_kg_pk, 8));
            // console.log("adjust prosentase kg pk = " + round(perhitungan_adjust_prosentase_kg_pk, 8));
            // console.log("presentase ks pk = " + round(round(perhitungan_presentase_ks_pk, 8) / 100, 10));
            // console.log("presentase putih = " + round(perhitungan_presentase_putih, 8));
            // console.log("adjust prosentase kg ke putih = " + round(perhitungan_adjust_prosentase_kg_ke_putih, 2));
            // console.log("plan rend dari ks beras = " + round(perhitungan_plan_rend_dari_ks_beras, 2));
            // console.log("katul = " + round(perhitungan_katul, 2));
            // console.log("refraksi broken = " + refraksi_broken.value);
            // console.log(" harga Atas gabah = " + round(perhitungan_hasil));
            // console.log("plan harga gabah = " + plan_harga_gabah.value);
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
            // console.log("Plan HPP Aktual = " + round(perhitungan_lan_hpp_aktual1, 2));

            plan_harga_gb.value = harga_awal.value;
            plan_harga_potongan_gb.value = hasil;
        }
    }
    var typingTimer; //timer identifier
    var doneTypingInterval = 2000;
    id_penerimaan_po.addEventListener('keyup', function(e) {
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
            return NaN;

        // Shift
        value = value.toString().split('e');
        value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));

        // Shift back
        value = value.toString().split('e');
        return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
    }
</script>
@endsection