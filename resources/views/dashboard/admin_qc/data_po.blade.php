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
                    DATA PO
                </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
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
                            <i class="flaticon2-list kt-font-primary"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data PO
                        </h3>
                    </div>
                </div>
                <div style="margin-left: 10px; margin-top:10px;" class="row input-daterange">
                    <div class="col-md-4">
                        <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                    </div>
                    <div class="col-md-4">
                        <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                        <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item mt-3">
                            <a class="nav-link active" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-database"></i>GABAH BASAH</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_2"><i class="la la-database"></i>BERAS PECAH KULIT</a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" data-toggle="tab" href="#m_tabs_3_3"><i class="la la-database"></i>BERAS DS</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_tabs_3_1" role="tabpanel">
                            <table class="table table-bordered" id="data_gb">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">No</th>
                                        <th style="text-align: center;width:15%">Gambar</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;List&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tutup&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Mulai&nbsp;Pengajuan</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_2" role="tabpanel">
                            <table class="table table-bordered" id="data_pk">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">No</th>
                                        <th style="text-align: center;width:15%">Gambar</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;List&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tutup&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Mulai&nbsp;Pengajuan</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="m_tabs_3_3" role="tabpanel">
                            <table class="table table-bordered" id="data_ds">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">No</th>
                                        <th style="text-align: center;width:15%">Gambar</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;List&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tutup&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: center;width:15%">Mulai&nbsp;Pengajuan</th>
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


<script>
    $(document).ready(function() {
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        load_data();

        function load_data(from_date = '', to_date = '') {
            var table1 = $('#data_gb').DataTable({
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
                    url: "{{ route('qc.lab.bid_gb_index') }}",
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
                        data: 'image_bid'
                    },
                    {
                        data: 'name_bid'
                    },
                    {
                        data: 'list_po'
                    },
                    {
                        data: 'open_po'
                    },
                    {
                        data: 'close_po'
                    },
                    {
                        data: 'start_pengajuan'
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
                table1.columns.adjust().draw().responsive.recalc();
            })
            var table2 = $('#data_pk').DataTable({
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
                    url: "{{ route('qc.lab.bid_pk_index') }}",
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
                        data: 'image_bid'
                    },
                    {
                        data: 'name_bid'
                    },
                    {
                        data: 'list_po'
                    },
                    {
                        data: 'open_po'
                    },
                    {
                        data: 'close_po'
                    },
                    {
                        data: 'start_pengajuan'
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
                    }
                },
                "order": []
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                table2.columns.adjust().draw().responsive.recalc();
            })
            var table3 = $('#data_ds').DataTable({
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
                    url: "{{ route('qc.lab.bid_ds_index') }}",
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
                        data: 'image_bid'
                    },
                    {
                        data: 'name_bid'
                    },
                    {
                        data: 'list_po'
                    },
                    {
                        data: 'open_po'
                    },
                    {
                        data: 'close_po'
                    },
                    {
                        data: 'start_pengajuan'
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
                $('#data_gb').DataTable().destroy();
                $('#data_pk').DataTable().destroy();
                $('#data_ds').DataTable().destroy();
                // table.ajax.reload(from_date, to_date);
                load_data(from_date, to_date);
                Swal.fire('Berhasil', 'Sukses filter data', 'success');
            } else {
                Swal.fire('Infoo!!', 'Mohon Isikan data', 'warning');
            }

        });

        $('#refresh').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#data_gb').DataTable().destroy();
            $('#data_pk').DataTable().destroy();
            $('#data_ds').DataTable().destroy();
            load_data();
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    function cekDS(that) {
        if (that.value == "BERAS DS") {
            document.getElementById("pilih").style.display = "block";
        } else {
            document.getElementById("pilih").style.display = "none";
        }
    }
    $(function() {
        $('#image_bid').change(function() {

            let reader = new FileReader();
            console.log(reader);
            reader.onload = (e) => {

                $('#file_upload_bid').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });
        $(document).on('click', '#btn_coba', function(e) {
            Swal.fire({
                title: 'Please Wait !',
                html: 'data uploading', // add html attribute if you want or remove
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
            $('#kt_apps_user_add_user_form').submit();
        });
        $(document).on('click', '#btn_save', function(e) {
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
                    if ($('#name_bid').val() == '' || $('#jumlah').val() == '' || $('#open_po').val() == '' || $('#description_bid').val() == '' || $('#batas_bid').val() == '' || $('#image_bid').val() == '') {
                        Swal.fire('Gagal!', 'Data Harus Terisi.', 'error')
                    } else {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Data Uploading...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            },
                        });
                        $('#kt_apps_user_add_user_form').submit();

                        // Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                    }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });

        $(document).on('click', '#btn_save1', function(e) {
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
                    if ($('#name_bid1').val() == '' || $('#jumlah1').val() == '' || $('#description_bid1').val() == '' || $('#batas_bid1').val() == '' || $('#date_bid1').val() == '') {
                        Swal.fire('Gagal!', 'Data Harus Terisi.', 'error')

                    } else {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Data Uploading...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            },
                        });
                        $('#kt_apps_user_update_user_form').submit();

                    }

                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '#btn_saveaddkuota', function(e) {
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
                    if ($('#add_kuota').val() == '') {
                        Swal.fire('Gagal!', 'Data Harus Terisi.', 'error')

                    } else {
                        $('#form_addkuota').submit();
                        Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                    }

                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });

        $('body').on('click', '#btn_delete', function() {
            var cek = $(this).data('bidid');
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
                        html: 'Proses Input Data...', // add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                            $.ajax({
                                url: "{{url('sourching/bid_destroy')}}/" + cek,
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
                                    $('#data_gb').DataTable().ajax.reload();
                                    $('#data_pk').DataTable().ajax.reload();
                                    $('#data_ds').DataTable().ajax.reload();
                                }
                            });
                        },
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });

        });
        $('body').on('click', '#btn_delete_kuota', function() {
            var cek = $(this).data('id');
            console.log(cek);
            $.ajax({
                url: "{{route('sourching.delete_add_kuota')}}/" + cek,
                type: "GET",
                error: function() {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Gagal Hapus Kuota.',
                        icon: 'error',
                        timer: 1500
                    })
                },
                success: function(data) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Berhasil Hapus Kuota.',
                        icon: 'success',
                        timer: 1500
                    })
                    $('#data_gb').DataTable().ajax.reload();
                    $('#data_pk').DataTable().ajax.reload();
                    $('#data_ds').DataTable().ajax.reload();
                }
            });

        });
        $('body').on('click', '#btn_status', function() {
            var cek = $(this).data('id');
            console.log(cek);
            $.ajax({
                url: "{{url('sourching/bid_status')}}/" + cek,
                type: "GET",
                error: function() {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Gagal Update Status.',
                        icon: 'error',
                        timer: 1500
                    })
                },
                success: function(data) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Berhasil Update Status.',
                        icon: 'success',
                        timer: 1500
                    })
                    $('#data_gb').DataTable().ajax.reload();
                    $('#data_pk').DataTable().ajax.reload();
                    $('#data_ds').DataTable().ajax.reload();
                }
            });

        });
        $('body').on('click', '#btn_status1', function() {

            Swal.fire({
                title: 'Gagal!',
                text: 'Waktu Lelang Sudah Berakhir.',
                icon: 'error',
                timer: 1500
            })
            $('#data_gb').DataTable().ajax.reload();
            $('#data_gb1').DataTable().ajax.reload();
            $('#data_pk').DataTable().ajax.reload();
            $('#data_pk1').DataTable().ajax.reload();
            $('#data_ds').DataTable().ajax.reload();
            $('#data_ds1').DataTable().ajax.reload();
        });
        $(document).on('click', '.toedit', function() {
            var id = $(this).data('bidid');
            var date_bid = $(this).data('datebid');
            var lokasi = $(this).data('lokasi');
            var nama = $(this).data('nama');
            var harga = $(this).data('harga');
            var jumlah = $(this).data('jumlah');
            var datebid = $(this).data('datebid');
            var batasbid = $(this).data('lastbid');
            var description = $(this).data('description');
            var hasil_jml = (jumlah / 8000);
            var image_bid = $(this).data('image');
            // console.log(image_bid);
            $('input[id=id_bid]').val(id);
            $('select[id=name_bid1]').val(nama);
            $('input[id=harga1]').val(harga);
            $('input[id=jumlah1]').val(hasil_jml);
            $('input[id=lokasi1]').val(lokasi);
            $('input[id=date_bid1]').val(date_bid);
            $('input[id=batas_bid1]').val(batasbid);
            $('textarea[id=description_bid1]').val(description);
            $('img[id=file_bid]').attr('src', 'https://ngawi.suryapangansemesta.store/public/img/bid/' + image_bid);
        });
        $('#gambar_bid1').change(function() {

            let reader = new FileReader();
            console.log(reader);
            reader.onload = (e) => {

                $('#file_bid').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });
        $(document).on('click', '#btn_addkuota', function() {
            var id = $(this).data('id');
            var add_kuota = $(this).data('add_kuota');
            $('input[id=id]').val(id);
            $('select[id=add_kuota]').val(add_kuota);
            $('#modal_addkuota').modal('show');
        });
        $(document).on('click', '#btn_addkuota1', function() {
            Swal.fire({
                title: 'Maaf!',
                text: 'Waktu Lelang Sudah Berakhir.',
                icon: 'warning',
                timer: 1500
            })
        });
        $(document).on('keyup', '#jumlah', function(e) {
            var data = $(this).val();
            var hasil = formatRupiah(data, "Rp. ");
            $(this).val(hasil);
        });
        $(document).on('keyup', '#jumlah1', function(e) {
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
    });
</script>
@endsection