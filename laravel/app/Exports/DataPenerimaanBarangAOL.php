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

class DataPenerimaanBarangAOL implements FromCollection, WithHeadings, WithEvents, WithTitle, WithCustomStartCell
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
            'Kode Pemasok',
            'Nama Pemasok',
            'Tanggal PO',
            'Kode Mata Uang',
            'No Terima',
            'No Form',
            'Kode Barang',
            'Nama Barang',
            'Kuantitas',
            'Serial Number Prefix',
            'Serial Number Range Start',
            'Serial Number Kuantitas',
            'Satuan',
            'Departemen',
            'Projek',
            'Gudang',
            'No Pesanan Pembelian',
            'No Faktur Pembelian Dimuka',
            'Catatan',
            'Alamat Kirim',
            'Tgl Pengiriman',
            'Pengiriman',
            'Cabang'

        ];
    }
    public function title(): string
    {
        return "LAPORAN DATA PENERIMAAN BARANG NGAWI";
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
                ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                ->join('pemasok', 'pemasok.id_pemasok', '=', 'users.pemasok_id')
                ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
                ->where('penerimaan_po.tonase_akhir', '!=', NULL)
                ->orderBy('id_penerimaan_po', 'ASC')
                ->select('kode_pemasok', 'nama_pemasok', 'tanggal_po', 'kode_matauang_aol', 'no_dtm', 'form_tonase_akhir', 'kode_item_aol', 'nama_item_aol', 'hasil_akhir_tonase', 'diskon_persen_aol', 'diskon1_persen_aol', 'diskon_rp_aol', 'satuan_aol', 'departemen_aol', 'projek_aol', 'tempat_bongkar', 'kode_po', 'permintaan_barang_aol', 'catatan_aol',  'alamat_pemasok', 'tgl_pengiriman_aol', 'nopol', 'cabang_aol')
                ->get();
        } else {
            return DB::table('data_po')
                ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                ->join('users', 'users.id', '=', 'data_po.user_idbid')
                ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                ->join('item', 'item.nama_item', '=', 'bid.name_bid')
                ->join('pemasok', 'pemasok.id_pemasok', '=', 'users.pemasok_id')
                ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                ->whereBetween('data_po.tanggal_po', [$this->from_date, $this->to_date])
                ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
                ->where('penerimaan_po.tonase_akhir', '!=', NULL)
                ->orderBy('id_penerimaan_po', 'ASC')
                ->select('kode_pemasok', 'nama_pemasok', 'tanggal_po', 'kode_matauang_aol', 'no_dtm', 'form_tonase_akhir', 'kode_item_aol', 'nama_item_aol', 'hasil_akhir_tonase', 'diskon_persen_aol', 'diskon1_persen_aol', 'diskon_rp_aol', 'satuan_aol', 'departemen_aol', 'projek_aol', 'tempat_bongkar', 'kode_po', 'permintaan_barang_aol', 'catatan_aol',  'alamat_pemasok', 'tgl_pengiriman_aol', 'nopol', 'cabang_aol')
                ->get();
        }
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $event->sheet->setCellValue('E1', 'DATA PENERIMAAN BARANG PT. SURYA PANGAN SEMESTA NGAWI');
                $event->sheet->getDelegate()->getStyle('A3:F3')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('99CCFF');
                $event->sheet->getDelegate()->getStyle('G3:S3')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFFF00');
                $event->sheet->getDelegate()->getStyle('T3:W3')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('00CC00');
                $event->sheet
                    ->getDelegate()
                    ->getStyle('A3:AG3')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
