<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
    protected $table = 'broadcast';
    protected $primaryKey = 'id_broadcast';
    public $timestamps = false;
    protected $guarded = ['id_broadcast'];
}
