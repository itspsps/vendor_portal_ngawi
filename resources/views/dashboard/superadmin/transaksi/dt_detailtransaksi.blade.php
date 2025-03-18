@extends('dashboard.superadmin.layout.main')
@section('title')
SURYA PANGAN SEMESTA
@endsection
<style>
    .text-danger strong {
        color: #9f181c;
    }

    .receipt-main {
        background: #ffffff none repeat scroll 0 0;
        border-bottom: 12px solid #333333;
        border-top: 12px solid #9f181c;
        margin-top: 50px;
        margin-bottom: 50px;
        padding: 40px 30px !important;
        position: relative;
        box-shadow: 0 1px 21px #acacac;
        color: #333333;
        font-family: open sans;
    }

    .receipt-main p {
        color: #333333;
        font-family: open sans;
        line-height: 1.42857;
    }

    .receipt-footer h1 {
        font-size: 15px;
        font-weight: 400 !important;
        margin: 0 !important;
    }

    .receipt-main::after {
        background: #414143 none repeat scroll 0 0;
        content: "";
        height: 5px;
        left: 0;
        position: absolute;
        right: 0;
        top: -13px;
    }

    .receipt-main thead {
        background: #414143 none repeat scroll 0 0;
    }

    .receipt-main thead th {
        color: #fff;
    }

    .receipt-right h5 {
        font-size: 16px;
        font-weight: bold;
        margin: 0 0 7px 0;
    }

    .receipt-right p {
        font-size: 12px;
        margin: 0px;
    }

    .receipt-right p i {
        text-align: center;
        width: 18px;
    }

    .receipt-main td {
        padding: 9px 20px !important;
    }

    .receipt-main th {
        padding: 13px 20px !important;
    }

    .receipt-main td {
        font-size: 13px;
        font-weight: initial !important;
    }

    .receipt-main td p:last-child {
        margin: 0;
        padding: 0;
    }

    .receipt-main td h2 {
        font-size: 20px;
        font-weight: 900;
        margin: 0;
        text-transform: uppercase;
    }

    .receipt-header-mid .receipt-left h1 {
        font-weight: 100;
        margin: 34px 0 0;
        text-align: right;
        text-transform: uppercase;
    }

    .receipt-header-mid {
        margin: 24px 0;
        overflow: hidden;
    }

    #container {
        background-color: #dcdcdc;
    }
</style>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">
                        E-PROCUREMENT
                    </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="" class="kt-subheader__breadcrumbs-link">
                             SUMBER PANGAN
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="flaticon-user"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                Data Transaksi
                            </h3>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="container mb-5 mt-3">
                                <div class="row d-flex align-items-baseline">
                                    <div class="col-xl-9">
                                        <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID:{{$data->kode_transaksi}}</strong></p>
                                    </div>
                                    <div class="col-xl-3 float-end">
                                        <a href="{{url('superadmin/print_struk/'.$data->id_transaksi)}}" target="_blank" class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                                                class="fas fa-print text-primary"></i> Print</a>
                                        <a href="{{url('superadmin/print_pdf_struk/'.$data->id_transaksi)}}" class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
                                                class="far fa-file-pdf text-danger"></i> Export</a>
                                    </div>
                                    <hr>
                                </div>

                                <div class="container">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-xl-8">
                                            <ul class="list-unstyled">
                                                <li class="text-muted">Vendor: <span
                                                        style="color:#5d9fc5 ;">{{ $data->nama_vendor }}</span></li>
                                                <?php
                                                $prov = \App\Models\Province::where('id', $data->id_provinsinpwp)->first();
                                                ?>
                                                <?php
                                                $kab = \App\Models\Regency::where('id', $data->id_kabupatennpwp)->first();
                                                ?>
                                                <?php
                                                $kec = \App\Models\District::where('id', $data->id_kecamatannpwp)->first();
                                                ?>
                                                <?php
                                                $des = \App\Models\Village::where('id', $data->id_desanpwp)->first();
                                                ?>
                                                <li class="text-muted">{{ $prov->name }}, {{ $kab->name }}</li>
                                                <li class="text-muted">{{ $kec->name }}, {{ $des->name }}</li>
                                                <li class="text-muted"><i class="fas fa-phone"></i> {{ $data->nomer_hp }}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-xl-4">
                                            <p class="text-muted">Invoice</p>
                                            <ul class="list-unstyled">
                                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i>
                                                    <span class="fw-bold">ID:</span>{{$data->kode_transaksi}}</li>
                                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i>
                                                    <span class="fw-bold">Creation Date: </span>{{ $data->date_biduser }}
                                                </li>
                                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i>
                                                    <span class="me-1 fw-bold">Status:</span>
                                                    @if ($data->status_transaksi == 1)
                                                        <span class="badge bg-success text-black fw-bold">Sudah Terbayar</span>
                                                    @else
                                                        <span class="badge bg-danger text-black fw-bold">Belum Terbayar</span>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="row my-2 mx-1 justify-content-center">
                                        <table class="table table-striped table-borderless">
                                            <thead style="background-color:#84B0CA ;" class="text-white">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Netto</th>
                                                    <th scope="col">Unit Price</th>
                                                    <th scope="col">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>{{ $data->name_bid }}</td>
                                                    <td>{{ $data->jumlah_kirim }} /Kg</td>
                                                    <td>{{ $data->final_jumlahgabah }} /Kg</td>
                                                    <td><?php echo 'Rp ' . number_format($data->final_hargagabah, 2, ',', '.'); ?> /Kg</td>
                                                    <td><?php echo 'Rp ' . number_format($data->final_hargagabah * $data->final_jumlahgabah, 2, ',', '.'); ?></td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-9">
                                            <p class="ms-3">

                                            </p>
                                        </div>
                                        <div class="col-xl-3">
                                            <ul class="list-unstyled">
                                                <li class="text-muted ms-3"><span class="text-black me-4"
                                                        style="font-weight: bold">Potongan Bongkar</span>
                                                    <?php echo 'Rp ' . number_format($data->final_jumlahgabah * 13, 2, ',', '.'); ?></li>
                                                <li class="text-muted ms-3 mt-2"><span class="text-black me-4"
                                                        style="font-weight: bold">PPH(0,25%)</span> <?php echo 'Rp ' . number_format(($data->final_hargagabah * $data->final_jumlahgabah - $data->final_jumlahgabah * 13) * (0.25 / 100), 2, ',', '.'); ?></li>
                                                <li class="text-muted ms-3 mt-2"><span class="text-black me-4"
                                                        style="font-weight: bold">Total Pembayaran</span>
                                                    <?php echo 'Rp ' . number_format($data->final_hargagabah * $data->final_jumlahgabah - $data->final_jumlahgabah * 13 - ($data->final_hargagabah * $data->final_jumlahgabah - $data->final_jumlahgabah * 13) * (0.25 / 100), 2, ',', '.'); ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-xl-10">
                                            <p>Thank you for your purchase</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
