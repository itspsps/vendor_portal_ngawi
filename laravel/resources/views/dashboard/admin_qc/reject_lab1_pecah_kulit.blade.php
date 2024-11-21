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
                        <i class="kt-menu__link-icon flaticon2-box-1 kt-font-warning"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data Incoming (Reject) Beras PK
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
                                                        <th style="text-align: center;width:auto" rowspan="2">No.</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">Kode&nbsp;PO</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">Waktu&nbsp;Penerimaan</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">Asal&nbsp;Gabah</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">Lokasi&nbsp;Bongkar</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">&nbsp;&nbsp;&nbsp;Harga&nbsp;&nbsp;&nbsp;</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">Action</th>
                                                        <th style="text-align: center;width:20px" rowspan="2">KA</th>
                                                        
                                                        <th bgcolor="#F8F8FF" style="text-align: center;width:20px" colspan="6">Berat Sample (g)</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">WH </th>
                                                        <th style="text-align: center;width:auto" rowspan="2">TR </th>
                                                        <th style="text-align: center;width:auto" rowspan="2">MD </th>
                                                        <th bgcolor="#90EE90" style="text-align: center;width:auto" colspan="7">Presentase (%) </th>
                                                        <th bgcolor="#66CDAA" style="text-align: center;width:auto" colspan="5">Refraksi</th>
                                                        <th bgcolor="#48D1CC" style="text-align: center;width:auto" colspan="4">Reward</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">Plan&nbsp;Kualitas</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">Harga&nbsp;Atas</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">Harga&nbsp;Incoming</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">Plan&nbsp;Harga&nbsp;Aktual</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">Aktual&nbsp;Kualitas</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">Harga&nbsp;Awal</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">Aksi&nbsp;Harga</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">Reaksi&nbsp;Harga</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">Harga&nbsp;Akhir</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">Keterangan&nbsp;Harga</th>
                                                        <th style="text-align: center;width:auto" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Waktu&nbsp;Lab&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                    </tr>    
                                                    <tr>    
                                                        <th style="text-align: center;width:20px">PK</th>
                                                        <th style="text-align: center;width:20px">PK&nbsp;Bersih</th>
                                                        <th style="text-align: center;width:auto">Beras&nbsp;PK</th>
                                                        <th style="text-align: center;width:auto">Butir&nbsp;Patah</th>
                                                        <th style="text-align: center;width:auto">Hampa</th>
                                                        <th style="text-align: center;width:auto">Katul</th>
                                                        
                                                        <th style="text-align: center;width:auto" >(%)&nbsp;Hampa </th>
                                                        <th style="text-align: center;width:auto" >(%)&nbsp;PK&nbsp;Bersih</th>
                                                        <th style="text-align: center;width:auto" >(%)&nbsp;Katul</th>
                                                        <th style="text-align: center;width:auto" >(%)&nbsp;beras&nbsp;PK</th>
                                                        <th style="text-align: center;width:auto" >(%)&nbsp;butir&nbsp;Patah</th>
                                                        <th style="text-align: center;width:auto" >(%)&nbsp;Butir&nbsp;Patah&nbsp;Beras</th>
                                                        <th style="text-align: center;width:auto" >(%)&nbsp;Butir&nbsp;Patah&nbsp;Beras&nbsp;Adjust</th>
                                                        
                                                        <th style="text-align: center;width:auto" >Refraksi&nbsp;KA</th>
                                                        <th style="text-align: center;width:auto" >refraksi&nbsp;Hampa</th>
                                                        <th style="text-align: center;width:auto" >Refraksi&nbsp;Katul</th>
                                                        <th style="text-align: center;width:auto" >refraksi&nbsp;TR</th>
                                                        <th style="text-align: center;width:auto" >Refraksi&nbsp;Butir&nbsp;Patah</th>
                                                        
                                                        <th style="text-align: center;width:auto" >Reward&nbsp;hampa</th>
                                                        <th style="text-align: center;width:auto" >Reward&nbsp;Katul</th>
                                                        <th style="text-align: center;width:auto" >Reward&nbsp;TR</th>
                                                        <th style="text-align: center;width:auto" >Reward&nbsp;Butir&nbsp;Patah</th>
                                                        
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
                    url : "{{ route('qc.lab.reject_lab1_pecah_kulit_index') }}",
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
                        data: 'plat_kendaraan'
                    },
                    {
                        data: 'asal_gabah'
                    },
                    {
                        data: 'lokasi_bongkar_pk'
                    },
                    {
                        data: 'harga_akhir_pk'
                    },
                    {
                        data: 'ckelola'
                    },
                    {
                        data: 'ka_pk'
                    },
                    {
                        data: 'pk_pk'
                    },

                    {
                        data: 'pk_bersih_pk'
                    },
                    {
                        data: 'beras_pk'
                    },
                    {
                        data: 'butir_patah_pk'
                    },
                    {
                        data: 'hampa_pk'
                    },
                    {
                        data: 'katul_pk'
                    },
                    {
                        data: 'wh_pk'
                    },
                    {
                        data: 'tr_pk'
                    },
                    {
                        data: 'md_pk'
                    },
                    {
                        data: 'presentase_hampa_pk'
                    },
                    {
                        data: 'presentase_pk_bersih_pk'
                    },
                    {
                        data: 'presentase_katul_pk'
                    },
                    {
                        data: 'presentase_beras_pk'
                    },
                    {
                        data: 'presentase_butir_patah_pk'
                    },
                    {
                        data: 'presentase_butir_patah_beras_pk'
                    },
                    {
                        data: 'presentase_butir_patah_beras_adjust_pk'
                    },
                    {
                        data: 'refraksi_ka_pk'
                    },
                    {
                        data: 'refraksi_hampa_pk'
                    },
                    {
                        data: 'refraksi_katul_pk'
                    },
                    {
                        data: 'refraksi_tr_pk'
                    },
                    {
                        data: 'refraksi_butir_patah_pk'
                    },
                    {
                        data: 'reward_hampa_pk'
                    },
                    {
                        data: 'reward_katul_pk'
                    },
                    {
                        data: 'reward_tr_pk'
                    },
                    {
                        data: 'reward_butir_patah_pk'
                    },
                    {
                        data: 'plan_kualitas_pk'
                    },
                    {
                        data: 'harga_atas_pk'
                    },
                    {
                        data: 'harga_incoming_pk'
                    },
                    
                    {
                        data: 'plan_harga_aktual_pk'
                    },
                    {
                        data: 'aktual_kualitas_pk'
                    },
                    {
                        data: 'harga_awal_pk'
                    },
                    {
                        data: 'aksi_harga_pk'
                    },
                    {
                        data: 'reaksi_harga_pk'
                    },
                    {
                        data: 'harga_akhir_pk'
                    },
                    {
                        data: 'keterangan_harga_akhir_pk'
                    },
                    {
                        data: 'created_at_pk'
                    }


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