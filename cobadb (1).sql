-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221113.0eded7bb43
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Nov 2022 pada 08.06
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cobadb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `langkah`
--

CREATE TABLE `langkah` (
  `id_resep` int(30) NOT NULL,
  `urutan` int(11) NOT NULL,
  `langkah` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `langkah`
--

INSERT INTO `langkah` (`id_resep`, `urutan`, `langkah`) VALUES
(0, 0, 'asda'),
(0, 1, 'asda'),
(0, 2, 'dasd'),
(0, 0, 'goreng'),
(0, 1, 'rebus'),
(0, 2, 'godog'),
(0, 0, 'tuang kopi ke dalam cangkir'),
(0, 1, 'seduh dengan air panas'),
(0, 2, 'aduk-aduk hingga merata'),
(0, 3, 'tambah gula'),
(0, 4, 'tambah garam'),
(0, 5, 'jadi deh tinggal minum'),
(0, 0, 'asdaasd'),
(0, 1, 'asdadadsfgdhg'),
(0, 2, 'hfktuyikfkfghkm'),
(0, 3, 'asdad'),
(7, 0, 'qwert'),
(7, 1, 'asdf'),
(7, 2, 'zxcvb');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `NRP` varchar(9) NOT NULL,
  `username` varchar(30) NOT NULL,
  `NAMA` varchar(30) DEFAULT NULL,
  `DOMISILI` varchar(30) DEFAULT NULL,
  `ALAMAT` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`NRP`, `username`, `NAMA`, `DOMISILI`, `ALAMAT`) VALUES
('c14210248', 'admin', 'karen', 'malang', 'jl. jalan ke pasar minggu'),
('c14210265', 'admin', 'alloysius', 'salatiga', 'jl. menangis'),
('c14210267', 'djikstra', 'budi', 'surabaya', 'jl. jalan ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep`
--

CREATE TABLE `resep` (
  `id_resep` int(11) NOT NULL,
  `nama_resep` varchar(20) NOT NULL,
  `deskripsi` varchar(1000) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `author` varchar(30) NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `resep`
--

INSERT INTO `resep` (`id_resep`, `nama_resep`, `deskripsi`, `gambar`, `author`, `is_approved`) VALUES
(1, 'Nasi goreng sederhan', 'Nasi goreng merupakan makanan khas Indonesia, dan pada dasarnya sama seperti makanan Indonesia lainnya yang memiliki banyak sekali variasi. Meski sudah ada berbagai macam variasi, pada dasarnya nasi goreng adalah nasi yang digoreng yang kemudian ditambahi dengan berbagai bumbu untuk kenikmatan yang lebih lagi.', 'resep-nasi-goreng-jawa.jpg', 'admin', 0),
(2, 'lkasandas', 'asdasdajsndkaj', '636dffb528c45.png', 'admin', 0),
(3, 'asda', 'dasda', '63708b8d35637.jpg', 'admin', 0),
(4, 'qwerty', 'qwerty', '63708c54216c2.png', 'admin2', 0),
(5, 'kopi', 'kopi josss', '63708e6c90ecf.jpg', 'admin2', 0),
(6, 'asda', 'asdasd', '637090071203b.png', 'admin2', 0),
(7, 'adfada', 'dasdasda', '6370908cb44c7.png', 'admin2', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `email`) VALUES
(1, 'admin', 'admin', '', ''),
(2, 'super', 'super', '', ''),
(3, 'gilbert', 'gilbert', '', ''),
(4, 'djikstra', 'analisisalgo123', '', ''),
(5, 'admin2', 'admin2', 'admin2', 'wkwk@email.com');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`NRP`);

--
-- Indeks untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`id_resep`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `resep`
--
ALTER TABLE `resep`
  MODIFY `id_resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
