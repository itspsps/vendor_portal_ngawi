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
                            <i class="flaticon2-box kt-font-info"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data Sourching On Process
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
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Aksi&nbsp;Harga</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Beli&nbsp;Gabah</th>
                                        <th style="text-align: center;width:auto">Harga&nbsp;Berdasarkan&nbsp;Tempat</th>
                                        <th style="text-align: center;width:auto">Harga&nbsp;Berdasarkan&nbsp;Harga&nbsp;Atas</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;-&nbsp;Rp.&nbsp;13&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Keterangan&nbsp;Harga</th>
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
                                        <th style="text-align: center;width:auto">Aksi&nbsp;Harga</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Beli&nbsp;Gabah</th>
                                        <th style="text-align: center;width:auto">Harga&nbsp;Berdasarkan&nbsp;Tempat</th>
                                        <th style="text-align: center;width:auto">Harga&nbsp;Berdasarkan&nbsp;Harga&nbsp;Atas</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;-&nbsp;Rp.&nbsp;13&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Keterangan&nbsp;Harga</th>
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
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Aksi&nbsp;Harga</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Beli&nbsp;Gabah</th>
                                        <th style="text-align: center;width:auto">Harga&nbsp;Berdasarkan&nbsp;Tempat</th>
                                        <th style="text-align: center;width:auto">Harga&nbsp;Berdasarkan&nbsp;Harga&nbsp;Atas</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;-&nbsp;Rp.&nbsp;13&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Keterangan&nbsp;Harga</th>
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
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Aksi&nbsp;Harga</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Beli&nbsp;Gabah</th>
                                        <th style="text-align: center;width:auto">Harga&nbsp;Berdasarkan&nbsp;Tempat</th>
                                        <th style="text-align: center;width:auto">Harga&nbsp;Berdasarkan&nbsp;Harga&nbsp;Atas</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;-&nbsp;Rp.&nbsp;13&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Keterangan&nbsp;Harga</th>
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
                                        <th style="text-align: center;width:2%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokasi&nbsp;Bongkar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;DTM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;Tonase&nbsp;Awal&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;Tonase&nbsp;Akhir&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;Hasil&nbsp;Akhir&nbsp;Tonase</th>
                                        <th style="text-align: center;width:auto">Aktual&nbsp;Kualitas</th>
                                        <th style="text-align: center;width:auto">Harga&nbsp;Awal&nbsp;Incoming</th>
                                        <th style="text-align: center;width:auto">Aksi&nbsp;Harga</th>
                                        <th style="text-align: center;width:auto">Harga&nbsp;Akhir&nbsp;Incoming</th>
                                        <th style="text-align: center;width:auto">Harga&nbsp;Bongkaran</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Keterangan&nbsp;Harga&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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
                    url: "{{ route('master.data_sourching_onprocess_gb_longgrain_index') }}",
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
                        data: 'aksi_harga'
                    },
                    {
                        data: 'nama_vendor'
                    },
                    {
                        data: 'kode_po'
                    },
                    {
                        data: 'tanggal_po'
                    },
                    {
                        data: 'plat_kendaraan'
                    },
                    {
                        data: 'plan_harga_beli_gabah'
                    },
                    {
                        data: 'harga_berdasarkan_tempat'
                    },
                    {
                        data: 'harga_berdasarkan_harga_atas'
                    },
                    {
                        data: 'harga_akhir'
                    },
                    {
                        data: 'keterangan_harga_akhir_gb'
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
                table.columns.adjust().draw().responsive.recalc();
            })
            // var table1 = $('#data_ciherang').DataTable({
            //     "scrollY": true,
            //     "scrollX": true,
            //     processing: true,
            //     serverSide: true,
            //     "aLengthMenu": [
            //         [25, 100, 300, -1],
            //         [25, 100, 300, "All"]
            //     ],
            //     "iDisplayLength": 10,
            //     ajax: {
            //         url: "{{ route('master.data_sourching_onprocess_gb_ciherang_index') }}",
            //         data: {
            //             from_date: from_date,
            //             to_date: to_date
            //         }
            //     },
            //     columns: [{
            //             data: "id_bid",

            //             render: function(data, type, row, meta) {
            //                 return meta.row + meta.settings._iDisplayStart + 1;
            //             }
            //         },
            //         {
            //             data: 'aksi_harga'
            //         },
            //         {
            //             data: 'name_bid'
            //         },
            //         {
            //             data: 'nama_vendor'
            //         },
            //         {
            //             data: 'kode_po'
            //         },
            //         {
            //             data: 'tanggal_po'
            //         },
            //         {
            //             data: 'plat_kendaraan'
            //         },
            //         {
            //             data: 'plan_harga_beli_gabah'
            //         },
            //         {
            //             data: 'harga_berdasarkan_tempat'
            //         },
            //         {
            //             data: 'harga_berdasarkan_harga_atas'
            //         },
            //         {
            //             data: 'harga_akhir'
            //         },
            //         {
            //             data: 'keterangan_harga_akhir_gb'
            //         },
            //     ],
            //     createdRow: function(row, data, index) {

            //         // Updated Schedule Week 1 - 07 Mar 22

            //         if (data.name_bid == 'GABAH BASAH CIHERANG') {
            //             $('td:eq(2)', row).css('color', '#000099'); //Original Date
            //         } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
            //             $('td:eq(2)', row).css('color', '#009900'); // Behind of Original Date
            //         } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
            //             $('td:eq(2)', row).css('color', '#330019'); // Behind of Original Date
            //         } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
            //             $('td:eq(2)', row).css('color', '#6666FF'); // Behind of Original Date
            //         }
            //     },
            //     "order": []
            // });
            // $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            //     table1.columns.adjust().draw().responsive.recalc();
            // })
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
                    url: "{{ route('master.data_sourching_onprocess_gb_pandan_wangi_index') }}",
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
                        data: 'aksi_harga'
                    },
                    {
                        data: 'nama_vendor'
                    },
                    {
                        data: 'kode_po'
                    },
                    {
                        data: 'tanggal_po'
                    },
                    {
                        data: 'plat_kendaraan'
                    },
                    {
                        data: 'plan_harga_beli_gabah'
                    },
                    {
                        data: 'harga_berdasarkan_tempat'
                    },
                    {
                        data: 'harga_berdasarkan_harga_atas'
                    },
                    {
                        data: 'harga_akhir'
                    },
                    {
                        data: 'keterangan_harga_akhir_gb'
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
                    url: "{{ route('master.data_sourching_onprocess_gb_ketan_putih_index') }}",
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
                        data: 'aksi_harga'
                    },
                    {
                        data: 'nama_vendor'
                    },
                    {
                        data: 'kode_po'
                    },
                    {
                        data: 'tanggal_po'
                    },
                    {
                        data: 'plat_kendaraan'
                    },
                    {
                        data: 'plan_harga_beli_gabah'
                    },
                    {
                        data: 'harga_berdasarkan_tempat'
                    },
                    {
                        data: 'harga_berdasarkan_harga_atas'
                    },
                    {
                        data: 'harga_akhir'
                    },
                    {
                        data: 'keterangan_harga_akhir_gb'
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
                    url: "{{ route('master.data_sourching_onprocess_pk_index') }}",
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
                        data: 'lokasi_bongkar_pk'
                    },
                    {
                        data: 'plat_kendaraan'
                    },
                    {
                        data: 'nama_vendor'
                    },
                    {
                        data: 'kode_po'
                    },
                    {
                        data: 'no_dtm_pk'
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
                        data: 'aktual_kualitas_pk'
                    },
                    {
                        data: 'harga_awal_pk'
                    },
                    {
                        data: 'aksi_harga_pk'
                    },
                    {
                        data: 'harga_akhir_pk'
                    },
                    {
                        data: 'harga_bongkaran_pk'
                    },
                    {
                        data: 'keterangan_harga_akhir_pk'
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
                $('#data_ciherang').DataTable().destroy();
                $('#data_pw').DataTable().destroy();
                $('#data_kp').DataTable().destroy();
                $('#data_longgrain').DataTable().destroy();
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
            $('#data_ciherang').DataTable().destroy();
            $('#data_pw').DataTable().destroy();
            $('#data_kp').DataTable().destroy();
            $('#data_longgrain').DataTable().destroy();
            $('#datatable1').DataTable().destroy();
            load_data();
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '.aksi_harga', function() {
            var id = $(this).attr("name");
            var url = "{{ route('qc.lab.detail_output_incoming_qc') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#plan_harga').val(parsed.plan_harga);
                    console.log(parsed.bid_user_id);
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $('body').on('click', '#btn_deal_gb', function() {
            var cek = $(this).data('id');
            console.log(cek);
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Kamu Akan Deal Data Ini",
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
                                url: "{{route('master.status_deal_gb')}}/" + cek,
                                type: "GET",
                                error: function() {
                                    alert('Something is wrong');
                                },
                                success: function(data) {
                                    Swal.fire({
                                        title: 'Berhasil',
                                        text: 'Data Anda Berhasil Di Deal.',
                                        icon: 'success',
                                        timer: 1500
                                    })
                                    $('#data_ciherang').DataTable().ajax.reload();
                                    $('#data_pw').DataTable().ajax.reload();
                                    $('#data_kp').DataTable().ajax.reload();
                                    $('#data_longgrain').DataTable().ajax.reload();
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

        $('body').on('click', '#btn_deal_pk', function() {
            var cek = $(this).data('id');
            console.log(cek);
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Kamu Akan Deal Data Ini",
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
                                url: "{{route('master.status_deal_pk')}}/" + cek,
                                type: "GET",
                                error: function() {
                                    alert('Something is wrong');
                                },
                                success: function(data) {
                                    Swal.fire({
                                        title: 'Berhasil',
                                        text: 'Data Anda Berhasil Di Deal.',
                                        icon: 'success',
                                        timer: 1500
                                    })
                                    $('#data_ciherang').DataTable().ajax.reload();
                                    $('#data_pw').DataTable().ajax.reload();
                                    $('#data_kp').DataTable().ajax.reload();
                                    $('#data_longgrain').DataTable().ajax.reload();
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
        $('body').on('click', '#btn_nego_gb', function() {
            var cek = $(this).data('id');
            console.log(cek);
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Kamu Akan Nego Data Ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{route('master.status_nego_gb')}}/" + cek,
                        type: "GET",
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'Data Anda Berhasil Di Nego.',
                                icon: 'success',
                                timer: 1500
                            })
                            $('#data_ciherang').DataTable().ajax.reload();
                            $('#data_pw').DataTable().ajax.reload();
                            $('#data_kp').DataTable().ajax.reload();
                            $('#data_longgrain').DataTable().ajax.reload();
                            $('#datatable1').DataTable().ajax.reload();
                        }
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });

        });
        $('body').on('click', '#btn_nego_pk', function() {
            var cek = $(this).data('id');
            console.log(cek);
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Kamu Akan Nego Data Ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{route('master.status_nego_pk')}}/" + cek,
                        type: "GET",
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'Data Anda Berhasil Di Nego.',
                                icon: 'success',
                                timer: 1500
                            })
                            $('#data_ciherang').DataTable().ajax.reload();
                            $('#data_pw').DataTable().ajax.reload();
                            $('#data_kp').DataTable().ajax.reload();
                            $('#data_longgrain').DataTable().ajax.reload();
                            $('#datatable1').DataTable().ajax.reload();
                        }
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });

        });
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