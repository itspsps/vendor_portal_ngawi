@extends('dashboard.user.layout.main1')
@section('title')
SURYA PANGAN SEMESTA
@endsection
@section('content')
<style>
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

    .chat-messages {
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
<!-- begin:: Content -->
<div class="cart_page_bg" style=" background-image: url('public/assets_user/assets/img/slider/bg_sawah.jpg');background-size: cover;">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">

                <!--begin:: Widgets/Blog-->
                <div class="kt-portlet kt-portlet--height-fluid kt-widget19">
                    <div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">

                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
                        @if($count=='0')
                        <main class="content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="product_header">
                                            <div class="section_title s_title_style3">
                                                <ul class="nav" role="tablist">
                                                    <li>
                                                        <a class="btn btn-outline-danger" data-toggle="tab" href="/" role="tab" aria-controls="kediri" aria-selected="false">
                                                            <i class="fa fa-bell"></i> PEMBERITAHUAN
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="row g-0">
                                        <div class="col-12 col-lg-7 col-xl-9 mx-auto">
                                            <div class="position-relative">
                                                <div class="font-weight-bold mb-1  text-center">TIDAK ADA PEMBERITAHUAN</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                    </div>
                    </main>
                    @else
                    <main class="content">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="product_header">
                                        <div class="section_title s_title_style3">
                                            <ul class="nav" role="tablist">
                                                <li>
                                                    <a class="btn btn-outline-danger" style="background-color: #4D006E;" data-toggle="tab" href="/" role="tab" aria-controls="kediri" aria-selected="false">
                                                        <span style="color: white;">
                                                            <i class="fa fa-bell"></i> PEMBERITAHUAN
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="row g-0">
                                    <div class="col-12 col-lg-5 col-xl-3">

                                        <div class="px-4 d-none d-md-block">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <input type="text" class="form-control my-3" placeholder="Search...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start">
                                            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                @foreach($broadcaster_count as $data)
                                                <a href="javascript:void(0);" class="nav-link list-group-item list-group-item-action border-0" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                                    <div class="badge bg-success float-right">{{$data->total}}</div>
                                                    <div class="d-flex align-items-start">
                                                        <img src="{{asset('img/logosps.png')}}" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
                                                        <div class="flex-grow-1 ml-3">
                                                            VP-NGAWI
                                                            <div class="small"><span class="fa fa-circle chat-online"></span> {{$data->broadcast_kategory}}</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <hr class="d-block d-lg-none mt-1 mb-0">
                                    </div>
                                    <div class="col-12 col-lg-7 col-xl-9">
                                        <div class="py-2 px-4 border-bottom d-none d-lg-block">
                                            <div class="d-flex align-items-center py-1">
                                                <div class="position-relative">
                                                    <img src="{{asset('img/logosps.png')}}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                                </div>
                                                <div class="flex-grow-1 pl-3">
                                                    <strong>PT. SURYA PANGAN SEMESTA-NGAWI</strong>
                                                    <div class="text-muted small"><em>Informasi Supplier...</em></div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                        <div class="position-relative">
                                            <div class="chat-message-left p-4">
                                                <div class="dashboard_tab_button h-100">
                                                    <ul role="tablist" class="nav flex-column dashboard-list">
                                                        @foreach($broadcaster as $data)
                                                        <li>
                                                            <a href="#notif{{ $data->id_broadcast }}" data-toggle="tab" class="nav-link {{ $firsttabs == $data->id_broadcast ? 'active' : '' }}">
                                                                <img src="{{asset('img/logosps.png')}}" class="rounded-circle mr-1" alt="Sharon Lessman" width="50" height="50">
                                                                <div class="text-muted small text-nowrap mt-1">{{\Carbon\Carbon::parse($data->created_at)->format('d-m-Y');}}</div>
                                                            </a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="tab-content dashboard_content w-100">
                                                    @foreach($broadcaster as $data)
                                                    <div class="tab-pane {{ $firsttabs == $data->id_broadcast ? 'active' : 'fade' }}" id="notif{{ $data->id_broadcast }}" class="active">
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
                    </main>
                    @endif
                </div>

                <!--end:: Widgets/Blog-->
            </div>
        </div>
    </div>
</div>
</div>
<!-- end:: Content -->
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).on('click', '#btn_view', function() {
        var id = $(this).data('id');
        var file = $(this).data('file');
        var Judul_tagihan = $(this).data('tagihan_judul');
        var keterangan = $(this).data('keterangan');
        $('h4[id=judul_tagihan]').html(Judul_tagihan)
        $('label[id=keterangan_tagihan]').html(keterangan)
        console.log(file);
        // $('img[id=file_tagihan]').attr('src', 'https://ngawi.suryapangansemesta.store/public/dokumen/tagihan/' + file);
        PDFObject.embed("https://ngawi.suryapangansemesta.store/public/dokumen/tagihan/" + file, "#example1");
        $('#modal_view').modal('show');
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
    $(document).on('click', '#btn_akun', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
    });
    $(document).on('click', '#btn_readmore', function() {
        var id = $(this).data('id');
        var judul_broadcast = $(this).data('judul_broadcast');
        var isi_broadcast = $(this).data('isi_broadcast');
        var waktu_broadcast = $(this).data('waktu_broadcast');
        var gambar_broadcast = $(this).data('gambar_broadcast');
        console.log(id);
        $.ajax({
            url: "{{route('user.update_statusbaca')}}/" + id,
            type: "GET",
            error: function(data) {

            },
            success: function(data) {
                $('#pesanbroadcast').load(document.URL + ' #pesanbroadcast');
            }
        });
        $('label[id=judul]').html(judul_broadcast);
        $('p[id=waktu]').html('<i class="fa fa-clock-o"></i>&nbsp;' + waktu_broadcast);
        $('p[id=isi]').html(isi_broadcast);
        if (gambar_broadcast !== null) {
            $('#bg_image').html(
                '<img src="https://sumberpangan.store/public/img/broadcast/' +
                gambar_broadcast + '" width="50%" heigth="50%" />');
        }
        $("#modalreadmore").on("hidden.bs.modal", function() {
            $('label[id=judul]').html('');
            $('p[id=isi]').html('');
            $('p[id=waktu]').html('');
        });
        $('#modalreadmore').modal('show');
    });
</script>
@endsection