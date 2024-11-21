<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanHppGabahKering extends Model
{
    protected $table = 'plan_hpp_gabah_kering';
    protected $primaryKey = 'id_plan_hpp_gk';
    public $timestamps = false;
    protected $guarded = ['id_plan_hpp_gk'];

}
