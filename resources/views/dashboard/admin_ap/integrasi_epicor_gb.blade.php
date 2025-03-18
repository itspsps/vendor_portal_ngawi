@extends('dashboard.admin_ap.layout.main')
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
                            Integrasi Epicor
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-bordered" width="100%" id="datatable">
                        <thead>
                            <tr>
                                <th style="text-align: center;">No</th>
                                <th style="text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;Site&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;">&nbsp;Nama &nbsp;Supplier&nbsp;</th>
                                <th style="text-align: center;">&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;</th>
                                <th style="text-align: center;">&nbsp;&nbsp;Status&nbsp;&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="formtimbangan_awal" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{route('ap.data_pembelian_update')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Data Verifikasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_penerimaan_po" id="id_penerimaan_po" value="">
                            <div class="form-group">
                                <div class="">
                                    <label>Kode PO</label>
                                    <input id="penerimaan_kode_po" readonly name="penerimaan_kode_po" type="text" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Analisa</label>
									<div class="kt-radio-inline">
										<label class="kt-radio">
											<input type="radio" value="verified" id="lokasigt" class="form-control m-input" name="analisa"> Verifikasi
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" value="revisi" id="lokasi04" class="form-control m-input" name="analisa"> Revisi
											<span></span>
										</label>
									</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" id="isi_broadcast" name="keterangan_analisa"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                            <button id="btn_save" type="submit" class="btn btn-success m-btn pull-right">Save</button>
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
            ajax: "{{ route('ap.integrasi_epicor_gb_index') }}",
            columns: [{
                    data: "id_penerimaan_po",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'site_admin'},
                {data: 'kode_po'},
                {data: 'nama_vendor'},
                {data: 'tanggal_po'},
                {data: 'ckelola'},

            ],
            "order": []
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '#btn_save', function(e) {
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
                    $('#formtimbangan_awal').submit();
                    Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '.to_show', function() {
            var id = $(this).attr("name");
            // console.log(id);
            var url = "{{ route('ap.data_pembelian_show') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    // console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_penerimaan_po').val(parsed.id_penerimaan_po);
                    $('#penerimaan_kode_po').val(parsed.penerimaan_kode_po);
                }
            });
        });
        $('body').on('click', '#btn_kirimepicor_gb', function() {
            var cek = $(this).data('id');
            // console.log(cek);
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Kamu Akan Mengirim Data Ke Epicor",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                title: 'Harap Tuggu Sebentar!',
                html: 'Proses Input Data...',// add html attribute if you want or remove
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    $.ajax({
                        url: "{{route('ap.kirim_epicor_gb')}}/" + cek,
                        type: "GET",
                        error: function() {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Gagal Kirim Data.',
                                icon:'error',
                                timer:1500
                            })
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Sukses!',
                                text: 'Anda berhasil Kirim Data',
                                icon: 'success', 
                                timer: 1500
                            })
                            $('#datatable').DataTable().ajax.reload();
                        }
                    });
                    },
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });

        });
    });
</script>
@endsection