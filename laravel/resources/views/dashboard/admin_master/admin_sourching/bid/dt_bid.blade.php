@extends('dashboard.admin_master.layout.main')
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
                    E-PROCUREMENT
                </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
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
                            <i class="flaticon2-list kt-font-primary"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data E-Procurement
                        </h3>
                    </div>
                </div>
                <div style="margin-left: 10px; margin-top:10px;" class="input-daterange">
                    <h5>Filter PO</h5>
                    <div class="row">
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
                </div>
                <div class="kt-portlet__body">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item mt-3">
                            <a class="nav-link active" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-database"></i>GABAH BASAH</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_2"><i class="la la-database"></i>BERAS PECAH KULIT</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_3"><i class="la la-database"></i>BERAS DS</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
                            <table class="table table-bordered" id="data_gb">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">No</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Status</th>
                                        <th style="text-align: center;width:15%">Pengajuan</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;List&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kuota&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Add&nbsp;Kuota</th>
                                        <th style="text-align: center;width:15%">Total&nbsp;Kuota</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Mulai&nbsp;Pengajuan</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tutup&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_2" role="tabpanel">
                            <table class="table table-bordered" id="data_pk">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">No</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Status</th>
                                        <th style="text-align: center;width:15%">Pengajuan</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;List&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kuota&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Add&nbsp;Kuota</th>
                                        <th style="text-align: center;width:15%">Total&nbsp;Kuota</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Mulai&nbsp;Pengajuan</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tutup&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
                            <table class="table table-bordered" id="data_ds">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">No</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Status</th>
                                        <th style="text-align: center;width:15%">Pengajuan</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;List&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kuota&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Add&nbsp;Kuota</th>
                                        <th style="text-align: center;width:15%">Total&nbsp;Kuota</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Mulai&nbsp;Pengajuan</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tutup&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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

        <div class="modal fade" id="modal_addkuota" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="form_addkuota" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('master.add_kuota') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">ADD Kuota Tambahan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" id="id" value="">
                            <div class="form-group">
                                <select class="form-control selectpicker" id="add_kuota" required name="add_kuota" data-live-search="true">
                                    <option selected disabled value="">Pilih Add Kuota</option>
                                    <option value="8000">8.000 Kg -> Setara 1 Truk</option>
                                    <option value="16000">16.000 Kg -> Setara 2 Truk</option>
                                    <option value="24000">24.000 Kg -> Setara 3 Truk</option>
                                    <option value="32000">32.000 Kg -> Setara 4 Truk</option>
                                    <option value="40000">40.000 Kg -> Setara 5 Truk</option>
                                    <option value="48000">48.000 Kg -> Setara 6 Truk</option>
                                    <option value="56000">56.000 Kg -> Setara 7 Truk</option>
                                    <option value="64000">64.000 Kg -> Setara 8 Truk</option>
                                    <option value="72000">72.000 Kg -> Setara 9 Truk</option>
                                    <option value="80000">80.000 Kg -> Setara 10 Truk</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button id="btn_saveaddkuota" class="btn btn-success m-btn pull-right">Save</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end:: Content -->
</div>
@endsection
@section('js')


<script>
    $(document).ready(function() {
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        load_data();

        function load_data(from_date = '', to_date = '') {
            var table1 = $('#data_gb').DataTable({
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
                    url: "{{ route('master.bid_gb_index') }}",
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
                        data: 'name_bid'
                    },
                    {
                        data: 'batas_bid'
                    },
                    {
                        data: 'response'
                    },
                    {
                        data: 'list_po'
                    },
                    {
                        data: 'kuota'
                    },
                    {
                        data: 'kuota_tambahan'
                    },
                    {
                        data: 'total_kuota'
                    },
                    {
                        data: 'open_po'
                    },
                    {
                        data: 'start_pengajuan'
                    },
                    {
                        data: 'close_po'
                    },


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
                table1.columns.adjust().draw().responsive.recalc();
            })
            var table2 = $('#data_pk').DataTable({
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
                    url: "{{ route('master.bid_pk_index') }}",
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
                        data: 'name_bid'
                    },
                    {
                        data: 'batas_bid'
                    },
                    {
                        data: 'response'
                    },
                    {
                        data: 'list_po'
                    },
                    {
                        data: 'kuota'
                    },
                    {
                        data: 'kuota_tambahan'
                    },
                    {
                        data: 'total_kuota'
                    },
                    {
                        data: 'open_po'
                    },
                    {
                        data: 'start_pengajuan'
                    },
                    {
                        data: 'close_po'
                    },
                    {
                        data: 'ckelola'
                    }


                ],
                createdRow: function(row, data, index) {

                    // Updated Schedule Week 1 - 07 Mar 22

                    if (data.name_bid == 'GABAH BASAH CIHERANG') {
                        $('td:eq(2)', row).css('color', '#000099'); //Original Date
                    } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                        $('td:eq(2)', row).css('color', '#009900'); // Behind of Original Date
                    } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                        $('td:eq(2)', row).css('color', '#330019'); // Behind of Original Date
                    }
                },
                "order": []
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                table2.columns.adjust().draw().responsive.recalc();
            })
            var table3 = $('#data_ds').DataTable({
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
                    url: "{{ route('master.bid_ds_index') }}",
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
                        data: 'name_bid'
                    },
                    {
                        data: 'batas_bid'
                    },
                    {
                        data: 'response'
                    },
                    {
                        data: 'list_po'
                    },
                    {
                        data: 'kuota'
                    },
                    {
                        data: 'kuota_tambahan'
                    },
                    {
                        data: 'total_kuota'
                    },
                    {
                        data: 'open_po'
                    },
                    {
                        data: 'close_po'
                    },
                    {
                        data: 'start_pengajuan'
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
                    }
                },
                "order": []
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                table3.columns.adjust().draw().responsive.recalc();
            })

        }
        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            if (from_date != '' && to_date != '') {
                $('#data_gb').DataTable().destroy();
                $('#data_pk').DataTable().destroy();
                $('#data_ds').DataTable().destroy();
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
            $('#data_gb').DataTable().destroy();
            $('#data_pk').DataTable().destroy();
            $('#data_ds').DataTable().destroy();
            load_data();
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    $(function() {

        $(document).on('click', '#btn_saveaddkuota', function(e) {
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
                    if ($('#add_kuota').val() == '') {
                        Swal.fire('Gagal!', 'Data Harus Terisi.', 'error')

                    } else {
                        $('#form_addkuota').submit();
                        Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                    }

                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });

        $('body').on('click', '#btn_delete_kuota', function() {
            var cek = $(this).data('id');
            console.log(cek);
            $.ajax({
                url: "{{route('master.delete_add_kuota')}}/" + cek,
                type: "GET",
                error: function() {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Gagal Hapus Kuota.',
                        icon: 'error',
                        timer: 1500
                    })
                },
                success: function(data) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Berhasil Hapus Kuota.',
                        icon: 'success',
                        timer: 1500
                    })
                    $('#data_gb').DataTable().ajax.reload();
                    $('#data_pk').DataTable().ajax.reload();
                    $('#data_ds').DataTable().ajax.reload();
                }
            });

        });
        $('body').on('click', '#btn_status', function() {
            var cek = $(this).data('id');
            console.log(cek);
            $.ajax({
                url: "{{url('master/bid_status')}}/" + cek,
                type: "GET",
                error: function() {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Gagal Update Status.',
                        icon: 'error',
                        timer: 1500
                    })
                },
                success: function(data) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Berhasil Update Status.',
                        icon: 'success',
                        timer: 1500
                    })
                    $('#data_gb').DataTable().ajax.reload();
                    $('#data_pk').DataTable().ajax.reload();
                    $('#data_ds').DataTable().ajax.reload();
                }
            });

        });
        $(document).on('click', '#btn_addkuota', function() {
            var id = $(this).data('id');
            var add_kuota = $(this).data('add_kuota');
            $('input[id=id]').val(id);
            $('select[id=add_kuota]').val(add_kuota);
            $('#modal_addkuota').modal('show');
        });

    });
</script>
@endsection