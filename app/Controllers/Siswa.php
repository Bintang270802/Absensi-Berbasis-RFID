<?php

namespace App\Controllers;
use App\Models\Siswa_model;
use App\Models\Siswarombel_model;

use CodeIgniter\Controller;

class Siswa extends Controller
{
    public function index()
    {
        if(empty(session()->get('logged_in'))) {
            return redirect()->to('Cpanel');
        }
        $model = new Siswa_model;
        
        $datanav = array(
            'nama' => session()->get('nama'),
            'title' => 'Data Siswa',
            'nav' => 'Siswa'
        );

        $data = array(
            'getSiswa' => $model->getSiswa()
        );

        
        echo view('index/sidebar');
        echo view('func');
        echo view('index/navbar',  $datanav);
        echo view('master/siswa', $data);
        echo view('index/footer');
    }
   
    public function add()
    {
        
        $model = new Siswa_model;
        $file = $this->request->getFile('file');
        $fileName = $file->getRandomName();
        $pass=$this->request->getPost('password');
        $data = array(
            'nisn' => $this->request->getPost('nisn'),
            'no_induk' => $this->request->getPost('no_induk'),
            'rfid' => $this->request->getPost('rfid'),
            'nm_siswa' => $this->request->getPost('nama'),
            'hp' => $this->request->getPost('hp'),
            'sts_siswa' => $this->request->getPost('sts'),
            'jk' => $this->request->getPost('jk'),
            'alamat' => $this->request->getPost('alamat'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'file' => $fileName,
            'password' => password_hash($pass,PASSWORD_DEFAULT),
        );

        //validasi input
        if(!$this->validate([
            "no_induk" => 'required|is_unique[t_siswa.no_induk]'
        ])){
            session()->setFlashdata('error','Ditambahkan, Nomor Induk tidak boleh sama');
            return redirect()->to('/Siswa');
        }
 
        $success = $model->saveSiswa($data);
        $file->move('image/siswa/', $fileName);
        if($success){
                session()->setFlashdata('success','Ditambahkan');
                return redirect()->to('/Siswa');
        }else{
                session()->setFlashdata('error','Ditambahkan');
                return redirect()->to('/Siswa');
        }
        
    }
    public function update()
    {
        $model = new Siswa_model;
        $id = $this->request->getPost('id');
        if($this->request->getFile('file')->isValid()){
            $file = $this->request->getFile('file');
            $fileName = $file->getRandomName();
            $data = array(
                'nisn' => $this->request->getPost('nisn'),
                'no_induk' => $this->request->getPost('no_induk'),
                'rfid' => $this->request->getPost('rfid'),
                'nm_siswa' => $this->request->getPost('nama'),
                'hp' => $this->request->getPost('hp'),
                'sts_siswa' => $this->request->getPost('sts'),
                'jk' => $this->request->getPost('jk'),
                'alamat' => $this->request->getPost('alamat'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tgl_lahir' => $this->request->getPost('tgl_lahir'),
                'file' => $fileName
            );
            $file->move('image/siswa/', $fileName);
        }else{
            $data = array(
                'nisn' => $this->request->getPost('nisn'),
                'no_induk' => $this->request->getPost('no_induk'),
                'rfid' => $this->request->getPost('rfid'),
                'nm_siswa' => $this->request->getPost('nama'),
                'hp' => $this->request->getPost('hp'),
                'sts_siswa' => $this->request->getPost('sts'),
                'jk' => $this->request->getPost('jk'),
                'alamat' => $this->request->getPost('alamat'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tgl_lahir' => $this->request->getPost('tgl_lahir')
            );
        }
        
       
        //update data
        $success = $model->editSiswa($data, $id);
        if($success){
            session()->setFlashdata('success','Diupdate');
            return redirect()->to('/Siswa');
        }else{
            session()->setFlashdata('error','Diupdate');
            return redirect()->to('/Siswa');
        }
    }
    public function updatepassword()
    {
        $model = new Siswa_model;
        $id = $this->request->getPost('id');
        $pass1=$this->request->getPost('password1');
        $pass2=$this->request->getPost('password2');

        if($pass1==$pass2)
        {
            $data = array(
                'password' => password_hash($pass1,PASSWORD_DEFAULT)
            );

            //update data
            $success = $model->editSiswa($data, $id);
            if($success){
                session()->setFlashdata('success','Diupdate');
                return redirect()->to('/Siswa');
            }else{
                session()->setFlashdata('error','Diupdate');
                return redirect()->to('/Siswa');
            }
        }else
        {
            session()->setFlashdata('error','Diupadete, terdeteksi password tidak sama');
            return redirect()->to('/Siswa');
        }
    }
    public function hapus()
    {
        $model = new Siswa_model;
        $m_sisrombel = new Siswarombel_model;
        $id = $this->request->getPost('id');
        if (isset($id)) {
            //hapus data
            $success = $model->hapusSiswa($id);
            $success1 = $m_sisrombel->hapusSiswarombelidsiswa($id);
            if($success){
                session()->setFlashdata('success','Dihapus');
                return redirect()->to('/Siswa');
            }else{
                session()->setFlashdata('error','Dihapus');
                return redirect()->to('/Siswa');
            }
        } else {

            session()->setFlashdata('error','Dihapus, id data tidak di temukan');
            return redirect()->to('/Siswa');
        }
    }
}
