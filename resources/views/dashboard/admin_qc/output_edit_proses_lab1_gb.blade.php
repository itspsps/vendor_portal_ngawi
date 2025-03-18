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
                        Hasil Lab Incoming
                    </a>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        Edit Lab Incoming
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
                            Lab 1 Gabah Basah
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 order-lg-1 order-xl-1">
                        </div>
                        <div class="col-xl-6 col-lg-6 order-lg-1 order-xl-1">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="gabahincoming_id_data_po" id="gabahincoming_id_data_po" value="{{$data->lab1_id_data_po_gb}}">
                            <input type="hidden" name="gabahincoming_id_penerimaan_po" id="gabahincoming_id_penerimaan_po" value="{{$data->lab1_id_penerimaan_po_gb}}">
                            <input type="hidden" id="id_gabahincoming_qc" name="id_gabahincoming_qc" value="{{$data->id_lab1_gb}}">
                            <input type="hidden" id="nama_supplier" name="nama_supplier" value="{{$data->name}}">
                            <input type="hidden" id="no_supplier" name="no_supplier" value="{{$data->nomer_hp}}">
                            {{-- tambahan input --}}
                            <input type="hidden" id="hampa" name="hampa" value="{{$data->hampa_gb}}">
                            <input type="hidden" id="kg_after_adjust_hampa" name="kg_after_adjust_hampa" value="{{$data->kg_after_adjust_hampa_gb}}">
                            <input type="hidden" id="prosentasi_kg" name="prosentasi_kg" value="{{$data->prosentasi_kg_gb}}">
                            <input type="hidden" id="susut" name="susut" value="{{$data->susut_gb}}">
                            <input type="hidden" id="item" name="item" value="{{$data->name_bid}}">
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
                            <input type="hidden" id="plan_harga_gabah" name="plan_harga_gabah" value="{{$data->plan_harga_gabah_gb}}">
                            <input type="hidden" id="lokasibongkar" name="lokasibongkar" value="{{$data->lokasi_bongkar_gb}}">
                            <input type="hidden" id="keteranganlab1" name="keteranganlab1" value="{{$data->output_lab_gb}}">
                            <input type="hidden" id="tanggal_po" name="tanggal_po" value="{{$data->tanggal_po}}">
                            <input type="hidden" id="date_bid" name="date_bid" value="{{$data->date_bid}}">
                            <input type="hidden" id="PONum" name="PONum" value="{{$data->PONum}}">
                            <input type="hidden" id="no_hp" name="no_hp" value="{{$data->nomer_hp}}">
                            <input type="hidden" id="status_plan_hpp" name="status_plan_hpp">
                            <input type="hidden" id="status_harga_atas" name="status_harga_atas">
                            <input type="hidden" id="status_harga_bawah" name="status_harga_bawah">
                            <input type="hidden" id="status_pending" name="status_pending">
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
                            <div id="planhpp" class="form-group row">
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Kode PO</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" id="gabahincoming_kode_po" name="gabahincoming_kode_po" class="form-control m-input" readonly value="{{$data->lab1_kode_po_gb}}">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Nopol</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" id="gabahincoming_plat" readonly name="gabahincoming_plat" class="form-control m-input" value="{{$data->lab1_plat_gb}}">
                                </div>
                            </div>
                            {{-- edit form --}}
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">KA KS</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="kadar_air" id="kadar_air" class="form-control m-input" value="{{$data->kadar_air_gb}}">
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
                                    <input type="text" step="any" required name="randoman" id="randoman" class="form-control m-input" value="{{$data->randoman_gb}}">
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
                                    <input type="text" step="any" required name="broken" id="broken" class="form-control m-input" value="{{$data->broken_gb}}">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="keterangan_lab1" id="keterangan_lab1" class="form-control m-input" value="{{$data->keterangan_lab_gb}}">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Plan Harga (Kg)</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <span class="btn btn-label-success mb-1" id="result_harga_akhir" style="font-weight: bold; font-size: 13pt;"></span>
                                    <br><button id="btn_lihat_harga" class="btn btn-label-primary btn-bold btn-sm"> <i class="fa fa-eye"> </i>Lihat Harga</button>
                                    <input readonly type="hidden" step="any" required name="plan_harga" id="plan_harga" class="form-control m-input" value="{{$data->plan_harga_gb}}">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Status Lab</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <span class="btn mb-1" id="result_hasil_lab" style="font-weight: bold; font-size: 12pt;"></span>
                                    <input type="hidden" id="keterangan_lab_1" name="keterangan_lab_1" value="{{$data->output_lab_gb}}">
                                    <select class="form-select form-control m-input" id="select_keterangan_lab_1" required name="select_keterangan_lab_1" aria-label="Default select example">
                                        <option {{$data->output_lab_gb == 'Unload' ?'selected' : ''}} value="Unload">Bongkar</option>
                                        <option {{$data->output_lab_gb == 'Pending' ?'selected' : ''}} value="Pending">Pending</option>
                                        <option {{$data->output_lab_gb == 'Reject' ?'selected' : ''}} value="Reject">Tolak</option>
                                    </select>
                                    <br><button id="btn_ubah_hasil" class="btn btn-label-primary btn-bold btn-sm"> <i class="fa fa-edit"> </i>Ubah Hasil</button>
                                    <button id="btn_tutup_hasil" class="btn btn-label-danger btn-bold btn-sm">X</button>
                                </div>
                            </div>
                            <div class="text-center">
                                <button id="btn_update" data-bs-toggle="tooltip" data-placement="top" title="Klik Lihat Harga Dahulu" class="btn btn-sm btn-success m-btn">Simpan</button>
                                <a href="{{route('qc.lab.output_proses_lab1_gb')}}" type="button" class="btn btn-sm btn-danger m-btn">Kembali</a>
                            </div>
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
        var id = '{{$data->id_lab1_gb}}';
        var vendor = '{{$data->nama_vendor}}';
        var id_penerimaan = '{{$data->lab1_id_penerimaan_po_gb}}';
        // console.log(id_penerimaan);
        var data_output_lab = '{{$data->output_lab_gb}}';
        var item = '{{$data->name_bid}}';
        var result_plan_harga = '{{$data->plan_harga_gb}}';
        var result_hasil_lab = '{{$data->output_lab_gb}}';
        var tanggal_po = '{{$data->tanggal_bongkar}}';
        var url2 = "{{route('qc.lab.get_plan_hpp_gabah_basah') }}" + "/" + tanggal_po + "/" + item;
        var url3 = "{{route('get_price_top_gabah_basah') }}" + "/" + id_penerimaan;
        var url4 = "{{route('get_buttom_price_gabah_basah') }}" + "/" + id_penerimaan;
        $('#result_harga_akhir').html("Rp. " + formatRupiah(result_plan_harga));
        if (data_output_lab == 'Unload') {
            $('#result_hasil_lab').html('BONGKAR').addClass('btn-label-success');
        } else if (data_output_lab == 'Pending') {
            $('#result_hasil_lab').html('PENDING').addClass('btn-label-warning');
        } else if (data_output_lab == 'Reject') {
            $('#result_hasil_lab').html('TOLAK').addClass('btn-label-danger');
        }
        $('#select_keterangan_lab_1').hide();
        $('#btn_tutup_hasil').hide();

        $('#btn_ubah_hasil').show();
        $('#btn_save').prop('disabled', true);
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
        $(document).on('change', '#select_keterangan_lab_1', function() {
            var this_id = $(this).val();
            $('#keterangan_lab_1').val(this_id);
            if (this_id == 'Unload') {
                $('#keterangan_lab_1').val('Unload');
                $('#result_hasil_lab').html("BONGKAR").removeClass('btn-label-danger').removeClass('btn-label-warning').addClass('btn-label-success');
            } else if (this_id == 'Pending') {
                $('#result_hasil_lab').html("PENDING").removeClass('btn-label-danger').removeClass('btn-label-success').addClass('btn-label-warning');
                $('#keterangan_lab_1').val('Pending');
            } else {
                $('#result_hasil_lab').html("TOLAK").removeClass('btn-label-success').removeClass('btn-label-warning').addClass('btn-label-danger');
                $('#keterangan_lab_1').val('Reject');
            }
            // console.log(this_id);
        });
        $(document).on('click', '#btn_ubah_hasil', function() {
            $('#select_keterangan_lab_1').show();
            $(this).hide();
            $('#btn_tutup_hasil').show();

        });
        $(document).on('click', '#btn_tutup_hasil', function() {
            $('#select_keterangan_lab_1').hide();
            $(this).hide();
            $('#btn_tutup_hasil').hide();
            $('#btn_ubah_hasil').show();

        });
        $(document).on('click', '#btn_lihat_harga', function() {
            $('#result_harga_akhir').show();
            $('#result_hasil_lab').show();
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
            console.log(keterangan_lab_1);
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
                                            url: "{{ route('qc.lab.update_proses1_gabah_basah') }}",
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
                                                    window.location.href = "{{ route('qc.lab.output_proses_lab1_gb') }}";
                                                } else {
                                                    window.location.href = "{{ route('qc.lab.output_proses_lab1_gb') }}";
                                                }

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
                                            url: "{{ route('qc.lab.update_proses1_gabah_basah') }}",
                                            type: "POST",
                                            dataType: 'json',
                                            success: function(response) {
                                                if (data == 'success') {
                                                    $('#btn_update').html('Simpan');
                                                    Swal.fire({
                                                        title: 'success',
                                                        Text: 'Data Berhasil DiSimpan',
                                                        icon: 'success',
                                                        timer: 1500
                                                    })
                                                    window.location.href = "{{ route('qc.lab.output_proses_lab1_gb') }}";
                                                } else {
                                                    window.location.href = "{{ route('qc.lab.output_proses_lab1_gb') }}";

                                                }
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
                                            url: "{{ route('qc.lab.update_proses1_gabah_basah') }}",
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
                                                    window.location.href = "{{ route('qc.lab.output_proses_lab1_gb') }}";
                                                } else {
                                                    window.location.href = "{{ route('qc.lab.output_proses_lab1_gb') }}";

                                                }
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
        Swal.close();
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
            $('#btn_update').prop('disabled', true);
            hasil = '0';
            $('#result_harga_akhir').html(formatRupiah(hasil, "Rp. "));
        } else {
            $('#btn_lihat_harga').removeAttr('title');
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
                console.log(std_hpp_incoming);

                //                     }

            });
            // console.log(min_tp,max_tp, harga_hpp);
            var perhitungan_plan_harga_gabah = ((round(perhitungan_plan_rend_dari_ks_beras, 2) / 100) * std_hpp_incoming) - 75;
            plan_harga_gabah.value = roundHalfUp(perhitungan_plan_harga_gabah, 1);
            hasil = roundHalfUp(plan_harga_gabah.value, 0);
            // console.log('hasil:' + hasil);

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
            // console.log(harga_bawah_gb);
            // console.log(harga_bawah_gb1);
            if (hasil == 0 || hasil == '') {
                plan_harga.value = "0";
            } else if (hasil >= harga_bawah_gb1 && hasil <= harga_bawah_gb) {
                console.log("konfirmasi");
                $('#result_hasil_lab').removeClass('btn-label-success').removeClass('btn-label-danger');
                $('#result_hasil_lab').html('PENDING').addClass('btn-label-warning');
                $('#select_keterangan_lab_1 > option[value="Pending"]').prop('selected', true);
                $('#select_keterangan_lab_1 > option[value="Reject"]').attr('selected', false);
                $('#select_keterangan_lab_1 > option[value="Unload"]').attr('selected', false);
                $('#select_keterangan_lab_1 > option[value="Unload"]').attr('disabled', true);
                $('#select_keterangan_lab_1 > option[value="Pending"]').attr('disabled', false);
                $('#select_keterangan_lab_1 > option[value="Reject"]').attr('disabled', false);
                status_pending.value = 'Pending Harga';
            } else if (hasil <= harga_bawah_gb1) {
                $('#result_hasil_lab').removeClass('btn-label-warning').removeClass('btn-label-success');
                $('#result_hasil_lab').html('TOLAK').addClass('btn-label-danger');
                $('#select_keterangan_lab_1 > option[value="Reject"]').prop('selected', true);
                $('#select_keterangan_lab_1 > option[value="Pending"]').attr('selected', false);
                $('#select_keterangan_lab_1 > option[value="Unload"]').attr('selected', false);
                $('#select_keterangan_lab_1 > option[value="Pending"]').attr('disabled', true);
                $('#select_keterangan_lab_1 > option[value="Unload"]').attr('disabled', true);
                $('#select_keterangan_lab_1 > option[value="Reject"]').attr('disabled', false);
                console.log("tolak");
            } else {
                $('#result_hasil_lab').removeClass('btn-label-danger').removeClass('btn-label-warning');
                $('#result_hasil_lab').html('BONGKAR').addClass('btn-label-success');
                console.log("bongkar");
                $('#select_keterangan_lab_1 > option[value="Unload"]').prop('selected', true);
                $('#select_keterangan_lab_1 > option[value="Pending"]').attr('selected', false);
                $('#select_keterangan_lab_1 > option[value="reject"]').attr('selected', false);
                $('#select_keterangan_lab_1 > option[value="Unload"]').attr('disabled', false);
                $('#select_keterangan_lab_1 > option[value="Pending"]').attr('disabled', false);
                $('#select_keterangan_lab_1 > option[value="reject"]').attr('disabled', false);
            }
            var perhitungan_hampa = (berat_sample_awal_kg.value - berat_sample_akhir_kg.value) / (berat_sample_awal_kg.value / 100);
            hampa.value = round(perhitungan_hampa, 1);
            // console.log("id_penerimaan = " + id_penerimaan);
            // console.log("Hampa = " + round(perhitungan_hampa, 8));
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
            // console.log("Katul = " + round(perhitungan_katul, 2));
            // console.log("plan rend dari ks beras = " + round(perhitungan_plan_rend_dari_ks_beras, 2));
            // console.log("PLAN = " + std_hpp_incoming);
            // console.log("refraksi broken = " + refraksi_broken.value);
            // console.log("plan harga gabah = " + plan_harga_gabah.value);
            // console.log("hasil akhir = " + roundHalfUp(plan_harga_gabah.value, 0));

            plan_harga.value = hasil;
            $('#result_harga_akhir').html("Rp. " + formatRupiah(plan_harga.value, "Rp. "));
        }
    }
    var typingTimer; //timer identifier
    var doneTypingInterval = 2000;

    function roundHalfUp(value, decimals) {
        return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
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