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

    <!-- Features Start -->
    <div class="container-xxl py-5" id="feature" style="margin-top: -40%;">
        <div class="container py-5 px-lg-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="text-primary-gradient fw-medium mb-5">HISTORY TRANSAKSI</h5>
            </div>
            <div class="row g-4">
                @if($data=='[]')
                <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative bg-light rounded pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            <img src="{{asset('img/bid/pp_bid.jpg')}}" class="rounded-circle" alt="" width="95%">
                        </div>
                        <h5 class="mt-4 mb-3">Tidak Ada Transaksi</h5>
                    </div>
                </div>
                @else
                @foreach($data as $data)
                <div class="col-12 pt-4 mb-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative bg-light rounded pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            <img src="{{asset('img/bid/pp_bid.jpg')}}" class="rounded-circle" alt="" width="95%">
                        </div>
                        <h5 class="mt-4 mb-3 text-center">{{$data->name_bid}}</h5>
                        <dl class="dl-horizontal row" style="font-size: smaller;">
                            <dd class="col-3">Site</dd>
                            <dd class="col-1">:</dd>
                            <dd class="col-8" style="font-weight: bold;">NGAWI</dd>
                            <dd class="col-3">Waktu Permintaan</dd>
                            <dd class="col-1">:</dd>
                            <dd class="col-8" style="font-weight: bold;">
                                {{date('Y-m-d', strtotime($data->date_bid))}}<br><span class="badge bg-info">Open Lelang 08:00</span>
                            </dd>
                            <dd class="col-3">Tanggal&nbsp;PO</dd>
                            <dd class="col-1">:</dd>
                            <dd class="col-8" style="font-weight: bold;">{{ \Carbon\Carbon::parse($data->open_po)->format('d-m-Y')}}</dd>
                            <dd class="col-3">Waktu Pengajuan</dd>
                            <dd class="col-1">:</dd>
                            <dd class="col-8" style="font-weight: bold;">{{date('Y-m-d', strtotime($data->date_biduser))}}<br><span class="badge bg-success">{{date('H:i:s', strtotime($data->date_biduser))}}</span></dd>
                            <dd class="col-3">Batas Permintaan</dd>
                            <dd class="col-1">:</dd>
                            <dd class="col-8" style="font-weight: bold;">{{date('Y-m-d', strtotime($data->batas_bid))}}<br><span class="badge bg-warning">Batas 12:00</span></dd>
                            <dd class="col-3">Jumlah Pengajuan</dd>
                            <dd class="col-1">:</dd>
                            <dd class="col-8" style="font-weight: bold;">{{$data->jumlah_kirim}} Truk</dd>
                            <dd class="col-3">Jumlah Disetujui</dd>
                            <dd class="col-1">:</dd>
                            <dd class="col-8" style="font-weight: bold;">
                                @if ($data->permintaan_kirim == '')
                                <span class="btn btn-sm btn-info">Dalam Pengajuan</span>
                                @elseif ($data->permintaan_kirim == '0')
                                <span class="btn btn-sm btn-danger">0 Truk</span>
                                @else
                                <a id="btn_klik" href="{{route('user.new_data_list_po', ['id' => $data->id_biduser])}}" name="{{$data->id_approvebid}}" title="Lihat PO" class="lihat_po btn btn-info btn-sm">
                                    <i class=""> </i> {{$data->permintaan_kirim}} Truk
                                </a>
                                @endif
                            </dd>
                            <dd class="col-3">Status</dd>
                            <dd class="col-1">:</dd>
                            <dd class="col-8" style="font-weight: bold;">
                                @if ($data->status_biduser == 1)
                                <a id="btn_disetujui" name="' . $data->user_id . '" data-jumlahkirim="' . $data->jumlah_kirim . '" data-idnyabid="' . $data->id_bid . '" title="Disetujui" class=" btn btn-sm btn-success">
                                    <i class="bi bi-check"> Disetujui </i>
                                </a>
                                @elseif ($data->status_biduser == 5)
                                <a id="btn_ditolak" name="" title="Ditolak" class=" btn btn-sm btn-danger">
                                    <i class="bi bi-dash"> Ditolak </i>
                                </a>
                                @elseif ($data->status_biduser == 3)
                                <a id="btn_disetujui" name="' . $data->user_id . '" data-jumlahkirim="' . $data->jumlah_kirim . '" data-idnyabid="' . $data->id_bid . '" title="Disetujui" class=" btn btn-sm btn-success">
                                    <i class="bi bi-check"> Disetujui </i>
                                </a>
                                @elseif ($data->status_biduser == 4)
                                <a name="' . $data->id_biduser . '" title="Pengiriman Telat" class="btn btn-sm btn-warning">
                                    <i class="bi bi-clipboard-minus-fill"> Proses Pengiriman Telat </i>
                                </a>
                                @elseif ($data->status_biduser == 0)
                                <a id="btn_pengajuan" title="Proses lelang" class=" btn btn-sm btn-info">
                                    <i class="bi bi-arrow-clockwise"> Pengajuan </i>
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



    @include('dashboard.user.new_user.layouts.menu')


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-lg-square back-to-top pt-2"><i class="bi bi-arrow-up text-white"></i></a>
</div>
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