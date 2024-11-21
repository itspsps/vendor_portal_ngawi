@extends('dashboard.admin_master.layout.main')
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
                            &nbsp;
                            <span class="btn-outline btn-sm btn-info">Site Ngawi</span>
                            Data Incoming (Reject)
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:2%">No</th>
                                <th style="text-align: center;width:auto">Supplier</th>
                                <th style="text-align: center;width:auto">Code PO</th>
                                <th style="text-align: center;width:auto">Approve Security</th>
                                <th style="text-align: center;width:auto">Date PO </th>
                                <th style="text-align: center;width:auto">Plat</th>
                                <th style="text-align: center;width:auto">Grain Location</th>
                                <th style="text-align: center;width:auto">Plan</th>
                                <th style="text-align: center;width:auto">Status</th>

                                <th style="text-align: center;width:20px">KA KS</th>
                                <th style="text-align: center;width:20px">KA KG</th>
                                <th style="text-align: center;width:20px">Berat Sample Awal KS</th>
                                <th style="text-align: center;width:auto">Berat Sample Awal KG</th>
                                <th style="text-align: center;width:auto">Berat Sample Akhir KG </th>
                                <th style="text-align: center;width:auto">Berat Sample PK </th>
                                <th style="text-align: center;width:auto">Berat Sample Beras </th>
                                <th style="text-align: center;width:auto">WH </th>
                                <th style="text-align: center;width:auto">TP </th>
                                <th style="text-align: center;width:auto">MD </th>
                                <th style="text-align: center;width:auto">BROKEN </th>

                                <th style="text-align: center;width:auto">Hampa (%) </th>
                                <th style="text-align: center;width:auto">KG After Adjust Hampa</th>
                                <th style="text-align: center;width:auto">(%) KG</th>
                                <th style="text-align: center;width:auto">(%) Susut</th>
                                <th style="text-align: center;width:auto">Adjust (%) Susut 1,2</th>
                                <th style="text-align: center;width:auto">(%) KS-KG After Adjust Susut</th>
                                <th style="text-align: center;width:auto">(%) KG-PK</th>
                                <th style="text-align: center;width:auto">Adjust (%) KG-PK 0,9952</th>
                                <th style="text-align: center;width:auto">(%) KS-PK</th>
                                <th style="text-align: center;width:auto">(%) Putih</th>
                                <th style="text-align: center;width:auto">Adjust (%) KG-Putih 0,952</th>
                                <th style="text-align: center;width:auto">Plan Rend KS-Beras</th>
                                <th style="text-align: center;width:auto">Katul</th>
                                <th style="text-align: center;width:auto">Refraksi Broken (Rp)</th>
                                <th style="text-align: center;width:auto">Plan Harga Gabah (Rp/Kg)</th>
                                <th style="text-align: center;width:auto">Plan Harga Gabah</th>
                                <!--<th style="text-align: center;width:auto">Queue</th>-->
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="to_bongkar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form class="m-form m-form--fit m-form--label-align-right">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Data Bongkar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" id="plan_harga">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="to_pending" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form class="m-form m-form--fit m-form--label-align-right">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Data Pending</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="">
                                    <h1 style="text-align: center">Lokasi Bongkar</h1>
                                    <h3 style="text-align: center" id="lokasi_bongkar"></h3>
                                    <h1 style="text-align: center">Nomer Antrian</h1>
                                    <h3 style="text-align: center" id="nomer_antrian"></h3>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
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
            ajax: "{{ route('admin_qc.reject_incoming_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'nama_vendor'
                },
                {
                    data: 'kode_po'
                },
                {
                    data: 'waktu_penerimaan'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'plat_kendaraan'
                },
                {
                    data: 'asal_gabah'
                },
                {
                    data: 'plan_harga'
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
                    data: 'berat_sample_beras'
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
                {
                    data: 'hampa'
                },
                {
                    data: 'kg_after_adjust_hampa'
                },
                {
                    data: 'prosentasi_kg'
                },
                {
                    data: 'susut'
                },
                {
                    data: 'adjust_susut'
                },
                {
                    data: 'prsentase_ks_kg_after_adjust_susut'
                },
                {
                    data: 'prsentase_kg_pk'
                },
                {
                    data: 'adjust_prosentase_kg_pk'
                },
                {
                    data: 'presentase_ks_pk'
                },
                {
                    data: 'presentase_putih'
                },
                {
                    data: 'adjust_prosentase_kg_ke_putih'
                },
                {
                    data: 'plan_rend_dari_ks_beras'
                },
                {
                    data: 'katul'
                },
                {
                    data: 'refraksi_broken'
                },
                {
                    data: 'plan_harga_gabah'
                },
                {
                    data: 'plan_harga_beli_gabah'
                },


            ],
            "order": []
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '.detail_hasil_qc', function() {
            var id = $(this).attr("name");
            var url = '{{ route('
            admin_qc.detail_output_incoming_qc ') }}' + "/" + id;
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
            var url = '{{ route('
            admin_qc.lokasi_bongkar ') }}' + "/" + id;
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