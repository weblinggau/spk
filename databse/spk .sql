-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 22 Okt 2021 pada 06.09
-- Versi server: 8.0.18
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_isian`
--

CREATE TABLE `data_isian` (
  `id_data` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_isian`
--

INSERT INTO `data_isian` (`id_data`, `id_mahasiswa`) VALUES
(1, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kriteria`
--

CREATE TABLE `data_kriteria` (
  `id_data` int(50) NOT NULL,
  `nama_kriteria` text COLLATE utf8mb4_general_ci NOT NULL,
  `bobot` int(50) NOT NULL,
  `bobot_w` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('B','C') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_kriteria`
--

INSERT INTO `data_kriteria` (`id_data`, `nama_kriteria`, `bobot`, `bobot_w`, `status`) VALUES
(1, 'Nilai Raport', 4, '0.25', 'B'),
(2, 'Prestasi Akademik', 5, '0.3125', 'B'),
(10, 'Pengahasilan Orang Tua', 4, '0.25', 'C'),
(12, 'Prestasi Non Akademik', 3, '0.1875', 'B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_perhitungan`
--

CREATE TABLE `data_perhitungan` (
  `id_ref` int(20) NOT NULL,
  `id_mahasiswa` int(20) NOT NULL,
  `id_kriteria` int(20) NOT NULL,
  `nilai_ref` text COLLATE utf8mb4_general_ci NOT NULL,
  `nilai_vektor_s` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_perhitungan`
--

INSERT INTO `data_perhitungan` (`id_ref`, `id_mahasiswa`, `id_kriteria`, `nilai_ref`, `nilai_vektor_s`) VALUES
(1, 7, 1, '85', ''),
(2, 7, 2, '23', ''),
(3, 7, 10, '67', ''),
(4, 7, 12, '36', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `dokumen` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_mahasiswa`, `tanggal`, `dokumen`) VALUES
(4, 6, '2021-08-26', 'DOK20210823122741.docx');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nis` varchar(10) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `no_kk` varchar(50) DEFAULT NULL,
  `nama_mahasiswa` varchar(100) DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fakultas` varchar(50) DEFAULT NULL,
  `prodi` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `id_user`, `nis`, `nik`, `no_kk`, `nama_mahasiswa`, `no_telepon`, `email`, `fakultas`, `prodi`, `keterangan`, `foto`) VALUES
(6, 11, '3432224553', '360899846767587', '287497389589987', 'Rifqi Rifaldi', '0877632576411', 'surisalbi303@gmail.com', 'Teknologi dan Informatika', 'Sistem Informasi', 'mahasiswa teladan', 'IMG20210823122413.jpg'),
(7, 15, '121222111', '360899846767587', '2874973895899891', 'Samsul Hadi', '085282380292', 'samsul@gmail.com', 'Teknologi dan Informatika', 'Sistem Informasi', 'Ini keterangan ya', 'IMG20210904033727.png'),
(9, 16, '2321313111', '360899846767587', '2874973895899891', 'Roy', '085282380292', 'roy@hotmail.com', 'Teknologi dan Informatika', 'Sistem Informasi', 'Ini keterangan ya', 'IMG20210909064841.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_kriteria`
--

CREATE TABLE `nilai_kriteria` (
  `id_nilai_kriteria` int(11) NOT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `sk_peringkat` varchar(100) DEFAULT NULL,
  `raport` varchar(100) DEFAULT NULL,
  `sertifikat` varchar(100) DEFAULT NULL,
  `sktm` varchar(100) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `nilai_kriteria`
--

INSERT INTO `nilai_kriteria` (`id_nilai_kriteria`, `id_mahasiswa`, `sk_peringkat`, `raport`, `sertifikat`, `sktm`, `status`, `tanggal`) VALUES
(9, 6, 'SK_PERINGKAT20210913030601.docx', 'RAPORT20210913031039.docx', 'SERTIFIKAT20210913031107.docx', 'SKTM20210913031053.pdf', 'Sudah Verifikasi', '2021-08-30'),
(13, 9, 'SK_PERINGKAT20210909065109.docx', 'RAPORT20210909065109.docx', 'SERTIFIKAT20210909065109.docx', 'SKTM20210909065109.docx', 'Belum Verifikasi', '2021-09-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(11) NOT NULL,
  `keterangan` text,
  `dokumen` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `keterangan`, `dokumen`, `tanggal`) VALUES
(2, 'Pengumuman kelulusan penerimaan beasiswa', 'DOK20210823122633.docx', '2021-08-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pimpinan`
--

CREATE TABLE `pimpinan` (
  `id_pimpinan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_pimpinan` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pimpinan`
--

INSERT INTO `pimpinan` (`id_pimpinan`, `id_user`, `nama_pimpinan`, `email`, `jenis_kelamin`, `foto`) VALUES
(3, 10, 'Asep Sujana', 'asepsujana@gmail.com', 'Laki-laki', 'IMG20210823122718.jpg'),
(4, 13, 'Alex', 'alex@gmail.com', 'Laki-laki', 'IMG20210825030000.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting_kelulusan`
--

CREATE TABLE `setting_kelulusan` (
  `id_setting` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_user`, `email`, `level`, `created`, `updated`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', 'admin@administrator.id', 1, '2021-08-15', '2021-08-16'),
(10, 'asep', '549e6da6a3f49abd9369f06d222f1d323e127643', 'Asep Sujana', 'asepsujana@gmail.com', 2, '2021-08-23', NULL),
(11, 'rifqi', 'd77a5e354be9cb8f2a3c83a841ed84baa2abc267', 'Rifqi Rifaldi', 'surisalbi303@gmail.com', 3, '2021-08-23', NULL),
(13, 'alex', '60c6d277a8bd81de7fdde19201bf9c58a3df08f4', 'Alex', 'alex@gmail.com', 2, '2021-08-25', NULL),
(14, 'rian', '4116e0e25dcad2dd4b202b3eaf2b4f1ae6497e25', 'Rian Ghani', 'rian@gmali.com', 2, '2021-08-26', NULL),
(15, 'samsul', '1a47cb7bfe681cdb71e6032d304986fafbca63bd', 'Samsul Hadi', 'samsul@gmail.com', 3, '2021-09-04', NULL),
(16, 'roy', 'ae685575101ee7165c90a8f2c30c6e60cdd9e482', 'Roy', 'roy@hotmail.com', 3, '2021-09-09', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_isian`
--
ALTER TABLE `data_isian`
  ADD PRIMARY KEY (`id_data`);

--
-- Indeks untuk tabel `data_kriteria`
--
ALTER TABLE `data_kriteria`
  ADD PRIMARY KEY (`id_data`);

--
-- Indeks untuk tabel `data_perhitungan`
--
ALTER TABLE `data_perhitungan`
  ADD PRIMARY KEY (`id_ref`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indeks untuk tabel `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD PRIMARY KEY (`id_nilai_kriteria`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indeks untuk tabel `pimpinan`
--
ALTER TABLE `pimpinan`
  ADD PRIMARY KEY (`id_pimpinan`);

--
-- Indeks untuk tabel `setting_kelulusan`
--
ALTER TABLE `setting_kelulusan`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_isian`
--
ALTER TABLE `data_isian`
  MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `data_kriteria`
--
ALTER TABLE `data_kriteria`
  MODIFY `id_data` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `data_perhitungan`
--
ALTER TABLE `data_perhitungan`
  MODIFY `id_ref` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  MODIFY `id_nilai_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pimpinan`
--
ALTER TABLE `pimpinan`
  MODIFY `id_pimpinan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `setting_kelulusan`
--
ALTER TABLE `setting_kelulusan`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
