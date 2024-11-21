<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\News;
use Illuminate\Support\Facades\DB;
use DataTables;

class NewsController extends Controller
{
    public function news_store(Request $request)
    {
        $image              = $request->file('gambar');
		$namefile           = $image->getClientOriginalName();
		$destinationpath    = public_path('img/berita');
		if(!empty($image)){
		    $image->move($destinationpath,$namefile);
		}
        $news = new News();
        $news->kategori     = $request->kategori;
        $news->judul_berita = $request->judul_berita;
        $news->waktu = $request->waktu;
        $news->isi_berita   = $request->isi_berita;
        $news->status       = $request->status;
        $news->gambar       = $namefile;
        $news->save();
        return redirect()->back();
    }

    public function news_index()
    {
        return Datatables::of(News::query()->orderBy("id_news","desc"))
        ->addColumn('judul_berita',function($list){
            $result = $list->judul_berita;
            return $result;
        })
        ->addColumn('gambar',function($list){
            $img= url('public/img/berita/'.$list->gambar);
            if(is_null($list->gambar)){}else
            return '
                <img src="'.$img.'" width="100px"/>
            ';
        })
        ->addColumn('isi_berita',function($list){
            $result = $list->isi_berita;
            return $result;
        })
        ->addColumn('waktu',function($list){
            $result = $list->waktu;
            return $result;
        })
        ->addColumn('status',function($list){
            if($list->status == 1){
                return 'Aktif';
            }else{
                return 'Tidak Aktif';
            }
        })
        ->addColumn('ckelola', function($buatmanage){
            return '
            <a style="margin:2px;" name="'.$buatmanage->id_news.'" data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
            <i class="fa fa-pen-alt" style="color:#00c5dc;">Edit</i>
            </a>
            <a style="margin:2px;" href="'. route('sourching.news_destroy', ['id' => $buatmanage->id_news]). '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
            <i class="fa fa-trash">Delete</i>
            </a>
            ';
        })
            ->rawColumns(['judul_berita','gambar','waktu','status','ckelola'])
            ->make(true);
    }

    public function news_destroy($id)
    {
        $data= News::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function news_show($id)
    {
        $data = News::where('id_news', $id)->first();
        return json_encode($data);
    }
}
