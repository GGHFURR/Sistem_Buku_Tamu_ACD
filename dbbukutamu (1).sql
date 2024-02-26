-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2024 at 04:24 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbbukutamu`
--

-- --------------------------------------------------------

--
-- Table structure for table `ttamu`
--

CREATE TABLE `ttamu` (
  `id` int(3) NOT NULL,
  `tanggal` date NOT NULL,
  `Jam` time NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(85) NOT NULL,
  `perusahaan` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `bertemu` varchar(85) NOT NULL,
  `nope` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ttamu`
--

INSERT INTO `ttamu` (`id`, `tanggal`, `Jam`, `nama`, `jenis_kelamin`, `perusahaan`, `tujuan`, `bertemu`, `nope`) VALUES
(8, '2024-01-17', '00:00:00', 'Asep Wahyudin', 'Laki-laki', 'Angkasa Pura Learning Center', 'Bertemu dengan Manajer GA', 'Dadang Kosasih', '08274829473'),
(9, '2024-01-17', '04:05:21', 'Asep Wahyudin', 'Laki-laki', 'Angkasa Pura Learning Center', 'Bertemu dengan Manajer GA', 'Dadang Kosasih', '08274829473'),
(12, '2024-02-26', '04:12:17', 'Ganjar Pranowo', 'Perempuan', 'Partai Demokrasi Indonesia', 'Membahas ekonomi negara', 'Prabowo', '081378250442');

-- --------------------------------------------------------

--
-- Table structure for table `tuser`
--

CREATE TABLE `tuser` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `nama_pengguna` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tuser`
--

INSERT INTO `tuser` (`id_user`, `username`, `password`, `nama_pengguna`, `status`) VALUES
(1, 'resepsionis', '97659395', 'Resepsionis', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tuser2`
--

CREATE TABLE `tuser2` (
  `id_user` int(11) NOT NULL,
  `username` varchar(85) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_pengguna` varchar(85) NOT NULL,
  `status` varchar(85) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tuser2`
--

INSERT INTO `tuser2` (`id_user`, `username`, `password`, `nama_pengguna`, `status`) VALUES
(2, 'tes', 'b93939873fd4923043b9dec975811f66', 'tes', 'Aktif'),
(3, 'resepsionis', '27377a1b7ea0ae5a1bf5a7ec7d4a3a2f', 'resepsionis', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ttamu`
--
ALTER TABLE `ttamu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tuser`
--
ALTER TABLE `tuser`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tuser2`
--
ALTER TABLE `tuser2`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ttamu`
--
ALTER TABLE `ttamu`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tuser`
--
ALTER TABLE `tuser`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tuser2`
--
ALTER TABLE `tuser2`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
