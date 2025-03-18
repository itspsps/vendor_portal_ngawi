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
                                    <i class="flaticon-add-circular-button"></i> Tambah Potongan
                                </div>
                            </div>
                            <div id="collapseOne4" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample4">
                                <div class="card-body">
                                    <form id="formgt04" class="kt-form" id="kt_apps_user_add_user_form" action="{{ route('qc.lab.store_potongan_beras_ds') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-wizard-v4__form">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="kt-section__body">
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Potongan</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="number" id="potongan_bongkar_gt_04" class="form-control" required name="potongan_bongkar_gt_04">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Transparasi (TR)</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="number" id="potongan_bongkar_gt_04" class="form-control" required name="transparasi">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Date</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="date" id="waktu_potongan_bongkar_gt_04" class="form-control" required name="waktu_potongan_bongkar_gt_04">
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
                            <i class="flaticon-user"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data Potongan Beras DS
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-bordered" id="potongan">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:2%">No</th>
                                <th style="text-align: center;width:auto">Potongan</th>
                                <th style="text-align: center;width:auto">Transparasi (TR)</th>
                                <th style="text-align: center;width:auto">Waktu </th>
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
                    <form id="formupdategt04" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('qc.lab.update_potongan_beras_ds') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Potongan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_potongan_bongkar_gt_04_update" id="id_potongan_bongkar_gt_04_update" value="">
                            <div class="form-group">
                                <div class="">
                                    <label>Harga Potongan</label>
                                    <input id="potongan_bongkar_gt_04_update" required name="potongan_bongkar_gt_04_update" placeholder="" type="number" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Transparasi</label>
                                    <input id="transparasi" required name="transparasi" placeholder="" type="number" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Waktu</label>
                                    <input id="waktu_potongan_bongkar_gt_04_update" required name="waktu_potongan_bongkar_gt_04_update" placeholder="" type="date" class="form-control m-input">
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
        var table = $('#potongan').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('qc.lab.potongan_beras_ds_index') }}",
            columns: [{
                    data: "id_harga_bawah",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'potongan_bongkar_gt_04'
                },
                {
                    data: 'transparasi'
                },
                {
                    data: 'waktu_potongan_bongkar_gt_04'
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
                    if ($('#potongan_bongkar_gt_04').val() == '' || $('#waktu_potongan_bongkar_gt_04').val() == '') {
                        Swal.fire('Gagal!', 'Data Harus Terisi.', 'error')

                    } else {
                        $('#formgt04').submit();
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
                    if ($('#potongan_bongkar_gt_04_update').val() == '' || $('#waktu_potongan_bongkar_gt_04_update').val() == '') {
                        Swal.fire('Gagal!', 'Data Harus Terisi', 'error')
                    } else {
                        $('#formupdategt04').submit();
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
                        url: "{{url('qc/lab/destroy_potongan_beras_ds')}}/" + cek,
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
                            $('#potongan').DataTable().ajax.reload();
                        }
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });

        });
        $(document).on('click', '.to_potongan_bongkar_gt_04', function() {
            var id = $(this).attr("name");
            var url = '{{ route('
            qc.lab.show_potongan_beras_ds ') }}' + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_potongan_bongkar_gt_04_update').val(parsed.id_potongan_bongkar_gt_04_ds);
                    $('#transparasi').val(parsed.transparasi_ds);
                    $('#potongan_bongkar_gt_04_update').val(parsed.potongan_bongkar_gt_04_ds);
                    $('#waktu_potongan_bongkar_gt_04_update').val(parsed.waktu_potongan_bongkar_gt_04_ds);
                }
            });
        });
    });
</script>
@endsection