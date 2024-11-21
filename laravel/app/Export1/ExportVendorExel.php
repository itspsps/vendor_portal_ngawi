<?php

namespace App\Export;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportVendorExel implements FromCollection,WithHeadings
{

    public function collection()
    {
        return collect(User::getVendor());
    }
}
