<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParameterLabPkHampa extends Model
{
    protected $table = 'parameter_lab_pk_hampa';
    protected $primaryKey = 'id_parameter_lab_pk_hampa';
    public $timestamps = false;
    protected $guarded = ['id_parameter_lab_pk_hampa', 'created_at'];
}