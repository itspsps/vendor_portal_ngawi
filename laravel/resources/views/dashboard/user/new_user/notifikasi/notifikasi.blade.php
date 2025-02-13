@extends('dashboard.user.new_user.layouts.main')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
<style>
    .tabs-below>.nav-tabs,
    .tabs-right>.nav-tabs,
    .tabs-left>.nav-tabs {
        border-bottom: 0;
    }

    .tab-content>.tab-pane,
    .pill-content>.pill-pane {
        display: none;
    }

    .tab-content>.active,
    .pill-content>.active {
        display: block;
    }

    .tabs-below>.nav-tabs {
        border-top: 1px solid #ddd;
    }

    .tabs-below>.nav-tabs>li {
        margin-top: -1px;
        margin-bottom: 0;
    }

    .tabs-below>.nav-tabs>li>a {
        -webkit-border-radius: 0 0 4px 4px;
        -moz-border-radius: 0 0 4px 4px;
        border-radius: 0 0 4px 4px;
    }

    .tabs-below>.nav-tabs>li>a:hover,
    .tabs-below>.nav-tabs>li>a:focus {
        border-top-color: #ddd;
        border-bottom-color: transparent;
    }

    .tabs-below>.nav-tabs>.active>a,
    .tabs-below>.nav-tabs>.active>a:hover,
    .tabs-below>.nav-tabs>.active>a:focus {
        border-color: transparent #ddd #ddd #ddd;
    }

    .tabs-left>.nav-tabs>li,
    .tabs-right>.nav-tabs>li {
        float: none;
    }

    .tabs-left>.nav-tabs>li>a,
    .tabs-right>.nav-tabs>li>a {
        min-width: 74px;
        margin-right: 0;
        margin-bottom: 3px;
    }

    .tabs-left>.nav-tabs {
        float: left;
        margin-right: 19px;
        border-right: 1px solid #ddd;
    }

    .tabs-left>.nav-tabs>li>a {
        margin-right: -1px;
        -webkit-border-radius: 4px 0 0 4px;
        -moz-border-radius: 4px 0 0 4px;
        border-radius: 4px 0 0 4px;
    }

    .tabs-left>.nav-tabs>li>a:hover,
    .tabs-left>.nav-tabs>li>a:focus {
        border-color: #eeeeee #dddddd #eeeeee #eeeeee;
    }

    .tabs-left>.nav-tabs .active>a,
    .tabs-left>.nav-tabs .active>a:hover,
    .tabs-left>.nav-tabs .active>a:focus {
        border-color: #ddd transparent #ddd #ddd;
        *border-right-color: #ffffff;
    }

    .tabs-right>.nav-tabs {
        float: right;
        margin-left: 19px;
        border-left: 1px solid #ddd;
    }

    .tabs-right>.nav-tabs>li>a {
        margin-left: -1px;
        -webkit-border-radius: 0 4px 4px 0;
        -moz-border-radius: 0 4px 4px 0;
        border-radius: 0 4px 4px 0;
    }

    .tabs-right>.nav-tabs>li>a:hover,
    .tabs-right>.nav-tabs>li>a:focus {
        border-color: #eeeeee #eeeeee #eeeeee #dddddd;
    }

    .tabs-right>.nav-tabs .active>a,
    .tabs-right>.nav-tabs .active>a:hover,
    .tabs-right>.nav-tabs .active>a:focus {
        border-color: #ddd #ddd #ddd transparent;
        *border-left-color: #ffffff;
    }

    .table {
        display: block;
    }

    .dashboard_tab_button ul li a.active {
        background-color: #d0f7dc;
    }

    .dashboard_tab_button ul li a {
        background-color: transparent;
    }

    .chat-online {
        color: #34ce57
    }

    .chat-offline {
        color: #e4606d
    }

    .chat-message {
        display: flex;
        flex-direction: column;
        max-height: 800px;
        overflow-y: scroll
    }

    .chat-message-left,
    .chat-message-right {
        display: flex;
        flex-shrink: 0
    }

    .chat-message-left {
        margin-right: auto
    }

    .chat-message-right {
        flex-direction: row-reverse;
        margin-left: auto
    }

    .py-3 {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    .px-4 {
        padding-right: 1.5rem !important;
        padding-left: 1.5rem !important;
    }

    .flex-grow-0 {
        flex-grow: 0 !important;
    }

    .border-top {
        border-top: 1px solid #dee2e6 !important;
    }

    .thumb {
        display: inline-block;
        margin-right: 10px;
    }

    .thumb i {
        font-size: 30px;
        margin: 0;
        color: #2e383e;
    }

    .file-name {
        display: block;
        margin-bottom: 0;
        color: #2e383e;
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



    <!-- Features Start -->
    <div class="container-xxl py-5" id="feature" style="margin-top: -40%;">
        <div class="container py-5 px-lg-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="text-primary-gradient fw-medium mb-5">PEMBERITAHUAN</h5>
            </div>
            <div class="row g-4">
                @if($broadcaster_count=='[]')
                <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative bg-light rounded pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            <img src="{{asset('img/bid/pp_bid.jpg')}}" class="rounded-circle" alt="" width="95%">
                        </div>
                        <h5 class="mt-4 mb-3">Tidak Ada Pemberitahuan</h5>
                    </div>
                </div>
                @else
                @foreach($broadcaster_count as $data)
                <div class="col-12 pt-4 mb-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative bg-light rounded pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            @foreach($broadcaster_count as $data)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">{{$data->total}}</span>
                            @endforeach
                            <img src="{{asset('img/bid/pp_bid.jpg')}}" class="rounded-circle" alt="" width="95%">
                        </div>
                        <h5 class=" mt-4 mb-3 text-center"></h5>
                        <div class="row g-0">
                            <div class="col-12 col-lg-7 col-xl-9">
                                <div class="position-relative">
                                    <div class="chat-message-left p-4">
                                        <div class="dashboard_tab_button h-100">
                                            <ul role="tablist" class="nav flex-column dashboard-list">
                                                @foreach($broadcaster as $data)
                                                <li>
                                                    <a href="#notif{{ $data->id_broadcast }}" data-bs-toggle="tab" class="nav-link {{ $firsttabs == $data->id_broadcast ? 'active' : '' }}">
                                                        <img src="{{asset('img/logosps.png')}}" class="rounded-circle mr-1" alt="Sharon Lessman" width="50" height="50">
                                                        <div class="text-muted small text-nowrap mt-1">{{\Carbon\Carbon::parse($data->created_at)->format('d-m-Y');}}</div>
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="tab-content dashboard_content w-100">
                                            @foreach($broadcaster as $data)
                                            <div class="tab-pane {{ $firsttabs == $data->id_broadcast ? 'active' : 'fade' }}" id="notif{{ $data->id_broadcast }}">
                                                <div class="flex-shrink-1 bg-light rounded py-2 px-3">
                                                    <div class="font-weight-bold mb-1">{{$data->broadcast_judul}}</div>
                                                    {{$data->broadcast_text}}
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <span><i>Dibuat Tanggal:</i></span>
                                                    <br>
                                                    <span><i class="mdi mdi-clock"></i> {{\Carbon\Carbon::parse($data->created_at)->format('d-m-Y H:i');}}</span>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- Features End -->



    @include('dashboard.user.new_user.layouts.menu')
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).on('click', '#btn_pengajuan', function() {
        Swal.fire({
            title: 'Mohon Ditunggu',
            text: 'Pengajuan Anda Sedang Kami Proses',
            icon: 'warning',
            timer: 1500
        })
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