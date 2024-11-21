@extends('dashboard.superadmin.layout.main')
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
                            <i class="flaticon2-sheet kt-font-success"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            TAGIHAN
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-database"></i>BULAN LALU (<b>{{\Carbon\Carbon::now()->subMonthsNoOverflow()->isoFormat('MMMM');}}</b>)</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link active" data-toggle="tab" href="#m_tabs_3_2"><i class="la la-database"></i>BULAN INI (<b>{{\Carbon\Carbon::now()->isoFormat('MMMM');}}</b>)</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="m_tabs_3_1" role="tabpanel">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">No</th>
                                        <th style="text-align: center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total&nbsp;Pengiriman&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center">&nbsp;&nbsp;Action&nbsp;&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane active" id="m_tabs_3_2" role="tabpanel">
                            <table class="table table-bordered" id="datatable1">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">No</th>
                                        <th style="text-align: center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total&nbsp;Pengiriman&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center">&nbsp;&nbsp;Action&nbsp;&nbsp;</th>
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
        <div class="modal fade" id="modal_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form class="m-form m-form--fit m-form--label-align-right" id="form_tagihan" method="post" action="{{ route('sourching.upload_tagihan') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Upload File Tagihan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_user" id="id_user" value="">
                            <input type="text" name="bulan" id="bulan" value="">
                            <div class="form-group">
                                <div class="">
                                    <label for="judul_tagihan">Judul Tagihan</label>
                                    <input type="text" name="judul_tagihan" id="judul_tagihan" class="form-control mb-3" value="">
                                    <label for="keterangan_tagihan">Keterangan Tagihan</label>
                                    <input type="text" name="keterangan_tagihan" id="keterangan_tagihan" class="form-control mb-3" value="">
                                    <label>File Tagihan</label>
                                    <input id="tagihan_file" name="tagihan_file" placeholder="" type="file" accept="application/pdf,image/*" class="form-control m-input">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="btn_upload" class="btn btn-success m-btn pull-right">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form class="m-form m-form--fit m-form--label-align-right" id="form_tagihan_update" method="post" action="{{ route('sourching.update_tagihan') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update File Tagihan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="text" name="id_tagihan" id="id_tagihan" value="">
                            <div class="form-group">
                                <div class="">
                                    <label for="judul_tagihan_update">Judul Tagihan</label>
                                    <input type="text" name="judul_tagihan_update" id="judul_tagihan_update" class="form-control mb-3" value="">
                                    <label for="keterangan_tagihan_update">Keterangan Tagihan</label>
                                    <input type="text" name="keterangan_tagihan_update" id="keterangan_tagihan_update" class="form-control mb-3" value="">
                                    <label>File Tagihan</label>
                                    <input type="hidden" name="tagihan_file_old" id="tagihan_file_old">
                                    <input id="tagihan_file_update" name="tagihan_file_update" placeholder="" type="file" accept="application/pdf,image/*" class="form-control m-input">
                                    <br>
                                    <div id="example1" style="height: 400px; width: 100%;"></div>
                                </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).ready(function() {

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
            ajax: "{{ route('sourching.tagihan_index') }}",
            columns: [{
                    data: "id",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'nama_vendor'
                },
                {
                    data: 'total_po'
                },
                {
                    data: 'ckelola'
                },

            ],
            "order": []
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
            ajax: "{{ route('sourching.tagihan1_index') }}",
            columns: [{
                    data: "id",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'nama_vendor'
                },
                {
                    data: 'total_po'
                },
                {
                    data: 'ckelola'
                },

            ],
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table1.columns.adjust().draw().responsive.recalc();
        })
    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '#btn_modal_upload', function() {
            var id = $(this).data('id');
            var bulan = $(this).data('bulan');
            $('#id_user').val(id);
            $('#bulan').val(bulan);
            $('#modal_upload').modal('show');
        });
        $('#tagihan_file_update').change(function() {

            let reader = new FileReader();
            console.log(reader);
            reader.onload = (e) => {
                PDFObject.embed(e.target.result, "#example1");
            }

            reader.readAsDataURL(this.files[0]);

        });
        $(document).on('click', '#btn_edit_tagihan', function() {
            var id = $(this).data('id');
            var tagihan = $(this).data('tagihan');
            var judul = $(this).data('judul');
            var keterangan = $(this).data('keterangan');
            $('#id_tagihan').val(id);
            $('#tagihan_file_old').val(tagihan);
            $('#judul_tagihan_update').val(judul);
            $('#keterangan_tagihan_update').val(keterangan);
            // console.log(tagihan);
            // $('img[id=file_tagihan]').attr('src', 'https://ngawi.suryapangansemesta.store/public/dokumen/tagihan/' + tagihan);
            PDFObject.embed("https://ngawi.suryapangansemesta.store/public/dokumen/tagihan/" + tagihan, "#example1");
            $('#modal_edit').modal('show');
        });
        $(document).on('click', '#btn_upload', function(e) {
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
                    if ($('#judul_tagihan').val() == '' || $('#keeterangan_tagihan').val() == '' || $('#tagihan_file').val() == '') {
                        Swal.fire('Gagal!', 'Data Harus Terisi.', 'error')
                    } else {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Data Uploading...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            },
                        });
                        $('#form_tagihan').submit();

                        // Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                    }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '#btn_update', function(e) {
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
                    if ($('#tagihan_file_update').val() == '') {
                        Swal.fire('Gagal!', 'Data Harus Terisi.', 'error')
                    } else {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Data Uploading...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            },
                        });
                        $('#form_tagihan_update').submit();

                        // Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                    }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $('body').on('click', '#btn_hapus_tagihan', function() {
            var id = $(this).data('id');
            console.log(id);
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Kamu tidak dapat mengembalikan data ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{route('sourching.delete_tagihan')}}/" + id,
                        type: "GET",
                        error: function() {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Gagal Hapus Data.',
                                icon: 'error',
                                timer: 1500
                            })
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: 'Data anda berhasil di hapus.',
                                icon: 'success',
                                timer: 1500
                            })
                            $('#datatable').DataTable().ajax.reload();
                            $('#datatable1').DataTable().ajax.reload();
                        }
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });

        });
    });
</script>
<script type="text/javascript">
    $(function() {
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