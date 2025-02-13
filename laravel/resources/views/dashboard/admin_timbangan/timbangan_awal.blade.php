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
                        Timbangan Masuk
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
                            Tonase Awal
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
                                        <th style="text-align: center;width:18%">Nama&nbsp;Supplier</th>
                                        <th style="text-align: center;width:18%">Tanggal&nbsp;PO</th>
                                        <!--<th style="text-align: center;width:18%">Vendor</th>-->
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;Sampai&nbsp;Disatpam&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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
                                        <th style="text-align: center;width:18%">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:18%">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:18%">Nama&nbsp;Supplier</th>
                                        <th style="text-align: center;width:18%">Tanggal&nbsp;PO</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;Sampai&nbsp;Disatpam&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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
                                        <th style="text-align: center;width:18%">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:18%">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:18%">Nama&nbsp;Supplier</th>
                                        <th style="text-align: center;width:18%">Tanggal&nbsp;PO</th>
                                        <!--<th style="text-align: center;width:18%">Vendor</th>-->
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;Sampai&nbsp;Disatpam&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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
                                        <th style="text-align: center;width:18%">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:18%">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:18%">Nama&nbsp;Supplier</th>
                                        <th style="text-align: center;width:18%">Tanggal&nbsp;PO</th>
                                        <!--<th style="text-align: center;width:18%">Vendor</th>-->
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;Sampai&nbsp;Disatpam&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <!--<th style="text-align: center;width:18%">Vendor</th>-->
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;Sampai&nbsp;Disatpam&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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

        <div class="modal fade" id="modal_tonaseawal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="formtimbangan_awal" class="m-form m-form--fit m-form--label-align-right" method="post" action="javascript:void(0)" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Input Tonase Awal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_penerimaan_po" id="id_penerimaan_po" value="">
                            <input type="hidden" name="penerimaan_id_data_po" id="penerimaan_id_data_po" value="">
                            <input type="hidden" id="penerimaan_id_bid_user" name="penerimaan_id_bid_user">
                            <div class="form-group">
                                <div class="">
                                    <label>Penerima Timbangan</label>
                                    <input readonly value="{{Auth::user()->name_admin_timbangan}}" type="text" class="form-control m-input">
                                    <input type="hidden" name="penerima_tonase_awal" id="penerima_tonase_awal" value="{{Auth::user()->id_admin_timbangan }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <input id="waktu_penerimaan" type="hidden" name="waktu_penerimaan" readonly value="{{date('Y-m-d H:i:s')}}" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Tanggal Masuk </label>
                                    <input name="tanggal_masuk" id="tanggal_masuk" readonly value="{{date('Y-m-d')}}" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Jam Masuk</label>
                                    <input id="jam_masuk" name="jam_masuk" readonly value="{{date('H:i:s')}}" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Nama Item</label>
                                    <input id="name_bid" readonly name="name_bid" type="text" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Kode PO</label>
                                    <input id="penerimaan_kode_po" readonly name="penerimaan_kode_po" type="text" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Nopol Kendaraan</label>
                                    <input name="plat_kendaraan" id="plat_kendaraan" style="text-transform:uppercase;" type="text" class="form-control m-input">
                                    <span class="btn btn-label-info btn-sm "><i class="flaticon2-information"></i> Edit Jika Nopol Salah</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Asal Gabah</label>
                                    <input name="asal_gabah" readonly id="asal_gabah" type="text" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Berat (Kg)</label>
                                    <input id="tonase_awal" name="tonase_awal" required type="text" class="form-control m-input">
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
            ajax: "{{ route('timbangan.timbangan_awal_gb_longgrain_index') }}",
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
                    data: 'open_po'
                },
                {
                    data: 'plat_kendaraan'
                },
                {
                    data: 'waktu_penerimaan'
                },
                {
                    data: 'ckelola'
                }

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
        //     ajax: "{{ route('timbangan.timbangan_awal_gb_ciherang_index') }}",
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
        //             data: 'open_po'
        //         },
        //         {
        //             data: 'plat_kendaraan'
        //         },
        //         {
        //             data: 'waktu_penerimaan'
        //         },
        //         {
        //             data: 'ckelola'
        //         }

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
            ajax: "{{ route('timbangan.timbangan_awal_gb_pandan_wangi_index') }}",
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
                    data: 'open_po'
                },
                {
                    data: 'plat_kendaraan'
                },
                {
                    data: 'waktu_penerimaan'
                },
                {
                    data: 'ckelola'
                }

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
            ajax: "{{ route('timbangan.timbangan_awal_gb_ketan_putih_index') }}",
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
                    data: 'open_po'
                },
                {
                    data: 'plat_kendaraan'
                },
                {
                    data: 'waktu_penerimaan'
                },
                {
                    data: 'ckelola'
                }

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
    });
</script>
<script>
    $(function() {
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
            ajax: "{{ route('timbangan.timbangan_awal_pk_index') }}",
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
                    data: 'open_po'
                },
                {
                    data: 'plat_kendaraan'
                },
                {
                    data: 'waktu_penerimaan'
                },
                {
                    data: 'ckelola'
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
            var tonase_awal = replace_titik($('#tonase_awal').val());
            var id_penerimaan_po = $('#id_penerimaan_po').val();
            var penerimaan_kode_po = $('#penerimaan_kode_po').val();
            var penerima_tonase_awal = $('#penerima_tonase_awal').val();
            var plat_kendaraan = $('#plat_kendaraan').val();
            var asal_gabah = $('#asal_gabah').val();
            var tanggal_masuk = $('#tanggal_masuk').val();
            var jam_masuk = $('#jam_masuk').val();
            var penerimaan_id_data_po = $('#penerimaan_id_data_po').val();
            var name_bid = $('#name_bid').val();
            $('#btn_save').html('Menyimpan...');
            // console.log(input);
            Swal.fire({
                title: 'Konfirmasi',
                icon: 'warning',
                text: "Apakah data yang kamu input sudah benar ?",
                showCancelButton: true,
                inputValue: 0,
                confirmButtonText: 'Yes',
            }).then(function(result) {
                if (result.value) {
                    if ($('#tonase_awal').val() == '' || $('#tonase_awal').val() == 'NULL') {
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
                                        tonase_awal: tonase_awal,
                                        id_penerimaan_po: id_penerimaan_po,
                                        penerimaan_kode_po: penerimaan_kode_po,
                                        penerima_tonase_awal: penerima_tonase_awal,
                                        plat_kendaraan: plat_kendaraan,
                                        asal_gabah: asal_gabah,
                                        tanggal_masuk: tanggal_masuk,
                                        jam_masuk: jam_masuk,
                                        penerimaan_id_data_po: penerimaan_id_data_po,
                                        name_bid: name_bid,
                                    },
                                    url: "{{route('timbangan.terima_tonase_awal')}}",
                                    type: "POST",
                                    dataType: 'json',
                                    success: function(data) {
                                        $('#data_longgrain').DataTable().ajax.reload();
                                        $('#data_pw').DataTable().ajax.reload();
                                        $('#data_kp').DataTable().ajax.reload();
                                        $('#datatable1').DataTable().ajax.reload();
                                        $("#formtimbangan_awal").trigger('reset');
                                        $('#btn_save').html('Simpan');
                                        $('#modal_tonaseawal').modal('hide');
                                        Swal.fire({
                                            title: 'success',
                                            text: 'Data Berhasil Disimpan.',
                                            icon: 'success',
                                            timer: 1500
                                        })

                                    },
                                    error: function(data) {
                                        $("#formtimbangan_awal").trigger('reset');
                                        $('#btn_save').html('Simpan');
                                        $('#modal_tonaseawal').modal('hide');
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
                } else {
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
            // console.log(id);
            var url = "{{ route('timbangan.show_timbangan_awal') }}" + "/" + id;
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    // console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_penerimaan_po').val(parsed.id_penerimaan_po);
                    $('#penerimaan_id_data_po').val(parsed.id_data_po);
                    $('#penerimaan_kode_po').val(parsed.kode_po);
                    $('#bid_user').val(parsed.bid_user_id);
                    $('#name_bid').val(parsed.name_bid);
                    $('#plat_kendaraan').val(parsed.plat_kendaraan);
                    $('#asal_gabah').val(parsed.keterangan_penerimaan_po);
                }
            });
        });
        $(document).on('keyup', '#tonase_awal', function(e) {
            var data = $(this).val();
            var hasil = formatRupiah(data, "Rp. ");
            $(this).val(hasil);
        });
    });

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }

    function replace_titik(x) {
        return ((x.replace('.', '')).replace('.', '')).replace('.', '');
    }
</script>
@endsection