@extends('dashboard.user.layout.main')
@section('title')
SUMBER PANGAN
@endsection
@section('content')
<div class="cart_page_bg">
    <div class="container">
        <div class="shopping_cart_area">
            <form action="#">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="cart_page table-responsive">
                                <table class="table table-bordered table-striped" style="width: 100%" id="datatable">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;font-family: Times New Roman;font-weight:bold">No</th>
                                            <th style="text-align: center;font-family: Times New Roman;font-weight:bold">Lelang</th>
                                            <th style="text-align: center;font-family: Times New Roman;font-weight:bold">Waktu</th>
                                            <th style="text-align: center;font-family: Times New Roman;font-weight:bold">Harga</th>
                                            <th style="text-align: center;font-family: Times New Roman;font-weight:bold">kode</th>
                                            <th style="text-align: center;font-family: Times New Roman;font-weight:bold">Jumlah</th>
                                            <th style="text-align: center;font-family: Times New Roman;font-weight:bold">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center;font-family: Times New Roman">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

    {{-- <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">


        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

            <div class="">
                <div class="row">
                    <div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">

                        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form class="m-form m-form--fit m-form--label-align-right" method="post" action=""
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('POST') }}
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Update Data Vendor</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" id="id" value="">
                                            <div class="form-group">
                                                <div class="">
                                                    <label>Name Vendor</label>
                                                    <input id="name" name="name" placeholder=""
                                                        type="text" class="form-control m-input">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="">
                                                    <label>Date Bid</label>
                                                    <input id="email" name="email" placeholder=""
                                                        type="" class="form-control m-input">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="">
                                                    <label>Password</label>
                                                    <input id="password" name="password" placeholder=""
                                                    type="" class="form-control m-input">                                    </div>
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

                        <!--end:: Widgets/Blog-->
                    </div>
                </div>
            </div>
        </div>


        <!-- end:: Content -->
    </div> --}}
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(function () {
         var table = $('#datatable').DataTable({
             "scrollY": true,
             "scrollX": true,
             processing: true,
             serverSide: true,
             "aLengthMenu": [[25, 100, 300, -1], [25, 100, 300, "All"]],
             "iDisplayLength": 10,
             ajax: "{{ route('user.riwayat_index') }}",
             columns: [
                     {
                     data: "id",

                     render: function (data, type, row, meta) {
                         return meta.row + meta.settings._iDisplayStart + 1;
                     }
                 },
                     {data: 'name_bid'},
                     {data: 'date_bid'},
                     {data: 'harga'},
                     {data: 'kode_bid'},
                     {data: 'jumlah'},
                     {data: 'status_biduser'},

             ],
             "order": []
         });
     });
 </script>
@endsection
