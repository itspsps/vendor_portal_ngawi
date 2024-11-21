@extends('dashboard.admin_timbangan.layout.main')
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
                            <i class="flaticon2-checking kt-font-warning"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data Revisi Timbangan
                        </h3>
                    </div>

                </div>

                <div class="kt-portlet__body">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item mt-3">
                            <a class="nav-link active" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-database"></i>GB LONG GRAIN</a>
                        </li>
                        <!-- <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_2"><i class="la la-database"></i>GB CIHERANG</a>
                        </li> -->
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_3"><i class="la la-database"></i>GB PANDAN WANGI</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_4"><i class="la la-database"></i>GB KETAN PUTIH</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
                            <table class="table table-bordered" id="data_longgrain">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Action </th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO </th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Timbangan&nbsp;Awal</th>
                                        <th style="text-align: center;width:auto">Timbangan&nbsp;Akhir</th>
                                        <th style="text-align: center;width:auto">Output&nbsp;Timbangan</th>
                                        <th style="text-align: center;width:auto">Keterangan&nbsp;Revisi</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="tab-pane" id="m_tabs_3_2" role="tabpanel">
                            <table class="table table-bordered" id="data_ciherang">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Action </th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO </th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Timbangan&nbsp;Awal</th>
                                        <th style="text-align: center;width:auto">Timbangan&nbsp;Akhir</th>
                                        <th style="text-align: center;width:auto">Output&nbsp;Timbangan</th>
                                        <th style="text-align: center;width:auto">Keterangan&nbsp;Revisi</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div> -->
                        <div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
                            <table class="table table-bordered" id="data_pw">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Action </th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO </th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Timbangan&nbsp;Awal</th>
                                        <th style="text-align: center;width:auto">Timbangan&nbsp;Akhir</th>
                                        <th style="text-align: center;width:auto">Output&nbsp;Timbangan</th>
                                        <th style="text-align: center;width:auto">Keterangan&nbsp;Revisi</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_4" role="tabpanel">
                            <table class="table table-bordered" id="data_kp">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Action </th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;PO </th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Timbangan&nbsp;Awal</th>
                                        <th style="text-align: center;width:auto">Timbangan&nbsp;Akhir</th>
                                        <th style="text-align: center;width:auto">Output&nbsp;Timbangan</th>
                                        <th style="text-align: center;width:auto">Keterangan&nbsp;Revisi</th>
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

    <!-- end:: Content -->
</div>

<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="formrevisitimbangan" class="m-form m-form--fit m-form--label-align-right" method="post" action="javascript:void(0);" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Input Revisi Data Timbangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id_penerimaan_po" id="id_penerimaan_po" value="">
                    <input type="hidden" name="penerimaan_id_data_po" id="penerimaan_id_data_po" value="">
                    <input type="hidden" id="penerimaan_id_bid_user" name="penerimaan_id_bid_user">
                    <div class="form-group">
                        <div class="">
                            <label>Waktu Penerimaan</label>
                            <input id="waktu_penerimaan" name="waktu_penerimaan" readonly value="" class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Kode PO</label>
                            <input id="penerimaan_kode_po" readonly name="penerimaan_kode_po" type="text" class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>No. Kendaraan</label>
                            <input name="plat_kendaraan" readonly id="plat_kendaraan" type="text" class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Timbangan Awal /Bruto (Kg)</label>
                            <input name="bruto" id="bruto" onkeyup="cekNetto();" required type="text" class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Timbangan Akhir /Tara (Kg)</label>
                            <input name="tara" id="tara" onkeyup="cekNetto();" required type="text" class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Output Timbangan /Netto (Kg)</label>
                            <input name="netto" readonly id="netto" onkeyup="cekNetto();" required type="text" class="form-control m-input">
                        </div>
                    </div>
                    <!--Param-->
                    <input type="hidden" value="input proses lab 2">
                    <input type="hidden" id="ka_ks" name="ka_ks">
                    <input type="hidden" id="ka_kg" name="ka_kg">
                    <input type="hidden" id="berat_sample_awal_ks" name="berat_sample_awal_ks">
                    <input type="hidden" id="berat_sample_awal_kg" name="berat_sample_awal_kg">
                    <input type="hidden" id="berat_sample_akhir_kg" name="berat_sample_akhir_kg">
                    <input type="hidden" id="berat_sample_pk" name="berat_sample_pk">
                    <input type="hidden" id="berat_sample_beras" name="berat_sample_beras">
                    <input type="hidden" id="wh" name="wh">
                    <input type="hidden" id="tp" name="tp">
                    <input type="hidden" id="md" name="md">
                    <input type="hidden" id="broken_setelah_bongkar" name="broken_setelah_bongkar">
                    <input type="hidden" name="" id="" value="plan hpp">
                    <input type="hidden" id="plan_hpp_aktual" name="plan_hpp_aktual">
                    <input type="hidden" id="plan_harga_gb" name="plan_harga_gb">
                    <!--Param-->
                    <input type="hidden" id="hampa" name="hampa">
                    <input type="hidden" id="kg_after_adjust_hampa" name="kg_after_adjust_hampa">
                    <input type="hidden" id="prosentasi_kg" name="prosentasi_kg">
                    <input type="hidden" id="susut" name="susut">
                    <input type="hidden" id="adjust_susut" name="adjust_susut">
                    <input type="hidden" id="prsentase_ks_kg_after_adjust_susut" name="prsentase_ks_kg_after_adjust_susut">
                    <input type="hidden" id="prsentase_kg_pk" name="prsentase_kg_pk">
                    <input type="hidden" id="adjust_prosentase_kg_pk" name="adjust_prosentase_kg_pk">
                    <input type="hidden" id="presentase_ks_pk" name="presentase_ks_pk">
                    <input type="hidden" id="presentase_putih" name="presentase_putih">
                    <input type="hidden" id="adjust_prosentase_kg_ke_putih" name="adjust_prosentase_kg_ke_putih">
                    <input type="hidden" id="plan_rend_dari_ks_beras" name="plan_rend_dari_ks_beras">
                    <input type="hidden" id="item" name="item">
                    <input type="hidden" id="katul" name="katul">
                    <input type="hidden" id="refraksi_broken" name="refraksi_broken">
                    <input type="hidden" id="harga_berdasarkan_tempat" name="harga_berdasarkan_tempat">
                    <input type="hidden" id="harga_berdasarkan_harga_atas" name="harga_berdasarkan_harga_atas">
                    <input type="hidden" id="harga_awal" name="harga_awal">
                    <input type="hidden" id="aksi_harga" name="aksi_harga">
                    <input type="hidden" id="plan_harga_gabah" name="plan_harga_gabah">
                    <input type="hidden" id="plan_harga_beli_gabah" name="plan_harga_beli_gabah">
                    <input type="hidden" id="perhitungan_adjust_susut" name="perhitungan_adjust_susut">
                    <input type="hidden" id="plan_harga_gabah_ongkos_dryer" name="plan_harga_gabah_ongkos_dryer">
                    <input type="hidden" id="plan_harga_pk_perkilo" name="plan_harga_pk_perkilo">
                    <input type="hidden" id="plan_harga_beras_perkilo" name="plan_harga_beras_perkilo">
                    <!--Update-->
                    <!-- <label for=""> update</label> -->
                    <input type="hidden" id="plan_berat_kg_pertruk" name="plan_berat_kg_pertruk">
                    <input type="hidden" id="plan_berat_pk_pertruk" name="plan_berat_pk_pertruk">
                    <input type="hidden" id="plan_berat_beras_pertruk" name="plan_berat_beras_pertruk">
                    <input type="hidden" id="plan_total_harga_gabah_pertruk" name="plan_total_harga_gabah_pertruk">
                    <input type="hidden" id="plan_total_harga_pk_pertruk" name="plan_total_harga_pk_pertruk">
                    <input type="hidden" id="plan_total_harga_beras_pertruk" name="plan_total_harga_beras_pertruk">

                    <input type="hidden" id="aktual_price_ongkos_driyer" name="aktual_price_ongkos_driyer">
                    <input type="hidden" id="plan_harga_aktual_pertruk" name="plan_harga_aktual_pertruk">
                    <input type="hidden" id="plan_hpp_aktual1" name="plan_hpp_aktual1">
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
        var table = $('#data_longgrain').DataTable({
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
                url: "{{ route('timbangan.data_revisi_timbangan_longgrain_index') }}",
            },
            columns: [{
                    data: "id_admin_timbangan",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'ckelola'
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
                    data: 'tanggal_po'
                },
                {
                    data: 'plat_kendaraan'
                },
                {
                    data: 'tonase_awal'
                },
                {
                    data: 'tonase_akhir'
                },
                {
                    data: 'hasil_akhir_tonase'
                },
                {
                    data: 'keterangan_analisa'
                },

            ],
            createdRow: function(row, data, index) {

                // Updated Schedule Week 1 - 07 Mar 22

                if (data.name_bid == 'GABAH BASAH CIHERANG') {
                    $('td:eq(2)', row).css('color', '#000099'); //Original Date
                } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                    $('td:eq(2)', row).css('color', '#009900'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                    $('td:eq(2)', row).css('color', '#330019'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                    $('td:eq(2)', row).css('color', '#6666FF'); // Behind of Original Date
                }
            },
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table.columns.adjust().draw().responsive.recalc();
        })
        // var table1 = $('#data_ciherang').DataTable({
        //     "scrollY": true,
        //     "scrollX": true,
        //     processing: true,
        //     serverSide: true,
        //     "aLengthMenu": [
        //         [25, 100, 300, -1],
        //         [25, 100, 300, "All"]
        //     ],
        //     "iDisplayLength": 10,
        //     ajax: {
        //         url: "{{ route('timbangan.data_revisi_timbangan_ciherang_index') }}",
        //     },
        //     columns: [{
        //             data: "id_admin_timbangan",

        //             render: function(data, type, row, meta) {
        //                 return meta.row + meta.settings._iDisplayStart + 1;
        //             }
        //         },
        //         {
        //             data: 'ckelola'
        //         },
        //         {
        //             data: 'name_bid'
        //         },
        //         {
        //             data: 'kode_po'
        //         },
        //         {
        //             data: 'nama_vendor'
        //         },
        //         {
        //             data: 'tanggal_po'
        //         },
        //         {
        //             data: 'plat_kendaraan'
        //         },
        //         {
        //             data: 'tonase_awal'
        //         },
        //         {
        //             data: 'tonase_akhir'
        //         },
        //         {
        //             data: 'hasil_akhir_tonase'
        //         },
        //         {
        //             data: 'keterangan_analisa'
        //         },

        //     ],
        //     createdRow: function(row, data, index) {

        //         // Updated Schedule Week 1 - 07 Mar 22

        //         if (data.name_bid == 'GABAH BASAH CIHERANG') {
        //             $('td:eq(2)', row).css('color', '#000099'); //Original Date
        //         } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
        //             $('td:eq(2)', row).css('color', '#009900'); // Behind of Original Date
        //         } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
        //             $('td:eq(2)', row).css('color', '#330019'); // Behind of Original Date
        //         }
        //     },
        //     "order": []
        // });
        // $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        //     table1.columns.adjust().draw().responsive.recalc();
        // })
        var table2 = $('#data_pw').DataTable({
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
                url: "{{ route('timbangan.data_revisi_timbangan_pandan_wangi_index') }}",
            },
            columns: [{
                    data: "id_admin_timbangan",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'ckelola'
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
                    data: 'tanggal_po'
                },
                {
                    data: 'plat_kendaraan'
                },
                {
                    data: 'tonase_awal'
                },
                {
                    data: 'tonase_akhir'
                },
                {
                    data: 'hasil_akhir_tonase'
                },
                {
                    data: 'keterangan_analisa'
                },

            ],
            createdRow: function(row, data, index) {

                // Updated Schedule Week 1 - 07 Mar 22

                if (data.name_bid == 'GABAH BASAH CIHERANG') {
                    $('td:eq(1)', row).css('color', '#000099'); //Original Date
                } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                    $('td:eq(1)', row).css('color', '#009900'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                    $('td:eq(1)', row).css('color', '#330019'); // Behind of Original Date
                }
            },
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table2.columns.adjust().draw().responsive.recalc();
        })
        var table3 = $('#data_kp').DataTable({
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
                url: "{{ route('timbangan.data_revisi_timbangan_ketan_putih_index') }}",
            },
            columns: [{
                    data: "id_admin_timbangan",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'ckelola'
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
                    data: 'tanggal_po'
                },
                {
                    data: 'plat_kendaraan'
                },
                {
                    data: 'tonase_awal'
                },
                {
                    data: 'tonase_akhir'
                },
                {
                    data: 'hasil_akhir_tonase'
                },
                {
                    data: 'keterangan_analisa'
                },

            ],
            createdRow: function(row, data, index) {

                // Updated Schedule Week 1 - 07 Mar 22

                if (data.name_bid == 'GABAH BASAH CIHERANG') {
                    $('td:eq(1)', row).css('color', '#000099'); //Original Date
                } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                    $('td:eq(1)', row).css('color', '#009900'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                    $('td:eq(1)', row).css('color', '#330019'); // Behind of Original Date
                }
            },
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table3.columns.adjust().draw().responsive.recalc();
        })
    });
</script>
<script type="text/javascript">
    function cekNetto() {
        var bruto = replace_titik($('#bruto').val());
        var tara = replace_titik($('#tara').val());
        $('#netto').val(bruto - tara);
    }
    $(document).on('keyup', '#bruto', function(e) {
        var data = $(this).val();
        var hasil = formatRupiah(data, "Rp. ");
        $(this).val(hasil);
    });
    $(document).on('keyup', '#tara', function(e) {
        var data = $(this).val();
        var hasil = formatRupiah(data, "Rp. ");
        $(this).val(hasil);
    });
    $(document).on('keyup', '#netto', function(e) {
        var data = $(this).val();
        var hasil = formatRupiah(data, "Rp. ");
        $(this).val(hasil);
    });

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }

    function replace_titik(x) {
        return ((x.replace('.', '')).replace('.', '')).replace('.', '');
    }
    $(function() {

        $(document).on('click', '#btn_update', function(e) {
            e.preventDefault();
            var bruto = replace_titik($('#bruto').val());
            var tara = replace_titik($('#tara').val());
            var netto = replace_titik($('#netto').val());

            var id_penerimaan_po = $('#id_penerimaan_po').val();
            var penerimaan_kode_po = $('#penerimaan_kode_po').val();

            var plan_berat_kg_pertruk = $('#plan_berat_kg_pertruk').val();
            var plan_berat_pk_pertruk = $('#plan_berat_pk_pertruk').val();
            var plan_berat_beras_pertruk = $('#plan_berat_beras_pertruk').val();
            var plan_total_harga_gabah_pertruk = $('#plan_total_harga_gabah_pertruk').val();
            var plan_total_harga_pk_pertruk = $('#plan_total_harga_pk_pertruk').val();
            var plan_total_harga_beras_pertruk = $('#plan_total_harga_beras_pertruk').val();
            $('#btn_update').html('Menyimpan...');
            // console.log(input);
            Swal.fire({
                title: 'Konfirmasi',
                icon: 'warning',
                text: "Apakah data yang kamu input sudah benar ?",
                showCancelButton: true,
                inputValue: 0,
                confirmButtonText: 'Yes',
            }).then(function(result) {
                if (result.value) {
                    if ($('#tara').val() == '' || $('#bruto').val() == '') {
                        Swal.fire({
                            title: 'Maaf!!',
                            text: 'Data Harus Diisi Semua',
                            icon: 'warning',
                            timer: 1500
                        })
                    } else {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Proses Menyimpan Data...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                                $.ajax({
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        bruto: bruto,
                                        netto: netto,
                                        tara: tara,
                                        id_penerimaan_po: id_penerimaan_po,
                                        penerimaan_kode_po: penerimaan_kode_po,
                                        plan_berat_kg_pertruk: plan_berat_kg_pertruk,
                                        plan_berat_pk_pertruk: plan_berat_pk_pertruk,
                                        plan_berat_beras_pertruk: plan_berat_beras_pertruk,
                                        plan_total_harga_gabah_pertruk: plan_total_harga_gabah_pertruk,
                                        plan_total_harga_pk_pertruk: plan_total_harga_pk_pertruk,
                                        plan_total_harga_beras_pertruk: plan_total_harga_beras_pertruk,
                                    },
                                    url: "{{route('timbangan.revisi_timbangan_update')}}",
                                    type: "POST",
                                    dataType: 'json',
                                    success: function(data) {
                                        $('#data_longgrain').DataTable().ajax.reload();
                                        $('#data_pw').DataTable().ajax.reload();
                                        $('#data_kp').DataTable().ajax.reload();
                                        $("#formrevisitimbangan").trigger('reset');
                                        $('#modal2').modal('hide');
                                        $('#btn_update').html('Simpan');
                                        Swal.fire({
                                            title: 'success',
                                            text: 'Data Berhasil Disimpan.',
                                            icon: 'success',
                                            timer: 1500
                                        })

                                    },
                                    error: function(data) {
                                        $("#formrevisitimbangan").trigger('reset');
                                        $('#btn_update').html('Simpan');
                                        $('#modal2').modal('hide');
                                        Swal.fire({
                                            title: 'Gagal!!',
                                            text: 'Data anda Tidak di Simpan.',
                                            icon: 'error',
                                            timer: 1500
                                        })

                                    }
                                });
                            },
                        });
                    }
                } else {
                    Swal.fire({
                        title: 'Gagal!!',
                        text: 'Data anda Tidak di Simpan,',
                        icon: 'error',
                        timer: 1500
                    })

                }
            });
        });
        $(document).on('click', '.to_show', function() {
            var id = $(this).attr("name");
            var url = "{{ route('timbangan.show_timbangan_revisi') }}" + "/" + id;
            // console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    // console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_penerimaan_po').val(parsed.id_penerimaan_po);
                    $('#penerimaan_id_data_po').val(parsed.id_data_po);
                    $('#penerimaan_kode_po').val(parsed.penerimaan_kode_po);
                    $('#waktu_penerimaan').val(parsed.waktu_penerimaan);
                    $('#plat_kendaraan').val(parsed.plat_kendaraan);
                    $('#tara').val(parsed.tonase_akhir);
                    $('#netto').val(parsed.hasil_akhir_tonase);
                    $('#bruto').val(parsed.tonase_awal);
                    $('#prsentase_ks_kg_after_adjust_susut_gb').val(parsed.prsentase_ks_kg_after_adjust_susut_gb);
                    $('#presentase_ks_pk').val(parsed.presentase_ks_pk_gb);
                    $('#plan_rend_dari_ks_beras').val(parsed.plan_rend_dari_ks_beras_gb);
                    $('#plan_harga_gabah_ongkos_dryer').val(parsed.plan_harga_gabah_ongkos_dryer_gb);
                    $('#plan_harga_pk_perkilo').val(parsed.plan_harga_pk_perkilo_gb);
                    $('#plan_harga_beras_perkilo').val(parsed.plan_harga_beras_perkilo_gb);
                    $('#perhitungan_adjust_susut').val(parsed.perhitungan_adjust_susut_gb);
                    $('#plan_hpp_aktual').val(parsed.plan_hpp_aktual_gb);
                    // Parameter
                    $('#ka_ks').val(parsed.kadar_air_gb);
                    $('#ka_kg').val(parsed.ka_kg_gb);
                    $('#berat_sample_awal_ks').val(parsed.berat_sample_awal_ks_gb);
                    $('#berat_sample_awal_kg').val(parsed.berat_sample_awal_kg_gb);
                    $('#berat_sample_akhir_kg').val(parsed.berat_sample_akhir_kg_gb);
                    $('#berat_sample_pk').val(parsed.berat_sample_pk_gb);
                    $('#berat_sample_beras').val(parsed.randoman_gb);
                    $('#wh').val(parsed.wh_gb);
                    $('#tp').val(parsed.tp_gb);
                    $('#md').val(parsed.md_gb);
                    $('#broken_setelah_bongkar').val(parsed.broken_gb);

                }
            });

        });
    });
</script>
<script>
    var ka_ks = document.getElementById('ka_ks');
    var ka_kg = document.getElementById('ka_kg');
    var berat_sample_awal_ks = document.getElementById('berat_sample_awal_ks');
    var berat_sample_awal_kg = document.getElementById('berat_sample_awal_kg');
    var berat_sample_akhir_kg = document.getElementById('berat_sample_akhir_kg');
    var berat_sample_pk = document.getElementById('berat_sample_pk');
    var berat_sample_beras = document.getElementById('berat_sample_beras');
    var wh = document.getElementById('wh');
    var tp = document.getElementById('tp');
    var md = document.getElementById('md');
    var broken_setelah_bongkar = document.getElementById('broken_setelah_bongkar');
    // hidden
    var bruto = document.getElementById('bruto');
    var tara = document.getElementById('tara');
    var kg_after_adjust_hampa = document.getElementById('kg_after_adjust_hampa');
    var prosentasi_kg = document.getElementById('prosentasi_kg');
    var susut = document.getElementById('susut');
    var adjust_susut = document.getElementById('adjust_susut');
    var prsentase_ks_kg_after_adjust_susut = document.getElementById('prsentase_ks_kg_after_adjust_susut');
    var prsentase_kg_pk = document.getElementById('prsentase_kg_pk');
    var adjust_prosentase_kg_pk = document.getElementById('adjust_prosentase_kg_pk');
    var presentase_ks_pk = document.getElementById('presentase_ks_pk');
    var presentase_putih = document.getElementById('presentase_putih');
    var adjust_prosentase_kg_ke_putih = document.getElementById('adjust_prosentase_kg_ke_putih');
    var plan_rend_dari_ks_beras = document.getElementById('plan_rend_dari_ks_beras');
    var katul = document.getElementById('katul');
    var refraksi_broken = document.getElementById('refraksi_broken');
    var plan_harga_gabah = document.getElementById('plan_harga_gabah');
    var hampa = document.getElementById('hampa');
    var lokasi_gt = document.getElementById('lokasi_bongkar');
    var harga_awal = document.getElementById('harga_awal');
    var plan_harga_gb = document.getElementById('plan_harga_gb');
    var plan_harga_potongan_gb = document.getElementById('plan_harga_potongan_gb');
    var item = document.getElementById('item');
    var plan_hpp_aktual = document.getElementById('plan_hpp_aktual');
    var netto = document.getElementById('netto');
    // tambahan hidden
    var plan_berat_kg_pertruk = document.getElementById('plan_berat_kg_pertruk');
    var plan_berat_pk_pertruk = document.getElementById('plan_berat_pk_pertruk');
    var plan_berat_beras_pertruk = document.getElementById('plan_berat_beras_pertruk');

    var plan_harga_gabah_ongkos_dryer = document.getElementById('plan_harga_gabah_ongkos_dryer');
    var plan_harga_pk_perkilo = document.getElementById('plan_harga_pk_perkilo');
    var plan_harga_beras_perkilo = document.getElementById('plan_harga_beras_perkilo');
    var plan_total_harga_pk_pertruk = document.getElementById('plan_total_harga_pk_pertruk');
    var plan_total_harga_beras_pertruk = document.getElementById('plan_total_harga_beras_pertruk');

    var aktual_price_ongkos_driyer = document.getElementById('aktual_price_ongkos_driyer');
    var plan_harga_aktual_pertruk = document.getElementById('plan_harga_aktual_pertruk');
    var plan_hpp_aktual1 = document.getElementById('plan_hpp_aktual1');

    function rumus() {
        if (
            ka_ks.value == '' || ka_ks.value == 'NULL' ||
            ka_kg.value == '' || ka_kg.value == 'NULL' ||
            berat_sample_awal_ks.value == '' || berat_sample_awal_ks.value == 'NULL' ||
            berat_sample_awal_kg.value == '' || berat_sample_awal_kg.value == 'NULL' ||
            berat_sample_akhir_kg.value == '' || berat_sample_akhir_kg.value == 'NULL' ||
            berat_sample_pk.value == '' || berat_sample_pk.value == 'NULL' ||
            berat_sample_beras.value == '' || berat_sample_beras.value == 'NULL' ||
            wh.value == '' || wh.value == 'NULL' ||
            tp.value == '' || tp.value == 'NULL' ||
            md.value == '' || md.value == 'NULL' ||
            broken_setelah_bongkar.value == '' || broken_setelah_bongkar.value == 'NULL') {
            var perhitungan_hasil_akhir_tonase = replace_titik(bruto.value) - replace_titik(tara.value);
            netto.value = round(perhitungan_hasil_akhir_tonase);
        } else {
            var hasil = "0";
            var perhitungan_hasil_akhir_tonase = replace_titik(bruto.value) - replace_titik(tara.value);
            netto.value = round(perhitungan_hasil_akhir_tonase);
            var berat_tonase = netto.value;
            var id_penerimaan = id_penerimaan_po.value;
            kg_after_adjust_hampa.value = berat_sample_akhir_kg.value;
            var perhitungan_prosentasi_kg = parseFloat(kg_after_adjust_hampa.value) / 1.5;
            prosentasi_kg.value = round(perhitungan_prosentasi_kg, 1);
            var perhitungan_susut = 100 - round(perhitungan_prosentasi_kg, 2);
            susut.value = round(perhitungan_susut, 1);
            var perhitungan_adjust_susut = round(perhitungan_susut, 2) * 1.2;
            adjust_susut.value = round(perhitungan_adjust_susut, 1);
            var perhitungan_prsentase_ks_kg_after_adjust_susut = 100 - round(perhitungan_adjust_susut, 2);
            prsentase_ks_kg_after_adjust_susut.value = round(perhitungan_prsentase_ks_kg_after_adjust_susut, 1);
            var perhitungan_prsentase_kg_pk = (berat_sample_pk.value / (kg_after_adjust_hampa.value / 100));
            prsentase_kg_pk.value = round(perhitungan_prsentase_kg_pk, 1);
            var perhitungan_adjust_prosentase_kg_pk = round(perhitungan_prsentase_kg_pk, 2) * 0.952;
            adjust_prosentase_kg_pk.value = round(perhitungan_adjust_prosentase_kg_pk, 1);
            var perhitungan_presentase_ks_pk = round(perhitungan_prsentase_ks_kg_after_adjust_susut, 2) * (round(perhitungan_adjust_prosentase_kg_pk, 2) / 100);
            presentase_ks_pk.value = round(perhitungan_presentase_ks_pk, 1);
            var perhitungan_presentase_putih = berat_sample_beras.value / (kg_after_adjust_hampa.value / 100);
            presentase_putih.value = round(perhitungan_presentase_putih, 1);
            var perhitungan_adjust_prosentase_kg_ke_putih = round(perhitungan_presentase_putih, 2) * 0.952;
            adjust_prosentase_kg_ke_putih.value = round(perhitungan_adjust_prosentase_kg_ke_putih, 1);
            var perhitungan_plan_rend_dari_ks_beras = (100 - round(perhitungan_adjust_susut, 2)) * (round(perhitungan_adjust_prosentase_kg_ke_putih, 2) / 100);
            plan_rend_dari_ks_beras.value = round(perhitungan_plan_rend_dari_ks_beras, 1);
            var perhitungan_katul = ((adjust_prosentase_kg_pk.value - round(perhitungan_adjust_prosentase_kg_ke_putih, 2)) / adjust_prosentase_kg_pk.value) * 100;
            katul.value = round(perhitungan_katul, 1);
            // var perhitungan_plan_harga_gabah_dan_ongkos_drayer = round

            // tambahan rumus
            var perhitungan_plan_berat_kg_pertruk = berat_tonase * (round(perhitungan_prsentase_ks_kg_after_adjust_susut, 2) / 100);
            plan_berat_kg_pertruk.value = round(perhitungan_plan_berat_kg_pertruk, 0);
            var perhitungan_plan_berat_pk_pertruk = berat_tonase * (round(perhitungan_presentase_ks_pk, 2) / 100);
            plan_berat_pk_pertruk.value = round(perhitungan_plan_berat_pk_pertruk, 0);
            var perhitungan_plan_berat_beras_pertruk = berat_tonase * (round(perhitungan_plan_rend_dari_ks_beras, 2) / 100);
            plan_berat_beras_pertruk.value = round(perhitungan_plan_berat_beras_pertruk, 0);




            // adsfa
            var perhitungan_refraksi_broken = "0";
            var h_broken = broken_setelah_bongkar.value;
            if (parseFloat(h_broken) < 28 && parseFloat(h_broken) > 0) {
                perhitungan_refraksi_broken = "0";
            } else if (parseFloat(h_broken) >= 28 && parseFloat(h_broken) < 30) {
                perhitungan_refraksi_broken = "0";
            } else if (parseFloat(h_broken) >= 30 && parseFloat(h_broken) <= 80) {
                perhitungan_refraksi_broken = "0";
            } else {
                perhitungan_refraksi_broken = "";
            }
            refraksi_broken.value = perhitungan_refraksi_broken;





            var perhitungan_plan_harga_gabah = ((round(perhitungan_plan_rend_dari_ks_beras, 2) / 100) * plan_hpp_aktual.value) - 75;
            plan_harga_gabah.value = round(perhitungan_plan_harga_gabah, 0);

            var perhitungan_plan_harga_gabah_ongkos_dryer = (perhitungan_plan_harga_gabah) + 75;
            plan_harga_gabah_ongkos_dryer.value = round(perhitungan_plan_harga_gabah_ongkos_dryer, 0);
            var perhitungan_plan_harga_pk_perkilo = round(perhitungan_plan_harga_gabah_ongkos_dryer, 2) / ((round(perhitungan_presentase_ks_pk, 2) / 100));
            plan_harga_pk_perkilo.value = round(perhitungan_plan_harga_pk_perkilo);
            var perhitungan_plan_harga_beras_perkilo = round(perhitungan_plan_harga_gabah_ongkos_dryer, 2) / ((round(perhitungan_plan_rend_dari_ks_beras, 2) / 100));
            plan_harga_beras_perkilo.value = round(perhitungan_plan_harga_beras_perkilo);
            var perhitungan_plan_total_harga_gabah_pertruk = berat_tonase * round(perhitungan_plan_harga_gabah_ongkos_dryer, 2);
            plan_total_harga_gabah_pertruk.value = round(perhitungan_plan_total_harga_gabah_pertruk);
            var perhitungan_plan_total_harga_pk_pertruk = berat_tonase * round(perhitungan_plan_harga_pk_perkilo, 1);
            plan_total_harga_pk_pertruk.value = round(perhitungan_plan_total_harga_pk_pertruk);
            var perhitungan_plan_total_harga_beras_pertruk = berat_tonase * plan_harga_beras_perkilo.value;
            plan_total_harga_beras_pertruk.value = round(perhitungan_plan_total_harga_beras_pertruk);


            var perhitungan_plan_harga_beli_gabah = plan_harga_gabah.value - refraksi_broken.value;
            plan_harga_beli_gabah.value = perhitungan_plan_harga_beli_gabah;
            var perhitungan_hasil = plan_harga_gabah.value;
            harga_berdasarkan_tempat.value = round(perhitungan_hasil);

            $.ajax({
                type: "GET",
                url: "{{route('get_price_top_gabah_basah')}}" + "/" + id_penerimaan,
                async: false,
                success: function(data) {
                    var record = JSON.parse(data);
                    // console.log(record)
                    if (record == null || record == '') {
                        Swal.fire({
                            title: 'Maaf, Anda Tidak Bisa Input',
                            text: 'Harap input HARGA ATAS Sesuai Tanggal PO',
                            icon: 'warning',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "{{ route('qc.lab.harga_atas_gabah_basah') }}";

                            }
                        })
                    } else {
                        harga_atas = record.harga_atas_gb;
                        // console.log("harga atas sekarang " + harga_atas);
                    }

                }
            });
            $.ajax({
                type: "GET",
                url: "{{route('get_buttom_price_gabah_basah')}}" + "/" + id_penerimaan,
                async: false,
                success: function(data) {
                    var record = JSON.parse(data);
                    // console.log(record)
                    if (record == null || record == '') {
                        Swal.fire({
                            title: 'Maaf, Anda Tidak Bisa Input',
                            text: 'Harap input HARGA BAWAH Sesuai Tanggal PO',
                            icon: 'warning',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "{{ route('qc.lab.harga_bawah_gabah_basah') }}";

                            }
                        })
                    } else {
                        harga_bawah = record.harga_bawah_gb
                    }
                }
            });

            if (harga_berdasarkan_tempat.value >= harga_atas) {
                // console.log("harga diatas yang ditentukan");
                harga_berdasarkan_harga_atas.value = harga_atas;
            } else {
                // console.log("harga dibwah sesuai rumus");
                harga_berdasarkan_harga_atas.value = round(harga_berdasarkan_tempat.value);
            }

            harga_awal.value = harga_berdasarkan_harga_atas.value;

            var reaksi_harga = 0;
            var potongan_bongkar_ngawi = 13;

            hasil = harga_awal.value - potongan_bongkar_ngawi;

            var perhitungan_aktual_price_ongkos_driyer = hasil + 75;
            aktual_price_ongkos_driyer.value = round(perhitungan_aktual_price_ongkos_driyer, 0);

            var perhitungan_plan_harga_aktual_pertruk = aktual_price_ongkos_driyer.value * berat_tonase;
            plan_harga_aktual_pertruk.value = round(perhitungan_plan_harga_aktual_pertruk, 0);

            var perhitungan_lan_hpp_aktual1 = hasil / (round(perhitungan_plan_rend_dari_ks_beras, 2) / 100);
            plan_hpp_aktual1.value = round(perhitungan_lan_hpp_aktual1, 0);

            var perhitungan_hampa = (berat_sample_awal_kg.value - berat_sample_akhir_kg.value) / (berat_sample_awal_kg
                .value / 100);
            hampa.value = round(perhitungan_hampa, 1);
            // console.log("id_penerimaan = " + id_penerimaan);
            // console.log("Hampa = " + hampa.value)
            // console.log("kg after djust hampa = " + kg_after_adjust_hampa.value);
            // console.log("prosentasi kg = " + round(perhitungan_prosentasi_kg, 2));
            // console.log("susut = " + round(perhitungan_susut, 2));
            // console.log("adjust susut = " + round(perhitungan_adjust_susut, 2));
            // console.log("presentase ks kg after adjust = " + round(perhitungan_prsentase_ks_kg_after_adjust_susut, 2));
            // console.log("prsentase kg pk = " + round(perhitungan_prsentase_kg_pk, 8));
            // console.log("adjust prosentase kg pk = " + round(perhitungan_adjust_prosentase_kg_pk, 8));
            // console.log("presentase ks pk = " + round(round(perhitungan_presentase_ks_pk, 8) / 100, 10));
            // console.log("presentase putih = " + round(perhitungan_presentase_putih, 8));
            // console.log("adjust prosentase kg ke putih = " + round(perhitungan_adjust_prosentase_kg_ke_putih, 8));
            // console.log("plan rend dari ks beras = " + round(perhitungan_plan_rend_dari_ks_beras, 6));
            // console.log("katul = " + round(perhitungan_katul, 2));
            // console.log("refraksi broken = " + refraksi_broken.value);
            // console.log("plan harga gabah = " + round(perhitungan_plan_harga_gabah, 6));
            // console.log("hasil akhir = " + hasil);
            // console.log("-----------------------------------------------------------------")
            // console.log("perhitungan plan berat kg pertruk = " + plan_berat_kg_pertruk.value);
            // console.log("perhitungan plan berat pk pertruk = " + plan_berat_pk_pertruk.value);
            // console.log("perhitungan plan berat beras per truk = " + plan_berat_beras_pertruk.value);
            // console.log("plan harga gabah ongkos dryer = " + round(perhitungan_plan_harga_gabah_ongkos_dryer, 6));
            // console.log("plan harga pk perkilo = " + round(perhitungan_plan_harga_pk_perkilo, 9));
            // console.log("plan harga beras perkilo = " + plan_harga_beras_perkilo.value);
            // console.log("plan total harga gabah pertruk = " + plan_total_harga_gabah_pertruk.value);
            // console.log("plan total harga pk pertruk = " + round(perhitungan_plan_total_harga_pk_pertruk, 2));
            // console.log("plan total harga beras pertruk = " + plan_total_harga_beras_pertruk.value);

            plan_harga_gb.value = harga_awal.value;
        }
    }
    var typingTimer; //timer identifier
    var doneTypingInterval = 1000;
    bruto.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    netto.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    tara.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });

    function round(value, exp) {
        if (typeof exp === 'undefined' || +exp === 0)
            return Math.round(value);

        value = +value;
        exp = +exp;

        if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
            return '0';

        // Shift
        value = value.toString().split('e');
        value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));

        // Shift back
        value = value.toString().split('e');
        return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
    }
</script>
@endsection