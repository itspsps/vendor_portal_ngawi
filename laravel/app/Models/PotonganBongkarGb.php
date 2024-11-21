<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PotonganBongkarGb extends Model
{
    protected $table = 'potongan_bongkar_gt_04_gabah_basah';
    protected $primaryKey = 'id_potongan_bongkar_gt_04_gb';
    public $timestamps = false;
    protected $guarded = ['id_potongan_bongkar_gt_04_gb'];
    protected $fillable = ['potongan_bongkar_gt_04_gb','transparasi_gb' ,'waktu_potongan_bongkar_gt_04_gb'];

}
