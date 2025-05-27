@extends('dashboard.user.layouts.main')
@section('title')
SURYA PANGAN SEMESTA
@endsection
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
            left: 60%;
            float: right;
        }

        .count_transaksi {
            position: absolute;
            margin-top: -0px;
            left: 60%;
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
            left: 57%;
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
            width: 60%;
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
            left: 57%;
            float: right;
            color: white
        }

        .count_pajak {
            position: absolute;
            margin-top: -0px;
            left: 58%;
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
            left: 57%;
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
        .notif_lelang {
            position: absolute;
            margin-top: -0px;
            left: 67%;
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
            left: 65%;
            float: right;
            color: white
        }

        .count_pajak {
            position: absolute;
            margin-top: -0px;
            left: 67%;
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


        .notif_lelang {
            position: absolute;
            margin-top: -0px;
            left: 70%;
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
        .notif_lelang {
            position: absolute;
            margin-top: -0px;
            left: 66%;
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
            left: 52%;
            float: right;
            color: white
        }

        .count_pajak {
            position: absolute;
            margin-top: -0px;
            left: 61%;
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
<!--home section bg area start-->
<!-- <div class="home_section_bg" style="background-image: url('public/assets_user/assets/img/slider/bg_sawah.jpg');background-size: cover;"> -->
<div class="home_section_bg" style="box-shadow: 3px 3px 20px; background: rgb(255, 255, 255);background-size: cover; height: 100%; border-radius: 20px;">
    <div class="product_area" style="margin-top: -10px;">
        <div class="">
            <div class="grey-bg container-fluid">
                <section id="minimal-statistics">
                    <div class="col-12">
                        <div class="row pt-5 pb-5">
                            <div class="col-xl-3 col-sm-3 col-3">
                                <a style="text-align: center;" id="btn_lelang" href="{{ route('user.daftar_lelang') }}">
                                    <div class="card card-menu wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="card-content">
                                            <div class="card-body" style="padding: 0; margin: 0;">
                                                <i class="bi bi-card-checklist icon-menu" style="color: rgb(110, 97, 209);"></i>
                                                <!-- <i class="fa fa-bars fs-5" style="color: rgb(110, 97, 209);"></i> -->
                                                <p class="text-menu1" style="text-align:center; color: rgb(110, 97, 209);"><b>DAFTAR PESANAN</b></p>
                                            </div>
                                        </div>
                                        <div class="notif_lelang">

                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3 col-sm-3 col-3">
                                <a style="text-align: center;" id="btn_transaksi" href="{{ route('user.transaksi') }}">
                                    <div class="card card-menu wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="card-content">
                                            <div class="card-body" style="padding: 0; margin: 0;">
                                                <i class="bi bi-credit-card icon-menu" style=" color: rgb(110, 97, 209);"></i>
                                                <p class="text-menu2" style="text-align:center; color: rgb(110, 97, 209);"><b>TRANSAKSI</b></p>
                                            </div>
                                        </div>
                                        <div class="count_transaksi">

                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3 col-sm-3 col-3">
                                <a style="text-align: center;" id="btn_riwayat_transaksi" href="{{ route('user.history') }}">
                                    <div class="card card-menu wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="card-content">
                                            <div class="card-body" style="padding: 0; margin: 0;">
                                                <i class="bi bi-clock-history icon-menu" style="color: rgb(110, 97, 209);"></i>
                                                <p class="text-menu3" style="text-align:center; color: rgb(110, 97, 209);"><b>HISTORY</b></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3 col-sm-3 col-3">
                                <a style="text-align: center;" id="btn_pemberitahuan" href="{{ route('user.notif') }}">
                                    <div class="card card-menu wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="card-content">
                                            <div class="card-body" style="padding: 0; margin: 0;">
                                                <i class="bi bi-bell icon-menu" style="color: rgb(110, 97, 209);"></i>
                                                <p class="text-menu4" style="text-align:center; color: rgb(110, 97, 209); "><b>NOTIFIKASI</b></p>
                                            </div>
                                        </div>
                                        <div class="count_notif">

                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3 col-sm-3 col-3 mt-4">
                                <a style="text-align: center;" id="btn_potong_pajak" href="{{ route('user.potong_pajak') }}">
                                    <div class="card card-menu wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="card-content">
                                            <div class="card-body" style="padding: 0; margin: 0;">
                                                <i class="bi bi-file-earmark-arrow-down icon-menu" style="color: rgb(110, 97, 209);"></i>
                                                <p class="text-menu5" style="text-align:center; color: rgb(110, 97, 209);"><b>BUKTI PAJAK</b></p>
                                            </div>
                                        </div>
                                        <div class="count_pajak">

                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-xl-3 col-sm-3 col-3 mt-4">
                                <a style="text-align: center;" href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#view_berita" aria-controls="view_berita">
                                    <div class="card card-menu wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="card-content">
                                            <div class="card-body" style="padding: 0; margin: 0;">
                                                <i class="bi bi-newspaper icon-menu" style="color: rgb(110, 97, 209);"></i>
                                                <p class="text-menu6" style="text-align:center; color: rgb(110, 97, 209);"><b>BERITA</b></p>
                                            </div>
                                        </div>

                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3 col-sm-3 col-3 mt-4">
                                <a style="text-align: center;" id="btn_akun" href="{{ route('user.account') }}">
                                    <div class="card card-menu wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="card-content">
                                            <div class="card-body" style="padding: 0; margin: 0;">
                                                <i class="bi bi-person icon-menu" style="color: rgb(110, 97, 209);"></i>
                                                <p class="text-menu7" style="text-align:center; color: rgb(110, 97, 209);"><b>AKUN</b></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3 col-sm-3 col-3 mt-4">
                                <a style="text-align: center;" id="btn_about_us" href="{{ route('user.about_us') }}">
                                    <div class="card card-menu wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="card-content">
                                            <div class="card-body" style="padding: 0; margin: 0;">
                                                <i class="bi bi-info-circle icon-menu" style="color: rgb(110, 97, 209);"></i>
                                                <p class="text-menu8" style="text-align:center; color: rgb(110, 97, 209);"><b>TENTANG APLIKASI</b></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </section>

            </div>
        </div>
    </div>
    <div class="po_area" style="margin-top: 5px;">
        @if($data_riwayat=='[]')
        @else
        <h6><span style="padding-left: 4%; color: rgb(110, 97, 209);">History&nbsp;Transaksi</span></h6>
        <swiper-container class="mySwiper" style="padding-left: 4%; padding-bottom: 4%;" space-between="15" slides-per-view="auto">
            @foreach($data_riwayat as $data)
            <swiper-slide>
                <a href="{{route('user.data_list_po',$data->id_biduser)}}">
                    <div class="card wow fadeInUp" data-wow-delay="0.1s" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;border-radius: 5px;">
                        <div class="card-body" style="padding: 0; margin: 0;">
                            <div class="row">
                                <div class="col-4">
                                    <div class="logo-icon">
                                        <img src="{{asset('img_gabah.png')}}" style="width: 80%; margin-top: auto; margin-bottom: auto;" alt="...">
                                    </div>
                                    @if ($data->status_biduser == 1)
                                    <a id="btn_disetujui" name="' . $data->user_id . '" data-jumlahkirim="' . $data->jumlah_kirim . '" data-idnyabid="' . $data->id_bid . '" title="Disetujui">
                                        <span style="font-size: small; background-color: rgb(51, 163, 118); color:#F0F6FF ; bottom: 0; display: block; position: relative;">
                                            <i class="bi bi-check"> </i>
                                            &nbsp;Disetujui&nbsp;
                                        </span>
                                    </a>
                                    @elseif ($data->status_biduser == 5)
                                    <a id="btn_ditolak" name="" title="Ditolak">
                                        <span style="font-size: small; background-color: rgb(217, 65, 65); color:#F0F6FF ; bottom: 0; display: block; position: relative;">
                                            <i class="bi bi-dash"> </i>
                                            &nbsp;Ditolak&nbsp;
                                        </span>
                                    </a>
                                    @elseif ($data->status_biduser == 3)
                                    <a id="btn_disetujui" name="' . $data->user_id . '" data-jumlahkirim="' . $data->jumlah_kirim . '" data-idnyabid="' . $data->id_bid . '" title="Disetujui">
                                        <span style="font-size: small; background-color: rgb(51, 163, 118); color:#F0F6FF ; bottom: 0; display: block; position: relative;">
                                            <i class="bi bi-check"> </i>
                                            &nbsp;Disetujui&nbsp;
                                        </span>
                                    </a>
                                    @elseif ($data->status_biduser == 4)
                                    <a name="' . $data->id_biduser . '" title="Pengiriman Telat">
                                        <span style="font-size: small; background-color: rgb(217, 65, 65); color:#F0F6FF ; bottom: 0; display: block; position: relative;">
                                            <i class="bi bi-clipboard-minus-fill"> </i>
                                            &nbsp;Proses Pengiriman Telat&nbsp;
                                        </span>
                                    </a>
                                    @elseif ($data->status_biduser == 0)
                                    <a id="btn_pengajuan" title="Proses lelang">
                                        <span style="font-size: small; background-color: rgb(92, 134, 207); color:#F0F6FF ; bottom: 0; display: block; position: relative;">
                                            <i class="bi bi-arrow-clockwise">
                                            </i>
                                            &nbsp;Pengajuan&nbsp;
                                        </span>
                                    </a>
                                    @endif
                                </div>
                                <div class="col-8">
                                    <p style="font-size: 9pt; text-align:center; color: rgb(110, 97, 209);"><b>Pengajuan PO</b></p>
                                    <dl class="dl-horizontal row text-pengajuan">
                                        <dd class="col-4">Tanggal</dd>
                                        <dd class="col-8">:&nbsp;{{date('d-m-Y', strtotime($data->date_bid))}}</dd>
                                        <dd class="col-4">Item</dd>
                                        <dd class="col-8">:&nbsp;{{$data->name_bid}}</dd>
                                        <dd class="col-4">Pengajuan</dd>
                                        <dd class="col-8">:&nbsp;{{$data->jumlah_kirim}} Truk</dd>
                                        <dd class="col-4">Disetujui</dd>
                                        <dd class="col-8">:&nbsp; @if ($data->permintaan_kirim == '')
                                            Dalam Pengajuan
                                            @elseif ($data->permintaan_kirim == '0')
                                            0 Truk
                                            @else
                                            {{$data->permintaan_kirim}} Truk
                                            @endif
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </swiper-slide>
            @endforeach
            <swiper-slide style="height: auto; width: 50px !important;">
                <p style="font-size: 9pt; text-align:left; color: rgb(110, 97, 209);"><b>Lihat Semua</b></p>
            </swiper-slide>
        </swiper-container>
        @endif
    </div>
    <div class="offcanvas offcanvas-bottom" style="box-shadow: 3px 3px 20px; border-radius: 20px 20px 0px 0px; height: max-content;" tabindex="-1" id="notif" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-body small">
            <div class="text-center">
                <div id="lottie-animation" style="width: 150px; height: 150px; margin: auto;"></div>
                <h6 id="content-notif"></h6>
            </div>
        </div>
    </div>
</div>
<div class="offcanvas offcanvas-bottom" style="box-shadow: 3px 3px 20px; border-radius: 20px 20px 0px 0px; height: max-content;" tabindex="-1" id="view_berita">
    <div class="offcanvas-body small">
        <div class="text-center mb-3">
            <div id="lottie-animation1" style="width: 80px; height: 80px; margin: auto;">
            </div>
            <h6>
                Masih Dalam Pengembangan
            </h6>
        </div>
    </div>
</div>
<!--home section bg area end-->
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
<!-- Lottie Player -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.10.2/lottie.min.js"></script>
<script>
    $(document).ready(function() {
        var animasi = lottie.loadAnimation({
            container: document.getElementById('lottie-animation1'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: "{{ asset('assets_user/assets/animation/maintenance.json') }}",
        });
        var view_berita = document.getElementById('view_berita');
        view_berita.addEventListener('shown.bs.offcanvas', function() {
            animasi.goToAndPlay(0, true);
        });
        view_berita.addEventListener('hidden.bs.offcanvas', function() {
            animasi.stop();
        });

        var name = '{{Auth::user()->name}}';
        @if(Session::has('login_success'))
        var offcanvasElement = document.getElementById('notif');
        $('#content-notif').html('Selamat Datang ' + name);
        var bsOffcanvas = new bootstrap.Offcanvas(offcanvasElement);

        var lottieAnim = lottie.loadAnimation({
            container: document.getElementById('lottie-animation'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: "{{ asset('assets_user/assets/animation/success2.json') }}",
        });

        bsOffcanvas.show();

        // Auto-close after 3 seconds
        setTimeout(function() {
            bsOffcanvas.hide();
        }, 5000);
        @elseif(Session::has('lelang_success'))
        var offcanvasElement = document.getElementById('notif');
        $('#content-notif').html('Anda Berhasi Mengikuti Lelang');
        var bsOffcanvas = new bootstrap.Offcanvas(offcanvasElement);

        var lottieAnim = lottie.loadAnimation({
            container: document.getElementById('lottie-animation'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: "{{ asset('assets_user/assets/animation/success2.json') }}",
        });

        bsOffcanvas.show();

        // Auto-close after 3 seconds
        setTimeout(function() {
            bsOffcanvas.hide();
        }, 5000);
        @endif
    });
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
    });
</script>
<script>
    $(document).on('click', '#btn_home', function(e) {
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
</script>
<script>
    $(document).on('click', '#btn_lelang', function(e) {
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
    $(document).on('click', '#btn_transaksi', function(e) {
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
    $(document).on('click', '#btn_profil', function(e) {
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
    $(document).on('click', '#btn_riwayat_transaksi', function(e) {
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
    $(document).on('click', '#btn_pemberitahuan', function(e) {
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
    $(document).on('click', '#btn_potong_pajak', function(e) {
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
    $(document).on('click', '#btn_berita', function(e) {
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
    $(document).on('click', '#btn_akun', function(e) {
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
    $(document).on('click', '#btn_about_us', function(e) {
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
</script>
<script type="text/javascript">
    setTimeout(function() {
        var url = "{{ route('user.update_home') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            dataType: 'JSON',
            success: function(data) {
                console.log(data)
            }
        });
        location.reload();

    }, 1000000);
</script>
<script type="text/javascript">
    function getcount_notifikasi() {
        $.ajax({
            type: "GET",
            url: "{{route('user.getcount_notifikasi')}}",
            success: function(data) {
                // console.log(data);
                $(".count_transaksi").empty();
                $(".count_notif").empty();
                $(".count_pajak").empty();
                // var notif = JSON.parse();
                $(".count_transaksi").append('<h6><span class="badge badge bg-success text_notif" style="position:absolute; margin-top: 0px; width: max-content; text-align: left; color:  rgb(234, 250, 239);">' + data.getcount_transaksi + '</span></h6>');
                $(".count_notif").append('<h6><span class="badge badge bg-success text_notif" style="position:absolute; margin-top: 0px; width: max-content; text-align: left;">' + data.getcount_broadcast + '</span></h6>');
                $(".count_pajak").append('<h6><span class="badge badge bg-success text_notif" style="position:absolute; margin-top: 0px; margin-left: 1%; width: max-content; text-align: left;">' + data.getcount_pajak + '</span></h6>');
                var newDiv = $('<div class="lottie-animation"></div>');
                if (data.notif_lelang > 0) {
                    $(".notif_lelang").empty();
                    $('.notif_lelang').append(newDiv);
                    lottie.loadAnimation({
                        container: newDiv[0], // Elemen target
                        renderer: 'svg', // Bisa 'canvas' atau 'html'
                        loop: true, // Animasi terus berjalan
                        autoplay: true, // Mulai otomatis
                        path: "{{ asset('assets_user/assets/animation/indicator.json') }}" // Path ke file JSON (harus ada di folder public)
                    });
                    $(".lottie-animation").css({
                        "width": "20px",
                        "height": "20px",
                        "display": "inline-block",
                    });
                    // $(".notif_lelang").append('<span class="badge bg-success text_notif" style="position:absolute; margin-top: 0px; width: max-content; text-align: left; color: rgb(224, 240, 229);">&nbsp;</span>');
                } else {
                    $(".notif_lelang").empty();
                }
            }
        });
    }

    if ('{{Auth::user()}}') {
        setInterval(getcount_notifikasi, 2000);
    }
</script>
@endsection