-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Sep 2023 pada 04.56
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailpesanan`
--

CREATE TABLE `detailpesanan` (
  `iddetailpesanan` int(11) NOT NULL,
  `idpesanan` int(11) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detailpesanan`
--

INSERT INTO `detailpesanan` (`iddetailpesanan`, `idpesanan`, `idproduk`, `qty`) VALUES
(2, 3, 3, 10),
(33, 8, 11, 1),
(34, 8, 13, 1),
(35, 9, 12, 5),
(36, 9, 12, 5),
(37, 9, 12, 5),
(38, 10, 11, 10),
(39, 10, 12, 10),
(40, 10, 13, 10),
(41, 10, 14, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `tanggalmasuk` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idproduk`, `qty`, `tanggalmasuk`) VALUES
(1, 5, 6, '2023-09-15 02:20:18'),
(2, 6, 100, '2023-09-16 13:08:15'),
(3, 4, 150, '2023-09-16 14:08:05'),
(6, 4, 1000, '2023-09-17 01:50:28'),
(10, 4, 100, '2023-09-17 01:54:56'),
(11, 11, 100, '2023-09-17 02:46:22'),
(12, 12, 90, '2023-09-17 02:46:30'),
(13, 13, 80, '2023-09-17 02:46:37'),
(14, 14, 70, '2023-09-17 02:46:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `idpelanggan` int(11) NOT NULL,
  `namapelanggan` varchar(20) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`idpelanggan`, `namapelanggan`, `notelp`, `alamat`) VALUES
(6, 'Eri', '082323232323', 'Sukabumi'),
(7, 'Maulana', '082121131538', 'Indonesia'),
(8, 'Eri Maulana', '085724175825', 'Sukabumi, Indonesia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `idpesanan` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `idpelanggan` int(11) NOT NULL,
  `idproduk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`idpesanan`, `tanggal`, `idpelanggan`, `idproduk`) VALUES
(8, '2023-09-17 02:52:08', 6, 0),
(9, '2023-09-17 02:52:42', 7, 0),
(10, '2023-09-17 02:52:56', 8, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `idproduk` int(11) NOT NULL,
  `namabarang` varchar(35) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`idproduk`, `namabarang`, `deskripsi`, `harga`, `stock`) VALUES
(11, 'Buku ', 'bindex', 35000, 89),
(12, 'Buku ', 'buku gambar', 20000, 65),
(13, 'Pensil', '2b', 5000, 69),
(14, 'Pensil', 'joyko', 5000, 60);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`iduser`, `username`, `password`) VALUES
(1, 'eri', 'eri'),
(2, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detailpesanan`
--
ALTER TABLE `detailpesanan`
  ADD PRIMARY KEY (`iddetailpesanan`);

--
-- Indeks untuk tabel `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`idpelanggan`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`idpesanan`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detailpesanan`
--
ALTER TABLE `detailpesanan`
  MODIFY `iddetailpesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `idpelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `idpesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
