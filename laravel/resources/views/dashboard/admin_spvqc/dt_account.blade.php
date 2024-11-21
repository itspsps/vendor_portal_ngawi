@extends('dashboard.admin_spvqc.layout.main')
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
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter kt-font-info"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{route('qc.spv.home')}}" class="kt-subheader__breadcrumbs-link">
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

        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="flaticon2-user-1 kt-font-info"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Update Akun
                        </h3>
                    </div>
                </div>
                <form method="post" id="form_account" action="javascript:void(0);" enctype="multipart/form-data">
                    @csrf
                    <div class="kt-portlet__body">
                        <input type="hidden" name="id" id="id" value="{{$data->id_spv_qc}}">
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Nama:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" id="name_spv_qc" name="name_spv_qc" class="form-control m-input" value="{{$data->name_spv_qc}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Username:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" id="username_spv_qc" name="username_spv_qc" class="form-control m-input" value="{{$data->username}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Email:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" id="email_spv_qc" name="email_spv_qc" class="form-control m-input" value="{{$data->email}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Password:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" id="password" name="password" class="form-control m-input" value="{{$data->password_show}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Telepon:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" id="phone_spv_qc" name="phone_spv_qc" class="form-control m-input" value="{{$data->phone_spv_qc}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Perusahan:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" id="company_spv_qc" name="company_spv_qc" class="form-control m-input" value="{{$data->perusahaan}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Site:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" class="form-control m-input" readonly value="{{$data->site_spv_qc}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Tanggal Buat:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" id="created_at" name="created_at" class="form-control m-input" readonly value="{{$data->created_at}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Tanggal Update:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" id="updated_at" name="updated_at" class="form-control m-input" readonly value="{{$data->updated_at}}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                            <button id="btn_update" class="btn btn-success m-btn pull-right">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- end:: Content -->
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    $(function() {
        $('body').on('click', '#btn_update', function() {
            $('#btn_update').html('Menyimpan...');
            var id = $('#id').val();
            var name_spv_qc = $('#name_spv_qc').val();
            var username_spv_qc = $('#username_spv_qc').val();
            var email_spv_qc = $('#email_spv_qc').val();
            var password = $('#password').val();
            var phone_spv_qc = $('#phone_spv_qc').val();
            var company_spv_qc = $('#company_spv_qc').val();
            var created_at = $('#created_at').val();
            var updated_at = $('#updated_at').val();
            Swal.fire({
                title: 'Konfirmasi',
                icon: 'warning',
                text: "Apakah data yang kamu input sudah benar ?",
                showCancelButton: true,
                inputValue: 0,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if ($('#name_spv_qc').val() == '' || $('username_spv_qc').val() == '' || $('#email_spv_qc').val() == '' || $('#password').val() == '' || $('#company_spv_qc').val() == '' || $('#phone_spv_qc').val() == '') {
                    Swal.fire({
                        title: 'Info !!',
                        text: 'Data Harus Terisi Semua',
                        icon: 'warning',
                        timer: 1500
                    })
                    $("#form_account").trigger('reset');
                    $('#btn_update').html('Simpan');
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
                                        id: id,
                                        name_spv_qc: name_spv_qc,
                                        username_spv_qc: username_spv_qc,
                                        email_spv_qc: email_spv_qc,
                                        password: password,
                                        phone_spv_qc: phone_spv_qc,
                                        company_spv_qc: company_spv_qc,
                                        created_at: created_at,
                                        updated_at: updated_at,
                                    },
                                    url: "{{ route('qc.spv.account_update') }}",
                                    type: "POST",
                                    dataType: 'json',
                                    success: function(data) {
                                        $('#btn_update').html('Simpan');
                                        Swal.fire({
                                            title: 'success',
                                            text: 'Data Berhasil DiSimpan',
                                            icon: 'success',
                                            timer: 1500
                                        })

                                    },
                                    error: function(data) {
                                        $('#btn_update').html('Simpan');
                                        $("#form_account").trigger('reset');
                                        Swal.fire({
                                            title: 'Gagal',
                                            text: 'Data Tidak Tersimpan',
                                            icon: 'error',
                                            timer: 1500
                                        })

                                    }
                                });
                            },
                        });
                    } else {
                        $("#form_account").trigger('reset');
                        $('#btn_update').html('Simpan');
                        Swal.fire({
                            title: 'Gagal !',
                            text: 'Data anda Tidak Terimpan.',
                            icon: 'error',
                            timer: 1500
                        })
                    }
                }
            });
        });
    });
</script>
@endsection