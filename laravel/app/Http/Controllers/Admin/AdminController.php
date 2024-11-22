<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\PenerimaanPO;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Str;
use App\Models\DataPO;
use App\Models\Lab1GabahBasah;
use App\Models\Lab2GabahBasah;
use App\Models\LogAktivitySecurity;
use App\Models\LogAktivitySourching;
use App\Models\Notif;
use App\Models\NotifLab;
use App\Models\NotifSecurity;
use App\Models\trackerPO;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\DB as FacadesDB;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    function check(Request $request)
    {
        //Validate Inputs

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $array = $request->username;
        // $oke = json_encode($array);
        // dd($array);
        if ($fieldType == "username") {
            $data = Admin::where('username', $array)->first();
        } else {
            $data = Admin::where('email', $array)->first();
        }
        if (Auth::guard('security')->attempt(array($fieldType => $request->username, 'password' => $request->password))) {
            Alert::success('Berhasil', 'Selamat Datang ' . $data->name);
            return redirect()->route('security.home')->with('Berhasil', 'Selamat Datang ' . $data->name);
        } else {
            Alert::error('Gagal', 'Masukkan Email Atau Password Dengan Benar');
            return redirect()->route('security.login')->with('Gagal', 'Masukkan Email Atau Password Dengan Benar');
        }
    }

    function security_logout()
    {
        Auth::guard('security')->logout();
        return redirect()->route('security.login');
    }

    public function gabah_kering()
    {
        $po_kemarin = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 1)
            ->where('bid.name_bid', '=', 'GABAH KERING')
            ->where('bid.open_po', date('Y-m-d', strtotime('-1 days')))
            ->orderBy("id_data_po", "desc")
            ->get();


        return view('dashboard.admin.gabah_kering', ['po_kemarin' => $po_kemarin]);
    }
    public function get_count_notifikasi_security()
    {
        $count_notif_data_revisi = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('penerimaan_po.analisa', 'revisi')
            ->orWhere('penerimaan_po.status_penerimaan', '=', 13)
            ->where('penerimaan_po.id_adminanalisa', 1)
            ->where('penerimaan_po.status_analisa', 2)
            ->where('penerimaan_po.status_revisi', 0)
            ->orderBy('penerimaan_po.id_penerimaan_po', 'DESC')
            ->count();
        $count_notif_po_datang = PenerimaanPO::where('status_penerimaan', '=', 3)->count();
        $count_notif_po_parkir = PenerimaanPO::where('status_penerimaan', '!=', '5')
            ->where('status_penerimaan', '!=', '16')
            ->where('status_penerimaan', '!=', '13')
            ->count();
        $count_notif_po_on_call = PenerimaanPO::where('status_penerimaan', 8)->count();
        $count_notif_po_pending = Lab1GabahBasah::where('output_lab_gb', '=', 'Pending')->where('status_lab1_gb', 16)->count();
        $count_notif_po_bongkar = Lab1GabahBasah::where('output_lab_gb', '=', 'Unload')->where('status_lab1_gb', 8)->count();
        $count_notif_po_ditolak = PenerimaanPO::where('status_penerimaan', 5)->count();
        $result = ['count_notif_data_revisi' => $count_notif_data_revisi, 'count_notif_po_datang' => $count_notif_po_datang, 'count_notif_po_parkir' => $count_notif_po_parkir, 'count_notif_po_on_call' => $count_notif_po_on_call, '' => $count_notif_po_pending, 'count_notif_po_bongkar' => $count_notif_po_bongkar, 'count_notif_po_ditolak' => $count_notif_po_ditolak];
        return response()->json($result);
    }
    public function cetak_po($id)
    {
        $data = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'user_idbid')
            ->where('id_data_po', $id)
            ->first();
        $get_provinsi = DB::table('provinces')
            ->where('id', $data->id_provinsiktp)->first();
        $get_kabupaten = DB::table('regencies')
            ->where('id', $data->id_kabupatenktp)->first();
        $get_kecamatan = DB::table('districts')
            ->where('id', $data->id_kecamatanktp)->first();
        $get_desa = DB::table('villages')
            ->where('id', $data->id_desaktp)->first();
        $get_item = DB::table('item')
            ->where('nama_item', $data->name_bid)->first();
        // dd($get_provinsi);
        if (
            $data->name_bid == 'BERAS PECAH KULIT LONG GRAIN' || $data->name_bid == 'BERAS PECAH KULIT LONG GRAIN 50 KG' || $data->name_bid == 'BERAS PECAH KULIT LONG GRAIN JUMBO BAG' || $data->name_bid == 'BERAS PECAH KULIT PANDAN WANGI' || $data->name_bid == 'BERAS PECAH KULIT PANDAN WANGI 50 KG'
            || $data->name_bid == 'BERAS PECAH KULIT PANDAN WANGI JUMBO BAG' || $data->name_bid == 'BERAS PECAH KULIT PERA' || $data->name_bid == 'BERAS PECAH KULIT PERA 50 KG' || $data->name_bid == 'BERAS PECAH KULIT PERA JUMBO BAG' || $data->name_bid == 'BERAS PECAH KULIT KETAN PUTIH'
            || $data->name_bid == 'BERAS PECAH KULIT KETAN PUTIH 50 KG' || $data->name_bid == 'BERAS PECAH KULIT KETAN PUTIH JUMBO BAG'
        ) {
            return view('dashboard.admin.cetak_po_pk', ['data' => $data, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa, 'get_item' => $get_item]);
        } else {
            return view('dashboard.admin.cetak_po', ['data' => $data, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa, 'get_item' => $get_item]);
        }
    }

    public function gabah_basah()
    {
        $date = date('Y-m-d H:i:s');
        $PONum = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 1)
            ->where('bid.name_bid', 'like', '%GABAH BASAH%')
            ->where('batas_penerimaan_po', '<=', $date)
            ->orderBy("id_data_po", "desc")
            ->get();
        // dd($PONum);

        foreach ($PONum as $get) {
            // dd($get_id->PONum);
            $client = new \GuzzleHttp\Client();

            // dd($response); 
            // Integrasi Epicor
            $promise = $client->getAsync('http://34.34.222.145:2022/api/PO/ClosePO?PONum=' . $get->PONum);
            $promise->then(
                function (Response $response) use ($get) {
                    $response = $response->getBody()->getContents();
                    $get_id = DataPO::where('PONum', $get->PONum)->update(['status_bid' => '5']);
                }

            );
            sleep(1);
            $result = $promise->wait();
            // insert Log Aktivity
            $data = new LogAktivitySecurity();
            $data->name_user                        = Auth::guard('security')->user()->name;
            $data->id_objek_aktivitas_security     = $get->id_data_po;
            $data->aktivitas_security              = 'Close PO: ' . $get->kode_po;
            $data->keterangan_aktivitas              = 'Selesai';
            $data->created_at                       = date('Y-m-d H:i:s');
            $data->save();

            $po = trackerPO::where('kode_po_tracker', $get->kode_po)->first();
            $po->nama_admin_tracker  = Auth::guard('security')->user()->name;
            $po->status_po_tracker  = '5';
            $po->penerimaan_po_tracker  = NULL;
            $po->po_terlambat_tracker  = date('Y-m-d H:i:s');
            $po->proses_tracker  = 'PENERIMAAN PO TERLAMBAT';
            $po->update();
        }

        return view('dashboard.admin.gabah_basah');
    }
    public function beras_pk()
    {
        $date = date('Y-m-d H:i:s');
        $PONum = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 1)
            ->where('bid.name_bid', 'like', '%BERAS PECAH KULIT%')
            ->where('batas_penerimaan_po', '<=', $date)
            ->orderBy("id_data_po", "desc")
            ->get();
        // dd($PONum);

        foreach ($PONum as $get) {
            // dd($get_id->PONum);
            $client = new \GuzzleHttp\Client();

            $promise = $client->getAsync('http://34.34.222.145:2022/api/PO/ClosePO?PONum=' . $get->PONum);
            $promise->then(
                function (Response $response) use ($get) {
                    echo $response = $response->getBody()->getContents();
                    $get_id = DataPO::where('PONum', $get->PONum)->update(['status_bid' => '5']);
                }

            );
            sleep(1);
            $result = $promise->wait();
            // insert Log Aktivity
            $data = new LogAktivitySecurity();
            $data->name_user                        = Auth::guard('security')->user()->name;
            $data->id_objek_aktivitas_security     = $get->id_data_po;
            $data->aktivitas_security              = 'Close PO: ' . $get->kode_po;
            $data->keterangan_aktivitas              = 'Selesai';
            $data->created_at                       = date('Y-m-d H:i:s');
            $data->save();
        }

        $po_kemarin = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 1)
            ->where('bid.name_bid', 'like', '%BERAS PECAH KULIT%')
            ->where('bid.open_po', date('Y-m-d', strtotime('-1 days')))
            ->orderBy("id_data_po", "desc")
            ->get();

        $po_besok = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 1)
            ->where('bid.name_bid', 'like', '%BERAS PECAH KULIT%')
            ->where('bid.open_po', date('Y-m-d', strtotime('+1 days')))
            ->orderBy("id_data_po", "desc")
            ->get();
        return view('dashboard.admin.beras_pk', ['po_kemarin' => $po_kemarin, 'po_besok' => $po_besok]);
    }
    public function beras_ds_urgent()
    {
        $date = date('Y-m-d H:i:s');
        $PONum = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 1)
            ->where('bid.name_bid', 'like', '%BERAS DS%')
            ->where('batas_penerimaan_po', '<=', $date)
            ->orderBy("id_data_po", "desc")
            ->get();
        // dd($PONum);

        foreach ($PONum as $get) {
            // dd($get_id->PONum);
            $client = new \GuzzleHttp\Client();

            $promise = $client->getAsync('http://34.34.222.145:2022/api/PO/ClosePO?PONum=' . $get->PONum);
            $promise->then(
                function (Response $response) use ($get) {
                    echo $response = $response->getBody()->getContents();
                    $get_id = DataPO::where('PONum', $get->PONum)->update(['status_bid' => '5']);
                }

            );
            sleep(1);
            $result = $promise->wait();
            // insert Log Aktivity
            $data = new LogAktivitySecurity();
            $data->name_user                        = Auth::guard('security')->user()->name;
            $data->id_objek_aktivitas_security     = $get->id_data_po;
            $data->aktivitas_security              = 'Close PO: ' . $get->kode_po;
            $data->keterangan_aktivitas              = 'Selesai';
            $data->created_at                       = date('Y-m-d H:i:s');
            $data->save();
        }


        return view('dashboard.admin.beras_ds_urgent');
    }
    public function beras_ds_noturgent()
    {
        return view('dashboard.admin.beras_ds_noturgent');
    }
    public function gabahbasah_index_kemarin()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 5)
            ->where('bid.name_bid', 'like', '%GABAH BASAH%')
            ->orderBy("id_data_po", "desc")
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
            ->addColumn('mulai_penerimaan', function ($list) {
                $result = $list->date_bid;
                return date('Y-m-d', strtotime($result)) . '<br><span class="btn-danger">Mulai 12.00</span>';
            })
            ->addColumn('batas_bid', function ($list) {
                $result = $list->batas_penerimaan_po;
                return date('d-m-Y', strtotime($result)) . '<br><span class="btn-danger">Batas 12.00</span>';
                // return $result;
            })

            ->addColumn('ckelola', function ($list) {

                return
                    '<button style="margin:2px;" name="' . $list->id_data_po . '" title="PO Close" class="totolak btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-shipping-fast" >&nbsp;</i>PO&nbsp;CLOSE
                    </button>';
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'mulai_penerimaan', 'batas_bid', 'ckelola'])
            ->make(true);
    }
    public function gabahbasah_index_sekarang()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 1)
            ->where('bid.name_bid', 'like', '%GABAH BASAH%')
            ->where('bid.open_po', date('Y-m-d'))
            ->orderBy("id_data_po", "desc")
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
            ->addColumn('mulai_penerimaan', function ($list) {
                $result = $list->date_bid;
                if (date('H:i:s') >= date('12:00:00', strtotime($result))) {
                    return date('Y-m-d', strtotime($result)) . '<br><span class="btn-danger">Mulai 12.00</span>';
                } else {
                    return date('Y-m-d', strtotime($result)) . '<br><span class="btn-success">Mulai 12.00</span>';
                }
            })
            ->addColumn('batas_bid', function ($list) {
                $result = $list->batas_penerimaan_po;
                if (date('12:00:00', strtotime($result)) >= date('H:i:s')) {
                    return date('d-m-Y', strtotime($result)) . '<br><span class="btn-success">Batas 12.00</span>';
                } else {
                    return date('d-m-Y', strtotime($result)) . '<br><span class="btn-danger">Batas 12.00</span>';
                }
                // return $result;
            })

            ->addColumn('ckelola', function ($list) {
                if (date("Y-m-d") == $list->open_po) {
                    if (date('H:i:s') <= date('12:00:00')) {
                        return
                            '<button style="margin:2px;" name="' . $list->id_data_po . '" data-toggle="modal" data-target="#modal2" title="Terima Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-shipping-fast" >&nbsp;</i>
                        Proses&nbsp;Pengiriman
                    </button>';
                    } else {
                        return
                            '<button style="margin:2px;" name="' . $list->id_data_po . '" title="PO Close" class="totolak btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-shipping-fast" >&nbsp;</i>PO&nbsp;CLOSE
                        </button>';
                    }
                } else {
                    return
                        '<button style="margin:2px;" name="' . $list->id_data_po . '" title="PO Close" class="totolak btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-shipping-fast" >&nbsp;</i>PO&nbsp;CLOSE
                    </button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'mulai_penerimaan', 'batas_bid', 'ckelola'])
            ->make(true);
    }
    public function gabahbasah_index_besok()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 1)
            ->where('bid.name_bid', 'like', '%GABAH BASAH%')
            ->where('bid.open_po', date('Y-m-d', strtotime('+1 days')))
            ->orderBy("id_data_po", "desc")
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
            ->addColumn('mulai_penerimaan', function ($list) {
                $result = $list->date_bid;
                if (date('12:00:00') > date('H:i:s')) {
                    return date('Y-m-d', strtotime($result)) . '<br><span class="btn-danger">Mulai 12.00</span>';
                } else {
                    return date('Y-m-d', strtotime($result)) . '<br><span class="btn-success">Mulai 12.00</span>';
                }
            })
            ->addColumn('batas_bid', function ($list) {
                $result = $list->batas_penerimaan_po;
                if (date('12:00:00') > date('H:i:s')) {
                    return date('d-m-Y', strtotime($result)) . '<br><span class="btn-danger">Batas 12.00</span>';
                } else {
                    return date('d-m-Y', strtotime($result)) . '<br><span class="btn-success">Batas 12.00</span>';
                }
                // return $result;
            })

            ->addColumn('ckelola', function ($list) {
                if (date('Y-m-d 12:00:00') > date('Y-m-d H:i:s')) {
                    return '<button style="margin:2px;" name="' . $list->id_data_po . '" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-shipping-fast">&nbsp;</i>
                        Menunggu&nbsp;Waktu
                    </button>';
                } else {
                    return '<button style="margin:2px;" name="' . $list->id_data_po . '" data-toggle="modal" data-target="#modal2" title="Terima Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-shipping-fast">&nbsp;</i>
                        Proses&nbsp;Pengiriman
                    </button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'mulai_penerimaan', 'batas_bid', 'ckelola'])
            ->make(true);
    }
    public function gabahkering_index_sekarang()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 1)
            ->where('bid.name_bid', '=', 'GABAH KERING')
            ->where('bid.open_po', date('Y-m-d'))
            ->orderBy("id_data_po", "desc")
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
            ->addColumn('mulai_penerimaan', function ($list) {
                $result = $list->date_bid;
                if (date('Y-m-d H:i:s') >= $result) {
                    return date('Y-m-d', strtotime($result)) . '<br><span class="btn-success">Mulai 08.00</span>';
                } else {
                    return date('Y-m-d', strtotime($result)) . '<br><span class="btn-danger">Mulai 08.00</span>';
                }
            })
            ->addColumn('batas_bid', function ($list) {
                $result = $list->batas_penerimaan_po;
                if (date($result) >= date('Y-m-d H:i:s')) {
                    return date('d-m-Y', strtotime($result)) . '<br><span class="btn-success">Batas 24.00</span>';
                } else {
                    return date('d-m-Y', strtotime($result)) . '<br><span class="btn-danger">Batas 24.00</span>';
                }
                // return $result;
            })

            ->addColumn('ckelola', function ($list) {
                if (date("Y-m-d") == $list->open_po) {
                    if (date('Y-m-d H:i:s') <= date('Y-m-d 23:59:00')) {
                        return
                            '<button style="margin:2px;" name="' . $list->id_data_po . '" data-toggle="modal" data-target="#modal2" title="Terima Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-shipping-fast" >&nbsp;</i>
                        Proses&nbsp;Pengiriman
                    </button>';
                    } else {
                        return
                            '<button style="margin:2px;" name="' . $list->id_data_po . '" data-toggle="modal" data-target="#modal_po_ditolak" title="PO Tolak" class="totolak btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-shipping-fast" >&nbsp;</i>
                        Pengiriman&nbsp;Terlambat
                    </button>';
                    }
                } else {
                    return
                        '<button style="margin:2px;" name="' . $list->id_data_po . '" data-toggle="modal" data-target="#modal_po_ditolak" title="Pengajuan Terlambat" class="totolak btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-shipping-fast">&nbsp;</i>
                    Pengiriman&nbsp;Terlambat
                </button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'mulai_penerimaan', 'batas_bid', 'ckelola'])
            ->make(true);
    }
    public function beraspk_index_kemarin()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 5)
            ->where('bid.name_bid', 'like', '%BERAS PECAH KULIT%')
            ->orderBy("id_data_po", "desc")
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
            ->addColumn('mulai_penerimaan', function ($list) {
                $result = $list->date_bid;
                return date('Y-m-d', strtotime($result)) . '<br><span class="btn-danger">Mulai 12.00</span>';
            })
            ->addColumn('batas_bid', function ($list) {
                $result = $list->batas_penerimaan_po;
                return date('d-m-Y', strtotime($result)) . '<br><span class="btn-danger">Batas 12.00</span>';
                // return $result;
            })

            ->addColumn('ckelola', function ($list) {

                return
                    '<button style="margin:2px;" name="' . $list->id_data_po . '" title="PO Close" class="totolak btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-shipping-fast" >&nbsp;</i>PO&nbsp;CLOSE
                    </button>';
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'mulai_penerimaan', 'batas_bid', 'ckelola'])
            ->make(true);
    }
    public function beraspk_index_sekarang()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 1)
            ->where('bid.name_bid', 'like', '%BERAS PECAH KULIT%')
            ->where('bid.open_po', date('Y-m-d'))
            ->orderBy("id_data_po", "desc")
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
            ->addColumn('mulai_penerimaan', function ($list) {
                $result = $list->date_bid;
                if (date('H:i:s') >= date('12:00:00', strtotime($result))) {
                    return date('Y-m-d', strtotime($result)) . '<br><span class="btn-danger">Mulai 12.00</span>';
                } else {
                    return date('Y-m-d', strtotime($result)) . '<br><span class="btn-success">Mulai 12.00</span>';
                }
            })
            ->addColumn('batas_bid', function ($list) {
                $result = $list->batas_penerimaan_po;
                if (date('12:00:00', strtotime($result)) >= date('H:i:s')) {
                    return date('d-m-Y', strtotime($result)) . '<br><span class="btn-success">Batas 12.00</span>';
                } else {
                    return date('d-m-Y', strtotime($result)) . '<br><span class="btn-danger">Batas 12.00</span>';
                }
                // return $result;
            })

            ->addColumn('ckelola', function ($list) {
                if (date("Y-m-d") == $list->open_po) {
                    if (date('H:i:s') <= date('12:00:00')) {
                        return
                            '<button style="margin:2px;" name="' . $list->id_data_po . '" data-toggle="modal" data-target="#modal2" title="Terima Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-shipping-fast" >&nbsp;</i>
                        Proses&nbsp;Pengiriman
                    </button>';
                    } else {
                        return
                            '<button style="margin:2px;" name="' . $list->id_data_po . '" data-toggle="modal" data-target="#modal_po_ditolak" title="PO Tolak" class="totolak btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-shipping-fast" >&nbsp;</i>
                        Pengiriman&nbsp;Terlambat
                    </button>';
                    }
                } else {
                    return
                        '<button style="margin:2px;" name="' . $list->id_data_po . '" data-toggle="modal" data-target="#modal_po_ditolak" title="Pengajuan Terlambat" class="totolak btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-shipping-fast">&nbsp;</i>
                    Pengiriman&nbsp;Terlambat
                </button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'mulai_penerimaan', 'batas_bid', 'ckelola'])
            ->make(true);
    }
    public function beraspk_index_besok()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 1)
            ->where('bid.name_bid', 'like', '%BERAS PECAH KULIT%')
            ->where('bid.open_po', date('Y-m-d', strtotime('+1 days')))
            ->orderBy("id_data_po", "desc")
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
            ->addColumn('mulai_penerimaan', function ($list) {
                $result = $list->date_bid;
                if (date('12:00:00') > date('H:i:s')) {
                    return date('Y-m-d', strtotime($result)) . '<br><span class="btn-danger">Mulai 12.00</span>';
                } else {
                    return date('Y-m-d', strtotime($result)) . '<br><span class="btn-success">Mulai 12.00</span>';
                }
            })
            ->addColumn('batas_bid', function ($list) {
                $result = $list->batas_penerimaan_po;
                if (date('12:00:00') > date('H:i:s')) {
                    return date('d-m-Y', strtotime($result)) . '<br><span class="btn-danger">Batas 12.00</span>';
                } else {
                    return date('d-m-Y', strtotime($result)) . '<br><span class="btn-success">Batas 12.00</span>';
                }
                // return $result;
            })

            ->addColumn('ckelola', function ($list) {
                if (date('Y-m-d 12:00:00') > date('Y-m-d H:i:s')) {
                    return '<button style="margin:2px;" name="' . $list->id_data_po . '" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-shipping-fast">&nbsp;</i>
                        Menunggu&nbsp;Waktu
                    </button>';
                } else {
                    return '<button style="margin:2px;" name="' . $list->id_data_po . '" data-toggle="modal" data-target="#modal2" title="Terima Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-shipping-fast">&nbsp;</i>
                        Proses&nbsp;Pengiriman
                    </button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'mulai_penerimaan', 'batas_bid', 'ckelola'])
            ->make(true);
    }
    public function berasdsurgent_index_kemarin()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 1)
            ->where('bid.name_bid', 'like', '%BERAS DS%')
            ->where('bid.open_po', date('Y-m-d', strtotime('-1 days')))
            ->orderBy("id_data_po", "desc")
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
            ->addColumn('mulai_penerimaan', function ($list) {
                $result = $list->date_bid;
                if (date('H:i:s', strtotime($list->date_bid)) < date('12:00:00', strtotime($list->tanggal_po))) {
                    return date('Y-m-d', strtotime($result)) . '<br><span class="btn-danger">Mulai 12.00</span>';
                } else {
                    return date('Y-m-d', strtotime($result)) . '<br><span class="btn-success">Mulai 12.00</span>';
                }
            })
            ->addColumn('batas_bid', function ($list) {
                $result = $list->batas_penerimaan_po;
                if (date('H:i:s', strtotime($list->batas_penerimaan_po)) < date('H:i:s')) {
                    return date('d-m-Y', strtotime($result)) . '<br><span class="btn-danger">Batas 12.00</span>';
                } else {
                    return date('d-m-Y', strtotime($result)) . '<br><span class="btn-success">Batas 12.00</span>';
                }
                // return $result;
            })

            ->addColumn('ckelola', function ($list) {
                if (date('H:i:s', strtotime($list->batas_penerimaan_po)) < date('H:i:s')) {
                    return
                        '<button style="margin:2px;" name="' . $list->id_data_po . '" data-toggle="modal" data-target="#modal_po_ditolak" title="PO Tolak" class="totolak btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-shipping-fast" >&nbsp;</i>
                    Pengiriman&nbsp;Terlambat
                </button>';
                } else {
                    return
                        '<button style="margin:2px;" name="' . $list->id_data_po . '" data-toggle="modal" data-target="#modal_penerimaan" title="Terima Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-shipping-fast" >&nbsp;</i>
                    Proses&nbsp;Pengiriman
                </button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'mulai_penerimaan', 'batas_bid', 'ckelola'])
            ->make(true);
    }
    public function berasdsurgent_index_sekarang()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 1)
            ->where('bid.name_bid', 'like', '%BERAS DS%')
            ->where('bid.open_po', date('Y-m-d'))
            ->orderBy("id_data_po", "desc")
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
            ->addColumn('mulai_penerimaan', function ($list) {
                $result = $list->date_bid;
                if (date('H:i:s') >= date('12:00:00', strtotime($result))) {
                    return date('Y-m-d', strtotime($result)) . '<br><span class="btn-danger">Mulai 12.00</span>';
                } else {
                    return date('Y-m-d', strtotime($result)) . '<br><span class="btn-success">Mulai 12.00</span>';
                }
            })
            ->addColumn('batas_bid', function ($list) {
                $result = $list->batas_penerimaan_po;
                if (date('12:00:00', strtotime($result)) >= date('H:i:s')) {
                    return date('d-m-Y', strtotime($result)) . '<br><span class="btn-success">Batas 12.00</span>';
                } else {
                    return date('d-m-Y', strtotime($result)) . '<br><span class="btn-danger">Batas 12.00</span>';
                }
                // return $result;
            })

            ->addColumn('ckelola', function ($list) {
                if (date("Y-m-d") == $list->open_po) {
                    if (date('H:i:s') <= date('12:00:00')) {
                        return
                            '<button style="margin:2px;" name="' . $list->id_data_po . '" data-toggle="modal" data-target="#modal_penerimaan" title="Terima Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-shipping-fast" >&nbsp;</i>
                        Proses&nbsp;Pengiriman
                    </button>';
                    } else {
                        return
                            '<button style="margin:2px;" name="' . $list->id_data_po . '" data-toggle="modal" data-target="#modal_po_ditolak" title="PO Tolak" class="totolak btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-shipping-fast" >&nbsp;</i>
                        Pengiriman&nbsp;Terlambat
                    </button>';
                    }
                } else {
                    return
                        '<button style="margin:2px;" name="' . $list->id_data_po . '" data-toggle="modal" data-target="#modal_po_ditolak" title="Pengajuan Terlambat" class="totolak btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-shipping-fast">&nbsp;</i>
                    Pengiriman&nbsp;Terlambat
                </button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'mulai_penerimaan', 'batas_bid', 'ckelola'])
            ->make(true);
    }
    public function berasdsurgent_index_besok()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 1)
            ->where('bid.name_bid', 'like', '%BERAS DS%')
            ->where('bid.open_po', date('Y-m-d', strtotime('+1 days')))
            ->orderBy("id_data_po", "desc")
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
            ->addColumn('mulai_penerimaan', function ($list) {
                $result = $list->date_bid;
                if (date('12:00:00') > date('H:i:s')) {
                    return date('Y-m-d', strtotime($result)) . '<br><span class="btn-danger">Mulai 12.00</span>';
                } else {
                    return date('Y-m-d', strtotime($result)) . '<br><span class="btn-success">Mulai 12.00</span>';
                }
            })
            ->addColumn('batas_bid', function ($list) {
                $result = $list->batas_penerimaan_po;
                if (date('12:00:00', strtotime($result)) > date('H:i:s')) {
                    return date('d-m-Y', strtotime($result)) . '<br><span class="btn-danger">Batas 12.00</span>';
                } else {
                    return date('d-m-Y', strtotime($result)) . '<br><span class="btn-success">Batas 12.00</span>';
                }
                // return $result;
            })

            ->addColumn('ckelola', function ($list) {
                if (date('Y-m-d 12:00:00') > date('Y-m-d H:i:s')) {
                    return
                        '<button style="margin:2px;" name="' . $list->id_data_po . '" data-toggle="modal" data-target="" title="Menunggu Waktu" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-shipping-fast" >&nbsp;</i>
                    Menunggu&nbsp;Waktu
                </button>';
                } else {
                    return
                        '<button style="margin:2px;" name="' . $list->id_data_po . '" data-toggle="modal" data-target="#modal_penerimaan" title="Terima Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-shipping-fast" >&nbsp;</i>
                    Proses&nbsp;Pengiriman
                </button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'mulai_penerimaan', 'batas_bid', 'ckelola'])
            ->make(true);
    }

    public function berasdsnoturgent_index_sekarang()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 1)
            ->where('bid.name_bid', '=', 'BERAS DS')
            ->whereBetween('data_po.tanggal_po', [date('Y-m-d 12:00:00', strtotime('+1 days')), date('Y-m-d', strtotime('+7 days'))])
            ->orderBy("id_data_po", "desc")
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
            ->addColumn('mulai_penerimaan', function ($list) {
                $result = $list->date_bid;
                if (date('Y-m-d H:i:s') <= date('Y-m-d 12:00:00', strtotime($result))) {
                    return date('Y-m-d', strtotime($result)) . '<br><span class="btn-danger">Mulai 12.00 </span>';
                } else {
                    return date('Y-m-d', strtotime($result)) . '<br><span class="btn-success">Mulai 12.00</span>';
                }
            })
            ->addColumn('batas_bid', function ($list) {
                $result = $list->batas_penerimaan_po;
                if ($result >= date('Y-m-d H:i:s')) {
                    return date('d-m-Y', strtotime($result)) . '<br><span class="btn-success">Batas 12.00</span>';
                } else {
                    return date('d-m-Y', strtotime($result)) . '<br><span class="btn-danger">Batas 12.00</span>';
                }
                // return $result;
            })

            ->addColumn('ckelola', function ($list) {
                if (date('Y-m-d 12:00:00', strtotime($list->date_bid)) <= $list->batas_penerimaan_po) {
                    return
                        '<button style="margin:2px;" name="' . $list->id_data_po . '" data-toggle="modal" data-target="#modal2" title="Terima Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-shipping-fast" >&nbsp;</i>
                        Proses&nbsp;Pengiriman
                    </button>';
                } else {
                    return
                        '<button style="margin:2px;" name="' . $list->id_data_po . '" data-toggle="modal" data-target="#modal_po_ditolak" title="PO Tolak" class="totolak btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-shipping-fast" >&nbsp;</i>
                        Pengiriman&nbsp;Terlambat
                    </button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'mulai_penerimaan', 'batas_bid', 'ckelola'])
            ->make(true);
    }

    public function tolak_po_telat($id)
    {
        $data = DataPO::where('id_data_po', $id)->first();
        $data->status_bid = 5;
        $data->update();
        return redirect()->back();
    }

    public function data_revisi()
    {
        return view('dashboard.admin.data_revisi');
    }


    public function show_penerimaan_po($id)
    {
        $check_penerimaan_po = PenerimaanPO::where('penerimaan_id_data_po', $id)->first();
        //dd($check_penerimaan_po);
        if (!$check_penerimaan_po) {
            $data1 = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')->where('id_data_po', $id)->first();
            return json_encode($data1);
        } else {
            $data2 = PenerimaanPO::join('data_po', 'data_po.id_data_po', '=', 'penerimaan_po.penerimaan_id_data_po')
                ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                ->where('penerimaan_po.penerimaan_id_data_po', $id)
                ->first();
            return json_encode($data2);
        }
    }

    public function generate(Request $request)
    {
        $get_cetak = DataPO::where('kode_po', $request->kode_po)
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')->first();
        // dd($get_cetak);
        $cek = PenerimaanPO::where('penerimaan_kode_po', $get_cetak->kode_po)->first();
        $params_antrian = PenerimaanPO::join('data_po', 'data_po.id_data_po', 'penerimaan_po.penerimaan_id_data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->where('data_po.tanggal_po', $get_cetak->tanggal_po)
            ->where('bid.name_bid', $get_cetak->name_bid)
            ->count();
        $params_antrian = ($params_antrian + 1);
        if (strlen((string) $params_antrian) == 1) {
            $no_antrian = '00' . ($params_antrian);
        } else if (strlen((string) $params_antrian) == 2) {
            $no_antrian = '0' . ($params_antrian);
        }
        if (date('Y-m-d H:i:s') <= $get_cetak->batas_penerimaan_po) {
            if (empty($cek->penerimaan_kode_po)) {
                $data = new PenerimaanPO();
                $data->penerimaan_id_bid_user      = $get_cetak->bid_user_id;
                $data->penerimaan_id_data_po       = $get_cetak->id_data_po;
                $data->penerimaan_kode_po          = $get_cetak->kode_po;
                $data->penerima_po                 = Auth::guard('security')->user()->id;
                $data->waktu_penerimaan            = date('Y-m-d H:i:s');
                $data->no_antrian                  = $no_antrian;
                // $data->plat_kendaraan              = Str::upper($request->plat_kendaraan);
                $data->status_penerimaan           = '3';
                $data->penerimaan_po_num           = $get_cetak->PONum;
                $data->save();


                $log                               = new LogAktivitySecurity();
                $log->name_user                    = Auth::guard('security')->user()->name;
                $log->id_objek_aktivitas_security  = $data->id_penerimaan_po;
                $log->aktivitas_security           = 'Insert Penerimaan PO Kode PO:' . $get_cetak->kode_po;
                $log->keterangan_aktivitas           = 'Selesai';
                $log->created_at                   = date('Y-m-d H:i:s');
                $log->save();
                if ($get_cetak->status_bid == 1) {
                    $data = DataPO::where('id_data_po', $get_cetak->id_data_po)->update(['status_bid' => '3']);
                }
                // return redirect()->route('security.cetak_po', $get_cetak->id_data_po);
            } else {
                $query = PenerimaanPO::where('penerimaan_kode_po', $get_cetak->kode_po)->first();
                if ($query->status_penerimaan == 5) {
                    $data = PenerimaanPO::where('penerimaan_kode_po', $get_cetak->kode_po)->update(['status_penerimaan' => 3]);
                    if ($get_cetak->status_bid == 1) {
                        $data = DataPO::where('id_data_po', $get_cetak->id_data_po)->update(['status_bid' => 3]);
                    }
                }
                return response()->json('exits');
            }
        } else {
            $log = new LogAktivitySecurity();
            $log->name_user                    = Auth::guard('security')->user()->name;
            $log->id_objek_aktivitas_security  = $cek->id_penerimaan_po;
            $log->aktivitas_security           = 'Insert Penerimaan PO Terlambat Kode PO:' . $get_cetak->kode_po;
            $log->keterangan_aktivitas           = 'Selesai';
            $log->created_at                   = date('Y-m-d H:i:s');
            $log->save();
            return response()->json('close');
        }
        return response()->json($data);
    }
    public function terima_data_po(Request $request)
    {
        // dd($request->all());
        $params_antrian = PenerimaanPO::join('data_po', 'data_po.id_data_po', 'penerimaan_po.penerimaan_id_data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->where('data_po.tanggal_po', $request->tanggal_po)
            ->where('bid.name_bid', $request->nama_item)
            ->count();
            // dd($params_antrian);
        $antrian = ($params_antrian + 1);
        if (strlen((string) $antrian) == 1) {
            $no_antrian = '00' . ($antrian);
        } else if (strlen((string) $antrian) == 2) {
            $no_antrian = '0' . ($antrian);
        } else if (strlen((string) $antrian) == 3) {
            $no_antrian = $antrian;
        }
        // dd(strlen((string) $antrian));
        $data = new PenerimaanPO();
        $data->penerimaan_id_bid_user      = $request->penerimaan_id_bid_user;
        $data->penerimaan_id_data_po       = $request->penerimaan_id_data_po;
        $data->penerimaan_kode_po          = $request->penerimaan_kode_po;
        $data->penerima_po                 = $request->penerima_po;
        $data->waktu_penerimaan            = date('Y-m-d H:i:s');
        $data->no_antrian                  = $no_antrian;
        $data->keterangan_penerimaan_po    = $request->keterangan_penerimaan_po;
        $data->plat_kendaraan              = Str::upper($request->plat_kendaraan);
        $data->status_penerimaan           = $request->status_penerimaan;
        $data->penerimaan_po_num           = $request->ponum;
        $data->save();

        $update_status_data_po_TabelPO      = DataPO::where('id_data_po', $request->penerimaan_id_data_po)->first();

        $log                               = new LogAktivitySecurity();
        $log->name_user                    = Auth::guard('security')->user()->name;
        $log->id_objek_aktivitas_security  = $data->id_penerimaan_po;
        $log->aktivitas_security           = 'Insert Penerimaan PO Kode PO: ' . $request->penerimaan_kode_po . ' Nopol: ' . Str::upper($request->plat_kendaraan);
        $log->keterangan_aktivitas           = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();


        $po = trackerPO::where('kode_po_tracker', $request->penerimaan_kode_po)->first();
        $po->nama_admin_tracker  = Auth::guard('security')->user()->name;
        $po->id_penerimaan_tracker  = $data->id_penerimaan_po;
        $po->status_po_tracker  = '3';
        $po->penerimaan_po_tracker  = date('Y-m-d H:i:s');
        $po->proses_tracker  = 'PENERIMAAN PO';
        $po->po_terlambat_tracker  = NULL;
        $po->update();

        $notif = new NotifLab();
        $notif->judul    = 'PO Datang';
        $notif->keterangan  = 'Ada PO Baru Datang, Kode PO : ' . $request->penerimaan_kode_po . ' , Nopol : ' . Str::upper($request->plat_kendaraan);
        $notif->notifbaru  = '0';
        $notif->status  = '0';
        $notif->id_objek  = $data->id_penerimaan_po;
        $notif->kategori = '0';
        $notif->created_at = date('Y-m-d H:i:s');
        $notif->save();

        if ($update_status_data_po_TabelPO->status_bid == 1) {
            $data = DataPO::where('id_data_po', $request->penerimaan_id_data_po)->update(['nopol' => Str::upper($request->plat_kendaraan), 'status_bid' => $request->status_penerimaan]);
        }
        return response()->json($data);
    }

    public function terima_data_po_telat(Request $request)
    {
        //  Integrasi Epicor
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/PO/ClosePO?PONum=' . $request->PONum;
        $response = $client->get($url);
        $response = $response->getBody()->getContents();
        // dd($response); 
        $data = new PenerimaanPO();
        $data->penerimaan_id_bid_user   = $request->penerimaan_id_bid_user;
        $data->penerimaan_id_data_po    = $request->penerimaan_id_data_po;
        $data->penerimaan_kode_po       = $request->penerimaan_kode_po;
        $data->penerima_po              = $request->penerima_po;
        $data->waktu_penerimaan         = date('Y-m-d H:i:s');
        $data->plat_kendaraan           = $request->plat_kendaraan;
        $data->keterangan_penerimaan_po = $request->keterangan_penerimaan_po;
        $data->status_penerimaan        = $request->status_penerimaan;
        $data->save();

        $update_status_data_po_TabelPO  = DataPO::where('id_data_po', $request->penerimaan_id_data_po)->first();
        if ($update_status_data_po_TabelPO->status_bid == 1) {
            $data1 = DataPO::where('id_data_po', $request->penerimaan_id_data_po)->update(['nopol' => $request->plat_kendaraan, 'status_bid' => 5]);
        }
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1500);
        // return redirect()->back();
    }

    public function po_diterima()
    {

        $po_diterima_kemarin = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')

            ->where('data_po.tanggal_po', date('Y-m-d', strtotime('-1 days')))
            ->where('penerimaan_po.status_penerimaan', '=', 3)
            ->orderBy('penerimaan_po.id_penerimaan_po', 'ASC')
            ->get();
        $po_diterima_besok = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')

            ->where('data_po.tanggal_po', date('Y-m-d', strtotime('+1 days')))
            ->where('penerimaan_po.status_penerimaan', '=', 3)
            ->orderBy('penerimaan_po.id_penerimaan_po', 'ASC')
            ->get();
        return view('dashboard.admin.po_diterima', ['po_diterima_kemarin' => $po_diterima_kemarin, 'po_diterima_besok' => $po_diterima_besok]);
    }

    public function po_ditolak()
    {

        $po_ditolak_kemarin = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')

            ->where('data_po.tanggal_po', date('Y-m-d', strtotime('-1 days')))
            ->where('data_po.status_bid', 5)
            ->orderBy('data_po.id_data_po', 'DESC')
            ->get();
        $po_ditolak_besok = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')

            ->where('data_po.tanggal_po', date('Y-m-d', strtotime('+1 days')))
            ->where('data_po.status_bid', 5)
            ->orderBy('data_po.id_data_po', 'DESC')
            ->get();
        return view('dashboard.admin.po_ditolak', ['po_ditolak_kemarin' => $po_ditolak_kemarin, 'po_ditolak_besok' => $po_ditolak_besok]);
    }

    public function po_diterima_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')

            ->where('penerimaan_po.status_penerimaan', '!=', 5)
            ->where('penerimaan_po.status_penerimaan', '!=', '16')
            ->where('penerimaan_po.status_penerimaan', '!=', '13')
            ->orderBy('penerimaan_po.id_penerimaan_po', 'DESC')
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
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('batas_bid', function ($list) {
                $result = $list->batas_bid;
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
                return $result;
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="to_show_nopol btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
            <i class="fa fa-pen-alt" style="color:#00c5dc;"> </i>' . $result . '
            </a>';
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_penerimaan == 3) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_data_po . '"  class=" btn btn-outline-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-truck"> </i>Parkir&nbsp;(Proses&nbsp;Lab&nbsp;1)
                </a>';
                } elseif ($list->status_penerimaan == 4) {
                    return
                        '<a style="margin:2px;" href="' . route('security.home') . '"  class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-truck"> </i> Late&nbsp;Submission
                </a>';
                } elseif ($list->status_penerimaan == 5) {
                    return
                        '<button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-truck"> </i>PO&nbsp;Ditolak </button>';
                } elseif ($list->status_penerimaan == 6) {
                    return
                        '<button type="button" class="btn btn-outline-secondary btn-sm"> <i class="fa fa-truck"> </i>Antrian&nbsp;Bongkar</button>';
                } elseif ($list->status_penerimaan == 7) {
                    return
                        '<button type="button" class="btn btn-outline-dark"><i class="fa fa-truck"> </i>Proses&nbsp;Timbangan&nbsp;1</button>';
                } elseif ($list->status_penerimaan == 8) {
                    return
                        '<button type="button" class="btn btn-outline-info btn-sm"> <i class="fa fa-truck"> </i>Proses&nbsp;Bongkar</button>';
                } elseif ($list->status_penerimaan == 9) {
                    return
                        '<button type="button" class="btn btn-outline-success btn-sm"><i class="fa fa-truck"> </i>Selesai&nbsp;Bongkar</button>';
                } elseif ($list->status_penerimaan == 10) {
                    return
                        '<button type="button" class="btn btn-outline-warning btn-sm"><i class="fa fa-truck"> </i>Proses&nbsp;Transaksi</button>';
                } elseif ($list->status_penerimaan == 13) {
                    return
                        '<button type="button" class="btn btn-outline-info btn-sm"><i class="fa fa-truck"> </i>Proses&nbsp;Pembayaran</button>';
                } elseif ($list->status_penerimaan == 16) {
                    return
                        '<button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-truck"> </i>Pending</button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'batas_bid', 'waktu_penerimaan', 'plat_kendaraan', 'ckelola'])
            ->make(true);
    }
    public function data_revisi_index()
    {
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('penerimaan_po.analisa', 'revisi')
            ->orWhere('penerimaan_po.status_penerimaan', '=', 13)
            ->where('penerimaan_po.id_adminanalisa', 1)
            ->where('penerimaan_po.status_analisa', 2)
            ->where('penerimaan_po.status_revisi', 0)
            ->orderBy('penerimaan_po.id_penerimaan_po', 'DESC')
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
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('batas_bid', function ($list) {
                $result = $list->batas_bid;
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
                return $result;
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                if ($list->status_analisa == 0) {
                    return '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="to_show_nopol btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
            <i class="fa fa-pen-alt">' . $result . '</i>
            </button>';
                } else {
                    return '<button style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="to_show_nopol btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
            <i class="fa fa-pen-alt">' . $result . '</i>
            </button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'batas_bid', 'waktu_penerimaan', 'plat_kendaraan', 'ckelola'])
            ->make(true);
    }

    public function show_nopol($id)
    {
        $data = PenerimaanPO::where('id_penerimaan_po', $id)->first();
        return json_encode($data);
    }

    public function update_nopol(Request $req)
    {
        // Update Penerimaan PO
        $data                   = PenerimaanPO::where('id_penerimaan_po', $req->id_penerimaan_po)->first();
        if ($data->status_penerimaan > '3') {
            $data->plat_kendaraan   = $req->plat_kendaraan;
            $data->status_revisi    = 1;
            $data->update();

            // Update Lab 2 
            $query = Lab2GabahBasah::where('lab2_kode_po_gb', $req->penerimaan_kode_po)
                ->update([
                    'lab2_plat_gb' => $req->plat_kendaraan,
                ]);

            // Update Lab 1 
            $query = Lab1GabahBasah::where('lab1_kode_po_gb', $req->penerimaan_kode_po)
                ->update([
                    'lab1_plat_gb' => $req->plat_kendaraan,
                ]);
        }
        $data->plat_kendaraan   = $req->plat_kendaraan;
        $data->analisa    = NULL;
        $data->id_adminanalisa    = NULL;
        $data->status_analisa    = NULL;
        $data->keterangan_analisa    = NULL;
        $data->status_revisi    = NULL;
        $data->update();
        //  Update Data PO
        $query = DataPO::where('kode_po', $req->penerimaan_kode_po)
            ->update([
                'nopol' => $req->plat_kendaraan,
            ]);

        $log = new LogAktivitySecurity();
        $log->name_user                    = Auth::guard('security')->user()->name;
        $log->id_objek_aktivitas_security  = $data->id_penerimaan_po;
        $log->aktivitas_security           = 'update NOPOL KENDARAAN Kode PO:' . $req->penerimaan_kode_po . ' Nopol: ' . Str::upper($req->plat_kendaraan);
        $log->keterangan_aktivitas           = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();

        $po = trackerPO::where('kode_po_tracker', $req->penerimaan_kode_po)->first();
        $po->nama_admin_tracker  = Auth::guard('security')->user()->name;
        $po->revisi_po_tracker  = date('Y-m-d H:i:s');
        $po->proses_tracker  = 'REVISI NOPOL KENDARAAN';
        $po->approve_revisi_spvap_tracker  = NULL;
        $po->approve_tolak_revisi_spvap_tracker  = NULL;
        $po->pengajuan_revisi_ap_tracker  = NULL;
        $po->approve_spvap_tracker  = NULL;
        $po->tolak_approve_spvap_tracker  = NULL;
        $po->update();

        return redirect()->back();
    }

    public function po_pending()
    {
        return view('dashboard.admin.po_pending');
    }

    public function po_bongkar()
    {
        return view('dashboard.admin.po_bongkar');
    }

    public function po_bongkar_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab1_gb', 'lab1_gb.lab1_kode_po_gb', '=', 'data_po.kode_po')

            ->Where('penerimaan_po.status_penerimaan', '=', 8)
            ->orderBy('penerimaan_po.id_penerimaan_po', 'ASC')
            ->get())
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
                return $result;
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="to_show_nopol btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
           ' . $result . '
            </a>';
            })
            ->addColumn('lokasi_bongkar', function ($list) {
                $result = $list->lokasi_bongkar_gb;
                return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
           ' . $result . '
            </a>';
            })
            ->addColumn('antrian', function ($list) {
                $result = $list->antrian1_gb;
                if (($result) == '') {
                    $result = $list->antrian2_gb;
                    return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" class="to_show_nopol btn btn-outline-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
           ' . $result . '
            </a>';
                } else {
                    $result = $list->antrian1_gb;
                    return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" class="to_show_nopol btn btn-outline-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
           ' . $result . '
            </a>';
                }
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_penerimaan == 3) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_data_po . '"  class=" btn btn-outline-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="">Parkir (Proses Lab 1)</i>
                </a>';
                } elseif ($list->status_penerimaan == 4) {
                    return
                        '<a style="margin:2px;" href="' . route('security.home') . '"  class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="">Late Submission</i>
                </a>';
                } elseif ($list->status_penerimaan == 5) {
                    return
                        '<button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-times">PO Ditolak </i></button>';
                } elseif ($list->status_penerimaan == 6) {
                    return
                        '<button type="button" class="btn btn-outline-secondary btn-sm"> <i class="">Antrian Bongkar</i></button>';
                } elseif ($list->status_penerimaan == 16) {
                    return
                        '<button type="button" class="btn btn-outline-primary btn-sm"> <i class="fa fa-check">Pending</i></button>';
                } elseif ($list->status_penerimaan == 7) {
                    return
                        '<button type="button" class="btn btn-outline-dark"><i class="">Proses Timbangan 1</i></button>';
                } elseif ($list->status_penerimaan == 8) {
                    return
                        '<button type="button" class="btn btn-outline-info btn-sm"> <i class=""> Proses Bongkar</i></button>';
                } elseif ($list->status_penerimaan == 9) {
                    return
                        '<button type="button" class="btn btn-outline-success btn-sm"><i class="">Selesai Bongkar</i></button>';
                } elseif ($list->status_penerimaan == 10) {
                    return
                        '<button type="button" class="btn btn-outline-warning btn-sm"><i class="">Proses Transaksi</i></button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'batas_bid', 'waktu_penerimaan', 'plat_kendaraan', 'lokasi_bongkar', 'antrian', 'asal_gabah', 'ckelola'])
            ->make(true);
    }

    public function po_pending_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')

            ->where('lab1_gb.output_lab_gb', 'Pending')
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
                $result = 'Rp. ' . $list->plan_harga_gb . '/Kg';
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->output_lab_gb == 'Unload') {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_bongkar" title="Information" class="to_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Unload 
                    </a>';
                } else {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#to_pending" title="Information" class="to_pending btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                        Pending 
                    </a>';
                }
            })
            ->rawColumns(['waktu_penerimaan', 'kode_po', 'nama_vendor', 'tanggal_po', 'waktu_penerimaan', 'nama_penerima_po', 'plat_kendaraan', 'asal_gabah', 'ckelola'])
            ->make(true);
    }

    public function data_po_diterima_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab1_gb', 'lab1_gb.lab1_kode_po_gb', '=', 'data_po.kode_po')

            ->where('penerimaan_po.status_penerimaan', 6)
            ->orWhere('penerimaan_po.status_penerimaan', 7)
            ->orderBy('penerimaan_po.id_penerimaan_po', 'ASC')
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
            ->addColumn('batas_bid', function ($list) {
                $result = $list->batas_bid;
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
                return $result;
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="to_show_nopol btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
           ' . $result . '
            </a>';
            })
            ->addColumn('lokasi_bongkar', function ($list) {
                $result = $list->lokasi_bongkar_gb;
                return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '"  title="Informasi" class="to_show_nopol btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
           ' . $result . '
            </a>';
            })
            ->addColumn('antrian', function ($list) {
                $result = $list->antrian1_gb;
                if (($result) == '') {
                    $result = $list->antrian2_gb;
                    return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '"  title="Informasi" class="to_show_nopol btn btn-outline-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
           ' . $result . '
            </a>';
                } else {
                    $result = $list->antrian1_gb;
                    return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '"  title="Informasi" class="to_show_nopol btn btn-outline-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
           ' . $result . '
            </a>';
                }
            })
            ->addColumn('asal_gabah', function ($list) {
                $result = $list->keterangan_penerimaan_po;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_penerimaan == 3) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_data_po . '"  class=" btn btn-outline-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="">Parkir (Proses Lab 1)</i>
                </a>';
                } elseif ($list->status_penerimaan == 4) {
                    return
                        '<a style="margin:2px;" href="' . route('security.home') . '"  class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="">Late Submission</i>
                </a>';
                } elseif ($list->status_penerimaan == 5) {
                    return
                        '<button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-times">PO Ditolak </i></button>';
                } elseif ($list->status_penerimaan == 6) {
                    return
                        '<button type="button" class="btn btn-outline-secondary btn-sm"> <i class="">Proses Lab 1</i></button>';
                } elseif ($list->status_penerimaan == 16) {
                    return
                        '<button type="button" class="btn btn-outline-primary btn-sm"> <i class="fa fa-check">Pending</i></button>';
                } elseif ($list->status_penerimaan == 7) {
                    return
                        '<button type="button" class="btn btn-outline-dark"><i class="">Menunggu Bongkar</i></button>';
                } elseif ($list->status_penerimaan == 8) {
                    return
                        '<button type="button" class="btn btn-outline-info btn-sm"> <i class=""> Proses Bongkar</i></button>';
                } elseif ($list->status_penerimaan == 9) {
                    return
                        '<button type="button" class="btn btn-outline-success btn-sm"><i class="">Selesai Bongkar</i></button>';
                } elseif ($list->status_penerimaan == 10) {
                    return
                        '<button type="button" class="btn btn-outline-warning btn-sm"><i class="">Proses Transaksi</i></button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'batas_bid', 'waktu_penerimaan', 'plat_kendaraan', 'lokasi_bongkar', 'antrian', 'asal_gabah', 'ckelola'])
            ->make(true);
    }

    public function po_parkir()
    {
        return view('dashboard.admin.po_parkir');
    }

    public function po_parkir_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')

            ->Where('penerimaan_po.status_penerimaan', '=', 3)
            ->orderBy('penerimaan_po.id_penerimaan_po', 'ASC')
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
                $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y ');
                return $result;
            })
            ->addColumn('batas_bid', function ($list) {
                $result = \Carbon\Carbon::parse($list->batas_bid)->isoFormat('DD-MM-Y ');
                return $result;
            })
            ->addColumn('batas_penerimaan_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->batas_penerimaan_po)->isoFormat('DD-MM-Y hh:mm:ss ');
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
                return $result;
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="to_show_nopol btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
           ' . $result . '
            </a>';
            })
            ->addColumn('asal_gabah', function ($list) {
                $result = $list->keterangan_penerimaan_po;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_penerimaan == 3) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_data_po . '"  class=" btn btn-outline-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="">Parkir&nbsp;(Proses&nbsp;Lab&nbsp;1)</i>
                </a>';
                } elseif ($list->status_penerimaan == 4) {
                    return
                        '<a style="margin:2px;" href="' . route('security.home') . '"  class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="">Late Submission</i>
                </a>';
                } elseif ($list->status_penerimaan == 5) {
                    return
                        '<button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-times">PO Ditolak </i></button>';
                } elseif ($list->status_penerimaan == 6) {
                    return
                        '<button type="button" class="btn btn-outline-secondary btn-sm"> <i class="">Antrian Bongkar</i></button>';
                } elseif ($list->status_penerimaan == 16) {
                    return
                        '<button type="button" class="btn btn-outline-primary btn-sm"> <i class="fa fa-check">Pending</i></button>';
                } elseif ($list->status_penerimaan == 7) {
                    return
                        '<button type="button" class="btn btn-outline-dark"><i class="">Proses Timbangan 1</i></button>';
                } elseif ($list->status_penerimaan == 8) {
                    return
                        '<button type="button" class="btn btn-outline-info btn-sm"> <i class=""> Proses Bongkar</i></button>';
                } elseif ($list->status_penerimaan == 9) {
                    return
                        '<button type="button" class="btn btn-outline-success btn-sm"><i class="">Selesai Bongkar</i></button>';
                } elseif ($list->status_penerimaan == 10) {
                    return
                        '<button type="button" class="btn btn-outline-warning btn-sm"><i class="">Proses Transaksi</i></button>';
                }
            })
            ->rawColumns(['kode_po', 'batas_penerimaan_po', 'nama_vendor', 'tanggal_po', 'batas_bid', 'waktu_penerimaan', 'plat_kendaraan', 'asal_gabah', 'ckelola'])
            ->make(true);
    }

    public function po_on_call()
    {
        return view('dashboard.admin.po_on_call');
    }

    public function po_on_call_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')

            ->Where('penerimaan_po.status_penerimaan', '=', 8)
            ->orderBy('penerimaan_po.id_penerimaan_po', 'ASC')
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
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('batas_bid', function ($list) {
                $result = \Carbon\Carbon::parse($list->batas_bid)->isoFormat('DD-MM-Y hh:mm:ss');
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = \Carbon\Carbon::parse($list->waktu_penerimaan)->isoFormat('DD-MM-Y hh:mm:ss');
                return $result;
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="to_show_nopol btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
           ' . $result . '
            </a>';
            })
            ->addColumn('asal_gabah', function ($list) {
                $result = $list->keterangan_penerimaan_po;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_penerimaan == 3) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_data_po . '"  class=" btn btn-outline-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="">Parkir (Proses Lab 1)</i>
                </a>';
                } elseif ($list->status_penerimaan == 4) {
                    return
                        '<a style="margin:2px;" href="' . route('security.home') . '"  class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="">Late Submission</i>
                </a>';
                } elseif ($list->status_penerimaan == 5) {
                    return
                        '<button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-times">PO Ditolak </i></button>';
                } elseif ($list->status_penerimaan == 6) {
                    return
                        '<button type="button" class="btn btn-outline-secondary btn-sm"> <i class="">Antrian Bongkar</i></button>';
                } elseif ($list->status_penerimaan == 16) {
                    return
                        '<button type="button" class="btn btn-outline-primary btn-sm"> <i class="fa fa-check">Pending</i></button>';
                } elseif ($list->status_penerimaan == 7) {
                    return
                        '<button type="button" class="btn btn-outline-dark"><i class="">Proses Timbangan 1</i></button>';
                } elseif ($list->status_penerimaan == 8) {
                    return
                        '<button type="button" class="btn btn-outline-info btn-sm"> <i class=""> Proses Bongkar</i></button>';
                } elseif ($list->status_penerimaan == 9) {
                    return
                        '<button type="button" class="btn btn-outline-success btn-sm"><i class="">Selesai Bongkar</i></button>';
                } elseif ($list->status_penerimaan == 10) {
                    return
                        '<button type="button" class="btn btn-outline-warning btn-sm"><i class="">Proses Transaksi</i></button>';
                }
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'batas_bid', 'waktu_penerimaan', 'plat_kendaraan', 'lokasi_bongkar', 'antrian', 'asal_gabah', 'ckelola'])
            ->make(true);
    }


    public function po_ditolak_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')

            ->where('penerimaan_po.status_penerimaan', 5)
            ->where('data_po.status_bid', 5)
            ->where('data_po.tanggal_po', date('Y-m-d'))
            ->orderBy('penerimaan_po.id_penerimaan_po', 'DESC')
            ->get())
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = $list->waktu_penerimaan;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = $list->tanggal_po;
                return $result;
            })
            ->addColumn('batas_bid', function ($list) {
                $result = $list->batas_bid;
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
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_data_po . '"  class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-minus-circle"></i> Ditolak
                </a>';
            })
            ->rawColumns(['nama_vendor', 'kode_po', 'waktu_penerimaan', 'tanggal_po', 'batas_bid', 'plat_kendaraan', 'plat_kendaraan', 'asal_gabah', 'ckelola'])
            ->make(true);
    }

    public function data_po_ditolak_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')

            ->where('penerimaan_po.status_penerimaan', 5)
            ->where('data_po.status_bid', 5)
            ->orderBy('penerimaan_po.id_penerimaan_po', 'DESC')
            ->get())
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return '
            <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
            ';
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = $list->waktu_penerimaan;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = $list->tanggal_po;
                return $result;
            })
            ->addColumn('batas_bid', function ($list) {
                $result = $list->batas_bid;
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
            ->addColumn('ckelola', function ($list) {
                return
                    '<a style="margin:2px;" name="' . $list->id_data_po . '"  class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-minus-circle"></i> Ditolak
                </a>';
            })
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'batas_bid', 'nama_penerima_po', 'plat_kendaraan', 'ckelola'])
            ->make(true);
    }

    public function unloading_location()
    {
        return view('dashboard.admin.unloading_location');
    }

    public function unloading_location_index()
    {

        return Datatables::of($cek = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')

            ->orderBy('id_data_po', 'desc')
            ->get())
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = $list->open_po;
                return $result;
            })
            ->addColumn('lokasi_bongkar', function ($list) {
                $result = $list->lokasi_bongkar;
                return $result;
            })
            ->addColumn('antrian', function ($list) {
                $result = $list->antrian;
                return $result;
            })
            ->addColumn('plat_kendaraan', function ($list) {
                $result = $list->plat_kendaraan;
                return $result;
            })
            ->addColumn('created_at', function ($list) {
                $result = $list->created_at;
                return $result;
            })
            ->addColumn('ckelola', function ($list) {
                if ($list->status_penerimaan == 3) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_data_po . '" data-toggle="modal" data-target="#modal0" title="Information" onclick="return true" class=" btn btn-outline-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-check">Parking</i>
                </a>';
                } elseif ($list->status_penerimaan == 4) {
                    return
                        '<a style="margin:2px;" href="' . route('security.home') . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Information" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-check">Late Submission</i>
                </a>';
                } elseif ($list->status_penerimaan == 5) {
                    return
                        '<a style="margin:2px;" href="' . route('security.home') . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Information" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-check">Reject</i>
                </a>';
                } elseif ($list->status_penerimaan == 6) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal1" title="Information" onclick="return true" class="to_satpam_for_bonkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-check">Lab Process</i>
                </a>';
                } elseif ($list->status_penerimaan == 7) {
                    return
                        '<a style="margin:2px;" name="' . $list->id_penerimaan_po . '" data-toggle="modal" data-target="#modal1" title="Information" onclick="return true" class="to_satpam_for_bonkar btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-check">Initial Tonnage</i>
                </a>';
                }
            })
            ->rawColumns(['kode_po', 'tanggal_po', 'lokasi_bongkar', 'antrian', 'plat_kendaraan', 'created_at'])
            ->make(true);
    }

    public function to_satpam_for_bonkar($id)
    {
        $data = Lab1GabahBasah::where('lab1_id_penerimaan_po_gb', $id)->first();
        $data_notif = 'Please waiting process lab';
        if (!$data) {
            return json_encode($data_notif);
        } else {
            return json_encode($data);
        }
    }
    public function get_notifikasisecurity()
    {
        $data = NotifSecurity::where('status', 0)->get();
        return json_encode($data);
    }
    public function get_countnotifikasisecurity()
    {
        $data = NotifSecurity::where('status', 0)->count();
        return json_encode($data);
    }

    public function set_notifikasisecurity(request $request)
    {
        $id = $request->id;
        NotifSecurity::where('id_notif', $id)->update(['status' => 1]);
        return redirect()->route('security.gabah_basah');
    }

    public function new_notifikasisecurity()
    {
        $data = NotifSecurity::where('notifbaru', 0)->get();
        NotifSecurity::where('notifbaru', 0)->update(['notifbaru' => 1]);
        return json_encode($data);
    }
    public function updateDeviceToken(Request $request)
    {
        Auth::user()->device_token =  $request->token;

        Auth::user()->save();

        return response()->json(['Token successfully stored.']);
    }
}
