@extends('dashboard.user.layout.main1')
@section('title')
SURYA PANGAN SEMESTA
@endsection
@section('content')
<style>
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
<div class="cart_page_bg" style="height:85%; background-image: url('public/assets_user/assets/img/slider/bg_sawah.jpg');background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto height-100">
                <div class="row">
                    <div class="col-12">
                        <div class="product_header">
                            <div class="section_title s_title_style3">
                                <ul class="nav" role="tablist">
                                    <li>
                                        <a class="btn btn-outline-danger" style="background-color: #4D006E;" data-toggle="tab" href="/" role="tab" aria-controls="kediri" aria-selected="false">
                                            <span style="color: white;">
                                                <i class="fa fa-info-circle"></i> TENTANG APLIKASI
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mx-auto" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;border-radius: 10px;">
                    <div class="card-content">
                        <div class="card-body mx-auto text-center">
                            <img src="{{asset('img/logosps.png')}}" alt="" width="40%">
                            <div>
                                <a href="{{asset('dokumen/manual_book/manual_book_ngawi.pdf')}}" download="MANUAL BOOK NGAWI" onclick="return true;" name="" title="Download" class=" btn m-btn btn-primary m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-download" style="color:white;">
                                    </i>
                                    Buku Panduan
                                </a>
                                <a href="{{route('user.video_panduan')}}" target="_blank" onclick="return true;" name="" title="Lihat" class=" btn m-btn btn-primary m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-eye" style="color:white;">
                                    </i>
                                    Video Tutorial
                                </a>
                            </div>
                            <p>Versi 1.1 </p>
                        </div>
                    </div>
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
                '<img src="https://ngawi.suryapangansemesta.store/public/img/broadcast/' +
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