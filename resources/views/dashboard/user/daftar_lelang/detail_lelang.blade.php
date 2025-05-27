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
<div class="home_section_bg" style="box-shadow: 3px 3px 20px; background: rgb(255, 255, 255);background-size: cover; height: max-content; margin-bottom: 5%; border-radius: 20px;">
    <div class="container py-5 px-lg-5">
        <div class="row pt-3 pb-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="fw-medium mb-3"><b>DETAIL LELANG</b></h5>
            </div>
            <div class="container">
                <!--product details start-->
                <div class="row g-4">
                    <div class="col-12 pt-4 mb-5 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="position-relative rounded px-4">
                            <div class="logo-icon">
                                <img class="img_gabah" src="{{asset('img_gabah.png')}}" style="-webkit-filter: drop-shadow(2px 2px 5px #222);filter: drop-shadow(2px 2px 5px #222);" width="50%" alt="big-1">
                            </div>
                            @if($data->name_bid=='GABAH BASAH LONG GRAIN')
                            <h6 class="text-center mt-2" style="color: rgb(110, 97, 209);"><b>{{$data->name_bid}}</b></h6>
                            @else
                            <h6 class="text-center mt-2" style="color: rgb(31, 148, 70);"><b>{{$data->name_bid}}</b></h6>
                            @endif
                            <form id="form_lelang" method="POST" action="{{ route('user.lelang_storeuser') }}" enctype="multipart/form-data">

                                {{ csrf_field() }}
                                {{ method_field('POST') }}
                                <input type="hidden" name="bid_id" value="{{$data->id_bid}}">
                                <div class="col-lg-12 col-sm-12 pt-12 mb-2">
                                    <div class="position-relative bg-light rounded pt-2 pb-2 px-4">
                                        <h6>
                                            <b>Keterangan :</b>
                                            <br>
                                            {{$data->description_bid}}
                                        </h6>
                                    </div>
                                </div>
                                <input type="hidden" name="name_bid" id="name_bid" value="{{$data->name_bid}}">
                                <input type="hidden" name="id_bid" id="id_bid" value="{{$data->id_bid}}">
                                <input type="hidden" name="tanggal_po" id="tanggal_po" value="{{$data->open_po}}">
                                <div class="product_variant ">
                                    <label for="">Jumlah Kirim (Truk)</label>
                                    <input type="number" style="width: 100%" id="jumlah_kirim" name="jumlah_kirim" class="form-control @error('jumlah_kirim') is-invalid @enderror" placeholder="1 Truk" value="{{old('jumlah_kirim')}}">
                                    @error('jumlah_kirim')
                                    <div class="alert alert-danger d-flex align-items-center" style="padding: 5px 5px !important;" role="alert">
                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                        <div>
                                            <span>
                                                &nbsp;{{ $message }}
                                            </span>
                                        </div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="product_variant ">
                                    <label for="">Asal Gabah</label>
                                    <textarea name="description_biduser" id="description_biduser" required style="width: 100%" class="form-control @error('description_biduser') is-invalid @enderror" placeholder="Asal Gabah" rows="2">{{old('description_biduser')}}</textarea>
                                    @error('description_biduser')
                                    <div class="alert alert-danger d-flex align-items-center" style="padding: 5px 5px !important;" role="alert">
                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                        <div>
                                            <span>
                                                &nbsp;{{ $message }}
                                            </span>
                                        </div>
                                    </div>
                                    @enderror
                                </div>
                                <input type="hidden" value="{{$data->lokasi}}" name="site_id">
                                <br>
                                @if($data->bid_status == 0)
                                @if (($data->batas_bid) > date('Y-m-d H:i:s'))
                                <div class="product_variant quantity">
                                    <button id="btn_statustidakaktif" type="button" class="btn btn-danger" style="width: 100%; background-color: rgb(219, 55, 49); color: white;">
                                        Lelang Tidak Aktif
                                    </button>
                                </div>
                                @else
                                <div class="product_variant quantity">
                                    <button id="btn_lelangberakhir" type="button" class="btn btn-danger" style="width: 100%; background-color: rgb(219, 55, 49); color: white;">
                                        Lelang Berakhir
                                    </button>
                                </div>
                                @endif
                                @else
                                @if (($data->batas_bid) > date('Y-m-d H:i:s'))
                                <div class="col-lg-12">
                                    <button class="btn btn-sm btn-primary" style="width: 100%; background-color: rgb(110, 97, 209); border: none; border-radius: 5px; color: white;" data-bs-toggle="offcanvas" data-bs-target="#konfirmasilelang" aria-controls="konfirmasilelang" type="button">IKUTI LELANG</button>
                                    <div class="button_kembali" style="display: flex; align-items: center; justify-content: center;">
                                        <a id="btn_klik" width="100%" class="text-center text-center text-primary-gradient" href="{{route('user.daftar_lelang')}}">Kembali</a>
                                    </div>
                                </div>
                                @else
                                <div class="product_variant quantity">
                                    <button id="btn_lelangberakhir" type="button" class="btn btn-danger" style="width: 100%; background-color: rgb(219, 55, 49); color: white;">
                                        Lelang Berakhir
                                    </button>
                                    <div class="button_kembali" style="display: flex; align-items: center; justify-content: center;">
                                        <a id="btn_klik" width="100%" class="text-center text-center text-primary-gradient" href="{{route('user.daftar_lelang')}}">Kembali</a>
                                    </div>
                                </div>
                                @endif
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offcanvas offcanvas-bottom" style="box-shadow: 3px 3px 20px; border-radius: 20px 20px 0px 0px; height: max-content;" tabindex="-1" id="konfirmasilelang">

                <div class="offcanvas-body small">
                    <div class="text-center mt-3 mb-3">
                        <h6>
                            Apakah data sudah benar?
                        </h6>
                        <br>
                        <button id="btn_save_lelang" class="btn btn-sm btn-outline-secondary" style="border-color: rgb(110, 97, 209); border-radius: 9px; width: 70px; box-shadow: 1px 2px 3px #4a4a4a;">Ya</button>
                        <button class="btn btn-sm btn-danger" style="background-color: rgb(191, 49, 13); color: white; border-radius: 9px; width: 70px; box-shadow: 1px 2px 3px #4a4a4a;" aria-label="Close" data-bs-dismiss="offcanvas">Tidak</button>
                    </div>
                </div>
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
    </div>
</div>
@include('dashboard.user.layouts.menu')
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.10.2/lottie.min.js"></script>
<script>
    $(document).ready(function() {
        @if(Session::has('lelang_warning'))
        var offcanvasElement = document.getElementById('notif');
        $('#content-notif').html('Pengajuan Anda Sebelumnya Belum Di Setujui Sourching');
        var bsOffcanvas = new bootstrap.Offcanvas(offcanvasElement);

        var lottieAnim = lottie.loadAnimation({
            container: document.getElementById('lottie-animation'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: "{{ asset('assets_user/assets/animation/close.json') }}",
        });

        bsOffcanvas.show();
        @elseif(Session::has('not_login'))
        var offcanvasElement = document.getElementById('notif');
        $('#content-notif').html('Harap Login Terlebih Dahulu');
        var bsOffcanvas = new bootstrap.Offcanvas(offcanvasElement);

        var lottieAnim = lottie.loadAnimation({
            container: document.getElementById('lottie-animation'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: "{{ asset('assets_user/assets/animation/close.json') }}",
        });

        bsOffcanvas.show();
        @endif
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
        $(document).on('click', '#btn_save_lelang', function(e) {
            // console.log('ok');
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
            $('#form_lelang').submit();
            // Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

        });
    });
</script>
@endsection