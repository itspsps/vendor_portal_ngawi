<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Bid;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use DataTables;
use App\Models\BidUser;
use App\Models\DataPO;
use DateTime;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Lab1GabahBasah;
use App\Models\LogAktivitySourching;
use App\Models\LogAktivityUser;
use App\Models\NotifSourching;
use App\Models\PenerimaanPO;
use App\Models\trackerPO;
use App\Models\Village;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\UserVerify;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    public function getViewLogin()
    {
        return view('dashboard.user.login');
    }
    function get_maintenance()
    {
        return view('maintenance');
    }
    function video_panduan()
    {
        return view('dashboard.user.video_panduan');
    }
    function buku_panduan()
    {
        return view('dashboard.user.buku_panduan');
    }

    function create(Request $request)
    {
        // dd($request->all());
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
            // $url = 'https://sumberpangan.store/api/postman';
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
                'termscode'         => 'PT01',
                'bankacctnumber'    => $request->nomer_rekening,
                'bankbranchcode'    => $bank_code,
                'sps_niksupplier_c' => $request->ktp,
                'bankAccountID' => 'BA101',
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
            if ($query) {

                $token = Str::random(64);
                UserVerify::create([
                    'user_id' => $query->id,
                    'token' => $token
                ]);

                Mail::send('dashboard.user.emailVerificationEmail', ['token' => $token], function ($message) use ($request) {
                    $message->to($request->email, $request->nama_vendor);
                    $message->subject('Email Verification Mail');
                });
                return redirect()->route('user.login')->with('success', 'Mohon cek email Anda sekarang dan lakukan verifikasi ');
                // return redirect()->route('user.login')->with('success', 'Mohon ditunggu dalam  waktu 1x24 jam untuk mendapat konfirmasi');
            } else {
                return redirect()->back()->with('fail', 'Data yang anda masukan salah');
            }
        } else {
            return redirect()->back()->with('fail', 'Data email, Username, npwp, dan ktp anda masukan sudah ada');
        }
    }
    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }
        Alert::success(' Selamat ', ' Silahkan Tunggu Validasi Dari Admin 1x24 Jam');
        return redirect()->route('user.login')->with('Selamat', $message);
    }
    public function formregister()
    {
        return view('dashboard.user.register');
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
    public function get_nik($id)
    {
        $get_nik = DB::table('users')->where('ktp', $id)->count();
        return json_encode($get_nik);
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
    public function getcount_notifikasi(Request $request)
    {

        $date = date('Y-m-d');
        $id = Auth::user()->id;
        $getcount_transaksi    = DataPO::leftjoin('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->leftjoin('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->leftjoin('bid_user', 'data_po.bid_user_id', '=', 'bid_user.id_biduser')
            ->leftjoin('users', 'users.id', '=', 'data_po.user_idbid')
            ->leftjoin('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('data_po.tanggal_po', '>=', $date)
            ->where('data_po.user_idbid', $id)
            ->orderBy('data_po.id_data_po', 'DESC')
            ->count();
        $getcount_broadcast = DB::table('broadcast')
            ->count();
        $getcount_pajak = DB::table('potong_pajak')
            ->where('id_user_potong_pajak', Auth::user()->id)
            ->where('status_potong_pajak', '1')
            ->count();
        $notif_lelang = Bid::where('lokasi', 'NGAWI')->where('bid_status', '1')->orderBy('date_bid', 'DESC')
            ->count();
        $result = ['getcount_transaksi' => $getcount_transaksi, 'getcount_broadcast' => $getcount_broadcast, 'getcount_pajak' => $getcount_pajak, 'notif_lelang' => $notif_lelang];
        return response()->json($result);
    }
    public function getcount_transaksi(Request $request)
    {
        $date = date('Y-m-d');
        $id = Auth::user()->id;
        $data    = DataPO::leftjoin('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->leftjoin('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->leftjoin('bid_user', 'data_po.bid_user_id', '=', 'bid_user.id_biduser')
            ->leftjoin('users', 'users.id', '=', 'data_po.user_idbid')
            ->leftjoin('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->where('data_po.tanggal_po', '>=', $date)
            ->where('data_po.user_idbid', $id)
            ->orderBy('data_po.id_data_po', 'DESC')
            ->count();

        return json_encode($data);
    }
    public function getcount_notif()
    {
        $data = DB::table('broadcast')
            ->count();

        return json_encode($data);
    }
    public function getcount_pajak()
    {
        $data = DB::table('potong_pajak')
            ->where('id_user_potong_pajak', Auth::user()->id)
            ->where('status_potong_pajak', '1')
            ->count();

        return json_encode($data);
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

    public function check(Request $request)
    {
        // dd($request->username);
        if (is_numeric($request->username)) {
            if (Auth::guard('web')->attempt(array('nomer_hp' => $request->username, 'password' => $request->password))) {
                // dd(auth()->user()->status_user);
                // if (Auth::guard('web')->attempt($creds)) {
                if (auth()->user()->is_email_verified == '1' && auth()->user()->status_user == '1') {
                    Alert::success('Berhasil', 'Selamat Datang ' . auth()->user()->nama_vendor);
                    return redirect()->route('user.home')->with('Berhasil', 'Selamat Datang ' . auth()->user()->nama_vendor);
                } else if (auth()->user()->is_email_verified == '0' && auth()->user()->status_user == '0') {
                    Auth::logout();
                    Alert::warning('Cek Email Sekarang', 'Mohon Cek Email Anda Sekarang Dan Lakukan Verifikasi');
                    return redirect()->route('user.login')->with('Cek Email Sekarang', 'Mohon Cek Email Anda Sekarang Dan Lakukan Verifikasi');
                } else if (auth()->user()->status_user == '0') {
                    Auth::logout();
                    Alert::warning('Mohon Maaf', 'Akun Anda Tidak Aktif');
                    return redirect()->route('user.login')->with('Mohon Maaf', 'Akun Anda Tidak Aktif');
                }
                // else {
                //     Auth::logout();
                //     Alert::warning('Mohon Di Tunggu', 'Akun Anda Dalam Proses Validasi');
                //     return redirect()->route('user.login')->with('Mohon Di Tunggu', 'Akun Anda Dalam Proses Validasi');
                // }
            } else {
                Alert::error('Gagal', 'Mohon Masukkan Email Atau Username Dan Password Dengan Benar');
                return redirect()->route('user.login')->with('Gagal', 'Mohon Masukkan Email Atau Password Dengan Benar');
            }
        } elseif (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            // dd('b');
            if (Auth::guard('web')->attempt(array('email' => $request->username, 'password' => $request->password))) {
                // if (Auth::guard('web')->attempt($creds)) {
                if (auth()->user()->is_email_verified == 1 && auth()->user()->status_user == 1) {
                    Alert::success('Berhasil', 'Selamat Datang ' . auth()->user()->nama_vendor);
                    return redirect()->route('user.home')->with('Berhasil', 'Selamat Datang ' . auth()->user()->nama_vendor);
                } else if (auth()->user()->is_email_verified == 0 && auth()->user()->status_user == 0) {
                    Auth::logout();
                    Alert::warning('Cek Email Sekarang', 'Mohon Cek Email Anda Sekarang Dan Lakukan Verifikasi');
                    return redirect()->route('user.login')->with('Cek Email Sekarang', 'Mohon Cek Email Anda Sekarang Dan Lakukan Verifikasi');
                } else if (auth()->user()->status_user == 0) {
                    Auth::logout();
                    Alert::warning('Mohon Maaf', 'Akun Anda Tidak Aktif');
                    return redirect()->route('user.login')->with('Mohon Maaf', 'Akun Anda Tidak Aktif');
                } else {
                    Auth::logout();
                    Alert::warning('Mohon Di Tunggu', 'Akun Anda Dalam Proses Validasi');
                    return redirect()->route('user.login')->with('Mohon Di Tunggu', 'Akun Anda Dalam Proses Validasi');
                }
            } else {
                Alert::error('Gagal', 'Mohon Masukkan Email Atau Username Dan Password Dengan Benar');
                return redirect()->route('user.login')->with('Gagal', 'Mohon Masukkan Email Atau Password Dengan Benar');
            }
        } else {
            // dd('c');
            if (Auth::guard('web')->attempt(array('username' => $request->username, 'password' => $request->password))) {
                // if (Auth::guard('web')->attempt($creds)) {
                if (auth()->user()->is_email_verified == 1 && auth()->user()->status_user == 1) {
                    Alert::success('Berhasil', 'Selamat Datang ' . auth()->user()->nama_vendor);
                    return redirect()->route('user.home')->with('Berhasil', 'Selamat Datang ' . auth()->user()->nama_vendor);
                } else if (auth()->user()->is_email_verified == 0 && auth()->user()->status_user == 0) {
                    Auth::logout();
                    Alert::warning('Cek Email Sekarang', 'Mohon Cek Email Anda Sekarang Dan Lakukan Verifikasi');
                    return redirect()->route('user.login')->with('Cek Email Sekarang', 'Mohon Cek Email Anda Sekarang Dan Lakukan Verifikasi');
                } else if (auth()->user()->status_user == 0) {
                    Auth::logout();
                    Alert::warning('Mohon Maaf', 'Akun Anda Tidak Aktif');
                    return redirect()->route('user.login')->with('Mohon Maaf', 'Akun Anda Tidak Aktif');
                } else {
                    Auth::logout();
                    Alert::warning('Mohon Di Tunggu', 'Akun Anda Dalam Proses Validasi');
                    return redirect()->route('user.login')->with('Mohon Di Tunggu', 'Akun Anda Dalam Proses Validasi');
                }
            } else {
                Alert::error('Gagal', 'Mohon Masukkan Email Atau Username Dan Password Dengan Benar');
                return redirect()->route('user.login')->with('Gagal', 'Mohon Masukkan Email Atau Password Dengan Benar');
            }
        }
        // dd($fieldType);
        // $creds = $request->only('email', 'password');
    }

    function logout()
    {
        Auth::guard('web')->logout();
        Alert::success('Sukses', 'Anda Berhasil Logout');
        return redirect('/')->with('Sukses', 'Anda Berhasil Logout');
    }


    public function home()
    {
        $date = date('Y-m-d H:i:s');
        $query = DB::table('bid')->where('batas_bid', '<=', $date)->where('bid_status', '1')->orderBy('date_bid', 'DESC')->get();
        foreach ($query as $kediri) {
            $data = DB::table('bid')->where('id_bid', '=', $kediri->id_bid)
                ->update([
                    'bid_status' => '0',
                    'status_edit' => 'EDIT SUPPLIER',
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
        }
        $site_kediri = DB::table('bid')->where('lokasi', 'KEDIRI')->orderBy('date_bid', 'DESC')->get();
        $site_other = DB::table('bid')->where('lokasi', 'NGAWI')
            ->where('name_bid', '!=', 'GABAH BASAH LONG GRAIN')
            ->where('name_bid', '!=', 'GABAH BASAH PANDAN WANGI')
            ->where('name_bid', '!=', 'GABAH BASAH KETAN PUTIH')
            ->orderBy('date_bid', 'DESC')
            ->limit(5)
            ->get();
        $site_ngawi_ciherang = DB::table('bid')->where('lokasi', 'NGAWI')->where('name_bid', 'GABAH BASAH CIHERANG')->orderBy('date_bid', 'DESC')->limit(5)->get();
        $site_ngawi_pandanwangi = DB::table('bid')->where('lokasi', 'NGAWI')->where('name_bid', 'GABAH BASAH PANDAN WANGI')->orderBy('date_bid', 'DESC')->limit(5)->get();
        $site_ngawi_ketanputih = DB::table('bid')->where('lokasi', 'NGAWI')->where('name_bid', 'GABAH BASAH KETAN PUTIH')->orderBy('date_bid', 'DESC')->limit(5)->get();
        $site_ngawi = DB::table('bid')->where('lokasi', 'NGAWI')->where('bid_status', '1')->orderBy('date_bid', 'DESC')->get();
        $lainnya = Bid::orderBy('id_bid', 'desc')->limit(4)->get();
        $berita = news::get();
        $get_site_ngawi_longgrain = DB::table('bid')->where('lokasi', 'NGAWI')->where('name_bid', 'GABAH BASAH LONG GRAIN')->where('bid_status', '1')->orderBy('id_bid', 'ASC')->first();
        if ($get_site_ngawi_longgrain == '') {
            $site_ngawi_longgrain = DB::table('bid')->where('lokasi', 'NGAWI')->where('name_bid', 'GABAH BASAH LONG GRAIN')->where('bid_status', '1')->orderBy('id_bid', 'DESC')->get();
        } else {
            if ($date <= $get_site_ngawi_longgrain->batas_bid) {
                $site_ngawi_longgrain = DB::table('bid')->where('lokasi', 'NGAWI')->where('name_bid', 'GABAH BASAH LONG GRAIN')->where('bid_status', '1')->orderBy('id_bid', 'ASC')->limit(1)->get();
            } else {
                $site_ngawi_longgrain = DB::table('bid')->where('lokasi', 'NGAWI')->where('name_bid', 'GABAH BASAH LONG GRAIN')->where('bid_status', '1')->orderBy('id_bid', 'DESC')->limit(1)->get();
            }
        }
        if (Auth()->user()) {
            $id = Auth::user()->id;
            $count_transaksi = DataPO::leftjoin('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                ->leftjoin('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                ->leftjoin('bid_user', 'data_po.bid_user_id', '=', 'bid_user.id_biduser')
                ->leftjoin('users', 'users.id', '=', 'data_po.user_idbid')
                ->leftjoin('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                ->where('data_po.tanggal_po', '>=', $date)
                ->where('data_po.user_idbid', $id)
                ->orderBy('data_po.id_data_po', 'DESC')
                ->count();
        } else {
            $count_transaksi = '0';
        }
        $notif = DB::table('broadcast')
            ->count();
        // dd($notif);
        return view('dashboard.user.home', ['site_kediri' => $site_kediri, 'site_ngawi' => $site_ngawi, 'site_ngawi_longgrain' => $site_ngawi_longgrain, 'site_ngawi_ciherang' => $site_ngawi_ciherang, 'site_ngawi_pandanwangi' => $site_ngawi_pandanwangi, 'site_ngawi_ketanputih' => $site_ngawi_ketanputih, 'site_other' => $site_other, 'lainnya' => $lainnya, 'berita' => $berita, 'notif' => $notif, 'count_transaksi' => $count_transaksi]);
    }
    public function berita()
    {
        $berita = news::get();
        return view('dashboard.user.berita.dt_berita', compact('berita'));
    }
    public function about_us()
    {
        return view('dashboard.user.about_us');
    }
    function update_home()
    {
        $datenow = date('Y-m-d H:i:s');
        // dd($datenow);
        $data = DB::table('bid')->where('batas_bid', '<=', Carbon::now()->format('Y-m-d'))->where('status_bid', 1)->get();
        dd($data);
        foreach ($data as $data) {
            if ($data->status_bid == 1) {
                DB::table('bid')->update(['status_bid' => 0]);
                return redirect()->back();
            } else {
                DB::table('bid')->update(['status_bid' => 0]);
                return redirect()->back();
            }
        }
    }

    public function lelang_show($id)
    {
        $data = DB::table('bid')->where('id_bid', $id)->first();
        return json_encode($data);
    }

    public function lelang_detail($id)
    {
        if (Auth()->user()) {
            $data = DB::table('bid')->where('id_bid', $id)->first();
            $user_bid = DB::table('bid_user')->join('users', 'users.id', 'bid_user.id_biduser')->get();
            $bid_user = DB::table('bid_user')->where('user_id', Auth()->user()->id)->where('bid_id', $id)->first();
            $partisipasi_bid = DB::table('bid_user')->join('users', 'users.id', '=', 'bid_user.user_id')->where('bid_id', $id)->get();
            $get_kuota = DB::table('bid')
                ->where('id_bid', $id)
                ->first();
            $cek_jumlahpengajuan =
                DB::table('approve_bid')
                ->join('bid_user', 'bid_user.id_biduser', '=', 'approve_bid.bid_user_id')
                ->join('bid', 'bid.id_bid', '=', 'approve_bid.bid_id')
                ->where('approve_bid.bid_id', $id)
                ->where('bid_user.status_biduser', 1)
                ->sum('approve_bid.permintaan_kirim');
            $jumlah_kuota = ($get_kuota->jumlah + $get_kuota->add_kuota);
            $jumlah_kuotatruk = ($jumlah_kuota) / 8000;
            $get_sisakuota = $jumlah_kuota - ($cek_jumlahpengajuan * 8000);
            $sisakuota = ($get_sisakuota / 8000);
            return view('dashboard.user.bid.dt_detailbid', ['data' => $data, 'bid_user' => $bid_user, 'partisipasi_bid' => $partisipasi_bid, 'jumlah_kuota' => $jumlah_kuota, 'jumlah_kuotatruk' => $jumlah_kuotatruk, 'sisakuota' => $sisakuota, 'get_sisakuota' => $get_sisakuota]);
        } else {
            return view('dashboard.user.login');
        }
    }

    public function lelang_storeuser(Request $request)
    {
        // dd($request->all());
        if (Auth()->user()) {
            $id_user    = Auth()->user()->id;
            $get_data = BidUser::where('user_id', $id_user)
                ->where('bid_id', $request->id_bid)
                ->where('status_biduser', '0')
                ->count();
            // dd($get_data);
            if ($get_data == '0') {
                // dd('a');
                if ($request->file('image_biduser') != NULL) {
                    $image      = $request->file('image_biduser');
                    $request->validate([
                        'image_biduser' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]);
                    $file           = $request->file('image_biduser');
                    $imageName      = time() . '.' . $request->image_biduser->extension();
                    $save           = $file->move('public/img/user/bid/', $imageName);

                    $data                       = new BidUser();
                    $data->user_id              = $id_user;
                    $data->bid_id               = $request->bid_id;
                    $data->site_id              = $request->site_id;
                    $data->price_biduser        = $request->price_biduser;
                    $data->jumlah_kirim         = $request->jumlah_kirim;
                    $data->date_biduser         = Carbon::now()->format('Y-m-d H:i:s');
                    $data->description_biduser  = $request->description_biduser;
                    $data->image_biduser        = $imageName;
                    $data->save();

                    // insert Log Aktivity
                    $log                            = new LogAktivityUser();
                    $log->name_user                 = Auth::guard('web')->user()->name;
                    $log->aktivitas_user            = 'Pengajuan ikut Lelang , Item : ' . $request->name_bid . ' , ' . $request->jumlah_kirim . ' Truk';
                    $log->id_objek_aktivitas_user   = $data->id_biduser;
                    $log->keterangan_aktivitas      = 'Selesai';
                    $log->created_at                = date('Y-m-d H:i:s');
                    $log->save();

                    $notif = new NotifSourching();
                    $notif->judul       = 'Pengajuan PO';
                    $notif->keterangan  = 'Ada Pengajuan PO Tanggal :' . $request->tanggal_po . '  , Supplier : ' . Auth::guard('web')->user()->name . ' , Jumlah : ' . $request->jumlah_kirim . ' Truk';
                    $notif->notifbaru   = '0';
                    $notif->status      = '0';
                    $notif->id_objek    = $request->bid_id;
                    $notif->kategori    = '0';
                    $notif->created_at  = date('Y-m-d H:i:s');
                    $notif->save();

                    Alert::success('Berhasil', 'Anda berhasil Mengikuti Lelang');
                    return redirect()->route('user.home');
                } else {
                    $data                       = new BidUser();
                    $data->user_id              = $id_user;
                    $data->bid_id               = $request->bid_id;
                    $data->site_id              = $request->site_id;
                    $data->price_biduser        = $request->price_biduser;
                    $data->jumlah_kirim         = $request->jumlah_kirim;
                    $data->date_biduser         = Carbon::now()->format('Y-m-d H:i:s');
                    $data->description_biduser  = $request->description_biduser;
                    $data->save();

                    // insert Log Aktivity
                    $log                            = new LogAktivityUser();
                    $log->name_user                 = Auth::guard('web')->user()->name;
                    $log->aktivitas_user            = 'Pengajuan ikut Lelang , Item : ' . $request->name_bid . ' , ' . $request->jumlah_kirim . ' Truk';
                    $log->id_objek_aktivitas_user   = $data->id_biduser;
                    $log->keterangan_aktivitas      = 'Selesai';
                    $log->created_at                = date('Y-m-d H:i:s');
                    $log->save();

                    $notif              = new NotifSourching();
                    $notif->judul       = 'Pengajuan PO';
                    $notif->keterangan  = 'Ada Pengajuan PO Tanggal :' . $request->tanggal_po . ' , Supplier : ' . Auth::guard('web')->user()->name . ' , Jumlah : ' . $request->jumlah_kirim . ' Truk';
                    $notif->notifbaru   = '0';
                    $notif->status      = '0';
                    $notif->id_objek    = $request->bid_id;
                    $notif->kategori    = '0';
                    $notif->created_at  = date('Y-m-d H:i:s');
                    $notif->save();
                    Alert::success('Berhasil', 'Anda berhasil Mengikuti Lelang');
                    return redirect()->route('user.home');
                }
            } elseif ($get_data == '1') {
                // dd('b');
                Alert::error('Gagal', 'Pengajuan Anda Sebelumnya Belum Di Setujui Sourching');
                return redirect()->back()->with('Gagal', 'Pengajuan Anda Sebelumnya Belum Di Setujui Sourching');
            }
        } else {
            Alert::error('Gagal', 'Harap login terlebih dahulu!');
            return redirect()->back()->with('Gagal', 'Harap login terlebih dahulu!');
        }
    }

    public function pangan_pertanian()
    {
        $berita     = DB::table('news')->limit(4)->get();
        $berita_pangan  = DB::table('news')->where('kategori', 'pangan_pertanian')->get();
        return view('dashboard.user.berita.dt_panganpertanian', ['berita' => $berita, 'berita_pangan' => $berita_pangan]);
    }

    public function teknologi_inovasi()
    {
        $berita     = DB::table('news')->limit(4)->get();
        $berita_pangan  = DB::table('news')->where('kategori', 'teknologi_inovasi')->get();
        return view('dashboard.user.berita.dt_teknologiinovasi', ['berita' => $berita, 'berita_pangan' => $berita_pangan]);
    }

    public function ekonomi_perdagangan()
    {
        $berita     = DB::table('news')->limit(4)->get();
        $berita_pangan  = DB::table('news')->where('kategori', 'ekonomi_perdagangan')->get();
        return view('dashboard.user.berita.dt_ekonomiperdagangan', ['berita' => $berita, 'berita_pangan' => $berita_pangan]);
    }

    public function international()
    {
        $berita     = DB::table('news')->limit(4)->get();
        $berita_pangan  = DB::table('news')->where('kategori', 'international')->get();
        return view('dashboard.user.berita.dt_international', ['berita' => $berita, 'berita_pangan' => $berita_pangan]);
    }

    public function search(Request $request)
    {
        // dd($request);
        $cari = $request->cari;
        $search = DB::table('news')
            ->where('judul_berita', 'like', "%" . $cari . "%")
            ->paginate(10);
        $berita = DB::table('news')->get();
        return view('dashboard.user.berita.dt_search', ['search' => $search, 'berita' => $berita]);
    }

    public function populer()
    {
        $populer = DB::table('populer')->first();
        $berita     = DB::table('news')->limit(4)->get();
        return view('dashboard.user.berita.populer.dt_populer', ['populer' => $populer, 'berita' => $berita]);
    }

    public function terbaru()
    {
        $berita     = DB::table('news')->orderBy('id_news', 'DESC')->paginate(3);
        return view('dashboard.user.berita.terbaru.dt_terbaru', ['berita' => $berita]);
    }

    public function detailberita($id)
    {
        $detail_berita     = DB::table('news')->where('id_news', $id)->first();
        $berita     = DB::table('news')->limit(4)->get();
        return view('dashboard.user.berita.dt_detailberita', ['detail_berita' => $detail_berita, 'berita' => $berita]);
    }

    public function transaksi()
    {
        $date = date('Y-m-d');
        if (Auth()->user()) {
            $id = Auth::user()->id;
            $data_pengajuan  = DataPO::leftjoin('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                ->leftjoin('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                ->leftjoin('bid_user', 'data_po.bid_user_id', '=', 'bid_user.id_biduser')
                ->leftjoin('users', 'users.id', '=', 'data_po.user_idbid')
                ->leftjoin('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                ->where('data_po.tanggal_po', '>=', $date)
                ->where('data_po.user_idbid', $id)
                ->orderBy('data_po.id_data_po', 'DESC')
                ->get();
            // dd($data_pengajuan);
            return view('dashboard.user.transaksi.dt_transaction', compact('data_pengajuan'));
        } else {
            return view('dashboard.user.login');
        }
    }
    public function daftar_lelang()
    {
        $date = date('Y-m-d H:i:s');
        $query = DB::table('bid')->where('batas_bid', '<=', $date)->where('bid_status', '1')->orderBy('date_bid', 'DESC')->get();
        foreach ($query as $kediri) {
            $data = DB::table('bid')->where('id_bid', '=', $kediri->id_bid)
                ->update([
                    'bid_status' => '0',
                    'status_edit' => 'EDIT SUPPLIER',
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
        }
        $site_kediri = DB::table('bid')->where('lokasi', 'KEDIRI')->orderBy('date_bid', 'DESC')->get();
        $site_other = DB::table('bid')->where('lokasi', 'NGAWI')
            ->where('name_bid', '!=', 'GABAH BASAH LONG GRAIN')
            ->where('name_bid', '!=', 'GABAH BASAH PANDAN WANGI')
            ->where('name_bid', '!=', 'GABAH BASAH KETAN PUTIH')
            ->where('bid_status', '1')
            ->orderBy('date_bid', 'DESC')
            ->get();
        $get_site_ngawi_ciherang = DB::table('bid')->where('lokasi', 'NGAWI')->where('name_bid', 'GABAH BASAH CIHERANG')->where('bid_status', '1')->orderBy('id_bid', 'ASC')->first();
        if ($get_site_ngawi_ciherang == '') {
            $site_ngawi_ciherang = DB::table('bid')->where('lokasi', 'NGAWI')->where('name_bid', 'GABAH BASAH CIHERANG')->where('bid_status', '1')->orderBy('id_bid', 'ASC')->get();
        } else {
            if ($date <= $get_site_ngawi_ciherang->batas_bid) {
                $site_ngawi_ciherang = DB::table('bid')->where('lokasi', 'NGAWI')->where('name_bid', 'GABAH BASAH CIHERANG')->where('bid_status', '1')->orderBy('id_bid', 'ASC')->limit(1)->get();
            } else {
                $site_ngawi_ciherang = DB::table('bid')->where('lokasi', 'NGAWI')->where('name_bid', 'GABAH BASAH CIHERANG')->where('bid_status', '1')->orderBy('id_bid', 'DESC')->limit(1)->get();
            }
        }
        $get_site_ngawi_longgrain = DB::table('bid')->where('lokasi', 'NGAWI')->where('name_bid', 'GABAH BASAH LONG GRAIN')->where('bid_status', '1')->orderBy('id_bid', 'ASC')->first();
        if ($get_site_ngawi_longgrain == '') {
            $site_ngawi_longgrain = DB::table('bid')->where('lokasi', 'NGAWI')->where('name_bid', 'GABAH BASAH LONG GRAIN')->where('bid_status', '1')->orderBy('id_bid', 'DESC')->get();
        } else {
            if ($date <= $get_site_ngawi_longgrain->batas_bid) {
                $site_ngawi_longgrain = DB::table('bid')->where('lokasi', 'NGAWI')->where('name_bid', 'GABAH BASAH LONG GRAIN')->where('bid_status', '1')->orderBy('id_bid', 'ASC')->limit(1)->get();
            } else {
                $site_ngawi_longgrain = DB::table('bid')->where('lokasi', 'NGAWI')->where('name_bid', 'GABAH BASAH LONG GRAIN')->where('bid_status', '1')->orderBy('id_bid', 'DESC')->limit(1)->get();
            }
        }
        $site_ngawi_pandanwangi = DB::table('bid')->where('lokasi', 'NGAWI')->where('name_bid', 'GABAH BASAH PANDAN WANGI')->where('bid_status', '1')->orderBy('id_bid', 'DESC')->get();
        $site_ngawi_ketanputih = DB::table('bid')->where('lokasi', 'NGAWI')->where('name_bid', 'GABAH BASAH KETAN PUTIH')->where('bid_status', '1')->orderBy('id_bid', 'DESC')->get();
        $site_subang = DB::table('bid')->where('lokasi', 'SUBANG')->orderBy('date_bid', 'DESC')->get();
        $lainnya = Bid::orderBy('id_bid', 'desc')->get();
        $berita = news::get();

        // dd($site_ngawi_longgrain);
        return view('dashboard.user.bid.dt_daftar_lelang', ['site_kediri' => $site_kediri, 'site_subang' => $site_subang, 'site_ngawi_longgrain' => $site_ngawi_longgrain, 'site_ngawi_ciherang' => $site_ngawi_ciherang, 'site_ngawi_pandanwangi' => $site_ngawi_pandanwangi, 'site_ngawi_ketanputih' => $site_ngawi_ketanputih, 'site_other' => $site_other, 'lainnya' => $lainnya, 'berita' => $berita]);
    }
    public function riwayat_transaksi()
    {
        return view('dashboard.user.transaksi.dt_riwayat_transaksi');
    }
    public function transaksi_index(Request $request)
    {
        $id = Auth::user()->id;
        $get_data = DB::table('bid_user')
            ->join('users', 'users.id', '=', 'bid_user.user_id')
            ->join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
            ->leftjoin('approve_bid', 'approve_bid.bid_user_id', '=', 'bid_user.id_biduser')
            ->select('users.*', 'bid.*', 'bid_user.*', 'approve_bid.*')
            ->where('users.id', $id)
            ->orderBy("id_biduser", 'desc')
            ->get();
        // dd($get_data);
        return Datatables::of(DB::table('bid_user')
            ->join('users', 'users.id', '=', 'bid_user.user_id')
            ->join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
            ->leftjoin('approve_bid', 'approve_bid.bid_user_id', '=', 'bid_user.id_biduser')
            ->select('users.*', 'bid.*', 'bid_user.*', 'approve_bid.*')
            ->where('users.id', $id)
            ->orderBy("id_biduser", 'desc')
            ->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('lokasi', function ($list) {
                if ($list->lokasi == 'KEDIRI') {
                    return 'Site Kediri';
                } elseif ($list->lokasi == 'NGAWI') {
                    return 'Site Ngawi';
                } elseif ($list->lokasi == 'SUBANG') {
                    return 'Site Subang';
                }
            })
            ->addColumn('date_bid', function ($list) {
                $result = $list->date_bid;
                return date('Y-m-d', strtotime($result)) . '<br><span class="btn-info">Open Lelang 08:00</span>';
            })
            ->addColumn('waktu_pengajuan', function ($list) {
                $result = $list->date_biduser;
                return date('Y-m-d', strtotime($result)) . '<br><span class="btn-success">' . date('H:i:s', strtotime($result)) . '</span>';
            })
            ->addColumn('tanggal_po', function ($list) {
                $result = $list->open_po;
                return $result;
            })
            ->addColumn('batas_po', function ($list) {
                $result = $list->batas_bid;
                return date('Y-m-d', strtotime($result)) . '<br><span class="btn-warning">Batas 12:00</span>';
            })
            ->addColumn('jumlah_kirim', function ($list) {
                $result = $list->jumlah_kirim . ' Truk';
                return $result;
            })
            ->addColumn('jumlah_disetujui', function ($list) {
                if ($list->permintaan_kirim == '') {
                    return '<span class="btn-info">Dalam Pengajuan</span>';
                }
                return '<a id="btn_list_po" style="margin:2px;" href="' . route('user.data_list_po', ['id' => $list->id_biduser]) . '" name="' . $list->id_approvebid . '" title="Lihat PO" class="lihat_po btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="" style="color:white;"> </i> ' . $list->permintaan_kirim . ' Truk 
                </a>';
            })

            ->addColumn('status_biduser', function ($list) {
                if ($list->status_biduser == 1) {
                    return '<a style="margin:2px;background-color:#04B431" id="btn_disetujui" name="' . $list->user_id . '" data-jumlahkirim="' . $list->jumlah_kirim . '" data-idnyabid="' . $list->id_bid . '" title="Disetujui" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="" style="color:white;"> Disetujui </i>
                </a>';
                } elseif ($list->status_biduser == 5) {
                    return '<a style="margin:2px;background-color:#9c0911" id="btn_ditolak" name="" title="Disetujui" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="" style="color:white;"> Ditolak </i>
                </a>';
                } elseif ($list->status_biduser == 3) {
                    return '<a style="margin:2px;background-color:#04B431" id="btn_disetujui" name="' . $list->user_id . '" data-jumlahkirim="' . $list->jumlah_kirim . '" data-idnyabid="' . $list->id_bid . '" title="Disetujui" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                    <i class="" style="color:white;"> Disetujui </i>
                    </a>';
                } elseif ($list->status_biduser == 4) {
                    return '<a style="margin:2px;background-color:yellow" name="' . $list->id_biduser . '" title="Pengiriman Telat" class="btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="" style="color:black;"> Proses Pengiriman Telat </i>
                </a>';
                } elseif ($list->status_biduser == 0) {
                    return '<a style="margin:2px;background-color:#9F187C" id="btn_pengajuan" title="Proses lelang" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="" style="color:white;"> Pengajuan </i>
                </a>';
                }
            })
            ->rawColumns(['name_bid', 'jumlah_disetujui', 'lokasi', 'date_bid', 'waktu_pengajuan', 'tanggal_po', 'batas_po', 'jumlah_kirim', 'status_biduser'])
            ->make(true);
    }

    public function detail_pengajuan($id)
    {
        $iduser = Auth::user()->id;
        $data = DB::table('approve_bid')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'approve_bid.bid_user_id')
            ->select('approve_bid.*', 'bid_user.*', DB::raw('SUM(approve_bid.permintaan_kirim) AS siap_kirim'), 'approve_bid.bid_id AS idnya_bid')
            ->where('approve_bid.bid_id', $id)
            ->where('approve_bid.user_idbid', $iduser)
            ->first();
        // dd($data);
        return json_encode($data);
    }
    public function lihat_po($id)
    {
        $iduser = Auth::user()->id;
        $data = DataPO::join('approve_bid', 'data_po.id_approvebid', '=', 'approve_bid.id_approvebid')
            ->where('data_po.id_approvebid', $id)
            ->first();
        // dd($data);
        return json_encode($data);
    }

    public function transaksi_detail($id)
    {
        $data = DB::table('transaksi')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'transaksi.id_biduser_id')
            ->join('users', 'users.id', '=', 'transaksi.id_vendor_transaksi')
            ->join('bid', 'id_bid', '=', 'transaksi.id_bid_transaksi')
            ->where('id_biduser_id', $id)->first();
        return view('dashboard.user.transaksi.dt_transaction_detail', ['data' => $data]);
    }

    public function data_list_po($id)
    {
        $data = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->leftjoin('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
            ->leftjoin('bid_user', 'data_po.bid_user_id', '=', 'bid_user.id_biduser')
            ->leftjoin('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
            ->selectRaw('data_po.*,users.nama_vendor,penerimaan_po.*,lab2_gb.aksi_harga_gb,lab2_gb.harga_akhir_gb,bid.name_bid,bid.open_po,bid_user.id_biduser,bid_user.jumlah_kirim')
            ->where('data_po.user_idbid', Auth::user()->id)
            ->where('bid_user.id_biduser', $id)
            ->orderBy('data_po.id_data_po', 'asc')
            ->get();
        // dd($data);
        return view('dashboard.user.transaksi.dt_list_po', ['data' => $data]);
    }

    public function status_pengiriman($id)
    {
        $data = DB::table('gabahincoming_qc')->where('gabahincoming_kode_po', $id)->first();
        return json_encode($data);
    }
    public function status_pending($id)
    {
        $data = DB::table('lab1_gb')->where('lab1_id_data_po_gb', $id)->first();
        // dd($data);
        return json_encode($data);
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
            $log = new LogAktivityUser();
            $log->name_user    = Auth::guard('web')->user()->name;
            $log->id_objek_aktivitas_user  = $data->id_lab1_gb;
            $log->aktivitas_user  = 'Konfirmasi Supplier, setuju bongkar. Kode PO: ' . $data->lab1_kode_po_gb . ' Plan Harga : ' . $data->plan_harga_gb;
            $log->keterangan_aktivitas  = 'Selesai';
            $log->created_at           = date('Y-m-d H:i:s');
            $log->save();

            $po = trackerPO::where('kode_po_tracker', $data->lab1_kode_po_gb)->first();
            $po->nama_admin_tracker  = Auth::guard('web')->user()->name;
            $po->proses_tracker  = 'KONFIRMASI Supplier, PO SETUJU DIBONGKAR';
            $po->konfirmasi_pending_tracker  = date('Y-m-d H:i:s');
            $po->update();
        } elseif ($request->bongkar == 'tidak') {
            //  Integrasi Epicor
            // $client = new \GuzzleHttp\Client();
            // $url = 'http://34.34.222.145:2022/api/PO/ClosePO?PONum=' . $request->PONum;
            // $response = $client->get($url);
            // $response = $response->getBody()->getContents();
            // dd($response); 
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
            $log = new LogAktivityUser();
            $log->name_user    = Auth::guard('web')->user()->name;
            $log->id_objek_aktivitas_user  = $data->id_lab1_gb;
            $log->aktivitas_user  = 'Konfirmasi Supplier, Tolak bongkar. Kode PO: ' . $data->lab1_kode_po_gb . ' Plan Harga : ' . $data->plan_harga_gb;
            $log->keterangan_aktivitas  = 'Selesai';
            $log->created_at           = date('Y-m-d H:i:s');
            $log->save();
            // dd($data);

            $po = trackerPO::where('kode_po_tracker', $data->lab1_kode_po_gb)->first();
            $po->nama_admin_tracker  = Auth::guard('web')->user()->name;
            $po->proses_tracker  = 'KONFIRMASI SUPPLIER, PO DITOLAK';
            $po->konfirmasi_pending_tracker  = date('Y-m-d H:i:s');
            $po->update();
        }
        Alert::success('Berhasil', 'Data anda berhasil di Simpan');
        return redirect()->back()->with('Berhasil', 'Data anda berhasil di Simpan');
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
        $data1 = PDF::loadview('dashboard.user.transaksi.dt_cetak_po', ['data' => $data, 'get_provinsi' => $get_provinsi, 'get_kabupaten' => $get_kabupaten, 'get_kecamatan' => $get_kecamatan, 'get_desa' => $get_desa, 'get_item' => $get_item]);
        return $data1->download('CETAK ' . $params->kode_po . '.pdf');
    }

    public function scan_po($id)
    {
        $data = DataPO::join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('users', 'users.id', '=', 'user_idbid')
            ->where('id_data_po', $id)
            ->first();
        return view('dashboard.user.transaksi.dt_scan_po', ['data' => $data]);
    }

    public function riwayat()
    {
        if (Auth()->user()) {
            return view('dashboard.user.riwayat.dt_riwayat');
        } else {
            return view('dashboard.user.login');
        }
    }

    public function riwayat_index(Request $request)
    {
        $id = Auth::user()->id;
        return Datatables::of(DB::table('bid_user')
            ->join('bid', 'bid.id_bid', '=', 'bid_user.bid_id')
            ->join('users', 'users.id', '=', 'bid_user.user_id')
            ->where('user_id', $id)
            ->get())
            ->addColumn('name_bid', function ($list) {
                $result = $list->name_bid;
                return $result;
            })
            ->addColumn('date_bid', function ($list) {
                $result = $list->date_bid;
                return $result;
            })
            ->addColumn('harga', function ($list) {
                $result = $list->harga;
                return 'Rp' . $result . '/Kg';
            })
            ->addColumn('kode_bid', function ($list) {
                $result = $list->kode_bid;
                return $result;
            })
            ->addColumn('jumlah', function ($list) {
                $result = $list->jumlah;
                return $result;
            })
            ->addColumn('status_biduser', function ($list) {
                if ($list->status_biduser == 1) {
                    return '<a style="margin:2px;background-color:#9F187C" name="" title="Disetujui" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="" style="color:white;"> Disetujui </i>
                </a>';
                } elseif ($list->status_biduser == 2) {
                    return '<a style="margin:2px;background-color:#9c0911" name="" title="Disetujui" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="" style="color:white;"> Ditolak </i>
                </a>';
                } else {
                    return '<a style="margin:2px;background-color:#9F187C" name="" title="Proses lelang" class=" btn m-btn m-btn--icon btn-sm m-btn--icon-only">
                <i class="" style="color:white;"> Proses Lelang </i>
                </a>';
                }
            })
            // ->addColumn('ckelola', function($buatmanage){
            //     return '
            //         <a style="margin:2px;" name="'.$buatmanage->id_dispenser.'" data-toggle="modal" data-target="#modal2" title="Edit Data" class="toedit btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only">
            //         <i class="fa fa-pen-alt" style="color:#00c5dc;">Edit</i>
            //         </a>
            //         <a style="margin:2px;" href="'. route('superadmin.dispenser_destroy', ['id' => $buatmanage->id_dispenser]). '" data-offset="5px 5px" data-toggle="m-tooltip" title="Hapus Data" onclick="return true" class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
            //         <i class="fa fa-trash">Delete</i>
            //         </a>
            //     ';
            // })
            ->rawColumns(['name_bid', 'date_bid', 'harga', 'kode_bid', 'jumlah', 'status_biduser'])
            ->make(true);
    }

    public function akun()
    {
        $id = Auth::user()->id;
        $idprovinsi = Auth::user()->id_provinsiktp;
        $id = Auth::user()->id;
        $profil = User::where('id', $id)->first();
        // dd($profil);
        $prov = DB::table('provinces')->where('id', $idprovinsi)->first();
        $provinsi = DB::table('provinces')->get();
        $bank = User::where('id', $id)->first();
        $npwp = User::where('id', $id)->first();
        // dd($prov);
        return view('dashboard.user.akun.dt_account', compact('profil', 'provinsi', 'prov', 'npwp', 'bank'));
    }

    public function update_akun(Request $request)
    {
        // dd($request->all());
        $data = User::where('id', $request->id)->first();
        if ($request->file_paktaintegritas == null && $request->file_fis == null) {

            $data->username             = $request->username;
            $data->nama_vendor          = $request->nama_vendor;
            $data->password             = \Hash::make($request->password);
            $data->password_show        = $request->password;
            $data->email                = $request->email;
            $data->sps_alias_c          = $request->badan_usaha;
            $data->nomer_hp             = $request->nomer_hp;
            $data->name                 = $request->nama_vendor;
            $data->emailaddress         = $request->email;
            $data->SPS_phonenum_c       = $request->nomer_hp;

            $data->update();
        } else if ($request->file_paktaintegritas == null && $request->file_fis != null) {
            if ($data->fis != ''  && $data->fis != null) {
                $path = '/home/sumb1497/public_html/bid.com/public/img/fis/profile_user/';

                $file_old = $path . $data->fis;
                if (file_exists($file_old)) {
                    unlink($file_old);
                }
            }
            $filefis                    = $request->file('file_fis');
            $imageNamefis               = time() . '.' . $request->file_fis->extension();
            $moveKTP                    = $filefis->move('public/img/fis/profile_user', $imageNamefis);
            $data->username             = $request->username;
            $data->nama_vendor          = $request->nama_vendor;
            $data->password             = \Hash::make($request->password);
            $data->password_show        = $request->password;
            $data->email                = $request->email;
            $data->sps_alias_c          = $request->badan_usaha;
            $data->nomer_hp             = $request->nomer_hp;
            $data->name                 = $request->nama_vendor;
            $data->emailaddress         = $request->email;
            $data->SPS_phonenum_c       = $request->nomer_hp;
            $data->fis                  = $imageNamefis;
            $data->update();
        } else if ($request->file_paktaintegritas != null && $request->file_fis == null) {
            if ($data->pakta_integritas != ''  && $data->pakta_integritas != null) {
                $path = '/home/sumb1497/public_html/bid.com/public/img/pakta_integritas/profile_user/';

                $file_old = $path . $data->pakta_integritas;
                if (file_exists($file_old)) {
                    unlink($file_old);
                }
            }
            $filePakta       = $request->file('file_paktaintegritas');
            $imageNamePakta  = time() . '.' . $request->file_paktaintegritas->extension();
            $moveKTP       = $filePakta->move('public/img/pakta_integritas/profile_user', $imageNamePakta);
            $data->username     = $request->username;
            $data->nama_vendor     = $request->nama_vendor;
            $data->password        = \Hash::make($request->password);
            $data->password_show        = $request->password;
            $data->email        = $request->email;
            $data->sps_alias_c        = $request->badan_usaha;
            $data->nomer_hp     = $request->nomer_hp;
            $data->name                 = $request->nama_vendor;
            $data->emailaddress         = $request->email;
            $data->SPS_phonenum_c       = $request->nomer_hp;
            $data->pakta_integritas     = $imageNamePakta;
            $data->update();
        } else {
            if ($data->pakta_integritas != ''  && $data->pakta_integritas != null && $data->fis != ''  && $data->fis != null) {
                $path = '/home/sumb1497/public_html/ngawi.suryapangansemesta.store/public/img/pakta_integritas/profile_user/';
                $path1 = '/home/sumb1497/public_html/ngawi.suryapangansemesta.store/public/img/fis/profile_user/';

                $file_old = $path . $data->pakta_integritas;
                $file_old1 = $path1 . $data->fis;
                if (file_exists($file_old) && file_exists($file_old1)) {
                    unlink($file_old);
                    unlink($file_old1);
                }
            }
            $filePakta                  = $request->file('file_paktaintegritas');
            $imageNamePakta             = time() . '.' . $request->file_paktaintegritas->extension();
            $movePakta                  = $filePakta->move('public/img/pakta_integritas/profile_user', $imageNamePakta);
            $filefis                    = $request->file('file_fis');
            $imageNamefis               = time() . '.' . $request->file_fis->extension();
            $moveFIS                    = $filefis->move('public/img/fis/profile_user', $imageNamefis);
            $data->username             = $request->username;
            $data->nama_vendor          = $request->nama_vendor;
            $data->password             = \Hash::make($request->password);
            $data->password_show        = $request->password;
            $data->email                = $request->email;
            $data->sps_alias_c          = $request->badan_usaha;
            $data->nomer_hp             = $request->nomer_hp;
            $data->name                 = $request->nama_vendor;
            $data->emailaddress         = $request->email;
            $data->SPS_phonenum_c       = $request->nomer_hp;
            $data->pakta_integritas     = $imageNamePakta;
            $data->fis                  = $imageNamefis;
            $data->update();
        }
        // Integrasi Epicor
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/Vendor/UpdateVendor';
        $form_params = [
            'vendorid'          => $request->vendorid,
            'groupcode'         => '1PBB',
            'name'              => $request->nama_vendor,
            'sps_alias_c'       => $request->badan_usaha,
            'address1'          => $request->address1,
            'address2'          => $request->address2,
            'address3'          => $request->address3,
            'city'              => $request->city,
            'state'             => $request->state,
            'taxpayerid'        => $request->taxpayerid,
            'sps_namenpwp_c'    => $request->sps_namenpwp_c,
            'sps_alamatnpwp_c'  => $request->sps_alamatnpwp_c,
            'inactive'          => 'false',
            'sps_phonenum_c'    => $request->nomer_hp,
            'emailaddress'      => $request->email,
            'termscode'         => $request->termscode,
            'bankacctnumber'    => $request->bankacctnumber,
            'bankbranchcode'    => $request->bankbranchcode,
            'sps_niksupplier_c' => $request->sps_niksupplier_c,
            'bankAccountID'     => 'BA101',
            'BankName'          => $request->bankname
        ];
        $response = $client->post($url, ['form_params' => $form_params]);
        $response = $response->getBody()->getContents();
        // dd($response);
        Alert::success('Berhasil', 'Data anda berhasil di Simpan');
        return redirect()->back()->with('Berhasil', 'Data anda berhasil di Simpan');
    }
    public function update_ktp(Request $request)
    {
        // dd($request->all());
        $cek_address1 = DB::table('districts')->where('id', $request->id_kecamatanktp)->first();
        $cek_address2 = DB::table('regencies')->where('id', $request->id_kabupatenktp)->first();
        $cek_address3 = DB::table('provinces')->where('id', $request->id_provinsiktp)->first();
        $cek_address4 = DB::table('villages')->where('id', $request->id_desaktp)->first();
        $data = User::where('id', $request->id)->first();
        if ($request->file_ktp == null) {
            // dd('a');
            $data->nama_ktp                 = $request->nama_ktp;
            $data->ktp                      = $request->ktp;
            $data->id_provinsiktp           = $request->id_provinsiktp;
            $data->id_kabupatenktp          = $request->id_kabupatenktp;
            $data->id_kecamatanktp          = $request->id_kecamatanktp;
            $data->id_desaktp               = $request->id_desaktp;
            $data->keterangan_alamat_ktp    = $request->keterangan_alamat_ktp;
            $data->rt_ktp                   = $request->rt_ktp;
            $data->rw_ktp                   = $request->rw_ktp;
            $data->address1                 = $request->keterangan_alamat_ktp . ' RT. ' . $request->rt_ktp . ' / RW. ' . $request->rw_ktp;
            $data->address2                 = 'KEL ' . $cek_address4->name . ' KEC. ' . $cek_address1->name;
            $data->address3                 = $cek_address2->name;
            $data->city                     = $cek_address2->name;
            $data->state                    = $cek_address3->name;
            $data->SPS_niksupplier_c        = $request->ktp;
            $data->update();
        } else {
            // dd('b');
            if ($data->gambar_ktp != ''  && $data->gambar_ktp != null) {
                $path = '/home/sumb1497/public_html/bid.com/public/img/ktp/profile_user/';

                $file_old = $path . $data->gambar_ktp;
                if (file_exists($file_old)) {
                    unlink($file_old);
                }
            }
            $fileKTP                        = $request->file('file_ktp');
            $imageNameKTP                   = time() . '.' . $request->file_ktp->extension();
            $moveKTP                        = $fileKTP->move('public/img/ktp/profile_user', $imageNameKTP);
            $data->nama_ktp                 = $request->nama_ktp;
            $data->ktp                      = $request->ktp;
            $data->id_provinsiktp           = $request->id_provinsiktp;
            $data->id_kabupatenktp          = $request->id_kabupatenktp;
            $data->id_kecamatanktp          = $request->id_kecamatanktp;
            $data->id_desaktp               = $request->id_desaktp;
            $data->keterangan_alamat_ktp    = $request->keterangan_alamat_ktp;
            $data->rt_ktp                   = $request->rt_ktp;
            $data->rw_ktp                   = $request->rw_ktp;
            $data->address1                 = $request->keterangan_alamat_ktp . ' RT. ' . $request->rt_ktp . ' / RW. ' . $request->rw_ktp;
            $data->address2                 = 'KEL ' . $cek_address4->name . ' KEC. ' . $cek_address1->name;
            $data->address3                 = $cek_address2->name;
            $data->city                     = $cek_address2->name;
            $data->state                    = $cek_address3->name;
            $data->SPS_niksupplier_c        = $request->ktp;
            $data->gambar_ktp               = $imageNameKTP;
            $data->update();
        }
        // Integrasi Epicor
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/Vendor/UpdateVendor';
        $form_params = [
            'name'              => $request->name,
            'groupcode'         => '1PBB',
            'vendorid'          => $request->vendorid,
            'sps_alias_c'       => $request->sps_alias_c,
            'address1'          => $request->keterangan_alamat_ktp . ' RT. ' . $request->rt_ktp . ' / RW. ' . $request->rw_ktp,
            'address2'          => 'KEL ' . $cek_address4->name . ' KEC. ' . $cek_address1->name,
            'address3'          => $cek_address2->name,
            'city'              => $cek_address2->name,
            'state'             => $cek_address3->name,
            'taxpayerid'        => $request->taxpayerid,
            'sps_namenpwp_c'    => $request->sps_namenpwp_c,
            'sps_alamatnpwp_c'  => $request->sps_alamatnpwp_c,
            'inactive'          => 'false',
            'sps_phonenum_c'    => $request->sps_phonenum_c,
            'emailaddress'      => $request->emailaddress,
            'termscode'         => 'PT01',
            'bankAccountID'     => 'BA101',
            'BankName'          => $request->bankname,
            'bankacctnumber'    => $request->bankacctnumber,
            'bankbranchcode'    => $request->bankbranchcode,
            'sps_niksupplier_c' => $request->ktp
        ];
        $response = $client->post($url, ['form_params' => $form_params]);
        $response = $response->getBody()->getContents();
        // dd($response);
        Alert::success('Berhasil', 'Data anda berhasil di Simpan');
        return redirect()->back()->with('Berhasil', 'Data anda berhasil di Simpan');
    }
    public function update_npwp(Request $request)
    {
        // dd($request->all());
        $cek_address1 = DB::table('districts')->where('id', $request->id_kecamatannpwp)->first();
        $cek_address2 = DB::table('regencies')->where('id', $request->id_kabupatennpwp)->first();
        $cek_address3 = DB::table('provinces')->where('id', $request->id_provinsinpwp)->first();
        $cek_address4 = DB::table('villages')->where('id', $request->id_desanpwp)->first();
        $data = User::where('id', $request->id)->first();
        if ($request->file_npwp == null) {
            // dd('a');
            $data->nama_npwp                = $request->nama_npwp;
            $data->npwp                     = $request->npwp;
            $data->id_provinsinpwp          = $request->id_provinsinpwp;
            $data->id_kabupatennpwp         = $request->id_kabupatennpwp;
            $data->id_kecamatannpwp         = $request->id_kecamatannpwp;
            $data->id_desanpwp              = $request->id_desanpwp;
            $data->keterangan_alamat_npwp   = $request->keterangan_alamat_npwp;
            $data->rt_npwp                  = $request->rt_npwp;
            $data->rw_npwp                  = $request->rw_npwp;
            $data->taxpayerID               = $request->npwp;
            $data->SPS_NameNPWP_c           = $request->nama_npwp;
            $data->SPS_AlamatNPWP_c         = $request->keterangan_alamat_npwp . ' RT. ' . $request->rt_npwp . ' RW. ' . $request->rw_npwp . ', ' . $cek_address4->name . ', ' . $cek_address1->name . ', ' . $cek_address2->name . ', ' . $cek_address3->name . ' INDONESIA';
            $data->update();
        } else {
            // dd('b');
            if ($data->gambar_npwp != ''  && $data->gambar_npwp != null) {
                $path = '/home/sumb1497/public_html/bid.com/public/img/npwp/profile_user/';

                $file_old = $path . $data->gambar_npwp;
                if (file_exists($file_old)) {
                    unlink($file_old);
                }
            }
            $filenpwp                       = $request->file('file_npwp');
            $imageNameNPWP                  = time() . '.' . $request->file_npwp->extension();
            $moveNPWP                       = $filenpwp->move('public/img/npwp/profile_user', $imageNameNPWP);
            $data->nama_npwp                = $request->nama_npwp;
            $data->npwp                     = $request->npwp;
            $data->id_provinsinpwp          = $request->id_provinsinpwp;
            $data->id_kabupatennpwp         = $request->id_kabupatennpwp;
            $data->id_kecamatannpwp         = $request->id_kecamatannpwp;
            $data->id_desanpwp              = $request->id_desanpwp;
            $data->keterangan_alamat_npwp   = $request->keterangan_alamat_npwp;
            $data->rt_npwp                  = $request->rt_npwp;
            $data->rw_npwp                  = $request->rw_npwp;
            $data->taxpayerID               = $request->npwp;
            $data->SPS_NameNPWP_c           = $request->nama_npwp;
            $data->SPS_AlamatNPWP_c         = $request->keterangan_alamat_npwp . ', RT. ' . $request->rt_npwp . '' . $cek_address4->name . ', ' . $cek_address1->name . ', ' . $cek_address2->name . ', ' . $cek_address3->name . ' INDONESIA';
            $data->gambar_npwp              = $imageNameNPWP;
            $data->update();
        }
        // Integrasi Epicor
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/Vendor/UpdateVendor';
        $form_params = [
            'name'              => $request->name,
            'groupcode'         => '1PBB',
            'vendorid'          => $request->vendorid,
            'sps_alias_c'       => $request->sps_alias_c,
            'address1'          => $request->address1,
            'address2'          => $request->address2,
            'address3'          => $request->city,
            'city'              => $request->city,
            'state'             => $request->state,
            'taxpayerid'        => $request->npwp,
            'sps_namenpwp_c'    => $request->nama_npwp,
            'sps_alamatnpwp_c'  => $request->keterangan_alamat_npwp . ', RT. ' . $request->rt_npwp . '' . $cek_address4->name . ', ' . $cek_address1->name . ', ' . $cek_address2->name . ', ' . $cek_address3->name . ' INDONESIA',
            'inactive'          => 'false',
            'sps_phonenum_c'    => $request->sps_phonenum_c,
            'emailaddress'      => $request->emailaddress,
            'termscode'         => 'PT01',
            'bankAccountID'     => 'BA101',
            'BankName'          => $request->bankname,
            'bankacctnumber'    => $request->bankacctnumber,
            'bankbranchcode'    => $request->bankbranchcode,
            'sps_niksupplier_c' => $request->sps_niksupplier_c
        ];
        $response = $client->post($url, ['form_params' => $form_params]);
        $response = $response->getBody()->getContents();
        // dd($response);
        Alert::success('Berhasil', 'Data anda berhasil di Simpan');
        return redirect()->back()->with('Berhasil', 'Data anda berhasil di Simpan');
    }

    public function update_bank(Request $request)
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
        $data = User::where('id', $request->id)->first();
        $data->nama_bank            = $request->nama_bank;
        $data->nomer_rekening       = $request->nomer_rekening;
        $data->nama_penerima_bank   = $request->nama_penerima_bank;
        $data->cabang_bank          = $request->cabang_bank;
        $data->BankBranchCode       = $request->nama_bank;
        $data->BankName             = $bank_name;
        $data->BankAcctNumber       = $request->nomer_rekening;
        $data->update();
        // Integrasi Epicor
        $client = new \GuzzleHttp\Client();
        $url = 'http://34.34.222.145:2022/api/Vendor/UpdateVendor';
        $form_params = [
            'name'              => $request->name,
            'groupcode'         => '1PBB',
            'vendorid'          => $request->vendorid,
            'sps_alias_c'       => $request->sps_alias_c,
            'address1'          => $request->address1,
            'address2'          => $request->address2,
            'address3'          => $request->city,
            'city'              => $request->city,
            'state'             => $request->state,
            'taxpayerid'        => $request->taxpayerid,
            'sps_namenpwp_c'    => $request->sps_namenpwp_c,
            'sps_alamatnpwp_c'  => $request->sps_alamatnpwp_c,
            'inactive'          => 'false',
            'sps_phonenum_c'    => $request->sps_phonenum_c,
            'emailaddress'      => $request->emailaddress,
            'termscode'         => 'PT01',
            'bankAccountID'     => 'BA101',
            'BankName'          => $bank_name,
            'bankacctnumber'    => $request->nomer_rekening,
            'bankbranchcode'    => $bank_code,
            'sps_niksupplier_c' => $request->sps_niksupplier_c
        ];
        $response = $client->post($url, ['form_params' => $form_params]);
        $response = $response->getBody()->getContents();
        // dd($response);
        Alert::success('Berhasil', 'Data anda berhasil di Simpan');
        return redirect()->back()->with('Berhasil', 'Data anda berhasil di Simpan');
    }

    public function news()
    {
        $data = News::orderBy('id_news', 'desc')->get();
        return view('dashboard.user.berita.dt_news', ['data' => $data]);
    }

    public function news_detail($id)
    {
        $data = DB::table('news')->where('id_news', $id)->first();
        return view('dashboard.user.berita.dt_detailnews', ['data' => $data]);
    }

    public function listnews()
    {
        $data = DB::table('news')->get();
        return view('dashboard.user.berita.dt_news', ['data' => $data]);
    }

    public function notif()
    {
        return view('dashboard.user.pemberitahuan.dt_notification');
    }

    public function setting_profile()
    {
        $id = Auth::user()->id;
        $data = User::where('id', $id)->first();
        return view('dashboard.user.akun.dt_settingprofile', ['data' => $data]);
    }

    public function setting_bank()
    {
        return view('dashboard.user.akun.dt_setting_bank');
    }

    public function help()
    {
        return view('dashboard.user.akun.dt_help');
    }

    public function more_menu()
    {
        return view('dashboard.user.akun.dt_more_menu');
    }

    public function bid()
    {
        return view('dashboard.user.bid.dt_lelang');
    }

    public function detailbid($id)
    {
        $data = DB::table('bid')->where('id_bid', $id)->first();
        dd($data);
        $check = DB::table('bid_user')->where('user_id', Auth()->user()->id)->where('bid_id', $id)->get();
        return view('dashboard.user.bid.dt_detailbid', ['data' => $data, 'check' => $check]);
    }

    public function bidshow($id)
    {
        $data = DB::table('bid')->where('id_bid', $id)->first();
        return json_encode($data);
    }

    public function bidproduct($id)
    {
        $data = DB::table('bid')->where('id_bid', $id)->first();
        return view('dashboard.user.bid.dt_bidproduct', ['data' => $data]);
    }

    public function listbid()
    {
        $data = DB::table('bid')->paginate(4);
        return view('dashboard.user.bid.dt_listbid', ['data' => $data]);
    }

    public function about()
    {
        return view('dashboard.user.akun.dt_about');
    }

    public function procedure()
    {
        return view('dashboard.user.akun.dt_procedure');
    }
    public function potong_pajak()
    {
        $auth = Auth()->user()->id;
        $broadcaster_count = DB::table('potong_pajak')
            ->selectRaw('potong_pajak.*,COUNT(*) AS total')
            ->where('potong_pajak.id_user_potong_pajak', $auth)
            ->get();
        $broadcaster = DB::table('potong_pajak')
            ->orderBy('date_potong_pajak', 'DESC')
            ->where('potong_pajak.id_user_potong_pajak', $auth)
            ->get();
        // dd($broadcaster);
        $data = DB::table('broadcast')->orderBy('id_broadcast', 'desc')->get();
        return view('dashboard.user.pajak.potong_pajak', ['broadcaster' => $broadcaster, 'broadcaster_count' => $broadcaster_count, 'data' => $data]);
    }
    public function pemberitahuan()
    {
        $broadcaster_count = DB::table('broadcast')
            ->selectRaw('broadcast.*,COUNT(*) AS total')
            // ->limit(1)
            ->get();
        $count = DB::table('broadcast')
            // ->limit(1)
            ->count();
        // dd($broadcaster_count);
        $broadcaster = DB::table('broadcast')
            ->orderBy('id_broadcast', 'DESC')
            // ->limit(1)
            ->get();
        $broadcaster1 = DB::table('broadcast')
            ->orderBy('id_broadcast', 'DESC')
            // ->limit(1)
            ->first();
        if ($broadcaster1 == 'null' || $broadcaster1 == '' || $broadcaster1 == NULL) {
            // dd('OK');
            $firsttabs = 'NULL';
        } else {
            $firsttabs = isset($broadcaster1->id_broadcast) ? $broadcaster1->id_broadcast : $broadcaster->first()->id_broadcast;
        }
        $data = DB::table('broadcast')->orderBy('id_broadcast', 'desc')->get();
        return view('dashboard.user.pemberitahuan.dt_pemberitahuan', ['broadcaster' => $broadcaster, 'count' => $count, 'broadcaster_count' => $broadcaster_count, 'data' => $data, 'firsttabs' => $firsttabs]);
    }
    public function update_statusbaca($id)
    {
        $auth = Auth()->user()->id;
        $data = DB::table('broadcast')->where('id_broadcast', $id)->update(['status_baca' => '1']);
    }
}
