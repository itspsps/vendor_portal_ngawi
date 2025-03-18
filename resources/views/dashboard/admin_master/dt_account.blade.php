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
                        <input type="hidden" name="id" id="id" value="{{$data->id }}">
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Nama:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" id="name_master" name="name_master" class="form-control m-input" value="{{$data->name_master}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Username:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" id="username_master" name="username_master" class="form-control m-input" value="{{$data->username}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Email:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" id="email_master" name="email_master" class="form-control m-input" value="{{$data->email}}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Password:</label>
                            <div class="col-xl-9 col-lg-9">
                                <div class="input-group mb-3 password-field">
                                    <input class="form-control password" id="password" class="block mt-1 w-full" type="password" name="password" value="{{$data->password_show}}" />
                                    <span class="input-group-text togglePassword" id="">
                                        <i id="icon-password" class="" style="cursor: pointer"></i>
                                    </span>
                                </div>
                                <span class="btn btn-label-danger text-left print-error-msg" style="display:none">
                                    <ul></ul>
                                </span>
                                <div class="content-password">
                                    <p>Password Harus Berisi :</p>
                                    <ul class="requirement-list">
                                        <li>
                                            <i class="fa fa-circle"></i>
                                            <span>Minimal Panjang 8 Karakter</span>
                                        </li>
                                        <li>
                                            <i class="fa fa-circle"></i>
                                            <span>Minimal Ada 1 Angka (0...9)</span>
                                        </li>
                                        <li>
                                            <i class="fa fa-circle"></i>
                                            <span>Minimal Ada 1 Huruf Kecil (a...z)</span>
                                        </li>
                                        <li>
                                            <i class="fa fa-circle"></i>
                                            <span>Minimal Ada 1 Simbol Kusus (!...$)</span>
                                        </li>
                                        <li>
                                            <i class="fa fa-circle"></i>
                                            <span>Minimal Ada 1 Huruf Besar (A...Z)</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">* Perusahan:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" id="company_master" name="company_master" class="form-control m-input" value="{{$data->perusahaan}}">
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
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.querySelector(".togglePassword i");
        const requirementList = document.querySelectorAll(".requirement-list li");
        // An array of password requirements with corresponding 
        // regular expressions and index of the requirement list item
        const requirements = [{
                regex: /.{8,}/,
                index: 0
            }, // Minimum of 8 characters
            {
                regex: /[0-9]/,
                index: 1
            }, // At least one number
            {
                regex: /[a-z]/,
                index: 2
            }, // At least one lowercase letter
            {
                regex: /[^A-Za-z0-9]/,
                index: 3
            }, // At least one special character
            {
                regex: /[A-Z]/,
                index: 4
            }, // At least one uppercase letter
        ]
        const password_old = '{{$data->password_show}}';
        requirements.forEach(item => {
            // Check if the password matches the requirement regex
            const isValid = item.regex.test(password_old);
            const requirementItem = requirementList[item.index];
            // Updating class and icon of requirement item if requirement matched or not
            if (isValid) {
                requirementItem.classList.add("valid");
                requirementItem.firstElementChild.className = "flaticon2-check-mark kt-font-success";
            } else {
                requirementItem.classList.remove("valid");
                requirementItem.firstElementChild.className = "fa fa-circle";
            }
        });
        passwordInput.addEventListener("keyup", (e) => {
            requirements.forEach(item => {
                $(".print-error-msg").css('display', 'none');
                $(".content-password").css('display', 'block');
                // Check if the password matches the requirement regex
                const isValid = item.regex.test(e.target.value);
                const requirementItem = requirementList[item.index];
                // Updating class and icon of requirement item if requirement matched or not
                if (isValid) {
                    requirementItem.classList.add("valid");
                    requirementItem.firstElementChild.className = "flaticon2-check-mark kt-font-success";
                } else {
                    requirementItem.classList.remove("valid");
                    requirementItem.firstElementChild.className = "fa fa-circle";
                }
            });
        });
        eyeIcon.addEventListener("click", () => {
            // Toggle the password input type between "password" and "text"
            passwordInput.type = passwordInput.type === "password" ? "text" : "password";
            // Update the eye icon class based on the password input type
            eyeIcon.className = `fa fa-eye${passwordInput.type === "password" ? "" : "-slash"}`;
        });
        $('#icon-password').addClass("fa fa-eye");


        $('body').on('click', '#btn_update', function() {
            $('#btn_update').html('Menyimpan...');
            var id = $('#id').val();
            var name_master = $('#name_master').val();
            var username_master = $('#username_master').val();
            var email_master = $('#email_master').val();
            var password = $('#password').val();
            var company_master = $('#company_master').val();
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
                                    name_master: name_master,
                                    username_master: username_master,
                                    email_master: email_master,
                                    password: password,
                                    company_master: company_master,
                                    created_at: created_at,
                                    updated_at: updated_at,
                                },
                                url: "{{ route('master.account_update') }}",
                                type: "POST",
                                dataType: 'json',
                                success: function(data) {
                                    // console.log(data);
                                    $('#btn_update').html('Simpan');
                                    $('.alert_validate').remove();
                                    Swal.fire({
                                        title: 'success',
                                        text: 'Data Berhasil DiSimpan',
                                        icon: 'success',
                                        timer: 1500
                                    })

                                },
                                error: function(data) {
                                    $('.alert_validate').remove();
                                    $.each(data.responseJSON.errors, function(field_name, error) {
                                        console.log(field_name);
                                        // $('[name=' + field_name + ']').next('.alert_validate').remove();
                                        if (field_name == 'company_master') {
                                            // $('.alert_validate').show();
                                            $(document).find('[name=' + field_name + ']').after('<span class="btn btn-label-danger alert_validate">Perusahaan Tidak Boleh Kosong</span>')
                                        } else if (field_name == 'password') {
                                            // console.log(data.responseJSON.errors.password);
                                            $(".print-error-msg").find("ul").html('');
                                            $(".print-error-msg").css('display', 'block');
                                            $(".content-password").css('display', 'none');
                                            $.each(data.responseJSON.errors.password, function(key, value) {

                                                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');

                                            });

                                        } else if (field_name == 'name_master') {
                                            $(document).find('[name=' + field_name + ']').after('<span class="btn btn-label-danger alert_validate">Nama Tidak Boleh Kosong</span>')
                                        } else if (field_name == 'username_master') {
                                            $(document).find('[name=' + field_name + ']').after('<span class="btn btn-label-danger alert_validate">Username Tidak Boleh Kosong</span>')
                                        }
                                    })
                                    $('#btn_update').html('Simpan');
                                    $("#form_account").trigger('change');
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: 'Data Gagal Disimpan ',
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

            });
        });
    });
</script>
@endsection