@extends('dashboard.admin_spvqc.layout.main')
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
                        Harga Nego
                    </a>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        Gabah Basah
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
                            <i class="kt-menu__link-icon flaticon2-writing kt-font-warning"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data Nego
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
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;-&nbsp;Rp.&nbsp;14&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Keterangan&nbsp;Harga&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Aksi&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Surveyor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Keterangan</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Waktu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tempat</th>
                                        <th style="text-align: center;width:auto">Z&nbsp;Dibawa</th>
                                        <th style="text-align: center;width:auto">Z&nbsp;Ditolak</th>
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
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Keterangan&nbsp;Harga&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Aksi&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Surveyor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Keterangan</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Waktu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tempat</th>
                                        <th style="text-align: center;width:auto">Z&nbsp;Dibawa</th>
                                        <th style="text-align: center;width:auto">Z&nbsp;Ditolak</th>
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
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;-&nbsp;Rp.&nbsp;13&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Keterangan&nbsp;Harga&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Aksi&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Surveyor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Keterangan</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Waktu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tempat</th>
                                        <th style="text-align: center;width:auto">Z&nbsp;Dibawa</th>
                                        <th style="text-align: center;width:auto">Z&nbsp;Ditolak</th>
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
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;-&nbsp;Rp.&nbsp;13&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Keterangan&nbsp;Harga&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Aksi&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Surveyor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Keterangan</th>
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Waktu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tempat</th>
                                        <th style="text-align: center;width:auto">Z&nbsp;Dibawa</th>
                                        <th style="text-align: center;width:auto">Z&nbsp;Ditolak</th>
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
                                        <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;Harga&nbsp;Akhir&nbsp;-&nbsp;Rp.&nbsp;13&nbsp;&nbsp;&nbsp;&nbsp;</th>
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
                    <form id="form_resultnegogb" class="m-form m-form--fit m-form--label-align-right" method="post" action="javascript:void(0);" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Output Nego</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="id" name="id" class="form-control m-input">
                            <div class="form-group">
                                <label>Kode PO</label>
                                <input type="text" id="kode_po_gb" name="gabahincoming_kode_po" class="form-control m-input">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Negosiasi</label>
                                <select class="form-select form-control m-input" onchange="yesnoCheckGb(this);" id="hasil_nego" name="hasil_nego" aria-label="Default select example">
                                    <option selected>--Output Nego--</option>
                                    <option name="nego" value="Yes">Yes</option>
                                    <option name="nego" value="No">No</option>
                                </select>
                            </div>
                            <div class="m-form__group form-group" id="ifYesGb" style="display: none;">
                                <label>Add Money</label>
                                <input type="number" id="reaksi_harga" name="reaksi_harga" class="form-control m-input">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                            <button id="btn_savenegogb" name="btn_savenegogb" class="btn btn-success m-btn pull-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modaloutputnegopk" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="form_resultnegopk" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('qc.spv.output_nego_pk') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Output Nego</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="id_gabahfinishing" name="id_gabahfinishing" class="form-control m-input">
                            <div class="form-group">
                                <label>Kode PO</label>
                                <input type="text" id="kode_po" name="gabahincoming_kode_po" class="form-control m-input">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Negosiasi</label>
                                <select class="form-select form-control m-input" onchange="yesnoCheckPk(this);" id="keterangan_lab_1" name="hasil_nego" aria-label="Default select example">
                                    <option selected>--Output Nego--</option>
                                    <option name="nego" value="Yes">Yes</option>
                                    <option name="nego" value="No">No</option>
                                </select>
                            </div>
                            <div class="m-form__group form-group" id="ifYesPk" style="display: none;">
                                <label>Add Money</label>
                                <input type="number" id="reaksi_harga" name="reaksi_harga" class="form-control m-input">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                            <button id="btn_savenegopk" type="submit" class="btn btn-success m-btn pull-right">Save</button>
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
    function yesnoCheckGb(that) {
        if (that.value == "Yes") {
            document.getElementById("ifYesGb").style.display = "block";
        } else {
            document.getElementById("ifYesGb").style.display = "none";
        }
    }

    function yesnoCheckPk(that) {
        if (that.value == "Yes") {
            document.getElementById("ifYesPk").style.display = "block";
        } else {
            document.getElementById("ifYesPk").style.display = "none";
        }
    }
</script>
<script>
    $(document).on('click', '#btn_output_gb', function() {
        var id = $(this).data('id');
        var kode_po = $(this).data('kode_po');
        console.log(kode_po);
        $('input[id=id]').val(id);
        $('input[id=kode_po_gb]').val(kode_po);
    });
    $(document).on('click', '#btn_output_pk', function() {
        var id = $(this).data('id');
        var kode_po = $(this).data('kode_po');
        console.log(kode_po);
        $('input[id=id]').val(id);
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
            ajax: "{{ route('qc.spv.nego_gb_longgrain_index') }}",
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
                    data: 'harga_akhir'
                },
                {
                    data: 'keterangan_harga_akhir_gb'
                },
                {
                    data: 'aksi_harga'
                },
                {
                    data: 'surveyor'
                },
                {
                    data: 'keterangan'
                },
                {
                    data: 'waktu'
                },
                {
                    data: 'tempat'
                },
                {
                    data: 'z_yang_dibawa'
                },
                {
                    data: 'z_yang_ditolak'
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
                } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                    $('td:eq(1)', row).css('color', '#6666FF'); // Behind of Original Date
                }
            },
            "order": []
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            table.columns.adjust().draw().responsive.recalc();
        })

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
            ajax: "{{ route('qc.spv.nego_gb_pandan_wangi_index') }}",
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
                    data: 'harga_akhir'
                },
                {
                    data: 'keterangan_harga_akhir_gb'
                },
                {
                    data: 'aksi_harga'
                },
                {
                    data: 'surveyor'
                },
                {
                    data: 'keterangan'
                },
                {
                    data: 'waktu'
                },
                {
                    data: 'tempat'
                },
                {
                    data: 'z_yang_dibawa'
                },
                {
                    data: 'z_yang_ditolak'
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
            ajax: "{{ route('qc.spv.nego_gb_ketan_putih_index') }}",
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
                    data: 'harga_akhir'
                },
                {
                    data: 'keterangan_harga_akhir_gb'
                },
                {
                    data: 'aksi_harga'
                },
                {
                    data: 'surveyor'
                },
                {
                    data: 'keterangan'
                },
                {
                    data: 'waktu'
                },
                {
                    data: 'tempat'
                },
                {
                    data: 'z_yang_dibawa'
                },
                {
                    data: 'z_yang_ditolak'
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
            ajax: "{{ route('qc.spv.nego_pk_index') }}",
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
                    data: 'harga_akhir_pk'
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
        $(document).on('click', '#btn_savenegogb', function(e) {
            e.preventDefault();
            $('#btn_savenegogb').html('Menyimpan...');
            var id = $('#id').val();
            var hasil_nego = $('#hasil_nego').val();
            var harga_akhir_gb = $('#harga_akhir_gb').val();
            var reaksi_harga = $('#reaksi_harga').val();
            Swal.fire({
                title: 'Konfirmasi',
                icon: 'warning',
                text: "Apakah data yang kamu input sudah benar ?",
                showCancelButton: true,
                inputValue: 0,
                confirmButtonText: 'Yes',
            }).then(function(result) {
                if ($('#reaksi_harga').val() == '') {
                    $("#form_resultnegogb").trigger('reset');
                    $('#btn_savenegogb').html('Simpan');
                    Swal.fire({
                        title: 'Info !!',
                        text: 'Data Harus Terisi Semua',
                        icon: 'warning',
                        timer: 1500
                    })
                } else {
                    if (result.value) {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Proses Menyimpan Data...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                                $.ajax({
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        id: id,
                                        hasil_nego: hasil_nego,
                                        harga_akhir_gb: harga_akhir_gb,
                                        reaksi_harga: reaksi_harga,
                                    },
                                    url: "{{route('qc.spv.output_nego_gb')}}",
                                    type: "POST",
                                    dataType: 'json',
                                    success: function(data) {
                                        $('#data_longgrain').DataTable().ajax.reload();
                                        $('#data_pw').DataTable().ajax.reload();
                                        $('#data_kp').DataTable().ajax.reload();
                                        $('#datatable1').DataTable().ajax.reload();
                                        $("#form_resultnegogb").trigger('reset');
                                        $('#btn_savenegogb').html('Simpan');
                                        $('#modaloutputnegogb').modal('hide');
                                        Swal.fire({
                                            title: 'success',
                                            text: 'Data Berhasil DiSimpan',
                                            icon: 'success',
                                            timer: 1500
                                        })

                                    },
                                    error: function(data) {
                                        $("#form_resultnegogb").trigger('reset');
                                        $('#btn_savenegogb').html('Simpan');
                                        Swal.fire({
                                            title: 'Gagal',
                                            text: 'Data Tidak Tersimpan ',
                                            icon: 'error',
                                            timer: 1500
                                        })

                                    }
                                });
                            },
                        });

                    } else {
                        $("#form_resultnegogb").trigger('reset');
                        $('#btn_savenegogb').html('Simpan');
                        Swal.fire({
                            title: 'Gagal !',
                            text: 'Data anda Tidak di Simpan.',
                            icon: 'warning',
                            timer: 1500
                        })
                    }
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