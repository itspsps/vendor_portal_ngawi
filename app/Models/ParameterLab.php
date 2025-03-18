<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParameterLab extends Model
{
    protected $table = 'parameter_lab';
    protected $primaryKey = 'id_parameter';
    public $timestamps = false;
    protected $guarded = ['id_parameter', 'created_at'];
}