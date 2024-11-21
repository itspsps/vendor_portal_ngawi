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

class DataSouchingDealGBExcel implements FromCollection, WithHeadings, WithEvents, WithTitle, WithCustomStartCell
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $from_date;
    protected $to_date;

    function __construct($from_date, $to_date)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function headings(): array
    {
        return [
            'Nama Item',
            'Lokasi Bongkar',
            'Nomor Kendaraan',
            'Nama Vendor',
            'Tanggal PO',
            'Kode PO',
            'dtm_gb',
            'Tonase',
            'Harga Awal',
            'Aksi Harga',
            'Harga Akhir',
            'Keterangan Harga'

        ];
    }
    public function title(): string
    {
        return "LAPORAN SOURCHING DEAL GABAH BASAH SITE NGAWI";
    }
    public function collection()
    {
        if (($this->from_date && $this->to_date) == '') {
            return DB::table('data_po')
                ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                ->join('users', 'users.id', '=', 'data_po.user_idbid')
                ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                ->orderBy('id_lab2_gb', 'ASC')
                ->select('name_bid', 'lokasi_bongkar_gb', 'plat_kendaraan', 'nama_vendor', 'tanggal_po', 'kode_po', 'dtm_gb', 'hasil_akhir_tonase', 'harga_awal_gb', 'aksi_harga_gb', 'harga_akhir_gb', 'keterangan_harga_akhir_gb')
                ->get();
        } else {
            return DB::table('data_po')
                ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                ->join('users', 'users.id', '=', 'data_po.user_idbid')
                ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                ->whereBetween('data_po.tanggal_po', array($this->from_date, $this->to_date))
                ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                ->orderBy('id_lab2_gb', 'ASC')
                ->select('name_bid', 'lokasi_bongkar_gb', 'plat_kendaraan', 'nama_vendor', 'tanggal_po', 'kode_po', 'dtm_gb', 'hasil_akhir_tonase', 'harga_awal_gb', 'aksi_harga_gb', 'harga_akhir_gb', 'keterangan_harga_akhir_gb')
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
            AfterSheet::class    => function (AfterSheet $event) {
                if (($this->from_date && $this->to_date) == '') {
                    $query = DB::table('data_po')
                        ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                        ->join('users', 'users.id', '=', 'data_po.user_idbid')
                        ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                        ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                        ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                        ->orderBy('id_lab2_gb', 'ASC')
                        ->select('name_bid', 'lokasi_bongkar_gb', 'plat_kendaraan', 'nama_vendor', 'tanggal_po', 'kode_po', 'dtm_gb', 'hasil_akhir_tonase', 'harga_awal_gb', 'aksi_harga_gb', 'harga_akhir_gb', 'keterangan_harga_akhir_gb')
                        ->count();
                } else {
                    $query = DB::table('data_po')
                        ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                        ->join('users', 'users.id', '=', 'data_po.user_idbid')
                        ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                        ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                        ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                        ->whereBetween('data_po.tanggal_po', array($this->from_date, $this->to_date))
                        ->orderBy('id_lab2_gb', 'ASC')
                        ->select('name_bid', 'lokasi_bongkar_gb', 'plat_kendaraan', 'nama_vendor', 'tanggal_po', 'kode_po', 'dtm_gb', 'hasil_akhir_tonase', 'harga_awal_gb', 'aksi_harga_gb', 'harga_akhir_gb', 'keterangan_harga_akhir_gb')
                        ->count();
                }
                $data1 = $query + 4;
                $event->sheet->getDelegate()->getStyle('A4:M4')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('99CCFF');

                $event->sheet
                    ->getDelegate()
                    ->getStyle('A4:AG4')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->setCellValue('D1', 'LAPORAN PEMBELIAN GABAH PT. SURYA PANGAN SEMESTA SITE NGAWI');
            },
        ];
    }
}
