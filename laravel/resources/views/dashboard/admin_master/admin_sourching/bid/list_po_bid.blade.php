@extends('dashboard.admin_master.layout.main')
@section('title')
SURYA PANGAN SEMESTA
@endsection
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
                        SURYA PANGAN SEMESTA
                    </a>
                    <span class="btn-outline btn-sm btn-info">Site Ngawi</span>
                </div>
            </div>
        </div>
    </div>

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">



        <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">

            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="kt-widget kt-widget--user-profile-3">
                        <div class="kt-widget__top">
                            <div class="kt-widget__media kt-hidden-">
                                <img src="{{asset('user-supplier1.png')}}" alt="image">
                            </div>
                            <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light kt-hidden">
                                JM
                            </div>
                            <div class="kt-widget__content">
                                <div class="kt-widget__head">
                                    <a href="#" class="kt-widget__username">
                                        {{$waktu_pengajuan->nama_vendor}}
                                        <i class="flaticon2-correct kt-font-success"></i>
                                    </a>
                                    <div class="kt-widget__action">
                                        <button type="button" class="btn btn-label-success btn-sm btn-upper">ask</button>&nbsp;
                                        <button type="button" class="btn btn-brand btn-sm btn-upper">hire</button>
                                    </div>
                                </div>
                                <div class="kt-widget__subhead">
                                    <a href="#"><i class="flaticon2-new-email"></i>{{$waktu_pengajuan->email}}</a>
                                    <a href="#"><i class="flaticon2-calendar-3"></i>{{$waktu_pengajuan->nomer_hp}} </a>
                                    <a href="#"><i class="flaticon2-placeholder"></i>{{$waktu_pengajuan->cabang_bank}}</a>
                                </div>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__desc">
                                        Keep the best do the best we will be success <br>
                                        PT. SURYA PANGAN SEMESTA
                                        <span class="btn-outline btn-sm btn-secondary">Site Ngawi</span>
                                    </div>
                                    <div class="kt-widget__progress">
                                        <div class="kt-widget__text">
                                            Progress
                                        </div>
                                        <div class="progress" style="height: 5px;width: 100%;">
                                            <div class="progress-bar kt-bg-success" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="kt-widget__stats">
                                            78%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-widget__bottom">
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-price-tag"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Partisipasi</span>
                                    <span class="kt-widget__value"><span>#</span>{{$partisipasi}} Pesanan Partisipasi</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-confetti"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Ditolak</span>
                                    <span class="kt-widget__value"><span>#</span>{{$ditolak}} Pesanan Ditolak</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-pie-chart"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Diterima</span>
                                    <span class="kt-widget__value"><span>#</span>{{$diterima}} Pesanan Diterima</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-file-2"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Diproses</span>
                                    <span class="kt-widget__value"><span>#</span>{{$diproses}} Pesanan Diproses</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="flaticon-user"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            &nbsp;
                            <span class="btn-outline btn-sm btn-info">Site Ngawi</span>

                            Pengajuan PO ( {{$waktu_pengajuan->date_biduser}} )
                        </h3>
                    </div>
                    <div class="">
                        <a style="float: right; margin-top:1%" href="#" onClick="return false;" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-file-excel"> Excel</i></a>
                        <a style="float: right; margin-top:1%" href="#" onClick="return false;" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-file-pdf"> PDF</i></a>
                        <a style="float: right; margin-top:1%" href="#" onClick="return false;" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-file-csv"> CSV</i></a>
                        <a style="float: right; margin-top:1%" href="#" onClick="return false;" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-print"> PRINT</i></a>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-bordered" id="data_pengajuan">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:2%">No</th>
                                <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                <th style="text-align: center;width:auto">Supplier</th>
                                <th style="text-align: center;width:auto">No&nbsp;Hp</th>
                                <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                <th style="text-align: center;width:auto">Pengajuan</th>
                                <th style="text-align: center;width:auto">Status</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                            <?php $no = 1; ?>
                            @foreach($data_diproses as $po)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$po->kode_po}}</td>
                                <td>{{$po->nama_vendor}}</td>
                                <td>{{$po->nomer_hp}}</td>
                                <td>{{$po->tanggal_po}}</td>
                                <td>{{$po->date_biduser}}</td>
                                <td>
                                    @if($po->status_bid == 1)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Proses Pengiriman
                                    </a>
                                    @elseif($po->status_bid == 2)
                                    b
                                    @elseif($po->status_bid == 3)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Diterima Satpam
                                    </a>
                                    @elseif($po->status_bid == 5)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Ditolak / Telat
                                    </a>
                                    @elseif($po->status_bid == 6)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Proses Lab 1
                                    </a>
                                    @elseif($po->status_bid == 7)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Antrian Bongkar
                                    </a>
                                    @elseif($po->status_bid == 8)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        On Call
                                    </a>
                                    @elseif($po->status_bid == 9)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Timbangan 1
                                    </a>
                                    @elseif($po->status_bid == 10)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Proses Bongkar
                                    </a>
                                    @elseif($po->status_bid == 10)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Proses Lab 1
                                    </a>
                                    @elseif($po->status_bid == 11)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Proses Lab 1
                                    </a>
                                    @elseif($po->status_bid == 12)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Proses Lab 1
                                    </a>
                                    @elseif($po->status_bid == 13)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Proses Transaksi
                                    </a>
                                    @elseif($po->status_bid == 16)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Proses Lab 1
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                            &nbsp;
                            <span class="btn-outline btn-sm btn-info">Site Ngawi</span>
                            Riwayat Data PO
                        </h3>
                    </div>
                    <div class="">
                        <a style="float: right; margin-top:1%" href="#" onClick="return false;" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-file-excel"> Excel</i></a>
                        <a style="float: right; margin-top:1%" href="#" onClick="return false;" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-file-pdf"> PDF</i></a>
                        <a style="float: right; margin-top:1%" href="#" onClick="return false;" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-file-csv"> CSV</i></a>
                        <a style="float: right; margin-top:1%" href="#" onClick="return false;" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-print"> PRINT</i></a>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-bordered" id="riwayat_po">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:2%">No</th>
                                <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                <th style="text-align: center;width:auto">Supplier</th>
                                <th style="text-align: center;width:auto">No&nbsp;Hp</th>
                                <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                <th style="text-align: center;width:auto">Pengajuan</th>
                                <th style="text-align: center;width:auto">Status</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                            <?php $no = 1; ?>
                            @foreach($riwayat_po as $po)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$po->kode_po}}</td>
                                <td>{{$po->nama_vendor}}</td>
                                <td>{{$po->nomer_hp}}</td>
                                <td>{{$po->tanggal_po}}</td>
                                <td>{{$po->date_biduser}}</td>
                                <td>
                                    @if($po->status_bid == 1)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Proses Pengiriman
                                    </a>
                                    @elseif($po->status_bid == 2)
                                    b
                                    @elseif($po->status_bid == 3)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Diterima Satpam
                                    </a>
                                    @elseif($po->status_bid == 5)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Ditolak / Telat
                                    </a>
                                    @elseif($po->status_bid == 6)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Proses Lab 1
                                    </a>
                                    @elseif($po->status_bid == 7)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Proses Lab 1
                                    </a>
                                    @elseif($po->status_bid == 8)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Proses Lab 1
                                    </a>
                                    @elseif($po->status_bid == 9)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Proses Lab 1
                                    </a>
                                    @elseif($po->status_bid == 10)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Proses Lab 1
                                    </a>
                                    @elseif($po->status_bid == 10)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Proses Lab 1
                                    </a>
                                    @elseif($po->status_bid == 11)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Proses Lab 1
                                    </a>
                                    @elseif($po->status_bid == 12)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Proses Lab 1
                                    </a>
                                    @elseif($po->status_bid == 13)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Proses Transaksi
                                    </a>
                                    @elseif($po->status_bid == 16)
                                    <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal3" title="Information" class="lokasi_bongkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        Pending
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- end:: Content -->
</div>
@endsection
@section('js')

<script>
    $(document).ready(function() {
        $('#data_pengajuan').DataTable();
    });
</script>

<script>
    $(document).ready(function() {
        $('#riwayat_po').DataTable();
    });
</script>

@endsection