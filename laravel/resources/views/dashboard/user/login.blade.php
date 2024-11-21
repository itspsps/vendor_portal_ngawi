@extends('dashboard.user.layout.main1')
@section('title')
SURYA PANGAN SEMESTA
@endsection
@section('content')
@include('sweetalert::alert')

<div class="login_page_bg" style="height: 90%; background-image: url('https://ngawi.suryapangansemesta.store/public/assets_user/assets/img/slider/bg_sawah.jpg');background-size: cover;">
    <div class="container">
        <div class="customer_login">
            <div class="row">
                <!--login area start-->
                <div class="col-lg-2 col-md-2"></div>
                <div class="col-lg-8 col-md-8">
                    <div class="account_form login" style="border-radius: 10px;">
                        <h2 style="color: white; text-align: center;"><i class="fa fa-user"></i>&nbsp;LOGIN SUPPLIER</h2>
                        <form action="{{ route('user.check') }}" method="post" id="form_login">
                            @csrf
                            @if (Session::get('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                            @endif
                            @if (Session::get('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}
                            </div>
                            @endif
                            <p>
                                <label>Nomer Telepon <span>*</span></label>
                                <input type="text" class="form-control" name="username">
                            </p>
                            <div class="">
                                <label class="form-label">Passwords <span>*</span></label>
                                <div class="password-input-container" style=" position: relative">
                                    <input type="password" class="form-control password-input" style="padding-right: 32px;" id="password" name="password" placeholder="">
                                    <i class="toggle-password fa fa-eye" style="  position: absolute; top: 12px; right: 10px; cursor: pointer; z-index: 9999;"></i>
                                </div>
                            </div>

                            <div class="login_submit mt-5">
                                <button class="btn btn-block ml-0" id="btn_login">login&nbsp;<i class="fa fa-arrow-right"></i></button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).on('click', '#btn_home', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
    });
</script>
<script>
    $(document).on('click', '#btn_login', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
        $('#form_login').submit();
    });
    $(document).on('click', '#btn_profil', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
    });
</script>
<script>
    $(document).on('click', '.toggle-password', function(e) {
        var passwordInput = $($(this).siblings(".password-input"));
        console.log(passwordInput);
        var icon = $(this);
        if (passwordInput.attr("type") == "password") {
            passwordInput.attr("type", "text");
            icon.removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            passwordInput.attr("type", "password");
            icon.removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
</script>
@endsection