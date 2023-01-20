-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 01, 2022 at 09:44 AM
-- Server version: 8.0.28-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `garmen`
--

-- --------------------------------------------------------

--
-- Table structure for table `alamats`
--

CREATE TABLE `alamats` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `nama_penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_pos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi_id` int DEFAULT NULL,
  `kecamatan_id` int DEFAULT NULL,
  `kota_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alamats`
--

INSERT INTO `alamats` (`id`, `user_id`, `nama_penerima`, `no_telp`, `jenis_alamat`, `alamat_detail`, `provinsi`, `kota`, `kecamatan`, `kode_pos`, `status`, `provinsi_id`, `kecamatan_id`, `kota_id`, `created_at`, `updated_at`) VALUES
(1, 7, 'alvian', '08129999123', 'Rumah', 'jl demak no 91A', NULL, 'surabaya', 'benowo', '62901', 'Tidak Utama', NULL, NULL, NULL, '2021-12-26 18:32:40', '2021-12-26 18:55:28'),
(2, 7, 'alvian', '08129999123', 'Rumah', 'jl demak no 91A', NULL, 'surabaya', 'benowo', '62901', 'Utama', NULL, NULL, NULL, '2021-12-26 18:55:28', '2021-12-26 18:55:28'),
(3, 5, 'Zaki', '085704703691', 'Sekolah', 'Brudu', 'Jawa Timur', 'Surabaya', 'Asemrowo', '60483', 'Utama', NULL, NULL, NULL, '2021-12-26 22:43:52', '2022-01-16 23:23:22'),
(4, 5, 'Laila', '085704703691', 'Rumah', 'margomulyo', NULL, 'Surabaya', 'Asemrowo', '1234', 'Tidak Utama', NULL, NULL, NULL, '2021-12-26 23:08:55', '2022-01-16 23:23:22'),
(5, 9, 'Rt', '77', 'Rumah', 'aj', NULL, 'Aceh Singkil', 'Woyla Barat', '727', 'Utama', NULL, NULL, NULL, '2022-01-03 14:48:17', '2022-01-03 14:48:17'),
(6, 14, 'indro', '082233901438', 'Rumah', 'bdhdjdjdnd ddjjdjd', 'Jawa Timur', 'Surabaya', 'Sukolilo', '60117', 'Utama', NULL, NULL, NULL, '2022-01-17 09:28:52', '2022-01-17 09:28:52'),
(7, 6, 'alvian', '0891212213', 'Rumah', 'jl tambak asri 2 no 29 sby, 60265', 'Jawa Timur', 'Surabaya', 'Tegalsari', '60265', 'Utama', 11, 6157, 444, '2022-01-30 22:24:39', '2022-01-30 22:24:39');

-- --------------------------------------------------------

--
-- Table structure for table `bahans`
--

CREATE TABLE `bahans` (
  `id` bigint UNSIGNED NOT NULL,
  `detail_sub_kategori_id` bigint UNSIGNED DEFAULT NULL,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_bahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_bahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_bahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warna` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `panjang_bahan` int NOT NULL,
  `panjang_bahan_diambil` int DEFAULT NULL,
  `sisa_bahan` int DEFAULT NULL,
  `vendor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bahans`
--

INSERT INTO `bahans` (`id`, `detail_sub_kategori_id`, `kode_transaksi`, `kode_bahan`, `no_surat`, `sku`, `nama_bahan`, `jenis_bahan`, `warna`, `panjang_bahan`, `panjang_bahan_diambil`, `sisa_bahan`, `vendor`, `tanggal_masuk`, `tanggal_keluar`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'B00128', 'SJK0026', NULL, 'kaos polo bersaku', 'Cotton Combed 28s', 'merah maroon', 150, NULL, NULL, 'Chief Garment', '2021-12-14', NULL, 'bahan keluar', '2021-12-14 23:41:38', '2021-12-14 23:42:10'),
(2, 1, 'TR-2021-12-14-0001', 'B00128', 'SJK2012', 'SKU001/1/1', 'kaos polo bersaku', 'Cotton Combed 28s', 'merah maroon', 150, 100, NULL, 'Chief Garment', '2021-12-14', '2021-12-14', 'bahan keluar', '2021-12-14 23:42:10', '2022-01-04 10:06:03'),
(3, NULL, NULL, 'B22', 'SJM1', NULL, 'Kaos Polos', 'Cotton Combed 32s', 'Hitam', 25, NULL, NULL, 'Triple A', '2022-01-04', NULL, 'bahan keluar', '2022-01-04 10:03:10', '2022-01-04 10:05:00'),
(4, NULL, NULL, 'B24', 'SJM2', NULL, 'Kaos Polos Hitam', 'Cotton Combed 28s', 'Hitam', 25, NULL, NULL, 'Triple A', '2022-01-04', NULL, 'bahan keluar', '2022-01-04 10:03:48', '2022-01-04 10:05:19'),
(5, NULL, NULL, 'B25', 'SJM3', NULL, 'Kaos Polos Hitam', 'Cotton Combed 30s', 'Hitam', 25, NULL, NULL, 'Triple A', '2022-01-04', NULL, 'bahan keluar', '2022-01-04 10:04:19', '2022-01-04 10:05:36'),
(6, 3, 'TR-2022-01-04-0001', 'B22', 'SJK2', 'SKU001/2/1', 'Kaos Polos', 'Cotton Combed 32s', 'Hitam', 25, 25, 0, 'Triple A', '2022-01-04', '2022-01-04', 'bahan keluar', '2022-01-04 10:05:00', '2022-01-04 10:05:00'),
(7, 3, 'TR-2022-01-04-0002', 'B24', 'SJK3', 'SKU001/2/1', 'Kaos Polos Hitam', 'Cotton Combed 28s', 'Hitam', 25, 25, 0, 'Triple A', '2022-01-04', '2022-01-04', 'bahan keluar', '2022-01-04 10:05:19', '2022-01-04 10:05:19'),
(8, 3, 'TR-2022-01-04-0003', 'B25', 'SJK4', 'SKU001/2/1', 'Kaos Polos Hitam', 'Cotton Combed 30s', 'Hitam', 25, 25, 0, 'Triple A', '2022-01-04', '2022-01-04', 'bahan keluar', '2022-01-04 10:05:36', '2022-01-04 10:05:36'),
(9, 3, 'TR-2022-01-04-0004', 'B00128', 'SJK6', 'SKU001/2/1', 'kaos polo bersaku', 'Cotton Combed 28s', 'merah maroon', 50, 50, 0, 'Chief Garment', '2021-12-14', '2022-01-04', 'bahan keluar', '2022-01-04 10:06:03', '2022-01-04 10:06:03'),
(10, NULL, NULL, 'B6', 'SJ6', NULL, 'Kain Linen Anak', 'Linen', 'Putih', 300, NULL, NULL, 'Mewah Kain', '2022-01-10', NULL, 'bahan keluar', '2022-01-10 12:21:27', '2022-01-10 12:22:03'),
(11, 1, 'TR-2022-01-10-0001', 'B6', 'NSJB6', 'SKU001/1/1', 'Kain Linen Anak', 'Linen', 'Putih', 300, 100, NULL, 'Mewah Kain', '2022-01-10', '2022-01-10', 'bahan keluar', '2022-01-10 12:22:03', '2022-01-10 12:22:27'),
(12, 1, 'TR-2022-01-10-0002', 'B6', 'NSJB62', 'SKU001/1/1', 'Kain Linen Anak', 'Linen', 'Putih', 200, 100, NULL, 'Mewah Kain', '2022-01-10', '2022-01-10', 'bahan keluar', '2022-01-10 12:22:27', '2022-01-10 12:22:47'),
(13, 1, 'TR-2022-01-10-0003', 'B6', 'NSJB63', 'SKU001/1/1', 'Kain Linen Anak', 'Linen', 'Putih', 100, 100, 0, 'Mewah Kain', '2022-01-10', '2022-01-10', 'bahan keluar', '2022-01-10 12:22:47', '2022-01-10 12:22:47'),
(14, NULL, NULL, 'B77', 'B71', NULL, 'Kaos Merah Polos', 'Cotton Combed 30s', 'Merah', 50, NULL, NULL, 'AJP Garment', '2022-02-03', NULL, 'bahan keluar', '2022-02-03 09:17:41', '2022-02-03 09:18:11'),
(15, 2, 'TR-2022-02-03-0001', 'B77', 'SJK71', 'SKU002/2/2', 'Kaos Merah Polos', 'Cotton Combed 30s', 'Merah', 50, 20, NULL, 'AJP Garment', '2022-02-03', '2022-02-03', 'bahan keluar', '2022-02-03 09:18:11', '2022-02-03 09:18:43'),
(16, 3, 'TR-2022-02-03-0002', 'B77', 'SJK72', 'SKU001/2/1', 'Kaos Merah Polos', 'Cotton Combed 30s', 'Merah', 30, 20, NULL, 'AJP Garment', '2022-02-03', '2022-02-03', 'bahan keluar', '2022-02-03 09:18:43', '2022-02-03 09:19:22'),
(17, 3, 'TR-2022-02-03-0003', 'B77', 'SJK73', 'SKU001/2/1', 'Kaos Merah Polos', 'Cotton Combed 30s', 'Merah', 10, 10, 0, 'AJP Garment', '2022-02-03', '2022-02-03', 'bahan keluar', '2022-02-03 09:19:22', '2022-02-03 09:19:22'),
(18, NULL, NULL, 'BHN0120', 'SJK921412089', NULL, 'Kaos polo bersaku', 'cotton', 'merah', 50, NULL, NULL, 'garment', '2022-03-25', NULL, 'bahan keluar', '2022-03-25 20:25:16', '2022-03-25 20:26:02'),
(19, 1, 'TR-2022-03-25-0001', 'BHN0120', 'SJN92144899', 'SKU001/1/1', 'Kaos polo bersaku', 'cotton', 'merah', 50, 40, 10, 'garment', '2022-03-25', '2022-03-25', 'bahan keluar', '2022-03-25 20:26:02', '2022-03-25 20:26:02'),
(20, NULL, NULL, 'B-123', 'SJ01', NULL, 'Kaos Polos Hitam', 'Cotton Combed 30s', 'Hitam', 50, NULL, NULL, 'AJP Kain', '2022-03-31', NULL, 'bahan keluar', '2022-03-31 10:11:12', '2022-03-31 10:12:07'),
(21, 3, 'TR-2022-03-31-0001', 'B-123', 'SJ02', 'SKU001/2/1', 'Kaos Polos Hitam', 'Cotton Combed 30s', 'Hitam', 50, 30, 20, 'AJP Kain', '2022-03-31', '2022-03-31', 'bahan keluar', '2022-03-31 10:12:07', '2022-03-31 10:12:07');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `nama_bank`, `nomor_rekening`, `nama_penerima`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'BCA', '12345678', 'GARMENT INDONESIA', '163971460940995.png', '2021-12-17 11:16:49', '2021-12-17 11:16:49');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_banner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo_mulai` date NOT NULL,
  `promo_berakhir` date NOT NULL,
  `syarat` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `nama`, `status`, `status_banner`, `promo_mulai`, `promo_berakhir`, `syarat`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'promo 12.12 desember', 'Tidak Aktif', 'Slider Utama', '2021-12-12', '2021-12-31', 'test', '163966569792824.png', '2021-12-16 21:41:37', '2022-03-31 10:32:40'),
(2, 'promo 12.12 desember', 'Tidak Aktif', 'Slider Utama', '2021-12-12', '2021-12-31', 'test', '163966575591820.png', '2021-12-16 21:42:35', '2022-03-31 10:32:40'),
(3, 'promo 12.12 desember', 'Tidak Aktif', 'Slider Utama', '2021-12-12', '2021-12-31', 'test', '163966580071081.png', '2021-12-16 21:43:20', '2022-03-31 10:32:40'),
(4, 'promo 12.12 desember', 'Tidak Aktif', 'Promo Tambahan', '2021-12-12', '2021-12-31', 'test', '163966582765478.png', '2021-12-16 21:43:47', '2022-03-31 10:32:40'),
(5, '3 Gratis 1', 'Aktif', 'Slider Utama', '2022-01-03', '2022-03-31', '-', '164119711668892.jpg', '2022-01-03 15:05:16', '2022-03-31 10:32:40'),
(6, 'YEAR END SALE 50% OFF', 'Aktif', 'Slider Utama', '2022-01-02', '2022-03-31', '-', '164119728615103.jpg', '2022-01-03 15:08:06', '2022-03-31 10:32:40'),
(7, '1', 'Aktif', 'Promo Tambahan', '2022-01-10', '2022-03-31', '-', '164178694862541.jpg', '2022-01-10 10:55:48', '2022-03-31 10:32:40'),
(8, '2', 'Aktif', 'Promo Tambahan', '2022-01-10', '2022-03-31', '-', '164178701880142.jpg', '2022-01-10 10:56:58', '2022-03-31 10:32:40'),
(9, '3', 'Aktif', 'Promo Tambahan', '2022-01-10', '2022-03-31', '-', '164178708230471.jpg', '2022-01-10 10:58:02', '2022-03-31 10:32:40');

-- --------------------------------------------------------

--
-- Table structure for table `cucis`
--

CREATE TABLE `cucis` (
  `id` bigint UNSIGNED NOT NULL,
  `jahit_id` bigint UNSIGNED DEFAULT NULL,
  `no_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `tanggal_cuci` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `kain_siap_cuci` int NOT NULL,
  `vendor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_vendor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_vendor` double(8,2) DEFAULT NULL,
  `berhasil_cuci` int DEFAULT NULL,
  `konversi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gagal_cuci` int DEFAULT NULL,
  `barang_direpair` int DEFAULT NULL,
  `barang_dibuang` int DEFAULT NULL,
  `barang_akan_direpair` int DEFAULT NULL,
  `barang_akan_dibuang` int DEFAULT NULL,
  `keterangan_direpair` longtext COLLATE utf8mb4_unicode_ci,
  `keterangan_dibuang` longtext COLLATE utf8mb4_unicode_ci,
  `total_bayar` int DEFAULT '0',
  `sisa_bayar` int DEFAULT NULL,
  `total_harga` int DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_cuci` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cucis`
--

INSERT INTO `cucis` (`id`, `jahit_id`, `no_surat`, `tanggal_masuk`, `tanggal_cuci`, `tanggal_selesai`, `tanggal_keluar`, `kain_siap_cuci`, `vendor`, `nama_vendor`, `status_pembayaran`, `harga_vendor`, `berhasil_cuci`, `konversi`, `gagal_cuci`, `barang_direpair`, `barang_dibuang`, `barang_akan_direpair`, `barang_akan_dibuang`, `keterangan_direpair`, `keterangan_dibuang`, `total_bayar`, `sisa_bayar`, `total_harga`, `status`, `status_cuci`, `created_at`, `updated_at`) VALUES
(1, 1, 'SJK2012', NULL, '1970-01-01', '1970-01-01', '2021-12-14', 280, 'eksternal', 'Laundrymat', 'Lunas', 12000.00, 270, NULL, 10, 5, 5, NULL, NULL, 'test', 'test', 0, 0, 3360000, 'cucian keluar', 'selesai', '2021-12-14 23:44:16', '2022-03-31 10:17:45'),
(2, 5, 'SJK2', NULL, '1970-01-01', '1970-01-01', '2022-01-04', 75, 'eksternal', 'Hermes Laundry', 'Lunas', 40000.00, 75, NULL, 0, 0, 0, NULL, NULL, '-', '-', 0, 0, 3000000, 'cucian keluar', 'selesai', '2022-01-04 10:12:30', '2022-03-31 10:17:45'),
(3, 4, 'SJK3', NULL, '1970-01-01', '1970-01-01', '2022-01-04', 75, 'eksternal', 'Hermes Laundry', 'Lunas', 35000.00, 75, NULL, 0, 0, 0, NULL, NULL, '-', '-', 0, 0, 2625000, 'cucian keluar', 'selesai', '2022-01-04 10:12:36', '2022-03-31 10:17:45'),
(4, 3, 'SJK4', NULL, '1970-01-01', '1970-01-01', '2022-01-04', 75, 'eksternal', 'Faisal Washing', 'Lunas', 55000.00, 75, NULL, 0, 0, 0, NULL, NULL, '-', '-', 0, 0, 4125000, 'cucian keluar', 'selesai', '2022-01-04 10:12:41', '2022-03-31 10:17:45'),
(5, 2, 'SJK6', NULL, '1970-01-01', '1970-01-01', '2022-01-04', 150, 'eksternal', 'Gajah Wash', 'Lunas', 45000.00, 150, NULL, 0, 0, 0, NULL, NULL, '-', '-', 0, 0, 6750000, 'cucian keluar', 'selesai', '2022-01-04 10:12:46', '2022-03-31 10:17:45'),
(6, 8, 'NSJB6', NULL, '1970-01-01', '1970-01-01', '2022-01-10', 300, 'eksternal', 'Faisal Washing', 'Lunas', 55000.00, 300, NULL, 0, 0, 0, NULL, NULL, '-', '-', 0, 0, 16500000, 'cucian keluar', 'selesai', '2022-01-10 12:29:19', '2022-03-31 10:17:45'),
(7, 7, 'NSJB62', NULL, '1970-01-01', '1970-01-01', '2022-01-10', 300, 'eksternal', 'Gajah Wash', 'Lunas', 45000.00, 300, NULL, 0, 0, 0, NULL, NULL, '-', '-', 0, 0, 13500000, 'cucian keluar', 'selesai', '2022-01-10 12:29:25', '2022-03-31 10:17:45'),
(8, 6, 'NSJB63', NULL, '1970-01-01', '1970-01-01', '2022-01-10', 300, 'eksternal', 'Gajah Wash', 'Lunas', 45000.00, 300, NULL, 0, 0, 0, NULL, NULL, '-', '-', 0, 0, 13500000, 'cucian keluar', 'selesai', '2022-01-10 12:29:30', '2022-03-31 10:17:45'),
(9, 11, 'SJK71', NULL, '1970-01-01', '1970-01-01', NULL, 100, 'eksternal', 'Vino Laundry', 'Belum Lunas', 40000.00, 100, NULL, 0, 0, 0, NULL, NULL, '-', '-', 0, 4000000, 4000000, 'cucian selesai', 'selesai', '2022-02-03 09:26:20', '2022-03-31 10:17:45'),
(10, 10, 'SJK72', NULL, '1970-01-01', '1970-01-01', NULL, 100, 'eksternal', 'Ferdy Laundry', 'Belum Lunas', 45000.00, 100, NULL, 0, 0, 0, NULL, NULL, '-', '-', 0, 4500000, 4500000, 'cucian selesai', 'selesai', '2022-02-03 09:26:33', '2022-03-31 10:17:45'),
(11, 9, 'SJK73', NULL, '1970-01-01', '1970-01-01', NULL, 50, 'eksternal', 'Vino Laundry', 'Belum Lunas', 40000.00, 50, NULL, 0, 0, 0, NULL, NULL, '-', '-', 0, 2000000, 2000000, 'cucian selesai', 'selesai', '2022-02-03 09:26:42', '2022-03-31 10:17:45'),
(12, 13, 'SJ02', NULL, '1970-01-01', '1970-01-01', '2022-03-31', 90, 'eksternal', 'Viko Laundry', 'Belum Lunas', 40000.00, 90, NULL, 0, 0, 0, NULL, NULL, '-', NULL, 0, 3600000, 3600000, 'cucian keluar', 'selesai', '2022-03-31 10:16:12', '2022-03-31 10:17:45');

-- --------------------------------------------------------

--
-- Table structure for table `cuci_dibuangs`
--

CREATE TABLE `cuci_dibuangs` (
  `id` bigint UNSIGNED NOT NULL,
  `cuci_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cuci_dibuangs`
--

INSERT INTO `cuci_dibuangs` (`id`, `cuci_id`, `ukuran`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 'S', 1, '2021-12-14 23:45:19', '2021-12-14 23:45:19'),
(2, 1, 'M', 2, '2021-12-14 23:45:19', '2021-12-14 23:45:19'),
(3, 1, 'L', 2, '2021-12-14 23:45:19', '2021-12-14 23:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `cuci_direpairs`
--

CREATE TABLE `cuci_direpairs` (
  `id` bigint UNSIGNED NOT NULL,
  `cuci_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cuci_direpairs`
--

INSERT INTO `cuci_direpairs` (`id`, `cuci_id`, `ukuran`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 'S', 2, '2021-12-14 23:45:19', '2021-12-14 23:45:19'),
(2, 1, 'M', 1, '2021-12-14 23:45:19', '2021-12-14 23:45:19'),
(3, 1, 'L', 2, '2021-12-14 23:45:19', '2021-12-14 23:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `detail_cucis`
--

CREATE TABLE `detail_cucis` (
  `id` bigint UNSIGNED NOT NULL,
  `cuci_id` bigint UNSIGNED DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_cucis`
--

INSERT INTO `detail_cucis` (`id`, `cuci_id`, `size`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 'S', 90, '2021-12-14 23:44:16', '2021-12-14 23:45:19'),
(2, 1, 'M', 91, '2021-12-14 23:44:16', '2021-12-14 23:45:19'),
(3, 1, 'L', 89, '2021-12-14 23:44:16', '2021-12-14 23:45:19'),
(4, 2, 'S', 25, '2022-01-04 10:12:30', '2022-01-04 10:12:30'),
(5, 2, 'M', 25, '2022-01-04 10:12:30', '2022-01-04 10:12:30'),
(6, 2, 'L', 25, '2022-01-04 10:12:30', '2022-01-04 10:12:30'),
(7, 3, 'S', 25, '2022-01-04 10:12:36', '2022-01-04 10:12:36'),
(8, 3, 'M', 25, '2022-01-04 10:12:36', '2022-01-04 10:12:36'),
(9, 3, 'L', 25, '2022-01-04 10:12:36', '2022-01-04 10:12:36'),
(10, 4, 'S', 25, '2022-01-04 10:12:41', '2022-01-04 10:12:41'),
(11, 4, 'M', 25, '2022-01-04 10:12:41', '2022-01-04 10:12:41'),
(12, 4, 'L', 25, '2022-01-04 10:12:41', '2022-01-04 10:12:41'),
(13, 5, 'S', 50, '2022-01-04 10:12:46', '2022-01-04 10:12:46'),
(14, 5, 'M', 50, '2022-01-04 10:12:46', '2022-01-04 10:12:46'),
(15, 5, 'L', 50, '2022-01-04 10:12:46', '2022-01-04 10:12:46'),
(16, 6, 'S', 100, '2022-01-10 12:29:19', '2022-01-10 12:29:19'),
(17, 6, 'M', 100, '2022-01-10 12:29:19', '2022-01-10 12:29:19'),
(18, 6, 'L', 100, '2022-01-10 12:29:19', '2022-01-10 12:29:19'),
(19, 7, 'S', 100, '2022-01-10 12:29:25', '2022-01-10 12:29:25'),
(20, 7, 'M', 100, '2022-01-10 12:29:25', '2022-01-10 12:29:25'),
(21, 7, 'L', 100, '2022-01-10 12:29:25', '2022-01-10 12:29:25'),
(22, 8, 'S', 100, '2022-01-10 12:29:30', '2022-01-10 12:29:30'),
(23, 8, 'M', 100, '2022-01-10 12:29:30', '2022-01-10 12:29:30'),
(24, 8, 'L', 100, '2022-01-10 12:29:30', '2022-01-10 12:29:30'),
(25, 9, 'S', 30, '2022-02-03 09:26:20', '2022-02-03 09:26:20'),
(26, 9, 'M', 30, '2022-02-03 09:26:21', '2022-02-03 09:26:21'),
(27, 9, 'L', 30, '2022-02-03 09:26:21', '2022-02-03 09:26:21'),
(28, 9, 'XL', 10, '2022-02-03 09:26:21', '2022-02-03 09:26:21'),
(29, 10, 'M', 40, '2022-02-03 09:26:33', '2022-02-03 09:26:33'),
(30, 10, 'L', 30, '2022-02-03 09:26:33', '2022-02-03 09:26:33'),
(31, 10, 'XL', 30, '2022-02-03 09:26:33', '2022-02-03 09:26:33'),
(32, 11, 'S', 10, '2022-02-03 09:26:42', '2022-02-03 09:26:42'),
(33, 11, 'M', 10, '2022-02-03 09:26:42', '2022-02-03 09:26:42'),
(34, 11, 'L', 10, '2022-02-03 09:26:42', '2022-02-03 09:26:42'),
(35, 11, 'XL', 10, '2022-02-03 09:26:42', '2022-02-03 09:26:42'),
(36, 11, 'XXL', 10, '2022-02-03 09:26:42', '2022-02-03 09:26:42'),
(37, 12, 'S', 30, '2022-03-31 10:16:12', '2022-03-31 10:16:12'),
(38, 12, 'M', 30, '2022-03-31 10:16:12', '2022-03-31 10:16:12'),
(39, 12, 'L', 30, '2022-03-31 10:16:12', '2022-03-31 10:16:12');

-- --------------------------------------------------------

--
-- Table structure for table `detail_finishings`
--

CREATE TABLE `detail_finishings` (
  `id` bigint UNSIGNED NOT NULL,
  `finishing_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_finishings`
--

INSERT INTO `detail_finishings` (`id`, `finishing_id`, `ukuran`, `jumlah`, `created_at`, `updated_at`) VALUES
(4, 1, 'S', 85, '2021-12-14 23:47:36', '2021-12-14 23:47:36'),
(5, 1, 'M', 85, '2021-12-14 23:47:36', '2021-12-14 23:47:36'),
(6, 1, 'L', 90, '2021-12-14 23:47:36', '2021-12-14 23:47:36'),
(19, 2, 'S', 50, '2022-01-04 10:18:08', '2022-01-04 10:18:08'),
(20, 2, 'M', 50, '2022-01-04 10:18:08', '2022-01-04 10:18:08'),
(21, 2, 'L', 50, '2022-01-04 10:18:08', '2022-01-04 10:18:08'),
(22, 3, 'S', 25, '2022-01-04 10:18:38', '2022-01-04 10:18:38'),
(23, 3, 'M', 25, '2022-01-04 10:18:38', '2022-01-04 10:18:38'),
(24, 3, 'L', 25, '2022-01-04 10:18:38', '2022-01-04 10:18:38'),
(25, 5, 'S', 25, '2022-01-04 10:19:08', '2022-01-04 10:19:08'),
(26, 5, 'M', 25, '2022-01-04 10:19:08', '2022-01-04 10:19:08'),
(27, 5, 'L', 25, '2022-01-04 10:19:08', '2022-01-04 10:19:08'),
(28, 4, 'S', 25, '2022-01-04 10:19:33', '2022-01-04 10:19:33'),
(29, 4, 'M', 25, '2022-01-04 10:19:33', '2022-01-04 10:19:33'),
(30, 4, 'L', 25, '2022-01-04 10:19:33', '2022-01-04 10:19:33'),
(40, 8, 'S', 100, '2022-01-10 12:40:59', '2022-01-10 12:40:59'),
(41, 8, 'M', 100, '2022-01-10 12:40:59', '2022-01-10 12:40:59'),
(42, 8, 'L', 100, '2022-01-10 12:40:59', '2022-01-10 12:40:59'),
(43, 7, 'S', 100, '2022-01-10 12:41:25', '2022-01-10 12:41:25'),
(44, 7, 'M', 100, '2022-01-10 12:41:25', '2022-01-10 12:41:25'),
(45, 7, 'L', 100, '2022-01-10 12:41:25', '2022-01-10 12:41:25'),
(46, 6, 'S', 100, '2022-01-10 12:43:48', '2022-01-10 12:43:48'),
(47, 6, 'M', 100, '2022-01-10 12:43:48', '2022-01-10 12:43:48'),
(48, 6, 'L', 100, '2022-01-10 12:43:48', '2022-01-10 12:43:48'),
(61, 11, 'S', 10, '2022-02-03 09:33:53', '2022-02-03 09:33:53'),
(62, 11, 'M', 10, '2022-02-03 09:33:53', '2022-02-03 09:33:53'),
(63, 11, 'L', 10, '2022-02-03 09:33:53', '2022-02-03 09:33:53'),
(64, 11, 'XL', 10, '2022-02-03 09:33:53', '2022-02-03 09:33:53'),
(65, 11, 'XXL', 10, '2022-02-03 09:33:53', '2022-02-03 09:33:53'),
(66, 10, 'M', 40, '2022-02-03 09:34:25', '2022-02-03 09:34:25'),
(67, 10, 'L', 30, '2022-02-03 09:34:25', '2022-02-03 09:34:25'),
(68, 10, 'XL', 30, '2022-02-03 09:34:25', '2022-02-03 09:34:25'),
(69, 9, 'S', 30, '2022-02-03 09:34:53', '2022-02-03 09:34:53'),
(70, 9, 'M', 30, '2022-02-03 09:34:53', '2022-02-03 09:34:53'),
(71, 9, 'L', 30, '2022-02-03 09:34:53', '2022-02-03 09:34:53'),
(72, 9, 'XL', 10, '2022-02-03 09:34:53', '2022-02-03 09:34:53'),
(76, 12, 'S', 30, '2022-03-31 10:21:52', '2022-03-31 10:21:52'),
(77, 12, 'M', 30, '2022-03-31 10:21:52', '2022-03-31 10:21:52'),
(78, 12, 'L', 30, '2022-03-31 10:21:52', '2022-03-31 10:21:52');

-- --------------------------------------------------------

--
-- Table structure for table `detail_jahits`
--

CREATE TABLE `detail_jahits` (
  `id` bigint UNSIGNED NOT NULL,
  `jahit_id` bigint UNSIGNED DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_jahits`
--

INSERT INTO `detail_jahits` (`id`, `jahit_id`, `size`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 'S', 93, '2021-12-14 23:43:13', '2021-12-14 23:44:07'),
(2, 1, 'M', 94, '2021-12-14 23:43:13', '2021-12-14 23:44:07'),
(3, 1, 'L', 93, '2021-12-14 23:43:13', '2021-12-14 23:44:07'),
(4, 2, 'S', 50, '2022-01-04 10:09:10', '2022-01-04 10:09:10'),
(5, 2, 'M', 50, '2022-01-04 10:09:10', '2022-01-04 10:09:10'),
(6, 2, 'L', 50, '2022-01-04 10:09:10', '2022-01-04 10:09:10'),
(7, 3, 'S', 25, '2022-01-04 10:09:16', '2022-01-04 10:09:16'),
(8, 3, 'M', 25, '2022-01-04 10:09:16', '2022-01-04 10:09:16'),
(9, 3, 'L', 25, '2022-01-04 10:09:16', '2022-01-04 10:09:16'),
(10, 4, 'S', 25, '2022-01-04 10:09:22', '2022-01-04 10:09:22'),
(11, 4, 'M', 25, '2022-01-04 10:09:22', '2022-01-04 10:09:22'),
(12, 4, 'L', 25, '2022-01-04 10:09:22', '2022-01-04 10:09:22'),
(13, 5, 'S', 25, '2022-01-04 10:09:58', '2022-01-04 10:09:58'),
(14, 5, 'M', 25, '2022-01-04 10:09:58', '2022-01-04 10:09:58'),
(15, 5, 'L', 25, '2022-01-04 10:09:58', '2022-01-04 10:09:58'),
(16, 6, 'S', 100, '2022-01-10 12:25:08', '2022-01-10 12:25:08'),
(17, 6, 'M', 100, '2022-01-10 12:25:08', '2022-01-10 12:25:08'),
(18, 6, 'L', 100, '2022-01-10 12:25:08', '2022-01-10 12:25:08'),
(19, 7, 'S', 100, '2022-01-10 12:25:13', '2022-01-10 12:25:13'),
(20, 7, 'M', 100, '2022-01-10 12:25:13', '2022-01-10 12:25:13'),
(21, 7, 'L', 100, '2022-01-10 12:25:13', '2022-01-10 12:25:13'),
(22, 8, 'S', 100, '2022-01-10 12:25:19', '2022-01-10 12:25:19'),
(23, 8, 'M', 100, '2022-01-10 12:25:19', '2022-01-10 12:25:19'),
(24, 8, 'L', 100, '2022-01-10 12:25:19', '2022-01-10 12:25:19'),
(25, 9, 'S', 10, '2022-02-03 09:23:17', '2022-02-03 09:23:17'),
(26, 9, 'M', 10, '2022-02-03 09:23:17', '2022-02-03 09:23:17'),
(27, 9, 'L', 10, '2022-02-03 09:23:17', '2022-02-03 09:23:17'),
(28, 9, 'XL', 10, '2022-02-03 09:23:17', '2022-02-03 09:23:17'),
(29, 9, 'XXL', 10, '2022-02-03 09:23:17', '2022-02-03 09:23:17'),
(30, 10, 'M', 40, '2022-02-03 09:23:26', '2022-02-03 09:23:26'),
(31, 10, 'L', 30, '2022-02-03 09:23:26', '2022-02-03 09:23:26'),
(32, 10, 'XL', 30, '2022-02-03 09:23:26', '2022-02-03 09:23:26'),
(33, 11, 'S', 30, '2022-02-03 09:23:37', '2022-02-03 09:23:37'),
(34, 11, 'M', 30, '2022-02-03 09:23:37', '2022-02-03 09:23:37'),
(35, 11, 'L', 30, '2022-02-03 09:23:37', '2022-02-03 09:23:37'),
(36, 11, 'XL', 10, '2022-02-03 09:23:37', '2022-02-03 09:23:37'),
(37, 12, 'S', 40, '2022-03-25 20:27:43', '2022-03-25 20:27:43'),
(38, 12, 'M', 40, '2022-03-25 20:27:43', '2022-03-25 20:27:43'),
(39, 12, 'L', 40, '2022-03-25 20:27:43', '2022-03-25 20:27:43'),
(40, 13, 'S', 30, '2022-03-31 10:14:56', '2022-03-31 10:14:56'),
(41, 13, 'M', 30, '2022-03-31 10:14:56', '2022-03-31 10:14:56'),
(42, 13, 'L', 30, '2022-03-31 10:14:56', '2022-03-31 10:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `detail_perbaikans`
--

CREATE TABLE `detail_perbaikans` (
  `id` bigint UNSIGNED NOT NULL,
  `perbaikan_id` bigint UNSIGNED DEFAULT NULL,
  `jahit_direpair_id` bigint UNSIGNED DEFAULT NULL,
  `cuci_direpair_id` bigint UNSIGNED DEFAULT NULL,
  `jumlah` int NOT NULL,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_potongs`
--

CREATE TABLE `detail_potongs` (
  `id` bigint UNSIGNED NOT NULL,
  `potong_id` bigint UNSIGNED DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_potongs`
--

INSERT INTO `detail_potongs` (`id`, `potong_id`, `size`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 'S', 100, '2021-12-14 23:43:05', '2021-12-14 23:43:05'),
(2, 1, 'M', 100, '2021-12-14 23:43:05', '2021-12-14 23:43:05'),
(3, 1, 'L', 100, '2021-12-14 23:43:05', '2021-12-14 23:43:05'),
(4, 5, 'S', 50, '2022-01-04 10:07:26', '2022-01-04 10:07:26'),
(5, 5, 'M', 50, '2022-01-04 10:07:26', '2022-01-04 10:07:26'),
(6, 5, 'L', 50, '2022-01-04 10:07:26', '2022-01-04 10:07:26'),
(7, 4, 'S', 25, '2022-01-04 10:07:48', '2022-01-04 10:07:48'),
(8, 4, 'M', 25, '2022-01-04 10:07:48', '2022-01-04 10:07:48'),
(9, 4, 'L', 25, '2022-01-04 10:07:48', '2022-01-04 10:07:48'),
(10, 3, 'S', 25, '2022-01-04 10:08:06', '2022-01-04 10:08:06'),
(11, 3, 'M', 25, '2022-01-04 10:08:06', '2022-01-04 10:08:06'),
(12, 3, 'L', 25, '2022-01-04 10:08:06', '2022-01-04 10:08:06'),
(13, 2, 'S', 25, '2022-01-04 10:08:55', '2022-01-04 10:08:55'),
(14, 2, 'M', 25, '2022-01-04 10:08:55', '2022-01-04 10:08:55'),
(15, 2, 'L', 25, '2022-01-04 10:08:55', '2022-01-04 10:08:55'),
(16, 8, 'S', 100, '2022-01-10 12:24:24', '2022-01-10 12:24:24'),
(17, 8, 'M', 100, '2022-01-10 12:24:24', '2022-01-10 12:24:24'),
(18, 8, 'L', 100, '2022-01-10 12:24:24', '2022-01-10 12:24:24'),
(19, 7, 'S', 100, '2022-01-10 12:24:42', '2022-01-10 12:24:42'),
(20, 7, 'M', 100, '2022-01-10 12:24:42', '2022-01-10 12:24:42'),
(21, 7, 'L', 100, '2022-01-10 12:24:42', '2022-01-10 12:24:42'),
(22, 6, 'S', 100, '2022-01-10 12:25:01', '2022-01-10 12:25:01'),
(23, 6, 'M', 100, '2022-01-10 12:25:01', '2022-01-10 12:25:01'),
(24, 6, 'L', 100, '2022-01-10 12:25:01', '2022-01-10 12:25:01'),
(25, 11, 'S', 10, '2022-02-03 09:21:22', '2022-02-03 09:21:22'),
(26, 11, 'M', 10, '2022-02-03 09:21:22', '2022-02-03 09:21:22'),
(27, 11, 'L', 10, '2022-02-03 09:21:22', '2022-02-03 09:21:22'),
(28, 11, 'XL', 10, '2022-02-03 09:21:22', '2022-02-03 09:21:22'),
(29, 11, 'XXL', 10, '2022-02-03 09:21:22', '2022-02-03 09:21:22'),
(30, 10, 'M', 40, '2022-02-03 09:22:11', '2022-02-03 09:22:11'),
(31, 10, 'L', 30, '2022-02-03 09:22:11', '2022-02-03 09:22:11'),
(32, 10, 'XL', 30, '2022-02-03 09:22:11', '2022-02-03 09:22:11'),
(33, 9, 'S', 30, '2022-02-03 09:22:50', '2022-02-03 09:22:50'),
(34, 9, 'M', 30, '2022-02-03 09:22:50', '2022-02-03 09:22:50'),
(35, 9, 'L', 30, '2022-02-03 09:22:50', '2022-02-03 09:22:50'),
(36, 9, 'XL', 10, '2022-02-03 09:22:50', '2022-02-03 09:22:50'),
(37, 12, 'S', 40, '2022-03-25 20:27:28', '2022-03-25 20:27:28'),
(38, 12, 'M', 40, '2022-03-25 20:27:28', '2022-03-25 20:27:28'),
(39, 12, 'L', 40, '2022-03-25 20:27:28', '2022-03-25 20:27:28'),
(40, 13, 'S', 30, '2022-03-31 10:14:39', '2022-03-31 10:14:39'),
(41, 13, 'M', 30, '2022-03-31 10:14:39', '2022-03-31 10:14:39'),
(42, 13, 'L', 30, '2022-03-31 10:14:39', '2022-03-31 10:14:39');

-- --------------------------------------------------------

--
-- Table structure for table `detail_produks`
--

CREATE TABLE `detail_produks` (
  `id` bigint UNSIGNED NOT NULL,
  `produk_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `harga` double DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_produks`
--

INSERT INTO `detail_produks` (`id`, `produk_id`, `ukuran`, `jumlah`, `harga`, `created_at`, `updated_at`) VALUES
(1, 1, 'S', 83, 150000, '2021-12-14 23:49:17', '2022-03-16 13:40:07'),
(2, 1, 'M', 83, 150000, '2021-12-14 23:49:17', '2022-03-16 13:40:07'),
(3, 1, 'L', 88, 150000, '2021-12-14 23:49:17', '2022-03-16 13:40:07'),
(4, 2, 'S', 50, 100000, '2022-01-04 10:21:40', '2022-02-02 14:56:02'),
(5, 2, 'M', 50, 100000, '2022-01-04 10:21:41', '2022-02-02 14:56:02'),
(6, 2, 'L', 50, 100000, '2022-01-04 10:21:41', '2022-02-02 14:56:02'),
(7, 3, 'S', 25, 70000, '2022-01-04 10:22:37', '2022-02-02 14:55:53'),
(8, 3, 'M', 25, 70000, '2022-01-04 10:22:37', '2022-02-02 14:55:53'),
(9, 3, 'L', 25, 70000, '2022-01-04 10:22:37', '2022-02-02 14:55:53'),
(10, 4, 'S', 25, 70000, '2022-01-04 10:22:48', '2022-02-02 14:55:37'),
(11, 4, 'M', 25, 70000, '2022-01-04 10:22:48', '2022-02-02 14:55:37'),
(12, 4, 'L', 25, 70000, '2022-01-04 10:22:48', '2022-02-02 14:55:37'),
(13, 5, 'S', 25, 150000, '2022-01-04 10:24:07', '2022-01-30 22:15:01'),
(14, 5, 'M', 25, 150000, '2022-01-04 10:24:07', '2022-01-30 22:15:01'),
(15, 5, 'L', 25, 150000, '2022-01-04 10:24:07', '2022-01-30 22:15:01'),
(16, 6, 'S', 100, 110000, '2022-01-10 12:47:40', '2022-01-30 22:14:43'),
(17, 6, 'M', 100, 110000, '2022-01-10 12:47:40', '2022-01-30 22:14:43'),
(18, 6, 'L', 100, 110000, '2022-01-10 12:47:40', '2022-01-30 22:14:43'),
(19, 7, 'S', 100, 120000, '2022-01-10 12:48:08', '2022-01-30 22:14:28'),
(20, 7, 'M', 100, 120000, '2022-01-10 12:48:08', '2022-01-30 22:14:28'),
(21, 7, 'L', 100, 120000, '2022-01-10 12:48:08', '2022-01-30 22:14:28'),
(22, 8, 'S', 99, 100000, '2022-01-10 12:48:35', '2022-01-30 22:16:40'),
(23, 8, 'M', 99, 100000, '2022-01-10 12:48:35', '2022-01-30 22:16:40'),
(24, 8, 'L', 99, 100000, '2022-01-10 12:48:35', '2022-01-30 22:16:40'),
(25, 9, 'M', 39, 80000, '2022-02-03 09:47:08', '2022-03-30 13:11:41'),
(26, 9, 'L', 30, 80000, '2022-02-03 09:47:08', '2022-02-03 09:47:08'),
(27, 9, 'XL', 30, 100000, '2022-02-03 09:47:08', '2022-02-03 09:47:08'),
(28, 10, 'S', 30, 120000, '2022-02-03 09:50:46', '2022-02-03 09:50:46'),
(29, 10, 'M', 30, 120000, '2022-02-03 09:50:46', '2022-02-03 09:50:46'),
(30, 10, 'L', 30, 120000, '2022-02-03 09:50:46', '2022-02-03 09:50:46'),
(31, 10, 'XL', 10, 150000, '2022-02-03 09:50:46', '2022-02-03 09:50:46'),
(32, 11, 'S', 30, 300000, '2022-03-31 10:25:26', '2022-03-31 10:25:26'),
(33, 11, 'M', 30, 300000, '2022-03-31 10:25:26', '2022-03-31 10:25:26'),
(34, 11, 'L', 30, 300000, '2022-03-31 10:25:26', '2022-03-31 10:25:26');

-- --------------------------------------------------------

--
-- Table structure for table `detail_produk_images`
--

CREATE TABLE `detail_produk_images` (
  `id` bigint UNSIGNED NOT NULL,
  `produk_id` bigint UNSIGNED DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_produk_images`
--

INSERT INTO `detail_produk_images` (`id`, `produk_id`, `filename`, `created_at`, `updated_at`) VALUES
(1, 1, '163950088213485.png', '2021-12-14 23:54:42', '2021-12-14 23:54:42'),
(2, 1, '163950090650882.png', '2021-12-14 23:55:06', '2021-12-14 23:55:06'),
(3, 2, '164126650117194.jpg', '2022-01-04 10:21:41', '2022-01-04 10:21:41'),
(4, 3, '164126655774814.jpg', '2022-01-04 10:22:37', '2022-01-04 10:22:37'),
(5, 4, '164126656873652.jpg', '2022-01-04 10:22:48', '2022-01-04 10:22:48'),
(6, 5, '164126664785244.jpg', '2022-01-04 10:24:07', '2022-01-04 10:24:07'),
(7, 6, '164179366042105.jpg', '2022-01-10 12:47:40', '2022-01-10 12:47:40'),
(8, 6, '164179366023232.jpg', '2022-01-10 12:47:40', '2022-01-10 12:47:40'),
(9, 6, '164179366011486.jpg', '2022-01-10 12:47:40', '2022-01-10 12:47:40'),
(10, 7, '164179368840724.jpg', '2022-01-10 12:48:08', '2022-01-10 12:48:08'),
(11, 7, '164179368863205.jpg', '2022-01-10 12:48:08', '2022-01-10 12:48:08'),
(12, 7, '164179368893855.jpg', '2022-01-10 12:48:08', '2022-01-10 12:48:08'),
(13, 8, '164179371530481.jpg', '2022-01-10 12:48:35', '2022-01-10 12:48:35'),
(14, 8, '164179371539375.jpg', '2022-01-10 12:48:35', '2022-01-10 12:48:35'),
(15, 8, '164179371525248.jpg', '2022-01-10 12:48:35', '2022-01-10 12:48:35'),
(16, 9, '164385642874195.jpg', '2022-02-03 09:47:08', '2022-02-03 09:47:08'),
(17, 10, '164385664627879.jpg', '2022-02-03 09:50:46', '2022-02-03 09:50:46'),
(18, 11, '164869712611892.png', '2022-03-31 10:25:26', '2022-03-31 10:25:26');

-- --------------------------------------------------------

--
-- Table structure for table `detail_rekapitulasis`
--

CREATE TABLE `detail_rekapitulasis` (
  `id` bigint UNSIGNED NOT NULL,
  `rekapitulasi_id` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_rekapitulasis`
--

INSERT INTO `detail_rekapitulasis` (`id`, `rekapitulasi_id`, `status`, `ukuran`, `jumlah`, `created_at`, `updated_at`) VALUES
(73, 1, 'dibuang', 'S', 1, '2022-03-25 20:36:06', '2022-03-25 20:36:06'),
(74, 1, 'dibuang', 'M', 2, '2022-03-25 20:36:06', '2022-03-25 20:36:06'),
(75, 1, 'dibuang', 'L', 2, '2022-03-25 20:36:06', '2022-03-25 20:36:06'),
(76, 1, 'direpair', 'S', 2, '2022-03-25 20:36:06', '2022-03-25 20:36:06'),
(77, 1, 'direpair', 'M', 1, '2022-03-25 20:36:06', '2022-03-25 20:36:06'),
(78, 1, 'direpair', 'L', 2, '2022-03-25 20:36:06', '2022-03-25 20:36:06'),
(79, 2, 'dibuang', 'S', 4, '2022-03-25 20:36:06', '2022-03-25 20:36:06'),
(80, 2, 'dibuang', 'M', 3, '2022-03-25 20:36:06', '2022-03-25 20:36:06'),
(81, 2, 'dibuang', 'L', 3, '2022-03-25 20:36:06', '2022-03-25 20:36:06'),
(82, 2, 'direpair', 'S', 3, '2022-03-25 20:36:06', '2022-03-25 20:36:06'),
(83, 2, 'direpair', 'M', 3, '2022-03-25 20:36:06', '2022-03-25 20:36:06'),
(84, 2, 'direpair', 'L', 4, '2022-03-25 20:36:06', '2022-03-25 20:36:06');

-- --------------------------------------------------------

--
-- Table structure for table `detail_rekapitulasi_warehouses`
--

CREATE TABLE `detail_rekapitulasi_warehouses` (
  `id` bigint UNSIGNED NOT NULL,
  `rekapitulasi_warehouse_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_rekapitulasi_warehouses`
--

INSERT INTO `detail_rekapitulasi_warehouses` (`id`, `rekapitulasi_warehouse_id`, `ukuran`, `status`, `jumlah`, `created_at`, `updated_at`) VALUES
(13, 1, 'S', 'diretur', 3, '2022-03-25 20:42:44', '2022-03-25 20:42:44'),
(14, 1, 'M', 'diretur', 1, '2022-03-25 20:42:44', '2022-03-25 20:42:44'),
(15, 1, 'L', 'diretur', 1, '2022-03-25 20:42:44', '2022-03-25 20:42:44'),
(16, 1, 'S', 'dibuang', 2, '2022-03-25 20:42:44', '2022-03-25 20:42:44'),
(17, 1, 'M', 'dibuang', 1, '2022-03-25 20:42:44', '2022-03-25 20:42:44'),
(18, 1, 'L', 'dibuang', 2, '2022-03-25 20:42:44', '2022-03-25 20:42:44');

-- --------------------------------------------------------

--
-- Table structure for table `detail_returs`
--

CREATE TABLE `detail_returs` (
  `id` bigint UNSIGNED NOT NULL,
  `retur_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_sampahs`
--

CREATE TABLE `detail_sampahs` (
  `id` bigint UNSIGNED NOT NULL,
  `sampah_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_sampahs`
--

INSERT INTO `detail_sampahs` (`id`, `sampah_id`, `ukuran`, `jumlah`, `created_at`, `updated_at`) VALUES
(15, 1, 'L', 2, '2022-03-14 10:12:45', '2022-03-14 10:12:45'),
(18, 9, 'L', 3, '2022-03-14 10:12:45', '2022-03-14 10:12:45');

-- --------------------------------------------------------

--
-- Table structure for table `detail_sub_kategoris`
--

CREATE TABLE `detail_sub_kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `sub_kategori_id` bigint UNSIGNED DEFAULT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_sub_kategoris`
--

INSERT INTO `detail_sub_kategoris` (`id`, `sub_kategori_id`, `nama_kategori`, `sku`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kemeja Lengan Panjang', 'SKU001/1/1', '2021-12-14 23:39:56', '2021-12-14 23:39:56'),
(2, 2, 'Kemeja Lengan Pendek', 'SKU002/2/2', '2021-12-14 23:39:56', '2021-12-14 23:39:56'),
(3, 3, 'Kaos Polos', 'SKU001/2/1', '2022-01-04 10:02:08', '2022-01-04 10:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksis`
--

CREATE TABLE `detail_transaksis` (
  `id` bigint UNSIGNED NOT NULL,
  `transaksi_id` bigint UNSIGNED DEFAULT NULL,
  `produk_id` bigint UNSIGNED DEFAULT NULL,
  `promo_id` bigint UNSIGNED DEFAULT NULL,
  `jumlah` int NOT NULL,
  `harga` double NOT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_harga` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_transaksis`
--

INSERT INTO `detail_transaksis` (`id`, `transaksi_id`, `produk_id`, `promo_id`, `jumlah`, `harga`, `ukuran`, `total_harga`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 1, 100000, NULL, 100000, '2021-12-28 14:09:57', '2021-12-28 14:09:57'),
(2, 2, 1, NULL, 1, 100000, NULL, 100000, '2021-12-31 10:35:39', '2021-12-31 10:35:39'),
(3, 3, 1, NULL, 1, 100000, NULL, 100000, '2022-01-01 20:21:11', '2022-01-01 20:21:11'),
(4, 4, 1, NULL, 1, 100000, NULL, 100000, '2022-01-01 20:28:32', '2022-01-01 20:28:32'),
(5, 5, 1, NULL, 1, 100000, NULL, 100000, '2022-01-01 20:42:04', '2022-01-01 20:42:04'),
(6, 6, 1, NULL, 1, 100000, NULL, 100000, '2022-01-01 20:43:08', '2022-01-01 20:43:08'),
(7, 7, 1, NULL, 1, 100000, NULL, 100000, '2022-01-01 20:47:02', '2022-01-01 20:47:02'),
(8, 8, 1, NULL, 1, 100000, NULL, 100000, '2022-01-01 20:48:21', '2022-01-01 20:48:21'),
(9, 9, 1, NULL, 1, 100000, NULL, 100000, '2022-01-01 20:54:27', '2022-01-01 20:54:27'),
(10, 10, 1, NULL, 1, 100000, NULL, 100000, '2022-01-01 21:27:26', '2022-01-01 21:27:26'),
(11, 11, 1, NULL, 1, 100000, NULL, 100000, '2022-01-01 22:48:47', '2022-01-01 22:48:47'),
(12, 12, 1, NULL, 1, 100000, NULL, 100000, '2022-01-01 22:53:13', '2022-01-01 22:53:13'),
(13, 13, 1, NULL, 1, 100000, NULL, 100000, '2022-01-03 14:48:27', '2022-01-03 14:48:27'),
(14, 14, 1, NULL, 1, 100000, NULL, 100000, '2022-01-11 09:52:32', '2022-01-11 09:52:32'),
(15, 15, 3, NULL, 1, 60000, NULL, 60000, '2022-01-11 10:14:19', '2022-01-11 10:14:19'),
(16, 16, 1, NULL, 2, 100000, NULL, 200000, '2022-01-17 12:43:52', '2022-01-17 12:43:52'),
(17, 17, 1, NULL, 1, 100000, NULL, 100000, '2022-01-18 14:52:39', '2022-01-18 14:52:39'),
(18, 18, 2, NULL, 1, 70000, NULL, 70000, '2022-01-19 02:52:23', '2022-01-19 02:52:23'),
(19, 19, 1, NULL, 2, 100000, NULL, 200000, '2022-01-19 12:26:21', '2022-01-19 12:26:21'),
(20, 19, 2, NULL, 1, 70000, NULL, 70000, '2022-01-19 12:26:21', '2022-01-19 12:26:21'),
(21, 19, 3, NULL, 1, 60000, NULL, 60000, '2022-01-19 12:26:21', '2022-01-19 12:26:21'),
(22, 20, 1, NULL, 1, 100000, NULL, 100000, '2022-01-19 12:28:13', '2022-01-19 12:28:13'),
(23, 21, 8, NULL, 1, 100000, 'S,M,L', 100000, '2022-01-30 22:16:40', '2022-01-30 22:16:40'),
(24, 22, 6, NULL, 1, 110000, 'S,M,L', 110000, '2022-01-30 22:25:05', '2022-01-30 22:25:05'),
(25, 22, 7, NULL, 1, 120000, 'S,M,L', 120000, '2022-01-30 22:25:05', '2022-01-30 22:25:05'),
(26, 23, 1, NULL, 1, 150000, 'S,M,L', 150000, '2022-02-17 16:01:40', '2022-02-17 16:01:40'),
(27, 24, 10, NULL, 2, 120000, 'S,M,L', 240000, '2022-02-18 22:08:04', '2022-02-18 22:08:04'),
(28, 24, 10, NULL, 2, 150000, 'XL', 300000, '2022-02-18 22:08:04', '2022-02-18 22:08:04'),
(29, 25, 1, NULL, 1, 150000, 'S,M,L', 150000, '2022-03-16 13:38:43', '2022-03-16 13:38:43'),
(30, 26, 9, NULL, 1, 80000, 'M', 80000, '2022-03-30 13:11:50', '2022-03-30 13:11:50');

-- --------------------------------------------------------

--
-- Table structure for table `detail_warehouses`
--

CREATE TABLE `detail_warehouses` (
  `id` bigint UNSIGNED NOT NULL,
  `warehouse_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `harga` double DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_warehouses`
--

INSERT INTO `detail_warehouses` (`id`, `warehouse_id`, `ukuran`, `jumlah`, `harga`, `created_at`, `updated_at`) VALUES
(1, 1, 'S', 85, 150000, '2021-12-14 23:47:36', '2022-02-02 14:56:17'),
(2, 1, 'M', 85, 150000, '2021-12-14 23:47:36', '2022-02-02 14:56:17'),
(3, 1, 'L', 90, 150000, '2021-12-14 23:47:36', '2022-02-02 14:56:17'),
(4, 2, 'S', 50, 100000, '2022-01-04 10:18:08', '2022-02-02 14:56:02'),
(5, 2, 'M', 50, 100000, '2022-01-04 10:18:08', '2022-02-02 14:56:02'),
(6, 2, 'L', 50, 100000, '2022-01-04 10:18:08', '2022-02-02 14:56:02'),
(7, 3, 'S', 25, 70000, '2022-01-04 10:18:38', '2022-02-02 14:55:53'),
(8, 3, 'M', 25, 70000, '2022-01-04 10:18:38', '2022-02-02 14:55:53'),
(9, 3, 'L', 25, 70000, '2022-01-04 10:18:38', '2022-02-02 14:55:53'),
(10, 4, 'S', 25, 70000, '2022-01-04 10:19:08', '2022-02-02 14:55:37'),
(11, 4, 'M', 25, 70000, '2022-01-04 10:19:08', '2022-02-02 14:55:37'),
(12, 4, 'L', 25, 70000, '2022-01-04 10:19:08', '2022-02-02 14:55:37'),
(13, 5, 'S', 25, 150000, '2022-01-04 10:19:33', '2022-01-30 22:15:01'),
(14, 5, 'M', 25, 150000, '2022-01-04 10:19:33', '2022-01-30 22:15:01'),
(15, 5, 'L', 25, 150000, '2022-01-04 10:19:33', '2022-01-30 22:15:01'),
(16, 6, 'S', 100, 110000, '2022-01-10 12:40:59', '2022-01-30 22:14:43'),
(17, 6, 'M', 100, 110000, '2022-01-10 12:40:59', '2022-01-30 22:14:43'),
(18, 6, 'L', 100, 110000, '2022-01-10 12:40:59', '2022-01-30 22:14:43'),
(19, 7, 'S', 100, 120000, '2022-01-10 12:41:25', '2022-01-30 22:14:28'),
(20, 7, 'M', 100, 120000, '2022-01-10 12:41:25', '2022-01-30 22:14:28'),
(21, 7, 'L', 100, 120000, '2022-01-10 12:41:25', '2022-01-30 22:14:28'),
(22, 8, 'S', 100, 100000, '2022-01-10 12:43:48', '2022-01-30 22:14:14'),
(23, 8, 'M', 100, 100000, '2022-01-10 12:43:48', '2022-01-30 22:14:14'),
(24, 8, 'L', 100, 100000, '2022-01-10 12:43:48', '2022-01-30 22:14:14'),
(25, 9, 'S', 10, 0, '2022-02-03 09:33:53', '2022-02-03 09:33:53'),
(26, 9, 'M', 10, 0, '2022-02-03 09:33:53', '2022-02-03 09:33:53'),
(27, 9, 'L', 10, 0, '2022-02-03 09:33:53', '2022-02-03 09:33:53'),
(28, 9, 'XL', 10, 0, '2022-02-03 09:33:53', '2022-02-03 09:33:53'),
(29, 9, 'XXL', 10, 0, '2022-02-03 09:33:53', '2022-02-03 09:33:53'),
(30, 10, 'M', 40, 80000, '2022-02-03 09:34:25', '2022-02-03 09:38:07'),
(31, 10, 'L', 30, 80000, '2022-02-03 09:34:25', '2022-02-03 09:38:07'),
(32, 10, 'XL', 30, 100000, '2022-02-03 09:34:25', '2022-02-03 09:38:07'),
(33, 11, 'S', 30, 120000, '2022-02-03 09:34:53', '2022-02-03 09:35:18'),
(34, 11, 'M', 30, 120000, '2022-02-03 09:34:53', '2022-02-03 09:35:18'),
(35, 11, 'L', 30, 120000, '2022-02-03 09:34:53', '2022-02-03 09:35:18'),
(36, 11, 'XL', 10, 150000, '2022-02-03 09:34:53', '2022-02-03 09:35:18'),
(37, 12, 'S', 30, 300000, '2022-03-31 10:21:52', '2022-03-31 10:22:22'),
(38, 12, 'M', 30, 300000, '2022-03-31 10:21:52', '2022-03-31 10:22:22'),
(39, 12, 'L', 30, 300000, '2022-03-31 10:21:52', '2022-03-31 10:22:22');

-- --------------------------------------------------------

--
-- Table structure for table `favorits`
--

CREATE TABLE `favorits` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `produk_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorits`
--

INSERT INTO `favorits` (`id`, `user_id`, `produk_id`, `created_at`, `updated_at`) VALUES
(1, 7, 1, '2021-12-28 16:14:16', '2021-12-28 16:14:16'),
(5, 14, 1, '2022-01-17 09:33:48', '2022-01-17 09:33:48'),
(6, 14, 4, '2022-01-17 09:35:58', '2022-01-17 09:35:58'),
(9, 9, 1, '2022-01-20 09:29:22', '2022-01-20 09:29:22'),
(10, 9, 2, '2022-03-31 10:32:42', '2022-03-31 10:32:42');

-- --------------------------------------------------------

--
-- Table structure for table `finishings`
--

CREATE TABLE `finishings` (
  `id` bigint UNSIGNED NOT NULL,
  `cuci_id` bigint UNSIGNED DEFAULT NULL,
  `no_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `tanggal_qc` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `barang_lolos_qc` int NOT NULL,
  `barang_gagal_qc` int DEFAULT NULL,
  `barang_diretur` int DEFAULT NULL,
  `barang_dibuang` int DEFAULT NULL,
  `keterangan_diretur` longtext COLLATE utf8mb4_unicode_ci,
  `keterangan_dibuang` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_finishing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `finishings`
--

INSERT INTO `finishings` (`id`, `cuci_id`, `no_surat`, `tanggal_masuk`, `tanggal_qc`, `tanggal_selesai`, `barang_lolos_qc`, `barang_gagal_qc`, `barang_diretur`, `barang_dibuang`, `keterangan_diretur`, `keterangan_dibuang`, `status`, `status_finishing`, `created_at`, `updated_at`) VALUES
(1, 1, 'SJK2012', '2021-12-14', '2021-12-18', '2021-12-18', 260, 10, 5, 5, 'test', 'test', 'kirim warehouse', NULL, '2021-12-14 23:45:28', '2021-12-14 23:47:36'),
(2, 5, 'SJK1', '2022-01-04', '2022-01-04', '2022-01-04', 150, 0, 0, 0, '-', '-', 'kirim warehouse', NULL, '2022-01-04 10:16:11', '2022-01-04 10:18:08'),
(3, 4, 'SJK2', '2022-01-04', '2022-01-04', '2022-01-04', 75, 0, 0, 0, '-', '-', 'kirim warehouse', NULL, '2022-01-04 10:16:16', '2022-01-04 10:18:38'),
(4, 3, 'SJK3', '2022-01-04', '2022-01-04', '2022-01-04', 75, 0, 0, 0, '-', '-', 'kirim warehouse', NULL, '2022-01-04 10:16:24', '2022-01-04 10:19:33'),
(5, 2, 'SJK2', '2022-01-04', '2022-01-04', '2022-01-04', 75, 0, 0, 0, '-', '-', 'kirim warehouse', NULL, '2022-01-04 10:16:30', '2022-01-04 10:19:08'),
(6, 8, 'NSJB63', '2022-01-10', '2022-01-10', '2022-01-10', 300, 0, 0, 0, '-', '-', 'kirim warehouse', NULL, '2022-01-10 12:31:21', '2022-01-10 12:43:48'),
(7, 7, 'NSJB62', '2022-01-10', '2022-01-10', '2022-01-10', 300, 0, 0, 0, '-', '-', 'kirim warehouse', NULL, '2022-01-10 12:31:26', '2022-01-10 12:41:25'),
(8, 6, 'NSJB6', '2022-01-10', '2022-01-10', '2022-01-10', 300, 0, 0, 0, '-', '-', 'kirim warehouse', NULL, '2022-01-10 12:31:31', '2022-01-10 12:40:59'),
(9, 9, 'SJK71', '2022-02-03', '2022-02-03', '2022-02-03', 100, 0, 0, 0, '-', '-', 'kirim warehouse', NULL, '2022-02-03 09:31:41', '2022-02-03 09:34:53'),
(10, 10, 'SJK72', '2022-02-03', '2022-02-03', '2022-02-03', 100, 0, 0, 0, '-', '-', 'kirim warehouse', NULL, '2022-02-03 09:31:54', '2022-02-03 09:34:25'),
(11, 11, 'SJK73', '2022-02-03', '2022-02-03', '2022-02-03', 50, 0, 0, 0, '-', '-', 'kirim warehouse', NULL, '2022-02-03 09:32:18', '2022-02-03 09:33:53'),
(12, 12, 'SJ02', '2022-03-31', '2022-03-31', '2022-03-31', 90, 0, 0, 0, '-', '-', 'kirim warehouse', NULL, '2022-03-31 10:17:45', '2022-03-31 10:21:52');

-- --------------------------------------------------------

--
-- Table structure for table `finishing_dibuangs`
--

CREATE TABLE `finishing_dibuangs` (
  `id` bigint UNSIGNED NOT NULL,
  `finishing_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `finishing_dibuangs`
--

INSERT INTO `finishing_dibuangs` (`id`, `finishing_id`, `ukuran`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 'S', 2, '2021-12-14 23:47:36', '2021-12-14 23:47:36'),
(2, 1, 'M', 1, '2021-12-14 23:47:36', '2021-12-14 23:47:36'),
(3, 1, 'L', 2, '2021-12-14 23:47:36', '2021-12-14 23:47:36');

-- --------------------------------------------------------

--
-- Table structure for table `finishing_returs`
--

CREATE TABLE `finishing_returs` (
  `id` bigint UNSIGNED NOT NULL,
  `finishing_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `finishing_returs`
--

INSERT INTO `finishing_returs` (`id`, `finishing_id`, `ukuran`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 'S', 3, '2021-12-14 23:47:36', '2021-12-14 23:47:36'),
(2, 1, 'M', 1, '2021-12-14 23:47:36', '2021-12-14 23:47:36'),
(3, 1, 'L', 1, '2021-12-14 23:47:36', '2021-12-14 23:47:36');

-- --------------------------------------------------------

--
-- Table structure for table `jahits`
--

CREATE TABLE `jahits` (
  `id` bigint UNSIGNED NOT NULL,
  `potong_id` bigint UNSIGNED DEFAULT NULL,
  `no_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_jahit` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `vendor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_vendor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_vendor` double(8,2) DEFAULT NULL,
  `berhasil` int DEFAULT NULL,
  `jumlah_bahan` int DEFAULT NULL,
  `konversi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gagal_jahit` int DEFAULT NULL,
  `barang_direpair` int DEFAULT NULL,
  `barang_dibuang` int DEFAULT NULL,
  `keterangan_direpair` longtext COLLATE utf8mb4_unicode_ci,
  `keterangan_dibuang` longtext COLLATE utf8mb4_unicode_ci,
  `status_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_bayar` int DEFAULT '0',
  `sisa_bayar` int DEFAULT NULL,
  `total_harga` int DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_jahit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jahits`
--

INSERT INTO `jahits` (`id`, `potong_id`, `no_surat`, `tanggal_jahit`, `tanggal_selesai`, `tanggal_keluar`, `vendor`, `nama_vendor`, `harga_vendor`, `berhasil`, `jumlah_bahan`, `konversi`, `gagal_jahit`, `barang_direpair`, `barang_dibuang`, `keterangan_direpair`, `keterangan_dibuang`, `status_pembayaran`, `total_bayar`, `sisa_bayar`, `total_harga`, `status`, `status_jahit`, `created_at`, `updated_at`) VALUES
(1, 1, 'SJK2012', '2021-12-15', '2021-12-16', '2021-12-14', 'internal', NULL, NULL, 280, 300, '25 Lusin 0 pcs', 20, 10, 10, 'test', 'test', NULL, 0, NULL, NULL, 'jahitan keluar', 'selesai', '2021-12-14 23:43:13', '2022-03-31 10:16:12'),
(2, 5, 'SJK6', '2022-01-04', '2022-01-04', '2022-01-04', 'internal', NULL, NULL, 150, 150, '12 Lusin 6 pcs', 0, 0, 0, '-', '-', NULL, 0, NULL, NULL, 'jahitan keluar', 'selesai', '2022-01-04 10:09:10', '2022-03-31 10:16:12'),
(3, 4, 'SJK4', '2022-01-04', '2022-01-04', '2022-01-04', 'internal', NULL, NULL, 75, 75, '6 Lusin 3 pcs', 0, 0, 0, '-', '-', NULL, 0, NULL, NULL, 'jahitan keluar', 'selesai', '2022-01-04 10:09:16', '2022-03-31 10:16:12'),
(4, 3, 'SJK3', '2022-01-04', '2022-01-04', '2022-01-04', 'internal', NULL, NULL, 75, 75, '6 Lusin 3 pcs', 0, 0, 0, '-', '-', NULL, 0, NULL, NULL, 'jahitan keluar', 'selesai', '2022-01-04 10:09:22', '2022-03-31 10:16:12'),
(5, 2, 'SJK2', '2022-01-04', '2022-01-04', '2022-01-04', 'internal', NULL, NULL, 75, 75, '6 Lusin 3 pcs', 0, 0, 0, '-', '-', NULL, 0, NULL, NULL, 'jahitan keluar', 'selesai', '2022-01-04 10:09:58', '2022-03-31 10:16:12'),
(6, 8, 'NSJB63', '2022-01-10', '2022-01-10', '2022-01-10', 'internal', NULL, NULL, 300, 300, '25 Lusin 0 pcs', 0, 0, 0, '-', '-', NULL, 0, NULL, NULL, 'jahitan keluar', 'selesai', '2022-01-10 12:25:08', '2022-03-31 10:16:12'),
(7, 7, 'NSJB62', '2022-01-10', '2022-01-10', '2022-01-10', 'internal', NULL, NULL, 300, 300, '25 Lusin 0 pcs', 0, 0, 0, '-', '-', NULL, 0, NULL, NULL, 'jahitan keluar', 'selesai', '2022-01-10 12:25:13', '2022-03-31 10:16:12'),
(8, 6, 'NSJB6', '2022-01-10', '2022-01-10', '2022-01-10', 'internal', NULL, NULL, 300, 300, '25 Lusin 0 pcs', 0, 0, 0, '-', '-', NULL, 0, NULL, NULL, 'jahitan keluar', 'selesai', '2022-01-10 12:25:19', '2022-03-31 10:16:12'),
(9, 11, 'SJK73', '2022-02-03', '2022-02-03', '2022-02-03', 'internal', NULL, NULL, 50, 50, '4 Lusin 2 pcs', 0, 0, 0, '-', '-', NULL, 0, NULL, NULL, 'jahitan keluar', 'selesai', '2022-02-03 09:23:17', '2022-03-31 10:16:12'),
(10, 10, 'SJK72', '2022-02-03', '2022-02-03', '2022-02-03', 'internal', NULL, NULL, 100, 100, '8 Lusin 4 pcs', 0, 0, 0, '-', '-', NULL, 0, NULL, NULL, 'jahitan keluar', 'selesai', '2022-02-03 09:23:26', '2022-03-31 10:16:12'),
(11, 9, 'SJK71', '2022-02-03', '2022-02-03', '2022-02-03', 'internal', NULL, NULL, 100, 100, '8 Lusin 4 pcs', 0, 0, 0, '-', '-', NULL, 0, NULL, NULL, 'jahitan keluar', 'selesai', '2022-02-03 09:23:37', '2022-03-31 10:16:12'),
(12, 12, 'SJN92144899', '2022-03-26', '2022-03-27', NULL, 'internal', NULL, NULL, NULL, 120, '10 Lusin 0 pcs', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'jahitan masuk', 'selesai', '2022-03-25 20:27:43', '2022-03-31 10:16:12'),
(13, 13, 'SJ02', '2022-03-31', '2022-03-31', '2022-03-31', 'internal', NULL, NULL, 90, 90, '7 Lusin 6 pcs', 0, 0, 0, '-', '-', NULL, 0, NULL, NULL, 'jahitan keluar', 'selesai', '2022-03-31 10:14:56', '2022-03-31 10:16:12');

-- --------------------------------------------------------

--
-- Table structure for table `jahit_dibuangs`
--

CREATE TABLE `jahit_dibuangs` (
  `id` bigint UNSIGNED NOT NULL,
  `jahit_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jahit_dibuangs`
--

INSERT INTO `jahit_dibuangs` (`id`, `jahit_id`, `ukuran`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 'S', 4, '2021-12-14 23:44:07', '2021-12-14 23:44:07'),
(2, 1, 'M', 3, '2021-12-14 23:44:07', '2021-12-14 23:44:07'),
(3, 1, 'L', 3, '2021-12-14 23:44:07', '2021-12-14 23:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `jahit_direpairs`
--

CREATE TABLE `jahit_direpairs` (
  `id` bigint UNSIGNED NOT NULL,
  `jahit_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jahit_direpairs`
--

INSERT INTO `jahit_direpairs` (`id`, `jahit_id`, `ukuran`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 'S', 3, '2021-12-14 23:44:07', '2021-12-14 23:44:07'),
(2, 1, 'M', 3, '2021-12-14 23:44:07', '2021-12-14 23:44:07'),
(3, 1, 'L', 4, '2021-12-14 23:44:07', '2021-12-14 23:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama_kategori`, `sku`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Pria', 'SKU001', '164120153925954.png', '2021-12-14 23:39:56', '2022-01-03 16:18:59'),
(2, 'Wanita', 'SKU002', '164120155558559.png', '2021-12-14 23:39:56', '2022-01-03 16:19:15');

-- --------------------------------------------------------

--
-- Table structure for table `keranjangs`
--

CREATE TABLE `keranjangs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `produk_id` bigint UNSIGNED DEFAULT NULL,
  `check` int NOT NULL DEFAULT '0',
  `harga` double NOT NULL,
  `jumlah` double NOT NULL,
  `subtotal` double NOT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keranjangs`
--

INSERT INTO `keranjangs` (`id`, `user_id`, `produk_id`, `check`, `harga`, `jumlah`, `subtotal`, `ukuran`, `created_at`, `updated_at`) VALUES
(5, 7, 1, 0, 100000, 1, 100000, NULL, '2021-12-21 14:00:43', '2021-12-26 23:47:20'),
(13, 15, 1, 1, 100000, 1, 100000, NULL, '2021-12-28 10:48:08', '2021-12-28 10:48:08'),
(36, 14, 2, 1, 70000, 1, 70000, NULL, '2022-01-19 02:53:01', '2022-01-19 02:53:01'),
(38, 16, 7, 1, 110000, 1, 110000, NULL, '2022-01-24 16:45:56', '2022-01-24 16:46:05'),
(39, 16, 8, 1, 105000, 1, 105000, NULL, '2022-01-24 16:46:24', '2022-01-24 16:46:24'),
(40, 16, 1, 1, 100000, 4, 400000, NULL, '2022-01-24 16:47:41', '2022-01-24 17:00:43'),
(52, 9, 1, 0, 150000, 1, 150000, 'S,M,L', '2022-03-29 09:12:08', '2022-03-31 10:32:54'),
(53, 9, 2, 0, 100000, 1, 100000, 'S,M,L', '2022-03-31 10:32:45', '2022-03-31 10:32:54');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2021_07_25_124001_create_kategoris_table', 1),
(4, '2021_07_25_124200_create_sub_kategoris_table', 1),
(5, '2021_07_25_124215_create_detail_sub_kategoris_table', 1),
(6, '2021_07_28_133143_create_bahans_table', 1),
(7, '2021_07_28_134326_create_potongs_table', 1),
(8, '2021_07_28_134354_create_detail_potongs_table', 1),
(9, '2021_07_28_134417_create_jahits_table', 1),
(10, '2021_07_28_134437_create_detail_jahits_table', 1),
(11, '2021_07_28_135416_create_cucis_table', 1),
(12, '2021_07_28_135600_create_detail_cucis_table', 1),
(13, '2021_07_30_153748_create_permission_tables', 1),
(14, '2021_07_31_074824_create_jahit_direpairs_table', 1),
(15, '2021_07_31_074838_create_jahit_dibuangs_table', 1),
(16, '2021_08_05_071341_create_cuci_direpairs_table', 1),
(17, '2021_08_05_071458_create_cuci_dibuangs_table', 1),
(18, '2021_08_06_033837_create_sampahs_table', 1),
(19, '2021_08_06_035424_create_detail_sampahs_table', 1),
(20, '2021_08_06_042903_create_perbaikans_table', 1),
(21, '2021_08_06_043332_create_detail_perbaikans_table', 1),
(22, '2021_08_06_080817_create_rekapitulasis_table', 1),
(23, '2021_08_10_073534_create_finishings_table', 1),
(24, '2021_08_10_123346_create_detail_finishings_table', 1),
(25, '2021_08_10_132605_create_finishing_returs_table', 1),
(26, '2021_08_10_132718_create_finishing_dibuangs_table', 1),
(27, '2021_08_10_135948_create_detail_rekapitulasis_table', 1),
(28, '2021_08_11_042832_create_warehouses_table', 1),
(29, '2021_08_11_042927_create_detail_warehouses_table', 1),
(30, '2021_08_14_054929_create_returs_table', 1),
(31, '2021_08_14_055110_create_detail_returs_table', 1),
(32, '2021_08_14_060055_create_rekapitulasi_warehouses_table', 1),
(33, '2021_08_14_060114_create_detail_rekapitulasi_warehouses_table', 1),
(34, '2021_08_22_131026_create_notifications_table', 1),
(35, '2021_10_04_210554_create_pembayaran_jahits_table', 1),
(36, '2021_10_04_210918_create_pembayaran_cucis_table', 1),
(37, '2021_10_17_194112_create_promos_table', 1),
(38, '2021_10_18_214949_create_produks_table', 1),
(39, '2021_10_18_215239_create_detail_produks_table', 1),
(40, '2021_10_18_215447_create_detail_produk_images_table', 1),
(41, '2021_10_20_125923_create_banners_table', 1),
(42, '2021_10_27_220932_create_alamats_table', 1),
(43, '2021_11_24_214632_create_banks_table', 1),
(44, '2021_11_25_194546_create_keranjangs_table', 1),
(45, '2021_12_02_225512_create_favorits_table', 1),
(46, '2021_12_22_213132_create_transaksis_table', 1),
(47, '2021_12_22_213608_create_detail_transaksis_table', 1),
(48, '2021_12_23_195752_create_notification_ecommerces_table', 1),
(49, '2021_12_23_224052_create_ulasans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(4, 'App\\User', 3),
(3, 'App\\User', 4),
(5, 'App\\User', 5),
(5, 'App\\User', 6),
(5, 'App\\User', 7),
(5, 'App\\User', 8),
(5, 'App\\User', 9),
(5, 'App\\User', 10),
(5, 'App\\User', 11),
(5, 'App\\User', 12),
(5, 'App\\User', 13),
(5, 'App\\User', 14),
(5, 'App\\User', 15),
(5, 'App\\User', 16),
(5, 'App\\User', 17);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktif` int NOT NULL DEFAULT '0',
  `read` int NOT NULL DEFAULT '0',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `description`, `url`, `aktif`, `read`, `role`, `created_at`, `updated_at`) VALUES
(1, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://23.96.16.122/garmen/production/potong', 1, 1, 'production', '2021-12-14 23:42:10', '2022-02-03 09:20:21'),
(2, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://23.96.16.122/garmen/production/jahit', 1, 1, 'production', '2021-12-14 23:43:13', '2022-02-03 09:20:21'),
(3, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://23.96.16.122/garmen/production/cuci', 1, 1, 'production', '2021-12-14 23:44:16', '2022-02-03 09:20:21'),
(4, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://23.96.16.122/garmen/production/cuci', 1, 1, 'production', '2021-12-14 23:45:28', '2022-02-03 09:20:21'),
(5, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://23.96.16.122/garmen/warehouse/finishing', 1, 0, 'warehouse', '2021-12-14 23:45:28', '2022-02-03 09:20:20'),
(6, 'ada barang yang diretur, silahkan di cek', 'http://23.96.16.122/garmen/production/retur', 1, 1, 'production', '2021-12-14 23:47:36', '2022-02-03 09:20:21'),
(7, 'sortir telah dikirim ke gudang, silahkan di cek', 'http://23.96.16.122/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2021-12-14 23:47:36', '2022-02-03 09:20:20'),
(8, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'http://23.96.16.122/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2021-12-14 23:47:56', '2022-02-03 09:20:20'),
(9, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'https://testaplikasi.engineer/garmen/production/potong', 1, 1, 'production', '2022-01-04 10:05:00', '2022-02-03 09:20:21'),
(10, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'https://testaplikasi.engineer/garmen/production/potong', 1, 1, 'production', '2022-01-04 10:05:19', '2022-02-03 09:20:21'),
(11, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'https://testaplikasi.engineer/garmen/production/potong', 1, 1, 'production', '2022-01-04 10:05:36', '2022-02-03 09:20:21'),
(12, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'https://testaplikasi.engineer/garmen/production/potong', 1, 1, 'production', '2022-01-04 10:06:03', '2022-02-03 09:20:21'),
(13, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/jahit', 1, 1, 'production', '2022-01-04 10:09:10', '2022-02-03 09:20:21'),
(14, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/jahit', 1, 1, 'production', '2022-01-04 10:09:16', '2022-02-03 09:20:21'),
(15, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/jahit', 1, 1, 'production', '2022-01-04 10:09:22', '2022-02-03 09:20:21'),
(16, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/jahit', 1, 1, 'production', '2022-01-04 10:09:58', '2022-02-03 09:20:21'),
(17, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/cuci', 1, 1, 'production', '2022-01-04 10:12:30', '2022-02-03 09:20:21'),
(18, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/cuci', 1, 1, 'production', '2022-01-04 10:12:36', '2022-02-03 09:20:21'),
(19, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/cuci', 1, 1, 'production', '2022-01-04 10:12:41', '2022-02-03 09:20:21'),
(20, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/cuci', 1, 1, 'production', '2022-01-04 10:12:46', '2022-02-03 09:20:21'),
(21, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/cuci', 1, 1, 'production', '2022-01-04 10:16:11', '2022-02-03 09:20:21'),
(22, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/finishing', 1, 0, 'warehouse', '2022-01-04 10:16:11', '2022-02-03 09:20:20'),
(23, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/cuci', 1, 1, 'production', '2022-01-04 10:16:16', '2022-02-03 09:20:21'),
(24, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/finishing', 1, 0, 'warehouse', '2022-01-04 10:16:16', '2022-02-03 09:20:20'),
(25, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/cuci', 1, 1, 'production', '2022-01-04 10:16:24', '2022-02-03 09:20:21'),
(26, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/finishing', 1, 0, 'warehouse', '2022-01-04 10:16:24', '2022-02-03 09:20:20'),
(27, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/cuci', 1, 1, 'production', '2022-01-04 10:16:30', '2022-02-03 09:20:21'),
(28, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/finishing', 1, 0, 'warehouse', '2022-01-04 10:16:30', '2022-02-03 09:20:20'),
(29, 'ada barang yang diretur, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/retur', 1, 1, 'production', '2022-01-04 10:18:08', '2022-02-03 09:20:21'),
(30, 'sortir telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-01-04 10:18:08', '2022-02-03 09:20:20'),
(31, 'ada barang yang diretur, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/retur', 1, 1, 'production', '2022-01-04 10:18:38', '2022-02-03 09:20:21'),
(32, 'sortir telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-01-04 10:18:38', '2022-02-03 09:20:20'),
(33, 'ada barang yang diretur, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/retur', 1, 1, 'production', '2022-01-04 10:19:08', '2022-02-03 09:20:21'),
(34, 'sortir telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-01-04 10:19:08', '2022-02-03 09:20:20'),
(35, 'ada barang yang diretur, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/retur', 1, 1, 'production', '2022-01-04 10:19:33', '2022-02-03 09:20:21'),
(36, 'sortir telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-01-04 10:19:33', '2022-02-03 09:20:20'),
(37, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-01-04 10:19:50', '2022-02-03 09:20:20'),
(38, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-01-04 10:19:59', '2022-02-03 09:20:20'),
(39, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-01-04 10:20:10', '2022-02-03 09:20:20'),
(40, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-01-04 10:20:18', '2022-02-03 09:20:20'),
(41, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'https://testaplikasi.engineer/garmen/production/potong', 1, 1, 'production', '2022-01-10 12:22:03', '2022-02-03 09:20:21'),
(42, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'https://testaplikasi.engineer/garmen/production/potong', 1, 1, 'production', '2022-01-10 12:22:27', '2022-02-03 09:20:21'),
(43, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'https://testaplikasi.engineer/garmen/production/potong', 1, 1, 'production', '2022-01-10 12:22:47', '2022-02-03 09:20:21'),
(44, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/jahit', 1, 1, 'production', '2022-01-10 12:25:08', '2022-02-03 09:20:21'),
(45, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/jahit', 1, 1, 'production', '2022-01-10 12:25:13', '2022-02-03 09:20:21'),
(46, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/jahit', 1, 1, 'production', '2022-01-10 12:25:19', '2022-02-03 09:20:21'),
(47, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/cuci', 1, 1, 'production', '2022-01-10 12:29:19', '2022-02-03 09:20:21'),
(48, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/cuci', 1, 1, 'production', '2022-01-10 12:29:25', '2022-02-03 09:20:21'),
(49, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/cuci', 1, 1, 'production', '2022-01-10 12:29:30', '2022-02-03 09:20:21'),
(50, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/cuci', 1, 1, 'production', '2022-01-10 12:31:21', '2022-02-03 09:20:21'),
(51, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/finishing', 1, 0, 'warehouse', '2022-01-10 12:31:21', '2022-02-03 09:20:20'),
(52, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/cuci', 1, 1, 'production', '2022-01-10 12:31:26', '2022-02-03 09:20:21'),
(53, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/finishing', 1, 0, 'warehouse', '2022-01-10 12:31:26', '2022-02-03 09:20:20'),
(54, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/cuci', 1, 1, 'production', '2022-01-10 12:31:31', '2022-02-03 09:20:21'),
(55, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/finishing', 1, 0, 'warehouse', '2022-01-10 12:31:31', '2022-02-03 09:20:20'),
(56, 'ada barang yang diretur, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/retur', 1, 1, 'production', '2022-01-10 12:40:59', '2022-02-03 09:20:21'),
(57, 'sortir telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-01-10 12:40:59', '2022-02-03 09:20:20'),
(58, 'ada barang yang diretur, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/retur', 1, 1, 'production', '2022-01-10 12:41:25', '2022-02-03 09:20:21'),
(59, 'sortir telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-01-10 12:41:25', '2022-02-03 09:20:20'),
(60, 'ada barang yang diretur, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/retur', 1, 1, 'production', '2022-01-10 12:43:48', '2022-02-03 09:20:21'),
(61, 'sortir telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-01-10 12:43:48', '2022-02-03 09:20:20'),
(62, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-01-10 12:44:31', '2022-02-03 09:20:20'),
(63, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-01-10 12:44:39', '2022-02-03 09:20:20'),
(64, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-01-10 12:44:49', '2022-02-03 09:20:20'),
(65, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-01-30 22:14:14', '2022-02-03 09:20:20'),
(66, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-01-30 22:14:28', '2022-02-03 09:20:20'),
(67, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-01-30 22:14:43', '2022-02-03 09:20:20'),
(68, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-01-30 22:15:01', '2022-02-03 09:20:20'),
(69, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-02-02 14:55:37', '2022-02-03 09:20:20'),
(70, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-02-02 14:55:53', '2022-02-03 09:20:20'),
(71, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-02-02 14:56:02', '2022-02-03 09:20:20'),
(72, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 1, 0, 'warehouse', '2022-02-02 14:56:17', '2022-02-03 09:20:20'),
(73, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'https://testaplikasi.engineer/garmen/production/potong', 1, 1, 'production', '2022-02-03 09:18:11', '2022-02-03 09:20:21'),
(74, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'https://testaplikasi.engineer/garmen/production/potong', 1, 1, 'production', '2022-02-03 09:18:43', '2022-02-03 09:20:21'),
(75, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'https://testaplikasi.engineer/garmen/production/potong', 1, 1, 'production', '2022-02-03 09:19:22', '2022-02-03 09:20:21'),
(76, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/jahit', 0, 0, 'production', '2022-02-03 09:23:17', '2022-02-03 09:23:17'),
(77, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/jahit', 0, 0, 'production', '2022-02-03 09:23:26', '2022-02-03 09:23:26'),
(78, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/jahit', 0, 0, 'production', '2022-02-03 09:23:37', '2022-02-03 09:23:37'),
(79, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/cuci', 0, 0, 'production', '2022-02-03 09:26:21', '2022-02-03 09:26:21'),
(80, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/cuci', 0, 0, 'production', '2022-02-03 09:26:33', '2022-02-03 09:26:33'),
(81, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/cuci', 0, 0, 'production', '2022-02-03 09:26:42', '2022-02-03 09:26:42'),
(82, 'ada barang yang diretur, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/retur', 0, 0, 'production', '2022-02-03 09:33:53', '2022-02-03 09:33:53'),
(83, 'sortir telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 0, 0, 'warehouse', '2022-02-03 09:33:53', '2022-02-03 09:33:53'),
(84, 'ada barang yang diretur, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/retur', 0, 0, 'production', '2022-02-03 09:34:25', '2022-02-03 09:34:25'),
(85, 'sortir telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 0, 0, 'warehouse', '2022-02-03 09:34:25', '2022-02-03 09:34:25'),
(86, 'ada barang yang diretur, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/retur', 0, 0, 'production', '2022-02-03 09:34:53', '2022-02-03 09:34:53'),
(87, 'sortir telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 0, 0, 'warehouse', '2022-02-03 09:34:53', '2022-02-03 09:34:53'),
(88, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 0, 0, 'warehouse', '2022-02-03 09:35:18', '2022-02-03 09:35:18'),
(89, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 0, 0, 'warehouse', '2022-02-03 09:38:07', '2022-02-03 09:38:07'),
(90, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'https://testaplikasi.engineer/garmen/production/potong', 0, 0, 'production', '2022-03-25 20:26:02', '2022-03-25 20:26:02'),
(91, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/jahit', 0, 0, 'production', '2022-03-25 20:27:43', '2022-03-25 20:27:43'),
(92, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'https://testaplikasi.engineer/garmen/production/potong', 0, 0, 'production', '2022-03-31 10:12:07', '2022-03-31 10:12:07'),
(93, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/jahit', 0, 0, 'production', '2022-03-31 10:14:56', '2022-03-31 10:14:56'),
(94, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/cuci', 0, 0, 'production', '2022-03-31 10:16:12', '2022-03-31 10:16:12'),
(95, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/cuci', 0, 0, 'production', '2022-03-31 10:17:45', '2022-03-31 10:17:45'),
(96, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/finishing', 0, 0, 'warehouse', '2022-03-31 10:17:45', '2022-03-31 10:17:45'),
(97, 'ada barang yang diretur, silahkan di cek', 'https://testaplikasi.engineer/garmen/production/retur', 0, 0, 'production', '2022-03-31 10:21:52', '2022-03-31 10:21:52'),
(98, 'sortir telah dikirim ke gudang, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 0, 0, 'warehouse', '2022-03-31 10:21:52', '2022-03-31 10:21:52'),
(99, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'https://testaplikasi.engineer/garmen/warehouse/warehouse', 0, 0, 'warehouse', '2022-03-31 10:22:22', '2022-03-31 10:22:22');

-- --------------------------------------------------------

--
-- Table structure for table `notification_ecommerces`
--

CREATE TABLE `notification_ecommerces` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `transaksi_id` bigint UNSIGNED DEFAULT NULL,
  `pesan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_ecommerces`
--

INSERT INTO `notification_ecommerces` (`id`, `user_id`, `transaksi_id`, `pesan`, `created_at`, `updated_at`) VALUES
(1, 5, 12, 'Pesanan dengan nomor transaksi INV0101202212 dalam proses pengiriman!', '2022-01-13 13:59:54', '2022-01-13 13:59:54'),
(2, 9, 25, 'Pesanan dengan nomor transaksi INV1603202225 dalam proses pengiriman!', '2022-03-16 13:40:07', '2022-03-16 13:40:07'),
(3, 5, 20, 'Pesanan dengan nomor transaksi INV1901202220 dalam proses pengiriman!', '2022-03-31 10:29:32', '2022-03-31 10:29:32');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_cucis`
--

CREATE TABLE `pembayaran_cucis` (
  `id` bigint UNSIGNED NOT NULL,
  `cuci_id` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran_cucis`
--

INSERT INTO `pembayaran_cucis` (`id`, `cuci_id`, `status`, `nominal`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lunas', 3360000, '2022-01-10 12:51:32', '2022-01-10 12:51:32'),
(2, 2, 'Lunas', 3000000, '2022-01-10 12:51:46', '2022-01-10 12:51:46'),
(3, 3, 'Lunas', 2625000, '2022-01-10 12:52:01', '2022-01-10 12:52:01'),
(4, 4, 'Lunas', 4125000, '2022-01-10 12:52:17', '2022-01-10 12:52:17'),
(5, 5, 'Lunas', 6750000, '2022-01-10 12:52:41', '2022-01-10 12:52:41'),
(6, 6, 'Lunas', 16500000, '2022-01-10 12:52:59', '2022-01-10 12:52:59'),
(7, 7, 'Lunas', 13500000, '2022-01-10 12:53:11', '2022-01-10 12:53:11'),
(8, 8, 'Lunas', 13500000, '2022-01-10 12:53:26', '2022-01-10 12:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_jahits`
--

CREATE TABLE `pembayaran_jahits` (
  `id` bigint UNSIGNED NOT NULL,
  `jahit_id` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perbaikans`
--

CREATE TABLE `perbaikans` (
  `id` bigint UNSIGNED NOT NULL,
  `bahan_id` bigint UNSIGNED DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `total` int NOT NULL DEFAULT '0',
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `potongs`
--

CREATE TABLE `potongs` (
  `id` bigint UNSIGNED NOT NULL,
  `bahan_id` bigint UNSIGNED DEFAULT NULL,
  `no_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_cutting` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `hasil_cutting` double(8,2) DEFAULT NULL,
  `konversi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_potong` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `potongs`
--

INSERT INTO `potongs` (`id`, `bahan_id`, `no_surat`, `tanggal_cutting`, `tanggal_selesai`, `tanggal_keluar`, `hasil_cutting`, `konversi`, `status`, `status_potong`, `created_at`, `updated_at`) VALUES
(1, 2, 'SJK2012', '2021-12-14', '2021-12-15', NULL, 300.00, '25 Lusin 0 pcs', 'potong keluar', 'selesai', '2021-12-14 23:42:10', '2022-03-31 10:14:56'),
(2, 6, 'SJK2', '2022-01-04', '2022-01-04', NULL, 75.00, '6 Lusin 3 pcs', 'potong keluar', 'selesai', '2022-01-04 10:05:00', '2022-03-31 10:14:56'),
(3, 7, 'SJK3', '2022-01-04', '2022-01-04', NULL, 75.00, '6 Lusin 3 pcs', 'potong keluar', 'selesai', '2022-01-04 10:05:19', '2022-03-31 10:14:56'),
(4, 8, 'SJK4', '2022-01-04', '2022-01-04', NULL, 75.00, '6 Lusin 3 pcs', 'potong keluar', 'selesai', '2022-01-04 10:05:36', '2022-03-31 10:14:56'),
(5, 9, 'SJK6', '2022-01-04', '2022-01-04', NULL, 150.00, '12 Lusin 6 pcs', 'potong keluar', 'selesai', '2022-01-04 10:06:03', '2022-03-31 10:14:56'),
(6, 11, 'NSJB6', '2022-01-10', '2022-01-10', NULL, 300.00, '25 Lusin 0 pcs', 'potong keluar', 'selesai', '2022-01-10 12:22:03', '2022-03-31 10:14:56'),
(7, 12, 'NSJB62', '2022-01-10', '2022-01-10', NULL, 300.00, '25 Lusin 0 pcs', 'potong keluar', 'selesai', '2022-01-10 12:22:27', '2022-03-31 10:14:56'),
(8, 13, 'NSJB63', '2022-01-10', '2022-01-10', NULL, 300.00, '25 Lusin 0 pcs', 'potong keluar', 'selesai', '2022-01-10 12:22:47', '2022-03-31 10:14:56'),
(9, 15, 'SJK71', '2022-02-03', '2022-02-03', NULL, 100.00, '8 Lusin 4 pcs', 'potong keluar', 'selesai', '2022-02-03 09:18:11', '2022-03-31 10:14:56'),
(10, 16, 'SJK72', '2022-02-03', '2022-02-03', NULL, 100.00, '8 Lusin 4 pcs', 'potong keluar', 'selesai', '2022-02-03 09:18:43', '2022-03-31 10:14:56'),
(11, 17, 'SJK73', '2022-02-03', '2022-02-03', NULL, 50.00, '4 Lusin 2 pcs', 'potong keluar', 'selesai', '2022-02-03 09:19:22', '2022-03-31 10:14:56'),
(12, 19, 'SJN92144899', '2022-03-25', '2022-03-25', NULL, 120.00, '10 Lusin 0 pcs', 'potong keluar', 'selesai', '2022-03-25 20:26:02', '2022-03-31 10:14:56'),
(13, 21, 'SJ02', '2022-03-31', '2022-03-31', NULL, 90.00, '7 Lusin 6 pcs', 'potong keluar', 'selesai', '2022-03-31 10:12:07', '2022-03-31 10:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo_id` bigint UNSIGNED DEFAULT NULL,
  `warehouse_id` bigint UNSIGNED DEFAULT NULL,
  `barcode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi_produk` longtext COLLATE utf8mb4_unicode_ci,
  `stok` int NOT NULL,
  `harga` int NOT NULL DEFAULT '0',
  `harga_promo` int NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_sub_kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produks`
--

INSERT INTO `produks` (`id`, `kode_produk`, `promo_id`, `warehouse_id`, `barcode`, `nama_produk`, `deskripsi_produk`, `stok`, `harga`, `harga_promo`, `status`, `kategori`, `sub_kategori`, `detail_sub_kategori`, `created_at`, `updated_at`) VALUES
(1, 'PRD-1', NULL, 1, NULL, 'kaos polo bersaku', 'test', 254, 100000, 100000, NULL, 'Pria', 'Kemeja', 'Kemeja Lengan Panjang', '2021-12-14 23:49:17', '2022-03-16 13:40:07'),
(2, 'PRD-2', NULL, 2, '55665566', 'kaos polo bersaku', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 150, 70000, 70000, NULL, 'Pria', 'Kaos', 'Kaos Polos', '2022-01-04 10:21:40', '2022-01-10 09:11:31'),
(3, 'PRD-3', NULL, 3, '22332233', 'Kaos Polos Hitam', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 75, 60000, 60000, NULL, 'Pria', 'Kaos', 'Kaos Polos', '2022-01-04 10:22:37', '2022-01-10 09:11:13'),
(4, 'PRD-4', NULL, 4, '11223344', 'Kaos Polos', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 75, 65000, 65000, NULL, 'Pria', 'Kaos', 'Kaos Polos', '2022-01-04 10:22:47', '2022-01-10 09:11:03'),
(5, 'PRD-5', NULL, 5, '123456789', 'Kaos Polos Hitam', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 75, 75000, 75000, NULL, 'Pria', 'Kaos', 'Kaos Polos', '2022-01-04 10:24:07', '2022-01-10 09:08:20'),
(6, 'PRD-6', NULL, 6, NULL, 'Kain Linen Anak', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 300, 100000, 100000, NULL, 'Pria', 'Kemeja', 'Kemeja Lengan Panjang', '2022-01-10 12:47:40', '2022-01-10 12:47:40'),
(7, 'PRD-7', NULL, 7, NULL, 'Kain Linen Anak', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 300, 110000, 110000, NULL, 'Pria', 'Kemeja', 'Kemeja Lengan Panjang', '2022-01-10 12:48:08', '2022-01-10 12:48:08'),
(8, 'PRD-8', NULL, 8, NULL, 'Kain Linen Anak', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 297, 105000, 105000, NULL, 'Pria', 'Kemeja', 'Kemeja Lengan Panjang', '2022-01-10 12:48:35', '2022-01-30 22:16:40'),
(9, 'PRD-9', NULL, 10, NULL, 'Kaos Merah Polos', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 99, 0, 0, NULL, 'Pria', 'Kaos', 'Kaos Polos', '2022-02-03 09:47:08', '2022-03-30 13:11:43'),
(10, 'PRD-10', NULL, 11, NULL, 'Kaos Merah Polos', '-', 100, 0, 0, NULL, 'Wanita', 'Kemeja', 'Kemeja Lengan Pendek', '2022-02-03 09:50:46', '2022-02-03 09:50:46'),
(11, 'PRD-11', NULL, 12, NULL, 'Kaos Polos Hitam', 'Ini adalah kaos dengan kain terbaik', 90, 0, 0, NULL, 'Pria', 'Kaos', 'Kaos Polos', '2022-03-31 10:25:26', '2022-03-31 10:25:26');

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE `promos` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo_mulai` date NOT NULL,
  `promo_berakhir` date NOT NULL,
  `potongan` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekapitulasis`
--

CREATE TABLE `rekapitulasis` (
  `id` bigint UNSIGNED NOT NULL,
  `cuci_id` bigint UNSIGNED DEFAULT NULL,
  `jahit_id` bigint UNSIGNED DEFAULT NULL,
  `jumlah_diperbaiki` int DEFAULT NULL,
  `jumlah_dibuang` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekapitulasis`
--

INSERT INTO `rekapitulasis` (`id`, `cuci_id`, `jahit_id`, `jumlah_diperbaiki`, `jumlah_dibuang`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 5, 5, '2021-12-14 23:45:34', '2021-12-14 23:45:34'),
(2, NULL, 1, 10, 10, '2021-12-14 23:45:34', '2021-12-14 23:45:34'),
(3, 2, NULL, 0, 0, '2022-03-13 14:48:46', '2022-03-13 14:48:46'),
(4, 3, NULL, 0, 0, '2022-03-13 14:48:46', '2022-03-13 14:48:46'),
(5, 4, NULL, 0, 0, '2022-03-13 14:48:46', '2022-03-13 14:48:46'),
(6, 5, NULL, 0, 0, '2022-03-13 14:48:46', '2022-03-13 14:48:46'),
(7, 6, NULL, 0, 0, '2022-03-13 14:48:46', '2022-03-13 14:48:46'),
(8, 7, NULL, 0, 0, '2022-03-13 14:48:46', '2022-03-13 14:48:46'),
(9, 8, NULL, 0, 0, '2022-03-13 14:48:46', '2022-03-13 14:48:46'),
(10, NULL, 2, 0, 0, '2022-03-13 14:48:46', '2022-03-13 14:48:46'),
(11, NULL, 3, 0, 0, '2022-03-13 14:48:46', '2022-03-13 14:48:46'),
(12, NULL, 4, 0, 0, '2022-03-13 14:48:46', '2022-03-13 14:48:46'),
(13, NULL, 5, 0, 0, '2022-03-13 14:48:46', '2022-03-13 14:48:46'),
(14, NULL, 6, 0, 0, '2022-03-13 14:48:46', '2022-03-13 14:48:46'),
(15, NULL, 7, 0, 0, '2022-03-13 14:48:46', '2022-03-13 14:48:46'),
(16, NULL, 8, 0, 0, '2022-03-13 14:48:46', '2022-03-13 14:48:46'),
(17, NULL, 9, 0, 0, '2022-03-13 14:48:46', '2022-03-13 14:48:46'),
(18, NULL, 10, 0, 0, '2022-03-13 14:48:46', '2022-03-13 14:48:46'),
(19, NULL, 11, 0, 0, '2022-03-13 14:48:46', '2022-03-13 14:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `rekapitulasi_warehouses`
--

CREATE TABLE `rekapitulasi_warehouses` (
  `id` bigint UNSIGNED NOT NULL,
  `warehouse_id` bigint UNSIGNED DEFAULT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `jumlah_diretur` int DEFAULT NULL,
  `jumlah_dibuang` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekapitulasi_warehouses`
--

INSERT INTO `rekapitulasi_warehouses` (`id`, `warehouse_id`, `tanggal_kirim`, `tanggal_masuk`, `jumlah_diretur`, `jumlah_dibuang`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 5, 5, '2022-03-14 08:41:47', '2022-03-14 08:41:47'),
(2, 2, NULL, NULL, 0, 0, '2022-03-14 08:41:47', '2022-03-14 08:41:47'),
(3, 3, NULL, NULL, 0, 0, '2022-03-14 08:41:47', '2022-03-14 08:41:47'),
(4, 4, NULL, NULL, 0, 0, '2022-03-14 08:41:47', '2022-03-14 08:41:47'),
(5, 5, NULL, NULL, 0, 0, '2022-03-14 08:41:47', '2022-03-14 08:41:47'),
(6, 6, NULL, NULL, 0, 0, '2022-03-14 08:41:47', '2022-03-14 08:41:47'),
(7, 7, NULL, NULL, 0, 0, '2022-03-14 08:41:47', '2022-03-14 08:41:47'),
(8, 8, NULL, NULL, 0, 0, '2022-03-14 08:41:47', '2022-03-14 08:41:47'),
(9, 9, NULL, NULL, 0, 0, '2022-03-14 08:41:47', '2022-03-14 08:41:47'),
(10, 10, NULL, NULL, 0, 0, '2022-03-14 08:41:47', '2022-03-14 08:41:47'),
(11, 11, NULL, NULL, 0, 0, '2022-03-14 08:41:47', '2022-03-14 08:41:47');

-- --------------------------------------------------------

--
-- Table structure for table `returs`
--

CREATE TABLE `returs` (
  `id` bigint UNSIGNED NOT NULL,
  `finishing_id` bigint UNSIGNED DEFAULT NULL,
  `total_barang` int NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `keterangan_diretur` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'production', 'web', '2021-12-14 23:39:55', '2021-12-14 23:39:55'),
(2, 'warehouse', 'web', '2021-12-14 23:39:55', '2021-12-14 23:39:55'),
(3, 'admin-online', 'web', '2021-12-14 23:39:55', '2021-12-14 23:39:55'),
(4, 'admin-offline', 'web', '2021-12-14 23:39:55', '2021-12-14 23:39:55'),
(5, 'ecommerce', 'web', '2021-12-14 23:39:55', '2021-12-14 23:39:55');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sampahs`
--

CREATE TABLE `sampahs` (
  `id` bigint UNSIGNED NOT NULL,
  `cuci_id` bigint UNSIGNED DEFAULT NULL,
  `jahit_id` bigint UNSIGNED DEFAULT NULL,
  `total` int NOT NULL DEFAULT '0',
  `tanggal_masuk` date DEFAULT NULL,
  `asal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sampahs`
--

INSERT INTO `sampahs` (`id`, `cuci_id`, `jahit_id`, `total`, `tanggal_masuk`, `asal`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 5, '2021-12-14', 'cuci', '2022-01-10 12:31:43', '2022-01-10 12:31:43'),
(2, 2, NULL, 0, '2022-01-04', 'cuci', '2022-01-10 12:31:43', '2022-01-10 12:31:43'),
(3, 3, NULL, 0, '2022-01-04', 'cuci', '2022-01-10 12:31:43', '2022-01-10 12:31:43'),
(4, 4, NULL, 0, '2022-01-04', 'cuci', '2022-01-10 12:31:43', '2022-01-10 12:31:43'),
(5, 5, NULL, 0, '2022-01-04', 'cuci', '2022-01-10 12:31:43', '2022-01-10 12:31:43'),
(6, 6, NULL, 0, '2022-01-10', 'cuci', '2022-01-10 12:31:43', '2022-01-10 12:31:43'),
(7, 7, NULL, 0, '2022-01-10', 'cuci', '2022-01-10 12:31:43', '2022-01-10 12:31:43'),
(8, 8, NULL, 0, '2022-01-10', 'cuci', '2022-01-10 12:31:43', '2022-01-10 12:31:43'),
(9, NULL, 1, 10, '2021-12-14', 'jahit', '2022-01-10 12:31:43', '2022-01-10 12:31:43'),
(10, NULL, 2, 0, '2022-01-04', 'jahit', '2022-01-10 12:31:43', '2022-01-10 12:31:43'),
(11, NULL, 3, 0, '2022-01-04', 'jahit', '2022-01-10 12:31:43', '2022-01-10 12:31:43'),
(12, NULL, 4, 0, '2022-01-04', 'jahit', '2022-01-10 12:31:43', '2022-01-10 12:31:43'),
(13, NULL, 5, 0, '2022-01-04', 'jahit', '2022-01-10 12:31:43', '2022-01-10 12:31:43'),
(14, NULL, 6, 0, '2022-01-10', 'jahit', '2022-01-10 12:31:43', '2022-01-10 12:31:43'),
(15, NULL, 7, 0, '2022-01-10', 'jahit', '2022-01-10 12:31:43', '2022-01-10 12:31:43'),
(16, NULL, 8, 0, '2022-01-10', 'jahit', '2022-01-10 12:31:43', '2022-01-10 12:31:43'),
(17, NULL, 9, 0, '2022-02-03', 'jahit', '2022-03-13 14:48:47', '2022-03-13 14:48:47'),
(18, NULL, 10, 0, '2022-02-03', 'jahit', '2022-03-13 14:48:47', '2022-03-13 14:48:47'),
(19, NULL, 11, 0, '2022-02-03', 'jahit', '2022-03-13 14:48:47', '2022-03-13 14:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `sub_kategoris`
--

CREATE TABLE `sub_kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED DEFAULT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_kategoris`
--

INSERT INTO `sub_kategoris` (`id`, `kategori_id`, `nama_kategori`, `sku`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kemeja', 'SKU001/1', '2021-12-14 23:39:56', '2021-12-14 23:39:56'),
(2, 2, 'Kemeja', 'SKU002/2', '2021-12-14 23:39:56', '2021-12-14 23:39:56'),
(3, 1, 'Kaos', 'SKU001/2', '2022-01-04 10:01:49', '2022-01-04 10:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint UNSIGNED NOT NULL,
  `bank_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `alamat_id` bigint UNSIGNED DEFAULT NULL,
  `no_resi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ongkir` double DEFAULT NULL,
  `kode_transaksi` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_transaksi` timestamp NOT NULL,
  `qty` int NOT NULL DEFAULT '0',
  `total_harga` double NOT NULL,
  `status_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_bayar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_bayar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bayar` double DEFAULT NULL,
  `kembalian` double DEFAULT NULL,
  `biaya_admin` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id`, `bank_id`, `user_id`, `alamat_id`, `no_resi`, `ongkir`, `kode_transaksi`, `tgl_transaksi`, `qty`, `total_harga`, `status_transaksi`, `status`, `status_bayar`, `bukti_bayar`, `bayar`, `kembalian`, `biaya_admin`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 3, NULL, NULL, 'INV281220211', '2021-12-28 14:09:57', 1, 102500, 'online', 'butuh konfirmasi', 'belum dibayar', NULL, NULL, NULL, 0, '2021-12-28 14:09:57', '2021-12-28 14:09:57'),
(2, 1, 5, 3, NULL, NULL, 'INV311220212', '2021-12-31 10:35:39', 1, 102500, 'online', 'butuh konfirmasi', 'belum dibayar', NULL, NULL, NULL, 0, '2021-12-31 10:35:39', '2021-12-31 10:35:39'),
(3, 1, 5, 4, NULL, NULL, 'INV010120223', '2022-01-01 20:21:11', 1, 102500, 'online', 'butuh konfirmasi', 'belum dibayar', NULL, NULL, NULL, 0, '2022-01-01 20:21:11', '2022-01-01 20:21:11'),
(4, 1, 5, 4, NULL, NULL, 'INV010120224', '2022-01-01 20:28:32', 1, 102500, 'online', 'butuh konfirmasi', 'belum dibayar', NULL, NULL, NULL, 0, '2022-01-01 20:28:32', '2022-01-01 20:28:32'),
(5, 1, 5, 4, NULL, NULL, 'INV010120225', '2022-01-01 20:42:04', 1, 102500, 'online', 'butuh konfirmasi', 'belum dibayar', NULL, NULL, NULL, 0, '2022-01-01 20:42:04', '2022-01-01 20:42:04'),
(6, 1, 5, 4, NULL, NULL, 'INV010120226', '2022-01-01 20:43:08', 1, 102500, 'online', 'butuh konfirmasi', 'belum dibayar', NULL, NULL, NULL, 0, '2022-01-01 20:43:08', '2022-01-01 20:43:08'),
(7, 1, 5, 4, NULL, NULL, 'INV010120227', '2022-01-01 20:47:02', 1, 102500, 'online', 'butuh konfirmasi', 'belum dibayar', NULL, NULL, NULL, 0, '2022-01-01 20:47:02', '2022-01-01 20:47:02'),
(8, 1, 5, 4, NULL, NULL, 'INV010120228', '2022-01-01 20:48:21', 1, 102500, 'online', 'butuh konfirmasi', 'belum dibayar', NULL, NULL, NULL, 0, '2022-01-01 20:48:21', '2022-01-01 20:48:21'),
(9, 1, 5, 4, NULL, NULL, 'INV010120229', '2022-01-01 20:54:27', 1, 102500, 'online', 'butuh konfirmasi', 'belum dibayar', NULL, NULL, NULL, 0, '2022-01-01 20:54:27', '2022-01-01 20:54:27'),
(10, 1, 5, 4, NULL, NULL, 'INV0101202210', '2022-01-01 21:27:26', 1, 102500, 'online', 'butuh konfirmasi', 'belum dibayar', NULL, NULL, NULL, 0, '2022-01-01 21:27:26', '2022-01-01 21:27:26'),
(11, 1, 5, 4, NULL, NULL, 'INV0101202211', '2022-01-01 22:48:47', 1, 102500, 'online', 'butuh konfirmasi', 'belum dibayar', NULL, NULL, NULL, 0, '2022-01-01 22:48:47', '2022-01-01 22:48:47'),
(12, 1, 5, 4, '253264112', NULL, 'INV0101202212', '2022-01-01 22:53:13', 1, 102500, 'online', 'dikirim', 'sudah dibayar', NULL, NULL, NULL, 0, '2022-01-01 22:53:13', '2022-01-13 13:59:54'),
(13, 1, 9, 5, NULL, NULL, 'INV0301202213', '2022-01-03 14:48:27', 1, 102500, 'online', 'butuh konfirmasi', 'belum dibayar', NULL, NULL, NULL, 0, '2022-01-03 14:48:27', '2022-01-03 14:48:27'),
(14, 1, 9, 5, NULL, NULL, 'INV1101202214', '2022-01-11 09:52:32', 1, 102500, 'online', 'butuh konfirmasi', 'belum dibayar', NULL, NULL, NULL, 0, '2022-01-11 09:52:32', '2022-01-11 09:52:32'),
(15, 1, 9, 5, NULL, NULL, 'INV1101202215', '2022-01-11 10:14:19', 1, 62500, 'online', 'butuh konfirmasi', 'sudah di upload', '164187101546062.jpg', NULL, NULL, 0, '2022-01-11 10:14:19', '2022-01-11 10:16:55'),
(16, 1, 5, 3, NULL, NULL, 'INV1701202216', '2022-01-17 12:43:52', 1, 200000, 'online', 'butuh konfirmasi', 'belum dibayar', NULL, NULL, NULL, 2500, '2022-01-17 12:43:52', '2022-01-17 12:43:52'),
(17, 1, 5, 3, NULL, NULL, 'INV1801202217', '2022-01-18 14:52:39', 1, 100000, 'online', 'butuh konfirmasi', 'sudah di upload', '164249237830848.jpg', NULL, NULL, 2500, '2022-01-18 14:52:39', '2022-01-18 14:52:58'),
(18, 1, 14, 6, NULL, NULL, 'INV1901202218', '2022-01-19 02:52:23', 1, 70000, 'online', 'butuh konfirmasi', 'sudah di upload', '164253556757774.jpg', NULL, NULL, 2500, '2022-01-19 02:52:23', '2022-01-19 02:52:47'),
(19, 1, 5, 3, NULL, NULL, 'INV1901202219', '2022-01-19 12:26:21', 4, 330000, 'online', 'butuh konfirmasi', 'sudah di upload', '164257003197567.jpg', NULL, NULL, 2500, '2022-01-19 12:26:21', '2022-01-19 12:27:11'),
(20, 1, 5, 3, '12132asdjahd', NULL, 'INV1901202220', '2022-01-19 12:28:13', 1, 100000, 'online', 'dikirim', 'sudah dibayar', '164257010232014.jpg', NULL, NULL, 2500, '2022-01-19 12:28:13', '2022-03-31 10:29:32'),
(21, NULL, NULL, NULL, NULL, NULL, 'INV3001202221', '2022-01-30 22:16:40', 1, 100000, 'offline', NULL, NULL, NULL, 100000, 0, 0, '2022-01-30 22:16:40', '2022-01-30 22:16:40'),
(22, 1, 6, 7, NULL, NULL, 'INV3001202222', '2022-01-30 22:25:05', 2, 232500, 'online', 'butuh konfirmasi', 'belum dibayar', NULL, NULL, NULL, 0, '2022-01-30 22:25:05', '2022-01-30 22:25:05'),
(23, 1, 5, 3, NULL, NULL, 'INV1702202223', '2022-02-17 16:01:40', 1, 150000, 'online', 'butuh konfirmasi', 'belum dibayar', NULL, NULL, NULL, 2500, '2022-02-17 16:01:40', '2022-02-17 16:01:40'),
(24, 1, 5, 3, NULL, NULL, 'INV1802202224', '2022-02-18 22:08:04', 4, 540000, 'online', 'butuh konfirmasi', 'belum dibayar', NULL, NULL, NULL, 2500, '2022-02-18 22:08:04', '2022-02-18 22:08:04'),
(25, 1, 9, 5, '12132asdjahd', NULL, 'INV1603202225', '2022-03-16 13:38:43', 1, 150000, 'online', 'telah tiba', 'sudah dibayar', '164741276379138.jpg', NULL, NULL, 2500, '2022-03-16 13:38:43', '2022-03-29 09:12:19'),
(26, NULL, NULL, NULL, NULL, NULL, 'INV3003202226', '2022-03-30 13:11:46', 1, 80000, 'offline', NULL, NULL, NULL, 100000, 20000, 0, '2022-03-30 13:11:46', '2022-03-30 13:11:46');

-- --------------------------------------------------------

--
-- Table structure for table `ulasans`
--

CREATE TABLE `ulasans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `transaksi_id` bigint UNSIGNED DEFAULT NULL,
  `produk_id` bigint UNSIGNED DEFAULT NULL,
  `rating` int NOT NULL,
  `ulasan` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ulasans`
--

INSERT INTO `ulasans` (`id`, `user_id`, `transaksi_id`, `produk_id`, `rating`, `ulasan`, `created_at`, `updated_at`) VALUES
(1, 5, 12, 1, 4, 'coba', '2022-01-07 15:00:49', '2022-01-08 09:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `tanggal_lahir`, `jenis_kelamin`, `no_hp`, `password`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'produksi', 'produksi@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$Z/4.DurhiZs1hU5p3ebA/.PB5UjKvmJ44A3Eaj8jCUCQ36Hsk497i', NULL, NULL, '2021-12-14 23:39:56', '2021-12-14 23:39:56'),
(2, 'gudang', 'gudang@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$POUyQbgNV0pGd3Zmmkoz/uGMqeScMuDSZ5ztE53GRWSWH/U5hPCj.', NULL, NULL, '2021-12-14 23:39:56', '2021-12-14 23:39:56'),
(3, 'admin', 'admin_offline@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$mfB5H2VAHgAq.8tE0afyQuNucA67CGUIvPkaZH4QsKlQmWi/eja9e', NULL, NULL, '2021-12-14 23:39:56', '2021-12-14 23:39:56'),
(4, 'admin', 'admin_online@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$H.GjoqwlWvUabQiarQv5Tu2rYFJEyIoFzhSB6sPHnQmizKlFqdaN.', NULL, NULL, '2021-12-14 23:39:56', '2021-12-14 23:39:56'),
(5, 'Zaki M', 'kakzaki@gmail.com', NULL, '2021-12-26', 'Pria', '085704703691', '$2y$10$PO0zSN91yOWTJPTokbG8leNr2WA.X4dmef5kRk4GCIF.RT84v5kai', '164051823716805.jpg', NULL, '2021-12-15 15:39:05', '2021-12-26 18:30:37'),
(6, 'alvian', 'alvianar@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$ZYlaTW83bogToIq8pcwcZeUEl4KK1uBcAtEED2cuTK8VTTH8EKo2O', NULL, NULL, '2021-12-15 15:53:13', '2021-12-15 15:53:13'),
(7, 'alvian ardi', 'alviana1r@gmail.com', NULL, '2021-10-12', 'Pria', '087852560682', '$2y$10$uEF8nTKNBYnP9e8i9rZbneAf/suXtNfZNMz4YHonSp.VtNDJthvpi', NULL, NULL, '2021-12-15 15:55:23', '2021-12-26 18:27:51'),
(8, 'Zaki M', 'kakzaki2@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$mIQz5ZzkQ6H5XSUgbLvbKujcuF2kRelJLehtdq2Q0d2eIGbP0fTjq', NULL, NULL, '2021-12-15 16:12:27', '2021-12-15 16:12:27'),
(9, 'Ardito', 'ardito@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$WLdymyJUXY6hQhN.Y5B9J.aAJuywxJ9OqvERzboCkxW307RLTInh6', NULL, NULL, '2021-12-17 09:22:05', '2021-12-17 09:22:05'),
(10, 'alvian', 'alviantest@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$0TLa67OZXdmj2.NH.kil6OdR9WCZxmv4MrCMFU0oVJzEODKj0GYYq', NULL, NULL, '2021-12-17 10:06:09', '2021-12-17 10:06:09'),
(11, 'alvian ardhiansyah', 'alvianardhiansyah212@gmail.com', NULL, NULL, NULL, NULL, '0', NULL, 'XN3r7E654GntIPPmtpJWHVu3hA3WwN4tieshPr8ocAkivayQymwQnezpTi3n', '2021-12-18 11:03:17', '2021-12-18 11:03:17'),
(12, 'Zaki Mubarok', 'kakzaki3@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$64ONfuwYLy27dagtzivlau.xm.iUFZfBFIqpM0x32c/boMxnMMfB2', NULL, NULL, '2021-12-19 21:15:49', '2021-12-19 21:15:49'),
(13, 'alvian', 'alviana1r3@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$IXdx7jtnUO1sQHCVXwF5z.Vvi3QPze18y/8SYlk9nCqWqqcT/rlZ.', NULL, NULL, '2021-12-19 21:16:29', '2021-12-19 21:16:29'),
(14, 'hendro', 'indrokusworo@gmail.com', NULL, '2021-12-27', 'Pria', '082233901438', '$2y$10$IUAfjAnXABMnV5.9HAR9wu4i/BlkL8iug7xqZYdT8JCIyULFnoMR6', '164053927193693.jpg', NULL, '2021-12-27 00:18:32', '2021-12-27 00:21:11'),
(15, 'saiful', 'winstarlinkmedia@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$jV/u9G6dr3wG0I5PYf8f6OoFwJdovNV7U2r/g4ESG/5HwV3txKtDe', NULL, NULL, '2021-12-28 10:46:07', '2021-12-28 10:46:07'),
(16, 'Aziz Muslim', 'abdulaziz_muslim@ymail.com', NULL, NULL, NULL, NULL, '$2y$10$WJAAOhrkjbpu.bHui3kete6sFQcllCLdE8VNDo0oEZ7a1ljVHqFcC', NULL, NULL, '2021-12-30 00:08:23', '2021-12-30 00:08:23'),
(17, 'User Testing', 'usertest@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$E6blBVUrjx4Fac3dYAdLte9g4Apft.N1eee6PIENfI6rTQ2UCIVHW', NULL, NULL, '2021-12-30 09:50:20', '2021-12-30 09:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint UNSIGNED NOT NULL,
  `finishing_id` bigint UNSIGNED DEFAULT NULL,
  `harga_produk` double(8,2) NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `finishing_id`, `harga_produk`, `tanggal_masuk`, `created_at`, `updated_at`) VALUES
(1, 1, 100000.00, NULL, '2021-12-14 23:47:36', '2021-12-14 23:47:56'),
(2, 2, 70000.00, NULL, '2022-01-04 10:18:08', '2022-01-04 10:20:18'),
(3, 3, 60000.00, NULL, '2022-01-04 10:18:38', '2022-01-04 10:20:10'),
(4, 5, 65000.00, NULL, '2022-01-04 10:19:08', '2022-01-04 10:19:59'),
(5, 4, 75000.00, NULL, '2022-01-04 10:19:33', '2022-01-04 10:19:50'),
(6, 8, 100000.00, NULL, '2022-01-10 12:40:59', '2022-01-10 12:44:49'),
(7, 7, 110000.00, NULL, '2022-01-10 12:41:25', '2022-01-10 12:44:39'),
(8, 6, 105000.00, NULL, '2022-01-10 12:43:48', '2022-01-10 12:44:31'),
(9, 11, 0.00, NULL, '2022-02-03 09:33:53', '2022-02-03 09:33:53'),
(10, 10, 0.00, NULL, '2022-02-03 09:34:25', '2022-02-03 09:34:25'),
(11, 9, 0.00, NULL, '2022-02-03 09:34:53', '2022-02-03 09:34:53'),
(12, 12, 0.00, NULL, '2022-03-31 10:21:52', '2022-03-31 10:21:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamats`
--
ALTER TABLE `alamats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alamats_user_id_index` (`user_id`);

--
-- Indexes for table `bahans`
--
ALTER TABLE `bahans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bahans_detail_sub_kategori_id_index` (`detail_sub_kategori_id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cucis`
--
ALTER TABLE `cucis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cucis_jahit_id_index` (`jahit_id`);

--
-- Indexes for table `cuci_dibuangs`
--
ALTER TABLE `cuci_dibuangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuci_dibuangs_cuci_id_index` (`cuci_id`);

--
-- Indexes for table `cuci_direpairs`
--
ALTER TABLE `cuci_direpairs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuci_direpairs_cuci_id_index` (`cuci_id`);

--
-- Indexes for table `detail_cucis`
--
ALTER TABLE `detail_cucis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_cucis_cuci_id_index` (`cuci_id`);

--
-- Indexes for table `detail_finishings`
--
ALTER TABLE `detail_finishings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_finishings_finishing_id_index` (`finishing_id`);

--
-- Indexes for table `detail_jahits`
--
ALTER TABLE `detail_jahits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_jahits_jahit_id_index` (`jahit_id`);

--
-- Indexes for table `detail_perbaikans`
--
ALTER TABLE `detail_perbaikans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_perbaikans_perbaikan_id_index` (`perbaikan_id`),
  ADD KEY `detail_perbaikans_jahit_direpair_id_index` (`jahit_direpair_id`),
  ADD KEY `detail_perbaikans_cuci_direpair_id_index` (`cuci_direpair_id`);

--
-- Indexes for table `detail_potongs`
--
ALTER TABLE `detail_potongs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_potongs_potong_id_index` (`potong_id`);

--
-- Indexes for table `detail_produks`
--
ALTER TABLE `detail_produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_produks_produk_id_index` (`produk_id`);

--
-- Indexes for table `detail_produk_images`
--
ALTER TABLE `detail_produk_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_produk_images_produk_id_index` (`produk_id`);

--
-- Indexes for table `detail_rekapitulasis`
--
ALTER TABLE `detail_rekapitulasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_rekapitulasis_rekapitulasi_id_index` (`rekapitulasi_id`);

--
-- Indexes for table `detail_rekapitulasi_warehouses`
--
ALTER TABLE `detail_rekapitulasi_warehouses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_rekapitulasi_warehouses_rekapitulasi_warehouse_id_index` (`rekapitulasi_warehouse_id`);

--
-- Indexes for table `detail_returs`
--
ALTER TABLE `detail_returs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_returs_retur_id_index` (`retur_id`);

--
-- Indexes for table `detail_sampahs`
--
ALTER TABLE `detail_sampahs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_sampahs_sampah_id_index` (`sampah_id`);

--
-- Indexes for table `detail_sub_kategoris`
--
ALTER TABLE `detail_sub_kategoris`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_sub_kategoris_sub_kategori_id_index` (`sub_kategori_id`);

--
-- Indexes for table `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_transaksis_transaksi_id_index` (`transaksi_id`),
  ADD KEY `detail_transaksis_produk_id_index` (`produk_id`),
  ADD KEY `detail_transaksis_promo_id_index` (`promo_id`);

--
-- Indexes for table `detail_warehouses`
--
ALTER TABLE `detail_warehouses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_warehouses_warehouse_id_index` (`warehouse_id`);

--
-- Indexes for table `favorits`
--
ALTER TABLE `favorits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorits_user_id_index` (`user_id`),
  ADD KEY `favorits_produk_id_index` (`produk_id`);

--
-- Indexes for table `finishings`
--
ALTER TABLE `finishings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `finishings_cuci_id_index` (`cuci_id`);

--
-- Indexes for table `finishing_dibuangs`
--
ALTER TABLE `finishing_dibuangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `finishing_dibuangs_finishing_id_index` (`finishing_id`);

--
-- Indexes for table `finishing_returs`
--
ALTER TABLE `finishing_returs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `finishing_returs_finishing_id_index` (`finishing_id`);

--
-- Indexes for table `jahits`
--
ALTER TABLE `jahits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jahits_potong_id_index` (`potong_id`);

--
-- Indexes for table `jahit_dibuangs`
--
ALTER TABLE `jahit_dibuangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jahit_dibuangs_jahit_id_index` (`jahit_id`);

--
-- Indexes for table `jahit_direpairs`
--
ALTER TABLE `jahit_direpairs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jahit_direpairs_jahit_id_index` (`jahit_id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjangs`
--
ALTER TABLE `keranjangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keranjangs_user_id_index` (`user_id`),
  ADD KEY `keranjangs_produk_id_index` (`produk_id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_ecommerces`
--
ALTER TABLE `notification_ecommerces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_ecommerces_user_id_index` (`user_id`),
  ADD KEY `notification_ecommerces_transaksi_id_index` (`transaksi_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pembayaran_cucis`
--
ALTER TABLE `pembayaran_cucis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_cucis_cuci_id_index` (`cuci_id`);

--
-- Indexes for table `pembayaran_jahits`
--
ALTER TABLE `pembayaran_jahits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_jahits_jahit_id_index` (`jahit_id`);

--
-- Indexes for table `perbaikans`
--
ALTER TABLE `perbaikans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perbaikans_bahan_id_index` (`bahan_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `potongs`
--
ALTER TABLE `potongs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `potongs_bahan_id_index` (`bahan_id`);

--
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `produks_kode_produk_unique` (`kode_produk`),
  ADD KEY `produks_promo_id_index` (`promo_id`),
  ADD KEY `produks_warehouse_id_index` (`warehouse_id`);

--
-- Indexes for table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `promos_kode_unique` (`kode`);

--
-- Indexes for table `rekapitulasis`
--
ALTER TABLE `rekapitulasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekapitulasis_cuci_id_index` (`cuci_id`),
  ADD KEY `rekapitulasis_jahit_id_index` (`jahit_id`);

--
-- Indexes for table `rekapitulasi_warehouses`
--
ALTER TABLE `rekapitulasi_warehouses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekapitulasi_warehouses_warehouse_id_index` (`warehouse_id`);

--
-- Indexes for table `returs`
--
ALTER TABLE `returs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `returs_finishing_id_index` (`finishing_id`);

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
-- Indexes for table `sampahs`
--
ALTER TABLE `sampahs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sampahs_cuci_id_index` (`cuci_id`),
  ADD KEY `sampahs_jahit_id_index` (`jahit_id`);

--
-- Indexes for table `sub_kategoris`
--
ALTER TABLE `sub_kategoris`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_kategoris_kategori_id_index` (`kategori_id`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaksis_kode_transaksi_unique` (`kode_transaksi`),
  ADD KEY `transaksis_bank_id_index` (`bank_id`),
  ADD KEY `transaksis_user_id_index` (`user_id`),
  ADD KEY `transaksis_alamat_id_index` (`alamat_id`);

--
-- Indexes for table `ulasans`
--
ALTER TABLE `ulasans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ulasans_user_id_index` (`user_id`),
  ADD KEY `ulasans_transaksi_id_index` (`transaksi_id`),
  ADD KEY `ulasans_produk_id_index` (`produk_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warehouses_finishing_id_index` (`finishing_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alamats`
--
ALTER TABLE `alamats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bahans`
--
ALTER TABLE `bahans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cucis`
--
ALTER TABLE `cucis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cuci_dibuangs`
--
ALTER TABLE `cuci_dibuangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cuci_direpairs`
--
ALTER TABLE `cuci_direpairs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_cucis`
--
ALTER TABLE `detail_cucis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `detail_finishings`
--
ALTER TABLE `detail_finishings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `detail_jahits`
--
ALTER TABLE `detail_jahits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `detail_perbaikans`
--
ALTER TABLE `detail_perbaikans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_potongs`
--
ALTER TABLE `detail_potongs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `detail_produks`
--
ALTER TABLE `detail_produks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `detail_produk_images`
--
ALTER TABLE `detail_produk_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `detail_rekapitulasis`
--
ALTER TABLE `detail_rekapitulasis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `detail_rekapitulasi_warehouses`
--
ALTER TABLE `detail_rekapitulasi_warehouses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `detail_returs`
--
ALTER TABLE `detail_returs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_sampahs`
--
ALTER TABLE `detail_sampahs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `detail_sub_kategoris`
--
ALTER TABLE `detail_sub_kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `detail_warehouses`
--
ALTER TABLE `detail_warehouses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `favorits`
--
ALTER TABLE `favorits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `finishings`
--
ALTER TABLE `finishings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `finishing_dibuangs`
--
ALTER TABLE `finishing_dibuangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `finishing_returs`
--
ALTER TABLE `finishing_returs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jahits`
--
ALTER TABLE `jahits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jahit_dibuangs`
--
ALTER TABLE `jahit_dibuangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jahit_direpairs`
--
ALTER TABLE `jahit_direpairs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keranjangs`
--
ALTER TABLE `keranjangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `notification_ecommerces`
--
ALTER TABLE `notification_ecommerces`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran_cucis`
--
ALTER TABLE `pembayaran_cucis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembayaran_jahits`
--
ALTER TABLE `pembayaran_jahits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perbaikans`
--
ALTER TABLE `perbaikans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `potongs`
--
ALTER TABLE `potongs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekapitulasis`
--
ALTER TABLE `rekapitulasis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `rekapitulasi_warehouses`
--
ALTER TABLE `rekapitulasi_warehouses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `returs`
--
ALTER TABLE `returs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sampahs`
--
ALTER TABLE `sampahs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sub_kategoris`
--
ALTER TABLE `sub_kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `ulasans`
--
ALTER TABLE `ulasans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamats`
--
ALTER TABLE `alamats`
  ADD CONSTRAINT `alamats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bahans`
--
ALTER TABLE `bahans`
  ADD CONSTRAINT `bahans_detail_sub_kategori_id_foreign` FOREIGN KEY (`detail_sub_kategori_id`) REFERENCES `detail_sub_kategoris` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cucis`
--
ALTER TABLE `cucis`
  ADD CONSTRAINT `cucis_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cuci_dibuangs`
--
ALTER TABLE `cuci_dibuangs`
  ADD CONSTRAINT `cuci_dibuangs_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cuci_direpairs`
--
ALTER TABLE `cuci_direpairs`
  ADD CONSTRAINT `cuci_direpairs_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_cucis`
--
ALTER TABLE `detail_cucis`
  ADD CONSTRAINT `detail_cucis_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_finishings`
--
ALTER TABLE `detail_finishings`
  ADD CONSTRAINT `detail_finishings_finishing_id_foreign` FOREIGN KEY (`finishing_id`) REFERENCES `finishings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_jahits`
--
ALTER TABLE `detail_jahits`
  ADD CONSTRAINT `detail_jahits_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_perbaikans`
--
ALTER TABLE `detail_perbaikans`
  ADD CONSTRAINT `detail_perbaikans_cuci_direpair_id_foreign` FOREIGN KEY (`cuci_direpair_id`) REFERENCES `cuci_direpairs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_perbaikans_jahit_direpair_id_foreign` FOREIGN KEY (`jahit_direpair_id`) REFERENCES `jahit_direpairs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_perbaikans_perbaikan_id_foreign` FOREIGN KEY (`perbaikan_id`) REFERENCES `perbaikans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_potongs`
--
ALTER TABLE `detail_potongs`
  ADD CONSTRAINT `detail_potongs_potong_id_foreign` FOREIGN KEY (`potong_id`) REFERENCES `potongs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_produks`
--
ALTER TABLE `detail_produks`
  ADD CONSTRAINT `detail_produks_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_produk_images`
--
ALTER TABLE `detail_produk_images`
  ADD CONSTRAINT `detail_produk_images_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_rekapitulasis`
--
ALTER TABLE `detail_rekapitulasis`
  ADD CONSTRAINT `detail_rekapitulasis_rekapitulasi_id_foreign` FOREIGN KEY (`rekapitulasi_id`) REFERENCES `rekapitulasis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_rekapitulasi_warehouses`
--
ALTER TABLE `detail_rekapitulasi_warehouses`
  ADD CONSTRAINT `detail_rekapitulasi_warehouses_rekapitulasi_warehouse_id_foreign` FOREIGN KEY (`rekapitulasi_warehouse_id`) REFERENCES `rekapitulasi_warehouses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_returs`
--
ALTER TABLE `detail_returs`
  ADD CONSTRAINT `detail_returs_retur_id_foreign` FOREIGN KEY (`retur_id`) REFERENCES `returs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_sampahs`
--
ALTER TABLE `detail_sampahs`
  ADD CONSTRAINT `detail_sampahs_sampah_id_foreign` FOREIGN KEY (`sampah_id`) REFERENCES `sampahs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_sub_kategoris`
--
ALTER TABLE `detail_sub_kategoris`
  ADD CONSTRAINT `detail_sub_kategoris_sub_kategori_id_foreign` FOREIGN KEY (`sub_kategori_id`) REFERENCES `sub_kategoris` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  ADD CONSTRAINT `detail_transaksis_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_transaksis_promo_id_foreign` FOREIGN KEY (`promo_id`) REFERENCES `promos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_transaksis_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_warehouses`
--
ALTER TABLE `detail_warehouses`
  ADD CONSTRAINT `detail_warehouses_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favorits`
--
ALTER TABLE `favorits`
  ADD CONSTRAINT `favorits_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `finishings`
--
ALTER TABLE `finishings`
  ADD CONSTRAINT `finishings_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `finishing_dibuangs`
--
ALTER TABLE `finishing_dibuangs`
  ADD CONSTRAINT `finishing_dibuangs_finishing_id_foreign` FOREIGN KEY (`finishing_id`) REFERENCES `finishings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `finishing_returs`
--
ALTER TABLE `finishing_returs`
  ADD CONSTRAINT `finishing_returs_finishing_id_foreign` FOREIGN KEY (`finishing_id`) REFERENCES `finishings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jahits`
--
ALTER TABLE `jahits`
  ADD CONSTRAINT `jahits_potong_id_foreign` FOREIGN KEY (`potong_id`) REFERENCES `potongs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jahit_dibuangs`
--
ALTER TABLE `jahit_dibuangs`
  ADD CONSTRAINT `jahit_dibuangs_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jahit_direpairs`
--
ALTER TABLE `jahit_direpairs`
  ADD CONSTRAINT `jahit_direpairs_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `keranjangs`
--
ALTER TABLE `keranjangs`
  ADD CONSTRAINT `keranjangs_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `keranjangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `notification_ecommerces`
--
ALTER TABLE `notification_ecommerces`
  ADD CONSTRAINT `notification_ecommerces_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notification_ecommerces_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran_cucis`
--
ALTER TABLE `pembayaran_cucis`
  ADD CONSTRAINT `pembayaran_cucis_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran_jahits`
--
ALTER TABLE `pembayaran_jahits`
  ADD CONSTRAINT `pembayaran_jahits_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `perbaikans`
--
ALTER TABLE `perbaikans`
  ADD CONSTRAINT `perbaikans_bahan_id_foreign` FOREIGN KEY (`bahan_id`) REFERENCES `bahans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `potongs`
--
ALTER TABLE `potongs`
  ADD CONSTRAINT `potongs_bahan_id_foreign` FOREIGN KEY (`bahan_id`) REFERENCES `bahans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `produks`
--
ALTER TABLE `produks`
  ADD CONSTRAINT `produks_promo_id_foreign` FOREIGN KEY (`promo_id`) REFERENCES `promos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produks_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rekapitulasis`
--
ALTER TABLE `rekapitulasis`
  ADD CONSTRAINT `rekapitulasis_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rekapitulasis_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rekapitulasi_warehouses`
--
ALTER TABLE `rekapitulasi_warehouses`
  ADD CONSTRAINT `rekapitulasi_warehouses_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `returs`
--
ALTER TABLE `returs`
  ADD CONSTRAINT `returs_finishing_id_foreign` FOREIGN KEY (`finishing_id`) REFERENCES `finishings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sampahs`
--
ALTER TABLE `sampahs`
  ADD CONSTRAINT `sampahs_cuci_id_foreign` FOREIGN KEY (`cuci_id`) REFERENCES `cucis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sampahs_jahit_id_foreign` FOREIGN KEY (`jahit_id`) REFERENCES `jahits` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_kategoris`
--
ALTER TABLE `sub_kategoris`
  ADD CONSTRAINT `sub_kategoris_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `transaksis_alamat_id_foreign` FOREIGN KEY (`alamat_id`) REFERENCES `alamats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksis_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ulasans`
--
ALTER TABLE `ulasans`
  ADD CONSTRAINT `ulasans_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ulasans_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ulasans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD CONSTRAINT `warehouses_finishing_id_foreign` FOREIGN KEY (`finishing_id`) REFERENCES `finishings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
