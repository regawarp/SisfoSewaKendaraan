-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25 Mei 2019 pada 06.21
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dutar`
--
CREATE DATABASE IF NOT EXISTS `db_dutar` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_dutar`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `account`
--

INSERT INTO `account` (`username`, `password`, `status`) VALUES
('a', 'a', 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `faktur`
--

DROP TABLE IF EXISTS `faktur`;
CREATE TABLE `faktur` (
  `no_faktur` varchar(50) NOT NULL,
  `nomor_polisi` varchar(12) NOT NULL,
  `no_surat_jalan` varchar(50) NOT NULL,
  `tanggal_faktur` date DEFAULT NULL,
  `deskripsi_sewa` varchar(50) DEFAULT NULL,
  `rincian_service` varchar(100) DEFAULT NULL,
  `total_biaya` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kendaraan`
--

DROP TABLE IF EXISTS `kendaraan`;
CREATE TABLE `kendaraan` (
  `nomor_polisi` varchar(12) NOT NULL,
  `merk_type` varchar(75) DEFAULT NULL,
  `harga_sewa` bigint(20) DEFAULT NULL,
  `tahun_keluaran` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanda_terima`
--

DROP TABLE IF EXISTS `tanda_terima`;
CREATE TABLE `tanda_terima` (
  `no_tanda_terima` varchar(50) NOT NULL,
  `nomor_polisi` varchar(12) NOT NULL,
  `no_surat_jalan` varchar(50) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `terbilang` varchar(255) DEFAULT NULL,
  `uang_sejumlah` bigint(20) DEFAULT NULL,
  `untuk_pembayaran` varchar(100) DEFAULT NULL,
  `sisa_pembayaran` bigint(20) DEFAULT NULL,
  `rincian_biaya` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `nomor_polisi` varchar(12) NOT NULL,
  `no_surat_jalan` varchar(50) NOT NULL,
  `no_faktur` varchar(50) DEFAULT NULL,
  `driver` varchar(75) DEFAULT NULL,
  `no_golongan_sim` varchar(10) DEFAULT NULL,
  `penjemputan` varchar(100) DEFAULT NULL,
  `tgl_dibuat_surat_jln` date DEFAULT NULL,
  `tmpt_dibuat_surat_jln` varchar(30) DEFAULT NULL,
  `penyewa` varchar(75) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `tujuan` varchar(30) DEFAULT NULL,
  `tgl_keberangkatan` datetime DEFAULT NULL,
  `tgl_kedatangan` datetime DEFAULT NULL,
  `keterangan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `faktur`
--
ALTER TABLE `faktur`
  ADD PRIMARY KEY (`no_faktur`),
  ADD KEY `relationship_3_fk` (`nomor_polisi`,`no_surat_jalan`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`nomor_polisi`);

--
-- Indexes for table `tanda_terima`
--
ALTER TABLE `tanda_terima`
  ADD PRIMARY KEY (`no_tanda_terima`),
  ADD KEY `relationship_4_fk` (`nomor_polisi`,`no_surat_jalan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`nomor_polisi`,`no_surat_jalan`),
  ADD KEY `relationship_1_fk` (`nomor_polisi`),
  ADD KEY `relationship_2_fk` (`no_faktur`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
