<?php

namespace App\Exports;

use App\Models\PenerimaanPO;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\AdminTimbangan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;

class DataFakturPembelianAOL1 implements FromCollection, WithHeadings, WithEvents, WithTitle, WithCustomStartCell
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
            'PO Number',
            'Tanggal PO',
            'Tanggal Receipt',
            'Kode PO',
            'Vendor ID',
            'Nama Vendor',
            'Kode Barang',
            'Nama Barang',
            'Plat Kendaraan',
            'No. DTM',
            'Lokasi Bongkar',
            'Tonase Awal',
            'Tonase Akhir',
            'Hasil Tonase',
            'Harga Akhir',

        ];
    }
    public function title(): string
    {
        return "LAPORAN DATA FAKTUR PEMBELIAN (EPICOR) NGAWI";
    }
    public function startCell(): string
    {
        return 'A3';
    }
    public function collection()
    {
        if (($this->from_date && $this->to_date) == '') {
            return DB::table('data_po')
                ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                ->join('users', 'users.id', '=', 'data_po.user_idbid')
                ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                ->join('item', 'item.nama_item', '=', 'bid.name_bid')
                ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                ->where('penerimaan_po.status_penerimaan', 13)
                ->where('penerimaan_po.analisa', '=', 'verified')
                ->where('penerimaan_po.status_epicor', '1')
                ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                ->select('PONum', 'tanggal_po', 'tanggal_bongkar', 'kode_po', 'vendorid', 'nama_vendor', 'kode_item', 'name_bid', 'plat_kendaraan', 'dtm_gb', 'lokasi_bongkar_gb', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir_gb')
                ->limit(200)
                ->get();
        } else {
            return DB::table('data_po')
                ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                ->join('users', 'users.id', '=', 'data_po.user_idbid')
                ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                ->join('item', 'item.nama_item', '=', 'bid.name_bid')
                ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                ->whereBetween('data_po.tanggal_po', array($this->from_date, $this->to_date))
                ->where('penerimaan_po.status_penerimaan', 13)
                ->where('penerimaan_po.analisa', '=', 'verified')
                ->where('penerimaan_po.status_epicor', '1')
                ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                ->select('PONum', 'tanggal_po', 'tanggal_bongkar', 'kode_po', 'vendorid', 'nama_vendor', 'kode_item', 'name_bid', 'plat_kendaraan', 'dtm_gb', 'lokasi_bongkar_gb', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'harga_akhir_gb')
                ->get();
        }
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $event->sheet->setCellValue('E1', 'DATA FAKTUR PEMBELIAN (EPICOR) PT. SURYA PANGAN SEMESTA NGAWI');
                $event->sheet->getDelegate()->getStyle('A3:O3')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('99CCFF');
                $event->sheet
                    ->getDelegate()
                    ->getStyle('A3:AJ3')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
