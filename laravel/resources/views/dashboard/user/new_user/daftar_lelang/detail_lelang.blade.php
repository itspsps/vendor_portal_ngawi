@extends('dashboard.user.new_user.layouts.main')

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

    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
            </div>
            <div class="dropdown mt-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                    Dropdown button
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Features Start -->
    <div class="container-xxl py-5" id="feature" style="margin-top: -40%;">
        <div class="container py-5 px-lg-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="text-primary-gradient fw-medium">DETAIL LELANG</h5>
                <h1 class="mb-5">GABAH BASAH</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="feature-item bg-light rounded p-4 text-center">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded mb-4 text-center" style="width: 150px; height: 150px;">
                            <img src="{{asset('img/bid/pp_bid.jpg')}}" alt="" width="95%">
                        </div>
                        <h5 class="text-primary-gradient fw-medium">{{$data->name_bid}}</h5>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                            <a href="" class="d-flex bg-primary-gradient rounded py-3 px-4">
                                <i class="fa fa-truck fa-2x text-white flex-shrink-0"></i>
                                <div class="ms-3">
                                    <p class="text-white mb-0">
                                        Kuota Lelang : <b>
                                            {{tonase($jumlah_kuota)}} ({{$jumlah_kuotatruk}} Truk)
                                        </b>
                                        <br>
                                        Sisa Kuota : {{tonase($get_sisakuota)}} ({{$sisakuota}} Truk)
                                    </p>
                                </div>
                            </a>
                        </div>
                        <form id="form_lelang" method="POST" action="{{ route('user.new_lelang_storeuser') }}">
                            @csrf
                            <input type="hidden" name="name_bid" id="name_bid" value="{{$data->name_bid}}">
                            <input type="hidden" name="bid_id" id="bid_id" value="{{$data->id_bid}}">
                            <input type="hidden" name="tanggal_po" id="tanggal_po" value="{{$data->open_po}}">
                            <input type="hidden" value="{{$data->lokasi}}" name="site_id">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="position-relative w-100 mt-3">
                                        <input class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text" id="jumlah_kirim" name="jumlah_kirim" placeholder="Jumlah Kirim Truk" style="height: 48px;">
                                        <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i class="fa fa-truck text-primary-gradient fs-4"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative w-100 mt-3">
                                        <textarea class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text" id="description_biduser" name="description_biduser" placeholder="Asal gabah" style="height: 48px;"></textarea>
                                        <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i class="fa fa-map-marker text-primary-gradient fs-4"></i></button>
                                    </div>
                                </div>
                            </div>
                            <button id="btn_ikut_lelang" type="button" class="btn btn-primary-gradient rounded-pill py-2 px-4 mt-4">IKUTI LELANG</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->

    @include('dashboard.user.new_user.layouts.footer')


    @include('dashboard.user.new_user.layouts.menu')
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
    $(document).on('click', '#btn_ikut_lelang', function(e) {
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
                if ($('#jumlah_kirim').val() == '' || $('#description_biduser').val() == '') {
                    Swal.fire('Gagal!', 'Data Harus Terisi.', 'error')
                } else {
                    Swal.fire({
                        title: 'Harap Tuggu Sebentar!',
                        html: 'Proses Update Data...', // add html attribute if you want or remove
                        allowOutsideClick: false,
                        html: ' <div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div>',
                        showCancelButton: false,
                        showConfirmButton: false,
                        onBeforeOpen: () => {
                            // Swal.showLoading()
                        },
                    });
                    $('#form_lelang').submit();
                    // Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                }
            } else {
                Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

            }
        });
    });
</script>
@endsection