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
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="kt-portlet kt-callout kt-callout--brand kt-callout--diagonal-bg">
                        <div class="kt-portlet__body">
                            <div class="kt-callout__body">
                                <div class="kt-callout__content">
                                    <h3 class="kt-callout__title">Tidak ada proses lab</h3>
                                    <p class="kt-callout__desc">
                                        Gabah Kering
                                    </p>
                                </div>
                                <div class="kt-callout__action">
                                    <a href="#" data-toggle="modal" data-target="#kt_chat_modal" class="btn btn-custom btn-bold btn-upper btn-font-sm  btn-brand">SPS</a>
                                </div>
                            </div>
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
            ajax: "{{ route('master.lab.proses_lab1_gabah_kering_index') }}",
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