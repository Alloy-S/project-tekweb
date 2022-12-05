-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221113.0eded7bb43
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Des 2022 pada 18.08
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
-- Database: `gudangresep`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_acc`
--

CREATE TABLE `admin_acc` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin_acc`
--

INSERT INTO `admin_acc` (`id`, `username`, `password`, `name`) VALUES
(1, 'gil123', '$2y$10$8oHZyJZyP.T4YbCiCAbf2.VyWQttnvsi4CO6adUssHLZkZKntJeJy', 'gilbert'),
(2, 'ipen123', '$2y$10$ZBG4GTX4ajo2DrnQzdu3IecLBKpWfX2rXitQEiyGPxsnQHYuFwLZO', 'Alloysius');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan`
--

CREATE TABLE `bahan` (
  `id_resep` int(11) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `takaran` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bahan`
--

INSERT INTO `bahan` (`id_resep`, `jenis`, `takaran`) VALUES
(1, 'Bawang', '2 siung'),
(1, 'Minyak', '2L'),
(9, 'Buah', 'selain mangga'),
(9, 'Gula Jawa', '500gr'),
(10, 'Minyak', 'gatau dah'),
(10, 'Ayam', 'punya tetangga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `author` varchar(50) NOT NULL,
  `resep_id` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `reply` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 0, 'asda'),
(1, 1, 'asda'),
(1, 2, 'dasd'),
(1, 0, 'goreng'),
(2, 1, 'rebus'),
(2, 2, 'godog'),
(3, 0, 'tuang kopi ke dalam cangkir'),
(3, 1, 'seduh dengan air panas'),
(3, 2, 'aduk-aduk hingga merata'),
(3, 3, 'tambah gula'),
(3, 4, 'tambah garam'),
(3, 5, 'jadi deh tinggal minum'),
(4, 0, 'asdaasd'),
(4, 1, 'asdadadsfgdhg'),
(4, 2, 'hfktuyikfkfghkm'),
(4, 3, 'asdad'),
(7, 0, 'qwert'),
(7, 1, 'asdf'),
(7, 2, 'zxcvb'),
(8, 0, 'langkah 1'),
(8, 1, 'langkah 2'),
(8, 2, 'langkah 3'),
(8, 3, 'langkah 4'),
(9, 0, 'iris buah'),
(9, 1, 'ulek gula jawa'),
(9, 2, 'tambah kacang'),
(10, 0, 'panaskan minyak'),
(10, 1, 'goreng ayam'),
(10, 2, 'selamat mencoba');

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep`
--

CREATE TABLE `resep` (
  `id_resep` int(11) NOT NULL,
  `nama_resep` varchar(30) NOT NULL,
  `deskripsi` varchar(1000) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(255) NOT NULL,
  `author` varchar(30) NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `is_private` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `resep`
--

INSERT INTO `resep` (`id_resep`, `nama_resep`, `deskripsi`, `kategori`, `tanggal`, `gambar`, `author`, `is_approved`, `is_private`) VALUES
(1, 'Nasi goreng sederhan', 'Nasi goreng merupakan makanan khas Indonesia, dan pada dasarnya sama seperti makanan Indonesia lainnya yang memiliki banyak sekali variasi. Meski sudah ada berbagai macam variasi, pada dasarnya nasi goreng adalah nasi yang digoreng yang kemudian ditambahi dengan berbagai bumbu untuk kenikmatan yang lebih lagi.', '', '2022-11-26', 'resep-nasi-goreng-jawa.jpg', 'admin', 0, 0),
(2, 'lkasandas', 'asdasdajsndkaj', '', '2022-11-26', '636dffb528c45.png', 'admin', 0, 0),
(3, 'asda', 'dasda', '', '2022-11-26', '63708b8d35637.jpg', 'admin', 0, 0),
(4, 'qwerty', 'qwerty', '', '2022-11-26', '63708c54216c2.png', 'admin2', 0, 0),
(5, 'kopi', 'kopi josss', '', '2022-11-26', '63708e6c90ecf.jpg', 'admin2', 0, 0),
(6, 'asda', 'asdasd', '', '2022-11-26', '637090071203b.png', 'admin2', 0, 0),
(7, 'adfada', 'dasdasda', '', '2022-11-26', '6370908cb44c7.png', 'admin2', 0, 0),
(8, 'pecel', 'pecel enak', '', '2022-11-26', '637f3c4586bff.jpg', 'admin', 0, 0),
(9, 'rujak', 'rujak jossss', '', '0000-00-00', '638246b240d31.jpg', 'admin', 0, 0),
(10, 'ayam goreng', 'enak enak enak', '', '2022-11-27', '638247b6ea95c.jpg', 'admin', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `email`) VALUES
(0, 'admin', '$2y$10$XnTpXHQuFABWxuuE1EaWX.H5kPBqEC/OEO7AZZAm71lA2nMhAT4j6', 'admin', 'admin@wkwk.com');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_acc`
--
ALTER TABLE `admin_acc`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bahan`
--
ALTER TABLE `bahan`
  ADD KEY `id_resep` (`id_resep`);

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `resep_id` (`resep_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `langkah`
--
ALTER TABLE `langkah`
  ADD KEY `id_resep` (`id_resep`);

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
-- AUTO_INCREMENT untuk tabel `admin_acc`
--
ALTER TABLE `admin_acc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bahan`
--
ALTER TABLE `bahan`
  ADD CONSTRAINT `bahan_ibfk_1` FOREIGN KEY (`id_resep`) REFERENCES `resep` (`id_resep`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`resep_id`) REFERENCES `resep` (`id_resep`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comments_resep_id` FOREIGN KEY (`resep_id`) REFERENCES `resep` (`id_resep`);

--
-- Ketidakleluasaan untuk tabel `langkah`
--
ALTER TABLE `langkah`
  ADD CONSTRAINT `langkah_ibfk_1` FOREIGN KEY (`id_resep`) REFERENCES `resep` (`id_resep`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
