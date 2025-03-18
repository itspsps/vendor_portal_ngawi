<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataPO extends Model
{
    // use HasFactory, HasUuids;
    protected $table = 'data_po';
    protected $primaryKey = 'id_data_po';
    public $timestamps = false;
    protected $fillable = [
        'id_data_po',
        'id_approvebid',
        'bid_user_id',
        'user_idbid',
        'bid_id',
        'status_bid',
        'permintaan_kirim',
        'permintaan_ditolak',
        'kode_po',
        'nopol',
        'tanggal_po',
        'tanggal_bongkar',
        'batas_penerimaan_po',
        'message_admin',
        'message_vendor',
        'kategory_po',
        'PONum',
        'keterangan_po_close',
        'date_close_po',
        'kode_po_aol',
        'kode_matauang_aol',
        'kurs_aol',
        'no_form_aol',
        'no_faktur_aol',
        'diskon_persen_aol',
        'diskon_rp_aol',
        'kuantitas_aol',
        'serial_num_prefix_aol',
        'serial_num_range_aol',
        'serial_num_kuantitas_aol',
        'satuan_aol',
        'harga_aol',
        'diskon1_persen_aol',
        'diskon1_rp_aol',
        'total_harga_aol',
        'departemen_aol',
        'projek_aol',
        'gudang_aol',
        'permintaan_barang_aol',
        'catatan_aol',
        'kena_pajak_aol',
        'total_termasuk_pajak_aol',
        'kode_dokumen_aol',
        'kode_transaksi_aol',
        'tgl_faktur_pajak_aol',
        'no_faktur_pajak_aol',
        'tgl_pengiriman_aol',
        'pengiriman_aol',
        'cabang_aol'
    ];
    // public function penerimaan_po():BelongsTo
    // {
    //     return $this->belongsTo(PenerimaanPO::class,'penerimaan_id_data_po');
    // }
    // public function user():BelongsTo
    // {
    //     return $this->belongsTo(User::class,'user_idbid', 'id');
    // }
}
