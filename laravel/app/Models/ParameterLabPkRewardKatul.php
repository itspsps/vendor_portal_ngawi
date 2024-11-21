<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParameterLabPkRewardKatul extends Model
{
    protected $table = 'parameter_lab_pk_reward_katul';
    protected $primaryKey = 'id_parameter_lab_pk_reward_katul';
    public $timestamps = false;
    protected $guarded = ['id_parameter_lab_pk_reward_katul', 'created_at'];
}