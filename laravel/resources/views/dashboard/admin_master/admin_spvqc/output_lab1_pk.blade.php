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
                            Hasil Data Lab 1 Pecah Kulit
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
                                <th style="text-align: center;width:auto">No.</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">Waktu&nbsp;Penerimaan</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">Asal&nbsp;Gabah</th>
                                <th style="text-align: center;width:auto">Lokasi&nbsp;Bongkar</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">Harga&nbsp;Awal</th>
                                <th style="text-align: center;width:auto">Reaksi&nbsp;Harga</th>
                                <th style="text-align: center;width:auto">Output&nbsp;Lab</th>
                                <th style="text-align: center;width:auto">Harga&nbsp;Akhir</th>
                                <th style="text-align: center;width:auto">Keterangan&nbsp;Harga</th>
                                <th style="text-align: center;width:20px">KA</th>
                                <!--<th style="text-align: center;width:20px" >Berat&nbsp;Sampel&nbsp;(g)</th>-->
                                <th style="text-align: center;width:20px">&nbsp;&nbsp;PK&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:20px">PK&nbsp;Bersih</th>
                                <th style="text-align: center;width:auto">Beras&nbsp;PK</th>
                                <th style="text-align: center;width:auto">Butir&nbsp;Patah</th>
                                <th style="text-align: center;width:auto">Hampa</th>
                                <th style="text-align: center;width:auto">&nbsp;Katul&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;WH&nbsp; </th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;TR&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;MD&nbsp; </th>
                                <th style="text-align: center;width:auto">(%)&nbsp;Hampa </th>
                                <th style="text-align: center;width:auto">(%)&nbsp;PK&nbsp;Bersih</th>
                                <th style="text-align: center;width:auto">(%)&nbsp;Katul</th>

                                <th style="text-align: center;width:auto">(%)&nbsp;beras&nbsp;PK</th>
                                <th style="text-align: center;width:auto">(%)&nbsp;butir&nbsp;Patah</th>
                                <th style="text-align: center;width:auto">(%)&nbsp;Butir&nbsp;Patah&nbsp;Beras</th>
                                <th style="text-align: center;width:auto">(%)&nbsp;Butir&nbsp;Patah&nbsp;Beras&nbsp;Adjust</th>
                                <th style="text-align: center;width:auto">Refraksi&nbsp;KA</th>
                                <th style="text-align: center;width:auto">refraksi&nbsp;Hampa</th>
                                <th style="text-align: center;width:auto">Refraksi&nbsp;Katul</th>
                                <th style="text-align: center;width:auto">refraksi&nbsp;TR</th>
                                <th style="text-align: center;width:auto">Refraksi&nbsp;Butir&nbsp;Patah</th>
                                <th style="text-align: center;width:auto">Reward&nbsp;hampa</th>

                                <th style="text-align: center;width:auto">Reward&nbsp;Katul</th>
                                <th style="text-align: center;width:auto">Reward&nbsp;TR</th>
                                <th style="text-align: center;width:auto">Reward&nbsp;Butir&nbsp;Patah</th>
                                <th style="text-align: center;width:auto">Plan&nbsp;Kualitas</th>
                                <th style="text-align: center;width:auto">Harga&nbsp;Atas</th>
                                <th style="text-align: center;width:auto">Harga&nbsp;Incoming</th>
                                <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Aktual</th>
                                <th style="text-align: center;width:auto">Aktual&nbsp;Kualitas</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Waktu&nbsp;Lab&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="to_bongkar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form class="m-form m-form--fit m-form--label-align-right">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Data Bongkar</h5>
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
        <div class="modal fade" id="modalharga_pk" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="form_updatehargaakhir_pk" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{route('master.update_harga_akhir_pk')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Verifikasi Harga Akhir PK</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_lab1_pk" id="id_lab1_pk" value="">
                            <div class="form-group">
                                <div class="">
                                    <label>Kode PO</label>
                                    <input id="lab1_kode_po_pk" readonly name="lab1_kode_po_pk" type="text" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Harga Bongkaran (Berdasarkan Hasil Lab)</label>
                                    <input id="harga_akhir_pk" readonly name="harga_akhir_pk" type="text" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Apakah Harga Tersebut Bisa Diterima ?</label>
                                    <div class="kt-radio-inline">
                                        <label class="kt-radio">
                                            <input type="radio" value="ya" id="ya" onchange="cekAnalisa_pk(this);" class="form-control m-input" name="analisa"> Ya
                                            <span></span>
                                        </label>
                                        <label class="kt-radio">
                                            <input type="radio" value="tidak" id="tidak" onchange="cekAnalisa_pk(this);" class="form-control m-input" name="analisa"> Tidak
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="form_keterangan_pk" style="display: none;">
                                <div class="">
                                    <label>Harga Akhir Permintaan</label>
                                    <input type="number" class="form-control" id="harga_akhir_permintaan_pk" name="harga_akhir_permintaan_pk">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                            <button id="btn_save_pk" class="btn btn-success m-btn pull-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="to_pending" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form class="m-form m-form--fit m-form--label-align-right">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Data Pending</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="">
                                    <h1 style="text-align: center">Lokasi Bongkar</h1>
                                    <h3 style="text-align: center" id="lokasi_bongkar"></h3>
                                    <h1 style="text-align: center">Nomer Antrian</h1>
                                    <h3 style="text-align: center" id="nomer_antrian"></h3>
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
    </div>

    <!-- end:: Content -->
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
                    url: "{{ route('master.output_lab1_pk_index') }}",
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
                        data: 'lokasi_bongkar_pk'
                    },
                    {
                        data: 'ckelola'
                    },
                    {
                        data: 'harga_awal_pk'
                    },
                    {
                        data: 'reaksi_harga_pk'
                    },
                    {
                        data: 'output_lab_pk'
                    },
                    {
                        data: 'harga_akhir_pk'
                    },
                    {
                        data: 'keterangan_harga_akhir_pk'
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
                        data: 'presentase_butir_patah_beras_adjust_pk'
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
                        data: 'harga_incoming_pk'
                    },

                    {
                        data: 'plan_harga_aktual_pk'
                    },
                    {
                        data: 'aktual_kualitas_pk'
                    },
                    {
                        data: 'created_at_pk'
                    }


                ],
                "order": []
            });
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
    function cekAnalisa_pk(that) {
        if (that.value == "tidak") {
            Swal.fire({
                position: 'top',
                icon: 'warning',
                title: 'Silahkan Input Harga Permintaan',
                showConfirmButton: true
            });

            document.getElementById("form_keterangan_pk").style.display = "block";
            document.getElementById("harga_akhir_permintaan_pk").focus();
        } else {
            document.getElementById("form_keterangan_pk").style.display = "none";
        }
    }
    $(function() {
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
                            $('#datatable1').DataTable().ajax.reload();
                        }
                    });

                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '#btn_tolakbongkar', function(e) {
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
                        url: "{{route('master.notapprove_lab1_gb') }}/" + id,
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
                            $('#datatable1').DataTable().ajax.reload();
                        }
                    });

                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        //  Approve Tolak
        $(document).on('click', '#btn_tolak', function(e) {
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
                        html: 'Proses Input Data...', // add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                            $.ajax({
                                url: "{{route('master.approve_tolak_lab1_gb') }}/" + id,
                                type: "GET",
                                error: function() {
                                    alert('Something is wrong');
                                },
                                success: function(data) {
                                    Swal.fire({
                                        title: 'Berhasil',
                                        text: 'Data Anda Berhasil Di Simpan.',
                                        icon: 'success',
                                        timer: 1500
                                    })
                                    $('#datatable1').DataTable().ajax.reload();
                                }
                            });
                        },
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });
        });
        // PK
        $(document).on('click', '#btn_modal_pk', function() {
            var id = $(this).data('id');
            var kode_po = $(this).data('kodepo');
            var harga_akhir = $(this).data('hargaakhir');
            // console.log(kode_po);
            $('#id_lab1_pk').val(id);
            $('#lab1_kode_po_pk').val(kode_po);
            $('#harga_akhir_pk').val('Rp. ' + harga_akhir);
            $('#modalharga_pk').show();
        });
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

    });
</script>
@endsection