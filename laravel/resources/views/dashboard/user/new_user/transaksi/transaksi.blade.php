@extends('dashboard.user.new_user.layouts.main')

@section('content')
<div class="container-xxl bg-white p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 1rem; height: 1rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-primary" style="width: 1rem; height: 1rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-primary" style="width: 1rem; height: 1rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    @include('dashboard.user.new_user.layouts.header')



    <!-- Features Start -->
    <div class="container-xxl py-5" id="feature" style="margin-top: -40%;">
        <div class="container py-5 px-lg-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="text-primary-gradient fw-medium mb-5">DAFTAR TRANSAKSI</h5>
            </div>
            <div class="row g-4">
                @if($data_pengajuan=='[]')
                <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative bg-light rounded pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            <img src="{{asset('img/bid/pp_bid.jpg')}}" class="rounded-circle" alt="" width="95%">
                        </div>
                        <h5 class="mt-4 mb-3">Tidak Ada Transaksi</h5>
                    </div>
                </div>
                @else
                @foreach($data_pengajuan as $data)
                <div class="col-12 pt-4 mb-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative bg-light rounded pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            <img src="{{asset('img/bid/pp_bid.jpg')}}" class="rounded-circle" alt="" width="95%">
                        </div>
                        <h5 class="mt-4 mb-3 text-center">{{$data->name_bid}}</h5>
                        <dl class="dl-horizontal row" style="font-size: smaller;">
                            <dd class="col-3">Site</dd>
                            <dd class="col-1">:</dd>
                            <dd class="col-8" style="font-weight: bold;">NGAWI</dd>
                            <dd class="col-3">No. PO</dd>
                            <dd class="col-1">:</dd>
                            <dd class="col-8" style="font-weight: bold;">{{$data->kode_po}}</dd>
                            <dd class="col-3">Tanggal&nbsp;PO</dd>
                            <dd class="col-1">:</dd>
                            <dd class="col-8" style="font-weight: bold;">{{ \Carbon\Carbon::parse($data->open_po)->format('d-m-Y')}}</dd>
                            <dd class="col-3">Status&nbsp;PO</dd>
                            <dd class="col-1">:</dd>
                            <dd class="col-8" style="font-weight: bold;">
                                @if ( $data->status_bid == 1 )
                                <a id="btn_pengiriman" name="{{$data->kode_po}}" title="Proses Pengiriman" class="btn btn-warning btn-sm">
                                    <i class="fa fa-truck"></i><span>&nbsp;Proses&nbsp;Pengiriman</span>
                                </a>
                                @elseif ($data->status_bid == 2)
                                <a name="{{$data->kode_po}}" title="Ditolak" class="toshow btn btn-danger btn-sm">
                                    <i class="fa fa-times"></i><span>&nbsp;Ditolak</span>
                                </a>
                                @elseif ($data->status_bid == 3)
                                <a id="btn_antrian" name="{{$data->kode_po}}" title="Menunggu Antrian Bongkar" class="toshow btn btn-secondary btn-sm">
                                    <i class="fa fa-id-card"></i><span>&nbsp;Menunggu&nbsp;Antrian</span>
                                </a>
                                @elseif ($data->status_bid == 4)
                                <a name="{{$data->kode_po}}" title="Pengiriman Telat" class="toshow btn btn-danger btn-sm">
                                    <i class="fa fa-minus"></i><span>&nbsp;Pengiriman&nbsp;Terlambat</span>
                                </a>
                                @elseif ($data->status_bid == 5)
                                <a name="{{$data->kode_po}}" title="Reject" id="btn_ditolak" class="btn btn-danger btn-sm">
                                    <i class="fa fa-minus"></i><span>&nbsp;Tolak</span>
                                </a>
                                @elseif ($data->status_bid == 6)
                                <a id="btn_antrian" name="{{$data->kode_po}}" title="Menunggu Antrian Bongkar" class="toshow btn btn-secondary btn-sm">
                                    <i class="fa fa-id-card"></i><span>&nbsp;Menunggu&nbsp;Antrian</span>
                                </a>
                                @elseif ($data->status_bid == 7)
                                <a id="btn_antrian" name="{{$data->kode_po}}" title="Menunggu Antrian Bongkar" class="toshow btn btn-secondary btn-sm">
                                    <i class="fa fa-id-card"></i><span>&nbsp;Menunggu&nbsp;Antrian&nbsp;Bongkar</span>
                                </a>
                                @elseif ($data->status_bid == 8)
                                <a id="btn_bongkar" name="{{$data->kode_po}}" title="Proses Bongkar" class="toshow btn btn-warning btn-sm">
                                    <i class="fa fa-cogs"></i><span>&nbsp;Menunggu&nbsp;Antrian&nbsp;Bongkar</span>
                                </a>
                                @elseif ($data->status_bid == 9)
                                <a id="btn_bongkar" name="{{$data->kode_po}}" title="Proses Bongkar" class="toshow btn btn-warning btn-sm">
                                    <i class="fa fa-cogs"></i><span>&nbsp;Proses&nbsp;Bongkar</span>
                                </a>
                                @elseif ($data->status_bid == 10)
                                <a id="btn_bongkar" name="{{$data->kode_po}}" title="Proses Bongkar" class="toshow btn btn-warning btn-sm">
                                    <i class="fa fa-cogs"></i><span>&nbsp;Proses&nbsp;Bongkar</span>
                                </a>
                                @elseif ($data->status_bid == 11)
                                <a name="{{$data->kode_po}}" title="Proses Bongkar" class="toshow btn btn-warning btn-sm">
                                    <i class="fa fa-cogs">&nbsp;Proses&nbsp;Bongkar</i>
                                </a>
                                @elseif ($data->status_bid == 12)
                                <a name="{{$data->kode_po}}" title="Selesai Bongkar" class="toshow btn btn-success btn-sm">
                                    <i class="fa fa-check-circle"></i><span>&nbsp;Selesai&nbsp;Bongkar</span>
                                </a>
                                @elseif ($data->status_bid == 13)
                                <a id="btn_pembayaran" name="{{$data->kode_po}}" title="Pembayaran" class="toshow btn btn-success btn-sm">
                                    <i class="fa fa-money"></i><span>&nbsp;Pembayaran</span>
                                </a>
                                @elseif ($data->status_bid == 16)
                                <a name="{{$data->id_data_po}}" title="Pending" data-ponum="{{$data->PONum}}" class="toshowpending btn btn-warning btn-sm">
                                    <i class="fa fa-spinner"></i><span>&nbsp;Pending&nbsp;Harga</span>
                                </a>
                                @endif
                            </dd>
                            <dd class="col-3">Tanggal Kedatangan</dd>
                            <dd class="col-1">:</dd>
                            <dd class="col-8" style="font-weight: bold;">
                                @if($data->waktu_penerimaan=='' || $data->waktu_penerimaan==NULL)
                                -
                                @else
                                {{Carbon\Carbon::parse($data->waktu_penerimaan)->format('d-m-Y')}}<br><span class="btn-success">{{Carbon\Carbon::parse($data->waktu_penerimaan)->format('H:i:s')}}</span>
                                @endif
                            </dd>
                            <dd class="col-3">Batas&nbsp;PO</dd>
                            <dd class="col-1">:</dd>
                            <dd class="col-8" style="font-weight: bold;">
                                {{Carbon\Carbon::parse($data->tanggal_po)->format('d-m-Y')}}<br><span class="btn-warning">12:00 WIB</span>
                            </dd>
                            <dd class="col-3">Asal&nbsp;Gabah</dd>
                            <dd class="col-1">:</dd>
                            <dd class="col-8" style="font-weight: bold;">
                                @if($data->keterangan_penerimaan_po=='' || $data->keterangan_penerimaan_po==NULL)
                                -
                                @else
                                {{$data->keterangan_penerimaan_po}}
                                @endif
                            </dd>
                            <dd class="col-3">Nopol</dd>
                            <dd class="col-1">:</dd>
                            <dd class="col-8" style="font-weight: bold;">
                                @if($data->plat_kendaraan=='' || $data->plat_kendaraan==NULL)
                                -
                                @else
                                {{$data->plat_kendaraan}}
                                @endif
                            </dd>
                            <dd class="col-3">Qty</dd>
                            <dd class="col-1">:</dd>
                            <dd class="col-8" style="font-weight: bold;">
                                @if($data->hasil_akhir_tonase=='' || $data->hasil_akhir_tonase==NULL)
                                -
                                @else
                                {{tonase($data->hasil_akhir_tonase)}}
                                @endif
                            </dd>
                            <dd class="col-3">Harga</dd>
                            <dd class="col-1">:</dd>
                            <dd class="col-8" style="font-weight: bold;">
                                @if($data->aksi_harga_gb=='DEAL')
                                <h3> <span class="badge bg-success">{{rupiah($data->harga_akhir_gb)}} /Kg</span></h3>
                                @else
                                -
                                @endif
                            </dd>
                            <dd class="col-3">Keterangan</dd>
                            <dd class="col-1">:</dd>
                            <dd class="col-8" style="font-weight: bold;">
                                @if($data->status_bid=='5' || $data->status_bid=='16')
                                <a id="btn_ditolak" name="" title="Disetujui" class=" btn btn-sm btn-danger">
                                    <i class="fa fa-minus"></i><span>&nbsp;Ditolak</span>
                                </a>
                                @else
                                <a id="btn_disetujui" name="' . $list->user_id . '" data-jumlahkirim="' . $list->jumlah_kirim . '" data-idnyabid="' . $list->id_bid . '" title="Disetujui" class=" btn btn-sm btn-success">
                                    <i class="fa fa-check"></i><span>&nbsp;Disetujui</span>
                                </a>
                                @endif
                            </dd>
                            <dd class="col-3">Bukti&nbsp;PO</dd>
                            <dd class="col-1">:</dd>
                            <dd class="col-8" style="font-weight: bold;">
                                @if ($data->status_bid == 5)
                                <a href="{{url('user/cetak_po',$data->id_data_po)}}" target="_blank" onclick="return false;" name="" title="Cetak PO" class=" btn btn-sm btn-primary-gradient">
                                    <i class="fa fa-print" style="color:white;"> Cetak PO </i>
                                </a>
                                <a href="{{url('user/scan_po',$data->id_data_po)}}" target="_blank" onclick="return false;" name="" title="Scan PO" class=" btn btn-sm btn-primary-gradient">
                                    <i class="fa fa-barcode" style="color:white;"> Scan PO </i>
                                </a>
                                @else
                                <a href="{{url('user/cetak_po',$data->id_data_po)}}" name="" title="Cetak PO" class=" btn btn-sm btn-primary-gradient">
                                    <i class="fa fa-print" style="color:white;"> Cetak PO </i>
                                </a>
                                <a href="{{url('user/scan_po',$data->id_data_po)}}" target="_blank" name="" title="Scan PO" class=" btn btn-sm btn-primary-gradient">
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
        </div>
    </div>
    <!-- Features End -->



    @include('dashboard.user.new_user.layouts.menu')


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-lg-square back-to-top pt-2"><i class="bi bi-arrow-up text-white"></i></a>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
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
    $(document).on('click', '#btn_klik', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            html: ' <div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div>',
            showCancelButton: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
                // Swal.showLoading()
            },
        });
    });
    window.onbeforeunload = function() {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            html: ' <div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div>',
            showCancelButton: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
                // Swal.showLoading()
            },
        });
    };
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
                    html: ' <div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div>',
                    showCancelButton: false,
                    showConfirmButton: false,
                    onBeforeOpen: () => {
                        // Swal.showLoading()
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
                    html: ' <div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div>',
                    showCancelButton: false,
                    showConfirmButton: false,
                    onBeforeOpen: () => {
                        // Swal.showLoading()
                    },
                });
                $('#form_konfirmasi_bongkar').submit();
                Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
            } else {
                Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

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
</script>
@endsection