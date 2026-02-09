<?php

namespace App\Libraries;

use CodeIgniter\Database\ConnectionInterface;

/**
 * Attendance Service Class
 * 
 * Professional service layer for attendance operations
 * Implements business logic and data validation
 * 
 * @package    App\Libraries
 * @author     Your Name
 * @copyright  2024
 */
class AttendanceService
{
    /**
     * Database connection
     *
     * @var ConnectionInterface
     */
    protected $db;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * Process RFID attendance
     *
     * @param string $rfid RFID card number
     * @param int $id_tapel Academic year ID
     * @return array Result with status and message
     */
    public function processRfidAttendance(string $rfid, int $id_tapel): array
    {
        // Validate RFID
        $student_id = $this->getStudentByRfid($rfid);
        if (!$student_id) {
            return [
                'success' => false,
                'message' => 'RFID tidak terdaftar'
            ];
        }

        // Check if student has class
        $class_id = $this->getStudentClass($student_id, $id_tapel);
        if (!$class_id) {
            return [
                'success' => false,
                'message' => 'Siswa belum memiliki kelas'
            ];
        }

        // Get current date and time
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $day = get_current_day();

        // Check if holiday
        if ($this->isHoliday($date, $day)) {
            return [
                'success' => false,
                'message' => 'Hari ini libur'
            ];
        }

        // Get schedule
        $schedule = $this->getSchedule($day);
        if (!$schedule) {
            return [
                'success' => false,
                'message' => 'Jadwal belum diatur'
            ];
        }

        // Check attendance status
        $attendance_status = $this->checkAttendanceStatus($student_id, $date);

        if ($attendance_status === 'not_checked_in') {
            return $this->processCheckIn($student_id, $id_tapel, $date, $time, $schedule);
        } elseif ($attendance_status === 'checked_in') {
            return $this->processCheckOut($student_id, $date, $time, $schedule);
        } else {
            return [
                'success' => false,
                'message' => 'Anda sudah absen masuk dan pulang'
            ];
        }
    }

    /**
     * Process check-in attendance
     *
     * @param int $student_id Student ID
     * @param int $id_tapel Academic year ID
     * @param string $date Date
     * @param string $time Time
     * @param object $schedule Schedule object
     * @return array Result
     */
    protected function processCheckIn(int $student_id, int $id_tapel, string $date, string $time, object $schedule): array
    {
        $builder = $this->db->table('t_siswa_hadir');
        
        $data = [
            'id_siswa' => $student_id,
            'id_tapel' => $id_tapel,
            'tgl_hadir' => $date,
            'sts_hadir' => 0, // Check-in
            'jam' => $time
        ];

        if ($builder->insert($data)) {
            // Calculate points
            $points = $time > $schedule->jammasuk ? 5 : 10;
            $status = $time > $schedule->jammasuk ? 'Terlambat' : 'Tepat Waktu';
            
            // Save points
            $this->saveAttendancePoints($student_id, $id_tapel, $date, $points);

            return [
                'success' => true,
                'message' => 'Absen masuk berhasil',
                'status' => $status,
                'points' => $points,
                'student_id' => $student_id
            ];
        }

        return [
            'success' => false,
            'message' => 'Gagal menyimpan absensi'
        ];
    }

    /**
     * Process check-out attendance
     *
     * @param int $student_id Student ID
     * @param string $date Date
     * @param string $time Time
     * @param object $schedule Schedule object
     * @return array Result
     */
    protected function processCheckOut(int $student_id, string $date, string $time, object $schedule): array
    {
        // Check if allowed to check out
        if ($time < $schedule->jampulang) {
            return [
                'success' => false,
                'message' => 'Belum waktunya absen pulang'
            ];
        }

        $builder = $this->db->table('t_siswa_hadir');
        
        $data = [
            'id_siswa' => $student_id,
            'tgl_hadir' => $date,
            'sts_hadir' => 1, // Check-out
            'jam' => $time
        ];

        if ($builder->insert($data)) {
            return [
                'success' => true,
                'message' => 'Absen pulang berhasil',
                'student_id' => $student_id
            ];
        }

        return [
            'success' => false,
            'message' => 'Gagal menyimpan absensi'
        ];
    }

    /**
     * Save attendance points
     *
     * @param int $student_id Student ID
     * @param int $id_tapel Academic year ID
     * @param string $date Date
     * @param int $points Points to add
     * @return bool Success status
     */
    protected function saveAttendancePoints(int $student_id, int $id_tapel, string $date, int $points): bool
    {
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));

        // Check if points already exist for today
        $builder = $this->db->table('t_point_siswa');
        $builder->where('id_siswa', $student_id);
        $builder->where('tgl_point', $date);
        
        if ($builder->countAllResults() > 0) {
            return true; // Already recorded
        }

        // Insert daily points
        $builder = $this->db->table('t_point_siswa');
        $builder->insert([
            'id_siswa' => $student_id,
            'tgl_point' => $date,
            'nilai' => $points
        ]);

        // Update monthly total
        $this->updateMonthlyPoints($student_id, $id_tapel, $month, $year, $points);

        return true;
    }

    /**
     * Update monthly points total
     *
     * @param int $student_id Student ID
     * @param int $id_tapel Academic year ID
     * @param string $month Month
     * @param string $year Year
     * @param int $points Points to add
     * @return bool Success status
     */
    protected function updateMonthlyPoints(int $student_id, int $id_tapel, string $month, string $year, int $points): bool
    {
        $builder = $this->db->table('t_total_point_siswa');
        $builder->where('id_siswa', $student_id);
        $builder->where('bln', $month);
        $builder->where('id_tapel', $id_tapel);
        
        $existing = $builder->get()->getRow();

        if ($existing) {
            // Update existing
            $builder = $this->db->table('t_total_point_siswa');
            $builder->where('id_siswa', $student_id);
            $builder->where('bln', $month);
            $builder->where('id_tapel', $id_tapel);
            $builder->update([
                'jml_point' => $existing->jml_point + $points
            ]);
        } else {
            // Insert new
            $builder = $this->db->table('t_total_point_siswa');
            $builder->insert([
                'id_siswa' => $student_id,
                'jml_point' => $points,
                'bln' => $month,
                'id_tapel' => $id_tapel
            ]);
        }

        return true;
    }

    /**
     * Get student ID by RFID
     *
     * @param string $rfid RFID card number
     * @return int Student ID or 0
     */
    protected function getStudentByRfid(string $rfid): int
    {
        $builder = $this->db->table('t_siswa');
        $builder->select('id_siswa');
        $builder->where('rfid', $rfid);
        $query = $builder->get();
        $row = $query->getRow();
        
        return $row ? (int)$row->id_siswa : 0;
    }

    /**
     * Get student's class
     *
     * @param int $student_id Student ID
     * @param int $id_tapel Academic year ID
     * @return int Class ID or 0
     */
    protected function getStudentClass(int $student_id, int $id_tapel): int
    {
        $builder = $this->db->table('t_siswa_rombel');
        $builder->select('id_rombel');
        $builder->where('id_siswa', $student_id);
        $builder->where('id_tapel', $id_tapel);
        $query = $builder->get();
        $row = $query->getRow();
        
        return $row ? (int)$row->id_rombel : 0;
    }

    /**
     * Check if date is holiday
     *
     * @param string $date Date to check
     * @param string $day Day name
     * @return bool True if holiday
     */
    protected function isHoliday(string $date, string $day): bool
    {
        // Check national holiday
        $builder = $this->db->table('libur_besar');
        $builder->where('tgl_libur', $date);
        if ($builder->countAllResults() > 0) {
            return true;
        }

        // Check regular day off
        $schedule = $this->getSchedule($day);
        if ($schedule && $schedule->sts_hari == 2) {
            return true;
        }

        return false;
    }

    /**
     * Get schedule for day
     *
     * @param string $day Day name
     * @return object|null Schedule object
     */
    protected function getSchedule(string $day): ?object
    {
        $builder = $this->db->table('r_hari');
        $builder->select('sts_hari, jammasuk, jampulang');
        $builder->where('nm_hari', $day);
        $query = $builder->get();
        
        return $query->getRow();
    }

    /**
     * Check attendance status for student on date
     *
     * @param int $student_id Student ID
     * @param string $date Date
     * @return string Status: not_checked_in, checked_in, completed
     */
    protected function checkAttendanceStatus(int $student_id, string $date): string
    {
        // Check if checked in
        $builder = $this->db->table('t_siswa_hadir');
        $builder->where('id_siswa', $student_id);
        $builder->where('tgl_hadir', $date);
        $builder->where('sts_hadir', 0);
        
        if ($builder->countAllResults() == 0) {
            return 'not_checked_in';
        }

        // Check if checked out
        $builder = $this->db->table('t_siswa_hadir');
        $builder->where('id_siswa', $student_id);
        $builder->where('tgl_hadir', $date);
        $builder->where('sts_hadir', 1);
        
        if ($builder->countAllResults() == 0) {
            return 'checked_in';
        }

        return 'completed';
    }

    /**
     * Get attendance report for student
     *
     * @param int $student_id Student ID
     * @param string $start_date Start date
     * @param string $end_date End date
     * @return array Attendance records
     */
    public function getAttendanceReport(int $student_id, string $start_date, string $end_date): array
    {
        $builder = $this->db->table('t_siswa_hadir');
        $builder->select('tgl_hadir, jam, sts_hadir');
        $builder->where('id_siswa', $student_id);
        $builder->where('tgl_hadir >=', $start_date);
        $builder->where('tgl_hadir <=', $end_date);
        $builder->orderBy('tgl_hadir', 'ASC');
        $builder->orderBy('sts_hadir', 'ASC');
        
        return $builder->get()->getResultArray();
    }

    /**
     * Get monthly statistics
     *
     * @param int $student_id Student ID
     * @param int $month Month
     * @param int $year Year
     * @return array Statistics
     */
    public function getMonthlyStatistics(int $student_id, int $month, int $year): array
    {
        return calculate_attendance_summary($student_id, $month, $year);
    }
}
