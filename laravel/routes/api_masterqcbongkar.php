<?php

use App\Http\Controllers\AdminMaster\MasterQcBongkarController;
use Illuminate\Support\Facades\Route;

Route::get('data_bongkar', [MasterQcBongkarController::class, 'data_bongkar'])->name('data_bongkar');
// get notif
Route::get('getcountnotif_antrianbongkar', [MasterQcBongkarController::class, 'getcountnotif_antrianbongkar'])->name('getcountnotif_antrianbongkar');
Route::get('getcountnotif_prosesbongkar', [MasterQcBongkarController::class, 'getcountnotif_prosesbongkar'])->name('getcountnotif_prosesbongkar');
Route::get('getcountnotif_databongkar', [MasterQcBongkarController::class, 'getcountnotif_databongkar'])->name('getcountnotif_databongkar');
Route::get('getcountnotif_revisibongkar', [MasterQcBongkarController::class, 'getcountnotif_revisibongkar'])->name('getcountnotif_revisibongkar');
// Data Antrian Bongkar
Route::get('data_antrian_bongkar_pandan_wangi_index', [MasterQcBongkarController::class, 'data_antrian_bongkar_pandan_wangi_index'])->name('data_antrian_bongkar_pandan_wangi_index');
Route::get('data_antrian_bongkar_ketan_putih_index', [MasterQcBongkarController::class, 'data_antrian_bongkar_ketan_putih_index'])->name('data_antrian_bongkar_ketan_putih_index');
Route::get('data_antrian_bongkar_longgrain_index', [MasterQcBongkarController::class, 'data_antrian_bongkar_longgrain_index'])->name('data_antrian_bongkar_longgrain_index');
Route::get('antrian_bongkar', [MasterQcBongkarController::class, 'antrian_bongkar'])->name('antrian_bongkar');
Route::get('data_antrian_bongkar', [MasterQcBongkarController::class, 'data_antrian_bongkar'])->name('data_antrian_bongkar');
Route::get('data_antrian_bongkar_index', [MasterQcBongkarController::class, 'data_antrian_bongkar_index'])->name('data_antrian_bongkar_index');
Route::get('data_antrian_bongkar_utara_index', [MasterQcBongkarController::class, 'data_antrian_bongkar_utara_index'])->name('data_antrian_bongkar_utara_index');
Route::get('data_antrian_bongkar_pending_index', [MasterQcBongkarController::class, 'data_antrian_bongkar_pending_index'])->name('data_antrian_bongkar_pending_index');
Route::get('data_antrian_bongkar_pk_index', [MasterQcBongkarController::class, 'data_antrian_bongkar_pk_index'])->name('data_antrian_bongkar_pk_index');
Route::get('data_antrian_bongkar_selatan_index', [MasterQcBongkarController::class, 'data_antrian_bongkar_selatan_index'])->name('data_antrian_bongkar_selatan_index');
// Data Revisi
Route::get('data_revisi_gb', [MasterQcBongkarController::class, 'data_revisi_gb'])->name('data_revisi_gb');
Route::get('data_revisi_gb_longgrain_index', [MasterQcBongkarController::class, 'data_revisi_gb_longgrain_index'])->name('data_revisi_gb_longgrain_index');
Route::get('data_revisi_gb_pandan_wangi_index', [MasterQcBongkarController::class, 'data_revisi_gb_pandan_wangi_index'])->name('data_revisi_gb_pandan_wangi_index');
Route::get('data_revisi_gb_ketan_putih_index', [MasterQcBongkarController::class, 'data_revisi_gb_ketan_putih_index'])->name('data_revisi_gb_ketan_putih_index');
Route::post('update_dtm', [MasterQcBongkarController::class, 'update_dtm'])->name('update_dtm');
Route::get('show_revisi_gb/{id?}', [MasterQcBongkarController::class, 'show_revisi_gb'])->name('show_revisi_gb');


// Data Antrian Bongkar Panggil
Route::get('data_antrian_bongkar_panggil_gb/{id?}', [MasterQcBongkarController::class, 'data_antrian_bongkar_panggil_gb'])->name('data_antrian_bongkar_panggil_gb');
Route::get('data_antrian_bongkar_panggil_pk/{id?}', [MasterQcBongkarController::class, 'data_antrian_bongkar_panggil_pk'])->name('data_antrian_bongkar_panggil_pk');

Route::get('antrian_qc_longgrain_index', [MasterQcBongkarController::class, 'antrian_qc_longgrain_index'])->name('antrian_qc_longgrain_index');
Route::get('antrian_qc_bongkar_pk_index', [MasterQcBongkarController::class, 'antrian_qc_bongkar_pk_index'])->name('antrian_qc_bongkar_pk_index');
Route::get('antrian_qc_pandan_wangi_index', [MasterQcBongkarController::class, 'antrian_qc_pandan_wangi_index'])->name('antrian_qc_pandan_wangi_index');
Route::get('antrian_qc_ketan_putih_index', [MasterQcBongkarController::class, 'antrian_qc_ketan_putih_index'])->name('antrian_qc_ketan_putih_index');
Route::get('data_bongkar_gb_utara_index', [MasterQcBongkarController::class, 'data_bongkar_gb_utara_index'])->name('data_bongkar_gb_utara_index');
Route::get('data_bongkar_gb_selatan_index', [MasterQcBongkarController::class, 'data_bongkar_gb_selatan_index'])->name('data_bongkar_gb_selatan_index');
Route::get('data_bongkar_pk_index', [MasterQcBongkarController::class, 'data_bongkar_pk_index'])->name('data_bongkar_pk_index');
Route::get('antrian_qc_bongkarGT_index', [MasterQcBongkarController::class, 'antrian_qc_bongkarGT_index'])->name('antrian_qc_bongkarGT_index');
Route::get('antrian_qc_bongkar_pk_index', [MasterQcBongkarController::class, 'antrian_qc_bongkar_pk_index'])->name('antrian_qc_bongkar_pk_index');
Route::get('antrian_qc_bongkar04_index', [MasterQcBongkarController::class, 'antrian_qc_bongkar04_index'])->name('antrian_qc_bongkar04_index');
Route::get('show_qc_bongkar_gb_show/{id?}', [MasterQcBongkarController::class, 'show_qc_bongkar_gb_show'])->name('show_qc_bongkar_gb_show');
Route::get('show_qc_bongkar_pk_show/{id?}', [MasterQcBongkarController::class, 'show_qc_bongkar_pk_show'])->name('show_qc_bongkar_pk_show');
Route::post('update_qc_bongkar', [MasterQcBongkarController::class, 'update_qc_bongkar'])->name('update_qc_bongkar');
Route::get('getnotifikasibongkar', [MasterQcBongkarController::class, 'get_notifikasibongkar'])->name('get_notifikasibongkar');
Route::get('getcountnotifikasibongkar', [MasterQcBongkarController::class, 'get_countnotifikasibongkar'])->name('get_countnotifikasibongkar');
Route::get('setnotifikasibongkar/', [MasterQcBongkarController::class, 'set_notifikasibongkar'])->name('set_notifikasibongkar');
Route::get('newnotifikasibongkar/', [MasterQcBongkarController::class, 'new_notifikasibongkar'])->name('new_notifikasibongkar');

// LOG ACTIVITY QC BONGKAR
Route::get('/log_activity_qc_bongkar', [MasterQcBongkarController::class, 'log_activity_qc_bongkar'])->name('log_activity_qc_bongkar');
Route::get('/log_activity_qc_bongkar_index', [MasterQcBongkarController::class, 'log_activity_qc_bongkar_index'])->name('log_activity_qc_bongkar_index');
