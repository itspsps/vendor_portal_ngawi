<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParameterLabPkKualitas extends Model
{
    protected $table = 'parameter_lab_pk_kualitas';
    protected $primaryKey = 'id_parameter_lab_pk_kualitas';
    public $timestamps = false;
    protected $guarded = ['id_parameter_lab_pk_kualitas', 'created_at'];
}