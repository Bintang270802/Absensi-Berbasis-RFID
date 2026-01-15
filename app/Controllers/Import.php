<?php

namespace App\Controllers;
use App\Models\Siswa_model;
use App\Models\Rombel_model;

use CodeIgniter\Controller;

class Import extends Controller
{
    public function index()
    {
        if (empty(session()->get('logged_in'))) {
            return redirect()->to('Cpanel');
        }

        $datanav = array(
            'nama' => session()->get('nama'),
            'title' => 'Import Data Master  Siswa',
            'nav' => 'Import'
        );


        echo view('index/sidebar');
        echo view('func');
        echo view('index/navbar', $datanav);
        echo view('master/import');
        echo view('index/footer');
    }


    public function addsiswa()
    {

        $model = new Siswa_model;

        $file_excel = $this->request->getFile('file');
        $ext = $file_excel->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file_excel);

        $data = $spreadsheet->getActiveSheet()->toArray();
        foreach ($data as $x => $row) {
            if ($x == 0) {
                continue;
            }

            $nis = $row[0];

            $db = \Config\Database::connect();
            $ceknis = $db->table('t_siswa')->getWhere(['no_induk' => $nis])->getResult();

            $simpandata = [
                'no_induk' => $row[0],
                'nm_siswa' => $row[1],
                'alamat' => $row[2],
                'jk' => $row[3],
                'hp' => $row[4],
                'tempat_lahir' => $row[5],
                'tgl_lahir' => $row[6],
                'sts_siswa' => 1

            ];

            if (count($ceknis) > 0) {
                $success = $model->editSiswaimport($simpandata, $nis);
            } else {
                $success = $model->saveSiswa($simpandata);
            }
        }

        if ($success) {
            session()->setFlashdata('success', 'Import');
            return redirect()->to('/Import');
        } else {
            session()->setFlashdata('error', 'Import');
            return redirect()->to('/Import');
        }

    }

}
