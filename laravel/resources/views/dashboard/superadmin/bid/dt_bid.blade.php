@extends('dashboard.superadmin.layout.main')
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
    @if(Auth::guard('sourching')->user()->level=='ADMIN')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet ">
                <div class="">
                    <!--begin::Accordion-->
                    <div class="accordion  accordion-toggle-arrow" id="accordionExample4">
                        <div class="card">
                            <div class="card-header" id="headingOne4">
                                <div class="card-title" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseOne4">
                                    <i class="flaticon2-add kt-font-primary"></i> Tambah E-Procurement
                                </div>
                            </div>
                            <div id="collapseOne4" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample4">
                                <div class="card-body">
                                    <form class="kt-form" id="kt_apps_user_add_user_form" action="{{ route('sourching.bid_store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-wizard-v4__form">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="kt-section__body">
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Kategori</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <!-- <input class="form-control" required name="name_bid" id="name_bid" placeholder="" type="text" value="BERAS PECAH KULIT" readonly> -->
                                                                        <select class="form-control selectpicker" onchange="cekDS(this);" id="name_bid" required name="name_bid" data-live-search="true">
                                                                            <option value="">Pilih Kategori...</option>
                                                                            <?php
                                                                            $item = App\Models\Item::all();
                                                                            ?>
                                                                            @foreach ($item as $item)
                                                                            <option value="{{$item->nama_item}}">{{$item->nama_item}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <div class="form-group" id="pilih" style="display: none;">
                                                                            <div class="kt-radio-inline col-lg-9 col-xl-9">
                                                                                <label class="kt-radio">
                                                                                    <input type="radio" value="1" id="urgent" class="form-control m-input" name="pilihan"> URGENT
                                                                                    <span></span>
                                                                                </label>
                                                                                <label class="kt-radio">
                                                                                    <input type="radio" value="2" id="noturgent" class="form-control m-input" name="pilihan"> NOT URGENT
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input class="form-control" required name="harga" value="0" readonly placeholder="" type="hidden">
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Kuota Lelang (Truk)</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input class="form-control" id="jumlah" maxlength="3" required name="jumlah" placeholder="...Truk" type="text">
                                                                        <!-- <select class="form-control m-input m-input--air" id="jumlah" required name="jumlah" required>
                                                                            <option selected disabled value="">Pilih Jumlah</option>
                                                                            <option value="240000">240.000 Kg -> Setara 30 Truk</option>
                                                                            <option value="400000">400.000 Kg -> Setara 50 Truk</option>
                                                                            <option value="640000">640.000 Kg -> Setara 80 Truk</option>
                                                                            <option value="800000">800.000 Kg -> Setara 100 Truk</option>
                                                                            <option value="1040000">1.040.000 Kg -> Setara 130 Truk</option>
                                                                        </select> -->
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Lokasi</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input class="form-control" required name="lokasi" placeholder="" type="text" value="NGAWI" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Tanggal PO</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input class="form-control" value="<?php echo date('Y-m-d', strtotime("+1 days")); ?>" required id="open_po" name="open_po" placeholder="" type="date">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Buka Penawaran</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input class="form-control" value="<?php echo date('Y-m-d'); ?>" required id="date_bid" name="date_bid" placeholder="" type="date">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Batas Penawaran</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input class="form-control" value="<?php echo date('Y-m-d', strtotime("+1 days")); ?>" required id="batas_bid" name="batas_bid" placeholder="" type="date">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Keterangan</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <textarea id="description_bid" name="description_bid" type="type" class="form-control m-input" placeholder="Type your description" rows="5" required=""></textarea>
                                                                    </div>
                                                                </div>
                                                                <!--<div class="form-group row">-->
                                                                <!--    <label class="col-xl-3 col-lg-3 col-form-label">Gambar</label>-->
                                                                <!--    <div class="col-lg-9 col-xl-9">-->
                                                                <!--        <input class="form-control" name="image_bid" id="image_bid" placeholder="" accept="image/*" type="file">-->
                                                                <!--        <img src="{{asset('img/no_image.png')}}" id="file_upload_bid" width="30%" alt="Preview Image">-->
                                                                <!--    </div>-->
                                                                <!--</div>-->

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-form__actions">
                                                    <button id="btn_save" type="submit" class="btn btn-success m-btn pull-right" style="">Submit</button>
                                                </div><br>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Accordion-->
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="flaticon2-list kt-font-primary"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data E-Procurement
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
                            <a class="nav-link active" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-database"></i>GABAH BASAH&nbsp;
                                <span id="count_bid_gb" class="badge badge badge-info" style=" max-width: max-content; text-align: left; background-color: green;">
                                </span>
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_2"><i class="la la-database"></i>BERAS PECAH KULIT&nbsp;
                                <span id="count_bid_pk" class="badge badge badge-info" style="margin-top: -15px; width: max-content; text-align: left; background-color: green;">
                                </span>
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_3"><i class="la la-database"></i>BERAS DS&nbsp;
                                <span id="count_bid_ds" class="badge badge badge-info" style="margin-top: -15px; width: max-content; text-align: left; background-color: green;">
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
                            <table class="table table-bordered" id="data_gb">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">No</th>
                                        <th style="text-align: center;width:15%">Gambar</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Status</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;List&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kuota&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Add&nbsp;Kuota</th>
                                        <th style="text-align: center;width:15%">Total&nbsp;Kuota</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tutup&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Mulai&nbsp;Pengajuan</th>
                                        <th style="text-align: center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_2" role="tabpanel">
                            <table class="table table-bordered" id="data_pk">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">No</th>
                                        <th style="text-align: center;width:15%">Gambar</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Status</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;List&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kuota&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Add&nbsp;Kuota</th>
                                        <th style="text-align: center;width:15%">Total&nbsp;Kuota</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tutup&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Mulai&nbsp;Pengajuan</th>
                                        <th style="text-align: center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
                            <table class="table table-bordered" id="data_ds">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">No</th>
                                        <th style="text-align: center;width:15%">Gambar</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Status</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;List&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kuota&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Add&nbsp;Kuota</th>
                                        <th style="text-align: center;width:15%">Total&nbsp;Kuota</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tutup&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Mulai&nbsp;Pengajuan</th>
                                        <th style="text-align: center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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

        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="kt_apps_user_update_user_form" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('sourching.bid_update') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Data Bid</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_bid" id="id_bid" value="">
                            <div class="form-group">
                                <div class="">
                                    <label>Nama Bid</label>
                                    <!-- <input class="form-control" required name="name_bid" id="name_bid" placeholder="" type="text" value="GABAH BASAH CIHERANG" readonly> -->
                                    <select class="form-control m-input m-input--air" id="name_bid1" required name="name_bid">
                                        <?php
                                        $item = App\Models\Item::all();
                                        ?>
                                        @foreach($item as $item)
                                        <option value="{{$item->nama_item}}">{{$item->nama_item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <input id="harga1" required name="harga" placeholder="Topic" type="hidden" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Kuota Lelang (Truk)</label>
                                    <input class="form-control" id="jumlah1" maxlength="3" required name="jumlah" placeholder="...Truk" type="text">
                                    <!-- <select class="form-control m-input m-input--air" id="jumlah1" required name="jumlah" required>
                                        <option disabled value="">Pilih Jumlah</option>
                                        <option value="240000">240.000 Kg -> Setara 30 Truk</option>
                                        <option value="400000">400.000 Kg -> Setara 50 Truk</option>
                                        <option value="640000">640.000 Kg -> Setara 80 Truk</option>
                                        <option value="800000">800.000 Kg -> Setara 100 Truk</option>
                                        <option value="1040000">1.040.000 Kg -> Setara 130 Truk</option>
                                    </select> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Site</label>
                                    <input name="lokasi" required id="lokasi1" readonly placeholder="" type="text" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Date Bid</label>
                                    <input id="date_bid1" required name="date_bid" readonly placeholder="" type="date" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Last Bid</label>
                                    <input id="batas_bid1" required name="batas_bid" readonly placeholder="" type="date" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Description</label>
                                    <textarea name="description_bid" required id="description_bid1" type="text" class="form-control m-input" placeholder="" rows="5" required=""></textarea>
                                </div>
                            </div>
                            <!--<div class="form-group">-->
                            <!--    <div class="">-->
                            <!--        <label>Gambar</label>-->
                            <!--        <input type="file" name="gambar_bid" required id="gambar_bid1" class="form-control m-input" accept="image/*" />-->
                            <!--        <img src='' id="file_bid" width="30%" alt="">-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                            <button id="btn_save1" type="submit" class="btn btn-success m-btn pull-right">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_addkuota" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="form_addkuota" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('sourching.add_kuota') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">ADD Kuota Tambahan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" id="id" value="">
                            <div class="form-group">
                                <select class="form-control selectpicker" id="add_kuota" required name="add_kuota" data-live-search="true">
                                    <option selected disabled value="">Pilih Add Kuota</option>
                                    <option value="8000">8.000 Kg -> Setara 1 Truk</option>
                                    <option value="16000">16.000 Kg -> Setara 2 Truk</option>
                                    <option value="24000">24.000 Kg -> Setara 3 Truk</option>
                                    <option value="32000">32.000 Kg -> Setara 4 Truk</option>
                                    <option value="40000">40.000 Kg -> Setara 5 Truk</option>
                                    <option value="48000">48.000 Kg -> Setara 6 Truk</option>
                                    <option value="56000">56.000 Kg -> Setara 7 Truk</option>
                                    <option value="64000">64.000 Kg -> Setara 8 Truk</option>
                                    <option value="72000">72.000 Kg -> Setara 9 Truk</option>
                                    <option value="80000">80.000 Kg -> Setara 10 Truk</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button id="btn_saveaddkuota" class="btn btn-success m-btn pull-right">Save</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @elseif(Auth::guard('sourching')->user()->level=='MANAGER')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="flaticon2-list kt-font-success"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data E-Procurement
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
                            <a class="nav-link active" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-database"></i>GABAH BASAH&nbsp;
                                <span id="count_bid_gb" class="badge badge badge-info" style=" max-width: max-content; text-align: left; background-color: green;">
                                </span>
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_2"><i class="la la-database"></i>BERAS PECAH KULIT&nbsp;
                                <span id="count_bid_pk" class="badge badge badge-info" style="margin-top: -15px; width: max-content; text-align: left; background-color: green;">
                                </span>
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_3"><i class="la la-database"></i>BERAS DS&nbsp;
                                <span id="count_bid_ds" class="badge badge badge-info" style="margin-top: -15px; width: max-content; text-align: left; background-color: green;">
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
                            <table class="table table-bordered" id="data_gb1">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">No</th>
                                        <th style="text-align: center;width:15%">Gambar</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Status</th>
                                        <th style="text-align: center;width:15%">Pengajuan</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;List&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kuota&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Add&nbsp;Kuota</th>
                                        <th style="text-align: center;width:15%">Total&nbsp;Kuota</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tutup&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Mulai&nbsp;Pengajuan</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_2" role="tabpanel">
                            <table class="table table-bordered" id="data_pk1">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">No</th>
                                        <th style="text-align: center;width:15%">Gambar</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Status</th>
                                        <th style="text-align: center;width:15%">Pengajuan</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;List&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kuota&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Add&nbsp;Kuota</th>
                                        <th style="text-align: center;width:15%">Total&nbsp;Kuota</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tutup&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Mulai&nbsp;Pengajuan</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
                            <table class="table table-bordered" id="data_ds1">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">No</th>
                                        <th style="text-align: center;width:15%">Gambar</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Status</th>
                                        <th style="text-align: center;width:15%">Pengajuan</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;List&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kuota&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Add&nbsp;Kuota</th>
                                        <th style="text-align: center;width:15%">Total&nbsp;Kuota</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tutup&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Mulai&nbsp;Pengajuan</th>
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

        <div class="modal fade" id="modal_addkuota" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="form_addkuota" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('sourching.add_kuota') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">ADD Kuota Tambahan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" id="id" value="">
                            <div class="form-group">
                                <select class="form-control selectpicker" id="add_kuota" required name="add_kuota" data-live-search="true">
                                    <option selected disabled value="">Pilih Add Kuota</option>
                                    <option value="8000">8.000 Kg -> Setara 1 Truk</option>
                                    <option value="40000">40.000 Kg -> Setara 5 Truk</option>
                                    <option value="80000">80.000 Kg -> Setara 10 Truk</option>
                                    <option value="120000">120.000 Kg -> Setara 15 Truk</option>
                                    <option value="160000">160.000 Kg -> Setara 20 Truk</option>
                                    <option value="200000">200.000 Kg -> Setara 25 Truk</option>
                                    <option value="240000">240.000 Kg -> Setara 30 Truk</option>
                                    <option value="280000">280.000 Kg -> Setara 35 Truk</option>
                                    <option value="320000">320.000 Kg -> Setara 40 Truk</option>
                                    <option value="360000">360.000 Kg -> Setara 45 Truk</option>
                                    <option value="400000">400.000 Kg -> Setara 50 Truk</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button id="btn_saveaddkuota" class="btn btn-success m-btn pull-right">Save</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
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
            var table1 = $('#data_gb').DataTable({
                "scrollY": true,
                "scrollX": true,
                processing: true,
                serverSide: true,
                "aLengthMenu": [
                    [25, 100, 300, -1],
                    [25, 100, 300, "All"]
                ],
                pageLength: 25,
                ajax: {
                    url: "{{ route('sourching.bid_gb_index') }}",
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
                        data: 'image_bid'
                    },
                    {
                        data: 'name_bid'
                    },
                    {
                        data: 'batas_bid'
                    },
                    {
                        data: 'list_po'
                    },
                    {
                        data: 'kuota'
                    },
                    {
                        data: 'kuota_tambahan'
                    },
                    {
                        data: 'total_kuota'
                    },
                    {
                        data: 'open_po'
                    },
                    {
                        data: 'close_po'
                    },
                    {
                        data: 'start_pengajuan'
                    },
                    {
                        data: 'ckelola'
                    }


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
                table1.columns.adjust().draw().responsive.recalc();
            })
            var table2 = $('#data_pk').DataTable({
                "scrollY": true,
                "scrollX": true,
                processing: true,
                serverSide: true,
                "aLengthMenu": [
                    [25, 100, 300, -1],
                    [25, 100, 300, "All"]
                ],
                "iDisplayLength": 10,
                ajax: {
                    url: "{{ route('sourching.bid_pk_index') }}",
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
                        data: 'image_bid'
                    },
                    {
                        data: 'name_bid'
                    },
                    {
                        data: 'batas_bid'
                    },
                    {
                        data: 'list_po'
                    },
                    {
                        data: 'kuota'
                    },
                    {
                        data: 'kuota_tambahan'
                    },
                    {
                        data: 'total_kuota'
                    },
                    {
                        data: 'open_po'
                    },
                    {
                        data: 'close_po'
                    },
                    {
                        data: 'start_pengajuan'
                    },
                    {
                        data: 'ckelola'
                    }


                ],
                createdRow: function(row, data, index) {

                    // Updated Schedule Week 1 - 07 Mar 22

                    if (data.name_bid == 'GABAH BASAH CIHERANG') {
                        $('td:eq(2)', row).css('color', '#000099'); //Original Date
                    } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                        $('td:eq(2)', row).css('color', '#009900'); // Behind of Original Date
                    } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                        $('td:eq(2)', row).css('color', '#330019'); // Behind of Original Date
                    }
                },
                "order": []
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                table2.columns.adjust().draw().responsive.recalc();
            })
            var table3 = $('#data_ds').DataTable({
                "scrollY": true,
                "scrollX": true,
                processing: true,
                serverSide: true,
                "aLengthMenu": [
                    [25, 100, 300, -1],
                    [25, 100, 300, "All"]
                ],
                "iDisplayLength": 10,
                ajax: {
                    url: "{{ route('sourching.bid_ds_index') }}",
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
                        data: 'image_bid'
                    },
                    {
                        data: 'name_bid'
                    },
                    {
                        data: 'batas_bid'
                    },
                    {
                        data: 'list_po'
                    },
                    {
                        data: 'kuota'
                    },
                    {
                        data: 'kuota_tambahan'
                    },
                    {
                        data: 'total_kuota'
                    },
                    {
                        data: 'open_po'
                    },
                    {
                        data: 'close_po'
                    },
                    {
                        data: 'start_pengajuan'
                    },
                    {
                        data: 'ckelola'
                    }


                ],
                createdRow: function(row, data, index) {

                    // Updated Schedule Week 1 - 07 Mar 22

                    if (data.name_bid == 'GABAH BASAH CIHERANG') {
                        $('td:eq(2)', row).css('color', '#000099'); //Original Date
                    } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                        $('td:eq(2)', row).css('color', '#009900'); // Behind of Original Date
                    } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                        $('td:eq(2)', row).css('color', '#330019'); // Behind of Original Date
                    }
                },
                "order": []
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                table3.columns.adjust().draw().responsive.recalc();
            })
            var table4 = $('#data_gb1').DataTable({
                "scrollY": true,
                "scrollX": true,
                processing: true,
                serverSide: true,
                "aLengthMenu": [
                    [25, 100, 300, -1],
                    [25, 100, 300, "All"]
                ],
                "iDisplayLength": 10,
                ajax: {
                    url: "{{ route('sourching.bid_gb_index') }}",
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
                        data: 'image_bid'
                    },
                    {
                        data: 'name_bid'
                    },
                    {
                        data: 'batas_bid'
                    },

                    {
                        data: 'response'
                    },
                    {
                        data: 'list_po'
                    },
                    {
                        data: 'kuota'
                    },
                    {
                        data: 'kuota_tambahan'
                    },
                    {
                        data: 'total_kuota'
                    },
                    {
                        data: 'open_po'
                    },
                    {
                        data: 'close_po'
                    },
                    {
                        data: 'start_pengajuan'
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

            var table5 = $('#data_pk1').DataTable({
                "scrollY": true,
                "scrollX": true,
                processing: true,
                serverSide: true,
                "aLengthMenu": [
                    [25, 100, 300, -1],
                    [25, 100, 300, "All"]
                ],
                "iDisplayLength": 10,
                ajax: {
                    url: "{{ route('sourching.bid_pk_index') }}",
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
                        data: 'image_bid'
                    },
                    {
                        data: 'name_bid'
                    },
                    {
                        data: 'batas_bid'
                    },

                    {
                        data: 'response'
                    },
                    {
                        data: 'list_po'
                    },
                    {
                        data: 'kuota'
                    },
                    {
                        data: 'kuota_tambahan'
                    },
                    {
                        data: 'total_kuota'
                    },
                    {
                        data: 'open_po'
                    },
                    {
                        data: 'close_po'
                    },
                    {
                        data: 'start_pengajuan'
                    },

                ],
                "order": []
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                table5.columns.adjust().draw().responsive.recalc();
            })
            var table6 = $('#data_ds1').DataTable({
                "scrollY": true,
                "scrollX": true,
                processing: true,
                serverSide: true,
                "aLengthMenu": [
                    [25, 100, 300, -1],
                    [25, 100, 300, "All"]
                ],
                "iDisplayLength": 10,
                ajax: {
                    url: "{{ route('sourching.bid_ds_index') }}",
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
                        data: 'image_bid'
                    },
                    {
                        data: 'name_bid'
                    },
                    {
                        data: 'batas_bid'
                    },

                    {
                        data: 'response'
                    },
                    {
                        data: 'list_po'
                    },
                    {
                        data: 'kuota'
                    },
                    {
                        data: 'kuota_tambahan'
                    },
                    {
                        data: 'total_kuota'
                    },
                    {
                        data: 'open_po'
                    },
                    {
                        data: 'close_po'
                    },
                    {
                        data: 'start_pengajuan'
                    },

                ],
                "order": []
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                table6.columns.adjust().draw().responsive.recalc();
            })
            // setInterval(function() {
            //     table1.ajax.reload();
            // }, 3000);
            // setInterval(function() {
            //     table2.ajax.reload();
            // }, 3000);
            // setInterval(function() {
            //     table3.ajax.reload();
            // }, 3000);
            // setInterval(function() {
            //     table4.ajax.reload();
            // }, 3000);
            // setInterval(function() {
            //     table5.ajax.reload();
            // }, 3000);
            // setInterval(function() {
            //     table6.ajax.reload();
            // }, 3000);

        }
        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            if (from_date != '' && to_date != '') {
                $('#data_gb').DataTable().destroy();
                $('#data_pk').DataTable().destroy();
                $('#data_ds').DataTable().destroy();
                $('#data_gb1').DataTable().destroy();
                $('#data_pk1').DataTable().destroy();
                $('#data_ds1').DataTable().destroy();
                // table.ajax.reload(from_date, to_date);
                load_data(from_date, to_date);
                Swal.fire('Berhasil', 'Sukses filter data', 'success');
            } else {
                Swal.fire('Infoo!!', 'Mohon Isikan data', 'warning');
            }

        });

        $('#refresh').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#data_gb').DataTable().destroy();
            $('#data_pk').DataTable().destroy();
            $('#data_ds').DataTable().destroy();
            $('#data_gb1').DataTable().destroy();
            $('#data_pk1').DataTable().destroy();
            $('#data_ds1').DataTable().destroy();
            load_data();
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    function cekDS(that) {
        if (that.value == "BERAS DS") {
            document.getElementById("pilih").style.display = "block";
        } else {
            document.getElementById("pilih").style.display = "none";
        }
    }
    $(function() {
        $('#image_bid').change(function() {

            let reader = new FileReader();
            // console.log(reader);
            reader.onload = (e) => {

                $('#file_upload_bid').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });
        $(document).on('click', '#btn_coba', function(e) {
            Swal.fire({
                title: 'Please Wait !',
                html: 'data uploading', // add html attribute if you want or remove
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
            $('#kt_apps_user_add_user_form').submit();
        });
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
                    if ($('#name_bid').val() == '' || $('#jumlah').val() == '' || $('#open_po').val() == '' || $('#description_bid').val() == '' || $('#batas_bid').val() == '') {
                        Swal.fire('Gagal!', 'Data Harus Terisi.', 'error')
                    } else {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Data Uploading...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            },
                        });
                        $('#kt_apps_user_add_user_form').submit();

                        // Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                    }
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
                    if ($('#name_bid1').val() == '' || $('#jumlah1').val() == '' || $('#description_bid1').val() == '' || $('#batas_bid1').val() == '' || $('#date_bid1').val() == '') {
                        Swal.fire('Gagal!', 'Data Harus Terisi.', 'error')

                    } else {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Data Uploading...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            },
                        });
                        $('#kt_apps_user_update_user_form').submit();

                    }

                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '#btn_saveaddkuota', function(e) {
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
                    if ($('#add_kuota').val() == '') {
                        Swal.fire('Gagal!', 'Data Harus Terisi.', 'error')

                    } else {
                        $('#form_addkuota').submit();
                        Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                    }

                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });

        $('body').on('click', '#btn_delete', function() {
            var cek = $(this).data('bidid');
            // console.log(cek);
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Kamu tidak dapat mengembalikan data ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        title: 'Harap Tuggu Sebentar!',
                        html: 'Proses Input Data...', // add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                            $.ajax({
                                url: "{{url('sourching/bid_destroy')}}/" + cek,
                                type: "GET",
                                error: function() {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: 'Gagal Hapus Data.',
                                        icon: 'error',
                                        timer: 1500
                                    })
                                },
                                success: function(data) {
                                    Swal.fire({
                                        title: 'Terhapus!',
                                        text: 'Data anda berhasil di hapus.',
                                        icon: 'success',
                                        timer: 1500
                                    })
                                    $('#data_gb').DataTable().ajax.reload();
                                    $('#data_gb1').DataTable().ajax.reload();
                                    $('#data_pk').DataTable().ajax.reload();
                                    $('#data_pk1').DataTable().ajax.reload();
                                    $('#data_ds').DataTable().ajax.reload();
                                    $('#data_ds1').DataTable().ajax.reload();
                                }
                            });
                        },
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });

        });
        $('body').on('click', '#btn_delete_kuota', function() {
            var cek = $(this).data('id');
            // console.log(cek);
            $.ajax({
                url: "{{route('sourching.delete_add_kuota')}}/" + cek,
                type: "GET",
                error: function() {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Gagal Hapus Kuota.',
                        icon: 'error',
                        timer: 1500
                    })
                },
                success: function(data) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Berhasil Hapus Kuota.',
                        icon: 'success',
                        timer: 1500
                    })
                    $('#data_gb').DataTable().ajax.reload();
                    $('#data_gb1').DataTable().ajax.reload();
                    $('#data_pk').DataTable().ajax.reload();
                    $('#data_pk1').DataTable().ajax.reload();
                    $('#data_ds').DataTable().ajax.reload();
                    $('#data_ds1').DataTable().ajax.reload();
                }
            });

        });
        $('body').on('click', '#btn_status', function() {
            var cek = $(this).data('id');
            // console.log(cek);
            $.ajax({
                url: "{{url('sourching/bid_status')}}/" + cek,
                type: "GET",
                error: function() {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Gagal Update Status.',
                        icon: 'error',
                        timer: 1500
                    })
                },
                success: function(data) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Berhasil Update Status.',
                        icon: 'success',
                        timer: 1500
                    })
                    $('#data_gb').DataTable().ajax.reload();
                    $('#data_gb1').DataTable().ajax.reload();
                    $('#data_pk').DataTable().ajax.reload();
                    $('#data_pk1').DataTable().ajax.reload();
                    $('#data_ds').DataTable().ajax.reload();
                    $('#data_ds1').DataTable().ajax.reload();
                }
            });

        });
        $('body').on('click', '#btn_status1', function() {

            Swal.fire({
                title: 'Gagal!',
                text: 'Waktu Lelang Sudah Berakhir.',
                icon: 'error',
                timer: 1500
            })
            $('#data_gb').DataTable().ajax.reload();
            $('#data_gb1').DataTable().ajax.reload();
            $('#data_pk').DataTable().ajax.reload();
            $('#data_pk1').DataTable().ajax.reload();
            $('#data_ds').DataTable().ajax.reload();
            $('#data_ds1').DataTable().ajax.reload();
        });
        $(document).on('click', '.toedit', function() {
            var id = $(this).data('bidid');
            var date_bid = $(this).data('datebid');
            var lokasi = $(this).data('lokasi');
            var nama = $(this).data('nama');
            var harga = $(this).data('harga');
            var jumlah = $(this).data('jumlah');
            var datebid = $(this).data('datebid');
            var batasbid = $(this).data('lastbid');
            var description = $(this).data('description');
            var hasil_jml = (jumlah / 8000);
            var image_bid = $(this).data('image');
            // console.log(image_bid);
            $('input[id=id_bid]').val(id);
            $('select[id=name_bid1]').val(nama);
            $('input[id=harga1]').val(harga);
            $('input[id=jumlah1]').val(hasil_jml);
            $('input[id=lokasi1]').val(lokasi);
            $('input[id=date_bid1]').val(date_bid);
            $('input[id=batas_bid1]').val(batasbid);
            $('textarea[id=description_bid1]').val(description);
        });
        $('#gambar_bid1').change(function() {

            let reader = new FileReader();
            // console.log(reader);
            reader.onload = (e) => {

                $('#file_bid').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });
        $(document).on('click', '#btn_addkuota', function() {
            var id = $(this).data('id');
            var add_kuota = $(this).data('add_kuota');
            $('input[id=id]').val(id);
            $('select[id=add_kuota]').val(add_kuota);
            $('#modal_addkuota').modal('show');
        });
        $(document).on('click', '#btn_addkuota1', function() {
            Swal.fire({
                title: 'Maaf!',
                text: 'Waktu Lelang Sudah Berakhir.',
                icon: 'warning',
                timer: 1500
            })
        });
        $(document).on('click', '#btn_addkuota2', function() {
            Swal.fire({
                title: 'Maaf!',
                text: 'Status PO Close.',
                icon: 'warning',
                timer: 1500
            })
        });
        $(document).on('keyup', '#jumlah', function(e) {
            var data = $(this).val();
            var hasil = formatRupiah(data, "Rp. ");
            $(this).val(hasil);
        });
        $(document).on('keyup', '#jumlah1', function(e) {
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

    });

    function getcount_bid() {
        $.ajax({
            type: "GET",
            url: "{{route('sourching.getcount_bid')}}",
            success: function(data) {
                // console.log(data);
                $("#count_bid_gb").empty();
                $("#count_bid_pk").empty();
                $("#count_bid_ds").empty();
                $("#count_bid_gb").html(data.getcount_bid_gb);
                $("#count_bid_pk").html(data.getcount_bid_pk);
                $("#count_bid_ds").html(data.getcount_bid_ds);
            }
        });
    }

    setInterval(getcount_bid, 2000);
</script>
@endsection