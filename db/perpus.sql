-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jan 2024 pada 18.11
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `anggota_id` char(8) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`anggota_id`, `nama`, `alamat`, `email`, `telepon`) VALUES
('1', 'Angga', 'Jerukwangi', 'angga@unisnu.ac.id', '085951612818');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `buku_id` char(8) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `pengarang` varchar(100) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `tahun_terbit` int(11) DEFAULT NULL,
  `sinopsis` text DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`buku_id`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `sinopsis`, `kategori_id`) VALUES
('B-1CMA', 'Cara Menjadi Angga', 'Angga', 'Airlangga', 2024, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec eleifend lorem. Cras blandit lectus gravida felis tincidunt, ac suscipit lacus malesuada. Vivamus urna enim, euismod quis dapibus et, dictum eu nisi. Proin eleifend iaculis sapien eget lacinia. Praesent sit amet metus nibh. Quisque felis enim, consequat sed ultricies at, tincidunt id elit. Pellentesque luctus, risus eget rhoncus porttitor, augue libero tincidunt tortor, eu faucibus mi enim eu libero. Duis eget mi non magna condimentum fringilla. Mauris eu purus scelerisque, maximus est bibendum, euismod odio. Duis porttitor ligula lectus. Sed vel metus at lectus faucibus varius.\r\n\r\n', 1),
('B-1HOA', 'History of Angga', 'Angga', 'Airlangga', 2023, 'Sejarah sosok angga', 2),
('B-1PMB', 'Pemrograman Mobile', 'Angga', 'Airlangga', 2020, 'tak da', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `katalog`
--

CREATE TABLE `katalog` (
  `katalog_id` char(8) NOT NULL,
  `buku_id` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `katalog`
--

INSERT INTO `katalog` (`katalog_id`, `buku_id`) VALUES
('B-1CMA0', 'B-1CMA'),
('B-1CMA1', 'B-1CMA'),
('B-1HOA2', 'B-1HOA'),
('B-1PMB0', 'B-1PMB'),
('B-1PMB1', 'B-1PMB'),
('B-1PMB2', 'B-1PMB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `nama_kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `nama_kategori`) VALUES
(1, 'Non Fiksi'),
(2, 'Sejarah'),
(9, 'Ilmiah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `peminjaman_id` int(11) NOT NULL,
  `buku_id` char(8) NOT NULL,
  `katalog_id` char(8) DEFAULT NULL,
  `anggota_id` char(8) DEFAULT NULL,
  `tanggal_peminjaman` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('dipinjam','kembali') DEFAULT 'dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`peminjaman_id`, `buku_id`, `katalog_id`, `anggota_id`, `tanggal_peminjaman`, `tanggal_kembali`, `status`) VALUES
(5, 'B-1PMB', 'B-1PMB0', '1', '2024-01-01', '2024-01-01', 'kembali'),
(6, 'B-1HOA', 'B-1HOA2', '1', '2024-01-01', '2024-01-01', 'kembali'),
(7, 'B-1HOA', 'B-1HOA1', '1', '2024-01-01', '2024-01-01', 'dipinjam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `pengembalian_id` int(11) NOT NULL,
  `peminjaman_id` int(11) DEFAULT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `denda` decimal(10,2) DEFAULT NULL,
  `status_pengembalian` enum('dikembalikan','terlambat') DEFAULT 'dikembalikan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengembalian`
--

INSERT INTO `pengembalian` (`pengembalian_id`, `peminjaman_id`, `tanggal_pengembalian`, `denda`, `status_pengembalian`) VALUES
(3, 5, '2024-01-01', '0.00', 'dikembalikan'),
(4, 6, '2024-01-01', '0.00', 'dikembalikan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `staff`
--

CREATE TABLE `staff` (
  `staff_id` char(8) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `sandi` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `staff`
--

INSERT INTO `staff` (`staff_id`, `nama`, `jabatan`, `email`, `telepon`, `sandi`) VALUES
('admin', 'angga', 'ceo', 'angga@librarylte.com', '083956431233', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`anggota_id`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`buku_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indeks untuk tabel `katalog`
--
ALTER TABLE `katalog`
  ADD PRIMARY KEY (`katalog_id`),
  ADD KEY `buku_id` (`buku_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`peminjaman_id`),
  ADD KEY `anggota_id` (`anggota_id`),
  ADD KEY `buku_id` (`buku_id`) USING BTREE;

--
-- Indeks untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`pengembalian_id`),
  ADD KEY `peminjaman_id` (`peminjaman_id`);

--
-- Indeks untuk tabel `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `peminjaman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `pengembalian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`) ON DELETE CASCADE ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `katalog`
--
ALTER TABLE `katalog`
  ADD CONSTRAINT `katalog_ibfk_1` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`buku_id`);

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`anggota_id`),
  ADD CONSTRAINT `peminjaman_ibfk_3` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`buku_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`peminjaman_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
