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

class OutputDataLab2ExportExcel implements FromCollection, WithHeadings, WithEvents, WithTitle, WithCustomStartCell
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
            'Aktual price ongkos driyer',
            'Plan harga aktual pertruk',
            'Plan HPP aktual ',
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
                ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                ->orderBy('penerimaan_po.id_penerimaan_po', 'ASC')
                ->select('name_bid', 'lokasi_bongkar_gb', 'tanggal_po', 'jam_masuk', 'plat_kendaraan', 'nama_vendor', 'keterangan_penerimaan_po', 'dtm_gb', 'hasil_akhir_tonase', 'kadar_air_gb', 'ka_kg_gb', 'berat_sample_awal_ks_gb', 'berat_sample_awal_kg_gb', 'berat_sample_akhir_kg_gb', 'berat_sample_pk_gb', 'randoman_gb', 'wh_gb', 'tp_gb', 'md_gb', 'broken_gb', 'hampa_gb', 'kg_after_adjust_hampa_gb', 'prosentasi_kg_gb', 'susut_gb', 'adjust_susut_gb', 'prsentase_ks_kg_after_adjust_susut_gb', 'prsentase_kg_pk_gb', 'adjust_prosentase_kg_pk_gb', 'presentase_ks_pk_gb', 'presentase_putih_gb', 'adjust_prosentase_kg_ke_putih_gb', 'plan_rend_dari_ks_beras_gb', 'katul_gb', 'plan_berat_kg_pertruk_gb', 'plan_berat_pk_pertruk_gb', 'plan_berat_beras_pertruk_gb', 'refraksi_broken_gb', 'plan_harga_gabah_gb', 'plan_harga_beli_gabah_gb', 'harga_berdasarkan_tempat_gb', 'harga_berdasarkan_harga_atas_gb', 'plan_harga_gabah_ongkos_dryer_gb', 'plan_harga_pk_perkilo_gb', 'plan_harga_beras_perkilo_gb', 'plan_total_harga_gabah_pertruk_gb', 'plan_total_harga_pk_pertruk_gb', 'plan_total_harga_beras_pertruk_gb', 'plan_hpp_aktual_gb', 'harga_awal_gb', 'aksi_harga_gb', 'reaksi_harga_gb', 'harga_akhir_gb', 'aktual_price_ongkos_driyer_gb', 'plan_harga_aktual_pertruk_gb', 'plan_hpp_aktual1_gb', 'plan_hpp_aktual_gb as hpp1', 'plan_hpp_aktual_gb as hpp2', 'surveyor_gb', 'keterangan_gb', 'waktu_gb', 'tempat_gb', 'lab2_gb.z_yang_dibawa_gb', 'lab2_gb.z_yang_ditolak_gb')
                ->get();
        } else {
            return DB::table('data_po')
                ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                ->join('users', 'users.id', '=', 'data_po.user_idbid')
                ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                ->whereBetween('data_po.tanggal_po', [$this->from_date, $this->to_date])
                ->orderBy('penerimaan_po.id_penerimaan_po', 'ASC')
                ->select('name_bid', 'lokasi_bongkar_gb', 'tanggal_po', 'jam_masuk', 'plat_kendaraan', 'nama_vendor', 'keterangan_penerimaan_po', 'dtm_gb', 'hasil_akhir_tonase', 'kadar_air_gb', 'ka_kg_gb', 'berat_sample_awal_ks_gb', 'berat_sample_awal_kg_gb', 'berat_sample_akhir_kg_gb', 'berat_sample_pk_gb', 'randoman_gb', 'wh_gb', 'tp_gb', 'md_gb', 'broken_gb', 'hampa_gb', 'kg_after_adjust_hampa_gb', 'prosentasi_kg_gb', 'susut_gb', 'adjust_susut_gb', 'prsentase_ks_kg_after_adjust_susut_gb', 'prsentase_kg_pk_gb', 'adjust_prosentase_kg_pk_gb', 'presentase_ks_pk_gb', 'presentase_putih_gb', 'adjust_prosentase_kg_ke_putih_gb', 'plan_rend_dari_ks_beras_gb', 'katul_gb', 'plan_berat_kg_pertruk_gb', 'plan_berat_pk_pertruk_gb', 'plan_berat_beras_pertruk_gb', 'refraksi_broken_gb', 'plan_harga_gabah_gb', 'plan_harga_beli_gabah_gb', 'harga_berdasarkan_tempat_gb', 'harga_berdasarkan_harga_atas_gb', 'plan_harga_gabah_ongkos_dryer_gb', 'plan_harga_pk_perkilo_gb', 'plan_harga_beras_perkilo_gb', 'plan_total_harga_gabah_pertruk_gb', 'plan_total_harga_pk_pertruk_gb', 'plan_total_harga_beras_pertruk_gb', 'plan_hpp_aktual_gb', 'harga_awal_gb', 'aksi_harga_gb', 'reaksi_harga_gb', 'harga_akhir_gb', 'aktual_price_ongkos_driyer_gb', 'plan_harga_aktual_pertruk_gb', 'plan_hpp_aktual1_gb', 'plan_hpp_aktual_gb as hpp1', 'plan_hpp_aktual_gb as hpp2', 'surveyor_gb', 'keterangan_gb', 'waktu_gb', 'tempat_gb', 'lab2_gb.z_yang_dibawa_gb', 'lab2_gb.z_yang_ditolak_gb')
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
                        ->orderBy('penerimaan_po.id_penerimaan_po', 'ASC')
                        ->select('name_bid', 'lokasi_bongkar_gb', 'tanggal_po', 'jam_masuk', 'plat_kendaraan', 'nama_vendor', 'keterangan_penerimaan_po', 'dtm_gb', 'hasil_akhir_tonase', 'kadar_air_gb', 'ka_kg_gb', 'berat_sample_awal_ks_gb', 'berat_sample_awal_kg_gb', 'berat_sample_akhir_kg_gb', 'berat_sample_pk_gb', 'randoman_gb', 'wh_gb', 'tp_gb', 'md_gb', 'broken_gb', 'hampa_gb', 'kg_after_adjust_hampa_gb', 'prosentasi_kg_gb', 'susut_gb', 'adjust_susut_gb', 'prsentase_ks_kg_after_adjust_susut_gb', 'prsentase_kg_pk_gb', 'adjust_prosentase_kg_pk_gb', 'presentase_ks_pk_gb', 'presentase_putih_gb', 'adjust_prosentase_kg_ke_putih_gb', 'plan_rend_dari_ks_beras_gb', 'katul_gb', 'plan_berat_kg_pertruk_gb', 'plan_berat_pk_pertruk_gb', 'plan_berat_beras_pertruk_gb', 'refraksi_broken_gb', 'plan_harga_gabah_gb', 'plan_harga_beli_gabah_gb', 'harga_berdasarkan_tempat_gb', 'harga_berdasarkan_harga_atas_gb', 'plan_harga_gabah_ongkos_dryer_gb', 'plan_harga_pk_perkilo_gb', 'plan_harga_beras_perkilo_gb', 'plan_total_harga_gabah_pertruk_gb', 'plan_total_harga_pk_pertruk_gb', 'plan_total_harga_beras_pertruk_gb', 'plan_hpp_aktual_gb', 'harga_awal_gb', 'aksi_harga_gb', 'reaksi_harga_gb', 'harga_akhir_gb', 'aktual_price_ongkos_driyer_gb', 'plan_harga_aktual_pertruk_gb', 'plan_hpp_aktual1_gb', 'plan_hpp_aktual_gb as hpp1', 'plan_hpp_aktual_gb as hpp2', 'surveyor_gb', 'keterangan_gb', 'waktu_gb', 'tempat_gb', 'lab2_gb.z_yang_dibawa_gb', 'lab2_gb.z_yang_ditolak_gb')
                        ->count();
                } else {
                    $query = DB::table('data_po')
                        ->join('bid', 'bid.id_bid', '=', 'data_po.bid_id')
                        ->join('users', 'users.id', '=', 'data_po.user_idbid')
                        ->join('penerimaan_po', 'penerimaan_po.penerimaan_id_data_po', '=', 'data_po.id_data_po')
                        ->join('lab2_gb', 'lab2_gb.lab2_kode_po_gb', '=', 'data_po.kode_po')
                        ->whereBetween('data_po.tanggal_po', [$this->from_date, $this->to_date])
                        ->orderBy('penerimaan_po.id_penerimaan_po', 'ASC')
                        ->select('name_bid', 'lokasi_bongkar_gb', 'tanggal_po', 'jam_masuk', 'plat_kendaraan', 'nama_vendor', 'keterangan_penerimaan_po', 'dtm_gb', 'hasil_akhir_tonase', 'kadar_air_gb', 'ka_kg_gb', 'berat_sample_awal_ks_gb', 'berat_sample_awal_kg_gb', 'berat_sample_akhir_kg_gb', 'berat_sample_pk_gb', 'randoman_gb', 'wh_gb', 'tp_gb', 'md_gb', 'broken_gb', 'hampa_gb', 'kg_after_adjust_hampa_gb', 'prosentasi_kg_gb', 'susut_gb', 'adjust_susut_gb', 'prsentase_ks_kg_after_adjust_susut_gb', 'prsentase_kg_pk_gb', 'adjust_prosentase_kg_pk_gb', 'presentase_ks_pk_gb', 'presentase_putih_gb', 'adjust_prosentase_kg_ke_putih_gb', 'plan_rend_dari_ks_beras_gb', 'katul_gb', 'plan_berat_kg_pertruk_gb', 'plan_berat_pk_pertruk_gb', 'plan_berat_beras_pertruk_gb', 'refraksi_broken_gb', 'plan_harga_gabah_gb', 'plan_harga_beli_gabah_gb', 'harga_berdasarkan_tempat_gb', 'harga_berdasarkan_harga_atas_gb', 'plan_harga_gabah_ongkos_dryer_gb', 'plan_harga_pk_perkilo_gb', 'plan_harga_beras_perkilo_gb', 'plan_total_harga_gabah_pertruk_gb', 'plan_total_harga_pk_pertruk_gb', 'plan_total_harga_beras_pertruk_gb', 'plan_hpp_aktual_gb', 'harga_awal_gb', 'aksi_harga_gb', 'reaksi_harga_gb', 'harga_akhir_gb', 'plan_hpp_aktual_gb as hpp1', 'plan_hpp_aktual_gb as hpp2', 'surveyor_gb', 'keterangan_gb', 'waktu_gb', 'tempat_gb', 'lab2_gb.z_yang_dibawa_gb', 'lab2_gb.z_yang_ditolak_gb')
                        ->count();
                }
                $data1 = $query + 4;
                $event->sheet->getDelegate()->getStyle('U4:U' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('41C0DA');
                $event->sheet->getDelegate()->getStyle('V4:AK' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFCCCC');
                $event->sheet->getDelegate()->getStyle('AL4:AL' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFCC00');
                $event->sheet->getDelegate()->getStyle('AM4:AM' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('41C0DA');
                $event->sheet->getDelegate()->getStyle('AN4:AS' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFCC00');
                $event->sheet->getDelegate()->getStyle('AT4:AV' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('CC0000');
                $event->sheet->getDelegate()->getStyle('BA4:BC' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('00CC00');
                $event->sheet->getDelegate()->getStyle('BD4:BE' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('41C0DA');
                $event->sheet->getDelegate()->getStyle('BF4:BF' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFEFF6');
                $event->sheet->getDelegate()->getStyle('BG4:BG' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('DEFBFF');
                $event->sheet->getDelegate()->getStyle('BH4:BK' . $data1)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FF9933');
                $event->sheet
                    ->getDelegate()
                    ->getStyle('A4:BG1')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->setCellValue('T1', 'LAPORAN KUALITAS LAB 2 PEMBELIAN GABAH PT. SURYA PANGAN SEMESTA NGAWI');
                // $event->sheet->setCellValue('T1','SECURITY CLASSIFICATION - UNCLASSIFIED [Generator: Admin]');

            },
        ];
    }
}
