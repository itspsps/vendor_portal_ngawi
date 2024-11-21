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
                            <i class="kt-menu__link-icon flaticon2-sheet kt-font-warning"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data Revisi
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item mt-3">
                            <a class="nav-link active" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-database"></i>GB lONG GRAIN</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_3"><i class="la la-database"></i>GB PANDAN WANGI</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_4"><i class="la la-database"></i>GB KETAN PUTIH</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
                            <table class="table table-bordered" id="data_longgrain">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Supplier</th>
                                        <th style="text-align: center;width:auto">Surveyor</th>
                                        <th style="text-align: center;width:auto">No.&nbsp;DTM</th>
                                        <th style="text-align: center;width:auto">Keterangan&nbsp;Bongkar</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;Bongkar</th>
                                        <th style="text-align: center;width:auto">Waktu&nbsp;Bongkar</th>
                                        <th style="text-align: center;width:auto">Tempat&nbsp;Bongkar</th>
                                        <th style="text-align: center;width:auto">Karung&nbsp;Dibawa</th>
                                        <th style="text-align: center;width:auto">Karung&nbsp;Ditolak</th>
                                        <th style="text-align: center;width:auto">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
                            <table class="table table-bordered" id="data_pw">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Supplier</th>
                                        <th style="text-align: center;width:auto">Surveyor</th>
                                        <th style="text-align: center;width:auto">No.&nbsp;DTM</th>
                                        <th style="text-align: center;width:auto">Keterangan&nbsp;Bongkar</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;Bongkar</th>
                                        <th style="text-align: center;width:auto">Waktu&nbsp;Bongkar</th>
                                        <th style="text-align: center;width:auto">Tempat&nbsp;Bongkar</th>
                                        <th style="text-align: center;width:auto">Karung&nbsp;Dibawa</th>
                                        <th style="text-align: center;width:auto">Karung&nbsp;Ditolak</th>
                                        <th style="text-align: center;width:auto">Action</th>
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
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Supplier</th>
                                        <th style="text-align: center;width:auto">Surveyor</th>
                                        <th style="text-align: center;width:auto">No.&nbsp;DTM</th>
                                        <th style="text-align: center;width:auto">Keterangan&nbsp;Bongkar</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;Bongkar</th>
                                        <th style="text-align: center;width:auto">Waktu&nbsp;Bongkar</th>
                                        <th style="text-align: center;width:auto">Tempat&nbsp;Bongkar</th>
                                        <th style="text-align: center;width:auto">Karung&nbsp;Dibawa</th>
                                        <th style="text-align: center;width:auto">Karung&nbsp;Ditolak</th>
                                        <th style="text-align: center;width:auto">Action</th>
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

        <div class="modal fade" id="modal_qc_bongkar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="formupdatedtm" class="m-form m-form--fit m-form--label-align-right" method="post" action="javascript:void(0);" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update NO. DTM</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_penerimaan_po" id="id_penerimaan_po" value="">
                            <div class="form-group">
                                <div class="">
                                    <label>Kode PO</label>
                                    <input id="penerimaan_kode_po" required name="penerimaan_kode_po" placeholder="" type="text" readonly class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>No. DTM</label>
                                    <input id="dtm_gb" required name="dtm_gb" placeholder="" type="text" class="form-control m-input">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="btn_update" class="btn btn-success m-btn pull-right">Update</button>
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
                    url: "{{ route('master.data_revisi_gb_longgrain_index') }}",
                    data: {
                        from_date: from_date,
                        to_date: to_date
                    }
                },
                columns: [{
                        data: "id_data_qc_bongkar",

                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name_bid'
                    },
                    {
                        data: 'kode_po_bongkar'
                    },
                    {
                        data: 'nama_vendor'
                    },
                    {
                        data: 'surveyor_bongkar'
                    },
                    {
                        data: 'dtm_gb'
                    },
                    {
                        data: 'keterangan_bongkar'
                    },
                    {
                        data: 'tanggal_bongkar'
                    },
                    {
                        data: 'waktu_bongkar'
                    },
                    {
                        data: 'tempat_bongkar'
                    },
                    {
                        data: 'z_yang_dibawa'
                    },
                    {
                        data: 'z_yang_ditolak'
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
                    url: "{{ route('master.data_revisi_gb_pandan_wangi_index') }}",
                    data: {
                        from_date: from_date,
                        to_date: to_date
                    }
                },
                columns: [{
                        data: "id_data_qc_bongkar",

                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name_bid'
                    },
                    {
                        data: 'kode_po_bongkar'
                    },
                    {
                        data: 'nama_vendor'
                    },
                    {
                        data: 'surveyor_bongkar'
                    },
                    {
                        data: 'dtm_gb'
                    },
                    {
                        data: 'keterangan_bongkar'
                    },
                    {
                        data: 'tanggal_bongkar'
                    },
                    {
                        data: 'waktu_bongkar'
                    },
                    {
                        data: 'tempat_bongkar'
                    },
                    {
                        data: 'z_yang_dibawa'
                    },
                    {
                        data: 'z_yang_ditolak'
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
                    url: "{{ route('master.data_revisi_gb_ketan_putih_index') }}",
                    data: {
                        from_date: from_date,
                        to_date: to_date
                    }
                },
                columns: [{
                        data: "id_data_qc_bongkar",

                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name_bid'
                    },
                    {
                        data: 'kode_po_bongkar'
                    },
                    {
                        data: 'nama_vendor'
                    },
                    {
                        data: 'surveyor_bongkar'
                    },
                    {
                        data: 'dtm_gb'
                    },
                    {
                        data: 'keterangan_bongkar'
                    },
                    {
                        data: 'tanggal_bongkar'
                    },
                    {
                        data: 'waktu_bongkar'
                    },
                    {
                        data: 'tempat_bongkar'
                    },
                    {
                        data: 'z_yang_dibawa'
                    },
                    {
                        data: 'z_yang_ditolak'
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
        }
        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            if (from_date != '' && to_date != '') {
                $('#data_longgrain').DataTable().destroy();
                $('#data_ciherang').DataTable().destroy();
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
            $('#data_longgrain').DataTable().destroy();
            $('#data_ciherang').DataTable().destroy();
            $('#data_pw').DataTable().destroy();
            $('#data_kp').DataTable().destroy();
            load_data();
        });
        $(document).on('click', '#btn_update', function(e) {
            e.preventDefault();
            var id_penerimaan_po = $('#id_penerimaan_po').val();
            var penerimaan_kode_po = $('#penerimaan_kode_po').val();
            var dtm_gb = $('#dtm_gb').val();
            $('#btn_update').html('Menyimpan...');
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
                    if ($('#tara').val() == '' || $('#bruto').val() == '') {
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
                                        dtm_gb: dtm_gb,
                                    },
                                    url: "{{ route('master.update_dtm')}}",
                                    type: "POST",
                                    dataType: 'json',
                                    success: function(data) {
                                        $('#data_longgrain').DataTable().ajax.reload();
                                        $('#data_pw').DataTable().ajax.reload();
                                        $('#data_kp').DataTable().ajax.reload();
                                        $("#formupdatedtm").trigger('reset');
                                        $('#modal_qc_bongkar').modal('hide');
                                        $('#btn_update').html('Simpan');
                                        Swal.fire({
                                            title: 'success',
                                            text: 'Data Berhasil Disimpan.',
                                            icon: 'success',
                                            timer: 1500
                                        })

                                    },
                                    error: function(data) {
                                        $("#formupdatedtm").trigger('reset');
                                        $('#btn_update').html('Simpan');
                                        $('#modal_qc_bongkar').modal('hide');
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
        $(document).on('click', '.to_revisibongkar', function() {
            var id = $(this).attr("name");
            var url = "{{ route('master.show_revisi_gb') }}" + "/" + id;
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    // console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_penerimaan_po').val(parsed.id_penerimaan_po);
                    $('#penerimaan_kode_po').val(parsed.penerimaan_kode_po);
                    $('#dtm_gb').val(parsed.no_dtm);
                }
            });
        });
    });
</script>
@endsection