<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Populer;
use Illuminate\Support\Facades\DB;
use DataTables;

class PopulerController extends Controller
{
    public function populer_store(Request $request)
    {
        $image              = $request->file('gambar_populer');
		$namefile           = $image->getClientOriginalName();
		$destinationpath    = public_path('img/populer');
		if(!empty($image)){
		    $image->move($destinationpath,$namefile);
		}
        $populer = new Populer();
        $populer->judul_populer         = $request->judul_populer;
        $populer->waktu_populer         = $request->waktu_populer;
        $populer->keterangan_populer    = $request->keterangan_populer;
        $populer->status_populer        = $request->status_populer;
        $populer->gambar_populer        = $namefile;
        $populer->save();
        return redirect()->back();
    }

    public function populer_update(Request $request)
    {
        $image              = $request->file('gambar_populer');
		$namefile           = $image->getClientOriginalName();
		$destinationpath    = public_path('img/populer');
		if(!empty($image)){
		    $image->move($destinationpath,$namefile);
		}
        $populer = Populer::where('id_populer',$request->id_populer)->first();
        $populer->judul_populer         = $request->judul_populer;
        $populer->waktu_populer         = $request->waktu_populer;
        $populer->keterangan_populer    = $request->keterangan_populer;
        $populer->status_populer        = $request->status_populer;
        $populer->gambar_populer        = $namefile;
        $populer->save();
        return redirect()->back();
    }

    public function populer_index()
    {
        return Datatables::of(Populer::query()->orderBy("id_populer"))
        ->addColumn('judul_populer',function($list){
            $result = $list->judul_populer;
            return $result;
        })
        ->addColumn('gambar_populer',function($list){
            $img= url('public/img/populer/'.$list->gambar_populer);
            if(is_null($list->gambar_populer)){}else
            return '
                <img src="'.$img.'" width="100px"/>
            ';
        })
        ->addColumn('keterangan_populer',function($list){
            $result = $list->keterangan_populer;
            return $result;
        })
        ->addColumn('waktu_populer',function($list){
            $result = $list->waktu_populer;
            return $result;
        })
        ->addColumn('status_populer',function($list){
            if($list->status_populer == 1){
                return '<a style="margin:2px;" href="'. route('sourching.populer_updatestatus', ['id'=>$list->id_populer]). '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update Data" onclick="return true" class="tostatus btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-check-circle"> Active</i>
                </a>';
            }else{
                return '<a style="margin:2px;" href="'. route('sourching.populer_updatestatus', ['id'=>$list->id_populer]). '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update Data" onclick="return true" class="tostatus btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-times-circle"> Non Active</i>
                </a>';
            }
        })
        ->addColumn('ckelola', function($buatmanage){
            return '
            <a style="margin:2px;" name="'.$buatmanage->id_populer.'" data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
            <i class="fa fa-pen-alt" style="color:#00c5dc;"> Edit</i>
            </a>
            <a style="margin:2px;" href="'. route('sourching.populer_destroy', ['id' => $buatmanage->id_populer ]). '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
            <i class="fa fa-trash"> Delete</i>
            </a>
            ';
        })
            ->rawColumns(['judul_populer','gambar_populer','waktu_populer','status_populer','ckelola'])
            ->make(true);
    }

    public function populer_destroy($id)
    {
        $data= Populer::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function populer_show($id)
    {
        $data = Populer::where('id_populer', $id)->first();
        return json_encode($data);
    }

    public function populer_updatestatus($id)
    {
        $data = DB::table('populer')->where('id_populer',$id)->first();
        if($data->status_populer == 1){
            DB::table('populer')->where('id_populer',$id)->update(['status_populer' => 0]);
            return redirect()->back();
        }else{
            DB::table('populer')->where('id_populer',$id)->update(['status_populer' => 1]);
            return redirect()->back();
        }
    }
}
