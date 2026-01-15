-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Nov 2024 pada 10.23
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absen_saputra`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `libur`
--

CREATE TABLE `libur` (
  `id_libur` int(11) NOT NULL,
  `id_ptk` int(11) NOT NULL,
  `Senin` int(11) DEFAULT NULL,
  `Selasa` int(11) DEFAULT NULL,
  `Rabu` int(11) DEFAULT NULL,
  `Kamis` int(11) DEFAULT NULL,
  `Jumat` int(11) DEFAULT NULL,
  `Sabtu` int(11) DEFAULT NULL,
  `Minggu` int(11) DEFAULT NULL,
  `tgl_entri` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `libur`
--

INSERT INTO `libur` (`id_libur`, `id_ptk`, `Senin`, `Selasa`, `Rabu`, `Kamis`, `Jumat`, `Sabtu`, `Minggu`, `tgl_entri`) VALUES
(50, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `libur_besar`
--

CREATE TABLE `libur_besar` (
  `id_liburbesar` int(11) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `tgl_libur` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `libur_besar`
--

INSERT INTO `libur_besar` (`id_liburbesar`, `keterangan`, `tgl_libur`) VALUES
(12, 'Libur Hari Raya', '2024-04-08'),
(13, 'Libur Hari Raya', '2024-04-09'),
(14, 'Libur Hari Raya', '2024-04-10'),
(19, 'Libur Hari Raya', '2024-04-15'),
(20, 'Libur Hari Raya', '2024-04-16'),
(21, 'Libur Hari Raya', '2024-04-17'),
(22, 'Libur Hari Raya', '2024-04-18'),
(23, 'Libur Hari Raya', '2024-04-19'),
(24, 'Hari Buruh', '2024-05-01'),
(25, 'Kenaikan Isa Al Masih', '2024-05-09'),
(26, 'Kenaikan Isa Al Masih', '2024-05-10'),
(27, 'Libur Hari Raya', '2024-04-11'),
(28, 'Libur Hari Raya', '2024-04-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_hari`
--

CREATE TABLE `r_hari` (
  `id_hari` int(11) NOT NULL,
  `nm_hari` varchar(20) NOT NULL,
  `sts_hari` int(11) NOT NULL,
  `jammasuk` time DEFAULT NULL,
  `jampulang` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `r_hari`
--

INSERT INTO `r_hari` (`id_hari`, `nm_hari`, `sts_hari`, `jammasuk`, `jampulang`) VALUES
(1, 'Senin', 1, '07:00:00', '16:00:00'),
(2, 'Selasa', 1, '07:00:00', '15:00:00'),
(3, 'Rabu', 1, '07:00:00', '16:00:00'),
(4, 'Kamis', 1, '07:00:00', '16:00:00'),
(5, 'Jumat', 1, '07:00:00', '13:00:00'),
(6, 'Sabtu', 1, '07:00:00', '12:00:00'),
(7, 'Minggu', 2, '07:00:00', '12:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_tapel`
--

CREATE TABLE `r_tapel` (
  `id_tapel` int(11) NOT NULL,
  `nm_tapel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `r_tapel`
--

INSERT INTO `r_tapel` (`id_tapel`, `nm_tapel`) VALUES
(1, '2023/2024'),
(2, '2024/2025');

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_tingkat_kelas`
--

CREATE TABLE `r_tingkat_kelas` (
  `id_tingkat_kelas` int(11) NOT NULL,
  `nm_tingkat_kelas` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `r_tingkat_kelas`
--

INSERT INTO `r_tingkat_kelas` (`id_tingkat_kelas`, `nm_tingkat_kelas`) VALUES
(1, 'X'),
(2, 'XI'),
(3, 'XII');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_point`
--

CREATE TABLE `t_point` (
  `id_point` int(11) NOT NULL,
  `id_ptk` int(11) NOT NULL,
  `tgl_point` date NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_point`
--

INSERT INTO `t_point` (`id_point`, `id_ptk`, `tgl_point`, `nilai`) VALUES
(57, 1, '2024-10-07', 5),
(58, 10, '2024-10-07', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_point_siswa`
--

CREATE TABLE `t_point_siswa` (
  `id_point` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `tgl_point` date NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_point_siswa`
--

INSERT INTO `t_point_siswa` (`id_point`, `id_siswa`, `tgl_point`, `nilai`) VALUES
(1, 4, '2024-10-07', 5),
(2, 1, '2024-11-05', 5),
(3, 4, '2024-11-05', 5),
(4, 4, '2024-11-10', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_rombel`
--

CREATE TABLE `t_rombel` (
  `id_rombel` int(11) NOT NULL,
  `id_tingkat_kelas` int(11) DEFAULT NULL,
  `nm_rombel` varchar(10) DEFAULT NULL,
  `id_tapel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_rombel`
--

INSERT INTO `t_rombel` (`id_rombel`, `id_tingkat_kelas`, `nm_rombel`, `id_tapel`) VALUES
(1, 1, '10 MIPA 1', 1),
(2, 1, '10 MIPA 2', 1),
(3, 2, 'XI IPS 1', 1),
(4, 2, 'XI IPS 2', 1),
(5, 3, 'XII MIPA 1', 1),
(6, 3, 'XII MIPA 2', 1),
(7, 2, 'XI IPS 3', 1),
(8, 3, '3-A', 2),
(9, 1, '1-A', 2),
(10, 2, '2-A', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_setting_aplikasi`
--

CREATE TABLE `t_setting_aplikasi` (
  `id_setting` int(2) NOT NULL,
  `nm_aplikasi` varchar(50) NOT NULL,
  `file` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_setting_aplikasi`
--

INSERT INTO `t_setting_aplikasi` (`id_setting`, `nm_aplikasi`, `file`) VALUES
(1, 'APLIKASI ABSENSI', '1731383360_ca6ce838f65b78a0e005.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_siswa`
--

CREATE TABLE `t_siswa` (
  `id_siswa` int(11) NOT NULL,
  `no_induk` int(11) DEFAULT NULL,
  `nisn` int(11) DEFAULT NULL,
  `rfid` varchar(100) DEFAULT NULL,
  `nm_siswa` varchar(100) DEFAULT NULL,
  `alamat` longtext DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jk` int(11) DEFAULT NULL,
  `hp` varchar(100) DEFAULT NULL,
  `sts_siswa` int(11) DEFAULT NULL,
  `file` longtext DEFAULT NULL,
  `password` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_siswa`
--

INSERT INTO `t_siswa` (`id_siswa`, `no_induk`, `nisn`, `rfid`, `nm_siswa`, `alamat`, `tempat_lahir`, `tgl_lahir`, `jk`, `hp`, `sts_siswa`, `file`, `password`) VALUES
(1, 1001, 12355, '0016237198', 'Ajeng raharjo', 'Surabaya', 'Surabaya', '2024-01-02', 1, '081112212', 1, NULL, NULL),
(2, 1002, NULL, NULL, 'Ica Inata', 'Jakarta', 'Jakarta', '2024-01-22', 2, '089', 1, NULL, NULL),
(3, 1003, NULL, NULL, 'JIhan', 'Gresik', 'Gresik', '2024-01-16', 2, '088', 1, '1705991667_16478f5677ed80024429.png', NULL),
(4, 16237198, 1588, '0009462792', 'Prayogi', 'Surabaya', 'Surabaya', '2024-02-06', 1, '082142986420', 1, '1730795277_2c90a704f437d06049b1.jpg', NULL),
(6, 15001, 5115, '0016237302', 'ICA AGUSTINA', 'ICA', 'GRESIK', '2010-02-01', 2, '081332315985', 1, '1714024015_bf6d8f7becb9288e590d.png', '$2y$10$yXHe4o9eiSEYZY/H0HJ7/ugRu/Sd3VDTaYKJL1t7CJs4oo4yLPBNu'),
(7, 16001, NULL, '0016232990', 'DEDI PASWARA', 'DEDI', 'SURABAYA', '1999-05-04', 1, '08123068329', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_siswa_absen`
--

CREATE TABLE `t_siswa_absen` (
  `id_siswa_absen` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `tgl_absen` date DEFAULT NULL,
  `sts_absen` int(11) DEFAULT NULL,
  `ket_absen` longtext DEFAULT NULL,
  `id_tapel` int(11) DEFAULT NULL,
  `tgl_entri` datetime DEFAULT NULL,
  `sts_approve` int(11) DEFAULT NULL,
  `tgl_approve` datetime DEFAULT NULL,
  `file` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_siswa_absen`
--

INSERT INTO `t_siswa_absen` (`id_siswa_absen`, `id_siswa`, `tgl_absen`, `sts_absen`, `ket_absen`, `id_tapel`, `tgl_entri`, `sts_approve`, `tgl_approve`, `file`) VALUES
(7, 6, '2024-07-19', 2, 'Sakit demam', 1, '2024-07-18 15:37:18', 1, '2024-07-18 15:48:34', '1721291838_4385af8b95b505e07171.jpg'),
(8, 6, '2024-08-13', 2, 'Sakit', 2, '2024-08-03 10:09:48', 0, '2024-08-03 10:09:48', '1722654588_ec401ae01b498d7de03a.png'),
(9, 6, '2024-08-07', 3, 'IJin bepergian', 2, '2024-08-05 14:16:37', 0, '2024-08-05 14:16:37', '1722842197_ded6cef050732c90d872.jpg'),
(10, 2, '2024-08-29', 2, 'Sakit Flu', 2, '2024-08-31 08:24:00', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_siswa_hadir`
--

CREATE TABLE `t_siswa_hadir` (
  `id_siswa_hadir` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `id_tapel` int(11) DEFAULT NULL,
  `tgl_hadir` date DEFAULT NULL,
  `sts_hadir` int(11) DEFAULT NULL,
  `jam` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_siswa_hadir`
--

INSERT INTO `t_siswa_hadir` (`id_siswa_hadir`, `id_siswa`, `id_tapel`, `tgl_hadir`, `sts_hadir`, `jam`) VALUES
(102, 4, 2, '2024-11-05', 0, '15:44:16'),
(103, 4, 2, '2024-11-05', 1, '15:44:44'),
(104, 2, 2, '2024-11-09', 0, '06:20:00'),
(105, 2, 2, '2024-11-09', 1, '16:20:00'),
(106, 4, 2, '2024-11-10', 0, '10:18:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_siswa_rombel`
--

CREATE TABLE `t_siswa_rombel` (
  `id_siswa_rombel` int(11) NOT NULL,
  `id_tapel` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `id_rombel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_siswa_rombel`
--

INSERT INTO `t_siswa_rombel` (`id_siswa_rombel`, `id_tapel`, `id_siswa`, `id_rombel`) VALUES
(14, 1, 1, 1),
(15, 1, 2, 2),
(16, 1, 3, 1),
(17, 1, 4, 3),
(18, 1, 6, 7),
(19, 1, 7, 4),
(20, 2, 1, 8),
(26, 2, 2, 9),
(27, 2, 3, 9),
(31, 2, 4, 9),
(32, 2, 6, 10),
(33, 2, 7, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_total_point`
--

CREATE TABLE `t_total_point` (
  `id_total_point` int(11) NOT NULL,
  `id_ptk` int(11) NOT NULL,
  `bln` int(11) NOT NULL,
  `thn` int(11) NOT NULL,
  `jml_point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_total_point`
--

INSERT INTO `t_total_point` (`id_total_point`, `id_ptk`, `bln`, `thn`, `jml_point`) VALUES
(5, 1, 10, 2024, 5),
(6, 10, 10, 2024, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_total_point_siswa`
--

CREATE TABLE `t_total_point_siswa` (
  `id_total_point` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `bln` int(11) NOT NULL,
  `id_tapel` int(11) NOT NULL,
  `jml_point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_total_point_siswa`
--

INSERT INTO `t_total_point_siswa` (`id_total_point`, `id_siswa`, `bln`, `id_tapel`, `jml_point`) VALUES
(1, 4, 10, 2, 5),
(2, 1, 11, 2, 5),
(3, 4, 11, 2, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_user`
--

CREATE TABLE `t_user` (
  `id_user` int(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(300) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `level` int(2) NOT NULL,
  `foto` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_user`
--

INSERT INTO `t_user` (`id_user`, `username`, `password`, `nama`, `level`, `foto`) VALUES
(1, 'andi@gmail.com', '$2y$10$1TmAQQJAqKuBV3Xxp7Bk/u6UVPqy35SRuJ5.RHjhqC2J4XpYGaiBO', 'admin', 1, '1731383334_538dae7b3c1720f979e2.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `libur`
--
ALTER TABLE `libur`
  ADD PRIMARY KEY (`id_libur`);

--
-- Indeks untuk tabel `libur_besar`
--
ALTER TABLE `libur_besar`
  ADD PRIMARY KEY (`id_liburbesar`);

--
-- Indeks untuk tabel `r_hari`
--
ALTER TABLE `r_hari`
  ADD PRIMARY KEY (`id_hari`);

--
-- Indeks untuk tabel `r_tapel`
--
ALTER TABLE `r_tapel`
  ADD PRIMARY KEY (`id_tapel`);

--
-- Indeks untuk tabel `r_tingkat_kelas`
--
ALTER TABLE `r_tingkat_kelas`
  ADD PRIMARY KEY (`id_tingkat_kelas`);

--
-- Indeks untuk tabel `t_point`
--
ALTER TABLE `t_point`
  ADD PRIMARY KEY (`id_point`),
  ADD UNIQUE KEY `id_ptk` (`id_ptk`,`tgl_point`);

--
-- Indeks untuk tabel `t_point_siswa`
--
ALTER TABLE `t_point_siswa`
  ADD PRIMARY KEY (`id_point`);

--
-- Indeks untuk tabel `t_rombel`
--
ALTER TABLE `t_rombel`
  ADD PRIMARY KEY (`id_rombel`);

--
-- Indeks untuk tabel `t_setting_aplikasi`
--
ALTER TABLE `t_setting_aplikasi`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indeks untuk tabel `t_siswa`
--
ALTER TABLE `t_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `t_siswa_absen`
--
ALTER TABLE `t_siswa_absen`
  ADD PRIMARY KEY (`id_siswa_absen`);

--
-- Indeks untuk tabel `t_siswa_hadir`
--
ALTER TABLE `t_siswa_hadir`
  ADD PRIMARY KEY (`id_siswa_hadir`),
  ADD UNIQUE KEY `id_siswa` (`id_siswa`,`id_tapel`,`tgl_hadir`,`sts_hadir`);

--
-- Indeks untuk tabel `t_siswa_rombel`
--
ALTER TABLE `t_siswa_rombel`
  ADD PRIMARY KEY (`id_siswa_rombel`);

--
-- Indeks untuk tabel `t_total_point`
--
ALTER TABLE `t_total_point`
  ADD PRIMARY KEY (`id_total_point`);

--
-- Indeks untuk tabel `t_total_point_siswa`
--
ALTER TABLE `t_total_point_siswa`
  ADD PRIMARY KEY (`id_total_point`);

--
-- Indeks untuk tabel `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `libur`
--
ALTER TABLE `libur`
  MODIFY `id_libur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `libur_besar`
--
ALTER TABLE `libur_besar`
  MODIFY `id_liburbesar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `r_hari`
--
ALTER TABLE `r_hari`
  MODIFY `id_hari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `r_tapel`
--
ALTER TABLE `r_tapel`
  MODIFY `id_tapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `r_tingkat_kelas`
--
ALTER TABLE `r_tingkat_kelas`
  MODIFY `id_tingkat_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `t_point`
--
ALTER TABLE `t_point`
  MODIFY `id_point` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `t_point_siswa`
--
ALTER TABLE `t_point_siswa`
  MODIFY `id_point` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `t_rombel`
--
ALTER TABLE `t_rombel`
  MODIFY `id_rombel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `t_setting_aplikasi`
--
ALTER TABLE `t_setting_aplikasi`
  MODIFY `id_setting` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `t_siswa`
--
ALTER TABLE `t_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `t_siswa_absen`
--
ALTER TABLE `t_siswa_absen`
  MODIFY `id_siswa_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `t_siswa_hadir`
--
ALTER TABLE `t_siswa_hadir`
  MODIFY `id_siswa_hadir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT untuk tabel `t_siswa_rombel`
--
ALTER TABLE `t_siswa_rombel`
  MODIFY `id_siswa_rombel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `t_total_point`
--
ALTER TABLE `t_total_point`
  MODIFY `id_total_point` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `t_total_point_siswa`
--
ALTER TABLE `t_total_point_siswa`
  MODIFY `id_total_point` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
