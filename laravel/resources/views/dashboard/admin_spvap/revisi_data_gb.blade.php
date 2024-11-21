@extends('dashboard.admin_spvap.layout.main')
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
                            <i class="flaticon2-sheet kt-font-success"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Revisi Data
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:2%">No</th>
                                <th style="text-align: center;width:20%">&nbsp;&nbsp;Status&nbsp;Approve&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:20%">&nbsp;&nbsp;Status&nbsp;Pengerjaan&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:18%">&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:18%">Kode&nbsp;PO</th>
                                <th style="text-align: center;width:18%">&nbsp;Nama&nbsp;Supplier&nbsp;</th>
                                <th style="text-align: center;width:18%">Tanggal&nbsp;PO </th>
                                <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:18%">&nbsp;&nbsp;No.&nbsp;DTM&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:18%">&nbsp;&nbsp;Bruto&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:20%">&nbsp;&nbsp;Tara&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:20%">&nbsp;&nbsp;Netto&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:20%">Harga&nbsp;Akhir&nbsp;/Kg</th>
                                <th style="text-align: center;width:20%">Nama&nbsp;Admin</th>
                                <th style="text-align: center;width:20%">Keterangan&nbsp;Analisa</th>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(function() {
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
            ajax: "{{ route('ap.spv.revisi_data_gb_index') }}",
            columns: [{
                    data: "id_penerimaan_po",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'ckelola'
                },
                {
                    data: 'pengerjaan'
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
                    data: 'dtm_gb'
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
                    data: 'harga_akhir'
                },
                {
                    data: 'nama_admin'
                },
                {
                    data: 'keterangan_analisa'
                },

            ],
            createdRow: function(row, data, index) {

                // Updated Schedule Week 1 - 07 Mar 22

                if (data.name_bid == 'GABAH BASAH CIHERANG') {
                    $('td:eq(3)', row).css('color', '#000099'); //Original Date
                } else if (data.name_bid == 'GABAH BASAH PANDAN WANGI') {
                    $('td:eq(3)', row).css('color', '#009900'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH KETAN PUTIH') {
                    $('td:eq(3)', row).css('color', '#330019'); // Behind of Original Date
                } else if (data.name_bid == 'GABAH BASAH LONG GRAIN') {
                    $('td:eq(3)', row).css('color', '#6666FF'); // Behind of Original Date
                }
            },
            "order": []
        });
    });
</script>
<script type="text/javascript">
    function cekAnalisa(that) {
        if (that.value == "revisi") {
            document.getElementById("form_keterangan").style.display = "block";
            document.getElementById("idAdmin").style.display = "block";
        } else {
            document.getElementById("idAdmin").style.display = "none";
            document.getElementById("form_keterangan").style.display = "none";
        }
    }

    function cekAdmin(that) {
        if (that.value == "1") {
            $('textarea[id=keterangan_analisa]').val('Nopol Tidak Sesuai');
        } else {
            $('textarea[id=keterangan_analisa]').val('');
        }
    }
</script>
<script type="text/javascript">
    $(function() {
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
                    $('#formtimbangan_awal').submit();
                    Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $('body').on('click', '#btn_approverevisi', function() {
            var cek = $(this).data('id');
            console.log(cek);
            Swal.fire({
                title: 'Apakah Anda Ingin Approve Data Ini?',
                text: "Pilih Tombol 'Ya' Jika Approve untuk di revisi",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#009900',
                cancelButtonColor: '#d33',
                denyButtonColor: '#0080FF',
                confirmButtonText: 'Ya',
                showDenyButton: true,
                denyButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{url('ap/spv/approve_revisi')}}/" + cek,
                        type: "GET",
                        error: function() {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Gagal Approve Data.',
                                icon: 'error',
                                timer: 1500
                            })
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Sukses!',
                                text: 'Data anda berhasil di Approve.',
                                icon: 'success',
                                timer: 2000,
                            })
                            $('#datatable').DataTable().ajax.reload();
                        }
                    });
                } else if (result.isDenied) {
                    $.ajax({
                        url: "{{url('ap/spv/notapprove_revisi')}}/" + cek,
                        type: "GET",
                        error: function() {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Gagal Menyimpan Data.',
                                icon: 'error',
                                timer: 1500
                            })
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Sukses!',
                                text: 'Anda Berhasil Menyimpan Data.',
                                icon: 'success',
                                timer: 2000,
                            })
                            $('#datatable').DataTable().ajax.reload();
                        }
                    });
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')
                }
            });
        });
    });
</script>
@endsection