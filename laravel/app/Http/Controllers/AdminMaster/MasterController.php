<?php

namespace App\Http\Controllers\AdminMaster;

use App\Exports\DataPenerimaanBarangAOL;
use App\Exports\DataTimbanganExportExcel;
use App\Http\Controllers\Controller;
use App\Models\AdminMaster;
use App\Models\DataPO;
use App\Models\DataQcBongkar;
use App\Models\FinishingQCGb;
use App\Models\HargaBawah;
use App\Models\Lab1GabahBasah;
use App\Models\LogAktivityAp;
use App\Models\LogAktivityQc;
use App\Models\LogAktivitySpvAp;
use App\Models\LogAktivitySpvQc;
use App\Models\LogAktivitySecurity;
use App\Models\LogAktivityTimbangan;
use App\Models\LogAktivitySourching;
use App\Models\LogAktivityLab;
use App\Models\LogAktivityUser;
use App\Models\NotifSecurity;
use App\Models\potongPajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Bid;
use App\Models\User;
use App\Models\Broadcast;
use App\Models\HargaAtasGabahBasah;
use DB;
use PDF;
use DataTables;
use Illuminate\Support\Str;
use App\Models\Notif;
use App\Models\ParameterLab;
use App\Models\ParameterLabPkButiranPatah;
use App\Models\ParameterLabPkHampa;
use App\Models\ParameterLabPkKa;
use App\Models\ParameterLabPkKatul;
use App\Models\ParameterLabPkTr;
use App\Models\PenerimaanPO;
use App\Models\PlanHppBerasDs;
use App\Models\PlanHppGabahBasah;
use App\Models\PlanHppGabahKering;
use App\Models\PlanHppPecahKulit;
use App\Models\ApproveBid;
use App\Models\trackerPO;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use GuzzleHttp\Psr7\Response;

class MasterController extends Controller
{
    function master_logout(Request $request)
    {
        $cek_auth = Auth::guard('master')->check();
        // dd(Auth::guard());
        // dd('c');
        if ($cek_auth == 'true') {
            Auth::guard('master')->logout();
            Auth::logout();

            // Auth::session()->invalidate();

            Alert::success('Sukses', 'Anda Berhasil Logout');
            return redirect()->route('master.login')->with('Sukses', 'Anda Berhasil Logout');
            // dd('b');
        } else {
            dd('a');
            Alert::error('Error', 'Anda Gagal Logout');
            return redirect()->route('master.home')->with('Error', 'Anda Gagal Logout');
        }
    }
    public function account_master()
    {
        $id = Auth::guard('master')->user()->id;
        $data = AdminMaster::where('id', $id)->first();
        // dd($data);
        return view('dashboard.admin_master.dt_account', ['data' => $data]);
    }
    public function account_update(Request $request)
    {
        dd($request->all());
        $data = AdminMaster::where('id_admin_master', $request->id)->first();
        $data->name_admin_master = $request->name_master;
        $data->username = $request->username_master;
        $data->email = $request->email_master;
        $data->password_show = $request->password;
        $data->password = Hash::make($request['password']);
        $data->perusahaan = $request->company_master;
        $data->updated_at = $request->updated_at;
        $data->update();
        return response()->json($data);
    }
    function check(Request $request)
    {
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $array = $request->username;
        // $oke = json_encode($array);
        // dd($fieldType);
        if ($fieldType == "username") {
            $data = AdminMaster::where('username', $array)->first();
        } else {
            $data = AdminMaster::where('email', $array)->first();
        }
        if (Auth::guard('master')->attempt(array($fieldType => $request->username, 'password' => $request->password))) {
            Alert::success('Berhasil', 'Selamat Datang ' . $data->name_master);
            return redirect()->route('master.home')->with('Berhasil', 'Selamat Datang ' . $data->name_master);
        } else {
            Alert::error('Gagal', 'Masukkan Email Atau Password Dengan Benar');
            return redirect()->route('master.login')->with('Gagal', 'Masukkan Email Atau Password Dengan Benar');
        }
    }

    public function home()
    {
        return view('dashboard.admin_master.home');
    }

    public function get_notifdataAll()
    {
        $data = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('data_po.status_bid', 13)
            ->where('penerimaan_po.analisa', '=', 'revisi')
            ->orWhere('penerimaan_po.status_analisa', '=', '0')
            ->where('lab2_gb.aksi_harga_gb', 'DEAL')
            ->orderby('id_penerimaan_po', 'desc')
            ->count();
    }

    public function tracker_po()
    {
        return view('dashboard.admin_master.tracker_po ');
    }

    public function tracker_po_index()
    {
        return Datatables::of(trackerPO::orderby('id_tracker_po', 'DESC')->get())
            ->addColumn('proses_tracker', function ($list) {
                if ($list->proses_tracker == '' || $list->proses_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = '<span class="btn btn-label-success btn-sm " style="font-weight: bold;">' . $list->proses_tracker . '</span>';
                }
                return $result;
            })
            ->addColumn('tanggal_po_tracker', function ($list) {
                if ($list->tanggal_po_tracker == '' || $list->tanggal_po_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->tanggal_po_tracker)->isoFormat('DD-MM-Y');
                }
                return $result;
            })
            ->addColumn('penerimaan_po_tracker	', function ($list) {
                if ($list->penerimaan_po_tracker    == '' || $list->penerimaan_po_tracker    == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->penerimaan_po_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('po_terlambat_tracker	', function ($list) {
                if ($list->po_terlambat_tracker    == '' || $list->po_terlambat_tracker    == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->po_terlambat_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('konfirmasi_pending_tracker', function ($list) {
                if ($list->konfirmasi_pending_tracker == '' || $list->konfirmasi_pending_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->konfirmasi_pending_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('pengajuan_po_user_tracker', function ($list) {
                if ($list->pengajuan_po_user_tracker == '' || $list->pengajuan_po_user_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->pengajuan_po_user_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('approve_sourching_tracker', function ($list) {
                if ($list->approve_sourching_tracker == '' || $list->approve_sourching_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->approve_sourching_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('lab1_tracker', function ($list) {
                if ($list->lab1_tracker == '' || $list->lab1_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->lab1_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('pengajuan_approve_lab1_tracker', function ($list) {
                if ($list->pengajuan_approve_lab1_tracker == '' || $list->pengajuan_approve_lab1_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->pengajuan_approve_lab1_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('approve_bongkar_tracker', function ($list) {
                if ($list->approve_bongkar_tracker == '' || $list->approve_bongkar_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->approve_bongkar_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('tolak_approve_bongkar_tracker', function ($list) {
                if ($list->tolak_approve_bongkar_tracker == '' || $list->tolak_approve_bongkar_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->tolak_approve_bongkar_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('panggil_truk_tracker', function ($list) {
                if ($list->panggil_truk_tracker == '' || $list->panggil_truk_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->panggil_truk_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('timbangan_awal_tracker', function ($list) {
                if ($list->timbangan_awal_tracker == '' || $list->timbangan_awal_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->timbangan_awal_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('input_bongkar_tracker', function ($list) {
                if ($list->input_bongkar_tracker == '' || $list->input_bongkar_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->input_bongkar_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('timbangan_akhir_tracker', function ($list) {
                if ($list->timbangan_akhir_tracker == '' || $list->timbangan_akhir_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->timbangan_akhir_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('lab2_tracker', function ($list) {
                if ($list->lab2_tracker == '' || $list->lab2_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->lab2_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('pengajuan_approve_lab2_tracker', function ($list) {
                if ($list->pengajuan_approve_lab2_tracker == '' || $list->pengajuan_approve_lab2_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->pengajuan_approve_lab2_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('approve_lab2_tracker', function ($list) {
                if ($list->approve_lab2_tracker == '' || $list->approve_lab2_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->approve_lab2_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('tolak_approve_lab2_tracker', function ($list) {
                if ($list->tolak_approve_lab2_tracker == '' || $list->tolak_approve_lab2_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->tolak_approve_lab2_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('deal_sourching_tracker', function ($list) {
                if ($list->deal_sourching_tracker == '' || $list->deal_sourching_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->deal_sourching_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('nego_sourching_tracker', function ($list) {
                if ($list->nego_sourching_tracker == '' || $list->nego_sourching_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->nego_sourching_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('proses_nego_spvqc_tracker', function ($list) {
                if ($list->proses_nego_spvqc_tracker == '' || $list->proses_nego_spvqc_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->proses_nego_spvqc_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('verifikasi_ap_tracker', function ($list) {
                if ($list->verifikasi_ap_tracker == '' || $list->verifikasi_ap_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->verifikasi_ap_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('pengajuan_revisi_ap_tracker', function ($list) {
                if ($list->pengajuan_revisi_ap_tracker == '' || $list->pengajuan_revisi_ap_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->pengajuan_revisi_ap_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('approve_spvap_tracker', function ($list) {
                if ($list->approve_spvap_tracker == '' || $list->approve_spvap_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->approve_spvap_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('tolak_approve_spvap_tracker', function ($list) {
                if ($list->tolak_approve_spvap_tracker == '' || $list->tolak_approve_spvap_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->tolak_approve_spvap_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('approve_revisi_spvap_tracker', function ($list) {
                if ($list->approve_revisi_spvap_tracker == '' || $list->approve_revisi_spvap_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->approve_revisi_spvap_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('approve_tolak_revisi_spvap_tracker', function ($list) {
                if ($list->approve_tolak_revisi_spvap_tracker == '' || $list->approve_tolak_revisi_spvap_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->approve_tolak_revisi_spvap_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('revisi_po_tracker', function ($list) {
                if ($list->revisi_po_tracker == '' || $list->revisi_po_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->revisi_po_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('kirim_epicor_spvap_tracker', function ($list) {
                if ($list->kirim_epicor_spvap_tracker == '' || $list->kirim_epicor_spvap_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->kirim_epicor_spvap_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('approve_tolak_lab1_tracker', function ($list) {
                if ($list->approve_tolak_lab1_tracker == '' || $list->approve_tolak_lab1_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->approve_tolak_lab1_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->addColumn('po_terlambat_tracker', function ($list) {
                if ($list->po_terlambat_tracker == '' || $list->po_terlambat_tracker == NULL) {
                    $result = '-';
                } else {
                    $result = \Carbon\Carbon::parse($list->po_terlambat_tracker)->isoFormat('DD-MM-Y H:m:s');
                }
                return $result;
            })
            ->rawColumns(['proses_tracker', 'po_terlambat_tracker', 'approve_tolak_lab1_tracker', 'tanggal_po_tracker', 'penerimaan_po_tracker', 'po_terlambat_tracker', 'konfirmasi_pending_tracker', 'pengajuan_po_user_tracker', 'approve_sourching_tracker', 'lab1_tracker', 'pengajuan_approve_lab1_tracker', 'approve_bongkar_tracker', 'tolak_approve_bongkar_tracker', 'panggil_truk_tracker', 'timbangan_awal_tracker', 'input_bongkar_tracker', 'timbangan_akhir_tracker', 'lab2_tracker', 'pengajuan_approve_lab2_tracker', 'approve_lab2_tracker', 'tolak_approve_lab2_tracker', 'deal_sourching_tracker', 'nego_sourching_tracker', 'proses_nego_spvqc_tracker', 'verifikasi_ap_tracker', 'pengajuan_revisi_ap_tracker', 'approve_spvap_tracker', 'tolak_approve_spvap_tracker', 'approve_revisi_spvap_tracker', 'approve_tolak_revisi_spvap_tracker', 'revisi_po_tracker', 'kirim_epicor_spvap_tracker'])
            ->make(true);
    }
    public function timbangan_awal()
    {
        return view('dashboard.admin_master.admin_timbangan.timbangan_awal');
    }

    public function timbangan_awal_gb_ciherang_index()
    {

        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 8)
            ->where('bid.name_bid', '=', 'GABAH BASAH CIHERANG')
            // ->orderBy('id_data_po', 'desc')
            ->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('nama_penerima_po', function ($list) {
                $result = $list->name;
                return $result;
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_penerimaan == 8) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="to_show btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Initial Tonnage
                </a>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'name_bid', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'ckelola'])
            ->make(true);
    }
    public function timbangan_awal_gb_longgrain_index()
    {

        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 8)
            ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')

            // ->orderBy('id_data_po', 'desc')
            ->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('nama_penerima_po', function ($list) {
                $result = $list->name;
                return $result;
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_penerimaan == 8) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_tonaseawal" title="Edit Data" class="to_show btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Initial Tonnage
                </a>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'name_bid', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'ckelola'])
            ->make(true);
    }
    public function timbangan_awal_gb_pandan_wangi_index()
    {

        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 8)
            ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')

            // ->orderBy('id_data_po', 'desc')
            ->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('nama_penerima_po', function ($list) {
                $result = $list->name;
                return $result;
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_penerimaan == 8) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_tonaseawal" title="Edit Data" class="to_show btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Initial Tonnage
                </a>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'name_bid', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'ckelola'])
            ->make(true);
    }
    public function timbangan_awal_gb_ketan_putih_index()
    {

        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 8)
            ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')

            // ->orderBy('id_data_po', 'desc')
            ->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('nama_penerima_po', function ($list) {
                $result = $list->name;
                return $result;
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_penerimaan == 8) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_tonaseawal" title="Edit Data" class="to_show btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Initial Tonnage
                </a>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'name_bid', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'ckelola'])
            ->make(true);
    }
    public function timbangan_awal_pk_index()
    {

        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 8)
            ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
            // ->orderBy('id_data_po', 'desc')
            ->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('nama_penerima_po', function ($list) {
                $result = $list->name;
                return $result;
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_penerimaan == 8) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="to_show btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Initial Tonnage
                </a>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'name_bid', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'ckelola'])
            ->make(true);
    }
    public function show_antrian_timbangan_masuk($id)
    {
        $show_data = DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->where('data_po.status_bid', 8)
            ->where('id_penerimaan_po', $id)
            ->first();
        return json_encode($show_data);
    }

    public function data_timbangan_awal()
    {
        return view('dashboard.admin_master.admin_timbangan.data_timbangan_awal');
    }

    public function data_timbangan_awal_gb_ciherang_index()
    {

        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins_timbangan', 'admins_timbangan.id_admin_timbangan', '=', 'penerimaan_po.penerima_tonase_awal')
            ->where('bid.name_bid', '=', 'GABAH BASAH CIHERANG')
            ->where('penerimaan_po.status_penerimaan', '>', 8)
            ->where('penerimaan_po.tonase_akhir', NULL)
            ->orderBy('penerimaan_po.waktu_penerimaan', 'DESC')
            ->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('penerima_tonase_awal', function ($list) {
                $result = $list->name_admin_timbangan;
                return $result;
            })
            ->addColumn('tonase_awal', function ($list) {
                $result = $list->tonase_awal . '/Kg';
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if (($list->status_penerimaan) == '11') {
                    return
                        '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Proses&nbsp;Timbangan&nbsp;2
                    </button>';
                } else {
                    return
                        '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Proses&nbsp;Bongkar
                    </button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'name_bid', 'plat_kendaraan', 'tanggal_po', 'penerima_tonase_awal', 'tonase_awal', 'ckelola'])
            ->make(true);
    }
    public function data_timbangan_awal_gb_longgrain_index()
    {

        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins_timbangan', 'admins_timbangan.id_admin_timbangan', '=', 'penerimaan_po.penerima_tonase_awal')
            ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
            ->where('penerimaan_po.status_penerimaan', '>', 8)
            ->where('penerimaan_po.tonase_akhir', NULL)
            ->orderBy('penerimaan_po.waktu_penerimaan', 'DESC')
            ->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('penerima_tonase_awal', function ($list) {
                $result = $list->name_admin_timbangan;
                return $result;
            })
            ->addColumn('tonase_awal', function ($list) {
                $result = tonase($list->tonase_awal);
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if (($list->status_penerimaan) == '11') {
                    return
                        '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Proses&nbsp;Timbangan&nbsp;2
                    </button>';
                } else {
                    return
                        '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Proses&nbsp;Bongkar
                    </button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'name_bid', 'plat_kendaraan', 'tanggal_po', 'penerima_tonase_awal', 'tonase_awal', 'ckelola'])
            ->make(true);
    }
    public function data_timbangan_awal_gb_pandan_wangi_index()
    {

        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins_timbangan', 'admins_timbangan.id_admin_timbangan', '=', 'penerimaan_po.penerima_tonase_awal')
            ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
            ->where('penerimaan_po.status_penerimaan', '>', 8)
            ->where('penerimaan_po.tonase_akhir', NULL)
            ->orderBy('penerimaan_po.waktu_penerimaan', 'DESC')
            ->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('penerima_tonase_awal', function ($list) {
                $result = $list->name_admin_timbangan;
                return $result;
            })
            ->addColumn('tonase_awal', function ($list) {
                $result = $list->tonase_awal . '/Kg';
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if (($list->status_penerimaan) == '11') {
                    return
                        '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Proses&nbsp;Timbangan&nbsp;2
                    </button>';
                } else {
                    return
                        '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Proses&nbsp;Bongkar
                    </button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'name_bid', 'plat_kendaraan', 'tanggal_po', 'penerima_tonase_awal', 'tonase_awal', 'ckelola'])
            ->make(true);
    }
    public function data_timbangan_awal_gb_ketan_putih_index()
    {

        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins_timbangan', 'admins_timbangan.id_admin_timbangan', '=', 'penerimaan_po.penerima_tonase_awal')
            ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
            ->where('penerimaan_po.status_penerimaan', '>', 8)
            ->where('penerimaan_po.tonase_akhir', NULL)
            ->orderBy('penerimaan_po.waktu_penerimaan', 'DESC')
            ->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('penerima_tonase_awal', function ($list) {
                $result = $list->name_admin_timbangan;
                return $result;
            })
            ->addColumn('tonase_awal', function ($list) {
                $result = $list->tonase_awal . '/Kg';
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if (($list->status_penerimaan) == '11') {
                    return
                        '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Proses&nbsp;Timbangan&nbsp;2
                    </button>';
                } else {
                    return
                        '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Proses&nbsp;Bongkar
                    </button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'name_bid', 'plat_kendaraan', 'tanggal_po', 'penerima_tonase_awal', 'tonase_awal', 'ckelola'])
            ->make(true);
    }
    public function data_timbangan_awal_pk_index()
    {
        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins_timbangan', 'admins_timbangan.id_admin_timbangan', '=', 'penerimaan_po.penerima_tonase_awal')
            ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
            ->where('penerimaan_po.status_penerimaan', '>=', 9)
            ->where('penerimaan_po.tonase_akhir', NULL)
            ->orderBy('penerimaan_po.waktu_penerimaan', 'DESC')
            ->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
                <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
                ';
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('penerima_tonase_awal', function ($list) {
                $result = $list->name_admin_timbangan;
                return $result;
            })
            ->addColumn('tonase_awal', function ($list) {
                $result = $list->tonase_awal . '/Kg';
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if (($list->status_penerimaan) == '11') {
                    return
                        '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Proses&nbsp;Timbangan&nbsp;2
                    </button>';
                } else {
                    return
                        '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Proses&nbsp;Bongkar
                    </button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'name_bid', 'plat_kendaraan', 'tanggal_po', 'penerima_tonase_awal', 'tonase_awal', 'ckelola'])
            ->make(true);
    }

    public function terima_tonase_awal(Request $request)
    {
        $data = PenerimaanPO::where('id_penerimaan_po', $request->id_penerimaan_po)->first();
        $data->penerima_tonase_awal         = Auth::guard('master')->user()->name_master;
        $data->plat_kendaraan               = Str::upper($request->plat_kendaraan);
        $data->keterangan_penerimaan_po     = $request->asal_gabah;
        $data->tanggal_masuk                = $request->tanggal_masuk;
        $data->jam_masuk                    = $request->jam_masuk;
        $data->created_at_tonase_awal       = date('Y-m-d H:i:s');
        $data->tonase_awal                  = $request->tonase_awal;
        $data->status_penerimaan            = 9;
        $data->update();

        $log                               = new LogAktivityTimbangan();
        $log->nama_user                    = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_timbangan = $request->id_penerimaan_po;
        $log->aktivitas_timbangan          = 'Insert Tonase Awal. Kode PO: ' . $request->penerimaan_kode_po . ' Tonase Awal : ' . tonase($request->tonase_awal);
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();

        $data = DataPO::where('id_data_po', $request->penerimaan_id_data_po)->first();
        $data->nopol =  Str::upper($request->plat_kendaraan);
        $data->status_bid = 9;
        $data->update();


        if (
            $request->name_bid == 'GABAH BASAH LONG GRAIN' || $request->name_bid == 'GABAH BASAH CIHERANG' || $request->name_bid == 'GABAH BASAH LONG GRAIN 50 KG' || $request->name_bid == 'GABAH BASAH LONG GRAIN JUMBO BAG' || $request->name_bid == 'GABAH BASAH PANDAN WANGI' || $request->name_bid == 'GABAH BASAH PANDAN WANGI 50 KG'
            || $request->name_bid == 'GABAH BASAH PANDAN WANGI JUMBO BAG' || $request->name_bid == 'GABAH BASAH PERA' || $request->name_bid == 'GABAH BASAH PERA 50 KG' || $request->name_bid == 'GABAH BASAH PERA JUMBO BAG' || $request->name_bid == 'GABAH BASAH KETAN PUTIH'
            || $request->name_bid == 'GABAH BASAH KETAN PUTIH 50 KG' || $request->name_bid == 'GABAH BASAH KETAN PUTIH JUMBO BAG'
        ) {
            $data = Lab1GabahBasah::where('lab1_kode_po_gb', $request->penerimaan_kode_po)->first();
            $data->status_lab1_gb = 9;
            $data->lab1_plat_gb =  Str::upper($request->plat_kendaraan);
            $data->update();
        } else if (
            $request->name_bid == 'GABAH KERING LONG GRAIN' || $request->name_bid == 'GABAH KERING LONG GRAIN 50 KG' || $request->name_bid == 'GABAH KERING LONG GRAIN JUMBO BAG' || $request->name_bid == 'GABAH KERING PANDAN WANGI' || $request->name_bid == 'GABAH KERING PANDAN WANGI 50 KG'
            || $request->name_bid == 'GABAH KERING PANDAN WANGI JUMBO BAG' || $request->name_bid == 'GABAH KERING PERA' || $request->name_bid == 'GABAH KERING PERA 50 KG' || $request->name_bid == 'GABAH KERING PERA JUMBO BAG' || $request->name_bid == 'GABAH KERING KETAN PUTIH'
            || $request->name_bid == 'GABAH KERING KETAN PUTIH 50 KG' || $request->name_bid == 'GABAH KERING KETAN PUTIH JUMBO BAG'
        ) {
            $data = Lab1GabahBasah::where('lab1_kode_po_gb', $request->penerimaan_kode_po)->first();
            $data->status_lab1_gb = 9;
            $data->lab1_plat_gb =  Str::upper($request->plat_kendaraan);
            $data->update();
        } else if (
            $request->name_bid == 'BERAS PECAH KULIT LONG GRAIN' || $request->name_bid == 'BERAS PECAH KULIT LONG GRAIN 50 KG' || $request->name_bid == 'BERAS PECAH KULIT LONG GRAIN JUMBO BAG' || $request->name_bid == 'BERAS PECAH KULIT PANDAN WANGI' || $request->name_bid == 'BERAS PECAH KULIT PANDAN WANGI 50 KG'
            || $request->name_bid == 'BERAS PECAH KULIT PANDAN WANGI JUMBO BAG' || $request->name_bid == 'BERAS PECAH KULIT PERA' || $request->name_bid == 'BERAS PECAH KULIT PERA 50 KG' || $request->name_bid == 'BERAS PECAH KULIT PERA JUMBO BAG' || $request->name_bid == 'BERAS PECAH KULIT KETAN PUTIH'
            || $request->name_bid == 'BERAS PECAH KULIT KETAN PUTIH 50 KG' || $request->name_bid == 'BERAS PECAH KULIT KETAN PUTIH JUMBO BAG'
        ) {
            $data = Lab1Pecahkulit::where('lab1_kode_po_pk', $request->penerimaan_kode_po)->first();
            $data->status_lab1_pk = 9;
            $data->lab1_plat_pk =  Str::upper($request->plat_kendaraan);
            $data->update();
        } else {
            $data = DB::table('lab1_ds')->where('lab1_id_penerimaan_po_ds', $request->id_penerimaan_po)->where('lab1_id_data_po_ds', $request->penerimaan_id_data_po)
                ->where('lab1_kode_po_ds', $request->penerimaan_kode_po)->update(['status_lab1_ds' => 9]);
        }
        return response()->json($data);
    }


    public function timbangan_akhir()
    {
        return view('dashboard.admin_master.admin_timbangan.timbangan_akhir');
    }

    public function show_timbangan_akhir($id)
    {
        $show_data = DB::table('penerimaan_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'penerimaan_po.penerimaan_kode_po')
            ->where('id_penerimaan_po', $id)
            ->count();
        // dd($show_data);
        if ($show_data == '0') {
            $data = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                ->join('users', 'users.id', '=', 'data_po.user_idbid')
                ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                ->where('id_penerimaan_po', $id)
                ->first();
        } else {
            $data = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                ->join('users', 'users.id', '=', 'data_po.user_idbid')
                ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'penerimaan_po.penerimaan_kode_po')
                ->where('id_penerimaan_po', $id)
                ->first();
        }
        return json_encode($data);
    }

    public function cetak_penerimaanpo($id)
    {
        $params = DB::table('penerimaan_po')
            ->join('data_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'user_idbid')
            ->join('lab1_gb', 'lab1_gb.lab1_id_penerimaan_po_gb', '=', 'penerimaan_po.id_penerimaan_po')
            ->join('data_qc_bongkar', 'penerimaan_po.penerimaan_kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
            ->where('penerimaan_po.id_penerimaan_po', $id)
            ->first();
        $data = DB::table('penerimaan_po')
            ->join('data_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'user_idbid')
            ->join('lab1_gb', 'lab1_gb.lab1_id_penerimaan_po_gb', '=', 'penerimaan_po.id_penerimaan_po')
            ->join('data_qc_bongkar', 'penerimaan_po.penerimaan_kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
            ->where('penerimaan_po.id_penerimaan_po', $id)
            ->get();
        // dd($data);
        $get_provinsi = DB::table('provinces')
            ->where('id', $params->id_provinsiktp)->get();
        $get_kabupaten = DB::table('regencies')
            ->where('id', $params->id_kabupatenktp)->get();
        $get_kecamatan = DB::table('districts')
            ->where('id', $params->id_kecamatanktp)->get();
        $get_desa = DB::table('villages')
            ->where('id', $params->id_desaktp)->get();
        $get_item = DB::table('item')
            ->where('nama_item', $params->name_bid)->first();
        // dd($get_provinsi);    
        // return view('dashboard.admin_master.admin_timbangan.cetak_penerimaanpo2', ['data' => $data, 'get_item' => $get_item, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa,]);
        $data = PDF::loadview('dashboard.admin_master.admin_timbangan.cetak_penerimaanpo', ['data' => $data, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa, 'get_item' => $get_item]);
        return $data->stream('CETAK ' . $params->no_dtm . ' pdf');
    }
    public function cetak_penerimaanpo_pk($id)
    {
        $params = DB::table('penerimaan_po')
            ->join('data_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'user_idbid')
            ->join('lab1_pk', 'lab1_pk.lab1_id_penerimaan_po_pk', '=', 'penerimaan_po.id_penerimaan_po')
            ->join('data_qc_bongkar', 'penerimaan_po.penerimaan_kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
            ->where('penerimaan_po.id_penerimaan_po', $id)
            ->first();
        $data = DB::table('penerimaan_po')
            ->join('data_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'user_idbid')
            ->join('lab1_pk', 'lab1_pk.lab1_id_penerimaan_po_pk', '=', 'penerimaan_po.id_penerimaan_po')
            ->join('data_qc_bongkar', 'penerimaan_po.penerimaan_kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
            ->where('penerimaan_po.id_penerimaan_po', $id)
            ->get();
        // dd($data);
        $get_provinsi = DB::table('provinces')
            ->where('id', $params->id_provinsiktp)->get();
        $get_kabupaten = DB::table('regencies')
            ->where('id', $params->id_kabupatenktp)->get();
        $get_kecamatan = DB::table('districts')
            ->where('id', $params->id_kecamatanktp)->get();
        $get_desa = DB::table('villages')
            ->where('id', $params->id_desaktp)->get();
        $get_item = DB::table('item')
            ->where('nama_item', $params->name_bid)->first();
        // dd($get_provinsi);    
        // return view('dashboard.admin_master.admin_timbangan.cetak_penerimaanpo2', ['data' => $data, 'get_item' => $get_item, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa,]);
        $data = PDF::loadview('dashboard.admin_master.admin_timbangan.cetak_penerimaanpo_pk', ['data' => $data, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa, 'get_item' => $get_item]);
        return $data->stream('CETAK ' . $params->no_dtm . ' pdf');
    }
    public function cetak_penerimaanpo_2($id)
    {
        $params = DB::table('penerimaan_po')
            ->join('data_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'user_idbid')
            ->join('lab1_gb', 'lab1_gb.lab1_id_penerimaan_po_gb', '=', 'penerimaan_po.id_penerimaan_po')
            ->join('data_qc_bongkar', 'penerimaan_po.penerimaan_kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
            ->where('penerimaan_po.id_penerimaan_po', $id)
            ->first();
        $data = DB::table('penerimaan_po')
            ->join('data_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'user_idbid')
            ->join('lab1_gb', 'lab1_gb.lab1_id_penerimaan_po_gb', '=', 'penerimaan_po.id_penerimaan_po')
            ->join('data_qc_bongkar', 'penerimaan_po.penerimaan_kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
            ->where('penerimaan_po.id_penerimaan_po', $id)
            ->get();
        // dd($data);
        $get_provinsi = DB::table('provinces')
            ->where('id', $params->id_provinsiktp)->get();
        $get_kabupaten = DB::table('regencies')
            ->where('id', $params->id_kabupatenktp)->get();
        $get_kecamatan = DB::table('districts')
            ->where('id', $params->id_kecamatanktp)->get();
        $get_desa = DB::table('villages')
            ->where('id', $params->id_desaktp)->get();
        $get_item = DB::table('item')
            ->where('nama_item', $params->name_bid)->first();
        // dd($get_provinsi);    
        // return view('dashboard.admin_master.admin_timbangan.cetak_penerimaanpo2', ['data' => $data, 'get_item' => $get_item, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa,]);
        $data = PDF::loadview('dashboard.admin_master.admin_timbangan.cetak_penerimaanpo2', ['data' => $data, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa, 'get_item' => $get_item]);
        return $data->stream('CETAK ' . $params->no_dtm . ' pdf');
    }
    public function cetak_penerimaanpo2_pk($id)
    {
        $params = DB::table('penerimaan_po')
            ->join('data_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'user_idbid')
            ->join('lab1_pk', 'lab1_pk.lab1_id_penerimaan_po_pk', '=', 'penerimaan_po.id_penerimaan_po')
            ->join('data_qc_bongkar', 'penerimaan_po.penerimaan_kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
            ->where('penerimaan_po.id_penerimaan_po', $id)
            ->first();
        $data = DB::table('penerimaan_po')
            ->join('data_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'user_idbid')
            ->join('lab1_pk', 'lab1_pk.lab1_id_penerimaan_po_pk', '=', 'penerimaan_po.id_penerimaan_po')
            ->join('data_qc_bongkar', 'penerimaan_po.penerimaan_kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
            ->where('penerimaan_po.id_penerimaan_po', $id)
            ->get();
        // dd($data);
        $get_provinsi = DB::table('provinces')
            ->where('id', $params->id_provinsiktp)->get();
        $get_kabupaten = DB::table('regencies')
            ->where('id', $params->id_kabupatenktp)->get();
        $get_kecamatan = DB::table('districts')
            ->where('id', $params->id_kecamatanktp)->get();
        $get_desa = DB::table('villages')
            ->where('id', $params->id_desaktp)->get();
        $get_item = DB::table('item')
            ->where('nama_item', $params->name_bid)->first();
        // dd($get_provinsi);    
        // return view('dashboard.admin_master.admin_timbangan.cetak_penerimaanpo2', ['data' => $data, 'get_item' => $get_item, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa,]);
        $data = PDF::loadview('dashboard.admin_master.admin_timbangan.cetak_penerimaanpo2_pk', ['data' => $data, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa, 'get_item' => $get_item]);
        return $data->stream('CETAK ' . $params->no_dtm . ' pdf');
    }
    public function terima_tonase_akhir(Request $request)
    {
        $tgl_po = \Carbon\Carbon::parse($request->tanggal_po)->format('m.y');
        $hitung = DB::table('penerimaan_po')
            ->where('status_penerimaan', '!=', '16')
            ->where('form_tonase_akhir', '!=', NULL)
            ->count();
        $count = $hitung + 1;
        if ($request->item == 'GABAH BASAH LONG GRAIN' || $request->item == 'GABAH BASAH PANDAN WANGI' || $request->item == 'GABAH BASAH KETAN PUTIH') {
            if (strlen((string) $count) == 1) {
                $no_form = 'RI.BP.' . $tgl_po . '.0000' . $count;
            } else if (strlen((string) $count) == 2) {
                $no_form = 'RI.BP.' . $tgl_po . '.000' . $count;
            } else if (strlen((string) $count) == 3) {
                $no_form = 'RI.BP.' . $tgl_po . '.00' . $count;
            } else if (strlen((string) $count) == 4) {
                $no_form = 'RI.BP.' . $tgl_po . '.0' . $count;
            } else if (strlen((string) $count) == 5) {
                $no_form = 'RI.BP.' . $tgl_po . '.' . $count;
            }
            // dd($count, $tgl_po, $no_form);
            if ($request->id_lab2 == 'NULL' || $request->id_lab2 == '') {
                $data = PenerimaanPO::where('id_penerimaan_po', $request->id_penerimaan_po)->first();
                $data->form_tonase_akhir = $no_form;
                $data->penerima_tonase_akhir = $request->penerima_tonase_akhir;
                $data->tanggal_keluar = $request->tanggal_keluar;
                $data->jam_keluar = $request->jam_keluar;
                $data->tonase_akhir = $request->tonase_akhir;
                $data->created_at_tonase_akhir = date('Y-m-d H:i:s');
                $data->hasil_akhir_tonase = $request->hasil_akhir_tonase;
                $data->netto2 = $request->hasil_akhir_tonase;
                $data->update();

                $log                               = new LogAktivityTimbangan();
                $log->nama_user                    = Auth::guard('master')->user()->name_master;
                $log->id_objek_aktivitas_timbangan = $request->id_penerimaan_po;
                $log->aktivitas_timbangan          = 'Insert Tonase Akhir. Kode PO: ' . $data->penerimaan_kode_po . ' Tonase Akhir : ' . tonase($request->tonase_akhir) . ' Hasil Tonase : ' . tonase($request->hasil_akhir_tonase);
                $log->keterangan_aktivitas         = 'Selesai';
                $log->created_at                   = date('Y-m-d H:i:s');
                $log->save();
                return response()->json($data);
            } else {
                $data = PenerimaanPO::where('id_penerimaan_po', $request->id_penerimaan_po)->first();
                $data->form_tonase_akhir = $no_form;
                $data->penerima_tonase_akhir = $request->penerima_tonase_akhir;
                $data->tanggal_keluar = $request->tanggal_keluar;
                $data->jam_keluar = $request->jam_keluar;
                $data->tonase_akhir = $request->tonase_akhir;
                $data->created_at_tonase_akhir = date('Y-m-d H:i:s');
                $data->hasil_akhir_tonase = $request->hasil_akhir_tonase;
                $data->netto2 = $request->hasil_akhir_tonase;
                $data->update();

                $log                               = new LogAktivityTimbangan();
                $log->nama_user                    = Auth::guard('master')->user()->name_master;
                $log->id_objek_aktivitas_timbangan = $request->id_penerimaan_po;
                $log->aktivitas_timbangan          = 'Insert Tonase Akhir. Kode PO: ' . $data->penerimaan_kode_po . ' Tonase Akhir : ' . tonase($request->tonase_akhir) . ' Hasil Tonase : ' . tonase($request->hasil_akhir_tonase);
                $log->keterangan_aktivitas         = 'Selesai';
                $log->created_at                   = date('Y-m-d H:i:s');
                $log->save();

                $data = Lab2GabahBasah::where('lab2_kode_po_gb', $request->penerimaan_kode_po)->first();
                $data->plan_berat_kg_pertruk_gb = $request->plan_berat_kg_pertruk;
                $data->plan_berat_pk_pertruk_gb = $request->plan_berat_pk_pertruk;
                $data->plan_berat_beras_pertruk_gb = $request->plan_berat_beras_pertruk;
                $data->plan_total_harga_gabah_pertruk_gb = $request->plan_total_harga_gabah_pertruk;
                $data->plan_total_harga_pk_pertruk_gb = $request->plan_total_harga_pk_pertruk;
                $data->plan_total_harga_beras_pertruk_gb = $request->plan_total_harga_beras_pertruk;
                $data->aktual_price_ongkos_driyer_gb = $request->aktual_price_ongkos_driyer;
                $data->plan_harga_aktual_pertruk_gb = $request->plan_harga_aktual_pertruk;
                $data->plan_hpp_aktual1_gb = $request->plan_hpp_aktual1;
                $data->update();

                return response()->json($data);
            }
        } else if ($request->item == 'BERAS PECAH KULIT LONG GRAIN' || $request->item == 'BERAS PECAH KULIT') {
            if (strlen((string) $count) == 1) {
                $no_form = 'RI.BB.' . $tgl_po . '.0000' . $count;
            } else if (strlen((string) $count) == 2) {
                $no_form = 'RI.BB.' . $tgl_po . '.000' . $count;
            } else if (strlen((string) $count) == 3) {
                $no_form = 'RI.BB.' . $tgl_po . '.00' . $count;
            } else if (strlen((string) $count) == 4) {
                $no_form = 'RI.BB.' . $tgl_po . '.0' . $count;
            } else if (strlen((string) $count) == 5) {
                $no_form = 'RI.BB.' . $tgl_po . '.' . $count;
            }
            if ($request->id_lab2 == 'NULL' || $request->id_lab2 == '') {
                $data = PenerimaanPO::where('id_penerimaan_po', $request->id_penerimaan_po)->first();
                $data->form_tonase_akhir = $no_form;
                $data->penerima_tonase_akhir = $request->penerima_tonase_akhir;
                $data->tanggal_keluar = $request->tanggal_keluar;
                $data->jam_keluar = $request->jam_keluar;
                $data->tonase_akhir = $request->tonase_akhir;
                $data->created_at_tonase_akhir = date('Y-m-d H:i:s');
                $data->hasil_akhir_tonase = $request->hasil_akhir_tonase;
                $data->netto2 = $request->hasil_akhir_tonase;
                $data->update();

                return response()->json($data);
            } else {
                $data = PenerimaanPO::where('id_penerimaan_po', $request->id_penerimaan_po)->first();
                $data->form_tonase_akhir = $no_form;
                $data->penerima_tonase_akhir = $request->penerima_tonase_akhir;
                $data->tanggal_keluar = $request->tanggal_keluar;
                $data->jam_keluar = $request->jam_keluar;
                $data->tonase_akhir = $request->tonase_akhir;
                $data->created_at_tonase_akhir = date('Y-m-d H:i:s');
                $data->hasil_akhir_tonase = $request->hasil_akhir_tonase;
                $data->netto2 = $request->hasil_akhir_tonase;
                $data->update();

                $data = Lab2GabahBasah::where('lab2_kode_po_gb', $request->penerimaan_kode_po)->first();
                $data->plan_berat_kg_pertruk_gb = $request->plan_berat_kg_pertruk;
                $data->plan_berat_pk_pertruk_gb = $request->plan_berat_pk_pertruk;
                $data->plan_berat_beras_pertruk_gb = $request->plan_berat_beras_pertruk;
                $data->plan_total_harga_gabah_pertruk_gb = $request->plan_total_harga_gabah_pertruk;
                $data->plan_total_harga_pk_pertruk_gb = $request->plan_total_harga_pk_pertruk;
                $data->plan_total_harga_beras_pertruk_gb = $request->plan_total_harga_beras_pertruk;
                $data->update();

                return response()->json($data);
            }
        } else if ($request->item == 'BERAS DS') {
            if (strlen((string) $count) == 1) {
                $no_form = 'RI.BJ.' . $tgl_po . '.0000' . $count;
            } else if (strlen((string) $count) == 2) {
                $no_form = 'RI.BJ.' . $tgl_po . '.000' . $count;
            } else if (strlen((string) $count) == 3) {
                $no_form = 'RI.BJ.' . $tgl_po . '.00' . $count;
            } else if (strlen((string) $count) == 4) {
                $no_form = 'RI.BJ.' . $tgl_po . '.0' . $count;
            } else if (strlen((string) $count) == 5) {
                $no_form = 'RI.BJ.' . $tgl_po . '.' . $count;
            }
            if ($request->id_lab2 == 'NULL' || $request->id_lab2 == '') {
                $data = PenerimaanPO::where('id_penerimaan_po', $request->id_penerimaan_po)->first();
                $data->form_tonase_akhir = $no_form;
                $data->penerima_tonase_akhir = $request->penerima_tonase_akhir;
                $data->tanggal_keluar = $request->tanggal_keluar;
                $data->jam_keluar = $request->jam_keluar;
                $data->tonase_akhir = $request->tonase_akhir;
                $data->created_at_tonase_akhir = date('Y-m-d H:i:s');
                $data->hasil_akhir_tonase = $request->hasil_akhir_tonase;
                $data->netto2 = $request->hasil_akhir_tonase;
                $data->update();

                return response()->json($data);
            } else {
                $data = PenerimaanPO::where('id_penerimaan_po', $request->id_penerimaan_po)->first();
                $data->form_tonase_akhir = $no_form;
                $data->penerima_tonase_akhir = $request->penerima_tonase_akhir;
                $data->tanggal_keluar = $request->tanggal_keluar;
                $data->jam_keluar = $request->jam_keluar;
                $data->tonase_akhir = $request->tonase_akhir;
                $data->created_at_tonase_akhir = date('Y-m-d H:i:s');
                $data->hasil_akhir_tonase = $request->hasil_akhir_tonase;
                $data->netto2 = $request->hasil_akhir_tonase;
                $data->update();

                $data = Lab2GabahBasah::where('lab2_kode_po_gb', $request->penerimaan_kode_po)->first();
                $data->plan_berat_kg_pertruk_gb = $request->plan_berat_kg_pertruk;
                $data->plan_berat_pk_pertruk_gb = $request->plan_berat_pk_pertruk;
                $data->plan_berat_beras_pertruk_gb = $request->plan_berat_beras_pertruk;
                $data->plan_total_harga_gabah_pertruk_gb = $request->plan_total_harga_gabah_pertruk;
                $data->plan_total_harga_pk_pertruk_gb = $request->plan_total_harga_pk_pertruk;
                $data->plan_total_harga_beras_pertruk_gb = $request->plan_total_harga_beras_pertruk;
                $data->update();

                return response()->json($data);
            }
        }

        // return redirect()->back();
    }
    public function total_tonase(Request $request)
    {
        // dd($request->all());
        if (request()->ajax()) {

            if (!empty($request->mulai_date)) {
                $data_utara = DB::table('data_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->join('penerimaan_po', 'data_po.id_data_po', '=', 'penerimaan_po.penerimaan_id_data_po')
                    ->whereBetween('data_po.tanggal_po', array($request->mulai_date, $request->akhir_date))
                    ->where('data_qc_bongkar.tempat_bongkar', 'UTARA')
                    ->select(DB::raw("data_po.tanggal_po, SUM(netto2) as total_tonase"))
                    ->get();
                $data_selatan = DB::table('data_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->join('penerimaan_po', 'data_po.id_data_po', '=', 'penerimaan_po.penerimaan_id_data_po')
                    ->whereBetween('data_po.tanggal_po', array($request->mulai_date, $request->akhir_date))
                    ->where('data_qc_bongkar.tempat_bongkar', 'SELATAN')
                    ->select(DB::raw("data_po.tanggal_po, SUM(netto2) as total_tonase"))
                    ->get();
                $variable = array(
                    'data_utara' => $data_utara,
                    'data_selatan' => $data_selatan
                );
                return json_encode($variable);
            } else {
                $data_utara = $request->mulai_date . $request->akhir_date;
                $data_selatan = $request->mulai_date . $request->akhir_date;
                $variable = array(
                    'data_utara' => $data_utara,
                    'data_selatan' => $data_selatan
                );
                dd($variable);
                return json_encode($variable);
            }
        }
    }
    public function data_timbangan_akhir()
    {
        return view('dashboard.admin_master.admin_timbangan.data_timbangan_akhir');
    }

    public function data_timbangan_akhir_gb_ciherang_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('data_qc_bongkar.status_bongkar', 'FINISH')
                    ->where('bid.name_bid', '=', 'GABAH BASAH CIHERANG')
                    ->where('penerimaan_po.tonase_akhir', '!=', NULL)
                    ->orderBy('id_penerimaan_po', 'desc')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = $list->tonase_awal . '/Kg';
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = $list->tonase_akhir . '/Kg';
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = $list->tonase_akhir . '/Kg';
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase . '/Kg';
                        return $result;
                    })
                    ->addColumn('rafraksi', function ($list) {
                        $result = $list->rafraksi;
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        return
                            '<a style="margin:2px;" href="' . route('timbangan.cetak_penerimaanpo2', ['id' => $list->id_penerimaan_po]) . '" target="_blank" title="Print Data" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-print">&nbsp;Cetak&nbsp;Penerimaan</i>
            </a>';
                    })
                    ->rawColumns(['kode_po', 'nama_vendor', 'plat_kendaraan', 'name_bid', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'rafraksi', 'ckelola'])
                    ->make(true);
            } else {
                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->where('data_qc_bongkar.status_bongkar', 'FINISH')
                    ->where('bid.name_bid', '=', 'GABAH BASAH CIHERANG')
                    ->where('penerimaan_po.tonase_akhir', '!=', NULL)
                    ->orderBy('id_penerimaan_po', 'desc')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
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
                        $result = tonase($list->hasil_akhir_tonase);
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        return
                            '<a style="margin:2px;" href="' . route('timbangan.cetak_penerimaanpo2', ['id' => $list->id_penerimaan_po]) . '"target="_blank" title="Print Data" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-print">&nbsp;Cetak&nbsp;Penerimaan</i>
                </a>';
                    })
                    ->rawColumns(['kode_po', 'name_bid', 'nama_vendor', 'plat_kendaraan', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'rafraksi', 'ckelola'])
                    ->make(true);
            }
        }
    }
    public function data_timbangan_akhir_gb_longgrain_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('data_qc_bongkar.status_bongkar', 'FINISH')
                    ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
                    ->where('penerimaan_po.tonase_akhir', '!=', NULL)
                    ->orderBy('id_penerimaan_po', 'desc')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = $list->tonase_awal . '/Kg';
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = $list->tonase_akhir . '/Kg';
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = $list->tonase_akhir . '/Kg';
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase . '/Kg';
                        return $result;
                    })
                    ->addColumn('rafraksi', function ($list) {
                        $result = $list->rafraksi;
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        return
                            '<a style="margin:2px;" href="' . route('master.cetak_penerimaanpo_2', ['id' => $list->id_penerimaan_po]) . '" target="_blank" title="Print Data" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-print">&nbsp;Cetak&nbsp;Penerimaan</i>
                        </a>';
                    })
                    ->rawColumns(['kode_po', 'nama_vendor', 'plat_kendaraan', 'name_bid', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'rafraksi', 'ckelola'])
                    ->make(true);
            } else {
                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->where('data_qc_bongkar.status_bongkar', 'FINISH')
                    ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
                    ->where('penerimaan_po.tonase_akhir', '!=', NULL)
                    ->orderBy('id_penerimaan_po', 'desc')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return '
                        <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
                        ';
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
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
                        $result = tonase($list->hasil_akhir_tonase);
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        return
                            '<a style="margin:2px;" href="' . route('master.cetak_penerimaanpo_2', ['id' => $list->id_penerimaan_po]) . '"target="_blank" title="Print Data" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-print">&nbsp;Cetak&nbsp;Penerimaan</i>
                </a>';
                    })
                    ->rawColumns(['kode_po', 'name_bid', 'nama_vendor', 'plat_kendaraan', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'rafraksi', 'ckelola'])
                    ->make(true);
            }
        }
    }
    public function data_timbangan_akhir_gb_pandan_wangi_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('data_qc_bongkar.status_bongkar', 'FINISH')
                    ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
                    ->where('penerimaan_po.tonase_akhir', '!=', NULL)
                    ->orderBy('id_penerimaan_po', 'desc')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return '
                    <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
                    ';
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = $list->tonase_awal . '/Kg';
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = $list->tonase_akhir . '/Kg';
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = $list->tonase_akhir . '/Kg';
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase . '/Kg';
                        return $result;
                    })
                    ->addColumn('rafraksi', function ($list) {
                        $result = $list->rafraksi;
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        return
                            '<a style="margin:2px;" href="' . route('master.cetak_penerimaanpo_2', ['id' => $list->id_penerimaan_po]) . '" target="_blank" title="Print Data" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-print">&nbsp;Cetak&nbsp;Penerimaan</i>
                         </a>';
                    })
                    ->rawColumns(['kode_po', 'nama_vendor', 'plat_kendaraan', 'name_bid', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'rafraksi', 'ckelola'])
                    ->make(true);
            } else {
                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->where('data_qc_bongkar.status_bongkar', 'FINISH')
                    ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
                    ->where('penerimaan_po.tonase_akhir', '!=', NULL)
                    ->orderBy('id_penerimaan_po', 'desc')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
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
                        $result = tonase($list->hasil_akhir_tonase);
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        return
                            '<a style="margin:2px;" href="' . route('master.cetak_penerimaanpo_2', ['id' => $list->id_penerimaan_po]) . '"target="_blank" title="Print Data" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-print">&nbsp;Cetak&nbsp;Penerimaan</i>
                </a>';
                    })
                    ->rawColumns(['kode_po', 'name_bid', 'nama_vendor', 'plat_kendaraan', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'rafraksi', 'ckelola'])
                    ->make(true);
            }
        }
    }
    public function data_timbangan_akhir_gb_ketan_putih_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('data_qc_bongkar.status_bongkar', 'FINISH')
                    ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
                    ->where('penerimaan_po.tonase_akhir', '!=', NULL)
                    ->orderBy('id_penerimaan_po', 'desc')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = $list->tonase_awal . '/Kg';
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = $list->tonase_akhir . '/Kg';
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = $list->tonase_akhir . '/Kg';
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase . '/Kg';
                        return $result;
                    })
                    ->addColumn('rafraksi', function ($list) {
                        $result = $list->rafraksi;
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        return
                            '<a style="margin:2px;" href="' . route('master.cetak_penerimaanpo_2', ['id' => $list->id_penerimaan_po]) . '" target="_blank" title="Print Data" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-print">&nbsp;Cetak&nbsp;Penerimaan</i>
            </a>';
                    })
                    ->rawColumns(['kode_po', 'nama_vendor', 'plat_kendaraan', 'name_bid', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'rafraksi', 'ckelola'])
                    ->make(true);
            } else {
                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->where('data_qc_bongkar.status_bongkar', 'FINISH')
                    ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
                    ->where('penerimaan_po.tonase_akhir', '!=', NULL)
                    ->orderBy('id_penerimaan_po', 'desc')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
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
                        $result = tonase($list->hasil_akhir_tonase);
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        return
                            '<a style="margin:2px;" href="' . route('master.cetak_penerimaanpo_2', ['id' => $list->id_penerimaan_po]) . '"target="_blank" title="Print Data" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-print">&nbsp;Cetak&nbsp;Penerimaan</i>
                </a>';
                    })
                    ->rawColumns(['kode_po', 'name_bid', 'nama_vendor', 'plat_kendaraan', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'rafraksi', 'ckelola'])
                    ->make(true);
            }
        }
    }
    public function data_timbangan_akhir_pk_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('data_qc_bongkar.status_bongkar', 'FINISH')
                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->where('penerimaan_po.tonase_akhir', '!=', NULL)
                    ->orderBy('id_penerimaan_po', 'desc')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return '
                <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
                ';
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = $list->tonase_awal . '/Kg';
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = $list->tonase_akhir . '/Kg';
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = $list->tonase_akhir . '/Kg';
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase . '/Kg';
                        return $result;
                    })
                    ->addColumn('rafraksi', function ($list) {
                        $result = $list->rafraksi;
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        return
                            '<a style="margin:2px;" href="' . route('master.cetak_penerimaanpo2_pk', ['id' => $list->id_penerimaan_po]) . '" target="_blank" title="Print Data" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-print">&nbsp;Cetak&nbsp;Penerimaan</i>
                    </a>';
                    })
                    ->rawColumns(['kode_po', 'nama_vendor', 'plat_kendaraan', 'name_bid', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'rafraksi', 'ckelola'])
                    ->make(true);
            } else {
                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->where('data_qc_bongkar.status_bongkar', 'FINISH')
                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->where('penerimaan_po.tonase_akhir', '!=', NULL)
                    ->orderBy('id_penerimaan_po', 'desc')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = $list->tonase_awal . '/Kg';
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = $list->tonase_akhir . '/Kg';
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = $list->tonase_akhir . '/Kg';
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase . '/Kg';
                        return $result;
                    })
                    ->addColumn('rafraksi', function ($list) {
                        $result = $list->rafraksi;
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        return
                            '<a style="margin:2px;" href="' . route('master.cetak_penerimaanpo2_pk', ['id' => $list->id_penerimaan_po]) . '" target="_blank" title="Print Data" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-print">&nbsp;Cetak&nbsp;Penerimaan</i>
                </a>';
                    })
                    ->rawColumns(['kode_po', 'name_bid', 'nama_vendor', 'plat_kendaraan', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'rafraksi', 'ckelola'])
                    ->make(true);
            }
        }
    }
    public function data_revisi_timbangan()
    {
        return view('dashboard.admin_master.admin_timbangan.data_revisi_timbangan');
    }

    public function data_revisi_timbangan_longgrain_index(Request $request)
    {

        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->where('penerimaan_po.tonase_akhir', '!=', NULL)
            ->where('penerimaan_po.analisa', 'revisi')
            ->where('penerimaan_po.id_adminanalisa', 2)
            ->where('penerimaan_po.status_analisa', 2)
            ->where('penerimaan_po.status_revisi', 0)
            ->where('bid.name_bid', 'GABAH BASAH LONG GRAIN')
            ->orderBy('penerimaan_po.id_penerimaan_po', 'desc')
            ->get())
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
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
                $result = tonase($list->hasil_akhir_tonase);
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_analisa == 2) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Revisi Data" class="to_show btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Revisi&nbsp;Data  
                    </a>';
                } else {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Revisi Data" class="to_show btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Revisi&nbsp;Data  
                    </a>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'plat_kendaraan', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'ckelola'])
            ->make(true);
    }
    public function data_revisi_timbangan_ciherang_index(Request $request)
    {

        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->where('penerimaan_po.tonase_akhir', '!=', NULL)
            ->where('penerimaan_po.analisa', 'revisi')
            ->where('penerimaan_po.id_adminanalisa', 2)
            ->where('penerimaan_po.status_analisa', 2)
            ->where('penerimaan_po.status_revisi', 0)
            ->where('bid.name_bid', 'GABAH BASAH CIHERANG')
            ->orderBy('penerimaan_po.id_penerimaan_po', 'desc')
            ->get())
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
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
                $result = tonase($list->hasil_akhir_tonase);
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_analisa == 2) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Revisi Data" class="to_show btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Revisi&nbsp;Data  
                    </a>';
                } else {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Revisi Data" class="to_show btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Revisi&nbsp;Data  
                    </a>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'plat_kendaraan', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'ckelola'])
            ->make(true);
    }
    public function data_revisi_timbangan_pandan_wangi_index(Request $request)
    {

        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->where('penerimaan_po.tonase_akhir', '!=', NULL)
            ->where('penerimaan_po.analisa', 'revisi')
            ->where('penerimaan_po.id_adminanalisa', 2)
            ->where('penerimaan_po.status_analisa', 2)
            ->where('penerimaan_po.status_revisi', 0)
            ->where('bid.name_bid', 'GABAH BASAH PANDAN WANGI')
            ->orderBy('penerimaan_po.id_penerimaan_po', 'desc')
            ->get())
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
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
                $result = tonase($list->hasil_akhir_tonase);
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_analisa == 2) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Revisi Data" class="to_show btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Revisi&nbsp;Data  
                    </a>';
                } else {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Revisi Data" class="to_show btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Revisi&nbsp;Data  
                    </a>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'plat_kendaraan', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'ckelola'])
            ->make(true);
    }
    public function data_revisi_timbangan_ketan_putih_index(Request $request)
    {

        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->where('penerimaan_po.tonase_akhir', '!=', NULL)
            ->where('penerimaan_po.analisa', 'revisi')
            ->where('penerimaan_po.id_adminanalisa', 2)
            ->where('penerimaan_po.status_analisa', 2)
            ->where('penerimaan_po.status_revisi', 0)
            ->where('bid.name_bid', 'GABAH BASAH KETAN PUTIH')
            ->orderBy('penerimaan_po.id_penerimaan_po', 'desc')
            ->get())
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
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
                $result = tonase($list->hasil_akhir_tonase);
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_analisa == 2) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Revisi Data" class="to_show btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Revisi&nbsp;Data  
                    </a>';
                } else {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Revisi Data" class="to_show btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Revisi&nbsp;Data  
                    </a>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'plat_kendaraan', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'ckelola'])
            ->make(true);
    }
    public function show_timbangan_revisi($id)
    {
        $show_data = DB::table('penerimaan_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'penerimaan_po.penerimaan_kode_po')
            ->where('penerimaan_po.id_penerimaan_po', $id)
            ->first();
        return json_encode($show_data);
    }
    public function revisi_timbangan_update(Request $request)
    {
        $data = FinishingQCGb::where('lab2_kode_po_gb', $request->penerimaan_kode_po)->first();
        $data->plan_berat_kg_pertruk_gb = $request->plan_berat_kg_pertruk;
        $data->plan_berat_pk_pertruk_gb = $request->plan_berat_pk_pertruk;
        $data->plan_berat_beras_pertruk_gb = $request->plan_berat_beras_pertruk;
        $data->plan_total_harga_gabah_pertruk_gb = $request->plan_total_harga_gabah_pertruk;
        $data->plan_total_harga_pk_pertruk_gb = $request->plan_total_harga_pk_pertruk;
        $data->plan_total_harga_beras_pertruk_gb = $request->plan_total_harga_beras_pertruk;
        $data->update();

        $data = PenerimaanPO::where('id_penerimaan_po', $request->id_penerimaan_po)->first();
        $data->tonase_awal = $request->bruto;
        $data->tonase_akhir = $request->tara;
        $data->hasil_akhir_tonase = $request->netto;
        $data->netto2 = $request->netto;
        $data->status_revisi = 1;
        $data->update();

        $log                               = new LogAktivityTimbangan();
        $log->nama_user                    = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_timbangan = $request->id_penerimaan_po;
        $log->aktivitas_timbangan          = 'Insert Revisi Tonase. Kode PO:' . $request->penerimaan_kode_po . ' Hasil Tonase : ' . $request->netto;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();
        return response()->json($data);
    }
    public function timbangan_akhir_gb_ciherang_index()
    {
        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins_timbangan', 'admins_timbangan.id_admin_timbangan', '=', 'penerimaan_po.penerima_tonase_awal')
            ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
            ->where('data_qc_bongkar.status_bongkar', 'FINISH')
            ->where('bid.name_bid', '=', 'GABAH BASAH CIHERANG')
            ->where('penerimaan_po.tonase_akhir', '=', NULL)
            ->orderBy('id_penerimaan_po', 'asc')->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = $list->open_po;
                return $result;
            })
            ->addColumn('tonase_awal', function ($list) {
                $result = $list->tonase_awal . '/Kg';
                return $result;
            })
            ->addColumn('tonase_akhir', function ($list) {
                $result = $list->tonase_akhir . '/Kg';
                return $result;
            })
            ->addColumn('tonase_akhir', function ($list) {
                $result = $list->tonase_akhir . '/Kg';
                return $result;
            })
            ->addColumn('hasil_akhir_tonase', function ($list) {
                $result = $list->hasil_akhir_tonase . '/Kg';
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Proses Final Tonnase" class="to_show_timbangan2 btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner"></i>Proses&nbsp;Timbangan&nbsp;2 <br> (Proses Lab 2)
                    </a>';
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'plat_kendaraan', 'name_bid', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'ckelola'])
            ->make(true);
    }
    public function timbangan_akhir_gb_longgrain_index()
    {
        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
            ->where('penerimaan_po.tonase_akhir', '=', NULL)
            ->where('data_qc_bongkar.status_bongkar', 'FINISH')
            ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
            ->orderBy('id_penerimaan_po', 'asc')->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = $list->open_po;
                return $result;
            })
            ->addColumn('tonase_awal', function ($list) {
                $result = tonase($list->tonase_awal);
                return $result;
            })
            ->addColumn('tonase_akhir', function ($list) {
                $result = $list->tonase_akhir . '/Kg';
                return $result;
            })
            ->addColumn('tonase_akhir', function ($list) {
                $result = $list->tonase_akhir . '/Kg';
                return $result;
            })
            ->addColumn('hasil_akhir_tonase', function ($list) {
                $result = $list->hasil_akhir_tonase . '/Kg';
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Proses Final Tonnase" class="to_show_timbangan2 btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner"></i>Proses&nbsp;Timbangan&nbsp;2 <br> (Proses Lab 2)
                    </a>';
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'plat_kendaraan', 'name_bid', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'ckelola'])
            ->make(true);
    }
    public function timbangan_akhir_gb_pandan_wangi_index()
    {
        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins_timbangan', 'admins_timbangan.id_admin_timbangan', '=', 'penerimaan_po.penerima_tonase_awal')
            ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
            ->where('data_qc_bongkar.status_bongkar', 'FINISH')
            ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
            ->where('penerimaan_po.tonase_akhir', '=', NULL)
            ->orderBy('id_penerimaan_po', 'asc')->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = $list->open_po;
                return $result;
            })
            ->addColumn('tonase_awal', function ($list) {
                $result = $list->tonase_awal . '/Kg';
                return $result;
            })
            ->addColumn('tonase_akhir', function ($list) {
                $result = $list->tonase_akhir . '/Kg';
                return $result;
            })
            ->addColumn('tonase_akhir', function ($list) {
                $result = $list->tonase_akhir . '/Kg';
                return $result;
            })
            ->addColumn('hasil_akhir_tonase', function ($list) {
                $result = $list->hasil_akhir_tonase . '/Kg';
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Proses Final Tonnase" class="to_show_timbangan2 btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner"></i>Proses&nbsp;Timbangan&nbsp;2 <br> (Proses Lab 2)
                    </a>';
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'plat_kendaraan', 'name_bid', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'ckelola'])
            ->make(true);
    }
    public function timbangan_akhir_gb_ketan_putih_index()
    {
        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins_timbangan', 'admins_timbangan.id_admin_timbangan', '=', 'penerimaan_po.penerima_tonase_awal')
            ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
            ->where('data_qc_bongkar.status_bongkar', 'FINISH')
            ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
            ->where('penerimaan_po.tonase_akhir', '=', NULL)
            ->orderBy('id_penerimaan_po', 'asc')->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = $list->open_po;
                return $result;
            })
            ->addColumn('tonase_awal', function ($list) {
                $result = $list->tonase_awal . '/Kg';
                return $result;
            })
            ->addColumn('tonase_akhir', function ($list) {
                $result = $list->tonase_akhir . '/Kg';
                return $result;
            })
            ->addColumn('tonase_akhir', function ($list) {
                $result = $list->tonase_akhir . '/Kg';
                return $result;
            })
            ->addColumn('hasil_akhir_tonase', function ($list) {
                $result = $list->hasil_akhir_tonase . '/Kg';
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Proses Final Tonnase" class="to_show_timbangan2 btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner"></i>Proses&nbsp;Timbangan&nbsp;2 <br> (Proses Lab 2)
                    </a>';
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'plat_kendaraan', 'name_bid', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'ckelola'])
            ->make(true);
    }
    public function timbangan_akhir_pk_index()
    {
        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins_timbangan', 'admins_timbangan.id_admin_timbangan', '=', 'penerimaan_po.penerima_tonase_awal')
            ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
            ->where('data_qc_bongkar.status_bongkar', 'FINISH')
            ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
            ->where('penerimaan_po.tonase_akhir', '=', NULL)
            ->orderBy('id_penerimaan_po', 'asc')->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = $list->open_po;
                return $result;
            })
            ->addColumn('tonase_awal', function ($list) {
                $result = $list->tonase_awal . '/Kg';
                return $result;
            })
            ->addColumn('tonase_akhir', function ($list) {
                $result = $list->tonase_akhir . '/Kg';
                return $result;
            })
            ->addColumn('tonase_akhir', function ($list) {
                $result = $list->tonase_akhir . '/Kg';
                return $result;
            })
            ->addColumn('hasil_akhir_tonase', function ($list) {
                $result = $list->hasil_akhir_tonase . '/Kg';
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Proses Final Tonnase" class="to_show_timbangan2 btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner"></i>Proses&nbsp;Timbangan&nbsp;2 <br> (Proses Lab 2)
                    </a>';
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'plat_kendaraan', 'name_bid', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'ckelola'])
            ->make(true);
    }

    public function download_excel(Request $request)
    {
        $from_date  = $request->from_date;
        $to_date  = $request->to_date;
        return Excel::download(new DataTimbanganExportExcel($from_date, $to_date), 'Data Timbangan PT. SURYA PANGAN SEMESTA.xlsx');
    }
    public function download_penerimaan_barang_excel(Request $request)
    {
        $from_date  = $request->from_date;
        $to_date  = $request->to_date;
        // dd($from_date . '-' . $to_date);
        return Excel::download(new DataPenerimaanBarangAOL($from_date, $to_date), 'Data Penerimaan Barang PT. SURYA PANGAN SEMESTA.xlsx');
    }
    public function getcountnotif_tonaseawal()
    {
        $data = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 8)
            ->count();
        return json_encode($data);
    }
    public function getcountnotif_datatonaseawal()
    {
        $data = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins_timbangan', 'admins_timbangan.id_admin_timbangan', '=', 'penerimaan_po.penerima_tonase_awal')
            ->where('penerimaan_po.status_penerimaan', '>', 8)
            ->where('penerimaan_po.tonase_akhir', NULL)
            ->count();
        return json_encode($data);
    }
    public function getcountnotif_tonaseakhir()
    {
        $data = DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
            ->where('penerimaan_po.tonase_akhir', '=', NULL)
            ->where('data_qc_bongkar.status_bongkar', 'FINISH')
            ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
            ->count();
        return json_encode($data);
    }
    public function getcountnotif_datatonaseakhir()
    {
        $data = DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
            ->where('data_qc_bongkar.status_bongkar', 'FINISH')
            ->where('penerimaan_po.tonase_akhir', '!=', NULL)
            ->count();
        return json_encode($data);
    }
    public function getcountnotif_revisitonase()
    {
        $data = DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->where('penerimaan_po.tonase_akhir', '!=', NULL)
            ->where('penerimaan_po.analisa', 'revisi')
            ->where('penerimaan_po.id_adminanalisa', 2)
            ->where('penerimaan_po.status_analisa', 2)
            ->where('penerimaan_po.status_revisi', 0)
            ->count();
        return json_encode($data);
    }
    public function get_notifikasitimbangan()
    {
        $data = Notif::where('status', 0)->where('kategori', '3')->get();
        return json_encode($data);
    }
    public function get_countnotifikasitimbangan()
    {
        $data = Notif::where('status', 0)->where('kategori', '3')->count();
        return json_encode($data);
    }

    public function set_notifikasitimbangan(request $request)
    {
        $id = $request->id;
        Notif::where('id_notifikasi', $id)->update(['status' => 1]);
        return redirect()->route('timbangan.data_revisi_timbangan');
    }

    public function new_notifikasitimbangan()
    {
        $data = Notif::where('notifbaru', 0)->get();
        Notif::where('notifbaru', 0)->update(['notifbaru' => 1]);
        return json_encode($data);
    }

    // LOG ACTIVITY ADMIN TIMBANGAN
    public function log_activity_timbangan()
    {
        return view('dashboard.admin_master.admin_timbangan.log_activity_timbangan ');
    }

    public function log_activity_timbangan_index()
    {
        return Datatables::of(DB::table('log_aktivitas_timbangan')
            ->orderby('id_aktivitas_timbangan', 'desc')
            ->get())
            ->addColumn('keterangan_aktivitas', function ($list) {
                $result = '<span class="badge bg-success">' . $list->keterangan_aktivitas . '</span>';
                return $result;
            })
            ->addColumn('tanggal', function ($list) {
                $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y H:m:s');
                return $result;
            })
            ->rawColumns(['tanggal', 'keterangan_aktivitas'])
            ->make(true);
    }

    // ADMIN QC BONGKAR


    // ADMIN SPV QC



    // ADMIN QC


    // ADMIN SECURITY



    // ADMIN SOURCHING 



    // LOG USER
    public function log_activity_user()
    {
        return view('dashboard.admin_master.log_activity_user ');
    }

    public function log_activity_user_index()
    {
        return Datatables::of(DB::table('log_aktivitas_user')
            ->orderby('id_aktivitas_user', 'desc')
            ->get())
            ->addColumn('keterangan_aktivitas', function ($list) {
                $result = '<span class="badge bg-success">' . $list->keterangan_aktivitas . '</span>';
                return $result;
            })
            ->addColumn('tanggal', function ($list) {
                $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y H:m:s');
                return $result;
            })
            ->rawColumns(['tanggal', 'keterangan_aktivitas'])
            ->make(true);
    }
}
