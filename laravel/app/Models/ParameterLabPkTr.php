<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParameterLabPkTr extends Model
{
    protected $table = 'parameter_lab_pk_tr';
    protected $primaryKey = 'id_parameter_lab_pk_tr';
    public $timestamps = false;
    protected $guarded = ['id_parameter_lab_pk_tr', 'created_at'];
}