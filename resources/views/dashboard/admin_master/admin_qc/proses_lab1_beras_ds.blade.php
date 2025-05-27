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
                            <i class="kt-menu__link-icon   flaticon2-laptop kt-font-danger"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Lab 1 Beras DS
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:2%">No</th>
                                <th style="text-align: center;width:auto">Waktu&nbsp;Sampai</th>
                                <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Asal&nbsp;</th>
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

    <!-- end:: Content -->
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    function yesnoCheck(that) {
        if (that.value == "Unload") {
            Swal.fire({
                position: 'top',
                icon: 'warning',
                title: 'Pilih Lokasi Bongkar',
                showConfirmButton: true
            });
            document.getElementById("ifYes").style.display = "block";
        } else {
            document.getElementById("ifYes").style.display = "none";
        }
    }
</script>
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
            ajax: "{{ route('master.lab.proses_lab1_beras_ds_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'waktu_penerimaan'
                },
                {
                    data: 'kode_po'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'nama_vendor'
                },
                {
                    data: 'plat_kendaraan'
                },
                {
                    data: 'keterangan_penerimaan_po'
                },
                {
                    data: 'ckelola'
                }

            ],
            "order": []
        });
    });
</script>
@endsection