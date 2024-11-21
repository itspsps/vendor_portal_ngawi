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
                            <i class="kt-menu__link-icon flaticon2-writing kt-font-danger"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data Revisi Harga
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
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_5"><i class="la la-database"></i>BERAS PECAH KULIT</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
                            <table class="table table-bordered" id="data_longgrain">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;Pengajuan</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp; </th>
                                        <th style="text-align: center;width:auto">Bruto</th>
                                        <th style="text-align: center;width:auto">Tara</th>
                                        <th style="text-align: center;width:auto">Neto</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;Harga&nbsp;Beli&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Berdasarkan&nbsp;Tempat&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Berdasarkan&nbsp;Harga&nbsp;Atas&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Awal&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Reaksi&nbsp;Harga&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Keterangan&nbsp;Revisi&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Aksi&nbsp;&nbsp;&nbsp;&nbsp;</th>
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
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;Pengajuan</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp; </th>
                                        <th style="text-align: center;width:auto">Bruto</th>
                                        <th style="text-align: center;width:auto">Tara</th>
                                        <th style="text-align: center;width:auto">Neto</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;Harga&nbsp;Beli&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Berdasarkan&nbsp;Tempat&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Berdasarkan&nbsp;Harga&nbsp;Atas&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Awal&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Reaksi&nbsp;Harga&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Keterangan&nbsp;Revisi&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Aksi&nbsp;&nbsp;&nbsp;&nbsp;</th>
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
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;Pengajuan</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp; </th>
                                        <th style="text-align: center;width:auto">Bruto</th>
                                        <th style="text-align: center;width:auto">Tara</th>
                                        <th style="text-align: center;width:auto">Neto</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;Harga&nbsp;Beli&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Berdasarkan&nbsp;Tempat&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Berdasarkan&nbsp;Harga&nbsp;Atas&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Awal&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Reaksi&nbsp;Harga&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Keterangan&nbsp;Revisi&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Aksi&nbsp;&nbsp;&nbsp;&nbsp;</th>
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
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;Pengajuan</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp; </th>
                                        <th style="text-align: center;width:auto">Bruto</th>
                                        <th style="text-align: center;width:auto">Tara</th>
                                        <th style="text-align: center;width:auto">Neto</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;Harga&nbsp;Beli&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Berdasarkan&nbsp;Tempat&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Berdasarkan&nbsp;Harga&nbsp;Atas&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Awal&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Reaksi&nbsp;Harga&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Keterangan&nbsp;Revisi&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Aksi&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_5" role="tabpanel">
                            <table class="table table-bordered" id="datatable1">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;Pengajuan</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp; </th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bruto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tara&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Neto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Aktual&nbsp;Kualitas&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Atas&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Incoming&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Awal&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Keterangan&nbsp;Harga&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Aksi&nbsp;Harga&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Surveyor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Keterangan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Waktu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Tempat&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;Z&nbsp;Dibawa&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;Z&nbsp;Ditolak&nbsp;</th>
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

        <div class="modal fade" id="modaloutputnegogb" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="form_resultrevisigb" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('master.save_revisi_harga_gb') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Output Nego</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="id_gabahfinishing_gb" name="id_gabahfinishing" class="form-control m-input">
                            <div class="form-group">
                                <label>Kode PO</label>
                                <input type="text" id="kode_po_gb" name="gabahincoming_kode_po" class="form-control m-input">
                            </div>
                            <div class="form-group">
                                <label>Harga Akhir Yang Direvisi</label>
                                <input type="text" id="harga_akhir_revisi" readonly name="harga_akhir_revisi" class="form-control m-input">
                            </div>
                            <div class="form-group">
                                <label>Harga Hasil Lab2 - Rp. 13</label>
                                <input type="text" id="harga_akhir" readonly name="harga_akhir" class="form-control m-input">
                            </div>
                            <div class="m-form__group form-group">
                                <label>Reaksi Harga (Rp.)</label>
                                <input type="text" id="reaksi_harga" onkeyup="cekNetto();" name="reaksi_harga" class="form-control m-input">
                            </div>
                            <div class="m-form__group form-group">
                                <label>Output Harga Akhir</label>
                                <input type="text" id="output_harga_akhir" readonly onkeyup="cekNetto();" name="output_harga_akhir" class="form-control m-input">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                            <button id="btn_saverevisigb" class="btn btn-success m-btn pull-right">Save</button>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
</script>
<script>
    function cekNetto() {
        var reaksiharga = $('#reaksi_harga').val();
        var harga_akhir_revisi = $('#harga_akhir_revisi').val();
        var harga_akhir = $('#harga_akhir').val();
        $('#output_harga_akhir').val(parseInt(harga_akhir) + parseInt(reaksiharga));
    }
    $(document).on('keyup', '#harga_akhir', function(e) {
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
    $(document).on('click', '#btn_output_gb', function() {
        var id = $(this).data('id');
        var kode_po = $(this).data('kode_po');
        var reaksi_harga = $(this).data('reaksi_harga');
        var hargaakhir = $(this).data('hargaakhir');
        var hargaawal = $(this).data('hargaawal');
        console.log(hargaawal);
        $('input[id=id_gabahfinishing_gb]').val(id);
        $('input[id=kode_po_gb]').val(kode_po);
        $('input[id=harga_akhir_revisi]').val(hargaakhir);
        $('input[id=harga_akhir]').val(hargaawal - 13);
        $('input[id=reaksi_harga]').val(reaksi_harga);
    });
    $(document).on('click', '#btn_output_pk', function() {
        var id = $(this).data('id');
        var kode_po = $(this).data('kode_po');
        console.log(kode_po);
        $('input[id=id_gabahfinishing]').val(id);
        $('input[id=kode_po]').val(kode_po);
    });
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
            ajax: "{{ route('master.revisi_harga_gb_longgrain_index') }}",
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
                    data: 'nama_vendor'
                },
                {
                    data: 'date_bid'
                },
                {
                    data: 'kode_po'
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
                    data: 'plan_harga_beli_gabah'
                },
                {
                    data: 'harga_berdasarkan_tempat'
                },
                {
                    data: 'harga_berdasarkan_harga_atas'
                },
                {
                    data: 'harga_awal'
                },
                {
                    data: 'reaksi_harga'
                },
                {
                    data: 'harga_akhir'
                },
                {
                    data: 'keterangan_analisa'
                },
                {
                    data: 'aksi_harga'
                }
            ],
            createdRow: function(row, data, index) {

                // Updated Schedule Week 1 - 07 Mar 22

                if (data.name_bid == 'GABAH BASAH CIHERANG') {
                    $('td:eq(1)', row).css('color', '#000099'); //Original Date
                } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                    $('td:eq(1)', row).css('color', '#009900'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                    $('td:eq(1)', row).css('color', '#330019'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                    $('td:eq(1)', row).css('color', '#6666FF'); // Behind of Original Date
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
        //     ajax: "{{ route('master.revisi_harga_gb_ciherang_index') }}",
        //     columns: [{
        //             data: "id_bid",

        //             render: function(data, type, row, meta) {
        //                 return meta.row + meta.settings._iDisplayStart + 1;
        //             }
        //         },
        //         {
        //             data: 'name_bid'
        //         },
        //         {
        //             data: 'nama_vendor'
        //         },
        //         {
        //             data: 'date_bid'
        //         },
        //         {
        //             data: 'kode_po'
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
        //             data: 'plan_harga_beli_gabah'
        //         },
        //         {
        //             data: 'harga_berdasarkan_tempat'
        //         },
        //         {
        //             data: 'harga_berdasarkan_harga_atas'
        //         },
        //         {
        //             data: 'harga_awal'
        //         },
        //         {
        //             data: 'reaksi_harga'
        //         },
        //         {
        //             data: 'harga_akhir'
        //         },
        //         {
        //             data: 'keterangan_analisa'
        //         },
        //         {
        //             data: 'aksi_harga'
        //         }
        //     ],
        //     createdRow: function(row, data, index) {

        //         // Updated Schedule Week 1 - 07 Mar 22

        //         if (data.name_bid == 'GABAH BASAH CIHERANG') {
        //             $('td:eq(1)', row).css('color', '#000099'); //Original Date
        //         } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
        //             $('td:eq(1)', row).css('color', '#009900'); // Behind of Original Date
        //         } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
        //             $('td:eq(1)', row).css('color', '#330019'); // Behind of Original Date
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
            ajax: "{{ route('master.revisi_harga_gb_pandan_wangi_index') }}",
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
                    data: 'nama_vendor'
                },
                {
                    data: 'date_bid'
                },
                {
                    data: 'kode_po'
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
                    data: 'plan_harga_beli_gabah'
                },
                {
                    data: 'harga_berdasarkan_tempat'
                },
                {
                    data: 'harga_berdasarkan_harga_atas'
                },
                {
                    data: 'harga_awal'
                },
                {
                    data: 'reaksi_harga'
                },
                {
                    data: 'harga_akhir'
                },
                {
                    data: 'keterangan_analisa'
                },
                {
                    data: 'aksi_harga'
                }
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
            ajax: "{{ route('master.revisi_harga_gb_ketan_putih_index') }}",
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
                    data: 'nama_vendor'
                },
                {
                    data: 'date_bid'
                },
                {
                    data: 'kode_po'
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
                    data: 'plan_harga_beli_gabah'
                },
                {
                    data: 'harga_berdasarkan_tempat'
                },
                {
                    data: 'harga_berdasarkan_harga_atas'
                },
                {
                    data: 'harga_awal'
                },
                {
                    data: 'reaksi_harga'
                },
                {
                    data: 'harga_akhir'
                },
                {
                    data: 'keterangan_analisa'
                },
                {
                    data: 'aksi_harga'
                }
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
    $(document).ready(function() {

        var table = $('#datatable1').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('master.nego_pk_index') }}",
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
                    data: 'nama_vendor'
                },
                {
                    data: 'date_bid'
                },
                {
                    data: 'kode_po'
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
                    data: 'aktual_kualitas_pk'
                },
                {
                    data: 'harga_atas_pk'
                },
                {
                    data: 'harga_incoming_pk'
                },
                {
                    data: 'harga_awal_pk'
                },
                {
                    data: 'keterangan_harga_akhir_pk'
                },
                {
                    data: 'aksi_harga'
                },
                {
                    data: 'surveyor_bongkar'
                },
                {
                    data: 'keterangan_bongkar'
                },
                {
                    data: 'waktu_bongkar'
                },
                {
                    data: 'tempat_bongkar'
                },
                {
                    data: 'z_yang_dibawa'
                },
                {
                    data: 'z_yang_ditolak'
                },
            ],
            "order": []
        });

    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '#btn_saverevisigb', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi',
                icon: 'warning',
                text: "Apakah data yang kamu input sudah benar ?",
                showCancelButton: true,
                inputValue: 0,
                confirmButtonText: 'Yes',
            }).then(function(result) {
                if (result.value) {
                    if ($('#reaksi_harga').val() == '') {
                        Swal.fire('Maaf!', 'Data Harus Diisi.', 'warning')
                    } else {
                        $('#form_resultrevisigb').submit();
                        Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
                    }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '#btn_savenegopk', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi',
                icon: 'warning',
                text: "Apakah data yang kamu input sudah benar ?",
                showCancelButton: true,
                inputValue: 0,
                confirmButtonText: 'Yes',
            }).then(function(result) {
                if (result.value) {
                    $('#form_resultnegopk').submit();
                    Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

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