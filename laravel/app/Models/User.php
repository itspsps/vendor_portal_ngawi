<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';
    protected $fillable = [
        'vendorid',
        'name',
        'sps_alias_c',
        'address1',
        'address2',
        'address3',
        'city',
        'state',
        'zip',
        'taxpayerID',
        'SPS_NameNPWP_c',
        'SPS_AlamatNPWP_c',
        'SPS_ActiveDate_c',
        'SPS_InactiveDate_c',
        'faxnum',
        'SPS_phonenum_c',
        'emailaddress',
        'shipviacode',
        'taxregioncode',
        'GroupCode',
        'BankAcctNumber',
        'BankName',
        'BankBranchCode',
        'SPS_niksupplier_c',

        'id_desaktp',
        'id_kecamatanktp',
        'id_kabupatenktp',
        'id_provinsiktp',
        'id_desanpwp',
        'id_kecamatannpwp',
        'id_kabupatennpwp',
        'id_provinsinpwp',
        'nama_vendor',
        'email',
        'nama_npwp',
        'npwp',
        'rt_npwp',
        'rw_npwp',
        'nama_bank',
        'nomer_rekening',
        'nama_penerima_bank',
        'cabang_bank',
        'nama_ktp',
        'ktp',
        'rt_ktp',
        'rw_ktp',
        'nomer_hp',
        'password',
        'gambar_user',
        'password_show',
        'username',
        'gambar_npwp',
        'keterangan_alamat_npwp',
        'keterangan_alamat_ktp',
        'fis',
        'gambar_ktp',
        'pakta_integritas',
        'status_user',
        'is_email_verified'
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getVendor()
    {
        $record = DB::table('users')->select('id', 'nama_vendor')->get()->toArray();
        return $record;
    }
}
