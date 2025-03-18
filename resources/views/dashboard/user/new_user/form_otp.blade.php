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

    .otp-container {
        text-align: center;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .otp-input {
        width: 40px;
        height: 40px;
        font-size: 20px;
        text-align: center;
        margin: 5px;
        border: 2px solid #6c757d;
        border-radius: 5px;
    }

    .otp-input:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
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
            <div class="pt-3 icon-login text-center wow fadeInUp" data-wow-delay="0.1s">
                <h2 class="mt-2" style="color: rgb(139, 128, 224); text-align: center;">Masukkan Kode OTP</h2>
            </div>
            <div class="wow fadeInUp" data-wow-delay="0.1s">
                <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row g-3 p-4">
                        <div class="position-relative w-100 mt-3">
                            <input type="text" name="id_kategori" id="id_kategori" value="{{$data->id_kategori}}">
                            <input type="text" name="id_user" id="id_user" value="{{$data->user_id}}">
                            <input type="text" name="nomor_hp" id="nomor_hp" value="{{$data->nomor}}">
                            <input type="text" name="email" id="email" value="{{$data->email}}">
                            <input type="text" name="id_pass" id="id_pass" value="{{$data->id}}">
                            <input type="text" name="expired_at" id="expired_at" value="{{$data->expired_at}}">
                            <div class="otp-container">
                                <form id="otp-form">
                                    @csrf
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="d-flex align-items-center justify-content-center" style=" width: 40px;height: 40px;font-size: 20px; text-align: center; margin-top:2%;">
                                            <h3 style="color: rgb(110, 97, 209);">VP-</h3>
                                        </div>
                                        <input type="text" class="otp-input form-control" maxlength="1">
                                        <input type="text" class="otp-input form-control" maxlength="1">
                                        <input type="text" class="otp-input form-control" maxlength="1">
                                        <input type="text" class="otp-input form-control" maxlength="1">
                                    </div>
                                    <p class="time">
                                    </p>
                                    <span id="alert_error" class="badge bg-danger">
                                    </span>
                                    <div class="login_submit wow fadeInUp" data-wow-delay="0.1s">
                                        <button type="button" class="btn btn-sm btn-block btn-rounded-circle ml-0 text-white" style="background-color: rgb(110, 97, 209); width: 100%;" id="btn_verified">Verifikasi</button>
                                        <button type="button" class="btn btn-sm btn-block btn-rounded-circle ml-0 text-white" style="background-color: rgb(110, 97, 209); width: 100%;" id="btn_resend">Kirim Ulang OTP</button>
                                        <a id="btn_klik" class="text-center text-primary-gradient" href="{{route('user.lupa_password')}}">Kembali</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-bottom" style="box-shadow: 3px 3px 20px; border-radius: 20px 20px 0px 0px; height: max-content;" tabindex="-1" id="notif" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-body small">
            <div class="text-center mb-4">
                <div id="icon" style="display: flex; justify-content: center; align-items: center;">
                </div>
                <h6 id="content_notif"></h6>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.9.6/lottie.min.js"></script>
<script>
    // Set the date we're counting down to
    var expired_at = $('#expired_at').val();
    // console.log(expired_at);
    var countDownDate = new Date(expired_at).getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        if (minutes < 9) {
            var fix_min = '0' + minutes;
        } else {
            var fix_min = minutes;

        }
        if (seconds < 9) {
            var fix_sec = '0' + seconds;
        } else {
            var fix_sec = seconds;

        }
        // Display the result in the element with id="demo"
        $(".time").html(fix_min + ':' + fix_sec);

        $('#alert_error').hide();
        $('#btn_resend').hide();
        $('#btn_verified').show();
        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            $('#alert_error').show();
            $('#alert_error').html("Kode Expired");
            $('.time').empty();
            $('#btn_verified').hide();
            $('#btn_resend').show();

        }
    }, 1000);
</script>
<script>
    $(document).ready(function() {
        $('.otp-input').on('input', function() {
            if ($(this).val().length === 1) {
                $(this).next('.otp-input').focus();
            }
        });

        $('.otp-input').on('keydown', function(e) {
            if (e.key === "Backspace" && $(this).val() === "") {
                $(this).prev('.otp-input').focus();
            }
        });


    });

    function replace_titik(x) {
        return ((x.replace('-', '')).replace('-', '')).replace('-', '');
    }
    var offcanvasElement = new bootstrap.Offcanvas(document.getElementById("notif"));
    $(document).on('click', '#btn_verified', function(e) {
        e.preventDefault();
        var id_kategori = $('#id_kategori').val();
        var id_user = $('#id_user').val();
        var nomor_hp = $('#nomor_hp').val();
        var email = $('#email').val();
        var id_pass = $('#id_pass').val();
        var expired_at = $('#expired_at').val();
        let otp = '';
        $('.otp-input').each(function() {
            otp += $(this).val();
        });
        if (otp == '') {
            $('#content_notif').html('Silahkan Masukan Kode OTP');
            var newDiv = $('<div class="lottie-animation"></div>');
            $("#icon").empty();
            $('#icon').append(newDiv);
            lottie.loadAnimation({
                container: newDiv[0], // Elemen target
                renderer: 'svg', // Bisa 'canvas' atau 'html'
                loop: true, // Animasi terus berjalan
                autoplay: true, // Mulai otomatis
                path: "{{ asset('assets_user/assets/animation/close.json') }}" // Path ke file JSON (harus ada di folder public)
            });
            $(".lottie-animation").css({
                "width": "100px",
                "height": "100px",
                "display": "inline-block",
            });
            offcanvasElement.show();
        } else {
            Swal.fire({
                allowOutsideClick: false,
                background: 'transparent',
                html: ' <div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div>',
                showCancelButton: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    $.ajax({
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id_kategori: id_kategori,
                            email: email,
                            nomor_hp: nomor_hp,
                            id_user: id_user,
                            id_pass: id_pass,
                            expired_at: expired_at,
                        },
                        url: "{{ route('user.send_verified_otp') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {
                            if (data.code == 200) {
                                window.location.href = "{{url('user/form_otp')}}/" + data.data;
                                $('#content_notif').html('Silahkan Masukan Kode OTP');
                                var newDiv = $('<div class="lottie-animation"></div>');
                                $("#icon").empty();
                                $('#icon').append(newDiv);
                                lottie.loadAnimation({
                                    container: newDiv[0], // Elemen target
                                    renderer: 'svg', // Bisa 'canvas' atau 'html'
                                    loop: true, // Animasi terus berjalan
                                    autoplay: true, // Mulai otomatis
                                    path: "{{ asset('assets_user/assets/animation/close.json') }}" // Path ke file JSON (harus ada di folder public)
                                });
                                $(".lottie-animation").css({
                                    "width": "100px",
                                    "height": "100px",
                                    "display": "inline-block",
                                });
                                offcanvasElement.show();
                            } else {

                            }

                        },
                        error: function(data) {
                            $("#formhargabawah").trigger('reset');
                            $('#btn_save').html('Simpan');
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
        }

    });
    $(document).on('click', '#btn_resend', function(e) {
        e.preventDefault();
        $('#btn_save').html('Menyimpan...');
        var nomor_hp = replace_titik($('#nomor_hp').val());
        var email = $('#email').val();
        var id_kategori = $('#id_kategori').val();
        if ($('#id_kategori').val() == '1') {
            if ($('#nomor_hp').val() == '') {
                $("#formhargabawah").trigger('reset');
                $('#btn_save').html('Simpan');
                $(".btn-close").trigger("click");
                $('#content_notif').html('NOMOR HARUS DI ISI');
                var newDiv = $('<div class="lottie-animation"></div>');
                $("#icon").empty();
                $('#icon').append(newDiv);
                lottie.loadAnimation({
                    container: newDiv[0], // Elemen target
                    renderer: 'svg', // Bisa 'canvas' atau 'html'
                    loop: true, // Animasi terus berjalan
                    autoplay: true, // Mulai otomatis
                    path: "{{ asset('assets_user/assets/animation/close.json') }}" // Path ke file JSON (harus ada di folder public)
                });
                $(".lottie-animation").css({
                    "width": "100px",
                    "height": "100px",
                    "display": "inline-block",
                });
                offcanvasElement.show();
            } else if (nomor_hp.length < 12) {
                $('#content_notif').html('DIGIT NOMOR KURANG');
                var newDiv = $('<div class="lottie-animation"></div>');
                $("#icon").empty();
                $('#icon').append(newDiv);
                lottie.loadAnimation({
                    container: newDiv[0], // Elemen target
                    renderer: 'svg', // Bisa 'canvas' atau 'html'
                    loop: true, // Animasi terus berjalan
                    autoplay: true, // Mulai otomatis
                    path: "{{ asset('assets_user/assets/animation/close.json') }}" // Path ke file JSON (harus ada di folder public)
                });
                $(".lottie-animation").css({
                    "width": "100px",
                    "height": "100px",
                    "display": "inline-block",
                });
                offcanvasElement.show();
            } else {
                Swal.fire({
                    allowOutsideClick: false,
                    background: 'transparent',
                    html: ' <div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div>',
                    showCancelButton: false,
                    showConfirmButton: false,
                    onBeforeOpen: () => {
                        $.ajax({
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id_kategori: id_kategori,
                                email: email,
                                nomor_hp: nomor_hp,
                            },
                            url: "{{ route('user.sendOTP') }}",
                            type: "POST",
                            dataType: 'json',
                            success: function(data) {
                                if (data.code == 200) {
                                    window.location.href = "{{url('user/form_otp')}}/" + data.data;
                                } else if (data.code == 400) {
                                    $('#content_notif').html('NOMOR TIDAK VALID');
                                    var newDiv = $('<div class="lottie-animation"></div>');
                                    $("#icon").empty();
                                    $('#icon').append(newDiv);
                                    lottie.loadAnimation({
                                        container: newDiv[0], // Elemen target
                                        renderer: 'svg', // Bisa 'canvas' atau 'html'
                                        loop: true, // Animasi terus berjalan
                                        autoplay: true, // Mulai otomatis
                                        path: "{{ asset('assets_user/assets/animation/close.json') }}" // Path ke file JSON (harus ada di folder public)
                                    });
                                    $(".lottie-animation").css({
                                        "width": "100px",
                                        "height": "100px",
                                        "display": "inline-block",
                                    });
                                    offcanvasElement.show();
                                } else {
                                    $('#content_notif').html('Gagal Disimpan');
                                    var newDiv = $('<div class="lottie-animation"></div>');
                                    $("#icon").empty();
                                    $('#icon').append(newDiv);
                                    lottie.loadAnimation({
                                        container: newDiv[0], // Elemen target
                                        renderer: 'svg', // Bisa 'canvas' atau 'html'
                                        loop: true, // Animasi terus berjalan
                                        autoplay: true, // Mulai otomatis
                                        path: "{{ asset('assets_user/assets/animation/close.json') }}" // Path ke file JSON (harus ada di folder public)
                                    });
                                    $(".lottie-animation").css({
                                        "width": "100px",
                                        "height": "100px",
                                        "display": "inline-block",
                                    });
                                    offcanvasElement.show();

                                }

                            },
                            error: function(data) {
                                $("#formhargabawah").trigger('reset');
                                $('#btn_save').html('Simpan');
                                $('#content_notif').html('Gagal Disimpan');
                                var newDiv = $('<div class="lottie-animation"></div>');
                                $("#icon").empty();
                                $('#icon').append(newDiv);
                                lottie.loadAnimation({
                                    container: newDiv[0], // Elemen target
                                    renderer: 'svg', // Bisa 'canvas' atau 'html'
                                    loop: true, // Animasi terus berjalan
                                    autoplay: true, // Mulai otomatis
                                    path: "{{ asset('assets_user/assets/animation/close.json') }}" // Path ke file JSON (harus ada di folder public)
                                });
                                $(".lottie-animation").css({
                                    "width": "100px",
                                    "height": "100px",
                                    "display": "inline-block",
                                });
                                offcanvasElement.show();

                            }
                        });
                    },
                });
            }
        } else {

        }
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

    $(document).on('keyup', '#nomor_hp', function(e) {

        let val = $(this).val().replace(/\D/g, ''); // Remove non-numeric characters
        let formatted = '';

        if (val.length > 0) formatted = '' + val.substring(0, 4);
        if (val.length >= 5) formatted += '-' + val.substring(4, 8);
        if (val.length >= 9) formatted += '-' + val.substring(8, 12);

        $(this).val(formatted);

    });
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