<?php

use App\Http\Controllers\AdminMaster\MasterSpvqcController;
use Illuminate\Support\Facades\Route;

Route::get('plan_hpp_gabah_basah', [MasterSpvqcController::class, 'plan_hpp_gabah_basah'])->name('plan_hpp_gabah_basah');
Route::get('plan_hpp_gabah_basah_ciherang_index', [MasterSpvqcController::class, 'plan_hpp_gabah_basah_ciherang_index'])->name('plan_hpp_gabah_basah_ciherang_index');
Route::get('plan_hpp_gabah_basah_longgrain_index', [MasterSpvqcController::class, 'plan_hpp_gabah_basah_longgrain_index'])->name('plan_hpp_gabah_basah_longgrain_index');
Route::get('plan_hpp_gabah_basah_pandanwangi_index', [MasterSpvqcController::class, 'plan_hpp_gabah_basah_pandanwangi_index'])->name('plan_hpp_gabah_basah_pandanwangi_index');
Route::get('plan_hpp_gabah_basah_ketanputih_index', [MasterSpvqcController::class, 'plan_hpp_gabah_basah_ketanputih_index'])->name('plan_hpp_gabah_basah_ketanputih_index');
Route::get('partial_gabah_basah/{id}', [MasterSpvqcController::class, 'partial_plan_hpp_gabah_basah'])->name('partial_plan_hpp_gabah_basah');
Route::get('edit_gabah_basah', [MasterSpvqcController::class, 'edit_plan_hpp_gabah_basah'])->name('edit_plan_hpp_gabah_basah');
Route::get('delete_plan_hpp_gabah_basah/{id?}', [MasterSpvqcController::class, 'delete_plan_hpp_gabah_basah'])->name('delete_plan_hpp_gabah_basah');
Route::post('simpan_plan_hpp_gabah_basah', [MasterSpvqcController::class, 'simpan_plan_hpp_gabah_basah'])->name('simpan_plan_hpp_gabah_basah');

// HPP Gabah Kering
Route::get('plan_hpp_gabah_kering', [MasterSpvqcController::class, 'plan_hpp_gabah_kering'])->name('plan_hpp_gabah_kering');
Route::get('plan_hpp_gabah_kering_index', [MasterSpvqcController::class, 'plan_hpp_gabah_kering_index'])->name('plan_hpp_gabah_kering_index');
Route::get('partial_gabah_kering/{id}', [MasterSpvqcController::class, 'partial_plan_hpp_gabah_kering'])->name('partial_plan_hpp_gabah_kering');
Route::get('edit_gabah_kering', [MasterSpvqcController::class, 'edit_plan_hpp_gabah_kering'])->name('edit_plan_hpp_gabah_kering');
Route::get('delete_plan_hpp_gabah_kering/{id?}', [MasterSpvqcController::class, 'delete_plan_hpp_gabah_kering'])->name('delete_plan_hpp_gabah_kering');
Route::post('simpan_plan_hpp_gabah_kering', [MasterSpvqcController::class, 'simpan_plan_hpp_gabah_kering'])->name('simpan_plan_hpp_gabah_kering');

// HPP Gabah PK
Route::get('plan_hpp_pecah_kulit', [MasterSpvqcController::class, 'plan_hpp_pecah_kulit'])->name('plan_hpp_pecah_kulit');
Route::get('plan_hpp_pecah_kulit_index', [MasterSpvqcController::class, 'plan_hpp_pecah_kulit_index'])->name('plan_hpp_pecah_kulit_index');
Route::get('partial_pecah_kulit/{id}', [MasterSpvqcController::class, 'partial_plan_hpp_pecah_kulit'])->name('partial_plan_hpp_pecah_kulit');
Route::get('edit_pecah_kulit', [MasterSpvqcController::class, 'edit_plan_hpp_pecah_kulit'])->name('edit_plan_hpp_pecah_kulit');
Route::get('delete_plan_hpp_pecah_kulit/{id?}', [MasterSpvqcController::class, 'delete_plan_hpp_pecah_kulit'])->name('delete_plan_hpp_pecah_kulit');
Route::post('simpan_plan_hpp_pecah_kulit', [MasterSpvqcController::class, 'simpan_plan_hpp_pecah_kulit'])->name('simpan_plan_hpp_pecah_kulit');

// HPP Beras DS
Route::get('plan_hpp_beras_ds', [MasterSpvqcController::class, 'plan_hpp_beras_ds'])->name('plan_hpp_beras_ds');
Route::get('plan_hpp_beras_ds_index', [MasterSpvqcController::class, 'plan_hpp_beras_ds_index'])->name('plan_hpp_beras_ds_index');
Route::get('partial_beras_ds/{id}', [MasterSpvqcController::class, 'partial_plan_hpp_beras_ds'])->name('partial_plan_hpp_beras_ds');
Route::get('edit_beras_ds', [MasterSpvqcController::class, 'edit_plan_hpp_beras_ds'])->name('edit_plan_hpp');
Route::get('delete_plan_hpp_beras_ds/{id?}', [MasterSpvqcController::class, 'delete_plan_hpp_beras_ds'])->name('delete_plan_hpp_beras_ds');
Route::post('simpan_plan_hpp_beras_ds', [MasterSpvqcController::class, 'simpan_plan_hpp_beras_ds'])->name('simpan_plan_hpp_beras_ds');

// Harga Atas Gabah Basah
Route::get('harga_atas_gabah_basah', [MasterSpvqcController::class, 'harga_atas_gabah_basah'])->name('harga_atas_gabah_basah');
Route::get('harga_atas_gabah_basah_index', [MasterSpvqcController::class, 'harga_atas_gabah_basah_index'])->name('harga_atas_gabah_basah_index');
Route::get('show_harga_atas_gabah_basah/{id?}', [MasterSpvqcController::class, 'show_harga_atas_gabah_basah'])->name('show_harga_atas_gabah_basah');
Route::post('update_harga_atas_gabah_basah/{id?}', [MasterSpvqcController::class, 'update_harga_atas_gabah_basah'])->name('update_harga_atas_gabah_basah');
Route::post('store_harga_atas_gabah_basah', [MasterSpvqcController::class, 'store_harga_atas_gabah_basah'])->name('store_harga_atas_gabah_basah');
Route::get('destroy_harga_atas_gabah_basah/{id?}', [MasterSpvqcController::class, 'destroy_harga_atas_gabah_basah'])->name('destroy_harga_atas_gabah_basah');

// Harga Atas Gabah Kering
Route::get('harga_atas_gabah_kering', [MasterSpvqcController::class, 'harga_atas_gabah_kering'])->name('harga_atas_gabah_kering');
Route::get('harga_atas_gabah_kering_index', [MasterSpvqcController::class, 'harga_atas_gabah_kering_index'])->name('harga_atas_gabah_kering_index');
Route::get('show_harga_atas_gabah_kering/{id?}', [MasterSpvqcController::class, 'show_harga_atas_gabah_kering'])->name('show_harga_atas_gabah_kering');
Route::post('update_harga_atas_gabah_kering/{id?}', [MasterSpvqcController::class, 'update_harga_atas_gabah_kering'])->name('update_harga_atas_gabah_kering');
Route::post('store_harga_atas_gabah_kering', [MasterSpvqcController::class, 'store_harga_atas_gabah_kering'])->name('store_harga_atas_gabah_kering');
Route::get('destroy_harga_atas_gabah_kering/{id?}', [MasterSpvqcController::class, 'destroy_harga_atas_gabah_kering'])->name('destroy_harga_atas_gabah_kering');

// Harga Atas Gabah PK
Route::get('harga_atas_pecah_kulit', [MasterSpvqcController::class, 'harga_atas_pecah_kulit'])->name('harga_atas_pecah_kulit');
Route::get('harga_atas_pecah_kulit_index', [MasterSpvqcController::class, 'harga_atas_pecah_kulit_index'])->name('harga_atas_pecah_kulit_index');
Route::get('show_harga_atas_pecah_kulit/{id?}', [MasterSpvqcController::class, 'show_harga_atas_pecah_kulit'])->name('show_harga_atas_pecah_kulit');
Route::post('update_harga_atas_pecah_kulit/{id?}', [MasterSpvqcController::class, 'update_harga_atas_pecah_kulit'])->name('update_harga_atas_pecah_kulit');
Route::post('store_harga_atas_pecah_kulit', [MasterSpvqcController::class, 'store_harga_atas_pecah_kulit'])->name('store_harga_atas_pecah_kulit');
Route::get('destroy_harga_atas_pecah_kulit/{id?}', [MasterSpvqcController::class, 'destroy_harga_atas_pecah_kulit'])->name('destroy_harga_atas_pecah_kulit');

// Harga Atas DS
Route::get('harga_atas_beras_ds', [MasterSpvqcController::class, 'harga_atas_beras_ds'])->name('harga_atas_beras_ds');
Route::get('harga_atas_beras_ds_index', [MasterSpvqcController::class, 'harga_atas_beras_ds_index'])->name('harga_atas_beras_ds_index');
Route::get('show_harga_atas_beras_ds/{id?}', [MasterSpvqcController::class, 'show_harga_atas_beras_ds'])->name('show_harga_atas_beras_ds');
Route::post('update_harga_atas_beras_ds/{id?}', [MasterSpvqcController::class, 'update_harga_atas_beras_ds'])->name('update_harga_atas_beras_ds');
Route::post('store_harga_atas_beras_ds', [MasterSpvqcController::class, 'store_harga_atas_beras_ds'])->name('store_harga_atas_beras_ds');
Route::get('destroy_harga_atas_beras_ds/{id?}', [MasterSpvqcController::class, 'destroy_harga_atas_beras_ds'])->name('destroy_harga_atas_beras_ds');

// Harga Potongan Gabah Basah
Route::get('potongan_gabah_basah', [MasterSpvqcController::class, 'potongan_gabah_basah'])->name('potongan_gabah_basah');
Route::get('potongan_gabah_basah_index', [MasterSpvqcController::class, 'potongan_gabah_basah_index'])->name('potongan_gabah_basah_index');
Route::get('show_potongan_gabah_basah/{id?}', [MasterSpvqcController::class, 'show_potongan_gabah_basah'])->name('show_potongan_gabah_basah');
Route::post('update_potongan_gabah_basah/{id?}', [MasterSpvqcController::class, 'update_potongan_gabah_basah'])->name('update_potongan_gabah_basah');
Route::post('store_potongan_gabah_basah', [MasterSpvqcController::class, 'store_potongan_gabah_basah'])->name('store_potongan_gabah_basah');
Route::get('destroy_potongan_gabah_basah/{id?}', [MasterSpvqcController::class, 'destroy_potongan_gabah_basah'])->name('destroy_potongan_gabah_basah');

// Harga Potongan Gabah Kering
Route::get('potongan_gabah_kering', [MasterSpvqcController::class, 'potongan_gabah_kering'])->name('potongan_gabah_kering');
Route::get('potongan_gabah_kering_index', [MasterSpvqcController::class, 'potongan_gabah_kering_index'])->name('potongan_gabah_kering_index');
Route::get('show_potongan_gabah_kering/{id?}', [MasterSpvqcController::class, 'show_potongan_gabah_kering'])->name('show_potongan_gabah_kering');
Route::post('update_potongan_gabah_kering/{id?}', [MasterSpvqcController::class, 'update_potongan_gabah_kering'])->name('update_potongan_gabah_kering');
Route::post('store_potongan_gabah_kering', [MasterSpvqcController::class, 'store_potongan_gabah_kering'])->name('store_potongan_gabah_kering');
Route::get('destroy_potongan_gabah_kering/{id?}', [MasterSpvqcController::class, 'destroy_potongan_gabah_kering'])->name('destroy_potongan_gabah_kering');

// Harga Potongan Gabah PK
Route::get('potongan_pecah_kulit', [MasterSpvqcController::class, 'potongan_pecah_kulit'])->name('potongan_pecah_kulit');
Route::get('potongan_pecah_kulit_index', [MasterSpvqcController::class, 'potongan_pecah_kulit_index'])->name('potongan_pecah_kulit_index');
Route::get('show_potongan_pecah_kulit/{id?}', [MasterSpvqcController::class, 'show_potongan_pecah_kulit'])->name('show_potongan_pecah_kulit');
Route::post('update_potongan_pecah_kulit/{id?}', [MasterSpvqcController::class, 'update_potongan_pecah_kulit'])->name('update_potongan_pecah_kulit');
Route::post('store_potongan_pecah_kulit', [MasterSpvqcController::class, 'store_potongan_pecah_kulit'])->name('store_potongan_pecah_kulit');
Route::get('destroy_potongan_pecah_kulit/{id?}', [MasterSpvqcController::class, 'destroy_potongan_pecah_kulit'])->name('destroy_potongan_pecah_kulit');

// Harga Potongan Beras DS
Route::get('potongan_beras_ds', [MasterSpvqcController::class, 'potongan_beras_ds'])->name('potongan_beras_ds');
Route::get('potongan_beras_ds_index', [MasterSpvqcController::class, 'potongan_beras_ds_index'])->name('potongan_beras_ds_index');
Route::get('show_potongan_beras_ds/{id?}', [MasterSpvqcController::class, 'show_potongan_beras_ds'])->name('show_potongan_beras_ds');
Route::post('update_potongan_beras_ds/{id?}', [MasterSpvqcController::class, 'update_potongan_beras_ds'])->name('update_potongan_beras_ds');
Route::post('store_potongan_beras_ds', [MasterSpvqcController::class, 'store_potongan_beras_ds'])->name('store_potongan_beras_ds');
Route::get('destroy_potongan_beras_ds/{id?}', [MasterSpvqcController::class, 'destroy_potongan_beras_ds'])->name('destroy_potongan_beras_ds');

// Harga Bawah Gabah Basah
Route::get('harga_bawah_gabah_basah', [MasterSpvqcController::class, 'harga_bawah_gabah_basah'])->name('harga_bawah_gabah_basah');
Route::get('harga_bawah_gabah_basah_index', [MasterSpvqcController::class, 'harga_bawah_gabah_basah_index'])->name('harga_bawah_gabah_basah_index');
Route::get('show_harga_bawah_gabah_basah/{id?}', [MasterSpvqcController::class, 'show_harga_bawah_gabah_basah'])->name('show_harga_bawah_gabah_basah');
Route::post('update_harga_bawah_gabah_basah/{id?}', [MasterSpvqcController::class, 'update_harga_bawah_gabah_basah'])->name('update_harga_bawah_gabah_basah');
Route::post('store_harga_bawah_gabah_basah', [MasterSpvqcController::class, 'store_harga_bawah_gabah_basah'])->name('store_harga_bawah_gabah_basah');
Route::get('destroy_harga_bawah_gabah_basah/{id?}', [MasterSpvqcController::class, 'destroy_harga_bawah_gabah_basah'])->name('destroy_harga_bawah_gabah_basah');

// Harga Bawah Gabah Kering
Route::get('harga_bawah_gabah_kering', [MasterSpvqcController::class, 'harga_bawah_gabah_kering'])->name('harga_bawah_gabah_kering');
Route::get('harga_bawah_gabah_kering_index', [MasterSpvqcController::class, 'harga_bawah_gabah_kering_index'])->name('harga_bawah_gabah_kering_index');
Route::get('show_harga_bawah/{id?}', [MasterSpvqcController::class, 'show_harga_bawah'])->name('show_harga_bawah');
Route::post('update_harga_bawah_gabah_kering/{id?}', [MasterSpvqcController::class, 'update_harga_bawah_gabah_kering'])->name('update_harga_bawah_gabah_kering');
Route::post('store_harga_bawah_gabah_kering', [MasterSpvqcController::class, 'store_harga_bawah_gabah_kering'])->name('store_harga_bawah_gabah_kering');
Route::get('destroy_harga_bawah_gabah_kering/{id?}', [MasterSpvqcController::class, 'destroy_harga_bawah_gabah_kering'])->name('destroy_harga_bawah_gabah_kering');

// Harga Bawah Gabah PK
Route::get('harga_bawah_pecah_kulit', [MasterSpvqcController::class, 'harga_bawah_pecah_kulit'])->name('harga_bawah_pecah_kulit');
Route::get('harga_bawah_pecah_kulit_index', [MasterSpvqcController::class, 'harga_bawah_pecah_kulit_index'])->name('harga_bawah_pecah_kulit_index');
Route::get('show_harga_bawah/{id?}', [MasterSpvqcController::class, 'show_harga_bawah'])->name('show_harga_bawah');
Route::post('update_harga_bawah_pecah_kulit/{id?}', [MasterSpvqcController::class, 'update_harga_bawah_pecah_kulit'])->name('update_harga_bawah_pecah_kulit');
Route::post('store_harga_bawah_pecah_kulit', [MasterSpvqcController::class, 'store_harga_bawah_pecah_kulit'])->name('store_harga_bawah_pecah_kulit');
Route::get('destroy_harga_bawah_pecah_kulit/{id?}', [MasterSpvqcController::class, 'destroy_harga_bawah_pecah_kulit'])->name('destroy_harga_bawah_pecah_kulit');

// Harga Bawah Beras DS
Route::get('harga_bawah_beras_ds', [MasterSpvqcController::class, 'harga_bawah_beras_ds'])->name('harga_bawah_beras_ds');
Route::get('harga_bawah_beras_ds_index', [MasterSpvqcController::class, 'harga_bawah_beras_ds_index'])->name('harga_bawah_beras_ds_index');
Route::get('show_harga_bawah/{id?}', [MasterSpvqcController::class, 'show_harga_bawah'])->name('show_harga_bawah');
Route::post('update_harga_bawah_beras_ds/{id?}', [MasterSpvqcController::class, 'update_harga_bawah_beras_ds'])->name('update_harga_bawah_beras_ds');
Route::post('store_harga_bawah_beras_ds', [MasterSpvqcController::class, 'store_harga_bawah_beras_ds'])->name('store_harga_bawah_beras_ds');
Route::get('destroy_harga_bawah_beras_ds/{id?}', [MasterSpvqcController::class, 'destroy_harga_bawah_beras_ds'])->name('destroy_harga_bawah_beras_ds');

// Parameter Lab Gabah Basah
Route::get('parameter_gb', [MasterSpvqcController::class, 'parameter_gb'])->name('parameter_gb');
Route::post('store_parameter_lab', [MasterSpvqcController::class, 'store_parameter_lab_gb'])->name('store_parameter_lab_gb');
Route::get('parameter_lab_gb_index', [MasterSpvqcController::class, 'parameter_lab_gb_index'])->name('parameter_lab_gb_index');
Route::get('show_parameter_gb/{id?}', [MasterSpvqcController::class, 'show_parameter_gb'])->name('show_parameter_gb');
Route::get('destroy_parameter_lab_gb/{id?}', [MasterSpvqcController::class, 'destroy_parameter_lab_gb'])->name('destroy_parameter_lab_gb');
Route::post('update_parameter_lab_gb/{id?}', [MasterSpvqcController::class, 'update_parameter_lab_gb'])->name('update_parameter_lab_gb');
Route::post('simpan_parameter_lab_gb', [MasterSpvqcController::class, 'simpan_parameter_lab_gb'])->name('simpan_parameter_lab_gb');

//Parameter Lab Gabah PK (Kadar Air)
Route::post('parameter_lab_pk_kadar_air_update', [MasterSpvqcController::class, 'parameter_lab_pk_kadar_air_update'])->name('parameter_lab_pk_kadar_air_update');
Route::post('parameter_lab_pk_kadar_air_store', [MasterSpvqcController::class, 'parameter_lab_pk_kadar_air_store'])->name('parameter_lab_pk_kadar_air_store');
Route::get('parameter_lab_pk_kadar_air_index', [MasterSpvqcController::class, 'parameter_lab_pk_kadar_air_index'])->name('parameter_lab_pk_kadar_air_index');
Route::get('parameter_lab_pk_kadar_air_show/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_kadar_air_show'])->name('parameter_lab_pk_kadar_air_show');
Route::get('parameter_lab_pk_kadar_air_destroy/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_kadar_air_destroy'])->name('parameter_lab_pk_kadar_air_destroy');

//Get Parameter Lab Beras PK (Kadar Air)
Route::get('get_parameter_lab_pk_kadar_air/{tanggal_po?}', [MasterSpvqcController::class, 'get_parameter_lab_pk_kadar_air'])->name('get_parameter_lab_pk_kadar_air');

//Parameter Lab Gabah PK (Hampa)
Route::post('parameter_lab_pk_hampa', [MasterSpvqcController::class, 'parameter_lab_pk_hampa'])->name('parameter_lab_pk_hampa');
Route::post('parameter_lab_pk_hampa_update', [MasterSpvqcController::class, 'parameter_lab_pk_hampa_update'])->name('parameter_lab_pk_hampa_update');
Route::post('parameter_lab_hampa_store', [MasterSpvqcController::class, 'parameter_lab_pk_hampa_store'])->name('parameter_lab_pk_hampa_store');
Route::get('parameter_lab_pk_hampa_index', [MasterSpvqcController::class, 'parameter_lab_pk_hampa_index'])->name('parameter_lab_pk_hampa_index');
Route::get('parameter_lab_pk_hampa_show/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_hampa_show'])->name('parameter_lab_pk_hampa_show');
Route::get('parameter_lab_pk_hampa_destroy/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_hampa_destroy'])->name('parameter_lab_pk_hampa_destroy');

//Get Parameter Lab Beras PK (Hampa)
Route::get('get_parameter_lab_pk_hampa/{tanggal_po?}', [MasterSpvqcController::class, 'get_parameter_lab_pk_hampa'])->name('get_parameter_lab_pk_hampa');

//Parameter Lab Beras PK (TR)
Route::post('parameter_lab_pk_tr', [MasterSpvqcController::class, 'parameter_lab_pk_tr'])->name('parameter_lab_pk_tr');
Route::post('parameter_lab_pk_tr_update', [MasterSpvqcController::class, 'parameter_lab_pk_tr_update'])->name('parameter_lab_pk_tr_update');
Route::post('parameter_lab_pk_tr_store', [MasterSpvqcController::class, 'parameter_lab_pk_tr_store'])->name('parameter_lab_pk_tr_store');
Route::get('parameter_lab_pk_tr_index', [MasterSpvqcController::class, 'parameter_lab_pk_tr_index'])->name('parameter_lab_pk_tr_index');
Route::get('parameter_lab_pk_tr_show/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_tr_show'])->name('parameter_lab_pk_tr_show');
Route::get('parameter_lab_pk_tr_destroy/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_tr_destroy'])->name('parameter_lab_pk_tr_destroy');

//Get Parameter Lab Beras PK (TR)
Route::get('get_parameter_lab_pk_tr/{tanggal_po?}', [MasterSpvqcController::class, 'get_parameter_lab_pk_tr'])->name('get_parameter_lab_pk_tr');
//Get Parameter Lab Kualitas Beras PK (TR)
Route::get('get_parameter_lab_pk_tr_kualitas/{tanggal_po?}', [MasterSpvqcController::class, 'get_parameter_lab_pk_tr_kualitas'])->name('get_parameter_lab_pk_tr_kualitas');

//Parameter Lab Beras PK (Katul)
Route::post('parameter_lab_pk_katul', [MasterSpvqcController::class, 'parameter_lab_pk_katul'])->name('parameter_lab_pk_katul');
Route::post('parameter_lab_pk_katul_update', [MasterSpvqcController::class, 'parameter_lab_pk_katul_update'])->name('parameter_lab_pk_katul_update');
Route::post('parameter_lab_katul_store', [MasterSpvqcController::class, 'parameter_lab_pk_katul_store'])->name('parameter_lab_pk_katul_store');
Route::get('parameter_lab_pk_katul_index', [MasterSpvqcController::class, 'parameter_lab_pk_katul_index'])->name('parameter_lab_pk_katul_index');
Route::get('parameter_lab_pk_katul_show/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_katul_show'])->name('parameter_lab_pk_katul_show');
Route::get('parameter_lab_pk_katul_destroy/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_katul_destroy'])->name('parameter_lab_pk_katul_destroy');

//Parameter Lab Beras PK (Butiran Patah)
Route::post('parameter_lab_pk_butiran_patah', [MasterSpvqcController::class, 'parameter_lab_pk_butiran_patah'])->name('parameter_lab_pk_butiran_patah');
Route::post('parameter_lab_pk_butiran_patah_update', [MasterSpvqcController::class, 'parameter_lab_pk_butiran_patah_update'])->name('parameter_lab_pk_butiran_patah_update');
Route::post('parameter_lab_pk_butiran_patah_store', [MasterSpvqcController::class, 'parameter_lab_pk_butiran_patah_store'])->name('parameter_lab_pk_butiran_patah_store');
Route::get('parameter_lab_pk_butiran_patah_index', [MasterSpvqcController::class, 'parameter_lab_pk_butiran_patah_index'])->name('parameter_lab_pk_butiran_patah_index');
Route::get('parameter_lab_pk_butiran_patah_show/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_butiran_patah_show'])->name('parameter_lab_pk_butiran_patah_show');
Route::get('parameter_lab_pk_butiran_patah_destroy/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_butiran_patah_destroy'])->name('parameter_lab_pk_butiran_patah_destroy');

//Get Parameter Lab Beras PK (Butiran Patah)
Route::get('get_parameter_lab_pk_butiran_patah/{tanggal_po?}', [MasterSpvqcController::class, 'get_parameter_lab_pk_butiran_patah'])->name('get_parameter_lab_pk_butiran_patah');

//Get Parameter Lab Kualitas
Route::get('get_parameter_lab_pk_kualitas/{tanggal_po?}', [MasterSpvqcController::class, 'get_parameter_lab_pk_kualitas'])->name('get_parameter_lab_pk_kualitas');

//Get Parameter Lab Beras PK (Katul)
Route::get('get_parameter_lab_pk_katul/{tanggal_po?}', [MasterSpvqcController::class, 'get_parameter_lab_pk_katul'])->name('get_parameter_lab_pk_katul');

// Parameter Lab PK
Route::get('parameter_pk_refraksi', [MasterSpvqcController::class, 'parameter_pk_refraksi'])->name('parameter_pk_refraksi');
Route::get('parameter_lab_pk_kualitas', [MasterSpvqcController::class, 'parameter_lab_pk_kualitas'])->name('parameter_lab_pk_kualitas');

// Parameter Lab Beras DS
Route::get('parameter_beras_ds', [MasterSpvqcController::class, 'parameter_beras_ds'])->name('parameter_beras_ds');

// Parameter Lab Gabah Kering
Route::get('parameter_gk', [MasterSpvqcController::class, 'parameter_gk'])->name('parameter_gk');

//Parameter Lab Beras PK (Reward)
Route::get('parameter_lab_pk_reward', [MasterSpvqcController::class, 'parameter_lab_pk_reward'])->name('parameter_lab_pk_reward');


//Parameter Lab Beras PK (Reward Kadar Air)
Route::post('parameter_lab_pk_reward_kadar_air_update', [MasterSpvqcController::class, 'parameter_lab_pk_reward_kadar_air_update'])->name('parameter_lab_pk_reward_kadar_air_update');
Route::post('parameter_lab_pk_reward_kadar_air_store', [MasterSpvqcController::class, 'parameter_lab_pk_reward_kadar_air_store'])->name('parameter_lab_pk_reward_kadar_air_store');
Route::get('parameter_lab_pk_reward_kadar_air_index', [MasterSpvqcController::class, 'parameter_lab_pk_reward_kadar_air_index'])->name('parameter_lab_pk_reward_kadar_air_index');
Route::get('parameter_lab_pk_reward_kadar_air_show/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_reward_kadar_air_show'])->name('parameter_lab_pk_reward_kadar_air_show');
Route::get('parameter_lab_pk_reward_kadar_air_destroy/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_reward_kadar_air_destroy'])->name('parameter_lab_pk_reward_kadar_air_destroy');

//Parameter Lab Beras PK (Reward Hampa)
Route::post('parameter_lab_pk_reward_hampa_update', [MasterSpvqcController::class, 'parameter_lab_pk_reward_hampa_update'])->name('parameter_lab_pk_reward_hampa_update');
Route::post('parameter_lab_pk_reward_hampa_store', [MasterSpvqcController::class, 'parameter_lab_pk_reward_hampa_store'])->name('parameter_lab_pk_reward_hampa_store');
Route::get('parameter_lab_pk_reward_hampa_index', [MasterSpvqcController::class, 'parameter_lab_pk_reward_hampa_index'])->name('parameter_lab_pk_reward_hampa_index');
Route::get('parameter_lab_pk_reward_hampa_show/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_reward_hampa_show'])->name('parameter_lab_pk_reward_hampa_show');
Route::get('parameter_lab_pk_reward_hampa_destroy/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_reward_hampa_destroy'])->name('parameter_lab_pk_reward_hampa_destroy');

//Get Parameter Lab Beras PK (Reward Hampa)
Route::get('get_parameter_lab_pk_reward_hampa/{tanggal_po?}', [MasterSpvqcController::class, 'get_parameter_lab_pk_reward_hampa'])->name('get_parameter_lab_pk_reward_hampa');

//Parameter Lab Beras PK (Reward TR)
Route::post('parameter_lab_pk_reward_tr_update', [MasterSpvqcController::class, 'parameter_lab_pk_reward_tr_update'])->name('parameter_lab_pk_reward_tr_update');
Route::post('parameter_lab_pk_reward_tr_store', [MasterSpvqcController::class, 'parameter_lab_pk_reward_tr_store'])->name('parameter_lab_pk_reward_tr_store');
Route::get('parameter_lab_pk_reward_tr_index', [MasterSpvqcController::class, 'parameter_lab_pk_reward_tr_index'])->name('parameter_lab_pk_reward_tr_index');
Route::get('parameter_lab_pk_reward_tr_show/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_reward_tr_show'])->name('parameter_lab_pk_reward_tr_show');
Route::get('parameter_lab_pk_reward_tr_destroy/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_reward_tr_destroy'])->name('parameter_lab_pk_reward_tr_destroy');

//Get Parameter Lab Beras PK (Reward TR)
Route::get('get_parameter_lab_pk_reward_tr/{tanggal_po?}', [MasterSpvqcController::class, 'get_parameter_lab_pk_reward_tr'])->name('get_parameter_lab_pk_reward_tr');

//Parameter Lab Beras PK (Reward Katul)
Route::post('parameter_lab_pk_reward_katul_update', [MasterSpvqcController::class, 'parameter_lab_pk_reward_katul_update'])->name('parameter_lab_pk_reward_katul_update');
Route::post('parameter_lab_pk_reward_katul_store', [MasterSpvqcController::class, 'parameter_lab_pk_reward_katul_store'])->name('parameter_lab_pk_reward_katul_store');
Route::get('parameter_lab_pk_reward_katul_index', [MasterSpvqcController::class, 'parameter_lab_pk_reward_katul_index'])->name('parameter_lab_pk_reward_katul_index');
Route::get('parameter_lab_pk_reward_katul_show/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_reward_katul_show'])->name('parameter_lab_pk_reward_katul_show');
Route::get('parameter_lab_pk_reward_katul_destroy/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_reward_katul_destroy'])->name('parameter_lab_pk_reward_katul_destroy');

//Get Parameter Lab Beras PK (Reward KATUL)
Route::get('get_parameter_lab_pk_reward_katul/{tanggal_po?}', [MasterSpvqcController::class, 'get_parameter_lab_pk_reward_katul'])->name('get_parameter_lab_pk_reward_katul');

//Parameter Lab Beras PK (Reward Butir Patah)
Route::post('parameter_lab_pk_reward_butir_patah_update', [MasterSpvqcController::class, 'parameter_lab_pk_reward_butir_patah_update'])->name('parameter_lab_pk_reward_butir_patah_update');
Route::post('parameter_lab_pk_reward_butir_patah_store', [MasterSpvqcController::class, 'parameter_lab_pk_reward_butir_patah_store'])->name('parameter_lab_pk_reward_butir_patah_store');
Route::get('parameter_lab_pk_reward_butir_patah_index', [MasterSpvqcController::class, 'parameter_lab_pk_reward_butir_patah_index'])->name('parameter_lab_pk_reward_butir_patah_index');
Route::get('parameter_lab_pk_reward_butir_patah_show/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_reward_butir_patah_show'])->name('parameter_lab_pk_reward_butir_patah_show');
Route::get('parameter_lab_pk_reward_butir_patah_destroy/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_reward_butir_patah_destroy'])->name('parameter_lab_pk_reward_butir_patah_destroy');

//Parameter Lab Beras PK (Kualitas)
Route::post('parameter_lab_pk_kualitas_update', [MasterSpvqcController::class, 'parameter_lab_pk_kualitas_update'])->name('parameter_lab_pk_kualitas_update');
Route::post('parameter_lab_pk_kualitas_store', [MasterSpvqcController::class, 'parameter_lab_pk_kualitas_store'])->name('parameter_lab_pk_kualitas_store');
Route::get('parameter_lab_pk_kualitas_index', [MasterSpvqcController::class, 'parameter_lab_pk_kualitas_index'])->name('parameter_lab_pk_kualitas_index');
Route::get('parameter_lab_pk_kualitas_show/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_kualitas_show'])->name('parameter_lab_pk_kualitas_show');
Route::get('parameter_lab_pk_kualitas_destroy/{id?}', [MasterSpvqcController::class, 'parameter_lab_pk_kualitas_destroy'])->name('parameter_lab_pk_kualitas_destroy');

//Get Parameter Lab Beras PK (Reward Butir Patah)
Route::get('get_parameter_lab_pk_reward_butir_patah/{tanggal_po?}', [MasterSpvqcController::class, 'get_parameter_lab_pk_reward_butir_patah'])->name('get_parameter_lab_pk_reward_butir_patah');

// output lab 1
Route::get('output_lab1_gb', [MasterSpvqcController::class, 'output_lab1_gb'])->name('output_lab1_gb');
Route::get('output_lab1_pk', [MasterSpvqcController::class, 'output_lab1_pk'])->name('output_lab1_pk');
Route::get('output_lab1_gb_ciherang_index', [MasterSpvqcController::class, 'output_lab1_gb_ciherang_index'])->name('output_lab1_gb_ciherang_index');
Route::get('output_lab1_gb_longgrain_index', [MasterSpvqcController::class, 'output_lab1_gb_longgrain_index'])->name('output_lab1_gb_longgrain_index');
Route::get('output_lab1_gb_pandan_wangi_index', [MasterSpvqcController::class, 'output_lab1_gb_pandan_wangi_index'])->name('output_lab1_gb_pandan_wangi_index');
Route::get('output_lab1_gb_ketan_putih_index', [MasterSpvqcController::class, 'output_lab1_gb_ketan_putih_index'])->name('output_lab1_gb_ketan_putih_index');
Route::get('output_lab1_pk_index', [MasterSpvqcController::class, 'output_lab1_pk_index'])->name('output_lab1_pk_index');
Route::get('approve_lab1_gb/{id?}', [MasterSpvqcController::class, 'approve_lab1_gb'])->name('approve_lab1_gb');
Route::get('analisa_ulang_lab1_gb/{id?}', [MasterSpvqcController::class, 'analisa_ulang_lab1_gb'])->name('analisa_ulang_lab1_gb');
Route::get('notapprove_lab1_gb/{id?}', [MasterSpvqcController::class, 'notapprove_lab1_gb'])->name('notapprove_lab1_gb');
Route::get('approve_tolak_lab1_gb/{id?}', [MasterSpvqcController::class, 'approve_tolak_lab1_gb'])->name('approve_tolak_lab1_gb');

// Output Lab 2
Route::get('output_lab2_gb', [MasterSpvqcController::class, 'output_lab2_gb'])->name('output_lab2_gb');
Route::get('output_lab2_pk', [MasterSpvqcController::class, 'output_lab2_pk'])->name('output_lab2_pk');
Route::get('output_lab2_gb_longgrain_index', [MasterSpvqcController::class, 'output_lab2_gb_longgrain_index'])->name('output_lab2_gb_longgrain_index');
Route::get('output_lab2_gb_ciherang_index', [MasterSpvqcController::class, 'output_lab2_gb_ciherang_index'])->name('output_lab2_gb_ciherang_index');
Route::get('output_lab2_gb_pandan_wangi_index', [MasterSpvqcController::class, 'output_lab2_gb_pandan_wangi_index'])->name('output_lab2_gb_pandan_wangi_index');
Route::get('output_lab2_gb_ketan_putih_index', [MasterSpvqcController::class, 'output_lab2_gb_ketan_putih_index'])->name('output_lab2_gb_ketan_putih_index');
Route::get('output_lab2_pk_index', [MasterSpvqcController::class, 'output_lab2_pk_index'])->name('output_lab2_pk_index');
Route::get('approve_lab2_gb/{id?}', [MasterSpvqcController::class, 'approve_lab2_gb'])->name('approve_lab2_gb');
Route::get('approve_lab2_pk/{id?}', [MasterSpvqcController::class, 'approve_lab2_pk'])->name('approve_lab2_pk');
Route::post('update_harga_akhir_gb', [MasterSpvqcController::class, 'update_harga_akhir_gb'])->name('update_harga_akhir_gb');
Route::post('update_harga_akhir_pk', [MasterSpvqcController::class, 'update_harga_akhir_pk'])->name('update_harga_akhir_pk');
Route::get('cekstatuslab1/{id?}', [MasterSpvqcController::class, 'cekstatuslab1'])->name('cekstatuslab1');
Route::get('tolak_approved/{id?}', [MasterSpvqcController::class, 'tolak_approved'])->name('tolak_approved');
Route::get('tolak_approved_pk/{id?}', [MasterSpvqcController::class, 'tolak_approved_pk'])->name('tolak_approved_pk');

// Nego
Route::get('nego_gb_longgrain_index', [MasterSpvqcController::class, 'nego_gb_longgrain_index'])->name('nego_gb_longgrain_index');
Route::get('nego_gb_ciherang_index', [MasterSpvqcController::class, 'nego_gb_ciherang_index'])->name('nego_gb_ciherang_index');
Route::get('nego_gb_pandan_wangi_index', [MasterSpvqcController::class, 'nego_gb_pandan_wangi_index'])->name('nego_gb_pandan_wangi_index');
Route::get('nego_gb_ketan_putih_index', [MasterSpvqcController::class, 'nego_gb_ketan_putih_index'])->name('nego_gb_ketan_putih_index');
Route::get('nego_pk_index', [MasterSpvqcController::class, 'nego_pk_index'])->name('nego_pk_index');
Route::get('nego', [MasterSpvqcController::class, 'nego'])->name('nego');
Route::post('output_nego_gb/{id?}', [MasterSpvqcController::class, 'output_nego_gb'])->name('output_nego_gb');
Route::post('output_nego_pk/{id?}', [MasterSpvqcController::class, 'output_nego_pk'])->name('output_nego_pk');

// Revisi
Route::get('revisi_harga_gb_ciherang_index', [MasterSpvqcController::class, 'revisi_harga_gb_ciherang_index'])->name('revisi_harga_gb_ciherang_index');
Route::get('revisi_harga_gb_pandan_wangi_index', [MasterSpvqcController::class, 'revisi_harga_gb_pandan_wangi_index'])->name('revisi_harga_gb_pandan_wangi_index');
Route::get('revisi_harga_gb_longgrain_index', [MasterSpvqcController::class, 'revisi_harga_gb_longgrain_index'])->name('revisi_harga_gb_longgrain_index');
Route::get('revisi_harga_gb_ketan_putih_index', [MasterSpvqcController::class, 'revisi_harga_gb_ketan_putih_index'])->name('revisi_harga_gb_ketan_putih_index');
Route::get('revisi_harga_pk_index', [MasterSpvqcController::class, 'revisi_harga_pk_index'])->name('revisi_harga_pk_index');
Route::get('revisi_harga', [MasterSpvqcController::class, 'revisi_harga'])->name('revisi_harga');
Route::post('save_revisi_harga_gb/{id?}', [MasterSpvqcController::class, 'save_revisi_harga_gb'])->name('save_revisi_harga_gb');
Route::post('save_revisi_harga_pk/{id?}', [MasterSpvqcController::class, 'save_revisi_harga_pk'])->name('save_revisi_harga_pk');
// Surveyor
Route::get('data_surveyor', [MasterSpvqcController::class, 'data_surveyor'])->name('data_surveyor');
Route::get('data_surveyor_index', [MasterSpvqcController::class, 'data_surveyor_index'])->name('data_surveyor_index');
Route::get('get_surveyor/{id?}', [MasterSpvqcController::class, 'get_surveyor'])->name('get_surveyor');
Route::post('save_surveyor', [MasterSpvqcController::class, 'save_surveyor'])->name('save_surveyor');
Route::post('update_surveyor', [MasterSpvqcController::class, 'update_surveyor'])->name('update_surveyor');
Route::get('delete_surveyor/{id?}', [MasterSpvqcController::class, 'delete_surveyor'])->name('delete_surveyor');


// LOG ACTIVITY SPV QC
Route::get('/log_activity_spvqc', [MasterSpvqcController::class, 'log_activity_spvqc'])->name('log_activity_spvqc');
Route::get('/log_activity_spvqc_index', [MasterSpvqcController::class, 'log_activity_spvqc_index'])->name('log_activity_spvqc_index');


