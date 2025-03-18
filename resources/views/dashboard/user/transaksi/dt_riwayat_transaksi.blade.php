@extends('dashboard.user.layout.main')
@section('title')
SURYA PANGAN SEMESTA
@endsection
@section('content')

<div class="cart_page_bg" style="background: rgb(178,172,226);
background: linear-gradient(180deg, rgba(178,172,226,1) 7%, rgba(237,236,244,1) 100%);background-size: cover;  height: max-content; border-radius: 30px; margin-top: 10%;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product_header">
                    <h3 style="color: white; font-weight: bold; text-align: center;"> RIWAYAT TRANSAKSI
                    </h3>
                </div>
            </div>
        </div>
        <div class="row g-4">
            @if($data=='[]')
            <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="position-relative bg-light rounded pt-5 pb-4 px-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle start-50 translate-middle shadow" style="width: 80px; height: 80px;">
                        <img src="{{asset('assets_user/assets/img/logo/sps_logo_new.png')}}" alt="" width="80%">
                    </div>
                    <h5 class="mt-2 mb-3">Tidak Ada Transaksi</h5>
                </div>
            </div>
            @else
            @foreach($data as $data)
            <div class="col-12 pt-4 mb-3 wow fadeInUp" data-wow-delay="0.1s">
                <div class="position-relative bg-light pt-1 pb-4 px-4" style="border-radius: 10px;">

                    <div class="d-flex flex-row align-items-center">
                        <div class="icon"><img src="{{asset('assets_user/assets/img/logo/sps_logo_new.png')}}" alt="" width="80%"> </div>
                        <div class="ms-2 c-details">
                            <h6 class="mb-0"><b>GABAH BASAH</b></h6> <span>LONG GRAIN</span>
                        </div>
                    </div>
                    <dl class="dl-horizontal row" style="font-size: smaller;">
                        <dd class="col-3">Waktu Permintaan</dd>
                        <dd class="col-1">:</dd>
                        <dd class="col-7" style="font-weight: bold;">
                            {{ \Carbon\Carbon::parse($data->date_bid)->format('d-m-Y')}}<br>
                            <h5>
                                <span class="badge bg-info">
                                    Open Lelang 08:00
                                </span>
                            </h5>
                        </dd>
                    </dl>
                    <dl class="dl-horizontal row" style="font-size: smaller;">
                        <dd class="col-3">Tanggal&nbsp;PO</dd>
                        <dd class="col-1">:</dd>
                        <dd class="col-7" style="font-weight: bold;">{{ \Carbon\Carbon::parse($data->open_po)->format('d-m-Y')}}</dd>
                    </dl>
                    <dl class="dl-horizontal row" style="font-size: smaller;">
                        <dd class="col-3">Waktu Pengajuan</dd>
                        <dd class="col-1">:</dd>
                        <dd class="col-7" style="font-weight: bold;">{{date('Y-m-d', strtotime($data->date_biduser))}}<br>
                            <h5>
                                <span class="badge bg-success">
                                    {{date('H:i:s', strtotime($data->date_biduser))}}

                                </span>
                            </h5>
                        </dd>
                    </dl>
                    <dl class="dl-horizontal row" style="font-size: smaller;">
                        <dd class="col-3">Batas Permintaan</dd>
                        <dd class="col-1">:</dd>
                        <dd class="col-7" style="font-weight: bold;">{{date('Y-m-d', strtotime($data->batas_bid))}}<br>
                            <h5>

                                <span class="badge bg-warning">Batas 12:00</span>
                            </h5>
                        </dd>
                    </dl>
                    <dl class="dl-horizontal row" style="font-size: smaller;">
                        <dd class="col-3">Jumlah Pengajuan</dd>
                        <dd class="col-1">:</dd>
                        <dd class="col-7" style="font-weight: bold;">{{$data->jumlah_kirim}} Truk</dd>
                    </dl>
                    <dl class="dl-horizontal row" style="font-size: smaller;">
                        <dd class="col-3">Jumlah Disetujui</dd>
                        <dd class="col-1">:</dd>
                        <dd class="col-7" style="font-weight: bold;">
                            @if ($data->permintaan_kirim == '')
                            <span class="btn btn-sm btn-info">Dalam Pengajuan</span>
                            @elseif ($data->permintaan_kirim == '0')
                            <span class="btn btn-sm btn-danger">0 Truk</span>
                            @else
                            <a id="btn_klik" href="{{route('user.data_list_po', ['id' => $data->id_biduser])}}" name="{{$data->id_approvebid}}" title="Lihat PO" class="lihat_po btn btn-info btn-sm">
                                <i class=""> </i> {{$data->permintaan_kirim}} Truk
                            </a>
                            @endif
                        </dd>
                    </dl>
                    <dl class="dl-horizontal row" style="font-size: smaller;">
                        <dd class="col-3">Status</dd>
                        <dd class="col-1">:</dd>
                        <dd class="col-7" style="font-weight: bold;">
                            @if ($data->status_biduser == 1)
                            <a id="btn_disetujui" name="' . $data->user_id . '" data-jumlahkirim="' . $data->jumlah_kirim . '" data-idnyabid="' . $data->id_bid . '" title="Disetujui" class=" btn btn-sm btn-success">
                                <i class="bi bi-check"> Disetujui </i>
                            </a>
                            @elseif ($data->status_biduser == 5)
                            <a id="btn_ditolak" name="" title="Ditolak" class=" btn btn-sm btn-danger">
                                <i class="bi bi-dash"> Ditolak </i>
                            </a>
                            @elseif ($data->status_biduser == 3)
                            <a id="btn_disetujui" name="' . $data->user_id . '" data-jumlahkirim="' . $data->jumlah_kirim . '" data-idnyabid="' . $data->id_bid . '" title="Disetujui" class=" btn btn-sm btn-success">
                                <i class="bi bi-check"> Disetujui </i>
                            </a>
                            @elseif ($data->status_biduser == 4)
                            <a name="' . $data->id_biduser . '" title="Pengiriman Telat" class="btn btn-sm btn-warning">
                                <i class="bi bi-clipboard-minus-fill"> Proses Pengiriman Telat </i>
                            </a>
                            @elseif ($data->status_biduser == 0)
                            <a id="btn_pengajuan" title="Proses lelang" class=" btn btn-sm btn-info">
                                <i class="bi bi-arrow-clockwise"> Pengajuan </i>
                            </a>
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>
            @endforeach
            @endif
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
            searching: false,
            filter: false,
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