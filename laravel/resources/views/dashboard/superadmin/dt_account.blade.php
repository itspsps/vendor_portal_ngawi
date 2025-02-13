@extends('dashboard.superadmin.layout.main')
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
                    PT. SURYA PANGAN SEMESTA
                </h3>
                <span class="btn-outline btn-sm btn-info mr-3">NGAWI</span>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        Account
                    </a>
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
                        <input type="hidden" name="id" id="id" value="{{$data->id}}">
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Nama:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" id="name_superadmin" name="name_superadmin" class="form-control m-input" value="{{$data->name}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Username:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" id="username_superadmin" name="username_superadmin" class="form-control m-input" value="{{$data->username}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Email:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" id="email_superadmin" name="email_superadmin" class="form-control m-input" value="{{$data->email}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Password:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" id="password" name="password" class="form-control m-input" value="{{$data->password_show}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Perusahan:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" id="company_superadmin" name="company_superadmin" class="form-control m-input" value="{{$data->perusahaan}}">
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
            ajax: "{{ route('sourching.vendor_index') }}",
            columns: [{
                    data: "id",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'password_show'
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
        $(document).on('click', '.toedit', function() {
            var id = $(this).attr("name");
            var url = "{{ route('sourching.vendor_show') }}" + "/" + id;

            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    var parsed = $.parseJSON(response);
                    var image = parsed.image_news;
                    $('#id').val(parsed.id);
                    $('#name').val(parsed.name);
                    $('#email').val(parsed.email);
                    $('#password').val(parsed.password_show);

                }
            });
        });
        $('body').on('click', '#btn_update', function() {
            $('#btn_update').html('Menyimpan...');
            var id = $('#id').val();
            var name_superadmin = $('#name_superadmin').val();
            var username_superadmin = $('#username_superadmin').val();
            var email_superadmin = $('#email_superadmin').val();
            var password = $('#password').val();
            var company_superadmin = $('#company_superadmin').val();
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
                if ($('#name_superadmin').val() == '' || $('username_superadmin').val() == '' || $('#email_superadmin').val() == '' || $('#password').val() == '' || $('#company_superadmin').val() == '') {
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
                                        name_superadmin: name_superadmin,
                                        username_superadmin: username_superadmin,
                                        email_superadmin: email_superadmin,
                                        password: password,
                                        company_superadmin: company_superadmin,
                                        created_at: created_at,
                                        updated_at: updated_at,
                                    },
                                    url: "{{ route('sourching.account_update') }}",
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
                                            text: 'Tanggal PO Melebihi Batas Yang Ditentukan ',
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
                            text: 'Data anda Tidak di Simpan.',
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