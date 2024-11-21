@extends('dashboard.user.layout.main')
@section('title')
SURYA PANGAN SEMESTA
@endsection
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap-extended.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/colors.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

@section('content')
@include('sweetalert::alert')
<!-- @include('sweet::alert') -->
<!--home section bg area start-->
<div class="home_section_bg" style="background-image: url('public/assets_user/assets/img/slider/bg_sawah.jpg');background-size: cover;">
    <div class="product_area" style="margin-top: -10px;">
        <div class="">
            <div class="grey-bg container-fluid">
                <section id="minimal-statistics">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-xl-3 col-sm-6 col-6">
                                <a style="text-align: center;" id="btn_lelang" href="{{ route('user.daftar_lelang') }}">
                                    <div class="card" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;border-radius: 10px;">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <i class="icon-list font-large-5" style="color: #4D006E"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p style="font-size: 12px;text-align:center;"><b>DAFTAR PESANAN</b></p>
                                        </div>
                                        <div class="notif_lelang" style="position: absolute;margin-top:-8px; left: 95%; float:right; color: white;">
                                            <h4>

                                                @if($site_ngawi=='[]')
                                                @else
                                                <span class="badge badge-success ">New</span>
                                                @endif
                                            </h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-6">
                                <a style="text-align: center;" id="btn_transaksi" href="{{ route('user.transaksi') }}">
                                    <div class="card" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;border-radius: 10px;">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <i class="fa fa-money font-large-5" style="color: #4D006E"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p style="font-size: 12px;text-align:center; "><b>TRANSAKSI</b></p>
                                        </div>
                                        <div style="position: absolute;margin-top:-8px; left: 95%; float:right; color: white;">
                                            <h4>
                                                <span id="count_transaksi" class="badge badge badge-success" style="position:absolute; margin-top: 0px; margin-left: 1%; width: max-content; text-align: left;">
                                                </span>
                                            </h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-6">
                                <a style="text-align: center;" id="btn_riwayat_transaksi" href="{{ route('user.riwayat_transaksi') }}">
                                    <div class="card" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;border-radius: 10px;">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <i class="fa fa-history font-large-5" style="color: #4D006E"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p style="font-size: 12px;text-align:center; "><b>HISTORY</b></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-6">
                                <a style="text-align: center;" id="btn_pemberitahuan" href="{{ route('user.pemberitahuan') }}">
                                    <div class="card position-relative" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;border-radius: 10px;">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <i class="fa fa-bell font-large-5" style="text-align: center; color: #4D006E"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p style="font-size: 12px;text-align:center; "><b>PEMBERITAHUAN</b></p>
                                        </div>
                                        <div style="position: absolute;margin-top:-8px; left: 97%; float:right; color: white;">
                                            <h4>
                                                <span id="count_notif" class="badge badge badge-success" style="position:absolute; margin-top: 0px; margin-left: 1%; width: max-content; text-align: left;">
                                                </span>
                                            </h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-6">
                                <a style="text-align: center;" id="btn_potong_pajak" href="{{ route('user.potong_pajak') }}">
                                    <div class="card" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;border-radius: 10px;">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <i class="fa fa-file-pdf-o font-large-5" style="text-align: center; color: #4D006E"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p style="font-size: 12px;text-align:center; "><b>BUKTI POTONG PAJAK</b></p>
                                        </div>
                                        <div style="position: absolute;margin-top:-8px; left: 97%; float:right; color: white;">
                                            <h4>
                                                <span id="count_pajak" class="badge badge badge-success" style="position:absolute; margin-top: 0px; margin-left: 1%; width: max-content; text-align: left;">
                                                </span>
                                            </h4>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-xl-3 col-sm-6 col-6">
                                <a style="text-align: center;" id="btn_berita" href="{{ route('user.berita') }}">
                                    <div class="card" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;border-radius: 10px;">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <i class="fa fa-newspaper-o font-large-5" style="text-align: center; color: #4D006E"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p style="font-size: 12px;text-align:center;"><b>BERITA</b></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-6">
                                <a style="text-align: center;" id="btn_akun" href="{{ route('user.akun') }}">
                                    <div class="card" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;border-radius: 10px;">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <i class="fa fa-user font-large-5" style="color: #4D006E"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p style="font-size: 12px;text-align:center; "><b>AKUN</b></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-6">
                                <a style="text-align: center;" id="btn_about_us" href="{{ route('user.about_us') }}">
                                    <div class="card" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;border-radius: 10px;">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <i class="fa fa-info-circle font-large-5" style="color: #4D006E"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p style="font-size: 12px;text-align:center; "><b>TENTANG APLIKASI</b></p>
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
</div>

<!--home section bg area end-->
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).on('click', '#btn_login', function(e) {
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
    $(document).on('click', '#btn_lelang', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
    });
    $(document).on('click', '#btn_transaksi', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
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
    $(document).on('click', '#btn_riwayat_transaksi', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
    });
    $(document).on('click', '#btn_pemberitahuan', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
    });
    $(document).on('click', '#btn_potong_pajak', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
    });
    $(document).on('click', '#btn_berita', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
    });
    $(document).on('click', '#btn_akun', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
    });
    $(document).on('click', '#btn_about_us', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
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
                console.log(data);
                $("#count_transaksi").empty();
                // var notif = JSON.parse();
                $("#count_transaksi").html(data.getcount_transaksi);
                $("#count_notif").html(data.getcount_broadcast);
                $("#count_pajak").html(data.getcount_pajak);
                if (data.notif_lelang > 0) {
                    $(".notif_lelang").empty();
                    $(".notif_lelang").append('<span class="badge badge-success ">New</span>');
                } else {
                    $(".notif_lelang").empty();
                }
            }
        });
    }


    setInterval(getcount_notifikasi, 2000);
    // setInterval(getcount_transaksi, 2000);
    // setInterval(getcount_notif, 2000);
    // setInterval(getcount_pajak, 2000);
</script>
@endsection