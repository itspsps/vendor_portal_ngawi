<?php

namespace App\Http\Controllers\AdminMaster;

use App\Http\Controllers\Controller;
use App\Models\DataPO;
use App\Models\FinishingQCGb;
use App\Models\HargaBawah;
use App\Models\Lab1GabahBasah;
use App\Models\LogAktivitySpvQc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HargaAtasGabahBasah;
use App\Models\Lab1Pecahkulit;
use DB;
use PDF;
use DataTables;
use App\Models\Notif;
use App\Models\ParameterLab;
use App\Models\ParameterLabPkButiranPatah;
use App\Models\ParameterLabPkHampa;
use App\Models\ParameterLabPkKa;
use App\Models\ParameterLabPkKatul;
use App\Models\ParameterLabPkKualitas;
use App\Models\ParameterLabPkRewardButirPatah;
use App\Models\ParameterLabPkRewardHampa;
use App\Models\ParameterLabPkRewardKadarAir;
use App\Models\ParameterLabPkRewardKatul;
use App\Models\ParameterLabPkRewardTr;
use App\Models\ParameterLabPkTr;
use App\Models\PenerimaanPO;
use App\Models\PlanHppBerasDs;
use App\Models\PlanHppGabahBasah;
use App\Models\PlanHppGabahKering;
use App\Models\PlanHppPecahKulit;
use App\Models\PotonganBongkarDs;
use App\Models\PotonganBongkarPk;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class MasterSpvqcController extends Controller
{
    public function output_lab1_gb()
    {
        return view('dashboard.admin_master.admin_spvqc.output_lab1_gb');
    }
    public function output_lab1_pk()
    {
        return view('dashboard.admin_master.admin_spvqc.output_lab1_pk');
    }

    public function output_lab2_gb()
    {
        return view('dashboard.admin_master.admin_spvqc.output_lab2_gb');
    }
    public function output_lab2_pk()
    {
        return view('dashboard.admin_master.admin_spvqc.output_lab2_pk');
    }
    // Revisi Harga
    public function revisi_harga()
    {
        return view('dashboard.admin_master.admin_spvqc.revisi_harga');
    }
    public function revisi_harga_gb_ciherang_index(Request $request)
    {
        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('penerimaan_po.id_adminanalisa', '4')
            ->where('penerimaan_po.status_analisa', '2')
            ->where('penerimaan_po.status_revisi', '0')
            ->where('bid.name_bid', '=', 'GABAH BASAH CIHERANG')
            ->get())
            // return $query;
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
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
                $result = rupiah($list->plan_harga_beli_gabah_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_berdasarkan_tempat', function ($list) {
                $result = rupiah($list->harga_berdasarkan_tempat_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . '/Kg';
                return $result;
            })
            ->addColumn('reaksi_harga', function ($list) {
                $result = rupiah($list->reaksi_harga_gb);
                return $result;
            })
            ->addColumn('harga_awal', function ($list) {

                $result = rupiah($list->harga_awal_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_akhir', function ($list) {
                $result = $list->harga_akhir_permintaan_gb;
                if ($result == null | $result == '') {
                    $result = rupiah($list->harga_akhir_gb) . '/Kg';
                    return $result;
                } else {
                    $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                    return $result;
                }
            })
            ->addColumn('aksi_harga', function ($list) {
                $result = $list->aksi_harga_gb;
                return '
                    <button id="btn_output_gb" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-kode_po="' . $list->kode_po . '" data-hargaakhir="' . $list->harga_akhir_gb . '" data-hargaawal="' . $list->harga_awal_gb . '" data-reaksi_harga="' . $list->reaksi_harga_gb . '" data-toggle="modal" data-target="#modaloutputnegogb" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Proses&nbsp;Revisi
                    </button>';
            })
            ->rawColumns(['name_bid', 'harga_akhir', 'nama_vendor', 'date_bid', 'reaksi_harga', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga'])
            ->make(true);
    }
    public function revisi_harga_gb_longgrain_index(Request $request)
    {
        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('penerimaan_po.id_adminanalisa', '4')
            ->where('penerimaan_po.status_analisa', '2')
            ->where('penerimaan_po.status_revisi', '0')
            ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
            ->get())
            // return $query;
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
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
                $result = rupiah($list->plan_harga_beli_gabah_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_berdasarkan_tempat', function ($list) {
                $result = rupiah($list->harga_berdasarkan_tempat_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . '/Kg';
                return $result;
            })
            ->addColumn('reaksi_harga', function ($list) {
                $result = rupiah($list->reaksi_harga_gb);
                return $result;
            })
            ->addColumn('harga_awal', function ($list) {

                $result = rupiah($list->harga_awal_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_akhir', function ($list) {
                $result = $list->harga_akhir_permintaan_gb;
                if ($result == null | $result == '') {
                    $result = rupiah($list->harga_akhir_gb) . '/Kg';
                    return $result;
                } else {
                    $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                    return $result;
                }
            })
            ->addColumn('aksi_harga', function ($list) {
                $result = $list->aksi_harga_gb;
                return '
                    <button id="btn_output_gb" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-kode_po="' . $list->kode_po . '" data-hargaakhir="' . $list->harga_akhir_gb . '" data-hargaawal="' . $list->harga_awal_gb . '" data-reaksi_harga="' . $list->reaksi_harga_gb . '" data-toggle="modal" data-target="#modaloutputnegogb" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Proses&nbsp;Revisi
                    </button>';
            })
            ->rawColumns(['name_bid', 'harga_akhir', 'nama_vendor', 'date_bid', 'reaksi_harga', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga'])
            ->make(true);
    }
    public function revisi_harga_gb_pandan_wangi_index(Request $request)
    {
        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('penerimaan_po.id_adminanalisa', '4')
            ->where('penerimaan_po.status_analisa', '2')
            ->where('penerimaan_po.status_revisi', '0')
            ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
            ->get())
            // return $query;
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
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
                $result = rupiah($list->plan_harga_beli_gabah_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_berdasarkan_tempat', function ($list) {
                $result = rupiah($list->harga_berdasarkan_tempat_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . '/Kg';
                return $result;
            })
            ->addColumn('reaksi_harga', function ($list) {
                $result = rupiah($list->reaksi_harga_gb);
                return $result;
            })
            ->addColumn('harga_awal', function ($list) {

                $result = rupiah($list->harga_awal_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_akhir', function ($list) {
                $result = $list->harga_akhir_permintaan_gb;
                if ($result == null | $result == '') {
                    $result = rupiah($list->harga_akhir_gb) . '/Kg';
                    return $result;
                } else {
                    $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                    return $result;
                }
            })
            ->addColumn('aksi_harga', function ($list) {
                $result = $list->aksi_harga_gb;
                return '
                    <button id="btn_output_gb" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-kode_po="' . $list->kode_po . '" data-hargaakhir="' . $list->harga_akhir_gb . '" data-hargaawal="' . $list->harga_awal_gb . '" data-reaksi_harga="' . $list->reaksi_harga_gb . '" data-toggle="modal" data-target="#modaloutputnegogb" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Proses&nbsp;Revisi
                    </button>';
            })
            ->rawColumns(['name_bid', 'harga_akhir', 'nama_vendor', 'date_bid', 'reaksi_harga', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga'])
            ->make(true);
    }
    public function revisi_harga_gb_ketan_putih_index(Request $request)
    {
        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('penerimaan_po.id_adminanalisa', '4')
            ->where('penerimaan_po.status_analisa', '2')
            ->where('penerimaan_po.status_revisi', '0')
            ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
            ->get())
            // return $query;
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
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
                $result = rupiah($list->plan_harga_beli_gabah_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_berdasarkan_tempat', function ($list) {
                $result = rupiah($list->harga_berdasarkan_tempat_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . '/Kg';
                return $result;
            })
            ->addColumn('reaksi_harga', function ($list) {
                $result = rupiah($list->reaksi_harga_gb);
                return $result;
            })
            ->addColumn('harga_awal', function ($list) {

                $result = rupiah($list->harga_awal_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_akhir', function ($list) {
                $result = $list->harga_akhir_permintaan_gb;
                if ($result == null | $result == '') {
                    $result = rupiah($list->harga_akhir_gb) . '/Kg';
                    return $result;
                } else {
                    $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                    return $result;
                }
            })
            ->addColumn('aksi_harga', function ($list) {
                $result = $list->aksi_harga_gb;
                return '
                    <button id="btn_output_gb" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-kode_po="' . $list->kode_po . '" data-hargaakhir="' . $list->harga_akhir_gb . '" data-hargaawal="' . $list->harga_awal_gb . '" data-reaksi_harga="' . $list->reaksi_harga_gb . '" data-toggle="modal" data-target="#modaloutputnegogb" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Proses&nbsp;Revisi
                    </button>';
            })
            ->rawColumns(['name_bid', 'harga_akhir', 'nama_vendor', 'date_bid', 'reaksi_harga', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga'])
            ->make(true);
    }
    public function data_surveyor()
    {
        return view('dashboard.admin_master.admin_spvqc.data_surveyor');
    }
    public function data_surveyor_index(Request $request)
    {

        return Datatables::of(DB::table('surveyor')->orderBy('id_surveyor', 'DESC')->get())
            // return $query;

            ->addColumn('ckelola', function ($list) {
                return '
                    <button id="btn_edit" style="margin:2px;" data-id="' . $list->id_surveyor . '"  data-nama="' . $list->nama_surveyor . '"  data-toggle="modal" data-target="#modal_edit_surveyor" title="Edit Data" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Edit
                    </button>
                    <button id="btn_hapus" style="margin:2px;" data-id="' . $list->id_surveyor . '"  title="Hapus Data" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Hapus
                    </button>';
            })

            ->rawColumns(['ckelola'])
            ->make(true);
    }
    public function delete_surveyor($id)
    {
        $query = DB::table('surveyor')
            ->where('id_surveyor', $id)->delete();
        return json_encode($query);
    }
    public function save_surveyor(Request $request)
    {
        $query = DB::table('surveyor')
            ->insert(['nama_surveyor' => $request->nama_surveyor]);
        return redirect()->back();
    }
    public function update_surveyor(Request $request)
    {
        $query = DB::table('surveyor')->where('id_surveyor', $request->id_surveyor)->update(['nama_surveyor' => $request->nama_surveyor]);
        return redirect()->back();
    }
    public function save_revisi_harga_gb(Request $request)
    {
        $update_lab2 = DB::table('lab2_gb')->where('id_lab2_gb', $request->id_gabahfinishing)->update(['reaksi_harga_gb' => $request->reaksi_harga, 'harga_akhir_gb' => $request->output_harga_akhir]);
        $update_lab2 = DB::table('penerimaan_po')->where('penerimaan_kode_po', $request->gabahincoming_kode_po)->update(['status_revisi' => '1']);
        return redirect()->back();
    }

    // NEGO
    public function nego()
    {

        return view('dashboard.admin_master.admin_spvqc.nego');
    }


    public function output_nego_gb(Request $request)
    {
        // dd($request->all());
        $data = DB::table('lab2_gb')->where('id_lab2_gb', $request->id)->first();
        if ($request->hasil_nego == 'Yes') {
            $hitung = $data->harga_akhir_gb + $request->reaksi_harga;
            // dd($hitung);
            $data = FinishingQCGb::where('id_lab2_gb', $request->id)->first();
            $data->aksi_harga_gb = 'OUTPUT NEGO';
            $data->reaksi_harga_gb = $request->reaksi_harga;
            $data->harga_akhir_gb  = $hitung;
            $data->update();

            return response()->json($data);
        } else {
            $data = FinishingQCGb::where('id_lab2_gb', $request->id)->first();
            $data->aksi_harga_gb = 'OUTPUT NEGO';
            $data->update();

            return response()->json($data);
        }
        $log                                 = new LogAktivitySpvQc();
        $log->nama_user                      = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_spvqc       = $request->id;
        $log->aktivitas_spvqc                = 'Proses Nego Lab 2. Kode PO:' . $data->lab2_kode_po_gb . ' Reaksi Harga : ' . $request->reaksi_harga;
        $log->keterangan_aktivitas           = 'Selesai';
        $log->created_at                     = date('Y-m-d H:i:s');
        $log->save();
    }
    public function output_nego_pk(Request $request)
    {
        $data = DB::table('lab1_pk')->where('lab1_kode_po_pk', $request->gabahincoming_kode_po)->first();
        if ($request->hasil_nego == 'Yes') {
            if ($data->harga_akhir_permintaan_pk == '' || $data->harga_akhir_permintaan_pk == null) {
                $hitung = $data->harga_awal_pk + $request->reaksi_harga;
                $update_nego = Lab1Pecahkulit::where('lab1_kode_po_pk', $request->gabahincoming_kode_po)->first();
                $update_nego->reaksi_harga_pk = $request->reaksi_harga;
                $update_nego->harga_akhir_pk  = $hitung;
                $update_nego->aksi_harga_pk = 'OUTPUT NEGO';
                $update_nego->update();
            } else {
                $hitung = $data->harga_akhir_permintaan_pk + $request->reaksi_harga;
                $update_nego = Lab1Pecahkulit::where('lab1_kode_po_pk', $request->gabahincoming_kode_po)->first();
                $update_nego->reaksi_harga_pk = $request->reaksi_harga;
                $update_nego->harga_akhir_permintaan_pk  = $hitung;
                $update_nego->aksi_harga_pk = 'OUTPUT NEGO';
                $update_nego->update();
            }
            return redirect()->back();
        } else {
            $update_nego = Lab1Pecahkulit::where('lab1_kode_po_pk', $request->gabahincoming_kode_po)->first();
            $update_nego->aksi_harga_pk = 'OUTPUT NEGO';
            $update_nego->update();
            return redirect()->back();
        }
    }

    public function output_lab1_gb_longgrain_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')

                    ->where('penerimaan_po.status_penerimaan', '>', 5, 'AND', 'penerimaan_po.status_penerimaan', '!=', 16)
                    // ->orWhere('penerimaan_po.status_penerimaan', '!=', 16)
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
                    ->orderBy('id_lab1_gb', 'desc')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_lab1_gb == 5) {
                            if ($list->status_approved == 1) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Tolak</button>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-minus">&nbsp;Approved&nbsp;Tolak</i></button>';
                            } else if ($list->status_approved == 3) {
                                return
                                    '<button class=" btn btn-outline-warning m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="flaticon2-hourglass">&nbsp;Analisa&nbsp;Ulang</i></button>';
                            } else if ($list->status_approved == 0) {
                                return
                                    '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-question"></i> Cek&nbsp;Tolak</button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <button class="dropdown-item" id="btn_tolak" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Approve&nbsp;Tolak</button>
                                <button id="btn_bongkar" class="dropdown-item" data-id="' . $list->id_lab1_gb . '" title="Tolak"><i class="fas fa-minus-circle"></i>Tetap&nbsp;Bongkar</button>
                                <button id="btn_analisa" class="dropdown-item" data-id="' . $list->id_lab1_gb . '" title="Analisa Ulang"><i class="flaticon2-hourglass"></i>Analisa&nbsp;Ulang</button>
                                </div>
                                </div>';
                            }
                        } else if ($list->status_lab1_gb == 6) {
                            if ($list->status_approved == 1) {
                                return
                                    '<div class="dropdown">
                    <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-question"></i> Cek&nbsp;Bongkar
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                    <button class="dropdown-item" id="btn_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Approve&nbsp;Bongkar</button>
                    <button id="btn_tolakbongkar" class="dropdown-item" data-id="' . $list->id_lab1_gb . '" title="Tolak"><i class="fas fa-minus-circle"></i>Tolak&nbsp;Approve</button>
                    </div>
                    </div>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-minus">&nbsp;Tolak&nbsp;Approved&nbsp;Bongkar</i></button>';
                            } else if ($list->status_approved == null || $list->status_approved == '') {
                                return
                                    '<button class="btn btn-outline-warning" type="button"><i class="fa fa-spinner"></i> Belum&nbsp;Ajukan&nbsp;Approve</button>';
                            }
                        } else if ($list->status_lab1_gb == 16) {
                            return
                                '<button class=" btn btn-outline-warning m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-spinner">&nbsp;Pending</i></button>';
                        } else if ($list->status_lab1_gb == 7) {
                            return
                                '<button class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only" ><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Bongkar</button>';
                        } else {
                            if ($list->status_approved == 1) {
                                return
                                    '<button class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only" ><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Bongkar</button>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-minus">&nbsp;Tolak&nbsp;Approved&nbsp;Bongkar</i></button>';
                            }
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
                    ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_lab1_gb == 5) {
                            if ($list->status_approved == 1) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Tolak</button>';
                            } else if ($list->status_approved == 3) {
                                return
                                    '<button class=" btn btn-outline-warning m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="flaticon2-hourglass">&nbsp;Analisa&nbsp;Ulang</i></button>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-minus">&nbsp;Approved&nbsp;Tolak</i></button>';
                            } else if ($list->status_approved == 0) {
                                return
                                    '<div class="dropdown">
                                    <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-question"></i> Cek&nbsp;Tolak</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button class="dropdown-item" id="btn_tolak" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Approve&nbsp;Tolak</button>
                                    <button id="btn_bongkar" class="dropdown-item" data-id="' . $list->id_lab1_gb . '" title="Tolak"><i class="fas fa-minus-circle"></i>Tetap&nbsp;Bongkar</button>
                                    <button id="btn_analisa" class="dropdown-item" data-id="' . $list->id_lab1_gb . '" title="Analisa Ulang"><i class="flaticon2-hourglass"></i>Analisa&nbsp;Ulang</button>
                                    </div>
                                    </div>';
                            }
                        } else if ($list->status_lab1_gb == 6) {
                            if ($list->status_approved == 1) {
                                return
                                    '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-question"></i> Cek&nbsp;Bongkar
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <button class="dropdown-item" id="btn_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Approve&nbsp;Bongkar</button>
                                <button id="btn_tolakbongkar" class="dropdown-item" data-id="' . $list->id_lab1_gb . '" title="Tolak"><i class="fas fa-minus-circle"></i>Tolak&nbsp;Approve</button>
                                </div>
                                </div>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-minus">&nbsp;Tolak&nbsp;Approved&nbsp;Bongkar</i></button>';
                            } else if ($list->status_approved == null || $list->status_approved == '') {
                                return
                                    '<button class="btn btn-outline-warning" type="button"><i class="fa fa-spinner"></i> Belum&nbsp;Ajukan&nbsp;Approve</button>';
                            }
                        } else if ($list->status_lab1_gb == 16) {
                            return
                                '<button class=" btn btn-outline-warning m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-spinner">&nbsp;Pending</i></button>';
                        } else if ($list->status_lab1_gb == 7) {
                            return
                                '<button class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only" ><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Bongkar</button>';
                        } else {
                            if ($list->status_approved == 1) {
                                return
                                    '<button class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only" ><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Bongkar</button>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-minus">&nbsp;Tolak&nbsp;Approved&nbsp;Bongkar</i></button>';
                            } else {
                                return
                                    '<button class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only" ><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Bongkar</button>';
                            }
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

                    ->rawColumns(['name_bid', 'waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            }
        }
    }
    public function output_lab1_gb_pandan_wangi_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')

                    ->where('penerimaan_po.status_penerimaan', '>', 5, 'AND', 'penerimaan_po.status_penerimaan', '!=', 16)
                    // ->orWhere('penerimaan_po.status_penerimaan', '!=', 16)
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
                    ->orderBy('id_lab1_gb', 'desc')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_lab1_gb == 5) {
                            if ($list->status_approved == 1) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Tolak</button>';
                            } else if ($list->status_approved == 3) {
                                return
                                    '<button class=" btn btn-outline-warning m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="flaticon2-hourglass">&nbsp;Analisa&nbsp;Ulang</i></button>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-minus">&nbsp;Approved&nbsp;Tolak</i></button>';
                            } else if ($list->status_approved == 0) {
                                return
                                    '<div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-question"></i> Cek&nbsp;Tolak</button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <button class="dropdown-item" id="btn_tolak" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Approve&nbsp;Tolak</button>
                                <button id="btn_bongkar" class="dropdown-item" data-id="' . $list->id_lab1_gb . '" title="Tolak"><i class="fas fa-minus-circle"></i>Tetap&nbsp;Bongkar</button>
                                <button id="btn_analisa" class="dropdown-item" data-id="' . $list->id_lab1_gb . '" title="Analisa Ulang"><i class="flaticon2-hourglass"></i>Analisa&nbsp;Ulang</button>
                                </div>
                                </div>';
                            }
                        } else if ($list->status_lab1_gb == 6) {
                            if ($list->status_approved == 1) {
                                return
                                    '<div class="dropdown">
                    <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-question"></i> Cek&nbsp;Bongkar
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                    <button class="dropdown-item" id="btn_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Approve&nbsp;Bongkar</button>
                    <button id="btn_tolakbongkar" class="dropdown-item" data-id="' . $list->id_lab1_gb . '" title="Tolak"><i class="fas fa-minus-circle"></i>Tolak&nbsp;Approve</button>
                    </div>
                    </div>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-minus">&nbsp;Tolak&nbsp;Approved&nbsp;Bongkar</i></button>';
                            } else if ($list->status_approved == null || $list->status_approved == '') {
                                return
                                    '<button class="btn btn-outline-warning" type="button"><i class="fa fa-spinner"></i> Belum&nbsp;Ajukan&nbsp;Approve</button>';
                            }
                        } else if ($list->status_lab1_gb == 7) {
                            return
                                '<button class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only" ><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Bongkar</button>';
                        } else if ($list->status_lab1_gb == 16) {
                            return
                                '<button class=" btn btn-outline-warning m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-spinner">&nbsp;Pending</i></button>';
                        } else {
                            if ($list->status_approved == 1) {
                                return
                                    '<button class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only" ><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Bongkar</button>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-minus">&nbsp;Tolak&nbsp;Approved&nbsp;Bongkar</i></button>';
                            }
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
                    ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_lab1_gb == 5) {
                            if ($list->status_approved == 1) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Tolak</button>';
                            } else if ($list->status_approved == 3) {
                                return
                                    '<button class=" btn btn-outline-warning m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="flaticon2-hourglass">&nbsp;Analisa&nbsp;Ulang</i></button>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-minus">&nbsp;Approved&nbsp;Tolak</i></button>';
                            } else if ($list->status_approved == 0) {
                                return
                                    '<div class="dropdown">
                                    <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-question"></i> Cek&nbsp;Tolak</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button class="dropdown-item" id="btn_tolak" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Approve&nbsp;Tolak</button>
                                    <button id="btn_bongkar" class="dropdown-item" data-id="' . $list->id_lab1_gb . '" title="Tolak"><i class="fas fa-minus-circle"></i>Tetap&nbsp;Bongkar</button>
                                    <button id="btn_analisa" class="dropdown-item" data-id="' . $list->id_lab1_gb . '" title="Analisa Ulang"><i class="flaticon2-hourglass"></i>Analisa&nbsp;Ulang</button>
                                    </div>
                                    </div>';
                            }
                        } else if ($list->status_lab1_gb == 6) {
                            if ($list->status_approved == 1) {
                                return
                                    '<div class="dropdown">
                    <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-question"></i> Cek&nbsp;Bongkar
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                    <button class="dropdown-item" id="btn_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Approve&nbsp;Bongkar</button>
                    <button id="btn_tolakbongkar" class="dropdown-item" data-id="' . $list->id_lab1_gb . '" title="Tolak"><i class="fas fa-minus-circle"></i>Tolak&nbsp;Approve</button>
                    </div>
                    </div>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-minus">&nbsp;Tolak&nbsp;Approved&nbsp;Bongkar</i></button>';
                            } else if ($list->status_approved == null || $list->status_approved == '') {
                                return
                                    '<button class="btn btn-outline-warning" type="button"><i class="fa fa-spinner"></i> Belum&nbsp;Ajukan&nbsp;Approve</button>';
                            }
                        } else if ($list->status_lab1_gb == 16) {
                            return
                                '<button class=" btn btn-outline-warning m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-spinner">&nbsp;Pending</i></button>';
                        } else if ($list->status_lab1_gb == 7) {
                            return
                                '<button class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only" ><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Bongkar</button>';
                        } else {
                            if ($list->status_approved == 1) {
                                return
                                    '<button class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only" ><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Bongkar</button>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-minus">&nbsp;Tolak&nbsp;Approved&nbsp;Bongkar</i></button>';
                            }
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

                    ->rawColumns(['name_bid', 'waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            }
        }
    }
    public function output_lab1_gb_ketan_putih_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')

                    ->where('penerimaan_po.status_penerimaan', '>', 5, 'AND', 'penerimaan_po.status_penerimaan', '!=', 16)
                    // ->orWhere('penerimaan_po.status_penerimaan', '!=', 16)
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
                    ->orderBy('id_lab1_gb', 'desc')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_lab1_gb == 5) {
                            if ($list->status_approved == 1) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Tolak</button>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-minus">&nbsp;Approved&nbsp;Tolak</i></button>';
                            } else if ($list->status_approved == 3) {
                                return
                                    '<button class=" btn btn-outline-warning m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="flaticon2-hourglass">&nbsp;Analisa&nbsp;Ulang</i></button>';
                            } else if ($list->status_approved == 0) {
                                return
                                    '<div class="dropdown">
                                    <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-question"></i> Cek&nbsp;Tolak</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button class="dropdown-item" id="btn_tolak" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Approve&nbsp;Tolak</button>
                                    <button id="btn_bongkar" class="dropdown-item" data-id="' . $list->id_lab1_gb . '" title="Tolak"><i class="fas fa-minus-circle"></i>Tetap&nbsp;Bongkar</button>
                                    <button id="btn_analisa" class="dropdown-item" data-id="' . $list->id_lab1_gb . '" title="Analisa Ulang"><i class="flaticon2-hourglass"></i>Analisa&nbsp;Ulang</button>
                                    </div>
                                    </div>';
                            }
                        } else if ($list->status_lab1_gb == 6) {
                            if ($list->status_approved == 1) {
                                return
                                    '<div class="dropdown">
                    <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-question"></i> Cek&nbsp;Bongkar
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                    <button class="dropdown-item" id="btn_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Approve&nbsp;Bongkar</button>
                    <button id="btn_tolakbongkar" class="dropdown-item" data-id="' . $list->id_lab1_gb . '" title="Tolak"><i class="fas fa-minus-circle"></i>Tolak&nbsp;Approve</button>
                    </div>
                    </div>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-minus">&nbsp;Tolak&nbsp;Approved&nbsp;Bongkar</i></button>';
                            } else if ($list->status_approved == 'NULL' || $list->status_approved == '') {
                                return
                                    '<button class="btn btn-outline-warning" type="button"><i class="fa fa-spinner"></i> Belum&nbsp;Ajukan&nbsp;Approve</button>';
                            }
                        } else if ($list->status_lab1_gb == 16) {
                            return
                                '<button class=" btn btn-outline-warning m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-spinner">&nbsp;Pending</i></button>';
                        } else if ($list->status_lab1_gb == 7) {
                            return
                                '<button class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only" ><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Bongkar</button>';
                        } else {
                            if ($list->status_approved == 1) {
                                return
                                    '<button class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only" ><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Bongkar</button>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-minus">&nbsp;Tolak&nbsp;Approved&nbsp;Bongkar</i></button>';
                            }
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
                    ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('plan_harga', function ($list) {
                        $result = rupiah($list->plan_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_lab1_gb == 5) {
                            if ($list->status_approved == 1) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Tolak</button>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-minus">&nbsp;Approved&nbsp;Tolak</i></button>';
                            } else if ($list->status_approved == 3) {
                                return
                                    '<button class=" btn btn-outline-warning m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="flaticon2-hourglass">&nbsp;Analisa&nbsp;Ulang</i></button>';
                            } else if ($list->status_approved == 0) {
                                return
                                    '<div class="dropdown">
                                    <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-question"></i> Cek&nbsp;Tolak</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <button class="dropdown-item" id="btn_tolak" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Approve&nbsp;Tolak</button>
                                    <button id="btn_bongkar" class="dropdown-item" data-id="' . $list->id_lab1_gb . '" title="Tolak"><i class="fas fa-minus-circle"></i>Tetap&nbsp;Bongkar</button>
                                    <button id="btn_analisa" class="dropdown-item" data-id="' . $list->id_lab1_gb . '" title="Analisa Ulang"><i class="flaticon2-hourglass"></i>Analisa&nbsp;Ulang</button>
                                    </div>
                                    </div>';
                            }
                        } else if ($list->status_lab1_gb == 6) {
                            if ($list->status_approved == 1) {
                                return
                                    '<div class="dropdown">
                    <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-question"></i> Cek&nbsp;Bongkar
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                    <button class="dropdown-item" id="btn_bongkar" data-id="' . $list->id_lab1_gb . '"><i class="fas fa-check"></i>Approve&nbsp;Bongkar</button>
                    <button id="btn_tolakbongkar" class="dropdown-item" data-id="' . $list->id_lab1_gb . '" title="Tolak"><i class="fas fa-minus-circle"></i>Tolak&nbsp;Approve</button>
                    </div>
                    </div>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-minus">&nbsp;Tolak&nbsp;Approved&nbsp;Bongkar</i></button>';
                            } else if ($list->status_approved == 'NULL' || $list->status_approved == '') {
                                return
                                    '<button class="btn btn-outline-warning" type="button"><i class="fa fa-spinner"></i> Belum&nbsp;Ajukan&nbsp;Approve</button>';
                            }
                        } else if ($list->status_lab1_gb == 16) {
                            return
                                '<button class=" btn btn-outline-warning m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-spinner">&nbsp;Pending</i></button>';
                        } else if ($list->status_lab1_gb == 7) {
                            return
                                '<button class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only" ><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Bongkar</button>';
                        } else {
                            if ($list->status_approved == 1) {
                                return
                                    '<button class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only" ><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Bongkar</button>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-minus">&nbsp;Tolak&nbsp;Approved&nbsp;Bongkar</i></button>';
                            }
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

                    ->rawColumns(['name_bid', 'waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            }
        }
    }
    public function output_lab1_pk_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_pk', 'lab1_pk.lab1_id_data_po_pk', '=', 'data_po.id_data_po')

                    ->where('penerimaan_po.status_penerimaan', '>', 5, 'AND', 'penerimaan_po.status_penerimaan', '!=', 16)
                    // ->orWhere('penerimaan_po.status_penerimaan', '!=', 16)
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->orderBy('id_lab1_pk', 'desc')
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('refraksi_ka_pk', function ($list) {
                        if ($list->refraksi_ka_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_ka_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_hampa_pk', function ($list) {
                        if ($list->refraksi_hampa_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_hampa_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_katul_pk', function ($list) {
                        if ($list->refraksi_katul_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_katul_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_tr_pk', function ($list) {
                        if ($list->refraksi_tr_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_tr_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_butir_patah_pk', function ($list) {
                        if ($list->refraksi_butir_patah_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_butir_patah_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('reward_hampa_pk', function ($list) {
                        if ($list->reward_hampa_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_hampa_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('reward_katul_pk', function ($list) {
                        if ($list->reward_katul_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_katul_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('reward_tr_pk', function ($list) {
                        if ($list->reward_tr_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_tr_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('reward_butir_patah_pk', function ($list) {
                        if ($list->reward_butir_patah_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_butir_patah_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('harga_incoming_pk', function ($list) {
                        if ($list->harga_incoming_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->harga_incoming_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('plan_harga_aktual_pk', function ($list) {
                        if ($list->plan_harga_aktual_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->plan_harga_aktual_pk) . '/Kg';
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
                    ->addColumn('reaksi_harga_pk', function ($list) {
                        $result = $list->reaksi_harga_pk;
                        if ($result == '' | $result == null) {
                            $result = 'Rp. -';
                            return $result;
                        } else if ($list->reaksi_harga_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reaksi_harga_pk);
                            return $result;
                        }
                    })
                    ->addColumn('harga_akhir_pk', function ($list) {
                        $result = $list->harga_akhir_pk;
                        if ($result == null | $result == '') {
                            $result = rupiah(0) . '/Kg';
                            return $result;
                        } else if ($list->harga_akhir_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->harga_akhir_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_lab1_pk == '12') {
                            return
                                '<button id="btn_modal_pk" style="margin:2px;" data-id="' . $list->id_lab1_pk . '" data-kodepo="' . $list->lab1_kode_po_pk . '" data-hargaakhir="' . $list->harga_akhir_pk . '" data-toggle="modal" data-target="#modalharga_pk" title="Edit Data" data-offset="5px 5px" data-toggle="m-tooltip" title="Approve Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"> </i>Diajukan
                        </button>';
                        } else if ($list->status_lab1_pk == '13') {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '"  title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Approved 
                        </a>';
                        } elseif ($list->status_lab1_pk == 7) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;1 
                    </a>';
                        } elseif ($list->status_lab1_pk == 6) {
                            return
                                '<a style="margin:2px;"  title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner"></i>&nbsp;Bongkar 
                    </a>';
                        } elseif ($list->status_lab1_pk == 5) {
                            if ($list->status_approved == 1) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Tolak</button>';
                            } else {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-spinner"></i>&nbsp;Tolak</button>';
                            }
                        } elseif ($list->status_lab1_pk == 8) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-phone"></i>&nbsp;PO&nbsp;On&nbsp;Call
                    </a>';
                        } elseif ($list->status_lab1_pk == 9) {
                            return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                          <i class="fa fa-truck"></i>&nbsp;Proses&nbsp;Bongkar&nbsp;1
                        </a>';
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
                        } elseif ($list->status_lab1_pk == 16) {
                            return
                                '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-exclamation"></i> Cek&nbsp;Pending
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_pk . '" data-tanggal_po="' . $list->tanggal_po . '"  title="Information"><i class="fas fa-edit"></i>Edit</button>
						</div>
					</div>';
                        } else {
                            return
                                '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-exclamation"></i> Cek&nbsp;Pending
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                            <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_pk . '" data-tanggal_po="' . $list->tanggal_po . '"  title="Information"><i class="fas fa-edit"></i>Edit</button>
                        </div>
                    </div>';
                        }
                    })
                    //add


                    ->rawColumns(['name_bid', 'waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            } else {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab1_pk', 'lab1_pk.lab1_id_data_po_pk', '=', 'data_po.id_data_po')
                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->orderBy('id_lab1_pk', 'desc')
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
                    ->addColumn('asal_gabah', function ($list) {
                        $result = $list->keterangan_penerimaan_po;
                        return $result;
                    })
                    ->addColumn('refraksi_ka_pk', function ($list) {
                        if ($list->refraksi_ka_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_ka_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_hampa_pk', function ($list) {
                        if ($list->refraksi_hampa_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_hampa_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_katul_pk', function ($list) {
                        if ($list->refraksi_katul_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_katul_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_tr_pk', function ($list) {
                        if ($list->refraksi_tr_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_tr_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('refraksi_butir_patah_pk', function ($list) {
                        if ($list->refraksi_butir_patah_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->refraksi_butir_patah_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('reward_hampa_pk', function ($list) {
                        if ($list->reward_hampa_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_hampa_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('reward_katul_pk', function ($list) {
                        if ($list->reward_katul_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_katul_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('reward_tr_pk', function ($list) {
                        if ($list->reward_tr_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_tr_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('reward_butir_patah_pk', function ($list) {
                        if ($list->reward_butir_patah_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reward_butir_patah_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('harga_incoming_pk', function ($list) {
                        if ($list->harga_incoming_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->harga_incoming_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('plan_harga_aktual_pk', function ($list) {
                        if ($list->plan_harga_aktual_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->plan_harga_aktual_pk) . '/Kg';
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
                    ->addColumn('reaksi_harga_pk', function ($list) {
                        $result = $list->reaksi_harga_pk;
                        if ($result == '' | $result == null) {
                            $result = 'Rp. -';
                            return $result;
                        } else if ($list->reaksi_harga_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->reaksi_harga_pk);
                            return $result;
                        }
                    })
                    ->addColumn('harga_akhir_pk', function ($list) {
                        $result = $list->harga_akhir_pk;
                        if ($result == null | $result == '') {
                            $result = rupiah(0) . '/Kg';
                            return $result;
                        } else if ($list->harga_akhir_pk == 'TOLAK') {
                            return 'TOLAK';
                        } else {
                            $result = rupiah($list->harga_akhir_pk) . '/Kg';
                            return $result;
                        }
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_lab1_pk == '12') {
                            return
                                '<button id="btn_modal_pk" style="margin:2px;" data-id="' . $list->id_lab1_pk . '" data-kodepo="' . $list->lab1_kode_po_pk . '" data-hargaakhir="' . $list->harga_akhir_pk . '" data-toggle="modal" data-target="#modalharga_pk" title="Edit Data" data-offset="5px 5px" data-toggle="m-tooltip" title="Approve Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"> </i>Diajukan
                        </button>';
                        } else if ($list->status_lab1_pk == '13') {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '"  title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Approved 
                        </a>';
                        } elseif ($list->status_lab1_pk == 7) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-flask"></i>&nbsp;Selesai&nbsp;Lab&nbsp;1 
                    </a>';
                        } elseif ($list->status_lab1_pk == 6) {
                            return
                                '<a style="margin:2px;"  title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner"></i>&nbsp;Bongkar 
                    </a>';
                        } elseif ($list->status_lab1_pk == 5) {
                            if ($list->status_approved == 1) {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-check"></i>&nbsp;Approved&nbsp;Tolak</button>';
                            } else {
                                return
                                    '<button class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-spinner"></i>&nbsp;Tolak</button>';
                            }
                        } elseif ($list->status_lab1_pk == 8) {
                            return
                                '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-phone"></i>&nbsp;PO&nbsp;On&nbsp;Call
                    </a>';
                        } elseif ($list->status_lab1_pk == 9) {
                            return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                      <i class="fa fa-truck"></i>&nbsp;Proses&nbsp;Bongkar&nbsp;1
                    </a>';
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
                        } elseif ($list->status_lab1_pk == 16) {
                            return
                                '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-exclamation"></i> Cek&nbsp;Pending
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_pk . '" data-tanggal_po="' . $list->tanggal_po . '"  title="Information"><i class="fas fa-edit"></i>Edit</button>
						</div>
					</div>';
                        } else {
                            return
                                '<div class="dropdown">
                        <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-exclamation"></i> Cek&nbsp;Pending
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                            <button id="to_edit" class="dropdown-item to_edit" name="' . $list->id_lab1_pk . '" data-tanggal_po="' . $list->tanggal_po . '"  title="Information"><i class="fas fa-edit"></i>Edit</button>
                        </div>
                    </div>';
                        }
                    })
                    //add


                    ->rawColumns(['name_bid', 'waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah'])
                    ->make(true);
            }
        }
    }
    public function analisa_ulang_lab1_gb($id)
    {
        $data            = Lab1GabahBasah::where('id_lab1_gb', $id)->first();
        $data->status_approved = 3;
        $data->update();

        // $log                                 = new LogAktivitySpvQc();
        // $log->nama_user                      = Auth::guard('master')->user()->name_master;
        // $log->id_objek_aktivitas_spvqc       = $id;
        // $log->aktivitas_spvqc                = 'Approved Bongkar Lab 1. Kode PO:' . $get_kode_po->lab1_kode_po_gb;
        // $log->keterangan_aktivitas           = 'Selesai';
        // $log->created_at                     = date('Y-m-d H:i:s');
        // $log->save();

    }
    public function approve_lab1_gb($id)
    {
        $get_kode_po            = DB::table('lab1_gb')->where('id_lab1_gb', $id)->first();

        $data         = DataPO::where('kode_po', $get_kode_po->lab1_kode_po_gb)->first();
        $data->status_bid = '7';
        $data->update();

        $data  = PenerimaanPO::where('penerimaan_kode_po', $get_kode_po->lab1_kode_po_gb)->first();
        $data->status_penerimaan = '7';
        $data->update();

        $data            = Lab1GabahBasah::where('id_lab1_gb', $id)->first();
        $data->status_lab1_gb = 7;
        $data->status_approved = 1;
        $data->created_at_approved = date('Y-m-d H:i:s');
        $data->output_lab_gb = 'Unload';
        $data->update();

        // $log                                 = new LogAktivitySpvQc();
        // $log->nama_user                      = Auth::guard('master')->user()->name_master;
        // $log->id_objek_aktivitas_spvqc       = $id;
        // $log->aktivitas_spvqc                = 'Approved Bongkar Lab 1. Kode PO:' . $get_kode_po->lab1_kode_po_gb;
        // $log->keterangan_aktivitas           = 'Selesai';
        // $log->created_at                     = date('Y-m-d H:i:s');
        // $log->save();

    }
    public function notapprove_lab1_gb($id)
    {
        $get_kode_po            = DB::table('lab1_gb')->where('id_lab1_gb', $id)->first();

        $data         = DataPO::where('kode_po', $get_kode_po->lab1_kode_po_gb)->first();
        $data->status_bid = '6';
        $data->update();

        $data  = PenerimaanPO::where('penerimaan_kode_po', $get_kode_po->lab1_kode_po_gb)->first();
        $data->status_penerimaan = '6';
        $data->update();

        $data            = Lab1GabahBasah::where('id_lab1_gb', $id)->first();
        $data->status_lab1_gb = '6';
        $data->status_approved = 2;
        $data->created_at_approved = date('Y-m-d H:i:s');
        $data->output_lab_gb = 'Unload';
        $data->update();

        $log                                 = new LogAktivitySpvQc();
        $log->nama_user                      = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_spvqc       = $id;
        $log->aktivitas_spvqc                = 'Tolak Approved Bongkar Lab 1. Kode PO:' . $get_kode_po->lab1_kode_po_gb;
        $log->keterangan_aktivitas           = 'Selesai';
        $log->created_at                     = date('Y-m-d H:i:s');
        $log->save();
    }
    public function approve_tolak_lab1_gb($id)
    {
        $get_kode_po            = DB::table('lab1_gb')->where('id_lab1_gb', $id)->first();
        $get_data_po            = DB::table('data_po')->where('kode_po', $get_kode_po->lab1_kode_po_gb)->first();
        //  Integrasi Epicor
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/PO/ClosePO?PONum=' . $get_data_po->PONum;
        $response = $client->get($url);
        $response = $response->getBody()->getContents();
        // dd($response); 
        $update_data_po         = DB::table('data_po')->where('kode_po', $get_kode_po->lab1_kode_po_gb)->update(['status_bid' => 5]);
        $update_pernerimaan_po  = DB::table('penerimaan_po')->where('penerimaan_kode_po', $get_kode_po->lab1_kode_po_gb)->update(['status_penerimaan' => 5]);
        $get_kode_po            = DB::table('lab1_gb')->where('id_lab1_gb', $id)->update(['status_lab1_gb' => 5, 'status_approved' => 1, 'created_at_approved' => date('Y-m-d H:i:s'), 'output_lab_gb' => 'Reject']);
    }
    public function output_lab2_gb_ciherang_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('bid.name_bid', '=', 'GABAH BASAH CIHERANG')
                    ->where('data_po.status_bid', '>', 11)
                    ->where('penerimaan_po.status_penerimaan', '>', 11)
                    ->where('lab2_gb.status_lab2_gb', '>', 11)
                    ->orderBy('id_lab2_gb', 'desc')
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
                        return $result;
                    })
                    ->addColumn('status_lab2_gb', function ($list) {
                        if ($list->status_lab2_gb == 12) {
                            if ($list->status_approved == 0) {
                                return
                                    '<button id="btn_approved" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-tonase_akhir="' . $list->netto2 . '" data-kodepo="' . $list->lab2_kode_po_gb . '" data-hargaakhir="' . $list->harga_akhir_gb . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Approve Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"> </i>Diajukan
                        </button>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button id="btn_tolak_approved" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-tonase_akhir="' . $list->netto2 . '" data-kodepo="' . $list->lab2_kode_po_gb . '" data-hargaakhir="' . $list->harga_akhir_gb . '" title="Tolak Data" data-offset="5px 5px" data-toggle="m-tooltip" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-minus-circle"> </i>Tolak&nbsp;Approve<br> Cek&nbsp;Data
                        </button>';
                            }
                        } else {
                            return
                                '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check">Approved</i>
                    </button>';
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
                        $result = $list->no_dtm;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '') {
                            return '<span class="badge rounded-pill bg-success">Proses&nbsp;Timbangan&nbsp;2</span>';
                        } else {
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
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_beli_gabah_gb);
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_tempat_gb);
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_gb);
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb);
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
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })

                    ->rawColumns(['name_bid', 'kode_po', 'nama_vendor', 'status_lab2_gb', 'tanggal_po', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            } else {
                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                    ->where('bid.name_bid', '=', 'GABAH BASAH CIHERANG')
                    ->where('data_po.status_bid', '>', 11)
                    ->where('penerimaan_po.status_penerimaan', '>', 11)
                    ->where('lab2_gb.status_lab2_gb', '>', 11)
                    ->orderBy('id_lab2_gb', 'desc')
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
                        return $result;
                    })
                    ->addColumn('status_lab2_gb', function ($list) {
                        if ($list->status_lab2_gb == 12) {
                            if ($list->status_approved == 0) {
                                return
                                    '<button id="btn_approved" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-kodepo="' . $list->lab2_kode_po_gb . '" data-tonase_akhir="' . $list->netto2 . '" data-hargaakhir="' . $list->harga_akhir_gb . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Approve Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"> </i>Diajukan
                        </button>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button id="btn_tolak_approved" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-kodepo="' . $list->lab2_kode_po_gb . '" data-tonase_akhir="' . $list->netto2 . '" data-hargaakhir="' . $list->harga_akhir_gb . '" title="Tolak Data" data-offset="5px 5px" data-toggle="m-tooltip" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-minus-circle"> </i>Tolak&nbsp;Approve<br> Cek&nbsp;Data
                        </button>';
                            }
                        } else {
                            return
                                '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check">Approved</i>
                    </button>';
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
                        $result = $list->no_dtm;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '') {
                            return '<span class="badge rounded-pill bg-success">Proses&nbsp;Timbangan&nbsp;2</span>';
                        } else {
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
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb;
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb;
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = $list->harga_berdasarkan_harga_atas_gb;
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb);
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
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })

                    ->rawColumns(['name_bid', 'kode_po', 'nama_vendor', 'status_lab2_gb', 'tanggal_po', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            }
        }
    }
    public function output_lab2_gb_longgrain_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
                    ->where('data_po.status_bid', '>', 11)
                    ->where('penerimaan_po.status_penerimaan', '>', 11)
                    ->where('lab2_gb.status_lab2_gb', '>', 11)
                    ->orderBy('id_lab2_gb', 'desc')
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
                        return $result;
                    })
                    ->addColumn('status_lab2_gb', function ($list) {
                        if ($list->status_lab2_gb == 12) {
                            if ($list->status_approved == 0) {
                                return
                                    '<button id="btn_approved" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-tonase_akhir="' . $list->netto2 . '" data-kodepo="' . $list->lab2_kode_po_gb . '" data-hargaakhir="' . $list->harga_akhir_gb . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Approve Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"> </i>Diajukan
                        </button>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button id="btn_tolak_approved" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-tonase_akhir="' . $list->netto2 . '" data-kodepo="' . $list->lab2_kode_po_gb . '" data-hargaakhir="' . $list->harga_akhir_gb . '" title="Tolak Data" data-offset="5px 5px" data-toggle="m-tooltip" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-minus-circle"> </i>Tolak&nbsp;Approve<br> Cek&nbsp;Data
                        </button>';
                            }
                        } else {
                            return
                                '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check">Approved</i>
                    </button>';
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
                        $result = $list->dtm_gb;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '') {
                            return '<span class="badge rounded-pill bg-success">Proses&nbsp;Timbangan&nbsp;2</span>';
                        } else {
                            return tonase($result);
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
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_beli_gabah_gb);
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_tempat_gb);
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_gb);
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb);
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
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })

                    ->rawColumns(['name_bid', 'kode_po', 'nama_vendor', 'status_lab2_gb', 'tanggal_po', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            } else {
                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
                    ->where('data_po.status_bid', '>', 11)
                    ->where('penerimaan_po.status_penerimaan', '>', 11)
                    ->where('lab2_gb.status_lab2_gb', '>', 11)
                    ->orderBy('id_lab2_gb', 'desc')
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
                        return $result;
                    })
                    ->addColumn('status_lab2_gb', function ($list) {
                        if ($list->status_lab2_gb == 12) {
                            if ($list->status_approved == 0) {
                                return
                                    '<button id="btn_approved" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-kodepo="' . $list->lab2_kode_po_gb . '" data-tonase_akhir="' . $list->netto2 . '" data-hargaakhir="' . $list->harga_akhir_gb . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Approve Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"> </i>Diajukan
                        </button>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button id="btn_tolak_approved" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-kodepo="' . $list->lab2_kode_po_gb . '" data-tonase_akhir="' . $list->netto2 . '" data-hargaakhir="' . $list->harga_akhir_gb . '" title="Tolak Data" data-offset="5px 5px" data-toggle="m-tooltip" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-minus-circle"> </i>Tolak&nbsp;Approve<br> Cek&nbsp;Data
                        </button>';
                            }
                        } else {
                            return
                                '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check">Approved</i>
                    </button>';
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
                        $result = $list->dtm_gb;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '') {
                            return '<span class="badge rounded-pill bg-success">Proses&nbsp;Timbangan&nbsp;2</span>';
                        } else {
                            return tonase($result);
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
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb;
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb;
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = $list->harga_berdasarkan_harga_atas_gb;
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb);
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
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })

                    ->rawColumns(['name_bid', 'kode_po', 'nama_vendor', 'status_lab2_gb', 'tanggal_po', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            }
        }
    }
    public function output_lab2_gb_pandan_wangi_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
                    ->where('data_po.status_bid', '>', 11)
                    ->where('penerimaan_po.status_penerimaan', '>', 11)
                    ->where('lab2_gb.status_lab2_gb', '>', 11)
                    ->orderBy('id_lab2_gb', 'desc')
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
                        return $result;
                    })
                    ->addColumn('status_lab2_gb', function ($list) {
                        if ($list->status_lab2_gb == 12) {
                            if ($list->status_approved == 0) {
                                return
                                    '<button id="btn_approved" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-tonase_akhir="' . $list->netto2 . '" data-kodepo="' . $list->lab2_kode_po_gb . '" data-hargaakhir="' . $list->harga_akhir_gb . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Approve Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"> </i>Diajukan
                        </button>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button id="btn_tolak_approved" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-tonase_akhir="' . $list->netto2 . '" data-kodepo="' . $list->lab2_kode_po_gb . '" data-hargaakhir="' . $list->harga_akhir_gb . '" title="Tolak Data" data-offset="5px 5px" data-toggle="m-tooltip" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-minus-circle"> </i>Tolak&nbsp;Approve<br> Cek&nbsp;Data
                        </button>';
                            }
                        } else {
                            return
                                '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check">Approved</i>
                    </button>';
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
                        $result = $list->dtm_gb;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '') {
                            return '<span class="badge rounded-pill bg-success">Proses&nbsp;Timbangan&nbsp;2</span>';
                        } else {
                            return tonase($result);
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
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_beli_gabah_gb);
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_tempat_gb);
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_gb);
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb);
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
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })

                    ->rawColumns(['name_bid', 'kode_po', 'nama_vendor', 'status_lab2_gb', 'tanggal_po', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            } else {
                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
                    ->where('data_po.status_bid', '>', 11)
                    ->where('penerimaan_po.status_penerimaan', '>', 11)
                    ->where('lab2_gb.status_lab2_gb', '>', 11)
                    ->orderBy('id_lab2_gb', 'desc')
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
                        return $result;
                    })
                    ->addColumn('status_lab2_gb', function ($list) {
                        if ($list->status_lab2_gb == 12) {
                            if ($list->status_approved == 0) {
                                return
                                    '<button id="btn_approved" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-tonase_akhir="' . $list->netto2 . '" data-kodepo="' . $list->lab2_kode_po_gb . '" data-hargaakhir="' . $list->harga_akhir_gb . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Approve Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"> </i>Diajukan
                        </button>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button id="btn_tolak_approved" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-tonase_akhir="' . $list->netto2 . '" data-kodepo="' . $list->lab2_kode_po_gb . '" data-hargaakhir="' . $list->harga_akhir_gb . '" title="Tolak Data" data-offset="5px 5px" data-toggle="m-tooltip" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-minus-circle"> </i>Tolak&nbsp;Approve<br> Cek&nbsp;Data
                        </button>';
                            }
                        } else {
                            return
                                '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check">Approved</i>
                    </button>';
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
                        $result = $list->dtm_gb;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '') {
                            return '<span class="badge rounded-pill bg-success">Proses&nbsp;Timbangan&nbsp;2</span>';
                        } else {
                            return tonase($result);
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
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb;
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb;
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = $list->harga_berdasarkan_harga_atas_gb;
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb);
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
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })

                    ->rawColumns(['name_bid', 'kode_po', 'nama_vendor', 'status_lab2_gb', 'tanggal_po', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            }
        }
    }
    public function output_lab2_gb_ketan_putih_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
                    ->where('data_po.status_bid', '>', 11)
                    ->where('penerimaan_po.status_penerimaan', '>', 11)
                    ->where('lab2_gb.status_lab2_gb', '>', 11)
                    ->orderBy('id_lab2_gb', 'desc')
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
                        return $result;
                    })
                    ->addColumn('status_lab2_gb', function ($list) {
                        if ($list->status_lab2_gb == 12) {
                            if ($list->status_approved == 0) {
                                return
                                    '<button id="btn_approved" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-tonase_akhir="' . $list->netto2 . '" data-kodepo="' . $list->lab2_kode_po_gb . '" data-hargaakhir="' . $list->harga_akhir_gb . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Approve Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"> </i>Diajukan
                        </button>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button id="btn_tolak_approved" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-tonase_akhir="' . $list->netto2 . '" data-kodepo="' . $list->lab2_kode_po_gb . '" data-hargaakhir="' . $list->harga_akhir_gb . '" title="Tolak Data" data-offset="5px 5px" data-toggle="m-tooltip" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-minus-circle"> </i>Tolak&nbsp;Approve<br> Cek&nbsp;Data
                        </button>';
                            }
                        } else {
                            return
                                '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check">Approved</i>
                    </button>';
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
                        $result = $list->dtm_gb;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '') {
                            return '<span class="badge rounded-pill bg-success">Proses&nbsp;Timbangan&nbsp;2</span>';
                        } else {
                            return tonase($result);
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
                        $result = rupiah($list->plan_harga_gabah_gb);
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_beli_gabah_gb);
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_tempat_gb);
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_gb);
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb);
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
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })

                    ->rawColumns(['name_bid', 'kode_po', 'nama_vendor', 'status_lab2_gb', 'tanggal_po', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            } else {
                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
                    ->where('data_po.status_bid', '>', 11)
                    ->where('penerimaan_po.status_penerimaan', '>', 11)
                    ->where('lab2_gb.status_lab2_gb', '>', 11)
                    ->orderBy('id_lab2_gb', 'desc')
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
                        return $result;
                    })
                    ->addColumn('status_lab2_gb', function ($list) {
                        if ($list->status_lab2_gb == 12) {
                            if ($list->status_approved == 0) {
                                return
                                    '<button id="btn_approved" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-tonase_akhir="' . $list->netto2 . '" data-kodepo="' . $list->lab2_kode_po_gb . '" data-hargaakhir="' . $list->harga_akhir_gb . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Approve Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"> </i>Diajukan
                        </button>';
                            } else if ($list->status_approved == 2) {
                                return
                                    '<button id="btn_tolak_approved" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-tonase_akhir="' . $list->netto2 . '" data-kodepo="' . $list->lab2_kode_po_gb . '" data-hargaakhir="' . $list->harga_akhir_gb . '" title="Tolak Data" data-offset="5px 5px" data-toggle="m-tooltip" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-minus-circle"> </i>Tolak&nbsp;Approve<br> Cek&nbsp;Data
                        </button>';
                            }
                        } else {
                            return
                                '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check">Approved</i>
                    </button>';
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
                        $result = $list->dtm_gb;
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '') {
                            return '<span class="badge rounded-pill bg-success">Proses&nbsp;Timbangan&nbsp;2</span>';
                        } else {
                            return tonase($result);
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
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb;
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb;
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = $list->harga_berdasarkan_harga_atas_gb;
                        return $result;
                    })

                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb);
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
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })

                    ->rawColumns(['name_bid', 'kode_po', 'nama_vendor', 'status_lab2_gb', 'tanggal_po', 'keterangan_penerimaan_po', 'no_dtm', 'plat_kendaraan', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'berat_sample_beras', 'wh', 'tp', 'md', 'broken_setelah_bongkar', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            }
        }
    }
    public function approve_lab2_gb($id)
    {

        $get_kode_po                        = DB::table('lab2_gb')->where('id_lab2_gb', $id)->first();
        $data                               = FinishingQCGb::where('id_lab2_gb', $id)->first();
        $data->status_lab2_gb               = 13;
        $data->status_approved              = 1;
        $data->aksi_harga_gb                = 'ON PROCESS';
        $data->created_at_approved          = date('Y-m-d H:i:s');
        $data->keterangan_harga_akhir_gb    = 'Harga Sesuai Hasil Lab';
        $data->update();

        $data                               = DataPO::where('kode_po', $get_kode_po->lab2_kode_po_gb)->first();
        $data->status_bid                   = 13;
        $data->update();

        $data                               = PenerimaanPO::where('penerimaan_kode_po', $get_kode_po->lab2_kode_po_gb)->first();
        $data->status_penerimaan            = 13;
        $data->update();

        $log                                 = new LogAktivitySpvQc();
        $log->nama_user                      = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_spvqc       = $id;
        $log->aktivitas_spvqc                = 'Approved Lab 2. Kode PO:' . $get_kode_po->lab2_kode_po_gb;
        $log->keterangan_aktivitas           = 'Selesai';
        $log->created_at                     = date('Y-m-d H:i:s');
        $log->save();
        return response()->json($data);
    }
    public function output_lab2_pk_index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->where('lab2_pk.status_lab2_pk', '>', 11)
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->orderBy('lab2_pk.id_lab2_pk', 'desc')
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
                        return $result;
                    })
                    ->addColumn('status_lab2_pk', function ($list) {
                        if ($list->status_lab2_pk == 12) {
                            if ($list->status_approved_pk == '' || $list->status_approved_pk == NULL) {
                                return
                                    '<button id="btn_approve_lab2_pk" style="margin:2px;" data-id="' . $list->id_lab2_pk . '" data-tonase_akhir="' . $list->netto2 . '" data-kodepo="' . $list->lab2_kode_po_pk . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Approve Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"> </i>Diajukan
                            </button>';
                            } else if ($list->status_approved_pk == 2) {
                                return
                                    '<button style="margin:2px;" data-id="' . $list->id_lab2_pk . '" data-tonase_akhir="' . $list->netto2 . '" data-kodepo="' . $list->lab2_kode_po_pk . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Tolak Approve" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-minus"> </i>Tolak Approve
                            </button>';
                            } else {
                                return
                                    '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-check">Approved</i>
                            </button>';
                            }
                        } else {
                            return
                                '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check">Approved</i>
                        </button>';
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
                        $result = $list->refraksi_ka_pk;
                        return rupiah($result);
                    })
                    ->addColumn('refraksi_hampa_pk', function ($list) {
                        $result = $list->refraksi_hampa_pk;
                        return rupiah($result);
                    })
                    ->addColumn('refraksi_katul_pk', function ($list) {
                        $result = $list->refraksi_katul_pk;
                        return rupiah($result);
                    })
                    ->addColumn('refraksi_tr_pk', function ($list) {
                        $result = $list->refraksi_tr_pk;
                        return rupiah($result);
                    })
                    ->addColumn('refraksi_butir_patah_pk', function ($list) {
                        $result = $list->refraksi_butir_patah_pk;
                        return rupiah($result);
                    })
                    ->addColumn('reward_hampa_pk', function ($list) {
                        $result = $list->reward_hampa_pk;
                        return rupiah($result);
                    })
                    ->addColumn('reward_katul_pk', function ($list) {
                        $result = $list->reward_katul_pk;
                        return rupiah($result);
                    })
                    ->addColumn('reward_tr_pk', function ($list) {
                        $result = $list->reward_tr_pk;
                        return rupiah($result);
                    })
                    ->addColumn('reward_butir_patah_pk', function ($list) {
                        $result = $list->reward_butir_patah_pk;
                        return rupiah($result);
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
                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->where('lab2_pk.status_lab2_pk', '>', 11)
                    ->orderBy('lab2_pk.id_lab2_pk', 'desc')
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
                        return $result;
                    })
                    ->addColumn('status_lab2_pk', function ($list) {
                        if ($list->status_lab2_pk == 12) {
                            if ($list->status_approved_pk == '' || $list->status_approved_pk == NULL) {
                                return
                                    '<button id="btn_approve_lab2_pk" style="margin:2px;" data-id="' . $list->id_lab2_pk . '" data-tonase_akhir="' . $list->netto2 . '" data-kodepo="' . $list->lab2_kode_po_pk . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Approve Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner"> </i>Diajukan
                            </button>';
                            } else if ($list->status_approved_pk == 2) {
                                return
                                    '<button style="margin:2px;" data-id="' . $list->id_lab2_pk . '" data-tonase_akhir="' . $list->netto2 . '" data-kodepo="' . $list->lab2_kode_po_pk . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Tolak Approve" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-minus"> </i>Tolak Approve
                            </button>';
                            } else {
                                return
                                    '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-check">Approved</i>
                            </button>';
                            }
                        } else {
                            return
                                '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="to_pending btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check">Approved</i>
                        </button>';
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
                        $result = $list->refraksi_ka_pk;
                        return rupiah($result);
                    })
                    ->addColumn('refraksi_hampa_pk', function ($list) {
                        $result = $list->refraksi_hampa_pk;
                        return rupiah($result);
                    })
                    ->addColumn('refraksi_katul_pk', function ($list) {
                        $result = $list->refraksi_katul_pk;
                        return rupiah($result);
                    })
                    ->addColumn('refraksi_tr_pk', function ($list) {
                        $result = $list->refraksi_tr_pk;
                        return rupiah($result);
                    })
                    ->addColumn('refraksi_butir_patah_pk', function ($list) {
                        $result = $list->refraksi_butir_patah_pk;
                        return rupiah($result);
                    })
                    ->addColumn('reward_hampa_pk', function ($list) {
                        $result = $list->reward_hampa_pk;
                        return rupiah($result);
                    })
                    ->addColumn('reward_katul_pk', function ($list) {
                        $result = $list->reward_katul_pk;
                        return rupiah($result);
                    })
                    ->addColumn('reward_tr_pk', function ($list) {
                        $result = $list->reward_tr_pk;
                        return rupiah($result);
                    })
                    ->addColumn('reward_butir_patah_pk', function ($list) {
                        $result = $list->reward_butir_patah_pk;
                        return rupiah($result);
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
    public function tolak_approved($id)
    {

        $get            = DB::table('lab2_gb')->where('id_lab2_gb', $id)->first();
        $update            = DB::table('lab2_gb')->where('id_lab2_gb', $id)->update(['status_approved' => 2]);

        $log                               = new LogAktivitySpvQc();
        $log->nama_user                    = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_spvqc       = $id;
        $log->aktivitas_spvqc                = 'Tolak Approved. Kode PO:' . $get->lab2_kode_po_gb;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();
        // return redirect()->back();
    }
    public function tolak_approved_pk($id)
    {
        $get_kode_po = DB::table('lab2_pk')->where('id_lab2_pk', $id)->update(['status_approved_pk' => 2]);
        // return redirect()->back();
    }
    public function cekstatuslab1($id)
    {
        $data = DB::table('lab1_pk')->where('lab1_kode_po_pk', $id)->count();
        return json_encode($data);
    }
    public function update_harga_akhir_gb(Request $request)
    {
        if ($request->analisa == 'tidak') {
            $data = DB::table('lab2_gb')->where('id_lab2_gb', $request->id_lab2_gb)->update(['harga_akhir_permintaan_gb' => $request->harga_akhir_permintaan_gb, 'keterangan_harga_akhir_gb' => 'Harga Sesuai Permintaan']);
            $get_kode_po            = DB::table('lab2_gb')->where('id_lab2_gb', $request->id_lab2_gb)->first();
            $update_data_po         = DB::table('data_po')->where('kode_po', $get_kode_po->lab2_kode_po_gb)->update(['status_bid' => 13]);
            $update_pernerimaan_po  = DB::table('penerimaan_po')->where('penerimaan_kode_po', $get_kode_po->lab2_kode_po_gb)->update(['status_penerimaan' => 13]);
            $update_gabah_incoming  = DB::table('lab1_gb')->where('lab1_kode_po_gb', $get_kode_po->lab2_kode_po_gb)->update(['status_lab1_gb' => 13]);
            $update_gabah_finishing = DB::table('lab2_gb')->where('lab2_kode_po_gb', $get_kode_po->lab2_kode_po_gb)->update(['status_lab2_gb' => 13]);
        } else {
            $get_kode_po            = DB::table('lab2_gb')->where('id_lab2_gb', $request->id_lab2_gb)->first();
            $data = DB::table('lab2_gb')->where('id_lab2_gb', $request->id_lab2_gb)->update(['keterangan_harga_akhir_gb' => 'Harga Sesuai Hasil Lab']);
            $update_data_po         = DB::table('data_po')->where('kode_po', $get_kode_po->lab2_kode_po_gb)->update(['status_bid' => 13]);
            $update_pernerimaan_po  = DB::table('penerimaan_po')->where('penerimaan_kode_po', $get_kode_po->lab2_kode_po_gb)->update(['status_penerimaan' => 13]);
            $update_gabah_incoming  = DB::table('lab1_gb')->where('lab1_kode_po_gb', $get_kode_po->lab2_kode_po_gb)->update(['status_lab1_gb' => 13]);
            $update_gabah_finishing = DB::table('lab2_gb')->where('lab2_kode_po_gb', $get_kode_po->lab2_kode_po_gb)->update(['status_lab2_gb' => 13]);
        }
        return redirect()->back();
    }
    public function update_harga_akhir_pk(Request $request)
    {
        if ($request->analisa == 'tidak') {
            $data = DB::table('lab1_pk')->where('id_lab1_pk', $request->id_lab1_pk)->update(['status_lab1_pk' => 13, 'harga_akhir_permintaan_pk' => $request->harga_akhir_permintaan_pk, 'keterangan_harga_akhir_pk' => 'Harga Sesuai Permintaan']);
        } else {
            $data = DB::table('lab1_pk')->where('id_lab1_pk', $request->id_lab1_pk)->update(['status_lab1_pk' => 13, 'keterangan_harga_akhir_pk' => 'Harga Sesuai Hasil Lab']);
        }
        return redirect()->back();
    }
    public function approve_lab2_pk($id)
    {
        $get_kode_po            = DB::table('lab2_pk')->where('id_lab2_pk', $id)->first();
        $update_data_po         = DB::table('data_po')->where('kode_po', $get_kode_po->lab2_kode_po_pk)->update(['status_bid' => 13]);
        $update_pernerimaan_po  = DB::table('penerimaan_po')->where('penerimaan_kode_po', $get_kode_po->lab2_kode_po_pk)->update(['status_penerimaan' => 13]);
        $update_gabah_finishing = DB::table('lab2_pk')->where('lab2_kode_po_pk', $get_kode_po->lab2_kode_po_pk)->update(['status_lab2_pk' => 13, 'aksi_harga_pk' => 'ON PROCESS']);
        $cek_lab1_pk            = DB::table('lab1_pk')->where('lab1_kode_po_pk', $get_kode_po->lab2_kode_po_pk)->where('status_lab1_pk', '13')->count();
        return json_encode($cek_lab1_pk);
    }
    public function nego_gb_ciherang_index(Request $request)
    {
        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('bid.name_bid', '=', 'GABAH BASAH CIHERANG')
            ->where('lab2_gb.aksi_harga_gb', 'NEGO')
            ->get())
            // return $query;
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
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
                $result = rupiah($list->plan_harga_beli_gabah_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_berdasarkan_tempat', function ($list) {
                $result = rupiah($list->harga_berdasarkan_tempat_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_awal', function ($list) {
                $result = rupiah($list->harga_awal_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_akhir', function ($list) {
                $result = $list->harga_akhir_permintaan_gb;
                if ($result == null | $result == '') {
                    $result = rupiah($list->harga_akhir_gb) . '/Kg';
                    return $result;
                } else {
                    $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                    return $result;
                }
            })
            ->addColumn('aksi_harga', function ($list) {
                $result = $list->aksi_harga_gb;
                return '
                    <button id="btn_output_gb" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-kode_po="' . $list->kode_po . '" data-toggle="modal" data-target="#modaloutputnegogb" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    PROSES&nbsp;NEGO
                    </button>';
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
            ->rawColumns(['name_bid', 'harga_akhir', 'nama_vendor', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
            ->make(true);
    }
    public function nego_gb_longgrain_index(Request $request)
    {
        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
            ->where('lab2_gb.aksi_harga_gb', 'NEGO')
            ->get())
            // return $query;
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
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
            ->addColumn('plan_harga_beli_gabah', function ($list) {
                $result = rupiah($list->plan_harga_beli_gabah_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_berdasarkan_tempat', function ($list) {
                $result = rupiah($list->harga_berdasarkan_tempat_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_awal', function ($list) {
                $result = rupiah($list->harga_awal_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_akhir', function ($list) {
                $result = $list->harga_akhir_permintaan_gb;
                if ($result == null | $result == '') {
                    $result = rupiah($list->harga_akhir_gb) . '/Kg';
                    return $result;
                } else {
                    $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                    return $result;
                }
            })
            ->addColumn('aksi_harga', function ($list) {
                $result = $list->aksi_harga_gb;
                return '
                <button id="btn_output_gb" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-kode_po="' . $list->kode_po . '" data-toggle="modal" data-target="#modaloutputnegogb" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                PROSES&nbsp;NEGO
                </button>';
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
            ->rawColumns(['name_bid', 'harga_akhir', 'nama_vendor', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
            ->make(true);
    }
    public function nego_gb_pandan_wangi_index(Request $request)
    {

        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('lab2_gb.aksi_harga_gb', 'NEGO')
            ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
            ->get())
            // return $query;
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
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
            ->addColumn('plan_harga_beli_gabah', function ($list) {
                $result = rupiah($list->plan_harga_beli_gabah_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_berdasarkan_tempat', function ($list) {
                $result = rupiah($list->harga_berdasarkan_tempat_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_awal', function ($list) {
                $result = rupiah($list->harga_awal_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_akhir', function ($list) {
                $result = $list->harga_akhir_permintaan_gb;
                if ($result == null | $result == '') {
                    $result = rupiah($list->harga_akhir_gb) . '/Kg';
                    return $result;
                } else {
                    $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                    return $result;
                }
            })
            ->addColumn('aksi_harga', function ($list) {
                $result = $list->aksi_harga_gb;
                return '
                <button id="btn_output_gb" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-kode_po="' . $list->kode_po . '" data-toggle="modal" data-target="#modaloutputnegogb" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                PROSES&nbsp;NEGO
                </button>';
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
            ->rawColumns(['name_bid', 'harga_akhir', 'nama_vendor', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
            ->make(true);
    }
    public function nego_gb_ketan_putih_index(Request $request)
    {

        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('lab2_gb.aksi_harga_gb', 'NEGO')
            ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
            ->get())
            // return $query;
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
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
            ->addColumn('plan_harga_beli_gabah', function ($list) {
                $result = rupiah($list->plan_harga_beli_gabah_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_berdasarkan_tempat', function ($list) {
                $result = rupiah($list->harga_berdasarkan_tempat_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_awal', function ($list) {
                $result = rupiah($list->harga_awal_gb) . '/Kg';
                return $result;
            })
            ->addColumn('harga_akhir', function ($list) {
                $result = $list->harga_akhir_permintaan_gb;
                if ($result == null | $result == '') {
                    $result = rupiah($list->harga_akhir_gb) . '/Kg';
                    return $result;
                } else {
                    $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                    return $result;
                }
            })
            ->addColumn('aksi_harga', function ($list) {
                $result = $list->aksi_harga_gb;
                return '
                    <button id="btn_output_gb" style="margin:2px;" data-id="' . $list->id_lab2_gb . '" data-kode_po="' . $list->kode_po . '" data-toggle="modal" data-target="#modaloutputnegogb" title="Information" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    PROSES&nbsp;NEGO
                    </button>';
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
            ->rawColumns(['name_bid', 'harga_akhir', 'nama_vendor', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
            ->make(true);
    }
    public function nego_pk_index(Request $request)
    {

        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('lab1_pk', 'lab1_pk.lab1_kode_po_pk', '=', 'data_po.kode_po')
            ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
            ->where('lab1_pk.aksi_harga_pk', 'NEGO')
            ->where('bid.name_bid', '=', 'BERAS PECAH KULIT')
            ->get())
            // return $query;
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
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
                return $result . 'Kg';
            })
            ->addColumn('tonase_akhir', function ($list) {
                $result = $list->tonase_akhir;
                return $result . 'Kg';
            })
            ->addColumn('hasil_akhir_tonase', function ($list) {
                $result = $list->hasil_akhir_tonase;
                return $result . 'Kg';
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
                $result = $list->harga_akhir_permintaan_pk;
                if ($result == null | $result == '') {
                    $result = rupiah($list->harga_akhir_pk) . '/Kg';
                    return $result;
                } else {
                    $result = rupiah($list->harga_akhir_permintaan_pk) . '/Kg';
                    return $result;
                }
            })
            ->addColumn('aksi_harga', function ($list) {
                $result = $list->aksi_harga_pk;
                return '
                    <button id="btn_output_pk" style="margin:2px;" data-id="' . $list->id_lab1_pk . '" data-kode_po="' . $list->kode_po . '" data-toggle="modal" data-target="#modaloutputnegopk" title="Information" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    PROSES&nbsp;NEGO
                    </button>';
            })
            ->rawColumns(['name_bid', 'nama_vendor', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
            ->make(true);
    }

    // PARAMETER LAB

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
        return view('dashboard.admin_master.admin_spvqc.plan_hpp_gabah_basah', compact('data'));
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


            $log                               = new LogAktivitySpvQc();
            $log->nama_user                    = Auth::guard('master')->user()->name_master;
            $log->id_objek_aktivitas_spvqc       = $data->id_plan_hpp_gb;
            $log->aktivitas_spvqc                = 'Insert Plan HPP Tanggal PO:' . $req->add_tanggal_po;
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


            $log                               = new LogAktivitySpvQc();
            $log->nama_user                    = Auth::guard('master')->user()->name_master;
            $log->id_objek_aktivitas_spvqc       = $id_plan_hpp;
            $log->aktivitas_spvqc                = 'Update Plan HPP Tanggal PO:' . $req->tanggal_po;
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
        $log                               = new LogAktivitySpvQc();
        $log->nama_user                    = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_spvqc       = $data->id_plan_hpp_gb;
        $log->aktivitas_spvqc                = 'Delete Plan HPP Tanggal PO:' . $data->waktu_plan_hpp_gb;
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
        return view('dashboard.admin_master.admin_spvqc.plan_hpp_gabah_kering ');
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
        return view('dashboard.admin_master.admin_spvqc.plan_hpp_beras_pecah_kulit ');
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
        return view('dashboard.admin_master.admin_spvqc.plan_hpp_beras_ds ');
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
        return view('dashboard.admin_master.admin_spvqc.parameter_lab_gb');
    }

    public function parameter_pk_refraksi(Request $req)
    {
        return view('dashboard.admin_master.admin_spvqc.parameter_lab_pk_refraksi');
    }

    public function parameter_lab_pk_reward(Request $req)
    {
        return view('dashboard.admin_master.admin_spvqc.parameter_lab_pk_reward');
    }

    public function parameter_lab_pk_kualitas(Request $req)
    {
        return view('dashboard.admin_master.admin_spvqc.parameter_lab_pk_kualitas');
    }

    public function parameter_beras_ds(Request $req)
    {
        return view('dashboard.admin_master.admin_spvqc.parameter_lab_beras_ds');
    }

    public function parameter_gk(Request $req)
    {
        return view('dashboard.admin_master.admin_spvqc.parameter_lab_gk');
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
                 <a style="margin:2px;" href="' . route('master.lab.destroy_parameter_lab_gb', ['id' => $list->id_parameter]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
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
        return view('dashboard.admin_master.admin_spvqc.harga_atas_gabah_basah', ['data' => $data]);
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

        $log                               = new LogAktivitySpvQc();
        $log->nama_user                    = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_spvqc       = $data->id_harga_atas_gb;
        $log->aktivitas_spvqc                = 'Insert Harga Atas Tanggal PO:' . $req->waktu_harga_atas;
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

        $log                               = new LogAktivitySpvQc();
        $log->nama_user                    = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_spvqc       = $req->id_harga_atas_update;
        $log->aktivitas_spvqc                = 'Update Harga Atas Tanggal PO:' . $req->waktu_harga_atas_update;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();
        return response()->json($data);
    }
    public function destroy_harga_atas_gabah_basah($id)
    {
        $get = HargaAtasGabahBasah::where('id_harga_atas_gb', $id)->first();
        $log                               = new LogAktivitySpvQc();
        $log->nama_user                    = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_spvqc       = $id;
        $log->aktivitas_spvqc                = 'Delete Harga Atas Tanggal PO:' . $get->waktu_harga_atas_gb;
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
        return view('dashboard.admin_master.admin_spvqc.harga_atas_gabah_kering', ['data' => $data]);
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
        return view('dashboard.admin_master.admin_spvqc.harga_atas_pecah_kulit', ['data' => $data]);
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
        return view('dashboard.admin_master.admin_spvqc.harga_atas_beras_ds', ['data' => $data]);
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
        return view('dashboard.admin_master.admin_spvqc.harga_bawah');
    }
    public function harga_bawah_gabah_basah_index()
    {
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
        $data->min_toleransi_harga_bawah_gb     = $req->min_harga_bawah;
        $data->max_toleransi_harga_bawah_gb     = $req->max_harga_bawah;
        $data->waktu_harga_bawah_gb = $req->waktu_harga_bawah;
        $data->save();

        $log                               = new LogAktivitySpvQc();
        $log->nama_user                    = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_spvqc       = $data->id_harga_bawah_gb;
        $log->aktivitas_spvqc                = 'Insert Harga Bawah Tanggal PO:' . $req->waktu_harga_bawah;
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
        $data->min_toleransi_harga_bawah_gb     = $req->min_harga_bawah_update;
        $data->max_toleransi_harga_bawah_gb     = $req->max_harga_bawah_update;
        $data->waktu_harga_bawah_gb = $req->waktu_harga_bawah_update;
        $data->update();

        $log                               = new LogAktivitySpvQc();
        $log->nama_user                    = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_spvqc       = $req->id_harga_bawah_update;
        $log->aktivitas_spvqc                = 'Update Harga Bawah Tanggal PO: ' . $req->waktu_harga_bawah_update;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();
        return response()->json($data);
    }
    public function destroy_harga_bawah_gabah_basah($id)
    {
        $get = DB::table('harga_bawah_gabah_basah')->where('id_harga_bawah_gb', $id)->first();

        $log                               = new LogAktivitySpvQc();
        $log->nama_user                    = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_spvqc       = $id;
        $log->aktivitas_spvqc                = 'Delete Harga Bawah Tanggal PO:' . $get->waktu_harga_bawah_gb;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();
        $data = DB::table('harga_bawah_gabah_basah')->where('id_harga_bawah_gb', $id)->delete();
        // return redirect()->back();
    }

    //Potongan Bongkar Gabah Basah
    public function potongan_gabah_basah()
    {
        return view('dashboard.admin_master.admin_spvqc.potongan_gabah_basah');
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
        return view('dashboard.admin_master.admin_spvqc.potongan_gabah_kering');
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
        return view('dashboard.admin_master.admin_spvqc.potongan_pecah_kulit');
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
        return view('dashboard.admin_master.admin_spvqc.potongan_beras_ds');
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
        $data = Notif::where('status', 0)->get();
        return json_encode($data);
    }
    public function get_countnotifikasi()
    {
        $data = Notif::where('status', 0)->count();
        return json_encode($data);
    }

    public function getcountnotif_data_sourching_deal()
    {
        $data = DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('lab2_gb.aksi_harga_gb', 'DEAL')
            ->where('bid.name_bid', 'LIKE', '%GABAH BASAH%')
            ->orderBy('id_lab2_gb', 'DESC')
            ->count();
        return json_encode($data);
    }
    public function set_notifikasi(request $request)
    {
        $id = $request->id;
        Notif::where('id_notifikasi', $id)->update(['status' => 1]);
        return redirect()->back();
    }

    public function new_notifikasi()
    {
        $data = Notif::where('notifbaru', 0)->get();
        Notif::where('notifbaru', 0)->update(['notifbaru' => 1]);
        return json_encode($data);
    }

    public function get_price_gt4($id)
    {
        // $data = PotonganBongkarGt04::orderBy('id_potongan_bongkar_gt_04', 'desc')->first();
        $data = DB::table('penerimaan_po')->join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('potongan_bongkar_gt_04', 'potongan_bongkar_gt_04.waktu_potongan_bongkar_gt_04', '=', 'data_po.tanggal_po')->where('penerimaan_po.id_penerimaan_po', $id)->first();
        // return ($data);
        return json_encode($data);
    }

    public function get_price_top_gabah_basah($id)
    {
        //$data = HargaAtas::where('id_harga_atas', 'desc')->first();
        $data = DB::table('penerimaan_po')
            ->join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')
            ->join('harga_atas_gabah_basah', 'harga_atas_gabah_basah.waktu_harga_atas_gb', '=', 'data_po.tanggal_po')
            ->where('id_penerimaan_po', $id)
            ->first();
        return json_encode($data);
    }
    public function get_buttom_price_gabah_basah($id)
    {
        $data = DB::table('penerimaan_po')
            ->join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')
            ->join('harga_bawah_gabah_basah', 'harga_bawah_gabah_basah.waktu_harga_bawah_gb', '=', 'data_po.tanggal_po')
            ->where('id_penerimaan_po', $id)
            ->first();
        return json_encode($data);
    }
    public function get_price_top_gabah_kering($id)
    {
        //$data = HargaAtas::where('id_harga_atas', 'desc')->first();
        $data = DB::table('penerimaan_po')->join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('harga_atas_gabah_kering', 'harga_atas_gabah_kering.waktu_harga_atas_gk', '=', 'data_po.tanggal_po')->where('id_penerimaan_po', $id)->first();
        return json_encode($data);
    }
    public function get_price_top_pecah_kulit($id)
    {
        //$data = HargaAtas::where('id_harga_atas', 'desc')->first();
        $data = DB::table('penerimaan_po')->join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('harga_atas_pecah_kulit', 'harga_atas_pecah_kulit.waktu_harga_atas_pk', '=', 'data_po.tanggal_po')->where('id_penerimaan_po', $id)->first();
        return json_encode($data);
    }
    public function get_price_top_beras_ds($id)
    {
        //$data = HargaAtas::where('id_harga_atas', 'desc')->first();
        $data = DB::table('penerimaan_po')->join('data_po', 'data_po.kode_po', '=', 'penerimaan_po.penerimaan_kode_po')->join('harga_atas_beras_ds', 'harga_atas_beras_ds.waktu_harga_atas_ds', '=', 'data_po.tanggal_po')->where('id_penerimaan_po', $id)->first();
        return json_encode($data);
    }

    // LOG ACTIVITY ADMIN QC SPV LAB
    public function log_activity_spvqc()
    {
        return view('dashboard.admin_master.admin_spvqc.log_activity_spvqc ');
    }

    public function log_activity_spvqc_index()
    {
        return Datatables::of(DB::table('log_aktivitas_spvqc')
            ->orderby('id_aktivitas_spvqc', 'desc')
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
