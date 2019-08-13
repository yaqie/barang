-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2019 at 08:42 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kpbarang2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `pass` varchar(70) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `foto` text NOT NULL,
  `otp` varchar(6) NOT NULL,
  `level` enum('admin','karyawan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `uname`, `pass`, `nohp`, `foto`, `otp`, `level`) VALUES
(9, 'admin', '21232f297a57a5a743894a0e4a801fc3', '081225271335', 'user.jpg', '533934', 'admin'),
(10, 'karyawan1', '21232f297a57a5a743894a0e4a801fc3', '087823028388', 'user.jpg', '505984', 'karyawan'),
(12, 'karyawan2', '21232f297a57a5a743894a0e4a801fc3', '0895357948031', '', '', 'karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `id_jenis` int(5) NOT NULL,
  `id_supplier` int(5) NOT NULL,
  `modal` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `id_jenis`, `id_supplier`, `modal`, `harga`, `jumlah`, `sisa`, `foto`) VALUES
(1, 'Kerudung A', 1, 3, 50000, 100000, 164, 10, 'ks_zoya_-_kreatif_depan_grey_1000x.webp'),
(3, 'Kerudung B', 1, 3, 30000, 50000, 99, 100, 'ks_zoya_-_kreatif_depan_grey_1000x.webp'),
(4, 'jilbab pashmina biru', 4, 3, 100000, 120000, 97, 100, 'ks_zoya_-_kreatif_depan_grey_1000x.webp');

-- --------------------------------------------------------

--
-- Table structure for table `barang_jual`
--

CREATE TABLE `barang_jual` (
  `id_barang_jual` int(11) NOT NULL,
  `id_barang_laku` varchar(10) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_jual`
--

INSERT INTO `barang_jual` (`id_barang_jual`, `id_barang_laku`, `id_barang`, `jumlah`, `harga`) VALUES
(3, '6', '4', 3, '120000'),
(4, '8', '1', 2, '100000');

-- --------------------------------------------------------

--
-- Table structure for table `barang_laku`
--

CREATE TABLE `barang_laku` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` text NOT NULL,
  `jenis` enum('member','umum') NOT NULL DEFAULT 'umum',
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total_harga` int(20) NOT NULL,
  `laba` int(11) NOT NULL,
  `bayar` varchar(15) NOT NULL,
  `kembali` varchar(15) NOT NULL,
  `id_karyawan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_laku`
--

INSERT INTO `barang_laku` (`id`, `tanggal`, `nama`, `jenis`, `jumlah`, `harga`, `total_harga`, `laba`, `bayar`, `kembali`, `id_karyawan`) VALUES
(6, '2019-08-13', '', 'umum', 0, 0, 120000, 60000, '150000', '30000', 0),
(8, '2019-08-13', '', 'umum', 0, 0, 100000, 100000, '100000', '0', 10);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id_jenis` int(5) NOT NULL,
  `nama_jenis` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id_jenis`, `nama_jenis`) VALUES
(1, 'kerudung'),
(4, 'Jilbab');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_reseller` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(70) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `nama_reseller` varchar(50) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_reseller`, `username`, `password`, `no_hp`, `nama_reseller`, `foto`) VALUES
(18, '', '', '081225271335', 'umty', '');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keperluan` text NOT NULL,
  `nama` text NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `tanggal`, `keperluan`, `nama`, `jumlah`) VALUES
(1, '2015-02-06', 'de', 'diki', 1234);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(5) NOT NULL,
  `nama_supplier` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`) VALUES
(3, 'rita');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_jual`
--
ALTER TABLE `barang_jual`
  ADD PRIMARY KEY (`id_barang_jual`);

--
-- Indexes for table `barang_laku`
--
ALTER TABLE `barang_laku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_reseller`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `barang_jual`
--
ALTER TABLE `barang_jual`
  MODIFY `id_barang_jual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `barang_laku`
--
ALTER TABLE `barang_laku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id_jenis` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_reseller` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
