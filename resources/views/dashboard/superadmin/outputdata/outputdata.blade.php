@extends('dashboard.superadmin.layout.main')
@section('title')
    E-PROCUREMENT | SUMBER PANGAN
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
                            SPS - SP
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
                                @if (Auth::user()->site_admin == 'NGAWI')
                                    <span class="btn-outline btn-sm btn-info">Site Ngawi</span>
                                @elseif (Auth::user()->site_admin == 'KEDIRI')
                                    <span class="btn-outline btn-sm btn-info">Site Kediri</span>
                                @elseif (Auth::user()->site_admin == 'SUBANG')
                                    <span class="btn-outline btn-sm btn-info">Site Subang</span>
                                @endif
                                Data Sourching
                            </h3>
                            
                        </div>
                        <div class="">
                            <a style="float: right; margin-top:1%" href="#" onClick="return false;" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-file-excel"> Excel</i></a>
                            <a style="float: right; margin-top:1%" href="#" onClick="return false;" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-file-pdf"> PDF</i></a>
                            <a style="float: right; margin-top:1%" href="#" onClick="return false;" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-file-csv"> CSV</i></a>
                            <a style="float: right; margin-top:1%" href="#" onClick="return false;" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-print"> PRINT</i></a>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <table class="table table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th style="text-align: center;width:2%">No</th>
                                    <th style="text-align: center;width:auto">Name Vendor</th>
                                    <th style="text-align: center;width:auto">Code PO</th>
                                    <th style="text-align: center;width:auto">Plate </th>
                                    <th style="text-align: center;width:auto">Purchase Price Plan</th>
                                    <th style="text-align: center;width:auto">Price By Place</th>
                                    <th style="text-align: center;width:auto">Price Based on Top Price</th>
                                    <th style="text-align: center;width:auto">Starting Price</th>
                                    <!--<th style="text-align: center;width:auto">Price Action</th>-->
                                </tr>
                            </thead>
                            <tbody style="text-align: center">
                            </tbody>
                        </table>
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
                ajax: "{{ route('superadmin.data_sourching_deal_index') }}",
                columns: [{
                        data: "id_bid",

                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'nama_vendor'},
                    {data: 'kode_po'},
                    {data: 'plat_kendaraan'},
                    {data: 'plan_harga_beli_gabah'},
                    {data: 'harga_berdasarkan_tempat'},
                    {data: 'harga_berdasarkan_harga_atas'},
                    {data: 'harga_awal'},
                    // {data: 'aksi_harga'},
                ],
                "order": []
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $(document).on('click', '.aksi_harga', function() {
                var id = $(this).attr("name");
                var url = '{{ route('admin_qc.detail_output_incoming_qc') }}' + "/" + id;
                console.log(url);
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        console.log(response);
                        var parsed = $.parseJSON(response);
                        $('#plan_harga').val(parsed.plan_harga);
                        console.log(parsed.bid_user_id);
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $(document).on('click', '.lokasi_bongkar', function() {
                var id = $(this).attr("name");
                var url = '{{ route('admin_qc.lokasi_bongkar') }}' + "/" + id;
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
