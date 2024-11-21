@extends('dashboard.user.layout.main1')
@section('title')
SURYA PANGAN SEMESTA
@endsection
@section('content')

<div class="cart_page_bg" style=" background-image: url('public/assets_user/assets/img/slider/bg_sawah.jpg');background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product_header">
                    <div class="section_title s_title_style3">
                        <ul class="nav" role="tablist">
                            <li>
                                <a class="btn btn-outline-danger" style="background-color: #4D006E;" data-toggle="tab" href="/" role="tab" aria-controls="kediri" aria-selected="false">
                                    <span style="color: white;">
                                        <i class="fa fa-history"></i>&nbsp;RIWAYAT TRANSAKSI
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="shopping_cart_area">
            <form action="#">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="cart_page" style="display: block; overflow-x: auto; white-space: nowrap;">
                                <table class="table table-bordered table-striped" style="width: 100%" id="datatable">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;font-weight:bold">No</th>
                                            <th style="text-align: center;font-weight:bold">Jenis</th>
                                            <th style="text-align: center;font-weight:bold">Site</th>
                                            <th style="text-align: center;font-weight:bold">Waktu Permintaan</th>
                                            <th style="text-align: center;font-weight:bold">Tanggal PO</th>
                                            <th style="text-align: center;font-weight:bold">Waktu Pengajuan</th>
                                            <th style="text-align: center;font-weight:bold">Batas Penerimaan</th>
                                            <th style="text-align: center;font-weight:bold">Jumlah Pengajuan</th>
                                            <th style="text-align: center;font-weight:bold">Jumlah&nbsp;Disetujui</th>
                                            <th style="text-align: center;font-weight:bold">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center;font-family: Times New Roman">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal_body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="modal_right">
                                <div class="variants_selects modal_add_to_cart">
                                    <h4 style="text-align: center">PENGAJUAN ANDA TELAH DISETUJUI</h4>
                                    <form action="#">
                                        <div class="variants_size">
                                            <h2>Jumlah Pengajuan</h2>
                                            <input type="hidden" id="idnyabid"></input>
                                            <input type="text" style="width: 100%" name="jumlah_pengajuan" id="jumlah_pengajuan" readonly>
                                        </div>
                                        <div class="variants_size">
                                            <h2>Jumlah yang disetui</h2>
                                            <input type="text" style="width: 100%" name="permintaan_kirim" id="permintaan_kirim" readonly>
                                        </div>
                                        <div class="variants_color">
                                            <h2>Pesan</h2>
                                            <input type="text" style="width: 100%" name="message_admin" id="message_admin" readonly>
                                        </div>
                                        <div class="variants_color">
                                            <h2>Batas Penerimaan</h2>
                                            <input type="text" style="width: 100%" name="batas_penerimaan" id="batas_penerimaan" readonly>
                                        </div>
                                        <br>
                                        <div class="modal_add_to_cart">
                                            <a href="" id="cetak_po"></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_pengajuan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal_body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="modal_right">
                                <div class="variants_selects modal_add_to_cart">
                                    <h4 style="text-align: center">PENGAJUAN ANDA DALAM PROSES</h4>
                                    <form action="#">
                                        <div class="variants_size text-center">
                                            <h2>MOHON DITUNGGU, TERIMAKASIH</h2>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_disetujui" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal_body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="modal_right">
                                <div class="variants_selects modal_add_to_cart">
                                    <h4 style="text-align: center">PO ANDA SUDAH DI SETUJUI</h4>
                                    <form action="#">
                                        <div class="variants_size text-center">
                                            <h2>TERIMAKASIH</h2>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_lihat_po" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal_body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="modal_right">
                                <div class="variants_selects modal_add_to_cart">
                                    <h4 style="text-align: center">PENGAJUAN ANDA DALAM PROSES</h4>
                                    <form action="#">
                                        <div class="variants_size text-center">
                                            <h2>MOHON DITUNGGU, TERIMAKASIH</h2>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).on('click', '#btn_list_po', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
    });
    $(document).on('click', '#btn_profil', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
    });
    $(document).on('click', '#btn_akun', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
    });
</script>
<script>
    $(document).on('click', '#btn_home', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
    });
</script>
<script>
    $(function() {
        var table = $('#datatable').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
            "iDisplayLength": 5,
            ajax: "{{ route('user.transaksi_index') }}",
            columns: [{
                    data: "id_biduser",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                        console.log(data);
                    }
                },
                {
                    data: 'name_bid',
                },
                {
                    data: 'lokasi',
                },
                {
                    data: 'date_bid'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'waktu_pengajuan'
                },
                {
                    data: 'batas_po'
                },
                {
                    data: 'jumlah_kirim'
                },
                {
                    data: 'jumlah_disetujui'
                },
                {
                    data: 'status_biduser'
                },


            ],
            "order": []
        });
    });
</script>
<script type="text/javascript">
    $(function() {

        $(document).on('click', '#btn_pengajuan', function() {
            Swal.fire({
                title: 'Mohon Ditunggu',
                text: 'Pengajuan Anda Sedang Kami Proses',
                icon: 'warning',
                timer: 1500
            })
        });
        $(document).on('click', '#btn_disetujui', function() {
            Swal.fire({
                title: 'Berhasil',
                text: 'PO Anda Sudah Disetujui',
                icon: 'success',
                timer: 1500
            })
        });
        $(document).on('click', '#btn_ditolak', function() {
            Swal.fire({
                title: 'Ditolak',
                text: 'PO Anda Ditolak',
                icon: 'error',
                timer: 1500
            })
        });
        $(document).on('click', '.toshow', function() {
            var id = $(this).attr("name");
            var idnyabid = $(this).data('idnyabid');
            var jumlahkirim = $(this).data('jumlahkirim');
            var url = "{{ route('user.detail_pengajuan') }}" + "/" + idnyabid;
            // console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    var parsed = $.parseJSON(response);
                    // console.log(response);
                    $('#jumlah_pengajuan').val(jumlahkirim + ' Truk');
                    $('#permintaan_kirim').val(parsed.permintaan_kirim + ' Truk');
                    $('#message_admin').val(parsed.message_admin);
                    $('#batas_penerimaan').val(parsed.batas_penerimaan);
                    $('#idnyabid').val(idnyabid);
                    $('#cetak_po').html('<a class="btn btn-danger" style="width: 100%" href="user/data_list_po/' + idnyabid + '" title="Data PO">Data PO</a>');
                }
            });
        });
        $(document).on('click', '.lihat_po', function() {
            var id = $(this).attr("name");
            var url = "{{ route('user.detail_pengajuan') }}" + "/" + id;
            // console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    var parsed = $.parseJSON(response);
                    // console.log(response);
                    $('#jumlah_pengajuan').val(jumlahkirim + ' Truk');
                    $('#permintaan_kirim').val(parsed.permintaan_kirim + ' Truk');
                    $('#message_admin').val(parsed.message_admin);
                    $('#batas_penerimaan').val(parsed.batas_penerimaan);
                    $('#idnyabid').val(idnyabid);
                    $('#cetak_po').html('<a class="btn btn-danger" target="_blank" style="width: 100%" href="user/data_list_po/' + idnyabid + '" title="Data PO">Data PO</a>');
                }
            });
        });
    });
</script>
@endsection