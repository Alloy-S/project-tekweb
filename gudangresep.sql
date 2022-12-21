-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221113.0eded7bb43
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Des 2022 pada 04.24
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
  `name` varchar(100) NOT NULL,
  `privilage` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin_acc`
--

INSERT INTO `admin_acc` (`id`, `username`, `password`, `name`, `privilage`) VALUES
(1, 'gil123', '$2y$10$8oHZyJZyP.T4YbCiCAbf2.VyWQttnvsi4CO6adUssHLZkZKntJeJy', 'gilbert', 0),
(2, 'ipen123', '$2y$10$ZBG4GTX4ajo2DrnQzdu3IecLBKpWfX2rXitQEiyGPxsnQHYuFwLZO', 'Alloysius', 0),
(4, 'superadmin', '$2y$10$47KlOfq3kXOUN507kZvJoes.1Z8CV98bs/LW3bOX3ftl5yC91UbfG', 'Alloysius', 1),
(5, 'kar123', '$2y$10$JHToNu9UWaobqIyzyDMen.VBSEuvMJY6ci0v3FBzmklOJnt0odRZC', 'karen', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan`
--

CREATE TABLE `bahan` (
  `id_resep` int(11) NOT NULL,
  `takaran` varchar(30) NOT NULL,
  `jenis` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bahan`
--

INSERT INTO `bahan` (`id_resep`, `takaran`, `jenis`) VALUES
(1, '1 piring', 'nasi'),
(1, '2 butir', 'telur'),
(1, '1 sdm', 'bawang merah goreng'),
(1, 'secukupnya', 'minyak goreng'),
(1, '2 siung ', 'bawang putih'),
(1, '1/2 sdt', 'garam'),
(1, '1/4 sdt', 'penyedap masakan'),
(1, '1 buah', 'tomat'),
(1, '7 buah', 'cabai rawit'),
(1, '3 buah', 'cabai keriting'),
(1, 'sejumput', 'lada bubuk'),
(2, '1/4 kg ', 'tepung tapioka cap tani, saya '),
(2, '1 batang ', 'daun bawang, potong tipis'),
(2, '2 bh ', 'daun sop, potong tipis kecil-k'),
(2, '1/2 sdm ', 'garam halus'),
(2, '1/2 sdm ', 'royko rasa ayam'),
(2, '1/2 sdt ', 'merica bubuk'),
(2, 'secukupnya', 'Cuka pempek, resep cuka bisa l'),
(2, '150 ml', 'air, hanya pake setengah saja'),
(2, 'secukupnya', 'minyak sayut'),
(3, '1 kg', 'ketan'),
(3, '250 gr', 'gula jawa'),
(4, '1 bungkus', 'indomie'),
(4, '300 ml', 'air'),
(6, 'kjkjsafbsefw', 'asdlaknkabf'),
(6, 'asionajfef', 'asafabfeqfa'),
(6, 'asdaa', 'asfafqfa'),
(8, '1 buah', 'teh'),
(8, '150 ml', 'air panas'),
(8, '1 sdm', 'gula'),
(9, 'asfoianfna', 'sfKJBFG'),
(9, 'aflbjfajk af', 'ALSBFK;sg'),
(10, '2 ajja', 'bdajs '),
(10, '', ''),
(5, '15 sdm', 'tepung terigu'),
(5, '15 sdm', 'tepung tapioka'),
(5, '20 buah', 'tahu pong'),
(5, '2 siung', 'bawang putih'),
(5, '1 batang', 'saung bawang'),
(5, 'secukupnya', 'garam, lada bubuk, dan micin'),
(5, '150 ml', 'air panas'),
(7, '1 ton', 'nasi'),
(7, '500 kg', 'kunyit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `author` varchar(50) NOT NULL,
  `id_resep` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `reply` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `comments`
--

INSERT INTO `comments` (`comment_id`, `author`, `id_resep`, `comment`, `date_created`, `reply`) VALUES
(1, 'Anonymous', 8, 'trimakasih sangat membantu saja jadi bisa buat teh', '2022-12-21 01:55:04', NULL),
(2, 'admin', 1, 'asdfghjk', '2022-12-21 09:55:47', NULL),
(3, 'admin', 1, 'hgtyyff', '2022-12-21 09:55:55', 2),
(4, 'tipen123', 1, 'jskdjfasjd', '2022-12-21 09:57:34', NULL),
(5, 'adauhabda', 2, 'mantap', '2022-12-21 10:16:31', NULL),
(6, 'adauhabda', 2, 'bfabafbaf', '2022-12-21 10:16:37', 5),
(7, 'adauhabda', 2, 'yfsufbsub', '2022-12-21 10:16:44', NULL),
(8, 'Anonymous', 2, 'uhnuhnngdng', '2022-12-21 10:17:05', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`) VALUES
(1, 'makanan'),
(2, 'minuman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `langkah`
--

CREATE TABLE `langkah` (
  `id_resep` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `langkah` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `langkah`
--

INSERT INTO `langkah` (`id_resep`, `urutan`, `langkah`) VALUES
(1, 0, 'Siapkan semua bahan, kemudian panaskan minyak. '),
(1, 1, 'Masak telur orak-arik hingga matang. Sisihkan di tepi wajan. '),
(1, 2, 'Panaskan lagi sedikit minyak, tumis bumbu yang telah dihaluskan hingga harum dan matang.'),
(1, 3, 'Masukkan nasi ke dalam tumisan bumbu, aduk rata. Aduk rata juga bersama telur yang telah dimasak orak-arik.'),
(1, 4, 'Tambahkan taburan bawang merah goreng, koreksi rasa. '),
(1, 5, 'Angkat nasi goreng yang telah matang, sajikan selagi masih hangat bersama irisan buah mentimun, wortel dan daun bawang.'),
(2, 0, 'Buat dulu bahan biang, campurkan tepung tapioka+air larutkan terlebih dahulu, tambahkan merica, royco, garam, daun bawang dan daun sop. Campur rata'),
(2, 1, 'Didihkan di atas kompor aduk terus jangan smpe gosong, hingga adonan biang mengental dan air mengering'),
(2, 2, 'Masukan bahan biang di adonan tepung tapioka sisanya, aduk hingga semua tercampur rata, ulenin sampai kalis (jangan terlalu kalis biar ngak keras, cukup setengah kalis saja)'),
(2, 3, 'Lalu bentuk, berbentuk lempengan pempek, dan goreng pada minyak panas, lakukan sampai adonan habis'),
(2, 4, 'Tiriskan dan siap di santap. Selamat mencoba'),
(3, 0, 'di olah'),
(3, 1, 'di kukus'),
(3, 2, 'di makan'),
(4, 0, 'masak air hingga mendidih'),
(4, 1, 'masukan mie'),
(4, 2, 'setelah mie terurai, tiriskan'),
(4, 3, 'masukan bumbu'),
(4, 4, 'indomie siap di makan'),
(6, 0, 'asdalknnfoqef'),
(6, 1, 'asdobqfoakjffa'),
(6, 2, 'asdoabfbiJBFIUBiuefb'),
(8, 0, 'masukan teh ke air panas'),
(8, 1, 'masukan gula'),
(8, 2, 'tunggu hingga berubah menjadi kecoklatan dan aduk-aduk  '),
(9, 0, 'asoubbaigbaibg'),
(9, 1, 'asggkjabsgjb'),
(9, 2, 'as;jdbhsbg'),
(10, 0, 'jifmdj'),
(10, 1, 'njvidfnj'),
(10, 2, 'dvjisvjsds'),
(5, 0, 'Campurkan tepung terigu, garam, lada bubuk, penyedap, dan bawang putih yang sudah dihaluskan. Aduk rata.'),
(5, 1, 'Tambahkan sedikit demi sedikit air panas. Aduk pakai sendok.'),
(5, 2, 'Jika sudah tidak terlalu panas, boleh aduk dengan tangan sambil masukkan sedikit demi sedikit tepung tapioka. Uleni hingga kalis.'),
(5, 3, 'Belah tahu pong, masukkan adonan tepung ke dalam tahu. Ulangi hingga adonan habis.'),
(5, 4, 'Kukus cilok tahu hingga matang, sekitar 30 menit. Angkat dan sajikan.'),
(7, 0, 'asdada'),
(7, 1, 'gsdgshsh'),
(7, 2, 'gfgfasgfsgf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep`
--

CREATE TABLE `resep` (
  `id_resep` int(11) NOT NULL,
  `nama_resep` varchar(30) NOT NULL,
  `deskripsi` varchar(1000) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(255) NOT NULL,
  `author` varchar(30) NOT NULL,
  `likes` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `is_private` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `resep`
--

INSERT INTO `resep` (`id_resep`, `nama_resep`, `deskripsi`, `id_kategori`, `tanggal`, `gambar`, `author`, `likes`, `views`, `is_approved`, `is_private`) VALUES
(1, 'nasi goreng ', 'Nasi goreng menjadi salah satu makanan enak yang disukai oleh sebagian besar masyarakat Indonesia. Seiring dengan perkembangan zaman, nasi goreng pun terus mengalami perkembangan. Nasi goreng juga mulai dikenal oleh masyarakat dunia. ', 1, '2022-12-21', 'lbwjouor3a5rl5o87.png', 'gil123', 0, 7, 1, 0),
(2, 'cireng', 'Cemilan paling mudah untuk di buat, kebetulan stok cuka masih banyak karena Kemarin sempat buat pempek, lalu pempeknya habis, buat cireng deh.\r\nSimpel tapi ngenyangin.', 1, '2022-12-21', 'lbwjwgrz39uk3k097.png', 'gil123', 0, 2, 1, 0),
(3, 'putu', 'putu merupakan makanan tradisional', 1, '2022-12-21', 'lbwk0hg73638qgbqu.png', 'gil123', 0, 0, 1, 0),
(4, 'indomie', 'indomie seleraku', 1, '2022-12-21', 'lbwk6a4thm90nurr.png', 'gil123', 0, 0, 1, 0),
(5, 'cilok goreng', 'cilok alot', 1, '2022-12-21', 'lbwkfi5e2cigppamx.png', 'tipen123', 0, 0, 1, 0),
(6, 'opor ayam', 'aidasdkbkbgaibuofbajkb gak gk ebfiuwBF', 1, '2022-12-21', 'lbwkhgi93998715zj.png', 'tipen123', 0, 0, 1, 0),
(7, 'nasi kuning', 'lorem ipsum blablablablablablablablablab', 1, '2022-12-21', 'lbwkycf632gq5ye0w.png', 'tipen123', 0, 0, 1, 1),
(8, 'teh', 'es teh merupakan minuman terlezat', 2, '2022-12-21', 'lbwl25ri1teluxwpe.png', 'tipen123', 0, 3, 1, 0),
(9, 'pecel ', 'afkshgsigbaibgashnabgs', 1, '2022-12-21', 'lbx214sp23jjp7avn.png', 'admin', 0, 0, 1, 0),
(10, 'da', 'fehefu', 1, '2022-12-21', 'lbx2aii92azgz0brb.png', 'admin', 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `email`) VALUES
('adauhabda', '$2y$10$87OuXPnmhDJoIcl48AtrxuPFwJJUyBdpRFsDcFijYeFJpl9zBis56', 'karen', 'wkwk@email.com'),
('admin', '$2y$10$XnTpXHQuFABWxuuE1EaWX.H5kPBqEC/OEO7AZZAm71lA2nMhAT4j6', 'admin', 'admin@wkwk.com'),
('gil123', '$2y$10$5duuUsoJSkvIKPYO4ywX4uEhLFgwQ2AGF2.fYHFAjZWmRmK7sJpa6', 'gilbert', 'gil123@gmail.com'),
('tipen123', '$2y$10$QfthRAu/cP17azvhmyjAvuCoToh/nVcnbvexnR1DnikK5B4gcrz2W', 'karen', 'tipeen995@gmail.com');

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
  ADD KEY `reply` (`reply`),
  ADD KEY `comments_ibfk_1` (`id_resep`);

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
  ADD PRIMARY KEY (`id_resep`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `author` (`author`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_acc`
--
ALTER TABLE `admin_acc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `resep`
--
ALTER TABLE `resep`
  MODIFY `id_resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_resep`) REFERENCES `resep` (`id_resep`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `reply` FOREIGN KEY (`reply`) REFERENCES `comments` (`comment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `langkah`
--
ALTER TABLE `langkah`
  ADD CONSTRAINT `langkah_ibfk_1` FOREIGN KEY (`id_resep`) REFERENCES `resep` (`id_resep`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `author` FOREIGN KEY (`author`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `resep_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
