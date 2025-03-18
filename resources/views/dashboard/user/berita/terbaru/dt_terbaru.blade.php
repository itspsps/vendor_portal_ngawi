@extends('dashboard.user.layout.main')
@section('title')
SUMBER PANGAN
@endsection

@section('content')
<div class="blog_bg_area">
    <div class="container">
        <div class="blog_page_section">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <div class="blog_wrapper mb-60">
                        <div class="blog_header">
                            <h1>Berita</h1>
                        </div>
                        <div class="blog_wrapper_inner">
                            @foreach ($berita as $terbaru)
                            <article class="single_blog">
                                <figure>
                                    <div class="blog_thumb">
                                        <a href="{{route('user.detailberita',['id' => $terbaru->id_news])}}"><img src="{{asset('img/berita/'.$terbaru->gambar)}}" alt=""></a>
                                    </div>
                                    <figcaption class="blog_content">
                                        <h4 class="post_title"><a href="{{route('user.detailberita',['id' => $terbaru->id_news])}}">{{$terbaru->judul_berita}}</a></h4>
                                        <div class="blog_meta">
                                            <span class="author">Posted by : <a href="">admin</a> / </span>
                                            <span class="meta_date">Posted on :  <a href="">{{$terbaru->waktu}}</a></span>
                                        </div>
                                        <div class="blog_desc">
                                            <p style="text-align: justify">{{Str::limit($terbaru->isi_berita, 200, $end='.......')}}</p>
                                        </div>
                                        <footer class="btn_more">
                                            <a href="{{route('user.detailberita',['id' => $terbaru->id_news])}}"> Read more</a>
                                        </footer>
                                    </figcaption>
                                </figure>
                            </article>
                            @endforeach
                        </div>
                    </div>
                    <!--blog pagination area start-->
                    <div class="blog_pagination">
                        <div class="pagination">
                            <ul>
                                {{ $berita->links() }}
                            </ul>
                        </div>
                    </div>
                    <!--blog pagination area end-->
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
<script type="text/javascript">
    $(function(){
        $(document).on('click','.toshow',function(){
            var id= $(this).attr("name");
            console.log(id);
            var url= '{{ route('user.lelang_show') }}'+"/"+id;

            $.ajax({
                type: "GET",
                url: url,
                success: function(response){
                    var parsed = $.parseJSON(response);
                    console.log(response);
                    var image = parsed.image_bid;
                    $('#id_bid').val(parsed.id_bid);
                    $('#name_bid').html('<h1>'+parsed.name_bid+'</h1>');
                    $('#harga').html('<span class="new_price">Rp '+parsed.harga+'/Kg</span>');
                    $('#jumlah').val(parsed.jumlah);
                    $('#lokasi').val(parsed.lokasi);
                    $('#date_bid').val(parsed.date_bid);
                    $('#batas_bid').val(parsed.batas_bid);
                    $('#description_bid').html('<p>'+parsed.description_bid+'</p>');
                    $('#image_bid').empty();
					if(image !== null){
							$('#img').html('<div class=""><img src="http://127.0.0.1:8000/img/bid/'+image+'" style="width:100%;height:500px" /></div>');
					}

                }
            });
        });
    });
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection
