@extends('dashboard.superadmin.layout.main')
@section('title')
SURYA PANGAN SEMESTA
@endsection
<style type="text/css">
    * {
        text-decoration: none;
        margin: 0;
        padding: 0;
        outline: none;
        box-shadow: none;
        box-sizing: border-box !important;
        -webkit-box-sizing: border-box !important;
        -moz- box-sizing: border-box !important;
        -ms-box-sizing: border-box !important;
    }

    body {
        font-family: Arial;
        font-size: 12px;
        color: #263240;
        padding: 0px;
    }

    .left {
        float: left;
    }

    .right {
        float: right;
    }

    .clear {
        clear: both;
    }


    a {
        color: #666;
    }

    a:hover {
        color: #333
    }

    div#credit-card {
        display: table;
        width: 540px;
        margin: 0 auto;

        border: 1px solid #c1c2c8;
        background-color: #eeeeee;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px 4px;
    }

    div#credit-card>header {
        padding: 10px;
        border-bottom: 1px solid #c1c2c8;

        background: #ffffff;
        /* Old browsers */
        background: -moz-linear-gradient(top, #ffffff 0%, #dde0e6 100%);
        /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ffffff), color-stop(100%, #dde0e6));
        /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #ffffff 0%, #dde0e6 100%);
        /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, #ffffff 0%, #dde0e6 100%);
        /* Opera 11.10+ */
        background: -ms-linear-gradient(top, #ffffff 0%, #dde0e6 100%);
        /* IE10+ */
        background: linear-gradient(to bottom, #ffffff 0%, #dde0e6 100%);
        /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#dde0e6', GradientType=0);
        /* IE6-9 */

        -webkit-border-top-left-radius: 3px;
        -webkit-border-top-right-radius: 3px;
        -moz-border-radius-topleft: 3px;
        -moz-border-radius-topright: 3px;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
    }

    div#credit-card>header .title {

        color: #666;
        font-size: 13px;
        padding: 15px 0;

        padding-left: 100px;
        background: no-repeat 20px;

        line-height: 32px;
    }

    div#credit-card>header .close {
        display: table;
        float: right;

    }

    div#credit-card>header .close:hover {
        display: table;
        float: right;
        opacity: 1;
    }

    div#credit-card>header .title strong {
        color: #333;
    }

    div#credit-card>section#content {
        padding: 30px;
    }

    div#credit-card>section#content .table {
        display: table;
        width: 100%;
    }

    div#credit-card>section#content .table>.row {
        display: table-row;
        width: 100%;
    }

    div#credit-card>section#content .table>.row>div {
        display: table-cell;
        padding-top: 15px;
    }

    div#credit-card>section#content .table>.row>div.label {
        min-width: 100px;
        width: 120px;
    }

    div#credit-card>section#content .form-fields .label {
        color: #333;
        font-weight: bold;
        font-size: 14px;
    }

    div#credit-card>section#content .form-fields .input {
        padding-left: 10px;
        width: 100%;
        color: #666;
        font-weight: bold;
        position: relative;
    }

    div#credit-card>section#content .form-fields .valid {
        width: 32px;
        text-align: left;
        padding-left: 10px;

        vertical-align: top;
    }

    div#credit-card>section#content .form-fields .valid img {
        display: block;
        margin-top: 2px;
    }

    div#credit-card>section#content .form-fields .full input,
    div#credit-card>section#content .form-fields .full select {
        width: 100%;
        padding: 10px;
    }

    div#credit-card>section#content .form-fields input,
    div#credit-card>section#content .form-fields select {
        background-color: #f7f7f7;
        border: 1px solid #d4d4d4;
        color: #717171;
        cursor: pointer;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px 5px;

        -moz-box-shadow: 0 0 4px -1px rgba(0, 0, 0, 0.2);
        -webkit-box-shadow: 0 0 4px -1px rgba(0, 0, 0, 0.2);
        box-shadow: 0 0 4px -1px rgba(0, 0, 0, 0.2);
    }

    div#credit-card>section#content .form-fields input:hover,
    div#credit-card>section#content .form-fields select:hover {
        -moz-box-shadow: 0 0 4px -1px rgba(0, 0, 0, 0.4);
        -webkit-box-shadow: 0 0 4px -1px rgba(0, 0, 0, 0.4);
        box-shadow: 0 0 4px -1px rgba(0, 0, 0, 0.4);
    }

    div#credit-card>section#content .form-fields .size50 input,
    div#credit-card>section#content .form-fields .size50 select {
        display: inline;
        padding-left: 10px;
        width: 47%;
        padding: 10px;
        cursor: pointer;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px 5px;
    }

    div#credit-card>section#content .form-fields .size50 input:not(:only-child) {
        margin-right: 19px;
    }

    div#credit-card>section#content .form-fields .size50 input:last-child {
        margin-right: 0;
    }

    div#credit-card>section#content .form-fields .size50 input:only-child {
        margin-right: 5px;
    }

    div#credit-card>section#content .form-fields .error {
        display: block;
        color: #f34755;
        font-size: 11px;
        margin-top: 5px;
        font-weight: normal;
    }

    /* Style Select Boxes */
    span.customStyleSelectBox {
        -moz-box-shadow: 0 0 4px -1px rgba(0, 0, 0, 0.2);
        -webkit-box-shadow: 0 0 4px -1px rgba(0, 0, 0, 0.2);
        box-shadow: 0 0 4px -1px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        padding: 8px;
        background-color: #949494;
        border: 1px solid #d4d4d4;
        color: #717171;
        -moz-border-radius: 5px;
        -webkit-border-radius:

            5px;
        border-radius: 5px 5px;
        line-height: 11px;
        width: 100% !important
    }

    .size50 span.customStyleSelectBox {
        width: 49% !important;
    }

    .customStyleSelectBoxInner {
        padding: 7px 0;
        background: url(../images/arrow.png) no-repeat center right;
        width: 100% !important;
        height: 24px;
    }

    input[type=submit] {

        cursor: pointer;
        padding: 15px;
        border: 1px solid #0945b9;
        color: #000000;
        font-weight: bold;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px 3px;
        -moz-box-shadow: inset 0 3px 0 -2px rgba(255, 255, 255, 0.6);
        -webkit-box-shadow: inset 0 3px 0 -2px rgba(255, 255, 255, 0.6);
        box-shadow: inset 0 3px 0 -2px rgba(255, 255, 255, 0.6);
        margin-bottom: 20px;


        background: #5e9af8;
        /* Old browsers */
        background: -moz-linear-gradient(top, #5e9af8 0%, #2f6af2 100%);
        /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #5e9af8), color-stop(100%, #2f6af2));
        /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #5e9af8 0%, #2f6af2 100%);
        /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, #5e9af8 0%, #2f6af2 100%);
        /* Opera 11.10+ */
        background: -ms-linear-gradient(top, #5e9af8 0%, #2f6af2 100%);
        /* IE10+ */
        background: linear-gradient(to bottom, #5e9af8 0%, #2f6af2 100%);
        /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#5e9af8', endColorstr='#2f6af2', GradientType=0);
        /* IE6-9 */
    }

    input[type=submit]:hover {
        background: #5e9af8;
        /* Old browsers */
        background: -moz-linear-gradient(top, #5e9af8 0%, #2867ef 100%);
        /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #5e9af8), color-stop(100%, #2867ef));
        /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #5e9af8 0%, #2867ef 100%);
        /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, #5e9af8 0%, #2867ef 100%);
        /* Opera 11.10+ */
        background: -ms-linear-gradient(top, #5e9af8 0%, #2867ef 100%);
        /* IE10+ */
        background: linear-gradient(to bottom, #5e9af8 0%, #2867ef 100%);
        /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#5e9af8', endColorstr='#2867ef', GradientType=0);
        /* IE6-9 */
    }

    input[type=submit]:active {
        background: #2867ef;
    }



    input[type=radio],
    input[type=checkbox] {
        display: none;
    }

    input[type=radio]+label,
    input[type=checkbox]+label {
        display: inline-block;
        margin: -2px;
        margin-top: 10px;
        padding: 4px 12px;
        margin-bottom: 0;
        font-size: 14px;
        line-height: 20px;
        color: #ACACAC;
        text-align: center;
        font-weight: bold;
        vertical-align: middle;
        cursor: pointer;
        background-color: #ACACAC;
        background-image: -moz-linear-gradient(top, #fff, #e6e6e6);
        background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fff), to(#e6e6e6));
        background-image: -webkit-linear-gradient(top, #fff, #e6e6e6);
        background-image: -o-linear-gradient(top, #fff, #e6e6e6);
        background-image: linear-gradient(to bottom, #fff, #e6e6e6);
        background-repeat: repeat-x;
        border-color: #e6e6e6 #e6e6e6 #bfbfbf;
        border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
        border-bottom-color: #b3b3b3;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffe6e6e6', GradientType=0);
        filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
        -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
        -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    input[type=radio]:checked+label,
    input[type=checkbox]:checked+label {

        margin-top: 10px;
        cursor: pointer;

        border: 1px solid #0945b9;
        color: white;
        font-weight: bold;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px 3px;
        -moz-box-shadow: inset 0 3px 0 -2px rgba(255, 255, 255, 0.6);
        -webkit-box-shadow: inset 0 3px 0 -2px rgba(255, 255, 255, 0.6);
        box-shadow: inset 0 3px 0 -2px rgba(255, 255, 255, 0.6);


        background: #5e9af8;
        /* Old browsers */
        background: -moz-linear-gradient(top, #5e9af8 0%, #2f6af2 100%);
        /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #5e9af8), color-stop(100%, #2f6af2));
        /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #5e9af8 0%, #2f6af2 100%);
        /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, #5e9af8 0%, #2f6af2 100%);
        /* Opera 11.10+ */
        background: -ms-linear-gradient(top, #5e9af8 0%, #2f6af2 100%);
        /* IE10+ */
        background: linear-gradient(to bottom, #5e9af8 0%, #2f6af2 100%);
        /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#5e9af8', endColorstr='#2f6af2', GradientType=0);
        /* IE6-9 */
    }

    .cards {
        overflow: hidden;
    }

    .cards li {
        -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        -ms-transition: all 0.2s;
        -o-transition: all 0.2s;
        transition: all 0.2s;
        background-image: url('https://www.fethr.com/webapp/images/card_logos.png');
        background-position: 0 0;
        float: left;
        height: 32px;
        margin-right: 8px;
        text-indent: -9999px;
        width: 51px;
    }

    .cards li:last-child {
        margin-right: 10px;
    }

    .cards .visa_electron {
        background-position: 204px 0;
    }

    .cards .mastercard {
        background-position: 153px 0;
    }

    .cards .maestro {
        background-position: 102px 0;
    }

    .cards .discover {
        background-position: 51px 0;
    }

    .cards .visa.off {
        background-position: 0 32px;
    }

    .cards .visa_electron.off {
        background-position: 204px 32px;
    }

    .cards .mastercard.off {
        background-position: 153px 32px;
    }

    .cards .maestro.off {
        background-position: 102px 32px;
    }

    .cards .discover.off {
        background-position: 51px 32px;
    }

    form input.valid {
        background: url('http://paweldecowski.github.com/jQuery-CreditCardValidator/tick.png') 300px no-repeat;
    }
</style>
@section('content')
@include('sweetalert::alert')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    PT. SURYA PANGAN SEMESTA
                </h3>
                <span class="btn-outline btn-sm btn-info mr-3">NGAWI</span>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        E-Procurement
                    </a>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        List Pengajuan PO
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-subheader   kt-grid__item">
            <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="flaticon2-delivery-package"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                DATA PENGAJUAN SUPPLIER
                            </h3>
                        </div>
                        <div class="kt-portlet__head-label ">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a data-toggle="tab" href="#kediri" role="tab" aria-controls="kediri" aria-selected="true" class="btn btn-success btn-outline-hover-success"><i class="flaticon2-list-1"></i> DISETUJUI</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#return" role="tab" aria-controls="return" aria-selected="false" class="btn btn-danger btn-outline-hover-danger"><i class="flaticon2-list-1"></i> DITOLAK</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#subang" role="tab" aria-controls="subang" aria-selected="false" class="btn btn-info btn-outline-hover-info"><i class="flaticon2-list-1"></i> DAFTAR&nbsp;PENGAJUAN</a>
                                    <div style="position:absolute;">
                                        <span class="badge" style="margin-left:170px; margin-top:-50px; float:left; background: #9f187c; color: white;">{{$data_count}}</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <div class="kt-portlet__body">
                        <div class="tab-content">

                            <span class="btn btn-label-info"><b><i class="flaticon2-pie-chart-4"></i>Sisa Kuota {{tonase($kuota_sisa)}}, setara {{$kuota_sisa/8000}} Truk</b> </span> <br>
                            <span class="btn btn-label-info"><b><i class="flaticon2-correct"></i>Data Disetujui : {{$data_approve}} Truk</b></span>
                            <div class="tab-pane fade show active" id="kediri" role="tabpanel" style="overflow-x:auto;">
                                <h3 class="text-center">DAFTAR SUPPLIER PENGAJUAN PO DISETUJUI</h3>
                                <table class="table table-bordered" id="data_approve">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">No</th>
                                            <th style="text-align: center;width:13%">Nama&nbsp;Supplier</th>
                                            <th style="text-align: center;width:12%">Waktu&nbsp;Pengajuan</th>
                                            <th style="text-align: center;width:15%">Keterangan&nbsp;PO</th>
                                            <th style="text-align: center;width:15%">Jumlah&nbsp;Pengajuan</th>
                                            <th style="text-align: center;width:12%">Disetujui</th>
                                            <th style="text-align: center;width:15%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center">
                                        <?php $no = 1; ?>
                                        @foreach ($data_approved as $item_response)
                                        <tr>
                                            <td width="2%">{{ $no++ }}</td>
                                            <td>{{ $item_response->nama_vendor }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item_response->date_biduser)->isoFormat('DD-MM-Y hh:mm:ss'); }}</td>
                                            <td>
                                                @if($item_response->permintaan_ditolak == 0)
                                                <a href="bid_response/list_bid_po/{{$item_response->id_biduser}}" style="margin:2px;" name="" title="Data Transaksi" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-money" style="color:#00c5dc;"></i> {{ $item_response->permintaan_kirim }} Data PO
                                                    @elseif($item_response->permintaan_kirim != 0)
                                                    <a href="bid_response/list_bid_po/{{$item_response->id_biduser}}" style="margin:2px;" name="" title="Data Transaksi" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                        <i class="fa fa-money" style="color:#00c5dc;"></i> {{ $item_response->permintaan_kirim }} Data PO
                                                        @else
                                                        <a href="#" onclick="return false;" style="margin:2px;" name="" title="Data Transaksi" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                            <i class="fa fa-money" style="color:#00c5dc;"></i> {{ $item_response->permintaan_kirim }} Tidak Ada PO
                                                            @endif
                                            </td>
                                            <td width="10%">{{ $item_response->jumlah_kirim }} /Truk</td>
                                            <td width="10%">{{ $item_response->permintaan_kirim }} /Truk</td>
                                            <td width="10%">
                                                @if ($item_response->status_biduser == 0)
                                                <a style="margin:2px;" name="{{ $item_response->id_biduser }}" title="Approve/Disapprove" class="toapprove btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-spinner" style="color:#00c5dc;"></i>E-Procurement
                                                    @elseif($item_response->status_biduser == 1)
                                                    <a style="margin:2px;" name="{{ $item_response->id_biduser }}" data-toggle="modal" data-target="#modal1" title="Approved" class="tofinish btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                        <i class="fa fa-check" style="color:#00c5dc;"> </i>Approved
                                                        @elseif($item_response->status_biduser == 2)
                                                        <a style="margin:2px;" data-toggle="modal" data-target="#" title="Approve/Disprove" class="toedit btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                            <i class="fa fa-close" style="color:red;"> </i>Disapproved
                                                            @elseif($item_response->status_biduser == 3)
                                                            <a style="margin:2px;" data-toggle="modal" data-target="#" title="Delivered" class="toedit btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                                <i class="fa fa-shipping-fast" style="color:#4D006E;"> </i>Delivered
                                                                @else
                                                                <a href="{{ route('sourching.transaction') }}" style="margin:2px;" name="" title="Data Transaksi" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                                    <i class="fa fa-money" style="color:#00c5dc;"></i> Finish
                                                                    @endif
                                                                </a>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('sourching.approve_bid') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Persetujuan Pengajuan Vendor</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="id_biduser" id="id_biduser1">
                                                            <input type="hidden" name="user_idbid" id="user_id1">
                                                            <input type="hidden" name="bid_id" id="bid_id1">
                                                            <input type="hidden" name="kode_transaksi" id="kode_transaksi">
                                                            <div class="form-group">
                                                                <h6 style="text-align: center">FORM PEMERIKSAAN KELENGKAPAN KENDARAAN BAHAN BAKU
                                                                </h6>
                                                            </div>
                                                            <div class="form-group">

                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="return" role="tabpanel" style="overflow-x:auto;">
                            <h3 class="text-center">DAFTAR SUPPLIER PENGAJUAN PO DITOLAK</h3>
                                <table class="table table-bordered datatable" id="data_disapproved">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;;width:3%">No.</th>
                                            <th style="text-align: center;width:13%">Nama&nbsp;Supplier</th>
                                            <th style="text-align: center;width:20%">Waktu&nbsp;Pengajuan</th>
                                            <th style="text-align: center;width:15%">Keterangan</th>
                                            <th style="text-align: center;width:15%">QTY</th>
                                            <th style="text-align: center;width:12%">Disetujui</th>
                                            <th style="text-align: center;;width:12%">Tidak&nbsp;Disetujui </th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center">
                                        <?php $no = 1; ?>
                                        @foreach ($data_return as $item_response)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item_response->nama_vendor }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item_response->date_biduser)->isoFormat('DD-MM-Y hh:mm:ss'); }}</td>
                                            <td>{{ $item_response->description_biduser }}</td>
                                            <td>{{ $item_response->jumlah_kirim }} /Truk</td>
                                            <td>{{ $item_response->permintaan_kirim }} /Truk</td>
                                            <td style="border-color: red">{{ $item_response->permintaan_ditolak}} /Truk</td>
                                        </tr>

                                        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('sourching.approve_bid') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Persetujuan Pengajuan Vendor</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="id_biduser" id="id_biduser1">
                                                            <input type="hidden" name="user_idbid" id="user_id1">
                                                            <input type="hidden" name="bid_id" id="bid_id1">
                                                            <input type="hidden" name="kode_transaksi" id="kode_transaksi">
                                                            <div class="form-group">
                                                                <h6 style="text-align: center">FORM PEMERIKSAAN KELENGKAPAN KENDARAAN BAHAN BAKU
                                                                </h6>
                                                            </div>
                                                            <div class="form-group">

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success m-btn pull-center">Approved</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="subang" role="tabpanel" style="overflow-x:auto;">
                            <h3 class="text-center">DAFTAR SUPPLIER PENGAJUAN PO </h3>
                                <table class="table table-bordered" id="data_eprocurement">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">No</th>
                                            <th style="text-align: center;width:15%">Nama&nbsp;Supplier</th>
                                            <th style="text-align: center;width:12%">Waktu&nbsp;Pengajuan</th>
                                            <th style="text-align: center;width:15%">Keterangan</th>
                                            <th style="text-align: center;width:12%">QTY</th>
                                            <th style="text-align: center">Gambar</th>
                                            @if(Auth::guard('sourching')->user()->level=='MANAGER')
                                            <th style="text-align: center;width:17%">Action</th>
                                            @else
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center">
                                        <?php $no = 1; ?>
                                        @foreach ($data_proses as $item_response)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item_response->nama_vendor }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item_response->date_biduser)->isoFormat('DD-MM-Y hh:mm:ss'); }}</td>
                                            <td>{{ $item_response->description_biduser }}</td>
                                            <td>{{ $item_response->jumlah_kirim }} Truk</td>
                                            <td>
                                                @if ($item_response->image_biduser != NULL)
                                                <img src="{{ asset('img/user/bid/' . $item_response->image_biduser) }}" style="width: 50%">
                                            </td>
                                            @else
                                            <span>No Image </span>
                                            @endif
                                            @if(Auth::guard('sourching')->user()->level=='MANAGER')
                                            <td>
                                                @if ($item_response->status_biduser == 0)
                                                <a style="margin:2px;" name="{{ $item_response->id_biduser }}" data-toggle="modal" data-target="#modal2" title="Approve/Disapprove" class="toapprove btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-spinner" style="color:#00c5dc;">
                                                    </i>E-Procurement
                                                    @elseif($item_response->status_biduser == 1)
                                                    <a style="margin:2px;" name="{{ $item_response->id_biduser }}" data-toggle="modal" data-target="#modal1" title="Approved" class="tofinish btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                        <i class="fa fa-check" style="color:#00c5dc;"> </i>
                                                        Approved
                                                        @elseif($item_response->status_biduser == 2)
                                                        <a style="margin:2px;" data-toggle="modal" data-target="#" title="Approve/Disprove" class="toedit btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                            <i class="fa fa-close" style="color:red;"> </i>
                                                            Disapproved
                                                            @else
                                                            <a href="{{ route('sourching.transaction') }}" style="margin:2px;" name="" title="Data Transaksi" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                                <i class="fa fa-money" style="color:#00c5dc;">
                                                                </i> Finish
                                                                @endif
                                                            </a>
                                            </td>
                                          @else
                                            @endif
                                        </tr>
                                        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('sourching.approve_bid') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Approve
                                                                Data
                                                                Bid</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="id_biduser" id="id_biduser1">
                                                            <input type="hidden" name="user_idbid" id="user_id1">
                                                            <input type="hidden" name="bid_id" id="bid_id1">
                                                            <input type="hidden" name="kode_transaksi" id="kode_transaksi">
                                                            <div class="form-group">
                                                                <h3 style="text-align: center">Proses Transaksi dan
                                                                    Pembayaran
                                                                </h3>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success m-btn pull-center">Approved</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Content -->
    </div>

    <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                {{-- <form class="m-form m-form--fit m-form--label-align-right" method="post"
                    action="{{ route('sourching.approve_bid') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('POST') }} --}}
                {{-- <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Approve Data Bid</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div> --}}
                {{-- <div class="modal-body"> --}}
                {{-- <div class="alert alert-success" role="alert">
                            <strong><i class="fa fa-exclamation-triangle"></i> Capacity Limit! </strong> &nbsp; {{$kuota_sisa}} Kg, balance {{$kuota_sisa/8000}} truck
            </div> --}}
            {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id_biduser" id="id_biduser">
            <input type="hidden" name="user_idbid" id="user_id">
            <input type="hidden" name="bid_id" id="bid_id">

            <div class="form-group">
                <div class="">
                    <label for="">Status</label><br>
                    <input type="radio" id="appoved" required name="status_biduser" value="1">
                    <label for="age2">Approve</label>
                    <input type="radio" id="appoved" required name="status_biduser" value="5">
                    <label for="age2">Disapprove</label>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <label for="">Expired Day</label>
                    <input type="text" id="expired_day" readonly class="form-control" required name="batas_penerimaan">
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <label>QTY</label>
                    <input type="number" maxlength="{{$kuota_sisa/8000}}" required name="permintaan_kirim" placeholder="" class="form-control" />
                    <span class="m-form__help" style="color:red"><i class="fa fa-exclamation-triangle"></i> Max {{$kuota_sisa}} Kg, balance {{$kuota_sisa/8000}} Truk </span>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <label>Message</label>
                    <textarea name="message_admin" required placeholder="" class="form-control"></textarea>
                </div>
            </div> --}}
            <div id="credit-card">
                <header>
                    <span class="title"><strong>E-Procurement: </strong>SURYA PANGAN SEMESTA</span><span class="btn-outline btn-sm btn-info">Site Ngawi</span>
                </header>
                <section id="content">
                    <div class="alert alert-success" role="alert">
                        <strong><i class="fa fa-exclamation-triangle"></i> Batas Kapasitas ! </strong> &nbsp; {{tonase($kuota_sisa)}}, Setara {{$kuota_sisa/8000}} truk
                    </div>
                    <br>
                    <input type="radio" id="radio1" name="radios" value="radio1" checked>
                    <label for="radio1">Disetujui Semua</label>

                    <input type="radio" id="radio2" name="radios" value="radio2">
                    <label for="radio2">Disetujui Sebagian</label>

                    <input type="radio" id="radio3" name="radios" value="radio3">
                    <label for="radio3">Ditolak</label>

                    <form method="post" id="setujuisemua" action="{{route('sourching.approve_bid') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="table form-fields">
                            <input type="hidden" required name="status_bid" value="1">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_biduser" id="id_biduser11">
                            <input type="hidden" name="user_idbid" id="user_id11">
                            <input type="hidden" name="bid_id" id="bid_id11">
                            <input type="hidden" name="tanggal_po" id="tanggal_po1">
                            <input type="hidden" name="tanggal_bongkar" id="tanggal_bongkar1">
                            <input type="hidden" name="kode_item" id="kode_item1">
                            <input type="hidden" name="vendorid" id="vendorid1">
                            <input type="hidden" name="termcode" id="termcode1">
                            <input type="hidden" name="name_supplier" id="name_supplier1">
                            <input type="hidden" name="date_biduser" id="date_biduser1">
                            <input type="hidden" name="kode_matauang_aol" id="kode_matauang_aol" value="Rp">
                            <input type="hidden" name="kurs_aol" id="kurs_aol" value="">
                            <input type="hidden" name="diskon_persen_aol" id="diskon_persen_aol" value="">
                            <input type="hidden" name="diskon_rp_aol" id="diskon_rp_aol" value="">
                            <input type="hidden" name="kuantitas_aol" id="kuantitas_aol" value="8000">
                            <input type="hidden" name="satuan_aol" id="satuan_aol" value="Kg">
                            <input type="hidden" name="harga_aol" id="harga_aol" value="o">
                            <input type="hidden" name="diskon1_persen_aol" id="diskon1_persen_aol" value="">
                            <input type="hidden" name="diskon1_rp_aol" id="diskon1_rp_aol" value="">
                            <input type="hidden" name="total_harga_aol" id="total_harga_aol" value="">
                            <input type="hidden" name="departemen_aol" id="departemen_aol" value="">
                            <input type="hidden" name="projek_aol" id="projek_aol" value="">
                            <input type="hidden" name="permintaan_barang_aol" id="permintaan_barang_aol" value="">
                            <input type="hidden" name="catatan_aol" id="catatan_aol" value="">
                            <input type="hidden" name="kena_pajak_aol" id="kena_pajak_aol" value="False">
                            <input type="hidden" name="total_termasuk_pajak_aol" id="total_termasuk_pajak_aol" value="False">
                            <input type="hidden" name="tgl_pengiriman_aol" id="tgl_pengiriman_aol" value="">
                            <input type="hidden" name="pengiriman_aol" id="pengiriman_aol" value="">
                            <input type="hidden" name="cabang_aol" id="cabang_aol" value="BAHAN BAKU PRODUKSI">
                            <div class="row">
                                <div class="label">Batas Hari:</div>
                                <div class="input full">
                                    <input type="text" id="expired_day11" readonly required name="batas_penerimaan">
                                </div>
                                <div class="valid"></div>
                            </div>
                            <div class="row">
                                <div class="label">Jumlah:</div>
                                <div class="input full">
                                    <input type="number" readonly id="jumlah_kirim11" required name="permintaan_kirim" />
                                    <span class="m-form__help" style="color:red"><i class="fa fa-exclamation-triangle"></i> Max {{tonase($kuota_sisa)}}, Setara {{$kuota_sisa/8000}} Truk </span>
                                </div>
                            </div>
                            {{-- edit label --}}
                            <div class="row">
                                <div class="label">Diterima:</div>
                                <div class="input full">
                                    <input type="number" readonly id="jumlah_diterima" required name="permintaan_diterima" />

                                </div>
                            </div>
                            <div class="row">
                                <div class="label">Ditolak:</div>
                                <div class="input full">
                                    <input type="number" readonly id="jumlah_ditolak" required name="permintaan_ditolak" />

                                </div>
                            </div>
                            <div class="row name">
                                <div class="label">Pesan:</div>
                                <div class="input full">
                                    <textarea name="message_admin" required placeholder="" class="form-control"></textarea>
                                </div>
                                <div class="valid"></div>
                            </div>
                        </div>
                        <button id="btn_save" type="submit" class="btn btn-success" style="float:right"> Save </button>
                    </form>

                    <form method="POST" id="disetujuisebagian" action="{{route('sourching.approve_bid') }}" enctype="multipart/form-data">
                        @csrf
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="table form-fields">
                            <input type="hidden" value="1" readonly required name="status_bid">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_biduser" id="id_biduser2">
                            <input type="hidden" name="user_idbid" id="user_id2">
                            <input type="hidden" name="bid_id" id="bid_id2">
                            <input type="hidden" name="tanggal_po" id="tanggal_po2">
                            <input type="hidden" name="tanggal_bongkar" id="tanggal_bongkar2">
                            <input type="hidden" name="kode_item" id="kode_item2">
                            <input type="hidden" name="vendorid" id="vendorid2">
                            <input type="hidden" name="termcode" id="termcode2">
                            <input type="hidden" name="name_supplier" id="name_supplier2">
                            <input type="hidden" name="date_biduser" id="date_biduser2">
                            <input type="hidden" name="kode_matauang_aol" id="kode_matauang_aol" value="Rp">
                            <input type="hidden" name="kurs_aol" id="kurs_aol" value="">
                            <input type="hidden" name="diskon_persen_aol" id="diskon_persen_aol" value="">
                            <input type="hidden" name="diskon_rp_aol" id="diskon_rp_aol" value="">
                            <input type="hidden" name="kuantitas_aol" id="kuantitas_aol" value="8000">
                            <input type="hidden" name="satuan_aol" id="satuan_aol" value="Kg">
                            <input type="hidden" name="harga_aol" id="harga_aol" value="o">
                            <input type="hidden" name="diskon1_persen_aol" id="diskon1_persen_aol" value="">
                            <input type="hidden" name="diskon1_rp_aol" id="diskon1_rp_aol" value="">
                            <input type="hidden" name="total_harga_aol" id="total_harga_aol" value="">
                            <input type="hidden" name="departemen_aol" id="departemen_aol" value="">
                            <input type="hidden" name="projek_aol" id="projek_aol" value="">
                            <input type="hidden" name="permintaan_barang_aol" id="permintaan_barang_aol" value="">
                            <input type="hidden" name="catatan_aol" id="catatan_aol" value="">
                            <input type="hidden" name="kena_pajak_aol" id="kena_pajak_aol" value="False">
                            <input type="hidden" name="total_termasuk_pajak_aol" id="total_termasuk_pajak_aol" value="False">
                            <input type="hidden" name="tgl_pengiriman_aol" id="tgl_pengiriman_aol" value="">
                            <input type="hidden" name="pengiriman_aol" id="pengiriman_aol" value="">
                            <input type="hidden" name="cabang_aol" id="cabang_aol" value="BAHAN BAKU PRODUKSI">
                            <div class="row">
                                <div class="label">Batas Hari:</div>
                                <div class="input full">
                                    <input type="text" id="expired_day2" readonly required name="batas_penerimaan">
                                </div>
                                <div class="valid"></div>
                            </div>
                            <div class="row">
                                <div class="label">Jumlah:</div>
                                <div class="input full">
                                    <input readonly type="number" required id="jumlah_kirim2" name="permintaan_kirim" />
                                    <span class="m-form__help" style="color:red"><i class="fa fa-exclamation-triangle"></i> Max {{tonase($kuota_sisa)}}, Setara {{$kuota_sisa/8000}} Truk </span>
                                </div>
                            </div>
                            {{-- edit label --}}
                            <div class="row">
                                <div class="label">Diterima:</div>
                                <div class="input full">
                                    <input onchange="maxditerima()" type="number" id="jumlah_diterima2" required name="permintaan_diterima" />
                                    <span id="span-diterima" class="m-form__help" style="color:red"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="label">Ditolak:</div>
                                <div class="input full">
                                    <input type="number" readonly id="jumlah_ditolak2" required name="permintaan_ditolak" />

                                </div>
                            </div>
                            <div class="row name">
                                <div class="label">Pesan:</div>
                                <div class="input full">
                                    <textarea name="message_admin" required placeholder="" class="form-control"></textarea>
                                </div>
                                <div class="valid"></div>
                            </div>
                        </div>
                        <button id="btn_save1" type="submit" class="btn btn-success" style="float:right"> Save </button>
                        <!-- {{-- <button type="submit" style="float:right" value="Save"/> --}} -->
                    </form>

                    <form method="post" id="tidakdisetujui" action="{{route('sourching.approve_bid') }}" enctype="multipart/form-data">
                        @csrf
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="table form-fields">
                            <div class="row name">
                                <input type="hidden" name="id_biduser" id="id_biduser3">
                                <input type="hidden" name="user_idbid" id="user_id3">
                                <input type="hidden" name="bid_id" id="bid_id3">
                                <input type="hidden" value="5" readonly required name="status_bid">
                                <input type="hidden" id="expired_day3" required name="batas_penerimaan">
                                <input type="hidden" value="0" name="permintaan_diterima" />
                                <input type="hidden" id="jumlah_kirim4" name="permintaan_ditolak" />
                                <input type="hidden" name="tanggal_po" id="tanggal_po3">
                                <input type="hidden" name="tanggal_bongkar" id="tanggal_bongkar3">
                                <input type="hidden" name="kode_item" id="kode_item3">
                                <input type="hidden" name="vendorid" id="vendorid3">
                                <input type="hidden" name="termcode" id="termcode3">
                                <input type="hidden" name="name_supplier" id="name_supplier3">
                                <input type="hidden" name="date_biduser" id="date_biduser3">
                                <input type="hidden" name="kode_matauang_aol" id="kode_matauang_aol" value="Rp">
                                <input type="hidden" name="kurs_aol" id="kurs_aol" value="">
                                <input type="hidden" name="diskon_persen_aol" id="diskon_persen_aol" value="">
                                <input type="hidden" name="diskon_rp_aol" id="diskon_rp_aol" value="">
                                <input type="hidden" name="kuantitas_aol" id="kuantitas_aol" value="8000">
                                <input type="hidden" name="satuan_aol" id="satuan_aol" value="Kg">
                                <input type="hidden" name="harga_aol" id="harga_aol" value="0">
                                <input type="hidden" name="diskon1_persen_aol" id="diskon1_persen_aol" value="">
                                <input type="hidden" name="diskon1_rp_aol" id="diskon1_rp_aol" value="">
                                <input type="hidden" name="total_harga_aol" id="total_harga_aol" value="">
                                <input type="hidden" name="departemen_aol" id="departemen_aol" value="">
                                <input type="hidden" name="projek_aol" id="projek_aol" value="">
                                <input type="hidden" name="permintaan_barang_aol" id="permintaan_barang_aol" value="">
                                <input type="hidden" name="catatan_aol" id="catatan_aol" value="">
                                <input type="hidden" name="kena_pajak_aol" id="kena_pajak_aol" value="False">
                                <input type="hidden" name="total_termasuk_pajak_aol" id="total_termasuk_pajak_aol" value="False">
                                <input type="hidden" name="tgl_pengiriman_aol" id="tgl_pengiriman_aol" value="">
                                <input type="hidden" name="pengiriman_aol" id="pengiriman_aol" value="">
                                <input type="hidden" name="cabang_aol" id="cabang_aol" value="BAHAN BAKU PRODUKSI">
                                <div class="row name">
                                    <div class="label">Pesan:</div>
                                    <div class="input full">
                                        <textarea name="message_admin" required placeholder="" class="form-control"></textarea>
                                    </div>
                                    <div class="valid"></div>
                                </div>
                            </div>
                        </div>
                        <button id="btn_save2" type="submit" class="btn btn-success" style="float:right"> Save </button>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    var value = window.location.href.split('/')[5].replace('#!', '');
    // console.log(value);
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    function maxditerima() {
        var qty = "{{ $kuota_sisa/8000 }}";
        var max = $('#jumlah_kirim11').val();
        var inputan = $('#jumlah_diterima2').val();
        var ditolak = 0;

        if (parseInt(max) >= parseInt(qty)) {
            max = qty;
        }

        if (parseInt(inputan) >= parseInt(max)) {
            $('#jumlah_diterima2').val(max);
            $('#jumlah_ditolak2').val(parseInt($('#jumlah_kirim11').val()) - parseInt(max));
        } else if (parseInt(inputan) <= 0) {
            $('#jumlah_diterima2').val(parseInt($('#jumlah_kirim11').val()) - parseInt(max));
            $('#jumlah_ditolak2').val(max);
        } else {
            $('#jumlah_ditolak2').val(parseInt($('#jumlah_kirim11').val()) - parseInt(inputan));

        }

    }
    $(function() {
        $(document).on('click', '#btn_save', function(e) {
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
                        title: 'Harap Tuggu Sebentar!',
                        html: 'Proses Input Data...', // add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });
                    $('#setujuisemua').submit();
                    // Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '#btn_save1', function(e) {
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
                    if ($('#jumlah_diterima2') == '' | $('#jumlah_ditolak2') == '') {
                        Swal.fire('Gagal!', 'Data Harus Terisi.', 'error')
                    } else {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Proses Input Data...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            },
                        });
                        $('#disetujuisebagian').submit();
                        // Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
                    }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '#btn_save2', function(e) {
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
                        title: 'Harap Tuggu Sebentar!',
                        html: 'Proses Input Data...', // add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });
                    $('#tidakdisetujui').submit();
                    // Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '.toapprove', function() {
            var id = $(this).attr("name");
            var url = "{{ route('sourching.bid_user') }}" + "/" + id;
            // console.log(url);

            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    // console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#span-diterima').html('<i class="fa fa-exclamation-triangle"></i> Max ' + parsed.jumlah_kirim + ' Truk dari Pengirim')
                    $('#id_biduser11').val(parsed.id_biduser);
                    $('#id_biduser2').val(parsed.id_biduser);
                    $('#id_biduser3').val(parsed.id_biduser);
                    $('#jumlah_kirim11').val(parsed.jumlah_kirim);
                    $('#jumlah_kirim2').val(parsed.jumlah_kirim);
                    $('#jumlah_kirim3').val(parsed.jumlah_kirim);
                    $('#jumlah_kirim4').val(parsed.jumlah_kirim);
                    $('#kode_item1').val(parsed.kode_item);
                    $('#kode_item2').val(parsed.kode_item);
                    $('#kode_item3').val(parsed.kode_item);
                    $('#vendorid1').val(parsed.vendorid);
                    $('#vendorid2').val(parsed.vendorid);
                    $('#vendorid3').val(parsed.vendorid);
                    $('#name_supplier1').val(parsed.name);
                    $('#name_supplier2').val(parsed.name);
                    $('#name_supplier3').val(parsed.name);
                    $('#date_biduser1').val(parsed.date_biduser);
                    $('#date_biduser2').val(parsed.date_biduser);
                    $('#date_biduser3').val(parsed.date_biduser);
                    $('#termcode1').val(parsed.termscode);
                    $('#termcode2').val(parsed.termscode);
                    $('#termcode3').val(parsed.termscode);
                    var qty = "{{ $kuota_sisa/8000 }}";
                    var qty1 = parseInt(qty);
                    // console.log(qty1);
                    var diterima = 0;
                    var ditolak = 0;

                    if (parsed.jumlah_kirim <= qty1) {
                        diterima = parsed.jumlah_kirim;
                        ditolak = 0;
                    } else {
                        diterima = qty1;
                        ditolak = parsed.jumlah_kirim - diterima;
                    }
                    $('#jumlah_diterima').val(diterima);
                    $('#jumlah_diterima2').val(diterima);
                    $('#jumlah_ditolak').val(ditolak);
                    $('#jumlah_ditolak2').val(ditolak);
                    $('#user_id11').val(parsed.user_id);
                    $('#user_id2').val(parsed.user_id);
                    $('#user_id3').val(parsed.user_id);
                    $('#bid_id11').val(parsed.bid_id);
                    $('#bid_id2').val(parsed.bid_id);
                    $('#bid_id3').val(parsed.bid_id);
                    $('#expired_day11').val(parsed.batas_bid);
                    $('#expired_day2').val(parsed.batas_bid);
                    $('#expired_day3').val(parsed.batas_bid);
                    $('#tanggal_po1').val(parsed.open_po);
                    $('#tanggal_po2').val(parsed.open_po);
                    $('#tanggal_po3').val(parsed.open_po);
                    $('#tanggal_bongkar1').val(parsed.unload_date);
                    $('#tanggal_bongkar2').val(parsed.unload_date);
                    $('#tanggal_bongkar3').val(parsed.unload_date);
                }
            });
        });
    });

    $(function() {
        $(document).on('click', '.tofinish', function() {
            var id = $(this).attr("name");
            var url = "{{ route('sourching.bid_user') }}" + "/" + id;
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    // console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_biduser1').val(parsed.id_biduser);
                    $('#user_id1').val(parsed.user_id);
                    $('#bid_id1').val(parsed.bid_id);
                    $('#kode_transaksi').val(parsed.id_kecamatannpwp);
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(function() {
        $(document).on('click', '.toedit', function() {
            var id = $(this).attr("name");
            var url = "{{ route('sourching.bid_show') }}" + "/" + id;

            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    var parsed = $.parseJSON(response);
                    var image = parsed.image_news;
                    $('#id_bid').val(parsed.id_bid);
                    $('#name_bid').val(parsed.name_bid);
                    $('#date_bid').val(parsed.date_bid);
                    if (image !== null) {
                        $('#image_bid').append(
                            '<div class="col-md-12 col-lg-4"><img src="/LELANG-PRODUK/public/img/news/' +
                            image + '" width="100%" /></div>');
                    }
                    $('#description_bid').val(parsed.description_bid);

                }
            });
        });
    });
</script>

<script type="text/javascript">
    var radios = document.getElementsByName("radios");
    var setujuisemua = document.getElementById("setujuisemua");
    var disetujuisebagian = document.getElementById("disetujuisebagian");
    var tidakdisetujui = document.getElementById("tidakdisetujui");
    setujuisemua.style.display = 'block'; // show
    disetujuisebagian.style.display = 'none'; // hide
    tidakdisetujui.style.display = 'none'; // hide
    for (var i = 0; i < radios.length; i++) {
        radios[i].onclick = function() {
            var val = this.value;
            if (val == 'radio1') {
                setujuisemua.style.display = 'block';
                disetujuisebagian.style.display = 'none';
                tidakdisetujui.style.display = 'none';
            } else if (val == 'radio2') {
                setujuisemua.style.display = 'none';
                disetujuisebagian.style.display = 'block';
                tidakdisetujui.style.display = 'none';
            } else {
                setujuisemua.style.display = 'none';
                disetujuisebagian.style.display = 'none';
                tidakdisetujui.style.display = 'block';
            }

        }
    }
</script>

<script>
    $(document).ready(function() {
        $('#data_approve').DataTable();
    });
</script>

<script>
    $(document).ready(function() {
        $('#data_disapproved').DataTable();
    });
</script>

<script>
    $(document).ready(function() {
        $('#data_eprocurement').DataTable();
    });
</script>
@endsection