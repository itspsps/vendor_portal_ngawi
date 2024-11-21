<?php

namespace App\Exports;

use App\Models\PenerimaanPO;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\AdminTimbangan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DataSouchingDealPKExcel implements FromCollection,WithHeadings,WithEvents,WithTitle,WithCustomStartCell
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
            'Lokasi Bongkar',
            'Nomor Kendaraan',
            'Nama Vendor',
            'Kode PO',
            'DTM',
            'Tonase',
            'Harga Awal',
            'Aksi Harga',
            'Harga Akhir'
            
        ];
    }
    public function title(): string
	{
		return "LAPORAN PEMBELIAN GABAH";
	}
    public function collection()
    {
        if(($this->from_date && $this->to_date)==''){
	    return DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('gabahfinishing_qc', 'gabahfinishing_qc.gabahincoming_kode_po', '=', 'data_po.kode_po')
                    ->where('gabahfinishing_qc.aksi_harga', 'DEAL')
                    ->where('bid.lokasi', "KEDIRI")
                    ->orderBy('id_gabahfinishing_qc', 'ASC')
                    ->select('lokasi_bongkar', 'plat_kendaraan', 'nama_vendor', 'kode_po', 'dtm', 'hasil_akhir_tonase', 'harga_awal', 'aksi_harga', 'harga_akhir')
                    ->get();
        }else{
	    return DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('gabahfinishing_qc', 'gabahfinishing_qc.gabahincoming_kode_po', '=', 'data_po.kode_po')
                    ->whereBetween('gabahfinishing_qc.created_at', array($this->from_date, $this->to_date))
                    ->where('gabahfinishing_qc.aksi_harga', 'DEAL')
                    ->where('bid.lokasi', "KEDIRI")
                    ->orderBy('id_gabahfinishing_qc', 'ASC')
                    ->select('lokasi_bongkar', 'plat_kendaraan', 'nama_vendor', 'kode_po', 'dtm', 'hasil_akhir_tonase', 'harga_awal', 'aksi_harga', 'harga_akhir')
                    ->get();
            
        }
	    
    }
     public function startCell(): string
    {
        return 'A4';
    }
     public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
        if(($this->from_date && $this->to_date)==''){
	     $query=DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('gabahfinishing_qc', 'gabahfinishing_qc.gabahincoming_kode_po', '=', 'data_po.kode_po')
                    ->where('gabahfinishing_qc.aksi_harga', 'DEAL')
                    ->where('bid.lokasi', "KEDIRI")
                    ->orderBy('id_gabahfinishing_qc', 'ASC')
                    ->select('lokasi_bongkar', 'plat_kendaraan', 'nama_vendor', 'kode_po', 'dtm', 'hasil_akhir_tonase', 'harga_awal', 'aksi_harga', 'harga_akhir')
                    ->count();
        } else{
	    $query= DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                    ->join('gabahfinishing_qc', 'gabahfinishing_qc.gabahincoming_kode_po', '=', 'data_po.kode_po')
                    ->where('gabahfinishing_qc.aksi_harga', 'DEAL')
                    ->where('bid.lokasi', "KEDIRI")
                    ->whereBetween('gabahfinishing_qc.created_at', array($this->from_date, $this->to_date))
                    ->orderBy('id_gabahfinishing_qc', 'ASC')
                    ->select('lokasi_bongkar', 'plat_kendaraan', 'nama_vendor', 'kode_po', 'dtm', 'hasil_akhir_tonase', 'harga_awal', 'aksi_harga', 'harga_akhir')
                    ->count();
        }
        $data1 =$query+4;
  $event->sheet->getDelegate()->getStyle('A4:I4')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('99CCFF');
  
                $event->sheet
                        ->getDelegate()
                        ->getStyle('A4:AG4')
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
               
                        $event->sheet->setCellValue('D1','LAPORAN PEMBELIAN GABAH CV. SUMBER PANGAN');
               
            },
        ];
    }
}
