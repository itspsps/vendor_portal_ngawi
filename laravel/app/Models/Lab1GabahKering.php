<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GabahIncomingQC extends Model
{
    protected $table = 'gabahincoming_qc';
    protected $primaryKey = 'id_gabahincoming_qc';
    public $timestamps = false;
    protected $guarded = ['id_gabahincoming_qc '];
    // protected $fillable = [
    //     'gabahincoming_id_penerimaan_po',
    //     'gabahincoming_id_data_po',
    //     'gabahincoming_id_bid_user',
    //     'gabahincoming_kode_po',
    //     'gabahincoming_plat',
    //     'beras_hitam',
    //     'beras_kusam',
    //     'biji_mati',
    //     'semu',
    //     'kuning',
    //     'mletik_semu',
    //     'gabah_hitam',
    //     'gabah_sungutan',
    //     'gabah_kopong',
    //     'aroma_gabah',
    //     'kotoran_gabah',
    //     'hampa',
    //     'broken',
    //     'randoman',
    //     'kadar_air',
    //     'status_gabahincoming_qc',
    //     'nomor_antrian',
    //     'plan_harga',
    // ];

}
