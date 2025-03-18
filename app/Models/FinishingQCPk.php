<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinishingQCPk extends Model
{
    protected $table = 'lab2_pk';
    protected $primaryKey = 'id_lab2_pk';
    public $timestamps = false;
    protected $guarded = ['id_lab2_pk'];

}
