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
                            <i class="flaticon2-document kt-font-success"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            TRACKER PO
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-bordered" id="data_tracker_po">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:auto;" rowspan="2">No</th>
                                <th style="text-align: center;width:auto;" rowspan="2">&nbsp;Nama&nbsp;Supplier&nbsp;</th>
                                <th style="text-align: center;width:auto" rowspan="2">&nbsp;Kode&nbsp;PO&nbsp;</th>
                                <th style="text-align: center;width:auto" rowspan="2">&nbsp;Tanggal&nbsp;PO&nbsp;</th>
                                <th style="text-align: center;width:auto" rowspan="2">&nbsp;Nama&nbsp;Admin&nbsp;</th>
                                <th style="text-align: center;width:auto" rowspan="2">&nbsp;Proses&nbsp;Tracker&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #E0E0E0;" colspan="2">&nbsp;SUPPLIER&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #E0E0E0;" colspan="4">&nbsp;SOURCHING&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #E0E0E0;" colspan="2">&nbsp;SECURITY&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #E0E0E0;" colspan="4">&nbsp;QC&nbsp;LAB&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #E0E0E0;" colspan="5">&nbsp;SPV&nbsp;QC&nbsp;LAB&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #E0E0E0;" colspan="2">&nbsp;QC&nbsp;BONGKAR&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #E0E0E0;" colspan="2">&nbsp;TIMBANGAN&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #E0E0E0;" colspan="2">&nbsp;ADMIN&nbsp;AP&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #E0E0E0;" colspan="6">&nbsp;SPV&nbsp;AP&nbsp;</th>
                            </tr>
                            <tr>
                                <!-- supplier -->
                                <th style="text-align: center;width:auto;background-color: #00CCCC;color: #FFFFFF;">&nbsp;Pengajuan&nbsp;PO&nbsp;Supplier&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #00CCCC;color: #FFFFFF;">&nbsp;Konfirmasi&nbsp;Pending&nbsp;Supplier&nbsp;</th>
                                <!-- sourching -->
                                <th style="text-align: center;width:auto;background-color: #808080;color: #FFFFFF;">&nbsp;Approve&nbsp;PO&nbsp;Baru&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #808080;color: #FFFFFF;">&nbsp;Deal&nbsp;PO&nbsp;Sourching&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #808080;color: #FFFFFF;">&nbsp;Nego&nbsp;PO&nbsp;Sourching&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #808080;color: #FFFFFF;">&nbsp;Proses&nbsp;Nego&nbsp;PO&nbsp;</th>
                                <!-- security -->
                                <th style="text-align: center;width:auto;background-color: #FF3333;color: #FFFFFF;">&nbsp;Penerimaan&nbsp;PO&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #FF3333;color: #FFFFFF;">&nbsp;Penerimaan&nbsp;Terlambat&nbsp;PO&nbsp;</th>
                                <!-- lab -->
                                <th style="text-align: center;width:auto;background-color: #0080FF;color: #FFFFFF;">&nbsp;Lab&nbsp;Incoming&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #0080FF;color: #FFFFFF;">&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #0080FF;color: #FFFFFF;">&nbsp;Lab&nbsp;Bongkaran&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #0080FF;color: #FFFFFF;">&nbsp;Pengajuan&nbsp;Approve&nbsp;Lab2&nbsp;</th>
                                <!-- spv qc -->
                                <th style="text-align: center;width:auto;background-color: #FF007F;color: #FFFFFF;">&nbsp;Approve&nbsp;Bongkar&nbsp;PO&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #FF007F;color: #FFFFFF;">&nbsp;Tolak&nbsp;Approve&nbsp;PO&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #FF007F;color: #FFFFFF;">&nbsp;Approve&nbsp;Tolak&nbsp;Bongkar&nbsp;PO&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #FF007F;color: #FFFFFF;">&nbsp;Approve&nbsp;Lab2&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #FF007F;color: #FFFFFF;">&nbsp;Tolak&nbsp;Approve&nbsp;Lab2&nbsp;</th>
                                <!-- qc bongkar -->
                                <th style="text-align: center;width:auto;background-color: #9933FF;color: #FFFFFF;">&nbsp;Panggil&nbsp;Truk&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #9933FF;color: #FFFFFF;">&nbsp;Bongkar&nbsp;PO&nbsp;</th>
                                <!-- timbangan -->
                                <th style="text-align: center;width:auto;background-color: #00CC00;color: #FFFFFF;">&nbsp;Timbangan&nbsp;Awal&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #00CC00;color: #FFFFFF;">&nbsp;Timbangan&nbsp;Akhir&nbsp;</th>
                                <!-- ap -->
                                <th style="text-align: center;width:auto;background-color: #FF9933;color: #FFFFFF;">&nbsp;Verifikasi&nbsp;PO&nbsp;AP&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #FF9933;color: #FFFFFF;">&nbsp;Pengajuan&nbsp;Revisi&nbsp;PO&nbsp;</th>
                                <!-- spv ap -->
                                <th style="text-align: center;width:auto;background-color: #FF6666;color: #FFFFFF;">&nbsp;Approve&nbsp;PO&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #FF6666;color: #FFFFFF;">&nbsp;Tolak&nbsp;Approve&nbsp;PO&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #FF6666;color: #FFFFFF;">&nbsp;Approve&nbsp;Revisi&nbsp;PO&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #FF6666;color: #FFFFFF;">&nbsp;Tolak&nbsp;Approve&nbsp;Revisi&nbsp;PO&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #FF6666;color: #FFFFFF;">&nbsp;Proses&nbsp;Revisi&nbsp;</th>
                                <th style="text-align: center;width:auto;background-color: #FF6666;color: #FFFFFF;">&nbsp;Diterima&nbsp;Epicor&nbsp;</th>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
<script>
    $(function() {
        var table = $('#data_tracker_po').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('master.tracker_po_index') }}",
            columns: [{
                    data: "id_tracker_po",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'nama_supplier_tracker'
                },
                {
                    data: 'kode_po_tracker'
                },
                {
                    data: 'tanggal_po_tracker'
                },
                {
                    data: 'nama_admin_tracker'
                },
                {
                    data: 'proses_tracker'
                },
                {
                    data: 'pengajuan_po_user_tracker'
                },
                {
                    data: 'konfirmasi_pending_tracker'
                },
                {
                    data: 'approve_sourching_tracker'
                },
                {
                    data: 'deal_sourching_tracker'
                },
                {
                    data: 'nego_sourching_tracker'
                },
                {
                    data: 'proses_nego_spvqc_tracker'
                },
                {
                    data: 'penerimaan_po_tracker'
                },
                {
                    data: 'po_terlambat_tracker'
                },
                {
                    data: 'lab1_tracker'
                },
                {
                    data: 'pengajuan_approve_lab1_tracker'
                },
                {
                    data: 'lab2_tracker'
                },
                {
                    data: 'pengajuan_approve_lab2_tracker'
                },
                {
                    data: 'approve_bongkar_tracker'
                },
                {
                    data: 'tolak_approve_bongkar_tracker'
                },
                {
                    data: 'approve_tolak_lab1_tracker'
                },
                {
                    data: 'approve_lab2_tracker'
                },
                {
                    data: 'tolak_approve_lab2_tracker'
                },
                {
                    data: 'panggil_truk_tracker'
                },
                {
                    data: 'input_bongkar_tracker'
                },
                {
                    data: 'timbangan_awal_tracker'
                },
                {
                    data: 'timbangan_akhir_tracker'
                },
                {
                    data: 'verifikasi_ap_tracker'
                },
                {
                    data: 'pengajuan_revisi_ap_tracker'
                },
                {
                    data: 'approve_spvap_tracker'
                },
                {
                    data: 'tolak_approve_spvap_tracker'
                },
                {
                    data: 'approve_revisi_spvap_tracker'
                },
                {
                    data: 'approve_tolak_revisi_spvap_tracker'
                },
                {
                    data: 'revisi_po_tracker'
                },
                {
                    data: 'kirim_epicor_spvap_tracker'
                }

            ],
            "order": [
                [0, "DESC"]
            ],
            createdRow: function(row, data, index) {
                // $('td:eq(0)', row).css('background-color', '#C0C0C0');
                // $('td:eq(1)', row).css('background-color', '#C0C0C0');
                // $('td:eq(8)', row).css('background-color', '#FFCCCC');
                // $('td:eq(9)', row).css('background-color', '#FFCCCC');
                // $('td:eq(10)', row).css('background-color', '#FFCCCC');
                // $('td:eq(11)', row).css('background-color', '#FFFFCC');
                // $('td:eq(12)', row).css('background-color', '#FFFFCC');
                // $('td:eq(13)', row).css('background-color', '#E5FFCC');
                // $('td:eq(14)', row).css('background-color', '#E5FFCC');
                // $('td:eq(15)', row).css('background-color', '#E5FFCC');
                // $('td:eq(16)', row).css('background-color', '#E5FFCC');
                // $('td:eq(17)', row).css('background-color', '#CCE5FF');
                // $('td:eq(18)', row).css('background-color', '#CCE5FF');
                // $('td:eq(19)', row).css('background-color', '#CCE5FF');
                // $('td:eq(20)', row).css('background-color', '#CCE5FF');
                // $('td:eq(21)', row).css('background-color', '#CCE5FF');
                // $('td:eq(22)', row).css('background-color', '#FFCCFF');
                // $('td:eq(23)', row).css('background-color', '#FFCCFF');
                // $('td:eq(24)', row).css('background-color', '#66FFB2');
                // $('td:eq(25)', row).css('background-color', '#66FFB2');
                // $('td:eq(26)', row).css('background-color', '#FFB266');
                // $('td:eq(27)', row).css('background-color', '#FFB266');
                // $('td:eq(28)', row).css('background-color', '#FF6666');
                // $('td:eq(28)', row).css('color', '#FFFFFF');
                // $('td:eq(29)', row).css('background-color', '#FF6666');
                // $('td:eq(29)', row).css('color', '#FFFFFF');
                // $('td:eq(30)', row).css('background-color', '#FF6666');
                // $('td:eq(30)', row).css('color', '#FFFFFF');
                // $('td:eq(31)', row).css('background-color', '#FF6666');
                // $('td:eq(31)', row).css('color', '#FFFFFF');
                // $('td:eq(32)', row).css('background-color', '#FF6666');
                // $('td:eq(32)', row).css('color', '#FFFFFF');
                // $('td:eq(33)', row).css('background-color', '#FF6666');
                // $('td:eq(33)', row).css('color', '#FFFFFF');
            },
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table.columns.adjust().draw().responsive.recalc();
        })
    });
</script>
@endsection