<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanHppPecahKulit extends Model
{
    protected $table = 'plan_hpp_pecah_kulit';
    protected $primaryKey = 'id_plan_hpp_pk';
    public $timestamps = false;
    protected $guarded = ['id_plan_hpp_pk'];

}
