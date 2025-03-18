<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenerimaanPO extends Model
{
    // use HasFactory, HasUuids;
    protected $table = 'penerimaan_po';
    protected $primaryKey = 'id_penerimaan_po';
    public $timestamps = false;
    protected $guarded = ['id_penerimaan_po '];

//     public function data_po()
//     {
//         return $this->hasOne(DataPO::class,'id_data_po');
//     }
}
