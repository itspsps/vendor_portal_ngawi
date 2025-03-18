@extends('dashboard.user.new_user.layouts.main')
@section('css')
<style>
    .card-menu {
        overflow: hidden;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        border: none;
        border-radius: 15px;
        background: #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .card-menu img {
        transition: transform 0.4s ease;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .card-menu:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    .card-menu:hover img {
        transform: scale(1.1);
    }

    @media only screen and (max-width: 1800px) {
        .notif_lelang {
            position: absolute;
            margin-top: -0px;
            left: 57%;
            float: right;
        }

        .count_transaksi {
            position: absolute;
            margin-top: -0px;
            left: 57%;
            float: right;
            color: white
        }

        .count_notif {
            position: absolute;
            margin-top: 0px;
            left: 55%;
            float: right;
            color: white
        }

        .count_pajak {
            position: absolute;
            margin-top: -0px;
            left: 55%;
            float: right;
            color: white
        }

        swiper-container {
            width: 100%;
            height: 100%;
        }

        .container {
            max-width: 1300px;
        }


        swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        swiper-slide {
            width: 70%;
        }

        swiper-slide:nth-last-child() {
            width: 10%;
        }

        .icon-menu {
            font-size: 40px;
        }

        .text_notif {
            font-size: 9px;

        }

        .text-menu1 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu2 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu3 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu4 {
            margin-top: -2%;
            font-size: 9px;
        }

        .text-menu5 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu6 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu7 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu8 {
            margin-top: 0%;
            font-size: 9px;
        }

        .card-menu {
            height: 80px;
        }

        .text-pengajuan {
            font-size: 9pt;
            text-align: left;
            margin-left: -10%;
            padding: 0px;
        }

        .home_section_bg {
            margin-top: -5%;
            margin-left: 5%;
            margin-right: 5%;
        }
    }

    @media only screen and (max-width: 1300px) {
        .notif_lelang {
            position: absolute;
            margin-top: -0px;
            left: 57%;
            float: right;
        }

        .count_transaksi {
            position: absolute;
            margin-top: -0px;
            left: 57%;
            float: right;
            color: white
        }

        .count_notif {
            position: absolute;
            margin-top: 0px;
            left: 55%;
            float: right;
            color: white
        }

        .count_pajak {
            position: absolute;
            margin-top: -0px;
            left: 55%;
            float: right;
            color: white
        }

        swiper-container {
            width: 100%;
            height: 100%;
        }

        .container {
            max-width: 1300px;
        }


        swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        swiper-slide {
            width: 70%;
        }

        swiper-slide:nth-last-child() {
            width: 10%;
        }

        .icon-menu {
            font-size: 40px;
        }

        .text_notif {
            font-size: 9px;

        }

        .text-menu1 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu2 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu3 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu4 {
            margin-top: -2%;
            font-size: 9px;
        }

        .text-menu5 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu6 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu7 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu8 {
            margin-top: 0%;
            font-size: 9px;
        }

        .card-menu {
            height: 80px;
        }

        .text-pengajuan {
            font-size: 9pt;
            text-align: left;
            margin-left: -10%;
            padding: 0px;
        }

        .home_section_bg {
            margin-top: -7%;
            margin-left: 5%;
            margin-right: 5%;
        }
    }

    @media only screen and (max-width: 1000px) {
        .icon_logo_vp {
            width: 50%;
        }

        .notif_lelang {
            position: absolute;
            margin-top: -0px;
            left: 62%;
            float: right;
        }

        .count_transaksi {
            position: absolute;
            margin-top: -0px;
            left: 63%;
            float: right;
            color: white
        }

        .count_notif {
            position: absolute;
            margin-top: 0px;
            left: 60%;
            float: right;
            color: white
        }

        .count_pajak {
            position: absolute;
            margin-top: -0px;
            left: 62%;
            float: right;
            color: white
        }


        swiper-container {
            width: 100%;
            height: 100%;
        }

        .container {
            max-width: 1000px;
        }


        swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        swiper-slide {
            width: 80%;
        }

        swiper-slide:nth-last-child() {
            width: 10%;
        }

        .icon-menu {
            font-size: 40px;
        }

        .text_notif {
            font-size: 9px;

        }

        .text-menu1 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu2 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu3 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu4 {
            margin-top: -2%;
            font-size: 9px;
        }

        .text-menu5 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu6 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu7 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu8 {
            margin-top: 0%;
            font-size: 9px;
        }

        .card-menu {
            height: 80px;
        }

        .text-pengajuan {
            font-size: 8pt;
            text-align: left;
            margin-left: -10%;
            padding: 0px;
        }

        .home_section_bg {
            margin-top: -10%;
            margin-left: 5%;
            margin-right: 5%;
        }
    }

    @media only screen and (max-width: 800px) {
        .icon_logo_vp {
            width: 100%;
        }

        .notif_lelang {
            position: absolute;
            margin-top: -0px;
            left: 62%;
            float: right;
        }

        .count_transaksi {
            position: absolute;
            margin-top: -0px;
            left: 63%;
            float: right;
            color: white
        }

        .count_notif {
            position: absolute;
            margin-top: 0px;
            left: 60%;
            float: right;
            color: white
        }

        .count_pajak {
            position: absolute;
            margin-top: -0px;
            left: 62%;
            float: right;
            color: white
        }

        swiper-container {
            width: 100%;
            height: 100%;
        }

        .container {
            max-width: 800px;
        }


        swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        swiper-slide {
            width: 90%;
        }

        swiper-slide:nth-last-child() {
            width: 10%;
        }

        .icon-menu {
            font-size: 40px;
        }

        .text_notif {
            font-size: 9px;

        }

        .text-menu1 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu2 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu3 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu4 {
            margin-top: -2%;
            font-size: 9px;
        }

        .text-menu5 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu6 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu7 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu8 {
            margin-top: 0%;
            font-size: 9px;
        }

        .card-menu {
            height: 80px;
        }

        .text-pengajuan {
            font-size: 8pt;
            text-align: left;
            margin-left: -10%;
            padding: 0px;
        }

        .home_section_bg {
            margin-top: -15%;
            margin-left: 5%;
            margin-right: 5%;
        }
    }

    @media only screen and (max-width: 700px) {
        .icon_logo_vp {
            width: 100%;
        }

        .notif_lelang {
            position: absolute;
            margin-top: -0px;
            left: 65%;
            float: right;
        }

        .count_transaksi {
            position: absolute;
            margin-top: -0px;
            left: 67%;
            float: right;
            color: white
        }

        .count_notif {
            position: absolute;
            margin-top: 0px;
            left: 62%;
            float: right;
            color: white
        }

        .count_pajak {
            position: absolute;
            margin-top: -0px;
            left: 65%;
            float: right;
            color: white
        }



        swiper-container {
            width: 100%;
            height: 100%;
        }

        .container {
            max-width: 700px;
        }


        swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        swiper-slide {
            width: 90%;
        }

        swiper-slide:nth-last-child() {
            width: 10%;
        }

        .icon-menu {
            font-size: 40px;
        }

        .text_notif {
            font-size: 9px;

        }

        .text-menu1 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu2 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu3 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu4 {
            margin-top: -2%;
            font-size: 9px;
        }

        .text-menu5 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu6 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu7 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu8 {
            margin-top: 0%;
            font-size: 9px;
        }

        .card-menu {
            height: 80px;
        }

        .text-pengajuan {
            font-size: 8pt;
            text-align: left;
            margin-left: -10%;
            padding: 0px;
        }

        .home_section_bg {
            margin-top: -20%;
            margin-left: 5%;
            margin-right: 5%;
        }
    }

    @media only screen and (max-width: 600px) {
        .icon_logo_vp {
            width: 100%;
        }

        .notif_lelang {
            position: absolute;
            margin-top: -0px;
            left: 65%;
            float: right;
        }

        .count_transaksi {
            position: absolute;
            margin-top: -0px;
            left: 67%;
            float: right;
            color: white
        }

        .count_notif {
            position: absolute;
            margin-top: 0px;
            left: 62%;
            float: right;
            color: white
        }

        .count_pajak {
            position: absolute;
            margin-top: -0px;
            left: 65%;
            float: right;
            color: white
        }


        swiper-container {
            width: 100%;
            height: 100%;
        }

        .container {
            max-width: 600px;
        }

        swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        swiper-slide {
            width: 90%;
        }

        swiper-slide:nth-last-child() {
            width: 10%;
        }

        .icon-menu {
            font-size: 40px;
        }

        .text_notif {
            font-size: 9px;

        }

        .text-menu1 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu2 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu3 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu4 {
            margin-top: -2%;
            font-size: 9px;
        }

        .text-menu5 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu6 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu7 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu8 {
            margin-top: 0%;
            font-size: 9px;
        }

        .card-menu {
            height: 80px;
        }

        .text-pengajuan {
            font-size: 8pt;
            text-align: left;
            margin-left: -10%;
            padding: 0px;
        }

        .home_section_bg {
            margin-top: -20%;
            margin-left: 5%;
            margin-right: 5%;
        }
    }

    @media only screen and (max-width: 500px) {
        .icon_logo_vp {
            width: 100%;
        }

        .notif_lelang {
            position: absolute;
            margin-top: -0px;
            left: 65%;
            float: right;
        }

        .count_transaksi {
            position: absolute;
            margin-top: -0px;
            left: 70%;
            float: right;
            color: white
        }

        .count_notif {
            position: absolute;
            margin-top: 0px;
            left: 70%;
            float: right;
            color: white
        }

        .count_pajak {
            position: absolute;
            margin-top: -0px;
            left: 70%;
            float: right;
            color: white
        }

        .home_section_bg {
            margin-top: -30%;
            margin-left: 5%;
            margin-right: 5%;
        }

        swiper-container {
            width: 100%;
            height: 100%;
        }

        swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        swiper-slide {
            width: 90%;
        }

        swiper-slide:nth-last-child() {
            width: 10%;
        }

        .icon-menu {
            font-size: 40px;
        }

        .text_notif {
            font-size: 9px;

        }

        .text-menu1 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu2 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu3 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu4 {
            margin-top: -2%;
            font-size: 9px;
        }

        .text-menu5 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu6 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu7 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu8 {
            margin-top: -5%;
            font-size: 9px;
        }

        .card-menu {
            height: 80px;
        }

        .text-pengajuan {
            font-size: 7pt;
            text-align: left;
            margin-left: -15%;
            padding: 0px;
        }
    }

    @media only screen and (max-width: 455px) {

        .icon_logo_vp {
            width: 100%;
        }

        .notif_lelang {
            position: absolute;
            margin-top: -0px;
            left: 47%;
            float: right;
        }

        .count_transaksi {
            position: absolute;
            margin-top: -0px;
            left: 63%;
            float: right;
            color: white
        }

        .count_notif {
            position: absolute;
            margin-top: 0px;
            left: 60%;
            float: right;
            color: white
        }

        .count_pajak {
            position: absolute;
            margin-top: -0px;
            left: 65%;
            float: right;
            color: white
        }


        .home_section_bg {
            margin-top: -30%;
            margin-left: 5%;
            margin-right: 5%;
        }

        swiper-container {
            width: 100%;
            height: 100%;
        }

        swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        swiper-slide {
            width: 90%;
        }

        swiper-slide:nth-last-child() {
            width: 10%;
        }

        .icon-menu {
            font-size: 40px;
        }

        .text_notif {
            font-size: 9px;

        }

        .text-menu1 {
            margin-top: -10%;
            font-size: 9px;
        }

        .text-menu2 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu3 {
            margin-top: -2%;
            font-size: 9px;
        }

        .text-menu4 {
            margin-top: -2%;
            font-size: 9px;
        }

        .text-menu5 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu6 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu7 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu8 {
            margin-top: -10%;
            font-size: 9px;
        }

        .card-menu {
            height: 80px;
        }

        .text-pengajuan {
            font-size: 7pt;
            text-align: left;
            margin-left: -15%;
            padding: 0px;
        }
    }

    @media only screen and (max-width: 350px) {
        .icon_logo_vp {
            width: 100%;
        }

        .notif_lelang {
            position: absolute;
            margin-top: -0px;
            left: 43%;
            float: right;
        }

        .count_transaksi {
            position: absolute;
            margin-top: 0px;
            left: 60%;
            float: right;
            color: white
        }

        .count_notif {
            position: absolute;
            margin-top: 0px;
            left: 50%;
            float: right;
            color: white
        }

        .count_pajak {
            position: absolute;
            margin-top: -0px;
            left: 60%;
            float: right;
            color: white
        }

        .home_section_bg {
            margin-top: -30%;
            margin-left: 5%;
            margin-right: 5%;
        }

        .text-pengajuan {
            font-size: 7pt;
            text-align: left;
            margin-left: -22%;
            padding: 0;
        }

        swiper-container {
            width: 100%;
            height: 100%;
        }

        swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        swiper-slide {
            width: 80%;
        }


        .icon-menu {
            font-size: 40px;
        }

        .text_notif {
            font-size: 9px;

        }

        .text-menu1 {
            margin-top: -10%;
            font-size: 9px;
        }

        .text-menu2 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu3 {
            margin-top: -2%;
            font-size: 9px;
        }

        .text-menu4 {
            margin-top: -2%;
            font-size: 9px;
        }

        .text-menu5 {
            margin-top: -10%;
            font-size: 9px;
        }

        .text-menu6 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu7 {
            margin-top: 0%;
            font-size: 9px;
        }

        .text-menu8 {
            margin-top: 0%;
            font-size: 9px;
        }

        .card-menu {
            height: 80px;
        }
    }
</style>
@endsection
@section('content')
@include('sweetalert::alert')
<div class="home_section_bg" style="box-shadow: 3px 3px 20px; background: rgb(255, 255, 255);background-size: cover; height: 100%; border-radius: 20px;">
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
    <div class="product_area deals_product">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <form action="{{ route('user.check') }}" method="post" id="form_login">
                <div class="pt-3 icon-login text-center wow fadeInUp" data-wow-delay="0.1s">
                    <i class="fa fa-user" style="font-size: 80px; color: rgb(146,137,212);"></i>
                    <h2 class="mt-2" style="color: rgb(139, 128, 224); text-align: center;">&nbsp;LOGIN&nbsp;SUPPLIER</h2>
                </div>
                @csrf
                <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row g-3 p-4">
                        <div class="col-md-6">
                            <div class="position-relative w-100 mt-3">
                                <input class="form-control border-1 rounded-pill w-100 ps-4 pe-5" type="text" id="username" name="username" placeholder="Nomor HP" style="height: 40px;">
                                <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i class="fa fa-phone fs-4" style="color: rgb(139, 128, 224);"></i></button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative w-100 mt-3">
                                <input class="form-control password-input border-1 rounded-pill w-100 ps-4 pe-5" type="password" id="password" name="password" placeholder="Password" style="height: 40px;">
                                <button type="button" class="btn toggle-password shadow-none position-absolute top-0 end-0 mt-1 me-2"><i class="fa fa-unlock fs-4" style="color: rgb(139, 128, 224);"></i></button>
                            </div>
                            <div class="form-check" style="text-align:left;">
                                <label class="form-check-label" for="password_show">
                                    Tampilkan Password
                                </label>
                                <input class="form-check-input" type="checkbox" value="" id="password_show">
                            </div>
                        </div>
                        <div class="login_submit mt-5 wow fadeInUp" data-wow-delay="0.1s">
                            <button class="btn btn-sm btn-block btn-rounded-circle ml-0 text-white" style="background-color: rgb(110, 97, 209); width: 100%;" id="btn_login">LOGIN&nbsp;<i class="fa fa-arrow-right"></i></button>
                            <a id="btn_klik" class="text-center text-primary-gradient" href="{{route('user.lupa_password')}}">Lupa Password</a>
                        </div>
                    </div>
                </div>

            </form>
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
    $(document).on('click', '#btn_klik', function(e) {
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