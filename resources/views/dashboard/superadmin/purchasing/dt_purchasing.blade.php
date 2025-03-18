@extends('dashboard.superadmin.layout.main')
@section('title')
  SUMBER PANGAN
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
                                Data Purchasing
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <table class="table table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center;">Vendor</th>
                                    <th style="text-align: center;">Date PO</th>
                                    <th style="text-align: center">Code PO</th>
                                    <th style="text-align: center">Status</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('superadmin.vendor_update') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Data Broadcast</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id_news" id="id_news" value="">
                                <div class="form-group">
                                    <div class="">
                                        <label>Broadcast Title</label>
                                        <input id="judul_broadcast" name="judul_broadcast" placeholder="" type="text"
                                            class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Date</label>
                                        <input id="waktu_broadcast" name="waktu_broadcast" placeholder="" type="date"
                                            class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Broadcast Description</label>
                                        <input id="isi_broadcast" name="isi_broadcast" placeholder="" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Image</label>
                                        <input id="" name="gambar_broadcast" placeholder="" type="file"
                                            class="form-control m-input">
                                        <div id="gambar_broadcast"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
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
                ajax: "{{ route('superadmin.purchasing_index') }}",
                columns: [{
                        data: "id",

                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'nama_vendor'},
                    {data: 'tanggal_po'},
                    {data: 'kode_po'},
                    {data: 'status'},

                ],
                "order": []
            });
        });
    </script>

    <script type="text/javascript">
        $(function() {
            $(document).on('click', '.toedit', function() {
                var id = $(this).attr("name");
                var url = '{{ route('superadmin.broadcast_show') }}' + "/" + id;

                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        var parsed = $.parseJSON(response);
                        var image = parsed.gambar_broadcast;
                        $('#id_broadcast').val(parsed.id_broadcast);
                        $('#judul_broadcast').val(parsed.judul_broadcast);
                        $('#waktu_broadcast').val(parsed.waktu_broadcast);
                        $('#isi_broadcast').val(parsed.isi_broadcast);
                        $('#gambar_broadcast').empty();
                        if (image !== null) {
                            $('#gambar_broadcast').append(
                                '<div class="col-md-12 col-lg-4"><img src="https://sumberpangan.store/public/img/broadcast/' +
                                image + '" width="100%" /></div>');
                        }
                    }
                });
            });
        });
    </script>
@endsection
