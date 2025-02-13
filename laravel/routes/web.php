<?php

use App\Http\Controllers\AdminQc\QcAdminController;
use App\Http\Controllers\AdminSpvQc\SpvQcAdminController;
use App\Http\Controllers\AdminTimbangan\AdminTimbanganController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Superadmin\SuperadminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\AdminQcBongkar\QcAdminBongkarController;
use App\Http\Controllers\AdminAP\AdminAPController;
use App\Http\Controllers\AdminMaster\MasterController;
use App\Http\Controllers\AdminSpvAp\AdminSpvApController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', [UserController::class, 'home'])->name('home');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/perbaikansistem', [UserController::class, 'get_maintenance'])->name('get_maintenance');

Route::get('/getpricegt4/{id?}', [QcAdminController::class, 'get_price_gt4'])->name('get_price_gt4');

Route::get('/get_count_plan_hpp_gabah_basah/{id?}/{item?}', [QcAdminController::class, 'get_count_plan_hpp_gabah_basah'])->name('get_count_plan_hpp_gabah_basah');
Route::get('/get_count_plan_hpp_gabah_kering/{id?}', [QcAdminController::class, 'get_count_plan_hpp_gabah_kering'])->name('get_count_plan_hpp_gabah_kering');
// validasi Parameter Refraksi PK
Route::get('/get_count_refraksi_hampa/{id?}', [QcAdminController::class, 'get_count_refraksi_hampa'])->name('get_count_refraksi_hampa');
Route::get('/get_count_refraksi_ka/{id?}', [QcAdminController::class, 'get_count_refraksi_ka'])->name('get_count_refraksi_ka');
Route::get('/get_count_refraksi_tr/{id?}', [QcAdminController::class, 'get_count_refraksi_tr'])->name('get_count_refraksi_tr');
Route::get('/get_count_refraksi_katul/{id?}', [QcAdminController::class, 'get_count_refraksi_katul'])->name('get_count_refraksi_katul');
Route::get('/get_count_refraksi_butiran_patah/{id?}', [QcAdminController::class, 'get_count_refraksi_butiran_patah'])->name('get_count_refraksi_butiran_patah');
// validasi Parameter Reward PK
Route::get('/get_count_reward_tr/{id?}', [QcAdminController::class, 'get_count_reward_tr'])->name('get_count_reward_tr');
Route::get('/get_count_reward_katul/{id?}', [QcAdminController::class, 'get_count_reward_katul'])->name('get_count_reward_katul');
Route::get('/get_count_reward_butir_patah/{id?}', [QcAdminController::class, 'get_count_reward_butir_patah'])->name('get_count_reward_butir_patah');
Route::get('/get_count_reward_hampa/{id?}', [QcAdminController::class, 'get_count_reward_hampa'])->name('get_count_reward_hampa');
// validasi Parameter Kualitas PK
Route::get('/get_count_lab_kualitas/{id?}', [QcAdminController::class, 'get_count_lab_kualitas'])->name('get_count_lab_kualitas');

Route::get('/get_price_top_pecah_kulit/{id?}', [QcAdminController::class, 'get_price_top_pecah_kulit'])->name('get_price_top_pecah_kulit');

Route::get('/get_price_beras_ds/{id?}', [QcAdminController::class, 'get_price_beras_ds'])->name('get_price_beras_ds');
Route::get('/get_price_top_gabah_basah/{id?}', [QcAdminController::class, 'get_price_top_gabah_basah'])->name('get_price_top_gabah_basah');
Route::get('/get_buttom_price_gabah_basah/{id?}', [QcAdminController::class, 'get_buttom_price_gabah_basah'])->name('get_buttom_price_gabah_basah');
Route::get('/get_price_top_gabah_kering/{id?}', [QcAdminController::class, 'get_price_top_gabah_kering'])->name('get_price_top_gabah_kering');


Route::prefix('user')->name('user.')->group(function () {
    Route::get('/daftar_lelang', [UserController::class, 'daftar_lelang'])->name('daftar_lelang');
    Route::get('/berita', [UserController::class, 'berita'])->name('berita');
    Route::get('/about_us', [UserController::class, 'about_us'])->name('about_us');
    Route::get('/pemberitahuan', [UserController::class, 'pemberitahuan'])->name('pemberitahuan');

    // New User
    Route::get('/new_user', [UserController::class, 'new_user_index'])->name('new_user');
    Route::middleware(['guest:web', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.user.login')->name('login');
        Route::get('/formregister', [UserController::class, 'formregister'])->name('formregister');
        Route::post('/create', [UserController::class, 'create'])->name('create');
        Route::post('/check', [UserController::class, 'check'])->name('check');
        Route::get('/cekusername', [UserController::class, 'cekUsername'])->name('cekusername');
        Route::get('account/verify/{token}', [UserController::class, 'verifyAccount'])->name('user.verify');
        Route::get('/cekusername/{id?}', [UserController::class, 'cekUsername'])->name('cekusername');
        Route::get('/get_npwp/{id?}', [UserController::class, 'get_npwp'])->name('get_npwp');
        Route::get('/get_nik/{id?}', [UserController::class, 'get_nik'])->name('get_nik');
        Route::get('/get_verifyemail/{id?}', [UserController::class, 'get_verifyemail'])->name('get_verifyemail');
        Route::get('/daftar_berita', [UserController::class, 'daftar_berita'])->name('daftar_berita');
        // new user
        Route::post('/new_check', [UserController::class, 'new_check'])->name('new_check');
    });
    Route::get('/site_kediri', [UserController::class, 'site_kediri'])->name('site_kediri');

    Route::get('/getkabupaten', [UserController::class, 'getkabupaten'])->name('getkabupaten');
    Route::get('/getkecamatan', [UserController::class, 'getkecamatan'])->name('getkecamatan');
    Route::get('/getdesa', [UserController::class, 'getdesa'])->name('getdesa');
    Route::get('/home', [UserController::class, 'home'])->name('home');
    Route::get('/search', [UserController::class, 'search'])->name('search');
    Route::get('/lelang_show/{id?}', [UserController::class, 'lelang_show'])->name('lelang_show');
    Route::get('/lelang_detail/{id?}', [UserController::class, 'lelang_detail'])->name('lelang_detail');
    Route::post('/lelang_storeuser', [UserController::class, 'lelang_storeuser'])->name('lelang_storeuser');
    Route::get('/pangan_pertanian', [UserController::class, 'pangan_pertanian'])->name('pangan_pertanian');
    Route::get('/teknologi_inovasi', [UserController::class, 'teknologi_inovasi'])->name('teknologi_inovasi');
    Route::get('/ekonomi_perdagangan', [UserController::class, 'ekonomi_perdagangan'])->name('ekonomi_perdagangan');
    Route::get('/international', [UserController::class, 'international'])->name('international');
    Route::get('/populer', [UserController::class, 'populer'])->name('populer');
    Route::get('/terbaru', [UserController::class, 'terbaru'])->name('terbaru');
    Route::get('/update_home', [UserController::class, 'update_home'])->name('update_home');
    Route::get('/detailberita/{id?}', [UserController::class, 'detailberita'])->name('detailberita');
    Route::get('/cetak_po/{id?}', [UserController::class, 'cetak_po'])->name('cetak_po');
    Route::middleware(['auth:web', 'PreventBackHistory'])->group(function () {
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
        Route::get('/transaksi', [UserController::class, 'transaksi'])->name('transaksi');
        Route::get('/riwayat_transaksi', [UserController::class, 'riwayat_transaksi'])->name('riwayat_transaksi');
        Route::get('/potong_pajak', [UserController::class, 'potong_pajak'])->name('potong_pajak');
        Route::get('/scan_po/{id?}', [UserController::class, 'scan_po'])->name('cetak_po');
        Route::get('/data_list_po/{id?}', [UserController::class, 'data_list_po'])->name('data_list_po');
        Route::get('/update_statusbaca/{id?}', [UserController::class, 'update_statusbaca'])->name('update_statusbaca');
        Route::get('/akun', [UserController::class, 'akun'])->name('akun');
        Route::get('/listbid', [UserController::class, 'listbid'])->name('listbid');
        Route::get('/news', [UserController::class, 'news'])->name('news');
        Route::get('/bid', [UserController::class, 'bid'])->name('bid');
        Route::get('/notification', [UserController::class, 'notif'])->name('notification');
        Route::get('/setting_profile', [UserController::class, 'setting_profile'])->name('setting_profile');
        Route::get('/setting_bank', [UserController::class, 'setting_bank'])->name('setting_bank');
        Route::get('/help', [UserController::class, 'help'])->name('help');
        Route::get('/more_menu', [UserController::class, 'more_menu'])->name('more_menu');
        Route::get('/account', [UserController::class, 'account'])->name('account');
        Route::get('/about', [UserController::class, 'about'])->name('about');
        Route::get('/procedure', [UserController::class, 'procedure'])->name('procedure');
        Route::get('/status_pending/{id?}', [UserController::class, 'status_pending'])->name('status_pending');

        // New User
        // New User
        Route::get('/new_home', [UserController::class, 'new_home'])->name('new_home');
        Route::post('/new_akun_update', [UserController::class, 'new_update_akun'])->name('new_akun_update');
        Route::get('/new_daftar_lelang', [UserController::class, 'new_daftar_lelang'])->name('new_daftar_lelang');
        Route::get('/new_lelang_detail/{id?}', [UserController::class, 'new_lelang_detail'])->name('new_lelang_detail');
        Route::post('/new_logout', [UserController::class, 'new_logout'])->name('new_logout');
        Route::post('/new_lelang_storeuser', [UserController::class, 'new_lelang_storeuser'])->name('new_lelang_storeuser');
        Route::get('/new_transaksi', [UserController::class, 'new_transaksi'])->name('new_transaksi');
        Route::get('/new_history', [UserController::class, 'new_history'])->name('new_history');
        Route::get('/new_data_list_po/{id?}', [UserController::class, 'new_data_list_po'])->name('new_data_list_po');
        Route::get('/new_notif', [UserController::class, 'new_notif'])->name('new_notif');
        Route::get('/new_potong_pajak', [UserController::class, 'new_potong_pajak'])->name('new_potong_pajak');
        Route::get('/new_berita', [UserController::class, 'new_berita'])->name('new_berita');
        Route::get('/new_account', [UserController::class, 'new_account'])->name('new_account');
        Route::get('/new_about', [UserController::class, 'new_about'])->name('new_about');
        Route::get('/new_video_panduan', [UserController::class, 'new_video_panduan'])->name('new_video_panduan');

        require('api_user.php');
    });
});

Route::prefix('qc')->name('qc.')->group(function () {
    //LAB
    Route::middleware(['guest:lab', 'PreventBackHistory'])->group(function () {
        Route::get('/lab/login', [QcAdminController::class, 'login'])->name('lab.login');
        Route::post('/lab/check', [QcAdminController::class, 'check'])->name('lab.check');
    });

    Route::middleware(['auth:lab', 'PreventBackHistory'])->group(function () {
        Route::get('/lab/home', [QcAdminController::class, 'home'])->name('lab.home');
        Route::get('/lab/chart_gudang', [QcAdminController::class, 'chart_gudang'])->name('lab.chart_gudang');
        Route::get('/account_lab', [QcAdminController::class, 'account_lab'])->name('lab.account_lab');
        Route::post('/lab/account_update', [QcAdminController::class, 'account_update'])->name('lab.account_update');
        Route::post('/lab/qc_logout', [QcAdminController::class, 'qc_logout'])->name('lab.qc_logout');
        Route::get('/lab/revisi_security/{id?}', [QcAdminController::class, 'revisi_security'])->name('lab.revisi_security');

        // get Plan Hpp
        Route::get('/lab/get_plan_hpp_gabah_basah/{id?}/{item?}', [QcAdminController::class, 'get_plan_hpp_gabah_basah'])->name('lab.get_plan_hpp_gabah_basah');
        Route::get('/lab/get_plan_hpp_gabah_kering/{tanggal_po?}', [QcAdminController::class, 'get_plan_hpp_gabah_kering'])->name('lab.get_plan_hpp_gabah_kering');
        Route::get('/lab/get_plan_hpp_pecah_kulit/{tanggal_po?}', [QcAdminController::class, 'get_plan_hpp_pecah_kulit'])->name('lab.get_plan_hpp_pecah_kulit');
        Route::get('/lab/get_plan_hpp_beras_ds/{tanggal_po?}', [QcAdminController::class, 'get_plan_hpp_beras_ds'])->name('lab.get_plan_hpp_beras_ds');


        Route::get('/lab/lokasi_bongkar/{id?}', [QcAdminController::class, 'lokasi_bongkar'])->name('lab.lokasi_bongkar');


        Route::get('/lab/output_gabah_onprocess', [QcAdminController::class, 'output_gabah_onprocess'])->name('lab.output_gabah_onprocess');
        Route::get('/lab/output_gabah_onprocess_index', [QcAdminController::class, 'output_gabah_onprocess_index'])->name('lab.output_gabah_onprocess_index');

        Route::get('/lab/output_gabah_nego', [QcAdminController::class, 'output_gabah_nego'])->name('lab.output_gabah_nego');
        Route::get('/lab/output_gabah_longgrain_nego_index', [QcAdminController::class, 'output_gabah_longgrain_nego_index'])->name('lab.output_gabah_longgrain_nego_index');
        Route::get('/lab/output_gabah_pandan_wangi_nego_index', [QcAdminController::class, 'output_gabah_pandan_wangi_nego_index'])->name('lab.output_gabah_pandan_wangi_nego_index');
        Route::get('/lab/output_gabah_ketan_putih_nego_index', [QcAdminController::class, 'output_gabah_ketan_putih_nego_index'])->name('lab.output_gabah_ketan_putih_nego_index');
        Route::get('/lab/output_gabah_unloading_result_nego', [QcAdminController::class, 'output_gabah_unloading_result_nego'])->name('lab.output_gabah_unloading_result_nego');
        Route::get('/lab/output_gabah_unloading_result_nego_index', [QcAdminController::class, 'output_gabah_unloading_result_nego_index'])->name('lab.output_gabah_unloading_result_nego_index');
        Route::get('/lab/show_output_nego/{id?}', [QcAdminController::class, 'show_output_nego'])->name('lab.show_output_nego');

        Route::get('/lab/global_incoming', [QcAdminController::class, 'global_incoming'])->name('lab.global_incoming');





        Route::post('/lab/output_nego_qc', [QcAdminController::class, 'output_nego_qc'])->name('lab.output_nego_qc');

        // HPP Gabah Basah
        Route::get('/lab/plan_hpp_gabah_basah', [QcAdminController::class, 'plan_hpp_gabah_basah'])->name('lab.plan_hpp_gabah_basah');
        Route::get('/lab/plan_hpp_gabah_basah_ciherang_index', [QcAdminController::class, 'plan_hpp_gabah_basah_ciherang_index'])->name('lab.plan_hpp_gabah_basah_ciherang_index');
        Route::get('/lab/plan_hpp_gabah_basah_longgrain_index', [QcAdminController::class, 'plan_hpp_gabah_basah_longgrain_index'])->name('lab.plan_hpp_gabah_basah_longgrain_index');
        Route::get('/lab/plan_hpp_gabah_basah_pandanwangi_index', [QcAdminController::class, 'plan_hpp_gabah_basah_pandanwangi_index'])->name('lab.plan_hpp_gabah_basah_pandanwangi_index');
        Route::get('/lab/plan_hpp_gabah_basah_ketanputih_index', [QcAdminController::class, 'plan_hpp_gabah_basah_ketanputih_index'])->name('lab.plan_hpp_gabah_basah_ketanputih_index');
        Route::get('/lab/partial_gabah_basah/{id}', [QcAdminController::class, 'partial_plan_hpp_gabah_basah'])->name('lab.partial_plan_hpp_gabah_basah');
        Route::get('/lab/edit_gabah_basah', [QcAdminController::class, 'edit_plan_hpp_gabah_basah'])->name('lab.edit_plan_hpp_gabah_basah');
        Route::get('/lab/delete_plan_hpp_gabah_basah/{id?}', [QcAdminController::class, 'delete_plan_hpp_gabah_basah'])->name('lab.delete_plan_hpp_gabah_basah');
        Route::post('/lab/simpan_plan_hpp_gabah_basah', [QcAdminController::class, 'simpan_plan_hpp_gabah_basah'])->name('lab.simpan_plan_hpp_gabah_basah');

        // HPP Gabah Kering
        Route::get('/lab/plan_hpp_gabah_kering', [QcAdminController::class, 'plan_hpp_gabah_kering'])->name('lab.plan_hpp_gabah_kering');
        Route::get('/lab/plan_hpp_gabah_kering_index', [QcAdminController::class, 'plan_hpp_gabah_kering_index'])->name('lab.plan_hpp_gabah_kering_index');
        Route::get('/lab/partial_gabah_kering/{id}', [QcAdminController::class, 'partial_plan_hpp_gabah_kering'])->name('lab.partial_plan_hpp_gabah_kering');
        Route::get('/lab/edit_gabah_kering', [QcAdminController::class, 'edit_plan_hpp_gabah_kering'])->name('lab.edit_plan_hpp_gabah_kering');
        Route::get('/lab/delete_plan_hpp_gabah_kering/{id?}', [QcAdminController::class, 'delete_plan_hpp_gabah_kering'])->name('lab.delete_plan_hpp_gabah_kering');
        Route::post('/lab/simpan_plan_hpp_gabah_kering', [QcAdminController::class, 'simpan_plan_hpp_gabah_kering'])->name('lab.simpan_plan_hpp_gabah_kering');

        // HPP Gabah PK
        Route::get('/lab/plan_hpp_pecah_kulit', [QcAdminController::class, 'plan_hpp_pecah_kulit'])->name('lab.plan_hpp_pecah_kulit');
        Route::get('/lab/plan_hpp_pecah_kulit_index', [QcAdminController::class, 'plan_hpp_pecah_kulit_index'])->name('lab.plan_hpp_pecah_kulit_index');
        Route::get('/lab/partial_pecah_kulit/{id}', [QcAdminController::class, 'partial_plan_hpp_pecah_kulit'])->name('lab.partial_plan_hpp_pecah_kulit');
        Route::get('/lab/edit_pecah_kulit', [QcAdminController::class, 'edit_plan_hpp_pecah_kulit'])->name('lab.edit_plan_hpp_pecah_kulit');
        Route::get('/lab/delete_plan_hpp_pecah_kulit/{id?}', [QcAdminController::class, 'delete_plan_hpp_pecah_kulit'])->name('lab.delete_plan_hpp_pecah_kulit');
        Route::post('/lab/simpan_plan_hpp_pecah_kulit', [QcAdminController::class, 'simpan_plan_hpp_pecah_kulit'])->name('lab.simpan_plan_hpp_pecah_kulit');

        // HPP Beras DS
        Route::get('/lab/plan_hpp_beras_ds', [QcAdminController::class, 'plan_hpp_beras_ds'])->name('lab.plan_hpp_beras_ds');
        Route::get('/lab/plan_hpp_beras_ds_index', [QcAdminController::class, 'plan_hpp_beras_ds_index'])->name('lab.plan_hpp_beras_ds_index');
        Route::get('/lab/partial_beras_ds/{id}', [QcAdminController::class, 'partial_plan_hpp_beras_ds'])->name('lab.partial_plan_hpp_beras_ds');
        Route::get('/lab/edit_beras_ds', [QcAdminController::class, 'edit_plan_hpp_beras_ds'])->name('lab.edit_plan_hpp');
        Route::get('/lab/delete_plan_hpp_beras_ds/{id?}', [QcAdminController::class, 'delete_plan_hpp_beras_ds'])->name('lab.delete_plan_hpp_beras_ds');
        Route::post('/lab/simpan_plan_hpp_beras_ds', [QcAdminController::class, 'simpan_plan_hpp_beras_ds'])->name('lab.simpan_plan_hpp_beras_ds');

        // Harga Atas Gabah Basah
        Route::get('/lab/harga_atas_gabah_basah', [QcAdminController::class, 'harga_atas_gabah_basah'])->name('lab.harga_atas_gabah_basah');
        Route::get('/lab/harga_atas_gabah_basah_index', [QcAdminController::class, 'harga_atas_gabah_basah_index'])->name('lab.harga_atas_gabah_basah_index');
        Route::get('/lab/show_harga_atas_gabah_basah/{id?}', [QcAdminController::class, 'show_harga_atas_gabah_basah'])->name('lab.show_harga_atas_gabah_basah');
        Route::post('/lab/update_harga_atas_gabah_basah/{id?}', [QcAdminController::class, 'update_harga_atas_gabah_basah'])->name('lab.update_harga_atas_gabah_basah');
        Route::post('/lab/store_harga_atas_gabah_basah', [QcAdminController::class, 'store_harga_atas_gabah_basah'])->name('lab.store_harga_atas_gabah_basah');
        Route::get('/lab/destroy_harga_atas_gabah_basah/{id?}', [QcAdminController::class, 'destroy_harga_atas_gabah_basah'])->name('lab.destroy_harga_atas_gabah_basah');

        // Harga Atas Gabah Kering
        Route::get('/lab/harga_atas_gabah_kering', [QcAdminController::class, 'harga_atas_gabah_kering'])->name('lab.harga_atas_gabah_kering');
        Route::get('/lab/harga_atas_gabah_kering_index', [QcAdminController::class, 'harga_atas_gabah_kering_index'])->name('lab.harga_atas_gabah_kering_index');
        Route::get('/lab/show_harga_atas_gabah_kering/{id?}', [QcAdminController::class, 'show_harga_atas_gabah_kering'])->name('lab.show_harga_atas_gabah_kering');
        Route::post('/lab/update_harga_atas_gabah_kering/{id?}', [QcAdminController::class, 'update_harga_atas_gabah_kering'])->name('lab.update_harga_atas_gabah_kering');
        Route::post('/lab/store_harga_atas_gabah_kering', [QcAdminController::class, 'store_harga_atas_gabah_kering'])->name('lab.store_harga_atas_gabah_kering');
        Route::get('/lab/destroy_harga_atas_gabah_kering/{id?}', [QcAdminController::class, 'destroy_harga_atas_gabah_kering'])->name('lab.destroy_harga_atas_gabah_kering');

        // Harga Atas Gabah PK
        Route::get('/lab/harga_atas_pecah_kulit', [QcAdminController::class, 'harga_atas_pecah_kulit'])->name('lab.harga_atas_pecah_kulit');
        Route::get('/lab/harga_atas_pecah_kulit_index', [QcAdminController::class, 'harga_atas_pecah_kulit_index'])->name('lab.harga_atas_pecah_kulit_index');
        Route::get('/lab/show_harga_atas_pecah_kulit/{id?}', [QcAdminController::class, 'show_harga_atas_pecah_kulit'])->name('lab.show_harga_atas_pecah_kulit');
        Route::post('/lab/update_harga_atas_pecah_kulit/{id?}', [QcAdminController::class, 'update_harga_atas_pecah_kulit'])->name('lab.update_harga_atas_pecah_kulit');
        Route::post('/lab/store_harga_atas_pecah_kulit', [QcAdminController::class, 'store_harga_atas_pecah_kulit'])->name('lab.store_harga_atas_pecah_kulit');
        Route::get('/lab/destroy_harga_atas_pecah_kulit/{id?}', [QcAdminController::class, 'destroy_harga_atas_pecah_kulit'])->name('lab.destroy_harga_atas_pecah_kulit');

        // Harga Atas DS
        Route::get('/lab/harga_atas_beras_ds', [QcAdminController::class, 'harga_atas_beras_ds'])->name('lab.harga_atas_beras_ds');
        Route::get('/lab/harga_atas_beras_ds_index', [QcAdminController::class, 'harga_atas_beras_ds_index'])->name('lab.harga_atas_beras_ds_index');
        Route::get('/lab/show_harga_atas_beras_ds/{id?}', [QcAdminController::class, 'show_harga_atas_beras_ds'])->name('lab.show_harga_atas_beras_ds');
        Route::post('/lab/update_harga_atas_beras_ds/{id?}', [QcAdminController::class, 'update_harga_atas_beras_ds'])->name('lab.update_harga_atas_beras_ds');
        Route::post('/lab/store_harga_atas_beras_ds', [QcAdminController::class, 'store_harga_atas_beras_ds'])->name('lab.store_harga_atas_beras_ds');
        Route::get('/lab/destroy_harga_atas_beras_ds/{id?}', [QcAdminController::class, 'destroy_harga_atas_beras_ds'])->name('lab.destroy_harga_atas_beras_ds');

        // Harga Potongan Gabah Basah
        Route::get('/lab/potongan_gabah_basah', [QcAdminController::class, 'potongan_gabah_basah'])->name('lab.potongan_gabah_basah');
        Route::get('/lab/potongan_gabah_basah_index', [QcAdminController::class, 'potongan_gabah_basah_index'])->name('lab.potongan_gabah_basah_index');
        Route::get('/lab/show_potongan_gabah_basah/{id?}', [QcAdminController::class, 'show_potongan_gabah_basah'])->name('lab.show_potongan_gabah_basah');
        Route::post('/lab/update_potongan_gabah_basah/{id?}', [QcAdminController::class, 'update_potongan_gabah_basah'])->name('lab.update_potongan_gabah_basah');
        Route::post('/lab/store_potongan_gabah_basah', [QcAdminController::class, 'store_potongan_gabah_basah'])->name('lab.store_potongan_gabah_basah');
        Route::get('/lab/destroy_potongan_gabah_basah/{id?}', [QcAdminController::class, 'destroy_potongan_gabah_basah'])->name('lab.destroy_potongan_gabah_basah');

        // Harga Potongan Gabah Kering
        Route::get('/lab/potongan_gabah_kering', [QcAdminController::class, 'potongan_gabah_kering'])->name('lab.potongan_gabah_kering');
        Route::get('/lab/potongan_gabah_kering_index', [QcAdminController::class, 'potongan_gabah_kering_index'])->name('lab.potongan_gabah_kering_index');
        Route::get('/lab/show_potongan_gabah_kering/{id?}', [QcAdminController::class, 'show_potongan_gabah_kering'])->name('lab.show_potongan_gabah_kering');
        Route::post('/lab/update_potongan_gabah_kering/{id?}', [QcAdminController::class, 'update_potongan_gabah_kering'])->name('lab.update_potongan_gabah_kering');
        Route::post('/lab/store_potongan_gabah_kering', [QcAdminController::class, 'store_potongan_gabah_kering'])->name('lab.store_potongan_gabah_kering');
        Route::get('/lab/destroy_potongan_gabah_kering/{id?}', [QcAdminController::class, 'destroy_potongan_gabah_kering'])->name('lab.destroy_potongan_gabah_kering');

        // Harga Potongan Gabah PK
        Route::get('/lab/potongan_pecah_kulit', [QcAdminController::class, 'potongan_pecah_kulit'])->name('lab.potongan_pecah_kulit');
        Route::get('/lab/potongan_pecah_kulit_index', [QcAdminController::class, 'potongan_pecah_kulit_index'])->name('lab.potongan_pecah_kulit_index');
        Route::get('/lab/show_potongan_pecah_kulit/{id?}', [QcAdminController::class, 'show_potongan_pecah_kulit'])->name('lab.show_potongan_pecah_kulit');
        Route::post('/lab/update_potongan_pecah_kulit/{id?}', [QcAdminController::class, 'update_potongan_pecah_kulit'])->name('lab.update_potongan_pecah_kulit');
        Route::post('/lab/store_potongan_pecah_kulit', [QcAdminController::class, 'store_potongan_pecah_kulit'])->name('lab.store_potongan_pecah_kulit');
        Route::get('/lab/destroy_potongan_pecah_kulit/{id?}', [QcAdminController::class, 'destroy_potongan_pecah_kulit'])->name('lab.destroy_potongan_pecah_kulit');

        // Harga Potongan Beras DS
        Route::get('/lab/potongan_beras_ds', [QcAdminController::class, 'potongan_beras_ds'])->name('lab.potongan_beras_ds');
        Route::get('/lab/potongan_beras_ds_index', [QcAdminController::class, 'potongan_beras_ds_index'])->name('lab.potongan_beras_ds_index');
        Route::get('/lab/show_potongan_beras_ds/{id?}', [QcAdminController::class, 'show_potongan_beras_ds'])->name('lab.show_potongan_beras_ds');
        Route::post('/lab/update_potongan_beras_ds/{id?}', [QcAdminController::class, 'update_potongan_beras_ds'])->name('lab.update_potongan_beras_ds');
        Route::post('/lab/store_potongan_beras_ds', [QcAdminController::class, 'store_potongan_beras_ds'])->name('lab.store_potongan_beras_ds');
        Route::get('/lab/destroy_potongan_beras_ds/{id?}', [QcAdminController::class, 'destroy_potongan_beras_ds'])->name('lab.destroy_potongan_beras_ds');

        // Harga Bawah Gabah Basah
        Route::get('/lab/harga_bawah_gabah_basah', [QcAdminController::class, 'harga_bawah_gabah_basah'])->name('lab.harga_bawah_gabah_basah');
        Route::get('/lab/harga_bawah_gabah_basah_index', [QcAdminController::class, 'harga_bawah_gabah_basah_index'])->name('lab.harga_bawah_gabah_basah_index');
        Route::get('/lab/show_harga_bawah_gabah_basah/{id?}', [QcAdminController::class, 'show_harga_bawah_gabah_basah'])->name('lab.show_harga_bawah_gabah_basah');
        Route::post('/lab/update_harga_bawah_gabah_basah/{id?}', [QcAdminController::class, 'update_harga_bawah_gabah_basah'])->name('lab.update_harga_bawah_gabah_basah');
        Route::post('/lab/store_harga_bawah_gabah_basah', [QcAdminController::class, 'store_harga_bawah_gabah_basah'])->name('lab.store_harga_bawah_gabah_basah');
        Route::get('/lab/destroy_harga_bawah_gabah_basah/{id?}', [QcAdminController::class, 'destroy_harga_bawah_gabah_basah'])->name('lab.destroy_harga_bawah_gabah_basah');

        // Harga Bawah Gabah Kering
        Route::get('/lab/harga_bawah_gabah_kering', [QcAdminController::class, 'harga_bawah_gabah_kering'])->name('lab.harga_bawah_gabah_kering');
        Route::get('/lab/harga_bawah_gabah_kering_index', [QcAdminController::class, 'harga_bawah_gabah_kering_index'])->name('lab.harga_bawah_gabah_kering_index');
        Route::get('/lab/show_harga_bawah/{id?}', [QcAdminController::class, 'show_harga_bawah'])->name('lab.show_harga_bawah');
        Route::post('/lab/update_harga_bawah_gabah_kering/{id?}', [QcAdminController::class, 'update_harga_bawah_gabah_kering'])->name('lab.update_harga_bawah_gabah_kering');
        Route::post('/lab/store_harga_bawah_gabah_kering', [QcAdminController::class, 'store_harga_bawah_gabah_kering'])->name('lab.store_harga_bawah_gabah_kering');
        Route::get('/lab/destroy_harga_bawah_gabah_kering/{id?}', [QcAdminController::class, 'destroy_harga_bawah_gabah_kering'])->name('lab.destroy_harga_bawah_gabah_kering');

        // Harga Bawah Gabah PK
        Route::get('/lab/harga_bawah_pecah_kulit', [QcAdminController::class, 'harga_bawah_pecah_kulit'])->name('lab.harga_bawah_pecah_kulit');
        Route::get('/lab/harga_bawah_pecah_kulit_index', [QcAdminController::class, 'harga_bawah_pecah_kulit_index'])->name('lab.harga_bawah_pecah_kulit_index');
        Route::get('/lab/show_harga_bawah/{id?}', [QcAdminController::class, 'show_harga_bawah'])->name('lab.show_harga_bawah');
        Route::post('/lab/update_harga_bawah_pecah_kulit/{id?}', [QcAdminController::class, 'update_harga_bawah_pecah_kulit'])->name('lab.update_harga_bawah_pecah_kulit');
        Route::post('/lab/store_harga_bawah_pecah_kulit', [QcAdminController::class, 'store_harga_bawah_pecah_kulit'])->name('lab.store_harga_bawah_pecah_kulit');
        Route::get('/lab/destroy_harga_bawah_pecah_kulit/{id?}', [QcAdminController::class, 'destroy_harga_bawah_pecah_kulit'])->name('lab.destroy_harga_bawah_pecah_kulit');

        // Harga Bawah Beras DS
        Route::get('/lab/harga_bawah_beras_ds', [QcAdminController::class, 'harga_bawah_beras_ds'])->name('lab.harga_bawah_beras_ds');
        Route::get('/lab/harga_bawah_beras_ds_index', [QcAdminController::class, 'harga_bawah_beras_ds_index'])->name('lab.harga_bawah_beras_ds_index');
        Route::get('/lab/show_harga_bawah/{id?}', [QcAdminController::class, 'show_harga_bawah'])->name('lab.show_harga_bawah');
        Route::post('/lab/update_harga_bawah_beras_ds/{id?}', [QcAdminController::class, 'update_harga_bawah_beras_ds'])->name('lab.update_harga_bawah_beras_ds');
        Route::post('/lab/store_harga_bawah_beras_ds', [QcAdminController::class, 'store_harga_bawah_beras_ds'])->name('lab.store_harga_bawah_beras_ds');
        Route::get('/lab/destroy_harga_bawah_beras_ds/{id?}', [QcAdminController::class, 'destroy_harga_bawah_beras_ds'])->name('lab.destroy_harga_bawah_beras_ds');

        // Parameter Lab Gabah Basah
        Route::get('/lab/parameter_gb', [QcAdminController::class, 'parameter_gb'])->name('lab.parameter_gb');
        Route::post('/lab/store_parameter_lab', [QcAdminController::class, 'store_parameter_lab_gb'])->name('lab.store_parameter_lab_gb');
        Route::get('/lab/parameter_lab_gb_index', [QcAdminController::class, 'parameter_lab_gb_index'])->name('lab.parameter_lab_gb_index');
        Route::get('/lab/show_parameter_gb/{id?}', [QcAdminController::class, 'show_parameter_gb'])->name('lab.show_parameter_gb');
        Route::get('/lab/destroy_parameter_lab_gb/{id?}', [QcAdminController::class, 'destroy_parameter_lab_gb'])->name('lab.destroy_parameter_lab_gb');
        Route::post('/lab/update_parameter_lab_gb/{id?}', [QcAdminController::class, 'update_parameter_lab_gb'])->name('lab.update_parameter_lab_gb');
        Route::post('/lab/simpan_parameter_lab_gb', [QcAdminController::class, 'simpan_parameter_lab_gb'])->name('lab.simpan_parameter_lab_gb');

        // ALERT
        Route::get('/lab/get_parameter_lab_pk_tabel_refraksi/{tanggal_po?}', [QcAdminController::class, 'get_parameter_lab_pk_tabel_refraksi'])->name('lab.get_parameter_lab_pk_tabel_refraksi');
        Route::get('/lab/get_parameter_lab_pk_tabel_reward/{tanggal_po?}', [QcAdminController::class, 'get_parameter_lab_pk_tabel_reward'])->name('lab.get_parameter_lab_pk_tabel_reward');
        Route::get('/lab/get_parameter_lab_pk_tabel_kualitas/{tanggal_po?}', [QcAdminController::class, 'get_parameter_lab_pk_tabel_kualitas'])->name('lab.get_parameter_lab_pk_tabel_kualitas');

        //Parameter Lab Gabah PK (Kadar Air)
        Route::post('/lab/parameter_lab_pk_kadar_air_update', [QcAdminController::class, 'parameter_lab_pk_kadar_air_update'])->name('lab.parameter_lab_pk_kadar_air_update');
        Route::post('/lab/parameter_lab_pk_kadar_air_store', [QcAdminController::class, 'parameter_lab_pk_kadar_air_store'])->name('lab.parameter_lab_pk_kadar_air_store');
        Route::get('/lab/parameter_lab_pk_kadar_air_index', [QcAdminController::class, 'parameter_lab_pk_kadar_air_index'])->name('lab.parameter_lab_pk_kadar_air_index');
        Route::get('/lab/parameter_lab_pk_kadar_air_show/{id?}', [QcAdminController::class, 'parameter_lab_pk_kadar_air_show'])->name('lab.parameter_lab_pk_kadar_air_show');
        Route::get('/lab/parameter_lab_pk_kadar_air_destroy/{id?}', [QcAdminController::class, 'parameter_lab_pk_kadar_air_destroy'])->name('lab.parameter_lab_pk_kadar_air_destroy');

        //Get Parameter Lab Beras PK (Kadar Air)
        Route::get('/lab/get_parameter_lab_pk_kadar_air/{tanggal_po?}', [QcAdminController::class, 'get_parameter_lab_pk_kadar_air'])->name('lab.get_parameter_lab_pk_kadar_air');

        //Parameter Lab Gabah PK (Hampa)
        Route::post('/lab/parameter_lab_pk_hampa', [QcAdminController::class, 'parameter_lab_pk_hampa'])->name('lab.parameter_lab_pk_hampa');
        Route::post('/lab/parameter_lab_pk_hampa_update', [QcAdminController::class, 'parameter_lab_pk_hampa_update'])->name('lab.parameter_lab_pk_hampa_update');
        Route::post('/lab/parameter_lab_hampa_store', [QcAdminController::class, 'parameter_lab_pk_hampa_store'])->name('lab.parameter_lab_pk_hampa_store');
        Route::get('/lab/parameter_lab_pk_hampa_index', [QcAdminController::class, 'parameter_lab_pk_hampa_index'])->name('lab.parameter_lab_pk_hampa_index');
        Route::get('/lab/parameter_lab_pk_hampa_show/{id?}', [QcAdminController::class, 'parameter_lab_pk_hampa_show'])->name('lab.parameter_lab_pk_hampa_show');
        Route::get('/lab/parameter_lab_pk_hampa_destroy/{id?}', [QcAdminController::class, 'parameter_lab_pk_hampa_destroy'])->name('lab.parameter_lab_pk_hampa_destroy');

        //Get Parameter Lab Beras PK (Hampa)
        Route::get('/lab/get_parameter_lab_pk_hampa/{tanggal_po?}', [QcAdminController::class, 'get_parameter_lab_pk_hampa'])->name('lab.get_parameter_lab_pk_hampa');

        //Parameter Lab Beras PK (TR)
        Route::post('/lab/parameter_lab_pk_tr', [QcAdminController::class, 'parameter_lab_pk_tr'])->name('lab.parameter_lab_pk_tr');
        Route::post('/lab/parameter_lab_pk_tr_update', [QcAdminController::class, 'parameter_lab_pk_tr_update'])->name('lab.parameter_lab_pk_tr_update');
        Route::post('/lab/parameter_lab_pk_tr_store', [QcAdminController::class, 'parameter_lab_pk_tr_store'])->name('lab.parameter_lab_pk_tr_store');
        Route::get('/lab/parameter_lab_pk_tr_index', [QcAdminController::class, 'parameter_lab_pk_tr_index'])->name('lab.parameter_lab_pk_tr_index');
        Route::get('/lab/parameter_lab_pk_tr_show/{id?}', [QcAdminController::class, 'parameter_lab_pk_tr_show'])->name('lab.parameter_lab_pk_tr_show');
        Route::get('/lab/parameter_lab_pk_tr_destroy/{id?}', [QcAdminController::class, 'parameter_lab_pk_tr_destroy'])->name('lab.parameter_lab_pk_tr_destroy');

        //Get Parameter Lab Beras PK (TR)
        Route::get('/lab/get_parameter_lab_pk_tr/{tanggal_po?}', [QcAdminController::class, 'get_parameter_lab_pk_tr'])->name('lab.get_parameter_lab_pk_tr');
        //Get Parameter Lab Kualitas Beras PK (TR)
        Route::get('/lab/get_parameter_lab_pk_tr_kualitas/{tanggal_po?}', [QcAdminController::class, 'get_parameter_lab_pk_tr_kualitas'])->name('lab.get_parameter_lab_pk_tr_kualitas');

        //Parameter Lab Beras PK (Katul)
        Route::post('/lab/parameter_lab_pk_katul', [QcAdminController::class, 'parameter_lab_pk_katul'])->name('lab.parameter_lab_pk_katul');
        Route::post('/lab/parameter_lab_pk_katul_update', [QcAdminController::class, 'parameter_lab_pk_katul_update'])->name('lab.parameter_lab_pk_katul_update');
        Route::post('/lab/parameter_lab_katul_store', [QcAdminController::class, 'parameter_lab_pk_katul_store'])->name('lab.parameter_lab_pk_katul_store');
        Route::get('/lab/parameter_lab_pk_katul_index', [QcAdminController::class, 'parameter_lab_pk_katul_index'])->name('lab.parameter_lab_pk_katul_index');
        Route::get('/lab/parameter_lab_pk_katul_show/{id?}', [QcAdminController::class, 'parameter_lab_pk_katul_show'])->name('lab.parameter_lab_pk_katul_show');
        Route::get('/lab/parameter_lab_pk_katul_destroy/{id?}', [QcAdminController::class, 'parameter_lab_pk_katul_destroy'])->name('lab.parameter_lab_pk_katul_destroy');

        //Parameter Lab Beras PK (Butiran Patah)
        Route::post('/lab/parameter_lab_pk_butiran_patah', [QcAdminController::class, 'parameter_lab_pk_butiran_patah'])->name('lab.parameter_lab_pk_butiran_patah');
        Route::post('/lab/parameter_lab_pk_butiran_patah_update', [QcAdminController::class, 'parameter_lab_pk_butiran_patah_update'])->name('lab.parameter_lab_pk_butiran_patah_update');
        Route::post('/lab/parameter_lab_pk_butiran_patah_store', [QcAdminController::class, 'parameter_lab_pk_butiran_patah_store'])->name('lab.parameter_lab_pk_butiran_patah_store');
        Route::get('/lab/parameter_lab_pk_butiran_patah_index', [QcAdminController::class, 'parameter_lab_pk_butiran_patah_index'])->name('lab.parameter_lab_pk_butiran_patah_index');
        Route::get('/lab/parameter_lab_pk_butiran_patah_show/{id?}', [QcAdminController::class, 'parameter_lab_pk_butiran_patah_show'])->name('lab.parameter_lab_pk_butiran_patah_show');
        Route::get('/lab/parameter_lab_pk_butiran_patah_destroy/{id?}', [QcAdminController::class, 'parameter_lab_pk_butiran_patah_destroy'])->name('lab.parameter_lab_pk_butiran_patah_destroy');

        //Get Parameter Lab Beras PK (Butiran Patah)
        Route::get('/lab/get_parameter_lab_pk_butiran_patah/{tanggal_po?}', [QcAdminController::class, 'get_parameter_lab_pk_butiran_patah'])->name('lab.get_parameter_lab_pk_butiran_patah');

        //Get Parameter Lab Kualitas
        Route::get('/lab/get_parameter_lab_pk_kualitas/{tanggal_po?}', [QcAdminController::class, 'get_parameter_lab_pk_kualitas'])->name('lab.get_parameter_lab_pk_kualitas');

        //Get Parameter Lab Beras PK (Katul)
        Route::get('/lab/get_parameter_lab_pk_katul/{tanggal_po?}', [QcAdminController::class, 'get_parameter_lab_pk_katul'])->name('lab.get_parameter_lab_pk_katul');

        // Parameter Lab PK
        Route::get('/lab/parameter_pk_refraksi', [QcAdminController::class, 'parameter_pk_refraksi'])->name('lab.parameter_pk_refraksi');
        Route::get('/lab/parameter_lab_pk_kualitas', [QcAdminController::class, 'parameter_lab_pk_kualitas'])->name('lab.parameter_lab_pk_kualitas');

        // Parameter Lab Beras DS
        Route::get('/lab/parameter_beras_ds', [QcAdminController::class, 'parameter_beras_ds'])->name('lab.parameter_beras_ds');

        // Parameter Lab Gabah Kering
        Route::get('/lab/parameter_gk', [QcAdminController::class, 'parameter_gk'])->name('lab.parameter_gk');

        //Parameter Lab Beras PK (Reward)
        Route::get('/lab/parameter_lab_pk_reward', [QcAdminController::class, 'parameter_lab_pk_reward'])->name('lab.parameter_lab_pk_reward');


        //Get Parameter Lab Beras PK (Reward Kadar Air)
        Route::get('/lab/get_parameter_lab_pk_reward_kadar_air/{tanggal_po?}', [QcAdminController::class, 'get_parameter_lab_pk_reward_kadar_air'])->name('lab.get_parameter_lab_pk_reward_kadar_air');
        //Parameter Lab Beras PK (Reward Kadar Air)
        Route::post('/lab/parameter_lab_pk_reward_kadar_air_update', [QcAdminController::class, 'parameter_lab_pk_reward_kadar_air_update'])->name('lab.parameter_lab_pk_reward_kadar_air_update');
        Route::post('/lab/parameter_lab_pk_reward_kadar_air_store', [QcAdminController::class, 'parameter_lab_pk_reward_kadar_air_store'])->name('lab.parameter_lab_pk_reward_kadar_air_store');
        Route::get('/lab/parameter_lab_pk_reward_kadar_air_index', [QcAdminController::class, 'parameter_lab_pk_reward_kadar_air_index'])->name('lab.parameter_lab_pk_reward_kadar_air_index');
        Route::get('/lab/parameter_lab_pk_reward_kadar_air_show/{id?}', [QcAdminController::class, 'parameter_lab_pk_reward_kadar_air_show'])->name('lab.parameter_lab_pk_reward_kadar_air_show');
        Route::get('/lab/parameter_lab_pk_reward_kadar_air_destroy/{id?}', [QcAdminController::class, 'parameter_lab_pk_reward_kadar_air_destroy'])->name('lab.parameter_lab_pk_reward_kadar_air_destroy');

        //Parameter Lab Beras PK (Reward Hampa)
        Route::post('/lab/parameter_lab_pk_reward_hampa_update', [QcAdminController::class, 'parameter_lab_pk_reward_hampa_update'])->name('lab.parameter_lab_pk_reward_hampa_update');
        Route::post('/lab/parameter_lab_pk_reward_hampa_store', [QcAdminController::class, 'parameter_lab_pk_reward_hampa_store'])->name('lab.parameter_lab_pk_reward_hampa_store');
        Route::get('/lab/parameter_lab_pk_reward_hampa_index', [QcAdminController::class, 'parameter_lab_pk_reward_hampa_index'])->name('lab.parameter_lab_pk_reward_hampa_index');
        Route::get('/lab/parameter_lab_pk_reward_hampa_show/{id?}', [QcAdminController::class, 'parameter_lab_pk_reward_hampa_show'])->name('lab.parameter_lab_pk_reward_hampa_show');
        Route::get('/lab/parameter_lab_pk_reward_hampa_destroy/{id?}', [QcAdminController::class, 'parameter_lab_pk_reward_hampa_destroy'])->name('lab.parameter_lab_pk_reward_hampa_destroy');

        //Get Parameter Lab Beras PK (Reward Hampa)
        Route::get('/lab/get_parameter_lab_pk_reward_hampa/{tanggal_po?}', [QcAdminController::class, 'get_parameter_lab_pk_reward_hampa'])->name('lab.get_parameter_lab_pk_reward_hampa');

        //Parameter Lab Beras PK (Reward TR)
        Route::post('/lab/parameter_lab_pk_reward_tr_update', [QcAdminController::class, 'parameter_lab_pk_reward_tr_update'])->name('lab.parameter_lab_pk_reward_tr_update');
        Route::post('/lab/parameter_lab_pk_reward_tr_store', [QcAdminController::class, 'parameter_lab_pk_reward_tr_store'])->name('lab.parameter_lab_pk_reward_tr_store');
        Route::get('/lab/parameter_lab_pk_reward_tr_index', [QcAdminController::class, 'parameter_lab_pk_reward_tr_index'])->name('lab.parameter_lab_pk_reward_tr_index');
        Route::get('/lab/parameter_lab_pk_reward_tr_show/{id?}', [QcAdminController::class, 'parameter_lab_pk_reward_tr_show'])->name('lab.parameter_lab_pk_reward_tr_show');
        Route::get('/lab/parameter_lab_pk_reward_tr_destroy/{id?}', [QcAdminController::class, 'parameter_lab_pk_reward_tr_destroy'])->name('lab.parameter_lab_pk_reward_tr_destroy');

        //Get Parameter Lab Beras PK (Reward TR)
        Route::get('/lab/get_parameter_lab_pk_reward_tr/{tanggal_po?}', [QcAdminController::class, 'get_parameter_lab_pk_reward_tr'])->name('lab.get_parameter_lab_pk_reward_tr');

        //Parameter Lab Beras PK (Reward Katul)
        Route::post('/lab/parameter_lab_pk_reward_katul_update', [QcAdminController::class, 'parameter_lab_pk_reward_katul_update'])->name('lab.parameter_lab_pk_reward_katul_update');
        Route::post('/lab/parameter_lab_pk_reward_katul_store', [QcAdminController::class, 'parameter_lab_pk_reward_katul_store'])->name('lab.parameter_lab_pk_reward_katul_store');
        Route::get('/lab/parameter_lab_pk_reward_katul_index', [QcAdminController::class, 'parameter_lab_pk_reward_katul_index'])->name('lab.parameter_lab_pk_reward_katul_index');
        Route::get('/lab/parameter_lab_pk_reward_katul_show/{id?}', [QcAdminController::class, 'parameter_lab_pk_reward_katul_show'])->name('lab.parameter_lab_pk_reward_katul_show');
        Route::get('/lab/parameter_lab_pk_reward_katul_destroy/{id?}', [QcAdminController::class, 'parameter_lab_pk_reward_katul_destroy'])->name('lab.parameter_lab_pk_reward_katul_destroy');

        //Get Parameter Lab Beras PK (Reward KATUL)
        Route::get('/lab/get_parameter_lab_pk_reward_katul/{tanggal_po?}', [QcAdminController::class, 'get_parameter_lab_pk_reward_katul'])->name('lab.get_parameter_lab_pk_reward_katul');

        //Parameter Lab Beras PK (Reward Butir Patah)
        Route::post('/lab/parameter_lab_pk_reward_butir_patah_update', [QcAdminController::class, 'parameter_lab_pk_reward_butir_patah_update'])->name('lab.parameter_lab_pk_reward_butir_patah_update');
        Route::post('/lab/parameter_lab_pk_reward_butir_patah_store', [QcAdminController::class, 'parameter_lab_pk_reward_butir_patah_store'])->name('lab.parameter_lab_pk_reward_butir_patah_store');
        Route::get('/lab/parameter_lab_pk_reward_butir_patah_index', [QcAdminController::class, 'parameter_lab_pk_reward_butir_patah_index'])->name('lab.parameter_lab_pk_reward_butir_patah_index');
        Route::get('/lab/parameter_lab_pk_reward_butir_patah_show/{id?}', [QcAdminController::class, 'parameter_lab_pk_reward_butir_patah_show'])->name('lab.parameter_lab_pk_reward_butir_patah_show');
        Route::get('/lab/parameter_lab_pk_reward_butir_patah_destroy/{id?}', [QcAdminController::class, 'parameter_lab_pk_reward_butir_patah_destroy'])->name('lab.parameter_lab_pk_reward_butir_patah_destroy');

        //Parameter Lab Beras PK (Kualitas)
        Route::post('/lab/parameter_lab_pk_kualitas_update', [QcAdminController::class, 'parameter_lab_pk_kualitas_update'])->name('lab.parameter_lab_pk_kualitas_update');
        Route::post('/lab/parameter_lab_pk_kualitas_store', [QcAdminController::class, 'parameter_lab_pk_kualitas_store'])->name('lab.parameter_lab_pk_kualitas_store');
        Route::get('/lab/parameter_lab_pk_kualitas_index', [QcAdminController::class, 'parameter_lab_pk_kualitas_index'])->name('lab.parameter_lab_pk_kualitas_index');
        Route::get('/lab/parameter_lab_pk_kualitas_show/{id?}', [QcAdminController::class, 'parameter_lab_pk_kualitas_show'])->name('lab.parameter_lab_pk_kualitas_show');
        Route::get('/lab/parameter_lab_pk_kualitas_destroy/{id?}', [QcAdminController::class, 'parameter_lab_pk_kualitas_destroy'])->name('lab.parameter_lab_pk_kualitas_destroy');

        //Get Parameter Lab Beras PK (Reward Butir Patah)
        Route::get('/lab/get_parameter_lab_pk_reward_butir_patah/{tanggal_po?}', [QcAdminController::class, 'get_parameter_lab_pk_reward_butir_patah'])->name('lab.get_parameter_lab_pk_reward_butir_patah');

        Route::post('/lab/download_output_lab1_excel', [QcAdminController::class, 'download_output_lab1_excel'])->name('lab.download_output_lab1_excel');
        Route::post('/lab/download_data_unload_excel', [QcAdminController::class, 'download_data_unload_excel'])->name('lab.download_data_unload_excel');
        Route::post('/lab/download_data_pending_excel', [QcAdminController::class, 'download_data_pending_excel'])->name('lab.download_data_pending_excel');
        Route::post('/lab/download_data_reject_excel', [QcAdminController::class, 'download_data_reject_excel'])->name('lab.download_data_reject_excel');
        Route::post('/lab/download_output_lab2_excel', [QcAdminController::class, 'download_output_lab2_excel'])->name('lab.download_output_lab2_excel');
        Route::post('/lab/download_output_lab2_pk_excel', [QcAdminController::class, 'download_output_lab2_pk_excel'])->name('lab.download_output_lab2_pk_excel');
        Route::post('/lab/download_onproses_lab2_excel', [QcAdminController::class, 'download_onproses_lab2_excel'])->name('lab.download_onproses_lab2_excel');
        Route::post('/lab/download_deal_lab2_excel', [QcAdminController::class, 'download_deal_lab2_excel'])->name('lab.download_deal_lab2_excel');
        Route::post('/lab/download_nego_lab2_excel', [QcAdminController::class, 'download_nego_lab2_excel'])->name('lab.download_nego_lab2_excel');

        //    ADMIN BONGKAR
        Route::get('/lab/data_bongkar', [QcAdminController::class, 'data_bongkar'])->name('lab.data_bongkar');
        // Data Antrian Bongkar
        Route::get('/lab/antrian_bongkar', [QcAdminController::class, 'antrian_bongkar'])->name('lab.antrian_bongkar');
        Route::get('/lab/getcountnotif_antrianbongkar', [QcAdminController::class, 'getcountnotif_antrianbongkar'])->name('lab.getcountnotif_antrianbongkar');
        Route::get('/lab/getcountnotif_prosesbongkar', [QcAdminController::class, 'getcountnotif_prosesbongkar'])->name('lab.getcountnotif_prosesbongkar');
        Route::get('/lab/getcountnotif_databongkar', [QcAdminController::class, 'getcountnotif_databongkar'])->name('lab.getcountnotif_databongkar');
        Route::get('/lab/getcountnotif_revisibongkar', [QcAdminController::class, 'getcountnotif_revisibongkar'])->name('lab.getcountnotif_revisibongkar');
        Route::get('/lab/data_antrian_bongkar', [QcAdminController::class, 'data_antrian_bongkar'])->name('lab.data_antrian_bongkar');
        Route::get('/lab/data_antrian_bongkar_pending_index', [QcAdminController::class, 'data_antrian_bongkar_pending_index'])->name('lab.data_antrian_bongkar_pending_index');
        Route::get('/lab/data_antrian_bongkar_pk_index', [QcAdminController::class, 'data_antrian_bongkar_pk_index'])->name('lab.data_antrian_bongkar_pk_index');
        Route::get('/lab/data_antrian_bongkar_ciherang_index', [QcAdminController::class, 'data_antrian_bongkar_ciherang_index'])->name('lab.data_antrian_bongkar_ciherang_index');
        Route::get('/lab/data_antrian_bongkar_pandan_wangi_index', [QcAdminController::class, 'data_antrian_bongkar_pandan_wangi_index'])->name('lab.data_antrian_bongkar_pandan_wangi_index');
        Route::get('/lab/data_antrian_bongkar_ketan_putih_index', [QcAdminController::class, 'data_antrian_bongkar_ketan_putih_index'])->name('lab.data_antrian_bongkar_ketan_putih_index');
        Route::get('/lab/data_antrian_bongkar_longgrain_index', [QcAdminController::class, 'data_antrian_bongkar_longgrain_index'])->name('lab.data_antrian_bongkar_longgrain_index');
        // Data Revisi
        Route::get('/lab/data_revisi_gb', [QcAdminController::class, 'data_revisi_gb'])->name('lab.data_revisi_gb');
        Route::get('/lab/data_revisi_gb_ciherang_index', [QcAdminController::class, 'data_revisi_gb_ciherang_index'])->name('lab.data_revisi_gb_ciherang_index');
        Route::get('/lab/data_revisi_gb_longgrain_index', [QcAdminController::class, 'data_revisi_gb_longgrain_index'])->name('lab.data_revisi_gb_longgrain_index');
        Route::get('/lab/data_revisi_gb_pandan_wangi_index', [QcAdminController::class, 'data_revisi_gb_pandan_wangi_index'])->name('lab.data_revisi_gb_pandan_wangi_index');
        Route::get('/lab/data_revisi_gb_ketan_putih_index', [QcAdminController::class, 'data_revisi_gb_ketan_putih_index'])->name('lab.data_revisi_gb_ketan_putih_index');
        Route::post('/lab/update_dtm', [QcAdminController::class, 'update_dtm'])->name('lab.update_dtm');
        Route::get('/lab/show_revisi_gb/{id?}', [QcAdminController::class, 'show_revisi_gb'])->name('lab.show_revisi_gb');


        //DATA PO MANAGER
        Route::get('/lab/data_po', [QcAdminController::class, 'data_po'])->name('lab.data_po');
        Route::get('/lab/data_po_deal', [QcAdminController::class, 'data_po_deal'])->name('lab.data_po_deal');
        Route::get('/lab/data_list_po/{id_bid?}', [QcAdminController::class, 'data_list_po'])->name('lab.data_list_po');
        Route::get('/lab/bid_gb_index', [QcAdminController::class, 'bid_gb_index'])->name('lab.bid_gb_index');
        Route::get('/lab/bid_pk_index', [QcAdminController::class, 'bid_pk_index'])->name('lab.bid_pk_index');
        Route::get('/lab/bid_ds_index', [QcAdminController::class, 'bid_ds_index'])->name('lab.bid_ds_index');
        Route::get('/lab/data_bongkar_gb_utara_index', [QcAdminController::class, 'data_bongkar_gb_utara_index'])->name('lab.data_bongkar_gb_utara_index');
        Route::get('/lab/data_bongkar_gb_selatan_index', [QcAdminController::class, 'data_bongkar_gb_selatan_index'])->name('lab.data_bongkar_gb_selatan_index');
        Route::get('/lab/data_bongkar_pk_index', [QcAdminController::class, 'data_bongkar_pk_index'])->name('lab.data_bongkar_pk_index');
        Route::get('/lab/getcount_databongkar', [QcAdminController::class, 'getcount_databongkar'])->name('lab.getcount_databongkar');
        Route::get('/lab/getcount_datasourchingdeal', [QcAdminController::class, 'getcount_datasourchingdeal'])->name('lab.getcount_datasourchingdeal');
        Route::get('/lab/data_list_index/{id?}', [QcAdminController::class, 'data_list_index'])->name('lab.data_list_index');
        Route::get('/lab/data_sourching_deal_gb_longgrain_index', [QcAdminController::class, 'data_sourching_deal_gb_longgrain_index'])->name('lab.data_sourching_deal_gb_longgrain_index');
        Route::get('/lab/data_sourching_deal_gb_pandan_wangi_index', [QcAdminController::class, 'data_sourching_deal_gb_pandan_wangi_index'])->name('lab.data_sourching_deal_gb_pandan_wangi_index');
        Route::get('/lab/data_sourching_deal_gb_ketan_putih_index', [QcAdminController::class, 'data_sourching_deal_gb_ketan_putih_index'])->name('lab.data_sourching_deal_gb_ketan_putih_index');
        Route::post('/lab/download_data_sourching_deal_gb_excel', [QcAdminController::class, 'download_data_sourching_deal_gb_excel'])->name('lab.download_data_sourching_deal_gb_excel');
        Route::get('/lab/data_sourching_deal_pk_index', [QcAdminController::class, 'data_sourching_deal_pk_index'])->name('lab.data_sourching_deal_pk_index');
        Route::get('/lab/getcountnotif_data_sourching_deal', [QcAdminController::class, 'getcountnotif_data_sourching_deal'])->name('lab.getcountnotif_data_sourching_deal');
        Route::get('/lab/get_notifikasilab', [QcAdminController::class, 'get_notifikasilab'])->name('lab.get_notifikasilab');
        Route::get('/lab/set_notifikasilab/', [QcAdminController::class, 'set_notifikasilab'])->name('lab.set_notifikasilab');
        Route::get('/lab/new_notifikasilab/', [QcAdminController::class, 'new_notifikasilab'])->name('lab.new_notifikasilab');
        Route::get('/lab/get_notif_qc_all', [QcAdminController::class, 'get_notif_qc_all'])->name('lab.get_notif_qc_all');
        Route::get('/lab/get_notif_qc_all_index', [QcAdminController::class, 'get_notif_qc_all_index'])->name('lab.get_notif_qc_all_index');
        require('api_qclab1.php');
        require('api_qclab2.php');
    });

    //SPV
    Route::middleware(['guest:spv', 'PreventBackHistory'])->group(function () {
        Route::view('/spv/login', 'dashboard.admin_spvqc.login')->name('spv.login');
        Route::post('/spv/check', [SpvQcAdminController::class, 'check'])->name('spv.check');
    });

    Route::middleware(['auth:spv', 'PreventBackHistory'])->group(function () {
        Route::view('/spv/home', 'dashboard.admin_spvqc.home')->name('spv.home');
        Route::get('/account_spv', [SpvQcAdminController::class, 'account_spv'])->name('spv.account_spv');
        Route::post('/account_update', [SpvQcAdminController::class, 'account_update'])->name('spv.account_update');
        Route::post('/spv/spv_logout', [SpvQcAdminController::class, 'spv_logout'])->name('spv.spv_logout');

        // Parameter Lab 
        // HPP Gabah Basah
        Route::get('/spv/plan_hpp_gabah_basah', [SpvQcAdminController::class, 'plan_hpp_gabah_basah'])->name('spv.plan_hpp_gabah_basah');
        Route::get('/spv/plan_hpp_gabah_basah_ciherang_index', [SpvQcAdminController::class, 'plan_hpp_gabah_basah_ciherang_index'])->name('spv.plan_hpp_gabah_basah_ciherang_index');
        Route::get('/spv/plan_hpp_gabah_basah_longgrain_index', [SpvQcAdminController::class, 'plan_hpp_gabah_basah_longgrain_index'])->name('spv.plan_hpp_gabah_basah_longgrain_index');
        Route::get('/spv/plan_hpp_gabah_basah_pandanwangi_index', [SpvQcAdminController::class, 'plan_hpp_gabah_basah_pandanwangi_index'])->name('spv.plan_hpp_gabah_basah_pandanwangi_index');
        Route::get('/spv/plan_hpp_gabah_basah_ketanputih_index', [SpvQcAdminController::class, 'plan_hpp_gabah_basah_ketanputih_index'])->name('spv.plan_hpp_gabah_basah_ketanputih_index');
        Route::get('/spv/partial_gabah_basah/{id}', [SpvQcAdminController::class, 'partial_plan_hpp_gabah_basah'])->name('spv.partial_plan_hpp_gabah_basah');
        Route::get('/spv/edit_gabah_basah', [SpvQcAdminController::class, 'edit_plan_hpp_gabah_basah'])->name('spv.edit_plan_hpp_gabah_basah');
        Route::get('/spv/delete_plan_hpp_gabah_basah/{id?}', [SpvQcAdminController::class, 'delete_plan_hpp_gabah_basah'])->name('spv.delete_plan_hpp_gabah_basah');
        Route::post('/spv/simpan_plan_hpp_gabah_basah', [SpvQcAdminController::class, 'simpan_plan_hpp_gabah_basah'])->name('spv.simpan_plan_hpp_gabah_basah');

        // HPP Gabah Kering
        Route::get('/spv/plan_hpp_gabah_kering', [SpvQcAdminController::class, 'plan_hpp_gabah_kering'])->name('spv.plan_hpp_gabah_kering');
        Route::get('/spv/plan_hpp_gabah_kering_index', [SpvQcAdminController::class, 'plan_hpp_gabah_kering_index'])->name('spv.plan_hpp_gabah_kering_index');
        Route::get('/spv/partial_gabah_kering/{id}', [SpvQcAdminController::class, 'partial_plan_hpp_gabah_kering'])->name('spv.partial_plan_hpp_gabah_kering');
        Route::get('/spv/edit_gabah_kering', [SpvQcAdminController::class, 'edit_plan_hpp_gabah_kering'])->name('spv.edit_plan_hpp_gabah_kering');
        Route::get('/spv/delete_plan_hpp_gabah_kering/{id?}', [SpvQcAdminController::class, 'delete_plan_hpp_gabah_kering'])->name('spv.delete_plan_hpp_gabah_kering');
        Route::post('/spv/simpan_plan_hpp_gabah_kering', [SpvQcAdminController::class, 'simpan_plan_hpp_gabah_kering'])->name('spv.simpan_plan_hpp_gabah_kering');

        // HPP Gabah PK
        Route::get('/spv/plan_hpp_pecah_kulit', [SpvQcAdminController::class, 'plan_hpp_pecah_kulit'])->name('spv.plan_hpp_pecah_kulit');
        Route::get('/spv/plan_hpp_pecah_kulit_index', [SpvQcAdminController::class, 'plan_hpp_pecah_kulit_index'])->name('spv.plan_hpp_pecah_kulit_index');
        Route::get('/spv/partial_pecah_kulit/{id}', [SpvQcAdminController::class, 'partial_plan_hpp_pecah_kulit'])->name('spv.partial_plan_hpp_pecah_kulit');
        Route::get('/spv/edit_pecah_kulit', [SpvQcAdminController::class, 'edit_plan_hpp_pecah_kulit'])->name('spv.edit_plan_hpp_pecah_kulit');
        Route::get('/spv/delete_plan_hpp_pecah_kulit/{id?}', [SpvQcAdminController::class, 'delete_plan_hpp_pecah_kulit'])->name('spv.delete_plan_hpp_pecah_kulit');
        Route::post('/spv/simpan_plan_hpp_pecah_kulit', [SpvQcAdminController::class, 'simpan_plan_hpp_pecah_kulit'])->name('spv.simpan_plan_hpp_pecah_kulit');

        // HPP Beras DS
        Route::get('/spv/plan_hpp_beras_ds', [SpvQcAdminController::class, 'plan_hpp_beras_ds'])->name('spv.plan_hpp_beras_ds');
        Route::get('/spv/plan_hpp_beras_ds_index', [SpvQcAdminController::class, 'plan_hpp_beras_ds_index'])->name('spv.plan_hpp_beras_ds_index');
        Route::get('/spv/partial_beras_ds/{id}', [SpvQcAdminController::class, 'partial_plan_hpp_beras_ds'])->name('spv.partial_plan_hpp_beras_ds');
        Route::get('/spv/edit_beras_ds', [SpvQcAdminController::class, 'edit_plan_hpp_beras_ds'])->name('spv.edit_plan_hpp');
        Route::get('/spv/delete_plan_hpp_beras_ds/{id?}', [SpvQcAdminController::class, 'delete_plan_hpp_beras_ds'])->name('spv.delete_plan_hpp_beras_ds');
        Route::post('/spv/simpan_plan_hpp_beras_ds', [SpvQcAdminController::class, 'simpan_plan_hpp_beras_ds'])->name('spv.simpan_plan_hpp_beras_ds');

        // Harga Atas Gabah Basah
        Route::get('/spv/harga_atas_gabah_basah', [SpvQcAdminController::class, 'harga_atas_gabah_basah'])->name('spv.harga_atas_gabah_basah');
        Route::get('/spv/harga_atas_gabah_basah_index', [SpvQcAdminController::class, 'harga_atas_gabah_basah_index'])->name('spv.harga_atas_gabah_basah_index');
        Route::get('/spv/show_harga_atas_gabah_basah/{id?}', [SpvQcAdminController::class, 'show_harga_atas_gabah_basah'])->name('spv.show_harga_atas_gabah_basah');
        Route::post('/spv/update_harga_atas_gabah_basah/{id?}', [SpvQcAdminController::class, 'update_harga_atas_gabah_basah'])->name('spv.update_harga_atas_gabah_basah');
        Route::post('/spv/store_harga_atas_gabah_basah', [SpvQcAdminController::class, 'store_harga_atas_gabah_basah'])->name('spv.store_harga_atas_gabah_basah');
        Route::get('/spv/destroy_harga_atas_gabah_basah/{id?}', [SpvQcAdminController::class, 'destroy_harga_atas_gabah_basah'])->name('spv.destroy_harga_atas_gabah_basah');

        // Harga Atas Gabah Kering
        Route::get('/spv/harga_atas_gabah_kering', [SpvQcAdminController::class, 'harga_atas_gabah_kering'])->name('spv.harga_atas_gabah_kering');
        Route::get('/spv/harga_atas_gabah_kering_index', [SpvQcAdminController::class, 'harga_atas_gabah_kering_index'])->name('spv.harga_atas_gabah_kering_index');
        Route::get('/spv/show_harga_atas_gabah_kering/{id?}', [SpvQcAdminController::class, 'show_harga_atas_gabah_kering'])->name('spv.show_harga_atas_gabah_kering');
        Route::post('/spv/update_harga_atas_gabah_kering/{id?}', [SpvQcAdminController::class, 'update_harga_atas_gabah_kering'])->name('spv.update_harga_atas_gabah_kering');
        Route::post('/spv/store_harga_atas_gabah_kering', [SpvQcAdminController::class, 'store_harga_atas_gabah_kering'])->name('spv.store_harga_atas_gabah_kering');
        Route::get('/spv/destroy_harga_atas_gabah_kering/{id?}', [SpvQcAdminController::class, 'destroy_harga_atas_gabah_kering'])->name('spv.destroy_harga_atas_gabah_kering');

        // Harga Atas Gabah PK
        Route::get('/spv/harga_atas_pecah_kulit', [SpvQcAdminController::class, 'harga_atas_pecah_kulit'])->name('spv.harga_atas_pecah_kulit');
        Route::get('/spv/harga_atas_pecah_kulit_index', [SpvQcAdminController::class, 'harga_atas_pecah_kulit_index'])->name('spv.harga_atas_pecah_kulit_index');
        Route::get('/spv/show_harga_atas_pecah_kulit/{id?}', [SpvQcAdminController::class, 'show_harga_atas_pecah_kulit'])->name('spv.show_harga_atas_pecah_kulit');
        Route::post('/spv/update_harga_atas_pecah_kulit/{id?}', [SpvQcAdminController::class, 'update_harga_atas_pecah_kulit'])->name('spv.update_harga_atas_pecah_kulit');
        Route::post('/spv/store_harga_atas_pecah_kulit', [SpvQcAdminController::class, 'store_harga_atas_pecah_kulit'])->name('spv.store_harga_atas_pecah_kulit');
        Route::get('/spv/destroy_harga_atas_pecah_kulit/{id?}', [SpvQcAdminController::class, 'destroy_harga_atas_pecah_kulit'])->name('spv.destroy_harga_atas_pecah_kulit');

        // Harga Atas DS
        Route::get('/spv/harga_atas_beras_ds', [SpvQcAdminController::class, 'harga_atas_beras_ds'])->name('spv.harga_atas_beras_ds');
        Route::get('/spv/harga_atas_beras_ds_index', [SpvQcAdminController::class, 'harga_atas_beras_ds_index'])->name('spv.harga_atas_beras_ds_index');
        Route::get('/spv/show_harga_atas_beras_ds/{id?}', [SpvQcAdminController::class, 'show_harga_atas_beras_ds'])->name('spv.show_harga_atas_beras_ds');
        Route::post('/spv/update_harga_atas_beras_ds/{id?}', [SpvQcAdminController::class, 'update_harga_atas_beras_ds'])->name('spv.update_harga_atas_beras_ds');
        Route::post('/spv/store_harga_atas_beras_ds', [SpvQcAdminController::class, 'store_harga_atas_beras_ds'])->name('spv.store_harga_atas_beras_ds');
        Route::get('/spv/destroy_harga_atas_beras_ds/{id?}', [SpvQcAdminController::class, 'destroy_harga_atas_beras_ds'])->name('spv.destroy_harga_atas_beras_ds');

        // Harga Potongan Gabah Basah
        Route::get('/spv/potongan_gabah_basah', [SpvQcAdminController::class, 'potongan_gabah_basah'])->name('spv.potongan_gabah_basah');
        Route::get('/spv/potongan_gabah_basah_index', [SpvQcAdminController::class, 'potongan_gabah_basah_index'])->name('spv.potongan_gabah_basah_index');
        Route::get('/spv/show_potongan_gabah_basah/{id?}', [SpvQcAdminController::class, 'show_potongan_gabah_basah'])->name('spv.show_potongan_gabah_basah');
        Route::post('/spv/update_potongan_gabah_basah/{id?}', [SpvQcAdminController::class, 'update_potongan_gabah_basah'])->name('spv.update_potongan_gabah_basah');
        Route::post('/spv/store_potongan_gabah_basah', [SpvQcAdminController::class, 'store_potongan_gabah_basah'])->name('spv.store_potongan_gabah_basah');
        Route::get('/spv/destroy_potongan_gabah_basah/{id?}', [SpvQcAdminController::class, 'destroy_potongan_gabah_basah'])->name('spv.destroy_potongan_gabah_basah');

        // Harga Potongan Gabah Kering
        Route::get('/spv/potongan_gabah_kering', [SpvQcAdminController::class, 'potongan_gabah_kering'])->name('spv.potongan_gabah_kering');
        Route::get('/spv/potongan_gabah_kering_index', [SpvQcAdminController::class, 'potongan_gabah_kering_index'])->name('spv.potongan_gabah_kering_index');
        Route::get('/spv/show_potongan_gabah_kering/{id?}', [SpvQcAdminController::class, 'show_potongan_gabah_kering'])->name('spv.show_potongan_gabah_kering');
        Route::post('/spv/update_potongan_gabah_kering/{id?}', [SpvQcAdminController::class, 'update_potongan_gabah_kering'])->name('spv.update_potongan_gabah_kering');
        Route::post('/spv/store_potongan_gabah_kering', [SpvQcAdminController::class, 'store_potongan_gabah_kering'])->name('spv.store_potongan_gabah_kering');
        Route::get('/spv/destroy_potongan_gabah_kering/{id?}', [SpvQcAdminController::class, 'destroy_potongan_gabah_kering'])->name('spv.destroy_potongan_gabah_kering');

        // Harga Potongan Gabah PK
        Route::get('/spv/potongan_pecah_kulit', [SpvQcAdminController::class, 'potongan_pecah_kulit'])->name('spv.potongan_pecah_kulit');
        Route::get('/spv/potongan_pecah_kulit_index', [SpvQcAdminController::class, 'potongan_pecah_kulit_index'])->name('spv.potongan_pecah_kulit_index');
        Route::get('/spv/show_potongan_pecah_kulit/{id?}', [SpvQcAdminController::class, 'show_potongan_pecah_kulit'])->name('spv.show_potongan_pecah_kulit');
        Route::post('/spv/update_potongan_pecah_kulit/{id?}', [SpvQcAdminController::class, 'update_potongan_pecah_kulit'])->name('spv.update_potongan_pecah_kulit');
        Route::post('/spv/store_potongan_pecah_kulit', [SpvQcAdminController::class, 'store_potongan_pecah_kulit'])->name('spv.store_potongan_pecah_kulit');
        Route::get('/spv/destroy_potongan_pecah_kulit/{id?}', [SpvQcAdminController::class, 'destroy_potongan_pecah_kulit'])->name('spv.destroy_potongan_pecah_kulit');

        // Harga Potongan Beras DS
        Route::get('/spv/potongan_beras_ds', [SpvQcAdminController::class, 'potongan_beras_ds'])->name('spv.potongan_beras_ds');
        Route::get('/spv/potongan_beras_ds_index', [SpvQcAdminController::class, 'potongan_beras_ds_index'])->name('spv.potongan_beras_ds_index');
        Route::get('/spv/show_potongan_beras_ds/{id?}', [SpvQcAdminController::class, 'show_potongan_beras_ds'])->name('spv.show_potongan_beras_ds');
        Route::post('/spv/update_potongan_beras_ds/{id?}', [SpvQcAdminController::class, 'update_potongan_beras_ds'])->name('spv.update_potongan_beras_ds');
        Route::post('/spv/store_potongan_beras_ds', [SpvQcAdminController::class, 'store_potongan_beras_ds'])->name('spv.store_potongan_beras_ds');
        Route::get('/spv/destroy_potongan_beras_ds/{id?}', [SpvQcAdminController::class, 'destroy_potongan_beras_ds'])->name('spv.destroy_potongan_beras_ds');

        // Harga Bawah Gabah Basah
        Route::get('/spv/harga_bawah_gabah_basah', [SpvQcAdminController::class, 'harga_bawah_gabah_basah'])->name('spv.harga_bawah_gabah_basah');
        Route::get('/spv/harga_bawah_gabah_basah_index', [SpvQcAdminController::class, 'harga_bawah_gabah_basah_index'])->name('spv.harga_bawah_gabah_basah_index');
        Route::get('/spv/show_harga_bawah_gabah_basah/{id?}', [SpvQcAdminController::class, 'show_harga_bawah_gabah_basah'])->name('spv.show_harga_bawah_gabah_basah');
        Route::post('/spv/update_harga_bawah_gabah_basah/{id?}', [SpvQcAdminController::class, 'update_harga_bawah_gabah_basah'])->name('spv.update_harga_bawah_gabah_basah');
        Route::post('/spv/store_harga_bawah_gabah_basah', [SpvQcAdminController::class, 'store_harga_bawah_gabah_basah'])->name('spv.store_harga_bawah_gabah_basah');
        Route::get('/spv/destroy_harga_bawah_gabah_basah/{id?}', [SpvQcAdminController::class, 'destroy_harga_bawah_gabah_basah'])->name('spv.destroy_harga_bawah_gabah_basah');

        // Harga Bawah Gabah Kering
        Route::get('/spv/harga_bawah_gabah_kering', [SpvQcAdminController::class, 'harga_bawah_gabah_kering'])->name('spv.harga_bawah_gabah_kering');
        Route::get('/spv/harga_bawah_gabah_kering_index', [SpvQcAdminController::class, 'harga_bawah_gabah_kering_index'])->name('spv.harga_bawah_gabah_kering_index');
        Route::get('/spv/show_harga_bawah/{id?}', [SpvQcAdminController::class, 'show_harga_bawah'])->name('spv.show_harga_bawah');
        Route::post('/spv/update_harga_bawah_gabah_kering/{id?}', [SpvQcAdminController::class, 'update_harga_bawah_gabah_kering'])->name('spv.update_harga_bawah_gabah_kering');
        Route::post('/spv/store_harga_bawah_gabah_kering', [SpvQcAdminController::class, 'store_harga_bawah_gabah_kering'])->name('spv.store_harga_bawah_gabah_kering');
        Route::get('/spv/destroy_harga_bawah_gabah_kering/{id?}', [SpvQcAdminController::class, 'destroy_harga_bawah_gabah_kering'])->name('spv.destroy_harga_bawah_gabah_kering');

        // Harga Bawah Gabah PK
        Route::get('/spv/harga_bawah_pecah_kulit', [SpvQcAdminController::class, 'harga_bawah_pecah_kulit'])->name('spv.harga_bawah_pecah_kulit');
        Route::get('/spv/harga_bawah_pecah_kulit_index', [SpvQcAdminController::class, 'harga_bawah_pecah_kulit_index'])->name('spv.harga_bawah_pecah_kulit_index');
        Route::get('/spv/show_harga_bawah/{id?}', [SpvQcAdminController::class, 'show_harga_bawah'])->name('spv.show_harga_bawah');
        Route::post('/spv/update_harga_bawah_pecah_kulit/{id?}', [SpvQcAdminController::class, 'update_harga_bawah_pecah_kulit'])->name('spv.update_harga_bawah_pecah_kulit');
        Route::post('/spv/store_harga_bawah_pecah_kulit', [SpvQcAdminController::class, 'store_harga_bawah_pecah_kulit'])->name('spv.store_harga_bawah_pecah_kulit');
        Route::get('/spv/destroy_harga_bawah_pecah_kulit/{id?}', [SpvQcAdminController::class, 'destroy_harga_bawah_pecah_kulit'])->name('spv.destroy_harga_bawah_pecah_kulit');

        // Harga Bawah Beras DS
        Route::get('/spv/harga_bawah_beras_ds', [SpvQcAdminController::class, 'harga_bawah_beras_ds'])->name('spv.harga_bawah_beras_ds');
        Route::get('/spv/harga_bawah_beras_ds_index', [SpvQcAdminController::class, 'harga_bawah_beras_ds_index'])->name('spv.harga_bawah_beras_ds_index');
        Route::get('/spv/show_harga_bawah/{id?}', [SpvQcAdminController::class, 'show_harga_bawah'])->name('spv.show_harga_bawah');
        Route::post('/spv/update_harga_bawah_beras_ds/{id?}', [SpvQcAdminController::class, 'update_harga_bawah_beras_ds'])->name('spv.update_harga_bawah_beras_ds');
        Route::post('/spv/store_harga_bawah_beras_ds', [SpvQcAdminController::class, 'store_harga_bawah_beras_ds'])->name('spv.store_harga_bawah_beras_ds');
        Route::get('/spv/destroy_harga_bawah_beras_ds/{id?}', [SpvQcAdminController::class, 'destroy_harga_bawah_beras_ds'])->name('spv.destroy_harga_bawah_beras_ds');

        // Parameter Lab Gabah Basah
        Route::get('/spv/parameter_gb', [SpvQcAdminController::class, 'parameter_gb'])->name('spv.parameter_gb');
        Route::post('/spv/store_parameter_lab', [SpvQcAdminController::class, 'store_parameter_lab_gb'])->name('spv.store_parameter_lab_gb');
        Route::get('/spv/parameter_lab_gb_index', [SpvQcAdminController::class, 'parameter_lab_gb_index'])->name('spv.parameter_lab_gb_index');
        Route::get('/spv/show_parameter_gb/{id?}', [SpvQcAdminController::class, 'show_parameter_gb'])->name('spv.show_parameter_gb');
        Route::get('/spv/destroy_parameter_lab_gb/{id?}', [SpvQcAdminController::class, 'destroy_parameter_lab_gb'])->name('spv.destroy_parameter_lab_gb');
        Route::post('/spv/update_parameter_lab_gb/{id?}', [SpvQcAdminController::class, 'update_parameter_lab_gb'])->name('spv.update_parameter_lab_gb');
        Route::post('/spv/simpan_parameter_lab_gb', [SpvQcAdminController::class, 'simpan_parameter_lab_gb'])->name('spv.simpan_parameter_lab_gb');

        //Parameter Lab BERAS PK UPDATE PO
        Route::post('/spv/parameter_lab_pk_refraksi_update', [SpvQcAdminController::class, 'parameter_lab_pk_refraksi_update'])->name('spv.parameter_lab_pk_refraksi_update');
        Route::post('/spv/parameter_lab_pk_reward_update', [SpvQcAdminController::class, 'parameter_lab_pk_reward_update'])->name('spv.parameter_lab_pk_reward_update');
        Route::post('/spv/parameter_lab_pk_kualitas_po_update', [SpvQcAdminController::class, 'parameter_lab_pk_kualitas_po_update'])->name('spv.parameter_lab_pk_kualitas_po_update');

        //Parameter Lab Gabah PK (Kadar Air)
        Route::post('/spv/parameter_lab_pk_kadar_air_update', [SpvQcAdminController::class, 'parameter_lab_pk_kadar_air_update'])->name('spv.parameter_lab_pk_kadar_air_update');
        Route::post('/spv/parameter_lab_pk_kadar_air_store', [SpvQcAdminController::class, 'parameter_lab_pk_kadar_air_store'])->name('spv.parameter_lab_pk_kadar_air_store');
        Route::get('/spv/parameter_lab_pk_kadar_air_index', [SpvQcAdminController::class, 'parameter_lab_pk_kadar_air_index'])->name('spv.parameter_lab_pk_kadar_air_index');
        Route::get('/spv/parameter_lab_pk_kadar_air_show/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_kadar_air_show'])->name('spv.parameter_lab_pk_kadar_air_show');
        Route::get('/spv/parameter_lab_pk_kadar_air_destroy/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_kadar_air_destroy'])->name('spv.parameter_lab_pk_kadar_air_destroy');

        //Get Parameter Lab Beras PK (Kadar Air)
        Route::get('/spv/get_parameter_lab_pk_kadar_air/{tanggal_po?}', [SpvQcAdminController::class, 'get_parameter_lab_pk_kadar_air'])->name('spv.get_parameter_lab_pk_kadar_air');

        //Parameter Lab Gabah PK (Hampa)
        Route::post('/spv/parameter_lab_pk_hampa', [SpvQcAdminController::class, 'parameter_lab_pk_hampa'])->name('spv.parameter_lab_pk_hampa');
        Route::post('/spv/parameter_lab_pk_hampa_update', [SpvQcAdminController::class, 'parameter_lab_pk_hampa_update'])->name('spv.parameter_lab_pk_hampa_update');
        Route::post('/spv/parameter_lab_hampa_store', [SpvQcAdminController::class, 'parameter_lab_pk_hampa_store'])->name('spv.parameter_lab_pk_hampa_store');
        Route::get('/spv/parameter_lab_pk_hampa_index', [SpvQcAdminController::class, 'parameter_lab_pk_hampa_index'])->name('spv.parameter_lab_pk_hampa_index');
        Route::get('/spv/parameter_lab_pk_hampa_show/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_hampa_show'])->name('spv.parameter_lab_pk_hampa_show');
        Route::get('/spv/parameter_lab_pk_hampa_destroy/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_hampa_destroy'])->name('spv.parameter_lab_pk_hampa_destroy');

        //Get Parameter Lab Beras PK (Hampa)
        Route::get('/spv/get_parameter_lab_pk_hampa/{tanggal_po?}', [SpvQcAdminController::class, 'get_parameter_lab_pk_hampa'])->name('spv.get_parameter_lab_pk_hampa');

        //Parameter Lab Beras PK (TR)
        Route::post('/spv/parameter_lab_pk_tr', [SpvQcAdminController::class, 'parameter_lab_pk_tr'])->name('spv.parameter_lab_pk_tr');
        Route::post('/spv/parameter_lab_pk_tr_update', [SpvQcAdminController::class, 'parameter_lab_pk_tr_update'])->name('spv.parameter_lab_pk_tr_update');
        Route::post('/spv/parameter_lab_pk_tr_store', [SpvQcAdminController::class, 'parameter_lab_pk_tr_store'])->name('spv.parameter_lab_pk_tr_store');
        Route::get('/spv/parameter_lab_pk_tr_index', [SpvQcAdminController::class, 'parameter_lab_pk_tr_index'])->name('spv.parameter_lab_pk_tr_index');
        Route::get('/spv/parameter_lab_pk_tr_show/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_tr_show'])->name('spv.parameter_lab_pk_tr_show');
        Route::get('/spv/parameter_lab_pk_tr_destroy/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_tr_destroy'])->name('spv.parameter_lab_pk_tr_destroy');

        //Get Parameter Lab Beras PK (TR)
        Route::get('/spv/get_parameter_lab_pk_tr/{tanggal_po?}', [SpvQcAdminController::class, 'get_parameter_lab_pk_tr'])->name('spv.get_parameter_lab_pk_tr');
        //Get Parameter Lab Kualitas Beras PK (TR)
        Route::get('/spv/get_parameter_lab_pk_tr_kualitas/{tanggal_po?}', [SpvQcAdminController::class, 'get_parameter_lab_pk_tr_kualitas'])->name('spv.get_parameter_lab_pk_tr_kualitas');

        //Parameter Lab Beras PK (Katul)
        Route::post('/spv/parameter_lab_pk_katul', [SpvQcAdminController::class, 'parameter_lab_pk_katul'])->name('spv.parameter_lab_pk_katul');
        Route::post('/spv/parameter_lab_pk_katul_update', [SpvQcAdminController::class, 'parameter_lab_pk_katul_update'])->name('spv.parameter_lab_pk_katul_update');
        Route::post('/spv/parameter_lab_katul_store', [SpvQcAdminController::class, 'parameter_lab_pk_katul_store'])->name('spv.parameter_lab_pk_katul_store');
        Route::get('/spv/parameter_lab_pk_katul_index', [SpvQcAdminController::class, 'parameter_lab_pk_katul_index'])->name('spv.parameter_lab_pk_katul_index');
        Route::get('/spv/parameter_lab_pk_katul_show/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_katul_show'])->name('spv.parameter_lab_pk_katul_show');
        Route::get('/spv/parameter_lab_pk_katul_destroy/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_katul_destroy'])->name('spv.parameter_lab_pk_katul_destroy');

        //Parameter Lab Beras PK (Butiran Patah)
        Route::post('/spv/parameter_lab_pk_butiran_patah', [SpvQcAdminController::class, 'parameter_lab_pk_butiran_patah'])->name('spv.parameter_lab_pk_butiran_patah');
        Route::post('/spv/parameter_lab_pk_butiran_patah_update', [SpvQcAdminController::class, 'parameter_lab_pk_butiran_patah_update'])->name('spv.parameter_lab_pk_butiran_patah_update');
        Route::post('/spv/parameter_lab_pk_butiran_patah_store', [SpvQcAdminController::class, 'parameter_lab_pk_butiran_patah_store'])->name('spv.parameter_lab_pk_butiran_patah_store');
        Route::get('/spv/parameter_lab_pk_butiran_patah_index', [SpvQcAdminController::class, 'parameter_lab_pk_butiran_patah_index'])->name('spv.parameter_lab_pk_butiran_patah_index');
        Route::get('/spv/parameter_lab_pk_butiran_patah_show/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_butiran_patah_show'])->name('spv.parameter_lab_pk_butiran_patah_show');
        Route::get('/spv/parameter_lab_pk_butiran_patah_destroy/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_butiran_patah_destroy'])->name('spv.parameter_lab_pk_butiran_patah_destroy');

        //Get Parameter Lab Beras PK (Butiran Patah)
        Route::get('/spv/get_parameter_lab_pk_butiran_patah/{tanggal_po?}', [SpvQcAdminController::class, 'get_parameter_lab_pk_butiran_patah'])->name('spv.get_parameter_lab_pk_butiran_patah');

        //Get Parameter Lab Kualitas
        Route::get('/spv/get_parameter_lab_pk_kualitas/{tanggal_po?}', [SpvQcAdminController::class, 'get_parameter_lab_pk_kualitas'])->name('spv.get_parameter_lab_pk_kualitas');

        //Get Parameter Lab Beras PK (Katul)
        Route::get('/spv/get_parameter_lab_pk_katul/{tanggal_po?}', [SpvQcAdminController::class, 'get_parameter_lab_pk_katul'])->name('spv.get_parameter_lab_pk_katul');

        // Parameter Lab PK
        Route::get('/spv/parameter_pk_refraksi', [SpvQcAdminController::class, 'parameter_pk_refraksi'])->name('spv.parameter_pk_refraksi');
        Route::get('/spv/parameter_lab_pk_kualitas', [SpvQcAdminController::class, 'parameter_lab_pk_kualitas'])->name('spv.parameter_lab_pk_kualitas');

        // Parameter Lab Beras DS
        Route::get('/spv/parameter_beras_ds', [SpvQcAdminController::class, 'parameter_beras_ds'])->name('spv.parameter_beras_ds');

        // Parameter Lab Gabah Kering
        Route::get('/spv/parameter_gk', [SpvQcAdminController::class, 'parameter_gk'])->name('spv.parameter_gk');

        //Parameter Lab Beras PK (Reward)
        Route::get('/spv/parameter_lab_pk_reward', [SpvQcAdminController::class, 'parameter_lab_pk_reward'])->name('spv.parameter_lab_pk_reward');


        //Parameter Lab Beras PK (Reward Kadar Air)
        Route::post('/spv/parameter_lab_pk_reward_kadar_air_update', [SpvQcAdminController::class, 'parameter_lab_pk_reward_kadar_air_update'])->name('spv.parameter_lab_pk_reward_kadar_air_update');
        Route::post('/spv/parameter_lab_pk_reward_kadar_air_store', [SpvQcAdminController::class, 'parameter_lab_pk_reward_kadar_air_store'])->name('spv.parameter_lab_pk_reward_kadar_air_store');
        Route::get('/spv/parameter_lab_pk_reward_kadar_air_index', [SpvQcAdminController::class, 'parameter_lab_pk_reward_kadar_air_index'])->name('spv.parameter_lab_pk_reward_kadar_air_index');
        Route::get('/spv/parameter_lab_pk_reward_kadar_air_show/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_reward_kadar_air_show'])->name('spv.parameter_lab_pk_reward_kadar_air_show');
        Route::get('/spv/parameter_lab_pk_reward_kadar_air_destroy/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_reward_kadar_air_destroy'])->name('spv.parameter_lab_pk_reward_kadar_air_destroy');

        //Parameter Lab Beras PK (Reward Hampa)
        Route::post('/spv/parameter_lab_pk_reward_hampa_update', [SpvQcAdminController::class, 'parameter_lab_pk_reward_hampa_update'])->name('spv.parameter_lab_pk_reward_hampa_update');
        Route::post('/spv/parameter_lab_pk_reward_hampa_store', [SpvQcAdminController::class, 'parameter_lab_pk_reward_hampa_store'])->name('spv.parameter_lab_pk_reward_hampa_store');
        Route::get('/spv/parameter_lab_pk_reward_hampa_index', [SpvQcAdminController::class, 'parameter_lab_pk_reward_hampa_index'])->name('spv.parameter_lab_pk_reward_hampa_index');
        Route::get('/spv/parameter_lab_pk_reward_hampa_show/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_reward_hampa_show'])->name('spv.parameter_lab_pk_reward_hampa_show');
        Route::get('/spv/parameter_lab_pk_reward_hampa_destroy/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_reward_hampa_destroy'])->name('spv.parameter_lab_pk_reward_hampa_destroy');

        //Get Parameter Lab Beras PK (Reward Hampa)
        Route::get('/spv/get_parameter_lab_pk_reward_hampa/{tanggal_po?}', [SpvQcAdminController::class, 'get_parameter_lab_pk_reward_hampa'])->name('spv.get_parameter_lab_pk_reward_hampa');

        //Parameter Lab Beras PK (Reward TR)
        Route::post('/spv/parameter_lab_pk_reward_tr_update', [SpvQcAdminController::class, 'parameter_lab_pk_reward_tr_update'])->name('spv.parameter_lab_pk_reward_tr_update');
        Route::post('/spv/parameter_lab_pk_reward_tr_store', [SpvQcAdminController::class, 'parameter_lab_pk_reward_tr_store'])->name('spv.parameter_lab_pk_reward_tr_store');
        Route::get('/spv/parameter_lab_pk_reward_tr_index', [SpvQcAdminController::class, 'parameter_lab_pk_reward_tr_index'])->name('spv.parameter_lab_pk_reward_tr_index');
        Route::get('/spv/parameter_lab_pk_reward_tr_show/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_reward_tr_show'])->name('spv.parameter_lab_pk_reward_tr_show');
        Route::get('/spv/parameter_lab_pk_reward_tr_destroy/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_reward_tr_destroy'])->name('spv.parameter_lab_pk_reward_tr_destroy');

        //Get Parameter Lab Beras PK (Reward TR)
        Route::get('/spv/get_parameter_lab_pk_reward_tr/{tanggal_po?}', [SpvQcAdminController::class, 'get_parameter_lab_pk_reward_tr'])->name('spv.get_parameter_lab_pk_reward_tr');

        //Parameter Lab Beras PK (Reward Katul)
        Route::post('/spv/parameter_lab_pk_reward_katul_update', [SpvQcAdminController::class, 'parameter_lab_pk_reward_katul_update'])->name('spv.parameter_lab_pk_reward_katul_update');
        Route::post('/spv/parameter_lab_pk_reward_katul_store', [SpvQcAdminController::class, 'parameter_lab_pk_reward_katul_store'])->name('spv.parameter_lab_pk_reward_katul_store');
        Route::get('/spv/parameter_lab_pk_reward_katul_index', [SpvQcAdminController::class, 'parameter_lab_pk_reward_katul_index'])->name('spv.parameter_lab_pk_reward_katul_index');
        Route::get('/spv/parameter_lab_pk_reward_katul_show/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_reward_katul_show'])->name('spv.parameter_lab_pk_reward_katul_show');
        Route::get('/spv/parameter_lab_pk_reward_katul_destroy/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_reward_katul_destroy'])->name('spv.parameter_lab_pk_reward_katul_destroy');

        //Get Parameter Lab Beras PK (Reward KATUL)
        Route::get('/spv/get_parameter_lab_pk_reward_katul/{tanggal_po?}', [SpvQcAdminController::class, 'get_parameter_lab_pk_reward_katul'])->name('spv.get_parameter_lab_pk_reward_katul');

        //Parameter Lab Beras PK (Reward Butir Patah)
        Route::post('/spv/parameter_lab_pk_reward_butir_patah_update', [SpvQcAdminController::class, 'parameter_lab_pk_reward_butir_patah_update'])->name('spv.parameter_lab_pk_reward_butir_patah_update');
        Route::post('/spv/parameter_lab_pk_reward_butir_patah_store', [SpvQcAdminController::class, 'parameter_lab_pk_reward_butir_patah_store'])->name('spv.parameter_lab_pk_reward_butir_patah_store');
        Route::get('/spv/parameter_lab_pk_reward_butir_patah_index', [SpvQcAdminController::class, 'parameter_lab_pk_reward_butir_patah_index'])->name('spv.parameter_lab_pk_reward_butir_patah_index');
        Route::get('/spv/parameter_lab_pk_reward_butir_patah_show/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_reward_butir_patah_show'])->name('spv.parameter_lab_pk_reward_butir_patah_show');
        Route::get('/spv/parameter_lab_pk_reward_butir_patah_destroy/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_reward_butir_patah_destroy'])->name('spv.parameter_lab_pk_reward_butir_patah_destroy');

        //Parameter Lab Beras PK (Kualitas)
        Route::post('/spv/parameter_lab_pk_kualitas_update', [SpvQcAdminController::class, 'parameter_lab_pk_kualitas_update'])->name('spv.parameter_lab_pk_kualitas_update');
        Route::post('/spv/parameter_lab_pk_kualitas_store', [SpvQcAdminController::class, 'parameter_lab_pk_kualitas_store'])->name('spv.parameter_lab_pk_kualitas_store');
        Route::get('/spv/parameter_lab_pk_kualitas_index', [SpvQcAdminController::class, 'parameter_lab_pk_kualitas_index'])->name('spv.parameter_lab_pk_kualitas_index');
        Route::get('/spv/parameter_lab_pk_kualitas_show/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_kualitas_show'])->name('spv.parameter_lab_pk_kualitas_show');
        Route::get('/spv/parameter_lab_pk_kualitas_destroy/{id?}', [SpvQcAdminController::class, 'parameter_lab_pk_kualitas_destroy'])->name('spv.parameter_lab_pk_kualitas_destroy');

        //Get Parameter Lab Beras PK (Reward Butir Patah)
        Route::get('/spv/get_parameter_lab_pk_reward_butir_patah/{tanggal_po?}', [SpvQcAdminController::class, 'get_parameter_lab_pk_reward_butir_patah'])->name('spv.get_parameter_lab_pk_reward_butir_patah');

        // output lab 1
        Route::get('/spv/output_lab1_gb', [SpvQcAdminController::class, 'output_lab1_gb'])->name('spv.output_lab1_gb');
        Route::get('/spv/output_lab1_pk', [SpvQcAdminController::class, 'output_lab1_pk'])->name('spv.output_lab1_pk');
        Route::get('/spv/output_lab1_gb_ciherang_index', [SpvQcAdminController::class, 'output_lab1_gb_ciherang_index'])->name('spv.output_lab1_gb_ciherang_index');
        Route::get('/spv/output_lab1_gb_longgrain_index', [SpvQcAdminController::class, 'output_lab1_gb_longgrain_index'])->name('spv.output_lab1_gb_longgrain_index');
        Route::get('/spv/output_lab1_gb_pandan_wangi_index', [SpvQcAdminController::class, 'output_lab1_gb_pandan_wangi_index'])->name('spv.output_lab1_gb_pandan_wangi_index');
        Route::get('/spv/output_lab1_gb_ketan_putih_index', [SpvQcAdminController::class, 'output_lab1_gb_ketan_putih_index'])->name('spv.output_lab1_gb_ketan_putih_index');
        Route::get('/spv/output_lab1_pk_index', [SpvQcAdminController::class, 'output_lab1_pk_index'])->name('spv.output_lab1_pk_index');
        Route::get('/spv/approve_lab1_gb/{id?}', [SpvQcAdminController::class, 'approve_lab1_gb'])->name('spv.approve_lab1_gb');
        Route::get('/spv/approve_lab1_pk/{id?}', [SpvQcAdminController::class, 'approve_lab1_pk'])->name('spv.approve_lab1_pk');
        Route::get('/spv/notapprove_lab1_pk/{id?}', [SpvQcAdminController::class, 'notapprove_lab1_pk'])->name('spv.notapprove_lab1_pk');
        Route::get('/spv/analisa_ulang_lab1_gb/{id?}', [SpvQcAdminController::class, 'analisa_ulang_lab1_gb'])->name('spv.analisa_ulang_lab1_gb');
        Route::get('/spv/notapprove_lab1_gb/{id?}', [SpvQcAdminController::class, 'notapprove_lab1_gb'])->name('spv.notapprove_lab1_gb');
        Route::get('/spv/approve_tolak_lab1_gb/{id?}', [SpvQcAdminController::class, 'approve_tolak_lab1_gb'])->name('spv.approve_tolak_lab1_gb');
        Route::get('/spv/approve_tolak_lab1_pk/{id?}', [SpvQcAdminController::class, 'approve_tolak_lab1_pk'])->name('spv.approve_tolak_lab1_pk');

        // Output Lab 2
        Route::get('/spv/output_lab2_gb', [SpvQcAdminController::class, 'output_lab2_gb'])->name('spv.output_lab2_gb');
        Route::get('/spv/output_lab2_pk', [SpvQcAdminController::class, 'output_lab2_pk'])->name('spv.output_lab2_pk');
        Route::get('/spv/output_lab2_gb_longgrain_index', [SpvQcAdminController::class, 'output_lab2_gb_longgrain_index'])->name('spv.output_lab2_gb_longgrain_index');
        Route::get('/spv/output_lab2_gb_ciherang_index', [SpvQcAdminController::class, 'output_lab2_gb_ciherang_index'])->name('spv.output_lab2_gb_ciherang_index');
        Route::get('/spv/output_lab2_gb_pandan_wangi_index', [SpvQcAdminController::class, 'output_lab2_gb_pandan_wangi_index'])->name('spv.output_lab2_gb_pandan_wangi_index');
        Route::get('/spv/output_lab2_gb_ketan_putih_index', [SpvQcAdminController::class, 'output_lab2_gb_ketan_putih_index'])->name('spv.output_lab2_gb_ketan_putih_index');
        Route::get('/spv/output_lab2_pk_index', [SpvQcAdminController::class, 'output_lab2_pk_index'])->name('spv.output_lab2_pk_index');
        Route::get('/spv/approve_lab2_gb/{id?}', [SpvQcAdminController::class, 'approve_lab2_gb'])->name('spv.approve_lab2_gb');
        Route::get('/spv/approve_lab2_pk/{id?}', [SpvQcAdminController::class, 'approve_lab2_pk'])->name('spv.approve_lab2_pk');
        Route::post('/spv/update_harga_akhir_gb', [SpvQcAdminController::class, 'update_harga_akhir_gb'])->name('spv.update_harga_akhir_gb');
        Route::post('/spv/update_harga_akhir_pk', [SpvQcAdminController::class, 'update_harga_akhir_pk'])->name('spv.update_harga_akhir_pk');
        Route::get('/spv/cekstatuslab1/{id?}', [SpvQcAdminController::class, 'cekstatuslab1'])->name('spv.cekstatuslab1');
        Route::get('/spv/tolak_approved/{id?}', [SpvQcAdminController::class, 'tolak_approved'])->name('spv.tolak_approved');
        Route::get('/spv/tolak_approved_pk/{id?}', [SpvQcAdminController::class, 'tolak_approved_pk'])->name('spv.tolak_approved_pk');

        // Nego
        Route::get('/spv/nego_gb_longgrain_index', [SpvQcAdminController::class, 'nego_gb_longgrain_index'])->name('spv.nego_gb_longgrain_index');
        Route::get('/spv/nego_gb_ciherang_index', [SpvQcAdminController::class, 'nego_gb_ciherang_index'])->name('spv.nego_gb_ciherang_index');
        Route::get('/spv/nego_gb_pandan_wangi_index', [SpvQcAdminController::class, 'nego_gb_pandan_wangi_index'])->name('spv.nego_gb_pandan_wangi_index');
        Route::get('/spv/nego_gb_ketan_putih_index', [SpvQcAdminController::class, 'nego_gb_ketan_putih_index'])->name('spv.nego_gb_ketan_putih_index');
        Route::get('/spv/nego_pk_index', [SpvQcAdminController::class, 'nego_pk_index'])->name('spv.nego_pk_index');
        Route::get('/spv/nego', [SpvQcAdminController::class, 'nego'])->name('spv.nego');
        Route::post('/spv/output_nego_gb/{id?}', [SpvQcAdminController::class, 'output_nego_gb'])->name('spv.output_nego_gb');
        Route::post('/spv/output_nego_pk/{id?}', [SpvQcAdminController::class, 'output_nego_pk'])->name('spv.output_nego_pk');

        // Revisi
        Route::get('/spv/revisi_harga_gb_ciherang_index', [SpvQcAdminController::class, 'revisi_harga_gb_ciherang_index'])->name('spv.revisi_harga_gb_ciherang_index');
        Route::get('/spv/revisi_harga_gb_pandan_wangi_index', [SpvQcAdminController::class, 'revisi_harga_gb_pandan_wangi_index'])->name('spv.revisi_harga_gb_pandan_wangi_index');
        Route::get('/spv/revisi_harga_gb_longgrain_index', [SpvQcAdminController::class, 'revisi_harga_gb_longgrain_index'])->name('spv.revisi_harga_gb_longgrain_index');
        Route::get('/spv/revisi_harga_gb_ketan_putih_index', [SpvQcAdminController::class, 'revisi_harga_gb_ketan_putih_index'])->name('spv.revisi_harga_gb_ketan_putih_index');
        Route::get('/spv/revisi_harga_pk_index', [SpvQcAdminController::class, 'revisi_harga_pk_index'])->name('spv.revisi_harga_pk_index');
        Route::get('/spv/revisi_harga', [SpvQcAdminController::class, 'revisi_harga'])->name('spv.revisi_harga');
        Route::post('/spv/save_revisi_harga_gb/{id?}', [SpvQcAdminController::class, 'save_revisi_harga_gb'])->name('spv.save_revisi_harga_gb');
        Route::post('/spv/save_revisi_harga_pk/{id?}', [SpvQcAdminController::class, 'save_revisi_harga_pk'])->name('spv.save_revisi_harga_pk');
        // Surveyor
        Route::get('/spv/data_surveyor', [SpvQcAdminController::class, 'data_surveyor'])->name('spv.data_surveyor');
        Route::get('/spv/data_surveyor_index', [SpvQcAdminController::class, 'data_surveyor_index'])->name('spv.data_surveyor_index');
        Route::get('/spv/get_surveyor/{id?}', [SpvQcAdminController::class, 'get_surveyor'])->name('spv.get_surveyor');
        Route::post('/spv/save_surveyor', [SpvQcAdminController::class, 'save_surveyor'])->name('spv.save_surveyor');
        Route::post('/spv/update_surveyor', [SpvQcAdminController::class, 'update_surveyor'])->name('spv.update_surveyor');
        Route::get('/spv/delete_surveyor/{id?}', [SpvQcAdminController::class, 'delete_surveyor'])->name('spv.delete_surveyor');

        Route::get('/spv/get_notifikasispvqc', [SpvQcAdminController::class, 'get_notifikasispvqc'])->name('spv.get_notifikasispvqc');
        Route::get('/spv/get_countnotifikasispvqc', [SpvQcAdminController::class, 'get_countnotifikasispvqc'])->name('spv.get_countnotifikasispvqc');
        Route::get('/spv/set_notifikasispvqc/', [SpvQcAdminController::class, 'set_notifikasispvqc'])->name('spv.set_notifikasispvqc');
        Route::get('/spv/new_notifikasispvqc/', [SpvQcAdminController::class, 'new_notifikasispvqc'])->name('spv.new_notifikasispvqc');
        Route::get('/spv/get_notif_spvqc_all', [SpvQcAdminController::class, 'get_notif_spvqc_all'])->name('spv.get_notif_spvqc_all');
        Route::get('/spv/get_notif_spvqc_all_index', [SpvQcAdminController::class, 'get_notif_spvqc_all_index'])->name('spv.get_notif_spvqc_all_index');
    });

    //BONGKAR
    Route::middleware(['guest:bongkar', 'PreventBackHistory'])->group(function () {
        Route::view('/bongkar/login', 'dashboard.admin_qc_bongkar.login')->name('bongkar.login');
        Route::post('/bongkar/check', [QcAdminBongkarController::class, 'check'])->name('bongkar.check');
    });

    Route::middleware(['auth:bongkar', 'PreventBackHistory'])->group(function () {
        //Route::view('/home', 'dashboard.admin_qc_bongkar.home')->name('bongkar.home');
        Route::get('/bongkar/home', [QcAdminBongkarController::class, 'home'])->name('bongkar.home');
        Route::get('/bongkar/data_bongkar', [QcAdminBongkarController::class, 'data_bongkar'])->name('bongkar.data_bongkar');
        // get notif
        Route::get('/bongkar/getcountnotif_antrianbongkar', [QcAdminBongkarController::class, 'getcountnotif_antrianbongkar'])->name('bongkar.getcountnotif_antrianbongkar');
        Route::get('/bongkar/getcountnotif_prosesbongkar', [QcAdminBongkarController::class, 'getcountnotif_prosesbongkar'])->name('bongkar.getcountnotif_prosesbongkar');
        Route::get('/bongkar/getcountnotif_databongkar', [QcAdminBongkarController::class, 'getcountnotif_databongkar'])->name('bongkar.getcountnotif_databongkar');
        Route::get('/bongkar/getcountnotif_revisibongkar', [QcAdminBongkarController::class, 'getcountnotif_revisibongkar'])->name('bongkar.getcountnotif_revisibongkar');

        Route::get('/bongkar/check_input_bongkar', [QcAdminBongkarController::class, 'check_input_bongkar'])->name('bongkar.check_input_bongkar');
        // Data Antrian Bongkar
        Route::get('/bongkar/data_antrian_bongkar_pandan_wangi_index', [QcAdminBongkarController::class, 'data_antrian_bongkar_pandan_wangi_index'])->name('bongkar.data_antrian_bongkar_pandan_wangi_index');
        Route::get('/bongkar/data_antrian_bongkar_ketan_putih_index', [QcAdminBongkarController::class, 'data_antrian_bongkar_ketan_putih_index'])->name('bongkar.data_antrian_bongkar_ketan_putih_index');
        Route::get('/bongkar/data_antrian_bongkar_longgrain_index', [QcAdminBongkarController::class, 'data_antrian_bongkar_longgrain_index'])->name('bongkar.data_antrian_bongkar_longgrain_index');
        Route::get('/bongkar/antrian_bongkar', [QcAdminBongkarController::class, 'antrian_bongkar'])->name('bongkar.antrian_bongkar');
        Route::get('/bongkar/data_antrian_bongkar', [QcAdminBongkarController::class, 'data_antrian_bongkar'])->name('bongkar.data_antrian_bongkar');
        Route::get('/bongkar/data_antrian_bongkar_index', [QcAdminBongkarController::class, 'data_antrian_bongkar_index'])->name('bongkar.data_antrian_bongkar_index');
        Route::get('/bongkar/data_antrian_bongkar_utara_index', [QcAdminBongkarController::class, 'data_antrian_bongkar_utara_index'])->name('bongkar.data_antrian_bongkar_utara_index');
        Route::get('/bongkar/data_antrian_bongkar_pending_index', [QcAdminBongkarController::class, 'data_antrian_bongkar_pending_index'])->name('bongkar.data_antrian_bongkar_pending_index');
        Route::get('/bongkar/data_antrian_bongkar_pk_index', [QcAdminBongkarController::class, 'data_antrian_bongkar_pk_index'])->name('bongkar.data_antrian_bongkar_pk_index');
        Route::get('/bongkar/data_antrian_bongkar_selatan_index', [QcAdminBongkarController::class, 'data_antrian_bongkar_selatan_index'])->name('bongkar.data_antrian_bongkar_selatan_index');
        // Data Revisi
        Route::get('/bongkar/data_revisi_gb', [QcAdminBongkarController::class, 'data_revisi_gb'])->name('bongkar.data_revisi_gb');
        Route::get('/bongkar/data_revisi_gb_longgrain_index', [QcAdminBongkarController::class, 'data_revisi_gb_longgrain_index'])->name('bongkar.data_revisi_gb_longgrain_index');
        Route::get('/bongkar/data_revisi_gb_pandan_wangi_index', [QcAdminBongkarController::class, 'data_revisi_gb_pandan_wangi_index'])->name('bongkar.data_revisi_gb_pandan_wangi_index');
        Route::get('/bongkar/data_revisi_gb_ketan_putih_index', [QcAdminBongkarController::class, 'data_revisi_gb_ketan_putih_index'])->name('bongkar.data_revisi_gb_ketan_putih_index');
        Route::post('/bongkar/update_dtm', [QcAdminBongkarController::class, 'update_dtm'])->name('bongkar.update_dtm');
        Route::get('/bongkar/show_revisi_gb/{id?}', [QcAdminBongkarController::class, 'show_revisi_gb'])->name('bongkar.show_revisi_gb');


        // Data Antrian Bongkar Panggil
        Route::get('/bongkar/data_antrian_bongkar_panggil_gb/{id?}', [QcAdminBongkarController::class, 'data_antrian_bongkar_panggil_gb'])->name('bongkar.data_antrian_bongkar_panggil_gb');
        Route::get('/bongkar/data_antrian_bongkar_panggil_pk/{id?}', [QcAdminBongkarController::class, 'data_antrian_bongkar_panggil_pk'])->name('bongkar.data_antrian_bongkar_panggil_pk');

        Route::get('/bongkar/antrian_qc_longgrain_index', [QcAdminBongkarController::class, 'antrian_qc_longgrain_index'])->name('bongkar.antrian_qc_longgrain_index');
        Route::get('/bongkar/antrian_qc_bongkar_pk_index', [QcAdminBongkarController::class, 'antrian_qc_bongkar_pk_index'])->name('bongkar.antrian_qc_bongkar_pk_index');
        Route::get('/bongkar/antrian_qc_pandan_wangi_index', [QcAdminBongkarController::class, 'antrian_qc_pandan_wangi_index'])->name('bongkar.antrian_qc_pandan_wangi_index');
        Route::get('/bongkar/antrian_qc_ketan_putih_index', [QcAdminBongkarController::class, 'antrian_qc_ketan_putih_index'])->name('bongkar.antrian_qc_ketan_putih_index');
        Route::get('/bongkar/data_bongkar_gb_utara_index', [QcAdminBongkarController::class, 'data_bongkar_gb_utara_index'])->name('bongkar.data_bongkar_gb_utara_index');
        Route::get('/bongkar/data_bongkar_gb_selatan_index', [QcAdminBongkarController::class, 'data_bongkar_gb_selatan_index'])->name('bongkar.data_bongkar_gb_selatan_index');
        Route::get('/bongkar/data_bongkar_pk_index', [QcAdminBongkarController::class, 'data_bongkar_pk_index'])->name('bongkar.data_bongkar_pk_index');
        Route::get('/bongkar/antrian_qc_bongkarGT_index', [QcAdminBongkarController::class, 'antrian_qc_bongkarGT_index'])->name('bongkar.antrian_qc_bongkarGT_index');
        Route::get('/bongkar/antrian_qc_bongkar_pk_index', [QcAdminBongkarController::class, 'antrian_qc_bongkar_pk_index'])->name('bongkar.antrian_qc_bongkar_pk_index');
        Route::get('/bongkar/antrian_qc_bongkar04_index', [QcAdminBongkarController::class, 'antrian_qc_bongkar04_index'])->name('bongkar.antrian_qc_bongkar04_index');
        Route::get('/bongkar/show_qc_bongkar_gb_show/{id?}', [QcAdminBongkarController::class, 'show_qc_bongkar_gb_show'])->name('bongkar.show_qc_bongkar_gb_show');
        Route::get('/bongkar/show_qc_bongkar_pk_show/{id?}', [QcAdminBongkarController::class, 'show_qc_bongkar_pk_show'])->name('bongkar.show_qc_bongkar_pk_show');
        Route::post('/bongkar/update_qc_bongkar', [QcAdminBongkarController::class, 'update_qc_bongkar'])->name('bongkar.update_qc_bongkar');
        Route::get('/bongkar/getnotifikasibongkar', [QcAdminBongkarController::class, 'get_notifikasibongkar'])->name('bongkar.get_notifikasibongkar');
        Route::get('/bongkar/get_notif_qc_bongkar_all', [QcAdminBongkarController::class, 'get_notif_qc_bongkar_all'])->name('bongkar.get_notif_qc_bongkar_all');
        Route::get('/bongkar/get_notif_qc_bongkar_all_index', [QcAdminBongkarController::class, 'get_notif_qc_bongkar_all_index'])->name('bongkar.get_notif_qc_bongkar_all_index');
        Route::get('/bongkar/getcountnotifikasibongkar', [QcAdminBongkarController::class, 'get_countnotifikasibongkar'])->name('bongkar.get_countnotifikasibongkar');
        Route::get('/bongkar/setnotifikasibongkar/', [QcAdminBongkarController::class, 'set_notifikasibongkar'])->name('bongkar.set_notifikasibongkar');
        Route::get('/bongkar/newnotifikasibongkar/', [QcAdminBongkarController::class, 'new_notifikasibongkar'])->name('bongkar.new_notifikasibongkar');
        Route::post('/bongkar/update_newnotifbongkar/', [QcAdminBongkarController::class, 'update_newnotifbongkar'])->name('bongkar.update_newnotifbongkar');
        Route::post('/bongkar/bongkar_logout', [QcAdminBongkarController::class, 'bongkar_logout'])->name('bongkar.bongkar_logout');
    });
});

Route::prefix('ap')->name('ap.')->group(function () {

    Route::middleware(['guest:ap', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.admin_ap.login')->name('login');
        Route::post('/check', [AdminAPController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:ap', 'PreventBackHistory'])->group(function () {
        Route::get('/home', [AdminAPController::class, 'home'])->name('home');
        Route::get('/account_ap', [AdminAPController::class, 'account_ap'])->name('account_ap');
        Route::post('/account_update', [AdminAPController::class, 'account_update'])->name('account_update');
        Route::post('/logout', [AdminAPController::class, 'logout'])->name('logout');
        // Data Pembelian
        Route::get('/data_pembelian_gb', [AdminAPController::class, 'data_pembelian_gb'])->name('data_pembelian_gb');
        Route::get('/data_pembelian_pk', [AdminAPController::class, 'data_pembelian_pk'])->name('data_pembelian_pk');
        Route::get('/data_pembelian_gb_ciherang_index', [AdminAPController::class, 'data_pembelian_gb_ciherang_index'])->name('data_pembelian_gb_ciherang_index');
        Route::get('/data_pembelian_gb_longgrain_index', [AdminAPController::class, 'data_pembelian_gb_longgrain_index'])->name('data_pembelian_gb_longgrain_index');
        Route::get('/data_pembelian_gb_longgrain1_index', [AdminAPController::class, 'data_pembelian_gb_longgrain1_index'])->name('data_pembelian_gb_longgrain1_index');
        Route::get('/data_pembelian_gb_pandan_wangi_index', [AdminAPController::class, 'data_pembelian_gb_pandan_wangi_index'])->name('data_pembelian_gb_pandan_wangi_index');
        Route::get('/data_pembelian_gb_ketan_putih_index', [AdminAPController::class, 'data_pembelian_gb_ketan_putih_index'])->name('data_pembelian_gb_ketan_putih_index');
        Route::get('/data_pembelian_pk_index', [AdminAPController::class, 'data_pembelian_pk_index'])->name('data_pembelian_pk_index');
        Route::get('/getcount_verifikasi', [AdminAPController::class, 'getcount_verifikasi'])->name('getcount_verifikasi');
        Route::get('/getcount_verified', [AdminAPController::class, 'getcount_verified'])->name('getcount_verified');

        Route::get('/data_pembelian_show/{id?}', [AdminAPController::class, 'data_pembelian_show'])->name('data_pembelian_show');
        Route::post('/data_pembelian_update', [AdminAPController::class, 'data_pembelian_update'])->name('data_pembelian_update');
        Route::get('/revisi_data_pk', [AdminAPController::class, 'revisi_data_pk'])->name('revisi_data_pk');
        Route::get('/revisi_data_pk_index', [AdminAPController::class, 'revisi_data_pk_index'])->name('revisi_data_pk_index');
        Route::get('/revisi_data_gb', [AdminAPController::class, 'revisi_data_gb'])->name('revisi_data_gb');
        Route::get('/revisi_data_gb_index', [AdminAPController::class, 'revisi_data_gb_index'])->name('revisi_data_gb_index');
        Route::get('/integrasi_epicor_gb', [AdminAPController::class, 'integrasi_epicor_gb'])->name('integrasi_epicor_gb');
        Route::get('/integrasi_epicor_gb_index', [AdminAPController::class, 'integrasi_epicor_gb_index'])->name('integrasi_epicor_gb_index');
        Route::get('/integrasi_epicor_pk', [AdminAPController::class, 'integrasi_epicor_pk'])->name('integrasi_epicor_pk');
        Route::get('/integrasi_epicor_pk_index', [AdminAPController::class, 'integrasi_epicor_pk_index'])->name('integrasi_epicor_pk_index');
        Route::get('/integrasi_epicor_pk1_index', [AdminAPController::class, 'integrasi_epicor_pk1_index'])->name('integrasi_epicor_pk1_index');
        Route::get('/kirim_epicor_pk/{id?}', [AdminAPController::class, 'kirim_epicor_pk'])->name('kirim_epicor_pk');
        Route::get('/kirim_epicor_gb/{id?}', [AdminAPController::class, 'kirim_epicor_gb'])->name('kirim_epicor_gb');

        // POTONG PAJAK
        Route::get('/potong_pajak', [AdminAPController::class, 'potong_pajak'])->name('potong_pajak');
        Route::get('/potong_pajak_index', [AdminAPController::class, 'potong_pajak_index'])->name('potong_pajak_index');
        Route::get('/potong_pajak1_index', [AdminAPController::class, 'potong_pajak1_index'])->name('potong_pajak1_index');
        Route::post('/upload_potong_pajak', [AdminAPController::class, 'upload_potong_pajak'])->name('upload_potong_pajak');
        Route::post('/update_potong_pajak', [AdminAPController::class, 'update_potong_pajak'])->name('update_potong_pajak');
        Route::get('/delete_potong_pajak/{id?}', [AdminAPController::class, 'delete_potong_pajak'])->name('delete_potong_pajak');

        Route::get('/getnotifikasiap', [AdminAPController::class, 'get_notifikasiap'])->name('get_notifikasiap');
        Route::get('/get_notif_ap_all', [AdminAPController::class, 'get_notif_ap_all'])->name('get_notif_ap_all');
        Route::get('/get_notif_ap_all_index', [AdminAPController::class, 'get_notif_ap_all_index'])->name('get_notif_ap_all_index');
        Route::get('/getcountnotifikasiap', [AdminAPController::class, 'get_countnotifikasiap'])->name('get_countnotifikasiap');
        Route::get('/setnotifikasiap', [AdminAPController::class, 'set_notifikasiap'])->name('set_notifikasiap');
        Route::get('/newnotifikasiap', [AdminAPController::class, 'new_notifikasiap'])->name('new_notifikasiap');
        Route::post('/update_newnotifap', [AdminAPController::class, 'update_newnotifap'])->name('update_newnotifap');
    });
    Route::middleware(['guest:spvap', 'PreventBackHistory'])->group(function () {
        Route::view('/spv/login', 'dashboard.admin_spvap.login')->name('spv.login');
        Route::post('/spv/check', [AdminSpvApController::class, 'check'])->name('spv.check');
        // Route::get('/spv/integrasi_epicor_gb_index', [AdminSpvApController::class, 'integrasi_epicor_gb_index'])->name('spv.integrasi_epicor_gb_index');
    });

    Route::middleware(['auth:spvap', 'PreventBackHistory'])->group(function () {
        Route::get('/spv/home', [AdminSpvApController::class, 'home'])->name('spv.home');
        Route::get('/account_spvap', [AdminSpvApController::class, 'account_spvap'])->name('spv.account_spvap');
        Route::post('/spv/account_update', [AdminSpvApController::class, 'account_update'])->name('spv.account_update');
        Route::post('/spv/logout', [AdminSpvApController::class, 'logout'])->name('spv.logout');
        Route::get('/spv/data_pembelian_show/{id?}', [AdminSpvApController::class, 'data_pembelian_show'])->name('spv.data_pembelian_show');
        Route::get('/spv/notapprove_revisi/{id?}', [AdminSpvApController::class, 'notapprove_revisi'])->name('spv.notapprove_revisi');
        Route::get('/spv/approve_revisi/{id?}', [AdminSpvApController::class, 'approve_revisi'])->name('spv.approve_revisi');
        Route::get('/spv/revisi_data_pk', [AdminSpvApController::class, 'revisi_data_pk'])->name('spv.revisi_data_pk');
        Route::get('/spv/revisi_data_pk_index', [AdminSpvApController::class, 'revisi_data_pk_index'])->name('spv.revisi_data_pk_index');
        Route::get('/spv/revisi_data_gb', [AdminSpvApController::class, 'revisi_data_gb'])->name('spv.revisi_data_gb');
        Route::get('/spv/revisi_data_gb_index', [AdminSpvApController::class, 'revisi_data_gb_index'])->name('spv.revisi_data_gb_index');
        Route::get('/spv/integrasi_epicor_gb', [AdminSpvApController::class, 'integrasi_epicor_gb'])->name('spv.integrasi_epicor_gb');
        Route::get('/spv/integrasi_epicor_gb_index', [AdminSpvApController::class, 'integrasi_epicor_gb_index'])->name('spv.integrasi_epicor_gb_index');
        Route::get('/spv/integrasi_epicor_gb1_index', [AdminSpvApController::class, 'integrasi_epicor_gb1_index'])->name('spv.integrasi_epicor_gb1_index');
        Route::get('/spv/integrasi_epicor_pk', [AdminSpvApController::class, 'integrasi_epicor_pk'])->name('spv.integrasi_epicor_pk');
        Route::get('/spv/integrasi_epicor_pk_index', [AdminSpvApController::class, 'integrasi_epicor_pk_index'])->name('spv.integrasi_epicor_pk_index');
        Route::get('/integrasi_epicor_pk1_index', [AdminSpvApController::class, 'integrasi_epicor_pk1_index'])->name('spv.integrasi_epicor_pk1_index');
        Route::get('/spv/kirim_epicor_pk/{id?}', [AdminSpvApController::class, 'kirim_epicor_pk'])->name('spv.kirim_epicor_pk');
        Route::get('/spv/approve_receipt/{id?}', [AdminSpvApController::class, 'approve_receipt'])->name('spv.approve_receipt');
        Route::get('/spv/not_approve_receipt/{id?}', [AdminSpvApController::class, 'not_approve_receipt'])->name('spv.not_approve_receipt');
        Route::get('/spv/approve_receipt_pk/{id?}', [AdminSpvApController::class, 'approve_receipt_pk'])->name('spv.approve_receipt_pk');
        Route::get('/spv/not_approve_receipt_pk/{id?}', [AdminSpvApController::class, 'not_approve_receipt_pk'])->name('spv.not_approve_receipt_pk');
        Route::get('/spv/kirim_epicor_gb/{id?}', [AdminSpvApController::class, 'kirim_epicor_gb'])->name('spv.kirim_epicor_gb');
        Route::get('/spv/kirim_epicor_pk/{id?}', [AdminSpvApController::class, 'kirim_epicor_pk'])->name('spv.kirim_epicor_pk');
        Route::get('/spv/kirim_epicor_gb_all', [AdminSpvApController::class, 'kirim_epicor_gb_all'])->name('spv.kirim_epicor_gb_all');
        Route::get('/spv/kirim_epicor_pk_all', [AdminSpvApController::class, 'kirim_epicor_pk_all'])->name('spv.kirim_epicor_pk_all');

        Route::post('/download_data_faktur_pemebelian_aol', [AdminSpvApController::class, 'download_data_faktur_pemebelian_aol'])->name('spv.download_data_faktur_pemebelian_aol');
        Route::get('/getnotifikasispvap', [AdminSpvApController::class, 'get_notifikasispvap'])->name('spv.get_notifikasispvap');
        Route::get('/spv/get_notif_spvap_all', [AdminSpvApController::class, 'get_notif_spvap_all'])->name('spv.get_notif_spvap_all');
        Route::get('/spv/get_notif_spvap_all_index', [AdminSpvApController::class, 'get_notif_spvap_all_index'])->name('spv.get_notif_spvap_all_index');
        Route::get('/getcountnotifikasispvap', [AdminSpvApController::class, 'get_countnotifikasispvap'])->name('spv.get_countnotifikasispvap');
        Route::get('/setnotifikasispvap', [AdminSpvApController::class, 'set_notifikasispvap'])->name('spv.set_notifikasispvap');
        Route::get('/newnotifikasispvap', [AdminSpvApController::class, 'new_notifikasispvap'])->name('spv.new_notifikasispvap');
        // Data Pembelian
    });
});

Route::prefix('timbangan')->name('timbangan.')->group(function () {

    Route::middleware(['guest:timbangan', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.admin_timbangan.login')->name('login');
        Route::post('/check', [AdminTimbanganController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:timbangan', 'PreventBackHistory'])->group(function () {
        Route::get('/home', [AdminTimbanganController::class, 'home'])->name('home');
        Route::post('/timbangan_logout', [AdminTimbanganController::class, 'timbangan_logout'])->name('timbangan_logout');
        // Timbangan Awal
        Route::get('/timbangan_awal', [AdminTimbanganController::class, 'timbangan_awal'])->name('timbangan_awal');
        Route::get('/timbangan_awal_gb_ciherang_index', [AdminTimbanganController::class, 'timbangan_awal_gb_ciherang_index'])->name('timbangan_awal_gb_ciherang_index');
        Route::get('/timbangan_awal_gb_longgrain_index', [AdminTimbanganController::class, 'timbangan_awal_gb_longgrain_index'])->name('timbangan_awal_gb_longgrain_index');
        Route::get('/timbangan_awal_gb_pandan_wangi_index', [AdminTimbanganController::class, 'timbangan_awal_gb_pandan_wangi_index'])->name('timbangan_awal_gb_pandan_wangi_index');
        Route::get('/timbangan_awal_gb_ketan_putih_index', [AdminTimbanganController::class, 'timbangan_awal_gb_ketan_putih_index'])->name('timbangan_awal_gb_ketan_putih_index');
        Route::get('/timbangan_awal_pk_index', [AdminTimbanganController::class, 'timbangan_awal_pk_index'])->name('timbangan_awal_pk_index');
        Route::get('/data_timbangan_awal', [AdminTimbanganController::class, 'data_timbangan_awal'])->name('data_timbangan_awal');
        Route::get('/data_timbangan_awal_gb_longgrain_index', [AdminTimbanganController::class, 'data_timbangan_awal_gb_longgrain_index'])->name('data_timbangan_awal_gb_longgrain_index');
        Route::get('/data_timbangan_awal_gb_ciherang_index', [AdminTimbanganController::class, 'data_timbangan_awal_gb_ciherang_index'])->name('data_timbangan_awal_gb_ciherang_index');
        Route::get('/data_timbangan_awal_gb_pandan_wangi_index', [AdminTimbanganController::class, 'data_timbangan_awal_gb_pandan_wangi_index'])->name('data_timbangan_awal_gb_pandan_wangi_index');
        Route::get('/data_timbangan_awal_gb_ketan_putih_index', [AdminTimbanganController::class, 'data_timbangan_awal_gb_ketan_putih_index'])->name('data_timbangan_awal_gb_ketan_putih_index');
        Route::get('/data_timbangan_awal_pk_index', [AdminTimbanganController::class, 'data_timbangan_awal_pk_index'])->name('data_timbangan_awal_pk_index');
        Route::get('/antrian_timbangan_masuk/{id?}', [AdminTimbanganController::class, 'show_antrian_timbangan_masuk'])->name('show_timbangan_awal');
        Route::post('/terima_tonase_awal', [AdminTimbanganController::class, 'terima_tonase_awal'])->name('terima_tonase_awal');


        // Timbangan Akhir
        Route::get('/total_tonase', [AdminTimbanganController::class, 'total_tonase'])->name('total_tonase');
        Route::get('/timbangan_akhir', [AdminTimbanganController::class, 'timbangan_akhir'])->name('timbangan_akhir');
        Route::get('/timbangan_akhir_gb_longgrain_index', [AdminTimbanganController::class, 'timbangan_akhir_gb_longgrain_index'])->name('timbangan_akhir_gb_longgrain_index');
        Route::get('/timbangan_akhir_gb_ciherang_index', [AdminTimbanganController::class, 'timbangan_akhir_gb_ciherang_index'])->name('timbangan_akhir_gb_ciherang_index');
        Route::get('/timbangan_akhir_gb_pandan_wangi_index', [AdminTimbanganController::class, 'timbangan_akhir_gb_pandan_wangi_index'])->name('timbangan_akhir_gb_pandan_wangi_index');
        Route::get('/timbangan_akhir_gb_ketan_putih_index', [AdminTimbanganController::class, 'timbangan_akhir_gb_ketan_putih_index'])->name('timbangan_akhir_gb_ketan_putih_index');
        Route::get('/timbangan_akhir_pk_index', [AdminTimbanganController::class, 'timbangan_akhir_pk_index'])->name('timbangan_akhir_pk_index');
        Route::get('/data_timbangan_akhir', [AdminTimbanganController::class, 'data_timbangan_akhir'])->name('data_timbangan_akhir');
        Route::get('/data_timbangan_akhir_gb_ciherang_index', [AdminTimbanganController::class, 'data_timbangan_akhir_gb_ciherang_index'])->name('data_timbangan_akhir_gb_ciherang_index');
        Route::get('/data_timbangan_akhir_gb_longgrain_index', [AdminTimbanganController::class, 'data_timbangan_akhir_gb_longgrain_index'])->name('data_timbangan_akhir_gb_longgrain_index');
        Route::get('/data_timbangan_akhir_gb_pandan_wangi_index', [AdminTimbanganController::class, 'data_timbangan_akhir_gb_pandan_wangi_index'])->name('data_timbangan_akhir_gb_pandan_wangi_index');
        Route::get('/data_timbangan_akhir_gb_ketan_putih_index', [AdminTimbanganController::class, 'data_timbangan_akhir_gb_ketan_putih_index'])->name('data_timbangan_akhir_gb_ketan_putih_index');
        Route::get('/data_timbangan_akhir_pk_index', [AdminTimbanganController::class, 'data_timbangan_akhir_pk_index'])->name('data_timbangan_akhir_pk_index');
        Route::get('/data_revisi_timbangan', [AdminTimbanganController::class, 'data_revisi_timbangan'])->name('data_revisi_timbangan');
        Route::get('/data_revisi_timbangan_longgrain_index', [AdminTimbanganController::class, 'data_revisi_timbangan_longgrain_index'])->name('data_revisi_timbangan_longgrain_index');
        Route::get('/data_revisi_timbangan_ciherang_index', [AdminTimbanganController::class, 'data_revisi_timbangan_ciherang_index'])->name('data_revisi_timbangan_ciherang_index');
        Route::get('/data_revisi_timbangan_pandan_wangi_index', [AdminTimbanganController::class, 'data_revisi_timbangan_pandan_wangi_index'])->name('data_revisi_timbangan_pandan_wangi_index');
        Route::get('/data_revisi_timbangan_ketan_putih_index', [AdminTimbanganController::class, 'data_revisi_timbangan_ketan_putih_index'])->name('data_revisi_timbangan_ketan_putih_index');
        Route::post('/timbangan_revisi', [AdminTimbanganController::class, 'revisi_timbangan_update'])->name('revisi_timbangan_update');
        Route::get('/antrian_timbangan_keluar/{id?}', [AdminTimbanganController::class, 'show_timbangan_akhir'])->name('show_timbangan_akhir');
        Route::post('/terima_tonase_akhir', [AdminTimbanganController::class, 'terima_tonase_akhir'])->name('terima_tonase_akhir');
        Route::get('/cetak_penerimaanpo/{id?}', [AdminTimbanganController::class, 'cetak_penerimaanpo'])->name('cetak_penerimaanpo');
        Route::get('/cetak_penerimaanpo_pk/{id?}', [AdminTimbanganController::class, 'cetak_penerimaanpo_pk'])->name('cetak_penerimaanpo_pk');
        Route::get('/cetak_penerimaanpo_2/{id?}', [AdminTimbanganController::class, 'cetak_penerimaanpo_2'])->name('cetak_penerimaanpo_2');
        Route::get('/cetak_penerimaanpo2_pk/{id?}', [AdminTimbanganController::class, 'cetak_penerimaanpo2_pk'])->name('cetak_penerimaanpo2_pk');
        Route::get('/show_timbangan_revisi/{id?}', [AdminTimbanganController::class, 'show_timbangan_revisi'])->name('show_timbangan_revisi');
        // download file
        Route::post('/download_excel', [AdminTimbanganController::class, 'download_excel'])->name('download_excel');
        Route::post('/download_penerimaan_barang_excel', [AdminTimbanganController::class, 'download_penerimaan_barang_excel'])->name('download_penerimaan_barang_excel');
        Route::get('/download_print', [AdminTimbanganController::class, 'download_print'])->name('download_print');
        Route::post('/download_pdf', [AdminTimbanganController::class, 'download_pdf'])->name('download_pdf');
        Route::post('/download_csv', [AdminTimbanganController::class, 'download_csv'])->name('download_csv');

        // notifikasi
        Route::get('/get_all_notifikasi', [AdminTimbanganController::class, 'get_all_notifikasi'])->name('get_all_notifikasi');
        Route::get('/setnotifikasitimbangan', [AdminTimbanganController::class, 'set_notifikasitimbangan'])->name('set_notifikasitimbangan');
        Route::get('/newnotifikasitimbangan', [AdminTimbanganController::class, 'new_notifikasitimbangan'])->name('new_notifikasitimbangan');
        Route::get('/get_notif_timbangan_all', [AdminTimbanganController::class, 'get_notif_timbangan_all'])->name('get_notif_timbangan_all');
        Route::get('/get_notif_timbangan_all_index', [AdminTimbanganController::class, 'get_notif_timbangan_all_index'])->name('get_notif_timbangan_all_index');
        Route::get('/account_timbangan', [AdminTimbanganController::class, 'account_timbangan'])->name('account_timbangan');
        Route::post('/account_update', [AdminTimbanganController::class, 'account_update'])->name('account_update');
    });
});

Route::prefix('security')->name('security.')->group(function () {

    Route::middleware(['guest:security', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.admin.login')->name('login');
        Route::post('/check', [AdminController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:security', 'PreventBackHistory'])->group(function () {
        Route::view('/home', 'dashboard.admin.home')->name('home');
        Route::post('/generate', [AdminController::class, 'generate'])->name('generate');
        Route::get('/gabahkering_index_sekarang', [AdminController::class, 'gabahkering_index_sekarang'])->name('gabahkering_index_sekarang');
        Route::get('/gabahbasah_index_kemarin', [AdminController::class, 'gabahbasah_index_kemarin'])->name('gabahbasah_index_kemarin');
        Route::get('/gabahbasah_index_sekarang', [AdminController::class, 'gabahbasah_index_sekarang'])->name('gabahbasah_index_sekarang');
        Route::get('/gabahbasah_index_besok', [AdminController::class, 'gabahbasah_index_besok'])->name('gabahbasah_index_besok');
        Route::get('/beraspk_index_kemarin', [AdminController::class, 'beraspk_index_kemarin'])->name('beraspk_index_kemarin');
        Route::get('/beraspk_index_sekarang', [AdminController::class, 'beraspk_index_sekarang'])->name('beraspk_index_sekarang');
        Route::get('/beraspk_index_besok', [AdminController::class, 'beraspk_index_besok'])->name('beraspk_index_besok');
        Route::get('/berasdsurgent_index_kemarin', [AdminController::class, 'berasdsurgent_index_kemarin'])->name('berasdsurgent_index_kemarin');
        Route::get('/berasdsurgent_index_sekarang', [AdminController::class, 'berasdsurgent_index_sekarang'])->name('berasdsurgent_index_sekarang');
        Route::get('/berasdsurgent_index_besok', [AdminController::class, 'berasdsurgent_index_besok'])->name('berasdsurgent_index_besok');
        Route::get('/berasdsnoturgent_index_sekarang', [AdminController::class, 'berasdsnoturgent_index_sekarang'])->name('berasdsnoturgent_index_sekarang');
        Route::get('/po_diterima_index', [AdminController::class, 'po_diterima_index'])->name('po_diterima_index');
        Route::get('/data_revisi', [AdminController::class, 'data_revisi'])->name('data_revisi');
        Route::get('/data_revisi_index', [AdminController::class, 'data_revisi_index'])->name('data_revisi_index');
        Route::get('/po_parkir', [AdminController::class, 'po_parkir'])->name('po_parkir');
        Route::get('/po_parkir_index', [AdminController::class, 'po_parkir_index'])->name('po_parkir_index');
        Route::get('/po_on_call', [AdminController::class, 'po_on_call'])->name('po_on_call');
        Route::get('/po_on_call_index', [AdminController::class, 'po_on_call_index'])->name('po_on_call_index');
        Route::get('/po_bongkar', [AdminController::class, 'po_bongkar'])->name('po_bongkar');
        Route::get('/po_bongkar_index', [AdminController::class, 'po_bongkar_index'])->name('po_bongkar_index');
        Route::get('/show_nopol/{id?}', [AdminController::class, 'show_nopol'])->name('show_nopol');
        Route::post('/update_nopol', [AdminController::class, 'update_nopol'])->name('update_nopol');
        Route::get('/data_po_diterima_index', [AdminController::class, 'data_po_diterima_index'])->name('data_po_diterima_index');
        Route::get('/po_ditolak_index', [AdminController::class, 'po_ditolak_index'])->name('po_ditolak_index');
        Route::get('/data_po_ditolak_index', [AdminController::class, 'data_po_ditolak_index'])->name('data_po_ditolak_index');
        Route::get('/gabah_kering', [AdminController::class, 'gabah_kering'])->name('gabah_kering');
        Route::get('/gabah_basah', [AdminController::class, 'gabah_basah'])->name('gabah_basah');
        Route::get('/beras_pk', [AdminController::class, 'beras_pk'])->name('beras_pk');
        Route::get('/beras_ds_urgent', [AdminController::class, 'beras_ds_urgent'])->name('beras_ds_urgent');
        Route::get('/beras_ds_noturgent', [AdminController::class, 'beras_ds_noturgent'])->name('beras_ds_noturgent');
        Route::get('/po_diterima', [AdminController::class, 'po_diterima'])->name('po_diterima');
        Route::get('/po_ditolak', [AdminController::class, 'po_ditolak'])->name('po_ditolak');
        Route::get('/po_pending', [AdminController::class, 'po_pending'])->name('po_pending');
        Route::get('/po_pending_index', [AdminController::class, 'po_pending_index'])->name('po_pending_index');
        Route::get('/unloading_location', [AdminController::class, 'unloading_location'])->name('unloading_location');
        Route::get('/unloading_location_index', [AdminController::class, 'unloading_location_index'])->name('unloading_location_index');
        Route::post('/terima_data_po', [AdminController::class, 'terima_data_po'])->name('terima_data_po');
        Route::get('/tolak_po_telat/{id?}', [AdminController::class, 'tolak_po_telat'])->name('tolak_po_telat');
        Route::post('/terima_data_po_telat', [AdminController::class, 'terima_data_po_telat'])->name('terima_data_po_telat');
        Route::get('/show/penerimaan_po/{id?}', [AdminController::class, 'show_penerimaan_po'])->name('show.penerimaan_po');
        Route::get('/to_satpam_for_bonkar/{id?}', [AdminController::class, 'to_satpam_for_bonkar'])->name('to_satpam_for_bonkar');
        Route::get('/getnotifikasisecurity', [AdminController::class, 'get_notifikasisecurity'])->name('get_notifikasisecurity');
        Route::get('/get_notif_security_all', [AdminController::class, 'get_notif_security_all'])->name('get_notif_security_all');
        Route::get('/get_notif_security_all_index', [AdminController::class, 'get_notif_security_all_index'])->name('get_notif_security_all_index');
        Route::get('/getcountnotifikasisecurity', [AdminController::class, 'get_countnotifikasisecurity'])->name('get_countnotifikasisecurity');
        Route::get('/setnotifikasisecurity', [AdminController::class, 'set_notifikasisecurity'])->name('set_notifikasisecurity');
        Route::get('/newnotifikasisecurity', [AdminController::class, 'new_notifikasisecurity'])->name('new_notifikasisecurity');
        Route::get('/get_count_notifikasi_security', [AdminController::class, 'get_count_notifikasi_security'])->name('get_count_notifikasi_security');
        Route::get('/cetak_po/{id?}', [AdminController::class, 'cetak_po'])->name('cetak_po');
        Route::post('/security_logout', [AdminController::class, 'security_logout'])->name('security_logout');

        // Notif
        Route::post('/updateDeviceToken', [AdminController::class, 'updateDeviceToken'])->name('updateDeviceToken');
        Route::get('optimize', function () {
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            Artisan::call('route:clear');
            Artisan::call('config:clear');
            Artisan::call('optimize:clear');


            Artisan::call('view:cache');
            Artisan::call('route:cache');
            Artisan::call('config:cache');
            Artisan::call('optimize');

            echo 'optimize clear';
        });
    });
});

Route::prefix('sourching')->name('sourching.')->group(function () {

    Route::middleware(['guest:sourching', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.superadmin.login')->name('login');
        Route::view('/register', 'dashboard.superadmin.register')->name('register');
        Route::post('/create', [SuperadminController::class, 'create'])->name('create');
        Route::post('/check', [SuperadminController::class, 'check'])->name('check');

        //Route::post('/bid_store',[superadminController::class,'bid_store'])->name('bid_store');
    });

    Route::middleware(['auth:sourching', 'PreventBackHistory'])->group(function () {

        Route::get('/home', [SuperadminController::class, 'home'])->name('home');
        Route::get('/transaction', [SuperadminController::class, 'transaction'])->name('transaction');
        Route::get('/output_data', [SuperadminController::class, 'output_data'])->name('output_data');
        Route::get('/bid_response/list_bid_po/{id?}', [SuperadminController::class, 'list_bid_po'])->name('list_bid_po');
        Route::get('/bid_response/list_bid_po_index/{id?}', [SuperadminController::class, 'list_bid_po_index'])->name('list_bid_po_index');
        Route::get('/list_po_diterima', [SuperadminController::class, 'list_po_diterima'])->name('list_po_diterima');
        Route::get('/list_data_po_diterima_index', [SuperadminController::class, 'list_data_po_diterima_index'])->name('list_data_po_diterima_index');
        Route::get('/output_data_index', [SuperadminController::class, 'output_data_index'])->name('output_data_index');
        Route::get('/data_purchasing', [SuperadminController::class, 'data_purchasing'])->name('data_purchasing');
        Route::get('/status_pending/{id?}', [SuperadminController::class, 'status_pending'])->name('status_pending');
        Route::get('/cetak_po/{id?}', [SuperadminController::class, 'cetak_po'])->name('cetak_po');
        Route::get('/cekusername/{id?}', [SuperadminController::class, 'cekUsername'])->name('cekusername');
        Route::get('/get_npwp/{id?}', [SuperadminController::class, 'get_npwp'])->name('get_npwp');
        Route::get('/get_nik/{id?}', [SuperadminController::class, 'get_nik'])->name('get_nik');
        Route::get('/get_verifyemail/{id?}', [SuperadminController::class, 'get_verifyemail'])->name('get_verifyemail');
        // Data Sourching
        // On Prosess
        Route::get('/data_sourching_onprocess', [SuperadminController::class, 'data_sourching_onprocess'])->name('data_sourching_onprocess');
        Route::get('/data_sourching_onprocess_gb_ciherang_index', [SuperadminController::class, 'data_sourching_onprocess_gb_ciherang_index'])->name('data_sourching_onprocess_gb_ciherang_index');
        Route::get('/data_sourching_onprocess_gb_pandan_wangi_index', [SuperadminController::class, 'data_sourching_onprocess_gb_pandan_wangi_index'])->name('data_sourching_onprocess_gb_pandan_wangi_index');
        Route::get('/data_sourching_onprocess_gb_longgrain_index', [SuperadminController::class, 'data_sourching_onprocess_gb_longgrain_index'])->name('data_sourching_onprocess_gb_longgrain_index');
        Route::get('/data_sourching_onprocess_gb_ketan_putih_index', [SuperadminController::class, 'data_sourching_onprocess_gb_ketan_putih_index'])->name('data_sourching_onprocess_gb_ketan_putih_index');
        Route::get('/data_sourching_onprocess_pk_index', [SuperadminController::class, 'data_sourching_onprocess_pk_index'])->name('data_sourching_onprocess_pk_index');

        // On Deal
        Route::get('/data_sourching_deal', [SuperadminController::class, 'data_sourching_deal'])->name('data_sourching_deal');
        Route::get('/data_sourching_deal_gb_longgrain_index', [SuperadminController::class, 'data_sourching_deal_gb_longgrain_index'])->name('data_sourching_deal_gb_longgrain_index');
        Route::get('/data_sourching_deal_gb_ciherang_index', [SuperadminController::class, 'data_sourching_deal_gb_ciherang_index'])->name('data_sourching_deal_gb_ciherang_index');
        Route::get('/data_sourching_deal_gb_pandan_wangi_index', [SuperadminController::class, 'data_sourching_deal_gb_pandan_wangi_index'])->name('data_sourching_deal_gb_pandan_wangi_index');
        Route::get('/data_sourching_deal_gb_ketan_putih_index', [SuperadminController::class, 'data_sourching_deal_gb_ketan_putih_index'])->name('data_sourching_deal_gb_ketan_putih_index');
        Route::get('/data_sourching_deal_pk_index', [SuperadminController::class, 'data_sourching_deal_pk_index'])->name('data_sourching_deal_pk_index');

        // Nego
        Route::get('/data_sourching_nego', [SuperadminController::class, 'data_sourching_nego'])->name('data_sourching_nego');
        Route::get('/data_sourching_nego_gb_ciherang_index', [SuperadminController::class, 'data_sourching_nego_gb_ciherang_index'])->name('data_sourching_nego_gb_ciherang_index');
        Route::get('/data_sourching_nego_gb_longgrain_index', [SuperadminController::class, 'data_sourching_nego_gb_longgrain_index'])->name('data_sourching_nego_gb_longgrain_index');
        Route::get('/data_sourching_nego_gb_pandan_wangi_index', [SuperadminController::class, 'data_sourching_nego_gb_pandan_wangi_index'])->name('data_sourching_nego_gb_pandan_wangi_index');
        Route::get('/data_sourching_nego_gb_ketan_putih_index', [SuperadminController::class, 'data_sourching_nego_gb_ketan_putih_index'])->name('data_sourching_nego_gb_ketan_putih_index');
        Route::get('/data_sourching_nego_pk_index', [SuperadminController::class, 'data_sourching_nego_pk_index'])->name('data_sourching_nego_pk_index');

        // Output Nego
        Route::get('/data_sourching_output_nego', [SuperadminController::class, 'data_sourching_output_nego'])->name('data_sourching_output_nego');
        Route::get('/data_sourching_output_nego_gb_index', [SuperadminController::class, 'data_sourching_output_nego_gb_index'])->name('data_sourching_output_nego_gb_index');
        Route::get('/data_sourching_output_nego_pk_index', [SuperadminController::class, 'data_sourching_output_nego_pk_index'])->name('data_sourching_output_nego_pk_index');

        // update status 
        Route::get('/status_deal_gb/{id?}', [SuperadminController::class, 'status_deal_gb'])->name('status_deal_gb');
        Route::get('/status_deal_pk/{id?}', [SuperadminController::class, 'status_deal_pk'])->name('status_deal_pk');
        Route::get('/status_nego_gb/{id?}', [SuperadminController::class, 'status_nego_gb'])->name('status_nego_gb');
        Route::get('/status_nego_pk/{id?}', [SuperadminController::class, 'status_nego_pk'])->name('status_nego_pk');

        Route::post('logout', [SuperadminController::class, 'logout'])->name('logout');
        Route::get('/bid', [SuperadminController::class, 'bid'])->name('bid');
        Route::get('/late_delivery', [SuperadminController::class, 'late_delivery'])->name('late_delivery');
        Route::get('/perpanjang_po/{id?}', [SuperadminController::class, 'perpanjang_po'])->name('perpanjang_po');
        Route::get('/vendor', [SuperadminController::class, 'vendor'])->name('vendor');
        Route::get('/account', [SuperadminController::class, 'account'])->name('account');
        Route::get('/news', [SuperadminController::class, 'news'])->name('news');
        Route::get('/broadcast', [SuperadminController::class, 'broadcast'])->name('broadcast');
        Route::get('/populer', [SuperadminController::class, 'populer'])->name('populer');
        Route::get('/invoice', [SuperadminController::class, 'generateInvoicePDF'])->name('invoice');
        // Route::get('/invoice', array('as'=> 'generate.invoice.pdf', 'uses' => 'SuperadminController@generateInvoicePDF'));

        Route::post('/download_data_sourching_deal_gb_excel', [SuperadminController::class, 'download_data_sourching_deal_gb_excel'])->name('download_data_sourching_deal_gb_excel');
        Route::post('/download_data_pesanan_pemebelian_aol', [SuperadminController::class, 'download_data_pesanan_pemebelian_aol'])->name('download_data_pesanan_pemebelian_aol');
        Route::post('/download_data_sourching_deal_filter_gb_excel', [SuperadminController::class, 'download_data_sourching_deal_filter_gb_excel'])->name('download_data_sourching_deal_filter_gb_excel');
        Route::post('/download_data_sourching_deal_pk_excel', [SuperadminController::class, 'download_data_sourching_deal_pk_excel'])->name('download_data_sourching_deal_pk_excel');
        Route::post('/coba_download', [SuperadminController::class, 'coba_download'])->name('coba_download');



        require('api_superadmin.php');

        // TAGIHAN
        Route::get('/tagihan', [SuperadminController::class, 'tagihan'])->name('tagihan');
        Route::get('/tagihan_index', [SuperadminController::class, 'tagihan_index'])->name('tagihan_index');
        Route::get('/tagihan1_index', [SuperadminController::class, 'tagihan1_index'])->name('tagihan1_index');
        Route::post('/upload_tagihan', [SuperadminController::class, 'upload_tagihan'])->name('upload_tagihan');
        Route::post('/update_tagihan', [SuperadminController::class, 'update_tagihan'])->name('update_tagihan');
        Route::get('/delete_tagihan/{id?}', [SuperadminController::class, 'delete_tagihan'])->name('delete_tagihan');
    });

    Route::get('/vendor/export_excel', [SuperadminController::class, 'vendor_export_excel'])->name('vendor_export_excel');
    Route::get('/vendor/export_pdf', [SuperadminController::class, 'vendor_export_pdf'])->name('vendor_export_pdf');
    Route::get('/vendor/print', [SuperadminController::class, 'vendor_print'])->name('vendor_print');
    Route::get('/vendor/export_csv', [SuperadminController::class, 'vendor_export_csv'])->name('vendor_export_csv');
    Route::get('/vendor/vendor_print_form/{id?}', [SuperadminController::class, 'vendor_print_form'])->name('vendor_print_form');

    // ADMIN MASTER

});
Route::prefix('master')->name('master.')->group(function () {

    Route::middleware(['guest:master', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.admin_master.login')->name('login');
        Route::post('/check', [MasterController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:master', 'PreventBackHistory'])->group(function () {
        Route::post('/master_logout', [MasterController::class, 'master_logout'])->name('master_logout');
        Route::get('/home', [MasterController::class, 'home'])->name('home');
        Route::get('/account_master', [MasterController::class, 'account_master'])->name('account_master');
        Route::post('/account_update', [MasterController::class, 'account_update'])->name('account_update');
        Route::get('/get_notifdataAll', [MasterController::class, 'get_notifdataAll'])->name('get_notifdataAll');

        // ADMIN AP

        require('api_masterap.php');
        // ADMIN SPV AP
        require('api_masterspvap.php');

        // ADMIN TIMBANGAN

        Route::get('/timbangan_awal', [MasterController::class, 'timbangan_awal'])->name('timbangan_awal');
        Route::get('/timbangan_awal_gb_ciherang_index', [MasterController::class, 'timbangan_awal_gb_ciherang_index'])->name('timbangan_awal_gb_ciherang_index');
        Route::get('/timbangan_awal_gb_longgrain_index', [MasterController::class, 'timbangan_awal_gb_longgrain_index'])->name('timbangan_awal_gb_longgrain_index');
        Route::get('/timbangan_awal_gb_pandan_wangi_index', [MasterController::class, 'timbangan_awal_gb_pandan_wangi_index'])->name('timbangan_awal_gb_pandan_wangi_index');
        Route::get('/timbangan_awal_gb_ketan_putih_index', [MasterController::class, 'timbangan_awal_gb_ketan_putih_index'])->name('timbangan_awal_gb_ketan_putih_index');
        Route::get('/timbangan_awal_pk_index', [MasterController::class, 'timbangan_awal_pk_index'])->name('timbangan_awal_pk_index');
        Route::get('/data_timbangan_awal', [MasterController::class, 'data_timbangan_awal'])->name('data_timbangan_awal');
        Route::get('/data_timbangan_awal_gb_longgrain_index', [MasterController::class, 'data_timbangan_awal_gb_longgrain_index'])->name('data_timbangan_awal_gb_longgrain_index');
        Route::get('/data_timbangan_awal_gb_ciherang_index', [MasterController::class, 'data_timbangan_awal_gb_ciherang_index'])->name('data_timbangan_awal_gb_ciherang_index');
        Route::get('/data_timbangan_awal_gb_pandan_wangi_index', [MasterController::class, 'data_timbangan_awal_gb_pandan_wangi_index'])->name('data_timbangan_awal_gb_pandan_wangi_index');
        Route::get('/data_timbangan_awal_gb_ketan_putih_index', [MasterController::class, 'data_timbangan_awal_gb_ketan_putih_index'])->name('data_timbangan_awal_gb_ketan_putih_index');
        Route::get('/data_timbangan_awal_pk_index', [MasterController::class, 'data_timbangan_awal_pk_index'])->name('data_timbangan_awal_pk_index');
        Route::get('/antrian_timbangan_masuk/{id?}', [MasterController::class, 'show_antrian_timbangan_masuk'])->name('show_timbangan_awal');
        Route::post('/terima_tonase_awal', [MasterController::class, 'terima_tonase_awal'])->name('terima_tonase_awal');


        // Timbangan Akhir
        Route::get('/total_tonase', [MasterController::class, 'total_tonase'])->name('total_tonase');
        Route::get('/timbangan_akhir', [MasterController::class, 'timbangan_akhir'])->name('timbangan_akhir');
        Route::get('/timbangan_akhir_gb_longgrain_index', [MasterController::class, 'timbangan_akhir_gb_longgrain_index'])->name('timbangan_akhir_gb_longgrain_index');
        Route::get('/timbangan_akhir_gb_ciherang_index', [MasterController::class, 'timbangan_akhir_gb_ciherang_index'])->name('timbangan_akhir_gb_ciherang_index');
        Route::get('/timbangan_akhir_gb_pandan_wangi_index', [MasterController::class, 'timbangan_akhir_gb_pandan_wangi_index'])->name('timbangan_akhir_gb_pandan_wangi_index');
        Route::get('/timbangan_akhir_gb_ketan_putih_index', [MasterController::class, 'timbangan_akhir_gb_ketan_putih_index'])->name('timbangan_akhir_gb_ketan_putih_index');
        Route::get('/timbangan_akhir_pk_index', [MasterController::class, 'timbangan_akhir_pk_index'])->name('timbangan_akhir_pk_index');
        Route::get('/data_timbangan_akhir', [MasterController::class, 'data_timbangan_akhir'])->name('data_timbangan_akhir');
        Route::get('/data_timbangan_akhir_gb_ciherang_index', [MasterController::class, 'data_timbangan_akhir_gb_ciherang_index'])->name('data_timbangan_akhir_gb_ciherang_index');
        Route::get('/data_timbangan_akhir_gb_longgrain_index', [MasterController::class, 'data_timbangan_akhir_gb_longgrain_index'])->name('data_timbangan_akhir_gb_longgrain_index');
        Route::get('/data_timbangan_akhir_gb_pandan_wangi_index', [MasterController::class, 'data_timbangan_akhir_gb_pandan_wangi_index'])->name('data_timbangan_akhir_gb_pandan_wangi_index');
        Route::get('/data_timbangan_akhir_gb_ketan_putih_index', [MasterController::class, 'data_timbangan_akhir_gb_ketan_putih_index'])->name('data_timbangan_akhir_gb_ketan_putih_index');
        Route::get('/data_timbangan_akhir_pk_index', [MasterController::class, 'data_timbangan_akhir_pk_index'])->name('data_timbangan_akhir_pk_index');
        Route::get('/data_revisi_timbangan', [MasterController::class, 'data_revisi_timbangan'])->name('data_revisi_timbangan');
        Route::get('/data_revisi_timbangan_longgrain_index', [MasterController::class, 'data_revisi_timbangan_longgrain_index'])->name('data_revisi_timbangan_longgrain_index');
        Route::get('/data_revisi_timbangan_ciherang_index', [MasterController::class, 'data_revisi_timbangan_ciherang_index'])->name('data_revisi_timbangan_ciherang_index');
        Route::get('/data_revisi_timbangan_pandan_wangi_index', [MasterController::class, 'data_revisi_timbangan_pandan_wangi_index'])->name('data_revisi_timbangan_pandan_wangi_index');
        Route::get('/data_revisi_timbangan_ketan_putih_index', [MasterController::class, 'data_revisi_timbangan_ketan_putih_index'])->name('data_revisi_timbangan_ketan_putih_index');
        Route::post('/timbangan_revisi', [MasterController::class, 'revisi_timbangan_update'])->name('revisi_timbangan_update');
        Route::get('/antrian_timbangan_keluar/{id?}', [MasterController::class, 'show_timbangan_akhir'])->name('show_timbangan_akhir');
        Route::post('/terima_tonase_akhir', [MasterController::class, 'terima_tonase_akhir'])->name('terima_tonase_akhir');
        Route::get('/cetak_penerimaanpo/{id?}', [MasterController::class, 'cetak_penerimaanpo'])->name('cetak_penerimaanpo');
        Route::get('/cetak_penerimaanpo_pk/{id?}', [MasterController::class, 'cetak_penerimaanpo_pk'])->name('cetak_penerimaanpo_pk');
        Route::get('/cetak_penerimaanpo_2/{id?}', [MasterController::class, 'cetak_penerimaanpo_2'])->name('cetak_penerimaanpo_2');
        Route::get('/cetak_penerimaanpo2_pk/{id?}', [MasterController::class, 'cetak_penerimaanpo2_pk'])->name('cetak_penerimaanpo2_pk');
        Route::get('/show_timbangan_revisi/{id?}', [MasterController::class, 'show_timbangan_revisi'])->name('show_timbangan_revisi');
        // download file
        Route::post('/download_excel', [MasterController::class, 'download_excel'])->name('download_excel');
        Route::post('/download_penerimaan_barang_excel', [MasterController::class, 'download_penerimaan_barang_excel'])->name('download_penerimaan_barang_excel');
        Route::get('/download_print', [MasterController::class, 'download_print'])->name('download_print');
        Route::post('/download_pdf', [MasterController::class, 'download_pdf'])->name('download_pdf');
        Route::post('/download_csv', [MasterController::class, 'download_csv'])->name('download_csv');

        // Notif Timbangan
        Route::get('/getcountnotif_tonaseawal', [MasterController::class, 'getcountnotif_tonaseawal'])->name('getcountnotif_tonaseawal');
        Route::get('/getcountnotif_revisitonase', [MasterController::class, 'getcountnotif_revisitonase'])->name('getcountnotif_revisitonase');
        Route::get('/getcountnotif_tonaseakhir', [MasterController::class, 'getcountnotif_tonaseakhir'])->name('getcountnotif_tonaseakhir');
        Route::get('/getcountnotif_datatonaseawal', [MasterController::class, 'getcountnotif_datatonaseawal'])->name('getcountnotif_datatonaseawal');
        Route::get('/getcountnotif_datatonaseakhir', [MasterController::class, 'getcountnotif_datatonaseakhir'])->name('getcountnotif_datatonaseakhir');

        // LOG ACTIVITY TIMBANGAN
        Route::get('/log_activity_timbangan', [MasterController::class, 'log_activity_timbangan'])->name('log_activity_timbangan');
        Route::get('/log_activity_timbangan_index', [MasterController::class, 'log_activity_timbangan_index'])->name('log_activity_timbangan_index');


        // ADMIN QC BONGKAR
        require('api_masterqcbongkar.php');


        // ADMIN SPV QC
        require('api_masterlab.php');
        require('api_masterspvqc.php');


        // ADMIN SECURITY

        require('api_mastersecurity.php');

        // ADMIN SOURCHING
        require('api_mastersourching.php');

        // LOG ACTIVITY SUPPLIER
        Route::get('/log_activity_user', [MasterController::class, 'log_activity_user'])->name('log_activity_user');
        Route::get('/log_activity_user_index', [MasterController::class, 'log_activity_user_index'])->name('log_activity_user_index');

        // TRACKER PO
        Route::get('/tracker_po', [MasterController::class, 'tracker_po'])->name('tracker_po');
        Route::get('/tracker_po_index', [MasterController::class, 'tracker_po_index'])->name('tracker_po_index');
    });
    Route::get('optimize', function () {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('optimize:clear');


        Artisan::call('view:cache');
        Artisan::call('route:cache');
        Artisan::call('config:cache');
        Artisan::call('optimize');

        echo 'optimize clear';
    });
});
