<?php

namespace App\Http\Controllers\AdminTimbangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\PenerimaanPO;
use App\Models\DataPO;
use App\Models\AdminTimbangan;
use App\Models\Admin;
use App\Models\GabahIncomingQC;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\DataTables\DataTimbangan;
use App\Exports\DataPenerimaanBarangAOL;
use App\Exports\DataTimbanganExportExcel;
use App\Exports\DataTimbanganExportPDF;
use App\Models\FinishingQCGb;
use App\Models\Lab1GabahBasah;
use App\Models\Lab2GabahBasah;
use App\Models\Lab1Pecahkulit;
use App\Models\LogAktivityTimbangan;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use PDF;
use Carbon\Carbon;
use App\Models\Notif;
use App\Models\NotifBongkar;
use App\Models\NotifTimbangan;
use App\Models\trackerPO;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminTimbanganController extends Controller
{
    public function account_timbangan()
    {
        $id = Auth::guard('timbangan')->user()->id_admin_timbangan;
        $data = AdminTimbangan::where('id_admin_timbangan', $id)->first();
        // dd($data);
        return view('dashboard.admin_timbangan.dt_account', ['data' => $data]);
    }
    public function account_update(Request $request)
    {
        //dd($request->all());
        $data = AdminTimbangan::where('id_admin_timbangan', $request->id)->first();
        $data->name_admin_timbangan = $request->name_timbangan;
        $data->username = $request->username_timbangan;
        $data->email = $request->email_timbangan;
        $data->password_show = $request->password;
        $data->password = Hash::make($request['password']);
        $data->perusahaan = $request->company_timbangan;
        $data->updated_at = $request->updated_at;
        $data->update();
        return response()->json($data);
    }
    function check(Request $request)
    {
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $array = $request->username;
        // $oke = json_encode($array);
        // dd($array);
        if ($fieldType == "username") {
            $data = AdminTimbangan::where('username', $array)->first();
        } else {
            $data = AdminTimbangan::where('email', $array)->first();
        }
        if (Auth::guard('timbangan')->attempt(array($fieldType => $request->username, 'password' => $request->password))) {
            Alert::success('Berhasil', 'Selamat Datang ' . $data->name_admin_timbangan);
            return redirect()->route('timbangan.home')->with('Berhasil', 'Selamat Datang ' . $data->name_admin_timbangan);
        } else {
            Alert::error('Gagal', 'Masukkan Email Atau Password Dengan Benar');
            return redirect()->route('timbangan.login')->with('Gagal', 'Masukkan Email Atau Password Dengan Benar');
        }
    }

    public function home()
    {
        return view('dashboard.admin_timbangan.home');
    }

    public function timbangan_awal()
    {
        return view('dashboard.admin_timbangan.timbangan_awal');
    }

    public function timbangan_awal_gb_ciherang_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                if ($list->status_bid == 8) {
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

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                if ($list->status_bid == 8) {
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

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                if ($list->status_bid == 8) {
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

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                if ($list->status_bid == 8) {
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

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                if ($list->status_bid == 8) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="to_show btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Initial Tonnage
                </a>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'name_bid', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'ckelola'])
            ->make(true);
    }
    function timbangan_logout()
    {
        Auth::guard('timbangan')->logout();
        Alert::success('Sukses', 'Anda Berhasil Logout');
        return redirect()->route('timbangan.login')->with('Sukses', 'Anda Berhasil Logout');
    }


    public function show_antrian_timbangan_masuk($id)
    {
        $show_data = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->where('data_po.status_bid', 8)
            ->where('id_penerimaan_po', $id)
            ->first();
        return json_encode($show_data);
    }

    public function data_timbangan_awal()
    {
        return view('dashboard.admin_timbangan.data_timbangan_awal');
    }

    public function data_timbangan_awal_gb_ciherang_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        $data->penerima_tonase_awal         = $request->penerima_tonase_awal;
        $data->plat_kendaraan               = Str::upper($request->plat_kendaraan);
        $data->keterangan_penerimaan_po     = $request->asal_gabah;
        $data->tanggal_masuk                = $request->tanggal_masuk;
        $data->jam_masuk                    = $request->jam_masuk;
        $data->created_at_tonase_awal       = date('Y-m-d H:i:s');
        $data->tonase_awal                  = $request->tonase_awal;
        $data->status_penerimaan            = 9;
        $data->update();

        $log                               = new LogAktivityTimbangan();
        $log->nama_user                    = Auth::guard('timbangan')->user()->name_admin_timbangan;
        $log->id_objek_aktivitas_timbangan = $request->id_penerimaan_po;
        $log->aktivitas_timbangan          = 'Insert Tonase Awal. Kode PO: ' . $request->penerimaan_kode_po . ' Tonase Awal : ' . tonase($request->tonase_awal);
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();

        $data_po = DataPO::where('id_data_po', $request->penerimaan_id_data_po)->first();
        $data_po->nopol =  Str::upper($request->plat_kendaraan);
        $data_po->status_bid = 9;
        $data_po->update();

        $po = trackerPO::where('kode_po_tracker', $request->penerimaan_kode_po)->first();
        if ($po == NULL) {
        } else {
            $po->nama_admin_tracker  = Auth::guard('timbangan')->user()->name_admin_timbangan;
            $po->status_po_tracker  = '9';
            $po->proses_tracker  = 'insert TIMBANGAN AWAL';
            $po->timbangan_awal_tracker  = date('Y-m-d H:i:s');
            $po->update();
        }

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
        //tambah notifikasi
        $notif   = new NotifBongkar();
        $notif->judul           = "PO Input Bongkar";
        $notif->keterangan      = "Ada PO Input Bongkar, Kode PO : " . $request->penerimaan_kode_po . ' , Nopol : ' . Str::upper($request->plat_kendaraan);
        $notif->status          = 0;
        $notif->id_objek        = $request->id_penerimaan_po;
        $notif->notifbaru       = 0;
        $notif->kategori        = 1;
        $notif->created_at      = date('Y-m-d H:i:s');
        $notif->save();
        return response()->json($data);
    }


    public function timbangan_akhir()
    {
        return view('dashboard.admin_timbangan.timbangan_akhir');
    }

    public function show_timbangan_akhir($id)
    {
        $show_data = PenerimaanPO::join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'penerimaan_po.penerimaan_kode_po')
            ->where('id_penerimaan_po', $id)
            ->count();
        // dd($show_data);
        if ($show_data == '0') {
            $data = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                ->join('users', 'users.id', '=', 'data_po.user_idbid')
                ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                ->where('id_penerimaan_po', $id)
                ->first();
        } else {
            $data = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        $params = PenerimaanPO::join('data_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'user_idbid')
            ->join('lab1_gb', 'lab1_gb.lab1_id_penerimaan_po_gb', '=', 'penerimaan_po.id_penerimaan_po')
            ->join('data_qc_bongkar', 'penerimaan_po.penerimaan_kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
            ->where('penerimaan_po.id_penerimaan_po', $id)
            ->first();
        $data = PenerimaanPO::join('data_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
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
        // return view('dashboard.admin_timbangan.cetak_penerimaanpo2', ['data' => $data, 'get_item' => $get_item, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa,]);
        $data = PDF::loadview('dashboard.admin_timbangan.cetak_penerimaanpo', ['data' => $data, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa, 'get_item' => $get_item]);
        return $data->stream('CETAK ' . $params->no_dtm . ' pdf');
    }
    public function cetak_penerimaanpo_pk($id)
    {
        $params = PenerimaanPO::join('data_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'user_idbid')
            ->join('lab1_pk', 'lab1_pk.lab1_id_penerimaan_po_pk', '=', 'penerimaan_po.id_penerimaan_po')
            ->join('data_qc_bongkar', 'penerimaan_po.penerimaan_kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
            ->where('penerimaan_po.id_penerimaan_po', $id)
            ->first();
        $data = PenerimaanPO::join('data_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
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
        // return view('dashboard.admin_timbangan.cetak_penerimaanpo2', ['data' => $data, 'get_item' => $get_item, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa,]);
        $data = PDF::loadview('dashboard.admin_timbangan.cetak_penerimaanpo_pk', ['data' => $data, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa, 'get_item' => $get_item]);
        return $data->stream('CETAK ' . $params->no_dtm . ' pdf');
    }
    public function cetak_penerimaanpo_2($id)
    {
        $params = PenerimaanPO::join('data_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'user_idbid')
            ->join('lab1_gb', 'lab1_gb.lab1_id_penerimaan_po_gb', '=', 'penerimaan_po.id_penerimaan_po')
            ->join('data_qc_bongkar', 'penerimaan_po.penerimaan_kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
            ->where('penerimaan_po.id_penerimaan_po', $id)
            ->first();
        $data = PenerimaanPO::join('data_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
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
        // return view('dashboard.admin_timbangan.cetak_penerimaanpo2', ['data' => $data, 'get_item' => $get_item, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa,]);
        $data = PDF::loadview('dashboard.admin_timbangan.cetak_penerimaanpo2', ['data' => $data, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa, 'get_item' => $get_item]);
        return $data->stream('CETAK ' . $params->no_dtm . ' pdf');
    }
    public function cetak_penerimaanpo2_pk($id)
    {
        $params = PenerimaanPO::join('data_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'user_idbid')
            ->join('lab1_pk', 'lab1_pk.lab1_id_penerimaan_po_pk', '=', 'penerimaan_po.id_penerimaan_po')
            ->join('data_qc_bongkar', 'penerimaan_po.penerimaan_kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
            ->where('penerimaan_po.id_penerimaan_po', $id)
            ->first();
        $data = PenerimaanPO::join('data_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
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
        // return view('dashboard.admin_timbangan.cetak_penerimaanpo2', ['data' => $data, 'get_item' => $get_item, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa,]);
        $data = PDF::loadview('dashboard.admin_timbangan.cetak_penerimaanpo2_pk', ['data' => $data, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa, 'get_item' => $get_item]);
        return $data->stream('CETAK ' . $params->no_dtm . ' pdf');
    }
    public function terima_tonase_akhir(Request $request)
    {
        $tgl_po = \Carbon\Carbon::parse($request->tanggal_po)->format('m.y');
        $hitung = PenerimaanPO::where('status_penerimaan', '!=', '16')
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
                $data->tonase_awal = $request->tonase_awal;
                $data->tonase_akhir = $request->tonase_akhir;
                $data->created_at_tonase_akhir = date('Y-m-d H:i:s');
                $data->hasil_akhir_tonase = $request->hasil_akhir_tonase;
                $data->netto2 = $request->hasil_akhir_tonase;
                $data->update();

                $log                               = new LogAktivityTimbangan();
                $log->nama_user                    = Auth::guard('timbangan')->user()->name_admin_timbangan;
                $log->id_objek_aktivitas_timbangan = $request->id_penerimaan_po;
                $log->aktivitas_timbangan          = 'Insert Tonase Akhir. Kode PO: ' . $data->penerimaan_kode_po . ' Tonase Awal : ' . $request->tonase_awal . ' Tonase Akhir : ' . tonase($request->tonase_akhir) . ' Hasil Tonase : ' . tonase($request->hasil_akhir_tonase);
                $log->keterangan_aktivitas         = 'Selesai';
                $log->created_at                   = date('Y-m-d H:i:s');
                $log->save();

                $po = trackerPO::where('kode_po_tracker', $data->penerimaan_kode_po)->first();
                if ($po == NULL) {
                } else {
                    $po->nama_admin_tracker  = Auth::guard('timbangan')->user()->name_admin_timbangan;
                    $po->timbangan_akhir_tracker  = date('Y-m-d H:i:s');
                    $po->proses_tracker  = 'insert TONASE AKHIR';
                    $po->update();
                }
                return response()->json($data);
            } else {
                $data = PenerimaanPO::where('id_penerimaan_po', $request->id_penerimaan_po)->first();
                $data->form_tonase_akhir = $no_form;
                $data->penerima_tonase_akhir = $request->penerima_tonase_akhir;
                $data->tanggal_keluar = $request->tanggal_keluar;
                $data->jam_keluar = $request->jam_keluar;
                $data->tonase_awal = $request->tonase_awal;
                $data->tonase_akhir = $request->tonase_akhir;
                $data->created_at_tonase_akhir = date('Y-m-d H:i:s');
                $data->hasil_akhir_tonase = $request->hasil_akhir_tonase;
                $data->netto2 = $request->hasil_akhir_tonase;
                $data->update();

                $log                               = new LogAktivityTimbangan();
                $log->nama_user                    = Auth::guard('timbangan')->user()->name_admin_timbangan;
                $log->id_objek_aktivitas_timbangan = $request->id_penerimaan_po;
                $log->aktivitas_timbangan          = 'Insert Tonase Akhir. Kode PO:' . $data->penerimaan_kode_po . ' Tonase Awal : ' . $request->tonase_awal . ' Tonase Akhir : ' . $request->tonase_akhir . ' Hasil Tonase : ' . $request->hasil_akhir_tonase;
                $log->keterangan_aktivitas         = 'Selesai';
                $log->created_at                   = date('Y-m-d H:i:s');
                $log->save();

                $po = trackerPO::where('kode_po_tracker', $data->penerimaan_kode_po)->first();
                if ($po == NULL) {
                } else {
                    $po->nama_admin_tracker  = Auth::guard('timbangan')->user()->name_admin_timbangan;
                    $po->timbangan_akhir_tracker  = date('Y-m-d H:i:s');
                    $po->proses_tracker  = 'insert TIMBANGAN AKHIR';
                    $po->update();
                }

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
                //tambah notifikasi
                $notif   = new NotifBongkar();
                $notif->judul           = "PO Input Bongkar";
                $notif->keterangan      = "Ada PO Input Bongkar, Kode PO : " . $request->penerimaan_kode_po . ' , Nopol : ' . Str::upper($request->plat_kendaraan);
                $notif->status          = 0;
                $notif->id_objek        = $request->id_penerimaan_po;
                $notif->notifbaru       = 0;
                $notif->kategori        = 1;
                $notif->created_at      = date('Y-m-d H:i:s');
                $notif->save();
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
                $data_utara = DataPO::join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->join('penerimaan_po', 'data_po.id_data_po', '=', 'penerimaan_po.penerimaan_id_data_po')
                    ->whereBetween('data_po.tanggal_po', array($request->mulai_date, $request->akhir_date))
                    ->where('data_qc_bongkar.tempat_bongkar', 'UTARA')
                    ->select(DB::raw("data_po.tanggal_po, SUM(netto2) as total_tonase"))
                    ->get();
                $data_selatan = DataPO::join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
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
        return view('dashboard.admin_timbangan.data_timbangan_akhir');
    }

    public function data_timbangan_akhir_gb_ciherang_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                    ->addColumn('form_tonase_akhir', function ($list) {
                        $result = $list->form_tonase_akhir;
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
                            '<a style="margin:2px;" href="' . route('timbangan.cetak_penerimaanpo_2', ['id' => $list->id_penerimaan_po]) . '"target="_blank" title="Print Data" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-print">&nbsp;Cetak&nbsp;Penerimaan</i>
                </a>';
                    })
                    ->rawColumns(['kode_po', 'form_tonase_akhir', 'name_bid', 'nama_vendor', 'plat_kendaraan', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'rafraksi', 'ckelola'])
                    ->make(true);
            } else {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                    ->addColumn('form_tonase_akhir', function ($list) {
                        $result = $list->form_tonase_akhir;
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
                            '<a style="margin:2px;" href="' . route('timbangan.cetak_penerimaanpo_2', ['id' => $list->id_penerimaan_po]) . '"target="_blank" title="Print Data" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-print">&nbsp;Cetak&nbsp;Penerimaan</i>
                </a>';
                    })
                    ->rawColumns(['kode_po', 'form_tonase_akhir', 'name_bid', 'nama_vendor', 'plat_kendaraan', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'rafraksi', 'ckelola'])
                    ->make(true);
            }
        }
    }
    public function data_timbangan_akhir_gb_pandan_wangi_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                    ->addColumn('form_tonase_akhir', function ($list) {
                        $result = $list->form_tonase_akhir;
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
                            '<a style="margin:2px;" href="' . route('timbangan.cetak_penerimaanpo_2', ['id' => $list->id_penerimaan_po]) . '" target="_blank" title="Print Data" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-print">&nbsp;Cetak&nbsp;Penerimaan</i>
                         </a>';
                    })
                    ->rawColumns(['kode_po', 'form_tonase_akhir', 'nama_vendor', 'plat_kendaraan', 'name_bid', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'rafraksi', 'ckelola'])
                    ->make(true);
            } else {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                    ->addColumn('form_tonase_akhir', function ($list) {
                        $result = $list->form_tonase_akhir;
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
                            '<a style="margin:2px;" href="' . route('timbangan.cetak_penerimaanpo_2', ['id' => $list->id_penerimaan_po]) . '"target="_blank" title="Print Data" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-print">&nbsp;Cetak&nbsp;Penerimaan</i>
                </a>';
                    })
                    ->rawColumns(['kode_po', 'form_tonase_akhir', 'name_bid', 'nama_vendor', 'plat_kendaraan', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'rafraksi', 'ckelola'])
                    ->make(true);
            }
        }
    }
    public function data_timbangan_akhir_gb_ketan_putih_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                    ->addColumn('form_tonase_akhir', function ($list) {
                        $result = $list->form_tonase_akhir;
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
                            '<a style="margin:2px;" href="' . route('timbangan.cetak_penerimaanpo_2', ['id' => $list->id_penerimaan_po]) . '" target="_blank" title="Print Data" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-print">&nbsp;Cetak&nbsp;Penerimaan</i>
            </a>';
                    })
                    ->rawColumns(['kode_po', 'form_tonase_akhir', 'nama_vendor', 'plat_kendaraan', 'name_bid', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'rafraksi', 'ckelola'])
                    ->make(true);
            } else {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                    ->addColumn('form_tonase_akhir', function ($list) {
                        $result = $list->form_tonase_akhir;
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
                            '<a style="margin:2px;" href="' . route('timbangan.cetak_penerimaanpo_2', ['id' => $list->id_penerimaan_po]) . '"target="_blank" title="Print Data" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-print">&nbsp;Cetak&nbsp;Penerimaan</i>
                </a>';
                    })
                    ->rawColumns(['kode_po', 'name_bid', 'form_tonase_akhir', 'nama_vendor', 'plat_kendaraan', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'rafraksi', 'ckelola'])
                    ->make(true);
            }
        }
    }
    public function data_timbangan_akhir_pk_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                            '<a style="margin:2px;" href="' . route('timbangan.cetak_penerimaanpo2_pk', ['id' => $list->id_penerimaan_po]) . '" target="_blank" title="Print Data" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-print">&nbsp;Cetak&nbsp;Penerimaan</i>
                    </a>';
                    })
                    ->rawColumns(['kode_po', 'nama_vendor', 'plat_kendaraan', 'name_bid', 'tanggal_po', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'rafraksi', 'ckelola'])
                    ->make(true);
            } else {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                            '<a style="margin:2px;" href="' . route('timbangan.cetak_penerimaanpo2_pk', ['id' => $list->id_penerimaan_po]) . '" target="_blank" title="Print Data" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
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
        return view('dashboard.admin_timbangan.data_revisi_timbangan');
    }

    public function data_revisi_timbangan_longgrain_index(Request $request)
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        $show_data = PenerimaanPO::join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'penerimaan_po.penerimaan_kode_po')
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
        $log->nama_user                    = Auth::guard('timbangan')->user()->name_admin_timbangan;
        $log->id_objek_aktivitas_timbangan = $request->id_penerimaan_po;
        $log->aktivitas_timbangan          = 'Insert Revisi Tonase. Kode PO:' . $request->penerimaan_kode_po . ' Hasil Tonase : ' . tonase($request->netto);
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();

        $po = trackerPO::where('kode_po_tracker', $request->penerimaan_kode_po)->first();
        if ($po == NULL) {
        } else {
            $po->nama_admin_tracker  = Auth::guard('timbangan')->user()->name_admin_timbangan;
            $po->revisi_po_tracker  = date('Y-m-d H:i:s');
            $po->proses_tracker  = 'REVISI TONASE';
            $po->approve_revisi_spvap_tracker  = NULL;
            $po->approve_tolak_revisi_spvap_tracker  = NULL;
            $po->pengajuan_revisi_ap_tracker  = NULL;
            $po->approve_spvap_tracker  = NULL;
            $po->tolak_approve_spvap_tracker  = NULL;
            $po->update();
        }
        return response()->json($data);
    }
    public function timbangan_akhir_gb_ciherang_index()
    {
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        // dd($from_date . '-' . $to_date);
        return Excel::download(new DataTimbanganExportExcel($from_date, $to_date), 'Data Timbangan PT. SURYA PANGAN SEMESTA.xlsx');
    }
    public function download_penerimaan_barang_excel(Request $request)
    {
        $from_date  = $request->from_date;
        $to_date  = $request->to_date;
        // dd($from_date . '-' . $to_date);
        return Excel::download(new DataPenerimaanBarangAOL($from_date, $to_date), 'Data Penerimaan Barang PT. SURYA PANGAN SEMESTA.xlsx');
    }

    public function get_all_notifikasi()
    {
        $get_notifikasitimbangan = NotifTimbangan::where('status', 0)->orderBy('id_notif', 'DESC')->limit(10)->get();
        $getcountnotif_datatonaseawal = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins_timbangan', 'admins_timbangan.id_admin_timbangan', '=', 'penerimaan_po.penerima_tonase_awal')
            ->where('penerimaan_po.status_penerimaan', '>', 8)
            ->where('penerimaan_po.tonase_akhir', NULL)
            ->count();
        $getcountnotif_tonaseawal = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 8)
            ->count();
        $getcountnotif_tonaseakhir = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins_timbangan', 'admins_timbangan.id_admin_timbangan', '=', 'penerimaan_po.penerima_tonase_awal')
            ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
            ->where('data_qc_bongkar.status_bongkar', 'FINISH')
            ->where('penerimaan_po.tonase_akhir', '=', NULL)
            ->count();

        $getcountnotif_revisitonase = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->where('penerimaan_po.tonase_akhir', '!=', NULL)
            ->where('penerimaan_po.analisa', 'revisi')
            ->where('penerimaan_po.id_adminanalisa', 2)
            ->where('penerimaan_po.status_analisa', 2)
            ->where('penerimaan_po.status_revisi', 0)
            ->count();
        $getcountnotif_datatonaseakhir = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
            ->where('data_qc_bongkar.status_bongkar', 'FINISH')
            ->where('penerimaan_po.tonase_akhir', '!=', NULL)
            ->count();
        $result = [
            'get_notifikasitimbangan' => $get_notifikasitimbangan,
            'getcountnotif_datatonaseawal' => $getcountnotif_datatonaseawal,
            'getcountnotif_tonaseawal' => $getcountnotif_tonaseawal,
            'getcountnotif_tonaseakhir' => $getcountnotif_tonaseakhir,
            'getcountnotif_datatonaseakhir' => $getcountnotif_datatonaseakhir,
            'getcountnotif_revisitonase' => $getcountnotif_revisitonase,
        ];
        return response()->json($result);
    }
    public function get_notif_timbangan_all()
    {
        return view('dashboard.admin_timbangan.notifikasi.notifikasi');
    }
    public function get_notif_timbangan_all_index()
    {
        return Datatables::of(NotifTimbangan::where('status', 0)->orderBy('id_notif', 'DESC')->get())
            ->addColumn('keterangan', function ($list) {
                $result = $list->keterangan;
                return $result;
            })
            ->addColumn('created_at', function ($list) {
                $result_date = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y');
                $result_time = \Carbon\Carbon::parse($list->created_at)->isoFormat('HH:mm:ss ');
                $result = $result_date . '<br><span class="btn btn-sm btn-label-primary">' . $result_time . ' WIB</span>';
                return $result;
            })->rawColumns(['keterangan', 'created_at'])
            ->make(true);
    }
    public function set_notifikasitimbangan(request $request)
    {
        $id = $request->id;
        $query = NotifTimbangan::where('id_notif', $id)->first();
        $query->status = 1;
        $query->update();
        if ($query->kategori == '0') {
            return redirect()->route('timbangan.timbangan_awal');
        } elseif ($query->kategori == '1') {
            return redirect()->route('timbangan.timbangan_akhir');
        }
    }

    public function new_notifikasitimbangan()
    {
        $data = NotifTimbangan::where('notifbaru', 0)->first();
        if ($data == '' || $data == NULL) {
            return 'kosong';
        } else {

            $title = $data->judul;
            $keterangan = $data->keterangan;
            NotifTimbangan::where('notifbaru', 0)->update(['notifbaru' => 1]);
            $result = ['data' => $data, 'title' => $title, 'keterangan' => $keterangan];
            return response()->json($result);
        }
    }
}
