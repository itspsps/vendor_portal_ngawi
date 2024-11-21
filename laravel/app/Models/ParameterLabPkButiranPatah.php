<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParameterLabPkButiranPatah extends Model
{
    protected $table = 'parameter_lab_pk_butiran_patah';
    protected $primaryKey = 'id_parameter_lab_pk_butiran_patah';
    public $timestamps = false;
    protected $guarded = ['id_parameter_lab_pk_butiran_patah', 'created_at'];
}