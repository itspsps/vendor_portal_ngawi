@extends('dashboard.user.layout.main1')
@section('title')
SURYA PANGAN SEMESTA
@endsection

@section('content')
@include('sweetalert::alert')

<!--home section bg area start-->
<div class="home_section_bg " style=" background-image: url('https://ngawi.suryapangansemesta.store/public/assets_user/assets/img/slider/bg_sawah.jpg');background-size: cover;">
    <div class="product_area deals_product ">
        @if($site_ngawi_longgrain=='[]' && $site_ngawi_pandanwangi=='[]' && $site_ngawi_ketanputih=='[]'&& $site_other=='[]')
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product_header">
                        <div class="section_title s_title_style3">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="btn btn-outline-danger" style="background-color: #4D006E;" data-toggle="tab" href="/" role="tab" aria-controls="kediri" aria-selected="false">
                                        <span style="color: white;">
                                            <i class="fa fa-list"></i> DAFTAR LELANG

                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
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
                            <h4><span>BELUM ADA LELANG</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="container">
            @if ($site_ngawi_longgrain=='[]')
            @else
            <div class="row">
                <div class="col-12">
                    <div class="product_header">
                        <div class="section_title s_title_style3">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="btn btn-outline-danger" style="background-color: #4D006E;" data-toggle="tab" href="/" role="tab" aria-controls="kediri" aria-selected="false">
                                        <span style="color: white;">
                                            GABAH BASAH LONG GRAIN

                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-lg-3 mx-auto">
                @foreach ($site_ngawi_longgrain as $site_ngawi_longgrain)
                <div class="card" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px; border-radius: 50px;">
                    <article class="single_product">
                        <figure>

                            <div class="product_thumb">
                                <a class="primary_img" id="btn_lelang_detail" href="{{url('user/lelang_detail/'.$site_ngawi_longgrain->id_bid)}}"><img src="{{asset('img/bid/pp_bid.jpg')}}" alt=""></a>
                                <a class="secondary_img" id="btn_lelang_detail" href="{{url('user/lelang_detail/'.$site_ngawi_longgrain->id_bid)}}"><img src="{{asset('img/bid/pp_bid.jpg')}}" alt=""></a>
                                <div class="label_product">
                                    @if ($site_ngawi_longgrain->bid_status == 1)
                                    <span class="label_sale"><b>BUKA</b></span>
                                    @else
                                    <span class="label_sale" style="background-color: #4D006E"><b>Tutup</b></span>
                                    @endif
                                </div>
                                <div class="action_links">
                                    <ul>
                                        {{-- <li class="wishlist"><a href="#" title="Add to Wishlist"><i class="ion-android-favorite-outline"></i></a></li> --}}
                                        {{-- <li class="compare"><a href="#" title="Add to Compare"><i class="ion-ios-settings-strong"></i></a></li> --}}
                                        <li class="quick_button">
                                            <a href="javasript:void(0);" data-toggle="modal" data-target="#modal_box" title="quick view" name="{{$site_ngawi_longgrain->id_bid}}" class="toshow">
                                                <i class="ion-ios-search-strong"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_content">
                                <div class="product_content_inner">
                                    <h4 class="product_name"><a href="#"><b>{{$site_ngawi_longgrain->name_bid}}</b></a></h4>
                                    <div class="price_box">
                                        <span class="current_price">PO: {{date('d-m-Y', strtotime($site_ngawi_longgrain->open_po))}}</span>
                                    </div>
                                    <div class="countdown_text">
                                        <p style="font-weight: bold"><span>SITE</span> NGAWI </p>
                                    </div>
                                    <div class="product_timing">
                                        <div data-countdown="{{$site_ngawi_longgrain->batas_bid}}"></div>
                                        <script>
                                            $('[data-countdown]').each(function() {
                                                var $this = $(this),
                                                    finalDate = $(this).data('countdown');
                                                $this.countdown(finalDate, function(event) {
                                                    $this.html(event.strftime('<div class="countdown_area"><div class="single_countdown"><div class="countdown_number">%D</div><div class="countdown_title">days</div></div><div class="single_countdown"><div class="countdown_number">%H</div><div class="countdown_title">hours</div></div><div class="single_countdown"><div class="countdown_number">%M</div><div class="countdown_title">mins</div></div><div class="single_countdown"><div class="countdown_number">%S</div><div class="countdown_title">secs</div></div></div>'));
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div class="add_to_cart">
                                    <a href="{{url('user/lelang_detail/'.$site_ngawi_longgrain->id_bid)}}" title="Ikuti Lelang">Ikut Lelang</a>
                                </div>

                            </div>
                        </figure>
                    </article>
                </div>
                @endforeach
            </div>
            @if ($site_ngawi_pandanwangi=='[]')
            @else
            <br>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="product_header">
                        <div class="section_title s_title_style3">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="btn btn-outline-danger" style="background-color: #4D006E;" data-toggle="tab" href="/" role="tab" aria-controls="kediri" aria-selected="false">
                                        <span style="color: white;">
                                            GABAH BASAH PANDAN WANGI
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-lg-3 mx-auto">
                @foreach ($site_ngawi_pandanwangi as $site_ngawi_pandanwangi)
                <div class="card" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px; border-radius: 50px;">
                    <article class="single_product">
                        <figure>

                            <div class="product_thumb">
                                <a class="primary_img" id="btn_lelang_detail" href="{{url('user/lelang_detail/'.$site_ngawi_pandanwangi->id_bid)}}"><img src="{{asset('img/bid/pp_bid.jpg')}}" alt=""></a>
                                <a class="secondary_img" id="btn_lelang_detail" href="{{url('user/lelang_detail/'.$site_ngawi_pandanwangi->id_bid)}}"><img src="{{asset('img/bid/pp_bid.jpg')}}" alt=""></a>
                                <div class="label_product">
                                    @if ($site_ngawi_pandanwangi->bid_status == 1)
                                    <span class="label_sale"><b>BUKA</b></span>
                                    @else
                                    <span class="label_sale" style="background-color: #4D006E"><b>Tutup</b></span>
                                    @endif
                                </div>
                                <div class="action_links">
                                    <ul>
                                        {{-- <li class="wishlist"><a href="#" title="Add to Wishlist"><i class="ion-android-favorite-outline"></i></a></li> --}}
                                        {{-- <li class="compare"><a href="#" title="Add to Compare"><i class="ion-ios-settings-strong"></i></a></li> --}}
                                        <li class="quick_button">
                                            <a href="javasript:void(0);" data-toggle="modal" data-target="#modal_box" title="quick view" name="{{$site_ngawi_pandanwangi->id_bid}}" class="toshow">
                                                <i class="ion-ios-search-strong"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_content">
                                <div class="product_content_inner">
                                    <h4 class="product_name"><a href="#"><b>{{$site_ngawi_pandanwangi->name_bid}}</b></a></h4>
                                    <div class="price_box">
                                        <span class="current_price">PO: {{date('d-m-Y', strtotime($site_ngawi_pandanwangi->open_po))}}</span>
                                    </div>
                                    <div class="countdown_text">
                                        <p style="font-weight: bold"><span>SITE</span> NGAWI </p>
                                    </div>
                                    <div class="product_timing">
                                        <div data-countdown="{{$site_ngawi_pandanwangi->batas_bid}}"></div>
                                        <script>
                                            $('[data-countdown]').each(function() {
                                                var $this = $(this),
                                                    finalDate = $(this).data('countdown');
                                                $this.countdown(finalDate, function(event) {
                                                    $this.html(event.strftime('<div class="countdown_area"><div class="single_countdown"><div class="countdown_number">%D</div><div class="countdown_title">days</div></div><div class="single_countdown"><div class="countdown_number">%H</div><div class="countdown_title">hours</div></div><div class="single_countdown"><div class="countdown_number">%M</div><div class="countdown_title">mins</div></div><div class="single_countdown"><div class="countdown_number">%S</div><div class="countdown_title">secs</div></div></div>'));
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div class="add_to_cart">
                                    <a href="{{url('user/lelang_detail/'.$site_ngawi_pandanwangi->id_bid)}}" title="Ikuti Lelang">Ikut Lelang</a>
                                </div>

                            </div>
                        </figure>
                    </article>
                </div>
                @endforeach
            </div>
            @if ($site_ngawi_ketanputih=='[]')
            @else
            <div class="row">
                <div class="col-12">
                    <div class="product_header">
                        <div class="section_title s_title_style3">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="btn btn-outline-danger" style="background-color: #4D006E;" data-toggle="tab" href="/" role="tab" aria-controls="kediri" aria-selected="false">
                                        <span style="color: white;">
                                            GABAH BASAH KETAN PUTIH
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-lg-3 mx-auto">
                @foreach ($site_ngawi_ketanputih as $site_ngawi_ketanputih)
                <div class="card" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px; border-radius: 50px;">
                    <article class="single_product">
                        <figure>

                            <div class="product_thumb">
                                <a class="primary_img" id="btn_lelang_detail" href="{{url('user/lelang_detail/'.$site_ngawi_ketanputih->id_bid)}}"><img src="{{asset('img/bid/pp_bid.jpg')}}" alt=""></a>
                                <a class="secondary_img" id="btn_lelang_detail" href="{{url('user/lelang_detail/'.$site_ngawi_ketanputih->id_bid)}}"><img src="{{asset('img/bid/pp_bid.jpg')}}" alt=""></a>
                                <div class="label_product">
                                    @if ($site_ngawi_ketanputih->bid_status == 1)
                                    <span class="label_sale"><b>BUKA</b></span>
                                    @else
                                    <span class="label_sale" style="background-color: #4D006E"><b>Tutup</b></span>
                                    @endif
                                </div>
                                <div class="action_links">
                                    <ul>
                                        {{-- <li class="wishlist"><a href="#" title="Add to Wishlist"><i class="ion-android-favorite-outline"></i></a></li> --}}
                                        {{-- <li class="compare"><a href="#" title="Add to Compare"><i class="ion-ios-settings-strong"></i></a></li> --}}
                                        <li class="quick_button">
                                            <a href="javasript:void(0);" data-toggle="modal" data-target="#modal_box" title="quick view" name="{{$site_ngawi_ketanputih->id_bid}}" class="toshow">
                                                <i class="ion-ios-search-strong"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_content">
                                <div class="product_content_inner">
                                    <h4 class="product_name"><a href="#"><b>{{$site_ngawi_ketanputih->name_bid}}</b></a></h4>
                                    <div class="price_box">
                                        <span class="current_price">PO: {{date('d-m-Y', strtotime($site_ngawi_ketanputih->open_po))}}</span>
                                    </div>
                                    <div class="countdown_text">
                                        <p style="font-weight: bold"><span>SITE</span> NGAWI </p>
                                    </div>
                                    <div class="product_timing">
                                        <div data-countdown="{{$site_ngawi_ketanputih->batas_bid}}"></div>
                                        <script>
                                            $('[data-countdown]').each(function() {
                                                var $this = $(this),
                                                    finalDate = $(this).data('countdown');
                                                $this.countdown(finalDate, function(event) {
                                                    $this.html(event.strftime('<div class="countdown_area"><div class="single_countdown"><div class="countdown_number">%D</div><div class="countdown_title">days</div></div><div class="single_countdown"><div class="countdown_number">%H</div><div class="countdown_title">hours</div></div><div class="single_countdown"><div class="countdown_number">%M</div><div class="countdown_title">mins</div></div><div class="single_countdown"><div class="countdown_number">%S</div><div class="countdown_title">secs</div></div></div>'));
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div class="add_to_cart">
                                    <a href="{{url('user/lelang_detail/'.$site_ngawi_ketanputih->id_bid)}}" title="Ikuti Lelang">Ikut Lelang</a>
                                </div>

                            </div>
                        </figure>
                    </article>
                </div>
                <br>
                <br>
                @endforeach
            </div>
            @if ($site_other=='[]')
            @else
            <div class="row">
                <div class="col-12">
                    <div class="product_header">
                        <div class="section_title s_title_style3">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="btn btn-outline-danger" style="background-color: #4D006E;" data-toggle="tab" href="/" role="tab" aria-controls="kediri" aria-selected="false">
                                        <span style="color: white;">
                                            ITEM LAINNYA
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-lg-3 mx-auto">
                @foreach ($site_other as $site_other)
                <div class="card" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px; border-radius: 50px;">
                    <article class="single_product">
                        <figure>

                            <div class="product_thumb">
                                <a class="primary_img" id="btn_lelang_detail" href="{{url('user/lelang_detail/'.$site_other->id_bid)}}"><img src="{{asset('img/bid/pp_bid.jpg')}}" alt=""></a>
                                <a class="secondary_img" id="btn_lelang_detail" href="{{url('user/lelang_detail/'.$site_other->id_bid)}}"><img src="{{asset('img/bid/pp_bid.jpg')}}" alt=""></a>
                                <div class="label_product">
                                    @if ($site_other->bid_status == 1)
                                    <span class="label_sale"><b>BUKA</b></span>
                                    @else
                                    <span class="label_sale" style="background-color: #4D006E"><b>Tutup</b></span>
                                    @endif
                                </div>
                                <div class="action_links">
                                    <ul>
                                        {{-- <li class="wishlist"><a href="#" title="Add to Wishlist"><i class="ion-android-favorite-outline"></i></a></li> --}}
                                        {{-- <li class="compare"><a href="#" title="Add to Compare"><i class="ion-ios-settings-strong"></i></a></li> --}}
                                        <li class="quick_button">
                                            <a href="javasript:void(0);" data-toggle="modal" data-target="#modal_box" title="quick view" name="{{$site_other->id_bid}}" class="toshow">
                                                <i class="ion-ios-search-strong"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_content">
                                <div class="product_content_inner">
                                    <h4 class="product_name"><a href="#"><b>{{$site_other->name_bid}}</b></a></h4>
                                    <div class="price_box">
                                        <span class="current_price">PO: {{date('d-m-Y', strtotime($site_other->open_po))}}</span>
                                    </div>
                                    <div class="countdown_text">
                                        <p style="font-weight: bold"><span>SITE</span> NGAWI </p>
                                    </div>
                                    <div class="product_timing">
                                        <div data-countdown="{{$site_other->batas_bid}}"></div>
                                        <script>
                                            $('[data-countdown]').each(function() {
                                                var $this = $(this),
                                                    finalDate = $(this).data('countdown');
                                                $this.countdown(finalDate, function(event) {
                                                    $this.html(event.strftime('<div class="countdown_area"><div class="single_countdown"><div class="countdown_number">%D</div><div class="countdown_title">days</div></div><div class="single_countdown"><div class="countdown_number">%H</div><div class="countdown_title">hours</div></div><div class="single_countdown"><div class="countdown_number">%M</div><div class="countdown_title">mins</div></div><div class="single_countdown"><div class="countdown_number">%S</div><div class="countdown_title">secs</div></div></div>'));
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div class="add_to_cart">
                                    <a href="{{url('user/lelang_detail/'.$site_other->id_bid)}}" title="Ikuti Lelang">Ikut Lelang</a>
                                </div>

                            </div>
                        </figure>
                    </article>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
    <!--product area end-->

    <!--blog area end-->
    <div class="modal fade" id="modal_box" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-cente#4D006E" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal_body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <div class="modal_tab">
                                    <div class="tab-content product-details-large">
                                        <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                            <div class="modal_tab_img">
                                                <div id="img"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <div class="modal_right">
                                    <div class="modal_title mb-10">
                                        <h3 id="name_bid"></h3>
                                    </div>
                                    <div class="modal_price mb-10">
                                        <span id="harga"></span>
                                    </div>
                                    <div class="modal_description mb-15">
                                        <p style="text-align:justify" id="description_bid"></p>
                                    </div>
                                    <div class="variants_selects modal_add_to_cart">

                                        <form action="#">
                                            <div class="variants_size">
                                                <h2>Harga</h2>
                                                <input type="number" style="width: 100%" name="price_biduser" placeholder="Rp. 100000">
                                            </div>
                                            <div class="variants_color">
                                                <h2>Keterangan</h2>
                                                <textarea name="description_biduser" id="" style="width: 100%" placeholder="Keterangan" rows="2"></textarea>
                                            </div>
                                            <div class="variants_color">
                                                <h2>Foto</h2>
                                                <input name="image_biduser" type="file" style="width:100%">
                                            </div>
                                            <br>
                                            <div class="modal_add_to_cart">
                                                <a class="btn btn-danger" style="width: 100%" href="#" title="Ikuti Lelang">Detail</a>
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

</div>
<!--home section bg area end-->
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
    $(document).on('click', '#btn_login', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
    });
    $(document).on('click', '#btn_lelang_detail', function(e) {
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
    setTimeout(function() {
        var url = "{{ route('user.update_home') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            dataType: 'JSON',
            success: function(data) {
                console.log(data)
            }
        });
        location.reload();

    }, 1000000);
</script>
<script type="text/javascript">
    $(function() {
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
@endsection