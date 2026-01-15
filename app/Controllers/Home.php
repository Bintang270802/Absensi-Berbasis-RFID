<?php

namespace App\Controllers;
use App\Models\Pointsiswa_model;
use App\Models\Totalpointsiswa_model;

use CodeIgniter\Controller;

class Home extends Controller
{ 
    public function index()
    {
        if(empty(session()->get('logged_in'))) {
            return redirect()->to('Cpanel');
        }
        $m_pointsis = new Totalpointsiswa_model;
        $id_tapel = session()->get('id_tapel');

        $nmdashboard = "Dashboard Administrator";

        $datanav = array(
            'nama' => session()->get('nama'),
            'title' => $nmdashboard,
            'nav1' => 'Home'
        );
  
        $data = array(
            'getPointsiswa' => $m_pointsis->getTotalpointsiswaterbaik(date('m'), $id_tapel)
        );

        echo view('index/sidebar');
        echo view('func_siswa');
        echo view('index/navbar', $datanav);
        
        echo view('home/home_admin', $data);
        echo view('index/footer');
    }

}
