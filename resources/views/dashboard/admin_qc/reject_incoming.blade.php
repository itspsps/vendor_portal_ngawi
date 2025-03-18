@extends('dashboard.admin_qc.layout.main')
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
                            Data Incoming (Reject) Gabah Basah
                        </h3>
                    </div>
                </div>
                <form class="" method="post" action="{{route('qc.lab.download_data_reject_excel')}}" enctype="multipart/form-data">
                <div style="margin-left: 10px; margin-top:10px;" class="row input-daterange">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                    <div class="col-md-4">
                        <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                    </div>
                    <div class="col-md-4">
                        <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                        <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                        <button type="submit" name="btn_export" id="btn_export" class="btn btn-success"><i class="fa fa-file-excel"></i>Excel</button>
                    </div>
                </div>
                    </form>
                <div class="kt-portlet__body">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:2%">No</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                <th style="text-align: center;width:auto">Sampai&nbsp;Disatpam</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">Asal</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">Status</th>

                                <th style="text-align: center;width:20px">KA&nbsp;KS</th>
                                <th style="text-align: center;width:20px">KA&nbsp;KG</th>
                                <th style="text-align: center;width:20px">Berat&nbsp;Sample&nbsp;Awal&nbsp;KS</th>
                                <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Awal&nbsp;KG</th>
                                <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Akhir&nbsp;KG </th>
                                <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;PK </th>
                                <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Beras </th>
                                <th style="text-align: center;width:auto">WH </th>
                                <th style="text-align: center;width:auto">TP </th>
                                <th style="text-align: center;width:auto">MD </th>
                                <th style="text-align: center;width:auto">BROKEN </th>

                                <th style="text-align: center;width:auto">Hampa&nbsp;(%) </th>
                                <th style="text-align: center;width:auto">KG&nbsp;After&nbsp;Adjust&nbsp;Hampa</th>
                                <th style="text-align: center;width:auto">(%)&nbsp;KG</th>
                                <th style="text-align: center;width:auto">(%)&nbsp;Susut</th>
                                <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;Susut&nbsp;1,2</th>
                                <th style="text-align: center;width:auto">(%)&nbsp;KS&nbsp;-&nbsp;KG&nbsp;After&nbsp;Adjust&nbsp;Susut</th>
                                <th style="text-align: center;width:auto">(%)&nbsp;KG&nbsp;-&nbsp;PK</th>
                                <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;KG&nbsp;-&nbsp;PK&nbsp;0,9952</th>
                                <th style="text-align: center;width:auto">(%)&nbsp;KS&nbsp;-&nbsp;PK</th>
                                <th style="text-align: center;width:auto">(%)&nbsp;Putih</th>
                                <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;KG&nbsp;-&nbsp;Putih&nbsp;0,952</th>
                                <th style="text-align: center;width:auto">Plan&nbsp;Rend&nbsp;KS&nbsp;-&nbsp;Beras</th>
                                <th style="text-align: center;width:auto">Katul</th>
                                <th style="text-align: center;width:auto">Refraksi&nbsp;Broken&nbsp;(Rp)</th>
                                <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Gabah&nbsp;(Rp/Kg)</th>
                                <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Gabah</th>
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
</div>

@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        load_data();

        function load_data(from_date = '', to_date = '') {
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
                ajax: {
                    url: "{{ route('qc.lab.reject_lab1_gabah_basah_index') }}",
                    data: {
                        from_date: from_date,
                        to_date: to_date
                    }
                },
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
        }
        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            if (from_date != '' && to_date != '') {
                $('#datatable').DataTable().destroy();
                load_data(from_date, to_date);
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Sukses filter data', 
                    icon: 'success',
                    timer: 1500
                    });
            } else {
                Swal.fire({
                    title: 'Infoo!!',
                    text: 'Mohon Isikan data',
                    icon: 'warning',
                    timer: 1500
                    });
            }

        });

        $('#refresh').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#datatable').DataTable().destroy();
            load_data();
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '.detail_hasil_qc', function() {
            var id = $(this).attr("name");
            var url = "{{ route('qc.lab.detail_output_incoming_qc') }}" + "/" + id;
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
            var url = "{{ route('qc.lab.lokasi_bongkar') }}" + "/" + id;
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