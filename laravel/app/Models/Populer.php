<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Populer extends Model
{
    protected $table = 'populer';
    protected $primaryKey = 'id_populer';
    public $timestamps = false;
    protected $fillable = ['judul_populer', 'gambar_populer', 'waktu_populer','keterangan_populer','status_populer'];
}
