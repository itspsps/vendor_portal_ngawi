<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanHppGabahBasah extends Model
{
    protected $table = 'plan_hpp_gabah_basah';
    protected $primaryKey = 'id_plan_hpp_gb';
    public $timestamps = false;
    protected $guarded = ['id_plan_hpp_gb'];

}
