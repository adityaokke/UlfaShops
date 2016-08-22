-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Aug 22, 2016 at 01:27 PM
-- Server version: 5.5.50-cll
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ulfashys_ulfashops`
--
CREATE DATABASE IF NOT EXISTS `ulfashys_ulfashops` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ulfashys_ulfashops`;

-- --------------------------------------------------------

--
-- Table structure for table `daftarkirims`
--

CREATE TABLE IF NOT EXISTS `daftarkirims` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `toko_id` int(11) NOT NULL,
  `tanggal_kirim` datetime NOT NULL,
  `tanggal_terima` datetime DEFAULT NULL,
  `status` enum('sampai','rusak','hilang','perjalanan') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `detildaftarkirims`
--

CREATE TABLE IF NOT EXISTS `detildaftarkirims` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `daftarkirim_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `gudangs`
--

CREATE TABLE IF NOT EXISTS `gudangs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` int(11) NOT NULL,
  `tanggal_masuk` datetime NOT NULL,
  `item_id` int(11) NOT NULL,
  `kodebarang` varchar(40) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=952 ;

-- --------------------------------------------------------

--
-- Table structure for table `hargaunits`
--

CREATE TABLE IF NOT EXISTS `hargaunits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `itemtoko_id` int(11) NOT NULL,
  `untung` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5234 ;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodebarang` varchar(15) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nama_gambar` varchar(100) NOT NULL,
  `mime_type` varchar(55) NOT NULL,
  `file_path` varchar(150) NOT NULL,
  `transbeli_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1047 ;

-- --------------------------------------------------------

--
-- Table structure for table `itemtokos`
--

CREATE TABLE IF NOT EXISTS `itemtokos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` int(11) NOT NULL,
  `hargabeli` bigint(20) NOT NULL,
  `tanggal_masuk` datetime NOT NULL,
  `item_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=755 ;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE IF NOT EXISTS `kategoris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `parent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

-- --------------------------------------------------------

--
-- Table structure for table `laporanbarangs`
--

CREATE TABLE IF NOT EXISTS `laporanbarangs` (
  `id` int(11) NOT NULL,
  `kodebarang` varchar(55) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `tanggal_aksi` datetime NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `gudangs_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notabelis`
--

CREATE TABLE IF NOT EXISTS `notabelis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `penyedia_id` int(33) NOT NULL,
  `total_bayar` bigint(11) DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT NULL,
  `hutang` bigint(20) NOT NULL,
  `tanggal_tempo` date NOT NULL,
  `bayar` bigint(20) NOT NULL,
  `keterangan` varchar(600) NOT NULL,
  `status` varchar(20) NOT NULL,
  `transbelis_count` int(11) NOT NULL,
  `transbeli_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `notajuals`
--

CREATE TABLE IF NOT EXISTS `notajuals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pembeli` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `jatuh_tempo` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `harga_total` int(11) NOT NULL,
  `potong` int(11) NOT NULL,
  `keuntungan_total` int(11) NOT NULL,
  `hutang` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1579 ;

-- --------------------------------------------------------

--
-- Table structure for table `pembelis`
--

CREATE TABLE IF NOT EXISTS `pembelis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kontak` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `penyedias`
--

CREATE TABLE IF NOT EXISTS `penyedias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_kirim`
--

CREATE TABLE IF NOT EXISTS `tbl_item_kirim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `distribusi_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quatity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nota_jual`
--

CREATE TABLE IF NOT EXISTS `tbl_nota_jual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pembeli_id` int(11) NOT NULL,
  `transjual_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jatuh_tempo` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `harga_total` int(11) NOT NULL,
  `dibayar` int(11) NOT NULL,
  `keuntungan_total` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kontak` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tokos`
--

CREATE TABLE IF NOT EXISTS `tokos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kontak` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `transbelis`
--

CREATE TABLE IF NOT EXISTS `transbelis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notabeli_id` int(11) NOT NULL,
  `gudangs_id` int(11) NOT NULL,
  `tanggal_beli` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transjuals`
--

CREATE TABLE IF NOT EXISTS `transjuals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notajual_id` int(11) NOT NULL,
  `itemtoko_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `jumlah_unit` float NOT NULL,
  `total_harga_jual` int(11) NOT NULL,
  `keuntungan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5487 ;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `isi_unit` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `role` varchar(200) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `nama_lengkap` varchar(200) DEFAULT NULL,
  `idhash` varchar(200) DEFAULT NULL,
  `toko_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
