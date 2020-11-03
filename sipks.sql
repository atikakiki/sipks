-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Nov 2020 pada 13.04
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipks`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_pengajuan`
--

CREATE TABLE `daftar_pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `judul_pengajuan` varchar(255) NOT NULL,
  `deskripsi_pengajuan` varchar(255) NOT NULL,
  `nama_pembuat_pengajuan` varchar(50) NOT NULL,
  `jabatan_pembuat_pengajuan` varchar(50) NOT NULL,
  `jumlah_pengajuan` int(11) NOT NULL,
  `status_pengajuan` char(1) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pengajuan`
--

CREATE TABLE `detail_pengajuan` (
  `id_detail` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `nama_detail` varchar(255) NOT NULL,
  `jumlah_detail` int(11) NOT NULL,
  `harga_satuan_detail` int(11) NOT NULL,
  `total_harga_detail` int(11) NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `persetujuan`
--

CREATE TABLE `persetujuan` (
  `id_persetujuan` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sample_ttd`
--

CREATE TABLE `sample_ttd` (
  `id_ttd` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `sample_ttd` varchar(500) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sample_wajah`
--

CREATE TABLE `sample_wajah` (
  `id_wajah` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `sample_wajah` varchar(500) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sekolah`
--

CREATE TABLE `sekolah` (
  `id_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(100) NOT NULL,
  `alamat_sekolah` varchar(255) NOT NULL,
  `email_sekolah` varchar(50) NOT NULL,
  `jenjang_sekolah` char(3) NOT NULL,
  `no_rek_sekolah` varchar(50) NOT NULL,
  `nama_norek_sekolah` varchar(50) NOT NULL,
  `bank_norek_sekolah` varchar(10) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `no_telp_sekolah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `NIP_akun` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_akun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp_akun` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_akun` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_akun` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `fk_sekolah_anggota` (`id_sekolah`),
  ADD KEY `fk_akun_anggota` (`id_akun`);

--
-- Indeks untuk tabel `daftar_pengajuan`
--
ALTER TABLE `daftar_pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD KEY `fk_akun_pengajuan` (`id_akun`),
  ADD KEY `fk_sekolah_pengajuan` (`id_sekolah`);

--
-- Indeks untuk tabel `detail_pengajuan`
--
ALTER TABLE `detail_pengajuan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `fk_detail_pengajuan` (`id_pengajuan`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `persetujuan`
--
ALTER TABLE `persetujuan`
  ADD PRIMARY KEY (`id_persetujuan`),
  ADD KEY `fk_akun_persetujuan` (`id_akun`),
  ADD KEY `fk_pengajuan_persetujuan` (`id_pengajuan`);

--
-- Indeks untuk tabel `sample_ttd`
--
ALTER TABLE `sample_ttd`
  ADD PRIMARY KEY (`id_ttd`),
  ADD KEY `fk_akun_ttd` (`id_akun`);

--
-- Indeks untuk tabel `sample_wajah`
--
ALTER TABLE `sample_wajah`
  ADD PRIMARY KEY (`id_wajah`),
  ADD KEY `fk_akun_wajah` (`id_akun`);

--
-- Indeks untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id_sekolah`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `daftar_pengajuan`
--
ALTER TABLE `daftar_pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_pengajuan`
--
ALTER TABLE `detail_pengajuan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `persetujuan`
--
ALTER TABLE `persetujuan`
  MODIFY `id_persetujuan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sample_ttd`
--
ALTER TABLE `sample_ttd`
  MODIFY `id_ttd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sample_wajah`
--
ALTER TABLE `sample_wajah`
  MODIFY `id_wajah` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id_sekolah` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `fk_akun_anggota` FOREIGN KEY (`id_akun`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_sekolah_anggota` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id_sekolah`);

--
-- Ketidakleluasaan untuk tabel `daftar_pengajuan`
--
ALTER TABLE `daftar_pengajuan`
  ADD CONSTRAINT `fk_akun_pengajuan` FOREIGN KEY (`id_akun`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_sekolah_pengajuan` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id_sekolah`);

--
-- Ketidakleluasaan untuk tabel `detail_pengajuan`
--
ALTER TABLE `detail_pengajuan`
  ADD CONSTRAINT `fk_detail_pengajuan` FOREIGN KEY (`id_pengajuan`) REFERENCES `daftar_pengajuan` (`id_pengajuan`);

--
-- Ketidakleluasaan untuk tabel `persetujuan`
--
ALTER TABLE `persetujuan`
  ADD CONSTRAINT `fk_akun_persetujuan` FOREIGN KEY (`id_akun`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_pengajuan_persetujuan` FOREIGN KEY (`id_pengajuan`) REFERENCES `daftar_pengajuan` (`id_pengajuan`);

--
-- Ketidakleluasaan untuk tabel `sample_ttd`
--
ALTER TABLE `sample_ttd`
  ADD CONSTRAINT `fk_akun_ttd` FOREIGN KEY (`id_akun`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `sample_wajah`
--
ALTER TABLE `sample_wajah`
  ADD CONSTRAINT `fk_akun_wajah` FOREIGN KEY (`id_akun`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
