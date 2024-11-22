@extends('dashboard.superadmin.layout.main')
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
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        SURYA PANGAN SEMESTA
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
                            <i class="flaticon-user"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            List Data PO
                        </h3>
                    </div>
                    <div class="">
                        <button type="button" name="btn_export" id="btn_export" class="btn btn-success"><i class="fa fa-file-excel"></i>Excel</button>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <input type="hidden" id="id_bid" name="id_bid" value="{{$id_bid}}">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th style="text-align: center;">No</th>
                                <th style="text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;">&nbsp;Nama&nbsp;Supplier&nbsp;</th>
                                <th style="text-align: center;">&nbsp;Tanggal&nbsp;PO&nbsp;</th>
                                <th style="text-align: center;">Kode&nbsp;PO</th>
                                <th style="text-align: center;">Nopol&nbsp;Kendaraan</th>
                                <th style="text-align: center;">&nbsp;&nbsp;Status&nbsp;PO&nbsp;&nbsp;</th>
                                <th style="text-align: center;">&nbsp;&nbsp;Cetak&nbsp;PO&nbsp;&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalpending" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" style="text-align: right; margin-right:3px" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <form id="form_konfirmasi_bongkar" method="POST" action="{{route('sourching.konfirmasi_bongkar')}}">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="modal_body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="modal_right">
                                        <div class="variants_selects modal_add_to_cart">
                                            <h2 style="text-align: center">Informasi Harga Gabah Incoming</h2>
                                            <div class="variants_size" style="text-align: center">
                                                <h3 style="color: #9c0911;" id="status"></h3>
                                                <h3 style="color: #9c0911;text-decoration: underline;" id="lokasi_bongkar"></h3>
                                            </div>
                                            <input type="hidden" id="id_datapo" name="id_datapo" value="">
                                            <div class="variants_size" style="text-align: center">
                                                <input type="hidden" id="PONum" name="PONum" value="">
                                                <input type="hidden" id="harga" name="harga" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal_footer">
                        <div class="col-lg-12 text-center">
                            <button type="submit" name="bongkar" value="bongkar" class="btn btn-success">Bongkar</button>
                            <button type="submit" name="bongkar" value="tidak" class="btn btn-info">Tidak&nbsp;Bongkar</button>
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- end:: Content -->
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $(function() {
            var id = $('#id_bid').val();
            // console.log(id);
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
                ajax: "{{ route('sourching.data_list_index') }}/" + id,
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
                        data: 'tanggal_po'
                    },
                    {
                        data: 'kode_po'
                    },
                    {
                        data: 'nopol'
                    },
                    {
                        data: 'status',
                    },
                    {
                        data: 'cetak'
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
        });
    });
    $('#btn_export').click(function() {
        var id_bid = $('#id_bid').val();
        $.ajax({
            data: {
                "_token": "{{ csrf_token() }}",
                id_bid: id_bid,
            },
            url: "{{route('sourching.download_data_pesanan_pemebelian_aol')}}",
            type: "POST",
            cache: false,
            xhrFields: {
                responseType: 'blob'
            },
            error: function() {
                alert('Something is wrong');
            },
            success: function(data, status, xhr) {
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(data);
                link.download = `DATA PESANAN PEMBELIAN GABAH BASAH NGAWI.xlsx`;
                link.click();

            }
        });
    });
    $(document).on('click', '#btn_lihat_harga', function() {
        var id = $(this).data("id");
        var hp = $(this).data("hp");
        var ponum = $(this).data("ponum");
        var supplier = $(this).data("supplier");
        var nopol = $(this).data("nopol");
        var nomer_hp = hp.replace(/^./, '62');
        var url = "{{ route('sourching.status_pending')}}" + "/" + id;
        // console.log(supplier);
        $.ajax({
            type: "GET",
            url: url,
            success: function(response) {
                var parsed = $.parseJSON(response);
                console.log(parsed);
                $('#modalpending').modal('show');
                $('#status').text('Rp. ' + formatRupiah(parsed.plan_harga_gb) + ' /Kg');
                $('#id_datapo').val(parsed.lab1_id_data_po_gb);
                $('#harga').val(parsed.plan_harga_gb);
                $('#PONum').val(ponum);
            }
        });
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
</script>
@endsection