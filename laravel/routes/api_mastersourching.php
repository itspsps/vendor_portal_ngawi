<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMaster\MasterSourchingController;

Route::get('/bid', [MasterSourchingController::class, 'bid'])->name('bid');
Route::get('/bid_response/list_bid_po/{id?}', [MasterSourchingController::class, 'list_bid_po'])->name('list_bid_po');
Route::get('/bid_response/list_bid_po_index/{id?}', [MasterSourchingController::class, 'list_bid_po_index'])->name('list_bid_po_index');
Route::get('/list_po_diterima', [MasterSourchingController::class, 'list_po_diterima'])->name('list_po_diterima');
Route::get('/list_data_po_diterima_index', [MasterSourchingController::class, 'list_data_po_diterima_index'])->name('list_data_po_diterima_index');
Route::get('/output_data_index', [MasterSourchingController::class, 'output_data_index'])->name('output_data_index');
Route::get('/data_purchasing', [MasterSourchingController::class, 'data_purchasing'])->name('data_purchasing');
Route::get('/status_pending/{id?}', [MasterSourchingController::class, 'status_pending'])->name('status_pending');
Route::get('/cetak_po_sourching/{id?}', [MasterSourchingController::class, 'cetak_po_sourching'])->name('cetak_po_sourching');
Route::get('/cekusername/{id?}', [MasterSourchingController::class, 'cekUsername'])->name('cekusername');
Route::get('/get_npwp/{id?}', [MasterSourchingController::class, 'get_npwp'])->name('get_npwp');
Route::get('/get_nik/{id?}', [MasterSourchingController::class, 'get_nik'])->name('get_nik');
Route::get('/get_verifyemail/{id?}', [MasterSourchingController::class, 'get_verifyemail'])->name('get_verifyemail');
// Data Sourching
// On Prosess
Route::get('/data_sourching_onprocess', [MasterSourchingController::class, 'data_sourching_onprocess'])->name('data_sourching_onprocess');
Route::get('/data_sourching_onprocess_gb_ciherang_index', [MasterSourchingController::class, 'data_sourching_onprocess_gb_ciherang_index'])->name('data_sourching_onprocess_gb_ciherang_index');
Route::get('/data_sourching_onprocess_gb_pandan_wangi_index', [MasterSourchingController::class, 'data_sourching_onprocess_gb_pandan_wangi_index'])->name('data_sourching_onprocess_gb_pandan_wangi_index');
Route::get('/data_sourching_onprocess_gb_longgrain_index', [MasterSourchingController::class, 'data_sourching_onprocess_gb_longgrain_index'])->name('data_sourching_onprocess_gb_longgrain_index');
Route::get('/data_sourching_onprocess_gb_ketan_putih_index', [MasterSourchingController::class, 'data_sourching_onprocess_gb_ketan_putih_index'])->name('data_sourching_onprocess_gb_ketan_putih_index');
Route::get('/data_sourching_onprocess_pk_index', [MasterSourchingController::class, 'data_sourching_onprocess_pk_index'])->name('data_sourching_onprocess_pk_index');

// On Deal
Route::get('/data_sourching_deal', [MasterSourchingController::class, 'data_sourching_deal'])->name('data_sourching_deal');
Route::get('/data_sourching_deal_gb_longgrain_index', [MasterSourchingController::class, 'data_sourching_deal_gb_longgrain_index'])->name('data_sourching_deal_gb_longgrain_index');
Route::get('/data_sourching_deal_gb_ciherang_index', [MasterSourchingController::class, 'data_sourching_deal_gb_ciherang_index'])->name('data_sourching_deal_gb_ciherang_index');
Route::get('/data_sourching_deal_gb_pandan_wangi_index', [MasterSourchingController::class, 'data_sourching_deal_gb_pandan_wangi_index'])->name('data_sourching_deal_gb_pandan_wangi_index');
Route::get('/data_sourching_deal_gb_ketan_putih_index', [MasterSourchingController::class, 'data_sourching_deal_gb_ketan_putih_index'])->name('data_sourching_deal_gb_ketan_putih_index');
Route::get('/data_sourching_deal_pk_index', [MasterSourchingController::class, 'data_sourching_deal_pk_index'])->name('data_sourching_deal_pk_index');

// Nego
Route::get('/data_sourching_nego', [MasterSourchingController::class, 'data_sourching_nego'])->name('data_sourching_nego');
Route::get('/data_sourching_nego_gb_ciherang_index', [MasterSourchingController::class, 'data_sourching_nego_gb_ciherang_index'])->name('data_sourching_nego_gb_ciherang_index');
Route::get('/data_sourching_nego_gb_longgrain_index', [MasterSourchingController::class, 'data_sourching_nego_gb_longgrain_index'])->name('data_sourching_nego_gb_longgrain_index');
Route::get('/data_sourching_nego_gb_pandan_wangi_index', [MasterSourchingController::class, 'data_sourching_nego_gb_pandan_wangi_index'])->name('data_sourching_nego_gb_pandan_wangi_index');
Route::get('/data_sourching_nego_gb_ketan_putih_index', [MasterSourchingController::class, 'data_sourching_nego_gb_ketan_putih_index'])->name('data_sourching_nego_gb_ketan_putih_index');
Route::get('/data_sourching_nego_pk_index', [MasterSourchingController::class, 'data_sourching_nego_pk_index'])->name('data_sourching_nego_pk_index');

// Output Nego
Route::get('/data_sourching_output_nego', [MasterSourchingController::class, 'data_sourching_output_nego'])->name('data_sourching_output_nego');
Route::get('/data_sourching_output_nego_gb_index', [MasterSourchingController::class, 'data_sourching_output_nego_gb_index'])->name('data_sourching_output_nego_gb_index');
Route::get('/data_sourching_output_nego_pk_index', [MasterSourchingController::class, 'data_sourching_output_nego_pk_index'])->name('data_sourching_output_nego_pk_index');

// update status 
Route::get('/status_deal_gb/{id?}', [MasterSourchingController::class, 'status_deal_gb'])->name('status_deal_gb');
Route::get('/status_deal_pk/{id?}', [MasterSourchingController::class, 'status_deal_pk'])->name('status_deal_pk');
Route::get('/status_nego_gb/{id?}', [MasterSourchingController::class, 'status_nego_gb'])->name('status_nego_gb');
Route::get('/status_nego_pk/{id?}', [MasterSourchingController::class, 'status_nego_pk'])->name('status_nego_pk');

Route::get('/bid', [MasterSourchingController::class, 'bid'])->name('bid');
Route::get('/late_delivery', [MasterSourchingController::class, 'late_delivery'])->name('late_delivery');
Route::get('/perpanjang_po/{id?}', [MasterSourchingController::class, 'perpanjang_po'])->name('perpanjang_po');
Route::get('/vendor', [MasterSourchingController::class, 'vendor'])->name('vendor');
Route::get('/account', [MasterSourchingController::class, 'account'])->name('account');
Route::get('/news', [MasterSourchingController::class, 'news'])->name('news');
Route::get('/broadcast', [MasterSourchingController::class, 'broadcast'])->name('broadcast');
Route::get('/populer', [MasterSourchingController::class, 'populer'])->name('populer');
Route::get('/invoice', [MasterSourchingController::class, 'generateInvoicePDF'])->name('invoice');

Route::post('/download_data_sourching_deal_gb_excel', [MasterSourchingController::class, 'download_data_sourching_deal_gb_excel'])->name('download_data_sourching_deal_gb_excel');
Route::post('/download_data_sourching_deal_filter_gb_excel', [MasterSourchingController::class, 'download_data_sourching_deal_filter_gb_excel'])->name('download_data_sourching_deal_filter_gb_excel');
Route::post('/download_data_sourching_deal_pk_excel', [MasterSourchingController::class, 'download_data_sourching_deal_pk_excel'])->name('download_data_sourching_deal_pk_excel');
// LOG ACTIVITY SOURCHING
Route::get('/log_activity_sourching', [MasterSourchingController::class, 'log_activity_sourching'])->name('log_activity_sourching');
Route::get('/log_activity_sourching_index', [MasterSourchingController::class, 'log_activity_sourching_index'])->name('log_activity_sourching_index');

Route::get('/tagihan', [MasterSourchingController::class, 'tagihan'])->name('tagihan');
Route::get('/tagihan_index', [MasterSourchingController::class, 'tagihan_index'])->name('tagihan_index');
Route::get('/tagihan1_index', [MasterSourchingController::class, 'tagihan1_index'])->name('tagihan1_index');
Route::post('/upload_tagihan', [MasterSourchingController::class, 'upload_tagihan'])->name('upload_tagihan');
Route::post('/update_tagihan', [MasterSourchingController::class, 'update_tagihan'])->name('update_tagihan');
Route::get('/delete_tagihan/{id?}', [MasterSourchingController::class, 'delete_tagihan'])->name('delete_tagihan');

Route::get('/bid_gb_index', [MasterSourchingController::class, 'bid_gb_index'])->name('bid_gb_index');
Route::get('/bid_pk_index', [MasterSourchingController::class, 'bid_pk_index'])->name('bid_pk_index');
Route::get('/bid_ds_index', [MasterSourchingController::class, 'bid_ds_index'])->name('bid_ds_index');
Route::post('/bid_store', [MasterSourchingController::class, 'store'])->name('bid_store');
Route::get('/bid_show/{id?}', [MasterSourchingController::class, 'show'])->name('bid_show');
Route::post('/add_kuota', [MasterSourchingController::class, 'add_kuota'])->name('add_kuota');
Route::get('/delete_add_kuota/{id?}', [MasterSourchingController::class, 'delete_add_kuota'])->name('delete_add_kuota');
Route::post('/bid/update/{id?}', [MasterSourchingController::class, 'update'])->name('bid_update');
Route::get('/bid_destroy/{id_bid?}', [MasterSourchingController::class, 'destroy'])->name('bid_destroy');
Route::get('/bid_response/{id_bid?}', [MasterSourchingController::class, 'response'])->name('bid_response');
Route::get('/list_approve_po/{id_bid?}', [MasterSourchingController::class, 'list_approve_po'])->name('list_approve_po');
Route::get('/data_list_index/{id?}', [MasterSourchingController::class, 'data_list_index'])->name('data_list_index');
Route::get('/data_list_pk_index/{id?}', [MasterSourchingController::class, 'data_list_pk_index'])->name('data_list_pk_index');
Route::get('/data_list_ds_index/{id?}', [MasterSourchingController::class, 'data_list_ds_index'])->name('data_list_ds_index');
Route::get('/bid_status/{id_bid?}', [MasterSourchingController::class, 'bid_status'])->name('bid_status');
Route::get('/status_pending/{id?}', [MasterSourchingController::class, 'status_pending'])->name('status_pending');

Route::get('/response_index', [MasterSourchingController::class, 'response_index'])->name('response_index');
Route::get('/bid_user/{id?}', [MasterSourchingController::class, 'bid_user'])->name('bid_user');
Route::post('/approve_bid', [MasterSourchingController::class, 'approve_bid'])->name('approve_bid');

Route::post('/vendor_store', [MasterSourchingController::class, 'approve_store'])->name('approve_store');
Route::post('/vendor_store', [MasterSourchingController::class, 'vendor_store'])->name('vendor_store');
Route::get('/vendor_index', [MasterSourchingController::class, 'vendor_index'])->name('vendor_index');
Route::get('/vendor_destroy/{id?}', [MasterSourchingController::class, 'vendor_destroy'])->name('vendor_destroy');
Route::get('/vendor_show/{id?}', [MasterSourchingController::class, 'vendor_show'])->name('vendor_show');
Route::post('/vendor/update/{id?}', [MasterSourchingController::class, 'vendor_update'])->name('vendor_update');
Route::post('/vendor/vendor_update_npwp', [MasterSourchingController::class, 'vendor_update_npwp'])->name('vendor_update_npwp');
Route::post('/vendor/vendor_update_ktp/{id?}', [MasterSourchingController::class, 'vendor_update_ktp'])->name('vendor_update_ktp');
Route::post('/vendor/vendor_update_pembayaran/{id?}', [MasterSourchingController::class, 'vendor_update_pembayaran'])->name('vendor_update_pembayaran');
Route::post('/vendor/vendor_update_profil/{id?}', [MasterSourchingController::class, 'vendor_update_profil'])->name('vendor_update_profil');
Route::get('/vendor/status/{id?}', [MasterSourchingController::class, 'vendor_status'])->name('vendor_status');
Route::get('/vendor/detail/{id?}', [MasterSourchingController::class, 'vendor_detail'])->name('vendor_detail');

Route::post('/broadcast_store', [MasterSourchingController::class, 'broadcast_store'])->name('broadcast_store');
Route::get('/broadcast_index', [MasterSourchingController::class, 'broadcast_index'])->name('broadcast_index');
Route::post('/broadcast_update', [MasterSourchingController::class, 'broadcast_update'])->name('broadcast_update');
Route::get('/broadcast_destroy/{id?}', [MasterSourchingController::class, 'broadcast_destroy'])->name('broadcast_destroy');
Route::get('/broadcast_show/{id?}', [MasterSourchingController::class, 'broadcast_show'])->name('broadcast_show');
Route::get('/getkabupaten', [MasterSourchingController::class, 'getkabupaten'])->name('getkabupaten');
Route::get('/getkecamatan', [MasterSourchingController::class, 'getkecamatan'])->name('getkecamatan');
Route::get('/getdesa', [MasterSourchingController::class, 'getdesa'])->name('getdesa');
Route::get('/vendor/export_excel', [MasterSourchingController::class, 'vendor_export_excel'])->name('vendor_export_excel');
Route::post('/vendor_store', [MasterSourchingController::class, 'vendor_store'])->name('vendor_store');
Route::get('/vendor/export_excel', [MasterSourchingController::class, 'vendor_export_excel'])->name('vendor_export_excel');
Route::get('/vendor/export_pdf', [MasterSourchingController::class, 'vendor_export_pdf'])->name('vendor_export_pdf');
Route::get('/vendor/print', [MasterSourchingController::class, 'vendor_print'])->name('vendor_print');
Route::get('/vendor/export_csv', [MasterSourchingController::class, 'vendor_export_csv'])->name('vendor_export_csv');
Route::get('/vendor/vendor_print_form/{id?}', [MasterSourchingController::class, 'vendor_print_form'])->name('vendor_print_form');
Route::post('/download_data_pesanan_pemebelian_aol', [MasterSourchingController::class, 'download_data_pesanan_pemebelian_aol'])->name('download_data_pesanan_pemebelian_aol');
