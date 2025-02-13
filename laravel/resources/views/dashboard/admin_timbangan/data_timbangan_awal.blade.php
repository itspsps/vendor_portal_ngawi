@extends('dashboard.admin_timbangan.layout.main')
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
                        Data Timbangan Masuk
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
                            <i class="flaticon2-checking kt-font-info"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data Timbangan Awal
                        </h3>
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
                                        <th style="text-align: center;width:18%">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:18%">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:18%">&nbsp;Nama&nbsp;Supplier&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <!--<th style="text-align: center;width:18%">Vendor</th>-->
                                        <th style="text-align: center;width:18%">&nbsp;Tanggal&nbsp;PO&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;Penerima&nbsp;Timbangan&nbsp;Awal&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;Timbangan&nbsp;Awal&nbsp;</th>
                                        <th style="text-align: center;width:20%">&nbsp;Status&nbsp;</th>
                                    </tr>>
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
                                        <th style="text-align: center;width:18%">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:18%">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:18%">&nbsp;Nama&nbsp;Supplier&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;Nopol&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;Tanggal&nbsp;PO&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;Penerima&nbsp;Timbangan&nbsp;Awal&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;Timbangan&nbsp;Awal&nbsp;</th>
                                        <th style="text-align: center;width:20%">&nbsp;Status&nbsp;</th>
                                    </tr>>
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
                                        <th style="text-align: center;width:18%">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:18%">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:18%">&nbsp;Nama&nbsp;Supplier&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <!--<th style="text-align: center;width:18%">Vendor</th>-->
                                        <th style="text-align: center;width:18%">&nbsp;Tanggal&nbsp;PO&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;Penerima&nbsp;Timbangan&nbsp;Awal&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;Timbangan&nbsp;Awal&nbsp;</th>
                                        <th style="text-align: center;width:20%">&nbsp;Status&nbsp;</th>
                                    </tr>>
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
                                        <th style="text-align: center;width:18%">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:18%">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:18%">&nbsp;Nama&nbsp;Supplier&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <!--<th style="text-align: center;width:18%">Vendor</th>-->
                                        <th style="text-align: center;width:18%">&nbsp;Tanggal&nbsp;PO&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;Penerima&nbsp;Timbangan&nbsp;Awal&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;Timbangan&nbsp;Awal&nbsp;</th>
                                        <th style="text-align: center;width:20%">&nbsp;Status&nbsp;</th>
                                    </tr>>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_4" role="tabpanel">
                            <table class="table table-bordered" id="datatable1">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <!--<th style="text-align: center;width:18%">Vendor</th>-->
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;Penerima&nbsp;Timbangan&nbsp;Awal&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;Timbangan&nbsp;Awal&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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

<script>
    $(function() {
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
            ajax: "{{ route('timbangan.data_timbangan_awal_gb_longgrain_index') }}",
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
                    data: 'plat_kendaraan'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'penerima_tonase_awal'
                },
                {
                    data: 'tonase_awal'
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
        //     ajax: "{{ route('timbangan.data_timbangan_awal_gb_ciherang_index') }}",
        //     columns: [{
        //             data: "id_admin_timbangan",

        //             render: function(data, type, row, meta) {
        //                 return meta.row + meta.settings._iDisplayStart + 1;
        //             }
        //         },
        //         {
        //             data: 'name_bid'
        //         },
        //         {
        //             data: 'kode_po'
        //         },
        //         {
        //             data: 'nama_vendor'
        //         },
        //         {
        //             data: 'plat_kendaraan'
        //         },
        //         {
        //             data: 'tanggal_po'
        //         },
        //         {
        //             data: 'penerima_tonase_awal'
        //         },
        //         {
        //             data: 'tonase_awal'
        //         },
        //         {
        //             data: 'ckelola'
        //         },
        //     ],
        //     createdRow: function(row, data, index) {

        //         // Updated Schedule Week 1 - 07 Mar 22

        //         if (data.name_bid == 'GABAH BASAH CIHERANG') {
        //             $('td:eq(1)', row).css('color', '#000099'); //Original Date
        //         } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
        //             $('td:eq(1)', row).css('color', '#009900'); // Behind of Original Date
        //         } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
        //             $('td:eq(1)', row).css('color', '#330019'); // Behind of Original Date
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
            ajax: "{{ route('timbangan.data_timbangan_awal_gb_pandan_wangi_index') }}",
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
                    data: 'plat_kendaraan'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'penerima_tonase_awal'
                },
                {
                    data: 'tonase_awal'
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
            ajax: "{{ route('timbangan.data_timbangan_awal_gb_ketan_putih_index') }}",
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
                    data: 'plat_kendaraan'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'penerima_tonase_awal'
                },
                {
                    data: 'tonase_awal'
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
            ajax: "{{ route('timbangan.data_timbangan_awal_pk_index') }}",
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
                    data: 'plat_kendaraan'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'penerima_tonase_awal'
                },
                {
                    data: 'tonase_awal'
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
    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '.to_show', function() {
            var id = $(this).attr("name");
            var url = "{{ route('timbangan.show_timbangan_awal') }}" + "/" + id;
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