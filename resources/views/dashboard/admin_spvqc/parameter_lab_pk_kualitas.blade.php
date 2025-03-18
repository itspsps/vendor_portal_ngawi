@extends('dashboard.admin_spvqc.layout.main')
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

                    <!-- <div class="accordion  accordion-toggle-arrow" id="accordionExample4">
                        <div class="card">
                            <div class="card-header" id="headingOne4">
                                <div class="card-title" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseOne4">
                                    <i class="flaticon2-add kt-font-info"></i> Tambah Parameter PK (Kualitas)
                                </div>
                            </div>
                            <div id="collapseOne4" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample4">
                                <div class="card-body">
                                    <form class="kt-form" id="form_lab_kualitas" action="{{ route('qc.spv.parameter_lab_pk_kualitas_store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-wizard-v4__form">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="kt-section__body">
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Tanggal PO</label>
                                                                    <div class="col-lg-6 col-xl-6">
                                                                        <input type="date" class="form-control" id="tanggal_parameter_lab_pk_kualitas" name="tanggal_parameter_lab_pk_kualitas">
                                                                    </div>
                                                                </div>
                                                                <div class="col-row">
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"><b>Min TR</b></label>
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"><b>Max TR</b></label>
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"><b>Min BP</b></label>
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"><b>Max BP</b></label>
                                                                    <label class="col-xl-2 col-lg-2 col-form-label"><b>Kualitas</b></label>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" id="min_parameter_lab_pk_tr_kualitas1" name="min_parameter_lab_pk_tr_kualitas1">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" id="max_parameter_lab_pk_tr_kualitas1" name="max_parameter_lab_pk_tr_kualitas1">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" id="min_parameter_lab_pk_butirpatah_kualitas1" name="min_parameter_lab_pk_butirpatah_kualitas1">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" id="max_parameter_lab_pk_butirpatah_kualitas1" name="max_parameter_lab_pk_butirpatah_kualitas1">
                                                                    </div>
                                                                    <div class="col-lg-4 col-xl-4">
                                                                        <input type="text" class="form-control" id="kualitas_parameter_lab_pk1" name="kualitas_parameter_lab_pk1" value="TOLAK">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" id="min_parameter_lab_pk_tr_kualitas2" name="min_parameter_lab_pk_tr_kualitas2">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" id="max_parameter_lab_pk_tr_kualitas2" name="max_parameter_lab_pk_tr_kualitas2">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" id="min_parameter_lab_pk_butirpatah_kualitas2" name="min_parameter_lab_pk_butirpatah_kualitas2">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" id="max_parameter_lab_pk_butirpatah_kualitas2" name="max_parameter_lab_pk_butirpatah_kualitas2">
                                                                    </div>
                                                                    <div class="col-lg-4 col-xl-4">
                                                                        <input type="text" class="form-control" id="kualitas_parameter_lab_pk2" name="kualitas_parameter_lab_pk2" value="KW3">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" id="min_parameter_lab_pk_tr_kualitas3" name="min_parameter_lab_pk_tr_kualitas3">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" id="max_parameter_lab_pk_tr_kualitas3" name="max_parameter_lab_pk_tr_kualitas3">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" id="min_parameter_lab_pk_butirpatah_kualitas3" name="min_parameter_lab_pk_butirpatah_kualitas3">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" id="max_parameter_lab_pk_butirpatah_kualitas3" name="max_parameter_lab_pk_butirpatah_kualitas3">
                                                                    </div>
                                                                    <div class="col-lg-4 col-xl-4">
                                                                        <input type="text" class="form-control" id="kualitas_parameter_lab_pk3" name="kualitas_parameter_lab_pk3" value="KW2">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" id="min_parameter_lab_pk_tr_kualitas4" name="min_parameter_lab_pk_tr_kualitas4">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" id="max_parameter_lab_pk_tr_kualitas4" name="max_parameter_lab_pk_tr_kualitas4">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" id="min_parameter_lab_pk_butirpatah_kualitas4" name="min_parameter_lab_pk_butirpatah_kualitas4">
                                                                    </div>
                                                                    <div class="col-lg-2 col-xl-2">
                                                                        <input type="text" class="form-control" id="max_parameter_lab_pk_butirpatah_kualitas4" name="max_parameter_lab_pk_butirpatah_kualitas4">
                                                                    </div>
                                                                    <div class="col-lg-4 col-xl-4">
                                                                        <input type="text" class="form-control" id="kualitas_parameter_lab_pk4" name="kualitas_parameter_lab_pk4" value="KW1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-form__actions">
                                                    <button id="btn_save" class="btn btn-success m-btn pull-right" style="">Save</button>
                                                </div><br>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!--end::Accordion-->
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="flaticon2-analytics-2 kt-font-warning"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data Parameter Lab PK Kualitas
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal_update_po" title="Information" id="btn_update_po">Update Semua Tanggal PO</button>
                    <table class="table table-bordered" id="table-parameter-lab">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:2%" rowspan="2">&nbsp;No&nbsp;</th>
                                <th bgcolor="#CCFFCC" style="text-align: center;width:2%" colspan="2">Transparasi</th>
                                <th bgcolor="#FFCCCC" style="text-align: center;width:2%" colspan="2">Butir&nbsp;Patah</th>
                                <th style="text-align: center;width:auto" rowspan="2">Kualitas</th>
                                <th style="text-align: center;width:auto" rowspan="2">Tanggal&nbsp;PO</th>
                                <th style="text-align: center;width:auto" rowspan="2">Action</th>
                            </tr>
                            <tr>
                                <th style="text-align: center;width:auto">Min&nbsp;(>=) </th>
                                <th style="text-align: center;width:auto">Max&nbsp;(<=) </th>
                                <th style="text-align: center;width:auto">Min&nbsp;(>=) </th>
                                <th style="text-align: center;width:auto">Max&nbsp;(<=) </th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="modal fade" id="modal_update_po" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('qc.spv.parameter_lab_pk_kualitas_po_update') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">UPDATE TANGGAL PO</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="">
                                        <label>Tanggal PO</label>
                                        <input id="tanggal_parameter_lab_pk_kualitas" required name="tanggal_parameter_lab_pk_kualitas" placeholder="" type="date" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success m-btn pull-right">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('qc.spv.parameter_lab_pk_kualitas_update') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Parameter PK Kualitas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id_parameter_lab_pk_kualitas_update" id="id_parameter_lab_pk_kualitas_update" value="">
                                <div class="form-group">
                                    <div class="">
                                        <label>Min Kualitas Transparasi</label>
                                        <input id="min_parameter_lab_pk_tr_kualitas_update" name="min_parameter_lab_pk_tr_kualitas_update" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Max Kualitas Transparasi</label>
                                        <input id="max_parameter_lab_pk_tr_kualitas_update" name="max_parameter_lab_pk_tr_kualitas_update" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Min Butir Patah Kualitas</label>
                                        <input id="min_parameter_lab_pk_butirpatah_kualitas_update" name="min_parameter_lab_pk_butirpatah_kualitas_update" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Max Butir Patah Kualitas</label>
                                        <input id="max_parameter_lab_pk_butirpatah_kualitas_update" name="max_parameter_lab_pk_butirpatah_kualitas_update" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Kualitas</label>
                                        <input type="text" class="form-control" id="kualitas_parameter_lab_pk_update" name="kualitas_parameter_lab_pk_update">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Tanggal</label>
                                        <input id="tanggal_parameter_lab_pk_kualitas_update" required name="tanggal_parameter_lab_pk_kualitas_update" placeholder="" type="date" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success m-btn pull-right">Update</button>
                                </div>
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
        var table = $('#table-parameter-lab').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('qc.spv.parameter_lab_pk_kualitas_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'min_parameter_lab_pk_tr_kualitas'
                },
                {
                    data: 'max_parameter_lab_pk_tr_kualitas'
                },
                {
                    data: 'min_parameter_lab_pk_butirpatah_kualitas'
                },
                {
                    data: 'max_parameter_lab_pk_butirpatah_kualitas'
                },
                {
                    data: 'kualitas_parameter_lab_pk'
                },
                {
                    data: 'tanggal_parameter_lab_pk_kualitas'
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
        $(document).on('click', '.to_parameter', function() {
            var id = $(this).attr("name");
            var url = "{{ route('qc.spv.parameter_lab_pk_kualitas_show') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_parameter_lab_pk_kualitas_update').val(parsed.id_parameter_lab_pk_kualitas);
                    $('#min_parameter_lab_pk_tr_kualitas_update').val(parsed.min_parameter_lab_pk_tr_kualitas);
                    $('#max_parameter_lab_pk_tr_kualitas_update').val(parsed.max_parameter_lab_pk_tr_kualitas);
                    $('#min_parameter_lab_pk_butirpatah_kualitas_update').val(parsed.min_parameter_lab_pk_butirpatah_kualitas);
                    $('#max_parameter_lab_pk_butirpatah_kualitas_update').val(parsed.max_parameter_lab_pk_butirpatah_kualitas);
                    $('#kualitas_parameter_lab_pk_update').val(parsed.kualitas_parameter_lab_pk);
                    $('#tanggal_parameter_lab_pk_kualitas_update').val(parsed.tanggal_parameter_lab_pk_kualitas);
                }
            });
        });
    });
</script>

<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });



    $(document).ready(function() {
        $(document).on('keypress', '#min_parameter_lab_pk_tr_kualitas1', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#min_parameter_lab_pk_tr_kualitas2', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#min_parameter_lab_pk_tr_kualitas3', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#min_parameter_lab_pk_tr_kualitas4', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max_parameter_lab_pk_tr_kualitas1', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max_parameter_lab_pk_tr_kualitas2', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max_parameter_lab_pk_tr_kualitas3', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max_parameter_lab_pk_tr_kualitas4', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#min_parameter_lab_pk_butirpatah_kualitas1', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#min_parameter_lab_pk_butirpatah_kualitas2', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#min_parameter_lab_pk_butirpatah_kualitas3', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#min_parameter_lab_pk_butirpatah_kualitas4', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max_parameter_lab_pk_butirpatah_kualitas1', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max_parameter_lab_pk_butirpatah_kualitas2', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max_parameter_lab_pk_butirpatah_kualitas3', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max_parameter_lab_pk_butirpatah_kualitas4', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $('body').on('click', '#btn_delete_kualitas', function() {
            var id = $(this).data('id');
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
                        url: "{{route('qc.spv.parameter_lab_pk_kualitas_destroy')}}/" + id,
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
                            $('#table-parameter-lab').DataTable().ajax.reload();
                        }
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });

        });
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
                    if (
                        $('#tanggal_parameter_lab_pk_kualitas').val() == '' ||
                        $('#min_parameter_lab_pk_tr_kualitas1').val() == '' ||
                        $('#min_parameter_lab_pk_tr_kualitas2').val() == '' ||
                        $('#min_parameter_lab_pk_tr_kualitas3').val() == '' ||
                        $('#min_parameter_lab_pk_tr_kualitas4').val() == '' ||
                        $('#max_parameter_lab_pk_tr_kualitas1').val() == '' ||
                        $('#max_parameter_lab_pk_tr_kualitas2').val() == '' ||
                        $('#max_parameter_lab_pk_tr_kualitas3').val() == '' ||
                        $('#min_parameter_lab_pk_butirpatah_kualitas1').val() == '' ||
                        $('#min_parameter_lab_pk_butirpatah_kualitas2').val() == '' ||
                        $('#min_parameter_lab_pk_butirpatah_kualitas3').val() == '' ||
                        $('#min_parameter_lab_pk_butirpatah_kualitas4').val() == '' ||
                        $('#max_parameter_lab_pk_butirpatah_kualitas2').val() == '' ||
                        $('#max_parameter_lab_pk_butirpatah_kualitas3').val() == '' ||
                        $('#max_parameter_lab_pk_butirpatah_kualitas4').val() == '' ||
                        $('#kualitas_parameter_lab_pk1').val() == '' ||
                        $('#kualitas_parameter_lab_pk2').val() == '' ||
                        $('#kualitas_parameter_lab_pk3').val() == '' ||
                        $('#kualitas_parameter_lab_pk4').val() == ''
                    ) {
                        Swal.fire('Maaf!', 'Data Harus Diisi.', 'warning')
                    } else {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Proses Input Data...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            },
                        });
                        $('#form_lab_kualitas').submit();
                    }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
    });

    function custom_toas(type, massage) {
        if (type == 'success') {
            toastr.success(massage, "Sukses", {
                timeOut: 5e3,
                closeButton: !0,
                debug: !1,
                newestOnTop: !0,
                progressBar: !0,
                positionClass: "toast-top-right",
                preventDuplicates: !0,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: !1
            })
        } else if (type == 'erorr') {
            toastr.error(massage, "Erorr", {
                positionClass: "toast-top-right",
                timeOut: 5e3,
                closeButton: !0,
                debug: !1,
                newestOnTop: !0,
                progressBar: !0,
                preventDuplicates: !0,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: !1
            })
        }
    }
</script>
@endsection