-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 05:06 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_saw`
--

-- --------------------------------------------------------

--
-- Table structure for table `ta_admin`
--

CREATE TABLE `ta_admin` (
  `admin_kode` varchar(255) NOT NULL,
  `admin_nama` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ta_admin`
--

INSERT INTO `ta_admin` (`admin_kode`, `admin_nama`, `admin_password`) VALUES
('0001', 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `ta_alternatif`
--

CREATE TABLE `ta_alternatif` (
  `alternatif_id` int(100) NOT NULL,
  `alternatif_kode` varchar(255) NOT NULL,
  `alternatif_nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ta_alternatif`
--

INSERT INTO `ta_alternatif` (`alternatif_id`, `alternatif_kode`, `alternatif_nama`) VALUES
(1, 'A01', 'Armita Dwi Cahyani'),
(2, 'A02', 'Bagas Adinata'),
(3, 'A03', 'Ichsanul Abid'),
(4, 'A04', 'Nune Fathih Aditya Widhagda'),
(5, 'A05', 'Magdalena Rohmannawati');

-- --------------------------------------------------------

--
-- Table structure for table `ta_kriteria`
--

CREATE TABLE `ta_kriteria` (
  `kriteria_id` int(100) NOT NULL,
  `kriteria_kode` varchar(255) NOT NULL,
  `kriteria_nama` varchar(255) NOT NULL,
  `kriteria_kategori` varchar(255) NOT NULL,
  `kriteria_bobot` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ta_kriteria`
--

INSERT INTO `ta_kriteria` (`kriteria_id`, `kriteria_kode`, `kriteria_nama`, `kriteria_kategori`, `kriteria_bobot`) VALUES
(1, 'C01', 'Kartu Indonesia Pintar (KIP) Recipients', 'benefit', 0.15),
(2, 'C02', 'Parents Income', 'cost', 0.2),
(3, 'C03', 'Parental Dependents', 'benefit', 0.15),
(4, 'C04', 'Program Keluarga Harapan (PKH) Participants', 'benefit', 0.15),
(5, 'C05', 'Kartu Keluarga Sejahtera (KKS) Holder', 'benefit', 0.15),
(6, 'C06', 'Orphan Status', 'benefit', 0.2);

-- --------------------------------------------------------

--
-- Table structure for table `ta_subkriteria`
--

CREATE TABLE `ta_subkriteria` (
  `subkriteria_id` int(100) NOT NULL,
  `subkriteria_kode` varchar(255) NOT NULL,
  `kriteria_kode` varchar(255) NOT NULL,
  `subkriteria_bobot` float NOT NULL,
  `subkriteria_keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ta_subkriteria`
--

INSERT INTO `ta_subkriteria` (`subkriteria_id`, `subkriteria_kode`, `kriteria_kode`, `subkriteria_bobot`, `subkriteria_keterangan`) VALUES
(1, 'S01', 'C01', 1, 'Non-Recipient'),
(2, 'S02', 'C01', 2, 'Recipient'),
(3, 'S03', 'C02', 1, '<= Rp500.000'),
(4, 'S04', 'C02', 2, 'Rp500.000 - Rp999.999'),
(5, 'S05', 'C02', 3, 'Rp1.000.000 - Rp1.999.999'),
(6, 'S06', 'C02', 4, 'Rp2.000.000 - Rp4.999.999'),
(7, 'S07', 'C02', 5, '>= Rp5.000.000'),
(8, 'S08', 'C03', 1, '1 Child'),
(9, 'S09', 'C03', 2, '2 Child'),
(10, 'S10', 'C03', 3, '3 Child'),
(11, 'S11', 'C03', 4, '4 Child'),
(12, 'S12', 'C03', 5, '>4 Child'),
(13, 'S13', 'C04', 1, 'Non-Participant'),
(14, 'S14', 'C04', 2, 'Participant'),
(15, 'S15', 'C05', 1, 'Non-Holder'),
(16, 'S16', 'C05', 2, 'Holder'),
(17, 'S17', 'C06', 1, 'Non-Orphan'),
(18, 'S18', 'C06', 2, 'Orphan');

-- --------------------------------------------------------

--
-- Table structure for table `ta_user`
--

CREATE TABLE `ta_user` (
  `user_kode` varchar(255) NOT NULL,
  `user_nama` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ta_user`
--

INSERT INTO `ta_user` (`user_kode`, `user_nama`, `user_password`) VALUES
('0001', 'ichsanulabid', 'ichabid08');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `nilai_id` int(100) NOT NULL,
  `alternatif_kode` varchar(255) NOT NULL,
  `kriteria_kode` varchar(255) NOT NULL,
  `nilai_faktor` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_nilai`
--

INSERT INTO `tb_nilai` (`nilai_id`, `alternatif_kode`, `kriteria_kode`, `nilai_faktor`) VALUES
(37, 'A01', 'C01', 2),
(38, 'A01', 'C02', 1),
(39, 'A01', 'C03', 2),
(40, 'A01', 'C04', 2),
(41, 'A01', 'C05', 1),
(42, 'A01', 'C06', 1),
(43, 'A02', 'C01', 2),
(44, 'A02', 'C02', 1),
(45, 'A02', 'C03', 5),
(46, 'A02', 'C04', 2),
(47, 'A02', 'C05', 1),
(48, 'A02', 'C06', 2),
(49, 'A03', 'C01', 2),
(50, 'A03', 'C02', 1),
(51, 'A03', 'C03', 1),
(52, 'A03', 'C04', 1),
(53, 'A03', 'C05', 2),
(54, 'A03', 'C06', 1),
(55, 'A04', 'C01', 1),
(56, 'A04', 'C02', 1),
(57, 'A04', 'C03', 1),
(58, 'A04', 'C04', 1),
(59, 'A04', 'C05', 1),
(60, 'A04', 'C06', 2),
(61, 'A05', 'C01', 1),
(62, 'A05', 'C02', 5),
(63, 'A05', 'C03', 1),
(64, 'A05', 'C04', 1),
(65, 'A05', 'C05', 1),
(66, 'A05', 'C06', 1),
(67, 'A06', 'C01', 2),
(68, 'A06', 'C02', 1),
(69, 'A06', 'C03', 1),
(70, 'A06', 'C04', 2),
(71, 'A06', 'C05', 1),
(72, 'A06', 'C06', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ta_alternatif`
--
ALTER TABLE `ta_alternatif`
  ADD PRIMARY KEY (`alternatif_id`);

--
-- Indexes for table `ta_kriteria`
--
ALTER TABLE `ta_kriteria`
  ADD PRIMARY KEY (`kriteria_id`);

--
-- Indexes for table `ta_subkriteria`
--
ALTER TABLE `ta_subkriteria`
  ADD PRIMARY KEY (`subkriteria_id`);

--
-- Indexes for table `ta_user`
--
ALTER TABLE `ta_user`
  ADD PRIMARY KEY (`user_kode`);

--
-- Indexes for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`nilai_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ta_alternatif`
--
ALTER TABLE `ta_alternatif`
  MODIFY `alternatif_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ta_kriteria`
--
ALTER TABLE `ta_kriteria`
  MODIFY `kriteria_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ta_subkriteria`
--
ALTER TABLE `ta_subkriteria`
  MODIFY `subkriteria_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  MODIFY `nilai_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
