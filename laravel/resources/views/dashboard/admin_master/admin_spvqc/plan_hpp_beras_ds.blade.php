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
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet ">
                <div class="">
                    <!--begin::Accordion-->
                    <div class="accordion  accordion-toggle-arrow" id="accordionExample4">
                        <div class="card">
                            <div class="card-header" id="headingOne4">
                                <div class="card-title" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseOne4">
                                    <i class="flaticon2-add kt-font-info"></i> Tambah Plan HPP
                                </div>
                            </div>
                            <div id="collapseOne4" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample4">
                                <div class="card-body">
                                    <form id="formplanhpp" class="kt-form" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-wizard-v4__form">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="kt-section__body">
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Min TP</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="number" step="any" id="add_min_tp" class="form-control" name="add_min_tp">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Max TP</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="number" step="any" id="add_max_tp" class="form-control" name="add_max_tp">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Tanggal PO</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="date" step="any" id="add_tanggal_po" class="form-control" name="add_tanggal_po">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Harga</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="number" step="any" id="add_harga" class="form-control" name="add_harga">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-form__actions">
                                                    <button id="btnSaveadd" class="btn btn-success m-btn pull-right" style="">Save</button>
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
                            <i class="flaticon2-box-1 kt-font-danger"></i>

                        </span>
                        <h3 class="kt-portlet__head-title">
                            Plan HPP Beras DS
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-bordered" id="table-plan-hpp">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:2%">No</th>
                                <th style="text-align: center;width:auto">MIN&nbsp;TP</th>
                                <th style="text-align: center;width:auto">MAX&nbsp;TP</th>
                                <th style="text-align: center;width:auto">TANGGAL&nbsp;PO</th>
                                <th style="text-align: center;width:auto">HARGA</th>
                                <th style="text-align: center;width:auto">Action</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-plan-hpp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="javascript:void(0)" class="m-form m-form--fit m-form--label-align-right">
                        <input type="hidden" id="id_plan_hpp">
                        <input type="hidden" id="tanggal_poedit">
                        <div class="modal-header">
                            <h5 class="modal-title" id="headmodal"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <div class="form-group">
                                    <label>Min TP</label>
                                    <input type="number" id="min_tp" name="min_tp" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Max TP</label>
                                    <input type="number" id="max_tp" name="max_tp" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label>TANGGAL PO</label>
                                    <input type="date" id="tanggal_po" name="tanggal_po" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" id="harga" name="harga" class="form-control m-input">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                            <button id="btnSave" class="btn btn-success m-btn pull-right">Simpan</button>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });

    var table = $('#table-plan-hpp').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('master.plan_hpp_beras_ds_index') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'min_tp_ds',
                name: 'min_tp_ds'
            },
            {
                data: 'max_tp_ds',
                name: 'max_tp_ds'
            },
            {
                data: 'waktu_plan_hpp_ds',
                name: 'waktu_plan_hpp_ds'
            },
            {
                data: 'harga_ds',
                name: 'harga_ds'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });


    $(document).ready(function() {
        $('body').on('click', '#btnEdit', function() {
            ids = $(this).attr("data-id");

            $('#headmodal').html("Edit Data PLAN HPP");
            var url = "{{ route('master.partial_plan_hpp_beras_ds', ':id') }}";
            url = url.replace(':id', ids);
            $.get(url, function(response) {
                $('#id_plan_hpp').val(response.id_plan_hpp_ds);
                $('#min_tp').val(response.min_tp_ds);
                $('#max_tp').val(response.max_tp_ds);
                $('#harga').val(response.harga_ds);
                $('#tanggal_po').val(response.waktu_plan_hpp_ds);
                $('#tanggal_poedit').val(response.waktu_plan_hpp_ds);
                $('#modal-plan-hpp').modal('show');
            })
        });
    });


    $('body').on('click', '#btnDelete', function() {
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
                    url: "{{ route('master.delete_plan_hpp_beras_ds') }}/" + cek,
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
                        table.ajax.reload();
                    }
                });
            } else {
                Swal.fire("Cancelled", "Your data is safe :)", "error");
            }
        });

    });
    $(document).ready(function() {
        $('body').on('click', '#btnSaveadd', function() {
            $('#btnSaveadd').html('Menyimpan...');
            var add_min_tp = $('#add_min_tp').val();
            var add_max_tp = $('#add_max_tp').val();
            var add_tanggal_po = $('#add_tanggal_po').val();
            var add_harga = $('#add_harga').val();
            Swal.fire({
                title: 'Konfirmasi',
                icon: 'warning',
                text: "Apakah data yang kamu input sudah benar ?",
                showCancelButton: true,
                inputValue: 0,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        data: {
                            add_min_tp: add_min_tp,
                            add_max_tp: add_max_tp,
                            add_harga: add_harga,
                            add_tanggal_po: add_tanggal_po,
                        },
                        url: "{{ route('master.simpan_plan_hpp_beras_ds') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {

                            table.draw();
                            $("#formplanhpp").trigger('reset');
                            $('#btnSaveadd').html('Simpan');
                            Swal.fire({
                                title: 'success',
                                text: 'Data Berhasil DiSimpan',
                                icon: 'success',
                                timer: 1500
                            })

                        },
                        error: function(data) {
                            $('#btnSaveadd').html('Simpan');
                            Swal.fire({
                                title: 'Gagal',
                                text: 'Tanggal PO Melebihi Batas Yang Ditentukan ',
                                icon: 'error',
                                timer: 1500

                            })

                        }
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });
        });
        $('body').on('click', '#btnSave', function() {
            $('#btnSave').html('Menyimpan...');
            var id_plan_hpp = $('#id_plan_hpp').val();
            var min_tp = $('#min_tp').val();
            var tanggal_po = $('#tanggal_po').val();
            var max_tp = $('#max_tp').val();
            var harga = $('#harga').val();
            $.ajax({
                data: {
                    id_plan_hpp: id_plan_hpp,
                    min_tp: min_tp,
                    max_tp: max_tp,
                    max_tp: max_tp,
                    harga: harga,
                    tanggal_po: tanggal_po,
                },
                url: "{{ route('master.simpan_plan_hpp_beras_ds') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {

                    table.draw();
                    $('#btnSave').html('Simpan');
                    $('#modal-plan-hpp').modal('hide');
                    Swal.fire({
                        title: 'success',
                        Text: 'Data Berhasil DiSimpan',
                        icon: 'success',
                        timer: 1500
                    })

                },
                error: function(data) {
                    $('#btnSave').html('Simpan');
                    Swal.fire({
                        title: 'Gagal',
                        text: 'Tanggal PO Melebihi Batas Yang Ditentukan ',
                        icon: 'error',
                        timer: 1500

                    })

                }
            });

        });
    });
</script>
@endsection