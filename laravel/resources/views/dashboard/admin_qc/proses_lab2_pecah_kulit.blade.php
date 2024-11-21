@extends('dashboard.admin_qc.layout.main')
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
                            <i class="kt-menu__link-icon flaticon2-analytics-2 kt-font-warning"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Proses Lab 2 Pecah Kulit
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:2%">No</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp; </th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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



        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="formfinishing_qc" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('qc.lab.save_proses_lab2_pk') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Data LAB 2</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="lab2_token" value="{{ csrf_token() }}">
                            <input type="hidden" id="lab1_id_data_po_pk" name="lab1_id_data_po_pk">
                            <input type="hidden" id="lab1_id_penerimaan_po_pk" name="lab1_id_penerimaan_po_pk">
                            <input type="hidden" id="lab1_id_bid_user_pk" name="lab1_id_bid_user_pk">
                            <input type="hidden" id="tanggal_po_pk" name="tanggal_po_pk">
                            <input type="hidden" id="waktu_penerimaan_pk" name="waktu_penerimaan_pk">
                            <input type="hidden" id="date_bid_pk" name="date_bid_pk">

                            {{-- tambahan input --}}
                            <label>presentase</label>
                            <input type="text" id="presentase_hampa_pk" name="presentase_hampa_pk">
                            <input type="text" id="presentase_pk_bersih_pk" name="presentase_pk_bersih_pk">
                            <input type="text" id="presentase_katul_pk" name="presentase_katul_pk">
                            <input type="text" id="presentase_beras_pk" name="presentase_beras_pk">
                            <input type="text" id="presentase_butir_patah_pk" name="presentase_butir_patah_pk">
                            <input type="text" id="presentase_butir_patah_beras_pk" name="presentase_butir_patah_beras_pk">
                            <input type="text" id="presentase_reject_pk" name="presentase_reject_pk">
                            <label>Refraksi</label>
                            <input type="text" id="refraksi_ka_pk" name="refraksi_ka_pk">
                            <input type="text" id="refraksi_hampa_pk" name="refraksi_hampa_pk">
                            <input type="text" id="refraksi_katul_pk" name="refraksi_katul_pk">
                            <input type="text" id="refraksi_tr_pk" name="refraksi_tr_pk">
                            <input type="text" id="refraksi_butir_patah_pk" name="refraksi_butir_patah_pk">
                            <label>Reward</label>
                            <input type="text" id="reward_hampa_pk" name="reward_hampa_pk">
                            <input type="text" id="reward_katul_pk" name="reward_katul_pk">
                            <input type="text" id="reward_tr_pk" name="reward_tr_pk">
                            <input type="text" id="reward_butir_patah_pk" name="reward_butir_patah_pk">
                            <label>Kualitas</label>
                            <input type="text" id="plan_kualitas_pk" name="plan_kualitas_pk">
                            <input type="text" id="harga_atas_pk" name="harga_atas_pk">
                            <input type="text" id="plan_harga_bongkaran" name="plan_harga_bongkaran">
                            <input type="text" id="plan_harga_aktual_pk" name="plan_harga_aktual_pk">
                            <input type="text" id="harga_awal_pk" name="harga_awal_pk">
                            <label>Analisa Checker</label>
                            <input type="text" id="presentase_pass" name="presentase_pass">
                            <input type="text" id="presentase_reject" name="presentase_reject">
                            <label>Tonase</label>
                            <input type="text" id="plan_tonase_pk" name="plan_tonase_pk">
                            <input type="text" id="plan_total_harga_pk" name="plan_total_harga_pk">
                            <input type="text" id="plan_tonase_beras_pk" name="plan_tonase_beras_pk">
                            <label>SELISIH</label>
                            <input type="text" id="selisih_ka_pk" name="selisih_ka_pk">
                            <input type="text" id="selisih_presentase_hampa_pk" name="selisih_presentase_hampa_pk">
                            <input type="text" id="selisih_presentase_rendemen_pk_pk" name="selisih_presentase_rendemen_pk_pk">
                            <input type="text" id="selisih_presentase_katul_pk" name="selisih_presentase_katul_pk">
                            <input type="text" id="selisih_presentase_rendemen_beras_pk" name="selisih_presentase_rendemen_beras_pk">
                            <input type="text" id="selisih_presentase_butir_patah_pk" name="selisih_presentase_butir_patah_pk">
                            <input type="text" id="selisih_wh_pk" name="selisih_wh_pk">
                            <input type="text" id="selisih_tr_pk" name="selisih_tr_pk">
                            <input type="text" id="selisih_md_pk" name="selisih_md_pk">
                            <input type="text" id="selisih_harga_pk" name="selisih_harga_pk">
                            <input type="text" id="selisih_aktual_kualitas_pk" name="selisih_aktual_kualitas_pk">
                            <input type="text" id="selisih_kualitas_bongkaran_pk" name="selisih_kualitas_bongkaran_pk">
                            <label>INPUT LAB 1</label>
                            <input type="text" id="lab1_ka_pk" name="lab1_ka_pk">
                            <input type="text" id="lab1_presentase_hampa_pk" name="lab1_presentase_hampa_pk">
                            <input type="text" id="lab1_presentase_pk_bersih_pk" name="lab1_presentase_pk_bersih_pk">
                            <input type="text" id="lab1_presentase_katul_pk" name="lab1_presentase_katul_pk">
                            <input type="text" id="lab1_presentase_beras_pk" name="lab1_presentase_beras_pk">
                            <input type="text" id="lab1_presentase_butir_patah_beras_adjust_pk" name="lab1_presentase_butir_patah_beras_adjust_pk">
                            <input type="text" id="lab1_wh_pk" name="lab1_wh_pk">
                            <input type="text" id="lab1_tr_pk" name="lab1_tr_pk">
                            <input type="text" id="lab1_md_pk" name="lab1_md_pk">
                            <input type="text" id="lab1_harga_awal_pk" name="lab1_harga_awal_pk">
                            <input type="text" id="lab1_aktual_kualitas_pk" name="lab1_aktual_kualitas_pk">

                            <div id="parameter_ka_pk" class="form-group"></div>
                            <div id="parameter_hampa_pk" class="form-group"></div>
                            <div id="parameter_katul_pk" class="form-group"></div>
                            <div id="parameter_tr_pk" class="form-group"></div>
                            <div id="parameter_butir_patah_pk" class="form-group"></div>
                            <div id="parameter_reward_hampa_pk" class="form-group"></div>
                            <div id="parameter_reward_katul_pk" class="form-group"></div>
                            <div id="parameter_reward_tr_pk" class="form-group"></div>
                            <div id="parameter_reward_butir_patah_pk" class="form-group"></div>
                            <div id="parameter_butir_patah_pk_kualitas" class="form-group"></div>
                            <div class="form-group">
                                <div class="">
                                    <label>Code PO</label>
                                    <input type="text" id="lab1_kode_po_pk" name="lab1_kode_po_pk" class="form-control m-input" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Plat</label>
                                    <input type="text" id="lab1_plat_pk" readonly name="lab1_plat_pk" class="form-control m-input">
                                </div>
                            </div>

                            {{-- edit form --}}
                            <div class="m-form__group form-group">
                                <label for="">KA</label>
                                <input type="text" step="any" required name="ka_pk" id="ka_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">PK</label>
                                <input type="text" step="any" required name="pk_pk" id="pk_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">PK Bersih</label>
                                <input type="text" step="any" required name="pk_bersih_pk" id="pk_bersih_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Beras </label>
                                <input type="text" step="any" required name="beras_pk" id="beras_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Butir Patah</label>
                                <input type="text" step="any" required name="butir_patah_pk" id="butir_patah_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Reject</label>
                                <input type="text" step="any" required name="reject_pk" id="reject_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Hampa</label>
                                <input type="text" step="any" required readonly name="hampa_pk" id="hampa_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Katul</label>
                                <input type="text" step="any" required readonly name="katul_pk" id="katul_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">WH</label>
                                <input type="text" step="any" required name="wh_pk" id="wh_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">TR</label>
                                <input type="text" step="any" required name="tr_pk" id="tr_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">MD</label>
                                <input type="text" step="any" required name="md_pk" id="md_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Harga Bongkaran (Kg)</label>
                                <input readonly type="text" step="any" required name="harga_bongkaran_pk" id="harga_bongkaran_pk" value="" class="form-control m-input">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Aksi Harga</label>
                                <input type="text" readonly name="aksi_harga_pk" id="aksi_harga_pk" value="ON PROCESS" class="form-control m-input">

                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Lokasi Bongkar</label>
                                <input type="text" readonly required name="lokasi_bongkar_pk" id="lokasi_bongkar_pk" required class="form-control m-input">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">DTM</label>
                                <input type="text" readonly required name="no_dtm_pk" id="no_dtm_pk" required class="form-control m-input">
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
                            <button id="btn_save" type="submit" class="btn btn-success m-btn pull-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(function() {
            var table = $('#datatable').DataTable({
                "scrollY": true,
                "scrollX": true,
                processing: true,
                serverSide: true,
                "aLengthMenu": [
                    [25, 100, 300, -1],
                    [25, 100, 300, "All"]
                ],
                "iDisplayLength": 10,
                ajax: "{{ route('qc.lab.proses_lab2_pecah_kulit_index') }}",
                columns: [{
                        data: "id_bid",

                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
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
                "order": []
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
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
                        if ($('#z_yang_dibawa').val() == '' | $('#broken_setelah_bongkar').val() == '' | $('#tp').val() == '' | $('#berat_sample_pk').val() == '' | $('#ka_ks').val() == '' | $('#ka_kg').val() == '' | $('#berat_sample_akhir_kg').val() == '' | $('#berat_sample_awal_ks').val() == '' | $('#berat_sample_awal_kg').val() == '' | $('#md').val() == '' | $('#tp').val() == '' | $('#wh').val() == '' | $('#berat_sample_beras').val() == '') {
                            Swal.fire('Gagal!', 'Data Harus Diisi Semua', 'error')
                        } else if ($('#harga_bongkaran_pk').val() == '' | $('#harga_bongkaran_pk').val() == '0') {
                            Swal.fire('Mohon Dicek!', 'Harga Bongkaran Rp. 0', 'warning')
                        } else {
                            $('#formfinishing_qc').submit();
                            Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                        }
                    } else {
                        Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                    }
                });
            });
            $(document).on('click', '#btn_finishing_qc', function() {
                var id = $(this).attr("name");
                var idtopprice = $(this).data('id');
                var tanggal_po = $(this).data('tanggalpo');
                var url = "{{ route('qc.lab.show_lab2_pk') }}" + "/" + id;
                var url2 = "{{route('qc.lab.get_parameter_lab_pk_kadar_air') }}" + "/" + tanggal_po;
                var url3 = "{{route('qc.lab.get_parameter_lab_pk_hampa') }}" + "/" + tanggal_po;
                var url4 = "{{route('qc.lab.get_parameter_lab_pk_katul') }}" + "/" + tanggal_po;
                var url5 = "{{route('qc.lab.get_parameter_lab_pk_tr') }}" + "/" + tanggal_po;
                var url6 = "{{route('qc.lab.get_parameter_lab_pk_butiran_patah') }}" + "/" + tanggal_po;
                var url7 = "{{route('qc.lab.get_parameter_lab_pk_kualitas') }}" + "/" + tanggal_po;
                var url8 = "{{route('get_price_top_pecah_kulit') }}" + "/" + idtopprice;
                var url9 = "{{route('qc.lab.get_parameter_lab_pk_reward_hampa') }}" + "/" + tanggal_po;
                var url10 = "{{route('qc.lab.get_parameter_lab_pk_reward_tr') }}" + "/" + tanggal_po;
                var url11 = "{{route('qc.lab.get_parameter_lab_pk_reward_katul') }}" + "/" + tanggal_po;
                var url12 = "{{route('qc.lab.get_parameter_lab_pk_reward_butir_patah') }}" + "/" + tanggal_po;
                console.log(url);
                $('#formfinishing_qc').trigger('reset');
                //   $('#modal2').removeData();
                //   location.reload();
                $('#modal2').on('hidden.bs.modal', function(e) {
                    location.reload();
                    $('#modal2').show();
                })
                $('#modal2').modal('show');
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        console.log(response);
                        var parsed = $.parseJSON(response);
                        $('#lab1_kode_po_pk').val(parsed.lab1_kode_po_pk);
                        $('#lab1_plat_pk').val(parsed.lab1_plat_pk);
                        $('#lab1_id_data_po_pk').val(parsed.lab1_id_data_po_pk);
                        $('#lab1_id_penerimaan_po_pk').val(parsed.lab1_id_penerimaan_po_pk);
                        $('#lab1_id_bid_user').val(parsed.lab1_id_bid_user);
                        $('#no_dtm_pk').val(parsed.no_dtm);
                        $('#surveyor_bongkar').val(parsed.surveyor_bongkar);
                        $('#keterangan_bongkar').val(parsed.keterangan_bongkar);
                        $('#waktu_bongkar').val(parsed.waktu_bongkar);
                        $('#lokasi_bongkar_pk').val(parsed.tempat_bongkar);
                        $('#z_yang_dibawa').val(parsed.z_yang_dibawa);
                        // input lab1
                        $('#lab1_harga_awal_pk').val(parsed.harga_awal_pk);
                        $('#lab1_ka_pk').val(parsed.ka_pk);
                        $('#lab1_presentase_hampa_pk').val(parsed.presentase_hampa_pk);
                        $('#lab1_presentase_pk_bersih_pk').val(parsed.presentase_pk_bersih_pk);
                        $('#lab1_presentase_katul_pk').val(parsed.presentase_katul_pk);
                        $('#lab1_presentase_beras_pk').val(parsed.presentase_beras_pk);
                        $('#lab1_presentase_butir_patah_beras_adjust_pk').val(parsed.presentase_butir_patah_beras_adjust_pk);
                        $('#lab1_wh_pk').val(parsed.wh_pk);
                        $('#lab1_tr_pk').val(parsed.tr_pk);
                        $('#lab1_md_pk').val(parsed.md_pk);
                        $('#lab1_aktual_kualitas_pk').val(parsed.aktual_kualitas_pk);

                        $('#z_yang_ditolak').val(parsed.z_yang_ditolak);
                        //console.log(parsed.lokasi_bongkar);
                    }
                });
                $.ajax({
                    type: "GET",
                    url: url2,
                    success: function(response) {
                        var my_orders = $('#parameter_ka_pk')
                        var parsed = JSON.parse(response);
                        // console.log(parsed);
                        $.each(parsed, function(item) {
                            my_orders.append("<input type=" + 'hidden' + " class=" + 'parameter_ka_pk' + " value=" + parsed[item].min_ka_parameter_lab_pk_ka + '#' + parsed[item].max_ka_parameter_lab_pk_ka + '#' + parsed[item].harga_parameter_lab_pk_ka + ">");
                        });
                    }
                });
                $.ajax({
                    type: "GET",
                    url: url3,
                    success: function(response) {
                        var my_orders = $('#parameter_hampa_pk')
                        var parsed = JSON.parse(response);
                        // console.log(parsed);
                        $.each(parsed, function(item) {
                            my_orders.append("<input type=" + 'hidden' + " class=" + 'parameter_hampa_pk' + " value=" + parsed[item].min_parameter_lab_pk_hampa + '#' + parsed[item].max_parameter_lab_pk_hampa + '#' + parsed[item].harga_parameter_lab_pk_hampa + ">");
                        });
                    }
                });
                $.ajax({
                    type: "GET",
                    url: url4,
                    success: function(response) {
                        var my_orders = $('#parameter_katul_pk')
                        var parsed = JSON.parse(response);
                        // console.log(parsed);
                        $.each(parsed, function(item) {
                            my_orders.append("<input type=" + 'hidden' + " class=" + 'parameter_katul_pk' + " value=" + parsed[item].min_parameter_lab_pk_katul + '#' + parsed[item].max_parameter_lab_pk_katul + '#' + parsed[item].harga_parameter_lab_pk_katul + ">");
                        });
                    }
                });
                $.ajax({
                    type: "GET",
                    url: url5,
                    success: function(response) {
                        var my_orders = $('#parameter_tr_pk')
                        var parsed = JSON.parse(response);
                        // console.log(parsed);
                        $.each(parsed, function(item) {
                            my_orders.append("<input type=" + 'hidden' + " class=" + 'parameter_tr_pk' + " value=" + parsed[item].min_parameter_lab_pk_tr + '#' + parsed[item].max_parameter_lab_pk_tr + '#' + parsed[item].harga_parameter_lab_pk_tr + '#' + parsed[item].kualitas_parameter_lab_pk_tr + ">");
                        });
                    }
                });
                $.ajax({
                    type: "GET",
                    url: url6,
                    success: function(response) {
                        var my_orders = $('#parameter_butir_patah_pk')
                        var parsed = JSON.parse(response);
                        // console.log(parsed);
                        $.each(parsed, function(item) {
                            my_orders.append("<input type=" + 'hidden' + " class=" + 'parameter_butir_patah_pk' + " value=" + parsed[item].min_parameter_lab_pk_butiran_patah + '#' + parsed[item].max_parameter_lab_pk_butiran_patah + '#' + parsed[item].harga_parameter_lab_pk_butiran_patah + ">");
                        });
                    }
                });
                $.ajax({
                    type: "GET",
                    url: url7,
                    success: function(response) {
                        var my_orders = $('#parameter_butir_patah_pk_kualitas')
                        var parsed = JSON.parse(response);
                        console.log(parsed);
                        $.each(parsed, function(item) {
                            my_orders.append("<input type=" + 'hidden' + " class=" + 'parameter_butir_patah_pk_kualitas' + " value=" + parsed[item].min_parameter_lab_pk_tr_kualitas + '#' + parsed[item].max_parameter_lab_pk_tr_kualitas + '#' + parsed[item].min_parameter_lab_pk_butirpatah_kualitas + '#' + parsed[item].max_parameter_lab_pk_butirpatah_kualitas + '#' + parsed[item].kualitas_parameter_lab_pk + ">");
                        });
                    }
                });
                $.ajax({
                    type: "GET",
                    url: url8,
                    success: function(response) {
                        var parsed = $.parseJSON(response);
                        $('#harga_atas_pk').val(parsed.harga_atas_pk);
                    }
                });
                $.ajax({
                    type: "GET",
                    url: url9,
                    success: function(response) {
                        var my_orders = $('#parameter_reward_hampa_pk')
                        var parsed = JSON.parse(response);
                        console.log(parsed);
                        $.each(parsed, function(item) {
                            my_orders.append("<input type=" + 'hidden' + " class=" + 'parameter_reward_hampa_pk' + " value=" + parsed[item].value_parameter_lab_pk_reward_hampa + '#' + parsed[item].reward_parameter_lab_pk_reward_hampa + ">");
                        });
                    }
                });
                $.ajax({
                    type: "GET",
                    url: url10,
                    success: function(response) {
                        var my_orders = $('#parameter_reward_tr_pk')
                        var parsed = JSON.parse(response);
                        console.log(parsed);
                        $.each(parsed, function(item) {
                            my_orders.append("<input type=" + 'hidden' + " class=" + 'parameter_reward_tr_pk' + " value=" + parsed[item].value_parameter_lab_pk_reward_tr + '#' + parsed[item].reward_parameter_lab_pk_reward_tr + ">");
                        });
                    }
                });
                $.ajax({
                    type: "GET",
                    url: url11,
                    success: function(response) {
                        var my_orders = $('#parameter_reward_katul_pk')
                        var parsed = JSON.parse(response);
                        console.log(parsed);
                        $.each(parsed, function(item) {
                            my_orders.append("<input type=" + 'hidden' + " class=" + 'parameter_reward_katul_pk' + " value=" + parsed[item].value_parameter_lab_pk_reward_katul + '#' + parsed[item].reward_parameter_lab_pk_reward_katul + ">");
                        });
                    }
                });
                $.ajax({
                    type: "GET",
                    url: url12,
                    success: function(response) {
                        var my_orders = $('#parameter_reward_butir_patah_pk')
                        var parsed = JSON.parse(response);
                        console.log(parsed);
                        $.each(parsed, function(item) {
                            my_orders.append("<input type=" + 'hidden' + " class=" + 'parameter_reward_butir_patah_pk' + " value=" + parsed[item].value_parameter_lab_pk_reward_butir_patah + '#' + parsed[item].reward_parameter_lab_pk_reward_butir_patah + ">");
                        });
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $(document).on('keypress', '#ka_pk', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#pk_pk', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#pk_bersih_pk', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#beras_pk', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#butir_patah', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#wh_pk', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#tr_pk', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#md_pk', function(e) {
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
        var get_id_penerimaan = document.getElementById('lab1_id_penerimaan_po_pk');

        var ka_pk = document.getElementById('ka_pk');
        var pk_pk = document.getElementById('pk_pk');
        var pk_bersih_pk = document.getElementById('pk_bersih_pk');
        var beras_pk = document.getElementById('beras_pk');
        var butir_patah_pk = document.getElementById('butir_patah_pk');
        var hampa_pk = document.getElementById('hampa_pk');
        var katul_pk = document.getElementById('katul_pk');
        var wh_pk = document.getElementById('wh_pk');
        var tr_pk = document.getElementById('tr_pk');
        var md_pk = document.getElementById('md_pk');
        // hidden
        var presentase_hampa_pk = document.getElementById('presentase_hampa_pk');
        var presentase_pk_bersih_pk = document.getElementById('presentase_pk_bersih_pk');
        var presentase_katul_pk = document.getElementById('presentase_katul_pk');
        var presentase_beras_pk = document.getElementById('presentase_beras_pk');
        var presentase_butir_patah_pk = document.getElementById('presentase_butir_patah_pk');
        var presentase_butir_patah_beras_pk = document.getElementById('presentase_butir_patah_beras_pk');
        var presentase_butir_patah_beras_adjust_pk = document.getElementById('presentase_butir_patah_beras_adjust_pk');
        var refraksi_ka_pk = document.getElementById('refraksi_ka_pk');
        var refraksi_hampa_pk = document.getElementById('refraksi_hampa_pk');
        var refraksi_katul_pk = document.getElementById('refraksi_katul_pk');
        var refraksi_tr_pk = document.getElementById('refraksi_tr_pk');
        var refraksi_butir_patah_pk = document.getElementById('refraksi_butir_patah_pk');
        var reward_hampa_pk = document.getElementById('reward_hampa_pk');
        var reward_katul_pk = document.getElementById('reward_katul_pk');
        var reward_tr_pk = document.getElementById('reward_tr_pk');
        var reward_butir_patah_pk = document.getElementById('reward_butir_patah_pk');
        var plan_kualitas_pk = document.getElementById('plan_kualitas_pk');
        var harga_atas_pk = document.getElementById('harga_atas_pk');
        var plan_harga_bongkaran = document.getElementById('plan_harga_bongkaran');
        var plan_harga_aktual_pk = document.getElementById('plan_harga_aktual_pk');
        var aktual_kualitas_pk = document.getElementById('aktual_kualitas_pk');
        var harga_awal_pk = document.getElementById('harga_awal_pk');
        var aksi_harga_pk = document.getElementById('aksi_harga_pk');
        var reaksi_harga_pk = document.getElementById('reaksi_harga_pk');
        var keterangan_pk = document.getElementById('keterangan_pk');
        var z_yang_ditolak = document.getElementById('z_yang_ditolak');
        var z_yang_dibawa = document.getElementById('z_yang_dibawa');
        var selisih_ka_pk = document.getElementById('selisih_ka_pk');
        var selisih_presentase_hampa_pk = document.getElementById('selisih_presentase_hampa_pk');
        var selisih_presentase_butir_patah_pk = document.getElementById('selisih_presentase_butir_patah_pk');
        var selisih_rendemen_pk_pk = document.getElementById('selisih_rendemen_pk_pk');
        var selisih_presentase_rendemen_beras_pk = document.getElementById('selisih_presentase_rendemen_beras_pk');
        var selisih_tr_pk = document.getElementById('selisih_tr_pk');
        var selisih_wh_pk = document.getElementById('selisih_wh_pk');
        var selisih_md_pk = document.getElementById('selisih_md_pk');
        var selisih_aktual_kualitas_pk = document.getElementById('selisih_aktual_kualitas_pk');
        var selisih_harga_pk = document.getElementById('selisih_harga_pk');
        var selisih_kualitas_bongkaran_pk = document.getElementById('selisih_kualitas_bongkaran_pk');
        // input lab1
        var lab1_harga_awal_pk = document.getElementById('lab1_harga_awal_pk');
        var lab1_ka_pk = document.getElementById('lab1_ka_pk');
        var lab1_presentase_hampa_pk = document.getElementById('lab1_presentase_hampa_pk');
        var lab1_presentase_pk_bersih_pk = document.getElementById('lab1_presentase_pk_bersih_pk');
        var lab1_presentase_katul_pk = document.getElementById('lab1_presentase_katul_pk');
        var lab1_presentase_beras_pk = document.getElementById('lab1_presentase_beras_pk');
        var lab1_presentase_butir_patah_beras_adjust_pk = document.getElementById('lab1_presentase_butir_patah_beras_adjust_pk');
        var lab1_tr_pk = document.getElementById('lab1_tr_pk');
        var lab1_wh_pk = document.getElementById('lab1_wh_pk');
        var lab1_md_pk = document.getElementById('lab1_md_pk');
        var lab1_aktual_kualitas_pk = document.getElementById('lab1_aktual_kualitas_pk');


        var plan_harga = document.getElementById('plan_harga_pk');

        function hasilhampakatul() {
            hasil_hampa_pk = parseFloat(pk_pk.value) - parseFloat(pk_bersih_pk.value);
            hasil_katul_pk = parseFloat(pk_bersih_pk.value) - parseFloat(beras_pk.value);
            hampa_pk.value = round(hasil_hampa_pk, 2);
            katul_pk.value = round(hasil_katul_pk, 2);
            console.log(hasil_katul_pk);

        }

        function rumus() {
            var hasil = "0";
            var par = '3';
            if (ka_pk.value == 0 || ka_pk.value == '' ||
                pk_pk.value == 0 || pk_pk.value == '' ||
                pk_bersih_pk.value == 0 || pk_bersih_pk.value == '' ||
                beras_pk.value == 0 || beras_pk.value == '' ||
                butir_patah_pk.value == 0 || butir_patah_pk.value == '' ||
                wh_pk.value == 0 || wh_pk.value == '' ||
                tr_pk.value == 0 || tr_pk.value == '' ||
                md_pk.value == 0 || md_pk.value == '') {
                hasil = "0";
                // } else{}
            } else {
                // Presentase
                hasil_presentase_hampa_pk = hampa_pk.value / parseFloat(pk_pk.value) * 100;
                presentase_hampa_pk.value = round(hasil_presentase_hampa_pk, 2);

                hasil_presentase_pk_bersih_pk = (pk_bersih_pk.value / pk_pk.value) * 100;
                presentase_pk_bersih_pk.value = round(hasil_presentase_pk_bersih_pk, 2);

                hasil_presentase_katul_pk = (katul_pk.value / pk_pk.value) * 100;
                presentase_katul_pk.value = round(hasil_presentase_katul_pk, 1);

                hasil_presentase_beras_pk = (beras_pk.value / pk_pk.value) * 100;
                presentase_beras_pk.value = round(hasil_presentase_beras_pk, 1);

                hasil_presentase_butir_patah_pk = (butir_patah_pk.value / pk_pk.value) * 100;
                presentase_butir_patah_pk.value = round(hasil_presentase_butir_patah_pk, 1);

                hasil_presentase_butir_patah_beras_pk = (butir_patah_pk.value / beras_pk.value) * 100;
                presentase_butir_patah_beras_pk.value = round(hasil_presentase_butir_patah_beras_pk, 1);

                hasil_presentase_reject_pk = parseFloat(reject_pk.value) / parseFloat(beras_pk.value) * 100;
                presentase_reject_pk.value = round(hasil_presentase_reject_pk, 2);

                // Refraksi
                var elems = document.querySelectorAll(".parameter_ka_pk");
                var elems1 = document.querySelectorAll(".parameter_hampa_pk");
                var elems2 = document.querySelectorAll(".parameter_katul_pk");
                var elems3 = document.querySelectorAll(".parameter_tr_pk");
                var elems4 = document.querySelectorAll(".parameter_butir_patah_pk");
                var elems5 = document.querySelectorAll(".parameter_butir_patah_pk_kualitas");
                var elems6 = document.querySelectorAll(".parameter_reward_hampa_pk");
                var elems7 = document.querySelectorAll(".parameter_reward_katul_pk");
                var elems8 = document.querySelectorAll(".parameter_reward_tr_pk");
                var elems9 = document.querySelectorAll(".parameter_reward_butir_patah_pk");

                var std_hpp_incoming = 0;
                // get parameter lab Kadar Air PK
                [].forEach.call(elems, function(el) {
                    var params_ka = el.value;
                    // console.log(plan_hpp);
                    arr_ka = params_ka.split("#");
                    // console.log(arr_ka[2]);
                    if (ka_pk.value >= arr_ka[0] && ka_pk.value <= arr_ka[1]) {
                        if (arr_ka[2] == '0') {
                            std_ka_pk = '0'
                        } else {
                            std_ka_pk = round((parseFloat(ka_pk.value) - parseFloat(arr_ka[0])) * parseInt(arr_ka[2]));
                            // console.log(parseFloat(std_ka_pk));
                        }
                    } else if (ka_pk.value >= arr_ka[1]) {
                        std_ka_pk = "TOLAK";

                    }


                });
                // get parameter lab Hampa PK
                [].forEach.call(elems1, function(el1) {
                    var params_hampa = el1.value;
                    // console.log(plan_hpp);
                    arr_hampa = params_hampa.split("#");
                    if (presentase_hampa_pk.value >= arr_hampa[0] && presentase_hampa_pk.value <= arr_hampa[1]) {
                        std_hampa_pk = arr_hampa[2];
                        console.log(arr_hampa[2]);
                        if (arr_hampa[2] == '0') {
                            std_hampa_pk = '0'
                        } else {
                            std_hampa_pk = round((parseFloat(presentase_hampa_pk.value) - parseFloat(arr_hampa[0])) * parseInt(arr_hampa[2]));
                            // console.log(parseFloat(std_hampa_pk));
                        }
                        // console.log(parseFloat(std_hampa_pk));
                    } else if (presentase_hampa_pk.value >= arr_hampa[1]) {
                        std_hampa_pk = "TOLAK";

                    }
                    // console.log(std_hampa_pk);


                });
                // get parameter lab Katul PK
                [].forEach.call(elems2, function(el1) {
                    var params_katul = el1.value;
                    // console.log(plan_hpp);
                    arr_katul = params_katul.split("#");
                    if (presentase_katul_pk.value >= arr_katul[0] && presentase_katul_pk.value <= arr_katul[1]) {
                        std_katul_pk = arr_katul[2];
                        // console.log(arr_katul[2]);
                        if (arr_katul[2] == '0') {
                            std_katul_pk = '0'
                        } else {
                            std_hampa_pk = round((parseFloat(presentase_katul_pk.value) - parseFloat(arr_katul[0])) * parseInt(arr_katul[2]));
                            // console.log(parseFloat(std_katul_pk));
                        }
                        // console.log(parseFloat(std_katul_pk));
                    } else if (presentase_katul_pk.value >= arr_katul[1]) {
                        std_katul_pk = "TOLAK";

                    }
                    // console.log(std_katul_pk);


                });
                // get parameter lab TR PK
                [].forEach.call(elems3, function(el1) {
                    var params_tr = el1.value;
                    // console.log(plan_hpp);
                    arr_tr = params_tr.split("#");
                    if (tr_pk.value >= arr_tr[0] && tr_pk.value <= arr_tr[1]) {
                        std_tr_pk = arr_tr[2];
                        console.log(arr_tr[2]);

                        console.log(parseFloat(std_tr_pk));
                    } else if (tr_pk.value >= arr_tr[1]) {
                        std_tr_pk = "0";

                    }
                    console.log(std_tr_pk);


                });
                // get parameter lab Butir Patah PK
                [].forEach.call(elems4, function(el1) {
                    var params_butiran_patah = el1.value;
                    // console.log(plan_hpp);
                    arr_butiran_patah = params_butiran_patah.split("#");
                    if (presentase_butir_patah_beras_pk.value > arr_butiran_patah[0] && presentase_butir_patah_beras_pk.value <= arr_butiran_patah[1]) {
                        std_butiran_patah_pk = arr_butiran_patah[2];
                        console.log(std_butiran_patah_pk);
                        if (arr_butiran_patah[2] == '0') {
                            std_butiran_patah_pk = '0'
                        } else if (arr_butiran_patah[2] == 'TOLAK') {
                            std_butiran_patah_pk = 'TOLAK'
                        } else {
                            std_butiran_patah_pk = round((parseFloat(presentase_butir_patah_beras_pk.value) - parseFloat(arr_butiran_patah[0])) * parseFloat(arr_butiran_patah[2]), 1);

                        }
                    } else if (presentase_butir_patah_beras_pk.value >= arr_butiran_patah[1]) {
                        std_butiran_patah_pk = arr_butiran_patah[2];
                    }


                });
                // get parameter lab Kualitas PK
                [].forEach.call(elems5, function(el1) {
                    var params_kualitas = el1.value;
                    arr_kualitas = params_kualitas.split("#");
                    if (presentase_butir_patah_beras_pk.value >= arr_kualitas[2] && presentase_butir_patah_beras_pk.value <= arr_kualitas[3]) {
                        std_kualitas_pk = arr_kualitas[4];
                    }
                });
                // Reward Hampa
                [].forEach.call(elems6, function(el1) {
                    var params_reward_hampa = el1.value;
                    // console.log(plan_hpp);
                    arr_reward_hampa = params_reward_hampa.split("#");
                    if (presentase_hampa_pk.value < arr_reward_hampa[0]) {
                        std_reward_hampa_pk = round((parseFloat(arr_reward_hampa[0]) - parseFloat(presentase_hampa_pk.value)) * arr_reward_hampa[1], 1);
                    } else {
                        std_reward_hampa_pk = 0;
                    }
                });
                // Reward Katul
                [].forEach.call(elems7, function(el1) {
                    var params_reward_katul = el1.value;
                    // console.log(plan_hpp);
                    arr_reward_katul = params_reward_katul.split("#");
                    if (presentase_katul_pk.value < arr_reward_katul[0]) {
                        std_reward_katul_pk = round((arr_reward_katul[0] - presentase_katul_pk.value) * arr_reward_katul[1], 1);
                    } else {
                        std_reward_katul_pk = 0;
                    }
                });
                // Reward TR
                [].forEach.call(elems8, function(el1) {
                    var params_reward_tr = el1.value;
                    // console.log(plan_hpp);
                    arr_reward_katul = params_reward_tr.split("#");
                    if (tr_pk.value >= arr_reward_katul[0]) {
                        std_reward_tr_pk = arr_reward_katul[1];
                    } else {
                        std_reward_tr_pk = 0;
                    }
                });
                // Reward Butir Patah
                [].forEach.call(elems9, function(el1) {
                    var params_reward_butir_patah = el1.value;
                    // console.log(plan_hpp);
                    arr_reward_butir_patah = params_reward_butir_patah.split("#");
                    if (parseFloat(presentase_butir_patah_beras_pk.value) < arr_reward_butir_patah[0]) {
                        std_reward_butir_patah_pk = round((arr_reward_butir_patah[0] - presentase_butir_patah_beras_pk.value) * arr_reward_butir_patah[1], 1);
                    } else {
                        std_reward_butir_patah_pk = 0;
                    }
                });

                // Refraksi 
                // Refraksi 
                $.ajax({
                    type: "GET",
                    url: "{{route('get_count_refraksi_ka')}}" + "/" + get_id_penerimaan.value,
                    async: false,
                    success: function(data) {
                        var record = JSON.parse(data);
                        if (record == '0') {
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'Harap input Parameter Kadar Air Sesuai Tanggal PO :' + tanggal_po_pk.value,
                                icon: 'warning',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "{{ route('qc.lab.parameter_pk_refraksi') }}";
                                }
                            })
                        } else if (record == '1' | record == '2') {
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'Harap input 3x Parameter Kadar Air Sesuai Tanggal PO :' + tanggal_po_pk.value,
                                icon: 'warning',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "{{ route('qc.lab.parameter_pk_refraksi') }}";

                                }
                            })

                        }
                    }
                });
                refraksi_ka_pk.value = std_ka_pk;
                $.ajax({
                    type: "GET",
                    url: "{{route('get_count_refraksi_hampa')}}" + "/" + get_id_penerimaan.value,
                    async: false,
                    success: function(data) {
                        var record = JSON.parse(data);
                        if (record == '0') {
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'Harap input Parameter Hampa Sesuai Tanggal PO :' + tanggal_po_pk.value,
                                icon: 'warning',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "{{ route('qc.lab.parameter_pk_refraksi') }}";
                                }
                            })
                        } else if (record == '1' | record == '2') {
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'Harap input 3x Parameter Hampa Sesuai Tanggal PO :' + tanggal_po_pk.value,
                                icon: 'warning',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "{{ route('qc.lab.parameter_pk_refraksi') }}";

                                }
                            })

                        }
                    }
                });
                refraksi_hampa_pk.value = std_hampa_pk;
                $.ajax({
                    type: "GET",
                    url: "{{route('get_count_refraksi_katul')}}" + "/" + get_id_penerimaan.value,
                    async: false,
                    success: function(data) {
                        var record = JSON.parse(data);
                        if (record == '0') {
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'Harap input Parameter Katul Sesuai Tanggal PO :' + tanggal_po_pk.value,
                                icon: 'warning',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "{{ route('qc.lab.parameter_pk_refraksi') }}";
                                }
                            })
                        } else if (record == '1' | record == '2') {
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'Harap input 3x Parameter Katul Sesuai Tanggal PO :' + tanggal_po_pk.value,
                                icon: 'warning',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "{{ route('qc.lab.parameter_pk_refraksi') }}";

                                }
                            })

                        }
                    }
                });
                refraksi_katul_pk.value = std_katul_pk;
                $.ajax({
                    type: "GET",
                    url: "{{route('get_count_refraksi_tr')}}" + "/" + get_id_penerimaan.value,
                    async: false,
                    success: function(data) {
                        var record = JSON.parse(data);
                        if (record == '0') {
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'Harap input Parameter TR Sesuai Tanggal PO :' + tanggal_po_pk.value,
                                icon: 'warning',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "{{ route('qc.lab.parameter_pk_refraksi') }}";
                                }
                            })
                        } else if (record == '1' | record == '2' | record == '3') {
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'Harap input 4x Parameter TR Sesuai Tanggal PO :' + tanggal_po_pk.value,
                                icon: 'warning',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "{{ route('qc.lab.parameter_pk_refraksi') }}";

                                }
                            })

                        }
                    }
                });
                refraksi_tr_pk.value = std_tr_pk;
                $.ajax({
                    type: "GET",
                    url: "{{route('get_count_refraksi_butiran_patah')}}" + "/" + get_id_penerimaan.value,
                    async: false,
                    success: function(data) {
                        var record = JSON.parse(data);
                        if (record == '0') {
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'Harap input Parameter Butir Patah Sesuai Tanggal PO :' + tanggal_po_pk.value,
                                icon: 'warning',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "{{ route('qc.lab.parameter_pk_refraksi') }}";
                                }
                            })
                        } else if (record == '1' | record == '2') {
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'Harap input 3x Parameter Butir Patah Sesuai Tanggal PO :' + tanggal_po_pk.value,
                                icon: 'warning',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "{{ route('qc.lab.parameter_pk_refraksi') }}";

                                }
                            })

                        }
                    }
                });
                refraksi_butir_patah_pk.value = std_butiran_patah_pk;

                // Reward
                $.ajax({
                    type: "GET",
                    url: "{{route('get_count_reward_hampa')}}" + "/" + get_id_penerimaan.value,
                    async: false,
                    success: function(data) {
                        var record = JSON.parse(data);
                        if (record == '0') {
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'Harap input Parameter Reward Hampa Sesuai Tanggal PO :' + tanggal_po_pk.value,
                                icon: 'warning',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "{{ route('qc.lab.parameter_lab_pk_reward') }}";
                                }
                            })
                        }
                    }
                });
                reward_hampa_pk.value = std_reward_hampa_pk;
                $.ajax({
                    type: "GET",
                    url: "{{route('get_count_reward_katul')}}" + "/" + get_id_penerimaan.value,
                    async: false,
                    success: function(data) {
                        var record = JSON.parse(data);
                        if (record == '0') {
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'Harap input Parameter Reward Katul Sesuai Tanggal PO :' + tanggal_po_pk.value,
                                icon: 'warning',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "{{ route('qc.lab.parameter_lab_pk_reward') }}";
                                }
                            })
                        }
                    }
                });
                reward_katul_pk.value = std_reward_katul_pk;
                $.ajax({
                    type: "GET",
                    url: "{{route('get_count_reward_tr')}}" + "/" + get_id_penerimaan.value,
                    async: false,
                    success: function(data) {
                        var record = JSON.parse(data);
                        if (record == '0') {
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'Harap input Parameter Reward TR Sesuai Tanggal PO :' + tanggal_po_pk.value,
                                icon: 'warning',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "{{ route('qc.lab.parameter_lab_pk_reward') }}";
                                }
                            })
                        }
                    }
                });
                reward_tr_pk.value = std_reward_tr_pk;
                $.ajax({
                    type: "GET",
                    url: "{{route('get_count_reward_butir_patah')}}" + "/" + get_id_penerimaan.value,
                    async: false,
                    success: function(data) {
                        var record = JSON.parse(data);
                        if (record == '0') {
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'Harap input Parameter Reward Butir Patah Sesuai Tanggal PO :' + tanggal_po_pk.value,
                                icon: 'warning',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "{{ route('qc.lab.parameter_lab_pk_reward') }}";
                                }
                            })
                        }
                    }
                });
                reward_butir_patah_pk.value = std_reward_butir_patah_pk;

                // Kualitas
                $.ajax({
                    type: "GET",
                    url: "{{route('get_count_lab_kualitas')}}" + "/" + get_id_penerimaan.value,
                    async: false,
                    success: function(data) {
                        var record = JSON.parse(data);
                        if (record == '0') {
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'Harap input Parameter Kualitas Sesuai Tanggal PO :' + tanggal_po_pk.value,
                                icon: 'warning',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "{{ route('qc.lab.parameter_lab_pk_kualitas') }}";

                                }
                            })
                        } else if (record == '1' | record == '2' | record == '3') {
                            Swal.fire({
                                title: 'Maaf, Anda Tidak Bisa Input',
                                text: 'Harap input 4x Parameter Kualitas Sesuai Tanggal PO :' + tanggal_po_pk.value,
                                icon: 'warning',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "{{ route('qc.lab.parameter_lab_pk_kualitas') }}";

                                }
                            })

                        }
                    }
                });
                reward_butir_patah_pk.value = std_reward_butir_patah_pk;

                // Kualitas
                plan_kualitas_pk.value = std_kualitas_pk;

                // harga Plan Bongkaran
                var hasil_plan_harga_bongkaran = 0;
                if (refraksi_ka_pk.value == 'TOLAK' || refraksi_hampa_pk.value == 'TOLAK' || refraksi_katul_pk.value == 'TOLAK' || refraksi_tr_pk.value == 'TOLAK' || refraksi_butir_patah_pk.value == 'TOLAK') {
                    plan_harga_bongkaran.value = 'TOLAK'
                } else {
                    params_reward = (parseFloat(reward_hampa_pk.value) + parseFloat(reward_katul_pk.value) + parseFloat(reward_tr_pk.value) + parseFloat(reward_butir_patah_pk.value));
                    params_refraksi = (parseFloat(refraksi_ka_pk.value) + parseFloat(refraksi_hampa_pk.value) + parseFloat(refraksi_katul_pk.value) + parseFloat(refraksi_katul_pk.value) + parseFloat(refraksi_butir_patah_pk.value));
                    hasil_plan_harga_bongkaran = parseInt(harga_atas_pk.value) + parseFloat(params_reward - params_refraksi);
                    plan_harga_bongkaran.value = Math.ceil(parseInt(hasil_plan_harga_bongkaran));
                }
                // Plan Harga Aktual
                var hasil_harga_aktual_pk = 0;
                if (refraksi_ka_pk.value == 'TOLAK' || refraksi_hampa_pk.value == 'TOLAK' || refraksi_katul_pk.value == 'TOLAK' || refraksi_tr_pk.value == 'TOLAK' || refraksi_butir_patah_pk.value == 'TOLAK') {
                    plan_harga_aktual_pk.value = 'TOLAK'
                } else {
                    params_reward = (parseFloat(reward_hampa_pk.value) + parseFloat(reward_katul_pk.value) + parseFloat(reward_tr_pk.value) + parseFloat(reward_butir_patah_pk.value));
                    params_refraksi = (parseFloat(refraksi_ka_pk.value) + parseFloat(refraksi_hampa_pk.value) + parseFloat(refraksi_katul_pk.value) + parseFloat(refraksi_katul_pk.value) + parseFloat(refraksi_butir_patah_pk.value));
                    hasil_harga_aktual_pk = parseInt(harga_atas_pk.value) + parseFloat(params_reward - params_refraksi);

                    plan_harga_aktual_pk.value = cariaktual(hasil_harga_aktual_pk);
                }
                harga_awal_pk.value = plan_harga_aktual_pk.value;
                // Harga Bongkaran
                harga_bongkaran_pk.value = harga_awal_pk.value;

                // Analisa Checker
                z_yang_diterima = parseInt(z_yang_dibawa.value) - parseInt(z_yang_ditolak.value);
                presentase_pass.value = round((z_yang_diterima / z_yang_dibawa.value) * 100, 1);
                presentase_reject.value = round((z_yang_ditolak.value / z_yang_dibawa.value) * 100, 1);
                // plan Tonase
                plan_tonase_pk.value = parseInt(z_yang_diterima * 50);
                plan_total_harga_pk.value = parseInt(lab1_harga_awal_pk.value * plan_tonase_pk.value);
                plan_tonase_beras_pk.value = parseInt((plan_tonase_pk.value / 100) * presentase_beras_pk.value);

                // Selisih
                selisih_ka_pk.value = round(lab1_ka_pk.value - ka_pk.value, 1);
                selisih_presentase_hampa_pk.value = round(lab1_presentase_hampa_pk.value - presentase_hampa_pk.value, 1);
                selisih_presentase_rendemen_pk_pk.value = round(presentase_pk_bersih_pk.value - lab1_presentase_pk_bersih_pk.value, 1);
                selisih_presentase_katul_pk.value = round(lab1_presentase_katul_pk.value - presentase_katul_pk.value, 1);
                selisih_presentase_rendemen_beras_pk.value = round(presentase_beras_pk.value - lab1_presentase_beras_pk.value, 1);
                selisih_presentase_butir_patah_pk.value = round(lab1_presentase_butir_patah_beras_adjust_pk.value - presentase_butir_patah_beras_pk.value, 1);
                selisih_wh_pk.value = round(wh_pk.value - lab1_wh_pk.value, 1);
                selisih_tr_pk.value = round(tr_pk.value - lab1_tr_pk.value, 2);
                selisih_md_pk.value = round(md_pk.value - lab1_md_pk.value, 1);
                selisih_harga_pk.value = parseInt(harga_bongkaran_pk.value - lab1_harga_awal_pk.value);
                selisih_aktual_kualitas_pk.value = lab1_aktual_kualitas_pk.value;
                selisih_kualitas_bongkaran_pk.value = plan_kualitas_pk.value;
            }
            console.log(hasil);


        }
        var typingTimer; //timer identifier
        var doneTypingInterval = 2000;

        function cariaktual(x) {
            return Math.floor(x / 25) * 25;
        }
        lab1_id_penerimaan_po_pk.addEventListener('keyup', function(e) {
            rumus();
        });

        ka_pk.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            hasilhampakatul();
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        pk_pk.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            hasilhampakatul();
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        pk_bersih_pk.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            hasilhampakatul();
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        beras_pk.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            hasilhampakatul();
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        butir_patah_pk.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            hasilhampakatul();
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        hampa_pk.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            hasilhampakatul();
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        katul_pk.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            hasilhampakatul();
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        wh_pk.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            hasilhampakatul();
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        tr_pk.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            hasilhampakatul();
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        md_pk.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            hasilhampakatul();
            typingTimer = setTimeout(rumus, doneTypingInterval);
        });
        md_pk.addEventListener('keyup', function(e) {
            clearTimeout(typingTimer);
            hasilhampakatul();
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
    </script>
    @endsection