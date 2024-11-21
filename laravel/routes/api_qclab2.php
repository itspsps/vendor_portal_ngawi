<?php

use App\Http\Controllers\AdminQc\QcLab2Controller;
use Illuminate\Support\Facades\Route;
// Proses Lab 2
Route::get('/lab/proses_lab2_gabah_basah', [QcLab2Controller::class, 'proses_lab2_gabah_basah'])->name('lab.proses_lab2_gabah_basah');
Route::get('/lab/proses_lab2_gabah_kering', [QcLab2Controller::class, 'proses_lab2_gabah_kering'])->name('lab.proses_lab2_gabah_kering');
Route::get('/lab/proses_lab2_pecah_kulit', [QcLab2Controller::class, 'proses_lab2_pecah_kulit'])->name('lab.proses_lab2_pecah_kulit');
Route::get('/lab/proses_lab2_beras_ds', [QcLab2Controller::class, 'proses_lab2_beras_ds'])->name('lab.proses_lab2_beras_ds');

//Proses Lab2 Index
Route::get('/lab/proses_lab2_gabah_basah_longgrain_index', [QcLab2Controller::class, 'proses_lab2_gabah_basah_longgrain_index'])->name('lab.proses_lab2_gabah_basah_longgrain_index');
Route::get('/lab/proses_lab2_gabah_basah_ciherang_index', [QcLab2Controller::class, 'proses_lab2_gabah_basah_ciherang_index'])->name('lab.proses_lab2_gabah_basah_ciherang_index');
Route::get('/lab/proses_lab2_gabah_basah_pandan_wangi_index', [QcLab2Controller::class, 'proses_lab2_gabah_basah_pandan_wangi_index'])->name('lab.proses_lab2_gabah_basah_pandan_wangi_index');
Route::get('/lab/proses_lab2_gabah_basah_ketan_putih_index', [QcLab2Controller::class, 'proses_lab2_gabah_basah_ketan_putih_index'])->name('lab.proses_lab2_gabah_basah_ketan_putih_index');
Route::get('/lab/proses_lab2_gabah_kering_index', [QcLab2Controller::class, 'proses_lab2_gabah_kering_index'])->name('lab.proses_lab2_gabah_kering_index');
Route::get('/lab/proses_lab2_pecah_kulit_index', [QcLab2Controller::class, 'proses_lab2_pecah_kulit_index'])->name('lab.proses_lab2_pecah_kulit_index');
Route::get('/lab/proses_lab2_beras_ds_index', [QcLab2Controller::class, 'proses_lab2_beras_ds_index'])->name('lab.proses_lab2_beras_ds_index');

// Hasil Data Lab 2 
Route::get('/lab/output_proses_lab2_gb', [QcLab2Controller::class, 'output_proses_lab2_gb'])->name('lab.output_proses_lab2_gb');
Route::get('/lab/output_proses_lab2_pk', [QcLab2Controller::class, 'output_proses_lab2_pk'])->name('lab.output_proses_lab2_pk');

// Hasil Deal Lab 2 
Route::get('/lab/output_deal_lab2_gb', [QcLab2Controller::class, 'output_deal_lab2_gb'])->name('lab.output_deal_lab2_gb');
Route::get('/lab/output_deal_lab2_gb_longgrain_index', [QcLab2Controller::class, 'output_deal_lab2_gb_longgrain_index'])->name('lab.output_deal_lab2_gb_longgrain_index');
Route::get('/lab/output_deal_lab2_gb_pandan_wangi_index', [QcLab2Controller::class, 'output_deal_lab2_gb_pandan_wangi_index'])->name('lab.output_deal_lab2_gb_pandan_wangi_index');
Route::get('/lab/output_deal_lab2_gb_ketan_putih_index', [QcLab2Controller::class, 'output_deal_lab2_gb_ketan_putih_index'])->name('lab.output_deal_lab2_gb_ketan_putih_index');
Route::get('/lab/output_deal_lab2_pk', [QcLab2Controller::class, 'output_deal_lab2_pk'])->name('lab.output_deal_lab2_pk');
Route::get('/lab/output_deal_lab2_pk_index', [QcLab2Controller::class, 'output_deal_lab2_pk_index'])->name('lab.output_deal_lab2_pk_index');

// Hasil Nego Lab 2 
Route::get('/lab/output_nego_lab2_gb', [QcLab2Controller::class, 'output_nego_lab2_gb'])->name('lab.output_nego_lab2_gb');
Route::get('/lab/output_nego_lab2_pk', [QcLab2Controller::class, 'output_nego_lab2_pk'])->name('lab.output_nego_lab2_pk');

// Hasil Lab 2 Index
Route::get('/lab/output_lab2_gb_ciherang_index', [QcLab2Controller::class, 'output_lab2_gb_ciherang_index'])->name('lab.output_lab2_gb_ciherang_index');
Route::get('/lab/output_lab2_gb_longgrain_index', [QcLab2Controller::class, 'output_lab2_gb_longgrain_index'])->name('lab.output_lab2_gb_longgrain_index');
Route::get('/lab/output_lab2_gb_pandan_wangi_index', [QcLab2Controller::class, 'output_lab2_gb_pandan_wangi_index'])->name('lab.output_lab2_gb_pandan_wangi_index');
Route::get('/lab/output_lab2_gb_ketan_putih_index', [QcLab2Controller::class, 'output_lab2_gb_ketan_putih_index'])->name('lab.output_lab2_gb_ketan_putih_index');
Route::get('/lab/output_lab2_pk_index', [QcLab2Controller::class, 'output_lab2_pk_index'])->name('lab.output_lab2_pk_index');

// Edit & Update Lab 2
Route::post('/lab/update_lab2_gb', [QcLab2Controller::class, 'update_lab2_gb'])->name('lab.update_lab2_gb');
Route::post('/lab/update_lab2_pk', [QcLab2Controller::class, 'update_lab2_pk'])->name('lab.update_lab2_pk');
Route::get('/lab/edit_lab2_gb/{id?}', [QcLab2Controller::class, 'edit_lab2_gb'])->name('lab.edit_lab2_gb');
Route::get('/lab/edit_lab2_pk/{id?}', [QcLab2Controller::class, 'edit_lab2_pk'])->name('lab.edit_lab2_pk');
Route::get('/lab/approve_lab2_gb/{id?}', [QcLab2Controller::class, 'approve_lab2_gb'])->name('lab.approve_lab2_gb');
Route::get('/lab/approve_lab2_pk/{id?}', [QcLab2Controller::class, 'approve_lab2_pk'])->name('lab.approve_lab2_pk');

Route::get('/lab/show_lab2_gb/{id?}', [QcLab2Controller::class, 'show_lab2_gb'])->name('lab.show_lab2_gb');
Route::get('/lab/show_lab2_pk/{id?}', [QcLab2Controller::class, 'show_lab2_pk'])->name('lab.show_lab2_pk');
Route::get('/lab/finishing_qc', [QcLab2Controller::class, 'finishing_qc'])->name('lab.finishing_qc');

Route::post('/lab/save_proses_lab2_gb', [QcLab2Controller::class, 'save_proses_lab2_gb'])->name('lab.save_proses_lab2_gb');
Route::post('/lab/save_proses_lab2_pk', [QcLab2Controller::class, 'save_proses_lab2_pk'])->name('lab.save_proses_lab2_pk');
Route::get('/lab/get_plan_hpp_gabah_basah/{id?}', [QcLab2Controller::class, 'get_plan_hpp_gabah_basah'])->name('lab.get_plan_hpp_gabah_basah');
Route::get('/lab/finishing_qc_lab_2', [QcLab2Controller::class, 'finishing_qc_lab_2'])->name('lab.finishing_qc_lab_2');
