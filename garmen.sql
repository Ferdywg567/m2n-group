-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 03, 2023 at 04:56 AM
-- Server version: 8.0.30
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `provinsi_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_pos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alamats`
--

INSERT INTO `alamats` (`id`, `user_id`, `nama_penerima`, `no_telp`, `jenis_alamat`, `alamat_detail`, `provinsi`, `provinsi_id`, `kecamatan_id`, `kota_id`, `kota`, `kecamatan`, `kode_pos`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 'Ferdy', '087857600717', 'Kantor', 'Jalan Nginden Semolo no 69', 'Jawa Timur', '11', '6136', '444', 'Surabaya', 'Gayungan', '60118', 'Utama', '2023-03-13 08:05:31', '2023-03-13 08:05:31');

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
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bahans`
--

INSERT INTO `bahans` (`id`, `detail_sub_kategori_id`, `kode_transaksi`, `kode_bahan`, `no_surat`, `sku`, `nama_bahan`, `jenis_bahan`, `warna`, `panjang_bahan`, `panjang_bahan_diambil`, `sisa_bahan`, `vendor`, `tanggal_masuk`, `tanggal_keluar`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'BHN-0001', 'SJL-0001', NULL, 'kaos Polos', 'Cotton Combed 100s', 'Hitam', 100, NULL, NULL, 'PT Sumeh Jaya Corp', '2023-03-08', NULL, 'bahan keluar', NULL, '2023-03-08 08:35:38', '2023-03-08 08:39:39'),
(2, 1, 'TR-2023-03-08-0001', 'BHN-0001', 'SJL-0002', 'SKU001/1/1', 'kaos Polos', 'Cotton Combed 100s', 'Hitam', 100, 50, NULL, 'PT Sumeh Jaya Corp', '2023-03-08', '2023-03-08', 'bahan keluar', NULL, '2023-03-08 08:39:39', '2023-03-09 06:40:13'),
(3, NULL, NULL, 'BHN-0002', 'SJL-0003', NULL, 'Kemeja Flanel', 'Flanel', 'Hitam', 100, NULL, NULL, 'PT Sumeh Jaya Corp', '2023-03-09', NULL, 'bahan keluar', NULL, '2023-03-09 06:28:25', '2023-03-09 06:29:33'),
(4, 1, 'TR-2023-03-09-0001', 'BHN-0002', 'SJL-0004', 'SKU001/1/1', 'Kemeja Flanel', 'Flanel', 'Hitam', 100, 20, NULL, 'PT Sumeh Jaya Corp', '2023-03-09', '2023-03-09', 'bahan keluar', NULL, '2023-03-09 06:29:33', '2023-03-10 04:17:28'),
(5, 1, 'TR-2023-03-09-0002', 'BHN-0001', 'SJL-0005', 'SKU001/1/1', 'kaos Polos', 'Cotton Combed 100s', 'Hitam', 50, 40, NULL, 'PT Sumeh Jaya Corp', '2023-03-08', '2023-03-09', 'bahan keluar', NULL, '2023-03-09 06:40:13', '2023-03-10 08:07:44'),
(6, 2, 'TR-2023-03-10-0001', 'BHN-0002', 'SJL-0006', 'SKU002/2/2', 'Kemeja Flanel', 'Flanel', 'Hitam', 80, 20, NULL, 'PT Sumeh Jaya Corp', '2023-03-09', '2023-03-10', 'bahan keluar', NULL, '2023-03-10 04:17:28', '2023-03-10 04:24:35'),
(7, 2, 'TR-2023-03-10-0002', 'BHN-0002', 'SJL-0007', 'SKU002/2/2', 'Kemeja Flanel', 'Flanel', 'Hitam', 60, 30, NULL, 'PT Sumeh Jaya Corp', '2023-03-09', '2023-03-10', 'bahan keluar', NULL, '2023-03-10 04:24:35', '2023-03-10 06:30:10'),
(8, 1, 'TR-2023-03-10-0003', 'BHN-0002', 'SJL-0008', 'SKU001/1/1', 'Kemeja Flanel', 'Flanel', 'Hitam', 30, 30, 0, 'PT Sumeh Jaya Corp', '2023-03-09', '2023-03-10', 'bahan keluar', NULL, '2023-03-10 06:30:10', '2023-03-10 06:30:10'),
(9, 1, 'TR-2023-03-10-0004', 'BHN-0001', 'SJL-0009', 'SKU001/1/1', 'kaos Polos', 'Cotton Combed 100s', 'Hitam', 10, 10, 0, 'PT Sumeh Jaya Corp', '2023-03-08', '2023-03-10', 'bahan keluar', NULL, '2023-03-10 08:07:44', '2023-03-10 08:07:44'),
(10, NULL, NULL, 'BHN-0003', 'SJL-0010', NULL, 'Jeans', 'Denim', 'Navy', 10000, NULL, NULL, 'PT Sumeh Jaya Corp', '2023-03-09', NULL, 'bahan keluar', NULL, '2023-03-10 08:16:39', '2023-03-10 08:20:49'),
(11, 1, 'TR-2023-03-10-0005', 'BHN-0003', 'SJL-0011', 'SKU001/1/1', 'Jeans', 'Denim', 'Navy', 10000, 100, NULL, 'PT Sumeh Jaya Corp', '2023-03-09', '2023-03-10', 'bahan keluar', NULL, '2023-03-10 08:20:49', '2023-03-10 09:44:19'),
(12, 1, 'TR-2023-03-10-0006', 'BHN-0003', 'SJL-0012', 'SKU001/1/1', 'Jeans', 'Denim', 'Navy', 9900, 100, NULL, 'PT Sumeh Jaya Corp', '2023-03-09', '2023-03-10', 'bahan keluar', NULL, '2023-03-10 09:44:19', '2023-03-29 09:33:48'),
(13, NULL, NULL, 'BHN-0004', 'SJL-0015', NULL, 'Kemeja Batik', 'Batik', 'Brown', 1000, NULL, NULL, 'PT Sumeh Jaya Corp', '2023-03-13', NULL, 'bahan keluar', NULL, '2023-03-13 03:15:32', '2023-03-13 03:16:33'),
(14, 1, 'TR-2023-03-13-0001', 'BHN-0004', 'SJL-0016', 'SKU001/1/1', 'Kemeja Batik', 'Batik', 'Brown', 1000, 30, NULL, 'PT Sumeh Jaya Corp', '2023-03-13', '2023-03-13', 'bahan keluar', NULL, '2023-03-13 03:16:33', '2023-03-13 04:43:45'),
(15, 2, 'TR-2023-03-13-0002', 'BHN-0004', 'SJL-0017', 'SKU002/2/2', 'Kemeja Batik', 'Batik', 'Brown', 970, 30, NULL, 'PT Sumeh Jaya Corp', '2023-03-13', '2023-03-13', 'bahan keluar', NULL, '2023-03-13 04:43:45', '2023-03-29 09:21:39'),
(16, 1, 'TR-2023-03-29-0001', 'BHN-0004', 'SJL-0018', 'SKU001/1/1', 'Kemeja Batik', 'Batik', 'Brown', 940, 20, NULL, 'PT Sumeh Jaya Corp', '2023-03-13', '2023-03-29', 'bahan keluar', NULL, '2023-03-29 09:21:39', '2023-03-30 03:08:23'),
(17, 1, 'TR-2023-03-29-0002', 'BHN-0003', 'SJL-0019', 'SKU001/1/1', 'Jeans', 'Denim', 'Navy', 9800, 10, 9790, 'PT Sumeh Jaya Corp', '2023-03-09', '2023-03-29', 'bahan keluar', NULL, '2023-03-29 09:33:48', '2023-03-29 09:33:48'),
(18, 1, 'TR-2023-03-30-0001', 'BHN-0004', 'SJL-0020', 'SKU001/1/1', 'Kemeja Batik', 'Batik', 'Brown', 920, 20, NULL, 'PT Sumeh Jaya Corp', '2023-03-13', '2023-03-30', 'bahan keluar', NULL, '2023-03-30 03:08:23', '2023-03-30 03:12:19'),
(19, 1, 'TR-2023-03-30-0002', 'BHN-0004', 'SJL-0021', 'SKU001/1/1', 'Kemeja Batik', 'Batik', 'Brown', 900, 20, NULL, 'PT Sumeh Jaya Corp', '2023-03-13', '2023-03-30', 'bahan keluar', NULL, '2023-03-30 03:12:19', '2023-03-30 03:12:48'),
(20, 1, 'TR-2023-03-30-0003', 'BHN-0004', 'SJL-0022', 'SKU001/1/1', 'Kemeja Batik', 'Batik', 'Brown', 880, 20, 860, 'PT Sumeh Jaya Corp', '2023-03-13', '2023-03-30', 'bahan keluar', NULL, '2023-03-30 03:12:48', '2023-03-30 03:12:48'),
(21, NULL, NULL, 'BHN-10230', 'SJLBHN-0018', NULL, 'Kaos Grafis', 'Cotton Combed 30s', 'Hitam', 900, NULL, NULL, 'PT Sumeh Jaya Corp', '2023-03-29', NULL, 'bahan keluar', NULL, '2023-03-30 08:50:29', '2023-03-31 03:41:11'),
(22, 1, 'TR-2023-03-31-0001', 'BHN-10230', 'SJL-0023', 'SKU001/1/1', 'Kaos Grafis', 'Cotton Combed 30s', 'Hitam', 900, 30, 870, 'PT Sumeh Jaya Corp', '2023-03-29', '2023-03-31', 'bahan keluar', NULL, '2023-03-31 03:41:11', '2023-03-31 03:41:11'),
(23, NULL, NULL, 'BHN-10232', 'SJL-0231', NULL, 'Jaket Kulit', 'Kulit Asli', 'Brown', 100, NULL, NULL, 'PT Sumeh Kulit abadi', '2023-04-03', NULL, 'bahan keluar', NULL, '2023-04-03 03:18:11', '2023-04-03 03:18:57'),
(24, 1, 'TR-2023-04-03-0001', 'BHN-10232', 'SJL-0239', 'SKU001/1/1', 'Jaket Kulit', 'Kulit Asli', 'Brown', 100, 50, 50, 'PT Sumeh Kulit abadi', '2023-04-03', '2023-04-03', 'bahan keluar', NULL, '2023-04-03 03:18:57', '2023-04-03 03:18:57');

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
(1, 'BCA', '5156562627', 'M2N', '166235818520117.png', '2022-09-05 06:09:45', '2022-09-05 06:09:45');

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
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_perbaikan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cucis`
--

INSERT INTO `cucis` (`id`, `jahit_id`, `no_surat`, `tanggal_masuk`, `tanggal_cuci`, `tanggal_selesai`, `tanggal_keluar`, `kain_siap_cuci`, `vendor`, `nama_vendor`, `status_pembayaran`, `harga_vendor`, `berhasil_cuci`, `konversi`, `gagal_cuci`, `barang_direpair`, `barang_dibuang`, `barang_akan_direpair`, `barang_akan_dibuang`, `keterangan_direpair`, `keterangan_dibuang`, `total_bayar`, `sisa_bayar`, `total_harga`, `status`, `status_cuci`, `deleted_at`, `created_at`, `updated_at`, `status_perbaikan`) VALUES
(2, 1, 'SJL-0002', NULL, '1970-01-01', '1970-01-01', '2023-03-09', 40, 'eksternal', 'Sumeh Laundry', 'Lunas', 5000.00, 30, NULL, 10, 5, 5, NULL, NULL, 'diperbaiki laundry', 'dibuang laundry', 25000, 0, 200000, 'cucian keluar', 'selesai', NULL, '2023-03-09 04:03:09', '2023-03-13 03:54:52', ''),
(3, 2, 'SJL-0004', NULL, '1970-01-01', '1970-01-01', '2023-03-09', 30, 'eksternal', 'Sumeh Laundry', 'Lunas', 5000.00, 30, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 20000, 0, 150000, 'cucian keluar', 'selesai', NULL, '2023-03-09 06:38:13', '2023-03-13 03:54:52', ''),
(4, 2, 'SJL-0004', NULL, '1970-01-01', '1970-01-01', '2023-03-10', 30, 'eksternal', 'Sumeh Laundry', 'Lunas', 5000.00, 30, NULL, 0, 0, 0, NULL, NULL, '-', '-', 20000, 0, 150000, 'cucian keluar', 'selesai', NULL, '2023-03-10 04:01:12', '2023-03-13 03:54:52', ''),
(5, 3, 'SJL-0005', NULL, '1970-01-01', '1970-01-01', '2023-03-29', 30, 'eksternal', 'Sumeh Laundry', 'Lunas', 10000.00, 29, NULL, 1, 1, 0, NULL, NULL, '-', '-', 30000, 0, 30000, 'cucian keluar', 'selesai', NULL, '2023-03-10 04:09:28', '2023-03-29 07:48:06', ''),
(6, 5, 'SJL-0007', NULL, '1970-01-01', '1970-01-01', '2023-03-13', 60, 'eksternal', 'Sumeh Laundry', 'Lunas', 12000.00, 60, NULL, 0, 0, 0, NULL, NULL, '-', '-', 60000, 0, 60000, 'cucian keluar', 'selesai', NULL, '2023-03-10 04:36:44', '2023-03-13 03:54:52', ''),
(7, 10, 'SJL-0016', NULL, '1970-01-01', '1970-01-01', '2023-03-13', 55, 'eksternal', 'Sumeh Laundry', 'Lunas', 10000.00, 55, NULL, 0, 0, 0, NULL, NULL, '-', '-', 50000, 0, 50000, 'cucian keluar', 'selesai', NULL, '2023-03-13 03:41:46', '2023-03-29 07:48:06', ''),
(8, 9, 'SJL-0012', NULL, '2023-03-12', '2023-03-13', '2023-03-29', 96, 'eksternal', 'Rara Laundry', 'Belum Lunas', 9000.00, 96, NULL, 0, 0, 0, NULL, NULL, '0', '0', 0, 72000, 72000, 'cucian keluar', 'selesai', NULL, '2023-03-13 06:47:45', '2023-03-29 08:36:14', ''),
(9, 11, 'SJL-0017', NULL, '2023-03-29', '2023-03-29', '2023-03-29', 49, 'eksternal', 'rara laundry', 'Belum Lunas', 9000.00, 49, NULL, 0, 0, 0, NULL, NULL, '0', '0', 0, 45000, 45000, 'cucian keluar', 'selesai', NULL, '2023-03-13 06:53:33', '2023-03-29 08:35:41', ''),
(10, 17, 'SJL-0020', NULL, '2023-03-23', '2023-03-25', '2023-03-30', 60, 'eksternal', 'Indonesia Tailor', 'Belum Lunas', 4600.00, 60, NULL, 0, 0, 0, NULL, NULL, '0', '0', 0, 23000, 23000, 'cucian keluar', 'selesai', NULL, '2023-03-30 03:27:35', '2023-03-30 09:30:17', ''),
(11, 16, 'SJL-0021', NULL, '2023-03-30', '2023-03-30', '2023-03-30', 90, 'eksternal', 'Indonesia Tailor', 'Belum Lunas', 17000.00, 90, NULL, 0, 0, 0, NULL, NULL, '0', '0', 0, 136000, 136000, 'cucian keluar', 'selesai', NULL, '2023-03-30 03:27:42', '2023-03-30 07:00:36', ''),
(12, 15, 'SJL-0022', NULL, NULL, NULL, NULL, 90, 'eksternal', NULL, NULL, NULL, NULL, '7 Lusin 6 pcs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'cucian masuk', 'belum cuci', NULL, '2023-03-30 03:27:50', '2023-03-30 03:27:50', ''),
(13, 14, 'SJL-0006', NULL, NULL, NULL, NULL, 60, 'eksternal', NULL, NULL, NULL, NULL, '5 Lusin 0 pcs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'cucian masuk', 'belum cuci', NULL, '2023-03-30 03:27:57', '2023-03-30 03:27:57', ''),
(14, 12, 'SJL-0018', NULL, NULL, NULL, NULL, 150, 'eksternal', NULL, NULL, NULL, NULL, '12 Lusin 6 pcs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'cucian masuk', 'belum cuci', NULL, '2023-03-30 03:28:09', '2023-03-30 03:28:09', ''),
(15, 8, 'SJL-0011', NULL, NULL, NULL, NULL, 95, 'eksternal', NULL, NULL, NULL, NULL, '7 Lusin 11 pcs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'cucian masuk', 'belum cuci', NULL, '2023-03-30 03:28:18', '2023-03-30 03:28:18', ''),
(16, 6, 'SJL-0008', NULL, '2023-03-30', '2023-03-30', '2023-03-30', 48, 'eksternal', 'Indonesia Tailor', 'Belum Lunas', 6000.00, 48, NULL, 0, 0, 0, NULL, NULL, '0', '0', 0, 24000, 24000, 'cucian keluar', 'selesai', NULL, '2023-03-30 03:28:27', '2023-03-30 03:29:41', ''),
(21, 1, 'SJL-0002', NULL, '1970-01-01', '2023-03-31', NULL, 5, 'eksternal', 'Sumeh Laundry', 'Lunas', 5000.00, 5, '0 Lusin 0 pcs', 0, 0, 0, NULL, NULL, 'diperbaiki laundry', 'dibuang laundry', 0, 0, 0, 'cucian selesai', 'selesai', NULL, '2023-03-31 09:35:48', '2023-03-31 09:35:48', '');

-- --------------------------------------------------------

--
-- Table structure for table `cuci_dibuangs`
--

CREATE TABLE `cuci_dibuangs` (
  `id` bigint UNSIGNED NOT NULL,
  `cuci_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cuci_dibuangs`
--

INSERT INTO `cuci_dibuangs` (`id`, `cuci_id`, `ukuran`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'M', 5, NULL, '2023-03-09 04:07:08', '2023-03-09 04:07:08'),
(2, 11, '5', 0, NULL, '2023-03-30 07:00:26', '2023-03-30 07:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `cuci_direpairs`
--

CREATE TABLE `cuci_direpairs` (
  `id` bigint UNSIGNED NOT NULL,
  `cuci_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cuci_direpairs`
--

INSERT INTO `cuci_direpairs` (`id`, `cuci_id`, `ukuran`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'M', 5, NULL, '2023-03-09 04:07:08', '2023-03-09 04:07:08'),
(2, 5, 'S', 1, NULL, '2023-03-29 04:41:52', '2023-03-29 04:41:52');

-- --------------------------------------------------------

--
-- Table structure for table `detail_cucis`
--

CREATE TABLE `detail_cucis` (
  `id` bigint UNSIGNED NOT NULL,
  `cuci_id` bigint UNSIGNED DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_cucis`
--

INSERT INTO `detail_cucis` (`id`, `cuci_id`, `size`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 2, 'M', 30, NULL, '2023-03-09 04:03:09', '2023-03-09 04:07:08'),
(3, 3, 'S', 20, NULL, '2023-03-09 06:38:13', '2023-03-09 06:38:13'),
(4, 3, 'M', 5, NULL, '2023-03-09 06:38:13', '2023-03-09 06:38:13'),
(5, 3, 'L', 5, NULL, '2023-03-09 06:38:13', '2023-03-09 06:38:13'),
(6, 4, 'S', 20, NULL, '2023-03-10 04:01:12', '2023-03-10 04:01:12'),
(7, 4, 'M', 5, NULL, '2023-03-10 04:01:12', '2023-03-10 04:01:12'),
(8, 4, 'L', 5, NULL, '2023-03-10 04:01:12', '2023-03-10 04:01:12'),
(9, 5, 'S', 4, NULL, '2023-03-10 04:09:28', '2023-03-29 04:41:52'),
(10, 5, 'M', 15, NULL, '2023-03-10 04:09:28', '2023-03-10 04:09:28'),
(11, 5, 'L', 10, NULL, '2023-03-10 04:09:28', '2023-03-10 04:09:28'),
(12, 6, 'S', 20, NULL, '2023-03-10 04:36:44', '2023-03-10 04:36:44'),
(13, 6, 'M', 20, NULL, '2023-03-10 04:36:44', '2023-03-10 04:36:44'),
(14, 6, 'L', 20, NULL, '2023-03-10 04:36:44', '2023-03-10 04:36:44'),
(15, 7, 'S', 16, NULL, '2023-03-13 03:41:46', '2023-03-13 03:41:46'),
(16, 7, 'M', 19, NULL, '2023-03-13 03:41:46', '2023-03-13 03:41:46'),
(17, 7, 'L', 20, NULL, '2023-03-13 03:41:46', '2023-03-13 03:41:46'),
(18, 8, 'L', 46, NULL, '2023-03-13 06:47:45', '2023-03-13 06:47:45'),
(19, 8, 'M', 50, NULL, '2023-03-13 06:47:45', '2023-03-13 06:47:45'),
(20, 9, 'S', 49, NULL, '2023-03-13 06:53:33', '2023-03-13 06:53:33'),
(21, 10, 'S', 10, NULL, '2023-03-30 03:27:35', '2023-03-30 03:27:35'),
(22, 10, 'M', 10, NULL, '2023-03-30 03:27:35', '2023-03-30 03:27:35'),
(23, 10, 'L', 10, NULL, '2023-03-30 03:27:35', '2023-03-30 03:27:35'),
(24, 10, 'XL', 10, NULL, '2023-03-30 03:27:35', '2023-03-30 03:27:35'),
(25, 10, '28', 10, NULL, '2023-03-30 03:27:35', '2023-03-30 03:27:35'),
(26, 10, '29', 10, NULL, '2023-03-30 03:27:35', '2023-03-30 03:27:35'),
(27, 11, '1', 10, NULL, '2023-03-30 03:27:42', '2023-03-30 03:27:42'),
(28, 11, '2', 10, NULL, '2023-03-30 03:27:42', '2023-03-30 03:27:42'),
(29, 11, '3', 10, NULL, '2023-03-30 03:27:42', '2023-03-30 03:27:42'),
(30, 11, '4', 10, NULL, '2023-03-30 03:27:42', '2023-03-30 03:27:42'),
(31, 11, '5', 10, NULL, '2023-03-30 03:27:42', '2023-03-30 03:27:42'),
(32, 11, '6', 10, NULL, '2023-03-30 03:27:42', '2023-03-30 03:27:42'),
(33, 11, '7', 10, NULL, '2023-03-30 03:27:42', '2023-03-30 03:27:42'),
(34, 11, '8', 10, NULL, '2023-03-30 03:27:42', '2023-03-30 03:27:42'),
(35, 11, '9', 10, NULL, '2023-03-30 03:27:42', '2023-03-30 03:27:42'),
(36, 12, '1', 10, NULL, '2023-03-30 03:27:50', '2023-03-30 03:27:50'),
(37, 12, '2', 10, NULL, '2023-03-30 03:27:50', '2023-03-30 03:27:50'),
(38, 12, '3', 10, NULL, '2023-03-30 03:27:50', '2023-03-30 03:27:50'),
(39, 12, '4', 10, NULL, '2023-03-30 03:27:50', '2023-03-30 03:27:50'),
(40, 12, '5', 10, NULL, '2023-03-30 03:27:50', '2023-03-30 03:27:50'),
(41, 12, '6', 10, NULL, '2023-03-30 03:27:50', '2023-03-30 03:27:50'),
(42, 12, '7', 10, NULL, '2023-03-30 03:27:50', '2023-03-30 03:27:50'),
(43, 12, '8', 10, NULL, '2023-03-30 03:27:50', '2023-03-30 03:27:50'),
(44, 12, '9', 10, NULL, '2023-03-30 03:27:50', '2023-03-30 03:27:50'),
(45, 13, 'S', 20, NULL, '2023-03-30 03:27:57', '2023-03-30 03:27:57'),
(46, 13, 'M', 20, NULL, '2023-03-30 03:27:57', '2023-03-30 03:27:57'),
(47, 13, 'L', 20, NULL, '2023-03-30 03:27:57', '2023-03-30 03:27:57'),
(48, 14, 'S', 50, NULL, '2023-03-30 03:28:09', '2023-03-30 03:28:09'),
(49, 14, 'M', 50, NULL, '2023-03-30 03:28:09', '2023-03-30 03:28:09'),
(50, 14, 'L', 50, NULL, '2023-03-30 03:28:09', '2023-03-30 03:28:09'),
(51, 15, 'S', 45, NULL, '2023-03-30 03:28:18', '2023-03-30 03:28:18'),
(52, 15, 'M', 50, NULL, '2023-03-30 03:28:18', '2023-03-30 03:28:18'),
(53, 16, 'XL', 28, NULL, '2023-03-30 03:28:27', '2023-03-30 03:28:27'),
(54, 16, 'XXL', 20, NULL, '2023-03-30 03:28:27', '2023-03-30 03:28:27'),
(56, 21, '', 0, NULL, '2023-03-31 09:35:48', '2023-03-31 09:35:48'),
(57, 21, 'M', 5, NULL, '2023-03-31 09:35:48', '2023-03-31 09:35:48');

-- --------------------------------------------------------

--
-- Table structure for table `detail_finishings`
--

CREATE TABLE `detail_finishings` (
  `id` bigint UNSIGNED NOT NULL,
  `finishing_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_finishings`
--

INSERT INTO `detail_finishings` (`id`, `finishing_id`, `ukuran`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'M', 30, '2023-03-09 04:34:47', '2023-03-09 04:30:02', '2023-03-09 04:34:47'),
(2, 1, 'M', 29, NULL, '2023-03-09 04:34:47', '2023-03-09 04:34:47'),
(3, 2, 'S', 20, '2023-03-09 08:43:52', '2023-03-09 08:42:45', '2023-03-09 08:43:52'),
(4, 2, 'M', 5, '2023-03-09 08:43:52', '2023-03-09 08:42:45', '2023-03-09 08:43:52'),
(5, 2, 'L', 5, '2023-03-09 08:43:52', '2023-03-09 08:42:45', '2023-03-09 08:43:52'),
(6, 2, 'S', 10, NULL, '2023-03-09 08:43:52', '2023-03-09 08:43:52'),
(7, 2, 'M', 10, NULL, '2023-03-09 08:43:52', '2023-03-09 08:43:52'),
(8, 2, 'L', 10, NULL, '2023-03-09 08:43:52', '2023-03-09 08:43:52'),
(9, 3, 'S', 20, '2023-03-10 07:29:16', '2023-03-10 06:22:24', '2023-03-10 07:29:16'),
(10, 3, 'M', 5, '2023-03-10 07:29:16', '2023-03-10 06:22:24', '2023-03-10 07:29:16'),
(11, 3, 'L', 5, '2023-03-10 07:29:16', '2023-03-10 06:22:24', '2023-03-10 07:29:16'),
(12, 3, 'S', 10, NULL, '2023-03-10 07:29:16', '2023-03-10 07:29:16'),
(13, 3, 'M', 5, NULL, '2023-03-10 07:29:16', '2023-03-10 07:29:16'),
(14, 3, 'L', 10, NULL, '2023-03-10 07:29:16', '2023-03-10 07:29:16'),
(24, 6, 'S', 20, NULL, '2023-03-27 03:18:58', '2023-03-27 03:18:58'),
(25, 6, 'M', 20, NULL, '2023-03-27 03:18:58', '2023-03-27 03:18:58'),
(26, 6, 'L', 15, NULL, '2023-03-27 03:18:58', '2023-03-27 03:18:58'),
(30, 7, 'S', 4, NULL, '2023-03-29 06:08:08', '2023-03-29 06:08:08'),
(31, 7, 'M', 15, NULL, '2023-03-29 06:08:08', '2023-03-29 06:08:08'),
(32, 7, 'L', 10, NULL, '2023-03-29 06:08:08', '2023-03-29 06:08:08'),
(33, 8, 'S', 49, NULL, '2023-03-29 08:35:41', '2023-03-29 08:35:41'),
(34, 9, 'L', 46, NULL, '2023-03-29 08:36:14', '2023-03-29 08:36:14'),
(35, 9, 'M', 50, NULL, '2023-03-29 08:36:14', '2023-03-29 08:36:14'),
(38, 5, 'S', 20, NULL, '2023-03-30 03:34:51', '2023-03-30 03:34:51'),
(39, 5, 'M', 20, NULL, '2023-03-30 03:34:51', '2023-03-30 03:34:51'),
(40, 5, 'L', 20, NULL, '2023-03-30 03:34:51', '2023-03-30 03:34:51'),
(50, 11, '1', 10, NULL, '2023-03-30 07:03:14', '2023-03-30 07:03:14'),
(51, 11, '2', 10, NULL, '2023-03-30 07:03:14', '2023-03-30 07:03:14'),
(52, 11, '3', 10, NULL, '2023-03-30 07:03:14', '2023-03-30 07:03:14'),
(53, 11, '4', 10, NULL, '2023-03-30 07:03:14', '2023-03-30 07:03:14'),
(54, 11, '5', 10, NULL, '2023-03-30 07:03:14', '2023-03-30 07:03:14'),
(55, 11, '6', 10, NULL, '2023-03-30 07:03:14', '2023-03-30 07:03:14'),
(56, 11, '7', 10, NULL, '2023-03-30 07:03:14', '2023-03-30 07:03:14'),
(57, 11, '8', 10, NULL, '2023-03-30 07:03:14', '2023-03-30 07:03:14'),
(58, 11, '9', 10, NULL, '2023-03-30 07:03:14', '2023-03-30 07:03:14'),
(65, 10, 'XL', 28, NULL, '2023-03-30 07:59:17', '2023-03-30 07:59:17'),
(66, 10, 'XXL', 20, NULL, '2023-03-30 07:59:17', '2023-03-30 07:59:17'),
(67, 12, 'S', 10, NULL, '2023-03-30 08:00:37', '2023-03-30 08:00:37'),
(68, 12, 'M', 10, NULL, '2023-03-30 08:00:37', '2023-03-30 08:00:37'),
(69, 12, 'L', 10, NULL, '2023-03-30 08:00:37', '2023-03-30 08:00:37'),
(70, 12, 'XL', 10, NULL, '2023-03-30 08:00:37', '2023-03-30 08:00:37'),
(71, 12, '28', 10, NULL, '2023-03-30 08:00:37', '2023-03-30 08:00:37'),
(72, 12, '29', 10, NULL, '2023-03-30 08:00:37', '2023-03-30 08:00:37');

-- --------------------------------------------------------

--
-- Table structure for table `detail_jahits`
--

CREATE TABLE `detail_jahits` (
  `id` bigint UNSIGNED NOT NULL,
  `jahit_id` bigint UNSIGNED DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_jahits`
--

INSERT INTO `detail_jahits` (`id`, `jahit_id`, `size`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'M', 40, NULL, '2023-03-08 09:11:47', '2023-03-09 03:49:45'),
(2, 2, 'S', 20, NULL, '2023-03-09 06:30:38', '2023-03-09 06:30:38'),
(3, 2, 'M', 5, NULL, '2023-03-09 06:30:38', '2023-03-09 06:37:28'),
(4, 2, 'L', 5, NULL, '2023-03-09 06:30:38', '2023-03-09 06:37:28'),
(5, 3, 'S', 5, NULL, '2023-03-09 06:41:13', '2023-03-09 07:12:23'),
(6, 3, 'M', 15, NULL, '2023-03-09 06:41:13', '2023-03-09 06:41:13'),
(7, 3, 'L', 10, NULL, '2023-03-09 06:41:13', '2023-03-09 06:41:13'),
(11, 5, 'S', 20, NULL, '2023-03-10 04:31:16', '2023-03-10 04:31:16'),
(12, 5, 'M', 20, NULL, '2023-03-10 04:31:16', '2023-03-10 04:31:16'),
(13, 5, 'L', 20, NULL, '2023-03-10 04:31:16', '2023-03-10 04:31:16'),
(14, 6, 'XL', 28, NULL, '2023-03-10 06:31:34', '2023-03-10 06:31:34'),
(15, 6, 'XXL', 20, NULL, '2023-03-10 06:31:34', '2023-03-10 06:31:34'),
(16, 7, 'S', 20, NULL, '2023-03-10 08:08:52', '2023-03-10 08:08:52'),
(17, 8, 'S', 45, NULL, '2023-03-10 08:22:02', '2023-03-10 09:43:14'),
(18, 8, 'M', 50, NULL, '2023-03-10 08:22:02', '2023-03-10 08:22:02'),
(19, 9, 'L', 46, NULL, '2023-03-10 09:45:02', '2023-03-13 06:47:08'),
(20, 9, 'M', 50, NULL, '2023-03-10 09:45:02', '2023-03-10 09:45:02'),
(21, 10, 'S', 16, NULL, '2023-03-13 03:18:33', '2023-03-13 03:30:36'),
(22, 10, 'M', 19, NULL, '2023-03-13 03:18:33', '2023-03-13 03:30:36'),
(23, 10, 'L', 20, NULL, '2023-03-13 03:18:33', '2023-03-13 03:18:33'),
(24, 11, 'S', 49, NULL, '2023-03-13 04:54:55', '2023-03-13 06:53:18'),
(25, 12, 'S', 50, NULL, '2023-03-29 09:22:53', '2023-03-29 09:22:53'),
(26, 12, 'M', 50, NULL, '2023-03-29 09:22:53', '2023-03-29 09:22:53'),
(27, 12, 'L', 50, NULL, '2023-03-29 09:22:53', '2023-03-29 09:22:53'),
(28, 13, 'S', 10, NULL, '2023-03-29 09:34:46', '2023-03-29 09:34:46'),
(29, 14, 'S', 20, NULL, '2023-03-29 09:35:46', '2023-03-29 09:35:46'),
(30, 14, 'M', 20, NULL, '2023-03-29 09:35:46', '2023-03-29 09:35:46'),
(31, 14, 'L', 20, NULL, '2023-03-29 09:35:46', '2023-03-29 09:35:46'),
(32, 15, '1', 10, NULL, '2023-03-30 03:21:00', '2023-03-30 03:21:00'),
(33, 15, '2', 10, NULL, '2023-03-30 03:21:00', '2023-03-30 03:21:00'),
(34, 15, '3', 10, NULL, '2023-03-30 03:21:00', '2023-03-30 03:21:00'),
(35, 15, '4', 10, NULL, '2023-03-30 03:21:00', '2023-03-30 03:21:00'),
(36, 15, '5', 10, NULL, '2023-03-30 03:21:00', '2023-03-30 03:21:00'),
(37, 15, '6', 10, NULL, '2023-03-30 03:21:00', '2023-03-30 03:21:00'),
(38, 15, '7', 10, NULL, '2023-03-30 03:21:00', '2023-03-30 03:21:00'),
(39, 15, '8', 10, NULL, '2023-03-30 03:21:00', '2023-03-30 03:21:00'),
(40, 15, '9', 10, NULL, '2023-03-30 03:21:00', '2023-03-30 03:21:00'),
(41, 16, '1', 10, NULL, '2023-03-30 03:21:07', '2023-03-30 03:21:07'),
(42, 16, '2', 10, NULL, '2023-03-30 03:21:07', '2023-03-30 03:21:07'),
(43, 16, '3', 10, NULL, '2023-03-30 03:21:07', '2023-03-30 03:21:07'),
(44, 16, '4', 10, NULL, '2023-03-30 03:21:07', '2023-03-30 03:21:07'),
(45, 16, '5', 10, NULL, '2023-03-30 03:21:07', '2023-03-30 03:21:07'),
(46, 16, '6', 10, NULL, '2023-03-30 03:21:07', '2023-03-30 03:21:07'),
(47, 16, '7', 10, NULL, '2023-03-30 03:21:07', '2023-03-30 03:21:07'),
(48, 16, '8', 10, NULL, '2023-03-30 03:21:07', '2023-03-30 03:21:07'),
(49, 16, '9', 10, NULL, '2023-03-30 03:21:07', '2023-03-30 03:21:07'),
(50, 17, 'S', 10, NULL, '2023-03-30 03:21:13', '2023-03-30 03:21:13'),
(51, 17, 'M', 10, NULL, '2023-03-30 03:21:13', '2023-03-30 03:21:13'),
(52, 17, 'L', 10, NULL, '2023-03-30 03:21:13', '2023-03-30 03:21:13'),
(53, 17, 'XL', 10, NULL, '2023-03-30 03:21:13', '2023-03-30 03:21:13'),
(54, 17, '28', 10, NULL, '2023-03-30 03:21:13', '2023-03-30 03:21:13'),
(55, 17, '29', 10, NULL, '2023-03-30 03:21:13', '2023-03-30 03:21:13'),
(56, 18, '1', 10, NULL, '2023-03-31 03:42:26', '2023-03-31 03:43:22'),
(57, 18, '10', 10, NULL, '2023-03-31 03:42:26', '2023-03-31 03:43:22'),
(58, 18, '100', 10, NULL, '2023-03-31 03:42:26', '2023-03-31 03:43:22'),
(60, 26, '1', 10, NULL, '2023-03-31 07:28:15', '2023-03-31 07:28:15'),
(61, 26, '10', 10, NULL, '2023-03-31 07:28:15', '2023-03-31 07:28:15'),
(62, 26, '100', 5, NULL, '2023-03-31 07:28:15', '2023-03-31 07:28:15'),
(63, 27, '13', 23, NULL, '2023-04-03 03:20:20', '2023-04-03 03:21:49'),
(64, 27, '14', 23, NULL, '2023-04-03 03:20:20', '2023-04-03 03:21:49'),
(65, 28, '13', 1, NULL, '2023-04-03 03:46:01', '2023-04-03 03:46:01'),
(66, 28, '14', 1, NULL, '2023-04-03 03:46:01', '2023-04-03 03:46:01');

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

--
-- Dumping data for table `detail_perbaikans`
--

INSERT INTO `detail_perbaikans` (`id`, `perbaikan_id`, `jahit_direpair_id`, `cuci_direpair_id`, `jumlah`, `keterangan`, `created_at`, `updated_at`) VALUES
(24, 20, 1, NULL, 10, 'diperbaiki', '2023-03-31 04:37:53', '2023-03-31 04:37:53'),
(25, 21, 2, NULL, 5, 'diperbaiki', '2023-03-31 04:37:53', '2023-03-31 04:37:53'),
(26, 22, 3, NULL, 5, 'diperbaiki coba lagi', '2023-03-31 04:37:53', '2023-03-31 04:37:53'),
(27, 23, 4, NULL, 3, '3 diperbaiki', '2023-03-31 04:37:53', '2023-03-31 04:37:53'),
(28, 24, 6, NULL, 4, '-', '2023-03-31 04:37:53', '2023-03-31 04:37:53'),
(29, 25, 5, NULL, 1, 'diperbaiki', '2023-03-31 04:37:53', '2023-03-31 04:37:53'),
(30, 26, 7, NULL, 1, '-', '2023-03-31 04:37:53', '2023-03-31 04:37:53'),
(31, 27, 10, NULL, 30, '10', '2023-03-31 04:37:53', '2023-03-31 04:37:53'),
(32, 27, 11, NULL, 30, '10', '2023-03-31 04:37:53', '2023-03-31 04:37:53'),
(33, 27, 12, NULL, 30, '10', '2023-03-31 04:37:53', '2023-03-31 04:37:53'),
(34, 20, NULL, 1, 5, 'diperbaiki laundry', '2023-03-31 04:42:13', '2023-03-31 04:42:13'),
(35, 22, NULL, 2, 1, '-', '2023-03-31 04:42:13', '2023-03-31 04:42:13'),
(36, 28, 13, NULL, 2, '1', '2023-04-03 03:24:08', '2023-04-03 03:24:08'),
(37, 28, 14, NULL, 2, '1', '2023-04-03 03:24:08', '2023-04-03 03:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `detail_potongs`
--

CREATE TABLE `detail_potongs` (
  `id` bigint UNSIGNED NOT NULL,
  `potong_id` bigint UNSIGNED DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_potongs`
--

INSERT INTO `detail_potongs` (`id`, `potong_id`, `size`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'M', 50, NULL, '2023-03-08 09:11:23', '2023-03-08 09:11:23'),
(2, 2, 'S', 20, NULL, '2023-03-09 06:30:26', '2023-03-09 06:30:26'),
(3, 2, 'M', 10, NULL, '2023-03-09 06:30:26', '2023-03-09 06:30:26'),
(4, 2, 'L', 10, NULL, '2023-03-09 06:30:26', '2023-03-09 06:30:26'),
(5, 3, 'S', 15, NULL, '2023-03-09 06:41:05', '2023-03-09 06:41:05'),
(6, 3, 'M', 15, NULL, '2023-03-09 06:41:05', '2023-03-09 06:41:05'),
(7, 3, 'L', 10, NULL, '2023-03-09 06:41:05', '2023-03-09 06:41:05'),
(8, 4, 'S', 20, NULL, '2023-03-10 04:26:47', '2023-03-10 04:26:47'),
(9, 4, 'M', 20, NULL, '2023-03-10 04:26:47', '2023-03-10 04:26:47'),
(10, 4, 'L', 20, NULL, '2023-03-10 04:26:47', '2023-03-10 04:26:47'),
(11, 5, 'S', 20, NULL, '2023-03-10 04:31:07', '2023-03-10 04:31:07'),
(12, 5, 'M', 20, NULL, '2023-03-10 04:31:07', '2023-03-10 04:31:07'),
(13, 5, 'L', 20, NULL, '2023-03-10 04:31:07', '2023-03-10 04:31:07'),
(14, 6, 'XL', 28, NULL, '2023-03-10 06:31:24', '2023-03-10 06:31:24'),
(15, 6, 'XXL', 20, NULL, '2023-03-10 06:31:24', '2023-03-10 06:31:24'),
(16, 7, 'S', 20, NULL, '2023-03-10 08:08:36', '2023-03-10 08:08:36'),
(17, 8, 'S', 50, NULL, '2023-03-10 08:21:52', '2023-03-10 08:21:52'),
(18, 8, 'M', 50, NULL, '2023-03-10 08:21:52', '2023-03-10 08:21:52'),
(19, 9, 'L', 50, NULL, '2023-03-10 09:44:54', '2023-03-10 09:44:54'),
(20, 9, 'M', 50, NULL, '2023-03-10 09:44:54', '2023-03-10 09:44:54'),
(21, 10, 'S', 20, NULL, '2023-03-13 03:18:25', '2023-03-13 03:18:25'),
(22, 10, 'M', 20, NULL, '2023-03-13 03:18:25', '2023-03-13 03:18:25'),
(23, 10, 'L', 20, NULL, '2023-03-13 03:18:25', '2023-03-13 03:18:25'),
(24, 11, 'S', 50, NULL, '2023-03-13 04:54:46', '2023-03-13 04:54:46'),
(25, 12, 'S', 50, NULL, '2023-03-29 09:22:42', '2023-03-29 09:22:42'),
(26, 12, 'M', 50, NULL, '2023-03-29 09:22:42', '2023-03-29 09:22:42'),
(27, 12, 'L', 50, NULL, '2023-03-29 09:22:42', '2023-03-29 09:22:42'),
(28, 13, 'S', 10, NULL, '2023-03-29 09:34:25', '2023-03-29 09:34:25'),
(29, 16, '1', 10, NULL, '2023-03-30 03:17:44', '2023-03-30 03:17:44'),
(30, 16, '2', 10, NULL, '2023-03-30 03:17:44', '2023-03-30 03:17:44'),
(31, 16, '3', 10, NULL, '2023-03-30 03:17:44', '2023-03-30 03:17:44'),
(32, 16, '4', 10, NULL, '2023-03-30 03:17:44', '2023-03-30 03:17:44'),
(33, 16, '5', 10, NULL, '2023-03-30 03:17:44', '2023-03-30 03:17:44'),
(34, 16, '6', 10, NULL, '2023-03-30 03:17:44', '2023-03-30 03:17:44'),
(35, 16, '7', 10, NULL, '2023-03-30 03:17:44', '2023-03-30 03:17:44'),
(36, 16, '8', 10, NULL, '2023-03-30 03:17:44', '2023-03-30 03:17:44'),
(37, 16, '9', 10, NULL, '2023-03-30 03:17:44', '2023-03-30 03:17:44'),
(38, 15, '1', 10, NULL, '2023-03-30 03:18:31', '2023-03-30 03:18:31'),
(39, 15, '2', 10, NULL, '2023-03-30 03:18:31', '2023-03-30 03:18:31'),
(40, 15, '3', 10, NULL, '2023-03-30 03:18:31', '2023-03-30 03:18:31'),
(41, 15, '4', 10, NULL, '2023-03-30 03:18:31', '2023-03-30 03:18:31'),
(42, 15, '5', 10, NULL, '2023-03-30 03:18:31', '2023-03-30 03:18:31'),
(43, 15, '6', 10, NULL, '2023-03-30 03:18:31', '2023-03-30 03:18:31'),
(44, 15, '7', 10, NULL, '2023-03-30 03:18:31', '2023-03-30 03:18:31'),
(45, 15, '8', 10, NULL, '2023-03-30 03:18:31', '2023-03-30 03:18:31'),
(46, 15, '9', 10, NULL, '2023-03-30 03:18:31', '2023-03-30 03:18:31'),
(47, 14, 'S', 10, NULL, '2023-03-30 03:20:51', '2023-03-30 03:20:51'),
(48, 14, 'M', 10, NULL, '2023-03-30 03:20:51', '2023-03-30 03:20:51'),
(49, 14, 'L', 10, NULL, '2023-03-30 03:20:51', '2023-03-30 03:20:51'),
(50, 14, 'XL', 10, NULL, '2023-03-30 03:20:51', '2023-03-30 03:20:51'),
(51, 14, '28', 10, NULL, '2023-03-30 03:20:51', '2023-03-30 03:20:51'),
(52, 14, '29', 10, NULL, '2023-03-30 03:20:51', '2023-03-30 03:20:51'),
(53, 17, '1', 20, NULL, '2023-03-31 03:42:14', '2023-03-31 03:42:14'),
(54, 17, '10', 20, NULL, '2023-03-31 03:42:14', '2023-03-31 03:42:14'),
(55, 17, '100', 20, NULL, '2023-03-31 03:42:14', '2023-03-31 03:42:14'),
(56, 18, '13', 25, NULL, '2023-04-03 03:20:11', '2023-04-03 03:20:11'),
(57, 18, '14', 25, NULL, '2023-04-03 03:20:11', '2023-04-03 03:20:11');

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
(1, 1, 'M', -5, 50000, '2023-03-09 04:51:44', '2023-03-15 04:28:26'),
(2, 2, 'S', 16, 250000, '2023-03-27 03:39:16', '2023-03-30 06:50:31'),
(3, 2, 'M', 16, 250000, '2023-03-27 03:39:16', '2023-03-30 06:50:31'),
(4, 2, 'L', 11, 250000, '2023-03-27 03:39:16', '2023-03-30 06:50:31'),
(5, 3, '1', 9, 140000, '2023-03-30 07:06:54', '2023-03-30 07:08:43'),
(6, 3, '2', 9, 140000, '2023-03-30 07:06:54', '2023-03-30 07:08:43'),
(7, 3, '3', 9, 140000, '2023-03-30 07:06:54', '2023-03-30 07:08:43'),
(8, 3, '4', 7, 150000, '2023-03-30 07:06:54', '2023-04-03 04:51:41'),
(9, 3, '5', 7, 150000, '2023-03-30 07:06:54', '2023-04-03 04:51:41'),
(10, 3, '6', 7, 150000, '2023-03-30 07:06:54', '2023-04-03 04:51:41'),
(11, 3, '7', 10, 160000, '2023-03-30 07:06:54', '2023-03-30 07:06:54'),
(12, 3, '8', 10, 160000, '2023-03-30 07:06:54', '2023-03-30 07:06:54'),
(13, 3, '9', 10, 160000, '2023-03-30 07:06:54', '2023-03-30 07:06:54');

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
(1, 1, '167833750457405.jpg', '2023-03-09 04:51:44', '2023-03-09 04:51:44'),
(2, 2, '167988835613519.jpg', '2023-03-27 03:39:16', '2023-03-27 03:39:16'),
(3, 3, '168016001462602.jpg', '2023-03-30 07:06:54', '2023-03-30 07:06:54');

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
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_rekapitulasis`
--

INSERT INTO `detail_rekapitulasis` (`id`, `rekapitulasi_id`, `status`, `ukuran`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'dibuang', 'M', 5, '2023-03-13 03:51:04', '2023-03-09 04:30:12', '2023-03-13 03:51:04'),
(2, 1, 'direpair', 'M', 5, '2023-03-13 03:51:04', '2023-03-09 04:30:12', '2023-03-13 03:51:04'),
(3, 2, 'direpair', 'M', 10, '2023-03-13 03:51:04', '2023-03-09 04:30:12', '2023-03-13 03:51:04'),
(4, 1, 'dibuang', 'M', 5, '2023-03-13 04:56:38', '2023-03-13 03:51:04', '2023-03-13 04:56:38'),
(5, 1, 'direpair', 'M', 5, '2023-03-13 04:56:38', '2023-03-13 03:51:04', '2023-03-13 04:56:38'),
(6, 2, 'direpair', 'M', 10, '2023-03-13 04:56:38', '2023-03-13 03:51:04', '2023-03-13 04:56:38'),
(7, 6, 'dibuang', 'L', 5, '2023-03-13 04:56:38', '2023-03-13 03:51:04', '2023-03-13 04:56:38'),
(8, 6, 'direpair', 'M', 5, '2023-03-13 04:56:38', '2023-03-13 03:51:04', '2023-03-13 04:56:38'),
(9, 7, 'dibuang', 'S', 5, '2023-03-13 04:56:38', '2023-03-13 03:51:04', '2023-03-13 04:56:38'),
(10, 7, 'direpair', 'S', 5, '2023-03-13 04:56:38', '2023-03-13 03:51:04', '2023-03-13 04:56:38'),
(11, 9, 'dibuang', 'S', 4, '2023-03-13 04:56:39', '2023-03-13 03:51:04', '2023-03-13 04:56:39'),
(12, 9, 'direpair', 'M', 1, '2023-03-13 04:56:39', '2023-03-13 03:51:04', '2023-03-13 04:56:39'),
(13, 1, 'dibuang', 'M', 5, NULL, '2023-03-13 04:56:38', '2023-03-13 04:56:38'),
(14, 1, 'direpair', 'M', 5, NULL, '2023-03-13 04:56:38', '2023-03-13 04:56:38'),
(15, 2, 'direpair', 'M', 10, NULL, '2023-03-13 04:56:38', '2023-03-13 04:56:38'),
(16, 6, 'dibuang', 'L', 5, NULL, '2023-03-13 04:56:38', '2023-03-13 04:56:38'),
(17, 6, 'direpair', 'M', 5, NULL, '2023-03-13 04:56:38', '2023-03-13 04:56:38'),
(18, 7, 'dibuang', 'S', 5, NULL, '2023-03-13 04:56:38', '2023-03-13 04:56:38'),
(19, 7, 'direpair', 'S', 5, NULL, '2023-03-13 04:56:38', '2023-03-13 04:56:38'),
(20, 9, 'dibuang', 'S', 4, NULL, '2023-03-13 04:56:39', '2023-03-13 04:56:39'),
(21, 9, 'direpair', 'M', 1, NULL, '2023-03-13 04:56:39', '2023-03-13 04:56:39');

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
(1, 1, 'M', 'diretur', 1, '2023-03-13 04:19:43', '2023-03-13 04:19:43'),
(2, 3, 'M', 'diretur', 3, '2023-03-13 04:19:43', '2023-03-13 04:19:43'),
(3, 3, 'M', 'dibuang', 2, '2023-03-13 04:19:43', '2023-03-13 04:19:43');

-- --------------------------------------------------------

--
-- Table structure for table `detail_returs`
--

CREATE TABLE `detail_returs` (
  `id` bigint UNSIGNED NOT NULL,
  `retur_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_returs`
--

INSERT INTO `detail_returs` (`id`, `retur_id`, `ukuran`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'M', 1, NULL, '2023-03-09 04:58:51', '2023-03-09 04:58:51'),
(2, 4, 'M', 3, NULL, '2023-03-10 07:29:21', '2023-03-10 07:29:21');

-- --------------------------------------------------------

--
-- Table structure for table `detail_sampahs`
--

CREATE TABLE `detail_sampahs` (
  `id` bigint UNSIGNED NOT NULL,
  `sampah_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_sampahs`
--

INSERT INTO `detail_sampahs` (`id`, `sampah_id`, `ukuran`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
(9, 2, 'M', 5, NULL, '2023-03-29 04:42:58', '2023-03-29 04:42:58'),
(10, 3, 'L', 5, NULL, '2023-03-29 04:42:58', '2023-03-29 04:42:58'),
(11, 4, 'S', 5, NULL, '2023-03-29 04:42:58', '2023-03-29 04:42:58'),
(12, 5, 'S', 4, NULL, '2023-03-29 04:42:58', '2023-03-29 04:42:58');

-- --------------------------------------------------------

--
-- Table structure for table `detail_sub_kategoris`
--

CREATE TABLE `detail_sub_kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `sub_kategori_id` bigint UNSIGNED DEFAULT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_sub_kategoris`
--

INSERT INTO `detail_sub_kategoris` (`id`, `sub_kategori_id`, `nama_kategori`, `sku`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kemeja Lengan Panjang', 'SKU001/1/1', NULL, '2023-03-08 08:20:28', '2023-03-08 08:20:28'),
(2, 2, 'Kemeja Lengan Pendek', 'SKU002/2/2', NULL, '2023-03-08 08:20:28', '2023-03-08 08:20:28'),
(3, 2, 'Kemeja Lengan Panjang', 'SKU002/2/3', NULL, '2023-03-29 04:37:49', '2023-03-29 04:37:49');

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
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` double NOT NULL,
  `total_harga` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_transaksis`
--

INSERT INTO `detail_transaksis` (`id`, `transaksi_id`, `produk_id`, `promo_id`, `jumlah`, `ukuran`, `harga`, `total_harga`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 1, 'M', 50000, 50000, '2023-03-09 08:12:34', '2023-03-09 08:12:34'),
(2, 2, 1, NULL, 2, 'M', 50000, 100000, '2023-03-09 08:30:58', '2023-03-09 08:30:58'),
(3, 3, 1, NULL, 1, 'M', 50000, 50000, '2023-03-09 08:32:03', '2023-03-09 08:32:03'),
(4, 4, 1, NULL, 1, 'M', 50000, 50000, '2023-03-09 08:34:58', '2023-03-09 08:34:58'),
(5, 5, 1, NULL, 1, 'M', 50000, 50000, '2023-03-13 08:05:52', '2023-03-13 08:05:52'),
(8, 6, 1, NULL, 32, 'M', 50000, 1600000, '2023-03-15 04:25:51', '2023-03-15 04:25:51'),
(9, 22, 2, NULL, 1, 'S,M,L', 150, 150, '2023-03-27 03:49:21', '2023-03-27 03:49:21'),
(10, 23, 2, NULL, 1, 'S,M,L', 150000, 150000, '2023-03-29 04:17:23', '2023-03-29 04:17:23'),
(11, 24, 2, NULL, 3, 'S, M, L', 250000, 750000, '2023-03-30 06:50:31', '2023-03-30 06:50:31'),
(12, 25, 3, NULL, 1, '1, 2, 3', 140000, 140000, '2023-03-30 07:08:43', '2023-03-30 07:08:43'),
(13, 26, 3, NULL, 2, '7, 8, 9', 160000, 320000, '2023-03-30 07:36:48', '2023-03-30 07:36:48'),
(14, 27, 3, NULL, 1, '4, 5, 6', 150000, 150000, '2023-03-30 07:40:27', '2023-03-30 07:40:27'),
(15, 28, 3, NULL, 1, '4, 5, 6', 150000, 150000, '2023-03-30 07:42:22', '2023-03-30 07:42:22'),
(16, 29, 3, NULL, 2, '4, 5, 6', 150000, 300000, '2023-04-03 04:50:42', '2023-04-03 04:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `detail_warehouses`
--

CREATE TABLE `detail_warehouses` (
  `id` bigint UNSIGNED NOT NULL,
  `warehouse_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `harga` double NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_warehouses`
--

INSERT INTO `detail_warehouses` (`id`, `warehouse_id`, `ukuran`, `jumlah`, `harga`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'M', 28, 50000, NULL, '2023-03-09 04:34:47', '2023-03-09 08:34:58'),
(2, 2, 'S', 10, 0, NULL, '2023-03-09 08:43:52', '2023-03-09 08:43:52'),
(3, 2, 'M', 10, 0, NULL, '2023-03-09 08:43:52', '2023-03-09 08:43:52'),
(4, 2, 'L', 10, 0, NULL, '2023-03-09 08:43:52', '2023-03-09 08:43:52'),
(5, 3, 'S', 10, 150000, NULL, '2023-03-10 07:29:16', '2023-03-27 08:16:54'),
(6, 3, 'M', 5, 150000, NULL, '2023-03-10 07:29:16', '2023-03-27 08:16:54'),
(7, 3, 'L', 10, 150000, NULL, '2023-03-10 07:29:16', '2023-03-27 08:16:54'),
(8, 4, 'S', 16, 250000, NULL, '2023-03-27 03:18:58', '2023-03-30 06:50:31'),
(9, 4, 'M', 16, 250000, NULL, '2023-03-27 03:18:58', '2023-03-30 06:50:31'),
(10, 4, 'L', 11, 250000, NULL, '2023-03-27 03:18:58', '2023-03-30 06:50:31'),
(11, 5, 'S', 4, 0, NULL, '2023-03-29 06:08:08', '2023-03-29 06:08:08'),
(12, 5, 'M', 15, 0, NULL, '2023-03-29 06:08:08', '2023-03-29 06:08:08'),
(13, 5, 'L', 10, 0, NULL, '2023-03-29 06:08:08', '2023-03-29 06:08:08'),
(14, 6, 'S', 20, 0, NULL, '2023-03-30 03:34:51', '2023-03-30 03:34:51'),
(15, 6, 'M', 20, 0, NULL, '2023-03-30 03:34:51', '2023-03-30 03:34:51'),
(16, 6, 'L', 20, 0, NULL, '2023-03-30 03:34:51', '2023-03-30 03:34:51'),
(17, 7, '1', 9, 140000, NULL, '2023-03-30 07:03:14', '2023-03-30 07:08:43'),
(18, 7, '2', 9, 140000, NULL, '2023-03-30 07:03:14', '2023-03-30 07:08:43'),
(19, 7, '3', 9, 140000, NULL, '2023-03-30 07:03:14', '2023-03-30 07:08:43'),
(20, 7, '4', 10, 150000, NULL, '2023-03-30 07:03:14', '2023-03-30 07:05:42'),
(21, 7, '5', 10, 150000, NULL, '2023-03-30 07:03:14', '2023-03-30 07:05:42'),
(22, 7, '6', 10, 150000, NULL, '2023-03-30 07:03:14', '2023-03-30 07:05:42'),
(23, 7, '7', 10, 160000, NULL, '2023-03-30 07:03:14', '2023-03-30 07:05:42'),
(24, 7, '8', 10, 160000, NULL, '2023-03-30 07:03:14', '2023-03-30 07:05:42'),
(25, 7, '9', 10, 160000, NULL, '2023-03-30 07:03:14', '2023-03-30 07:05:42'),
(26, 8, 'XL', 28, 150000, NULL, '2023-03-30 07:59:17', '2023-03-30 08:02:56'),
(27, 8, 'XXL', 20, 150000, NULL, '2023-03-30 07:59:17', '2023-03-30 08:02:56'),
(28, 9, 'S', 10, 100000, NULL, '2023-03-30 08:00:37', '2023-03-30 08:03:13'),
(29, 9, 'M', 10, 100000, NULL, '2023-03-30 08:00:37', '2023-03-30 08:03:13'),
(30, 9, 'L', 10, 100000, NULL, '2023-03-30 08:00:37', '2023-03-30 08:03:13'),
(31, 9, 'XL', 10, 120000, NULL, '2023-03-30 08:00:37', '2023-03-30 08:03:13'),
(32, 9, '28', 10, 120000, NULL, '2023-03-30 08:00:37', '2023-03-30 08:03:13'),
(33, 9, '29', 10, 120000, NULL, '2023-03-30 08:00:37', '2023-03-30 08:03:13');

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
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `finishings`
--

INSERT INTO `finishings` (`id`, `cuci_id`, `no_surat`, `tanggal_masuk`, `tanggal_qc`, `tanggal_selesai`, `barang_lolos_qc`, `barang_gagal_qc`, `barang_diretur`, `barang_dibuang`, `keterangan_diretur`, `keterangan_dibuang`, `status`, `status_finishing`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'SJL-0002', '2023-03-09', '2023-03-08', '2023-03-09', 29, 1, 1, 0, 'retur dari gudang', NULL, 'kirim warehouse', NULL, NULL, '2023-03-09 04:30:02', '2023-03-09 04:34:47'),
(2, 3, 'SJL-0004', '2023-03-09', '2023-03-08', '2023-03-08', 30, 0, 0, 0, NULL, NULL, 'kirim warehouse', NULL, NULL, '2023-03-09 08:42:45', '2023-03-09 08:43:52'),
(3, 4, 'SJL-0004', '2023-03-10', '2023-03-10', '2023-03-10', 25, 5, 3, 2, 'retur', 'buang', 'kirim warehouse', NULL, NULL, '2023-03-10 06:22:24', '2023-03-10 07:29:16'),
(5, 6, 'SJL-0007', '2023-03-13', '2023-03-24', '2023-03-30', 60, 0, 0, 0, '0', '0', 'kirim warehouse', NULL, NULL, '2023-03-13 03:54:51', '2023-03-30 03:34:51'),
(6, 7, 'SJL-0016', '2023-03-13', '2023-03-13', '2023-03-27', 55, 0, 0, 0, '-', '-', 'kirim warehouse', NULL, NULL, '2023-03-13 04:15:35', '2023-03-27 03:18:58'),
(7, 5, 'SJL-0005', '2023-03-29', '2023-03-29', '2023-03-29', 29, 0, 0, 0, '-', '-', 'kirim warehouse', NULL, NULL, '2023-03-29 04:42:02', '2023-03-29 06:08:08'),
(8, 9, 'SJL-0017', '2023-03-29', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'finishing masuk', NULL, NULL, '2023-03-29 08:35:41', '2023-03-29 08:35:41'),
(9, 8, 'SJL-0012', '2023-03-29', '2023-03-29', NULL, 0, NULL, NULL, NULL, NULL, NULL, 'finishing masuk', NULL, NULL, '2023-03-29 08:36:14', '2023-03-29 08:52:45'),
(10, 16, 'SJL-0008', '2023-03-30', '2023-03-29', '2023-03-30', 48, 0, 0, 0, '0', '0', 'kirim warehouse', NULL, NULL, '2023-03-30 03:29:41', '2023-03-30 07:59:17'),
(11, 11, 'SJL-0021', '2023-03-30', '2023-03-29', '2023-03-30', 90, 0, 0, 0, '0', '0', 'kirim warehouse', NULL, NULL, '2023-03-30 07:00:36', '2023-03-30 07:03:14'),
(12, 10, 'SJL-0020', '2023-03-30', '2023-03-29', '2023-03-30', 60, 0, 0, 0, '0', '0', 'kirim warehouse', NULL, NULL, '2023-03-30 07:57:20', '2023-03-30 08:00:37');

-- --------------------------------------------------------

--
-- Table structure for table `finishing_dibuangs`
--

CREATE TABLE `finishing_dibuangs` (
  `id` bigint UNSIGNED NOT NULL,
  `finishing_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `finishing_dibuangs`
--

INSERT INTO `finishing_dibuangs` (`id`, `finishing_id`, `ukuran`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 'M', 2, NULL, '2023-03-10 07:29:16', '2023-03-10 07:29:16'),
(2, 12, '29', 0, NULL, '2023-03-30 08:00:37', '2023-03-30 08:00:37');

-- --------------------------------------------------------

--
-- Table structure for table `finishing_returs`
--

CREATE TABLE `finishing_returs` (
  `id` bigint UNSIGNED NOT NULL,
  `finishing_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `finishing_returs`
--

INSERT INTO `finishing_returs` (`id`, `finishing_id`, `ukuran`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'M', 1, NULL, '2023-03-09 04:34:47', '2023-03-09 04:34:47'),
(2, 3, 'M', 3, NULL, '2023-03-10 07:29:16', '2023-03-10 07:29:16'),
(3, 5, 'S', 0, NULL, '2023-03-30 03:34:51', '2023-03-30 03:34:51');

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
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_perbaikan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jahits`
--

INSERT INTO `jahits` (`id`, `potong_id`, `no_surat`, `tanggal_jahit`, `tanggal_selesai`, `tanggal_keluar`, `vendor`, `nama_vendor`, `harga_vendor`, `berhasil`, `jumlah_bahan`, `konversi`, `gagal_jahit`, `barang_direpair`, `barang_dibuang`, `keterangan_direpair`, `keterangan_dibuang`, `status_pembayaran`, `total_bayar`, `sisa_bayar`, `total_harga`, `status`, `status_jahit`, `deleted_at`, `created_at`, `updated_at`, `status_perbaikan`) VALUES
(1, 1, 'SJL-0002', '2023-03-08', '2023-03-08', '2023-03-09', 'eksternal', 'PT Sumeh Jaya Tailor', 50000.00, 40, 50, '4 Lusin 2 pcs', 10, 10, 0, 'diperbaiki', NULL, 'Lunas', 2500000, 0, 2500000, 'jahitan keluar', 'selesai', NULL, '2023-03-08 09:11:47', '2023-03-09 06:31:32', ''),
(2, 2, 'SJL-0004', '2023-03-09', '2023-03-09', '2023-03-10', 'internal', NULL, NULL, 30, 40, '3 Lusin 4 pcs', 10, 5, 5, 'diperbaiki', 'dibuang', NULL, 0, NULL, NULL, 'jahitan keluar', 'selesai', NULL, '2023-03-09 06:30:38', '2023-03-10 04:01:12', ''),
(3, 3, 'SJL-0005', '2023-03-08', '2023-03-08', '2023-03-10', 'eksternal', 'PT Sumeh Jaya Tailor', 100000.00, 30, 40, '3 Lusin 4 pcs', 10, 5, 5, 'diperbaiki coba lagi', 'dibuang coba lagi', 'Lunas', 400000, 0, 400000, 'jahitan keluar', 'selesai', NULL, '2023-03-09 06:41:13', '2023-03-10 04:34:52', ''),
(5, 5, 'SJL-0007', '2023-03-10', '2023-03-10', '2023-03-10', 'eksternal', 'Sumeh Laundry', 5000.00, 60, 60, '5 Lusin 0 pcs', 0, 0, 0, '-', '-', 'Lunas', 25000, 0, 25000, 'jahitan keluar', 'selesai', NULL, '2023-03-10 04:31:16', '2023-03-10 04:36:44', ''),
(6, 6, 'SJL-0008', '2023-03-10', '2023-03-10', '2023-03-30', 'internal', NULL, NULL, 48, 48, '4 Lusin 0 pcs', 0, 0, 0, '0', '0', NULL, 0, NULL, NULL, 'jahitan keluar', 'selesai', NULL, '2023-03-10 06:31:34', '2023-03-30 03:28:27', ''),
(7, 7, 'SJL-0009', '2023-03-10', '2023-03-10', NULL, 'eksternal', 'Indonesia Tailor', 100.00, NULL, 20, '1 Lusin 8 pcs', NULL, NULL, NULL, NULL, NULL, 'Termin 1', 123, -123, 200, 'jahitan masuk', 'butuh konfirmasi', '2023-03-13 03:19:58', '2023-03-10 08:08:52', '2023-04-03 03:21:49', ''),
(8, 8, 'SJL-0011', '2023-03-09', '2023-03-10', '2023-03-30', 'eksternal', 'PT Sumeh Jaya Tailor', 50000.00, 95, 100, '8 Lusin 4 pcs', 5, 3, 2, '3 diperbaiki', '2 dibuang', 'Lunas', 450000, 0, 450000, 'jahitan keluar', 'selesai', NULL, '2023-03-10 08:22:02', '2023-03-30 03:28:18', ''),
(9, 9, 'SJL-0012', '2023-03-10', '2023-03-10', '2023-03-13', 'eksternal', 'PT Sumeh Jaya Tailor', 100000.00, 96, 100, '8 Lusin 4 pcs', 4, 4, 0, '-', '-', 'Lunas', 900000, 0, 900000, 'jahitan keluar', 'selesai', NULL, '2023-03-10 09:45:02', '2023-03-13 06:47:45', ''),
(10, 10, 'SJL-0016', '2023-03-13', '2023-03-13', '2023-03-13', 'eksternal', 'PT Sumeh Jaya Tailor', 15000.00, 55, 60, '5 Lusin 0 pcs', 5, 1, 4, 'diperbaiki', 'dibuang', 'Termin 1', 45000, 30000, 75000, 'jahitan keluar', 'selesai', NULL, '2023-03-13 03:18:33', '2023-03-13 03:41:46', ''),
(11, 11, 'SJL-0017', '2023-03-10', '2023-03-12', '2023-03-13', 'internal', NULL, NULL, 49, 50, '4 Lusin 2 pcs', 1, 1, 0, '-', '-', NULL, 0, NULL, NULL, 'jahitan keluar', 'selesai', NULL, '2023-03-13 04:54:55', '2023-03-13 06:53:33', ''),
(12, 12, 'SJL-0018', '2023-03-29', '2023-03-29', '2023-03-30', 'eksternal', 'Indonesia Tailor', 100000.00, 150, 150, '12 Lusin 6 pcs', 0, 0, 0, '0', '0', 'Termin 2', 1200000, 100000, 1300000, 'jahitan keluar', 'selesai', NULL, '2023-03-29 09:22:53', '2023-03-30 03:28:09', ''),
(13, 13, 'SJL-0019', '2023-03-29', '2023-03-29', NULL, 'eksternal', 'Indonesia Tailor', 100000.00, NULL, 10, '0 Lusin 10 pcs', NULL, NULL, NULL, NULL, NULL, 'Belum Lunas', 0, 100000, 100000, 'jahitan masuk', 'butuh konfirmasi', NULL, '2023-03-29 09:34:46', '2023-04-03 03:21:49', ''),
(14, 4, 'SJL-0006', '2023-03-29', '2023-03-29', '2023-03-30', 'eksternal', 'Indonesia Tailor', 10000.00, 60, 60, '5 Lusin 0 pcs', 0, 0, 0, '0', '0', 'Termin 1', 30000, 20000, 600000, 'jahitan keluar', 'selesai', NULL, '2023-03-29 09:35:46', '2023-03-30 03:27:57', ''),
(15, 16, 'SJL-0022', '2023-03-30', '2023-03-30', '2023-03-30', 'eksternal', 'Indonesia Tailor', 14500.00, 90, 90, '7 Lusin 6 pcs', 0, 0, 0, '0', '0', 'Belum Lunas', 0, 116000, 116000, 'jahitan keluar', 'selesai', NULL, '2023-03-30 03:21:00', '2023-03-30 03:27:50', ''),
(16, 15, 'SJL-0021', '2023-03-30', '2023-03-30', '2023-03-30', 'eksternal', 'Indonesia Tailor', 14000.00, 90, 90, '7 Lusin 6 pcs', 0, 0, 0, '0', '0', 'Belum Lunas', 0, 112000, 112000, 'jahitan keluar', 'selesai', NULL, '2023-03-30 03:21:07', '2023-03-30 03:27:42', ''),
(17, 14, 'SJL-0020', '2023-03-30', '2023-03-30', '2023-03-30', 'eksternal', 'Indonesia Tailor', 15000.00, 60, 60, '5 Lusin 0 pcs', 0, 0, 0, '0', '0', 'Belum Lunas', 0, 75000, 75000, 'jahitan keluar', 'selesai', NULL, '2023-03-30 03:21:13', '2023-03-30 03:27:35', ''),
(18, 17, 'SJL-0023', '2023-03-31', '2023-03-31', NULL, 'eksternal', 'Indonesia Tailor', 28000.00, 30, 60, '5 Lusin 0 pcs', 30, 30, 0, '10', '0', 'Belum Lunas', 0, 140000, 140000, 'jahitan selesai', 'selesai', NULL, '2023-03-31 03:42:26', '2023-03-31 03:43:22', ''),
(26, 17, 'SJL-0023', '2023-03-31', '2023-03-31', NULL, 'eksternal', 'Indonesia Tailor', 28000.00, 25, 30, '2 Lusin 1 pcs', 5, 0, 5, '10', '0', 'Lunas', 0, 0, 0, 'jahitan selesai', 'selesai', NULL, '2023-03-31 07:28:15', '2023-03-31 07:28:15', ''),
(27, 18, 'SJL-0239', '2023-04-03', '2023-04-03', NULL, 'eksternal', 'Indonesia Tailor', 40000.00, 46, 50, '4 Lusin 2 pcs', 4, 2, 2, '1', '1', 'Lunas', 200000, 0, 200000, 'jahitan selesai', 'selesai', NULL, '2023-04-03 03:20:20', '2023-04-03 03:21:49', ''),
(28, 18, 'SJL-0239', '2023-04-03', '2023-04-03', NULL, 'eksternal', 'Indonesia Tailor', 40000.00, 2, 2, '0 Lusin 2 pcs', 0, 0, 0, '1', '1', 'Lunas', 0, 0, 0, 'jahitan selesai', 'selesai', NULL, '2023-04-03 03:46:01', '2023-04-03 03:46:01', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `jahit_dibuangs`
--

CREATE TABLE `jahit_dibuangs` (
  `id` bigint UNSIGNED NOT NULL,
  `jahit_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jahit_dibuangs`
--

INSERT INTO `jahit_dibuangs` (`id`, `jahit_id`, `ukuran`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'L', 5, NULL, '2023-03-09 06:37:28', '2023-03-09 06:37:28'),
(2, 3, 'S', 5, NULL, '2023-03-09 07:12:23', '2023-03-09 07:12:23'),
(3, 8, 'S', 2, NULL, '2023-03-10 09:43:14', '2023-03-10 09:43:14'),
(4, 10, 'S', 4, NULL, '2023-03-13 03:30:36', '2023-03-13 03:30:36'),
(5, 27, '13', 1, NULL, '2023-04-03 03:21:49', '2023-04-03 03:21:49'),
(6, 27, '14', 1, NULL, '2023-04-03 03:21:49', '2023-04-03 03:21:49');

-- --------------------------------------------------------

--
-- Table structure for table `jahit_direpairs`
--

CREATE TABLE `jahit_direpairs` (
  `id` bigint UNSIGNED NOT NULL,
  `jahit_id` bigint UNSIGNED DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jahit_direpairs`
--

INSERT INTO `jahit_direpairs` (`id`, `jahit_id`, `ukuran`, `jumlah`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'M', 10, NULL, '2023-03-09 03:49:45', '2023-03-09 03:49:45'),
(2, 2, 'M', 5, NULL, '2023-03-09 06:37:28', '2023-03-09 06:37:28'),
(3, 3, 'S', 5, NULL, '2023-03-09 07:12:23', '2023-03-09 07:12:23'),
(4, 8, 'S', 3, NULL, '2023-03-10 09:43:14', '2023-03-10 09:43:14'),
(5, 10, 'M', 1, NULL, '2023-03-13 03:30:36', '2023-03-13 03:30:36'),
(6, 9, 'L', 4, NULL, '2023-03-13 06:47:08', '2023-03-13 06:47:08'),
(7, 11, 'S', 1, NULL, '2023-03-13 06:53:18', '2023-03-13 06:53:18'),
(10, 18, '1', 10, NULL, '2023-03-31 03:43:22', '2023-03-31 03:43:22'),
(11, 18, '10', 10, NULL, '2023-03-31 03:43:22', '2023-03-31 03:43:22'),
(12, 18, '100', 10, NULL, '2023-03-31 03:43:22', '2023-03-31 03:43:22'),
(13, 27, '13', 1, NULL, '2023-04-03 03:21:49', '2023-04-03 03:21:49'),
(14, 27, '14', 1, NULL, '2023-04-03 03:21:49', '2023-04-03 03:21:49');

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama_kategori`, `sku`, `gambar`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Pria', 'SKU001', NULL, NULL, '2023-03-08 08:20:28', '2023-03-08 08:20:28'),
(2, 'Wanita', 'SKU002', NULL, NULL, '2023-03-08 08:20:28', '2023-03-08 08:20:28'),
(3, 'Bayi', 'SKU003', '168023627638031.jpg', NULL, '2023-03-31 04:17:56', '2023-03-31 04:17:56');

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
(49, '2021_12_23_224052_create_ulasans_table', 1),
(62, '2023_03_09_141834_add_differentiator_to_perbaikan', 2),
(63, '2023_03_31_164947_add_label_after_perbaikan', 2);

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
(5, 'App\\User', 5);

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
(1, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 1, 1, 'production', '2023-03-08 08:39:39', '2023-04-03 03:23:56'),
(2, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 1, 1, 'production', '2023-03-08 09:11:47', '2023-04-03 03:23:56'),
(3, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-09 03:50:03', '2023-04-03 03:23:56'),
(4, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-09 04:03:09', '2023-04-03 03:23:56'),
(5, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-09 04:30:02', '2023-04-03 03:23:56'),
(6, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/finishing', 1, 1, 'warehouse', '2023-03-09 04:30:02', '2023-03-13 08:44:33'),
(7, 'ada barang yang diretur, silahkan di cek', 'http://localhost:8000/production/retur', 1, 1, 'production', '2023-03-09 04:34:47', '2023-04-03 03:23:56'),
(8, 'sortir telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 1, 1, 'warehouse', '2023-03-09 04:34:47', '2023-03-13 08:44:33'),
(9, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 1, 1, 'warehouse', '2023-03-09 04:50:03', '2023-03-13 08:44:33'),
(10, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 1, 1, 'production', '2023-03-09 06:29:33', '2023-04-03 03:23:56'),
(11, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 1, 1, 'production', '2023-03-09 06:30:38', '2023-04-03 03:23:56'),
(12, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-09 06:38:13', '2023-04-03 03:23:56'),
(13, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 1, 1, 'production', '2023-03-09 06:40:13', '2023-04-03 03:23:56'),
(14, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 1, 1, 'production', '2023-03-09 06:41:13', '2023-04-03 03:23:56'),
(15, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-09 08:42:45', '2023-04-03 03:23:56'),
(16, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/finishing', 1, 1, 'warehouse', '2023-03-09 08:42:45', '2023-03-13 08:44:33'),
(17, 'ada barang yang diretur, silahkan di cek', 'http://localhost:8000/production/retur', 1, 1, 'production', '2023-03-09 08:43:52', '2023-04-03 03:23:56'),
(18, 'sortir telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 1, 1, 'warehouse', '2023-03-09 08:43:52', '2023-03-13 08:44:33'),
(19, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-10 04:01:12', '2023-04-03 03:23:56'),
(20, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-10 04:09:28', '2023-04-03 03:23:56'),
(21, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 1, 1, 'production', '2023-03-10 04:17:28', '2023-04-03 03:23:56'),
(22, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 1, 1, 'production', '2023-03-10 04:24:35', '2023-04-03 03:23:56'),
(23, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 1, 1, 'production', '2023-03-10 04:27:01', '2023-04-03 03:23:56'),
(24, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 1, 1, 'production', '2023-03-10 04:31:16', '2023-04-03 03:23:56'),
(25, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-10 04:36:44', '2023-04-03 03:23:56'),
(26, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-10 06:22:24', '2023-04-03 03:23:56'),
(27, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/finishing', 1, 1, 'warehouse', '2023-03-10 06:22:24', '2023-03-13 08:44:33'),
(28, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 1, 1, 'production', '2023-03-10 06:30:10', '2023-04-03 03:23:56'),
(29, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 1, 1, 'production', '2023-03-10 06:31:34', '2023-04-03 03:23:56'),
(30, 'ada barang yang diretur, silahkan di cek', 'http://localhost:8000/production/retur', 1, 1, 'production', '2023-03-10 07:29:16', '2023-04-03 03:23:56'),
(31, 'sortir telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 1, 1, 'warehouse', '2023-03-10 07:29:16', '2023-03-13 08:44:33'),
(32, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 1, 1, 'production', '2023-03-10 08:07:44', '2023-04-03 03:23:56'),
(33, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 1, 1, 'production', '2023-03-10 08:08:52', '2023-04-03 03:23:56'),
(34, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 1, 1, 'production', '2023-03-10 08:20:49', '2023-04-03 03:23:56'),
(35, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 1, 1, 'production', '2023-03-10 08:22:02', '2023-04-03 03:23:56'),
(36, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 1, 1, 'production', '2023-03-10 09:44:19', '2023-04-03 03:23:56'),
(37, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 1, 1, 'production', '2023-03-10 09:45:02', '2023-04-03 03:23:56'),
(38, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 1, 1, 'production', '2023-03-13 03:16:33', '2023-04-03 03:23:56'),
(39, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 1, 1, 'production', '2023-03-13 03:18:33', '2023-04-03 03:23:56'),
(40, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-13 03:41:46', '2023-04-03 03:23:56'),
(41, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-13 03:50:24', '2023-04-03 03:23:56'),
(42, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/finishing', 1, 1, 'warehouse', '2023-03-13 03:50:24', '2023-03-13 08:44:33'),
(43, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-13 03:54:51', '2023-04-03 03:23:56'),
(44, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/finishing', 1, 1, 'warehouse', '2023-03-13 03:54:51', '2023-03-13 08:44:33'),
(45, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 1, 1, 'production', '2023-03-13 04:43:45', '2023-04-03 03:23:56'),
(46, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 1, 1, 'production', '2023-03-13 04:54:55', '2023-04-03 03:23:56'),
(47, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-13 06:47:45', '2023-04-03 03:23:56'),
(48, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-13 06:53:33', '2023-04-03 03:23:56'),
(49, 'Ada transaksi baru INV150320236', 'http://192.168.18.131:8000/admin/transaksi', 0, 0, 'online', '2023-03-15 04:25:51', '2023-03-15 04:25:51'),
(50, 'ada barang yang diretur, silahkan di cek', 'http://localhost:8000/production/retur', 1, 1, 'production', '2023-03-27 03:18:58', '2023-04-03 03:23:56'),
(51, 'sortir telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-27 03:18:58', '2023-03-27 03:18:58'),
(52, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-27 03:33:41', '2023-03-27 03:33:41'),
(53, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-27 03:36:34', '2023-03-27 03:36:34'),
(54, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-27 03:36:45', '2023-03-27 03:36:45'),
(55, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-27 03:36:58', '2023-03-27 03:36:58'),
(56, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-27 03:37:49', '2023-03-27 03:37:49'),
(57, 'Ada transaksi baru INV270320237', 'http://localhost:8000/admin/transaksi', 0, 0, 'online', '2023-03-27 03:49:21', '2023-03-27 03:49:21'),
(58, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-27 08:16:54', '2023-03-27 08:16:54'),
(59, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-27 08:17:08', '2023-03-27 08:17:08'),
(60, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-29 04:42:02', '2023-04-03 03:23:56'),
(61, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/finishing', 0, 0, 'warehouse', '2023-03-29 04:42:02', '2023-03-29 04:42:02'),
(62, 'ada barang yang diretur, silahkan di cek', 'http://localhost:8000/production/retur', 1, 1, 'production', '2023-03-29 06:08:08', '2023-04-03 03:23:56'),
(63, 'sortir telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-29 06:08:08', '2023-03-29 06:08:08'),
(64, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-29 08:35:41', '2023-04-03 03:23:56'),
(65, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/finishing', 0, 0, 'warehouse', '2023-03-29 08:35:41', '2023-03-29 08:35:41'),
(66, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-29 08:36:14', '2023-04-03 03:23:56'),
(67, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/finishing', 0, 0, 'warehouse', '2023-03-29 08:36:14', '2023-03-29 08:36:14'),
(68, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 1, 1, 'production', '2023-03-29 09:21:39', '2023-04-03 03:23:56'),
(69, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 1, 1, 'production', '2023-03-29 09:22:53', '2023-04-03 03:23:56'),
(70, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 1, 1, 'production', '2023-03-29 09:33:48', '2023-04-03 03:23:56'),
(71, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 1, 1, 'production', '2023-03-29 09:34:46', '2023-04-03 03:23:56'),
(72, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 1, 1, 'production', '2023-03-30 03:08:23', '2023-04-03 03:23:56'),
(73, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 1, 1, 'production', '2023-03-30 03:12:19', '2023-04-03 03:23:56'),
(74, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 1, 1, 'production', '2023-03-30 03:12:48', '2023-04-03 03:23:56'),
(75, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 1, 1, 'production', '2023-03-30 03:21:00', '2023-04-03 03:23:56'),
(76, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 1, 1, 'production', '2023-03-30 03:21:07', '2023-04-03 03:23:56'),
(77, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 1, 1, 'production', '2023-03-30 03:21:13', '2023-04-03 03:23:56'),
(78, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-30 03:27:35', '2023-04-03 03:23:56'),
(79, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-30 03:27:42', '2023-04-03 03:23:56'),
(80, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-30 03:27:50', '2023-04-03 03:23:56'),
(81, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-30 03:27:57', '2023-04-03 03:23:56'),
(82, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-30 03:28:09', '2023-04-03 03:23:56'),
(83, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-30 03:28:18', '2023-04-03 03:23:56'),
(84, 'jahit keluar telah dikirim ke cuci, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-30 03:28:27', '2023-04-03 03:23:56'),
(85, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-30 03:29:41', '2023-04-03 03:23:56'),
(86, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/finishing', 0, 0, 'warehouse', '2023-03-30 03:29:41', '2023-03-30 03:29:41'),
(87, 'ada barang yang diretur, silahkan di cek', 'http://localhost:8000/production/retur', 1, 1, 'production', '2023-03-30 03:34:51', '2023-04-03 03:23:56'),
(88, 'sortir telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-30 03:34:51', '2023-03-30 03:34:51'),
(89, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-30 04:31:54', '2023-03-30 04:31:54'),
(90, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-30 04:40:10', '2023-03-30 04:40:10'),
(91, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-30 07:00:36', '2023-04-03 03:23:56'),
(92, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/finishing', 0, 0, 'warehouse', '2023-03-30 07:00:36', '2023-03-30 07:00:36'),
(93, 'ada barang yang diretur, silahkan di cek', 'http://localhost:8000/production/retur', 1, 1, 'production', '2023-03-30 07:03:14', '2023-04-03 03:23:56'),
(94, 'sortir telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-30 07:03:14', '2023-03-30 07:03:14'),
(95, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-30 07:05:42', '2023-03-30 07:05:42'),
(96, 'Ada transaksi baru INV3003202326', 'http://localhost:8000/admin/transaksi', 0, 0, 'online', '2023-03-30 07:36:48', '2023-03-30 07:36:48'),
(97, 'Ada transaksi baru INV3003202327', 'http://localhost:8000/admin/transaksi', 0, 0, 'online', '2023-03-30 07:40:27', '2023-03-30 07:40:27'),
(98, 'Ada transaksi baru INV3003202328', 'http://localhost:8000/admin/transaksi', 0, 0, 'online', '2023-03-30 07:42:22', '2023-03-30 07:42:22'),
(99, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/production/cuci', 1, 1, 'production', '2023-03-30 07:57:20', '2023-04-03 03:23:56'),
(100, 'cuci keluar telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/finishing', 0, 0, 'warehouse', '2023-03-30 07:57:20', '2023-03-30 07:57:20'),
(101, 'ada barang yang diretur, silahkan di cek', 'http://localhost:8000/production/retur', 1, 1, 'production', '2023-03-30 07:59:17', '2023-04-03 03:23:56'),
(102, 'sortir telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-30 07:59:17', '2023-03-30 07:59:17'),
(103, 'ada barang yang diretur, silahkan di cek', 'http://localhost:8000/production/retur', 1, 1, 'production', '2023-03-30 08:00:37', '2023-04-03 03:23:56'),
(104, 'sortir telah dikirim ke gudang, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-30 08:00:37', '2023-03-30 08:00:37'),
(105, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-30 08:02:56', '2023-03-30 08:02:56'),
(106, 'gudang telah dikirim ke ecommerce, silahkan di cek', 'http://localhost:8000/warehouse/warehouse', 0, 0, 'warehouse', '2023-03-30 08:03:13', '2023-03-30 08:03:13'),
(107, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 1, 1, 'production', '2023-03-31 03:41:11', '2023-04-03 03:23:56'),
(108, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 1, 1, 'production', '2023-03-31 03:42:26', '2023-04-03 03:23:56'),
(109, 'bahan keluar telah dikirim ke potong, silahkan di cek bahan', 'http://localhost:8000/production/potong', 1, 1, 'production', '2023-04-03 03:18:57', '2023-04-03 03:23:56'),
(110, 'potong keluar telah dikirim ke jahit, silahkan di cek', 'http://localhost:8000/production/jahit', 1, 1, 'production', '2023-04-03 03:20:20', '2023-04-03 03:23:56'),
(111, 'Ada transaksi baru INV0304202329', 'http://localhost:8000/admin/transaksi', 0, 0, 'online', '2023-04-03 04:50:42', '2023-04-03 04:50:42');

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
(1, 5, 5, 'Pesanan dengan nomor transaksi INV130320233 dalam proses pengiriman!', '2023-03-13 08:23:28', '2023-03-13 08:23:28'),
(2, 5, 6, 'Pesanan dengan nomor transaksi INV150320236 dalam proses pengiriman!', '2023-03-15 04:28:26', '2023-03-15 04:28:26'),
(3, 5, 26, 'Pesanan dengan nomor transaksi INV3003202326 dalam proses pengiriman!', '2023-03-30 07:37:57', '2023-03-30 07:37:57'),
(4, 5, 27, 'Pesanan dengan nomor transaksi INV3003202327 dalam proses pengiriman!', '2023-03-30 07:41:05', '2023-03-30 07:41:05'),
(5, 5, 28, 'Pesanan dengan nomor transaksi INV3003202328 dalam proses pengiriman!', '2023-03-30 07:45:31', '2023-03-30 07:45:31'),
(6, 5, 29, 'Pesanan dengan nomor transaksi INV0304202329 dalam proses pengiriman!', '2023-04-03 04:51:41', '2023-04-03 04:51:41');

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
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran_cucis`
--

INSERT INTO `pembayaran_cucis` (`id`, `cuci_id`, `status`, `nominal`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'Lunas', 25000, NULL, '2023-03-09 04:29:49', '2023-03-09 04:29:49'),
(2, 4, 'Lunas', 20000, NULL, '2023-03-10 06:21:50', '2023-03-10 06:21:50'),
(3, 3, 'Lunas', 20000, NULL, '2023-03-10 06:23:05', '2023-03-10 06:23:05'),
(4, 5, 'Termin 1', 10000, NULL, '2023-03-10 09:07:22', '2023-03-10 09:07:22'),
(5, 5, 'Termin 2', 20000, NULL, '2023-03-10 09:07:41', '2023-03-10 09:07:41'),
(6, 6, 'Termin 1', 30000, NULL, '2023-03-10 09:59:09', '2023-03-10 09:59:09'),
(7, 6, 'Termin 2', 30000, NULL, '2023-03-10 09:59:09', '2023-03-10 09:59:09'),
(8, 7, 'Termin 1', 50000, NULL, '2023-03-13 03:49:13', '2023-03-13 03:49:13');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_jahits`
--

CREATE TABLE `pembayaran_jahits` (
  `id` bigint UNSIGNED NOT NULL,
  `jahit_id` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran_jahits`
--

INSERT INTO `pembayaran_jahits` (`id`, `jahit_id`, `status`, `nominal`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Termin 1', 1000000, NULL, '2023-03-08 09:46:35', '2023-03-08 09:46:35'),
(2, 1, 'Termin 2', 1500000, NULL, '2023-03-09 03:46:01', '2023-03-09 03:46:01'),
(3, 3, 'Termin 1', 100000, NULL, '2023-03-09 06:44:18', '2023-03-09 06:44:18'),
(4, 3, 'Termin 2', 100000, NULL, '2023-03-09 06:51:07', '2023-03-09 06:51:07'),
(5, 3, 'Termin 3', 200000, NULL, '2023-03-10 04:00:38', '2023-03-10 04:00:38'),
(6, 5, 'Lunas', 25000, NULL, '2023-03-10 04:32:29', '2023-03-10 04:32:29'),
(7, 8, 'Termin 1', 100000, NULL, '2023-03-10 08:59:49', '2023-03-10 08:59:49'),
(8, 8, 'Termin 2', 100000, NULL, '2023-03-10 08:59:49', '2023-03-10 08:59:49'),
(9, 8, 'Termin 3', 250000, NULL, '2023-03-10 08:59:49', '2023-03-10 08:59:49'),
(10, 10, 'Termin 1', 45000, NULL, '2023-03-13 03:29:47', '2023-03-13 03:29:47'),
(11, 9, 'Termin 1', 300000, NULL, '2023-03-13 03:31:14', '2023-03-13 03:31:14'),
(12, 9, 'Termin 2', 300000, NULL, '2023-03-13 03:31:14', '2023-03-13 03:31:14'),
(13, 9, 'Termin 3', 300000, NULL, '2023-03-13 03:31:14', '2023-03-13 03:31:14'),
(14, 7, 'Termin 1', 123, NULL, '2023-03-29 09:08:58', '2023-03-29 09:08:58'),
(15, 12, 'Termin 1', 700000, NULL, '2023-03-29 09:26:17', '2023-03-29 09:26:17'),
(16, 12, 'Termin 2', 500000, NULL, '2023-03-29 09:30:57', '2023-03-29 09:30:57'),
(17, 14, 'Termin 1', 30000, NULL, '2023-03-29 09:44:30', '2023-03-29 09:44:30'),
(18, 27, 'Lunas', 200000, NULL, '2023-04-03 03:21:16', '2023-04-03 03:21:16');

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

--
-- Dumping data for table `perbaikans`
--

INSERT INTO `perbaikans` (`id`, `bahan_id`, `tanggal_masuk`, `tanggal_kirim`, `tanggal_selesai`, `total`, `ukuran`, `status`, `created_at`, `updated_at`) VALUES
(20, 2, '2023-03-09', NULL, '2023-03-31', 5, '', 'selesai', '2023-03-31 04:37:53', '2023-03-31 09:35:48'),
(21, 4, '2023-03-09', NULL, NULL, 5, '', 'butuh konfirmasi', '2023-03-31 04:37:53', '2023-03-31 04:37:53'),
(22, 5, '2023-03-29', NULL, '2023-03-31', 1, '', 'butuh konfirmasi', '2023-03-31 04:37:53', '2023-03-31 08:31:46'),
(23, 11, '2023-03-10', NULL, NULL, 3, '', 'butuh konfirmasi', '2023-03-31 04:37:53', '2023-03-31 04:37:53'),
(24, 12, '2023-03-13', NULL, NULL, 4, '', 'butuh konfirmasi', '2023-03-31 04:37:53', '2023-03-31 04:37:53'),
(25, 14, '2023-03-13', NULL, NULL, 1, '', 'butuh konfirmasi', '2023-03-31 04:37:53', '2023-03-31 04:37:53'),
(26, 15, '2023-03-13', NULL, NULL, 1, '', 'butuh konfirmasi', '2023-03-31 04:37:53', '2023-03-31 04:37:53'),
(27, 22, '2023-03-31', NULL, '2023-03-31', 30, '', 'selesai', '2023-03-31 04:37:53', '2023-03-31 07:28:15'),
(28, 24, '2023-04-03', NULL, '2023-04-03', 2, '', 'selesai', '2023-04-03 03:24:08', '2023-04-03 03:46:01');

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
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `potongs`
--

INSERT INTO `potongs` (`id`, `bahan_id`, `no_surat`, `tanggal_cutting`, `tanggal_selesai`, `tanggal_keluar`, `hasil_cutting`, `konversi`, `status`, `status_potong`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'SJL-0002', '2023-03-08', '2023-03-08', NULL, 50.00, '4 Lusin 2 pcs', 'potong keluar', 'selesai', NULL, '2023-03-08 08:39:39', '2023-03-29 07:25:43'),
(2, 4, 'SJL-0004', '2023-03-09', '2023-03-09', NULL, 40.00, '3 Lusin 4 pcs', 'potong keluar', 'selesai', NULL, '2023-03-09 06:29:33', '2023-03-29 07:25:43'),
(3, 5, 'SJL-0005', '2023-03-09', '2023-03-09', NULL, 40.00, '3 Lusin 4 pcs', 'potong keluar', 'selesai', NULL, '2023-03-09 06:40:13', '2023-03-29 07:25:43'),
(4, 6, 'SJL-0006', '2023-03-10', '2023-03-10', NULL, 60.00, '5 Lusin 0 pcs', 'potong keluar', 'selesai', NULL, '2023-03-10 04:17:28', '2023-03-29 07:25:43'),
(5, 7, 'SJL-0007', '2023-03-10', '2023-03-10', NULL, 60.00, '5 Lusin 0 pcs', 'potong keluar', 'selesai', NULL, '2023-03-10 04:24:35', '2023-03-29 07:25:43'),
(6, 8, 'SJL-0008', '2023-03-10', '2023-03-10', NULL, 48.00, '4 Lusin 0 pcs', 'potong keluar', 'selesai', NULL, '2023-03-10 06:30:10', '2023-03-29 07:25:43'),
(7, 9, 'SJL-0009', '2023-03-10', '2023-03-10', NULL, 20.00, '1 Lusin 8 pcs', 'potong keluar', 'selesai', NULL, '2023-03-10 08:07:44', '2023-03-29 07:25:43'),
(8, 11, 'SJL-0011', '2023-03-10', '2023-03-10', NULL, 100.00, '8 Lusin 4 pcs', 'potong keluar', 'selesai', NULL, '2023-03-10 08:20:49', '2023-03-29 07:25:43'),
(9, 12, 'SJL-0012', '2023-03-10', '2023-03-10', NULL, 100.00, '8 Lusin 4 pcs', 'potong keluar', 'selesai', NULL, '2023-03-10 09:44:19', '2023-03-29 07:25:43'),
(10, 14, 'SJL-0016', '2023-03-13', '2023-03-13', NULL, 60.00, '5 Lusin 0 pcs', 'potong keluar', 'selesai', NULL, '2023-03-13 03:16:33', '2023-03-29 07:25:43'),
(11, 15, 'SJL-0017', '2023-03-13', '2023-03-13', NULL, 50.00, '4 Lusin 2 pcs', 'potong keluar', 'selesai', NULL, '2023-03-13 04:43:45', '2023-03-29 07:25:43'),
(12, 16, 'SJL-0018', '2023-03-29', '2023-03-29', NULL, 150.00, '12 Lusin 6 pcs', 'potong keluar', 'selesai', NULL, '2023-03-29 09:21:39', '2023-03-29 09:22:53'),
(13, 17, 'SJL-0019', '2023-03-29', '2023-03-29', NULL, 10.00, '0 Lusin 10 pcs', 'potong keluar', 'selesai', NULL, '2023-03-29 09:33:48', '2023-03-29 09:34:47'),
(14, 18, 'SJL-0020', '2023-03-30', '2023-03-30', NULL, 60.00, '5 Lusin 0 pcs', 'potong keluar', 'selesai', NULL, '2023-03-30 03:08:23', '2023-03-30 03:21:14'),
(15, 19, 'SJL-0021', '2023-03-30', '2023-03-30', NULL, 90.00, '7 Lusin 6 pcs', 'potong keluar', 'selesai', NULL, '2023-03-30 03:12:19', '2023-03-30 03:21:07'),
(16, 20, 'SJL-0022', '2023-03-30', '2023-03-30', NULL, 90.00, '7 Lusin 6 pcs', 'potong keluar', 'selesai', NULL, '2023-03-30 03:12:48', '2023-03-30 03:21:00'),
(17, 22, 'SJL-0023', '2023-03-31', '2023-03-31', NULL, 60.00, '5 Lusin 0 pcs', 'potong keluar', 'selesai', NULL, '2023-03-31 03:41:11', '2023-03-31 03:42:27'),
(18, 24, 'SJL-0239', '2023-04-03', '2023-04-03', NULL, 50.00, '4 Lusin 2 pcs', 'potong keluar', 'selesai', NULL, '2023-04-03 03:18:57', '2023-04-03 03:20:20');

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
(1, 'PRD-1', NULL, 1, NULL, 'kaos Polos', 'Kaos Polos', -5, 0, 0, NULL, 'Pria', 'Kemeja', 'Kemeja Lengan Panjang', '2023-03-09 04:51:44', '2023-03-15 04:28:26'),
(2, 'PRD-2', NULL, 4, NULL, 'Kemeja Batik', 'batik bos', 43, 0, 0, NULL, 'Pria', 'Kemeja', 'Kemeja Lengan Panjang', '2023-03-27 03:39:16', '2023-03-30 06:50:31'),
(3, 'PRD-3', NULL, 7, NULL, 'Kemeja Batik', 'deskripsi', 77, 0, 0, NULL, 'Pria', 'Kemeja', 'Kemeja Lengan Panjang', '2023-03-30 07:06:54', '2023-04-03 04:51:41');

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
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekapitulasis`
--

INSERT INTO `rekapitulasis` (`id`, `cuci_id`, `jahit_id`, `jumlah_diperbaiki`, `jumlah_dibuang`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 5, 5, NULL, '2023-03-09 04:30:12', '2023-03-09 04:30:12'),
(2, NULL, 1, 10, 0, NULL, '2023-03-09 04:30:12', '2023-03-09 04:30:12'),
(3, 3, NULL, 0, 0, NULL, '2023-03-13 03:51:04', '2023-03-13 03:51:04'),
(4, 4, NULL, 0, 0, NULL, '2023-03-13 03:51:04', '2023-03-13 03:51:04'),
(5, 7, NULL, 0, 0, NULL, '2023-03-13 03:51:04', '2023-03-13 03:51:04'),
(6, NULL, 2, 5, 5, NULL, '2023-03-13 03:51:04', '2023-03-13 03:51:04'),
(7, NULL, 3, 5, 5, NULL, '2023-03-13 03:51:04', '2023-03-13 03:51:04'),
(8, NULL, 5, 0, 0, NULL, '2023-03-13 03:51:04', '2023-03-13 03:51:04'),
(9, NULL, 10, 1, 4, NULL, '2023-03-13 03:51:04', '2023-03-13 03:51:04'),
(10, 6, NULL, 0, 0, NULL, '2023-03-13 04:56:38', '2023-03-13 04:56:38');

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
(1, 1, NULL, NULL, 1, 0, '2023-03-13 04:19:43', '2023-03-13 04:19:43'),
(2, 2, NULL, NULL, 0, 0, '2023-03-13 04:19:43', '2023-03-13 04:19:43'),
(3, 3, NULL, NULL, 3, 2, '2023-03-13 04:19:43', '2023-03-13 04:19:43');

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
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `returs`
--

INSERT INTO `returs` (`id`, `finishing_id`, `total_barang`, `tanggal_masuk`, `keterangan_diretur`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-03-08', 'retur dari gudang', NULL, '2023-03-09 04:58:51', '2023-03-09 04:58:51'),
(4, 3, 3, '2023-03-09', 'retur', NULL, '2023-03-10 07:29:21', '2023-03-10 07:29:21');

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
(1, 'production', 'web', '2023-03-08 08:20:17', '2023-03-08 08:20:17'),
(2, 'warehouse', 'web', '2023-03-08 08:20:17', '2023-03-08 08:20:17'),
(3, 'admin-online', 'web', '2023-03-08 08:20:17', '2023-03-08 08:20:17'),
(4, 'admin-offline', 'web', '2023-03-08 08:20:17', '2023-03-08 08:20:17'),
(5, 'ecommerce', 'web', '2023-03-08 08:20:17', '2023-03-08 08:20:17');

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
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sampahs`
--

INSERT INTO `sampahs` (`id`, `cuci_id`, `jahit_id`, `total`, `tanggal_masuk`, `asal`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 2, NULL, 5, '2023-03-09', 'cuci', NULL, '2023-03-09 04:30:20', '2023-03-09 04:30:20'),
(3, NULL, 2, 5, '2023-03-09', 'jahit', NULL, '2023-03-09 06:38:32', '2023-03-09 06:38:32'),
(4, NULL, 3, 5, '2023-03-09', 'jahit', NULL, '2023-03-10 06:32:41', '2023-03-10 06:32:41'),
(5, NULL, 10, 4, '2023-03-13', 'jahit', NULL, '2023-03-13 03:51:14', '2023-03-13 03:51:14');

-- --------------------------------------------------------

--
-- Table structure for table `sub_kategoris`
--

CREATE TABLE `sub_kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED DEFAULT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_kategoris`
--

INSERT INTO `sub_kategoris` (`id`, `kategori_id`, `nama_kategori`, `sku`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kemeja', 'SKU001/1', NULL, '2023-03-08 08:20:28', '2023-03-08 08:20:28'),
(2, 2, 'Kemeja', 'SKU002/2', NULL, '2023-03-08 08:20:28', '2023-03-08 08:20:28'),
(3, 1, 'Kemeja lengan panjaannnnnnngggggg', 'SKU001/2', NULL, '2023-03-09 07:55:37', '2023-03-09 07:55:37'),
(4, 2, 'Kemeja Batik Wanita', 'SKU002/3', NULL, '2023-03-29 04:38:41', '2023-03-29 04:38:41');

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint UNSIGNED NOT NULL,
  `bank_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `alamat_id` bigint UNSIGNED DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_resi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ongkir` double DEFAULT NULL,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_transaksi` timestamp NOT NULL,
  `qty` int NOT NULL DEFAULT '0',
  `total_harga` double NOT NULL,
  `status_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_bayar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_bayar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bayar` double DEFAULT NULL,
  `kembalian` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id`, `bank_id`, `user_id`, `alamat_id`, `nama`, `no_hp`, `alamat`, `no_resi`, `ongkir`, `kode_transaksi`, `tgl_transaksi`, `qty`, `total_harga`, `status_transaksi`, `status`, `status_bayar`, `bukti_bayar`, `pembayaran`, `bayar`, `kembalian`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, 'Didan', '087857600717', 'Jalan Kehatimu', NULL, NULL, 'INV090320231', '2023-03-09 08:12:34', 1, 50000, 'offline', NULL, NULL, NULL, 'Tunai', 100000, 50000, '2023-03-09 08:12:34', '2023-03-09 08:12:34'),
(2, NULL, NULL, NULL, 'Didan', '087857600717', 'Jl Kehatimu', NULL, NULL, 'INV090320232', '2023-03-09 08:30:58', 2, 100000, 'offline', NULL, NULL, NULL, 'Tunai', 100000, 50000, '2023-03-09 08:30:58', '2023-03-09 08:30:58'),
(3, NULL, NULL, NULL, 'Didan', '087857600717', 'Jl Kehatimu', NULL, NULL, 'INV090320233', '2023-03-09 08:32:03', 1, 50000, 'offline', NULL, NULL, NULL, 'Tunai', 100000, 50000, '2023-03-09 08:32:03', '2023-03-09 08:32:03'),
(4, NULL, NULL, NULL, 'Didan', '087857600717', 'Jl Kehatimu', NULL, NULL, 'INV090320234', '2023-03-09 08:34:58', 1, 50000, 'offline', NULL, NULL, NULL, 'Tunai', 100000, 50000, '2023-03-09 08:34:58', '2023-03-09 08:34:58'),
(5, 1, 5, 1, NULL, NULL, NULL, '1239102312031', NULL, 'INV130320233', '2023-03-13 08:05:52', 1, 57500, 'online', 'dikirim', 'sudah dibayar', NULL, NULL, NULL, NULL, '2023-03-13 08:05:52', '2023-03-13 08:23:28'),
(6, 1, 5, 1, NULL, NULL, NULL, '123456789', NULL, 'INV150320236', '2023-03-15 04:25:51', 32, 1602500, 'online', 'telah tiba', 'sudah dibayar', '167885446747726.jpg', NULL, NULL, NULL, '2023-03-15 04:25:51', '2023-03-15 04:28:52'),
(22, 1, 5, 1, NULL, NULL, NULL, NULL, NULL, 'INV270320237', '2023-03-27 03:49:21', 1, 2650, 'online', 'butuh konfirmasi', 'sudah dibayar', '167988897497466.jpg', NULL, NULL, NULL, '2023-03-27 03:49:21', '2023-03-27 03:50:52'),
(23, NULL, NULL, NULL, 'Didan Rizky Adha', '087857600717', 'Jalan Kehatimu', NULL, NULL, 'INV2903202323', '2023-03-29 04:17:23', 1, 150000, 'offline', NULL, NULL, NULL, 'Tunai', 150000, 0, '2023-03-29 04:17:23', '2023-03-29 04:17:23'),
(24, NULL, NULL, NULL, 'DIDAN RIZKY ADHA', '087857600717', 'Jalan Ke hatimu', NULL, NULL, 'INV3003202324', '2023-03-30 06:50:31', 3, 750000, 'offline', NULL, NULL, NULL, 'Tunai', 800000, 50000, '2023-03-30 06:50:31', '2023-03-30 06:50:31'),
(25, NULL, NULL, NULL, 'Didan Rizky Adha', '087857600717', 'Jalan Kehatimu', NULL, NULL, 'INV3003202325', '2023-03-30 07:08:43', 1, 140000, 'offline', NULL, NULL, NULL, 'Tunai', 150000, 10000, '2023-03-30 07:08:43', '2023-03-30 07:08:43'),
(26, 1, 5, 1, NULL, NULL, NULL, '1234567890', NULL, 'INV3003202326', '2023-03-30 07:36:48', 2, 322500, 'online', 'telah tiba', 'sudah dibayar', '168016181755019.png', NULL, NULL, NULL, '2023-03-30 07:36:48', '2023-03-30 07:38:34'),
(27, 1, 5, 1, NULL, NULL, NULL, '12346423', NULL, 'INV3003202327', '2023-03-30 07:40:27', 1, 152500, 'online', 'dikirim', 'sudah dibayar', '168016203594314.png', NULL, NULL, NULL, '2023-03-30 07:40:27', '2023-03-30 07:41:05'),
(28, 1, 5, 1, NULL, NULL, NULL, '1234567890', NULL, 'INV3003202328', '2023-03-30 07:42:22', 1, 152500, 'online', 'dikirim', 'sudah dibayar', '168016215054724.png', NULL, NULL, NULL, '2023-03-30 07:42:22', '2023-03-30 07:45:31'),
(29, 1, 5, 1, NULL, NULL, NULL, '3467543568', NULL, 'INV0304202329', '2023-04-03 04:50:42', 2, 302500, 'online', 'dikirim', 'sudah dibayar', '168049745515594.png', NULL, NULL, NULL, '2023-04-03 04:50:42', '2023-04-03 04:51:41');

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
(1, 'produksi', 'produksi@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$g2RMxxO1CR5iytO74MkDw.X78FDmoUnGHFDedi1vpQR6hw7.5aQ9S', NULL, NULL, '2023-03-08 08:20:22', '2023-03-08 08:20:22'),
(2, 'gudang', 'gudang@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$afzpOg9YOmqMBbqA1g3n2Oy7CYxIIQXi1TUYJQ8cbMuaH4.SBkWDe', NULL, NULL, '2023-03-08 08:20:22', '2023-03-08 08:20:22'),
(3, 'admin', 'admin_offline@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$6EywlLEgK/AyJ24cWrVfxePD1i5pLvLl2YXoW1E/lo6QpIus9G0gq', NULL, NULL, '2023-03-08 08:20:22', '2023-03-08 08:20:22'),
(4, 'admin online', 'admin_online@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$6EywlLEgK/AyJ24cWrVfxePD1i5pLvLl2YXoW1E/lo6QpIus9G0gq', NULL, NULL, '2023-03-08 08:20:22', '2023-03-09 07:53:43'),
(5, 'Didan Rizky Adha', 'didanadha99@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$JS3O3JMbUjKNFKf0HK/KR.8AlBw7YJoiVOX.z3KGCUorbLdduywF2', NULL, NULL, '2023-03-10 03:45:31', '2023-03-10 03:45:31');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint UNSIGNED NOT NULL,
  `finishing_id` bigint UNSIGNED DEFAULT NULL,
  `harga_produk` double(8,2) NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `finishing_id`, `harga_produk`, `tanggal_masuk`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 0.00, NULL, NULL, '2023-03-09 04:34:47', '2023-03-09 04:34:47'),
(2, 2, 0.00, NULL, NULL, '2023-03-09 08:43:52', '2023-03-09 08:43:52'),
(3, 3, 0.00, NULL, NULL, '2023-03-10 07:29:16', '2023-03-10 07:29:16'),
(4, 6, 0.00, NULL, NULL, '2023-03-27 03:18:58', '2023-03-27 03:18:58'),
(5, 7, 0.00, NULL, NULL, '2023-03-29 06:08:08', '2023-03-29 06:08:08'),
(6, 5, 0.00, NULL, NULL, '2023-03-30 03:34:51', '2023-03-30 03:34:51'),
(7, 11, 0.00, NULL, NULL, '2023-03-30 07:03:14', '2023-03-30 07:03:14'),
(8, 10, 0.00, NULL, NULL, '2023-03-30 07:59:17', '2023-03-30 07:59:17'),
(9, 12, 0.00, NULL, NULL, '2023-03-30 08:00:37', '2023-03-30 08:00:37');

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
  ADD UNIQUE KEY `produks_barcode_unique` (`barcode`),
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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bahans`
--
ALTER TABLE `bahans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cucis`
--
ALTER TABLE `cucis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `cuci_dibuangs`
--
ALTER TABLE `cuci_dibuangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cuci_direpairs`
--
ALTER TABLE `cuci_direpairs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_cucis`
--
ALTER TABLE `detail_cucis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `detail_finishings`
--
ALTER TABLE `detail_finishings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `detail_jahits`
--
ALTER TABLE `detail_jahits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `detail_perbaikans`
--
ALTER TABLE `detail_perbaikans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `detail_potongs`
--
ALTER TABLE `detail_potongs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `detail_produks`
--
ALTER TABLE `detail_produks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `detail_produk_images`
--
ALTER TABLE `detail_produk_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_rekapitulasis`
--
ALTER TABLE `detail_rekapitulasis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `detail_rekapitulasi_warehouses`
--
ALTER TABLE `detail_rekapitulasi_warehouses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_returs`
--
ALTER TABLE `detail_returs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_sampahs`
--
ALTER TABLE `detail_sampahs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `detail_sub_kategoris`
--
ALTER TABLE `detail_sub_kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `detail_warehouses`
--
ALTER TABLE `detail_warehouses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `favorits`
--
ALTER TABLE `favorits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finishings`
--
ALTER TABLE `finishings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `finishing_dibuangs`
--
ALTER TABLE `finishing_dibuangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `finishing_returs`
--
ALTER TABLE `finishing_returs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jahits`
--
ALTER TABLE `jahits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `jahit_dibuangs`
--
ALTER TABLE `jahit_dibuangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jahit_direpairs`
--
ALTER TABLE `jahit_direpairs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `keranjangs`
--
ALTER TABLE `keranjangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `notification_ecommerces`
--
ALTER TABLE `notification_ecommerces`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pembayaran_cucis`
--
ALTER TABLE `pembayaran_cucis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembayaran_jahits`
--
ALTER TABLE `pembayaran_jahits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `perbaikans`
--
ALTER TABLE `perbaikans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `potongs`
--
ALTER TABLE `potongs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekapitulasis`
--
ALTER TABLE `rekapitulasis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rekapitulasi_warehouses`
--
ALTER TABLE `rekapitulasi_warehouses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `returs`
--
ALTER TABLE `returs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sampahs`
--
ALTER TABLE `sampahs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_kategoris`
--
ALTER TABLE `sub_kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `ulasans`
--
ALTER TABLE `ulasans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
