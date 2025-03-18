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
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet ">
                <div class="">
                    <!--begin::Accordion-->
                    @if(Auth::guard('lab')->user()->level=='QC')
                    <div class="accordion  accordion-toggle-arrow" id="accordionExample4">
                        <div class="card">
                            <div class="card-header" id="headingOne4">
                                <div class="card-title" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseOne4">
                                    <i class="flaticon2-add kt-font-info"></i> Tambah Harga Bawah
                                </div>
                            </div>
                            <div id="collapseOne4" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample4">
                                <div class="card-body">
                                    <form class="kt-form" id="formhargabawah" action="javascript:void(0);" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-wizard-v4__form">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="kt-section__body">
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Harga Bawah</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="text" class="form-control" required id="harga_bawah" name="harga_bawah" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Tanggal PO</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="date" class="form-control" required id="waktu_harga_bawah" name="waktu_harga_bawah" value="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-form__actions">
                                                    <button id="btn_save" class="btn btn-success m-btn pull-right" style="">Save</button>
                                                </div><br>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif(Auth::guard('lab')->user()->level=='MANAGER')
                    @endif
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
                            Data Harga Bawah
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    @if(Auth::guard('lab')->user()->level=='QC')
                    <table class="table table-bordered" id="table-harga-bawah">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:2%">No</th>
                                <th style="text-align: center;width:auto">Harga Bawah</th>
                                <th style="text-align: center;width:auto">Tanggal PO </th>
                                <th style="text-align: center;width:auto">Action</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                        </tbody>
                    </table>
                    @elseif(Auth::guard('lab')->user()->level=='MANAGER')
                    <table class="table table-bordered" id="table-harga-bawah1">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:2%">No</th>
                                <th style="text-align: center;width:auto">Harga Bawah</th>
                                <th style="text-align: center;width:auto">Tanggal PO </th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="formupdatehargabawah" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('qc.lab.update_harga_bawah_gabah_basah') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Bottom Price</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_harga_bawah_update" id="id_harga_bawah_update" value="">
                            <div class="form-group">
                                <div class="">
                                    <label>Bottom Price</label>
                                    <input id="harga_bawah_update" required name="harga_bawah_update" placeholder="" type="text" class="form-control m-input" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Date</label>
                                    <input id="waktu_harga_bawah_update" required name="waktu_harga_bawah_update" placeholder="" type="date" class="form-control m-input" value="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="btn_update" class="btn btn-success m-btn pull-right">Update</button>
                            </div>
                    </form>
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
    $(function() {
        var table = $('#table-harga-bawah').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('qc.lab.harga_bawah_gabah_basah_index') }}",
            columns: [{
                    data: "id_harga_bawah",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'harga_bawah'
                },
                {
                    data: 'waktu_harga_bawah'
                },
                {
                    data: 'ckelola'
                },


            ],
            "order": []
        });
        var table = $('#table-harga-bawah1').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('qc.lab.harga_bawah_gabah_basah_index') }}",
            columns: [{
                    data: "id_harga_bawah",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'harga_bawah'
                },
                {
                    data: 'waktu_harga_bawah'
                },


            ],
            "order": []
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).on('keyup', '#harga_bawah_update', function(e) {
        var data = $(this).val();
        var hasil = formatRupiah(data, "Rp. ");
        $(this).val(hasil);
    });
    $(document).on('keyup', '#harga_bawah', function(e) {
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
    $(document).ready(function() {
        $(document).on('click', '#btn_save', function(e) {
            e.preventDefault();
            $('#btn_save').html('Menyimpan...');
            var harga_bawah = replace_titik($('#harga_bawah').val());
            var waktu_harga_bawah = $('#waktu_harga_bawah').val();
            Swal.fire({
                title: 'Konfirmasi',
                icon: 'warning',
                text: "Apakah data yang kamu input sudah benar ?",
                showCancelButton: true,
                inputValue: 0,
                confirmButtonText: 'Yes',
            }).then(function(result) {
                if ($('#waktu_harga_bawah').val() == '' || $('#harga_bawah').val() == '') {
                    $("#formhargabawah").trigger('reset');
                    $('#btn_save').html('Simpan');
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
                                        harga_bawah: harga_bawah,
                                        waktu_harga_bawah: waktu_harga_bawah,
                                    },
                                    url: "{{route('qc.lab.store_harga_bawah_gabah_basah')}}",
                                    type: "POST",
                                    dataType: 'json',
                                    success: function(data) {
                                        $('#table-harga-bawah').DataTable().ajax.reload();
                                        $("#formhargabawah").trigger('reset');
                                        $('#btn_save').html('Simpan');
                                        Swal.fire({
                                            title: 'success',
                                            text: 'Data Berhasil DiSimpan',
                                            icon: 'success',
                                            timer: 1500
                                        })

                                    },
                                    error: function(data) {
                                        $("#formhargabawah").trigger('reset');
                                        $('#btn_save').html('Simpan');
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
                        $("#formhargabawah").trigger('reset');
                        $('#btn_save').html('Simpan');
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
    });
    $(document).ready(function() {
        $(document).on('click', '#btn_update', function(e) {
            e.preventDefault();
            $('#btn_update').html('Menyimpan...');
            var harga_bawah_update = replace_titik($('#harga_bawah_update').val());
            var id_harga_bawah_update = $('#id_harga_bawah_update').val();
            var waktu_harga_bawah_update = $('#waktu_harga_bawah_update').val();
            Swal.fire({
                title: 'Konfirmasi',
                icon: 'warning',
                text: "Apakah data yang kamu input sudah benar ?",
                showCancelButton: true,
                inputValue: 0,
                confirmButtonText: 'Yes',
            }).then(function(result) {
                if ($('#waktu_harga_bawah_update').val() == '' || $('#harga_bawah_update').val() == '') {
                    Swal.fire({
                        title: 'Info !!',
                        text: 'Data Harus Terisi Semua',
                        icon: 'warning',
                        timer: 1500
                    })
                    $("#formupdatehargabawah").trigger('reset');
                    $('#btn_update').html('Simpan');
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
                                        id_harga_bawah_update: id_harga_bawah_update,
                                        harga_bawah_update: harga_bawah_update,
                                        waktu_harga_bawah_update: waktu_harga_bawah_update,
                                    },
                                    url: "{{route('qc.lab.update_harga_bawah_gabah_basah')}}",
                                    type: "POST",
                                    dataType: 'json',
                                    success: function(data) {
                                        $('#table-harga-bawah').DataTable().ajax.reload();
                                        $('#modal1').modal('hide');
                                        $('#btn_update').html('Simpan');
                                        Swal.fire({
                                            title: 'success',
                                            text: 'Data Berhasil DiSimpan',
                                            icon: 'success',
                                            timer: 1500
                                        })

                                    },
                                    error: function(data) {
                                        $("#formupdatehargabawah").trigger('reset');
                                        $('#btn_update').html('Simpan');
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
                        $("#formupdatehargabawah").trigger('reset');
                        $('#btn_update').html('Simpan');
                        Swal.fire({
                            title: 'Cancelled!',
                            text: 'Your data is safe :',
                            icon: 'error',
                            timer: 1500
                        })

                    }
                }
            });
        });
    });
    $('body').on('click', '#btn_delete', function() {
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
                $.ajax({
                    url: "{{route('qc.lab.destroy_harga_bawah_gabah_basah')}}/" + cek,
                    type: "GET",
                    error: function() {
                        alert('Something is wrong');
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'Terhapus!',
                            text: 'Data anda berhasil di hapus.',
                            icon: 'success',
                            timer: 1500
                        })
                        $('#table-harga-bawah').DataTable().ajax.reload();
                    }
                });
            } else {
                Swal.fire({
                    title: 'Cancelled!',
                    text: 'Your data is safe :',
                    icon: 'error',
                    timer: 1500
                })
            }
        });

    });
    $(document).on('click', '.to_harga_bawah', function() {
        var id = $(this).attr("name");
        var url = "{{route('qc.lab.show_harga_bawah_gabah_basah')}}" + "/" + id;
        console.log(url);
        $.ajax({
            type: "GET",
            url: url,
            success: function(response) {
                console.log(response);
                var parsed = $.parseJSON(response);
                $('#id_harga_bawah_update').val(parsed.id_harga_bawah_gb);
                $('#harga_bawah_update').val(parsed.harga_bawah_gb);
                $('#waktu_harga_bawah_update').val(parsed.waktu_harga_bawah_gb);
                console.log(parsed.harga_bawah);
            }
        });
    });
</script>
@endsection