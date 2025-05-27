<?php

use App\Http\Controllers\AdminMaster\MasterSecurityController;
use Illuminate\Support\Facades\Route;

Route::get('/security/gabahkering_index_sekarang', [MasterSecurityController::class, 'gabahkering_index_sekarang'])->name('security.gabahkering_index_sekarang');
Route::get('/security/gabahbasah_index_kemarin', [MasterSecurityController::class, 'gabahbasah_index_kemarin'])->name('security.gabahbasah_index_kemarin');
Route::get('/security/gabahbasah_index_sekarang', [MasterSecurityController::class, 'gabahbasah_index_sekarang'])->name('security.gabahbasah_index_sekarang');
Route::get('/security/gabahbasah_index_besok', [MasterSecurityController::class, 'gabahbasah_index_besok'])->name('security.gabahbasah_index_besok');
Route::get('/security/beraspk_index_kemarin', [MasterSecurityController::class, 'beraspk_index_kemarin'])->name('security.beraspk_index_kemarin');
Route::get('/security/beraspk_index_sekarang', [MasterSecurityController::class, 'beraspk_index_sekarang'])->name('security.beraspk_index_sekarang');
Route::get('/security/beraspk_index_besok', [MasterSecurityController::class, 'beraspk_index_besok'])->name('security.beraspk_index_besok');
Route::get('/security/berasdsurgent_index_kemarin', [MasterSecurityController::class, 'berasdsurgent_index_kemarin'])->name('security.berasdsurgent_index_kemarin');
Route::get('/security/berasdsurgent_index_sekarang', [MasterSecurityController::class, 'berasdsurgent_index_sekarang'])->name('security.berasdsurgent_index_sekarang');
Route::get('/security/berasdsurgent_index_besok', [MasterSecurityController::class, 'berasdsurgent_index_besok'])->name('security.berasdsurgent_index_besok');
Route::get('/security/berasdsnoturgent_index_sekarang', [MasterSecurityController::class, 'berasdsnoturgent_index_sekarang'])->name('security.berasdsnoturgent_index_sekarang');
Route::get('/security/po_diterima_index', [MasterSecurityController::class, 'po_diterima_index'])->name('security.po_diterima_index');
Route::get('/security/data_revisi', [MasterSecurityController::class, 'data_revisi'])->name('security.data_revisi');
Route::get('/security/data_revisi_index', [MasterSecurityController::class, 'data_revisi_index'])->name('security.data_revisi_index');
Route::get('/security/po_parkir', [MasterSecurityController::class, 'po_parkir'])->name('security.po_parkir');
Route::get('/security/po_parkir_index', [MasterSecurityController::class, 'po_parkir_index'])->name('security.po_parkir_index');
Route::get('/security/po_on_call', [MasterSecurityController::class, 'po_on_call'])->name('security.po_on_call');
Route::get('/security/po_on_call_index', [MasterSecurityController::class, 'po_on_call_index'])->name('security.po_on_call_index');
Route::get('/security/po_bongkar', [MasterSecurityController::class, 'po_bongkar'])->name('security.po_bongkar');
Route::get('/security/po_bongkar_index', [MasterSecurityController::class, 'po_bongkar_index'])->name('security.po_bongkar_index');
Route::get('/security/show_nopol/{id?}', [MasterSecurityController::class, 'show_nopol'])->name('security.show_nopol');
Route::post('/security/update_nopol', [MasterSecurityController::class, 'update_nopol'])->name('security.update_nopol');
Route::get('/security/data_po_diterima_index', [MasterSecurityController::class, 'data_po_diterima_index'])->name('security.data_po_diterima_index');
Route::get('/security/po_ditolak_index', [MasterSecurityController::class, 'po_ditolak_index'])->name('security.po_ditolak_index');
Route::get('/security/data_po_ditolak_index', [MasterSecurityController::class, 'data_po_ditolak_index'])->name('security.data_po_ditolak_index');
Route::get('/security/gabah_kering', [MasterSecurityController::class, 'gabah_kering'])->name('security.gabah_kering');
Route::get('/security/gabah_basah', [MasterSecurityController::class, 'gabah_basah'])->name('security.gabah_basah');
Route::get('/security/beras_pk', [MasterSecurityController::class, 'beras_pk'])->name('security.beras_pk');
Route::get('/security/beras_ds_urgent', [MasterSecurityController::class, 'beras_ds_urgent'])->name('security.beras_ds_urgent');
Route::get('/security/beras_ds_noturgent', [MasterSecurityController::class, 'beras_ds_noturgent'])->name('security.beras_ds_noturgent');
Route::get('/security/po_diterima', [MasterSecurityController::class, 'po_diterima'])->name('security.po_diterima');
Route::get('/security/po_ditolak', [MasterSecurityController::class, 'po_ditolak'])->name('security.po_ditolak');
Route::get('/security/po_pending', [MasterSecurityController::class, 'po_pending'])->name('security.po_pending');
Route::get('/security/po_pending_index', [MasterSecurityController::class, 'po_pending_index'])->name('security.po_pending_index');
Route::get('/security/unloading_location', [MasterSecurityController::class, 'unloading_location'])->name('security.unloading_location');
Route::get('/security/unloading_location_index', [MasterSecurityController::class, 'unloading_location_index'])->name('security.unloading_location_index');
Route::post('/security/terima_data_po', [MasterSecurityController::class, 'terima_data_po'])->name('security.terima_data_po');
Route::get('/security/tolak_po_telat/{id?}', [MasterSecurityController::class, 'tolak_po_telat'])->name('security.tolak_po_telat');
Route::post('/security/terima_data_po_telat', [MasterSecurityController::class, 'terima_data_po_telat'])->name('security.terima_data_po_telat');
Route::get('/security/show/penerimaan_po/{id?}', [MasterSecurityController::class, 'show_penerimaan_po'])->name('security.show.penerimaan_po');
Route::get('/security/to_satpam_for_bonkar/{id?}', [MasterSecurityController::class, 'to_satpam_for_bonkar'])->name('security.to_satpam_for_bonkar');

// LOG ACTIVITY SECURITY
Route::get('/security/log_activity_security', [MasterSecurityController::class, 'log_activity_security'])->name('security.log_activity_security');
Route::get('/security/log_activity_security_index', [MasterSecurityController::class, 'log_activity_security_index'])->name('security.log_activity_security_index');
