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

class DataBongkarLab1ExportExcel implements FromCollection, WithHeadings, WithEvents, WithTitle, WithCustomStartCell
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
            'Tanggal',
            'Jam',
            'No.Kendaraan',
            'Supplier',
            'Tempat Asal Gabah',
            'KA KS',
            'KA KG',
            'Berat Sample Awal KS',
            'Berat Sample Awal KG',
            'Berat Sample Akhir KG',
            'Berat Sample Akhir PK',
            'Berat Sample Beras',
            'WH',
            'TP',
            'MD',
            'Broken Setelah Bongkar',
            'Hampa (%)',
            'KG After Adjust Hampa',
            '(%) KG',
            '(%) Susut',
            'Adjust (%) Susut 1.2',
            '(%) KS-KG After Adjust Susut',
            '(%) se KG-PK',
            'Adjust (%) KG-PK (0,952)',
            '(%) KS-PK',
            '(%) Putih',
            'Adjust (%) KG ke Putih (0,952)',
            'Plan Rend KS-Beras',
            'Katul',
            'Refraksi Broken (Rp)',
            'Plan Harga Gabah (Rp/Kg)',
            'Plan Harga Beli Gabah'

        ];
    }
    public function title(): string
    {
        return "LAPORAN SOURCHING DEAL GABAH BASAH SITE NGAWI";
    }
    public function collection()
    {
        if (($this->from_date && $this->to_date) == '') {
            return DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                ->join('users', 'users.id', '=', 'data_po.user_idbid')
                ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
                ->where('lab1_gb.output_lab_gb', '=', 'Unload')
                ->orderBy('lab1_gb.id_lab1_gb', 'asc')
                ->select('name_bid', 'tanggal_po', 'jam_masuk', 'plat_kendaraan', 'nama_vendor', 'keterangan_penerimaan_po', 'kadar_air_gb', 'ka_kg_gb', 'berat_sample_awal_ks_gb', 'berat_sample_awal_kg_gb', 'berat_sample_akhir_kg_gb', 'berat_sample_pk_gb', 'randoman_gb', 'wh_gb', 'tp_gb', 'md_gb', 'broken_gb', 'hampa_gb', 'kg_after_adjust_hampa_gb', 'prosentasi_kg_gb', 'susut_gb', 'adjust_susut_gb', 'prsentase_ks_kg_after_adjust_susut_gb', 'prsentase_kg_pk_gb', 'adjust_prosentase_kg_pk_gb', 'presentase_ks_pk_gb', 'presentase_putih_gb', 'adjust_prosentase_kg_ke_putih_gb', 'plan_rend_dari_ks_beras_gb', 'katul_gb', 'refraksi_broken_gb', 'plan_harga_gb', 'plan_harga_gabah_gb')
                ->get();
        } else {
            return DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                ->join('users', 'users.id', '=', 'data_po.user_idbid')
                ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
                ->whereBetween('data_po.tanggal_po', [$this->from_date, $this->to_date])
                ->where('lab1_gb.output_lab_gb', '=', 'Unload')
                ->orderBy('lab1_gb.id_lab1_gb', 'asc')
                ->select('name_bid', 'tanggal_po', 'jam_masuk', 'plat_kendaraan', 'nama_vendor', 'keterangan_penerimaan_po', 'kadar_air_gb', 'ka_kg_gb', 'berat_sample_awal_ks_gb', 'berat_sample_awal_kg_gb', 'berat_sample_akhir_kg_gb', 'berat_sample_pk_gb', 'randoman_gb', 'wh_gb', 'tp_gb', 'md_gb', 'broken_gb', 'hampa_gb', 'kg_after_adjust_hampa_gb', 'prosentasi_kg_gb', 'susut_gb', 'adjust_susut_gb', 'prsentase_ks_kg_after_adjust_susut_gb', 'prsentase_kg_pk_gb', 'adjust_prosentase_kg_pk_gb', 'presentase_ks_pk_gb', 'presentase_putih_gb', 'adjust_prosentase_kg_ke_putih_gb', 'plan_rend_dari_ks_beras_gb', 'katul_gb', 'refraksi_broken_gb', 'plan_harga_gb', 'plan_harga_gabah_gb')
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
                    $query = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                        ->join('users', 'users.id', '=', 'data_po.user_idbid')
                        ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                        ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                        ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
                        ->where('lab1_gb.output_lab_gb', '=', 'Unload')
                        ->orderBy('lab1_gb.id_lab1_gb', 'asc')
                        ->select('name_bid', 'tanggal_po', 'jam_masuk', 'plat_kendaraan', 'nama_vendor', 'keterangan_penerimaan_po', 'kadar_air_gb', 'ka_kg_gb', 'berat_sample_awal_ks_gb', 'berat_sample_awal_kg_gb', 'berat_sample_akhir_kg_gb', 'berat_sample_pk_gb', 'randoman_gb', 'wh_gb', 'tp_gb', 'md_gb', 'broken_gb', 'hampa_gb', 'kg_after_adjust_hampa_gb', 'prosentasi_kg_gb', 'susut_gb', 'adjust_susut_gb', 'prsentase_ks_kg_after_adjust_susut_gb', 'prsentase_kg_pk_gb', 'adjust_prosentase_kg_pk_gb', 'presentase_ks_pk_gb', 'presentase_putih_gb', 'adjust_prosentase_kg_ke_putih_gb', 'plan_rend_dari_ks_beras_gb', 'katul_gb', 'refraksi_broken_gb', 'plan_harga_gb', 'plan_harga_gabah_gb')
                        ->count();
                } else {
                    $query = DB::table('data_po')->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                        ->join('users', 'users.id', '=', 'data_po.user_idbid')
                        ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                        ->join('admins', 'admins.id', '=', 'penerimaan_po.penerima_po')
                        ->join('lab1_gb', 'lab1_gb.lab1_id_data_po_gb', '=', 'data_po.id_data_po')
                        ->whereBetween('data_po.tanggal_po', [$this->from_date, $this->to_date])
                        ->where('lab1_gb.output_lab_gb', '=', 'Unload')
                        ->orderBy('lab1_gb.id_lab1_gb', 'asc')
                        ->select('name_bid', 'tanggal_po', 'jam_masuk', 'plat_kendaraan', 'nama_vendor', 'keterangan_penerimaan_po', 'kadar_air_gb', 'ka_kg_gb', 'berat_sample_awal_ks_gb', 'berat_sample_awal_kg_gb', 'berat_sample_akhir_kg_gb', 'berat_sample_pk_gb', 'randoman_gb', 'wh_gb', 'tp_gb', 'md_gb', 'broken_gb', 'hampa_gb', 'kg_after_adjust_hampa_gb', 'prosentasi_kg_gb', 'susut_gb', 'adjust_susut_gb', 'prsentase_ks_kg_after_adjust_susut_gb', 'prsentase_kg_pk_gb', 'adjust_prosentase_kg_pk_gb', 'presentase_ks_pk_gb', 'presentase_putih_gb', 'adjust_prosentase_kg_ke_putih_gb', 'plan_rend_dari_ks_beras_gb', 'katul_gb', 'refraksi_broken_gb', 'plan_harga_gb', 'plan_harga_gabah_gb')
                        ->count();
                }
                $data1 = $query + 4;
                $event->sheet->getDelegate()->getStyle('R4:R' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('66B2FF');
                $event->sheet->getDelegate()->getStyle('S4:AF' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('99CCFF');
                $event->sheet->getDelegate()->getStyle('AG4:AG' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('3399FF');

                $event->sheet
                    ->getDelegate()
                    ->getStyle('A4:AG4')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->setCellValue('P1', 'LAPORAN BONGKAR PEMBELIAN GABAH PT SURYA PANGAN SEMESTA NGAWI');
                // $event->sheet->setCellValue('T1','SECURITY CLASSIFICATION - UNCLASSIFIED [Generator: Admin]');

            },
        ];
    }
}
