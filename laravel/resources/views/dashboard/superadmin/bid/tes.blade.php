@extends('dashboard.superadmin.layout.main')
@section('title')
    Dashboard | SUMBER PANGAN
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
                            CV. SUMBER PANGAN
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="kt-portlet ">
                    <div class="">
                        <!--begin::Accordion-->
                        <div class="accordion  accordion-toggle-arrow" id="accordionExample4">
                            <div class="card">
                                <div class="card-header" id="headingOne4">
                                    <div class="card-title" data-toggle="collapse" data-target="#collapseOne4"
                                        aria-expanded="false" aria-controls="collapseOne4">
                                        <i class="flaticon-add-circular-button"></i>Detail E-Procurement
                                    </div>
                                </div>
                                <div id="collapseOne4" class="collapse" aria-labelledby="headingOne"
                                    data-parent="#accordionExample4">
                                    <div class="card-body">
                                        <form class="m-form">
                                            <div class="m-portlet__body">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-lg-3 col-form-label">Nama Lelang </label>
                                                        <div class="col-lg-9">
                                                            <input type="text" class="form-control m-input"
                                                                placeholder="Enter full name" value="{{ $bid->name_bid }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-lg-3 col-form-label">Harga </label>
                                                        <div class="col-lg-9">
                                                            <input type="number" class="form-control m-input"
                                                                placeholder="Enter full name" value="{{ $bid->harga }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-lg-3 col-form-label">Jumlah</label>
                                                        <div class="col-lg-9">
                                                            <input type="number" class="form-control m-input"
                                                                placeholder="Enter full name" value="{{ $bid->jumlah }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-lg-3 col-form-label">Tempat </label>
                                                        <div class="col-lg-9">
                                                            <input type="text" class="form-control m-input"
                                                                placeholder="Enter full name" value="{{ $bid->lokasi }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-lg-3 col-form-label">Waktu Lelang</label>
                                                        <div class="col-lg-9">
                                                            <input type="date" class="form-control m-input"
                                                                placeholder="Enter full name" value="{{ $bid->date_bid }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-lg-3 col-form-label">Batas Lelang</label>
                                                        <div class="col-lg-9">
                                                            <input type="date" class="form-control m-input"
                                                                placeholder="Enter full name" value="{{ $bid->batas_bid }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-lg-3 col-form-label">Kode Lelang</label>
                                                        <div class="col-lg-9">
                                                            <input type="text" class="form-control m-input"
                                                                placeholder="Enter full name" value="{{ $bid->kode_bid }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-lg-3 col-form-label">Keterangan </label>
                                                        <div class="col-lg-9">
                                                            <textarea class="form-control m-input" placeholder="Enter full name" readonly>{{ $bid->description_bid }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-lg-3 col-form-label">Gambar</label>
                                                        <div class="col-lg-9">
                                                            <img src="{{ asset('img/bid/' . $bid->image_bid) }}"
                                                                style="width: 50%">
                                                        </div>
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
        </div>
        <div class="kt-subheader   kt-grid__item">
            <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="flaticon-user"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                DATA PENAWARAN VENDOR
                            </h3>
                        </div>
                        <div class="kt-portlet__head-label">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a data-toggle="tab" href="#kediri" role="tab" aria-controls="kediri"
                                        aria-selected="false" class="btn btn-info btn-outline-hover-info"><i
                                            class="fa fa-search"></i> Approved</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#return" role="tab" aria-controls="kediri"
                                        aria-selected="false" class="btn btn-info btn-outline-hover-info"><i
                                            class="fa fa-search"></i> Disapproved</a>
                                </li>
                                {{-- <li>
                                    <a data-toggle="tab" href="#ngawi" role="tab" aria-controls="ngawi"
                                        aria-selected="false" class="btn btn-info btn-outline-hover-info"><i
                                            class="fa fa-search"></i> Disapproved</a>
                                </li> --}}
                                <li>
                                    <a data-toggle="tab" href="#subang" role="tab" aria-controls="subang"
                                        aria-selected="false" class="btn btn-info btn-outline-hover-info"><i
                                            class="fa fa-search"></i> E-Procurement</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="tab-content">

                            <span class="m-btn btn btn-info btn-sm">{{$kuota_sisa}} Kg setara {{$kuota_sisa/8000}} Truk </span>
                            <div class="tab-pane fade show active" id="kediri" role="tabpanel">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">No</th>
                                            <th style="text-align: center;width:13%">Name</th>
                                            <th style="text-align: center;width:12%">Date</th>
                                            <th style="text-align: center;width:15%">Description</th>
                                            <th style="text-align: center;width:15%">QTY</th>
                                            <th style="text-align: center;width:12%">ACC Admin</th>
                                            <th style="text-align: center;width:15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center">
                                        <?php $no = 1; ?>
                                        @foreach ($data_approved as $item_response)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item_response->nama_vendor }}</td>
                                                <td>{{ $item_response->date_biduser }}</td>
                                                <td>{{ $item_response->description_biduser }}</td>
                                                <td>{{ $item_response->jumlah_kirim }} /Truk</td>
                                                <td>{{ $item_response->permintaan_kirim }} /Truk</td>
                                                <td>
                                                    @if ($item_response->status_biduser == 0)
                                                        <a style="margin:2px;" name="{{ $item_response->id_biduser }}" title="Approve/Disapprove" class="toapprove btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                            <i class="fa fa-spinner" style="color:#00c5dc;"></i>E-Procurement
                                                    @elseif($item_response->status_biduser == 1)
                                                        <a style="margin:2px;" name="{{ $item_response->id_biduser }}"data-toggle="modal" data-target="#modal1" title="Approved" class="tofinish btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                        <i class="fa fa-check" style="color:#00c5dc;"> </i>Approved
                                                    @elseif($item_response->status_biduser == 2)
                                                        <a style="margin:2px;" data-toggle="modal" data-target="#" title="Approve/Disprove" class="toedit btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                        <i class="fa fa-close" style="color:red;"> </i>Disapproved
                                                    @elseif($item_response->status_biduser == 3)
                                                        <a style="margin:2px;" data-toggle="modal" data-target="#" title="Delivered" class="toedit btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                        <i class="fa fa-shipping-fast" style="color:#4D006E;"> </i>Delivered
                                                    @else
                                                        <a href="{{ route('superadmin.transaction') }}" style="margin:2px;" name="" title="Data Transaksi" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                        <i class="fa fa-money" style="color:#00c5dc;"></i> Finish
                                                    @endif
                                                    </a>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="modal1" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <form class="m-form m-form--fit m-form--label-align-right"
                                                            method="post" action="{{ route('superadmin.approve_bid') }}"
                                                            enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            {{ method_field('POST') }}
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Persetujuan Pengajuan Vendor</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}">
                                                                <input type="hidden" name="id_biduser" id="id_biduser1">
                                                                <input type="hidden" name="user_idbid" id="user_id1">
                                                                <input type="hidden" name="bid_id" id="bid_id1">
                                                                <input type="hidden" name="kode_transaksi"
                                                                    id="kode_transaksi">
                                                                <div class="form-group">
                                                                    <h6 style="text-align: center">FORM PEMERIKSAAN KELENGKAPAN KENDARAAN BAHAN BAKU
                                                                    </h6>
                                                                </div>
                                                                <div class="form-group">

                                                                </div>
                                                            </div>
                                                            {{-- <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-success m-btn pull-center">Approved</button>
                                                            </div> --}}
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="return" role="tabpanel">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;;width:3%">No</th>
                                            <th style="text-align: center;width:13%">Name</th>
                                            <th style="text-align: center;width:20%">Date</th>
                                            <th style="text-align: center;width:15%">Description</th>
                                            <th style="text-align: center;width:15%">QTY</th>
                                            <th style="text-align: center;width:12%">ACC Admin</th>
                                            <th style="text-align: center;;width:12%">Disapproved </th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center">
                                        <?php $no = 1; ?>
                                        @foreach ($data_return as $item_response)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item_response->nama_vendor }}</td>
                                                <td>{{ $item_response->date_biduser }}</td>
                                                <td>{{ $item_response->description_biduser }}</td>
                                                <td>{{ $item_response->jumlah_kirim }} /Truk</td>
                                                <td>{{ $item_response->permintaan_kirim }} /Truk</td>
                                                <td style="background-color: red">{{ $item_response->permintaan_ditolak}} /Truk</td>
                                            </tr>

                                            <div class="modal fade" id="modal1" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <form class="m-form m-form--fit m-form--label-align-right"
                                                            method="post" action="{{ route('superadmin.approve_bid') }}"
                                                            enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            {{ method_field('POST') }}
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Persetujuan Pengajuan Vendor</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}">
                                                                <input type="hidden" name="id_biduser" id="id_biduser1">
                                                                <input type="hidden" name="user_idbid" id="user_id1">
                                                                <input type="hidden" name="bid_id" id="bid_id1">
                                                                <input type="hidden" name="kode_transaksi"
                                                                    id="kode_transaksi">
                                                                <div class="form-group">
                                                                    <h6 style="text-align: center">FORM PEMERIKSAAN KELENGKAPAN KENDARAAN BAHAN BAKU
                                                                    </h6>
                                                                </div>
                                                                <div class="form-group">

                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-success m-btn pull-center">Approved</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="subang" role="tabpanel">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">No</th>
                                            <th style="text-align: center;width:15%">Name</th>
                                            <th style="text-align: center;width:12%">Date </th>
                                            <th style="text-align: center;width:15%">Description</th>
                                            <th style="text-align: center;width:12%">QTY</th>
                                            <th style="text-align: center">Image</th>
                                            <th style="text-align: center;width:17%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center">
                                        <?php $no = 1; ?>
                                        @foreach ($data_proses as $item_response)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item_response->nama_vendor }}</td>
                                                <td>{{ $item_response->date_biduser }}</td>
                                                <td>{{ $item_response->description_biduser }}</td>
                                                <td>{{ $item_response->jumlah_kirim }} Truk</td>
                                                <td><img src="{{ asset('img/user/bid/' . $item_response->image_biduser) }}"
                                                        style="width: 50%"></td>
                                                <td>
                                                    @if ($item_response->status_biduser == 0)
                                                        <a style="margin:2px;" name="{{ $item_response->id_biduser }}"
                                                            data-toggle="modal" data-target="#modal2"
                                                            title="Approve/Disapprove"
                                                            class="toapprove btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                            <i class="fa fa-spinner" style="color:#00c5dc;">
                                                            </i>E-Procurement
                                                        @elseif($item_response->status_biduser == 1)
                                                            <a style="margin:2px;"
                                                                name="{{ $item_response->id_biduser }}"
                                                                data-toggle="modal" data-target="#modal1"
                                                                title="Approved"
                                                                class="tofinish btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                                <i class="fa fa-check" style="color:#00c5dc;"> </i>
                                                                Approved
                                                            @elseif($item_response->status_biduser == 2)
                                                                <a style="margin:2px;" data-toggle="modal"
                                                                    data-target="#" title="Approve/Disprove"
                                                                    class="toedit btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                                    <i class="fa fa-close" style="color:red;"> </i>
                                                                    Disapproved
                                                                @else
                                                                    <a href="{{ route('superadmin.transaction') }}"
                                                                        style="margin:2px;" name=""
                                                                        title="Data Transaksi"
                                                                        class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                                        <i class="fa fa-money" style="color:#00c5dc;">
                                                                        </i> Finish
                                                    @endif
                                                    </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="modal1" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <form class="m-form m-form--fit m-form--label-align-right"
                                                            method="post" action="{{ route('superadmin.approve_bid') }}"
                                                            enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            {{ method_field('POST') }}
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Approve
                                                                    Data
                                                                    Bid</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}">
                                                                <input type="hidden" name="id_biduser" id="id_biduser1">
                                                                <input type="hidden" name="user_idbid" id="user_id1">
                                                                <input type="hidden" name="bid_id" id="bid_id1">
                                                                <input type="hidden" name="kode_transaksi"
                                                                    id="kode_transaksi">
                                                                <div class="form-group">
                                                                    <h3 style="text-align: center">Proses Transaksi dan
                                                                        Pembayaran
                                                                    </h3>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-success m-btn pull-center">Approved</button>
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

    <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="m-form m-form--fit m-form--label-align-right" method="post"
                    action="{{ route('superadmin.approve_bid') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Approve Data Bid</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success" role="alert">
                            <strong><i class="fa fa-exclamation-triangle"></i> Capacity Limit! </strong> &nbsp; {{$kuota_sisa}} Kg, balance {{$kuota_sisa/8000}} truck
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id_biduser" id="id_biduser">
                        <input type="hidden" name="user_idbid" id="user_id">
                        <input type="hidden" name="bid_id" id="bid_id">
                        {{-- <input type="text" name="bid_id" id="bid_id" > --}}
                        <div class="form-group">
                            <div class="">
                                <label>QTY</label>

                                <input type="number" maxlength="{{$kuota_sisa/8000}}" required name="permintaan_kirim" placeholder=""
                                    class="form-control"  />
                                    <span class="m-form__help" style="color:red"><i class="fa fa-exclamation-triangle"></i> Max {{$kuota_sisa}} Kg, balance {{$kuota_sisa/8000}} Truk </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <Label>Status</Label><br>
                                <label>
                                    <input type="radio" name="status_bid" value="1" checked> Approve
                                </label>
                                <label>
                                    <input type="radio" name="status_bid" value="2"> Partially Approved
                                </label>
                                <label>
                                    <input type="radio" name="status_bid" value="3"> Disapprove
                                </label>
                            </div>
                        </div>
                        <div class="formm-a">
                            <div class="form-group">
                                <label for="">Expired Day </label>
                                <input type="text" id="expired_day" readonly class="form-control" required name="batas_penerimaan">
                            </div>
                            <div class="form-group">
                                <label for="">QTY</label>
                                <?php
                                    $pengajuan = '<p id="jumlah_kirim"></p>';
                                    $limit = is_numeric($kuota_sisa/8000);
                                    if ($limit > $pengajuan ) {
                                        echo $pengajuan;
                                    }else{
                                        $hasil = (is_numeric($pengajuan));
                                        echo $hasil;
                                    }
                                ?>
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <textarea name="message_admin" required placeholder="" class="form-control"></textarea>
                            </div>
                        </div>
                          <div class="formm-b" style="display: none">b</div>
                          <div class="formm-c" style="display: none">c</div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success m-btn pull-right">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(function() {
            $(document).on('click', '.toapprove', function() {
                var id = $(this).attr("name");
                var url = '{{ route('superadmin.bid_user') }}' + "/" + id;

                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        console.log(url);
                        console.log('a');
                        console.log(response);
                        var parsed = $.parseJSON(response);
                        $('#id_biduser').val(parsed.id_biduser);
                        $('#jumlah_kirim').html(parsed.jumlah_kirim);
                        $('#user_id').val(parsed.user_id);
                        $('#bid_id').val(parsed.bid_id);
                        $('#expired_day').val(parsed.batas_bid);

                    }
                });
            });
        });

        $(function() {
            $(document).on('click', '.tofinish', function() {
                var id = $(this).attr("name");
                var url = '{{ route('superadmin.bid_user') }}' + "/" + id;
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        console.log(response);
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

    <script>
        $(function() {
            var table = $('#datatable').DataTable({
                "scrollY": true,
                "scrollX": true,
                processing: true,
                serverSide: true,
                "aLengthMenu": [
                    [25, 100, 300, -1],
                    [25, 100, 300, "All"]
                ],
                "iDisplayLength": 10,
                ajax: "{{ route('superadmin.response_index') }}",
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
                        data: 'date_bid'
                    },
                    {
                        data: 'image_bid'
                    },
                    {
                        data: 'response'
                    },
                    {
                        data: 'ckelola'
                    }

                ],
                "order": []
            });
        });
    </script>

    <script type="text/javascript">
        $(function() {
            $(document).on('click', '.toedit', function() {
                var id = $(this).attr("name");
                var url = '{{ route('superadmin.bid_show') }}' + "/" + id;

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
    $(document).ready(function() {
      $('input[name=status_bid]:radio').change(function(e) {
        let value = e.target.value.trim()

        $('[class^="formm"]').css('display', 'none');

        switch (value) {
          case '1':
            $('.formm-a').show()
            break;
          case '2':
            $('.formm-b').show()
            break;
          case '3':
            $('.formm-c').show()
            break;
          default:
            break;
        }
      })
    })
    </script>
@endsection
