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
                            <i class="flaticon2-correct kt-font-success"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Integrasi Epicor
                        </h3>
                    </div>
                </div>
                <label style="margin-left: 20px; margin-top:10px;">Sort By Tanggal PO :</label>
                <div style="margin-left: 10px;" class="row input-daterange">
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
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item mt-3">
                            <a class="nav-link active" data-toggle="tab" role="tab" href="#m_tabs_3_1"><i class="la la-database"></i>KIRIM&nbsp;EPICOR</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#m_tabs_3_2"><i class="la la-database"></i>DITERIMA&nbsp;EPICOR</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
                            <table class="table table-bordered" width="100%" id="datatable">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">No</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;Site&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;Nama&nbsp;Item&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;PO&nbsp;Num&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;Nama&nbsp;Supplier&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;Nopol&nbsp;Kendaraan&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;No.&nbsp;DTM&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;Bruto&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;Tara&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;Netto&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;Status&nbsp;Approved&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;Status&nbsp;Epicor&nbsp;&nbsp;</th>
                                        <!-- <th width="50px"><button style="float:right;" class="btn btn-primary" id="delete_all" data-url="{{ url('myproductsDeleteAll') }}">Send&nbsp;All&nbsp;Selected</button></th> -->
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_2" role="tabpanel">
                            <table class="table table-bordered" width="100%" id="datatable1">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">No</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;Site&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;Nama&nbsp;Item&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;PO&nbsp;Num&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;Nama&nbsp;Supplier&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;Nopol&nbsp;Kendaraan&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;No.&nbsp;DTM&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;Bruto&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;Tara&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;Netto&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;Status&nbsp;Approved&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">&nbsp;&nbsp;Status&nbsp;Epicor&nbsp;&nbsp;</th>
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

        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="formtimbangan_awal" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{route('ap.data_pembelian_update')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Data Verifikasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_penerimaan_po" id="id_penerimaan_po" value="">
                            <div class="form-group">
                                <div class="">
                                    <label>Kode PO</label>
                                    <input id="penerimaan_kode_po" readonly name="penerimaan_kode_po" type="text" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Analisa</label>
                                    <div class="kt-radio-inline">
                                        <label class="kt-radio">
                                            <input type="radio" value="verified" id="lokasigt" class="form-control m-input" name="analisa"> Verifikasi
                                            <span></span>
                                        </label>
                                        <label class="kt-radio">
                                            <input type="radio" value="revisi" id="lokasi04" class="form-control m-input" name="analisa"> Revisi
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" id="isi_broadcast" name="keterangan_analisa"></textarea>
                                </div>
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
                    url: "{{route('master.integrasi_epicor_gb_index')}}",
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
                        data: 'site_admin'
                    },
                    {
                        data: 'name_bid'
                    },
                    {
                        data: 'PONum'
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
                        data: 'harga_akhir'
                    },
                    {
                        data: 'approved'
                    },
                    {
                        data: 'ckelola'
                    },
                    // {
                    //     data: 'selected',
                    //     orderable: true,
                    //     searchable: false
                    // },

                ],
                createdRow: function(row, data, index) {

                    // Updated Schedule Week 1 - 07 Mar 22

                    if (data.name_bid == 'GABAH BASAH CIHERANG') {
                        $('td:eq(2)', row).css('color', '#000099'); //Original Date
                    } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                        $('td:eq(2)', row).css('color', '#009900'); // Behind of Original Date
                    } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                        $('td:eq(2)', row).css('color', '#330019'); // Behind of Original Date
                    } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                        $('td:eq(2)', row).css('color', '#6666FF'); // Behind of Original Date
                    }
                },
                "order": [
                    [1, "desc"]
                ]
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                table.columns.adjust().draw().responsive.recalc();
            })
            var table1 = $('#datatable1').DataTable({
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
                    url: "{{route('master.integrasi_epicor_gb1_index')}}",
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
                        data: 'site_admin'
                    },
                    {
                        data: 'name_bid'
                    },
                    {
                        data: 'PONum'
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
                        data: 'harga_akhir'
                    },
                    {
                        data: 'approved'
                    },
                    {
                        data: 'ckelola'
                    },
                ],
                createdRow: function(row, data, index) {

                    // Updated Schedule Week 1 - 07 Mar 22

                    if (data.name_bid == 'GABAH BASAH CIHERANG') {
                        $('td:eq(2)', row).css('color', '#000099'); //Original Date
                    } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                        $('td:eq(2)', row).css('color', '#009900'); // Behind of Original Date
                    } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                        $('td:eq(2)', row).css('color', '#330019'); // Behind of Original Date
                    } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                        $('td:eq(2)', row).css('color', '#6666FF'); // Behind of Original Date
                    }
                },
                "order": [
                    [1, "desc"]
                ]
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                table1.columns.adjust().draw().responsive.recalc();
            })
        }
        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            if (from_date != '' && to_date != '') {
                $('#datatable').DataTable().destroy();
                $('#datatable1').DataTable().destroy();
                // table.ajax.reload(from_date, to_date);
                load_data(from_date, to_date);
                Swal.fire('Berhasil', 'Sukses filter data', 'success');
            } else {
                Swal.fire('Infoo!!', 'Mohon Isikan data', 'warning');
            }

        });

        $('#refresh').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#datatable').DataTable().destroy();
            $('#datatable1').DataTable().destroy();
            load_data();
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    $(function() {
        $(document).on('change', 'input[type=checkbox]', function(e) {
            if ($('input[type=checkbox]:checked').length > 5) {
                $(this).prop('checked', false)
                Swal.fire({
                    title: 'Maaf !',
                    text: 'Maksimal Selected 5 PO',
                    icon: 'warning',
                    timer: 1500
                })
            }
        })
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
                    $('#formtimbangan_awal').submit();
                    Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '.to_show', function() {
            var id = $(this).attr("name");
            // console.log(id);
            var url = "{{ route('master.data_pembelian_show') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    // console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_penerimaan_po').val(parsed.id_penerimaan_po);
                    $('#penerimaan_kode_po').val(parsed.penerimaan_kode_po);
                }
            });
        });
        $(document).on('click', '#delete_all', function() {
            var id_penerimaan_po = [];
            console.log(id_penerimaan_po);
            $('.users_checkbox:checked').each(function() {
                id_penerimaan_po.push($(this).val());
            });
            if (id_penerimaan_po.length > 0) {
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    html: 'Kamu Akan Mengirim <b>' + id_penerimaan_po.length + '</b> Data Ke Epicor',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.value) {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Proses Kirim Epicor..', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                                $.ajax({
                                    url: "{{ route('master.kirim_epicor_gb_all')}}",
                                    method: "get",
                                    data: {
                                        id_penerimaan_po: id_penerimaan_po
                                    },
                                    success: function(data) {
                                        Swal.fire({
                                            title: 'Sukses!',
                                            text: 'Anda berhasil Kirim Data',
                                            icon: 'success',
                                            timer: 1500
                                        })
                                        $('#datatable').DataTable().ajax.reload();
                                    },
                                    error: function(data) {
                                        var errors = data.responseJSON;
                                        console.log(errors);
                                    }
                                });
                            },
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: 'Maaf!',
                    text: 'Harap pilih Data.',
                    icon: 'warning',
                    timer: 1500
                })
            }
        });
        $('body').on('click', '#btn_kirimepicor_gb', function() {
            var cek = $(this).data('id');
            console.log(cek);
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Kamu Akan Mengirim Data Ke Epicor",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        title: 'Harap Tuggu Sebentar!',
                        html: 'Proses Input Data...', // add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                            $.ajax({
                                url: "{{route('master.kirim_epicor_gb')}}/" + cek,
                                type: "GET",
                                error: function() {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: 'Gagal Kirim Data.',
                                        icon: 'error',
                                        timer: 1500
                                    })
                                },
                                success: function(data) {
                                    Swal.fire({
                                        title: 'Sukses!',
                                        text: 'Anda berhasil Kirim Data',
                                        icon: 'success',
                                        timer: 1500
                                    })
                                    $('#datatable').DataTable().ajax.reload();
                                }
                            });
                        },
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });

        });
        $('body').on('click', '#btn_approve_gb', function() {
            var cek = $(this).data('id');
            console.log(cek);
            Swal.fire({
                title: 'Apakah Yakin Approve Data Ini',
                icon: 'warning',
                text: "Pilih 'Approved' Untuk Approve Data Ini",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Approved',
                customClass: 'swal-wide',
                denyButtonText: 'Tolak Approve'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Harap Tuggu Sebentar!',
                        html: 'Proses Approve Data...', // add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                            $.ajax({
                                url: "{{route('master.approve_receipt')}}/" + cek,
                                type: "GET",
                                error: function() {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: 'Gagal Approve Data.',
                                        icon: 'error',
                                        timer: 1500
                                    })
                                },
                                success: function(data) {
                                    Swal.fire({
                                        title: 'Sukses!',
                                        text: 'Anda berhasil Approve Data',
                                        icon: 'success',
                                        timer: 1500
                                    })
                                    $('#datatable').DataTable().ajax.reload();
                                }
                            });
                        },
                    });
                } else if (result.isDenied) {
                    $.ajax({
                        type: "GET",
                        url: "{{route('master.not_approve_receipt')}}/" + cek,
                        success: function(response) {
                            Swal.fire('Sukses!', 'Data Anda Sudah Tersimpan', 'success', 1500)
                            $('#datatable').DataTable().ajax.reload();

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
        $('body').on('click', '#btn_information', function() {

            Swal.fire({
                title: 'Maaf !',
                text: 'Data Anda Belum Di Approved',
                icon: 'warning',
                timer: 1500
            })
        });
    });
</script>
@endsection