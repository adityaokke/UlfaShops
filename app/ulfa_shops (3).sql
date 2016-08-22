-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2015 at 03:21 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ulfa_shops`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftarkirims`
--

CREATE TABLE IF NOT EXISTS `daftarkirims` (
`id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `tanggal_kirim` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_terima` datetime DEFAULT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftarkirims`
--

INSERT INTO `daftarkirims` (`id`, `toko_id`, `tanggal_kirim`, `tanggal_terima`, `status`) VALUES
(49, 1, '2015-02-19 13:00:00', NULL, 'sampai'),
(50, 1, '2015-02-19 15:15:55', NULL, 'perjalanan');

-- --------------------------------------------------------

--
-- Table structure for table `detildaftarkirims`
--

CREATE TABLE IF NOT EXISTS `detildaftarkirims` (
`id` int(11) NOT NULL,
  `daftarkirim_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detildaftarkirims`
--

INSERT INTO `detildaftarkirims` (`id`, `daftarkirim_id`, `item_id`, `status`, `jumlah`) VALUES
(8, 49, 1, 'sampai', 20),
(9, 50, 1, '', 11);

-- --------------------------------------------------------

--
-- Table structure for table `gudangs`
--

CREATE TABLE IF NOT EXISTS `gudangs` (
`id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `satuan_grosir` int(11) NOT NULL,
  `lusin_grosir` int(11) NOT NULL,
  `lusin6_grosir` int(11) NOT NULL,
  `satuan_eceran` int(11) NOT NULL,
  `pcs3_eceran` int(11) NOT NULL,
  `lusin1_eceran` int(11) NOT NULL,
  `tanggal_masuk` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `item_id` int(11) NOT NULL,
  `kodebarang` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gudangs`
--

INSERT INTO `gudangs` (`id`, `quantity`, `satuan_grosir`, `lusin_grosir`, `lusin6_grosir`, `satuan_eceran`, `pcs3_eceran`, `lusin1_eceran`, `tanggal_masuk`, `item_id`, `kodebarang`) VALUES
(1, 940, 500, 600, 800, 1000, 2000, 3000, '2014-12-26 12:22:00', 1, 'KLMT0001'),
(2, 1470, 200, 300, 210, 400, 320, 100, '2014-12-26 12:23:00', 16, 'KLMT0002'),
(3, 2400, 2000, 2000, 1000, 2100, 3200, 2400, '2014-12-26 12:23:00', 17, 'KLMT0003'),
(4, 1000, 400, 500, 600, 700, 800, 900, '2014-12-26 12:42:00', 69, 'KLTE9999'),
(6, 450, 2000, 3000, 4000, 5000, 5000, 6000, '2014-12-29 07:23:00', 73, 'KLTE1111'),
(8, 200, 200, 200, 200, 200, 200, 200, '2014-12-30 01:53:00', 19, 'KLMT0004');

-- --------------------------------------------------------

--
-- Table structure for table `hargaunits`
--

CREATE TABLE IF NOT EXISTS `hargaunits` (
`id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `untung` bigint(20) NOT NULL,
  `itemtoko_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
`id` int(11) NOT NULL,
  `kodebarang` varchar(15) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nama_gambar` varchar(100) NOT NULL,
  `mime_type` varchar(55) NOT NULL,
  `file_path` varchar(150) NOT NULL,
  `transbeli_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `kodebarang`, `kategori_id`, `supplier_id`, `nama`, `nama_gambar`, `mime_type`, `file_path`, `transbeli_id`, `item_id`) VALUES
(1, 'KLMT0001', 3, 0, 'Kalung mote rumbai', 'Kl.mote rumbai ring.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(16, 'KLMT0002', 3, 0, 'Kalung mote batu pecah', 'Klmote batu pecah.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(17, 'KLMT0003', 3, 0, 'Kalung mote batu susun pendek', 'Klmote batu susun pndk.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(19, 'KLMT0004', 3, 0, 'Kalung mote ulir full', 'Klmote ulir full.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(20, 'KLMT0005', 3, 0, 'Kalung mote peace ring', 'Klmote peace ring.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(22, 'KLMT0007', 3, 0, 'Kalung mote taring besar', 'Klmote taring B.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(23, 'KLMT0008', 3, 0, 'Kalung mote taring kecil', 'Klmote taring K.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(24, 'KLMT0009', 3, 0, 'Kalung mote koin', 'Klmote koin.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(25, 'KLMT0010', 3, 0, 'Kalung mote koin tarik', 'Klmote koin tarik.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(29, 'KLMT0011', 3, 0, 'Kalung mote koin kecil', '', '', '', 0, 0),
(30, 'KLMT0012', 3, 0, 'Kalung mote tasbih', 'Klmote tasbih.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(31, 'KLMT0013', 3, 0, 'Kalung mote tasbih taring', 'Klmote tasbih taring.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(32, 'KLMT0014', 3, 0, 'Kalung mote limbad besar', 'Klmote limbad B.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(33, 'KLMT0015', 3, 0, 'Kalung mote limbad kecil', 'Klmote limbad K.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(34, 'KLMT0016', 3, 0, 'Kalung mote marvell taring', '', '', '', 0, 0),
(35, 'KLKY0001', 3, 0, 'Kalung kayu rumbai ukir ring', 'Klkayu rumbai ukir ring.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(36, 'KLKY0002', 3, 0, 'Kalung kayu rumbai atg ring', 'Klkayu rumbai atg ring.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(37, 'GLKY0001', 3, 0, 'Geelang kayu ukir 1cmase', 'camerancollage2014_05_08_210711.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(43, 'GLKY0007', 7, 0, 'Gelang kayu abstrak 1cm', 'Gl.kayu abstrak 1cm,.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(44, 'GLKY0008', 7, 0, 'Gelang kayu abstrak 2cm', '', '', '', 0, 0),
(45, 'GLKY0009', 7, 0, 'Gelang kayu abstrak 3cm', 'Gl.kayu abstrak 3cm.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(48, 'GLKY0012', 7, 0, 'Gelang kayu polos 2cm', 'Gl.kayu polos 2cm.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(49, 'GLKY0013', 7, 0, 'Gelang kayu polos 3cm', 'Gl.kayu polos 3cm.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(50, 'GLKY0014', 7, 0, 'Gelang kayu cat timbul 1cm', 'Gl.kayu cat timbul 1cm.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(51, 'GLKY0015', 7, 0, 'Gelang kayu cat timbul 2cm', 'Gl.kayu cat timbul 2cm.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(52, 'GLKY0016', 7, 0, 'Gelang kayu cat timbul 3cm', 'Gl.kayu cat timbul 3cm.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(53, 'GLKY0017', 7, 0, 'Gelang kayu cat timbul full 1cm', 'Gl.kayu cat timbul full 1cm.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(54, 'GLKY0018', 7, 0, 'Gelang kayu cat timbul full 2cm', 'Gl.kayu cat timbul full 2cm.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(55, 'GLKY0019', 7, 0, 'Gelang kayu cat timbul full 3cm', 'Gl.kayu cat timbul full 3cm.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(56, 'GLKY0020', 7, 0, 'Gelang kayu cat timbul segi 1cm', '', '', '', 0, 0),
(57, 'GLKY0021', 7, 0, 'Gelang kayu cat timbul segi 2cm', '', '', '', 0, 0),
(59, 'GLKY0023', 7, 0, 'Gelang kayu ukir segi 1cm', '', '', '', 0, 0),
(60, 'GLKY0024', 7, 0, 'Gelang kayu ukir segi 2cm', '', '', '', 0, 0),
(61, 'GLKY0025', 7, 0, 'Gelang kayu ukir segi 3cm', '', '', '', 0, 0),
(62, 'GLKY0026', 7, 0, 'Gelang kayu cat motif 1cm', 'Gl.kayu cat mtf 1cm.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(64, 'GLKY0028', 7, 0, 'Gelang elastis ukir', 'Gl.kayu ukir elastis.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(65, 'GLKY0029', 7, 0, 'Gelang elastis batik', 'Gl.kayu batik elastis.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(66, 'GLKY0030', 7, 0, 'Gelang elastis abstrak', 'Gl.kayu abstrak elastis.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(67, 'GLKY0031', 7, 0, 'Gelang elastis cat timbul', 'Gl.kayu cat timbul elastis.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(68, 'GLKY0032', 7, 0, 'Gelang elastis sono polos', 'Gl.kayu sono elastis.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(69, 'KLTE9999', 3, 0, 'test tambah itemes', '10578552_10202443205788977_1814350893_n (1).jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(73, 'KLTE1111', 3, 0, 'test tambah item 4', 'gambar.jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0),
(75, 'GLKY0006', 7, 0, 'TEST ubah', '10578552_10202443205788977_1814350893_n (1).jpg', 'image/jpeg', 'C:\\xampp\\htdocs\\cake-php\\app\\\\files\\photos\\Items\\', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `itemtokos`
--

CREATE TABLE IF NOT EXISTS `itemtokos` (
`id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `hargabeli` bigint(20) NOT NULL,
  `tanggal_masuk` datetime NOT NULL,
  `item_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemtokos`
--

INSERT INTO `itemtokos` (`id`, `quantity`, `hargabeli`, `tanggal_masuk`, `item_id`, `toko_id`) VALUES
(23, 35, 0, '2015-02-19 10:48:01', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE IF NOT EXISTS `kategoris` (
`id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `parent` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama`, `parent`) VALUES
(1, 'Kalung', 0),
(2, 'Gelang', 0),
(3, 'Etniks', 1),
(4, 'Rodium', 1),
(7, 'Kayu', 2),
(8, 'motor', 0),
(9, 'racing', 8);

-- --------------------------------------------------------

--
-- Table structure for table `laporanbarangs`
--

CREATE TABLE IF NOT EXISTS `laporanbarangs` (
  `id` int(11) NOT NULL,
  `kodebarang` varchar(55) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `tanggal_aksi` datetime NOT NULL,
  `satuan_grosir` int(11) NOT NULL,
  `lusin_grosir` int(11) NOT NULL,
  `lusin6_grosir` int(11) NOT NULL,
  `satuan_eceran` int(11) NOT NULL,
  `pcs3_eceran` int(11) NOT NULL,
  `lusin1_eceran` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `gudangs_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notabelis`
--

CREATE TABLE IF NOT EXISTS `notabelis` (
`id` int(11) NOT NULL,
  `penyedia_id` int(33) NOT NULL,
  `total_bayar` bigint(11) DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `hutang` bigint(20) NOT NULL,
  `tanggal_tempo` date NOT NULL,
  `bayar` bigint(20) NOT NULL,
  `keterangan` varchar(600) NOT NULL,
  `status` varchar(20) NOT NULL,
  `transbelis_count` int(11) NOT NULL,
  `transbeli_count` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notabelis`
--

INSERT INTO `notabelis` (`id`, `penyedia_id`, `total_bayar`, `tanggal`, `hutang`, `tanggal_tempo`, `bayar`, `keterangan`, `status`, `transbelis_count`, `transbeli_count`) VALUES
(41, 27, 606400, '2015-01-06 17:43:19', 0, '2015-01-07', 700000, 'oke', 'lunas', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `notajuals`
--

CREATE TABLE IF NOT EXISTS `notajuals` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pembeli_id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `jatuh_tempo` datetime NOT NULL,
  `status` varchar(100) NOT NULL,
  `harga_total` int(11) NOT NULL,
  `keuntungan_total` int(11) NOT NULL,
  `hutang` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notajuals`
--

INSERT INTO `notajuals` (`id`, `user_id`, `pembeli_id`, `tanggal`, `jatuh_tempo`, `status`, `harga_total`, `keuntungan_total`, `hutang`, `toko_id`) VALUES
(24, 3, 1, '2015-02-12 13:45:48', '0000-00-00 00:00:00', 'lunas', 14, 0, 0, 1),
(25, 3, 1, '2015-02-12 14:29:23', '2015-01-01 00:00:00', 'lunas', 28, 22, 10, 1),
(26, 3, 1, '2015-02-12 15:25:16', '2035-01-01 00:00:00', 'lunas', 14, 11, 100, 1),
(27, 3, 1, '2015-02-17 09:14:32', '0000-00-00 00:00:00', 'lunas', 10, 0, 0, 1),
(28, 3, 1, '2015-02-17 09:14:57', '0000-00-00 00:00:00', 'lunas', 20, 0, 0, 1),
(29, 3, 1, '2015-02-17 09:15:46', '2035-01-01 00:00:00', 'hutang', 20, 0, 10, 1),
(30, 3, 1, '2015-02-17 11:33:59', '0000-00-00 00:00:00', 'lunas', 15, 14, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembelis`
--

CREATE TABLE IF NOT EXISTS `pembelis` (
`id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kontak` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelis`
--

INSERT INTO `pembelis` (`id`, `nama`, `alamat`, `kontak`) VALUES
(1, 'okke', 'hahaha', 'keple'),
(2, 'jesy SAYANG', 'hATINYA OKKE', '092222');

-- --------------------------------------------------------

--
-- Table structure for table `penyedias`
--

CREATE TABLE IF NOT EXISTS `penyedias` (
`id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyedias`
--

INSERT INTO `penyedias` (`id`, `nama`, `alamat`, `telepon`) VALUES
(27, 'budi', 'jalan budi', '099999111'),
(28, 'bude', 'jalan bue', '08999911');

-- --------------------------------------------------------

--
-- Table structure for table `stock_shops`
--

CREATE TABLE IF NOT EXISTS `stock_shops` (
  `toko_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quatity` int(11) NOT NULL,
  `satuan_grosir` int(11) NOT NULL,
  `lusin_grosir` int(11) NOT NULL,
  `lusin6_grosir` int(11) NOT NULL,
  `satuan_eceran` int(11) NOT NULL,
  `pcs3_eceran` int(11) NOT NULL,
  `lusin1_eceran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_distribusi`
--

CREATE TABLE IF NOT EXISTS `tbl_distribusi` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_kirim`
--

CREATE TABLE IF NOT EXISTS `tbl_item_kirim` (
`id` int(11) NOT NULL,
  `distribusi_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quatity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nota_jual`
--

CREATE TABLE IF NOT EXISTS `tbl_nota_jual` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pembeli_id` int(11) NOT NULL,
  `transjual_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jatuh_tempo` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `harga_total` int(11) NOT NULL,
  `dibayar` int(11) NOT NULL,
  `keuntungan_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembeli`
--

CREATE TABLE IF NOT EXISTS `tbl_pembeli` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kontak` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_toko`
--

CREATE TABLE IF NOT EXISTS `tbl_toko` (
`id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kontak` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tokos`
--

CREATE TABLE IF NOT EXISTS `tokos` (
`id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kontak` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tokos`
--

INSERT INTO `tokos` (`id`, `nama`, `alamat`, `kontak`) VALUES
(1, 'toko Jogja', 'Jlan Flamboyan', '08980029'),
(2, 'asfdsfd', 'asdf', 'sadf');

-- --------------------------------------------------------

--
-- Table structure for table `transbelis`
--

CREATE TABLE IF NOT EXISTS `transbelis` (
`id` int(11) NOT NULL,
  `notabeli_id` int(11) NOT NULL,
  `gudangs_id` int(11) NOT NULL,
  `tanggal_beli` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transbelis`
--

INSERT INTO `transbelis` (`id`, `notabeli_id`, `gudangs_id`, `tanggal_beli`, `quantity`, `harga`, `total`) VALUES
(34, 41, 1, '2015-01-13', 20, 20, 400),
(35, 41, 2, '2015-01-07', 20, 300, 6000),
(36, 41, 3, '2015-01-15', 300, 2000, 600000);

-- --------------------------------------------------------

--
-- Table structure for table `transjuals`
--

CREATE TABLE IF NOT EXISTS `transjuals` (
`id` int(11) NOT NULL,
  `notajual_id` int(11) NOT NULL,
  `itemtoko_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `jumlah_unit` int(11) NOT NULL,
  `total_harga_jual` int(11) NOT NULL,
  `keuntungan` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transjuals`
--

INSERT INTO `transjuals` (`id`, `notajual_id`, `itemtoko_id`, `quantity`, `unit`, `jumlah_unit`, `total_harga_jual`, `keuntungan`) VALUES
(37, 24, 20, 1, 1, 0, 14, 0),
(38, 25, 20, 1, 1, 0, 14, 11),
(39, 25, 20, 1, 1, 0, 14, 11),
(40, 26, 20, 1, 1, 0, 14, 11),
(41, 27, 20, 1, 1, 0, 10, 0),
(42, 28, 20, 2, 1, 0, 20, 0),
(43, 29, 20, 2, 1, 0, 20, 0),
(44, 30, 20, 1, 6, 0, 15, 14);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
`id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `nama`) VALUES
(1, 'LUSIN'),
(6, '>6 lusin'),
(7, 'satuan grosir'),
(8, 'satuan ecer]'),
(9, 'grosir'),
(10, 'dos');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `role` varchar(200) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `nama_lengkap` varchar(200) DEFAULT NULL,
  `idhash` varchar(200) DEFAULT NULL,
  `toko_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`, `nama_lengkap`, `idhash`, `toko_id`) VALUES
(3, 'danny', '$2a$10$o8alX7lE4LzrffYHMB74A.gL7TAiyxjsrXV.tWX7vEKdLGlRVL0Ji', 'owner', '2014-12-23 03:19:01', '2014-12-23 04:12:14', 'danny aguswahyudi', '1db25bf6a7d1f0881bc7c9e7cb987d97', 0),
(4, 'managertoko', '$2a$10$RrFSZsaGrbAgFJn2v5poTej2dOyCpF8n7vLFHOCYlpGFaa5o6rJh.', 'manager toko', '2015-01-08 08:20:08', '2015-01-08 08:20:08', 'manager toko', '728cbe651215bf57f6d48fc44c96a6f2', 0),
(5, 'managergudang', '$2a$10$o/suneNNMqXQwrT3v5FSc.hijuNIwb3Jq5Rr6ClESXcvoFNfvVeMO', 'manager gudang', '2015-01-08 08:22:05', '2015-01-08 08:22:05', 'Manager Gudang', 'f25161c6eccf5621821014f8a456e627', 0),
(6, 'owner', '$2a$10$srLOjVFQnSFjGHO3NKYEAewvZ56BN0cBC4A.DtwoRfFWJeHzhCPyi', 'owner', '2015-01-08 08:22:28', '2015-01-08 08:22:28', 'Owner', '54240022b821569278177ef68a5639dd', 1),
(7, 'kasir', '$2a$10$uuv6..9Zh4zT2DX714kE7OrFggt0QVz.sjVg5xQ/NIMryYZ70Ymgq', 'kasir', '2015-01-08 08:22:54', '2015-01-08 08:22:54', 'Kasir', '15b2ae9815541d85f60b96c91e6c708d', 1),
(8, 'owner2', '$2a$10$61/wtGHX.bJTu.16rg3/AO.2MtVoDCkWR4FRdQNXDvwHPHnlxV6B2', 'owner', '2015-01-12 22:23:18', '2015-01-12 22:23:18', 'daniel', '562f71f97796f4d5d125704fef95da0f', 0),
(9, 'manajer1', '$2a$10$TSMJ/gEL5xOq0.OD9JteEue4tW9Xpuzna8N9p6Ckn7LnhMn3aE8le', 'manager gudang', '2015-01-14 00:26:30', '2015-01-14 00:26:30', 'test', 'fafcf7502c81adfcc197e46a2ecd2273', 0),
(10, 'okke', '$2a$10$RkoTdKA5VWjL31eupgW1GuxOqSdUWnO90XzGUbP7IUpdD.PoMrKfq', 'owner', '2015-01-21 07:44:53', '2015-01-28 13:56:26', 'okkesugi', '7f3d7f9c26add6684e777d91d12f5d8f', 1),
(11, 'kasirtoko', '$2a$10$GzjpTaIFS3E7ABPMYdiIbuz6ST/XUNMIZUe33aEE/1TJ1T1UeS3zC', 'kasir', '2015-02-05 15:00:45', '2015-02-05 15:00:45', 'kasir', '8793fb8e8243a44291686859d101b9fd', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftarkirims`
--
ALTER TABLE `daftarkirims`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detildaftarkirims`
--
ALTER TABLE `detildaftarkirims`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gudangs`
--
ALTER TABLE `gudangs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hargaunits`
--
ALTER TABLE `hargaunits`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemtokos`
--
ALTER TABLE `itemtokos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notabelis`
--
ALTER TABLE `notabelis`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notajuals`
--
ALTER TABLE `notajuals`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelis`
--
ALTER TABLE `pembelis`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penyedias`
--
ALTER TABLE `penyedias`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_distribusi`
--
ALTER TABLE `tbl_distribusi`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_item_kirim`
--
ALTER TABLE `tbl_item_kirim`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_nota_jual`
--
ALTER TABLE `tbl_nota_jual`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_toko`
--
ALTER TABLE `tbl_toko`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokos`
--
ALTER TABLE `tokos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transbelis`
--
ALTER TABLE `transbelis`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transjuals`
--
ALTER TABLE `transjuals`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
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
-- AUTO_INCREMENT for table `daftarkirims`
--
ALTER TABLE `daftarkirims`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `detildaftarkirims`
--
ALTER TABLE `detildaftarkirims`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `gudangs`
--
ALTER TABLE `gudangs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `hargaunits`
--
ALTER TABLE `hargaunits`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `itemtokos`
--
ALTER TABLE `itemtokos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `notabelis`
--
ALTER TABLE `notabelis`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `notajuals`
--
ALTER TABLE `notajuals`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `pembelis`
--
ALTER TABLE `pembelis`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `penyedias`
--
ALTER TABLE `penyedias`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tbl_distribusi`
--
ALTER TABLE `tbl_distribusi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_item_kirim`
--
ALTER TABLE `tbl_item_kirim`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_nota_jual`
--
ALTER TABLE `tbl_nota_jual`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_toko`
--
ALTER TABLE `tbl_toko`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tokos`
--
ALTER TABLE `tokos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transbelis`
--
ALTER TABLE `transbelis`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `transjuals`
--
ALTER TABLE `transjuals`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
