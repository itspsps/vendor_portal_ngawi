@extends('dashboard.admin_qc_bongkar.layout.main')
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
                        Proses Bongkar
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
                            <i class="kt-menu__link-icon flaticon2-open-box kt-font-info"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data Bongkar
                        </h3>
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
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_5"><i class="la la-database"></i>BERAS PK</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
                            <table class="table table-bordered" id="data_longgrain">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Jam&nbsp;Kedatangan</th>
                                        <th style="text-align: center;width:18%">Antrian</th>
                                        <th style="text-align: center;width:auto">Status</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Action</th>
                                        <th style="text-align: center;width:auto">KA</th>
                                        <th style="text-align: center;width:auto">KS</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Awal&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Awal&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Akhir&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;PK</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Beras</th>
                                        <th style="text-align: center;width:auto">WH</th>
                                        <th style="text-align: center;width:auto">TP</th>
                                        <th style="text-align: center;width:auto">MD</th>
                                        <th style="text-align: center;width:auto">Broken</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="tab-pane" id="m_tabs_3_2" role="tabpanel">
                            <table class="table table-bordered" id="data_ciherang">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Jam&nbsp;Kedatangan</th>
                                        <th style="text-align: center;width:18%">Antrian</th>
                                        <th style="text-align: center;width:auto">Status</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Action</th>
                                        <th style="text-align: center;width:auto">KA</th>
                                        <th style="text-align: center;width:auto">KS</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Awal&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Awal&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Akhir&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;PK</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Beras</th>
                                        <th style="text-align: center;width:auto">WH</th>
                                        <th style="text-align: center;width:auto">TP</th>
                                        <th style="text-align: center;width:auto">MD</th>
                                        <th style="text-align: center;width:auto">Broken</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div> -->
                        <div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
                            <table class="table table-bordered" id="data_pw">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Jam&nbsp;Kedatangan</th>
                                        <th style="text-align: center;width:18%">Antrian</th>
                                        <th style="text-align: center;width:auto">Status</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Action</th>
                                        <th style="text-align: center;width:auto">KA</th>
                                        <th style="text-align: center;width:auto">KS</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Awal&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Awal&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Akhir&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;PK</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Beras</th>
                                        <th style="text-align: center;width:auto">WH</th>
                                        <th style="text-align: center;width:auto">TP</th>
                                        <th style="text-align: center;width:auto">MD</th>
                                        <th style="text-align: center;width:auto">Broken</th>
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
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Jam&nbsp;Kedatangan</th>
                                        <th style="text-align: center;width:18%">Antrian</th>
                                        <th style="text-align: center;width:auto">Status</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">Action</th>
                                        <th style="text-align: center;width:auto">KA</th>
                                        <th style="text-align: center;width:auto">KS</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Awal&nbsp;KS</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Awal&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Akhir&nbsp;KG</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;PK</th>
                                        <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Beras</th>
                                        <th style="text-align: center;width:auto">WH</th>
                                        <th style="text-align: center;width:auto">TP</th>
                                        <th style="text-align: center;width:auto">MD</th>
                                        <th style="text-align: center;width:auto">Broken</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_5" role="tabpanel">
                            <table class="table table-bordered" id="datatable2">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">&nbsp;Nama&nbsp;Item&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;Jam&nbsp;Kedatangan&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;KA&nbsp;&nbsp;&nbsp;</th>

                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;PK&nbsp;Bersih&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Beras&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;Butir&nbsp;Patah&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;Hampa&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;Katul&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;WH&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;TR&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;MD&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Harga&nbsp;&nbsp;&nbsp;</th>
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

        <div class="modal fade" id="modal_qc_bongkar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="formantrian_bongkar" class="m-form m-form--fit m-form--label-align-right" method="post" action="javascript:void(0);" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Input Proses Bongkar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_penerimaan_po" id="id_penerimaan_po" value="">
                            <input type="hidden" name="item" id="item" value="PK">
                            <div class="form-group">
                                <div class="">
                                    <label>Reception Time</label>
                                    <input id="harga" name="waktu_penerimaan" readonly value="{{date('Y-m-d H:i:s')}}" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Nama Item</label>
                                    <input id="name_bid" readonly name="name_bid" type="text" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Kode PO</label>
                                    <input id="penerimaan_kode_po" readonly name="penerimaan_kode_po" type="text" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Nopol</label>
                                    <input name="plat_kendaraan" readonly id="plat_kendaraan" type="text" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Asal Pengirim</label>
                                    <input name="asal_pengirim" readonly required type="text" id="asal_pengirim" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>No. DTM</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">BKS.NGW</span>
                                    </div>
                                    <input type="text" id="no_dtm" name="no_dtm" class="form-control" placeholder="" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Surveyor</label>
                                    <!--<input name="surveyor"  required type="text" id="asal_pengirim" class="form-control m-input">-->
                                    <div class="dropdown show">
                                        <div>
                                            <select class="form-control kt-select2 selectpicker" name="surveyor_bongkar" id="surveyor_bongkar" data-live-search="true">
                                                <option selected disabled value="">Pilih Surveyor</option>
                                                @foreach($data as $data)
                                                <option value="{{$data->nama_surveyor}}">{{$data->nama_surveyor}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Keterangan</label>
                                    <input name="keterangan" required type="text" id="keterangan" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Waktu</label>
                                    <select class="form-select form-control m-input" name="waktu_bongkar" id="waktu_bongkar" aria-label="Default select example">
                                        <option value="" selected>--Pilih Waktu--</option>
                                        <option value="1A">1A</option>
                                        <option value="2A">2A</option>
                                        <option value="3A">3A</option>
                                        <option value="1B">1B</option>
                                        <option value="2B">2B</option>
                                        <option value="3B">3B</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Lokasi Bongkar</label>
                                    <select class="form-select form-control m-input" name="tempat_bongkar" id="tempat_bongkar" aria-label="Default select example">
                                        <option value="" selected>--Pilih Lokasi Bongkar--</option>
                                        <option value="UTARA">UTARA</option>
                                        <option value="SELATAN">SELATAN</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Karung dibawa</label>
                                    <input name="z_yang_dibawa" min="0" required="required" type="text" id="z_yang_dibawa" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Karung ditolak</label>
                                    <input name="z_yang_ditolak" value="0" required="required" type="text" id="z_yang_ditolak" class="form-control m-input">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                            <button id="btn_save" class="btn btn-success m-btn pull-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_qc_bongkar_pk" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="formantrian_bongkar_pk" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{route('qc.bongkar.update_qc_bongkar')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Input Proses Bongkar PK</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_penerimaan_po" id="id_penerimaan_po_pk" value="">
                            <input type="hidden" name="item" id="item" value="PK">
                            <div class="form-group">
                                <div class="">
                                    <label>Reception Time</label>
                                    <input id="waktu_penerimaan_pk" name="waktu_penerimaan" readonly value="{{date('Y-m-d H:i:s')}}" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Nama Item</label>
                                    <input id="name_bid_pk" readonly name="name_bid" type="text" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Kode PO</label>
                                    <input id="penerimaan_kode_po_pk" readonly name="penerimaan_kode_po" type="text" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Nopol</label>
                                    <input name="plat_kendaraan" readonly id="plat_kendaraan_pk" type="text" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Asal Pengirim</label>
                                    <input name="asal_pengirim" readonly required type="text" id="asal_pengirim_pk" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>No. DTM</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">BKS.NGW</span>
                                    </div>
                                    <input type="text" id="no_dtm_pk" name="no_dtm" class="form-control" placeholder="" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Surveyor</label>
                                    <!--<input name="surveyor"  required type="text" id="asal_pengirim" class="form-control m-input">-->
                                    <div class="dropdown show">
                                        <div>
                                            <select class="form-control kt-select2 selectpicker" name="surveyor_bongkar" id="surveyor_bongkar_pk" data-live-search="true">
                                                <option selected disabled value="">Pilih Surveyor</option>
                                                @foreach($data1 as $data1)
                                                <option value="{{$data1->nama_surveyor}}">{{$data1->nama_surveyor}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Keterangan</label>
                                    <input name="keterangan" required type="text" id="keterangan_pk" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Waktu</label>
                                    <select class="form-select form-control m-input" name="waktu_bongkar" id="waktu_bongkar_pk" aria-label="Default select example">
                                        <option value="" selected>--Pilih Waktu--</option>
                                        <option value="1A">1A</option>
                                        <option value="2A">2A</option>
                                        <option value="3A">3A</option>
                                        <option value="1B">1B</option>
                                        <option value="2B">2B</option>
                                        <option value="3B">3B</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Lokasi Bongkar</label>
                                    <input type="text" name="tempat_bongkar" id="tempat_bongkar_pk" class="form-control m-input" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Karung dibawa</label>
                                    <input name="z_yang_dibawa" min="0" required="required" type="text" id="z_yang_dibawa_pk" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Karung ditolak</label>
                                    <input name="z_yang_ditolak" value="0" required="required" type="text" id="z_yang_ditolak_pk" class="form-control m-input">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                            <button id="btn_save_pk" class="btn btn-success m-btn pull-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Content -->
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(function() {
        $('.selectpicker').selectpicker();
    });
</script>
<script>
    $(function() {
        var table = $('#data_longgrain').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('qc.bongkar.antrian_qc_longgrain_index') }}",
            columns: [{
                    data: "id_admin_timbangan",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name_bid'
                },
                {
                    data: 'nama_vendor'
                },
                {
                    data: 'waktu_penerimaan'
                },
                {
                    data: 'no_antrian'
                },
                {
                    data: 'status'
                },
                {
                    data: 'plat_kendaraan'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'kode_po'
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
                    data: 'randoman'
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
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('qc.bongkar.antrian_qc_pandan_wangi_index') }}",
            columns: [{
                    data: "id_admin_timbangan",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name_bid'
                },
                {
                    data: 'nama_vendor'
                },
                {
                    data: 'waktu_penerimaan'
                },
                {
                    data: 'no_antrian'
                },
                {
                    data: 'status'
                },
                {
                    data: 'plat_kendaraan'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'kode_po'
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
                    data: 'randoman'
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
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('qc.bongkar.antrian_qc_ketan_putih_index') }}",
            columns: [{
                    data: "id_admin_timbangan",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name_bid'
                },
                {
                    data: 'nama_vendor'
                },
                {
                    data: 'waktu_penerimaan'
                },
                {
                    data: 'no_antrian'
                },
                {
                    data: 'status'
                },
                {
                    data: 'plat_kendaraan'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'kode_po'
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
                    data: 'randoman'
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
    });
</script>
<script>
    $(function() {
        var table = $('#datatable2').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('qc.bongkar.antrian_qc_bongkar_pk_index') }}",
            columns: [{
                    data: "id_admin_timbangan",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name_bid'
                },
                {
                    data: 'nama_vendor'
                },
                {
                    data: 'waktu_penerimaan'
                },
                {
                    data: 'status'
                },
                {
                    data: 'plat_kendaraan'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'kode_po'
                },
                {
                    data: 'ckelola'
                },
                {
                    data: 'ka_pk'
                },
                {
                    data: 'pk_pk'
                },
                {
                    data: 'pk_bersih_pk'
                },
                {
                    data: 'beras_pk'
                },
                {
                    data: 'butir_patah_pk'
                },
                {
                    data: 'hampa_pk'
                },
                {
                    data: 'katul_pk'
                },
                {
                    data: 'wh_pk'
                },
                {
                    data: 'tr_pk'
                },
                {
                    data: 'md_pk'
                },
                {
                    data: 'harga'
                },

            ],
            "order": []
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '#btn_save', function(e) {
            e.preventDefault();
            var name_bid = $('#name_bid').val();
            var penerimaan_kode_po = $('#penerimaan_kode_po').val();
            var no_dtm = $('#no_dtm').val();
            var surveyor_bongkar = $('#surveyor_bongkar').val();
            var keterangan = $('#keterangan').val();
            var waktu_bongkar = $('#waktu_bongkar').val();
            var tempat_bongkar = $('#tempat_bongkar').val();
            var z_yang_dibawa = $('#z_yang_dibawa').val();
            var z_yang_ditolak = $('#z_yang_ditolak').val();
            Swal.fire({
                title: 'Harap Tuggu Sebentar!',
                html: 'Analisa Data Double', // add html attribute if you want or remove
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    $.ajax({
                        data: {
                            kode_po: penerimaan_kode_po,
                        },
                        url: "{{ route('qc.bongkar.check_input_bongkar') }}",
                        type: "GET",
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            if (data == 'double') {
                                Swal.fire({
                                    title: 'Maaf, Anda Tidak Bisa Input',
                                    text: 'Data Sudah Tersedia',
                                    icon: 'warning',
                                    allowOutsideClick: false
                                })
                            } else {
                                Swal.fire({
                                    title: 'Konfirmasi',
                                    icon: 'warning',
                                    text: "Apakah data yang kamu input sudah benar ?",
                                    showCancelButton: true,
                                    inputValue: 0,
                                    confirmButtonText: 'Yes',
                                }).then(function(result) {
                                    if ($('#z_yang_dibawa').val() == '' | $('#z_yang_ditolak').val() == '' | $('#keterangan').val() == '' | $('#no_dtm').val() == '' | $('#waktu_bongkar').val() == '' | $('#tempat_bongkar').val() == '') {
                                        Swal.fire({
                                            title: 'Maaf!!',
                                            text: 'Data Harus Diisi Semua',
                                            icon: 'warning',
                                            timer: 1500
                                        })
                                    } else if ($('#surveyor_bongkar').val() == 'NULL' | $('#surveyor_bongkar').val() == '') {
                                        Swal.fire({
                                            title: 'Maaf!!',
                                            text: 'Data Harus Diisi Semua',
                                            icon: 'warning',
                                            timer: 1500
                                        })
                                    } else {
                                        if (result.value) {
                                            Swal.fire({
                                                title: 'Harap Tuggu Sebentar!',
                                                html: 'Proses Menyimpan Data...', // add html attribute if you want or remove
                                                allowOutsideClick: false,
                                                onBeforeOpen: () => {
                                                    Swal.showLoading()
                                                    $.ajax({
                                                        data: {
                                                            "_token": "{{ csrf_token() }}",
                                                            name_bid: name_bid,
                                                            penerimaan_kode_po: penerimaan_kode_po,
                                                            no_dtm: no_dtm,
                                                            surveyor_bongkar: surveyor_bongkar,
                                                            keterangan: keterangan,
                                                            waktu_bongkar: waktu_bongkar,
                                                            tempat_bongkar: tempat_bongkar,
                                                            z_yang_dibawa: z_yang_dibawa,
                                                            z_yang_ditolak: z_yang_ditolak,
                                                        },
                                                        url: "{{route('qc.bongkar.update_qc_bongkar')}}",
                                                        type: "POST",
                                                        dataType: 'json',
                                                        success: function(data) {
                                                            $('#data_longgrain').DataTable().ajax.reload();
                                                            $('#data_pw').DataTable().ajax.reload();
                                                            $('#data_kp').DataTable().ajax.reload();
                                                            $("#formantrian_bongkar").trigger('reset');
                                                            $('#surveyor_bongkar').val(null);
                                                            $('#btn_save').html('Simpan');
                                                            $('#modal_qc_bongkar').modal('hide');
                                                            Swal.fire({
                                                                title: 'success',
                                                                text: 'Data Berhasil DiSimpan',
                                                                icon: 'success',
                                                                timer: 1500
                                                            })

                                                        },
                                                        error: function(data) {
                                                            $("#formantrian_bongkar").trigger('reset');
                                                            $('#surveyor_bongkar').val(null);
                                                            $('#btn_save').html('Simpan');
                                                            $('#modal_qc_bongkar').modal('hide');
                                                            Swal.fire({
                                                                title: 'Gagal',
                                                                text: 'Data Tidak Disimpan',
                                                                icon: 'error',
                                                                timer: 1500
                                                            })

                                                        }
                                                    });
                                                },
                                            });
                                        } else {
                                            $("#formantrian_bongkar").trigger('reset');
                                            $('#btn_save').html('Simpan');
                                            $('#modal_qc_bongkar').modal('hide');
                                            Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                                        }
                                    }
                                });
                            }
                        }
                    });
                }
            });

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
                    if ($('#z_yang_dibawa_pk').val() == '' | $('#z_yang_ditolak_pk').val() == '' | $('#surveyor_bongkar_pk').val() == '' | $('#keterangan_pk').val() == '' | $('#no_dtm_pk').val() == '' | $('#waktu_bongkar_pk').val() == '' | $('#tempat_bongkar_pk').val() == '') {
                        Swal.fire('Gagal!', 'Data Harus Diisi Semua', 'error')
                    } else {
                        $('#formantrian_bongkar_pk').submit();
                        Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
                    }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '.to_qc_bongkar_gb', function() {
            var id = $(this).attr("name");
            var url = "{{ route('qc.bongkar.show_qc_bongkar_gb_show') }}" + "/" + id;
            // console.log(url);
            $('#modal_qc_bongkar').modal('show');
            $('#formantrian_bongkar').trigger('reset');
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    // console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_penerimaan_po').val(parsed.id_penerimaan_po);
                    $('#penerimaan_kode_po').val(parsed.kode_po);
                    $('#plat_kendaraan').val(parsed.plat_kendaraan);
                    $('#asal_pengirim').val(parsed.keterangan_penerimaan_po);
                    $('#name_bid').val(parsed.name_bid);
                }
            });
        });
        $(document).on('click', '.to_qc_bongkar_pk', function() {
            var id = $(this).attr("name");
            var url = "{{ route('qc.bongkar.show_qc_bongkar_pk_show') }}" + "/" + id;
            console.log(id);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    // console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_penerimaan_po_pk').val(parsed.id_penerimaan_po);
                    $('#penerimaan_kode_po_pk').val(parsed.kode_po);
                    $('#plat_kendaraan_pk').val(parsed.plat_kendaraan);
                    $('#asal_pengirim_pk').val(parsed.keterangan_penerimaan_po);
                    $('#name_bid_pk').val(parsed.name_bid);
                }
            });
        });
        $(document).on('keyup', '#no_dtm', function(e) {
            var data = $(this).val();
            var hasil = formatNumber(data, "Rp. ");
            $(this).val(hasil);
        });
        $(document).on('keyup', '#z_yang_dibawa', function(e) {
            var data = $(this).val();
            var hasil = formatRupiah(data, "Rp. ");
            $(this).val(hasil);
        });
        $(document).on('keyup', '#z_yang_ditolak', function(e) {
            var data = $(this).val();
            var hasil = formatRupiah(data, "Rp. ");
            $(this).val(hasil);
        });

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

    function formatNumber(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 20,
            rupiah = split[0].substr(0, sisa);


        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }

    function replace_titik(x) {
        return ((x.replace('.', '')).replace('.', '')).replace('.', '');
    }
</script>
@endsection