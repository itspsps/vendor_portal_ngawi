<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trackerPO extends Model
{
    protected $table = 'tracker_po';
    protected $primaryKey = 'id_tracker_po';
    public $timestamps = false;
    protected $guarded = ['id_tracker_po '];
}
