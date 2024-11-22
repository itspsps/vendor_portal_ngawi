<?php

namespace App\Http\Controllers\AdminQcBongkar;

use App\Http\Controllers\Controller;
use App\Models\DataPO;
use Illuminate\Http\Request;
use DataTables;
use App\Models\PenerimaanPO;
use App\Models\Notif;
use App\Models\QcAdminBongkar;
use App\Models\DataQcBongkar;
use App\Models\Lab1GabahBasah;
use App\Models\Lab1Pecahkulit;
use App\Models\Lab2GabahBasah;
use App\Models\LogAktivityQc;
use App\Models\NotifBongkar;
use App\Models\NotifLab;
use App\Models\NotifTimbangan;
use App\Models\trackerPO;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class QcAdminBongkarController extends Controller
{

    public function check(Request $request)
    {
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $array = $request->username;
        // $oke = json_encode($array);
        // dd($array);
        if ($fieldType == "username") {
            $data = QcAdminBongkar::where('username', $array)->first();
        } else {
            $data = QcAdminBongkar::where('email', $array)->first();
        }
        if (Auth::guard('bongkar')->attempt(array($fieldType => $request->username, 'password' => $request->password))) {
            Alert::success('Berhasil', 'Selamat Datang ' . $data->name_qc_bongkar);
            return redirect()->route('qc.bongkar.home')->with('Berhasil', 'Selamat Datang ' . $data->name_qc_bongkar);
        } else {
            Alert::error('Gagal', 'Masukkan Email Atau Password Dengan Benar');
            return redirect()->route('qc.bongkar.login')->with('Gagal', 'Masukkan Email Atau Password Dengan Benar');
        }
    }


    public function home()
    {
        return view('dashboard.admin_qc_bongkar.home');
    }
    public function data_antrian_bongkar_pandan_wangi_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('lab1_gb', 'lab1_gb.lab1_kode_po_gb', '=', 'data_po.kode_po')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('lab1_gb.status_lab1_gb', '7')
            ->where('bid.name_bid', 'GABAH BASAH PANDAN WANGI')
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
                $result = $list->open_po;
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = $list->waktu_penerimaan;
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
            ->addColumn('antrian', function ($list) {
                $result = $list->no_antrian;
                return
                    '<a title="Informasi" class="toyakin btn btn-outline-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
            })

            ->addColumn('ckelola', function ($list) {
                return
                    '<button style="margin:2px;" id="btn_panggil_gb" data-id="' . $list->id_penerimaan_po . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Panggil Truk" class="toyakin btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-phone"> </i> Panggil&nbsp;Truk</button>';
            })
            ->rawColumns(['kode_po', 'antrian', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'antrian1', 'lokasi_bongkar', 'ckelola'])
            ->make(true);
    }
    public function data_antrian_bongkar_ketan_putih_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('lab1_gb', 'lab1_gb.lab1_kode_po_gb', '=', 'data_po.kode_po')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 7)
            ->where('bid.name_bid', 'GABAH BASAH KETAN PUTIH')

            // ->orderBy('id_data_po', 'desc')
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
                $result = $list->open_po;
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = $list->waktu_penerimaan;
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
            ->addColumn('antrian', function ($list) {
                $result = $list->no_antrian;
                return
                    '<a title="Informasi" class="toyakin btn btn-outline-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
            })

            ->addColumn('ckelola', function ($list) {
                return
                    '<button style="margin:2px;" id="btn_panggil_gb" data-id="' . $list->id_penerimaan_po . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Panggil Truk" class="toyakin btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-phone"> </i> Panggil&nbsp;Truk</button>';
            })
            ->rawColumns(['kode_po', 'antrian', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'antrian1', 'lokasi_bongkar', 'ckelola'])
            ->make(true);
    }
    public function data_antrian_bongkar_longgrain_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('lab1_gb', 'lab1_gb.lab1_kode_po_gb', '=', 'data_po.kode_po')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 7)
            ->where('bid.name_bid', 'GABAH BASAH LONG GRAIN')

            // ->orderBy('id_data_po', 'desc')
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
                $result = $list->open_po;
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = $list->waktu_penerimaan;
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
            ->addColumn('antrian', function ($list) {
                $result = $list->no_antrian;
                return
                    '<a title="Informasi" class="toyakin btn btn-outline-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
            })

            ->addColumn('ckelola', function ($list) {
                return
                    '<button style="margin:2px;" id="btn_panggil_gb" data-id="' . $list->id_penerimaan_po . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Panggil Truk" class="toyakin btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-phone"> </i> Panggil&nbsp;Truk</button>';
            })
            ->rawColumns(['kode_po', 'antrian', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'antrian1', 'lokasi_bongkar', 'ckelola'])
            ->make(true);
    }
    public function data_antrian_bongkar_pk_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('lab1_pk', 'lab1_pk.lab1_kode_po_pk', '=', 'data_po.kode_po')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 7)
            ->where('lab1_pk.output_lab_pk', 'Unload')
            ->orderBy('lab1_pk.id_lab1_pk', 'asc')
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
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
            ->addColumn('antrian', function ($list) {
                $result = $list->no_antrian;
                return $result;
            })
            ->addColumn('lokasi_bongkar', function ($list) {
                $result = $list->lokasi_bongkar_pk;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return '
                <button id="btn_panggil_pk" style="margin:2px;" data-id="' . $list->id_penerimaan_po . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Panggil Truk" onclick="return true" class="toyakin btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-phone"> </i>Panggil&nbsp;Truk
                </button>';
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'antrian', 'lokasi_bongkar', 'ckelola'])
            ->make(true);
    }
    public function antrian_qc_longgrain_index()
    {
        // $data =DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
        //     ->join('users', 'users.id', '=', 'data_po.user_idbid')
        //     ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
        //     ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
        //     ->join('lab1_gb', 'lab1_gb.lab1_kode_po_gb', '=', 'data_po.kode_po')
        //     ->where('lab1_gb.status_lab1_gb', '!=', 'Pending')
        //     ->where('lab1_gb.status_lab1_gb', '=', '9')
        //     ->get();
        // dd($data);
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab1_gb', 'lab1_gb.lab1_kode_po_gb', '=', 'data_po.kode_po')
            ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
            ->where('lab1_gb.status_lab1_gb', '=', '9')
            ->get())
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
                return $result;
            })
            ->addColumn('antrian_bongkar', function ($list) {
                $result = $list->no_antrian;
                return '<a style="margin:2px;"  title="Informasi" class="btn btn-outline-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
            })
            ->addColumn('status', function ($list) {
                $result = $list->output_lab_gb;
                if ($result == 'Unload') {
                    return  '<span class="btn-outline btn-sm" style="background-color:green;color:white"> ' . $result . ' </span>';
                }
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->output_lab_gb == 'Unload') {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_qc_bongkar" title="Data Bongkar" class="to_qc_bongkar_gb btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Proses&nbsp;Bongkar
                    </a>';
                } elseif ($list->output_lab_gb == 'Pending') {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_qc_pending" title="Data Pending" class="to_qc_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Menunggu&nbsp;Konfirmasi
                    </a>';
                }
            })
            ->addColumn('kadar_air', function ($list) {
                $result = $list->kadar_air_gb;
                return $result;
            })
            ->addColumn('ka_kg', function ($list) {
                $result = $list->ka_kg_gb;
                return $result;
            })
            ->addColumn('berat_sample_awal_ks', function ($list) {
                $result = $list->berat_sample_awal_ks_gb;
                return $result;
            })
            ->addColumn('berat_sample_awal_kg', function ($list) {
                $result = $list->berat_sample_awal_kg_gb;
                return $result;
            })
            ->addColumn('berat_sample_akhir_kg', function ($list) {
                $result = $list->berat_sample_akhir_kg_gb;
                return $result;
            })
            ->addColumn('berat_sample_pk', function ($list) {
                $result = $list->berat_sample_pk_gb;
                return $result;
            })
            ->addColumn('randoman', function ($list) {
                $result = $list->randoman_gb;
                return $result;
            })
            ->addColumn('wh', function ($list) {
                $result = $list->wh_gb;
                return $result;
            })
            ->addColumn('tp', function ($list) {
                $result = $list->tp_gb;
                return $result;
            })
            ->addColumn('md', function ($list) {
                $result = $list->md_gb;
                return $result;
            })
            ->addColumn('broken', function ($list) {
                $result = $list->broken_gb;
                return $result;
            })
            ->rawColumns(['waktu_penerimaan', 'antrian_bongkar', 'lokasi_bongkar', 'status', 'plat_kendaraan', 'tanggal_po', 'kode_po', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'randoman', 'wh', 'tp', 'md', 'broken'])
            ->make(true);
    }
    public function antrian_qc_pandan_wangi_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab1_gb', 'lab1_gb.lab1_kode_po_gb', '=', 'data_po.kode_po')
            ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
            ->where('lab1_gb.status_lab1_gb', '=', '9')
            ->get())
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
                return $result;
            })
            ->addColumn('antrian_bongkar', function ($list) {
                $result = $list->no_antrian;
                return $result;
            })
            ->addColumn('lokasi_bongkar', function ($list) {
                $result = $list->lokasi_bongkar_gb;
                return $result;
            })
            ->addColumn('status', function ($list) {
                $result = $list->output_lab_gb;
                if ($result == 'Unload') {
                    return  '<span class="btn-outline btn-sm" style="background-color:green;color:white"> ' . $result . ' </span>';
                }
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->output_lab_gb == 'Unload') {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_qc_bongkar" title="Data Bongkar" class="to_qc_bongkar_gb btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Proses&nbsp;Bongkar
                    </a>';
                } elseif ($list->output_lab_gb == 'Pending') {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_qc_pending" title="Data Pending" class="to_qc_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Menunggu&nbsp;Konfirmasi
                    </a>';
                }
            })
            ->addColumn('kadar_air', function ($list) {
                $result = $list->kadar_air_gb;
                return $result;
            })
            ->addColumn('ka_kg', function ($list) {
                $result = $list->ka_kg_gb;
                return $result;
            })
            ->addColumn('berat_sample_awal_ks', function ($list) {
                $result = $list->berat_sample_awal_ks_gb;
                return $result;
            })
            ->addColumn('berat_sample_awal_kg', function ($list) {
                $result = $list->berat_sample_awal_kg_gb;
                return $result;
            })
            ->addColumn('berat_sample_akhir_kg', function ($list) {
                $result = $list->berat_sample_akhir_kg_gb;
                return $result;
            })
            ->addColumn('berat_sample_pk', function ($list) {
                $result = $list->berat_sample_pk_gb;
                return $result;
            })
            ->addColumn('randoman', function ($list) {
                $result = $list->randoman_gb;
                return $result;
            })
            ->addColumn('wh', function ($list) {
                $result = $list->wh_gb;
                return $result;
            })
            ->addColumn('tp', function ($list) {
                $result = $list->tp_gb;
                return $result;
            })
            ->addColumn('md', function ($list) {
                $result = $list->md_gb;
                return $result;
            })
            ->addColumn('broken', function ($list) {
                $result = $list->broken_gb;
                return $result;
            })
            ->rawColumns(['waktu_penerimaan', 'antrian_bongkar', 'lokasi_bongkar', 'status', 'plat_kendaraan', 'tanggal_po', 'kode_po', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'randoman', 'wh', 'tp', 'md', 'broken'])
            ->make(true);
    }
    public function antrian_qc_ketan_putih_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab1_gb', 'lab1_gb.lab1_kode_po_gb', '=', 'data_po.kode_po')
            ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
            ->where('lab1_gb.status_lab1_gb', '=', '9')
            ->get())
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
                return $result;
            })
            ->addColumn('antrian_bongkar', function ($list) {
                $result = $list->no_antrian;
                return $result;
            })
            ->addColumn('lokasi_bongkar', function ($list) {
                $result = $list->lokasi_bongkar_gb;
                return $result;
            })
            ->addColumn('status', function ($list) {
                $result = $list->output_lab_gb;
                if ($result == 'Unload') {
                    return  '<span class="btn-outline btn-sm" style="background-color:green;color:white"> ' . $result . ' </span>';
                }
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->output_lab_gb == 'Unload') {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_qc_bongkar" title="Data Bongkar" class="to_qc_bongkar_gb btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Proses&nbsp;Bongkar
                    </a>';
                } elseif ($list->output_lab_gb == 'Pending') {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_qc_pending" title="Data Pending" class="to_qc_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Menunggu&nbsp;Konfirmasi
                    </a>';
                }
            })
            ->addColumn('kadar_air', function ($list) {
                $result = $list->kadar_air_gb;
                return $result;
            })
            ->addColumn('ka_kg', function ($list) {
                $result = $list->ka_kg_gb;
                return $result;
            })
            ->addColumn('berat_sample_awal_ks', function ($list) {
                $result = $list->berat_sample_awal_ks_gb;
                return $result;
            })
            ->addColumn('berat_sample_awal_kg', function ($list) {
                $result = $list->berat_sample_awal_kg_gb;
                return $result;
            })
            ->addColumn('berat_sample_akhir_kg', function ($list) {
                $result = $list->berat_sample_akhir_kg_gb;
                return $result;
            })
            ->addColumn('berat_sample_pk', function ($list) {
                $result = $list->berat_sample_pk_gb;
                return $result;
            })
            ->addColumn('randoman', function ($list) {
                $result = $list->randoman_gb;
                return $result;
            })
            ->addColumn('wh', function ($list) {
                $result = $list->wh_gb;
                return $result;
            })
            ->addColumn('tp', function ($list) {
                $result = $list->tp_gb;
                return $result;
            })
            ->addColumn('md', function ($list) {
                $result = $list->md_gb;
                return $result;
            })
            ->addColumn('broken', function ($list) {
                $result = $list->broken_gb;
                return $result;
            })
            ->rawColumns(['waktu_penerimaan', 'antrian_bongkar', 'lokasi_bongkar', 'status', 'plat_kendaraan', 'tanggal_po', 'kode_po', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'randoman', 'wh', 'tp', 'md', 'broken'])
            ->make(true);
    }
    public function antrian_qc_bongkar_pk_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab1_pk', 'lab1_pk.lab1_kode_po_pk', '=', 'data_po.kode_po')

            ->where('lab1_pk.status_lab1_pk', '!=', 'Pending')
            ->where('lab1_pk.status_lab1_pk', '=', '9')
            ->get())
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
                return $result;
            })
            ->addColumn('status', function ($list) {
                $result = $list->output_lab_pk;
                if ($result == 'Unload') {
                    return  '<span class="btn-outline btn-sm" style="background-color:green;color:white"> ' . $result . ' </span>';
                }
            })
            ->addColumn('harga', function ($list) {
                $result = $list->harga_awal_pk;
                return 'Rp. ' . $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->output_lab_pk == 'Unload') {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_qc_bongkar_pk" title="Data Bongkar" class="to_qc_bongkar_pk btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Proses&nbsp;Bongkar
                    </a>';
                } elseif ($list->output_lab_pk == 'Pending') {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_qc_pending" title="Data Pending" class="to_qc_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Menunggu&nbsp;Konfirmasi
                    </a>';
                }
            })

            ->rawColumns(['waktu_penerimaan', 'antrian_bongkar', 'lokasi_bongkar', 'status', 'plat_kendaraan', 'tanggal_po', 'kode_po', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'randoman', 'wh', 'tp', 'md', 'broken'])
            ->make(true);
    }
    public function antrian_bongkar()
    {
        $data = DB::table('surveyor')->get();
        $data1 = DB::table('surveyor')->get();
        // dd($data);
        return view('dashboard.admin_qc_bongkar.antrian_bongkar', compact('data', 'data1'));
    }

    public function data_antrian_bongkar()
    {
        $panggil = Lab1GabahBasah::where('status_lab1_gb', "7")->where('lokasi_bongkar_gb', 'UTARA')->orderBy('id_lab1_gb', 'asc')->first();
        $panggil1 = Lab1GabahBasah::where('status_lab1_gb', "7")->where('lokasi_bongkar_gb', 'SELATAN')->orderBy('id_lab1_gb', 'asc')->first();
        $panggil_pk = Lab1Pecahkulit::where('status_lab1_pk', "7")->orderBy('created_at_pk', 'asc')->first();
        // dd($panggil);
        $data_utara =DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('lab1_gb', 'lab1_gb.lab1_kode_po_gb', '=', 'data_po.kode_po')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 7)
            ->where('lab1_gb.lokasi_bongkar_gb', 'UTARA')
            ->where('lab1_gb.output_lab_gb', 'Unload')
            ->orderBy('lab1_gb.id_lab1_gb', 'asc')
            ->get();

        // dd($data_utara);
        $data_selatan =DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('lab1_gb', 'lab1_gb.lab1_kode_po_gb', '=', 'data_po.kode_po')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 7)
            ->where('lab1_gb.lokasi_bongkar_gb', 'SELATAN')
            ->where('lab1_gb.output_lab_gb', 'Unload')
            ->orderBy('lab1_gb.id_lab1_gb', 'asc')
            ->get();
        $data_pk =DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('lab1_pk', 'lab1_pk.lab1_kode_po_pk', '=', 'data_po.kode_po')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 7)
            ->where('lab1_pk.output_lab_pk', 'Unload')
            ->orderBy('lab1_pk.id_lab1_pk', 'asc')
            ->get();
        // dd($data_pk);
        $data_pending =DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('lab1_gb', 'lab1_gb.lab1_kode_po_gb', '=', 'data_po.kode_po')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 16)
            ->where('lab1_gb.lokasi_bongkar_gb', NULL)
            ->where('lab1_gb.output_lab_gb', 'Pending')
            ->orderBy('lab1_gb.id_lab1_gb', 'asc')
            ->get();
        return view('dashboard.admin_qc_bongkar.data_antrian_bongkar', ['data_utara' => $data_utara, 'data_pk' => $data_pk, 'data_selatan' => $data_selatan, 'data_pending' => $data_pending, 'panggil' => $panggil, 'panggil1' => $panggil1, 'panggil_pk' => $panggil_pk]);
    }

    public function data_antrian_bongkar_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('lab1_gb', 'lab1_gb.gabahincoming_kode_po', '=', 'data_po.kode_po')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 7)

            // ->orderBy('id_data_po', 'desc')
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
            ->addColumn('tanggal_po', function ($list) {
                $result = $list->open_po;
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = $list->waktu_penerimaan;
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
            ->addColumn('antrian', function ($list) {
                $result = $list->antrian1;
                return $result;
            })
            ->addColumn('lokasi_bongkar', function ($list) {
                $result = $list->lokasi_bongkar1;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                $a = Lab1GabahBasah::orderBy('id_lab1_gb', 'desc')->first();
                if ($list->status_penerimaan == 7) {
                    if ($a == '') {
                        return
                            '<button style="margin:2px;" id="btn_panggil" data-id="' . $list->id_penerimaan_po . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Panggil Truk" onclick="return true" class="toyakin btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-phone"> Panggil&nbsp;Truk</i> </button>';
                    } else {
                        '<button style="margin:2px;" id="btn_panggil1" data-offset="5px 5px" data-toggle="m-tooltip" title="Information"  class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-phone"> Panggil&nbsp;Truk</i> </button>';
                    }
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'antrian1', 'lokasi_bongkar', 'ckelola'])
            ->make(true);
    }

    public function data_antrian_bongkar_panggil_gb($id)
    {
        $data = PenerimaanPO::where('id_penerimaan_po', $id)->first();
        if ($data->status_penerimaan == 7) {
            $data1 = PenerimaanPO::where('id_penerimaan_po', $id)->update(['status_penerimaan' => 8]);
            $data2 =DataPO::where('kode_po', $data->penerimaan_kode_po)->update(['status_bid' => 8]);
            $data3 = Lab1GabahBasah::where('lab1_kode_po_gb', $data->penerimaan_kode_po)->update(['status_lab1_gb' => 8]);
            // return redirect()->back();
            $log                                = new LogAktivityQc();
            $log->nama_user                     = Auth::guard('bongkar')->user()->name_qc_bongkar;
            $log->id_objek_aktivitas_qc         = $id;
            $log->aktivitas_qc                  = 'Panggil Truk Berhasil. Kode PO:' . $data->penerimaan_kode_po;
            $log->keterangan_aktivitas          = 'Selesai';
            $log->created_at                    = date('Y-m-d H:i:s');
            $log->save();

            $po = trackerPO::where('kode_po_tracker', $data->penerimaan_kode_po)->first();
            $po->nama_admin_tracker  =  Auth::guard('bongkar')->user()->name_qc_bongkar;
            $po->status_po_tracker  = '8';
            $po->proses_tracker  = 'PANGGIL TRUK';
            $po->panggil_truk_tracker  = date('Y-m-d H:i:s');
            $po->update();

            //tambah notifikasi
            $notif                  = new NotifTimbangan();
            $notif->judul           = "Antrian Timbang 1";
            $notif->keterangan      = "Ada Antrian PO Timbangan Masuk, Kode PO : " . $data->penerimaan_kode_po;
            $notif->status          = 0;
            $notif->id_objek        = $id;
            $notif->notifbaru       = 0;
            $notif->kategori        = 0;
            $notif->created_at      = date('Y-m-d H:i:s');
            $notif->save();
        }
    }
    public function data_antrian_bongkar_panggil_pk($id)
    {
        $data = PenerimaanPO::where('id_penerimaan_po', $id)->first();
        // dd($data);
        if ($data->status_penerimaan == 7) {
            $data1 = PenerimaanPO::where('id_penerimaan_po', $id)->update(['status_penerimaan' => 8]);
            $data2 =DataPO::where('kode_po', $data->penerimaan_kode_po)->update(['status_bid' => 8]);
            $data3 = Lab1Pecahkulit::where('lab1_kode_po_pk', $data->penerimaan_kode_po)->update(['status_lab1_pk' => 8]);
            // return redirect()->back();
            $log                                = new LogAktivityQc();
            $log->nama_user                     = Auth::guard('bongkar')->user()->name_qc_bongkar;
            $log->id_objek_aktivitas_qc         = $id;
            $log->aktivitas_qc                  = 'Panggil Truk Berhasil. Kode PO:' . $data->penerimaan_kode_po;
            $log->keterangan_aktivitas          = 'Selesai';
            $log->created_at                    = date('Y-m-d H:i:s');
            $log->save();
        }
    }

    public function show_qc_bongkar_gb_show($id)
    {
        $show_data =DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->where('data_po.status_bid', 9)
            ->where('bid.name_bid', 'LIKE', '%GABAH BASAH%')
            ->where('id_penerimaan_po', $id)
            ->first();
        return json_encode($show_data);
    }
    public function show_qc_bongkar_pk_show($id)
    {
        $show_data =DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->where('data_po.status_bid', 9)
            ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
            ->where('bid.name_bid', '=', '')
            ->where('id_penerimaan_po', $id)
            ->first();
        return json_encode($show_data);
    }

    public function update_qc_bongkar(Request $req)
    {
        // dd($req->all());
        if (
            $req->name_bid == 'GABAH BASAH CIHERANG' || $req->name_bid == 'GABAH BASAH LONG GRAIN' || $req->name_bid == 'GABAH BASAH LONG GRAIN 50 KG' || $req->name_bid == 'GABAH BASAH LONG GRAIN JUMBO BAG' || $req->name_bid == 'GABAH BASAH PANDAN WANGI' || $req->name_bid == 'GABAH BASAH PANDAN WANGI 50 KG'
            || $req->name_bid == 'GABAH BASAH PANDAN WANGI JUMBO BAG' || $req->name_bid == 'GABAH BASAH PERA' || $req->name_bid == 'GABAH BASAH PERA 50 KG' || $req->name_bid == 'GABAH BASAH PERA JUMBO BAG' || $req->name_bid == 'GABAH BASAH KETAN PUTIH'
            || $req->name_bid == 'GABAH BASAH KETAN PUTIH 50 KG' || $req->name_bid == 'GABAH BASAH KETAN PUTIH JUMBO BAG'
        ) {
            $data                       = new DataQcBongkar();
            $data->kode_po_bongkar      = $req->penerimaan_kode_po;
            $data->no_dtm               = 'BKS.NGW-' . $req->no_dtm;
            $data->surveyor_bongkar     = $req->surveyor_bongkar;
            $data->keterangan_bongkar   = $req->keterangan;
            $data->waktu_bongkar        = $req->waktu_bongkar;
            $data->tempat_bongkar       = $req->tempat_bongkar;
            $data->z_yang_dibawa        = $req->z_yang_dibawa;
            $data->z_yang_ditolak       = $req->z_yang_ditolak;
            $data->created_at_bongkar   = date('Y-m-d H:i:s');
            $data->tanggal_bongkar       = now();
            $data->status_bongkar       = 'FINISH';
            $data->save();



            $data_penerimaan = PenerimaanPO::where('penerimaan_kode_po', $req->penerimaan_kode_po)->first();
            $data_penerimaan->status_penerimaan = 10;
            $data_penerimaan->update();

            $log                                = new LogAktivityQc();
            $log->nama_user                     = Auth::guard('bongkar')->user()->name_qc_bongkar;
            $log->id_objek_aktivitas_qc         = $data->id_penerimaan_po;
            $log->aktivitas_qc                  = 'Insert Bongkar. Kode PO:' . $req->penerimaan_kode_po . '. NO DTM  : BKS.NGW-' . $req->no_dtm;
            $log->keterangan_aktivitas          = 'Selesai';
            $log->created_at                    = date('Y-m-d H:i:s');
            $log->save();

            $po = trackerPO::where('kode_po_tracker', $req->penerimaan_kode_po)->first();
            $po->nama_admin_tracker  =  Auth::guard('bongkar')->user()->name_qc_bongkar;
            $po->status_po_tracker  = '10';
            $po->proses_tracker  = 'insert BONGKAR';
            $po->input_bongkar_tracker  = date('Y-m-d H:i:s');
            $po->update();

            $data = DataPO::where('kode_po', $req->penerimaan_kode_po)->first();
            $data->status_bid = 10;
            $data->gudang_aol = 'Driying Unit Area';
            $data->update();

            $data = Lab1GabahBasah::where('lab1_kode_po_gb', $req->penerimaan_kode_po)->first();
            $data->status_lab1_gb = 10;
            $data->lokasi_bongkar_gb = $req->tempat_bongkar;
            $data->lokasi_gt_gb = $req->tempat_bongkar;
            $data->update();
            //tambah notifikasi
            $notif   = new NotifTimbangan();
            $notif->judul           = "Timbangan Keluar";
            $notif->keterangan      = "Ada Antrian PO Timbangan Keluar, Kode PO : " . $req->penerimaan_kode_po;
            $notif->status          = 0;
            $notif->id_objek        = $data_penerimaan->id_penerimaan_po;
            $notif->notifbaru       = 0;
            $notif->kategori        = 1;
            $notif->created_at      = date('Y-m-d H:i:s');
            $notif->save();
            //tambah notifikasi
            $notif   = new NotifLab();
            $notif->judul           = "Antrian Lab Bongkaran";
            $notif->keterangan      = "Ada Antrian PO Lab Bongkar, Kode PO : " . $req->penerimaan_kode_po;
            $notif->status          = 0;
            $notif->id_objek        = $data_penerimaan->id_penerimaan_po;
            $notif->notifbaru       = 0;
            $notif->kategori        = 3;
            $notif->created_at      = date('Y-m-d H:i:s');
            $notif->save();
        } else if (
            $req->name_bid == 'GABAH KERING LONG GRAIN' || $req->name_bid == 'GABAH KERING LONG GRAIN 50 KG' || $req->name_bid == 'GABAH KERING LONG GRAIN JUMBO BAG' || $req->name_bid == 'GABAH KERING PANDAN WANGI' || $req->name_bid == 'GABAH KERING PANDAN WANGI 50 KG'
            || $req->name_bid == 'GABAH KERING PANDAN WANGI JUMBO BAG' || $req->name_bid == 'GABAH KERING PERA' || $req->name_bid == 'GABAH KERING PERA 50 KG' || $req->name_bid == 'GABAH KERING PERA JUMBO BAG' || $req->name_bid == 'GABAH KERING KETAN PUTIH'
            || $req->name_bid == 'GABAH KERING KETAN PUTIH 50 KG' || $req->name_bid == 'GABAH KERING KETAN PUTIH JUMBO BAG'
        ) {
            $data                       = new DataQcBongkar();
            $data->kode_po_bongkar      = $req->penerimaan_kode_po;
            $data->no_dtm               = 'BKS.NGW-' . $req->no_dtm;
            $data->surveyor_bongkar     = $req->surveyor_bongkar;
            $data->keterangan_bongkar   = $req->keterangan;
            $data->waktu_bongkar        = $req->waktu_bongkar;
            $data->tempat_bongkar       = $req->tempat_bongkar;
            $data->z_yang_dibawa        = $req->z_yang_dibawa;
            $data->z_yang_ditolak       = $req->z_yang_ditolak;
            $data->tanggal_bongkar       = now();
            $data->created_at_bongkar       = date('Y-m-d H:i:s');
            $data->status_bongkar       = 'FINISH';
            $data->save();

            $data = PenerimaanPO::where('penerimaan_kode_po', $req->penerimaan_kode_po)->first();
            $data->status_penerimaan = 10;
            $data->update();

            $data = DataPO::where('kode_po', $req->penerimaan_kode_po)->first();
            $data->status_bid = 10;
            $data->update();

            $data = Lab1GabahBasah::where('lab1_kode_po_gk', $req->penerimaan_kode_po)->first();
            $data->status_lab1_gk = 10;
            $data->lokasi_bongkar_gk = $req->tempat_bongkar;
            $data->lokasi_gt_gk = $req->tempat_bongkar;
            $data->update();
        } else if (
            $req->name_bid == 'BERAS PECAH KULIT LONG GRAIN' || $req->name_bid == 'BERAS PECAH KULIT' || $req->name_bid == 'BERAS PECAH KULIT LONG GRAIN 50 KG' || $req->name_bid == 'BERAS PECAH KULIT LONG GRAIN JUMBO BAG' || $req->name_bid == 'BERAS PECAH KULIT PANDAN WANGI' || $req->name_bid == 'BERAS PECAH KULIT PANDAN WANGI 50 KG'
            || $req->name_bid == 'BERAS PECAH KULIT PANDAN WANGI JUMBO BAG' || $req->name_bid == 'BERAS PECAH KULIT PERA' || $req->name_bid == 'BERAS PECAH KULIT PERA 50 KG' || $req->name_bid == 'BERAS PECAH KULIT PERA JUMBO BAG' || $req->name_bid == 'BERAS PECAH KULIT KETAN PUTIH'
            || $req->name_bid == 'BERAS PECAH KULIT KETAN PUTIH 50 KG' || $req->name_bid == 'BERAS PECAH KULIT KETAN PUTIH JUMBO BAG'
        ) {
            $data                       = new DataQcBongkar();
            $data->kode_po_bongkar      = $req->penerimaan_kode_po;
            $data->no_dtm               = 'BKS.NGW-' . $req->no_dtm;
            $data->surveyor_bongkar     = $req->surveyor_bongkar;
            $data->keterangan_bongkar   = $req->keterangan;
            $data->waktu_bongkar        = $req->waktu_bongkar;
            $data->tempat_bongkar       = $req->tempat_bongkar;
            $data->z_yang_dibawa        = $req->z_yang_dibawa;
            $data->z_yang_ditolak       = $req->z_yang_ditolak;
            $data->tanggal_bongkar      = now();
            $data->created_at_bongkar   = date('Y-m-d H:i:s');
            $data->status_bongkar       = 'FINISH';
            $data->save();

            $data = PenerimaanPO::where('penerimaan_kode_po', $req->penerimaan_kode_po)->first();
            $data->status_penerimaan = 10;
            $data->update();

            $data = DataPO::where('kode_po', $req->penerimaan_kode_po)->first();
            $data->status_bid = 10;
            $data->update();

            $data = Lab1GabahBasah::where('lab1_kode_po_pk', $req->penerimaan_kode_po)->first();
            $data->status_lab1_pk = 10;
            $data->lokasi_bongkar_pk = $req->tempat_bongkar;
            $data->lokasi_gt_pk = $req->tempat_bongkar;
            $data->update();
        } else {
            $data                       = new DataQcBongkar();
            $data->kode_po_bongkar      = $req->penerimaan_kode_po;
            $data->no_dtm               = $req->no_dtm;
            $data->surveyor_bongkar     = $req->surveyor_bongkar;
            $data->keterangan_bongkar   = $req->keterangan;
            $data->waktu_bongkar        = $req->waktu_bongkar;
            $data->tempat_bongkar       = $req->tempat_bongkar;
            $data->z_yang_dibawa        = $req->z_yang_dibawa;
            $data->z_yang_ditolak       = $req->z_yang_ditolak;
            $data->tanggal_bongkar       = now();
            $data->created_at_bongkar       = date('Y-m-d H:i:s');
            $data->status_bongkar       = 'FINISH';
            $data->save();

            $data = PenerimaanPO::where('penerimaan_kode_po', $req->penerimaan_kode_po)->first();
            $data->status_penerimaan = 10;
            $data->update();

            $data = DataPO::where('kode_po', $req->penerimaan_kode_po)->first();
            $data->status_bid = 10;
            $data->update();

            $data = Lab1GabahBasah::where('lab1_kode_po_ds', $req->penerimaan_kode_po)->first();
            $data->status_lab1_ds = 10;
            $data->lokasi_bongkar_ds = $req->tempat_bongkar;
            $data->lokasi_gt_ds = $req->tempat_bongkar;
            $data->update();
        }

        return response()->json($data);
    }

    public function data_bongkar()
    {
        return view('dashboard.admin_qc_bongkar.data_bongkar');
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
    public function data_revisi_gb()
    {
        return view('dashboard.admin_qc_bongkar.data_revisi_gb');
    }
    public function update_dtm(Request $request)
    {
        $data = DataQcBongkar::where('kode_po_bongkar', $request->penerimaan_kode_po)
            ->update([
                'no_dtm' => $request->dtm_gb,
            ]);
        $data =Lab2GabahBasah::where('lab2_kode_po_gb', $request->penerimaan_kode_po)
            ->update([
                'dtm_gb' => $request->dtm_gb,
            ]);
        $data = PenerimaanPO::where('id_penerimaan_po', $request->id_penerimaan_po)
            ->update([
                'status_revisi' => '1',
            ]);

        $log                                = new LogAktivityQc();
        $log->nama_user                     = Auth::guard('bongkar')->user()->name_qc_bongkar;
        $log->id_objek_aktivitas_qc         = $request->id_penerimaan_po;
        $log->aktivitas_qc                  = 'Revisi BKS DTM. Kode PO:' . $request->penerimaan_kode_po . '. NO DTM  : BKS.NGW-' . $request->dtm_gb;
        $log->keterangan_aktivitas          = 'Selesai';
        $log->created_at                    = date('Y-m-d H:i:s');
        $log->save();

        $po = trackerPO::where('kode_po_tracker', $request->penerimaan_kode_po)->first();
        $po->nama_admin_tracker  = Auth::guard('bongkar')->user()->name_qc_bongkar;
        $po->revisi_po_tracker  = date('Y-m-d H:i:s');
        $po->proses_tracker  = 'REVISI UPDATE BKS';
        $po->approve_revisi_spvap_tracker  = NULL;
        $po->approve_tolak_revisi_spvap_tracker  = NULL;
        $po->pengajuan_revisi_ap_tracker  = NULL;
        $po->approve_spvap_tracker  = NULL;
        $po->tolak_approve_spvap_tracker  = NULL;
        $po->update();
        return json_encode($data);
    }
    public function show_revisi_gb($id)
    {
        $data = PenerimaanPO::join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', 'penerimaan_po.penerimaan_kode_po')
            ->where('penerimaan_po.id_penerimaan_po', $id)->first();
        return json_encode($data);
    }
    public function data_revisi_gb_longgrain_index()
    {
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->where('penerimaan_po.id_adminanalisa', '3')
            ->where('penerimaan_po.status_analisa', '2')
            ->where('penerimaan_po.status_revisi', '0')
            ->where('penerimaan_po.analisa', 'revisi')
            ->where('bid.name_bid', 'GABAH BASAH LONG GRAIN')
            ->orderBy('lab2_gb.id_lab2_gb', 'asc')
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
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
            ->addColumn('antrian', function ($list) {
                $result = $list->no_antrian;
                return $result;
            })
            ->addColumn('lokasi_bongkar', function ($list) {
                $result = $list->lokasi_bongkar_gb;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_qc_bongkar" title="Data Revisi" class="to_revisibongkar btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Revisi&nbsp;Data
                    </button>';
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'antrian', 'lokasi_bongkar', 'ckelola'])
            ->make(true);
    }
    public function data_revisi_gb_ciherang_index()
    {
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->where('penerimaan_po.id_adminanalisa', '3')
            ->where('penerimaan_po.status_analisa', '2')
            ->where('penerimaan_po.status_revisi', '0')
            ->where('penerimaan_po.analisa', 'revisi')
            ->where('bid.name_bid', 'GABAH BASAH CIHERANG')
            ->orderBy('lab2_gb.id_lab2_gb', 'asc')
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
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
            ->addColumn('antrian', function ($list) {
                $result = $list->no_antrian;
                return $result;
            })
            ->addColumn('lokasi_bongkar', function ($list) {
                $result = $list->lokasi_bongkar_gb;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_qc_bongkar" title="Data Revisi" class="to_revisibongkar btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Revisi&nbsp;Data
                    </button>';
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'antrian', 'lokasi_bongkar', 'ckelola'])
            ->make(true);
    }
    public function data_revisi_gb_pandan_wangi_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->where('penerimaan_po.id_adminanalisa', '3')
            ->where('penerimaan_po.status_analisa', '2')
            ->where('penerimaan_po.status_revisi', '0')
            ->where('penerimaan_po.analisa', 'revisi')
            ->where('bid.name_bid', 'GABAH BASAH PANDAN WANGI')
            ->orderBy('lab2_gb.id_lab2_gb', 'asc')
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
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
            ->addColumn('antrian', function ($list) {
                $result = $list->no_antrian;
                return $result;
            })
            ->addColumn('lokasi_bongkar', function ($list) {
                $result = $list->lokasi_bongkar_gb;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_qc_bongkar" title="Data Revisi" class="to_revisibongkar btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Revisi&nbsp;Data
                    </button>';
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'antrian', 'lokasi_bongkar', 'ckelola'])
            ->make(true);
    }
    public function data_revisi_gb_ketan_putih_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->where('penerimaan_po.id_adminanalisa', '3')
            ->where('penerimaan_po.status_analisa', '2')
            ->where('penerimaan_po.status_revisi', '0')
            ->where('penerimaan_po.analisa', 'revisi')
            ->where('bid.name_bid', 'GABAH BASAH KETAN PUTIH')
            ->orderBy('lab2_gb.id_lab2_gb', 'asc')
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
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
            ->addColumn('antrian', function ($list) {
                $result = $list->no_antrian;
                return $result;
            })
            ->addColumn('lokasi_bongkar', function ($list) {
                $result = $list->lokasi_bongkar_gb;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_qc_bongkar" title="Data Revisi" class="to_revisibongkar btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Revisi&nbsp;Data
                    </button>';
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'antrian', 'lokasi_bongkar', 'ckelola'])
            ->make(true);
    }
    public function get_notifikasibongkar()
    {
        $get_notifikasibongkar = NotifBongkar::leftJoin('penerimaan_po', 'penerimaan_po.id_penerimaan_po', 'notifikasi_qcbongkar.id_objek')
            ->where('notifikasi_qcbongkar.status', 0)
            ->where('notifikasi_qcbongkar.kategori', '1')
            ->select('notifikasi_qcbongkar.*', 'penerimaan_po.id_penerimaan_po', 'penerimaan_po.no_antrian')
            ->get();

        $getcountnotif_antrianbongkar = DataPO::join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
            ->where('lab1_gb.status_lab1_gb', '=', '7')
            ->count();
        $getcountnotif_antrianbongkar1 = DataPO::join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('lab1_pk', 'lab1_pk.lab1_id_data_po_pk', '=', 'data_po.id_data_po')
            ->where('lab1_pk.status_lab1_pk', '=', '7')
            ->count();
        $total_antrianbongkar = ($getcountnotif_antrianbongkar + $getcountnotif_antrianbongkar1);
        $getcountnotif_prosesbongkar =DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab1_gb', 'lab1_gb.lab1_kode_po_gb', '=', 'data_po.kode_po')
            ->where('lab1_gb.status_lab1_gb', '=', '9')
            ->count();
        $getcountnotif_prosesbongkar1 = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab1_pk', 'lab1_pk.lab1_kode_po_pk', '=', 'data_po.kode_po')
            ->where('lab1_pk.status_lab1_pk', '!=', 'Pending')
            ->where('lab1_pk.status_lab1_pk', '=', '9')
            ->count();
        $total_prosesbongkar = ($getcountnotif_prosesbongkar + $getcountnotif_prosesbongkar1);
        $getcountnotif_databongkar = DataQcBongkar::join('data_po', 'data_po.kode_po', '=', 'data_qc_bongkar.kode_po_bongkar')
            ->join('bid', 'data_po.bid_id', '=', 'bid.id_bid')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('bid.name_bid', 'LIKE', '%GABAH BASAH%')
            ->count();
        $getcountnotif_revisibongkar =DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->where('penerimaan_po.id_adminanalisa', '3')
            ->where('penerimaan_po.status_analisa', '2')
            ->where('penerimaan_po.status_revisi', '0')
            ->where('penerimaan_po.analisa', 'revisi')
            ->count();
        $result = ['get_notifikasibongkar' => $get_notifikasibongkar, 'total_antrianbongkar' => $total_antrianbongkar, 'total_prosesbongkar' => $total_prosesbongkar, 'getcountnotif_databongkar' => $getcountnotif_databongkar, 'getcountnotif_revisibongkar' => $getcountnotif_revisibongkar];
        return response()->json($result);
    }


    public function set_notifikasibongkar(request $request)
    {
        $id = $request->id;
        $query = NotifBongkar::where('id_notif', $id)->first();
        $query->status = '1';
        $query->update();

        if ($query->kategori == '0') {
            return redirect()->route('qc.bongkar.data_antrian_bongkar');
        } elseif ($query->kategori == '1') {
            return redirect()->route('qc.bongkar.antrian_bongkar');
        }
    }

    public function new_notifikasibongkar()
    {
        $data = NotifBongkar::where('notifbaru', 0)->first();
        if($data==''||$data==NULL){
            return 'kosong';
        }else{

            $title = $data->judul;
            $keterangan = $data->keterangan;
            NotifBongkar::where('notifbaru', 0)->update(['notifbaru' => 1]);
            $result = ['data' => $data, 'title' => $title, 'keterangan' => $keterangan];
            return response()->json($result);
        }
    }

    function update_newnotifbongkar()
    {
        $data = NotifBongkar::where('notifbaru', 0)->update(['notifbaru' => 1]);
        return json_encode($data);
    }
    function bongkar_logout()
    {
        Auth::guard('bongkar')->logout();
        return redirect()->route('qc.bongkar.login');
    }
}
