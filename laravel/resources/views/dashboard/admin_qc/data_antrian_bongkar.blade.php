@extends('dashboard.admin_qc.layout.main')
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
                        <i class="kt-menu__link-icon flaticon2-delivery-truck kt-font-dark"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data Antrian Bongkar
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
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_5"><i class="la la-database"></i>BERAS PK</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
                            <table class="table table-bordered" id="data_longgrain">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:18%">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">Jam&nbsp;Kedatangan</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">Tanggal&nbsp;PO </th>
                                        <th style="text-align: center;width:18%">Nopol&nbsp;Kendaraan</th>
                                        <th style="text-align: center;width:18%">Antrian</th>
                                        <th style="text-align: center;width:20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">Jam&nbsp;Kedatangan</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">Tanggal&nbsp;PO </th>
                                        <th style="text-align: center;width:18%">Nopol&nbsp;Kendaraan</th>
                                        <th style="text-align: center;width:18%">Antrian</th>
                                        <th style="text-align: center;width:20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">Jam&nbsp;Kedatangan</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">Tanggal&nbsp;PO </th>
                                        <th style="text-align: center;width:18%">Nopol&nbsp;Kendaraan</th>
                                        <th style="text-align: center;width:18%">Antrian</th>
                                        <th style="text-align: center;width:20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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
                                        <th style="text-align: center;width:2%">&nbsp;No&nbsp;</th>
                                        <th style="text-align: center;width:18%">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">Jam&nbsp;Kedatangan</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">Nopol&nbsp;Kendaraan</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;Antrian&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_5" role="tabpanel">
                            <table class="table table-bordered" id="data_pk">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">&nbsp;No&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">Jam&nbsp;Kedatangan</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">Nopol&nbsp;Kendaraan</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;Antrian&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:18%">&nbsp;&nbsp;Lokasi&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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
                    <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{route('timbangan.terima_tonase_awal')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Input Initial Tonnage</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_penerimaan_po" id="id_penerimaan_po" value="">
                            <input type="hidden" name="penerimaan_id_data_po" id="id_data_po" value="">
                            <input type="hidden" id="bid_user" name="penerimaan_id_bid_user">
                            <div class="form-group">
                                <div class="">
                                    <label>Receiving Scales</label>
                                    <input readonly value="{{Auth::user()->name_admin_timbanagan}}" type="text" class="form-control m-input">
                                    <input type="hidden" name="penerima_tonase_awal" value="{{Auth::user()->id_admin_timbangan }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Reception Time</label>
                                    <input id="harga" name="waktu_penerimaan" readonly value="{{date('Y-m-d H:i:s')}}" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Code PO</label>
                                    <input id="kode_po_timbangan" readonly name="penerimaan_kode_po" type="text" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Plate</label>
                                    <input name="plat_kendaraan" readonly id="plat_kendaraan" type="text" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Weight (Kg)</label>
                                    <input name="tonase_awal" required type="number" class="form-control m-input">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success m-btn pull-right">Save</button>
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
        //     ajax: "{{ route('qc.lab.data_antrian_bongkar_ciherang_index') }}",
        //     columns: [{
        //             data: "id_admin_qc_bongkar",

        //             render: function(data, type, row, meta) {
        //                 return meta.row + meta.settings._iDisplayStart + 1;
        //             }
        //         },
        //         {
        //             data: 'name_bid'
        //         },
        //         {
        //             data: 'nama_vendor'
        //         },
        //         {
        //             data: 'waktu_penerimaan'
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
        //             data: 'antrian'
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
            ajax: "{{ route('qc.lab.data_antrian_bongkar_pandan_wangi_index') }}",
            columns: [{
                    data: "id_admin_qc_bongkar",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name_bid'
                },
                {
                    data: 'nama_vendor'
                },
                {
                    data: 'waktu_penerimaan'
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
                    data: 'antrian'
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
            ajax: "{{ route('qc.lab.data_antrian_bongkar_ketan_putih_index') }}",
            columns: [{
                    data: "id_admin_qc_bongkar",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name_bid'
                },
                {
                    data: 'nama_vendor'
                },
                {
                    data: 'waktu_penerimaan'
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
                    data: 'antrian'
                },
                {
                    data: 'ckelola'
                },

            ],
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table3.columns.adjust().draw().responsive.recalc();
        })
        var table4 = $('#data_pk').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('qc.lab.data_antrian_bongkar_pk_index') }}",
            columns: [{
                    data: "id_admin_qc_bongkar",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'nama_vendor'
                },
                {
                    data: 'waktu_penerimaan'
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
                    data: 'antrian'
                },
                {
                    data: 'lokasi_bongkar'
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
        var table5 = $('#data_longgrain').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('qc.lab.data_antrian_bongkar_longgrain_index') }}",
            columns: [{
                    data: "id_admin_qc_bongkar",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name_bid'
                },
                {
                    data: 'nama_vendor'
                },
                {
                    data: 'waktu_penerimaan'
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
                    data: 'antrian'
                },
                {
                    data: 'ckelola'
                },

            ],
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table5.columns.adjust().draw().responsive.recalc();
        })
    });
</script>
<script type="text/javascript">
    $(function() {
        $('body').on('click', '#btn_panggil_gb', function() {
            var cek = $(this).data('id');
            console.log(cek);
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Anda Akan Memanggil Truk Tersebut",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{route('qc.lab.data_antrian_bongkar_panggil_gb')}}/" + cek,
                        type: "GET",
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'success',
                                text: 'Truk Berhasil Dipanggil',
                                icon: 'success',
                                timer: 1500
                            })
                            $('#count_antrian').load('#count_antrian')
                            $('#data_ciherang').DataTable().ajax.reload();
                            $('#data_pw').DataTable().ajax.reload();
                            $('#data_kp').DataTable().ajax.reload();
                            $('#data_pk').DataTable().ajax.reload();
                            $('#data_longgrain').DataTable().ajax.reload();
                        }
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });

        });
        $('body').on('click', '#btn_panggil_pk', function() {
            var cek = $(this).data('id');
            console.log(cek);
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Anda Akan Memanggil Truk Tersebut",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{route('qc.lab.data_antrian_bongkar_panggil_pk')}}/" + cek,
                        type: "GET",
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'success',
                                text: 'Truk Berhasil Dipanggil',
                                icon: 'success',
                                timer: 1500
                            })
                            $('#data_ciherang').DataTable().ajax.reload();
                            $('#data_pw').DataTable().ajax.reload();
                            $('#data_kp').DataTable().ajax.reload();
                            $('#data_pk').DataTable().ajax.reload();
                            $('#data_longgrain').DataTable().ajax.reload();
                        }
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });

        });
        $('body').on('click', '#btn_panggil1', function() {
            Swal.fire({
                title: 'Info',
                text: "Panggil Truk Sesuai Nomor Urut Atrian",
                icon: 'warning',
                timer: 1500
            })

        });
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