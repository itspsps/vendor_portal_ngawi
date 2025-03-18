<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PotonganBongkarGk extends Model
{
    protected $table = 'potongan_bongkar_gt_04_gabah_kering';
    protected $primaryKey = 'id_potongan_bongkar_gt_04_gk';
    public $timestamps = false;
    protected $guarded = ['id_potongan_bongkar_gt_04_gk'];
    protected $fillable = ['potongan_bongkar_gt_04_gk','transparasi_gk' ,'waktu_potongan_bongkar_gt_04_gk'];

}
