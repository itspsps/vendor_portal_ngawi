<?php

namespace App\Http\Controllers\AdminAP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\PenerimaanPO;
use App\Models\QcAdmin;
use App\Models\Admin;
use App\Models\GabahIncomingQC;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Notif;
use Carbon\Carbon;
use App\Models\AdminAP;
use App\Models\DataPO;
use App\Models\LogAktivityAp;
use App\Models\NotifAp;
use App\Models\NotifSpvap;
use App\Models\potongPajak;
use App\Models\trackerPO;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminAPController extends Controller
{
    public function account_ap()
    {
        $id = Auth::guard('ap')->user()->id_admins_ap;
        $data = AdminAP::where('id_admins_ap', $id)->first();
        // dd($data);
        return view('dashboard.admin_ap.dt_account', ['data' => $data]);
    }
    public function account_update(Request $request)
    {
        //dd($request->all());
        $data = AdminAP::where('id_admins_ap', $request->id)->first();
        $data->name_ap = $request->name_ap;
        $data->username = $request->username_ap;
        $data->email = $request->email_ap;
        $data->phone_ap = $request->phone_ap;
        $data->password_show = $request->password;
        $data->password = Hash::make($request['password']);
        $data->perusahaan = $request->company_ap;
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
            $data = AdminAP::where('username', $array)->first();
        } else {
            $data = AdminAP::where('email', $array)->first();
        }
        if (Auth::guard('ap')->attempt(array($fieldType => $request->username, 'password' => $request->password))) {
            Alert::success('Berhasil', 'Selamat Datang ' . $data->name_ap);
            return redirect()->route('ap.home')->with('Berhasil', 'Selamat Datang ' . $data->name_ap);
        } else {
            Alert::error('Gagal', 'Masukkan Email Atau Password Dengan Benar');
            return redirect()->route('ap.login')->with('Gagal', 'Masukkan Email Atau Password Dengan Benar');
        }
    }
    public function potong_pajak()
    {
        return view('dashboard.admin_ap.potong_pajak');
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
            $log->nama_user                    = Auth::guard('ap')->user()->name_ap;
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
            $log->nama_user                    = Auth::guard('ap')->user()->name_ap;
            $log->id_objek_aktivitas_ap       = $query->id_potong_pajak;
            $log->aktivitas_ap                = 'Upload Bukti Potong Pajak dengan Judul :' . $request->judul_potong_pajak . ' Bulan : ' . Carbon::now()->startOfMonth();
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
        $log->nama_user                    = Auth::guard('ap')->user()->name_ap;
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
        $log->nama_user                     = Auth::guard('ap')->user()->name_ap;
        $log->id_objek_aktivitas_ap         = $cek->id_potong_pajak;
        $log->aktivitas_ap                  = 'Hapus Bukti Potong Pajak dengan Judul :' . $cek->judul_potong_pajak;
        $log->keterangan_aktivitas          = 'Selesai';
        $log->created_at                    = date('Y-m-d H:i:s');
        $log->save();
        $query = DB::table('potong_pajak')->where('id_potong_pajak', $id)->delete();
    }
    public function potong_pajak_index()
    {
        return Datatables::of(DataPO::join('users', 'users.id', 'data_po.user_idbid')
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
        // dd(DataPO::
        //     ->join('users', 'users.id', 'data_po.user_idbid')
        //     ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', 'data_po.id_data_po')
        //     // ->leftjoin('potong_pajak', 'potong_pajak.potong_pajak_id_user', 'users.id')
        //     ->where('data_po.status_bid', '!=', '5')
        //     ->whereMonth('tanggal_po', Carbon::now()->month)
        //     ->groupBy('data_po.user_idbid')
        //     ->selectRaw('users.id,users.nama_vendor,COUNT(*) AS total_po')
        //     ->get());
        return Datatables::of(DataPO::join('users', 'users.id', 'data_po.user_idbid')
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
    function logout()
    {
        Auth::guard('ap')->logout();
        return redirect('ap/login');
    }

    public function home()
    {
        return view('dashboard.admin_ap.home');
    }

    public function data_pembelian_gb()
    {
        return view('dashboard.admin_ap.data_pembelian_gb');
    }
    public function data_pembelian_pk()
    {
        return view('dashboard.admin_ap.data_pembelian_pk');
    }

    public function data_pembelian_gb_ciherang_index()
    {
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
            ->addColumn('tanggal_receipt', function ($list) {
                if ($list->tanggal_bongkar == NULL) {
                    return '<span class="btn btn-label-primary btn-sm"><b>-</b></span>';
                } else {
                    $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                    return '<span class="btn btn-label-primary btn-sm"><b>' . $result . '</b></span>';
                }
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
                if ($list->tanggal_bongkar == NULL) {
                    $tanggal_bongkar = '-';
                } else {
                    $tanggal_bongkar = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                }
                if ($list->analisa == NULL) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-tgl_po="' . \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y') . '" data-kode_po="' . $list->penerimaan_kode_po . '" data-tgl_receipt="' . $tanggal_bongkar . '" data-toggle="modal" data-target="#modal2" title="Verifikasi Data" class="to_show btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
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
            ->rawColumns(['site', 'kode_po', 'antrian', 'tanggal_receipt', 'keterangan_analisa', 'nama_vendor', 'tanggal_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
            ->make(true);
    }
    public function data_pembelian_gb_longgrain_index()
    {
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                return '<span class="btn btn-label-primary btn-sm"><b>' . $result . '</b></span>';
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
            ->addColumn('tanggal_receipt', function ($list) {
                if ($list->tanggal_bongkar == NULL) {
                    return '<span class="btn btn-label-primary btn-sm"><b>-</b></span>';
                } else {
                    $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                    return '<span class="btn btn-label-primary btn-sm"><b>' . $result . '</b></span>';
                }
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
                if ($list->tanggal_bongkar == NULL) {
                    $tanggal_bongkar = '-';
                } else {
                    $tanggal_bongkar = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                }
                if ($list->analisa == NULL) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-tgl_po="' . \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y') . '" data-kode_po="' . $list->penerimaan_kode_po . '" data-tgl_receipt="' . $tanggal_bongkar . '" data-toggle="modal" data-target="#modal_verifikasi" title="Verifikasi Data" class="to_show btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
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
            ->rawColumns(['site', 'kode_po', 'tanggal_receipt', 'antrian', 'keterangan_analisa', 'nama_vendor', 'tanggal_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
            ->make(true);
    }
    public function data_pembelian_gb_longgrain1_index()
    {
        // $data = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                return '<span class="btn btn-label-primary btn-sm"><b>' . $result . '</b></span>';
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
            ->addColumn('tanggal_receipt', function ($list) {
                if ($list->tanggal_bongkar == NULL) {
                    return '<span class="btn btn-label-primary btn-sm"><b>-</b></span>';
                } else {
                    $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                    return '<span class="btn btn-label-primary btn-sm"><b>' . $result . '</b></span>';
                }
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
                if ($list->tanggal_bongkar == NULL) {
                    $tanggal_bongkar = '-';
                } else {
                    $tanggal_bongkar = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                }
                if ($list->analisa == NULL) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-tgl_po="' . \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y') . '" data-kode_po="' . $list->penerimaan_kode_po . '" data-tgl_receipt="' . $tanggal_bongkar . '" data-toggle="modal" data-target="#modal_verifikasi" title="Verifikasi Data" class="to_show btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-spinner">&nbsp;Verifikasi</i>
                    </a>';
                } else if ($list->analisa == 'verified') {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-tgl_po="' . \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y') . '" data-kode_po="' . $list->penerimaan_kode_po . '" data-tgl_receipt="' . $tanggal_bongkar . '"  title="Data Verified" data-toggle="modal" data-target="#modal_verifikasi" class="to_show btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
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
            ->rawColumns(['site', 'kode_po', 'antrian', 'tanggal_receipt', 'keterangan_analisa', 'nama_vendor', 'tanggal_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
            ->make(true);
    }
    public function getcount_verifikasi()
    {
        $data_verifikasi = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        $data_verified = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        return json_encode(['data_verifikasi' => $data_verifikasi, 'data_verified' => $data_verified]);
    }

    public function data_pembelian_gb_ketan_putih_index()
    {
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                return '<span class="btn btn-label-primary btn-sm"><b>' . $result . '</b></span>';
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
            ->addColumn('tanggal_receipt', function ($list) {
                if ($list->tanggal_bongkar == NULL) {
                    return '<span class="btn btn-label-primary btn-sm"><b>-</b></span>';
                } else {
                    $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                    return '<span class="btn btn-label-primary btn-sm"><b>' . $result . '</b></span>';
                }
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
                if ($list->tanggal_bongkar == NULL) {
                    $tanggal_bongkar = '-';
                } else {
                    $tanggal_bongkar = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                }
                if ($list->analisa == NULL) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-tgl_po="' . \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y') . '" data-kode_po="' . $list->penerimaan_kode_po . '" data-tgl_receipt="' . $tanggal_bongkar . '" data-toggle="modal" data-target="#modal_verifikasi" title="Verifikasi Data" class="to_show btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
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
            ->rawColumns(['site', 'kode_po', 'tanggal_receipt', 'antrian', 'keterangan_analisa', 'nama_vendor', 'tanggal_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
            ->make(true);
    }
    public function data_pembelian_pk_index()
    {
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                if ($list->tanggal_bongkar == NULL) {
                    $tanggal_bongkar = '-';
                } else {
                    $tanggal_bongkar = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                }
                if ($list->status_penerimaan == 13) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-tgl_po="' . \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y') . '" data-kode_po="' . $list->penerimaan_kode_po . '" data-tgl_receipt="' . $tanggal_bongkar . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="to_show btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Verifikasi
                        </a>';
                }
            })
            ->rawColumns(['site', 'kode_po', 'nama_vendor', 'tanggal_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
            ->make(true);
    }

    public function data_pembelian_show($id)
    {
        $data = PenerimaanPO::join('data_po', 'data_po.id_data_po', 'penerimaan_po.penerimaan_id_data_po')
            ->where('penerimaan_po.id_penerimaan_po', $id)
            ->select('penerimaan_po.*', 'data_po.tanggal_po')
            ->first();
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
            $log->nama_user                    = Auth::guard('ap')->user()->name_ap;
            $log->id_objek_aktivitas_ap       = $request->id_penerimaan_po;
            $log->aktivitas_ap                = 'Pengajuan Revisi ke SPV AP dengan Kode PO:' . $data->penerimaan_kode_po . ', Keterangan : ' . $request->keterangan_analisa;
            $log->keterangan_aktivitas         = 'Selesai';
            $log->created_at                   = date('Y-m-d H:i:s');
            $log->save();

            $po = trackerPO::where('kode_po_tracker', $data->penerimaan_kode_po)->first();
            if ($po == NULL) {
            } else {
                $po->nama_admin_tracker  = Auth::guard('ap')->user()->name_ap;
                $po->pengajuan_revisi_ap_tracker  = date('Y-m-d H:i:s');
                $po->verifikasi_ap_tracker  = NULL;
                $po->approve_revisi_spvap_tracker  = NULL;
                $po->approve_tolak_revisi_spvap_tracker  = NULL;
                $po->revisi_po_tracker  = NULL;
                $po->tolak_approve_spvap_tracker  = NULL;
                $po->proses_tracker  = 'PENGAJUAN REVISI PO';
                $po->update();
            }

            //tambah notifikasi
            $notif                  = new NotifSpvap();
            $notif->judul           = "Ada PO Revisi";
            $notif->keterangan      = "Ada PO Pengajuan Revisi, Kode PO : " . $data->penerimaan_kode_po;
            $notif->status          = 0;
            $notif->id_objek        = $request->id_penerimaan_po;
            $notif->notifbaru       = 0;
            $notif->kategori        = 0;
            $notif->created_at      = date('Y-m-d H:i:s');
            $notif->save();
        } else if ($request->analisa == 'verified') {
            $data = PenerimaanPO::where('id_penerimaan_po', $request->id_penerimaan_po)->first();
            $data->analisa = 'verified';
            $data->keterangan_analisa = 'Sesuai';
            $data->status_approved_receipt = 0;
            $data->created_at_analisa = date('Y-m-d H:i:s');
            $data->update();
            $log                               = new LogAktivityAp();
            $log->nama_user                    = Auth::guard('ap')->user()->name_ap;
            $log->id_objek_aktivitas_ap       = $data->id_penerimaan_po;
            $log->aktivitas_ap                = 'PO Verified dengan Kode PO:' . $data->penerimaan_kode_po;
            $log->keterangan_aktivitas         = 'Selesai';
            $log->created_at                   = date('Y-m-d H:i:s');
            $log->save();

            $po = trackerPO::where('kode_po_tracker', $data->penerimaan_kode_po)->first();
            if ($po == NULL) {
            } else {
                $po->nama_admin_tracker  = Auth::guard('ap')->user()->name_ap;
                $po->verifikasi_ap_tracker  = date('Y-m-d H:i:s');
                $po->proses_tracker  = 'VERIFIKASI PO';
                $po->approve_revisi_spvap_tracker  = NULL;
                $po->pengajuan_revisi_ap_tracker  = NULL;
                $po->approve_tolak_revisi_spvap_tracker  = NULL;
                $po->revisi_po_tracker  = NULL;
                $po->tolak_approve_spvap_tracker  = NULL;
                $po->update();
            }
            //tambah notifikasi
            $notif                  = new NotifSpvap();
            $notif->judul           = "Ada PO Verified";
            $notif->keterangan      = "Ada PO Sudah Verified, Kode PO : " . $data->penerimaan_kode_po;
            $notif->status          = 0;
            $notif->id_objek        = $request->id_penerimaan_po;
            $notif->notifbaru       = 0;
            $notif->kategori        = 1;
            $notif->created_at      = date('Y-m-d H:i:s');
            $notif->save();
        }

        return response()->json($data);
    }

    public function revisi_data_gb()
    {
        return view('dashboard.admin_ap.revisi_data_gb ');
    }

    public function revisi_data_gb_index()
    {
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-tgl_po="' . \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y') . '" data-kode_po="' . $list->penerimaan_kode_po . '" data-tgl_receipt="' . \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y') . '" data-toggle="modal" data-target="#modal_verifikasi" title="Verifikasi Data" class="to_show btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
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
    public function revisi_data_pk()
    {
        return view('dashboard.admin_ap.revisi_data_pk ');
    }

    public function revisi_data_pk_index()
    {
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
            ->where('data_po.status_bid', 13)
            ->where('penerimaan_po.analisa', '=', 'revisi')
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
                $result = $list->tonase_awal . 'Kg';
                return $result;
            })
            ->addColumn('tonase_akhir', function ($list) {
                $result = $list->tonase_akhir . 'Kg';
                return $result;
            })
            ->addColumn('hasil_akhir_tonase', function ($list) {
                $result = $list->hasil_akhir_tonase . 'Kg';
                return $result;
            })
            ->addColumn('harga_akhir', function ($list) {
                $result = 'Rp' . $list->harga_akhir_pk . '/Kg';
                return $result;
            })
            ->addColumn('keterangan_analisa', function ($list) {
                $result = $list->keterangan_analisa;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_analisa == 1) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-tgl_po="' . \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y') . '" data-kode_po="' . $list->penerimaan_kode_po . '" data-tgl_receipt="' . \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y') . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="to_show btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Sudah&nbsp;Direvisi
                        </a>';
                } else {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-tgl_po="' . \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y') . '" data-kode_po="' . $list->penerimaan_kode_po . '" data-tgl_receipt="' . \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y') . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="to_show btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Proses&nbsp;Revisi
                        </a>';
                }
            })
            ->rawColumns(['site', 'kode_po', 'nama_vendor', 'tanggal_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
            ->make(true);
    }

    public function integrasi_epicor_gb()
    {
        return view('dashboard.admin_ap.integrasi_epicor_gb ');
    }

    public function integrasi_epicor_gb_index()
    {
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('data_po.status_bid', 13)
            ->where('penerimaan_po.analisa', '=', 'verified')
            ->orWhere('penerimaan_po.status_epicor', '=', null)
            ->where('penerimaan_po.status_epicor', '1')
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
                $result = $list->tonase_awal . 'Kg';
                return $result;
            })
            ->addColumn('tonase_akhir', function ($list) {
                $result = $list->tonase_akhir . 'Kg';
                return $result;
            })
            ->addColumn('hasil_akhir_tonase', function ($list) {
                $result = $list->hasil_akhir_tonase . 'Kg';
                return $result;
            })
            ->addColumn('harga_akhir', function ($list) {
                $result = 'Rp' . $list->harga_akhir_gb . '/Kg';
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_epicor == 1) {
                    return
                        '<a style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Terima Data" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Diterima Epicor
                        </a>';
                } else if ($list->status_epicor == null || $list->status_epicor == '') {
                    return
                        '<a id="btn_kirimepicor_gb" style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Kirim Data" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Kirim Epicor
                        </a>';
                }
            })
            ->rawColumns(['site', 'kode_po', 'nama_vendor', 'tanggal_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
            ->make(true);
    }
    public function integrasi_epicor_pk()
    {
        return view('dashboard.admin_ap.integrasi_epicor_pk ');
    }

    public function integrasi_epicor_pk_index()
    {
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
            ->where('data_po.status_bid', 13)
            ->where('penerimaan_po.analisa', '=', 'verified')
            ->where('penerimaan_po.analisa', '=', 'verified')
            ->orWhere('penerimaan_po.status_epicor', '=', null)
            ->where('penerimaan_po.status_epicor', '1')
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
                $result = $list->tonase_awal . 'Kg';
                return $result;
            })
            ->addColumn('tonase_akhir', function ($list) {
                $result = $list->tonase_akhir . 'Kg';
                return $result;
            })
            ->addColumn('hasil_akhir_tonase', function ($list) {
                $result = $list->hasil_akhir_tonase . 'Kg';
                return $result;
            })
            ->addColumn('harga_akhir', function ($list) {
                $result = 'Rp' . $list->harga_akhir_pk . '/Kg';
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_penerimaan == 13) {
                    return
                        '<a id="btn_kirimepicor_pk" style="margin:2px;" name="' . $list->id_penerimaan_po . '"  title="Kirim Data" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Kirim Epicor
                        </a>';
                } else {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-tgl_po="' . \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y') . '" data-kode_po="' . $list->penerimaan_kode_po . '" data-tgl_receipt="' . \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y') . '" title="Terima Data" class="to_show btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Diterima Epicor
                        </a>';
                }
            })
            ->rawColumns(['site', 'kode_po', 'nama_vendor', 'tanggal_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
            ->make(true);
    }
    public function Kirim_epicor_gb($id)
    {
        $get_id = PenerimaanPO::join('data_po', 'data_po.id_data_po', 'penerimaan_po.penerimaan_id_data_po')
            ->where('penerimaan_po.id_penerimaan_po', $id)
            ->first();
        // dd($get_id);
        //  Integrasi Epicor
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/PO/ApprovalPO?PONum=' . $get_id->PONum;
        $response = $client->get($url);
        $response = $response->getBody()->getContents();
        // dd($response); 
        $update_status_penerimaan_po = PenerimaanPO::where('id_penerimaan_po', $id)
            ->update(['status_epicor' => '1']);
    }
    public function Kirim_epicor_pk($id)
    {
        $get_id = PenerimaanPO::join('data_po', 'data_po.id_data_po', 'penerimaan_po.penerimaan_id_data_po')
            ->where('penerimaan_po.id_penerimaan_po', $id)
            ->first();
        // dd($get_id);
        //  Integrasi Epicor
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/PO/ApprovalPO?PONum=' . $get_id->PONum;
        $response = $client->get($url);
        $response = $response->getBody()->getContents();
        // dd($response); 
        $update_status_penerimaan_po = PenerimaanPO::where('id_penerimaan_po', $id)
            ->update(['status_epicor' => '1']);
    }
    public function get_notifikasiap()
    {
        $data = NotifAp::where('status', 0)->orderBy('id_notif', 'DESC')->limit(10)->get();
        return json_encode($data);
    }
    public function get_notif_ap_all()
    {
        return view('dashboard.admin_ap.notifikasi.notifikasi');
    }
    public function get_notif_ap_all_index()
    {
        return Datatables::of(NotifAp::where('status', 0)->orderBy('id_notif', 'DESC')->get())
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
    public function get_countnotifikasiap()
    {
        $data = NotifAp::where('status', 0)->count();
        return json_encode($data);
    }

    public function set_notifikasiap(request $request)
    {
        $id = $request->id;
        $data           = NotifAp::where('id_notif', $id)->first();
        $data->status   = '1';
        $data->update();
        if ($data->kategori == 0) {
            return redirect()->route('ap.data_pembelian_gb');
        } else {
        }
    }

    public function new_notifikasiap()
    {
        $data = NotifAp::where('notifbaru', 0)->get();
        if ($data == '' || $data == NULL) {
            return 'kosong';
        } else {

            $title = $data->judul;
            $keterangan = $data->keterangan;
            NotifAp::where('notifbaru', 0)->update(['notifbaru' => 1]);
            $result = ['data' => $data, 'title' => $title, 'keterangan' => $keterangan];
            return response()->json($result);
        }
    }
}
