<?php

namespace App\Exports;

use App\Models\PenerimaanPO;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\AdminTimbangan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DataTimbanganExportExcel implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $from_date;
    protected $to_date;
    
    function __construct($from_date,$to_date) {
                $this->from_date = $from_date;
                $this->to_date = $to_date;
    }

    public function headings(): array
    {
        return [
            'No DTM',
            'UNIT',
            'NOPOL',
            'TGLMASUK',
            'JAMMASUK',
            'TGLKELUAR',
            'JAMKELUAR',
            'NmSuplier',
            'NmMaterial',
            'BRITO',
            'TARA',
            'NETTO',
            'RAF(kg)',
            'NETTO2',
            'OPERATOR',
            
        ];
    }

    public function collection()
    {
	    return DB::table('data_po')
        ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
        ->join('users', 'users.id', '=', 'data_po.user_idbid')
        ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
        ->join('admins_timbangan', 'admins_timbangan.id_admin_timbangan','=', 'penerimaan_po.penerima_tonase_awal')
        ->join('gabahincoming_qc','gabahincoming_qc.gabahincoming_kode_po','=','data_po.kode_po')
        ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar','=', 'data_po.kode_po')
        ->whereBetween('data_po.tanggal_po',[ $this->from_date,$this->to_date])
        ->where('data_qc_bongkar.status_bongkar', 'FINISH')
        ->where('penerimaan_po.tonase_akhir','!=', NULL)
        ->orderBy('id_penerimaan_po', 'desc')
        ->select('no_dtm','lokasi_bongkar1','plat_kendaraan','tanggal_masuk','jam_masuk','tanggal_keluar','jam_keluar','nama_vendor','name_bid','tonase_awal','tonase_akhir','hasil_akhir_tonase','rafraksi','netto2','name_admin_timbanagan')
        ->get();
	    
    }
}
