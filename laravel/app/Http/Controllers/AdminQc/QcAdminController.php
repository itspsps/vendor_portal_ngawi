<?php

namespace App\Http\Controllers\AdminQc;

use App\Http\Controllers\Controller;
use App\Models\FinishingQCGb;
use App\Models\FinishingQCPk;
use App\Models\Lab1GabahBasah;
use App\Models\DataQcBongkar;
use App\Models\Lab1Pecahkulit;
use App\Models\ParameterLab;
use App\Models\PlanHppGabahBasah;
use App\Models\PenerimaanPO;
use App\Models\DataPO;
use App\Models\PlanHppGabahKering;
use App\Models\PlanHppGabahPecahKulit;
use App\Models\PlanHppBerasDs;
use App\Models\QcAdmin;
use App\Models\HargaAtasGabahBasah;
use App\Models\HargaAtasGabahKering;
use App\Models\HargaAtasPecahKulit;
use App\Models\trackerPO;
use App\Models\HargaAtasBerasDs;
use App\Models\HargaBawah;
use App\Models\NotifLab;
use App\Models\PotonganBongkarGb;
use App\Models\PotonganBongkarGk;
use App\Models\PotonganBongkarPk;
use App\Models\PotonganBongkarDs;
use App\Models\PlanHppPecahKulit;
use App\Models\ParameterLabPkKa;
use App\Models\ParameterLabPkHampa;
use App\Models\ParameterLabPkTr;
use App\Models\ParameterLabPkButiranPatah;
use App\Models\ParameterLabPkRewardKadarAir;
use App\Models\ParameterLabPkRewardHampa;
use App\Models\ParameterLabPkRewardTr;
use App\Models\ParameterLabPkRewardKatul;
use App\Models\ParameterLabPkRewardButirPatah;
use App\Models\ParameterLabPkKualitas;
use App\Models\ParameterLabPkKatul;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataBongkarLab1ExportExcel;
use App\Exports\DataSouchingDealGBExcel;
use App\Exports\DataPendingLab1ExportExcel;
use App\Exports\DataRejectLab1ExportExcel;
use App\Exports\OutputDataLab2ExportExcel;
use App\Exports\OutputDataLab2ExportExcelPK;
use App\Exports\DataOnProsesLab2ExportExcel;
use App\Exports\DataDealLab2ExportExcel;
use App\Exports\DataOutputLab1Excel;
use App\Exports\DataNegoLab2ExportExcel;
use App\Models\LogAktivityLab;
use App\Models\NotifSpvqc;
use App\Models\LogAktivityQc;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Twilio\Rest\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Hash;

class QcAdminController extends Controller
{
    public function login()
    {
        return view('dashboard.admin_qc.login');
    }
    public function account_lab()
    {
        $id = Auth::guard('lab')->user()->id_qc;
        $data = QcAdmin::where('id_qc', $id)->first();
        // dd($data);
        return view('dashboard.admin_qc.dt_account', ['data' => $data]);
    }
    public function account_update(Request $request)
    {
        //dd($request->all());
        $data = QcAdmin::where('id_qc', $request->id)->first();
        $data->name_qc = $request->name_qc;
        $data->username = $request->username_qc;
        $data->email = $request->email_qc;
        $data->phone_qc = $request->phone_qc;
        $data->password_show = $request->password;
        $data->password = Hash::make($request['password']);
        $data->perusahaan = $request->company_qc;
        $data->updated_at = $request->updated_at;
        $data->update();
        return response()->json($data);
    }
    function home()
    {

        // $date= date('Y-m-d 12:00:00');
        $proses_lab1 = DataPO::join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', 'data_po.id_data_po')
            ->where('data_po.status_bid', '=', 3)
            ->count();
        $proses_lab2 = DataPO::join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', 'data_po.id_data_po')
            ->where('status_bid', '=', 10)
            ->count();
        $hasil_lab1 = DataPO::join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', 'data_po.id_data_po')
            ->where('status_bid', '=', 6)
            ->count();
        $hasil_lab2 = DataPO::join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', 'data_po.id_data_po')
            ->where('status_bid', '=', 11)
            ->count();
        $po_pending = DataPO::join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', 'data_po.id_data_po')
            ->where('status_bid', '=', '9')
            ->count();
        $po_tolak = DataPO::join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', 'data_po.id_data_po')
            ->join('lab1_gb', 'lab1_gb.lab1_kode_po_gb', 'kode_po')
            ->where('lab1_gb.status_lab1_gb', '5')
            ->count();
        // dd($po_tolak);
        // Parameter Lab
        $last_hpp = DB::table('plan_hpp_gabah_basah')
            // ->where('waktu_plan_hpp_gb', '=', date('Y-m-d'))
            ->groupBy('waktu_plan_hpp_gb')
            ->orderBy('id_plan_hpp_gb', 'desc')
            ->first();
        $hpp = DB::table('plan_hpp_gabah_basah')
            // ->where('waktu_plan_hpp_gb', '=', date('Y-m-d'))
            ->where('waktu_plan_hpp_gb', '=', $last_hpp->waktu_plan_hpp_gb)
            ->get();
        $harga_atas = DB::table('harga_atas_gabah_basah')
            // ->where('waktu_plan_hpp_gb', '=', date('Y-m-d'))
            ->orderBy('id_harga_atas_gb', 'desc')
            ->first();
        // dd($harga_atas);
        $harga_atas_pk = DB::table('harga_atas_pecah_kulit')
            // ->where('waktu_plan_hpp_gb', '=', date('Y-m-d'))
            ->orderBy('id_harga_atas_pk', 'desc')
            ->first();
        $last_refraksi_ka = DB::table('parameter_lab_pk_ka')
            // ->where('waktu_plan_hpp_gb', '=', date('Y-m-d'))
            ->groupBy('tanggal_po_parameter_lab_pk_ka')
            ->orderBy('tanggal_po_parameter_lab_pk_ka', 'desc')
            ->first();
        $refraksi_ka = DB::table('parameter_lab_pk_ka')
            ->where('tanggal_po_parameter_lab_pk_ka', '=', $last_refraksi_ka->tanggal_po_parameter_lab_pk_ka)
            ->orderBy('tanggal_po_parameter_lab_pk_ka', 'desc')
            ->get();
        $last_refraksi_hampa = DB::table('parameter_lab_pk_hampa')
            // ->where('waktu_plan_hpp_gb', '=', date('Y-m-d'))
            ->groupBy('tanggal_parameter_lab_pk_hampa')
            ->orderBy('tanggal_parameter_lab_pk_hampa', 'desc')
            ->first();
        $refraksi_hampa = DB::table('parameter_lab_pk_hampa')
            ->where('tanggal_parameter_lab_pk_hampa', '=', $last_refraksi_hampa->tanggal_parameter_lab_pk_hampa)
            ->orderBy('tanggal_parameter_lab_pk_hampa', 'desc')
            ->get();
        $last_refraksi_tr = DB::table('parameter_lab_pk_tr')
            // ->where('waktu_plan_hpp_gb', '=', date('Y-m-d'))
            ->groupBy('tanggal_parameter_lab_pk_tr')
            ->orderBy('tanggal_parameter_lab_pk_tr', 'desc')
            ->first();
        $refraksi_tr = DB::table('parameter_lab_pk_tr')
            ->where('tanggal_parameter_lab_pk_tr', '=', $last_refraksi_tr->tanggal_parameter_lab_pk_tr)
            ->orderBy('tanggal_parameter_lab_pk_tr', 'desc')
            ->get();
        $last_refraksi_katul = DB::table('parameter_lab_pk_katul')
            // ->where('waktu_plan_hpp_gb', '=', date('Y-m-d'))
            ->groupBy('tanggal_parameter_lab_pk_katul')
            ->orderBy('tanggal_parameter_lab_pk_katul', 'desc')
            ->first();
        $refraksi_katul = DB::table('parameter_lab_pk_katul')
            ->where('tanggal_parameter_lab_pk_katul', '=', $last_refraksi_katul->tanggal_parameter_lab_pk_katul)
            ->orderBy('tanggal_parameter_lab_pk_katul', 'desc')
            ->get();
        $last_refraksi_butiran_patah = DB::table('parameter_lab_pk_butiran_patah')
            // ->where('waktu_plan_hpp_gb', '=', date('Y-m-d'))
            ->groupBy('tanggal_parameter_lab_pk_butiran_patah')
            ->orderBy('tanggal_parameter_lab_pk_butiran_patah', 'desc')
            ->first();
        $refraksi_butiran_patah = DB::table('parameter_lab_pk_butiran_patah')
            ->where('tanggal_parameter_lab_pk_butiran_patah', '=', $last_refraksi_butiran_patah->tanggal_parameter_lab_pk_butiran_patah)
            ->orderBy('tanggal_parameter_lab_pk_butiran_patah', 'desc')
            ->get();
        $last_reward_kadar_air = DB::table('parameter_lab_pk_reward_kadar_air')
            // ->where('waktu_plan_hpp_gb', '=', date('Y-m-d'))
            ->groupBy('tanggal_parameter_lab_pk_reward_kadar_air')
            ->orderBy('tanggal_parameter_lab_pk_reward_kadar_air', 'desc')
            ->first();
        $reward_kadar_air = DB::table('parameter_lab_pk_reward_kadar_air')
            ->where('tanggal_parameter_lab_pk_reward_kadar_air', '=', $last_reward_kadar_air->tanggal_parameter_lab_pk_reward_kadar_air)
            ->orderBy('tanggal_parameter_lab_pk_reward_kadar_air', 'desc')
            ->get();
        $last_reward_hampa = DB::table('parameter_lab_pk_reward_hampa')
            // ->where('waktu_plan_hpp_gb', '=', date('Y-m-d'))
            ->groupBy('tanggal_parameter_lab_pk_reward_hampa')
            ->orderBy('tanggal_parameter_lab_pk_reward_hampa', 'desc')
            ->first();
        $reward_hampa = DB::table('parameter_lab_pk_reward_hampa')
            ->where('tanggal_parameter_lab_pk_reward_hampa', '=', $last_reward_hampa->tanggal_parameter_lab_pk_reward_hampa)
            ->orderBy('tanggal_parameter_lab_pk_reward_hampa', 'desc')
            ->get();
        $last_reward_tr = DB::table('parameter_lab_pk_reward_tr')
            // ->where('waktu_plan_hpp_gb', '=', date('Y-m-d'))
            ->groupBy('tanggal_parameter_lab_pk_reward_tr')
            ->orderBy('tanggal_parameter_lab_pk_reward_tr', 'desc')
            ->first();
        $reward_tr = DB::table('parameter_lab_pk_reward_tr')
            ->where('tanggal_parameter_lab_pk_reward_tr', '=', $last_reward_tr->tanggal_parameter_lab_pk_reward_tr)
            ->orderBy('tanggal_parameter_lab_pk_reward_tr', 'desc')
            ->get();
        $last_reward_katul = DB::table('parameter_lab_pk_reward_katul')
            // ->where('waktu_plan_hpp_gb', '=', date('Y-m-d'))
            ->groupBy('tanggal_parameter_lab_pk_reward_katul')
            ->orderBy('tanggal_parameter_lab_pk_reward_katul', 'desc')
            ->first();
        $reward_katul = DB::table('parameter_lab_pk_reward_katul')
            ->where('tanggal_parameter_lab_pk_reward_katul', '=', $last_reward_katul->tanggal_parameter_lab_pk_reward_katul)
            ->orderBy('tanggal_parameter_lab_pk_reward_katul', 'desc')
            ->get();
        $last_reward_butir_patah = DB::table('parameter_lab_pk_reward_butir_patah')
            // ->where('waktu_plan_hpp_gb', '=', date('Y-m-d'))
            ->groupBy('tanggal_parameter_lab_pk_reward_butir_patah')
            ->orderBy('tanggal_parameter_lab_pk_reward_butir_patah', 'desc')
            ->first();
        $reward_butir_patah = DB::table('parameter_lab_pk_reward_butir_patah')
            ->where('tanggal_parameter_lab_pk_reward_butir_patah', '=', $last_reward_butir_patah->tanggal_parameter_lab_pk_reward_butir_patah)
            ->orderBy('tanggal_parameter_lab_pk_reward_butir_patah', 'desc')
            ->get();
        $last_kualitas_pk_tr = DB::table('parameter_lab_pk_kualitas')
            // ->where('waktu_plan_hpp_gb', '=', date('Y-m-d'))
            ->groupBy('tanggal_parameter_lab_pk_kualitas')
            ->orderBy('tanggal_parameter_lab_pk_kualitas', 'desc')
            ->first();
        $kualitas_pk_tr = DB::table('parameter_lab_pk_kualitas')
            ->where('tanggal_parameter_lab_pk_kualitas', '=', $last_kualitas_pk_tr->tanggal_parameter_lab_pk_kualitas)
            ->orderBy('tanggal_parameter_lab_pk_kualitas', 'desc')
            ->get();
        $last_kualitas_pk_bp = DB::table('parameter_lab_pk_kualitas')
            // ->where('waktu_plan_hpp_gb', '=', date('Y-m-d'))
            ->groupBy('tanggal_parameter_lab_pk_kualitas')
            ->orderBy('tanggal_parameter_lab_pk_kualitas', 'desc')
            ->first();
        $kualitas_pk_bp = DB::table('parameter_lab_pk_kualitas')
            ->where('tanggal_parameter_lab_pk_kualitas', '=', $last_kualitas_pk_bp->tanggal_parameter_lab_pk_kualitas)
            ->orderBy('tanggal_parameter_lab_pk_kualitas', 'desc')
            ->get();
        // dd($harga_atas);
        $harga_bawah = DB::table('harga_bawah_gabah_basah')
            // ->where('waktu_plan_hpp_gb', '=', date('Y-m-d'))
            ->orderBy('id_harga_bawah_gb', 'desc')
            ->first();


        // dd($harga_atas);
        // return view('dashboard.admin_qc.home');
        return view('dashboard.admin_qc.home', compact('proses_lab1', 'last_refraksi_ka', 'kualitas_pk_tr', 'kualitas_pk_bp', 'reward_butir_patah', 'reward_katul', 'reward_tr', 'reward_hampa', 'reward_kadar_air', 'refraksi_butiran_patah', 'refraksi_katul', 'refraksi_hampa', 'refraksi_tr', 'refraksi_ka', 'harga_atas_pk', 'proses_lab2', 'hasil_lab1', 'hasil_lab2', 'po_pending', 'po_tolak', 'hpp', 'last_hpp', 'harga_atas', 'harga_bawah'));
    }

    public function chart_gudang(Request $request)
    {
        $chart_bongkar_utara = DataQcBongkar::where('tempat_bongkar', 'UTARA')
            ->count();
        $chart_bongkar_selatan = DataQcBongkar::where('tempat_bongkar', 'SELATAN')
            ->count();
        $result = ['chart_bongkar_utara' => $chart_bongkar_utara, 'chart_bongkar_selatan' => $chart_bongkar_selatan];
        return response()->json($result);
    }
    public function check(Request $request)
    {
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $array = $request->username;
        // $oke = json_encode($array);
        // dd($array);
        if ($fieldType == "username") {
            $data = DB::table('admins_qc')->where('username', $array)->first();
        } else {
            $data = DB::table('admins_qc')->where('email', $array)->first();
        }
        if (Auth::guard('lab')->attempt(array($fieldType => $request->username, 'password' => $request->password))) {
            Alert::success('Berhasil', 'Selamat Datang ' . $data->name_qc);
            return redirect()->route('qc.lab.home')->with('Berhasil', 'Selamat Datang ' . $data->name_qc);
        } else {
            Alert::error('Gagal', 'Masukkan Email Atau Password Dengan Benar');
            return redirect()->route('qc.lab.login')->with('Gagal', 'Masukkan Email Atau Password Dengan Benar');
        }
    }

    public function qc_logout()
    {
        Auth::guard('lab')->logout();
        Alert::success('Sukses', 'Anda Berhasil Logout');
        return redirect()->route('qc.lab.login')->with('Sukses', 'Anda Berhasil Logout');
    }

    public function get_parameter_lab_pk_tabel_refraksi($tanggal_po)
    {
        $data = DB::table('parameter_lab_pk_ka')->where('tanggal_po_parameter_lab_pk_ka', $tanggal_po)->count();
        $data1 = DB::table('parameter_lab_pk_hampa')->where('tanggal_parameter_lab_pk_hampa', $tanggal_po)->count();
        $data2 = DB::table('parameter_lab_pk_tr')->where('tanggal_parameter_lab_pk_tr', $tanggal_po)->count();
        $data3 = DB::table('parameter_lab_pk_butiran_patah')->where('tanggal_parameter_lab_pk_butiran_patah', $tanggal_po)->count();
        $data4 = DB::table('parameter_lab_pk_katul')->where('tanggal_parameter_lab_pk_katul', $tanggal_po)->count();
        $count = $data + $data1 + $data2 + $data3 + $data4;
        return json_encode($count);
    }
    public function get_parameter_lab_pk_tabel_reward($tanggal_po)
    {
        $data = DB::table('parameter_lab_pk_reward_kadar_air')->where('tanggal_parameter_lab_pk_reward_kadar_air', $tanggal_po)->count();
        $data1 = DB::table('parameter_lab_pk_reward_hampa')->where('tanggal_parameter_lab_pk_reward_hampa', $tanggal_po)->count();
        $data2 = DB::table('parameter_lab_pk_reward_tr')->where('tanggal_parameter_lab_pk_reward_tr', $tanggal_po)->count();
        $data3 = DB::table('parameter_lab_pk_reward_katul')->where('tanggal_parameter_lab_pk_reward_katul', $tanggal_po)->count();
        $data4 = DB::table('parameter_lab_pk_reward_butir_patah')->where('tanggal_parameter_lab_pk_reward_butir_patah', $tanggal_po)->count();
        $count = $data + $data1 + $data2 + $data3 + $data4;
        return json_encode($count);
    }

    public function get_parameter_lab_pk_kadar_air($tanggal_po)
    {
        $data = DB::table('parameter_lab_pk_ka')->where('tanggal_po_parameter_lab_pk_ka', $tanggal_po)->get();
        return json_encode($data);
    }
    public function get_parameter_lab_pk_hampa($tanggal_po)
    {
        $data = DB::table('parameter_lab_pk_hampa')->where('tanggal_parameter_lab_pk_hampa', $tanggal_po)->get();
        return json_encode($data);
    }
    public function get_parameter_lab_pk_katul($tanggal_po)
    {
        $data = DB::table('parameter_lab_pk_katul')->where('tanggal_parameter_lab_pk_katul', $tanggal_po)->get();
        return json_encode($data);
    }
    public function get_parameter_lab_pk_reward_kadar_air($tanggal_po)
    {
        $data = DB::table('parameter_lab_pk_reward_kadar_air')->where('tanggal_parameter_lab_pk_reward_kadar_air', $tanggal_po)->get();
        return json_encode($data);
    }
    public function get_parameter_lab_pk_reward_hampa($tanggal_po)
    {
        $data = DB::table('parameter_lab_pk_reward_hampa')->where('tanggal_parameter_lab_pk_reward_hampa', $tanggal_po)->get();
        return json_encode($data);
    }
    public function get_parameter_lab_pk_reward_tr($tanggal_po)
    {
        $data = DB::table('parameter_lab_pk_reward_tr')->where('tanggal_parameter_lab_pk_reward_tr', $tanggal_po)->get();
        return json_encode($data);
    }
    public function get_parameter_lab_pk_reward_katul($tanggal_po)
    {
        $data = DB::table('parameter_lab_pk_reward_katul')->where('tanggal_parameter_lab_pk_reward_katul', $tanggal_po)->get();
        return json_encode($data);
    }
    public function get_parameter_lab_pk_reward_butir_patah($tanggal_po)
    {
        $data = DB::table('parameter_lab_pk_reward_butir_patah')->where('tanggal_parameter_lab_pk_reward_butir_patah', $tanggal_po)->get();
        return json_encode($data);
    }
    public function get_parameter_lab_pk_tr($tanggal_po)
    {
        $data = DB::table('parameter_lab_pk_tr')->where('tanggal_parameter_lab_pk_tr', $tanggal_po)->get();
        return json_encode($data);
    }
    public function get_parameter_lab_pk_kualitas($tanggal_po)
    {
        $data = DB::table('parameter_lab_pk_kualitas')->where('tanggal_parameter_lab_pk_kualitas', $tanggal_po)->get();
        return json_encode($data);
    }
    public function get_parameter_lab_pk_butiran_patah($tanggal_po)
    {
        $data = DB::table('parameter_lab_pk_butiran_patah')->where('tanggal_parameter_lab_pk_butiran_patah', $tanggal_po)->get();
        return json_encode($data);
    }
    public function getcount_databongkar()
    {
        $data = DataQcBongkar::join('data_po', 'data_po.kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
            ->join('bid', 'data_po.bid_id', '=', 'bid.id_bid')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('bid.name_bid', 'LIKE', '%GABAH BASAH%')
            ->orderBy('id_data_qc_bongkar', 'desc')
            ->count();
        return json_encode($data);
    }
    public function data_bongkar()
    {
        return view('dashboard.admin_qc.data_bongkar');
    }
    public function data_bongkar_gb_utara_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $data = DataQcBongkar::join('data_po', 'data_po.kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')->join('users', 'users.id', '=', 'data_po.user_idbid')->orderBy('id_data_qc_bongkar', 'desc')->get();

                return Datatables::of(DataQcBongkar::join('data_po', 'data_po.kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
                    ->join('bid', 'data_po.bid_id', '=', 'bid.id_bid')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->whereBetween('data_qc_bongkar.tanggal_bongkar', array($request->from_date, $request->to_date))
                    ->where('bid.name_bid', 'LIKE', '%GABAH BASAH%')
                    ->where('data_qc_bongkar.tempat_bongkar', 'UTARA')
                    ->orderBy('id_data_qc_bongkar', 'desc')
                    ->get())
                    ->addColumn('kode_po_bongkar', function ($list) {
                        $result = $list->kode_po_bongkar;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('surveyor_bongkar', function ($list) {
                        $result = $list->surveyor_bongkar;
                        return $result;
                    })
                    ->addColumn('keterangan_bongkar', function ($list) {
                        $result = $list->keterangan_bongkar;
                        return $result;
                    })
                    ->addColumn('waktu_bongkar', function ($list) {
                        $result = $list->waktu_bongkar;
                        return $result;
                    })
                    ->addColumn('tempat_bongkar', function ($list) {
                        $result = $list->tempat_bongkar;
                        return $result;
                    })
                    ->addColumn('z_yang_dibawa', function ($list) {
                        $result = $list->z_yang_dibawa;
                        return $result;
                    })
                    ->addColumn('z_yang_ditolak', function ($list) {
                        $result = $list->z_yang_ditolak;
                        return $result;
                    })
                    ->rawColumns(['kode_po_bongkar', 'nama_vendor', 'surveyor_bongkar', 'keterangan_bongkar', 'waktu_bongkar', 'tempat_bongkar', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {
                $data = DataQcBongkar::join('data_po', 'data_po.kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')->join('users', 'users.id', '=', 'data_po.user_idbid')->orderBy('id_data_qc_bongkar', 'desc')->get();

                return Datatables::of(DataQcBongkar::join('data_po', 'data_po.kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
                    ->join('bid', 'data_po.bid_id', '=', 'bid.id_bid')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->where('bid.name_bid', 'LIKE', '%GABAH BASAH%')
                    ->where('data_qc_bongkar.tempat_bongkar', 'UTARA')
                    ->orderBy('id_data_qc_bongkar', 'desc')
                    ->get())
                    ->addColumn('kode_po_bongkar', function ($list) {
                        $result = $list->kode_po_bongkar;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('surveyor_bongkar', function ($list) {
                        $result = $list->surveyor_bongkar;
                        return $result;
                    })
                    ->addColumn('keterangan_bongkar', function ($list) {
                        $result = $list->keterangan_bongkar;
                        return $result;
                    })
                    ->addColumn('waktu_bongkar', function ($list) {
                        $result = $list->waktu_bongkar;
                        return $result;
                    })
                    ->addColumn('tempat_bongkar', function ($list) {
                        $result = $list->tempat_bongkar;
                        return $result;
                    })
                    ->addColumn('z_yang_dibawa', function ($list) {
                        $result = $list->z_yang_dibawa;
                        return $result;
                    })
                    ->addColumn('z_yang_ditolak', function ($list) {
                        $result = $list->z_yang_ditolak;
                        return $result;
                    })
                    ->rawColumns(['kode_po_bongkar', 'nama_vendor', 'surveyor_bongkar', 'keterangan_bongkar', 'waktu_bongkar', 'tempat_bongkar', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function data_bongkar_gb_selatan_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $data = DataQcBongkar::join('data_po', 'data_po.kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')->join('users', 'users.id', '=', 'data_po.user_idbid')->orderBy('id_data_qc_bongkar', 'desc')->get();

                return Datatables::of(DataQcBongkar::join('data_po', 'data_po.kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
                    ->join('bid', 'data_po.bid_id', '=', 'bid.id_bid')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->whereBetween('data_qc_bongkar.tanggal_bongkar', array($request->from_date, $request->to_date))
                    ->where('bid.name_bid', 'LIKE', '%GABAH BASAH%')
                    ->where('data_qc_bongkar.tempat_bongkar', 'SELATAN')
                    ->orderBy('id_data_qc_bongkar', 'desc')
                    ->get())
                    ->addColumn('kode_po_bongkar', function ($list) {
                        $result = $list->kode_po_bongkar;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('surveyor_bongkar', function ($list) {
                        $result = $list->surveyor_bongkar;
                        return $result;
                    })
                    ->addColumn('keterangan_bongkar', function ($list) {
                        $result = $list->keterangan_bongkar;
                        return $result;
                    })
                    ->addColumn('waktu_bongkar', function ($list) {
                        $result = $list->waktu_bongkar;
                        return $result;
                    })
                    ->addColumn('tempat_bongkar', function ($list) {
                        $result = $list->tempat_bongkar;
                        return $result;
                    })
                    ->addColumn('z_yang_dibawa', function ($list) {
                        $result = $list->z_yang_dibawa;
                        return $result;
                    })
                    ->addColumn('z_yang_ditolak', function ($list) {
                        $result = $list->z_yang_ditolak;
                        return $result;
                    })
                    ->rawColumns(['kode_po_bongkar', 'nama_vendor', 'surveyor_bongkar', 'keterangan_bongkar', 'waktu_bongkar', 'tempat_bongkar', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {
                $data = DataQcBongkar::join('data_po', 'data_po.kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')->join('users', 'users.id', '=', 'data_po.user_idbid')->orderBy('id_data_qc_bongkar', 'desc')->get();

                return Datatables::of(DataQcBongkar::join('data_po', 'data_po.kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
                    ->join('bid', 'data_po.bid_id', '=', 'bid.id_bid')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->where('bid.name_bid', 'LIKE', '%GABAH BASAH%')
                    ->where('data_qc_bongkar.tempat_bongkar', 'SELATAN')
                    ->orderBy('id_data_qc_bongkar', 'desc')
                    ->get())
                    ->addColumn('kode_po_bongkar', function ($list) {
                        $result = $list->kode_po_bongkar;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('surveyor_bongkar', function ($list) {
                        $result = $list->surveyor_bongkar;
                        return $result;
                    })
                    ->addColumn('keterangan_bongkar', function ($list) {
                        $result = $list->keterangan_bongkar;
                        return $result;
                    })
                    ->addColumn('waktu_bongkar', function ($list) {
                        $result = $list->waktu_bongkar;
                        return $result;
                    })
                    ->addColumn('tempat_bongkar', function ($list) {
                        $result = $list->tempat_bongkar;
                        return $result;
                    })
                    ->addColumn('z_yang_dibawa', function ($list) {
                        $result = $list->z_yang_dibawa;
                        return $result;
                    })
                    ->addColumn('z_yang_ditolak', function ($list) {
                        $result = $list->z_yang_ditolak;
                        return $result;
                    })
                    ->rawColumns(['kode_po_bongkar', 'nama_vendor', 'surveyor_bongkar', 'keterangan_bongkar', 'waktu_bongkar', 'tempat_bongkar', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function getcount_datasourchingdeal()
    {
        $data = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('lab2_gb.aksi_harga_gb', 'DEAL')
            ->where('bid.name_bid', 'LIKE', '%GABAH BASAH%')
            ->orderBy('id_lab2_gb', 'DESC')
            ->count();
        return json_encode($data);
    }
    public function data_bongkar_pk_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $data = DataQcBongkar::join('data_po', 'data_po.kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')->join('users', 'users.id', '=', 'data_po.user_idbid')->orderBy('id_data_qc_bongkar', 'desc')->get();

                return Datatables::of(DataQcBongkar::join('data_po', 'data_po.kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
                    ->join('bid', 'data_po.bid_id', '=', 'bid.id_bid')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->orderBy('id_data_qc_bongkar', 'desc')
                    ->get())
                    ->addColumn('kode_po_bongkar', function ($list) {
                        $result = $list->kode_po_bongkar;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('surveyor_bongkar', function ($list) {
                        $result = $list->surveyor_bongkar;
                        return $result;
                    })
                    ->addColumn('keterangan_bongkar', function ($list) {
                        $result = $list->keterangan_bongkar;
                        return $result;
                    })
                    ->addColumn('waktu_bongkar', function ($list) {
                        $result = $list->waktu_bongkar;
                        return $result;
                    })
                    ->addColumn('tempat_bongkar', function ($list) {
                        $result = $list->tempat_bongkar;
                        return $result;
                    })
                    ->addColumn('z_yang_dibawa', function ($list) {
                        $result = $list->z_yang_dibawa;
                        return $result;
                    })
                    ->addColumn('z_yang_ditolak', function ($list) {
                        $result = $list->z_yang_ditolak;
                        return $result;
                    })
                    ->rawColumns(['kode_po_bongkar', 'nama_vendor', 'surveyor_bongkar', 'keterangan_bongkar', 'waktu_bongkar', 'tempat_bongkar', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {
                $data = DataQcBongkar::join('data_po', 'data_po.kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')->join('users', 'users.id', '=', 'data_po.user_idbid')->orderBy('id_data_qc_bongkar', 'desc')->get();

                return Datatables::of(DataQcBongkar::join('data_po', 'data_po.kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
                    ->join('bid', 'data_po.bid_id', '=', 'bid.id_bid')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->orderBy('id_data_qc_bongkar', 'desc')
                    ->get())
                    ->addColumn('kode_po_bongkar', function ($list) {
                        $result = $list->kode_po_bongkar;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('surveyor_bongkar', function ($list) {
                        $result = $list->surveyor_bongkar;
                        return $result;
                    })
                    ->addColumn('keterangan_bongkar', function ($list) {
                        $result = $list->keterangan_bongkar;
                        return $result;
                    })
                    ->addColumn('waktu_bongkar', function ($list) {
                        $result = $list->waktu_bongkar;
                        return $result;
                    })
                    ->addColumn('tempat_bongkar', function ($list) {
                        $result = $list->tempat_bongkar;
                        return $result;
                    })
                    ->addColumn('z_yang_dibawa', function ($list) {
                        $result = $list->z_yang_dibawa;
                        return $result;
                    })
                    ->addColumn('z_yang_ditolak', function ($list) {
                        $result = $list->z_yang_ditolak;
                        return $result;
                    })
                    ->rawColumns(['kode_po_bongkar', 'nama_vendor', 'surveyor_bongkar', 'keterangan_bongkar', 'waktu_bongkar', 'tempat_bongkar', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function get_plan_hpp_gabah_basah($tanggal_po, $item)
    {
        // dd($item);
        $data = DB::table('plan_hpp_gabah_basah')
            ->where('nama_item', $item)
            ->where('waktu_plan_hpp_gb', $tanggal_po)
            ->get();
        return json_encode($data);
    }
    public function get_count_plan_hpp_gabah_basah($id, $item)
    {
        // dd($item);
        $data = PenerimaanPO::join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')
            ->join('plan_hpp_gabah_basah', 'plan_hpp_gabah_basah.waktu_plan_hpp_gb', '=', 'data_po.tanggal_po')
            ->where('penerimaan_po.id_penerimaan_po', $id)
            ->where('plan_hpp_gabah_basah.nama_item', $item)
            ->count();
        // return ($data);
        return json_encode($data);
    }
    public function get_count_lab_kualitas($id)
    {
        $data = PenerimaanPO::join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('parameter_lab_pk_kualitas', 'parameter_lab_pk_kualitas.tanggal_parameter_lab_pk_kualitas', '=', 'data_po.tanggal_po')->where('penerimaan_po.id_penerimaan_po', $id)->count();
        // return ($data);
        return json_encode($data);
    }
    public function get_count_refraksi_hampa($id)
    {
        $data = PenerimaanPO::join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('parameter_lab_pk_hampa', 'parameter_lab_pk_hampa.tanggal_parameter_lab_pk_hampa', '=', 'data_po.tanggal_po')->where('penerimaan_po.id_penerimaan_po', $id)->count();
        // return ($data);
        return json_encode($data);
    }
    public function revisi_security($id)
    {
        $get_data_po = DataPO::join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->where('penerimaan_po.id_penerimaan_po', $id)
            ->first();

        // $data = DataPO::where('id_data_po', $get_data_po->penerimaan_id_data_po)->update(['nopol' => NULL]);
        // $data = PenerimaanPO::where('id_penerimaan_po', $id)->delete();
        $data = PenerimaanPO::where('id_penerimaan_po', $id)->update(['analisa' => 'revisi', 'penerimaan_po.id_adminanalisa' => 1, 'penerimaan_po.status_analisa' => 2, 'penerimaan_po.status_revisi' => 0, 'keterangan_analisa' => 'Nopol Salah']);

        // LOG ACTIVITY
        $log                               = new LogAktivityLab();
        $log->nama_user                    = Auth::guard('lab')->user()->name_qc;
        $log->id_objek_aktivitas_lab       = $get_data_po->id_data_po;
        $log->aktivitas_lab                = 'Kembalikan PO ke Security Dikarenakan Revisi Plat Kendaraan dengan Kode PO:' . $get_data_po->kode_po;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();

        $po = trackerPO::where('kode_po_tracker', $get_data_po->kode_po)->first();
        $po->nama_admin_tracker  = Auth::guard('lab')->user()->name_qc;
        $po->proses_tracker  = 'Kembali Penerimaan Security';
        $po->penerimaan_po_tracker  = NULL;
        $po->lab1_tracker  = NULL;
        $po->update();

        return json_encode($data);
    }
    public function get_count_refraksi_ka($id)
    {
        $data = PenerimaanPO::join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('parameter_lab_pk_ka', 'parameter_lab_pk_ka.tanggal_po_parameter_lab_pk_ka', '=', 'data_po.tanggal_po')->where('penerimaan_po.id_penerimaan_po', $id)->count();
        // return ($data);
        return json_encode($data);
    }
    public function get_count_refraksi_tr($id)
    {
        $data = PenerimaanPO::join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('parameter_lab_pk_tr', 'parameter_lab_pk_tr.tanggal_parameter_lab_pk_tr', '=', 'data_po.tanggal_po')->where('penerimaan_po.id_penerimaan_po', $id)->count();
        // return ($data);
        return json_encode($data);
    }
    public function get_count_refraksi_katul($id)
    {
        $data = PenerimaanPO::join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('parameter_lab_pk_katul', 'parameter_lab_pk_katul.tanggal_parameter_lab_pk_katul', '=', 'data_po.tanggal_po')->where('penerimaan_po.id_penerimaan_po', $id)->count();
        // return ($data);
        return json_encode($data);
    }
    public function get_count_refraksi_butiran_patah($id)
    {
        $data = PenerimaanPO::join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('parameter_lab_pk_butiran_patah', 'parameter_lab_pk_butiran_patah.tanggal_parameter_lab_pk_butiran_patah', '=', 'data_po.tanggal_po')->where('penerimaan_po.id_penerimaan_po', $id)->count();
        // return ($data);
        return json_encode($data);
    }
    public function get_count_reward_tr($id)
    {
        $data = PenerimaanPO::join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('parameter_lab_pk_reward_tr', 'parameter_lab_pk_reward_tr.tanggal_parameter_lab_pk_reward_tr', '=', 'data_po.tanggal_po')->where('penerimaan_po.id_penerimaan_po', $id)->count();
        // return ($data);
        return json_encode($data);
    }
    public function get_count_reward_katul($id)
    {
        $data = PenerimaanPO::join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('parameter_lab_pk_reward_katul', 'parameter_lab_pk_reward_katul.tanggal_parameter_lab_pk_reward_katul', '=', 'data_po.tanggal_po')->where('penerimaan_po.id_penerimaan_po', $id)->count();
        // return ($data);
        return json_encode($data);
    }
    public function get_count_reward_butir_patah($id)
    {
        $data = PenerimaanPO::join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('parameter_lab_pk_reward_butir_patah', 'parameter_lab_pk_reward_butir_patah.tanggal_parameter_lab_pk_reward_butir_patah', '=', 'data_po.tanggal_po')->where('penerimaan_po.id_penerimaan_po', $id)->count();
        // return ($data);
        return json_encode($data);
    }
    public function get_count_reward_hampa($id)
    {
        $data = PenerimaanPO::join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('parameter_lab_pk_reward_hampa', 'parameter_lab_pk_reward_hampa.tanggal_parameter_lab_pk_reward_hampa', '=', 'data_po.tanggal_po')->where('penerimaan_po.id_penerimaan_po', $id)->count();
        // return ($data);
        return json_encode($data);
    }
    public function get_plan_hpp_gabah_kering($tanggal_po)
    {
        $data = DB::table('plan_hpp_gabah_kering')->where('waktu_plan_hpp_gk', $tanggal_po)->get();
        return json_encode($data);
    }
    public function get_count_plan_hpp_gabah_kering($id)
    {
        $data = PenerimaanPO::join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('plan_hpp_gabah_kering', 'plan_hpp_gabah_kering.waktu_plan_hpp', '=', 'data_po.tanggal_po')->where('penerimaan_po.id_penerimaan_po', $id)->count();
        // return ($data);
        return json_encode($data);
    }
    public function get_plan_hpp_pecah_kulit($tanggal_po)
    {
        $data = DB::table('plan_hpp_pecah_kulit')->where('waktu_plan_hpp_pk', $tanggal_po)->get();
        return json_encode($data);
    }
    public function get_count_plan_hpp_pecah_kulit($id)
    {
        $data = PenerimaanPO::join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('plan_hpp_pecah_kulit', 'plan_hpp_pecah_kulit.waktu_plan_hpp', '=', 'data_po.tanggal_po')->where('penerimaan_po.id_penerimaan_po', $id)->count();
        // return ($data);
        return json_encode($data);
    }
    public function get_plan_hpp_beras_ds($tanggal_po)
    {
        $data = DB::table('plan_hpp_beras_ds')->where('waktu_plan_hpp_ds', $tanggal_po)->get();
        return json_encode($data);
    }
    public function get_count_plan_hpp_beras_ds($id)
    {
        $data = PenerimaanPO::join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('plan_hpp_beras_ds', 'plan_hpp_beras_ds.waktu_plan_hpp', '=', 'data_po.tanggal_po')->where('penerimaan_po.id_penerimaan_po', $id)->count();
        // return ($data);
        return json_encode($data);
    }



    public function lokasi_bongkar($id)
    {
        $data = DB::table('gabahincoming_qc')->where('gabahincoming_id_penerimaan_po', $id)->first();
        return json_encode($data);
    }

    public function show_penerimaan_po($id)
    {
        $data = DataPO::where('id_data_po', $id)->first();
        return json_encode($data);
    }





















    public function output_gabah_onprocess()
    {
        return view('dashboard.admin_qc.output_gabah_onprocess');
    }

    public function output_gabah_onprocess_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                $site_qc = QcAdmin::select('site_qc')->where('site_qc', Auth::user()->site_qc)->first();
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('gabahfinishing_qc', 'gabahfinishing_qc.gabahincoming_kode_po', '=', 'data_po.kode_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->join('gabahincoming_qc', 'gabahincoming_qc.gabahincoming_kode_po', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('gabahfinishing_qc.aksi_harga', 'ON PROCESS')

                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = $list->tanggal_po;
                        return $result;
                    })
                    ->addColumn('keterangan_penerimaan_po', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result =  'Rp.' . $list->plan_harga . '/Kg';
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = 'Rp.' . $list->plan_harga_gabah . '/Kg';
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = 'Rp.' . $list->plan_harga_beli_gabah . '/Kg';
                        return $result;
                    })

                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result =  'Rp.' . $list->harga_berdasarkan_tempat . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result =  'Rp.' . $list->harga_berdasarkan_harga_atas . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = 'Rp.' . $list->harga_awal . '/Kg';
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga;
                        return  '<a style="margin:2px;" title="Information" class="detail_data btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = $list->reaksi_harga;
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = 'Rp.' . $list->harga_akhir . '/Kg';
                        return $result;
                    })

                    ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'keterangan_penerimaan_po', 'plan_harga', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            } else {
                $site_qc = QcAdmin::select('site_qc')->where('site_qc', Auth::user()->site_qc)->first();
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('gabahfinishing_qc', 'gabahfinishing_qc.gabahincoming_kode_po', '=', 'data_po.kode_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->join('gabahincoming_qc', 'gabahincoming_qc.gabahincoming_kode_po', '=', 'data_po.kode_po')
                    // ->whereBetween('data_po.tanggal_po', array($request->from_date, $to_date))
                    ->where('gabahfinishing_qc.aksi_harga', 'ON PROCESS')

                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = $list->tanggal_po;
                        return $result;
                    })
                    ->addColumn('keterangan_penerimaan_po', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result =  'Rp.' . $list->plan_harga . '/Kg';
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = 'Rp.' . $list->plan_harga_gabah . '/Kg';
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = 'Rp.' . $list->plan_harga_beli_gabah . '/Kg';
                        return $result;
                    })

                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result =  'Rp.' . $list->harga_berdasarkan_tempat . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result =  'Rp.' . $list->harga_berdasarkan_harga_atas . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = 'Rp.' . $list->harga_awal . '/Kg';
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga;
                        return  '<a style="margin:2px;" title="Information" class="detail_data btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = $list->reaksi_harga;
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = 'Rp.' . $list->harga_akhir . '/Kg';
                        return $result;
                    })

                    ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'keterangan_penerimaan_po', 'plan_harga', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            }
        }
    }


    public function output_gabah_unloading_nego()
    {
        return view('dashboard.admin_qc.output_gabah_unloading_nego');
    }
    public function output_gabah_longgrain_nego_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('lab2_gb.aksi_harga_gb', 'NEGO')
                    ->where('bid.name_bid', 'GABAH BASAH LONG GRAIN')

                    ->get())
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = \Carbon\Carbon::parse($list->date_biduser)->isoFormat('DD-MM-Y hh:mm:ss');
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = $list->tonase_awal;
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = $list->tonase_akhir;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = 'Rp.' . $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = 'Rp.' . $list->harga_berdasarkan_tempat_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = 'Rp.' . $list->harga_berdasarkan_harga_atas_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = 'Rp.' . $list->harga_awal_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return '
                   <a style="margin:2px;" readonly class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    NEGO
                </a>';
                    })
                    ->addColumn('surveyor', function ($list) {
                        $result = $list->surveyor_gb;
                        return $result;
                    })
                    ->addColumn('keterangan', function ($list) {
                        $result = $list->keterangan_gb;
                        return $result;
                    })
                    ->addColumn('waktu', function ($list) {
                        $result = $list->waktu_gb;
                        return $result;
                    })
                    ->addColumn('tempat', function ($list) {
                        $result = $list->tempat_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_dibawa', function ($list) {
                        $result = $list->z_yang_dibawa_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_ditolak', function ($list) {
                        $result = $list->z_yang_ditolak_gb;
                        return $result;
                    })
                    ->rawColumns(['nama_vendor', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    // ->whereBetween('data_po.tanggal_po', array($request->from_date, $to_date))
                    ->where('lab2_gb.aksi_harga_gb', 'NEGO')
                    ->where('bid.name_bid', 'GABAH BASAH LONG GRAIN')

                    ->get())
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = \Carbon\Carbon::parse($list->date_biduser)->isoFormat('DD-MM-Y hh:mm:ss');
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = $list->tonase_awal;
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = $list->tonase_akhir;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = 'Rp.' . $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = 'Rp.' . $list->harga_berdasarkan_tempat_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = 'Rp.' . $list->harga_berdasarkan_harga_atas_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = 'Rp.' . $list->harga_awal_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return '
                   <a style="margin:2px;" readonly class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    NEGO
                </a>';
                    })
                    ->addColumn('surveyor', function ($list) {
                        $result = $list->surveyor_gb;
                        return $result;
                    })
                    ->addColumn('keterangan', function ($list) {
                        $result = $list->keterangan_gb;
                        return $result;
                    })
                    ->addColumn('waktu', function ($list) {
                        $result = $list->waktu_gb;
                        return $result;
                    })
                    ->addColumn('tempat', function ($list) {
                        $result = $list->tempat_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_dibawa', function ($list) {
                        $result = $list->z_yang_dibawa_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_ditolak', function ($list) {
                        $result = $list->z_yang_ditolak_gb;
                        return $result;
                    })
                    ->rawColumns(['nama_vendor', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function output_gabah_pandan_wangi_nego_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                $site_qc = QcAdmin::select('site_qc')->where('site_qc', Auth::user()->site_qc)->first();
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('lab2_gb.aksi_harga_gb', 'NEGO')
                    ->where('bid.name_bid', 'GABAH BASAH PANDAN WANGI')

                    ->get())
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = \Carbon\Carbon::parse($list->date_biduser)->isoFormat('DD-MM-Y hh:mm:ss');
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = $list->tonase_awal;
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = $list->tonase_akhir;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = 'Rp.' . $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = 'Rp.' . $list->harga_berdasarkan_tempat_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = 'Rp.' . $list->harga_berdasarkan_harga_atas_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = 'Rp.' . $list->harga_awal_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return '
                   <a style="margin:2px;" readonly class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    NEGO
                </a>';
                    })
                    ->addColumn('surveyor', function ($list) {
                        $result = $list->surveyor_gb;
                        return $result;
                    })
                    ->addColumn('keterangan', function ($list) {
                        $result = $list->keterangan_gb;
                        return $result;
                    })
                    ->addColumn('waktu', function ($list) {
                        $result = $list->waktu_gb;
                        return $result;
                    })
                    ->addColumn('tempat', function ($list) {
                        $result = $list->tempat_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_dibawa', function ($list) {
                        $result = $list->z_yang_dibawa_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_ditolak', function ($list) {
                        $result = $list->z_yang_ditolak_gb;
                        return $result;
                    })
                    ->rawColumns(['nama_vendor', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    // ->whereBetween('data_po.tanggal_po', array($request->from_date, $to_date))
                    ->where('lab2_gb.aksi_harga_gb', 'NEGO')
                    ->where('bid.name_bid', 'GABAH BASAH PANDAN WANGI')

                    ->get())
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = \Carbon\Carbon::parse($list->date_biduser)->isoFormat('DD-MM-Y hh:mm:ss');
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = $list->tonase_awal;
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = $list->tonase_akhir;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = 'Rp.' . $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = 'Rp.' . $list->harga_berdasarkan_tempat_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = 'Rp.' . $list->harga_berdasarkan_harga_atas_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = 'Rp.' . $list->harga_awal_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return '
                   <a style="margin:2px;" readonly class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    NEGO
                </a>';
                    })
                    ->addColumn('surveyor', function ($list) {
                        $result = $list->surveyor_gb;
                        return $result;
                    })
                    ->addColumn('keterangan', function ($list) {
                        $result = $list->keterangan_gb;
                        return $result;
                    })
                    ->addColumn('waktu', function ($list) {
                        $result = $list->waktu_gb;
                        return $result;
                    })
                    ->addColumn('tempat', function ($list) {
                        $result = $list->tempat_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_dibawa', function ($list) {
                        $result = $list->z_yang_dibawa_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_ditolak', function ($list) {
                        $result = $list->z_yang_ditolak_gb;
                        return $result;
                    })
                    ->rawColumns(['nama_vendor', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function output_gabah_ketan_putih_nego_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                $site_qc = QcAdmin::select('site_qc')->where('site_qc', Auth::user()->site_qc)->first();
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('lab2_gb.aksi_harga_gb', 'NEGO')
                    ->where('bid.name_bid', 'GABAH BASAH KETAN PUTIH')

                    ->get())
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = \Carbon\Carbon::parse($list->date_biduser)->isoFormat('DD-MM-Y hh:mm:ss');
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = $list->tonase_awal;
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = $list->tonase_akhir;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = 'Rp.' . $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = 'Rp.' . $list->harga_berdasarkan_tempat_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = 'Rp.' . $list->harga_berdasarkan_harga_atas_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = 'Rp.' . $list->harga_awal_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return '
                   <a style="margin:2px;" readonly class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    NEGO
                </a>';
                    })
                    ->addColumn('surveyor', function ($list) {
                        $result = $list->surveyor_gb;
                        return $result;
                    })
                    ->addColumn('keterangan', function ($list) {
                        $result = $list->keterangan_gb;
                        return $result;
                    })
                    ->addColumn('waktu', function ($list) {
                        $result = $list->waktu_gb;
                        return $result;
                    })
                    ->addColumn('tempat', function ($list) {
                        $result = $list->tempat_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_dibawa', function ($list) {
                        $result = $list->z_yang_dibawa_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_ditolak', function ($list) {
                        $result = $list->z_yang_ditolak_gb;
                        return $result;
                    })
                    ->rawColumns(['nama_vendor', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    // ->whereBetween('data_po.tanggal_po', array($request->from_date, $to_date))
                    ->where('lab2_gb.aksi_harga_gb', 'NEGO')
                    ->where('bid.name_bid', 'GABAH BASAH KETAN PUTIH')

                    ->get())
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = \Carbon\Carbon::parse($list->date_biduser)->isoFormat('DD-MM-Y hh:mm:ss');
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = $list->tonase_awal;
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = $list->tonase_akhir;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = 'Rp.' . $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = 'Rp.' . $list->harga_berdasarkan_tempat_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = 'Rp.' . $list->harga_berdasarkan_harga_atas_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = 'Rp.' . $list->harga_awal_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return '
                   <a style="margin:2px;" readonly class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    NEGO
                </a>';
                    })
                    ->addColumn('surveyor', function ($list) {
                        $result = $list->surveyor_gb;
                        return $result;
                    })
                    ->addColumn('keterangan', function ($list) {
                        $result = $list->keterangan_gb;
                        return $result;
                    })
                    ->addColumn('waktu', function ($list) {
                        $result = $list->waktu_gb;
                        return $result;
                    })
                    ->addColumn('tempat', function ($list) {
                        $result = $list->tempat_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_dibawa', function ($list) {
                        $result = $list->z_yang_dibawa_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_ditolak', function ($list) {
                        $result = $list->z_yang_ditolak_gb;
                        return $result;
                    })
                    ->rawColumns(['nama_vendor', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function show_output_nego($id)
    {
        $data1 = PenerimaanPO::where('id_penerimaan_po', $id)->first();
        $data2 = DB::table('gabahfinishing_qc')->where('gabahincoming_kode_po', $data1->penerimaan_kode_po)->first();
        return json_encode($data2);
    }

    // plan hpp gabah basah
    public function plan_hpp_gabah_basah_ciherang_index(Request $req)
    {
        if ($req->ajax()) {
            $data = PlanHppGabahBasah::orderBy('id_plan_hpp_gb', 'DESC')->where('nama_item', 'GABAH BASAH CIHERANG')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('harga_gb', function ($list) {
                    $result = $list->harga_gb;
                    return 'Rp ' . number_format($result, 0, ',', '.');
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" id="btnEdit" data-mintp="' . $row->min_tp_gb . '" data-maxtp="' . $row->max_tp_gb . '" data-tanggal_po="' . $row->waktu_plan_hpp_gb . '" data-harga="' . $row->harga_gb . '" data-id="' . $row->id_plan_hpp_gb . '" data-item="' . $row->nama_item . '" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only mr-1">Edit <i class="fa fa-pen-alt"></i></a>';
                    $btn = $btn . '<button id="btnDelete" data-id="' . $row->id_plan_hpp_gb . '" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">Delete <i class="fa fa-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['harga_gb', 'action'])
                ->make(true);
        }
    }
    public function plan_hpp_gabah_basah_longgrain_index(Request $req)
    {
        if ($req->ajax()) {
            $data = PlanHppGabahBasah::orderBy('id_plan_hpp_gb', 'DESC')->where('nama_item', 'GABAH BASAH LONG GRAIN')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('harga_gb', function ($list) {
                    if ($list->harga_gb == '') {
                        return 'Rp. 0';
                    } else {
                        $result = $list->harga_gb;
                        return 'Rp ' . number_format($result, 0, ',', '.');
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" id="btnEdit" data-mintp="' . $row->min_tp_gb . '" data-maxtp="' . $row->max_tp_gb . '" data-tanggal_po="' . $row->waktu_plan_hpp_gb . '" data-harga="' . $row->harga_gb . '" data-id="' . $row->id_plan_hpp_gb . '" data-item="' . $row->nama_item . '" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only mr-1">Edit <i class="fa fa-pen-alt"></i></a>';
                    $btn = $btn . '<button id="btnDelete" data-id="' . $row->id_plan_hpp_gb . '" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">Delete <i class="fa fa-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['harga_gb', 'action'])
                ->make(true);
        }
    }
    public function plan_hpp_gabah_basah_pandanwangi_index(Request $req)
    {
        if ($req->ajax()) {
            $data = PlanHppGabahBasah::orderBy('id_plan_hpp_gb', 'DESC')->where('nama_item', 'GABAH BASAH PANDAN WANGI')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('harga_gb', function ($list) {
                    if ($list->harga_gb == '') {
                        return 'Rp. 0';
                    } else {
                        $result = $list->harga_gb;
                        return 'Rp ' . number_format($result, 0, ',', '.');
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" id="btnEdit" data-mintp="' . $row->min_tp_gb . '" data-maxtp="' . $row->max_tp_gb . '" data-tanggal_po="' . $row->waktu_plan_hpp_gb . '" data-harga="' . $row->harga_gb . '" data-id="' . $row->id_plan_hpp_gb . '" data-item="' . $row->nama_item . '" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only mr-1">Edit <i class="fa fa-pen-alt"></i></a>';
                    $btn = $btn . '<button id="btnDelete" data-id="' . $row->id_plan_hpp_gb . '" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">Delete <i class="fa fa-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['harga_gb', 'action'])
                ->make(true);
        }
    }
    public function plan_hpp_gabah_basah_ketanputih_index(Request $req)
    {
        if ($req->ajax()) {
            $data = PlanHppGabahBasah::orderBy('id_plan_hpp_gb', 'DESC')->where('nama_item', 'GABAH BASAH KETAN PUTIH')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('harga_gb', function ($list) {
                    if ($list->harga_gb == '') {
                        return 'Rp. 0';
                    } else {
                        $result = $list->harga_gb;
                        return 'Rp ' . number_format($result, 0, ',', '.');
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" id="btnEdit" data-mintp="' . $row->min_tp_gb . '" data-maxtp="' . $row->max_tp_gb . '" data-tanggal_po="' . $row->waktu_plan_hpp_gb . '" data-harga="' . $row->harga_gb . '" data-id="' . $row->id_plan_hpp_gb . '" data-item="' . $row->nama_item . '" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only mr-1">Edit <i class="fa fa-pen-alt"></i></a>';
                    $btn = $btn . '<button id="btnDelete" data-id="' . $row->id_plan_hpp_gb . '" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">Delete <i class="fa fa-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['harga_gb', 'action'])
                ->make(true);
        }
    }
    public function plan_hpp_gabah_basah()
    {
        $data = DB::table('item')->where('nama_item', 'LIKE', '%GABAH BASAH%')->get();
        return view('dashboard.admin_qc.plan_hpp_gabah_basah', compact('data'));
    }
    public function simpan_plan_hpp_gabah_basah(Request $req)
    {
        // dd($req->all());
        $id_plan_hpp = $req->id_plan_hpp;
        if ($id_plan_hpp == '') {
            $data =  new PlanHppGabahBasah();
            $data->nama_item             = $req->nama_item;
            $data->min_tp_gb             = $req->add_min_tp;
            $data->max_tp_gb             = $req->add_max_tp;
            $data->harga_gb              = $req->add_harga;
            $data->waktu_plan_hpp_gb     = $req->add_tanggal_po;
            $data->save();


            $log                               = new LogAktivityLab();
            $log->nama_user                    = Auth::guard('lab')->user()->name_qc;
            $log->id_objek_aktivitas_lab       = $data->id_plan_hpp_gb;
            $log->aktivitas_lab                = 'Insert Plan HPP Tanggal PO:' . $req->add_tanggal_po . ' Harga: ' . $req->add_harga;
            $log->keterangan_aktivitas         = 'Selesai';
            $log->created_at                   = date('Y-m-d H:i:s');
            $log->save();
        } else {
            $data = PlanHppGabahBasah::where('id_plan_hpp_gb', $id_plan_hpp)->first();
            $data->nama_item             = $req->nama_item_edit;
            $data->min_tp_gb             = $req->min_tp;
            $data->max_tp_gb             = $req->max_tp;
            $data->harga_gb              = $req->harga;
            $data->waktu_plan_hpp_gb     = $req->tanggal_po;
            $data->update();


            $log                               = new LogAktivityLab();
            $log->nama_user                    = Auth::guard('lab')->user()->name_qc;
            $log->id_objek_aktivitas_lab       = $id_plan_hpp;
            $log->aktivitas_lab                = 'Update Plan HPP Tanggal PO:' . $req->tanggal_po;
            $log->keterangan_aktivitas         = 'Selesai';
            $log->created_at                   = date('Y-m-d H:i:s');
            $log->save();
        }
        return response()->json($data);
    }
    public function partial_plan_hpp_gabah_basah($id_plan_hpp)
    {
        $data = PlanHppGabahBasah::where('id_plan_hpp_gb', $id_plan_hpp)->firstOrFail();
        return response()->json($data);
    }
    public function delete_plan_hpp_gabah_basah($id)
    {
        $data = DB::table('plan_hpp_gabah_basah')->where('id_plan_hpp_gb', $id)->first();
        $log                               = new LogAktivityLab();
        $log->nama_user                    = Auth::guard('lab')->user()->name_qc;
        $log->id_objek_aktivitas_lab       = $data->id_plan_hpp_gb;
        $log->aktivitas_lab                = 'Delete Plan HPP Tanggal PO:' . $data->waktu_plan_hpp_gb;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();
        $data = DB::table('plan_hpp_gabah_basah')->where('id_plan_hpp_gb', $id)->delete();
    }
    // plan hpp gabah kering
    public function plan_hpp_gabah_kering_index(Request $req)
    {
        if ($req->ajax()) {
            $data = PlanHppGabahKering::orderBy('id_plan_hpp_gk', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" id="btnEdit" data-id="' . $row->id_plan_hpp_gk . '" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only mr-1">Edit <i class="fa fa-pen-alt"></i></a>';
                    $btn = $btn . '<button id="btnDelete" data-id="' . $row->id_plan_hpp_gk . '" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">Delete <i class="fa fa-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function plan_hpp_gabah_kering()
    {
        return view('dashboard.admin_qc.plan_hpp_gabah_kering ');
    }
    public function simpan_plan_hpp_gabah_kering(Request $req)
    {
        $id_plan_hpp = $req->id_plan_hpp;
        $min_tp = $req->min_tp;
        $max_tp = $req->max_tp;
        $harga = $req->harga;
        $tanggal_po = $req->tanggal_po;
        if ($id_plan_hpp == '') {
            $data = DB::table('plan_hpp_gabah_kering')
                ->insert([
                    'min_tp_gk'             => $req->add_min_tp,
                    'max_tp_gk'             => $req->add_max_tp,
                    'harga_gk'              => $req->add_harga,
                    'waktu_plan_hpp_gk'     => $req->add_tanggal_po,
                ]);
        } else {
            $data = DB::table('plan_hpp_gabah_kering')
                ->where('id_plan_hpp_gk', $id_plan_hpp)
                ->update([
                    'min_tp_gk'             => $min_tp,
                    'max_tp_gk'             => $max_tp,
                    'harga_gk'              => $harga,
                    'waktu_plan_hpp_gk'     => $tanggal_po,
                ]);
        }
        return response()->json($data);
    }
    public function partial_plan_hpp_gabah_kering($id_plan_hpp)
    {
        $data = PlanHppGabahKering::where('id_plan_hpp_gk', $id_plan_hpp)->firstOrFail();
        return response()->json($data);
    }
    public function delete_plan_hpp_gabah_kering($id)
    {
        $data = DB::table('plan_hpp_gabah_kering')->where('id_plan_hpp_gk', $id)->delete();
    }
    // plan hpp pk 
    public function plan_hpp_pecah_kulit_index(Request $req)
    {

        if ($req->ajax()) {
            $data = PlanHppPecahKulit::orderBy('id_plan_hpp_pk', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" id="btnEdit" data-id="' . $row->id_plan_hpp_pk . '" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only mr-1">Edit <i class="fa fa-pen-alt"></i></a>';
                    $btn = $btn . '<button id="btnDelete" data-id="' . $row->id_plan_hpp_pk . '" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">Delete <i class="fa fa-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function plan_hpp_pecah_kulit()
    {
        return view('dashboard.admin_qc.plan_hpp_beras_pecah_kulit ');
    }
    public function simpan_plan_hpp_pecah_kulit(Request $req)
    {
        $id_plan_hpp        = $req->id_plan_hpp;
        $min_tp             = $req->min_tp;
        $max_tp             = $req->max_tp;
        $harga              = $req->harga;
        $tanggal_po         = $req->tanggal_po;
        if ($id_plan_hpp == '') {
            $data = DB::table('plan_hpp_pecah_kulit')
                ->insert([
                    'min_tp_pk' => $req->add_min_tp,
                    'max_tp_pk' => $req->add_max_tp,
                    'harga_pk' => $req->add_harga,
                    'waktu_plan_hpp_pk' => $req->add_tanggal_po,
                ]);
        } else {
            $data = DB::table('plan_hpp_pecah_kulit')
                ->where('id_plan_hpp_pk', $id_plan_hpp)
                ->update([
                    'min_tp_pk' => $min_tp,
                    'max_tp_pk' => $max_tp,
                    'harga_pk' => $harga,
                    'waktu_plan_hpp_pk' => $tanggal_po,
                ]);
        }

        return response()->json($data);
    }
    public function partial_plan_hpp_pecah_kulit($id_plan_hpp)
    {
        $data = PlanHppPecahKulit::where('id_plan_hpp_pk', $id_plan_hpp)->firstOrFail();
        return response()->json($data);
    }
    public function delete_plan_hpp_pecah_kulit($id)
    {
        $data = DB::table('plan_hpp_pecah_kulit')->where('id_plan_hpp_pk', $id)->delete();
    }
    // plan hpp DS
    public function plan_hpp_beras_ds_index(Request $req)
    {
        if ($req->ajax()) {
            $data = PlanHppBerasDs::orderBy('id_plan_hpp_ds', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" id="btnEdit" data-id="' . $row->id_plan_hpp_ds . '" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only mr-1">Edit <i class="fa fa-pen-alt"></i></a>';
                    $btn = $btn . '<button id="btnDelete" data-id="' . $row->id_plan_hpp_ds . '" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">Delete <i class="fa fa-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function plan_hpp_beras_ds()
    {
        return view('dashboard.admin_qc.plan_hpp_beras_ds ');
    }
    public function simpan_plan_hpp_beras_ds(Request $req)
    {
        // dd($req->all());
        $id_plan_hpp        = $req->id_plan_hpp;
        $min_tp             = $req->min_tp;
        $max_tp             = $req->max_tp;
        $harga              = $req->harga;
        $tanggal_po         = $req->tanggal_po;
        if ($id_plan_hpp == '') {
            $data = new PlanHppBerasDs();
            $data->min_tp_ds         = $req->add_min_tp;
            $data->max_tp_ds         = $req->add_max_tp;
            $data->harga_ds          = $req->add_harga;
            $data->waktu_plan_hpp_ds = $req->add_tanggal_po;
            $data->save();
        } else {
            $data = PlanHppBerasDs::where('id_plan_hpp_ds', $id_plan_hpp)->first();
            $data->min_tp_ds         = $min_tp;
            $data->max_tp_ds         = $max_tp;
            $data->harga_ds          = $harga;
            $data->waktu_plan_hpp_Ds = $tanggal_po;
            $data->update();
        }

        return response()->json($data);
    }
    public function partial_plan_hpp_beras_ds($id_plan_hpp)
    {
        $data = PlanHppBerasDs::where('id_plan_hpp_ds', $id_plan_hpp)->firstOrFail();
        return response()->json($data);
    }
    public function delete_plan_hpp_beras_ds($id)
    {
        $data = DB::table('plan_hpp_beras_ds')->where('id_plan_hpp_ds', $id)->delete();
    }

    public function parameter_gb(Request $req)
    {
        return view('dashboard.admin_qc.parameter_lab_gb');
    }

    public function parameter_pk_refraksi(Request $req)
    {
        return view('dashboard.admin_qc.parameter_lab_pk_refraksi');
    }

    public function parameter_lab_pk_reward(Request $req)
    {
        return view('dashboard.admin_qc.parameter_lab_pk_reward');
    }

    public function parameter_lab_pk_kualitas(Request $req)
    {
        return view('dashboard.admin_qc.parameter_lab_pk_kualitas');
    }

    public function parameter_beras_ds(Request $req)
    {
        return view('dashboard.admin_qc.parameter_lab_beras_ds');
    }

    public function parameter_gk(Request $req)
    {
        return view('dashboard.admin_qc.parameter_lab_gk');
    }

    public function simpan_parameter_lab_gb(Request $req)
    {
        $hampa = $req->hampa;
        $broken = $req->broken;
        $randoman = $req->randoman;
        $kadar_air = $req->kadar_air;

        $data = ParameterLab::create([
            'hampa' => $hampa,
            'broken' => $broken,
            'randoman' => $randoman,
            'kadar_air' => $kadar_air,
            'tanggal' => Carbon::now()->format('d/m/Y'),
        ]);

        return response()->json($data);
    }

    public function parameter_lab_gb_index()
    {
        return Datatables::of(DB::table('parameter_lab')->orderBy('id_parameter', 'DESC')->get())
            ->addColumn('hampa', function ($list) {
                $result = $list->hampa;
                return $result;
            })
            ->addColumn('broken', function ($list) {
                $result = $list->broken;
                return $result;
            })
            ->addColumn('randoman', function ($list) {
                $result = $list->randoman;
                return $result;
            })
            ->addColumn('kadar_air', function ($list) {
                $result = $list->kadar_air;
                return $result;
            })
            ->addColumn('tanggal', function ($list) {
                $result = $list->tanggal;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_parameter . '" data-toggle="modal" data-target="#modal_edit" title="Information" class="to_parameter btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                 <a style="margin:2px;" href="' . route('qc.lab.destroy_parameter_lab_gb', ['id' => $list->id_parameter]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Hapus <i class="fa fa-trash"></i>
                </a>';
            })
            ->rawColumns(['hampa', 'broken', 'randoman', 'kadar_air', 'tanggal', 'ckelola'])
            ->make(true);
    }

    public function show_parameter_gb($id)
    {
        $data = DB::table('parameter_lab')->where('id_parameter', $id)->first();
        return json_encode($data);
    }

    public function store_parameter_lab_gb(Request $request)
    {
        $data               = new ParameterLab();
        $data->hampa        = $request->hampa;
        $data->broken       = $request->broken;
        $data->randoman     = $request->randoman;
        $data->kadar_air    = $request->kadar_air;
        $data->tanggal      = $request->tanggal;
        $data->save();
        return redirect()->back();
    }

    public function update_parameter_lab_gb(Request $request)
    {
        $data               = ParameterLab::where('id_parameter', $request->id_parameter)->first();
        $data->hampa        = $request->hampa;
        $data->broken       = $request->broken;
        $data->randoman     = $request->randoman;
        $data->kadar_air    = $request->kadar_air;
        $data->tanggal      = $request->tanggal;
        $data->update();
        return redirect()->back();
    }

    public function destroy_parameter_lab_gb($id)
    {
        $data = ParameterLab::where('id_parameter', $id)->delete();
        return redirect()->back();
    }

    public function parameter_lab_pk_kadar_air_store(Request $request)
    {
        // Save Kadar Air 1
        $data                                   = new ParameterLabPkKa();
        $data->min_ka_parameter_lab_pk_ka       = $request->min1_ka_pk;
        $data->max_ka_parameter_lab_pk_ka       = $request->max1_ka_pk;
        $data->harga_parameter_lab_pk_ka        = $request->nilai1_ka_pk;
        $data->tanggal_po_parameter_lab_pk_ka   = $request->tanggal_po_pk;
        $data->save();
        // Save Kadar Air 2
        $data                                   = new ParameterLabPkKa();
        $data->min_ka_parameter_lab_pk_ka       = $request->min2_ka_pk;
        $data->max_ka_parameter_lab_pk_ka       = $request->max2_ka_pk;
        $data->harga_parameter_lab_pk_ka        = $request->nilai2_ka_pk;
        $data->tanggal_po_parameter_lab_pk_ka   = $request->tanggal_po_pk;
        $data->save();
        // Save Kadar Air 3
        $data                                   = new ParameterLabPkKa();
        $data->min_ka_parameter_lab_pk_ka       = $request->min3_ka_pk;
        $data->max_ka_parameter_lab_pk_ka       = $request->max3_ka_pk;
        $data->harga_parameter_lab_pk_ka        = $request->nilai3_ka_pk;
        $data->tanggal_po_parameter_lab_pk_ka   = $request->tanggal_po_pk;
        $data->save();

        // Save Hampa1
        $data                                       = new ParameterLabPkHampa();
        $data->min_parameter_lab_pk_hampa           = $request->min1_hampa_pk;
        $data->max_parameter_lab_pk_hampa           = $request->max1_hampa_pk;
        $data->harga_parameter_lab_pk_hampa         = $request->nilai1_hampa_pk;
        $data->tanggal_parameter_lab_pk_hampa       = $request->tanggal_po_pk;
        $data->save();
        // Save Hampa2
        $data                                       = new ParameterLabPkHampa();
        $data->min_parameter_lab_pk_hampa           = $request->min2_hampa_pk;
        $data->max_parameter_lab_pk_hampa           = $request->max2_hampa_pk;
        $data->harga_parameter_lab_pk_hampa         = $request->nilai2_hampa_pk;
        $data->tanggal_parameter_lab_pk_hampa       = $request->tanggal_po_pk;
        $data->save();
        // Save Hampa3
        $data                                       = new ParameterLabPkHampa();
        $data->min_parameter_lab_pk_hampa           = $request->min3_hampa_pk;
        $data->max_parameter_lab_pk_hampa           = $request->max3_hampa_pk;
        $data->harga_parameter_lab_pk_hampa         = $request->nilai3_hampa_pk;
        $data->tanggal_parameter_lab_pk_hampa       = $request->tanggal_po_pk;
        $data->save();

        //  Save TR 1
        $data                                    = new ParameterLabPkTr();
        $data->min_parameter_lab_pk_tr           = $request->min1_tr_pk;
        $data->max_parameter_lab_pk_tr           = $request->max1_tr_pk;
        $data->harga_parameter_lab_pk_tr         = $request->nilai1_tr_pk;
        $data->tanggal_parameter_lab_pk_tr       = $request->tanggal_po_pk;
        $data->kualitas_parameter_lab_pk_tr      = $request->kualitas1_tr_pk;
        $data->save();
        //  Save TR 2
        $data                                    = new ParameterLabPkTr();
        $data->min_parameter_lab_pk_tr           = $request->min2_tr_pk;
        $data->max_parameter_lab_pk_tr           = $request->max2_tr_pk;
        $data->harga_parameter_lab_pk_tr         = $request->nilai2_tr_pk;
        $data->tanggal_parameter_lab_pk_tr       = $request->tanggal_po_pk;
        $data->kualitas_parameter_lab_pk_tr      = $request->kualitas2_tr_pk;
        $data->save();
        //  Save TR 3
        $data                                    = new ParameterLabPkTr();
        $data->min_parameter_lab_pk_tr           = $request->min3_tr_pk;
        $data->max_parameter_lab_pk_tr           = $request->max3_tr_pk;
        $data->harga_parameter_lab_pk_tr         = $request->nilai3_tr_pk;
        $data->tanggal_parameter_lab_pk_tr       = $request->tanggal_po_pk;
        $data->kualitas_parameter_lab_pk_tr      = $request->kualitas3_tr_pk;
        $data->save();
        //  Save TR 4
        $data                                    = new ParameterLabPkTr();
        $data->min_parameter_lab_pk_tr           = $request->min4_tr_pk;
        $data->max_parameter_lab_pk_tr           = $request->max4_tr_pk;
        $data->harga_parameter_lab_pk_tr         = $request->nilai4_tr_pk;
        $data->tanggal_parameter_lab_pk_tr       = $request->tanggal_po_pk;
        $data->kualitas_parameter_lab_pk_tr      = $request->kualitas4_tr_pk;
        $data->save();

        //  Save Katul 1
        $data                                       = new ParameterLabPkKatul();
        $data->min_parameter_lab_pk_katul           = $request->min1_katul_pk;
        $data->max_parameter_lab_pk_katul           = $request->max1_katul_pk;
        $data->harga_parameter_lab_pk_katul         = $request->nilai1_katul_pk;
        $data->tanggal_parameter_lab_pk_katul       = $request->tanggal_po_pk;
        $data->save();
        //  Save Katul 2
        $data                                       = new ParameterLabPkKatul();
        $data->min_parameter_lab_pk_katul           = $request->min2_katul_pk;
        $data->max_parameter_lab_pk_katul           = $request->max2_katul_pk;
        $data->harga_parameter_lab_pk_katul         = $request->nilai2_katul_pk;
        $data->tanggal_parameter_lab_pk_katul       = $request->tanggal_po_pk;
        $data->save();
        //  Save Katul 3
        $data                                       = new ParameterLabPkKatul();
        $data->min_parameter_lab_pk_katul           = $request->min3_katul_pk;
        $data->max_parameter_lab_pk_katul           = $request->max3_katul_pk;
        $data->harga_parameter_lab_pk_katul         = $request->nilai3_katul_pk;
        $data->tanggal_parameter_lab_pk_katul       = $request->tanggal_po_pk;
        $data->save();

        // Save Butiran Patah 1
        $data                                               = new ParameterLabPkButiranPatah();
        $data->min_parameter_lab_pk_butiran_patah           = $request->min1_butirpatah_pk;
        $data->max_parameter_lab_pk_butiran_patah           = $request->max1_butirpatah_pk;
        $data->harga_parameter_lab_pk_butiran_patah         = $request->nilai1_butirpatah_pk;
        $data->tanggal_parameter_lab_pk_butiran_patah       = $request->tanggal_po_pk;
        $data->save();
        // Save Butiran Patah 2
        $data                                               = new ParameterLabPkButiranPatah();
        $data->min_parameter_lab_pk_butiran_patah           = $request->min2_butirpatah_pk;
        $data->max_parameter_lab_pk_butiran_patah           = $request->max2_butirpatah_pk;
        $data->harga_parameter_lab_pk_butiran_patah         = $request->nilai2_butirpatah_pk;
        $data->tanggal_parameter_lab_pk_butiran_patah       = $request->tanggal_po_pk;
        $data->save();
        // Save Butiran Patah 3
        $data                                               = new ParameterLabPkButiranPatah();
        $data->min_parameter_lab_pk_butiran_patah           = $request->min3_butirpatah_pk;
        $data->max_parameter_lab_pk_butiran_patah           = $request->max3_butirpatah_pk;
        $data->harga_parameter_lab_pk_butiran_patah         = $request->nilai3_butirpatah_pk;
        $data->tanggal_parameter_lab_pk_butiran_patah       = $request->tanggal_po_pk;
        $data->save();
        return redirect()->back();
    }

    public function parameter_lab_pk_kadar_air_index()
    {
        return Datatables::of(DB::table('parameter_lab_pk_ka')->orderBy('id_parameter_lab_pk_ka', 'DESC')->get())
            ->addColumn('min_ka_parameter_lab_pk_ka', function ($list) {
                $result = $list->min_ka_parameter_lab_pk_ka . '%';
                return $result;
            })
            ->addColumn('max_ka_parameter_lab_pk_ka', function ($list) {
                $result = $list->max_ka_parameter_lab_pk_ka . '%';
                return $result;
            })
            ->addColumn('harga_parameter_lab_pk_ka', function ($list) {
                $result = $list->harga_parameter_lab_pk_ka;
                return $result;
            })
            ->addColumn('tanggal_po_parameter_lab_pk_ka', function ($list) {
                $result = $list->tanggal_po_parameter_lab_pk_ka;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_parameter_lab_pk_ka . '" data-toggle="modal" data-target="#modal_edit_ka" title="Information" class="to_parameter_ka btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                 <button id="btn_delete_ka" style="margin:2px;" data-id="' . $list->id_parameter_lab_pk_ka . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Hapus <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['hampa', 'broken', 'randoman', 'kadar_air', 'tanggal', 'ckelola'])
            ->make(true);
    }

    public function parameter_lab_pk_kadar_air_show($id)
    {
        $data = DB::table('parameter_lab_pk_ka')->where('id_parameter_lab_pk_ka', $id)->first();
        return json_encode($data);
    }

    public function parameter_lab_pk_kadar_air_update(Request $request)
    {
        $data                                   = ParameterLabPkKa::where('id_parameter_lab_pk_ka', $request->id_parameter_lab_pk_ka)->first();
        $data->min_ka_parameter_lab_pk_ka       = $request->min_ka_parameter_lab_pk_ka;
        $data->max_ka_parameter_lab_pk_ka       = $request->max_ka_parameter_lab_pk_ka;
        $data->harga_parameter_lab_pk_ka        = $request->harga_parameter_lab_pk_ka;
        $data->tanggal_po_parameter_lab_pk_ka   = $request->tanggal_po_parameter_lab_pk_ka;
        $data->update();
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1500);
    }

    public function parameter_lab_pk_kadar_air_destroy($id)
    {
        $data = ParameterLabPkKa::where('id_parameter_lab_pk_ka', $id)->delete();
        // return redirect()->back();
    }



    public function parameter_lab_pk_hampa_index()
    {
        return Datatables::of(DB::table('parameter_lab_pk_hampa')->orderBy('id_parameter_lab_pk_hampa', 'DESC')->get())
            ->addColumn('min_parameter_lab_pk_hampa', function ($list) {
                $result = $list->min_parameter_lab_pk_hampa . '%';
                return $result;
            })
            ->addColumn('max_parameter_lab_pk_hampa', function ($list) {
                $result = $list->max_parameter_lab_pk_hampa . '%';
                return $result;
            })
            ->addColumn('harga_parameter_lab_pk_hampa', function ($list) {
                $result = $list->harga_parameter_lab_pk_hampa;
                return $result;
            })
            ->addColumn('tanggal_parameter_lab_pk_hampa', function ($list) {
                $result = $list->tanggal_parameter_lab_pk_hampa;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_parameter_lab_pk_hampa . '" data-toggle="modal" data-target="#modal_edit_hampa" title="Information" class="to_parameter_hampa btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                <button id="btn_delete_hampa" style="margin:2px;" data-id="' . $list->id_parameter_lab_pk_hampa . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Hapus <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['min_parameter_lab_pk_hampa', 'max_parameter_lab_pk_hampa', 'harga_parameter_lab_pk_hampa', 'tanggal_parameter_lab_pk_hampa', 'ckelola'])
            ->make(true);
    }

    public function parameter_lab_pk_hampa_show($id)
    {
        $data = DB::table('parameter_lab_pk_hampa')->where('id_parameter_lab_pk_hampa', $id)->first();
        return json_encode($data);
    }

    public function parameter_lab_pk_hampa_update(Request $request)
    {
        $data                                   = ParameterLabPkHampa::where('id_parameter_lab_pk_hampa', $request->id_parameter_lab_pk_hampa)->first();
        $data->min_parameter_lab_pk_hampa       = $request->min_parameter_lab_pk_hampa;
        $data->max_parameter_lab_pk_hampa       = $request->max_parameter_lab_pk_hampa;
        $data->harga_parameter_lab_pk_hampa     = $request->harga_parameter_lab_pk_hampa;
        $data->tanggal_parameter_lab_pk_hampa   = $request->tanggal_parameter_lab_pk_hampa;
        $data->update();
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1500);
    }

    public function parameter_lab_pk_hampa_destroy($id)
    {
        $data = ParameterLabPkHampa::where('id_parameter_lab_pk_hampa', $id)->delete();
        // return redirect()->back();
    }

    public function parameter_lab_pk_tr_index()
    {
        return Datatables::of(DB::table('parameter_lab_pk_tr')->orderBy('id_parameter_lab_pk_tr', 'DESC')->get())
            ->addColumn('min_parameter_lab_pk_tr', function ($list) {
                $result = $list->min_parameter_lab_pk_tr . '%';
                return $result;
            })
            ->addColumn('max_parameter_lab_pk_tr', function ($list) {
                $result = $list->max_parameter_lab_pk_tr . '%';
                return $result;
            })
            ->addColumn('harga_parameter_lab_pk_tr', function ($list) {
                $result = $list->harga_parameter_lab_pk_tr;
                return $result;
            })
            ->addColumn('kualitas_parameter_lab_pk_tr', function ($list) {
                $result = $list->kualitas_parameter_lab_pk_tr;
                return $result;
            })
            ->addColumn('tanggal_parameter_lab_pk_tr', function ($list) {
                $result = $list->tanggal_parameter_lab_pk_tr;
                return $result;
            })

            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_parameter_lab_pk_tr . '" data-toggle="modal" data-target="#modal_edit_tr" title="Information" class="to_parameter_tr btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                <button id="btn_delete_tr" style="margin:2px;" data-id="' . $list->id_parameter_lab_pk_tr . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Hapus <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['min_parameter_lab_pk_tr', 'max_parameter_lab_pk_tr', 'harga_parameter_lab_pk_tr', 'kualitas_parameter_lab_pk_tr', 'tanggal_parameter_lab_pk_tr', 'ckelola'])
            ->make(true);
    }

    public function parameter_lab_pk_tr_show($id)
    {
        $data = DB::table('parameter_lab_pk_tr')->where('id_parameter_lab_pk_tr', $id)->first();
        return json_encode($data);
    }

    public function parameter_lab_pk_tr_update(Request $request)
    {
        $data                                = ParameterLabPkTr::where('id_parameter_lab_pk_tr', $request->id_parameter_lab_pk_tr)->first();
        $data->min_parameter_lab_pk_tr       = $request->min_parameter_lab_pk_tr;
        $data->max_parameter_lab_pk_tr       = $request->max_parameter_lab_pk_tr;
        $data->harga_parameter_lab_pk_tr     = $request->harga_parameter_lab_pk_tr;
        $data->kualitas_parameter_lab_pk_tr  = $request->kualitas_parameter_lab_pk_tr;
        $data->tanggal_parameter_lab_pk_tr   = $request->tanggal_parameter_lab_pk_tr;
        $data->update();
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1500);
    }

    public function parameter_lab_pk_tr_destroy($id)
    {
        $data = ParameterLabPkTr::where('id_parameter_lab_pk_tr', $id)->delete();
        // return redirect()->back();
    }



    public function parameter_lab_pk_katul_index()
    {
        return Datatables::of(DB::table('parameter_lab_pk_katul')->orderBy('id_parameter_lab_pk_katul', 'DESC')->get())
            ->addColumn('min_parameter_lab_pk_tr', function ($list) {
                $result = $list->min_parameter_lab_pk_katul . '%';
                return $result;
            })
            ->addColumn('max_parameter_lab_pk_katul', function ($list) {
                $result = $list->max_parameter_lab_pk_katul . '%';
                return $result;
            })
            ->addColumn('harga_parameter_lab_pk_katul', function ($list) {
                $result = $list->harga_parameter_lab_pk_katul;
                return $result;
            })
            ->addColumn('tanggal_parameter_lab_pk_katul', function ($list) {
                $result = $list->tanggal_parameter_lab_pk_katul;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_parameter_lab_pk_katul . '" data-toggle="modal" data-target="#modal_edit_katul" title="Information" class="to_parameter_katul btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                <button id="btn_delete_katul" style="margin:2px;" data-id="' . $list->id_parameter_lab_pk_katul . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Hapus <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['min_parameter_lab_pk_katul', 'max_parameter_lab_pk_katul', 'harga_parameter_lab_pk_katul', 'tanggal_parameter_lab_pk_katul', 'ckelola'])
            ->make(true);
    }

    public function parameter_lab_pk_katul_show($id)
    {
        $data = DB::table('parameter_lab_pk_katul')->where('id_parameter_lab_pk_katul', $id)->first();
        return json_encode($data);
    }

    public function parameter_lab_pk_katul_update(Request $request)
    {
        $data                                   = ParameterLabPkKatul::where('id_parameter_lab_pk_katul', $request->id_parameter_lab_pk_katul)->first();
        $data->min_parameter_lab_pk_katul       = $request->min_parameter_lab_pk_katul;
        $data->max_parameter_lab_pk_katul       = $request->max_parameter_lab_pk_katul;
        $data->harga_parameter_lab_pk_katul     = $request->harga_parameter_lab_pk_katul;
        $data->tanggal_parameter_lab_pk_katul   = $request->tanggal_parameter_lab_pk_katul;
        $data->update();
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1500);
    }

    public function parameter_lab_pk_katul_destroy($id)
    {
        $data = ParameterLabPkKatul::where('id_parameter_lab_pk_katul', $id)->delete();
        // return redirect()->back();
    }

    public function parameter_lab_pk_butiran_patah_index()
    {
        return Datatables::of(DB::table('parameter_lab_pk_butiran_patah')->orderBy('id_parameter_lab_pk_butiran_patah', 'DESC')->get())
            ->addColumn('min_parameter_lab_pk_butiran_patah', function ($list) {
                $result = $list->min_parameter_lab_pk_butiran_patah . '%';
                return $result;
            })
            ->addColumn('max_parameter_lab_pk_butiran_patah', function ($list) {
                $result = $list->max_parameter_lab_pk_butiran_patah . '%';
                return $result;
            })
            ->addColumn('harga_parameter_lab_pk_butiran_patah', function ($list) {
                $result = $list->harga_parameter_lab_pk_butiran_patah;
                return $result;
            })
            ->addColumn('tanggal_parameter_lab_pk_butiran_patah', function ($list) {
                $result = $list->tanggal_parameter_lab_pk_butiran_patah;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_parameter_lab_pk_butiran_patah . '" data-toggle="modal" data-target="#modal_edit_butirpatah" title="Information" class="to_parameter_butirpatah btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                <button id="btn_delete_butirpatah" style="margin:2px;" data-id="' . $list->id_parameter_lab_pk_butiran_patah . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Hapus <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['min_parameter_lab_pk_butiran_patah', 'max_parameter_lab_pk_butiran_patah', 'harga_parameter_lab_pk_butiran_patah', 'tanggal_parameter_lab_pk_butiran_patah', 'ckelola'])
            ->make(true);
    }

    public function parameter_lab_pk_butiran_patah_show($id)
    {
        $data = DB::table('parameter_lab_pk_butiran_patah')->where('id_parameter_lab_pk_butiran_patah', $id)->first();
        return json_encode($data);
    }

    public function parameter_lab_pk_butiran_patah_update(Request $request)
    {
        $data                                           = ParameterLabPkButiranPatah::where('id_parameter_lab_pk_butiran_patah', $request->id_parameter_lab_pk_butiran_patah)->first();
        $data->min_parameter_lab_pk_butiran_patah       = $request->min_parameter_lab_pk_butiran_patah;
        $data->max_parameter_lab_pk_butiran_patah       = $request->max_parameter_lab_pk_butiran_patah;
        $data->harga_parameter_lab_pk_butiran_patah     = $request->harga_parameter_lab_pk_butiran_patah;
        $data->tanggal_parameter_lab_pk_butiran_patah   = $request->tanggal_parameter_lab_pk_butiran_patah;
        $data->update();
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1500);
    }

    public function parameter_lab_pk_butiran_patah_destroy($id)
    {
        $data = ParameterLabPkButiranPatah::where('id_parameter_lab_pk_butiran_patah', $id)->delete();
        // return redirect()->back();
    }

    public function parameter_lab_pk_reward_kadar_air_store(Request $request)
    {
        $data                                               = new ParameterLabPkRewardKadarAir();
        $data->value_parameter_lab_pk_reward_kadar_air      = $request->value_parameter_lab_pk_reward_kadar_air;
        $data->reward_parameter_lab_pk_reward_kadar_air     = $request->reward_parameter_lab_pk_reward_kadar_air;
        $data->formula_parameter_lab_pk_reward_kadar_air    = $request->formula_parameter_lab_pk_reward_kadar_air;
        $data->tanggal_parameter_lab_pk_reward_kadar_air    = $request->tanggal_parameter_lab_pk_reward_kadar_air;
        $data->save();
        return redirect()->back();
    }

    public function parameter_lab_pk_reward_kadar_air_index()
    {
        return Datatables::of(DB::table('parameter_lab_pk_reward_kadar_air')->orderBy('id_parameter_lab_pk_reward_kadar_air', 'DESC')->get())
            ->addColumn('value_parameter_lab_pk_reward_kadar_air', function ($list) {
                $result = $list->value_parameter_lab_pk_reward_kadar_air . '%';
                return $result;
            })
            ->addColumn('reward_parameter_lab_pk_reward_kadar_air', function ($list) {
                $result = $list->reward_parameter_lab_pk_reward_kadar_air . '%';
                return $result;
            })
            ->addColumn('formula_parameter_lab_pk_reward_kadar_air', function ($list) {
                $result = $list->formula_parameter_lab_pk_reward_kadar_air;
                return $result;
            })
            ->addColumn('tanggal_parameter_lab_pk_reward_kadar_air', function ($list) {
                $result = $list->tanggal_parameter_lab_pk_reward_kadar_air;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_parameter_lab_pk_reward_kadar_air . '" data-toggle="modal" data-target="#modal_edit_ka" title="Information" class="to_parameter_ka btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                <button id="btn_delete_ka" style="margin:2px;" data-id="' . $list->id_parameter_lab_pk_reward_kadar_air . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Hapus <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['value_parameter_lab_pk_reward_kadar_air', 'reward_parameter_lab_pk_reward_kadar_air', 'formula_parameter_lab_pk_reward_kadar_air', 'tanggal_parameter_lab_pk_reward_kadar_air', 'ckelola'])
            ->make(true);
    }

    public function parameter_lab_pk_reward_kadar_air_show($id)
    {
        $data = DB::table('parameter_lab_pk_reward_kadar_air')->where('id_parameter_lab_pk_reward_kadar_air', $id)->first();
        return json_encode($data);
    }

    public function parameter_lab_pk_reward_kadar_air_update(Request $request)
    {
        $data                                               = ParameterLabPkRewardKadarAir::where('id_parameter_lab_pk_reward_kadar_air', $request->id_parameter_lab_pk_reward_kadar_air)->first();
        $data->value_parameter_lab_pk_reward_kadar_air      = $request->value_parameter_lab_pk_reward_kadar_air;
        $data->reward_parameter_lab_pk_reward_kadar_air     = $request->reward_parameter_lab_pk_reward_kadar_air;
        $data->formula_parameter_lab_pk_reward_kadar_air    = $request->formula_parameter_lab_pk_reward_kadar_air;
        $data->tanggal_parameter_lab_pk_reward_kadar_air    = $request->tanggal_parameter_lab_pk_reward_kadar_air;
        $data->update();
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1500);
    }

    public function parameter_lab_pk_reward_kadar_air_destroy($id)
    {
        $data = ParameterLabPkRewardKadarAir::where('id_parameter_lab_pk_reward_kadar_air', $id)->delete();
        // return redirect()->back();
    }

    public function parameter_lab_pk_reward_hampa_store(Request $request)
    {
        // ADD KADAR AIR
        $data                                               = new ParameterLabPkRewardKadarAir();
        $data->value_parameter_lab_pk_reward_kadar_air      = $request->value_ka_pk;
        $data->reward_parameter_lab_pk_reward_kadar_air     = $request->nilai_ka_pk;
        $data->formula_parameter_lab_pk_reward_kadar_air    = $request->formula_ka_pk;
        $data->tanggal_parameter_lab_pk_reward_kadar_air    = $request->tanggal_po_pk;
        $data->save();
        // ADD HAMPA
        $data                                           = new ParameterLabPkRewardHampa();
        $data->value_parameter_lab_pk_reward_hampa      = $request->value_hampa_pk;
        $data->reward_parameter_lab_pk_reward_hampa     = $request->nilai_hampa_pk;
        $data->formula_parameter_lab_pk_reward_hampa    = $request->formula_hampa_pk;
        $data->tanggal_parameter_lab_pk_reward_hampa    = $request->tanggal_po_pk;
        $data->save();
        // ADD TR
        $data                                           = new ParameterLabPkRewardTr();
        $data->value_parameter_lab_pk_reward_tr      = $request->value_tr_pk;
        $data->reward_parameter_lab_pk_reward_tr     = $request->nilai_tr_pk;
        $data->formula_parameter_lab_pk_reward_tr    = $request->formula_tr_pk;
        $data->tanggal_parameter_lab_pk_reward_tr    = $request->tanggal_po_pk;
        $data->save();
        // ADD KATUL
        $data                                           = new ParameterLabPkRewardKatul();
        $data->value_parameter_lab_pk_reward_katul      = $request->value_katul_pk;
        $data->reward_parameter_lab_pk_reward_katul     = $request->nilai_katul_pk;
        $data->formula_parameter_lab_pk_reward_katul    = $request->formula_katul_pk;
        $data->tanggal_parameter_lab_pk_reward_katul    = $request->tanggal_po_pk;
        $data->save();
        // ADD BUTIR PATAH
        $data                                           = new ParameterLabPkRewardButirPatah();
        $data->value_parameter_lab_pk_reward_butir_patah      = $request->value_butirpatah_pk;
        $data->reward_parameter_lab_pk_reward_butir_patah     = $request->nilai_butirpatah_pk;
        $data->formula_parameter_lab_pk_reward_butir_patah    = $request->formula_butirpatah_pk;
        $data->tanggal_parameter_lab_pk_reward_butir_patah    = $request->tanggal_po_pk;
        $data->save();
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1500);
    }

    public function parameter_lab_pk_reward_hampa_index()
    {
        return Datatables::of(DB::table('parameter_lab_pk_reward_hampa')->orderBy('id_parameter_lab_pk_reward_hampa', 'DESC')->get())
            ->addColumn('value_parameter_lab_pk_reward_hampa', function ($list) {
                $result = $list->value_parameter_lab_pk_reward_hampa . '%';
                return $result;
            })
            ->addColumn('reward_parameter_lab_pk_reward_hampa', function ($list) {
                $result = $list->reward_parameter_lab_pk_reward_hampa . '%';
                return $result;
            })
            ->addColumn('formula_parameter_lab_pk_reward_hampa', function ($list) {
                $result = $list->formula_parameter_lab_pk_reward_hampa;
                return $result;
            })
            ->addColumn('tanggal_parameter_lab_pk_reward_hampa', function ($list) {
                $result = $list->tanggal_parameter_lab_pk_reward_hampa;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_parameter_lab_pk_reward_hampa . '" data-toggle="modal" data-target="#modal_edit_hampa" title="Information" class="to_parameter_hampa btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                 <button id="btn_delete_hampa" style="margin:2px;" data-id="' . $list->id_parameter_lab_pk_reward_hampa . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Hapus <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['value_parameter_lab_pk_reward_hampa', 'reward_parameter_lab_pk_reward_hampa', 'formula_parameter_lab_pk_reward_hampa', 'tanggal_parameter_lab_pk_reward_hampa', 'ckelola'])
            ->make(true);
    }

    public function parameter_lab_pk_reward_hampa_show($id)
    {
        $data = DB::table('parameter_lab_pk_reward_hampa')->where('id_parameter_lab_pk_reward_hampa', $id)->first();
        return json_encode($data);
    }

    public function parameter_lab_pk_reward_hampa_update(Request $request)
    {
        $data                                               = ParameterLabPkRewardHampa::where('id_parameter_lab_pk_reward_hampa', $request->id_parameter_lab_pk_reward_hampa)->first();
        $data->value_parameter_lab_pk_reward_hampa      = $request->value_parameter_lab_pk_reward_hampa;
        $data->reward_parameter_lab_pk_reward_hampa     = $request->reward_parameter_lab_pk_reward_hampa;
        $data->formula_parameter_lab_pk_reward_hampa    = $request->formula_parameter_lab_pk_reward_hampa;
        $data->tanggal_parameter_lab_pk_reward_hampa    = $request->tanggal_parameter_lab_pk_reward_hampa;
        $data->update();
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1500);
    }

    public function parameter_lab_pk_reward_hampa_destroy($id)
    {
        $data = ParameterLabPkRewardHampa::where('id_parameter_lab_pk_reward_hampa', $id)->delete();
        // return redirect()->back();
    }

    public function parameter_lab_pk_reward_tr_store(Request $request)
    {
        $data                                           = new ParameterLabPkRewardTr();
        $data->value_parameter_lab_pk_reward_tr      = $request->value_parameter_lab_pk_reward_tr;
        $data->reward_parameter_lab_pk_reward_tr     = $request->reward_parameter_lab_pk_reward_tr;
        $data->formula_parameter_lab_pk_reward_tr    = $request->formula_parameter_lab_pk_reward_tr;
        $data->tanggal_parameter_lab_pk_reward_tr    = $request->tanggal_parameter_lab_pk_reward_tr;
        $data->save();
        return redirect()->back();
    }

    public function parameter_lab_pk_reward_tr_index()
    {
        return Datatables::of(DB::table('parameter_lab_pk_reward_tr')->orderBy('id_parameter_lab_pk_reward_tr', 'DESC')->get())
            ->addColumn('value_parameter_lab_pk_reward_tr', function ($list) {
                $result = $list->value_parameter_lab_pk_reward_tr . '%';
                return $result;
            })
            ->addColumn('reward_parameter_lab_pk_reward_tr', function ($list) {
                $result = $list->reward_parameter_lab_pk_reward_tr . '%';
                return $result;
            })
            ->addColumn('formula_parameter_lab_pk_reward_tr', function ($list) {
                $result = $list->formula_parameter_lab_pk_reward_tr;
                return $result;
            })
            ->addColumn('tanggal_parameter_lab_pk_reward_tr', function ($list) {
                $result = $list->tanggal_parameter_lab_pk_reward_tr;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_parameter_lab_pk_reward_tr . '" data-toggle="modal" data-target="#modal_edit_tr" title="Information" class="to_parameter_tr btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                <button id="btn_delete_tr" style="margin:2px;" data-id="' . $list->id_parameter_lab_pk_reward_tr . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Hapus <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['value_parameter_lab_pk_reward_tr', 'reward_parameter_lab_pk_reward_tr', 'formula_parameter_lab_pk_reward_tr', 'tanggal_parameter_lab_pk_reward_tr', 'ckelola'])
            ->make(true);
    }

    public function parameter_lab_pk_reward_tr_show($id)
    {
        $data = DB::table('parameter_lab_pk_reward_tr')->where('id_parameter_lab_pk_reward_tr', $id)->first();
        return json_encode($data);
    }

    public function parameter_lab_pk_reward_tr_update(Request $request)
    {
        $data                                               = ParameterLabPkRewardTr::where('id_parameter_lab_pk_reward_tr', $request->id_parameter_lab_pk_reward_tr)->first();
        $data->value_parameter_lab_pk_reward_tr      = $request->value_parameter_lab_pk_reward_tr;
        $data->reward_parameter_lab_pk_reward_tr     = $request->reward_parameter_lab_pk_reward_tr;
        $data->formula_parameter_lab_pk_reward_tr    = $request->formula_parameter_lab_pk_reward_tr;
        $data->tanggal_parameter_lab_pk_reward_tr    = $request->tanggal_parameter_lab_pk_reward_tr;
        $data->update();
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1500);
    }

    public function parameter_lab_pk_reward_tr_destroy($id)
    {
        $data = ParameterLabPkRewardTr::where('id_parameter_lab_pk_reward_tr', $id)->delete();
        // return redirect()->back();
    }

    public function parameter_lab_pk_reward_katul_store(Request $request)
    {
        $data                                           = new ParameterLabPkRewardKatul();
        $data->value_parameter_lab_pk_reward_katul      = $request->value_parameter_lab_pk_reward_katul;
        $data->reward_parameter_lab_pk_reward_katul     = $request->reward_parameter_lab_pk_reward_katul;
        $data->formula_parameter_lab_pk_reward_katul    = $request->formula_parameter_lab_pk_reward_katul;
        $data->tanggal_parameter_lab_pk_reward_katul    = $request->tanggal_parameter_lab_pk_reward_katul;
        $data->save();
        return redirect()->back();
    }

    public function parameter_lab_pk_reward_katul_index()
    {
        return Datatables::of(DB::table('parameter_lab_pk_reward_katul')->orderBy('id_parameter_lab_pk_reward_katul', 'DESC')->get())
            ->addColumn('value_parameter_lab_pk_reward_katul', function ($list) {
                $result = $list->value_parameter_lab_pk_reward_katul . '%';
                return $result;
            })
            ->addColumn('reward_parameter_lab_pk_reward_katul', function ($list) {
                $result = $list->reward_parameter_lab_pk_reward_katul . '%';
                return $result;
            })
            ->addColumn('formula_parameter_lab_pk_reward_katul', function ($list) {
                $result = $list->formula_parameter_lab_pk_reward_katul;
                return $result;
            })
            ->addColumn('tanggal_parameter_lab_pk_reward_katul', function ($list) {
                $result = $list->tanggal_parameter_lab_pk_reward_katul;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_parameter_lab_pk_reward_katul . '" data-toggle="modal" data-target="#modal_edit_katul" title="Information" class="to_parameter_katul btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                <button id="btn_delete_katul" style="margin:2px;" data-id="' . $list->id_parameter_lab_pk_reward_katul . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Hapus <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['value_parameter_lab_pk_reward_katul', 'reward_parameter_lab_pk_reward_katul', 'formula_parameter_lab_pk_reward_katul', 'tanggal_parameter_lab_pk_reward_katul', 'ckelola'])
            ->make(true);
    }

    public function parameter_lab_pk_reward_katul_show($id)
    {
        $data = DB::table('parameter_lab_pk_reward_katul')->where('id_parameter_lab_pk_reward_katul', $id)->first();
        return json_encode($data);
    }

    public function parameter_lab_pk_reward_katul_update(Request $request)
    {
        $data                                               = ParameterLabPkRewardKatul::where('id_parameter_lab_pk_reward_katul', $request->id_parameter_lab_pk_reward_katul)->first();
        $data->value_parameter_lab_pk_reward_katul      = $request->value_parameter_lab_pk_reward_katul;
        $data->reward_parameter_lab_pk_reward_katul     = $request->reward_parameter_lab_pk_reward_katul;
        $data->formula_parameter_lab_pk_reward_katul    = $request->formula_parameter_lab_pk_reward_katul;
        $data->tanggal_parameter_lab_pk_reward_katul    = $request->tanggal_parameter_lab_pk_reward_katul;
        $data->update();
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1500);
    }

    public function parameter_lab_pk_reward_katul_destroy($id)
    {
        $data = ParameterLabPkRewardKatul::where('id_parameter_lab_pk_reward_katul', $id)->delete();
        // return redirect()->back();
    }

    public function parameter_lab_pk_reward_butir_patah_store(Request $request)
    {
        $data                                           = new ParameterLabPkRewardButirPatah();
        $data->value_parameter_lab_pk_reward_butir_patah      = $request->value_parameter_lab_pk_reward_butir_patah;
        $data->reward_parameter_lab_pk_reward_butir_patah     = $request->reward_parameter_lab_pk_reward_butir_patah;
        $data->formula_parameter_lab_pk_reward_butir_patah    = $request->formula_parameter_lab_pk_reward_butir_patah;
        $data->tanggal_parameter_lab_pk_reward_butir_patah    = $request->tanggal_parameter_lab_pk_reward_butir_patah;
        $data->save();
        return redirect()->back();
    }

    public function parameter_lab_pk_reward_butir_patah_index()
    {
        return Datatables::of(DB::table('parameter_lab_pk_reward_butir_patah')->orderBy('id_parameter_lab_pk_reward_butir_patah', 'DESC')->get())
            ->addColumn('value_parameter_lab_pk_reward_butir_patah', function ($list) {
                $result = $list->value_parameter_lab_pk_reward_butir_patah;
                return $result;
            })
            ->addColumn('reward_parameter_lab_pk_reward_butir_patah', function ($list) {
                $result = $list->reward_parameter_lab_pk_reward_butir_patah;
                return $result;
            })
            ->addColumn('formula_parameter_lab_pk_reward_butir_patah', function ($list) {
                $result = $list->formula_parameter_lab_pk_reward_butir_patah;
                return $result;
            })
            ->addColumn('tanggal_parameter_lab_pk_reward_butir_patah', function ($list) {
                $result = $list->tanggal_parameter_lab_pk_reward_butir_patah;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_parameter_lab_pk_reward_butir_patah . '" data-toggle="modal" data-target="#modal_edit_butirpatah" title="Information" class="to_parameter_butirpatah btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                <button id="btn_delete_butirpatah" style="margin:2px;" data-id="' . $list->id_parameter_lab_pk_reward_butir_patah . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Hapus <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['value_parameter_lab_pk_reward_butir_patah', 'reward_parameter_lab_pk_reward_butir_patah', 'formula_parameter_lab_pk_reward_butir_patah', 'tanggal_parameter_lab_pk_reward_butir_patah', 'ckelola'])
            ->make(true);
    }

    public function parameter_lab_pk_reward_butir_patah_show($id)
    {
        $data = DB::table('parameter_lab_pk_reward_butir_patah')->where('id_parameter_lab_pk_reward_butir_patah', $id)->first();
        return json_encode($data);
    }

    public function parameter_lab_pk_reward_butir_patah_update(Request $request)
    {
        $data                                               = ParameterLabPkRewardButirPatah::where('id_parameter_lab_pk_reward_butir_patah', $request->id_parameter_lab_pk_reward_butir_patah)->first();
        $data->value_parameter_lab_pk_reward_butir_patah      = $request->value_parameter_lab_pk_reward_butir_patah;
        $data->reward_parameter_lab_pk_reward_butir_patah     = $request->reward_parameter_lab_pk_reward_butir_patah;
        $data->formula_parameter_lab_pk_reward_butir_patah    = $request->formula_parameter_lab_pk_reward_butir_patah;
        $data->tanggal_parameter_lab_pk_reward_butir_patah    = $request->tanggal_parameter_lab_pk_reward_butir_patah;
        $data->update();
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1500);
    }

    public function parameter_lab_pk_reward_butir_patah_destroy($id)
    {
        $data = ParameterLabPkRewardButirPatah::where('id_parameter_lab_pk_reward_butir_patah', $id)->delete();
        // return redirect()->back();
    }

    public function parameter_lab_pk_kualitas_store(Request $request)
    {
        $data                                               = new ParameterLabPkKualitas();
        $data->min_parameter_lab_pk_tr_kualitas             = $request->min_parameter_lab_pk_tr_kualitas1;
        $data->max_parameter_lab_pk_tr_kualitas             = $request->max_parameter_lab_pk_tr_kualitas1;
        $data->min_parameter_lab_pk_butirpatah_kualitas     = $request->min_parameter_lab_pk_butirpatah_kualitas1;
        $data->max_parameter_lab_pk_butirpatah_kualitas     = $request->max_parameter_lab_pk_butirpatah_kualitas1;
        $data->kualitas_parameter_lab_pk                   = $request->kualitas_parameter_lab_pk1;
        $data->tanggal_parameter_lab_pk_kualitas            = $request->tanggal_parameter_lab_pk_kualitas;
        $data->save();

        $data                                               = new ParameterLabPkKualitas();
        $data->min_parameter_lab_pk_tr_kualitas             = $request->min_parameter_lab_pk_tr_kualitas2;
        $data->max_parameter_lab_pk_tr_kualitas             = $request->max_parameter_lab_pk_tr_kualitas2;
        $data->min_parameter_lab_pk_butirpatah_kualitas     = $request->min_parameter_lab_pk_butirpatah_kualitas2;
        $data->max_parameter_lab_pk_butirpatah_kualitas     = $request->max_parameter_lab_pk_butirpatah_kualitas2;
        $data->kualitas_parameter_lab_pk                   = $request->kualitas_parameter_lab_pk2;
        $data->tanggal_parameter_lab_pk_kualitas            = $request->tanggal_parameter_lab_pk_kualitas;
        $data->save();
        $data                                               = new ParameterLabPkKualitas();
        $data->min_parameter_lab_pk_tr_kualitas             = $request->min_parameter_lab_pk_tr_kualitas3;
        $data->max_parameter_lab_pk_tr_kualitas             = $request->max_parameter_lab_pk_tr_kualitas3;
        $data->min_parameter_lab_pk_butirpatah_kualitas     = $request->min_parameter_lab_pk_butirpatah_kualitas3;
        $data->max_parameter_lab_pk_butirpatah_kualitas     = $request->max_parameter_lab_pk_butirpatah_kualitas3;
        $data->kualitas_parameter_lab_pk                   = $request->kualitas_parameter_lab_pk3;
        $data->tanggal_parameter_lab_pk_kualitas            = $request->tanggal_parameter_lab_pk_kualitas;
        $data->save();
        $data                                               = new ParameterLabPkKualitas();
        $data->min_parameter_lab_pk_tr_kualitas             = $request->min_parameter_lab_pk_tr_kualitas4;
        $data->max_parameter_lab_pk_tr_kualitas             = $request->max_parameter_lab_pk_tr_kualitas4;
        $data->min_parameter_lab_pk_butirpatah_kualitas     = $request->min_parameter_lab_pk_butirpatah_kualitas4;
        $data->max_parameter_lab_pk_butirpatah_kualitas     = $request->max_parameter_lab_pk_butirpatah_kualitas4;
        $data->kualitas_parameter_lab_pk                   = $request->kualitas_parameter_lab_pk4;
        $data->tanggal_parameter_lab_pk_kualitas            = $request->tanggal_parameter_lab_pk_kualitas;
        $data->save();

        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1500);
    }

    public function parameter_lab_pk_kualitas_index()
    {
        return Datatables::of(DB::table('parameter_lab_pk_kualitas')->orderBy('id_parameter_lab_pk_kualitas', 'DESC')->get())
            ->addColumn('min_parameter_lab_pk_tr_kualitas', function ($list) {
                $result = $list->min_parameter_lab_pk_tr_kualitas;
                return $result;
            })
            ->addColumn('max_parameter_lab_pk_tr_kualitas', function ($list) {
                $result = $list->max_parameter_lab_pk_tr_kualitas;
                return $result;
            })
            ->addColumn('min_parameter_lab_pk_butirpatah_kualitas', function ($list) {
                $result = $list->min_parameter_lab_pk_butirpatah_kualitas;
                return $result;
            })
            ->addColumn('max_parameter_lab_pk_butirpatah_kualitas', function ($list) {
                $result = $list->max_parameter_lab_pk_butirpatah_kualitas;
                return $result;
            })
            ->addColumn('kualitas_parameter_lab_pk', function ($list) {
                $result = $list->kualitas_parameter_lab_pk;
                return '<b>' . $result . '</b>';
            })
            ->addColumn('tanggal_parameter_lab_pk_kualitas', function ($list) {
                $result = $list->tanggal_parameter_lab_pk_kualitas;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_parameter_lab_pk_kualitas . '" data-toggle="modal" data-target="#modal_edit" title="Information" class="to_parameter btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                 <button id="btn_delete_kualitas" style="margin:2px;" data-id="' . $list->id_parameter_lab_pk_kualitas . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Hapus <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['min_parameter_lab_pk_tr_kualitas', 'max_parameter_lab_pk_tr_kualitas', 'min_parameter_lab_pk_butirpatah_kualitas', 'max_parameter_lab_pk_butirpatah_kualitas', 'kualitas_parameter_lab_pk', 'tanggal_parameter_lab_pk_kualitas', 'ckelola'])
            ->make(true);
    }

    public function parameter_lab_pk_kualitas_show($id)
    {
        $data = DB::table('parameter_lab_pk_kualitas')->where('id_parameter_lab_pk_kualitas', $id)->first();
        return json_encode($data);
    }

    public function parameter_lab_pk_kualitas_update(Request $request)
    {
        $data                                               = ParameterLabPkKualitas::where('id_parameter_lab_pk_kualitas', $request->id_parameter_lab_pk_kualitas_update)->first();
        $data->min_parameter_lab_pk_tr_kualitas             = $request->min_parameter_lab_pk_tr_kualitas_update;
        $data->max_parameter_lab_pk_tr_kualitas             = $request->max_parameter_lab_pk_tr_kualitas_update;
        $data->min_parameter_lab_pk_butirpatah_kualitas     = $request->min_parameter_lab_pk_butirpatah_kualitas_update;
        $data->max_parameter_lab_pk_butirpatah_kualitas     = $request->max_parameter_lab_pk_butirpatah_kualitas_update;
        $data->kualitas_parameter_lab_pk                   = $request->kualitas_parameter_lab_pk_update;
        $data->tanggal_parameter_lab_pk_kualitas            = $request->tanggal_parameter_lab_pk_kualitas_update;
        $data->update();
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1500);
    }

    public function parameter_lab_pk_kualitas_destroy($id)
    {
        $data = ParameterLabPkKualitas::where('id_parameter_lab_pk_kualitas', $id)->delete();
        // return redirect()->back();
    }


    // Harga Atas Gabah Basah
    public function harga_atas_gabah_basah()
    {
        $data = DB::table('bid')->join('harga_atas_gabah_basah', 'harga_atas_gabah_basah.waktu_harga_atas_gb', '=', 'bid.open_po')->orderBy('id_bid', 'desc')->first();
        return view('dashboard.admin_qc.harga_atas_gabah_basah', ['data' => $data]);
    }
    public function harga_atas_gabah_basah_index()
    {
        return Datatables::of(DB::table('harga_atas_gabah_basah')->orderBy('id_harga_atas_gb', 'desc')->get())
            ->addColumn('harga_atas', function ($list) {
                $result = $list->harga_atas_gb;
                return rupiah($result);
            })
            ->addColumn('waktu_harga_atas', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_harga_atas_gb)->isoFormat('DD-MM-Y ');
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_harga_atas_gb . '" data-toggle="modal" data-target="#modal1" title="Information" class="to_harga_atas btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                 <button style="margin:2px;" id="btn_delete" data-id="' . $list->id_harga_atas_gb . '"  data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Hapus <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['name_bid', 'open_po', 'harga_atas', 'waktu_harga_atas', 'ckelola'])
            ->make(true);
    }
    public function store_harga_atas_gabah_basah(Request $req)
    {
        $data = new HargaAtasGabahBasah();
        $data->harga_atas_gb     = $req->harga_atas;
        $data->waktu_harga_atas_gb = $req->waktu_harga_atas;
        $data->save();

        $log                               = new LogAktivityLab();
        $log->nama_user                    = Auth::guard('lab')->user()->name_qc;
        $log->id_objek_aktivitas_lab       = $data->id_harga_atas_gb;
        $log->aktivitas_lab                = 'Insert Harga Atas Tanggal PO: ' . $req->waktu_harga_atas . ' Harga: ' . $req->harga_atas;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();
        return response()->json($data);
    }
    public function show_harga_atas_gabah_basah($id)
    {
        $data = DB::table('harga_atas_gabah_basah')->where('id_harga_atas_gb', $id)->first();
        return json_encode($data);
    }
    public function update_harga_atas_gabah_basah(Request $req)
    {
        $data                   = HargaAtasGabahBasah::where('id_harga_atas_gb', $req->id_harga_atas_update)->first();
        $data->harga_atas_gb       = $req->harga_atas_update;
        $data->waktu_harga_atas_gb = $req->waktu_harga_atas_update;
        $data->update();

        $log                               = new LogAktivityLab();
        $log->nama_user                    = Auth::guard('lab')->user()->name_qc;
        $log->id_objek_aktivitas_lab       = $req->id_harga_atas_update;
        $log->aktivitas_lab                = 'Update Harga Atas Tanggal PO:' . $req->waktu_harga_atas_update;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();
        return response()->json($data);
    }
    public function destroy_harga_atas_gabah_basah($id)
    {
        $get = HargaAtasGabahBasah::where('id_harga_atas_gb', $id)->first();
        $log                               = new LogAktivityLab();
        $log->nama_user                    = Auth::guard('lab')->user()->name_qc;
        $log->id_objek_aktivitas_lab       = $id;
        $log->aktivitas_lab                = 'Delete Harga Atas Tanggal PO:' . $get->waktu_harga_atas_gb;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();
        $data = HargaAtasGabahBasah::where('id_harga_atas_gb', $id)->delete();

        // return redirect()->back();
    }

    // Harga Atas Gabah Kering
    public function harga_atas_gabah_kering()
    {
        $data = DB::table('bid')->join('harga_atas_gabah_kering', 'harga_atas_gabah_kering.waktu_harga_atas_gk', '=', 'bid.open_po')->orderBy('id_bid', 'desc')->first();
        return view('dashboard.admin_qc.harga_atas_gabah_kering', ['data' => $data]);
    }
    public function harga_atas_gabah_kering_index()
    {
        return Datatables::of(DB::table('harga_atas_gabah_kering')->orderBy('id_harga_atas_gk', 'desc')->get())
            ->addColumn('harga_atas', function ($list) {
                $result = $list->harga_atas_gk;
                return rupiah($result);
            })
            ->addColumn('waktu_harga_atas', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_harga_atas_gk)->isoFormat('DD-MM-Y ');
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_harga_atas_gk . '" data-toggle="modal" data-target="#modal1" title="Information" class="to_harga_atas btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                 <button style="margin:2px;" id="btn_delete" data-id="' . $list->id_harga_atas_gk . '"  data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Hapus <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['name_bid', 'open_po', 'harga_atas', 'waktu_harga_atas', 'ckelola'])
            ->make(true);
    }
    public function store_harga_atas_gabah_kering(Request $req)
    {
        $data = new HargaAtasGabahKering();
        $data->harga_atas_gk     = $req->harga_atas;
        $data->waktu_harga_atas_gk = $req->waktu_harga_atas;
        $data->save();
        return redirect()->back();
    }
    public function show_harga_atas_gabah_kering($id)
    {
        $data = DB::table('harga_atas_gabah_kering')->where('id_harga_atas_gk', $id)->first();
        return json_encode($data);
    }
    public function update_harga_atas_gabah_kering(Request $req)
    {
        $data                   = HargaAtasGabahKering::where('id_harga_atas_gk', $req->id_harga_atas_update)->first();
        $data->harga_atas_gk       = $req->harga_atas_update;
        $data->waktu_harga_atas_gk = $req->waktu_harga_atas_update;
        $data->update();
        return redirect()->back();
    }
    public function destroy_harga_atas_gabah_kering($id)
    {
        $data = HargaAtasGabahKering::where('id_harga_atas_gk', $id)->delete();
        // return redirect()->back();
    }

    // Harga Atas Gabah PK
    public function harga_atas_pecah_kulit()
    {
        $data = DB::table('bid')->join('harga_atas_pecah_kulit', 'harga_atas_pecah_kulit.waktu_harga_atas_pk', '=', 'bid.open_po')->orderBy('id_bid', 'desc')->first();
        return view('dashboard.admin_qc.harga_atas_pecah_kulit', ['data' => $data]);
    }
    public function harga_atas_pecah_kulit_index()
    {
        return Datatables::of(DB::table('harga_atas_pecah_kulit')->orderBy('id_harga_atas_pk', 'desc')->get())
            ->addColumn('harga_atas', function ($list) {
                $result = $list->harga_atas_pk;
                return rupiah($result);
            })
            ->addColumn('waktu_harga_atas', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_harga_atas_pk)->isoFormat('DD-MM-Y ');
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_harga_atas_pk . '" data-toggle="modal" data-target="#modal1" title="Information" class="to_harga_atas btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                 <button style="margin:2px;" id="btn_delete" data-id="' . $list->id_harga_atas_pk . '"  data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Hapus <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['name_bid', 'open_po', 'harga_atas', 'waktu_harga_atas', 'ckelola'])
            ->make(true);
    }
    public function store_harga_atas_pecah_kulit(Request $req)
    {
        $data = new HargaAtasPecahKulit();
        $data->harga_atas_pk     = $req->harga_atas;
        $data->waktu_harga_atas_pk = $req->waktu_harga_atas;
        $data->save();
        return redirect()->back();
    }
    public function show_harga_atas_pecah_kulit($id)
    {
        $data = DB::table('harga_atas_pecah_kulit')->where('id_harga_atas_pk', $id)->first();
        return json_encode($data);
    }
    public function update_harga_atas_pecah_kulit(Request $req)
    {
        $data                   = HargaAtasPecahKulit::where('id_harga_atas_pk', $req->id_harga_atas_update)->first();
        $data->harga_atas_pk       = $req->harga_atas_update;
        $data->waktu_harga_atas_pk = $req->waktu_harga_atas_update;
        $data->update();
        return redirect()->back();
    }
    public function destroy_harga_atas_pecah_kulit($id)
    {
        $data = HargaAtasPecahKulit::where('id_harga_atas_pk', $id)->delete();
        // return redirect()->back();
    }

    // Harga Atas Beras DS
    public function harga_atas_beras_ds()
    {
        $data = DB::table('bid')->join('harga_atas_beras_ds', 'harga_atas_beras_ds.waktu_harga_atas_ds', '=', 'bid.open_po')->orderBy('id_bid', 'desc')->first();
        return view('dashboard.admin_qc.harga_atas_beras_ds', ['data' => $data]);
    }
    public function harga_atas_beras_ds_index()
    {
        return Datatables::of(DB::table('harga_atas_beras_ds')->orderBy('id_harga_atas_ds', 'desc')->get())
            ->addColumn('harga_atas', function ($list) {
                $result = $list->harga_atas_ds;
                return rupiah($result);
            })
            ->addColumn('waktu_harga_atas', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_harga_atas_ds)->isoFormat('DD-MM-Y ');
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_harga_atas_ds . '" data-toggle="modal" data-target="#modal1" title="Information" class="to_harga_atas btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                 <button style="margin:2px;" id="btn_delete" data-id="' . $list->id_harga_atas_ds . '"  data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Hapus <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['name_bid', 'open_po', 'harga_atas', 'waktu_harga_atas', 'ckelola'])
            ->make(true);
    }
    public function store_harga_atas_beras_ds(Request $req)
    {
        $data = new HargaAtasBerasDs();
        $data->harga_atas_ds     = $req->harga_atas;
        $data->waktu_harga_atas_ds = $req->waktu_harga_atas;
        $data->save();
        return response()->json($data);
    }
    public function show_harga_atas_beras_ds($id)
    {
        $data = DB::table('harga_atas_beras_ds')->where('id_harga_atas_ds', $id)->first();
        return json_encode($data);
    }
    public function update_harga_atas_beras_ds(Request $req)
    {
        $data                   = HargaAtasBerasDs::where('id_harga_atas_ds', $req->id_harga_atas_update)->first();
        $data->harga_atas_ds       = $req->harga_atas_update;
        $data->waktu_harga_atas_ds = $req->waktu_harga_atas_update;
        $data->update();
        return response()->json($data);
    }
    public function destroy_harga_atas_beras_ds($id)
    {
        $data = HargaAtasBerasDs::where('id_harga_atas_ds', $id)->delete();
        // return redirect()->back();
    }

    //Harga Bawah Gabah Basah
    public function harga_bawah_gabah_basah()
    {
        return view('dashboard.admin_qc.harga_bawah');
    }
    public function harga_bawah_gabah_basah_index()
    {
        $site_qc = QcAdmin::select('site_qc')->where('site_qc', Auth::user()->site_qc)->first();
        return Datatables::of(DB::table('harga_bawah_gabah_basah')->orderBy('id_harga_bawah_gb', 'desc')->get())
            ->addColumn('harga_bawah', function ($list) {
                $result = $list->harga_bawah_gb;
                return rupiah($result);
            })
            ->addColumn('waktu_harga_bawah', function ($list) {
                $result = $list->waktu_harga_bawah_gb;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_harga_bawah_gb . '" data-toggle="modal" data-target="#modal1" title="Information" class="to_harga_bawah btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                 <button id="btn_delete" style="margin:2px;" data-id="' . $list->id_harga_bawah_gb . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Delete <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['harga_bawah', 'waktu_harga_bawah', 'ckelola'])
            ->make(true);
    }
    public function store_harga_bawah_gabah_basah(Request $req)
    {
        $data = new HargaBawah();
        $data->harga_bawah_gb     = $req->harga_bawah;
        $data->waktu_harga_bawah_gb = $req->waktu_harga_bawah;
        $data->save();

        $log                               = new LogAktivityLab();
        $log->nama_user                    = Auth::guard('lab')->user()->name_qc;
        $log->id_objek_aktivitas_lab       = $data->id_harga_bawah_gb;
        $log->aktivitas_lab                = 'Insert Harga Bawah Tanggal PO:' . $req->waktu_harga_bawah . ' Harga: ' . $req->harga_bawah;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();
        return response()->json($data);
    }
    public function show_harga_bawah_gabah_basah($id)
    {
        $data = DB::table('harga_bawah_gabah_basah')->where('id_harga_bawah_gb', $id)->first();
        return json_encode($data);
    }
    public function update_harga_bawah_gabah_basah(Request $req)
    {
        $data = HargaBawah::where('id_harga_bawah_gb', $req->id_harga_bawah_update)->first();
        $data->harga_bawah_gb       = $req->harga_bawah_update;
        $data->waktu_harga_bawah_gb = $req->waktu_harga_bawah_update;
        $data->update();

        $log                               = new LogAktivityLab();
        $log->nama_user                    = Auth::guard('lab')->user()->name_qc;
        $log->id_objek_aktivitas_lab       = $req->id_harga_bawah_update;
        $log->aktivitas_lab                = 'Update Harga Bawah Tanggal PO: ' . $req->waktu_harga_bawah_update;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();
        return response()->json($data);
    }
    public function destroy_harga_bawah_gabah_basah($id)
    {
        $get = DB::table('harga_bawah_gabah_basah')->where('id_harga_bawah_gb', $id)->first();

        $log                               = new LogAktivityLab();
        $log->nama_user                    = Auth::guard('lab')->user()->name_qc;
        $log->id_objek_aktivitas_lab       = $id;
        $log->aktivitas_lab                = 'Delete Harga Bawah Tanggal PO:' . $get->waktu_harga_bawah_gb;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();
        $data = DB::table('harga_bawah_gabah_basah')->where('id_harga_bawah_gb', $id)->delete();
        // return redirect()->back();
    }

    //Potongan Bongkar Gabah Basah
    public function potongan_gabah_basah()
    {
        return view('dashboard.admin_qc.potongan_gabah_basah');
    }
    public function potongan_gabah_basah_index()
    {
        return Datatables::of(DB::table('potongan_bongkar_gt_04_gabah_basah')->orderBy('id_potongan_bongkar_gt_04_gb', 'desc')->get())
            ->addColumn('potongan_bongkar_gt_04', function ($list) {
                $result = $list->potongan_bongkar_gt_04_gb;
                return rupiah($result);
            })
            ->addColumn('transparasi', function ($list) {
                $result = $list->transparasi_gb;
                return $result;
            })
            ->addColumn('waktu_potongan_bongkar_gt_04', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_potongan_bongkar_gt_04_gb)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_potongan_bongkar_gt_04_gb . '" data-toggle="modal" data-target="#modal1" title="Information" class="to_potongan_bongkar_gt_04 btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                 <button id="btn_delete" style="margin:2px;" data-id="' . $list->id_potongan_bongkar_gt_04_gb . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Hapus <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['potongan_bongkar_gt_04', 'transparasi', 'waktu_potongan_bongkar_gt_04', 'ckelola'])
            ->make(true);
    }
    public function store_potongan_gabah_basah(Request $req)
    {
        $data = new PotonganBongkarGb();
        $data->potongan_bongkar_gt_04_gb     = $req->potongan_bongkar_gt_04;
        $data->waktu_potongan_bongkar_gt_04_gb = $req->waktu_potongan_bongkar_gt_04;
        $data->transparasi_gb = $req->transparasi;
        $data->save();
        return redirect()->back();
    }
    public function show_potongan_gabah_basah($id)
    {
        $data = DB::table('potongan_bongkar_gt_04_gabah_basah')->where('id_potongan_bongkar_gt_04_gb', $id)->first();
        return json_encode($data);
    }
    public function update_potongan_gabah_basah(Request $req)
    {
        $data                               = PotonganBongkarGb::where('id_potongan_bongkar_gt_04_gb', $req->id_potongan_bongkar_gt_04_update)->first();
        $data->potongan_bongkar_gt_04_gb       = $req->potongan_bongkar_gt_04_update;
        $data->transparasi_gb                  = $req->transparasi;
        $data->waktu_potongan_bongkar_gt_04_gb = $req->waktu_potongan_bongkar_gt_04_update;
        $data->update();
        return redirect()->back();
    }
    public function destroy_potongan_gabah_basah($id)
    {
        $data = PotonganBongkarGb::where('id_potongan_bongkar_gt_04_gb', $id)->delete();
        // return redirect()->back();
    }
    // Potongan Bongkar Gabah Kering
    public function potongan_gabah_kering()
    {
        return view('dashboard.admin_qc.potongan_gabah_kering');
    }
    public function potongan_gabah_kering_index()
    {
        return Datatables::of(DB::table('potongan_bongkar_gt_04_gabah_kering')->orderBy('id_potongan_bongkar_gt_04_gk', 'desc')->get())
            ->addColumn('potongan_bongkar_gt_04', function ($list) {
                $result = $list->potongan_bongkar_gt_04_gk;
                return rupiah($result);
            })
            ->addColumn('transparasi', function ($list) {
                $result = $list->transparasi_gk;
                return $result;
            })
            ->addColumn('waktu_potongan_bongkar_gt_04', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_potongan_bongkar_gt_04_gk)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_potongan_bongkar_gt_04_gk . '" data-toggle="modal" data-target="#modal1" title="Information" class="to_potongan_bongkar_gt_04 btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                 <button id="btn_delete" style="margin:2px;" data-id="' . $list->id_potongan_bongkar_gt_04_gk . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Hapus <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['potongan_bongkar_gt_04', 'transparasi', 'waktu_potongan_bongkar_gt_04', 'ckelola'])
            ->make(true);
    }
    public function store_potongan_gabah_kering(Request $req)
    {
        $data = new PotonganBongkarGk();
        $data->potongan_bongkar_gt_04_gk     = $req->potongan_bongkar_gt_04;
        $data->waktu_potongan_bongkar_gt_04_gk = $req->waktu_potongan_bongkar_gt_04;
        $data->transparasi_gk = $req->transparasi;
        $data->save();
        return redirect()->back();
    }
    public function show_potongan_gabah_kering($id)
    {
        $data = DB::table('potongan_bongkar_gt_04_gabah_kering')->where('id_potongan_bongkar_gt_04_gk', $id)->first();
        return json_encode($data);
    }
    public function update_potongan_gabah_kering(Request $req)
    {
        $data                               = PotonganBongkarGk::where('id_potongan_bongkar_gt_04_gk', $req->id_potongan_bongkar_gt_04_update)->first();
        $data->potongan_bongkar_gt_04_gk       = $req->potongan_bongkar_gt_04_update;
        $data->transparasi_gk                  = $req->transparasi;
        $data->waktu_potongan_bongkar_gt_04_gk = $req->waktu_potongan_bongkar_gt_04_update;
        $data->update();
        return redirect()->back();
    }
    public function destroy_potongan_gabah_kering($id)
    {
        $data = PotonganBongkarGk::where('id_potongan_bongkar_gt_04_gk', $id)->delete();
        // return redirect()->back();
    }
    // Potongan Bongkar Beras PK
    public function potongan_pecah_kulit()
    {
        return view('dashboard.admin_qc.potongan_pecah_kulit');
    }
    public function potongan_pecah_kulit_index()
    {
        return Datatables::of(DB::table('potongan_bongkar_gt_04_pecah_kulit')->orderBy('id_potongan_bongkar_gt_04_pk', 'desc')->get())
            ->addColumn('potongan_bongkar_gt_04', function ($list) {
                $result = $list->potongan_bongkar_gt_04_pk;
                return rupiah($result);
            })
            ->addColumn('transparasi', function ($list) {
                $result = $list->transparasi_pk;
                return $result;
            })
            ->addColumn('waktu_potongan_bongkar_gt_04', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_potongan_bongkar_gt_04_pk)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_potongan_bongkar_gt_04_pk . '" data-toggle="modal" data-target="#modal1" title="Information" class="to_potongan_bongkar_gt_04 btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                 <button id="btn_delete" style="margin:2px;" data-id="' . $list->id_potongan_bongkar_gt_04_pk . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Hapus <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['potongan_bongkar_gt_04', 'transparasi', 'waktu_potongan_bongkar_gt_04', 'ckelola'])
            ->make(true);
    }
    public function store_potongan_pecah_kulit(Request $req)
    {
        $data = new PotonganBongkarPk();
        $data->potongan_bongkar_gt_04_pk     = $req->potongan_bongkar_gt_04;
        $data->waktu_potongan_bongkar_gt_04_pk = $req->waktu_potongan_bongkar_gt_04;
        $data->transparasi_pk = $req->transparasi;
        $data->save();
        return redirect()->back();
    }
    public function show_potongan_pecah_kulit($id)
    {
        $data = DB::table('potongan_bongkar_gt_04_pecah_kulit')->where('id_potongan_bongkar_gt_04_pk', $id)->first();
        return json_encode($data);
    }
    public function update_potongan_pecah_kulit(Request $req)
    {
        $data                               = PotonganBongkarPk::where('id_potongan_bongkar_gt_04_pk', $req->id_potongan_bongkar_gt_04_update)->first();
        $data->potongan_bongkar_gt_04_pk       = $req->potongan_bongkar_gt_04_update;
        $data->transparasi_pk                  = $req->transparasi;
        $data->waktu_potongan_bongkar_gt_04_pk = $req->waktu_potongan_bongkar_gt_04_update;
        $data->update();
        return redirect()->back();
    }
    public function destroy_potongan_pecah_kulit($id)
    {
        $data = PotonganBongkarPk::where('id_potongan_bongkar_gt_04_pk', $id)->delete();
        // return redirect()->back();
    }
    // Potongan Bongkar Beras DS
    public function potongan_beras_ds()
    {
        return view('dashboard.admin_qc.potongan_beras_ds');
    }
    public function potongan_beras_ds_index()
    {
        return Datatables::of(DB::table('potongan_bongkar_gt_04_beras_ds')->orderBy('id_potongan_bongkar_gt_04_ds', 'desc')->get())
            ->addColumn('potongan_bongkar_gt_04', function ($list) {
                $result = $list->potongan_bongkar_gt_04_ds;
                return rupiah($result);
            })
            ->addColumn('transparasi', function ($list) {
                $result = $list->transparasi_ds;
                return $result;
            })
            ->addColumn('waktu_potongan_bongkar_gt_04', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_potongan_bongkar_gt_04_ds)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_potongan_bongkar_gt_04_ds . '" data-toggle="modal" data-target="#modal1" title="Information" class="to_potongan_bongkar_gt_04 btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                 <button id="btn_delete" style="margin:2px;" data-id="' . $list->id_potongan_bongkar_gt_04_ds . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                Hapus <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['potongan_bongkar_gt_04', 'transparasi', 'waktu_potongan_bongkar_gt_04', 'ckelola'])
            ->make(true);
    }
    public function store_potongan_beras_ds(Request $req)
    {
        $data = new PotonganBongkarDs();
        $data->potongan_bongkar_gt_04_ds     = $req->potongan_bongkar_gt_04;
        $data->waktu_potongan_bongkar_gt_04_ds = $req->waktu_potongan_bongkar_gt_04;
        $data->transparasi_ds = $req->transparasi;
        $data->save();
        return redirect()->back();
    }
    public function show_potongan_beras_ds($id)
    {
        $data = DB::table('potongan_bongkar_gt_04_beras_ds')->where('id_potongan_bongkar_gt_04_ds', $id)->first();
        return json_encode($data);
    }
    public function update_potongan_beras_ds(Request $req)
    {
        $data                               = PotonganBongkarDs::where('id_potongan_bongkar_gt_04_ds', $req->id_potongan_bongkar_gt_04_update)->first();
        $data->potongan_bongkar_gt_04_ds       = $req->potongan_bongkar_gt_04_update;
        $data->transparasi_ds                  = $req->transparasi;
        $data->waktu_potongan_bongkar_gt_04_ds = $req->waktu_potongan_bongkar_gt_04_update;
        $data->update();
        return redirect()->back();
    }
    public function destroy_potongan_beras_ds($id)
    {
        $data = PotonganBongkarDs::where('id_potongan_bongkar_gt_04_ds', $id)->delete();
        // return redirect()->back();
    }


    public function get_notifikasi()
    {
        $data = NotifLab::where('status', 0)->get();
        return json_encode($data);
    }
    public function get_countnotifikasi()
    {
        $data = NotifLab::where('status', 0)->count();
        return json_encode($data);
    }
    public function getcountnotif_antrianbongkar()
    {
        $data1 = DataPO::join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
            ->where('lab1_gb.status_lab1_gb', '=', '7')
            ->count();
        $data2 = DataPO::join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('lab1_pk', 'lab1_pk.lab1_id_data_po_pk', '=', 'data_po.id_data_po')
            ->where('lab1_pk.status_lab1_pk', '=', '7')
            ->count();
        $total_data = ($data1 + $data2);
        return json_encode($total_data);
    }

    public function getcountnotif_prosesbongkar()
    {
        $data1 = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab1_gb', 'lab1_gb.lab1_kode_po_gb', '=', 'data_po.kode_po')
            ->where('lab1_gb.status_lab1_gb', '=', '9')
            ->count();
        $data2 = DataPO::join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab1_pk', 'lab1_pk.lab1_id_data_po_pk', '=', 'data_po.kode_po')
            ->where('lab1_pk.status_lab1_pk', '=', '9')
            ->count();
        $total_data = ($data1 + $data2);
        return json_encode($total_data);
    }
    public function getcountnotif_databongkar()
    {
        $data = DataQcBongkar::join('data_po', 'data_po.kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
            ->join('bid', 'data_po.bid_id', '=', 'bid.id_bid')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('bid.name_bid', 'LIKE', '%GABAH BASAH%')
            ->count();
        return json_encode($data);
    }
    public function getcountnotif_data_sourching_deal()
    {
        $data = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('lab2_gb.aksi_harga_gb', 'DEAL')
            ->where('bid.name_bid', 'LIKE', '%GABAH BASAH%')
            ->orderBy('id_lab2_gb', 'DESC')
            ->count();
        return json_encode($data);
    }
    public function getcountnotif_revisibongkar()
    {
        $data = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->where('penerimaan_po.id_adminanalisa', '3')
            ->where('penerimaan_po.status_analisa', '2')
            ->where('penerimaan_po.status_revisi', '0')
            ->where('penerimaan_po.analisa', 'revisi')
            ->count();
        return json_encode($data);
    }

    public function get_price_gt4($id)
    {
        // $data = PotonganBongkarGt04::orderBy('id_potongan_bongkar_gt_04', 'desc')->first();
        $data = PenerimaanPO::join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('potongan_bongkar_gt_04', 'potongan_bongkar_gt_04.waktu_potongan_bongkar_gt_04', '=', 'data_po.tanggal_po')->where('penerimaan_po.id_penerimaan_po', $id)->first();
        // return ($data);
        return json_encode($data);
    }

    public function get_price_top_gabah_basah($id)
    {
        //$data = HargaAtas::where('id_harga_atas', 'desc')->first();
        $data = PenerimaanPO::join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')
            ->join('harga_atas_gabah_basah', 'harga_atas_gabah_basah.waktu_harga_atas_gb', '=', 'data_po.tanggal_po')
            ->where('id_penerimaan_po', $id)
            ->first();
        return json_encode($data);
    }
    public function get_buttom_price_gabah_basah($id)
    {
        $data = PenerimaanPO::join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')
            ->join('harga_bawah_gabah_basah', 'harga_bawah_gabah_basah.waktu_harga_bawah_gb', '=', 'data_po.tanggal_po')
            ->where('id_penerimaan_po', $id)
            ->first();
        return json_encode($data);
    }
    public function get_price_top_gabah_kering($id)
    {
        //$data = HargaAtas::where('id_harga_atas', 'desc')->first();
        $data = PenerimaanPO::join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('harga_atas_gabah_kering', 'harga_atas_gabah_kering.waktu_harga_atas_gk', '=', 'data_po.tanggal_po')->where('id_penerimaan_po', $id)->first();
        return json_encode($data);
    }
    public function get_price_top_pecah_kulit($id)
    {
        //$data = HargaAtas::where('id_harga_atas', 'desc')->first();
        $data = PenerimaanPO::join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('harga_atas_pecah_kulit', 'harga_atas_pecah_kulit.waktu_harga_atas_pk', '=', 'data_po.tanggal_po')->where('id_penerimaan_po', $id)->first();
        return json_encode($data);
    }
    public function get_price_top_beras_ds($id)
    {
        //$data = HargaAtas::where('id_harga_atas', 'desc')->first();
        $data = PenerimaanPO::join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('harga_atas_beras_ds', 'harga_atas_beras_ds.waktu_harga_atas_ds', '=', 'data_po.tanggal_po')->where('id_penerimaan_po', $id)->first();
        return json_encode($data);
    }

    public function download_output_lab1_excel(Request $request)
    {
        $from_date  = $request->from_date;
        $to_date  = $request->to_date;
        return Excel::download(new DataOutputLab1Excel($from_date, $to_date), 'DATA OUTPUT LAB 1 PT. SURYA PANGAN SEMESTA.xlsx');
    }
    public function download_data_unload_excel(Request $request)
    {
        $from_date  = $request->from_date;
        $to_date  = $request->to_date;
        return Excel::download(new DataBongkarLab1ExportExcel($from_date, $to_date), 'DATA OUTPUT UNLOAD LAB 1 PT. SURYA PANGAN SEMESTA.xlsx');
    }

    public function download_data_pending_excel(Request $request)
    {
        $from_date  = $request->from_date;
        $to_date  = $request->to_date;
        return Excel::download(new DataPendingLab1ExportExcel($from_date, $to_date), 'DATA OUTPUT PENDING LAB 1 PT. SURYA PANGAN SEMESTA.xlsx');
    }

    public function download_data_reject_excel(Request $request)
    {
        $from_date  = $request->from_date;
        $to_date  = $request->to_date;
        return Excel::download(new DataRejectLab1ExportExcel($from_date, $to_date), 'DATA OUTPUT REJECT LAB 1 PT. SURYA PANGAN SEMESTA.xlsx');
    }

    public function download_output_lab2_excel(Request $request)
    {

        $from_date  = $request->from_date;
        $to_date  = $request->to_date;
        return Excel::download(new OutputDataLab2ExportExcel($from_date, $to_date), 'DATA OUTPUT LAB 2 PT. SURYA PANGAN SEMESTA NGAWI.xlsx');
    }
    public function download_output_lab2_pk_excel(Request $request)
    {

        $from_date  = $request->from_date;
        $to_date  = $request->to_date;
        return Excel::download(new OutputDataLab2ExportExcelPK($from_date, $to_date), 'DATA OUTPUT LAB 2 PT. SURYA PANGAN SEMESTA NGAWI.xlsx');
    }

    public function download_onproses_lab2_excel(Request $request)
    {
        $from_date  = $request->from_date;
        $to_date  = $request->to_date;
        return Excel::download(new DataOnProsesLab2ExportExcel($from_date, $to_date), 'DATA OUTPUT ON PROSES LAB 2 PT. SURYA PANGAN SEMESTA NGAWI.xlsx');
    }

    public function download_deal_lab2_excel(Request $request)
    {
        $from_date  = $request->from_date;
        $to_date  = $request->to_date;
        return Excel::download(new DataDealLab2ExportExcel($from_date, $to_date), 'DATA OUTPUT DEAL LAB 2 PT. SURYA PANGAN SEMESTA NGAWI.xlsx');
    }
    public function download_nego_lab2_excel(Request $request)
    {
        $from_date  = $request->from_date;
        $to_date  = $request->to_date;
        return Excel::download(new DataNegoLab2ExportExcel($from_date, $to_date), 'DATA OUTPUT NEGO LAB 2 PT. SURYA PANGAN SEMESTA NGAWI.xlsx');
    }


    // DATA PO MANAGER
    public function bid_gb_index(Request $request)
    {
        return Datatables::of(DB::table('bid')
            ->where('name_bid', 'LIKE', '%GABAH BASAH%')
            ->orderBy("id_bid", 'desc')
            ->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('open_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('start_pengajuan', function ($list) {
                $result = \Carbon\Carbon::parse($list->date_bid)->isoFormat('DD-MM-Y hh:mm:ss');
                return $result;
            })
            ->addColumn('close_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->batas_bid)->isoFormat('DD-MM-Y HH:mm:ss');
                return $result;
            })
            ->addColumn('kuota', function ($list) {
                $result = $list->jumlah;
                $jumlahtruk = $result / 8000;
                return tonase($result) . '<br>(' . $jumlahtruk . ' Truk)';
            })
            ->addColumn('total_kuota', function ($list) {
                $jumlah = $list->jumlah;
                $kuota = $list->add_kuota;
                $total = $jumlah + $kuota;
                $jumlahtruk = $total / 8000;
                return tonase($total) . '<br>(' . $jumlahtruk . ' Truk)';
            })
            ->addColumn('kuota_tambahan', function ($list) {
                $result = $list->add_kuota;
                $date = $list->batas_bid;
                $jumlahtruk = $result / 8000;
                if ($date >= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {

                    if ($result == '' || $result == null) {
                        return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                    </button>';
                    } else {
                        return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-pen-alt"></i>' . $result . '&nbsp;Kg<br>(' . $jumlahtruk . '&nbsp;Truk)
                                    </button><a href="javascript:void(0)" data-id="' . $list->id_bid . '" id="btn_delete_kuota" title="Hapus Kuota"><i class="fa fa-times text-danger"></i></a>';
                    }
                } else if ($date <= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                    if ($result == '' || $result == null) {
                        return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                </button>';
                    } else {
                        return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-pen-alt"></i>' . $result . '&nbsp;Kg<br>(' . $jumlahtruk . '&nbsp;Truk)
                                    </button>';
                    }
                }
            })
            ->addColumn('list_po', function ($list) {
                $data_count = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->where('data_po.bid_id', $list->id_bid)
                    ->count();
                return '
                        <div style="position:relative;">
                        <a style="margin:2px;" href="' . route('qc.lab.data_list_po', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" style="position: relative;" class="toyakin btn btn-outline-dark m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <div style="position:absolute;">
                        <span class="badge " style="left:80px; margin-top:-20px; float:right; background: #9f187c; color: white;">' . $data_count . '</span>
                        </div>
                        <i class="fa fa-list">&nbsp;Daftar&nbsp;PO</i>
                        </a>
                        </div>
                        ';
            })
            ->addColumn('batas_bid', function ($list) {
                $result = $list->batas_bid;
                if ($result >= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                    if ($list->bid_status == 1) {
                        return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-check-circle">Active</i>
                            </button>';
                    } else {
                        return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times-circle">Off</i>
                            </button>';
                    }
                } else if ($result <= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                    if ($list->bid_status == 1) {
                        return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-check-circle">Active </i>
                                </button>';
                    } else {
                        return '<button id="btn_status1"  style="margin:2px;" data-offset="5px 5px" data-toggle="m-tooltip" title="information" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times-circle">Off</i>
                                </button>';
                    }
                }
            })
            ->addColumn('image_bid', function ($list) {
                $img = url('public/img/bid/' . $list->image_bid);
                if (is_null($list->image_bid)) {
                } else
                    return '
                                <img src="' . $img . '" width="100px"/>
                            ';
            })
            ->addColumn('description_bid', function ($list) {
                $result = $list->description_bid;
                return $result;
            })
            ->addColumn('response', function ($list) {
                return '<a style="margin:2px;" href="' . route('sourching.bid_response', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-eye">&nbsp;List&nbsp;Pengajuan</i>
                            </a>';
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->bid_status == 1) {
                    return '
                            <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->date_bid)->format('Y-m-d') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                            </a>
                            <a style="margin:2px;" id="btn_information"  title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times" style="color:#DC143C;"></i>
                            </a>
                            ';
                } else {
                    return '
                            <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->date_bid)->format('Y-m-d') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                            </a>
                            <a style="margin:2px;" name="btn_delete" id="btn_delete" data-bidid="' . $list->id_bid . '"  title="Hapus Data" class="btn_delete btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times" style="color:#DC143C;"></i>
                            </a>
                            ';
                }
            })
            ->rawColumns(['name_bid', 'total_kuota', 'open_po', 'close_po', 'start_pengajuan', 'kuota', 'kuota_tambahan', 'list_po', 'batas_bid', 'image_bid', 'response', 'ckelola'])
            ->make(true);
    }
    public function bid_pk_index(Request $request)
    {
        return Datatables::of(DB::table('bid')
            ->where('name_bid', 'LIKE', '%BERAS PECAH KULIT%')
            ->orderBy("id_bid", 'desc')
            ->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('open_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('start_pengajuan', function ($list) {
                $result = \Carbon\Carbon::parse($list->date_bid)->isoFormat('DD-MM-Y hh:mm:ss');
                return $result;
            })
            ->addColumn('close_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->batas_bid)->isoFormat('DD-MM-Y HH:mm:ss');
                return $result;
            })
            ->addColumn('kuota', function ($list) {
                $result = $list->jumlah;
                $jumlahtruk = $result / 8000;
                return tonase($result) . '<br>(' . $jumlahtruk . ' Truk)';
            })
            ->addColumn('total_kuota', function ($list) {
                $jumlah = $list->jumlah;
                $kuota = $list->add_kuota;
                $total = $jumlah + $kuota;
                $jumlahtruk = $total / 8000;
                return tonase($total) . '<br>(' . $jumlahtruk . ' Truk)';
            })
            ->addColumn('kuota_tambahan', function ($list) {
                $result = $list->add_kuota;
                $date = $list->batas_bid;
                $jumlahtruk = $result / 8000;
                if ($date >= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {

                    if ($result == '' || $result == null) {
                        return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                    </button>';
                    } else {
                        return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-pen-alt"></i>' . $result . '&nbsp;Kg<br>(' . $jumlahtruk . '&nbsp;Truk)
                                    </button><a href="javascript:void(0)" data-id="' . $list->id_bid . '" id="btn_delete_kuota" title="Hapus Kuota"><i class="fa fa-times text-danger"></i></a>';
                    }
                } else if ($date <= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                    if ($result == '' || $result == null) {
                        return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                </button>';
                    } else {
                        return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-pen-alt"></i>' . $result . '&nbsp;Kg<br>(' . $jumlahtruk . '&nbsp;Truk)
                                    </button>';
                    }
                }
            })
            ->addColumn('list_po', function ($list) {
                return '<a style="margin:2px;" href="' . route('qc.lab.data_list_po', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-dark m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-list">&nbsp;Daftar&nbsp;PO</i>
                        </a>';
            })
            ->addColumn('batas_bid', function ($list) {
                $result = $list->batas_bid;
                if ($result >= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                    if ($list->bid_status == 1) {
                        return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-check-circle">Active</i>
                            </button>';
                    } else {
                        return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times-circle">Off</i>
                            </button>';
                    }
                } else if ($result <= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                    if ($list->bid_status == 1) {
                        return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-check-circle">Active </i>
                                </button>';
                    } else {
                        return '<button id="btn_status1"  style="margin:2px;" data-offset="5px 5px" data-toggle="m-tooltip" title="information" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times-circle">Off</i>
                                </button>';
                    }
                }
            })
            ->addColumn('image_bid', function ($list) {
                $img = url('public/img/bid/' . $list->image_bid);
                if (is_null($list->image_bid)) {
                } else
                    return '
                                <img src="' . $img . '" width="100px"/>
                            ';
            })
            ->addColumn('description_bid', function ($list) {
                $result = $list->description_bid;
                return $result;
            })
            ->addColumn('response', function ($list) {
                return '<a style="margin:2px;" href="' . route('sourching.bid_response', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-eye">&nbsp;List&nbsp;Pengajuan</i>
                            </a>';
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->bid_status == 1) {
                    return '
                            <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->date_bid)->format('Y-m-d') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                            </a>
                            <a style="margin:2px;" id="btn_information"  title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times" style="color:#DC143C;"></i>
                            </a>
                            ';
                } else {
                    return '
                            <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->date_bid)->format('Y-m-d') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                            </a>
                            <a style="margin:2px;" name="btn_delete" id="btn_delete" data-bidid="' . $list->id_bid . '"  title="Hapus Data" class="btn_delete btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times" style="color:#DC143C;"></i>
                            </a>
                            ';
                }
            })
            ->rawColumns(['name_bid', 'total_kuota', 'open_po', 'close_po', 'start_pengajuan', 'kuota', 'kuota_tambahan', 'list_po', 'batas_bid', 'image_bid', 'response', 'ckelola'])
            ->make(true);
    }
    public function bid_ds_index(Request $request)
    {
        return Datatables::of(DB::table('bid')
            ->where('name_bid', 'LIKE', '%BERAS DS%')
            ->orderBy("id_bid", 'desc')
            ->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('open_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('start_pengajuan', function ($list) {
                $result = \Carbon\Carbon::parse($list->date_bid)->isoFormat('DD-MM-Y hh:mm:ss');
                return $result;
            })
            ->addColumn('close_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->batas_bid)->isoFormat('DD-MM-Y HH:mm:ss');
                return $result;
            })
            ->addColumn('kuota', function ($list) {
                $result = $list->jumlah;
                $jumlahtruk = $result / 8000;
                return tonase($result) . '<br>(' . $jumlahtruk . ' Truk)';
            })
            ->addColumn('total_kuota', function ($list) {
                $jumlah = $list->jumlah;
                $kuota = $list->add_kuota;
                $total = $jumlah + $kuota;
                $jumlahtruk = $total / 8000;
                return tonase($total) . '<br>(' . $jumlahtruk . ' Truk)';
            })
            ->addColumn('kuota_tambahan', function ($list) {
                $result = $list->add_kuota;
                $date = $list->batas_bid;
                $jumlahtruk = $result / 8000;
                if ($date >= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {

                    if ($result == '' || $result == null) {
                        return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                    </button>';
                    } else {
                        return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-pen-alt"></i>' . $result . '&nbsp;Kg<br>(' . $jumlahtruk . '&nbsp;Truk)
                                    </button><a href="javascript:void(0)" data-id="' . $list->id_bid . '" id="btn_delete_kuota" title="Hapus Kuota"><i class="fa fa-times text-danger"></i></a>';
                    }
                } else if ($date <= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                    if ($result == '' || $result == null) {
                        return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                </button>';
                    } else {
                        return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-pen-alt"></i>' . $result . '&nbsp;Kg<br>(' . $jumlahtruk . '&nbsp;Truk)
                                    </button>';
                    }
                }
            })
            ->addColumn('list_po', function ($list) {
                return '<a style="margin:2px;" href="' . route('qc.lab.data_list_po', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-dark m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-list">&nbsp;Daftar&nbsp;PO</i>
                        </a>';
            })
            ->addColumn('batas_bid', function ($list) {
                $result = $list->batas_bid;
                if ($result >= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                    if ($list->bid_status == 1) {
                        return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-check-circle">Active</i>
                            </button>';
                    } else {
                        return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times-circle">Off</i>
                            </button>';
                    }
                } else if ($result <= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                    if ($list->bid_status == 1) {
                        return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-check-circle">Active </i>
                                </button>';
                    } else {
                        return '<button id="btn_status1"  style="margin:2px;" data-offset="5px 5px" data-toggle="m-tooltip" title="information" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times-circle">Off</i>
                                </button>';
                    }
                }
            })
            ->addColumn('image_bid', function ($list) {
                $img = url('public/img/bid/' . $list->image_bid);
                if (is_null($list->image_bid)) {
                } else
                    return '
                                <img src="' . $img . '" width="100px"/>
                            ';
            })
            ->addColumn('description_bid', function ($list) {
                $result = $list->description_bid;
                return $result;
            })
            ->addColumn('response', function ($list) {
                return '<a style="margin:2px;" href="' . route('sourching.bid_response', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-eye">&nbsp;List&nbsp;Pengajuan</i>
                            </a>';
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->bid_status == 1) {
                    return '
                            <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->date_bid)->format('Y-m-d') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                            </a>
                            <a style="margin:2px;" id="btn_information"  title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times" style="color:#DC143C;"></i>
                            </a>
                            ';
                } else {
                    return '
                            <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->date_bid)->format('Y-m-d') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                            </a>
                            <a style="margin:2px;" name="btn_delete" id="btn_delete" data-bidid="' . $list->id_bid . '"  title="Hapus Data" class="btn_delete btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times" style="color:#DC143C;"></i>
                            </a>
                            ';
                }
            })
            ->rawColumns(['name_bid', 'total_kuota', 'open_po', 'close_po', 'start_pengajuan', 'kuota', 'kuota_tambahan', 'list_po', 'batas_bid', 'image_bid', 'response', 'ckelola'])
            ->make(true);
    }
    public function data_list_po($id_bid)
    {
        return view('dashboard.admin_qc.data_list_po', compact('id_bid'));
    }
    public function data_po()
    {
        // dd($data);
        return view('dashboard.admin_qc.data_po');
    }
    public function data_po_deal()
    {
        // dd($data);
        return view('dashboard.admin_qc.data_po_deal');
    }
    public function data_list_index($id_bid)
    {
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.bid_id', $id_bid)
            ->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('status', function ($list) {
                if ($list->status_bid == 5) {
                    return '<span style="margin:2px;" class="badge badge-danger">Tolak</span>';
                } else if ($list->status_bid == 16) {
                    return '<button type="button" id="btn_lihat_harga" data-id="' . $list->id_data_po . '" data-hp="' . $list->nomer_hp  . '" data-nopol="' . $list->nopol  . '" data-supplier="' . $list->nama_vendor  . '" class="btn btn-light"><span style="margin:2px;" title="Lihat Harga" class="badge badge-warning">Pending Harga</span></button>';
                } else if ($list->status_bid == 1) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Proses&nbsp;Pengiriman</span>';
                } else if ($list->status_bid == 3) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Proses&nbsp;Lab&nbsp;1</span>';
                } else if ($list->status_bid == 6) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Selesai&nbsp;Lab1</span>';
                } else if ($list->status_bid == 7) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Truk&nbsp;Parkir</span>';
                } else if ($list->status_bid == 8) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Timbangan&nbsp;Masuk</span>';
                } else if ($list->status_bid == 9) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Proses&nbsp;Bongkar</span>';
                } else if ($list->status_bid == 10) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Timbangan&nbsp;Keluar/Lab&nbsp;2</span>';
                } else if ($list->status_bid == 13) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Pembayaran</span>';
                } else {
                    return  '<span style="margin:2px;" class="badge badge-success">Bongkar</span>';
                }
            })
            ->addColumn('cetak', function ($list) {
                if ($list->status_bid == 5) {
                    return '<a href="cetak_po/' . $list->id_data_po . '" onclick="return false;" target="_blank" style="margin:2px;background-color:#9c0911" name="" title="Cetak PO" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-print" style="color:white;">&nbsp;Cetak&nbsp;PO</i>
                        </a>';
                } else {
                    return '<a href="cetak_po/' . $list->id_data_po . '" target="_blank" style="margin:2px;background-color:#9c0911" name="" title="Cetak PO" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-print" style="color:white;">&nbsp;Cetak&nbsp;PO</i>
                        </a>';
                }
            })

            ->rawColumns(['name_bid', 'tanggal_po', 'cetak', 'status'])
            ->make(true);
    }
    public function data_sourching_deal_gb_longgrain_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->orderBy('id_lab2_gb', 'DESC')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = tonase($list->tonase_awal);
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = tonase($list->tonase_akhir);
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb) . '/Kg';
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                        }
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return
                            '<button class="btn btn-success btn-sm readonly">DEAL</button>';
                    })
                    ->addColumn('kirim_harga', function ($list) {
                        $str_hp = $list->nomer_hp;
                        $no_hp = preg_replace('/^0/', '62', $str_hp);
                        $nama = $list->name;
                        $nopol = $list->nopol;
                        $tonase = tonase($list->hasil_akhir_tonase);
                        $kode_po = $list->kode_po;
                        $harga = rupiah($list->harga_akhir_gb) . '/Kg';
                        return
                            // $no_hp;
                            '<a href="https://api.whatsapp.com/send?phone=' . $no_hp . '&text=Hallo!!%20Supplier%20:%20' . $nama . '.%20Ingin%20menyampaikan%20harga%20bongkaran%20gabah%20Nopol:%20' . $nopol . '%20Tonase:%20' . $tonase . '%20dengan%20PO:%20' . $kode_po . '%20Yaitu%20:%20*' . $harga . '*.%20Terimakasih." target="_blank" class="btn btn-block btn-success" id="btn_kirim_harga"><i class="fi fi-brands-whatsapp"></i>Kirim&nbsp;Harga&nbsp;Supplier</a>';
                    })
                    ->addColumn('surveyor', function ($list) {
                        $result = $list->surveyor_gb;
                        return $result;
                    })
                    ->addColumn('keterangan', function ($list) {
                        $result = $list->keterangan_gb;
                        return $result;
                    })
                    ->addColumn('waktu', function ($list) {
                        $result = $list->waktu_gb;
                        return $result;
                    })
                    ->addColumn('tempat', function ($list) {
                        $result = $list->tempat_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_dibawa', function ($list) {
                        $result = $list->z_yang_dibawa_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_ditolak', function ($list) {
                        $result = $list->z_yang_ditolak_gb;
                        return $result;
                    })
                    ->rawColumns(['name_bid', 'kirim_harga', 'reaksi_harga', 'nama_vendor', "date", 'date_bid', 'kode_po', 'harga_akhir', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
                    // ->whereBetween('lab2_gb.created_at', array($request->from_date, $request->to_date))
                    ->orderBy('id_lab2_gb', 'DESC')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = tonase($list->tonase_awal);
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = tonase($list->tonase_akhir);
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb) . '/Kg';
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                        }
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return
                            '<button class="btn btn-success btn-sm readonly">DEAL</button>';
                    })
                    ->addColumn('kirim_harga', function ($list) {
                        $str_hp = $list->nomer_hp;
                        $no_hp = preg_replace('/^0/', '62', $str_hp);
                        $nama = $list->name;
                        $nopol = $list->nopol;
                        $tonase = tonase($list->hasil_akhir_tonase);
                        $kode_po = $list->kode_po;
                        $harga = rupiah($list->harga_akhir_gb) . '/Kg';
                        return
                            // $no_hp;
                            '<a href="https://api.whatsapp.com/send?phone=' . $no_hp . '&text=Hallo!!%20Supplier%20:%20' . $nama . '.%20Ingin%20menyampaikan%20harga%20bongkaran%20gabah%20Nopol:%20' . $nopol . '%20Tonase:%20' . $tonase . '%20dengan%20PO:%20' . $kode_po . '%20Yaitu%20:%20*' . $harga . '*.%20Terimakasih." target="_blank" class="btn btn-block btn-success" id="btn_kirim_harga"><i class="fi fi-brands-whatsapp"></i>Kirim&nbsp;Harga&nbsp;Supplier</a>';
                    })
                    ->addColumn('surveyor', function ($list) {
                        $result = $list->surveyor_gb;
                        return $result;
                    })
                    ->addColumn('keterangan', function ($list) {
                        $result = $list->keterangan_gb;
                        return $result;
                    })
                    ->addColumn('waktu', function ($list) {
                        $result = $list->waktu_gb;
                        return $result;
                    })
                    ->addColumn('tempat', function ($list) {
                        $result = $list->tempat_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_dibawa', function ($list) {
                        $result = $list->z_yang_dibawa_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_ditolak', function ($list) {
                        $result = $list->z_yang_ditolak_gb;
                        return $result;
                    })
                    ->rawColumns(['name_bid', 'kirim_harga', 'reaksi_harga', 'nama_vendor', "date", 'date_bid', 'kode_po', 'harga_akhir', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_deal_gb_pandan_wangi_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->orderBy('id_lab2_gb', 'DESC')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = tonase($list->tonase_awal);
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = tonase($list->tonase_akhir);
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb) . '/Kg';
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                        }
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        if ($list->status_epicor == 1) {
                            return
                                '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-exclamation"></i>' . $result . '
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <button id="btn_nego_info_gb" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
                            </div>
                        </div>';
                        } else {
                            return
                                '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-exclamation"></i>' . $result . '
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button id="btn_nego_gb" data-id="' . $list->id_penerimaan_po . '" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
                                </div>
                            </div>';
                        }
                    })
                    ->addColumn('kirim_harga', function ($list) {
                        $str_hp = $list->nomer_hp;
                        $no_hp = preg_replace('/^0/', '62', $str_hp);
                        $nama = $list->name;
                        $nopol = $list->nopol;
                        $tonase = tonase($list->hasil_akhir_tonase);
                        $kode_po = $list->kode_po;
                        $harga = rupiah($list->harga_akhir_gb) . '/Kg';
                        return
                            // $no_hp;
                            '<a href="https://api.whatsapp.com/send?phone=' . $no_hp . '&text=Hallo!!%20Supplier%20:%20' . $nama . '.%20Ingin%20menyampaikan%20harga%20bongkaran%20gabah%20Nopol:%20' . $nopol . '%20Tonase:%20' . $tonase . '%20dengan%20PO:%20' . $kode_po . '%20Yaitu%20:%20*' . $harga . '*.%20Terimakasih." target="_blank" class="btn btn-block btn-success" id="btn_kirim_harga"><i class="fi fi-brands-whatsapp"></i>Kirim&nbsp;Harga&nbsp;Supplier</a>';
                    })
                    ->addColumn('surveyor', function ($list) {
                        $result = $list->surveyor_gb;
                        return $result;
                    })
                    ->addColumn('keterangan', function ($list) {
                        $result = $list->keterangan_gb;
                        return $result;
                    })
                    ->addColumn('waktu', function ($list) {
                        $result = $list->waktu_gb;
                        return $result;
                    })
                    ->addColumn('tempat', function ($list) {
                        $result = $list->tempat_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_dibawa', function ($list) {
                        $result = $list->z_yang_dibawa_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_ditolak', function ($list) {
                        $result = $list->z_yang_ditolak_gb;
                        return $result;
                    })
                    ->rawColumns(['name_bid', 'kirim_harga', 'reaksi_harga', 'nama_vendor', "date", 'date_bid', 'kode_po', 'harga_akhir', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
                    // ->whereBetween('lab2_gb.created_at', array($request->from_date, $request->to_date))
                    ->orderBy('id_lab2_gb', 'DESC')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = tonase($list->tonase_awal);
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = tonase($list->tonase_akhir);
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb) . '/Kg';
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                        }
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        if ($list->status_epicor == 1) {
                            return
                                '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-exclamation"></i>' . $result . '
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <button id="btn_nego_info_gb" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
                            </div>
                        </div>';
                        } else {
                            return
                                '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-exclamation"></i>' . $result . '
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button id="btn_nego_gb" data-id="' . $list->id_penerimaan_po . '" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
                                </div>
                            </div>';
                        }
                    })
                    ->addColumn('kirim_harga', function ($list) {
                        $str_hp = $list->nomer_hp;
                        $no_hp = preg_replace('/^0/', '62', $str_hp);
                        $nama = $list->name;
                        $nopol = $list->nopol;
                        $tonase = tonase($list->hasil_akhir_tonase);
                        $kode_po = $list->kode_po;
                        $harga = rupiah($list->harga_akhir_gb) . '/Kg';
                        return
                            // $no_hp;
                            '<a href="https://api.whatsapp.com/send?phone=' . $no_hp . '&text=Hallo!!%20Supplier%20:%20' . $nama . '.%20Ingin%20menyampaikan%20harga%20bongkaran%20gabah%20Nopol:%20' . $nopol . '%20Tonase:%20' . $tonase . '%20dengan%20PO:%20' . $kode_po . '%20Yaitu%20:%20*' . $harga . '*.%20Terimakasih." target="_blank" class="btn btn-block btn-success" id="btn_kirim_harga"><i class="fi fi-brands-whatsapp"></i>Kirim&nbsp;Harga&nbsp;Supplier</a>';
                    })
                    ->addColumn('surveyor', function ($list) {
                        $result = $list->surveyor_gb;
                        return $result;
                    })
                    ->addColumn('keterangan', function ($list) {
                        $result = $list->keterangan_gb;
                        return $result;
                    })
                    ->addColumn('waktu', function ($list) {
                        $result = $list->waktu_gb;
                        return $result;
                    })
                    ->addColumn('tempat', function ($list) {
                        $result = $list->tempat_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_dibawa', function ($list) {
                        $result = $list->z_yang_dibawa_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_ditolak', function ($list) {
                        $result = $list->z_yang_ditolak_gb;
                        return $result;
                    })
                    ->rawColumns(['name_bid', 'kirim_harga', 'reaksi_harga', 'nama_vendor', "date", 'date_bid', 'kode_po', 'harga_akhir', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_deal_gb_ketan_putih_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->orderBy('id_lab2_gb', 'DESC')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = tonase($list->tonase_awal);
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = tonase($list->tonase_akhir);
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb) . '/Kg';
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                        }
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        if ($list->status_epicor == 1) {
                            return
                                '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-exclamation"></i>' . $result . '
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <button id="btn_nego_info_gb" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
                            </div>
                        </div>';
                        } else {
                            return
                                '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-exclamation"></i>' . $result . '
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button id="btn_nego_gb" data-id="' . $list->id_penerimaan_po . '" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
                                </div>
                            </div>';
                        }
                    })
                    ->addColumn('kirim_harga', function ($list) {
                        $str_hp = $list->nomer_hp;
                        $no_hp = preg_replace('/^0/', '62', $str_hp);
                        $nama = $list->name;
                        $nopol = $list->nopol;
                        $tonase = tonase($list->hasil_akhir_tonase);
                        $kode_po = $list->kode_po;
                        $harga = rupiah($list->harga_akhir_gb) . '/Kg';
                        return
                            // $no_hp;
                            '<a href="https://api.whatsapp.com/send?phone=' . $no_hp . '&text=Hallo!!%20Supplier%20:%20' . $nama . '.%20Ingin%20menyampaikan%20harga%20bongkaran%20gabah%20Nopol:%20' . $nopol . '%20Tonase:%20' . $tonase . '%20dengan%20PO:%20' . $kode_po . '%20Yaitu%20:%20*' . $harga . '*.%20Terimakasih." target="_blank" class="btn btn-block btn-success" id="btn_kirim_harga"><i class="fi fi-brands-whatsapp"></i>Kirim&nbsp;Harga&nbsp;Supplier</a>';
                    })
                    ->addColumn('surveyor', function ($list) {
                        $result = $list->surveyor_gb;
                        return $result;
                    })
                    ->addColumn('keterangan', function ($list) {
                        $result = $list->keterangan_gb;
                        return $result;
                    })
                    ->addColumn('waktu', function ($list) {
                        $result = $list->waktu_gb;
                        return $result;
                    })
                    ->addColumn('tempat', function ($list) {
                        $result = $list->tempat_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_dibawa', function ($list) {
                        $result = $list->z_yang_dibawa_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_ditolak', function ($list) {
                        $result = $list->z_yang_ditolak_gb;
                        return $result;
                    })
                    ->rawColumns(['name_bid', 'kirim_harga', 'reaksi_harga', 'nama_vendor', "date", 'date_bid', 'kode_po', 'harga_akhir', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
                    // ->whereBetween('lab2_gb.created_at', array($request->from_date, $request->to_date))
                    ->orderBy('id_lab2_gb', 'DESC')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = tonase($list->tonase_awal);
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = tonase($list->tonase_akhir);
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb) . '/Kg';
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                        }
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        if ($list->status_epicor == 1) {
                            return
                                '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-exclamation"></i>' . $result . '
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <button id="btn_nego_info_gb" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
                            </div>
                        </div>';
                        } else {
                            return
                                '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-exclamation"></i>' . $result . '
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button id="btn_nego_gb" data-id="' . $list->id_penerimaan_po . '" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
                                </div>
                            </div>';
                        }
                    })
                    ->addColumn('kirim_harga', function ($list) {
                        $str_hp = $list->nomer_hp;
                        $no_hp = preg_replace('/^0/', '62', $str_hp);
                        $nama = $list->name;
                        $nopol = $list->nopol;
                        $tonase = tonase($list->hasil_akhir_tonase);
                        $kode_po = $list->kode_po;
                        $harga = rupiah($list->harga_akhir_gb) . '/Kg';
                        return
                            // $no_hp;
                            '<a href="https://api.whatsapp.com/send?phone=' . $no_hp . '&text=Hallo!!%20Supplier%20:%20' . $nama . '.%20Ingin%20menyampaikan%20harga%20bongkaran%20gabah%20Nopol:%20' . $nopol . '%20Tonase:%20' . $tonase . '%20dengan%20PO:%20' . $kode_po . '%20Yaitu%20:%20*' . $harga . '*.%20Terimakasih." target="_blank" class="btn btn-block btn-success" id="btn_kirim_harga"><i class="fi fi-brands-whatsapp"></i>Kirim&nbsp;Harga&nbsp;Supplier</a>';
                    })
                    ->addColumn('surveyor', function ($list) {
                        $result = $list->surveyor_gb;
                        return $result;
                    })
                    ->addColumn('keterangan', function ($list) {
                        $result = $list->keterangan_gb;
                        return $result;
                    })
                    ->addColumn('waktu', function ($list) {
                        $result = $list->waktu_gb;
                        return $result;
                    })
                    ->addColumn('tempat', function ($list) {
                        $result = $list->tempat_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_dibawa', function ($list) {
                        $result = $list->z_yang_dibawa_gb;
                        return $result;
                    })
                    ->addColumn('z_yang_ditolak', function ($list) {
                        $result = $list->z_yang_ditolak_gb;
                        return $result;
                    })
                    ->rawColumns(['name_bid', 'kirim_harga', 'reaksi_harga', 'nama_vendor', "date", 'date_bid', 'kode_po', 'harga_akhir', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_deal_pk_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab1_pk', 'lab1_pk.lab1_kode_po_pk', '=', 'data_po.kode_po')
                    ->where('lab1_pk.aksi_harga_pk', 'DEAL')
                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->orderBy('lab1_pk.id_lab1_pk', 'DESC')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = tonase($list->tonase_awal);
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = tonase($list->tonase_akhir);
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
                    })
                    ->addColumn('harga_atas_pk', function ($list) {
                        $result = rupiah($list->harga_atas_pk) . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_incoming_pk', function ($list) {
                        $result = rupiah($list->harga_incoming_pk) . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal_pk', function ($list) {
                        $result = rupiah($list->harga_awal_pk) . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_akhir_pk', function ($list) {
                        $result = $list->harga_akhir_permintaan_pk;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_pk);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_pk);
                        }
                        return $result;
                    })
                    ->addColumn('harga_bongkaran_pk', function ($list) {
                        $result = rupiah($list->harga_bongkaran_pk);
                        return $result;
                    })
                    ->addColumn('reaksi_harga_pk', function ($list) {
                        $result = $list->reaksi_harga_pk;
                        if ($result == '' | $result == null) {
                            $result = 'Rp. -';
                            return $result;
                        } else {
                            $result = rupiah($list->reaksi_harga_pk);
                        }
                    })
                    ->addColumn('aksi_harga_pk', function ($list) {
                        $result = $list->aksi_harga_pk;
                        return '
                <a style="margin:2px;" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
                    })
                    ->addColumn('surveyor_bongkar', function ($list) {
                        $result = $list->surveyor_bongkar;
                        return $result;
                    })
                    ->addColumn('keterangan_bongkar', function ($list) {
                        $result = $list->keterangan_bongkar;
                        return $result;
                    })
                    ->addColumn('waktu_bongkar', function ($list) {
                        $result = $list->waktu_bongkar;
                        return $result;
                    })
                    ->addColumn('tempat_bongkar', function ($list) {
                        $result = $list->tempat_bongkar;
                        return $result;
                    })
                    ->addColumn('z_yang_dibawa', function ($list) {
                        $result = $list->z_yang_dibawa;
                        return $result;
                    })
                    ->addColumn('z_yang_ditolak', function ($list) {
                        $result = $list->z_yang_ditolak;
                        return $result;
                    })
                    ->rawColumns(['name_bid', 'harga_bongkaran_pk', 'nama_vendor', "date", 'date_bid', 'aksi_harga_pk', 'kode_po', 'harga_akhir', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab1_pk', 'lab1_pk.lab1_kode_po_pk', '=', 'data_po.kode_po')
                    ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
                    ->where('lab1_pk.aksi_harga_pk', 'DEAL')
                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    // ->whereBetween('lab2_pk.created_at', array($request->from_date, $request->to_date))
                    ->orderBy('id_lab2_pk', 'DESC')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = tonase($list->tonase_awal);
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = tonase($list->tonase_akhir);
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
                    })
                    ->addColumn('harga_atas_pk', function ($list) {
                        $result = rupiah($list->harga_atas_pk) . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_incoming_pk', function ($list) {
                        $result = rupiah($list->harga_incoming_pk) . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal_pk', function ($list) {
                        $result = rupiah($list->harga_awal_pk) . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_akhir_pk', function ($list) {
                        $result = $list->harga_akhir_permintaan_pk;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_pk);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_pk);
                        }
                        return $result;
                    })
                    ->addColumn('harga_bongkaran_pk', function ($list) {
                        $result = rupiah($list->harga_bongkaran_pk);
                        return $result;
                    })
                    ->addColumn('reaksi_harga_pk', function ($list) {
                        $result = $list->reaksi_harga_pk;
                        if ($result == '' | $result == null) {
                            $result = 'Rp. -';
                            return $result;
                        } else {
                            $result = rupiah($list->reaksi_harga_pk);
                        }
                    })
                    ->addColumn('aksi_harga_pk', function ($list) {
                        $result = $list->aksi_harga_pk;
                        return '
                <a style="margin:2px;" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
                    })
                    ->addColumn('surveyor_bongkar', function ($list) {
                        $result = $list->surveyor_bongkar;
                        return $result;
                    })
                    ->addColumn('keterangan_bongkar', function ($list) {
                        $result = $list->keterangan_bongkar;
                        return $result;
                    })
                    ->addColumn('waktu_bongkar', function ($list) {
                        $result = $list->waktu_bongkar;
                        return $result;
                    })
                    ->addColumn('tempat_bongkar', function ($list) {
                        $result = $list->tempat_bongkar;
                        return $result;
                    })
                    ->addColumn('z_yang_dibawa', function ($list) {
                        $result = $list->z_yang_dibawa;
                        return $result;
                    })
                    ->addColumn('z_yang_ditolak', function ($list) {
                        $result = $list->z_yang_ditolak;
                        return $result;
                    })
                    ->rawColumns(['name_bid', 'harga_bongkaran_pk', 'nama_vendor', "date", 'date_bid', 'aksi_harga_pk', 'kode_po', 'harga_akhir', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function download_data_sourching_deal_gb_excel(Request $request)
    {
        $from_date  = $request->from_date;
        $to_date  = $request->to_date;
        // dd($from_date . '-' . $to_date);

        return Excel::download(new DataSouchingDealGBExcel($from_date, $to_date), 'DATA SOURCHING DEAL GABAH BASAH NGAWI.xlsx');
    }

    function bongkar_logout()
    {
        Auth::guard('bongkar')->logout();
        return redirect()->route('qc.bongkar.login');
    }
    public function listenToReplies(Request $request)
    {
        $from = $request->input('From');
        $body = $request->input('Body');

        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('GET', "https://api.github.com/users/$body");
            $githubResponse = json_decode($response->getBody());
            if ($response->getStatusCode() == 200) {
                $message = "*Name:* $githubResponse->name\n";
                $message .= "*Bio:* $githubResponse->bio\n";
                $message .= "*Lives in:* $githubResponse->location\n";
                $message .= "*Number of Repos:* $githubResponse->public_repos\n";
                $message .= "*Followers:* $githubResponse->followers devs\n";
                $message .= "*Following:* $githubResponse->following devs\n";
                $message .= "*URL:* $githubResponse->html_url\n";
                $this->sendWhatsAppMessage($message, $from);
            } else {
                $this->sendWhatsAppMessage($githubResponse->message, $from);
            }
        } catch (RequestException $th) {
            $response = json_decode($th->getResponse()->getBody());
            $this->sendWhatsAppMessage($response->message, $from);
        }
        return;
    }

    public function get_notifikasilab()
    {
        $data = NotifLab::leftJoin('penerimaan_po', 'penerimaan_po.id_penerimaan_po', 'notifikasi_lab.id_objek')->where('notifikasi_lab.status', 0)->select('notifikasi_lab.*', 'penerimaan_po.no_antrian', 'penerimaan_po.plat_kendaraan')->get();
        return json_encode($data);
    }


    public function set_notifikasilab(request $request)
    {
        $id = $request->id;
        $data = NotifLab::where('id_notif', $id)->first();
        $data->status = 1;
        $data->update();
        if ($data->kategori == 0) {
            return redirect()->route('qc.lab.proses_lab1_gabah_basah');
        } else if ($data->kategori == 1) {
            return redirect()->route('qc.lab.output_proses_lab1_gb');
        } else if ($data->kategori == 2) {
            return redirect()->route('qc.lab.output_proses_lab1_gb');
        } else if ($data->kategori == 3) {
            return redirect()->route('qc.lab.proses_lab2_gabah_basah');
        } else if ($data->kategori == 4) {
            return redirect()->route('qc.lab.output_proses_lab2_gb');
        }
    }

    public function new_notifikasilab()
    {
        $data = NotifLab::where('notifbaru', 0)->first();
        if($data==''||$data==NULL){
            return 'kosong';
        }else{
            
            $title = $data->judul;
            $keterangan = $data->keterangan;
            NotifLab::where('notifbaru', 0)->update(['notifbaru' => 1]);
            $result = ['data' => $data, 'title' => $title, 'keterangan' => $keterangan];
            return response()->json($result);
        }
    }
}
