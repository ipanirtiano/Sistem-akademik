-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2020 at 01:15 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_akademik_v3`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_admin` varchar(10) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `pendidikan_akhir` varchar(50) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telpon` varchar(15) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `kode_admin`, `nik`, `nip`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `pendidikan_akhir`, `agama`, `alamat`, `email`, `no_telpon`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'ADM-138039', '2009347169', '198503300567901259', 'Pandu Siregar', 'Samarinda', '15 Dec 2014', '', '', '', 'Jr. Baladewa No. 174, Tual 73592, DIY', 'zmardhiyah@yahoo.com', '0453 7054 779', 'default.jpg', '2020-09-26 13:57:52', '2020-09-26 13:57:52');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_guru` varchar(10) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `pendidikan_akhir` varchar(50) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telpon` varchar(15) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `kode_guru`, `nik`, `nip`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `pendidikan_akhir`, `agama`, `alamat`, `email`, `no_telpon`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'KDG-369039', '4090234247', '198503301234601379', 'Dwi Dzulqhori S.kom M.kom', 'Jakarta', '18 November 1995', 'Laki-Laki', '', '', '', '', '', 'default.jpg', '2020-09-26 14:19:00', '2020-09-26 14:19:00'),
(2, 'KDG-124012', '4092348068', '198503300124801467', 'Ika Mulyati S.kom M.kom', 'Jakarta', '10 Oktober 1990', 'Perempuan', '', '', '', '', '', 'default.jpg', '2020-09-26 14:19:22', '2020-09-26 14:19:22'),
(3, 'KDG-134147', '4092457678', '198503302346734579', 'Ipan irtiano S.kom M.kom', 'Indramayu', '03 November 1993', 'Laki-Laki', '', '', 'Tengarang Selatan', '', '', 'default.jpg', '2020-09-30 14:47:16', '2020-09-30 14:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `kode_kelas` varchar(10) NOT NULL,
  `ruang_kelas` varchar(20) NOT NULL,
  `tingkat` varchar(10) NOT NULL,
  `wali_kelas` varchar(50) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `kode_kelas`, `ruang_kelas`, `tingkat`, `wali_kelas`, `tahun`, `created_at`, `updated_at`) VALUES
(1, 'KLS-468458', 'A', '10', 'KDG-369039', '2020', '2020-09-30 15:35:05', '2020-09-30 15:35:05'),
(2, 'KLS-459239', 'B', '10', 'KDG-124012', '2020', '2020-09-30 15:47:48', '2020-09-30 15:47:48'),
(3, 'KLS-256128', 'C', '10', 'KDG-134147', '2020', '2020-09-30 15:54:46', '2020-09-30 15:54:46'),
(7, 'KLS-013349', 'A', '11', 'KDG-369039', '2020', '2020-09-30 16:06:06', '2020-09-30 16:06:06'),
(8, 'KLS-245258', 'B', '12', 'KDG-369039', '2020', '2020-10-01 03:55:12', '2020-10-01 03:55:12'),
(9, 'KLS-356045', 'A', '12', 'KDG-124012', '2020', '2020-10-01 03:55:25', '2020-10-01 03:55:25'),
(10, 'KLS-023269', 'B', '11', 'KDG-369039', '2020', '2020-10-01 03:55:52', '2020-10-01 03:55:52'),
(11, 'KLS-345456', 'C', '11', 'KDG-134147', '2020', '2020-10-01 03:56:00', '2020-10-01 03:56:00'),
(12, 'KLS-348689', 'C', '12', 'KDG-124012', '2020', '2020-10-01 03:56:09', '2020-10-01 03:56:09');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(10) NOT NULL,
  `alamat` varchar(60) NOT NULL,
  `penulis` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-09-04-165406', 'App\\Database\\Migrations\\Users', 'default', 'App', 1601146624, 1),
(2, '2020-09-05-200029', 'App\\Database\\Migrations\\Guru', 'default', 'App', 1601146625, 1),
(3, '2020-09-06-000047', 'App\\Database\\Migrations\\Admin', 'default', 'App', 1601146625, 1),
(4, '2020-09-23-154509', 'App\\Database\\Migrations\\Siswa', 'default', 'App', 1601146625, 1);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_siswa` varchar(10) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telpon` varchar(15) NOT NULL,
  `nama_asal_sekolah` varchar(255) NOT NULL,
  `alamat_asal_sekolah` varchar(255) NOT NULL,
  `nomor_ijazah` varchar(255) NOT NULL,
  `tahun_ijazah` varchar(255) NOT NULL,
  `nomor_skhun` varchar(255) NOT NULL,
  `tahun_skhun` varchar(255) NOT NULL,
  `nama_ayah` varchar(255) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `alamat_orangtua` varchar(255) NOT NULL,
  `telpon_orangtua` varchar(20) NOT NULL,
  `pekerjaan_ayah` varchar(255) NOT NULL,
  `pekerjaan_ibu` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `kode_siswa`, `nis`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `alamat`, `email`, `no_telpon`, `nama_asal_sekolah`, `alamat_asal_sekolah`, `nomor_ijazah`, `tahun_ijazah`, `nomor_skhun`, `tahun_skhun`, `nama_ayah`, `nama_ibu`, `alamat_orangtua`, `telpon_orangtua`, `pekerjaan_ayah`, `pekerjaan_ibu`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'KDS-147168', '2009347358', 'Ipan irtiano', 'Indramayu', '03 November 1993', 'Laki-Laki', '', 'Tangerang', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'default.jpg', '2020-09-26 14:00:01', '2020-09-26 14:00:01'),
(2, 'KDS-234379', '2009015369', 'Ahmad Maulana Mahdita', 'Tangerang', '11 November 1993', 'Laki-Laki', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'default.jpg', '2020-09-30 10:04:15', '2020-10-01 03:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_users` varchar(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_users`, `username`, `password`, `level`, `created_at`, `updated_at`) VALUES
(1, 'ADM-138039', '2009347169', '$2y$10$IjcpfAFCp4vw0M8bUXrFw.n0dkGkHmzqRH1ky4b91oJd7RTsiUuUa', 'admin', '2020-09-26 13:57:52', '2020-09-26 13:57:52'),
(2, 'KDS-147168', '2009347358', '$2y$10$bOQwc2rEpgRSptVyoELK1OaejLw/ORBjpoGb2FTSS/ntyQZ75ZMam', 'siswa', '2020-09-26 14:00:01', '2020-09-26 14:00:01'),
(3, 'KDG-369039', '4090234247', '$2y$10$g5mxkXrs7mB6KW1iyD7teuEsuCvOWk5ZZmnbI.3v2iLjvRuskSmce', 'guru', '2020-09-26 14:19:00', '2020-09-26 14:19:00'),
(4, 'KDG-124012', '4092348068', '$2y$10$1wl3yrpVPgEUA9WZC3zqSOoI0ivbIbG.J80lg0hHjGEhSv6BFM8pO', 'guru', '2020-09-26 14:19:22', '2020-09-26 14:19:22'),
(5, 'KDS-234379', '2009015369', '$2y$10$j5YvPEiWI/c1H/LuE/9.KuqVMMnn0zzbkJK4pGNKUM0YCXv4tslnq', 'siswa', '2020-09-30 10:04:15', '2020-10-01 03:56:28'),
(6, 'KDG-134147', '4092457678', '$2y$10$gKSvUKmoPKjJViYwlAjBAuRl3MeWzSONvC8/dXsiuJ3Aeoi.zFPMC', 'guru', '2020-09-30 14:47:16', '2020-09-30 14:47:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
