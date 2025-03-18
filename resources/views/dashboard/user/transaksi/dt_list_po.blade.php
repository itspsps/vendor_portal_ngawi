@extends('dashboard.user.layout.main')
@section('title')
SURYA PANGAN SEMESTA
@endsection
@section('content')

<div class="cart_page_bg" style="background: rgb(178,172,226);
background: linear-gradient(180deg, rgba(178,172,226,1) 7%, rgba(237,236,244,1) 100%);background-size: cover;  height: max-content; border-radius: 30px; margin-top: 10%;">
    <div class="container mb-3">
        <div class="row">
            <div class="col-12">
                <div class="product_header">
                    <h3 style="color: white; font-weight: bold; text-align: center;"> DATA LIST PO
                    </h3>
                </div>
            </div>
        </div>
        <div class="row">
            @if($data=='[]')
            <div class="col-md-10 mx-auto">
                <div class="card p-3 mb-2" style="border-radius: 20px;">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <div class="icon"><img style="border-radius: 20%;" src="{{asset('assets_user/assets/img/logo/sps_logo_new.png')}}" alt="" width="80%"> </div>
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
            <div class="col-12 pt-4 mb-3 wow fadeInUp" data-wow-delay="0.1s">
                @if($data->status_bid >= '3' && $data->status_bid != '5' && $data->status_bid != '16')
                <div class="position-relative pt-1 pb-4 px-4" style="background-color: #dffde0; border-radius: 10px;">
                    <img style="transform: rotate(-0.05turn); margin-top: -2px; position: absolute;top: 0;right: 0; float:right" src="{{asset('img/po_success.png')}}" alt="" width="25%">
                    @elseif($data->status_bid == '5')
                    <div class="position-relative bg-light pt-1 pb-4 px-4" style="background-color: #fed1d1; border-radius: 10px;">
                        <img style="transform: rotate(-0.10turn); margin-top: -15px; position: absolute;top: 0;right: 0; float:right" src="{{asset('img/po_closed.png')}}" alt="" width="25%">
                        @else
                        <div class="position-relative bg-light pt-1 pb-4 px-4" style="border-radius: 10px;">
                            @endif
                            <div class="d-flex flex-row align-items-center">
                                <div class="icon"><img src="{{asset('assets_user/assets/img/logo/sps_logo_new.png')}}" alt="" width="80%"> </div>
                                <div class="ms-2 c-details">
                                    <h6 class="mb-0"><b>{{$data->name_bid}}</b></h6> <span>PO : {{ \Carbon\Carbon::parse($data->open_po)->format('d-m-Y')}}</span>
                                </div>
                            </div>
                            <dl class="dl-horizontal row" style="font-size: smaller;">
                                <dd class="col-3">No. PO</dd>
                                <dd class="col-1">:</dd>
                                <dd class="col-7" style="font-weight: bold;">
                                    {{getCode($data->kode_po)}}<br>
                                    <a data-id="{{$data->kode_po}}" class="" id="btn_liat_po">
                                        <span class="badge bg-success">
                                            <i class="fa fa-eye"></i>Lihat
                                        </span>
                                    </a>

                                </dd>
                                <dd class="col-3">Batas Kedatangan</dd>
                                <dd class="col-1">:</dd>
                                <dd class="col-7" style="font-weight: bold;"> @if($data->waktu_penerimaan=='' || $data->waktu_penerimaan==NULL) - @else {{Carbon\Carbon::parse($data->waktu_penerimaan)->format('d-m-Y')}}<br><span class="btn-success">{{Carbon\Carbon::parse($data->waktu_penerimaan)->format('H:i:s')}}</span>@endif
                                </dd>
                                <dd class="col-3">Batas Permintaan</dd>
                                <dd class="col-1">:</dd>
                                <dd class="col-7" style="font-weight: bold;">{{date('d-m-Y', strtotime($data->batas_bid))}}<br>
                                    <h5>

                                        <span class="badge bg-warning">Batas 12:00</span>
                                    </h5>
                                </dd>
                                <dd class="col-3">Nopol</dd>
                                <dd class="col-1">:</dd>
                                <dd class="col-7" style="font-weight: bold;">@if($data->plat_kendaraan=='' || $data->plat_kendaraan==NULL)
                                    -
                                    @else
                                    {{$data->plat_kendaraan}}
                                    @endif
                                </dd>
                                <dd class="col-3">Qty</dd>
                                <dd class="col-1">:</dd>
                                <dd class="col-7" style="font-weight: bold;">
                                    @if($data->hasil_akhir_tonase=='' || $data->hasil_akhir_tonase==NULL)
                                    -
                                    @else
                                    {{tonase($data->hasil_akhir_tonase)}}
                                    @endif
                                </dd>
                                <dd class="col-3">Harga</dd>
                                <dd class="col-1">:</dd>
                                <dd class="col-7" style="font-weight: bold;">
                                    @if($data->aksi_harga_gb=='DEAL')
                                    <h3> <span class="badge bg-success">{{rupiah($data->harga_akhir_gb)}}/Kg</span></h3>
                                    @else
                                    -
                                    @endif
                                </dd>
                                <dd class="col-3">Bukti PO</dd>
                                <dd class="col-1">:</dd>
                                <dd class="col-7" style="font-weight: bold;">
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
                                </dd>
                            </dl>
                        </div>
                    </div>
                    @endforeach
                    @endif
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
                                                    <h4 style="text-align: center">KODE PO:</h4>
                                                    <form action="#">
                                                        <div class="variants_size text-center">
                                                            <h2 id="view_kode_po"></h2>
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
                <div class="modal fade" id="modal_po" tabindex="-1" role="dialog" aria-hidden="true">
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
                $(document).on('click', '#btn_liat_po', function() {
                    var id = $(this).data("id");
                    // console.log(response);
                    $('#view_kode_po').html(id);
                    $('#modal_lihat_po').modal('show');

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