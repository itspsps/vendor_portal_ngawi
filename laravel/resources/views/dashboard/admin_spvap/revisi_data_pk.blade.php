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
                    PT. SURYA PANGAN SEMESTA
                </h3>
                <span class="btn-outline btn-sm btn-info mr-3">NGAWI</span>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        Approve Data Revisi
                    </a>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        Beras PK
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
                            <i class="flaticon2-sheet kt-font-warning"></i>
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
                                <th style="text-align: center;width:2%">&nbsp;Site&nbsp;</th>
                                <th style="text-align: center;width:18%">Kode&nbsp;PO</th>
                                <th style="text-align: center;width:18%">&nbsp;Nama&nbsp;Supplier&nbsp;</th>
                                <th style="text-align: center;width:18%">Tanggal&nbsp;PO </th>
                                <th style="text-align: center;width:18%">&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:18%">&nbsp;&nbsp;Bruto&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:20%">&nbsp;&nbsp;Tara&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:20%">&nbsp;&nbsp;Netto&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:20%">Harga&nbsp;Akhir&nbsp;/Kg</th>
                                <th style="text-align: center;width:20%">Keterangan&nbsp;Harga</th>
                                <th style="text-align: center;width:20%">Nama&nbsp;Admin</th>
                                <th style="text-align: center;width:20%">Keterangan&nbsp;Analisa</th>
                                <th style="text-align: center;width:20%">&nbsp;&nbsp;Status&nbsp;&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="formtimbangan_awal" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{route('ap.data_pembelian_update')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Data Verifikasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_penerimaan_po" id="id_penerimaan_po" value="">
                            <div class="form-group">
                                <div class="">
                                    <label>Kode PO</label>
                                    <input id="penerimaan_kode_po" readonly name="penerimaan_kode_po" type="text" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Analisa</label>
                                    <div class="kt-radio-inline">
                                        <label class="kt-radio">
                                            <input type="radio" value="verified" id="verified" onchange="cekAnalisa(this);" class="form-control m-input" name="analisa"> Verifikasi
                                            <span></span>
                                        </label>
                                        <label class="kt-radio">
                                            <input type="radio" value="revisi" id="revisi" onchange="cekAnalisa(this);" class="form-control m-input" name="analisa"> Revisi
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="idAdmin" style="display: none;">
                                <div class="">
                                    <label>Nama Admin</label>
                                    <div class="kt-radio-inline">
                                        <label class="kt-radio">
                                            <input type="radio" value="1" id="satpam" onchange="cekAdmin(this);" class="form-control m-input" name="namaadmin"> Admin Satpam
                                            <span></span>
                                        </label></br>
                                        <label class="kt-radio">
                                            <input type="radio" value="2" id="timbangan" onchange="cekAdmin(this);" class="form-control m-input" name="namaadmin"> Admin Timbangan
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="form_keterangan" style="display: none;">
                                <div class="">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" id="keterangan_analisa" name="keterangan_analisa"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                            <button id="btn_save" type="submit" class="btn btn-success m-btn pull-right">Save</button>
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
            ajax: "{{ route('ap.spv.revisi_data_pk_index') }}",
            columns: [{
                    data: "id_penerimaan_po",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'site_admin'
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
                    data: 'harga_akhir'
                },
                {
                    data: 'keterangan_harga_akhir_pk'
                },
                {
                    data: 'nama_admin'
                },
                {
                    data: 'keterangan_analisa'
                },
                {
                    data: 'ckelola'
                },

            ],
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
        $(document).on('click', '.to_show', function() {
            var id = $(this).attr("name");
            // console.log(id);
            var url = "{{ route('ap.data_pembelian_show') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    // console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_penerimaan_po').val(parsed.id_penerimaan_po);
                    $('#penerimaan_kode_po').val(parsed.penerimaan_kode_po);
                }
            });
        });
    });
</script>
@endsection