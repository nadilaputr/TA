-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jul 2024 pada 18.10
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
-- Database: `ta`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidang`
--

CREATE TABLE `bidang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bidang` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bidang`
--

INSERT INTO `bidang` (`id`, `bidang`, `created_at`, `updated_at`) VALUES
(1, 'Tata Usaha', '2023-09-06 17:22:24', '2023-09-06 17:22:24'),
(2, 'Sekretaris', '2023-09-06 17:22:24', '2023-09-06 17:22:24'),
(3, 'Kepala Dinas', '2023-09-06 17:22:24', '2023-09-06 17:22:24'),
(4, 'Statistik Sosial', '2023-09-06 17:22:24', '2023-09-06 17:22:24'),
(5, 'Statistik Produksi', '2023-09-06 17:22:24', '2023-09-06 17:22:24'),
(6, 'Statistik Distribusi', '2023-09-06 17:22:24', '2023-09-06 17:22:24'),
(7, 'Neraca Wilayah dan Analisis Statistik', '2023-09-06 17:22:24', '2023-09-06 17:22:24'),
(8, 'Integrasi Pengolahan dan Desiminasi Statistik', '2023-09-06 17:22:24', '2023-09-06 17:22:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `disposisi`
--

CREATE TABLE `disposisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_surat` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_bidang` bigint(20) UNSIGNED NOT NULL,
  `tanggal_disposisi` timestamp NOT NULL DEFAULT current_timestamp(),
  `catatan` varchar(255) NOT NULL,
  `tanggal_penyelesaian` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `disposisi`
--

INSERT INTO `disposisi` (`id`, `id_surat`, `id_user`, `id_bidang`, `tanggal_disposisi`, `catatan`, `tanggal_penyelesaian`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 5, '2024-05-15 16:26:09', 'Ke kepala Dinas', '2024-05-15 16:26:09', '2024-05-15 09:26:09', '2024-05-15 09:26:09'),
(2, 5, 2, 4, '2024-07-18 14:05:37', 'di print ya', '2024-07-18 14:05:37', '2024-07-18 07:05:37', '2024-07-18 07:05:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_06_25_133418_create_surat_masuk_table', 1),
(5, '2023_07_23_140141_create_permission_tables', 1),
(6, '2023_07_27_132309_create_bidang_table', 1),
(7, '2023_08_02_142422_create_users_table', 1),
(8, '2023_08_02_142550_create_disposisi__table', 1),
(9, '2023_08_23_091415_create_surat_keluar_table', 1),
(10, '2023_08_25_173741_add_tanggal_penyelesaian_to_disposisi', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 6),
(4, 'App\\Models\\User', 7),
(4, 'App\\Models\\User', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2023-09-06 17:22:24', '2023-09-06 17:22:24'),
(2, 'sekretaris', 'web', '2023-09-06 17:22:24', '2023-09-06 17:22:24'),
(3, 'kepaladinas', 'web', '2023-09-06 17:22:24', '2023-09-06 17:22:24'),
(4, 'kepalabidang', 'web', '2023-09-06 17:22:24', '2023-09-06 17:22:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_bidang` bigint(20) UNSIGNED NOT NULL,
  `nomor_surat` varchar(255) NOT NULL,
  `sifat` varchar(255) NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `alamat_surat` varchar(255) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_surat` varchar(255) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `asal_surat` varchar(255) NOT NULL,
  `tanggal_masuk` timestamp NOT NULL DEFAULT current_timestamp(),
  `lampiran` varchar(255) DEFAULT NULL,
  `perihal` varchar(255) NOT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `sifat` varchar(255) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `tindakan` smallint(6) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `nomor_surat`, `tanggal_surat`, `asal_surat`, `tanggal_masuk`, `lampiran`, `perihal`, `jenis`, `sifat`, `file`, `catatan`, `tindakan`, `created_at`, `updated_at`) VALUES
(2, '11111111', '2024-05-03', 'BPS Kota', '2024-05-12 17:00:00', '1 Lampiran', 'huhu', 'surat undangan', 'Biasa', 'surat-masuk/suratmasuk-Screenshot 2023-09-29 224836.png', 'arsipkan saja', 4, '2024-05-15 08:33:03', '2024-05-15 09:26:09'),
(3, '00000004', '2024-07-12', 'Intansi DPPESDM', '2024-07-12 17:00:00', '1 Lampiran', 'Perihal', 'Asli', 'Segera', 'surat-masuk/suratmasuk-Screenshot (1).png', NULL, 2, '2024-07-15 06:06:30', '2024-07-22 06:36:49'),
(4, '0000002', '2024-07-18', 'Intansi DPPESDM', '2024-07-15 13:57:31', '3 Lampiran', 'sadsad', 'Sudar Edaran', 'Biasa', 'surat-masuk/suratmasuk-Screenshot (1).png', NULL, 2, '2024-07-15 06:57:31', '2024-07-15 07:01:20'),
(5, '0123', '2024-07-06', 'Wak Gatak', '2024-07-18 12:54:16', '0 Lampiran', 'Kepindahan Iqbal dan Keluarga', 'Undangan Makan', 'Segera', 'surat-masuk/suratmasuk-Screenshot (1).png', 'waduh waduh', 5, '2024-07-18 05:54:16', '2024-07-18 07:06:21'),
(6, '12345678', '2024-07-29', 'h', '2024-07-18 16:24:39', '0 Lampiran', 'hbv', 'jb', 'Biasa', 'surat-masuk/suratmasuk-Screenshot (1).png', NULL, 2, '2024-07-18 09:24:39', '2024-07-18 09:25:43'),
(7, 'gfnjtj', '2024-07-16', 'Intansi DPPESDM', '2024-07-22 13:06:03', '2 Lampiran', 'sadsad', 'Jenis', 'Segera', 'surat-masuk/suratmasuk-Screenshot (1).png', NULL, 2, '2024-07-22 06:06:03', '2024-07-22 06:25:25'),
(8, 'ok', '2024-07-19', 'BPS Kota', '2024-07-22 16:10:34', '2 Lampiran', 'perihal', 'Surat Edaran', 'Segera', 'surat-masuk/suratmasuk-Screenshot (1).png', NULL, 2, '2024-07-22 09:10:34', '2024-07-23 07:54:07'),
(9, '1111', '2024-07-22', 'BPS Kota', '2024-07-23 14:30:27', NULL, 'ok', NULL, NULL, 'surat-masuk/suratmasuk-Screenshot (1).png', NULL, 1, '2024-07-23 07:30:27', '2024-07-23 07:40:55'),
(10, '03030', '2024-07-18', 'Papadali', '2024-07-23 14:59:46', '1 Lampiran', 'Meninggal PApa Dali', 'Surat Biasa', 'Biasa', 'surat-masuk/suratmasuk-images.jpg', 'hntnmj', 3, '2024-07-23 07:59:46', '2024-07-23 08:01:52'),
(11, '181818', '2024-07-22', 'nca', '2024-07-23 15:07:47', NULL, 'Baru Bangon', NULL, NULL, 'surat-masuk/suratmasuk-images.jpg', NULL, 5, '2024-07-23 08:07:47', '2024-07-23 08:08:11'),
(12, '13123', '2024-07-13', 'Rumah Iqbal', '2024-07-23 15:16:49', '2 Lampiran', 'Ibal tembak mbok huahahaha yaalaiii', NULL, 'Biasa', 'surat-masuk/suratmasuk-BBWN Virtual Background.png', NULL, 2, '2024-07-23 08:16:49', '2024-07-29 06:20:07'),
(13, '3124', '2024-07-29', 'BPS Kota', '2024-07-29 15:47:40', NULL, '312', NULL, NULL, 'surat-masuk/suratmasuk-Screenshot (1).png', NULL, 0, '2024-07-29 08:47:40', '2024-07-29 08:47:40'),
(14, '213', '2024-07-29', 'Pekalongan', '2024-07-29 15:50:15', NULL, 'ds', NULL, NULL, 'surat-masuk/suratmasuk-Screenshot (1).png', NULL, 0, '2024-07-29 08:50:15', '2024-07-29 08:50:15'),
(15, '23232', '2024-07-29', 'qwqwwq', '2024-07-29 16:05:14', NULL, 'ok', NULL, NULL, 'surat-masuk/suratmasuk-Screenshot (1).png', NULL, 0, '2024-07-29 09:05:14', '2024-07-29 09:05:14'),
(16, 'sdasd', '2024-07-29', 'asdsadas', '2024-07-29 16:05:49', NULL, 'hahahhaa', NULL, NULL, 'surat-masuk/suratmasuk-Screenshot (1).png', NULL, 0, '2024-07-29 09:05:49', '2024-07-29 09:05:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `id_bidang` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `jabatan`, `id_bidang`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Staff', 1, 'admin', '$2y$10$m7K5EhO.TQjrVqGCkwrx0OIZPSSTVTv0wVkeA8Z0tKkgTZ7DTpKVG', 'RAnYF5dqBXqAsIA0XZn48eU0oBld620ANC4ft5UdIfPqnKOxKXfmaX1nozcV', '2023-09-06 17:22:25', '2023-09-06 17:22:25'),
(2, 'Sekretaris', 'Sekretaris', 2, 'sekretaris', '$2y$10$R6EJNfXA5UW/lqwvwES4Ue4sR.wZPan4KMMbKPvgG9DiETwO6liM6', 'sle8kRHBaV92b1CCyBUWtjdWDjQZTVKXDY2yZkcHKYtdUk0WpAB69YLsoTPW', '2023-09-06 17:22:25', '2023-09-06 17:22:25'),
(3, 'Kepala Dinas', 'Kepala Dinas', 3, 'kepaladinas', '$2y$10$iG3jGcmSFiLNVfFzGFIxbunDnbO9lY0eUqQ7K.d26vuFrANDi.yVq', 'LzwaI2xqkVVXchVmFQ5DO23qkrTSVNdFBgERC9OvT9fI6n3MMaoSgI68JxW3', '2023-09-06 17:22:26', '2023-09-06 17:22:26'),
(4, 'Kepala Bidang Statistik Sosial', 'Kepala Bidang', 4, 'statistiksosial', '$2y$10$V7cmSOajPViUnicISEZpmuoftgQ64NX1N9dfye9XXtUHRxO8RQSiS', 'PCYxUN0UEacZQ5HHrfqwx5FWUuyOTtCXGN2DeA8CFyg5YGRbjLxV2uDJkSPf', '2023-09-06 17:22:26', '2023-09-06 17:22:26'),
(5, 'Kepala Bidang Statistik Produksi', 'Kepala Bidang', 5, 'statistikproduksi', '$2y$10$nwrdX8BPQ1nglvLeWh4sc.WYHaaHYJHBL29yGV8.Wk5sady1NXPQa', 'C4YEEKakZrpVk4kwEWzMQtejWTSDxGRo8B0W6Gmvc8ALsfgd9ACM4NCAtHqW', '2023-09-06 17:22:26', '2023-09-06 17:22:26'),
(6, 'Kepala Bidang Statistik Distribusi', 'Kepala Bidang', 6, 'statistikdistribusi', '$2y$10$4YYwGhLE4ipVK0NtM1a6JuaXwRO/LjmcC7.6wQZ0KP9LGKOG2yb86', 'USlGwDZfdH', '2023-09-06 17:22:26', '2023-09-06 17:22:26'),
(7, 'Kepala Bidang Neraca Wilayah dan Analisis Statistik', 'Kepala Bidang', 7, 'neraca', '$2y$10$NnikPeXDEQF7HcDCJ1A/auNJyB3GtGN5BVJcfMwMNgr6WnIb9TnT2', 'J6oR7A4Jl0', '2023-09-06 17:22:26', '2023-09-06 17:22:26'),
(8, 'Kepala Bidang Integrasi Pengolahan dan Desiminasi Statistik', 'Kepala Bidang', 8, 'integrasi', '$2y$10$0UcmV12VQufpLo/8qjTEsuYnbZQ52jnvdTuzwF37ptAiqrmwNL.Hi', 'iHyA83Zsep', '2023-09-06 17:22:26', '2023-09-06 17:22:26'),
(9, 'Nadila', 'Staff TU', 1, 'nadilauhuy', '$2y$10$0zdDoVmmOwFEDhwyZSj.tOSvvT10.1YwJaSW9YJYeQih8TvITmN7i', NULL, '2024-07-23 06:49:12', '2024-07-23 06:53:05');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disposisi_id_surat_foreign` (`id_surat`),
  ADD KEY `disposisi_id_user_foreign` (`id_user`),
  ADD KEY `disposisi_id_bidang_foreign` (`id_bidang`);

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
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `surat_keluar_nomor_surat_unique` (`nomor_surat`),
  ADD KEY `surat_keluar_id_bidang_foreign` (`id_bidang`);

--
-- Indeks untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `surat_masuk_nomor_surat_unique` (`nomor_surat`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_id_bidang_foreign` (`id_bidang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  ADD CONSTRAINT `disposisi_id_bidang_foreign` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id`),
  ADD CONSTRAINT `disposisi_id_surat_foreign` FOREIGN KEY (`id_surat`) REFERENCES `surat_masuk` (`id`),
  ADD CONSTRAINT `disposisi_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD CONSTRAINT `surat_keluar_id_bidang_foreign` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_bidang_foreign` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
