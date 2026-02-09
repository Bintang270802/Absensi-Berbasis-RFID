<?php

/**
 * Attendance Helper Functions
 * 
 * Professional helper functions for attendance system
 * Following CodeIgniter 4 best practices
 * 
 * @package    App\Helpers
 * @author     Your Name
 * @copyright  2024
 */

if (!function_exists('get_student_by_rfid')) {
    /**
     * Get student ID by RFID
     *
     * @param string $rfid RFID card number
     * @return int Student ID or 0 if not found
     */
    function get_student_by_rfid(string $rfid): int
    {
        $db = \Config\Database::connect();
        $builder = $db->table('t_siswa');
        $builder->select('id_siswa');
        $builder->where('rfid', $rfid);
        $query = $builder->get();
        $row = $query->getRow();
        
        return $row ? (int)$row->id_siswa : 0;
    }
}

if (!function_exists('get_student_by_induk')) {
    /**
     * Get student ID by student number
     *
     * @param string $induk Student number
     * @return int Student ID or 0 if not found
     */
    function get_student_by_induk(string $induk): int
    {
        $db = \Config\Database::connect();
        $builder = $db->table('t_siswa');
        $builder->select('id_siswa');
        $builder->where('no_induk', $induk);
        $query = $builder->get();
        $row = $query->getRow();
        
        return $row ? (int)$row->id_siswa : 0;
    }
}

if (!function_exists('get_class_name')) {
    /**
     * Get class name by class ID
     *
     * @param int $id_rombel Class ID
     * @return string Class name or empty string
     */
    function get_class_name(int $id_rombel): string
    {
        $db = \Config\Database::connect();
        $builder = $db->table('t_rombel');
        $builder->select('nm_rombel');
        $builder->where('id_rombel', $id_rombel);
        $query = $builder->get();
        $row = $query->getRow();
        
        return $row ? $row->nm_rombel : '';
    }
}

if (!function_exists('get_student_class')) {
    /**
     * Get student's class ID for specific academic year
     *
     * @param int $id_siswa Student ID
     * @param int $id_tapel Academic year ID
     * @return int Class ID or 0 if not found
     */
    function get_student_class(int $id_siswa, int $id_tapel): int
    {
        $db = \Config\Database::connect();
        $builder = $db->table('t_siswa_rombel');
        $builder->select('id_rombel');
        $builder->where('id_siswa', $id_siswa);
        $builder->where('id_tapel', $id_tapel);
        $query = $builder->get();
        $row = $query->getRow();
        
        return $row ? (int)$row->id_rombel : 0;
    }
}

if (!function_exists('get_schedule_time')) {
    /**
     * Get schedule time for specific day
     *
     * @param string $day Day name in Indonesian
     * @return object|null Schedule object with jammasuk and jampulang
     */
    function get_schedule_time(string $day): ?object
    {
        $db = \Config\Database::connect();
        $builder = $db->table('r_hari');
        $builder->select('jammasuk, jampulang, sts_hari');
        $builder->where('nm_hari', $day);
        $query = $builder->get();
        
        return $query->getRow();
    }
}

if (!function_exists('get_day_name')) {
    /**
     * Convert English day name to Indonesian
     *
     * @param string $english_day English day name
     * @return string Indonesian day name
     */
    function get_day_name(string $english_day): string
    {
        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];
        
        return $days[$english_day] ?? 'Tidak Diketahui';
    }
}

if (!function_exists('get_current_day')) {
    /**
     * Get current day name in Indonesian
     *
     * @return string Indonesian day name
     */
    function get_current_day(): string
    {
        $english_day = date('l');
        return get_day_name($english_day);
    }
}

if (!function_exists('format_date_indonesian')) {
    /**
     * Format date to Indonesian format
     *
     * @param string $date Date in Y-m-d format
     * @return string Formatted date
     */
    function format_date_indonesian(string $date): string
    {
        $months = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        
        $parts = explode('-', $date);
        if (count($parts) !== 3) {
            return $date;
        }
        
        $day = (int)$parts[2];
        $month = (int)$parts[1];
        $year = $parts[0];
        
        return $day . ' ' . $months[$month] . ' ' . $year;
    }
}

if (!function_exists('get_month_name')) {
    /**
     * Get Indonesian month name
     *
     * @param int $month Month number (1-12)
     * @return string Month name
     */
    function get_month_name(int $month): string
    {
        $months = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        
        return $months[$month] ?? '';
    }
}

if (!function_exists('is_holiday')) {
    /**
     * Check if date is a holiday
     *
     * @param string $date Date to check
     * @return bool True if holiday
     */
    function is_holiday(string $date): bool
    {
        $db = \Config\Database::connect();
        $builder = $db->table('libur_besar');
        $builder->where('tgl_libur', $date);
        
        return $builder->countAllResults() > 0;
    }
}

if (!function_exists('get_attendance_status')) {
    /**
     * Get attendance status for student on specific date
     *
     * @param int $id_siswa Student ID
     * @param string $date Date to check
     * @return string Status: Hadir, Terlambat, Sakit, Izin, Alpha, Libur
     */
    function get_attendance_status(int $id_siswa, string $date): string
    {
        $db = \Config\Database::connect();
        
        // Check if holiday
        if (is_holiday($date)) {
            return 'Libur';
        }
        
        // Check if present
        $builder = $db->table('t_siswa_hadir');
        $builder->where('id_siswa', $id_siswa);
        $builder->where('tgl_hadir', $date);
        $builder->where('sts_hadir', 0);
        
        if ($builder->countAllResults() > 0) {
            // Check if late
            $builder = $db->table('t_siswa_hadir');
            $builder->select('jam');
            $builder->where('id_siswa', $id_siswa);
            $builder->where('tgl_hadir', $date);
            $builder->where('sts_hadir', 0);
            $query = $builder->get();
            $row = $query->getRow();
            
            if ($row) {
                $day = get_day_name(date('l', strtotime($date)));
                $schedule = get_schedule_time($day);
                
                if ($schedule && $row->jam > $schedule->jammasuk) {
                    return 'Terlambat';
                }
            }
            
            return 'Hadir';
        }
        
        // Check if absent with reason
        $builder = $db->table('t_siswa_absen');
        $builder->select('sts_absen');
        $builder->where('id_siswa', $id_siswa);
        $builder->where('tgl_absen', $date);
        $builder->where('sts_approve', 1);
        $query = $builder->get();
        $row = $query->getRow();
        
        if ($row) {
            switch ($row->sts_absen) {
                case 2: return 'Sakit';
                case 3: return 'Izin';
                default: return 'Alpha';
            }
        }
        
        return 'Alpha';
    }
}

if (!function_exists('format_currency')) {
    /**
     * Format number as Indonesian Rupiah
     *
     * @param float $amount Amount to format
     * @return string Formatted currency
     */
    function format_currency(float $amount): string
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('get_gender_label')) {
    /**
     * Get gender label
     *
     * @param int $code Gender code (1=Male, 2=Female)
     * @return string Gender label
     */
    function get_gender_label(int $code): string
    {
        return $code === 1 ? 'Laki-laki' : 'Perempuan';
    }
}

if (!function_exists('get_status_label')) {
    /**
     * Get status label
     *
     * @param int $code Status code
     * @return string Status label
     */
    function get_status_label(int $code): string
    {
        return $code === 1 ? 'Aktif' : 'Tidak Aktif';
    }
}

if (!function_exists('get_user_level_label')) {
    /**
     * Get user level label
     *
     * @param int $code Level code
     * @return string Level label
     */
    function get_user_level_label(int $code): string
    {
        $levels = [
            1 => 'Administrator',
            2 => 'Wali Kelas',
            3 => 'Guru',
            4 => 'Kepala Sekolah'
        ];
        
        return $levels[$code] ?? 'Unknown';
    }
}

if (!function_exists('sanitize_input')) {
    /**
     * Sanitize user input
     *
     * @param string $input Input to sanitize
     * @return string Sanitized input
     */
    function sanitize_input(string $input): string
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('generate_random_code')) {
    /**
     * Generate random alphanumeric code
     *
     * @param int $length Code length
     * @return string Random code
     */
    function generate_random_code(int $length = 8): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        $max = strlen($characters) - 1;
        
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[random_int(0, $max)];
        }
        
        return $code;
    }
}

if (!function_exists('get_days_in_month')) {
    /**
     * Get number of days in month
     *
     * @param int $month Month number (1-12)
     * @param int $year Year
     * @return int Number of days
     */
    function get_days_in_month(int $month, int $year): int
    {
        if ($month < 1 || $month > 12) {
            return 0;
        }
        
        return cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }
}

if (!function_exists('calculate_attendance_summary')) {
    /**
     * Calculate attendance summary for student in a month
     *
     * @param int $id_siswa Student ID
     * @param int $month Month number
     * @param int $year Year
     * @return array Summary with counts
     */
    function calculate_attendance_summary(int $id_siswa, int $month, int $year): array
    {
        $db = \Config\Database::connect();
        
        // Count present
        $builder = $db->table('t_siswa_hadir');
        $builder->where('id_siswa', $id_siswa);
        $builder->where('sts_hadir', 0);
        $builder->where('MONTH(tgl_hadir)', $month);
        $builder->where('YEAR(tgl_hadir)', $year);
        $present = $builder->countAllResults();
        
        // Count sick
        $builder = $db->table('t_siswa_absen');
        $builder->where('id_siswa', $id_siswa);
        $builder->where('sts_absen', 2);
        $builder->where('sts_approve', 1);
        $builder->where('MONTH(tgl_absen)', $month);
        $builder->where('YEAR(tgl_absen)', $year);
        $sick = $builder->countAllResults();
        
        // Count permission
        $builder = $db->table('t_siswa_absen');
        $builder->where('id_siswa', $id_siswa);
        $builder->where('sts_absen', 3);
        $builder->where('sts_approve', 1);
        $builder->where('MONTH(tgl_absen)', $month);
        $builder->where('YEAR(tgl_absen)', $year);
        $permission = $builder->countAllResults();
        
        return [
            'present' => $present,
            'sick' => $sick,
            'permission' => $permission,
            'late' => 0, // Would need additional logic
            'alpha' => 0  // Would need additional logic
        ];
    }
}
