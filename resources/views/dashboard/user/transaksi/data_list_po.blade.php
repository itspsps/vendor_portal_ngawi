@extends('dashboard.user.layouts.main')
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
<div class="home_section_bg mb-3" style="box-shadow: 3px 3px 20px; background: rgb(255, 255, 255);background-size: cover; height: 100%; border-radius: 20px;">

    <!-- Features Start -->

    <div class="container py-5 px-lg-5">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="fw-medium mb-5"><b>DATA LIST PO</b></h5>
        </div>
        <div class="row g-4">
            @if($data=='[]')
            <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="position-relative bg-light rounded pt-5 pb-4 px-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width:70px; height:70px;">
                        <img src="{{asset('assets_user/assets/img/logo/icon_sps_white1.png')}}" class="rounded-circle" alt="" width="90%">
                    </div>
                    <h5 class="mt-4 mb-3">Tidak Ada Transaksi</h5>
                </div>
            </div>
            @else
            @foreach($data as $data)
            <div class="col-12 pt-4 mb-3 wow fadeInUp" data-wow-delay="0.1s">
                @if($data->status_bid >= '3' && $data->status_bid != '5' && $data->status_bid != '16')
                <div class="position-relative rounded pt-5 pb-4 px-4" style="background-color: #dffde0;">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width:70px; height:70px;">
                        <i class="bi bi-clipboard-check text-white" style="font-size: 38px;"></i>
                    </div>
                    <img style="transform: rotate(-0.05turn); margin-top: -15px; position: absolute; top: 0;right: 0; float:right" src="{{asset('img/po_success.png')}}" alt="" width="25%">
                    @elseif($data->status_bid=='5')
                    <div class="position-relative rounded pt-5 pb-4 px-4" style="background-color: #fed1d1;">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width:70px; height:70px;">
                            <i class="bi bi-clipboard-minus text-white" style="font-size: 38px;"></i>
                        </div>
                        <img style="transform: rotate(-0.05turn); margin-top: -15px; position: absolute; top: 0;right: 0; float:right" src="{{asset('img/po_closed.png')}}" alt="" width="25%">
                        @else
                        <div class="position-relative bg-light rounded pt-5 pb-4 px-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width:70px; height:70px;">
                                <img src="{{asset('assets_user/assets/img/logo/icon_sps_white1.png')}}" class="rounded-circle" alt="" width="90%">
                            </div>
                            @endif
                            <h6 class="mt-2 mb-3 text-center"><b>{{$data->name_bid}}</b></h6>
                            <dl class="dl-horizontal row" style="font-size: smaller;">
                                <dd class="col-3">No. PO</dd>
                                <dd class="col-1">:</dd>
                                <dd class="col-7" style="font-weight: bold;">{{getCode($data->kode_po)}}
                                    <a data-id="{{$data->kode_po}}" type="button" class="" id="btn_liat_po" data-bs-toggle="offcanvas" data-bs-target="#view_po" aria-controls="view_po">
                                        <h6>
                                            <span class="badge bg-success">
                                                <i class="fa fa-eye"></i>&nbsp;LIHAT
                                            </span>
                                        </h6>
                                    </a>
                                </dd>
                                <dd class="col-3">Tanggal&nbsp;PO</dd>
                                <dd class="col-1">:</dd>
                                <dd class="col-7" style="font-weight: bold;">{{ \Carbon\Carbon::parse($data->open_po)->format('d-m-Y')}}</dd>

                                <dd class="col-3">Tanggal Kedatangan</dd>
                                <dd class="col-1">:</dd>
                                <dd class="col-7" style="font-weight: bold;">
                                    @if($data->waktu_penerimaan=='' || $data->waktu_penerimaan==NULL)
                                    -
                                    @else
                                    {{Carbon\Carbon::parse($data->waktu_penerimaan)->format('d-m-Y')}}<br>
                                    <h6>
                                        <span class="badge bg-success">{{Carbon\Carbon::parse($data->waktu_penerimaan)->format('H:i:s')}}</span>
                                    </h6>
                                    @endif
                                </dd>
                                <dd class="col-3">Batas&nbsp;PO</dd>
                                <dd class="col-1">:</dd>
                                <dd class="col-7" style="font-weight: bold;">
                                    {{Carbon\Carbon::parse($data->batas_bid)->format('d-m-Y')}}<br>
                                    <h6><span class="badge bg-warning">12:00 WIB</span></h6>
                                </dd>

                                <dd class="col-3">Nopol</dd>
                                <dd class="col-1">:</dd>
                                <dd class="col-7" style="font-weight: bold;">
                                    @if($data->plat_kendaraan=='' || $data->plat_kendaraan==NULL)
                                    -
                                    @else
                                    {{$data->plat_kendaraan}}
                                    @endif
                                </dd>
                                <dd class="col-3">Qty</dd>
                                <dd class="col-1">:</dd>
                                <dd class="col-7" style="font-weight: bold;">
                                    @if($data->hasil_akhir_tonase=='' || $data->hasil_akhir_tonase==NULL)
                                    -
                                    @else
                                    {{tonase($data->hasil_akhir_tonase)}}
                                    @endif
                                </dd>
                                <dd class="col-3">Harga</dd>
                                <dd class="col-1">:</dd>
                                <dd class="col-7" style="font-weight: bold;">
                                    @if($data->aksi_harga_gb=='DEAL')
                                    <h3> <span class="badge bg-success">{{rupiah($data->harga_akhir_gb)}} /Kg</span></h3>
                                    @else
                                    -
                                    @endif
                                </dd>

                                <dd class="col-3">Bukti&nbsp;PO</dd>
                                <dd class="col-1">:</dd>
                                <dd class="col-7" style="font-weight: bold;">
                                    @if ($data->status_bid == 5)
                                    <p>-</p>
                                    @else
                                    <a href="{{url('user/cetak_po',$data->id_data_po)}}" id="btn_cetak_po" name="" title="Cetak PO" class=" btn btn-sm btn-primary">
                                        <i class="fa fa-print" style="color:white;"> Cetak PO </i>
                                    </a>
                                    <a href="{{url('user/scan_po',$data->id_data_po)}}" id="btn_scan_po" target="_blank" name="" title="Scan PO" class=" btn btn-sm btn-danger">
                                        <i class="fa fa-qrcode" style="color:white;"> Scan PO </i>
                                    </a>
                                    @endif
                                </dd>
                            </dl>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        <!-- Features End -->
        <div class="offcanvas offcanvas-bottom" style="box-shadow: 3px 3px 20px; border-radius: 20px 20px 0px 0px; height: max-content;" tabindex="-1" id="view_po">
            <div class="offcanvas-body small">
                <div class="text-center mb-3">
                    <div id="lottie-animation" style="width: 80px; height: 80px; margin: auto;">
                    </div>
                    <h6 id="view_kode_po">

                    </h6>
                </div>
            </div>
        </div>


        @include('dashboard.user.layouts.menu')
    </div>
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-lg-square back-to-top mb-5 pt-2"><i class="bi bi-arrow-up text-white"></i></a>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- Lottie Player -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.10.2/lottie.min.js"></script>
<script>
    $(document).ready(function() {
        var animation = lottie.loadAnimation({
            container: document.getElementById('lottie-animation'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: "{{ asset('assets_user/assets/animation/information.json') }}",
        });
        var offcanvas = document.getElementById('view_po');
        offcanvas.addEventListener('shown.bs.offcanvas', function() {
            animation.goToAndPlay(0, true);
        });
        offcanvas.addEventListener('hidden.bs.offcanvas', function() {
            animation.stop();
        });
    });
    $(document).on('click', '#btn_pengajuan', function() {
        Swal.fire({
            title: 'Mohon Ditunggu',
            text: 'Pengajuan Anda Sedang Kami Proses',
            icon: 'warning',
            timer: 1500
        })
    });
    $(document).on('click', '#btn_liat_po', function() {
        var id = $(this).data("id");
        console.log('ok');
        $('#view_kode_po').html(id);

    });
    $(document).on('click', '#btn_disetujui', function() {
        Swal.fire({
            title: 'Informasi',
            text: 'PO Anda Sudah Disetujui',
            icon: 'success',
            timer: 1500
        })
    });
    $(document).on('click', '#btn_pembayaran', function() {
        Swal.fire({
            title: 'Informasi',
            text: 'PO Anda Sedang Proses Pembayaran',
            icon: 'success',
            timer: 1500
        })
    });
    $(document).on('click', '#btn_pengiriman', function() {
        Swal.fire({
            title: 'Informasi',
            text: 'PO Anda Sedang Pengiriman',
            icon: 'info',
            timer: 1500
        })
    });
    $(document).on('click', '#btn_antrian', function() {
        Swal.fire({
            title: 'Informasi',
            text: 'PO Anda Sedang Menunggu Antrian Bongkar',
            icon: 'info',
            timer: 1500
        })
    });
    $(document).on('click', '#btn_bongkar', function() {
        Swal.fire({
            title: 'Informasi',
            text: 'PO Anda Sedang Proses Bongkar',
            icon: 'info',
            timer: 1500
        })
    });
    $(document).on('click', '#btn_ditolak', function() {
        Swal.fire({
            title: 'Ditolak',
            text: 'PO Anda Ditolak',
            icon: 'error',
            timer: 1500
        })
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

    $(document).on('click', '#btn_konfirmasibongkar', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Konfirmasi',
            icon: 'warning',
            text: "Apakah data yang kamu input sudah benar ?",
            showCancelButton: true,
            inputValue: 0,
            confirmButtonText: 'Yes',
        }).then(function(result) {
            if (result.value) {
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
                $('#form_konfirmasi_bongkar').submit();
                Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
            } else {
                Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

            }
        });
    });
    $(document).on('click', '#btn_tidak', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Konfirmasi',
            icon: 'warning',
            text: "Apakah data yang kamu input sudah benar ?",
            showCancelButton: true,
            inputValue: 0,
            confirmButtonText: 'Yes',
        }).then(function(result) {
            if (result.value) {
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
                $('#form_konfirmasi_bongkar').submit();
                Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
            } else {
                Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

            }
        });
    });
    $(document).on('click', '.toshowpending', function() {
        var id = $(this).attr("name");
        var ponum = $(this).data("ponum");
        var url = "{{ route('user.status_pending')}}" + "/" + id;
        console.log(url);
        $.ajax({
            type: "GET",
            url: url,
            success: function(response) {
                var parsed = $.parseJSON(response);
                // console.log(parsed);
                $('#modalpending').modal('show');
                $('#status').text('Rp. ' + formatRupiah(parsed.plan_harga_gb) + ' /Kg');
                $('#id_datapo').val(parsed.lab1_id_data_po_gb);
                $('#harga').val(parsed.plan_harga_gb);
                $('#PONum').val(ponum);


            }
        });
    });
    $(document).on('click', '.toshow', function() {
        var id = $(this).attr("name");
        var idnyabid = $(this).data('idnyabid');
        var jumlahkirim = $(this).data('jumlahkirim');
        var url = "{{ route('user.detail_pengajuan') }}" + "/" + idnyabid;
        // console.log(url);
        $.ajax({
            type: "GET",
            url: url,
            success: function(response) {
                var parsed = $.parseJSON(response);
                // console.log(response);
                $('#jumlah_pengajuan').val(jumlahkirim + ' Truk');
                $('#permintaan_kirim').val(parsed.permintaan_kirim + ' Truk');
                $('#message_admin').val(parsed.message_admin);
                $('#batas_penerimaan').val(parsed.batas_penerimaan);
                $('#idnyabid').val(idnyabid);
                $('#cetak_po').html('<a class="btn btn-danger" style="width: 100%" href="user/data_list_po/' + idnyabid + '" title="Data PO">Data PO</a>');
            }
        });
    });
    $(document).on('click', '.lihat_po', function() {
        var id = $(this).attr("name");
        var url = "{{ route('user.detail_pengajuan') }}" + "/" + id;
        // console.log(url);
        $.ajax({
            type: "GET",
            url: url,
            success: function(response) {
                var parsed = $.parseJSON(response);
                // console.log(response);
                $('#jumlah_pengajuan').val(jumlahkirim + ' Truk');
                $('#permintaan_kirim').val(parsed.permintaan_kirim + ' Truk');
                $('#message_admin').val(parsed.message_admin);
                $('#batas_penerimaan').val(parsed.batas_penerimaan);
                $('#idnyabid').val(idnyabid);
                $('#cetak_po').html('<a class="btn btn-danger" target="_blank" style="width: 100%" href="user/data_list_po/' + idnyabid + '" title="Data PO">Data PO</a>');
            }
        });
    });
</script>
@endsection