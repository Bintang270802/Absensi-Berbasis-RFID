<?php

namespace App\Controllers;

use App\Models\Absensisiswa_model;
use App\Models\Pointsiswa_model;
use App\Models\Siswa_model;
use App\Models\Totalpointsiswa_model;
use App\Libraries\AttendanceService;
use CodeIgniter\Controller;

/**
 * Dashboard Controller
 * 
 * Handles main dashboard and RFID attendance processing
 * 
 * @package    App\Controllers
 * @author     Your Name
 * @copyright  2024
 */
class Dashboard extends Controller
{
    /**
     * Attendance service instance
     *
     * @var AttendanceService
     */
    protected $attendanceService;

    /**
     * Constructor
     */
    public function __construct()
    {
        helper('attendance');
        date_default_timezone_set('Asia/Jakarta');
        $this->attendanceService = new AttendanceService();
    }

    /**
     * Display dashboard
     *
     * @return string
     */
    public function index()
    {
        $m_absensiswa = new Absensisiswa_model();
        $m_siswa = new Siswa_model();

        $date = date('Y-m-d');
        $id_tapel = session()->get('id_tapel') ?? 1;
        $id = $this->request->getVar('id');
        $day = get_current_day();

        // Get application logo
        $logo = $this->getApplicationLogo();

        $data = [
            'getAbsensi' => $m_absensiswa->getAbsensisiswa($id, $date),
            'getSiswa' => $m_siswa->getSiswaidtapel($id, $id_tapel),
            'getHari' => $day,
            'getId' => $id,
            'getIdtapel' => $id_tapel,
            'getLogo' => $logo
        ]; 

        return view('index/sidebar_front')
            . view('func_siswa')
            . view('index/navbar_front', $data)
            . view('home/home_front', $data)
            . view('index/footer_front');
    }

    /**
     * Process RFID attendance
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function addabsensi()
    {
        // Get form data
        $rfid = $this->request->getPost('rfid');
        $id_tapel = session()->get('id_tapel') ?? 1;

        // Validate input
        if (empty($rfid)) {
            session()->setFlashdata('error', 'RFID tidak boleh kosong');
            return redirect()->to('/Dashboard');
        }

        // Process attendance using service
        $result = $this->attendanceService->processRfidAttendance($rfid, $id_tapel);

        // Set flash message
        if ($result['success']) {
            session()->setFlashdata('success', $result['message']);
            
            if (isset($result['student_id'])) {
                return redirect()->to('/Dashboard/?id=' . $result['student_id']);
            }
        } else {
            session()->setFlashdata('error', $result['message']);
        }

        return redirect()->to('/Dashboard');
    }

    /**
     * Get application logo
     *
     * @return string|null Logo filename
     */
    protected function getApplicationLogo(): ?string
    {
        $db = \Config\Database::connect();
        $builder = $db->table('t_setting_aplikasi');
        $builder->select('file');
        $query = $builder->get();
        $row = $query->getRow();
        
        return $row ? $row->file : null;
    }
}
