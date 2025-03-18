<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParameterLabPkKatul extends Model
{
    protected $table = 'parameter_lab_pk_katul';
    protected $primaryKey = 'id_parameter_lab_pk_katul';
    public $timestamps = false;
    protected $guarded = ['id_parameter_lab_pk_katul', 'created_at'];
}