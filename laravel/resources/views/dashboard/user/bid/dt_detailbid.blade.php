@extends('dashboard.user.layout.main1')
@section('title')
SURYA PANGAN SEMESTA
@endsection

@section('content')
@include('sweetalert::alert')
<div class="product_page_bg" style=" background-image: url('https://ngawi.suryapangansemesta.store/public/assets_user/assets/img/slider/bg_sawah.jpg');background-size: cover;">
    <div class="container">
        <div class="product_details_wrapper mb-55">
            <!--product details start-->
            <div class="product_details">
                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <div class="product-details-tab">
                            <div id="img-1" class="zoomWrapper single-zoom">
                                <a href="/">
                                    <img id="zoom1" src="{{asset('img/bid/pp_bid.jpg')}}" data-zoom-image="{{asset('img/bid/pp_bid.jpg')}}" alt="big-1">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6">
                        <div class="product_d_right">
                            <form id="form_lelang" method="POST" action="{{ route('user.lelang_storeuser') }}" enctype="multipart/form-data">

                                {{ csrf_field() }}
                                {{ method_field('POST') }}
                                @if (Session::get('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                                @endif
                                @if (Session::get('fail'))
                                <div class="alert alert-danger">
                                    {{ Session::get('fail') }}
                                </div>
                                @endif
                                <h3><b>{{$data->name_bid}}</b></h3>
                                <input type="hidden" name="bid_id" value="{{$data->id_bid}}">
                                {{-- <div class="product_timing">
                                    <div data-countdown="{{$data->batas_bid}}">
                        </div>
                        <input type="text">
                        <script>
                            $('[data-countdown]').each(function() {
                                var $this = $(this),
                                    finalDate = $(this).data('countdown');
                                $this.countdown(finalDate, function(event) {
                                    $this.html(event.strftime('<div class="countdown_area"><div class="single_countdown"><div class="countdown_number">%D</div><div class="countdown_title">days</div></div><div class="single_countdown"><div class="countdown_number">%H</div><div class="countdown_title">hours</div></div><div class="single_countdown"><div class="countdown_number">%M</div><div class="countdown_title">mins</div></div><div class="single_countdown"><div class="countdown_number">%S</div><div class="countdown_title">secs</div></div></div>'));
                                });
                            });
                        </script>
                    </div> --}}
                    <div class="mtbox1 mtbox">
                        Kuota Lelang : <b>
                            {{tonase($jumlah_kuota)}} ({{$jumlah_kuotatruk}} Truk)
                        </b>
                        <br>
                        Sisa Kuota : {{tonase($get_sisakuota)}} ({{$sisakuota}} Truk)
                    </div>
                    <input type="hidden" name="name_bid" id="name_bid" value="{{$data->name_bid}}">
                    <input type="hidden" name="id_bid" id="id_bid" value="{{$data->id_bid}}">
                    <input type="hidden" name="tanggal_po" id="tanggal_po" value="{{$data->open_po}}">
                    <div class="product_variant ">
                        <label for="">Jumlah Kirim (Truk)</label>
                        <input type="number" style="width: 100%" id="jumlah_kirim"  name="jumlah_kirim" class="form-control" placeholder="1 Truk (8000 Kg)">
                    </div>
                    <div class="product_variant ">
                        <label for="">Asal Gabah</label>
                        <textarea name="description_biduser" id="description_biduser" required style="width: 100%" class="form-control" placeholder="Asal Gabah" rows="2"></textarea>
                    </div>
                    <input type="hidden" value="{{$data->lokasi}}" name="site_id">
                    <!--<div class="product_variant ">-->
                    <!--    <label for="">Foto</label>-->
                    <!--    <input name="image_biduser" type="file" style="width:100%">-->
                    <!--</div>-->
                    <br>
                    @if($data->bid_status == 0)
                    @if (($data->batas_bid) > date('Y-m-d H:i:s'))
                    <div class="product_variant quantity">
                        <button id="btn_statustidakaktif" class="button" type="button" class="btn btn-primary">
                            Lelang Tidak Aktif
                        </button>
                    </div>
                    @else
                    <div class="product_variant quantity">
                        <button id="btn_lelangberakhir" class="button" type="button" class="btn btn-primary">
                            Lelang Berakhir
                        </button>
                    </div>
                    @endif
                    @else
                    @if (($data->batas_bid) > date('Y-m-d H:i:s'))
                    <div class="product_variant quantity">
                        <button id="btn_save_lelang" class="button" type="submit">Ikuti Lelang</button>
                    </div>
                    @else
                    <div class="product_variant quantity">
                        <button id="btn_lelangberakhir" class="button" type="button" class="btn btn-primary">
                            Lelang Berakhir
                        </button>
                    </div>
                    @endif
                    @endif
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="product_d_info">
        <div class="row">
            <div class="col-12">
                <div class="product_d_inner">
                    <div class="product_info_button">
                        <ul class="nav" role="tablist">
                            <li>
                                <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Keterangan</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet" aria-selected="false">Spesifikasi</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="info" role="tabpanel">
                            <div class="product_info_content">
                                <p>{{$data->description_bid}}</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="sheet" role="tabpanel">
                            <div class="product_d_table">
                                <form action="#">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="first_child">Nama</td>
                                                <td>{{$data->name_bid}}</td>
                                            </tr>
                                            <tr>
                                                <td class="first_child">Batas Waktu</td>
                                                <td>{{$data->batas_bid}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                            <div class="product_info_content">
                                <p>{{$data->description_bid}}</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin-top: 20%">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalLabel">E-PROCUREMENT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    Maaf, Anda sudah mengikuti lelang
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin-top: 20%">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalLabel">E-PROCUREMENT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    Maaf, Lelang telah berakhir
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--home section bg area end-->
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(function () {
  $("#jumlah_kirim").keydown(function () {
    // Save old value.
    if (!$(this).val() || (parseInt($(this).val()) <= 25 && parseInt($(this).val()) >= 0))
    $(this).data("1", $(this).val());
  });
  $("#jumlah_kirim").keyup(function () {
    // Check correct, else revert back to old value.
    if (!$(this).val() || (parseInt($(this).val()) <= 25 && parseInt($(this).val()) >= 0))
      ;
    else
      $(this).val($(this).data("1"));
  });
});
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
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '#btn_lelangberakhir', function(e) {
            Swal.fire({
                title: 'Maaf',
                text: 'Lelang Sudah Berakhir',
                icon: 'error',
                timer: 1500
            })
        });
        $(document).on('click', '#btn_statustidakaktif', function(e) {
            Swal.fire({
                title: 'Informasi',
                text: 'Lelang Belum Dibuka',
                icon: 'warning',
                timer: 1500
            })
        });
        $(document).on('click', '#btn_save_lelang', function(e) {
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
                    if ($('#jumlah_kirim').val() == '' | $('#description_biduser').val() == '') {
                        Swal.fire('Info!', 'Data Harus Terisi Semua', 'warning')
                    } else {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Data Uploading...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            },
                        });
                        $('#form_lelang').submit();
                        // Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
                    }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '.toshow', function() {
            var id = $(this).attr("name");
            console.log(id);
            var url = "{{ route('user.lelang_show') }}" + "/" + id;

            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    var parsed = $.parseJSON(response);
                    console.log(response);
                    var image = parsed.image_bid;
                    $('#id_bid').val(parsed.id_bid);
                    $('#name_bid').html('<h1>' + parsed.name_bid + '</h1>');
                    $('#harga').html('<span class="new_price">Rp ' + parsed.harga + '/Kg</span>');
                    $('#jumlah').val(parsed.jumlah);
                    $('#lokasi').val(parsed.lokasi);
                    $('#date_bid').val(parsed.date_bid);
                    $('#batas_bid').val(parsed.batas_bid);
                    $('#description_bid').html('<p>' + parsed.description_bid + '</p>');
                    $('#image_bid').empty();
                    if (image !== null) {
                        $('#img').html('<div class=""><img src="https://ngawi.suryapangansemesta.store/public/img/bid/pp_bid.jpg" style="width:100%;height:500px" /></div>');
                    }

                }
            });
        });
    });
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection