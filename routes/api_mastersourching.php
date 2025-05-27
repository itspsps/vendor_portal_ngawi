<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminMaster\MasterSourchingController;

Route::get('/sourching/bid', [MasterSourchingController::class, 'bid'])->name('sourching.bid');
Route::get('/sourching/bid_response/list_bid_po/{id?}', [MasterSourchingController::class, 'list_bid_po'])->name('sourching.list_bid_po');
Route::get('/sourching/bid_response/list_bid_po_index/{id?}', [MasterSourchingController::class, 'list_bid_po_index'])->name('sourching.list_bid_po_index');
Route::get('/sourching/list_po_diterima', [MasterSourchingController::class, 'list_po_diterima'])->name('sourching.list_po_diterima');
Route::get('/sourching/list_data_po_diterima_index', [MasterSourchingController::class, 'list_data_po_diterima_index'])->name('sourching.list_data_po_diterima_index');
Route::get('/sourching/output_data_index', [MasterSourchingController::class, 'output_data_index'])->name('sourching.output_data_index');
Route::get('/sourching/data_purchasing', [MasterSourchingController::class, 'data_purchasing'])->name('sourching.data_purchasing');
Route::get('/sourching/status_pending/{id?}', [MasterSourchingController::class, 'status_pending'])->name('sourching.status_pending');
Route::get('/sourching/cetak_po_sourching/{id?}', [MasterSourchingController::class, 'cetak_po_sourching'])->name('sourching.cetak_po_sourching');
Route::get('/sourching/cekusername/{id?}', [MasterSourchingController::class, 'cekUsername'])->name('sourching.cekusername');
Route::get('/sourching/get_npwp/{id?}', [MasterSourchingController::class, 'get_npwp'])->name('sourching.get_npwp');
Route::get('/sourching/get_nik/{id?}', [MasterSourchingController::class, 'get_nik'])->name('sourching.get_nik');
Route::get('/sourching/get_verifyemail/{id?}', [MasterSourchingController::class, 'get_verifyemail'])->name('sourching.get_verifyemail');
// Data Sourching
// On Prosess
Route::get('/sourching/data_sourching_onprocess', [MasterSourchingController::class, 'data_sourching_onprocess'])->name('sourching.data_sourching_onprocess');
Route::get('/sourching/data_sourching_onprocess_gb_ciherang_index', [MasterSourchingController::class, 'data_sourching_onprocess_gb_ciherang_index'])->name('sourching.data_sourching_onprocess_gb_ciherang_index');
Route::get('/sourching/data_sourching_onprocess_gb_pandan_wangi_index', [MasterSourchingController::class, 'data_sourching_onprocess_gb_pandan_wangi_index'])->name('sourching.data_sourching_onprocess_gb_pandan_wangi_index');
Route::get('/sourching/data_sourching_onprocess_gb_longgrain_index', [MasterSourchingController::class, 'data_sourching_onprocess_gb_longgrain_index'])->name('sourching.data_sourching_onprocess_gb_longgrain_index');
Route::get('/sourching/data_sourching_onprocess_gb_ketan_putih_index', [MasterSourchingController::class, 'data_sourching_onprocess_gb_ketan_putih_index'])->name('sourching.data_sourching_onprocess_gb_ketan_putih_index');
Route::get('/sourching/data_sourching_onprocess_pk_index', [MasterSourchingController::class, 'data_sourching_onprocess_pk_index'])->name('sourching.data_sourching_onprocess_pk_index');

// On Deal
Route::get('/sourching/data_sourching_deal', [MasterSourchingController::class, 'data_sourching_deal'])->name('sourching.data_sourching_deal');
Route::get('/sourching/data_sourching_deal_gb_longgrain_index', [MasterSourchingController::class, 'data_sourching_deal_gb_longgrain_index'])->name('sourching.data_sourching_deal_gb_longgrain_index');
Route::get('/sourching/data_sourching_deal_gb_ciherang_index', [MasterSourchingController::class, 'data_sourching_deal_gb_ciherang_index'])->name('sourching.data_sourching_deal_gb_ciherang_index');
Route::get('/sourching/data_sourching_deal_gb_pandan_wangi_index', [MasterSourchingController::class, 'data_sourching_deal_gb_pandan_wangi_index'])->name('sourching.data_sourching_deal_gb_pandan_wangi_index');
Route::get('/sourching/data_sourching_deal_gb_ketan_putih_index', [MasterSourchingController::class, 'data_sourching_deal_gb_ketan_putih_index'])->name('sourching.data_sourching_deal_gb_ketan_putih_index');
Route::get('/sourching/data_sourching_deal_pk_index', [MasterSourchingController::class, 'data_sourching_deal_pk_index'])->name('sourching.data_sourching_deal_pk_index');
Route::get('/sourching/count_deal_gb', [MasterSourchingController::class, 'count_deal_gb'])->name('sourching.count_deal_gb');

// Nego
Route::get('/sourching/data_sourching_nego', [MasterSourchingController::class, 'data_sourching_nego'])->name('sourching.data_sourching_nego');
Route::get('/sourching/data_sourching_nego_gb_ciherang_index', [MasterSourchingController::class, 'data_sourching_nego_gb_ciherang_index'])->name('sourching.data_sourching_nego_gb_ciherang_index');
Route::get('/sourching/data_sourching_nego_gb_longgrain_index', [MasterSourchingController::class, 'data_sourching_nego_gb_longgrain_index'])->name('sourching.data_sourching_nego_gb_longgrain_index');
Route::get('/sourching/data_sourching_nego_gb_pandan_wangi_index', [MasterSourchingController::class, 'data_sourching_nego_gb_pandan_wangi_index'])->name('sourching.data_sourching_nego_gb_pandan_wangi_index');
Route::get('/sourching/data_sourching_nego_gb_ketan_putih_index', [MasterSourchingController::class, 'data_sourching_nego_gb_ketan_putih_index'])->name('sourching.data_sourching_nego_gb_ketan_putih_index');
Route::get('/sourching/data_sourching_nego_pk_index', [MasterSourchingController::class, 'data_sourching_nego_pk_index'])->name('sourching.data_sourching_nego_pk_index');

// Output Nego
Route::get('/sourching/data_sourching_output_nego', [MasterSourchingController::class, 'data_sourching_output_nego'])->name('sourching.data_sourching_output_nego');
Route::get('/sourching/data_sourching_output_nego_gb_index', [MasterSourchingController::class, 'data_sourching_output_nego_gb_index'])->name('sourching.data_sourching_output_nego_gb_index');
Route::get('/sourching/data_sourching_output_nego_pk_index', [MasterSourchingController::class, 'data_sourching_output_nego_pk_index'])->name('sourching.data_sourching_output_nego_pk_index');

// update status 
Route::get('/sourching/status_deal_gb/{id?}', [MasterSourchingController::class, 'status_deal_gb'])->name('sourching.status_deal_gb');
Route::get('/sourching/status_deal_pk/{id?}', [MasterSourchingController::class, 'status_deal_pk'])->name('sourching.status_deal_pk');
Route::get('/sourching/status_nego_gb/{id?}', [MasterSourchingController::class, 'status_nego_gb'])->name('sourching.status_nego_gb');
Route::get('/sourching/status_nego_pk/{id?}', [MasterSourchingController::class, 'status_nego_pk'])->name('sourching.status_nego_pk');

Route::get('/sourching/bid', [MasterSourchingController::class, 'bid'])->name('sourching.bid');
Route::get('/sourching/late_delivery', [MasterSourchingController::class, 'late_delivery'])->name('sourching.late_delivery');
Route::get('/sourching/perpanjang_po/{id?}', [MasterSourchingController::class, 'perpanjang_po'])->name('sourching.perpanjang_po');
Route::get('/sourching/vendor', [MasterSourchingController::class, 'vendor'])->name('sourching.vendor');
Route::get('/sourching/account', [MasterSourchingController::class, 'account'])->name('sourching.account');
Route::get('/sourching/news', [MasterSourchingController::class, 'news'])->name('sourching.news');
Route::get('/sourching/broadcast', [MasterSourchingController::class, 'broadcast'])->name('sourching.broadcast');
Route::get('/sourching/populer', [MasterSourchingController::class, 'populer'])->name('sourching.populer');
Route::get('/sourching/invoice', [MasterSourchingController::class, 'generateInvoicePDF'])->name('sourching.invoice');

Route::post('/sourching/download_data_sourching_deal_gb_excel', [MasterSourchingController::class, 'download_data_sourching_deal_gb_excel'])->name('sourching.download_data_sourching_deal_gb_excel');
Route::post('/sourching/download_data_sourching_deal_filter_gb_excel', [MasterSourchingController::class, 'download_data_sourching_deal_filter_gb_excel'])->name('sourching.download_data_sourching_deal_filter_gb_excel');
Route::post('/sourching/download_data_sourching_deal_pk_excel', [MasterSourchingController::class, 'download_data_sourching_deal_pk_excel'])->name('sourching.download_data_sourching_deal_pk_excel');
// LOG ACTIVITY SOURCHING
Route::get('/sourching/log_activity_sourching', [MasterSourchingController::class, 'log_activity_sourching'])->name('sourching.log_activity_sourching');
Route::get('/sourching/log_activity_sourching_index', [MasterSourchingController::class, 'log_activity_sourching_index'])->name('sourching.log_activity_sourching_index');

Route::get('/sourching/tagihan', [MasterSourchingController::class, 'tagihan'])->name('sourching.tagihan');
Route::get('/sourching/tagihan_index', [MasterSourchingController::class, 'tagihan_index'])->name('sourching.tagihan_index');
Route::get('/sourching/tagihan1_index', [MasterSourchingController::class, 'tagihan1_index'])->name('sourching.tagihan1_index');
Route::post('/sourching/upload_tagihan', [MasterSourchingController::class, 'upload_tagihan'])->name('sourching.upload_tagihan');
Route::post('/sourching/update_tagihan', [MasterSourchingController::class, 'update_tagihan'])->name('sourching.update_tagihan');
Route::get('/sourching/delete_tagihan/{id?}', [MasterSourchingController::class, 'delete_tagihan'])->name('sourching.delete_tagihan');

Route::get('/sourching/bid_gb_index', [MasterSourchingController::class, 'bid_gb_index'])->name('sourching.bid_gb_index');
Route::get('/sourching/bid_pk_index', [MasterSourchingController::class, 'bid_pk_index'])->name('sourching.bid_pk_index');
Route::get('/sourching/bid_ds_index', [MasterSourchingController::class, 'bid_ds_index'])->name('sourching.bid_ds_index');
Route::post('/sourching/bid_store', [MasterSourchingController::class, 'store'])->name('sourching.bid_store');
Route::get('/sourching/bid_show/{id?}', [MasterSourchingController::class, 'show'])->name('sourching.bid_show');
Route::post('/sourching/add_kuota', [MasterSourchingController::class, 'add_kuota'])->name('sourching.add_kuota');
Route::get('/sourching/delete_add_kuota/{id?}', [MasterSourchingController::class, 'delete_add_kuota'])->name('sourching.delete_add_kuota');
Route::post('/sourching/bid/update/{id?}', [MasterSourchingController::class, 'update'])->name('sourching.bid_update');
Route::get('/sourching/bid_destroy/{id_bid?}', [MasterSourchingController::class, 'destroy'])->name('sourching.bid_destroy');
Route::get('/sourching/bid_response/{id_bid?}', [MasterSourchingController::class, 'response'])->name('sourching.bid_response');
Route::get('/sourching/list_approve_po/{id_bid?}', [MasterSourchingController::class, 'list_approve_po'])->name('sourching.list_approve_po');
Route::get('/sourching/data_list_index/{id?}', [MasterSourchingController::class, 'data_list_index'])->name('sourching.data_list_index');
Route::get('/sourching/data_list_pk_index/{id?}', [MasterSourchingController::class, 'data_list_pk_index'])->name('sourching.data_list_pk_index');
Route::get('/sourching/data_list_ds_index/{id?}', [MasterSourchingController::class, 'data_list_ds_index'])->name('sourching.data_list_ds_index');
Route::get('/sourching/bid_status/{id_bid?}', [MasterSourchingController::class, 'bid_status'])->name('sourching.bid_status');
Route::get('/sourching/status_pending/{id?}', [MasterSourchingController::class, 'status_pending'])->name('sourching.status_pending');

Route::get('/sourching/response_index', [MasterSourchingController::class, 'response_index'])->name('sourching.response_index');
Route::get('/sourching/bid_user/{id?}', [MasterSourchingController::class, 'bid_user'])->name('sourching.bid_user');
Route::post('/sourching/approve_bid', [MasterSourchingController::class, 'approve_bid'])->name('sourching.approve_bid');

Route::post('/sourching/vendor_store', [MasterSourchingController::class, 'approve_store'])->name('sourching.approve_store');
Route::post('/sourching/vendor_store', [MasterSourchingController::class, 'vendor_store'])->name('sourching.vendor_store');
Route::get('/sourching/vendor_index', [MasterSourchingController::class, 'vendor_index'])->name('sourching.vendor_index');
Route::get('/sourching/vendor_destroy/{id?}', [MasterSourchingController::class, 'vendor_destroy'])->name('sourching.vendor_destroy');
Route::get('/sourching/vendor_show/{id?}', [MasterSourchingController::class, 'vendor_show'])->name('sourching.vendor_show');
Route::post('/sourching/vendor/update/{id?}', [MasterSourchingController::class, 'vendor_update'])->name('sourching.vendor_update');
Route::post('/sourching/vendor/vendor_update_npwp', [MasterSourchingController::class, 'vendor_update_npwp'])->name('sourching.vendor_update_npwp');
Route::post('/sourching/vendor/vendor_update_ktp/{id?}', [MasterSourchingController::class, 'vendor_update_ktp'])->name('sourching.vendor_update_ktp');
Route::post('/sourching/vendor/vendor_update_pembayaran/{id?}', [MasterSourchingController::class, 'vendor_update_pembayaran'])->name('sourching.vendor_update_pembayaran');
Route::post('/sourching/vendor/vendor_update_profil/{id?}', [MasterSourchingController::class, 'vendor_update_profil'])->name('sourching.vendor_update_profil');
Route::get('/sourching/vendor/status/{id?}', [MasterSourchingController::class, 'vendor_status'])->name('sourching.vendor_status');
Route::get('/sourching/vendor/detail/{id?}', [MasterSourchingController::class, 'vendor_detail'])->name('sourching.vendor_detail');

Route::post('/sourching/broadcast_store', [MasterSourchingController::class, 'broadcast_store'])->name('sourching.broadcast_store');
Route::get('/sourching/broadcast_index', [MasterSourchingController::class, 'broadcast_index'])->name('sourching.broadcast_index');
Route::post('/sourching/broadcast_update', [MasterSourchingController::class, 'broadcast_update'])->name('sourching.broadcast_update');
Route::get('/sourching/broadcast_destroy/{id?}', [MasterSourchingController::class, 'broadcast_destroy'])->name('sourching.broadcast_destroy');
Route::get('/sourching/broadcast_show/{id?}', [MasterSourchingController::class, 'broadcast_show'])->name('sourching.broadcast_show');
Route::get('/sourching/getkabupaten', [MasterSourchingController::class, 'getkabupaten'])->name('sourching.getkabupaten');
Route::get('/sourching/getkecamatan', [MasterSourchingController::class, 'getkecamatan'])->name('sourching.getkecamatan');
Route::get('/sourching/getdesa', [MasterSourchingController::class, 'getdesa'])->name('sourching.getdesa');
Route::get('/sourching/vendor/export_excel', [MasterSourchingController::class, 'vendor_export_excel'])->name('sourching.vendor_export_excel');
Route::post('/sourching/vendor_store', [MasterSourchingController::class, 'vendor_store'])->name('sourching.vendor_store');
Route::get('/sourching/vendor/export_excel', [MasterSourchingController::class, 'vendor_export_excel'])->name('sourching.vendor_export_excel');
Route::get('/sourching/vendor/export_pdf', [MasterSourchingController::class, 'vendor_export_pdf'])->name('sourching.vendor_export_pdf');
Route::get('/sourching/vendor/print', [MasterSourchingController::class, 'vendor_print'])->name('sourching.vendor_print');
Route::get('/sourching/vendor/export_csv', [MasterSourchingController::class, 'vendor_export_csv'])->name('sourching.vendor_export_csv');
Route::get('/sourching/vendor/vendor_print_form/{id?}', [MasterSourchingController::class, 'vendor_print_form'])->name('sourching.vendor_print_form');
Route::post('/sourching/download_data_pesanan_pemebelian_aol', [MasterSourchingController::class, 'download_data_pesanan_pemebelian_aol'])->name('sourching.download_data_pesanan_pemebelian_aol');
