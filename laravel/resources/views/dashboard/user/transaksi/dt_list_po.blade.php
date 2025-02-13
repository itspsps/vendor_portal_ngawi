@extends('dashboard.user.layout.main1')
@section('title')
SURYA PANGAN SEMESTA
@endsection
@section('content')

<div class="cart_page_bg" style=" background-image: url('https://ngawi.suryapangansemesta.store/public/assets_user/assets/img/slider/bg_sawah.jpg');background-size: cover;">
    <div class="container mb-3">
        <div class="row">
            <div class="col-12">
                <div class="product_header">
                    <div class="section_title s_title_style3">
                        <ul class="nav" role="tablist">
                            <li>
                                <a class="btn btn-outline-danger" style="background-color: #4D006E;" data-toggle="tab" href="/" role="tab" aria-controls="kediri" aria-selected="false">
                                    <span style="color: white;">
                                        <i class="fa fa-money"></i> DATA LIST PO
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if($data=='[]')
            <div class="col-md-10 mx-auto">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <div class="icon"><img style="border-radius: 20%;" src="{{asset('img/logosps.png')}}" alt="" width="100%"> </div>
                            <div class="ms-2 c-details">
                                <h6 class="mb-0"><b>PT. SURYA PANGAN SEMESTA NGAWI</b></span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 mx-auto">
                        <h4><span>Tidak Ada Transaksi</span></h4>
                    </div>
                </div>
            </div>
            @else
            @foreach($data as $data)
            <div class="col-md-6">
                @if($data->status_bid >= '3' && $data->status_bid != '5' && $data->status_bid != '16')
                <div class="card p-3 mb-2" style="background-color: #dffde0;">

                    <img style="transform: rotate(-0.10turn); margin-top: -15px; position: absolute;top: 0;right: 0; float:right" src="{{asset('img/stempel.png')}}" alt="" width="25%">
                    @elseif($data->status_bid == '5')
                    <div class="card p-3 mb-2" style="background-color: #fed1d1;">
                        <img style="transform: rotate(-0.10turn); margin-top: -15px; position: absolute;top: 0;right: 0; float:right" src="{{asset('img/stempel_close_ngawi.png')}}" alt="" width="25%">
                        @else
                        <div class="card p-3 mb-2">
                            @endif
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="icon"><img style="border-radius: 20%;" src="{{asset('img/logosps.png')}}" alt="" width="100%"> </div>
                                    <div class="ms-2 c-details">
                                        <h6 class="mb-0"><b>{{$data->name_bid}}</b></h6> <span>{{ \Carbon\Carbon::parse($data->open_po)->format('d-m-Y')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td class="first_child">Site</td>
                                            <td class="first_child">:</td>
                                            <td>NGAWI</td>
                                        </tr>
                                        <tr>
                                            <td class="first_child">No. Po</td>
                                            <td class="first_child">:</td>
                                            <td>{{$data->kode_po}}</td>
                                        </tr>
                                        <tr>
                                            <td class="first_child">Status</td>
                                            <td class="first_child">:</td>
                                            <td>
                                                @if ( $data->status_bid == 1 )
                                                <a style="margin:2px;background-color:yellow" id="btn_pengiriman" name="{{$data->kode_po}}" title="Proses Pengiriman" class="btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-truck" style="color:red;"></i> <span style="color: red">Proses Pengiriman</span>
                                                </a>
                                                @elseif ($data->status_bid == 2)
                                                <a style="margin:2px;background-color:#04B431" name="{{$data->kode_po}}" title="Ditolak" class="toshow btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="" style="color:white;">Ditolak</i>
                                                </a>
                                                @elseif ($data->status_bid == 3)
                                                <a style="margin:2px;background-color:#D3D3D3" id="btn_antrian" name="{{$data->kode_po}}" title="Menunggu Antrian Bongkar" class="toshow btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-id-card" style="color:black;">&nbsp;Menunggu&nbsp;Antrian</i>
                                                </a>
                                                @elseif ($data->status_bid == 4)
                                                <a style="margin:2px;background-color:#FF0000" name="{{$data->kode_po}}" title="Pengiriman Telat" class="toshow btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-minus" style="color:white;"> Pengiriman&nbsp;Terlambat</i>
                                                </a>
                                                @elseif ($data->status_bid == 5)
                                                <a style="margin:2px;background-color:#FF0000" name="{{$data->kode_po}}" title="Reject" class="toshow btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-minus" style="color:white;"> Tolak</i>
                                                </a>
                                                @elseif ($data->status_bid == 6)
                                                <a style="margin:2px;background-color:#D3D3D3" id="btn_antrian" name="{{$data->kode_po}}" title="Menunggu Antrian Bongkar" class="toshow btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-id-card" style="color:black;">&nbsp;Menunggu&nbsp;Antrian</i>
                                                </a>
                                                @elseif ($data->status_bid == 7)
                                                <a style="margin:2px;background-color:#D3D3D3" id="btn_antrian" name="{{$data->kode_po}}" title="Menunggu Antrian Bongkar" class="toshow btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-id-card" style="color:black;">&nbsp;Menunggu&nbsp;Antrian</i>
                                                </a>
                                                @elseif ($data->status_bid == 8)
                                                <a style="margin:2px;background-color:#feaa47" id="btn_bongkar" name="{{$data->kode_po}}" title="Proses Bongkar" class="toshow btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-cogs" style="color:black;">&nbsp;Proses&nbsp;Bongkar</i>
                                                </a>
                                                @elseif ($data->status_bid == 9)
                                                <a style="margin:2px;background-color:#feaa47;" id="btn_bongkar" name="{{$data->kode_po}}" title="Proses Bongkar" class="toshow btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-cogs" style="color:black;">&nbsp;Proses&nbsp;Bongkar</i>
                                                </a>
                                                @elseif ($data->status_bid == 10)
                                                <a style="margin:2px;background-color:#feaa47;" id="btn_bongkar" name="{{$data->kode_po}}" title="Proses Bongkar" class="toshow btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-cogs" style="color:black;">&nbsp;Proses&nbsp;Bongkar</i>
                                                </a>
                                                @elseif ($data->status_bid == 11)
                                                <a style="margin:2px;background-color:#feaa47;" name="{{$data->kode_po}}" title="Proses Bongkar" class="toshow btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-cogs" style="color:black;">&nbsp;Proses&nbsp;Bongkar</i>
                                                </a>
                                                @elseif ($data->status_bid == 12)
                                                <a style="margin:2px;background-color:#04B431	" name="{{$data->kode_po}}" title="Selesai Bongkar" class="toshow btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-check-circle" style="color:black;">&nbsp;Selesai&nbsp;Bongkar</i>
                                                </a>
                                                @elseif ($data->status_bid == 13)
                                                <a style="margin:2px;background-color:#F0F8FF;" id="btn_pembayaran" name="{{$data->kode_po}}" title="Pembayaran" class="toshow btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-money" style="color:green;">&nbsp;Pembayaran</i>
                                                </a>
                                                @elseif ($data->status_bid == 16)
                                                <a style="margin:2px;background-color:#FFCC99;" name="{{$data->id_data_po}}" title="Pending" data-ponum="{{$data->PONum}}" class="toshowpending btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-spinner" style="color:green;"> Pending Harga</i>
                                                </a>
                                                @endif
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="first_child">Tanggal Kedatangan </td>
                                            <td class="first_child">:</td>
                                            @if($data->waktu_penerimaan=='' || $data->waktu_penerimaan==NULL)
                                            <td> - </td>
                                            @else
                                            <td>{{Carbon\Carbon::parse($data->waktu_penerimaan)->format('d-m-Y')}}<br><span class="btn-success">{{Carbon\Carbon::parse($data->waktu_penerimaan)->format('H:i:s')}}</span></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="first_child">Batas Kedatangan </td>
                                            <td class="first_child">:</td>
                                            <td>{{Carbon\Carbon::parse($data->batas_bid)->format('d-m-Y')}}<br><span class="btn-warning">12:00 WIB</span></td>
                                        </tr>
                                        <tr>
                                            <td class="first_child">Asal Gabah </td>
                                            <td class="first_child">:</td>
                                            @if($data->keterangan_penerimaan_po=='' || $data->keterangan_penerimaan_po==NULL)
                                            <td> - </td>
                                            @else
                                            <td>{{$data->keterangan_penerimaan_po}}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="first_child">Nopol</td>
                                            <td class="first_child">:</td>
                                            @if($data->plat_kendaraan=='' || $data->plat_kendaraan==NULL)
                                            <td> - </td>
                                            @else
                                            <td>{{$data->plat_kendaraan}}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="first_child">Qty</td>
                                            <td class="first_child">:</td>
                                            @if($data->hasil_akhir_tonase=='' || $data->hasil_akhir_tonase==NULL)
                                            <td> - </td>
                                            @else
                                            <td> {{rupiah($data->hasil_akhir_tonase)}} Kg</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="first_child">Harga</td>
                                            <td class="first_child">:</td>
                                            @if($data->aksi_harga_gb=='DEAL')
                                            <td>
                                                <h3> <span class="badge bg-success">{{rupiah($data->harga_akhir_gb)}} /Kg</span></h3>
                                            </td>
                                            @else
                                            <td> - </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="first_child">Keterangan</td>
                                            <td class="first_child">:</td>
                                            @if($data->status_bid=='5')
                                            <td>
                                                <a style="margin:2px;background-color:#9c0911" id="btn_ditolak" name="" title="Ditolak" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-minus" style="color:white;"> Ditolak </i>
                                                </a>
                                            </td>
                                            @elseif($data->status_bid=='16')
                                            <td>
                                                <a style="margin:2px;background-color:#feaa47;" id="btn_dipending" name="" title="Dipending" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-spinner" style="color:white;"> Pending </i>
                                                </a>
                                            </td>
                                            @else
                                            <td>
                                                <a style="margin:2px;background-color:#04B431" id="btn_disetujui" name="' . $list->user_id . '" data-jumlahkirim="' . $list->jumlah_kirim . '" data-idnyabid="' . $list->id_bid . '" title="Disetujui" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="" style="color:white;"> Disetujui </i>
                                                </a>
                                            </td>

                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="first_child">Bukti PO</td>
                                            <td class="first_child">:</td>
                                            <td>
                                                @if ($data->status_bid == 5)
                                                <a href="{{url('user/cetak_po',$data->id_data_po)}}" target="_blank" onclick="return false;" style="margin:2px;background-color:#9c0911" name="" title="Cetak PO" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-print" style="color:white;"> Cetak PO </i>
                                                </a>
                                                <a href="{{url('user/scan_po',$data->id_data_po)}}" target="_blank" onclick="return false;" style="margin:2px;background-color:#9c0911" name="" title="Scan PO" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-barcode" style="color:white;"> Scan PO </i>
                                                </a>
                                                @else
                                                <a href="{{url('user/cetak_po',$data->id_data_po)}}" style="margin:2px;background-color:#9c0911" name="" title="Cetak PO" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-print" style="color:white;"> Cetak PO </i>
                                                </a>
                                                <a href="{{url('user/scan_po',$data->id_data_po)}}" target="_blank" style="margin:2px;background-color:#9c0911" name="" title="Scan PO" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="fa fa-barcode" style="color:white;"> Scan PO </i>
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="mt-5">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php if ($data->permintaan_kirim == NULL) { ?> 0% <?php } elseif ($data->jumlah_kirim == $data->permintaan_kirim) { ?>100% <?php } else { ?>75% <?php } ?>" aria-valuenow="<?php if ($data->permintaan_kirim == NULL) { ?> 0% <?php } elseif ($data->jumlah_kirim == $data->permintaan_kirim) { ?>100% <?php } else { ?> {{$data->permintaan_kirim}}0% <?php } ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="mt-3"> <span class="text1">@if($data->permintaan_kirim=='')0 @else{{$data->permintaan_kirim}}@endif Disetujui <span class="text2">Dari {{$data->jumlah_kirim}} Pengajuan</span></span> </div>
                                </div>
                            </div>
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
        <div class="modal fade" id="modalpending" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form id="form_konfirmasi_bongkar" method="POST" action="{{route('user.konfirmasi_bongkar')}}">
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
                        <div class="modal-footer">
                            <div class="col-lg-12 text-center">
                                <button id="btn_konfirmasibongkar" type="submit" name="bongkar" value="bongkar" class="btn btn-success">Bongkar</button>
                                <button id="btn_tidak" type="submit" name="tidakbongkar" value="tidak" class="btn btn-info">Tidak&nbsp;Bongkar</button>
                                <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endsection
        @section('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
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
                        title: 'Informasi',
                        text: 'PO Anda Sudah Disetujui',
                        icon: 'success',
                        timer: 1500
                    })
                });
                $(document).on('click', '#btn_pembayaran', function() {
                    Swal.fire({
                        title: 'Informasi',
                        text: 'PO Anda Sedang Proses Pembayaran',
                        icon: 'success',
                        timer: 1500
                    })
                });
                $(document).on('click', '#btn_pengiriman', function() {
                    Swal.fire({
                        title: 'Informasi',
                        text: 'PO Anda Sedang Pengiriman',
                        icon: 'info',
                        timer: 1500
                    })
                });
                $(document).on('click', '#btn_antrian', function() {
                    Swal.fire({
                        title: 'Informasi',
                        text: 'PO Anda Sedang Menunggu Antrian Bongkar',
                        icon: 'info',
                        timer: 1500
                    })
                });
                $(document).on('click', '#btn_bongkar', function() {
                    Swal.fire({
                        title: 'Informasi',
                        text: 'PO Anda Sedang Proses Bongkar',
                        icon: 'info',
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
                $(document).on('click', '#btn_konfirmasibongkar', function(e) {
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
                            Swal.fire({
                                allowOutsideClick: false,
                                background: 'transparent',
                                onBeforeOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                            $('#form_konfirmasi_bongkar').submit();
                            Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
                        } else {
                            Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                        }
                    });
                });
                $(document).on('click', '#btn_tidak', function(e) {
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
                            Swal.fire({
                                allowOutsideClick: false,
                                background: 'transparent',
                                onBeforeOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                            $('#form_konfirmasi_bongkar').submit();
                            Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
                        } else {
                            Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                        }
                    });
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
                $(document).on('click', '.toshowpending', function() {
                    var id = $(this).attr("name");
                    var ponum = $(this).data("ponum");
                    var url = "{{ route('user.status_pending')}}" + "/" + id;
                    console.log(url);
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(response) {
                            var parsed = $.parseJSON(response);
                            // console.log(parsed);
                            $('#modalpending').modal('show');
                            $('#status').text('Rp. ' + formatRupiah(parsed.plan_harga_gb) + ' /Kg');
                            $('#id_datapo').val(parsed.lab1_id_data_po_gb);
                            $('#harga').val(parsed.plan_harga_gb);
                            $('#PONum').val(ponum);


                        }
                    });
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