<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParameterLabPkRewardTr extends Model
{
    protected $table = 'parameter_lab_pk_reward_tr';
    protected $primaryKey = 'id_parameter_lab_pk_reward_tr';
    public $timestamps = false;
    protected $guarded = ['id_parameter_lab_pk_reward_tr', 'created_at'];
}