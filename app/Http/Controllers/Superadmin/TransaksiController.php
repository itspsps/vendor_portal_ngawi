<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Bid;
use App\Models\BidUser;
use App\Models\ApproveBid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Models\Transaksi;
use DataTables;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class TransaksiController extends Controller
{
    public function transaksi_index(Request $request)
    {
        return Datatables::of(Bid::query()->orderBy("id_bid"))
        ->addColumn('name_bid',function($list){
            $result = $list->name_bid;
            return $result;
        })
        ->addColumn('date_bid',function($list){
            $result = $list->date_bid;
            return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">'.$result.'</span>
            ';
        })
        ->addColumn('image_bid', function($list){
            $img= url('img/bid/'.$list->image_bid);
            if(is_null($list->image_bid)){

            }else
            return '
                <img src="'.$img.'" width="100px"/>
            ';
        })
        ->addColumn('description_bid',function($list){
            $result = $list->description_bid;
            return $result;
        })
        ->addColumn('response',function($list){
            return '<a style="margin:2px;" href="'. route('superadmin.bid_response', ['id_bid' => $list->id_bid]). '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
            <i class="fa fa-eye"></i>
            </a>';
        })
        ->addColumn('ckelola', function($buatmanage){
            return '
                <a style="margin:2px;" name="'.$buatmanage->id_bid.'" data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                <a style="margin:2px;" href="'. route('superadmin.bid_destroy', ['id_bid' => $buatmanage->id_bid]). '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-trash"></i>
                </a>
            ';
        })
            ->rawColumns(['name_bid','date_bid','image_bid','response','ckelola'])
            ->make(true);

    }

    public function detail_transaksi($id)
    {
        $data = DB::table('transaksi')->join('users','users.id','=','transaksi.id_vendor_transaksi')
        ->join('bid','bid.id_bid','=','transaksi.id_bid_transaksi')
        ->join('bid_user','bid_user.id_biduser','=','transaksi.id_biduser_id')
        ->where('id_transaksi',$id)->first();
        // $pdf = PDF::loadView('dashboard.superadmin.transaksi.struk',['data'=>$data])->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->download('nicesnippets1.pdf');
        return view('dashboard.superadmin.transaksi.dt_detailtransaksi', ['data'=>$data]);
    }

    public function print_struk($id)
    {
        $data = DB::table('transaksi')->join('users','users.id','=','transaksi.id_vendor_transaksi')
        ->join('bid','bid.id_bid','=','transaksi.id_bid_transaksi')
        ->join('bid_user','bid_user.id_biduser','=','transaksi.id_biduser_id')
        ->where('id_transaksi',$id)->first();
        return view('dashboard.superadmin.transaksi.print_struk', ['data'=>$data]);
    }

    public function print_pdf_struk($id)
    {
        $data = DB::table('transaksi')->join('users','users.id','=','transaksi.id_vendor_transaksi')
        ->join('bid','bid.id_bid','=','transaksi.id_bid_transaksi')
        ->join('bid_user','bid_user.id_biduser','=','transaksi.id_biduser_id')
        ->where('id_transaksi',$id)->first();
        $pdf = PDF::loadView('dashboard.superadmin.transaksi.print_pdf_struk',['data'=>$data])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('invoice.pdf');
    }

    public function transaksi_show($id)
    {
        $data = DB::table('bid_user')->join('users','users.id','=','bid_user.user_id')->where('id_biduser', $id)->first();
        return json_encode($data);
    }

    public function transaksi_struk()
    {
        return view('dashboard.superadmin.transaksi.struk');
    }

    public function transaksi_update(Request $request)
    {
        $data = Transaksi::where('id_vendor_transaksi',$request->user_idbid)
                ->where('id_bid_transaksi',$request->bid_id)
                ->where('id_biduser_id',$request->id_biduser)
                ->first();
        $data->final_hargagabah     = $request->final_hargagabah;
        $data->final_jumlahgabah    = $request->final_jumlahgabah;
        $data->potongan_bongkar     = $request->final_jumlahgabah*13;
        $data->harga_setelah_potong = ($request->final_hargagabah * $request->final_jumlahgabah) - ($request->final_jumlahgabah*13);
        $data->jumlah_uang          = $request->final_hargagabah * $request->final_jumlahgabah;
        $data->jumlah_uangsetelahpph= (((($request->final_hargagabah * $request->final_jumlahgabah)-($request->final_jumlahgabah*13))-(($request->final_hargagabah * $request->final_jumlahgabah)-($request->final_jumlahgabah*13)) * (0.25/100)));
        $data->pembayaran           = (((($request->final_hargagabah * $request->final_jumlahgabah)-($request->final_jumlahgabah*13))-(($request->final_hargagabah * $request->final_jumlahgabah)-($request->final_jumlahgabah*13)) * (0.25/100)));
        $data->status_transaksi     = $request->status_transaksi;
        $data->save();
        return redirect()->back();
    }

}
