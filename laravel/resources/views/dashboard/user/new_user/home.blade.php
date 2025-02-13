@extends('dashboard.user.new_user.layouts.main')

@section('css')
<style>
    @media only screen and (max-width: 600px) {
        #about {
            margin-top: -150px;
        }

        .notif_lelang {
            position: absolute;
            margin-left: 25%;
            font-size: 10px;
        }

        .count_transaksi {
            position: absolute;
            margin-left: 27%;
            font-size: 10px;
        }

        .count_notif {
            position: absolute;
            margin-left: 27%;
            font-size: 10px;
        }

        .count_pajak {
            position: absolute;
            margin-left: 27%;
            font-size: 10px;
        }

        .count_transaksi {
            position: absolute;
            margin-left: 27%;
            font-size: 10px;
        }

        .text_pesanan {
            font-size: 17px;
        }

        .text_transaksi {
            font-size: 17px;
        }

        .text_history {
            font-size: 17px;
        }

        .text_notif {
            font-size: 17px;
        }

        .text_pajak {
            font-size: 17px;
        }

        .text_berita {
            font-size: 17px;
        }
    }

    @media only screen and (max-width: 500px) {
        #about {
            margin-top: -150px;
        }

        .notif_lelang {
            position: absolute;
            margin-left: 22%;
            font-size: 10px;
        }

        .count_transaksi {
            position: absolute;
            margin-left: 25%;
            font-size: 10px;
        }

        .count_notif {
            position: absolute;
            margin-left: 25%;
            font-size: 10px;
        }

        .count_pajak {
            position: absolute;
            margin-left: 25%;
            font-size: 10px;
        }

        .count_transaksi {
            position: absolute;
            margin-left: 25%;
            font-size: 10px;
        }

        .text_pesanan {
            font-size: 15px;
        }

        .text_transaksi {
            font-size: 15px;
        }

        .text_history {
            font-size: 15px;
        }

        .text_notif {
            font-size: 15px;
        }

        .text_pajak {
            font-size: 15px;
        }

        .text_berita {
            font-size: 15px;
        }
    }

    @media only screen and (max-width: 400px) {
        #about {
            margin-top: -150px;
        }

        .notif_lelang {
            position: absolute;
            margin-left: 20%;
            font-size: 10px;
        }

        .count_transaksi {
            position: absolute;
            margin-left: 22%;
            font-size: 10px;
        }

        .count_notif {
            position: absolute;
            margin-left: 22%;
            font-size: 10px;
        }

        .count_pajak {
            position: absolute;
            margin-left: 22%;
            font-size: 10px;
        }

        .count_transaksi {
            position: absolute;
            margin-left: 22%;
            font-size: 10px;
        }

        .text_pesanan {
            font-size: 13px;
        }

        .text_transaksi {
            font-size: 13px;
        }

        .text_history {
            font-size: 13px;
        }

        .text_notif {
            font-size: 13px;
        }

        .text_pajak {
            font-size: 13px;
        }

        .text_berita {
            font-size: 13px;
        }
    }

    @media only screen and (max-width: 300px) {
        #about {
            margin-top: -170px;
        }

        .notif_lelang {
            position: absolute;
            margin-left: 20%;
            font-size: 10px;
        }

        .count_transaksi {
            position: absolute;
            margin-left: 20%;
            font-size: 10px;
        }

        .count_notif {
            position: absolute;
            margin-left: 20%;
            font-size: 10px;
        }

        .count_pajak {
            position: absolute;
            margin-left: 20%;
            font-size: 10px;
        }

        .count_transaksi {
            position: absolute;
            margin-left: 20%;
            font-size: 10px;
        }

        .text_pesanan {
            font-size: 12px;
        }

        .text_transaksi {
            font-size: 12px;
        }

        .text_history {
            font-size: 12px;
        }

        .text_notif {
            font-size: 12px;
        }

        .text_pajak {
            font-size: 12px;
        }

        .text_berita {
            font-size: 12px;
        }
    }
</style>
@endsection
@section('content')
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


    @include('dashboard.user.new_user.layouts.header')


    <!-- About Start -->
    <div class="container-xxl" id="about">
        <div class=" row g-5 align-items-center">
            <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="text-primary-gradient fw-medium">Menu</h5>
                <div class="row g-4">
                    <div class="col-4 wow fadeInUp" data-wow-delay="0.1s">
                        <span class="notif_lelang badge bg-primary-gradient wow fadeInUp" data-wow-delay="0.1s"></span>
                        <a id="btn_klik" href="{{route('user.new_daftar_lelang')}}">
                            <div class="feature-item bg-light rounded p-2 text-center">
                                <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-3" style="width: 40px; height: 40px;">
                                    <i class="fa fa-bars text-white fs-4"></i>
                                </div>
                                <h6 class="text_pesanan mb-2">Pesanan</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-4 wow fadeInUp" data-wow-delay="0.3s">
                        <span class="count_transaksi badge bg-primary-gradient wow fadeInUp" data-wow-delay="0.1s"></span>
                        <a id="btn_klik" href="{{route('user.new_transaksi')}}">
                            <div class="feature-item bg-light rounded p-2 text-center">
                                <div class="d-inline-flex align-items-center justify-content-center bg-secondary-gradient rounded-circle mb-3" style="width: 40px; height: 40px;">
                                    <i class="fa fa-address-card text-white fs-4"></i>
                                </div>
                                <h6 class="text_transaksi mb-2">Transaksi</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-4 wow fadeInUp" data-wow-delay="0.5s">
                        <a id="btn_klik" href="{{route('user.new_history')}}">
                            <div class="feature-item bg-light rounded p-2 text-center">
                                <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-3" style="width: 40px; height: 40px;">
                                    <i class="fa fa-history text-white fs-4"></i>
                                </div>
                                <h6 class="text_history mb-2">History</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-4 wow fadeInUp" data-wow-delay="0.1s">
                        <span class="count_notif badge bg-primary-gradient wow fadeInUp" data-wow-delay="0.1s"></span>
                        <a id="btn_klik" href="{{route('user.new_notif')}}">
                            <div class="feature-item bg-light rounded p-2 text-center">
                                <div class="d-inline-flex align-items-center justify-content-center bg-secondary-gradient rounded-circle mb-3" style="width: 40px; height: 40px;">
                                    <i class="fa fa-bell text-white fs-4"></i>
                                </div>
                                <h6 class="text_notif mb-2">Notif</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-4 wow fadeInUp" data-wow-delay="0.3s">
                        <span class="count_pajak badge bg-primary-gradient wow fadeInUp" data-wow-delay="0.1s"></span>
                        <a id="btn_klik" href="{{route('user.new_potong_pajak')}}">
                            <div class="feature-item bg-light rounded p-2 text-center">
                                <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-3" style="width: 40px; height: 40px;">
                                    <i class="fa fa-file text-white fs-4"></i>
                                </div>
                                <h6 class="text_pajak mb-2">Bukti Pajak</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-4 wow fadeInUp" data-wow-delay="0.5s">
                        <a id="btn_klik" href="{{route('user.new_berita')}}">
                            <div class="feature-item bg-light rounded p-2 text-center">
                                <div class="d-inline-flex align-items-center justify-content-center bg-secondary-gradient rounded-circle mb-3" style="width: 40px; height: 40px;">
                                    <i class="fa fa-newspaper text-white fs-4"></i>
                                </div>
                                <h6 class="text_berita mb-2">Berita</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    @include('dashboard.user.new_user.layouts.footer')

    <a href="#" class="btn btn-lg btn-lg-square back-to-top pt-2"><i class="bi bi-arrow-up text-white"></i></a>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
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
<script type="text/javascript">
    function getcount_notifikasi() {
        $.ajax({
            type: "GET",
            url: "{{route('user.getcount_notifikasi')}}",
            success: function(data) {
                // console.log(data);
                $("#count_transaksi").empty();
                $("#count_notif").empty();
                $("#count_pajak").empty();
                // var notif = JSON.parse();
                $(".count_transaksi").html(data.getcount_transaksi);
                $(".count_notif").html(data.getcount_broadcast);
                $(".count_pajak").html(data.getcount_pajak);
                if (data.notif_lelang > 0) {
                    $(".notif_lelang").empty();
                    $(".notif_lelang").html('New');
                } else {
                    $(".notif_lelang").empty();
                }
            }
        });
    }


    setInterval(getcount_notifikasi, 2000);
</script>
@endsection