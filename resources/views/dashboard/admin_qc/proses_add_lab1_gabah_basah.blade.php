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
                        Proses Lab Incoming
                    </a>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        Input Lab Incoming
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
                            <!-- <form id="formproseslab1" class="m-form m-form--fit m-form--label-align-right" method="post" action="javascript:void(0);" enctype="multipart/form-data">
                                @csrf -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" id="lab1_id_data_po_gb" name="lab1_id_data_po_gb" value="{{$data->penerimaan_id_data_po}}">
                            <input type="hidden" id="id_penerimaan_po_gb" name="id_penerimaan_po_gb" value="{{$data->id_penerimaan_po}}">
                            <input type="hidden" id="lab1_id_bid_user_gb" name="lab1_id_bid_user_gb" value="{{$data->penerimaan_id_bid_user}}">
                            <input type="hidden" id="tanggal_po_gb" name="tanggal_po_gb" value="{{$data->tanggal_po}}">
                            <input type="hidden" id="waktu_penerimaan_gb" name="waktu_penerimaan_gb" value="{{$data->waktu_penerimaan}}">
                            <input type="hidden" id="date_bid_gb" name="date_bid_gb" value="{{$data->date_bid}}">
                            <input type="hidden" id="nama_supplier" name="nama_supplier" value="{{$data->name}}">
                            <input type="hidden" id="no_supplier" name="no_supplier" value="{{$data->nomer_hp}}">

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
                            <input type="hidden" id="PONum" name="PONum" value="{{$data->PONum}}">
                            <input type="hidden" id="item" name="item" value="{{$data->name_bid}}">
                            <input type="hidden" id="antrian" name="antrian">
                            <input type="hidden" id="status_pending" name="status_pending">
                            <input type="hidden" id="status_plan_hpp" name="status_plan_hpp">
                            <input type="hidden" id="status_harga_atas" name="status_harga_atas">
                            <input type="hidden" id="status_harga_bawah" name="status_harga_bawah">
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
                                    <input type="hidden" id="lab1_plat_gb" value="{{$data->plat_kendaraan}}" readonly name="lab1_plat_gb" class="form-control m-input">
                                    <input type="text" id="lab1_kode_po_gb" name="lab1_kode_po_gb" value="{{$data->penerimaan_kode_po}}" class="form-control m-input" readonly>
                                </div>
                            </div>
                            <div id="planhpp" class="form-group"></div>

                            {{-- edit form --}}
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">KA KS</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="kadar_air_gb" id="kadar_air_gb" class="form-control m-input" value="">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">KA KG</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="ka_kg_gb" id="ka_kg_gb" class="form-control m-input" value="">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Berat Sample Awal KS</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="berat_sample_awal_ks_gb" id="berat_sample_awal_ks_gb" class="form-control m-input" value="">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Berat Sample Awal KG</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="berat_sample_awal_kg_gb" id="berat_sample_awal_kg_gb" class="form-control m-input" value="">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Berat Sample Akhir KG</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="berat_sample_akhir_kg_gb" id="berat_sample_akhir_kg_gb" class="form-control m-input" value="">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Berat Sample PK</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="berat_sample_pk_gb" id="berat_sample_pk_gb" class="form-control m-input" value="">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Berat Sample Beras</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="randoman_gb" id="randoman_gb" class="form-control m-input" value="">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">WH</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="wh_gb" id="wh_gb" class="form-control m-input" value="">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">TP</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="tp_gb" id="tp_gb" class="form-control m-input" value="">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">MD</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="md_gb" id="md_gb" class="form-control m-input" value="">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Broken Setelah Bongkar</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="broken_gb" id="broken_gb" class="form-control m-input" value="">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <input type="text" step="any" required name="keterangan_lab_gb" id="keterangan_lab_gb" class="form-control m-input">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Plan Harga (Kg)</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <span class="btn btn-label-success mb-1" id="result_harga_akhir" style="font-weight: bold; font-size: 13pt;">0</span>
                                    <br><button id="btn_lihat_harga" class="btn btn-label-primary btn-bold btn-sm"> <i class="fa fa-eye"> </i>Lihat Harga</button>
                                    <input readonly type="hidden" step="any" required name="plan_harga_gb" id="plan_harga_gb" class="form-control m-input">
                                </div>
                            </div>
                            <div class="m-form__group form-group row">
                                <label class="col-xl-3 col-lg-3 col-sm-3 col-form-label">Status Lab</label>
                                <div class="col-lg-1 col-xl-1 col-sm-1 col-form-label">
                                    :
                                </div>
                                <div class="col-lg-8 col-xl-8 col-sm-8">
                                    <span class="btn btn-label-success mb-1" id="result_hasil_lab" style="font-weight: bold; font-size: 12pt;"></span>
                                    <input type="hidden" id="keterangan_lab_1_gb" name="keterangan_lab_1_gb" value="">
                                    <select class="form-select form-control m-input" id="select_keterangan_lab_1_gb" required name="select_keterangan_lab_1_gb" aria-label="Default select example">
                                        <option name="select_keterangan_lab_1_gb" value="Unload">Bongkar</option>
                                        <option name="select_keterangan_lab_1_gb" value="Pending">Pending</option>
                                        <option name="select_keterangan_lab_1_gb" value="Reject">Tolak</option>
                                    </select>
                                    <br><button id="btn_ubah_hasil" class="btn btn-label-primary btn-bold btn-sm"> <i class="fa fa-edit"> </i>Ubah Hasil</button>
                                    <button id="btn_tutup_hasil" class="btn btn-label-danger btn-bold btn-sm">X</button>
                                </div>
                            </div>
                            <div class="text-center">
                                <button id="btn_save" data-bs-toggle="tooltip" data-placement="top" class="btn btn-sm btn-success m-btn">Simpan</button>
                                <a href="{{route('qc.lab.proses_lab1_gabah_basah')}}" type="button" class="btn btn-sm btn-danger m-btn">Kembali</a>
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
<script type="text/javascript">
    $(function() {
        var id = '{{$data->id_penerimaan_po}}';
        var vendor = '{{$data->nama_vendor}}';
        var item = '{{$data->name_bid}}';
        var tanggal_po = '{{$data->tanggal_bongkar}}';
        var url2 = "{{route('qc.lab.get_plan_hpp_gabah_basah') }}" + "/" + tanggal_po + "/" + item;
        var url3 = "{{route('get_price_top_gabah_basah') }}" + "/" + id;
        var url4 = "{{route('get_buttom_price_gabah_basah') }}" + "/" + id;
        $('#result_harga_akhir').show();
        $('#result_hasil_lab').hide();
        $('#select_keterangan_lab_1_gb').hide();
        $('#btn_tutup_hasil').hide();
        $('#btn_ubah_hasil').hide();
        $('#btn_save').prop('disabled', true);
        $('#btn_save').attr('title', 'Klik Lihat Harga Dahulu');
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
        $(document).on('change', '#select_keterangan_lab_1_gb', function() {
            var this_id = $(this).val();
            $('#keterangan_lab_1_gb').val(this_id);
            if (this_id == 'Unload') {
                $('#result_hasil_lab').html("BONGKAR").removeClass('btn-label-danger').removeClass('btn-label-warning').addClass('btn-label-success');
                $('#keterangan_lab_1_gb').val('Unload');
            } else if (this_id == 'Pending') {
                $('#result_hasil_lab').html("PENDING").removeClass('btn-label-danger').removeClass('btn-label-success').addClass('btn-label-warning');
                $('#keterangan_lab_1_gb').val('Pending');
            } else {
                $('#result_hasil_lab').html("TOLAK").removeClass('btn-label-success').removeClass('btn-label-warning').addClass('btn-label-danger');
                $('#keterangan_lab_1_gb').val('Reject');
            }
            // console.log(this_id);
        });
        $(document).on('click', '#btn_ubah_hasil', function() {
            $('#select_keterangan_lab_1_gb').show();
            $(this).hide();
            $('#btn_tutup_hasil').show();

        });
        $(document).on('click', '#btn_tutup_hasil', function() {
            $('#select_keterangan_lab_1_gb').hide();
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
            Swal.fire({
                title: 'Harap Tuggu Sebentar!',
                html: 'Analisa Data Double', // add html attribute if you want or remove
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    $.ajax({
                        data: {
                            kode_po: lab1_kode_po_gb,
                        },
                        url: "{{ route('qc.lab.check_input_lab1') }}",
                        type: "GET",
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            if (data == 'double') {
                                Swal.fire({
                                    title: 'Maaf, Anda Tidak Bisa Input',
                                    text: 'Data Sudah Tersedia',
                                    icon: 'warning',
                                    allowOutsideClick: false
                                })
                                $('#btn_save').html('Simpan');
                            } else {
                                if (status_plan_hpp == '1' && status_harga_atas == '1' && status_harga_bawah == '1') {
                                    Swal.close();
                                    Swal.fire({
                                        title: 'Konfirmasi',
                                        icon: 'warning',
                                        text: "Apakah data yang kamu input sudah benar ?",
                                        html: '<p>Apakah data yang kamu input sudah benar ?</p><h5>Harga Lab : Rp. ' + formatRupiah(plan_harga_gb) + '</h5>',
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
                                                                    if (data == 'success') {
                                                                        Swal.fire({
                                                                            title: 'Berhasil',
                                                                            text: 'Data Berhasil Disimpan ',
                                                                            icon: 'success',
                                                                            timer: 1500

                                                                        })
                                                                        window.location.href = "{{ route('qc.lab.proses_lab1_gabah_basah') }}";
                                                                    } else {
                                                                        window.location.href = "{{ route('qc.lab.proses_lab1_gabah_basah') }}";

                                                                    }
                                                                },
                                                                error: function(data) {
                                                                    $('#btn_save').html('Simpan');
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
                                                                    if (data == 'success') {
                                                                        Swal.fire({
                                                                            title: 'success',
                                                                            Text: 'Data Berhasil DiSimpan',
                                                                            icon: 'success',
                                                                            timer: 1500
                                                                        })
                                                                        window.location.href = "{{ route('qc.lab.proses_lab1_gabah_basah') }}";
                                                                    } else {
                                                                        window.location.href = "{{ route('qc.lab.proses_lab1_gabah_basah') }}";

                                                                    }
                                                                },
                                                                error: function(data) {
                                                                    $('#btn_save').html('Simpan');
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
                                                                    if (data == 'success') {
                                                                        Swal.fire({
                                                                            title: 'success',
                                                                            Text: 'Data Berhasil DiSimpan',
                                                                            icon: 'success',
                                                                            timer: 1500
                                                                        })
                                                                        window.location.href = "{{ route('qc.lab.proses_lab1_gabah_basah') }}";
                                                                    } else {
                                                                        window.location.href = "{{ route('qc.lab.proses_lab1_gabah_basah') }}";

                                                                    }
                                                                },
                                                                error: function(data) {
                                                                    $('#btn_save').html('Simpan');
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
                            }
                        },
                    })
                }
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

    function rumus() {
        Swal.close();
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
            $('#select_keterangan_lab_1_gb > option[value="Unload"]').prop('selected', false);
            $('#select_keterangan_lab_1_gb > option[value="Pending"]').attr('selected', false);
            $('#select_keterangan_lab_1_gb > option[value="reject"]').attr('selected', false);
            $('#btn_save').prop('disabled', true);
            plan_harga.value = "0";
            hasil = '0';
            $('#result_harga_akhir').html(formatRupiah(hasil, "Rp. "));

        } else {
            $('#btn_lihat_harga').removeAttr('title');
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
            plan_harga_gabah_gb.value = roundHalfUp(perhitungan_plan_harga_gabah, 1);
            hasil = roundHalfUp(plan_harga_gabah_gb.value, 0);
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
                $('#result_hasil_lab').html("PENDING").removeClass('btn-label-danger').removeClass('btn-label-success').addClass('btn-label-warning');
                $('#keterangan_lab_1_gb').val('Pending');
                $('#select_keterangan_lab_1_gb > option[value="Pending"]').prop('selected', true);
                $('#select_keterangan_lab_1_gb > option[value="Reject"]').attr('selected', false);
                $('#select_keterangan_lab_1_gb > option[value="Unload"]').attr('selected', false);
                $('#select_keterangan_lab_1_gb > option[value="Unload"]').attr('disabled', true);
                $('#select_keterangan_lab_1_gb > option[value="Pending"]').attr('disabled', false);
                $('#select_keterangan_lab_1_gb > option[value="Reject"]').attr('disabled', false);
                status_pending.value = 'Pending Harga';
                $('#btn_save').prop('disabled', false);
            } else if (hasil <= harga_bawah_gb1) {
                $('#result_hasil_lab').html("TOLAK").removeClass('btn-label-success').removeClass('btn-label-warning').addClass('btn-label-danger');
                $('#keterangan_lab_1_gb').val('Reject');
                $('#select_keterangan_lab_1_gb > option[value="Reject"]').prop('selected', true);
                $('#select_keterangan_lab_1_gb > option[value="Pending"]').attr('selected', false);
                $('#select_keterangan_lab_1_gb > option[value="Unload"]').attr('selected', false);
                $('#select_keterangan_lab_1_gb > option[value="Pending"]').attr('disabled', true);
                $('#select_keterangan_lab_1_gb > option[value="Unload"]').attr('disabled', true);
                $('#select_keterangan_lab_1_gb > option[value="Reject"]').attr('disabled', false);
                $('#btn_save').prop('disabled', false);
                console.log("tolak");
            } else {
                console.log("bongkar");
                $('#result_hasil_lab').html("BONGKAR").removeClass('btn-label-danger').removeClass('btn-label-warning').addClass('btn-label-success');
                $('#keterangan_lab_1_gb').val('Unload');
                $('#select_keterangan_lab_1_gb > option[value="Unload"]').prop('selected', true);
                $('#select_keterangan_lab_1_gb > option[value="Pending"]').attr('selected', false);
                $('#select_keterangan_lab_1_gb > option[value="reject"]').attr('selected', false);
                $('#select_keterangan_lab_1_gb > option[value="Unload"]').attr('disabled', false);
                $('#select_keterangan_lab_1_gb > option[value="Pending"]').attr('disabled', false);
                $('#select_keterangan_lab_1_gb > option[value="reject"]').attr('disabled', false);
                $('#btn_save').prop('disabled', false);

            }
            var perhitungan_hampa = (berat_sample_awal_kg_gb.value - berat_sample_akhir_kg_gb.value) / (berat_sample_awal_kg_gb.value / 100);
            hampa_gb.value = round(perhitungan_hampa, 1);
            // console.log("id_penerimaan = " + id_penerimaan);
            // console.log("Hampa = " + hampa_gb.value)
            // console.log("kg after djust hampa = " + kg_after_adjust_hampa_gb.value);
            // console.log("prosentasi kg = " + round(perhitungan_prosentasi_kg, 7));

            // console.log("susut = " + round(perhitungan_susut, 7));
            // console.log("adjust susut = " + round(perhitungan_adjust_susut, 2));
            // console.log("presentase ks kg after adjust = " + round(perhitungan_prsentase_ks_kg_after_adjust_susut, 2));
            // console.log("prsentase kg pk = " + round(perhitungan_prsentase_kg_pk, 7));
            // console.log("adjust prosentase kg pk = " + round(perhitungan_adjust_prosentase_kg_pk, 7));
            // console.log("presentase ks pk = " + round(perhitungan_presentase_ks_pk, 7));
            // console.log("presentase putih = " + round(perhitungan_presentase_putih, 7));
            // console.log("adjust prosentase kg ke putih = " + round(perhitungan_adjust_prosentase_kg_ke_putih, 7));
            // console.log("Katul = " + round(perhitungan_katul, 7));
            // console.log("plan rend dari ks beras = " + round(perhitungan_plan_rend_dari_ks_beras, 3));
            // console.log("PLAN = " + std_hpp_incoming);
            // console.log("refraksi broken = " + refraksi_broken_gb.value);
            // console.log("plan harga gabah = " + plan_harga_gabah_gb.value);
            // console.log("hasil akhir = " + hasil)

            plan_harga.value = hasil;
            $('#result_harga_akhir').html("Rp. " + formatRupiah(plan_harga.value, "Rp. "));
            $('#btn_save').attr('title', '');
            $('#btn_ubah_hasil').show();
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