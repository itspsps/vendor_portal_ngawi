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
                <div class="card mx-auto" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;border-radius: 10px;">
                    <div class="card-content">
                        <div class="card-body mx-auto text-center">
                            <embed type="application/pdf" width="100%" height="500px" src="{{asset('dokumen/manual_book/buku_panduan.pdf')}}">
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

@endsection