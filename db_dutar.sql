-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12 Jun 2019 pada 03.06
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
  `no_surat_jalan` varchar(50) NOT NULL,
  `tanggal_faktur` date DEFAULT NULL,
  `deskripsi_sewa` varchar(50) DEFAULT NULL,
  `rincian_service` varchar(100) DEFAULT NULL,
  `total_biaya` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `faktur`
--

INSERT INTO `faktur` (`no_faktur`, `no_surat_jalan`, `tanggal_faktur`, `deskripsi_sewa`, `rincian_service`, `total_biaya`) VALUES
('F123', 'S123/DS/ASD', '2019-06-06', 'Biaya Sewa 2', 'Besin', 40000000);

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

--
-- Dumping data untuk tabel `kendaraan`
--

INSERT INTO `kendaraan` (`nomor_polisi`, `merk_type`, `harga_sewa`, `tahun_keluaran`) VALUES
('B 8493 KWL', 'Yamaha', 4000000, 2017),
('D 1231 DA', 'Suzuki', 2000000, 2010),
('D 8493 GC', 'Toyota', 3000000, 2011);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanda_terima`
--

DROP TABLE IF EXISTS `tanda_terima`;
CREATE TABLE `tanda_terima` (
  `no_tanda_terima` varchar(50) NOT NULL,
  `no_surat_jalan` varchar(50) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `terbilang` varchar(255) DEFAULT NULL,
  `uang_sejumlah` bigint(20) DEFAULT NULL,
  `untuk_pembayaran` varchar(100) DEFAULT NULL,
  `sisa_pembayaran` bigint(20) DEFAULT NULL,
  `rincian_biaya` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tanda_terima`
--

INSERT INTO `tanda_terima` (`no_tanda_terima`, `no_surat_jalan`, `tanggal`, `terbilang`, `uang_sejumlah`, `untuk_pembayaran`, `sisa_pembayaran`, `rincian_biaya`) VALUES
('001/VIII/2018-RENT', 'S123/DS/ASD', '2019-06-12', 'dua juta rupiah', 2000000, 'sewa', 38000000, 'rincian'),
('002/VIII/2018-RENT', 'S123/DS/ASD', '2019-06-13', 'satu juta rupiah', 1000000, 'sewa bayar', 37000000, 'rincian'),
('003/VIII/2018-RENT', 'S123/DS/ASD', '2019-06-11', 'dua juta', 2000000, 'sewa', 34000000, 'rincian'),
('004/VIII/2018-RENT', 'S123/DS/ASD', '2019-06-14', 'tiga puluh empat juta', 34000000, 'sewa', 0, 'rincian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `no_surat_jalan` varchar(50) NOT NULL,
  `nomor_polisi` varchar(12) NOT NULL,
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
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`no_surat_jalan`, `nomor_polisi`, `driver`, `no_golongan_sim`, `penjemputan`, `tgl_dibuat_surat_jln`, `tmpt_dibuat_surat_jln`, `penyewa`, `telepon`, `tujuan`, `tgl_keberangkatan`, `tgl_kedatangan`, `keterangan`) VALUES
('e', 'D 1231 DA', '-', '', 'd', '2019-06-06', 'm', 'm', '0', 'm', '2019-06-06 00:00:00', '2019-06-12 00:00:00', 'Belum Lunas'),
('S123/DS/ASD', 'D 8493 GC', 'Maman', 'A', 'BDG', '2019-03-29', 'BDG', 'Arif', '0293821343', 'JKT', '2019-05-31 00:00:00', '2019-05-31 00:00:00', 'Lunas'),
('S123/DS/ASD12', 'D 8493 GC', '-', '-', 'Bandung', '2019-05-15', 'Cimahi', 'Arif', '085223279159', 'Jakarta', '2019-06-12 00:00:00', '2019-06-12 00:00:00', 'Belum Lunas'),
('S123/DS/ASD123', 'B 8493 KWL', '-', '-', 'Bandung', '2019-06-04', 'Cimahi', 'D\'Best Sofia Hotel', '085223279159', 'Jakarta', '2019-06-21 00:00:00', '2019-06-21 00:00:00', 'Belum Lunas'),
('S123/DS/ASD1234', 'B 8493 KWL', '-', '-', 'Bandung', '2017-04-10', 'Cimahi', 'Arif', '085223279159', 'Jakarta', '2019-06-13 00:00:00', '2019-06-14 00:00:00', 'Belum Lunas');

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
  ADD KEY `fk_faktur_relations_transaks` (`no_surat_jalan`);

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
  ADD KEY `fk_tanda_te_relations_transaks` (`no_surat_jalan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_surat_jalan`),
  ADD KEY `fk_transaks_relations_kendaraa` (`nomor_polisi`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `faktur`
--
ALTER TABLE `faktur`
  ADD CONSTRAINT `fk_faktur_relations_transaks` FOREIGN KEY (`no_surat_jalan`) REFERENCES `transaksi` (`no_surat_jalan`);

--
-- Ketidakleluasaan untuk tabel `tanda_terima`
--
ALTER TABLE `tanda_terima`
  ADD CONSTRAINT `fk_tanda_te_relations_transaks` FOREIGN KEY (`no_surat_jalan`) REFERENCES `transaksi` (`no_surat_jalan`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaks_relations_kendaraa` FOREIGN KEY (`nomor_polisi`) REFERENCES `kendaraan` (`nomor_polisi`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
