<?php

namespace App\Http\Controllers\AdminQc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
use App\Models\Lab2GabahBasah;
use App\Models\LogAktivityLab;
use App\Models\NotifSpvqc;
use App\Models\LogAktivityQc;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Twilio\Rest\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Hash;

class QcLab2Controller extends Controller
{
    public function proses_lab2_gabah_basah()
    {
        return view('dashboard.admin_qc.proses_lab2_gabah_basah');
    }
    public function proses_add_lab2_gabah_basah($id)
    {
        $data = Lab1GabahBasah::join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'lab1_gb.lab1_kode_po_gb')
            ->join('data_po', 'data_po.kode_po', '=', 'lab1_gb.lab1_kode_po_gb')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_kode_po', '=', 'lab1_gb.lab1_kode_po_gb')
            ->where('id_lab1_gb', $id)->first();
        return view('dashboard.admin_qc.proses_add_lab2_gabah_basah', compact('data'));
    }

    public function proses_lab2_gabah_kering()
    {
        return view('dashboard.admin_qc.proses_lab2_gabah_kering');
    }

    public function proses_lab2_pecah_kulit()
    {
        return view('dashboard.admin_qc.proses_lab2_pecah_kulit');
    }

    public function proses_lab2_beras_ds()
    {
        return view('dashboard.admin_qc.proses_lab2_beras_ds');
    }
    public function output_proses_lab2_gb()
    {
        return view('dashboard.admin_qc.output_proses_lab2_gb');
    }
    public function output_edit_proses_lab2_gb($id)
    {
        $data = Lab2GabahBasah::Join('penerimaan_po', 'penerimaan_po.penerimaan_kode_po', '=', 'lab2_gb.lab2_kode_po_gb')
            ->join('data_po', 'data_po.kode_po', 'lab2_gb.lab2_kode_po_gb')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('lab1_gb', 'lab1_gb.lab1_kode_po_gb', '=', 'lab2_gb.lab2_kode_po_gb')
            ->select(
                'penerimaan_po.*',
                'lab2_gb.*',
                'data_po.*',
                'bid.name_bid',
                'lab1_gb.keterangan_lab_gb'
            )
            ->where('lab2_gb.id_lab2_gb', $id)->first();

        // dd($data);
        return view('dashboard.admin_qc.output_edit_proses_lab2_gabah_basah', ['data' => $data]);
    }
    public function output_proses_lab2_pk()
    {
        return view('dashboard.admin_qc.output_proses_lab2_pk');
    }

    public function output_deal_lab2_gb()
    {
        return view('dashboard.admin_qc.output_deal_lab2_gb');
    }

    public function output_deal_lab2_pk()
    {
        return view('dashboard.admin_qc.output_deal_lab2_pk');
    }

    public function output_nego_lab2_gb()
    {
        return view('dashboard.admin_qc.output_nego_lab2_gb');
    }

    public function output_nego_lab2_pk()
    {
        return view('dashboard.admin_qc.output_nego_lab2_pk');
    }
    public function output_gabah_lab2()
    {
        $plan_hpp_gabah_basah = PlanHppGabahBasah::get();
        $harga_atas = HargaAtasGabahBasah::orderBy('id_harga_atas', 'desc')->first();
        return view('dashboard.admin_qc.output_gabah_lab2', ['plan_hpp_gabah_basah' => $plan_hpp_gabah_basah]);
    }

    public function proses_lab2_gabah_basah_ciherang_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
            ->where('data_po.status_bid', 10)
            ->where('penerimaan_po.status_penerimaan', 10)
            ->where('bid.name_bid', '=', 'GABAH BASAH CIHERANG')
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
            ->addColumn('tanggal_bongkar', function ($list) {
                $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
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
            ->addColumn('plan_harga', function ($list) {
                $result = rupiah($list->plan_harga_gb) . '/Kg';
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '
                <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="" title="Information" class="lokasi_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                <p style="color:red"> Unload ' . $list->lokasi_bongkar_gb . '  </p> <p style="color:green; margin-top:-15px"> Unload&nbsp;Complete </p>
                </a>';
            })
            ->addColumn('detail_hasil_qc', function ($list) {
                return
                    '
                <button id="btn_finishing_qc" style="margin:2px;" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '"  data-item="' . $list->name_bid . '"  title="Information" class="detail_data btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                Lab&nbsp;Process
                </button>';
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'tanggal_bongkar', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'ckelola', 'detail_hasil_qc'])
            ->make(true);
    }
    public function proses_lab2_gabah_basah_longgrain_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
            ->where('data_po.status_bid', 10)
            ->where('penerimaan_po.status_penerimaan', 10)
            ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
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
            ->addColumn('tanggal_bongkar', function ($list) {
                $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
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
            ->addColumn('plan_harga', function ($list) {
                $result = rupiah($list->plan_harga_gb) . '/Kg';
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '
                <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="" title="Information" class="lokasi_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                <p style="color:red"> Bongkar&nbsp;' . $list->lokasi_bongkar_gb . '  </p> <p style="color:green; margin-top:-15px"> Bongkar&nbsp;Selesai </p>
                </a>';
            })
            ->addColumn('detail_hasil_qc', function ($list) {
                return
                    '
                <button id="btn_finishing_qc" style="margin:2px;" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '"  data-item="' . $list->name_bid . '"  title="Information" class="detail_data btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                Lab&nbsp;Process
                </button>';
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'tanggal_bongkar', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'ckelola', 'detail_hasil_qc'])
            ->make(true);
    }
    public function proses_lab2_gabah_basah_pandan_wangi_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
            ->where('data_po.status_bid', 10)
            ->where('penerimaan_po.status_penerimaan', 10)
            ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
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
            ->addColumn('tanggal_bongkar', function ($list) {
                $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
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
            ->addColumn('plan_harga', function ($list) {
                $result = rupiah($list->plan_harga_gb) . '/Kg';
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '
                <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="" title="Information" class="lokasi_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                <p style="color:red"> Unload ' . $list->lokasi_bongkar_gb . '  </p> <p style="color:green; margin-top:-15px"> Unload&nbsp;Complete </p>
                </a>';
            })
            ->addColumn('detail_hasil_qc', function ($list) {
                return
                    '
                <button id="btn_finishing_qc" style="margin:2px;" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '"  data-item="' . $list->name_bid . '"  title="Information" class="detail_data btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                Lab&nbsp;Process
                </button>';
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'tanggal_bongkar', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'ckelola', 'detail_hasil_qc'])
            ->make(true);
    }
    public function proses_lab2_gabah_basah_ketan_putih_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
            ->where('data_po.status_bid', 10)
            ->where('penerimaan_po.status_penerimaan', 10)
            ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
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
            ->addColumn('tanggal_bongkar', function ($list) {
                $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
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
            ->addColumn('plan_harga', function ($list) {
                $result = rupiah($list->plan_harga_gb) . '/Kg';
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '
                <a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="" title="Information" class="lokasi_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                <p style="color:red"> Unload ' . $list->lokasi_bongkar_gb . '  </p> <p style="color:green; margin-top:-15px"> Unload&nbsp;Complete </p>
                </a>';
            })
            ->addColumn('detail_hasil_qc', function ($list) {
                return
                    '
                <button id="btn_finishing_qc" style="margin:2px;" name="' . $list->id_lab1_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '"  data-item="' . $list->name_bid . '"  title="Information" class="detail_data btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                Lab&nbsp;Process
                </button>';
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'tanggal_bongkar', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'ckelola', 'detail_hasil_qc'])
            ->make(true);
    }

    public function proses_lab2_gabah_kering_index() {}

    public function proses_lab2_pecah_kulit_index()
    {
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab1_pk', 'lab1_pk.lab1_id_data_po_pk', '=', 'data_po.id_data_po')
            ->where('data_po.status_bid', 10)
            ->where('penerimaan_po.status_penerimaan', 10)
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
            ->addColumn('tanggal_bongkar', function ($list) {
                $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
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
            ->addColumn('plan_harga', function ($list) {
                $result = rupiah($list->harga_awal_pk) . '/Kg';
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                return
                    '
                <a style="margin:2px;" name="' . $list->id_lab1_pk . '" data-toggle="modal" data-target="" title="Information" class="lokasi_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                <p style="color:red"> Unload ' . $list->lokasi_bongkar_pk . '  </p> <p style="color:green; margin-top:-15px"> Unload&nbsp;Complete </p>
                </a>';
            })
            ->addColumn('detail_hasil_qc', function ($list) {
                return
                    '
                <button id="btn_finishing_qc" style="margin:2px;" name="' . $list->lab1_token . '" data-id="' . $list->lab1_id_penerimaan_po_pk . '" data-tanggalpo="' . $list->tanggal_po . '"  title="Information" class="detail_data btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                Lab&nbsp;Process
                </button>';
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'tanggal_bongkar', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'ckelola', 'detail_hasil_qc'])
            ->make(true);
    }

    public function proses_lab2_beras_ds_index() {}
    public function approve_lab2_pk($id)
    {
        $get_kode_po            = DB::table('lab2_pk')->where('id_lab2_pk', $id)->first();
        $update_data_po         = DataPO::where('kode_po', $get_kode_po->lab2_kode_po_pk)->update(['status_bid' => 12]);
        $update_pernerimaan_po  = PenerimaanPO::where('penerimaan_kode_po', $get_kode_po->lab2_kode_po_pk)->update(['status_penerimaan' => 12]);
        $update_data_incoming   = DB::table('lab1_pk')->where('lab1_kode_po_pk', $get_kode_po->lab2_kode_po_pk)->update(['status_lab1_pk' => 12]);
        $update_data_finishing  = DB::table('lab2_pk')->where('id_lab2_pk', $id)->update(['status_approved_pk' => NULL, 'status_lab2_pk' => 12]);
        // return redirect()->back();
    }

    public function save_proses_lab2_gb(Request $request)
    {
        // dd($request->all());
        $data                                          = new FinishingQCGb();
        $data->lab2_kode_po_gb                         = $request->lab1_kode_po_gb;
        $data->lab2_plat_gb                            = $request->lab1_plat_gb;
        $data->hampa_gb                                = $request->hampa;
        $data->broken_gb                               = $request->broken_setelah_bongkar;
        $data->randoman_gb                             = $request->berat_sample_beras;
        $data->kadar_air_gb                            = $request->ka_ks;
        $data->status_lab2_gb                          = 11;
        $data->created_at_gb                           = date('Y-m-d H:i:s');
        $data->plan_harga_gb                           = $request->plan_harga_gb;
        $data->kg_after_adjust_hampa_gb                = $request->kg_after_adjust_hampa;
        $data->prosentasi_kg_gb                        = $request->prosentasi_kg;
        $data->susut_gb                                = $request->susut;
        $data->adjust_susut_gb                         = $request->adjust_susut;
        $data->prsentase_ks_kg_after_adjust_susut_gb   = $request->prsentase_ks_kg_after_adjust_susut;
        $data->prsentase_kg_pk_gb                      = $request->prsentase_kg_pk;
        $data->adjust_prosentase_kg_pk_gb              = $request->adjust_prosentase_kg_pk;
        $data->presentase_ks_pk_gb                     = $request->presentase_ks_pk;
        $data->presentase_putih_gb                     = $request->presentase_putih;
        $data->adjust_prosentase_kg_ke_putih_gb        = $request->adjust_prosentase_kg_ke_putih;
        $data->plan_rend_dari_ks_beras_gb              = $request->plan_rend_dari_ks_beras;
        $data->katul_gb                                = $request->katul;
        $data->refraksi_broken_gb                      = $request->refraksi_broken;
        $data->plan_harga_gabah_gb                     = $request->plan_harga_gabah;
        $data->ka_kg_gb                                = $request->ka_kg;
        $data->berat_sample_awal_ks_gb                 = $request->berat_sample_awal_ks;
        $data->berat_sample_awal_kg_gb                 = $request->berat_sample_awal_kg;
        $data->berat_sample_akhir_kg_gb                = $request->berat_sample_akhir_kg;
        $data->berat_sample_pk_gb                      = $request->berat_sample_pk;
        $data->wh_gb                                   = $request->wh;
        $data->tp_gb                                   = $request->tp;
        $data->md_gb                                   = $request->md;
        $data->dtm_gb                                  = $request->dtm;

        $data->plan_berat_kg_pertruk_gb                = $request->plan_berat_kg_pertruk;
        $data->plan_berat_pk_pertruk_gb                = $request->plan_berat_pk_pertruk;
        $data->plan_berat_beras_pertruk_gb             = $request->plan_berat_beras_pertruk;

        // $data->hpp_aktual_gb                           = $request->hpp_aktual;
        $data->plan_harga_gabah_ongkos_dryer_gb        = $request->plan_harga_gabah_ongkos_dryer;
        $data->plan_harga_pk_perkilo_gb                = $request->plan_harga_pk_perkilo;
        $data->plan_harga_beras_perkilo_gb             = $request->plan_harga_beras_perkilo;
        $data->plan_total_harga_gabah_pertruk_gb       = $request->plan_total_harga_gabah_pertruk;
        $data->plan_total_harga_pk_pertruk_gb          = $request->plan_total_harga_pk_pertruk;
        $data->plan_total_harga_beras_pertruk_gb       = $request->plan_total_harga_beras_pertruk;
        $data->plan_hpp_aktual_gb                      = $request->hpp_aktual;
        $data->plan_hpp_aktual_gb                      = $request->hpp_aktual;

        $data->aktual_price_ongkos_driyer_gb           = $request->aktual_price_ongkos_driyer;
        $data->plan_harga_aktual_pertruk_gb            = $request->plan_harga_aktual_pertruk;
        $data->plan_hpp_aktual1_gb                     = $request->plan_hpp_aktual1;

        $data->plan_harga_beli_gabah_gb                = $request->plan_harga_beli_gabah;
        $data->harga_berdasarkan_tempat_gb             = $request->harga_berdasarkan_tempat;
        $data->harga_berdasarkan_harga_atas_gb         = $request->harga_berdasarkan_harga_atas;
        $data->harga_awal_gb                           = $request->harga_awal;
        $data->harga_akhir_gb                          = $request->plan_harga_potongan_gb;
        $data->surveyor_gb                             = $request->surveyor_bongkar;
        $data->keterangan_gb                           = $request->keterangan_bongkar;
        $data->waktu_gb                                = $request->waktu_bongkar;
        $data->tempat_gb                               = $request->lokasi_gt;
        $data->lokasi_bongkar_gb                       = $request->lokasi_gt;
        $data->z_yang_dibawa_gb                        = $request->z_yang_dibawa;
        $data->z_yang_ditolak_gb                       = $request->z_yang_ditolak;
        $data->antrian_gb                              = $request->antrian;
        $data->status_approved                         = 0;
        // dd($data);
        $data->save();


        $lab1gb = Lab1GabahBasah::where('lab1_kode_po_gb', $request->lab1_kode_po_gb)->first();
        $lab1gb->lokasi_bongkar_gb    = $request->lokasi_gt;
        $lab1gb->lokasi_gt_gb    = $request->lokasi_gt;
        $lab1gb->update();

        $log                               = new LogAktivityLab();
        $log->nama_user                    = Auth::guard('lab')->user()->name_qc;
        $log->id_objek_aktivitas_lab       = $data->id_lab2_gb;
        $log->aktivitas_lab                = 'Insert Lab 2 PO Kode PO:' . $request->lab1_kode_po_gb .
            ', PLAT KENDARAAN : '                            . $request->lab1_plat_gb .
            ', HAMPA : '                                . $request->hampa .
            ', BROKEN : '                               . $request->broken_setelah_bongkar .
            ', RANDOMAN : '                             . $request->berat_sample_beras .
            ', KADAR AIR : '                            . $request->ka_ks .
            ', PLAN HARGA : '                           . $request->plan_harga_gb .
            ', KG AFTER ADJUST HAMPA : '                . $request->kg_after_adjust_hampa .
            ', PROSENTASE KG : '                        . $request->prosentasi_kg .
            ', SUSUT : '                                . $request->susut .
            ', ADJUST SUSUT : '                         . $request->adjust_susut .
            ', PRESENTASE KS KG AFTER ADJUST SUSUT : '   . $request->prsentase_ks_kg_after_adjust_susut .
            ', PRESENTASE KG PK : '                      . $request->prsentase_kg_pk .
            ', ADJUST PROSENTASE KG PK : '              . $request->adjust_prosentase_kg_pk .
            ', PRESENTASE KS PK : '                     . $request->presentase_ks_pk .
            ', PRESENTASE PUTIH : '                     . $request->presentase_putih .
            ', ADJUST PROSENTASE KG KE PUTIH : '        . $request->adjust_prosentase_kg_ke_putih .
            ', PLAN REND DARI KS BERAS : '              . $request->plan_rend_dari_ks_beras .
            ', KATUL : '                                . $request->katul .
            ', REFRAKSI BROKEN : '                      . $request->refraksi_broken .
            ', PLAN HARGA GABAH : '                     . $request->plan_harga_gabah .
            ', KA KG : '                                . $request->ka_kg .
            ', BERAT SAMPEL AWAL KS : '                 . $request->berat_sample_awal_ks .
            ', BERAT SAMPEL AWAL KG : '                 . $request->berat_sample_awal_kg .
            ', BERAT SAMPEL AKHIR KG : '                . $request->berat_sample_akhir_kg .
            ', BERAT SAMPEL PK : '                      . $request->berat_sample_pk .
            ', WH : '                                   . $request->wh .
            ', TP : '                                   . $request->tp .
            ', MD : '                                   . $request->md .
            ', DTM : '                                   . $request->dtm .
            ', PLAN BERAT KG PER TRUK : '                . $request->plan_berat_kg_pertruk .
            ', PLAN BERAT PK PER TRUK : '                . $request->plan_berat_pk_pertruk .
            ', PLAN BERAT BERAS PER TRUK : '             . $request->plan_berat_beras_pertruk .
            ', PLAN HARGA GABAH ONGKOS DRIYER : '        . $request->plan_harga_gabah_ongkos_dryer .
            ', PLAN HARGA PK PER KILO : '                . $request->plan_harga_pk_perkilo .
            ', PLAN HARGA BERAS PER KILO : '             . $request->plan_harga_beras_perkilo .
            ', PLAN TOTAL HARGA GABAH PER TRUK : '       . $request->plan_total_harga_gabah_pertruk .
            ', PLAN TOTAL HARGA PK PER TRUK : '          . $request->plan_total_harga_pk_pertruk .
            ', PLAN TOTAL HARGA BERAS PERTRUK : '       . $request->plan_total_harga_beras_pertruk .
            ', PLAN HPP AKTUAL : '                      . $request->hpp_aktual .
            ', AKTUAL PRIVE ONGKOS DRIYER : '           . $request->aktual_price_ongkos_driyer .
            ', PLAN HARGA AKTUAL PER TRUK : '            . $request->plan_harga_aktual_pertruk .
            ', PLAN HPP AKTUAL 1 : '                     . $request->plan_hpp_aktual1 .
            ', PLAN HARGA BELI GABAH : '                . $request->plan_harga_beli_gabah .
            ', HARGA BERDASARKAN TEMPAT : '             . $request->harga_berdasarkan_tempat .
            ', HARGA BERDASARKAN HARGA ATAS : '         . $request->harga_berdasarkan_harga_atas .
            ', HARGA AWAL : '                           . $request->harga_awal .
            ', HARGA AKHIR : '                          . $request->plan_harga_potongan_gb .
            ', SURVEYOR : '                             . $request->surveyor_bongkar .
            ', WAKTU BONGKAR : '                                . $request->waktu_bongkar .
            ', LOKASI BONGKAR : '                       . $request->lokasi_gt .
            ', Z YANG DIBAWA : '                        . $request->z_yang_dibawa .
            ', Z YANG DITOLAK : '                       . $request->z_yang_ditolak .
            ', ANTRIAN : '                              . $request->antrian;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();

        // Edit Proses Bongkar
        $data_bongkar = DataQcBongkar::where('kode_po_bongkar', $request->lab1_kode_po_gb)->first();
        $data_bongkar->no_dtm = $request->dtm;
        $data_bongkar->tempat_bongkar = $request->lokasi_gt;
        $data_bongkar->update();


        $po = trackerPO::where('kode_po_tracker', $request->lab1_kode_po_gb)->first();
        if ($po == NULL) {
        } else {
            $po->nama_admin_tracker  = Auth::guard('lab')->user()->name_qc;
            $po->status_po_tracker  = '11';
            $po->proses_tracker  = 'insert lab 2';
            $po->pengajuan_approve_lab2_tracker  = NULL;
            $po->lab2_tracker  = date('Y-m-d H:i:s');
            $po->update();
        }

        $data = $data = PenerimaanPO::where('penerimaan_kode_po', $request->lab1_kode_po_gb)->first();
        $data->status_penerimaan = 11;
        $data->update();

        $data = DataPO::where('id_data_po', $request->lab1_id_data_po_gb)->first();
        $data->status_bid = 11;
        $data->update();

        $data = Lab1GabahBasah::where('lab1_id_data_po_gb', $request->lab1_id_data_po_gb)->first();
        $data->status_lab1_gb = 11;
        $data->update();

        return response()->json($data);
    }

    public function save_proses_lab2_pk(Request $request)
    {
        // dd($request->all());
        if ($request->lokasi_bongkar_pk == 'GRAIN PRO') {
            $lokasi = 'GP';
        } else if ($request->lokasi_bongkar_pk == 'SHIN HEUNG') {
            $lokasi = 'SH';
        }
        $data                                       = new FinishingQCPk();
        $data->lab2_token                               = Str::random(30);
        $data->lab2_kode_po_pk                      = $request->lab1_kode_po_pk;
        $data->lab2_plat_pk                         = $request->lab1_plat_pk;

        $data->ka_pk                                = $request->ka_pk;
        $data->pk_pk                                = $request->pk_pk;
        $data->pk_bersih_pk                         = $request->pk_bersih_pk;
        $data->beras_pk                             = $request->beras_pk;
        $data->lokasi_bongkar_pk                    = $lokasi;
        $data->butir_patah_pk                       = $request->butir_patah_pk;
        $data->reject_pk                            = $request->reject_pk;
        $data->hampa_pk                             = $request->hampa_pk;
        $data->katul_pk                             = $request->katul_pk;
        $data->wh_pk                                = $request->wh_pk;
        $data->status_lab2_pk                       = 11;
        $data->created_at_pk                        = date('Y-m-d H:i:s');
        $data->tr_pk                                = $request->tr_pk;
        $data->md_pk                                = $request->md_pk;
        $data->harga_bongkaran_pk                   = $request->harga_bongkaran_pk;
        $data->no_dtm_pk                            = $request->no_dtm_pk;
        $data->surveyor_bongkar                     = $request->surveyor_bongkar;
        $data->keterangan_bongkar                   = $request->keterangan_bongkar;
        $data->waktu_bongkar                        = $request->waktu_bongkar;
        $data->tempat_bongkar                       = $request->tempat_bongkar;
        $data->z_yang_dibawa                        = $request->z_yang_dibawa;
        $data->z_yang_ditolak                       = $request->z_yang_ditolak;
        $data->presentase_hampa_pk                  = $request->presentase_hampa_pk;
        $data->presentase_pk_bersih_pk              = $request->presentase_pk_bersih_pk;
        $data->presentase_beras_pk                  = $request->presentase_beras_pk;
        $data->presentase_katul_pk                  = $request->presentase_katul_pk;
        $data->presentase_butir_patah_pk            = $request->presentase_butir_patah_pk;
        $data->presentase_butir_patah_beras_pk      = $request->presentase_butir_patah_beras_pk;
        $data->presentase_reject_pk                 = $request->presentase_reject_pk;
        $data->refraksi_ka_pk                       = $request->refraksi_ka_pk;
        $data->refraksi_hampa_pk                    = $request->refraksi_hampa_pk;
        $data->refraksi_katul_pk                    = $request->refraksi_katul_pk;
        $data->refraksi_butir_patah_pk              = $request->refraksi_butir_patah_pk;
        $data->reward_hampa_pk                      = $request->reward_hampa_pk;
        $data->reward_katul_pk                      = $request->reward_katul_pk;

        $data->reward_tr_pk                         = $request->reward_tr_pk;
        $data->reward_butir_patah_pk                = $request->reward_butir_patah_pk;
        $data->plan_kualitas_pk                     = $request->plan_kualitas_pk;

        // $data->hpp_aktual_pk                     = $request->hpp_aktual;
        $data->harga_atas_pk                        = $request->harga_atas_pk;
        $data->plan_harga_bongkaran                 = $request->plan_harga_bongkaran;
        $data->presentase_pass                      = $request->presentase_pass;
        $data->presentase_reject                    = $request->presentase_reject;
        $data->plan_tonase_pk                       = $request->plan_tonase_pk;
        $data->plan_total_harga_pk                  = $request->plan_total_harga_pk;


        $data->plan_tonase_beras_pk                 = $request->plan_tonase_beras_pk;
        $data->selisih_ka_pk                        = $request->selisih_ka_pk;
        $data->selisih_presentase_hampa_pk          = $request->selisih_presentase_hampa_pk;
        $data->selisih_presentase_rendemen_pk_pk    = $request->selisih_presentase_rendemen_pk_pk;
        $data->selisih_presentase_katul_pk          = $request->selisih_presentase_katul_pk;
        $data->selisih_presentase_rendemen_beras_pk    = $request->selisih_presentase_rendemen_beras_pk;
        $data->selisih_presentase_butir_patah_pk    = $request->selisih_presentase_butir_patah_pk;
        $data->selisih_wh_pk                        = $request->selisih_wh_pk;
        $data->selisih_tr_pk                        = $request->selisih_tr_pk;
        $data->selisih_md_pk                        = $request->selisih_md_pk;
        $data->selisih_harga_pk                     = $request->selisih_harga_pk;
        $data->selisih_aktual_kualitas_pk           = $request->selisih_aktual_kualitas_pk;
        $data->selisih_kualitas_bongkaran_pk        = $request->selisih_kualitas_bongkaran_pk;
        // dd($data);
        $data->save();

        $update_status_penerimaan_po = PenerimaanPO::where('id_penerimaan_po', $request->lab1_id_data_po_pk)->where('penerimaan_kode_po', $request->lab1_kode_po_pk)
            ->update(['status_penerimaan' => 11]);

        $update_status_data_po = DataPO::where('id_data_po', $request->lab1_id_data_po_pk)->where('kode_po', $request->lab1_kode_po_pk)
            ->update(['status_bid' => 11]);

        $update_status_gabahincoming = DB::table('lab1_pk')->where('lab1_id_data_po_pk', $request->lab1_id_data_po_pk)->where('lab1_kode_po_pk', $request->lab1_kode_po_pk)
            ->update(['status_lab1_pk' => 11, 'aksi_harga_pk' => $request->aksi_harga_pk]);

        return redirect()->back();
    }
    public function edit_lab2_pk($id)
    {
        $data = DB::table('lab2_pk as a')
            ->select(
                'd.*',
                'c.*',
                'b.*',
                'a.ka_pk as ka_pk2',
                'a.pk_pk as pk_pk2',
                'a.pk_bersih_pk as pk_bersih_pk2',
                'a.beras_pk as beras_pk2',
                'a.butir_patah_pk as butir_patah_pk2',
                'a.hampa_pk as hampa_pk2',
                'a.katul_pk as katul_pk2',
                'a.wh_pk as wh_pk2',
                'a.tr_pk as tr_pk2',
                'a.md_pk as md_pk2',
                'a.lab2_token',
                'a.lab2_kode_po_pk',
                'a.reject_pk',
                'a.no_dtm_pk',
                'a.surveyor_bongkar',
                'a.waktu_bongkar',
                'a.lokasi_bongkar_pk AS lokasi_pk',
                'a.keterangan_bongkar',
                'a.z_yang_dibawa',
                'a.z_yang_ditolak',
                'a.harga_bongkaran_pk'
            )
            ->join('penerimaan_po as b', 'b.penerimaan_kode_po', '=', 'a.lab2_kode_po_pk')
            ->join('data_po as c', 'c.kode_po', 'a.lab2_kode_po_pk')
            ->join('lab1_pk as d', 'd.lab1_kode_po_pk', '=', 'a.lab2_kode_po_pk')
            ->where('a.id_lab2_pk', $id)->first();
        return json_encode($data);
    }
    public function edit_lab2_gb($id)
    {
        $data = Lab2GabahBasah::join('penerimaan_po', 'penerimaan_po.penerimaan_kode_po', '=', 'lab2_gb.lab2_kode_po_gb')
            ->join('data_po', 'data_po.kode_po', 'lab2_gb.lab2_kode_po_gb')
            ->join('lab1_gb', 'lab1_gb.lab1_kode_po_gb', '=', 'lab2_gb.lab2_kode_po_gb')
            ->select(
                'penerimaan_po.*',
                'lab2_gb.*',
                'data_po.*',
                'lab1_gb.keterangan_lab_gb'
            )
            ->where('lab2_gb.id_lab2_gb', $id)->first();
        return json_encode($data);
    }
    public function show_lab2_gb($id)
    {
        $data = Lab1GabahBasah::join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'lab1_gb.lab1_kode_po_gb')
            ->join('data_po', 'data_po.kode_po', '=', 'lab1_gb.lab1_kode_po_gb')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_kode_po', '=', 'lab1_gb.lab1_kode_po_gb')
            ->where('id_lab1_gb', $id)->first();
        return json_encode($data);
    }
    public function show_lab2_pk($id)
    {
        $data = DB::table('lab1_pk')
            ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'lab1_pk.lab1_kode_po_pk')
            ->join('data_po', 'data_po.kode_po', '=', 'lab1_pk.lab1_kode_po_pk')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_kode_po', '=', 'lab1_pk.lab1_kode_po_pk')
            ->where('lab1_pk.lab1_token', $id)->first();
        return json_encode($data);
    }
    public function approve_lab2_gb($id)
    {

        $get_kode_po            = Lab2GabahBasah::where('id_lab2_gb', $id)->first();
        $update_data_po         = DataPO::where('kode_po', $get_kode_po->lab2_kode_po_gb)->update(['status_bid' => 12]);
        $update_data_incoming   = Lab1GabahBasah::where('lab1_kode_po_gb', $get_kode_po->lab2_kode_po_gb)->update(['status_lab1_gb' => 12]);
        $update_data_finishing  = Lab2GabahBasah::where('id_lab2_gb', $id)->update(['status_lab2_gb' => 12, 'status_approved' => 0, 'keterangan_harga_akhir_gb' => 'Harga Sesuai Hasil Lab']);
        $update_pernerimaan_po  = PenerimaanPO::where('penerimaan_kode_po', $get_kode_po->lab2_kode_po_gb)->update(['status_penerimaan' => 12]);

        // LOG ACTIVITY
        $log                               = new LogAktivityLab();
        $log->nama_user                    = Auth::guard('lab')->user()->name_qc;
        $log->id_objek_aktivitas_lab       = $id;
        $log->aktivitas_lab                = 'Pengajuan Approve Lab 2 Ke SPV Kode PO:' . $get_kode_po->lab2_kode_po_gb;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();

        $po = trackerPO::where('kode_po_tracker', $get_kode_po->lab2_kode_po_gb)->first();
        if ($po == NULL) {
        } else {
            $po->nama_admin_tracker  = Auth::guard('lab')->user()->name_qc;
            $po->status_po_tracker  = '12';
            $po->pengajuan_approve_lab2_tracker  = date('Y-m-d H:i:s');
            $po->approve_lab2_tracker  = NULL;
            $po->tolak_approve_lab2_tracker  = NULL;
            $po->proses_tracker  = 'PENGAJUAN APPROVE LAB 2';
            $po->update();
        }
        //tambah notifikasi
        $notif   = new NotifSpvqc();
        $notif->judul           = "Pengajuan Approve Lab 2";
        $notif->keterangan      = "Ada PO Pengajuan Approve Lab Bongkaran, Kode PO : " . $get_kode_po->lab2_kode_po_gb;
        $notif->status          = 0;
        $notif->id_objek        = $id;
        $notif->notifbaru       = 0;
        $notif->kategori        = 1;
        $notif->created_at      = date('Y-m-d H:i:s');
        $notif->save();

        return redirect()->back();
    }
    public function update_lab2_gb(Request $request)
    {
        // dd($request->all());
        $data                                         = FinishingQCGb::where('id_lab2_gb', $request->id_gabahfinishing_qc)->first();
        $data->hampa_gb                               = $request->hampa;
        $data->broken_gb                              = $request->broken_setelah_bongkar;
        $data->randoman_gb                            = $request->berat_sample_beras;
        $data->kadar_air_gb                           = $request->ka_ks;
        $data->created_at_gb                          = date('Y-m-d H:i:s');
        $data->plan_harga_gb                          = $request->plan_harga_gabah;
        $data->kg_after_adjust_hampa_gb               = $request->kg_after_adjust_hampa;
        $data->prosentasi_kg_gb                       = $request->prosentasi_kg;
        $data->susut_gb                               = $request->susut;
        $data->adjust_susut_gb                        = $request->adjust_susut;
        $data->prsentase_ks_kg_after_adjust_susut_gb  = $request->prsentase_ks_kg_after_adjust_susut;
        $data->prsentase_kg_pk_gb                     = $request->prsentase_kg_pk;
        $data->adjust_prosentase_kg_pk_gb             = $request->adjust_prosentase_kg_pk;
        $data->presentase_ks_pk_gb                    = $request->presentase_ks_pk;
        $data->presentase_putih_gb                    = $request->presentase_putih;
        $data->adjust_prosentase_kg_ke_putih_gb       = $request->adjust_prosentase_kg_ke_putih;
        $data->plan_rend_dari_ks_beras_gb             = $request->plan_rend_dari_ks_beras;
        $data->katul_gb                               = $request->katul;
        $data->refraksi_broken_gb                     = $request->refraksi_broken;
        $data->plan_harga_gabah_gb                    = $request->plan_harga_gabah;
        $data->ka_kg_gb                               = $request->ka_kg;
        $data->berat_sample_awal_ks_gb                = $request->berat_sample_awal_ks;
        $data->berat_sample_awal_kg_gb                = $request->berat_sample_awal_kg;
        $data->berat_sample_akhir_kg_gb               = $request->berat_sample_akhir_kg;
        $data->berat_sample_pk_gb                     = $request->berat_sample_pk;
        $data->wh_gb                                  = $request->wh;
        $data->tp_gb                                  = $request->tp;
        $data->md_gb                                  = $request->md;
        //add
        $data->plan_berat_kg_pertruk_gb               = $request->plan_berat_kg_pertruk;
        $data->plan_berat_pk_pertruk_gb               = $request->plan_berat_pk_pertruk;
        $data->plan_berat_beras_pertruk_gb            = $request->plan_berat_beras_pertruk;
        $data->plan_harga_gabah_gb                    = $request->harga_berdasarkan_tempat;
        $data->plan_harga_beli_gabah_gb               = $request->plan_harga_beli_gabah;
        $data->harga_berdasarkan_tempat_gb            = $request->harga_berdasarkan_tempat;
        $data->harga_berdasarkan_harga_atas_gb        = $request->harga_berdasarkan_harga_atas;
        $data->plan_harga_gabah_ongkos_dryer_gb       = $request->plan_harga_gabah_ongkos_dryer;
        $data->plan_harga_pk_perkilo_gb               = $request->plan_harga_pk_perkilo;
        $data->plan_harga_beras_perkilo_gb            = $request->plan_harga_beras_perkilo;
        $data->plan_total_harga_gabah_pertruk_gb      = $request->plan_total_harga_gabah_pertruk;
        $data->plan_total_harga_pk_pertruk_gb         = $request->plan_total_harga_pk_pertruk;
        $data->plan_total_harga_beras_pertruk_gb      = $request->plan_total_harga_beras_pertruk;

        $data->aktual_price_ongkos_driyer_gb           = $request->aktual_price_ongkos_driyer;
        $data->plan_harga_aktual_pertruk_gb            = $request->plan_harga_aktual_pertruk;
        $data->plan_hpp_aktual1_gb                     = $request->plan_hpp_aktual1;
        $data->dtm_gb                                  = $request->dtm;
        $data->lokasi_bongkar_gb                       = $request->lokasi_bongkar;
        $data->tempat_gb                               = $request->lokasi_bongkar;

        $data->plan_hpp_aktual_gb                     = $request->hpp_aktual;
        $data->harga_awal_gb                          = $request->harga_awal;
        $data->harga_akhir_gb                         = $request->plan_harga_potongan_gb;
        $data->status_approved                        = 0;
        $data->update();


        // Edit Lab 1
        $lab1gb                                 = Lab1GabahBasah::where('lab1_kode_po_gb', $request->gabahincoming_kode_po)->first();
        $lab1gb->lokasi_bongkar_gb              = $request->lokasi_bongkar;
        $lab1gb->lokasi_gt_gb                   = $request->lokasi_bongkar;
        $lab1gb->update();

        // Edit Proses Bongkar
        $data_bongkar = DataQcBongkar::where('kode_po_bongkar', $request->gabahincoming_kode_po)->first();
        $data_bongkar->tempat_bongkar = $request->lokasi_bongkar;
        $data_bongkar->no_dtm = $request->dtm;
        $data_bongkar->update();


        // LOG ACTIVITY
        $log                               = new LogAktivityLab();
        $log->nama_user                    = Auth::guard('lab')->user()->name_qc;
        $log->id_objek_aktivitas_lab       = $data->id_lab2_gb;
        $log->aktivitas_lab                = 'Update Lab 2 PO Kode PO:' . $request->gabahincoming_kode_po .
            ', PLAT KENDARAAN : '                            . $request->gabahincoming_plat .
            ', HAMPA : '                                . $request->hampa .
            ', BROKEN : '                               . $request->broken_setelah_bongkar .
            ', RANDOMAN : '                             . $request->berat_sample_beras .
            ', KADAR AIR : '                            . $request->ka_ks .
            ', PLAN HARGA : '                           . $request->plan_harga_gb .
            ', KG AFTER ADJUST HAMPA : '                . $request->kg_after_adjust_hampa .
            ', PROSENTASE KG : '                        . $request->prosentasi_kg .
            ', SUSUT : '                                . $request->susut .
            ', ADJUST SUSUT : '                         . $request->adjust_susut .
            ', PRESENTASE KS KG AFTER ADJUST SUSUT : '   . $request->prsentase_ks_kg_after_adjust_susut .
            ', PRESENTASE KG PK : '                      . $request->prsentase_kg_pk .
            ', ADJUST PROSENTASE KG PK : '              . $request->adjust_prosentase_kg_pk .
            ', PRESENTASE KS PK : '                     . $request->presentase_ks_pk .
            ', PRESENTASE PUTIH : '                     . $request->presentase_putih .
            ', ADJUST PROSENTASE KG KE PUTIH : '        . $request->adjust_prosentase_kg_ke_putih .
            ', PLAN REND DARI KS BERAS : '              . $request->plan_rend_dari_ks_beras .
            ', KATUL : '                                . $request->katul .
            ', REFRAKSI BROKEN : '                      . $request->refraksi_broken .
            ', PLAN HARGA GABAH : '                     . $request->plan_harga_gabah .
            ', KA KG : '                                . $request->ka_kg .
            ', BERAT SAMPEL AWAL KS : '                 . $request->berat_sample_awal_ks .
            ', BERAT SAMPEL AWAL KG : '                 . $request->berat_sample_awal_kg .
            ', BERAT SAMPEL AKHIR KG : '                . $request->berat_sample_akhir_kg .
            ', BERAT SAMPEL PK : '                      . $request->berat_sample_pk .
            ', WH : '                                   . $request->wh .
            ', TP : '                                   . $request->tp .
            ', MD : '                                   . $request->md .
            ', DTM : '                                   . $request->dtm .
            ', PLAN BERAT KG PER TRUK : '                . $request->plan_berat_kg_pertruk .
            ', PLAN BERAT PK PER TRUK : '                . $request->plan_berat_pk_pertruk .
            ', PLAN BERAT BERAS PER TRUK : '             . $request->plan_berat_beras_pertruk .
            ', PLAN HARGA GABAH ONGKOS DRIYER : '        . $request->plan_harga_gabah_ongkos_dryer .
            ', PLAN HARGA PK PER KILO : '                . $request->plan_harga_pk_perkilo .
            ', PLAN HARGA BERAS PER KILO : '             . $request->plan_harga_beras_perkilo .
            ', PLAN TOTAL HARGA GABAH PER TRUK : '       . $request->plan_total_harga_gabah_pertruk .
            ', PLAN TOTAL HARGA PK PER TRUK : '          . $request->plan_total_harga_pk_pertruk .
            ', PLAN TOTAL HARGA BERAS PERTRUK : '       . $request->plan_total_harga_beras_pertruk .
            ', PLAN HPP AKTUAL : '                      . $request->hpp_aktual .
            ', AKTUAL PRIVE ONGKOS DRIYER : '           . $request->aktual_price_ongkos_driyer .
            ', PLAN HARGA AKTUAL PER TRUK : '            . $request->plan_harga_aktual_pertruk .
            ', PLAN HPP AKTUAL 1 : '                     . $request->plan_hpp_aktual1 .
            ', PLAN HARGA BELI GABAH : '                . $request->plan_harga_beli_gabah .
            ', HARGA BERDASARKAN TEMPAT : '             . $request->harga_berdasarkan_tempat .
            ', HARGA BERDASARKAN HARGA ATAS : '         . $request->harga_berdasarkan_harga_atas .
            ', HARGA AWAL : '                           . $request->harga_awal .
            ', HARGA AKHIR : '                          . $request->plan_harga_potongan_gb;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();


        $po = trackerPO::where('kode_po_tracker', $request->gabahincoming_kode_po)->first();
        if ($po == NULL) {
        } else {
            $po->nama_admin_tracker  = Auth::guard('lab')->user()->name_qc;
            $po->pengajuan_approve_lab2_tracker  = NULL;
            $po->tolak_approve_lab2_tracker  = NULL;
            $po->lab2_tracker  = date('Y-m-d H:i:s');
            $po->proses_tracker  = 'update LAB 2';
            $po->update();
        }
        return response()->json($data);
    }
    public function update_lab2_pk(Request $request)
    {
        if ($request->lokasi_bongkar_pk == 'GRAIN PRO') {
            $lokasi = 'GP';
        } else if ($request->lokasi_bongkar_pk == 'SHIN HEUNG') {
            $lokasi = 'SH';
        }
        DB::table('lab2_pk')->where('lab2_token', $request->lab2_token)->where('lab2_kode_po_pk', $request->lab1_kode_po_pk)
            ->update([
                'ka_pk'                                => $request->ka_pk,
                'pk_pk'                                => $request->pk_pk,
                'pk_bersih_pk'                         => $request->pk_bersih_pk,
                'beras_pk'                             => $request->beras_pk,
                'lokasi_bongkar_pk'                    => $lokasi,
                'butir_patah_pk'                       => $request->butir_patah_pk,
                'reject_pk'                            => $request->reject_pk,
                'hampa_pk'                             => $request->hampa_pk,
                'katul_pk'                             => $request->katul_pk,
                'wh_pk'                                => $request->wh_pk,
                'updated_at_pk'                        => date('Y-m-d H:i:s'),
                'tr_pk'                                => $request->tr_pk,
                'md_pk'                                => $request->md_pk,
                'harga_bongkaran_pk'                   => $request->harga_bongkaran_pk,
                'no_dtm_pk'                            => $request->no_dtm_pk,
                'surveyor_bongkar'                     => $request->surveyor_bongkar,
                'keterangan_bongkar'                   => $request->keterangan_bongkar,
                'waktu_bongkar'                        => $request->waktu_bongkar,
                'tempat_bongkar'                       => $request->tempat_bongkar,
                'z_yang_dibawa'                        => $request->z_yang_dibawa,
                'z_yang_ditolak'                       => $request->z_yang_ditolak,
                'presentase_hampa_pk'                  => $request->presentase_hampa_pk,
                'presentase_pk_bersih_pk'              => $request->presentase_pk_bersih_pk,
                'presentase_beras_pk'                  => $request->presentase_beras_pk,
                'presentase_katul_pk'                  => $request->presentase_katul_pk,
                'presentase_butir_patah_pk'            => $request->presentase_butir_patah_pk,
                'presentase_butir_patah_beras_pk'      => $request->presentase_butir_patah_beras_pk,
                'presentase_reject_pk'                 => $request->presentase_reject_pk,
                'refraksi_ka_pk'                       => $request->refraksi_ka_pk,
                'refraksi_hampa_pk'                    => $request->refraksi_hampa_pk,
                'refraksi_katul_pk'                    => $request->refraksi_katul_pk,
                'refraksi_butir_patah_pk'              => $request->refraksi_butir_patah_pk,
                'reward_hampa_pk'                      => $request->reward_hampa_pk,
                'reward_katul_pk'                      => $request->reward_katul_pk,

                'reward_tr_pk'                         => $request->reward_tr_pk,
                'reward_butir_patah_pk'                => $request->reward_butir_patah_pk,
                'plan_kualitas_pk'                     => $request->plan_kualitas_pk,

                // 'hpp_aktual_pk'                     => $request->hpp_aktual,
                'harga_atas_pk'                        => $request->harga_atas_pk,
                'plan_harga_bongkaran'                 => $request->plan_harga_bongkaran,
                'presentase_pass'                      => $request->presentase_pass,
                'presentase_reject'                    => $request->presentase_reject,
                'plan_tonase_pk'                       => $request->plan_tonase_pk,
                'plan_total_harga_pk'                  => $request->plan_total_harga_pk,

                'plan_tonase_beras_pk'                 => $request->plan_tonase_beras_pk,
                'selisih_ka_pk'                        => $request->selisih_ka_pk,
                'selisih_presentase_hampa_pk'          => $request->selisih_presentase_hampa_pk,
                'selisih_presentase_rendemen_pk_pk'    => $request->selisih_presentase_rendemen_pk_pk,
                'selisih_presentase_katul_pk'          => $request->selisih_presentase_katul_pk,
                'selisih_presentase_rendemen_beras_pk'    => $request->selisih_presentase_rendemen_beras_pk,
                'selisih_presentase_butir_patah_pk'    => $request->selisih_presentase_butir_patah_pk,
                'selisih_wh_pk'                        => $request->selisih_wh_pk,
                'selisih_tr_pk'                        => $request->selisih_tr_pk,
                'selisih_md_pk'                        => $request->selisih_md_pk,
                'selisih_harga_pk'                     => $request->selisih_harga_pk,
                'selisih_aktual_kualitas_pk'           => $request->selisih_aktual_kualitas_pk,
                'selisih_kualitas_bongkaran_pk'        => $request->selisih_kualitas_bongkaran_pk,
                'status_lab2_pk'                       => 11,

            ]);
        return redirect()->back();
    }

    public function output_lab2_gb_ciherang_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->where('bid.name_bid', 'GABAH BASAH CIHERANG')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->orderBy('id_lab2_gb', 'DESC')
                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('status_lab2_gb', function ($list) {
                        if ($list->status_lab2_gb == 11) {
                            return
                                '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-spinner"></i> Check Data
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="approved_lab2" class="dropdown-item" data-id="' . $list->id_lab2_gb . '"><i class="fas fa-check"></i>Approve SPV</button>
							<button id="btn_edit" class="dropdown-item" name="' . $list->id_lab2_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
						</div>
					</div>';
                        } else if ($list->status_lab2_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Approved&nbsp;SPV 
                    </a>';
                        } else {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Menunggu&nbsp;Approved&nbsp;SPV 
                    </a>';
                        }
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('keterangan_penerimaan_po', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('no_dtm', function ($list) {
                        $result = $list->no_dtm;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        if ($list->hasil_akhir_tonase == NULL) {
                            return '<span class="badge rounded-pill bg-success">Proses&nbsp;Timbangan&nbsp;2</span>';
                        } else {
                            $result = number_format($list->hasil_akhir_tonase, 0, ',', '.') . ' Kg';
                            return $result;
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
                    ->addColumn('plan_berat_kg_pertruk', function ($list) {
                        $result = number_format($list->plan_berat_kg_pertruk_gb, 0, ',', '.') . ' Kg';
                        return $result;
                    })
                    ->addColumn('plan_berat_pk_pertruk', function ($list) {
                        $result = number_format($list->plan_berat_pk_pertruk_gb, 0, ',', '.') . ' Kg';
                        return $result;
                    })
                    ->addColumn('plan_berat_beras_pertruk', function ($list) {
                        $result = number_format($list->plan_berat_beras_pertruk_gb, 0, ',', '.') . ' Kg';
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_beli_gabah_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_tempat_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = $list->reaksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = rupiah($list->harga_akhir_gb) . ' /Kg';
                        return $result;
                    })

                    ->rawColumns(['kode_po', 'nama_vendor', 'status_lab2_gb', 'tanggal_bongkar', 'tanggal_po', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            } else {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->where('bid.name_bid', 'GABAH BASAH CIHERANG')
                    ->orderBy('id_lab2_gb', 'DESC')
                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('status_lab2_gb', function ($list) {
                        if ($list->status_lab2_gb == 11) {
                            return
                                '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-spinner"></i> Check Data
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="approved_lab2" class="dropdown-item" data-id="' . $list->id_lab2_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;pprove&nbsp;SPV</button>
							<button id="btn_edit" class="dropdown-item" name="' . $list->id_lab2_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
						</div>
					</div>';
                        } else if ($list->status_lab2_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Approved&nbsp;SPV 
                    </a>';
                        } else if ($list->status_lab2_gb == 12) {
                            if ($list->status_approved == 2) {
                                return
                                    '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-spinner"></i> Tolak&nbsp;Approve<br> (Cek&nbsp;Data)
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_edit" class="dropdown-item" name="' . $list->id_lab2_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" title="Information"><i class="fas fa-edit"></i>Cek Analisa</button>
						</div>
					</div>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Menunggu&nbsp;Approved&nbsp;SPV 
                    </a>';
                            } else {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Menunggu&nbsp;Approved&nbsp;SPV 
                    </a>';
                            }
                        }
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('keterangan_penerimaan_po', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('no_dtm', function ($list) {
                        $result = $list->no_dtm;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        if ($list->hasil_akhir_tonase == NULL) {
                            return '<span class="badge rounded-pill bg-success">Proses&nbsp;Timbangan&nbsp;2</span>';
                        } else {
                            $result = number_format($list->hasil_akhir_tonase, 0, ',', '.') . ' Kg';
                            return $result;
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
                    ->addColumn('plan_berat_kg_pertruk', function ($list) {
                        $result = number_format($list->plan_berat_kg_pertruk_gb, 0, ',', '.') . ' Kg';
                        return $result;
                    })
                    ->addColumn('plan_berat_pk_pertruk', function ($list) {
                        $result = number_format($list->plan_berat_pk_pertruk_gb, 0, ',', '.') . ' Kg';
                        return $result;
                    })
                    ->addColumn('plan_berat_beras_pertruk', function ($list) {
                        $result = number_format($list->plan_berat_beras_pertruk_gb, 0, ',', '.') . ' Kg';
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_gabah_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_beli_gabah_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_tempat_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = $list->reaksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = rupiah($list->harga_akhir_gb) . ' /Kg';
                        return $result;
                    })

                    ->rawColumns(['kode_po', 'nama_vendor', 'status_lab2_gb', 'tanggal_po', 'tanggal_bongkar', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            }
        }
    }
    public function output_lab2_gb_longgrain_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DataPO::join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('bid.name_bid', 'GABAH BASAH LONG GRAIN')
                    ->orderBy('lab2_gb.created_at_gb', 'DESC')
                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->penerimaan_kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('antrian', function ($list) {
                        $result = $list->no_antrian;
                        return '<a style="margin:2px;"  title="Informasi" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        ' . $result . '
                        </a>';
                    })
                    ->addColumn('ckelola_manager', function ($list) {
                        if ($list->status_lab2_gb == 11) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Pengajuan&nbsp;Approved&nbsp;SPV 
                            </a>';
                        } else if ($list->status_lab2_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Approved&nbsp;SPV 
                            </a>';
                        } else if ($list->status_lab2_gb == 12) {
                            if ($list->status_approved == 2) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                Tolak&nbsp;Approved&nbsp;SPV 
                                </a>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                Menunggu&nbsp;Approved&nbsp;SPV 
                                </a>';
                            } else {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                Menunggu&nbsp;Approved&nbsp;SPV 
                                </a>';
                            }
                        }
                    })
                    ->addColumn('status_lab2_gb', function ($list) {
                        if ($list->status_lab2_gb == 11) {
                            if ($list->hasil_akhir_tonase != '') {
                                return
                                    '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-spinner"></i> Check Data
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <button id="approved_lab2" class="dropdown-item" data-id="' . $list->id_lab2_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;pprove&nbsp;SPV</button>
                                <a type="button" href="' . route('qc.lab.output_edit_proses_lab2_gb', ['id' => $list->id_lab2_gb]) . '" id="btn_edit" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>Edit</a>
                            </div>
                                </div>';
                            } else {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-spinner"></i> Check Data
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                            <button id="approved_lab2_notif" class="dropdown-item" data-id="' . $list->id_lab2_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;pprove&nbsp;SPV</button>
                            <a type="button" href="' . route('qc.lab.output_edit_proses_lab2_gb', ['id' => $list->id_lab2_gb]) . '" id="btn_edit" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>Edit</a>
                        </div>
                            </div>';
                            }
                        } else if ($list->status_lab2_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Approved&nbsp;SPV 
                        </a>';
                        } else if ($list->status_lab2_gb == 12) {
                            if ($list->status_approved == 2) {
                                return
                                    '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-spinner"></i> Tolak&nbsp;Approve<br> (Cek&nbsp;Data)
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <a type="button" href="' . route('qc.lab.output_edit_proses_lab2_gb', ['id' => $list->id_lab2_gb]) . '" id="btn_edit" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>Edit</a>
                                </div>
                                </div>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                Menunggu&nbsp;Approved&nbsp;SPV 
                                </a>';
                            } else {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                Menunggu&nbsp;Approved&nbsp;SPV 
                                </a>';
                            }
                        }
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('keterangan_penerimaan_po', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('no_dtm', function ($list) {
                        $result = $list->dtm_gb;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        if ($list->hasil_akhir_tonase == NULL) {
                            return '<span class="badge rounded-pill bg-success">Proses&nbsp;Timbangan&nbsp;2</span>';
                        } else {
                            $result = tonase($list->hasil_akhir_tonase) . ' Kg';
                            return $result;
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
                    ->addColumn('plan_berat_kg_pertruk', function ($list) {
                        if ($list->plan_berat_kg_pertruk_gb == '') {
                            $result = 'Rp. 0';
                        } else {

                            $result = rupiah($list->plan_berat_kg_pertruk_gb) . ' Kg';
                        }
                        return $result;
                    })
                    ->addColumn('plan_berat_pk_pertruk', function ($list) {
                        if ($list->plan_berat_pk_pertruk_gb == '') {
                            $result = 'Rp. 0';
                        } else {

                            $result = rupiah($list->plan_berat_pk_pertruk_gb) . ' Kg';
                        }
                        return $result;
                    })
                    ->addColumn('plan_berat_beras_pertruk', function ($list) {
                        if ($list->plan_berat_beras_pertruk_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->plan_berat_beras_pertruk_gb) . ' Kg';
                        }
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        if ($list->plan_harga_gabah_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->plan_harga_gabah_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        if ($list->plan_harga_beli_gabah_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->plan_harga_beli_gabah_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        if ($list->harga_berdasarkan_tempat_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_tempat_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        if ($list->harga_berdasarkan_harga_atas_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        }
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        if ($list->harga_awal_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_awal_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = $list->reaksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        if ($list->harga_akhir_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_akhir_gb) . ' /Kg';
                        }
                        return $result;
                    })

                    ->rawColumns(['kode_po', 'antrian', 'nama_vendor', 'ckelola_manager', 'status_lab2_gb', 'tanggal_po', 'tanggal_bongkar', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            } else {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('bid.name_bid', 'GABAH BASAH LONG GRAIN')
                    ->orderBy('lab2_gb.created_at_gb', 'DESC')
                    ->select('penerimaan_po.*', 'data_po.tanggal_po', 'users.nama_vendor', 'bid.name_bid', 'lab2_gb.*')
                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->penerimaan_kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('antrian', function ($list) {
                        $result = $list->no_antrian;
                        return '<a style="margin:2px;"  title="Informasi" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        ' . $result . '
                        </a>';
                    })
                    ->addColumn('ckelola_manager', function ($list) {
                        if ($list->status_lab2_gb == 11) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Pengajuan&nbsp;Approved&nbsp;SPV 
                            </a>';
                        } else if ($list->status_lab2_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Approved&nbsp;SPV 
                            </a>';
                        } else if ($list->status_lab2_gb == 12) {
                            if ($list->status_approved == 2) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                Tolak&nbsp;Approved&nbsp;SPV 
                                </a>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                Menunggu&nbsp;Approved&nbsp;SPV 
                                </a>';
                            } else {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                Menunggu&nbsp;Approved&nbsp;SPV 
                                </a>';
                            }
                        }
                    })
                    ->addColumn('status_lab2_gb', function ($list) {
                        if ($list->status_lab2_gb == 11) {
                            if ($list->hasil_akhir_tonase != '') {
                                return
                                    '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-spinner"></i> Check Data
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <button id="approved_lab2" class="dropdown-item" data-id="' . $list->id_lab2_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;pprove&nbsp;SPV</button>
                              <a type="button" href="' . route('qc.lab.output_edit_proses_lab2_gb', ['id' => $list->id_lab2_gb]) . '" id="btn_edit" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>Edit</a>
                            </div>
                                </div>';
                            } else {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-spinner"></i> Check Data
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                            <button id="approved_lab2_notif" class="dropdown-item" data-id="' . $list->id_lab2_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;pprove&nbsp;SPV</button>
                           <a type="button" href="' . route('qc.lab.output_edit_proses_lab2_gb', ['id' => $list->id_lab2_gb]) . '" id="btn_edit" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>Edit</a>
                        </div>
                            </div>';
                            }
                        } else if ($list->status_lab2_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Approved&nbsp;SPV 
                        </a>';
                        } else if ($list->status_lab2_gb == 12) {
                            if ($list->status_approved == 2) {
                                return
                                    '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-spinner"></i> Tolak&nbsp;Approve<br> (Cek&nbsp;Data)
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <a type="button" href="' . route('qc.lab.output_edit_proses_lab2_gb', ['id' => $list->id_lab2_gb]) . '" id="btn_edit" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>Edit</a>
                                </div>
                                </div>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                Menunggu&nbsp;Approved&nbsp;SPV 
                                </a>';
                            } else {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                Menunggu&nbsp;Approved&nbsp;SPV 
                                </a>';
                            }
                        }
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('keterangan_penerimaan_po', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('no_dtm', function ($list) {
                        $result = $list->dtm_gb;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        if ($list->hasil_akhir_tonase == NULL) {
                            return '<span class="badge rounded-pill bg-success">Proses&nbsp;Timbangan&nbsp;2</span>';
                        } else {
                            $result = tonase($list->hasil_akhir_tonase) . ' Kg';
                            return $result;
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
                    ->addColumn('plan_berat_kg_pertruk', function ($list) {
                        if ($list->plan_berat_kg_pertruk_gb == '') {
                            $result = 'Rp. 0';
                        } else {

                            $result = rupiah($list->plan_berat_kg_pertruk_gb) . ' Kg';
                        }
                        return $result;
                    })
                    ->addColumn('plan_berat_pk_pertruk', function ($list) {
                        if ($list->plan_berat_pk_pertruk_gb == '') {
                            $result = 'Rp. 0';
                        } else {

                            $result = rupiah($list->plan_berat_pk_pertruk_gb) . ' Kg';
                        }
                        return $result;
                    })
                    ->addColumn('plan_berat_beras_pertruk', function ($list) {
                        if ($list->plan_berat_beras_pertruk_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->plan_berat_beras_pertruk_gb) . ' Kg';
                        }
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        if ($list->plan_harga_gabah_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->plan_harga_gabah_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        if ($list->plan_harga_beli_gabah_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->plan_harga_beli_gabah_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        if ($list->harga_berdasarkan_tempat_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_tempat_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        if ($list->harga_berdasarkan_harga_atas_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        }
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        if ($list->harga_awal_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_awal_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = $list->reaksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        if ($list->harga_akhir_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_akhir_gb) . ' /Kg';
                        }
                        return $result;
                    })

                    ->rawColumns(['kode_po', 'antrian', 'nama_vendor', 'ckelola_manager', 'status_lab2_gb', 'tanggal_po', 'tanggal_bongkar', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            }
        }
    }
    public function output_lab2_gb_pandan_wangi_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('bid.name_bid', 'GABAH BASAH PANDAN WANGI')
                    ->orderBy('id_lab2_gb', 'DESC')
                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('status_lab2_gb', function ($list) {
                        if ($list->status_lab2_gb == 11) {
                            if ($list->hasil_akhir_tonase != '') {
                                return
                                    '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-spinner"></i> Check Data
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <button id="approved_lab2" class="dropdown-item" data-id="' . $list->id_lab2_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;pprove&nbsp;SPV</button>
                                <button id="btn_edit" class="dropdown-item" name="' . $list->id_lab2_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
                            </div>
                                </div>';
                            } else {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-spinner"></i> Check Data
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                            <button id="approved_lab2_notif" class="dropdown-item" data-id="' . $list->id_lab2_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;pprove&nbsp;SPV</button>
                            <button id="btn_edit" class="dropdown-item" name="' . $list->id_lab2_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
                        </div>
                            </div>';
                            }
                        } else if ($list->status_lab2_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Approved&nbsp;SPV 
                        </a>';
                        } else if ($list->status_lab2_gb == 12) {
                            if ($list->status_approved == 2) {
                                return
                                    '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-spinner"></i> Tolak&nbsp;Approve<br> (Cek&nbsp;Data)
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button id="btn_edit" class="dropdown-item" name="' . $list->id_lab2_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" title="Information"><i class="fas fa-edit"></i>Cek Analisa</button>
                                </div>
                                </div>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                Menunggu&nbsp;Approved&nbsp;SPV 
                                </a>';
                            } else {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                Menunggu&nbsp;Approved&nbsp;SPV 
                                </a>';
                            }
                        }
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('keterangan_penerimaan_po', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('no_dtm', function ($list) {
                        $result = $list->dtm_gb;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        if ($list->hasil_akhir_tonase == NULL) {
                            return '<span class="badge rounded-pill bg-success">Proses&nbsp;Timbangan&nbsp;2</span>';
                        } else {
                            $result = number_format($list->hasil_akhir_tonase, 0, ',', '.') . ' Kg';
                            return $result;
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
                    ->addColumn('plan_berat_kg_pertruk', function ($list) {
                        if ($list->plan_berat_kg_pertruk_gb == '') {
                            $result = 'Rp. 0';
                        } else {

                            $result = rupiah($list->plan_berat_kg_pertruk_gb) . ' Kg';
                        }
                        return $result;
                    })
                    ->addColumn('plan_berat_pk_pertruk', function ($list) {
                        if ($list->plan_berat_pk_pertruk_gb == '') {
                            $result = 'Rp. 0';
                        } else {

                            $result = rupiah($list->plan_berat_pk_pertruk_gb) . ' Kg';
                        }
                        return $result;
                    })
                    ->addColumn('plan_berat_beras_pertruk', function ($list) {
                        if ($list->plan_berat_beras_pertruk_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->plan_berat_beras_pertruk_gb) . ' Kg';
                        }
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        if ($list->plan_harga_gabah_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->plan_harga_gabah_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        if ($list->plan_harga_beli_gabah_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->plan_harga_beli_gabah_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        if ($list->harga_berdasarkan_tempat_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_tempat_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        if ($list->harga_berdasarkan_harga_atas_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        }
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        if ($list->harga_awal_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_awal_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = $list->reaksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        if ($list->harga_akhir_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_akhir_gb) . ' /Kg';
                        }
                        return $result;
                    })

                    ->rawColumns(['kode_po', 'nama_vendor', 'status_lab2_gb', 'tanggal_po', 'tanggal_bongkar', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            } else {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('bid.name_bid', 'GABAH BASAH PANDAN WANGI')
                    ->orderBy('id_lab2_gb', 'DESC')
                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('status_lab2_gb', function ($list) {
                        if ($list->status_lab2_gb == 11) {
                            if ($list->hasil_akhir_tonase != '') {
                                return
                                    '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-spinner"></i> Check Data
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <button id="approved_lab2" class="dropdown-item" data-id="' . $list->id_lab2_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;pprove&nbsp;SPV</button>
                                <button id="btn_edit" class="dropdown-item" name="' . $list->id_lab2_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
                            </div>
                                </div>';
                            } else {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-spinner"></i> Check Data
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                            <button id="approved_lab2_notif" class="dropdown-item" data-id="' . $list->id_lab2_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;pprove&nbsp;SPV</button>
                            <button id="btn_edit" class="dropdown-item" name="' . $list->id_lab2_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
                        </div>
                            </div>';
                            }
                        } else if ($list->status_lab2_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Approved&nbsp;SPV 
                        </a>';
                        } else if ($list->status_lab2_gb == 12) {
                            if ($list->status_approved == 2) {
                                return
                                    '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-spinner"></i> Tolak&nbsp;Approve<br> (Cek&nbsp;Data)
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button id="btn_edit" class="dropdown-item" name="' . $list->id_lab2_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" title="Information"><i class="fas fa-edit"></i>Cek Analisa</button>
                                </div>
                                </div>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                Menunggu&nbsp;Approved&nbsp;SPV 
                                </a>';
                            } else {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                Menunggu&nbsp;Approved&nbsp;SPV 
                                </a>';
                            }
                        }
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('keterangan_penerimaan_po', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('no_dtm', function ($list) {
                        $result = $list->dtm_gb;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        if ($list->hasil_akhir_tonase == NULL) {
                            return '<span class="badge rounded-pill bg-success">Proses&nbsp;Timbangan&nbsp;2</span>';
                        } else {
                            $result = number_format($list->hasil_akhir_tonase, 0, ',', '.') . ' Kg';
                            return $result;
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
                    ->addColumn('plan_berat_kg_pertruk', function ($list) {
                        if ($list->plan_berat_kg_pertruk_gb == '') {
                            $result = 'Rp. 0';
                        } else {

                            $result = rupiah($list->plan_berat_kg_pertruk_gb) . ' Kg';
                        }
                        return $result;
                    })
                    ->addColumn('plan_berat_pk_pertruk', function ($list) {
                        if ($list->plan_berat_pk_pertruk_gb == '') {
                            $result = 'Rp. 0';
                        } else {

                            $result = rupiah($list->plan_berat_pk_pertruk_gb) . ' Kg';
                        }
                        return $result;
                    })
                    ->addColumn('plan_berat_beras_pertruk', function ($list) {
                        if ($list->plan_berat_beras_pertruk_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->plan_berat_beras_pertruk_gb) . ' Kg';
                        }
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        if ($list->plan_harga_gabah_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->plan_harga_gabah_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        if ($list->plan_harga_beli_gabah_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->plan_harga_beli_gabah_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        if ($list->harga_berdasarkan_tempat_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_tempat_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        if ($list->harga_berdasarkan_harga_atas_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        }
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        if ($list->harga_awal_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_awal_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = $list->reaksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        if ($list->harga_akhir_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_akhir_gb) . ' /Kg';
                        }
                        return $result;
                    })

                    ->rawColumns(['kode_po', 'nama_vendor', 'status_lab2_gb', 'tanggal_po', 'tanggal_bongkar', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            }
        }
    }
    public function output_lab2_gb_ketan_putih_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('bid.name_bid', 'GABAH BASAH KETAN PUTIH')
                    ->orderBy('id_lab2_gb', 'DESC')
                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('status_lab2_gb', function ($list) {
                        if ($list->status_lab2_gb == 11) {
                            if ($list->hasil_akhir_tonase != '') {
                                return
                                    '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-spinner"></i> Check Data
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <button id="approved_lab2" class="dropdown-item" data-id="' . $list->id_lab2_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;pprove&nbsp;SPV</button>
                                <button id="btn_edit" class="dropdown-item" name="' . $list->id_lab2_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
                            </div>
                                </div>';
                            } else {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-spinner"></i> Check Data
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                            <button id="approved_lab2_notif" class="dropdown-item" data-id="' . $list->id_lab2_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;pprove&nbsp;SPV</button>
                            <button id="btn_edit" class="dropdown-item" name="' . $list->id_lab2_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
                        </div>
                            </div>';
                            }
                        } else if ($list->status_lab2_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Approved&nbsp;SPV 
                        </a>';
                        } else if ($list->status_lab2_gb == 12) {
                            if ($list->status_approved == 2) {
                                return
                                    '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-spinner"></i> Tolak&nbsp;Approve<br> (Cek&nbsp;Data)
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button id="btn_edit" class="dropdown-item" name="' . $list->id_lab2_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" title="Information"><i class="fas fa-edit"></i>Cek Analisa</button>
                                </div>
                                </div>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                Menunggu&nbsp;Approved&nbsp;SPV 
                                </a>';
                            } else {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                Menunggu&nbsp;Approved&nbsp;SPV 
                                </a>';
                            }
                        }
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('keterangan_penerimaan_po', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('no_dtm', function ($list) {
                        $result = $list->dtm_gb;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        if ($list->hasil_akhir_tonase == NULL) {
                            return '<span class="badge rounded-pill bg-success">Proses&nbsp;Timbangan&nbsp;2</span>';
                        } else {
                            $result = number_format($list->hasil_akhir_tonase, 0, ',', '.') . ' Kg';
                            return $result;
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
                    ->addColumn('plan_berat_kg_pertruk', function ($list) {
                        if ($list->plan_berat_kg_pertruk_gb == '') {
                            $result = 'Rp. 0';
                        } else {

                            $result = rupiah($list->plan_berat_kg_pertruk_gb) . ' Kg';
                        }
                        return $result;
                    })
                    ->addColumn('plan_berat_pk_pertruk', function ($list) {
                        if ($list->plan_berat_pk_pertruk_gb == '') {
                            $result = 'Rp. 0';
                        } else {

                            $result = rupiah($list->plan_berat_pk_pertruk_gb) . ' Kg';
                        }
                        return $result;
                    })
                    ->addColumn('plan_berat_beras_pertruk', function ($list) {
                        if ($list->plan_berat_beras_pertruk_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->plan_berat_beras_pertruk_gb) . ' Kg';
                        }
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        if ($list->plan_harga_gabah_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->plan_harga_gabah_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        if ($list->plan_harga_beli_gabah_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->plan_harga_beli_gabah_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        if ($list->harga_berdasarkan_tempat_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_tempat_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        if ($list->harga_berdasarkan_harga_atas_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        }
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        if ($list->harga_awal_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_awal_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = $list->reaksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        if ($list->harga_akhir_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_akhir_gb) . ' /Kg';
                        }
                        return $result;
                    })

                    ->rawColumns(['kode_po', 'nama_vendor', 'status_lab2_gb', 'tanggal_po', 'tanggal_bongkar', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            } else {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('bid.name_bid', 'GABAH BASAH KETAN PUTIH')
                    ->orderBy('id_lab2_gb', 'DESC')
                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('status_lab2_gb', function ($list) {
                        if ($list->status_lab2_gb == 11) {
                            if ($list->hasil_akhir_tonase != '') {
                                return
                                    '<div class="dropdown">
                            <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-spinner"></i> Check Data
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <button id="approved_lab2" class="dropdown-item" data-id="' . $list->id_lab2_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;pprove&nbsp;SPV</button>
                                <button id="btn_edit" class="dropdown-item" name="' . $list->id_lab2_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
                            </div>
                                </div>';
                            } else {
                                return
                                    '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-spinner"></i> Check Data
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                            <button id="approved_lab2_notif" class="dropdown-item" data-id="' . $list->id_lab2_gb . '"><i class="fas fa-check"></i>Ajukan&nbsp;pprove&nbsp;SPV</button>
                            <button id="btn_edit" class="dropdown-item" name="' . $list->id_lab2_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
                        </div>
                            </div>';
                            }
                        } else if ($list->status_lab2_gb == 13) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Approved&nbsp;SPV 
                        </a>';
                        } else if ($list->status_lab2_gb == 12) {
                            if ($list->status_approved == 2) {
                                return
                                    '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-spinner"></i> Tolak&nbsp;Approve<br> (Cek&nbsp;Data)
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button id="btn_edit" class="dropdown-item" name="' . $list->id_lab2_gb . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '" data-item="' . $list->name_bid . '" title="Information"><i class="fas fa-edit"></i>Cek Analisa</button>
                                </div>
                                </div>';
                            } else if ($list->status_approved == 1) {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                Menunggu&nbsp;Approved&nbsp;SPV 
                                </a>';
                            } else {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                Menunggu&nbsp;Approved&nbsp;SPV 
                                </a>';
                            }
                        }
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('keterangan_penerimaan_po', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('no_dtm', function ($list) {
                        $result = $list->dtm_gb;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        if ($list->hasil_akhir_tonase == NULL) {
                            return '<span class="badge rounded-pill bg-success">Proses&nbsp;Timbangan&nbsp;2</span>';
                        } else {
                            $result = number_format($list->hasil_akhir_tonase, 0, ',', '.') . ' Kg';
                            return $result;
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
                    ->addColumn('plan_berat_kg_pertruk', function ($list) {
                        if ($list->plan_berat_kg_pertruk_gb == '') {
                            $result = 'Rp. 0';
                        } else {

                            $result = rupiah($list->plan_berat_kg_pertruk_gb) . ' Kg';
                        }
                        return $result;
                    })
                    ->addColumn('plan_berat_pk_pertruk', function ($list) {
                        if ($list->plan_berat_pk_pertruk_gb == '') {
                            $result = 'Rp. 0';
                        } else {

                            $result = rupiah($list->plan_berat_pk_pertruk_gb) . ' Kg';
                        }
                        return $result;
                    })
                    ->addColumn('plan_berat_beras_pertruk', function ($list) {
                        if ($list->plan_berat_beras_pertruk_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->plan_berat_beras_pertruk_gb) . ' Kg';
                        }
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        if ($list->plan_harga_gabah_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->plan_harga_gabah_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        if ($list->plan_harga_beli_gabah_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->plan_harga_beli_gabah_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        if ($list->harga_berdasarkan_tempat_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_tempat_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        if ($list->harga_berdasarkan_harga_atas_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        }
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        if ($list->harga_awal_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_awal_gb) . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = $list->reaksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        if ($list->harga_akhir_gb == '') {
                            $result = 'Rp. 0';
                        } else {
                            $result = rupiah($list->harga_akhir_gb) . ' /Kg';
                        }
                        return $result;
                    })

                    ->rawColumns(['kode_po', 'nama_vendor', 'status_lab2_gb', 'tanggal_po', 'tanggal_bongkar', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            }
        }
    }
    public function output_deal_lab2_pk_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))

                    ->orderBy('id_lab2_pk', 'DESC')
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
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('keterangan_penerimaan_po', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('no_dtm', function ($list) {
                        $result = $list->no_dtm_pk;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        if ($list->hasil_akhir_tonase == NULL) {
                            return '<span class="badge rounded-pill bg-success">Proses&nbsp;Timbangan&nbsp;2</span>';
                        } else {
                            $result = $list->hasil_akhir_tonase;
                            return $result;
                        }
                    })

                    ->addColumn('ka_pk', function ($list) {
                        $result = $list->ka_pk;
                        return $result . '%';
                    })
                    ->addColumn('pk_pk', function ($list) {
                        $result = $list->pk_pk;
                        return $result . '%';
                    })
                    ->addColumn('wh_pk', function ($list) {
                        $result = $list->wh_pk;
                        return $result . '%';
                    })
                    ->addColumn('tr_pk', function ($list) {
                        $result = $list->tr_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_hampa_pk', function ($list) {
                        $result = $list->presentase_hampa_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_pk_bersih_pk', function ($list) {
                        $result = $list->presentase_pk_bersih_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_katul_pk', function ($list) {
                        $result = $list->presentase_katul_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_beras_pk', function ($list) {
                        $result = $list->presentase_beras_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_butir_patah_pk', function ($list) {
                        $result = $list->presentase_butir_patah_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_butir_patah_beras_pk', function ($list) {
                        $result = $list->presentase_butir_patah_beras_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_reject_pk', function ($list) {
                        $result = $list->presentase_reject_pk;
                        return $result . '%';
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
                    ->addColumn('harga_atas_pk', function ($list) {
                        $result = $list->harga_atas_pk;
                        return rupiah($result);
                    })
                    ->addColumn('plan_harga_bongkaran_pk', function ($list) {
                        $result = $list->plan_harga_bongkaran;
                        return rupiah($result);
                    })
                    ->addColumn('harga_bongkaran_pk', function ($list) {
                        $result = $list->harga_bongkaran_pk;
                        return rupiah($result);
                    })
                    ->addColumn('presentase_pass', function ($list) {
                        $result = $list->presentase_pass;
                        return $result . '%';
                    })
                    ->addColumn('presentase_reject', function ($list) {
                        $result = $list->presentase_reject;
                        return $result . '%';
                    })
                    ->addColumn('plan_total_harga_pk', function ($list) {
                        $result = $list->plan_total_harga_pk;
                        return rupiah($result);
                    })
                    ->addColumn('selisih_ka_pk', function ($list) {
                        $result = $list->selisih_ka_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_hampa_pk', function ($list) {
                        $result = $list->selisih_presentase_hampa_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_rendemen_pk', function ($list) {
                        $result = $list->selisih_presentase_rendemen_pk_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_katul_pk', function ($list) {
                        $result = $list->selisih_presentase_katul_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_rendemen_beras_pk', function ($list) {
                        $result = $list->selisih_presentase_rendemen_beras_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_butir_patah_pk', function ($list) {
                        $result = $list->selisih_presentase_butir_patah_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_wh_pk', function ($list) {
                        $result = $list->selisih_wh_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_tr_pk', function ($list) {
                        $result = $list->selisih_tr_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_harga_pk', function ($list) {
                        $result = $list->selisih_harga_pk;
                        return rupiah($result);
                    })

                    ->rawColumns(['kode_po', 'nama_vendor', 'status_lab2_pk', 'tanggal_po', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'ka_pk', 'wh_pk', 'tr_pk', 'pk_pk', 'presentase_hampa_pk', 'presentase_pk_bersih_pk', 'presentase_katul_pk', 'presentase_beras_pk', 'presentase_butir_patah_pk', 'presentase_butir_patah_beras_pk', 'presentase_reject_pk', 'refraksi_ka_pk', 'refraksi_hampa_pk', 'refraksi_katul_pk', 'refraksi_butir_patah_pk', 'reward_hampa_pk', 'reward_katul_pk', 'reward_tr_pk', 'reward_butir_patah_pk', 'harga_atas_pk', 'plan_harga_bongkaran', 'presentase_pass', 'harga_bongkaran_pk', 'presentase_reject', 'plan_total_harga_pk', 'selisih_ka_pk', 'selisih_presentase_hampa_pk', 'selisih_presentase_rendemen_pk_pk', 'selisih_presentase_katul_pk', 'selisih_presentase_rendemen_beras_pk', 'selisih_presentase_butir_patah_pk', 'selisih_wh_pk', 'selisih_tr_pk', 'selisih_harga_pk'])
                    ->make(true);
            } else {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')

                    ->orderBy('id_lab2_pk', 'DESC')
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
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('keterangan_penerimaan_po', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('no_dtm', function ($list) {
                        $result = $list->no_dtm_pk;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        if ($list->hasil_akhir_tonase == NULL) {
                            return '<span class="badge rounded-pill bg-success">Proses&nbsp;Timbangan&nbsp;2</span>';
                        } else {
                            $result = $list->hasil_akhir_tonase;
                            return $result;
                        }
                    })

                    ->addColumn('ka_pk', function ($list) {
                        $result = $list->ka_pk;
                        return $result . '%';
                    })
                    ->addColumn('pk_pk', function ($list) {
                        $result = $list->pk_pk;
                        return $result . '%';
                    })
                    ->addColumn('wh_pk', function ($list) {
                        $result = $list->wh_pk;
                        return $result . '%';
                    })
                    ->addColumn('tr_pk', function ($list) {
                        $result = $list->tr_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_hampa_pk', function ($list) {
                        $result = $list->presentase_hampa_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_pk_bersih_pk', function ($list) {
                        $result = $list->presentase_pk_bersih_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_katul_pk', function ($list) {
                        $result = $list->presentase_katul_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_beras_pk', function ($list) {
                        $result = $list->presentase_beras_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_butir_patah_pk', function ($list) {
                        $result = $list->presentase_butir_patah_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_butir_patah_beras_pk', function ($list) {
                        $result = $list->presentase_butir_patah_beras_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_reject_pk', function ($list) {
                        $result = $list->presentase_reject_pk;
                        return $result . '%';
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
                    ->addColumn('harga_atas_pk', function ($list) {
                        $result = $list->harga_atas_pk;
                        return rupiah($result);
                    })
                    ->addColumn('plan_harga_bongkaran_pk', function ($list) {
                        $result = $list->plan_harga_bongkaran;
                        return rupiah($result);
                    })
                    ->addColumn('harga_bongkaran_pk', function ($list) {
                        $result = $list->harga_bongkaran_pk;
                        return rupiah($result);
                    })
                    ->addColumn('presentase_pass', function ($list) {
                        $result = $list->presentase_pass;
                        return $result . '%';
                    })
                    ->addColumn('presentase_reject', function ($list) {
                        $result = $list->presentase_reject;
                        return $result . '%';
                    })
                    ->addColumn('plan_total_harga_pk', function ($list) {
                        $result = $list->plan_total_harga_pk;
                        return rupiah($result);
                    })
                    ->addColumn('selisih_ka_pk', function ($list) {
                        $result = $list->selisih_ka_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_hampa_pk', function ($list) {
                        $result = $list->selisih_presentase_hampa_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_rendemen_pk', function ($list) {
                        $result = $list->selisih_presentase_rendemen_pk_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_katul_pk', function ($list) {
                        $result = $list->selisih_presentase_katul_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_rendemen_beras_pk', function ($list) {
                        $result = $list->selisih_presentase_rendemen_beras_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_butir_patah_pk', function ($list) {
                        $result = $list->selisih_presentase_butir_patah_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_wh_pk', function ($list) {
                        $result = $list->selisih_wh_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_tr_pk', function ($list) {
                        $result = $list->selisih_tr_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_harga_pk', function ($list) {
                        $result = $list->selisih_harga_pk;
                        return rupiah($result);
                    })

                    ->rawColumns(['kode_po', 'nama_vendor', 'status_lab2_pk', 'tanggal_po', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'ka_pk', 'wh_pk', 'tr_pk', 'pk_pk', 'presentase_hampa_pk', 'presentase_pk_bersih_pk', 'presentase_katul_pk', 'presentase_beras_pk', 'presentase_butir_patah_pk', 'presentase_butir_patah_beras_pk', 'presentase_reject_pk', 'refraksi_ka_pk', 'refraksi_hampa_pk', 'refraksi_katul_pk', 'refraksi_butir_patah_pk', 'reward_hampa_pk', 'reward_katul_pk', 'reward_tr_pk', 'reward_butir_patah_pk', 'harga_atas_pk', 'plan_harga_bongkaran', 'presentase_pass', 'harga_bongkaran_pk', 'presentase_reject', 'plan_total_harga_pk', 'selisih_ka_pk', 'selisih_presentase_hampa_pk', 'selisih_presentase_rendemen_pk_pk', 'selisih_presentase_katul_pk', 'selisih_presentase_rendemen_beras_pk', 'selisih_presentase_butir_patah_pk', 'selisih_wh_pk', 'selisih_tr_pk', 'selisih_harga_pk'])
                    ->make(true);
            }
        }
    }
    public function output_deal_lab2_gb_longgrain_index(Request $request)
    {

        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->where('bid.name_bid', 'GABAH BASAH LONG GRAIN')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('status_gabahfinishing_qc', function ($list) {
                        $result = $list->status_lab2_gb;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('keterangan_penerimaan_po', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('no_dtm', function ($list) {
                        $result = $list->dtm_gb;
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
                        $result = tonase($list->hasil_akhir_tonase);
                        return $result;
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
                    ->addColumn('plan_berat_kg_pertruk', function ($list) {
                        $result = $list->plan_berat_kg_pertruk_gb;
                        return $result;
                    })
                    ->addColumn('plan_berat_pk_pertruk', function ($list) {
                        $result = $list->plan_berat_pk_pertruk_gb;
                        return $result;
                    })
                    ->addColumn('plan_berat_beras_pertruk', function ($list) {
                        $result = $list->plan_berat_beras_pertruk_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = $list->plan_harga_gabah_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->plan_harga_gabah_gb);
                        }
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->plan_harga_beli_gabah_gb);
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_tempat_gb);
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = $list->harga_berdasarkan_harga_atas_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_harga_atas_gb);
                        }
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        $result = $list->harga_awal_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->harga_awal_gb);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = $list->reaksi_harga_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->reaksi_harga_gb);
                        }
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == null | $result == '') {
                            if ($list->harga_akhir_gb == 'TOLAK') {
                                return 'TOLAK';
                            } else {
                                $result = rupiah($list->harga_akhir_gb) . '/Kg';
                                return $result;
                            }
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                            return $result;
                        }
                    })
                    ->rawColumns(['kode_po', 'tonase_awal', 'tonase_akhir', 'tanggal_po', 'tanggal_bongkar', 'nama_vendor', 'status_lab2_gb', 'date_bid', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            } else {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->where('bid.name_bid', 'GABAH BASAH LONG GRAIN')
                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('status_gabahfinishing_qc', function ($list) {
                        $result = $list->status_lab2_gb;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('keterangan_penerimaan_po', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('no_dtm', function ($list) {
                        $result = $list->dtm_gb;
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
                        $result = tonase($list->hasil_akhir_tonase);
                        return $result;
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
                    ->addColumn('plan_berat_kg_pertruk', function ($list) {
                        $result = $list->plan_berat_kg_pertruk_gb;
                        return $result;
                    })
                    ->addColumn('plan_berat_pk_pertruk', function ($list) {
                        $result = $list->plan_berat_pk_pertruk_gb;
                        return $result;
                    })
                    ->addColumn('plan_berat_beras_pertruk', function ($list) {
                        $result = $list->plan_berat_beras_pertruk_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = $list->plan_harga_gabah_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->plan_harga_gabah_gb);
                        }
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->plan_harga_beli_gabah_gb);
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_tempat_gb);
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = $list->harga_berdasarkan_harga_atas_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_harga_atas_gb);
                        }
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        $result = $list->harga_awal_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->harga_awal_gb);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = $list->reaksi_harga_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->reaksi_harga_gb);
                        }
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == null | $result == '') {
                            if ($list->harga_akhir_gb == 'TOLAK') {
                                return 'TOLAK';
                            } else {
                                $result = rupiah($list->harga_akhir_gb) . '/Kg';
                                return $result;
                            }
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                            return $result;
                        }
                    })

                    ->rawColumns(['kode_po', 'nama_vendor', 'tonase_awal', 'tonase_akhir', 'tanggal_po', 'tanggal_bongkar', 'status_gabahfinishing_qc', 'date_bid', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            }
        }
    }
    public function output_deal_lab2_gb_pandan_wangi_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->where('bid.name_bid', 'GABAH BASAH PANDAN WANGI')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('status_gabahfinishing_qc', function ($list) {
                        $result = $list->status_lab2_gb;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('keterangan_penerimaan_po', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('no_dtm', function ($list) {
                        $result = $list->dtm_gb;
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
                        $result = tonase($list->hasil_akhir_tonase);
                        return $result;
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
                    ->addColumn('plan_berat_kg_pertruk', function ($list) {
                        $result = $list->plan_berat_kg_pertruk_gb;
                        return $result;
                    })
                    ->addColumn('plan_berat_pk_pertruk', function ($list) {
                        $result = $list->plan_berat_pk_pertruk_gb;
                        return $result;
                    })
                    ->addColumn('plan_berat_beras_pertruk', function ($list) {
                        $result = $list->plan_berat_beras_pertruk_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = $list->plan_harga_gabah_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->plan_harga_gabah_gb);
                        }
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->plan_harga_beli_gabah_gb);
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_tempat_gb);
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = $list->harga_berdasarkan_harga_atas_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_harga_atas_gb);
                        }
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        $result = $list->harga_awal_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->harga_awal_gb);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = $list->reaksi_harga_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->reaksi_harga_gb);
                        }
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == null | $result == '') {
                            if ($list->harga_akhir_gb == 'TOLAK') {
                                return 'TOLAK';
                            } else {
                                $result = rupiah($list->harga_akhir_gb) . '/Kg';
                                return $result;
                            }
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                            return $result;
                        }
                    })
                    ->rawColumns(['kode_po', 'tonase_awal', 'tonase_akhir', 'nama_vendor', 'tanggal_po', 'tanggal_bongkar', 'status_lab2_gb', 'date_bid', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            } else {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
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
                    ->addColumn('status_gabahfinishing_qc', function ($list) {
                        $result = $list->status_lab2_gb;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return $result;
                    })
                    ->addColumn('keterangan_penerimaan_po', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('no_dtm', function ($list) {
                        $result = $list->dtm_gb;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
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
                    ->addColumn('plan_berat_kg_pertruk', function ($list) {
                        $result = $list->plan_berat_kg_pertruk_gb;
                        return $result;
                    })
                    ->addColumn('plan_berat_pk_pertruk', function ($list) {
                        $result = $list->plan_berat_pk_pertruk_gb;
                        return $result;
                    })
                    ->addColumn('plan_berat_beras_pertruk', function ($list) {
                        $result = $list->plan_berat_beras_pertruk_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = $list->plan_harga_gabah_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->plan_harga_gabah_gb);
                        }
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->plan_harga_beli_gabah_gb);
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_tempat_gb);
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = $list->harga_berdasarkan_harga_atas_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_harga_atas_gb);
                        }
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        $result = $list->harga_awal_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->harga_awal_gb);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = $list->reaksi_harga_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->reaksi_harga_gb);
                        }
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == null | $result == '') {
                            if ($list->harga_akhir_gb == 'TOLAK') {
                                return 'TOLAK';
                            } else {
                                $result = rupiah($list->harga_akhir_gb) . '/Kg';
                                return $result;
                            }
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                            return $result;
                        }
                    })

                    ->rawColumns(['kode_po', 'nama_vendor', 'tonase_awal', 'tonase_akhir', 'tanggal_po', 'tanggal_bongkar', 'status_gabahfinishing_qc', 'date_bid', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            }
        }
    }
    public function output_deal_lab2_gb_ketan_putih_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->where('bid.name_bid', 'GABAH BASAH KETAN PUTIH')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('status_gabahfinishing_qc', function ($list) {
                        $result = $list->status_lab2_gb;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return $result;
                    })
                    ->addColumn('keterangan_penerimaan_po', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('no_dtm', function ($list) {
                        $result = $list->dtm_gb;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
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
                        $result = tonase($list->hasil_akhir_tonase);
                        return $result;
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
                    ->addColumn('plan_berat_kg_pertruk', function ($list) {
                        $result = $list->plan_berat_kg_pertruk_gb;
                        return $result;
                    })
                    ->addColumn('plan_berat_pk_pertruk', function ($list) {
                        $result = $list->plan_berat_pk_pertruk_gb;
                        return $result;
                    })
                    ->addColumn('plan_berat_beras_pertruk', function ($list) {
                        $result = $list->plan_berat_beras_pertruk_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = $list->plan_harga_gabah_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->plan_harga_gabah_gb);
                        }
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->plan_harga_beli_gabah_gb);
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_tempat_gb);
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = $list->harga_berdasarkan_harga_atas_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_harga_atas_gb);
                        }
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        $result = $list->harga_awal_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->harga_awal_gb);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = $list->reaksi_harga_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->reaksi_harga_gb);
                        }
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == null | $result == '') {
                            if ($list->harga_akhir_gb == 'TOLAK') {
                                return 'TOLAK';
                            } else {
                                $result = rupiah($list->harga_akhir_gb) . '/Kg';
                                return $result;
                            }
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                            return $result;
                        }
                    })
                    ->rawColumns(['kode_po', 'tonase_awal', 'tonase_akhir', 'nama_vendor', 'tanggal_po', 'tanggal_bongkar', 'status_lab2_gb', 'date_bid', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            } else {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->where('bid.name_bid', 'GABAH BASAH KETAN PUTIH')
                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('status_gabahfinishing_qc', function ($list) {
                        $result = $list->status_lab2_gb;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return $result;
                    })
                    ->addColumn('keterangan_penerimaan_po', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('no_dtm', function ($list) {
                        $result = $list->dtm_gb;
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
                        $result = tonase($list->hasil_akhir_tonase);
                        return $result;
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
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
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
                    ->addColumn('plan_berat_kg_pertruk', function ($list) {
                        $result = $list->plan_berat_kg_pertruk_gb;
                        return $result;
                    })
                    ->addColumn('plan_berat_pk_pertruk', function ($list) {
                        $result = $list->plan_berat_pk_pertruk_gb;
                        return $result;
                    })
                    ->addColumn('plan_berat_beras_pertruk', function ($list) {
                        $result = $list->plan_berat_beras_pertruk_gb;
                        return $result;
                    })
                    ->addColumn('refraksi_broken', function ($list) {
                        $result = $list->refraksi_broken_gb;
                        return $result;
                    })
                    ->addColumn('plan_harga_gabah', function ($list) {
                        $result = $list->plan_harga_gabah_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->plan_harga_gabah_gb);
                        }
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->plan_harga_beli_gabah_gb);
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_tempat_gb);
                        }
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = $list->harga_berdasarkan_harga_atas_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->harga_berdasarkan_harga_atas_gb);
                        }
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        $result = $list->harga_awal_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->harga_awal_gb);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = $list->reaksi_harga_gb;
                        if ($result == '') {
                            $result = 'Rp. -';
                        } else {
                            $result = rupiah($list->reaksi_harga_gb);
                        }
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == null | $result == '') {
                            if ($list->harga_akhir_gb == 'TOLAK') {
                                return 'TOLAK';
                            } else {
                                $result = rupiah($list->harga_akhir_gb) . '/Kg';
                                return $result;
                            }
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                            return $result;
                        }
                    })

                    ->rawColumns(['kode_po', 'nama_vendor', 'tonase_awal', 'tonase_akhir', 'status_gabahfinishing_qc', 'tanggal_po', 'tanggal_bongkar', 'date_bid', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            }
        }
    }

    public function output_lab2_pk_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->orderBy('id_lab2_pk', 'DESC')
                    ->select('penerimaan_po.*', 'data_po.tanggal_po', 'users.nama_vendor', 'bid.name_bid', 'lab2_pk.*')
                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('status_lab2_pk', function ($list) {
                        if ($list->status_lab2_pk == 11) {
                            return
                                '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-spinner"></i> Check Data
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="approved_lab2_pk" class="dropdown-item" data-id="' . $list->id_lab2_pk . '"><i class="fas fa-check"></i>Approve SPV</button>
							<button id="btn_edit" class="dropdown-item" name="' . $list->id_lab2_pk . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
						</div>
					</div>';
                        } else {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Menunggu&nbsp;Approved&nbsp;SPV 
                    </a>';
                        }
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('keterangan_penerimaan_po', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('no_dtm', function ($list) {
                        $result = $list->no_dtm_pk;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        if ($list->hasil_akhir_tonase == NULL) {
                            return '<span class="badge rounded-pill bg-success">Proses&nbsp;Timbangan&nbsp;2</span>';
                        } else {
                            $result = $list->hasil_akhir_tonase;
                            return $result;
                        }
                    })

                    ->addColumn('ka_pk', function ($list) {
                        $result = $list->ka_pk;
                        return $result . '%';
                    })
                    ->addColumn('pk_pk', function ($list) {
                        $result = $list->pk_pk;
                        return $result . '%';
                    })
                    ->addColumn('wh_pk', function ($list) {
                        $result = $list->wh_pk;
                        return $result . '%';
                    })
                    ->addColumn('tr_pk', function ($list) {
                        $result = $list->tr_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_hampa_pk', function ($list) {
                        $result = $list->presentase_hampa_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_pk_bersih_pk', function ($list) {
                        $result = $list->presentase_pk_bersih_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_katul_pk', function ($list) {
                        $result = $list->presentase_katul_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_beras_pk', function ($list) {
                        $result = $list->presentase_beras_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_butir_patah_pk', function ($list) {
                        $result = $list->presentase_butir_patah_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_butir_patah_beras_pk', function ($list) {
                        $result = $list->presentase_butir_patah_beras_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_reject_pk', function ($list) {
                        $result = $list->presentase_reject_pk;
                        return $result . '%';
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
                    ->addColumn('harga_atas_pk', function ($list) {
                        $result = $list->harga_atas_pk;
                        return rupiah($result);
                    })
                    ->addColumn('plan_harga_bongkaran_pk', function ($list) {
                        $result = $list->plan_harga_bongkaran;
                        return rupiah($result);
                    })
                    ->addColumn('harga_bongkaran_pk', function ($list) {
                        $result = $list->harga_bongkaran_pk;
                        return rupiah($result);
                    })
                    ->addColumn('presentase_pass', function ($list) {
                        $result = $list->presentase_pass;
                        return $result . '%';
                    })
                    ->addColumn('presentase_reject', function ($list) {
                        $result = $list->presentase_reject;
                        return $result . '%';
                    })
                    ->addColumn('plan_total_harga_pk', function ($list) {
                        $result = $list->plan_total_harga_pk;
                        return rupiah($result);
                    })
                    ->addColumn('selisih_ka_pk', function ($list) {
                        $result = $list->selisih_ka_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_hampa_pk', function ($list) {
                        $result = $list->selisih_presentase_hampa_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_rendemen_pk', function ($list) {
                        $result = $list->selisih_presentase_rendemen_pk_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_katul_pk', function ($list) {
                        $result = $list->selisih_presentase_katul_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_rendemen_beras_pk', function ($list) {
                        $result = $list->selisih_presentase_rendemen_beras_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_butir_patah_pk', function ($list) {
                        $result = $list->selisih_presentase_butir_patah_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_wh_pk', function ($list) {
                        $result = $list->selisih_wh_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_tr_pk', function ($list) {
                        $result = $list->selisih_tr_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_harga_pk', function ($list) {
                        $result = $list->selisih_harga_pk;
                        return rupiah($result);
                    })

                    ->rawColumns(['kode_po', 'nama_vendor', 'status_lab2_pk', 'tanggal_po', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'ka_pk', 'wh_pk', 'tr_pk', 'pk_pk', 'presentase_hampa_pk', 'presentase_pk_bersih_pk', 'presentase_katul_pk', 'presentase_beras_pk', 'presentase_butir_patah_pk', 'presentase_butir_patah_beras_pk', 'presentase_reject_pk', 'refraksi_ka_pk', 'refraksi_hampa_pk', 'refraksi_katul_pk', 'refraksi_butir_patah_pk', 'reward_hampa_pk', 'reward_katul_pk', 'reward_tr_pk', 'reward_butir_patah_pk', 'harga_atas_pk', 'plan_harga_bongkaran', 'presentase_pass', 'harga_bongkaran_pk', 'presentase_reject', 'plan_total_harga_pk', 'selisih_ka_pk', 'selisih_presentase_hampa_pk', 'selisih_presentase_rendemen_pk_pk', 'selisih_presentase_katul_pk', 'selisih_presentase_rendemen_beras_pk', 'selisih_presentase_butir_patah_pk', 'selisih_wh_pk', 'selisih_tr_pk', 'selisih_harga_pk'])
                    ->make(true);
            } else {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->where('lab2_pk.status_lab2_pk', '>=', 11)
                    ->orderBy('lab2_pk.id_lab2_pk', 'DESC')
                    ->get())
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('status_lab2_pk', function ($list) {
                        if ($list->status_lab2_pk == 11) {
                            return
                                '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-spinner"></i> Check Data
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="approved_lab2_pk" class="dropdown-item" data-id="' . $list->id_lab2_pk . '"><i class="fas fa-check"></i>Approve SPV</button>
							<button id="btn_edit" class="dropdown-item" name="' . $list->id_lab2_pk . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
						</div>
                        </div>';
                        } else if ($list->status_lab2_pk == 12) {
                            if ($list->status_approved_pk == 2) {
                                return
                                    '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-spinner"></i> Tolak Approve
                                </button>
						        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							    <button id="btn_edit" class="dropdown-item" name="' . $list->id_lab2_pk . '" data-id="' . $list->id_penerimaan_po . '" data-tanggalpo="' . $list->tanggal_po . '" title="Information"><i class="fas fa-edit"></i>Edit</button>
						        </div>
                                </div>';
                            } else {
                                return
                                    '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                Menunggu&nbsp;Approved&nbsp;SPV 
                            </a>';
                            }
                        } else {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                &nbsp;Approved&nbsp;SPV 
                            </a>';
                        }
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('keterangan_penerimaan_po', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('no_dtm', function ($list) {
                        $result = $list->no_dtm_pk;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        if ($list->hasil_akhir_tonase == NULL) {
                            return '<span class="badge rounded-pill bg-success">Proses&nbsp;Timbangan&nbsp;2</span>';
                        } else {
                            $result = $list->hasil_akhir_tonase;
                            return $result;
                        }
                    })

                    ->addColumn('ka_pk', function ($list) {
                        $result = $list->ka_pk;
                        return $result . '%';
                    })
                    ->addColumn('pk_pk', function ($list) {
                        $result = $list->pk_pk;
                        return $result . '%';
                    })
                    ->addColumn('wh_pk', function ($list) {
                        $result = $list->wh_pk;
                        return $result . '%';
                    })
                    ->addColumn('tr_pk', function ($list) {
                        $result = $list->tr_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_hampa_pk', function ($list) {
                        $result = $list->presentase_hampa_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_pk_bersih_pk', function ($list) {
                        $result = $list->presentase_pk_bersih_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_katul_pk', function ($list) {
                        $result = $list->presentase_katul_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_beras_pk', function ($list) {
                        $result = $list->presentase_beras_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_butir_patah_pk', function ($list) {
                        $result = $list->presentase_butir_patah_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_butir_patah_beras_pk', function ($list) {
                        $result = $list->presentase_butir_patah_beras_pk;
                        return $result . '%';
                    })
                    ->addColumn('presentase_reject_pk', function ($list) {
                        $result = $list->presentase_reject_pk;
                        return $result . '%';
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
                    ->addColumn('harga_atas_pk', function ($list) {
                        $result = $list->harga_atas_pk;
                        return rupiah($result);
                    })
                    ->addColumn('plan_harga_bongkaran_pk', function ($list) {
                        $result = $list->plan_harga_bongkaran;
                        return rupiah($result);
                    })
                    ->addColumn('harga_bongkaran_pk', function ($list) {
                        $result = $list->harga_bongkaran_pk;
                        return rupiah($result);
                    })
                    ->addColumn('presentase_pass', function ($list) {
                        $result = $list->presentase_pass;
                        return $result . '%';
                    })
                    ->addColumn('presentase_reject', function ($list) {
                        $result = $list->presentase_reject;
                        return $result . '%';
                    })
                    ->addColumn('plan_total_harga_pk', function ($list) {
                        $result = $list->plan_total_harga_pk;
                        return rupiah($result);
                    })
                    ->addColumn('selisih_ka_pk', function ($list) {
                        $result = $list->selisih_ka_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_hampa_pk', function ($list) {
                        $result = $list->selisih_presentase_hampa_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_rendemen_pk', function ($list) {
                        $result = $list->selisih_presentase_rendemen_pk_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_katul_pk', function ($list) {
                        $result = $list->selisih_presentase_katul_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_rendemen_beras_pk', function ($list) {
                        $result = $list->selisih_presentase_rendemen_beras_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_butir_patah_pk', function ($list) {
                        $result = $list->selisih_presentase_butir_patah_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_wh_pk', function ($list) {
                        $result = $list->selisih_wh_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_tr_pk', function ($list) {
                        $result = $list->selisih_tr_pk;
                        return $result . '%';
                    })
                    ->addColumn('selisih_harga_pk', function ($list) {
                        $result = $list->selisih_harga_pk;
                        return rupiah($result);
                    })

                    ->rawColumns(['kode_po', 'nama_vendor', 'status_lab2_pk', 'tanggal_po', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'ka_pk', 'wh_pk', 'tr_pk', 'pk_pk', 'presentase_hampa_pk', 'presentase_pk_bersih_pk', 'presentase_katul_pk', 'presentase_beras_pk', 'presentase_butir_patah_pk', 'presentase_butir_patah_beras_pk', 'presentase_reject_pk', 'refraksi_ka_pk', 'refraksi_hampa_pk', 'refraksi_katul_pk', 'refraksi_butir_patah_pk', 'reward_hampa_pk', 'reward_katul_pk', 'reward_tr_pk', 'reward_butir_patah_pk', 'harga_atas_pk', 'plan_harga_bongkaran', 'presentase_pass', 'harga_bongkaran_pk', 'presentase_reject', 'plan_total_harga_pk', 'selisih_ka_pk', 'selisih_presentase_hampa_pk', 'selisih_presentase_rendemen_pk_pk', 'selisih_presentase_katul_pk', 'selisih_presentase_rendemen_beras_pk', 'selisih_presentase_butir_patah_pk', 'selisih_wh_pk', 'selisih_tr_pk', 'selisih_harga_pk'])
                    ->make(true);
            }
        }
    }
}
