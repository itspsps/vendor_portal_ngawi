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
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet ">
                <div class="">
                    <!--begin::Accordion-->
                    <div class="accordion  accordion-toggle-arrow" id="accordionExample4">
                        <div class="card">
                            <div class="card-header" id="headingOne4">
                                <div class="card-title" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseOne4">
                                    <i class="flaticon2-add kt-font-info"></i> Tambah Plan HPP
                                </div>
                            </div>
                            <div id="collapseOne4" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample4">
                                <div class="card-body">
                                    <form id="formplanhpp" class="kt-form" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-wizard-v4__form">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="kt-section__body">
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Nama Item</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <select step="any" id="nama_item" required class="form-control kt-select2 selectpicker" name="nama_item" value="" data-live-search="true">
                                                                            <option value="">Pilih Item</option>
                                                                            @foreach($data as $data)
                                                                            <option value=" {{$data->nama_item}}">{{$data->nama_item}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Min TP</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="text" step="any" id="add_min_tp" class="form-control" name="add_min_tp" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Max TP</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="text" step="any" id="add_max_tp" class="form-control" name="add_max_tp" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Tanggal PO</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="date" step="any" id="add_tanggal_po" class="form-control" name="add_tanggal_po" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Harga</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="text" step="any" id="add_harga" class="form-control" name="add_harga" value="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-form__actions">
                                                    <button id="btnSaveadd" class="btn btn-success m-btn pull-right">Simpan</button>
                                                </div><br>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Accordion-->
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Plan HPP Gabah Basah
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
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">MIN&nbsp;TP</th>
                                        <th style="text-align: center;width:auto">MAX&nbsp;TP</th>
                                        <th style="text-align: center;width:auto">TANGGAL&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">HARGA</th>
                                        <th style="text-align: center;width:auto">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
                            <table class="table table-bordered" id="data_pw">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">MIN&nbsp;TP</th>
                                        <th style="text-align: center;width:auto">MAX&nbsp;TP</th>
                                        <th style="text-align: center;width:auto">TANGGAL&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">HARGA</th>
                                        <th style="text-align: center;width:auto">Action</th>
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
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">MIN&nbsp;TP</th>
                                        <th style="text-align: center;width:auto">MAX&nbsp;TP</th>
                                        <th style="text-align: center;width:auto">TANGGAL&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">HARGA</th>
                                        <th style="text-align: center;width:auto">Action</th>
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

        <div class="modal fade" id="modal-plan-hpp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="javascript:void(0)" class="m-form m-form--fit m-form--label-align-right">
                        <input type="hidden" name="id_plan_hpp" id="id_plan_hpp">
                        <input type="hidden" id="tanggal_poedit">
                        <div class="modal-header">
                            <h5 class="modal-title" id="headmodal"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Item</label>
                                <select step="any" id="nama_item_edit" class="form-control m-input m-input--air" name="nama_item_edit">
                                    <?php
                                    $items = App\Models\Item::where('nama_item', 'LIKE', '%GABAH BASAH%')->get();
                                    ?>
                                    <!-- <option value=""></option> -->
                                    @foreach($items as $item)
                                    <option value="{{$item->nama_item}}">{{$item->nama_item}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Min TP</label>
                                    <input type="text" id="min_tp" name="min_tp" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Max TP</label>
                                    <input type="text" id="max_tp" name="max_tp" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label>TANGGAL PO</label>
                                    <input type="date" id="tanggal_po" name="tanggal_po" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="text" id="harga" name="harga" class="form-control m-input">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                            <button id="btnSave" class="btn btn-success m-btn pull-right">Simpan</button>
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
<script>
    $(function() {
        $(document).on('keypress', '#add_min_tp', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#add_max_tp', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#min_tp', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#max_tp', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
    });
    $(document).on('keyup', '#add_harga', function(e) {
        var data = $(this).val();
        var hasil = formatRupiah(data, "Rp. ");
        $(this).val(hasil);
    });
    $(document).on('keyup', '#harga', function(e) {
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
</script>
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });

    var table1 = $('#data_longgrain').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('qc.spv.plan_hpp_gabah_basah_longgrain_index') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'nama_item',
                name: 'nama_item'
            },
            {
                data: 'min_tp_gb',
                name: 'min_tp_gb'
            },
            {
                data: 'max_tp_gb',
                name: 'max_tp_gb'
            },
            {
                data: 'waktu_plan_hpp_gb',
                name: 'waktu_plan_hpp_gb'
            },
            {
                data: 'harga_gb',
                name: 'harga_gb'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        table1.columns.adjust().draw().responsive.recalc();
    })
    var table2 = $('#data_pw').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('qc.spv.plan_hpp_gabah_basah_pandanwangi_index') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'nama_item',
                name: 'nama_item'
            },
            {
                data: 'min_tp_gb',
                name: 'min_tp_gb'
            },
            {
                data: 'max_tp_gb',
                name: 'max_tp_gb'
            },
            {
                data: 'waktu_plan_hpp_gb',
                name: 'waktu_plan_hpp_gb'
            },
            {
                data: 'harga_gb',
                name: 'harga_gb'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        table2.columns.adjust().draw().responsive.recalc();
    })
    var table3 = $('#data_kp').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('qc.spv.plan_hpp_gabah_basah_ketanputih_index') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'nama_item',
                name: 'nama_item'
            },
            {
                data: 'min_tp_gb',
                name: 'min_tp_gb'
            },
            {
                data: 'max_tp_gb',
                name: 'max_tp_gb'
            },
            {
                data: 'waktu_plan_hpp_gb',
                name: 'waktu_plan_hpp_gb'
            },
            {
                data: 'harga_gb',
                name: 'harga_gb'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        table3.columns.adjust().draw().responsive.recalc();
    })

    $(document).ready(function() {
        $('body').on('click', '#btnEdit', function() {
            var ids = $(this).data("id");
            var item = $(this).data("item");
            var mintp = $(this).data("mintp");
            var maxtp = $(this).data("maxtp");
            var tanggal_po = $(this).data("tanggal_po");
            var harga = $(this).data("harga");
            // console.log(item);
            $('#headmodal').html("Edit Data PLAN HPP");
            $('#id_plan_hpp').val(ids);
            $('#min_tp').val(mintp);
            $('#max_tp').val(maxtp);
            $('#harga').val(harga);
            $('#tanggal_po').val(tanggal_po);
            $('#tanggal_poedit').val(tanggal_po);
            $('#nama_item_edit').val(item);
            $('#modal-plan-hpp').modal('show');
        })
    });


    $('body').on('click', '#btnDelete', function() {
        var cek = $(this).data('id');
        console.log(cek);
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Kamu tidak dapat mengembalikan data ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    title: 'Harap Tuggu Sebentar!',
                    html: 'Proses Delete Data...', // add html attribute if you want or remove
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                        $.ajax({
                            url: "{{ route('qc.spv.delete_plan_hpp_gabah_basah') }}/" + cek,
                            type: "GET",
                            error: function() {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Gagal Hapus Data.',
                                    icon: 'error',
                                    timer: 1500
                                })
                            },
                            success: function(data) {
                                Swal.fire({
                                    title: 'Terhapus!',
                                    text: 'Data anda berhasil di hapus.',
                                    icon: 'success',
                                    timer: 1500
                                })
                                table1.ajax.reload();
                                table2.ajax.reload();
                                table3.ajax.reload();
                            }
                        });
                    },
                });
            } else {
                Swal.fire({
                    title: 'Gagal !',
                    text: 'Data anda Tidak di Simpan.',
                    icon: 'error',
                    timer: 1500
                })
            }
        });

    });
    $(document).ready(function() {
        $('body').on('click', '#btnSaveadd', function() {
            $('#btnSaveadd').html('Menyimpan...');
            var add_min_tp = $('#add_min_tp').val();
            var add_max_tp = $('#add_max_tp').val();
            var add_tanggal_po = $('#add_tanggal_po').val();
            var nama_item = $('#nama_item').val();
            var add_harga = replace_titik($('#add_harga').val());
            Swal.fire({
                title: 'Konfirmasi',
                icon: 'warning',
                text: "Apakah data yang kamu input sudah benar ?",
                showCancelButton: true,
                inputValue: 0,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if ($('#add_max_tp').val() == '' || $('select[id=nama_item]').val() == '' || $('#add_min_tp').val() == '' || $('#add_tanggal_po').val() == '' || $('#add_harga').val() == '') {
                    Swal.fire({
                        title: 'Info !!',
                        text: 'Data Harus Terisi Semua',
                        icon: 'warning',
                        timer: 1500
                    })
                    $("#formplanhpp").trigger('reset');
                    $('#btnSaveadd').html('Simpan');
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
                                        nama_item: nama_item,
                                        add_min_tp: add_min_tp,
                                        add_max_tp: add_max_tp,
                                        add_harga: add_harga,
                                        add_tanggal_po: add_tanggal_po,
                                    },
                                    url: "{{ route('qc.spv.simpan_plan_hpp_gabah_basah') }}",
                                    type: "POST",
                                    dataType: 'json',
                                    success: function(data) {

                                        // table.draw();
                                        table1.draw();
                                        table2.draw();
                                        table3.draw();
                                        $("#formplanhpp").trigger('reset');
                                        $('#btnSaveadd').html('Simpan');
                                        Swal.fire({
                                            title: 'success',
                                            text: 'Data Berhasil DiSimpan',
                                            icon: 'success',
                                            timer: 1500
                                        })

                                    },
                                    error: function(data) {
                                        $('#btnSaveadd').html('Simpan');
                                        $("#formplanhpp").trigger('reset');
                                        Swal.fire({
                                            title: 'Gagal',
                                            text: 'Tanggal PO Melebihi Batas Yang Ditentukan ',
                                            icon: 'error',
                                            timer: 1500
                                        })

                                    }
                                });
                            },
                        });
                    } else {
                        $("#formplanhpp").trigger('reset');
                        $('#btnSaveadd').html('Simpan');
                        Swal.fire({
                            title: 'Gagal !',
                            text: 'Data anda Tidak di Simpan.',
                            icon: 'error',
                            timer: 1500
                        })
                    }
                }
            });
        });
        $('body').on('click', '#btnSave', function() {
            $('#btnSave').html('Menyimpan...');
            var id_plan_hpp = $('#id_plan_hpp').val();
            var nama_item_edit = $('#nama_item_edit').val();
            var min_tp = $('#min_tp').val();
            var tanggal_po = $('#tanggal_po').val();
            var max_tp = $('#max_tp').val();
            var harga = replace_titik($('#harga').val());
            Swal.fire({
                title: 'Konfirmasi',
                icon: 'warning',
                text: "Apakah data yang kamu input sudah benar ?",
                showCancelButton: true,
                inputValue: 0,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if ($('#max_tp').val() == '' || $('select[id=nama_item_edit]').val() == '' || $('#min_tp').val() == '' || $('#tanggal_po').val() == '' || $('#harga').val() == '') {
                    Swal.fire({
                        title: 'Info !!',
                        text: 'Data Harus Terisi Semua',
                        icon: 'warning',
                        timer: 1500
                    })
                    $("#formplanhpp").trigger('reset');
                    $('#btnSave').html('Simpan');
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
                                        id_plan_hpp: id_plan_hpp,
                                        min_tp: min_tp,
                                        max_tp: max_tp,
                                        nama_item_edit: nama_item_edit,
                                        harga: harga,
                                        tanggal_po: tanggal_po,
                                    },
                                    url: "{{ route('qc.spv.simpan_plan_hpp_gabah_basah') }}",
                                    type: "POST",
                                    dataType: 'json',
                                    success: function(data) {

                                        // table.draw();
                                        table1.draw();
                                        table2.draw();
                                        table3.draw();
                                        $('#btnSave').html('Simpan');
                                        $('#modal-plan-hpp').modal('hide');
                                        Swal.fire({
                                            title: 'success',
                                            Text: 'Data Berhasil DiSimpan',
                                            icon: 'success',
                                            timer: 1500
                                        })

                                    },
                                    error: function(data) {
                                        $('#btnSave').html('Simpan');
                                        $('#modal-plan-hpp').modal('hide');
                                        Swal.fire({
                                            title: 'Gagal',
                                            text: 'Tanggal PO Melebihi Batas Yang Ditentukan ',
                                            icon: 'error',
                                            timer: 1500

                                        })

                                    }
                                });
                            },
                        });
                    } else {
                        $('#btnSave').html('Simpan');
                        $("#formplanhpp").trigger('reset');
                        Swal.fire({
                            title: 'Gagal !',
                            text: 'Data anda Tidak di Simpan.',
                            icon: 'error',
                            timer: 1500
                        })
                    }
                }
            });
        });
    });
</script>
@endsection