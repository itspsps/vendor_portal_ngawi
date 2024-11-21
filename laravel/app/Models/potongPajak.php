<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class potongPajak extends Model
{
    protected $table = 'potong_pajak';
    protected $primaryKey = 'id_potong_pajak';
    public $timestamps = false;
    protected $guarded = ['id_potong_pajak '];
}
