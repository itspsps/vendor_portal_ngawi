<?php

use App\Http\Controllers\AdminMaster\MasterSecurityController;
use Illuminate\Support\Facades\Route;

Route::get('/gabahkering_index_sekarang', [MasterSecurityController::class, 'gabahkering_index_sekarang'])->name('gabahkering_index_sekarang');
Route::get('/gabahbasah_index_kemarin', [MasterSecurityController::class, 'gabahbasah_index_kemarin'])->name('gabahbasah_index_kemarin');
Route::get('/gabahbasah_index_sekarang', [MasterSecurityController::class, 'gabahbasah_index_sekarang'])->name('gabahbasah_index_sekarang');
Route::get('/gabahbasah_index_besok', [MasterSecurityController::class, 'gabahbasah_index_besok'])->name('gabahbasah_index_besok');
Route::get('/beraspk_index_kemarin', [MasterSecurityController::class, 'beraspk_index_kemarin'])->name('beraspk_index_kemarin');
Route::get('/beraspk_index_sekarang', [MasterSecurityController::class, 'beraspk_index_sekarang'])->name('beraspk_index_sekarang');
Route::get('/beraspk_index_besok', [MasterSecurityController::class, 'beraspk_index_besok'])->name('beraspk_index_besok');
Route::get('/berasdsurgent_index_kemarin', [MasterSecurityController::class, 'berasdsurgent_index_kemarin'])->name('berasdsurgent_index_kemarin');
Route::get('/berasdsurgent_index_sekarang', [MasterSecurityController::class, 'berasdsurgent_index_sekarang'])->name('berasdsurgent_index_sekarang');
Route::get('/berasdsurgent_index_besok', [MasterSecurityController::class, 'berasdsurgent_index_besok'])->name('berasdsurgent_index_besok');
Route::get('/berasdsnoturgent_index_sekarang', [MasterSecurityController::class, 'berasdsnoturgent_index_sekarang'])->name('berasdsnoturgent_index_sekarang');
Route::get('/po_diterima_index', [MasterSecurityController::class, 'po_diterima_index'])->name('po_diterima_index');
Route::get('/data_revisi', [MasterSecurityController::class, 'data_revisi'])->name('data_revisi');
Route::get('/data_revisi_index', [MasterSecurityController::class, 'data_revisi_index'])->name('data_revisi_index');
Route::get('/po_parkir', [MasterSecurityController::class, 'po_parkir'])->name('po_parkir');
Route::get('/po_parkir_index', [MasterSecurityController::class, 'po_parkir_index'])->name('po_parkir_index');
Route::get('/po_on_call', [MasterSecurityController::class, 'po_on_call'])->name('po_on_call');
Route::get('/po_on_call_index', [MasterSecurityController::class, 'po_on_call_index'])->name('po_on_call_index');
Route::get('/po_bongkar', [MasterSecurityController::class, 'po_bongkar'])->name('po_bongkar');
Route::get('/po_bongkar_index', [MasterSecurityController::class, 'po_bongkar_index'])->name('po_bongkar_index');
Route::get('/show_nopol/{id?}', [MasterSecurityController::class, 'show_nopol'])->name('show_nopol');
Route::post('/update_nopol', [MasterSecurityController::class, 'update_nopol'])->name('update_nopol');
Route::get('/data_po_diterima_index', [MasterSecurityController::class, 'data_po_diterima_index'])->name('data_po_diterima_index');
Route::get('/po_ditolak_index', [MasterSecurityController::class, 'po_ditolak_index'])->name('po_ditolak_index');
Route::get('/data_po_ditolak_index', [MasterSecurityController::class, 'data_po_ditolak_index'])->name('data_po_ditolak_index');
Route::get('/gabah_kering', [MasterSecurityController::class, 'gabah_kering'])->name('gabah_kering');
Route::get('/gabah_basah', [MasterSecurityController::class, 'gabah_basah'])->name('gabah_basah');
Route::get('/beras_pk', [MasterSecurityController::class, 'beras_pk'])->name('beras_pk');
Route::get('/beras_ds_urgent', [MasterSecurityController::class, 'beras_ds_urgent'])->name('beras_ds_urgent');
Route::get('/beras_ds_noturgent', [MasterSecurityController::class, 'beras_ds_noturgent'])->name('beras_ds_noturgent');
Route::get('/po_diterima', [MasterSecurityController::class, 'po_diterima'])->name('po_diterima');
Route::get('/po_ditolak', [MasterSecurityController::class, 'po_ditolak'])->name('po_ditolak');
Route::get('/po_pending', [MasterSecurityController::class, 'po_pending'])->name('po_pending');
Route::get('/po_pending_index', [MasterSecurityController::class, 'po_pending_index'])->name('po_pending_index');
Route::get('/unloading_location', [MasterSecurityController::class, 'unloading_location'])->name('unloading_location');
Route::get('/unloading_location_index', [MasterSecurityController::class, 'unloading_location_index'])->name('unloading_location_index');
Route::post('/terima_data_po', [MasterSecurityController::class, 'terima_data_po'])->name('terima_data_po');
Route::get('/tolak_po_telat/{id?}', [MasterSecurityController::class, 'tolak_po_telat'])->name('tolak_po_telat');
Route::post('/terima_data_po_telat', [MasterSecurityController::class, 'terima_data_po_telat'])->name('terima_data_po_telat');
Route::get('/show/penerimaan_po/{id?}', [MasterSecurityController::class, 'show_penerimaan_po'])->name('show.penerimaan_po');
Route::get('/to_satpam_for_bonkar/{id?}', [MasterSecurityController::class, 'to_satpam_for_bonkar'])->name('to_satpam_for_bonkar');

// LOG ACTIVITY SECURITY
Route::get('/log_activity_security', [MasterSecurityController::class, 'log_activity_security'])->name('log_activity_security');
Route::get('/log_activity_security_index', [MasterSecurityController::class, 'log_activity_security_index'])->name('log_activity_security_index');
