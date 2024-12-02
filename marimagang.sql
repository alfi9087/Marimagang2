-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2024 at 08:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marimagang`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `nama`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$6g81Lhq7cZ1.QvC86NrG9uOMW7kP/ZuK62Tic6gH5WesVzOGEH23G', NULL, '2024-09-17 03:05:19', '2024-09-17 03:05:19'),
(2, 'admin1', 'admin1@example.com', NULL, '$2y$10$xCCVFCHP3IGdNAAct9gzue7FSCgeToKTFZlTlfquNybcAcRCDetZW', NULL, '2024-09-17 03:05:19', '2024-09-17 03:05:19'),
(3, 'Sekretariat', 'sekretariat@gmail.com', NULL, '$2y$10$uzIan0SpKRr9djzvQKsz4uCXhJ3HuSASEad0COI5/z/Dt8fcqheuy', NULL, '2024-09-17 03:05:19', '2024-09-17 03:05:19'),
(4, 'Aptika', 'santika@gmail.com', NULL, '$2y$10$0Gb3vs5HpLhw07ynCMwKpO13Hz2I6WNbO4hu92KD389cdWDrhAZXC', NULL, '2024-09-17 03:05:19', '2024-09-17 03:05:19'),
(5, 'Infrastruktur', 'infras@gmail.com', NULL, '$2y$10$LnPPyumT.CsMzF7mA27.SekWK0s.4bbPdZwKcT01LKYe3qOn/ZQIu', NULL, '2024-09-17 03:05:19', '2024-09-17 03:05:19'),
(6, 'Komunikasi', 'komunikasi@gmail.com', NULL, '$2y$10$QgduF0Gr/H/MKpWmtca2..q8s2LBl0Weu6fVulRyhDGj.SXEY9DeO', NULL, '2024-09-17 03:05:19', '2024-09-17 03:05:19'),
(7, 'Statistik', 'stain@gmail.com', NULL, '$2y$10$fyg2nf2ncua53hTBkIVbce6DuedZJef9l9OB5tHdRFNz1XcptLP4O', NULL, '2024-09-17 03:05:19', '2024-09-17 03:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pengajuan_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `databidang`
--

CREATE TABLE `databidang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `status` enum('Buka','Tutup') NOT NULL,
  `kuota` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `databidang`
--

INSERT INTO `databidang` (`id`, `admin_id`, `nama`, `thumbnail`, `photo`, `deskripsi`, `status`, `kuota`, `created_at`, `updated_at`) VALUES
(1, 3, 'Sekretariat', 'bidang/thumbnails/bidang-sekretariat.jpg', 'bidang/photos/struktur.jpg', 'Bidang yang berfokus pada pengelolaan administrasi dan operasional untuk memastikan jalannya kegiatan organisasi secara efektif.', 'Buka', 5, '2024-09-17 03:05:19', '2024-09-17 03:05:19'),
(2, 4, 'Bidang Aplikasi Informatika', 'bidang/thumbnails/bidang-aptika.jpg', 'bidang/photos/struktur.jpg', 'Bidang yang berfokus pada pengembangan, pengelolaan, dan pemanfaatan aplikasi serta sistem informatika.', 'Buka', 5, '2024-09-17 03:05:19', '2024-09-17 03:05:19'),
(3, 5, 'Bidang Infrastruktur Jaringan', 'bidang/thumbnails/bidang-infrastruktur.jpg', 'bidang/photos/struktur.jpg', 'Bidang yang berfokus pada  perencanaan, pembangunan, pengelolaan, dan pemeliharaan jaringan komunikasi data dan internet.', 'Buka', 5, '2024-09-17 03:05:19', '2024-09-17 03:05:19'),
(4, 6, 'Bidang Komunikasi dan Konten', 'bidang/thumbnails/bidang-komunikasi.jpg', 'bidang/photos/struktur.jpg', 'Bidang yang berfokus pada pembuatan, pengelolaan, dan distribusi pesan serta informasi kepada audiens tertentu dalam media sosial.', 'Buka', 5, '2024-09-17 03:05:19', '2024-09-17 03:05:19'),
(5, 7, 'Bidang Statistik dan Data', 'bidang/thumbnails/bidang-statistik.jpg', 'bidang/photos/struktur.jpg', 'Bidang yang berfokus berfokus pada analisis, dan penyajian data untuk menghasilkan informasi yang berguna dalam pengambilan keputusan.', 'Buka', 5, '2024-09-17 03:05:19', '2024-09-17 03:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jurusan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama_jurusan`, `created_at`, `updated_at`) VALUES
(1, 'Teknik', '2024-09-17 03:05:19', '2024-09-17 03:05:19'),
(2, 'Ekonomi & Bisnis', '2024-09-17 03:05:19', '2024-09-17 03:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `logbooks`
--

CREATE TABLE `logbooks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pengajuan_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `kegiatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_08_30_154849_create_jurusan', 1),
(2, '2014_08_30_160051_create_prodi', 1),
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2023_10_23_154021_create_admins_table', 1),
(8, '2023_11_17_141141_create_databidang_table', 1),
(9, '2023_11_17_161056_create_skill_table', 1),
(10, '2023_11_18_081548_create_pengajuan_table', 1),
(11, '2023_11_19_095645_create_anggota_table', 1),
(12, '2023_11_19_115845_create_skilluser_table', 1),
(13, '2024_03_07_132657_create_logbooks_table', 1),
(14, '2024_04_05_100215_create_riwayat_table', 1),
(15, '2024_08_28_142529_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1),
(1, 'App\\Models\\Admin', 2),
(2, 'App\\Models\\Admin', 3),
(2, 'App\\Models\\Admin', 4),
(2, 'App\\Models\\Admin', 5),
(2, 'App\\Models\\Admin', 6),
(2, 'App\\Models\\Admin', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `databidang_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `pengantar` varchar(255) DEFAULT NULL,
  `proposal` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `kesediaan` varchar(255) DEFAULT NULL,
  `kesbangpol` varchar(255) DEFAULT NULL,
  `laporan` varchar(255) DEFAULT NULL,
  `suratmagang` varchar(255) DEFAULT NULL,
  `dokumentasi` varchar(255) DEFAULT NULL,
  `nilai` varchar(255) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `tanggalmulai` date DEFAULT NULL,
  `tanggalselesai` date DEFAULT NULL,
  `status` enum('Diproses','Diteruskan','Diterima','Ditolak','Magang','Selesai') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id`, `user_id`, `databidang_id`, `deskripsi`, `bukti`, `pengantar`, `proposal`, `cv`, `kesediaan`, `kesbangpol`, `laporan`, `suratmagang`, `dokumentasi`, `nilai`, `komentar`, `tanggalmulai`, `tanggalselesai`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 2, NULL, 'bukti/BsNTug6K9yM3c6Wcws2NbejhOjlIeXsKkAExTuoK.pdf', 'pengantar/TP6llPHI50zWtfw8SEpYTbUvq77KW6iJrjnuVmdr.pdf', 'proposal/DUr4AAl4Ltew9Y4yIzS734INSrZPYRewik0qL8ot.pdf', 'cv/iOg8MlD674JvxQ9yihKjrSAxLvU0T4MpBgTYHsDs.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-17', '2024-11-17', 'Diproses', '2024-09-17 03:39:12', '2024-09-17 03:39:12');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
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
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_prodi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `nama_prodi`, `created_at`, `updated_at`) VALUES
(1, 'Mesin', '2024-09-17 03:05:19', '2024-09-17 03:05:19'),
(2, 'Management', '2024-09-17 03:05:19', '2024-09-17 03:05:19'),
(3, 'Informatika', '2024-09-17 03:05:19', '2024-09-17 03:05:19'),
(4, 'Akutansi', '2024-09-17 03:05:19', '2024-09-17 03:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pesan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riwayat`
--

INSERT INTO `riwayat` (`id`, `user_id`, `pesan`, `created_at`, `updated_at`) VALUES
(1, 2, 'Anda Berhasil Melengkapi profil', '2024-09-17 03:30:50', '2024-09-17 03:30:50'),
(2, 2, 'Anda Berhasil Melengkapi profil', '2024-09-17 03:30:51', '2024-09-17 03:30:51'),
(3, 2, 'Anda Berhasil Melakukan Pengajuan Magang dan Jangan Lupa Tambahkan Data Anggota (Jika Ada)', '2024-09-17 03:39:12', '2024-09-17 03:39:12');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'admin', '2024-09-17 03:05:20', '2024-09-17 03:05:20'),
(2, 'adminbidang', 'admin', '2024-09-17 03:05:20', '2024-09-17 03:05:20');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `databidang_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`id`, `databidang_id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pengarsipan dan Input Data', '2024-09-17 03:05:19', '2024-09-17 03:05:19'),
(2, 2, 'Web dan Aplikasi', '2024-09-17 03:05:19', '2024-09-17 03:05:19'),
(3, 3, 'Jaringan', '2024-09-17 03:05:19', '2024-09-17 03:05:19'),
(4, 4, 'Public Speaking dan Presentasi', '2024-09-17 03:05:19', '2024-09-17 03:05:19'),
(5, 5, 'Pengolahan Data', '2024-09-17 03:05:19', '2024-09-17 03:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `skilluser`
--

CREATE TABLE `skilluser` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `skill_id` bigint(20) UNSIGNED NOT NULL,
  `pengajuan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skilluser`
--

INSERT INTO `skilluser` (`id`, `user_id`, `skill_id`, `pengajuan_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 1, '2024-09-17 03:39:12', '2024-09-17 03:39:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kampus` varchar(255) DEFAULT NULL,
  `jurusan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `prodi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nim` varchar(255) NOT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `verify` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `kampus`, `jurusan_id`, `prodi_id`, `nim`, `telepon`, `email`, `email_verified_at`, `password`, `foto`, `verify`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, '2041720220', NULL, 'nickarieska@gmail.com', NULL, '$2y$10$rCwyCh7U4fKduc8OAS2GkeIBqZK5sfamvs4SjhpO2QjwSHiH.109a', NULL, 1, NULL, '2024-09-17 03:05:18', '2024-09-17 03:05:18'),
(2, 'aisyah', 'muhammadiyah malang', 1, 1, '9876543210', '108233213312', 'user2@example.com', NULL, '$2y$10$p9.Ngr2zK/CSoc0vNgYlDupWFIBAlZBU5YkxP3tpBYXVws8Cy6qzS', NULL, 1, NULL, '2024-09-17 03:05:18', '2024-09-17 03:30:50'),
(3, NULL, NULL, NULL, NULL, '1111111111', NULL, 'user3@example.com', NULL, '$2y$10$mgFgvb235Y1OdQWKluDAoelnWnPft1Ai1OZvLH202jbtnjyIlBhrO', NULL, 0, NULL, '2024-09-17 03:05:18', '2024-09-17 03:05:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anggota_user_id_foreign` (`user_id`),
  ADD KEY `anggota_pengajuan_id_foreign` (`pengajuan_id`);

--
-- Indexes for table `databidang`
--
ALTER TABLE `databidang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `databidang_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logbooks`
--
ALTER TABLE `logbooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logbooks_user_id_foreign` (`user_id`),
  ADD KEY `logbooks_pengajuan_id_foreign` (`pengajuan_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuan_user_id_foreign` (`user_id`),
  ADD KEY `pengajuan_databidang_id_foreign` (`databidang_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skill_databidang_id_foreign` (`databidang_id`);

--
-- Indexes for table `skilluser`
--
ALTER TABLE `skilluser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skilluser_pengajuan_id_foreign` (`pengajuan_id`),
  ADD KEY `skilluser_user_id_foreign` (`user_id`),
  ADD KEY `skilluser_skill_id_foreign` (`skill_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nim_unique` (`nim`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_telepon_unique` (`telepon`),
  ADD KEY `users_jurusan_id_foreign` (`jurusan_id`),
  ADD KEY `users_prodi_id_foreign` (`prodi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `databidang`
--
ALTER TABLE `databidang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logbooks`
--
ALTER TABLE `logbooks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `skilluser`
--
ALTER TABLE `skilluser`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_pengajuan_id_foreign` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `anggota_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `databidang`
--
ALTER TABLE `databidang`
  ADD CONSTRAINT `databidang_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `logbooks`
--
ALTER TABLE `logbooks`
  ADD CONSTRAINT `logbooks_pengajuan_id_foreign` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `logbooks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `pengajuan_databidang_id_foreign` FOREIGN KEY (`databidang_id`) REFERENCES `databidang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengajuan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD CONSTRAINT `riwayat_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `skill`
--
ALTER TABLE `skill`
  ADD CONSTRAINT `skill_databidang_id_foreign` FOREIGN KEY (`databidang_id`) REFERENCES `databidang` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `skilluser`
--
ALTER TABLE `skilluser`
  ADD CONSTRAINT `skilluser_pengajuan_id_foreign` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `skilluser_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `skilluser_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
