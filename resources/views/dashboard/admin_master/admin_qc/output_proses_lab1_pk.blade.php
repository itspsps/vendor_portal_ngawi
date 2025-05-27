@extends('dashboard.admin_master.layout.main')
@section('title')
SURYA PANGAN SEMESTA
@endsection
@section('content')
@include('sweetalert::alert')
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
                            HasiL Lab 1 Beras Pecah Kulit (PK)
                        </h3>
                    </div>
                </div>
                <div class="">
                    <div class="kt-portlet__head-label">
                        <div class="m-portlet__body">
                            <div class="kt-portlet__body col-12" style="overflow-x:auto;">
                                <table class="table table-bordered" id="datatable_pk">
                                    <thead id="coba">
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

                                            <th style="text-align: center;width:auto">(%)&nbsp;Hampa </th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;PK&nbsp;Bersih</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;Katul</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;beras&nbsp;PK</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;butir&nbsp;Patah</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;Butir&nbsp;Patah&nbsp;Beras</th>
                                            <th style="text-align: center;width:auto">(%)&nbsp;Butir&nbsp;Patah&nbsp;Beras&nbsp;Adjust</th>

                                            <th style="text-align: center;width:auto">Refraksi&nbsp;KA</th>
                                            <th style="text-align: center;width:auto">refraksi&nbsp;Hampa</th>
                                            <th style="text-align: center;width:auto">Refraksi&nbsp;Katul</th>
                                            <th style="text-align: center;width:auto">refraksi&nbsp;TR</th>
                                            <th style="text-align: center;width:auto">Refraksi&nbsp;Butir&nbsp;Patah</th>

                                            <th style="text-align: center;width:auto">Reward&nbsp;hampa</th>
                                            <th style="text-align: center;width:auto">Reward&nbsp;Katul</th>
                                            <th style="text-align: center;width:auto">Reward&nbsp;TR</th>
                                            <th style="text-align: center;width:auto">Reward&nbsp;Butir&nbsp;Patah</th>

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
        </div>
    </div>

    @endsection
    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript">
        function yesnoCheck(that) {
            if (that.value == "Unload") {
                Swal.fire({
                    position: 'top',
                    icon: 'warning',
                    title: 'Pilih Lokasi Bongkar',
                    showConfirmButton: true
                });
                document.getElementById("ifYes").style.display = "block";
            } else {
                document.getElementById("ifYes").style.display = "none";
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#datatable_pk').DataTable({
                "scrollY": true,
                "scrollX": true,
                processing: true,
                language: {
                    "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>'
                },
                serverSide: true,
                "aLengthMenu": [
                    [10, 25, 100, 300, -1],
                    [10, 25, 100, 300, "All"]
                ],
                "iDisplayLength": 10,
                ajax: {
                    url: "{{ route('master.lab.output_lab1_qc_pk_index') }}",
                },
                "aoColumnDefs": [{
                    "bVisible": false,
                    "aTargets": [2]
                }],
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
        });
    </script>

    @endsection