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
                        Deal
                    </a>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        Beras PK
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
                            <i class="kt-menu__link-icon flaticon2-analytics-2 kt-font-warning"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Output Deal Beras PK
                        </h3>
                    </div>
                </div>
                <form class="" method="post" action="{{route('qc.lab.download_output_lab2_excel')}}" enctype="multipart/form-data">
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
                            <button type="submit" name="btn_export" id="btn_export" class="btn btn-success"><i class="fa fa-file-excel"></i>Excel</button>
                        </div>
                    </div>
                </form>
                <div class="kt-portlet__body">
                    <table class="table table-bordered" id="datatable" style="table-layout: auto;">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:2%" rowspan="2">No</th>
                                <th style="text-align: center;width:auto" rowspan="2">Kode&nbsp;PO</th>
                                <th style="text-align: center;width:auto" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto" rowspan="2">Tanggal&nbsp;PO</th>
                                <th style="text-align: center;width:auto" rowspan="2">Asal&nbsp;Gabah</th>
                                <th style="text-align: center;width:auto" rowspan="2">No.&nbsp;DTM</th>
                                <th style="text-align: center;width:auto" rowspan="2">Hasil&nbsp;Tonase&nbsp;Akhir</th>
                                <th style="text-align: center;width:auto" rowspan="2">KA</th>
                                <th bgcolor="#F8F8FF" style="text-align: center;width:20px" colspan="7">Berat Sample (g)</th>
                                <th style="text-align: center;width:auto" rowspan="2">WH</th>
                                <th style="text-align: center;width:auto" rowspan="2">TR</th>
                                <th style="text-align: center;width:auto" rowspan="2">MD</th>
                                <th bgcolor="#FF8C00" style="text-align: center;width:auto" colspan="7">Presentase (%) </th>
                                <th bgcolor="#ADD8E6" style="text-align: center;width:auto" colspan="5">Refraksi</th>
                                <th bgcolor="#8FBC8F" style="text-align: center;width:auto" colspan="4">Reward</th>
                                <th style="text-align: center;width:auto" rowspan="2">Kualitas&nbsp;Bongkaran</th>
                                <th style="text-align: center;width:auto" rowspan="2">Harga&nbsp;Papan&nbsp;(Rp.)</th>
                                <th style="text-align: center;width:auto" rowspan="2">Plan&nbsp;Harga&nbsp;Bongkaran&nbsp;(Rp.)</th>
                                <th style="text-align: center;width:auto" rowspan="2">Harga&nbsp;Bongkaran&nbsp;(Rp.)</th>
                                <th style="text-align: center;width:auto" rowspan="2">Jumlah&nbsp;Z&nbsp;Dibawa</th>

                                <th style="text-align: center;width:auto" rowspan="2">Jumlah&nbsp;Z&nbsp;Ditolak</th>
                                <th style="text-align: center;width:auto" rowspan="2">(%)&nbsp;Pass</th>
                                <th style="text-align: center;width:auto" rowspan="2">(%)&nbsp;Reject</th>
                                <th style="text-align: center;width:auto" rowspan="2">Plan&nbsp;Tonase&nbsp;PK</th>
                                <th style="text-align: center;width:auto" rowspan="2">Plan&nbsp;Total&nbsp;Harga</th>
                                <th style="text-align: center;width:auto" rowspan="2">Plan&nbsp;Tonoase&nbsp;Beras</th>
                                <th bgcolor="#D3D3D3" style="text-align: center;width:auto" colspan="12">Selisih</th>
                            </tr>
                            <tr>
                                <th style="text-align: center;width:auto">PK</th>
                                <th style="text-align: center;width:auto">PK&nbsp;Bersih</th>
                                <th style="text-align: center;width:auto">&nbsp;Beras&nbsp;</th>
                                <th style="text-align: center;width:auto">Butir&nbsp;Patah</th>
                                <th style="text-align: center;width:auto">&nbsp;Hampa&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Katul&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Reject&nbsp;</th>

                                <th style="text-align: center;width:auto">&nbsp;Hampa&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;PK&nbsp;Bersih&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Katul&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Beras&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Butir&nbsp;Patah&nbsp;PK&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Butir&nbsp;Patah&nbsp;Beras&nbsp;PK&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Reject&nbsp;</th>

                                <th style="text-align: center;width:auto">&nbsp;KA&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Hampa&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Katul&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;TR&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Butir&nbsp;Patah&nbsp;</th>

                                <th style="text-align: center;width:auto">&nbsp;Hampa&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Katul&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;TR&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Butir&nbsp;Patah&nbsp;</th>

                                <th style="text-align: center;width:auto">&nbsp;KA&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Hampa&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Rendemen&nbsp;PK&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Rendemen&nbsp;Beras&nbsp;</th>
                                <!--8-->
                                <th style="text-align: center;width:auto">&nbsp;Katul&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Butir&nbsp;Patah&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;WH&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;TR&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;MD&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Harga&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Kualitas&nbsp;Incoming&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Kualitas&nbsp;Bongkaran&nbsp;</th>
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


@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).ready(function() {
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        load_data();

        function load_data(from_date = '', to_date = '') {
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
                ajax: {
                    url: "{{ route('qc.lab.output_deal_lab2_pk_index') }}",
                    data: {
                        from_date: from_date,
                        to_date: to_date
                    }
                },
                columns: [{
                        data: "id_lab2_pk",

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
                        data: 'keterangan_penerimaan_po'
                    },
                    {
                        data: 'no_dtm'
                    },
                    {
                        data: 'hasil_akhir_tonase'
                    },
                    {
                        data: 'ka_pk'
                    },
                    {
                        data: 'pk_pk'
                    },
                    {
                        data: 'pk_bersih_pk'
                    },
                    {
                        data: 'beras_pk'
                    },
                    {
                        data: 'butir_patah_pk'
                    },
                    {
                        data: 'reject_pk'
                    },
                    {
                        data: 'hampa_pk'
                    },
                    {
                        data: 'katul_pk'
                    },
                    {
                        data: 'wh_pk'
                    },
                    {
                        data: 'tr_pk'
                    },
                    {
                        data: 'md_pk'
                    },
                    {
                        data: 'presentase_hampa_pk'
                    },
                    {
                        data: 'presentase_pk_bersih_pk'
                    },
                    {
                        data: 'presentase_katul_pk'
                    },
                    {
                        data: 'presentase_beras_pk'
                    },
                    {
                        data: 'presentase_butir_patah_pk'
                    },
                    {
                        data: 'presentase_butir_patah_beras_pk'
                    },
                    {
                        data: 'presentase_reject_pk'
                    },
                    {
                        data: 'refraksi_ka_pk'
                    },
                    {
                        data: 'refraksi_hampa_pk'
                    },
                    {
                        data: 'refraksi_katul_pk'
                    },
                    {
                        data: 'refraksi_tr_pk'
                    },
                    {
                        data: 'refraksi_butir_patah_pk'
                    },
                    {
                        data: 'reward_hampa_pk'
                    },
                    {
                        data: 'reward_katul_pk'
                    },
                    {
                        data: 'reward_tr_pk'
                    },
                    {
                        data: 'reward_butir_patah_pk'
                    },
                    {
                        data: 'plan_kualitas_pk'
                    },
                    {
                        data: 'harga_atas_pk'
                    },
                    {
                        data: 'plan_harga_bongkaran'
                    },
                    {
                        data: 'harga_bongkaran_pk'
                    },
                    {
                        data: 'z_yang_dibawa'
                    },
                    {
                        data: 'z_yang_ditolak'
                    },
                    {
                        data: 'presentase_pass'
                    },
                    {
                        data: 'presentase_reject'
                    },
                    {
                        data: 'plan_tonase_pk'
                    },
                    {
                        data: 'plan_total_harga_pk'
                    },
                    {
                        data: 'plan_tonase_beras_pk'
                    },
                    {
                        data: 'selisih_ka_pk'
                    },
                    {
                        data: 'selisih_hampa_pk'
                    },
                    {
                        data: 'selisih_rendemen_pk'
                    },
                    {
                        data: 'selisih_rendemen_beras_pk'
                    },
                    {
                        data: 'selisih_katul_pk'
                    },
                    {
                        data: 'selisih_butir_patah_pk'
                    },
                    {
                        data: 'selisih_wh_pk'
                    },
                    {
                        data: 'selisih_tr_pk'
                    },
                    {
                        data: 'selisih_md_pk'
                    },
                    {
                        data: 'selisih_harga_pk'
                    },
                    {
                        data: 'selisih_aktual_kualitas_pk'
                    },
                    {
                        data: 'selisih_kualitas_bongkaran_pk'
                    }
                ],
                "order": []
            });
        }
        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            if (from_date != '' && to_date != '') {
                $('#datatable').DataTable().destroy();
                // table.ajax.reload(from_date, to_date);
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
            $('#datatable').DataTable().destroy();
            load_data();
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $('body').on('click', '#approved_lab2_pk', function() {
            var cek = $(this).data('id');
            // console.log(cek);
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Approve Ke SPV",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{route('qc.lab.approve_lab2_pk')}}/" + cek,
                        type: "GET",
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'Data anda berhasil di Apporove.',
                                icon: 'success',
                                timer: 1500
                            })
                            $('#datatable').DataTable().ajax.reload();
                        }
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });

        });
        $(document).on('click', '#btn_update', function(e) {
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
                    if ($('#kadar_air').val() == '' | $('#ka_kg').val() == '' | $('#berat_sample_awal_ks').val() == '' | $('#berat_sample_awal_kg').val() == '' | $('#berat_sample_akhir_kg').val() == '' | $('#berat_sample_pk').val() == '' | $('#randoman').val() == '' | $('#wh').val() == '' | $('#tp').val() == '' | $('#md').val() == '' | $('#keterangan_lab_1').val() == '' | $('#broken').val() == '') {
                        Swal.fire('Gagal!', 'Data Harus Diisi Semua.', 'error')
                    } else if ($('#plan_hargafin').val() == '' | $('#plan_hargafin').val() == '0') {
                        Swal.fire('Mohon Dicek!', 'Top Price, Price GT/04 dan Plan Hpp harap disi sesuai tanggal PO', 'warning')
                    } else {
                        $('#formeditoutput').submit();
                        Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
                    }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '#btn_edit', function() {
            var id = $(this).attr("name");
            var tanggal_po = $(this).data('tanggalpo');
            var idtopprice = $(this).data('id');
            var url = "{{ route('qc.lab.edit_lab2_pk') }}" + "/" + id;
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
            $('#formeditoutput').trigger('reset');
            $('#to_edit').on('hidden.bs.modal', function(e) {
                location.reload();
                $('#to_edit').show();
            })
            $('#to_edit').modal('show');
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    // console.log(response);
                    var parsed = $.parseJSON(response);

                    $('#lab2_token').val(parsed.lab2_token);
                    $('#lab1_kode_po_pk').val(parsed.lab1_kode_po_pk);
                    $('#lab1_plat_pk').val(parsed.lab1_plat_pk);
                    $('#lab1_id_data_po_pk').val(parsed.lab1_id_data_po_pk);
                    $('#lab1_id_penerimaan_po_pk').val(parsed.lab1_id_penerimaan_po_pk);
                    $('#lab1_id_bid_user').val(parsed.lab1_id_bid_user);
                    $('#lokasi_bongkar_pk').val(parsed.lokasi_bongkar_pk);
                    $('#no_dtm_pk').val(parsed.no_dtm_pk);
                    $('#surveyor_bongkar').val(parsed.surveyor_bongkar);
                    $('#keterangan_bongkar').val(parsed.keterangan_bongkar);
                    $('#waktu_bongkar').val(parsed.waktu_bongkar);
                    $('#tempat_bongkar').val(parsed.tempat_bongkar);
                    $('#z_yang_dibawa').val(parsed.z_yang_dibawa);
                    $('#z_yang_ditolak').val(parsed.z_yang_ditolak);
                    // edit lab2
                    $('#ka_pk').val(parsed.ka_pk2);
                    $('#pk_pk').val(parsed.pk_pk2);
                    $('#pk_bersih_pk').val(parsed.pk_bersih_pk2);
                    $('#beras_pk').val(parsed.beras_pk2);
                    $('#butir_patah_pk').val(parsed.butir_patah_pk2);
                    $('#reject_pk').val(parsed.reject_pk);
                    $('#hampa_pk').val(parsed.hampa_pk2);
                    $('#katul_pk').val(parsed.katul_pk2);
                    $('#wh_pk').val(parsed.wh_pk2);
                    $('#tr_pk').val(parsed.tr_pk2);
                    $('#md_pk').val(parsed.md_pk2);
                    $('#harga_bongkaran_pk').val(parsed.harga_bongkaran_pk);

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
                    $('#hasil_akhir_tonase').val(parsed.hasil_akhir_tonase);

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

@endsection