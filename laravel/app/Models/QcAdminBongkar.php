<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class QcAdminBongkar extends Authenticatable
{
    use HasFactory,Notifiable;

    protected $table = 'admins_qc_bongkar';
    protected $primaryKey = 'id_qc_bongkar';
    protected $fillable = [
        'name_qc_bongkar',
        'site_qc_qc_bongkar',
        'phone_qc_qc_bongkar',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
