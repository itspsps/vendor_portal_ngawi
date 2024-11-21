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

class QcLab1Controller extends Controller
{
    public function proses_lab1_gabah_basah()
    {
        return view('dashboard.admin_qc.proses_lab1_gabah_basah');
    }

    public function proses_lab1_gabah_kering()
    {
        return view('dashboard.admin_qc.proses_lab1_gabah_kering');
    }

    public function proses_lab1_pecah_kulit()
    {
        return view('dashboard.admin_qc.proses_lab1_pecah_kulit');
    }

    public function proses_lab1_beras_ds()
    {
        return view('dashboard.admin_qc.proses_lab1_beras_ds');
    }
    public function output_proses_lab1_gb()
    {
        return view('dashboard.admin_qc.output_proses_lab1_gb');
    }

    public function output_proses_lab1_pk()
    {
        return view('dashboard.admin_qc.output_proses_lab1_pk');
    }

    public function proses_lab1_gabah_basah_ciherang_index()
    {
        // $data = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
        //     ->join('users', 'users.id', '=', 'data_po.user_idbid')
        //     ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
        //     ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
        //     ->where('data_po.status_bid', 3)
        //     ->where('bid.name_bid','LIKE', '%GABAH BASAH%')
        //     ->orderBy('penerimaan_po.waktu_penerimaan', 'asc')
        //     ->get();
        //     dd($data);
        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 3)
            ->where('bid.name_bid', 'GABAH BASAH CIHERANG')
            ->orderBy('penerimaan_po.waktu_penerimaan', 'asc')
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
            ->addColumn('keterangan_penerimaan_po', function ($list) {
                $result = $list->keterangan_penerimaan_po;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {

                return
                    '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-vendor="' . $list->nama_vendor . '" data-tanggalpo="' . $list->tanggal_po . '"  data-item="' . $list->name_bid . '"  title="Proses Data" class="proses_lab_1 btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Lab&nbsp;Process
                    </button>';
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'keterangan_penerimaan_po', 'ckelola'])
            ->make(true);
    }
    public function proses_lab1_gabah_basah_longgrain_index()
    {
        // $data = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
        //     ->join('users', 'users.id', '=', 'data_po.user_idbid')
        //     ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
        //     ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
        //     ->where('data_po.status_bid', 3)
        //     ->where('bid.name_bid','LIKE', '%GABAH BASAH%')
        //     ->orderBy('penerimaan_po.waktu_penerimaan', 'asc')
        //     ->get();
        //     dd($data);
        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 3)
            ->where('bid.name_bid', 'GABAH BASAH LONG GRAIN')
            ->where('penerimaan_po.analisa',NULL)
            ->orderBy('penerimaan_po.waktu_penerimaan', 'asc')
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
            ->addColumn('antrian', function ($list) {
                $result = $list->no_antrian;
                return '<a style="margin:2px;"  title="Informasi" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
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
                $nopol = '<span class="btn btn-label-info btn-sm " style="font-weight: bold;">'.$list->plat_kendaraan.'</span>';
                return $nopol;
            })
            ->addColumn('keterangan_penerimaan_po', function ($list) {
                $result = $list->keterangan_penerimaan_po;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {

                return
                    '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-vendor="' . $list->nama_vendor . '" data-tanggalpo="' . $list->tanggal_po . '"  data-item="' . $list->name_bid . '"  title="Proses Data" class="proses_lab_1 btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Lab&nbsp;Process
                    </button>';
            })
            ->rawColumns(['kode_po', 'antrian', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'keterangan_penerimaan_po', 'ckelola'])
            ->make(true);
    }
    public function proses_lab1_gabah_basah_pandan_wangi_index()
    {
        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 3)
            ->where('bid.name_bid', 'GABAH BASAH PANDAN WANGI')
            ->orderBy('penerimaan_po.waktu_penerimaan', 'asc')
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
            ->addColumn('antrian', function ($list) {
                $result = $list->no_antrian;
                return '<a style="margin:2px;"  title="Informasi" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
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
            ->addColumn('keterangan_penerimaan_po', function ($list) {
                $result = $list->keterangan_penerimaan_po;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {

                return
                    '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-vendor="' . $list->nama_vendor . '" data-tanggalpo="' . $list->tanggal_po . '"  data-item="' . $list->name_bid . '"  title="Proses Data" class="proses_lab_1 btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Lab&nbsp;Process
                    </button>';
            })
            ->rawColumns(['kode_po', 'antrian', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'keterangan_penerimaan_po', 'ckelola'])
            ->make(true);
    }
    public function proses_lab1_gabah_basah_ketan_putih_index()
    {
        // $data = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
        //     ->join('users', 'users.id', '=', 'data_po.user_idbid')
        //     ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
        //     ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
        //     ->where('data_po.status_bid', 3)
        //     ->where('bid.name_bid','LIKE', '%GABAH BASAH%')
        //     ->orderBy('penerimaan_po.waktu_penerimaan', 'asc')
        //     ->get();
        //     dd($data);
        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 3)
            ->where('bid.name_bid', 'GABAH BASAH KETAN PUTIH')
            ->orderBy('penerimaan_po.waktu_penerimaan', 'asc')
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
            ->addColumn('antrian', function ($list) {
                $result = $list->no_antrian;
                return '<a style="margin:2px;"  title="Informasi" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
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
            ->addColumn('keterangan_penerimaan_po', function ($list) {
                $result = $list->keterangan_penerimaan_po;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {

                return
                    '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-vendor="' . $list->nama_vendor . '" data-tanggalpo="' . $list->tanggal_po . '"  data-item="' . $list->name_bid . '"  title="Proses Data" class="proses_lab_1 btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Lab&nbsp;Process
                    </button>';
            })
            ->rawColumns(['kode_po', 'antrian', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'keterangan_penerimaan_po', 'ckelola'])
            ->make(true);
    }

    public function proses_lab1_gabah_kering_index()
    {
        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 3)
            ->where('bid.name_bid', 'LIKE', '%GABAH KERING%')
            ->orderBy('penerimaan_po.waktu_penerimaan', 'asc')
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
            ->addColumn('keterangan_penerimaan_po', function ($list) {
                $result = $list->keterangan_penerimaan_po;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                $a = DB::table('lab1_gk')->orderBy('id_lab1_gk', 'desc')->first();
                if (($a) == '') {
                    $b = DB::table('data_po')
                        ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                        ->join('users', 'users.id', '=', 'data_po.user_idbid')
                        ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                        ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                        ->where('data_po.status_bid', 3)
                        ->where('bid.name_bid', 'LIKE', '%GABAH KERING%')
                        ->orderBy('penerimaan_po.waktu_penerimaan', 'asc')
                        ->first();
                    if (($list->id_penerimaan_po) == ($b->id_penerimaan_po)) {
                        return
                            '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="proses_lab_1 btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Lab&nbsp;Process
                    </button>';
                    } else {
                        return
                            '<button style="margin:2px;" id="btn_notif2" title="Informasi" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Lab&nbsp;Process
                    </button>';
                    }
                } else if (($a->status_lab1_gk) >= '7') {
                    $b = DB::table('data_po')
                        ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                        ->join('users', 'users.id', '=', 'data_po.user_idbid')
                        ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                        ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                        ->where('data_po.status_bid', 3)
                        ->where('bid.name_bid', 'LIKE', '%GABAH KERING%')
                        ->orderBy('penerimaan_po.waktu_penerimaan', 'asc')
                        ->first();
                    if (($list->id_penerimaan_po) == ($b->id_penerimaan_po)) {
                        return
                            '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '"   title="Edit Data" class="proses_lab_1 btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Lab&nbsp;Process
                    </button>';
                    } else {
                        return
                            '<button style="margin:2px;" id="btn_notif2" title="Informasi" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Lab&nbsp;Process
                    </button>';
                    }
                } else {
                    return
                        '<button style="margin:2px;" id="btn_notif"  title="Selesaikan Di Output Lab Dahulu" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Lab&nbsp;Process
                    </button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'keterangan_penerimaan_po', 'ckelola'])
            ->make(true);
    }

    public function proses_lab1_pecah_kulit_index()
    {
        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 3)
            ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
            ->orderBy('penerimaan_po.waktu_penerimaan', 'asc')
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
            ->addColumn('keterangan_penerimaan_po', function ($list) {
                $result = $list->keterangan_penerimaan_po;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="proses_lab_1 btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                Lab&nbsp;Process
            </button>';
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'keterangan_penerimaan_po', 'ckelola'])
            ->make(true);
    }

    public function proses_lab1_beras_ds_index()
    {
        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 3)
            ->where('bid.name_bid', 'LIKE', '%BERAS DS%')
            ->orderBy('penerimaan_po.waktu_penerimaan', 'asc')
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
            ->addColumn('keterangan_penerimaan_po', function ($list) {
                $result = $list->keterangan_penerimaan_po;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                $a = DB::table('lab1_ds')->orderBy('id_lab1_ds', 'desc')->first();
                if (($a) == '') {
                    $b = DB::table('data_po')
                        ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                        ->join('users', 'users.id', '=', 'data_po.user_idbid')
                        ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                        ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                        ->where('data_po.status_bid', 3)
                        ->where('bid.lokasi', "NGAWI")
                        ->where('bid.name_bid', 'LIKE', '%BERAS DS%')
                        ->orderBy('penerimaan_po.waktu_penerimaan', 'asc')
                        ->first();
                    if (($list->id_penerimaan_po) == ($b->id_penerimaan_po)) {
                        return
                            '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="proses_lab_1 btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Lab&nbsp;Process
                    </button>';
                    } else {
                        return
                            '<button style="margin:2px;" id="btn_notif2" title="Informasi" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Lab&nbsp;Process
                    </button>';
                    }
                } else if (($a->status_lab1_ds) >= '7') {
                    $b = DB::table('data_po')
                        ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                        ->join('users', 'users.id', '=', 'data_po.user_idbid')
                        ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                        ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                        ->where('data_po.status_bid', 3)
                        ->where('bid.lokasi', "NGAWI")
                        ->where('bid.name_bid', 'LIKE', '%BERAS DS%')
                        ->orderBy('penerimaan_po.waktu_penerimaan', 'asc')
                        ->first();
                    if (($list->id_penerimaan_po) == ($b->id_penerimaan_po)) {
                        return
                            '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '"   title="Edit Data" class="proses_lab_1 btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Lab&nbsp;Process
                    </button>';
                    } else {
                        return
                            '<button style="margin:2px;" id="btn_notif2" title="Informasi" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Lab&nbsp;Process
                    </button>';
                    }
                } else {
                    return
                        '<button style="margin:2px;" id="btn_notif"  title="Selesaikan Di Output Lab Dahulu" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Lab&nbsp;Process
                    </button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'keterangan_penerimaan_po', 'ckelola'])
            ->make(true);
    }
    public function output_lab1_gb_pandan_wangi_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
                    ->where('penerimaan_po.status_penerimaan', '>=', 5)
                    ->where('bid.name_bid', 'GABAH BASAH PANDAN WANGI')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->orderBy('penerimaan_po.id_penerimaan_po', 'DESC')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
                    ->addColumn('antrian', function ($list) {
                        $result = $list->no_antrian;
                        return '<a style="margin:2px;"  title="Informasi" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    ' . $result . '
                    </a>';
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('lokasi_bongkar', function ($list) {
                        $result = $list->lokasi_bongkar_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola_manager', function ($list) {
                        if ($list->status_lab1_gb == 6) {
                            if ($list->status_approved == '' || $list->status_approved == 'NULL') {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                    </a>';
                                // <button class="dropdown-item" id="btn_approve_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;Approve&nbsp;Bongkar</button>
                            } else if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                        </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner"></i>&nbsp;Tolak&nbsp;Approve&nbsp;SPV 
                    </a>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                        </a>';
                            }
                        } elseif ($list->status_lab1_gb == 7) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;1 
                        </a>';
                        } elseif ($list->status_lab1_gb == 5) {
                            if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner">&nbsp;Pengajuan&nbsp;Approve&nbsp;Tolak&nbsp;SPV</i>
                        </a>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '"  title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times"></i>&nbsp;Reject
                            </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-check"></i>&nbsp;Bongkar
                            </a>';
                            }
                        } elseif ($list->status_lab1_gb == 8) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-phone"></i>&nbsp;PO&nbsp;On&nbsp;Call
                        </a>';
                        } elseif ($list->status_lab1_gb == 9) {
                            if ($list->output_lab_gb == 'Pending') {
                                return
                                    '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-question"></i> Cek&nbsp;Status
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
                                </div>
                            </div>';
                            } elseif ($list->output_lab_gb == 'Unload') {
                                return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-truck"></i>&nbsp;Proses&nbsp;Bongkar&nbsp;1
                            </a>';
                            }
                        } elseif ($list->status_lab1_gb == 10) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 11) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 12) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-credit-card"></i>&nbsp;Proses&nbsp;Pembayaran
                        </a>';
                        } elseif ($list->status_lab1_gb == 16) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-credit-card"></i>&nbsp;Pending&nbsp;Harga
                    </a>';
                        } else {
                            return
                                '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-exclamation"></i>&nbsp;Cek&nbsp;Pending
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item" href="' . route('qc.approve_lab1_gb', ['id' => $list->id_lab1_gb]) . '"  style="color:red"><i class="fas fa-check" style="color:red"></i>Bongkar</a>
                            </div>
                        </div>';
                        }
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_lab1_gb == 6) {
                            if ($list->status_approved == '' || $list->status_approved == 'NULL') {
                                return
                                    '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-question"></i> Cek&nbsp;Bongkar
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                            <button class="dropdown-item" id="btn_approve_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Bongkar</button>
                            <button id="to_edit" class="dropdown-item" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '" title="Edit Data"><i class="fas fa-edit"></i>Edit</button>
                            </div>
                            </div>';
                                // <button class="dropdown-item" id="btn_approve_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;Approve&nbsp;Bongkar</button>
                            } else if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                        </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tolak&nbsp;Approve <i class="fa fa-exclamation"></i> <br> (Cek&nbsp;Analisa&nbsp;Lab)
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                            <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '"   title="Information"><i class="fas fa-edit"></i>Cek&nbsp;Analisa</button>
                            </div>
                            </div>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                        </a>';
                            }
                        } elseif ($list->status_lab1_gb == 7) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;1 
                        </a>';
                        } elseif ($list->status_lab1_gb == 5) {
                            if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner">&nbsp;Pengajuan&nbsp;Approve&nbsp;Tolak&nbsp;SPV</i>
                        </a>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '"  title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times"></i>&nbsp;Reject
                            </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-check"></i>&nbsp;Bongkar
                            </a>';
                            } else if ($list->status_approved == 3) {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-question"></i> Cek&nbsp;Tolak
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button id="to_edit" class="dropdown-item" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '" title="Edit Data"><i class="fas fa-edit"></i>Analisa&nbsp;Ulang</button>
                        </div>
                        </div>';
                            }
                        } elseif ($list->status_lab1_gb == 8) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-phone"></i>&nbsp;PO&nbsp;On&nbsp;Call
                        </a>';
                        } elseif ($list->status_lab1_gb == 9) {
                            if ($list->output_lab_gb == 'Pending') {
                                return
                                    '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-question"></i> Cek&nbsp;Status
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
                                </div>
                            </div>';
                            } elseif ($list->output_lab_gb == 'Unload') {
                                return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-truck"></i>&nbsp;Proses&nbsp;Bongkar&nbsp;1
                            </a>';
                            }
                        } elseif ($list->status_lab1_gb == 10) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 11) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 12) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-credit-card"></i>&nbsp;Proses&nbsp;Pembayaran
                        </a>';
                        } elseif ($list->status_lab1_gb == 16) {
                            return
                                '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-exclamation"></i> Pending&nbsp;Harga <br> (Konfirmasi&nbsp;Supplier)
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '"  title="Information"><i class="fas fa-edit"></i>Edit</button>
                            </div>
                        </div>';
                        } else {
                            return
                                '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-exclamation"></i>&nbsp;Cek&nbsp;Pending
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item" href="' . route('qc.approve_lab1_gb', ['id' => $list->id_lab1_gb]) . '"  style="color:red"><i class="fas fa-check" style="color:red"></i>Bongkar</a>
                            </div>
                        </div>';
                        }
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result . '%';
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result . ' %';
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result . ' %';
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result . '%';
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result . '%';
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result . '%';
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result . '%';
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result . '%';
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result . '%';
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result . '%';
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result . '/Kg';
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result . '/Kg';
                    })

                    ->rawColumns(['waktu_penerimaan', 'antrian', 'kode_po', 'nama_vendor', 'lokasi_bongkar', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'ckelola_manager', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            } else {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
                    ->where('penerimaan_po.status_penerimaan', '>=', 5)
                    ->where('bid.name_bid', 'GABAH BASAH PANDAN WANGI')
                    ->orderBy('penerimaan_po.id_penerimaan_po', 'DESC')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
                    ->addColumn('antrian', function ($list) {
                        $result = $list->no_antrian;
                        return '<a style="margin:2px;"  title="Informasi" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('lokasi_bongkar', function ($list) {
                        $result = $list->lokasi_bongkar_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola_manager', function ($list) {
                        if ($list->status_lab1_gb == 6) {
                            if ($list->status_approved == '' || $list->status_approved == 'NULL') {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                </a>';
                                // <button class="dropdown-item" id="btn_approve_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;Approve&nbsp;Bongkar</button>
                            } else if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                    </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-spinner"></i>&nbsp;Tolak&nbsp;Approve&nbsp;SPV 
                </a>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                    </a>';
                            }
                        } elseif ($list->status_lab1_gb == 7) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;1 
                    </a>';
                        } elseif ($list->status_lab1_gb == 5) {
                            if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner">&nbsp;Pengajuan&nbsp;Approve&nbsp;Tolak&nbsp;SPV</i>
                    </a>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '"  title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-times"></i>&nbsp;Reject
                        </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check"></i>&nbsp;Bongkar
                        </a>';
                            }
                        } elseif ($list->status_lab1_gb == 8) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-phone"></i>&nbsp;PO&nbsp;On&nbsp;Call
                    </a>';
                        } elseif ($list->status_lab1_gb == 9) {
                            if ($list->output_lab_gb == 'Pending') {
                                return
                                    '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-question"></i> Cek&nbsp;Status
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
                            </div>
                        </div>';
                            } elseif ($list->output_lab_gb == 'Unload') {
                                return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-truck"></i>&nbsp;Proses&nbsp;Bongkar&nbsp;1
                        </a>';
                            }
                        } elseif ($list->status_lab1_gb == 10) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                    </a>';
                        } elseif ($list->status_lab1_gb == 11) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                    </a>';
                        } elseif ($list->status_lab1_gb == 12) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;2
                    </a>';
                        } elseif ($list->status_lab1_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-credit-card"></i>&nbsp;Proses&nbsp;Pembayaran
                    </a>';
                        } elseif ($list->status_lab1_gb == 16) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-credit-card"></i>&nbsp;Pending&nbsp;Harga
                </a>';
                        } else {
                            return
                                '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-exclamation"></i>&nbsp;Cek&nbsp;Pending
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                            <a class="dropdown-item" href="' . route('qc.approve_lab1_gb', ['id' => $list->id_lab1_gb]) . '"  style="color:red"><i class="fas fa-check" style="color:red"></i>Bongkar</a>
                        </div>
                    </div>';
                        }
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_lab1_gb == 6) {
                            if ($list->status_approved == '' || $list->status_approved == 'NULL') {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-question"></i> Cek&nbsp;Bongkar
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button class="dropdown-item" id="btn_approve_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Bongkar</button>
                        <button id="to_edit" class="dropdown-item" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '" title="Edit Data"><i class="fas fa-edit"></i>Edit</button>
                        </div>
                        </div>';
                                // <button class="dropdown-item" id="btn_approve_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;Approve&nbsp;Bongkar</button>
                            } else if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                    </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<div class="dropdown">
                    <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tolak&nbsp;Approve <i class="fa fa-exclamation"></i> <br> (Cek&nbsp;Analisa&nbsp;Lab)
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '"   title="Information"><i class="fas fa-edit"></i>Cek&nbsp;Analisa</button>
                        </div>
                        </div>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                    </a>';
                            }
                        } elseif ($list->status_lab1_gb == 7) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;1 
                    </a>';
                        } elseif ($list->status_lab1_gb == 5) {
                            if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner">&nbsp;Pengajuan&nbsp;Approve&nbsp;Tolak&nbsp;SPV</i>
                    </a>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '"  title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-times"></i>&nbsp;Reject
                        </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check"></i>&nbsp;Bongkar
                        </a>';
                            } else if ($list->status_approved == 3) {
                                return
                                    '<div class="dropdown">
                    <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-question"></i> Cek&nbsp;Tolak
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                    <button id="to_edit" class="dropdown-item" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '" title="Edit Data"><i class="fas fa-edit"></i>Analisa&nbsp;Ulang</button>
                    </div>
                    </div>';
                            }
                        } elseif ($list->status_lab1_gb == 8) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-phone"></i>&nbsp;PO&nbsp;On&nbsp;Call
                    </a>';
                        } elseif ($list->status_lab1_gb == 9) {
                            if ($list->output_lab_gb == 'Pending') {
                                return
                                    '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-question"></i> Cek&nbsp;Status
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
                            </div>
                        </div>';
                            } elseif ($list->output_lab_gb == 'Unload') {
                                return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-truck"></i>&nbsp;Proses&nbsp;Bongkar&nbsp;1
                        </a>';
                            }
                        } elseif ($list->status_lab1_gb == 10) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                    </a>';
                        } elseif ($list->status_lab1_gb == 11) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                    </a>';
                        } elseif ($list->status_lab1_gb == 12) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;2
                    </a>';
                        } elseif ($list->status_lab1_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-credit-card"></i>&nbsp;Proses&nbsp;Pembayaran
                    </a>';
                        } elseif ($list->status_lab1_gb == 16) {
                            return
                                '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-exclamation"></i> Pending&nbsp;Harga <br> (Konfirmasi&nbsp;Supplier)
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                            <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '"  title="Information"><i class="fas fa-edit"></i>Edit</button>
                        </div>
                    </div>';
                        } else {
                            return
                                '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-exclamation"></i>&nbsp;Cek&nbsp;Pending
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                            <a class="dropdown-item" href="' . route('qc.approve_lab1_gb', ['id' => $list->id_lab1_gb]) . '"  style="color:red"><i class="fas fa-check" style="color:red"></i>Bongkar</a>
                        </div>
                    </div>';
                        }
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result . '%';
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result . ' %';
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result . ' %';
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result . '%';
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result . '%';
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result . '%';
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result . '%';
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result . '%';
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result . '%';
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result . '%';
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result . '/Kg';
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result . '/Kg';
                    })

                    ->rawColumns(['waktu_penerimaan', 'antrian', 'kode_po', 'nama_vendor', 'lokasi_bongkar', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'ckelola_manager', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            }
        }
    }
    public function output_lab1_gb_longgrain_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
                    ->where('penerimaan_po.status_penerimaan', '>=', 5)
                    ->where('bid.name_bid', 'GABAH BASAH LONG GRAIN')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->orderBy('lab1_gb.created_at_gb', 'DESC')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
                    ->addColumn('antrian', function ($list) {
                        $result = $list->no_antrian;
                        return '<a style="margin:2px;"  title="Informasi" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    ' . $result . '
                    </a>';
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('lokasi_bongkar', function ($list) {
                        $result = $list->lokasi_bongkar_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola_manager', function ($list) {
                        if ($list->status_lab1_gb == 6) {
                            if ($list->status_approved == '' || $list->status_approved == 'NULL') {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                    </a>';
                                // <button class="dropdown-item" id="btn_approve_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;Approve&nbsp;Bongkar</button>
                            } else if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                        </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner"></i>&nbsp;Tolak&nbsp;Approve&nbsp;SPV 
                    </a>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                        </a>';
                            }
                        } elseif ($list->status_lab1_gb == 7) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;1 
                        </a>';
                        } elseif ($list->status_lab1_gb == 5) {
                            if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner">&nbsp;Pengajuan&nbsp;Approve&nbsp;Tolak&nbsp;SPV</i>
                        </a>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '"  title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times"></i>&nbsp;Reject
                            </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-check"></i>&nbsp;Bongkar
                            </a>';
                            }
                        } elseif ($list->status_lab1_gb == 8) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-phone"></i>&nbsp;PO&nbsp;On&nbsp;Call
                        </a>';
                        } elseif ($list->status_lab1_gb == 9) {
                            if ($list->output_lab_gb == 'Pending') {
                                return
                                    '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-question"></i> Cek&nbsp;Status
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
                                </div>
                            </div>';
                            } elseif ($list->output_lab_gb == 'Unload') {
                                return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-truck"></i>&nbsp;Proses&nbsp;Bongkar&nbsp;1
                            </a>';
                            }
                        } elseif ($list->status_lab1_gb == 10) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 11) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 12) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-credit-card"></i>&nbsp;Proses&nbsp;Pembayaran
                        </a>';
                        } elseif ($list->status_lab1_gb == 16) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-credit-card"></i>&nbsp;Pending&nbsp;Harga
                    </a>';
                        } else {
                            return
                                '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-exclamation"></i>&nbsp;Cek&nbsp;Pending
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item" href="' . route('qc.approve_lab1_gb', ['id' => $list->id_lab1_gb]) . '"  style="color:red"><i class="fas fa-check" style="color:red"></i>Bongkar</a>
                            </div>
                        </div>';
                        }
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_lab1_gb == 6) {
                            if ($list->status_approved == '' || $list->status_approved == 'NULL') {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-question"></i> Cek&nbsp;Bongkar
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button class="dropdown-item" id="btn_approve_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;Approve&nbsp;Bongkar</button>
                        <button id="to_edit" class="dropdown-item" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '" title="Edit Data"><i class="fas fa-edit"></i>Edit</button>
                        </div>
                        </div>';
                            } else if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                        </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tolak&nbsp;Approve <i class="fa fa-exclamation"></i> <br> (Cek&nbsp;Analisa&nbsp;Lab)
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                            <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '"  title="Information"><i class="fas fa-edit"></i>Cek&nbsp;Analisa</button>
                            </div>
                            </div>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                        </a>';
                            }
                        } elseif ($list->status_lab1_gb == 7) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;1 
                        </a>';
                        } elseif ($list->status_lab1_gb == 5) {
                            if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner">&nbsp;Pengajuan&nbsp;Approve&nbsp;Tolak&nbsp;SPV</i>
                        </a>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '"  title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times"></i>&nbsp;Reject
                            </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-check"></i>&nbsp;Bongkar
                            </a>';
                            } else if ($list->status_approved == 3) {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-question"></i> Cek&nbsp;Tolak
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button id="to_edit" class="dropdown-item" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '" title="Edit Data"><i class="fas fa-edit"></i>Analisa&nbsp;Ulang</button>
                        </div>
                        </div>';
                            }
                        } elseif ($list->status_lab1_gb == 8) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-phone"></i>&nbsp;PO&nbsp;On&nbsp;Call
                        </a>';
                        } elseif ($list->status_lab1_gb == 9) {
                            if ($list->output_lab_gb == 'Pending') {
                                return
                                    '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-question"></i> Cek&nbsp;Status
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-hp="' . $list->nomer_hp . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
                                </div>
                            </div>';
                            } elseif ($list->output_lab_gb == 'Unload') {
                                return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-truck"></i>&nbsp;Proses&nbsp;Bongkar&nbsp;1
                            </a>';
                            }
                        } elseif ($list->status_lab1_gb == 10) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 11) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 12) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-credit-card"></i>&nbsp;Proses&nbsp;Pembayaran
                        </a>';
                        } elseif ($list->status_lab1_gb == 16) {
                            return
                                '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-exclamation"></i> Pending&nbsp;Harga <br> (Konfirmasi&nbsp;Supplier)
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '"  title="Information"><i class="fas fa-edit"></i>Edit</button>
                            </div>
                        </div>';
                        } else {
                            return
                                '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-exclamation"></i>&nbsp;Cek&nbsp;Pending
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item" href="' . route('qc.approve_lab1_gb', ['id' => $list->id_lab1_gb]) . '"  style="color:red"><i class="fas fa-check" style="color:red"></i>Bongkar</a>
                            </div>
                        </div>';
                        }
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result . '%';
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result . ' %';
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result . ' %';
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result . '%';
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result . '%';
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result . '%';
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result . '%';
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result . '%';
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result . '%';
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result . '%';
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result . '/Kg';
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result . '/Kg';
                    })

                    ->rawColumns(['waktu_penerimaan', 'antrian', 'kode_po', 'nama_vendor', 'lokasi_bongkar', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'ckelola_manager', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            } else {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
                    ->where('penerimaan_po.status_penerimaan', '>=', 5)
                    ->where('bid.name_bid', 'GABAH BASAH LONG GRAIN')
                    ->orderBy('lab1_gb.created_at_gb', 'DESC')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
                    ->addColumn('antrian', function ($list) {
                        $result = $list->no_antrian;
                        return '<a style="margin:2px;"  title="Informasi" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    ' . $result . '
                    </a>';
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('lokasi_bongkar', function ($list) {
                        $result = $list->lokasi_bongkar_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola_manager', function ($list) {
                        if ($list->status_lab1_gb == 6) {
                            if ($list->status_approved == '' || $list->status_approved == 'NULL') {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                                </a>';
                                // <button class="dropdown-item" id="btn_approve_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;Approve&nbsp;Bongkar</button>
                            } else if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                                </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-spinner"></i>&nbsp;Tolak&nbsp;Approve&nbsp;SPV 
                                </a>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                        </a>';
                            }
                        } elseif ($list->status_lab1_gb == 7) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;1 
                        </a>';
                        } elseif ($list->status_lab1_gb == 5) {
                            if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner">&nbsp;Pengajuan&nbsp;Approve&nbsp;Tolak&nbsp;SPV</i>
                        </a>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '"  title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times"></i>&nbsp;Reject
                            </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-check"></i>&nbsp;Bongkar
                            </a>';
                            }
                        } elseif ($list->status_lab1_gb == 8) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-phone"></i>&nbsp;PO&nbsp;On&nbsp;Call
                        </a>';
                        } elseif ($list->status_lab1_gb == 9) {
                            if ($list->output_lab_gb == 'Pending') {
                                return
                                    '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-question"></i> Cek&nbsp;Status
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
                                </div>
                            </div>';
                            } elseif ($list->output_lab_gb == 'Unload') {
                                return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-truck"></i>&nbsp;Proses&nbsp;Bongkar&nbsp;1
                            </a>';
                            }
                        } elseif ($list->status_lab1_gb == 10) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 11) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 12) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-credit-card"></i>&nbsp;Proses&nbsp;Pembayaran
                        </a>';
                        } elseif ($list->status_lab1_gb == 16) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-credit-card"></i>&nbsp;Pending&nbsp;Harga
                    </a>';
                        } else {
                            return
                                '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-exclamation"></i>&nbsp;Cek&nbsp;Pending
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item" href="' . route('qc.approve_lab1_gb', ['id' => $list->id_lab1_gb]) . '"  style="color:red"><i class="fas fa-check" style="color:red"></i>Bongkar</a>
                            </div>
                        </div>';
                        }
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_lab1_gb == 6) {
                            if ($list->status_approved == '' || $list->status_approved == 'NULL') {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-question"></i> Cek&nbsp;Bongkar
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button class="dropdown-item" id="btn_approve_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;Approve&nbsp;Bongkar</button>
                        <button id="to_edit" class="dropdown-item" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '" title="Edit Data"><i class="fas fa-edit"></i>Edit</button>
                        </div>
                        </div>';
                            } else if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                        </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tolak&nbsp;Approve <i class="fa fa-exclamation"></i> <br> (Cek&nbsp;Analisa&nbsp;Lab)
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                            <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '"  title="Information"><i class="fas fa-edit"></i>Cek&nbsp;Analisa</button>
                            </div>
                            </div>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                        </a>';
                            }
                        } elseif ($list->status_lab1_gb == 7) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;1 
                        </a>';
                        } elseif ($list->status_lab1_gb == 5) {
                            if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner">&nbsp;Pengajuan&nbsp;Approve&nbsp;Tolak&nbsp;SPV</i>
                        </a>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '"  title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times"></i>&nbsp;Reject
                            </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-check"></i>&nbsp;Bongkar
                            </a>';
                            } else if ($list->status_approved == 3) {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-question"></i> Cek&nbsp;Tolak
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button id="to_edit" class="dropdown-item" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '" title="Edit Data"><i class="fas fa-edit"></i>Analisa&nbsp;Ulang</button>
                        </div>
                        </div>';
                            }
                        } elseif ($list->status_lab1_gb == 8) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-phone"></i>&nbsp;PO&nbsp;On&nbsp;Call
                        </a>';
                        } elseif ($list->status_lab1_gb == 9) {
                            if ($list->output_lab_gb == 'Pending') {
                                return
                                    '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-question"></i> Cek&nbsp;Status
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-hp="' . $list->nomer_hp . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
                                </div>
                            </div>';
                            } elseif ($list->output_lab_gb == 'Unload') {
                                return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-truck"></i>&nbsp;Proses&nbsp;Bongkar&nbsp;1
                            </a>';
                            }
                        } elseif ($list->status_lab1_gb == 10) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 11) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 12) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-credit-card"></i>&nbsp;Proses&nbsp;Pembayaran
                        </a>';
                        } elseif ($list->status_lab1_gb == 16) {
                            return
                                '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-exclamation"></i> Pending&nbsp;Harga <br> (Konfirmasi&nbsp;Supplier)
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '"  title="Information"><i class="fas fa-edit"></i>Edit</button>
                            </div>
                        </div>';
                        } else {
                            return
                                '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-exclamation"></i>&nbsp;Cek&nbsp;Pending
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item" href="' . route('qc.approve_lab1_gb', ['id' => $list->id_lab1_gb]) . '"  style="color:red"><i class="fas fa-check" style="color:red"></i>Bongkar</a>
                            </div>
                        </div>';
                        }
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result . '%';
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result . ' %';
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result . ' %';
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result . '%';
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result . '%';
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result . '%';
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result . '%';
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result . '%';
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result . '%';
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result . '%';
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result . '/Kg';
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result . '/Kg';
                    })

                    ->rawColumns(['waktu_penerimaan', 'antrian', 'kode_po', 'nama_vendor', 'lokasi_bongkar', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'ckelola_manager', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            }
        }
    }
    public function output_lab1_gb_ciherang_index(Request $request)
    {
        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
            ->where('penerimaan_po.status_penerimaan', '>=', 5)
            ->where('bid.name_bid', 'GABAH BASAH CIHERANG')
            ->orderBy('lab1_gb.id_lab1_gb', 'DESC')
            ->get())
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
            ->addColumn('antrian', function ($list) {
                $result = $list->no_antrian;
                return '<a style="margin:2px;"  title="Informasi" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
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
            ->addColumn('asal_gabah', function ($list) {
                $result = $list->keterangan_penerimaan_po;
                return $result;
            })
            ->addColumn('lokasi_bongkar', function ($list) {
                $result = $list->lokasi_bongkar_gb;
                return $result;
            })
            ->addColumn('plan_harga', function ($list) {
                $result = rupiah($list->plan_harga_gb) . '/Kg';
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_lab1_gb == 6) {
                    if ($list->status_approved == 0) {
                        return
                            '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-question"></i> Cek&nbsp;Bongkar
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button class="dropdown-item" id="btn_approve_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Bongkar</button>
                        <button id="to_edit" class="dropdown-item" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '" title="Edit Data"><i class="fas fa-edit"></i>Edit</button>
                        </div>
                        </div>';
                        // <button class="dropdown-item" id="btn_approve_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;Approve&nbsp;Bongkar</button>
                    } else if ($list->status_approved == 2) {
                        return
                            '<div class="dropdown">
                    <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tolak&nbsp;Approve <i class="fa fa-exclamation"></i> <br> (Cek&nbsp;Analisa&nbsp;Lab)
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '"  title="Information"><i class="fas fa-edit"></i>Cek&nbsp;Analisa</button>
						</div>
                        </div>';
                    } else if ($list->status_approved == 1) {
                        return
                            '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                    </a>';
                    }
                } elseif ($list->status_lab1_gb == 7) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;1 
                    </a>';
                } elseif ($list->status_lab1_gb == 5) {
                    if ($list->status_approved == 0) {
                        return
                            '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner">&nbsp;Pengajuan&nbsp;Approve&nbsp;Tolak&nbsp;SPV</i>
                    </a>';
                    } else if ($list->status_approved == 1) {
                        return
                            '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '"  title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-times"></i>&nbsp;Reject
                        </a>';
                    } else if ($list->status_approved == 2) {
                        return
                            '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check"></i>&nbsp;Bongkar
                        </a>';
                    }
                } elseif ($list->status_lab1_gb == 8) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-phone"></i>&nbsp;PO&nbsp;On&nbsp;Call
                    </a>';
                } elseif ($list->status_lab1_gb == 9) {
                    if ($list->output_lab_gb == 'Pending') {
                        return
                            '<div class="dropdown">
        					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    						    <i class="fa fa-question"></i> Cek&nbsp;Status
    						</button>
    						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
    							<button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
    						</div>
    					</div>';
                    } elseif ($list->output_lab_gb == 'Unload') {
                        return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                          <i class="fa fa-truck"></i>&nbsp;Proses&nbsp;Bongkar&nbsp;1
                        </a>';
                    }
                } elseif ($list->status_lab1_gb == 10) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                    </a>';
                } elseif ($list->status_lab1_gb == 11) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                    </a>';
                } elseif ($list->status_lab1_gb == 12) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;2
                    </a>';
                } elseif ($list->status_lab1_gb == 13) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-credit-card"></i>&nbsp;Proses&nbsp;Pembayaran
                    </a>';
                } elseif ($list->status_lab1_gb == 16) {
                    return
                        '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-exclamation"></i> Pending&nbsp;Harga <br> (Konfirmasi&nbsp;Supplier)
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '" data-hp="' . $list->nomer_hp . '"  title="Information"><i class="fas fa-edit"></i>Edit</button>
						</div>
					</div>';
                } else {
                    return
                        '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-exclamation"></i>&nbsp;Cek&nbsp;Pending
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<a class="dropdown-item" href="' . route('qc.approve_lab1_gb', ['id' => $list->id_lab1_gb]) . '"  style="color:red"><i class="fas fa-check" style="color:red"></i>Bongkar</a>
						</div>
					</div>';
                }
            })
            //add
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
            ->addColumn('berat_sample_beras', function ($list) {
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

            //add
            ->addColumn('hampa', function ($list) {
                $result = $list->hampa_gb;
                return $result . '%';
            })
            ->addColumn('kg_after_adjust_hampa', function ($list) {
                $result = $list->kg_after_adjust_hampa_gb;
                return $result . ' %';
            })
            ->addColumn('prosentasi_kg', function ($list) {
                $result = $list->prosentasi_kg_gb;
                return $result . ' %';
            })
            ->addColumn('susut', function ($list) {
                $result = $list->susut_gb;
                return $result . '%';
            })
            ->addColumn('adjust_susut', function ($list) {
                $result = $list->adjust_susut_gb;
                return $result;
            })
            ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                return $result . '%';
            })
            ->addColumn('prsentase_kg_pk', function ($list) {
                $result = $list->prsentase_kg_pk_gb;
                return $result . '%';
            })
            ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                $result = $list->adjust_prosentase_kg_pk_gb;
                return $result . '%';
            })
            ->addColumn('presentase_ks_pk', function ($list) {
                $result = $list->presentase_ks_pk_gb;
                return $result . '%';
            })
            ->addColumn('presentase_putih', function ($list) {
                $result = $list->presentase_putih_gb;
                return $result . '%';
            })
            ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                $result = $list->adjust_prosentase_kg_ke_putih_gb;
                return $result . '%';
            })
            ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                $result = $list->plan_rend_dari_ks_beras_gb;
                return $result;
            })
            ->addColumn('katul', function ($list) {
                $result = $list->katul_gb;
                return $result;
            })
            ->addColumn('refraksi_broken', function ($list) {
                $result = $list->refraksi_broken_gb;
                return $result;
            })
            ->addColumn('plan_harga_gabah', function ($list) {
                $result = rupiah($list->plan_harga_gabah_gb);
                return $result . '/Kg';
            })
            ->addColumn('plan_harga_beli_gabah', function ($list) {
                $result = rupiah($list->plan_harga_gabah_gb);
                return $result . '/Kg';
            })

            ->rawColumns(['waktu_penerimaan', 'antrian', 'kode_po', 'nama_vendor', 'lokasi_bongkar', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'ckelola_manager', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
            ->make(true);
    }
    public function output_lab1_gb_ketan_putih_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
                    ->where('penerimaan_po.status_penerimaan', '>=', 5)
                    ->where('bid.name_bid', 'GABAH BASAH KETAN PUTIH')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->orderBy('penerimaan_po.id_penerimaan_po', 'DESC')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
                    ->addColumn('antrian', function ($list) {
                        $result = $list->no_antrian;
                        return '<a style="margin:2px;"  title="Informasi" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    ' . $result . '
                    </a>';
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('lokasi_bongkar', function ($list) {
                        $result = $list->lokasi_bongkar_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola_manager', function ($list) {
                        if ($list->status_lab1_gb == 6) {
                            if ($list->status_approved == '' || $list->status_approved == 'NULL') {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                    </a>';
                                // <button class="dropdown-item" id="btn_approve_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;Approve&nbsp;Bongkar</button>
                            } else if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                        </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner"></i>&nbsp;Tolak&nbsp;Approve&nbsp;SPV 
                    </a>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                        </a>';
                            }
                        } elseif ($list->status_lab1_gb == 7) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;1 
                        </a>';
                        } elseif ($list->status_lab1_gb == 5) {
                            if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner">&nbsp;Pengajuan&nbsp;Approve&nbsp;Tolak&nbsp;SPV</i>
                        </a>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '"  title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times"></i>&nbsp;Reject
                            </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-check"></i>&nbsp;Bongkar
                            </a>';
                            }
                        } elseif ($list->status_lab1_gb == 8) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-phone"></i>&nbsp;PO&nbsp;On&nbsp;Call
                        </a>';
                        } elseif ($list->status_lab1_gb == 9) {
                            if ($list->output_lab_gb == 'Pending') {
                                return
                                    '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-question"></i> Cek&nbsp;Status
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
                                </div>
                            </div>';
                            } elseif ($list->output_lab_gb == 'Unload') {
                                return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-truck"></i>&nbsp;Proses&nbsp;Bongkar&nbsp;1
                            </a>';
                            }
                        } elseif ($list->status_lab1_gb == 10) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 11) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 12) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-credit-card"></i>&nbsp;Proses&nbsp;Pembayaran
                        </a>';
                        } elseif ($list->status_lab1_gb == 16) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-credit-card"></i>&nbsp;Pending&nbsp;Harga
                    </a>';
                        } else {
                            return
                                '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-exclamation"></i>&nbsp;Cek&nbsp;Pending
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item" href="' . route('qc.approve_lab1_gb', ['id' => $list->id_lab1_gb]) . '"  style="color:red"><i class="fas fa-check" style="color:red"></i>Bongkar</a>
                            </div>
                        </div>';
                        }
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_lab1_gb == 6) {
                            if ($list->status_approved == '' || $list->status_approved == 'NULL') {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-question"></i> Cek&nbsp;Bongkar
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button class="dropdown-item" id="btn_approve_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;Approve&nbsp;Bongkar</button>
                        <button id="to_edit" class="dropdown-item" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '" title="Edit Data"><i class="fas fa-edit"></i>Edit</button>
                        </div>
                        </div>';
                            } else if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                        </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tolak&nbsp;Approve <i class="fa fa-exclamation"></i> <br> (Cek&nbsp;Analisa&nbsp;Lab)
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                            <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '"  title="Information"><i class="fas fa-edit"></i>Cek&nbsp;Analisa</button>
                            </div>
                            </div>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                        </a>';
                            }
                        } elseif ($list->status_lab1_gb == 7) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;1 
                        </a>';
                        } elseif ($list->status_lab1_gb == 5) {
                            if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner">&nbsp;Pengajuan&nbsp;Approve&nbsp;Tolak&nbsp;SPV</i>
                        </a>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '"  title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times"></i>&nbsp;Reject
                            </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-check"></i>&nbsp;Bongkar
                            </a>';
                            } else if ($list->status_approved == 3) {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-question"></i> Cek&nbsp;Tolak
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button id="to_edit" class="dropdown-item" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '" title="Edit Data"><i class="fas fa-edit"></i>Analisa&nbsp;Ulang</button>
                        </div>
                        </div>';
                            }
                        } elseif ($list->status_lab1_gb == 8) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-phone"></i>&nbsp;PO&nbsp;On&nbsp;Call
                        </a>';
                        } elseif ($list->status_lab1_gb == 9) {
                            if ($list->output_lab_gb == 'Pending') {
                                return
                                    '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-question"></i> Cek&nbsp;Status
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-hp="' . $list->nomer_hp . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
                                </div>
                            </div>';
                            } elseif ($list->output_lab_gb == 'Unload') {
                                return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-truck"></i>&nbsp;Proses&nbsp;Bongkar&nbsp;1
                            </a>';
                            }
                        } elseif ($list->status_lab1_gb == 10) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 11) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 12) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-credit-card"></i>&nbsp;Proses&nbsp;Pembayaran
                        </a>';
                        } elseif ($list->status_lab1_gb == 16) {
                            return
                                '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-exclamation"></i> Pending&nbsp;Harga <br> (Konfirmasi&nbsp;Supplier)
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '"  title="Information"><i class="fas fa-edit"></i>Edit</button>
                            </div>
                        </div>';
                        } else {
                            return
                                '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-exclamation"></i>&nbsp;Cek&nbsp;Pending
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item" href="' . route('qc.approve_lab1_gb', ['id' => $list->id_lab1_gb]) . '"  style="color:red"><i class="fas fa-check" style="color:red"></i>Bongkar</a>
                            </div>
                        </div>';
                        }
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result . '%';
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result . ' %';
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result . ' %';
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result . '%';
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result . '%';
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result . '%';
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result . '%';
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result . '%';
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result . '%';
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result . '%';
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result . '/Kg';
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result . '/Kg';
                    })

                    ->rawColumns(['waktu_penerimaan', 'antrian', 'kode_po', 'nama_vendor', 'lokasi_bongkar', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'ckelola_manager', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            } else {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
                    ->where('penerimaan_po.status_penerimaan', '>=', 5)
                    ->where('bid.name_bid', 'GABAH BASAH KETAN PUTIH')
                    ->orderBy('penerimaan_po.id_penerimaan_po', 'DESC')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
                    ->addColumn('antrian', function ($list) {
                        $result = $list->no_antrian;
                        return '<a style="margin:2px;"  title="Informasi" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    ' . $result . '
                    </a>';
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('lokasi_bongkar', function ($list) {
                        $result = $list->lokasi_bongkar_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola_manager', function ($list) {
                        if ($list->status_lab1_gb == 6) {
                            if ($list->status_approved == '' || $list->status_approved == 'NULL') {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                    </a>';
                                // <button class="dropdown-item" id="btn_approve_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;Approve&nbsp;Bongkar</button>
                            } else if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                        </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner"></i>&nbsp;Tolak&nbsp;Approve&nbsp;SPV 
                    </a>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                        </a>';
                            }
                        } elseif ($list->status_lab1_gb == 7) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;1 
                        </a>';
                        } elseif ($list->status_lab1_gb == 5) {
                            if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner">&nbsp;Pengajuan&nbsp;Approve&nbsp;Tolak&nbsp;SPV</i>
                        </a>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '"  title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times"></i>&nbsp;Reject
                            </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-check"></i>&nbsp;Bongkar
                            </a>';
                            } else if ($list->status_approved == 3) {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-question"></i> Cek&nbsp;Tolak
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button id="to_edit" class="dropdown-item" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '" title="Edit Data"><i class="fas fa-edit"></i>Analisa&nbsp;Ulang</button>
                        </div>
                        </div>';
                            }
                        } elseif ($list->status_lab1_gb == 8) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-phone"></i>&nbsp;PO&nbsp;On&nbsp;Call
                        </a>';
                        } elseif ($list->status_lab1_gb == 9) {
                            if ($list->output_lab_gb == 'Pending') {
                                return
                                    '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-question"></i> Cek&nbsp;Status
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
                                </div>
                            </div>';
                            } elseif ($list->output_lab_gb == 'Unload') {
                                return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-truck"></i>&nbsp;Proses&nbsp;Bongkar&nbsp;1
                            </a>';
                            }
                        } elseif ($list->status_lab1_gb == 10) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 11) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 12) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-credit-card"></i>&nbsp;Proses&nbsp;Pembayaran
                        </a>';
                        } elseif ($list->status_lab1_gb == 16) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-credit-card"></i>&nbsp;Pending&nbsp;Harga
                    </a>';
                        } else {
                            return
                                '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-exclamation"></i>&nbsp;Cek&nbsp;Pending
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item" href="' . route('qc.approve_lab1_gb', ['id' => $list->id_lab1_gb]) . '"  style="color:red"><i class="fas fa-check" style="color:red"></i>Bongkar</a>
                            </div>
                        </div>';
                        }
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_lab1_gb == 6) {
                            if ($list->status_approved == '' || $list->status_approved == 'NULL') {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-question"></i> Cek&nbsp;Bongkar
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button class="dropdown-item" id="btn_approve_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;Approve&nbsp;Bongkar</button>
                        <button id="to_edit" class="dropdown-item" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '" title="Edit Data"><i class="fas fa-edit"></i>Edit</button>
                        </div>
                        </div>';
                            } else if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                        </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tolak&nbsp;Approve <i class="fa fa-exclamation"></i> <br> (Cek&nbsp;Analisa&nbsp;Lab)
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                            <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '"  title="Information"><i class="fas fa-edit"></i>Cek&nbsp;Analisa</button>
                            </div>
                            </div>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"></i>&nbsp;Pengajuan&nbsp;Approve&nbsp;Bongkar&nbsp;SPV 
                        </a>';
                            }
                        } elseif ($list->status_lab1_gb == 7) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;1 
                        </a>';
                        } elseif ($list->status_lab1_gb == 5) {
                            if ($list->status_approved == 0) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner">&nbsp;Pengajuan&nbsp;Approve&nbsp;Tolak&nbsp;SPV</i>
                        </a>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '"  title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times"></i>&nbsp;Reject
                            </a>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-check"></i>&nbsp;Bongkar
                            </a>';
                            }
                        } elseif ($list->status_lab1_gb == 8) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-id="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-phone"></i>&nbsp;PO&nbsp;On&nbsp;Call
                        </a>';
                        } elseif ($list->status_lab1_gb == 9) {
                            if ($list->output_lab_gb == 'Pending') {
                                return
                                    '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-question"></i> Cek&nbsp;Status
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-hp="' . $list->nomer_hp . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
                                </div>
                            </div>';
                            } elseif ($list->output_lab_gb == 'Unload') {
                                return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-truck"></i>&nbsp;Proses&nbsp;Bongkar&nbsp;1
                            </a>';
                            }
                        } elseif ($list->status_lab1_gb == 10) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 11) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 12) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;2
                        </a>';
                        } elseif ($list->status_lab1_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-credit-card"></i>&nbsp;Proses&nbsp;Pembayaran
                        </a>';
                        } elseif ($list->status_lab1_gb == 16) {
                            return
                                '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-exclamation"></i> Pending&nbsp;Harga <br> (Konfirmasi&nbsp;Supplier)
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggal_po="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" data-hp="' . $list->nomer_hp . '"  title="Information"><i class="fas fa-edit"></i>Edit</button>
                            </div>
                        </div>';
                        } else {
                            return
                                '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-exclamation"></i>&nbsp;Cek&nbsp;Pending
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item" href="' . route('qc.approve_lab1_gb', ['id' => $list->id_lab1_gb]) . '"  style="color:red"><i class="fas fa-check" style="color:red"></i>Bongkar</a>
                            </div>
                        </div>';
                        }
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result . '%';
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result . ' %';
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result . ' %';
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result . '%';
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result . '%';
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result . '%';
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result . '%';
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result . '%';
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result . '%';
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result . '%';
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result . '/Kg';
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result . '/Kg';
                    })

                    ->rawColumns(['waktu_penerimaan', 'antrian', 'kode_po', 'nama_vendor', 'lokasi_bongkar', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'ckelola_manager', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            }
        }
    }
    public function output_lab1_pk_index(Request $request)
    {
        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab1_pk', 'lab1_pk.lab1_id_data_po_pk', '=', 'data_po.id_data_po')
            ->where('penerimaan_po.status_penerimaan', '>=', 5)
            ->orderBy('lab1_pk.id_lab1_pk', 'DESC')
            ->get())
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = $list->waktu_penerimaan;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = $list->open_po;
                return $result;
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('asal_gabah', function ($list) {
                $result = $list->keterangan_penerimaan_po;
                return $result;
            })
            ->addColumn('ka_pk', function ($list) {
                $result = $list->ka_pk . '%';
                return $result;
            })
            ->addColumn('pk_pk', function ($list) {
                $result = $list->pk_pk;
                return $result;
            })
            ->addColumn('pk_bersih_pk', function ($list) {
                $result = $list->pk_bersih_pk . '%';
                return $result;
            })
            ->addColumn('beras_pk', function ($list) {
                $result = $list->beras_pk;
                return $result;
            })
            ->addColumn('butir_patah_pk', function ($list) {
                $result = $list->butir_patah_pk;
                return $result;
            })
            ->addColumn('hampa_pk', function ($list) {
                $result = $list->hampa_pk;
                return $result;
            })
            ->addColumn('katul_pk', function ($list) {
                $result = $list->katul_pk;
                return $result;
            })
            ->addColumn('wh_pk', function ($list) {
                $result = $list->wh_pk . '%';
                return $result;
            })
            ->addColumn('tr_pk', function ($list) {
                $result = $list->tr_pk . '%';
                return $result;
            })
            ->addColumn('md_pk', function ($list) {
                $result = $list->md_pk . '%';
                return $result;
            })
            ->addColumn('presentase_hampa_pk', function ($list) {
                $result = $list->presentase_hampa_pk . '%';
                return $result;
            })
            ->addColumn('presentase_pk_bersih_pk', function ($list) {
                $result = $list->presentase_pk_bersih_pk . '%';
                return $result;
            })
            ->addColumn('presentase_katul_pk', function ($list) {
                $result = $list->presentase_katul_pk . '%';
                return $result;
            })
            ->addColumn('presentase_beras_pk', function ($list) {
                $result = $list->presentase_beras_pk . '%';
                return $result;
            })
            ->addColumn('presentase_butir_patah_pk', function ($list) {
                $result = $list->presentase_butir_patah_pk . '%';
                return $result;
            })
            ->addColumn('presentase_butir_patah_beras_pk', function ($list) {
                $result = $list->presentase_butir_patah_beras_pk . '%';
                return $result;
            })
            ->addColumn('presentase_butir_patah_beras_adjust_pk', function ($list) {
                $result = $list->presentase_butir_patah_beras_adjust_pk . '%';
                return $result;
            })
            ->addColumn('refraksi_ka_pk', function ($list) {
                if ($list->refraksi_ka_pk == 'TOLAK') {
                    return 'TOLAK';
                } else {
                    $result = rupiah($list->refraksi_ka_pk);
                    return $result;
                }
            })
            ->addColumn('refraksi_hampa_pk', function ($list) {
                if ($list->refraksi_hampa_pk == 'TOLAK') {
                    return 'TOLAK';
                } else {
                    $result = rupiah($list->refraksi_hampa_pk);
                    return $result;
                }
            })
            ->addColumn('refraksi_katul_pk', function ($list) {
                if ($list->refraksi_katul_pk == 'TOLAK') {
                    return 'TOLAK';
                } else {
                    $result = rupiah($list->refraksi_katul_pk);
                    return $result;
                }
            })
            ->addColumn('refraksi_tr_pk', function ($list) {
                if ($list->refraksi_tr_pk == 'TOLAK') {
                    return 'TOLAK';
                } else {
                    $result = rupiah($list->refraksi_tr_pk);
                    return $result;
                }
            })
            ->addColumn('refraksi_butir_patah_pk', function ($list) {
                if ($list->refraksi_butir_patah_pk == 'TOLAK') {
                    return 'TOLAK';
                } else {
                    $result = rupiah($list->refraksi_butir_patah_pk);
                    return $result;
                }
            })
            ->addColumn('reward_hampa_pk', function ($list) {
                if ($list->reward_hampa_pk == 'TOLAK') {
                    return 'TOLAK';
                } else {
                    $result = rupiah($list->reward_hampa_pk);
                    return $result;
                }
            })
            ->addColumn('reward_katul_pk', function ($list) {
                if ($list->reward_katul_pk == 'TOLAK') {
                    return 'TOLAK';
                } else {
                    $result = rupiah($list->reward_katul_pk);
                    return $result;
                }
            })
            ->addColumn('reward_tr_pk', function ($list) {
                if ($list->reward_tr_pk == 'TOLAK') {
                    return 'TOLAK';
                } else {
                    $result = rupiah($list->reward_tr_pk);
                    return $result;
                }
            })
            ->addColumn('reward_butir_patah_pk', function ($list) {
                if ($list->reward_butir_patah_pk == 'TOLAK') {
                    return 'TOLAK';
                } else {
                    $result = rupiah($list->reward_butir_patah_pk);
                    return $result;
                }
            })
            ->addColumn('plan_kualitas_pk', function ($list) {
                $result = $list->plan_kualitas_pk;
                return $result;
            })
            ->addColumn('harga_atas_pk', function ($list) {
                $result = rupiah($list->harga_atas_pk);
                return $result;
            })
            ->addColumn('harga_incoming_pk', function ($list) {
                if ($list->harga_incoming_pk == 'TOLAK') {
                    return 'TOLAK';
                } else {
                    $result = rupiah($list->harga_incoming_pk);
                    return $result;
                }
            })
            ->addColumn('plan_harga_aktual_pk', function ($list) {
                if ($list->plan_harga_aktual_pk == 'TOLAK') {
                    return 'TOLAK';
                } else {
                    $result = rupiah($list->plan_harga_aktual_pk);
                    return $result;
                }
            })
            ->addColumn('aktual_kualitas_pk', function ($list) {
                if ($list->aktual_kualitas_pk == 'TOLAK') {
                    return 'TOLAK';
                } else {
                    $result = $list->aktual_kualitas_pk;
                    return $result;
                }
            })
            ->addColumn('harga_awal_pk', function ($list) {
                if ($list->harga_awal_pk == 'TOLAK') {
                    return 'TOLAK';
                } else {
                    $result = rupiah($list->harga_awal_pk) . '/Kg';
                    return $result;
                }
            })
            ->addColumn('aksi_harga_pk', function ($list) {
                $result = $list->aksi_harga_pk;
                return $result;
            })
            ->addColumn('reaksi_harga_pk', function ($list) {
                $result = $list->reaksi_harga_pk;
                if ($result == '') {
                    $result = 'Rp. -';
                } else {
                    $result = rupiah($list->reaksi_harga_pk);
                }
                return $result;
            })
            ->addColumn('harga_akhir_pk', function ($list) {
                $result = $list->harga_akhir_permintaan_pk;
                if ($result == null | $result == '') {
                    if ($list->harga_akhir_pk == 'TOLAK') {
                        return 'TOLAK';
                    } else {
                        $result = rupiah($list->harga_akhir_pk) . '/Kg';
                        return $result;
                    }
                } else {
                    $result = rupiah($list->harga_akhir_permintaan_pk) . '/Kg';
                    return $result;
                }
            })
            ->addColumn('created_at_pk', function ($list) {
                $result = $list->created_at_pk;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_lab1_pk == 6) {
                    if ($list->status_approved == '' || $list->status_approved == 'NULL') {
                        return
                            '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-question"></i> Cek&nbsp;Bongkar
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button class="dropdown-item" id="btn_bongkar" data-id="' . $list->id_lab1_pk . '"><i class="fas fa-check"></i>Pengajuan&nbsp;Bongkar</button>
							<button id="to_edit" class="dropdown-item" name="' . $list->id_lab1_pk . '" data-tanggal_po="' . $list->tanggal_po . '" data-idtopprice="' . $list->id_penerimaan_po . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
						</div>
					</div>';
                    } elseif ($list->status_approved == '1') {
                        return
                            '<button class="btn btn-outline-primary "><i class="fas fa-spinner"></i>menunggu&nbsp;Pengajuan&nbsp;Bongkar</button>';
                    } elseif ($list->status_approved == '2') {
                        return
                            '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-minus"></i>&nbsp;Tolak&nbsp;Approve&nbsp;SPV
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="to_edit" class="dropdown-item" name="' . $list->id_lab1_pk . '" data-tanggal_po="' . $list->tanggal_po . '" data-idtopprice="' . $list->id_penerimaan_po . '" title="Information"><i class="fas fa-edit"></i>Cek&nbsp;Analisa</button>
						</div>
					</div>';
                    }
                } elseif ($list->status_lab1_pk == 7) {
                    if ($list->status_approved == 1) {
                        return
                            '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;1 
                        </a>';
                    } else {
                        return
                            '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;1 
                        </a>';
                    }
                } elseif ($list->status_lab1_pk == 5) {

                    if ($list->status_approved == 1) {
                        return
                            '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '"title="Information" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check"></i>&nbsp;Tolak 
                    </a>';
                    } else {
                        return
                            '<div class="dropdown">
    					<button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-question"></i>&nbsp;Approve&nbsp;Tolak
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button class="dropdown-item" id="btn_tolak" data-id="' . $list->id_lab1_pk . '"><i class="fas fa-minus"></i>Tolak</button>
							<button id="to_edit" class="dropdown-item" name="' . $list->id_lab1_pk . '" data-tanggal_po="' . $list->tanggal_po . '" data-idtopprice="' . $list->id_penerimaan_po . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
						</div>
					</div>';
                    }
                } elseif ($list->status_lab1_pk == 8) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-phone"></i>&nbsp;PO&nbsp;On&nbsp;Call
                    </a>';
                } elseif ($list->status_lab1_pk == 9) {
                    if ($list->output_lab1_pk == 'Pending') {
                        return
                            '<div class="dropdown">
        					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    						    <i class="fa fa-question"></i> Cek&nbsp;Status
    						</button>
    						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
    							<button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_pk . '" data-tanggal_po="' . $list->tanggal_po . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
    						</div>
    					</div>';
                    } elseif ($list->output_lab1_pk == 'Unload') {
                        return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                          <i class="fa fa-truck"></i>&nbsp;Proses&nbsp;Bongkar&nbsp;1
                        </a>';
                    }
                } elseif ($list->status_lab1_pk == 10) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                    </a>';
                } elseif ($list->status_lab1_pk == 11) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-flask"></i>&nbsp;Proses&nbsp;Lab&nbsp;2
                    </a>';
                } elseif ($list->status_lab1_pk == 12) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;2
                    </a>';
                } elseif ($list->status_lab1_pk == 13) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-credit-card"></i>&nbsp;Proses&nbsp;Pembayaran
                    </a>';
                } elseif ($list->status_lab1_pk == 16) {
                    return
                        '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-exclamation"></i> Cek&nbsp;Pending
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_pk . '" data-tanggal_po="' . $list->tanggal_po . '" data-idtopprice="' . $list->id_penerimaan_po . '"  title="Information"><i class="fas fa-edit"></i>Edit</button>
						</div>
					</div>';
                } else {
                    return
                        '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-exclamation"></i>&nbsp;Cek&nbsp;Pending
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<a class="dropdown-item" href="' . route('qc.lab.approve_lab1_pk', ['id' => $list->id_lab1_pk]) . '"  style="color:red"><i class="fas fa-check" style="color:red"></i>Bongkar</a>
						</div>
					</div>';
                }
            })

            ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'lokasi_bongkar', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
            ->make(true);
    }
    public function approve_lab1_gb($id)
    {
        $data            = Lab1GabahBasah::where('id_lab1_gb', $id)->first();
        $data->status_approved = '1';
        $data->update();
        $get_penerimaan_po  = PenerimaanPO::where('penerimaan_kode_po', $data->lab1_kode_po_gb)->first();

        $log                               = new LogAktivityLab();
        $log->nama_user                    = Auth::guard('lab')->user()->name_qc;
        $log->id_objek_aktivitas_lab       = $data->id_lab1_gb;
        $log->aktivitas_lab                = 'Pengajuan Approve Bongkar ke SPV LAB 1 Kode PO:' . $data->lab1_kode_po_gb;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();

        $po = trackerPO::where('kode_po_tracker', $data->lab1_kode_po_gb)->first();
        $po->nama_admin_tracker  = Auth::guard('lab')->user()->name_qc;
        $po->proses_tracker  = 'PENGAJUAN APPROVE BONGKAR';
        $po->pengajuan_approve_lab1_tracker  = date('Y-m-d H:i:s');
        $po->update();

        //tambah notifikasi
        $notif   = new NotifSpvqc();
        $notif->judul           = "Pengajuan Approve";
        $notif->keterangan      = "Ada PO Pengajuan Approve Lab Incoming, Kode PO : " . $data->lab1_kode_po_gb;
        $notif->status          = 0;
        $notif->id_objek        = $id;
        $notif->notifbaru       = 0;
        $notif->kategori        = 0;
        $notif->created_at      = date('Y-m-d H:i:s');
        $notif->save();
    }

    public function approve_lab1_pk($id)
    {
        $data    = DB::table('lab1_pk')->where('id_lab1_pk', $id)->update(['status_approved' => 1]);
    }
    public function approve_tolak_lab1_pk($id)
    {
        $get_id_lab            = DB::table('lab1_pk')->where('id_lab1_pk', $id)->first();
        $get_data_po            = DB::table('data_po')->where('kode_po', $get_id_lab->lab1_kode_po_pk)->first();
        //  Integrasi Epicor
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/PO/ClosePO?PONum=' . $get_data_po->PONum;
        $response = $client->get($url);
        $response = $response->getBody()->getContents();
        // dd($response); 
        $data                   = DB::table('lab1_pk')->where('id_lab1_pk', $id)->update(['status_approved' => 1]);
    }

    public function edit_lab1_gb($id)
    {
        $data = DB::table('lab1_gb')
            ->join('data_po', 'data_po.id_data_po', '=', 'lab1_gb.lab1_id_data_po_gb')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->where('id_lab1_gb', $id)->first();
        return json_encode($data);
    }

    public function edit_lab1_pk($id)
    {
        $data = DB::table('lab1_pk')
            ->join('data_po', 'data_po.id_data_po', '=', 'lab1_pk.lab1_id_data_po_pk')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->where('lab1_pk.id_lab1_pk', $id)->first();
        return json_encode($data);
    }


    public function detail_output_incoming_qc($id)
    {
        $data = DB::table('gabahincoming_qc')->where('id_gabahincoming_qc', $id)->first();
        return json_encode($data);
    }

    public function finishing_qc()
    {
        $plan_hpp_gabah_basah = PlanHppGabahBasah::get();
        return view('dashboard.admin_qc.finishing_qc', ['plan_hpp_gabah_basah' => $plan_hpp_gabah_basah]);
    }
    public function output_gabah_incoming_pending(Request $req)
    {
        if ($req->output_lab1 == 'Unload') {
            $update_status_data_po = DB::table('penerimaan_po')->where('penerimaan_kode_po', $req->gabahincoming_kode_po)->update(['status_penerimaan' => 7]);
            $update_status_penerimaan_data_po = DB::table('data_po')->where('kode_po', $req->gabahincoming_kode_po)->update(['status_bid' => 7]);
            $update_status_gabahincoming_data_po = DB::table('gabahincoming_qc')->where('gabahincoming_kode_po', $req->gabahincoming_kode_po)->update(['status_gabahincoming_qc' => 7, 'output_lab1' => 'Unload']);
            return redirect()->back();
        } else {
            $update_status_data_po = DB::table('penerimaan_po')->where('penerimaan_kode_po', $req->gabahincoming_kode_po)->update(['status_penerimaan' => 5]);
            $update_status_penerimaan_data_po = DB::table('data_po')->where('kode_po', $req->gabahincoming_kode_po)->update(['status_bid' => 5]);
            $update_status_gabahincoming_data_po = DB::table('gabahincoming_qc')->where('gabahincoming_kode_po', $req->gabahincoming_kode_po)->update(['status_gabahincoming_qc' => 5, 'output_lab1' => 'Reject']);
            return redirect()->back();
        }
    }
    public function gabah_incoming_qc($id)
    {
        $data = DB::table('penerimaan_po')
            ->join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('id_penerimaan_po', $id)->first();
        return json_encode($data);
    }
    public function save_proseslab1_gabah_basah(Request $request)
    {
        $from2 = date('Y-m-d 12:00:00');
        // $to = date('Y-m-d 12:00:00');
        $to = \Carbon\Carbon::parse($request->tanggal_po_gb)->isoFormat('Y-MM-DD 12:00:00');
        $from = \Carbon\Carbon::parse($request->date_bid_gb)->isoFormat('Y-MM-DD 12:00:00');
        $today12 = date('Y-m-d 12:00:00');
        // dd($to);
        $bongkar = $request->lokasi_gt_gb;
        $penerimaan = $request->waktu_penerimaan_gb;
        $to2 = date('Y-m-d 12:00:00', strtotime("+1 days"));
        $today = date('Y-m-d H:i:s');
        // dd($request->id_penerimaan_po_gb);
        if ($request->keterangan_lab_1_gb == 'Unload') {
            $data = PenerimaanPO::where('id_penerimaan_po', $request->id_penerimaan_po_gb)->first();
            $data->status_penerimaan = 6;
            $data->update();

            $data = DataPO::where('id_data_po', $request->lab1_id_data_po_gb)->first();
            $data->status_bid = 6;
            $data->update();

            $data                                          = new Lab1GabahBasah();
            $data->lab1_id_penerimaan_po_gb                = $request->id_penerimaan_po_gb;
            $data->lab1_id_data_po_gb                      = $request->lab1_id_data_po_gb;
            $data->lab1_id_bid_user_gb                     = $request->lab1_id_bid_user_gb;
            $data->lab1_kode_po_gb                         = $request->lab1_kode_po_gb;
            $data->lab1_plat_gb                            = $request->lab1_plat_gb;
            $data->lab1_token                              = Str::random(30);
            $data->hampa_gb                                = $request->hampa_gb;
            $data->broken_gb                               = $request->broken_gb;
            $data->randoman_gb                             = $request->randoman_gb;
            $data->kadar_air_gb                            = $request->kadar_air_gb;
            $data->created_at_gb                           = date('Y-m-d H:i:s');
            $data->keterangan_lab_gb                       = $request->keterangan_lab_gb;
            $data->plan_harga_gb                           = $request->plan_harga_gb;
            $data->output_lab_gb                           = $request->keterangan_lab_1_gb;
            $data->kg_after_adjust_hampa_gb                = $request->kg_after_adjust_hampa_gb;
            $data->prosentasi_kg_gb                        = $request->prosentasi_kg_gb;
            $data->susut_gb                                = $request->susut_gb;
            $data->adjust_susut_gb                         = $request->adjust_susut_gb;
            $data->prsentase_ks_kg_after_adjust_susut_gb   = $request->prsentase_ks_kg_after_adjust_susut_gb;
            $data->prsentase_kg_pk_gb                      = $request->prsentase_kg_pk_gb;
            $data->adjust_prosentase_kg_pk_gb              = $request->adjust_prosentase_kg_pk_gb;
            $data->presentase_ks_pk_gb                     = $request->presentase_ks_pk_gb;
            $data->presentase_putih_gb                     = $request->presentase_putih_gb;
            $data->adjust_prosentase_kg_ke_putih_gb        = $request->adjust_prosentase_kg_ke_putih_gb;
            $data->plan_rend_dari_ks_beras_gb              = $request->plan_rend_dari_ks_beras_gb;
            $data->katul_gb                                = $request->katul_gb;
            $data->refraksi_broken_gb                      = $request->refraksi_broken_gb;
            $data->plan_harga_gabah_gb                     = $request->plan_harga_gabah_gb;
            $data->ka_kg_gb                                = $request->ka_kg_gb;
            $data->berat_sample_awal_ks_gb                 = $request->berat_sample_awal_ks_gb;
            $data->berat_sample_awal_kg_gb                 = $request->berat_sample_awal_kg_gb;
            $data->berat_sample_akhir_kg_gb                = $request->berat_sample_akhir_kg_gb;
            $data->berat_sample_pk_gb                      = $request->berat_sample_pk_gb;
            $data->wh_gb                                   = $request->wh_gb;
            $data->tp_gb                                   = $request->tp_gb;
            $data->md_gb                                   = $request->md_gb;
            $data->lokasi_bongkar_gb                       = $request->lokasi_gt_gb;
            $data->lokasi_gt_gb                             = $request->lokasi_gt_gb;
            $data->status_lab1_gb                          = 6;
            $data->save();

            $log                               = new LogAktivityLab();
            $log->nama_user                    = Auth::guard('lab')->user()->name_qc;
            $log->id_objek_aktivitas_lab       = $data->id_lab1_gb;
            $log->aktivitas_lab                = 'insert LAB 1 Kode PO:' . $request->lab1_kode_po_gb . ' Status : ' . $request->keterangan_lab_1_gb . ' , ID PENERIMAAN PO: ' . $request->id_penerimaan_po_gb .
                ' ID DATA PO: '      . $request->lab1_id_data_po_gb .
                ' PLAT KENDARAAN: '            . $request->lab1_plat_gb .
                ' HAMPA: '                . $request->hampa_gb .
                ' BROKEN: '               . $request->broken_gb .
                ' RANDOMAN: '             . $request->randoman_gb .
                ' KADAR AIR: '            . $request->kadar_air_gb .
                ' KETERANGAN LAB: '       . $request->keterangan_lab_gb .
                ' PLAN HARGA: '           . $request->plan_harga_gb .
                ' OUTPUT LAB: '           . $request->keterangan_lab_1_gb .
                ' KG AFTER ADJUST HAMPA: ' . $request->kg_after_adjust_hampa_gb .
                ' PROSENTASI KG: '        . $request->prosentasi_kg_gb .
                ' SUSUT: '                . $request->susut_gb .
                ' ADJUST SUSUT: '         . $request->adjust_susut_gb .
                ' PRESENTASE KS KG AFTER ADJUST SUSUT: ' . $request->prsentase_ks_kg_after_adjust_susut_gb .
                ' PRESENTASE KG PK: '      . $request->prsentase_kg_pk_gb .
                ' ADJUST PROSENTASE KG PK: '            . $request->adjust_prosentase_kg_pk_gb .
                ' PRESENTASE KS PK: '     . $request->presentase_ks_pk_gb .
                ' PRESENTASE PUTIH: '     . $request->presentase_putih_gb .
                ' ADJUST PROSENTASE KG KE PUTIH: '      . $request->adjust_prosentase_kg_ke_putih_gb .
                ' PLAN REND DARI KS BERAS: '            . $request->plan_rend_dari_ks_beras_gb .
                ' KATUL: '                . $request->katul_gb .
                ' REFRAKSI BROKEN: '      . $request->refraksi_broken_gb .
                ' PLAN HARGA GABAH: '     . $request->plan_harga_gabah_gb .
                ' KA KG: '                . $request->ka_kg_gb .
                ' BERAT SAMPLE AWAL KS ' . $request->berat_sample_awal_ks_gb .
                ' BERAT SAMPLE AWAL KG ' . $request->berat_sample_awal_kg_gb .
                ' BERAT SAMPLE AKHIR KG' . $request->berat_sample_akhir_kg_gb .
                ' BERAT SAMPLE PK: '      . $request->berat_sample_pk_gb .
                ' WH: '                   . $request->wh_gb .
                ' TP: '                   . $request->tp_gb .
                ' MD: '                   . $request->md_gb;
            $log->keterangan_aktivitas         = 'Selesai';
            $log->created_at                   = date('Y-m-d H:i:s');
            $log->save();

            $po = trackerPO::where('kode_po_tracker', $request->lab1_kode_po_gb)->first();
            $po->nama_admin_tracker  = Auth::guard('lab')->user()->name_qc;
            $po->status_po_tracker  = '6';
            $po->pengajuan_approve_lab1_tracker  = NULL;
            $po->proses_tracker  = 'insert LAB 1';
            $po->lab1_tracker  = date('Y-m-d H:i:s');
            $po->update();
        } elseif ($request->keterangan_lab_1_gb == 'Pending') {
            $data = PenerimaanPO::where('id_penerimaan_po', $request->id_penerimaan_po_gb)->first();
            $data->status_penerimaan = 16;
            $data->update();

            $data = DataPO::where('id_data_po', $request->lab1_id_data_po_gb)->first();
            $data->status_bid = 16;
            $data->update();

            $data                                        = new Lab1GabahBasah();
            $data->lab1_id_penerimaan_po_gb        = $request->id_penerimaan_po_gb;
            $data->lab1_id_data_po_gb              = $request->lab1_id_data_po_gb;
            $data->lab1_id_bid_user_gb             = $request->lab1_id_bid_user_gb;
            $data->lab1_kode_po_gb                 = $request->lab1_kode_po_gb;
            $data->lab1_plat_gb                    = $request->lab1_plat_gb;
            $data->lab1_token                                = Str::random(30);
            $data->hampa_gb                                = $request->hampa_gb;
            $data->broken_gb                               = $request->broken_gb;
            $data->randoman_gb                             = $request->randoman_gb;
            $data->kadar_air_gb                            = $request->kadar_air_gb;
            $data->created_at_gb                           = date('Y-m-d H:i:s');
            $data->keterangan_lab_gb                       = $request->keterangan_lab_gb;
            $data->plan_harga_gb                           = $request->plan_harga_gb;
            $data->status_lab1_gb               = 16;
            $data->output_lab_gb                           = $request->keterangan_lab_1_gb;
            $data->kg_after_adjust_hampa_gb                = $request->kg_after_adjust_hampa_gb;
            $data->prosentasi_kg_gb                        = $request->prosentasi_kg_gb;
            $data->susut_gb                                = $request->susut_gb;
            $data->adjust_susut_gb                         = $request->adjust_susut_gb;
            $data->prsentase_ks_kg_after_adjust_susut_gb   = $request->prsentase_ks_kg_after_adjust_susut_gb;
            $data->prsentase_kg_pk_gb                      = $request->prsentase_kg_pk_gb;
            $data->adjust_prosentase_kg_pk_gb              = $request->adjust_prosentase_kg_pk_gb;
            $data->presentase_ks_pk_gb                     = $request->presentase_ks_pk_gb;
            $data->presentase_putih_gb                     = $request->presentase_putih_gb;
            $data->adjust_prosentase_kg_ke_putih_gb        = $request->adjust_prosentase_kg_ke_putih_gb;
            $data->plan_rend_dari_ks_beras_gb              = $request->plan_rend_dari_ks_beras_gb;
            $data->katul_gb                                = $request->katul_gb;
            $data->refraksi_broken_gb                      = $request->refraksi_broken_gb;
            $data->plan_harga_gabah_gb                     = $request->plan_harga_gabah_gb;
            $data->ka_kg_gb                                = $request->ka_kg_gb;
            $data->berat_sample_awal_ks_gb                 = $request->berat_sample_awal_ks_gb;
            $data->berat_sample_awal_kg_gb                 = $request->berat_sample_awal_kg_gb;
            $data->berat_sample_akhir_kg_gb                = $request->berat_sample_akhir_kg_gb;
            $data->berat_sample_pk_gb                      = $request->berat_sample_pk_gb;
            $data->wh_gb                                   = $request->wh_gb;
            $data->tp_gb                                   = $request->tp_gb;
            $data->md_gb                                   = $request->md_gb;
            $data->lokasi_bongkar_gb                       = NULL;
            $data->status_pending                          = $request->status_pending;
            $data->save();

            // LOG
            $log                               = new LogAktivityLab();
            $log->nama_user                    = Auth::guard('lab')->user()->name_qc;
            $log->id_objek_aktivitas_lab       = $data->id_lab1_gb;
            $log->aktivitas_lab                = 'insert LAB 1 Kode PO:' . $request->lab1_kode_po_gb . ' Status : ' . $request->keterangan_lab_1_gb . ' , ID PENERIMAAN PO: ' . $request->id_penerimaan_po_gb .
                ' ID DATA PO: '      . $request->lab1_id_data_po_gb .
                ' PLAT KENDARAAN: '            . $request->lab1_plat_gb .
                ' HAMPA: '                . $request->hampa_gb .
                ' BROKEN: '               . $request->broken_gb .
                ' RANDOMAN: '             . $request->randoman_gb .
                ' KADAR AIR: '            . $request->kadar_air_gb .
                ' KETERANGAN LAB: '       . $request->keterangan_lab_gb .
                ' PLAN HARGA: '           . $request->plan_harga_gb .
                ' OUTPUT LAB: '           . $request->keterangan_lab_1_gb .
                ' KG AFTER ADJUST HAMPA: ' . $request->kg_after_adjust_hampa_gb .
                ' PROSENTASI KG: '        . $request->prosentasi_kg_gb .
                ' SUSUT: '                . $request->susut_gb .
                ' ADJUST SUSUT: '         . $request->adjust_susut_gb .
                ' PRESENTASE KS KG AFTER ADJUST SUSUT: ' . $request->prsentase_ks_kg_after_adjust_susut_gb .
                ' PRESENTASE KG PK: '      . $request->prsentase_kg_pk_gb .
                ' ADJUST PROSENTASE KG PK: '            . $request->adjust_prosentase_kg_pk_gb .
                ' PRESENTASE KS PK: '     . $request->presentase_ks_pk_gb .
                ' PRESENTASE PUTIH: '     . $request->presentase_putih_gb .
                ' ADJUST PROSENTASE KG KE PUTIH: '      . $request->adjust_prosentase_kg_ke_putih_gb .
                ' PLAN REND DARI KS BERAS: '            . $request->plan_rend_dari_ks_beras_gb .
                ' KATUL: '                . $request->katul_gb .
                ' REFRAKSI BROKEN: '      . $request->refraksi_broken_gb .
                ' PLAN HARGA GABAH: '     . $request->plan_harga_gabah_gb .
                ' KA KG: '                . $request->ka_kg_gb .
                ' BERAT SAMPLE AWAL KS ' . $request->berat_sample_awal_ks_gb .
                ' BERAT SAMPLE AWAL KG ' . $request->berat_sample_awal_kg_gb .
                ' BERAT SAMPLE AKHIR KG' . $request->berat_sample_akhir_kg_gb .
                ' BERAT SAMPLE PK: '      . $request->berat_sample_pk_gb .
                ' WH: '                   . $request->wh_gb .
                ' TP: '                   . $request->tp_gb .
                ' MD: '                   . $request->md_gb;
            $log->keterangan_aktivitas         = 'Selesai';
            $log->created_at                   = date('Y-m-d H:i:s');
            $log->save();

            $po = trackerPO::where('kode_po_tracker', $request->lab1_kode_po_gb)->first();
            $po->nama_admin_tracker  = Auth::guard('lab')->user()->name_qc;
            $po->status_po_tracker  = '16';
            $po->proses_tracker  = 'PO PENDING HARGA';
            $po->pengajuan_approve_lab1_tracker  = 'KONFIRMASI PENDING ';
            $po->lab1_tracker  = date('Y-m-d H:i:s');
            $po->update();

            //            $curl = curl_init();
            // curl_setopt_array($curl, array(
            //     CURLOPT_URL => 'https://api.fonnte.com/send',
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_ENCODING => '',
            //     CURLOPT_MAXREDIRS => 10,
            //     CURLOPT_TIMEOUT => 0,
            //     CURLOPT_FOLLOWLOCATION => true,
            //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     CURLOPT_CUSTOMREQUEST => 'POST',
            //     CURLOPT_POSTFIELDS => array(
            //         'target' => $request->no_supplier,
            //         'message' =>
            //         "PEMBERITAHUAN!

            // Hallo *$request->nama_supplier*


            // *PT SURYA PANGAN SEMESTA NGAWI* Ingin menyampaikan informasi bahwa PO : *" . $request->lab1_kode_po_gb . "*, Nopol : *". $request->lab1_plat_gb ."* Dinyatakan *PENDING HARGA* , Harga Gabah Incoming : ". rupiah($request->plan_harga_gabah_gb,) .".
            // Mohon segera Konfirmasi *Bongkar* atau *Tidak*

            // Terima kasih
            // _Sent Via *PT SURYA PANGAN SEMESTA NGAWI*_",
            //         'countryCode' => '62', //optional
            //     ),
            //     CURLOPT_HTTPHEADER => array(
            //         'Authorization: t37BRkrNu+4F!rUJXQdB' //change TOKEN to your actual token
            //     ),
            // ));

            // $response = curl_exec($curl);
            // if (curl_errno($curl)) {
            //     $error_msg = curl_error($curl);
            // }
            // curl_close($curl);

            // if (isset($error_msg)) {
            //     echo $error_msg;
            // }
            // echo $response;
        } else {

            $data = PenerimaanPO::where('id_penerimaan_po', $request->id_penerimaan_po_gb)->first();
            $data->status_penerimaan = 5;
            $data->update();

            $data = DataPO::where('id_data_po', $request->lab1_id_data_po_gb)->first();
            $data->status_bid = 5;
            $data->update();

            $data                                          = new Lab1GabahBasah();
            $data->lab1_id_penerimaan_po_gb                = $request->id_penerimaan_po_gb;
            $data->lab1_id_data_po_gb                      = $request->lab1_id_data_po_gb;
            $data->lab1_id_bid_user_gb                     = $request->lab1_id_bid_user_gb;
            $data->lab1_kode_po_gb                         = $request->lab1_kode_po_gb;
            $data->lab1_plat_gb                            = $request->lab1_plat_gb;
            $data->lab1_token                              = Str::random(30);
            $data->hampa_gb                                = $request->hampa_gb;
            $data->broken_gb                               = $request->broken_gb;
            $data->randoman_gb                             = $request->randoman_gb;
            $data->kadar_air_gb                            = $request->kadar_air_gb;
            $data->status_lab1_gb                          = 5;
            $data->created_at_gb                           = date('Y-m-d H:i:s');
            $data->keterangan_lab_gb                       = $request->keterangan_lab_gb;
            $data->plan_harga_gb                           = $request->plan_harga_gb;
            $data->output_lab_gb                           = $request->keterangan_lab_1_gb;
            $data->kg_after_adjust_hampa_gb                = $request->kg_after_adjust_hampa_gb;
            $data->prosentasi_kg_gb                        = $request->prosentasi_kg_gb;
            $data->susut_gb                                = $request->susut_gb;
            $data->adjust_susut_gb                         = $request->adjust_susut_gb;
            $data->prsentase_ks_kg_after_adjust_susut_gb   = $request->prsentase_ks_kg_after_adjust_susut_gb;
            $data->prsentase_kg_pk_gb                      = $request->prsentase_kg_pk_gb;
            $data->adjust_prosentase_kg_pk_gb              = $request->adjust_prosentase_kg_pk_gb;
            $data->presentase_ks_pk_gb                     = $request->presentase_ks_pk_gb;
            $data->presentase_putih_gb                     = $request->presentase_putih_gb;
            $data->adjust_prosentase_kg_ke_putih_gb        = $request->adjust_prosentase_kg_ke_putih_gb;
            $data->plan_rend_dari_ks_beras_gb              = $request->plan_rend_dari_ks_beras_gb;
            $data->katul_gb                                = $request->katul_gb;
            $data->refraksi_broken_gb                      = $request->refraksi_broken_gb;
            $data->plan_harga_gabah_gb                     = $request->plan_harga_gabah_gb;
            $data->ka_kg_gb                                = $request->ka_kg_gb;
            $data->berat_sample_awal_ks_gb                 = $request->berat_sample_awal_ks_gb;
            $data->berat_sample_awal_kg_gb                 = $request->berat_sample_awal_kg_gb;
            $data->berat_sample_akhir_kg_gb                = $request->berat_sample_akhir_kg_gb;
            $data->berat_sample_pk_gb                      = $request->berat_sample_pk_gb;
            $data->wh_gb                                   = $request->wh_gb;
            $data->tp_gb                                   = $request->tp_gb;
            $data->md_gb                                   = $request->md_gb;
            $data->status_approved                         = 0;
            $data->save();

            // LOG
            $log                               = new LogAktivityLab();
            $log->nama_user                    = Auth::guard('lab')->user()->name_qc;
            $log->id_objek_aktivitas_lab       = $data->id_lab1_gb;
            $log->aktivitas_lab                = 'insert LAB 1 Kode PO:' . $request->lab1_kode_po_gb . ' Status : ' . $request->keterangan_lab_1_gb . ' , ID PENERIMAAN PO: ' . $request->id_penerimaan_po_gb .
                ' ID DATA PO: '      . $request->lab1_id_data_po_gb .
                ' PLAT KENDARAAN: '            . $request->lab1_plat_gb .
                ' HAMPA: '                . $request->hampa_gb .
                ' BROKEN: '               . $request->broken_gb .
                ' RANDOMAN: '             . $request->randoman_gb .
                ' KADAR AIR: '            . $request->kadar_air_gb .
                ' KETERANGAN LAB: '       . $request->keterangan_lab_gb .
                ' PLAN HARGA: '           . $request->plan_harga_gb .
                ' OUTPUT LAB: '           . $request->keterangan_lab_1_gb .
                ' KG AFTER ADJUST HAMPA: ' . $request->kg_after_adjust_hampa_gb .
                ' PROSENTASI KG: '        . $request->prosentasi_kg_gb .
                ' SUSUT: '                . $request->susut_gb .
                ' ADJUST SUSUT: '         . $request->adjust_susut_gb .
                ' PRESENTASE KS KG AFTER ADJUST SUSUT: ' . $request->prsentase_ks_kg_after_adjust_susut_gb .
                ' PRESENTASE KG PK: '      . $request->prsentase_kg_pk_gb .
                ' ADJUST PROSENTASE KG PK: '            . $request->adjust_prosentase_kg_pk_gb .
                ' PRESENTASE KS PK: '     . $request->presentase_ks_pk_gb .
                ' PRESENTASE PUTIH: '     . $request->presentase_putih_gb .
                ' ADJUST PROSENTASE KG KE PUTIH: '      . $request->adjust_prosentase_kg_ke_putih_gb .
                ' PLAN REND DARI KS BERAS: '            . $request->plan_rend_dari_ks_beras_gb .
                ' KATUL: '                . $request->katul_gb .
                ' REFRAKSI BROKEN: '      . $request->refraksi_broken_gb .
                ' PLAN HARGA GABAH: '     . $request->plan_harga_gabah_gb .
                ' KA KG: '                . $request->ka_kg_gb .
                ' BERAT SAMPLE AWAL KS ' . $request->berat_sample_awal_ks_gb .
                ' BERAT SAMPLE AWAL KG ' . $request->berat_sample_awal_kg_gb .
                ' BERAT SAMPLE AKHIR KG' . $request->berat_sample_akhir_kg_gb .
                ' BERAT SAMPLE PK: '      . $request->berat_sample_pk_gb .
                ' WH: '                   . $request->wh_gb .
                ' TP: '                   . $request->tp_gb .
                ' MD: '                   . $request->md_gb;
            $log->keterangan_aktivitas         = 'Selesai';
            $log->created_at                   = date('Y-m-d H:i:s');
            $log->save();

            $po = trackerPO::where('kode_po_tracker', $request->lab1_kode_po_gb)->first();
            $po->nama_admin_tracker  = Auth::guard('lab')->user()->name_qc;
            $po->status_po_tracker  = '5';
            $po->proses_tracker  = 'PO TOLAK KUALITAS';
            $po->pengajuan_approve_lab1_tracker  = NULL;
            $po->lab1_tracker  = date('Y-m-d H:i:s');
            $po->update();
        }

        return response()->json($data);
    }
    public function save_proseslab1_pecah_kulit(Request $request)
    {
        $data                                          = new Lab1Pecahkulit();
        $data->lab1_token                              = Str::random(30);
        $data->lab1_id_penerimaan_po_pk                = $request->lab1_id_penerimaan_po_pk;
        $data->lab1_id_data_po_pk                      = $request->lab1_id_data_po_pk;
        $data->lab1_id_bid_user_pk                     = $request->lab1_id_bid_user_pk;
        $data->lab1_kode_po_pk                         = $request->lab1_kode_po_pk;
        $data->lab1_plat_pk                            = $request->lab1_plat_pk;

        $data->ka_pk                                   = $request->ka_pk;
        $data->pk_pk                                   = $request->pk_pk;
        $data->pk_bersih_pk                            = $request->pk_bersih_pk;
        $data->beras_pk                                = $request->beras_pk;
        $data->butir_patah_pk                          = $request->butir_patah_pk;
        $data->hampa_pk                                = $request->hampa_pk;
        $data->katul_pk                                = $request->katul_pk;
        $data->wh_pk                                   = $request->wh_pk;
        $data->tr_pk                                   = $request->tr_pk;
        $data->md_pk                                   = $request->md_pk;
        $data->output_lab_pk                           = $request->output_lab_pk;
        $data->keterangan_lab_pk                       = $request->keterangan_lab_pk;
        $data->status_lab1_pk                          = 6;
        $data->presentase_hampa_pk                     = $request->presentase_hampa_pk;
        $data->presentase_pk_bersih_pk                 = $request->presentase_pk_bersih_pk;
        $data->presentase_katul_pk                     = $request->presentase_katul_pk;
        $data->presentase_beras_pk                     = $request->presentase_beras_pk;
        $data->presentase_butir_patah_pk               = $request->presentase_butir_patah_pk;
        $data->presentase_butir_patah_beras_pk         = $request->presentase_butir_patah_beras_pk;
        $data->presentase_butir_patah_beras_adjust_pk  = $request->presentase_butir_patah_beras_adjust_pk;
        $data->refraksi_ka_pk                          = $request->refraksi_ka_pk;
        $data->refraksi_hampa_pk                       = $request->refraksi_hampa_pk;
        $data->refraksi_katul_pk                       = $request->refraksi_katul_pk;
        $data->refraksi_tr_pk                          = $request->refraksi_tr_pk;
        $data->refraksi_butir_patah_pk                 = $request->refraksi_butir_patah_pk;
        $data->reward_hampa_pk                         = $request->reward_hampa_pk;
        $data->reward_katul_pk                         = $request->reward_katul_pk;
        $data->reward_tr_pk                            = $request->reward_tr_pk;
        $data->reward_butir_patah_pk                   = $request->reward_butir_patah_pk;

        $data->plan_kualitas_pk                        = $request->plan_kualitas_pk;
        $data->harga_atas_pk                           = $request->harga_atas_pk;
        $data->harga_incoming_pk                       = $request->harga_incoming_pk;

        $data->plan_harga_aktual_pk                    = $request->plan_harga_aktual_pk;
        $data->aktual_kualitas_pk                      = $request->aktual_kualitas_pk;
        $data->aksi_harga_pk                           = 'ON PROCESS';
        $data->harga_awal_pk                           = $request->harga_awal_pk;
        $data->harga_akhir_pk                          = $request->harga_awal_pk;
        $data->created_at_pk                           = date('Y-m-d H:i:s');
        $data->save();
        if ($request->output_lab_pk == 'Pending') {
            $update_status_penerimaan_po = DB::table('penerimaan_po')->where('id_penerimaan_po', $request->lab1_id_penerimaan_po_pk)->where('penerimaan_kode_po', $request->lab1_kode_po_pk)
                ->update(['status_penerimaan' => 16]);

            $update_status_data_po = DB::table('data_po')->where('id_data_po', $request->lab1_id_data_po_pk)->where('kode_po', $request->lab1_kode_po_pk)
                ->update(['status_bid' => 16]);
            $update_status_lab1pk = DB::table('lab1_pk')->where('lab1_id_penerimaan_po_pk', $request->lab1_id_penerimaan_po_pk)->where('lab1_kode_po_pk', $request->lab1_kode_po_pk)
                ->update(['aksi_harga_pk' => 'Pending', 'status_lab1_pk' => 16]);
        } else if ($request->output_lab_pk == 'Reject') {
            $update_status_penerimaan_po = DB::table('penerimaan_po')->where('id_penerimaan_po', $request->lab1_id_penerimaan_po_pk)->where('penerimaan_kode_po', $request->lab1_kode_po_pk)
                ->update(['status_penerimaan' => 5]);

            $update_status_data_po = DB::table('data_po')->where('id_data_po', $request->lab1_id_data_po_pk)
                ->update(['status_bid' => 5]);
            $update_status_lab1pk = DB::table('lab1_pk')->where('lab1_id_penerimaan_po_pk', $request->lab1_id_penerimaan_po_pk)->where('lab1_kode_po_pk', $request->lab1_kode_po_pk)
                ->update(['aksi_harga_pk' => 'Reject', 'status_lab1_pk' => 5]);
        } else {
            $update_status_penerimaan_po = DB::table('penerimaan_po')->where('id_penerimaan_po', $request->lab1_id_penerimaan_po_pk)->where('penerimaan_kode_po', $request->lab1_kode_po_pk)
                ->update(['status_penerimaan' => 6]);

            $update_status_data_po = DB::table('data_po')->where('id_data_po', $request->lab1_id_data_po_pk)->where('kode_po', $request->lab1_kode_po_pk)
                ->update(['status_bid' => 6]);
        }
        return redirect()->back();
    }
    public function update_proses1_gabah_basah(Request $request)
    {
        $from2 = date('Y-m-d 12:00:00');
        $to = \Carbon\Carbon::parse($request->tanggal_po)->isoFormat('Y-MM-DD 12:00:00');
        $from = \Carbon\Carbon::parse($request->date_bid)->isoFormat('Y-MM-DD 12:00:00');
        $today12 = date('Y-m-d 12:00:00');
        $penerimaan = $request->waktu_penerimaan;
        $to2 = date('Y-m-d 12:00:00', strtotime("+1 days"));
        $today = date('Y-m-d H:i:s');
        if ($request->keterangan_lab_1 == 'Unload') {
            $data = PenerimaanPO::where('id_penerimaan_po', $request->gabahincoming_id_penerimaan_po)->first();
            $data->status_penerimaan = 6;
            $data->update();

            $data = DataPO::where('id_data_po', $request->gabahincoming_id_data_po)->first();
            $data->status_bid = 6;
            $data->update();

            $data                                           = Lab1GabahBasah::where('id_lab1_gb', $request->id_gabahincoming_qc)->first();
            $data->status_lab1_gb                           = 6;
            $data->hampa_gb                                 = $request->hampa;
            $data->broken_gb                                = $request->broken;
            $data->randoman_gb                              = $request->randoman;
            $data->kadar_air_gb                             = $request->kadar_air;
            $data->created_at_gb                            = date('Y-m-d H:i:s');
            $data->keterangan_lab_gb                        = $request->keterangan_lab1;
            $data->plan_harga_gb                            = $request->plan_harga;
            $data->output_lab_gb                            = $request->keterangan_lab_1;
            $data->kg_after_adjust_hampa_gb                 = $request->kg_after_adjust_hampa;
            $data->prosentasi_kg_gb                         = $request->prosentasi_kg;
            $data->susut_gb                                 = $request->susut;
            $data->adjust_susut_gb                          = $request->adjust_susut;
            $data->prsentase_ks_kg_after_adjust_susut_gb    = $request->prsentase_ks_kg_after_adjust_susut;
            $data->prsentase_kg_pk_gb                       = $request->prsentase_kg_pk;
            $data->adjust_prosentase_kg_pk_gb               = $request->adjust_prosentase_kg_pk;
            $data->presentase_ks_pk_gb                      = $request->presentase_ks_pk;
            $data->presentase_putih_gb                      = $request->presentase_putih;
            $data->adjust_prosentase_kg_ke_putih_gb         = $request->adjust_prosentase_kg_ke_putih;
            $data->plan_rend_dari_ks_beras_gb               = $request->plan_rend_dari_ks_beras;
            $data->katul_gb                                 = $request->katul;
            $data->refraksi_broken_gb                       = $request->refraksi_broken;
            $data->plan_harga_gabah_gb                      = $request->plan_harga_gabah;
            $data->ka_kg_gb                                 = $request->ka_kg;
            $data->berat_sample_awal_ks_gb                  = $request->berat_sample_awal_ks;
            $data->berat_sample_awal_kg_gb                  = $request->berat_sample_awal_kg;
            $data->berat_sample_akhir_kg_gb                 = $request->berat_sample_akhir_kg;
            $data->berat_sample_pk_gb                       = $request->berat_sample_pk;
            $data->wh_gb                                    = $request->wh;
            $data->tp_gb                                    = $request->tp;
            $data->md_gb                                    = $request->md;
            $data->lokasi_bongkar_gb                        = NULL;
            $data->lokasi_gt_gb                             = NULL;
            $data->antrian1_gb                              = NULL;
            $data->antrian2_gb                              = NULL;
            $data->status_approved                          = NULL;
            $data->update();

            // LOG
            $log                               = new LogAktivityLab();
            $log->nama_user                    = Auth::guard('lab')->user()->name_qc;
            $log->id_objek_aktivitas_lab       = $data->id_lab1_gb;
            $log->aktivitas_lab                = 'Update LAB 1 Kode PO:' . $data->lab1_kode_po_gb . ' Status : ' . $request->keterangan_lab_1 . ' HASIL LAB 1 HAMPA: ' . $request->hampa .
                ' BROKEN : '                                . $request->broken .
                ' RANDOMAN :'                              . $request->randoman .
                ' KADAR AIR : '                             . $request->kadar_air .
                ' KETERANGAN LAB : '                        . $request->keterangan_lab1 .
                ' PLAN HARGA : '                            . $request->plan_harga .
                ' OUTPUT LAB : '                            . $request->keterangan_lab_1 .
                ' KG AFTER ADJUST HAPMA : '                 . $request->kg_after_adjust_hampa .
                ' PROSENTASE KG : '                         . $request->prosentasi_kg .
                ' SUSUT : '                                 . $request->susut .
                ' ADJUST SUSUT : '                          . $request->adjust_susut .
                ' PRESENTASE KS KG AFTER ADJUST SUSUT : '    . $request->prsentase_ks_kg_after_adjust_susut .
                ' PRESENTASE KG PK : '                      . $request->prsentase_kg_pk .
                ' ADJUST PROSENTASE KG PK : '              . $request->adjust_prosentase_kg_pk .
                ' PRESENTASE KS PK : '                      . $request->presentase_ks_pk .
                ' PRESENTASE PUTIH : '                      . $request->presentase_putih .
                ' ADJUST PROSENTASE KG KE PUTIH : '         . $request->adjust_prosentase_kg_ke_putih .
                ' PLAN REND DARI KS BERAS : '              . $request->plan_rend_dari_ks_beras .
                ' KATUL : '                                . $request->katul .
                ' REFRAKSI BROKEN : '                       . $request->refraksi_broken .
                ' PLAN HARGA GABAH : '                     . $request->plan_harga_gabah .
                ' KA KG : '                                  . $request->ka_kg .
                ' BERAT SAMPLE AWAL KS '                  . $request->berat_sample_awal_ks .
                ' BERAT SAMPLE AWAL KG '                  . $request->berat_sample_awal_kg .
                ' BERAT SAMPLE AKHIR KG'                 . $request->berat_sample_akhir_kg .
                ' BERAT SAMPLE PK : '                      . $request->berat_sample_pk .
                ' WH : '                                    . $request->wh .
                ' TP : '                                    . $request->tp .
                ' MD : '                                    . $request->md;
            $log->keterangan_aktivitas         = 'Selesai';
            $log->created_at                   = date('Y-m-d H:i:s');
            $log->save();

            $po = trackerPO::where('kode_po_tracker', $data->lab1_kode_po_gb)->first();
            $po->nama_admin_tracker  = Auth::guard('lab')->user()->name_qc;
            $po->pengajuan_approve_lab1_tracker  = NULL;
            $po->proses_tracker  = 'update LAB 1';
            $po->lab1_tracker  = date('Y-m-d H:i:s');
            $po->update();
        } elseif ($request->keterangan_lab_1 == 'Pending') {
            $data = PenerimaanPO::where('id_penerimaan_po', $request->gabahincoming_id_penerimaan_po)->first();
            $data->status_penerimaan = 16;
            $data->update();

            $data = DataPO::where('id_data_po', $request->gabahincoming_id_data_po)->first();
            $data->status_bid = 16;
            $data->update();

            $data                                           = Lab1GabahBasah::where('id_lab1_gb', $request->id_gabahincoming_qc)->first();
            $data->status_lab1_gb                           = 16;
            $data->hampa_gb                                 = $request->hampa;
            $data->broken_gb                                = $request->broken;
            $data->randoman_gb                              = $request->randoman;
            $data->kadar_air_gb                             = $request->kadar_air;
            $data->created_at_gb                            = date('Y-m-d H:i:s');
            $data->keterangan_lab_gb                        = $request->keterangan_lab1;
            $data->plan_harga_gb                            = $request->plan_harga;
            $data->output_lab_gb                            = $request->keterangan_lab_1;
            $data->kg_after_adjust_hampa_gb                 = $request->kg_after_adjust_hampa;
            $data->prosentasi_kg_gb                         = $request->prosentasi_kg;
            $data->susut_gb                                 = $request->susut;
            $data->adjust_susut_gb                          = $request->adjust_susut;
            $data->prsentase_ks_kg_after_adjust_susut_gb    = $request->prsentase_ks_kg_after_adjust_susut;
            $data->prsentase_kg_pk_gb                       = $request->prsentase_kg_pk;
            $data->adjust_prosentase_kg_pk_gb               = $request->adjust_prosentase_kg_pk;
            $data->presentase_ks_pk_gb                      = $request->presentase_ks_pk;
            $data->presentase_putih_gb                      = $request->presentase_putih;
            $data->adjust_prosentase_kg_ke_putih_gb         = $request->adjust_prosentase_kg_ke_putih;
            $data->plan_rend_dari_ks_beras_gb               = $request->plan_rend_dari_ks_beras;
            $data->katul_gb                                 = $request->katul;
            $data->refraksi_broken_gb                       = $request->refraksi_broken;
            $data->plan_harga_gabah_gb                      = $request->plan_harga_gabah;
            $data->ka_kg_gb                                 = $request->ka_kg;
            $data->berat_sample_awal_ks_gb                  = $request->berat_sample_awal_ks;
            $data->berat_sample_awal_kg_gb                  = $request->berat_sample_awal_kg;
            $data->berat_sample_akhir_kg_gb                 = $request->berat_sample_akhir_kg;
            $data->berat_sample_pk_gb                       = $request->berat_sample_pk;
            $data->wh_gb                                    = $request->wh;
            $data->tp_gb                                    = $request->tp;
            $data->md_gb                                    = $request->md;
            $data->lokasi_bongkar_gb                        = NULL;
            $data->lokasi_gt_gb                             = NULL;
            $data->antrian1_gb                              = NULL;
            $data->antrian2_gb                              = NULL;
            $data->status_approved                          = NULL;
            $data->status_pending                           = $request->status_pending;
            $data->update();

            // LOG
            $log                               = new LogAktivityLab();
            $log->nama_user                    = Auth::guard('lab')->user()->name_qc;
            $log->id_objek_aktivitas_lab       = $data->id_lab1_gb;
            $log->aktivitas_lab                = 'Update LAB 1 Kode PO:' . $data->lab1_kode_po_gb . ' Status : ' . $request->keterangan_lab_1 . ' HASIL LAB 1 HAMPA: ' . $request->hampa .
                ' BROKEN : '                                . $request->broken .
                ' RANDOMAN :'                              . $request->randoman .
                ' KADAR AIR : '                             . $request->kadar_air .
                ' KETERANGAN LAB : '                        . $request->keterangan_lab1 .
                ' PLAN HARGA : '                            . $request->plan_harga .
                ' OUTPUT LAB : '                            . $request->keterangan_lab_1 .
                ' KG AFTER ADJUST HAPMA : '                 . $request->kg_after_adjust_hampa .
                ' PROSENTASE KG : '                         . $request->prosentasi_kg .
                ' SUSUT : '                                 . $request->susut .
                ' ADJUST SUSUT : '                          . $request->adjust_susut .
                ' PRESENTASE KS KG AFTER ADJUST SUSUT : '    . $request->prsentase_ks_kg_after_adjust_susut .
                ' PRESENTASE KG PK : '                      . $request->prsentase_kg_pk .
                ' ADJUST PROSENTASE KG PK : '              . $request->adjust_prosentase_kg_pk .
                ' PRESENTASE KS PK : '                      . $request->presentase_ks_pk .
                ' PRESENTASE PUTIH : '                      . $request->presentase_putih .
                ' ADJUST PROSENTASE KG KE PUTIH : '         . $request->adjust_prosentase_kg_ke_putih .
                ' PLAN REND DARI KS BERAS : '              . $request->plan_rend_dari_ks_beras .
                ' KATUL : '                                . $request->katul .
                ' REFRAKSI BROKEN : '                       . $request->refraksi_broken .
                ' PLAN HARGA GABAH : '                     . $request->plan_harga_gabah .
                ' KA KG : '                                  . $request->ka_kg .
                ' BERAT SAMPLE AWAL KS '                  . $request->berat_sample_awal_ks .
                ' BERAT SAMPLE AWAL KG '                  . $request->berat_sample_awal_kg .
                ' BERAT SAMPLE AKHIR KG'                 . $request->berat_sample_akhir_kg .
                ' BERAT SAMPLE PK : '                      . $request->berat_sample_pk .
                ' WH : '                                    . $request->wh .
                ' TP : '                                    . $request->tp .
                ' MD : '                                    . $request->md;
            $log->keterangan_aktivitas         = 'Selesai';
            $log->created_at                   = date('Y-m-d H:i:s');
            $log->save();

            //              $curl = curl_init();
            //                          curl_setopt_array($curl, array(
            //                              CURLOPT_URL => 'https://api.fonnte.com/send',
            //                              CURLOPT_RETURNTRANSFER => true,
            //                              CURLOPT_ENCODING => '',
            //                              CURLOPT_MAXREDIRS => 10,
            //                              CURLOPT_TIMEOUT => 0,
            //                              CURLOPT_FOLLOWLOCATION => true,
            //                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //                              CURLOPT_CUSTOMREQUEST => 'POST',
            //                              CURLOPT_POSTFIELDS => array(
            //                                  'target' => $request->no_supplier,
            //                                  'message' =>
            //                                  "PEMBERITAHUAN!

            // Hallo *$request->nama_supplier*


            // *PT SURYA PANGAN SEMESTA NGAWI* Ingin menyampaikan informasi bahwa PO : *" . $request->gabahincoming_kode_po . "*, Nopol : *". $request->gabahincoming_plat ."* Dinyatakan *PENDING HARGA* , Harga Gabah Incoming : ". rupiah($request->plan_harga_gabah,) .".
            // Mohon segera Konfirmasi *Bongkar* atau *Tidak*

            // Terima kasih
            // _Sent Via *PT SURYA PANGAN SEMESTA NGAWI*_",
            //                                  'countryCode' => '62', //optional
            //                              ),
            //                              CURLOPT_HTTPHEADER => array(
            //                                  'Authorization: t37BRkrNu+4F!rUJXQdB' //change TOKEN to your actual token
            //                              ),
            //                          ));

            //                          $response = curl_exec($curl);
            //                          if (curl_errno($curl)) {
            //                              $error_msg = curl_error($curl);
            //                          }
            //                          curl_close($curl);

            //                          if (isset($error_msg)) {
            //                              echo $error_msg;
            //                          }
            //                          echo $response;

            $po = trackerPO::where('kode_po_tracker', $data->lab1_kode_po_gb)->first();
            $po->nama_admin_tracker  = Auth::guard('lab')->user()->name_qc;
            $po->status_po_tracker  = '16';
            $po->proses_tracker  = 'PO PENDING HARGA';
            $po->pengajuan_approve_lab1_tracker  = NULL;
            $po->lab1_tracker  = date('Y-m-d H:i:s');
            $po->update();
        } else {
            $data = PenerimaanPO::where('id_penerimaan_po', $request->gabahincoming_id_penerimaan_po)->first();
            $data->status_penerimaan = 5;
            $data->update();

            $data = DataPO::where('id_data_po', $request->gabahincoming_id_data_po)->first();
            $data->status_bid = 5;
            $data->update();

            $data                                           = Lab1GabahBasah::where('id_lab1_gb', $request->id_gabahincoming_qc)->first();
            $data->status_lab1_gb                           = 5;
            $data->hampa_gb                                 = $request->hampa;
            $data->broken_gb                                = $request->broken;
            $data->randoman_gb                              = $request->randoman;
            $data->kadar_air_gb                             = $request->kadar_air;
            $data->created_at_gb                            = date('Y-m-d H:i:s');
            $data->keterangan_lab_gb                        = $request->keterangan_lab1;
            $data->plan_harga_gb                            = $request->plan_harga;
            $data->output_lab_gb                            = $request->keterangan_lab_1;
            $data->kg_after_adjust_hampa_gb                 = $request->kg_after_adjust_hampa;
            $data->prosentasi_kg_gb                         = $request->prosentasi_kg;
            $data->susut_gb                                 = $request->susut;
            $data->adjust_susut_gb                          = $request->adjust_susut;
            $data->prsentase_ks_kg_after_adjust_susut_gb    = $request->prsentase_ks_kg_after_adjust_susut;
            $data->prsentase_kg_pk_gb                       = $request->prsentase_kg_pk;
            $data->adjust_prosentase_kg_pk_gb               = $request->adjust_prosentase_kg_pk;
            $data->presentase_ks_pk_gb                      = $request->presentase_ks_pk;
            $data->presentase_putih_gb                      = $request->presentase_putih;
            $data->adjust_prosentase_kg_ke_putih_gb         = $request->adjust_prosentase_kg_ke_putih;
            $data->plan_rend_dari_ks_beras_gb               = $request->plan_rend_dari_ks_beras;
            $data->katul_gb                                 = $request->katul;
            $data->refraksi_broken_gb                       = $request->refraksi_broken;
            $data->plan_harga_gabah_gb                      = $request->plan_harga_gabah;
            $data->ka_kg_gb                                 = $request->ka_kg;
            $data->berat_sample_awal_ks_gb                  = $request->berat_sample_awal_ks;
            $data->berat_sample_awal_kg_gb                  = $request->berat_sample_awal_kg;
            $data->berat_sample_akhir_kg_gb                 = $request->berat_sample_akhir_kg;
            $data->berat_sample_pk_gb                       = $request->berat_sample_pk;
            $data->wh_gb                                    = $request->wh;
            $data->tp_gb                                    = $request->tp;
            $data->md_gb                                    = $request->md;
            $data->lokasi_bongkar_gb                        = NULL;
            $data->lokasi_gt_gb                             = NULL;
            $data->antrian1_gb                              = NULL;
            $data->antrian2_gb                              = NULL;
            $data->status_approved                          = NULL;
            $data->status_pending                           = $request->status_pending;
            $data->update();

            // LOG
            $log                               = new LogAktivityLab();
            $log->nama_user                    = Auth::guard('lab')->user()->name_qc;
            $log->id_objek_aktivitas_lab       = $data->id_lab1_gb;
            $log->aktivitas_lab                = 'Update LAB 1 Kode PO:' . $data->lab1_kode_po_gb . ' Status : ' . $request->keterangan_lab_1 . ' HASIL LAB 1 HAMPA: ' . $request->hampa .
                ' BROKEN : '                                . $request->broken .
                ' RANDOMAN :'                              . $request->randoman .
                ' KADAR AIR : '                             . $request->kadar_air .
                ' KETERANGAN LAB : '                        . $request->keterangan_lab1 .
                ' PLAN HARGA : '                            . $request->plan_harga .
                ' OUTPUT LAB : '                            . $request->keterangan_lab_1 .
                ' KG AFTER ADJUST HAPMA : '                 . $request->kg_after_adjust_hampa .
                ' PROSENTASE KG : '                         . $request->prosentasi_kg .
                ' SUSUT : '                                 . $request->susut .
                ' ADJUST SUSUT : '                          . $request->adjust_susut .
                ' PRESENTASE KS KG AFTER ADJUST SUSUT : '    . $request->prsentase_ks_kg_after_adjust_susut .
                ' PRESENTASE KG PK : '                      . $request->prsentase_kg_pk .
                ' ADJUST PROSENTASE KG PK : '              . $request->adjust_prosentase_kg_pk .
                ' PRESENTASE KS PK : '                      . $request->presentase_ks_pk .
                ' PRESENTASE PUTIH : '                      . $request->presentase_putih .
                ' ADJUST PROSENTASE KG KE PUTIH : '         . $request->adjust_prosentase_kg_ke_putih .
                ' PLAN REND DARI KS BERAS : '              . $request->plan_rend_dari_ks_beras .
                ' KATUL : '                                . $request->katul .
                ' REFRAKSI BROKEN : '                       . $request->refraksi_broken .
                ' PLAN HARGA GABAH : '                     . $request->plan_harga_gabah .
                ' KA KG : '                                  . $request->ka_kg .
                ' BERAT SAMPLE AWAL KS '                  . $request->berat_sample_awal_ks .
                ' BERAT SAMPLE AWAL KG '                  . $request->berat_sample_awal_kg .
                ' BERAT SAMPLE AKHIR KG'                 . $request->berat_sample_akhir_kg .
                ' BERAT SAMPLE PK : '                      . $request->berat_sample_pk .
                ' WH : '                                    . $request->wh .
                ' TP : '                                    . $request->tp .
                ' MD : '                                    . $request->md;
            $log->keterangan_aktivitas         = 'Selesai';
            $log->created_at                   = date('Y-m-d H:i:s');
            $log->save();

            $po = trackerPO::where('kode_po_tracker', $data->lab1_kode_po_gb)->first();
            $po->nama_admin_tracker  = Auth::guard('lab')->user()->name_qc;
            $po->status_po_tracker  = '5';
            $po->proses_tracker  = 'PO TOLAK KUALITAS';
            $po->pengajuan_approve_lab1_tracker  = NULL;
            $po->lab1_tracker  = date('Y-m-d H:i:s');
            $po->update();
        }
        return response()->json($data);
    }
    public function update_proseslab1_pecah_kulit(Request $request)
    {
        DB::table('lab1_pk')->where('lab1_id_penerimaan_po_pk', $request->lab1_id_penerimaan_po_pk)->where('id_lab1_pk', $request->id_lab1_pk)
            ->update([
                'ka_pk'                                   => $request->ka_pk,
                'pk_pk'                                   => $request->pk_pk,
                'pk_bersih_pk'                            => $request->pk_bersih_pk,
                'beras_pk'                                => $request->beras_pk,
                'butir_patah_pk'                          => $request->butir_patah_pk,
                'hampa_pk'                                => $request->hampa_pk,
                'katul_pk'                                => $request->katul_pk,
                'wh_pk'                                   => $request->wh_pk,
                'tr_pk'                                   => $request->tr_pk,
                'md_pk'                                   => $request->md_pk,
                'output_lab_pk'                           => $request->output_lab_pk,
                'lokasi_bongkar_pk'                       => $request->lokasi_bongkar_pk,
                'keterangan_lab_pk'                       => $request->keterangan_lab_pk,
                'presentase_hampa_pk'                     => $request->presentase_hampa_pk,
                'presentase_pk_bersih_pk'                 => $request->presentase_pk_bersih_pk,
                'presentase_katul_pk'                     => $request->presentase_katul_pk,
                'presentase_beras_pk'                     => $request->presentase_beras_pk,
                'presentase_butir_patah_pk'               => $request->presentase_butir_patah_pk,
                'presentase_butir_patah_beras_pk'         => $request->presentase_butir_patah_beras_pk,
                'presentase_butir_patah_beras_adjust_pk'  => $request->presentase_butir_patah_beras_adjust_pk,
                'refraksi_ka_pk'                          => $request->refraksi_ka_pk,
                'refraksi_hampa_pk'                       => $request->refraksi_hampa_pk,
                'refraksi_katul_pk'                       => $request->refraksi_katul_pk,
                'refraksi_tr_pk'                          => $request->refraksi_tr_pk,
                'refraksi_butir_patah_pk'                 => $request->refraksi_butir_patah_pk,
                'reward_hampa_pk'                         => $request->reward_hampa_pk,
                'reward_katul_pk'                         => $request->reward_katul_pk,
                'reward_tr_pk'                            => $request->reward_tr_pk,
                'reward_butir_patah_pk'                   => $request->reward_butir_patah_pk,

                'plan_kualitas_pk'                        => $request->plan_kualitas_pk,
                'harga_atas_pk'                           => $request->harga_atas_pk,
                'harga_incoming_pk'                       => $request->harga_incoming_pk,
                'status_approved'                         => NULL,
                'created_at_approved'                     => NULL,
                'plan_harga_aktual_pk'                    => $request->plan_harga_aktual_pk,
                'aktual_kualitas_pk'                      => $request->aktual_kualitas_pk,
                'harga_awal_pk'                           => $request->harga_awal_pk,
                'harga_akhir_pk'                          => $request->harga_awal_pk,
                'updated_at_pk'                           => date('Y-m-d H:i:s'),
            ]);
        if ($request->output_lab_pk == 'Pending') {
            $update_status_penerimaan_po = DB::table('penerimaan_po')->where('id_penerimaan_po', $request->lab1_id_penerimaan_po_pk)->where('penerimaan_kode_po', $request->lab1_kode_po_pk)
                ->update(['status_penerimaan' => 16]);

            $update_status_data_po = DB::table('data_po')->where('id_data_po', $request->lab1_id_data_po_pk)->where('kode_po', $request->lab1_kode_po_pk)
                ->update(['status_bid' => 16]);
            $update_status_lab1pk = DB::table('lab1_pk')->where('lab1_id_penerimaan_po_pk', $request->lab1_id_penerimaan_po_pk)->where('lab1_kode_po_pk', $request->lab1_kode_po_pk)
                ->update(['aksi_harga_pk' => 'Pending', 'status_lab1_pk' => 16]);
        } else if ($request->output_lab_pk == 'Reject') {
            $update_status_penerimaan_po = DB::table('penerimaan_po')->where('id_penerimaan_po', $request->lab1_id_penerimaan_po_pk)->where('penerimaan_kode_po', $request->lab1_kode_po_pk)
                ->update(['status_penerimaan' => 5]);

            $update_status_data_po = DB::table('data_po')->where('id_data_po', $request->lab1_id_data_po_pk)->where('kode_po', $request->lab1_kode_po_pk)
                ->update(['status_bid' => 5]);
            $update_status_lab1pk = DB::table('lab1_pk')->where('lab1_id_penerimaan_po_pk', $request->lab1_id_penerimaan_po_pk)->where('lab1_kode_po_pk', $request->lab1_kode_po_pk)
                ->update(['aksi_harga_pk' => 'Reject', 'status_lab1_pk' => 5]);
        } else {
            $update_status_penerimaan_po = DB::table('penerimaan_po')->where('id_penerimaan_po', $request->lab1_id_penerimaan_po_pk)->where('penerimaan_kode_po', $request->lab1_kode_po_pk)
                ->update(['status_penerimaan' => 6]);

            $update_status_data_po = DB::table('data_po')->where('id_data_po', $request->lab1_id_data_po_pk)->where('kode_po', $request->lab1_kode_po_pk)
                ->update(['status_bid' => 6]);
        }
        return redirect()->back();
    }

    public function unload_lab1_gabah_basah()
    {
        return view('dashboard.admin_qc.unload_lab1_gabah_basah');
    }
    public function unload_lab1_gabah_basah_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))

                    ->where('bid.name_bid', 'LIKE', '%GABAH BASAH%')
                    ->where('lab1_gb.output_lab_gb', '=', 'Unload')
                    ->orderBy('id_lab1_gb', 'desc')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->output_lab_gb == 'Unload') {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Unload 
                    </a>';
                        } else {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Pending 
                    </a>';
                        }
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result;
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result;
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result;
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result;
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result;
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })

                    ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            } else {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')

                    ->where('bid.name_bid', 'LIKE', '%GABAH BASAH%')
                    ->where('lab1_gb.output_lab_gb', '=', 'Unload')
                    ->orderBy('id_lab1_gb', 'desc')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = $list->waktu_penerimaan;
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->output_lab_gb == 'Unload') {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Unload 
                    </a>';
                        } else {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Pending 
                    </a>';
                        }
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result;
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result;
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result;
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result;
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result;
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })

                    ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            }
        }
    }
    public function unload_lab1_pecah_kulit()
    {
        return view('dashboard.admin_qc.unload_lab1_pecah_kulit');
    }
    public function unload_lab1_pecah_kulit_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_pk', 'lab1_pk.lab1_id_data_po_pk', '=', 'data_po.id_data_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))

                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->where('lab1_pk.output_lab_pk', '=', 'Unload')
                    ->orderBy('id_lab1_pk', 'desc')
                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = $list->waktu_penerimaan;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = $list->open_po;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('ka_pk', function ($list) {
                        $result = $list->ka_pk . '%';
                        return $result;
                    })
                    ->addColumn('pk_pk', function ($list) {
                        $result = $list->pk_pk;
                        return $result;
                    })
                    ->addColumn('pk_bersih_pk', function ($list) {
                        $result = $list->pk_bersih_pk . '%';
                        return $result;
                    })
                    ->addColumn('beras_pk', function ($list) {
                        $result = $list->beras_pk;
                        return $result;
                    })
                    ->addColumn('butir_patah_pk', function ($list) {
                        $result = $list->butir_patah_pk;
                        return $result;
                    })
                    ->addColumn('hampa_pk', function ($list) {
                        $result = $list->hampa_pk;
                        return $result;
                    })
                    ->addColumn('katul_pk', function ($list) {
                        $result = $list->katul_pk;
                        return $result;
                    })
                    ->addColumn('wh_pk', function ($list) {
                        $result = $list->wh_pk . '%';
                        return $result;
                    })
                    ->addColumn('tr_pk', function ($list) {
                        $result = $list->tr_pk . '%';
                        return $result;
                    })
                    ->addColumn('md_pk', function ($list) {
                        $result = $list->md_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_hampa_pk', function ($list) {
                        $result = $list->presentase_hampa_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_pk_bersih_pk', function ($list) {
                        $result = $list->presentase_pk_bersih_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_katul_pk', function ($list) {
                        $result = $list->presentase_katul_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_beras_pk', function ($list) {
                        $result = $list->presentase_beras_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_butir_patah_pk', function ($list) {
                        $result = $list->presentase_butir_patah_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_butir_patah_beras_pk', function ($list) {
                        $result = $list->presentase_butir_patah_beras_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_butir_patah_beras_adjust_pk', function ($list) {
                        $result = $list->presentase_butir_patah_beras_adjust_pk . '%';
                        return $result;
                    })
                    ->addColumn('refraksi_ka_pk', function ($list) {
                        if ($list->refraksi_ka_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_ka_pk);
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_hampa_pk', function ($list) {
                        if ($list->refraksi_hampa_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_hampa_pk);
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_katul_pk', function ($list) {
                        if ($list->refraksi_katul_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_katul_pk);
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_tr_pk', function ($list) {
                        if ($list->refraksi_tr_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_tr_pk);
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_butir_patah_pk', function ($list) {
                        if ($list->refraksi_butir_patah_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_butir_patah_pk);
                            return $result;
                        }
                    })
                    ->addColumn('reward_hampa_pk', function ($list) {
                        if ($list->reward_hampa_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_hampa_pk);
                            return $result;
                        }
                    })
                    ->addColumn('reward_katul_pk', function ($list) {
                        if ($list->reward_katul_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_katul_pk);
                            return $result;
                        }
                    })
                    ->addColumn('reward_tr_pk', function ($list) {
                        if ($list->reward_tr_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_tr_pk);
                            return $result;
                        }
                    })
                    ->addColumn('reward_butir_patah_pk', function ($list) {
                        if ($list->reward_butir_patah_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_butir_patah_pk);
                            return $result;
                        }
                    })
                    ->addColumn('plan_kualitas_pk', function ($list) {
                        $result = $list->plan_kualitas_pk;
                        return $result;
                    })
                    ->addColumn('harga_atas_pk', function ($list) {
                        $result = rupiah($list->harga_atas_pk);
                        return $result;
                    })
                    ->addColumn('harga_incoming_pk', function ($list) {
                        $result = rupiah($list->harga_incoming_pk);
                        return $result;
                    })
                    ->addColumn('plan_harga_aktual_pk', function ($list) {
                        $result = rupiah($list->plan_harga_aktual_pk);
                        return $result;
                    })
                    ->addColumn('harga_awal_pk', function ($list) {
                        $result = rupiah($list->harga_awal_pk);
                        return $result;
                    })
                    ->addColumn('reaksi_harga_pk', function ($list) {
                        $result = $list->reaksi_harga_pk;
                        if ($result == '' | $result == null) {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->reaksi_harga_pk);
                        }
                        return $result;
                    })
                    ->addColumn('harga_akhir_pk', function ($list) {
                        $result = $list->harga_akhir_permintaan_pk;
                        if ($result == null | $result == '') {
                            $result = rupiah($list->harga_akhir_pk) . '/Kg';
                            return $result;
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('created_at_pk', function ($list) {
                        $result = $list->created_at_pk;
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->output_lab_pk == 'Unload') {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Unload 
                    </a>';
                        } else {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Pending 
                    </a>';
                        }
                    })

                    ->rawColumns([
                        'kode_po',
                        'nama_vendor',
                        'waktu_penerimaan',
                        'tanggal_po',
                        'plat_kendaraan',
                        'asal_gabah',
                        'ka_pk',
                        'pk_pk',
                        'pk_bersih_pk',
                        'beras_pk',
                        'butir_patah_pk',
                        'hampa_pk',
                        'katul_pk',
                        'wh_pk',
                        'tr_pk',
                        'md_pk',
                        'presentase_hampa_pk',
                        'presentase_pk_bersih_pk',
                        'presentase_katul_pk',
                        'presentase_beras_pk',
                        'presentase_butir_patah_pk',
                        'presentase_butir_patah_beras_pk',
                        'presentase_butir_patah_beras_adjust_pk',
                        'refraksi_ka_pk',
                        'refraksi_hampa_pk',
                        'refraksi_katul_pk',
                        'refraksi_tr_pk',
                        'refraksi_butir_patah_pk',
                        'reward_hampa_pk',
                        'reward_katul_pk',
                        'reward_tr_pk',
                        'reward_butir_patah_pk',
                        'plan_kualitas_pk',
                        'harga_atas_pk',
                        'harga_incoming_pk',
                        'plan_harga_aktual_pk',
                        'aktual_kualitas_pk',
                        'harga_awal_pk',
                        'aksi_harga_pk',
                        'reaksi_harga_pk',
                        'harga_akhir_pk',
                        'created_at_pk',
                        'ckelola'
                    ])
                    ->make(true);
            } else {
                $site_qc = QcAdmin::select('site_qc')->where('site_qc', Auth::user()->site_qc)->first();
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_pk', 'lab1_pk.lab1_id_data_po_pk', '=', 'data_po.id_data_po')

                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->where('lab1_pk.output_lab_pk', '=', 'Unload')
                    ->orderBy('id_lab1_pk', 'desc')
                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = $list->waktu_penerimaan;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = $list->open_po;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('ka_pk', function ($list) {
                        $result = $list->ka_pk . '%';
                        return $result;
                    })
                    ->addColumn('pk_pk', function ($list) {
                        $result = $list->pk_pk;
                        return $result;
                    })
                    ->addColumn('pk_bersih_pk', function ($list) {
                        $result = $list->pk_bersih_pk . '%';
                        return $result;
                    })
                    ->addColumn('beras_pk', function ($list) {
                        $result = $list->beras_pk;
                        return $result;
                    })
                    ->addColumn('butir_patah_pk', function ($list) {
                        $result = $list->butir_patah_pk;
                        return $result;
                    })
                    ->addColumn('hampa_pk', function ($list) {
                        $result = $list->hampa_pk;
                        return $result;
                    })
                    ->addColumn('katul_pk', function ($list) {
                        $result = $list->katul_pk;
                        return $result;
                    })
                    ->addColumn('wh_pk', function ($list) {
                        $result = $list->wh_pk . '%';
                        return $result;
                    })
                    ->addColumn('tr_pk', function ($list) {
                        $result = $list->tr_pk . '%';
                        return $result;
                    })
                    ->addColumn('md_pk', function ($list) {
                        $result = $list->md_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_hampa_pk', function ($list) {
                        $result = $list->presentase_hampa_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_pk_bersih_pk', function ($list) {
                        $result = $list->presentase_pk_bersih_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_katul_pk', function ($list) {
                        $result = $list->presentase_katul_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_beras_pk', function ($list) {
                        $result = $list->presentase_beras_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_butir_patah_pk', function ($list) {
                        $result = $list->presentase_butir_patah_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_butir_patah_beras_pk', function ($list) {
                        $result = $list->presentase_butir_patah_beras_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_butir_patah_beras_adjust_pk', function ($list) {
                        $result = $list->presentase_butir_patah_beras_adjust_pk . '%';
                        return $result;
                    })
                    ->addColumn('refraksi_ka_pk', function ($list) {
                        if ($list->refraksi_ka_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_ka_pk);
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_hampa_pk', function ($list) {
                        if ($list->refraksi_hampa_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_hampa_pk);
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_katul_pk', function ($list) {
                        if ($list->refraksi_katul_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_katul_pk);
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_tr_pk', function ($list) {
                        if ($list->refraksi_tr_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_tr_pk);
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_butir_patah_pk', function ($list) {
                        if ($list->refraksi_butir_patah_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_butir_patah_pk);
                            return $result;
                        }
                    })
                    ->addColumn('reward_hampa_pk', function ($list) {
                        if ($list->reward_hampa_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_hampa_pk);
                            return $result;
                        }
                    })
                    ->addColumn('reward_katul_pk', function ($list) {
                        if ($list->reward_katul_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_katul_pk);
                            return $result;
                        }
                    })
                    ->addColumn('reward_tr_pk', function ($list) {
                        if ($list->reward_tr_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_tr_pk);
                            return $result;
                        }
                    })
                    ->addColumn('reward_butir_patah_pk', function ($list) {
                        if ($list->reward_butir_patah_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_butir_patah_pk);
                            return $result;
                        }
                    })
                    ->addColumn('plan_kualitas_pk', function ($list) {
                        $result = $list->plan_kualitas_pk;
                        return $result;
                    })
                    ->addColumn('harga_atas_pk', function ($list) {
                        $result = rupiah($list->harga_atas_pk);
                        return $result;
                    })
                    ->addColumn('harga_incoming_pk', function ($list) {
                        $result = rupiah($list->harga_incoming_pk);
                        return $result;
                    })
                    ->addColumn('plan_harga_aktual_pk', function ($list) {
                        $result = rupiah($list->plan_harga_aktual_pk);
                        return $result;
                    })
                    ->addColumn('harga_awal_pk', function ($list) {
                        $result = rupiah($list->harga_awal_pk);
                        return $result;
                    })
                    ->addColumn('reaksi_harga_pk', function ($list) {
                        $result = $list->reaksi_harga_pk;
                        if ($result == '' | $result == null) {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->reaksi_harga_pk);
                        }
                        return $result;
                    })
                    ->addColumn('harga_akhir_pk', function ($list) {
                        $result = $list->harga_akhir_permintaan_pk;
                        if ($result == null | $result == '') {
                            $result = rupiah($list->harga_akhir_pk) . '/Kg';
                            return $result;
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('created_at_pk', function ($list) {
                        $result = $list->created_at_pk;
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->output_lab_pk == 'Unload') {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Unload 
                    </a>';
                        } else {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Pending 
                    </a>';
                        }
                    })

                    ->rawColumns([
                        'kode_po',
                        'nama_vendor',
                        'waktu_penerimaan',
                        'tanggal_po',
                        'plat_kendaraan',
                        'asal_gabah',
                        'ka_pk',
                        'pk_pk',
                        'pk_bersih_pk',
                        'beras_pk',
                        'butir_patah_pk',
                        'hampa_pk',
                        'katul_pk',
                        'wh_pk',
                        'tr_pk',
                        'md_pk',
                        'presentase_hampa_pk',
                        'presentase_pk_bersih_pk',
                        'presentase_katul_pk',
                        'presentase_beras_pk',
                        'presentase_butir_patah_pk',
                        'presentase_butir_patah_beras_pk',
                        'presentase_butir_patah_beras_adjust_pk',
                        'refraksi_ka_pk',
                        'refraksi_hampa_pk',
                        'refraksi_katul_pk',
                        'refraksi_tr_pk',
                        'refraksi_butir_patah_pk',
                        'reward_hampa_pk',
                        'reward_katul_pk',
                        'reward_tr_pk',
                        'reward_butir_patah_pk',
                        'plan_kualitas_pk',
                        'harga_atas_pk',
                        'harga_incoming_pk',
                        'plan_harga_aktual_pk',
                        'aktual_kualitas_pk',
                        'harga_awal_pk',
                        'aksi_harga_pk',
                        'reaksi_harga_pk',
                        'harga_akhir_pk',
                        'created_at_pk',
                        'ckelola'
                    ])
                    ->make(true);
            }
        }
    }
    public function pending_lab1_gabah_basah()
    {
        return view('dashboard.admin_qc.pending_lab1_gabah_basah');
    }
    public function pending_lab1_gabah_basah_ciherang_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))

                    ->where('bid.name_bid', '=', 'GABAH BASAH CIHERANG')
                    ->where('lab1_gb.output_lab_gb', '=', 'Pending')
                    ->orderBy('id_lab1_gb', 'desc')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->output_lab_gb == 'Unload') {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Unload 
                    </a>';
                        } else {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Pending 
                    </a>';
                        }
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result;
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result;
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result;
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result;
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result;
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })

                    ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            } else {
                $site_qc = QcAdmin::select('site_qc')->where('site_qc', Auth::user()->site_qc)->first();
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')

                    ->where('bid.name_bid', '=', 'GABAH BASAH CIHERANG')
                    ->where('lab1_gb.output_lab_gb', '=', 'Pending')
                    ->orderBy('id_lab1_gb', 'desc')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = $list->waktu_penerimaan;
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->output_lab_gb == 'Unload') {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Unload 
                    </a>';
                        } else {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Pending 
                    </a>';
                        }
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result;
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result;
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result;
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result;
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result;
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })

                    ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            }
        }
    }
    public function pending_lab1_gabah_basah_longgrain_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))

                    ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
                    ->where('lab1_gb.output_lab_gb', '=', 'Pending')
                    ->orderBy('id_lab1_gb', 'desc')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->output_lab_gb == 'Unload') {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Unload 
                    </a>';
                        } else {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Pending 
                    </a>';
                        }
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result;
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result;
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result;
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result;
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result;
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })

                    ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            } else {
                $site_qc = QcAdmin::select('site_qc')->where('site_qc', Auth::user()->site_qc)->first();
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')

                    ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
                    ->where('lab1_gb.output_lab_gb', '=', 'Pending')
                    ->orderBy('id_lab1_gb', 'desc')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = $list->waktu_penerimaan;
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->output_lab_gb == 'Unload') {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Unload 
                    </a>';
                        } else {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Pending 
                    </a>';
                        }
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result;
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result;
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result;
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result;
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result;
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })

                    ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            }
        }
    }
    public function pending_lab1_gabah_basah_pandan_wangi_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))

                    ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
                    ->where('lab1_gb.output_lab_gb', '=', 'Pending')
                    ->orderBy('id_lab1_gb', 'desc')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->output_lab_gb == 'Unload') {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Unload 
                    </a>';
                        } else {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Pending 
                    </a>';
                        }
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result;
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result;
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result;
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result;
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result;
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })

                    ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            } else {
                $site_qc = QcAdmin::select('site_qc')->where('site_qc', Auth::user()->site_qc)->first();
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')

                    ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
                    ->where('lab1_gb.output_lab_gb', '=', 'Pending')
                    ->orderBy('id_lab1_gb', 'desc')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = $list->waktu_penerimaan;
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->output_lab_gb == 'Unload') {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Unload 
                    </a>';
                        } else {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Pending 
                    </a>';
                        }
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result;
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result;
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result;
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result;
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result;
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })

                    ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            }
        }
    }
    public function pending_lab1_gabah_basah_ketan_putih_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))

                    ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
                    ->where('lab1_gb.output_lab_gb', '=', 'Pending')
                    ->orderBy('id_lab1_gb', 'desc')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->output_lab_gb == 'Unload') {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Unload 
                    </a>';
                        } else {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Pending 
                    </a>';
                        }
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result;
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result;
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result;
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result;
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result;
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })

                    ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            } else {
                $site_qc = QcAdmin::select('site_qc')->where('site_qc', Auth::user()->site_qc)->first();
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')

                    ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
                    ->where('lab1_gb.output_lab_gb', '=', 'Pending')
                    ->orderBy('id_lab1_gb', 'desc')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = $list->waktu_penerimaan;
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->output_lab_gb == 'Unload') {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Unload 
                    </a>';
                        } else {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Pending 
                    </a>';
                        }
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result;
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result;
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result;
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result;
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result;
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })

                    ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            }
        }
    }
    public function pending_lab1_pecah_kulit()
    {
        return view('dashboard.admin_qc.pending_lab1_pecah_kulit');
    }
    public function pending_lab1_pecah_kulit_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_pk', 'lab1_pk.lab1_id_data_po_pk', '=', 'data_po.id_data_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))

                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->where('lab1_pk.output_lab_pk', '=', 'Pending')
                    ->orderBy('id_lab1_pk', 'desc')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_pk) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->output_lab_pk == 'Unload') {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Unload 
                    </a>';
                        } else {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Pending 
                    </a>';
                        }
                    })
                    //add
                    ->addColumn('kadar_air', function ($list) {
                        $result = $list->kadar_air_pk;
                        return $result;
                    })
                    ->addColumn('ka_kg', function ($list) {
                        $result = $list->ka_kg_pk;
                        return $result;
                    })
                    ->addColumn('berat_sample_awal_ks', function ($list) {
                        $result = $list->berat_sample_awal_ks_pk;
                        return $result;
                    })
                    ->addColumn('berat_sample_awal_kg', function ($list) {
                        $result = $list->berat_sample_awal_kg_pk;
                        return $result;
                    })
                    ->addColumn('berat_sample_akhir_kg', function ($list) {
                        $result = $list->berat_sample_akhir_kg_pk;
                        return $result;
                    })
                    ->addColumn('berat_sample_pk', function ($list) {
                        $result = $list->berat_sample_pk_pk;
                        return $result;
                    })
                    ->addColumn('berat_sample_beras', function ($list) {
                        $result = $list->randoman_pk;
                        return $result;
                    })
                    ->addColumn('wh', function ($list) {
                        $result = $list->wh_pk;
                        return $result;
                    })
                    ->addColumn('tp', function ($list) {
                        $result = $list->tp_pk;
                        return $result;
                    })
                    ->addColumn('md', function ($list) {
                        $result = $list->md_pk;
                        return $result;
                    })
                    ->addColumn('broken', function ($list) {
                        $result = $list->broken_pk;
                        return $result;
                    })

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_pk;
                        return $result;
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_pk;
                        return $result;
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_pk;
                        return $result;
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_pk;
                        return $result;
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_pk;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_pk;
                        return $result;
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_pk;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_pk;
                        return $result;
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_pk;
                        return $result;
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_pk;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_pk;
                        return $result;
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_pk;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_pk;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_pk;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = $list->plan_harga_gabah_pk;
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_gabah_pk;
                        return $result;
                    })

                    ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            } else {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_pk', 'lab1_pk.lab1_id_data_po_pk', '=', 'data_po.id_data_po')

                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->where('lab1_pk.output_lab_pk', '=', 'Pending')
                    ->orderBy('id_lab1_pk', 'desc')
                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = $list->waktu_penerimaan;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = $list->open_po;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('ka_pk', function ($list) {
                        $result = $list->ka_pk . '%';
                        return $result;
                    })
                    ->addColumn('pk_pk', function ($list) {
                        $result = $list->pk_pk;
                        return $result;
                    })
                    ->addColumn('pk_bersih_pk', function ($list) {
                        $result = $list->pk_bersih_pk . '%';
                        return $result;
                    })
                    ->addColumn('beras_pk', function ($list) {
                        $result = $list->beras_pk;
                        return $result;
                    })
                    ->addColumn('butir_patah_pk', function ($list) {
                        $result = $list->butir_patah_pk;
                        return $result;
                    })
                    ->addColumn('hampa_pk', function ($list) {
                        $result = $list->hampa_pk;
                        return $result;
                    })
                    ->addColumn('katul_pk', function ($list) {
                        $result = $list->katul_pk;
                        return $result;
                    })
                    ->addColumn('wh_pk', function ($list) {
                        $result = $list->wh_pk . '%';
                        return $result;
                    })
                    ->addColumn('tr_pk', function ($list) {
                        $result = $list->tr_pk . '%';
                        return $result;
                    })
                    ->addColumn('md_pk', function ($list) {
                        $result = $list->md_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_hampa_pk', function ($list) {
                        $result = $list->presentase_hampa_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_pk_bersih_pk', function ($list) {
                        $result = $list->presentase_pk_bersih_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_katul_pk', function ($list) {
                        $result = $list->presentase_katul_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_beras_pk', function ($list) {
                        $result = $list->presentase_beras_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_butir_patah_pk', function ($list) {
                        $result = $list->presentase_butir_patah_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_butir_patah_beras_pk', function ($list) {
                        $result = $list->presentase_butir_patah_beras_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_butir_patah_beras_adjust_pk', function ($list) {
                        $result = $list->presentase_butir_patah_beras_adjust_pk . '%';
                        return $result;
                    })
                    ->addColumn('refraksi_ka_pk', function ($list) {
                        if ($list->refraksi_ka_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_ka_pk);
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_hampa_pk', function ($list) {
                        if ($list->refraksi_hampa_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_hampa_pk);
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_katul_pk', function ($list) {
                        if ($list->refraksi_katul_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_katul_pk);
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_tr_pk', function ($list) {
                        if ($list->refraksi_tr_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_tr_pk);
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_butir_patah_pk', function ($list) {
                        if ($list->refraksi_butir_patah_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_butir_patah_pk);
                            return $result;
                        }
                    })
                    ->addColumn('reward_hampa_pk', function ($list) {
                        if ($list->reward_hampa_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_hampa_pk);
                            return $result;
                        }
                    })
                    ->addColumn('reward_katul_pk', function ($list) {
                        if ($list->reward_katul_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_katul_pk);
                            return $result;
                        }
                    })
                    ->addColumn('reward_tr_pk', function ($list) {
                        if ($list->reward_tr_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_tr_pk);
                            return $result;
                        }
                    })
                    ->addColumn('reward_butir_patah_pk', function ($list) {
                        if ($list->reward_butir_patah_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_butir_patah_pk);
                            return $result;
                        }
                    })
                    ->addColumn('plan_kualitas_pk', function ($list) {
                        $result = $list->plan_kualitas_pk;
                        return $result;
                    })
                    ->addColumn('harga_atas_pk', function ($list) {
                        $result = rupiah($list->harga_atas_pk);
                        return $result;
                    })
                    ->addColumn('harga_incoming_pk', function ($list) {
                        if ($list->harga_incoming_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->harga_incoming_pk);
                            return $result;
                        }
                    })
                    ->addColumn('plan_harga_aktual_pk', function ($list) {
                        if ($list->plan_harga_aktual_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->plan_harga_aktual_pk);
                            return $result;
                        }
                    })
                    ->addColumn('aktual_kualitas_pk', function ($list) {
                        if ($list->aktual_kualitas_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = $list->aktual_kualitas_pk;
                            return $result;
                        }
                    })
                    ->addColumn('harga_awal_pk', function ($list) {
                        if ($list->harga_awal_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->harga_awal_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('aksi_harga_pk', function ($list) {
                        $result = $list->aksi_harga_pk;
                        return $result;
                    })
                    ->addColumn('reaksi_harga_pk', function ($list) {
                        $result = $list->reaksi_harga_pk;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->reaksi_harga_pk);
                        }
                        return $result;
                    })
                    ->addColumn('harga_akhir_pk', function ($list) {
                        $result = $list->harga_akhir_permintaan_pk;
                        if ($result == null | $result == '') {
                            if ($list->harga_akhir_pk == 'TOLAK') {
                                return 'TOLAK';
                            } else {
                                $result = rupiah($list->harga_akhir_pk) . '/Kg';
                                return $result;
                            }
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('created_at_pk', function ($list) {
                        $result = $list->created_at_pk;
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->output_lab_pk == 'Unload') {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Unload 
                    </a>';
                        } else {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Pending 
                    </a>';
                        }
                    })
                    //add

                    ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'lokasi_bongkar', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            }
        }
    }
    public function reject_lab1_gabah_basah()
    {
        return view('dashboard.admin_qc.reject_lab1_gabah_basah');
    }
    public function reject_lab1_gabah_basah_longgrain_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))

                    ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
                    ->where('lab1_gb.output_lab_gb', '=', 'Reject')
                    ->orderBy('id_lab1_gb', 'desc')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        return
                            '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Reject 
                    </a>';
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result;
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result;
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result;
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result;
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result;
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })

                    ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            } else {
                $site_qc = QcAdmin::select('site_qc')->where('site_qc', Auth::user()->site_qc)->first();
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')

                    ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
                    ->where('lab1_gb.output_lab_gb', '=', 'Reject')
                    ->orderBy('id_lab1_gb', 'desc')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = $list->waktu_penerimaan;
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        return
                            '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Reject 
                    </a>';
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result;
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result;
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result;
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result;
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result;
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })

                    ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            }
        }
    }
    public function reject_lab1_gabah_basah_pandan_wangi_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))

                    ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
                    ->where('lab1_gb.output_lab_gb', '=', 'Reject')
                    ->orderBy('id_lab1_gb', 'desc')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        return
                            '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Reject 
                    </a>';
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result;
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result;
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result;
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result;
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result;
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })

                    ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            } else {
                $site_qc = QcAdmin::select('site_qc')->where('site_qc', Auth::user()->site_qc)->first();
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
                    ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
                    ->where('lab1_gb.output_lab_gb', '=', 'Reject')
                    ->orderBy('id_lab1_gb', 'desc')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = $list->waktu_penerimaan;
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        return
                            '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Reject 
                    </a>';
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result;
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result;
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result;
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result;
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result;
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })

                    ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            }
        }
    }
    public function reject_lab1_gabah_basah_ketan_putih_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))

                    ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
                    ->where('lab1_gb.output_lab_gb', '=', 'Reject')
                    ->orderBy('id_lab1_gb', 'desc')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        return
                            '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Reject 
                    </a>';
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result;
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result;
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result;
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result;
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result;
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })

                    ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            } else {
                $site_qc = QcAdmin::select('site_qc')->where('site_qc', Auth::user()->site_qc)->first();
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
                    ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
                    ->where('lab1_gb.output_lab_gb', '=', 'Reject')
                    ->orderBy('id_lab1_gb', 'desc')
                    ->get())
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = $list->waktu_penerimaan;
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        return
                            '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Reject 
                    </a>';
                    })
                    //add
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
                    ->addColumn('berat_sample_beras', function ($list) {
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

                    //add
                    ->addColumn('hampa', function ($list) {
                        $result = $list->hampa_gb;
                        return $result;
                    })
                    ->addColumn('kg_after_adjust_hampa', function ($list) {
                        $result = $list->kg_after_adjust_hampa_gb;
                        return $result;
                    })
                    ->addColumn('prosentasi_kg', function ($list) {
                        $result = $list->prosentasi_kg_gb;
                        return $result;
                    })
                    ->addColumn('susut', function ($list) {
                        $result = $list->susut_gb;
                        return $result;
                    })
                    ->addColumn('adjust_susut', function ($list) {
                        $result = $list->adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_ks_kg_after_adjust_susut', function ($list) {
                        $result = $list->prsentase_ks_kg_after_adjust_susut_gb;
                        return $result;
                    })
                    ->addColumn('prsentase_kg_pk', function ($list) {
                        $result = $list->prsentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_pk', function ($list) {
                        $result = $list->adjust_prosentase_kg_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_ks_pk', function ($list) {
                        $result = $list->presentase_ks_pk_gb;
                        return $result;
                    })
                    ->addColumn('presentase_putih', function ($list) {
                        $result = $list->presentase_putih_gb;
                        return $result;
                    })
                    ->addColumn('adjust_prosentase_kg_ke_putih', function ($list) {
                        $result = $list->adjust_prosentase_kg_ke_putih_gb;
                        return $result;
                    })
                    ->addColumn('plan_rend_dari_ks_beras', function ($list) {
                        $result = $list->plan_rend_dari_ks_beras_gb;
                        return $result;
                    })
                    ->addColumn('katul', function ($list) {
                        $result = $list->katul_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })

                    ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            }
        }
    }
    public function reject_lab1_pecah_kulit()
    {
        return view('dashboard.admin_qc.reject_lab1_pecah_kulit');
    }
    public function reject_lab1_pecah_kulit_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_pk', 'lab1_pk.lab1_id_data_po_pk', '=', 'data_po.id_data_po')
                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->where('lab1_pk.output_lab_pk', '=', 'Reject')
                    ->orderBy('id_lab1_pk', 'desc')
                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = $list->waktu_penerimaan;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = $list->open_po;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('ka_pk', function ($list) {
                        $result = $list->ka_pk . '%';
                        return $result;
                    })
                    ->addColumn('pk_pk', function ($list) {
                        $result = $list->pk_pk;
                        return $result;
                    })
                    ->addColumn('pk_bersih_pk', function ($list) {
                        $result = $list->pk_bersih_pk . '%';
                        return $result;
                    })
                    ->addColumn('beras_pk', function ($list) {
                        $result = $list->beras_pk;
                        return $result;
                    })
                    ->addColumn('butir_patah_pk', function ($list) {
                        $result = $list->butir_patah_pk;
                        return $result;
                    })
                    ->addColumn('hampa_pk', function ($list) {
                        $result = $list->hampa_pk;
                        return $result;
                    })
                    ->addColumn('katul_pk', function ($list) {
                        $result = $list->katul_pk;
                        return $result;
                    })
                    ->addColumn('wh_pk', function ($list) {
                        $result = $list->wh_pk . '%';
                        return $result;
                    })
                    ->addColumn('tr_pk', function ($list) {
                        $result = $list->tr_pk . '%';
                        return $result;
                    })
                    ->addColumn('md_pk', function ($list) {
                        $result = $list->md_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_hampa_pk', function ($list) {
                        $result = $list->presentase_hampa_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_pk_bersih_pk', function ($list) {
                        $result = $list->presentase_pk_bersih_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_katul_pk', function ($list) {
                        $result = $list->presentase_katul_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_beras_pk', function ($list) {
                        $result = $list->presentase_beras_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_butir_patah_pk', function ($list) {
                        $result = $list->presentase_butir_patah_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_butir_patah_beras_pk', function ($list) {
                        $result = $list->presentase_butir_patah_beras_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_butir_patah_beras_adjust_pk', function ($list) {
                        $result = $list->presentase_butir_patah_beras_adjust_pk . '%';
                        return $result;
                    })
                    ->addColumn('refraksi_ka_pk', function ($list) {
                        if ($list->refraksi_ka_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_ka_pk);
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_hampa_pk', function ($list) {
                        if ($list->refraksi_hampa_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_hampa_pk);
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_katul_pk', function ($list) {
                        if ($list->refraksi_katul_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_katul_pk);
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_tr_pk', function ($list) {
                        if ($list->refraksi_tr_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_tr_pk);
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_butir_patah_pk', function ($list) {
                        if ($list->refraksi_butir_patah_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_butir_patah_pk);
                            return $result;
                        }
                    })
                    ->addColumn('reward_hampa_pk', function ($list) {
                        if ($list->reward_hampa_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_hampa_pk);
                            return $result;
                        }
                    })
                    ->addColumn('reward_katul_pk', function ($list) {
                        if ($list->reward_katul_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_katul_pk);
                            return $result;
                        }
                    })
                    ->addColumn('reward_tr_pk', function ($list) {
                        if ($list->reward_tr_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_tr_pk);
                            return $result;
                        }
                    })
                    ->addColumn('reward_butir_patah_pk', function ($list) {
                        if ($list->reward_butir_patah_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_butir_patah_pk);
                            return $result;
                        }
                    })
                    ->addColumn('plan_kualitas_pk', function ($list) {
                        $result = $list->plan_kualitas_pk;
                        return $result;
                    })
                    ->addColumn('harga_atas_pk', function ($list) {
                        $result = rupiah($list->harga_atas_pk);
                        return $result;
                    })
                    ->addColumn('harga_incoming_pk', function ($list) {
                        if ($list->harga_incoming_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->harga_incoming_pk);
                            return $result;
                        }
                    })
                    ->addColumn('plan_harga_aktual_pk', function ($list) {
                        if ($list->plan_harga_aktual_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->plan_harga_aktual_pk);
                            return $result;
                        }
                    })
                    ->addColumn('aktual_kualitas_pk', function ($list) {
                        if ($list->aktual_kualitas_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = $list->aktual_kualitas_pk;
                            return $result;
                        }
                    })
                    ->addColumn('harga_awal_pk', function ($list) {
                        if ($list->harga_awal_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->harga_awal_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('aksi_harga_pk', function ($list) {
                        $result = $list->aksi_harga_pk;
                        return $result;
                    })
                    ->addColumn('reaksi_harga_pk', function ($list) {
                        $result = $list->reaksi_harga_pk;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->reaksi_harga_pk);
                        }
                        return $result;
                    })
                    ->addColumn('harga_akhir_pk', function ($list) {
                        $result = $list->harga_akhir_permintaan_pk;
                        if ($result == null | $result == '') {
                            if ($list->harga_akhir_pk == 'TOLAK') {
                                return 'TOLAK';
                            } else {
                                $result = rupiah($list->harga_akhir_pk) . '/Kg';
                                return $result;
                            }
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('created_at_pk', function ($list) {
                        $result = $list->created_at_pk;
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        return
                            '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Reject 
                    </a>';
                    })

                    ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            } else {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_pk', 'lab1_pk.lab1_id_data_po_pk', '=', 'data_po.id_data_po')
                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->where('lab1_pk.output_lab_pk', '=', 'Reject')
                    ->orderBy('id_lab1_pk', 'desc')
                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('waktu_penerimaan', function ($list) {
                        $result = $list->waktu_penerimaan;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = $list->open_po;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('ka_pk', function ($list) {
                        $result = $list->ka_pk . '%';
                        return $result;
                    })
                    ->addColumn('pk_pk', function ($list) {
                        $result = $list->pk_pk;
                        return $result;
                    })
                    ->addColumn('pk_bersih_pk', function ($list) {
                        $result = $list->pk_bersih_pk . '%';
                        return $result;
                    })
                    ->addColumn('beras_pk', function ($list) {
                        $result = $list->beras_pk;
                        return $result;
                    })
                    ->addColumn('butir_patah_pk', function ($list) {
                        $result = $list->butir_patah_pk;
                        return $result;
                    })
                    ->addColumn('hampa_pk', function ($list) {
                        $result = $list->hampa_pk;
                        return $result;
                    })
                    ->addColumn('katul_pk', function ($list) {
                        $result = $list->katul_pk;
                        return $result;
                    })
                    ->addColumn('wh_pk', function ($list) {
                        $result = $list->wh_pk . '%';
                        return $result;
                    })
                    ->addColumn('tr_pk', function ($list) {
                        $result = $list->tr_pk . '%';
                        return $result;
                    })
                    ->addColumn('md_pk', function ($list) {
                        $result = $list->md_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_hampa_pk', function ($list) {
                        $result = $list->presentase_hampa_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_pk_bersih_pk', function ($list) {
                        $result = $list->presentase_pk_bersih_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_katul_pk', function ($list) {
                        $result = $list->presentase_katul_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_beras_pk', function ($list) {
                        $result = $list->presentase_beras_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_butir_patah_pk', function ($list) {
                        $result = $list->presentase_butir_patah_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_butir_patah_beras_pk', function ($list) {
                        $result = $list->presentase_butir_patah_beras_pk . '%';
                        return $result;
                    })
                    ->addColumn('presentase_butir_patah_beras_adjust_pk', function ($list) {
                        $result = $list->presentase_butir_patah_beras_adjust_pk . '%';
                        return $result;
                    })
                    ->addColumn('refraksi_ka_pk', function ($list) {
                        if ($list->refraksi_ka_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_ka_pk);
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_hampa_pk', function ($list) {
                        if ($list->refraksi_hampa_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_hampa_pk);
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_katul_pk', function ($list) {
                        if ($list->refraksi_katul_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_katul_pk);
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_tr_pk', function ($list) {
                        if ($list->refraksi_tr_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_tr_pk);
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_butir_patah_pk', function ($list) {
                        if ($list->refraksi_butir_patah_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_butir_patah_pk);
                            return $result;
                        }
                    })
                    ->addColumn('reward_hampa_pk', function ($list) {
                        if ($list->reward_hampa_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_hampa_pk);
                            return $result;
                        }
                    })
                    ->addColumn('reward_katul_pk', function ($list) {
                        if ($list->reward_katul_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_katul_pk);
                            return $result;
                        }
                    })
                    ->addColumn('reward_tr_pk', function ($list) {
                        if ($list->reward_tr_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_tr_pk);
                            return $result;
                        }
                    })
                    ->addColumn('reward_butir_patah_pk', function ($list) {
                        if ($list->reward_butir_patah_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_butir_patah_pk);
                            return $result;
                        }
                    })
                    ->addColumn('plan_kualitas_pk', function ($list) {
                        $result = $list->plan_kualitas_pk;
                        return $result;
                    })
                    ->addColumn('harga_atas_pk', function ($list) {
                        $result = rupiah($list->harga_atas_pk);
                        return $result;
                    })
                    ->addColumn('harga_incoming_pk', function ($list) {
                        if ($list->harga_incoming_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->harga_incoming_pk);
                            return $result;
                        }
                    })
                    ->addColumn('plan_harga_aktual_pk', function ($list) {
                        if ($list->plan_harga_aktual_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->plan_harga_aktual_pk);
                            return $result;
                        }
                    })
                    ->addColumn('aktual_kualitas_pk', function ($list) {
                        if ($list->aktual_kualitas_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = $list->aktual_kualitas_pk;
                            return $result;
                        }
                    })
                    ->addColumn('harga_awal_pk', function ($list) {
                        if ($list->harga_awal_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->harga_awal_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('aksi_harga_pk', function ($list) {
                        $result = $list->aksi_harga_pk;
                        return $result;
                    })
                    ->addColumn('reaksi_harga_pk', function ($list) {
                        $result = $list->reaksi_harga_pk;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->reaksi_harga_pk);
                        }
                        return $result;
                    })
                    ->addColumn('harga_akhir_pk', function ($list) {
                        $result = $list->harga_akhir_permintaan_pk;
                        if ($result == null | $result == '') {
                            if ($list->harga_akhir_pk == 'TOLAK') {
                                return 'TOLAK';
                            } else {
                                $result = rupiah($list->harga_akhir_pk) . '/Kg';
                                return $result;
                            }
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('created_at_pk', function ($list) {
                        $result = $list->created_at_pk;
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        return
                            '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Reject 
                    </a>';
                    })

                    ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            }
        }
    }
}
