@extends('dashboard.admin.layout.main')
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
                            <i class="flaticon-user"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Beras DS <span class="btn-outline btn-sm btn-warning">Urgent</span>
                        </h3>
                    </div>
                </div>
                <div class="">
                    <div class="kt-portlet__head-label">
                        <div class="m-portlet__body">
                            <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item mt-3">
                                    <a class="nav-link" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-database"></i>PO Kemaren ( <?php echo date('d-m-Y', strtotime("-1 days")); ?> )</a>
                                </li>
                                <li class="nav-item mt-3">
                                    <a class="nav-link active" data-toggle="tab" href="#m_tabs_3_2"><i class="la la-database"></i>PO Hari Ini ( <?php echo date('d-m-Y'); ?> )</a>
                                </li>
                                <li class="nav-item mt-3">
                                    <a class="nav-link" data-toggle="tab" href="#m_tabs_3_3"><i class="la la-database"></i>PO Besok ( <?php echo date('d-m-Y', strtotime("+1 days")); ?> )</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane" id="m_tabs_3_1" role="tabpanel">
                                    <div class="kt-portlet__body col-12">
                                        <table class="table table-bordered" id="po_kemarin">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;width:2%">No</th>
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
                                    <div class="kt-portlet__body col-12">
                                        <table class="table table-bordered" id="data_po">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;width:2%">No</th>
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

<div class="modal fade" id="modal_penerimaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form_terimadatapo" class="m-form m-form--fit m-form--label-align-right" method="post" action="javascript:void(0);" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Terima Data PO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="penerimaan_id_data_po" id="penerimaan_id_data_po" value="">
                    <input type="hidden" id="penerimaan_id_bid_user" name="penerimaan_id_bid_user" value="">
                    <div class="form-group">
                        <div class="">
                            <label>Penerima PO</label>
                            <input id="name_bid" name="name_bid" readonly value="{{Auth::user()->name}}" type="text" class="form-control m-input">
                            <input type="hidden" id="penerima_po" required name="penerima_po" value="{{Auth::user()->id}}">
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
                            <input name="plat_kendaraan" required placeholder="A 12345 B" id="plat_kendaraan" type="text" class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Keterangan</label>
                            <input id="keterangan_penerimaan_po" name="keterangan_penerimaan_po" placeholder="Asal Gabah" required type="text" class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label for="">Status</label><br>
                            <input type="radio" required name="status_penerimaan" id="status_penerimaan" checked="checked" value="3">
                            <label for="age2">Parking</label>
                            <input type="radio" required disabled name="status_penerimaan" value="5">
                            <label for="age2">Unparking</label>
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


@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).ready(function() {
        var table = $('#po_kemarin').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('security.berasdsurgent_index_kemarin') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
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
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table.columns.adjust().draw().responsive.recalc();
        })
    });
    $(function() {
        var table1 = $('#datatable_sekarang').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('security.berasdsurgent_index_sekarang') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
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
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table1.columns.adjust().draw().responsive.recalc();
        })
    });
    $(document).ready(function() {
        var table2 = $('#data_po').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('security.berasdsurgent_index_besok') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
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
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table2.columns.adjust().draw().responsive.recalc();
        })
    });
</script>

<script type="text/javascript">
    $(function() {
        $(document).on('click', '.toedit', function() {
            var id = $(this).attr("name");
            var url = "{{ route('security.show.penerimaan_po') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#penerimaan_id_data_po').val(parsed.id_data_po);
                    $('#penerimaan_kode_po').val(parsed.kode_po);
                    $('#penerimaan_id_bid_user').val(parsed.bid_user_id);
                    $('#plat_kendaraan').val(parsed.plat_kendaraan);
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
                    $('#form_potelat').submit();
                    Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '#btn_save', function(e) {
            e.preventDefault();
            var penerimaan_id_data_po = $('#penerimaan_id_data_po').val();
            var penerimaan_id_bid_user = $('#penerimaan_id_bid_user').val();
            var name_bid = $('#name_bid').val();
            var penerima_po = $('#penerima_po').val();
            var waktu_penerimaan = $('#waktu_penerimaan').val();
            var penerimaan_kode_po = $('#penerimaan_kode_po').val();
            var plat_kendaraan = $('#plat_kendaraan').val();
            var keterangan_penerimaan_po = $('#keterangan_penerimaan_po').val();
            var status_penerimaan = $('input[name="status_penerimaan"]:checked').val();
            $('#btn_save').html('Menyimpan...');
            // console.log(analisa);
            Swal.fire({
                title: 'Konfirmasi',
                icon: 'warning',
                text: "Apakah data yang kamu input sudah benar ?",
                showCancelButton: true,
                inputValue: 0,
                confirmButtonText: 'Yes',
            }).then(function(result) {
                if (result.value) {
                    if ($('#plat_kendaraan').val() == '' | $('#keterangan_penerimaan_po').val() == '') {
                        Swal.fire({
                            title: 'Gagal!!',
                            text: 'Data Harus Terisi.',
                            icon: 'error',
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
                                        penerimaan_id_data_po: penerimaan_id_data_po,
                                        penerimaan_id_bid_user: penerimaan_id_bid_user,
                                        waktu_penerimaan: waktu_penerimaan,
                                        name_bid: name_bid,
                                        penerima_po: penerima_po,
                                        penerimaan_kode_po: penerimaan_kode_po,
                                        plat_kendaraan: plat_kendaraan,
                                        keterangan_penerimaan_po: keterangan_penerimaan_po,
                                        status_penerimaan: status_penerimaan,
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
                                        $('#modal_penerimaan').modal('hide');
                                        Swal.fire({
                                            title: 'success',
                                            text: 'Data Berhasil Disimpan.',
                                            icon: 'success',
                                            timer: 1500
                                        })

                                    },
                                    error: function(data) {
                                        $("#form_terimadatapo").trigger('reset');
                                        $('#btn_save').html('Simpan');
                                        $('#modal_penerimaan').modal('hide');
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

        $(document).on('click', '.toterima', function() {
            var id = $(this).attr("name");
            var url = "{{ route('security.show.penerimaan_po') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_data_po_kemarin').val(parsed.id_data_po);
                    $('#kode_po_kemarin').val(parsed.kode_po);
                    $('#bid_user_kemarin').val(parsed.bid_user_id);
                    $('#plat_kendaraan_kemarin').val(parsed.plat_kendaraan);
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(function() {
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
                }
            });
        });
    });
</script>

<script>
</script>
@endsection