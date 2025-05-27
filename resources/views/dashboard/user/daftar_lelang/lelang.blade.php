@extends('dashboard.user.layouts.main')
@section('title')
SURYA PANGAN SEMESTA
@endsection
@section('css')
<style>
    @media only screen and (max-width: 1300px) {
        .notif_status {
            position: absolute;
            margin-top: 0%;
            left: 95%;
            float: right;
            background-color: rgb(44, 188, 73);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .logo-icon {
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .notif_status h6 {
            font-size: 10pt;
            color: white;
        }

        .img_gabah {
            width: 280px;
            margin-top: auto;
            margin-bottom: auto;
        }

        .notif_lelang {
            position: absolute;
            margin-top: -8px;
            left: 90%;
            float: right;
        }

        .day {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .hour {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .min {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .sec {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .text-countdown {
            font-size: 10pt;
        }

        .count_transaksi {
            position: absolute;
            margin-top: -8px;
            left: 95%;
            float: left;
            color: white
        }

        .count_notif {
            position: absolute;
            margin-top: -8px;
            left: 95%;
            float: right;
            color: white
        }

        .count_pajak {
            position: absolute;
            margin-top: -8px;
            left: 95%;
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
            margin-top: -10%;
            margin-left: 5%;
            margin-right: 5%;
        }
    }

    @media only screen and (max-width: 1000px) {
        .notif_status {
            position: absolute;
            margin-top: 0%;
            left: 93%;
            float: right;
            background-color: rgb(44, 188, 73);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .logo-icon {
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .notif_status h6 {
            font-size: 10pt;
            color: white;
        }

        .img_gabah {
            width: 250px;
            margin-top: auto;
            margin-bottom: auto;
        }

        .notif_lelang {
            position: absolute;
            margin-top: -8px;
            left: 85%;
            float: right;
        }

        .count_transaksi {
            position: absolute;
            margin-top: -8px;
            left: 95%;
            float: left;
            color: white
        }

        .count_notif {
            position: absolute;
            margin-top: -8px;
            left: 95%;
            float: right;
            color: white
        }

        .count_pajak {
            position: absolute;
            margin-top: -8px;
            left: 90%;
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

        .day {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .hour {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .min {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .sec {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .text-countdown {
            font-size: 10pt;
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
        .notif_status {
            position: absolute;
            margin-top: 0%;
            left: 93%;
            float: right;
            background-color: rgb(44, 188, 73);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .logo-icon {
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .notif_status h6 {
            font-size: 10pt;
            color: white;
        }

        .img_gabah {
            width: 250px;
            margin-top: auto;
            margin-bottom: auto;
        }

        .notif_lelang {
            position: absolute;
            margin-top: -8px;
            left: 85%;
            float: right;
        }

        .count_transaksi {
            position: absolute;
            margin-top: -8px;
            left: 90%;
            float: left;
            color: white
        }

        .count_notif {
            position: absolute;
            margin-top: -8px;
            left: 90%;
            float: right;
            color: white
        }

        .count_pajak {
            position: absolute;
            margin-top: -8px;
            left: 90%;
            float: right;
            color: white
        }

        .day {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .hour {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .min {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .sec {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .text-countdown {
            font-size: 10pt;
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
        .notif_status {
            position: absolute;
            margin-top: 0%;
            left: 90%;
            float: right;
            background-color: rgb(44, 188, 73);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .logo-icon {
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .notif_status h6 {
            font-size: 10pt;
            color: white;
        }

        .img_gabah {
            width: 230px;
            margin-top: auto;
            margin-bottom: auto;
        }

        .notif_lelang {
            position: absolute;
            margin-top: -8px;
            left: 80%;
            float: right;
        }

        .count_transaksi {
            position: absolute;
            margin-top: -8px;
            left: 90%;
            float: left;
            color: white
        }

        .count_notif {
            position: absolute;
            margin-top: -8px;
            left: 87%;
            float: right;
            color: white
        }

        .count_pajak {
            position: absolute;
            margin-top: -8px;
            left: 90%;
            float: right;
            color: white
        }

        .day {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .hour {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .min {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .sec {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .text-countdown {
            font-size: 10pt;
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
        .notif_status {
            position: absolute;
            margin-top: 0%;
            left: 90%;
            float: right;
            background-color: rgb(44, 188, 73);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .logo-icon {
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .notif_status h6 {
            font-size: 10pt;
            color: white;
        }

        .img_gabah {
            width: 230px;
            margin-top: auto;
            margin-bottom: auto;
        }

        .day {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .hour {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .min {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .sec {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .text-countdown {
            font-size: 10pt;
        }

        .notif_lelang {
            position: absolute;
            margin-top: -8px;
            left: 75%;
            float: right;
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
        .notif_status {
            position: absolute;
            margin-top: 0%;
            left: 90%;
            float: right;
            background-color: rgb(44, 188, 73);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .logo-icon {
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .notif_status h6 {
            font-size: 10pt;
            color: white;
        }

        .img_gabah {
            width: 230px;
            margin-top: auto;
            margin-bottom: auto;
        }

        .day {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .hour {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .min {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .sec {
            text-align: center;
            height: 35px;
            width: 35px;
        }

        .text-countdown {
            font-size: 10pt;
        }

        .notif_lelang {
            position: absolute;
            margin-top: -8px;
            left: 75%;
            float: right;
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
            margin-top: 0%;
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
        .notif_status {
            position: absolute;
            margin-top: 0%;
            left: 87%;
            float: right;
            background-color: rgb(44, 188, 73);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .logo-icon {
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .img_gabah {
            width: 230px;
            margin-top: auto;
            margin-bottom: auto;
        }

        .notif_status h6 {
            font-size: 10pt;
            color: white;
        }

        .day {
            text-align: center;
            height: 30px;
            width: 30px;
        }

        .hour {
            text-align: center;
            height: 30px;
            width: 30px;
        }

        .min {
            text-align: center;
            height: 30px;
            width: 30px;
        }

        .sec {
            text-align: center;
            height: 30px;
            width: 30px;
        }

        .text-countdown {
            font-size: 9pt;
        }

        .notif_lelang {
            position: absolute;
            margin-top: -8px;
            left: 75%;
            float: right;
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
            margin-top: 0%;
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

        .notif_status {
            position: absolute;
            margin-top: 0%;
            left: 87%;
            float: right;
            background-color: rgb(44, 188, 73);
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .notif_status h6 {
            font-size: 9pt;
            color: white;
        }

        .logo-icon {
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .img_gabah {
            width: 230px;
            margin-top: auto;
            margin-bottom: auto;
        }

        .day {
            text-align: center;
            height: 27px;
            width: 27px;
        }

        .hour {
            text-align: center;
            height: 27px;
            width: 27px;
        }

        .min {
            text-align: center;
            height: 27px;
            width: 27px;
        }

        .sec {
            text-align: center;
            height: 27px;
            width: 27px;
        }

        .text-countdown {
            font-size: 7pt;
        }

        .img-pp-lelang {
            width: 30%;
        }

        .img-logo-lelang {
            width: 100%;
            border-radius: 20%
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
<div class="home_section_bg mb-3" style="box-shadow: 3px 3px 20px; background: rgb(255, 255, 255);background-size: cover; height: max-content; padding-bottom: 5%; border-radius: 20px;">
    <div class="container py-5 px-lg-5">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="fw-medium mb-3"><b>DAFTAR LELANG</b></h5>
        </div>

        @if($site_ngawi_longgrain=='[]' && $site_ngawi_pandanwangi=='[]' && $site_ngawi_ketanputih=='[]'&& $site_other=='[]')
        <div class="container">
            <div class="col-lg-12">
                <div class="col-lg-12 col-sm-12 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative bg-light rounded mt-4 mb-5 pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width:70px; height:70px;">
                            <i class="bi bi-card-checklist text-white" style="font-size: 36px;"></i>
                        </div>
                        <h5 class="mt-4 mb-3">Tidak Ada Lelang</h5>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="container">
            <div class="col-lg-12">
                @foreach ($site_ngawi_longgrain as $site_ngawi_longgrain)
                <a id="btn_lelang_detail" href="{{url('user/lelang_detail/'.$site_ngawi_longgrain->id_bid)}}">
                    <div class="card wow fadeInUp" data-wow-delay="0.1s" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;border-radius: 15px; padding: 10;">
                        <div class="card-body" style="padding: 5;">
                            <div class="row">
                                <div class="col-12">
                                    <div class="logo-icon">
                                        <img class="img_gabah" src="{{asset('img_gabah.png')}}" alt="...">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input type="hidden" id="batas_bid" value="{{$site_ngawi_longgrain->batas_bid}}">
                                    <p style="font-size: 10pt; text-align:center; color: rgb(110, 97, 209);"><b>{{$site_ngawi_longgrain->name_bid}}</b></p>
                                    <p style="font-size: 10pt; text-align:center; color: rgb(15, 15, 15);"><b>PO: {{date('d-m-Y', strtotime($site_ngawi_longgrain->open_po))}}</b><br>
                                        <span class="badge badge bg-success" style="text-align:center;">SITE NGAWI</span><br>
                                        Batas Penerimaan
                                        <br>
                                        <br>
                                        <span class="day" style="background-color:rgb(110, 97, 209); color: #fff; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;"></span>
                                        <span class="text-countdown">Hari</span>
                                        <span class="hour" style="background-color:rgb(110, 97, 209); color: #fff; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;"></span>
                                        <span class="text-countdown">Jam</span>
                                        <span class="min" style="background-color:rgb(110, 97, 209); color: #fff; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;"></span>
                                        <span class="text-countdown">Menit</span>
                                        <span class="sec" style="background-color:rgb(110, 97, 209); color: #fff; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;"></span>
                                        <span class="text-countdown">Detik</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="notif_status">
                            @if ($site_ngawi_longgrain->bid_status == 1)
                            <h6>
                                BUKA
                            </h6>
                            @else
                            TUTUP
                            @endif
                        </div>
                    </div>
                </a>
                @endforeach
                @foreach ($site_ngawi_pandanwangi as $site_ngawi_pandanwangi)
                <br>
                <br>
                <a id="btn_lelang_detail" href="{{url('user/lelang_detail/'.$site_ngawi_pandanwangi->id_bid)}}">
                    <div class="card wow fadeInUp" data-wow-delay="0.1s" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;border-radius: 15px; padding: 10;">
                        <div class="card-body" style="padding: 5; margin: 0;">
                            <div class="row">
                                <div class="col-12">
                                    <div class="logo-icon">
                                        <img class="img_gabah" src="{{asset('img_gabah.png')}}" alt="...">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input type="hidden" id="batas_bid" value="{{$site_ngawi_pandanwangi->batas_bid}}">
                                    <p style="font-size: 10pt; text-align:center; color: rgb(31, 148, 70);"><b>{{$site_ngawi_pandanwangi->name_bid}}</b></p>
                                    <p style="font-size: 10pt; text-align:center; color: rgb(15, 15, 15);"><b>PO: {{date('d-m-Y', strtotime($site_ngawi_pandanwangi->open_po))}}</b><br>
                                        <span class="badge badge bg-success" style="text-align:center;">SITE NGAWI</span><br>
                                        Batas Penerimaan
                                        <br>
                                        <br>
                                        <span class="day" style="background-color:rgb(31, 148, 70); color: #fff; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;"></span>
                                        <span class="text-countdown">Hari</span>
                                        <span class="hour" style="background-color:rgb(31, 148, 70); color: #fff; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;"></span>
                                        <span class="text-countdown">Jam</span>
                                        <span class="min" style="background-color:rgb(31, 148, 70); color: #fff; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;"></span>
                                        <span class="text-countdown">Menit</span>
                                        <span class="sec" style="background-color:rgb(31, 148, 70); color: #fff; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;"></span>
                                        <span class="text-countdown">Detik</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="notif_status">
                            @if ($site_ngawi_pandanwangi->bid_status == 1)
                            <h6>
                                BUKA
                            </h6>
                            @else
                            TUTUP
                            @endif
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
    <!--product area end-->
</div>
@include('dashboard.user.layouts.menu')
<!--home section bg area end-->
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
    $(document).on('click', '#btn_lelang_detail', function(e) {
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
    // Set the date we're counting down to
    var batas_bid = $('#batas_bid').val();
    console.log(batas_bid);
    var countDownDate = new Date(batas_bid).getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        $(".day").html(days);
        $(".hour").html(hours);
        $(".min").html(minutes);
        $(".sec").html(seconds);

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("data-countdown").innerHTML = "EXPIRED";
        }
    }, 1000);
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '.toshow', function() {
            var id = $(this).attr("name");
            console.log(id);
            var url = "{{ route('user.lelang_show') }}" + "/" + id;

            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    var parsed = $.parseJSON(response);
                    console.log(response);
                    var image = parsed.image_bid;
                    $('#id_bid').val(parsed.id_bid);
                    $('#name_bid').html('<h1>' + parsed.name_bid + '</h1>');
                    $('#harga').html('<span class="new_price">Rp ' + parsed.harga + '/Kg</span>');
                    $('#jumlah').val(parsed.jumlah);
                    $('#lokasi').val(parsed.lokasi);
                    $('#date_bid').val(parsed.date_bid);
                    $('#batas_bid').val(parsed.batas_bid);
                    $('#description_bid').html('<p>' + parsed.description_bid + '</p>');
                    $('#image_bid').empty();
                    if (image !== null) {
                        $('#img').html('<div class=""><img src="https://ngawi.suryapangansemesta.store/public/img/bid/pp_bid.jpg" style="width:100%;height:500px" /></div>');
                    }

                }
            });
        });
    });
</script>
@endsection