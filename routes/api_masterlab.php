<?php

use App\Http\Controllers\AdminMaster\MasterlabController;
use Illuminate\Support\Facades\Route;

// ADMIN QC
// Proses Lab 1
Route::get('/lab/proses_lab1_gabah_basah', [MasterlabController::class, 'proses_lab1_gabah_basah'])->name('lab.proses_lab1_gabah_basah');
Route::get('/lab/proses_lab1_gabah_kering', [MasterlabController::class, 'proses_lab1_gabah_kering'])->name('lab.proses_lab1_gabah_kering');
Route::get('/lab/proses_lab1_pecah_kulit', [MasterlabController::class, 'proses_lab1_pecah_kulit'])->name('lab.proses_lab1_pecah_kulit');
Route::get('/lab/proses_lab1_beras_ds', [MasterlabController::class, 'proses_lab1_beras_ds'])->name('lab.proses_lab1_beras_ds');
// Proses Lab 1
Route::get('/lab/proses_lab2_gabah_basah', [MasterlabController::class, 'proses_lab2_gabah_basah'])->name('lab.proses_lab2_gabah_basah');
Route::get('/lab/proses_lab2_gabah_kering', [MasterlabController::class, 'proses_lab2_gabah_kering'])->name('lab.proses_lab2_gabah_kering');
Route::get('/lab/proses_lab2_pecah_kulit', [MasterlabController::class, 'proses_lab2_pecah_kulit'])->name('lab.proses_lab2_pecah_kulit');
Route::get('/lab/proses_lab2_beras_ds', [MasterlabController::class, 'proses_lab2_beras_ds'])->name('lab.proses_lab2_beras_ds');
Route::get('/lab/revisi_security/{id?}', [MasterlabController::class, 'revisi_security'])->name('lab.revisi_security');

//Proses Lab1 Index
Route::get('/lab/proses_lab1_gabah_basah_ciherang_index', [MasterlabController::class, 'proses_lab1_gabah_basah_ciherang_index'])->name('lab.proses_lab1_gabah_basah_ciherang_index');
Route::get('/lab/proses_lab1_gabah_basah_longgrain_index', [MasterlabController::class, 'proses_lab1_gabah_basah_longgrain_index'])->name('lab.proses_lab1_gabah_basah_longgrain_index');
Route::get('/lab/proses_lab1_gabah_basah_pandan_wangi_index', [MasterlabController::class, 'proses_lab1_gabah_basah_pandan_wangi_index'])->name('lab.proses_lab1_gabah_basah_pandan_wangi_index');
Route::get('/lab/proses_lab1_gabah_basah_ketan_putih_index', [MasterlabController::class, 'proses_lab1_gabah_basah_ketan_putih_index'])->name('lab.proses_lab1_gabah_basah_ketan_putih_index');
Route::get('/lab/proses_lab1_gabah_kering_index', [MasterlabController::class, 'proses_lab1_gabah_kering_index'])->name('lab.proses_lab1_gabah_kering_index');
Route::get('/lab/proses_lab1_pecah_kulit_index', [MasterlabController::class, 'proses_lab1_pecah_kulit_index'])->name('lab.proses_lab1_pecah_kulit_index');
Route::get('/lab/proses_lab1_beras_ds_index', [MasterlabController::class, 'proses_lab1_beras_ds_index'])->name('lab.proses_lab1_beras_ds_index');

//Proses Lab2 Index
Route::get('/lab/proses_lab2_gabah_basah_longgrain_index', [MasterlabController::class, 'proses_lab2_gabah_basah_longgrain_index'])->name('lab.proses_lab2_gabah_basah_longgrain_index');
Route::get('/lab/proses_lab2_gabah_basah_ciherang_index', [MasterlabController::class, 'proses_lab2_gabah_basah_ciherang_index'])->name('lab.proses_lab2_gabah_basah_ciherang_index');
Route::get('/lab/proses_lab2_gabah_basah_pandan_wangi_index', [MasterlabController::class, 'proses_lab2_gabah_basah_pandan_wangi_index'])->name('lab.proses_lab2_gabah_basah_pandan_wangi_index');
Route::get('/lab/proses_lab2_gabah_basah_ketan_putih_index', [MasterlabController::class, 'proses_lab2_gabah_basah_ketan_putih_index'])->name('lab.proses_lab2_gabah_basah_ketan_putih_index');
Route::get('/lab/proses_lab2_gabah_kering_index', [MasterlabController::class, 'proses_lab2_gabah_kering_index'])->name('lab.proses_lab2_gabah_kering_index');
Route::get('/lab/proses_lab2_pecah_kulit_index', [MasterlabController::class, 'proses_lab2_pecah_kulit_index'])->name('lab.proses_lab2_pecah_kulit_index');
Route::get('/lab/proses_lab2_beras_ds_index', [MasterlabController::class, 'proses_lab2_beras_ds_index'])->name('lab.proses_lab2_beras_ds_index');
// Hasil Data Lab 1
Route::get('/lab/output_proses_lab1_gb', [MasterlabController::class, 'output_proses_lab1_gb'])->name('lab.output_proses_lab1_gb');
Route::get('/lab/output_proses_lab1_pk', [MasterlabController::class, 'output_proses_lab1_pk'])->name('lab.output_proses_lab1_pk');

// Hasil Data Lab 2 
Route::get('/lab/output_proses_lab2_gb', [MasterlabController::class, 'output_proses_lab2_gb'])->name('lab.output_proses_lab2_gb');
Route::get('/lab/output_proses_lab2_pk', [MasterlabController::class, 'output_proses_lab2_pk'])->name('lab.output_proses_lab2_pk');

// Hasil Deal Lab 2 
Route::get('/lab/output_deal_lab2_gb', [MasterlabController::class, 'output_deal_lab2_gb'])->name('lab.output_deal_lab2_gb');
Route::get('/lab/output_deal_lab2_gb_longgrain_index', [MasterlabController::class, 'output_deal_lab2_gb_longgrain_index'])->name('lab.output_deal_lab2_gb_longgrain_index');
Route::get('/lab/output_deal_lab2_gb_pandan_wangi_index', [MasterlabController::class, 'output_deal_lab2_gb_pandan_wangi_index'])->name('lab.output_deal_lab2_gb_pandan_wangi_index');
Route::get('/lab/output_deal_lab2_gb_ketan_putih_index', [MasterlabController::class, 'output_deal_lab2_gb_ketan_putih_index'])->name('lab.output_deal_lab2_gb_ketan_putih_index');
Route::get('/lab/output_deal_lab2_pk', [MasterlabController::class, 'output_deal_lab2_pk'])->name('lab.output_deal_lab2_pk');
Route::get('/lab/output_deal_lab2_pk_index', [MasterlabController::class, 'output_deal_lab2_pk_index'])->name('lab.output_deal_lab2_pk_index');

// Hasil Nego Lab 2 
Route::get('/lab/output_nego_lab2_gb', [MasterlabController::class, 'output_nego_lab2_gb'])->name('lab.output_nego_lab2_gb');
Route::get('/lab/output_nego_lab2_pk', [MasterlabController::class, 'output_nego_lab2_pk'])->name('lab.output_nego_lab2_pk');

// Hasil Lab 1 Index
Route::get('/lab//output_lab1_gb_ciherang_index', [MasterlabController::class, 'output_lab1_gb_ciherang_index'])->name('lab.output_lab1_gb_ciherang_index');
Route::get('/lab//output_lab1_gb_longgrain_index', [MasterlabController::class, 'output_lab1_gb_longgrain_index'])->name('lab.output_lab1_gb_longgrain_index');
Route::get('/lab/output_lab1_gb_pandan_wangi_index', [MasterlabController::class, 'output_lab1_gb_pandan_wangi_index'])->name('lab.output_lab1_gb_pandan_wangi_index');
Route::get('/lab/output_lab1_gb_ketan_putih_index', [MasterlabController::class, 'output_lab1_gb_ketan_putih_index'])->name('lab.output_lab1_gb_ketan_putih_index');
Route::get('/lab/output_lab1_qc_pk_index', [MasterlabController::class, 'output_lab1_qc_pk_index'])->name('lab.output_lab1_qc_pk_index');
Route::get('/lab/output_lab1_gb_longgrain_approved_index', [MasterlabController::class, 'output_lab1_gb_longgrain_approved_index'])->name('lab.output_lab1_gb_longgrain_approved_index');
Route::get('/lab/output_lab1_gb_longgrain_approvedtolak_index', [MasterlabController::class, 'output_lab1_gb_longgrain_approvedtolak_index'])->name('lab.output_lab1_gb_longgrain_approvedtolak_index');
Route::get('/lab/count_outputlab1_gb', [MasterlabController::class, 'count_outputlab1_gb'])->name('lab.count_outputlab1_gb');

// Hasil Lab 2 Index
Route::get('/lab/output_lab2_gb_ciherang_index', [MasterlabController::class, 'output_lab2_gb_ciherang_index'])->name('lab.output_lab2_gb_ciherang_index');
Route::get('/lab/output_lab2_gb_longgrain_index', [MasterlabController::class, 'output_lab2_gb_longgrain_index'])->name('lab.output_lab2_gb_longgrain_index');
Route::get('/lab/output_lab2_gb_pandan_wangi_index', [MasterlabController::class, 'output_lab2_gb_pandan_wangi_index'])->name('lab.output_lab2_gb_pandan_wangi_index');
Route::get('/lab/output_lab2_gb_ketan_putih_index', [MasterlabController::class, 'output_lab2_gb_ketan_putih_index'])->name('lab.output_lab2_gb_ketan_putih_index');
Route::get('/lab/output_lab2_pk_qc_index', [MasterlabController::class, 'output_lab2_pk_qc_index'])->name('lab.output_lab2_pk_qc_index');

// Edit & Update Lab 2
Route::post('update_lab2_gb', [MasterlabController::class, 'update_lab2_gb'])->name('lab.update_lab2_gb');
Route::post('update_lab2_pk', [MasterlabController::class, 'update_lab2_pk'])->name('lab.update_lab2_pk');
Route::get('/lab/edit_lab2_gb/{id?}', [MasterlabController::class, 'edit_lab2_gb'])->name('lab.edit_lab2_gb');
Route::get('/lab/edit_lab2_pk/{id?}', [MasterlabController::class, 'edit_lab2_pk'])->name('lab.edit_lab2_pk');
Route::get('/lab/approve_lab2_qc_gb/{id?}', [MasterlabController::class, 'approve_lab2_qc_gb'])->name('lab.approve_lab2_qc_gb');
Route::get('/lab/approve_lab2_qc_pk/{id?}', [MasterlabController::class, 'approve_lab2_qc_pk'])->name('lab.approve_lab2_qc_pk');


Route::get('/lab/antrian_qc', [MasterlabController::class, 'antrian_qc'])->name('lab.antrian_qc');
Route::get('/lab/gabah_incoming_qc/{id?}', [MasterlabController::class, 'gabah_incoming_qc'])->name('lab.gabah_incoming_qc');
Route::get('/lab/lokasi_bongkar/{id?}', [MasterlabController::class, 'lokasi_bongkar'])->name('lab.lokasi_bongkar');
Route::get('/lab/approve_lab1/{id?}', [MasterlabController::class, 'approve_lab1'])->name('lab.approve_lab1');
Route::get('/lab/edit_lab1/{id?}', [MasterlabController::class, 'edit_lab1'])->name('lab.edit_lab1');
Route::post('update_gabah_incoming_qc/{id?}', [MasterlabController::class, 'update_gabah_incoming_qc'])->name('lab.update_gabah_incoming_qc');
Route::post('output_gabah_incoming_pending', [MasterlabController::class, 'output_gabah_incoming_pending'])->name('lab.output_gabah_incoming_pending');


// Route::get('/lab/output_gabah_lab2', [MasterlabController::class, 'output_gabah_lab2'])->name('lab.output_gabah_lab2');
// Route::get('/lab/output_gabah_lab2_index', [MasterlabController::class, 'output_gabah_lab2_index'])->name('lab.output_gabah_lab2_index');
Route::get('/lab/detail_output_incoming_qc/{id?}', [MasterlabController::class, 'detail_output_incoming_qc'])->name('lab.detail_output_incoming_qc');
Route::get('/lab/show_lab2_gb/{id?}', [MasterlabController::class, 'show_lab2_gb'])->name('lab.show_lab2_gb');
Route::get('/lab/show_lab2_pk/{id?}', [MasterlabController::class, 'show_lab2_pk'])->name('lab.show_lab2_pk');
Route::get('/lab/finishing_qc', [MasterlabController::class, 'finishing_qc'])->name('lab.finishing_qc');
Route::post('save_proseslab1_gabah_basah', [MasterlabController::class, 'save_proseslab1_gabah_basah'])->name('lab.save_proseslab1_gabah_basah');
Route::post('save_proseslab1_gabah_kering', [MasterlabController::class, 'save_proseslab1_gabah_kering'])->name('lab.save_proseslab1_gabah_kering');
Route::post('save_proseslab1_pecah_kulit', [MasterlabController::class, 'save_proseslab1_pecah_kulit'])->name('lab.save_proseslab1_pecah_kulit');
Route::post('save_proseslab1_beras_ds', [MasterlabController::class, 'save_proseslab1_beras_ds'])->name('lab.save_proseslab1_beras_ds');
Route::post('save_proses_lab2_gb', [MasterlabController::class, 'save_proses_lab2_gb'])->name('lab.save_proses_lab2_gb');
Route::post('save_proses_lab2_pk', [MasterlabController::class, 'save_proses_lab2_pk'])->name('lab.save_proses_lab2_pk');
Route::get('/lab/get_plan_hpp_gabah_basah/{id?}/{item?}', [MasterlabController::class, 'get_plan_hpp_gabah_basah'])->name('lab.get_plan_hpp_gabah_basah');
Route::get('/lab/finishing_qc_lab_2', [MasterlabController::class, 'finishing_qc_lab_2'])->name('lab.finishing_qc_lab_2');
Route::get('/lab/output_gabah_onprocess', [MasterlabController::class, 'output_gabah_onprocess'])->name('lab.output_gabah_onprocess');
Route::get('/lab/output_gabah_onprocess_index', [MasterlabController::class, 'output_gabah_onprocess_index'])->name('lab.output_gabah_onprocess_index');
Route::get('/lab/output_gabah_deal', [MasterlabController::class, 'output_gabah_deal'])->name('lab.output_gabah_deal');

Route::get('/lab/output_gabah_nego', [MasterlabController::class, 'output_gabah_nego'])->name('lab.output_gabah_nego');
Route::get('/lab/output_gabah_longgrain_nego_index', [MasterlabController::class, 'output_gabah_longgrain_nego_index'])->name('lab.output_gabah_longgrain_nego_index');
Route::get('/lab/output_gabah_pandan_wangi_nego_index', [MasterlabController::class, 'output_gabah_pandan_wangi_nego_index'])->name('lab.output_gabah_pandan_wangi_nego_index');
Route::get('/lab/output_gabah_ketan_putih_nego_index', [MasterlabController::class, 'output_gabah_ketan_putih_nego_index'])->name('lab.output_gabah_ketan_putih_nego_index');
Route::get('/lab/output_gabah_unloading_result_nego', [MasterlabController::class, 'output_gabah_unloading_result_nego'])->name('lab.output_gabah_unloading_result_nego');
Route::get('/lab/output_gabah_unloading_result_nego_index', [MasterlabController::class, 'output_gabah_unloading_result_nego_index'])->name('lab.output_gabah_unloading_result_nego_index');
Route::get('/lab/show_output_nego/{id?}', [MasterlabController::class, 'show_output_nego'])->name('lab.show_output_nego');

Route::get('/lab/global_incoming', [MasterlabController::class, 'global_incoming'])->name('lab.global_incoming');

// Unload View & Index
Route::get('/lab/count_unload_gb', [MasterlabController::class, 'count_unload_gb'])->name('lab.count_unload_gb');
Route::get('/lab/unload_lab1_gabah_basah', [MasterlabController::class, 'unload_lab1_gabah_basah'])->name('lab.unload_lab1_gabah_basah');
Route::get('/lab/unload_lab1_gabah_basah_index', [MasterlabController::class, 'unload_lab1_gabah_basah_index'])->name('lab.unload_lab1_gabah_basah_index');
Route::get('/lab/unload_lab1_gabah_kering', [MasterlabController::class, 'unload_lab1_gabah_kering'])->name('lab.unload_lab1_gabah_kering');
Route::get('/lab/unload_lab1_gabah_kering_index', [MasterlabController::class, 'unload_lab1_gabah_kering_index'])->name('lab.unload_lab1_gabah_kering_index');
Route::get('/lab/unload_lab1_pecah_kulit', [MasterlabController::class, 'unload_lab1_pecah_kulit'])->name('lab.unload_lab1_pecah_kulit');
Route::get('/lab/unload_lab1_pecah_kulit_index', [MasterlabController::class, 'unload_lab1_pecah_kulit_index'])->name('lab.unload_lab1_pecah_kulit_index');
Route::get('/lab/unload_lab1_beras_ds', [MasterlabController::class, 'unload_lab1_beras_ds'])->name('lab.unload_lab1_beras_ds');
Route::get('/lab/unload_lab1_beras_ds_index', [MasterlabController::class, 'unload_lab1_beras_ds_index'])->name('lab.unload_lab1_beras_ds_index');

// Pending View & Index
Route::get('/lab/pending_lab1_gabah_basah', [MasterlabController::class, 'pending_lab1_gabah_basah'])->name('lab.pending_lab1_gabah_basah');
Route::get('/lab/pending_lab1_gabah_basah_longgrain_index', [MasterlabController::class, 'pending_lab1_gabah_basah_longgrain_index'])->name('lab.pending_lab1_gabah_basah_longgrain_index');
Route::get('/lab/pending_lab1_gabah_basah_pandan_wangi_index', [MasterlabController::class, 'pending_lab1_gabah_basah_pandan_wangi_index'])->name('lab.pending_lab1_gabah_basah_pandan_wangi_index');
Route::get('/lab/pending_lab1_gabah_basah_ketan_putih_index', [MasterlabController::class, 'pending_lab1_gabah_basah_ketan_putih_index'])->name('lab.pending_lab1_gabah_basah_ketan_putih_index');
Route::get('/lab/pending_lab1_gabah_bkering', [MasterlabController::class, 'pending_lab1_gabah_bkering'])->name('lab.pending_lab1_gabah_bkering');
Route::get('/lab/pending_lab1_gabah_bkering_index', [MasterlabController::class, 'pending_lab1_gabah_bkering_index'])->name('lab.pending_lab1_gabah_bkering_index');
Route::get('/lab/pending_lab1_pecah_kulit', [MasterlabController::class, 'pending_lab1_pecah_kulit'])->name('lab.pending_lab1_pecah_kulit');
Route::get('/lab/pending_lab1_pecah_kulit_index', [MasterlabController::class, 'pending_lab1_pecah_kulit_index'])->name('lab.pending_lab1_pecah_kulit_index');
Route::get('/lab/pending_lab1_beras_ds', [MasterlabController::class, 'pending_lab1_beras_ds'])->name('lab.pending_lab1_beras_ds');
Route::get('/lab/pending_lab1_beras_ds_index', [MasterlabController::class, 'pending_lab1_beras_ds_index'])->name('lab.pending_lab1_beras_ds_index');

// Reject View & Index
Route::get('/lab/reject_lab1_gabah_basah', [MasterlabController::class, 'reject_lab1_gabah_basah'])->name('lab.reject_lab1_gabah_basah');
Route::get('/lab/reject_lab1_gabah_basah_ciherang_index', [MasterlabController::class, 'reject_lab1_gabah_basah_ciherang_index'])->name('lab.reject_lab1_gabah_basah_ciherang_index');
Route::get('/lab/reject_lab1_gabah_basah_pandan_wangi_index', [MasterlabController::class, 'reject_lab1_gabah_basah_pandan_wangi_index'])->name('lab.reject_lab1_gabah_basah_pandan_wangi_index');
Route::get('/lab/reject_lab1_gabah_basah_ketan_putih_index', [MasterlabController::class, 'reject_lab1_gabah_basah_ketan_putih_index'])->name('lab.reject_lab1_gabah_basah_ketan_putih_index');
Route::get('/lab/reject_lab1_gabah_kering', [MasterlabController::class, 'reject_lab1_gabah_kering'])->name('lab.reject_lab1_gabah_kering');
Route::get('/lab/reject_lab1_gabah_kering_index', [MasterlabController::class, 'reject_lab1_gabah_kering_index'])->name('lab.reject_lab1_gabah_kering_index');
Route::get('/lab/reject_lab1_pecah_kulit', [MasterlabController::class, 'reject_lab1_pecah_kulit'])->name('lab.reject_lab1_pecah_kulit');
Route::get('/lab/reject_lab1_pecah_kulit_index', [MasterlabController::class, 'reject_lab1_pecah_kulit_index'])->name('lab.reject_lab1_pecah_kulit_index');
Route::get('/lab/reject_lab1_beras_ds', [MasterlabController::class, 'reject_lab1_beras_ds'])->name('lab.reject_lab1_beras_ds');
Route::get('/lab/reject_lab1_beras_ds_index', [MasterlabController::class, 'reject_lab1_beras_ds_index'])->name('lab.reject_lab1_beras_ds_index');

// Update proses lab 1
Route::post('/lab/update_proses1_gabah_basah', [MasterlabController::class, 'update_proses1_gabah_basah'])->name('lab.update_proses1_gabah_basah');
Route::post('/lab/update_proses1_gabah_kering', [MasterlabController::class, 'update_proses1_gabah_basah'])->name('lab.update_proses1_gabah_basah');
Route::post('/lab/update_proseslab1_pecah_kulit', [MasterlabController::class, 'update_proseslab1_pecah_kulit'])->name('lab.update_proseslab1_pecah_kulit');
Route::post('/lab/update_proses1_beras_ds', [MasterlabController::class, 'update_proses1_beras_ds'])->name('lab.update_proses1_beras_ds');

// Edit proses lab 1
Route::get('/lab/edit_lab1_gb/{id?}', [MasterlabController::class, 'edit_lab1_gb'])->name('lab.edit_lab1_gb');
Route::get('/lab/edit_lab1_gk/{id?}', [MasterlabController::class, 'edit_lab1_gk'])->name('lab.edit_lab1_gk');
Route::get('/lab/edit_lab1_pk/{id?}', [MasterlabController::class, 'edit_lab1_pk'])->name('lab.edit_lab1_pk');
Route::get('/lab/edit_lab1_ds/{id?}', [MasterlabController::class, 'edit_lab1_ds'])->name('lab.edit_lab1_ds');

// Unload Approve proses lab 1
Route::get('/lab/approve_lab1_qc_gb/{id?}', [MasterlabController::class, 'approve_lab1_qc_gb'])->name('lab.approve_lab1_qc_gb');
Route::get('/lab/approve_lab1_gk/{id?}', [MasterlabController::class, 'approve_lab1_gl'])->name('lab.approve_lab1_gk');
Route::get('/lab/approve_lab1_pk/{id?}', [MasterlabController::class, 'approve_lab1_pk'])->name('lab.approve_lab1_pk');
Route::get('/lab/approve_tolak_lab1_pk/{id?}', [MasterlabController::class, 'approve_tolak_lab1_pk'])->name('lab.approve_tolak_lab1_pk');
Route::get('/lab/approve_lab1_ds/{id?}', [MasterlabController::class, 'approve_lab1_ds'])->name('lab.approve_lab1_ds');

Route::get('/lab/unload_incoming_index', [MasterlabController::class, 'unload_incoming_index'])->name('lab.unload_incoming_index');
Route::get('/lab/pending_incoming', [MasterlabController::class, 'pending_incoming'])->name('lab.pending_incoming');
Route::get('/lab/pending_incoming_index', [MasterlabController::class, 'pending_incoming_index'])->name('lab.pending_incoming_index');
Route::get('/lab/reject_incoming', [MasterlabController::class, 'reject_incoming'])->name('lab.reject_incoming');
Route::get('/lab/reject_incoming_index', [MasterlabController::class, 'reject_incoming_index'])->name('lab.reject_incoming_index');

Route::post('/lab/output_nego_qc', [MasterlabController::class, 'output_nego_qc'])->name('lab.output_nego_qc');

Route::post('/lab/download_output_lab1_excel', [MasterlabController::class, 'download_output_lab1_excel'])->name('lab.download_output_lab1_excel');
Route::post('/lab/download_data_unload_excel', [MasterlabController::class, 'download_data_unload_excel'])->name('lab.download_data_unload_excel');
Route::post('/lab/download_data_pending_excel', [MasterlabController::class, 'download_data_pending_excel'])->name('lab.download_data_pending_excel');
Route::post('/lab/download_data_reject_excel', [MasterlabController::class, 'download_data_reject_excel'])->name('lab.download_data_reject_excel');
Route::post('/lab/download_output_lab2_excel', [MasterlabController::class, 'download_output_lab2_excel'])->name('lab.download_output_lab2_excel');
Route::post('/lab/download_output_lab2_pk_excel', [MasterlabController::class, 'download_output_lab2_pk_excel'])->name('lab.download_output_lab2_pk_excel');
Route::post('/lab/download_onproses_lab2_excel', [MasterlabController::class, 'download_onproses_lab2_excel'])->name('lab.download_onproses_lab2_excel');
Route::post('/lab/download_deal_lab2_excel', [MasterlabController::class, 'download_deal_lab2_excel'])->name('lab.download_deal_lab2_excel');
Route::post('/lab/download_nego_lab2_excel', [MasterlabController::class, 'download_nego_lab2_excel'])->name('lab.download_nego_lab2_excel');

// LOG ACTIVITY SPV QC
Route::get('/lab/log_activity_qc', [MasterlabController::class, 'log_activity_qc'])->name('lab.log_activity_qc');
Route::get('/lab/log_activity_qc_index', [MasterlabController::class, 'log_activity_qc_index'])->name('lab.log_activity_qc_index');
