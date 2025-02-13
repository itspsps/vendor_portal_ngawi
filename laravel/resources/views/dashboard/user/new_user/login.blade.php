@extends('dashboard.user.new_user.layouts.main')

@section('css')
<style>
    body {
        background-color: white;
    }
</style>
@endsection
@section('content')
@include('sweetalert::alert')
<div class="container-xxl bg-white p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 1rem; height: 1rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-primary" style="width: 1rem; height: 1rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-primary" style="width: 1rem; height: 1rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar & Hero Start -->
    <div class="container-xxl position-relative p-0" id="home">

        <div class="container-xxl bg-primary hero-header">
            <div class="container px-lg-5">
                <div class="row g-5">
                    <div class="col-lg-8 text-center text-lg-start">
                        <h1 class="text-white mb-4 animated slideInDown">LOGIN SUPPLIER</h1>
                        <!-- <p class="text-white pb-3 animated slideInDown">Tempor rebum no at dolore lorem clita rebum rebum ipsum rebum stet dolor sed justo kasd. Ut dolor sed magna dolor sea diam. Sit diam sit justo amet ipsum vero ipsum clita lorem</p>
                        <a href="" class="btn btn-primary-gradient py-sm-3 px-4 px-sm-5 rounded-pill me-3 animated slideInLeft">Read More</a>
                        <a href="" class="btn btn-secondary-gradient py-sm-3 px-4 px-sm-5 rounded-pill animated slideInRight">Contact Us</a> -->

                        <form id="form_login" method="POST" action="{{route('user.new_check')}}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="position-relative w-100 mt-3">
                                        <input class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text" id="username" name="username" placeholder="Nomor HP" style="height: 48px;">
                                        <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i class="fa fa-phone text-primary-gradient fs-4"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative w-100 mt-3">
                                        <input class="form-control password-input border-0 rounded-pill w-100 ps-4 pe-5" type="password" id="password" name="password" placeholder="Password" style="height: 48px;">
                                        <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i class="fa fa-unlock text-primary-gradient fs-4"></i></button>
                                    </div>
                                    <div class="form-check" style="text-align:left;">
                                        <label class="form-check-label text-white" for="password_show">
                                            Tampilkan Password
                                        </label>
                                        <input class="form-check-input" type="checkbox" value="" id="password_show">
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button id="btn_login" class="btn btn-sm btn-primary-gradient rounded-pill py-3 px-5">LOGIN</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).on('click', '#btn_login', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            html: ' <div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div>',
            showCancelButton: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
                // Swal.showLoading()
            },
        });
        $('#form_login').submit();
    });
    window.onbeforeunload = function() {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            html: ' <div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div>',
            showCancelButton: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
                // Swal.showLoading()
            },
        });
    };
    $("document").ready(function() {
        $('#password_show').change(function() {
            var x = document.getElementById("password");
            var ok = $(this).is(':checked');
            if (ok == true) {
                x.type = "text";
            } else {
                x.type = "password";

            }
        });
    });
</script>
@endsection