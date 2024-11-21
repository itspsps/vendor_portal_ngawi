<?php

use App\Http\Controllers\AdminMaster\MasterlabController;
use Illuminate\Support\Facades\Route;

// ADMIN QC
// Proses Lab 1
Route::get('proses_lab1_gabah_basah', [MasterlabController::class, 'proses_lab1_gabah_basah'])->name('proses_lab1_gabah_basah');
Route::get('proses_lab1_gabah_kering', [MasterlabController::class, 'proses_lab1_gabah_kering'])->name('proses_lab1_gabah_kering');
Route::get('proses_lab1_pecah_kulit', [MasterlabController::class, 'proses_lab1_pecah_kulit'])->name('proses_lab1_pecah_kulit');
Route::get('proses_lab1_beras_ds', [MasterlabController::class, 'proses_lab1_beras_ds'])->name('proses_lab1_beras_ds');
// Proses Lab 1
Route::get('proses_lab2_gabah_basah', [MasterlabController::class, 'proses_lab2_gabah_basah'])->name('proses_lab2_gabah_basah');
Route::get('proses_lab2_gabah_kering', [MasterlabController::class, 'proses_lab2_gabah_kering'])->name('proses_lab2_gabah_kering');
Route::get('proses_lab2_pecah_kulit', [MasterlabController::class, 'proses_lab2_pecah_kulit'])->name('proses_lab2_pecah_kulit');
Route::get('proses_lab2_beras_ds', [MasterlabController::class, 'proses_lab2_beras_ds'])->name('proses_lab2_beras_ds');
Route::get('revisi_security/{id?}', [MasterlabController::class, 'revisi_security'])->name('revisi_security');

//Proses Lab1 Index
Route::get('proses_lab1_gabah_basah_ciherang_index', [MasterlabController::class, 'proses_lab1_gabah_basah_ciherang_index'])->name('proses_lab1_gabah_basah_ciherang_index');
Route::get('proses_lab1_gabah_basah_longgrain_index', [MasterlabController::class, 'proses_lab1_gabah_basah_longgrain_index'])->name('proses_lab1_gabah_basah_longgrain_index');
Route::get('proses_lab1_gabah_basah_pandan_wangi_index', [MasterlabController::class, 'proses_lab1_gabah_basah_pandan_wangi_index'])->name('proses_lab1_gabah_basah_pandan_wangi_index');
Route::get('proses_lab1_gabah_basah_ketan_putih_index', [MasterlabController::class, 'proses_lab1_gabah_basah_ketan_putih_index'])->name('proses_lab1_gabah_basah_ketan_putih_index');
Route::get('proses_lab1_gabah_kering_index', [MasterlabController::class, 'proses_lab1_gabah_kering_index'])->name('proses_lab1_gabah_kering_index');
Route::get('proses_lab1_pecah_kulit_index', [MasterlabController::class, 'proses_lab1_pecah_kulit_index'])->name('proses_lab1_pecah_kulit_index');
Route::get('proses_lab1_beras_ds_index', [MasterlabController::class, 'proses_lab1_beras_ds_index'])->name('proses_lab1_beras_ds_index');

//Proses Lab2 Index
Route::get('proses_lab2_gabah_basah_longgrain_index', [MasterlabController::class, 'proses_lab2_gabah_basah_longgrain_index'])->name('proses_lab2_gabah_basah_longgrain_index');
Route::get('proses_lab2_gabah_basah_ciherang_index', [MasterlabController::class, 'proses_lab2_gabah_basah_ciherang_index'])->name('proses_lab2_gabah_basah_ciherang_index');
Route::get('proses_lab2_gabah_basah_pandan_wangi_index', [MasterlabController::class, 'proses_lab2_gabah_basah_pandan_wangi_index'])->name('proses_lab2_gabah_basah_pandan_wangi_index');
Route::get('proses_lab2_gabah_basah_ketan_putih_index', [MasterlabController::class, 'proses_lab2_gabah_basah_ketan_putih_index'])->name('proses_lab2_gabah_basah_ketan_putih_index');
Route::get('proses_lab2_gabah_kering_index', [MasterlabController::class, 'proses_lab2_gabah_kering_index'])->name('proses_lab2_gabah_kering_index');
Route::get('proses_lab2_pecah_kulit_index', [MasterlabController::class, 'proses_lab2_pecah_kulit_index'])->name('proses_lab2_pecah_kulit_index');
Route::get('proses_lab2_beras_ds_index', [MasterlabController::class, 'proses_lab2_beras_ds_index'])->name('proses_lab2_beras_ds_index');
// Hasil Data Lab 1
Route::get('output_proses_lab1_gb', [MasterlabController::class, 'output_proses_lab1_gb'])->name('output_proses_lab1_gb');
Route::get('output_proses_lab1_pk', [MasterlabController::class, 'output_proses_lab1_pk'])->name('output_proses_lab1_pk');

// Hasil Data Lab 2 
Route::get('output_proses_lab2_gb', [MasterlabController::class, 'output_proses_lab2_gb'])->name('output_proses_lab2_gb');
Route::get('output_proses_lab2_pk', [MasterlabController::class, 'output_proses_lab2_pk'])->name('output_proses_lab2_pk');

// Hasil Deal Lab 2 
Route::get('output_deal_lab2_gb', [MasterlabController::class, 'output_deal_lab2_gb'])->name('output_deal_lab2_gb');
Route::get('output_deal_lab2_gb_longgrain_index', [MasterlabController::class, 'output_deal_lab2_gb_longgrain_index'])->name('output_deal_lab2_gb_longgrain_index');
Route::get('output_deal_lab2_gb_pandan_wangi_index', [MasterlabController::class, 'output_deal_lab2_gb_pandan_wangi_index'])->name('output_deal_lab2_gb_pandan_wangi_index');
Route::get('output_deal_lab2_gb_ketan_putih_index', [MasterlabController::class, 'output_deal_lab2_gb_ketan_putih_index'])->name('output_deal_lab2_gb_ketan_putih_index');
Route::get('output_deal_lab2_pk', [MasterlabController::class, 'output_deal_lab2_pk'])->name('output_deal_lab2_pk');
Route::get('output_deal_lab2_pk_index', [MasterlabController::class, 'output_deal_lab2_pk_index'])->name('output_deal_lab2_pk_index');

// Hasil Nego Lab 2 
Route::get('output_nego_lab2_gb', [MasterlabController::class, 'output_nego_lab2_gb'])->name('output_nego_lab2_gb');
Route::get('output_nego_lab2_pk', [MasterlabController::class, 'output_nego_lab2_pk'])->name('output_nego_lab2_pk');

// Hasil Lab 1 Index
Route::get('output_lab1_gb_ciherang_index', [MasterlabController::class, 'output_lab1_gb_ciherang_index'])->name('output_lab1_gb_ciherang_index');
Route::get('output_lab1_gb_qc_longgrain_index', [MasterlabController::class, 'output_lab1_gb_qc_longgrain_index'])->name('output_lab1_gb_qc_longgrain_index');
Route::get('output_lab1_gb_qc_pandan_wangi_index', [MasterlabController::class, 'output_lab1_gb_qc_pandan_wangi_index'])->name('output_lab1_gb_qc_pandan_wangi_index');
Route::get('output_lab1_gb_qc_ketan_putih_index', [MasterlabController::class, 'output_lab1_gb_qc_ketan_putih_index'])->name('output_lab1_gb_qc_ketan_putih_index');
Route::get('output_lab1_qc_pk_index', [MasterlabController::class, 'output_lab1_qc_pk_index'])->name('output_lab1_qc_pk_index');

// Hasil Lab 2 Index
Route::get('output_lab2_gb_ciherang_qc_index', [MasterlabController::class, 'output_lab2_gb_ciherang_qc_index'])->name('output_lab2_gb_ciherang_qc_index');
Route::get('output_lab2_gb_longgrain_qc_index', [MasterlabController::class, 'output_lab2_gb_longgrain_qc_index'])->name('output_lab2_gb_longgrain_qc_index');
Route::get('output_lab2_gb_pandan_wangi_qc_index', [MasterlabController::class, 'output_lab2_gb_pandan_wangi_qc_index'])->name('output_lab2_gb_pandan_wangi_qc_index');
Route::get('output_lab2_gb_ketan_putih_qc_index', [MasterlabController::class, 'output_lab2_gb_ketan_putih_qc_index'])->name('output_lab2_gb_ketan_putih_qc_index');
Route::get('output_lab2_pk_qc_index', [MasterlabController::class, 'output_lab2_pk_qc_index'])->name('output_lab2_pk_qc_index');

// Edit & Update Lab 2
Route::post('update_lab2_gb', [MasterlabController::class, 'update_lab2_gb'])->name('update_lab2_gb');
Route::post('update_lab2_pk', [MasterlabController::class, 'update_lab2_pk'])->name('update_lab2_pk');
Route::get('edit_lab2_gb/{id?}', [MasterlabController::class, 'edit_lab2_gb'])->name('edit_lab2_gb');
Route::get('edit_lab2_pk/{id?}', [MasterlabController::class, 'edit_lab2_pk'])->name('edit_lab2_pk');
Route::get('approve_lab2_qc_gb/{id?}', [MasterlabController::class, 'approve_lab2_qc_gb'])->name('approve_lab2_qc_gb');
Route::get('approve_lab2_qc_pk/{id?}', [MasterlabController::class, 'approve_lab2_qc_pk'])->name('approve_lab2_qc_pk');


Route::get('antrian_qc', [MasterlabController::class, 'antrian_qc'])->name('antrian_qc');
Route::get('gabah_incoming_qc/{id?}', [MasterlabController::class, 'gabah_incoming_qc'])->name('gabah_incoming_qc');
Route::get('lokasi_bongkar/{id?}', [MasterlabController::class, 'lokasi_bongkar'])->name('lokasi_bongkar');
Route::get('approve_lab1/{id?}', [MasterlabController::class, 'approve_lab1'])->name('approve_lab1');
Route::get('edit_lab1/{id?}', [MasterlabController::class, 'edit_lab1'])->name('edit_lab1');
Route::post('update_gabah_incoming_qc/{id?}', [MasterlabController::class, 'update_gabah_incoming_qc'])->name('update_gabah_incoming_qc');
Route::post('output_gabah_incoming_pending', [MasterlabController::class, 'output_gabah_incoming_pending'])->name('output_gabah_incoming_pending');


// Route::get('output_gabah_lab2', [MasterlabController::class, 'output_gabah_lab2'])->name('output_gabah_lab2');
// Route::get('output_gabah_lab2_index', [MasterlabController::class, 'output_gabah_lab2_index'])->name('output_gabah_lab2_index');
Route::get('detail_output_incoming_qc/{id?}', [MasterlabController::class, 'detail_output_incoming_qc'])->name('detail_output_incoming_qc');
Route::get('show_lab2_gb/{id?}', [MasterlabController::class, 'show_lab2_gb'])->name('show_lab2_gb');
Route::get('show_lab2_pk/{id?}', [MasterlabController::class, 'show_lab2_pk'])->name('show_lab2_pk');
Route::get('finishing_qc', [MasterlabController::class, 'finishing_qc'])->name('finishing_qc');
Route::post('save_proseslab1_gabah_basah', [MasterlabController::class, 'save_proseslab1_gabah_basah'])->name('save_proseslab1_gabah_basah');
Route::post('save_proseslab1_gabah_kering', [MasterlabController::class, 'save_proseslab1_gabah_kering'])->name('save_proseslab1_gabah_kering');
Route::post('save_proseslab1_pecah_kulit', [MasterlabController::class, 'save_proseslab1_pecah_kulit'])->name('save_proseslab1_pecah_kulit');
Route::post('save_proseslab1_beras_ds', [MasterlabController::class, 'save_proseslab1_beras_ds'])->name('save_proseslab1_beras_ds');
Route::post('save_proses_lab2_gb', [MasterlabController::class, 'save_proses_lab2_gb'])->name('save_proses_lab2_gb');
Route::post('save_proses_lab2_pk', [MasterlabController::class, 'save_proses_lab2_pk'])->name('save_proses_lab2_pk');
Route::get('get_plan_hpp_gabah_basah/{id?}/{item?}', [MasterlabController::class, 'get_plan_hpp_gabah_basah'])->name('get_plan_hpp_gabah_basah');
Route::get('finishing_qc_lab_2', [MasterlabController::class, 'finishing_qc_lab_2'])->name('finishing_qc_lab_2');
Route::get('output_gabah_onprocess', [MasterlabController::class, 'output_gabah_onprocess'])->name('output_gabah_onprocess');
Route::get('output_gabah_onprocess_index', [MasterlabController::class, 'output_gabah_onprocess_index'])->name('output_gabah_onprocess_index');
Route::get('output_gabah_deal', [MasterlabController::class, 'output_gabah_deal'])->name('output_gabah_deal');

Route::get('output_gabah_nego', [MasterlabController::class, 'output_gabah_nego'])->name('output_gabah_nego');
Route::get('output_gabah_longgrain_nego_index', [MasterlabController::class, 'output_gabah_longgrain_nego_index'])->name('output_gabah_longgrain_nego_index');
Route::get('output_gabah_pandan_wangi_nego_index', [MasterlabController::class, 'output_gabah_pandan_wangi_nego_index'])->name('output_gabah_pandan_wangi_nego_index');
Route::get('output_gabah_ketan_putih_nego_index', [MasterlabController::class, 'output_gabah_ketan_putih_nego_index'])->name('output_gabah_ketan_putih_nego_index');
Route::get('output_gabah_unloading_result_nego', [MasterlabController::class, 'output_gabah_unloading_result_nego'])->name('output_gabah_unloading_result_nego');
Route::get('output_gabah_unloading_result_nego_index', [MasterlabController::class, 'output_gabah_unloading_result_nego_index'])->name('output_gabah_unloading_result_nego_index');
Route::get('show_output_nego/{id?}', [MasterlabController::class, 'show_output_nego'])->name('show_output_nego');

Route::get('global_incoming', [MasterlabController::class, 'global_incoming'])->name('global_incoming');

// Unload View & Index
Route::get('unload_lab1_gabah_basah', [MasterlabController::class, 'unload_lab1_gabah_basah'])->name('unload_lab1_gabah_basah');
Route::get('unload_lab1_gabah_basah_index', [MasterlabController::class, 'unload_lab1_gabah_basah_index'])->name('unload_lab1_gabah_basah_index');
Route::get('unload_lab1_gabah_kering', [MasterlabController::class, 'unload_lab1_gabah_kering'])->name('unload_lab1_gabah_kering');
Route::get('unload_lab1_gabah_kering_index', [MasterlabController::class, 'unload_lab1_gabah_kering_index'])->name('unload_lab1_gabah_kering_index');
Route::get('unload_lab1_pecah_kulit', [MasterlabController::class, 'unload_lab1_pecah_kulit'])->name('unload_lab1_pecah_kulit');
Route::get('unload_lab1_pecah_kulit_index', [MasterlabController::class, 'unload_lab1_pecah_kulit_index'])->name('unload_lab1_pecah_kulit_index');
Route::get('unload_lab1_beras_ds', [MasterlabController::class, 'unload_lab1_beras_ds'])->name('unload_lab1_beras_ds');
Route::get('unload_lab1_beras_ds_index', [MasterlabController::class, 'unload_lab1_beras_ds_index'])->name('unload_lab1_beras_ds_index');

// Pending View & Index
Route::get('pending_lab1_gabah_basah', [MasterlabController::class, 'pending_lab1_gabah_basah'])->name('pending_lab1_gabah_basah');
Route::get('pending_lab1_gabah_basah_longgrain_index', [MasterlabController::class, 'pending_lab1_gabah_basah_longgrain_index'])->name('pending_lab1_gabah_basah_longgrain_index');
Route::get('pending_lab1_gabah_basah_pandan_wangi_index', [MasterlabController::class, 'pending_lab1_gabah_basah_pandan_wangi_index'])->name('pending_lab1_gabah_basah_pandan_wangi_index');
Route::get('pending_lab1_gabah_basah_ketan_putih_index', [MasterlabController::class, 'pending_lab1_gabah_basah_ketan_putih_index'])->name('pending_lab1_gabah_basah_ketan_putih_index');
Route::get('pending_lab1_gabah_bkering', [MasterlabController::class, 'pending_lab1_gabah_bkering'])->name('pending_lab1_gabah_bkering');
Route::get('pending_lab1_gabah_bkering_index', [MasterlabController::class, 'pending_lab1_gabah_bkering_index'])->name('pending_lab1_gabah_bkering_index');
Route::get('pending_lab1_pecah_kulit', [MasterlabController::class, 'pending_lab1_pecah_kulit'])->name('pending_lab1_pecah_kulit');
Route::get('pending_lab1_pecah_kulit_index', [MasterlabController::class, 'pending_lab1_pecah_kulit_index'])->name('pending_lab1_pecah_kulit_index');
Route::get('pending_lab1_beras_ds', [MasterlabController::class, 'pending_lab1_beras_ds'])->name('pending_lab1_beras_ds');
Route::get('pending_lab1_beras_ds_index', [MasterlabController::class, 'pending_lab1_beras_ds_index'])->name('pending_lab1_beras_ds_index');

// Reject View & Index
Route::get('reject_lab1_gabah_basah', [MasterlabController::class, 'reject_lab1_gabah_basah'])->name('reject_lab1_gabah_basah');
Route::get('reject_lab1_gabah_basah_ciherang_index', [MasterlabController::class, 'reject_lab1_gabah_basah_ciherang_index'])->name('reject_lab1_gabah_basah_ciherang_index');
Route::get('reject_lab1_gabah_basah_pandan_wangi_index', [MasterlabController::class, 'reject_lab1_gabah_basah_pandan_wangi_index'])->name('reject_lab1_gabah_basah_pandan_wangi_index');
Route::get('reject_lab1_gabah_basah_ketan_putih_index', [MasterlabController::class, 'reject_lab1_gabah_basah_ketan_putih_index'])->name('reject_lab1_gabah_basah_ketan_putih_index');
Route::get('reject_lab1_gabah_kering', [MasterlabController::class, 'reject_lab1_gabah_kering'])->name('reject_lab1_gabah_kering');
Route::get('reject_lab1_gabah_kering_index', [MasterlabController::class, 'reject_lab1_gabah_kering_index'])->name('reject_lab1_gabah_kering_index');
Route::get('reject_lab1_pecah_kulit', [MasterlabController::class, 'reject_lab1_pecah_kulit'])->name('reject_lab1_pecah_kulit');
Route::get('reject_lab1_pecah_kulit_index', [MasterlabController::class, 'reject_lab1_pecah_kulit_index'])->name('reject_lab1_pecah_kulit_index');
Route::get('reject_lab1_beras_ds', [MasterlabController::class, 'reject_lab1_beras_ds'])->name('reject_lab1_beras_ds');
Route::get('reject_lab1_beras_ds_index', [MasterlabController::class, 'reject_lab1_beras_ds_index'])->name('reject_lab1_beras_ds_index');

// Update proses lab 1
Route::post('update_proses1_gabah_basah', [MasterlabController::class, 'update_proses1_gabah_basah'])->name('update_proses1_gabah_basah');
Route::post('update_proses1_gabah_kering', [MasterlabController::class, 'update_proses1_gabah_basah'])->name('update_proses1_gabah_basah');
Route::post('update_proseslab1_pecah_kulit', [MasterlabController::class, 'update_proseslab1_pecah_kulit'])->name('update_proseslab1_pecah_kulit');
Route::post('update_proses1_beras_ds', [MasterlabController::class, 'update_proses1_beras_ds'])->name('update_proses1_beras_ds');

// Edit proses lab 1
Route::get('edit_lab1_gb/{id?}', [MasterlabController::class, 'edit_lab1_gb'])->name('edit_lab1_gb');
Route::get('edit_lab1_gk/{id?}', [MasterlabController::class, 'edit_lab1_gk'])->name('edit_lab1_gk');
Route::get('edit_lab1_pk/{id?}', [MasterlabController::class, 'edit_lab1_pk'])->name('edit_lab1_pk');
Route::get('edit_lab1_ds/{id?}', [MasterlabController::class, 'edit_lab1_ds'])->name('edit_lab1_ds');

// Unload Approve proses lab 1
Route::get('approve_lab1_qc_gb/{id?}', [MasterlabController::class, 'approve_lab1_qc_gb'])->name('approve_lab1_qc_gb');
Route::get('approve_lab1_gk/{id?}', [MasterlabController::class, 'approve_lab1_gl'])->name('approve_lab1_gk');
Route::get('approve_lab1_pk/{id?}', [MasterlabController::class, 'approve_lab1_pk'])->name('approve_lab1_pk');
Route::get('approve_tolak_lab1_pk/{id?}', [MasterlabController::class, 'approve_tolak_lab1_pk'])->name('approve_tolak_lab1_pk');
Route::get('approve_lab1_ds/{id?}', [MasterlabController::class, 'approve_lab1_ds'])->name('approve_lab1_ds');

Route::get('unload_incoming_index', [MasterlabController::class, 'unload_incoming_index'])->name('unload_incoming_index');
Route::get('pending_incoming', [MasterlabController::class, 'pending_incoming'])->name('pending_incoming');
Route::get('pending_incoming_index', [MasterlabController::class, 'pending_incoming_index'])->name('pending_incoming_index');
Route::get('reject_incoming', [MasterlabController::class, 'reject_incoming'])->name('reject_incoming');
Route::get('reject_incoming_index', [MasterlabController::class, 'reject_incoming_index'])->name('reject_incoming_index');

Route::post('output_nego_qc', [MasterlabController::class, 'output_nego_qc'])->name('output_nego_qc');

Route::post('download_output_lab1_excel', [MasterlabController::class, 'download_output_lab1_excel'])->name('download_output_lab1_excel');
Route::post('download_data_unload_excel', [MasterlabController::class, 'download_data_unload_excel'])->name('download_data_unload_excel');
Route::post('download_data_pending_excel', [MasterlabController::class, 'download_data_pending_excel'])->name('download_data_pending_excel');
Route::post('download_data_reject_excel', [MasterlabController::class, 'download_data_reject_excel'])->name('download_data_reject_excel');
Route::post('download_output_lab2_excel', [MasterlabController::class, 'download_output_lab2_excel'])->name('download_output_lab2_excel');
Route::post('download_output_lab2_pk_excel', [MasterlabController::class, 'download_output_lab2_pk_excel'])->name('download_output_lab2_pk_excel');
Route::post('download_onproses_lab2_excel', [MasterlabController::class, 'download_onproses_lab2_excel'])->name('download_onproses_lab2_excel');
Route::post('download_deal_lab2_excel', [MasterlabController::class, 'download_deal_lab2_excel'])->name('download_deal_lab2_excel');
Route::post('download_nego_lab2_excel', [MasterlabController::class, 'download_nego_lab2_excel'])->name('download_nego_lab2_excel');

// LOG ACTIVITY SPV QC
Route::get('/log_activity_qc', [MasterlabController::class, 'log_activity_qc'])->name('log_activity_qc');
Route::get('/log_activity_qc_index', [MasterlabController::class, 'log_activity_qc_index'])->name('log_activity_qc_index');
