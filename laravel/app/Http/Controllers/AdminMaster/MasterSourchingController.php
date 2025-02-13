<?php

namespace App\Http\Controllers\AdminMaster;

use App\Exports\DataPesananPembelianAOL;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\ApproveBid;
use App\Models\Bid;
use App\Exports\DataSouchingDealGBExcel;
use App\Exports\DataSouchingDealPKExcel;
use App\Models\Broadcast;
use App\Models\District;
use App\Models\LogAktivitySourching;
use App\Models\Regency;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Village;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class MasterSourchingController extends Controller
{
    public function bid_gb_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return DataTables::of(Bid::query()

                    ->whereBetween('open_po', array($request->from_date, $request->to_date))
                    ->where('name_bid', 'LIKE', '%GABAH BASAH%')
                    ->orderBy("id_bid", 'desc'))
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('open_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('start_pengajuan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->date_bid)->isoFormat('DD-MM-Y');
                        $result_time = \Carbon\Carbon::parse($list->date_bid)->isoFormat('hh:mm:ss');
                        return $result . '<span class="btn btn-sm btn-label-success"><b>' . $result_time . '</b></span>';
                    })
                    ->addColumn('close_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->batas_bid)->isoFormat('DD-MM-Y');
                        $result_time = \Carbon\Carbon::parse($list->batas_bid)->isoFormat('HH:mm:ss');
                        return $result . '<span class="btn btn-sm btn-label-danger"><b>' . $result_time . '</b></span>';
                    })
                    ->addColumn('kuota', function ($list) {
                        $result = $list->jumlah;
                        $jumlahtruk = $result / 8000;
                        return tonase($result) . '<br>(' . $jumlahtruk . ' Truk)';
                    })
                    ->addColumn('total_kuota', function ($list) {
                        $jumlah = $list->jumlah;
                        $kuota = $list->add_kuota;
                        $total = $jumlah + $kuota;
                        $jumlahtruk = $total / 8000;
                        return tonase($total) . '<br>(' . $jumlahtruk . ' Truk)';
                    })
                    ->addColumn('kuota_tambahan', function ($list) {
                        $result = $list->add_kuota;
                        $date = $list->batas_bid;
                        $jumlahtruk = $result / 8000;
                        if ($date >= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {

                            if ($result == '' || $result == null) {
                                return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                        </button>';
                            } else {
                                return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-pen-alt"></i>' . $result . '&nbsp;Kg<br>(' . $jumlahtruk . '&nbsp;Truk)
                                        </button><a href="javascript:void(0)" data-id="' . $list->id_bid . '" id="btn_delete_kuota" title="Hapus Kuota"><i class="fa fa-times text-danger"></i></a>';
                            }
                        } else if ($date <= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                            if ($result == '' || $result == null) {
                                return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                    </button>';
                            } else {
                                return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-pen-alt"></i>' . $result . '&nbsp;Kg<br>(' . $jumlahtruk . '&nbsp;Truk)
                                        </button>';
                            }
                        }
                    })
                    ->addColumn('list_po', function ($list) {
                        $data_count = DB::table('data_po')
                            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                            ->join('users', 'users.id', '=', 'data_po.user_idbid')
                            ->where('data_po.bid_id', $list->id_bid)
                            ->count();
                        return '
                            <div style="position:relative;">
                            <a style="margin:2px;" href="' . route('master.list_approve_po', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" style="position: relative;" class="toyakin btn btn-outline-dark m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <div style="position:absolute;">
                            <span class="badge " style="left:80px; margin-top:-20px; float:right; background: #9f187c; color: white;">' . $data_count . '</span>
                            </div>
                            <i class="fa fa-list">&nbsp;Daftar&nbsp;PO</i>
                            </a>
                            </div>
                            ';
                    })
                    ->addColumn('batas_bid', function ($list) {
                        $result = $list->batas_bid;
                        if ($result >= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                            if ($list->bid_status == 1) {
                                return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-check-circle">Active</i>
                                </button>';
                            } else {
                                return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times-circle">Off</i>
                                </button>';
                            }
                        } else if ($result <= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                            if ($list->bid_status == 1) {
                                return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-check-circle">Active </i>
                                    </button>';
                            } else {
                                return '<button id="btn_status1"  style="margin:2px;" data-offset="5px 5px" data-toggle="m-tooltip" title="information" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-times-circle">Off</i>
                                    </button>';
                            }
                        }
                    })
                    ->addColumn('image_bid', function ($list) {
                        $img = url('public/img/bid/' . $list->image_bid);
                        if (is_null($list->image_bid)) {
                        } else
                            return '
                                <img src="' . $img . '" width="100px"/>
                            ';
                    })
                    ->addColumn('description_bid', function ($list) {
                        $result = $list->description_bid;
                        return $result;
                    })
                    ->addColumn('response', function ($list) {
                        $data_count = DB::table('bid_user')
                            ->join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
                            ->join('users', 'id', '=', 'bid_user.user_id')
                            ->where('id_bid', $list->id_bid)
                            ->where('status_biduser', 0)
                            ->count();
                        return '
                            <div style="position:relative;">
                            <a style="margin:2px;" href="' . route('master.bid_response', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <div style="position:absolute;">
                            <span class="badge" style="left:110px; margin-top:-20px; float:right; background: #9f187c; color: white;">' . $data_count . '</span>
                            </div>    
                            <i class="fa fa-eye">&nbsp;List&nbsp;Pengajuan</i>
                            </a>
                            </div>';
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->bid_status == 1) {
                            return '
                                <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->date_bid)->format('Y-m-d') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                                </a>
                                <a style="margin:2px;" id="btn_information"  title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times" style="color:#DC143C;"></i>
                                </a>
                                ';
                        } else {
                            return '
                                <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->date_bid)->format('Y-m-d') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                                </a>
                                <a style="margin:2px;" name="btn_delete" id="btn_delete" data-bidid="' . $list->id_bid . '"  title="Hapus Data" class="btn_delete btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times" style="color:#DC143C;"></i>
                                </a>
                                ';
                        }
                    })
                    ->rawColumns(['name_bid', 'total_kuota', 'open_po', 'kuota_tambahan', 'kuota', 'close_po', 'start_pengajuan', 'list_po', 'batas_bid', 'image_bid', 'response', 'ckelola'])
                    ->make(true);
            } else {
                return Datatables::of(Bid::query()
                    ->where('name_bid', 'LIKE', '%GABAH BASAH%')
                    ->orderBy("id_bid", 'desc'))
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('open_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('start_pengajuan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->date_bid)->isoFormat('DD-MM-Y');
                        $result_time = \Carbon\Carbon::parse($list->date_bid)->isoFormat('hh:mm:ss');
                        return $result . '<span class="btn btn-sm btn-label-success"><b>' . $result_time . '</b></span>';
                    })
                    ->addColumn('close_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->batas_bid)->isoFormat('DD-MM-Y');
                        $result_time = \Carbon\Carbon::parse($list->batas_bid)->isoFormat('HH:mm:ss');
                        return $result . '<span class="btn btn-sm btn-label-danger"><b>' . $result_time . '</b></span>';
                    })
                    ->addColumn('kuota', function ($list) {
                        $result = $list->jumlah;
                        $jumlahtruk = $result / 8000;
                        return tonase($result) . '<br>(' . $jumlahtruk . ' Truk)';
                    })
                    ->addColumn('total_kuota', function ($list) {
                        $jumlah = $list->jumlah;
                        $kuota = $list->add_kuota;
                        $total = $jumlah + $kuota;
                        $jumlahtruk = $total / 8000;
                        return tonase($total) . '<br>(' . $jumlahtruk . ' Truk)';
                    })
                    ->addColumn('kuota_tambahan', function ($list) {
                        $result = $list->add_kuota;
                        $date = $list->batas_bid;
                        $jumlahtruk = $result / 8000;
                        if ($date >= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {

                            if ($result == '' || $result == null) {
                                return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                        </button>';
                            } else {
                                return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-pen-alt"></i>' . $result . '&nbsp;Kg<br>(' . $jumlahtruk . '&nbsp;Truk)
                                        </button><a href="javascript:void(0)" data-id="' . $list->id_bid . '" id="btn_delete_kuota" title="Hapus Kuota"><i class="fa fa-times text-danger"></i></a>';
                            }
                        } else if ($date <= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                            if ($result == '' || $result == null) {
                                return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                    </button>';
                            } else {
                                return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-pen-alt"></i>' . $result . '&nbsp;Kg<br>(' . $jumlahtruk . '&nbsp;Truk)
                                        </button>';
                            }
                        }
                    })
                    ->addColumn('list_po', function ($list) {
                        $data_count = DB::table('data_po')
                            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                            ->join('users', 'users.id', '=', 'data_po.user_idbid')
                            ->where('data_po.bid_id', $list->id_bid)
                            ->count();
                        return '
                            <div style="position:relative;">
                            <a style="margin:2px;" href="' . route('master.list_approve_po', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" style="position: relative;" class="toyakin btn btn-outline-dark m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <div style="position:absolute;">
                            <span class="badge" style="left:80px; margin-top:-20px; float:right; background: #9f187c; color: white;">' . $data_count . '</span>
                            </div>
                            <i class="fa fa-list">&nbsp;Daftar&nbsp;PO</i>
                            </a>
                            </div>
                            ';
                    })
                    ->addColumn('batas_bid', function ($list) {
                        $result = $list->batas_bid;
                        if ($result >= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                            if ($list->bid_status == 1) {
                                return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-check-circle">Active</i>
                                </button>';
                            } else {
                                return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times-circle">Off</i>
                                </button>';
                            }
                        } else if ($result <= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                            if ($list->bid_status == 1) {
                                return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-check-circle">Active </i>
                                    </button>';
                            } else {
                                return '<button id="btn_status1"  style="margin:2px;" data-offset="5px 5px" data-toggle="m-tooltip" title="information" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-times-circle">Off</i>
                                    </button>';
                            }
                        }
                    })
                    ->addColumn('image_bid', function ($list) {
                        $img = url('public/img/bid/' . $list->image_bid);
                        if (is_null($list->image_bid)) {
                        } else
                            return '
                                    <img src="' . $img . '" width="100px"/>
                                ';
                    })
                    ->addColumn('description_bid', function ($list) {
                        $result = $list->description_bid;
                        return $result;
                    })
                    ->addColumn('response', function ($list) {
                        $data_count = DB::table('bid_user')
                            ->join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
                            ->join('users', 'id', '=', 'bid_user.user_id')
                            ->where('id_bid', $list->id_bid)
                            ->where('status_biduser', 0)
                            ->count();
                        return '
                            <div style="position:relative;">
                            <a style="margin:2px;" href="' . route('master.bid_response', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <div style="position:absolute;">
                            <span class="badge" style="left:110px; margin-top:-20px; float:right; background: #9f187c; color: white;">' . $data_count . '</span>
                            </div>    
                            <i class="fa fa-eye">&nbsp;List&nbsp;Pengajuan</i>
                            </a>
                            </div>';
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->bid_status == 1) {
                            return '
                                <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->date_bid)->format('Y-m-d') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                                </a>
                                <a style="margin:2px;" id="btn_information"  title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times" style="color:#DC143C;"></i>
                                </a>
                                ';
                        } else {
                            return '
                                <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->date_bid)->format('Y-m-d') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                                </a>
                                <a style="margin:2px;" name="btn_delete" id="btn_delete" data-bidid="' . $list->id_bid . '"  title="Hapus Data" class="btn_delete btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times" style="color:#DC143C;"></i>
                                </a>
                                ';
                        }
                    })
                    ->rawColumns(['name_bid', 'total_kuota', 'open_po', 'close_po', 'start_pengajuan', 'kuota', 'kuota_tambahan', 'list_po', 'batas_bid', 'image_bid', 'response', 'ckelola'])
                    ->make(true);
            }
        }
    }
    public function bid_pk_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(Bid::query()

                    ->whereBetween('open_po', array($request->from_date, $request->to_date))
                    ->where('name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->orderBy("id_bid", 'desc'))
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('open_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('start_pengajuan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->date_bid)->isoFormat('DD-MM-Y hh:mm:ss');
                        return $result;
                    })
                    ->addColumn('close_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->batas_bid)->isoFormat('DD-MM-Y HH:mm:ss');
                        return $result;
                    })
                    ->addColumn('kuota', function ($list) {
                        $result = $list->jumlah;
                        $jumlahtruk = $result / 8000;
                        return tonase($result) . '<br>(' . $jumlahtruk . ' Truk)';
                    })
                    ->addColumn('total_kuota', function ($list) {
                        $jumlah = $list->jumlah;
                        $kuota = $list->add_kuota;
                        $total = $jumlah + $kuota;
                        $jumlahtruk = $total / 8000;
                        return tonase($total) . '<br>(' . $jumlahtruk . ' Truk)';
                    })
                    ->addColumn('kuota_tambahan', function ($list) {
                        $result = $list->add_kuota;
                        $date = $list->batas_bid;
                        $jumlahtruk = $result / 8000;
                        if ($date >= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {

                            if ($result == '' || $result == null) {
                                return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                        </button>';
                            } else {
                                return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-pen-alt"></i>' . $result . '&nbsp;Kg<br>(' . $jumlahtruk . '&nbsp;Truk)
                                        </button><a href="javascript:void(0)" data-id="' . $list->id_bid . '" id="btn_delete_kuota" title="Hapus Kuota"><i class="fa fa-times text-danger"></i></a>';
                            }
                        } else if ($date <= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                            if ($result == '' || $result == null) {
                                return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                    </button>';
                            } else {
                                return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-pen-alt"></i>' . $result . '&nbsp;Kg<br>(' . $jumlahtruk . '&nbsp;Truk)
                                        </button>';
                            }
                        }
                    })
                    ->addColumn('list_po', function ($list) {
                        $data_count = DB::table('data_po')
                            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                            ->join('users', 'users.id', '=', 'data_po.user_idbid')
                            ->where('data_po.bid_id', $list->id_bid)
                            ->count();
                        return '
                            <div style="position:relative;">
                            <a style="margin:2px;" href="' . route('master.list_approve_po', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" style="position: relative;" class="toyakin btn btn-outline-dark m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <div style="position:absolute;">
                            <span class="badge" style="left:80px; margin-top:-20px; float:right; background: #9f187c; color: white;">' . $data_count . '</span>
                            </div>
                            <i class="fa fa-list">&nbsp;Daftar&nbsp;PO</i>
                            </a>
                            </div>
                            ';
                    })
                    ->addColumn('batas_bid', function ($list) {
                        $result = $list->batas_bid;
                        if ($result >= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                            if ($list->bid_status == 1) {
                                return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-check-circle">Active</i>
                                </button>';
                            } else {
                                return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times-circle">Off</i>
                                </button>';
                            }
                        } else if ($result <= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                            if ($list->bid_status == 1) {
                                return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-check-circle">Active </i>
                                    </button>';
                            } else {
                                return '<button id="btn_status1"  style="margin:2px;" data-offset="5px 5px" data-toggle="m-tooltip" title="information" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-times-circle">Off</i>
                                    </button>';
                            }
                        }
                    })
                    ->addColumn('image_bid', function ($list) {
                        $img = url('public/img/bid/' . $list->image_bid);
                        if (is_null($list->image_bid)) {
                        } else
                            return '
                                <img src="' . $img . '" width="100px"/>
                            ';
                    })
                    ->addColumn('description_bid', function ($list) {
                        $result = $list->description_bid;
                        return $result;
                    })
                    ->addColumn('response', function ($list) {
                        $data_count = DB::table('bid_user')
                            ->join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
                            ->join('users', 'id', '=', 'bid_user.user_id')
                            ->where('id_bid', $list->id_bid)
                            ->where('status_biduser', 0)
                            ->count();
                        return '
                            <div style="position:relative;">
                            <a style="margin:2px;" href="' . route('master.bid_response', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <div style="position:absolute;">
                            <span class="badge" style="left:110px; margin-top:-20px; float:right; background: #9f187c; color: white;">' . $data_count . '</span>
                            </div>    
                            <i class="fa fa-eye">&nbsp;List&nbsp;Pengajuan</i>
                            </a>
                            </div>';
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->bid_status == 1) {
                            return '
                                <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->date_bid)->format('Y-m-d') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                                </a>
                                <a style="margin:2px;" id="btn_information"  title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times" style="color:#DC143C;"></i>
                                </a>
                                ';
                        } else {
                            return '
                                <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->date_bid)->format('Y-m-d') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                                </a>
                                <a style="margin:2px;" name="btn_delete" id="btn_delete" data-bidid="' . $list->id_bid . '"  title="Hapus Data" class="btn_delete btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times" style="color:#DC143C;"></i>
                                </a>
                                ';
                        }
                    })
                    ->rawColumns(['name_bid', 'total_kuota', 'open_po', 'kuota_tambahan', 'kuota', 'close_po', 'start_pengajuan', 'list_po', 'batas_bid', 'image_bid', 'response', 'ckelola'])
                    ->make(true);
            } else {
                return Datatables::of(Bid::query()
                    ->where('name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->orderBy("id_bid", 'desc'))
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('open_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('start_pengajuan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->date_bid)->isoFormat('DD-MM-Y hh:mm:ss');
                        return $result;
                    })
                    ->addColumn('close_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->batas_bid)->isoFormat('DD-MM-Y HH:mm:ss');
                        return $result;
                    })
                    ->addColumn('kuota', function ($list) {
                        $result = $list->jumlah;
                        $jumlahtruk = $result / 8000;
                        return tonase($result) . '<br>(' . $jumlahtruk . ' Truk)';
                    })
                    ->addColumn('total_kuota', function ($list) {
                        $jumlah = $list->jumlah;
                        $kuota = $list->add_kuota;
                        $total = $jumlah + $kuota;
                        $jumlahtruk = $total / 8000;
                        return tonase($total) . '<br>(' . $jumlahtruk . ' Truk)';
                    })
                    ->addColumn('kuota_tambahan', function ($list) {
                        $result = $list->add_kuota;
                        $date = $list->batas_bid;
                        $jumlahtruk = $result / 8000;
                        if ($date >= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {

                            if ($result == '' || $result == null) {
                                return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                        </button>';
                            } else {
                                return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-pen-alt"></i>' . $result . '&nbsp;Kg<br>(' . $jumlahtruk . '&nbsp;Truk)
                                        </button><a href="javascript:void(0)" data-id="' . $list->id_bid . '" id="btn_delete_kuota" title="Hapus Kuota"><i class="fa fa-times text-danger"></i></a>';
                            }
                        } else if ($date <= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                            if ($result == '' || $result == null) {
                                return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                    </button>';
                            } else {
                                return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-pen-alt"></i>' . $result . '&nbsp;Kg<br>(' . $jumlahtruk . '&nbsp;Truk)
                                        </button>';
                            }
                        }
                    })
                    ->addColumn('list_po', function ($list) {
                        $data_count = DB::table('data_po')
                            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                            ->join('users', 'users.id', '=', 'data_po.user_idbid')
                            ->where('data_po.bid_id', $list->id_bid)
                            ->count();
                        return '
                            <div style="position:relative;">
                            <a style="margin:2px;" href="' . route('master.list_approve_po', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" style="position: relative;" class="toyakin btn btn-outline-dark m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <div style="position:absolute;">
                            <span class="badge" style="left:80px; margin-top:-20px; float:right; background: #9f187c; color: white;">' . $data_count . '</span>
                            </div>
                            <i class="fa fa-list">&nbsp;Daftar&nbsp;PO</i>
                            </a>
                            </div>
                            ';
                    })
                    ->addColumn('batas_bid', function ($list) {
                        $result = $list->batas_bid;
                        if ($result >= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                            if ($list->bid_status == 1) {
                                return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-check-circle">Active</i>
                                </button>';
                            } else {
                                return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times-circle">Off</i>
                                </button>';
                            }
                        } else if ($result <= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                            if ($list->bid_status == 1) {
                                return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-check-circle">Active </i>
                                    </button>';
                            } else {
                                return '<button id="btn_status1"  style="margin:2px;" data-offset="5px 5px" data-toggle="m-tooltip" title="information" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-times-circle">Off</i>
                                    </button>';
                            }
                        }
                    })
                    ->addColumn('image_bid', function ($list) {
                        $img = url('public/img/bid/' . $list->image_bid);
                        if (is_null($list->image_bid)) {
                        } else
                            return '
                                    <img src="' . $img . '" width="100px"/>
                                ';
                    })
                    ->addColumn('description_bid', function ($list) {
                        $result = $list->description_bid;
                        return $result;
                    })
                    ->addColumn('response', function ($list) {
                        $data_count = DB::table('bid_user')
                            ->join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
                            ->join('users', 'id', '=', 'bid_user.user_id')
                            ->where('id_bid', $list->id_bid)
                            ->where('status_biduser', 0)
                            ->count();
                        return '
                            <div style="position:relative;">
                            <a style="margin:2px;" href="' . route('master.bid_response', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <div style="position:absolute;">
                            <span class="badge" style="left:110px; margin-top:-20px; float:right; background: #9f187c; color: white;">' . $data_count . '</span>
                            </div>    
                            <i class="fa fa-eye">&nbsp;List&nbsp;Pengajuan</i>
                            </a>
                            </div>';
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->bid_status == 1) {
                            return '
                                <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->date_bid)->format('Y-m-d') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                                </a>
                                <a style="margin:2px;" id="btn_information"  title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times" style="color:#DC143C;"></i>
                                </a>
                                ';
                        } else {
                            return '
                                <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->date_bid)->format('Y-m-d') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                                </a>
                                <a style="margin:2px;" name="btn_delete" id="btn_delete" data-bidid="' . $list->id_bid . '"  title="Hapus Data" class="btn_delete btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times" style="color:#DC143C;"></i>
                                </a>
                                ';
                        }
                    })
                    ->rawColumns(['name_bid', 'total_kuota', 'open_po', 'close_po', 'start_pengajuan', 'kuota', 'kuota_tambahan', 'list_po', 'batas_bid', 'image_bid', 'response', 'ckelola'])
                    ->make(true);
            }
        }
    }
    public function bid_ds_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(Bid::query()

                    ->whereBetween('open_po', array($request->from_date, $request->to_date))
                    ->where('name_bid', 'LIKE', '%BERAS DS%')
                    ->orderBy("id_bid", 'desc'))
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('open_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('start_pengajuan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->date_bid)->isoFormat('DD-MM-Y hh:mm:ss');
                        return $result;
                    })
                    ->addColumn('close_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->batas_bid)->isoFormat('DD-MM-Y HH:mm:ss');
                        return $result;
                    })
                    ->addColumn('total_kuota', function ($list) {
                        $jumlah = $list->jumlah;
                        $kuota = $list->add_kuota;
                        $total = $jumlah + $kuota;
                        $jumlahtruk = $total / 8000;
                        return tonase($total) . '<br>(' . $jumlahtruk . ' Truk)';
                    })
                    ->addColumn('kuota', function ($list) {
                        $result = $list->jumlah;
                        $jumlahtruk = $result / 8000;
                        return tonase($result) . '<br>(' . $jumlahtruk . ' Truk)';
                    })
                    ->addColumn('kuota_tambahan', function ($list) {
                        $result = $list->add_kuota;
                        $date = $list->batas_bid;
                        $jumlahtruk = $result / 8000;
                        if ($date >= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {

                            if ($result == '' || $result == null) {
                                return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                        </button>';
                            } else {
                                return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-pen-alt"></i>' . $result . '&nbsp;Kg<br>(' . $jumlahtruk . '&nbsp;Truk)
                                        </button><a href="javascript:void(0)" data-id="' . $list->id_bid . '" id="btn_delete_kuota" title="Hapus Kuota"><i class="fa fa-times text-danger"></i></a>';
                            }
                        } else if ($date <= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                            if ($result == '' || $result == null) {
                                return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                    </button>';
                            } else {
                                return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-pen-alt"></i>' . $result . '&nbsp;Kg<br>(' . $jumlahtruk . '&nbsp;Truk)
                                        </button>';
                            }
                        }
                    })
                    ->addColumn('list_po', function ($list) {
                        $data_count = DB::table('data_po')
                            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                            ->join('users', 'users.id', '=', 'data_po.user_idbid')
                            ->where('data_po.bid_id', $list->id_bid)
                            ->count();
                        return '
                            <div style="position:relative;">
                            <a style="margin:2px;" href="' . route('master.list_approve_po', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" style="position: relative;" class="toyakin btn btn-outline-dark m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <div style="position:absolute;">
                            <span class="badge" style="left:80px; margin-top:-20px; float:right; background: #9f187c; color: white;">' . $data_count . '</span>
                            </div>
                            <i class="fa fa-list">&nbsp;Daftar&nbsp;PO</i>
                            </a>
                            </div>
                            ';
                    })
                    ->addColumn('batas_bid', function ($list) {
                        $result = $list->batas_bid;
                        if ($result >= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                            if ($list->bid_status == 1) {
                                return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-check-circle">Active</i>
                                </button>';
                            } else {
                                return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times-circle">Off</i>
                                </button>';
                            }
                        } else if ($result <= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                            if ($list->bid_status == 1) {
                                return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-check-circle">Active </i>
                                    </button>';
                            } else {
                                return '<button id="btn_status1"  style="margin:2px;" data-offset="5px 5px" data-toggle="m-tooltip" title="information" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-times-circle">Off</i>
                                    </button>';
                            }
                        }
                    })
                    ->addColumn('image_bid', function ($list) {
                        $img = url('public/img/bid/' . $list->image_bid);
                        if (is_null($list->image_bid)) {
                        } else
                            return '
                                <img src="' . $img . '" width="100px"/>
                            ';
                    })
                    ->addColumn('description_bid', function ($list) {
                        $result = $list->description_bid;
                        return $result;
                    })
                    ->addColumn('response', function ($list) {
                        $data_count = DB::table('bid_user')
                            ->join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
                            ->join('users', 'id', '=', 'bid_user.user_id')
                            ->where('id_bid', $list->id_bid)
                            ->where('status_biduser', 0)
                            ->count();
                        return '
                            <div style="position:relative;">
                            <a style="margin:2px;" href="' . route('master.bid_response', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <div style="position:absolute;">
                            <span class="badge" style="left:110px; margin-top:-20px; float:right; background: #9f187c; color: white;">' . $data_count . '</span>
                            </div>    
                            <i class="fa fa-eye">&nbsp;List&nbsp;Pengajuan</i>
                            </a>
                            </div>';
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->bid_status == 1) {
                            return '
                                <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->date_bid)->format('Y-m-d') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                                </a>
                                <a style="margin:2px;" id="btn_information"  title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times" style="color:#DC143C;"></i>
                                </a>
                                ';
                        } else {
                            return '
                                <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->date_bid)->format('Y-m-d') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                                </a>
                                <a style="margin:2px;" name="btn_delete" id="btn_delete" data-bidid="' . $list->id_bid . '"  title="Hapus Data" class="btn_delete btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times" style="color:#DC143C;"></i>
                                </a>
                                ';
                        }
                    })
                    ->rawColumns(['name_bid', 'total_kuota', 'open_po', 'kuota_tambahan', 'kuota', 'close_po', 'start_pengajuan', 'list_po', 'batas_bid', 'image_bid', 'response', 'ckelola'])
                    ->make(true);
            } else {
                return Datatables::of(Bid::query()
                    ->where('name_bid', 'LIKE', '%BERAS DS%')
                    ->orderBy("id_bid", 'desc'))
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('open_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->open_po)->isoFormat('DD-MM-Y');
                        return $result;
                    })
                    ->addColumn('start_pengajuan', function ($list) {
                        $result = \Carbon\Carbon::parse($list->date_bid)->isoFormat('DD-MM-Y hh:mm:ss');
                        return $result;
                    })
                    ->addColumn('close_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->batas_bid)->isoFormat('DD-MM-Y HH:mm:ss');
                        return $result;
                    })
                    ->addColumn('kuota', function ($list) {
                        $result = $list->jumlah;
                        $jumlahtruk = $result / 8000;
                        return tonase($result) . '<br>(' . $jumlahtruk . ' Truk)';
                    })
                    ->addColumn('total_kuota', function ($list) {
                        $jumlah = $list->jumlah;
                        $kuota = $list->add_kuota;
                        $total = $jumlah + $kuota;
                        $jumlahtruk = $total / 8000;
                        return tonase($total) . '<br>(' . $jumlahtruk . ' Truk)';
                    })
                    ->addColumn('kuota_tambahan', function ($list) {
                        $result = $list->add_kuota;
                        $date = $list->batas_bid;
                        $jumlahtruk = $result / 8000;
                        if ($date >= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {

                            if ($result == '' || $result == null) {
                                return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                        </button>';
                            } else {
                                return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-pen-alt"></i>' . $result . '&nbsp;Kg<br>(' . $jumlahtruk . '&nbsp;Truk)
                                        </button><a href="javascript:void(0)" data-id="' . $list->id_bid . '" id="btn_delete_kuota" title="Hapus Kuota"><i class="fa fa-times text-danger"></i></a>';
                            }
                        } else if ($date <= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                            if ($result == '' || $result == null) {
                                return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                    </button>';
                            } else {
                                return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-pen-alt"></i>' . $result . '&nbsp;Kg<br>(' . $jumlahtruk . '&nbsp;Truk)
                                        </button>';
                            }
                        }
                    })
                    ->addColumn('list_po', function ($list) {
                        $data_count = DB::table('data_po')
                            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                            ->join('users', 'users.id', '=', 'data_po.user_idbid')
                            ->where('data_po.bid_id', $list->id_bid)
                            ->count();
                        return '
                            <div style="position:relative;">
                            <a style="margin:2px;" href="' . route('master.list_approve_po', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" style="position: relative;" class="toyakin btn btn-outline-dark m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <div style="position:absolute;">
                            <span class="badge" style="left:80px; margin-top:-20px; float:right; background: #9f187c; color: white;">' . $data_count . '</span>
                            </div>
                            <i class="fa fa-list">&nbsp;Daftar&nbsp;PO</i>
                            </a>
                            </div>
                            ';
                    })
                    ->addColumn('batas_bid', function ($list) {
                        $result = $list->batas_bid;
                        if ($result >= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                            if ($list->bid_status == 1) {
                                return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-check-circle">Active</i>
                                </button>';
                            } else {
                                return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times-circle">Off</i>
                                </button>';
                            }
                        } else if ($result <= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                            if ($list->bid_status == 1) {
                                return '<button id="btn_status" style="margin:2px;" data-id="' . $list->id_bid . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Update status" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-check-circle">Active </i>
                                    </button>';
                            } else {
                                return '<button id="btn_status1"  style="margin:2px;" data-offset="5px 5px" data-toggle="m-tooltip" title="information" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-times-circle">Off</i>
                                    </button>';
                            }
                        }
                    })
                    ->addColumn('image_bid', function ($list) {
                        $img = url('public/img/bid/' . $list->image_bid);
                        if (is_null($list->image_bid)) {
                        } else
                            return '
                                    <img src="' . $img . '" width="100px"/>
                                ';
                    })
                    ->addColumn('description_bid', function ($list) {
                        $result = $list->description_bid;
                        return $result;
                    })
                    ->addColumn('response', function ($list) {
                        $data_count = DB::table('bid_user')
                            ->join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
                            ->join('users', 'id', '=', 'bid_user.user_id')
                            ->where('id_bid', $list->id_bid)
                            ->where('status_biduser', 0)
                            ->count();
                        return '
                            <div style="position:relative;">
                            <a style="margin:2px;" href="' . route('master.bid_response', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <div style="position:absolute;">
                            <span class="badge" style="left:110px; margin-top:-20px; float:right; background: #9f187c; color: white;">' . $data_count . '</span>
                            </div>    
                            <i class="fa fa-eye">&nbsp;List&nbsp;Pengajuan</i>
                            </a>
                            </div>';
                    })
                    ->addColumn('ckelola', function ($list) {
                        if ($list->bid_status == 1) {
                            return '
                                <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->date_bid)->format('Y-m-d') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                                </a>
                                <a style="margin:2px;" id="btn_information"  title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times" style="color:#DC143C;"></i>
                                </a>
                                ';
                        } else {
                            return '
                                <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->date_bid)->format('Y-m-d') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                                </a>
                                <a style="margin:2px;" name="btn_delete" id="btn_delete" data-bidid="' . $list->id_bid . '"  title="Hapus Data" class="btn_delete btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-times" style="color:#DC143C;"></i>
                                </a>
                                ';
                        }
                    })
                    ->rawColumns(['name_bid', 'total_kuota', 'open_po', 'close_po', 'start_pengajuan', 'kuota', 'kuota_tambahan', 'list_po', 'batas_bid', 'image_bid', 'response', 'ckelola'])
                    ->make(true);
            }
        }
    }
    public function data_list_index($id_bid)
    {
        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.bid_id', $id_bid)
            ->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('nopol', function ($list) {
                if ($list->nopol == '') {
                    return '
                        <span class="badge bg-warning text-dark">Belum Diinput Security</span>';
                } else {
                }
                $result = $list->nopol;
                return $result;
            })
            ->addColumn('status', function ($list) {
                if ($list->status_bid == 5) {
                    return '<span style="margin:2px;" class="badge badge-danger">Tolak</span>';
                } else if ($list->status_bid == 16) {
                    return '<button type="button" id="btn_lihat_harga" data-id="' . $list->id_data_po . '" data-hp="' . $list->nomer_hp  . '" data-nopol="' . $list->nopol  . '" data-supplier="' . $list->nama_vendor  . '" class="btn btn-light"><span style="margin:2px;" title="Lihat Harga" class="badge badge-warning">Pending Harga</span></button>';
                } else if ($list->status_bid == 1) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Proses&nbsp;Pengiriman</span>';
                } else if ($list->status_bid == 3) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Proses&nbsp;Lab&nbsp;1</span>';
                } else if ($list->status_bid == 6) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Selesai&nbsp;Lab1</span>';
                } else if ($list->status_bid == 7) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Truk&nbsp;Parkir</span>';
                } else if ($list->status_bid == 8) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Timbangan&nbsp;Masuk</span>';
                } else if ($list->status_bid == 9) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Proses&nbsp;Bongkar</span>';
                } else if ($list->status_bid == 10) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Timbangan&nbsp;Keluar/Lab&nbsp;2</span>';
                } else if ($list->status_bid == 11) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Selesai Lab2 /Timbangan</span>';
                } else if ($list->status_bid == 12) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Pengajuan Approve SPV QC</span>';
                } else if ($list->status_bid == 13) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Pembayaran</span>';
                } else {
                    return  '<span style="margin:2px;" class="badge badge-success">Bongkar</span>';
                }
            })
            ->addColumn('cetak', function ($list) {
                if ($list->status_bid == 5) {
                    return '<a href="cetak_po_sourching/' . $list->id_data_po . '" onclick="return false;" target="_blank" style="margin:2px;background-color:#9c0911" name="" title="Cetak PO" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-print" style="color:white;">&nbsp;Cetak&nbsp;PO</i>
                    </a>';
                } else {
                    return '<a href="cetak_po_sourching/' . $list->id_data_po . '" target="_blank" style="margin:2px;background-color:#9c0911" name="" title="Cetak PO" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-print" style="color:white;">&nbsp;Cetak&nbsp;PO</i>
                    </a>';
                }
            })

            ->rawColumns(['name_bid', 'nopol', 'tanggal_po', 'cetak', 'status'])
            ->make(true);
    }
    public function data_list_pk_index($id_bid)
    {
        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
            ->where('data_po.bid_id', $id_bid)
            ->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('status', function ($list) {
                if ($list->status_bid == 5) {
                    return '<span style="margin:2px;" class="badge badge-danger">Tolak</span>';
                } else if ($list->status_bid == 16) {
                    return '<button type="button" id="btn_lihat_harga" data-id="' . $list->id_data_po . '" class="btn btn-light"><span style="margin:2px;" title="Lihat Harga" class="badge badge-warning">Pending Harga</span></button>';
                } else if ($list->status_bid == 1) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Proses&nbsp;Pengiriman</span>';
                } else if ($list->status_bid == 3) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Proses&nbsp;Lab&nbsp;1</span>';
                } else if ($list->status_bid == 6) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Selesai&nbsp;Lab1</span>';
                } else if ($list->status_bid == 7) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Truk&nbsp;Parkir</span>';
                } else if ($list->status_bid == 8) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Timbangan&nbsp;Masuk</span>';
                } else if ($list->status_bid == 9) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Proses&nbsp;Bongkar</span>';
                } else if ($list->status_bid == 10) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Timbangan&nbsp;Keluar/Lab&nbsp;2</span>';
                } else if ($list->status_bid == 13) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Pembayaran</span>';
                } else {
                    return  '<span style="margin:2px;" class="badge badge-success">Bongkar</span>';
                }
            })
            ->addColumn('cetak', function ($list) {
                if ($list->status_bid == 5) {
                    return '<a href="cetak_po_sourching/' . $list->id_data_po . '" onclick="return false;" target="_blank" style="margin:2px;background-color:#9c0911" name="" title="Cetak PO" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-print" style="color:white;">&nbsp;Cetak&nbsp;PO</i>
                    </a>';
                } else {
                    return '<a href="cetak_po_sourching/' . $list->id_data_po . '" target="_blank" style="margin:2px;background-color:#9c0911" name="" title="Cetak PO" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-print" style="color:white;">&nbsp;Cetak&nbsp;PO</i>
                    </a>';
                }
            })

            ->rawColumns(['name_bid', 'tanggal_po', 'cetak', 'status'])
            ->make(true);
    }
    public function data_list_ds_index($id_bid)
    {
        return Datatables::of(DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('bid.name_bid', 'LIKE', '%BERAS DS%')
            ->where('data_po.bid_id', $id_bid)
            ->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('status', function ($list) {
                if ($list->status_bid == 5) {
                    return '<span style="margin:2px;" class="badge badge-danger">Tolak</span>';
                } else if ($list->status_bid == 16) {
                    return '<button type="button" id="btn_lihat_harga" data-id="' . $list->id_data_po . '" class="btn btn-light"><span style="margin:2px;" title="Lihat Harga" class="badge badge-warning">Pending Harga</span></button>';
                } else if ($list->status_bid == 1) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Proses&nbsp;Pengiriman</span>';
                } else if ($list->status_bid == 3) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Proses&nbsp;Lab&nbsp;1</span>';
                } else if ($list->status_bid == 6) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Selesai&nbsp;Lab1</span>';
                } else if ($list->status_bid == 7) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Truk&nbsp;Parkir</span>';
                } else if ($list->status_bid == 8) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Timbangan&nbsp;Masuk</span>';
                } else if ($list->status_bid == 9) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Proses&nbsp;Bongkar</span>';
                } else if ($list->status_bid == 10) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Timbangan&nbsp;Keluar/Lab&nbsp;2</span>';
                } else if ($list->status_bid == 13) {
                    return  '<span style="margin:2px;" class="badge badge-primary">Pembayaran</span>';
                } else {
                    return  '<span style="margin:2px;" class="badge badge-success">Bongkar</span>';
                }
            })
            ->addColumn('cetak', function ($list) {
                if ($list->status_bid == 5) {
                    return '<a href="cetak_po_sourching/' . $list->id_data_po . '" onclick="return false;" target="_blank" style="margin:2px;background-color:#9c0911" name="" title="Cetak PO" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-print" style="color:white;">&nbsp;Cetak&nbsp;PO</i>
                    </a>';
                } else {
                    return '<a href="cetak_po_sourching/' . $list->id_data_po . '" target="_blank" style="margin:2px;background-color:#9c0911" name="" title="Cetak PO" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-print" style="color:white;">&nbsp;Cetak&nbsp;PO</i>
                    </a>';
                }
            })

            ->rawColumns(['name_bid', 'tanggal_po', 'cetak', 'status'])
            ->make(true);
    }
    public function list_approve_po($id_bid)
    {

        // dd($data);
        return view('dashboard.admin_master.admin_sourching.bid.dt_approve_po', compact('id_bid'));
    }

    public function status_pending($id)
    {
        $data = DB::table('lab1_gb')->where('lab1_id_data_po_gb', $id)->first();
        // dd($data);
        return json_encode($data);
    }
    public function bid_status($id_bid)
    {
        $get = DB::table('bid')->where('id_bid', $id_bid)->first();
        // dd($data->name_bid);
        if ($get->bid_status == 1) {
            // insert Log Aktivity
            $data = new LogAktivitySourching();
            $data->name_user    = Auth::guard('master')->user()->name_master;
            $data->id_objek_aktivitas_sourching  = $get->id_bid;
            $data->aktivitas_sourching  = 'Non Aktifkan Lelang ' . $get->name_bid . ' PO ' . $get->open_po;
            $data->keterangan_aktivitas = 'Selesai';
            $data->created_at           = date('Y-m-d H:i:s');
            $data->save();
            $data1 = DB::table('bid')->where('id_bid', $id_bid)->update(['bid_status' => 0]);
            // return redirect()->back();
        } else {
            // insert Log Aktivity
            $data = new LogAktivitySourching();
            $data->name_user    = Auth::guard('master')->user()->name_master;
            $data->id_objek_aktivitas_sourching  = $get->id_bid;
            $data->aktivitas_sourching  = 'Mengaktifkan Lelang ' . $get->name_bid . ' PO ' . $get->open_po;
            $data->keterangan_aktivitas = 'Selesai';
            $data->created_at           = date('Y-m-d H:i:s');
            $data->save();
            $data2 = DB::table('bid')->where('id_bid', $id_bid)->update(['bid_status' => 1]);
            // return redirect()->back();
        }
    }
    public function add_kuota(Request $request)
    {
        $data = DB::table('bid')->where('id_bid', $request->id)->first();
        $query = DB::table('bid')->where('id_bid', $request->id)->update(['add_kuota' => $request->add_kuota]);
        // insert Log Aktivity
        $data = new LogAktivitySourching();
        $data->name_user    = Auth::guard('master')->user()->name_master;
        $data->id_objek_aktivitas_sourching  = $data->id_bid;
        $data->aktivitas_sourching  = 'Menambahkan Kuota Lelang ' . $data->name_bid . ' PO ' . $data->open_po . ' Kuota: ' . tonase($request->add_kuota);
        $data->keterangan_aktivitas   = 'Selesai';
        $data->created_at           = date('Y-m-d H:i:s');
        $data->save();
        return redirect()->back();
    }
    public function delete_add_kuota($id)
    {
        $data = DB::table('bid')->where('id_bid', $id)->first();
        $query = DB::table('bid')->where('id_bid', $id)->update(['add_kuota' => NULL]);
        // insert Log Aktivity
        $data = new LogAktivitySourching();
        $data->name_user    = Auth::guard('master')->user()->name_master;
        $data->id_objek_aktivitas_sourching  = $data->id_bid;
        $data->aktivitas_sourching  = 'Menghapus Kuota Lelang ' . $data->name_bid . ' PO ' . $data->open_po;
        $data->keterangan_aktivitas   = 'Selesai';
        $data->created_at           = date('Y-m-d H:i:s');
        $data->save();
        // return redirect()->back();
    }

    public function store(Request $request)
    {
        if (
            $request->name_bid == 'GABAH BASAH CIHERANG' || $request->name_bid == 'GABAH BASAH LONG GRAIN' || $request->name_bid == 'GABAH BASAH LONG GRAIN 50 KG' || $request->name_bid == 'GABAH BASAH LONG GRAIN JUMBO BAG' || $request->name_bid == 'GABAH BASAH PANDAN WANGI' || $request->name_bid == 'GABAH BASAH PANDAN WANGI 50 KG'
            || $request->name_bid == 'GABAH BASAH PANDAN WANGI JUMBO BAG' || $request->name_bid == 'GABAH BASAH PERA' || $request->name_bid == 'GABAH BASAH PERA 50 KG' || $request->name_bid == 'GABAH BASAH PERA JUMBO BAG' || $request->name_bid == 'GABAH BASAH KETAN PUTIH'
            || $request->name_bid == 'GABAH BASAH KETAN PUTIH 50 KG' || $request->name_bid == 'GABAH BASAH KETAN PUTIH JUMBO BAG'
        ) {
            $random_kode    = sprintf("%06d", mt_rand(1, 999999));
            $date_bid       = date("Y-m-d 08:00:00");
            $batas_bid      = date("Y-m-d 12:00:00", strtotime('+1 days'));
            $image          = $request->file('image_bid');
            $open_po        = date('Y-m-d', strtotime('+1 days'));
            $mulai_bid      = date('Y-m-d H:i:s', strtotime('+1 days'));

            $file           = $request->file('image_bid');
            $imageName      = time() . '.' . $request->image_bid->extension();
            $save           = $file->move('public/img/bid/', $imageName);
            $jml_kuota = ($request->jumlah * 8000);

            $bid                            = new Bid();
            $bid->name_bid                  = $request->name_bid;
            $bid->harga                     = $request->harga;
            $bid->jumlah                    = $jml_kuota;
            $bid->lokasi                    = $request->lokasi;
            $bid->open_po                   = $request->open_po;
            $bid->mulai_bid                 = \Carbon\Carbon::parse($request->date_bid)->isoFormat('Y-MM-DD 08:00:00');
            $bid->date_bid                  = \Carbon\Carbon::parse($request->date_bid)->isoFormat('Y-MM-DD hh:mm:ss');
            $bid->batas_bid                 = \Carbon\Carbon::parse($request->batas_bid)->isoFormat('Y-MM-DD 12:00:00');
            $bid->description_bid           = $request->description_bid;
            $bid->image_bid                 = $imageName;
            $bid->kode_bid                  = $random_kode;
            $bid->bid_status                = '1';
            $bid->save();

            // insert Log Aktivity
            $data = new LogAktivitySourching();
            $data->name_user    = Auth::guard('master')->user()->name_master;
            $data->id_objek_aktivitas_sourching  = $bid->id_bid;
            $data->aktivitas_sourching  = 'Insert Lelang ' . $request->name_bid . '. Tanggal PO : ' . $request->date_bid;
            $data->keterangan_aktivitas   = 'Selesai';
            $data->created_at           = date('Y-m-d H:i:s');
            $data->keterangan_aktivitas  = 'Selesai';
            $data->save();

            Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
            return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1500);
        } else if (
            $request->name_bid == 'GABAH KERING LONG GRAIN' || $request->name_bid == 'GABAH KERING LONG GRAIN 50 KG' || $request->name_bid == 'GABAH KERING LONG GRAIN JUMBO BAG' || $request->name_bid == 'GABAH KERING PANDAN WANGI' || $request->name_bid == 'GABAH KERING PANDAN WANGI 50 KG'
            || $request->name_bid == 'GABAH KERING PANDAN WANGI JUMBO BAG' || $request->name_bid == 'GABAH KERING PERA' || $request->name_bid == 'GABAH KERING PERA 50 KG' || $request->name_bid == 'GABAH KERING PERA JUMBO BAG' || $request->name_bid == 'GABAH KERING KETAN PUTIH'
            || $request->name_bid == 'GABAH KERING KETAN PUTIH 50 KG' || $request->name_bid == 'GABAH KERING KETAN PUTIH JUMBO BAG'
        ) {
            $random_kode    = sprintf("%06d", mt_rand(1, 999999));
            $date_bid       = date("Y-m-d 08:00:00");
            $batas_bid      = date("Y-m-d 23:59:00");
            $image          = $request->file('image_bid');
            $open_po        = date('Y-m-d 12:00:00');
            $mulai_bid      = date('Y-m-d H:i:s');

            $file           = $request->file('image_bid');
            $imageName      = time() . '.' . $request->image_bid->extension();
            $save           = $file->move('public/img/bid/', $imageName);
            $jml_kuota = ($request->jumlah * 8000);
            $bid                            = new Bid();
            $bid->name_bid                  = $request->name_bid;
            $bid->harga                     = $request->harga;
            $bid->jumlah                    = $jml_kuota;
            $bid->lokasi                    = $request->lokasi;
            $bid->open_po                   = $open_po;
            $bid->date_bid                  = $date_bid;
            $bid->mulai_bid                 = $mulai_bid;
            $bid->batas_bid                 = $batas_bid;
            $bid->description_bid           = $request->description_bid;
            $bid->image_bid                 = $imageName;
            $bid->kode_bid                  = $random_kode;
            $bid->bid_status                = '1';
            $bid->save();

            // insert Log Aktivity
            $data = new LogAktivitySourching();
            $data->name_user    = Auth::guard('master')->user()->name_master;
            $data->id_objek_aktivitas_sourching  = $bid->id_bid;
            $data->aktivitas_sourching  = 'Insert Lelang ' . $request->name_bid . '. Tanggal PO : ' . $request->date_bid;
            $data->keterangan_aktivitas   = 'Selesai';
            $data->created_at           = date('Y-m-d H:i:s');
            $data->keterangan_aktivitas  = 'Selesai';
            $data->save();

            Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
            return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1500);
        } else if (
            $request->name_bid == 'BERAS PECAH KULIT LONG GRAIN' || 'BERAS PECAH KULIT' || $request->name_bid == 'BERAS PECAH KULIT LONG GRAIN 50 KG' || $request->name_bid == 'BERAS PECAH KULIT LONG GRAIN JUMBO BAG' || $request->name_bid == 'BERAS PECAH KULIT PANDAN WANGI' || $request->name_bid == 'BERAS PECAH KULIT PANDAN WANGI 50 KG'
            || $request->name_bid == 'BERAS PECAH KULIT PANDAN WANGI JUMBO BAG' || $request->name_bid == 'BERAS PECAH KULIT PERA' || $request->name_bid == 'BERAS PECAH KULIT PERA 50 KG' || $request->name_bid == 'BERAS PECAH KULIT PERA JUMBO BAG' || $request->name_bid == 'BERAS PECAH KULIT KETAN PUTIH'
            || $request->name_bid == 'BERAS PECAH KULIT KETAN PUTIH 50 KG' || $request->name_bid == 'BERAS PECAH KULIT KETAN PUTIH JUMBO BAG'
        ) {
            $random_kode    = sprintf("%06d", mt_rand(1, 999999));
            $date_bid       = date("Y-m-d 08:00:00");
            $batas_bid      = date("Y-m-d 12:00:00", strtotime('+1 days'));
            $image          = $request->file('image_bid');
            $open_po        = date('Y-m-d', strtotime('+1 days'));
            $mulai_bid      = date('Y-m-d H:i:s', strtotime('+1 days'));

            $file           = $request->file('image_bid');
            $imageName      = time() . '.' . $request->image_bid->extension();
            $save           = $file->move('public/img/bid/', $imageName);
            $jml_kuota = ($request->jumlah * 8000);

            $bid                            = new Bid();
            $bid->name_bid                  = $request->name_bid;
            $bid->harga                     = $request->harga;
            $bid->jumlah                    = $jml_kuota;
            $bid->lokasi                    = $request->lokasi;
            $bid->open_po                   = $request->open_po;
            $bid->mulai_bid                 = \Carbon\Carbon::parse($request->date_bid)->isoFormat('Y-MM-DD 08:00:00');
            $bid->date_bid                  = \Carbon\Carbon::parse($request->date_bid)->isoFormat('Y-MM-DD hh:mm:ss');
            $bid->batas_bid                 = \Carbon\Carbon::parse($request->batas_bid)->isoFormat('Y-MM-DD 12:00:00');
            $bid->description_bid           = $request->description_bid;
            $bid->image_bid                 = $imageName;
            $bid->kode_bid                  = $random_kode;
            $bid->bid_status                = '1';
            $bid->save();

            // insert Log Aktivity
            $data = new LogAktivitySourching();
            $data->name_user    = Auth::guard('master')->user()->name_master;
            $data->id_objek_aktivitas_sourching  = $bid->id_bid;
            $data->aktivitas_sourching  = 'Insert Lelang ' . $request->name_bid . '. Tanggal PO : ' . $request->date_bid;
            $data->keterangan_aktivitas   = 'Selesai';
            $data->created_at           = date('Y-m-d H:i:s');
            $data->keterangan_aktivitas  = 'Selesai';
            $data->save();

            Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
            return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1500);
        } else {
            if ($request->pilihan == 1) {
                $random_kode    = sprintf("%06d", mt_rand(1, 999999));
                $date_bid       = date("Y-m-d 08:00:00");
                $batas_bid      = date("Y-m-d 12:00:00", strtotime('+1 days'));
                $image          = $request->file('image_bid');
                $open_po        = date('Y-m-d', strtotime('+1 days'));
                $mulai_bid      = date('Y-m-d H:i:s', strtotime('+1 days'));

                $file           = $request->file('image_bid');
                $imageName      = time() . '.' . $request->image_bid->extension();
                $save           = $file->move('public/img/bid/', $imageName);

                $bid                            = new Bid();
                $bid->name_bid                  = $request->name_bid;
                $bid->harga                     = $request->harga;
                $bid->jumlah                    = $request->jumlah;
                $bid->lokasi                    = $request->lokasi;
                $bid->open_po                   = $open_po;
                $bid->date_bid                  = $date_bid;
                $bid->mulai_bid                 = $mulai_bid;
                $bid->batas_bid                 = $batas_bid;
                $bid->description_bid           = $request->description_bid;
                $bid->image_bid                 = $imageName;
                $bid->kode_bid                  = $random_kode;
                $bid->bid_status                = '1';
                $bid->status_ds                 = $request->pilihan;
                $bid->save();

                // insert Log Aktivity
                $data = new LogAktivitySourching();
                $data->name_user    = Auth::guard('master')->user()->name_master;
                $data->aktivitas_sourching  = 'Insert Lelang ' . $request->name_bid . '. Tanggal PO : ' . $request->date_bid;
                $data->id_objek_aktivitas_sourching  = $bid->id_bid;
                $data->keterangan_aktivitas  = 'Selesai';
                $data->created_at           = date('Y-m-d H:i:s');
                $data->save();

                Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
                return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1500);
            } else {
                $random_kode    = sprintf("%06d", mt_rand(1, 999999));
                $date_bid       = date("Y-m-d 08:00:00");
                $batas_bid      = date("Y-m-d 12:00:00", strtotime('+7 days'));
                $image          = $request->file('image_bid');
                $open_po        = date('Y-m-d', strtotime('+7 days'));
                $mulai_bid      = date('Y-m-d H:i:s', strtotime('+1 days'));

                $file           = $request->file('image_bid');
                $imageName      = time() . '.' . $request->image_bid->extension();
                $save           = $file->move('public/img/bid/', $imageName);

                $bid                            = new Bid();
                $bid->name_bid                  = $request->name_bid;
                $bid->harga                     = $request->harga;
                $bid->jumlah                    = $request->jumlah;
                $bid->lokasi                    = $request->lokasi;
                $bid->open_po                   = $open_po;
                $bid->date_bid                  = $date_bid;
                $bid->mulai_bid                 = $mulai_bid;
                $bid->batas_bid                 = $batas_bid;
                $bid->description_bid           = $request->description_bid;
                $bid->image_bid                 = $imageName;
                $bid->kode_bid                  = $random_kode;
                $bid->bid_status                = '1';
                $bid->status_ds                 = $request->pilihan;
                $bid->save();

                // insert Log Aktivity
                $data = new LogAktivitySourching();
                $data->name_user    = Auth::guard('master')->user()->name_master;
                $data->aktivitas_sourching  =  'Insert Lelang ' . $request->name_bid . '. Tanggal PO : ' . $request->date_bid;
                $data->keterangan_aktivitas   = 'Selesai';
                $data->id_objek_aktivitas_sourching  = $bid->id_bid;
                $data->created_at           = date('Y-m-d H:i:s');
                $data->save();
                Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
                return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1500);
            }
        }
    }

    public function show($id)
    {
        $bid = Bid::where('id_bid', $id)->first();
        return json_encode($bid);
    }

    public function update(Request $request)
    {
        $waktu_awal = $request->date_bid;
        $image = $request->file('gambar_bid');
        $jml_kuota = ($request->jumlah * 8000);
        if (($image) == '' && ($image) == null) {
            $bid = Bid::where('id_bid', $request->id_bid)->first();
            $bid->name_bid  = $request->name_bid;
            $bid->harga     = $request->harga;
            $bid->jumlah    = $jml_kuota;
            $bid->lokasi    = $request->lokasi;
            $bid->description_bid = $request->description_bid;
            $bid->update();
            // insert Log Aktivity
            $data = new LogAktivitySourching();
            $data->name_user    = Auth::guard('master')->user()->name_master;
            $data->id_objek_aktivitas_sourching  = $request->id_bid;
            $data->aktivitas_sourching  =  'Update Lelang ' . $request->name_bid . ' PO ' . $request->date_bid;
            $data->keterangan_aktivitas   = 'Selesai';
            $data->created_at           = date('Y-m-d H:i:s');
            $data->save();
        } else {
            $bid = Bid::where('id_bid', $request->id_bid)->first();
            if ($bid->image_bid != ''  && $bid->image_bid != null) {
                $path = '/home/u1736638/public_html/ngawi.suryapangansemesta.store/public/img/bid/';

                $file_old = $path . $bid->image_bid;
                unlink($file_old);
            }
            $namefile = time() . '.' . $image->extension();
            $save = $image->move('public/img/bid/', $namefile);
            $bid->name_bid  = $request->name_bid;
            $bid->harga     = $request->harga;
            $bid->jumlah    = $jml_kuota;
            $bid->lokasi    = $request->lokasi;
            $bid->description_bid = $request->description_bid;
            $bid->image_bid = $namefile;
            $bid->update();
            // insert Log Aktivity
            $data = new LogAktivitySourching();
            $data->name_user    = Auth::guard('master')->user()->name_master;
            $data->id_objek_aktivitas_sourching  = $request->id_bid;
            $data->aktivitas_sourching  = 'Update Lelang ' . $request->name_bid . ' PO ' . $request->date_bid;
            $data->keterangan_aktivitas   = 'Selesai';
            $data->created_at           = date('Y-m-d H:i:s');
            $data->save();
        }

        return redirect()->back()->with('message', ['alert' => 'success', 'title' => 'Data Berhasil Diupdate']);
    }

    public function destroy($id_product)
    {
        $get_lelang = Bid::where('id_bid', $id_product)->first();
        // insert Log Aktivity
        // dd($get_lelang->name_bid);
        $data = new LogAktivitySourching();
        $data->name_user                        = Auth::guard('master')->user()->name_master;
        $data->id_objek_aktivitas_sourching     = $get_lelang->id_bid;
        $data->aktivitas_sourching              = 'Hapus Lelang ' . $get_lelang->name_bid . '. Tanggal PO : ' . $get_lelang->open_po;
        $data->keterangan_aktivitas   = 'Selesai';
        $data->created_at                       = date('Y-m-d H:i:s');
        $data->save();
        // dd($data);
        $bid = Bid::find($id_product);
        $bid->delete();
        return redirect()->back();
    }

    public function response($id)
    {
        $parameter = $id;
        $cek_jumlahpengajuan = DB::table('approve_bid')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'approve_bid.bid_user_id')
            ->join('bid', 'bid.id_bid', '=', 'approve_bid.bid_id')
            ->where('approve_bid.bid_id', $id)
            ->where('bid_user.status_biduser', 1)
            ->sum('approve_bid.permintaan_kirim');
        $cek_jumlahkebutuhan = DB::table('bid')->where('id_bid', $id)->first();
        $kuota_sisa = ($cek_jumlahkebutuhan->jumlah + $cek_jumlahkebutuhan->add_kuota) - $cek_jumlahpengajuan * 8000;
        $data_approve = DB::table('approve_bid')->where('bid_id', $id)->sum('permintaan_kirim');
        $bid = Bid::where('id_bid', $id)->first();
        $data_response =  DB::table('bid_user')
            ->join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
            ->join('users', 'id', '=', 'bid_user.user_id')
            ->where('id_bid', $id)
            ->get();
        // dd($data_response);
        $data_approved =  DB::table('bid_user')
            ->join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
            ->join('users', 'users.id', '=', 'bid_user.user_id')
            ->join('approve_bid', 'approve_bid.bid_user_id', '=', 'bid_user.id_biduser')
            ->where('bid.id_bid', $id)
            ->where('bid_user.bid_id', $id)
            ->where('approve_bid.bid_id', $id)
            ->where('bid_user.status_biduser', 1)
            ->where('approve_bid.status_bid', 1)
            ->get();
        // dd($data_approved);
        $data_return =  DB::table('bid_user')
            ->join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
            ->join('users', 'users.id', '=', 'bid_user.user_id')
            ->join('approve_bid', 'approve_bid.bid_user_id', '=', 'bid_user.id_biduser')
            ->where('bid.id_bid', $id)
            ->where('bid_user.status_biduser', 1)
            ->where('approve_bid.status_bid', 1)
            ->get();
        $data_disapproves =  DB::table('bid_user')
            ->join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
            ->join('users', 'id', '=', 'bid_user.user_id')
            ->where('id_bid', $id)
            ->where('status_biduser', 5)
            ->get();
        $data_proses =  DB::table('bid_user')
            ->join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
            ->join('users', 'id', '=', 'bid_user.user_id')
            ->where('id_bid', $id)
            ->where('status_biduser', 0)
            ->get();
        $data_count = DB::table('bid_user')
            ->join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
            ->join('users', 'id', '=', 'bid_user.user_id')
            ->where('id_bid', $id)
            ->where('status_biduser', 0)
            ->count();
        $status = DB::table('approve_bid')->where('bid_id', $id)->first();
        return view('dashboard.admin_master.admin_sourching.bid.dt_responbid', ['parameter' => $parameter, 'data_count' => $data_count, 'kuota_sisa' => $kuota_sisa, 'bid' => $bid, 'data_response' => $data_response, 'status' => $status, 'data_proses' => $data_proses, 'data_approved' => $data_approved, 'data_disapproves' => $data_disapproves, 'data_return' => $data_return, 'data_approve' => $data_approve]);
    }

    public function data_approve_index($id)
    {
        return Datatables::of(DB::table('bid_user')
            ->join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
            ->join('users', 'users.id', '=', 'bid_user.user_id')
            ->join('approve_bid', 'approve_bid.bid_user_id', '=', 'bid_user.id_biduser')
            ->where('bid.id_bid', $id)
            ->where('bid_user.status_biduser', 1)
            ->orWhere('bid_user.status_biduser', 3)
            ->where('approve_bid.status_bid', 1)
            ->orderBy('id_approvebid', 'desc')
            ->get())
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return $result;
            })
            ->addColumn('mulai_bid', function ($list) {
                $result = $list->mulai_bid;
                return '
                <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
                ';
            })
            ->addColumn('description_biduser', function ($list) {
                $result = $list->description_biduser;
                return '<a style="margin:2px;" name="' . $list->id_approvebid . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="to_show_nopol btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
            ' . $result . '
                </a>';
            })
            ->addColumn('jumlah_kirim', function ($list) {
                $result = $list->jumlah_kirim;
                return $result;
            })
            ->addColumn('permintaan_kirim', function ($list) {
                $result = $list->permintaan_kirim;
                return $result;
            })
            ->addColumn('ckelola', function ($buatmanage) {
                return '
                    <a style="margin:2px;" name="' . $buatmanage->id_biduser . '"data-toggle="modal" data-target="#modal1" title="Approved" class="tofinish btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-check" style="color:#00c5dc;"> </i>Approved
                ';
            })
            ->rawColumns(['nama_vendor', 'mulai_bid', 'description_biduser', 'jumlah_kirim', 'permintaan_kirim', 'ckelola'])
            ->make(true);
    }

    public function response_index()
    {
        return Datatables::of(Bid::query()->orderBy("id_bid"))
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('date_bid', function ($list) {
                $result = \Carbon\Carbon::parse($list->date_bid)->isoFormat('DD-MM-Y hh:mm:ss');
                return '
                <span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>
                ';
            })
            ->addColumn('image_bid', function ($list) {
                $img = url('img/bid/' . $list->image_bid);
                if (is_null($list->image_bid)) {
                } else
                    return '
                    <img src="' . $img . '" width="100px"/>
                ';
            })
            ->addColumn('description_bid', function ($list) {
                $result = $list->description_bid;
                return '<a style="margin:2px;" href="' . route('master.bid_response', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-eye"></i>
                </a>';
            })
            ->addColumn('response', function ($list) {
                return '<a style="margin:2px;" href="' . route('master.bid_response', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-eye"></i>
                </a>';
            })
            ->addColumn('ckelola', function ($buatmanage) {
                return '
                    <a style="margin:2px;" name="' . $buatmanage->id_bid . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                    </a>
                    <a style="margin:2px;" href="' . route('master.bid_destroy', ['id_bid' => $buatmanage->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-trash"></i>
                    </a>
                ';
            })
            ->rawColumns(['name_bid', 'date_bid', 'image_bid', 'response', 'ckelola'])
            ->make(true);
    }

    public function bid_user($id)
    {
        $data = DB::table('bid_user')
            ->join('users', 'users.id', '=', 'bid_user.user_id')
            ->join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
            ->join('item', 'item.nama_item', '=', 'bid.name_bid')
            ->where('id_biduser', $id)->first();
        //$waktu_penawaran = strtotime($data->date_biduser);
        //dd(strtotime($waktu_penawaran));
        // $waktu_batas_penawaran = strtotime($data->batas_bid);
        // $diff = $waktu_penawaran-$waktu_batas_penawaran;
        // $jam   = floor($diff / (60 * 60));
        // $menit = $diff - ( $jam * (60 * 60) );
        // $detik = $diff % 60;
        // $waktu = $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit, ' . $detik . ' detik';

        return json_encode($data);
    }

    public function approve_bid(Request $request)
    {
        // dd($request->kode_item);
        $get_partnum = DB::table('item')->where('kode_item', $request->kode_item)->first();
        // dd($get_partnum);
        $get_user = DB::table('users')->where('id', $request->user_idbid)->first();

        //integrasi epicor
        //vendorvendorid = $request->user_idbid
        //partnum = $get_partnum->kode_item
        //calcaurqty = $request->permintaan_diterima
        //ium = 'KG'
        //docscrunitcost = 0
        //plan = NGW
        //wherehousecode = $request->wherehousecode
        //orderdate = $request->tanggal_po
        //poline = 1
        //porelnum = 1



        $get_tanggal_po = DB::table('bid')->where('id_bid', $request->bid_id)->first();
        $tanggal_po     = $request->tanggal_po;
        $data = DB::table('bid_user')
            ->where('bid_id', $request->bid_id)
            ->where('user_id', $request->user_idbid)
            ->where('id_biduser', $request->id_biduser)
            ->first();

        if ($data->status_biduser == 0) {
            DB::table('bid_user')->where('id_biduser', $request->id_biduser)->update(['status_biduser' => $request->status_bid]);
            $buat_po = $request->permintaan_diterima;
            // dd($buat_po);
            //             $curl = curl_init();
            //             curl_setopt_array($curl, array(
            //                 CURLOPT_URL => 'https://api.fonnte.com/send',
            //                 CURLOPT_RETURNTRANSFER => true,
            //                 CURLOPT_ENCODING => '',
            //                 CURLOPT_MAXREDIRS => 10,
            //                 CURLOPT_TIMEOUT => 0,
            //                 CURLOPT_FOLLOWLOCATION => true,
            //                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //                 CURLOPT_CUSTOMREQUEST => 'POST',
            //                 CURLOPT_POSTFIELDS => array(
            //                     'target' => $get_user->nomer_hp,
            //                     'message' =>
            //                     "PEMBERITAHUAN!

            // Hallo *$get_user->name*


            // *PT SURYA PANGAN SEMESTA NGAWI* Ingin menyampaikan informasi bahwa PO Tanggal : *" . Carbon::parse($tanggal_po)->format('d-m-Y') . "*
            //     Pengajuan : $data->jumlah_kirim PO
            //     Diterima    : $request->permintaan_diterima PO
            //     Ditolak      : $request->permintaan_ditolak PO

            // Terima kasih
            // _Sent Via *PT SURYA PANGAN SEMESTA NGAWI*_",
            //                     'countryCode' => '62', //optional
            //                 ),
            //                 CURLOPT_HTTPHEADER => array(
            //                     'Authorization: t37BRkrNu+4F!rUJXQdB' //change TOKEN to your actual token
            //                 ),
            //             ));

            //             $response = curl_exec($curl);
            //             if (curl_errno($curl)) {
            //                 $error_msg = curl_error($curl);
            //             }
            //             curl_close($curl);

            //             if (isset($error_msg)) {
            //                 echo $error_msg;
            //             }
            //             echo $response;
            // Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1000);
            // return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1000);
            if (
                $get_partnum->nama_item == 'GABAH BASAH LONG GRAIN' || $get_partnum->nama_item == 'GABAH BASAH CIHERANG' || $get_partnum->nama_item == 'GABAH BASAH LONG GRAIN 50 KG' || $get_partnum->nama_item == 'GABAH BASAH LONG GRAIN JUMBO BAG' || $get_partnum->nama_item == 'GABAH BASAH PANDAN WANGI' || $get_partnum->nama_item == 'GABAH BASAH PANDAN WANGI 50 KG'
                || $get_partnum->nama_item == 'GABAH BASAH PANDAN WANGI JUMBO BAG' || $get_partnum->nama_item == 'GABAH BASAH PERA' || $get_partnum->nama_item == 'GABAH BASAH PERA 50 KG' || $get_partnum->nama_item == 'GABAH BASAH PERA JUMBO BAG' || $get_partnum->nama_item == 'GABAH BASAH KETAN PUTIH'
                || $get_partnum->nama_item == 'GABAH BASAH KETAN PUTIH 50 KG' || $get_partnum->nama_item == 'GABAH BASAH KETAN PUTIH JUMBO BAG'
            ) {
                $pesan = new ApproveBid();
                $pesan->bid_user_id         = $request->id_biduser;
                $pesan->user_idbid          = $request->user_idbid;
                $pesan->bid_id              = $request->bid_id;
                $pesan->status_bid          = $request->status_bid;
                $pesan->permintaan_kirim    = $request->permintaan_diterima;
                $pesan->permintaan_ditolak  = $request->permintaan_ditolak;
                $pesan->message_admin       = $request->message_admin;
                $pesan->tanggal_po          = $tanggal_po;
                $pesan->batas_penerimaan    = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                $pesan->save();

                for ($i = 0; $i < $buat_po; $i++) {
                    $hour = date('H');
                    $last_id = DB::table('approve_bid')->orderBy('id_approvebid', 'DESC')->first();
                    if ($hour <= 12) {
                        if ($tanggal_po == date('Y-m-d')) {
                            $antrian1 = DB::table('data_po')->where('tanggal_po', $request->tanggal_po)->count();
                            $antrian1 = ($antrian1 + 1);
                            if (strlen((string) $antrian1) == 1) {
                                $antrian1 = '00' . ($antrian1);
                                $kode_po = 'PO.BP.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode' => 'WHNGWDUA',
                                    'BinNum'        => '0',
                                    'SPS_Nopol_c'   => 'AG',
                                    'PTI_PONum_c'   => $kode_po,
                                    'SPS_PODate_c'   => $request->tanggal_po,
                                ];

                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            } elseif (strlen((string) $antrian1) == 2) {
                                $antrian1 = '0' . ($antrian1);
                                $kode_po = 'PO.BP.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode' => 'WHNGWDUA',
                                    'BinNum'        => '0',
                                    'SPS_Nopol_c'   => 'AG',
                                    'PTI_PONum_c'   => $kode_po,
                                    'SPS_PODate_c'  => $request->tanggal_po,
                                ];

                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            } else {
                                $antrian1 = ($antrian1);
                                $kode_po = 'PO.BP.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode' => 'WHNGWDUA',
                                    'BinNum'        => '0',
                                    'SPS_Nopol_c'   => 'AG',
                                    'PTI_PONum_c'   => $kode_po,
                                    'SPS_PODate_c'  => $request->tanggal_po,
                                ];

                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            }
                        } else {
                            $antrian1 = DB::table('data_po')->where('tanggal_po', $tanggal_po)->count();
                            $antrian1 = ($antrian1 + 1);
                            if (strlen((string) $antrian1) == 1) {
                                $antrian1 = '00' . ($antrian1);
                                $kode_po = 'PO.BP.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode' => 'WHNGWDUA',
                                    'BinNum'        => '0',
                                    'SPS_Nopol_c'   => 'AG',
                                    'PTI_PONum_c'   => $kode_po,
                                    'SPS_PODate_c'  => $request->tanggal_po,
                                ];

                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            } elseif (strlen((string) $antrian1) == 2) {
                                $antrian1 = '0' . ($antrian1);
                                $kode_po = 'PO.BP.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode'    => 'WHNGWDUA',
                                    'BinNum' => '0',
                                    'SPS_Nopol_c' => 'AG',
                                    'PTI_PONum_c'      => $kode_po,
                                    'SPS_PODate_c'   => $request->tanggal_po,
                                ];

                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            } else {
                                $antrian1 = ($antrian1);
                                $kode_po = 'PO.BP.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode'    => 'WHNGWDUA',
                                    'BinNum' => '0',
                                    'SPS_Nopol_c' => 'AG',
                                    'PTI_PONum_c'      => $kode_po,
                                    'SPS_PODate_c'   => $request->tanggal_po,
                                ];
                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();

                                        $po = new trackerPO();
                                        $po->nama_admin_tracker  = Auth::guard('sourching')->user()->name;
                                        $po->nama_supplier_tracker    = $request->name_supplier;
                                        $po->kode_po_tracker  = $kode_po;
                                        $po->tanggal_po_tracker  = $request->tanggal_po;
                                        $po->id_data_po_tracker  = $Data_po->id_data_po;
                                        $po->pengajuan_po_user_tracker  = $request->date_biduser;
                                        $po->status_po_tracker  = $request->status_bid;
                                        $po->proses_tracker = 'Approve Sourching';
                                        $po->approve_sourching_tracker  = date('Y-m-d H:i:s');
                                        $po->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            }
                        }
                    } else {
                        if ($tanggal_po == date('Y-m-d')) {
                            $antrian1 = DB::table('data_po')->where('tanggal_po', $request->tanggal_po)->count();
                            $antrian1 = ($antrian1 + 1);
                            if (strlen((string) $antrian1) == 1) {
                                $antrian1 = '00' . ($antrian1);
                                $kode_po = 'PO.BP.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode'    => 'WHNGWDUA',
                                    'BinNum' => '0',
                                    'SPS_Nopol_c' => 'AG',
                                    'PTI_PONum_c'      => $kode_po,
                                    'SPS_PODate_c'   => $request->tanggal_po,
                                ];
                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            } elseif (strlen((string) $antrian1) == 2) {
                                $antrian1 = '0' . ($antrian1);
                                $kode_po = 'PO.BP.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode'    => 'WHNGWDUA',
                                    'BinNum' => '0',
                                    'SPS_Nopol_c' => 'AG',
                                    'PTI_PONum_c'      => $kode_po,
                                    'SPS_PODate_c'   => $request->tanggal_po,
                                ];
                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 23:59:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            } else {
                                $antrian1 = ($antrian1);
                                $kode_po = 'PO.BP.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode'    => 'WHNGWDUA',
                                    'BinNum' => '0',
                                    'SPS_Nopol_c' => 'AG',
                                    'PTI_PONum_c'      => $kode_po,
                                    'SPS_PODate_c'   => $request->tanggal_po,
                                ];
                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 23:59:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            }
                        } else {
                            $antrian1 = DB::table('data_po')->where('tanggal_po', $tanggal_po)->count();
                            $antrian1 = ($antrian1 + 1);
                            if (strlen((string) $antrian1) == 1) {
                                $antrian1 = '00' . ($antrian1);
                                $kode_po = 'PO.BP.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;

                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode'    => 'WHNGWDUA',
                                    'BinNum' => '0',
                                    'SPS_Nopol_c' => 'AG',
                                    'PTI_PONum_c'      => $kode_po,
                                    'SPS_PODate_c'   => $request->tanggal_po,
                                ];
                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            } elseif (strlen((string) $antrian1) == 2) {
                                $antrian1 = '0' . ($antrian1);
                                $kode_po = 'PO.BP.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode'    => 'WHNGWDUA',
                                    'BinNum' => '0',
                                    'SPS_Nopol_c' => 'AG',
                                    'PTI_PONum_c'      => $kode_po,
                                    'SPS_PODate_c'   => $request->tanggal_po,
                                ];
                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            } else {
                                $antrian1 = ($antrian1);
                                $kode_po = 'PO.BP.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode'    => 'WHNGWDUA',
                                    'BinNum' => '0',
                                    'SPS_Nopol_c' => 'AG',
                                    'PTI_PONum_c'      => $kode_po,
                                    'SPS_PODate_c'   => $request->tanggal_po,
                                ];
                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid         = $last_id->id_approvebid;
                                            $Data_po->bid_user_id           = $request->id_biduser;
                                            $Data_po->user_idbid            = $request->user_idbid;
                                            $Data_po->bid_id                = $request->bid_id;
                                            $Data_po->status_bid            = $request->status_bid;
                                            $Data_po->permintaan_kirim      = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak    = $request->permintaan_ditolak;
                                            $Data_po->kode_po               = $kode_po;
                                            $Data_po->message_admin         = $request->message_admin;
                                            $Data_po->tanggal_po            = $request->tanggal_po;
                                            $Data_po->PONum                 = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            }
                        }
                    }
                }
            } else {
                $pesan = new ApproveBid();
                $pesan->bid_user_id         = $request->id_biduser;
                $pesan->user_idbid          = $request->user_idbid;
                $pesan->bid_id              = $request->bid_id;
                $pesan->status_bid          = $request->status_bid;
                $pesan->permintaan_kirim    = $request->permintaan_diterima;
                $pesan->permintaan_ditolak  = $request->permintaan_ditolak;
                $pesan->message_admin       = $request->message_admin;
                $pesan->tanggal_po          = $tanggal_po;
                $pesan->batas_penerimaan    = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                $pesan->save();
                for ($i = 0; $i < $buat_po; $i++) {
                    $hour = date('H');
                    $last_id = DB::table('approve_bid')->orderBy('id_approvebid', 'DESC')->first();
                    if ($hour <= 12) {
                        if ($tanggal_po == date('Y-m-d')) {
                            $antrian1 = DB::table('data_po')->where('tanggal_po', $request->tanggal_po)->count();
                            $antrian1 = ($antrian1 + 1);
                            if (strlen((string) $antrian1) == 1) {
                                $antrian1 = '00' . ($antrian1);
                                $kode_po = 'PO.BB.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode' => 'WHNGWDUA',
                                    'BinNum'        => '0',
                                    'SPS_Nopol_c'   => 'AG',
                                    'PTI_PONum_c'   => $kode_po,
                                    'SPS_PODate_c'  => $request->tanggal_po,
                                ];

                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            } elseif (strlen((string) $antrian1) == 2) {
                                $antrian1 = '0' . ($antrian1);
                                $kode_po = 'PO.BB.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode' => 'WHNGWDUA',
                                    'BinNum'        => '0',
                                    'SPS_Nopol_c'   => 'AG',
                                    'PTI_PONum_c'   => $kode_po,
                                    'SPS_PODate_c'  => $request->tanggal_po,
                                ];

                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            } else {
                                $antrian1 = ($antrian1);
                                $kode_po = 'PO.BB.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode' => 'WHNGWDUA',
                                    'BinNum'        => '0',
                                    'SPS_Nopol_c'   => 'AG',
                                    'PTI_PONum_c'   => $kode_po,
                                    'SPS_PODate_c'  => $request->tanggal_po,
                                ];

                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            }
                        } else {
                            $antrian1 = DB::table('data_po')->where('tanggal_po', $tanggal_po)->count();
                            $antrian1 = ($antrian1 + 1);
                            if (strlen((string) $antrian1) == 1) {
                                $antrian1 = '00' . ($antrian1);
                                $kode_po = 'PO.BB.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode' => 'WHNGWDUA',
                                    'BinNum'        => '0',
                                    'SPS_Nopol_c'   => 'AG',
                                    'PTI_PONum_c'   => $kode_po,
                                    'SPS_PODate_c'  => $request->tanggal_po,
                                ];

                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            } elseif (strlen((string) $antrian1) == 2) {
                                $antrian1 = '0' . ($antrian1);
                                $kode_po = 'PO.BB.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode' => 'WHNGWDUA',
                                    'BinNum'        => '0',
                                    'SPS_Nopol_c'   => 'AG',
                                    'PTI_PONum_c'   => $kode_po,
                                    'SPS_PODate_c'  => $request->tanggal_po,
                                ];

                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            } else {
                                $antrian1 = ($antrian1);
                                $kode_po = 'PO.BB.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode'    => 'WHNGWDUA',
                                    'BinNum' => '0',
                                    'SPS_Nopol_c' => 'AG',
                                    'PTI_PONum_c'      => $kode_po,
                                    'SPS_PODate_c'   => $request->tanggal_po,
                                ];
                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            }
                        }
                    } else {
                        if ($tanggal_po == date('Y-m-d')) {
                            $antrian1 = DB::table('data_po')->where('tanggal_po', $request->tanggal_po)->count();
                            $antrian1 = ($antrian1 + 1);
                            if (strlen((string) $antrian1) == 1) {
                                $antrian1 = '00' . ($antrian1);
                                $kode_po = 'PO.BB.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode'    => 'WHNGWDUA',
                                    'BinNum' => '0',
                                    'SPS_Nopol_c' => 'AG',
                                    'PTI_PONum_c'      => $kode_po,
                                    'SPS_PODate_c'   => $request->tanggal_po,
                                ];
                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            } elseif (strlen((string) $antrian1) == 2) {
                                $antrian1 = '0' . ($antrian1);
                                $kode_po = 'PO.BB.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode'    => 'WHNGWDUA',
                                    'BinNum' => '0',
                                    'SPS_Nopol_c' => 'AG',
                                    'PTI_PONum_c'      => $kode_po,
                                    'SPS_PODate_c'   => $request->tanggal_po,
                                ];
                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 23:59:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            } else {
                                $antrian1 = ($antrian1);
                                $kode_po = 'PO.BB.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode'    => 'WHNGWDUA',
                                    'BinNum' => '0',
                                    'SPS_Nopol_c' => 'AG',
                                    'PTI_PONum_c'      => $kode_po,
                                    'SPS_PODate_c'   => $request->tanggal_po,
                                ];
                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 23:59:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            }
                        } else {
                            $antrian1 = DB::table('data_po')->where('tanggal_po', $tanggal_po)->count();
                            $antrian1 = ($antrian1 + 1);
                            if (strlen((string) $antrian1) == 1) {
                                $antrian1 = '00' . ($antrian1);
                                $kode_po = 'PO.BB.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;

                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode'    => 'WHNGWDUA',
                                    'BinNum' => '0',
                                    'SPS_Nopol_c' => 'AG',
                                    'PTI_PONum_c'      => $kode_po,
                                    'SPS_PODate_c'   => $request->tanggal_po,
                                ];
                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            } elseif (strlen((string) $antrian1) == 2) {
                                $antrian1 = '0' . ($antrian1);
                                $kode_po = 'PO.BB.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode'    => 'WHNGWDUA',
                                    'BinNum' => '0',
                                    'SPS_Nopol_c' => 'AG',
                                    'PTI_PONum_c'      => $kode_po,
                                    'SPS_PODate_c'   => $request->tanggal_po,
                                ];
                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid   = $last_id->id_approvebid;
                                            $Data_po->bid_user_id     = $request->id_biduser;
                                            $Data_po->user_idbid      = $request->user_idbid;
                                            $Data_po->bid_id          = $request->bid_id;
                                            $Data_po->status_bid      = $request->status_bid;
                                            $Data_po->permintaan_kirim = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak = $request->permintaan_ditolak;
                                            $Data_po->kode_po         = $kode_po;
                                            $Data_po->message_admin   = $request->message_admin;
                                            $Data_po->tanggal_po      = $request->tanggal_po;
                                            $Data_po->PONum      = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user    = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching  = $Data_po->id_data_po;
                                        $data->aktivitas_sourching  = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            } else {
                                $antrian1 = ($antrian1);
                                $kode_po = 'PO.BB.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                                // Integrasi Epicor
                                $Data_po = new  \App\Models\DataPO;
                                $client = new \GuzzleHttp\Client();
                                $url = 'http://34.34.222.145:2022/api/PO/InsertPO';
                                $form_params = [
                                    'VendorID'      => $request->vendorid,
                                    'BuyerID'       => 'BBK01101',
                                    'TermsCode'     => 'PT01',
                                    'PartNum'       => $request->kode_item,
                                    'Quantity'      => 8000,
                                    'UnitPrice'     => 0,
                                    'PartDesc'      => $request->message_admin,
                                    'nobks_c'       => 0,
                                    'codepo_c'      => $kode_po,
                                    'plant'         => 'NGW',
                                    'WarehouseCode'    => 'WHNGWDUA',
                                    'BinNum' => '0',
                                    'SPS_Nopol_c' => 'AG',
                                    'PTI_PONum_c'      => $kode_po,
                                    'SPS_PODate_c'   => $request->tanggal_po,
                                ];
                                $promise = $client->postAsync($url, ['form_params' => $form_params]);
                                $promise->then(
                                    function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $buat_po) {
                                        echo $response = $response->getBody()->getContents();
                                        for ($i = 0; $i < $buat_po; $i++) {
                                            $Data_po->id_approvebid         = $last_id->id_approvebid;
                                            $Data_po->bid_user_id           = $request->id_biduser;
                                            $Data_po->user_idbid            = $request->user_idbid;
                                            $Data_po->bid_id                = $request->bid_id;
                                            $Data_po->status_bid            = $request->status_bid;
                                            $Data_po->permintaan_kirim      = $request->permintaan_diterima;
                                            $Data_po->permintaan_ditolak    = $request->permintaan_ditolak;
                                            $Data_po->kode_po               = $kode_po;
                                            $Data_po->message_admin         = $request->message_admin;
                                            $Data_po->tanggal_po            = $request->tanggal_po;
                                            $Data_po->PONum                 = $response;
                                            $Data_po->batas_penerimaan_po   = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
                                            $Data_po->save();
                                        }
                                        $data = new LogAktivitySourching();
                                        $data->name_user                        = Auth::guard('sourching')->user()->name;
                                        $data->id_objek_aktivitas_sourching     = $Data_po->id_data_po;
                                        $data->aktivitas_sourching              = 'Approve PO Baru. Kode PO: ' . $kode_po;
                                        $data->keterangan_aktivitas  = 'Selesai';
                                        $data->created_at           = date('Y-m-d H:i:s');
                                        $data->save();
                                    }
                                );
                                sleep(1);
                                $result = $promise->wait();
                                // dd($result);
                            }
                        }
                    }
                }
            }


            Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1000);
            return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1000);
            die();
        } elseif ($data->status_biduser == 1) {
            $a = DB::table('bid_user')->where('id_biduser', $request->id_biduser)->update(['status_biduser' => 3]);
            $b = new Transaksi();
            $c = DB::table('transaksi')->orderBy('id_transaksi', 'DESC')->first();
            $kode = $c->id_transaksi + 1 . '-' . $request->kode_transaksi;
            $b->id_biduser_id       = $request->id_biduser;
            $b->id_vendor_transaksi = $request->user_idbid;
            $b->id_bid_transaksi    = $request->bid_id;
            $b->kode_transaksi      = "VD02-" . $kode;
            $b->waktu_transaksi     = Carbon::now()->format('Y-m-d');
            $b->save();
            return redirect()->back();
        }
        return redirect()->back()->with('message', ['alert' => 'success', 'title' => 'Add Product Success']);
    }

    // LOG ACTIVITY SOURCHING
    public function log_activity_sourching()
    {
        return view('dashboard.admin_master.admin_sourching.log_activity_sourching');
    }

    public function log_activity_sourching_index()
    {
        return Datatables::of(DB::table('log_aktivitas_sourching')
            ->orderby('id_aktivitas_sourching', 'desc')
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
    public function cetak_po_sourching($id)
    {
        $params = DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'user_idbid')
            ->where('id_data_po', $id)
            ->first();
        $data = DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'user_idbid')
            ->where('id_data_po', $id)
            ->get();
        $get_provinsi = DB::table('provinces')
            ->where('id', $params->id_provinsiktp)->first();
        $get_kabupaten = DB::table('regencies')
            ->where('id', $params->id_kabupatenktp)->first();
        $get_kecamatan = DB::table('districts')
            ->where('id', $params->id_kecamatanktp)->first();
        $get_desa = DB::table('villages')
            ->where('id', $params->id_desaktp)->first();
        $get_item = DB::table('item')
            ->where('nama_item', $params->name_bid)->first();
        $data1 = Pdf::loadview('dashboard.admin_master.admin_sourching.bid.cetak_po', ['data' => $data, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa, 'get_item' => $get_item]);
        return $data1->stream('CETAK ' . $params->kode_po . '.pdf');
    }
    function bid()
    {
        $date = date('Y-m-d H:i:s');
        // dd($date);
        $query = DB::table('bid')->where('batas_bid', '<=', $date)->where('bid_status', '1')->orderBy('date_bid', 'DESC')->get();
        // dd($query);
        foreach ($query as $kediri) {
            $data = DB::table('bid')->where('id_bid', '=', $kediri->id_bid)
                ->update([
                    'bid_status' => '0',
                    'status_edit' => 'EDIT SOURCHING',
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
            // insert Log Aktivity
            $data = new LogAktivitySourching();
            $data->name_user    = Auth::guard('master')->user()->name_master;
            $data->id_objek_aktivitas_sourching  = $kediri->id_bid;
            $data->aktivitas_sourching  = 'Menonaktifkan Lelang ' . $kediri->name_bid . ' PO ' . $kediri->open_po;
            $data->created_at           = date('Y-m-d H:i:s');
            $data->save();
        }
        return view('dashboard.admin_master.admin_sourching.bid.dt_bid');
    }
    public function vendor()
    {
        return view('dashboard.admin_master.admin_sourching.vendor.dt_vendor');
    }

    public function vendor_store(Request $request)
    {
        $request->validate([
            'gambar_npwp' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gambar_ktp' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pakta_integritas' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fis' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $fileNPWP       = $request->file('gambar_npwp');
        $imageNameNPWP  = time() . '.' . $request->gambar_npwp->extension();
        $moveNPWP       = $fileNPWP->move('public/img/npwp/profile_user', $imageNameNPWP);

        $fileKTP       = $request->file('gambar_ktp');
        $imageNameKTP  = time() . '.' . $request->gambar_ktp->extension();
        $moveKTP       = $fileKTP->move('public/img/ktp/profile_user', $imageNameKTP);

        $filePI       = $request->file('pakta_integritas');
        $imageNamePI   = time() . '.' . $request->pakta_integritas->extension();
        $movePI        = $filePI->move('public/img/pakta_integritas/profile_user', $imageNamePI);

        $fileFIS       = $request->file('fis');
        $imageNameFIS   = time() . '.' . $request->fis->extension();
        $moveFIS        = $fileFIS->move('public/img/fis/profile_user', $imageNameFIS);


        $cek_email   = DB::table('users')->where('email', $request->email)->first();
        $cek_username   = DB::table('users')->where('username', $request->username)->first();
        $cek_npwp    = DB::table('users')->where('npwp', $request->npwp)->first();
        $cek_ktp     = DB::table('users')->where('ktp', $request->ktp)->first();
        $cek_address1 = DB::table('districts')->where('id', $request->id_kecamatannpwp)->first();
        $cek_address2 = DB::table('regencies')->where('id', $request->id_kabupatennpwp)->first();
        $cek_address3 = DB::table('provinces')->where('id', $request->id_provinsinpwp)->first();

        $nomer_urut  = DB::table('users')->where('GroupCode', '1PBB')->count();

        //dd('VD150'.($nomer_urut + 2));
        //dd($cek_address1->name.', '.$cek_address2->name.', '.$cek_address3->name.' INDONESIA');
        if ($request->nama_bank == 'BBRI') {
            $bank_code = 'BBRI';
            $bank_name = 'PT BANK RAKYAT INDONESIA (PERSERO) Tbk';
        } elseif ($request->nama_bank == 'BMRI') {
            $bank_code = 'BMRI';
            $bank_name = 'PT BANK MANDIRI (PERSERO) Tbk';
        } else {
            $bank_code = 'BBCA';
            $bank_name = 'PT BANK CENTRAL ASIA Tbk';
        }
        // if ($cek_email == '' && $cek_npwp == '' && $cek_ktp == '') {
        if ($cek_email == '' | $cek_username == '') {
            $client = new \GuzzleHttp\Client();
            $url = 'https://sumberpangan.store/api/postman';
            $url = 'http://34.34.222.145:2022/api/Vendor/InsertVendor';
            $form_params = [
                'name'           => $request->nama_vendor,
                'password'           => $request->password,
                'groupcode'         => '1PBB',
                'nomer_hp'           => $request->nomer_hp,
                'name'              => $request->nama_ktp,
                'sps_alias_c'       => $request->badan_usaha,
                'address1'          => $cek_address1->name,
                'address2'          => $cek_address2->name,
                'address3'          => $cek_address3->name,
                'city'              => $cek_address2->name,
                'state'             => $cek_address3->name,
                'taxpayerid'        => $request->npwp,
                'sps_namenpwp_c'    => $request->nama_npwp,
                'sps_alamatnpwp_c'  => $cek_address1->name . ', ' . $cek_address2->name . ', ' . $cek_address3->name . ' INDONESIA',
                'inactive'          => 'false',
                'sps_phonenum_c'    => $request->nomer_hp,
                'emailaddress'      => $request->email,
                'termscode'         => 'N1',
                'bankacctnumber'    => $request->nomer_rekening,
                'bankbranchcode'    => $bank_code,
                'sps_niksupplier_c' => $request->ktp,
                'bankAccountID' => 'V01',
                'BankName' => $bank_name
            ];
            $response = $client->post($url, ['form_params' => $form_params]);
            $response = $response->getBody()->getContents();
            $result     = preg_replace("/[^a-zA-Z0-9]/", "", $response);
            $query = User::create([
                'vendorid'           => $result,
                'name'               => $request->nama_vendor,
                'sps_alias_c'        => $request->badan_usaha,
                'address1'           => $cek_address1->name,
                'address2'           => $cek_address2->name,
                'address3'           => $cek_address3->name,
                'city'               => $cek_address2->name,
                'state'              => $cek_address3->name,
                'zip'                => '-',
                'taxpayerID'         => $request->npwp,
                'SPS_NameNPWP_c'     => $request->nama_npwp,
                'SPS_AlamatNPWP_c'   => $cek_address1->name . ', ' . $cek_address2->name . ', ' . $cek_address3->name . ' INDONESIA',
                'SPS_ActiveDate_c'   => date('Y-m-d'),
                'SPS_InactiveDate_c' => date('Y-m-d'),
                'faxnum'             => '-',
                'SPS_phonenum_c'     => $request->nomer_hp,
                'emailaddress'       => $request->email,
                'shipviacode'        => '-',
                'taxregioncode'      => '-',
                'GroupCode'          => '1PBB',
                'BankAcctNumber'     => $request->nomer_rekening,
                'BankName'           => $bank_name,
                'BankBranchCode'     => $bank_code,
                'SPS_niksupplier_c'  => $request->ktp,

                'nama_vendor'        => $request->nama_vendor,
                'nama_npwp'          => $request->nama_npwp,
                'email'              => $request->email,
                'npwp'               => $request->npwp,
                'rt_npwp'            => $request->rt_npwp,
                'rw_npwp'            => $request->rw_npwp,
                'id_provinsinpwp'    => $request->id_provinsinpwp,
                'id_kabupatennpwp'   => $request->id_kabupatennpwp,
                'id_kecamatannpwp'   => $request->id_kecamatannpwp,
                'id_desanpwp'        => $request->id_desanpwp,
                'keterangan_alamat_npwp'        => $request->keterangan_alamat_npwp,
                'nama_bank'          => $bank_name,
                'nomer_rekening'     => $request->nomer_rekening,
                'nama_penerima_bank' => $request->nama_penerima_bank,
                'cabang_bank'        => $request->cabang_bank,
                'nama_ktp'           => $request->nama_ktp,
                'ktp'                => $request->ktp,
                'rt_ktp'             => $request->rt_ktp,
                'rw_ktp'             => $request->rw_ktp,
                'id_provinsiktp'     => $request->id_provinsiktp,
                'id_kabupatenktp'    => $request->id_kabupatenktp,
                'id_kecamatanktp'    => $request->id_kecamatanktp,
                'id_desaktp'         => $request->id_desaktp,
                'keterangan_alamat_ktp'         => $request->keterangan_alamat_ktp,
                'nomer_hp'           => $request->nomer_hp,
                'username'           => $request->username,
                'password'           => \Hash::make($request->password),
                'password_show'      => $request->password,
                'gambar_npwp'        => $imageNameNPWP,
                'gambar_ktp'        => $imageNameKTP,
                'pakta_integritas'  => $imageNamePI,
                'fis'  => $imageNameFIS
            ]);
            Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
            return redirect()->route('master.vendor')->with('success', 'Data anda berhasil di Simpan.');
        } else {
            Alert::success('error', 'Data email, Username, npwp, dan ktp anda masukan sudah ada', 1500);
            return redirect()->back()->with('error', 'Data email, Username, npwp, dan ktp anda masukan sudah ada');
        }
    }
    public function get_verifyemail($id)
    {
        $get_verifyemail = DB::table('users')->where('email', $id)->count();
        return json_encode($get_verifyemail);
    }
    public function get_nik($id)
    {
        $get_nik = DB::table('users')->where('ktp', $id)->count();
        return json_encode($get_nik);
    }
    public function cekUsername($id)
    {
        $user = User::all()->where('username', $id)->count();
        return json_encode($user);
    }
    public function get_npwp($id)
    {
        $get_npwp = DB::table('users')->where('npwp', $id)->count();
        return json_encode($get_npwp);
    }
    public function getkabupaten(Request $request)
    {
        $id_provinsi    = $request->id_provinsi;
        $kabupaten      = Regency::where('province_id', $id_provinsi)->get();
        echo "<option value=''>Pilih Kabupaten...</option>";
        foreach ($kabupaten as $kabupaten) {
            echo "<option value='$kabupaten->id'>$kabupaten->name</option>";
        }
    }

    public function getkecamatan(Request $request)
    {
        $id_kabupaten    = $request->id_kabupaten;
        $kecamatan       = District::where('regency_id', $id_kabupaten)->get();
        echo "<option value=''>Pilih Kecamatan...</option>";
        foreach ($kecamatan as $kecamatan) {
            echo "<option value='$kecamatan->id'>$kecamatan->name</option>";
        }
    }

    public function getdesa(Request $request)
    {
        $id_kecamatan    = $request->id_kecamatan;
        $desa            = Village::where('district_id', $id_kecamatan)->get();
        echo "<option value=''>Pilih Desa...</option>";
        foreach ($desa as $desa) {
            echo "<option value='$desa->id'>$desa->name</option>";
        }
    }

    public function vendor_index(Request $request)
    {
        return Datatables::of(User::query()->orderBy('created_at', 'desc')->get())
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return $result;
            })
            ->addColumn('email', function ($list) {
                $result = $list->email;
                return $result;
            })
            ->addColumn('created_at', function ($list) {
                $result = $list->created_at;
                return $result;
            })
            ->addColumn('password_show', function ($list) {
                $result = $list->password_show;
                return $result;
            })
            ->addColumn('npwp', function ($list) {
                $result = $list->npwp;
                return $result;
            })
            ->addColumn('ktp', function ($list) {
                $result = $list->ktp;
                return $result;
            })
            ->addColumn('nomer_hp', function ($list) {
                $result = $list->nomer_hp;
                return $result;
            })
            ->addColumn('detail', function ($list) {
                return '<a style="margin:2px;" href="' . route('master.vendor_detail', ['id' => $list->id]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Detail Vendor" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-eye"></i>
                    Detail
                    </a>';
            })
            ->addColumn('status_user', function ($list) {
                if ($list->status_user == 0) {
                    return '<button id="btn_nonactive" style="margin:2px;" data-id="' . $list->id . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Ubah status" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-user-times"> </i>Non&nbsp;Active
                    </button>';
                } else {
                    return '<button id="btn_active" style="margin:2px;" data-id="' . $list->id . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Ubah status" onclick="return true" class="toyakin btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-user-check"> Active</i>
                    </button>';
                }
            })
            ->addColumn('status_email', function ($list) {
                if ($list->is_email_verified == 0) {
                    return '<button style="margin:2px;" data-offset="5px 5px" data-toggle="m-tooltip"  title="Email Belum Verifikasi" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-envelope"> </i>Not&nbsp;Verified
                    </button>';
                } else {
                    return '<button style="margin:2px;"  data-offset="5px 5px" data-toggle="m-tooltip" title="Email Terverifikasi" class="toyakin btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-envelope-open"> Verified</i>
                    </button>';
                }
            })

            ->addColumn('ckelola', function ($buatmanage) {
                return '
                    <a href="' . route('master.vendor_print_form') . '/' . $buatmanage->id . '" style="margin:2px;" data-id="' . $buatmanage->id . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Print Form" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-print"></i>
                    </a>
                    <button id="btn_delete" style="margin:2px;" data-id="' . $buatmanage->id . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Ubah status" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-trash"></i>
                    </button>';
            })
            ->rawColumns(['nama_vendor', 'created_at', 'email', 'status_email', 'password_show', 'npwp', 'kt', 'nomer_hp', 'detail', 'status_user', 'ckelola'])
            ->make(true);
    }
    public function vendor_status($id)
    {
        $data = DB::table('users')->where('id', $id)->first();
        $cek_address1 = DB::table('districts')->where('id', $data->id_kecamatannpwp)->first();
        $cek_address2 = DB::table('regencies')->where('id', $data->id_kabupatennpwp)->first();
        $cek_address3 = DB::table('provinces')->where('id', $data->id_provinsinpwp)->first();
        if ($data->nama_bank == 'BBRI') {
            $bank_code = 'BBRI';
            $bank_name = 'PT BANK RAKYAT INDONESIA (PERSERO) Tbk';
        } elseif ($data->nama_bank == 'BMRI') {
            $bank_code = 'BMRI';
            $bank_name = 'PT BANK MANDIRI (PERSERO) Tbk';
        } else {
            $bank_code = 'BBCA';
            $bank_name = 'PT BANK CENTRAL ASIA Tbk';
        }
        if ($data->status_user == 1) {
            $data = DB::table('users')->where('id', $id)->first();
            DB::table('users')->where('id', $id)->update(['status_user' => 0]);
            $client = new \GuzzleHttp\Client();
            $url = 'http://34.34.222.145:2022/api/Vendor/UpdateVendor';
            $form_params = [
                'VendorID'          => $data->vendorid,
                'GroupCode'         => $data->GroupCode,
                'name'              => $data->nama_vendor,
                'sps_alias_c'       => $data->sps_alias_c,
                'address1'          => $cek_address1->name,
                'address2'          => $cek_address2->name,
                'address3'          => $cek_address3->name,
                'city'              => $cek_address2->name,
                'state'             => $cek_address3->name,
                'taxpayerid'        => $data->npwp,
                'sps_namenpwp_c'    => $data->nama_npwp,
                'sps_alamatnpwp_c'  => $cek_address1->name . ', ' . $cek_address2->name . ', ' . $cek_address3->name . ' INDONESIA',
                'inactive'          => 'true',
                'sps_phonenum_c'    => $data->nomer_hp,
                'emailaddress'      => $data->email,
                'termscode'         => 'N1',
                'bankacctnumber'    => $data->nomer_rekening,
                'bankAccountID'     => 'V01',
                'BankName'          => $bank_name,
                'bankbranchcode'    => $bank_code,
                'SPS_niksupplier_c' => $data->ktp,
            ];
            $response = $client->post($url, ['form_params' => $form_params]);
            $response = $response->getBody()->getContents();
            Alert::success('Berhasil', 'Data Vendor Tidak Aktif');
            return redirect()->back()->with('Berhasil', 'Data Vendor Tidak Aktif');
        } else {
            $data = DB::table('users')->where('id', $id)->first();
            DB::table('users')->where('id', $id)->update(['status_user' => 1]);
            $client = new \GuzzleHttp\Client();
            $url = 'http://34.34.222.145:2022/api/Vendor/UpdateVendor';
            $form_params = [
                'VendorID'          => $data->vendorid,
                'GroupCode'         => $data->GroupCode,
                'name'              => $data->nama_vendor,
                'sps_alias_c'       => $data->sps_alias_c,
                'address1'          => $cek_address1->name,
                'address2'          => $cek_address2->name,
                'address3'          => $cek_address3->name,
                'city'              => $cek_address2->name,
                'state'             => $cek_address3->name,
                'taxpayerid'        => $data->npwp,
                'sps_namenpwp_c'    => $data->nama_npwp,
                'sps_alamatnpwp_c'  => $cek_address1->name . ', ' . $cek_address2->name . ', ' . $cek_address3->name . ' INDONESIA',
                'inactive'          => 'false',
                'sps_phonenum_c'    => $data->nomer_hp,
                'emailaddress'      => $data->email,
                'termscode'         => 'N1',
                'bankacctnumber'    => $data->nomer_rekening,
                'bankAccountID'     => 'V01',
                'BankName'          => $bank_name,
                'bankbranchcode'    => $bank_code,
                'SPS_niksupplier_c' => $data->ktp,
            ];
            $response = $client->post($url, ['form_params' => $form_params]);
            $response = $response->getBody()->getContents();
            Alert::success('Berhasil', 'Data Vendor Aktif');
            return redirect()->back()->with('Berhasil', 'Data Vendor Aktif');
        }
    }
    public function vendor_detail($id)
    {
        $data = DB::table('users')->where('id', $id)->first();
        return view('dashboard.admin_master.admin_sourching.vendor.dt_detailvendor', ['data' => $data]);
    }

    public function vendor_show($id)
    {
        $bid = User::where('id', $id)->first();
        return json_encode($bid);
    }

    public function vendor_update(Request $request)
    {
        $vendor = User::where('id', $request->id_vendor)->first();
        $vendor->nama_vendor        = $request->nama_vendor;
        $vendor->nama_npwp          = $request->nama_npwp;
        $vendor->email              = $request->email;
        $vendor->npwp               = $request->npwp;
        $vendor->rt_npwp            = $request->rt_npwp;
        $vendor->rw_npwp            = $request->rw_npwp;
        $vendor->nomer_rekening     = $request->nomer_rekening;
        $vendor->nama_penerima_bank = $request->nama_penerima_bank;
        $vendor->cabang_bank        = $request->cabang_bank;
        $vendor->nama_ktp           = $request->nama_ktp;
        $vendor->ktp                = $request->ktp;
        $vendor->rt_ktp             = $request->rt_ktp;
        $vendor->rw_ktp             = $request->rw_ktp;
        $vendor->nomer_hp           = $request->nomer_hp;
        $vendor->username           = $request->username;
        $vendor->password_show      = Hash::make($request->password);
        $vendor->password_show      = $request->password;
        $vendor->update();
        return redirect()->back()->with('message', ['alert' => 'success', 'title' => 'Data Berhasil Diupdate']);
    }
    public function vendor_update_npwp(Request $request)
    {
        // dd($request->all());
        $cek_address1 = DB::table('districts')->where('id', $request->id_kecamatannpwp)->first();
        $cek_address2 = DB::table('regencies')->where('id', $request->id_kabupatennpwp)->first();
        $cek_address3 = DB::table('provinces')->where('id', $request->id_provinsinpwp)->first();
        $cek_address4 = DB::table('villages')->where('id', $request->id_desanpwp)->first();
        $data_users = DB::table('users')->where('id', $request->npwp_id_vendor)->first();
        // dd($data);
        if ($request->file_npwp == null) {
            // dd('a');
            $data = User::where('id', $request->npwp_id_vendor)->first();
            $data->nama_npwp     = $request->nama_npwp;
            $data->npwp     = $request->npwp;
            $data->id_provinsinpwp     = $request->id_provinsinpwp;
            $data->id_kabupatennpwp     = $request->id_kabupatennpwp;
            $data->id_kecamatannpwp     = $request->id_kecamatannpwp;
            $data->id_desanpwp     = $request->id_desanpwp;
            $data->rt_npwp        = $request->rt_npwp;
            $data->rw_npwp        = $request->rw_npwp;
            $data->taxpayerID        = $request->npwp;
            $data->SPS_NameNPWP_c        = $request->nama_npwp;
            $data->update();
        } else {
            // dd('b');
            if ($data_users->gambar_npwp != ''  && $data_users->gambar_npwp != null) {
                $path = '/home/sumb1497/public_html/bid.com/public/img/npwp/profile_user/';

                $file_old = $path . $data_users->gambar_npwp;
                if (file_exists($file_old)) {
                    unlink($file_old);
                }
            }
            $filenpwp       = $request->file('file_npwp');
            $imageNameNPWP  = time() . '.' . $request->file_npwp->extension();
            $moveNPWP       = $filenpwp->move('public/img/npwp/profile_user', $imageNameNPWP);
            $data = User::where('id', $request->npwp_id_vendor)->first();
            $data->nama_npwp     = $request->nama_npwp;
            $data->npwp     = $request->npwp;
            $data->id_provinsinpwp     = $request->id_provinsinpwp;
            $data->id_kabupatennpwp     = $request->id_kabupatennpwp;
            $data->id_kecamatannpwp     = $request->id_kecamatannpwp;
            $data->id_desanpwp     = $request->id_desanpwp;
            $data->rt_npwp        = $request->rt_npwp;
            $data->rw_npwp        = $request->rw_npwp;
            $data->gambar_npwp     = $imageNameNPWP;
            $data->taxpayerID        = $request->npwp;
            $data->SPS_NameNPWP_c        = $request->nama_npwp;
            $data->update();
        }
        // Integrasi Epicor
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/Vendor/UpdateVendor';
        $form_params = [
            'name'           => $data_users->nama_vendor,
            'groupcode'         => '1PBB',
            'vendorid'          => $data_users->vendorid,
            'sps_alias_c'       => $data_users->sps_alias_c,
            'address1'          => $data_users->address1,
            'address2'          => $data_users->address2,
            'address3'          => $data_users->city,
            'city'              => $data_users->city,
            'state'             => $data_users->state,
            'taxpayerid'        => $request->npwp,
            'sps_namenpwp_c'    => $request->nama_npwp,
            'sps_alamatnpwp_c'  => $cek_address1->name . ', ' . $cek_address2->name . ', ' . $cek_address3->name . ' INDONESIA',
            'inactive'          => 'false',
            'sps_phonenum_c'    => $data_users->SPS_phonenum_c,
            'emailaddress'      => $data_users->emailaddress,
            'termscode'         => 'N1',
            'bankAccountID'     => 'V01',
            'BankName'          => $data_users->BankName,
            'bankacctnumber'    => $data_users->BankAcctNumber,
            'bankbranchcode'    => $data_users->BankBranchCode,
            'sps_niksupplier_c' => $data_users->SPS_niksupplier_c
        ];
        $response = $client->post($url, ['form_params' => $form_params]);
        $response = $response->getBody()->getContents();
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.');
    }
    public function vendor_update_ktp(Request $request)
    {
        // dd($request->all());
        $cek_address1 = DB::table('districts')->where('id', $request->id_kecamatanktp)->first();
        $cek_address2 = DB::table('regencies')->where('id', $request->id_kabupatenktp)->first();
        $cek_address3 = DB::table('provinces')->where('id', $request->id_provinsiktp)->first();
        $cek_address4 = DB::table('villages')->where('id', $request->id_desaktp)->first();
        $data_users = DB::table('users')->where('id', $request->ktp_id_vendor)->first();
        // dd($data);
        if ($request->file_ktp == null) {
            // dd('a');
            $data = User::where('id', $request->ktp_id_vendor)->first();
            $data->nama_ktp     = $request->nama_ktp;
            $data->ktp     = $request->ktp;
            $data->id_provinsiktp     = $request->id_provinsiktp;
            $data->id_kabupatenktp     = $request->id_kabupatenktp;
            $data->id_kecamatanktp     = $request->id_kecamatanktp;
            $data->id_desaktp     = $request->id_desaktp;
            $data->rt_ktp        = $request->rt_ktp;
            $data->rw_ktp        = $request->rw_ktp;
            $data->address1        = $request->keterangan_alamat_ktp . ' RT. ' . $request->rt_ktp . ' / RW. ' . $request->rw_ktp;
            $data->address2        = 'KEL ' . $cek_address4->name . ', KEC. ' . $cek_address1->name;
            $data->address3        = $cek_address2->name;
            $data->city        = $cek_address2->name;
            $data->state        = $cek_address3->name;
            $data->SPS_niksupplier_c        = $request->ktp;
            $data->update();
        } else {
            // dd('b');
            if ($data_users->gambar_ktp != ''  && $data_users->gambar_ktp != null) {
                $path = '/home/sumb1497/public_html/bid.com/public/img/ktp/profile_user/';

                $file_old = $path . $data_users->gambar_ktp;
                if (file_exists($file_old)) {
                    unlink($file_old);
                }
            }
            $filektp       = $request->file('file_ktp');
            $imageNamektp  = time() . '.' . $request->file_ktp->extension();
            $movektp       = $filektp->move('public/img/ktp/profile_user', $imageNamektp);
            $data = User::where('id', $request->ktp_id_vendor)->first();
            $data->nama_ktp     = $request->nama_ktp;
            $data->ktp     = $request->ktp;
            $data->id_provinsiktp     = $request->id_provinsiktp;
            $data->id_kabupatenktp     = $request->id_kabupatenktp;
            $data->id_kecamatanktp     = $request->id_kecamatanktp;
            $data->id_desaktp     = $request->id_desaktp;
            $data->rt_ktp        = $request->rt_ktp;
            $data->rw_ktp        = $request->rw_ktp;
            $data->gambar_ktp     = $imageNamektp;
            $data->address1        = $request->keterangan_alamat_ktp . ' RT. ' . $request->rt_ktp . ' / RW. ' . $request->rw_ktp;
            $data->address2        = 'KEL ' . $cek_address4->name . ', KEC. ' . $cek_address1->name;
            $data->address3        = $cek_address2->name;
            $data->city        = $cek_address2->name;
            $data->state        = $cek_address3->name;
            $data->SPS_niksupplier_c        = $request->ktp;
            $data->update();
        }
        // Integrasi Epicor
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/Vendor/UpdateVendor';
        $form_params = [
            'name'           => $data_users->nama_vendor,
            'groupcode'         => '1PBB',
            'vendorid'          => $data_users->vendorid,
            'sps_alias_c'       => $data_users->sps_alias_c,
            'address1'          => 'RT. ' . $request->rt_ktp . ' / RW. ' . $request->rw_ktp,
            'address2'          => 'KEL ' . $cek_address4->name . ' KEC. ' . $cek_address1->name,
            'address3'          => $cek_address2->name,
            'city'              => $cek_address2->name,
            'state'             => $cek_address3->name,
            'taxpayerid'        => $data_users->npwp,
            'sps_namenpwp_c'    => $data_users->nama_npwp,
            'sps_alamatnpwp_c'  => $data_users->SPS_AlamatNPWP_c,
            'inactive'          => 'false',
            'sps_phonenum_c'    => $data_users->SPS_phonenum_c,
            'emailaddress'      => $data_users->emailaddress,
            'termscode'         => 'N1',
            'bankAccountID'     => 'V01',
            'BankName'          => $data_users->BankName,
            'bankacctnumber'    => $data_users->BankAcctNumber,
            'bankbranchcode'    => $data_users->BankBranchCode,
            'sps_niksupplier_c' => $request->ktp,
        ];
        $response = $client->post($url, ['form_params' => $form_params]);
        $response = $response->getBody()->getContents();
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.');
    }
    public function vendor_update_pembayaran(Request $request)
    {
        // dd($request->all());
        if ($request->nama_bank == 'BBRI') {
            $bank_code = 'BBRI';
            $bank_name = 'PT BANK RAKYAT INDONESIA (PERSERO) Tbk';
        } elseif ($request->nama_bank == 'BMRI') {
            $bank_code = 'BMRI';
            $bank_name = 'PT BANK MANDIRI (PERSERO) Tbk';
        } else {
            $bank_code = 'BBCA';
            $bank_name = 'PT BANK CENTRAL ASIA Tbk';
        }
        $data_users = DB::table('users')->where('id', $request->pembayaran_id_vendor)->first();
        // dd($data);
        // dd('a');
        $data = User::where('id', $request->pembayaran_id_vendor)->first();
        $data->nama_bank            = $data_users->nama_bank;
        $data->nomer_rekening       = $request->nomer_rekening;
        $data->nama_penerima_bank   = $request->nama_penerima_bank;
        $data->cabang_bank          = $request->cabang_bank;
        $data->BankAcctNumber       = $request->nomer_rekening;
        $data->BankName             = $bank_name;
        $data->BankBranchCode       = $bank_code;
        $data->update();

        // Integrasi Epicor
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/Vendor/UpdateVendor';
        $form_params = [
            'name'           => $data_users->nama_vendor,
            'groupcode'         => '1PBB',
            'vendorid'          => $data_users->vendorid,
            'sps_alias_c'       => $data_users->sps_alias_c,
            'address1'          => $data_users->address1,
            'address2'          => $data_users->address2,
            'address3'          => $data_users->city,
            'city'              => $data_users->city,
            'state'             => $data_users->state,
            'taxpayerid'        => $data_users->npwp,
            'sps_namenpwp_c'    => $data_users->nama_npwp,
            'sps_alamatnpwp_c'  => $data_users->SPS_AlamatNPWP_c,
            'inactive'          => 'false',
            'sps_phonenum_c'    => $data_users->SPS_phonenum_c,
            'emailaddress'      => $data_users->emailaddress,
            'termscode'         => 'N1',
            'bankAccountID'     => 'V01',
            'BankName'          => $bank_name,
            'bankacctnumber'    => $request->nomer_rekening,
            'bankbranchcode'    => $bank_code,
            'sps_niksupplier_c' => $data_users->ktp,
        ];
        $response = $client->post($url, ['form_params' => $form_params]);
        $response = $response->getBody()->getContents();
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.');
    }
    public function vendor_update_profil(Request $request)
    {
        // dd($request->all());
        $data_users = DB::table('users')->where('id', $request->profil_id_vendor)->first();
        // dd($data);
        if ($request->file_pakta == null && $request->file_fis == null) {
            // dd('a');
            $data = User::where('id', $request->profil_id_vendor)->first();
            $data->nama_vendor          = $request->nama_vendor;
            $data->name                 = $request->nama_vendor;
            $data->username             = $request->username;
            $data->sps_alias_c          = $request->sps_alias_c;
            $data->password             = Hash::make($request['password_show']);
            $data->password_show        = $request->password_show;
            $data->email                = $request->email;
            $data->SPS_phonenum_c       = $request->nomer_hp;
            $data->nomer_hp             = $request->nomer_hp;
            $data->emailaddress         = $request->email;
            $data->update();
        } else if ($request->file_pakta == null && $request->file_fis != null) {
            if ($data_users->fis != ''  && $data_users->fis != null) {
                $path = '/home/sumb1497/public_html/bid.com/public/img/fis/profile_user/';

                $file_old = $path . $data_users->fis;
                if (file_exists($file_old)) {
                    unlink($file_old);
                }
            }
            $filefis       = $request->file('file_fis');
            $imageNamefis  = time() . '.' . $request->file_fis->extension();
            $moveFIS       = $filefis->move('public/img/fis/profile_user', $imageNamefis);

            $data = User::where('id', $request->profil_id_vendor)->first();
            $data->nama_vendor          = $request->nama_vendor;
            $data->name                 = $request->nama_vendor;
            $data->username             = $request->username;
            $data->sps_alias_c          = $request->sps_alias_c;
            $data->password             = Hash::make($request['password_show']);
            $data->password_show        = $request->password_show;
            $data->email                = $request->email;
            $data->SPS_phonenum_c       = $request->nomer_hp;
            $data->nomer_hp             = $request->nomer_hp;
            $data->emailaddress         = $request->email;
            $data->fis     = $imageNamefis;
            $data->update();
        } else if ($request->file_pakta != null && $request->file_fis == null) {
            if ($data_users->pakta_integritas != ''  && $data_users->pakta_integritas != null) {
                $path = '/home/sumb1497/public_html/bid.com/public/img/pakta_integritas/profile_user/';

                $file_old = $path . $data_users->pakta_integritas;
                if (file_exists($file_old)) {
                    unlink($file_old);
                }
            }
            $filePakta       = $request->file('file_pakta');
            $imageNamePakta  = time() . '.' . $request->file_pakta->extension();
            $movepakta_integritas      = $filePakta->move('public/img/pakta_integritas/profile_user', $imageNamePakta);

            $data = User::where('id', $request->profil_id_vendor)->first();
            $data->nama_vendor          = $request->nama_vendor;
            $data->name                 = $request->nama_vendor;
            $data->sps_alias_c          = $request->sps_alias_c;
            $data->username             = $request->username;
            $data->password             = Hash::make($request['password_show']);
            $data->password_show        = $request->password_show;
            $data->email                = $request->email;
            $data->SPS_phonenum_c       = $request->nomer_hp;
            $data->nomer_hp             = $request->nomer_hp;
            $data->emailaddress         = $request->email;
            $data->pakta_integritas     = $imageNamePakta;
            $data->update();
        } else {
            if ($data_users->pakta_integritas != ''  && $data_users->pakta_integritas != null && $data_users->fis != ''  && $data_users->fis != null) {
                $path = '/home/sumb1497/public_html/bid.com/public/img/pakta_integritas/profile_user/';
                $path1 = '/home/sumb1497/public_html/bid.com/public/img/fis/profile_user/';

                $file_old = $path . $data_users->pakta_integritas;
                $file_old1 = $path1 . $data_users->fis;
                if (file_exists($file_old) && file_exists($file_old1)) {
                    unlink($file_old);
                    unlink($file_old1);
                }
            }
            $filePakta                  = $request->file('file_pakta');
            $imageNamePakta             = time() . '.' . $request->file_pakta->extension();
            $movePakta                  = $filePakta->move('public/img/pakta_integritas/profile_user', $imageNamePakta);
            $filefis                    = $request->file('file_fis');
            $imageNamefis               = time() . '.' . $request->file_fis->extension();
            $moveFIS                    = $filefis->move('public/img/fis/profile_user', $imageNamefis);

            $data = User::where('id', $request->profil_id_vendor)->first();
            $data->nama_vendor          = $request->nama_vendor;
            $data->name                 = $request->nama_vendor;
            $data->username             = $request->username;
            $data->sps_alias_c          = $request->sps_alias_c;
            $data->password             = Hash::make($request['password_show']);
            $data->password_show        = $request->password_show;
            $data->email                = $request->email;
            $data->SPS_phonenum_c       = $request->nomer_hp;
            $data->emailaddress         = $request->email;
            $data->nomer_hp             = $request->nomer_hp;
            $data->fis                  = $imageNamefis;
            $data->pakta_integritas     = $imageNamePakta;
            $data->update();
        }
        // Integrasi Epicor
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/Vendor/UpdateVendor';
        $form_params = [
            'name'           => $request->nama_vendor,
            'groupcode'         => '1PBB',
            'vendorid'          => $data_users->vendorid,
            'sps_alias_c'       => $request->sps_alias_c,
            'address1'          => $data_users->address1,
            'address2'          => $data_users->address2,
            'address3'          => $data_users->city,
            'city'              => $data_users->city,
            'state'             => $data_users->state,
            'taxpayerid'        => $data_users->npwp,
            'sps_namenpwp_c'    => $data_users->nama_npwp,
            'sps_alamatnpwp_c'  => $data_users->SPS_AlamatNPWP_c,
            'inactive'          => 'false',
            'sps_phonenum_c'    => $request->nomer_hp,
            'emailaddress'      => $data_users->email,
            'termscode'         => 'N1',
            'bankAccountID'     => 'V01',
            'BankName'          => $data_users->BankName,
            'bankacctnumber'    => $data_users->nomer_rekening,
            'bankbranchcode'    => $data_users->BankBranchCode,
            'sps_niksupplier_c' => $request->ktp,
        ];
        $response = $client->post($url, ['form_params' => $form_params]);
        $response = $response->getBody()->getContents();
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.');
    }
    public function vendor_print_form($id)
    {
        $data = DB::table('users')
            ->where('users.id', $id)->get();
        $users = ['users' => $data];
        // dd($users);
        $pdf = PDF::loadView('dashboard.admin_master.admin_sourching.vendor.cetak_form_vendor', $users);
        // $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('DATA FORM VENDOR.pdf');
        // return PDF::download(new UsersExport(), 'DATA VENDOR.pdf')->setPaper('a4', 'landscape');
    }
    public function vendor_export_pdf()
    {
        $data = DB::table('users')->get();
        $users = ['users' => $data];
        $pdf = PDF::loadView('dashboard.admin_master.admin_sourching.vendor.cetak_vendor', $users);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('DATA VENDOR.pdf');
        // return PDF::download(new UsersExport(), 'DATA VENDOR.pdf')->setPaper('a4', 'landscape');
    }

    public function vendor_print()
    {
        $users = DB::table('users')->get();
        return view('dashboard.admin_master.admin_sourching.vendor.print_vendor', compact('users'));
    }

    public function vendor_export_csv()
    {
        return Excel::download(new UsersExport(), 'DATA VENDOR.csv');
    }
    public function list_bid_po($id)
    {
        $get_users = DB::table('data_po')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.bid_user_id', $id)
            ->first();
        //dd($get_users->id);

        $waktu_pengajuan = DB::table('data_po')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.bid_user_id', $id)
            ->where('data_po.status_bid', '>=', 1)
            ->orderBy('data_po.id_data_po', 'DESC')
            ->first();
        //dd($waktu_pengajuan->user_id);

        $partisipasi = DB::table('approve_bid')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'approve_bid.bid_user_id')
            ->join('bid', 'bid.id_bid', '=', 'approve_bid.bid_id')
            ->join('users', 'users.id', '=', 'approve_bid.user_idbid')
            ->where('bid_user.user_id', $get_users->id)
            ->sum('bid_user.jumlah_kirim');
        // dd($partisipasi);

        $ditolak1 = DB::table('approve_bid')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'approve_bid.bid_user_id')
            ->join('bid', 'bid.id_bid', '=', 'approve_bid.bid_id')
            ->join('users', 'users.id', '=', 'approve_bid.user_idbid')
            ->where('bid_user.user_id', $waktu_pengajuan->user_id)
            ->sum('approve_bid.permintaan_ditolak');
        // ->get();
        $ditolak2 = DB::table('approve_bid')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'approve_bid.bid_user_id')
            ->join('bid', 'bid.id_bid', '=', 'approve_bid.bid_id')
            ->join('users', 'users.id', '=', 'approve_bid.user_idbid')
            ->join('data_po', 'data_po.id_approvebid', '=', 'approve_bid.id_approvebid')
            ->where('bid_user.user_id', $waktu_pengajuan->user_id)
            ->where('data_po.status_bid', 5)
            ->sum('data_po.permintaan_ditolak');
        $ditolak = $ditolak1 + $ditolak2;

        // $po_perhari = DB::table('data_po')
        // ->join('users','users.id','=','data_po.user_idbid')
        // ->where('data_po.status_bid','>=', 1)
        // ->where('data_po.bid_id', $get_users->bid_id)
        // ->count();

        $diproses = DB::table('data_po')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.user_idbid', $waktu_pengajuan->user_id)
            ->where('data_po.status_bid', '>=', 1)
            ->Where('data_po.status_bid', '!=', 5)
            ->Where('data_po.status_bid', '!=', 13)
            ->count();

        $data_diproses = DB::table('data_po')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('bid_user.id_biduser', $id)
            ->where('data_po.status_bid', '>=', 1)
            ->where('data_po.bid_user_id', $id)
            ->get();
        // dd($data_diproses);

        $diterima = DB::table('data_po')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 13)
            ->where('bid_user.user_id', $waktu_pengajuan->user_id)
            ->count();

        $riwayat_po = DB::table('data_po')->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.bid_user_id', $id)
            ->orderBy('data_po.id_data_po', 'DESC')
            ->get();

        $riwayat_po = DB::table('data_po')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->where('data_po.user_idbid', $waktu_pengajuan->user_id)
            ->where('data_po.status_bid', '>=', 1)
            ->Where('data_po.status_bid', '!=', 5)
            ->get();
        return view('dashboard.admin_master.admin_sourching.bid.list_po_bid', ['waktu_pengajuan' => $waktu_pengajuan, 'riwayat_po' => $riwayat_po, 'partisipasi' => $partisipasi, 'ditolak' => $ditolak, 'diterima' => $diterima, 'diproses' => $diproses, 'data_diproses' => $data_diproses]);
    }

    public function list_po_diterima()
    {
        return view('dashboard.admin_master.admin_sourching.data_sourching.data_list_po');
    }
    public function list_data_po_diterima_index()
    {

        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')

            ->where('penerimaan_po.status_penerimaan', '>', 5)
            ->orderBy('penerimaan_po.id_penerimaan_po', 'DESC')
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
            ->addColumn('batas_bid', function ($list) {
                $result = $list->batas_bid;
                return $result;
            })
            ->addColumn('waktu_penerimaan', function ($list) {
                $result = $list->waktu_penerimaan;
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
                        '<a style="margin:2px;" href="' . route('admin.home') . '"  class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
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
            ->rawColumns(['kode_po', 'nama_vendor', 'tanggal_po', 'batas_bid', 'waktu_penerimaan', 'plat_kendaraan', 'asal_gabah', 'ckelola'])
            ->make(true);
    }


    public function data_sourching_onprocess()
    {
        return view('dashboard.admin_master.admin_sourching.data_sourching.data_sourching_onprocess');
    }

    public function data_sourching_onprocess_gb_ciherang_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('bid.name_bid', 'GABAH BASAH CIHERANG')
                    ->where('lab2_gb.aksi_harga_gb', 'ON PROCESS')
                    ->where('lab2_gb.status_lab2_gb', 13)
                    ->orderBy('lab2_gb.id_lab2_gb', 'desc')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y ');
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
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
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
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return '
                    <div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-spinner"></i>	ON PROCESS
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button class="dropdown-item" id="btn_deal_gb" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-handshake"></i> DEAL</button>
							<button class="dropdown-item" id="btn_nego_gb" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-hand-holding-usd"></i> NEGO</button>
						</div>
					</div>';
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
                    ->rawColumns(['name_bid', 'nama_vendor', 'tanggal_po', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('bid.name_bid', 'GABAH BASAH CIHERANG')
                    ->where('lab2_gb.aksi_harga_gb', 'ON PROCESS')
                    ->where('lab2_gb.status_lab2_gb', 13)
                    ->orderBy('lab2_gb.id_lab2_gb', 'desc')
                    // ->whereBetween('lab2_gb.created_at', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y ');
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
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return $list->hasil_akhir_tonase;
                        }
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = 'Rp. ' . $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = 'Rp. ' . $list->harga_berdasarkan_tempat_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = 'Rp. ' . $list->harga_berdasarkan_harga_atas_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = 'Rp. ' . $list->harga_akhir_gb;
                        } else {
                            $result = 'Rp. ' . $list->harga_akhir_permintaan_gb;
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return '
                    <div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-spinner"></i>	ON PROCESS
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button class="dropdown-item" id="btn_deal_gb" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-handshake"></i> DEAL</button>
							<button class="dropdown-item" id="btn_nego_gb" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-hand-holding-usd"></i> NEGO</button>
						</div>
					</div>';
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
                    ->rawColumns(['name_bid', 'nama_vendor', 'tanggal_po', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_onprocess_gb_longgrain_index(Request $request)
    {
        // $data = DB::table('data_po')
        //     ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
        //     ->join('users', 'users.id', '=', 'data_po.user_idbid')
        //     ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
        //     ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
        //     ->where('lab2_gb.status_lab2_gb', 13)
        //     ->orWhere('lab2_gb.aksi_harga_gb', '=', 'ON PROCESS')
        //     ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
        //     ->orderBy('lab2_gb.id_lab2_gb', 'desc')
        //     // ->whereBetween('lab2_gb.created_at', array($request->from_date, $request->to_date))
        //     ->get();
        // dd($data);
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', '=', 'ON PROCESS')
                    ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
                    ->orderBy('lab2_gb.id_lab2_gb', 'desc')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y ');
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
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
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
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return '
                    <div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-spinner"></i>	ON PROCESS
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button class="dropdown-item" id="btn_deal_gb" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-handshake"></i> DEAL</button>
							<button class="dropdown-item" id="btn_nego_gb" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-hand-holding-usd"></i> NEGO</button>
						</div>
					</div>';
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
                    ->rawColumns(['name_bid', 'nama_vendor', 'tanggal_po', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    // ->where('lab2_gb.status_lab2_gb', 13)
                    ->where('lab2_gb.aksi_harga_gb', '=', 'ON PROCESS')
                    ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
                    ->orderBy('lab2_gb.id_lab2_gb', 'desc')
                    // ->whereBetween('lab2_gb.created_at', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y ');
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
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return $list->hasil_akhir_tonase;
                        }
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = 'Rp. ' . $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = 'Rp. ' . $list->harga_berdasarkan_tempat_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = 'Rp. ' . $list->harga_berdasarkan_harga_atas_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = 'Rp. ' . $list->harga_akhir_gb;
                        } else {
                            $result = 'Rp. ' . $list->harga_akhir_permintaan_gb;
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return '
                    <div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-spinner"></i>	ON PROCESS
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button class="dropdown-item" id="btn_deal_gb" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-handshake"></i> DEAL</button>
							<button class="dropdown-item" id="btn_nego_gb" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-hand-holding-usd"></i> NEGO</button>
						</div>
					</div>';
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
                    ->rawColumns(['name_bid', 'nama_vendor', 'tanggal_po', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_onprocess_gb_pandan_wangi_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', '=', 'ON PROCESS')
                    ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
                    ->orderBy('lab2_gb.id_lab2_gb', 'desc')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y ');
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
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
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
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return '
                    <div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-spinner"></i>	ON PROCESS
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button class="dropdown-item" id="btn_deal_gb" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-handshake"></i> DEAL</button>
							<button class="dropdown-item" id="btn_nego_gb" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-hand-holding-usd"></i> NEGO</button>
						</div>
					</div>';
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
                    ->rawColumns(['name_bid', 'nama_vendor', 'tanggal_po', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', '=', 'ON PROCESS')
                    ->where('bid.name_bid', 'GABAH BASAH PANDAN WANGI')
                    ->orderBy('lab2_gb.id_lab2_gb', 'desc')
                    // ->whereBetween('lab2_gb.created_at', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y ');
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
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return $list->hasil_akhir_tonase;
                        }
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = 'Rp. ' . $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = 'Rp. ' . $list->harga_berdasarkan_tempat_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = 'Rp. ' . $list->harga_berdasarkan_harga_atas_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = 'Rp. ' . $list->harga_akhir_gb;
                        } else {
                            $result = 'Rp. ' . $list->harga_akhir_permintaan_gb;
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return '
                    <div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-spinner"></i>	ON PROCESS
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button class="dropdown-item" id="btn_deal_gb" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-handshake"></i> DEAL</button>
							<button class="dropdown-item" id="btn_nego_gb" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-hand-holding-usd"></i> NEGO</button>
						</div>
					</div>';
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
                    ->rawColumns(['name_bid', 'nama_vendor', 'tanggal_po', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_onprocess_gb_ketan_putih_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', '=', 'ON PROCESS')
                    ->where('bid.name_bid', 'GABAH BASAH KETAN PUTIH')
                    ->orderBy('lab2_gb.id_lab2_gb', 'desc')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y ');
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
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
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
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return '
                    <div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-spinner"></i>	ON PROCESS
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button class="dropdown-item" id="btn_deal_gb" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-handshake"></i> DEAL</button>
							<button class="dropdown-item" id="btn_nego_gb" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-hand-holding-usd"></i> NEGO</button>
						</div>
					</div>';
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
                    ->rawColumns(['name_bid', 'nama_vendor', 'tanggal_po', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', '=', 'ON PROCESS')
                    ->where('bid.name_bid', 'GABAH BASAH KETAN PUTIH')
                    ->orderBy('lab2_gb.id_lab2_gb', 'desc')
                    // ->whereBetween('lab2_gb.created_at', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y ');
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
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return $list->hasil_akhir_tonase;
                        }
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = 'Rp. ' . $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = 'Rp. ' . $list->harga_berdasarkan_tempat_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = 'Rp. ' . $list->harga_berdasarkan_harga_atas_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = 'Rp. ' . $list->harga_akhir_gb;
                        } else {
                            $result = 'Rp. ' . $list->harga_akhir_permintaan_gb;
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return '
                    <div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-spinner"></i>	ON PROCESS
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button class="dropdown-item" id="btn_deal_gb" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-handshake"></i> DEAL</button>
							<button class="dropdown-item" id="btn_nego_gb" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-hand-holding-usd"></i> NEGO</button>
						</div>
					</div>';
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
                    ->rawColumns(['name_bid', 'nama_vendor', 'tanggal_po', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_onprocess_pk_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab1_pk', 'lab1_pk.lab1_kode_po_pk', '=', 'data_po.kode_po')
                    ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->where('lab2_pk.aksi_harga_pk', 'ON PROCESS')
                    ->where('lab2_pk.status_lab2_pk', 13)

                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('harga_atas_pk', function ($list) {
                        $result = rupiah($list->harga_atas_pk) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal_incoming_pk', function ($list) {
                        $result = rupiah($list->harga_awal_pk) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_akhir_incoming_pk', function ($list) {
                        $result = rupiah($list->harga_akhir_pk) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('plan_harga_bongkaran', function ($list) {
                        $result = rupiah($list->plan_harga_bongkaran) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_bongkaran_pk', function ($list) {
                        $result = rupiah($list->harga_bongkaran_pk) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('aksi_harga_pk', function ($list) {
                        $result = $list->aksi_harga_pk;
                        return '
                    <div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-spinner"></i>	ON PROCESS
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button class="dropdown-item" id="btn_deal_pk" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-handshake"></i> DEAL</button>
							<button class="dropdown-item" id="btn_nego_pk" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-hand-holding-usd"></i> NEGO</button>
						</div>
					</div>';
                    })

                    ->rawColumns(['name_bid', 'nama_vendor', 'harga_akhir_incoming_pk,', 'harga_awal_incoming_pk', 'tanggal_po', 'kode_po', 'plat_kendaraan', 'harga_atas_pk', 'plan_harga_bongkaran', 'haraga_bongkaran_pk', 'aksi_harga_pk'])
                    ->make(true);
            } else {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab1_pk', 'lab1_pk.lab1_kode_po_pk', '=', 'data_po.kode_po')
                    ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->where('lab2_pk.aksi_harga_pk', 'ON PROCESS')
                    ->where('lab2_pk.status_lab2_pk', 13)
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('harga_atas_pk', function ($list) {
                        $result = rupiah($list->harga_atas_pk) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal_incoming_pk', function ($list) {
                        $result = rupiah($list->harga_awal_pk) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_akhir_incoming_pk', function ($list) {
                        $result = rupiah($list->harga_akhir_pk) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('plan_harga_bongkaran', function ($list) {
                        $result = rupiah($list->plan_harga_bongkaran) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_bongkaran_pk', function ($list) {
                        $result = rupiah($list->harga_bongkaran_pk) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('aksi_harga_pk', function ($list) {
                        $result = $list->aksi_harga_pk;
                        return '
                    <div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-spinner"></i>	ON PROCESS
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button class="dropdown-item" id="btn_deal_pk" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-handshake"></i> DEAL</button>
							<button class="dropdown-item" id="btn_nego_pk" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-hand-holding-usd"></i> NEGO</button>
						</div>
					</div>';
                    })

                    ->rawColumns(['name_bid', 'nama_vendor', 'harga_akhir_incoming_pk,', 'harga_awal_incoming_pk', 'tanggal_po', 'kode_po', 'plat_kendaraan', 'harga_atas_pk', 'plan_harga_bongkaran', 'haraga_bongkaran_pk', 'aksi_harga_pk'])
                    ->make(true);
            }
        }
    }
    public function status_deal_gb($id)
    {
        // dd($id);
        $data = DB::table('penerimaan_po')
            ->join('data_po', 'data_po.id_data_po', '=', 'penerimaan_po.penerimaan_id_data_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'penerimaan_po.penerimaan_kode_po')
            ->where('penerimaan_po.id_penerimaan_po', '=', $id)->first();
        // dd($data);
        $log                                    = new LogAktivitySourching();
        $log->name_user                         = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_sourching      = $data->id_penerimaan_po;
        $log->aktivitas_sourching               = 'Status Deal Kode PO : ' . $data->penerimaan_kode_po . ' Harga Akhir: ' . rupiah($data->harga_akhir_gb) . ' Reaksi Harga : ' . rupiah($data->reaksi_harga_gb);
        $log->keterangan_aktivitas              = 'Selesai';
        $log->created_at                        = date('Y-m-d H:i:s');
        $log->save();

        $get_bin_num = DB::table('data_qc_bongkar')
            ->where('kode_po_bongkar', $data->penerimaan_kode_po)->first();
        // dd($get_bin_num->lokasi_bongkar_gb);
        if ($get_bin_num->tempat_bongkar == 'UTARA') {
            $bin_num = 'BNNGWDUA03';
        } else if ($get_bin_num->tempat_bongkar == 'SELATAN') {
            $bin_num = 'BNNGWDUA02';
        }
        if ($data->harga_akhir_permintaan_gb == 'NULL' || $data->harga_akhir_permintaan_gb == '') {
            $get_harga = $data->harga_akhir_gb;
        } else {
            $get_harga = $data->harga_akhir_permintaan_gb;
        }
        $data_LAB2 = DB::table('lab2_gb')->where('lab2_kode_po_gb', $data->penerimaan_kode_po)->update(['aksi_harga_gb' => 'DEAL']);
        //  Integrasi Epicor
        // dd($data);
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/PO/UpdatePO';
        $form_params = [
            'PONum'         => $data->penerimaan_po_num,
            'Quantity'      => $data->netto2,
            'UnitPrice'     => $get_harga,
            'nobks_c'       => $data->dtm_gb,
            'codepo_c'      => $data->penerimaan_kode_po,
            'plant'         => 'NGW',
            'WarehouseCode' => 'WHNGWDUA',
            'BinNum'        => $bin_num,
            'SPS_Nopol_c'   => $data->plat_kendaraan,
            'PTI_PONum_c'   => $data->penerimaan_kode_po,
            'SPS_PODate_c'   => $data->tanggal_po,
        ];
        $response = $client->post($url, ['form_params' => $form_params]);
        $response = $response->getBody()->getContents();
        // dd($response);   
        // return redirect()->back();
    }
    public function status_deal_pk($id)
    {
        $data = DB::table('penerimaan_po')
            ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'penerimaan_po.penerimaan_kode_po')
            ->where('penerimaan_po.id_penerimaan_po', '=', $id)->first();
        // $get_bin_num = DB::table('data_qc_bongkar')
        //     ->where('kode_po_bongkar', $data->penerimaan_kode_po)->first();
        // dd($get_bin_num->lokasi_bongkar_gb);
        // if ($get_bin_num->tempat_bongkar == 'UTARA') {
        //     $bin_num = 'BINUTNGW';
        // } else if ($get_bin_num->tempat_bongkar == 'SELATAN') {
        //     $bin_num = 'BINSLNGW';
        // }
        //  Integrasi Epicor
        // dd($data);
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/PO/UpdatePO';
        $form_params = [
            'PONum'         => $data->penerimaan_po_num,
            'Quantity'      => $data->netto2,
            'UnitPrice'     => $data->harga_bongkaran_pk,
            'nobks_c'       => $data->no_dtm_pk,
            'codepo_c'      => $data->penerimaan_kode_po,
            'plant'         => 'NGW',
            'WarehouseCode' => 'WHDRNGW',
            'BinNum'        => '',
            'SPS_Nopol_c'   => $data->plat_kendaraan,
            'PTI_PONum_c'   => $data->penerimaan_kode_po
        ];
        $response = $client->post($url, ['form_params' => $form_params]);
        $response = $response->getBody()->getContents();
        $data_LAB2 = DB::table('lab1_pk')->where('lab1_kode_po_pk', $data->penerimaan_kode_po)->update(['aksi_harga_pk' => 'DEAL']);
        $data_LAB2 = DB::table('lab2_pk')->where('lab2_kode_po_pk', $data->penerimaan_kode_po)->update(['aksi_harga_pk' => 'DEAL']);
        // return redirect()->back();
    }
    public function status_nego_gb($id)
    {
        // return redirect()->back();
        $data = DB::table('penerimaan_po')->where('id_penerimaan_po', $id)->first();
        $data_LAB2 = DB::table('lab2_gb')->where('lab2_kode_po_gb', $data->penerimaan_kode_po)->update(['aksi_harga_gb' => 'NEGO']);
        $log                                    = new LogAktivitySourching();
        $log->name_user                         = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_sourching      = $data->id_penerimaan_po;
        $log->aktivitas_sourching               = 'Status Nego Kode PO:' . $data->penerimaan_kode_po . ' Harga Akhir: ' . rupiah($data->harga_akhir_gb) . ' Reaksi Harga : ' . rupiah($data->reaksi_harga_gb);
        $log->keterangan_aktivitas              = 'Selesai';
        $log->created_at                        = date('Y-m-d H:i:s');
        $log->save();
    }
    public function status_nego_pk($id)
    {
        $data = DB::table('penerimaan_po')->where('id_penerimaan_po', $id)->first();
        $data_LAB2 = DB::table('lab1_pk')->where('lab1_kode_po_pk', $data->penerimaan_kode_po)->update(['aksi_harga_pk' => 'NEGO']);
        // return redirect()->back();
    }
    public function data_sourching_nego()
    {
        return view('dashboard.admin_master.admin_sourching.data_sourching.data_sourching_nego');
    }
    public function data_sourching_nego_gb_longgrain_index(Request $request)
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
                    ->where('lab2_gb.aksi_harga_gb', 'NEGO')
                    ->orWhere('lab2_gb.aksi_harga_gb', 'PROCESS NEGO')

                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at_gb)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
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
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = $list->reaksi_harga_gb;
                        if ($result == '' | $result == null) {
                            $result = 'Rp. -';
                            return $result;
                        } else {
                            $result = rupiah($list->reaksi_harga_gb);
                        }
                    })
                    ->addColumn('harga_akhir_gb', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return
                            '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-exclamation"></i>' . $result . '
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_deal_gb" data-id="' . $list->id_penerimaan_po . '" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Deal</button>
						</div>
					</div>';
                    })
                    ->rawColumns(['name_bid', 'nama_vendor', 'date', 'date_bid', 'kode_po', 'plat_kendaraan', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            } else {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
                    ->where('lab2_gb.aksi_harga_gb', 'NEGO')
                    ->orWhere('lab2_gb.aksi_harga_gb', 'PROCESS NEGO')

                    // ->whereBetween('lab2_gb.created_at', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at_gb)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
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
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_akhir_gb', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return
                            '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-exclamation"></i>' . $result . '
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_deal_gb" data-id="' . $list->id_penerimaan_po . '" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Deal</button>
						</div>
					</div>';
                    })
                    ->rawColumns(['name_bid', 'nama_vendor', 'date', 'date_bid', 'kode_po', 'plat_kendaraan', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_nego_gb_ciherang_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('bid.name_bid', '=', 'GABAH BASAH CIHERANG')
                    ->where('lab2_gb.aksi_harga_gb', 'NEGO')
                    ->orWhere('lab2_gb.aksi_harga_gb', 'PROCESS NEGO')

                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at_gb)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
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
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = $list->reaksi_harga_gb;
                        if ($result == '' | $result == null) {
                            $result = 'Rp. -';
                            return $result;
                        } else {
                            $result = rupiah($list->reaksi_harga_gb);
                        }
                    })
                    ->addColumn('harga_akhir_gb', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return
                            '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-exclamation"></i>' . $result . '
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_deal_gb" data-id="' . $list->id_penerimaan_po . '" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Deal</button>
						</div>
					</div>';
                    })
                    ->rawColumns(['name_bid', 'nama_vendor', 'date', 'date_bid', 'kode_po', 'plat_kendaraan', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            } else {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('bid.name_bid', '=', 'GABAH BASAH CIHERANG')
                    ->where('lab2_gb.aksi_harga_gb', 'NEGO')
                    ->orWhere('lab2_gb.aksi_harga_gb', 'PROCESS NEGO')

                    // ->whereBetween('lab2_gb.created_at', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at_gb)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
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
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_akhir_gb', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return
                            '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-exclamation"></i>' . $result . '
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_deal_gb" data-id="' . $list->id_penerimaan_po . '" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Deal</button>
						</div>
					</div>';
                    })
                    ->rawColumns(['name_bid', 'nama_vendor', 'date', 'date_bid', 'kode_po', 'plat_kendaraan', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_nego_gb_pandan_wangi_index(Request $request)
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
                    ->where('lab2_gb.aksi_harga_gb', 'NEGO')
                    ->orWhere('lab2_gb.aksi_harga_gb', 'PROCESS NEGO')

                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at_gb)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
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
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = $list->reaksi_harga_gb;
                        if ($result == '' | $result == null) {
                            $result = 'Rp. -';
                            return $result;
                        } else {
                            $result = rupiah($list->reaksi_harga_gb);
                        }
                    })
                    ->addColumn('harga_akhir_gb', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return
                            '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-exclamation"></i>' . $result . '
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_deal_gb" data-id="' . $list->id_penerimaan_po . '" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Deal</button>
						</div>
					</div>';
                    })
                    ->rawColumns(['name_bid', 'nama_vendor', 'date', 'date_bid', 'kode_po', 'plat_kendaraan', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            } else {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
                    ->where('lab2_gb.aksi_harga_gb', 'NEGO')
                    ->orWhere('lab2_gb.aksi_harga_gb', 'PROCESS NEGO')

                    // ->whereBetween('lab2_gb.created_at', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at_gb)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
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
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_akhir_gb', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return
                            '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-exclamation"></i>' . $result . '
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_deal_gb" data-id="' . $list->id_penerimaan_po . '" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Deal</button>
						</div>
					</div>';
                    })
                    ->rawColumns(['name_bid', 'nama_vendor', 'date', 'date_bid', 'kode_po', 'plat_kendaraan', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_nego_gb_ketan_putih_index(Request $request)
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
                    ->where('lab2_gb.aksi_harga_gb', 'NEGO')
                    ->orWhere('lab2_gb.aksi_harga_gb', 'PROCESS NEGO')

                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at_gb)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
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
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = $list->reaksi_harga_gb;
                        if ($result == '' | $result == null) {
                            $result = 'Rp. -';
                            return $result;
                        } else {
                            $result = rupiah($list->reaksi_harga_gb);
                        }
                    })
                    ->addColumn('harga_akhir_gb', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return
                            '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-exclamation"></i>' . $result . '
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_deal_gb" data-id="' . $list->id_penerimaan_po . '" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Deal</button>
						</div>
					</div>';
                    })
                    ->rawColumns(['name_bid', 'nama_vendor', 'date', 'date_bid', 'kode_po', 'plat_kendaraan', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            } else {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
                    ->where('lab2_gb.aksi_harga_gb', 'NEGO')
                    ->orWhere('lab2_gb.aksi_harga_gb', 'PROCESS NEGO')

                    // ->whereBetween('lab2_gb.created_at', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at_gb)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
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
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_akhir_gb', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return
                            '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-exclamation"></i>' . $result . '
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_deal_gb" data-id="' . $list->id_penerimaan_po . '" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Deal</button>
						</div>
					</div>';
                    })
                    ->rawColumns(['name_bid', 'nama_vendor', 'date', 'date_bid', 'kode_po', 'plat_kendaraan', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_nego_pk_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->where('lab2_pk.aksi_harga_pk', 'NEGO')
                    ->orWhere('lab2_pk.aksi_harga_pk', 'PROCESS NEGO')

                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at_pk)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = rupiah($list->plan_harga_beli_gabah_pk) . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_tempat_pk) . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_pk) . '/Kg';
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_pk) . '/Kg';
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_pk) . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_akhir_pk', function ($list) {
                        $result = $list->harga_akhir_permintaan_pk;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_pk);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_pk);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_pk;
                        return '
                <a style="margin:2px;" title="Information" class="lokasi_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
                    })
                    ->rawColumns(['name_bid', 'nama_vendor', 'date', 'date_bid', 'kode_po', 'plat_kendaraan', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            } else {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab1_pk', 'lab1_pk.lab1_kode_po_pk', '=', 'data_po.kode_po')
                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->where('lab1_pk.aksi_harga_pk', 'NEGO')
                    ->orWhere('lab1_pk.aksi_harga_pk', 'PROCESS NEGO')

                    // ->whereBetween('lab2_pk.created_at', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at_pk)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase . 'Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal_pk', function ($list) {
                        $result = rupiah($list->harga_awal_pk) . '/Kg';
                        return $result;
                    })
                    ->addColumn('reaksi_harga_pk', function ($list) {
                        $result = rupiah($list->reaksi_harga_pk) . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_akhir_pk', function ($list) {
                        $result = $list->harga_akhir_permintaan_pk;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_pk);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_pk);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_pk;
                        return '
                <a style="margin:2px;" title="Information" class="lokasi_bongkar btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
                    })
                    ->rawColumns(['name_bid', 'nama_vendor', 'date', 'date_bid', 'kode_po', 'plat_kendaraan', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_output_nego()
    {
        return view('dashboard.admin_master.admin_sourching.data_sourching.data_sourching_output_nego');
    }

    public function data_sourching_output_nego_gb_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'OUTPUT NEGO')
                    ->where('bid.name_bid', 'LIKE', '%GABAH BASAH%')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
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
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
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
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_akhir_gb', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return '
                    <div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-spinner"></i> OUTPUT NEGO
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_deal_gb" class="dropdown-item" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-handshake"></i>DEAL</button>
						</div>
					</div>';
                    })
                    ->rawColumns(['name_bid', 'nama_vendor', 'date', 'date_bid', 'kode_po', 'plat_kendaraan', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'harga_akhir', 'reaksi_harga'])
                    ->make(true);
            } else {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'OUTPUT NEGO')
                    ->where('bid.name_bid', 'LIKE', '%GABAH BASAH%')
                    // ->whereBetween('lab2_gb.created_at', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
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
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
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
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_akhir_gb', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        return '
                    <div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-spinner"></i> OUTPUT NEGO
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_deal_gb" class="dropdown-item" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-handshake"></i>DEAL</button>
						</div>
					</div>';
                    })
                    ->rawColumns(['name_bid', 'nama_vendor', 'date', 'date_bid', 'kode_po', 'plat_kendaraan', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'harga_akhir', 'reaksi_harga'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_output_nego_pk_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'OUTPUT NEGO')
                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = $list->tonase_awal;
                        return tonase($result);
                    })
                    ->addColumn('tonase_akhir_pk', function ($list) {
                        $result = $list->tonase_akhir;
                        return tonase($result);
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
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
                        $result = rupiah($list->harga_awal_pk) . '/Kg';
                        return $result;
                    })
                    ->addColumn('reaksi_harga_pk', function ($list) {
                        $result = rupiah($list->reaksi_harga_pk) . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_akhir_pk', function ($list) {
                        $result = $list->harga_akhir_permintaan_pk;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_pk);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_pk);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga_pk', function ($list) {
                        $result = $list->aksi_harga_pk;
                        return '<div class="dropdown"><button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-spinner"></i> OUTPUT NEGO
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_deal_pk" class="dropdown-item" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-handshake"></i>DEAL</button>
						</div>
					</div>';
                    })
                    ->rawColumns(['name_bid', 'nama_vendor', 'date', 'date_bid', 'kode_po', 'plat_kendaraan', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga_pk', 'harga_akhir', 'reaksi_harga'])
                    ->make(true);
            } else {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab1_pk', 'lab1_pk.lab1_kode_po_pk', '=', 'data_po.kode_po')
                    ->where('lab1_pk.aksi_harga_pk', 'OUTPUT NEGO')
                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    // ->whereBetween('lab2_pk.created_at', array($request->from_date, $request->to_date))
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = $list->tonase_awal;
                        return tonase($result);
                    })
                    ->addColumn('tonase_akhir_pk', function ($list) {
                        $result = $list->tonase_akhir;
                        return tonase($result);
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
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
                        $result = rupiah($list->harga_awal_pk) . '/Kg';
                        return $result;
                    })
                    ->addColumn('reaksi_harga_pk', function ($list) {
                        $result = rupiah($list->reaksi_harga_pk) . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_akhir_pk', function ($list) {
                        $result = $list->harga_akhir_permintaan_pk;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_pk);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_pk);
                        }
                        return $result;
                    })
                    ->addColumn('aksi_harga_pk', function ($list) {
                        $result = $list->aksi_harga_pk;
                        return '<div class="dropdown"><button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-spinner"></i> OUTPUT NEGO
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_deal_pk" class="dropdown-item" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-handshake"></i>DEAL</button>
						</div>
					</div>';
                    })
                    ->rawColumns(['name_bid', 'nama_vendor', 'date', 'date_bid', 'kode_po', 'plat_kendaraan', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga_pk', 'harga_akhir', 'reaksi_harga'])
                    ->make(true);
            }
        }
    }
    public function tagihan()
    {
        return view('dashboard.admin_master.admin_sourching.tagihan.tagihan');
    }
    public function upload_tagihan(Request $request)
    {
        $filetagihan       = $request->file('tagihan_file');
        $imageNamebroadcast  = time() . '.' . $request->tagihan_file->extension();
        $movetagihan       = $filetagihan->move('public/dokumen/tagihan/', $imageNamebroadcast);
        if ($request->bulan == 'lalu') {
            $query = DB::table('broadcast')
                ->insert([
                    'broadcast_user_id' => $request->id_user,
                    'broadcast_kategory' => 'TAGIHAN',
                    'broadcast_judul' => $request->judul_tagihan,
                    'broadcast_text' => $request->keterangan_tagihan,
                    'broadcast_file' => $imageNamebroadcast,
                    'broadcast_date' => Carbon::now()->subMonthsNoOverflow()->startOfMonth(),
                    'broadcast_status' => '1',
                    'status_notif_user' => '0',
                    'status_baca' => '0',
                    'broadcaster' =>  Auth::guard('master')->user()->name_master,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
        } else if ($request->bulan == 'now') {
            $query = DB::table('broadcast')
                ->insert([
                    'broadcast_user_id' => $request->id_user,
                    'broadcast_kategory' => 'TAGIHAN',
                    'broadcast_judul' => $request->judul_tagihan,
                    'broadcast_text' => $request->keterangan_tagihan,
                    'broadcast_file' => $imageNamebroadcast,
                    'broadcast_date' => Carbon::now()->startOfMonth(),
                    'broadcast_status' => '1',
                    'status_notif_user' => '0',
                    'status_baca' => '0',
                    'broadcaster' =>  Auth::guard('master')->user()->name_master,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
        }
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data Anda Tersimpan');
    }
    public function update_tagihan(Request $request)
    {
        $path = '/home/u1736638/public_html/ngawi.suryapangansemesta.store/public/dokumen/tagihan/';

        $file_old = $path . $request->tagihan_file_old;
        unlink($file_old);
        $filetagihan       = $request->file('tagihan_file_update');
        $imageNametagihan  = time() . '.' . $request->tagihan_file_update->extension();
        $movetagihan       = $filetagihan->move('public/dokumen/tagihan/', $imageNametagihan);
        $query = DB::table('broadcast')
            ->where('id_broadcast', $request->id_tagihan)
            ->update([
                'broadcast_judul' => $request->judul_tagihan_update,
                'broadcast_text' => $request->keterangan_tagihan_update,
                'broadcast_file' => $imageNametagihan,
                'broadcaster' =>  Auth::guard('master')->user()->name_master,
            ]);
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data Anda Tersimpan');
    }
    public function delete_tagihan($id)
    {
        $cek = DB::table('broadcast')
            ->where('id_broadcast', $id)
            ->first();
        $path = '/home/u1736638/public_html/ngawi.suryapangansemesta.store/public/dokumen/tagihan/';

        $file_old = $path . $cek->broadcast_file;
        unlink($file_old);
        $query = DB::table('broadcast')->where('id_broadcast', $id)->delete();
    }
    public function tagihan_index()
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
            // ->leftjoin('tagihan', 'tagihan.tagihan_id_user', 'users.id')
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
                $cek = DB::table('broadcast')
                    ->where('broadcast_user_id', $list->id)
                    ->whereMonth('broadcast_date', Carbon::now()->subMonthsNoOverflow()->isoFormat('M'))
                    ->first();
                if (empty($cek)) {
                    return '
                        <button id="btn_modal_upload" style="margin:2px;" data-id="' . $list->id . '" data-bulan="lalu" data-offset="5px 5px" data-toggle="m-tooltip" title="Ubah status" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-file"></i> Upload
                        </button>';
                } else {
                    if ($cek->broadcast_status == 1) {
                        return '
                            <button disabled data-id="' . $list->id . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Upload File" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-file"></i> Upload
                            </button>
                            <a href="javascript:void(0);" data-id="' . $cek->id_broadcast . '" data-bulan="lalu" example1 data-tagihan="' . $cek->broadcast_file . '" data-judul="' . $cek->broadcast_judul . '" data-keterangan="' . $cek->broadcast_text . '"  id="btn_edit_tagihan" data-offset="5px 5px" data-toggle="m-tooltip" title="Ubah File" onclick="return true" class="toyakin btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-edit text-warning"></i>
                            </a>
                            <a href="javascript:void(0);" data-id="' . $cek->id_broadcast . '" data-offset="5px 5px" id="btn_hapus_tagihan" data-toggle="m-tooltip" title="Hapus" onclick="return true" class="toyakin btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-trash text-danger"></i>
                            </a>';
                    } else {
                        return '
                            <button id="btn_modal_upload" style="margin:2px;" data-id="' . $list->id . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Ubah status" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-file"></i> Upload
                            </button>';
                    }
                }
            })
            ->rawColumns(['nama_vendor', 'total_po', 'ckelola'])
            ->make(true);
    }
    public function tagihan1_index()
    {
        // dd(DB::table('data_po')
        //     ->join('users', 'users.id', 'data_po.user_idbid')
        //     ->where('data_po.status_bid', '!=', '5')
        //     ->groupBy('data_po.user_idbid')
        //     ->get());
        return Datatables::of(DB::table('data_po')
            ->join('users', 'users.id', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', 'data_po.id_data_po')
            // ->leftjoin('tagihan', 'tagihan.tagihan_id_user', 'users.id')
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
                $cek = DB::table('broadcast')
                    ->where('broadcast_user_id', $list->id)
                    ->whereMonth('broadcast_date', Carbon::now()->month)
                    ->first();
                if (empty($cek)) {
                    return '
                        <button id="btn_modal_upload" style="margin:2px;" data-id="' . $list->id . '" data-bulan="now" data-offset="5px 5px" data-toggle="m-tooltip" title="Ubah status" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                        <i class="fa fa-file"></i> Upload
                        </button>';
                } else {
                    if ($cek->broadcast_status == 1) {
                        return '
                            <button disabled data-id="' . $list->id . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Upload File" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-file"></i> Upload
                            </button>
                            <a href="javascript:void(0);" data-id="' . $cek->id_broadcast . '" data-bulan="now" example1 data-tagihan="' . $cek->broadcast_file . '" data-judul="' . $cek->broadcast_judul . '" data-keterangan="' . $cek->broadcast_text . '"  id="btn_edit_tagihan" data-offset="5px 5px" data-toggle="m-tooltip" title="Ubah File" onclick="return true" class="toyakin btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-edit text-warning"></i>
                            </a>
                            <a href="javascript:void(0);" data-id="' . $cek->id_broadcast . '" data-offset="5px 5px" id="btn_hapus_tagihan" data-toggle="m-tooltip" title="Hapus" onclick="return true" class="toyakin btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-trash text-danger"></i>
                            </a>';
                    } else {
                        return '
                            <button id="btn_modal_upload" style="margin:2px;" data-id="' . $list->id . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Ubah status" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-file"></i> Upload
                            </button>';
                    }
                }
            })
            ->rawColumns(['nama_vendor', 'total_po', 'ckelola'])
            ->make(true);
    }
    public function download_data_sourching_deal_filter_gb_excel(Request $request)
    {
        $from_date  = $request->from_date;
        $to_date  = $request->to_date;
        dd($from_date . '-' . $to_date);
        // return Excel::download(new DataSouchingDealGBExcel($from_date, $to_date), 'DATA SOURCHING DEAL GABAH BASAH NGAWI.xlsx');
    }
    public function download_data_sourching_deal_gb_excel(Request $request)
    {
        $from_date  = $request->from_date;
        $to_date  = $request->to_date;
        // dd($from_date . '-' . $to_date);

        return Excel::download(new DataSouchingDealGBExcel($from_date, $to_date), 'DATA SOURCHING DEAL GABAH BASAH NGAWI.xlsx');
    }
    public function download_data_sourching_deal_pk_excel(Request $request)
    {
        $from_date  = $request->from_date;
        $to_date  = $request->to_date;
        return Excel::download(new DataSouchingDealPKExcel($from_date, $to_date), 'DATA SOURCHING DEAL PK.xlsx');
    }
    public function broadcast()
    {

        return view('dashboard.admin_master.admin_sourching.broadcast.dt_broadcast');
    }
    public function broadcast_store(Request $request)
    {


        $file           = $request->file('gambar_broadcast');
        //  dd($file);
        if (($file) == '') {
            $data = DB::table('broadcast')
                ->insert([
                    'broadcast_user_id'  => Auth()->user()->id,
                    'broadcast_kategory'  => 'PEMBERITAHUAN',
                    'broadcast_judul'  => $request->judul_broadcast,
                    'broadcast_date'  => $request->waktu_broadcast,
                    'broadcast_text'    => $request->isi_broadcast,
                    'broadcaster'    => 'PT.SURYA PANGAN SEMESTA',
                    'status_baca'    => '0',
                ]);
        } else {
            //  dd('sdsda');
            $imageName      = time() . '.' . $request->gambar_broadcast->extension();
            $file->move('public/img/broadcast/', $imageName);
            $data = DB::table('broadcast')
                ->insert([
                    'broadcast_user_id'  => Auth()->user()->id,
                    'broadcast_kategory'  => 'PEMBERITAHUAN',
                    'broadcast_judul'  => $request->judul_broadcast,
                    'broadcast_date'  => $request->waktu_broadcast,
                    'broadcast_text'    => $request->isi_broadcast,
                    'broadcaster'    => 'PT.SURYA PANGAN SEMESTA',
                    'broadcast_file' => $imageName,
                ]);
        }
        return redirect()->back();
    }
    public function broadcast_statusbaca(Request $request) {}
    public function broadcast_update(Request $request)
    {
        $image = $request->file('gambar_broadcast_update');
        // dd($image);
        if (($image) == '' && ($image) == null) {
            $news = DB::table('broadcast')->where('id_broadcast', $request->id_broadcast)
                ->update([
                    'broadcast_judul'  => $request->judul_broadcast_update,
                    'broadcast_date'  => $request->waktu_broadcast_update,
                    'broadcast_text'    => $request->isi_broadcast_update,
                ]);
        } else {
            $imageName      = time() . '.' . $request->gambar_broadcast_update->extension();

            if (!empty($image)) {
                $image->move('public/img/broadcast/', $imageName);
                $path = '/home/u1736638/public_html/ngawi.suryapangansemesta.store/public/img/broadcast/';

                $file_old = $path . $imageName;
                unlink($file_old);
            }

            $news = DB::table('broadcast')->where('id_broadcast', $request->id_broadcast)
                ->update([
                    'broadcast_judul'  => $request->judul_broadcast_update,
                    'broadcast_date'  => $request->waktu_broadcast_update,
                    'broadcast_text'    => $request->isi_broadcast_update,
                    'broadcast_file' => $imageName
                ]);
        }
        return redirect()->back();
    }

    public function broadcast_index()
    {
        return Datatables::of(Broadcast::query()->orderBy("id_broadcast", "desc"))
            ->addColumn('gambar_broadcast', function ($list) {
                $img = url('/public/img/broadcast/' . $list->broadcast_file);
                if (is_null($list->broadcast_file)) {
                    return ' - ';
                } else
                    return '
                <img src="' . $img . '" width="100px"/>
            ';
            })
            ->addColumn('ckelola', function ($buatmanage) {
                return '
            <a style="margin:2px;" name="' . $buatmanage->id_broadcast . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
            <i class="fa fa-pen-alt" style="color:#00c5dc;">Edit</i>
            </a>
            <a style="margin:2px;" href="' . route('master.broadcast_destroy', ['id' => $buatmanage->id_broadcast]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
            <i class="fa fa-trash">Delete</i>
            </a>
            ';
            })
            ->rawColumns(['gambar_broadcast', 'ckelola'])
            ->make(true);
    }

    public function broadcast_destroy($id)
    {
        $data = Broadcast::find($id);
        // dd($data);
        $data->delete();
        return redirect()->back();
    }

    public function broadcast_show($id)
    {
        $data = Broadcast::where('id_broadcast', $id)->first();
        return json_encode($data);
    }
    public function data_sourching_deal()
    {
        return view('dashboard.admin_master.admin_sourching.data_sourching.data_sourching_deal');
    }
    public function data_sourching_deal_gb_ciherang_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->where('bid.name_bid', '=', 'GABAH BASAH CIHERANG')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->orderBy('id_lab2_gb', 'DESC')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = $list->tonase_awal . '/Kg';
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = $list->tonase_akhir  . '/Kg';
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return $list->hasil_akhir_tonase;
                        }
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb) . '/Kg';
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                        }
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        if ($list->status_epicor == 1) {
                            return
                                '<div class="dropdown">
                    <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-exclamation"></i>' . $result . '
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button id="btn_nego_info_gb" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
                    </div>
                </div>';
                        } else {
                            return
                                '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-exclamation"></i>' . $result . '
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_nego_gb" data-id="' . $list->id_penerimaan_po . '" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
						</div>
					</div>';
                        }
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
                    ->rawColumns(['name_bid', 'reaksi_harga', 'nama_vendor', "date", 'date_bid', 'kode_po', 'harga_akhir', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->where('bid.name_bid', '=', 'GABAH BASAH CIHERANG')
                    // ->whereBetween('lab2_gb.created_at', array($request->from_date, $request->to_date))
                    ->orderBy('id_lab2_gb', 'DESC')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('plat_kendaraan', function ($list) {
                        $result = $list->plat_kendaraan;
                        return $result;
                    })
                    ->addColumn('tonase_awal', function ($list) {
                        $result = $list->tonase_awal . '/Kg';
                        return $result;
                    })
                    ->addColumn('tonase_akhir', function ($list) {
                        $result = $list->tonase_akhir  . '/Kg';
                        return $result;
                    })
                    ->addColumn('hasil_akhir_tonase', function ($list) {
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return $list->hasil_akhir_tonase;
                        }
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb) . '/Kg';
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                        }
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        if ($list->status_epicor == 1) {
                            return
                                '<div class="dropdown">
                    <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-exclamation"></i>' . $result . '
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button id="btn_nego_info_gb" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
                    </div>
                </div>';
                        } else {
                            return
                                '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-exclamation"></i>' . $result . '
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_nego_gb" data-id="' . $list->id_penerimaan_po . '" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
						</div>
					</div>';
                        }
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
                    ->rawColumns(['name_bid', 'reaksi_harga', 'nama_vendor', "date", 'date_bid', 'kode_po', 'harga_akhir', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_deal_gb_longgrain_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->orderBy('id_lab2_gb', 'DESC')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
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
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb) . '/Kg';
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                        }
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        if ($list->status_epicor == 1) {
                            return
                                '<div class="dropdown">
                    <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-exclamation"></i>' . $result . '
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button id="btn_nego_info_gb" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
                    </div>
                </div>';
                        } else {
                            return
                                '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-exclamation"></i>' . $result . '
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_nego_gb" data-id="' . $list->id_penerimaan_po . '" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
						</div>
					</div>';
                        }
                    })
                    ->addColumn('kirim_harga', function ($list) {
                        $str_hp = $list->nomer_hp;
                        $no_hp = preg_replace('/^0/', '62', $str_hp);
                        $nama = $list->name;
                        $nopol = $list->nopol;
                        $tonase = tonase($list->hasil_akhir_tonase);
                        $kode_po = $list->kode_po;
                        $harga = rupiah($list->harga_akhir_gb) . '/Kg';
                        return
                            // $no_hp;
                            '<a href="https://api.whatsapp.com/send?phone=' . $no_hp . '&text=Hallo!!%20Supplier%20:%20' . $nama . '.%20Ingin%20menyampaikan%20harga%20bongkaran%20gabah%20Nopol:%20' . $nopol . '%20Tonase:%20' . $tonase . '%20dengan%20PO:%20' . $kode_po . '%20Yaitu%20:%20*' . $harga . '*.%20Terimakasih." target="_blank" class="btn btn-block btn-success" id="btn_kirim_harga"><i class="fi fi-brands-whatsapp"></i>Kirim&nbsp;Harga&nbsp;Supplier</a>';
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
                    ->rawColumns(['name_bid', 'kirim_harga', 'reaksi_harga', 'nama_vendor', "date", 'date_bid', 'kode_po', 'harga_akhir', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
                    // ->whereBetween('lab2_gb.created_at', array($request->from_date, $request->to_date))
                    ->orderBy('id_lab2_gb', 'DESC')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
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
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb) . '/Kg';
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                        }
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        if ($list->status_epicor == 1) {
                            return
                                '<div class="dropdown">
                    <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-exclamation"></i>' . $result . '
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button id="btn_nego_info_gb" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
                    </div>
                </div>';
                        } else {
                            return
                                '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-exclamation"></i>' . $result . '
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_nego_gb" data-id="' . $list->id_penerimaan_po . '" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
						</div>
					</div>';
                        }
                    })
                    ->addColumn('kirim_harga', function ($list) {
                        $str_hp = $list->nomer_hp;
                        $no_hp = preg_replace('/^0/', '62', $str_hp);
                        $nama = $list->name;
                        $nopol = $list->nopol;
                        $tonase = tonase($list->hasil_akhir_tonase);
                        $kode_po = $list->kode_po;
                        $harga = rupiah($list->harga_akhir_gb) . '/Kg';
                        return
                            // $no_hp;
                            '<a href="https://api.whatsapp.com/send?phone=' . $no_hp . '&text=Hallo!!%20Supplier%20:%20' . $nama . '.%20Ingin%20menyampaikan%20harga%20bongkaran%20gabah%20Nopol:%20' . $nopol . '%20Tonase:%20' . $tonase . '%20dengan%20PO:%20' . $kode_po . '%20Yaitu%20:%20*' . $harga . '*.%20Terimakasih." target="_blank" class="btn btn-block btn-success" id="btn_kirim_harga"><i class="fi fi-brands-whatsapp"></i>Kirim&nbsp;Harga&nbsp;Supplier</a>';
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
                    ->rawColumns(['name_bid', 'kirim_harga', 'reaksi_harga', 'nama_vendor', "date", 'date_bid', 'kode_po', 'harga_akhir', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_deal_gb_pandan_wangi_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->orderBy('id_lab2_gb', 'DESC')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
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
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb) . '/Kg';
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                        }
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        if ($list->status_epicor == 1) {
                            return
                                '<div class="dropdown">
                    <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-exclamation"></i>' . $result . '
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button id="btn_nego_info_gb" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
                    </div>
                </div>';
                        } else {
                            return
                                '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-exclamation"></i>' . $result . '
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_nego_gb" data-id="' . $list->id_penerimaan_po . '" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
						</div>
					</div>';
                        }
                    })
                    ->addColumn('kirim_harga', function ($list) {
                        $str_hp = $list->nomer_hp;
                        $no_hp = preg_replace('/^0/', '62', $str_hp);
                        $nama = $list->name;
                        $nopol = $list->nopol;
                        $tonase = tonase($list->hasil_akhir_tonase);
                        $kode_po = $list->kode_po;
                        $harga = rupiah($list->harga_akhir_gb) . '/Kg';
                        return
                            // $no_hp;
                            '<a href="https://api.whatsapp.com/send?phone=' . $no_hp . '&text=Hallo!!%20Supplier%20:%20' . $nama . '.%20Ingin%20menyampaikan%20harga%20bongkaran%20gabah%20Nopol:%20' . $nopol . '%20Tonase:%20' . $tonase . '%20dengan%20PO:%20' . $kode_po . '%20Yaitu%20:%20*' . $harga . '*.%20Terimakasih." target="_blank" class="btn btn-block btn-success" id="btn_kirim_harga"><i class="fi fi-brands-whatsapp"></i>Kirim&nbsp;Harga&nbsp;Supplier</a>';
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
                    ->rawColumns(['name_bid', 'kirim_harga', 'reaksi_harga', 'nama_vendor', "date", 'date_bid', 'kode_po', 'harga_akhir', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->where('bid.name_bid', '=', 'GABAH BASAH PANDAN WANGI')
                    // ->whereBetween('lab2_gb.created_at', array($request->from_date, $request->to_date))
                    ->orderBy('id_lab2_gb', 'DESC')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
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
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb) . '/Kg';
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                        }
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        if ($list->status_epicor == 1) {
                            return
                                '<div class="dropdown">
                    <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-exclamation"></i>' . $result . '
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button id="btn_nego_info_gb" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
                    </div>
                </div>';
                        } else {
                            return
                                '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-exclamation"></i>' . $result . '
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_nego_gb" data-id="' . $list->id_penerimaan_po . '" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
						</div>
					</div>';
                        }
                    })
                    ->addColumn('kirim_harga', function ($list) {
                        $str_hp = $list->nomer_hp;
                        $no_hp = preg_replace('/^0/', '62', $str_hp);
                        $nama = $list->name;
                        $nopol = $list->nopol;
                        $tonase = tonase($list->hasil_akhir_tonase);
                        $kode_po = $list->kode_po;
                        $harga = rupiah($list->harga_akhir_gb) . '/Kg';
                        return
                            // $no_hp;
                            '<a href="https://api.whatsapp.com/send?phone=' . $no_hp . '&text=Hallo!!%20Supplier%20:%20' . $nama . '.%20Ingin%20menyampaikan%20harga%20bongkaran%20gabah%20Nopol:%20' . $nopol . '%20Tonase:%20' . $tonase . '%20dengan%20PO:%20' . $kode_po . '%20Yaitu%20:%20*' . $harga . '*.%20Terimakasih." target="_blank" class="btn btn-block btn-success" id="btn_kirim_harga"><i class="fi fi-brands-whatsapp"></i>Kirim&nbsp;Harga&nbsp;Supplier</a>';
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
                    ->rawColumns(['name_bid', 'kirim_harga', 'reaksi_harga', 'nama_vendor', "date", 'date_bid', 'kode_po', 'harga_akhir', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_deal_gb_ketan_putih_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->orderBy('id_lab2_gb', 'DESC')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
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
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb) . '/Kg';
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                        }
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        if ($list->status_epicor == 1) {
                            return
                                '<div class="dropdown">
                    <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-exclamation"></i>' . $result . '
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button id="btn_nego_info_gb" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
                    </div>
                </div>';
                        } else {
                            return
                                '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-exclamation"></i>' . $result . '
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_nego_gb" data-id="' . $list->id_penerimaan_po . '" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
						</div>
					</div>';
                        }
                    })
                    ->addColumn('kirim_harga', function ($list) {
                        $str_hp = $list->nomer_hp;
                        $no_hp = preg_replace('/^0/', '62', $str_hp);
                        $nama = $list->name;
                        $nopol = $list->nopol;
                        $tonase = tonase($list->hasil_akhir_tonase);
                        $kode_po = $list->kode_po;
                        $harga = rupiah($list->harga_akhir_gb) . '/Kg';
                        return
                            // $no_hp;
                            '<a href="https://api.whatsapp.com/send?phone=' . $no_hp . '&text=Hallo!!%20Supplier%20:%20' . $nama . '.%20Ingin%20menyampaikan%20harga%20bongkaran%20gabah%20Nopol:%20' . $nopol . '%20Tonase:%20' . $tonase . '%20dengan%20PO:%20' . $kode_po . '%20Yaitu%20:%20*' . $harga . '*.%20Terimakasih." target="_blank" class="btn btn-block btn-success" id="btn_kirim_harga"><i class="fi fi-brands-whatsapp"></i>Kirim&nbsp;Harga&nbsp;Supplier</a>';
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
                    ->rawColumns(['name_bid', 'kirim_harga', 'reaksi_harga', 'nama_vendor', "date", 'date_bid', 'kode_po', 'harga_akhir', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                    ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                    ->where('bid.name_bid', '=', 'GABAH BASAH KETAN PUTIH')
                    // ->whereBetween('lab2_gb.created_at', array($request->from_date, $request->to_date))
                    ->orderBy('id_lab2_gb', 'DESC')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
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
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
                    })
                    ->addColumn('plan_harga_beli_gabah', function ($list) {
                        $result = $list->plan_harga_beli_gabah_gb . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_tempat', function ($list) {
                        $result = $list->harga_berdasarkan_tempat_gb . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_berdasarkan_harga_atas', function ($list) {
                        $result = rupiah($list->harga_berdasarkan_harga_atas_gb) . ' /Kg';
                        return $result;
                    })
                    ->addColumn('harga_awal', function ($list) {
                        $result = rupiah($list->harga_awal_gb) . '/Kg';
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('harga_akhir', function ($list) {
                        $result = $list->harga_akhir_permintaan_gb;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_gb) . '/Kg';
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_gb) . '/Kg';
                        }
                        return $result;
                    })
                    ->addColumn('reaksi_harga', function ($list) {
                        $result = rupiah($list->reaksi_harga_gb);
                        return $result;
                    })
                    ->addColumn('aksi_harga', function ($list) {
                        $result = $list->aksi_harga_gb;
                        if ($list->status_epicor == 1) {
                            return
                                '<div class="dropdown">
                    <button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-exclamation"></i>' . $result . '
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        <button id="btn_nego_info_gb" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
                    </div>
                </div>';
                        } else {
                            return
                                '<div class="dropdown">
    					<button class="btn btn-brand dropdown-toggle" style="background-color:white; color:#9f187c" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-exclamation"></i>' . $result . '
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
							<button id="btn_nego_gb" data-id="' . $list->id_penerimaan_po . '" class="dropdown-item"  title="Information"><i class="fas fa-edit"></i>&nbsp;Nego</button>
						</div>
					</div>';
                        }
                    })
                    ->addColumn('kirim_harga', function ($list) {
                        $str_hp = $list->nomer_hp;
                        $no_hp = preg_replace('/^0/', '62', $str_hp);
                        $nama = $list->name;
                        $nopol = $list->nopol;
                        $tonase = tonase($list->hasil_akhir_tonase);
                        $kode_po = $list->kode_po;
                        $harga = rupiah($list->harga_akhir_gb) . '/Kg';
                        return
                            // $no_hp;
                            '<a href="https://api.whatsapp.com/send?phone=' . $no_hp . '&text=Hallo!!%20Supplier%20:%20' . $nama . '.%20Ingin%20menyampaikan%20harga%20bongkaran%20gabah%20Nopol:%20' . $nopol . '%20Tonase:%20' . $tonase . '%20dengan%20PO:%20' . $kode_po . '%20Yaitu%20:%20*' . $harga . '*.%20Terimakasih." target="_blank" class="btn btn-block btn-success" id="btn_kirim_harga"><i class="fi fi-brands-whatsapp"></i>Kirim&nbsp;Harga&nbsp;Supplier</a>';
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
                    ->rawColumns(['name_bid', 'kirim_harga', 'reaksi_harga', 'nama_vendor', "date", 'date_bid', 'kode_po', 'harga_akhir', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_deal_pk_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab1_pk', 'lab1_pk.lab1_kode_po_pk', '=', 'data_po.kode_po')
                    ->where('lab1_pk.aksi_harga_pk', 'DEAL')
                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    ->whereBetween('data_po.tanggal_po', array($request->from_date, $request->to_date))
                    ->orderBy('lab1_pk.id_lab1_pk', 'DESC')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
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
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
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
                        $result = rupiah($list->harga_awal_pk) . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_akhir_pk', function ($list) {
                        $result = $list->harga_akhir_permintaan_pk;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_pk);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_pk);
                        }
                        return $result;
                    })
                    ->addColumn('harga_bongkaran_pk', function ($list) {
                        $result = rupiah($list->harga_bongkaran_pk);
                        return $result;
                    })
                    ->addColumn('reaksi_harga_pk', function ($list) {
                        $result = $list->reaksi_harga_pk;
                        if ($result == '' | $result == null) {
                            $result = 'Rp. -';
                            return $result;
                        } else {
                            $result = rupiah($list->reaksi_harga_pk);
                        }
                    })
                    ->addColumn('aksi_harga_pk', function ($list) {
                        $result = $list->aksi_harga_pk;
                        return '
                <a style="margin:2px;" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
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
                    ->rawColumns(['name_bid', 'harga_bongkaran_pk', 'nama_vendor', "date", 'date_bid', 'aksi_harga_pk', 'kode_po', 'harga_akhir', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {

                return Datatables::of(DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('lab1_pk', 'lab1_pk.lab1_kode_po_pk', '=', 'data_po.kode_po')
                    ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'data_po.kode_po')
                    ->where('lab1_pk.aksi_harga_pk', 'DEAL')
                    ->where('bid.name_bid', 'LIKE', '%BERAS PECAH KULIT%')
                    // ->whereBetween('lab2_pk.created_at', array($request->from_date, $request->to_date))
                    ->orderBy('id_lab2_pk', 'DESC')
                    ->get())
                    ->addColumn('name_bid', function ($list) {
                        $result = $list->name_bid;
                        return $result;
                    })
                    ->addColumn('nama_vendor', function ($list) {
                        $result = $list->nama_vendor;
                        return $result;
                    })
                    ->addColumn('date_bid', function ($list) {
                        $result = $list->date_bid;
                        return '<span style="margin:2px;" class="m-badge m-badge--danger m-badge--wide">' . $result . '</span>';
                    })
                    ->addColumn('kode_po', function ($list) {
                        $result = $list->kode_po;
                        return $result;
                    })
                    ->addColumn('date', function ($list) {
                        $result = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y ');
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
                        $result = $list->hasil_akhir_tonase;
                        if ($result == '' && $result == null) {
                            return '<span class="badge badge-pill badge-info">Proses Final Tonase</span>';
                        } else {
                            return tonase($list->hasil_akhir_tonase);
                        }
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
                        $result = rupiah($list->harga_awal_pk) . '/Kg';
                        return $result;
                    })
                    ->addColumn('harga_akhir_pk', function ($list) {
                        $result = $list->harga_akhir_permintaan_pk;
                        if ($result == '' && $result == null) {
                            $result = rupiah($list->harga_akhir_pk);
                        } else {
                            $result = rupiah($list->harga_akhir_permintaan_pk);
                        }
                        return $result;
                    })
                    ->addColumn('harga_bongkaran_pk', function ($list) {
                        $result = rupiah($list->harga_bongkaran_pk);
                        return $result;
                    })
                    ->addColumn('reaksi_harga_pk', function ($list) {
                        $result = $list->reaksi_harga_pk;
                        if ($result == '' | $result == null) {
                            $result = 'Rp. -';
                            return $result;
                        } else {
                            $result = rupiah($list->reaksi_harga_pk);
                        }
                    })
                    ->addColumn('aksi_harga_pk', function ($list) {
                        $result = $list->aksi_harga_pk;
                        return '
                <a style="margin:2px;" title="Information" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                ' . $result . '
                </a>';
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
                    ->rawColumns(['name_bid', 'harga_bongkaran_pk', 'nama_vendor', "date", 'date_bid', 'aksi_harga_pk', 'kode_po', 'harga_akhir', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function vendor_export_excel()
    {
        return Excel::download(new UsersExport(), 'DATA VENDOR.xlsx');
    }
    public function download_data_pesanan_pemebelian_aol(Request $request)
    {
        // $from_date  = $request->from_date;
        // $to_date  = $request->to_date;
        $id_bid  = $request->id_bid;
        // dd($id_bid);
        return Excel::download(new DataPesananPembelianAOL($id_bid), 'DATA PESANAN PEMBELIAN AOL NGAWI.xlsx');
    }
}
