@extends('dashboard.user.new_user.layouts.main')
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
            <h5 class="fw-medium mb-5"><b>HISTORY TRANSAKSI</b></h5>
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
                <div class="position-relative bg-light rounded pt-5 pb-4 px-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width:70px; height:70px;">
                        <img src="{{asset('assets_user/assets/img/logo/icon_sps_white1.png')}}" class="rounded-circle" alt="" width="90%">
                    </div>
                    <h6 class="mt-2 mb-3 text-center"><b>{{$data->name_bid}}</b></h6>
                    <dl class="dl-horizontal row" style="font-size: smaller;">
                        <dd class="col-3">Waktu Lelang</dd>
                        <dd class="col-1">:</dd>
                        <dd class="col-8" style="font-weight: bold;">
                            {{date('Y-m-d', strtotime($data->date_bid))}}<br><span class="badge bg-info">Open Lelang 08:00</span>
                        </dd>
                        <dd class="col-3">Tanggal&nbsp;PO</dd>
                        <dd class="col-1">:</dd>
                        <dd class="col-7" style="font-weight: bold;">{{ \Carbon\Carbon::parse($data->open_po)->format('d-m-Y')}}</dd>
                        <dd class="col-3">Waktu Pengajuan</dd>
                        <dd class="col-1">:</dd>
                        <dd class="col-7" style="font-weight: bold;">{{date('Y-m-d', strtotime($data->date_biduser))}}<br><span class="badge bg-success">{{date('H:i:s', strtotime($data->date_biduser))}}</span></dd>
                        <dd class="col-3">Batas Permintaan</dd>
                        <dd class="col-1">:</dd>
                        <dd class="col-7" style="font-weight: bold;">{{date('Y-m-d', strtotime($data->batas_bid))}}<br><span class="badge bg-warning">Batas 12:00</span></dd>
                        <dd class="col-3">Jumlah Pengajuan</dd>
                        <dd class="col-1">:</dd>
                        <dd class="col-7" style="font-weight: bold;">{{$data->jumlah_kirim}} Truk</dd>
                        <dd class="col-3">Jumlah Disetujui</dd>
                        <dd class="col-1">:</dd>
                        <dd class="col-7" style="font-weight: bold;">
                            @if ($data->permintaan_kirim == '')
                            <span class="btn btn-sm btn-info">Dalam Pengajuan</span>
                            @elseif ($data->permintaan_kirim == '0')
                            <span class="btn btn-sm btn-danger">0 Truk</span>
                            @else
                            <a id="btn_klik" href="{{route('user.new_data_list_po', ['id' => $data->id_biduser])}}" name="{{$data->id_approvebid}}" title="Lihat PO" class="lihat_po btn btn-success btn-sm">
                                <i class=""> </i> {{$data->permintaan_kirim}} Truk
                            </a>
                            @endif
                        </dd>
                        <dd class="col-3">Jumlah Ditolak</dd>
                        <dd class="col-1">:</dd>
                        <dd class="col-7" style="font-weight: bold;">
                            @if ($data->permintaan_ditolak == '')
                            <span class="btn btn-sm btn-info">Dalam Pengajuan</span>
                            @elseif ($data->permintaan_ditolak == '0')
                            <span class="btn btn-sm btn-danger">0 Truk</span>
                            @else
                            <a href="javascript:void(0);" name="{{$data->id_approvebid}}" title="Lihat PO" class="lihat_po btn btn-success btn-sm">
                                <i class=""> </i> {{$data->permintaan_ditolak}} Truk
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
    <!-- Features End -->





    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-lg-square back-to-top mb-5 pt-2"><i class="bi bi-arrow-up text-white"></i></a>
</div>
@include('dashboard.user.new_user.layouts.menu')
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).on('click', '#btn_pengiriman', function() {
        Swal.fire({
            title: 'Informasi',
            text: 'PO Anda Sedang Pengiriman',
            icon: 'info',
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
</script>
@endsection