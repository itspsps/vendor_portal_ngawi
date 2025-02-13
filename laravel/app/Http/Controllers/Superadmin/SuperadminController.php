<?php

namespace App\Http\Controllers\Superadmin;

use App\Exports\DataPesananPembelianAOL;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Superadmin;
use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use DataTables;
use Carbon\Carbon;
use PDF;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
// use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataSouchingDealGBExcel;
use App\Exports\DataSouchingDealPKExcel;
use App\Models\ApproveBid;
use App\Models\Bid;
use App\Models\DataPO;
use App\Models\DataQcBongkar;
use App\Models\Lab2GabahBasah;
use App\Models\LogAktivitySourching;
use App\Models\Notif;
use App\Models\NotifAp;
use App\Models\NotifSourching;
use App\Models\PenerimaanPO;
use App\Models\trackerPO;

class SuperadminController extends Controller
{
    function create(Request $request)
    {
        //Validate inputs
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:superadmins,email',
            'hospital' => 'required',
            'password' => 'required|min:5|max:30',
            'cpassword' => 'required|min:5|max:30|same:password'
        ]);

        $superadmin = new Superadmin();
        $superadmin->name = $request->name;
        $superadmin->email = $request->email;
        $superadmin->hospital = $request->hospital;
        $superadmin->password = Hash::make($request->password);
        $save = $superadmin->save();

        if ($save) {
            return redirect()->back()->with('success', 'You are now registered successfully as superadmin');
        } else {
            return redirect()->back()->with('fail', 'Something went Wrong, failed to register');
        }
    }

    function check(Request $request)
    {
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $array = $request->username;
        // $oke = json_encode($array);
        // dd($array);
        if ($fieldType == "username") {
            $data = Superadmin::where('username', $array)->first();
        } else {
            $data = Superadmin::where('email', $array)->first();
        }
        if (Auth::guard('sourching')->attempt(array($fieldType => $request->username, 'password' => $request->password))) {
            Alert::success('Berhasil', 'Selamat Datang ' . $data->name);
            return redirect()->route('sourching.home')->with('Berhasil', 'Selamat Datang ' . $data->name);
        } else {
            Alert::error('Gagal', 'Masukkan Email Atau Password Dengan Benar');
            return redirect()->route('sourching.login')->with('Gagal', 'Masukkan Email Atau Password Dengan Benar');
        }
    }

    public function cetak_po($id)
    {
        $params = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'user_idbid')
            ->where('id_data_po', $id)
            ->first();
        $data = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        $data1 = PDF::loadview('dashboard.superadmin.bid.cetak_po', ['data' => $data, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa, 'get_item' => $get_item]);
        return $data1->stream('CETAK ' . $params->kode_po . '.pdf');
    }

    function logout()
    {
        Auth::guard('sourching')->logout();
        Alert::success('Sukses', 'Anda Berhasil Logout');
        return redirect()->route('sourching.login')->with('Sukses', 'Anda Berhasil Logout');
    }

    function notifikasi_clear()
    {
        $data = NotifSourching::where('notifbaru', 0)
            // ->where('created_at', '>=', \Carbon\Carbon::now()->subDays(7)->startOfDay())
            ->get();
        return json_encode($data);
    }

    function home()
    {
        // $date= date('Y-m-d 12:00:00');
        $po_aktif = DataPO::where('batas_penerimaan_po', '>=', date('Y-m-d H:i:s'))
            ->count();
        $po_close = DataPO::where('status_bid', '=', '5')
            ->count();
        $po_finish = DataPO::join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', 'data_po.id_data_po')
            ->where('penerimaan_po.status_epicor', '=', '1')
            ->count();
        $po_proses = DataPO::join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', 'data_po.id_data_po')
            ->where('penerimaan_po.status_epicor', '=', NULL)
            ->where('penerimaan_po.status_penerimaan', '!=', '5')
            ->where('penerimaan_po.status_penerimaan', '!=', '16')
            ->count();

        return view('dashboard.superadmin.home', compact('po_aktif', 'po_close', 'po_finish', 'po_proses'));
    }
    function chart_po()
    {
        $year = date('Y');
        $chart_januari = DataPO::where('status_bid', '!=', '5')->whereYear('tanggal_po', $year)->whereMonth('tanggal_po', '01')->count();
        $chart_februari = DataPO::where('status_bid', '!=', '5')->whereYear('tanggal_po', $year)->whereMonth('tanggal_po', '02')->count();
        $chart_maret = DataPO::where('status_bid', '!=', '5')->whereYear('tanggal_po', $year)->whereMonth('tanggal_po', '03')->count();
        $chart_april = DataPO::where('status_bid', '!=', '5')->whereYear('tanggal_po', $year)->whereMonth('tanggal_po', '04')->count();
        $chart_mei = DataPO::where('status_bid', '!=', '5')->whereYear('tanggal_po', $year)->whereMonth('tanggal_po', '05')->count();
        $chart_juni = DataPO::where('status_bid', '!=', '5')->whereYear('tanggal_po', $year)->whereMonth('tanggal_po', '06')->count();
        $chart_juli = DataPO::where('status_bid', '!=', '5')->whereYear('tanggal_po', $year)->whereMonth('tanggal_po', '07')->count();
        $chart_agustus = DataPO::where('status_bid', '!=', '5')->whereYear('tanggal_po', $year)->whereMonth('tanggal_po', '08')->count();
        $chart_september = DataPO::where('status_bid', '!=', '5')->whereYear('tanggal_po', $year)->whereMonth('tanggal_po', '09')->count();
        $chart_oktober = DataPO::where('status_bid', '!=', '5')->whereYear('tanggal_po', $year)->whereMonth('tanggal_po', '10')->count();
        $chart_november = DataPO::where('status_bid', '!=', '5')->whereYear('tanggal_po', $year)->whereMonth('tanggal_po', '11')->count();
        $chart_desember = DataPO::where('status_bid', '!=', '5')->whereYear('tanggal_po', $year)->whereMonth('tanggal_po', '12')->count();
        $data_charts = DataPO::join('users', 'users.id', 'data_po.user_idbid')
            ->whereYear('tanggal_po', $year)
            ->groupBy('data_po.user_idbid')
            ->selectRaw('users.name,COUNT(*) AS total_po')
            ->orderBy('total_po', 'DESC')
            ->take(6)
            ->pluck('name', 'total_po')->toArray();
        $data_charts1 = DataPO::join('users', 'users.id', 'data_po.user_idbid')
            ->where('data_po.status_bid', '!=', '5')
            ->whereYear('tanggal_po', $year)
            ->groupBy('data_po.user_idbid')
            ->selectRaw('users.name,COUNT(*) AS total_po')
            ->orderBy('total_po', 'DESC')
            ->take(6)
            ->pluck('name', 'total_po')->toArray();
        $chart_key = (array_keys($data_charts));
        $chart_key1 = (array_keys($data_charts1));
        $chart_value = (array_values($data_charts));
        // $ok = json_encode($chart_supplier);
        // dd($chart_top1);
        $result = [
            'chart_januari' => $chart_januari,
            'chart_februari' => $chart_februari,
            'chart_maret' => $chart_maret,
            'chart_april' => $chart_april,
            'chart_mei' => $chart_mei,
            'chart_juni' => $chart_juni,
            'chart_juli' => $chart_juli,
            'chart_agustus' => $chart_agustus,
            'chart_september' => $chart_september,
            'chart_oktober' => $chart_oktober,
            'chart_november' => $chart_november,
            'chart_desember' => $chart_desember,
            'chart_key' => $chart_key,
            'chart_key1' => $chart_key1,
            'chart_value' => $chart_value,
            // 'chart_supplier' => $chart_supplier
        ];
        // dd($chart_key,$chart_value);
        return response()->json($result);
    }
    function bid()
    {
        $date = date('Y-m-d H:i:s');
        // dd($date);
        $query = Bid::where('batas_bid', '<=', $date)->where('bid_status', '1')->orderBy('date_bid', 'DESC')->get();
        // dd($query);
        foreach ($query as $kediri) {
            $data = Bid::where('id_bid', '=', $kediri->id_bid)
                ->update([
                    'bid_status' => '0',
                    'status_edit' => 'EDIT SOURCHING',
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
            // insert Log Aktivity
            $data = new LogAktivitySourching();
            $data->name_user    = Auth::guard('sourching')->user()->name;
            $data->id_objek_aktivitas_sourching  = $kediri->id_bid;
            $data->aktivitas_sourching  = 'Menonaktifkan Lelang ' . $kediri->name_bid . ' PO ' . $kediri->open_po;
            $data->keterangan_aktivitas  = 'Selesai';
            $data->created_at           = date('Y-m-d H:i:s');
            $data->save();
        }
        return view('dashboard.superadmin.bid.dt_bid');
    }

    public function late_delivery()
    {
        $data_pengajuan_telat =  DataPO::join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->where('data_po.status_bid', 4)
            ->get();
        // dd($data_pengajuan_telat);
        return view('dashboard.superadmin.bid.late_delivery', ['data_pengajuan_telat' => $data_pengajuan_telat]);
    }

    public function perpanjang_po($id)
    {
        //dd($id);
        $data = DataPO::where('id_data_po', $id)->first();
        $update_tabel_data_po = DataPO::where('bid_user_id', $data->bid_user_id)->where('status_bid', 4)->first();
        //dd($update_tabel_data_po);
        if ($update_tabel_data_po->status_bid == 4) {
            DataPO::where('bid_user_id', $data->bid_user_id)
                ->where('status_bid', 4)
                ->update(['status_bid' => 1, 'batas_penerimaan_po' => date('Y-m-d 23:00:00')]);
        }
        return redirect()->back();
    }

    public function transaction()
    {
        $data = DB::table('transaksi')->join('users', 'users.id', '=', 'transaksi.id_vendor_transaksi')
            ->join('bid', 'bid.id_bid', '=', 'transaksi.id_bid_transaksi')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'transaksi.id_biduser_id')
            ->join('approve_bid', 'approve_bid.bid_user_id', '=', 'transaksi.id_biduser_id')
            ->get();
        return view('dashboard.superadmin.transaksi.dt_transaksi', ['data' => $data]);
    }

    public function vendor()
    {
        return view('dashboard.superadmin.vendor.dt_vendor');
    }
    public function add_vendor()
    {
        return view('dashboard.superadmin.vendor.dt_tambah_vendor');
    }

    public function vendor_store(Request $request)
    {
        if ($request->nama_bank == 'BB00100') {
            $norek_length = '15';
        } elseif ($request->nama_bank == 'BB00200') {
            $norek_length = '13';
        } else {
            $norek_length = '10';
        }
        // dd($request->all());
        $rules = [
            // 'vendorid'                      => 'required|max:255',
            // 'name'                          => 'required|max:255',
            // 'sps_alias_c'                   => 'nullable|max:255',
            // 'address1'                      => 'required|max:255',
            // 'address2'                      => 'required|max:255',
            // 'address3'                      => 'required|max:255',
            // 'city'                          => 'required|max:255',
            // 'state'                         => 'required|max:255',
            // 'zip'                           => 'required|max:255',
            // 'taxpayerID'                    => 'required|max:255',
            // 'SPS_NameNPWP_c'                => 'required|max:255',
            // 'SPS_AlamatNPWP_c'              => 'required|max:255',
            // 'SPS_ActiveDate_c'              => 'required|max:255',
            // 'SPS_InactiveDate_c'            => 'required|max:255',
            // 'faxnum'                        => 'required|max:255',
            // 'SPS_phonenum_c'                => 'required|max:255',
            // 'emailaddress'                  => 'required|max:255',
            // 'shipviacode'                   => 'required|max:255',
            // 'taxregioncode'                 => 'required|max:255',
            // 'GroupCode'                     => 'required|max:255',
            // 'BankAcctNumber'                => 'required|max:255',
            // 'BankName'                      => 'required|max:255',
            // 'BankBranchCode'                => 'required|max:255',
            // 'SPS_niksupplier_c'             => 'required|max:255',

            'nama_npwp'                     => 'required|max:255',
            'npwp'                          => 'required|unique:users',
            'id_provinsinpwp'               => 'required|max:255',
            'id_kabupatennpwp'              => 'required|max:255',
            'id_kecamatannpwp'              => 'required|max:255',
            'id_desanpwp'                   => 'required|max:255',
            'keterangan_alamat_npwp'        => 'nullable|max:255',
            'rt_npwp'                       => 'required|max:255',
            'rw_npwp'                       => 'required|max:255',
            'nama_ktp'                      => 'required|max:255',
            'ktp'                           => 'required|unique:users',
            'id_provinsiktp'                => 'required|max:255',
            'id_kabupatenktp'               => 'required|max:255',
            'id_kecamatanktp'               => 'required|max:255',
            'id_desaktp'                    => 'required|max:255',
            'keterangan_alamat_ktp'         => 'nullable|max:255',
            'rt_ktp'                        => 'required|max:255',
            'rw_ktp'                        => 'required|max:255',
            'nama_bank'                     => 'required|max:255',
            'nomer_rekening'                => 'required|max:' . $norek_length . '|min:' . $norek_length,
            'nama_penerima_bank'            => 'required|max:255',
            'cabang_bank'                   => 'required|max:255',
            'nama_vendor'                   => 'required|max:255',
            'nomer_hp'                      => 'required|max:255',
            'username'                      => 'required|unique:users|max:255',
            'email'                         => 'nullable|max:255|unique:users',
            'badan_usaha'                   => 'nullable|max:255',
            'password'                      => 'required|max:255',
            'gambar_npwp'                   => 'mimes:jpeg,png,jpg,gif|max:3000|required',
            'gambar_ktp'                    => 'mimes:jpeg,png,jpg,gif|max:3000|required',
            'pakta_integritas'              => 'max:3000|required',
            'fis'                           => 'mimes:jpeg,png,jpg,gif|max:3000|required',
        ];
        $customMessages = [
            'required' => ':attribute tidak boleh kosong.',
            'unique' => ':attribute tidak boleh sama',
            // 'email' => ':attribute format email salah',
            'max' => ':attribute Kurang Dari Batas Minimal',
            'min' => ':attribute Melebihi Batas Maksimal'
        ];
        // dd($request->all());
        $validatedData = $request->validate($rules, $customMessages);
        // dd($validatedData);
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



        //dd('VD150'.($nomer_urut + 2));
        //dd($cek_address1->name.', '.$cek_address2->name.', '.$cek_address3->name.' INDONESIA');
        if ($validatedData['nama_bank'] == 'BB00100') {
            $bank_code = 'BBRI';
            $bank_name = 'PT BANK RAKYAT INDONESIA (PERSERO) Tbk';
        } else if ($validatedData['nama_bank'] == 'BB00200') {
            $bank_code = 'BMRI';
            $bank_name = 'PT BANK MANDIRI (PERSERO) Tbk';
        } else {
            $bank_code = 'BB00700';
            $bank_name = 'PT BANK CENTRAL ASIA Tbk';
        }
        // if ($cek_email == '' && $cek_npwp == '' && $cek_ktp == '') {
        $cek_address1 = DB::table('districts')->where('id', $validatedData['id_kecamatannpwp'])->first();
        $cek_address2 = DB::table('regencies')->where('id', $validatedData['id_kabupatennpwp'])->first();
        $cek_address3 = DB::table('provinces')->where('id', $validatedData['id_provinsinpwp'])->first();

        // NPWP
        $npwp =  str_replace(' ', '', $validatedData['npwp']);
        // dd($validatedData);
        $client = new \GuzzleHttp\Client();
        // $url = 'https://sumberpangan.store/api/postman';
        $url = 'http://34.34.222.145:2022/api/Vendor/InsertVendor';
        $form_params = [
            'vendor_id'         => '',
            'name'              => $validatedData['nama_vendor'],
            'password'          => $validatedData['password'],
            'groupcode'         => '1PBB',
            'nomer_hp'          => $validatedData['nomer_hp'],
            'name'              => $validatedData['nama_ktp'],
            'sps_alias_c'       => $validatedData['badan_usaha'],
            'address1'          => $cek_address1->name,
            'address2'          => $cek_address2->name,
            'address3'          => $cek_address3->name,
            'city'              => $cek_address2->name,
            'state'             => $cek_address3->name,
            'taxpayerid'        => $npwp,
            'sps_namenpwp_c'    => $validatedData['nama_npwp'],
            'sps_alamatnpwp_c'  => $cek_address1->name . ', ' . $cek_address2->name . ', ' . $cek_address3->name . ' INDONESIA',
            'inactive'          => 'false',
            'sps_phonenum_c'    => $validatedData['nomer_hp'],
            'emailaddress'      => $validatedData['email'],
            'termscode'         => 'PT01',
            'bankacctnumber'    => $validatedData['nomer_rekening'],
            'bankbranchcode'    => $bank_code,
            'sps_niksupplier_c' => $validatedData['ktp'],
            'bankAccountID'     => 'BA101',
            'BankName'          => $bank_name
        ];
        $response = $client->post($url, ['form_params' => $form_params]);
        $response = $response->getBody()->getContents();
        $result     = preg_replace("/[^a-zA-Z0-9]/", "", $response);
        $query = User::create([
            // 'vendorid'           => Str::upper($request->vendor_id),
            'vendorid'           => $result,
            'name'               => $validatedData['nama_vendor'],
            'sps_alias_c'        => $validatedData['badan_usaha'],
            'address1'           => $cek_address1->name,
            'address2'           => $cek_address2->name,
            'address3'           => $cek_address3->name,
            'city'               => $cek_address2->name,
            'state'              => $cek_address3->name,
            'zip'                => '-',
            'taxpayerID'         => $npwp,
            'SPS_NameNPWP_c'     => $validatedData['nama_npwp'],
            'SPS_AlamatNPWP_c'   => $cek_address1->name . ', ' . $cek_address2->name . ', ' . $cek_address3->name . ' INDONESIA',
            'SPS_ActiveDate_c'   => date('Y-m-d'),
            'SPS_InactiveDate_c' => date('Y-m-d'),
            'faxnum'             => '-',
            'SPS_phonenum_c'     => $validatedData['nomer_hp'],
            'emailaddress'       => $validatedData['email'],
            'shipviacode'        => '-',
            'taxregioncode'      => 'TX54',
            'GroupCode'          => '1PBB',
            'BankAcctNumber'     => $validatedData['nomer_rekening'],
            'BankName'           => $bank_name,
            'BankBranchCode'     => $bank_code,
            'SPS_niksupplier_c'  => $validatedData['ktp'],

            'nama_vendor'                   => $validatedData['nama_vendor'],
            'nama_npwp'                     => $validatedData['nama_npwp'],
            'email'                         => $validatedData['email'],
            'npwp'                          => $npwp,
            'rt_npwp'                       => $validatedData['rt_npwp'],
            'rw_npwp'                       => $validatedData['rw_npwp'],
            'id_provinsinpwp'               => $validatedData['id_provinsinpwp'],
            'id_kabupatennpwp'              => $validatedData['id_kabupatennpwp'],
            'id_kecamatannpwp'              => $validatedData['id_kecamatannpwp'],
            'id_desanpwp'                   => $validatedData['id_desanpwp'],
            'keterangan_alamat_npwp'        => $validatedData['keterangan_alamat_npwp'],
            'nama_bank'                     => $bank_name,
            'nomer_rekening'                => $validatedData['nomer_rekening'],
            'nama_penerima_bank'            => $validatedData['nama_penerima_bank'],
            'cabang_bank'                   => $validatedData['cabang_bank'],
            'nama_ktp'                      => $validatedData['nama_ktp'],
            'ktp'                           => $validatedData['ktp'],
            'rt_ktp'                        => $validatedData['rt_ktp'],
            'rw_ktp'                        => $validatedData['rw_ktp'],
            'id_provinsiktp'                => $validatedData['id_provinsiktp'],
            'id_kabupatenktp'               => $validatedData['id_kabupatenktp'],
            'id_kecamatanktp'               => $validatedData['id_kecamatanktp'],
            'id_desaktp'                    => $validatedData['id_desaktp'],
            'keterangan_alamat_ktp'         => $validatedData['keterangan_alamat_ktp'],
            'nomer_hp'                      => $validatedData['nomer_hp'],
            'username'                      => $validatedData['username'],
            'password'                      => Hash::make($validatedData['password']),
            'password_show'                 => $validatedData['password'],
            'status_user'                   => '1',
            'gambar_npwp'                   => $imageNameNPWP,
            'gambar_ktp'                    => $imageNameKTP,
            'pakta_integritas'              => $imageNamePI,
            'fis'                           => $imageNameFIS
        ]);
        Alert::success('Berhasil', 'Data anda berhasil di Simpan.', 1500);
        return redirect()->back()->with('success', 'Data anda berhasil di Simpan.');
    }
    public function get_verifyemail($id)
    {
        $get_verifyemail = User::where('email', $id)->where('status_user', '1')->count();
        return json_encode($get_verifyemail);
    }
    public function get_nik($id)
    {
        $get_nik = User::where('status_user', '1')->where('ktp', $id)->count();
        return json_encode($get_nik);
    }
    public function cekUsername($id)
    {
        $user = User::where('username', $id)->where('status_user', '1')->count();
        return json_encode($user);
    }
    public function get_npwp($id)
    {
        $get_npwp = User::where('npwp', $id)->where('status_user', '1')->count();
        return json_encode($get_npwp);
    }
    public function getkabupaten(Request $request)
    {
        $id_provinsi    = $request->id_provinsi;
        $kabupaten      = Regency::where('province_id', $id_provinsi)->orderBy('name', 'ASC')->get();
        echo "<option value=''>Pilih Kabupaten...</option>";
        foreach ($kabupaten as $kabupaten) {
            echo "<option value='$kabupaten->id'>$kabupaten->name</option>";
        }
    }

    public function getkecamatan(Request $request)
    {
        $id_kabupaten    = $request->id_kabupaten;
        $kecamatan       = District::where('regency_id', $id_kabupaten)->orderBy('name', 'ASC')->get();
        echo "<option value=''>Pilih Kecamatan...</option>";
        foreach ($kecamatan as $kecamatan) {
            echo "<option value='$kecamatan->id'>$kecamatan->name</option>";
        }
    }

    public function getdesa(Request $request)
    {
        $id_kecamatan    = $request->id_kecamatan;
        $desa            = Village::where('district_id', $id_kecamatan)->orderBy('name', 'ASC')->get();
        echo "<option value=''>Pilih Desa...</option>";
        foreach ($desa as $desa) {
            echo "<option value='$desa->id'>$desa->name</option>";
        }
    }

    public function vendor_index(Request $request)
    {
        return Datatables::of(User::query()->where('status_user', '!=', '2')->orderBy('created_at', 'desc')->get())
            // return Datatables::of(User::query()->orderBy('created_at', 'desc')->get())
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
                return '<a style="margin:2px;" href="' . route('sourching.vendor_detail', ['id' => $list->id]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Detail Vendor" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
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
                <a href="' . route('sourching.vendor_print_form') . '/' . $buatmanage->id . '" style="margin:2px;" data-id="' . $buatmanage->id . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Print Form" onclick="return true" class="toyakin btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-print"></i>
                </a>
                <button id="btn_delete" style="margin:2px;" data-id="' . $buatmanage->id . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Ubah status" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="fa fa-trash"></i>
                </button>';
            })
            ->rawColumns(['nama_vendor', 'created_at', 'email', 'status_email', 'password_show', 'npwp', 'kt', 'nomer_hp', 'detail', 'status_user', 'ckelola'])
            ->make(true);
    }

    public function output_data()
    {
        return view('dashboard.superadmin.outputdata.outputdata');
    }

    public function output_data_index()
    {
        return view('dashboard.superadmin.outputdata.outputdata');
    }

    public function vendor_destroy($id)
    {
        $user = User::find($id);
        $user->status_user = '2';
        $user->update();
        return redirect()->back();
    }

    public function vendor_status($id)
    {
        $data = User::where('id', $id)->first();
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
            $bank_code = 'BB00700';
            $bank_name = 'PT BANK CENTRAL ASIA Tbk';
        }
        if ($data->status_user == 1) {
            $data = User::where('id', $id)->first();
            User::where('id', $id)->update(['status_user' => 0]);
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
                'termscode'         => 'PT01',
                'bankacctnumber'    => $data->nomer_rekening,
                'bankAccountID'     => 'BA101',
                'BankName'          => $bank_name,
                'bankbranchcode'    => $bank_code,
                'SPS_niksupplier_c' => $data->ktp,
            ];
            $response = $client->post($url, ['form_params' => $form_params]);
            $response = $response->getBody()->getContents();
            Alert::success('Berhasil', 'Data Vendor Tidak Aktif');
            return redirect()->back()->with('Berhasil', 'Data Vendor Tidak Aktif');
        } else {
            $data = User::where('id', $id)->first();
            User::where('id', $id)->update(['status_user' => 1]);
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
                'termscode'         => 'PT01',
                'bankacctnumber'    => $data->nomer_rekening,
                'bankAccountID'     => 'BA101',
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
        $data = User::where('id', $id)->first();
        return view('dashboard.superadmin.vendor.dt_detailvendor', ['data' => $data]);
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
        $vendor->password_show      = \Hash::make($request->password);
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
        $data_users = User::where('id', $request->npwp_id_vendor)->first();
        // dd($data_users);
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
            'termscode'         => 'PT01',
            'bankAccountID'     => 'BA101',
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
        $data_users = User::where('id', $request->ktp_id_vendor)->first();
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
            'termscode'         => 'PT01',
            'bankAccountID'     => 'BA101',
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
            $bank_code = 'BB00700';
            $bank_name = 'PT BANK CENTRAL ASIA Tbk';
        }
        $data_users = User::where('id', $request->pembayaran_id_vendor)->first();
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
            'termscode'         => 'PT01',
            'bankAccountID'     => 'BA101',
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
        $data_users = User::where('id', $request->profil_id_vendor)->first();
        // dd($data);
        if ($request->file_pakta == null && $request->file_fis == null) {
            // dd('a');
            $data = User::where('id', $request->profil_id_vendor)->first();
            $data->vendorid          = $request->vendor_id;
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
            $data->termscode            = 'PT01';
            $data->taxregioncode        = 'TX54';
            $data->bankaccount_id       = 'BA101';
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
            $data->vendorid          = $request->vendor_id;
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
            $data->termscode         = 'PT01';
            $data->taxregioncode         = 'TX54';
            $data->bankaccount_id         = 'BA101';
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
            $data->vendorid          = $request->vendor_id;
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
            $data->termscode         = 'PT01';
            $data->taxregioncode         = 'TX54';
            $data->bankaccount_id         = 'BA101';
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

            $data                       = User::where('id', $request->profil_id_vendor)->first();
            $data->vendorid             = $request->vendor_id;
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
            $data->termscode            = 'PT01';
            $data->taxregioncode        = 'TX54';
            $data->bankaccount_id       = 'BA101';
            $data->update();
        }
        // Integrasi Epicor
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/Vendor/UpdateVendor';
        $form_params = [
            'name'              => $request->nama_vendor,
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
            'termscode'         => 'PT01',
            'bankAccountID'     => 'BA101',
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


    public function account()
    {
        $id = Auth::user()->id;
        $data = superadmin::where('id', $id)->first();
        return view('dashboard.superadmin.dt_account', ['data' => $data]);
    }

    public function account_update(Request $request)
    {
        //dd($request->all());
        $data = superadmin::where('id', $request->id)->first();
        $data->name = $request->name_superadmin;
        $data->username = $request->username_superadmin;
        $data->email = $request->email_superadmin;
        $data->password_show = $request->password;
        $data->password = Hash::make($request['password']);
        $data->perusahaan = $request->company_superadmin;
        $data->updated_at = $request->updated_at;
        $data->update();
        return response()->json($data);
    }

    public function news()
    {
        return view('dashboard.superadmin.berita.dt_news');
    }

    public function populer()
    {
        return view('dashboard.superadmin.populer.dt_populer');
    }

    public function invoice()
    {
        return view('dashboard.superadmin.transaksi.invoice');
    }

    public function generateInvoicePDF()
    {
        $pdf = PDF::loadView('dashboard.superadmin.transaksi.dt_detailtransaksi');

        return $pdf->download('nicesnippets1.pdf');
    }

    public function vendor_export_excel()
    {
        return Excel::download(new UsersExport(), 'DATA VENDOR.xlsx');
    }

    public function vendor_print_form($id)
    {
        $data = User::where('users.id', $id)->get();
        $users = ['users' => $data];
        // dd($users);
        $pdf = PDF::loadView('dashboard.superadmin.vendor.cetak_form_vendor', $users);
        // $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('DATA FORM VENDOR.pdf');
        // return PDF::download(new UsersExport(), 'DATA VENDOR.pdf')->setPaper('a4', 'landscape');
    }
    public function vendor_export_pdf()
    {
        $data = User::get();
        $users = ['users' => $data];
        $pdf = PDF::loadView('dashboard.superadmin.vendor.cetak_vendor', $users);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('DATA VENDOR.pdf');
        // return PDF::download(new UsersExport(), 'DATA VENDOR.pdf')->setPaper('a4', 'landscape');
    }

    public function vendor_print()
    {
        $users = User::get();
        return view('dashboard.superadmin.vendor.print_vendor', compact('users'));
    }

    public function vendor_export_csv()
    {
        return Excel::download(new UsersExport(), 'DATA VENDOR.csv');
    }

    public function broadcast()
    {

        return view('dashboard.superadmin.broadcast.dt_broadcast');
    }

    public function data_purchasing()
    {
        return view('dashboard.superadmin.purchasing.dt_purchasing');
    }

    public function purchasing_index()
    {
        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
            ->where('data_po.status_bid', 10)
            ->orderBy('penerimaan_po.id_penerimaan_po', 'DESC')
            ->get())
            ->addColumn('nama_vendor', function ($list) {
                $result = $list->nama_vendor;
                return $result;
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = $list->tanggal_po;
                return $result;
            })
            ->addColumn('kode_po', function ($list) {
                $result = $list->kode_po;
                return $result;
            })
            ->addColumn('status', function ($list) {
                if ($list->status_penerimaan == 10) {
                    return '<a style="margin:2px;" href="' . route('sourching.vendor_status', ['id' => $list->id]) . '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="far fa-handshake"> DEAL</i> <br> (Payment Process)
                </a>';
                }
            })
            ->rawColumns(['nama_vendor', 'tanggal_po', 'kode_po', 'status'])
            ->make(true);
    }

    public function list_bid_po($id)
    {
        $get_users = DataPO::join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.bid_user_id', $id)
            ->first();
        //dd($get_users->id);

        $waktu_pengajuan = DataPO::join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.bid_user_id', $id)
            ->where('data_po.status_bid', '>=', 1)
            ->orderBy('data_po.id_data_po', 'DESC')
            ->first();
        //dd($waktu_pengajuan->user_id);

        $partisipasi = ApproveBid::join('bid_user', 'bid_user.id_biduser', '=', 'approve_bid.bid_user_id')
            ->join('bid', 'bid.id_bid', '=', 'approve_bid.bid_id')
            ->join('users', 'users.id', '=', 'approve_bid.user_idbid')
            ->where('bid_user.user_id', $get_users->id)
            ->sum('bid_user.jumlah_kirim');
        // dd($partisipasi);

        $ditolak1 = ApproveBid::join('bid_user', 'bid_user.id_biduser', '=', 'approve_bid.bid_user_id')
            ->join('bid', 'bid.id_bid', '=', 'approve_bid.bid_id')
            ->join('users', 'users.id', '=', 'approve_bid.user_idbid')
            ->where('bid_user.user_id', $waktu_pengajuan->user_id)
            ->sum('approve_bid.permintaan_ditolak');
        // ->get();
        $ditolak2 = ApproveBid::join('bid_user', 'bid_user.id_biduser', '=', 'approve_bid.bid_user_id')
            ->join('bid', 'bid.id_bid', '=', 'approve_bid.bid_id')
            ->join('users', 'users.id', '=', 'approve_bid.user_idbid')
            ->join('data_po', 'data_po.id_approvebid', '=', 'approve_bid.id_approvebid')
            ->where('bid_user.user_id', $waktu_pengajuan->user_id)
            ->where('data_po.status_bid', 5)
            ->sum('data_po.permintaan_ditolak');
        $ditolak = $ditolak1 + $ditolak2;

        // $po_perhari = DataPO::('users','users.id','=','data_po.user_idbid')
        // ->where('data_po.status_bid','>=', 1)
        // ->where('data_po.bid_id', $get_users->bid_id)
        // ->count();

        $diproses = DataPO::join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.user_idbid', $waktu_pengajuan->user_id)
            ->where('data_po.status_bid', '>=', 1)
            ->Where('data_po.status_bid', '!=', 5)
            ->Where('data_po.status_bid', '!=', 13)
            ->count();

        $data_diproses = DataPO::join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('bid_user.id_biduser', $id)
            ->where('data_po.status_bid', '>=', 1)
            ->where('data_po.bid_user_id', $id)
            ->get();
        // dd($data_diproses);

        $diterima = DataPO::join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.status_bid', 13)
            ->where('bid_user.user_id', $waktu_pengajuan->user_id)
            ->count();

        $riwayat_po = DataPO::join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->where('data_po.bid_user_id', $id)
            ->orderBy('data_po.id_data_po', 'DESC')
            ->get();

        $riwayat_po = DataPO::join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->where('data_po.user_idbid', $waktu_pengajuan->user_id)
            ->where('data_po.status_bid', '>=', 1)
            ->Where('data_po.status_bid', '!=', 5)
            ->get();
        return view('dashboard.superadmin.bid.list_po_bid', ['waktu_pengajuan' => $waktu_pengajuan, 'riwayat_po' => $riwayat_po, 'partisipasi' => $partisipasi, 'ditolak' => $ditolak, 'diterima' => $diterima, 'diproses' => $diproses, 'data_diproses' => $data_diproses]);
    }

    public function list_po_diterima()
    {
        return view('dashboard.superadmin.data_sourching.data_list_po');
    }

    // public function list_data_po($id)
    // {
    //     dd($id);
    // }

    public function list_data_po_diterima_index()
    {

        return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        return view('dashboard.superadmin.data_sourching.data_sourching_onprocess');
    }

    public function data_sourching_onprocess_gb_ciherang_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y ');
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
                    ->rawColumns(['name_bid', 'nama_vendor', 'tanggal_po', 'tanggal_bongkar', 'tanggal_bongkar', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y ');
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
                    ->rawColumns(['name_bid', 'nama_vendor', 'tanggal_po', 'tanggal_bongkar', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_onprocess_gb_longgrain_index(Request $request)
    {
        // $data = DataPO::
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y ');
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
                    ->rawColumns(['name_bid', 'nama_vendor', 'tanggal_po', 'tanggal_bongkar', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y ');
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
                    ->rawColumns(['name_bid', 'nama_vendor', 'tanggal_po', 'tanggal_bongkar', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_onprocess_gb_pandan_wangi_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                    ->addColumn('tanggal_po', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_po)->isoFormat('DD-MM-Y ');
                        return $result;
                    })
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y ');
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
                    ->rawColumns(['name_bid', 'nama_vendor', 'tanggal_po', 'tanggal_bongkar', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y ');
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
                    ->rawColumns(['name_bid', 'nama_vendor', 'tanggal_po', 'tanggal_bongkar', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_onprocess_gb_ketan_putih_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y ');
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
                    ->rawColumns(['name_bid', 'nama_vendor', 'tanggal_po', 'tanggal_bongkar', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            } else {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                    ->addColumn('tanggal_bongkar', function ($list) {
                        $result = \Carbon\Carbon::parse($list->tanggal_bongkar)->isoFormat('DD-MM-Y ');
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
                    ->rawColumns(['name_bid', 'nama_vendor', 'tanggal_po', 'tanggal_bongkar', 'date_bid', 'kode_po', 'plat_kendaraan', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'surveyor', 'keterangan', 'waktu', 'tempat', 'z_yang_dibawa', 'z_yang_ditolak'])
                    ->make(true);
            }
        }
    }
    public function data_sourching_onprocess_pk_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
    public function save_token(Request $request)
    {

        Auth::user()->firebase_token =  $request->token;

        Auth::user()->save();

        return response()->json(['Token successfully stored.']);
    }
    public function status_deal_gb($id)
    {
        // dd($id);
        $data = PenerimaanPO::join('data_po', 'data_po.id_data_po', '=', 'penerimaan_po.penerimaan_id_data_po')
            ->join('users', 'data_po.user_idbid', '=', 'users.id')
            ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'penerimaan_po.penerimaan_kode_po')
            ->where('penerimaan_po.id_penerimaan_po', '=', $id)->first();
        // dd($data);
        $log                                    = new LogAktivitySourching();
        $log->name_user                         = Auth::guard('sourching')->user()->name;
        $log->id_objek_aktivitas_sourching      = $data->id_penerimaan_po;
        $log->aktivitas_sourching               = 'Status Deal Kode PO : ' . $data->penerimaan_kode_po . ' Harga Akhir: ' . rupiah($data->harga_akhir_gb) . ' Reaksi Harga : ' . rupiah($data->reaksi_harga_gb);
        $log->keterangan_aktivitas              = 'Selesai';
        $log->created_at                        = date('Y-m-d H:i:s');
        $log->save();

        $po = trackerPO::where('kode_po_tracker', $data->penerimaan_kode_po)->first();
        if ($po == NULL) {

            $insert_tracker = new trackerPO();
            $insert_tracker->nama_supplier_tracker  = $data->user_idbid;
            $insert_tracker->tanggal_po_tracker     = $data->tanggal_po;
            $insert_tracker->id_penerimaan_tracker  = $data->id_penerimaan_po;
            $insert_tracker->id_data_po_tracker     = $data->id_data_po;
            $insert_tracker->nama_admin_tracker     =  Auth::guard('sourching')->user()->name;
            $insert_tracker->proses_tracker         = 'STATUS DEAL PO';
            $insert_tracker->deal_sourching_tracker  = date('Y-m-d H:i:s');
            $insert_tracker->save();
        } else {

            $po->nama_admin_tracker  = Auth::guard('sourching')->user()->name;
            $po->deal_sourching_tracker  = date('Y-m-d H:i:s');
            $po->nego_sourching_tracker  = NULL;
            $po->proses_nego_spvqc_tracker  = NULL;
            $po->proses_tracker  = 'STATUS DEAL PO';
            $po->update();
        }

        //tambah notifikasi
        $notif                  = new NotifAp();
        $notif->judul           = "Verifikasi PO";
        $notif->keterangan      = "Ada PO yang Diverifikasi, Kode PO : " . $data->penerimaan_kode_po;
        $notif->status          = 0;
        $notif->id_objek        = $id;
        $notif->notifbaru       = 0;
        $notif->kategori        = 0;
        $notif->created_at      = date('Y-m-d H:i:s');
        $notif->save();
        $get_bin_num = DataQcBongkar::where('kode_po_bongkar', $data->penerimaan_kode_po)->first();
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
        $data_LAB2 = Lab2GabahBasah::where('lab2_kode_po_gb', $data->penerimaan_kode_po)->update(['aksi_harga_gb' => 'DEAL']);
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
                'target' => $data->nomer_hp,
                'message' =>
                "PEMBERITAHUAN!

Hallo *$data->name*


*PT SURYA PANGAN SEMESTA NGAWI* Ingin menyampaikan informasi bahwa PO Tanggal : *" . Carbon::parse($data->tanggal_po)->format('d-m-Y') . "* 
  Kode PO         : *" . $data->penerimaan_kode_po . "*
  Nopol             : *" . $data->nopol . "*
  Tonase            : *" . tonase($data->hasil_akhir_tonase) . "*
  Harga             : *" . rupiah($get_harga) . "*
  Keterangan    : _*HARGA DEAL*_ (Sudah Potong Kuli Bongkar)   

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
        //     $bin_num = 'BNNGWDUA03';
        // } else if ($get_bin_num->tempat_bongkar == 'SELATAN') {
        //     $bin_num = 'BNNGWDUA02';
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
            'WarehouseCode' => 'WHNGWDUA',
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
    public function download_data_pesanan_pemebelian_aol(Request $request)
    {
        // $from_date  = $request->from_date;
        // $to_date  = $request->to_date;
        $id_bid  = $request->id_bid;
        // dd($id_bid);
        return Excel::download(new DataPesananPembelianAOL($id_bid), 'DATA PESANAN PEMBELIAN AOL NGAWI.xlsx');
    }
    public function coba_download(Request $request)
    {
        $data = $request->all();
        dd($data);
    }
    public function download_data_sourching_deal_pk_excel(Request $request)
    {
        $from_date  = $request->from_date;
        $to_date  = $request->to_date;
        return Excel::download(new DataSouchingDealPKExcel($from_date, $to_date), 'DATA SOURCHING DEAL PK.xlsx');
    }
    public function status_nego_gb($id)
    {
        // dd('aa');
        // return redirect()->back();
        $data = DB::table('penerimaan_po')->where('id_penerimaan_po', $id)->first();

        $data_lab2 = Lab2GabahBasah::where('lab2_kode_po_gb', $data->penerimaan_kode_po)->first();
        $data_lab2->aksi_harga_gb = 'NEGO';
        $data_lab2->update();

        $log                                    = new LogAktivitySourching();
        $log->name_user                         = Auth::guard('sourching')->user()->name;
        $log->id_objek_aktivitas_sourching      = $data->id_penerimaan_po;
        $log->aktivitas_sourching               = 'Status Nego Kode PO:' . $data->penerimaan_kode_po . ' Harga Akhir: ' . rupiah($data_lab2->harga_akhir_gb) . ' Reaksi Harga : ' . rupiah($data_lab2->reaksi_harga_gb);
        $log->keterangan_aktivitas              = 'Selesai';
        $log->created_at                        = date('Y-m-d H:i:s');
        $log->save();

        $po = trackerPO::where('kode_po_tracker', $data->penerimaan_kode_po)->first();
        if ($po == NULL) {
        } else {
            $po->nama_admin_tracker  = Auth::guard('sourching')->user()->name;
            $po->nego_sourching_tracker  = date('Y-m-d H:i:s');
            $po->deal_sourching_tracker  = NULL;
            $po->proses_tracker  = 'STATUS NEGO PO';
            $po->update();
        }
    }
    public function status_nego_pk($id)
    {
        $data = DB::table('penerimaan_po')->where('id_penerimaan_po', $id)->first();
        $data_LAB2 = DB::table('lab1_pk')->where('lab1_kode_po_pk', $data->penerimaan_kode_po)->update(['aksi_harga_pk' => 'NEGO']);
        // return redirect()->back();
    }

    public function data_sourching_deal()
    {
        return view('dashboard.superadmin.data_sourching.data_sourching_deal');
    }

    public function data_sourching_deal_gb_ciherang_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
                            // '<a href="' . route('sourching.kirim_harga') . '" data-no="'.'"></a>';
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

    public function data_sourching_nego()
    {
        return view('dashboard.superadmin.data_sourching.data_sourching_nego');
    }


    public function data_sourching_nego_gb_longgrain_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        return view('dashboard.superadmin.data_sourching.data_sourching_output_nego');
    }

    public function data_sourching_output_nego_gb_index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
							<button id="btn_nego_gb"  class="dropdown-item" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-hand-holding-usd"></i> NEGO</button>
						</div>
					</div>';
                    })
                    ->rawColumns(['name_bid', 'nama_vendor', 'date', 'date_bid', 'kode_po', 'plat_kendaraan', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'harga_awal', 'aksi_harga', 'harga_akhir', 'reaksi_harga'])
                    ->make(true);
            } else {

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
							<button id="btn_nego_gb"  class="dropdown-item" data-id="' . $list->id_penerimaan_po . '"><i class="fa fa-hand-holding-usd"></i> NEGO</button>
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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

                return Datatables::of(DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
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
        return view('dashboard.superadmin.tagihan.tagihan');
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
                    'broadcaster' =>  Auth::guard('sourching')->user()->name,
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
                    'broadcaster' =>  Auth::guard('sourching')->user()->name,
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
                'broadcaster' =>  Auth::guard('sourching')->user()->name,
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
        // dd(DataPO::join('users', 'users.id', 'data_po.user_idbid')
        //     ->where('data_po.status_bid', '!=', '5')
        //     ->groupBy('data_po.user_idbid')
        //     ->get());
        // dd($previousmonth);
        return Datatables::of(DataPO::join('users', 'users.id', 'data_po.user_idbid')
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
        // dd(ApproveBid::
        //     ->join('users', 'users.id', 'data_po.user_idbid')
        //     ->where('data_po.status_bid', '!=', '5')
        //     ->groupBy('data_po.user_idbid')
        //     ->get());
        return Datatables::of(ApproveBid::join('users', 'users.id', 'data_po.user_idbid')
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

    public function getcount_bid()
    {
        $getcount_bid_gb = Bid::query()
            ->where('name_bid', 'LIKE', '%GABAH BASAH%')
            ->where('bid_status', '1')
            ->orderBy("id_bid", 'desc')
            ->count();
        $getcount_bid_pk = Bid::query()
            ->where('name_bid', 'LIKE', '%PECAH KULIT%')
            ->where('bid_status', '1')
            ->orderBy("id_bid", 'desc')
            ->count();
        $getcount_bid_ds = Bid::query()
            ->where('name_bid', 'LIKE', '%BERAS DS%')
            ->where('bid_status', '1')
            ->orderBy("id_bid", 'desc')
            ->count();
        $result = ['getcount_bid_gb' => $getcount_bid_gb, 'getcount_bid_pk' => $getcount_bid_pk, 'getcount_bid_ds' => $getcount_bid_ds];
        return response()->json($result);
    }
    public function getcount_bid_gb()
    {
        $query = Bid::query()
            ->where('name_bid', 'LIKE', '%GABAH BASAH%')
            ->where('bid_status', '1')
            ->orderBy("id_bid", 'desc')
            ->count();
        return response()->json($query);
    }
    public function getcount_bid_pk()
    {
        $query = Bid::query()
            ->where('name_bid', 'LIKE', '%PECAH KULIT%')
            ->where('bid_status', '1')
            ->orderBy("id_bid", 'desc')
            ->count();
        return response()->json($query);
    }
    public function getcount_bid_ds()
    {
        $query = Bid::query()
            ->where('name_bid', 'LIKE', '%BERAS DS%')
            ->where('bid_status', '1')
            ->orderBy("id_bid", 'desc')
            ->count();
        return response()->json($query);
    }

    public function sendNotification(Request $request)
    {
        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = 'AAAANJw774I:APA91bFeEPLYZcDOblkV9kalZr2BJXzdHXfvi0H2XyyqriTcWh5g8HluLCd2p7vALs_Cp16uLxTtGBiTEjuuzHYUVHe7JwJ5Ku65u2qeo4xJsWGn001Nc8h7cVMO6oYPb5yiELdh1fYk';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
                "content_available" => true,
                "priority" => "high",
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        dd($response);
    }
    public function get_notifikasisourching()
    {
        $data = NotifSourching::where('status', 0)->take(10)->orderBy('id_notif', 'DESC')->get();
        return json_encode($data);
    }
    public function get_notif_sourching_all()
    {
        return view('dashboard.superadmin.notifikasi.notifikasi');
    }
    public function get_notif_sourching_all_index()
    {
        return Datatables::of(NotifSourching::where('status', 0)->orderBy('id_notif', 'DESC')->get())
            ->addColumn('keterangan', function ($list) {
                $result = $list->keterangan;
                return $result;
            })
            ->addColumn('created_at', function ($list) {
                $result_date = \Carbon\Carbon::parse($list->created_at)->isoFormat('DD-MM-Y');
                $result_time = \Carbon\Carbon::parse($list->created_at)->isoFormat('H:m:s ');
                $result = $result_date . '<br><span class="btn btn-sm btn-label-primary">' . $result_time . ' WIB</span>';
                return $result;
            })->rawColumns(['keterangan', 'created_at'])
            ->make(true);
    }
    public function get_countnotifikasisourching()
    {
        $data = NotifSourching::where('status', 0)->count();
        return json_encode($data);
    }

    public function set_notifikasisourching(request $request)
    {
        $id                 = $request->id;
        $data               = NotifSourching::where('id_notif', $id)->first();
        $data->status       = '1';
        $data->update();
        if ($data->kategori == 0) {
            return redirect()->route('sourching.bid_response', $data->id_objek);
        } elseif ($data->kategori == 1) {
            return redirect()->route('sourching.data_sourching_onprocess');
        }
    }

    public function new_notifikasisourching()
    {
        $data = NotifSourching::where('notifbaru', 0)->first();
        if ($data == '' || $data == NULL) {
            return 'kosong';
        } else {

            $title = $data->judul;
            $keterangan = $data->keterangan;
            NotifSourching::where('notifbaru', 0)->update(['notifbaru' => 1]);
            $result = ['data' => $data, 'title' => $title, 'keterangan' => $keterangan];
            return response()->json($result);
        }
    }
}
