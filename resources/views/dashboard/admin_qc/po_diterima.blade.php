@extends('dashboard.admin.layout.main')
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
                        <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
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
                                &nbsp;
                                    <span class="btn-outline btn-sm btn-info">Site Ngawi</span>
                                Data Vendor Masuk
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <table class="table table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center">Kode PO</th>
                                    <th style="text-align: center;">Vendor</th>
                                    <th style="text-align: center;">Date PO </th>
                                    <th style="text-align: center;">Expired Day</th>
                                    <th style="text-align: center;">Receiver PO</th>
                                    <th style="text-align: center;">Plate</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center">
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
                            action="{{route('admin.terima_data_po')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Terima Data PO</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="penerimaan_id_data_po" id="id_data_po" value="">
                                <input type="text" name="penerimaan_id_bid_user" id="bid_user" value="">
                                <div class="form-group">
                                    <div class="">
                                        <label>Receiver PO</label>
                                        <input id="name_bid" readonly value="{{Auth::user()->name}}" type="text" class="form-control m-input">
                                        <input type="hidden" name="penerima_po" value="{{Auth::user()->id}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Reception Time</label>
                                        <input id="harga" name="waktu_penerimaan" readonly value="{{date('Y-m-d H:i:s')}}" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Code PO</label>
                                        <input id="kode_po" name="penerimaan_kode_po" type="text" readonly class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Plate</label>
                                        <input name="plat_kendaraan" type="text" maxlength="12" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label for="">Status</label><br>
                                        <input type="radio" required name="status_penerimaan" value="1">
                                        <label for="age2">Received</label>
                                        <input type="radio" required name="status_penerimaan" value="2">
                                        <label for="age2">Unreceived</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success m-btn pull-right">Save</button>
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
            ajax: "{{ route('admin.po_diterima_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'kode_po'},
                {data: 'nama_vendor'},
                {data: 'tanggal_po'},
                {data: 'batas_bid'},
                {data: 'nama_penerima_po'},
                {data: 'plat_kendaraan'},
                {data: 'ckelola'}

            ],
            "order": []
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $(document).on('click', '.toedit', function() {
                var id = $(this).attr("name");
                var url = '{{ route('admin.show.penerimaan_po') }}' + "/" + id;
                console.log(url);
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        console.log(response);
                        var parsed = $.parseJSON(response);
                        $('#id_data_po').val(parsed.id_data_po);
                        $('#kode_po').val(parsed.kode_po);
                        $('#bid_user').val(parsed.bid_user_id);
                        console.log(parsed.bid_user_id);
                    }
                });
            });
        });
    </script>
@endsection
