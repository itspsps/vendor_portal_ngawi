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

class DataFakturPembelianAOL implements FromCollection, WithHeadings, WithEvents, WithTitle, WithCustomStartCell
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
            'Kurs',
            'No Form',
            'No Faktur',
            'Diskon Persen',
            'Diskon Rp',
            'Kode Barang',
            'Nama Barang',
            'Kuantitas',
            'Serial Number Prefix',
            'Serial Number Range Start',
            'Serial Number Kuantitas',
            'Satuan',
            'Harga',
            'Diskon Persen',
            'Diskon Rp',
            'Total_Harga',
            'Departemen',
            'Projek',
            'Gudang',
            'No Pesanan Pembelian',
            'No Penerimaan Barang',
            'Catatan',
            'Alamat Kirim',
            'Kena Pajak',
            'Total Termasuk Pajak',
            'Kode Dokumen',
            'Kode Transaksi',
            'Tgl Faktur Pajak',
            'No Faktur Pajak',
            'Tgl Pengiriman',
            'Pengiriman',
            'Cabang'

        ];
    }
    public function title(): string
    {
        return "LAPORAN DATA FAKTUR PEMBELIAN NGAWI";
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
                ->join('pemasok', 'pemasok.id_pemasok', '=', 'users.pemasok_id')
                ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                ->where('penerimaan_po.status_penerimaan', 13)
                ->where('penerimaan_po.analisa', '=', 'verified')
                ->where('penerimaan_po.status_epicor', '1')
                ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                ->select('kode_pemasok', 'nama_pemasok', 'tanggal_po', 'kode_matauang_aol', 'kurs_aol', 'no_form_aol', 'no_faktur_aol', 'diskon_persen_aol', 'diskon_rp_aol', 'kode_item_aol', 'nama_item_aol', 'hasil_akhir_tonase', 'serial_num_prefix_aol', 'serial_num_range_aol', 'serial_num_kuantitas_aol', 'satuan_aol', 'harga_akhir_gb', 'diskon1_persen_aol', 'diskon1_rp_aol', 'total_harga_aol', 'departemen_aol', 'projek_aol', 'gudang_aol', 'kode_po', 'form_tonase_akhir', 'catatan_aol',  'alamat_pemasok', 'kena_pajak_aol', 'total_termasuk_pajak_aol', 'kode_dokumen_aol', 'kode_transaksi_aol', 'tgl_faktur_pajak_aol', 'no_faktur_pajak_aol', 'tgl_pengiriman_aol', 'nopol', 'cabang_aol')
                ->get();
        } else {
            return DB::table('data_po')
                ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                ->join('users', 'users.id', '=', 'data_po.user_idbid')
                ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                ->join('item', 'item.nama_item', '=', 'bid.name_bid')
                ->join('pemasok', 'pemasok.id_pemasok', '=', 'users.pemasok_id')
                ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                ->whereBetween('data_po.tanggal_po', [$this->from_date, $this->to_date])
                ->where('penerimaan_po.status_penerimaan', 13)
                ->where('penerimaan_po.analisa', '=', 'verified')
                ->where('penerimaan_po.status_epicor', '1')
                ->where('lab2_gb.aksi_harga_gb', 'DEAL')
                ->select('kode_pemasok', 'nama_pemasok', 'tanggal_po', 'kode_matauang_aol', 'kurs_aol', 'no_form_aol', 'no_faktur_aol', 'diskon_persen_aol', 'diskon_rp_aol', 'kode_item_aol', 'nama_item_aol', 'hasil_akhir_tonase', 'serial_num_prefix_aol', 'serial_num_range_aol', 'serial_num_kuantitas_aol', 'satuan_aol', 'harga_akhir_gb', 'diskon1_persen_aol', 'diskon1_rp_aol', 'total_harga_aol', 'departemen_aol', 'projek_aol', 'gudang_aol', 'kode_po', 'form_tonase_akhir', 'catatan_aol',  'alamat_pemasok', 'kena_pajak_aol', 'total_termasuk_pajak_aol', 'kode_dokumen_aol', 'kode_transaksi_aol', 'tgl_faktur_pajak_aol', 'no_faktur_pajak_aol', 'tgl_pengiriman_aol', 'nopol', 'cabang_aol')
                ->get();
        }
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $event->sheet->setCellValue('E1', 'DATA FAKTUR PEMBELIAN PT. SURYA PANGAN SEMESTA NGAWI');
                $event->sheet->getDelegate()->getStyle('A3:I3')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('99CCFF');
                $event->sheet->getDelegate()->getStyle('J3:Z3')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFFF00');
                $event->sheet->getDelegate()->getStyle('AA3:AJ3')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('00CC00');
                $event->sheet
                    ->getDelegate()
                    ->getStyle('A3:AJ3')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
