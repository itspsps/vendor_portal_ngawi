<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab2GabahBasah extends Model
{
    protected $table = 'lab2_gb';
    protected $primaryKey = 'id_lab2_gb';
    public $timestamps = false;
    protected $guarded = ['id_lab2_gb '];

    public function DataPO()
    {
        return $this->hasOne(DataPO::class, 'kode_po', 'lab2_kode_po_gb');
    }
    public function PenerimaanPo()
    {
        return $this->hasOne(PenerimaanPO::class, 'penerimaan_kode_po', 'lab2_kode_po_gb');
    }
}
