@extends('dashboard.user.layout.main1')
@section('title')
SURYA PANGAN SEMESTA
@endsection
@section('content')
@include('sweetalert::alert')

<!--home section bg area start-->
<div class="home_section_bg" style=" background-image: url('public/assets_user/assets/img/slider/bg_sawah.jpg');background-size: cover;">
    <div class="product_area deals_product ">
        <div class="container">
            <div class="blog_area">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="section_title s_title_style3">
                                    <ul class="nav" role="tablist">
                                        <li>
                                            <a class="btn btn-outline-danger" style="background-color: #4D006E;" data-toggle="tab" href="/" role="tab" aria-controls="kediri" aria-selected="false">
                                                <span style="color: white;">
                                                    <i class="fa fa-newspaper-o"></i> BERITA
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @foreach ($berita as $berita)
                            <div class="card">
                                <article class="single_blog">
                                    <figure>
                                        <a href="{{route('user.detailberita',['id'=> $berita->id_news])}}"><img class="mx-auto" src="{{asset('img/berita/'.$berita->gambar)}}" alt=""></a>

                                        <figcaption class="blog_content">
                                            <h4><a href="{{route('user.detailberita',['id'=> $berita->id_news])}}">{{$berita->judul_berita}}</a></h4>
                                            <div class="post_meta">
                                                <p>By <a href="#">admin</a> Date <a href="#">April 24, 2018</a></p>
                                            </div>
                                            {{-- <div class="post_desc">
                                            <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean posuere libero eu augue condimentum rhoncus. Praesent</p>
                                        </div> --}}
                                            <footer class="post_readmore">
                                                <a href="{{route('user.detailberita',['id'=> $berita->id_news])}}">Read more</a>
                                            </footer>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                            @endforeach
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
    $(document).on('click', '#btn_login', function(e) {
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
                        $('#img').html('<div class=""><img src="https://ngawi.suryapangansemesta.store/bid-sp/public/img/bid/' + image + '" style="width:100%;height:500px" /></div>');
                    }

                }
            });
        });
    });
</script>
@endsection