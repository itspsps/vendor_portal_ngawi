<?php

namespace App\Http\Controllers\AdminMaster;

use App\Http\Controllers\Controller;
use App\Models\LogAktivityAp;
use App\Models\potongPajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use DataTables;
use App\Models\Notif;
use App\Models\PenerimaanPO;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class MasterApController extends Controller
{
    public function potong_pajak()
    {
        return view('dashboard.admin_master.admin_ap.potong_pajak');
    }
    public function upload_potong_pajak(Request $request)
    {
        $filepotong_pajak       = $request->file('potong_pajak_file');
        $imageNamepotongpajak  = 'PJK.SPS.NGW-' . time() . '.' . $request->potong_pajak_file->extension();
        $movepotong_pajak       = $filepotong_pajak->move('public/dokumen/potong_pajak/', $imageNamepotongpajak);
        if ($request->bulan == 'lalu') {
            $query                              = new potongPajak();
            $query->id_user_potong_pajak        = $request->id_user;
            $query->judul_potong_pajak          = $request->judul_potong_pajak;
            $query->keterangan_potong_pajak     = $request->keterangan_potong_pajak;
            $query->file_potong_pajak           = $imageNamepotongpajak;
            $query->date_potong_pajak           = Carbon::now()->subMonthsNoOverflow()->startOfMonth();
            $query->status_potong_pajak         = '1';
            $query->status_notif_potong_pajak   = '0';
            $query->status_baca_potong_pajak    = '0';
            $query->created_at                  = date('Y-m-d H:i:s');
            $query->save();

            $log                               = new LogAktivityAp();
            $log->nama_user                    = Auth::guard('master')->user()->name_master;
            $log->id_objek_aktivitas_ap       = $query->id_potong_pajak;
            $log->aktivitas_ap                = 'Upload Bukti Potong Pajak dengan Judul :' . $request->judul_potong_pajak . ' Bulan : ' . Carbon::now()->subMonthsNoOverflow()->startOfMonth();
            $log->keterangan_aktivitas         = 'Selesai';
            $log->created_at                   = date('Y-m-d H:i:s');
            $log->save();
        } else if ($request->bulan == 'now') {
            $query                              = new potongPajak();
            $query->id_user_potong_pajak        = $request->id_user;
            $query->judul_potong_pajak          = $request->judul_potong_pajak;
            $query->keterangan_potong_pajak     = $request->keterangan_potong_pajak;
            $query->file_potong_pajak           = $imageNamepotongpajak;
            $query->date_potong_pajak           = Carbon::now()->startOfMonth();
            $query->status_potong_pajak         = '1';
            $query->status_notif_potong_pajak   = '0';
            $query->status_baca_potong_pajak    = '0';
            $query->created_at                  = date('Y-m-d H:i:s');
            $query->save();
            $log                               = new LogAktivityAp();
            $log->nama_user                    = Auth::guard('master')->user()->name_master;
            $log->id_objek_aktivitas_ap       = $query->id_potong_pajak;
            $log->aktivitas_ap                = 'Upload Bukti Potong Pajak dengan Judul :' . $request->judul_potong_pajak . '. Bulan : ' . Carbon::now()->startOfMonth();
            $log->keterangan_aktivitas         = 'Selesai';
            $log->created_at                   = date('Y-m-d H:i:s');
            $log->save();
        }
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data Anda Tersimpan');
    }
    public function update_potong_pajak(Request $request)
    {
        $path = '/home/u1736638/public_html/ngawi.suryapangansemesta.store/public/dokumen/potong_pajak/';

        $file_old = $path . $request->potong_pajak_file_old;
        unlink($file_old);
        $filepotong_pajak       = $request->file('potong_pajak_file_update');
        $imageNamepotong_pajak  = time() . '.' . $request->potong_pajak_file_update->extension();
        $movepotong_pajak       = $filepotong_pajak->move('public/dokumen/potong_pajak/', $imageNamepotong_pajak);

        $query                              = potongPajak::where('id_potong_pajak')->first();
        $query->judul_potong_pajak          = $request->judul_potong_pajak_update;
        $query->keterangan_potong_pajak     = $request->keterangan_potong_pajak_update;
        $query->file_potong_pajak           = $imageNamepotong_pajak;
        $query->created_at                  = date('Y-m-d H:i:s');
        $query->update();
        // LOG 
        $log                               = new LogAktivityAp();
        $log->nama_user                    = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_ap       = $query->id_potong_pajak;
        $log->aktivitas_ap                = 'Update Bukti Potong Pajak dengan Judul :' . $request->judul_potong_pajak_update . ' Keterangan : ' . $request->keterangan_potong_pajak_update;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data Anda Tersimpan');
    }
    public function delete_potong_pajak($id)
    {
        $cek = DB::table('potong_pajak')
            ->where('id_potong_pajak', $id)
            ->first();
        $path = '/home/u1736638/public_html/ngawi.suryapangansemesta.store/public/dokumen/potong_pajak/';

        $file_old = $path . $cek->file_potong_pajak;
        if (file_exists($file_old)) {
            unlink($file_old);
        }
        $log                                = new LogAktivityAp();
        $log->nama_user                     = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_ap         = $cek->id_potong_pajak;
        $log->aktivitas_ap                  = 'Hapus Bukti Potong Pajak dengan Judul :' . $cek->judul_potong_pajak;
        $log->keterangan_aktivitas          = 'Selesai';
        $log->created_at                    = date('Y-m-d H:i:s');
        $log->save();
        $query = DB::table('potong_pajak')->where('id_potong_pajak', $id)->delete();
    }
    public function potong_pajak_index()
    {
        // dd(DB::table('data_po')
        //     ->join('users', 'users.id', 'data_po.user_idbid')
        //     ->where('data_po.status_bid', '!=', '5')
        //     ->groupBy('data_po.user_idbid')
        //     ->get());
        // dd($previousmonth);
        return Datatables::of(DB::table('data_po')
            ->join('users', 'users.id', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', 'data_po.id_data_po')
            // ->leftjoin('potong_pajak', 'potong_pajak.potong_pajak_id_user', 'users.id')
            ->where('data_po.status_bid', '!=', '5')
            ->whereMonth('tanggal_po', Carbon::now()->subMonthsNoOverflow()->isoFormat('M'))
            ->groupBy('data_po.user_idbid')
            ->selectRaw('users.id,users.nama_vendor,COUNT(*) AS total_po')
            ->get())
            ->addColumn('judul', function ($list) {
                $result = $list->nama_vendor;
                return $result;
            })
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return $result;
            })
            ->addColumn('total_po', function ($list) {
                $result = $list->total_po;
                return '
                <a href="javascript:void(0);" disabled title="Total Pengiriman" class="toyakin btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . ' PO
                </a>';
            })
            ->addColumn('ckelola', function ($list) {
                $cek = DB::table('potong_pajak')
                    ->where('id_user_potong_pajak', $list->id)
                    ->whereMonth('date_potong_pajak', Carbon::now()->subMonthsNoOverflow()->isoFormat('M'))
                    ->first();
                if (empty($cek)) {
                    return '
                            <button id="btn_modal_upload" style="margin:2px;" data-id="' . $list->id . '" data-bulan="lalu" data-offset="5px 5px" data-toggle="m-tooltip" title="Ubah status" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-file"></i> Upload
                            </button>';
                } else {
                    if ($cek->status_potong_pajak == 1) {
                        return '
                                <button disabled data-id="' . $list->id . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Upload File" onclick="return true" class="toyakin btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-check"></i> SUKSES
                                </button>
                                <a href="javascript:void(0);" data-id="' . $cek->id_potong_pajak . '" data-bulan="now" example1 data-potong_pajak="' . $cek->file_potong_pajak . '" data-judul="' . $cek->judul_potong_pajak . '" data-keterangan="' . $cek->keterangan_potong_pajak . '"  id="btn_edit_potong_pajak" data-offset="5px 5px" data-toggle="m-tooltip" title="Ubah File" onclick="return true" class="toyakin btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-edit text-warning"></i>
                                </a>
                                <a href="javascript:void(0);" data-id="' . $cek->id_potong_pajak . '" data-offset="5px 5px" id="btn_hapus_potong_pajak" data-toggle="m-tooltip" title="Hapus" onclick="return true" class="toyakin btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-trash text-danger"></i>
                                </a>';
                    } else {
                        return '
                                <button id="btn_modal_upload" style="margin:2px;" data-id="' . $list->id . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Upload File" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-file"></i> Upload
                                </button>';
                    }
                }
            })
            ->rawColumns(['nama_vendor', 'total_po', 'ckelola'])
            ->make(true);
    }
    public function potong_pajak1_index()
    {
        // dd(DB::table('data_po')
        //     ->join('users', 'users.id', 'data_po.user_idbid')
        //     ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', 'data_po.id_data_po')
        //     // ->leftjoin('potong_pajak', 'potong_pajak.potong_pajak_id_user', 'users.id')
        //     ->where('data_po.status_bid', '!=', '5')
        //     ->whereMonth('tanggal_po', Carbon::now()->month)
        //     ->groupBy('data_po.user_idbid')
        //     ->selectRaw('users.id,users.nama_vendor,COUNT(*) AS total_po')
        //     ->get());
        return Datatables::of(DB::table('data_po')
            ->join('users', 'users.id', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', 'data_po.id_data_po')
            // ->leftjoin('potong_pajak', 'potong_pajak.potong_pajak_id_user', 'users.id')
            ->where('data_po.status_bid', '!=', '5')
            ->whereMonth('tanggal_po', Carbon::now()->month)
            ->groupBy('data_po.user_idbid')
            ->selectRaw('users.id,users.nama_vendor,COUNT(*) AS total_po')
            ->get())
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return $result;
            })
            ->addColumn('total_po', function ($list) {
                $result = $list->total_po;
                return '
                <a href="javascript:void(0);" disabled title="Total Pengiriman" class="toyakin btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . ' PO
                </a>';
            })
            ->addColumn('ckelola', function ($list) {
                $cek = DB::table('potong_pajak')
                    ->where('id_user_potong_pajak', $list->id)
                    ->whereMonth('date_potong_pajak', Carbon::now()->month)
                    ->first();
                if (empty($cek)) {
                    return '
                        <button id="btn_modal_upload" style="margin:2px;" data-id="' . $list->id . '" data-bulan="now" data-offset="5px 5px" data-toggle="m-tooltip" title="Ubah status" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-file"></i> Upload
                        </button>';
                } else {
                    if ($cek->status_potong_pajak == 1) {
                        return '
                            <button disabled data-id="' . $list->id . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Upload File" onclick="return true" class="toyakin btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-check"></i> SUKSES
                            </button>
                            <a href="javascript:void(0);" data-id="' . $cek->id_potong_pajak . '" data-bulan="now" example1 data-potong_pajak="' . $cek->file_potong_pajak . '" data-judul="' . $cek->judul_potong_pajak . '" data-keterangan="' . $cek->keterangan_potong_pajak . '"  id="btn_edit_potong_pajak" data-offset="5px 5px" data-toggle="m-tooltip" title="Ubah File" onclick="return true" class="toyakin btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-edit text-warning"></i>
                            </a>
                            <a href="javascript:void(0);" data-id="' . $cek->id_potong_pajak . '" data-offset="5px 5px" id="btn_hapus_potong_pajak" data-toggle="m-tooltip" title="Hapus" onclick="return true" class="toyakin btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-trash text-danger"></i>
                            </a>';
                    } else {
                        return '
                            <button id="btn_modal_upload" style="margin:2px;" data-id="' . $list->id . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Upload File" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-file"></i> Upload
                            </button>';
                    }
                }
            })
            ->rawColumns(['nama_vendor', 'total_po', 'ckelola'])
            ->make(true);
    }

    public function data_pembelian_gb()
    {
        return view('dashboard.admin_master.admin_ap.data_pembelian_gb');
    }
    public function data_pembelian_pk()
    {
        return view('dashboard.admin_master.admin_ap.data_pembelian_pk');
    }

    public function data_pembelian_gb_ciherang_index()
    {
        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('data_po.status_bid', 13)
            ->where('lab2_gb.aksi_harga_gb', 'DEAL')
            ->where('bid.name_bid', '=', 'GABAH BASAH CIHERANG')
            ->orderby('penerimaan_po.id_penerimaan_po', 'desc')
            ->get())
            ->addColumn('site', function ($list) {
                $result = 'NGAWI';
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
            ->addColumn('antrian', function ($list) {
                $result = $list->no_antrian;
                return '<a style="margin:2px;"  title="Informasi" class="btn btn-outline-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
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
            ->addColumn('harga_akhir', function ($list) {
                $result = $list->harga_akhir_permintaan_gb;
                if ($result == '' || $result == null) {
                    $data = rupiah($list->harga_akhir_gb) . ' /Kg';
                } else {
                    $data = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                }
                return $data;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->analisa == NULL) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Verifikasi Data" class="to_show btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-spinner"></i>Verifikasi
                    </a>';
                } else if ($list->analisa == 'verified') {
                    return
                        '<a style="margin:2px;" title="Data Verified" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-check">&nbsp;Verified</i>
                    </a>';
                } else if ($list->analisa == 'revisi') {
                    return
                        '<a style="margin:2px;" title="Data Revisi" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-spinner">&nbsp;Data&nbsp;Revisi</i>
                    </a>';
                }
            })
            ->addColumn('keterangan_analisa', function ($list) {
                if ($list->keterangan_analisa == NULL) {
                    return
                        '-';
                } else if ($list->keterangan_analisa == 'Sesuai') {
                    return
                        '<span style="margin:2px;" class="badge badge-pill badge-success">
                        Approved
                    </span>';
                } else {
                    return
                        '<span style="margin:2px;" class="badge badge-pill badge-danger">
                        Not&nbsp;Approve&nbsp;SPV
                    </span>';
                }
            })
            ->rawColumns(['site', 'kode_po', 'antrian', 'keterangan_analisa', 'nama_vendor', 'tanggal_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
            ->make(true);
    }
    public function data_pembelian_gb_longgrain_index()
    {
        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('data_po.status_bid', 13)
            ->where('lab2_gb.aksi_harga_gb', 'DEAL')
            ->where('penerimaan_po.analisa', NULL)
            ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
            ->orderby('penerimaan_po.id_penerimaan_po', 'desc')
            ->get())
            ->addColumn('site', function ($list) {
                $result = 'NGAWI';
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
            ->addColumn('antrian', function ($list) {
                $result = $list->no_antrian;
                return '<a style="margin:2px;"  title="Informasi" class="btn btn-outline-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
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
            ->addColumn('harga_akhir', function ($list) {
                $result = $list->harga_akhir_permintaan_gb;
                if ($result == '' || $result == null) {
                    $data = rupiah($list->harga_akhir_gb) . ' /Kg';
                } else {
                    $data = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                }
                return $data;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->analisa == NULL) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_verifikasi" title="Verifikasi Data" class="to_show btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-spinner"></i>Verifikasi
                    </a>';
                } else if ($list->analisa == 'verified') {
                    return
                        '<a style="margin:2px;" title="Data Verified" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-check">&nbsp;Verified</i>
                    </a>';
                } else if ($list->analisa == 'revisi') {
                    return
                        '<a style="margin:2px;" title="Data Revisi" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-spinner">&nbsp;Data&nbsp;Revisi</i>
                    </a>';
                }
            })
            ->addColumn('keterangan_analisa', function ($list) {
                if ($list->keterangan_analisa == NULL) {
                    return
                        '-';
                } else if ($list->keterangan_analisa == 'Sesuai') {
                    return
                        '<span style="margin:2px;" class="badge badge-pill badge-success">
                        Approved
                    </span>';
                } else {
                    return
                        '<span style="margin:2px;" class="badge badge-pill badge-danger">
                        Not&nbsp;Approve&nbsp;SPV
                    </span>';
                }
            })
            ->rawColumns(['site', 'kode_po', 'antrian', 'keterangan_analisa', 'nama_vendor', 'tanggal_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
            ->make(true);
    }
    public function data_pembelian_gb_longgrain1_index()
    {
        // $data = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
        //     ->join('users', 'users.id', '=', 'data_po.user_idbid')
        //     ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
        //     ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
        //     ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
        //     ->where('data_po.status_bid', 13)
        //     ->where('penerimaan_po.analisa', NULL)
        //     ->orWhere('penerimaan_po.analisa', 'verified')
        //     ->where('lab2_gb.aksi_harga_gb', 'DEAL')
        //     ->where('bid.name_bid', 'GABAH BASAH PANDAN WANGI')
        //     ->orderby('id_penerimaan_po', 'desc')
        //     ->get();
        // dd($data);
        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
            ->where('data_po.status_bid', '=', 13)
            ->where('lab2_gb.aksi_harga_gb', '=', 'DEAL')
            ->where('penerimaan_po.analisa', 'verified')
            ->orderby('id_penerimaan_po', 'desc')
            ->get())
            ->addColumn('site', function ($list) {
                $result = 'NGAWI';
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
            ->addColumn('antrian', function ($list) {
                $result = $list->no_antrian;
                return '<a style="margin:2px;"  title="Informasi" class="btn btn-outline-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
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
            ->addColumn('harga_akhir', function ($list) {
                $result = $list->harga_akhir_permintaan_gb;
                if ($result == '' || $result == null) {
                    $data = rupiah($list->harga_akhir_gb) . ' /Kg';
                } else {
                    $data = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                }
                return $data;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->analisa == NULL) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_verifikasi" title="Verifikasi Data" class="to_show btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner">&nbsp;Verifikasi</i>
                    </a>';
                } else if ($list->analisa == 'verified') {
                    return
                        '<a style="margin:2px;" title="Data Verified" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-check">&nbsp;Verified</i>
                    </a>';
                } else if ($list->analisa == 'revisi') {
                    return
                        '<a style="margin:2px;" title="Data Revisi" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-spinner">&nbsp;Data&nbsp;Revisi</i>
                    </a>';
                }
            })
            ->addColumn('keterangan_analisa', function ($list) {
                if ($list->keterangan_analisa == NULL) {
                    return
                        '-';
                } else if ($list->keterangan_analisa == 'Sesuai') {
                    return
                        '<span style="margin:2px;" class="badge badge-pill badge-success">
                        Approved
                    </span>';
                } else {
                    return
                        '<span style="margin:2px;" class="badge badge-pill badge-danger">
                        Not&nbsp;Approve&nbsp;SPV
                    </span>';
                }
            })
            ->rawColumns(['site', 'kode_po', 'antrian', 'keterangan_analisa', 'nama_vendor', 'tanggal_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
            ->make(true);
    }
    public function data_pembelian_gb_pandan_wangi_index()
    {
        // $data = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
        //     ->join('users', 'users.id', '=', 'data_po.user_idbid')
        //     ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
        //     ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
        //     ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
        //     ->where('data_po.status_bid', 13)
        //     ->where('penerimaan_po.analisa', NULL)
        //     ->orWhere('penerimaan_po.analisa', 'verified')
        //     ->where('lab2_gb.aksi_harga_gb', 'DEAL')
        //     ->where('bid.name_bid', 'GABAH BASAH PANDAN WANGI')
        //     ->orderby('id_penerimaan_po', 'desc')
        //     ->get();
        // dd($data);
        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
            ->where('data_po.status_bid', '=', 13)
            ->where('lab2_gb.aksi_harga_gb', '=', 'DEAL')
            ->orderby('id_penerimaan_po', 'desc')
            ->get())
            ->addColumn('site', function ($list) {
                $result = 'NGAWI';
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
            ->addColumn('antrian', function ($list) {
                $result = $list->no_antrian;
                return '<a style="margin:2px;"  title="Informasi" class="btn btn-outline-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
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
            ->addColumn('harga_akhir', function ($list) {
                $result = $list->harga_akhir_permintaan_gb;
                if ($result == '' || $result == null) {
                    $data = rupiah($list->harga_akhir_gb) . ' /Kg';
                } else {
                    $data = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                }
                return $data;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->analisa == NULL) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_verifikasi" title="Verifikasi Data" class="to_show btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner">&nbsp;Verifikasi</i>
                    </a>';
                } else if ($list->analisa == 'verified') {
                    return
                        '<a style="margin:2px;" title="Data Verified" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-check">&nbsp;Verified</i>
                    </a>';
                } else if ($list->analisa == 'revisi') {
                    return
                        '<a style="margin:2px;" title="Data Revisi" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-spinner">&nbsp;Data&nbsp;Revisi</i>
                    </a>';
                }
            })
            ->addColumn('keterangan_analisa', function ($list) {
                if ($list->keterangan_analisa == NULL) {
                    return
                        '-';
                } else if ($list->keterangan_analisa == 'Sesuai') {
                    return
                        '<span style="margin:2px;" class="badge badge-pill badge-success">
                        Approved
                    </span>';
                } else {
                    return
                        '<span style="margin:2px;" class="badge badge-pill badge-danger">
                        Not&nbsp;Approve&nbsp;SPV
                    </span>';
                }
            })
            ->rawColumns(['site', 'kode_po', 'antrian', 'keterangan_analisa', 'nama_vendor', 'tanggal_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
            ->make(true);
    }
    public function data_pembelian_gb_ketan_putih_index()
    {
        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('data_po.status_bid', 13)
            ->where('lab2_gb.aksi_harga_gb', 'DEAL')
            ->where('bid.name_bid', 'GABAH BASAH KETAN PUTIH')
            ->orderby('id_penerimaan_po', 'desc')
            ->get())
            ->addColumn('site', function ($list) {
                $result = 'NGAWI';
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
            ->addColumn('antrian', function ($list) {
                $result = $list->no_antrian;
                return '<a style="margin:2px;"  title="Informasi" class="btn btn-outline-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
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
            ->addColumn('harga_akhir', function ($list) {
                $result = $list->harga_akhir_permintaan_gb;
                if ($result == '' || $result == null) {
                    $data = rupiah($list->harga_akhir_gb) . ' /Kg';
                } else {
                    $data = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                }
                return $data;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->analisa == NULL) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_verifikasi" title="Verifikasi Data" class="to_show btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner">&nbsp;Verifikasi</i>
                    </a>';
                } else if ($list->analisa == 'verified') {
                    return
                        '<a style="margin:2px;" title="Data Verified" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-check">&nbsp;Verified</i>
                    </a>';
                } else if ($list->analisa == 'revisi') {
                    return
                        '<a style="margin:2px;" title="Data Revisi" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-spinner">&nbsp;Data&nbsp;Revisi</i>
                    </a>';
                }
            })
            ->addColumn('keterangan_analisa', function ($list) {
                if ($list->keterangan_analisa == NULL) {
                    return
                        '-';
                } else if ($list->keterangan_analisa == 'Sesuai') {
                    return
                        '<span style="margin:2px;" class="badge badge-pill badge-success">
                        Approved
                    </span>';
                } else {
                    return
                        '<span style="margin:2px;" class="badge badge-pill badge-danger">
                        Not&nbsp;Approve&nbsp;SPV
                    </span>';
                }
            })
            ->rawColumns(['site', 'kode_po', 'antrian', 'keterangan_analisa', 'nama_vendor', 'tanggal_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
            ->make(true);
    }
    public function data_pembelian_pk_index()
    {
        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
            ->where('data_po.status_bid', 13)
            ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
            ->where('lab2_pk.aksi_harga_pk', 'DEAL')
            ->where('penerimaan_po.analisa', NULL)
            ->orderby('id_penerimaan_po', 'desc')
            ->get())
            ->addColumn('site', function ($list) {
                $result = 'NGAWI';
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
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('tonase_awal', function ($list) {
                if ($list->tonase_awal == 'NaN') {
                    $result = '0';
                } else {
                    $result = tonase($list->tonase_awal);
                }
                return $result;
            })
            ->addColumn('tonase_akhir', function ($list) {
                if ($list->tonase_akhir == 'NaN') {
                    $result = '0';
                } else {
                    $result = tonase($list->tonase_akhir);
                }
                return $result;
            })
            ->addColumn('hasil_akhir_tonase', function ($list) {
                if ($list->hasil_akhir_tonase == 'NaN') {
                    $result = '0';
                } else {
                    $result = tonase($list->hasil_akhir_tonase);
                }
                return $result;
            })
            ->addColumn('harga_akhir', function ($list) {
                if ($list->harga_bongkaran_pk == 'NaN') {
                    $result = '0';
                } else {
                    $result = rupiah($list->harga_bongkaran_pk) . '/Kg';
                }

                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_penerimaan == 13) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="to_show btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Verifikasi
                        </a>';
                }
            })
            ->rawColumns(['site', 'kode_po', 'nama_vendor', 'tanggal_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
            ->make(true);
    }

    public function getcount_verifikasi()
    {
        $data = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
            ->where('data_po.status_bid', '=', 13)
            ->where('lab2_gb.aksi_harga_gb', '=', 'DEAL')
            ->where('penerimaan_po.analisa', NULL)
            ->orderby('id_penerimaan_po', 'desc')
            ->count();
        return response()->json($data);
    }
    public function getcount_verified()
    {
        $data = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
            ->where('data_po.status_bid', '=', 13)
            ->where('lab2_gb.aksi_harga_gb', '=', 'DEAL')
            ->where('penerimaan_po.analisa', 'verified')
            ->orderby('id_penerimaan_po', 'desc')
            ->count();
        return response()->json($data);
    }
    public function data_pembelian_show($id)
    {
        $data = DB::table('penerimaan_po')->where('id_penerimaan_po', $id)->first();
        return json_encode($data);
    }

    public function data_pembelian_update(Request $request)
    {
        // dd($request->all());
        if ($request->analisa == 'revisi') {
            $data = PenerimaanPO::where('id_penerimaan_po', $request->id_penerimaan_po)->first();
            $data->analisa = 'revisi';
            $data->id_adminanalisa = $request->namaadmin;
            $data->status_analisa = 1;
            $data->status_revisi = NULL;
            $data->keterangan_analisa = $request->keterangan_analisa;
            $data->update();

            $log                               = new LogAktivityAp();
            $log->nama_user                    = Auth::guard('master')->user()->name_master;
            $log->id_objek_aktivitas_ap       = $request->id_penerimaan_po;
            $log->aktivitas_ap                = 'Pengajuan Revisi ke SPV AP dengan Kode PO:' . $data->penerimaan_kode_po . ', Keterangan : ' . $request->keterangan_analisa;
            $log->keterangan_aktivitas         = 'Selesai';
            $log->created_at                   = date('Y-m-d H:i:s');
            $log->save();
        } else if ($request->analisa == 'verified') {
            $data = PenerimaanPO::where('id_penerimaan_po', $request->id_penerimaan_po)->first();
            $data->analisa = 'verified';
            $data->keterangan_analisa = 'Sesuai';
            $data->status_approved_receipt = 0;
            $data->created_at_analisa = date('Y-m-d H:i:s');
            $data->update();
            $log                               = new LogAktivityAp();
            $log->nama_user                    = Auth::guard('master')->user()->name_master;
            $log->id_objek_aktivitas_ap       = $data->id_penerimaan_po;
            $log->aktivitas_ap                = 'PO Verified dengan Kode PO:' . $data->penerimaan_kode_po;
            $log->keterangan_aktivitas         = 'Selesai';
            $log->created_at                   = date('Y-m-d H:i:s');
            $log->save();
        }
        $keteranganrevisi = $request->keterangan_analisa;
        $kodepo = $request->penerimaan_kode_po;
        $namaadmin = $request->namaadmin;
        if ($namaadmin == 1) {
            //tambah notifikasi
            $data   = new Notif();
            $data->judul       = "Ada Data Revisi";
            $data->keterangan  = "Ada Revisi Kode PO " . $kodepo . " : " . $keteranganrevisi;
            $data->status      = 0;
            $data->kategori   = 2;
            $data->save();
        } else if ($namaadmin == 2) {
            $data   = new Notif();
            $data->judul       = "Ada Data Revisi";
            $data->keterangan  = "Ada Revisi Kode PO " . $kodepo . " : " . $keteranganrevisi;
            $data->status      = 0;
            $data->notifbaru   = 0;
            $data->kategori   = 3;
            $data->save();
        } else if ($namaadmin == 3) {
            $data   = new Notif();
            $data->judul       = "Ada Data Revisi";
            $data->keterangan  = "Ada Revisi Kode PO " . $kodepo . " : " . $keteranganrevisi;
            $data->status      = 0;
            $data->notifbaru   = 0;
            $data->kategori   = 4;
            $data->save();
        }
        return response()->json($data);
    }

    public function revisi_data_ap_gb()
    {
        return view('dashboard.admin_master.admin_ap.revisi_data_gb ');
    }

    public function revisi_data_ap_gb_index()
    {
        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('data_po.status_bid', 13)
            ->where('penerimaan_po.analisa', '=', 'revisi')
            ->orWhere('penerimaan_po.status_analisa', '=', '0')
            ->where('lab2_gb.aksi_harga_gb', 'DEAL')
            ->orderby('id_penerimaan_po', 'desc')
            ->get())
            ->addColumn('site', function ($list) {
                $result = 'NGAWI';
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
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('tonase_awal', function ($list) {
                $result = number_format($list->tonase_awal, 0, ',', '.') . 'Kg';
                return $result;
            })
            ->addColumn('tonase_akhir', function ($list) {
                $result = number_format($list->tonase_akhir, 0, ',', '.') . 'Kg';
                return $result;
            })
            ->addColumn('hasil_akhir_tonase', function ($list) {

                $result = number_format($list->hasil_akhir_tonase, 0, ',', '.') . 'Kg';
                return $result;
            })
            ->addColumn('harga_akhir', function ($list) {
                $result = $list->harga_akhir_permintaan_gb;
                if ($result == '' || $result == null) {
                    $data = 'Rp. ' . number_format($list->harga_akhir_gb, 0, ',', '.') . ' /Kg';
                } else {
                    $data = 'Rp. ' . number_format($list->harga_akhir_permintaan_gb, 0, ',', '.') . ' /Kg';
                }
                return $data;
            })
            ->addColumn('nama_admin', function ($list) {
                $result = $list->id_adminanalisa;
                if ($result == 1) {
                    return 'Security';
                } else if ($result == 2) {
                    return 'Admin Timbangan';
                } else if ($result == 3) {
                    return 'Admin QC';
                } else {
                    return 'SPV QC Lab';
                }
            })
            ->addColumn('keterangan_analisa', function ($list) {
                $result = $list->keterangan_analisa;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_analisa == 1) {
                    return
                        '<span style="margin:2px;" title="Ajukan Approve" class="badge badge-pill badge-info">Diajukan&nbsp;Approve</span>';
                } else if ($list->status_analisa == 2) {
                    return
                        '<span style="margin:2px;" title="Data Approved" class="badge badge-pill badge-success">Approved</span>';
                } else if ($list->status_analisa == 0) {
                    return
                        '<span style="margin:2px;" title="Data Approved" class="badge badge-pill badge-danger">Not&nbsp;Approved</span>';
                }
            })
            ->addColumn('pengerjaan', function ($list) {
                if ($list->status_revisi == '1') {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_verifikasi" title="Verifikasi Data" class="to_show btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-check">&nbsp;Sudah&nbsp;Direvisi</i>
                        </a>';
                } else if ($list->status_revisi == '0') {
                    return
                        '<span style="margin:2px;" title="Proses Revisi" class="badge badge-pill badge-primary">Proses&nbsp;Revisi</span>';
                } else {
                    return '-';
                }
            })
            ->rawColumns(['site', 'kode_po', 'nama_admin', 'pengerjaan', 'nama_vendor', 'tanggal_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
            ->make(true);
    }
    public function revisi_data_ap_pk()
    {
        return view('dashboard.admin_master.admin_ap.revisi_data_pk ');
    }
    public function revisi_data_ap_pk_index()
    {
        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
            ->where('data_po.status_bid', 13)
            ->where('penerimaan_po.analisa', '=', 'revisi')
            ->orWhere('penerimaan_po.status_analisa', '=', '0')
            ->where('lab2_pk.aksi_harga_pk', 'DEAL')
            ->orderby('id_penerimaan_po', 'desc')
            ->get())
            ->addColumn('site', function ($list) {
                $result = 'NGAWI';
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
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('tonase_awal', function ($list) {
                $result = number_format($list->tonase_awal, 0, ',', '.') . 'Kg';
                return $result;
            })
            ->addColumn('tonase_akhir', function ($list) {
                $result = number_format($list->tonase_akhir, 0, ',', '.') . 'Kg';
                return $result;
            })
            ->addColumn('hasil_akhir_tonase', function ($list) {

                $result = number_format($list->hasil_akhir_tonase, 0, ',', '.') . 'Kg';
                return $result;
            })
            ->addColumn('harga_akhir', function ($list) {
                $result = $list->harga_akhir_permintaan_pk;
                if ($result == '' || $result == null) {
                    $data = 'Rp. ' . number_format($list->harga_akhir_pk, 0, ',', '.') . ' /Kg';
                } else {
                    $data = 'Rp. ' . number_format($list->harga_akhir_permintaan_pk, 0, ',', '.') . ' /Kg';
                }
                return $data;
            })
            ->addColumn('nama_admin', function ($list) {
                $result = $list->id_adminanalisa;
                if ($result == 1) {
                    return 'Security';
                } else if ($result == 2) {
                    return 'Admin Timbangan';
                } else if ($result == 3) {
                    return 'Admin QC';
                } else {
                    return 'SPV QC Lab';
                }
            })
            ->addColumn('keterangan_analisa', function ($list) {
                $result = $list->keterangan_analisa;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_analisa == 1) {
                    return
                        '<span style="margin:2px;" title="Ajukan Approve" class="badge badge-pill badge-info">Diajukan&nbsp;Approve</span>';
                } else if ($list->status_analisa == 2) {
                    return
                        '<span style="margin:2px;" title="Data Approved" class="badge badge-pill badge-success">Approved</span>';
                } else if ($list->status_analisa == 0) {
                    return
                        '<span style="margin:2px;" title="Data Approved" class="badge badge-pill badge-danger">Not&nbsp;Approved</span>';
                }
            })
            ->addColumn('pengerjaan', function ($list) {
                if ($list->status_revisi == '1') {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal_verifikasi" title="Verifikasi Data" class="to_show btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-check">&nbsp;Sudah&nbsp;Direvisi</i>
                        </a>';
                } else if ($list->status_revisi == '0') {
                    return
                        '<span style="margin:2px;" title="Proses Revisi" class="badge badge-pill badge-primary">Proses&nbsp;Revisi</span>';
                } else {
                    return '-';
                }
            })
            ->rawColumns(['site', 'kode_po', 'nama_admin', 'pengerjaan', 'nama_vendor', 'tanggal_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
            ->make(true);
    }

    public function log_activity_ap()
    {
        return view('dashboard.admin_master.admin_ap.log_activity_ap ');
    }

    public function log_activity_ap_index()
    {
        return Datatables::of(DB::table('log_aktivitas_ap')
            ->orderby('id_aktivitas_ap', 'desc')
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

    // NOTIF AP 

    public function get_notifdatapembelian()
    {
        $data = DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('data_po.status_bid', 13)
            ->where('lab2_gb.aksi_harga_gb', 'DEAL')
            ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
            ->where('penerimaan_po.analisa', '=', NULL)
            ->orderby('penerimaan_po.id_penerimaan_po', 'desc')
            ->count();
        return response()->json($data);
    }
    public function get_notifdatarevisiap()
    {
        $data = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        return response()->json($data);
    }
}
