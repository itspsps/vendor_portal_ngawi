@extends('dashboard.admin_master.layout.main')
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
                            <button type="button" name="btn_export" id="btn_export" class="btn btn-success"><i class="fa fa-file-excel"></i>Excel</button>
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
                                <ul class="nav nav-pills float-right" role="tablist">
                                    <li class="nav-item mt-3">
                                        <a class="btn btn-sm btn-secondary btn-outline-hover-secondary active" role="tab" aria-controls="tabs_lab1_1" aria-selected="true" data-toggle="tab" href="#tabs_lab1_1"><i class="flaticon2-list-1"></i>PENGAJUAN APPROVE</a>
                                    </li>
                                    <li class="nav-item mt-3">
                                        <a class="btn btn-sm btn-secondary btn-outline-hover-success" id="notif_swal_bongkar" role="tab" aria-controls="tabs_lab1_2" aria-selected="false" data-toggle="tab" href="#tabs_lab1_2"><i class="flaticon2-list-1"></i>APPROVED SUCCESS</a>
                                    </li>
                                    <li class="nav-item mt-3">
                                        <a class="btn btn-sm btn-secondary btn-outline-hover-danger" id="notif_swal_tolak" role="tab" aria-controls="tabs_lab1_3" aria-selected="false" data-toggle="tab" href="#tabs_lab1_3"><i class="flaticon2-list-1"></i>APPROVED TOLAK</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabs_lab1_1" role="tabpanel">
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
                                    </div>
                                    <div class="tab-pane" id="tabs_lab1_2" role="tabpanel">
                                        <table class="table table-bordered" id="data_longgrain1_approved">
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
                                                    <th style="text-align: center;width:auto">Status&nbsp;Approved</th>
                                                    <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Posisi&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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
                                    </div>
                                    <div class="tab-pane" id="tabs_lab1_3" role="tabpanel">
                                        <table class="table table-bordered" id="data_longgrain1_approvedtolak">
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
                                                    <th style="text-align: center;width:auto">Status&nbsp;Approve</th>
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
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="m_tabs_3_2" role="tabpanel">
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
                            </div>
                            <div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
    $(document).ready(function() {
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        load_data();

        function load_data(from_date = '', to_date = '') {

            var table1 = $('#data_longgrain1').DataTable({
                "scrollY": true,
                "scrollX": true,
                processing: true,
                language: {
                    "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>'
                },
                serverSide: true,
                "aLengthMenu": [
                    [10, 25, 100, 300, -1],
                    [10, 25, 100, 300, "All"]
                ],
                "iDisplayLength": 10,
                ajax: {
                    url: "{{ route('master.lab.output_lab1_gb_longgrain_index') }}",
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


            var table3 = $('#data_pw1').DataTable({
                "scrollY": true,
                "scrollX": true,
                processing: true,
                language: {
                    "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>'
                },
                serverSide: true,
                "aLengthMenu": [
                    [10, 25, 100, 300, -1],
                    [10, 25, 100, 300, "All"]
                ],
                "iDisplayLength": 10,
                ajax: {
                    url: "{{ route('master.lab.output_lab1_gb_pandan_wangi_index') }}",
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
            var table5 = $('#data_kp1').DataTable({
                "scrollY": true,
                "scrollX": true,
                processing: true,
                language: {
                    "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>'
                },
                serverSide: true,
                "aLengthMenu": [
                    [10, 25, 100, 300, -1],
                    [10, 25, 100, 300, "All"]
                ],
                "iDisplayLength": 10,
                ajax: {
                    url: "{{ route('master.lab.output_lab1_gb_ketan_putih_index') }}",
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
            var table7 = $('#data_longgrain1_approved').DataTable({
                "scrollY": true,
                "scrollX": true,
                processing: true,
                language: {
                    "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>'
                },
                serverSide: true,
                "aLengthMenu": [
                    [10, 25, 100, 300, -1],
                    [10, 25, 100, 300, "All"]
                ],
                "iDisplayLength": 10,
                ajax: {
                    url: "{{ route('master.lab.output_lab1_gb_longgrain_approved_index') }}",
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
                        data: 'approved'
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
                table7.columns.adjust().draw().responsive.recalc();
            })
            var table9 = $('#data_longgrain1_approvedtolak').DataTable({
                "scrollY": true,
                "scrollX": true,
                processing: true,
                language: {
                    "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>'
                },
                serverSide: true,
                "aLengthMenu": [
                    [10, 25, 100, 300, -1],
                    [10, 25, 100, 300, "All"]
                ],
                "iDisplayLength": 10,
                ajax: {
                    url: "{{ route('master.lab.output_lab1_gb_longgrain_approvedtolak_index') }}",
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
                        data: 'approved'
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
                table9.columns.adjust().draw().responsive.recalc();
            })
        }
        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            if (from_date != '' && to_date != '') {
                // table.ajax.reload(from_date, to_date);
                $('#data_longgrain1').DataTable().destroy();
                $('#data_pw1').DataTable().destroy();
                $('#data_kp1').DataTable().destroy();
                $('#data_longgrain1_approved').DataTable().destroy();
                $('#data_longgrain1_approvedtolak').DataTable().destroy();
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
            $('#data_longgrain1').DataTable().destroy();
            $('#data_pw1').DataTable().destroy();
            $('#data_kp1').DataTable().destroy();
            $('#data_longgrain1_approved').DataTable().destroy();
            $('#data_longgrain1_approvedtolak').DataTable().destroy();
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
                url: "{{route('master.lab.download_output_lab1_excel')}}",
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
        $(document).on('click', '#notif_swal_bongkar', function(e) {
            var from_date = $('#from_date').val();
            var end_date = $('#end_date').val();
            $.ajax({
                type: "GET",
                url: "{{route('master.lab.count_outputlab1_gb') }}",
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    if (from_date == null || from_date == '') {
                        if (data.count_success >= 200) {

                            Swal.fire({
                                title: 'Data Limits 200 Row',
                                text: 'Harap Menggunakan Filter PO Untuk Mengetahui PO Terdahulu',
                                icon: 'warning',
                                // timer: 5000
                            })
                        }
                    }
                }
            })

        });
        $(document).on('click', '#notif_swal_tolak', function(e) {
            var from_date = $('#from_date').val();
            var end_date = $('#end_date').val();
            $.ajax({
                type: "GET",
                url: "{{route('master.lab.count_outputlab1_gb') }}",
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    console.log(data.count_tolak);
                    if (from_date == null || from_date == '') {
                        if (data.count_tolak >= 200) {

                            Swal.fire({
                                title: 'Data Limits 200 Row',
                                text: 'Harap Menggunakan Filter PO Untuk Mengetahui PO Terdahulu',
                                icon: 'warning',
                                // timer: 5000
                            })
                        }
                    }
                }
            })

        });

    });
</script>

@endsection