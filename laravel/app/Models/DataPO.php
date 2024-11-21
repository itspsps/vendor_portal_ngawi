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
    protected $guarded = ['id_data_po '];

    // public function penerimaan_po():BelongsTo
    // {
    //     return $this->belongsTo(PenerimaanPO::class,'penerimaan_id_data_po');
    // }
    // public function user():BelongsTo
    // {
    //     return $this->belongsTo(User::class,'user_idbid', 'id');
    // }
}
