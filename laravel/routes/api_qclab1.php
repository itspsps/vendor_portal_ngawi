<?php

use App\Http\Controllers\AdminQc\QcLab1Controller;
use Illuminate\Support\Facades\Route;

// Proses Lab 1
Route::get('/lab/proses_lab1_gabah_basah', [QcLab1Controller::class, 'proses_lab1_gabah_basah'])->name('lab.proses_lab1_gabah_basah');
Route::get('/lab/proses_lab1_gabah_kering', [QcLab1Controller::class, 'proses_lab1_gabah_kering'])->name('lab.proses_lab1_gabah_kering');
Route::get('/lab/proses_lab1_pecah_kulit', [QcLab1Controller::class, 'proses_lab1_pecah_kulit'])->name('lab.proses_lab1_pecah_kulit');
Route::get('/lab/proses_lab1_beras_ds', [QcLab1Controller::class, 'proses_lab1_beras_ds'])->name('lab.proses_lab1_beras_ds');

// ADD LAB 1
Route::get('/lab/proses_add_lab1_gabah_basah/{id}', [QcLab1Controller::class, 'proses_add_lab1_gabah_basah'])->name('lab.proses_add_lab1_gabah_basah');
Route::get('/lab/check_input_lab1', [QcLab1Controller::class, 'check_input_lab1'])->name('lab.check_input_lab1');
//Proses Lab1 Index
Route::get('/lab/proses_lab1_gabah_basah_ciherang_index', [QcLab1Controller::class, 'proses_lab1_gabah_basah_ciherang_index'])->name('lab.proses_lab1_gabah_basah_ciherang_index');
Route::get('/lab/proses_lab1_gabah_basah_longgrain_index', [QcLab1Controller::class, 'proses_lab1_gabah_basah_longgrain_index'])->name('lab.proses_lab1_gabah_basah_longgrain_index');
Route::get('/lab/proses_lab1_gabah_basah_pandan_wangi_index', [QcLab1Controller::class, 'proses_lab1_gabah_basah_pandan_wangi_index'])->name('lab.proses_lab1_gabah_basah_pandan_wangi_index');
Route::get('/lab/proses_lab1_gabah_basah_ketan_putih_index', [QcLab1Controller::class, 'proses_lab1_gabah_basah_ketan_putih_index'])->name('lab.proses_lab1_gabah_basah_ketan_putih_index');
Route::get('/lab/proses_lab1_gabah_kering_index', [QcLab1Controller::class, 'proses_lab1_gabah_kering_index'])->name('lab.proses_lab1_gabah_kering_index');
Route::get('/lab/proses_lab1_pecah_kulit_index', [QcLab1Controller::class, 'proses_lab1_pecah_kulit_index'])->name('lab.proses_lab1_pecah_kulit_index');
Route::get('/lab/proses_lab1_beras_ds_index', [QcLab1Controller::class, 'proses_lab1_beras_ds_index'])->name('lab.proses_lab1_beras_ds_index');

// Hasil Data Lab 1
Route::get('/lab/output_proses_lab1_gb', [QcLab1Controller::class, 'output_proses_lab1_gb'])->name('lab.output_proses_lab1_gb');
Route::get('/lab/output_proses_lab1_pk', [QcLab1Controller::class, 'output_proses_lab1_pk'])->name('lab.output_proses_lab1_pk');

Route::get('/lab/output_edit_proses_lab1_gb/{id?}', [QcLab1Controller::class, 'output_edit_proses_lab1_gb'])->name('lab.output_edit_proses_lab1_gb');
// Hasil Lab 1 Index
Route::get('/lab/output_lab1_gb_ciherang_index', [QcLab1Controller::class, 'output_lab1_gb_ciherang_index'])->name('lab.output_lab1_gb_ciherang_index');
Route::get('/lab/output_lab1_gb_longgrain_index', [QcLab1Controller::class, 'output_lab1_gb_longgrain_index'])->name('lab.output_lab1_gb_longgrain_index');
Route::get('/lab/output_lab1_gb_pandan_wangi_index', [QcLab1Controller::class, 'output_lab1_gb_pandan_wangi_index'])->name('lab.output_lab1_gb_pandan_wangi_index');
Route::get('/lab/output_lab1_gb_ketan_putih_index', [QcLab1Controller::class, 'output_lab1_gb_ketan_putih_index'])->name('lab.output_lab1_gb_ketan_putih_index');
Route::get('/lab/output_lab1_pk_index', [QcLab1Controller::class, 'output_lab1_pk_index'])->name('lab.output_lab1_pk_index');
Route::get('/lab/antrian_qc', [QcLab1Controller::class, 'antrian_qc'])->name('lab.antrian_qc');
Route::get('/lab/gabah_incoming_qc/{id?}', [QcLab1Controller::class, 'gabah_incoming_qc'])->name('lab.gabah_incoming_qc');
Route::get('/lab/approve_lab1/{id?}', [QcLab1Controller::class, 'approve_lab1'])->name('lab.approve_lab1');
Route::get('/lab/edit_lab1/{id?}', [QcLab1Controller::class, 'edit_lab1'])->name('lab.edit_lab1');
Route::post('/lab/update_gabah_incoming_qc/{id?}', [QcLab1Controller::class, 'update_gabah_incoming_qc'])->name('lab.update_gabah_incoming_qc');
Route::post('/lab/output_gabah_incoming_pending', [QcLab1Controller::class, 'output_gabah_incoming_pending'])->name('lab.output_gabah_incoming_pending');
Route::get('/lab/detail_output_incoming_qc/{id?}', [QcLab1Controller::class, 'detail_output_incoming_qc'])->name('lab.detail_output_incoming_qc');

Route::post('/lab/save_proseslab1_gabah_basah', [QcLab1Controller::class, 'save_proseslab1_gabah_basah'])->name('lab.save_proseslab1_gabah_basah');
Route::post('/lab/save_proseslab1_gabah_kering', [QcLab1Controller::class, 'save_proseslab1_gabah_kering'])->name('lab.save_proseslab1_gabah_kering');
Route::post('/lab/save_proseslab1_pecah_kulit', [QcLab1Controller::class, 'save_proseslab1_pecah_kulit'])->name('lab.save_proseslab1_pecah_kulit');
Route::post('/lab/save_proseslab1_beras_ds', [QcLab1Controller::class, 'save_proseslab1_beras_ds'])->name('lab.save_proseslab1_beras_ds');

// Unload View & Index
Route::get('/lab/unload_lab1_gabah_basah', [QcLab1Controller::class, 'unload_lab1_gabah_basah'])->name('lab.unload_lab1_gabah_basah');
Route::get('/lab/unload_lab1_gabah_basah_index', [QcLab1Controller::class, 'unload_lab1_gabah_basah_index'])->name('lab.unload_lab1_gabah_basah_index');
Route::get('/lab/unload_lab1_gabah_kering', [QcLab1Controller::class, 'unload_lab1_gabah_kering'])->name('lab.unload_lab1_gabah_kering');
Route::get('/lab/unload_lab1_gabah_kering_index', [QcLab1Controller::class, 'unload_lab1_gabah_kering_index'])->name('lab.unload_lab1_gabah_kering_index');
Route::get('/lab/unload_lab1_pecah_kulit', [QcLab1Controller::class, 'unload_lab1_pecah_kulit'])->name('lab.unload_lab1_pecah_kulit');
Route::get('/lab/unload_lab1_pecah_kulit_index', [QcLab1Controller::class, 'unload_lab1_pecah_kulit_index'])->name('lab.unload_lab1_pecah_kulit_index');
Route::get('/lab/unload_lab1_beras_ds', [QcLab1Controller::class, 'unload_lab1_beras_ds'])->name('lab.unload_lab1_beras_ds');
Route::get('/lab/unload_lab1_beras_ds_index', [QcLab1Controller::class, 'unload_lab1_beras_ds_index'])->name('lab.unload_lab1_beras_ds_index');

// Pending View & Index
Route::get('/lab/pending_lab1_gabah_basah', [QcLab1Controller::class, 'pending_lab1_gabah_basah'])->name('lab.pending_lab1_gabah_basah');
Route::get('/lab/pending_lab1_gabah_basah_longgrain_index', [QcLab1Controller::class, 'pending_lab1_gabah_basah_longgrain_index'])->name('lab.pending_lab1_gabah_basah_longgrain_index');
Route::get('/lab/pending_lab1_gabah_basah_pandan_wangi_index', [QcLab1Controller::class, 'pending_lab1_gabah_basah_pandan_wangi_index'])->name('lab.pending_lab1_gabah_basah_pandan_wangi_index');
Route::get('/lab/pending_lab1_gabah_basah_ketan_putih_index', [QcLab1Controller::class, 'pending_lab1_gabah_basah_ketan_putih_index'])->name('lab.pending_lab1_gabah_basah_ketan_putih_index');
Route::get('/lab/pending_lab1_gabah_bkering', [QcLab1Controller::class, 'pending_lab1_gabah_bkering'])->name('lab.pending_lab1_gabah_bkering');
Route::get('/lab/pending_lab1_gabah_bkering_index', [QcLab1Controller::class, 'pending_lab1_gabah_bkering_index'])->name('lab.pending_lab1_gabah_bkering_index');
Route::get('/lab/pending_lab1_pecah_kulit', [QcLab1Controller::class, 'pending_lab1_pecah_kulit'])->name('lab.pending_lab1_pecah_kulit');
Route::get('/lab/pending_lab1_pecah_kulit_index', [QcLab1Controller::class, 'pending_lab1_pecah_kulit_index'])->name('lab.pending_lab1_pecah_kulit_index');
Route::get('/lab/pending_lab1_beras_ds', [QcLab1Controller::class, 'pending_lab1_beras_ds'])->name('lab.pending_lab1_beras_ds');
Route::get('/lab/pending_lab1_beras_ds_index', [QcLab1Controller::class, 'pending_lab1_beras_ds_index'])->name('lab.pending_lab1_beras_ds_index');

// Reject View & Index
Route::get('/lab/reject_lab1_gabah_basah', [QcLab1Controller::class, 'reject_lab1_gabah_basah'])->name('lab.reject_lab1_gabah_basah');
Route::get('/lab/reject_lab1_gabah_basah_longgrain_index', [QcLab1Controller::class, 'reject_lab1_gabah_basah_longgrain_index'])->name('lab.reject_lab1_gabah_basah_longgrain_index');
Route::get('/lab/reject_lab1_gabah_basah_pandan_wangi_index', [QcLab1Controller::class, 'reject_lab1_gabah_basah_pandan_wangi_index'])->name('lab.reject_lab1_gabah_basah_pandan_wangi_index');
Route::get('/lab/reject_lab1_gabah_basah_ketan_putih_index', [QcLab1Controller::class, 'reject_lab1_gabah_basah_ketan_putih_index'])->name('lab.reject_lab1_gabah_basah_ketan_putih_index');
Route::get('/lab/reject_lab1_gabah_kering', [QcLab1Controller::class, 'reject_lab1_gabah_kering'])->name('lab.reject_lab1_gabah_kering');
Route::get('/lab/reject_lab1_gabah_kering_index', [QcLab1Controller::class, 'reject_lab1_gabah_kering_index'])->name('lab.reject_lab1_gabah_kering_index');
Route::get('/lab/reject_lab1_pecah_kulit', [QcLab1Controller::class, 'reject_lab1_pecah_kulit'])->name('lab.reject_lab1_pecah_kulit');
Route::get('/lab/reject_lab1_pecah_kulit_index', [QcLab1Controller::class, 'reject_lab1_pecah_kulit_index'])->name('lab.reject_lab1_pecah_kulit_index');
Route::get('/lab/reject_lab1_beras_ds', [QcLab1Controller::class, 'reject_lab1_beras_ds'])->name('lab.reject_lab1_beras_ds');
Route::get('/lab/reject_lab1_beras_ds_index', [QcLab1Controller::class, 'reject_lab1_beras_ds_index'])->name('lab.reject_lab1_beras_ds_index');

// Update proses lab 1
Route::post('/lab/update_proses1_gabah_basah', [QcLab1Controller::class, 'update_proses1_gabah_basah'])->name('lab.update_proses1_gabah_basah');
Route::post('/lab/update_proses1_gabah_kering', [QcLab1Controller::class, 'update_proses1_gabah_basah'])->name('lab.update_proses1_gabah_basah');
Route::post('/lab/update_proseslab1_pecah_kulit', [QcLab1Controller::class, 'update_proseslab1_pecah_kulit'])->name('lab.update_proseslab1_pecah_kulit');
Route::post('/lab/update_proses1_beras_ds', [QcLab1Controller::class, 'update_proses1_beras_ds'])->name('lab.update_proses1_beras_ds');

// Edit proses lab 1
Route::get('/lab/edit_lab1_gb/{id?}', [QcLab1Controller::class, 'edit_lab1_gb'])->name('lab.edit_lab1_gb');
Route::get('/lab/edit_lab1_gk/{id?}', [QcLab1Controller::class, 'edit_lab1_gk'])->name('lab.edit_lab1_gk');
Route::get('/lab/edit_lab1_pk/{id?}', [QcLab1Controller::class, 'edit_lab1_pk'])->name('lab.edit_lab1_pk');
Route::get('/lab/edit_lab1_ds/{id?}', [QcLab1Controller::class, 'edit_lab1_ds'])->name('lab.edit_lab1_ds');

// Unload Approve proses lab 1
Route::get('/lab/approve_lab1_gb/{id?}', [QcLab1Controller::class, 'approve_lab1_gb'])->name('lab.approve_lab1_gb');
Route::get('/lab/approve_lab1_gk/{id?}', [QcLab1Controller::class, 'approve_lab1_gk'])->name('lab.approve_lab1_gk');
Route::get('/lab/approve_lab1_pk/{id?}', [QcLab1Controller::class, 'approve_lab1_pk'])->name('lab.approve_lab1_pk');
Route::get('/lab/approve_tolak_lab1_pk/{id?}', [QcLab1Controller::class, 'approve_tolak_lab1_pk'])->name('lab.approve_tolak_lab1_pk');
Route::get('/lab/approve_lab1_ds/{id?}', [QcLab1Controller::class, 'approve_lab1_ds'])->name('lab.approve_lab1_ds');

Route::get('/lab/unload_incoming_index', [QcLab1Controller::class, 'unload_incoming_index'])->name('lab.unload_incoming_index');
Route::get('/lab/pending_incoming', [QcLab1Controller::class, 'pending_incoming'])->name('lab.pending_incoming');
Route::get('/lab/pending_incoming_index', [QcLab1Controller::class, 'pending_incoming_index'])->name('lab.pending_incoming_index');
Route::get('/lab/reject_incoming', [QcLab1Controller::class, 'reject_incoming'])->name('lab.reject_incoming');
Route::get('/lab/reject_incoming_index', [QcLab1Controller::class, 'reject_incoming_index'])->name('lab.reject_incoming_index');
