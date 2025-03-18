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

class DataPenerimaanBarangExportExcel implements FromCollection, WithHeadings
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
            'KODE PO',
            'TANGGAL PO',
            'NO DTM',
            'NOPOL',
            'TGLMASUK',
            'JAMMASUK',
            'TGLKELUAR',
            'JAMKELUAR',
            'NmSuplier',
            'NmMaterial',
            'BRUTO',
            'TARA',
            'NETTO',
            'RAF(kg)',
            'NETTO2',
            'OPERATOR',

        ];
    }
    public function title(): string
    {
        return "LAPORAN DATA TIMBANGAN NGAWI";
    }
    public function startCell(): string
    {
        return 'A4';
    }
    public function collection()
    {
        if (($this->from_date && $this->to_date) == '') {
            return DB::table('data_po')
                ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                ->join('users', 'users.id', '=', 'data_po.user_idbid')
                ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                ->join('admins_timbangan', 'admins_timbangan.id_admin_timbangan', '=', 'penerimaan_po.penerima_tonase_awal')
                ->where('data_qc_bongkar.status_bongkar', 'FINISH')
                ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
                ->where('penerimaan_po.tonase_akhir', '!=', NULL)
                ->orderBy('id_penerimaan_po', 'ASC')
                ->select('kode_po', 'tanggal_po', 'no_dtm', 'plat_kendaraan', 'tanggal_masuk', 'jam_masuk', 'tanggal_keluar', 'jam_keluar', 'nama_vendor', 'name_bid', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'rafraksi', 'netto2', 'name_admin_timbangan')
                ->get();
        } else {
            return DB::table('data_po')
                ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                ->join('users', 'users.id', '=', 'data_po.user_idbid')
                ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                ->join('admins_timbangan', 'admins_timbangan.id_admin_timbangan', '=', 'penerimaan_po.penerima_tonase_awal')
                ->whereBetween('data_po.tanggal_po', array($this->from_date, $this->to_date))
                ->where('data_qc_bongkar.status_bongkar', 'FINISH')
                ->where('bid.name_bid', '=', 'GABAH BASAH LONG GRAIN')
                ->where('penerimaan_po.tonase_akhir', '!=', NULL)
                ->orderBy('id_penerimaan_po', 'ASC')
                ->select('kode_po', 'tanggal_po', 'no_dtm', 'plat_kendaraan', 'tanggal_masuk', 'jam_masuk', 'tanggal_keluar', 'jam_keluar', 'nama_vendor', 'name_bid', 'tonase_awal', 'tonase_akhir', 'hasil_akhir_tonase', 'rafraksi', 'netto2', 'name_admin_timbangan')
                ->get();
        }
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $event->sheet->setCellValue('E1', 'LAPORAN DATA TIMBANGAN PT. SURYA PANGAN SEMESTA NGAWI');
            },
        ];
    }
}
