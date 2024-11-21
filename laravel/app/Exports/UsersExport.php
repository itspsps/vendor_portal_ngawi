<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            '#',
            'Vendor ID',
            'Nama Vendor',
            'Nama NPWP',
            'Nomer NPWP',
            'Nama KTP',
            'Nomer KTP',
            'Nama Bank',
            'Nomer Rekening',
            'Nama Penerima',
            'Cabang Bank',
            'Nomer HP',
            'Email',
            'Created At',
        ];
    }

    public function collection()
    {
        return User::select('id', 'vendorid', 'nama_vendor', 'nama_npwp', 'npwp', 'nama_ktp', 'ktp', 'nama_bank', 'nomer_rekening', 'nama_penerima_bank', 'cabang_bank', 'nomer_hp', 'email', 'created_at')->get();
    }
}
