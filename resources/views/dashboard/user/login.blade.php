@extends('dashboard.user.layout.main1')
@section('title')
SURYA PANGAN SEMESTA
@endsection
@section('content')
@include('sweetalert::alert')

<div class="login_page_bg" style="height: 90%; background: rgb(146,137,212);
background: linear-gradient(180deg, rgba(146,137,212,1) 7%, rgba(235,233,249,1) 100%);background-size: cover; border-radius: 30px; margin-top: 10%;">
    <!-- <div class="login_page_bg" style="height: 90%; background-image: url('https://ngawi.suryapangansemesta.store/public/assets_user/assets/img/slider/bg_sawah.jpg');background-size: cover;"> -->
    <div class="container">
        <div class="customer_login">
            <div class="row">
                <!--login area start-->
                <div class="col-lg-2 col-md-2"></div>
                <div class="col-lg-8 col-md-8">
                    <div class="account_form login" style="border-radius: 10px;">
                        <form action="{{ route('user.check') }}" method="post" id="form_login" style="border-radius: 20px; box-shadow: 3px 3px 20px;">
                            <div class="icon-login text-center wow fadeInUp" data-wow-delay="0.1s">
                                <i class="fa fa-user-o " style="font-size: 80px; color: rgb(146,137,212);"></i>
                                <h2 class="mt-2" style="color: rgb(139, 128, 224); text-align: center;">&nbsp;LOGIN&nbsp;SUPPLIER</h2>
                            </div>
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

                            <div class="wow fadeInUp" data-wow-delay="0.1s">
                                <label>Nomer Telepon <span>*</span></label>
                                <input type="text" class="form-control" name="username">
                                <label class="form-label">Passwords <span>*</span></label>
                                <div class="password-input-container" style=" position: relative">
                                    <input type="password" class="form-control password-input" style="padding-right: 32px;" id="password" name="password" placeholder="">
                                    <i class="toggle-password fa fa-eye" style="color: rgb(139, 128, 224); font-size: large;  position: absolute; top: 12px; right: 10px; cursor: pointer; z-index: 9999;"></i>
                                </div>
                            </div>

                            <div class="login_submit mt-5 wow fadeInUp" data-wow-delay="0.1s">
                                <button class="btn btn-block ml-0" style="background-color: rgb(110, 97, 209);" id="btn_login">login&nbsp;<i class="fa fa-arrow-right"></i></button>
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
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
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
    window.onbeforeunload = function() {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
    };
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
        // console.log(passwordInput);
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