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
                            <i class="kt-menu__link-icon flaticon2-writing kt-font-warning"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Hasil Data Lab 2 Pecah Kulit
                        </h3>
                    </div>
                </div>
                <div style="margin-left: 10px; margin-top:10px;" class="row input-daterange">
                    <div class="col-md-4">
                        <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                    </div>
                    <div class="col-md-4">
                        <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                        <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-bordered" id="datatable1">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:2%" rowspan="2">No</th>
                                <th style="text-align: center;width:auto" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto" rowspan="2">&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto" rowspan="2">&nbsp;&nbsp;&nbsp;Asal&nbsp;Gabah&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;DTM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto" rowspan="2">Hasil&nbsp;Tonase&nbsp;Akhir</th>
                                <th style="text-align: center;width:auto" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;KA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th bgcolor="#F8F8FF" style="text-align: center;width:20px" colspan="7">Berat Sample (g)</th>
                                <th style="text-align: center;width:auto" rowspan="2">&nbsp;&nbsp;&nbsp;WH&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto" rowspan="2">&nbsp;&nbsp;&nbsp;TR&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto" rowspan="2">&nbsp;&nbsp;&nbsp;MD&nbsp;&nbsp;&nbsp;</th>
                                <th bgcolor="#FF8C00" style="text-align: center;width:auto" colspan="7">Presentase (%) </th>
                                <th bgcolor="#ADD8E6" style="text-align: center;width:auto" colspan="5">Refraksi</th>
                                <th bgcolor="#8FBC8F" style="text-align: center;width:auto" colspan="4">&nbsp;Reward&nbsp;</th>
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
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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

                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;KA&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;Hampa&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Rendemen&nbsp;PK&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Rendemen&nbsp;Beras&nbsp;</th>
                                <!--8-->
                                <th style="text-align: center;width:auto">&nbsp;Katul&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Butir&nbsp;Patah&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;WH&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;MD&nbsp;&nbsp;&nbsp;&nbsp;</th>
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

    <!-- end:: Content -->
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        load_data();

        function load_data(from_date = '', to_date = '') {
            var table = $('#datatable1').DataTable({
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
                    url: "{{ route('master.output_lab2_pk_index') }}",
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
                        data: 'status_lab2_pk'
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
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                table.columns.adjust().draw().responsive.recalc();
            })
        }
        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            if (from_date != '' && to_date != '') {
                $('#datatable1').DataTable().destroy();
                // table.ajax.reload(from_date, to_date);
                load_data(from_date, to_date);
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Sukses filter data',
                    icon: 'success',
                    timer: 1500
                });
            } else {
                Swal.fire({
                    title: 'Infoo!!',
                    text: 'Mohon Isikan data',
                    icon: 'warning',
                    timer: 1500
                });
            }

        });

        $('#refresh').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#datatable1').DataTable().destroy();
            load_data();
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '#btn_save_pk', function(e) {
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
                    $('#form_updatehargaakhir_pk').submit();
                    Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });

        $(document).on('click', '.detail_hasil_qc', function() {
            var id = $(this).attr("name");
            var url = "{{ route('qc.lab.detail_output_incoming_qc') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    // console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#plan_harga').val(parsed.plan_harga);
                    console.log(parsed.bid_user_id);
                }
            });
        });
        $(document).on('click', '#btn_approve_lab2_pk', function() {
            var id = $(this).data('id');
            var kode_po = $(this).data('kodepo');
            var harga_akhir = $(this).data('hargaakhir');
            var tonase = $(this).data('tonase_akhir');
            // console.log(tonase);
            Swal.fire({
                title: 'Apakah Yakin Approve Data Ini',
                icon: 'warning',
                html: '<b>Kode PO :</b> ' +
                    kode_po + '<br>',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Approve',
                customClass: 'swal-wide',
                denyButtonText: 'Tolak Approve'
            }).then(function(result) {
                if (result.isConfirmed) {
                    if (tonase == '' || tonase == 'NULL') {
                        Swal.fire('Maaf', 'Tonnase Akhir Belum Di Input', 'warning')
                    } else {
                        $.ajax({
                            type: "GET",
                            url: "{{route('master.approve_lab2_pk')}}/" + id,
                            success: function(response) {
                                Swal.fire('Sukses!', 'Data Anda Sudah Tersimpan', 'success', 1500)
                                $('#datatable1').DataTable().ajax.reload();

                            },
                            error: function(response) {
                                Swal.fire('Error', 'Cancel Proses Data', 'error')

                            }
                        });
                    }
                } else if (result.isDenied) {
                    $.ajax({
                        type: "GET",
                        url: "{{route('master.tolak_approved_pk')}}/" + id,
                        success: function(response) {
                            Swal.fire('Sukses!', 'Data Anda Sudah Tersimpan', 'success', 1500)
                            $('#datatable1').DataTable().ajax.reload();

                        },
                        error: function(response) {
                            Swal.fire('Error', 'Cancel Proses Data', 'error')

                        }
                    });

                } else {
                    Swal.fire('Error', 'Cancel Proses Data', 'error')
                }
            });
        });
    });
</script>
<script type="text/javascript">
    // function cekAnalisa(that) {
    //     if (that.value == "tidak") {
    //          Swal.fire({
    //         position: 'top',
    //         icon: 'warning',
    //         title: 'Silahkan Input Harga Permintaan',
    //         showConfirmButton: true
    //       });

    //         document.getElementById("form_keterangan").style.display = "block";  
    //         document.getElementById("harga_akhir_permintaan_gb").focus();
    //     } else {
    //         document.getElementById("form_keterangan").style.display = "none";
    //     }
    // }

    function cekAdmin(that) {
        if (that.value == "1") {
            $('textarea[id=keterangan_analisa]').val('Nopol Tidak Sesuai');
        } else {
            $('textarea[id=keterangan_analisa]').val('');
        }
    }
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '.lokasi_bongkar', function() {
            var id = $(this).attr("name");
            var url = "{{ route('qc.lab.lokasi_bongkar') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#lokasi_bongkar').text(parsed.lokasi_bongkar);
                    $('#nomer_antrian').text(parsed.antrian);
                }
            });
        });
    });
</script>
@endsection