@extends('dashboard.admin_ap.layout.main')
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
                    <a href="{{route('ap.data_pembelian_gb')}}" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{route('ap.data_pembelian_gb')}}" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        Data Pembelian
                    </a>
                    <a href="{{route('ap.data_pembelian_gb')}}" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{route('ap.data_pembelian_gb')}}" onclick="return false" class="kt-subheader__breadcrumbs-link">
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
                            <i class="flaticon2-document kt-font-success"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data Pembelian
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item mt-3">
                            <a class="nav-link active" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-database"></i>BELUM VERIFIKASI
                                <span id="count_verifikasi" class="badge badge badge-info" style="position:absolute; margin-top: -15px; margin-left: 1%; width: max-content; text-align: left; background-color: green;">
                                </span>
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_2"><i class="la la-database"></i>SUDAH VERIFIKASI
                                <span id="count_verified" class="badge badge badge-info" style="position:absolute; width: max-content; text-align: left; margin-top: -15px; margin-left: 1%; background-color: green;">
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
                            <table class="table table-bordered" id="data_verifikasi">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:20%">&nbsp;Status&nbsp;</th>
                                        <!-- <th style="text-align: center;width:2%">No.&nbsp;Antrian</th> -->
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;Nopol&nbsp;Kendaraan&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;DTM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">Bruto</th>
                                        <th style="text-align: center;width:20%">Tara</th>
                                        <th style="text-align: center;width:20%">Netto</th>
                                        <th style="text-align: center;width:20%">Tanggal&nbsp;Receipt</th>
                                        <th style="text-align: center;width:20%">Harga&nbsp;Akhir&nbsp;/Kg</th>
                                        <th style="text-align: center;width:20%">Keterangan&nbsp;Harga</th>
                                        <th style="text-align: center;width:20%">Keterangan&nbsp;Approved</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_2" role="tabpanel">
                            <table class="table table-bordered" id="data_verified">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:20%">&nbsp;Status&nbsp;</th>
                                        <!-- <th style="text-align: center;width:2%">No.&nbsp;Antrian</th> -->
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp; </th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;Nopol&nbsp;Kendaraan&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;DTM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">Bruto</th>
                                        <th style="text-align: center;width:20%">Tara</th>
                                        <th style="text-align: center;width:20%">Netto</th>
                                        <th style="text-align: center;width:20%">Tanggal&nbsp;Receipt</th>
                                        <th style="text-align: center;width:20%">Harga&nbsp;Akhir&nbsp;/Kg</th>
                                        <th style="text-align: center;width:20%">Keterangan&nbsp;Harga</th>
                                        <th style="text-align: center;width:20%">Keterangan&nbsp;Approved</th>
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

        <div class="modal fade" id="modal_verifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form id="form_verifikasi" class="m-form m-form--fit m-form--label-align-right" method="post" action="javascript:void(0);" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5 class="text-center mb-2">DATA VERIFIKASI</h5>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_penerimaan_po" id="id_penerimaan_po" value="">
                            <input id="penerimaan_kode_po" name="penerimaan_kode_po" type="hidden" class="form-control m-input" value="">
                            <dl class="dl-horizontal row">
                                <dd class="col-3">SITE</dd>
                                <dd class="col-1">:</dd>
                                <dd class="col-8" style="font-weight: bold;">NGAWI</dd>
                                <dd class="col-3">NO. PO</dd>
                                <dd class="col-1">:</dd>
                                <dd class="col-8" id="result_no_po" style="font-weight: bold;"></dd>
                                <dd class="col-3">TANGGAL PO</dd>
                                <dd class="col-1">:</dd>
                                <dd class="col-8"><span class="btn btn-sm btn-label-primary" style="font-weight: bold;" id="result_tgl_po"></span></dd>
                                <dd class="col-3">TANGGAL RECEIPT</dd>
                                <dd class="col-1">:</dd>
                                <dd class="col-8"><span class="btn btn-sm btn-label-primary" style="font-weight: bold;" id="result_tgl_receipt"></span></dd>
                            </dl>
                            <div class="form-group">
                                <div class="">
                                    <label>Analisa</label>
                                    <div class="kt-radio-inline">
                                        <label class="kt-radio">
                                            <input type="radio" class="form-control m-input" name="analisa" value="verified"> Verifikasi
                                            <span></span>
                                        </label>
                                        <label class="kt-radio">
                                            <input type="radio" value="revisi" id="revisi" onchange="cekAnalisa(this);" class="form-control m-input" name="analisa"> Revisi
                                            <span></span>
                                        </label>
                                        <!-- <input type="radio" value="verified" checked=checked id="verified" onchange="cekAnalisa(this);" class="btn-check" name="analisa" id="success-outlined" autocomplete="off">
                                        <label class="btn btn-outline-success" for="success-outlined">Verifikasi</label>

                                        <input type="radio" value="revisi" id="revisi" onchange="cekAnalisa(this);" class="btn-check" name="analisa" id="danger-outlined" autocomplete="off">
                                        <label class="btn btn-outline-danger" for="danger-outlined">Revisi</label> -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="idAdmin" style="display: none;">
                                <div class="">
                                    <label>Nama Admin</label>
                                    <div class="kt-radio-inline">
                                        <label class="kt-radio">
                                            <input type="radio" value="1" id="satpam" onchange="cekAdmin(this);" class="form-control m-input" name="namaadmin"> Admin Satpam
                                            <span></span>
                                        </label>
                                        <label class="kt-radio">
                                            <input type="radio" value="2" id="timbangan" onchange="cekAdmin(this);" class="form-control m-input" name="namaadmin"> Admin Timbangan
                                            <span></span>
                                        </label>
                                        <label class="kt-radio">
                                            <input type="radio" value="3" id="bongkar" onchange="cekAdmin(this);" class="form-control m-input" name="namaadmin"> Admin QC Bongkar
                                            <span></span>
                                        </label>
                                        <label class="kt-radio">
                                            <input type="radio" value="4" id="harga" onchange="cekAdmin(this);" class="form-control m-input" name="namaadmin"> SPV QC Lab
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="form_keterangan" style="display: none;">
                                <div class="">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" id="keterangan_analisa" name="keterangan_analisa"></textarea>
                                </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(function() {
        var table = $('#data_verifikasi').DataTable({
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
            ajax: "{{ route('ap.data_pembelian_gb_longgrain_index') }}",
            columns: [{
                    data: "id_penerimaan_po",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'ckelola'
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
                    data: 'tanggal_po'
                },
                {
                    data: 'plat_kendaraan'
                },
                {
                    data: 'dtm_gb'
                },
                {
                    data: 'tonase_awal'
                },
                {
                    data: 'tonase_akhir'
                },
                {
                    data: 'hasil_akhir_tonase'
                },
                {
                    data: 'tanggal_receipt'
                },
                {
                    data: 'harga_akhir'
                },
                {
                    data: 'keterangan_harga_akhir_gb'
                },
                {
                    data: 'keterangan_analisa'
                },

            ],
            createdRow: function(row, data, index) {

                // Updated Schedule Week 1 - 07 Mar 22

                if (data.name_bid == 'GABAH BASAH CIHERANG') {
                    $('td:eq(3)', row).css('color', '#000099'); //Original Date
                } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                    $('td:eq(3)', row).css('color', '#009900'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                    $('td:eq(3)', row).css('color', '#330019'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                    $('td:eq(3)', row).css('color', '#6666FF'); // Behind of Original Date
                }
            },
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table.columns.adjust().draw().responsive.recalc();
        })
        var table2 = $('#data_verified').DataTable({
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
            ajax: "{{ route('ap.data_pembelian_gb_longgrain1_index') }}",
            columns: [{
                    data: "id_penerimaan_po",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'ckelola'
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
                    data: 'tanggal_po'
                },
                {
                    data: 'plat_kendaraan'
                },
                {
                    data: 'dtm_gb'
                },
                {
                    data: 'tonase_awal'
                },
                {
                    data: 'tonase_akhir'
                },
                {
                    data: 'hasil_akhir_tonase'
                },
                {
                    data: 'tanggal_receipt'
                },
                {
                    data: 'harga_akhir'
                },
                {
                    data: 'keterangan_harga_akhir_gb'
                },
                {
                    data: 'keterangan_analisa'
                },

            ],
            createdRow: function(row, data, index) {

                // Updated Schedule Week 1 - 07 Mar 22

                if (data.name_bid == 'GABAH BASAH CIHERANG') {
                    $('td:eq(3)', row).css('color', '#000099'); //Original Date
                } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                    $('td:eq(3)', row).css('color', '#009900'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                    $('td:eq(3)', row).css('color', '#330019'); // Behind of Original Date
                }
            },
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table2.columns.adjust().draw().responsive.recalc();
        })
    });
</script>
<script type="text/javascript">
    function cekAnalisa(that) {
        if (that.value == "revisi") {
            document.getElementById("form_keterangan").style.display = "block";
            document.getElementById("idAdmin").style.display = "block";
        } else {
            document.getElementById("idAdmin").style.display = "none";
            document.getElementById("form_keterangan").style.display = "none";
        }
    }

    function cekAdmin(that) {
        if (that.value == "1") {
            $('textarea[id=keterangan_analisa]').val('Nopol Tidak Sesuai');
        } else if (that.value == "2") {
            $('textarea[id=keterangan_analisa]').val('Tonase Tidak Sesuai');
        } else if (that.value == "3") {
            $('textarea[id=keterangan_analisa]').val('No. DTM Tidak Sesuai');
        } else {
            $('textarea[id=keterangan_analisa]').val('Harga Akhir Tidak Sesuai');
        }
    }
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '#btn_save', function(e) {
            e.preventDefault();
            var id_penerimaan_po = $('#id_penerimaan_po').val();
            var penerimaan_kode_po = $('#penerimaan_kode_po').val();
            var analisa = $('input[name="analisa"]:checked').val();
            var namaadmin = $('input[name="namaadmin"]:checked').val();
            var keterangan_analisa = $('#keterangan_analisa').val();
            $('#btn_save').html('Menyimpan...');
            console.log(analisa);
            Swal.fire({
                title: 'Konfirmasi',
                icon: 'warning',
                text: "Apakah data yang kamu input sudah benar ?",
                showCancelButton: true,
                inputValue: 0,
                confirmButtonText: 'Yes',
            }).then(function(result) {
                if (result.value) {
                    if (analisa == 'revisi') {
                        if ($('textarea[id=keterangan_analisa]').val() == '') {
                            $('#btn_save').html('Simpan');
                            Swal.fire({
                                title: 'Maaf!!',
                                text: 'Data Harus Diisi Semua',
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
                                            id_penerimaan_po: id_penerimaan_po,
                                            penerimaan_kode_po: penerimaan_kode_po,
                                            analisa: analisa,
                                            namaadmin: namaadmin,
                                            keterangan_analisa: keterangan_analisa,
                                        },
                                        url: "{{route('ap.data_pembelian_update')}}",
                                        type: "POST",
                                        dataType: 'json',
                                        success: function(data) {
                                            $('#data_verifikasi').DataTable().ajax.reload();
                                            $('#data_verified').DataTable().ajax.reload();
                                            $('#data_kp').DataTable().ajax.reload();
                                            $("#form_verifikasi").trigger('reset');
                                            $('#btn_save').html('Simpan');
                                            $('#modal_verifikasi').modal('hide');
                                            Swal.fire({
                                                title: 'success',
                                                text: 'Data Berhasil Disimpan.',
                                                icon: 'success',
                                                timer: 1500
                                            })

                                        },
                                        error: function(data) {
                                            $("#form_verifikasi").trigger('reset');
                                            $('#btn_save').html('Simpan');
                                            $('#modal_verifikasi').modal('hide');
                                            Swal.fire({
                                                title: 'Gagal!!',
                                                text: 'Data anda Tidak di Simpan.',
                                                icon: 'error',
                                                timer: 1500
                                            })

                                        }
                                    });
                                },
                            });
                        }
                    } else if (analisa == 'verified') {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Proses Menyimpan Data...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                                $.ajax({
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        id_penerimaan_po: id_penerimaan_po,
                                        penerimaan_kode_po: penerimaan_kode_po,
                                        analisa: analisa,
                                        namaadmin: namaadmin,
                                        keterangan_analisa: keterangan_analisa,
                                    },
                                    url: "{{route('ap.data_pembelian_update')}}",
                                    type: "POST",
                                    dataType: 'json',
                                    success: function(data) {
                                        $('#data_verifikasi').DataTable().ajax.reload();
                                        $('#data_verified').DataTable().ajax.reload();
                                        $('#data_kp').DataTable().ajax.reload();
                                        $("#form_verifikasi").trigger('reset');
                                        $('#btn_save').html('Simpan');
                                        $('#modal_verifikasi').modal('hide');
                                        Swal.fire({
                                            title: 'success',
                                            text: 'Data Berhasil Disimpan.',
                                            icon: 'success',
                                            timer: 1500
                                        })

                                    },
                                    error: function(data) {
                                        $("#form_verifikasi").trigger('reset');
                                        $('#btn_save').html('Simpan');
                                        $('#modal_verifikasi').modal('hide');
                                        Swal.fire({
                                            title: 'Gagal!!',
                                            text: 'Data anda Tidak di Simpan.',
                                            icon: 'error',
                                            timer: 1500
                                        })

                                    }
                                });
                            },
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal!!',
                            text: 'Analisa Kosong..',
                            icon: 'error',
                            timer: 1500
                        })
                        $('#btn_save').html('Simpan');

                    }
                } else {
                    $('#btn_save').html('Simpan');
                    Swal.fire({
                        title: 'Gagal!!',
                        text: 'Data anda Tidak di Simpan,',
                        icon: 'error',
                        timer: 1500
                    })

                }
            });
        });
        $(document).on('click', '.to_show', function() {
            var id = $(this).attr("name");
            var tgl_po = $(this).data("tgl_po");
            var tgl_receipt = $(this).data("tgl_receipt");
            var kode_po = $(this).data("kode_po");
            // console.log(id);
            $("#form_verifikasi").trigger('reset');
            $('#id_penerimaan_po').val(id);
            $('#penerimaan_kode_po').val(kode_po);
            $('#result_no_po').html(kode_po);
            $('#result_tgl_po').html(tgl_po);
            $('#result_tgl_receipt').html(tgl_receipt);
            document.getElementById("idAdmin").style.display = "none";
            document.getElementById("form_keterangan").style.display = "none";

        });
    });
</script>
<script>
    function getcount_verifikasi() {
        $.ajax({
            type: "GET",
            url: "{{route('ap.getcount_verifikasi')}}",
            success: function(data) {
                $("#count_verifikasi").empty();
                $("#count_verified").empty();
                var notif = JSON.parse(data);
                // console.log(notif);
                $("#count_verifikasi").html(notif.data_verifikasi);
                $("#count_verified").html(notif.data_verified);
            }
        });
    }

    setInterval(getcount_verifikasi, 2000);
</script>
@endsection