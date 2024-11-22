<?php

namespace App\Http\Controllers\AdminSpvAp;

use App\Exports\DataFakturPembelianAOL;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\PenerimaanPO;
use App\Models\QcAdmin;
use App\Models\Admin;
use App\Models\GabahIncomingQC;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\DataPO;
use App\Models\Notif;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use App\Models\AdminAP;
use App\Models\AdminSpvAp;
use App\Models\LogAktivitySpvAp;
use App\Models\NotifSpvap;
use App\Models\trackerPO;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class AdminSpvApController extends Controller
{
    public function account_spvap()
    {
        $id = Auth::guard('spvap')->user()->id_spv_ap;
        $data = AdminSpvAp::where('id_spv_ap', $id)->first();
        // dd($data);
        return view('dashboard.admin_spvap.dt_account', ['data' => $data]);
    }
    public function account_update(Request $request)
    {
        //dd($request->all());
        $data = AdminSpvAp::where('id_spv_ap', $request->id)->first();
        $data->name_spv_ap = $request->name_spv_ap;
        $data->username = $request->username_spv_ap;
        $data->email = $request->email_spv_ap;
        $data->phone_spv_ap = $request->phone_spv_ap;
        $data->password_show = $request->password;
        $data->password = Hash::make($request['password']);
        $data->perusahaan = $request->company_spv_ap;
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
            $data = AdminSpvAp::where('username', $array)->first();
        } else {
            $data = AdminSpvAp::where('email', $array)->first();
        }
        if (Auth::guard('spvap')->attempt(array($fieldType => $request->username, 'password' => $request->password))) {
            // return 'aa';
            // return view('dashboard.admin_spvap.home');
            Alert::success('Berhasil', 'Selamat Datang ' . $data->name_spv_ap);
            return redirect()->route('ap.spv.home')->with('Berhasil', 'Selamat Datang ' . $data->name_spv_ap);
        } else {
            // return 'bb';
            Alert::error('Gagal', 'Masukkan Username Atau Password Dengan Benar');
            return redirect()->route('ap.spv.login')->with('Gagal', 'Masukkan Username Atau Password Dengan Benar');
        }
    }
    function home()
    {
        // $date= date('Y-m-d 12:00:00');
        $po_approve_receipt = DataPO::join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', 'data_po.id_data_po')
            ->where('penerimaan_po.status_penerimaan', 13)
            ->where('penerimaan_po.analisa', '=', 'verified')
            ->where('penerimaan_po.status_epicor', NULL)
            ->where('penerimaan_po.status_approved_receipt', '=', '0')
            ->count();
        $po_approve_revisi = DataPO::join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', 'data_po.id_data_po')
            ->where('penerimaan_po.status_penerimaan', 13)
            ->where('penerimaan_po.analisa', '=', 'revisi')
            ->where('penerimaan_po.status_analisa', '1')
            ->where('penerimaan_po.status_approved_receipt', '=', NULL)
            ->count();
        $po_send_epicor = DataPO::join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', 'data_po.id_data_po')
            ->where('penerimaan_po.status_penerimaan', 13)
            ->where('penerimaan_po.analisa', '=', 'verified')
            ->where('penerimaan_po.status_epicor', '=', NULL)
            ->where('penerimaan_po.status_approved_receipt', '=', '1')
            ->count();
        $po_success_epicor = DataPO::join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', 'data_po.id_data_po')
            ->where('penerimaan_po.status_penerimaan', 13)
            ->where('penerimaan_po.analisa', '=', 'verified')
            ->where('penerimaan_po.status_epicor', '=', '1')
            ->where('penerimaan_po.status_approved_receipt', '=', '1')
            ->count();

        // dd($po_approve_receipt);
        return view('dashboard.admin_spvap.home', compact('po_approve_receipt', 'po_approve_revisi', 'po_send_epicor', 'po_success_epicor'));
    }
    public function approve_receipt($id)
    {
        $get = PenerimaanPO::join('data_po', 'data_po.id_data_po', '=', 'penerimaan_po.penerimaan_id_data_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'penerimaan_po.penerimaan_kode_po')
            ->where('penerimaan_po.id_penerimaan_po', $id)->first();
        $get_bin_num = PenerimaanPO::join('lab1_gb', 'lab1_gb.lab1_id_penerimaan_po_gb', 'penerimaan_po.id_penerimaan_po')
            ->where('penerimaan_po.id_penerimaan_po', $id)->first();
        // dd($get_bin_num->lokasi_bongkar_gb);
        if ($get_bin_num->lokasi_bongkar_gb == 'UTARA') {
            $bin_num = 'BNNGWDUA03';
        } else if ($get_bin_num->lokasi_bongkar_gb == 'SELATAN') {
            $bin_num = 'BNNGWDUA02';
        }
        if ($get->harga_akhir_permintaan_gb == 'NULL' || $get->harga_akhir_permintaan_gb == '') {
            $get_harga = $get->harga_akhir_gb;
        } else {
            $get_harga = $get->harga_akhir_permintaan_gb;
        }
        //  Integrasi Epicor
        // dd($get);
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/PO/UpdatePO';
        $form_params = [
            'PONum'         => $get->PONum,
            'Quantity'      => $get->netto2,
            'UnitPrice'     => $get_harga,
            'nobks_c'       => $get->dtm_gb,
            'codepo_c'      => $get->penerimaan_kode_po,
            'plant'         => 'NGW',
            'WarehouseCode' => 'WHNGWDUA',
            'BinNum' => $bin_num,
            'SPS_Nopol_c' => $get->plat_kendaraan,
            'PTI_PONum_c' => $get->penerimaan_kode_po
        ];
        $response = $client->post($url, ['form_params' => $form_params]);
        $response = $response->getBody()->getContents();
        // dd($response);   
        $data = PenerimaanPO::where('id_penerimaan_po', $id)->first();
        $data->created_at_approved_receipt = date('Y-m-d H:i:s');
        $data->status_approved_receipt = '1';
        $data->update();

        $log                               = new LogAktivitySpvAp();
        $log->nama_user                    = Auth::guard('spvap')->user()->name_spv_ap;
        $log->id_objek_aktivitas_spvap       = $id;
        $log->aktivitas_spvap                = 'Approved Receipt dengan Kode PO:' . $data->penerimaan_kode_po;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();

        $po = trackerPO::where('kode_po_tracker', $data->penerimaan_kode_po)->first();
        $po->nama_admin_tracker  = Auth::guard('spvap')->user()->name_spv_ap;
        $po->approve_spvap_tracker  = date('Y-m-d H:i:s');
        $po->po_num_tracker  = $get->PONum;
        $po->tolak_approve_spvap_tracker  = NULL;
        $po->approve_revisi_spvap_tracker  = NULL;
        $po->approve_tolak_revisi_spvap_tracker  = NULL;
        $po->revisi_po_tracker  = NULL;
        $po->pengajuan_revisi_ap_tracker  = NULL;
        $po->proses_tracker  = 'APPROVE RECEIPT SPV AP';
        $po->update();
    }
    public function approve_receipt_pk($id)
    {
        $data = PenerimaanPO::join('data_po', 'data_po.id_data_po', '=', 'penerimaan_po.penerimaan_id_data_po')
            ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'penerimaan_po.penerimaan_kode_po')
            ->where('penerimaan_po.id_penerimaan_po', $id)->first();
        $get_bin_num = PenerimaanPO::join('lab1_pk', 'lab1_pk.lab1_id_penerimaan_po_pk', 'penerimaan_po.id_penerimaan_po')
            ->where('penerimaan_po.id_penerimaan_po', $id)->first();
        // dd($get_bin_num->lokasi_bongkar_gb);

        //  Integrasi Epicor
        // dd($data);
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/PO/UpdatePO';
        $form_params = [
            'PONum'         => $data->PONum,
            'Quantity'      => $data->netto2,
            'UnitPrice'     => $data->harga_bongkaran_pk,
            'nobks_c'       => $data->no_dtm_pk,
            'codepo_c'      => $data->penerimaan_kode_po,
            'plant'         => 'NGW',
            'WarehouseCode' => 'WHDRNGW',
            // 'BinNum' => $bin_num,
            'SPS_Nopol_c' => $data->plat_kendaraan,
            'PTI_PONum_c' => $data->penerimaan_kode_po,
            'SPS_PODate_c'   => $data->tanggal_po,
        ];
        $response = $client->post($url, ['form_params' => $form_params]);
        $response = $response->getBody()->getContents();
        // dd($response);   
        $query = PenerimaanPO::where('id_penerimaan_po', $id)->update(['penerimaan_po_num' => $data->PONum, 'created_at_approved_receipt' => date('Y-m-d H:i:s'), 'status_approved_receipt' => 1]);
    }
    public function not_approve_receipt_pk($id)
    {
        $query = PenerimaanPO::where('id_penerimaan_po', $id)
            ->update([
                'analisa' => NULL,
                'status_analisa' => NULL,
                'status_revisi' => NULL,
                'id_adminanalisa' => NULL,
                'keterangan_analisa' => 'Tolak Approve SPV',
                'created_at_approved_receipt' => date('Y-m-d H:i:s')
            ]);
    }
    public function not_approve_receipt($id)
    {
        $data = PenerimaanPO::where('id_penerimaan_po', $id)->first();
        $data->analisa = NULL;
        $data->status_analisa = NULL;
        $data->status_revisi = NULL;
        $data->id_adminanalisa = NULL;
        $data->keterangan_analisa = 'Tolak Approve SPV';
        $data->update();

        $log                               = new LogAktivitySpvAp();
        $log->nama_user                    = Auth::guard('spvap')->user()->name_spv_ap;
        $log->id_objek_aktivitas_spvap     = $id;
        $log->aktivitas_spvap              = 'Tolak Approved Receipt dengan Kode PO:' . $data->penerimaan_kode_po;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();

        $po = trackerPO::where('kode_po_tracker', $data->penerimaan_kode_po)->first();
        $po->nama_admin_tracker  = Auth::guard('spvap')->user()->name_spv_ap;
        $po->tolak_approve_spvap_tracker  = date('Y-m-d H:i:s');
        $po->approve_spvap_tracker  = NULL;
        $po->approve_revisi_spvap_tracker  = NULL;
        $po->approve_tolak_revisi_spvap_tracker  = NULL;
        $po->revisi_po_tracker  = NULL;
        $po->pengajuan_revisi_ap_tracker  = NULL;
        $po->proses_tracker  = 'TOLAK APPROVE RECEIPT SPV AP';
        $po->update();
    }
    function logout()
    {
        Auth::guard('spvap')->logout();
        return redirect()->route('ap.spv.login');
    }

    public function data_pembelian_gb()
    {
        return view('dashboard.admin_ap.data_pembelian_gb');
    }
    public function data_pembelian_pk()
    {
        return view('dashboard.admin_ap.data_pembelian_pk');
    }

    public function data_pembelian_gb_index()
    {
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('data_po.status_bid', 13)
            ->where('bid.name_bid', 'like', '%GABAH BASAH%')
            ->where('penerimaan_po.analisa', NULL)
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
                $result = $list->harga_akhir_permintaan_gb;
                if ($result == '' || $result == null) {
                    $data = 'Rp' . $list->harga_akhir_gb . '/Kg';
                } else {
                    $data = 'Rp' . $list->harga_akhir_permintaan_gb . '/Kg';
                }
                return $data;
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
    public function data_pembelian_pk_index()
    {
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
            ->where('data_po.status_bid', 13)
            ->where('bid.name_bid', 'like', '%BERAS PECAH KULIT%')
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
                $result = $list->harga_akhir_permintaan_pk;
                if ($result == '' || $result == null) {
                    $data = 'Rp' . $list->harga_akhir_pk . '/Kg';
                } else {
                    $data = 'Rp' . $list->harga_akhir_permintaan_pk . '/Kg';
                }
                return $data;
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

    public function data_pembelian_show($id)
    {
        $data = PenerimaanPO::where('id_penerimaan_po', $id)->first();
        return json_encode($data);
    }

    public function data_pembelian_update(Request $request)
    {
        if ($request->analisa == 'revisi') {
            $data = PenerimaanPO::where('id_penerimaan_po', $request->id_penerimaan_po)
                ->update([
                    'analisa' => $request->analisa,
                    'id_adminanalisa' => $request->namaadmin,
                    'status_analisa' => 0,
                    'keterangan_analisa' => $request->keterangan_analisa,

                ]);
        } else if ($request->analisa == 'verified') {
            $data = PenerimaanPO::where('id_penerimaan_po', $request->id_penerimaan_po)
                ->update([
                    'analisa' => $request->analisa,
                    'keterangan_analisa' => 'Sesuai',

                ]);
        }
        $keteranganrevisi = $request->keterangan_analisa;
        $kodepo = $request->penerimaan_kode_po;
        $namaadmin = $request->namaadmin;
        if ($namaadmin == 1) {
            //tambah notifikasi
            $notif   = new Notif();
            $notif->judul       = "Ada Data Revisi";
            $notif->keterangan  = "Ada Revisi Kode PO " . $kodepo . " : " . $keteranganrevisi;
            $notif->status      = 0;
            $notif->notifbaru   = 0;
            $notif->kategori   = 2;
            $notif->save();
        } else if ($namaadmin == 2) {
            $notif   = new Notif();
            $notif->judul       = "Ada Data Revisi";
            $notif->keterangan  = "Ada Revisi Kode PO " . $kodepo . " : " . $keteranganrevisi;
            $notif->status      = 0;
            $notif->notifbaru   = 0;
            $notif->kategori   = 3;
            $notif->save();
        }
        return redirect()->back();
    }

    public function revisi_data_gb()
    {
        return view('dashboard.admin_spvap.revisi_data_gb ');
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
                $result = tonase($list->tonase_awal);
                return $result;
            })
            ->addColumn('tonase_akhir', function ($list) {
                $result =  tonase($list->tonase_akhir);
                return $result;
            })
            ->addColumn('hasil_akhir_tonase', function ($list) {
                $result =  tonase($list->hasil_akhir_tonase);
                return $result;
            })
            ->addColumn('harga_akhir', function ($list) {
                $result = $list->harga_akhir_permintaan_gb;
                if ($result == '' || $result == null) {
                    $data = rupiah($list->harga_akhir_gb) . ' /Kg';
                } else {
                    $data = 'Rp' . $list->harga_akhir_permintaan_gb . ' /Kg';
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
                    return 'Admin QC Bongkar';
                } else if ($result == 4) {
                    return 'Admin SPV QC ';
                }
            })
            ->addColumn('keterangan_analisa', function ($list) {
                $result = $list->keterangan_analisa;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_analisa == '1') {
                    return
                        '<button style="margin:2px;" id="btn_approverevisi" data-id="' . $list->id_penerimaan_po . '"title="Approve Data Revisi" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner">&nbsp;Approve&nbsp;revisi</i>
                    </button>';
                } else if ($list->status_analisa == '2') {
                    return
                        '<button style="margin:2px;" title="Data Approved" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-check">&nbsp;Data&nbsp;Approved</i>
                    </button>';
                }
            })
            ->addColumn('pengerjaan', function ($list) {
                if ($list->status_revisi == 'NULL') {
                    return '-';
                } else if ($list->status_revisi == '1') {
                    return '<span style="margin:2px;" title="Sudah Revisi" class="badge badge-pill badge-success">Sudah&nbsp;Direvisi</span>';
                } else if ($list->status_revisi == '0') {
                    return
                        '<span style="margin:2px;" title="Proses Revisi" class="badge badge-pill badge-primary">Proses&nbsp;Revisi</span>';
                }
            })
            ->rawColumns(['site', 'kode_po', 'nama_admin', 'nama_vendor', 'pengerjaan', 'tanggal_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
            ->make(true);
    }
    public function revisi_data_pk()
    {
        return view('dashboard.admin_spvap.revisi_data_pk ');
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
                $result = $list->harga_akhir_permintaan_pk;
                if ($result == '' || $result == null) {
                    $data = 'Rp' . $list->harga_akhir_pk . '/Kg';
                } else {
                    $data = 'Rp' . $list->harga_akhir_permintaan_pk . '/Kg';
                }
                return $data;
            })
            ->addColumn('keterangan_analisa', function ($list) {
                $result = $list->keterangan_analisa;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_analisa == 1) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="to_show btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Sudah&nbsp;Direvisi
                        </a>';
                } else {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="to_show btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Proses&nbsp;Revisi
                        </a>';
                }
            })
            ->rawColumns(['site', 'kode_po', 'nama_vendor', 'tanggal_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
            ->make(true);
    }

    public function integrasi_epicor_gb()
    {
        return view('dashboard.admin_spvap.integrasi_epicor_gb ');
    }

    public function integrasi_epicor_gb_index(Request $request)
    {

        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('penerimaan_po.status_penerimaan', 13)
                    ->where('penerimaan_po.analisa', '=', 'verified')
                    ->where('penerimaan_po.status_epicor', NULL)
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->orderBy('lab2_gb.id_lab2_gb', 'DESC')
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
                        if ($result == '' || $result == NULL) {
                            $result = rupiah($list->harga_akhir_gb) . ' /Kg';
                        } else {
                            $result = 'Rp' . $list->harga_akhir_permintaan_gb . ' /Kg';
                        }
                        return $result;
                    })
                    ->addColumn('approved', function ($list) {
                        if ($list->status_approved_receipt == 1) {
                            return
                                '<a style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Approved Data" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check">Approved&nbsp;Data</i>
                    </a>';
                        } else {
                            return
                                '<a id="btn_approve_gb" style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Ajukan Data" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner" >Approve&nbsp;Data</i>
                    </a>';
                        }
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_epicor == 1) {
                            return
                                '<a style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Terima Data" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Diterima Epicor
                            </a>';
                        } else if ($list->status_epicor == null || $list->status_epicor == '') {
                            if ($list->status_approved_receipt == 1) {
                                return
                                    '<a id="btn_kirimepicor_gb" style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Kirim Data" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Kirim Epicor
                        </a>';
                            } else {
                                return
                                    '<a id="btn_information" style="margin:2px;"  title="Information" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Kirim Epicor
                </a>';
                            }
                        }
                    })
                    ->addColumn('selected', function ($list) {
                        if ($list->status_epicor == 'NULL' || $list->status_epicor == '') {
                            if ($list->status_approved_receipt == 1) {
                                $result = '<input type="checkbox" class="users_checkbox"  name="users_checkbox[]" data-id="' . $list->PONum . '" value="' . $list->PONum . '">';
                            } else {
                                $result = '<input type="checkbox" class="users_checkbox" disabled=disabled name="users_checkbox[]" data-id="' . $list->PONum . '" value="' . $list->PONum . '">';
                            }
                        } else if ($list->status_epicor == '1') {
                            $result = '<input type="checkbox" class="users_checkbox" disabled=disabled name="users_checkbox[]" data-id="' . $list->id_penerimaan_po . '"value="' . $list->id_penerimaan_po . '">';
                        }
                        return $result;
                    })
                    ->rawColumns(['site', 'kode_po', 'approved', 'nama_vendor', 'tanggal_po', 'selected', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
                    ->make(true);
            } else {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('penerimaan_po.status_penerimaan', 13)
                    ->where('penerimaan_po.analisa', '=', 'verified')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->where('penerimaan_po.status_epicor', NULL)
                    ->orderBy('lab2_gb.created_at_gb', 'DESC')
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
                        if ($result == '' || $result == NULL) {
                            $result = rupiah($list->harga_akhir_gb) . '/Kg';
                        } else {
                            $result = 'Rp' . $list->harga_akhir_permintaan_gb . '/Kg';
                        }
                        return $result;
                    })
                    ->addColumn('approved', function ($list) {
                        if ($list->status_approved_receipt == 1) {
                            return
                                '<a style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Approved Data" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check">Approved&nbsp;Data</i>
                    </a>';
                        } else {
                            return
                                '<a id="btn_approve_gb" style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Ajukan Data" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-spinner" >Approve&nbsp;Data</i>
                    </a>';
                        }
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_epicor == 1) {
                            return
                                '<a style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Terima Data" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Diterima Epicor
                            </a>';
                        } else if ($list->status_epicor == null || $list->status_epicor == '') {
                            if ($list->status_approved_receipt == 1) {
                                return
                                    '<a id="btn_kirimepicor_gb" style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Kirim Data" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Kirim Epicor
                        </a>';
                            } else {
                                return
                                    '<a id="btn_information" style="margin:2px;"  title="Information" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Kirim Epicor
                </a>';
                            }
                        }
                    })
                    ->addColumn('selected', function ($list) {
                        if ($list->status_epicor == 'NULL' || $list->status_epicor == '') {
                            if ($list->status_approved_receipt == 1) {
                                $result = '<input type="checkbox" class="users_checkbox"  name="users_checkbox[]" data-id="' . $list->PONum . '" value="' . $list->PONum . '">';
                            } else {
                                $result = '<input type="checkbox" class="users_checkbox" disabled=disabled name="users_checkbox[]" data-id="' . $list->PONum . '" value="' . $list->PONum . '">';
                            }
                        } else if ($list->status_epicor == '1') {
                            $result = '<input type="checkbox" class="users_checkbox" disabled=disabled name="users_checkbox[]" data-id="' . $list->id_penerimaan_po . '"value="' . $list->id_penerimaan_po . '">';
                        }
                        return $result;
                    })
                    ->rawColumns(['site', 'kode_po', 'approved', 'nama_vendor', 'tanggal_po', 'selected', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
                    ->make(true);
            }
        }
    }
    public function integrasi_epicor_gb1_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('penerimaan_po.status_penerimaan', 13)
                    ->where('penerimaan_po.analisa', '=', 'verified')
                    ->where('penerimaan_po.status_epicor', '1')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->orderBy('lab2_gb.id_lab2_gb', 'DESC')
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
                        if ($result == '' || $result == NULL) {
                            $result = rupiah($list->harga_akhir_gb) . '/Kg';
                        } else {
                            $result = 'Rp' . $list->harga_akhir_permintaan_gb . '/Kg';
                        }
                        return $result;
                    })
                    ->addColumn('approved', function ($list) {
                        if ($list->status_approved_receipt == 1) {
                            return
                                '<a style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Approved Data" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check">Approved&nbsp;Data</i>
                    </a>';
                        } else {
                            return
                                '<a id="btn_approve_gb" style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Ajukan Data" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner" >Diajukan&nbsp;Approve</i>
                    </a>';
                        }
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_epicor == 1) {
                            return
                                '<a style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Terima Data" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Diterima Epicor
                            </a>';
                        } else if ($list->status_epicor == null || $list->status_epicor == '') {
                            if ($list->status_approved_receipt == 1) {
                                return
                                    '<a id="btn_kirimepicor_gb" style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Kirim Data" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Kirim Epicor
                        </a>';
                            } else {
                                return
                                    '<a id="btn_information" style="margin:2px;"  title="Information" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Kirim Epicor
                </a>';
                            }
                        }
                    })
                    ->addColumn('selected', function ($list) {
                        if ($list->status_epicor == 'NULL' || $list->status_epicor == '') {
                            $result = '<input type="checkbox" class="users_checkbox"  name="users_checkbox[]" data-id="' . $list->PONum . '" value="' . $list->PONum . '">';
                        } else if ($list->status_epicor == '1') {
                            $result = '<input type="checkbox" class="users_checkbox" disabled=disabled name="users_checkbox[]" data-id="' . $list->id_penerimaan_po . '"value="' . $list->id_penerimaan_po . '">';
                        }
                        return $result;
                    })
                    ->rawColumns(['site', 'kode_po', 'approved', 'nama_vendor', 'tanggal_po', 'selected', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
                    ->make(true);
            } else {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('penerimaan_po.status_penerimaan', 13)
                    ->where('penerimaan_po.analisa', '=', 'verified')
                    ->where('penerimaan_po.status_epicor', '1')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->orderBy('lab2_gb.created_at_gb', 'DESC')
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
                        if ($result == '' || $result == NULL) {
                            $result = rupiah($list->harga_akhir_gb) . '/Kg';
                        } else {
                            $result = 'Rp' . $list->harga_akhir_permintaan_gb . '/Kg';
                        }
                        return $result;
                    })
                    ->addColumn('approved', function ($list) {
                        if ($list->status_approved_receipt == 1) {
                            return
                                '<a style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Approved Data" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check">Approved&nbsp;Data</i>
                    </a>';
                        } else {
                            return
                                '<a id="btn_approve_gb" style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Ajukan Data" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner" >Diajukan&nbsp;Approve</i>
                    </a>';
                        }
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_epicor == 1) {
                            return
                                '<a style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Terima Data" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Diterima Epicor
                            </a>';
                        } else if ($list->status_epicor == null || $list->status_epicor == '') {
                            if ($list->status_approved_receipt == 1) {
                                return
                                    '<a id="btn_kirimepicor_gb" style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Kirim Data" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Kirim Epicor
                        </a>';
                            } else {
                                return
                                    '<a id="btn_information" style="margin:2px;"  title="Information" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Kirim Epicor
                </a>';
                            }
                        }
                    })
                    ->addColumn('selected', function ($list) {
                        if ($list->status_epicor == 'NULL' || $list->status_epicor == '') {
                            $result = '<input type="checkbox" class="users_checkbox"  name="users_checkbox[]" data-id="' . $list->PONum . '" value="' . $list->PONum . '">';
                        } else if ($list->status_epicor == '1') {
                            $result = '<input type="checkbox" class="users_checkbox" disabled=disabled name="users_checkbox[]" data-id="' . $list->id_penerimaan_po . '"value="' . $list->id_penerimaan_po . '">';
                        }
                        return $result;
                    })
                    ->rawColumns(['site', 'kode_po', 'approved', 'nama_vendor', 'tanggal_po', 'selected', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
                    ->make(true);
            }
        }
    }
    public function integrasi_epicor_pk()
    {
        return view('dashboard.admin_spvap.integrasi_epicor_pk ');
    }

    public function integrasi_epicor_pk_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('penerimaan_po.status_penerimaan', 13)
                    ->where('penerimaan_po.analisa', '=', 'verified')
                    ->where('penerimaan_po.status_epicor', NULL)
                    ->where('lab2_pk.aksi_harga_pk', 'DEAL')
                    ->orderBy('lab2_pk.id_lab2_pk', 'DESC')
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
                        $result = rupiah($list->harga_bongkaran_pk);

                        return $result;
                    })
                    ->addColumn('approved', function ($list) {
                        if ($list->status_approved_receipt == 1) {
                            return
                                '<a style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Approved Data" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check">Approved&nbsp;Data</i>
                    </a>';
                        } else {
                            return
                                '<a id="btn_approve_pk" style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Ajukan Data" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner" >Diajukan&nbsp;Approve</i>
                    </a>';
                        }
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_epicor == 1) {
                            return
                                '<a style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Terima Data" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Diterima Epicor
                            </a>';
                        } else if ($list->status_epicor == null || $list->status_epicor == '') {
                            if ($list->status_approved_receipt == 1) {
                                return
                                    '<a id="btn_kirimepicor_gb" style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Kirim Data" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Kirim Epicor
                        </a>';
                            } else {
                                return
                                    '<a id="btn_information" style="margin:2px;"  title="Information" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Kirim Epicor
                </a>';
                            }
                        }
                    })
                    ->addColumn('selected', function ($list) {
                        if ($list->status_epicor == 'NULL' || $list->status_epicor == '') {
                            if ($list->status_approved_receipt == 1) {
                                $result = '<input type="checkbox" class="users_checkbox"  name="users_checkbox[]" data-id="' . $list->PONum . '" value="' . $list->PONum . '">';
                            } else {
                                $result = '<input type="checkbox" class="users_checkbox" disabled=disabled name="users_checkbox[]" data-id="' . $list->PONum . '" value="' . $list->PONum . '">';
                            }
                        } else if ($list->status_epicor == '1') {
                            $result = '<input type="checkbox" class="users_checkbox" disabled=disabled name="users_checkbox[]" data-id="' . $list->id_penerimaan_po . '"value="' . $list->id_penerimaan_po . '">';
                        }
                        return $result;
                    })
                    ->rawColumns(['site', 'kode_po', 'approved', 'nama_vendor', 'tanggal_po', 'selected', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
                    ->make(true);
            } else {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
                    ->where('penerimaan_po.status_penerimaan', 13)
                    ->where('penerimaan_po.analisa', '=', 'verified')
                    ->where('lab2_pk.aksi_harga_pk', 'DEAL')
                    ->where('penerimaan_po.status_epicor', NULL)
                    ->orderBy('lab2_pk.created_at_pk', 'DESC')
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
                        $result = rupiah($list->harga_bongkaran_pk);

                        return $result;
                    })
                    ->addColumn('approved', function ($list) {
                        if ($list->status_approved_receipt == 1) {
                            return
                                '<a style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Approved Data" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check">Approved&nbsp;Data</i>
                    </a>';
                        } else {
                            return
                                '<a id="btn_approve_pk" style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Ajukan Data" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner" >Diajukan&nbsp;Approve</i>
                    </a>';
                        }
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_epicor == 1) {
                            return
                                '<a style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Terima Data" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Diterima Epicor
                            </a>';
                        } else if ($list->status_epicor == null || $list->status_epicor == '') {
                            if ($list->status_approved_receipt == 1) {
                                return
                                    '<a id="btn_kirimepicor_gb" style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Kirim Data" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Kirim Epicor
                        </a>';
                            } else {
                                return
                                    '<a id="btn_information" style="margin:2px;"  title="Information" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Kirim Epicor
                </a>';
                            }
                        }
                    })
                    ->addColumn('selected', function ($list) {
                        if ($list->status_epicor == 'NULL' || $list->status_epicor == '') {
                            if ($list->status_approved_receipt == 1) {
                                $result = '<input type="checkbox" class="users_checkbox"  name="users_checkbox[]" data-id="' . $list->PONum . '" value="' . $list->PONum . '">';
                            } else {
                                $result = '<input type="checkbox" class="users_checkbox" disabled=disabled name="users_checkbox[]" data-id="' . $list->PONum . '" value="' . $list->PONum . '">';
                            }
                        } else if ($list->status_epicor == '1') {
                            $result = '<input type="checkbox" class="users_checkbox" disabled=disabled name="users_checkbox[]" data-id="' . $list->id_penerimaan_po . '"value="' . $list->id_penerimaan_po . '">';
                        }
                        return $result;
                    })
                    ->rawColumns(['site', 'kode_po', 'approved', 'nama_vendor', 'tanggal_po', 'selected', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
                    ->make(true);
            }
        }
    }
    public function integrasi_epicor_pk1_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('penerimaan_po.status_penerimaan', 13)
                    ->where('penerimaan_po.analisa', '=', 'verified')
                    ->where('penerimaan_po.status_epicor', '1')
                    ->where('lab2_pk.aksi_harga_pk', 'DEAL')
                    ->orderBy('lab2_pk.id_lab2_pk', 'DESC')
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
                        $result = rupiah($list->harga_bongkaran_pk);

                        return $result;
                    })
                    ->addColumn('approved', function ($list) {
                        if ($list->status_approved_receipt == 1) {
                            return
                                '<a style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Approved Data" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check">Approved&nbsp;Data</i>
                    </a>';
                        } else {
                            return
                                '<a id="btn_approve_gb" style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Ajukan Data" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner" >Diajukan&nbsp;Approve</i>
                    </a>';
                        }
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_epicor == 1) {
                            return
                                '<a style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Terima Data" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Diterima Epicor
                            </a>';
                        } else if ($list->status_epicor == null || $list->status_epicor == '') {
                            if ($list->status_approved_receipt == 1) {
                                return
                                    '<a id="btn_kirimepicor_gb" style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Kirim Data" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Kirim Epicor
                        </a>';
                            } else {
                                return
                                    '<a id="btn_information" style="margin:2px;"  title="Information" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Kirim Epicor
                </a>';
                            }
                        }
                    })
                    ->addColumn('selected', function ($list) {
                        if ($list->status_epicor == 'NULL' || $list->status_epicor == '') {
                            if ($list->status_approved_receipt == 1) {
                                $result = '<input type="checkbox" class="users_checkbox"  name="users_checkbox[]" data-id="' . $list->PONum . '" value="' . $list->PONum . '">';
                            } else {
                                $result = '<input type="checkbox" class="users_checkbox" disabled=disabled name="users_checkbox[]" data-id="' . $list->PONum . '" value="' . $list->PONum . '">';
                            }
                        } else if ($list->status_epicor == '1') {
                            $result = '<input type="checkbox" class="users_checkbox" disabled=disabled name="users_checkbox[]" data-id="' . $list->id_penerimaan_po . '"value="' . $list->id_penerimaan_po . '">';
                        }
                        return $result;
                    })
                    ->rawColumns(['site', 'kode_po', 'approved', 'nama_vendor', 'tanggal_po', 'selected', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
                    ->make(true);
            } else {
                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                    ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
                    ->where('penerimaan_po.status_penerimaan', 13)
                    ->where('penerimaan_po.analisa', '=', 'verified')
                    ->where('lab2_pk.aksi_harga_pk', 'DEAL')
                    ->where('penerimaan_po.status_epicor', '1')
                    ->orderBy('lab2_pk.created_at_pk', 'DESC')
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
                        $result = rupiah($list->harga_bongkaran_pk);

                        return $result;
                    })
                    ->addColumn('approved', function ($list) {
                        if ($list->status_approved_receipt == 1) {
                            return
                                '<a style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Approved Data" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-check">Approved&nbsp;Data</i>
                    </a>';
                        } else {
                            return
                                '<a id="btn_approve_gb" style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Ajukan Data" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-spinner" >Diajukan&nbsp;Approve</i>
                    </a>';
                        }
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->status_epicor == 1) {
                            return
                                '<a style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Terima Data" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Diterima Epicor
                            </a>';
                        } else if ($list->status_epicor == null || $list->status_epicor == '') {
                            if ($list->status_approved_receipt == 1) {
                                return
                                    '<a id="btn_kirimepicor_gb" style="margin:2px;" data-id="' . $list->id_penerimaan_po . '"  title="Kirim Data" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            Kirim Epicor
                        </a>';
                            } else {
                                return
                                    '<a id="btn_information" style="margin:2px;"  title="Information" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    Kirim Epicor
                </a>';
                            }
                        }
                    })
                    ->addColumn('selected', function ($list) {
                        if ($list->status_epicor == 'NULL' || $list->status_epicor == '') {
                            if ($list->status_approved_receipt == 1) {
                                $result = '<input type="checkbox" class="users_checkbox"  name="users_checkbox[]" data-id="' . $list->PONum . '" value="' . $list->PONum . '">';
                            } else {
                                $result = '<input type="checkbox" class="users_checkbox" disabled=disabled name="users_checkbox[]" data-id="' . $list->PONum . '" value="' . $list->PONum . '">';
                            }
                        } else if ($list->status_epicor == '1') {
                            $result = '<input type="checkbox" class="users_checkbox" disabled=disabled name="users_checkbox[]" data-id="' . $list->id_penerimaan_po . '"value="' . $list->id_penerimaan_po . '">';
                        }
                        return $result;
                    })
                    ->rawColumns(['site', 'kode_po', 'approved', 'nama_vendor', 'tanggal_po', 'selected', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir', 'ckelola'])
                    ->make(true);
            }
        }
    }
    public function kirim_epicor_gb($id)
    {
        $get_id = PenerimaanPO::where('id_penerimaan_po', $id)
            ->first();
        // dd($get_id->PONum);
        //  Integrasi Epicor
        // dd($response); 
        // return json_encode($update_status_penerimaan_po);
        $data = PenerimaanPO::where('id_penerimaan_po', $id)->first();
        $data->status_epicor = '1';
        $data->update();
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/PO/ApprovalPO?PONum=' . $data->penerimaan_po_num;
        $response = $client->get($url);
        $response = $response->getBody()->getContents();

        $log                               = new LogAktivitySpvAp();
        $log->nama_user                    = Auth::guard('spvap')->user()->name_spv_ap;
        $log->id_objek_aktivitas_spvap       = $id;
        $log->aktivitas_spvap                = 'Kirim Epicor Berhasil dengan Kode PO:' . $get_id->penerimaan_kode_po;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();

        $po = trackerPO::where('kode_po_tracker', $get_id->penerimaan_kode_po)->first();
        $po->nama_admin_tracker  = Auth::guard('spvap')->user()->name_spv_ap;
        $po->kirim_epicor_spvap_tracker  = date('Y-m-d H:i:s');
        $po->approve_tolak_revisi_spvap_tracker  = NULL;
        $po->proses_tracker  = 'PO BERHASIL DITERIMA EPICOR';
        $po->update();
    }
    public function kirim_epicor_pk($id)
    {
        $get_id = PenerimaanPO::where('id_penerimaan_po', $id)
            ->first();
        // dd($get_id->PONum);
        //  Integrasi Epicor
        $update_status_penerimaan_po = PenerimaanPO::where('id_penerimaan_po', $id)
            ->update(['status_epicor' => '1']);
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/PO/ApprovalPO?PONum=' . $get_id->penerimaan_po_num;
        $response = $client->get($url);
        $response = $response->getBody()->getContents();
        // dd($response); 
        // return json_encode($update_status_penerimaan_po);
        $log                               = new LogAktivitySpvAp();
        $log->nama_user                    = Auth::guard('spvap')->user()->name_spv_ap;
        $log->id_objek_aktivitas_spvap       = $id;
        $log->aktivitas_spvap                = 'Kirim Epicor Berhasil dengan Kode PO:' . $get_id->penerimaan_kode_po;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();

        $po = trackerPO::where('kode_po_tracker', $get_id->penerimaan_kode_po)->first();
        $po->nama_admin_tracker  = Auth::guard('spvap')->user()->name_spv_ap;
        $po->kirim_epicor_spvap_tracker  = date('Y-m-d H:i:s');
        $po->approve_tolak_revisi_spvap_tracker  = NULL;
        $po->proses_tracker  = 'PO BERHASIL DITERIMA EPICOR';
        $po->update();
    }

    public function approve_revisi($id)
    {
        $data = PenerimaanPO::where('id_penerimaan_po', $id)->first();
        $data->status_analisa = '2';
        $data->status_revisi = '0';
        $data->update();
        // return response()->json(["sukses"]);

        $log                               = new LogAktivitySpvAp();
        $log->nama_user                    = Auth::guard('spvap')->user()->name_spv_ap;
        $log->id_objek_aktivitas_spvap     = $id;
        $log->aktivitas_spvap              = 'Approved Pengajuan Revisi ke SPV AP dengan Kode PO:' . $data->penerimaan_kode_po . ', Keterangan : ' . $data->keterangan_analisa;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();

        $po = trackerPO::where('kode_po_tracker', $data->penerimaan_kode_po)->first();
        $po->nama_admin_tracker  = Auth::guard('spvap')->user()->name_spv_ap;
        $po->approve_revisi_spvap_tracker  = date('Y-m-d H:i:s');
        $po->approve_tolak_revisi_spvap_tracker  = NULL;
        $po->proses_tracker  = 'Approve Revisi PO';
        $po->update();
    }
    public function notapprove_revisi($id)
    {
        $data = PenerimaanPO::where('id_penerimaan_po', $id)->first();
        $data->status_analisa = '0';
        $data->analisa = 'verified';
        $data->keterangan_analisa = 'Sesuai';
        $data->update();

        $log                               = new LogAktivitySpvAp();
        $log->nama_user                    = Auth::guard('spvap')->user()->name_spv_ap;
        $log->id_objek_aktivitas_spvap     = $id;
        $log->aktivitas_spvap              = 'Tolak Pengajuan Revisi ke SPV AP dengan Kode PO:' . $data->penerimaan_kode_po . ', Keterangan : ' . $data->keterangan_analisa;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();

        $po = trackerPO::where('kode_po_tracker', $data->penerimaan_kode_po)->first();
        $po->nama_admin_tracker  = Auth::guard('spvap')->user()->name_spv_ap;
        $po->approve_tolak_revisi_spvap_tracker  = date('Y-m-d H:i:s');
        $po->approve_revisi_spvap_tracker = NULL;
        $po->proses_tracker  = 'Tolak Approve Revisi PO';
        $po->update();
        // return response()->json(["sukses"]);
    }
    public function kirim_postman(Request $request)
    {
        // dd($request->PoNum);
        // return 'okeee';
        $update_status_penerimaan_po = DB::table('cekpostman')->where('PONum', $request->PoNum)
            ->update(['status_epicor' => '1']);
        return response()->json(["sukses"]);
    }
    public function postman()
    {
        $data = DB::table('cekpostman')->get();
        return $data;
        // return response()->json(["sukses"]);
    }
    public function kirim_epicor_gb_all(Request $request)
    {
        $PONum = $request->id_penerimaan_po;
        // dd($PONum);
        // dd($get_id);
        // $get_id = PenerimaanPO::whereIn('id_penerimaan_po', $PONum)
        //     ->join('data_po', 'data_po.id_data_po', 'penerimaan_po.penerimaan_id_data_po')
        //     ->get();
        foreach ($PONum as $get) {
            // dd($get_id->PONum);
            $client = new \GuzzleHttp\Client();

            // dd($response); 
            // Integrasi Epicor
            $promise = $client->getAsync('http://34.34.222.145:2022/api/PO/ApprovalPO?PONum=' . $get);
            $promise->then(
                function (Response $response) use ($get) {
                    echo $response = $response->getBody()->getContents();
                    $penerimaan_po = PenerimaanPO::where('penerimaan_po_num', $get)->first();
                    $penerimaan_po->status_epicor = '1';
                    $penerimaan_po->update();

                    $log                               = new LogAktivitySpvAp();
                    $log->nama_user                    = Auth::guard('spvap')->user()->name_spv_ap;
                    $log->id_objek_aktivitas_spvap     = $get;
                    $log->aktivitas_spvap              = 'Kirim Epicor Berhasil dengan PO NUM:' . $get;
                    $log->keterangan_aktivitas         = 'Selesai';
                    $log->created_at                   = date('Y-m-d H:i:s');
                    $log->save();

                    $po = trackerPO::where('po_num_tracker', $get)->first();
                    $po->nama_admin_tracker  = Auth::guard('spvap')->user()->name_spv_ap;
                    $po->kirim_epicor_spvap_tracker  = date('Y-m-d H:i:s');
                    $po->approve_tolak_revisi_spvap_tracker  = NULL;
                    $po->proses_tracker  = 'PO SELCET ALL BERHASIL DITERIMA EPICOR';
                    $po->update();
                }

            );
            sleep(1);
            $result = $promise->wait();
        }
    }
    public function kirim_epicor_pk_all(Request $request)
    {
        $PONum = $request->id_penerimaan_po;
        // dd($PONum);
        // dd($get_id);
        // $get_id = PenerimaanPO::whereIn('id_penerimaan_po', $PONum)
        //     ->join('data_po', 'data_po.id_data_po', 'penerimaan_po.penerimaan_id_data_po')
        //     ->get();
        foreach ($PONum as $get) {
            // dd($get_id->PONum);
            $client = new \GuzzleHttp\Client();

            // dd($response); 
            // Integrasi Epicor
            $promise = $client->getAsync('http://34.34.222.145:2022/api/PO/ApprovalPO?PONum=' . $get);
            $promise->then(
                function (Response $response) use ($get) {
                    echo $response = $response->getBody()->getContents();
                    $get_id = PenerimaanPO::where('penerimaan_po_num', $get)->update(['status_epicor' => '1']);

                    $log                               = new LogAktivitySpvAp();
                    $log->nama_user                    = Auth::guard('spvap')->user()->name_spv_ap;
                    $log->id_objek_aktivitas_spvap     = $get;
                    $log->aktivitas_spvap              = 'Kirim Epicor Berhasil dengan PO NUM:' . $get;
                    $log->keterangan_aktivitas         = 'Selesai';
                    $log->created_at                   = date('Y-m-d H:i:s');
                    $log->save();

                    $po = trackerPO::where('po_num_tracker', $get)->first();
                    $po->nama_admin_tracker  = Auth::guard('spvap')->user()->name_spv_ap;
                    $po->kirim_epicor_spvap_tracker  = date('Y-m-d H:i:s');
                    $po->approve_tolak_revisi_spvap_tracker  = NULL;
                    $po->proses_tracker  = 'PO BERHASIL DITERIMA EPICOR';
                    $po->update();
                }

            );
            sleep(1);
            $result = $promise->wait();
        }
    }
    public function download_data_faktur_pemebelian_aol(Request $request)
    {
        $from_date  = $request->from_date;
        $to_date  = $request->to_date;
        // dd($from_date . '-' . $to_date);
        return Excel::download(new DataFakturPembelianAOL($from_date, $to_date), 'Data Faktur Pembelian PT. SURYA PANGAN SEMESTA.xlsx');
    }
    public function get_notifikasispvap()
    {
        $data = NotifSpvap::where('status', 0)->get();
        return json_encode($data);
    }
    public function get_countnotifikasispvap()
    {
        $data = NotifSpvap::where('status', 0)->count();
        return json_encode($data);
    }

    public function set_notifikasispvap(request $request)
    {
        $id = $request->id;
        $data           = NotifSpvap::where('id_notif', $id)->first();
        $data->status   = '1';
        $data->update();
        if ($data->kategori == 0) {
            return redirect()->route('ap.spv.revisi_data_gb');
        } elseif ($data->kategori == 1) {
            return redirect()->route('ap.spv.integrasi_epicor_gb');
        }
    }

    public function new_notifikasispvap()
    {
        $data = NotifSpvap::where('notifbaru', 0)->get();
        NotifSpvap::where('notifbaru', 0)->update(['notifbaru' => 1]);
        return json_encode($data);
    }
}
