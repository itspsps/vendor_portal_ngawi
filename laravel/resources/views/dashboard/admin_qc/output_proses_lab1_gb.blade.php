@extends('dashboard.admin_qc.layout.main')
@section('title')
SURYA PANGAN SEMESTA
@endsection
@section('content')
@include('sweetalert::alert')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <!-- begin:: Subheader -->
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
                        Hasil Lab(Incoming)
                    </a>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        Hasil Lab
                    </a>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        Gabah Basah
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
                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            HasiL Lab 1 Gabah Basah
                        </h3>
                    </div>
                </div>
                <form class="kt-form" action="javascript:void(0)" method="POST" enctype="multipart/form-data">
                    <div style="margin-left: 10px; margin-top:10px;" class="row input-daterange">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="col-md-4">
                            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                        </div>
                        <div class="col-md-4">
                            <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                            <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                            @if(Auth::guard('lab')->user()->level=='QC')
                            @elseif(Auth::guard('lab')->user()->level=='MANAGER')
                            <button type="button" name="btn_export" id="btn_export" class="btn btn-success"><i class="fa fa-file-excel"></i>Excel</button>
                            @endif
                        </div>
                    </div>
                </form>
                <div class="m-portlet__body">
                    <div class="kt-portlet__body">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item mt-3">
                                <a class="nav-link active" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-database"></i>GB LONG GRAIN</a>
                            </li>
                            <li class="nav-item mt-3">
                                <a class="nav-link" data-toggle="tab" href="#m_tabs_3_2"><i class="la la-database"></i>GB PANDAN WANGI</a>
                            </li>
                            <li class="nav-item mt-3">
                                <a class="nav-link" data-toggle="tab" href="#m_tabs_3_3"><i class="la la-database"></i>GB KETAN PUTIH</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
                                @if(Auth::guard('lab')->user()->level=='QC')
                                <table class="table table-bordered" id="data_longgrain">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;width:2%">No</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;Antrian&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Sampai&nbsp;Disatpam</th>
                                            <th style="text-align: center;width:auto">Tanggal&nbsp;PO </th>
                                            <th style="text-align: center;width:auto">Tanggal&nbsp;Bongkaran </th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Asal</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:20px">KA&nbsp;KS</th>
                                            <th style="text-align: center;width:20px">KA&nbsp;KG</th>
                                            <th style="text-align: center;width:20px">Berat&nbsp;Sample&nbsp;Awal&nbsp;KS</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Awal&nbsp;KG</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Akhir&nbsp;KG </th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;PK </th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Beras </th>
                                            <th style="text-align: center;width:auto">WH </th>
                                            <th style="text-align: center;width:auto">TP </th>
                                            <th style="text-align: center;width:auto">MD </th>
                                            <th style="text-align: center;width:auto">BROKEN </th>

                                            <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Gabah</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center">

                                    </tbody>
                                </table>
                                @elseif(Auth::guard('lab')->user()->level=='MANAGER')
                                <table class="table table-bordered" id="data_longgrain1">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;width:2%">No</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;Antrian&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Sampai&nbsp;Disatpam</th>
                                            <th style="text-align: center;width:auto">Tanggal&nbsp;PO </th>
                                            <th style="text-align: center;width:auto">Tanggal&nbsp;Bongkaran </th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Asal</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:20px">KA&nbsp;KS</th>
                                            <th style="text-align: center;width:20px">KA&nbsp;KG</th>
                                            <th style="text-align: center;width:20px">Berat&nbsp;Sample&nbsp;Awal&nbsp;KS</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Awal&nbsp;KG</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Akhir&nbsp;KG </th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;PK </th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Beras </th>
                                            <th style="text-align: center;width:auto">WH </th>
                                            <th style="text-align: center;width:auto">TP </th>
                                            <th style="text-align: center;width:auto">MD </th>
                                            <th style="text-align: center;width:auto">BROKEN </th>

                                            <th style="text-align: center;width:auto">Hampa&nbsp;(%) </th>
                                            <th style="text-align: center;width:auto">KG&nbsp;After&nbsp;Adjust&nbsp;Hampa</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;KG</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;Susut</th>
                                            <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;Susut&nbsp;1,2</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;KS&nbsp;-&nbsp;KG&nbsp;After&nbsp;Adjust&nbsp;Susut</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;KG&nbsp;-&nbsp;PK</th>
                                            <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;KG&nbsp;-&nbsp;PK&nbsp;0,9952</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;KS&nbsp;-&nbsp;PK</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;Putih</th>
                                            <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;KG&nbsp;-&nbsp;Putih&nbsp;0,952</th>
                                            <th style="text-align: center;width:auto">Plan&nbsp;Rend&nbsp;KS&nbsp;-&nbsp;Beras</th>
                                            <th style="text-align: center;width:auto">Katul</th>
                                            <th style="text-align: center;width:auto">Refraksi&nbsp;Broken&nbsp;(Rp)</th>
                                            <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Gabah&nbsp;(Rp/Kg)</th>
                                            <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Gabah</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center">

                                    </tbody>
                                </table>
                                @endif
                            </div>
                            <div class="tab-pane" id="m_tabs_3_2" role="tabpanel">
                                @if(Auth::guard('lab')->user()->level=='QC')
                                <table class="table table-bordered" id="data_pw">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;width:2%">No</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;Antrian&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Sampai&nbsp;Disatpam</th>
                                            <th style="text-align: center;width:auto">Tanggal&nbsp;PO </th>
                                            <th style="text-align: center;width:auto">Tanggal&nbsp;Bongkaran </th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Asal</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:20px">KA&nbsp;KS</th>
                                            <th style="text-align: center;width:20px">KA&nbsp;KG</th>
                                            <th style="text-align: center;width:20px">Berat&nbsp;Sample&nbsp;Awal&nbsp;KS</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Awal&nbsp;KG</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Akhir&nbsp;KG </th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;PK </th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Beras </th>
                                            <th style="text-align: center;width:auto">WH </th>
                                            <th style="text-align: center;width:auto">TP </th>
                                            <th style="text-align: center;width:auto">MD </th>
                                            <th style="text-align: center;width:auto">BROKEN </th>

                                            <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Gabah</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center">

                                    </tbody>
                                </table>
                                @elseif(Auth::guard('lab')->user()->level=='MANAGER')
                                <table class="table table-bordered" id="data_pw1">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;width:2%">No</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;Antrian&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Sampai&nbsp;Disatpam</th>
                                            <th style="text-align: center;width:auto">Tanggal&nbsp;PO </th>
                                            <th style="text-align: center;width:auto">Tanggal&nbsp;Bongkaran </th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Asal</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:20px">KA&nbsp;KS</th>
                                            <th style="text-align: center;width:20px">KA&nbsp;KG</th>
                                            <th style="text-align: center;width:20px">Berat&nbsp;Sample&nbsp;Awal&nbsp;KS</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Awal&nbsp;KG</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Akhir&nbsp;KG </th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;PK </th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Beras </th>
                                            <th style="text-align: center;width:auto">WH </th>
                                            <th style="text-align: center;width:auto">TP </th>
                                            <th style="text-align: center;width:auto">MD </th>
                                            <th style="text-align: center;width:auto">BROKEN </th>

                                            <th style="text-align: center;width:auto">Hampa&nbsp;(%) </th>
                                            <th style="text-align: center;width:auto">KG&nbsp;After&nbsp;Adjust&nbsp;Hampa</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;KG</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;Susut</th>
                                            <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;Susut&nbsp;1,2</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;KS&nbsp;-&nbsp;KG&nbsp;After&nbsp;Adjust&nbsp;Susut</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;KG&nbsp;-&nbsp;PK</th>
                                            <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;KG&nbsp;-&nbsp;PK&nbsp;0,9952</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;KS&nbsp;-&nbsp;PK</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;Putih</th>
                                            <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;KG&nbsp;-&nbsp;Putih&nbsp;0,952</th>
                                            <th style="text-align: center;width:auto">Plan&nbsp;Rend&nbsp;KS&nbsp;-&nbsp;Beras</th>
                                            <th style="text-align: center;width:auto">Katul</th>
                                            <th style="text-align: center;width:auto">Refraksi&nbsp;Broken&nbsp;(Rp)</th>
                                            <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Gabah&nbsp;(Rp/Kg)</th>
                                            <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Gabah</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center">

                                    </tbody>
                                </table>
                                @endif
                            </div>
                            <div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
                                @if(Auth::guard('lab')->user()->level=='QC')
                                <table class="table table-bordered" id="data_kp">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;width:2%">No</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;Antrian&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Sampai&nbsp;Disatpam</th>
                                            <th style="text-align: center;width:auto">Tanggal&nbsp;PO </th>
                                            <th style="text-align: center;width:auto">Tanggal&nbsp;Bongkaran </th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Asal</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:20px">KA&nbsp;KS</th>
                                            <th style="text-align: center;width:20px">KA&nbsp;KG</th>
                                            <th style="text-align: center;width:20px">Berat&nbsp;Sample&nbsp;Awal&nbsp;KS</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Awal&nbsp;KG</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Akhir&nbsp;KG </th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;PK </th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Beras </th>
                                            <th style="text-align: center;width:auto">WH </th>
                                            <th style="text-align: center;width:auto">TP </th>
                                            <th style="text-align: center;width:auto">MD </th>
                                            <th style="text-align: center;width:auto">BROKEN </th>

                                            <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Gabah</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center">

                                    </tbody>
                                </table>
                                @elseif(Auth::guard('lab')->user()->level=='MANAGER')
                                <table class="table table-bordered" id="data_kp1">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;width:2%">No</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.&nbsp;Antrian&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Sampai&nbsp;Disatpam</th>
                                            <th style="text-align: center;width:auto">Tanggal&nbsp;PO </th>
                                            <th style="text-align: center;width:auto">Tanggal&nbsp;Bongkaran </th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Asal</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:20px">KA&nbsp;KS</th>
                                            <th style="text-align: center;width:20px">KA&nbsp;KG</th>
                                            <th style="text-align: center;width:20px">Berat&nbsp;Sample&nbsp;Awal&nbsp;KS</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Awal&nbsp;KG</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Akhir&nbsp;KG </th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;PK </th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Beras </th>
                                            <th style="text-align: center;width:auto">WH </th>
                                            <th style="text-align: center;width:auto">TP </th>
                                            <th style="text-align: center;width:auto">MD </th>
                                            <th style="text-align: center;width:auto">BROKEN </th>

                                            <th style="text-align: center;width:auto">Hampa&nbsp;(%) </th>
                                            <th style="text-align: center;width:auto">KG&nbsp;After&nbsp;Adjust&nbsp;Hampa</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;KG</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;Susut</th>
                                            <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;Susut&nbsp;1,2</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;KS&nbsp;-&nbsp;KG&nbsp;After&nbsp;Adjust&nbsp;Susut</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;KG&nbsp;-&nbsp;PK</th>
                                            <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;KG&nbsp;-&nbsp;PK&nbsp;0,9952</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;KS&nbsp;-&nbsp;PK</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;Putih</th>
                                            <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;KG&nbsp;-&nbsp;Putih&nbsp;0,952</th>
                                            <th style="text-align: center;width:auto">Plan&nbsp;Rend&nbsp;KS&nbsp;-&nbsp;Beras</th>
                                            <th style="text-align: center;width:auto">Katul</th>
                                            <th style="text-align: center;width:auto">Refraksi&nbsp;Broken&nbsp;(Rp)</th>
                                            <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Gabah&nbsp;(Rp/Kg)</th>
                                            <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Gabah</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center">

                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_outputlab1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="form_updateproseslab1" class="m-form m-form--fit m-form--label-align-right" method="post" action="javascript:void(0)" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Lab 1</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="gabahincoming_id_data_po" id="gabahincoming_id_data_po" value="">
                        <input type="hidden" name="gabahincoming_id_penerimaan_po" id="gabahincoming_id_penerimaan_po">
                        <input type="hidden" id="id_gabahincoming_qc" name="id_gabahincoming_qc">
                        <input type="hidden" id="nama_supplier" name="nama_supplier">
                        <input type="hidden" id="no_supplier" name="no_supplier">
                        {{-- tambahan input --}}
                        <input type="hidden" id="hampa" name="hampa">
                        <input type="hidden" id="kg_after_adjust_hampa" name="kg_after_adjust_hampa">
                        <input type="hidden" id="prosentasi_kg" name="prosentasi_kg">
                        <input type="hidden" id="susut" name="susut">
                        <input type="hidden" id="item" name="item">
                        <input type="hidden" id="adjust_susut" name="adjust_susut">
                        <input type="hidden" id="prsentase_ks_kg_after_adjust_susut" name="prsentase_ks_kg_after_adjust_susut">
                        <input type="hidden" id="prsentase_kg_pk" name="prsentase_kg_pk">
                        <input type="hidden" id="adjust_prosentase_kg_pk" name="adjust_prosentase_kg_pk">
                        <input type="hidden" id="presentase_ks_pk" name="presentase_ks_pk">
                        <input type="hidden" id="presentase_putih" name="presentase_putih">
                        <input type="hidden" id="adjust_prosentase_kg_ke_putih" name="adjust_prosentase_kg_ke_putih">
                        <input type="hidden" id="plan_rend_dari_ks_beras" name="plan_rend_dari_ks_beras">
                        <input type="hidden" id="katul" name="katul">
                        <input type="hidden" id="refraksi_broken" name="refraksi_broken">
                        <input type="hidden" id="plan_harga_gabah" name="plan_harga_gabah">
                        <input type="hidden" id="lokasibongkar" name="lokasibongkar">
                        <input type="hidden" id="keteranganlab1" name="keteranganlab1">
                        <input type="hidden" id="tanggal_po" name="tanggal_po">
                        <input type="hidden" id="date_bid" name="date_bid">
                        <input type="hidden" id="PONum" name="PONum">
                        <input type="hidden" id="no_hp" name="no_hp">
                        <input type="hidden" id="status_plan_hpp" name="status_plan_hpp">
                        <input type="hidden" id="status_harga_atas" name="status_harga_atas">
                        <input type="hidden" id="status_harga_bawah" name="status_harga_bawah">
                        <input type="hidden" id="status_pending" name="status_pending">
                        <div id="planhpp_success" class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <dl id="getplan" class="dl-horizontal row">
                                <label class="col-sm-12">Parameter PLAN HPP</label>
                                <dd class="col-sm-3" style="font-weight: bold;">Min&nbsp;TP</dd>
                                <dd class="col-sm-3" style="font-weight: bold;"></dd>
                                <dd class="col-sm-3" style="font-weight: bold;">Max&nbsp;TP</dd>
                                <dd class="col-sm-3" style="font-weight: bold;">Harga</dd>
                            </dl>
                            <dl id="input_plan" class="dl-horizontal row">
                            </dl>
                        </div>
                        <a href="javascript:void(0);" id="notif_hpp_error">
                            <div id="planhpp_error" class="alert alert-danger">
                                <button type="button" class="close" style="margin-right:10px;" data-dismiss="alert" aria-hidden="true">×</button>
                                <label class="col-sm-12"><i class="fa fa-minus-circle"></i> Parameter PLAN HPP Belum Terisi</label>
                            </div>
                        </a>
                        <div id="hargaatas_success" class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <dl id="get_hargaatas" class="dl-horizontal row">
                                <label class="col-sm-12">Parameter Harga Atas</label>
                            </dl>
                            <dl id="input_hargaatas" class="dl-horizontal row">
                            </dl>
                        </div>
                        <a href="javascript:void(0);" id="notif_harga_atas_error">
                            <div id="hargaatas_error" class="alert alert-danger">
                                <button type="button" class="close" style="margin-right:10px;" data-dismiss="alert" aria-hidden="true">×</button>
                                <label class="col-sm-12"><i class="fa fa-minus-circle"></i> Parameter HARGA ATAS Belum Terisi</label>
                            </div>
                        </a>
                        <div id="hargabawah_success" class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <dl id="get_hargabawah" class="dl-horizontal row">
                                <label class="col-sm-12">Parameter Harga Bawah</label>
                            </dl>
                            <dl id="input_hargabawah" class="dl-horizontal row">
                            </dl>
                        </div>
                        <a href="javascript:void(0);" id="notif_harga_bawah_error">
                            <div id="hargabawah_error" class="alert alert-danger">
                                <button type="button" class="close" style="margin-right:10px;" data-dismiss="alert" aria-hidden="true">×</button>
                                <label class="col-sm-12"><i class="fa fa-minus-circle"></i> Parameter HARGA BAWAH Belum Terisi</label>
                            </div>
                        </a>
                        <div class="form-group">
                            <div class="">
                                <label>Code PO</label>
                                <input type="text" id="gabahincoming_kode_po" name="gabahincoming_kode_po" class="form-control m-input" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <label>Nopol</label>
                                <input type="text" id="gabahincoming_plat" readonly name="gabahincoming_plat" class="form-control m-input">
                            </div>
                        </div>
                        <div id="planhpp" class="form-group">
                        </div>
                        {{-- edit form --}}
                        <div class="m-form__group form-group">
                            <label for="">KA KS</label>
                            <input type="text" step="any" required name="kadar_air" id="kadar_air" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">KA KG</label>
                            <input type="text" step="any" required name="ka_kg" id="ka_kg" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">Berat Sample Awal KS</label>
                            <input type="text" step="any" required name="berat_sample_awal_ks" id="berat_sample_awal_ks" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">Berat Sample Awal KG</label>
                            <input type="text" step="any" required name="berat_sample_awal_kg" id="berat_sample_awal_kg" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">Berat Sample Akhir KG</label>
                            <input type="text" step="any" required name="berat_sample_akhir_kg" id="berat_sample_akhir_kg" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">Berat Sample PK</label>
                            <input type="text" step="any" required name="berat_sample_pk" id="berat_sample_pk" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">Berat Sample Beras</label>
                            <input type="text" step="any" required name="randoman" id="randoman" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">WH</label>
                            <input type="text" step="any" required name="wh" id="wh" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">TP</label>
                            <input type="text" step="any" required name="tp" id="tp" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">MD</label>
                            <input type="text" step="any" required name="md" id="md" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">Broken Setelah Bongkar</label>
                            <input type="text" step="any" required name="broken" id="broken" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">Status Lab </label>
                            <select class="form-select form-control m-input" id="keterangan_lab_1" required name="keterangan_lab_1" aria-label="Default select example">
                                <option value="">--Output Lab 1--</option>
                                <option name="keterangan_lab_1" value="Unload">Bongkar</option>
                                <option name="keterangan_lab_1" value="Pending">Pending</option>
                                <option name="keterangan_lab_1" value="Reject">Tolak</option>
                            </select>
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">Keterangan</label>
                            <input type="text" step="any" required name="keterangan_lab1" id="keterangan_lab1" class="form-control m-input">
                        </div>
                        <div class="m-form__group form-group">
                            <label for="">Plan Harga (Kg)</label>
                            <input readonly type="text" step="any" required name="plan_harga" id="plan_harga" class="form-control m-input">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                        <button id="btn_update" class="btn btn-success m-btn pull-right">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(function() {
            $(document).on('keypress', '#kadar_air', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#ka_kg', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#berat_sample_awal_ks', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#berat_sample_awal_kg', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#berat_sample_akhir_kg', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#berat_sample_pk', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#randoman', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#wh', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#tp', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#md', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
            $(document).on('keypress', '#broken', function(e) {
                var val = $(this).val();
                var regex = /^(\+|-)?(\d*\.?\d*)$/;
                if (regex.test(val + String.fromCharCode(e.charCode))) {
                    return true;
                }
                return false;
            });
        });
        $(document).on('keyup', '#plan_harga', function(e) {
            var data = $(this).val();
            var hasil = formatRupiah(data, "Rp. ");
            $(this).val(hasil);
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
        }

        function replace_titik(x) {
            return ((x.replace('.', '')).replace('.', '')).replace('.', '');
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.input-daterange').datepicker({
                todayBtn: 'linked',
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            load_data();

            function load_data(from_date = '', to_date = '') {
                var table = $('#data_longgrain').DataTable({
                    "scrollY": true,
                    "scrollX": true,
                    processing: true,
                    language: {
                        "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>'
                    },
                    serverSide: true,
                    "aLengthMenu": [
                        [25, 100, 300, -1],
                        [25, 100, 300, "All"]
                    ],
                    "iDisplayLength": 10,
                    ajax: {
                        url: "{{ route('qc.lab.output_lab1_gb_longgrain_index') }}",
                        data: {
                            from_date: from_date,
                            to_date: to_date
                        }
                    },
                    columns: [{
                            data: "id_bid",

                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'antrian'
                        },
                        {
                            data: 'name_bid'
                        },
                        {
                            data: 'kode_po'
                        },
                        {
                            data: 'nama_vendor'
                        },
                        {
                            data: 'waktu_penerimaan'
                        },
                        {
                            data: 'tanggal_po'
                        },
                        {
                            data: 'tanggal_bongkar'
                        },
                        {
                            data: 'plat_kendaraan'
                        },
                        {
                            data: 'asal_gabah'
                        },
                        {
                            data: 'ckelola'
                        },

                        {
                            data: 'kadar_air'
                        },
                        {
                            data: 'ka_kg'
                        },
                        {
                            data: 'berat_sample_awal_ks'
                        },
                        {
                            data: 'berat_sample_awal_kg'
                        },
                        {
                            data: 'berat_sample_akhir_kg'
                        },
                        {
                            data: 'berat_sample_pk'
                        },
                        {
                            data: 'berat_sample_beras'
                        },
                        {
                            data: 'wh'
                        },
                        {
                            data: 'tp'
                        },
                        {
                            data: 'md'
                        },
                        {
                            data: 'broken'
                        },
                        {
                            data: 'plan_harga_beli_gabah'
                        },


                    ],
                    createdRow: function(row, data, index) {

                        // Updated Schedule Week 1 - 07 Mar 22

                        if (data.name_bid == 'GABAH BASAH CIHERANG') {
                            $('td:eq(2)', row).css('color', '#000099'); //Original Date
                        } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                            $('td:eq(2)', row).css('color', '#009900'); // Behind of Original Date
                        } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                            $('td:eq(2)', row).css('color', '#330019'); // Behind of Original Date
                        } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                            $('td:eq(2)', row).css('color', '#6666FF'); // Behind of Original Date
                        }
                    },
                    "order": []
                });
                $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                    table.columns.adjust().draw().responsive.recalc();
                })
                var table1 = $('#data_longgrain1').DataTable({
                    "scrollY": true,
                    "scrollX": true,
                    processing: true,
                    language: {
                        "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>'
                    },
                    serverSide: true,
                    "aLengthMenu": [
                        [25, 100, 300, -1],
                        [25, 100, 300, "All"]
                    ],
                    "iDisplayLength": 10,
                    ajax: {
                        url: "{{ route('qc.lab.output_lab1_gb_longgrain_index') }}",
                        data: {
                            from_date: from_date,
                            to_date: to_date
                        }
                    },
                    columns: [{
                            data: "id_penerimaan_po",

                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'antrian'
                        },
                        {
                            data: 'name_bid'
                        },
                        {
                            data: 'kode_po'
                        },
                        {
                            data: 'nama_vendor'
                        },
                        {
                            data: 'waktu_penerimaan'
                        },
                        {
                            data: 'tanggal_po'
                        },
                        {
                            data: 'tanggal_bongkar'
                        },
                        {
                            data: 'plat_kendaraan'
                        },
                        {
                            data: 'asal_gabah'
                        },
                        {
                            data: 'plan_harga'
                        },
                        {
                            data: 'ckelola_manager'
                        },

                        {
                            data: 'kadar_air'
                        },
                        {
                            data: 'ka_kg'
                        },
                        {
                            data: 'berat_sample_awal_ks'
                        },
                        {
                            data: 'berat_sample_awal_kg'
                        },
                        {
                            data: 'berat_sample_akhir_kg'
                        },
                        {
                            data: 'berat_sample_pk'
                        },
                        {
                            data: 'berat_sample_beras'
                        },
                        {
                            data: 'wh'
                        },
                        {
                            data: 'tp'
                        },
                        {
                            data: 'md'
                        },
                        {
                            data: 'broken'
                        },
                        {
                            data: 'hampa'
                        },
                        {
                            data: 'kg_after_adjust_hampa'
                        },
                        {
                            data: 'prosentasi_kg'
                        },
                        {
                            data: 'susut'
                        },
                        {
                            data: 'adjust_susut'
                        },
                        {
                            data: 'prsentase_ks_kg_after_adjust_susut'
                        },
                        {
                            data: 'prsentase_kg_pk'
                        },
                        {
                            data: 'adjust_prosentase_kg_pk'
                        },
                        {
                            data: 'presentase_ks_pk'
                        },
                        {
                            data: 'presentase_putih'
                        },
                        {
                            data: 'adjust_prosentase_kg_ke_putih'
                        },
                        {
                            data: 'plan_rend_dari_ks_beras'
                        },
                        {
                            data: 'katul'
                        },
                        {
                            data: 'refraksi_broken'
                        },
                        {
                            data: 'plan_harga_gabah'
                        },
                        {
                            data: 'plan_harga_beli_gabah'
                        },


                    ],
                    createdRow: function(row, data, index) {

                        // Updated Schedule Week 1 - 07 Mar 22

                        if (data.name_bid == 'GABAH BASAH CIHERANG') {
                            $('td:eq(2)', row).css('color', '#000099'); //Original Date
                        } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                            $('td:eq(2)', row).css('color', '#009900'); // Behind of Original Date
                        } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                            $('td:eq(2)', row).css('color', '#330019'); // Behind of Original Date
                        } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                            $('td:eq(2)', row).css('color', '#6666FF'); // Behind of Original Date
                        }
                    },

                });
                $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                    table1.columns.adjust().draw().responsive.recalc();
                })
                var table2 = $('#data_pw').DataTable({
                    "scrollY": true,
                    "scrollX": true,
                    processing: true,
                    language: {
                        "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>'
                    },
                    serverSide: true,
                    "aLengthMenu": [
                        [25, 100, 300, -1],
                        [25, 100, 300, "All"]
                    ],
                    "iDisplayLength": 10,
                    ajax: {
                        url: "{{ route('qc.lab.output_lab1_gb_pandan_wangi_index') }}",
                        data: {
                            from_date: from_date,
                            to_date: to_date
                        }
                    },
                    columns: [{
                            data: "id_bid",

                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'antrian'
                        },
                        {
                            data: 'name_bid'
                        },
                        {
                            data: 'kode_po'
                        },
                        {
                            data: 'nama_vendor'
                        },
                        {
                            data: 'waktu_penerimaan'
                        },
                        {
                            data: 'tanggal_po'
                        },
                        {
                            data: 'tanggal_bongkar'
                        },
                        {
                            data: 'plat_kendaraan'
                        },
                        {
                            data: 'asal_gabah'
                        },
                        {
                            data: 'ckelola'
                        },
                        {
                            data: 'kadar_air'
                        },
                        {
                            data: 'ka_kg'
                        },
                        {
                            data: 'berat_sample_awal_ks'
                        },
                        {
                            data: 'berat_sample_awal_kg'
                        },
                        {
                            data: 'berat_sample_akhir_kg'
                        },
                        {
                            data: 'berat_sample_pk'
                        },
                        {
                            data: 'berat_sample_beras'
                        },
                        {
                            data: 'wh'
                        },
                        {
                            data: 'tp'
                        },
                        {
                            data: 'md'
                        },
                        {
                            data: 'broken'
                        },
                        {
                            data: 'plan_harga_beli_gabah'
                        },


                    ],
                    createdRow: function(row, data, index) {

                        // Updated Schedule Week 1 - 07 Mar 22

                        if (data.name_bid == 'GABAH BASAH CIHERANG') {
                            $('td:eq(2)', row).css('color', '#000099'); //Original Date
                        } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                            $('td:eq(2)', row).css('color', '#009900'); // Behind of Original Date
                        } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                            $('td:eq(2)', row).css('color', '#330019'); // Behind of Original Date
                        } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                            $('td:eq(2)', row).css('color', '#6666FF'); // Behind of Original Date
                        }
                    },
                    "order": []
                });
                $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                    table2.columns.adjust().draw().responsive.recalc();
                })
                var table3 = $('#data_pw1').DataTable({
                    "scrollY": true,
                    "scrollX": true,
                    processing: true,
                    language: {
                        "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>'
                    },
                    serverSide: true,
                    "aLengthMenu": [
                        [25, 100, 300, -1],
                        [25, 100, 300, "All"]
                    ],
                    "iDisplayLength": 10,
                    ajax: {
                        url: "{{ route('qc.lab.output_lab1_gb_pandan_wangi_index') }}",
                        data: {
                            from_date: from_date,
                            to_date: to_date
                        }
                    },
                    columns: [{
                            data: "id_bid",

                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'antrian'
                        },
                        {
                            data: 'name_bid'
                        },
                        {
                            data: 'kode_po'
                        },
                        {
                            data: 'nama_vendor'
                        },
                        {
                            data: 'waktu_penerimaan'
                        },
                        {
                            data: 'tanggal_po'
                        },
                        {
                            data: 'tanggal_bongkar'
                        },
                        {
                            data: 'plat_kendaraan'
                        },
                        {
                            data: 'asal_gabah'
                        },
                        {
                            data: 'plan_harga'
                        },
                        {
                            data: 'ckelola_manager'
                        },

                        {
                            data: 'kadar_air'
                        },
                        {
                            data: 'ka_kg'
                        },
                        {
                            data: 'berat_sample_awal_ks'
                        },
                        {
                            data: 'berat_sample_awal_kg'
                        },
                        {
                            data: 'berat_sample_akhir_kg'
                        },
                        {
                            data: 'berat_sample_pk'
                        },
                        {
                            data: 'berat_sample_beras'
                        },
                        {
                            data: 'wh'
                        },
                        {
                            data: 'tp'
                        },
                        {
                            data: 'md'
                        },
                        {
                            data: 'broken'
                        },
                        {
                            data: 'hampa'
                        },
                        {
                            data: 'kg_after_adjust_hampa'
                        },
                        {
                            data: 'prosentasi_kg'
                        },
                        {
                            data: 'susut'
                        },
                        {
                            data: 'adjust_susut'
                        },
                        {
                            data: 'prsentase_ks_kg_after_adjust_susut'
                        },
                        {
                            data: 'prsentase_kg_pk'
                        },
                        {
                            data: 'adjust_prosentase_kg_pk'
                        },
                        {
                            data: 'presentase_ks_pk'
                        },
                        {
                            data: 'presentase_putih'
                        },
                        {
                            data: 'adjust_prosentase_kg_ke_putih'
                        },
                        {
                            data: 'plan_rend_dari_ks_beras'
                        },
                        {
                            data: 'katul'
                        },
                        {
                            data: 'refraksi_broken'
                        },
                        {
                            data: 'plan_harga_gabah'
                        },
                        {
                            data: 'plan_harga_beli_gabah'
                        },


                    ],
                    createdRow: function(row, data, index) {

                        // Updated Schedule Week 1 - 07 Mar 22

                        if (data.name_bid == 'GABAH BASAH CIHERANG') {
                            $('td:eq(2)', row).css('color', '#000099'); //Original Date
                        } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                            $('td:eq(2)', row).css('color', '#009900'); // Behind of Original Date
                        } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                            $('td:eq(2)', row).css('color', '#330019'); // Behind of Original Date
                        } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                            $('td:eq(2)', row).css('color', '#6666FF'); // Behind of Original Date
                        }
                    },
                });
                $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                    table3.columns.adjust().draw().responsive.recalc();
                })
                var table4 = $('#data_kp').DataTable({
                    "scrollY": true,
                    "scrollX": true,
                    processing: true,
                    language: {
                        "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>'
                    },
                    serverSide: true,
                    "aLengthMenu": [
                        [25, 100, 300, -1],
                        [25, 100, 300, "All"]
                    ],
                    "iDisplayLength": 10,
                    ajax: {
                        url: "{{ route('qc.lab.output_lab1_gb_ketan_putih_index') }}",
                        data: {
                            from_date: from_date,
                            to_date: to_date
                        }
                    },
                    columns: [{
                            data: "id_bid",

                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'antrian'
                        },
                        {
                            data: 'name_bid'
                        },
                        {
                            data: 'kode_po'
                        },
                        {
                            data: 'nama_vendor'
                        },
                        {
                            data: 'waktu_penerimaan'
                        },
                        {
                            data: 'tanggal_po'
                        },
                        {
                            data: 'tanggal_bongkar'
                        },
                        {
                            data: 'plat_kendaraan'
                        },
                        {
                            data: 'asal_gabah'
                        },
                        {
                            data: 'ckelola'
                        },

                        {
                            data: 'kadar_air'
                        },
                        {
                            data: 'ka_kg'
                        },
                        {
                            data: 'berat_sample_awal_ks'
                        },
                        {
                            data: 'berat_sample_awal_kg'
                        },
                        {
                            data: 'berat_sample_akhir_kg'
                        },
                        {
                            data: 'berat_sample_pk'
                        },
                        {
                            data: 'berat_sample_beras'
                        },
                        {
                            data: 'wh'
                        },
                        {
                            data: 'tp'
                        },
                        {
                            data: 'md'
                        },
                        {
                            data: 'broken'
                        },
                        {
                            data: 'plan_harga_beli_gabah'
                        },


                    ],
                    createdRow: function(row, data, index) {

                        // Updated Schedule Week 1 - 07 Mar 22

                        if (data.name_bid == 'GABAH BASAH CIHERANG') {
                            $('td:eq(2)', row).css('color', '#000099'); //Original Date
                        } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                            $('td:eq(2)', row).css('color', '#009900'); // Behind of Original Date
                        } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                            $('td:eq(2)', row).css('color', '#330019'); // Behind of Original Date
                        } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                            $('td:eq(2)', row).css('color', '#6666FF'); // Behind of Original Date
                        }
                    },
                    "order": []
                });
                $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                    table4.columns.adjust().draw().responsive.recalc();
                })
                var table5 = $('#data_kp1').DataTable({
                    "scrollY": true,
                    "scrollX": true,
                    processing: true,
                    language: {
                        "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>'
                    },
                    serverSide: true,
                    "aLengthMenu": [
                        [25, 100, 300, -1],
                        [25, 100, 300, "All"]
                    ],
                    "iDisplayLength": 10,
                    ajax: {
                        url: "{{ route('qc.lab.output_lab1_gb_ketan_putih_index') }}",
                        data: {
                            from_date: from_date,
                            to_date: to_date
                        }
                    },
                    columns: [{
                            data: "id_bid",

                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'antrian'
                        },
                        {
                            data: 'name_bid'
                        },
                        {
                            data: 'kode_po'
                        },
                        {
                            data: 'nama_vendor'
                        },
                        {
                            data: 'waktu_penerimaan'
                        },
                        {
                            data: 'tanggal_po'
                        },
                        {
                            data: 'tanggal_bongkar'
                        },
                        {
                            data: 'plat_kendaraan'
                        },
                        {
                            data: 'asal_gabah'
                        },
                        {
                            data: 'plan_harga'
                        },
                        {
                            data: 'ckelola_manager'
                        },

                        {
                            data: 'kadar_air'
                        },
                        {
                            data: 'ka_kg'
                        },
                        {
                            data: 'berat_sample_awal_ks'
                        },
                        {
                            data: 'berat_sample_awal_kg'
                        },
                        {
                            data: 'berat_sample_akhir_kg'
                        },
                        {
                            data: 'berat_sample_pk'
                        },
                        {
                            data: 'berat_sample_beras'
                        },
                        {
                            data: 'wh'
                        },
                        {
                            data: 'tp'
                        },
                        {
                            data: 'md'
                        },
                        {
                            data: 'broken'
                        },
                        {
                            data: 'hampa'
                        },
                        {
                            data: 'kg_after_adjust_hampa'
                        },
                        {
                            data: 'prosentasi_kg'
                        },
                        {
                            data: 'susut'
                        },
                        {
                            data: 'adjust_susut'
                        },
                        {
                            data: 'prsentase_ks_kg_after_adjust_susut'
                        },
                        {
                            data: 'prsentase_kg_pk'
                        },
                        {
                            data: 'adjust_prosentase_kg_pk'
                        },
                        {
                            data: 'presentase_ks_pk'
                        },
                        {
                            data: 'presentase_putih'
                        },
                        {
                            data: 'adjust_prosentase_kg_ke_putih'
                        },
                        {
                            data: 'plan_rend_dari_ks_beras'
                        },
                        {
                            data: 'katul'
                        },
                        {
                            data: 'refraksi_broken'
                        },
                        {
                            data: 'plan_harga_gabah'
                        },
                        {
                            data: 'plan_harga_beli_gabah'
                        },


                    ],
                    createdRow: function(row, data, index) {

                        // Updated Schedule Week 1 - 07 Mar 22

                        if (data.name_bid == 'GABAH BASAH CIHERANG') {
                            $('td:eq(2)', row).css('color', '#000099'); //Original Date
                        } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                            $('td:eq(2)', row).css('color', '#009900'); // Behind of Original Date
                        } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                            $('td:eq(2)', row).css('color', '#330019'); // Behind of Original Date
                        } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                            $('td:eq(2)', row).css('color', '#6666FF'); // Behind of Original Date
                        }
                    },
                });
                $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                    table5.columns.adjust().draw().responsive.recalc();
                })
            }
            $('#filter').click(function() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();

                if (from_date != '' && to_date != '') {
                    // table.ajax.reload(from_date, to_date);
                    $('#data_longgrain').DataTable().destroy();
                    $('#data_pw').DataTable().destroy();
                    $('#data_kp').DataTable().destroy();
                    $('#data_longgrain1').DataTable().destroy();
                    $('#data_pw1').DataTable().destroy();
                    $('#data_kp1').DataTable().destroy();
                    load_data(from_date, to_date);
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Sukses filter data',
                        icon: 'success',
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        title: 'Infoo!!',
                        text: 'Mohon Isikan data',
                        icon: 'warning',
                        timer: 1500
                    })
                }

            });

            $('#refresh').click(function() {
                $('#from_date').val('');
                $('#to_date').val('');
                $('#data_longgrain').DataTable().destroy();
                $('#data_pw').DataTable().destroy();
                $('#data_kp').DataTable().destroy();
                $('#data_longgrain1').DataTable().destroy();
                $('#data_pw1').DataTable().destroy();
                $('#data_kp1').DataTable().destroy();
                load_data();
            });
            $('#btn_export').click(function() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                $.ajax({
                    data: {
                        "_token": "{{ csrf_token() }}",
                        from_date: from_date,
                        to_date: to_date,
                    },
                    url: "{{route('qc.lab.download_output_lab1_excel')}}",
                    type: "POST",
                    cache: false,
                    xhrFields: {
                        responseType: 'blob'
                    },
                    error: function() {
                        alert('Something is wrong');
                    },
                    success: function(data, status, xhr) {
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(data);
                        link.download = `DATA OUTPUT LAB 1 PT. SURYA PANGAN SEMESTA NGAWI.xlsx`;
                        link.click();

                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $(document).on('click', '#notif_hpp_error', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Maaf!',
                    icon: 'error',
                    text: "Plan HPP Belum Di isi SPV",
                    position: top
                })
            });
            $(document).on('click', '#notif_harga_atas_error', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Maaf!',
                    icon: 'error',
                    text: "Plan Harga Atas Belum Di isi SPV",
                    position: top
                })
            });
            $(document).on('click', '#notif_harga_bawah_error', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Maaf!',
                    icon: 'error',
                    text: "Plan Harga Bawah Belum Di isi SPV",
                    position: top
                })
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $(document).on('click', '#btn_approve_bongkar', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Konfirmasi',
                    icon: 'warning',
                    text: "Apakah Kamu Yakin Data Sudah Benar ?",
                    showCancelButton: true,
                    inputValue: 0,
                    confirmButtonText: 'Yes',
                }).then(function(result) {
                    if (result.value) {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Proses Menyimpan Data...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                                $.ajax({
                                    type: "GET",
                                    url: "{{route('qc.lab.approve_lab1_gb') }}/" + id,
                                    error: function() {
                                        alert('Something is wrong');
                                    },
                                    success: function(data) {
                                        $('#data_longgrain').DataTable().ajax.reload();
                                        $('#data_pw').DataTable().ajax.reload();
                                        $('#data_kp').DataTable().ajax.reload();
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: 'Data anda berhasil di Simpan.',
                                            icon: 'success',
                                            timer: 1500
                                        })
                                    }
                                });
                            }
                        });
                    } else {
                        Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                    }
                });
            });
            $(document).on('click', '#btn_bongkar', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Konfirmasi',
                    icon: 'warning',
                    text: "Apakah Kamu Yakin Data Sudah Benar ?",
                    showCancelButton: true,
                    inputValue: 0,
                    confirmButtonText: 'Yes',
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            type: "GET",
                            url: "{{route('qc.lab.approve_lab1_gb') }}/" + id,
                            error: function() {
                                alert('Something is wrong');
                            },
                            success: function(data) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Data anda berhasil di Simpan.',
                                    icon: 'success',
                                    timer: 1500
                                })
                                $('#datatable_gabah_basah').DataTable().ajax.reload();
                                $('#datatable_gabah_basah1').DataTable().ajax.reload();
                                $('#datatable_gabah_basah2').DataTable().ajax.reload();
                                $('#datatable_gabah_basah3').DataTable().ajax.reload();
                            }
                        });

                    } else {
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Data Tidak Tersimpan ',
                            icon: 'error',
                            timer: 1500

                        })

                    }
                });
            });

        });
    </script>

    @endsection