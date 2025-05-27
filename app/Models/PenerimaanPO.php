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

    public function DataPO()
    {
        return $this->hasOne(DataPO::class, 'id_data_po', 'penerimaan_id_data_po');
    }
    public function DataBongkar()
    {
        return $this->hasOne(DataQcBongkar::class, 'kode_po_bongkar', 'penerimaan_kode_po');
    }
    public function Lab2()
    {
        return $this->hasOne(Lab2GabahBasah::class, 'lab2_kode_po_gb', 'penerimaan_kode_po');
    }
}
