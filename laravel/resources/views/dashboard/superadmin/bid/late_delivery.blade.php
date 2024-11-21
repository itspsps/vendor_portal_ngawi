@extends('dashboard.superadmin.layout.main')
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
                                Late Delivery
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <table class="table table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th style="text-align: center;width:2%">No</th>
                                    <th style="text-align: center;width:15%">Kode PO</th>
                                    <th style="text-align: center;width:15%">Vendor</th>
                                    <th style="text-align: center;width:20%">Expired Day</th>
                                    <th style="text-align: center;width:20%">Incomeing</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center">
                                <?php $no = 1; ?>
                                @foreach ($data_pengajuan_telat as $data)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$data->kode_po}}</td>
                                        <td>{{$data->nama_vendor}}</td>
                                        <td>{{$data->batas_bid}}</td>
                                        <td>{{$data->waktu_penerimaan}}</td>
                                        <td>
                                            <a href="{{url('superadmin/perpanjang_po/'.$data->id_data_po)}}" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">Extend PO</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal2" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="m-form m-form--fit m-form--label-align-right" method="post"
                            action="{{ route('superadmin.bid_update') }}" enctype="multipart/form-data">
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
                                        <label>Name Bid</label>
                                        <input id="name_bid" name="name_bid" placeholder="Topic" type="text"
                                            class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <input id="harga" name="harga" placeholder="Topic" type="hidden"
                                            class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Jumlah</label>
                                        <input id="jumlah" name="jumlah" placeholder="Topic" type="number"
                                            class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Site</label>
                                        <select class="form-control m-input m-input--air" name="lokasi" id="loaksi">
                                            <option>Pilih Site</option>
                                            <option value="KEDIRI">Site Kediri</option>
                                            <option value="NGAWI">Site Ngawi</option>
                                            <option value="SUBANG">Site Subang</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Date Bid</label>
                                        <input id="date_bid" name="date_bid" placeholder="" type="date"
                                            class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Last Bid</label>
                                        <input id="batas_bid" name="batas_bid" placeholder="" type="date"
                                            class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Description</label>
                                        <textarea name="description_bid" id="description_bid" type="type" class="form-control m-input" placeholder=""
                                            rows="5" required=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success m-btn pull-right">Update</button>
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

@endsection
