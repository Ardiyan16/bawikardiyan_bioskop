-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Agu 2022 pada 06.09
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_bioskop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `auth`
--

INSERT INTO `auth` (`id`, `username`, `password`, `status`) VALUES
(1, 'admin', 'admin', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bioskop`
--

CREATE TABLE `bioskop` (
  `kd_bioskop` varchar(15) NOT NULL,
  `nama_bioskop` varchar(120) DEFAULT NULL,
  `alamat_bioskop` varchar(150) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bioskop`
--

INSERT INTO `bioskop` (`kd_bioskop`, `nama_bioskop`, `alamat_bioskop`, `kota`) VALUES
('ARB', 'ardiyan bioskop', 'Jember', 'Jember');

-- --------------------------------------------------------

--
-- Struktur dari tabel `film`
--

CREATE TABLE `film` (
  `kd_film` varchar(15) NOT NULL,
  `judul_film` varchar(150) DEFAULT NULL,
  `tgl_launc` date DEFAULT NULL,
  `synopys` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `film`
--

INSERT INTO `film` (`kd_film`, `judul_film`, `tgl_launc`, `synopys`) VALUES
('RW001', 'Run Winner', '2022-08-11', '<p>Film ini bercerita tentang...</p>'),
('WY002', 'Away', '2022-08-10', '<p>bercerita tentang bla bla</p>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi_tiket`
--

CREATE TABLE `reservasi_tiket` (
  `kd_tiket` varchar(100) NOT NULL,
  `nama` varchar(75) NOT NULL,
  `kode_film` varchar(100) DEFAULT NULL,
  `kode_bioskop` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `no_kursi` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `reservasi_tiket`
--

INSERT INTO `reservasi_tiket` (`kd_tiket`, `nama`, `kode_film`, `kode_bioskop`, `tanggal`, `no_kursi`) VALUES
('TIKET001', 'Aji Pratama', 'RW001', 'ARB', '2022-08-08', 'KURSI001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tayang`
--

CREATE TABLE `tayang` (
  `kd_tayang` varchar(30) NOT NULL,
  `kode_film` varchar(150) DEFAULT NULL,
  `tgl_waktu` datetime DEFAULT NULL,
  `jumlah_kursi` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tayang`
--

INSERT INTO `tayang` (`kd_tayang`, `kode_film`, `tgl_waktu`, `jumlah_kursi`) VALUES
('ARB202208101030RW00100001', 'RW001', '2022-08-10 10:30:00', 100);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bioskop`
--
ALTER TABLE `bioskop`
  ADD PRIMARY KEY (`kd_bioskop`);

--
-- Indeks untuk tabel `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`kd_film`);

--
-- Indeks untuk tabel `reservasi_tiket`
--
ALTER TABLE `reservasi_tiket`
  ADD PRIMARY KEY (`kd_tiket`);

--
-- Indeks untuk tabel `tayang`
--
ALTER TABLE `tayang`
  ADD PRIMARY KEY (`kd_tayang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
