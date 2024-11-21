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
                            <i class="kt-menu__link-icon flaticon2-box-1 kt-font-success"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Output Nego Gabah Basah
                        </h3>
                    </div>
                </div>
                <form class="" method="post" action="{{route('qc.lab.download_nego_lab2_excel')}}" enctype="multipart/form-data">
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
                            @if(Auth::guard('lab')->user()->level=='QC')
                            @elseif(Auth::guard('lab')->user()->level=='MANAGER')
                            <button type="submit" name="btn_export" id="btn_export" class="btn btn-success"><i class="fa fa-file-excel"></i>Excel</button>
                            @endif
                        </div>
                    </div>
                </form>
                <div class="kt-portlet__body">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item mt-3">
                            <a class="nav-link active" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-database"></i>GABAH BASAH LONG GRAIN</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_2"><i class="la la-database"></i>GABAH BASAH PANDAN WANGI</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_3"><i class="la la-database"></i>GABAH BASAH KETAN PUTIH</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
                            <table class="table table-bordered" id="data_longgrain">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Supplier</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;Pengajuan</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;Nopol </th>
                                        <th style="text-align: center;width:auto">Bruto</th>
                                        <th style="text-align: center;width:auto">Tara</th>
                                        <th style="text-align: center;width:auto">Neto</th>
                                        <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Beli</th>
                                        <th style="text-align: center;width:auto">Harga&nbsp;Berdasarkan&nbsp;Tempat</th>
                                        <th style="text-align: center;width:auto">Harga&nbsp;Berdasarkan&nbsp;Harga&nbsp;Atas</th>
                                        <th style="text-align: center;width:auto">Harga&nbsp;Awal</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Surveyor</th>
                                        <th style="text-align: center;width:auto">Keterangan</th>
                                        <th style="text-align: center;width:auto">&nbsp;Waktu&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tempat</th>
                                        <th style="text-align: center;width:auto">Z&nbsp;Dibawa</th>
                                        <th style="text-align: center;width:auto">Z&nbsp;Ditolak</th>
                                        <th style="text-align: center;width:auto">Aksi&nbsp;Harga</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_2" role="tabpanel">
                            <table class="table table-bordered" id="data_pw">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Supplier</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;Pengajuan</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;Nopol </th>
                                        <th style="text-align: center;width:auto">Bruto</th>
                                        <th style="text-align: center;width:auto">Tara</th>
                                        <th style="text-align: center;width:auto">Neto</th>
                                        <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Beli</th>
                                        <th style="text-align: center;width:auto">Harga&nbsp;Berdasarkan&nbsp;Tempat</th>
                                        <th style="text-align: center;width:auto">Harga&nbsp;Berdasarkan&nbsp;Harga&nbsp;Atas</th>
                                        <th style="text-align: center;width:auto">Harga&nbsp;Awal</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Surveyor</th>
                                        <th style="text-align: center;width:auto">Keterangan</th>
                                        <th style="text-align: center;width:auto">&nbsp;Waktu&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tempat</th>
                                        <th style="text-align: center;width:auto">Z&nbsp;Dibawa</th>
                                        <th style="text-align: center;width:auto">Z&nbsp;Ditolak</th>
                                        <th style="text-align: center;width:auto">Aksi&nbsp;Harga</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
                            <table class="table table-bordered" id="data_kp">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;width:2%">No</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Item</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Supplier</th>
                                        <th style="text-align: center;width:auto">Tanggal&nbsp;Pengajuan</th>
                                        <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                        <th style="text-align: center;width:auto">&nbsp;Nopol </th>
                                        <th style="text-align: center;width:auto">Bruto</th>
                                        <th style="text-align: center;width:auto">Tara</th>
                                        <th style="text-align: center;width:auto">Neto</th>
                                        <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Beli</th>
                                        <th style="text-align: center;width:auto">Harga&nbsp;Berdasarkan&nbsp;Tempat</th>
                                        <th style="text-align: center;width:auto">Harga&nbsp;Berdasarkan&nbsp;Harga&nbsp;Atas</th>
                                        <th style="text-align: center;width:auto">Harga&nbsp;Awal</th>
                                        <th style="text-align: center;width:auto">Nama&nbsp;Surveyor</th>
                                        <th style="text-align: center;width:auto">Keterangan</th>
                                        <th style="text-align: center;width:auto">&nbsp;Waktu&nbsp;</th>
                                        <th style="text-align: center;width:auto">Tempat</th>
                                        <th style="text-align: center;width:auto">Z&nbsp;Dibawa</th>
                                        <th style="text-align: center;width:auto">Z&nbsp;Ditolak</th>
                                        <th style="text-align: center;width:auto">Aksi&nbsp;Harga</th>
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
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    function yesnoCheck(that) {
        if (that.value == "Yes") {
            document.getElementById("ifYes").style.display = "block";
        } else {
            document.getElementById("ifYes").style.display = "none";
        }
    }
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
            var table1 = $('#data_longgrain').DataTable({
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
                    url: "{{ route('qc.lab.output_gabah_longgrain_nego_index') }}",
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
                    {
                        data: 'aksi_harga'
                    },
                ],
                createdRow: function(row, data, index) {

                    // Updated Schedule Week 1 - 07 Mar 22

                    if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
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
                table1.columns.adjust().draw().responsive.recalc();
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
                ajax: {
                    url: "{{ route('qc.lab.output_gabah_pandan_wangi_nego_index') }}",
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
                    {
                        data: 'aksi_harga'
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
                    url: "{{ route('qc.lab.output_gabah_ketan_putih_nego_index') }}",
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
                    {
                        data: 'aksi_harga'
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
        }
        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            if (from_date != '' && to_date != '') {
                $('#data_longgrain').DataTable().destroy();
                $('#data_pw').DataTable().destroy();
                $('#data_kp').DataTable().destroy();
                // table.ajax.reload(from_date, to_date);
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
            $('#data_longgrain').DataTable().destroy();
            $('#data_pw').DataTable().destroy();
            $('#data_kp').DataTable().destroy();
            load_data();
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '#btn_savenego', function(e) {
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
                    $('#form_resultnego').submit();
                    Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '.output_nego', function() {
            var id = $(this).attr("name");
            var url = "{{ route('qc.lab.show_output_nego') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#kode_po').val(parsed.gabahincoming_kode_po);
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