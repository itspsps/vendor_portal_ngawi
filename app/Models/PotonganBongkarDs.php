<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PotonganBongkarDs extends Model
{
    protected $table = 'potongan_bongkar_gt_04_beras_ds';
    protected $primaryKey = 'id_potongan_bongkar_gt_04_ds';
    public $timestamps = false;
    protected $guarded = ['id_potongan_bongkar_gt_04_ds'];
    protected $fillable = ['potongan_bongkar_gt_04_ds','transparasi_ds' ,'waktu_potongan_bongkar_gt_04_ds'];

}
