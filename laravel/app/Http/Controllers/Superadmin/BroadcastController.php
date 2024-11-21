<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\News;
use App\Models\Broadcast;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Auth;

class BroadcastController extends Controller
{
    public function broadcast_store(Request $request)
    {


        $file           = $request->file('gambar_broadcast');
        //  dd($file);
        if (($file) == '') {
            $data = DB::table('broadcast')
                ->insert([
                    'broadcast_user_id'  => Auth()->user()->id,
                    'broadcast_kategory'  => 'PEMBERITAHUAN',
                    'broadcast_judul'  => $request->judul_broadcast,
                    'broadcast_date'  => $request->waktu_broadcast,
                    'broadcast_text'    => $request->isi_broadcast,
                    'broadcaster'    => 'PT.SURYA PANGAN SEMESTA',
                    'status_baca'    => '0',
                ]);
        } else {
            //  dd('sdsda');
            $imageName      = time() . '.' . $request->gambar_broadcast->extension();
            $file->move('public/img/broadcast/', $imageName);
            $data = DB::table('broadcast')
                ->insert([
                    'broadcast_user_id'  => Auth()->user()->id,
                    'broadcast_kategory'  => 'PEMBERITAHUAN',
                    'broadcast_judul'  => $request->judul_broadcast,
                    'broadcast_date'  => $request->waktu_broadcast,
                    'broadcast_text'    => $request->isi_broadcast,
                    'broadcaster'    => 'PT.SURYA PANGAN SEMESTA',
                    'broadcast_file' => $imageName,
                ]);
        }
        return redirect()->back();
    }
    public function broadcast_statusbaca(Request $request)
    {
    }
    public function broadcast_update(Request $request)
    {
        $image = $request->file('gambar_broadcast_update');
        // dd($image);
        if (($image) == '' && ($image) == null) {
            $news = DB::table('broadcast')->where('id_broadcast', $request->id_broadcast)
                ->update([
                    'broadcast_judul'  => $request->judul_broadcast_update,
                    'broadcast_date'  => $request->waktu_broadcast_update,
                    'broadcast_text'    => $request->isi_broadcast_update,
                ]);
        } else {
            $get = DB::table('broadcast')->where('id_broadcast', $request->id_broadcast)->first();
            if (!empty($get->broadcast_file)) {
                $path = '/home/u1736638/public_html/ngawi.suryapangansemesta.store/public/img/broadcast/';

                $file_old = $path . $get->broadcast_file;
                unlink($file_old);
            }
            $imageName      = time() . '.' . $image->extension();
            $image->move('public/img/broadcast/', $imageName);

            $news = DB::table('broadcast')->where('id_broadcast', $request->id_broadcast)
                ->update([
                    'broadcast_judul' => $request->judul_broadcast_update,
                    'broadcast_date'  => $request->waktu_broadcast_update,
                    'broadcast_text'  => $request->isi_broadcast_update,
                    'broadcast_file'  => $imageName
                ]);
        }
        return redirect()->back();
    }

    public function broadcast_index()
    {
        return Datatables::of(Broadcast::query()->orderBy("id_broadcast", "desc"))
            ->addColumn('gambar_broadcast', function ($list) {
                $img = url('/public/img/broadcast/' . $list->broadcast_file);
                if (is_null($list->broadcast_file)) {
                    return ' - ';
                } else
                    return '
                <img src="' . $img . '" width="100px"/>
            ';
            })
            ->addColumn('ckelola', function ($buatmanage) {
                return '
            <a style="margin:2px;" name="' . $buatmanage->id_broadcast . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
            <i class="fa fa-pen-alt" style="color:#00c5dc;">Edit</i>
            </a>
            <a style="margin:2px;" href="' . route('sourching.broadcast_destroy', ['id' => $buatmanage->id_broadcast]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
            <i class="fa fa-trash">Delete</i>
            </a>
            ';
            })
            ->rawColumns(['gambar_broadcast', 'ckelola'])
            ->make(true);
    }

    public function broadcast_destroy($id)
    {
        $data = Broadcast::find($id);
        // dd($data);
        $data->delete();
        return redirect()->back();
    }

    public function broadcast_show($id)
    {
        $data = Broadcast::where('id_broadcast', $id)->first();
        return json_encode($data);
    }
}
