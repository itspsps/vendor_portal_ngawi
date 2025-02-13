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
                    PT. SURYA PANGAN SEMESTA
                </h3>
                <span class="btn-outline btn-sm btn-info mr-3">NGAWI</span>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        Hasil Lab Bongkaran
                    </a>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        Edit Lab Bongkaran
                    </a>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        Gabah Basah
                    </a>
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
                            Lab 2 Gabah Basah
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 order-lg-1 order-xl-1">
                        </div>
                        <div class="col-xl-6 col-lg-6 order-lg-1 order-xl-1">
                            <!-- <form id="formproseslab1" class="m-form m-form--fit m-form--label-align-right" method="post" action="javascript:void(0);" enctype="multipart/form-data">
                                @csrf -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_data_po" id="id_data_po" value="{{$data->id_data_po_gb}}">
                            <input type="hidden" name="id_penerimaan_po" id="id_penerimaan_po" value="{{$data->id_penerimaan_po}}">
                            <input type="hidden" id="id_gabahfinishing_qc" name="id_gabahfinishing_qc" value="{{$data->id_lab2_gb}}">
                            <input type="hidden" id="tanggal_po_gb" name="tanggal_po_gb" value="{{$data->tanggal_po}}">
                            <input type="hidden" id="item" name="item" value="{{$data->name_bid}}">
                            <!--<label>Hasil Tonase</label>-->
                            <input type="hidden" id="hasil_tonase" name="hasil_tonase" value="{{$data->hasil_tonase}}">
                            <!--<label>Plan Berat KG/Truk</label>-->
                            <input type="hidden" id="plan_berat_kg_pertruk" name="plan_berat_kg_pertruk" value="{{$data->plan_berat_kg_pertruk}}">
                            <!--<label>Plan Berat PK/Truk</label>-->
                            <input type="hidden" id="plan_berat_pk_pertruk" name="plan_berat_pk_pertruk" value="{{$data->plan_berat_pk_pertruk_gb}}">
                            <!--<label>Plan Berat Beras/Truk</label>-->
                            <input type="hidden" id="plan_berat_beras_pertruk" name="plan_berat_beras_pertruk" value="{{$data->plan_berat_beras_pertruk_gb}}">
                            <!--<label>HPP Aktual</label>-->
                            <input type="hidden" id="hpp_aktual" name="hpp_aktual" value="{{$data->plan_hpp_aktual_gb}}">
                            <!--<label>Plan Harga Gabah Ongkos Dryer</label>-->
                            <input type="hidden" id="plan_harga_gabah_ongkos_dryer" name="plan_harga_gabah_ongkos_dryer" value="{{$data->plan_harga_gabah_ongkos_dryer_gb}}">
                            <!--<label>Plan Harga PK/Kilo</label>-->
                            <input type="hidden" id="plan_harga_pk_perkilo" name="plan_harga_pk_perkilo" value="{{$data->plan_harga_pk_perkilo_gb}}">
                            <!--<label>Plan Harga Beras/Kilo</label>-->
                            <input type="hidden" id="plan_harga_beras_perkilo" nameS="plan_harga_beras_perkilo" value="{{$data->plan_harga_beras_perkilo_gb}}">
                            <!--<label>Plan Total Harga Gabah/Truk</label>-->
                            <input type="hidden" id="plan_total_harga_gabah_pertruk" name="plan_total_harga_gabah_pertruk" value="{{$data->plan_total_harga_pk_pertruk_gb}}">
                            <!--<label>Plan Total Harga PK/Truk</label>-->
                            <input type="hidden" id="plan_total_harga_pk_pertruk" name="plan_total_harga_pk_pertruk" value="{{$data->plan_total_harga_pk_pertruk_gb}}">
                            <!--<label>Plan Total Harga Beras/Truk</label>-->
                            <input type="hidden" id="plan_total_harga_beras_pertruk" name="plan_total_harga_beras_pertruk" value="{{$data->plan_total_harga_beras_pertruk_gb}}">
                            <!-- <p>P</p> -->
                            <input type="hidden" id="aktual_price_ongkos_driyer" name="aktual_price_ongkos_driyer">
                            <input type="hidden" id="plan_harga_aktual_pertruk" name="plan_harga_aktual_pertruk">
                            <input type="hidden" id="plan_hpp_aktual1" name="plan_hpp_aktual1">

                            {{-- tambahan input --}}
                            <input type="hidden" id="hampa" name="hampa" value="{{$data->hampa_gb}}">
                            <input type="hidden" id="kg_after_adjust_hampa" name="kg_after_adjust_hampa" value="{{$data->kg_after_adjust_hampa_gb}}">
                            <input type="hidden" id="prosentasi_kg" name="prosentasi_kg" value="{{$data->prosentasi_kg_gb}}">
                            <input type="hidden" id="susut" name="susut" value="{{$data->susut_gb}}">
                            <input type="hidden" id="adjust_susut" name="adjust_susut" value="{{$data->adjust_susut_gb}}">
                            <input type="hidden" id="prsentase_ks_kg_after_adjust_susut" name="prsentase_ks_kg_after_adjust_susut" value="{{$data->prsentase_ks_kg_after_adjust_susut_gb}}">
                            <input type="hidden" id="prsentase_kg_pk" name="prsentase_kg_pk" value="{{$data->prsentase_kg_pk_gb}}">
                            <input type="hidden" id="adjust_prosentase_kg_pk" name="adjust_prosentase_kg_pk" value="{{$data->adjust_prosentase_kg_pk_gb}}">
                            <input type="hidden" id="presentase_ks_pk" name="presentase_ks_pk" value="{{$data->presentase_ks_pk_gb}}">
                            <input type="hidden" id="presentase_putih" name="presentase_putih" value="{{$data->presentase_putih_gb}}">
                            <input type="hidden" id="adjust_prosentase_kg_ke_putih" name="adjust_prosentase_kg_ke_putih" value="{{$data->adjust_prosentase_kg_ke_putih_gb}}">
                            <input type="hidden" id="plan_rend_dari_ks_beras" name="plan_rend_dari_ks_beras" value="{{$data->plan_rend_dari_ks_beras_gb}}">
                            <input type="hidden" id="katul" name="katul" value="{{$data->katul_gb}}">
                            <input type="hidden" id="refraksi_broken" name="refraksi_broken" value="{{$data->refraksi_broken_gb}}">
                            <input type="hidden" id="harga_berdasarkan_tempat" name="harga_berdasarkan_tempat" value="{{$data->harga_berdasarkan_tempat_gb}}">
                            <input type="hidden" id="harga_berdasarkan_harga_atas" name="harga_berdasarkan_harga_atas" value="{{$data->harga_berdasarkan_harga_atas_gb}}">
                            <input type="hidden" id="harga_awal" name="harga_awal" value="{{$data->harga_awal_gb}}">
                            <input type="hidden" id="plan_harga_gabah" name="plan_harga_gabah" value="{{$data->plan_harga_gabah_gb}}">
                            <input type="hidden" id="plan_harga_beli_gabah" name="plan_harga_beli_gabah" value="{{$data->plan_harga_beli_gabah_gb}}">
                            <div id="planhpp" class="form-group row"></div>
                            <div id="planhpp_success" class="btn btn-label-info mb-3 col-sm-12">
                                <dl id="getplan" class="dl-horizontal row">
                                    <label class="col-sm-12" style="font-weight: bold; font-size: medium;">Parameter PLAN HPP</label>
                                    <dd class="col-sm-3" style="font-weight: bold;">Min&nbsp;TP</dd>
                                    <dd class="col-sm-3" style="font-weight: bold;"></dd>
                                    <dd class="col-sm-3" style="font-weight: bold;">Max&nbsp;TP</dd>
                                    <dd class="col-sm-3" style="font-weight: bold;">Harga</dd>
                                </dl>
                                <dl id="input_plan" class="dl-horizontal row">
                                </dl>
                            </div>
                            <a href="javascript:void(0);" id="notif_hpp_error">
                                <div id="planhpp_error" class="btn btn-label-danger mb-3 col-sm-12">
                                    <label class="col-sm-12" style="font-weight: bold; font-size: medium;"><i class="fa fa-minus-circle"></i> Parameter PLAN HPP Belum Diisi SPV</label>
                                </div>
                            </a>
                            <div id="hargaatas_success" class="btn btn-label-info mb-3 col-sm-12">
                                <dl id="get_hargaatas" class="dl-horizontal row">
                                    <label class="col-sm-12" style="font-weight: bold; font-size: medium;">Parameter Harga Atas</label>
                                </dl>
                                <dl id="input_hargaatas" class="dl-horizontal row">
                                </dl>
                            </div>
                            <a href="javascript:void(0);" id="notif_harga_atas_error">
                                <div id="hargaatas_error" class="btn btn-label-danger mb-3 col-sm-12">
                                    <label class="col-sm-12" style="font-weight: bold; font-size: medium;"><i class="fa fa-minus-circle"></i> Parameter HARGA ATAS Belum Diisi SPV</label>
                                </div>
                            </a>
                            <div id="hargabawah_success" class="btn btn-label-info mb-3 col-sm-12">
                                <dl id="get_hargabawah" class="dl-horizontal row">
                                    <label class="col-sm-12" style="font-weight: bold; font-size: medium;">Parameter Harga Bawah</label>
                                </dl>
                                <dl id="input_hargabawah" class="dl-horizontal row">
                                </dl>
                            </div>
                            <a href="javascript:void(0);" id="notif_harga_bawah_error">
                                <div id="hargabawah_error" class="btn btn-label-danger mb-3 col-sm-12">
                                    <label class="col-sm-12" style="font-weight: bold; font-size: medium;"><i class="fa fa-minus-circle"></i> Parameter HARGA BAWAH Belum Diisi SPV</label>
                                </div>
                            </a>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Kode PO</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" id="gabahincoming_kode_po" name="gabahincoming_kode_po" class="form-control m-input" value="{{$data->lab2_kode_po_gb}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Nopol Kendaraan</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" id="gabahincoming_plat" value="{{$data->lab2_plat_gb}}" readonly name="gabahincoming_plat" class="form-control m-input">
                                </div>
                            </div>

                            {{-- edit form --}}
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">KA KS</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="ka_ks" id="ka_ks" class="form-control m-input" value="{{$data->kadar_air_gb}}">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">KA KG</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="ka_kg" id="ka_kg" class="form-control m-input" value="{{$data->ka_kg_gb}}">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Berat Sample Awal KS</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="berat_sample_awal_ks" id="berat_sample_awal_ks" class="form-control m-input" value="{{$data->berat_sample_awal_ks_gb}}">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Berat Sample Awal KG</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="berat_sample_awal_kg" id="berat_sample_awal_kg" class="form-control m-input" value="{{$data->berat_sample_awal_kg_gb}}">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Berat Sample Akhir KG</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="berat_sample_akhir_kg" id="berat_sample_akhir_kg" class="form-control m-input" value="{{$data->berat_sample_akhir_kg_gb}}">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Berat Sample PK</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="berat_sample_pk" id="berat_sample_pk" class="form-control m-input" value="{{$data->berat_sample_pk_gb}}">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Berat Sample Beras</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="berat_sample_beras" id="berat_sample_beras" class="form-control m-input" value="{{$data->randoman_gb}}">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">WH</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="wh" id="wh" class="form-control m-input" value="{{$data->wh_gb}}">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">TP</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="tp" id="tp" class="form-control m-input" value="{{$data->tp_gb}}">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">MD</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="md" id="md" class="form-control m-input" value="{{$data->md_gb}}">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Broken Setelah Bongkar</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="broken_setelah_bongkar" id="broken_setelah_bongkar" class="form-control m-input" value="{{$data->broken_gb}}">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">NO.&nbsp;DTM</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" required name="dtm" id="dtm" required class="form-control m-input" value="{{$data->dtm_gb}}">
                                    <span class="btn btn-label-info btn-sm "><i class="flaticon2-information"></i><b> Edit Jika No. DTM Salah</b></span>
                                </div>
                            </div>

                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Lokasi Bongkar</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <select class="form-select form-control m-input" name="lokasi_bongkar" id="lokasi_bongkar" aria-label="Default select example">
                                        <option {{ $data->lokasi_bongkar_gb == '' ? 'selected' : '' }} value="" selected>--Pilih Lokasi Bongkar--</option>
                                        <option {{ $data->lokasi_bongkar_gb == 'UTARA' ? 'selected' : '' }} value="UTARA">UTARA</option>
                                        <option {{ $data->lokasi_bongkar_gb == 'SELATAN' ? 'selected' : '' }} value="SELATAN">SELATAN</option>
                                    </select>
                                    <span class="btn btn-label-info btn-sm "><i class="flaticon2-information"></i><b> Edit Jika Lokasi Bongkar Salah</b></span>
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" readonly required name="keterangan_lab1" id="keterangan_lab1" class="form-control m-input" value="{{$data->keterangan_lab_gb}}">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Plan Harga (Kg)</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <span class="btn btn-label-success mb-1" id="result_harga_gb" style="font-weight: bold; font-size: 13pt;">0</span>
                                    <br><input type="hidden" step="any" required name="plan_harga_gb" id="plan_harga_gb" class="form-control m-input" value="{{$data->harga_awal_gb}}">
                                    <button id="btn_lihat_harga" class="btn btn-label-primary btn-bold btn-sm"> <i class="fa fa-eye"> </i>Lihat Harga</button>
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Plan Harga Akhir - Rp.14 (Rp/Kg)</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <span class="btn btn-label-success mb-1" id="result_harga_akhir" style="font-weight: bold; font-size: 13pt;">0</span>
                                    <input type="hidden" step="any" required name="plan_harga_potongan_gb" id="plan_harga_potongan_gb" class="form-control m-input" value="{{$data->harga_akhir_gb}}">
                                </div>
                            </div>
                            <div class="text-center">
                                <button id="btn_update" data-bs-toggle="tooltip" data-placement="top" title="Klik Lihat Harga Dahulu" class="btn btn-sm btn-success m-btn">Simpan</button>
                                <a href="{{route('qc.lab.output_proses_lab2_gb')}}" type="button" class="btn btn-sm btn-danger m-btn">Kembali</a>
                            </div>
                            <!-- </form> -->
                        </div>
                        <div class="col-xl-3 col-lg-3 order-lg-1 order-xl-1">
                        </div>
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
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
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
<script type="text/javascript">
    $(function() {
        var id = '{{$data->id_penerimaan_po}}';
        var vendor = '{{$data->nama_vendor}}';
        var item = '{{$data->name_bid}}';
        var tanggal_po = '{{$data->tanggal_bongkar}}';
        var url2 = "{{route('qc.lab.get_plan_hpp_gabah_basah') }}" + "/" + tanggal_po + "/" + item;
        var url3 = "{{route('get_price_top_gabah_basah') }}" + "/" + id;
        var url4 = "{{route('get_buttom_price_gabah_basah') }}" + "/" + id;
        var edit_harga_awal = '{{$data->harga_awal_gb}}';
        var edit_harga_akhir = '{{$data->harga_akhir_gb}}';
        $('#result_harga_gb').show();
        $('#result_harga_gb').html(formatRupiah(edit_harga_awal));
        $('#result_harga_akhir').show();
        $('#result_harga_akhir').html(formatRupiah(edit_harga_akhir));
        $('#select_keterangan_lab_1_gb').hide();
        $('#btn_tutup_hasil').hide();
        $('#btn_ubah_hasil').hide();
        $('#btn_save').prop('disabled', true);
        $('#planhpp_success').hide();
        $('#planhpp_error').hide();
        $('#hargaatas_success').hide();
        $('#hargaatas_error').hide();
        $('#hargabawah_success').hide();
        $('#hargabawah_error').hide();
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
                } else {
                    document.getElementById('planhpp_success').style.display = 'block';
                    document.getElementById('planhpp_error').style.display = 'none';

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
                } else {
                    document.getElementById('hargaatas_success').style.display = 'block';
                    document.getElementById('hargaatas_error').style.display = 'none';
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
                } else {
                    document.getElementById('hargabawah_success').style.display = 'block';
                    document.getElementById('hargabawah_error').style.display = 'none';
                    my_buttomprice.append("<dd class=" + 'col-sm-3 col-xs-12' + ">" + 'Harga&nbsp;Bawah' + "</dd><dd class=" + 'col-sm-1 col-xs-12' + ">:</dd><dd id=" + 'maxtp' + "  class=" + 'col-sm-3 col-xs-12' + ">Rp. " + formatRupiah(parsed.harga_bawah_gb) + "</dd>");

                }
                // console.log(parsed);

            }
        });

        $(document).on('click', '#btn_lihat_harga', function() {
            $('#result_harga_akhir').show();
            $('#result_hasil_lab').show();
            $('#result_harga_gb').show();
            Swal.fire({
                allowOutsideClick: false,
                background: 'transparent',
                html: ' <div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div>',
                showCancelButton: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    // Swal.showLoading()
                }
            });
            clearTimeout(typingTimer);
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        $(document).on('click', '#btn_update', function(a) {
            a.preventDefault();
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
                        $('#btn_update').html('Simpan');
                    } else if ($('#plan_harga_gb').val() == '' | $('#plan_harga_gb').val() == '0') {
                        $('#btn_update').html('Simpan');
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
                                    url: "{{ route('qc.lab.update_lab2_gb') }}",
                                    type: "POST",
                                    dataType: 'json',
                                    success: function(data) {
                                        if (data == 'success') {
                                            $('#btn_update').html('Simpan');
                                            Swal.fire({
                                                title: 'success',
                                                Text: 'Data Berhasil DiSimpan',
                                                icon: 'success',
                                                timer: 1500
                                            })
                                            window.location.href = "{{ route('qc.lab.output_proses_lab2_gb') }}";
                                        } else {
                                            window.location.href = "{{ route('qc.lab.output_proses_lab2_gb') }}";

                                        }
                                    },
                                    error: function(data) {
                                        $('#btn_update').html('Simpan');
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
                    $('#btn_update').html('Simpan');
                }
            });
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
    var plan_harga_gabah = document.getElementById('plan_harga_gabah');
    var hampa = document.getElementById('hampa');
    var lokasi_gt = document.getElementById('lokasi_bongkar');
    var harga_awal = document.getElementById('harga_awal');
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

    function rumus() {
        Swal.close();
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
                                window.location.href = "{{ route('qc.lab.harga_atas_gabah_basah') }}";

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
                                window.location.href = "{{ route('qc.lab.harga_bawah_gabah_basah') }}";

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
                            text: 'Harap input PLAN HPP Sesuai Tanggal Bongkar: ' + tanggal_po_gb.value,
                            icon: 'warning',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "{{ route('qc.lab.plan_hpp_gabah_basah') }}";

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
            console.log("id_penerimaan = " + id_penerimaan);
            console.log("Hampa = " + hampa.value)
            console.log("kg after djust hampa = " + kg_after_adjust_hampa.value);
            console.log("prosentasi kg = " + round(perhitungan_prosentasi_kg, 2));
            console.log("susut = " + round(perhitungan_susut, 2));
            console.log("adjust susut = " + round(perhitungan_adjust_susut, 2));
            console.log("presentase ks kg after adjust = " + round(perhitungan_prsentase_ks_kg_after_adjust_susut, 2));
            console.log("prsentase kg pk = " + round(perhitungan_prsentase_kg_pk, 8));
            console.log("adjust prosentase kg pk = " + round(perhitungan_adjust_prosentase_kg_pk, 8));
            console.log("presentase ks pk = " + round(round(perhitungan_presentase_ks_pk, 8) / 100, 10));
            console.log("presentase putih = " + round(perhitungan_presentase_putih, 8));
            console.log("adjust prosentase kg ke putih = " + round(perhitungan_adjust_prosentase_kg_ke_putih, 2));
            console.log("plan rend dari ks beras = " + round(perhitungan_plan_rend_dari_ks_beras, 2));
            console.log("katul = " + round(perhitungan_katul, 2));
            console.log("refraksi broken = " + refraksi_broken.value);
            console.log("plan harga gabah = " + round(perhitungan_plan_harga_gabah, 1));
            console.log("hasil akhir = " + hasil);
            console.log("-----------------------------------------------------------------")
            console.log("perhitungan plan berat kg pertruk = " + plan_berat_kg_pertruk.value);
            console.log("perhitungan plan berat pk pertruk = " + plan_berat_pk_pertruk.value);
            console.log("perhitungan plan berat beras per truk = " + round(perhitungan_plan_berat_beras_pertruk, 0));
            console.log("plan harga gabah ongkos dryer = " + round(perhitungan_plan_harga_gabah_ongkos_dryer, 6));
            console.log("plan harga pk perkilo = " + round(perhitungan_plan_harga_pk_perkilo, 9));
            console.log("plan harga beras perkilo = " + plan_harga_beras_perkilo.value);
            console.log("plan total harga gabah pertruk = " + plan_total_harga_gabah_pertruk.value);
            console.log("plan total harga pk pertruk = " + round(perhitungan_plan_total_harga_pk_pertruk, 2));
            console.log("plan total harga beras pertruk = " + plan_total_harga_beras_pertruk.value);
            console.log("-----------------------------------------------------------------")
            console.log("Aktual Price + Ongkos Driyer Perkg = " + aktual_price_ongkos_driyer.value);
            console.log("Plan Harga Aktual per truk = " + round(perhitungan_plan_harga_aktual_pertruk, 0));
            console.log("Plan HPP Aktual = " + round(plan_hpp_aktual1, 4));

            plan_harga_gb.value = harga_awal.value;
            $('#result_harga_gb').html(formatRupiah(plan_harga_gb.value, "Rp. "))
            plan_harga_potongan_gb.value = hasil;
            $('#result_harga_akhir').html(formatRupiah(plan_harga_potongan_gb.value));
            // $('#btn_save').removeAttribute('title');
            $('#btn_update').prop('disabled', false);
        }
    }
    var typingTimer; //timer identifier
    var doneTypingInterval = 2000;




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