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
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet ">
                <div class="">
                    <!--begin::Accordion-->
                    <div class="accordion  accordion-toggle-arrow" id="accordionExample4">
                        <div class="card">
                            <div class="card-header" id="headingOne4">
                                <div class="card-title" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseOne4">
                                    <i class="flaticon2-add kt-font-info"></i> Tambah Harga Atas
                                </div>
                            </div>
                            <div id="collapseOne4" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample4">
                                <div class="card-body">
                                    <form id="formhargaatas" class="kt-form" action="{{ route('qc.lab.store_harga_atas_pecah_kulit') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-wizard-v4__form">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="kt-section__body">
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Harga Atas</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="number" id="harga_atas" class="form-control" required name="harga_atas">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Waktu</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="date" id="waktu_harga_atas" class="form-control" required name="waktu_harga_atas">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-form__actions">
                                                    <button id="btn_save" type="submit" class="btn btn-success m-btn pull-right" style="">Save</button>
                                                </div><br>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Accordion-->
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data Harga Atas Beras PK
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-bordered" id="table-harga-atas">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:2%">No</th>
                                <th style="text-align: center;width:auto">Harga Atas</th>
                                <th style="text-align: center;width:auto">Waktu Harga Atas </th>
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

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="formupdatehargaatas" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('qc.lab.update_harga_atas_pecah_kulit') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Top Price</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_harga_atas_update" id="id_harga_atas_update" value="">
                            <div class="form-group">
                                <div class="">
                                    <label>Top Price</label>
                                    <input id="harga_atas_update" required name="harga_atas_update" placeholder="" type="number" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Date</label>
                                    <input id="waktu_harga_atas_update" required name="waktu_harga_atas_update" placeholder="" type="date" class="form-control m-input">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="btn_update" type="submit" class="btn btn-success m-btn pull-right">Update</button>
                            </div>
                    </form>
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
    $(function() {
        var table = $('#table-harga-atas').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('qc.lab.harga_atas_pecah_kulit_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'harga_atas'
                },
                {
                    data: 'waktu_harga_atas'
                },
                {
                    data: 'ckelola'
                },


            ],
            "order": []
        });
    });
</script>
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
                    if ($('#waktu_harga_atas').val() == '' || $('#harga_atas').val() == '') {
                        Swal.fire('Gagal!', 'Data Harus Diisi.', 'error')

                    } else {
                        $('#formhargaatas').submit();
                        Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
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
                    if ($('#waktu_harga_atas_update').val() == '' || $('#harga_atas_update').val() == '') {
                        Swal.fire('Gagal!', 'Data Harus Diisi.', 'error')
                    } else {
                        $('#formupdatehargaatas').submit();
                        Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
                    }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $('body').on('click', '#btn_delete', function() {
            var cek = $(this).data('id');
            console.log(cek);
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
                        url: "{{url('qc/lab/destroy_harga_atas_pecah_kulit')}}/" + cek,
                        type: "GET",
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: 'Data anda berhasil di hapus.',
                                icon: 'success',
                                timer: 1500
                            })
                            $('#table-harga-atas').DataTable().ajax.reload();
                        }
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });

        });
        $(document).on('click', '.to_harga_atas', function() {
            var id = $(this).attr("name");
            var url = "{{ route('qc.lab.show_harga_atas_pecah_kulit') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_harga_atas_update').val(parsed.id_harga_atas_pk);
                    $('#harga_atas_update').val(parsed.harga_atas_pk);
                    $('#waktu_harga_atas_update').val(parsed.waktu_harga_atas_pk);
                    console.log(parsed.harga_atas_pk);
                }
            });
        });
    });
</script>
@endsection