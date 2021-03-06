-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2019 at 02:07 AM
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
-- Database: `kpbarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `pass` varchar(70) NOT NULL,
  `foto` text NOT NULL,
  `level` enum('admin','karyawan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `uname`, `pass`, `foto`, `level`) VALUES
(9, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'XVnx.gif', 'admin'),
(10, 'karyawan1', '8962cdff20ba8d7428cf77c4f1ed6d05', '', 'karyawan'),
(12, 'karyawan2', 'a3dcb4d229de6fde0db5686dee47145d', '', 'karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `jenis` text NOT NULL,
  `suplier` text NOT NULL,
  `modal` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `jenis`, `suplier`, `modal`, `harga`, `jumlah`, `sisa`, `foto`) VALUES
(35, 'Kerudung A', 'rabani', 'Pabrik A', 100000, 150000, 78, 100, ''),
(37, 'Kerudung B', 'Kerudung', 'Toko Kerudung A', 20000, 25000, 32215, 100, 'Picture1.png'),
(38, 'Jilbab', 'Jilbab', 'Mana ya', 5000, 6000, 213208, 10, ''),
(39, 'oli', 'minyak', 'pabrik oli', 30000, 40000, 90, 100, ''),
(40, 'jeans', 'celana', 'a', 100000, 150000, 50, 50, ''),
(41, 'dffds', 'dsfsdf', 'dfsdfs', 100000, 150000, 12, 50, ''),
(45, 'cxz', 'sdsdsd', 'sdsdsd', 100000, 150000, 15, 15, ''),
(47, 'dfsdfdsdfsdfdsf', 'dfdsfdsfsdf', 'sdfdsfdsf', 100000, 150000, 8, 9, '1.PNG'),
(48, 'sdsdsad', 'asdasdsa', 'asdasdas', 100000, 150000, -5, 1, 'Capture.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `barang_laku`
--

CREATE TABLE `barang_laku` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total_harga` int(20) NOT NULL,
  `laba` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_laku`
--

INSERT INTO `barang_laku` (`id`, `tanggal`, `nama`, `jumlah`, `harga`, `total_harga`, `laba`) VALUES
(77, '2019-02-06', 'Kerudung A', 1, 141000, 141000, 41000),
(78, '0000-00-00', 'Kerudung A', 1, 150000, 150000, 50000),
(79, '0000-00-00', 'Kerudung A', 10, 135000, 1350000, 350000),
(80, '2019-02-06', 'Jilbab', 5, 6000, 30000, 5000),
(81, '2019-02-06', 'Jilbab', 10, 5640, 56400, 6400),
(82, '2019-07-23', 'oli', 10, 40000, 400000, 100000),
(86, '2019-07-23', 'Kerudung B', 2, 23500, 47000, 7000),
(87, '2019-07-18', 'Kerudung B', 9, 23500, 211500, 31500),
(88, '0000-00-00', 'sdsdsad', 10, 150000, 1500000, 500000),
(89, '2019-08-10', 'dfsdfdsdfsdfdsf', 1, 150000, 150000, 50000);

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
-- Table structure for table `reseller`
--

CREATE TABLE `reseller` (
  `id_reseller` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(70) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `nama_reseller` varchar(50) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reseller`
--

INSERT INTO `reseller` (`id_reseller`, `username`, `password`, `no_hp`, `nama_reseller`, `foto`) VALUES
(3, 'yaqi', '4297f44b13955235245b2497399d7a93', '1234567890', 'Yaqi', ''),
(4, 'awaw', 'd41d8cd98f00b204e9800998ecf8427e', '123123123123', 'awawawa', ''),
(5, 'yhuhuuua', 'd41d8cd98f00b204e9800998ecf8427e', '12314235345', 'yhuhuuu', ''),
(8, 'dida', 'b9343bdbf698cbc25b1528b0512e6210', '12312312323424', 'dida', ''),
(11, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', '085726096515', 'rilas', 'peace.gif'),
(15, 'sani', '7815696ecbf1c96e6894b779456d330e', '0882123123123', 'Rafli Firdausy Irawan', '');

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
-- Indexes for table `barang_laku`
--
ALTER TABLE `barang_laku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reseller`
--
ALTER TABLE `reseller`
  ADD PRIMARY KEY (`id_reseller`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `barang_laku`
--
ALTER TABLE `barang_laku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reseller`
--
ALTER TABLE `reseller`
  MODIFY `id_reseller` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
