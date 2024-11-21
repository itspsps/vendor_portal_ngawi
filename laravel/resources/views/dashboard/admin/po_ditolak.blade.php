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
                                    <span class="btn-outline btn-sm btn-info">Site Ngawi</span>
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
                                PO DITOLAK
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <table class="table table-bordered" id="data_ditolak">
                            <thead>
                                <tr>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <th style="text-align: center;width:auto">&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;</th>
                                    <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                    <th style="text-align: center;width:auto">Waktu&nbsp;Sampai</th>
                                    <th style="text-align: center;width:auto">Tanggal&nbsp;PO </th>
                                    <th style="text-align: center;width:auto">Batas&nbsp;Penerimaan</th>
                                    <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <th style="text-align: center;width:auto">Keterangan</th>
                                    <th style="text-align: center;width:auto">Status</th>
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
        var table = $('#data_ditolak').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('security.data_po_ditolak_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                    {data: 'name_bid'},
                {data: 'nama_vendor'},
                    {data: 'kode_po'},
                    {data: 'waktu_penerimaan'},
                    {data: 'tanggal_po'},
                    {data: 'batas_penerimaan_po'},
                    {data: 'plat_kendaraan'},
                    {data: 'asal_gabah'},
                    {data: 'ckelola'},

            ],
            "order": []
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $(document).on('click', '.to_satpam_for_bonkar', function() {
                var id = $(this).attr("name");
                var url = '{{ route('security.to_satpam_for_bonkar') }}' + "/" + id;
                console.log(url);
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        console.log(response);
                        var parsed = $.parseJSON(response);
                        $('#lokasi_bongkar').text(parsed.lokasi_bongkar);
                    }
                });
            });
        });
    </script>
@endsection
