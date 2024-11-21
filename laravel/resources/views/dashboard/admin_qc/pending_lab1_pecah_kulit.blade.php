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
                        <i class="flaticon2-box-1 kt-font-success"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data Incoming (Pending) Beras PK
                        </h3>
                    </div>
                </div>
                <form class="" method="post" action="{{route('qc.lab.download_data_pending_excel')}}" enctype="multipart/form-data">
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

    </div>

    <!-- end:: Content -->
</div>

<div class="modal fade" id="modal_to_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form id="form_edit" class="m-form m-form--fit m-form--label-align-right" method="post"
                            action="{{ route('qc.lab.update_proseslab1_pecah_kulit') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Lab Pecah Kulit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <!--ID-->
                                <input type="hidden" id="id_lab1_pk" name="id_lab1_pk" value="">
                                <input type="hidden" id="lab1_id_penerimaan_po_pk" name="lab1_id_penerimaan_po_pk">
                                <input type="hidden" id="lab1_id_bid_user_pk" name="lab1_id_bid_user_pk">
                                <input type="hidden" id="tanggal_po_pk" name="tanggal_po_pk">
                                <input type="hidden" id="waktu_penerimaan_pk" name="waktu_penerimaan_pk">
                                <input type="hidden" id="date_bid_pk" name="date_bid_pk">
        
                                {{-- tambahan input --}}
                                <!--<label>presentase</label>-->
                                <input type="hidden" id="presentase_hampa_pk" name="presentase_hampa_pk">
                                <input type="hidden" id="presentase_pk_bersih_pk" name="presentase_pk_bersih_pk">
                                <input type="hidden" id="presentase_katul_pk" name="presentase_katul_pk">
                                <input type="hidden" id="presentase_beras_pk" name="presentase_beras_pk">
                                <input type="hidden" id="presentase_butir_patah_pk" name="presentase_butir_patah_pk">
                                <input type="hidden" id="presentase_butir_patah_beras_pk" name="presentase_butir_patah_beras_pk">
                                <input type="hidden" id="presentase_butir_patah_beras_adjust_pk" name="presentase_butir_patah_beras_adjust_pk">
                                <input type="hidden" id="refraksi_ka_pk" name="refraksi_ka_pk">
                                <input type="hidden" id="refraksi_hampa_pk" name="refraksi_hampa_pk">
                                <input type="hidden" id="refraksi_katul_pk" name="refraksi_katul_pk">
                                <input type="hidden" id="refraksi_tr_pk" name="refraksi_tr_pk">
                                <input type="hidden" id="refraksi_butir_patah_pk" name="refraksi_butir_patah_pk">
                                <input type="hidden" id="reward_hampa_pk" name="reward_hampa_pk">
                                <input type="hidden" id="reward_katul_pk" name="reward_katul_pk">
                                <input type="hidden" id="reward_tr_pk" name="reward_tr_pk">
                                <input type="hidden" id="reward_butir_patah_pk" name="reward_butir_patah_pk">
                                <input type="hidden" id="plan_kualitas_pk" name="plan_kualitas_pk">
                                <input type="hidden" id="harga_atas_pk" name="harga_atas_pk">
                                <input type="hidden" id="harga_incoming_pk" name="harga_incoming_pk">
                                <input type="hidden" id="plan_harga_aktual_pk" name="plan_harga_aktual_pk">
                                <input type="hidden" id="aktual_kualitas_pk" name="aktual_kualitas_pk">
                                <input type="hidden" id="harga_awal_pk" name="harga_awal_pk">
                                <input type="hidden" id="aksi_harga_pk" name="aksi_harga_pk">
                                <input type="hidden" id="reaksi_harga_pk" name="reaksi_harga_pk">
                                
                                <div class="form-group">
                                    <div class="">
                                        <label>Kode PO</label>
                                        <input type="text" id="lab1_kode_po" name="lab1_kode_po_pk" class="form-control m-input" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Nopol</label>
                                        <input type="text" id="lab1_plat" readonly name="lab1_plat_pk" class="form-control m-input">
                                    </div>
                                </div>
                                <div id="parameter_ka_pk" class="form-group"></div>
                                <div id="parameter_hampa_pk" class="form-group"></div>
                                <div id="parameter_katul_pk" class="form-group"></div>
                                <div id="parameter_tr_pk" class="form-group"></div>
                                <div id="parameter_butir_patah_pk" class="form-group"></div>
                                <div id="parameter_reward_hampa_pk" class="form-group"></div>
                                <div id="parameter_reward_katul_pk" class="form-group"></div>
                                <div id="parameter_reward_tr_pk" class="form-group"></div>
                                <div id="parameter_reward_butir_patah_pk" class="form-group"></div>
                                <div id="parameter_lab_pk_kualitas" class="form-group"></div>
                                {{-- edit form --}}
                                <div class="m-form__group form-group">
                                    <label for="">KA (%)</label>
                                    <input type="number" step="any" required name="ka_pk" id="ka_pk" class="form-control m-input" value="14.1">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">PK</label>
                                    <input type="number" step="any" required name="pk_pk" id="pk_pk" class="form-control m-input" value="80.0">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">PK Bersih</label>
                                    <input type="number" step="any" required name="pk_bersih_pk"  id="pk_bersih_pk" class="form-control m-input" value="79.1">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Beras</label>
                                    <input type="number" step="any" required name="beras_pk" id="beras_pk" class="form-control m-input" value="68.7">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Butir Patah</label>
                                    <input type="number" step="any" required name="butir_patah_pk" id="butir_patah_pk" class="form-control m-input" value="18.0">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Hampa</label>
                                    <input type="number" step="any" readonly  required name="hampa_pk" id="hampa_pk" class="form-control m-input" value="">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Katul</label>
                                    <input type="number" step="any" readonly required name="katul_pk" id="katul_pk" class="form-control m-input" value="">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">WH (%)</label>
                                    <input type="number" step="any" required name="wh_pk" id="wh_pk" class="form-control m-input" value="47.2">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">TR (%)</label>
                                    <input type="number" step="any" required name="tr_pk" id="tr_pk" class="form-control m-input" value="3.55">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">MD</label>
                                    <input type="number" step="any" required name="md_pk" id="md_pk" class="form-control m-input" value="133">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Status Lab</label>
                                    <select class="form-select form-control m-input" onchange="yesnoCheck(this);" id="output_lab_pk" required name="output_lab_pk" aria-label="Default select example">
                                      <option value="">--Hasil Lab 1--</option>
                                      <option name="output_lab_pk" value="Unload">Bongkar</option>
                                      <option name="output_lab_pk" value="Pending">Pending</option>
                                      <option name="output_lab_pk" value="Reject">Tolak</option>
                                    </select>
                                </div>
                                <div class="m-form__group form-group" id="ifYes" style="display: none;">
									<label>Lokasi Bongkar</label>
									<input type="text" step="any" required name="lokasi_bongkar_pk" id="lokasi_bongkar_pk" class="form-control m-input" value="">
								</div>
								<div class="m-form__group form-group">
                                    <label for="">Keterangan</label>
                                    <input type="text" step="any" required name="keterangan_lab_pk" id="keterangan_lab_pk" class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Plan Harga (Kg)</label>
                                    <input readonly type="text" disabled step="any" required name="harga_akhir_pk" id="harga_akhir_pk"
                                        class="form-control m-input">
                                </div>
                                
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                                <button id="btn_update" class="btn btn-success m-btn pull-right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

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
                    url : "{{ route('qc.lab.pending_lab1_pecah_kulit_index') }}",
                },
                "aoColumnDefs": [
			{ "bVisible": false, "aTargets": [2] }
		],
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

@endsection