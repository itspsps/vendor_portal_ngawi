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
                    PT. SURYA PANGAN SEMESTA
                </h3>
                <span class="btn-outline btn-sm btn-info mr-3">NGAWI</span>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        PO On Call
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
                            Data Panggil Antrian
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-bordered" id="data_po_diterima">
                        <thead>
                            <tr>
                                <th style="text-align: center">No</th>
                                <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                <th style="text-align: center;width:auto">Nama&nbsp;Vendor</th>
                                <th style="text-align: center;width:auto">Jam Kedatangan</th>
                                <th style="text-align: center;width:auto">Tanggal&nbsp;PO </th>
                                <th style="text-align: center;width:auto">Tanggal&nbsp;Bongkar </th>
                                <!--<th style="text-align: center;width:auto">Batas Pengiriman</th>-->
                                <th style="text-align: center;width:auto">Nopol&nbsp;Kendaraan</th>
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
</div>

<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right" method="post"
                action="{{ route('security.update_nopol') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Nopol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id_penerimaan_po" id="id_penerimaan_po" value="">
                    <div class="form-group">
                        <div class="">
                            <label>Kode PO</label>
                            <input id="penerimaan_kode_po" required name="penerimaan_kode_po" placeholder="" type="text" readonly
                                class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Nopol</label>
                            <input id="plat_kendaraan" required name="plat_kendaraan" placeholder="" type="text"
                                class="form-control m-input">
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
@endsection
@section('js')

<script>
    $(function() {
        var table = $('#data_po_diterima').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('security.po_on_call_index') }}",
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
                    data: 'waktu_penerimaan'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'tanggal_bongkar'
                },
                // {data: 'batas_penerimaan_po'},
                {
                    data: 'plat_kendaraan'
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
        $(document).on('click', '.to_satpam_for_bonkar', function() {
            var id = $(this).attr("name");
            var url = "{{ route('security.to_satpam_for_bonkar') }}" + "/" + id;
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

<script type="text/javascript">
    $(function() {
        $(document).on('click', '.to_show_nopol', function() {
            var id = $(this).attr("name");
            var url = "{{ route('security.show_nopol') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_penerimaan_po').val(parsed.id_penerimaan_po);
                    $('#penerimaan_kode_po').val(parsed.penerimaan_kode_po);
                    $('#plat_kendaraan').val(parsed.plat_kendaraan);
                    console.log(parsed.bid_user_id);
                }
            });
        });
    });
</script>
@endsection