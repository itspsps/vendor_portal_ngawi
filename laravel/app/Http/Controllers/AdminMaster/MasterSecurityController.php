<?php

namespace App\Http\Controllers\AdminMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPO;
use App\Models\LogAktivitySecurity;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Str;
use App\Models\PenerimaanPO;
use RealRashid\SweetAlert\Facades\Alert;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\DB;

class MasterSecurityController extends Controller
{
    public function gabah_kering()
    {
        $po_kemarin = DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 1)
            ->where('bid.name_bid', '=', 'GABAH KERING')
            ->where('bid.open_po', date('Y-m-d', strtotime('-1 days')))
            ->orderBy("id_data_po", "desc")
            ->get();


        return view('dashboard.admin_master.admin_security.gabah_kering', ['po_kemarin' => $po_kemarin]);
    }
    public function cetak_po($id)
    {
        $data = DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
            return view('dashboard.admin_master.admin_security.cetak_po_pk', ['data' => $data, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa, 'get_item' => $get_item]);
        } else {
            return view('dashboard.admin_master.admin_security.cetak_po', ['data' => $data, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa, 'get_item' => $get_item]);
        }
    }

    public function gabah_basah()
    {
        $date = date('Y-m-d H:i:s');
        $PONum = DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                    $get_id = DB::table('data_po')->where('PONum', $get->PONum)->update(['status_bid' => '5']);
                }

            );
            sleep(1);
            $result = $promise->wait();
            // insert Log Aktivity
            $data = new LogAktivitySecurity();
            $data->name_user                        = Auth::guard('master')->user()->name_master;
            $data->id_objek_aktivitas_security     = $get->id_data_po;
            $data->aktivitas_security              = 'Close PO: ' . $get->kode_po;
            $data->keterangan_aktivitas             = 'Selesai';
            $data->created_at                       = date('Y-m-d H:i:s');
            $data->save();
        }

        return view('dashboard.admin_master.admin_security.gabah_basah');
    }
    public function beras_pk()
    {
        $date = date('Y-m-d H:i:s');
        $PONum = DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                    $get_id = DB::table('data_po')->where('PONum', $get->PONum)->update(['status_bid' => '5']);
                }

            );
            sleep(1);
            $result = $promise->wait();
            // insert Log Aktivity
            $data = new LogAktivitySecurity();
            $data->name_user                        = Auth::guard('master')->user()->name_master;
            $data->id_objek_aktivitas_security     = $get->id_data_po;
            $data->aktivitas_security              = 'Close PO: ' . $get->kode_po;
            $data->keterangan_aktivitas             = 'Selesai';
            $data->created_at                       = date('Y-m-d H:i:s');
            $data->save();
        }

        $po_kemarin = DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 1)
            ->where('bid.name_bid', 'like', '%BERAS PECAH KULIT%')
            ->where('bid.open_po', date('Y-m-d', strtotime('-1 days')))
            ->orderBy("id_data_po", "desc")
            ->get();

        $po_besok = DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 1)
            ->where('bid.name_bid', 'like', '%BERAS PECAH KULIT%')
            ->where('bid.open_po', date('Y-m-d', strtotime('+1 days')))
            ->orderBy("id_data_po", "desc")
            ->get();
        return view('dashboard.admin_master.admin_security.beras_pk', ['po_kemarin' => $po_kemarin, 'po_besok' => $po_besok]);
    }
    public function beras_ds_urgent()
    {
        $date = date('Y-m-d H:i:s');
        $PONum = DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                    $get_id = DB::table('data_po')->where('PONum', $get->PONum)->update(['status_bid' => '5']);
                }

            );
            sleep(1);
            $result = $promise->wait();
            // insert Log Aktivity
            $data = new LogAktivitySecurity();
            $data->name_user                        = Auth::guard('master')->user()->name_master;
            $data->id_objek_aktivitas_security     = $get->id_data_po;
            $data->aktivitas_security              = 'Close PO: ' . $get->kode_po;
            $data->keterangan_aktivitas              = 'Selesai';
            $data->created_at                       = date('Y-m-d H:i:s');
            $data->save();
        }


        return view('dashboard.admin_master.admin_security.beras_ds_urgent');
    }
    public function beras_ds_noturgent()
    {
        return view('dashboard.admin_master.admin_security.beras_ds_noturgent');
    }
    public function gabahbasah_index_kemarin()
    {

        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        return view('dashboard.admin_master.admin_security.data_revisi');
    }


    public function show_penerimaan_po($id)
    {
        $check_penerimaan_po = DB::table('penerimaan_po')->where('penerimaan_id_data_po', $id)->first();
        //dd($check_penerimaan_po);
        if (!$check_penerimaan_po) {
            $data1 = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')->where('id_data_po', $id)->first();
            return json_encode($data1);
        } else {
            $data2 = DB::table('penerimaan_po')
                ->join('data_po', 'data_po.id_data_po', '=', 'penerimaan_po.penerimaan_id_data_po')
                ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                ->where('penerimaan_po.penerimaan_id_data_po', $id)
                ->first();
            return json_encode($data2);
        }
    }
    public function get_plan_hpp_gabah_basah($tanggal_po, $item)
    {
        // dd($item);
        $data = DB::table('plan_hpp_gabah_basah')
            ->where('nama_item', $item)
            ->where('waktu_plan_hpp_gb', $tanggal_po)
            ->get();
        return json_encode($data);
    }
    public function terima_data_po(Request $request)
    {
        // dd($request->all());
        $cek = DB::table('penerimaan_po')->where('penerimaan_kode_po', $request->penerimaan_kode_po)->first();
        $get_cetak = DB::table('data_po')->where('kode_po', $request->penerimaan_kode_po)->first();
        $params_antrian = DB::table('penerimaan_po')
            ->join('data_po', 'data_po.id_data_po', 'penerimaan_po.penerimaan_id_data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->where('data_po.tanggal_po', $request->tanggal_po)
            ->where('bid.name_bid', $request->nama_item)
            ->count();
        $antrian = ($params_antrian + 1);
        if (strlen((string) $antrian) == 1) {
            $no_antrian = '00' . ($antrian);
        } else if (strlen((string) $antrian) == 2) {
            $no_antrian = '0' . ($antrian);
        } else if (strlen((string) $antrian) == 3) {
            $no_antrian = $antrian;
        }
        if (empty($cek->penerimaan_kode_po)) {
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

            $update_status_data_po_TabelPO      = DB::table('data_po')->where('id_data_po', $request->penerimaan_id_data_po)->first();

            $log                               = new LogAktivitySecurity();
            $log->name_user                    = Auth::guard('master')->user()->name_master;
            $log->id_objek_aktivitas_security  = $data->id_penerimaan_po;
            $log->aktivitas_security           = 'Insert Penerimaan PO Kode PO:' . $request->penerimaan_kode_po . ' Nopol: ' . Str::upper($request->plat_kendaraan);
            $log->keterangan_aktivitas           = 'Selesai';
            $log->created_at                   = date('Y-m-d H:i:s');
            $log->save();
            if ($update_status_data_po_TabelPO->status_bid == 1) {
                $data = DB::table('data_po')->where('id_data_po', $request->penerimaan_id_data_po)->update(['nopol' => Str::upper($request->plat_kendaraan), 'status_bid' => $request->status_penerimaan]);
            }
            // return redirect()->route('security.cetak_po', $get_cetak->id_data_po);
        } else {
            $query = DB::table('penerimaan_po')->where('penerimaan_kode_po', $request->penerimaan_kode_po)->first();
            if ($query->status_penerimaan == 5) {
                $data = DB::table('penerimaan_po')->where('penerimaan_kode_po', $request->penerimaan_kode_po)->update(['status_penerimaan' => 3]);
                $update_status_data_po_TabelPO  = DB::table('data_po')->where('id_data_po', $request->penerimaan_id_data_po)->first();
                if ($update_status_data_po_TabelPO->status_bid == 1) {
                    $data = DB::table('data_po')->where('id_data_po', $request->penerimaan_id_data_po)->update(['nopol' => $request->plat_kendaraan, 'status_bid' => 3]);
                }
            }
            $log = new LogAktivitySecurity();
            $log->name_user                    = Auth::guard('master')->user()->name_master;
            $log->id_objek_aktivitas_security  = $query->id_penerimaan_po;
            $log->aktivitas_security           = 'Insert Penerimaan PO Terlambat Kode PO:' . $request->penerimaan_kode_po . ' Nopol: ' . Str::upper($request->plat_kendaraan);
            $log->keterangan_aktivitas           = 'Selesai';
            $log->created_at                   = date('Y-m-d H:i:s');
            $log->save();
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

        $update_status_data_po_TabelPO  = DB::table('data_po')->where('id_data_po', $request->penerimaan_id_data_po)->first();
        if ($update_status_data_po_TabelPO->status_bid == 1) {
            $data1 = DB::table('data_po')->where('id_data_po', $request->penerimaan_id_data_po)->update(['nopol' => $request->plat_kendaraan, 'status_bid' => 5]);
        }
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1500);
        // return redirect()->back();
    }

    public function po_diterima()
    {

        $po_diterima_kemarin = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')

            ->where('data_po.tanggal_po', date('Y-m-d', strtotime('-1 days')))
            ->where('penerimaan_po.status_penerimaan', '=', 3)
            ->orderBy('penerimaan_po.id_penerimaan_po', 'ASC')
            ->get();
        $po_diterima_besok = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')

            ->where('data_po.tanggal_po', date('Y-m-d', strtotime('+1 days')))
            ->where('penerimaan_po.status_penerimaan', '=', 3)
            ->orderBy('penerimaan_po.id_penerimaan_po', 'ASC')
            ->get();
        return view('dashboard.admin_master.admin_security.po_diterima', ['po_diterima_kemarin' => $po_diterima_kemarin, 'po_diterima_besok' => $po_diterima_besok]);
    }

    public function po_ditolak()
    {

        $po_ditolak_kemarin = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')

            ->where('data_po.tanggal_po', date('Y-m-d', strtotime('-1 days')))
            ->where('data_po.status_bid', 5)
            ->orderBy('data_po.id_data_po', 'DESC')
            ->get();
        $po_ditolak_besok = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')

            ->where('data_po.tanggal_po', date('Y-m-d', strtotime('+1 days')))
            ->where('data_po.status_bid', 5)
            ->orderBy('data_po.id_data_po', 'DESC')
            ->get();
        return view('dashboard.admin_master.admin_security.po_ditolak', ['po_ditolak_kemarin' => $po_ditolak_kemarin, 'po_ditolak_besok' => $po_ditolak_besok]);
    }

    public function po_diterima_index()
    {

        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('penerimaan_po.status_penerimaan', '=', 13)
            ->where('penerimaan_po.analisa', 'revisi')
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
        $data = DB::table('penerimaan_po')->where('id_penerimaan_po', $id)->first();
        return json_encode($data);
    }

    public function update_nopol(Request $req)
    {
        // Update Penerimaan PO
        $data                   = PenerimaanPO::where('id_penerimaan_po', $req->id_penerimaan_po)->first();
        $data->plat_kendaraan   = $req->plat_kendaraan;
        $data->status_revisi    = 1;
        $data->update();

        // Update Lab 2 
        $query = DB::table('lab2_gb')->where('lab2_kode_po_gb', $req->penerimaan_kode_po)
            ->update([
                'lab2_plat_gb' => $req->plat_kendaraan,
            ]);

        // Update Lab 1 
        $query = DB::table('lab1_gb')->where('lab1_kode_po_gb', $req->penerimaan_kode_po)
            ->update([
                'lab1_plat_gb' => $req->plat_kendaraan,
            ]);
        //  Update Data PO
        $query = DB::table('data_po')->where('kode_po', $req->penerimaan_kode_po)
            ->update([
                'nopol' => $req->plat_kendaraan,
            ]);
        return redirect()->back();
    }

    public function po_pending()
    {
        return view('dashboard.admin_master.admin_security.po_pending');
    }

    public function po_bongkar()
    {
        return view('dashboard.admin_master.admin_security.po_bongkar');
    }

    public function po_bongkar_index()
    {

        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        return view('dashboard.admin_master.admin_security.po_parkir');
    }

    public function po_parkir_index()
    {

        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        return view('dashboard.admin_master.admin_security.po_on_call');
    }

    public function po_on_call_index()
    {

        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

    public function to_satpam_for_bonkar($id)
    {
        $data = DB::table('lab1_gb')->where('lab1_id_penerimaan_po_gb', $id)->first();
        $data_notif = 'Please waiting process lab';
        if (!$data) {
            return json_encode($datdata_notifa);
        } else {
            return json_encode($data);
        }
    }
    // LOG ACTIVITY SECURITY
    public function log_activity_security()
    {
        return view('dashboard.admin_master.admin_security.log_activity_security ');
    }

    public function log_activity_security_index()
    {
        return Datatables::of(DB::table('log_aktivitas_security')
            ->orderby('id_aktivitas_security', 'desc')
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
