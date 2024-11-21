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

class DataOnProsesLab2ExportExcelPK implements FromCollection, WithHeadings, WithEvents, WithTitle, WithCustomStartCell
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
            'Status',
            'Tanggal',
            'Jam',
            'No.Kendaraan',
            'Supplier',
            'Tempat Asal Gabah',
            'DTM KS',
            'Tonase KS',
            'KA KS',
            'KA KG',
            'Berat Sample Awal KS',
            'Berat Sample Awal KG',
            'Berat Sample Akhir KG',
            'Berat Sample Akhir PK',
            'Berat Beras',
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
            '(%) KG-PK',
            'Adjust (%) KG-PK (0,952)',
            '(%) KS-PK',
            '(%) Putih',
            'Adjust (%) KG ke Putih (0,952)',
            'Plan Rend KS-Beras',
            'Katul',
            'Plan Berat KG /Truk',
            'Plan Berat PK /Truk',
            'Plan Berat Beras/Truk',
            'Rafraksi Broken (Rp.)',
            'Plan Harga Gabah (Rp/Kg)',
            'Plan Harga Beli Gabah',
            'Harga Berdasarkan (Tempat)',
            'Harga Berdasarkan (Harga Atas)',
            'Plan Harga Gabah + Ongkos Driyer',
            'Plan Harga PK (Rp/KG)',
            'Plan Harga Beras (Rp/KG)',
            'Plan Total Harga Gabah (Rp/Truk)',
            'Plan Total Harga PK (Rp/Truk)',
            'Plan Total Harga Beras (Rp/Truk)',
            'Plan HPP Aktual',
            'Harga Awal',
            'Aksi Harga',
            'Reaksi + Harga',
            'Harga Akhir(Rp/KG)',
            'STD HPP Aktual',
            'STD HPP Incoming',
            'Surveyor',
            'Keterangan',
            'Waktu',
            'Tempat',
            'Z yang Di Bawa',
            'Z Yang Di Tolak',

        ];
    }
    public function title(): string
    {
        return "LAPORAN KUALITAS PEMBELIAN GABAH";
    }
    public function collection()
    {
        if (($this->from_date && $this->to_date) == '') {
            return DB::table('data_po')
                ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                ->join('users', 'users.id', '=', 'data_po.user_idbid')
                ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                ->join('gabahfinishing_qc', 'gabahfinishing_qc.gabahincoming_kode_po', '=', 'data_po.kode_po')
                ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                ->where('gabahfinishing_qc.aksi_harga', 'ON PROCESS')
                ->orderBy('id_gabahfinishing_qc', 'DESC')
                ->select('name_bid', 'lokasi_bongkar', 'tanggal_po', 'jam_masuk', 'plat_kendaraan', 'nama_vendor', 'keterangan_penerimaan_po', 'no_dtm', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'randoman', 'wh', 'tp', 'md', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'plan_harga_gabah_ongkos_dryer', 'plan_harga_pk_perkilo', 'plan_harga_beras_perkilo', 'plan_total_harga_gabah_pertruk', 'plan_total_harga_pk_pertruk', 'plan_total_harga_beras_pertruk', 'plan_hpp_aktual', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir', 'plan_hpp_aktual as hpp1', 'plan_hpp_aktual as hpp2', 'surveyor', 'keterangan', 'waktu', 'tempat', 'gabahfinishing_qc.z_yang_dibawa', 'gabahfinishing_qc.z_yang_ditolak')
                ->get();
        } else {
            return DB::table('data_po')
                ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                ->join('users', 'users.id', '=', 'data_po.user_idbid')
                ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                ->join('gabahfinishing_qc', 'gabahfinishing_qc.gabahincoming_kode_po', '=', 'data_po.kode_po')
                ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                ->whereBetween('data_po.tanggal_po', [$this->from_date, $this->to_date])
                ->where('gabahfinishing_qc.aksi_harga', 'ON PROCESS')
                ->orderBy('id_gabahfinishing_qc', 'DESC')
                ->select('name_bid', 'lokasi_bongkar', 'tanggal_po', 'jam_masuk', 'plat_kendaraan', 'nama_vendor', 'keterangan_penerimaan_po', 'no_dtm', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'randoman', 'wh', 'tp', 'md', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'plan_harga_gabah_ongkos_dryer', 'plan_harga_pk_perkilo', 'plan_harga_beras_perkilo', 'plan_total_harga_gabah_pertruk', 'plan_total_harga_pk_pertruk', 'plan_total_harga_beras_pertruk', 'plan_hpp_aktual', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir', 'plan_hpp_aktual as hpp1', 'plan_hpp_aktual as hpp2', 'surveyor', 'keterangan', 'waktu', 'tempat', 'gabahfinishing_qc.z_yang_dibawa', 'gabahfinishing_qc.z_yang_ditolak')
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
                        ->join('gabahfinishing_qc', 'gabahfinishing_qc.gabahincoming_kode_po', '=', 'data_po.kode_po')
                        ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                        ->where('gabahfinishing_qc.aksi_harga', 'ON PROCESS')
                        ->orderBy('id_gabahfinishing_qc', 'DESC')
                        ->select('name_bid', 'lokasi_bongkar', 'tanggal_po', 'jam_masuk', 'plat_kendaraan', 'nama_vendor', 'keterangan_penerimaan_po', 'no_dtm', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'randoman', 'wh', 'tp', 'md', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'plan_harga_gabah_ongkos_dryer', 'plan_harga_pk_perkilo', 'plan_harga_beras_perkilo', 'plan_total_harga_gabah_pertruk', 'plan_total_harga_pk_pertruk', 'plan_total_harga_beras_pertruk', 'plan_hpp_aktual', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir', 'plan_hpp_aktual as hpp1', 'plan_hpp_aktual as hpp2', 'surveyor', 'keterangan', 'waktu', 'tempat', 'gabahfinishing_qc.z_yang_dibawa', 'gabahfinishing_qc.z_yang_ditolak')
                        ->count();
                } else {
                    $query = DB::table('data_po')
                        ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                        ->join('users', 'users.id', '=', 'data_po.user_idbid')
                        ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                        ->join('gabahfinishing_qc', 'gabahfinishing_qc.gabahincoming_kode_po', '=', 'data_po.kode_po')
                        ->join('data_qc_bongkar', 'data_qc_bongkar.kode_po_bongkar', '=', 'data_po.kode_po')
                        ->whereBetween('data_po.tanggal_po', [$this->from_date, $this->to_date])
                        ->where('gabahfinishing_qc.aksi_harga', 'ON PROCESS')
                        ->orderBy('id_gabahfinishing_qc', 'DESC')
                        ->select('name_bid', 'lokasi_bongkar', 'tanggal_po', 'jam_masuk', 'plat_kendaraan', 'nama_vendor', 'keterangan_penerimaan_po', 'no_dtm', 'hasil_akhir_tonase', 'kadar_air', 'ka_kg', 'berat_sample_awal_ks', 'berat_sample_awal_kg', 'berat_sample_akhir_kg', 'berat_sample_pk', 'randoman', 'wh', 'tp', 'md', 'md', 'broken', 'hampa', 'kg_after_adjust_hampa', 'prosentasi_kg', 'susut', 'adjust_susut', 'prsentase_ks_kg_after_adjust_susut', 'prsentase_kg_pk', 'adjust_prosentase_kg_pk', 'presentase_ks_pk', 'presentase_putih', 'adjust_prosentase_kg_ke_putih', 'plan_rend_dari_ks_beras', 'katul', 'plan_berat_kg_pertruk', 'plan_berat_pk_pertruk', 'plan_berat_beras_pertruk', 'refraksi_broken', 'plan_harga_gabah', 'plan_harga_beli_gabah', 'harga_berdasarkan_tempat', 'harga_berdasarkan_harga_atas', 'plan_harga_gabah_ongkos_dryer', 'plan_harga_pk_perkilo', 'plan_harga_beras_perkilo', 'plan_total_harga_gabah_pertruk', 'plan_total_harga_pk_pertruk', 'plan_total_harga_beras_pertruk', 'plan_hpp_aktual', 'harga_awal', 'aksi_harga', 'reaksi_harga', 'harga_akhir', 'plan_hpp_aktual as hpp1', 'plan_hpp_aktual as hpp2', 'surveyor', 'keterangan', 'waktu', 'tempat', 'gabahfinishing_qc.z_yang_dibawa', 'gabahfinishing_qc.z_yang_ditolak')
                        ->count();
                }
                $data1 = $query + 4;
                $event->sheet->getDelegate()->getStyle('T4:T' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('41C0DA');
                $event->sheet->getDelegate()->getStyle('U4:AJ' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFCCCC');
                $event->sheet->getDelegate()->getStyle('AK4:AK' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFCC00');
                $event->sheet->getDelegate()->getStyle('AL4:AL' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('41C0DA');
                $event->sheet->getDelegate()->getStyle('AM4:AR' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFCC00');
                $event->sheet->getDelegate()->getStyle('AS4:AU' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('CC0000');
                $event->sheet->getDelegate()->getStyle('AV4:AY' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('009900');
                $event->sheet->getDelegate()->getStyle('AZ4:BA' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('41C0DA');
                $event->sheet->getDelegate()->getStyle('BB4:BB' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFEFF6');
                $event->sheet->getDelegate()->getStyle('BC4:BC' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('DEFBFF');
                $event->sheet->getDelegate()->getStyle('BD4:BG' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FF9933');
                $event->sheet
                    ->getDelegate()
                    ->getStyle('A4:BG1')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->setCellValue('T1', 'LAPORAN KUALITAS PEMBELIAN GABAH CV. SUMBER PANGAN');
                // $event->sheet->setCellValue('T1','SECURITY CLASSIFICATION - UNCLASSIFIED [Generator: Admin]');

            },
        ];
    }
}
