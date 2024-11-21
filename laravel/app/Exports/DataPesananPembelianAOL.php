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

class DataPesananPembelianAOL implements FromCollection, WithHeadings, WithEvents, WithTitle, WithCustomStartCell
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // protected $from_date;
    // protected $to_date;
    protected $id_bid;

    function __construct($id_bid)
    {
        // $this->from_date = $from_date;
        // $this->to_date = $to_date;
        $this->id_bid = $id_bid;
    }

    public function headings(): array
    {
        return [
            'Kode Pemasok',
            'Nama Pemasok',
            'Tanggal PO',
            'Kode Mata Uang',
            'Kurs',
            'No PO',
            'Diskon Faktur %',
            'Diskon Faktur Rp',
            'Kode Barang',
            'Nama Barang',
            'Kuantitas',
            'Satuan',
            'Harga',
            'Diskon %',
            'Diskon Rp',
            'Total Harga',
            'Departemen',
            'Projek',
            'No Permintaan',
            'Catatan',
            'Alamat Kirim',
            'Kena Pajak',
            'Total Termasuk Pajak',
            'Tgl Pengiriman',
            'Pengiriman',
            'Cabang'

        ];
    }
    public function title(): string
    {
        return "LAPORAN SOURCHING DEAL GABAH BASAH SITE NGAWI";
    }
    public function collection()
    {
        // if (($this->from_date && $this->to_date) == '') {
        return DB::table('data_po')
            ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
            ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
            ->join('users', 'users.id', '=', 'data_po.user_idbid')
            ->join('item', 'bid.name_bid', '=', 'item.nama_item')
            ->join('pemasok', 'users.pemasok_id', '=', 'pemasok.id_pemasok')
            ->where('data_po.bid_id', $this->id_bid)
            ->select('kode_pemasok', 'nama_pemasok', 'tanggal_po', 'kode_matauang_aol', 'kurs_aol', 'kode_po_aol', 'diskon_persen_aol', 'diskon_rp_aol', 'kode_item_aol', 'nama_item_aol', 'kuantitas_aol', 'satuan_aol', 'harga_aol', 'diskon1_persen_aol', 'diskon1_rp_aol', 'total_harga_aol', 'departemen_aol', 'projek_aol', 'permintaan_barang_aol', 'catatan_aol', 'alamat_pemasok', 'kena_pajak_aol', 'total_termasuk_pajak_aol', 'tgl_pengiriman_aol', 'pengiriman_aol', 'cabang_aol')
            ->get();
        // } else {
        //     return DB::table('data_po')
        //         ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
        //         ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
        //         ->join('users', 'users.id', '=', 'data_po.user_idbid')
        //         ->where('data_po.bid_id', $this->id_bid)
        //         ->whereBetween('data_po.tanggal_po', array($this->from_date, $this->to_date))
        //         ->orderBy('id_data_po', 'ASC')
        //         ->select('name_bid', 'lokasi_bongkar_gb', 'plat_kendaraan', 'nama_vendor', 'tanggal_po', 'kode_po', 'dtm_gb', 'hasil_akhir_tonase', 'harga_awal_gb', 'aksi_harga_gb', 'harga_akhir_gb', 'keterangan_harga_akhir_gb')
        //         ->get();
        // }
    }
    public function startCell(): string
    {
        return 'A3';
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $query = DB::table('data_po')
                    ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                    ->join('bid_user', 'bid_user.id_biduser', '=', 'data_po.bid_user_id')
                    ->join('users', 'users.id', '=', 'data_po.user_idbid')
                    ->join('item', 'bid.name_bid', '=', 'item.nama_item')
                    ->join('pemasok', 'users.pemasok_id', '=', 'pemasok.id_pemasok')
                    ->where('data_po.bid_id', $this->id_bid)
                    ->select('kode_pemasok', 'nama_pemasok', 'tanggal_po', 'kode_matauang_aol', 'kurs_aol', 'kode_po_aol', 'diskon_persen_aol', 'diskon_rp_aol', 'kode_item_aol', 'nama_item_aol', 'kuantitas_aol', 'satuan_aol', 'harga_aol', 'diskon1_persen_aol', 'diskon1_rp_aol', 'total_harga_aol', 'departemen_aol', 'projek_aol', 'permintaan_barang_aol', 'catatan_aol', 'alamat_pemasok', 'kena_pajak_aol', 'total_termasuk_pajak_aol', 'tgl_pengiriman_aol', 'pengiriman_aol', 'cabang_aol')
                    ->count();
                $data1 = $query + 4;
                $event->sheet->getDelegate()->getStyle('A3:H3')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('99CCFF');
                $event->sheet->getDelegate()->getStyle('I3:T3')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFFF00');
                $event->sheet->getDelegate()->getStyle('U3:Z3')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('00CC00');

                $event->sheet
                    ->getDelegate()
                    ->getStyle('A3:AG3')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->setCellValue('D1', 'LAPORAN PEMBELIAN GABAH PT. SURYA PANGAN SEMESTA SITE NGAWI');
            },
        ];
    }
}
