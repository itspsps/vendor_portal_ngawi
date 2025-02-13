<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Bid;
use App\Models\Superadmin;
use Illuminate\Support\Facades\Auth;
use App\Models\BidUser;
use App\Models\ApproveBid;
use App\Models\Transaksi;
use App\Models\DataPO;
use App\Models\HargaAtas;
use App\Models\HargaBawah;
use App\Models\Item;
use App\Models\Lab1GabahBasah;
use App\Models\LogAktivitySourching;
use App\Models\Notif;
use App\Models\NotifSecurity;
use App\Models\PenerimaanPO;
use App\Models\PotonganBongkarGt04;
use App\Models\trackerPO;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use DataTables;
use GuzzleHttp\Promise\Promise;
use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use RealRashid\SweetAlert\Facades\Alert;

class BidController extends Controller
{
    public function bid_gb_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(Bid::query()

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
                                if ($list->bid_status == 1) {
                                    return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                        </button>';
                                } else {
                                    return '<button id="btn_addkuota2" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                        </button>';
                                }
                            } else {
                                return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-pen-alt"></i>' . tonase($result) . '<br>(' . $jumlahtruk . '&nbsp;Truk)
                                    </button><a href="javascript:void(0)" data-id="' . $list->id_bid . '" id="btn_delete_kuota" title="Hapus Kuota"><i class="fa fa-times text-danger"></i></a>';
                            }
                        } else if ($date <= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                            if ($result == '' || $result == null) {
                                return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                </button>';
                            } else {
                                return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-pen-alt"></i>' . tonase($result) . '&nbsp;Kg<br>(' . $jumlahtruk . '&nbsp;Truk)
                                    </button>';
                            }
                        }
                    })
                    ->addColumn('list_po', function ($list) {
                        $data_count = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                            ->join('users', 'users.id', '=', 'data_po.user_idbid')
                            ->where('data_po.bid_id', $list->id_bid)
                            ->count();
                        return '
                        <div style="position:relative;">
                        <a style="margin:2px;" href="' . route('sourching.list_approve_po', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" style="position: relative;" class="toyakin btn btn-outline-dark m-btn m-btn--icon btn-sm m-btn--icon-only">
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
                        $img = url('public/img/bid/pp_bid.jpg');
                        if (is_null($list->image_bid)) {
                            return '
                            <img src="' . $img . '" width="100px"/>
                        ';
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
                        $data_count = BidUser::join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
                            ->join('users', 'id', '=', 'bid_user.user_id')
                            ->where('id_bid', $list->id_bid)
                            ->where('status_biduser', 0)
                            ->count();
                        return '
                        <div style="position:relative;">
                        <a style="margin:2px;" href="' . route('sourching.bid_response', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
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
                            <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->open_po)->format('d-m-Y') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('d-m-Y') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                            </a>
                            <a style="margin:2px;" id="btn_information"  title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times" style="color:#DC143C;"></i>
                            </a>
                            ';
                        } else {
                            return '
                            <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->open_po)->format('d-m-Y') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
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
                                if ($list->bid_status == 1) {
                                    return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                        </button>';
                                } else {
                                    return '<button id="btn_addkuota2" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                        <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                        </button>';
                                }
                            } else {
                                return '<button id="btn_addkuota" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-pen-alt"></i>' . tonase($result) . '<br>(' . $jumlahtruk . '&nbsp;Truk)
                                    </button><a href="javascript:void(0)" data-id="' . $list->id_bid . '" id="btn_delete_kuota" title="Hapus Kuota"><i class="fa fa-times text-danger"></i></a>';
                            }
                        } else if ($date <= Carbon::now()->isoFormat('Y-MM-DD HH:m:s')) {
                            if ($result == '' || $result == null) {
                                return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                <i class="fa fa-plus">&nbsp;Add&nbsp;Kuota</i>
                                </button>';
                            } else {
                                return '<button id="btn_addkuota1" style="margin:2px;" data-id="' . $list->id_bid . '" data-add_kuota="' . $list->add_kuota . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Add Kuota" onclick="return true" class=" btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                    <i class="fa fa-pen-alt"></i>' . tonase($result) . '&nbsp;Kg<br>(' . $jumlahtruk . '&nbsp;Truk)
                                    </button>';
                            }
                        }
                    })
                    ->addColumn('list_po', function ($list) {
                        $data_count = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                            ->join('users', 'users.id', '=', 'data_po.user_idbid')
                            ->where('data_po.bid_id', $list->id_bid)
                            ->count();
                        return '
                        <div style="position:relative;">
                        <a style="margin:2px;" href="' . route('sourching.list_approve_po', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" style="position: relative;" class="toyakin btn btn-outline-dark m-btn m-btn--icon btn-sm m-btn--icon-only">
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
                        $img = url('public/img/bid/pp_bid.jpg');
                        if (is_null($list->image_bid)) {
                            return '
                                <img src="' . $img . '" width="100px"/>
                            ';
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
                        $data_count = BidUser::join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
                            ->join('users', 'id', '=', 'bid_user.user_id')
                            ->where('id_bid', $list->id_bid)
                            ->where('status_biduser', 0)
                            ->count();
                        return '
                        <div style="position:relative;">
                        <a style="margin:2px;" href="' . route('sourching.bid_response', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
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
                            <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->open_po)->format('d-m-Y') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                            </a>
                            <a style="margin:2px;" id="btn_information"  title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times" style="color:#DC143C;"></i>
                            </a>
                            ';
                        } else {
                            return '
                            <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->open_po)->format('d-m-Y') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
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
                        $data_count = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                            ->join('users', 'users.id', '=', 'data_po.user_idbid')
                            ->where('data_po.bid_id', $list->id_bid)
                            ->count();
                        return '
                        <div style="position:relative;">
                        <a style="margin:2px;" href="' . route('sourching.list_approve_po', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" style="position: relative;" class="toyakin btn btn-outline-dark m-btn m-btn--icon btn-sm m-btn--icon-only">
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
                        $img = url('public/img/bid/pp_bid.jpg');
                        if (is_null($list->image_bid)) {
                            return '
                                <img src="' . $img . '" width="100px"/>
                            ';
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
                        $data_count = BidUser::join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
                            ->join('users', 'id', '=', 'bid_user.user_id')
                            ->where('id_bid', $list->id_bid)
                            ->where('status_biduser', 0)
                            ->count();
                        return '
                        <div style="position:relative;">
                        <a style="margin:2px;" href="' . route('sourching.bid_response', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
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
                            <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->open_po)->format('d-m-Y') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                            </a>
                            <a style="margin:2px;" id="btn_information"  title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times" style="color:#DC143C;"></i>
                            </a>
                            ';
                        } else {
                            return '
                            <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->open_po)->format('d-m-Y') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
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
                        $data_count = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                            ->join('users', 'users.id', '=', 'data_po.user_idbid')
                            ->where('data_po.bid_id', $list->id_bid)
                            ->count();
                        return '
                        <div style="position:relative;">
                        <a style="margin:2px;" href="' . route('sourching.list_approve_po', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" style="position: relative;" class="toyakin btn btn-outline-dark m-btn m-btn--icon btn-sm m-btn--icon-only">
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
                        $img = url('public/img/bid/pp_bid.jpg');
                        if (is_null($list->image_bid)) {
                            return '
                                <img src="' . $img . '" width="100px"/>
                            ';
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
                        $data_count = BidUser::join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
                            ->join('users', 'id', '=', 'bid_user.user_id')
                            ->where('id_bid', $list->id_bid)
                            ->where('status_biduser', 0)
                            ->count();
                        return '
                        <div style="position:relative;">
                        <a style="margin:2px;" href="' . route('sourching.bid_response', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
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
                            <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->open_po)->format('d-m-Y') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                            </a>
                            <a style="margin:2px;" id="btn_information"  title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times" style="color:#DC143C;"></i>
                            </a>
                            ';
                        } else {
                            return '
                            <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->open_po)->format('d-m-Y') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
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
                        $data_count = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                            ->join('users', 'users.id', '=', 'data_po.user_idbid')
                            ->where('data_po.bid_id', $list->id_bid)
                            ->count();
                        return '
                        <div style="position:relative;">
                        <a style="margin:2px;" href="' . route('sourching.list_approve_po', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" style="position: relative;" class="toyakin btn btn-outline-dark m-btn m-btn--icon btn-sm m-btn--icon-only">
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
                        $img = url('public/img/bid/pp_bid.jpg');
                        if (is_null($list->image_bid)) {
                            return '
                                <img src="' . $img . '" width="100px"/>
                            ';
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
                        $data_count = BidUser::join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
                            ->join('users', 'id', '=', 'bid_user.user_id')
                            ->where('id_bid', $list->id_bid)
                            ->where('status_biduser', 0)
                            ->count();
                        return '
                        <div style="position:relative;">
                        <a style="margin:2px;" href="' . route('sourching.bid_response', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
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
                            <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->open_po)->format('d-m-Y') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                            </a>
                            <a style="margin:2px;" id="btn_information"  title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times" style="color:#DC143C;"></i>
                            </a>
                            ';
                        } else {
                            return '
                            <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->open_po)->format('d-m-Y') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
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
                        $data_count = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                            ->join('users', 'users.id', '=', 'data_po.user_idbid')
                            ->where('data_po.bid_id', $list->id_bid)
                            ->count();
                        return '
                        <div style="position:relative;">
                        <a style="margin:2px;" href="' . route('sourching.list_approve_po', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" style="position: relative;" class="toyakin btn btn-outline-dark m-btn m-btn--icon btn-sm m-btn--icon-only">
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
                        $img = url('public/img/bid/pp_bid.jpg');
                        if (is_null($list->image_bid)) {
                            return '
                                <img src="' . $img . '" width="100px"/>
                            ';
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
                        $data_count = BidUser::join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
                            ->join('users', 'id', '=', 'bid_user.user_id')
                            ->where('id_bid', $list->id_bid)
                            ->where('status_biduser', 0)
                            ->count();
                        return '
                        <div style="position:relative;">
                        <a style="margin:2px;" href="' . route('sourching.bid_response', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
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
                            <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->open_po)->format('d-m-Y') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                            </a>
                            <a style="margin:2px;" id="btn_information"  title="Information" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            <i class="fa fa-times" style="color:#DC143C;"></i>
                            </a>
                            ';
                        } else {
                            return '
                            <a style="margin:2px;" name="toedit" id="toedit" data-bidid="' . $list->id_bid . '" data-image="' . $list->image_bid . '" data-jumlah="' . $list->jumlah . '" data-nama="' . $list->name_bid . '" data-description="' . $list->description_bid . '" data-harga="' . $list->harga . '" data-lokasi="' . $list->lokasi . '" data-datebid="' . \Carbon\Carbon::parse($list->open_po)->format('d-m-Y') . '" data-lastbid="' . \Carbon\Carbon::parse($list->batas_bid)->format('Y-m-d') . '"  data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
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

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
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
            ->addColumn('tanggal_bongkar', function ($list) {
                $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y');
                return $result;
            })
            ->addColumn('nopol', function ($list) {
                if ($list->nopol == '') {
                    if ($list->status_bid == 5) {
                        return '<span style="margin:2px;" class="btn btn-label-danger btn-sm">PO CLOSE</span>';
                    } else {
                        return '
                        <span class="btn btn-label-warning btn-sm"><i class="flaticon2-information"></i> Belum Diinput Security</span>';
                    }
                } else {
                    $result = $list->nopol;
                    return $result;
                }
            })
            ->addColumn('status', function ($list) {
                if ($list->status_bid == 5) {
                    if ($list->nopol == '') {
                        return '<span style="margin:2px;" class="btn btn-label-danger btn-sm">PO CLOSE</span>';
                    } else {
                        return '<span style="margin:2px;" class="btn btn-label-danger btn-sm">TOLAK</span>';
                    }
                    // <span class="btn btn-label-info btn-sm "><i class="flaticon2-information"></i> Pastikan Nopol Terisi Dengan Benar</span>
                } else if ($list->status_bid == 16) {
                    return '<button type="button" id="btn_lihat_harga" data-id="' . $list->id_data_po . '" data-hp="' . $list->nomer_hp  . '" data-nopol="' . $list->nopol  . '" data-supplier="' . $list->nama_vendor  . '" data-ponum="' . $list->PONum . '"  class="btn btn-light"><span style="margin:2px;" title="Lihat Harga" class="badge badge-warning">Pending Harga</span></button>';
                } else if ($list->status_bid == 1) {
                    return  '<span style="margin:2px;" class="btn btn-label-primary btn-sm">Proses&nbsp;Pengiriman</span>';
                } else if ($list->status_bid == 3) {
                    return  '<span style="margin:2px;" class="btn btn-label-primary btn-sm">Proses&nbsp;Lab&nbsp;1</span>';
                } else if ($list->status_bid == 6) {
                    return  '<span style="margin:2px;" class="btn btn-label-primary btn-sm">Selesai&nbsp;Lab1</span>';
                } else if ($list->status_bid == 7) {
                    return  '<span style="margin:2px;" class="btn btn-label-primary btn-sm">Truk&nbsp;Parkir</span>';
                } else if ($list->status_bid == 8) {
                    return  '<span style="margin:2px;" class="btn btn-label-primary btn-sm">Timbangan&nbsp;Masuk</span>';
                } else if ($list->status_bid == 9) {
                    return  '<span style="margin:2px;" class="btn btn-label-primary btn-sm">Proses&nbsp;Bongkar</span>';
                } else if ($list->status_bid == 10) {
                    return  '<span style="margin:2px;" class="btn btn-label-primary btn-sm">Timbangan&nbsp;Keluar/Lab&nbsp;2</span>';
                } else if ($list->status_bid == 11) {
                    return  '<span style="margin:2px;" class="btn btn-label-primary btn-sm">Selesai Lab2 /Timbangan</span>';
                } else if ($list->status_bid == 12) {
                    return  '<span style="margin:2px;" class="btn btn-label-primary btn-sm">Pengajuan Approve SPV QC</span>';
                } else if ($list->status_bid == 13) {
                    return  '<span style="margin:2px;" class="btn btn-label-primary btn-sm">Pembayaran</span>';
                } else {
                    return  '<span style="margin:2px;" class="btn btn-label-success btn-sm">Bongkar</span>';
                }
            })
            ->addColumn('cetak', function ($list) {
                if ($list->status_bid == 5) {
                    return '<a href="cetak_po/' . $list->id_data_po . '" onclick="return false;" target="_blank" style="margin:2px;background-color:#9c0911" name="" title="Cetak PO" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-print" style="color:white;">&nbsp;Cetak&nbsp;PO</i>
                </a>';
                } else {
                    return '<a href="cetak_po/' . $list->id_data_po . '" target="_blank" style="margin:2px;background-color:#9c0911" name="" title="Cetak PO" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-print" style="color:white;">&nbsp;Cetak&nbsp;PO</i>
                </a>';
                }
            })

            ->rawColumns(['name_bid', 'nopol', 'tanggal_po', 'tanggal_bongkar', 'cetak', 'status'])
            ->make(true);
    }
    public function data_list_pk_index($id_bid)
    {
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                    return '<a href="cetak_po/' . $list->id_data_po . '" onclick="return false;" target="_blank" style="margin:2px;background-color:#9c0911" name="" title="Cetak PO" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-print" style="color:white;">&nbsp;Cetak&nbsp;PO</i>
                </a>';
                } else {
                    return '<a href="cetak_po/' . $list->id_data_po . '" target="_blank" style="margin:2px;background-color:#9c0911" name="" title="Cetak PO" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-print" style="color:white;">&nbsp;Cetak&nbsp;PO</i>
                </a>';
                }
            })

            ->rawColumns(['name_bid', 'tanggal_po', 'cetak', 'status'])
            ->make(true);
    }
    public function data_list_ds_index($id_bid)
    {
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                    return '<a href="cetak_po/' . $list->id_data_po . '" onclick="return false;" target="_blank" style="margin:2px;background-color:#9c0911" name="" title="Cetak PO" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="fa fa-print" style="color:white;">&nbsp;Cetak&nbsp;PO</i>
                </a>';
                } else {
                    return '<a href="cetak_po/' . $list->id_data_po . '" target="_blank" style="margin:2px;background-color:#9c0911" name="" title="Cetak PO" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
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
        return view('dashboard.superadmin.bid.dt_approve_po', compact('id_bid'));
    }

    public function status_pending($id)
    {
        $data = Lab1GabahBasah::where('lab1_id_data_po_gb', $id)->first();
        // dd($data);
        return json_encode($data);
    }
    public function bid_status($id_bid)
    {
        $get = Bid::where('id_bid', $id_bid)->first();
        // dd($data->name_bid);
        if ($get->bid_status == 1) {
            // insert Log Aktivity
            $data = new LogAktivitySourching();
            $data->name_user    = Auth::guard('sourching')->user()->name;
            $data->id_objek_aktivitas_sourching  = $get->id_bid;
            $data->aktivitas_sourching  = 'Non Aktifkan Lelang ' . $get->name_bid . ' PO ' . $get->open_po;
            $data->keterangan_aktivitas              = 'Selesai';
            $data->created_at           = date('Y-m-d H:i:s');
            $data->save();
            $data1 = Bid::where('id_bid', $id_bid)->update(['bid_status' => 0]);
            // return redirect()->back();
        } else {
            // insert Log Aktivity
            $data = new LogAktivitySourching();
            $data->name_user    = Auth::guard('sourching')->user()->name;
            $data->id_objek_aktivitas_sourching  = $get->id_bid;
            $data->aktivitas_sourching  = 'Mengaktifkan Lelang ' . $get->name_bid . ' PO ' . $get->open_po;
            $data->keterangan_aktivitas              = 'Selesai';
            $data->created_at           = date('Y-m-d H:i:s');
            $data->save();
            $data2 = Bid::where('id_bid', $id_bid)->update(['bid_status' => 1]);
            // return redirect()->back();
        }
    }

    public function add_kuota(Request $request)
    {
        $data = Bid::where('id_bid', $request->id)->first();
        $query = Bid::where('id_bid', $request->id)->update(['add_kuota' => $request->add_kuota]);
        // insert Log Aktivity
        $data = new LogAktivitySourching();
        $data->name_user    = Auth::guard('sourching')->user()->name;
        $data->id_objek_aktivitas_sourching  = $data->id_bid;
        $data->aktivitas_sourching  = 'Menambahkan Kuota Lelang ' . $data->name_bid . ' PO ' . $data->open_po . ' Kuota: ' . tonase($request->add_kuota);
        $data->keterangan_aktivitas   = 'Selesai';
        $data->created_at           = date('Y-m-d H:i:s');
        $data->save();
        return redirect()->back();
    }
    public function delete_add_kuota($id)
    {
        $data = Bid::where('id_bid', $id)->first();
        $query = Bid::where('id_bid', $id)->update(['add_kuota' => NULL]);
        // insert Log Aktivity
        $data = new LogAktivitySourching();
        $data->name_user    = Auth::guard('sourching')->user()->name;
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
            // $image          = $request->file('image_bid');
            $open_po        = date('Y-m-d', strtotime('+1 days'));
            $mulai_bid      = date('Y-m-d H:i:s', strtotime('+1 days'));

            // $file           = $request->file('image_bid');
            // $imageName      = time() . '.' . $request->image_bid->extension();
            // $save           = $file->move('public/img/bid/', $imageName);
            $jml_kuota = ($request->jumlah * 8000);

            $bid                            = new Bid();
            $bid->name_bid                  = $request->name_bid;
            $bid->harga                     = $request->harga;
            $bid->jumlah                    = $jml_kuota;
            $bid->lokasi                    = $request->lokasi;
            $bid->open_po                   = $request->open_po;
            $bid->unload_date               = $request->tgl_bongkaran;
            $bid->mulai_bid                 = \Carbon\Carbon::parse($request->date_bid)->isoFormat('Y-MM-DD 08:00:00');
            $bid->date_bid                  = \Carbon\Carbon::parse($request->date_bid)->isoFormat('Y-MM-DD hh:mm:ss');
            $bid->batas_bid                 = \Carbon\Carbon::parse($request->batas_bid)->isoFormat('Y-MM-DD 12:00:00');
            $bid->description_bid           = $request->description_bid;
            $bid->image_bid                 = null;
            $bid->kode_bid                  = $random_kode;
            $bid->bid_status                = '1';
            $bid->save();

            // insert Log Aktivity
            $data = new LogAktivitySourching();
            $data->name_user    = Auth::guard('sourching')->user()->name;
            $data->id_objek_aktivitas_sourching  = $bid->id_bid;
            $data->aktivitas_sourching  = 'Insert Lelang ' . $request->name_bid . '. Tanggal PO : ' . $request->date_bid;
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
            // $image          = $request->file('image_bid');
            $open_po        = date('Y-m-d 12:00:00');
            $mulai_bid      = date('Y-m-d H:i:s');

            // $file           = $request->file('image_bid');
            // $imageName      = time() . '.' . $request->image_bid->extension();
            // $save           = $file->move('public/img/bid/', $imageName);
            $jml_kuota = ($request->jumlah * 8000);
            $bid                            = new Bid();
            $bid->name_bid                  = $request->name_bid;
            $bid->harga                     = $request->harga;
            $bid->jumlah                    = $jml_kuota;
            $bid->lokasi                    = $request->lokasi;
            $bid->open_po                   = $open_po;
            $bid->unload_date               = $request->tgl_bongkaran;
            $bid->date_bid                  = $date_bid;
            $bid->mulai_bid                 = $mulai_bid;
            $bid->batas_bid                 = $batas_bid;
            $bid->description_bid           = $request->description_bid;
            $bid->image_bid                 = null;
            $bid->kode_bid                  = $random_kode;
            $bid->bid_status                = '1';
            $bid->save();

            // insert Log Aktivity
            $data = new LogAktivitySourching();
            $data->name_user    = Auth::guard('sourching')->user()->name;
            $data->id_objek_aktivitas_sourching  = $bid->id_bid;
            $data->aktivitas_sourching  = 'Insert Lelang ' . $request->name_bid . '. Tanggal PO : ' . $request->date_bid;
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
            // $image          = $request->file('image_bid');
            $open_po        = date('Y-m-d', strtotime('+1 days'));
            $mulai_bid      = date('Y-m-d H:i:s', strtotime('+1 days'));

            // $file           = $request->file('image_bid');
            // $imageName      = time() . '.' . $request->image_bid->extension();
            // $save           = $file->move('public/img/bid/', $imageName);
            $jml_kuota = ($request->jumlah * 8000);

            $bid                            = new Bid();
            $bid->name_bid                  = $request->name_bid;
            $bid->harga                     = $request->harga;
            $bid->jumlah                    = $jml_kuota;
            $bid->lokasi                    = $request->lokasi;
            $bid->open_po                   = $request->open_po;
            $bid->unload_date               = $request->tgl_bongkaran;
            $bid->mulai_bid                 = \Carbon\Carbon::parse($request->date_bid)->isoFormat('Y-MM-DD 08:00:00');
            $bid->date_bid                  = \Carbon\Carbon::parse($request->date_bid)->isoFormat('Y-MM-DD hh:mm:ss');
            $bid->batas_bid                 = \Carbon\Carbon::parse($request->batas_bid)->isoFormat('Y-MM-DD 12:00:00');
            $bid->description_bid           = $request->description_bid;
            $bid->image_bid                 = null;
            $bid->kode_bid                  = $random_kode;
            $bid->bid_status                = '1';
            $bid->save();

            // insert Log Aktivity
            $data = new LogAktivitySourching();
            $data->name_user    = Auth::guard('sourching')->user()->name;
            $data->id_objek_aktivitas_sourching  = $bid->id_bid;
            $data->aktivitas_sourching  = 'Insert Lelang ' . $request->name_bid . '. Tanggal PO : ' . $request->date_bid;
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
                // $image          = $request->file('image_bid');
                $open_po        = date('Y-m-d', strtotime('+1 days'));
                $mulai_bid      = date('Y-m-d H:i:s', strtotime('+1 days'));

                // $file           = $request->file('image_bid');
                // $imageName      = time() . '.' . $request->image_bid->extension();
                // $save           = $file->move('public/img/bid/', $imageName);

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
                $bid->image_bid                 = null;
                $bid->kode_bid                  = $random_kode;
                $bid->bid_status                = '1';
                $bid->status_ds                 = $request->pilihan;
                $bid->save();

                // insert Log Aktivity
                $data = new LogAktivitySourching();
                $data->name_user    = Auth::guard('sourching')->user()->name;
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
                // $image          = $request->file('image_bid');
                $open_po        = date('Y-m-d', strtotime('+7 days'));
                $mulai_bid      = date('Y-m-d H:i:s', strtotime('+1 days'));

                // $file           = $request->file('image_bid');
                // $imageName      = time() . '.' . $request->image_bid->extension();
                // $save           = $file->move('public/img/bid/', $imageName);

                $bid                            = new Bid();
                $bid->name_bid                  = $request->name_bid;
                $bid->harga                     = $request->harga;
                $bid->jumlah                    = $request->jumlah;
                $bid->lokasi                    = $request->lokasi;
                $bid->open_po                   = $open_po;
                $bid->unload_date               = $request->tgl_bongkaran;
                $bid->date_bid                  = $date_bid;
                $bid->mulai_bid                 = $mulai_bid;
                $bid->batas_bid                 = $batas_bid;
                $bid->description_bid           = $request->description_bid;
                $bid->image_bid                 = null;
                $bid->kode_bid                  = $random_kode;
                $bid->bid_status                = '1';
                $bid->status_ds                 = $request->pilihan;
                $bid->save();

                // insert Log Aktivity
                $data = new LogAktivitySourching();
                $data->name_user    = Auth::guard('sourching')->user()->name;
                $data->aktivitas_sourching  =  'Insert Lelang ' . $request->name_bid . '. Tanggal PO : ' . $request->date_bid;
                $data->id_objek_aktivitas_sourching  = $bid->id_bid;
                $data->keterangan_aktivitas   = 'Selesai';
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
        $jml_kuota = ($request->jumlah * 8000);
        $bid = Bid::where('id_bid', $request->id_bid)->first();
        $bid->name_bid  = $request->name_bid;
        $bid->jumlah    = $jml_kuota;
        $bid->description_bid = $request->description_bid;
        $bid->update();
        // insert Log Aktivity
        $data = new LogAktivitySourching();
        $data->name_user    = Auth::guard('sourching')->user()->name;
        $data->id_objek_aktivitas_sourching  = $request->id_bid;
        $data->aktivitas_sourching  =  'Update Lelang ' . $request->name_bid . ' Kuota Lelang ' . $jml_kuota;
        $data->keterangan_aktivitas   = 'Selesai';
        $data->created_at           = date('Y-m-d H:i:s');
        $data->save();


        return redirect()->back()->with('message', ['alert' => 'success', 'title' => 'Data Berhasil Diupdate']);
    }

    public function destroy($id_product)
    {
        $get_lelang = Bid::where('id_bid', $id_product)->first();
        // insert Log Aktivity
        // dd($get_lelang->name_bid);
        $data = new LogAktivitySourching();
        $data->name_user                        = Auth::guard('sourching')->user()->id;
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
        $cek_jumlahpengajuan = ApproveBid::join('bid_user', 'bid_user.id_biduser', '=', 'approve_bid.bid_user_id')
            ->join('bid', 'bid.id_bid', '=', 'approve_bid.bid_id')
            ->where('approve_bid.bid_id', $id)
            ->where('bid_user.status_biduser', 1)
            ->sum('approve_bid.permintaan_kirim');
        $cek_jumlahkebutuhan = Bid::where('id_bid', $id)->first();
        $kuota_sisa = ($cek_jumlahkebutuhan->jumlah + $cek_jumlahkebutuhan->add_kuota) - $cek_jumlahpengajuan * 8000;
        $data_approve = ApproveBid::where('bid_id', $id)->sum('permintaan_kirim');
        $bid = Bid::where('id_bid', $id)->first();
        $data_response =  BidUser::join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
            ->join('users', 'id', '=', 'bid_user.user_id')
            ->where('id_bid', $id)
            ->get();
        // dd($data_response);
        $data_approved =  BidUser::join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
            ->join('users', 'users.id', '=', 'bid_user.user_id')
            ->join('approve_bid', 'approve_bid.bid_user_id', '=', 'bid_user.id_biduser')
            ->where('bid.id_bid', $id)
            ->where('bid_user.bid_id', $id)
            ->where('approve_bid.bid_id', $id)
            ->where('bid_user.status_biduser', 1)
            ->where('approve_bid.status_bid', 1)
            ->get();
        // dd($data_approved);
        $data_return =  BidUser::join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
            ->join('users', 'users.id', '=', 'bid_user.user_id')
            ->join('approve_bid', 'approve_bid.bid_user_id', '=', 'bid_user.id_biduser')
            ->where('bid.id_bid', $id)
            ->where('bid_user.status_biduser', 1)
            ->where('approve_bid.status_bid', 1)
            ->get();
        $data_disapproves =  BidUser::join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
            ->join('users', 'id', '=', 'bid_user.user_id')
            ->where('id_bid', $id)
            ->where('status_biduser', 5)
            ->get();
        $data_proses =  BidUser::join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
            ->join('users', 'id', '=', 'bid_user.user_id')
            ->where('id_bid', $id)
            ->where('status_biduser', 0)
            ->get();
        $data_count = BidUser::join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
            ->join('users', 'id', '=', 'bid_user.user_id')
            ->where('id_bid', $id)
            ->where('status_biduser', 0)
            ->count();
        $status = ApproveBid::where('bid_id', $id)->first();
        return view('dashboard.superadmin.bid.dt_responbid', ['parameter' => $parameter, 'data_count' => $data_count, 'kuota_sisa' => $kuota_sisa, 'bid' => $bid, 'data_response' => $data_response, 'status' => $status, 'data_proses' => $data_proses, 'data_approved' => $data_approved, 'data_disapproves' => $data_disapproves, 'data_return' => $data_return, 'data_approve' => $data_approve]);
    }

    public function data_approve_index($id)
    {
        return Datatables::of(BidUser::join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
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
                $img = url('img/bid/pp_bid.jpg');
                if (is_null($list->image_bid)) {
                    return '
                                <img src="' . $img . '" width="100px"/>
                            ';
                } else
                    return '
                <img src="' . $img . '" width="100px"/>
            ';
            })
            ->addColumn('description_bid', function ($list) {
                $result = $list->description_bid;
                return '<a style="margin:2px;" href="' . route('sourching.bid_response', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
            <i class="fa fa-eye"></i>
            </a>';
            })
            ->addColumn('response', function ($list) {
                return '<a style="margin:2px;" href="' . route('sourching.bid_response', ['id_bid' => $list->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Response Data" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
            <i class="fa fa-eye"></i>
            </a>';
            })
            ->addColumn('ckelola', function ($buatmanage) {
                return '
                <a style="margin:2px;" name="' . $buatmanage->id_bid . '" data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-pen-alt" style="color:#00c5dc;"></i>
                </a>
                <a style="margin:2px;" href="' . route('sourching.bid_destroy', ['id_bid' => $buatmanage->id_bid]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-trash"></i>
                </a>
            ';
            })
            ->rawColumns(['name_bid', 'date_bid', 'image_bid', 'response', 'ckelola'])
            ->make(true);
    }

    public function bid_user($id)
    {
        $data = BidUser::join('users', 'users.id', '=', 'bid_user.user_id')
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
        $get_partnum = Item::where('kode_item', $request->kode_item)->first();
        // dd($get_partnum->nama_item);
        $get_user = User::where('id', $request->user_idbid)->first();
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



        $get_tanggal_po = Bid::where('id_bid', $request->bid_id)->first();
        // $kode_po_aol = 'PO.BP.' . date('m', strtotime($get_tanggal_po->open_po)) . '.' . Carbon::parse($get_tanggal_po->open_po)->format('y') . '.';
        // dd($kode_po_aol);
        $tanggal_po     = $request->tanggal_po;
        $data = BidUser::where('bid_id', $request->bid_id)
            ->where('user_id', $request->user_idbid)
            ->where('id_biduser', $request->id_biduser)
            ->first();

        if ($data->status_biduser == 0) {
            BidUser::where('id_biduser', $request->id_biduser)->update(['status_biduser' => $request->status_bid]);
            $buat_po = $request->permintaan_diterima;
            // dd($buat_po);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $get_user->nomer_hp,
                    'message' =>
                    "PEMBERITAHUAN!

Hallo *$get_user->name*


*PT SURYA PANGAN SEMESTA NGAWI* Ingin menyampaikan informasi bahwa PO Tanggal : *" . Carbon::parse($tanggal_po)->format('d-m-Y') . "*
       Pengajuan : $data->jumlah_kirim PO
       Diterima    : $request->permintaan_diterima PO
       Ditolak      : $request->permintaan_ditolak PO

Terima kasih
_Sent Via *PT SURYA PANGAN SEMESTA NGAWI*_",
                    'countryCode' => '62', //optional
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: t37BRkrNu+4F!rUJXQdB' //change TOKEN to your actual token
                ),
            ));

            $response = curl_exec($curl);
            if (curl_errno($curl)) {
                $error_msg = curl_error($curl);
            }
            curl_close($curl);

            if (isset($error_msg)) {
                echo $error_msg;
            }
            echo $response;
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
                    $last_id = ApproveBid::orderBy('id_approvebid', 'DESC')->first();
                    $antrian1 = DataPO::where('tanggal_po', $request->tanggal_po)->count();
                    $antrian1 = ($antrian1 + 1);
                    if (strlen((string) $antrian1) == 1) {
                        // dd('1');
                        $antrian1 = '00' . ($antrian1);
                        $kode_po = 'PO.NGW.BP.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                        $kode_po_aol = 'PO.BP.' . date('m', strtotime($get_tanggal_po->open_po)) . '.' . Carbon::parse($get_tanggal_po->open_po)->format('y') . '.';
                        // Integrasi Epicor
                        $Data_po = new  DataPO();
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
                            function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $kode_po_aol, $buat_po, $i) {
                                echo $response = $response->getBody()->getContents();
                                for ($i = 0; $i < $buat_po; $i++) {
                                    $Data_po->id_approvebid                 = $last_id->id_approvebid;
                                    $Data_po->bid_user_id                   = $request->id_biduser;
                                    $Data_po->user_idbid                    = $request->user_idbid;
                                    $Data_po->bid_id                        = $request->bid_id;
                                    $Data_po->status_bid                    = $request->status_bid;
                                    $Data_po->permintaan_kirim              = $request->permintaan_diterima;
                                    $Data_po->permintaan_ditolak            = $request->permintaan_ditolak;
                                    $Data_po->kode_po                       = $kode_po;
                                    $Data_po->message_admin                 = $request->message_admin;
                                    $Data_po->tanggal_po                    = $request->tanggal_po;
                                    $Data_po->tanggal_bongkar               = $request->tanggal_bongkar;
                                    $Data_po->PONum                         = $response;
                                    $Data_po->kode_po_aol                   = $kode_po_aol;
                                    $Data_po->kode_matauang_aol             = $request->kode_matauang_aol;
                                    $Data_po->kurs_aol                      = $request->kurs_aol;
                                    $Data_po->diskon_persen_aol             = $request->diskon_persen_aol;
                                    $Data_po->diskon_rp_aol                 = $request->diskon_rp_aol;
                                    $Data_po->kuantitas_aol                 = $request->kuantitas_aol;
                                    $Data_po->satuan_aol                    = $request->satuan_aol;
                                    $Data_po->harga_aol                     = $request->harga_aol;
                                    $Data_po->diskon1_persen_aol            = $request->diskon1_persen_aol;
                                    $Data_po->diskon1_rp_aol                = $request->diskon1_rp_aol;
                                    $Data_po->total_harga_aol               = $request->total_harga_aol;
                                    $Data_po->departemen_aol                = $request->departemen_aol;
                                    $Data_po->projek_aol                    = $request->projek_aol;
                                    $Data_po->permintaan_barang_aol         = $request->permintaan_barang_aol;
                                    $Data_po->catatan_aol                   = $request->catatan_aol;
                                    $Data_po->kena_pajak_aol                = $request->kena_pajak_aol;
                                    $Data_po->total_termasuk_pajak_aol      = $request->total_termasuk_pajak_aol;
                                    $Data_po->tgl_pengiriman_aol            = $request->tgl_pengiriman_aol;
                                    $Data_po->pengiriman_aol                = $request->pengiriman_aol;
                                    $Data_po->cabang_aol                    = $request->cabang_aol;
                                    $Data_po->batas_penerimaan_po           = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
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
                    } elseif (strlen((string) $antrian1) == 2) {
                        // dd('2');
                        $antrian1 = '0' . ($antrian1);
                        $kode_po = 'PO.NGW.BP.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                        $kode_po_aol = 'PO.BP.' . date('m', strtotime($get_tanggal_po->open_po)) . '.' . Carbon::parse($get_tanggal_po->open_po)->format('y') . '.';
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
                            function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $kode_po_aol, $buat_po, $i) {
                                echo $response = $response->getBody()->getContents();
                                for ($i = 0; $i < $buat_po; $i++) {
                                    $Data_po->id_approvebid                 = $last_id->id_approvebid;
                                    $Data_po->bid_user_id                   = $request->id_biduser;
                                    $Data_po->user_idbid                    = $request->user_idbid;
                                    $Data_po->bid_id                        = $request->bid_id;
                                    $Data_po->status_bid                    = $request->status_bid;
                                    $Data_po->permintaan_kirim              = $request->permintaan_diterima;
                                    $Data_po->permintaan_ditolak            = $request->permintaan_ditolak;
                                    $Data_po->kode_po                       = $kode_po;
                                    $Data_po->message_admin                 = $request->message_admin;
                                    $Data_po->tanggal_po                    = $request->tanggal_po;
                                    $Data_po->tanggal_bongkar               = $request->tanggal_bongkar;
                                    $Data_po->PONum                         = $response;
                                    $Data_po->kode_po_aol                   = $kode_po_aol;
                                    $Data_po->kode_matauang_aol             = $request->kode_matauang_aol;
                                    $Data_po->kurs_aol                      = $request->kurs_aol;
                                    $Data_po->diskon_persen_aol             = $request->diskon_persen_aol;
                                    $Data_po->diskon_rp_aol                 = $request->diskon_rp_aol;
                                    $Data_po->kuantitas_aol                 = $request->kuantitas_aol;
                                    $Data_po->satuan_aol                    = $request->satuan_aol;
                                    $Data_po->harga_aol                     = $request->harga_aol;
                                    $Data_po->diskon1_persen_aol            = $request->diskon1_persen_aol;
                                    $Data_po->diskon1_rp_aol                = $request->diskon1_rp_aol;
                                    $Data_po->total_harga_aol               = $request->total_harga_aol;
                                    $Data_po->departemen_aol                = $request->departemen_aol;
                                    $Data_po->projek_aol                    = $request->projek_aol;
                                    $Data_po->permintaan_barang_aol         = $request->permintaan_barang_aol;
                                    $Data_po->catatan_aol                   = $request->catatan_aol;
                                    $Data_po->kena_pajak_aol                = $request->kena_pajak_aol;
                                    $Data_po->total_termasuk_pajak_aol      = $request->total_termasuk_pajak_aol;
                                    $Data_po->tgl_pengiriman_aol            = $request->tgl_pengiriman_aol;
                                    $Data_po->pengiriman_aol                = $request->pengiriman_aol;
                                    $Data_po->cabang_aol                    = $request->cabang_aol;
                                    $Data_po->batas_penerimaan_po           = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
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
                    } else {
                        // dd('3');
                        $antrian1 = ($antrian1);
                        $kode_po = 'PO.NGW.BP.BKS/' . date('Y', strtotime($get_tanggal_po->open_po)) . date('m', strtotime($get_tanggal_po->open_po)) . date('d', strtotime($get_tanggal_po->open_po)) . '/' . $antrian1;
                        $kode_po_aol = 'PO.BP.' . date('m', strtotime($get_tanggal_po->open_po)) . '.' . Carbon::parse($get_tanggal_po->open_po)->format('y') . '.';
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
                            function (Response $response) use ($Data_po, $last_id, $request, $kode_po, $kode_po_aol, $buat_po, $i) {
                                echo $response = $response->getBody()->getContents();
                                for ($i = 0; $i < $buat_po; $i++) {
                                    $Data_po->id_approvebid                 = $last_id->id_approvebid;
                                    $Data_po->bid_user_id                   = $request->id_biduser;
                                    $Data_po->user_idbid                    = $request->user_idbid;
                                    $Data_po->bid_id                        = $request->bid_id;
                                    $Data_po->status_bid                    = $request->status_bid;
                                    $Data_po->permintaan_kirim              = $request->permintaan_diterima;
                                    $Data_po->permintaan_ditolak            = $request->permintaan_ditolak;
                                    $Data_po->kode_po                       = $kode_po;
                                    $Data_po->message_admin                 = $request->message_admin;
                                    $Data_po->tanggal_po                    = $request->tanggal_po;
                                    $Data_po->tanggal_bongkar               = $request->tanggal_bongkar;
                                    $Data_po->PONum                         = $response;
                                    $Data_po->kode_po_aol                   = $kode_po_aol;
                                    $Data_po->kode_matauang_aol             = $request->kode_matauang_aol;
                                    $Data_po->kurs_aol                      = $request->kurs_aol;
                                    $Data_po->diskon_persen_aol             = $request->diskon_persen_aol;
                                    $Data_po->diskon_rp_aol                 = $request->diskon_rp_aol;
                                    $Data_po->kuantitas_aol                 = $request->kuantitas_aol;
                                    $Data_po->satuan_aol                    = $request->satuan_aol;
                                    $Data_po->harga_aol                     = $request->harga_aol;
                                    $Data_po->diskon1_persen_aol            = $request->diskon1_persen_aol;
                                    $Data_po->diskon1_rp_aol                = $request->diskon1_rp_aol;
                                    $Data_po->total_harga_aol               = $request->total_harga_aol;
                                    $Data_po->departemen_aol                = $request->departemen_aol;
                                    $Data_po->projek_aol                    = $request->projek_aol;
                                    $Data_po->permintaan_barang_aol         = $request->permintaan_barang_aol;
                                    $Data_po->catatan_aol                   = $request->catatan_aol;
                                    $Data_po->kena_pajak_aol                = $request->kena_pajak_aol;
                                    $Data_po->total_termasuk_pajak_aol      = $request->total_termasuk_pajak_aol;
                                    $Data_po->tgl_pengiriman_aol            = $request->tgl_pengiriman_aol;
                                    $Data_po->pengiriman_aol                = $request->pengiriman_aol;
                                    $Data_po->cabang_aol                    = $request->cabang_aol;
                                    $Data_po->batas_penerimaan_po           = Carbon::parse($request->batas_penerimaan)->format('Y-m-d 12:00:00');
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
                    $last_id = ApproveBid::orderBy('id_approvebid', 'DESC')->first();
                    $antrian1 = DataPO::where('tanggal_po', $request->tanggal_po)->count();
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
                                    $Data_po->tanggal_bongkar               = $request->tanggal_bongkar;
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
                                    $Data_po->tanggal_bongkar               = $request->tanggal_bongkar;
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
                                    $Data_po->tanggal_bongkar               = $request->tanggal_bongkar;
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
            }

            $notif              = new NotifSecurity();
            $notif->judul       = 'PO Baru';
            $notif->keterangan  = 'Ada PO Baru, Dari Supplier : ' . $get_user->nama_vendor . ' , Jumlah : ' . $request->permintaan_diterima . ' PO';
            $notif->notifbaru   = '0';
            $notif->status      = '0';
            $notif->id_objek    = $request->bid_id;
            $notif->kategori    = '0';
            $notif->created_at  = date('Y-m-d H:i:s');
            $notif->save();
            Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1000);
            return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1000);
            // die();
        } elseif ($data->status_biduser == 1) {
            $a = BidUser::where('id_biduser', $request->id_biduser)->update(['status_biduser' => 3]);
            $b = new Transaksi();
            $c = DB::table('transaksi')->orderBy('id_transaksi', 'DESC')->first();
            $kode = $c->id_transaksi + 1 . '-' . $request->kode_transaksi;
            $b->id_biduser_id       = $request->id_biduser;
            $b->id_vendor_transaksi = $request->user_idbid;
            $b->id_bid_transaksi    = $request->bid_id;
            $b->kode_transaksi      = "VD02-" . $kode;
            $b->waktu_transaksi     = Carbon::now()->format('Y-m-d');
            $b->save();
            Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1000);
            return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1000);
        }
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1000);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.', 1000);
    }

    public function konfirmasi_bongkar(Request $request)
    {
        // dd($request->bongkar);
        if ($request->bongkar == 'bongkar') {
            $data = Lab1GabahBasah::where('lab1_id_data_po_gb', $request->id_datapo)->first();
            $data->output_lab_gb = 'Unload';
            $data->status_pending = NULL;
            $data->status_lab1_gb = '7';
            $data->status_approved = '1';
            $data->update();

            $data1 = DataPO::where('id_data_po', $request->id_datapo)
                ->update([
                    'status_bid' => '7',
                ]);
            $data2 = PenerimaanPO::where('penerimaan_id_data_po', $request->id_datapo)
                ->update([
                    'status_penerimaan' => '7',
                ]);

            // insert Log Aktivity
            $log = new LogAktivitySourching();
            $log->name_user    = Auth::guard('sourching')->user()->name;
            $log->id_objek_aktivitas_sourching  = $data->id_lab1_gb;
            $log->aktivitas_sourching  = 'Konfirmasi Supplier, setuju bongkar. Kode PO: ' . $data->lab1_kode_po_gb . ' Plan Harga : ' . $data->plan_harga_gb;
            $log->keterangan_aktivitas  = 'Selesai';
            $log->created_at           = date('Y-m-d H:i:s');
            $log->save();

            $po = trackerPO::where('kode_po_tracker', $data->lab1_kode_po_gb)->first();
            if ($po == NULL) {
            } else {
                $po->nama_admin_tracker  = Auth::guard('sourching')->user()->name;
                $po->proses_tracker  = 'KONFIRMASI Supplier, PO SETUJU DIBONGKAR';
                $po->konfirmasi_pending_tracker  = date('Y-m-d H:i:s');
                $po->update();
            }
        } elseif ($request->bongkar == 'tidak') {

            $data = Lab1GabahBasah::where('lab1_id_data_po_gb', $request->id_datapo)->first();
            $data->output_lab_gb = 'Reject';
            $data->status_pending = NULL;
            $data->status_lab1_gb = '5';
            $data->status_approved = '0';
            $data->update();

            $data1 = DataPO::where('id_data_po', $request->id_datapo)
                ->update([
                    'status_bid' => '5',
                ]);
            $data2 = PenerimaanPO::where('penerimaan_id_data_po', $request->id_datapo)
                ->update([
                    'status_penerimaan' => '5',
                ]);

            // insert Log Aktivity
            $log = new LogAktivitySourching();
            $log->name_user    = Auth::guard('sourching')->user()->name;
            $log->id_objek_aktivitas_sourching  = $data->id_lab1_gb;
            $log->aktivitas_sourching  = 'Konfirmasi Supplier, Tolak bongkar. Kode PO: ' . $data->lab1_kode_po_gb . ' Plan Harga : ' . $data->plan_harga_gb;
            $log->keterangan_aktivitas  = 'Selesai';
            $log->created_at           = date('Y-m-d H:i:s');
            $log->save();
            // dd($data);

            $po = trackerPO::where('kode_po_tracker', $data->lab1_kode_po_gb)->first();
            if ($po == NULL) {
            } else {
                $po->nama_admin_tracker  = Auth::guard('sourching')->user()->name;
                $po->proses_tracker  = 'KONFIRMASI SUPPLIER, PO DITOLAK';
                $po->konfirmasi_pending_tracker  = date('Y-m-d H:i:s');
                $po->update();
            }
        }
        Alert::success('Berhasil', 'Data anda berhasil di Simpan');
        return redirect()->back()->with('Berhasil', 'Data anda berhasil di Simpan');
    }
    public function UpdatePOHeader(Request $request)
    {

        $data = $request->only(
            'PONum'
        );
        $test['data'] = json_encode($data);
        $query = DB::table('PONum')->insert($data);
        return response()->json(['message' => 'Berhasil Ditambahkan']);
    }
}
