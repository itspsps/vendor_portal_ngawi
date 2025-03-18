<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'id_news';
    public $timestamps = false;
    protected $fillable = ['judul_berita', 'gambar', 'isi_berita','waktu','status'];
}
