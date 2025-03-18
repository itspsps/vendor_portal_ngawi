<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Superadmin\BidController;
use App\Http\Controllers\Superadmin\SuperadminController;
use App\Http\Controllers\Superadmin\NewsController;
use App\Http\Controllers\Superadmin\PopulerController;
use App\Http\Controllers\Superadmin\TransaksiController;
use App\Http\Controllers\Superadmin\BroadcastController;
use App\Http\Controllers\Superadmin;

Route::get('/bid_gb_index', [BidController::class, 'bid_gb_index'])->name('bid_gb_index');
Route::get('/bid_pk_index', [BidController::class, 'bid_pk_index'])->name('bid_pk_index');
Route::get('/bid_ds_index', [BidController::class, 'bid_ds_index'])->name('bid_ds_index');
Route::post('/bid_store', [BidController::class, 'store'])->name('bid_store');
Route::get('/bid_show/{id?}', [BidController::class, 'show'])->name('bid_show');
Route::post('/add_kuota', [BidController::class, 'add_kuota'])->name('add_kuota');
Route::get('/delete_add_kuota/{id?}', [BidController::class, 'delete_add_kuota'])->name('delete_add_kuota');
Route::post('/bid/update/{id?}', [BidController::class, 'update'])->name('bid_update');
Route::get('/bid_destroy/{id_bid?}', [BidController::class, 'destroy'])->name('bid_destroy');
Route::get('/bid_response/{id_bid?}', [BidController::class, 'response'])->name('bid_response');
Route::get('/list_approve_po/{id_bid?}', [BidController::class, 'list_approve_po'])->name('list_approve_po');
Route::get('/data_list_index/{id?}', [BidController::class, 'data_list_index'])->name('data_list_index');
Route::get('/data_list_pk_index/{id?}', [BidController::class, 'data_list_pk_index'])->name('data_list_pk_index');
Route::get('/data_list_ds_index/{id?}', [BidController::class, 'data_list_ds_index'])->name('data_list_ds_index');
Route::get('/bid_status/{id_bid?}', [BidController::class, 'bid_status'])->name('bid_status');
Route::get('/status_pending/{id?}', [BidController::class, 'status_pending'])->name('status_pending');


Route::get('/transaksi_index', [TransaksiController::class, 'transaksi_index'])->name('transaksi_index');
Route::post('/transaksi_update', [TransaksiController::class, 'transaksi_update'])->name('transaksi_update');
Route::get('/transaksi_show/{id?}', [TransaksiController::class, 'transaksi_show'])->name('transaksi_show');
Route::get('/transaksi_struk', [TransaksiController::class, 'transaksi_struk'])->name('transaksi_struk');
Route::get('/detail_transaksi/{id?}', [TransaksiController::class, 'detail_transaksi'])->name('detail_transaksi');
Route::get('/print_struk/{id?}', [TransaksiController::class, 'print_struk'])->name('print_struk');
Route::get('/print_pdf_struk/{id?}', [TransaksiController::class, 'print_pdf_struk'])->name('print_pdf_struk');


Route::get('/response_index', [BidController::class, 'response_index'])->name('response_index');
Route::get('/bid_user/{id?}', [BidController::class, 'bid_user'])->name('bid_user');
Route::post('/approve_bid', [BidController::class, 'approve_bid'])->name('approve_bid');
Route::post('/konfirmasi_bongkar', [BidController::class, 'konfirmasi_bongkar'])->name('konfirmasi_bongkar');

Route::get('/add_vendor', [SuperadminController::class, 'add_vendor'])->name('add_vendor');
Route::post('/vendor_store', [BidController::class, 'approve_store'])->name('approve_store');
Route::post('/vendor_store', [SuperadminController::class, 'vendor_store'])->name('vendor_store');
Route::get('/vendor_index', [SuperadminController::class, 'vendor_index'])->name('vendor_index');
Route::get('/vendor_destroy/{id?}', [SuperadminController::class, 'vendor_destroy'])->name('vendor_destroy');
Route::get('/vendor_show/{id?}', [SuperadminController::class, 'vendor_show'])->name('vendor_show');
Route::post('/vendor/update/{id?}', [SuperadminController::class, 'vendor_update'])->name('vendor_update');
Route::post('/vendor/vendor_update_npwp', [SuperadminController::class, 'vendor_update_npwp'])->name('vendor_update_npwp');
Route::post('/vendor/vendor_update_ktp/{id?}', [SuperadminController::class, 'vendor_update_ktp'])->name('vendor_update_ktp');
Route::post('/vendor/vendor_update_pembayaran/{id?}', [SuperadminController::class, 'vendor_update_pembayaran'])->name('vendor_update_pembayaran');
Route::post('/vendor/vendor_update_profil/{id?}', [SuperadminController::class, 'vendor_update_profil'])->name('vendor_update_profil');
Route::get('/vendor/status/{id?}', [SuperadminController::class, 'vendor_status'])->name('vendor_status');
Route::get('/vendor/detail/{id?}', [SuperadminController::class, 'vendor_detail'])->name('vendor_detail');

Route::post('/account_update', [SuperadminController::class, 'account_update'])->name('account_update');

Route::post('/news_store', [NewsController::class, 'news_store'])->name('news_store');
Route::get('/news_index', [NewsController::class, 'news_index'])->name('news_index');
Route::get('/news_destroy/{id?}', [NewsController::class, 'news_destroy'])->name('news_destroy');
Route::get('/news_show/{id?}', [NewsController::class, 'news_show'])->name('news_show');

Route::post('/broadcast_store', [BroadcastController::class, 'broadcast_store'])->name('broadcast_store');
Route::get('/broadcast_index', [BroadcastController::class, 'broadcast_index'])->name('broadcast_index');
Route::post('/broadcast_update', [BroadcastController::class, 'broadcast_update'])->name('broadcast_update');
Route::get('/broadcast_destroy/{id?}', [BroadcastController::class, 'broadcast_destroy'])->name('broadcast_destroy');
Route::get('/broadcast_show/{id?}', [BroadcastController::class, 'broadcast_show'])->name('broadcast_show');

Route::get('/purchasing_index', [SuperadminController::class, 'purchasing_index'])->name('purchasing_index');
Route::get('/purchasing_show/{id?}', [SuperadminController::class, 'purchasing_show'])->name('purchasing_show');

Route::post('/populer_store', [PopulerController::class, 'populer_store'])->name('populer_store');
Route::get('/populer_index', [PopulerController::class, 'populer_index'])->name('populer_index');
Route::get('/populer_status/{id?}', [PopulerController::class, 'populer_status'])->name('populer_status');
Route::post('/populer_update', [PopulerController::class, 'populer_update'])->name('populer_update');
Route::get('/populer_updatestatus/{id?}', [PopulerController::class, 'populer_updatestatus'])->name('populer_updatestatus');
Route::get('/populer_destroy/{id?}', [PopulerController::class, 'populer_destroy'])->name('populer_destroy');
Route::get('/populer_show/{id?}', [PopulerController::class, 'populer_show'])->name('populer_show');

Route::get('/getkabupaten', [SuperadminController::class, 'getkabupaten'])->name('getkabupaten');
Route::get('/getkecamatan', [SuperadminController::class, 'getkecamatan'])->name('getkecamatan');
Route::get('/getdesa', [SuperadminController::class, 'getdesa'])->name('getdesa');



Route::get('/generate', [SuperadminController::class, 'generate'])->name('generate');


// Notif Firebase

Route::post('/save_token', [SuperadminController::class, 'save_token'])->name('save_token');

// NOTIF BID
Route::get('/getcount_bid', [SuperadminController::class, 'getcount_bid'])->name('getcount_bid');
Route::get('/getcount_bid_gb', [SuperadminController::class, 'getcount_bid_gb'])->name('getcount_bid_gb');
Route::get('/getcount_bid_pk', [SuperadminController::class, 'getcount_bid_pk'])->name('getcount_bid_pk');
Route::get('/getcount_bid_ds', [SuperadminController::class, 'getcount_bid_ds'])->name('getcount_bid_ds');

Route::get('chart_po/', [SuperadminController::class, 'chart_po'])->name('chart_po');
// Notifikasi sourching
Route::get('setnotifikasisourching/', [SuperadminController::class, 'set_notifikasisourching'])->name('set_notifikasisourching');
Route::get('newnotifikasisourching/', [SuperadminController::class, 'new_notifikasisourching'])->name('new_notifikasisourching');
Route::get('getnotifikasisourching', [SuperadminController::class, 'get_notifikasisourching'])->name('get_notifikasisourching');
Route::get('get_notif_sourching_all/', [SuperadminController::class, 'get_notif_sourching_all'])->name('get_notif_sourching_all');
Route::get('get_notif_sourching_all_index/', [SuperadminController::class, 'get_notif_sourching_all_index'])->name('get_notif_sourching_all_index');
Route::get('getcountnotifikasisourching', [SuperadminController::class, 'get_countnotifikasisourching'])->name('get_countnotifikasisourching');
Route::get('notifikasi_clear', [SuperadminController::class, 'notifikasi_clear'])->name('notifikasi_clear');
