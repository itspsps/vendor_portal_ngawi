<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParameterLabPkRewardHampa extends Model
{
    protected $table = 'parameter_lab_pk_reward_hampa';
    protected $primaryKey = 'id_parameter_lab_pk_reward_hampa';
    public $timestamps = false;
    protected $guarded = ['id_parameter_lab_pk_reward_hampa', 'created_at'];
}