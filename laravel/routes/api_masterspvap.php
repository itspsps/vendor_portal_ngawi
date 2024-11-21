<?php

use App\Http\Controllers\AdminMaster\MasterSpvApController;
use Illuminate\Support\Facades\Route;

Route::get('/data_pembelian_show/{id?}', [MasterSpvApController::class, 'data_pembelian_show'])->name('data_pembelian_show');
        Route::get('/notapprove_revisi/{id?}', [MasterSpvApController::class, 'notapprove_revisi'])->name('notapprove_revisi');
        Route::get('/approve_revisi/{id?}', [MasterSpvApController::class, 'approve_revisi'])->name('approve_revisi');
        Route::get('/revisi_data_pk', [MasterSpvApController::class, 'revisi_data_pk'])->name('revisi_data_pk');
        Route::get('/revisi_data_pk_index', [MasterSpvApController::class, 'revisi_data_pk_index'])->name('revisi_data_pk_index');
        Route::get('/revisi_data_gb', [MasterSpvApController::class, 'revisi_data_gb'])->name('revisi_data_gb');
        Route::get('/revisi_data_gb_index', [MasterSpvApController::class, 'revisi_data_gb_index'])->name('revisi_data_gb_index');
        Route::get('/integrasi_epicor_gb', [MasterSpvApController::class, 'integrasi_epicor_gb'])->name('integrasi_epicor_gb');
        Route::get('/integrasi_epicor_gb_index', [MasterSpvApController::class, 'integrasi_epicor_gb_index'])->name('integrasi_epicor_gb_index');
        Route::get('/integrasi_epicor_gb1_index', [MasterSpvApController::class, 'integrasi_epicor_gb1_index'])->name('integrasi_epicor_gb1_index');
        Route::get('/integrasi_epicor_pk', [MasterSpvApController::class, 'integrasi_epicor_pk'])->name('integrasi_epicor_pk');
        Route::get('/integrasi_epicor_pk_index', [MasterSpvApController::class, 'integrasi_epicor_pk_index'])->name('integrasi_epicor_pk_index');
        Route::get('/integrasi_epicor_pk1_index', [MasterSpvApController::class, 'integrasi_epicor_pk1_index'])->name('integrasi_epicor_pk1_index');
        Route::get('/kirim_epicor_pk/{id?}', [MasterSpvApController::class, 'kirim_epicor_pk'])->name('kirim_epicor_pk');
        Route::get('/approve_receipt/{id?}', [MasterSpvApController::class, 'approve_receipt'])->name('approve_receipt');
        Route::get('/not_approve_receipt/{id?}', [MasterSpvApController::class, 'not_approve_receipt'])->name('not_approve_receipt');
        Route::get('/approve_receipt_pk/{id?}', [MasterSpvApController::class, 'approve_receipt_pk'])->name('approve_receipt_pk');
        Route::get('/not_approve_receipt_pk/{id?}', [MasterSpvApController::class, 'not_approve_receipt_pk'])->name('not_approve_receipt_pk');
        Route::get('/kirim_epicor_gb/{id?}', [MasterSpvApController::class, 'kirim_epicor_gb'])->name('kirim_epicor_gb');
        Route::get('/kirim_epicor_pk/{id?}', [MasterSpvApController::class, 'kirim_epicor_pk'])->name('kirim_epicor_pk');
        Route::get('/kirim_epicor_gb_all', [MasterSpvApController::class, 'kirim_epicor_gb_all'])->name('kirim_epicor_gb_all');
        Route::get('/kirim_epicor_pk_all', [MasterSpvApController::class, 'kirim_epicor_pk_all'])->name('kirim_epicor_pk_all');

        // LOG ACTIVITY SPV AP
        Route::get('/log_activity_spvap', [MasterSpvApController::class, 'log_activity_spvap'])->name('log_activity_spvap');
        Route::get('/log_activity_spvap_index', [MasterSpvApController::class, 'log_activity_spvap_index'])->name('log_activity_spvap_index');

        // Notif SPV AP
        Route::get('/get_notifrevisispvap', [MasterSpvApController::class, 'get_notifrevisispvap'])->name('get_notifrevisispvap');
        Route::get('/get_notifapprovespvap', [MasterSpvApController::class, 'get_notifapprovespvap'])->name('get_notifapprovespvap');
