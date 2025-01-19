-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jun 2024 pada 20.04
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trustbuilder`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin1', 'admin1@example.com', '111'),
(2, 'admin2', 'admin2@example.com', '222'),
(3, 'admin3', 'admin3@example.com', '333'),
(0, 'admin99', 'admin11@gmail.com', '$2y$10$zvmdC0Zm3jP5tca6bh61Ke.IF.hGyQWlUMTTQGWVzkJMRbjhy9Kv6');

-- --------------------------------------------------------

--
-- Struktur dari tabel `blacklist`
--

CREATE TABLE `blacklist` (
  `id_blacklist` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `blacklist`
--

INSERT INTO `blacklist` (`id_blacklist`, `id_user`) VALUES
(16, 8),
(18, 10),
(19, 9),
(20, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `form_pendaftaran`
--

CREATE TABLE `form_pendaftaran` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telpon` varchar(20) DEFAULT NULL,
  `bukti_pembayaran` longblob DEFAULT NULL,
  `kontrak` longblob DEFAULT NULL,
  `request_pesanan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mitra`
--

CREATE TABLE `mitra` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `gambar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mitra`
--

INSERT INTO `mitra` (`id`, `username`, `email`, `password`, `gambar`) VALUES
(6, 'PT ALDI JAYA', 'aldijaya@gmail.com', '$2y$10$zfGBV.yvTeIIehgNFutzUuv5PpJeHvYFlGG2SwJsUF85jxQdIPFR6', 'uploads/logo-com6.png'),
(7, 'PT INDO SENGSARA', 'sejahtera12@gmai.com', '$2y$10$zfGBV.yvTeIIehgNFutzUuv5PpJeHvYFlGG2SwJsUF85jxQdIPFR6', 'uploads/1718213319_logo-com6.png'),
(12, 'PT KISUL JAYA SEKALI', 'jayajaya@gmail.com', '$2y$10$zfGBV.yvTeIIehgNFutzUuv5PpJeHvYFlGG2SwJsUF85jxQdIPFR6', 'uploads/1718212024_logo-com5.png'),
(13, 'PT SURYA SELINGKUH', 'surya@gmail.com', '$2y$10$zfGBV.yvTeIIehgNFutzUuv5PpJeHvYFlGG2SwJsUF85jxQdIPFR6', 'uploads/1718212292_logo-com3.png'),
(14, 'pt kekalik jaya', 'kekalikjaya@gmail.com', '$2y$10$zfGBV.yvTeIIehgNFutzUuv5PpJeHvYFlGG2SwJsUF85jxQdIPFR6', 'uploads/1718213067_logo-com2.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `portofolio`
--

CREATE TABLE `portofolio` (
  `id_portofolio` int(20) NOT NULL,
  `id_mitra` varchar(120) NOT NULL,
  `nama_rumah` varchar(150) NOT NULL,
  `harga_rumah` varchar(120) NOT NULL,
  `kontak` varchar(100) NOT NULL,
  `deskripsi` varchar(500) NOT NULL,
  `gambar_rumah` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `portofolio`
--

INSERT INTO `portofolio` (`id_portofolio`, `id_mitra`, `nama_rumah`, `harga_rumah`, `kontak`, `deskripsi`, `gambar_rumah`) VALUES
(5, '6', 'Modern House', 'RP. 500. 000. 000. 000. ', '', 'Rumah sangat indah dan rapi', '6669010c6f11a.png'),
(6, '6', 'Rumah Tipe 99', 'RP. 700. 000. 000. 000. ', '', 'Rumah dekat dengan Mall dan rumah sakit', '6669014c530cd.png'),
(7, '6', 'Rumah Tipe 100', 'RP. 500. 000. 000. 000. ', '', 'Rumah Bagus dan Juga Luas', '666901706b9c4.png'),
(8, '7', 'Old Money House', 'RP. 50 000. 000. 000. 000. ', '', 'Rumah Luas 100 Hektar dan Punya Perkebunan Sawit', '66690254d530a.png'),
(9, '8', 'tipe z', 'Rp90.000.000', '087934222111', 'bla bla bla', '6669b4b0ca87d.png'),
(10, '14', 'Rumah Jamur', 'RP. 700. 000. 000. 000. ', '08198239832', 'ssshhhhhhhhh', '6669d9e70cc4f.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `gambar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `gambar`) VALUES
(7, 'rizki', 'kisul@gmail.com', '$2y$10$Qhmyfy5x2zeDWWUQAc1z0OJsYtGsBY4FEh2OzY308Gj2xwbBaEgxu', '0'),
(8, 'maftuh', 'maftuh@gmail.com', '$2y$10$3M9g54CBWix5oC0X6iIt5uj.R7xZmk8Ky58N8s/RYuAvebkhv4YI6', '0'),
(9, 'kisul', 'rizkisyamsuli1206@gmail.com', '$2y$10$jKFqNznThE5BATf2oKMubeyhr6ZTVO4pVwnzOg398.r3Rg/lIf0Ku', 'uploads/1718213640_gambar.png'),
(10, 'nabila', 'nabila@gmail.com', '$2y$10$RXv1U9tO2JVImQhckl1EcePJ9nhXjoRj9zfhJolGljxYCRhDeC8T.', '0'),
(11, 'adit', 'adit@gmail.com', '$2y$10$iacwA0XGiXMqQuYUAGJ0qOQ8NT6ZdKwfzOrtrawmlv1XsoQSQnxuW', '0'),
(12, 'rifky', 'rifki@gmail.com', '$2y$10$b1I.IcLyNeYeDqsGNuSHIOq00qI3TeG.oTgaEDXJqKO61KwgeAm6i', '0'),
(13, 'kisul gagah', 'gagah@gmail.com', '$2y$10$PaEuOpI.hONvZs0y7sVSveN2FaF3a4D.qOiMly3ITdq76/Qi6X4wy', 'uploads/1718215296_gambar.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`id_blacklist`);

--
-- Indeks untuk tabel `form_pendaftaran`
--
ALTER TABLE `form_pendaftaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `portofolio`
--
ALTER TABLE `portofolio`
  ADD PRIMARY KEY (`id_portofolio`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `id_blacklist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `form_pendaftaran`
--
ALTER TABLE `form_pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `portofolio`
--
ALTER TABLE `portofolio`
  MODIFY `id_portofolio` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
