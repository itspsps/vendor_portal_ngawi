<?php

namespace App\Http\Controllers\AdminMaster;

use App\Http\Controllers\Controller;
use App\Models\LogAktivityAp;
use App\Models\LogAktivitySpvAp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use DataTables;
use App\Models\PenerimaanPO;

class MasterSpvApController extends Controller
{
    public function approve_receipt($id)
    {
        $get = DB::table('penerimaan_po')
            ->join('data_po', 'data_po.id_data_po', '=', 'penerimaan_po.penerimaan_id_data_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'penerimaan_po.penerimaan_kode_po')
            ->where('penerimaan_po.id_penerimaan_po', $id)->first();
        $get_bin_num = DB::table('penerimaan_po')
            ->join('lab1_gb', 'lab1_gb.lab1_id_penerimaan_po_gb', 'penerimaan_po.id_penerimaan_po')
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
        $log->nama_user                    = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_spvap       = $id;
        $log->aktivitas_spvap                = 'Approved Receipt dengan Kode PO:' . $data->penerimaan_kode_po;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();
    }
    public function approve_receipt_pk($id)
    {
        $data = DB::table('penerimaan_po')
            ->join('data_po', 'data_po.id_data_po', '=', 'penerimaan_po.penerimaan_id_data_po')
            ->join('lab2_pk', 'lab2_pk.lab2_kode_po_pk', '=', 'penerimaan_po.penerimaan_kode_po')
            ->where('penerimaan_po.id_penerimaan_po', $id)->first();
        $get_bin_num = DB::table('penerimaan_po')
            ->join('lab1_pk', 'lab1_pk.lab1_id_penerimaan_po_pk', 'penerimaan_po.id_penerimaan_po')
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
            'BinNum' => '',
            'SPS_Nopol_c' => $data->plat_kendaraan,
            'PTI_PONum_c' => $data->penerimaan_kode_po,
            'SPS_PODate_c'   => $data->tanggal_po,
        ];
        $response = $client->post($url, ['form_params' => $form_params]);
        $response = $response->getBody()->getContents();
        // dd($response);   
        $query = DB::table('penerimaan_po')->where('id_penerimaan_po', $id)->update(['penerimaan_po_num' => $data->PONum, 'created_at_approved_receipt' => date('Y-m-d H:i:s'), 'status_approved_receipt' => 1]);
    }
    public function not_approve_receipt_pk($id)
    {
        $query = DB::table('penerimaan_po')->where('id_penerimaan_po', $id)
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

        $log                               = new LogAktivityAp();
        $log->nama_user                    = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_spvap     = $id;
        $log->aktivitas_spvap              = 'Tolak Approved Receipt dengan Kode PO:' . $data->penerimaan_kode_po;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();
    }
    public function revisi_data_gb()
    {
        return view('dashboard.admin_master.admin_spvap.revisi_data_gb ');
    }

    public function revisi_data_gb_index()
    {
        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        return view('dashboard.admin_master.admin_spvap.revisi_data_pk ');
    }

    public function revisi_data_pk_index()
    {
        return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        return view('dashboard.admin_master.admin_spvap.integrasi_epicor_gb ');
    }

    public function integrasi_epicor_gb_index(Request $request)
    {

        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        return view('dashboard.admin_master.admin_spvap.integrasi_epicor_pk ');
    }

    public function integrasi_epicor_pk_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                return Datatables::of(DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        $get_id = DB::table('penerimaan_po')
            ->where('id_penerimaan_po', $id)
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
        $log->nama_user                    = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_spvap       = $id;
        $log->aktivitas_spvap                = 'Kirim Epicor Berhasil dengan Kode PO:' . $get_id->penerimaan_kode_po;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();
    }
    public function kirim_epicor_pk($id)
    {
        $get_id = DB::table('penerimaan_po')
            ->where('id_penerimaan_po', $id)
            ->first();
        // dd($get_id->PONum);
        //  Integrasi Epicor
        $update_status_penerimaan_po = DB::table('penerimaan_po')->where('id_penerimaan_po', $id)
            ->update(['status_epicor' => '1']);
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/PO/ApprovalPO?PONum=' . $get_id->penerimaan_po_num;
        $response = $client->get($url);
        $response = $response->getBody()->getContents();
        // dd($response); 
        // return json_encode($update_status_penerimaan_po);
    }

    public function approve_revisi($id)
    {
        $data = PenerimaanPO::where('id_penerimaan_po', $id)->first();
        $data->status_analisa = '2';
        $data->status_revisi = '0';
        $data->update();
        // return response()->json(["sukses"]);

        $log                               = new LogAktivitySpvAp();
        $log->nama_user                    = Auth::guard('spvap')->user()->name_spvap;
        $log->id_objek_aktivitas_spvap       = $id;
        $log->aktivitas_spvap                = 'Approved Pengajuan Revisi ke SPV AP dengan Kode PO:' . $data->penerimaan_kode_po . ', Keterangan : ' . $data->keterangan_analisa;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();
    }
    public function notapprove_revisi($id)
    {
        $data = PenerimaanPO::where('id_penerimaan_po', $id)->first();
        $data->status_analisa = '0';
        $data->analisa = 'verified';
        $data->keterangan_analisa = 'Sesuai';
        $data->update();

        $log                               = new LogAktivitySpvAp();
        $log->nama_user                    = Auth::guard('master')->user()->name_master;
        $log->id_objek_aktivitas_spvap     = $id;
        $log->aktivitas_spvap              = 'Tolak Pengajuan Revisi ke SPV AP dengan Kode PO:' . $data->penerimaan_kode_po . ', Keterangan : ' . $data->keterangan_analisa;
        $log->keterangan_aktivitas         = 'Selesai';
        $log->created_at                   = date('Y-m-d H:i:s');
        $log->save();
        // return response()->json(["sukses"]);
    }
    public function log_activity_spvap()
    {
        return view('dashboard.admin_master.admin_spvap.log_activity_spvap ');
    }

    public function log_activity_spvap_index()
    {
        return Datatables::of(DB::table('log_aktivitas_spvap')
            ->orderby('id_aktivitas_spvap', 'desc')
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

    // NOTIF SPV AP 

    public function get_notifapprovespvap()
    {
        $data = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('penerimaan_po.status_penerimaan', 13)
            ->where('penerimaan_po.analisa', '=', 'verified')
            ->where('penerimaan_po.status_epicor', NULL)
            ->where('lab2_gb.aksi_harga_gb', 'DEAL')
            ->orderBy('lab2_gb.id_lab2_gb', 'DESC')
            ->count();
        return response()->json($data);
    }
    public function get_notifrevisispvap()
    {
        $data = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('data_po.status_bid', 13)
            ->where('penerimaan_po.analisa', '=', 'revisi')
            ->where('lab2_gb.aksi_harga_gb', 'DEAL')
            ->orderby('id_penerimaan_po', 'desc')
            ->count();
        return response()->json($data);
    }
}
