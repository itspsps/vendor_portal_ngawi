<?php

use App\Http\Controllers\AdminMaster\MasterApController;
use Illuminate\Support\Facades\Route;

Route::get('/data_pembelian_gb', [MasterApController::class, 'data_pembelian_gb'])->name('data_pembelian_gb');
Route::get('/data_pembelian_pk', [MasterApController::class, 'data_pembelian_pk'])->name('data_pembelian_pk');
Route::get('/data_pembelian_gb_ciherang_index', [MasterApController::class, 'data_pembelian_gb_ciherang_index'])->name('data_pembelian_gb_ciherang_index');
Route::get('/data_pembelian_gb_longgrain_index', [MasterApController::class, 'data_pembelian_gb_longgrain_index'])->name('data_pembelian_gb_longgrain_index');
Route::get('/data_pembelian_gb_longgrain1_index', [MasterApController::class, 'data_pembelian_gb_longgrain1_index'])->name('data_pembelian_gb_longgrain1_index');
Route::get('/data_pembelian_gb_pandan_wangi_index', [MasterApController::class, 'data_pembelian_gb_pandan_wangi_index'])->name('data_pembelian_gb_pandan_wangi_index');
Route::get('/data_pembelian_gb_ketan_putih_index', [MasterApController::class, 'data_pembelian_gb_ketan_putih_index'])->name('data_pembelian_gb_ketan_putih_index');
Route::get('/data_pembelian_pk_index', [MasterApController::class, 'data_pembelian_pk_index'])->name('data_pembelian_pk_index');
Route::get('/getcount_verifikasi', [MasterApController::class, 'getcount_verifikasi'])->name('getcount_verifikasi');
Route::get('/getcount_verified', [MasterApController::class, 'getcount_verified'])->name('getcount_verified');

Route::get('/data_pembelian_show/{id?}', [MasterApController::class, 'data_pembelian_show'])->name('data_pembelian_show');
Route::post('/data_pembelian_update', [MasterApController::class, 'data_pembelian_update'])->name('data_pembelian_update');
Route::get('/revisi_data_ap_pk', [MasterApController::class, 'revisi_data_ap_pk'])->name('revisi_data_ap_pk');
Route::get('/revisi_data_ap_pk_index', [MasterApController::class, 'revisi_data_ap_pk_index'])->name('revisi_data_ap_pk_index');
Route::get('/revisi_data_ap_gb', [MasterApController::class, 'revisi_data_ap_gb'])->name('revisi_data_ap_gb');
Route::get('/revisi_data_ap_gb_index', [MasterApController::class, 'revisi_data_ap_gb_index'])->name('revisi_data_ap_gb_index');
Route::get('/integrasi_epicor_gb', [MasterApController::class, 'integrasi_epicor_gb'])->name('integrasi_epicor_gb');
Route::get('/integrasi_epicor_gb_index', [MasterApController::class, 'integrasi_epicor_gb_index'])->name('integrasi_epicor_gb_index');
Route::get('/integrasi_epicor_pk', [MasterApController::class, 'integrasi_epicor_pk'])->name('integrasi_epicor_pk');
Route::get('/integrasi_epicor_pk_index', [MasterApController::class, 'integrasi_epicor_pk_index'])->name('integrasi_epicor_pk_index');
Route::get('/integrasi_epicor_pk1_index', [MasterApController::class, 'integrasi_epicor_pk1_index'])->name('integrasi_epicor_pk1_index');
Route::get('/kirim_epicor_pk/{id?}', [MasterApController::class, 'kirim_epicor_pk'])->name('kirim_epicor_pk');
Route::get('/kirim_epicor_gb/{id?}', [MasterApController::class, 'kirim_epicor_gb'])->name('kirim_epicor_gb');

// POTONG PAJAK
Route::get('/potong_pajak', [MasterApController::class, 'potong_pajak'])->name('potong_pajak');
Route::get('/potong_pajak_index', [MasterApController::class, 'potong_pajak_index'])->name('potong_pajak_index');
Route::get('/potong_pajak1_index', [MasterApController::class, 'potong_pajak1_index'])->name('potong_pajak1_index');
Route::post('/upload_potong_pajak', [MasterApController::class, 'upload_potong_pajak'])->name('upload_potong_pajak');
Route::post('/update_potong_pajak', [MasterApController::class, 'update_potong_pajak'])->name('update_potong_pajak');
Route::get('/delete_potong_pajak/{id?}', [MasterApController::class, 'delete_potong_pajak'])->name('delete_potong_pajak');

// LOG ACTIVITY AP
Route::get('/log_activity_ap', [MasterApController::class, 'log_activity_ap'])->name('log_activity_ap');
Route::get('/log_activity_ap_index', [MasterApController::class, 'log_activity_ap_index'])->name('log_activity_ap_index');

// Notif AP
Route::get('/get_notifdatapembelian', [MasterApController::class, 'get_notifdatapembelian'])->name('get_notifdatapembelian');
Route::get('/get_notifdatarevisiap', [MasterApController::class, 'get_notifdatarevisiap'])->name('get_notifdatarevisiap');