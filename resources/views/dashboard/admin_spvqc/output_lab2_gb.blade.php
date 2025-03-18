@extends('dashboard.admin_spvqc.layout.main')
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
                    PT. SURYA PANGAN SEMESTA
                </h3>
                <span class="btn-outline btn-sm btn-info mr-3">NGAWI</span>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        Output Lab Bongkaran
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
                            <i class="kt-menu__link-icon flaticon2-writing kt-font-success"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Hasil Data Lab 2 Gabah Basah
                        </h3>
                    </div>
                </div>
                <div style="margin-left: 10px; margin-top:10px;" class="row input-daterange">
                    <div class="col-md-4">
                        <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                    </div>
                    <div class="col-md-4">
                        <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                        <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item mt-3">
                            <a class="nav-link active" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-database"></i>GB LONG GRAIN</a>
                        </li>
                        <!-- <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_2"><i class="la la-database"></i>GB CIHERANG</a>
                        </li> -->
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_3"><i class="la la-database"></i>GB PANDAN WANGI</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_4"><i class="la la-database"></i>GB KETAN PUTIH</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <ul class="nav nav-pills float-right" role="tablist">
                            <li class="nav-item mt-3">
                                <a class="btn btn-sm btn-secondary btn-outline-hover-secondary active" role="tab" aria-controls="lab2_1" aria-selected="true" data-toggle="tab" href="#lab2_1"><i class="flaticon2-list-1"></i>PENGAJUAN APPROVE</a>
                            </li>

                            <li class="nav-item mt-3">
                                <a class="btn btn-sm btn-secondary btn-outline-hover-success" id="notif_swal_success" role="tab" aria-controls="lab2_2" aria-selected="false" data-toggle="tab" href="#lab2_2"><i class="flaticon2-list-1"></i>APPROVED SUCCESS</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="lab2_1" role="tabpanel">
                                <table class="table table-bordered" id="data_longgrain">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;width:2%">No</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Kategori&nbsp;PO</th>
                                            <th style="text-align: center;width:auto">Status </th>
                                            <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                            <th style="text-align: center;width:auto">Tanggal&nbsp;Bongkaran</th>
                                            <th style="text-align: center;width:auto">Asal&nbsp;Gabah</th>
                                            <th style="text-align: center;width:auto">DTM&nbsp;KS</th>
                                            <th style="text-align: center;width:auto">Lokasi&nbsp;Bongkar</th>

                                            <th style="text-align: center;width:auto">Tonase&nbsp;KS</th>
                                            <th style="text-align: center;width:auto">KA&nbsp;KS</th>
                                            <th style="text-align: center;width:auto">KA&nbsp;KG</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Awal&nbsp;KS</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Awal&nbsp;KG</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Akhir&nbsp;KG</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;PK</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Beras</th>
                                            <th style="text-align: center;width:auto">WH</th>
                                            <th style="text-align: center;width:auto">TP</th>

                                            <th style="text-align: center;width:auto">MD</th>
                                            <th style="text-align: center;width:auto">Broken&nbsp;Setelah&nbsp;Bongkar</th>
                                            <th style="text-align: center;width:auto">Hampa&nbsp;(%)</th>
                                            <th style="text-align: center;width:auto">KG&nbsp;After&nbsp;Adjust&nbsp;Hampa</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;KG</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;Susut</th>
                                            <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;Susut&nbsp;1.2</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;KS&nbsp;&minus;&nbsp;KG&nbsp;After&nbsp;Adjust&nbsp;Susut</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;KG&nbsp;&minus;&nbsp;PK</th>
                                            <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;KG&nbsp;&minus;&nbsp;PK&nbsp;(0.952)</th>

                                            <th style="text-align: center;width:auto">(%)&nbsp;KS&nbsp;&minus;&nbsp;PK</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;Putih</th>
                                            <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;KG&nbsp;ke&nbsp;Putih&nbsp;(0.952)</th>
                                            <th style="text-align: center;width:auto">Pland&nbsp;Rend&nbsp;dari&nbsp;KS&nbsp;&minus;&nbsp;Beras</th>
                                            <th style="text-align: center;width:auto">Katul</th>
                                            <th style="text-align: center;width:auto">Refraksi&nbsp;Broken</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;Harga&nbsp;Gabah&nbsp;/Kg&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;Harga&nbsp;Beli&nbsp;gabah&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>

                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Tempat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Atas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Awal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Aksi&nbsp;Harga</th>
                                            <th style="text-align: center;width:auto">Reaksi&nbsp;Harga</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;(&minus;Rp.&nbsp;14)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Keterangan&nbsp;Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center">
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="lab2_2" role="tabpanel">
                                <table class="table table-bordered" id="data_longgrain_approved">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;width:2%">No</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Kategori&nbsp;PO</th>
                                            <th style="text-align: center;width:auto">Status </th>
                                            <th style="text-align: center;width:auto">Waktu&nbsp;Approve</th>
                                            <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                            <th style="text-align: center;width:auto">Tanggal&nbsp;Bongkaran</th>
                                            <th style="text-align: center;width:auto">Asal&nbsp;Gabah</th>
                                            <th style="text-align: center;width:auto">DTM&nbsp;KS</th>
                                            <th style="text-align: center;width:auto">Lokasi&nbsp;Bongkar</th>

                                            <th style="text-align: center;width:auto">Tonase&nbsp;KS</th>
                                            <th style="text-align: center;width:auto">KA&nbsp;KS</th>
                                            <th style="text-align: center;width:auto">KA&nbsp;KG</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Awal&nbsp;KS</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Awal&nbsp;KG</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Akhir&nbsp;KG</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;PK</th>
                                            <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Beras</th>
                                            <th style="text-align: center;width:auto">WH</th>
                                            <th style="text-align: center;width:auto">TP</th>

                                            <th style="text-align: center;width:auto">MD</th>
                                            <th style="text-align: center;width:auto">Broken&nbsp;Setelah&nbsp;Bongkar</th>
                                            <th style="text-align: center;width:auto">Hampa&nbsp;(%)</th>
                                            <th style="text-align: center;width:auto">KG&nbsp;After&nbsp;Adjust&nbsp;Hampa</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;KG</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;Susut</th>
                                            <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;Susut&nbsp;1.2</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;KS&nbsp;&minus;&nbsp;KG&nbsp;After&nbsp;Adjust&nbsp;Susut</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;KG&nbsp;&minus;&nbsp;PK</th>
                                            <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;KG&nbsp;&minus;&nbsp;PK&nbsp;(0.952)</th>

                                            <th style="text-align: center;width:auto">(%)&nbsp;KS&nbsp;&minus;&nbsp;PK</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;Putih</th>
                                            <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;KG&nbsp;ke&nbsp;Putih&nbsp;(0.952)</th>
                                            <th style="text-align: center;width:auto">Pland&nbsp;Rend&nbsp;dari&nbsp;KS&nbsp;&minus;&nbsp;Beras</th>
                                            <th style="text-align: center;width:auto">Katul</th>
                                            <th style="text-align: center;width:auto">Refraksi&nbsp;Broken</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;Harga&nbsp;Gabah&nbsp;/Kg&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;Harga&nbsp;Beli&nbsp;gabah&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>

                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Tempat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Atas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Awal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Aksi&nbsp;Harga</th>
                                            <th style="text-align: center;width:auto">Reaksi&nbsp;Harga</th>
                                            <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;(&minus;Rp.&nbsp;14)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th style="text-align: center;width:auto">Keterangan&nbsp;Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
                            <table class="table table-bordered" id="data_pw">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Status </th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;Bongkaran</th>
                                        <th style="text-align: center;width:auto">Asal&nbsp;Gabah</th>
                                        <th style="text-align: center;width:auto">DTM&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">Tonase&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">KA&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">KA&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Awal&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Awal&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Akhir&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;PK</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Beras</th>
                                        <th style="text-align: center;width:auto">WH</th>
                                        <th style="text-align: center;width:auto">TP</th>
                                        <th style="text-align: center;width:auto">MD</th>
                                        <th style="text-align: center;width:auto">Broken&nbsp;Setelah&nbsp;Bongkar</th>

                                        <th style="text-align: center;width:auto">Hampa&nbsp;(%)</th>
                                        <th style="text-align: center;width:auto">KG&nbsp;After&nbsp;Adjust&nbsp;Hampa</th>
                                        <th style="text-align: center;width:auto">(%)&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">(%)&nbsp;Susut</th>
                                        <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;Susut&nbsp;1.2</th>
                                        <th style="text-align: center;width:auto">(%)&nbsp;KS&nbsp;&minus;&nbsp;KG&nbsp;After&nbsp;Adjust&nbsp;Susut</th>
                                        <th style="text-align: center;width:auto">(%)&nbsp;KG&nbsp;&minus;&nbsp;PK</th>
                                        <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;KG&nbsp;&minus;&nbsp;PK&nbsp;(0.952)</th>
                                        <th style="text-align: center;width:auto">(%)&nbsp;KS&nbsp;&minus;&nbsp;PK</th>
                                        <th style="text-align: center;width:auto">(%)&nbsp;Putih</th>
                                        <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;KG&nbsp;ke&nbsp;Putih&nbsp;(0.952)</th>
                                        <th style="text-align: center;width:auto">Pland&nbsp;Rend&nbsp;dari&nbsp;KS&nbsp;&minus;&nbsp;Beras</th>
                                        <th style="text-align: center;width:auto">Katul</th>
                                        <th style="text-align: center;width:auto">Refraksi&nbsp;Broken</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;Harga&nbsp;Gabah&nbsp;/Kg&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;Harga&nbsp;Beli&nbsp;gabah&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Tempat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Atas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Awal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Aksi&nbsp;Harga</th>
                                        <th style="text-align: center;width:auto">Reaksi&nbsp;Harga</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;&minus;&nbsp;Rp.&nbsp;14&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Keterangan&nbsp;Harga</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_4" role="tabpanel">
                            <table class="table table-bordered" id="data_kp">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Status </th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;Bongkaran</th>
                                        <th style="text-align: center;width:auto">Asal&nbsp;Gabah</th>
                                        <th style="text-align: center;width:auto">DTM&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">Tonase&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">KA&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">KA&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Awal&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Awal&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Akhir&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;PK</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sampel&nbsp;Beras</th>
                                        <th style="text-align: center;width:auto">WH</th>
                                        <th style="text-align: center;width:auto">TP</th>
                                        <th style="text-align: center;width:auto">MD</th>
                                        <th style="text-align: center;width:auto">Broken&nbsp;Setelah&nbsp;Bongkar</th>

                                        <th style="text-align: center;width:auto">Hampa&nbsp;(%)</th>
                                        <th style="text-align: center;width:auto">KG&nbsp;After&nbsp;Adjust&nbsp;Hampa</th>
                                        <th style="text-align: center;width:auto">(%)&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">(%)&nbsp;Susut</th>
                                        <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;Susut&nbsp;1.2</th>
                                        <th style="text-align: center;width:auto">(%)&nbsp;KS&nbsp;&minus;&nbsp;KG&nbsp;After&nbsp;Adjust&nbsp;Susut</th>
                                        <th style="text-align: center;width:auto">(%)&nbsp;KG&nbsp;&minus;&nbsp;PK</th>
                                        <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;KG&nbsp;&minus;&nbsp;PK&nbsp;(0.952)</th>
                                        <th style="text-align: center;width:auto">(%)&nbsp;KS&nbsp;&minus;&nbsp;PK</th>
                                        <th style="text-align: center;width:auto">(%)&nbsp;Putih</th>
                                        <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;KG&nbsp;ke&nbsp;Putih&nbsp;(0.952)</th>
                                        <th style="text-align: center;width:auto">Pland&nbsp;Rend&nbsp;dari&nbsp;KS&nbsp;&minus;&nbsp;Beras</th>
                                        <th style="text-align: center;width:auto">Katul</th>
                                        <th style="text-align: center;width:auto">Refraksi&nbsp;Broken</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;Harga&nbsp;Gabah&nbsp;/Kg&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;Harga&nbsp;Beli&nbsp;gabah&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Tempat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Atas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Awal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Aksi&nbsp;Harga</th>
                                        <th style="text-align: center;width:auto">Reaksi&nbsp;Harga</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;&minus;&nbsp;Rp.&nbsp;14&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Keterangan&nbsp;Harga</th>
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

    <!-- end:: Content -->
</div>
@endsection
@section('js')
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
                    [10, 25, 100, 300, -1],
                    [10, 25, 100, 300, "All"]
                ],
                "iDisplayLength": 25,
                ajax: {
                    url: "{{ route('qc.spv.new_output_lab2_gb_longgrain_index') }}",
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
                        data: 'name_bid'
                    },
                    {
                        data: 'kode_po'
                    },
                    {
                        data: 'nama_vendor'
                    },
                    {
                        data: 'plat_kendaraan'
                    },
                    {
                        data: 'kategory_po'
                    },
                    {
                        data: 'status_lab2_gb'
                    },
                    {
                        data: 'tanggal_po'
                    },
                    {
                        data: 'tanggal_bongkar'
                    },
                    {
                        data: 'keterangan_penerimaan_po'
                    },
                    {
                        data: 'no_dtm'
                    },
                    {
                        data: 'lokasi_bongkar'
                    },
                    {
                        data: 'hasil_akhir_tonase'
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
                    {
                        data: 'harga_berdasarkan_tempat'
                    },
                    {
                        data: 'harga_berdasarkan_harga_atas'
                    },
                    {
                        data: 'harga_awal'
                    },
                    {
                        data: 'aksi_harga'
                    },
                    {
                        data: 'reaksi_harga'
                    },
                    {
                        data: 'harga_akhir'
                    },
                    {
                        data: 'keterangan_harga_akhir_gb'
                    }
                ],
                createdRow: function(row, data, index) {

                    // Updated Schedule Week 1 - 07 Mar 22

                    if (data.name_bid == 'GABAH BASAH CIHERANG') {
                        $('td:eq(1)', row).css('color', '#000099'); //Original Date
                    } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                        $('td:eq(1)', row).css('color', '#009900'); // Behind of Original Date
                    } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                        $('td:eq(1)', row).css('color', '#330019'); // Behind of Original Date
                    } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                        $('td:eq(1)', row).css('color', '#6666FF'); // Behind of Original Date
                    }
                },
                "order": []
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                table.columns.adjust().draw().responsive.recalc();
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
                    [10, 25, 100, 300, -1],
                    [10, 25, 100, 300, "All"]
                ],
                "iDisplayLength": 25,
                ajax: {
                    url: "{{ route('qc.spv.output_lab2_gb_pandan_wangi_index') }}",
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
                        data: 'name_bid'
                    },
                    {
                        data: 'kode_po'
                    },
                    {
                        data: 'nama_vendor'
                    },
                    {
                        data: 'plat_kendaraan'
                    },
                    {
                        data: 'status_lab2_gb'
                    },
                    {
                        data: 'tanggal_po'
                    },
                    {
                        data: 'tanggal_bongkar'
                    },
                    {
                        data: 'keterangan_penerimaan_po'
                    },
                    {
                        data: 'no_dtm'
                    },
                    {
                        data: 'hasil_akhir_tonase'
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
                    {
                        data: 'harga_berdasarkan_tempat'
                    },
                    {
                        data: 'harga_berdasarkan_harga_atas'
                    },
                    {
                        data: 'harga_awal'
                    },
                    {
                        data: 'aksi_harga'
                    },
                    {
                        data: 'reaksi_harga'
                    },
                    {
                        data: 'harga_akhir'
                    },
                    {
                        data: 'keterangan_harga_akhir_gb'
                    }
                ],
                createdRow: function(row, data, index) {

                    // Updated Schedule Week 1 - 07 Mar 22

                    if (data.name_bid == 'GABAH BASAH CIHERANG') {
                        $('td:eq(1)', row).css('color', '#000099'); //Original Date
                    } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                        $('td:eq(1)', row).css('color', '#009900'); // Behind of Original Date
                    } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                        $('td:eq(1)', row).css('color', '#330019'); // Behind of Original Date
                    }
                },
                "order": []
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                table2.columns.adjust().draw().responsive.recalc();
            })
            var table3 = $('#data_kp').DataTable({
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
                "iDisplayLength": 25,
                ajax: {
                    url: "{{ route('qc.spv.output_lab2_gb_ketan_putih_index') }}",
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
                        data: 'name_bid'
                    },
                    {
                        data: 'kode_po'
                    },
                    {
                        data: 'nama_vendor'
                    },
                    {
                        data: 'plat_kendaraan'
                    },
                    {
                        data: 'status_lab2_gb'
                    },
                    {
                        data: 'tanggal_po'
                    },
                    {
                        data: 'tanggal_bongkar'
                    },
                    {
                        data: 'keterangan_penerimaan_po'
                    },
                    {
                        data: 'no_dtm'
                    },
                    {
                        data: 'hasil_akhir_tonase'
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
                    {
                        data: 'harga_berdasarkan_tempat'
                    },
                    {
                        data: 'harga_berdasarkan_harga_atas'
                    },
                    {
                        data: 'harga_awal'
                    },
                    {
                        data: 'aksi_harga'
                    },
                    {
                        data: 'reaksi_harga'
                    },
                    {
                        data: 'harga_akhir'
                    },
                    {
                        data: 'keterangan_harga_akhir_gb'
                    }
                ],
                createdRow: function(row, data, index) {

                    // Updated Schedule Week 1 - 07 Mar 22

                    if (data.name_bid == 'GABAH BASAH CIHERANG') {
                        $('td:eq(1)', row).css('color', '#000099'); //Original Date
                    } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                        $('td:eq(1)', row).css('color', '#009900'); // Behind of Original Date
                    } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                        $('td:eq(1)', row).css('color', '#330019'); // Behind of Original Date
                    }
                },
                "order": []
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                table3.columns.adjust().draw().responsive.recalc();
            })
            var table4 = $('#data_longgrain_approved').DataTable({
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
                "iDisplayLength": 25,
                ajax: {
                    url: "{{ route('qc.spv.output_lab2_gb_longgrain_approved_index') }}",
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
                        data: 'name_bid'
                    },
                    {
                        data: 'kode_po'
                    },
                    {
                        data: 'nama_vendor'
                    },
                    {
                        data: 'plat_kendaraan'
                    },
                    {
                        data: 'kategory_po'
                    },
                    {
                        data: 'status_lab2_gb'
                    },
                    {
                        data: 'waktu_approved',
                    },
                    {
                        data: 'tanggal_po'
                    },
                    {
                        data: 'tanggal_bongkar'
                    },
                    {
                        data: 'keterangan_penerimaan_po'
                    },
                    {
                        data: 'no_dtm'
                    },
                    {
                        data: 'lokasi_bongkar'
                    },
                    {
                        data: 'hasil_akhir_tonase'
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
                    {
                        data: 'harga_berdasarkan_tempat'
                    },
                    {
                        data: 'harga_berdasarkan_harga_atas'
                    },
                    {
                        data: 'harga_awal'
                    },
                    {
                        data: 'aksi_harga'
                    },
                    {
                        data: 'reaksi_harga'
                    },
                    {
                        data: 'harga_akhir'
                    },
                    {
                        data: 'keterangan_harga_akhir_gb'
                    }
                ],
                createdRow: function(row, data, index) {

                    // Updated Schedule Week 1 - 07 Mar 22

                    if (data.name_bid == 'GABAH BASAH CIHERANG') {
                        $('td:eq(1)', row).css('color', '#000099'); //Original Date
                    } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                        $('td:eq(1)', row).css('color', '#009900'); // Behind of Original Date
                    } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                        $('td:eq(1)', row).css('color', '#330019'); // Behind of Original Date
                    } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                        $('td:eq(1)', row).css('color', '#6666FF'); // Behind of Original Date
                    }
                },
                "order": []
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                table4.columns.adjust().draw().responsive.recalc();
            })
        }
        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            if (from_date != '' && to_date != '') {
                $('#data_longgrain').DataTable().destroy();
                $('#data_longgrain_approved').DataTable().destroy();
                $('#data_ciherang').DataTable().destroy();
                $('#data_pw').DataTable().destroy();
                $('#data_kp').DataTable().destroy();
                // table.ajax.reload(from_date, to_date);
                load_data(from_date, to_date);
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Sukses filter data',
                    icon: 'success',
                    timer: 1500
                });
            } else {
                Swal.fire({
                    title: 'Infoo!!',
                    text: 'Mohon Isikan data',
                    icon: 'warning',
                    timer: 1500
                });
            }

        });

        $('#refresh').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#data_longgrain').DataTable().destroy();
            $('#data_longgrain_approved').DataTable().destroy();
            $('#data_ciherang').DataTable().destroy();
            $('#data_pw').DataTable().destroy();
            $('#data_kp').DataTable().destroy();
            load_data();
        });
    });
</script>
<script type="text/javascript">
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
                    $('#form_updatehargaakhir').submit();
                    Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '#notif_swal_success', function(e) {
            $.ajax({
                type: "GET",
                url: "{{route('qc.spv.count_outputlab2_gb') }}",
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    console.log(data.count_success);
                    if (data.count_success >= 200) {

                        Swal.fire({
                            title: 'Data Limits 200 Row',
                            text: 'Harap Menggunakan Filter PO Untuk Mengetahui PO Terdahulu',
                            icon: 'warning',
                            // timer: 5000
                        })
                    }
                }
            })

        });
        $(document).on('click', '#btn_save_pk', function(e) {
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
                    $('#form_updatehargaakhir_pk').submit();
                    Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '.detail_hasil_qc', function() {
            var id = $(this).attr("name");
            var url = "{{ route('qc.lab.detail_output_incoming_qc') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    // console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#plan_harga').val(parsed.plan_harga);
                    console.log(parsed.bid_user_id);
                }
            });
        });
        $(document).on('click', '#btn_approved', function() {
            var id = $(this).data('id');
            var kode_po = $(this).data('kodepo');
            var harga_akhir = $(this).data('hargaakhir');
            var tonase = $(this).data('tonase_akhir');
            var tonase = $(this).data('tonase_akhir');
            var vendorid = $(this).data('vendorid');
            var kategory_po = $(this).data('kategory_po');
            // console.log(tonase);
            Swal.fire({
                title: 'Apakah Yakin Approve Data Ini',
                icon: 'warning',
                html: '<b>Kode PO :</b> ' +
                    kode_po + '<br>',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Approve',
                customClass: 'swal-wide',
                denyButtonText: 'Tolak Approve'
            }).then(function(result) {
                if (result.isConfirmed) {
                    if (tonase == '' || tonase == 'NULL') {
                        Swal.fire('Maaf', 'Tonnase Akhir Belum Di Input', 'warning')

                    } else {
                        if (vendorid == 'VBB20171' || vendorid == 'VBB20118' || vendorid == 'VBB20083' || vendorid == 'VBB20071' || vendorid == 'VBB20160') {
                            if (kategory_po == '' || kategory_po == null) {
                                Swal.fire('Maaf', 'Harus Pilih Kategori PO', 'warning')
                            } else {
                                Swal.fire({
                                    title: 'Harap Tuggu Sebentar!',
                                    html: 'Proses Menyimpan Data...', // add html attribute if you want or remove
                                    allowOutsideClick: false,
                                    onBeforeOpen: () => {
                                        Swal.showLoading()
                                        $.ajax({
                                            type: "GET",
                                            url: "{{route('qc.spv.approve_lab2_gb')}}/" + id,
                                            success: function(response) {
                                                Swal.fire('Sukses!', 'Data Anda Sudah Tersimpan', 'success', 1500)
                                                $('#data_ciherang').DataTable().ajax.reload();
                                                $('#data_longgrain').DataTable().ajax.reload();
                                                $('#data_longgrain_approved').DataTable().destroy();
                                                $('#data_pw').DataTable().ajax.reload();
                                                $('#data_kp').DataTable().ajax.reload();

                                            },
                                            error: function(response) {
                                                Swal.fire('Error', 'Cancel Proses Data', 'error')

                                            }
                                        });
                                    }
                                });
                            }
                        } else {
                            Swal.fire({
                                title: 'Harap Tuggu Sebentar!',
                                html: 'Proses Menyimpan Data...', // add html attribute if you want or remove
                                allowOutsideClick: false,
                                onBeforeOpen: () => {
                                    Swal.showLoading()
                                    $.ajax({
                                        type: "GET",
                                        url: "{{route('qc.spv.approve_lab2_gb')}}/" + id,
                                        success: function(response) {
                                            $('#data_ciherang').DataTable().ajax.reload();
                                            $('#data_longgrain').DataTable().ajax.reload();
                                            $('#data_longgrain_approved').DataTable().destroy();
                                            $('#data_pw').DataTable().ajax.reload();
                                            $('#data_kp').DataTable().ajax.reload();
                                            Swal.fire('Sukses!', 'Data Anda Sudah Tersimpan', 'success', 1500)

                                        },
                                        error: function(response) {
                                            Swal.fire('Error', 'Cancel Proses Data', 'error')

                                        }
                                    });
                                }
                            });
                        }
                    }
                } else if (result.isDenied) {
                    Swal.fire({
                        title: 'Harap Tuggu Sebentar!',
                        html: 'Proses Menyimpan Data...', // add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                            $.ajax({
                                type: "GET",
                                url: "{{route('qc.spv.tolak_approved')}}/" + id,
                                success: function(response) {
                                    Swal.fire('Sukses!', 'Data Anda Sudah Tersimpan', 'success', 1500)
                                    $('#data_ciherang').DataTable().ajax.reload();
                                    $('#data_pw').DataTable().ajax.reload();
                                    $('#data_longgrain').DataTable().ajax.reload();
                                    $('#data_longgrain_approved').DataTable().destroy();
                                    $('#data_kp').DataTable().ajax.reload();

                                },
                                error: function(response) {
                                    Swal.fire('Error', 'Cancel Proses Data', 'error')

                                }
                            });
                        }
                    });
                } else {
                    Swal.fire('Error', 'Cancel Proses Data', 'error')
                }
            });
        });
        $(document).on('click', '#btn_kategory', function() {
            var id = $(this).data('id');
            var kode_po = $(this).data('kodepo');
            var harga_akhir = $(this).data('hargaakhir');
            var tonase = $(this).data('tonase_akhir');
            // console.log(tonase);
            Swal.fire({
                title: 'Pilih Kategori PO',
                icon: 'warning',
                html: '<b>Kode PO :</b> ' +
                    kode_po + '<br>',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'REGULER',
                customClass: 'swal-wide',
                denyButtonText: 'BULOG'
            }).then(function(result) {
                if (result.isConfirmed) {
                    if (tonase == '' || tonase == 'NULL') {
                        Swal.fire('Maaf', 'Tonnase Akhir Belum Di Input', 'warning')
                    } else {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Proses Menyimpan Data...', // add html attribute if you want or remove
                            allowOutsideClick: false,

                            onBeforeOpen: () => {
                                Swal.showLoading()
                                $.ajax({
                                    type: "GET",
                                    url: "{{route('qc.spv.pilih_kategori_reguler')}}/" + id,
                                    success: function(response) {
                                        $('#data_ciherang').DataTable().ajax.reload();
                                        $('#data_longgrain').DataTable().ajax.reload();
                                        $('#data_longgrain_approved').DataTable().destroy();
                                        $('#data_pw').DataTable().ajax.reload();
                                        $('#data_kp').DataTable().ajax.reload();
                                    },
                                    complete: function() {
                                        Swal.fire('Sukses!', 'Data Anda Sudah Tersimpan', 'success', 1500);

                                    },
                                    error: function(response) {
                                        Swal.fire('Error', 'Cancel Proses Data', 'error')

                                    }
                                });

                            },
                        });
                    }

                } else if (result.isDenied) {
                    Swal.fire({
                        title: 'Harap Tuggu Sebentar!',
                        html: 'Proses Menyimpan Data...', // add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                            $.ajax({
                                type: "GET",
                                url: "{{route('qc.spv.pilih_kategori_bulog')}}/" + id,
                                success: function(response) {
                                    $('#data_ciherang').DataTable().ajax.reload();
                                    $('#data_pw').DataTable().ajax.reload();
                                    $('#data_longgrain').DataTable().ajax.reload();
                                    $('#data_longgrain_approved').DataTable().destroy();
                                    $('#data_kp').DataTable().ajax.reload();

                                },
                                complete: function() {
                                    Swal.fire('Sukses!', 'Data Anda Sudah Tersimpan', 'success', 1500);

                                },
                                error: function(response) {
                                    Swal.fire('Error', 'Cancel Proses Data', 'error')

                                }
                            });
                        }
                    });
                } else {
                    Swal.fire('Error', 'Cancel Proses Data', 'error')
                }
            });
        });
    });
</script>
<script type="text/javascript">
    // function cekAnalisa(that) {
    //     if (that.value == "tidak") {
    //          Swal.fire({
    //         position: 'top',
    //         icon: 'warning',
    //         title: 'Silahkan Input Harga Permintaan',
    //         showConfirmButton: true
    //       });

    //         document.getElementById("form_keterangan").style.display = "block";  
    //         document.getElementById("harga_akhir_permintaan_gb").focus();
    //     } else {
    //         document.getElementById("form_keterangan").style.display = "none";
    //     }
    // }

    function cekAdmin(that) {
        if (that.value == "1") {
            $('textarea[id=keterangan_analisa]').val('Nopol Tidak Sesuai');
        } else {
            $('textarea[id=keterangan_analisa]').val('');
        }
    }
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '.lokasi_bongkar', function() {
            var id = $(this).attr("name");
            var url = "{{ route('qc.lab.lokasi_bongkar') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#lokasi_bongkar').text(parsed.lokasi_bongkar);
                    $('#nomer_antrian').text(parsed.antrian);
                }
            });
        });
    });
</script>
@endsection