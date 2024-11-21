<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataQcBongkar extends Model
{
    protected $table = 'data_qc_bongkar';
    protected $primaryKey = 'id_data_qc_bongkar';
    public $timestamps = false;
    protected $guarded = ['id_data_qc_bongkar'];
    protected $fillable = ['kode_po_bongkar', 'surveyor_bongkar', 'keterangan_bongkar', 'waktu_bongkar', 'tempat_bongkar', 'z_yang_dibawa', 'z_yang_ditolak', 'status_bongkar', 'created_at_bongkar'];
}
