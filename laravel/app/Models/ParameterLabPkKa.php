<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParameterLabPkKa extends Model
{
    protected $table = 'parameter_lab_pk_ka';
    protected $primaryKey = 'id_parameter_lab_pk_ka';
    public $timestamps = false;
    protected $guarded = ['id_parameter_lab_pk_ka', 'created_at'];
}