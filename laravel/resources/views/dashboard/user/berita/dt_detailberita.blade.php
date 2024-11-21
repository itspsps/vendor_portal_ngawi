@extends('dashboard.user.layout.main1')
@section('title')
SURYA PANGAN SEMESTA
@endsection

@section('content')
<div class="blog_bg_area" style=" background-image: url('https://ngawi.suryapangansemesta.store/public/assets_user/assets/img/slider/bg_sawah.jpg');background-size: cover;">
    <div class="container">
        <div class="blog_page_section">
            <div class="row">
                <div class="col-12">
                    <div class="product_header">
                        <div class="section_title s_title_style3">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="btn btn-outline-danger" style="background-color: #4D006E;" data-toggle="tab" href="/" role="tab" aria-controls="kediri" aria-selected="false">
                                        <span style="color: white;">
                                            <i class="fa fa-newspaper-o"></i> DETAIL BERITA
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <!--blog grid area start-->
                    <div class="blog_wrapper blog_details">
                        <article class="single_blog">
                            <figure>
                                <div class="post_header">
                                    <img src="{{asset('img/berita/'.$detail_berita->gambar)}}" width="100%" alt="">
                                    <h3 class="post_title">{{$detail_berita->judul_berita}}</h3>
                                    <div class="blog_meta">
                                        <span class="author">Posted by : <a href="">admin</a> / </span>
                                        <span class="meta_date">On : <a href="">{{$detail_berita->waktu}}</a> /</span>
                                        <span class="post_category">In : <a href="">PT. SURYA PANGAN SEMESTA</a></span>
                                    </div>
                                </div>
                                <div class="blog_thumb">
                                    <img src="assets/img/blog/blog-big1.jpg" alt="">
                                </div>
                                <figcaption class="blog_content">
                                    <div class="post_content">
                                        <p style="text-align: justify">{{$detail_berita->isi_berita}}</p>
                                        <blockquote>
                                            <p>Baca Juga Artikel Lainnya ....</p>
                                        </blockquote>
                                    </div>
                                    <div class="entry_content">
                                        <div class="social_sharing">
                                            <p>share this post:</p>
                                            <ul>
                                                <li><a href="#" title="facebook"><i class="fa fa-facebook"></i></a></li>
                                                <li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="#" title="pinterest"><i class="fa fa-pinterest"></i></a></li>
                                                <li><a href="#" title="google+"><i class="fa fa-google-plus"></i></a></li>
                                                <li><a href="#" title="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>

                    </div>
                    <!--blog grid area start-->
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="blog_sidebar_widget">
                        <div class="widget_list widget_search">
                            <div class="widget_title">
                                <h3>Pencarian</h3>
                            </div>
                            <form action="#">
                                <input placeholder="Pencarian..." type="text">
                                <button type="submit">Pencarian</button>
                            </form>
                        </div>
                        <div class="widget_list widget_post">
                            <div class="widget_title">
                                <h3>Berita Terkini</h3>
                            </div>
                            @foreach ($berita as $berita)
                            <div class="post_wrapper">
                                <div class="post_thumb">
                                    <a href="{{route('user.detailberita',['id' => $berita->id_news])}}"><img src="{{asset('img/berita/'.$berita->gambar)}}" alt=""></a>
                                </div>
                                <div class="post_info">
                                    <h4><a href="{{route('user.detailberita',['id' => $berita->id_news])}}">{{$berita->judul_berita}}</a></h4>
                                    <span>{{$berita->waktu}} </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="widget_list widget_categories">
                            <div class="widget_title">
                                <h3>Kategori</h3>
                            </div>
                            <ul>
                                <li><a href="{{route('user.pangan_pertanian')}}">Pangan Pertanian</a></li>
                                <li><a href="{{route('user.teknologi_inovasi')}}">Teknologi Inovasi</a></li>
                                <li><a href="{{route('user.ekonomi_perdagangan')}}">Ekonimi Perdagangan</a></li>
                                <li><a href="{{route('user.international')}}">International</a></li>
                            </ul>
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
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '.toshow', function() {
            var id = $(this).attr("name");
            console.log(id);
            var url = "{{route('user.lelang_show')}}" + "/" + id;

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
                        $('#img').html('<div class=""><img src="http://127.0.0.1:8000/img/bid/' + image + '" style="width:100%;height:500px" /></div>');
                    }

                }
            });
        });
    });
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection