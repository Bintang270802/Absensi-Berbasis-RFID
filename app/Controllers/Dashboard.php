<?php

namespace App\Controllers;

use App\Models\Absensisiswa_model;
use App\Models\Pointsiswa_model;
use App\Models\Siswa_model;
use App\Models\Totalpointsiswa_model;
use App\Models\Pesan_model;

use CodeIgniter\Controller;

date_default_timezone_set('Asia/Jakarta');
class Dashboard extends Controller
{
    public function index()
    {
       
        $m_absensiswa = new Absensisiswa_model;
        $m_pointsiswa = new Pointsiswa_model;
        $m_siswa = new Siswa_model;
        $m_totalpointsiswa = new Totalpointsiswa_model; 

        $tgl = date('Y-m-d');
        $bln = date('m');
        $thn = date('Y');
        $id_tapel = 2;
        $id = $this->request->getVar('id');

        //cek hari
        $namahari = date('l', strtotime($tgl));
        if ($namahari == "Sunday") {
            $hari = "Minggu";
        } elseif ($namahari == "Monday") {
            $hari = "Senin";
        } elseif ($namahari == "Tuesday") {
            $hari = "Selasa";
        } elseif ($namahari == "Wednesday") {
            $hari = "Rabu";
        } elseif ($namahari == "Thursday") {
            $hari = "Kamis";
        } elseif ($namahari == "Friday") {
            $hari = "Jumat";
        } elseif ($namahari == "Saturday") {
            $hari = "Sabtu";
        }

        //ambil logo
        $db = \Config\Database::connect();
        $query = $db->query("SELECT file FROM t_setting_aplikasi");
        $row = $query->getRow();

        $data = array(
            'getAbsensi' => $m_absensiswa->getAbsensisiswa($id, $tgl),
            'getSiswa' => $m_siswa->getSiswaidtapel($id,$id_tapel),
            'getHari' => $hari,
            'getId' => $id,
            'getIdtapel' => $id_tapel,
            'getLogo' => $row->file
        ); 
        echo view('index/sidebar_front');
        echo view('func_siswa');
       
        echo view('index/navbar_front', $data);
        echo view('home/home_front', $data);
        echo view('index/footer_front');
    }
    public function addabsensi()
    {
        $m_absensiswa = new Absensisiswa_model;
        $m_pointsiswa = new Pointsiswa_model;
        $m_totalpointsiswa = new Totalpointsiswa_model;
       
       
        $rfid = $this->request->getPost('rfid');
        $hari = $this->request->getPost('hari');
        $id_tapel = $this->request->getPost('id_tapel');
        $tgl = date('Y-m-d');
        $bln = date('m');
        $thn = date('Y');
        $id_tapel = 2;
        
        //cek apakah id siswa terdaftar
        $db = \Config\Database::connect();
        $builder = $db->table('t_siswa');
        $builder->select('id_siswa');
        $builder->where('rfid', $rfid);
        $all = $builder->countAllResults();
        if($all>0){
            echo view('func_siswa');
            $id_siswa = rfidtoidsiswa($rfid);

            //cek rombel siswa
            $idrombel = idsiswatoidrombel($id_siswa,$id_tapel);
            if ($idrombel > 0) {
                //cek jadwal jam masuk dan pulang
                $queryjadwal = $db->query("SELECT sts_hari,jammasuk,jampulang FROM r_hari where nm_hari='$hari'");
                $rowjadwal = $queryjadwal->getRow();
                $jammasuk = $rowjadwal->jammasuk;
                $jampulang = $rowjadwal->jampulang;
                $jamnow = date('H:i:s');

                //cek apakah hari ini libur
                if(($rowjadwal->sts_hari)==2){
                    session()->setFlashdata('error', 'Ditambahkan, Hari ini Libur');
                    return redirect()->to('/Dashboard/?id='. $id_siswa);
                }else{
                    //cek apakah sudah absen masuk
                    $buildercekhadir = $db->table('t_siswa_hadir');
                    $buildercekhadir->where('tgl_hadir', $tgl);
                    $buildercekhadir->where('id_siswa', $id_siswa);
                    $buildercekhadir->where('sts_hadir', 0);
                    $allcekhadir = $buildercekhadir->countAllResults();

                    //ambil data siswa berdsarkan id siswa
                    $querysiswa = $db->query("SELECT nm_siswa,no_induk,hp,nm_rombel FROM t_siswa 
                    join t_siswa_rombel ON t_siswa_rombel.id_siswa = t_siswa.id_siswa
                    join t_rombel ON t_rombel.id_rombel = t_siswa_rombel.id_rombel
                    where t_siswa.id_siswa='$id_siswa' and t_siswa_rombel.id_tapel='$id_tapel'");
                    $rowsiswa = $querysiswa->getRow();

                    if ($allcekhadir > 0) {
                        //cek apakah sudah absen pulang
                        $buildercekpulang = $db->table('t_siswa_hadir');
                        $buildercekpulang->where('tgl_hadir', $tgl);
                        $buildercekpulang->where('id_siswa', $id_siswa);
                        $buildercekpulang->where('sts_hadir', 1);
                        $allcekpualang = $buildercekpulang->countAllResults();
                        if($allcekpualang>0){
                            session()->setFlashdata('error', 'Ditambahkan, Anda sudah absen masuk dan pulang');
                            return redirect()->to('/Dashboard/?id=' . $id_siswa);
                        }else{
                            //cek jam pulang
                            if($jamnow>=$jampulang){
                                //proses absen pulang
                                $stshadir = 'Pulang';
                                $data = array(
                                    'id_siswa' => $id_siswa,
                                    'id_tapel' => $id_tapel,
                                    'tgl_hadir' => date('Y-m-d'),
                                    'sts_hadir' => 1,
                                    'jam' => $jamnow
                                );
                                $success = $m_absensiswa->saveAbsensi($data);



                                session()->setFlashdata('success', 'Ditambahkan Absen Pulang');
                                return redirect()->to('/Dashboard/?id=' . $id_siswa);

                            }else{
                                session()->setFlashdata('error', 'Ditambahkan, Anda sudah absen masuk, Tapi belum diperbolehkan absen pulang');
                                return redirect()->to('/Dashboard/?id=' . $id_siswa);
                            }
                        }
                        
                    } else {
                        //proses absen masuk
                        $data = array(
                            'id_siswa' => $id_siswa,
                            'id_tapel' => $id_tapel,
                            'tgl_hadir' => date('Y-m-d'),
                            'sts_hadir' => 0,
                            'jam' => date('H:i:s')
                        );
                        $success = $m_absensiswa->saveAbsensi($data);

                        if ($jamnow>$jammasuk) {
                            $stshadir = 'Terlambat';
                            $point = 5;
                        } else {
                            $stshadir = 'Hadir';
                            $point = 10;
                        }


                        
                        //point
                        $data = array(
                            'id_siswa' => $id_siswa,
                            'tgl_point' => $tgl,
                            'nilai' => $point
                        );

                        //cek apakah di tabel point hari ini sudah pernah ada
                        $builderpoint = $db->table('t_point_siswa');
                        $builderpoint->where('tgl_point', $tgl);
                        $builderpoint->where('id_siswa', $id_siswa);
                        $allpoint = $builderpoint->countAllResults();

                        //cek apakah ptk ada di tabel total di bulan berjalan
                        $builder2 = $db->table('t_total_point_siswa');
                        $builder2->where('bln', $bln);
                        $builder2->where('id_tapel', $id_tapel);
                        $builder2->where('id_siswa', $id_siswa);
                        $all2 = $builder2->countAllResults();

                        if ($allpoint == 0) {
                            if ($all2 > 0) {
                                //cek total point terakhir
                                $querypoint = $db->query("SELECT jml_point FROM t_total_point_siswa where id_siswa='$id_siswa' and bln='$bln' and id_tapel=' $id_tapel'");
                                $rowpoint = $querypoint->getRow();
                                $totpoint = $rowpoint->jml_point;
                                $pointbaru = $totpoint + $point;
                                $datatotal = array(
                                    'jml_point' => $pointbaru
                                );
                                $success1 = $m_totalpointsiswa->editTotalpointsiswa($datatotal, $bln, $id_tapel, $id_siswa);
                            } else {
                                $datatotal = array(
                                    'id_siswa' => $id_siswa,
                                    'jml_point' => $point,
                                    'bln' => $bln,
                                    'id_tapel' => $id_tapel
                                );
                                $success1 = $m_totalpointsiswa->saveTotalpointsiswa($datatotal);
                            }
                            $success = $m_pointsiswa->savePoint($data);
                        }

                        session()->setFlashdata('success', 'Ditambahkan Absen Masuk');
                        return redirect()->to('/Dashboard/?id=' . $id_siswa);
                    }

                }
            }else{
                session()->setFlashdata('error', 'Ditambahkan, Siswa belum mempunyai kelas');
                return redirect()->to('/Dashboard/?id=' . $id_siswa);
            }
        }else{
            session()->setFlashdata('error', 'Siswa tidak terdeteksi');
            return redirect()->to('/Dashboard');
        }

    }

}
