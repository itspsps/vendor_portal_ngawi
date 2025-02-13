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
                <h5 class="text-primary-gradient fw-medium">DAFTAR LELANG</h5>
                <h1 class="mb-5">GABAH BASAH</h1>
            </div>
            <div class="row g-4">
                @foreach ($site_ngawi_longgrain as $site_ngawi_longgrain)
                <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="feature-item bg-light rounded p-4 text-center">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded mb-4 text-center" style="width: 150px; height: 150px;">
                            <a class="primary_img" id="btn_lelang_detail" href="{{url('user/new_lelang_detail/'.$site_ngawi_longgrain->id_bid)}}"><img src="{{asset('img/bid/pp_bid.jpg')}}" alt="" width="95%"></a>
                        </div>
                        <h3 class="mb-1">{{$site_ngawi_longgrain->name_bid}}</h3>
                        <h5 class="text-primary-gradient fw-medium">SITE NGAWI</h5>
                        <p class="m-0">PO: {{date('d-m-Y', strtotime($site_ngawi_longgrain->open_po))}}</p>
                        <div class="product_timing">
                            <div data-countdown="{{$site_ngawi_longgrain->batas_bid}}">
                            </div>
                        </div>
                        <a id="btn_klik" href="{{url('user/new_lelang_detail/'.$site_ngawi_longgrain->id_bid)}}" class="btn btn-primary-gradient rounded-pill py-2 px-4 mt-4">IKUTI LELANG</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Features End -->



    @include('dashboard.user.new_user.layouts.menu')


</div>
@endsection
@section('js')
<script src="https://cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $('[data-countdown]').each(function() {
        var $this = $(this),
            finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('<div class="countdown_area"><div class="row g-4"><div class="col-3"><div class="feature-item bg-light rounded p-2 text-center"><div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-3" style="width: 40px; height: 40px;"><div class="countdown_number text-white">%D</div></div><div class="countdown_title">Hari</div></div></div><div class="col-3"><div class="feature-item bg-light rounded p-2 text-center"><div class="d-inline-flex align-items-center justify-content-center bg-secondary-gradient rounded-circle mb-3" style="width: 40px; height: 40px;"><div class="countdown_number text-white">%H</div></div><div class="countdown_title">Jam</div></div></div><div class="col-3"><div class="feature-item bg-light rounded p-2 text-center"><div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-3" style="width: 40px; height: 40px;"><div class="countdown_number text-white">%M</div></div><div class="countdown_title">Menit</div></div></div><div class="col-3"><div class="feature-item bg-light rounded p-2 text-center"><div class="d-inline-flex align-items-center justify-content-center bg-secondary-gradient rounded-circle mb-3" style="width: 40px; height: 40px;"><div class="countdown_number text-white">%S</div></div><div class="countdown_title">Detik</div></div></div></div></div>'));
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