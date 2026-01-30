<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Siswa_model;
use App\Models\Absensisiswa_model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 
class Export extends BaseController
{
    public function harian()
    {
        if(empty(session()->get('logged_in'))) {
            return redirect()->to('Cpanel');
        }

        $model = new Siswa_model;
        $m_absensi = new Absensisiswa_model;
        $tanggal = $this->request->getPost('tgl');
        
        if(empty($tanggal)) {
            session()->setFlashdata('error', 'Tanggal harus diisi');
            return redirect()->back();
        }

        $users = $model->getSiswa();

        $spreadsheet = new Spreadsheet();
        
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'NISN')
            ->setCellValue('C1', 'Nama Siswa')
            ->setCellValue('D1', 'Kelas')
            ->setCellValue('E1', 'Jam Masuk')
            ->setCellValue('F1', 'Status')
            ->setCellValue('G1', 'Jam Pulang');

        $column = 2;
        $no = 0;
        foreach ($users as $data) {
            $no++;
            $id_siswa = $data['id_siswa'];
            
            // Get attendance data using model methods
            $jammasuk = $this->getJamMasuk($id_siswa, $tanggal);
            $jampulang = $this->getJamPulang($id_siswa, $tanggal);
            $status = $this->getStatusAbsen($id_siswa, $tanggal);

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $no)
                ->setCellValue('B' . $column, $data['nisn'])
                ->setCellValue('C' . $column, $data['nm_siswa'])
                ->setCellValue('D' . $column, $data['nm_rombel'] ?? '-')
                ->setCellValue('E' . $column, $jammasuk)
                ->setCellValue('F' . $column, $status)
                ->setCellValue('G' . $column, $jampulang);

            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His'). '-Data-Absensi-Harian';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function bulanan()
    {
        if(empty(session()->get('logged_in'))) {
            return redirect()->to('Cpanel');
        }

        $model = new Siswa_model;
        $getBulan = $this->request->getPost('bln');
        
        if(empty($getBulan)) {
            session()->setFlashdata('error', 'Bulan harus diisi');
            return redirect()->back();
        }

        $users = $model->getSiswa();
       
        $spreadsheet = new Spreadsheet();
        
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'NISN')
            ->setCellValue('C1', 'Nama Siswa')
            ->setCellValue('D1', 'Kelas')
            ->setCellValue('E1', 'Masuk')
            ->setCellValue('F1', 'Terlambat')
            ->setCellValue('G1', 'Sakit')
            ->setCellValue('H1', 'Izin')
            ->setCellValue('I1', 'Alpha');
            
        $column = 2;
        $no = 0;
        foreach ($users as $data) {
            $no++;
            $id_siswa = $data['id_siswa'];
            
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $no)
                ->setCellValue('B' . $column, $data['nisn'])
                ->setCellValue('C' . $column, $data['nm_siswa'])
                ->setCellValue('D' . $column, $data['nm_rombel'] ?? '-')
                ->setCellValue('E' . $column, $this->getJumMasukBln($id_siswa, $getBulan))
                ->setCellValue('F' . $column, $this->getJumTerlambatBln($id_siswa, $getBulan))
                ->setCellValue('G' . $column, $this->getJumSakitBln($id_siswa, $getBulan))
                ->setCellValue('H' . $column, $this->getJumIzinBln($id_siswa, $getBulan))
                ->setCellValue('I' . $column, $this->getJumAlphaBln($id_siswa, $getBulan));

            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His'). '-Data-Absensi-Bulanan';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    // Helper methods using secure query builder
    private function getJamMasuk($id_siswa, $tgl)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('t_siswa_hadir');
        $builder->select('jam');
        $builder->where('id_siswa', $id_siswa);
        $builder->where('sts_hadir', 0);
        $builder->where('tgl_hadir', $tgl);
        $query = $builder->get();
        $row = $query->getRow();
        
        return $row ? $row->jam : '';
    }

    private function getJamPulang($id_siswa, $tgl)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('t_siswa_hadir');
        $builder->select('jam');
        $builder->where('id_siswa', $id_siswa);
        $builder->where('sts_hadir', 1);
        $builder->where('tgl_hadir', $tgl);
        $query = $builder->get();
        $row = $query->getRow();
        
        return $row ? $row->jam : '';
    }

    private function getStatusAbsen($id_siswa, $tgl)
    {
        $db = \Config\Database::connect();
        
        // Check if present
        $builder = $db->table('t_siswa_hadir');
        $builder->where('id_siswa', $id_siswa);
        $builder->where('sts_hadir', 0);
        $builder->where('tgl_hadir', $tgl);
        $hadir = $builder->countAllResults();
        
        if($hadir > 0) {
            return 'Hadir';
        }
        
        // Check if absent with reason
        $builder = $db->table('t_siswa_absen');
        $builder->where('id_siswa', $id_siswa);
        $builder->where('tgl_absen', $tgl);
        $builder->where('sts_approve', 1);
        $absen = $builder->countAllResults();
        
        if($absen > 0) {
            $builder = $db->table('t_siswa_absen');
            $builder->select('sts_absen');
            $builder->where('id_siswa', $id_siswa);
            $builder->where('tgl_absen', $tgl);
            $builder->where('sts_approve', 1);
            $query = $builder->get();
            $row = $query->getRow();
            
            if($row) {
                switch($row->sts_absen) {
                    case 2: return 'Sakit';
                    case 3: return 'Izin';
                    default: return 'Alpha';
                }
            }
        }
        
        return 'Alpha';
    }

    private function getJumMasukBln($id_siswa, $bln)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('t_siswa_hadir');
        $builder->where('id_siswa', $id_siswa);
        $builder->where('sts_hadir', 0);
        $builder->where('MONTH(tgl_hadir)', $bln);
        $builder->where('YEAR(tgl_hadir)', date('Y'));
        
        return $builder->countAllResults();
    }

    private function getJumTerlambatBln($id_siswa, $bln)
    {
        // This would need more complex logic to determine late arrivals
        // For now, return 0 as placeholder
        return 0;
    }

    private function getJumSakitBln($id_siswa, $bln)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('t_siswa_absen');
        $builder->where('id_siswa', $id_siswa);
        $builder->where('sts_absen', 2);
        $builder->where('sts_approve', 1);
        $builder->where('MONTH(tgl_absen)', $bln);
        $builder->where('YEAR(tgl_absen)', date('Y'));
        
        return $builder->countAllResults();
    }

    private function getJumIzinBln($id_siswa, $bln)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('t_siswa_absen');
        $builder->where('id_siswa', $id_siswa);
        $builder->where('sts_absen', 3);
        $builder->where('sts_approve', 1);
        $builder->where('MONTH(tgl_absen)', $bln);
        $builder->where('YEAR(tgl_absen)', date('Y'));
        
        return $builder->countAllResults();
    }

    private function getJumAlphaBln($id_siswa, $bln)
    {
        // This would need complex logic to calculate alpha days
        // For now, return 0 as placeholder
        return 0;
    }
}