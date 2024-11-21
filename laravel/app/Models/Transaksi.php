<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $timestamps = false;
    protected $fillable = ['id_transaksi', 'id_vendor_transaksi', 'id_bid_transaksi', 'id_bid_user', 'final_hargagabah','final_jumlahgabah','pembayaran','status_transaksi'];
}
