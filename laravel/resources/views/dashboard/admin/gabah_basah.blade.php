@extends('dashboard.admin.layout.main')
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
                            <i class="flaticon-user"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Gabah Basah
                        </h3>
                    </div>
                </div>
                <div class="">
                    <div class="kt-portlet__head-label">
                        <div class="m-portlet__body">
                            <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item mt-3">
                                    <a class="nav-link" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-database"></i>PO Kemaren (Terlambat)</a>
                                </li>
                                <li class="nav-item mt-3">
                                    <a class="nav-link active" data-toggle="tab" href="#m_tabs_3_2"><i class="la la-database"></i>PO Hari Ini ( <?php echo date('d-m-Y'); ?> )</a>
                                </li>
                                <li class="nav-item mt-3">
                                    <a class="nav-link" data-toggle="tab" href="#m_tabs_3_3"><i class="la la-database"></i>PO Besok ( <?php echo date('d-m-Y', strtotime("+1 days")); ?> )</a>
                                </li>
                            </ul>
                            <!-- <button class="btn btn-info" id="btn_scan"><i class="fa fa-barcode"></i>SCAN BARCODE PENERIMAAN</button> -->
                            <div class="tab-content">
                                <div class="tab-pane" id="m_tabs_3_1" role="tabpanel">
                                    <div class="kt-portlet__body col-12">
                                        <table class="table table-bordered" id="po_kemarin" style="overflow-x:auto;">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;width:2%">No</th>
                                                    <th style="text-align: center;width:18%">Nama&nbsp;Item</th>
                                                    <th style="text-align: center;width:18%">Kode&nbsp;PO</th>
                                                    <th style="text-align: center;width:18%">Tanggal&nbsp;PO </th>
                                                    <th style="text-align: center;width:18%">Mulai&nbsp;Penerimaan </th>
                                                    <th style="text-align: center;width:16%">Batas&nbsp;Penerimaan</th>
                                                    <th style="text-align: center;width:20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: center">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane active" id="m_tabs_3_2" role="tabpanel">
                                    <div class="kt-portlet__body col-12">
                                        <table class="table table-bordered" id="datatable_sekarang">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;width:2%">No</th>
                                                    <th style="text-align: center;width:18%">Nama&nbsp;Item</th>
                                                    <th style="text-align: center;width:18%">Kode&nbsp;PO</th>
                                                    <th style="text-align: center;width:18%">Tanggal&nbsp;PO </th>
                                                    <th style="text-align: center;width:18%">Mulai&nbsp;Penerimaan </th>
                                                    <th style="text-align: center;width:16%">Batas&nbsp;Penerimaan</th>
                                                    <th style="text-align: center;width:20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: center">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
                                    <div class="kt-portlet__body col-12" style="overflow-x:auto;">
                                        <table class="table table-bordered" id="data_po">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;width:2%">No</th>
                                                    <th style="text-align: center;width:18%">Nama&nbsp;Item</th>
                                                    <th style="text-align: center;width:18%">Kode&nbsp;PO</th>
                                                    <th style="text-align: center;width:18%">Tanggal&nbsp;PO </th>
                                                    <th style="text-align: center;width:18%">Mulai&nbsp;Penerimaan </th>
                                                    <th style="text-align: center;width:16%">Batas&nbsp;Penerimaan</th>
                                                    <th style="text-align: center;width:20%">Action</th>
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
            </div>
        </div>
    </div>

    <!-- end:: Content -->
</div>

<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form_terimadatapo" class="m-form m-form--fit m-form--label-align-right" method="post" action="javascript:void(0);" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Terima Data PO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="penerimaan_id_data_po" id="penerimaan_id_data_po" value="">
                    <input type="hidden" id="penerimaan_id_bid_user" name="penerimaan_id_bid_user">
                    <input type="hidden" id="tanggal_po" name="tanggal_po" value="">
                    <input type="hidden" id="ponum" name="ponum">
                    <input type="hidden" id="nama_item" name="nama_item">
                    <div class="form-group">
                        <div class="">
                            <label>Penerima PO</label>
                            <input id="name_bid" readonly value="{{Auth::user()->name}}" type="text" class="form-control m-input">
                            <input type="hidden" required name="penerima_po" id="penerima_po" value="{{Auth::user()->id}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Waktu Kedatangan</label>
                            <input id="waktu_penerimaan" required name="waktu_penerimaan" readonly value="{{date('Y-m-d H:i:s')}}" class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Kode PO</label>
                            <input id="penerimaan_kode_po" required name="penerimaan_kode_po" type="text" readonly class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Nopol</label>
                            <input name="plat_kendaraan" style="text-transform:uppercase;" required placeholder="A 1234 B" maxlength="10" id="plat_kendaraan" type="text" class="form-control m-input">
                            <span class="btn btn-label-info btn-sm "><i class="flaticon2-information"></i> Pastikan Nopol Terisi Dengan Benar</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Asal Gabah</label>
                            <input id="keterangan_penerimaan_po" name="keterangan_penerimaan_po" placeholder="Asal Gabah" required type="text" class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label for="">Status</label><br>
                            <input type="radio" required name="status_penerimaan" id="status_penerimaan" checked="checked" value="3">
                            <label for="age2">PARKIR</label>
                            <input type="radio" required disabled name="status_penerimaan" id="status_penerimaan" value="5">
                            <label for="age2">TIDAK</label>
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

<div class="modal fade" id="modal_po_ditolak" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form_poTerlambat" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{route('security.terima_data_po_telat')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tolak PO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="penerimaan_id_data_po" id="id_data_po_tolak" value="">
                    <input type="hidden" id="bid_user_tolak" name="penerimaan_id_bid_user">
                    <input type="hidden" id="PONum" name="PONum">
                    <input type="hidden" id="nama_item3" name="nama_item">
                    <div class="form-group">
                        <div class="">
                            <label>Penerima PO</label>
                            <input id="name_bid" readonly value="{{Auth::user()->name}}" type="text" class="form-control m-input">
                            <input type="hidden" name="penerima_po" value="{{Auth::user()->id}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Waktu Kedatangan</label>
                            <input id="harga" name="waktu_penerimaan" readonly value="{{date('Y-m-d H:i:s')}}" class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Kode PO</label>
                            <input id="kode_po_tolak" name="penerimaan_kode_po" type="text" readonly class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Nopol</label>
                            <input name="plat_kendaraan" id="plat_kendaraan" style="text-transform:uppercase;" required type="text" maxlength="10" class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Asal Gabah</label>
                            <input name="keterangan_penerimaan_po" required type="text" class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label for="">Status</label><br>
                            <input type="radio" disabled required name="status_penerimaan" value="3">
                            <label for="age2">PARKIR</label>
                            <input type="radio" required checked="checked" name="status_penerimaan" value="5">
                            <label for="age2">TIDAK</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Tutup</button>
                    <button id="btn_save1" type="submit" class="btn btn-success m-btn pull-right">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_po_diterima" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{route('security.terima_data_po')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Terima PO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="penerimaan_id_data_po" id="id_data_po_kemarin" value="">
                    <input type="hidden" id="bid_user_kemarin" name="penerimaan_id_bid_user">
                    <input type="hidden" id="tanggal_po" name="tanggal_po" value="">
                    <input type="hidden" id="ponum" name="ponum">
                    <input type="hidden" id="nama_item1" name="nama_item">
                    <div class="form-group">
                        <div class="">
                            <label>Penerima PO</label>
                            <input id="name_bid" readonly value="{{Auth::user()->name}}" type="text" class="form-control m-input">
                            <input type="hidden" name="penerima_po" value="{{Auth::user()->id}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Waktu Kedatangan</label>
                            <input id="harga" name="waktu_penerimaan" readonly value="{{date('Y-m-d H:i:s')}}" class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Kode PO</label>
                            <input id="kode_po_kemarin" name="penerimaan_kode_po" type="text" readonly class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Nopol</label>
                            <input name="plat_kendaraan" id="plat_kendaraan" style="text-transform:uppercase;" required type="text" maxlength="10" class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Keterangan</label>
                            <input name="keterangan_penerimaan_po" id="keterangan_penerimaan_po" required type="text" class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label for="">Status</label><br>
                            <input type="radio" checked="checked" required name="status_penerimaan" value="3">
                            <label for="age2">Parkir</label>
                            <input type="radio" disabled name="status_penerimaan" value="5">
                            <label for="age2">Tidak Parkir</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success m-btn pull-right">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_scan_barcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form_scanbarcode" class="m-form m-form--fit m-form--label-align-right" method="post" action="javascript:void(0);" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="modal-header">
                    <h5 class="modal-title mx-auto d-block" id="exampleModalLongTitle">SCAN BARCODE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid mx-auto d-block" src="{{asset('barcode-scanner.png')}}" alt="" width="200px" height="200px">
                    <div class="form-group">
                        <div class="">
                            <label for="kode_po">Letakkan Cursor <i class="fa fa-mouse-pointer"></i> Di Bawah Ini</label>
                            <input id="kode_po" value="" name="kode_po" type="text" class="form-control m-input" autofocus />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="btn_scanning" class="btn btn-success m-btn pull-right">Search <i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).on('keypress', '#plat_kendaraan', function(e) {
        var val = $(this).val();
        var regex = /^[0-9a-zA-Z _]+$/;
        if (regex.test(val + String.fromCharCode(e.charCode))) {
            return true;
        }
        return false;
    });
    $(function() {
        var table1 = $('#po_kemarin').DataTable({
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
            ajax: "{{ route('security.gabahbasah_index_kemarin') }}",
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
                    data: 'kode_po'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'mulai_penerimaan'
                },
                {
                    data: 'batas_bid'
                },
                {
                    data: 'ckelola'
                }

            ],
            createdRow: function(row, data, index) {

                // Updated Schedule Week 1 - 07 Mar 22

                if (data.name_bid == 'GABAH BASAH CIHERANG') {
                    $('td:eq(1)', row).css('background-color', '#CCE5FF'); //Original Date
                } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                    $('td:eq(1)', row).css('background-color', '#CCFFCC'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                    $('td:eq(1)', row).css('background-color', '#D5D5D5'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                    $('td:eq(1)', row).css('color', '#6666FF'); // Behind of Original Date
                }
            },
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table1.columns.adjust().draw().responsive.recalc();
        })
        var table2 = $('#datatable_sekarang').DataTable({
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
            ajax: "{{ route('security.gabahbasah_index_sekarang') }}",
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
                    data: 'kode_po'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'mulai_penerimaan'
                },
                {
                    data: 'batas_bid'
                },
                {
                    data: 'ckelola'
                }

            ],
            createdRow: function(row, data, index) {

                // Updated Schedule Week 1 - 07 Mar 22

                if (data.name_bid == 'GABAH BASAH CIHERANG') {
                    $('td:eq(1)', row).css('background-color', '#CCE5FF'); //Original Date
                } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                    $('td:eq(1)', row).css('background-color', '#CCFFCC'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                    $('td:eq(1)', row).css('background-color', '#D5D5D5'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                    $('td:eq(1)', row).css('color', '#6666FF'); // Behind of Original Date
                }
            },
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table2.columns.adjust().draw().responsive.recalc();
        })
        var table3 = $('#data_po').DataTable({
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
            ajax: "{{ route('security.gabahbasah_index_besok') }}",
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
                    data: 'kode_po'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'mulai_penerimaan'
                },
                {
                    data: 'batas_bid'
                },
                {
                    data: 'ckelola'
                }

            ],
            createdRow: function(row, data, index) {

                // Updated Schedule Week 1 - 07 Mar 22

                if (data.name_bid == 'GABAH BASAH CIHERANG') {
                    $('td:eq(1)', row).css('background-color', '#CCE5FF'); //Original Date
                } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                    $('td:eq(1)', row).css('background-color', '#CCFFCC'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                    $('td:eq(1)', row).css('background-color', '#D5D5D5'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                    $('td:eq(1)', row).css('color', '#6666FF'); // Behind of Original Date
                }
            },
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table3.columns.adjust().draw().responsive.recalc();
        })
    });
</script>

<script type="text/javascript">
    $(function() {
        $(document).on('click', '.toedit', function() {
            var id = $(this).attr("name");
            var url = "{{ route('security.show.penerimaan_po') }}" + "/" + id;
            // console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    // console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#penerimaan_id_data_po').val(parsed.id_data_po);
                    $('#penerimaan_kode_po').val(parsed.kode_po);
                    $('#penerimaan_id_bid_user').val(parsed.bid_user_id);
                    $('#plat_kendaraan').val(parsed.plat_kendaraan);
                    $('#tanggal_po').val(parsed.tanggal_po);
                    $('#ponum').val(parsed.PONum);
                    $('#nama_item').val(parsed.name_bid);
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(function() {

        $(document).on('click', '#btn_save1', function(e) {
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
                    Swal.fire({
                        title: 'Harap Tuggu Sebentar!',
                        html: 'Data Sedang Diproses...', // add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });
                    $('#form_poTerlambat').submit();
                    Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '#btn_save', function(e) {
            e.preventDefault();
            $('#btn_save').html('Menyimpan...');
            var penerimaan_kode_po = $('#penerimaan_kode_po').val();
            var tanggal_po = $('#tanggal_po').val();
            var nama_item = $('#nama_item').val();
            var penerimaan_id_bid_user = $('#penerimaan_id_bid_user').val();
            var penerimaan_id_data_po = $('#penerimaan_id_data_po').val();
            var penerima_po = $('#penerima_po').val();
            var keterangan_penerimaan_po = $('#keterangan_penerimaan_po').val();
            var plat_kendaraan = $('#plat_kendaraan').val();
            var status_penerimaan = $('#status_penerimaan').val();
            var ponum = $('#ponum').val();
            Swal.fire({
                title: 'Konfirmasi',
                icon: 'warning',
                text: "Apakah data yang kamu input sudah benar ?",
                showCancelButton: true,
                inputValue: 0,
                confirmButtonText: 'Yes',
            }).then(function(result) {
                if ($('#plat_kendaraan').val() == '' | $('#keterangan_penerimaan_po').val() == '') {
                    $("#form_terimadatapo").trigger('reset');
                    $('#btn_save').html('Simpan');
                    Swal.fire({
                        title: 'Info !!',
                        text: 'Data Harus Terisi Semua',
                        icon: 'warning',
                        timer: 1500
                    })
                } else {
                    if (result.value) {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Proses Menyimpan Data...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                                $.ajax({
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        penerimaan_kode_po: penerimaan_kode_po,
                                        tanggal_po: tanggal_po,
                                        nama_item: nama_item,
                                        penerimaan_id_bid_user: penerimaan_id_bid_user,
                                        penerimaan_id_data_po: penerimaan_id_data_po,
                                        penerima_po: penerima_po,
                                        keterangan_penerimaan_po: keterangan_penerimaan_po,
                                        plat_kendaraan: plat_kendaraan,
                                        status_penerimaan: status_penerimaan,
                                        ponum: ponum,
                                    },
                                    url: "{{route('security.terima_data_po')}}",
                                    type: "POST",
                                    dataType: 'json',
                                    success: function(data) {
                                        $('#po_kemarin').DataTable().ajax.reload();
                                        $('#datatable_sekarang').DataTable().ajax.reload();
                                        $('#data_po').DataTable().ajax.reload();
                                        $("#form_terimadatapo").trigger('reset');
                                        $('#btn_save').html('Simpan');
                                        $('#modal2').modal('hide');
                                        Swal.fire({
                                            title: 'success',
                                            text: 'Data Berhasil DiSimpan',
                                            icon: 'success',
                                            timer: 1500
                                        })

                                    },
                                    error: function(data) {
                                        $("#form_terimadatapo").trigger('reset');
                                        $('#btn_save').html('Simpan');
                                        $('#modal2').modal('hide');
                                        Swal.fire({
                                            title: 'Gagal',
                                            text: 'Data Tidak Tersimpan ',
                                            icon: 'error',
                                            timer: 1500
                                        })

                                    }
                                });
                            },
                        });

                    } else {
                        $("#form_terimadatapo").trigger('reset');
                        $('#btn_save').html('Simpan');
                        Swal.fire({
                            title: 'Gagal !',
                            text: 'Data anda Tidak di Simpan.',
                            icon: 'warning',
                            timer: 1500
                        })
                    }
                }
            });
        });
        $(document).on('click', '#btn_scanning', function(e) {
            e.preventDefault();
            $('#btn_scanning').html('Menyimpan...');
            var kode_po = $('#kode_po').val();
            Swal.fire({
                title: 'Harap Tuggu Sebentar!',
                html: 'Proses Menyimpan Data...', // add html attribute if you want or remove
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    $.ajax({
                        data: {
                            "_token": "{{ csrf_token() }}",
                            kode_po: kode_po,
                        },
                        url: "{{route('security.generate')}}",
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {
                            // console.log(data);
                            $('#po_kemarin').DataTable().ajax.reload();
                            $('#datatable_sekarang').DataTable().ajax.reload();
                            $('#data_po').DataTable().ajax.reload();
                            $("#form_scanbarcode").trigger('reset');
                            $('#btn_scanning').html('Scan');
                            $('#modal_scan_barcode').modal('hide');
                            if (data == 'close') {
                                Swal.fire({
                                    title: 'Maaf',
                                    text: 'PO sudah Close',
                                    icon: 'error',
                                    timer: 1500
                                })
                            } else if (data == 'exits') {
                                Swal.fire({
                                    title: 'Maaf',
                                    text: 'PO sudah Dalam Penerimaan',
                                    icon: 'error',
                                    timer: 1500
                                })

                            } else {
                                Swal.fire({
                                    title: 'success',
                                    text: 'Data Berhasil DiSimpan',
                                    icon: 'success',
                                    timer: 1500
                                })

                            }

                        },
                        error: function(data) {
                            $("#form_scanbarcode").trigger('reset');
                            $('#btn_scanning').html('Scan');
                            $('#modal_scan_barcode').modal('hide');
                            Swal.fire({
                                title: 'Gagal',
                                text: 'Data Tidak Tersimpan ',
                                icon: 'error',
                                timer: 1500
                            })

                        }
                    });
                },
            });
        });

        $(document).on('click', '.toterima', function() {
            var id = $(this).attr("name");
            var url = "{{ route('security.show.penerimaan_po') }}" + "/" + id;
            // console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    // console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_data_po_kemarin').val(parsed.id_data_po);
                    $('#kode_po_kemarin').val(parsed.kode_po);
                    $('#bid_user_kemarin').val(parsed.bid_user_id);
                    $('#plat_kendaraan_kemarin').val(parsed.plat_kendaraan);
                    $('#tanggal_po').val(parsed.tanggal_po);
                    $('#nama_item1').val(parsed.name_bid);
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(function() {
        $(document).on('click', '#btn_scan', function() {
            $('#modal_scan_barcode').modal('show');
        });
        $(document).on('click', '.totolak', function() {
            var id = $(this).attr("name");
            var url = "{{ route('security.show.penerimaan_po') }}" + "/" + id;
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    var parsed = $.parseJSON(response);
                    $('#id_data_po_tolak').val(parsed.id_data_po);
                    $('#kode_po_tolak').val(parsed.kode_po);
                    $('#bid_user_tolak').val(parsed.bid_user_id);
                    $('#PONum').val(parsed.PONum);
                    $('#nama_item3').val(parsed.name_bid);

                }
            });
        });
    });
</script>

<script>
</script>
@endsection