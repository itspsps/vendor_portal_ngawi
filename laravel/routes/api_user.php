<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\BidController;
use App\Http\Controllers\User\UserController;


Route::get('/news_detail/{id?}', [UserController::class, 'news_detail'])->name('news_detail');
Route::get('/listnews', [UserController::class, 'listnews'])->name('listnews');

Route::get('/detail_pengajuan/{id?}', [UserController::class, 'detail_pengajuan'])->name('detail_pengajuan');
Route::get('/lihat_po/{id?}', [UserController::class, 'lihat_po'])->name('lihat_po');

Route::get('/bid_show/{id?}', [UserController::class, 'bidshow'])->name('bid_show');
Route::get('/transaksi_index', [UserController::class, 'transaksi_index'])->name('transaksi_index');
Route::get('/transaksi_detail/{id?}', [UserController::class, 'transaksi_detail'])->name('transaksi_detail');
Route::get('/riwayat_index', [UserController::class, 'riwayat_index'])->name('riwayat_index');
Route::post('/akun_update/{id?}', [UserController::class, 'update_akun'])->name('akun_update');
Route::post('/bank_update/{id?}', [UserController::class, 'update_bank'])->name('bank_update');
Route::post('/npwp_update/{id?}', [UserController::class, 'update_npwp'])->name('npwp_update');
Route::post('/ktp_update/{id?}', [UserController::class, 'update_ktp'])->name('ktp_update');
Route::get('/status_pengiriman/{id?}', [UserController::class, 'status_pengiriman'])->name('status_pengiriman');
Route::post('/konfirmasi_bongkar', [UserController::class, 'konfirmasi_bongkar'])->name('konfirmasi_bongkar');
Route::get('/video_panduan', [UserController::class, 'video_panduan'])->name('video_panduan');
Route::get('/buku_panduan', [UserController::class, 'buku_panduan'])->name('buku_panduan');
Route::get('/getcount_notifikasi', [UserController::class, 'getcount_notifikasi'])->name('getcount_notifikasi');
Route::get('/getcount_transaksi', [UserController::class, 'getcount_transaksi'])->name('getcount_transaksi');
Route::get('/getcount_notif', [UserController::class, 'getcount_notif'])->name('getcount_notif');
Route::get('/getcount_pajak', [UserController::class, 'getcount_pajak'])->name('getcount_pajak');
