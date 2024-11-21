<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanHppBerasDs extends Model
{
    protected $table = 'plan_hpp_beras_ds';
    protected $primaryKey = 'id_plan_hpp_ds';
    public $timestamps = false;
    protected $guarded = ['id_plan_hpp_ds'];

}
