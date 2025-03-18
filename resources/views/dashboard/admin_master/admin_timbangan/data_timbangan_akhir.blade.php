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
                            <i class="flaticon2-checking kt-font-success"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data Timbangan Akhir
                        </h3>
                    </div>

                </div>
                <form class="kt-form" action="javascript:void(0)" method="POST" enctype="multipart/form-data">
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
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Excel
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" name="btn_export" id="btn_export" href="javascript:void(0);"><i class="fa fa-file-excel"></i>Data Timbangan</a>
                                <a class="dropdown-item" name="btn_export1" id="btn_export1" href="javascript:void(0);"><i class="fa fa-file-excel"></i>Penerimaan Barang</a>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-10">
                        <button id="btn_total_tonase" class="btn btn-danger btn-sm mt-5 " style="float: right;"><i class="fa fa-desktop"></i>Cek Total Tonase</button>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item mt-3">
                            <a class="nav-link active" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-database"></i>GB LONG GRAIN</a>
                        </li>
                        <!-- <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_2"><i class="la la-database"></i>GB CIHERANG</a>
                        </li> -->
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_3"><i class="la la-database"></i>GB PANDAN WANGI</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_4"><i class="la la-database"></i>GB KETAN PUTIH</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_5"><i class="la la-database"></i>BERAS PECAH KULIT</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
                            <table class="table table-bordered" id="data_longgrain">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">&nbsp;Nama&nbsp;Item&nbsp;</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Supplier</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO </th>
                                        <th style="text-align: center;width:auto">Nopol&nbsp;Kendaraan</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;No&nbsp;DTM&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Timbangan&nbsp;Awal</th>
                                        <th style="text-align: center;width:auto">Timbangan&nbsp;Akhir</th>
                                        <th style="text-align: center;width:auto">Output&nbsp;Timbangan</th>
                                        <th style="text-align: center;width:auto">Aksi </th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="tab-pane" id="m_tabs_3_2" role="tabpanel">
                            <table class="table table-bordered" id="data_ciherang">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">&nbsp;Nama&nbsp;Item&nbsp;</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Supplier</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO </th>
                                        <th style="text-align: center;width:auto">Nopol&nbsp;Kendaraan</th>
                                        <th style="text-align: center;width:auto">Timbangan&nbsp;Awal</th>
                                        <th style="text-align: center;width:auto">Timbangan&nbsp;Akhir</th>
                                        <th style="text-align: center;width:auto">Output&nbsp;Timbangan</th>
                                        <th style="text-align: center;width:auto">Aksi </th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div> -->
                        <div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
                            <table class="table table-bordered" id="data_pw">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">&nbsp;Nama&nbsp;Item&nbsp;</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Supplier</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO </th>
                                        <th style="text-align: center;width:auto">Nopol&nbsp;Kendaraan</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;No&nbsp;DTM&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Timbangan&nbsp;Awal</th>
                                        <th style="text-align: center;width:auto">Timbangan&nbsp;Akhir</th>
                                        <th style="text-align: center;width:auto">Output&nbsp;Timbangan</th>
                                        <th style="text-align: center;width:auto">Aksi </th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_4" role="tabpanel">
                            <table class="table table-bordered" id="data_kp">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">&nbsp;Nama&nbsp;Item&nbsp;</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Supplier</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO </th>
                                        <th style="text-align: center;width:auto">Nopol&nbsp;Kendaraan</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;No&nbsp;DTM&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Timbangan&nbsp;Awal</th>
                                        <th style="text-align: center;width:auto">Timbangan&nbsp;Akhir</th>
                                        <th style="text-align: center;width:auto">Output&nbsp;Timbangan</th>
                                        <th style="text-align: center;width:auto">Aksi </th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_5" role="tabpanel">
                            <table class="table table-bordered" id="datatable1">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Supplier</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Nopol&nbsp;Kendaraan</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;No&nbsp;DTM&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Timbangan&nbsp;Awal</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Timbangan&nbsp;Akhir&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Output&nbsp;Timbangan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Aksi</th>
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
    </div>

    <!-- end:: Content -->
</div>

<div class="modal fade" id="modal_total_tonase" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Cek Total Tonase</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);" id="form_totaltonase" method="GET">
                    @csrf
                    <div class="row input-daterange">
                        <div class="col-md-4">
                            <label>Start PO</label>
                            <input class="form-control" type="text" readonly name="mulai_date" id="mulai_date">
                        </div>
                        <div class="col-md-4">
                            <label>End PO</label>
                            <input class="form-control" type="text" readonly name="akhir_date" id="akhir_date">
                        </div>
                        <div class="col-md-4">
                            <div class="">
                                <label></label>
                                <button class="btn btn-info mt-4" type="button" name="" id="btn_tonaserefresh" title="Refresh"><i class="flaticon2-reload"></i></button>
                                <button class="btn btn-success mt-4 ml-1" type="button" name="" id="btn_cek" title="Cek Total Tonase"><i class="flaticon2-search-1"></i>&nbsp;Cek</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="kt-portlet__body mt-3">
                    <div class="m-portlet m-portlet--tab">
                        <div class="m-portlet__body">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="tab" href="#m_tabs_1_1">
                                        <i class="fa fa-home"></i> GUDANG UTARA
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#m_tabs_1_2">
                                        <i class="fa fa-home"></i> GUDANG SELATAN
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#m_tabs_1_3">
                                        <i class="fa fa-home"></i> BERAS PK
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="m_tabs_1_1" role="tabpanel">
                                    <div class="m-portlet__body">
                                        <dl class="dl-horizontal row">
                                            <dd class="col-sm-3">Tanggal PO</dd>
                                            <dd>:</dd>
                                            <dd class="col-sm-8" id="tgl_po_utara"></dd>
                                            <dd class="col-sm-3">Total Tonase</dd>
                                            <dd>:</dd>
                                            <dd class="col-sm-8" style="font-weight: bold;" id="total_tonase_utara"></dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="tab-pane" id="m_tabs_1_2" role="tabpanel">
                                    <div class="m-portlet__body">
                                        <dl class="dl-horizontal row">
                                            <dd class="col-sm-3">Tanggal PO</dd>
                                            <dd>:</dd>
                                            <dd class="col-sm-8" id="tgl_po_selatan"></dd>
                                            <dd class="col-sm-3">Total Tonase</dd>
                                            <dd>:</dd>
                                            <dd class="col-sm-8" style="font-weight: bold;" id="total_tonase_selatan"></dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="tab-pane" id="m_tabs_1_3" role="tabpanel">
                                    <div class="m-portlet__body">
                                        <dl class="dl-horizontal row">
                                            <dd class="col-sm-3">Tanggal PO</dd>
                                            <dd>:</dd>
                                            <dd class="col-sm-8" id="tgl_po_selatan"></dd>
                                            <dd class="col-sm-3">Total Tonase</dd>
                                            <dd>:</dd>
                                            <dd class="col-sm-8" id="total_tonase_selatan"></dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        load_data();

        function load_data(from_date = '', to_date = '') {
            var table = $('#data_longgrain').DataTable({
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
                    url: "{{ route('master.data_timbangan_akhir_gb_longgrain_index') }}",
                    data: {
                        from_date: from_date,
                        to_date: to_date
                    }
                },
                columns: [{
                        data: "id_admin_timbangan",

                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
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
                        data: 'no_dtm'
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
                        data: 'ckelola'
                    },

                ],
                createdRow: function(row, data, index) {

                    // Updated Schedule Week 1 - 07 Mar 22

                    if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
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
                table.columns.adjust().draw().responsive.recalc();
            })

            var table2 = $('#data_pw').DataTable({
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
                    url: "{{ route('master.data_timbangan_akhir_gb_pandan_wangi_index') }}",
                    data: {
                        from_date: from_date,
                        to_date: to_date
                    }
                },
                columns: [{
                        data: "id_admin_timbangan",

                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
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
                        data: 'no_dtm'
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
                        data: 'ckelola'
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
                    }
                },
                "order": []
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                table2.columns.adjust().draw().responsive.recalc();
            })
            var table3 = $('#data_kp').DataTable({
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
                    url: "{{ route('master.data_timbangan_akhir_gb_ketan_putih_index') }}",
                    data: {
                        from_date: from_date,
                        to_date: to_date
                    }
                },
                columns: [{
                        data: "id_admin_timbangan",

                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
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
                        data: 'no_dtm'
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
                        data: 'ckelola'
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
                    }
                },
                "order": []
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                table3.columns.adjust().draw().responsive.recalc();
            })
            var table4 = $('#datatable1').DataTable({
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
                    url: "{{ route('master.data_timbangan_akhir_pk_index') }}",
                    data: {
                        from_date: from_date,
                        to_date: to_date
                    }
                },
                columns: [{
                        data: "id_admin_timbangan",

                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
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
                        data: 'no_dtm'
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
                        data: 'ckelola'
                    },

                ],
                "order": []
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                table4.columns.adjust().draw().responsive.recalc();
            })
        }
        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            if (from_date != '' && to_date != '') {
                $('#datatable1').DataTable().destroy();
                $('#data_longgrain').DataTable().destroy();
                $('#data_pw').DataTable().destroy();
                $('#data_kp').DataTable().destroy();
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
            $('#data_pw').DataTable().destroy();
            $('#data_kp').DataTable().destroy();
            $('#data_longgrain').DataTable().destroy();
            load_data();
        });
        $('#btn_export').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            $.ajax({
                data: {
                    "_token": "{{ csrf_token() }}",
                    from_date: from_date,
                    to_date: to_date,
                },
                url: "{{route('master.download_excel')}}",
                type: "POST",
                cache: false,
                xhrFields: {
                    responseType: 'blob'
                },
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data, status, xhr) {
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(data);
                    link.download = `Data Timbangan PT. SURYA PANGAN SEMESTA NGAWI.xlsx`;
                    link.click();

                }
            });
        });
        $('#btn_export1').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            $.ajax({
                data: {
                    "_token": "{{ csrf_token() }}",
                    from_date: from_date,
                    to_date: to_date,
                },
                url: "{{route('master.download_penerimaan_barang_excel')}}",
                type: "POST",
                cache: false,
                xhrFields: {
                    responseType: 'blob'
                },
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data, status, xhr) {
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(data);
                    link.download = `Data Penerimaan Barang PT. SURYA PANGAN SEMESTA NGAWI.xlsx`;
                    link.click();

                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '#btn_total_tonase', function() {
            $('#modal_total_tonase').modal("show");
            $('#form_totaltonase').trigger('reset');
            $('#tgl_po_utara').empty();
            $('#tgl_po_selatan').empty();
            $('#total_tonase_utara').empty();
            $('#total_tonase_selatan').empty();

        });
        $(document).on('click', '#btn_tonaserefresh', function() {
            $('#form_totaltonase').trigger('reset');
            $('#tgl_po_utara').empty();
            $('#tgl_po_selatan').empty();
            $('#total_tonase_utara').empty();
            $('#total_tonase_selatan').empty();

        });
        $(document).on('click', '#btn_cek', function() {
            var mulai_date = $('#mulai_date').val();
            var akhir_date = $('#akhir_date').val();
            $.ajax({
                type: "GET",
                url: "{{route('master.total_tonase')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    mulai_date: mulai_date,
                    akhir_date: akhir_date,
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    console.log(response.data_utara[0].total_tonase);
                    var total_tonase_utara = response.data_utara[0].total_tonase;
                    var total_tonase_selatan = response.data_selatan[0].total_tonase;
                    if (total_tonase_utara == null || total_tonase_utara == '') {

                        let rupiah_total_tonase_utara = '0'
                        $('dd[id=tgl_po_utara]').html(mulai_date + ' - ' + akhir_date);
                        $('dd[id=total_tonase_utara]').html(rupiah_total_tonase_utara + ' Kg');
                    } else {
                        let rupiah_total_tonase_utara = total_tonase_utara.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                        $('dd[id=tgl_po_utara]').html(mulai_date + ' - ' + akhir_date);
                        $('dd[id=total_tonase_utara]').html(rupiah_total_tonase_utara + ' Kg');

                    }
                    if (total_tonase_selatan == null || total_tonase_selatan == '') {

                        let rupiah_total_tonase_selatan = '0';
                        $('dd[id=tgl_po_selatan]').html(mulai_date + ' - ' + akhir_date);
                        $('dd[id=total_tonase_selatan]').html(rupiah_total_tonase_selatan + ' Kg');
                    } else {
                        let rupiah_total_tonase_selatan = total_tonase_selatan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                        $('dd[id=tgl_po_selatan]').html(mulai_date + ' - ' + akhir_date);
                        $('dd[id=total_tonase_selatan]').html(rupiah_total_tonase_selatan + ' Kg');

                    }
                }
            });
        });
        $(document).on('click', '.to_show', function() {
            var id = $(this).attr("name");
            var url = "{{ route('master.show_timbangan_akhir') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_penerimaan_po').val(parsed.id_penerimaan_po);
                    $('#id_data_po').val(parsed.id_data_po);
                    $('#kode_po_timbangan').val(parsed.kode_po);
                    $('#bid_user').val(parsed.bid_user_id);
                    $('#plat_kendaraan').val(parsed.plat_kendaraan);
                }
            });
        });
    });
</script>
@endsection